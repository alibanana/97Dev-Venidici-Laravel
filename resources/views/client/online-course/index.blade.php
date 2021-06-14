@extends('./layouts/client-main')
@section('title', 'Venidici Online Course')

@section('content')
<!-- START OF BANNER SECTION -->
<div class="row m-0 banner-background page-container" style="height:40vw;padding-top:16vw;text-align:center">
    <div class="col-md-12 p-0">
        <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line" >On-Demand</p>
        <p class="sub-description" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line;margin-bottom:3vw" >Fun learning anytime & anywhere! Bukan zamannya
        belajar itu jadi beban, it’s a privilege! Belajar kapanpun dan dimanapun,
        kamu yang tentuin karena Skill Snack On-Demand berisi rekaman
        course-course Venidici dengan rating terbaik.</p>
        
        <a href="#search-course-section" class="sub-description btn-blue-bordered btn-blue-bordered-active" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;width:100%;margin-top:5vw;padding:0.8vw 1vw">Search Courses</a>

    </div>
</div>

<!-- END OF BANNER SECTION -->

<!-- START OF OUR PROGRAMS SECTION 
<div class="row m-0 page-container enroll-background" style="padding-bottom:8vw;padding-top:6vw">
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#55525B;margin-top:1vw;margin-bottom:0px">Why enroll in Venidici's<span class="big-heading" style="font-family:Hypebeast;margin-left:1vw;color:#2B6CAA" >ONLINE COURSE</span></p>
    </div>
    <div class="col-6 p-0">
        <a href="" style="text-decoration:none">
            <div class="our-programs-card" style="margin-top:2.5vw">
                <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Reason 1</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Reason 1</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 p-0" style="display:flex;justify-content:flex-end;margin-top:2.5vw">
        <a href="" style="text-decoration:none">
            <div class="our-programs-card">
                <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Reason 1</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Reason 1</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 p-0">
        <a href="" style="text-decoration:none">
            <div class="our-programs-card" style="margin-top:2.5vw">
                <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Reason 1</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Reason 1</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 p-0" style="display:flex;justify-content:flex-end;margin-top:2.5vw">
        <a href="" style="text-decoration:none">
            <div class="our-programs-card">
                <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Reason 1</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Reason 1</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
END OF OUR PROGRAMS SECTION -->
<div style="padding-bottom:5vw">
</div>
<!-- START OF TESTIMONY SECTION -->
<div class="row m-0 page-container review-course-background" style="padding-bottom: 8vw;padding-top:4vw">
    <!-- START OF FEATURE SECTION -->
    
    <div class="col-8" style="padding-left:0vw;padding-right:4vw">

        <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 3.5vw;">
                
                <div class="carousel-item active">
                    <div class="card-white" style="height:20vw;padding:2.5vw">
                        <div style="display:flex;align-items:center">   
                            <img src="/assets/images/client/testimony-image-dummy.png" style="width:5vw" class="img-fluid" alt="">
                            <div style="margin-left:1vw">
                                <p class="small-heading" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0vw">Mr. Raditya Dika</p>
                                <p class="bigger-text" style="font-family: Rubik Regular;color:#55525B;margin-top:-0.3vw;margin-bottom:0vw">Student</p>
                            </div>
                        </div>
                        <div style="display: flex;justify-content:flex-start;margin-top:1vw">
                            <i style="color:#F4C257" class="fas fa-star bigger-text"></i>
                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star bigger-text"></i>
                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star bigger-text"></i>
                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star bigger-text"></i>
                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star bigger-text"></i>
                        </div>
                        <p class="normal-text" style="font-family: Rubik Regular;color:#55525B;margin-top:1vw; display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 4 !important;
                        -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pretium id molestie suspendisse mi venenatis arcu amet scelerisque. Volutpat sit phasellus arcu, elit porttitor senectus. Ut lobortis vitae est leo ultrices pulvinar sodales. Nisl aliquam, in sit aenean vitae.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-white" style="height:20vw;padding:2.5vw">
                        <div style="display:flex;align-items:center">   
                            <img src="/assets/images/client/testimony-image-dummy.png" style="width:5vw" class="img-fluid" alt="">
                            <div style="margin-left:1vw">
                                <p class="small-heading" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0vw">Mr. Gabriel Amileano</p>
                                <p class="bigger-text" style="font-family: Rubik Regular;color:#55525B;margin-top:-0.3vw;margin-bottom:0vw">Student</p>
                            </div>
                        </div>
                        <div style="display: flex;justify-content:flex-start;margin-top:1vw">
                            <i style="color:#F4C257" class="fas fa-star bigger-text"></i>
                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star bigger-text"></i>
                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star bigger-text"></i>
                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star bigger-text"></i>
                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star bigger-text"></i>
                        </div>
                        <p class="normal-text" style="font-family: Rubik Regular;color:#55525B;margin-top:1vw; display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 4 !important;
                        -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi pretium id molestie suspendisse mi venenatis arcu amet scelerisque. Volutpat sit phasellus arcu, elit porttitor senectus. Ut lobortis vitae est leo ultrices pulvinar sodales. Nisl aliquam, in sit aenean vitae.</p>
                    </div>
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
    <div class="col-4 p-0 " style="display: flex;flex-direction: column;justify-content: center;align-items:center">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;">Take a look at what they say about Venidici’s On-Demand</p>
        <!--<p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;margin-top:2vw;margin-bottom:2vw">Want to review us?</p>
        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;padding:0.8vw 2vw;">Review Now</a>-->

    </div>
