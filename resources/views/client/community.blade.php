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
    <div class="col-md-12 p-0 wow fadeInLeft" data-wow-delay="0.3s" id="margin-bottom-mobile-community">
        <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">Get your social widen
        with Venidici Community</p>
        <p class="sub-description" id="margin-bottom-mobile-community" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line;margin-bottom:2vw">Wadah buat anak muda penuh yang antusias membangun relasi dan <br> berkembang melalui teknologi digital dan kreativitas untuk <br> mewujudkan Generasi Emas 2045</p>
        <div class="desktop-display" style="display:flex;align-items:center">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfUkYQlKFVeiRILETOtUPHhI7eCNV4o36Actdp3Z87935jkUQ/viewform" target="_blank" class="normal-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:0px;padding:1vw 2vw;text-decoration:none">Bergabung Sekarang</a>                
            <p class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;color:#FFFFFF;margin-left:2vw">OR</a>                
            <a href="{{ route('blog_list') }}" class="bigger-text" style="font-family: Poppins Medium;margin-bottom:0px;color:#FFFFFF;text-decoration:none;margin-left:2vw">Explore Venidici Blog</a>                
        </div>
        <div class="mobile-display" style="display:none">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfUkYQlKFVeiRILETOtUPHhI7eCNV4o36Actdp3Z87935jkUQ/viewform" target="_blank" class="bigger-text btn-dark-blue" style="font-family: Poppins Medium;margin-bottom:1vw;padding:1vw 2vw;text-decoration:none">Bergabung Sekarang</a>    
                    
            <p class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;color:#FFFFFF;margin-left:2vw;margin-top:1vw">OR</a>
            <br>                
            <a href="{{ route('blog_list') }}" class="bigger-text" style="font-family: Poppins Medium;margin-bottom:0px;color:#FFFFFF;text-decoration:none">Explore Venidici Blog</a>                
        </div>

    </div>
</div>
<!-- END OF TOP SECTION -->

<!-- START OF WHY JOIN VENIDICI COMMUNITY -->
<div class="row m-0 page-container" id="why-join-community-mobile" style="padding-top:4vw;padding-bottom:4vw;background-color:#EAF0F7;height:32vw">
    <div class="col-12 p-0" style="text-align:center">
        <p class="small-heading" id="mt-mobile-community" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:2vw">Why join Venidici Community?</p>
    </div>
    <div class="col-12 p-0" style="display:flex;justify-content:center;margin-top:2vw">

        <div id="feature-carousel" class="carousel slide" data-interval="25000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 6vw;">
                
                <div class="carousel-item active" style="height:auto">
                    <div class="row m-0">
                        <div class="col-lg-6 col-xs-12" style="text-align:center" >
                                <img src="/assets/images/client/Not_Just_A_Place_Icon.png" class="img-fluid" style="width:8vw;height:auto;object-fit:contain" id="width-image-mobile-community" alt="">
                                <p class="small-heading" id="mt-mobile-community" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw">Not just a place</p>

                        </div>
                        <div class="col-lg-6 col-xs-12" style=";display: flex;flex-direction: column;justify-content: center;">
                            <div class="card-white" id="why-join-community-mobile" style="display: flex;align-items:center;height:12vw;width:auto;background-color:#2B6CAA;padding:2vw">
                                <div style="display: flex;flex-direction: column;justify-content: center;">
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF;margin-bottom:0px">Venidici Community mengajak semua anak muda menemukan jati diri mereka yang sebenarnya dengan bergabung dan bertemu orang-orang dari bermacam-macam latar belakang dan berbagai skill set serta passion.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="height:auto">
                    <div class="row m-0">
                        <div class="col-lg-6 col-xs-12" style="text-align:center" >
                                <img src="/assets/images/client/Boost_Career_Icon.png" class="img-fluid" style="width:14vw;height:auto;object-fit:contain" id="width-image-mobile-community" alt="">
                                <p class="small-heading" id="mt-mobile-community" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw">
                        Everything You Need to <br> Boost Your Career</p>

                        </div>
                        <div class="col-lg-6 col-xs-12" style=";display: flex;flex-direction: column;justify-content: center;">
                            <div class="card-white" id="why-join-community-mobile" style="display: flex;align-items:center;height:12vw;width:auto;background-color:#2B6CAA;padding:2vw">
                                <div style="display: flex;flex-direction: column;justify-content: center;">
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF;margin-bottom:0px">Vici Belajar, Vici Program, Vici Linkedin. Segudang fitur untuk bantu kamu networking, belajar hal-hal insightful baru dan bahkan cari peluang karir melalui info lowongan pekerjaan atau magang. Bagian terbaik, member Venidici Community akan secara reguler mendapat penawaran eksklusif dari program pelatihan Venidici!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="height:auto">
                    <div class="row m-0">
                        <div class="col-lg-6 col-xs-12" style="text-align:center" >
                            <img src="/assets/images/client/Get_Support_Icon.png" class="img-fluid" style="width:14vw;height:auto;object-fit:contain" id="width-image-mobile-community" alt="">
                                <p class="small-heading" id="mt-mobile-community" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw">
                                Get Support from <br> Fellow Members</p>

                        </div>
                        <div class="col-lg-6 col-xs-12" style=";display: flex;flex-direction: column;justify-content: center;">
                            <div class="card-white" id="why-join-community-mobile" style="display: flex;align-items:center;height:12vw;width:auto;background-color:#2B6CAA;padding:2vw">
                                <div style="display: flex;flex-direction: column;justify-content: center;">
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF;margin-bottom:0px">Punya pertanyaan atau masalah terkait program? Atau cuma pengen punya temen diskusi? Tim Vendici dan member keluarga Venidici yang kolaboratif selalu ada buat kamu!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev width-arrow-mobile-community"    data-bs-target="#feature-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2.5vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next width-arrow-mobile-community"   data-bs-target="#feature-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2.5vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
</div>

