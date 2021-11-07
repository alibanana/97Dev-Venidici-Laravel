@extends('./layouts/client-main')
@section('title', 'Venidici Candidate Details')

@section('content')

<!-- start of candidate detail form -->

<form action="{{route('candidate-detail.upsert-candidate-detail')}}" method="POST" enctype="multipart/form-data">
@csrf
<!-- Modal VA -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-body" style="text-align:center">
            <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA">Update Job Portal Profile?</p>
            <p class="normal-text" style="font-family:Rubik Medium;color:#000000;margin-bottom:2vw">Admin approval will be processed within 1 x 24 hours</p>
            <button onclick="openLoading()" type="submit" class="normal-text btn-blue-bordered btn-blue-bordered-active full-width-button" style="font-family: Avenir Medium;cursor:pointer;padding:0.5vw 2vw">Confirm</button>                
            <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-top:1vw">OR</p>
            <p class="normal-text" style="font-family:Rubik Medium;color:grey;margin-top:1vw;cursor:pointer" data-dismiss="modal" >Cancel</p>
        </div>
        </div>
    </div>
</div>
<!-- END OF MODAL VA -->

<!-- START OF BASIC INFO SECTION -->
<div class="row m-0 page-container-inner" style="padding-top:14vw !important;">
    <div class="col-12 wow bounce p-0 warning-height-candidate-details" style="height:3.5vw;display:flex;justify-content:center">
        <!-- ALERT MESSAGE -->
        <div class="alert alert-warning alert-dismissible fade show small-text"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
            Jangan lupa untuk isi form ini dengan lengkap (Interest dan Achievement Optional), agar profil mu bisa terlihat oleh Hiring Partner Venidici.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
    <div class="col-12 p-0" style="margin-top:2vw">
        @if(session('candidate_update_message'))
            <!-- ALERT MESSAGE -->
            <div style="text-align:center;margin-top:1vw">
                <div class="alert alert-success alert-dismissible fade show small-text alert-message-success"  style="text-align:center;margin-bottom:1vw;"role="alert">
                {{ session('candidate_update_message') }}
                    <button type="button" class="btn-close close-btn-edit-popup-mobile" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <!-- END OF ALERT MESSAGE -->
        @endif
        <p class="medium-heading" style="font-family:Rubik Bold;color:#2B6CAA">Basic Info</p>
    </div>
    <!-- START OF LEFT SECTION -->
    <div class="col-lg-6 col-xs-12 ps-0  mpr-0">
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fas fa-user"></i>
            <input readonly type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                placeholder="Masukkan nama" value="{{ old('name', Auth::user()->name) }}">
        </div>  
        @error('name')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Date of Birth</p>
        <?php
            if (Auth::user()->userDetail->birthdate != null) {
                $birthdate = explode(' ', Auth::user()->userDetail->birthdate);
                $date = $birthdate[0];
                $time = $birthdate[1];
            }
        ?>
        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
            <input type="date" class="normal-text"
                style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%;"
                placeholder="yyyy-mm-dd" value="{{ $date }}" readonly>
        </div>

        @if(session('date_message'))
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ session('date_message') }}</strong>
            </span>
        @endif
        @error('birth_date')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror

        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Linked In</p>
        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fab fa-linkedin"></i>
            @if ($isCandidateDetailUpdated)
                <input value="{{old('linkedin_link', $isCandidatePending && $candidate_detail_change->linkedin_link != null ? $candidate_detail_change->linkedin_link : $candidate_detail->linkedin_link)}}" type="text" name="linkedin_link" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Link Linked In">
            @else
                <input type="text" name="linkedin_link" value="{{ old('linkedin_link') }}" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Link Linked In">
            @endif
        </div>
        @error('linkedin_link')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div> 
    <!-- END OF LEFT SECTION --> 
    <!-- START OF RIGHT SECTION-->
    <div class="col-lg-6 col-xs-12 pe-0  mpl">
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
            <input readonly type="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan email"
            @if(Auth::check())
                value="{{old('email', Auth::user()->email)}}"
            @else
                value="{{old('email')}}"
            @endif
            >
        </div>  
        @error('email')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Prefered Working Location (Province)</p>
        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fas fa-map"></i>
            @if ($isCandidateDetailUpdated)
                <input value="{{old('preferred_working_location', $isCandidatePending && $candidate_detail_change->preferred_working_location != null ? $candidate_detail_change->preferred_working_location : $candidate_detail->preferred_working_location)}}"  name="preferred_working_location" type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="DKI Jakarta, Kalimantan, Sumatra">
            @else
                <input name="preferred_working_location" value="" type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="DKI Jakarta, Kalimantan, Sumatra">
            @endif
        </div>  
        @error('preferred_working_location')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Whatsapp</p>
        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fab fa-whatsapp"></i>
            <input name="whatsapp_number" type="text" class="normal-text" placeholder="Masukkan Nomor Telepon"
                style="background:transparent;border:none;margin-left:1vw;color:#3B3C43;width:100%"
                @if ($isCandidateDetailUpdated)
                    value="{{ old('whatsapp_number', $isCandidatePending && $candidate_detail_change->whatsapp_number != null ? $candidate_detail_change->whatsapp_number : $candidate_detail->whatsapp_number) }}">
                @else
                    value="{{ old('whatsapp_number', Auth::user()->userDetail->telephone) }}">
                @endif
        </div>  
        @error('whatsapp_number')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div> 
    <!-- END OF RIGHT SECTION--> 
