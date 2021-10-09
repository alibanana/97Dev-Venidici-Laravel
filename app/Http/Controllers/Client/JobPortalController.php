<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CandidateDetail;
use App\Models\CandidateDetailChange;
use App\Models\WorkExperience;
use App\Models\WorkExperienceChange;
use Jenssegers\Agent\Agent;

use App\Helper\Helper;
use App\Models\Review;

class JobPortalController extends Controller
{
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
        if(Auth::check()) {
            $this->resetNavbarData();
            $notifications = $this->notifications;
            $informations = $this->informations;
            $transactions = $this->transactions;
            $cart_count = $this->cart_count;
            return view('client/job-portal/company/index', compact('cart_count', 'notifications', 'transactions',
                'informations', 'footer_reviews', 'agent'));
        }
        
        return view('client/job-portal/company/index', compact('footer_reviews', 'agent'));
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

    // Upsert Basic Info
    public function upsert__basic_info_job_portal(Request $request){
        $agent = new Agent();

        $input = $request->all();

        $validationRules = [
            'linkedin_link'                 => 'required|starts_with:https://www.linkedin.com',
            'preferred_working_location'    => 'required',
            'whatsapp_number'               => 'required',
            'about_me_description'          => 'required',
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect('/candidate-details')->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        if ($agent->browser() != "Safari") {
            $birthdate = $validated['birth_date'];
        } else {
            // If browser is safari and bootcamp
            if($request['date_safari'] == null || $request['month'] == null || $request['year'] == null)
                return redirect('/candidate-details')
                    ->withInput($request->all())
                    ->with('date_message','The date field is required');
            
            $birthdate = $input['year'].'-'.$input['month'].'-'.$input['date_safari'];
        }
        
        $candidate_detail_count = CandidateDetail::where('user_id', auth()->user()->id)->first();

        $updateFlag = false;

        //if its the first time the user update their profile
        if(!$candidate_detail_count){
            $candidate_detail                               = new CandidateDetail;
            $candidate_detail->user_id                      = auth()->user()->id;
            $candidate_detail->preferred_working_location   = null;
            $candidate_detail->linkedin_link                = null;
            $candidate_detail->whatsapp_number              = null;
            $candidate_detail->about_me_description         = null;
            $candidate_detail->save();

            $candidate_detail_id = $candidate_detail->id;
        }

        else{
            $candidate_detail_id = $candidate_detail_count->id;
            $last_candidate_detail_changes_detail = CandidateDetailChange::where('candidate_detail_id',$candidate_detail_id)->orderBy('created_at','desc')->first();
            $last_candidate_detail_changes_detail->status == 'pending' && $updateFlag = true;

        }
        //if the user has pending changes, update the last content
        if($updateFlag){
            $last_candidate_detail_changes_detail->preferred_working_location   = $validated['preferred_working_location'];
            $last_candidate_detail_changes_detail->linkedin_link                = $validated['linkedin_link'];
            $last_candidate_detail_changes_detail->whatsapp_number              = $validated['whatsapp_number'];
            $last_candidate_detail_changes_detail->about_me_description         = $validated['about_me_description'];
            $last_candidate_detail_changes_detail->save();
        }
        //if the user has no pending changes, create a new one
        else{
            $candidate_detail_changes                               = new CandidateDetailChange;
            $candidate_detail_changes->candidate_detail_id          = $candidate_detail_id;
            $candidate_detail_changes->preferred_working_location   = $validated['preferred_working_location'];
            $candidate_detail_changes->linkedin_link                = $validated['linkedin_link'];
            $candidate_detail_changes->whatsapp_number              = $validated['whatsapp_number'];
            $candidate_detail_changes->about_me_description         = $validated['about_me_description'];
            $candidate_detail_changes->save();
        }

        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect()->back()->with('candidate_update_message', $message);
    }

    public function add__work_experience_job_portal(Request $request){
        $input = $request->all();

        $validationRules = [
            'company'       => 'required',
            'start_date'    => 'required|date_format:Y.m.d',
            'end_date'      => 'required|date_format:Y.m.d',
            'job_position'  => 'required',
            'location'      => 'required',
        ];

        $validator = Validator::make($request->all(), $validationRules);
        
        if ($validator->fails())
            return redirect('/candidate-details#we-create')->withErrors($validator)->withInput($request->all());

        $validated = $validator->validate();

        $candidate_detail_count = CandidateDetail::where('user_id', auth()->user()->id)->first();

        $updateFlag = false;

        //if its the first time the user update their profile
        if(!$candidate_detail_count){
            $candidate_detail                               = new CandidateDetail;
            $candidate_detail->user_id                      = auth()->user()->id;
            $candidate_detail->preferred_working_location   = null;
            $candidate_detail->linkedin_link                = null;
            $candidate_detail->whatsapp_number              = null;
            $candidate_detail->about_me_description         = null;
            $candidate_detail->save();

            $candidate_detail_id = $candidate_detail->id;
        }

        else{
            $candidate_detail_id = $candidate_detail_count->id;
        }

        $model = "";
        for ($i = 0; $i <= 2; $x++) {
            if(i){
                $work_experience = new WorkExperience;
                $work_experience->candidate_detail_id = $candidate_detail_id;

            }
            else{
                $work_experience = new WorkExperienceChange;
                $work_experience->candidate_detail_change_id = 'test';
                $work_experience->work_experience_id = 'test';
            }
            $work_experience->company = 'test';
            $work_experience->job_position = 'test';
            $work_experience->start_date = 'test';
            $work_experience->end_date = 'test';
            $work_experience->location = 'test';
        }         


        $message = 'Thank you! Your changes will be evaluated as soon as possible. We will let you know when its done.';
    
        return redirect()->back()->with('candidate_update_message', $message);
    }
}
