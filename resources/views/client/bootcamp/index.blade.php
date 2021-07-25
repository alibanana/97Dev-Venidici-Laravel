@extends('./layouts/client-main')
@section('title', 'Venidici Bootcamp')

@section('content')

<!-- START OF TOP SECTION -->
<div class="row m-0 page-container bootcamp-bg" style="padding-top:11vw;padding-bottom:21vw;">
    <!-- START OF LECT SECTION -->
    <div class="col-xs-12 col-md-6 p-0">
        <img src="/assets/images/client/Bootcamp_Logo.png" style="width:15vw;margin-top:1vw" class="img-fluid" alt="Bootcamp Logo">
        <div style="margin-top: 2vw;">
            <p class="medium-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">Growth Hacking Through Facebook Ad</p>
            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum mauris consequat id. Morbi vestibulum commodo commodo nulla ipsum sit. Hendrerit lacus maecenas placerat vitae dignissim nibh mollis.</p>
        </div>
        <p class="bigger-text" style="font-family: Rubik Medium;color:#FFFFFF;margin-top:2vw">This bootcamp will start in:</p>
        <!-- START OF COUNTDOWN -->
        <div style="padding:1vw;background-color:#FFFFFF;width:20vw;border-radius:10px">
            <div style="display: flex;justify-content:space-between;align-items:center">
                <div style="text-align: center;border-right:2px solid #2B6CAA;padding-right:2vw">
                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">Days</p>
                    <p class="normal-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px">08</p>
                </div>
                <div style="text-align: center;">
                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">Hours</p>
                    <p class="normal-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px">00</p>
                </div>
                <div style="text-align: center;border-left:2px solid #2B6CAA;padding-left:2vw">
                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">Minutes</p>
                    <p class="normal-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px">00</p>
                </div>
            </div>
        </div>
        <!-- END OF COUNT DOWN --> 
        <button class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;padding:0.5vw 2vw;margin-top:2vw">Register Now</button>
    </div>
    <!-- END OF LEFT SECTION -->

    <!-- START OF RIGHT SECTION -->
    <div class="col-xs-12 col-md-6 p-0 bootcamp-right-heading-bg" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
        <div style="justify-content: center;display:flex;margin-left:10vw">
            <!-- START OF BOOTCAMP CARD -->
            <div style="padding:1vw;background-color:#E2E2E2;width:17vw;border-radius:10px;transform: rotate(8deg);">
                <img src="/assets/images/client/Dummy_Bootcamp_Thumbnail.png" style="width:100%;height:14vw;object-fit:cover;border-radius:10px;border:1px solid #FFFFFF;margin-bottom:0.5vw" class="img-fluid" alt="Bootcamp Logo">
                <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">Growth Hacking Through Facebook Ad</p>
            </div>
            <!-- END OF BOOTCAMP CARD -->

        </div>
    </div>

    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF TOP SECTION -->

