@extends('./layouts/client-main')
@section('title', 'Venidici Home')

@section('content')

<!-- START OF BANNER SECTION 
<div class="row m-0">
    <div class="col-md-6 p-0">
        <div class="page-container-left" style="padding-top: 13vw;padding-bottom:9vw">
            <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43;white-space:pre-line" >Anytime, anywhere.
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
            <video style="width:33.8vw;height:23vw;border-radius:1vw;display:block;object-fit: cover;"  controls="false" >
                <source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
                <source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
                Your browser does not support HTML video.
            </video> 
        </div>
    </div>
</div>
 END OF BANNER SECTION -->

<div class="row m-0 banner-background" style="height:47vw">
    <div class="col-md-12 p-0">
        <div class="page-container-left" style="padding-top: 13vw;padding-bottom:9vw">
            <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line" >Selamat datang di
        Venidici</p>
            <p class="sub-description" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line" >“Veni, vidi, vici.” Saya datang, saya lihat, saya
            taklukkan.</p>
            <div style="display: flex;margin-top:2vw;">
                <div  class="grey-input-form" style="display: flex;align-items:center">
                    <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid" alt="">
                  
                    <input type="text" class="small-text" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);" placeholder="Course Title">
                 
                </div>
                <div style="margin-left: 1vw;">
                    <select class="grey-input-form small-text" style="height:100%;appearance:none" aria-label="">
                        <option selected>Categories</option>
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
</div>

<!-- START OF TRUSTED COMPANY SECTION -->
<div class="row m-0 page-container" style="z-index: 99;padding-bottom:5vw">
    <div class="col-12 p-0" style="margin-top:-6vw">
        <div style="background-color: #FCFCFC;border-radius:10px;padding:1vw 2vw;display:flex;justify-content:space-between;align-items:center">
            <div style="text-align: center;">
                <p class="big-heading" style="font-family: Rubik Medium;color:#000000;margin-bottom:0px">10</p>
                <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA">Trusted Companies</p>
            </div>
            <img src="/assets/images/icons/vertical-splitter.png" style="max-height:6vw" class="img-fluid" alt="">
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
        <p class="medium-heading" style="font-family: Rubik Medium;color:#55525B;margin-top:1vw;margin-bottom:0px">Our <span class="big-heading" style="font-family:Hypebeast;margin-left:1vw" >PROGRAMS</span></p>
    </div>
    <div class="col-6 p-0">
        <div class="our-programs-card" style="margin-top:2.5vw">
            <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
            <div class="right-section" >
                <div>
                    <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;">Program 1</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                </div>
                <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                    <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 1</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 p-0" style="display:flex;justify-content:flex-end;margin-top:2.5vw">
        <div class="our-programs-card">
            <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
            <div class="right-section" >
                <div>
                    <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;">Program 1</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                </div>
                <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                    <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 1</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 p-0">
        <div class="our-programs-card" style="margin-top:2.5vw">
            <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
            <div class="right-section" >
                <div>
                    <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;">Program 1</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                </div>
                <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                    <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 1</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 p-0" style="display:flex;justify-content:flex-end;margin-top:2.5vw">
        <div class="our-programs-card">
            <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
            <div class="right-section" >
                <div>
                    <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;">Program 1</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                </div>
                <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                    <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 1</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF OUR PROGRAMS SECTION -->

<!-- START OF FEATURE, COURSE AND TESTIMONY SECTION -->
<div class="row m-0 page-container feature-background" style="padding-bottom: 6vw;">
    <!-- START OF FEATURE SECTION -->
    <div class="col-12 p-0 " style="text-align: right;">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;padding-right:5vw;margin-top:4vw">Apa yang akan kamu
        dapat dari Venidici?</p>
    </div>
    <div class="col-8 p-0">

        <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel" style="margin-top:-3vw">
            <div class="carousel-inner" style="padding: 0vw 6vw;">
                
                <div class="carousel-item active">
                    <div class="card-white" style="display: flex;align-items:center;height:15vw">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 18vw;" alt="">
                        <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: center;">
                            <p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;">Feature number 1</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-white" style="display: flex;align-items:center;height:15vw">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 18vw;" alt="">
                        <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: center;">
                            <p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;">Feature number 2</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev"   data-bs-target="#feature-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2.5vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#feature-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2.5vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
    <!-- END OF FEATURE SECTION -->
    <!-- START OF CLASSES SECTION -->
    <div class="col-12 p-0" style="text-align: center;margin-top:12vw">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;">Top <span class="big-heading" style="font-family:Hypebeast;color:#A24A9C" >CLASSES</span> for you</p>
        <div style="padding:2vw 13.5vw 4vw 13.5vw;">
            <div style="display:flex;justify-content:space-between;align-items:center;background: #FFFFFF;border: 2px solid rgba(157, 157, 157, 0.1);border-radius: 10px;padding:0.7vw">

                <p class="normal-text btn-blue-on-hover btn-blue-active course-links" onclick="changeCourse(event, 'course-popular')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Most Popular</p>
                <p class="normal-text btn-blue-on-hover course-links"  onclick="changeCourse(event, 'course-woki')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Woki</p>
                <p class="normal-text btn-blue-on-hover course-links" onclick="changeCourse(event, 'course-online')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Online Course</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Bootcamp</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Workshop</p>
            </div>
        </div>
    </div>
    <!-- MOST POPULAR -->
    <div class="course-content" id="course-popular">
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
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
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
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
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
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="course-card-button normal-text">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE GREEN COURSE CARD -->
                </div>
            </div>
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="#" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;">View All</a>

            </div>
        </div>
    </div>
    <!-- END OF MOST POPULAR -->
    <!-- WOKI -->
    <div class="course-content" id="course-woki" style="display:none">
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
                                <i style="font-size:2vw;" role="button"  aria-controls="woki-collapse-one" data-toggle="collapse" href="#woki-collapse-one" class="fas fa-caret-down"></i>
                            </div>
                            <div class="collapse" id="woki-collapse-one" style="margin-top:1vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                            <div style="display: flex;justify-content:space-between;margin-top:1vw" >
                                <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                            </div>

                        </div>
                    </div>
                    <!-- END OF ONE RED COURSE CARD -->
                </div>
            </div>
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
                                <i style="font-size:2vw;" role="button"  aria-controls="woki-collapse-two" data-toggle="collapse" href="#woki-collapse-two" class="fas fa-caret-down"></i>
                            </div>
                            <div class="collapse" id="woki-collapse-two" style="margin-top:1vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                            <div style="display: flex;justify-content:space-between;margin-top:1vw" >
                                <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                            </div>

                        </div>
                    </div>
                    <!-- END OF ONE RED COURSE CARD -->
                </div>
            </div>
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
                                <i style="font-size:2vw;" role="button"  aria-controls="woki-collapse-three" data-toggle="collapse" href="#woki-collapse-three" class="fas fa-caret-down"></i>
                            </div>
                            <div class="collapse" id="woki-collapse-three" style="margin-top:1vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                            <div style="display: flex;justify-content:space-between;margin-top:1vw" >
                                <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                            </div>

                        </div>
                    </div>
                    <!-- END OF ONE RED COURSE CARD -->
                </div>
            </div>
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="#" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;">View All</a>

            </div>

            
        </div>
    </div>
    <!-- END OF WOKI -->

    <!-- ONLINE COURSE -->
    <div class="course-content" id="course-online" style="display:none">
        <div class="row m-0 p-0">
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
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                <a href="#" class="course-card-button normal-text">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE GREEN COURSE CARD -->
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
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                <a href="#" class="course-card-button normal-text">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE GREEN COURSE CARD -->
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
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                <a href="#" class="course-card-button normal-text">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE GREEN COURSE CARD -->
                </div>
            </div>
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="#" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;">View All</a>
            </div>
        </div>
    </div>
    <!-- END OF ONLINE COURSE -->

    <!-- END OF CLASSES SECTION -->
    
