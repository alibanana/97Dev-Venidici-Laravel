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
                    <p class="medium-heading" style="font-family: Rubik Bold;color:orange">Current Profile</p>
                </div>

                <div class="row m-0">
                    <div class="col-lg-3 col-xs-12 p-0">
                        <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:13vw;height:17vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-9 col-xs-12 p-0" style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start">
                        <div>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Hi, my name is</p>
                            <p class="medium-heading" style="font-family: Rubik Bold;color:#FFFFFF">{{$candidate_detail->user->name}}</p>
                            <p class="bigger-text" style="font-family: Rubik Regular;color:#FFFFFF">I have 2 Years of experience in Public Relations</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Phone: {{$candidate_detail->whatsapp_number == null ? '-' : $candidate_detail->whatsapp_number }}</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Preferred Working Location: {{$candidate_detail->preferred_working_location == null ? '-' : $candidate_detail->preferred_working_location }}</p>
                            <div style="display:flex;align-items:center;margin-top:3vw">   
                                <div>
                                    <a href="" class="a-white" style="">Download CV</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-0" style="margin-top:4vw">
                        <p class="small-heading" style="font-family: Rubik Bold;color:#FFFFFF">About me</p>
                        <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Linked In: {{$candidate_detail->linkedin_link == null ? '-' : $candidate_detail->linkedin_link }}</p>
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
                        @if(count($candidate_detail->workExperiences) != 0)
                            <a data-toggle="collapse" href="#collapseExperiences" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                        @endif
                    </div>
                    @if(count($candidate_detail->workExperiences) == 0)
                    <p class="normal-text" style="font-family: Rubik Medium;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">None</p>
                    @endif
                    <div class="collapse show" id="collapseExperiences">

                        @foreach($candidate_detail->workExperiences as $we)
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{$we->job_position}} at {{$we->company}}</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{$we->start_date}} - {{$we->end_date}}</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{$we->location}}</p>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
                        @if(count($candidate_detail->educations) != 0)
                            <a data-toggle="collapse" href="#collapseEducation" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                        @endif
                    </div>
                    @if(count($candidate_detail->educations) == 0)
                    <p class="normal-text" style="font-family: Rubik Medium;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">None</p>
                    @endif
                    <div class="collapse show" id="collapseEducation">
                        @foreach($candidate_detail->educations as $edu)
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{$edu->major}} in {{$edu->school}}</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{$edu->start_year}} - {{$edu->end_year}}</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">{{$edu->degree}} </p>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
                        @if(count($candidate_detail->hardskills) != 0)
                            <a data-toggle="collapse" href="#collapseHardskills" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                        @endif
                    </div>
                    @if(count($candidate_detail->hardskills) == 0)
                    <p class="normal-text" style="font-family: Rubik Medium;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">None</p>
                    @endif
                    <div class="collapse" id="collapseHardskills">
                        @foreach($candidate_detail->hardskills as $hs)
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{$hs->title}}</p>
                            <div style="padding-right:8vw;">   
                                <div style="text-align:right">  
                                    <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{$hs->score}}/10</p>

                                </div>
                                <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;background-color:#67BBA3" aria-valuenow="{{$hs->score}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
                        @if(count($candidate_detail->softskills) != 0)
                            <a data-toggle="collapse" href="#collapseAchievements" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                        @endif
                    </div>
                    @if(count($candidate_detail->softskills) == 0)
                    <p class="normal-text" style="font-family: Rubik Medium;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">None</p>
                    @endif
                    <div class="collapse" id="collapseAchievements">
                        @foreach($candidate_detail->softskills as $ss)
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{$ss->title}}</p>
                            <div style="padding-right:8vw;">   
                                <div style="text-align:right">  
                                    <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">{{$ss->score}}/10</p>

                                </div>
                                <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;background-color:#67BBA3" aria-valuenow="{{$ss->score}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
                        @if(count($candidate_detail->softskills) != 0)
                            <a data-toggle="collapse" href="#collapseSoftSkills" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                        @endif
                    </div>
                    @if(count($candidate_detail->softskills) == 0)
                    <p class="normal-text" style="font-family: Rubik Medium;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">None</p>
                    @endif
                    <div class="collapse" id="collapseSoftSkills">
                        @foreach($candidate_detail->achievements as $achievement)
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Coding 24 Jam Tanpa Makan</p>
                            <div style="padding-right:8vw;">   
                                <div style="text-align:right">  
                                    <p class="normal-text" style="font-family: Rubik Medium;color:#67BBA3;margin-bottom:0px;">9/10</p>

                                </div>
                                <div class="progress" style="height: 1.5vw;background-color:#AAD4C8 !important">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;background-color:#67BBA3" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
                        @if(count($candidate_detail->interests) != 0)
                            <a data-toggle="collapse" href="#collapseInterests" class="medium-heading" style="color:#2B6CAA"> <i class="fas fa-caret-down"></i> </a>
                        @endif
                    </div>
                    @if(count($candidate_detail->interests) == 0)
                    <p class="normal-text" style="font-family: Rubik Medium;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">None</p>
                    @endif
                    <div class="collapse" id="collapseInterests">
                        <div style="display:flex;align-items:center;flex-wrap:wrap">
                            @foreach($candidate_detail->interests as $interest)

                            <!-- START OF ONE CARD -->
                            <div style="display:flex;align-items:center;margin-right:2vw;font-family:Rubik Regular;color:#FFFFFF;margin-top:2vw;background-color:#67BBA3;padding:1vw;border-radius:10px">
                                <p class="normal-text" style="margin-bottom:0px">{{$interest->title}}</p>
                                <form style="margin-left:1vw" action=""> 
                                <button type="submit" style="background:none;border:none"> <i style="color:white" class="fas fa-trash"></i></button> 
                                </form>
                            </div>
                            <!-- END OF ONE CARD -->
                            @endforeach
                        </div>
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
