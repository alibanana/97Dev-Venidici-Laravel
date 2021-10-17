@extends('./layouts/client-main')
@section('title', 'Venidici Candidate Details')

@section('content')

<!-- start of candidate detail form -->

<form action="{{route('candidate-detail.upsert-candidate-detail')}}" method="POST">
@csrf
<!-- Modal VA -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-body" style="text-align:center">
            <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA">Update Job Portal Profile?</p>
            <p class="normal-text" style="font-family:Rubik Medium;color:#000000;margin-bottom:2vw">Admin approval will be processed within 1 x 24 hours</p>
            <button type="submit" class="normal-text btn-blue-bordered btn-blue-bordered-active full-width-button" style="font-family: Avenir Medium;cursor:pointer;padding:0.5vw 2vw">Confirm</button>                
            <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-top:1vw">OR</p>
            <p class="normal-text" style="font-family:Rubik Medium;color:grey;margin-top:1vw;cursor:pointer" data-dismiss="modal" >Cancel</p>
        </div>
        </div>
    </div>
</div>
<!-- END OF MODAL VA -->

<!-- START OF BASIC INFO SECTION -->
<div class="row m-0 page-container-inner" style="padding-top:14vw !important;">
    <div class="col-12 p-0">
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
    <div class="col-lg-6 col-xs-12 ps-0 pe-5">
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fas fa-user"></i>
            <input disabled readonly type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%"
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
                style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;"
                placeholder="yyyy.mm.dd" value="{{ $date }}" disabled>
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
            <input value="{{ old('linkedin_link') }}" type="text" name="linkedin_link" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Link Linked In" >
        </div>   
        @error('linkedin_link')
            <span class="invalid-feedback" role="alert" style="display: block !important;">
            <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div> 
    <!-- END OF LEFT SECTION --> 
    <!-- START OF RIGHT SECTION-->
    <div class="col-lg-6 col-xs-12 pe-0 ps-5">
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
            <input readonly type="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="Masukkan email"
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
            <input value="{{old('preferred_working_location')}}"  name="preferred_working_location" type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="DKI Jakarta, Kalimantan, Sumatra" 
            value=""
            >
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
                value="{{ old('whatsapp_number', Auth::user()->userDetail->telephone) }}">
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

<!-- START OF RESUME -->
<div class="row m-0 page-container-inner" style="padding-top:4vw">
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family:Rubik Bold;color:#2B6CAA">Resume</p>
        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">About me</p>
        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
            <textarea name="about_me_description" value="{{old('about_me_description')}}" rows="6" class="normal-text" style="background:transparent;border:none;color:#3B3C43;width:100%" placeholder="This is an example." >{{old('about_me_description')}}</textarea>
        </div>  
        @error('about_me_description')
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
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            <form action="{{ route('candidate-detail.store-work-experience') }}" method="POST">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Work Experience</p>

                        @if (session()->has('work_experience_create_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
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
                                    <input type="date" name="start_date"  value="{{ old('start_date') }}"  class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy.mm.dd">
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
                                    <input type="date" name="end_date"  value="{{ old('end_date') }}" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy.mm.dd">
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
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <button type="submit" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none;border:none">Add</button>                
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP WORK EXPERIENCE CREATE -->

<!-- START OF POP UP WORK EXPERIENCE UPDATE -->
<div id="we-update" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" method="POST" enctype="multipart/form-data">
            @csrf
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
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="PT. John Doe" >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Start Date</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="birth_date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy.mm.dd">
                                </div> 
                            </div>
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">End Date</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="birth_date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy.mm.dd">
                                </div> 
                            </div>
                        </div>
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Job Position</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Sales Manager" >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Location</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="DKI Jakarta" >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
        <!-- START OF ONE CARD -->
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
        <!-- END OF ONE CARD -->
        @foreach ($candidate_detail->workExperiences as $workExperience)
            <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
                <div>
                    <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperience->job_position }}</p>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperience->company }}</p>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{ $workExperience->start_date }} - {{ $workExperience->end_date ?? 'Until Now' }}</p>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">{{ $workExperience->location }}</p>
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
        @endforeach
    </div>
</div>
<!-- END OF Work Experience -->

<!-- START OF POP UP EDUCATION CREATE -->
<div id="edu-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
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
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" method="POST" enctype="multipart/form-data">
            @csrf
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
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="High School Diploma" >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Major</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Bisnis Informatik" >
                        </div>  
                        @error('name')
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
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="SMAN 123" >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Start Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="birth_date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy.mm.dd">
                                </div> 
                            </div>
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Graduate Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="birth_date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy.mm.dd">
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">SD Nusantara</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2020</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#edu-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">SMP GLOBAL JAYA</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2017</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#edu-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        <!-- END OF ONE CARD -->
    </div>