<!-- START OF INTRODUCTION SECTION -->
<div class="row m-0 page-container" style="padding-bottom:5vw">
    <div class="col-md-12 col-xs-12 p-0">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Introduction to Our Bootcamp (Feature)</p>
        <div style="width:80%">
            <p class="normal-text" style="font-family: Rubik Bold;color:#626262;white-space:pre-line">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque sit volutpat sed pulvinar facilisis dignissim. Aliquam aliquam urna sit duis gravida. Nunc consectetur laoreet consequat aenean fusce lacinia. Amet, pellentesque nibh quam massa. A ullamcorper tellus sit amet, arcu. </p>
        </div>
    </div>
    <div class="col-xs-6 col-md-4 p-0" style="display:flex;justify-content:flex-start">
        <div class="krest-card" style="margin-top:1.5vw">   
            <img src="/assets/images/client/Krest_Dummy_Card_Image.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
            <p id="krest-card-title" class="bigger-text" style="font-family:Rubik Medium;margin-top:1vw">Customer Experience</p>
            <p id="krest-card-description" class="small-text" style="font-family:Rubik Regular;color:#FFFFFF;margin-top:1vw">Customer Experience yang sigap menangangani dan mengayomi setiap user yang memiliki kesulitan dalam mengakses venidici dan mencerna informasi materi yang ada</p>
        </div>
    </div>
    <div class="col-xs-6 col-md-4 p-0" style="display:flex;justify-content:center">
        <div class="krest-card" style="margin-top:1.5vw">   
            <img src="/assets/images/client/Krest_Dummy_Card_Image.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
            <p id="krest-card-title" class="bigger-text" style="font-family:Rubik Medium;margin-top:1vw">Customer Experience</p>
            <p id="krest-card-description" class="small-text" style="font-family:Rubik Regular;color:#FFFFFF;margin-top:1vw">Customer Experience yang sigap menangangani dan mengayomi setiap user yang memiliki kesulitan dalam mengakses venidici dan mencerna informasi materi yang ada</p>
        </div>
    </div>
    <div class="col-xs-6 col-md-4 p-0" style="display:flex;justify-content:flex-end">
        <div class="krest-card" style="margin-top:1.5vw">   
            <img src="/assets/images/client/Krest_Dummy_Card_Image.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
            <p id="krest-card-title" class="bigger-text" style="font-family:Rubik Medium;margin-top:1vw">Customer Experience</p>
            <p id="krest-card-description" class="small-text" style="font-family:Rubik Regular;color:#FFFFFF;margin-top:1vw">Customer Experience yang sigap menangangani dan mengayomi setiap user yang memiliki kesulitan dalam mengakses venidici dan mencerna informasi materi yang ada</p>
        </div>
    </div>
</div>
<!-- END OF INTRODUCTION SECTION -->

<!-- START OF GROWTH HACKING SECTION -->
<div class="row m-0 page-container" style="background-color: #F6F6F6;padding-top:5vw;padding-bottom:5vw">
    <div class="col-12 p-0" style="text-align: center;">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Apa itu Growth Hacking?</p>
        
    </div>
    <div class="col-12" style="padding:1vw 10vw">
        <!-- START OF CONTENT LINKS -->
        <div style="border: 2px solid #2B6CAA;border-radius:10px;display:flex;justify-content:space-between;align-items:center">
            <!-- START OF ONE LINK -->
            <div style="padding: 1vw 2vw;border-right: 2px solid #2B6CAA;text-align:center;cursor:pointer;background-color:#2B6CAA">
                <p class="normal-text" style="font-family: Rubik Bold;color:#FFFFFF;margin-bottom:0px">Poin penjelasan Growth Hacking</p>
            </div>
            <div style="padding: 1vw 2vw;border-right: 2px solid #2B6CAA;text-align:center;cursor:pointer">
                <p class="normal-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0px">Poin penjelasan Growth Hacking</p>
            </div>
            <div style="padding: 1vw 2vw;border-right: 2px solid #2B6CAA;text-align:center;cursor:pointer">
                <p class="normal-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0px">Poin penjelasan Growth Hacking</p>
            </div>
            <div style="padding: 1vw 2vw;text-align:center;cursor:pointer">
                <p class="normal-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0px">Poin penjelasan Growth Hacking</p>
            </div>
            <!-- END OF ONE LINK -->
        </div>
        <!-- END OF CONTENT LINK -->
    </div>
    <!-- START OF ONE CONTENT SECTION -->
    <div class="row m-0" style="padding-top:4vw">
        <div class="col-md-4 p-0">
            <img src="/assets/images/client/Image_Dummy.png" style="width:100%;" class="img-fluid" alt="KREST">

        </div>
        <div class="col-md-8 p-0" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
            <div style="padding-left: 4vw;">
                <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px;white-space:pre-line">Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​
    
                    Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>

            </div>

        </div>
    </div>
    <!-- END OF ONE CONTENT SECTION -->
</div>
<!-- END OF GROWTH HACKING SECTION -->