<!-- END OF WHY JOIN VENIDICI COMMUNITY -->


<!-- START OF VENIDICI BLOG SECTION -->
<div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw;">
    <div class="col-12 p-0">
        <p class="small-heading" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:2vw">Venidici Blog</p>
    </div>
    <div class="col-12 col-lg-8" style="border-right:2px solid  #3B3C43;padding:0vw 4vw 0vw 0vw">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:2vw">Featured</p>
        @if(count($blogs) == 0)
            <div style="background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Featured Blog Belum ditemukan.</span></p>
            </div>
        @endif
        @foreach($blogs as $blog)
        <!-- START OF ONE ARTICLE CARD -->
        <div style="margin-top:4vw;display:flex;justify-content:space-between">
            <div style="padding-right:2vw">
                <a href="/blog/{{$blog->id}}" class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;text-decoration:none;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">{{$blog->title}}</a>
                <p class="normal-text" style="margin-top:1vw;font-family: Rubik Regular;color:#3B3C43;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">{{$blog->short_description}}</p>
                <div style="display:flex;align-items:center">
                    <p class="small-text" style="font-family: Rubik Regular;color:#B3B5C2;">{{$blog->created_at->diffForHumans()}} - {{$blog->duration}} mins read</p>
                </div>
                <a class="small-text" style="font-family: Rubik Regular;color:#B3B5C2;background-color:#67BBA3;color:#000000;padding:0.5vw 1vw;text-decoration:none;border-radius:5px">{{ $blog->hashtag->hashtag }}</a>
            </div>
            <img onclick="window.open('/blog/'+{{$blog->id}},'_self');" src="{{ asset($blog->banner) }}" class="img-fluid" style="cursor:pointer;width:12vw;height:10vw;object-fit:cover" alt="">
        </div>
        <!-- END OF ONE ARTICLE CARD -->
        @endforeach
        <div style="margin-top:4vw">
            <a href="/blogs" class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;">View All Blogs</a>
        </div>

    </div>
    <div class="col-12 col-lg-4 mpl" style="padding:0vw 0vw 0vw 4vw">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:2vw">Recommended</p>

        @foreach ($recommendedBlogs as $blog)
            <div style="margin-top:4vw;display:flex">
                <div>
                    <a href="{{ route('blog_detail', $blog->id) }}" class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;text-decoration:none;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">{{ $blog->title }}</a>
                    <div style="display:flex;align-items:center;margin-top:1vw">
                        <p class="small-text" style="font-family: Rubik Regular;color:#B3B5C2;">{{ $blog->created_at->diffForHumans() }} - {{ $blog->duration }} mins read</p>
                    </div>
                    <a class="small-text" style="font-family: Rubik Regular;color:#B3B5C2;background-color:#67BBA3;color:#000000;padding:0.5vw 1vw;text-decoration:none;border-radius:5px">{{ $blog->hashtag->hashtag }}</a>
                </div>
            </div>
        @endforeach
        
    </div>
</div>

<!-- END OF VENIDICI BLOG SECTION -->

