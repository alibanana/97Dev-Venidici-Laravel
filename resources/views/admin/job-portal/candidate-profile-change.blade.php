@extends('layouts/admin-main')

@section('title', 'Venidici Bootcamp Candidate Profile')

@section('container')


<!-- Main Content -->
<div id="content">

    <x-adminTopbar />   
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- START OF BANNER SECTION -->
        <div class="row m-0 page-container desktop-display"
            style="padding-bottom:4vw; padding-top: 4vw ;background-color:#2B6CAA">
            <div class="col-md-12 p-0 wow fadeInUp" data-wow-delay="0.3s">
                <div style="text-align:center">
                    <p class="medium-heading" style="font-family: Rubik Bold;color:orange;margin-bottom:3vw">Requested Profile</p>
                </div>

                <div class="row m-0">
                    <div class="col-lg-3 col-xs-12 p-0">
                        <img @if(Auth::user()->avatar == null) src="/assets/images/client/Default_Display_Picture.png" @else src="{{ $candidate_detail->user->userDetail->display_picture }}" @endif style="width:13vw;height:17vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-9 col-xs-12 p-0" style="display: flex;flex-direction: column;justify-content: center;align-items:left">
                        <div>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Hi, my name is</p>
                            <p class="medium-heading" style="font-family: Rubik Bold;color:#FFFFFF">{{ $candidate_detail->user->name }}</p>
                            @if (!$isCandidateDetailNotUpdated)
                                <p class="bigger-text" style="font-family: Rubik Regular;color:#FFFFFF">I have {{$candidate_detail->experience_year}} in {{$candidate_detail->industry}} (existing)</p>
                            @endif
                            <!-- show pending profile -->
                            @if ($candidate_detail_change->about_me_description != null)
                                <p class="bigger-text" style="font-family: Rubik Regular;color:#FFFFFF">I have {{$candidate_detail_change->experience_year}} in {{$candidate_detail_change->industry}} ({{$candidate_detail_change->status}})</p>
                            @endif
                            
                            


                            @if (!$isCandidateDetailNotUpdated)
                                <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Phone: {{$candidate_detail->whatsapp_number}} (existing)</p>
                            @endif
                            <!-- show pending profile -->
                            @if ($candidate_detail_change->about_me_description != null)
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Phone: {{$candidate_detail_change->whatsapp_number}} ({{$candidate_detail_change->status}})</p>
                            @endif




                            
                            @if (!$isCandidateDetailNotUpdated)
                                <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Preferred Working Location: {{$candidate_detail->preferred_working_location}} (existing)</p>
                            @endif
                            <!-- show pending profile -->
                            @if ($candidate_detail_change->about_me_description != null)
                                <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Preferred Working Location: {{$candidate_detail_change->preferred_working_location}} ({{$candidate_detail_change->status}})</p>
                            @endif
                           
                            <div style="display:flex;align-items:center;margin-top:3vw">   
                                @if (!$isCandidateDetailNotUpdated)
                                    <div>
                                        <a target="_blank" href="/{{$candidate_detail->cv_file }}" class="a-white" style="">Existing CV</a>
                                    </div>
                                @endif
                                <!-- show pending profile -->
                                @if ($candidate_detail_change->cv_file != null)
                                    <div>
                                        <a target="_blank" href="/{{$candidate_detail_change->cv_file }}" class="a-white" style="">Updated CV</a>
                                    </div>
                                @endif  
                            </div>
                        </div>
                    </div>
                    <!-- show current profile -->
                    @if ($isCandidateDetailNotUpdated)
                        <div class="col-12 p-0" style="margin-top:4vw">
                            <p class="small-heading" style="font-family: Rubik Bold;color:#FFFFFF">About me (existing)</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Linked In: {{$candidate_detail->linkedin_link == null ? '-' : $candidate_detail->linkedin_link }}</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">{{ $candidate_detail->about_me_description }}</p>
                        </div>                    
                    @endif

                    <!-- show pending profile -->
                    @if ($candidate_detail_change->about_me_description != null)
                        <div class="col-12 p-0" style="margin-top:4vw">
                            <p class="small-heading" style="font-family: Rubik Bold;color:#FFFFFF">About me ({{$candidate_detail_change->status}})</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Linked In: {{$candidate_detail_change->linkedin_link == null ? '-' : $candidate_detail_change->linkedin_link }}</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">{{ $candidate_detail_change->about_me_description }}</p>
                        </div>
                    @else
                        <div class="col-12 p-0" style="margin-top:4vw">
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">No update for description</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <!-- END OF BANNER SECTION -->


        <!-- START OF PROFILE SECTION -->
        <div class="row m-0 page-container desktop-display" style="padding-bottom:4vw;padding-top:8vw">
            <div class="col-lg-6 col-xs-12 ps-0" style="padding-right:4vw">
                <!-- START OF ONE SECTION -->
                <div>
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0px">Work Experiences</p>
                        <a data-toggle="collapse" href="#collapseExperiences" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                    </div>
                    <div class="collapse show" id="collapseExperiences">
                        @foreach ($work_experiences_not_updated as $workExperience)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                <!--<p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Not Updated</p> -->
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $workExperience->job_position }} at {{ $workExperience->company }}</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperience->start_date }} - {{ $workExperience->end_date ?? 'Until Now' }}</p>
                                <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperience->location }}</p>
                            </div>
                        @endforeach
                        @foreach ($candidate_detail_change->workExperienceChanges as $workExperienceChange)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                @if ($workExperienceChange->action == 'create')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->job_position }} at {{ $workExperienceChange->company }}</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->start_date }} - {{ $workExperienceChange->end_date ?? 'Until Now' }}</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->location }}</p>
                                @elseif ($workExperienceChange->action == 'update')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Update</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->workExperience->job_position }} at {{ $workExperienceChange->workExperience->company }} (old)</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->job_position }} at {{ $workExperienceChange->company }} (new)</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->workExperience->start_date }} - {{ $workExperienceChange->workExperience->end_date ?? 'Until Now' }} (old)</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->start_date }} - {{ $workExperienceChange->end_date ?? 'Until Now' }} (new)</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->workExperience->location }} (old)</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->location }} (new)</p>
                                @elseif ($workExperienceChange->action == 'delete')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: red">Delete</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->workExperience->job_position }} at {{ $workExperienceChange->workExperience->company }}</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->workExperience->start_date }} - {{ $workExperienceChange->workExperience->end_date ?? 'Until Now' }}</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperienceChange->workExperience->location }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END OF ONE SECTION -->
            </div>


            <div class="col-lg-6 col-xs-12 pe-0" style="padding-left:4vw">
                <!-- START OF ONE SECTION -->
                <div>
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0px">Education</p>
                        <a data-toggle="collapse" href="#collapseEducation" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                    </div>
                    <div class="collapse show" id="collapseEducation">
                        @foreach ($educations_not_updated as $education)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                <!--<p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Not Updated</p> -->
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $education->degree }} at {{ $education->major }}</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $education->start_year }} - {{ $education->end_year ?? 'Until Now' }}</p>
                                <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $education->school }}</p>
                            </div>
                        @endforeach
                        @foreach ($candidate_detail_change->educationChanges as $educationChange)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                @if ($educationChange->action == 'create')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->degree }} at {{ $educationChange->major }}</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->start_year }} - {{ $educationChange->end_year ?? 'Until Now' }}</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->school }}</p>
                                @elseif ($educationChange->action == 'update')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Update</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->education->degree }} at {{ $educationChange->education->major }} (old)</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->degree }} at {{ $educationChange->major }} (new)</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->education->start_year }} - {{ $educationChange->education->end_year ?? 'Until Now' }} (old)</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->start_year }} - {{ $educationChange->end_year ?? 'Until Now' }} (new)</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->education->school }} (old)</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->school }} (new)</p>
                                @elseif ($educationChange->action == 'delete')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: red">Delete</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->education->degree }} at {{ $educationChange->education->major }}</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->education->start_year }} - {{ $educationChange->education->end_year ?? 'Until Now' }}</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $educationChange->education->school }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END OF ONE SECTION -->
            </div>


            <div class="col-lg-6 col-xs-12 ps-0" style="padding-right:4vw;margin-top:4vw">
                <!-- START OF ONE SECTION -->
                <div>
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0px">Hard Skills</p>
                        <a data-toggle="collapse" href="#collapseHardskills" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                    </div>
                    <div class="collapse show" id="collapseHardskills">
                        @foreach ($hardskills_not_updated as $hardskill)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Not Updated</p>
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $hardskill->title }}</p>
                                <div style="padding-right:8vw;">   
                                    <div style="text-align:right">  
                                        <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $hardskill->score }}/10</p>

                                    </div>
                                    <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $hardskill->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $hardskill->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($candidate_detail_change->hardskillChanges as $hardskillChange)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                @if ($hardskillChange->action == 'create')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $hardskillChange->title }}</p>
                                    <div style="padding-right:8vw;">   
                                        <div style="text-align:right">  
                                            <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $hardskillChange->score }}/10</p>
                                        </div>
                                        <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $hardskillChange->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $hardskillChange->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @elseif ($hardskillChange->action == 'update')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Update</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $hardskillChange->hardskill->title }} (old)</p>
                                    <div style="padding-right:8vw;">   
                                        <div style="text-align:right">  
                                            <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $hardskillChange->hardskill->score }}/10 (old)</p>
                                        </div>
                                        <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $hardskillChange->hardskill->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $hardskillChange->hardskill->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $hardskillChange->title }} (new)</p>
                                    <div style="padding-right:8vw;">   
                                        <div style="text-align:right">  
                                            <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $hardskillChange->score }}/10 (new)</p>
                                        </div>
                                        <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $hardskillChange->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $hardskillChange->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @elseif ($hardskillChange->action == 'delete')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: red">Delete</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $hardskillChange->hardskill->title }}</p>
                                    <div style="padding-right:8vw;">   
                                        <div style="text-align:right">  
                                            <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $hardskillChange->hardskill->score }}/10</p>
                                        </div>
                                        <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $hardskillChange->hardskill->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $hardskillChange->hardskill->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END OF ONE SECTION -->
            </div>

            <div class="col-lg-6 col-xs-12 pe-0" style="padding-left:4vw;margin-top:4vw">
                <!-- START OF ONE SECTION -->
                <div>
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0px">Achievements</p>
                        <a data-toggle="collapse" href="#collapseAchievements" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                    </div>
                    <div class="collapse show" id="collapseAchievements">
                        @foreach ($achievements_not_updated as $achievement)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                <!--<p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Not Updated</p> -->
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $achievement->title }}</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievement->year }}</p>
                                <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievement->location_of_event }}</p>
                            </div>
                        @endforeach
                        @foreach ($candidate_detail_change->achievementChanges as $achievementChange)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                @if ($achievementChange->action == 'create')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->title }}</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->year }}</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->location_of_event }}</p>
                                @elseif ($achievementChange->action == 'update')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Update</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->achievement->title }} (old)</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->title }} (new)</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->achievement->year }} (old)</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->year }} (new)</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->achievement->location_of_event }} (old)</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->location_of_event }} (new)</p>
                                @elseif ($achievementChange->action == 'delete')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: red">Delete</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->achievement->title }}</p>
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->achievement->year }}</p>
                                    <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievementChange->achievement->location_of_event }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END OF ONE SECTION -->
            </div>


            <div class="col-lg-6 col-xs-12 ps-0" style="padding-right:4vw;margin-top:4vw">
                <!-- START OF ONE SECTION -->
                <div>
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0px">Soft Skills</p>
                        <a data-toggle="collapse" href="#collapseSoftSkills" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                    </div>
                    <div class="collapse show" id="collapseSoftSkills">
                        @foreach ($softskills_not_updated as $softskill)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Not Updated</p>
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $softskill->title }}</p>
                                <div style="padding-right:8vw;">
                                    <div style="text-align:right">
                                        <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $softskill->score }}/10</p>
                                    </div>
                                    <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $softskill->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $softskill->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($candidate_detail_change->softskillChanges as $softskillChange)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                @if ($softskillChange->action == 'create')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $softskillChange->title }}</p>
                                    <div style="padding-right:8vw;">   
                                        <div style="text-align:right">  
                                            <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $softskillChange->score }}/10</p>
                                        </div>
                                        <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $softskillChange->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $softskillChange->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @elseif ($softskillChange->action == 'update')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Update</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $softskillChange->softskill->title }} (old)</p>
                                    <div style="padding-right:8vw;">   
                                        <div style="text-align:right">  
                                            <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $softskillChange->softskill->score }}/10 (old)</p>
                                        </div>
                                        <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $softskillChange->softskill->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $softskillChange->softskill->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $softskillChange->title }} (new)</p>
                                    <div style="padding-right:8vw;">   
                                        <div style="text-align:right">  
                                            <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $softskillChange->score }}/10 (new)</p>
                                        </div>
                                        <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $softskillChange->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $softskillChange->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @elseif ($softskillChange->action == 'delete')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: red">Delete</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $softskillChange->softskill->title }}</p>
                                    <div style="padding-right:8vw;">   
                                        <div style="text-align:right">  
                                            <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $softskillChange->softskill->score }}/10</p>
                                        </div>
                                        <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $softskillChange->softskill->score * 10 }}%;background-color:#67BBA3" aria-valuenow="{{ $softskillChange->softskill->score * 10 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END OF ONE SECTION -->
            </div>

            <div class="col-lg-6 col-xs-12 pe-0" style="padding-left:4vw;margin-top:4vw">
                <!-- START OF ONE SECTION -->
                <div>
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0px">Interests</p>
                        <a data-toggle="collapse" href="#collapseInterests" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                    </div>
                    <div class="collapse show" id="collapseInterests">
                        @foreach ($interests_not_updated as $interest)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                <!--<p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: grey">Not Updated</p> -->
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $interest->title }}</p>
                            </div>
                        @endforeach
                        @foreach ($candidate_detail_change->interestChanges as $interestChange)
                            <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                                @if ($interestChange->action == 'create')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: green">New</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $interestChange->title }}</p>
                                @elseif ($interestChange->action == 'update')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: orange">Update</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $interestChange->interest->title }} (old)</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $interestChange->title }} (new)</p>
                                @elseif ($interestChange->action == 'delete')
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;color: red">Delete</p>
                                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:0.5vw">{{ $interestChange->interest->title }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END OF ONE SECTION -->
            </div>


        </div>
        <!-- END OF PROFILE SECTION -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection
