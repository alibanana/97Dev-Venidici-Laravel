<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    private const CONTACTED_CANDIDATES_PAGE_SIZE = 4;
    private const AVAILABLE_YEARS_OF_EXPERIENCES_FILTER = ['< 1 Tahun', '< 2 tahun', '< 3 Tahun', '> 3 Tahun'];
    private const AVAILABLE_YEARS_OF_EXPERIENCES_FILTER_AND_DB_VALUE_MAP = [
        '< 1 Tahun' => ['Less than 1 Year of Experience'],
        '< 2 tahun' => ['Less than 1 Year of Experience', 'Less than 2 Years of Experience'],
        '< 3 tahun' => ['Less than 1 Year of Experience', 'Less than 2 Years of Experience', 'Less than 3 Years of Experience'],
        '> 3 tahun' => ['Less than 1 Year of Experience', 'Less than 2 Years of Experience', 'Less than 3 Years of Experience', 'More than 3 Years of Experience']
    ];

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
    public function index() {
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at', 'desc')->get()->take(2);

        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $candidateDetails = CandidateDetail::with('user', 'interests')->get()
            ->filter(function ($candidateDetail, $key) {
                return !UserHelper::isRequiredCandidateDetailDataAndRelationshipEmpty($candidateDetail);
            });

        $candidateDetailIdAndCombinedInterestMap =
            $this->generateCandidateDetailIdAndCombinedInterestMap($candidateDetails);

        $archivedCandidateIds = Auth::user()->candidates()
            ->select('candidate_id')->pluck('candidate_id')->toArray();
        
        return view('client/job-portal/company/index', compact('cart_count', 'notifications', 'transactions',
            'informations', 'footer_reviews', 'agent', 'candidateDetails', 'candidateDetailIdAndCombinedInterestMap',
            'archivedCandidateIds'));
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

    // Shows the Hiring Partner List Page. 
    public function myListIndex(Request $request) {
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at', 'desc')->get()->take(2);

        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $contactedCandidates = Auth::user()->candidates()
            ->with('candidateDetail');

        // ADD FILTERS & SORTING HERE

        $contactedCandidates = $contactedCandidates->paginate(self::CONTACTED_CANDIDATES_PAGE_SIZE);

        $availableExperienceYearFilters = self::AVAILABLE_YEARS_OF_EXPERIENCES_FILTER;
        
        return view('client/job-portal/company/mylist', compact('cart_count', 'notifications', 'transactions',
            'informations', 'footer_reviews', 'agent', 'contactedCandidates', 'availableExperienceYearFilters'));
    }

    // Shows Candidate Detail Profile Page
    public function job_portal_candidate_detail($id){
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);

        $candidate_detail = CandidateDetail::where('user_id', $id)
            ->with('workExperiences', 'educations', 'achievements', 'hardskills', 'softskills')
            ->first();

        $work_experiences_not_updated = WorkExperience::where('candidate_detail_id', $candidate_detail->id)
            ->doesntHave('workExperienceChanges')
            ->get();

        $educations_not_updated = Education::where('candidate_detail_id', $candidate_detail->id)
            ->doesntHave('educationChanges')
            ->get();

        $achievements_not_updated = Achievement::where('candidate_detail_id', $candidate_detail->id)
            ->doesntHave('achievementChanges')
            ->get();
            
        $hardskills_not_updated = Hardskill::where('candidate_detail_id', $candidate_detail->id)
            ->doesntHave('hardskillChanges')
            ->get();
        $softskills_not_updated = Softskill::where('candidate_detail_id', $candidate_detail->id)
            ->doesntHave('softskillChanges')
            ->get();
        
        $interests_not_updated = Interest::where('candidate_detail_id', $candidate_detail->id)
            ->doesntHave('interestChanges')
            ->get();

        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $isCandidateDetailUpdated = UserHelper::isCandidateNotUpdated(Auth::user());

        $view_data = ['candidate_detail','work_experiences_not_updated', 'educations_not_updated', 'achievements_not_updated',
            'hardskills_not_updated', 'softskills_not_updated', 'interests_not_updated', 'isCandidateDetailUpdated', 'cart_count',
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
            $message = 'Candidate (' . $candidate->name . ') is already available on your list.';
        } else {
            $candidate->hiringPartners()->attach(Auth::user()->id);
            $message = 'Candidate (' . $candidate->name . ') is now available on your list.';
        }

        return redirect()->route(self::INDEX_ROUTE)->with('message', $message);
    }

    // Update hiringPartner-Candidate status to contacted.
    public function contactCandidate(Request $request) {
        $validated = $request->validate(['user_id' => 'required|integer']);

        $candidate = User::where('id', $validated['user_id'])
            ->has('candidateDetail')
            ->firstOrFail();

        if (UserHelper::isCandidateHired($candidate->id)) {
            $message = 'Candidate (' . $candidate->name . ') has already been hired';
        } else if (!UserHelper::isHiringPartnerCandidateExists(Auth::user()->id, $candidate->id)) {
            $message = 'Candidate (' . $candidate->name . ') has not been added to your list.';
        } else {$hiringPartnerCandidatePivot = $candidate->hiringPartners()
                ->where('hiring_partner_id', Auth::user()->id)
                ->firstOrFail()->pivot;
            $hiringPartnerCandidatePivot->status = 'contacted';
            $hiringPartnerCandidatePivot->save();
            $message = 'Candidate (' . $candidate->name . ') has been contacted through email.';
        }

        return redirect('/job-portal#kandidat-venidici')->with('message', $message);
    }

    // Accepts a Contacted Candidate (user). Assumes that candidate has already be contacted.
    public function acceptContactedCandidate(Request $request) {
        $validated = $request->validate(['user_id' => 'required|integer']);

        $candidate = User::where('id', $validated['user_id'])
            ->has('candidateDetail')
            ->firstOrFail();

        if (UserHelper::isCandidateHired($candidate->id)) {
            $message = 'Candidate (' . $candidate->name . ') has already been hired';
        } else if (!UserHelper::isHiringPartnerCandidateExists(Auth::user()->id, $candidate->id)) {
            $message = 'Candidate (' . $candidate->name . ') has not been added to your list.';
        } else {
            UserHelper::hireCandidate($candidate, Auth::user()->id);
            $message = 'Candidate (' . $candidate->name . ') has successfully been accepted on your company.';
        }

        return redirect('job-portal/my-list#daftar-saya')->with('my_list_message', $message);
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