</div>
<!-- END OF Education -->


<!-- START OF POP UP ACHIEVEMENT CREATE -->
<div id="achievement-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
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
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" method="POST" enctype="multipart/form-data">
            @csrf
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
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Juara 1 Nasional Lomba.." >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="row m-0">
                            <div class="col-lg-6 col-xs-12 ps-0">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Achievement Year</p>
                                <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                                    <input type="date" name="birth_date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%;color:#3B3C43" placeholder="yyyy.mm.dd">
                                </div> 
                            </div>
                        </div>
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Location of Event</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Sekolah Dasar.." >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">SD Nusantara</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2020</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#achievement-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">SMP GLOBAL JAYA</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2017</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#achievement-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        <!-- END OF ONE CARD -->
    </div>
</div>
<!-- END OF Achievements -->

<!-- START OF POP UP Hard Skills Create -->
<div id="hs-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
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
                            <input type="range"  name="score"  value="{{ old('score') }}" class="form-range" min="0" max="10" id="customRange2">
                            <span style="margin-left:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">10</span>
                        </div>  
                        @error('score')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Hard Skills</p>

                        @if (session()->has('hard_skills_update_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('hard_skills_update_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Web Designer" >
                        </div>  
                        @error('name')
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
                            <input type="range" class="form-range" min="0" max="10" id="customRange2">
                            <span style="margin-left:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">10</span>
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">SD Nusantara</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2020</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#hs-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">SMP GLOBAL JAYA</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2017</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#hs-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        <!-- END OF ONE CARD -->
    </div>
</div>
<!-- END OF Hard Skills -->


<!-- START OF POP UP Soft Skill Create -->
<div id="ss-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
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
                            <input type="range" name="score"  value="{{ old('score') }}" class="form-range" min="0" max="10" id="customRange2">
                            <span style="margin-left:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">10</span>
                        </div>  
                        @error('score')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;margin-top:2vw">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Soft Skills</p>

                        @if (session()->has('soft_skills_update_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('soft_skills_update_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-lg-6 col-xs-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Title</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <input name="name" type="text" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Komunikasi" >
                        </div>  
                        @error('name')
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
                            <input type="range" class="form-range" min="0" max="10" id="customRange2">
                            <span style="margin-left:1vw;font-family:Rubik Medium;color:#2B6CAA" class="normal-text">10</span>
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">SD Nusantara</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2020</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#ss-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
        <div style="background-color:#F7F7F9;padding:1.5vw;border-radius:5px;border:2px solid #2B6CAA;display:flex;align-items:center;justify-content:space-between;margin-top:2vw">
            <div>   
                <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">SMP GLOBAL JAYA</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0.5vw">Feb 2017</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#B3B5C2;margin-bottom:0px">DKI Jakarta</p>
            </div>
            <div style="display:flex;align-items:center">
                <a href="#ss-update" style="color:#2B6CAA">
                    <i class="fas fa-edit bigger-text"></i>
                </a>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:#2B6CAA" class="fas fa-trash"></i></button> 
                </form>
            </div>
        </div>
        <!-- END OF ONE CARD -->
    </div>
</div>
<!-- END OF Soft Skills -->


<!-- START OF POP UP INTEREST Create -->
<div id="interest-create" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:65%">
        <a class="close" href="#closed" >&times;</a>
    
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
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
                    <div class="col-12 " style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
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
            <div style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                <p class="normal-text" style="margin-bottom:0px">Information Technology</p>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:white" class="fas fa-trash"></i></button> 
                </form>
            </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
            <div style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                <p class="normal-text" style="margin-bottom:0px">Pencuri Hati</p>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:white" class="fas fa-trash"></i></button> 
                </form>
            </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
            <div style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                <p class="normal-text" style="margin-bottom:0px">Menantu Ibu-mu</p>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:white" class="fas fa-trash"></i></button> 
                </form>
            </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
            <div style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                <p class="normal-text" style="margin-bottom:0px">Data Analyst</p>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:white" class="fas fa-trash"></i></button> 
                </form>
            </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
        <div style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                <p class="normal-text" style="margin-bottom:0px">Menantu Ibu-mu</p>
                <form style="margin-left:1vw" action=""> 
                <button type="submit" style="background:none;border:none"> <i style="color:white" class="fas fa-trash"></i></button> 
                </form>
            </div>
        <!-- END OF ONE CARD -->
        </div>
    </div>
</div>
<!-- END OF Interests -->




<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

@endsection