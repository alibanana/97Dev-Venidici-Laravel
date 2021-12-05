<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

use App\Helper\Helper;
use App\Helper\UserHelper;
use Illuminate\Support\Facades\Mail;

use App\Models\Review;
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

use App\Mail\NotifyAdminUpdateProfile;


class CandidateDetailController extends Controller
{

    private const INDEX_ROUTE = 'candidate-detail.index';
    
    private const INDEX_URL_WITH_CREATE_WORK_EXPERIENCE_MODAL = '/candidate-details#we-create';
    private const INDEX_URL_WITH_CREATE_EDUCATION_MODAL = '/candidate-details#edu-create';
    private const INDEX_URL_WITH_CREATE_ACHIEVEMENT_MODAL = '/candidate-details#achievement-create';
    private const INDEX_URL_WITH_CREATE_HARDSKILL_MODAL = '/candidate-details#hs-create';
    private const INDEX_URL_WITH_CREATE_SOFTSKILL_MODAL = '/candidate-details#ss-create';
    private const INDEX_URL_WITH_CREATE_INTEREST_MODAL = '/candidate-details#interest-create';

    private const INDEX_URL_WITH_UPDATE_WORK_EXPERIENCE_MODAL = '/candidate-details#we-update';
    private const INDEX_URL_WITH_UPDATE_EDUCATION_MODAL = '/candidate-details#edu-update';
    private const INDEX_URL_WITH_UPDATE_ACHIEVEMENT_MODAL = '/candidate-details#achievement-update';
    private const INDEX_URL_WITH_UPDATE_HARDSKILL_MODAL = '/candidate-details#hs-update';
    private const INDEX_URL_WITH_UPDATE_SOFTSKILL_MODAL = '/candidate-details#ss-update';
    private const INDEX_URL_WITH_UPDATE_INTEREST_MODAL = '/candidate-details#interest-update';

    private const BOOTCAMP_CV_PATH = 'storage/documents/bootcamp/cv/';
    
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
                ->with('workExperiences', 'educations', 'achievements', 'hardskills', 'softskills')
                ->first();

            $candidate_detail_change = CandidateDetailChange::where('candidate_detail_id', $candidate_detail->id)
                ->where('status', 'pending')
                ->with('candidateDetail', 'workExperienceChanges', 'educationChanges', 'achievementChanges', 'hardskillChanges',
                    'softskillChanges', 'interestChanges')
                ->latest()
                ->first();

            $updatedWorkExperienceIds = UserHelper::getUpdatedWorkExperienceIds($candidate_detail_change);
            $work_experiences_not_updated = WorkExperience::where('candidate_detail_id', $candidate_detail->id)->get()
                ->filter(function ($workExperience) use ($updatedWorkExperienceIds) {
                    return !in_array($workExperience->id, $updatedWorkExperienceIds);
                });

            $updatedEducationIds = UserHelper::getUpdatedEducationIds($candidate_detail_change);
            $educations_not_updated = Education::where('candidate_detail_id', $candidate_detail->id)->get()
                ->filter(function ($education) use ($updatedEducationIds) {
                    return !in_array($education->id, $updatedEducationIds);
                });

            $updatedAchievementIds = UserHelper::getUpdatedAchievementIds($candidate_detail_change);
            $achievements_not_updated = Achievement::where('candidate_detail_id', $candidate_detail->id)->get()
                ->filter(function ($achievement) use ($updatedAchievementIds) {
                    return !in_array($achievement->id, $updatedAchievementIds);
                });

            $updatedHardskillIds = UserHelper::getUpdatedHardskillIds($candidate_detail_change);
            $hardskills_not_updated = Hardskill::where('candidate_detail_id', $candidate_detail->id)->get()
                ->filter(function ($hardskill) use ($updatedHardskillIds) {
                    return !in_array($hardskill->id, $updatedHardskillIds);
                });

