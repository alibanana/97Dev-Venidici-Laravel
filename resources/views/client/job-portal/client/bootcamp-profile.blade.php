@extends('./layouts/client-main')
@section('title', 'Venidici Candidate Details')

@section('content')

<!-- START OF BANNER SECTION -->
<div class="row m-0 page-container-inner desktop-display"
    style="padding-bottom:8vw; padding-top: 14vw ;background-color:#2B6CAA">
    <div class="col-md-12 p-0 wow fadeInUp" data-wow-delay="0.3s">
        <div class="row m-0">
            <div class="col-lg-3 col-xs-12 p-0">
                <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:13vw;height:17vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
            </div>
            <div class="col-lg-9 col-xs-12 p-0" style="display: flex;flex-direction: column;justify-content: center;align-items:left">
                <div>
                    <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Hi, my name is</p>
                    <p class="medium-heading" style="font-family: Rubik Bold;color:#FFFFFF">{{auth()->user()->name}}</p>
                    @isset($candidate_detail->experience_year)
                    <p class="bigger-text" style="font-family: Rubik Regular;color:#FFFFFF">I have {{$candidate_detail->experience_year}} in {{$candidate_detail->industry}}</p>
                    @endisset
                    <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Phone: <b>{{$candidate_detail->whatsapp_number == null ? '-' : $candidate_detail->whatsapp_number }}</b> </p>
                    <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Preferred Working Location: <b> {{$candidate_detail->preferred_working_location == null ? '-' : $candidate_detail->preferred_working_location }}</b> </p>
                    <div style="display:flex;align-items:center;margin-top:3vw">   
                        @if($candidate_detail->cv_file != null)
                        <div>
                            <a href="/{{$candidate_detail->cv_file}}" target="_blank" class="a-white" style="">Download CV</a>
                        </div>
                        @endif
                        <div style="margin-left:2vw">
                            <a href="{{ route('candidate-detail.index') }}" class="a-white" style="">Edit My Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-0" style="margin-top:4vw">
                <p class="small-heading" style="font-family: Rubik Bold;color:#FFFFFF">About me</p>
                <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Linked In: <b> {{$candidate_detail->linkedin_link == null ? '-' : $candidate_detail->linkedin_link }}</b> </p>
                <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">
                {{$candidate_detail->about_me_description == null ? '-' : $candidate_detail->about_me_description }}
                </p>

            </div>
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
                @isset($work_experiences_not_updated)
                    @foreach ($work_experiences_not_updated as $workExperience)
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{ $workExperience->job_position }} at {{ $workExperience->company }}</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperience->start_date }} - {{ $workExperience->end_date ?? 'Until Now' }}</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $workExperience->location }}</p>
                        </div>
                    @endforeach
                @endisset

                @if(count($work_experiences_not_updated) == 0)
                    <div style="margin-top:1.5vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:0.5vw;text-align:center">
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum ada data.</span></p>
                    </div>
                @endif
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
                @isset($educations_not_updated)
                    @foreach ($educations_not_updated as $education)
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{ $education->school }}</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $education->degree }} | {{ $education->major }}</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $education->start_year }} - {{ $education->end_year ?? 'Until Now' }}</p>
                        </div>
                    @endforeach
                @endisset
                @if(count($educations_not_updated) == 0)
                    <div style="margin-top:1.5vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:0.5vw;text-align:center">
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum ada data.</span></p>
                    </div>
                @endif
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
            <div class="collapse" id="collapseHardskills">
                @isset($hardskills_not_updated)
                    @foreach ($hardskills_not_updated as $hard_skill)
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{ $hard_skill->title }}</p>
                            <div style="padding-right:8vw;">   
                                <div style="text-align:right">  
                                    <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $hard_skill->score }}/10</p>

                                </div>
                                <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                    @php
                                        $progress = $hard_skill->score * 10
                                    @endphp
                                    <div class="progress-bar" role="progressbar" style="width: {{$progress}}%;background-color:#67BBA3"  aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
                @if(count($hardskills_not_updated) == 0)
                    <div style="margin-top:1.5vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:0.5vw;text-align:center">
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum ada data.</span></p>
                    </div>
                @endif
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
            <div class="collapse" id="collapseAchievements">
                @isset($achievements_not_updated)
                    @foreach ($achievements_not_updated as $achievement)
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{ $achievement->title }}</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievement->location_of_event }}</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{ $achievement->year }}</p>
                        </div>
                    @endforeach
                @endisset
                @if(count($achievements_not_updated) == 0)
                    <div style="margin-top:1.5vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:0.5vw;text-align:center">
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum ada data.</span></p>
                    </div>
                @endif
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
            <div class="collapse" id="collapseSoftSkills">
                @isset($softskills_not_updated)
                    @foreach ($softskills_not_updated as $softskill)
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{ $softskill->title }}</p>
                            <div style="padding-right:8vw;">   
                                <div style="text-align:right">  
                                    <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{ $softskill->score }}/10</p>

                                </div>
                                <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                    @php
                                    $progress = $softskill->score * 10
                                    @endphp
                                    <div class="progress-bar" role="progressbar" style="width: {{$progress}}%;background-color:#67BBA3"  aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
                @if(count($softskills_not_updated) == 0)
                    <div style="margin-top:1.5vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:0.5vw;text-align:center">
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum ada data.</span></p>
                    </div>
                @endif
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
            <div class="collapse" id="collapseInterests">
                @isset($interests_not_updated)
                    @foreach ($interests_not_updated as $interest)
                        <!-- START OF ONE CARD -->
                        <div style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                            <p class="normal-text" style="margin-bottom:0px">{{$interest->title}}</p>
                        </div>
                        <!-- END OF ONE CARD -->
                    @endforeach
                @endisset
                @if(count($interests_not_updated) == 0)
                    <div style="margin-top:1.5vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:0.5vw;text-align:center">
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum ada data.</span></p>
                    </div>
                @endif
            </div>
        </div>
        <!-- END OF ONE SECTION -->
    </div>


</div>
<!-- END OF PROFILE SECTION -->


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="/js/main.js"></script>

@endsection