</div>
<!-- END OF FEATURE, COURSE AND TESTIMONY SECTION -->
<!-- START OF TESTIMONY SECTION -->
<div class="row m-0 page-container" style=";background:#F6F6F6">
        <div class="col-12 col-md-6" style="padding-top:4vw;padding-bottom:4vw">
            <div style="display: flex;align-items:center;">
                <!-- LEFT TESTIMONY -->
                <div>
                    <!-- BIG TESTIMONY CARD -->
                    <div class="testimony-card" style="width: 20vw;">
                        <img src="{{ asset($fake_testimonies_big[0]->thumbnail) }}" class="img-fluid" style="width: 6vw;height:auto" alt="thumbnail not avaliable..">
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000; display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 5 !important;
                        -webkit-box-orient: vertical !important;">{{ $fake_testimonies_big[0]->content }}</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_big[0]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-top:1vw;margin-bottom:0.4vw">{{ $fake_testimonies_big[0]->name }}</p>
                        <p class="small-text" style="font-family: Rubik Medium;color:#808080;margin-bottom:0px">{{ $fake_testimonies_big[0]->occupancy }}</p>
                    </div>
                    <!-- END OF BIG TESTIMONY CARD -->
    
                    <!-- SMALL TESTIMONY CARD -->
                    <div class="testimony-card" style="margin-top: 2vw;width: 20vw;">
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-bottom:0.4vw">{{ $fake_testimonies_small[0]->rating }}/5</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_small[0]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000;margin-top:1vw;margin-bottom:0px">{{ $fake_testimonies_small[0]->content }}</p>
    
                    </div>
                    <!-- END OF SMALL TESTIMONY CARD -->
                </div>
                <!-- END OF LEFT TESTIMONY -->

                <!-- RIGHT TESTIMONY -->
                <div style="margin-left: 2vw">
                     <!-- SMALL TESTIMONY CARD -->
                     <div class="testimony-card" style="margin-top: 2vw;width: 16vw;">
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-bottom:0.4vw">{{ $fake_testimonies_small[1]->rating }}/5</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_small[1]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000;margin-top:2vw;margin-bottom:0px">{{ $fake_testimonies_small[1]->content }}</p>
                    </div>
                    <!-- END OF SMALL TESTIMONY CARD -->
                    <!-- BIG TESTIMONY CARD -->
                    <div class="testimony-card"  style="width: 16vw;margin-top:2vw">
                        <img src="{{ asset($fake_testimonies_big[1]->thumbnail) }}" class="img-fluid" style="width: 6vw;height:auto" alt="">
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000">{{ $fake_testimonies_big[1]->content }}</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_big[1]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-top:1vw;margin-bottom:0.4vw">{{ $fake_testimonies_big[1]->name }}</p>
                        <p class="small-text" style="font-family: Rubik Medium;color:#808080;margin-bottom:0px">{{ $fake_testimonies_big[1]->occupancy }}</p>
                    </div>
                    <!-- END OF BIG TESTIMONY CARD -->

                </div>
                <!-- END OF RIGHT TESTIMONY -->
            </div>
        </div>
        <div class="col-12 col-md-6" style="display: flex;flex-direction: column;justify-content: center;">
            <p class="medium-heading" style="font-family: Rubik Medium;color:#000000;">Our higlighted students revealing</p>
            <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;margin-top:1vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

        </div>
    </div>
    <!-- END OF TESTIMONY SECTION -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function changeCourse(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("course-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("course-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("btn-blue-active", "btn-blue-on-hover");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " btn-blue-active";
        }
         
</script>
@endsection