<!-- START OF SCHEDULE AND DELIVERY METHOD -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw">
    <div class="col-12 p-0" style="margin-bottom:4vw">
        <div style="display: flex;justify-content:center;align-items:center">
            <p class="small-heading schedule-links schedule-title schedule-title-active" onclick="changeSchedule(event, 'bootcamp-schedule')" style="font-family: Rubik Bold;margin-right:3vw;cursor:pointer">Bootcamp Schedule</p>
            <p class="small-heading schedule-links schedule-title" onclick="changeSchedule(event, 'delivery-method')" style="font-family: Rubik Bold;margin-left:3vw;cursor:pointer">Delivery Method</p>
        </div>
    </div>
    <!-- START OF BOOTCAMP SCHEDULE -->
    <div class="schedule-content "  id="bootcamp-schedule">

        <div class="row m-0">
            <!-- START OF LEFT SECTION -->
            <div class="col-xs-12 col-md-6 p-0">
                <div id="schedule-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                    <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                        <!-- START OF ONE ITEM -->
                        <div class="carousel-item active">
                            <div style="display: flex;justify-content: center;">
                                <div style="background: #FFFFFF;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:25vw;text-align:left;">
                                    <p class="bigger-text" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0.4vw">Day 1</p>
                                    <p class="small-text" style="font-family: Rubik Regular;color:#2B6CAA;">19 September 2021</p>
                                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom: 0.4vw;">Growth Fundamentals</p>
                                    <ul>
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">Pirate funneling</p>
                                        </li>
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">Growth hacking mindset & skills</p>
                                        </li>
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">Growth hacking vs Digital Marketing and others</p>
                                        </li>
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">A career in growth hacking </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE ITEM -->
                        <!-- START OF ONE ITEM -->
                        <div class="carousel-item">
                            <div style="display: flex;justify-content: center;">
                                
                                <div style="background: #FFFFFF;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:25vw;text-align:left;">
                                    <p class="bigger-text" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0.4vw">Day 2</p>
                                    <p class="small-text" style="font-family: Rubik Regular;color:#2B6CAA;">20 September 2021</p>
                                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom: 0.4vw;">Growth Fundamentals</p>
                                    <ul>
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">Pirate funneling</p>
                                        </li>
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">Growth hacking mindset & skills</p>
                                        </li>
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">Growth hacking vs Digital Marketing and others</p>
                                        </li>
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">A career in growth hacking </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE ITEM -->
                    </div>
                    <a class="carousel-control-prev"   data-bs-target="#schedule-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                        <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                        <span class="visually-hidden">Prev</span>
                    </a>
                    <a class="carousel-control-next"   data-bs-target="#schedule-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                        <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>  
            </div>
            <!-- END OF LEFT SECTION -->
            <!-- START OF RIGHT SECTION -->
            <div class="col-md-6 col-xs-12 p-0"  style="display: flex;flex-direction: column;justify-content: center;">
                <div style="padding-left: 5vw;">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#3B3C43;">What will be taught in our <br> bootcamp?</p>
                    <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>
                    <button class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw">Request for Syllabus</button>

                </div>

                
            </div>
            <!-- END OF RIGHT SECTION -->        
        </div>
    </div>
    <!-- END OF BOOTCAMP SCHEDULE -->
    <!-- START OF DELIVERY METHOD -->
    <div class="schedule-content"  id="delivery-method" style="display: none;">
        <div class="row m-0">
            <!-- START OF LEFT SECTION -->
            <div class="col-xs-12 col-md-6 p-0">
                <div id="delivery-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                    <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                        <!-- START OF ONE ITEM -->
                        <div class="carousel-item active">
                            <div style="display: flex;justify-content: center;">
                                <div style="background: #FFFFFF;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:25vw;text-align:left;">
                                    <p class="bigger-text" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0.4vw">Step-by-step teaching 1</p>
                                    <hr style="background:#2B6CAA;height:0.2vw;border-radius:10px;">
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>

                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE ITEM -->
                        <!-- START OF ONE ITEM -->
                        <div class="carousel-item">
                            <div style="display: flex;justify-content: center;">
                                <div style="background: #FFFFFF;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:25vw;text-align:left;">
                                    <p class="bigger-text" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0.4vw">Step-by-step teaching 2</p>
                                    <hr style="background:#2B6CAA;height:0.2vw;border-radius:10px;">
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>

                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE ITEM -->
                    </div>
                    <a class="carousel-control-prev"   data-bs-target="#delivery-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                        <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                        <span class="visually-hidden">Prev</span>
                    </a>
                    <a class="carousel-control-next"   data-bs-target="#delivery-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                        <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>  
            </div>
            <!-- END OF LEFT SECTION -->
            <!-- START OF RIGHT SECTION -->
            <div class="col-md-6 col-xs-12 p-0"  style="display: flex;flex-direction: column;justify-content: center;">
                <div style="padding-left: 5vw;">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#3B3C43;">What will be taught in our <br> bootcamp?</p>
                    <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>
                    <button class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw">Request for Syllabus</button>

                </div>
            </div>
            <!-- END OF RIGHT SECTION -->        
        </div>
    </div>
    <!-- END OF DELIVERY METHOD -->
