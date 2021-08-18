@extends('./layouts/client-main')
@section('title', 'Pelatihan Venidici')

@section('content')
<!-- START OF BANNER SECTION -->
<div class="row m-0 banner-background page-container pelatihan-venidici-mobile-container" style="height:40vw;padding-top:16vw;text-align:center">
    <div class="col-md-12 p-0">
        <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line" >Pelatihan Venidici</p>
        <p class="sub-description" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line;margin-bottom:3vw" >Platform anak muda kekinian buat naklukin karir impian!</p>
        
        <a href="#search-course-section" class="sub-description btn-blue-bordered btn-blue-bordered-active" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;width:100%;margin-top:5vw;padding:0.8vw 1vw">Search Courses</a>

    </div>
</div>

<!-- END OF BANNER SECTION -->

<div style="padding-bottom:5vw">
</div>
<!-- START OF TESTIMONY SECTION -->
<div class="row m-0 page-container review-course-background" style="padding-bottom: 8vw;padding-top:4vw">
    <!-- START OF FEATURE SECTION -->
    <!-- start mobile section -->
    <div class="col-12 col-md-4 p-0 mobile-display" id="pt-feature-section" style="display: flex;flex-direction: column;justify-content: center;align-items:center;display:none">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;">Take a look at what they say about Venidici</p>
        <!--<p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;margin-top:2vw;margin-bottom:2vw">Want to review us?</p>
        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;padding:0.8vw 2vw;">Review Now</a>-->

    </div>
    <!-- end of mobile section -->
    
    <div class="col-12 col-md-8" style="padding-left:0vw;padding-right:4vw">

        <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 3.5vw;">
                @if(count($user_review) == 0)
                <div class="carousel-item active">
                    <div class="card-white height-card-white-mobile" >
                        <div style="display:flex;align-items:center">   
                            <img src="/assets/images/client/Default_Display_Picture.png" style="width:5vw;border-radius:10px" class="img-fluid" alt="">
                            <div style="margin-left:1vw">
                                <p class="small-heading" id="user-font-size-mobile" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0vw">@wishnumurti</p>
                                <p class="bigger-text" style="font-family: Rubik Regular;color:#55525B;margin-top:-0.3vw;margin-bottom:0vw"></p>
                            </div>
                        </div>
                        <div style="display: flex;justify-content:flex-start;margin-top:1vw">
                            <i style="color:#F4C257;" class="fas fa-star sub-description"></i>
                            <i style="color:#F4C257;" class="fas fa-star sub-description"></i>
                            <i style="color:#F4C257;" class="fas fa-star sub-description"></i>
                            <i style="color:#F4C257;" class="fas fa-star sub-description"></i>
                            <i style="color:#F4C257;" class="fas fa-star sub-description"></i>
                                    <!-- <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star sub-description"></i> -->
                        </div>
                        <p class="normal-text" style="font-family: Rubik Regular;color:#55525B;margin-top:1vw; display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 4 !important;
                        -webkit-box-orient: vertical !important;">In those 4 hours, I got a lot of insights about business case competition, all the details from the framework used to the way of deliver analysis & solution so that it can be presented well to the jury</p>
                    </div>
                </div>
                @endif
                @foreach($user_review as $review)
                <div class="carousel-item @if($loop->first) active @endif">
                    <div class="card-white height-card-white-mobile" >
                        <div style="display:flex;align-items:center">   
                            <img @if($review->user->avatar == null) src="/assets/images/client/Default_Display_Picture.png" @else src="{{ asset($review->user->avatar) }}" @endif style="width:5vw;border-radius:10px" class="img-fluid" alt="">
                            <div style="margin-left:1vw">
                                <p class="small-heading" id="user-font-size-mobile" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0vw">{{$review->user->name}}</p>
                                <p class="bigger-text" style="font-family: Rubik Regular;color:#55525B;margin-top:-0.3vw;margin-bottom:0vw">{{$review->user->occupancy}}</p>
                            </div>
                        </div>
                        <div style="display: flex;justify-content:flex-start;margin-top:1vw">
                            @for ($i = 1; $i < 6; $i++)
                                @if($i <= $review->review)
                                    <i style="color:#F4C257;@if($i != 1) margin-left:0.5vw @endif" class="fas fa-star sub-description"></i>
                                @else
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star sub-description"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="normal-text" style="font-family: Rubik Regular;color:#55525B;margin-top:1vw; display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 4 !important;
                        -webkit-box-orient: vertical !important;">{{$review->description}}</p>
                    </div>
                </div>
                @endforeach

            </div>
            <a class="carousel-control-prev"   data-bs-target="#feature-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" class="left-arrow-mobile" id="carousel-control-left-menu-image " style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#feature-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" class="right-arrow-mobile" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
    <div class="col-12 col-md-4 p-0 desktop-display" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;">Take a look at what they say about Venidici</p>
        <!--<p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;margin-top:2vw;margin-bottom:2vw">Want to review us?</p>
        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;padding:0.8vw 2vw;">Review Now</a>-->

    </div>
