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
                    <p class="medium-heading" style="font-family: Rubik Bold;color:orange;margin-bottom:3vw">Requested Profile</p>
                </div>

                <div class="row m-0">
                    <div class="col-lg-3 col-xs-12 p-0">
                        <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:13vw;height:17vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-9 col-xs-12 p-0" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
                        <div>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Hi, my name is</p>
                            <p class="medium-heading" style="font-family: Rubik Bold;color:#FFFFFF">Gracevieli Krisetya Nissi Vidyananto</p>
                            <p class="bigger-text" style="font-family: Rubik Regular;color:#FFFFFF">I have 2 Years of experience in Public Relations</p>
                            <div style="display:flex;align-items:center;margin-top:3vw">   
                                <div>
                                    <a href="" class="a-white" style="">Download CV</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-0" style="margin-top:4vw">
                        <p class="small-heading" style="font-family: Rubik Bold;color:#FFFFFF">About me</p>
                        <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF">Massa nulla suspendisse adipiscing viverra est eget id hendrerit risus. Fermentum penatibus purus pulvinar elit est nisl lorem. Tristique dui lorem sed vehicula est purus urna scelerisque. Scelerisque sapien scelerisque nisi, fames amet diam ornare et. Nec dignissim enim, fermentum malesuada euismod nec elementum cras libero.</p>

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
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Product Analyst Intern at Blibli.com</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">19 September 2020 - 19 September 2021</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">Jakarta</p>
                        </div>
                        <!-- END OF ONE GREY CARD -->
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Product Analyst Intern at Blibli.com</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">19 September 2020 - 19 September 2021</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">Jakarta</p>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Product Analyst Intern at Blibli.com</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">19 September 2020 - 19 September 2021</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">Jakarta</p>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Design 2 Jam Per Hari</p>
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
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Product Analyst Intern at Blibli.com</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">19 September 2020 - 19 September 2021</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">Jakarta</p>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Design 2 Jam Per Hari</p>
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
                        <!-- START OF ONE GREY CARD -->
                        <div class="" style="background-color:#EEEEEE;padding:1.5vw;border-radius:5px;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Product Analyst Intern at Blibli.com</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">19 September 2020 - 19 September 2021</p>
                            <p class="normal-text" style="font-family: Rubik Bold;color:#B3B5C2;margin-bottom:0px;margin-top:0.5vw">Jakarta</p>
                        </div>
                        <!-- END OF ONE GREY CARD -->
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
