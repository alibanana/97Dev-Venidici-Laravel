@extends('./layouts/client-main')

@section('content')

<!-- NAVBAR -->

<!-- END OF NAVBAR -->
<div class="navbar-floating">
    <img src="/assets/images/client/logo-horizontal.png" style="width: 8vw;" class="img-fluid" alt="">
    <a href="" class="normal-text navbar-item navbar-item-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Home</a>
    <a href="" class="normal-text navbar-item " style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">For Corporate</a>
    <a href="" class="normal-text navbar-item " style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">For Public</a>
    <a href="" class="normal-text navbar-item " style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Community</a>
    <a href="" class="normal-text navbar-item " style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Sign In</a>
</div>
<!-- START OF BANNER SECTION -->
<div class="row m-0">
    <div class="col-md-6 p-0">
        <div class="page-container-left" style="padding-top: 13vw;padding-bottom:9vw">
            <p class="medium-heading" style="font-family: Rubik Bold;color:#3B3C43;white-space:pre-line" >Anytime, anywhere.
            Learn on your schedule
            from any device</p>
            <p class="sub-description" style="font-family: Rubik Regular;color:#808080;white-space:pre-line" >Lorem ipsum dolor sit amet, consectetur adipiscing 
            elit. Eget non dictum pellentesque nulla </p>
            <div style="display: flex;margin-top:2vw;">
                <div  class="blue-input-form" style="display: flex;align-items:center">
                    <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid" alt="">
                  
                    <input type="text" class="small-text" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);" placeholder="Course Title">
                 
                </div>
                <div style="margin-left: 1vw;">
                    <select class="blue-input-form small-text" style="height:100%" aria-label="">
                        <option selected>Open this to  select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div style="margin-left: 1vw;">
                    <button type="submit" class="btn-search small-text"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 p-0 home-background">
        <div style="margin-top:13.2vw;margin-left:1.5vw">
            <video style="width:33.5vw;height:23vw;border-radius:1vw;display:block;object-fit: cover;"  controls="false" >
                <source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
                <source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
                Your browser does not support HTML video.
            </video> 
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->

<!-- START OF TRUSTED COMPANY SECTION -->
<div class="row m-0 page-container" style="z-index: 99;padding-bottom:5vw">
    <div class="col-12 p-0" style="margin-top:-2vw">
        <div style="background-color: #FCFCFC;border-radius:10px;padding:2vw;display:flex;justify-content:space-between;align-items:center">
            <div style="text-align: center;">
                <p class="big-heading" style="font-family: Rubik Medium;color:#000000;margin-bottom:0px">10</p>
                <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA">Trusted Companies</p>
            </div>
            <img src="/assets/images/icons/vertical-splitter.png" style="max-height:4vw" class="img-fluid" alt="">
            <img src="/assets/images/client/logo-itb 2.png" style="max-height:4vw" class="img-fluid" alt="">
            <img src="/assets/images/client/bca-bank.png" style="max-height:4vw" class="img-fluid" alt="">
            <img src="/assets/images/client/flick.png" style="max-height:4vw" class="img-fluid" alt="">
            <img src="/assets/images/client/silvi.png" style="max-height:4vw" class="img-fluid" alt="">
        </div>
    </div>
</div>
<!-- END OFTRUSTED COMPANY SECTION -->

<!-- START OF OUR PROGRAMS SECTION -->
<div class="row m-0 page-container our-programs-background" style="padding-bottom:8vw">
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#55525B;margin-top:1vw">Our programs</p>
    </div>
    <div class="col-6 p-0">
        <div class="our-programs-card" style="width: 95%;">
            <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
            <div class="right-section" >
                <div>
                    <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA;">Program 1</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                </div>
                <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                    <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 1</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 p-0">
        <div style="display: flex;justify-content:flex-end">
            <div class="our-programs-card" style="width: 95%;">
                <img src="/assets/images/client/our-programs-card-dummy-2.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA;">Program 2</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 2</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 p-0">
        <div class="our-programs-card" style="width: 95%;">
            <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
            <div class="right-section" >
                <div>
                    <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA;">Program 3</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                </div>
                <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                    <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 3</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 p-0">
        <div style="display: flex;justify-content:flex-end">
            <div class="our-programs-card" style="width: 95%;">
                <img src="/assets/images/client/our-programs-card-dummy-2.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA;">Program 4</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 4</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF OUR PROGRAMS SECTION -->