<!-- START OF MIDDLE SECTION 
<div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw">

    <div class="col-12 wow fadeInUp" data-wow-delay="0.7s" style="text-align:center;margin-bottom:2vw">
        <p class="medium-heading" id="mt-mobile-community" style="font-family: Rubik Medium;color:#2B6CAA">Not just a place</p>
        <p class="bigger-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw;white-space:pre-line">Venidici Community mengajak semua anak muda menemukan jati diri mereka yang sebenarnya
        dengan bergabung dan bertemu orang-orang dari bermacam-macam latar belakang
        dan berbagai skill set serta passion.</p>
    </div>

    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.3s">
        <img src="/assets/images/client/Community_Asset_1.png" class="img-fluid image-community-mobile" style="width:35vw" alt="">
    </div>
    <div class="col-lg-6" style="display: flex;flex-direction: column;justify-content: center;">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA">Everything You Need to Boost Your Career</p>
        <p class="bigger-text" style="font-family: Rubik Regular;color:#3B3C43;white-space:pre-line">Vici Belajar, Vici Program, Vici Linkedin. Segudang fitur untuk bantu kamu networking, belajar hal-hal insightful baru dan bahkan cari peluang karir melalui info lowongan pekerjaan atau magang. Bagian terbaik, member Venidici Community akan secara reguler mendapat penawaran eksklusif dari program pelatihan Venidici!</p>
    </div>


    <div class="col-12 col-lg-6" style="display: flex;flex-direction: column;justify-content: center;margin-top:4vw;text-align:right">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA">Get Support from Fellow Members</p>
        <p class="bigger-text" style="font-family: Rubik Regular;color:#3B3C43;white-space:pre-line">Punya pertanyaan atau masalah terkait program? Atau cuma pengen punya temen diskusi? Tim Vendici dan member keluarga Venidici yang kolaboratif selalu ada buat kamu!</p>
    </div>
    <div class="col-12 col-lg-6 wow fadeInRight" data-wow-delay="0.3s" style="margin-top:4vw;text-align:right">
        <img src="/assets/images/client/Community_Asset_2.png" class="img-fluid image-community-mobile" style="width:35vw" alt="">
    </div>

</div>
END OF MIDDLE SECTION -->

<!-- START OF BOTTOM SECTION 
<div class="row m-0 page-container" style="padding-top:8vw;padding-bottom:8vw;background-color:#F6F6F6">
    <div class="col-lg-5 col-xs-12" style="display: flex;flex-direction: column;justify-content: center;">
        <p class="small-heading wow bounceIn" data-wow-delay="0.3s" style="font-family: Rubik Medium;color:#3B3C43">Gabung jadi keluarga Venidici Community dengan mengunjungi</p>
        <div style="margin-top:2vw">
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfUkYQlKFVeiRILETOtUPHhI7eCNV4o36Actdp3Z87935jkUQ/viewform" target="_blank" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;padding:1vw 2.5vw;">Bergabung Sekarang</a>
        </div>

    </div>
    <div class="col-lg-7 col-xs-12">
        <img src="/assets/images/client/Community_Asset_3.png" class="img-fluid " id="image-discord-community-mobile" style="width:100%;height:20vw" alt="">

    </div>
</div>
 END OF BOTTOM SECTION -->

 <!-- START OF NEWSLETTER SECTION -->
<div class="row m-0 page-container desktop-display" id="newsletter-section" style="padding-bottom:8vw;padding-top:8vw">
    @if (session()->has('newsletter_message'))
        <div class="col-12 " style="padding:1vw 3vw">
            <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  tyle="font-family:Rubik Regular"role="alert">
                {{ session()->get('newsletter_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div> 
    @elseif (session()->has('newsletter_info_message'))
        <div class="col-12" style="padding:1vw 3vw">
            <div class="alert alert-warning alert-dismissible fade show small-text mb-3"  tyle="font-family:Rubik Regular"role="alert">
                {{ session()->get('newsletter_info_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <form action="{{route('newsletter.store')}}" method="post" style="padding:0px">
    @csrf
        <div class="col-12" style="padding:0vw 3vw">
            <div style="background-color:#1A1C31;padding:2vw 4vw;border-radius: 10px;display:flex;align-items:center">
                <img src="/assets/images/client/Newsletter_Illustration.png" style="height:10vw" class="img-fluid" alt="Newsletter Illustration">
                <div style="width:80%;margin-left:2vw">
                    <p class="small-heading wow fadeInUp" data-wow-delay="0.5s" style="color:#FFFFFF;font-family:Rubik Bold">Beneran rela ketinggalan info…?</p>
                    <div style="display:flex;align-items:center">
                        <input required class="normal-text" placeholder="Type your email" name="email" type="text" style="background: #F0F4F9;border-radius: 10px;width:75%;padding:0.4vw 1vw;font-family:Rubik Regular;border:none">
                        <button type="submit" onclick="openLoading()" style="font-family:Rubik Regular;margin-left:2vw;border:none" class="btn-blue normal-text" >Subscribe Now</button>
                        <!--<a href="#"style="text-decoration: none;font-family:Rubik Regular;margin-left:2vw;padding:0vw"></a>-->
                    </div>
                </div>
            </div> 
        </div>
    </form>
</div>
<!-- END OF NEWSLETTER SECTION -->
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