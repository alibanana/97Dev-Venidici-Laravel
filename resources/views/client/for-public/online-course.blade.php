@extends('./layouts/client-main')
@section('title', 'Venidici Skill Snack')

@section('content')
<div class="desktop-display">
    <!-- START OF TOP SECTION -->
    <div class="row m-0 page-container for-public-oc-background " style="height:55vw">
        <div class="col-6 p-0">
            <div style="padding-top:11vw;margin-left:-0.5vw" class="wow fadeInUp" data-wow-delay="0.3s">
                <img src="/assets/images/client/Venidici_Logo_Horizontal_White.png" style="width:20vw;" class="img-fluid" alt="Image 1">
                <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line;line-height:3.5vw;margin-top:1.5vw">Fun learning anytime
                & anywhere</p>
                <p class="normal-text" style="font-family: Rubik Medium;color:#FFFFFF;white-space:pre-line;padding-top:0vw;line-height:2vw">Dear kamu yang takut punya komitmen, ini buat kamu! Belajar berbagai skill jempolan dengan durasi singkat di Skill Snack. Time saving, flexible, all those good things basically</p>
                <div class="row m-0">
                    <div class="col-9 p-0">
                        <div style="margin-top:0.5vw;text-align:center">
                            <p class="bigger-text" style="font-family: Rubik Bold;color:#FFFFFF;">Explore our programs </p>
                            <div style="display:flex;justify-content:center;align-items:center;">
                                <a href="/for-public/online-course" class="normal-text blue-link blue-link-active" style="font-family:Rubik Medium;margin-right:1.5vw;width:10vw">
                                    Skill Snack
                                </a>
                                <a href="/for-public/woki" class="normal-text red-link" style="font-family:Rubik Medium;width:10vw">
                                    Woki
                                </a>
                                <!-- <a href="/for-public/bootcamp" class="normal-text bootcamp-link" style="font-family:Rubik Medium;width:10vw;margin-left:1.5vw;">
                                    Bootcamp
                                </a> -->
                                <!--
                                <a href="#" class="normal-text yellow-link" style="font-family:Rubik Medium;margin-left:1.5vw">
                                    Sharing Session
                                </a>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    
    <!-- END OF TOP SECTION -->
    
    <!-- START OF OUR HISTORY -->
    <div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw">
        <div class="col-6">
            <div style="display:flex;align-items:center">
                <div>
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:22vw">
                        <img src="/assets/images/client/ForPublic_1.png" style="width:19vw;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:8vw;margin-top:0.5vw">
                        <img src="/assets/images/client/ForPublic_2.png" style="width:19vw;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                    </div>
                </div>
                <div style="margin-left:1vw">
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:8vw">
                        <img src="/assets/images/client/ForPublic_3.png" style="width:13vw;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:18vw;margin-top:0.5vw">
                        <img src="/assets/images/client/ForPublic_4.png" style="width:13vw;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 wow fadeInRight"data-wow-delay="0.3s">
            <!-- <p class="small-heading" style="font-family: Rubik Medium;color:#67BBA3">Our History</p> -->
            <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">Skill Snack Live</p>
            <p class="bigger-text" style="margin-bottom:2vw;font-family: Rubik Regular;color:#000000;white-space:pre-line;padding-top:1vw">Enjoy sesi live workshop ngomongin berbagai topik dan skill yang bisa kamu pelajari bersama expert-expert di bidangnya.</p>
            <a href="/online-course?cat=Featured" class="normal-text btn-dark-blue" style="text-decoration:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;padding:0.5vw 2vw">See upcoming live session</a>
    
        </div>
    </div>
    <!-- END OF OUR HISTORY -->
    
    <!-- START OF KENAPA MEMILIH Skill Snack -->
    <div class="row m-0 page-container" style="padding-bottom:8vw   ">
        <div class="col-6 wow fadeInLeft" data-wow-delay="0.3s" style="display: flex;flex-direction: column;justify-content: center;padding-right:2vw">
            <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">Skill Snack On-Demand</p>
            <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;white-space:pre-line;padding-top:1vw">Bukan zamannya belajar itu jadi beban, it’s a privilege! Belajar kapanpun dan dimanapun, kamu yang tentuin karena Skill Snack berisi rekaman course-course Venidici dengan rating terbaik. Ketinggalan course live nya? Ga masalah dong.</p>
            <div>
                <a href="/online-course?cat=Featured" class="normal-text btn-dark-blue" style="text-decoration:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">See upcoming live session</a>
            </div>
    
        </div>
        <div class="col-6" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
              <img src="/assets/images/client/kenapa_online_course.png" style="width:38vw;object-fit:cover;height:25vw;border-radius: 10px" class="img-fluid" alt="Image 1">
        </div>
        
    </div>
    <!-- END OF KENAPA MEMILIH Skill Snack -->
    
    <!-- START OF OUR MISSION -->
    <div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw;background-color:#F6F6F6">
        <div style="text-align:center" class="wow flash" data-wow-delay="0.3s">
            <p class="sub-description" style="font-family: Rubik Medium;color:#67BBA3">Our Mission</p>
            <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">Effective Learning for You</p>
        </div>
        <div class="row m-0" style="padding-top:2vw">
            <div class="col-4" style="display:flex;justify-content:center">
                <div class="our-mission-card" style="">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#000000;margin-bottom:0px">1.</p>
                    <div style="">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                        </div>
                        <div style="height:3vw;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#67BBA3;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;">Lifetime flexible access</p>
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;">Cukup beli sekali dengan nominal yang kamu inginkan, akses seumur hidup. Kapanpun dimanapun</p>
                    </div>
                </div>
            </div>
            <div class="col-4" style="display:flex;justify-content:center">
                <div class="our-mission-card" style="">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#000000;margin-bottom:0px">2.</p>
                    <div style="">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                        </div>
                        <div style="height:3vw;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#67BBA3;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;">Learning by doing</p>
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;">Ada materi penunjang tambahan seperti case study, slides, ataupun templates untuk kamu pelajari lebih dalam lagi! Terus, uji kepahamanmu lewat quiz dan berbagai assessment.</p>
                    </div>
                </div>
            </div>
            <!--
            <div class="col-3">
                <div class="our-mission-card" style="">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#000000;margin-bottom:0px">3.</p>
                    <div style="">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                        </div>
                        <div style="height:3vw;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#67BBA3;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;">Fitur Assesment sebagai pemantapan materi</p>
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                </div>
            </div>
    -->
            <div class="col-4" style="display:flex;justify-content:center">
                <div class="our-mission-card" style="">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#000000;margin-bottom:0px">3.</p>
                    <div style="">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                        </div>
                        <div style="height:3vw;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#67BBA3;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;">Credible mentors</p>
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;">Dipandu oleh mentor berpengalaman dari perusahaan ternama, pasti kamu akan dapet banyak insight!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF OUR MISSION -->
    
    <!-- START OF OUR VALUES 
    <div class="row m-0 page-container our-values-background" style="padding-top:15vw;padding-bottom:15vw">
        <div class="col-12 p-0 wow fadeInLeft" data-wow-delay="0.3s">   
            <p class="sub-description" style="font-family: Rubik Medium;color:#67BBA3">Our Values</p>
            <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">feeding your curiosity engaged <br> on the go</p>
            <div style="width:60vw;margin-top:2vw">
                <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;white-space:pre-line">Venidici memberikan berbagai macam program yang dapat diikuti oleh masyarakat luas. Mulai dari bla bla bla dan ini adalah sebuah bla bla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Erat urna commodo eget sem. 
    
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper in proin egestas mollis id lacinia nec. Nunc felis mi bibendum facilisi sollicitudin tempor, ultricies. Dignissim montes, risus ultrices egestas. At in suscipit nulla eget. Dictum lacus donec imperdiet malesuada.</p>
            </div>
        </div>
    </div>
     END OF OUR VALUES-->
    
    <!-- START OF HIGHLIGHTED EVENTS 
    <div class="row m-0 page-container" style="padding-top:6vw;padding-bottom:6vw;background-color:#F6F6F6">
        <div class="col-12">
            <p class="big-heading wow flash" data-wow-delay="0.3s" style="font-family: Rubik Medium;color:#3B3C43;margin-left:2.9vw">Highlighted <span style="font-family:Hypebeast;color:#67BBA3">Events</span> </p>
        </div>
        <div class="row m-0" style="display:flex;align-items:center;padding-top:1.5vw">   
    
            <div class="col-6 p-0">
                <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                    <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                        
                        <div class="carousel-item active" >
                            <img src="/assets/images/client/Highlighted_Events.png" style="width:100%;height:20vw" class="img-fluid" alt="Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/images/client/Highlighted_Events.png" style="width:100%;height:20vw" class="img-fluid" alt="Image 1">
                        </div>
                    </div>
                    <a class="carousel-control-prev"   data-bs-target="#feature-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                        <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                        <span class="visually-hidden">Prev</span>
                    </a>
                    <a class="carousel-control-next"   data-bs-target="#feature-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                        <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>  
            </div>
            <div class="col-6">
                <div style="padding-left:2vw">
                    <p class="small-heading" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">Judul Event</p>
                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43">Saturday, 10 November 2020</p>
                    <p class="normal-text" style="font-family: Rubik Regular;color:#000000;white-space:pre-line;margin-top:2vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Venenatis leo erat lacus fermentum netus donec. Massa ipsum sit a ornare neque a. Arcu dictumst eu dapibus quam turpis aliquam.
    
                        Venidici memberikan berbagai macam program yang dapat diikuti oleh masyarakat luas. Mulai dari bla bla bla dan ini adalah sebuah bla bla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Erat urna commodo eget sem. </p>
                </div>
            </div>
        </div>
    </div>
     END OF HIGHLIGHTED EVENTS -->
    
    <!-- START OF FAQ SECTION -->
    <div class="row m-0 page-container faq-background" style="padding-top:6vw;padding-bottom:6vw">
        <div class="col-12 p-0" style="text-align:center">
            <p class="big-heading" style="font-family: Rubik Medium;color:#3B3C43">Frequently Asked <span style="font-family:Hypebeast;color:#67BBA3">Questions</span> </p>
        </div>
        <!-- START OF QUESTION SECTION -->
        <div class="col-12 p-0" style="display:flex;justify-content:center;margin-top:1.5vw">
            <div style="background-color:#F9F9F9;padding:1.5vw;border-radius:10px;width:92%">
                <!-- START OF ONE FAQ CARD -->
                <div class="faq-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Apakah saya bisa mendapatkan refund?</p>
                        <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ1" role="button" aria-expanded="false" aria-controls="collapseFaQ1">
                            <i class="fas fa-chevron-down"></i>
                        </p>                                    
                    </div>
                    <div class="collapse" id="collapseFaQ1" style="margin-top:1vw">
                        <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular;white-space:pre-line">Untuk Workshop Live terdapat money-back guarantee jika kamu merasa tidak puas dengan menghubungi kami. Tidak terdapat refund untuk program Skill Snack</div>
                </div>
                <!-- END OF ONE FAQ CARD -->
                <!-- START OF ONE FAQ CARD -->
                <div class="faq-card" style="margin-top:1vw">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Apa saja yang saya dapatkan di Venidici Skill Snack?</p>
                        <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ2" role="button" aria-expanded="false" aria-controls="collapseFaQ2">
                            <i class="fas fa-chevron-down"></i>
                        </p>                                    
                    </div>
                    <div class="collapse" id="collapseFaQ2" style="margin-top:1vw">
                        <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular"> 
                        Kamu bisa melihat detail setiap course di page ya. Yang pasti, di setiap course, akan ada video pembelajaran, penilaian, dan sertifikat jika kamu sudah menyelesaikan semuanya!
    </p>
                    </div>
                </div>
                <!-- END OF ONE FAQ CARD -->
                
            </div>
        </div>
        <!-- END OF QUESTION SECTION -->
    </div>
    <!-- END OF FAQ SECTION -->
    
    <!-- START OF NEWSLETTER SECTION -->
    <div class="row m-0 page-container" style="padding-bottom:8vw">
        <div class="col-12" style="padding:0vw 3vw">
            <div style="background-color:#1A1C31;padding:2vw 4vw;border-radius: 10px;display:flex;align-items:center">
                <img src="/assets/images/client/Newsletter_Illustration.png" style="height:10vw" class="img-fluid" alt="Newsletter Illustration">
                <div style="width:60%;margin-left:2vw">
                    <p class="small-heading wow fadeInUp" data-wow-delay="0.3s" style="color:#FFFFFF;font-family:Rubik Bold">Let’s learn together!</p>
                    
                    <!-- <p class="normal-text" style="color:#FFFFFF;font-family:Rubik Regular;width:75%;"> 
                    Bukan zamannya belajar itu jadi beban, it’s a privilege! Belajar kapanpun dan dimanapun, kamu yang tentuin!                </p> -->
                    <!--<a href="#"style="text-decoration: none;font-family:Rubik Regular;margin-left:2vw;padding:0vw"></a>-->
                    
                    
                </div>
                <a href="/online-course?cat=Featured"  style="font-family:Rubik Regular;text-decoration:none" class="btn-blue normal-text" >Explore courses</a>
            </div> 
        </div>
    </div>
    <!-- END OF NEWSLETTER SECTION -->
