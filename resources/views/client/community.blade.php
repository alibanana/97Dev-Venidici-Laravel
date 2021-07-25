@extends('./layouts/client-main')
@section('title', 'Venidici Community')

@section('content')

<!-- START OF TOP SECTION -->
<div class="row m-0  page-container bg-image-mobile-height"
    style="height: 50vw; padding-top: 16vw;
    background: url('/assets/images/client/Community_BG.png') no-repeat center;
    background-size: cover;
    background-repeat:no-repeat;
    background-position:center;
    ">
    <div class="col-md-12 p-0 wow fadeInLeft" data-wow-delay="0.3s">
        <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">Get your social widen
        with Venidici Community</p>
        <p class="sub-description" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line;margin-bottom:2vw">Wadah buat anak muda penuh yang antusias membangun relasi dan <br> berkembang melalui teknologi digital dan kreativitas untuk <br> mewujudkan Generasi Emas 2045</p>
        <a href="https://discord.gg/YpgRW5GU" target="_blank" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none">Bergabung Sekarang</a>                

    </div>
</div>
<!-- END OF TOP SECTION -->

<!-- START OF MIDDLE SECTION -->
<div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw">

    <div class="col-12 wow fadeInUp" data-wow-delay="0.7s" style="text-align:center;margin-bottom:2vw">
        <p class="medium-heading" id="mt-mobile-community" style="font-family: Rubik Medium;color:#2B6CAA">Not just a place</p>
        <p class="bigger-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw;white-space:pre-line">Venidici Community mengajak semua anak muda menemukan jati diri mereka yang sebenarnya
        dengan bergabung dan bertemu orang-orang dari bermacam-macam latar belakang
        dan berbagai skill set serta passion.</p>
    </div>

    <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.3s">
        <img src="/assets/images/client/Community_Asset_1.png" class="img-fluid image-community-mobile" style="width:35vw" alt="">
    </div>
    <div class="col-md-6" style="display: flex;flex-direction: column;justify-content: center;">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA">Everything You Need to Boost Your Career</p>
        <p class="bigger-text" style="font-family: Rubik Regular;color:#3B3C43;white-space:pre-line">Vici Belajar, Vici Program, Vici Linkedin. Segudang fitur untuk bantu kamu networking, belajar hal-hal insightful baru dan bahkan cari peluang karir melalui info lowongan pekerjaan atau magang. Bagian terbaik, member Venidici Community akan secara reguler mendapat penawaran eksklusif dari program pelatihan Venidici!</p>
    </div>


    <div class="col-12 col-md-6" style="display: flex;flex-direction: column;justify-content: center;margin-top:4vw;text-align:right">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA">Get Support from Fellow Members</p>
        <p class="bigger-text" style="font-family: Rubik Regular;color:#3B3C43;white-space:pre-line">Punya pertanyaan atau masalah terkait program? Atau cuma pengen punya temen diskusi? Tim Vendici dan member keluarga Venidici yang kolaboratif selalu ada buat kamu!</p>
    </div>
    <div class="col-12 col-md-6 wow fadeInRight" data-wow-delay="0.3s" style="margin-top:4vw;text-align:right">
        <img src="/assets/images/client/Community_Asset_2.png" class="img-fluid image-community-mobile" style="width:35vw" alt="">
    </div>

</div>
<!-- END OF MIDDLE SECTION -->

<!-- START OF BOTTOM SECTION -->
<div class="row m-0 page-container" style="padding-top:8vw;padding-bottom:8vw;background-color:#F6F6F6">
    <div class="col-md-5" style="display: flex;flex-direction: column;justify-content: center;">
        <p class="small-heading wow bounceIn" data-wow-delay="0.3s" style="font-family: Rubik Medium;color:#3B3C43">Gabung jadi keluarga Venidici Community dengan mengunjungi</p>
        <a href="https://discord.gg/YpgRW5GU" class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;">https://discord.gg/YpgRW5GU</a>
        <div style="margin-top:2vw">
            <a href="https://discord.gg/YpgRW5GU" target="_blank" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;padding:1vw 2.5vw;">Bergabung Sekarang</a>
        </div>

    </div>
    <div class="col-md-7">
        <img src="/assets/images/client/Community_Asset_3.png" class="img-fluid " id="image-discord-community-mobile" style="width:100%;height:20vw" alt="">

    </div>
</div>
<!-- END OF BOTTOM SECTION -->
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