</div>
<!-- END OF TESTIMONY SECTION -->

<!-- START OF COURSE LIST SECTION -->
<div class="row m-0 page-container" id="search-course-section" style="padding-top:4vw;padding-bottom:8vw">   
    <div class="col-12 p-0" style="text-align:center">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#55525B;margin-top:1vw;margin-bottom:0px">Find your Courses here!</p>
        <div style="display: flex;margin-top:2vw;justify-content:center;">
            <div  class="grey-input-form" style="display: flex;align-items:center">
                <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid search-course-title-icon" alt="">
                                
                <form action="" method="GET">
                    <input type="text" name="search" value="{{ Request::get('search') }}" type="search" class="small-text search-course-title-input-width" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:15vw" placeholder="Course Title">

                    @if (Request::get('show'))
                        <input hidden name="show" value="{{ Request::get('search') }}" type="search" class="small-text" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:15vw" placeholder="Course Title">
                    @endif
                    <input type="submit" style="visibility: hidden;" hidden/>
            </div>
            <div style="margin-left: 1vw;">
            <!--
                <select class="grey-input-form small-text" style="height:100%;appearance:none" aria-label="">-->
                <select class="grey-input-form small-text" name="cat" style="height:100%;padding-right:4vw" aria-label="">
                    <option selected disabled>Pilih Kategori</option>
                    <option value="Featured" @if (Request::get('cat') == 'Featured') selected @endif>Featured</option>
                    <option value="None" @if (Request::get('cat') == 'None') selected @endif>All</option>
                    @foreach($course_categories as $category)
                    <!-- <option value="{{$category->id}}">{{$category->category}}</option> -->
                    <option value="{{ $category->id }}" @if (Request::get('cat') == $category->id) selected @endif>{{ $category->category }}</option>

                    @endforeach
                </select>
            </div>
            <div style="margin-left: 1vw;">
                <button type="submit" class="btn-search small-text"><i class="fas fa-search"></i></button>
            </div>
            </form>

        </div>
    </div>
    <!-- START OF CLASSES SECTION -->
    <!--
    <div class="col-12 p-0" style="text-align: center;margin-top:1vw">
        <div style="padding:2vw 13.5vw 1vw 13.5vw;">
            <div style="display:flex;justify-content:space-between;align-items:center;background: #FFFFFF;border: 2px solid rgba(157, 157, 157, 0.1);border-radius: 10px;padding:0.7vw">
                <a href="/online-course?cat=Featured#search-course-section" class="normal-text btn-blue-on-hover @if(Request::get('cat')  == 'Featured') btn-blue-active @endif" style="font-family: Poppins Medium;margin-bottom:0px;text-decoration:none">Featured</a>
                @foreach($course_categories as $category)
                <a 
                href="{{ request()->fullUrlWithQuery(['cat' => $category->id]) }}#search-course-section" 
                
                
                class="normal-text btn-blue-on-hover @if(Request::get('cat')  == $category->id) btn-blue-active @endif" style="font-family: Poppins Medium;margin-bottom:0px;text-decoration:none">{{$category->category}}</a>
                @endforeach
            </div>
        </div>
    </div>
    -->
    <!-- MOST POPULAR -->
    <div class="course-content" id="course-popular">
        <div class="row m-0 p-0">
            @if(count($courses) == 0)
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Course tidak ditemukan.</span></p>
            </div>
            @endif
        
            @foreach($courses as $course)

            <div class="col-12 col-md-4 p-0" style="margin-top:3vw">
                <div style="display: flex;justify-content:center">
                    @if ($course->courseType->type == "Course")
                        <div class="course-card-green">
                    @elseif ($course->courseType->type == "Woki")
                        <div class="course-card-red">
                    @elseif ($course->courseType->type == "Bootcamp")
                        <div class="course-card-blue">
                    @endif
                        <div class="container">
                            <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:30vw;" alt="Snow">
                            <div class="top-left card-tag normal-text" style="">
                                @if ($course->courseType->type == "Course")
                                Skill-Snack
                                @elseif ($course->courseType->type == "Woki")
                                Woki
                                @elseif ($course->courseType->type == "Bootcamp")
                                Bootcamp
                                @endif
                            </div>
                            <div class="bottom-left" id="course-card-description" style="opacity:0;bottom:0;text-align:left;">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: #FFFFFF;">{{ $course->description }}</p>
                            </div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="height:10vw">
                                <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                    @if ($course->courseType->type == 'Course')
                                        <a href="/online-course/{{$course->title}}" class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;">{{ $course->title }}</a>
                                    @elseif ($course->courseType->type == 'Woki')
                                        <a href="/woki/{{$course->title}}" class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;">{{ $course->title }}</a>

                                    @elseif ($course->courseType->type == 'Bootcamp')
                                        <a href="/bootcamp/{{$course->id}}" class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;">{{ $course->title }}</a>

                                    @endif
                                    <!-- <i style="font-size:2vw;padding-left:4vw;font-size:4vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i> -->
                                </div>
                                @foreach ($course->hashtags as $tag)
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{ $tag->hashtag }}</a>
                                @endforeach
                            </div>
                            <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                <p class="course-card-description normal-text   " style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8)">{{ $course->description }}</p>
                            </div>

                            <div style="display: flex;justify-content:space-between;margin-top:3vw" >
                                <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">
                                @foreach($course->teachers as $teacher)

                                    @if ($loop->last && count($course->teachers) != 1)
                                    dan
                                    @elseif (!$loop->first)
                                    ,
                                    @endif
                                    {{$teacher->name}}
                                @endforeach
                                </p>
                                <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">
                                @if ($course->courseType->type == 'Course' || $course->courseType->type == 'Bootcamp')
                                    @if ($course->total_duration)
                                        {{ explode(',', $course->total_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @elseif ($course->courseType->type == 'Woki')
                                    @if ($course->wokiCourseDetail->event_duration)
                                        {{ explode(',', $course->wokiCourseDetail->event_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @endif
                                </p>
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px;">{{ $course->average_rating }}/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $course->average_rating)
                                            @if ($i == 1)
                                                <i style="color:#F4C257;" class="fas fa-star small-text"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#F4C257;" class="fas fa-star small-texxt"></i>
                                            @endif
                                        @else
                                            @if ($i == 1)
                                                <i style="color:#B3B5C2;" class="fas fa-star small-text"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#B3B5C2;" class="fas fa-star small-text"></i>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                @if ($course->price == 0)
                                    <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">FREE</p>
                                @else
                                    <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                @endif
                                @if ($course->courseType->type == 'Course')
                                    <a href="/online-course/{{$course->title}}" class="course-card-button normal-text" style="">Enroll Now</a>
                                    @elseif ($course->courseType->type == 'Woki')
                                    <a href="/woki/{{ $course->title }}" class="course-card-button normal-text" style="">Enroll Now</a>
                                    @elseif ($course->courseType->type == 'Bootcamp') 
                                    <a href="/bootcamp/{{ $course->id }}" class="course-card-button normal-text" style="">Enroll Now</a>
                                @endif
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE COURSE CARD -->
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