</div>
<!-- END OF SCHEDULE AND DELIVERY METHOD -->

<!-- START OF WHAT WILL YOU GET SECTION -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;background-color: #F6F6F6;">
    <div class="col-12 p-0" style="text-align: center;">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">What will you get?</p>
    </div>
    <div class="row m-0" style="padding-top:2vw">
        <div class="col-3" style="display:flex;justify-content:center">
            <div class="our-mission-card" >
                <div style="text-align:center">
                    <div style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="height:3vw;margin-top:1vw;">
                        <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 2 !important;
                        -webkit-box-orient: vertical !important;">Materi yang padat dan jelas</p>
                    </div>
                    <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;margin-top:1.5vw">Cukup beli sekali dengan nominal yang kamu inginkan, akses seumur hidup. Kapanpun dimanapun</p>
                </div>
            </div>
        </div>
        <div class="col-3" style="display:flex;justify-content:center">
            <div class="our-mission-card" >
                <div style="text-align:center">
                    <div style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="height:3vw;margin-top:1vw;">
                        <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 2 !important;
                        -webkit-box-orient: vertical !important;">Materi yang padat dan jelas</p>
                    </div>
                    <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;margin-top:1.5vw">Cukup beli sekali dengan nominal yang kamu inginkan, akses seumur hidup. Kapanpun dimanapun</p>
                </div>
            </div>
        </div>
        <div class="col-3" style="display:flex;justify-content:center">
            <div class="our-mission-card" >
                <div style="text-align:center">
                    <div style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="height:3vw;margin-top:1vw;">
                        <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 2 !important;
                        -webkit-box-orient: vertical !important;">Materi yang padat dan jelas</p>
                    </div>
                    <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;margin-top:1.5vw">Cukup beli sekali dengan nominal yang kamu inginkan, akses seumur hidup. Kapanpun dimanapun</p>
                </div>
            </div>
        </div>
        <div class="col-3" style="display:flex;justify-content:center">
            <div class="our-mission-card" >
                <div style="text-align:center">
                    <div style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="height:3vw;margin-top:1vw;">
                        <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 2 !important;
                        -webkit-box-orient: vertical !important;">Materi yang padat dan jelas</p>
                    </div>
                    <p class="small-text" style="font-family: Rubik Regular;color:#888888;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;margin-top:1.5vw">Cukup beli sekali dengan nominal yang kamu inginkan, akses seumur hidup. Kapanpun dimanapun</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF WHAT WILL YOU GET SECTION -->