<!-- START OF FEATURE, COURSE AND TESTIMONY SECTION -->
<div class="row m-0 page-container feature-section-background" style="padding-bottom: 8vw;">
    <!-- START OF FEATURE SECTION -->
    <div class="col-12 p-0" style="text-align: right;">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line">Our features that will revamp your
        online learning experience</p>
    </div>
    <div class="col-9 p-0">

        <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 10vw;">
                
                <div class="carousel-item active">
                    <div style="display: flex;align-items:center">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 20vw;" alt="">
                        <div style="margin-left:1vw">
                            <p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;">Feature number 1</p>
                            <p class="bigger-text" style="font-family: Rubik Regular;color:#3B3C43;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div style="display: flex;align-items:center">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 20vw;" alt="">
                        <div style="margin-left:1vw">
                            <p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;">Feature number 2</p>
                            <p class="bigger-text" style="font-family: Rubik Regular;color:#3B3C43;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla </p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev"   data-bs-target="#feature-carousel" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2.5vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#feature-carousel" role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2.5vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
    <!-- END OF FEATURE SECTION -->
    <!-- START OF CLASSES SECTION -->
    <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;">Top classes for you</p>
        <div style="padding:2vw 10vw 4vw 10vw;">
            <div style="display:flex;justify-content:space-between;align-items:center;background: #FFFFFF;border: 2px solid rgba(157, 157, 157, 0.1);border-radius: 10px;padding:1vw 3vw">
                <p class="normal-text btn-blue-on-hover btn-blue-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Most Popular</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Woki</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Online Course</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Bootcamp</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Workshop</p>
            </div>
        </div>
    </div>
    <div class="row m-0 p-0">
        <div class="col-4 p-0" >
            <div style="display: flex;justify-content:center">

                <!-- START OF ONE RED COURSE CARD -->
                <div class="course-card-red">
                    <div class="container">
                        <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                        <div class="top-left card-tag small-text" >Woki</div>
                    </div>
                    <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                        <div style="display:flex;justify-content:space-between;align-items:center">
                            <p class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B">How to be funny?</p>
                            <i style="font-size:2vw;" role="button"  aria-controls="woki-collapse" data-toggle="collapse" href="#woki-collapse" class="fas fa-caret-down"></i>
                        </div>
                        <div class="collapse" id="woki-collapse" style="margin-top:1vw">
                            <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                        </div>
                        <div style="display: flex;justify-content:space-between;margin-top:1vw" >
                            <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                            <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                        </div>
                        <hr>
                        <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                            <p class="sub-description" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                            <a href="#" class="course-card-button normal-text">Enroll Now</a>
                            <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                        </div>

                    </div>
                </div>
                <!-- END OF ONE RED COURSE CARD -->
            </div>
        </div>


        <div class="col-4 p-0" >
            <div style="display: flex;justify-content:center">
                <!-- START OF ONE BLUE COURSE CARD -->
                <div class="course-card-blue">
                    <div class="container">
                        <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                        <div class="top-left card-tag small-text" >Workshop</div>
                    </div>
                    <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                        <div style="display:flex;justify-content:space-between;align-items:center">
                            <p class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B">How to be funny?</p>
                            <i style="font-size:2vw;" role="button"  aria-controls="workshop-collapse" data-toggle="collapse" href="#workshop-collapse" class="fas fa-caret-down"></i>
                        </div>
                        <div class="collapse" id="workshop-collapse" style="margin-top:1vw">
                            <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                        </div>
                        <div style="display: flex;justify-content:space-between;margin-top:1vw" >
                            <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                            <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                        </div>
                        <hr>
                        <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                            <p class="sub-description" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                            <a href="#" class="course-card-button normal-text">Enroll Now</a>
                        </div>
        
                    </div>
                </div>
                <!-- END OF ONE BLUE COURSE CARD -->
            </div>
        </div>


        <div class="col-4 p-0" >
            <div style="display: flex;justify-content:center">
                <!-- START OF ONE GREEN COURSE CARD -->
                <div class="course-card-green">
                    <div class="container">
                        <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                        <div class="top-left card-tag small-text" >Online Course</div>
                    </div>
                    <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                        <div style="display:flex;justify-content:space-between;align-items:center">
                            <p class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B">How to be funny?</p>
                            <i style="font-size:2vw;" role="button"  aria-controls="course-collapse" data-toggle="collapse" href="#course-collapse" class="fas fa-caret-down"></i>
                        </div>
                        <div class="collapse" id="course-collapse" style="margin-top:1vw">
                            <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">sAnim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                        </div>
                        <div style="display: flex;justify-content:space-between;margin-top:1vw" >
                            <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                            <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                        </div>
                        <hr>
                        <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                            <p class="sub-description" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                            <a href="#" class="course-card-button normal-text">Enroll Now</a>
                        </div>
        
                    </div>
                </div>
                <!-- END OF ONE GREEN COURSE CARD -->
            </div>
        </div>
    </div>

    <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
        <a href="#" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;">View All</a>

    </div>
    <!-- END OF CLASSES SECTION -->

    <!-- START OF TESTIMONY SECTION -->
    <div class="row m-0 page-container" style="padding-top: 10vw;">
        <div class="col-12 col-md-7 p-0 ">
            <div style="display: flex;align-items:center;">
                <!-- LEFT TESTIMONY -->
                <div>
                    <!-- BIG TESTIMONY CARD -->
                    <div class="testimony-card" style="width: 20vw;">
                        <img src="/assets/images/client/testimony-image-dummy.png" class="img-fluid" style="width: 6vw;height:auto" alt="">
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000; display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 5 !important;
                        -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                        <div style="display: flex;justify-content:center">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width:1vw;height:auto" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width:1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width:1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width:1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width:1vw;height:auto;margin-left:0.5vw" alt="STAR">
                        </div>
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-top:1vw;margin-bottom:0.4vw">Gabriel Amileano</p>
                        <p class="small-text" style="font-family: Rubik Medium;color:#808080;margin-bottom:0px">Copy Writer</p>
                    </div>
                    <!-- END OF BIG TESTIMONY CARD -->
    
                    <!-- SMALL TESTIMONY CARD -->
                    <div class="testimony-card" style="margin-top: 2vw;width: 20vw;">
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-bottom:0.4vw">4.9/5</p>
                        <div style="display: flex;justify-content:center">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000;margin-top:2vw;margin-bottom:0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
    
                    </div>
                    <!-- END OF SMALL TESTIMONY CARD -->
                </div>
                <!-- END OF LEFT TESTIMONY -->

                <!-- RIGHT TESTIMONY -->
                <div style="margin-left: 2vw;">
                     <!-- SMALL TESTIMONY CARD -->
                     <div class="testimony-card" style="margin-top: 2vw;width: 16vw;">
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-bottom:0.4vw">4.9/5</p>
                        <div style="display: flex;justify-content:center">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000;margin-top:2vw;margin-bottom:0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
    
                    </div>
                    <!-- END OF SMALL TESTIMONY CARD -->
                    <!-- BIG TESTIMONY CARD -->
                    <div class="testimony-card"  style="width: 16vw;margin-top:2vw">
                        <img src="/assets/images/client/testimony-image-dummy.png" class="img-fluid" style="width: 6vw;height:auto" alt="">
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
                        <div style="display: flex;justify-content:center">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                            <img src="/assets/images/client/star.svg" class="img-fluid" style="width: 1vw;height:auto;margin-left:0.5vw" alt="STAR">
                        </div>
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-top:1vw;margin-bottom:0.4vw">Gabriel Amileano</p>
                        <p class="small-text" style="font-family: Rubik Medium;color:#808080;margin-bottom:0px">Copy Writer</p>
                    </div>
                    <!-- END OF BIG TESTIMONY CARD -->
    
                   
                </div>
                <!-- END OF RIGHT TESTIMONY -->
            </div>
        </div>
        <div class="col-12 col-md-5 p-0" style="display: flex;flex-direction: column;justify-content: center;">
            <p class="medium-heading" style="font-family: Rubik Medium;color:#000000;">Our higlighted students revealing</p>
            <p class="sub-description" style="font-family: Rubik Regular;color:#000000;margin-top:2vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

        </div>
    </div>
    <!-- END OF TESTIMONY SECTION -->
</div>
<!-- END OF FEATURE, COURSE AND TESTIMONY SECTION -->

<script>
    console.log("kepanggil");
    $(window).scroll(function () {
    var Bottom = $(window).height() + $(window).scrollTop() >= $(document).height();
    if(Bottom)
    {
    console.log('what');
    }
    });
</script>
@endsection