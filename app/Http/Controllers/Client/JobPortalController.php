<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

use App\Helper\Helper;
use App\Helper\UserHelper;

use App\Mail\PasswordChangedMail;

use App\Models\Review;
use App\Models\User;
use App\Models\CandidateDetail;
use App\Models\CandidateDetailChange;
use App\Models\WorkExperience;
use App\Models\WorkExperienceChange;
use App\Models\Education;
use App\Models\EducationChange;
use App\Models\Achievement;
use App\Models\AchievementChange;
use App\Models\Hardskill;
use App\Models\HardskillChange;
use App\Models\Softskill;
use App\Models\SoftskillChange;
use App\Models\Interest;
use App\Models\InterestChange;

class JobPortalController extends Controller
{
    private const INDEX_ROUTE = 'job-portal.index';
    private const MY_LIST_INDEX_ROUTE = 'job-portal.my-list.index';
    private const MY_TABLE_LIST_ROUTE = '/job-portal/my-list#daftar-saya';
    private const CONTACTED_CANDIDATES_PAGE_SIZE = 4;
    private const AVAILABLE_YEARS_OF_EXPERIENCES_FILTER = ['< 1 Tahun', '< 2 Tahun', '< 3 Tahun', '> 3 Tahun'];
    private const AVAILABLE_YEARS_OF_EXPERIENCES_FILTER_AND_DB_VALUE_MAP = [
        '< 1 Tahun' => ['Less than 1 Year of Experience'],
        '< 2 Tahun' => ['Less than 1 Year of Experience', 'Less than 2 Years of Experience'],
        '< 3 Tahun' => ['Less than 1 Year of Experience', 'Less than 2 Years of Experience', 'Less than 3 Years of Experience'],
        '> 3 Tahun' => ['Less than 1 Year of Experience', 'Less than 2 Years of Experience', 'Less than 3 Years of Experience', 'More than 3 Years of Experience']
    ];
    private const HIRING_PARTNER_CANDIDATE_STATUS_LIST = ['archived', 'contacted', 'accepted', 'hired'];
    private const BOOTCAMP_COURSE_TYPE_ID = 3;

    private $notifications; // Stores combined notifications data.
    private $informations; // Stores notification (isInformation == true) data.
    private $transactions; // Stores notification (isInformation == false) data for a particular user.
    private $cart_count; // Stores cart data for a particular user.

    private function resetNavbarData() {
        $navbarData = Helper::getNavbarData();
        $this->notifications = $navbarData['notifications'];
        $this->informations = $navbarData['informations'];
        $this->transactions = $navbarData['transactions'];
        $this->cart_count = $navbarData['cart_count'];
    }