</div>
<!-- END OF BASIC INFO SECTION -->

<!-- START OF EXPERIENCE -->
<div class="row m-0 page-container-inner" style="padding-top:4vw">
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family:Rubik Bold;color:#2B6CAA">What’s your experience?</p>
    </div>
    <div class="col-lg-6 col-xs-12 ps-0 mpr-0">
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Experience</p>
        <div  class="auth-input-form" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fas fa-user popup-krest-font"></i>
            <select name="experience_year" id="" class="normal-text"  style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%">
                <option disabled selected>Choose Answer</option>
                @php
                    $experience = null;
                    if ($isCandidateDetailUpdated) {
                        $experience = $isCandidatePending && $candidate_detail_change->experience_year != null ? $candidate_detail_change->experience_year : $candidate_detail->experience_year;
                    }
                @endphp
                <option value="Less than 1 Year of Experience" @if($experience == 'Less than 1 Year of Experience') selected @endif> < 1 Year of Experience</option>
                <option value="Less than 2 Years of Experience" @if($experience == 'Less than 2 Years of Experience') selected @endif> < 2 Years of Experience</option>
                <option value="Less than 3 Years of Experience" @if($experience == 'Less than 3 Years of Experience') selected @endif> < 3 Years of Experience</option>
                <option value="More than 3 Years of Experience" @if($experience == 'More than 3 Years of Experience') selected @endif> > 3 Years of Experience</option>
            </select>
        </div> 
        @error('experience_year')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror 
    </div>
    <div class="col-lg-6 col-xs-12 pe-0 mpl">
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Industry</p>
        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fas fa-building"></i>
            @if ($isCandidateDetailUpdated)
                <input value="{{old('industry', $isCandidatePending && $candidate_detail_change->industry != null ? $candidate_detail_change->industry : $candidate_detail->industry)}}"  type="text" name="industry" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Industri Pekerjaan" >
            @else
                <input value="{{ old('industry') }}"  type="text" name="industry" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Industri Pekerjaan">
            @endif
        </div>   
        @error('industry')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- END OF EXPERIENCE -->

<!-- START OF RESUME -->
<div class="row m-0 page-container-inner" style="padding-top:4vw">
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family:Rubik Bold;color:#2B6CAA">Resume</p>
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">About me</p>
        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
            @if ($isCandidateDetailUpdated)
                <textarea name="about_me_description" value="{{old('about_me_description', $isCandidatePending && $candidate_detail_change->about_me_description != null ? $candidate_detail_change->about_me_description : $candidate_detail->about_me_description)}}" rows="6" class="normal-text" style="background:transparent;border:none;color:#3B3C43;width:100%" placeholder="This is an example." >{{old('about_me_description', $isCandidatePending && $candidate_detail_change->about_me_description != null ? $candidate_detail_change->about_me_description : $candidate_detail->about_me_description)}}</textarea>
            @else
                <textarea name="about_me_description" value="{{ old('about_me_description') }}" rows="6" class="normal-text" style="background:transparent;border:none;color:#3B3C43;width:100%" placeholder="This is an example.">{{ old('about_me_description') }}</textarea>
            @endif
        </div>  
        @error('about_me_description')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-12 p-0">
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">CV / Resume</p>
        @php
            $cv_file = null;
            if ($isCandidateDetailUpdated) {
                $cv_file = $isCandidatePending && $candidate_detail_change->cv_file != null ? $candidate_detail_change->cv_file : $candidate_detail->cv_file;
            }
        @endphp

        @if($cv_file != null)
        <div style="margin-bottom:2vw">
            <a href="{{ $cv_file }}" target="_blank" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;">View my current CV</a>
        </div>
        @endif
        <div class="drop-zone">
            <span class="drop-zone__prompt cv-mobile-font-size" style="font-family:Rubik Regular;color:black;font-size:1.7vw"> <span style="color:#3F92D8" >Upload a file</span> or drag and drop here</span>
            <input type="file"  name="cv_file" class="drop-zone__input" accept=".pdf">
        </div>
        <!--<input type="file">-->
        @error('cv_file')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- END OF RESUME -->