<!-- START OF BOOTCAMP INI UNTUK SIAPA -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;">
    <!-- START OF LEFT SECTION -->
    <div class="col-md-6 col-xs-12" style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start;padding-right:5vw">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Bootcamp ini untuk siapa?</p>
        <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>
        <button class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw">Register For Free</button>
    </div>
    <!-- END OF LEFT SECTION -->

    <!-- START OF RIGHT SECTION -->
    <div class="col-md-6 col-xs-12">
        <div class="row m-0">
            <!-- START OF ONE CARD -->
            <div class="col-6 p-0">
                <div style="background: rgba(43, 108, 170, 0.1);padding:2vw 1vw 1vw 1vw;border-radius:10px;width:15vw">
                    <img src="/assets/images/icons/Bootcamp_Icon_1.png" style="width:5vw;margin-top:-7vw" alt="Bootcamp Logo">
                    <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">Product Managers</p>
                    <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <!-- END OF ONE CARD -->
            <!-- START OF ONE CARD -->
            <div class="col-6 p-0">
                <div style="background: rgba(43, 108, 170, 0.1);padding:2vw 1vw 1vw 1vw;border-radius:10px;width:15vw">
                    <img src="/assets/images/icons/Bootcamp_Icon_1.png" style="width:5vw;margin-top:-7vw" alt="Bootcamp Logo">
                    <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">Product Managers</p>
                    <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <!-- END OF ONE CARD -->
            <!-- START OF ONE CARD -->
            <div class="col-6 p-0" style="margin-top: 5vw;">
                <div style="background: rgba(43, 108, 170, 0.1);padding:2vw 1vw 1vw 1vw;border-radius:10px;width:15vw">
                    <img src="/assets/images/icons/Bootcamp_Icon_1.png" style="width:5vw;margin-top:-7vw" alt="Bootcamp Logo">
                    <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">Product Managers</p>
                    <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <!-- END OF ONE CARD -->
            <!-- START OF ONE CARD -->
            <div class="col-6 p-0" style="margin-top: 5vw;">
                <div style="background: rgba(43, 108, 170, 0.1);padding:2vw 1vw 1vw 1vw;border-radius:10px;width:15vw">
                    <img src="/assets/images/icons/Bootcamp_Icon_1.png" style="width:5vw;margin-top:-7vw" alt="Bootcamp Logo">
                    <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">Product Managers</p>
                    <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <!-- END OF ONE CARD -->
        </div>
    </div>
    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF BOOTCAMP INI UNTUK SIAPA -->

<!-- START OF HOW TO JOIN SECTION -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;background-color: #F6F6F6;">
    <!-- START OF LEFT SECTION -->
    <div class="col-md-6 col-xs-12" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
        <img src="/assets/images/client/Bootcamp_How_To_Join.png" style="width:25vw;" alt="Bootcamp Logo">
    </div>
    <!-- END OF LEFT SECTION -->
    <!-- START OF RIGHT SECTION -->
    <div class="col-md-6 col-xs-12"  style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">How to join?</p>
        <div class="htj-content" id="htj-1">
            <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;">Like</p>
            <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>
        </div>
        <div class="htj-content" id="htj-2" style="display: none;">
            <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;">Save</p>
            <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>
        </div>
        <div class="htj-content" id="htj-3" style="display: none;">
            <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;">Follow and Share!</p>
            <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>
        </div>
        <!-- START OF LINKS -->
        <div style="display: flex;margin-top:1vw">
            <div class="htj-links htj-title htj-title-active" onclick="changeHowToJoin(event, 'htj-1')" style="cursor:pointer">
                <p class="small-heading" style="font-family: Rubik Bold;">1</p>
            </div>
            <div class="htj-links htj-title" onclick="changeHowToJoin(event, 'htj-2')" style="cursor:pointer;margin-left:2vw">
                <p class="small-heading" style="font-family: Rubik Bold;">2</p>
            </div>
            <div class="htj-links htj-title" onclick="changeHowToJoin(event, 'htj-3')" style="cursor:pointer;margin-left:2vw">
                <p class="small-heading" style="font-family: Rubik Bold;">3</p>
            </div>
        </div>
        <!-- END OF LINKS -->
    </div>
    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF HOW TO JOIN SECTION -->

