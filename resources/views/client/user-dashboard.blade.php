@extends('./layouts/client-main')
@section('title', 'Venidici User Dashboard')

@section('content')

<!-- START OF TOP SECTION -->
<div class="row m-0 page-container" style="padding-top:14vw;">
    <div class="col-12 p-0" style="display:flex;justify-content:center">
        <div class="card-white" style="height:18vw;padding:1.5vw 1.5vw;width:49vw;display:flex;align-items:center">
            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:15vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="DISPLAY PICTURE">
            <div style="margin-left:1.5vw;width:100%;display: flex;flex-direction: column;justify-content: flex-end;">
                <div style="display:flex;justify-content:space-between;">
                    <p class="sub-description" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">Gabriel Amileano Vidyananto</p> 
                    <div class="dropdown show">
                        
                        <a class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Edit</a>

                        <div class="dropdown-menu" aria-labelledby="editDropdown" style="">
                            <div class="dropdown-item" >
                                <a href="#" class="normal-text" style="font-family:Rubik Regular;color:#000000;margin-bottom:0px;text-decoration:none">Edit Profile</a>   
                            </div>
                            <div class="dropdown-item" style="margin-top:0.5vw">
                                <a href="#" class="normal-text" style="font-family:Rubik Regular;color:#000000;margin-bottom:0px;text-decoration:none">Change Password</a>   
                            </div>
                        </div>
                    </div>  
                </div>
                <p class="bigger-text" style="font-family:Rubik Medium;color:#F4C257;margin-bottom:0px">10 Points</p>   
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">gabrielamileano@gmail.com</p>   
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">Student</p>   
                <div style="width:70%">
                    <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">Jalan duren tiga indah 5 Blok I no. 11, Pancoran, Jakarta Selatan, DKI Jakarta, 13720</p>   
                </div>
                <div style="display:flex;align-items:center;margin-top:0.8vw">   
                    <p class="small-text" style="font-family:Rubik Medium;color:#2B6CAA;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px">Tech</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#CE3369;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px;margin-left:1vw">Art</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#67BBA3;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px;margin-left:1vw">Math</p>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- END OF TOP SECTION -->


<!-- START OF MIDDLE SECTION -->
<div class="row m-0 page-container-inner" style="padding-top:4vw;padding-bottom:4vw">
    <div class="col-12 p-0" style="">
        <div style="display:flex">

            <p class="sub-description blue-text-underline blue-text-underline-active user-links" onclick="changeContent(event, 'live-pelatihan')"  style="font-family:Rubik Medium;cursor:pointer;margin-bottom:0px">Jadwal Live Pelatihan</p>
            <p class="sub-description blue-text-underline user-links" onclick="changeContent(event, 'pelatihan-aktiv')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px">Pelatihan Aktiv</p>
            <p class="sub-description blue-text-underline user-links" onclick="changeContent(event, 'pelatihan-selesai')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px">Pelatihan Selesai</p>
        </div>
    </div>
    <!-- Live Pelatihan Content -->
    <div style="padding:0px" class="user-content" id="live-pelatihan">
        <div class="col-12 p-0">
            <div class="red-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Woki</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">19 August 2021  |  09:00 - 12:00</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-bottom:2vw">View Details</a>
                        <a href="" id="meeting-link" class="small-text" style="font-family:Rubik Medium;margin-top:2vw">Meeting Link</a>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Workshop</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">19 August 2021  |  09:00 - 12:00</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-bottom:2vw">View Details</a>
                        <a href="" id="meeting-link" class="small-text" style="font-family:Rubik Medium;margin-top:2vw">Meeting Link</a>
                    </div>
                </div> 
            </div>
        </div>

    </div>
    <!-- End of Live Pelatihan Content -->

    <!-- Pelatihan Aktiv Content -->
    <div style="padding:0px;display:none" class="user-content" id="pelatihan-aktiv">
        <div class="col-12 p-0">
            <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Woki</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;margin-bottom:0px;">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <div class="progress progress-bar-vertical">
                            <div class="progress-bar-blue" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: 30%;">
                            30%
                            </div>
                        </div>
                        <a href="/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Lanjutkan</a>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="red-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Workshop</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;margin-bottom:0px;">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <div class="progress progress-bar-vertical">
                            <div class="progress-bar-red" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: 50%;">
                            50%
                            </div>
                        </div>
                        <a href="/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Lanjutkan</a>
                    </div>
                </div> 
            </div>
        </div>

    </div>
    <!-- End of Pelatihan Aktiv Content -->

    <!-- Pelatihan Selesai Content -->
    <div style="padding:0px;display:none;" class="user-content" id="pelatihan-selesai">
        <div class="col-12 p-0">
            <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Woki</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;margin-bottom:0px;">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <i class="fas fa-check-circle big-heading"></i>
                        <a href="" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Cek Sertifikat</a>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="red-bordered-card" style="margin-top:2.5vw;display:flex">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Workshop</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;margin-bottom:0px;">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <i class="fas fa-check-circle big-heading"></i>
                        <a href="" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Cek Sertifikat</a>
                    </div>
                </div> 
            </div>
        </div>

    </div>
    <!-- End of Pelatihan Selesai Content -->
</div>
<!-- END OF MIDDLE SECTION -->

<!-- START OF SARAN KAMI SECTION -->
<div class="row m-0 page-container-inner" style="padding-top:2vw;padding-bottom:6vw">
    <div class="col-12 p-0" style="text-align:center">
        <p class="small-heading" style="font-family:Rubik Medium;margin-bottom:0px;color:#3B3C43">Saran kelas dari kami</p>
    </div>
    <div class="col-12 p-0" style="margin-top:3vw">
        <div id="saran-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 3.5vw;">
                
                <div class="carousel-item active">
                    <div style="display:flex;align-items:center;justify-content:center">
                        <!-- START OF ONE GREEN COURSE CARD -->
                        <div class="course-card-green" style="margin-right:2vw">
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
                        <!-- START OF ONE GREEN COURSE CARD -->
                        <div class="course-card-green" style="margin-left:2vw">
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
                <div class="carousel-item">
                    <div style="display:flex;align-items:center;justify-content:center">
                        <!-- START OF ONE GREEN COURSE CARD -->
                        <div class="course-card-green" style="margin-right:2vw">
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
                        <!-- START OF ONE GREEN COURSE CARD -->
                        <div class="course-card-green" style="margin-left:2vw">
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

            </div>
            <a class="carousel-control-prev"   data-bs-target="#saran-carousel" style="width:2.5vw;padding-left:5vw" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#saran-carousel" style="width:2.5vw;padding-right:5vw"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
</div>
<!-- END OF SARAN KAMI SECTION -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function changeContent(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("user-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("user-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("blue-text-underline-active", "blue-text-underline");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " blue-text-underline-active";
        }
         
</script>
@endsection