</form>
<div class="row m-0 page-container-inner" style="padding-top:4vw">
    <div class="col-12 p-0" style="display:flex;justify-content:flex-end;align-items:center">
        <button  data-toggle="modal" data-target="#confirmModal" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Update Profile</button>
    </div>
</div>
<!-- end of candidate detail form -->


<!-- START OF POP UP WORK EXPERIENCE CREATE -->
<div id="we-create" class="overlay" style="overflow:scroll">
    <div class="popup" id="mobile-popup-candidate-detail" style="width:65%">
        <a class="close" id="mobile-popup-candidate-detail-close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            <form action="{{ route('candidate-detail.store-work-experience') }}" method="POST">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Work Experience</p>
                        @if (session()->has('work_experience_create_message'))
                            <div class="p-3 mt-2 mb-0">
                                <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert">
                                    {{ session()->get('work_experience_create_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Company</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="company" value="{{ old('company') }}" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="PT. John Doe" >
                        </div>
                        @error('company')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Start Date</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="start_date" value="{{ old('start_date') }}" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy-mm-dd">
                                </div>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">End Date</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="end_date"  value="{{ old('end_date') }}" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy-mm-dd">
                                </div>
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:0.5vw;color:orange">(Leave Blank if still active)</p>

                                @error('end_date')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Job Position</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="job_position" value="{{ old('job_position') }}"  type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Sales Manager" >
                        </div>  
                        @error('job_position')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Location</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="location" value="{{ old('location') }}"  type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="DKI Jakarta" >
                        </div>  
                        @error('location')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue " style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP WORK EXPERIENCE CREATE -->

<!-- START OF POP UP WORK EXPERIENCE UPDATE -->
<div id="we-update" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">

            <form id="workExperienceForm" action="" method="POST">
            @csrf
            @method('put')
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Work Experience</p>

                        @if (session()->has('work_experience_update_message'))
                            <div class="p-3 mt-2 mb-0">
                                <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                                {{ session()->get('work_experience_update_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Company</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="company" id="workExperienceCompany" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="PT. John Doe" >
                        </div>  
                        @error('company')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Start Date</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="start_date" id="workExperienceStart_date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy-mm-dd">
                                </div> 
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">End Date</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="end_date" id="workExperienceEnd_date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy-mm-dd">
                                </div> 
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Job Position</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="job_position" id="workExperienceJob_position" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Sales Manager" >
                        </div>  
                        @error('job_position')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Location</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="location" id="workExperienceLocation" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="DKI Jakarta" >
                        </div>  
                        @error('location')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP WORK EXPERIENCE UPDATE -->


<!-- START OF Work Experience -->
<div class="row m-0 page-container-inner" style="padding-bottom:5vw;padding-top:4vw">
    <div class="col-12 p-0" style="display:flex;justify-content:space-between;align-items:center">
        <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Work Experience</p>
        <a href="#we-create"  style="color:#2B6CAA">
            <i class="fas fa-plus-circle small-heading"></i>
        </a>
    </div>
    <div class="col-12 p-0">
        <!-- START OF ONE CARD
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">Product Manager Intern (EXAMPLE)</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">PT. Global Digital Niaga (Blibli.com)</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2021 - Until now</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#we-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        END OF ONE CARD -->
        @isset($work_experiences_not_updated)
            @foreach ($work_experiences_not_updated as $workExperience)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    <div>   
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperience->job_position }}</p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperience->company }}</p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $workExperience->start_date }} - {{ $workExperience->end_date ?? 'Until Now' }}</p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">{{ $workExperience->location }}</p>
                    </div>
                    <div style="display:flex;align-items:center">
                        <a  href="#we-update"  style="color:#2B6CAA">
                            <i onclick="passWorkExperience('{{ $workExperience->company }}', '{{$workExperience->job_position}}', '{{$workExperience->start_date}}', '{{$workExperience->end_date}}', '{{$workExperience->location}}', '{{route('candidate-detail.update-work-experience', $workExperience->id)}}' )" class="fas fa-edit bigger-text"></i>
                        </a>
                        <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.delete-work-experience', $workExperience->id)}}"> 
                        @csrf
                        @method('delete')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                        </form>
                    </div>
                </div>
            @endforeach
        @endisset
       
        @isset($candidate_detail_change->workExperienceChanges)
            @foreach ($candidate_detail_change->workExperienceChanges as $workExperienceChange)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    @if ($workExperienceChange->action == 'create')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperienceChange->job_position }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperienceChange->company }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $workExperienceChange->start_date }} - {{ $workExperienceChange->end_date ?? 'Until Now' }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">{{ $workExperienceChange->location }}</p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#we-update" style="color:#2B6CAA">
                                <i onclick="passWorkExperience('{{ $workExperienceChange->company }}', '{{$workExperienceChange->job_position}}', '{{$workExperienceChange->start_date}}', '{{$workExperienceChange->end_date}}', '{{$workExperienceChange->location}}', '{{route('candidate-detail.update-work-experience-change', $workExperienceChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-work-experience-change', $workExperienceChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($workExperienceChange->action == 'update')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Old</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperienceChange->workExperience->job_position }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperienceChange->workExperience->company }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $workExperienceChange->workExperience->start_date }} - {{ $workExperienceChange->workExperience->end_date ?? 'Until Now' }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">{{ $workExperienceChange->workExperience->location }}</p>
                            <br>
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">Updated</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperienceChange->job_position }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperienceChange->company }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $workExperienceChange->start_date }} - {{ $workExperienceChange->end_date ?? 'Until Now' }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">{{ $workExperienceChange->location }}</p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#we-update" style="color:#2B6CAA">
                                <i onclick="passWorkExperience('{{ $workExperienceChange->company }}', '{{$workExperienceChange->job_position}}', '{{$workExperienceChange->start_date}}', '{{$workExperienceChange->end_date}}', '{{$workExperienceChange->location}}', '{{route('candidate-detail.update-work-experience-change', $workExperienceChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-work-experience-change', $workExperienceChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($workExperienceChange->action == 'delete')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Delete</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperienceChange->workExperience->job_position }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperienceChange->workExperience->company }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $workExperienceChange->workExperience->start_date }} - {{ $workExperienceChange->workExperience->end_date ?? 'Until Now' }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">{{ $workExperienceChange->workExperience->location }}</p>
                        </div>
                        <div style="display:flex;align-items:center">
                        </div>
                    @endif
                </div>
            @endforeach
        @endisset
    </div>
</div>
<!-- END OF Work Experience -->

<!-- START OF POP UP EDUCATION CREATE -->
<div id="edu-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="{{ route('candidate-detail.store-education') }}" method="POST">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Education</p>

                        @if (session()->has('education_create_message'))
                        <div class="p-3 mt-2 mb-0 ps-0 pe-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('education_create_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Degree</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="degree"  value="{{ old('degree') }}"  type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="High School Diploma" >
                        </div>  
                        @error('degree')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Major</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="major"  value="{{ old('major') }}" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Bisnis Informatik" >
                        </div>  
                        @error('major')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">School</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="school"  value="{{ old('school') }}"  type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="SMAN 123" >
                        </div>  
                        @error('school')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Start Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="number"name="start_year"  value="{{ old('start_year') }}"  class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy">
                                </div> 
                                @error('start_year')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Graduate Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="number" name="end_year"  value="{{ old('end_year') }}" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy">
                                </div> 
                                @error('end_year')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP EDUCATION CREATE -->

<!-- START OF POP UP EDUCATION UPDATE -->
<div id="edu-update" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form id="educationForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Education</p>

                        @if (session()->has('education_update_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('education_update_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Degree</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="degree" id="educationDegree" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="High School Diploma" >
                        </div>  
                        @error('degree')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Major</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="major" id="educationMajor" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Bisnis Informatik" >
                        </div>  
                        @error('major')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">School</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="school" id="educationSchool" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="SMAN 123" >
                        </div>  
                        @error('school')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Start Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="number" name="start_year" id="educationStart_year" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy">
                                </div> 
                                @error('start_year')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Graduate Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="number" name="end_year" id="educationEnd_year" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy">
                                </div> 
                                @error('end_year')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP EDUCATION UPDATE -->

<!-- START OF Education -->
<div class="row m-0 page-container-inner" style="padding-bottom:5vw">
    <div class="col-12 p-0" style="display:flex;justify-content:space-between;align-items:center">
        <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Education</p>
        <a href="#edu-create"  style="color:#2B6CAA">
            <i class="fas fa-plus-circle small-heading"></i>
        </a>
    </div>
    <div class="col-12 p-0">
        <!-- START OF ONE CARD -->
        @isset($educations_not_updated)
            @foreach ($educations_not_updated as $education)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    <div>   
                    <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $education->school }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $education->degree }} | {{ $education->major }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $education->start_year }} - {{ $education->end_year ?? 'Until Now' }}</p>
                    </div>
                    <div style="display:flex;align-items:center">
                        <a href="#edu-update" style="color:#2B6CAA">
                            <i onclick="passEducation('{{ $education->degree }}', '{{$education->school}}', '{{$education->major}}', '{{$education->start_year}}', '{{$education->end_year}}', '{{route('candidate-detail.update-education', $education->id)}}' )" class="fas fa-edit bigger-text"></i>

                        </a>
                        <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.delete-education', $education->id)}}"> 
                        @csrf
                        @method('delete')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                        </form>
                    </div>
                </div>
            @endforeach
        @endisset
       
        @isset($candidate_detail_change->educationChanges)
            @foreach ($candidate_detail_change->educationChanges as $educationChange)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    @if ($educationChange->action == 'create')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $educationChange->school }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $educationChange->degree }} | {{ $educationChange->major }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $educationChange->start_year }} - {{ $educationChange->end_year ?? 'Until Now' }}</p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#edu-update" style="color:#2B6CAA">
                                <i onclick="passEducation('{{ $educationChange->degree }}', '{{$educationChange->school}}', '{{$educationChange->major}}', '{{$educationChange->start_year}}', '{{$educationChange->end_year}}', '{{route('candidate-detail.update-education-change', $educationChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-education-change', $educationChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($educationChange->action == 'update')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Old</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $educationChange->education->degree }} | {{ $educationChange->education->school }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $educationChange->education->major }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $educationChange->education->start_year }} - {{ $educationChange->education->end_year ?? 'Until Now' }}</p>
                            <br>
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">Updated</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $educationChange->degree }} | {{ $educationChange->school }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $educationChange->major }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $educationChange->start_year }} - {{ $educationChange->end_year ?? 'Until Now' }}</p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#edu-update" style="color:#2B6CAA">
                                <i onclick="passEducation('{{ $educationChange->degree }}', '{{$educationChange->school}}', '{{$educationChange->major}}', '{{$educationChange->start_year}}', '{{$educationChange->end_year}}', '{{route('candidate-detail.update-education-change', $educationChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-education-change', $educationChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($educationChange->action == 'delete')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Delete</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $educationChange->education->degree }} | {{ $educationChange->education->school }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $educationChange->education->major }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $educationChange->education->start_year }} - {{ $educationChange->education->end_year ?? 'Until Now' }}</p>
                        </div>
                        <div style="display:flex;align-items:center">
                        </div>
                    @endif
                </div>
            @endforeach
        @endisset
        <!-- END OF ONE CARD -->
    </div>