<!-- START OF BISA BERKARIR JADI APA SECTION -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw">
    <div class="col-12 p-0">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Bisa berkarir jadi apa?</p>
    </div>
    <!-- START OF ONE CARD -->
    <div class="col-md-4 col-xs-6 p-0" style="display: flex;justify-content: flex-start;">
        <div style="background: #FFFFFF;border: 3px solid #2B6CAA;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:22vw;height:21vw">
            <div style="text-align:center;margin-bottom:1vw">
                <img src="/assets/images/client/Bootcamp_Dummy_Illustration_1.png" style="width:7vw;" alt="Bootcamp Illustration">
            </div>
            <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">Product Managers</p>
            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0p;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla</p>
        </div>
    </div>
    <!-- END OF ONE CARD -->
    <!-- START OF ONE CARD -->
    <div class="col-md-4 col-xs-6 p-0" style="display: flex;justify-content:center;">
        <div style="background: #FFFFFF;border: 3px solid #2B6CAA;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:22vw;height:21vw">
            <div style="text-align:center;margin-bottom:1vw">
                <img src="/assets/images/client/Bootcamp_Dummy_Illustration_1.png" style="width:7vw;" alt="Bootcamp Illustration">
            </div>
            <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">Product Managers</p>
            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0p;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla</p>
        </div>
    </div>
    <!-- END OF ONE CARD -->
    <!-- START OF ONE CARD -->
    <div class="col-md-4 col-xs-6 p-0" style="display: flex;justify-content: flex-end;">
        <div style="background: #FFFFFF;border: 3px solid #2B6CAA;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:22vw;height:21vw">
            <div style="text-align:center;margin-bottom:1vw">
                <img src="/assets/images/client/Bootcamp_Dummy_Illustration_1.png" style="width:7vw;" alt="Bootcamp Illustration">
            </div>
            <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">Product Managers</p>
            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0p;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla</p>
        </div>
    </div>
    <!-- END OF ONE CARD -->

</div>
<!-- END OF BISA BERKARIR JADI APA SECTION -->

<!-- START OF OUR INSTRUCTORS -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;background-color: #F5F2F2;">
    <div class="col-12 p-0">
        <div id="instructors-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                <!-- START OF ONE ITEM -->
                <div class="carousel-item active">
                    <div class="row m-0"> 
                        <!-- START OF LEFT SECTION -->
                        <div class="col-5">
                            <img src="/assets/images/client/Bootcamp_Instructor_1.png" style="min-width:18vw;height:18vw;border-radius:10px" alt="Bootcamp Instructor">
                        </div>
                        <!-- END OF LEFT SECTION -->
                        <!-- START OF RIGHT SECTION -->
                        <div class="col-7" style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start">
                            <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Meet Our <span style="color:#67BBA3"> Instructor/s</span></p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#626262;text-align:left">Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal, terutama di era industri 4.0 yang super kompetitif.​</p>
                            <p class="bigger-text" style="font-family: Rubik Medium;color:#626262;text-align:left">Welby Nazhari,Growth Marketer​</p>
                            <img src="/assets/images/client/Instructor_Company_Logo.png" style="width:8vw;border-radius:10px" alt="Bootcamp Instructor Company">

                        </div>
                        <!-- END OF RIGHT SECTION -->
                    </div>
                </div>
                <!-- END OF ONE ITEM -->
            </div>
            <a class="carousel-control-prev"   data-bs-target="#instructors-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#instructors-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>      

    </div>
</div>
<!-- END OF OUR INSTRUCTORS -->