    // Shows the Client Job Portal Page. 
    public function index(Request $request) {
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at', 'desc')->get()->take(2);

        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $candidateDetails = CandidateDetail::with('user', 'workExperiences', 'educations', 'hardskills',
            'softskills', 'interests');

        $users = User::select('id', 'name');
        $candidateDetails = $candidateDetails->joinSub($users, 'users', function ($join) {
            $join->on('candidate_details.user_id', '=', 'users.id');
        });

        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route(self::INDEX_ROUTE, request()->except('search'));
                return redirect($url);
            } else {
                $search = $request->search;
                $candidateDetails = $candidateDetails->where(function ($query) use ($search) {
                    $query->where([['name', 'like', "%".$search."%"]])
                    ->orWhere([['industry', 'like', "%".$search."%"]]);
                });
            }
        }

        if ($request->has('sort')) {
            if ($request['sort'] == "alpha-asc") {
                $candidateDetails = $candidateDetails->orderBy('name', 'asc');
            } elseif ($request['sort'] == "alpha-desc") {
                $candidateDetails = $candidateDetails->orderBy('name', 'desc');
            }
        } else {
            $candidateDetails = $candidateDetails->orderBy('name', 'asc');
        }

        if ($request->has('years_of_experience')) {
            if (!in_array($request->years_of_experience, self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER)) {
                $url = route(self::INDEX_ROUTE, request()->except('years_of_experience'));
                return redirect($url);
            }

            if (in_array($request->years_of_experience, self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER)) {
                $candidateDetails = $candidateDetails->whereIn('experience_year',
                    self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER_AND_DB_VALUE_MAP[$request->years_of_experience]);
            }
        }

        $candidateDetails = $candidateDetails->get()->filter(function ($candidateDetail, $key) {
            return !UserHelper::isRequiredCandidateDetailDataAndRelationshipEmpty($candidateDetail);
        });

        $candidateDetailIdAndCombinedInterestMap =
            $this->generateCandidateDetailIdAndCombinedInterestMap($candidateDetails);
        $candidateDetailIdAndScoreMap = $this->generateCandidateDetailIdAndScoreMap($candidateDetails);
        $archivedCandidateIds = Auth::user()->candidates()
            ->select('candidate_id')->pluck('candidate_id')->toArray();
        
        $availableExperienceYearFilters = self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER;
        $availableStatusFilters = self::HIRING_PARTNER_CANDIDATE_STATUS_LIST;

        return view('client/job-portal/company/index', compact('cart_count', 'notifications', 'transactions',
            'informations', 'footer_reviews', 'agent', 'candidateDetails', 'candidateDetailIdAndCombinedInterestMap',
            'candidateDetailIdAndScoreMap', 'archivedCandidateIds','availableExperienceYearFilters', 'availableStatusFilters'));
    }

    private function generateCandidateDetailIdAndCombinedInterestMap($candidateDetails) {
        return $candidateDetails->mapWithKeys(function ($candidateDetail, $key) {
            $combinedInterestsString = '';
            foreach ($candidateDetail->interests as $interest) {
                $combinedInterestsString = $combinedInterestsString . $interest->title . ', ';
            }
            return [$candidateDetail->id => substr($combinedInterestsString, 0, -2)];
        });
    }

    private function generateCandidateDetailIdAndScoreMap($candidateDetails) {
        return $candidateDetails->mapWithKeys(function ($candidateDetail) {
            if ($candidateDetail->user->courses != null) {
                $scores = $candidateDetail->user->courses()
                    ->where('course_type_id', self::BOOTCAMP_COURSE_TYPE_ID)
                    ->get()->map(function ($course) {
                        return $course->pivot->score;
                    })->sortBy('score')->toArray();

                return [$candidateDetail->id => $scores[0]];
            }
        });
    }

    // Shows the Hiring Partner List Page. 
    public function myListIndex(Request $request) {
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at', 'desc')->get()->take(2);

        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $candidates = Auth::user()->candidates()
            ->with('candidateDetail');

        if ($request->has('sort')) {
            if ($request['sort'] == "alpha-asc") {
                $candidates = $candidates->orderBy('name', 'asc');
            } elseif ($request['sort'] == "alpha-desc") {
                $candidates = $candidates->orderBy('name', 'desc');
            }
        } else {
            $candidates = $candidates->orderBy('name', 'asc');
        }

        if ($request->has('years_of_experience')) {
            if (!in_array($request->years_of_experience, self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER)) {
                $url = route(self::MY_LIST_INDEX_ROUTE, request()->except('years_of_experience'));
                return redirect($url);
            }

            if (in_array($request->years_of_experience, self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER)) {
                $candidateDetails = CandidateDetail::select(
                    DB::raw('user_id as id'), 'experience_year');
                $candidates = $candidates->joinSub($candidateDetails, 'details', function ($join) {
                    $join->on('users.id', '=', 'details.id');
                });

                $candidates = $candidates->whereIn('experience_year',
                    self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER_AND_DB_VALUE_MAP[$request->years_of_experience]);
            }
        }

        if ($request->has('status')) {
            if (!in_array($request->status, self::HIRING_PARTNER_CANDIDATE_STATUS_LIST)) {
                $url = route(self::MY_LIST_INDEX_ROUTE, request()->except('status'));
                return redirect($url);
            }

            if (in_array($request->status, self::HIRING_PARTNER_CANDIDATE_STATUS_LIST))
                $candidates = $candidates->where('hiring_partner_candidate.status', $request->status);
        }

        $candidates = $candidates->paginate(self::CONTACTED_CANDIDATES_PAGE_SIZE);

        $availableExperienceYearFilters = self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER;
        $availableStatusFilters = self::HIRING_PARTNER_CANDIDATE_STATUS_LIST;

        return view('client/job-portal/company/mylist', compact('cart_count', 'notifications', 'transactions',
            'informations', 'footer_reviews', 'agent', 'candidates', 'availableExperienceYearFilters',
            'availableStatusFilters'));
    }

    // Shows Candidate Detail Profile Page
    public function job_portal_candidate_detail($id){
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        $candidate_detail = CandidateDetail::where('user_id', $id)
            ->with('workExperiences', 'educations', 'achievements', 'hardskills', 'softskills')
            ->first();

        $score = UserHelper::getHighestScoreFromCandidateDetail($candidate_detail);
    
        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $isCandidateDetailUpdated = UserHelper::isCandidateNotUpdated(Auth::user());

        $view_data = ['candidate_detail', 'score', 'isCandidateDetailUpdated', 'cart_count',
            'notifications', 'transactions', 'informations', 'footer_reviews', 'agent'];
        
        return view('client/job-portal/company/detail', compact($view_data));
    }

    // Shows the Client Job Portal Profile page.
    public function profileIndex() {
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        if(Auth::check()) {
            $this->resetNavbarData();
            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            return view('client/job-portal/company/profile', compact('cart_count', 'notifications', 'transactions',
                'informations', 'footer_reviews', 'agent'));
        }
        
        return view('client/job-portal/company/profile', compact('footer_reviews', 'agent'));
    }

    // Save user (candidate) to Hiring Partner's candidate-list.
    public function archiveCandidate(Request $request) {
        $validated = $request->validate(['user_id' => 'required|integer']);

        $candidate = User::where('id', $validated['user_id'])
            ->has('candidateDetail')
            ->firstOrFail();

        if (UserHelper::isHiringPartnerCandidateExists(Auth::user()->id, $candidate->id)) {
            $my_list_message = 'Candidate (' . $candidate->name . ') is already available on your list.';
        } else {
            $candidate->hiringPartners()->attach(Auth::user()->id);
            $my_list_message = 'Candidate (' . $candidate->name . ') is now available on your list.';
        }

        return redirect(self::MY_TABLE_LIST_ROUTE)->with('my_list_message', $my_list_message);
    }

    // Method to handle Candidate Related Actions
    public function handleCandidateAction(Request $request) {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'action' => 'required' // contact, unarchive, approve, cancel
        ]);

        $candidate = User::where('id', $validated['user_id'])
            ->has('candidateDetail')
            ->firstOrFail();

        if ($validated['action'] == 'contact') {
            UserHelper::contactCandidate($candidate, Auth::user());
            $message = 'Candidate (' . $candidate->name . ') has been contacted through email.';
        } elseif ($validated['action'] == 'unarchive') {
            UserHelper::unarchiveCandidate($candidate, Auth::user());
            $message = 'Candidate (' . $candidate->name . ') has been removed from your list.';
        } elseif ($validated['action'] == 'accept') {
            UserHelper::hireCandidate($candidate, Auth::user());
            $message = 'Candidate (' . $candidate->name . ') has successfully been accepted on your company.';
        } elseif ($validated['action'] == 'cancel') {
            UserHelper::cancelCandidate($candidate, Auth::user());
            $message = 'Candidate (' . $candidate->name . ') status successfully has been updated from accepted to contacted.';
        }

        return redirect(self::MY_TABLE_LIST_ROUTE)->with('my_list_message', $message);
    }

    // Changes the user's password in the database.
    public function changePassword(Request $request) {
        // Use StrongPassword validation on production.
        if (App::environment('production'))
            $validation_rules = [
                'old_password' => 'required',
                'password' => ['required', 'confirmed', new StrongPassword]
            ];
        else
            $validation_rules = [
                'old_password' => 'required',
                'password' => ['required', 'confirmed']
            ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {
            return redirect(route('job-portal.profile.index') . '#change-password')
                ->withErrors($validator);
        }

        $validated = $request->only(['old_password', 'password']);
        $user = auth()->user();

        // Check if old password matches.
        if (!Hash::check($validated['old_password'], $user->password)) {
            return redirect(route('job-portal.profile.index') . '#change-password')
                ->withErrors([
                    'old_password' => 'Current password does not matched..'
                ]);
        }

        // Check if new password is the same with old password.
        if (Hash::check($validated['password'], $user->password)) {
            return redirect(route('job-portal.profile.index') . '#change-password')
                ->withErrors([
                    'password' => 'New pasword cannot be the same..'
                ]);
        }

        $user->password =  Hash::make($validated['password']);
        $user->save();

        if ($user->wasChanged()) {
            $messageTopic = 'success';
            $message = 'Your password has been changed. A notification email has been sent to your email.';
            try {
                Mail::to(auth()->user()->email)->send(new PasswordChangedMail());
            } catch (Throwable $e) {
                $user->password =  Hash::make($validated['old_password']);
                $user->save();
                $messageTopic = 'danger';
                $message = 'Oops, unable to send email. Your old password has been kept.';
                if (!App::environment('production'))
                    $message = $e->getMessage();
            }
        } else {
            $messageTopic = 'danger';
            $message = 'Oops, unable to update your password.';
        }

        return redirect(route('job-portal.profile.index') . '#change-password')->with($messageTopic, $message);
        
    }
}