</div>
<!-- END OF Education -->


<!-- START OF POP UP ACHIEVEMENT CREATE -->
<div id="achievement-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="{{ route('candidate-detail.store-achievement') }}" method="POST">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Achievements</p>

                        @if (session()->has('achievement_create_message'))
                        <div class="p-3 mt-2 mb-0 ps-0 pe-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('achievement_create_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="title"  value="{{ old('title') }}"   type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Juara 1 Nasional Lomba.." >
                        </div>  
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Achievement Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="number" name="year"  value="{{ old('year') }}"   class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy">
                                </div> 
                                @error('year')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror   
                            </div>
                        </div>
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Location of Event</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input  name="location_of_event"  value="{{ old('location_of_event') }}"type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Sekolah Dasar.." >
                        </div>  
                        @error('location_of_event')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP ACHIEVEMENT CREATE -->

<!-- START OF POP UP ACHIEVEMENT UPDATE -->
<div id="achievement-update" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" id="achievementForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Achievements</p>

                        @if (session()->has('achievement_update_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('achievement_update_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="title" id="achievementTitle" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Juara 1 Nasional Lomba.." >
                        </div>  
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Achievement Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="number" name="year" id="achievementYear" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy">
                                </div> 
                            </div>
                        </div>
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Location of Event</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="location_of_event" id="achievementLocationOfEvent" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="DKI Jakarta" >
                        </div>  
                        @error('location_of_event')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP ACHIEVEMENT UPDATE -->


<!-- START OF Achievements -->
<div class="row m-0 page-container-inner" style="padding-bottom:5vw">
    <div class="col-12 p-0" style="display:flex;justify-content:space-between;align-items:center">
        <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Achievements</p>
        <a href="#achievement-create"  style="color:#2B6CAA">
            <i class="fas fa-plus-circle small-heading"></i>
        </a>
    </div>
    <div class="col-12 p-0">
        <!-- START OF ONE CARD -->
        @isset($achievements_not_updated)
            @foreach ($achievements_not_updated as $achievement)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    <div>   
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $achievement->title }}</p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $achievement->location_of_event }} </p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $achievement->year }}</p>
                    </div>
                    <div style="display:flex;align-items:center">
                        <a href="#achievement-update" style="color:#2B6CAA">
                            <i onclick="passAchievement('{{ $achievement->title }}', '{{$achievement->location_of_event}}', '{{$achievement->year}}', '{{route('candidate-detail.update-achievement', $achievement->id)}}' )" class="fas fa-edit bigger-text"></i>
                        </a>
                        <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.delete-achievement', $achievement->id)}}"> 
                        @csrf
                        @method('delete')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                        </form>
                    </div>
                </div>
            @endforeach
        @endisset
       
        @isset($candidate_detail_change->achievementChanges)
            @foreach ($candidate_detail_change->achievementChanges as $achievementChange)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    @if ($achievementChange->action == 'create')
                        <div> 
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $achievementChange->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $achievementChange->location_of_event }} </p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $achievementChange->year }}</p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#achievement-update" style="color:#2B6CAA">
                                <i onclick="passAchievement('{{ $achievementChange->title }}', '{{$achievementChange->location_of_event}}', '{{$achievementChange->year}}', '{{route('candidate-detail.update-achievement-change', $achievementChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-achievement-change', $achievementChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($achievementChange->action == 'update')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Old</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $achievementChange->achievement->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $achievementChange->achievement->location_of_event }} </p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $achievementChange->achievement->year }}</p>
                            <br>
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">Updated</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $achievementChange->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $achievementChange->location_of_event }} </p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $achievementChange->year }}</p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#achievement-update" style="color:#2B6CAA">
                                <i onclick="passAchievement('{{ $achievementChange->title }}', '{{$achievementChange->location_of_event}}', '{{$achievementChange->year}}', '{{route('candidate-detail.update-achievement-change', $achievementChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-achievement-change', $achievementChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($achievementChange->action == 'delete')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Delete</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $achievementChange->achievement->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $achievementChange->achievement->location_of_event }} </p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">{{ $achievementChange->achievement->year }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @endisset
        <!-- END OF ONE CARD -->
    </div>
</div>
<!-- END OF Achievements -->

<!-- START OF POP UP Hard Skills Create -->
<div id="hs-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="{{ route('candidate-detail.store-hardskill') }}" method="POST">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Hard Skills</p>

                        @if (session()->has('hard_skills_create_message'))
                        <div class="p-3 mt-2 mb-0 ps-0 pe-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('hard_skills_create_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="title"  value="{{ old('title') }}" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Web Designer" >
                        </div>  
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Hard Skill Score</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <span style="margin-right:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">1</span>
                            <input type="range"  name="score"  value="{{ old('score') }}" class="form-range" min="1" max="10" id="customRange2">
                            <span style="margin-left:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">10</span>
                        </div>  
                        @error('score')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP Hard Skills Create -->

<!-- START OF POP UP Hard Skills Update-->
<div id="hs-update" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" id="hardskillForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Hard Skills</p>

                        @if (session()->has('hardskill_update_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('hardskill_update_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="title" id="hardskillTitle" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Web Designer" >
                        </div>  
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Hard Skill Score</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <span style="margin-right:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">1</span>
                                <input type="range" id="hardskillScore" name="score" class="form-range" min="1" max="10">
                            <span style="margin-left:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">10</span>
                        </div>  
                        @error('score')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP Hard Skills Update-->

<!-- START OF Hard Skills -->
<div class="row m-0 page-container-inner" style="padding-bottom:5vw">
    <div class="col-12 p-0" style="display:flex;justify-content:space-between;align-items:center">
        <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Hard Skills</p>
        <a href="#hs-create"  style="color:#2B6CAA">
            <i class="fas fa-plus-circle small-heading"></i>
        </a>
    </div>
    <div class="col-12 p-0">
        <!-- START OF ONE CARD -->
        @isset($hardskills_not_updated)
            @foreach ($hardskills_not_updated as $hard_skill)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    <div>   
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $hard_skill->title }}</p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $hard_skill->score }} </p>
                    </div>
                    <div style="display:flex;align-items:center">
                        <a href="#hs-update" style="color:#2B6CAA">
                            <i onclick="passHardSkill('{{ $hard_skill->title }}', '{{$hard_skill->score}}', '{{route('candidate-detail.update-hardskill', $hard_skill->id)}}' )" class="fas fa-edit bigger-text"></i>
                        </a>
                        <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.delete-hardskill', $hard_skill->id)}}"> 
                        @csrf
                        @method('delete')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                        </form>
                    </div>
                </div>
            @endforeach
        @endisset
       
        @isset($candidate_detail_change->hardskillChanges)
            @foreach ($candidate_detail_change->hardskillChanges as $hardskillChange)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    @if ($hardskillChange->action == 'create')
                        <div> 
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>

                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $hardskillChange->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Level: {{ $hardskillChange->score }} </p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#hs-update" style="color:#2B6CAA">
                                <i onclick="passHardSkill('{{ $hardskillChange->title }}', '{{$hardskillChange->score}}', '{{route('candidate-detail.update-hardskill-change', $hardskillChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-hardskill-change', $hardskillChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($hardskillChange->action == 'update')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Old</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $hardskillChange->hardskill->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Level: {{ $hardskillChange->hardskill->score }} </p>
                            <br>
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">Update</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $hardskillChange->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Level: {{ $hardskillChange->score }} </p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#hs-update" style="color:#2B6CAA">
                                <i onclick="passHardSkill('{{ $hardskillChange->title }}', '{{$hardskillChange->score}}', '{{route('candidate-detail.update-hardskill-change', $hardskillChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-hardskill-change', $hardskillChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($hardskillChange->action == 'delete')
                        <div>  
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Delete</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $hardskillChange->hardskill->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Level: {{ $hardskillChange->hardskill->score }} </p>
                        </div>
                    @endif
                </div>
            @endforeach
        @endisset
        <!-- END OF ONE CARD -->
    </div>
</div>
<!-- END OF Hard Skills -->


<!-- START OF POP UP Soft Skill Create -->
<div id="ss-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="{{ route('candidate-detail.store-softskill') }}" method="POST">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Soft Skills</p>

                        @if (session()->has('soft_skills_create_message'))
                        <div class="p-3 mt-2 mb-0 ps-0 pe-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('soft_skills_create_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="title"  value="{{ old('title') }}" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Komunikasi" >
                        </div>  
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Soft Skill Score</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <span style="margin-right:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">1</span>
                            <input type="range" name="score"  value="{{ old('score') }}" class="form-range" min="1" max="10" id="customRange2">
                            <span style="margin-left:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">10</span>
                        </div>  
                        @error('score')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP Soft Skill Create -->

<!-- START OF POP UP Soft Skill Update-->
<div id="ss-update" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" id="softskillForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Soft Skills</p>

                        @if (session()->has('softskill_update_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('softskill_update_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="title" id="softskillTitle" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Komunikasi" >
                        </div>  
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Soft Skill Score</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <span style="margin-right:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">1</span>
                            <input type="range" name="score" id="softskillScore" class="form-range" min="1" max="10" >
                            <span style="margin-left:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">10</span>
                        </div>  
                        @error('score')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP Soft Skill Update-->


<!-- START OF Soft Skills -->
<div class="row m-0 page-container-inner" style="padding-bottom:5vw">
    <div class="col-12 p-0" style="display:flex;justify-content:space-between;align-items:center">
        <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Soft Skills</p>
        <a href="#ss-create"  style="color:#2B6CAA">
            <i class="fas fa-plus-circle small-heading"></i>
        </a>
    </div>
    <div class="col-12 p-0">
        <!-- START OF ONE CARD -->
        @isset($softskills_not_updated)
            @foreach ($softskills_not_updated as $soft_skill)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    <div>   
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $soft_skill->title }}</p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $soft_skill->score }} </p>
                    </div>
                    <div style="display:flex;align-items:center">
                        <a href="#ss-update" style="color:#2B6CAA">
                            <i onclick="passSoftSkill('{{ $soft_skill->title }}', '{{$soft_skill->score}}', '{{route('candidate-detail.update-softskill', $soft_skill->id)}}' )" class="fas fa-edit bigger-text"></i>
                        </a>
                        <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.delete-softskill', $soft_skill->id)}}"> 
                        @csrf
                        @method('delete')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                        </form>
                    </div>
                </div>
            @endforeach
        @endisset
       
        @isset($candidate_detail_change->softskillChanges)
            @foreach ($candidate_detail_change->softskillChanges as $softSkillChange)
                <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                    @if ($softSkillChange->action == 'create')
                        <div> 
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>

                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $softSkillChange->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Level: {{ $softSkillChange->score }} </p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#ss-update" style="color:#2B6CAA">
                                <i onclick="passSoftSkill('{{ $softSkillChange->title }}', '{{$softSkillChange->score}}', '{{route('candidate-detail.update-softskill-change', $softSkillChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-softskill-change', $softSkillChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($softSkillChange->action == 'update')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Old</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $softSkillChange->softskill->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Level: {{ $softSkillChange->softskill->score }} </p>
                            <br>
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">Updated</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $softSkillChange->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Level: {{ $softSkillChange->score }} </p>
                        </div>
                        <div style="display:flex;align-items:center">
                            <a href="#we-update" style="color:#2B6CAA">
                                <i onclick="passSoftSkill('{{ $softSkillChange->title }}', '{{$softSkillChange->score}}', '{{route('candidate-detail.update-softskill-change', $softSkillChange->id)}}' )" class="fas fa-edit bigger-text"></i>
                            </a>
                            <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-softskill-change', $softSkillChange->id)}}"> 
                            @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                            </form>
                        </div>
                    @elseif ($softSkillChange->action == 'delete')
                        <div>   
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Delete</p>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $softSkillChange->softskill->title }}</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Level: {{ $softSkillChange->softskill->score }} </p>
                        </div>
                    @endif
                </div>
            @endforeach
        @endisset
        <!-- END OF ONE CARD -->
    </div>