<!-- START OF OUR HIRING PARTNERS SECTION -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;">
    <!-- START OF LEFT SECTION -->
    <div class="col-md-6 col-xs-6" style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA;">Our Hiring Partners</p>
        <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal.</p>

    </div>
    <!-- END OF LEFT SECTION -->
    <!-- START OF RIGHT SECTION -->
    <div class="col-md-6 col-xs-6" style="padding-left: 5vw;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap: wrap;">
            <img src="/assets/images/client/Bootcamp_Hiring_Partner_1.png" style="width:10vw;border-radius:10px" alt="Bootcamp Partner">
            <img src="/assets/images/client/Bootcamp_Hiring_Partner_1.png" style="width:10vw;border-radius:10px" alt="Bootcamp Partner">
            <img src="/assets/images/client/Bootcamp_Hiring_Partner_1.png" style="width:10vw;border-radius:10px" alt="Bootcamp Partner">
            <img src="/assets/images/client/Bootcamp_Hiring_Partner_1.png" style="width:10vw;border-radius:10px" alt="Bootcamp Partner">
            <img src="/assets/images/client/Bootcamp_Hiring_Partner_1.png" style="width:10vw;border-radius:10px" alt="Bootcamp Partner">
            <img src="/assets/images/client/Bootcamp_Hiring_Partner_1.png" style="width:10vw;border-radius:10px" alt="Bootcamp Partner">

        </div>
    </div>
    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF OUR HIRING PARTNERS SECTION -->

<!-- START OF PRICING PLAN -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;">
    <div class="col-12 p-0" style="text-align: center;margin-bottom:2vw">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Here is our Pricing Plan</p>
    </div>
    <!-- START OF FULL REGISTRATION -->
    <div class="col-md-6 col-xs-12 p-0" >
        <div  style="background-color: #2B6CAA;padding:2vw;border-radius:10px 0px 0px 10px;border:2px solid #2B6CAA;display: flex;flex-direction: column;justify-content: space-between;align-items:flex-start;height:25vw">
            <div>
                <p class="bigger-text" style="font-family: Poppins Medium;color:#FFFFFF;">Full registration to Bootcamp</p>
                <p class="normal-text" style="font-family: Poppins Medium;color:#67BBA3;">Rp 300.000 / person</p>
                <ul>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Full curriculum dan assessment</p>
                    </li>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Sertifikat dan pembimbingan</p>
                    </li>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Purus volutpat eu nisi, maecenas neque eget sit</p>
                    </li>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Rhoncus nascetur pellentesque est blandit</p>
                    </li>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Pembayaran di luar website</p>
                    </li>
                </ul>
            </div>
            <button class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;padding:0.5vw 2vw;margin-top:2vw">Register Now</button>

        </div>

    </div>
    <!-- END OF FULL REGISTRATION -->
    <!-- START OF FREE TRIAL -->
    <div class="col-md-6 col-xs-12 p-0">
        <div style="background-color: #FFFFFF;padding:2vw;border-radius:0px 10px 10px 0px;border:2px solid #2B6CAA;display: flex;flex-direction: column;justify-content: space-between;align-items:flex-start;height:25vw">
            <div>
                <p class="bigger-text" style="font-family: Poppins Medium;color:#3B3C43;">Free Trial to Bootcamp</p>
                <p class="normal-text" style="font-family: Poppins Medium;color:#888888;">Rp 300.000 / person</p>
                <ul>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Full curriculum dan assessment</p>
                    </li>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Sertifikat dan pembimbingan</p>
                    </li>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Purus volutpat eu nisi, maecenas neque eget sit</p>
                    </li>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Rhoncus nascetur pellentesque est blandit</p>
                    </li>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Pembayaran di luar website</p>
                    </li>
                </ul>
            </div>
            <button class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;padding:0.5vw 2vw;margin-top:2vw">Get Free Trial Now</button>

        </div>
    </div>
    <!-- END OF FREE TRIAL -->
</div>
<!-- END OF PRICING PLAN -->

<!-- START OF OUR COMMUNITY -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;background-color:#F5F2F2">
    <!-- START OF LEFT SECTION -->
    <div class="col-md-6 col-xs-12" style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Our Venidici Community</p>
        <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>
        <button class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;padding:0.5vw 2vw;margin-top:2vw">Explore Community</button>

    </div>    
    <!-- END OF LEFT SECTION -->
    <!-- START OF RIGHT SECTION -->
    <div class="col-md-6 col-xs-12">
        <img src="/assets/images/client/Community_Asset_3.png" class="img-fluid" style="width:100%;height:20vw" alt="">
    </div>    
    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF OUR COMMUNITY -->