            $updatedSoftskillIds = UserHelper::getUpdatedSoftskillIds($candidate_detail_change);
            $softskills_not_updated = Softskill::where('candidate_detail_id', $candidate_detail->id)->get()
                ->filter(function ($softskill) use ($updatedSoftskillIds) {
                    return !in_array($softskill->id, $updatedSoftskillIds);
                });

            $updatedInterestIds = UserHelper::getUpdatedInterestIds($candidate_detail_change);
            $interests_not_updated = Interest::where('candidate_detail_id', $candidate_detail->id)->get()
                ->filter(function ($interest) use ($updatedInterestIds) {
                    return !in_array($interest->id, $updatedInterestIds);
                });

            $isCandidatePending = UserHelper::isCandidatePending(Auth::user());

            $view_data = array_merge($view_data, ['candidate_detail', 'candidate_detail_change', 'work_experiences_not_updated',
            'educations_not_updated', 'achievements_not_updated', 'hardskills_not_updated', 'softskills_not_updated', 'interests_not_updated',
            'isCandidatePending']);
        }
        
        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $isCandidateDetailUpdated = !UserHelper::isCandidateNotUpdated(Auth::user());

        $view_data = array_merge($view_data, ['cart_count', 'notifications', 'transactions', 'informations', 'footer_reviews', 'agent', 'isCandidateDetailUpdated']);

        return view('client/job-portal/client/edit', compact($view_data));
    }

    public function show_profile(){
        $agent = new Agent();
        $footer_reviews = Review::orderBy('created_at','desc')->get()->take(2);
        
        $view_data = [];
        if (Auth::user()->candidateDetail()->exists()) {
            $candidate_detail = CandidateDetail::where('user_id', Auth::user()->id)
                ->with('workExperiences', 'educations', 'achievements', 'hardskills', 'softskills')
                ->first();

            $score = UserHelper::getHighestScoreFromCandidateDetail($candidate_detail);

            $view_data = array_merge($view_data, ['candidate_detail', 'score']);
        } else{
            return redirect()->route(self::INDEX_ROUTE);
        }
        
        $this->resetNavbarData();
        $notifications = $this->notifications;
        $informations = $this->informations;
        $transactions = $this->transactions;
        $cart_count = $this->cart_count;

        $isCandidateDetailUpdated = UserHelper::isCandidateNotUpdated(Auth::user());

        $view_data = array_merge($view_data, ['cart_count', 'notifications', 'transactions', 'informations', 'footer_reviews', 'agent']);

        return view('client/job-portal/client/bootcamp-profile', compact($view_data));
    }

    // Store / Update a user's candidate profile details.
    public function upsertCandidateDetail(Request $request) {
        $validationRules = [
            'linkedin_link' => 'required|starts_with:https://www.linkedin.com',
            'preferred_working_location' => 'required',
            'whatsapp_number' => 'required',
            'about_me_description' => 'required',
            'experience_year' => 'required',
            'industry' => 'required',
            'cv_file' => 'mimes:pdf',
        ];

        if (UserHelper::isCandidateDetailEmpty(Auth::user())) {
            $validationRules['cv_file'] = 'required|mimes:pdf';
        } 

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
                'about_me_description' => $validated['about_me_description'],
                'experience_year' => $validated['experience_year'],
                'industry' => $validated['industry'],
                'cv_file' => $request->has('cv_file') ?
                    Helper::storeFile($request->file('cv_file'), self::BOOTCAMP_CV_PATH) : null
            ]
        );

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

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
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_CREATE_WORK_EXPERIENCE_MODAL)->with('work_experience_create_message', $message);

    }

    // Create new workExperienceChange to edit an existing WorkExperience object.
    public function updateWorkExperience(Request $request, $work_experience_id) {
        $workExperience = WorkExperience::findOrFail($work_experience_id);

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
            return redirect(self::INDEX_URL_WITH_UPDATE_WORK_EXPERIENCE_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::findOrFail($workExperience->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $workExperienceChange = WorkExperienceChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'work_experience_id' => $workExperience->id,
            'action' => 'update'
        ], [
            'company' => $validated['company'],
            'job_position' => $validated['job_position'],
            'start_date' => $validated['start_date'],
            'end_date' => array_key_exists('end_date', $validated) ?
                $validated['end_date'] : null,
            'location' => $validated['location']
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_UPDATE_WORK_EXPERIENCE_MODAL)->with('work_experience_update_message', $message);
    }

    // Update an existing WorkExperienceChange object. Only WorkExperienceChange which action are either
    // create or update can be updated.
    public function updateWorkExperienceChange(Request $request, $work_experience_change_id) {
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
            return redirect(self::INDEX_URL_WITH_UPDATE_WORK_EXPERIENCE_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $workExperienceChange = WorkExperienceChange::where('id', $work_experience_change_id)
            ->whereIn('action', ['create', 'update'])
            ->update([
                'company' => $validated['company'],
                'job_position' => $validated['job_position'],
                'start_date' => $validated['start_date'],
                'end_date' => array_key_exists('end_date', $validated) ?
                    $validated['end_date'] : null,
                'location' => $validated['location']
            ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect(self::INDEX_URL_WITH_UPDATE_WORK_EXPERIENCE_MODAL)->with('work_experience_update_message', $message);
    }

    // Create new workExperienceChange to delete an existing WorkExperience object.
    public function deleteWorkExperience($work_experience_id) {
        $workExperience = WorkExperience::findOrFail($work_experience_id);

        $candidateDetail = CandidateDetail::findOrFail($workExperience->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $workExperienceChange = WorkExperienceChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'work_experience_id' => $workExperience->id,
            'action' => 'delete'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

    }

    // Delete an existing WorkExperienceChange object
    public function cancelWorkExperienceChange($work_experience_change_id) {
        $workExperienceChange = WorkExperienceChange::where('id', $work_experience_change_id)
            ->whereIn('action', ['create', 'update', 'delete'])
            ->with('candidateDetailChange')
            ->firstOrFail();

        $candidateDetailChange = $workExperienceChange->candidateDetailChange;

        $workExperienceChange->delete();

        if (UserHelper::isCandidateDetailChangeDataAndRelationshipEmpty($candidateDetailChange)) {
            $candidateDetailChange->delete();
        }

        $message = 'Thank you! Your changes have been cancelled.';
    
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
                $validated['end_year'] : null,
            'action' => 'create'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_CREATE_EDUCATION_MODAL)->with('education_create_message', $message);
    }

    // Create new educationChange to edit an existing Education object.
    public function updateEducation(Request $request, $education_id) {
        $education = Education::findOrFail($education_id);

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
            return redirect()->route(self::INDEX_URL_WITH_UPDATE_EDUCATION_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::findOrFail($education->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $educationChange = EducationChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'education_id' => $education->id,
            'action' => 'update'
        ], [
            'degree' => $validated['degree'],
            'school' => $validated['school'],
            'major' => $validated['major'],
            'start_year' => $validated['start_year'],
            'end_year' => array_key_exists('end_year', $validated) ?
                $validated['end_year'] : null
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_UPDATE_EDUCATION_MODAL)->with('education_update_message', $message);
    }

    // Update existing EducationChange object.
    public function updateEducationChange(Request $request, $education_change_id) {
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
            return redirect(self::INDEX_URL_WITH_UPDATE_EDUCATION_MODAL)->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $educationCange = EducationChange::where('id', $education_change_id)
            ->whereIn('action', ['create', 'update'])
            ->update([
                'degree' => $validated['degree'],
                'school' => $validated['school'],
                'major' => $validated['major'],
                'start_year' => $validated['start_year'],
                'end_year' => array_key_exists('end_year', $validated) ?
                    $validated['end_year'] : null,
            ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect(self::INDEX_URL_WITH_UPDATE_EDUCATION_MODAL)->with('education_update_message', $message);
    }

    // Create new educationChange to delete an existing Education object.
    public function deleteEducation($education_id) {
        $education = Education::findOrFail($education_id);

        $candidateDetail = CandidateDetail::findOrFail($education->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $educationChange = EducationChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'education_id' => $education->id,
            'action' => 'delete'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }

    // Cancel existing EducationChange object.
    public function cancelEducationChange($education_change_id) {
        $educationChange = EducationChange::where('id', $education_change_id)
            ->whereIn('action', ['create', 'update', 'delete'])
            ->firstOrFail();

        $candidateDetailChange = $educationChange->candidateDetailChange;

        $educationChange->delete();

        if (UserHelper::isCandidateDetailChangeDataAndRelationshipEmpty($candidateDetailChange)) {
            $candidateDetailChange->delete();
        }

        $message = 'Thank you! Your changes have been cancelled.';
    
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
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_CREATE_ACHIEVEMENT_MODAL)->with('achievement_create_message', $message);
    }

    // Create new achievementChange to edit an existing Achievement object.
    public function updateAchievement(Request $request, $achievement_id) {
        $achievement = Achievement::findOrFail($achievement_id);

        $validationRules = [
            'title' => 'required',
            'location_of_event' => 'required',
            'year' => 'required|integer|digits:4'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect()->route(self::INDEX_URL_WITH_UPDATE_ACHIEVEMENT_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::findOrFail($achievement->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $achievementChange = AchievementChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'achievement_id' => $achievement->id,
            'action' => 'update'
        ], [
            'title' => $validated['title'],
            'location_of_event' => $validated['location_of_event'],
            'year' => $validated['year']
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_UPDATE_ACHIEVEMENT_MODAL)->with('achievement_update_message', $message);
    }

    // Update existing AchivementChange object in the database.
    public function updateAchievementChange(Request $request, $achievement_change_id) {
        $validationRules = [
            'title' => 'required',
            'location_of_event' => 'required',
            'year' => 'required|integer|digits:4'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect()->route(self::INDEX_URL_WITH_UPDATE_ACHIEVEMENT_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $achievementChange = AchievementChange::where('id', $achievement_change_id)
            ->whereIn('action', ['create', 'update'])
            ->update([
                'title' => $validated['title'],
                'location_of_event' => $validated['location_of_event'],
                'year' => $validated['year']
            ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect(self::INDEX_URL_WITH_UPDATE_ACHIEVEMENT_MODAL)->with('achievement_update_message', $message);
    }

    // Create new achievementChange to delete an existing Achievement object.
    public function deleteAchievement($achievement_id) {
        $achievement = Achievement::findOrFail($achievement_id);

        $candidateDetail = CandidateDetail::findOrFail($achievement->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $achievementChange = AchievementChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'achievement_id' => $achievement->id,
            'action' => 'delete'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }

    // Cancel existing AchievementChange object.
    public function cancelAchievementChange($achievement_change_id) {
        $achievementChange = AchievementChange::where('id', $achievement_change_id)
            ->whereIn('action', ['create', 'update', 'delete'])
            ->firstOrFail();

        $candidateDetailChange = $achievementChange->candidateDetailChange;

        $achievementChange->delete();

        if (UserHelper::isCandidateDetailChangeDataAndRelationshipEmpty($candidateDetailChange)) {
            $candidateDetailChange->delete();
        }

        $message = 'Thank you! Your changes have been cancelled.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('candidate_update_message', $message);
    }

    // Store new Achievement in the database.
    public function storeHardskill(Request $request) {
        $validationRules = [
            'title' => 'required',
            'score' => 'required|integer|min:1|max:10'
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
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_CREATE_HARDSKILL_MODAL)->with('hard_skills_create_message', $message);
    }

    // Create new hardskillChange to edit an existing Hardskill object.
    public function updateHardskill(Request $request, $hardskill_id) {
        $hardskill = Hardskill::findOrFail($hardskill_id);

        $validationRules = [
            'title' => 'required',
            'score' => 'required|integer|min:1|max:10'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_UPDATE_HARDSKILL_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::findOrFail($hardskill->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $hardskillChange = HardskillChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'hardskill_id' => $hardskill->id,
            'action' => 'update'
        ], [
            'title' => $validated['title'],
            'score' => $validated['score']
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_UPDATE_HARDSKILL_MODAL)->with('hardskill_update_message', $message);
    }

    // Method to update existing HardskillChange object in the database.
    public function updateHardskillChange(Request $request, $hardskill_change_id) {
        $validationRules = [
            'title' => 'required',
            'score' => 'required|integer|min:1|max:10'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_UPDATE_HARDSKILL_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $hardskillChange = HardskillChange::where('id', $hardskill_change_id)
            ->whereIn('action', ['create', 'update'])
            ->update([
                'title' => $validated['title'],
                'score' => $validated['score']
            ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect(self::INDEX_URL_WITH_UPDATE_HARDSKILL_MODAL)->with('hardskill_update_message', $message);
    }

    // Create new hardskillChange to delete an existing Hardskill object.
    public function deleteHardskill($hardskill_id) {
        $hardskill = Hardskill::findOrFail($hardskill_id);

        $candidateDetail = CandidateDetail::findOrFail($hardskill->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $hardskillChange = HardskillChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'hardskill_id' => $hardskill->id,
            'action' => 'delete'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect()->route(self::INDEX_ROUTE)->with('hardskill_update_message', $message);
    }

    // Cancel existing HardskillChange object.
    public function cancelHardskillChange($hardskill_change_id) {
        $hardskillChange = HardskillChange::where('id', $hardskill_change_id)
            ->whereIn('action', ['create', 'update', 'delete'])
            ->firstOrFail();

        $candidateDetailChange = $hardskillChange->candidateDetailChange;

        $hardskillChange->delete();

        if (UserHelper::isCandidateDetailChangeDataAndRelationshipEmpty($candidateDetailChange)) {
            $candidateDetailChange->delete();
        }

        $message = 'Thank you! Your changes have been cancelled.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('hardskill_update_message', $message);
    }

    // Store new Achievement in the database.
    public function storeSoftskill(Request $request) {
        $validationRules = [
            'title' => 'required',
            'score' => 'required|integer|min:1|max:10'
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
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_CREATE_SOFTSKILL_MODAL)->with('soft_skills_create_message', $message);
    }

    // Create new softskillChange to edit an existing Softskill object.
    public function updateSoftskill(Request $request, $softskill_id) {
        $softskill = Softskill::findOrFail($softskill_id);

        $validationRules = [
            'title' => 'required',
            'score' => 'required|integer|min:1|max:10'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect()->route(self::INDEX_URL_WITH_UPDATE_SOFTSKILL_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::findOrFail($softskill->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $softskillChange = SoftskillChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'softskill_id' => $softskill->id,
            'action' => 'update'
        ], [
            'title' => $validated['title'],
            'score' => $validated['score']
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_UPDATE_SOFTSKILL_MODAL)->with('softskill_update_message', $message);
    }

    // Method to update existing SoftskillChange in the database.
    public function updateSoftskillChange(Request $request, $softskill_change_id) {
        $validationRules = [
            'title' => 'required',
            'score' => 'required|integer|min:1|max:10'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_UPDATE_SOFTSKILL_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $softskillChange = SoftskillChange::where('id', $softskill_change_id)
            ->whereIn('action', ['create', 'update'])
            ->update([
                'title' => $validated['title'],
                'score' => $validated['score']
            ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect(self::INDEX_URL_WITH_UPDATE_SOFTSKILL_MODAL)->with('softskill_update_message', $message);
    }

    // Create new softskillChange to delete an existing Softskill object.
    public function deleteSoftskill($softskill_id) {
        $softskill = Softskill::findOrFail($softskill_id);

        $candidateDetail = CandidateDetail::findOrFail($softskill->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $softskillChange = SoftskillChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'softskill_id' => $softskill->id,
            'action' => 'delete'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect()->route(self::INDEX_ROUTE)->with('softskill_update_message', $message);
    }

    // Cancel existing SoftskillChange object.
    public function cancelSoftskillChange($softskill_change_id) {
        $softskillChange = SoftskillChange::where('id', $softskill_change_id)
            ->whereIn('action', ['create', 'update', 'delete'])
            ->firstOrFail();

        $candidateDetailChange = $softskillChange->candidateDetailChange;

        $softskillChange->delete();

        if (UserHelper::isCandidateDetailChangeDataAndRelationshipEmpty($candidateDetailChange)) {
            $candidateDetailChange->delete();
        }

        $message = 'Thank you! Your changes have been cancelled.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('softskill_update_message', $message);
    }

    // Store new Interest in the database.
    public function storeInterest(Request $request) {
        $validationRules = [
            'title' => 'required'
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect(self::INDEX_URL_WITH_CREATE_INTEREST_MODAL)
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

        $hardskillChange = InterestChange::create([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'title' => $validated['title'],
            'action' => 'create'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_CREATE_INTEREST_MODAL)->with('interests_create_message', $message);
    }

    // Create new interestChange to edit an existing Interest object.
    public function updateInterest(Request $request, $interest_id) {
        $interest = Interest::findOrFail($interest_id);
        
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);
        
        if ($validator->fails())
            return redirect()->route(self::INDEX_URL_WITH_UPDATE_INTEREST_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidateDetail = CandidateDetail::findOrFail($interest->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $interestChange = InterestChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'interest_id' => $interest->id,
            'action' => 'update'
        ], [
            'title' => $validated['title']
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect(self::INDEX_URL_WITH_UPDATE_INTEREST_MODAL)->with('interest_update_message', $message);
    }

    // Method to update existing InterestChange object in the database.
    public function updateInterestChange(Request $request, $interest_change_id) {
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);
        
        if ($validator->fails())
            return redirect()->route(self::INDEX_URL_WITH_UPDATE_INTEREST_MODAL)
                ->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $interestChange = InterestChange::where('id', $interest_change_id)
            ->whereIn('action', ['create', 'update'])
            ->update([
                'title' => $validated['title']
            ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect(self::INDEX_URL_WITH_UPDATE_INTEREST_MODAL)->with('interest_update_message', $message);
    }

    // Create new interestChange to delete an existing Interest object.
    public function deleteInterest($interest_id) {
        $interest = Interest::findOrFail($interest_id);

        $candidateDetail = CandidateDetail::findOrFail($interest->candidate_detail_id);

        $candidateDetailChange = CandidateDetailChange::firstOrCreate([
            'candidate_detail_id' => $candidateDetail->id,
            'status' => 'pending'
        ]);

        $interestChange = InterestChange::firstOrCreate([
            'candidate_detail_change_id' => $candidateDetailChange->id,
            'interest_id' => $interest->id,
            'action' => 'delete'
        ]);

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
        Mail::to(env('BOOTCAMP_ADMIN_EMAIL'))->send(new NotifyAdminUpdateProfile($candidateDetail->user->name));

        return redirect()->route(self::INDEX_ROUTE)->with('interest_update_message', $message);
    }

    // Cancel existing InterestChange object.
    public function cancelInterestChange($interest_change_id) {
        $interestChange = InterestChange::where('id', $interest_change_id)
            ->whereIn('action', ['create', 'update', 'delete'])
            ->firstOrFail();

        $candidateDetailChange = $interestChange->candidateDetailChange;

        $interestChange->delete();

        if (UserHelper::isCandidateDetailChangeDataAndRelationshipEmpty($candidateDetailChange)) {
            $candidateDetailChange->delete();
        }

        $message = 'Thank you! Your changes have been cancelled.';
    
        return redirect()->route(self::INDEX_ROUTE)->with('interest_update_message', $message);
    }
}