</div>
<!-- END OF Soft Skills -->


<!-- START OF POP UP INTEREST Create -->
<div id="interest-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%" id="mobile-popup-candidate-detail">
        <a class="close" href="#closed" id="mobile-popup-candidate-detail-close">&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="{{ route('candidate-detail.store-interest') }}" method="POST">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Interests</p>

                        @if (session()->has('interests_create_message'))
                        <div class="p-3 mt-2 mb-0 ps-0 pe-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('interests_create_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="title"  value="{{ old('title') }}" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Komunikasi" >
                        </div>
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP INTEREST Create -->

<!-- START OF POP UP INTEREST Update -->
<div id="interest-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" method="POST">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Interests</p>

                        @if (session()->has('interests_update_message'))
                        <div class="p-3 mt-2 mb-0 ps-0 pe-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('interests_update_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="title"  value="{{ old('title') }}" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Komunikasi" >
                        </div>  
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12" id="add-mobile-candidate-details" style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP INTEREST Update -->



<!-- START OF Interests -->
<div class="row m-0 page-container-inner" >
    <div class="col-12 p-0" style="display:flex;justify-content:space-between;align-items:center">
        <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Interests</p>
        <a href="#interest-create"  style="color:#2B6CAA">
            <i class="fas fa-plus-circle small-heading"></i>
        </a>
    </div>
    <div class="col-12 p-0">
        <div style="display:flex;align-items:center;flex-wrap:wrap">
        <!-- START OF ONE CARD -->
        @isset($interests_not_updated)
            @foreach ($interests_not_updated as $interest)
                <div id="interest-mobile-tag" style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                    <p class="normal-text" style="margin-bottom:0px">{{$interest->title}}</p>
                    <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.delete-interest', $interest->id)}}"> 
                    @csrf
                    @method('delete')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:white" class="fas fa-trash"></i></button> 
                    </form>
                </div>
            @endforeach
        @endisset
       
        @isset($candidate_detail_change->interestChanges)
            @foreach ($candidate_detail_change->interestChanges as $interestChange)
                <div style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                    @if ($interestChange->action == 'create')
                        <p class="normal-text" style="margin-bottom:0px">(NEW) - {{$interestChange->title}}</p>
                        <form method="post" style="margin-left:1vw" action="{{route('candidate-detail.cancel-interest-change', $interestChange->id)}}"> 
                        @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this?')" style="background:none;border:none"> <i style="color:white" class="fas fa-trash"></i></button> 
                        </form>
                    @elseif ($interestChange->action == 'delete')
                        <p class="normal-text" style="margin-bottom:0px">(DELETED) - {{$interestChange->interest->title}}</p>
                    @endif
                </div>
            @endforeach
        @endisset
        <!-- END OF ONE CARD -->
        </div>
    </div>