</div>
<!-- END OF TESTIMONY SECTION -->

<!-- START OF COURSE LIST SECTION -->
<div class="row m-0 page-container" id="search-course-section" style="padding-top:4vw;padding-bottom:8vw">   
    <div class="col-12 p-0" style="text-align:center">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#55525B;margin-top:1vw;margin-bottom:0px">Find your online course here!</p>
        <div style="display: flex;margin-top:2vw;justify-content:center;">
            <div  class="grey-input-form" style="display: flex;align-items:center">
                <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid" alt="">
                                
                <form action="" method="GET">
                    <input type="text" name="search" value="{{ Request::get('search') }}" type="search" class="small-text" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:15vw" placeholder="Course Title">

                    @if (Request::get('show'))
                        <input hidden name="show" value="{{ Request::get('search') }}" type="search" class="small-text" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:15vw" placeholder="Course Title">
                    @endif
                    <input type="submit" style="visibility: hidden;" hidden/>
                </form>
            </div>
            <div style="margin-left: 1vw;">
            <!--
                <select class="grey-input-form small-text" style="height:100%;appearance:none" aria-label="">-->
                <select class="grey-input-form small-text" style="height:100%;padding-right:4vw" aria-label="">
                    <option selected disabled>Pilih Kategori</option>
                    @foreach($course_categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-left: 1vw;">
                <button type="submit" class="btn-search small-text"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <!-- START OF CLASSES SECTION -->
    <div class="col-12 p-0" style="text-align: center;margin-top:1vw">
        <div style="padding:2vw 13.5vw 1vw 13.5vw;">
            <div style="display:flex;justify-content:space-between;align-items:center;background: #FFFFFF;border: 2px solid rgba(157, 157, 157, 0.1);border-radius: 10px;padding:0.7vw">
            <!--
                <p class="normal-text btn-blue-on-hover btn-blue-active course-links" onclick="changeCourse(event, 'course-popular')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Featured</p>
                <p class="normal-text btn-blue-on-hover course-links"  onclick="changeCourse(event, 'course-woki')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Business</p>
                <p class="normal-text btn-blue-on-hover course-links" onclick="changeCourse(event, 'course-online')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Personal Development</p>
            -->
                <a href="/online-course?cat=Featured#search-course-section" class="normal-text btn-blue-on-hover @if(Request::get('cat')  == 'Featured') btn-blue-active @endif" style="font-family: Poppins Medium;margin-bottom:0px;text-decoration:none">Featured</a>
                @foreach($course_categories as $category)
                <a 
                href="{{ request()->fullUrlWithQuery(['cat' => $category->id]) }}#search-course-section" 
                
                
                class="normal-text btn-blue-on-hover @if(Request::get('cat')  == $category->id) btn-blue-active @endif" style="font-family: Poppins Medium;margin-bottom:0px;text-decoration:none">{{$category->category}}</a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- MOST POPULAR -->
    <div class="course-content" id="course-popular">
        <div class="row m-0 p-0">
            @if(count($courses) == 0)
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Venidici On-Demand tidak ditemukan.</span></p>
            </div>
            @endif
        
            @foreach($courses as $course)

            <div class="col-4 p-0" style="margin-top:3vw">
                <div style="display: flex;justify-content:center">
                    <!-- START OF ONE GREEN COURSE CARD -->
                    <div class="course-card-green">
                        <div class="container">
                            <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                            <div class="top-left card-tag small-text">Online Course</div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="height:6vw">
                                <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                    <a href="/online-course/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;text-decoration:none">{{ $course->title }}</a>
                                    <i style="font-size:2vw;padding-left:0.5vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i>
                                </div>
                                @foreach ($course->hashtags as $tag)
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{ $tag->hashtag }}</a>
                                @endforeach
                            </div>
                            <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">{{ $course->description }}</p>
                            </div>

                            <div style="display: flex;justify-content:space-between;margin-top:1vw" >
                                <p class="very-small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                @if ($course->total_duration)
                                    <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">{{ $course->total_duration }} mins</p>
                                    @else
                                    <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">- mins</p>

                                @endif
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">{{ $course->average_rating }}/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $course->average_rating)
                                            @if ($i == 1)
                                                <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            @endif
                                        @else
                                            @if ($i == 1)
                                                <i style="color:#B3B5C2" class="fas fa-star small-text"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                @if ($course->price == 0)
                                    <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">FREE</p>
                                @else
                                    <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                @endif
                                <a href="/online-course/{{$course->id}}" class="course-card-button normal-text">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE GREEN COURSE CARD -->
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    <!-- END OF MOST POPULAR -->
    

    <!-- END OF CLASSES SECTION -->
</div>
<!-- END OF COURSE LIST SECTION -->
    
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