<!-- START OF FAQ SECTION -->
<div class="row m-0 page-container faq-background" style="padding-top:6vw;padding-bottom:6vw">
        <div class="col-12 p-0" style="text-align:center">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Frequently Asked Questions</p>
        </div>
        <!-- START OF QUESTION SECTION -->
        <div class="col-12 p-0" style="display:flex;justify-content:center;margin-top:1.5vw">
            <div style="background-color:#F9F9F9;padding:1.5vw;border-radius:10px;width:92%">
                <!-- START OF ONE FAQ CARD -->
                <div class="faq-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Schedule</p>
                        <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ1" role="button" aria-expanded="false" aria-controls="collapseFaQ1">
                            <i class="fas fa-chevron-down"></i>
                        </p>                                    
                    </div>
                    <div class="collapse" id="collapseFaQ1" style="margin-top:1vw">
                        <!-- START OF ONE FAQ CARD -->
                        <div class="faq-card" style="margin-top:1vw">
                            <div style="display:flex;align-items:center;justify-content:space-between;">
                                <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Apa saja yang saya dapatkan di Venidici Skill Snack?</p>
                                <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseSubFaQ1A" role="button" aria-expanded="false" aria-controls="collapseSubFaQ1A">
                                    <i class="fas fa-chevron-down"></i>
                                </p>                                    
                            </div>
                            <div class="collapse" id="collapseSubFaQ1A" style="margin-top:1vw">
                                <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular"> 
                                Kamu bisa melihat detail setiap course di page ya. Yang pasti, di setiap course, akan ada video pembelajaran, penilaian, dan sertifikat jika kamu sudah menyelesaikan semuanya!
                            </p>
                            </div>
                        </div>
                        <!-- END OF ONE FAQ CARD -->
                    </div>
                </div>
                <!-- END OF ONE FAQ CARD -->
                <!-- START OF ONE FAQ CARD -->
                <div class="faq-card" style="margin-top: 1vw;">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Learning</p>
                        <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ2" role="button" aria-expanded="false" aria-controls="collapseFaQ2">
                            <i class="fas fa-chevron-down"></i>
                        </p>                                    
                    </div>
                    <div class="collapse" id="collapseFaQ2" style="margin-top:1vw">
                        <!-- START OF ONE FAQ CARD -->
                        <div class="faq-card" style="margin-top:1vw">
                            <div style="display:flex;align-items:center;justify-content:space-between;">
                                <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Apa saja yang saya dapatkan di Venidici Skill Snack?</p>
                                <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseSubFaQ2A" role="button" aria-expanded="false" aria-controls="collapseSubFaQ2A">
                                    <i class="fas fa-chevron-down"></i>
                                </p>                                    
                            </div>
                            <div class="collapse" id="collapseSubFaQ2A" style="margin-top:1vw">
                                <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular"> 
                                Kamu bisa melihat detail setiap course di page ya. Yang pasti, di setiap course, akan ada video pembelajaran, penilaian, dan sertifikat jika kamu sudah menyelesaikan semuanya!
                            </p>
                            </div>
                        </div>
                        <!-- END OF ONE FAQ CARD -->
                    </div>
                </div>
                <!-- END OF ONE FAQ CARD -->
                
                
            </div>
        </div>
        <!-- END OF QUESTION SECTION -->
    </div>
    <!-- END OF FAQ SECTION -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function changeHowToJoin(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("htj-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("htj-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("htj-title-active", "htj-title");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " htj-title-active";
        }
         
</script>
<script>
    function changeSchedule(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("schedule-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("schedule-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("schedule-title-active", "schedule-title");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " schedule-title-active";
        }
         
</script>
@endsection