</div>



<!-- start of mobile view -->
<div style="display:none" class="mobile-display">

    <!-- START OF TOP SECTION -->
    <div class="row m-0 page-container"  style="background-color:white;">
        <div class="col-12 p-0" style="margin-top:5vw">
            <img src="/assets/images/client/Skill-Snack-Green-Logo.png" style="width:40vw;" class="img-fluid" alt="Image 1">
            <div style="margin-top:4vw;border-radius:5px;background-color:#67BBA3;padding:7vw 5vw" class="skill-snack-fb-bg">
                <p style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line;line-height:6vw;margin-top:1.5vw;font-size:6vw">Fun learning anytime
                & anywhere</p>
                <div style="width:70%">
                    <p style="font-family: Rubik Medium;color:#FFFFFF;white-space:pre-line;padding-top:0vw;line-height:4vw;font-size:3vw;margin-bottom:4vw">Dear kamu yang takut punya komitmen, ini buat kamu! Belajar berbagai skill jempolan dengan durasi singkat di Skill Snack. Time saving, flexible, all those good things basically</p>
                </div>
                <p style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line;line-height:6vw;margin-top:1.5vw;font-size:4vw">Explore our programs</p>

                <button onclick="window.location.href='/for-public/online-course';" class="blue-link blue-link-active" style="font-family:Rubik Medium;margin-right:1.5vw;min-width:25vw;font-size:3vw;">
                    Skill Snack
                </button> <br>
                <div style="margin-top:3vw">
                    <button onclick="window.location.href='/for-public/woki';"class="red-link" style="font-family:Rubik Medium;min-width:25vw;font-size:3vw">
                        Woki
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- END OF TOP SECTION -->
    
    <!-- START OF OUR HISTORY -->
    <div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw">
        <div class="col-12">
            <div style="display:flex;align-items:center">
                <div>
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:100%">
                        <img src="/assets/images/client/ForPublic_1.png" style="width:100%;object-fit:cover;height:;border-radius: 10px" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:100%;margin-top:0.5vw">
                        <img src="/assets/images/client/ForPublic_2.png" style="width:100%;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                    </div>
                </div>
                <div style="margin-left:1vw">
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:100%">
                        <img src="/assets/images/client/ForPublic_3.png" style="width:100%;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:100%;margin-top:0.5vw">
                        <img src="/assets/images/client/ForPublic_4.png" style="width:100%;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 wow fadeInRight"data-wow-delay="0.3s">
            <!-- <p class="small-heading" style="font-family: Rubik Medium;color:#67BBA3">Our History</p> -->
            <p style="font-family: Rubik Bold;color:#3B3C43;font-size:6vw;margin-top:4vw">Skill Snack Live</p>
            <p style="margin-bottom:2vw;font-family: Rubik Regular;color:#000000;white-space:pre-line;padding-top:1vw;font-size:3vw">Enjoy sesi live workshop ngomongin berbagai topik dan skill yang bisa kamu pelajari bersama expert-expert di bidangnya.</p>
            <a href="/online-course?cat=Featured" class="normal-text btn-dark-blue" style="text-decoration:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;padding:0.5vw 2vw;font-size:3vw">See upcoming live session</a>
    
        </div>
    </div>
    <!-- END OF OUR HISTORY -->
    
    <!-- START OF KENAPA MEMILIH Skill Snack -->
    <div class="row m-0 page-container" style="padding-bottom:8vw   ">
        <div class="col-12 wow fadeInLeft" data-wow-delay="0.3s" style="display: flex;flex-direction: column;justify-content: center;padding-right:2vw">
            <p style="font-family: Rubik Bold;color:#3B3C43;font-size:6vw;margin-top:4vw">Skill Snack On-Demand</p>
            <p style="font-family: Rubik Regular;color:#000000;white-space:pre-line;padding-top:1vw;font-size:3vw">Bukan zamannya belajar itu jadi beban, it’s a privilege! Belajar kapanpun dan dimanapun, kamu yang tentuin karena Skill Snack On-Demand berisi rekaman course-course Venidici dengan rating terbaik. Ketinggalan course live nya? Ga masalah dong.</p>
            <div>
                <a href="/online-course?cat=Featured" class="normal-text btn-dark-blue" style="text-decoration:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw;font-size:3vw">See upcoming live session</a>
            </div>
    
        </div>
        <div class="col-12" style="display: flex;flex-direction: column;justify-content: center;align-items:center;padding-top:3vw">
              <img src="/assets/images/client/kenapa_online_course.png" style="width:100%;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
        </div>
        
    </div>
    <!-- END OF KENAPA MEMILIH Skill Snack -->
    
    <!-- START OF OUR MISSION MOBILE -->
    <div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw;background-color:#F6F6F6">
        <div style="text-align:center" class="wow flash" data-wow-delay="0.3s">
            <p style="font-family: Rubik Medium;color:#67BBA3;font-size:4vw;margin-bottom:0px">Our Mission</p>
            <p style="font-family: Rubik Bold;color:#3B3C43;font-size:6vw">Effective Learning for You</p>
        </div>
        <div class="row m-0" style="padding-top:2vw">
            <div class="col-6" style="display:flex;justify-content:center">
                <div style="width:100%;height:55vw;background: #FDFDFD;border: 1px solid #D7D6D6;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw">
                    <p style="font-family: Rubik Bold;color:#000000;margin-bottom:0px;font-size:4vw">1.</p>
                    <div style="">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Icon_Illustration.png" style="width:35%;" class="img-fluid" alt="Image 1">
                        </div>
                        <div style="height:10vw;margin-top:1vw">
                            <p style="font-family: Rubik Medium;color:#67BBA3;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;
                            font-size:3vw">Lifetime flexible access</p>
                        </div>
                        <p  style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;font-size:2.5vw">Cukup beli sekali dengan nominal yang kamu inginkan, akses seumur hidup. Kapanpun dimanapun</p>
                    </div>
                </div>
            </div>
            <div class="col-6" style="display:flex;justify-content:center">
                <div style="width:100%;height:55vw;background: #FDFDFD;border: 1px solid #D7D6D6;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw">
                    <p  style="font-family: Rubik Bold;color:#000000;margin-bottom:0px;font-size:4vw">2.</p>
                    <div style="">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Icon_Illustration.png" style="width:35%;" class="img-fluid" alt="Image 1">
                        </div>
                        <div style="height:10vw;margin-top:1vw">
                            <p style="font-family: Rubik Medium;color:#67BBA3;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;font-size:3vw">Learning by doing</p>
                        </div>
                        <p style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;font-size:2.5vw">Ada materi penunjang tambahan seperti case study, slides, ataupun templates untuk kamu pelajari lebih dalam lagi! Terus, uji kepahamanmu lewat quiz dan berbagai assessment.</p>
                    </div>
                </div>
            </div>
            <!--
            <div class="col-3">
                <div class="our-mission-card" style="">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#000000;margin-bottom:0px">3.</p>
                    <div style="">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                        </div>
                        <div style="height:3vw;margin-top:1vw">
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#67BBA3;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;">Fitur Assesment sebagai pemantapan materi</p>
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                </div>
            </div>
    -->
            <div class="col-6" style="display:flex;justify-content:center;padding-top:1vw">
                <div  style="width:100%;height:55vw;background: #FDFDFD;border: 1px solid #D7D6D6;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw">
                    <p  style="font-family: Rubik Bold;color:#000000;margin-bottom:0px;font-size:4vw">3.</p>
                    <div style="">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Icon_Illustration.png" style="width:35%;" class="img-fluid" alt="Image 1">
                        </div>
                        <div style="height:10vw;margin-top:1vw">
                            <p style="font-family: Rubik Medium;color:#67BBA3;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;font-size:3vw">Credible mentors</p>
                        </div>
                        <p style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;font-size:2.5vw">Dipandu oleh mentor berpengalaman dari perusahaan ternama, pasti kamu akan dapet banyak insight!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF OUR MISSION MOBILE -->
    
    <!-- START OF OUR VALUES 
    <div class="row m-0 page-container our-values-background" style="padding-top:15vw;padding-bottom:15vw">
        <div class="col-12 p-0 wow fadeInLeft" data-wow-delay="0.3s">   
            <p class="sub-description" style="font-family: Rubik Medium;color:#67BBA3">Our Values</p>
            <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">feeding your curiosity engaged <br> on the go</p>
            <div style="width:60vw;margin-top:2vw">
                <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;white-space:pre-line">Venidici memberikan berbagai macam program yang dapat diikuti oleh masyarakat luas. Mulai dari bla bla bla dan ini adalah sebuah bla bla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Erat urna commodo eget sem. 
    
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper in proin egestas mollis id lacinia nec. Nunc felis mi bibendum facilisi sollicitudin tempor, ultricies. Dignissim montes, risus ultrices egestas. At in suscipit nulla eget. Dictum lacus donec imperdiet malesuada.</p>
            </div>
        </div>
    </div>
     END OF OUR VALUES-->
    
    <!-- START OF HIGHLIGHTED EVENTS 
    <div class="row m-0 page-container" style="padding-top:6vw;padding-bottom:6vw;background-color:#F6F6F6">
        <div class="col-12">
            <p class="big-heading wow flash" data-wow-delay="0.3s" style="font-family: Rubik Medium;color:#3B3C43;margin-left:2.9vw">Highlighted <span style="font-family:Hypebeast;color:#67BBA3">Events</span> </p>
        </div>
        <div class="row m-0" style="display:flex;align-items:center;padding-top:1.5vw">   
    
            <div class="col-6 p-0">
                <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                    <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                        
                        <div class="carousel-item active" >
                            <img src="/assets/images/client/Highlighted_Events.png" style="width:100%;height:20vw" class="img-fluid" alt="Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/images/client/Highlighted_Events.png" style="width:100%;height:20vw" class="img-fluid" alt="Image 1">
                        </div>
                    </div>
                    <a class="carousel-control-prev"   data-bs-target="#feature-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                        <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                        <span class="visually-hidden">Prev</span>
                    </a>
                    <a class="carousel-control-next"   data-bs-target="#feature-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                        <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>  
            </div>
            <div class="col-6">
                <div style="padding-left:2vw">
                    <p class="small-heading" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0.5vw">Judul Event</p>
                    <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43">Saturday, 10 November 2020</p>
                    <p class="normal-text" style="font-family: Rubik Regular;color:#000000;white-space:pre-line;margin-top:2vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Venenatis leo erat lacus fermentum netus donec. Massa ipsum sit a ornare neque a. Arcu dictumst eu dapibus quam turpis aliquam.
    
                        Venidici memberikan berbagai macam program yang dapat diikuti oleh masyarakat luas. Mulai dari bla bla bla dan ini adalah sebuah bla bla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Erat urna commodo eget sem. </p>
                </div>
            </div>
        </div>
    </div>
     END OF HIGHLIGHTED EVENTS -->
    
    <!-- START OF FAQ SECTION -->
    <div class="row m-0 page-container faq-background" style="padding-top:6vw;padding-bottom:6vw">
        <div class="col-12 p-0" style="text-align:center">
            <p style="font-family: Rubik Medium;color:#3B3C43;font-size:6vw">Frequently Asked <span style="font-family:Hypebeast;color:#67BBA3">Questions</span> </p>
        </div>
        <!-- START OF QUESTION SECTION -->
        <div class="col-12 p-0" style="display:flex;justify-content:center;margin-top:1.5vw">
            <div style="background-color:#F9F9F9;padding:1.5vw;border-radius:10px;width:92%">
                <!-- START OF ONE FAQ CARD -->
                <div class="faq-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <p style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px;font-size:4vw">Apakah saya bisa mendapatkan refund?</p>
                        <p style="margin-bottom:0px;color:#747D88;font-size:3vw" data-toggle="collapse" href="#collapseFaQ1" role="button" aria-expanded="false" aria-controls="collapseFaQ1">
                            <i class="fas fa-chevron-down"></i>
                        </p>                                    
                    </div>
                    <div class="collapse" id="collapseFaQ1" style="margin-top:1vw">
                        <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular;white-space:pre-line">Untuk Workshop Live terdapat money-back guarantee jika kamu merasa tidak puas dengan menghubungi kami. Tidak terdapat refund untuk program on demand</div>
                </div>
                <!-- END OF ONE FAQ CARD -->
                <!-- START OF ONE FAQ CARD -->
                <div class="faq-card" style="margin-top:1vw">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <p style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px;font-size:4vw">Apa saja yang saya dapatkan di Venidici on Demand?</p>
                        <p style="margin-bottom:0px;color:#747D88;font-size:3vw" data-toggle="collapse" href="#collapseFaQ2" role="button" aria-expanded="false" aria-controls="collapseFaQ2">
                            <i class="fas fa-chevron-down"></i>
                        </p>                                    
                    </div>
                    <div class="collapse" id="collapseFaQ2" style="margin-top:1vw">
                        <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular;font-size:2.7vw"> 
                        Kamu bisa melihat detail setiap course di page ya. Yang pasti, di setiap course, akan ada video pembelajaran, penilaian, dan sertifikat jika kamu sudah menyelesaikan semuanya!
    </p>
                    </div>
                </div>
                <!-- END OF ONE FAQ CARD -->
                
            </div>
        </div>
        <!-- END OF QUESTION SECTION -->
    </div>
    <!-- END OF FAQ SECTION -->
    
    <!-- START OF NEWSLETTER SECTION -->
    <div class="row m-0 page-container" style="padding-bottom:8vw">
        <div class="col-12" style="padding:0vw 3vw">
            <div style="background-color:#1A1C31;padding:2vw 4vw;border-radius: 10px;display:flex;align-items:center">
                <img src="/assets/images/client/Newsletter_Illustration.png" style="height:10vw" class="img-fluid" alt="Newsletter Illustration">
                <div style="width:60%;margin-left:2vw">
                    <p class=" wow fadeInUp" data-wow-delay="0.3s" style="color:#FFFFFF;font-family:Rubik Bold;font-size:4vw">Let’s learn together!</p>
                    
                    <!-- <p class="normal-text" style="color:#FFFFFF;font-family:Rubik Regular;width:75%;"> 
                    Bukan zamannya belajar itu jadi beban, it’s a privilege! Belajar kapanpun dan dimanapun, kamu yang tentuin!                </p> -->
                    <!--<a href="#"style="text-decoration: none;font-family:Rubik Regular;margin-left:2vw;padding:0vw"></a>-->
                    
                    
                </div>
                <a href="/online-course?cat=Featured"  style="font-family:Rubik Regular;text-decoration:none;font-size:2.7vw;text-align:centerpap" class="btn-blue text-nowrap" >Explore courses</a>
            </div> 
        </div>
    </div>
    <!-- END OF NEWSLETTER SECTION -->
</div>
<!-- end of mobile view section -->
@endsection