</div>
<!-- END OF Interests -->
<script>
    function passWorkExperience(company, job_position, start_date, end_date, location, route) {
		document.getElementById("workExperienceCompany").value      = company;
		document.getElementById("workExperienceJob_position").value = job_position;
		document.getElementById("workExperienceStart_date").value   = start_date;
		document.getElementById("workExperienceEnd_date").value     = end_date;
		document.getElementById("workExperienceLocation").value     = location;
		document.getElementById("workExperienceForm").action        = route;
    }
</script>

<script>
    function passEducation(degree, school, major,start_year, end_year, route) {
		document.getElementById("educationDegree").value        = degree;
		document.getElementById("educationSchool").value        = school;
		document.getElementById("educationMajor").value         = major;
		document.getElementById("educationStart_year").value    = start_year;
		document.getElementById("educationEnd_year").value      = end_year;
		document.getElementById("educationForm").action         = route;
    }
</script>

<script>
    function passAchievement(title, location_of_event, year, route) {
		document.getElementById("achievementTitle").value           = title;
		document.getElementById("achievementLocationOfEvent").value = location_of_event;
		document.getElementById("achievementYear").value            = year;
		document.getElementById("achievementForm").action           = route;
    }
</script>

<script>
    function passHardSkill(title, score, route) {
		document.getElementById("hardskillTitle").value = title;
		document.getElementById("hardskillScore").value = score;
		document.getElementById("hardskillForm").action = route;
    }
</script>

<script>
    function passSoftSkill(title, score, route) {
		document.getElementById("softskillTitle").value = title;
		document.getElementById("softskillScore").value = score;
		document.getElementById("softskillForm").action = route;
    }
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="/js/main.js"></script>



@endsection