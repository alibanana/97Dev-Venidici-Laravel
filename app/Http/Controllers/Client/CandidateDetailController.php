<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

use App\Helper\Helper;
use App\Helper\UserHelper;

use App\Models\Review;
use App\Models\CandidateDetail;
use App\Models\CandidateDetailChange;
use App\Models\WorkExperienceChange;
use App\Models\EducationChange;
use App\Models\AchievementChange;
use App\Models\HardskillChange;
use App\Models\SoftskillChange;

class CandidateDetailController extends Controller
{

    private const INDEX_ROUTE = 'candidate-detail.index';
    private const INDEX_URL_WITH_CREATE_WORK_EXPERIENCE_MODAL = '/candidate-details#we-create';
    private const INDEX_URL_WITH_CREATE_EDUCATION_MODAL = '/candidate-details#edu-create';
    private const INDEX_URL_WITH_CREATE_ACHIEVEMENT_MODAL = '/candidate-details#achievement-create';
    private const INDEX_URL_WITH_CREATE_HARDSKILL_MODAL = '/candidate-details#hs-create';
    private const INDEX_URL_WITH_CREATE_SOFTSKILL_MODAL = '/candidate-details#ss-create';
    
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

    // Shows the Client Candidate Detail page.
    public function index(){
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        
        $view_data = [];
        if (Auth::user()->candidateDetail()->exists()) {
            $candidate_detail = CandidateDetail::where('user_id', Auth::user()->id)
                ->with('workExperiences', 'educations', 'achievements',
                    'hardskills', 'softskills')
                ->first();
            $view_data[] = 'candidate_detail';
        }
        
        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $view_data = array_merge($view_data, ['cart_count', 'notifications', 'transactions', 'informations', 'footer_reviews', 'agent']);
        return view('client/job-portal/client/edit', compact($view_data));
    }

    // Store / Update a user's candidate profile details.
    public function upsertCandidateDetail(Request $request) {
        $validationRules = [
            'linkedin_link' => 'required|starts_with:https://www.linkedin.com',
            'preferred_working_location' => 'required',
            'whatsapp_number' => 'required',
            'about_me_description' => 'required'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect()->route(self::INDEX_ROUTE)
                ->withErrors($validator)
                ->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::firstOrCreate(
            ['user_id' => Auth::user()->id]);

        $candidateDetailChange = CandidateDetailChange::updateOrCreate(
            [
                'candidate_detail_id' => $candidateDetail->id,
                'status' => 'pending'
            ],
            [
                'preferred_working_location' => $validated['preferred_working_location'],
                'linkedin_link' => $validated['linkedin_link'],
                'whatsapp_number' => $validated['whatsapp_number'],
                'about_me_description' => $validated['about_me_description']
            ]
        );

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';

        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }

    // Store new Work Experiences in the database.
    public function storeWorkExperience(Request $request) {
        $validationRules = [
            'company' => 'required',
            'job_position' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'location' => 'required'
        ];

        if ($request->end_date) {
            $validationRules['end_date'] = 'date_format:Y-m-d';
        }

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_CREATE_WORK_EXPERIENCE_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::firstOrCreate(
            ['user_id' => Auth::user()->id]);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate(
            [
                'candidate_detail_id' => $candidateDetail->id,
                'status' => 'pending'
            ]
        );

        $workExperienceChange = WorkExperienceChange::create([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'company' => $validated['company'],
            'job_position' => $validated['job_position'],
            'start_date' => $validated['start_date'],
            'end_date' => array_key_exists('end_date', $validated) ?
                $validated['end_date'] : null,
            'location' => $validated['location'],
            'action' => 'create'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }

    // Store new Education in the database.
    public function storeEducation(Request $request) {
        $validationRules = [
            'degree' => 'required',
            'school' => 'required',
            'major' => 'required',
            'start_year' => 'required|integer|digits:4'
        ];

        if ($request->end_year) {
            $validationRules['end_year'] = 'integer|digits:4|gte:start_year';
        }

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_CREATE_EDUCATION_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::firstOrCreate(
            ['user_id' => Auth::user()->id]);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate(
            [
                'candidate_detail_id' => $candidateDetail->id,
                'status' => 'pending'
            ]
        );

        $educationChange = EducationChange::create([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'degree' => $validated['degree'],
            'school' => $validated['school'],
            'major' => $validated['major'],
            'start_year' => $validated['start_year'],
            'end_year' => array_key_exists('end_year', $validated) ?
                $validated['end_date'] : null,
            'action' => 'create'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }

    // Store new Achievement in the database.
    public function storeAchievement(Request $request) {
        $validationRules = [
            'title' => 'required',
            'location_of_event' => 'required',
            'year' => 'required|integer|digits:4'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_CREATE_ACHIEVEMENT_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::firstOrCreate(
            ['user_id' => Auth::user()->id]);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate(
            [
                'candidate_detail_id' => $candidateDetail->id,
                'status' => 'pending'
            ]
        );

        $achievementChange = AchievementChange::create([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'title' => $validated['title'],
            'location_of_event' => $validated['location_of_event'],
            'year' => $validated['year'],
            'action' => 'create'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }

    // Store new Achievement in the database.
    public function storeHardskill(Request $request) {
        $validationRules = [
            'title' => 'required',
            'score' => 'required|integer|digits:1|min:1|max:10'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_CREATE_HARDSKILL_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::firstOrCreate(
            ['user_id' => Auth::user()->id]);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate(
            [
                'candidate_detail_id' => $candidateDetail->id,
                'status' => 'pending'
            ]
        );

        $hardskillChange = HardskillChange::create([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'title' => $validated['title'],
            'score' => $validated['score'],
            'action' => 'create'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }

    // Store new Achievement in the database.
    public function storeSoftskill(Request $request) {
        $validationRules = [
            'title' => 'required',
            'score' => 'required|integer|digits:1|min:1|max:10'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_CREATE_SOFTSKILL_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::firstOrCreate(
            ['user_id' => Auth::user()->id]);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate(
            [
                'candidate_detail_id' => $candidateDetail->id,
                'status' => 'pending'
            ]
        );

        $hardskillChange = SoftskillChange::create([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'title' => $validated['title'],
            'score' => $validated['score'],
            'action' => 'create'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }
}
