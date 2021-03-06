@extends('./layouts/client-main')
@section('title', 'Venidici Online Course Learn')

@section('content')

<?php $last_content_id =0;?>
@foreach($sections as $section)
    @foreach($section->sectionContents as $content_detail)
        @if($loop->last)
            <?php $last_content_id = $content_detail->id ?>
        @endif
    @endforeach
@endforeach
<div class="row m-0 page-container course-page-background" style="padding-top:11vw;padding-bottom:10vw">
    <!-- START OF MOBILE DAFTAR PELATIHAN SECTION -->
    <div class="col-12 p-0 mobile-display" style="margin-top:2vw;display:none;margin-bottom:4vw">
        <div style="display:flex;justify-content:flex-end">
            <div class="rounded-card" style="width:100%;height:auto">
                <div style="padding:1.5vw">
                    <p class="small-heading" id="card-title" style="color:#3B3C43;font-family:Rubik Medium">Daftar Pelatihan</p>
                </div>
                @foreach($sections as $section)
                <!-- START OF ONE ACCORDION -->
                <div class="accordion" id="accordion{{$section->id}}">
                    <div class="accordion-item" >
                        <h2 class="accordion-header" id="heading{{$section->id}}" style="background: rgba(111, 159, 205, 0.1)">
                        <button class="accordion-button bigger-text @if($content->section_id != $section->id) collapsed @endif" style="border:none;border-radius:0px;font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$section->id}}" aria-expanded="@if($content->section_id == $section->id) true @else false @endif" aria-controls="collapse{{$section->id}}">
                            <span class="bigger-text">{{$section->title}}</span>
                        </button>
                        </h2>

                        <?php 
                        $flag=null;
                        if($loop->last) $flag = true;
                        ?>
                        <div id="collapse{{$section->id}}" class="accordion-collapse @if($content->section_id != $section->id) collapse @endif" aria-labelledby="heading{{$section->id}}" data-bs-parent="#accordion{{$section->id}}">
                            <div class="accordion-body" style="padding:0vw;border:none !important">
                                @foreach($section->sectionContents as $content_detail)
                                
                                <!-- START OF ONE COURSE -->
                                <a href="/online-course/{{$section->course->title}}/learn/lecture/{{$content_detail->title}}" style="text-decoration:none">
                                    <div class="course-collapse @if($content_detail->id == $content->id) course-collapse-active @endif">
                                        <div style="display:flex;justify-content:space-between">
                                            @php 

                                            $info_users = explode(',', $content_detail->hasSeen);
                                            $infoHasSeen = FALSE;
                                            foreach($info_users as $user_id)
                                            {
                                            if($user_id == Auth::user()->id)
                                                $infoHasSeen = TRUE;
                                            }   
                                            @endphp
                                            @if($infoHasSeen)
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">{{$content_detail->title}}</p>
                                            @else
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">{{$content_detail->title}}</p>
                                            @endif
                                            <div style="padding-left:0.5vw">
                                                <p class="normal-text text-nowrap" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:0px">{{floor(($content_detail->duration / 60) % 60)}}:@if(strlen($content_detail->duration % 60) == 1)<span>0</span>@endif{{$content_detail->duration % 60}}</p>
                                            </div>
                                        </div>
                                        @if($infoHasSeen)
                                        <i style="color:#E2E2E2" class="fas fa-play-circle"></i>
                                        @else
                                        <i style="color:#2B6CAA" class="fas fa-play-circle"></i>
                                        @endif
                                        @if($loop->last && $flag)
                                            @if($infoHasSeen)
                                            <i style="color:#E2E2E2" class="fas fa-question-circle"></i>
                                            @else
                                            <i style="color:#2B6CAA" class="fas fa-question-circle"></i>
                                            @endif
                                        @endif
                                    </div>  
                                </a>
                                <!-- END OF ONE COURSE -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF ONE ACCORDION -->
                @endforeach
                
            </div>
        </div>
    </div>
    <!-- END OF MOBILE DAFTAR PELATIHAN SECTION -->

    <!-- START OF BANNER SECTION -->    
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family:Rubik Medium;color:#3B3C43;">{{$content->title}}</p>
        <!--<div style="padding-right:6vw">
            <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"></p>
        </div>
        -->
    </div>  
    <!-- END OF BANNER SECTION -->

    <!-- START OF LEARNING SECTION -->
    <div class="col-12 col-md-8 p-0">
        <div style="margin-top:2vw" class="desktop-display">
            @if ($content->youtube_link)
                <iframe style="width:100%;height:35vw;border-radius:10px;display:block;object-fit: cover" 
                    src="{{ $content->youtube_link . '?controls=0' }}" allowfullscreen>
                </iframe>
            @endif
        </div>
        <div style="margin-top:2vw;display:none" class="mobile-display">
            @if ($content->youtube_link)
                <iframe style="width:100%;height:60vw;border-radius:10px;display:block;object-fit: cover" 
                    src="{{ $content->youtube_link . '?controls=0' }}" allowfullscreen>
                </iframe>
            @endif
        </div>
        <!-- START OF DESCRIPTION SECTION -->
        <div style="background: #F7F7F7;border-radius: 10px;padding:2vw;margin-top:2vw  ">
            <div style="display:flex">
                <p class="sub-description blue-text-underline blue-text-underline-active user-links" onclick="changeContent(event, 'deskripsi')"  style="font-family:Rubik Medium;cursor:pointer;margin-bottom:0px;text-decoration-color: #F7F7F7;">Deskripsi</p>
                <p class="sub-description blue-text-underline user-links" onclick="changeContent(event, 'notes')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px;text-decoration-color: #F7F7F7;">Attachment</p>
            </div>
            <div style="margin-top:2vw" class="user-content" id="deskripsi">
                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;">{{$content->description}}</p>
                @if($assessment != null)
                    
                @if($content->id == $last_content_id && $course->course_type_id == 1)
                    <div>
                        <p class="bigger-text"style="font-family:Rubik Medium;text-decoration-color: #F7F7F7;margin-top:1vw;">Assessment</p>
                        <div style="display:flex;justify-content:space-between">
                            <div>
                            <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43;">{{$assessment->title}}</p>
                            <!--
                            <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;">Durasi {{floor(($assessment->duration / 60) % 60)}}:@if(strlen($assessment->duration % 60) == 1)<span>0</span>@endif{{$assessment->duration % 60}}</p>
                            -->
                            <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;">Durasi {{$assessment->duration}} menit</p>
                            </div>

                            @php
                            $hasSeenAll = TRUE;
                                $x = 1;
                                foreach($sections as $section){
                                    foreach($section->sectionContents as $content){
                                        $all_users = explode(',', $content->hasSeen);
                                        foreach($all_users as $user_id)
                                        {
                                            if($user_id == auth()->user()->id)
                                            {
                                                $x=1;
                                                break;
                                            }
                                            if($x == count($all_users) && $user_id != auth()->user()->id)
                                                $hasSeenAll = FALSE;
                                            $x++;
                                        }
                                    }
                                }
                            @endphp

                            @if($hasSeenAll)
                            <button onclick="window.open('{{ route('online-course-assessment.show', $course->id) }}','_self');" class="normal-text btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.3vw 2vw">Buka Assesment</button>
                            @else
                            <div style="text-align:right">
                                <button  class="normal-text btn-grey" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.3vw 2vw;border-radius:10px">Buka Assesment</button>
                                <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#CE3369;margin-top:1vw">*Harap selesaikan course sebelum mulai assesment*</p>
                            </div>
                            @endif
                        </div>
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-top:2vw;margin-bottom:0px;color:#C4C4C4;">Deskripsi Assesment</p>
                        <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;">{{$assessment->description}}</p>
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-top:2vw;margin-bottom:0px;color:#C4C4C4;">Persyaratan</p>
                        @foreach($assessment->assessmentRequirements as $req)
                            <div style="display:flex;align-items:baseline;margin-top:0.5vw">
                                <i style="color:#C4C4C4" class="fas fa-circle very-small-text"></i>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;margin-left:0.5vw;margin-bottom:0px">{{$req->requirement}}</p>
                            </div>
                        @endforeach
                    </div>
                    @endif
                @endif
            </div>
            <div style="margin-top:2vw;display:none" class="user-content" id="notes">
                @if($content->attachment)
                <a href="{{ asset($content->attachment) }}" target="_blank" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;margin-top:1.5vw">View Attachment</a>        
                @else
                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;">Tidak ada attachment.</p>
                @endif
            </div>
        </div>
        <!-- END OF DESCRIPTION SECTION -->
    </div>
    <div class="col-4 p-0 desktop-display" style="margin-top:2vw">
        <div style="display:flex;justify-content:flex-end">
            <div class="rounded-card" style="width:23vw;height:auto">
                <div style="padding:1.5vw">
                    <p class="small-heading" id="card-title" style="color:#3B3C43;font-family:Rubik Medium">Daftar Pelatihan</p>
                </div>
                @foreach($sections as $section)
                <!-- START OF ONE ACCORDION -->
                <div class="accordion" id="accordion{{$section->id}}">
                    <div class="accordion-item" >
                        <h2 class="accordion-header" id="heading{{$section->id}}" style="background: rgba(111, 159, 205, 0.1)">
                        <button class="accordion-button bigger-text @if($content->section_id != $section->id) collapsed @endif" style="border:none;border-radius:0px;font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;text-align:left" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$section->id}}" aria-expanded="@if($content->section_id == $section->id) true @else false @endif" aria-controls="collapse{{$section->id}}">
                            <span class="bigger-text">{{$section->title}}</span>
                        </button>
                        </h2>

                        <?php 
                        $flag=null;
                        if($loop->last) $flag = true;
                        ?>
                        <div id="collapse{{$section->id}}" class="accordion-collapse @if($content->section_id != $section->id) collapse @endif" aria-labelledby="heading{{$section->id}}" data-bs-parent="#accordion{{$section->id}}">
                            <div class="accordion-body" style="padding:0vw;border:none !important">
                                @foreach($section->sectionContents as $content_detail)
                                
                                <!-- START OF ONE COURSE -->
                                <a href="/online-course/{{$section->course->title}}/learn/lecture/{{$content_detail->title}}" style="text-decoration:none">
                                    <div class="course-collapse @if($content_detail->id == $content->id) course-collapse-active @endif">
                                        <div style="display:flex;justify-content:space-between">
                                            @php 

                                            $info_users = explode(',', $content_detail->hasSeen);
                                            $infoHasSeen = FALSE;
                                            foreach($info_users as $user_id)
                                            {
                                            if($user_id == Auth::user()->id)
                                                $infoHasSeen = TRUE;
                                            }   
                                            @endphp
                                            @if($infoHasSeen)
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">{{$content_detail->title}}</p>
                                            @else
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">{{$content_detail->title}}</p>
                                            @endif
                                            <div style="padding-left:0.5vw">
                                                <p class="normal-text text-nowrap" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:0px">{{floor(($content_detail->duration / 60) % 60)}}:@if(strlen($content_detail->duration % 60) == 1)<span>0</span>@endif{{$content_detail->duration % 60}}</p>
                                            </div>
                                        </div>
                                        @if($infoHasSeen)
                                        <i style="color:#E2E2E2" class="fas fa-play-circle"></i>
                                        @else
                                        <i style="color:#2B6CAA" class="fas fa-play-circle"></i>
                                        @endif
                                        @if($loop->last && $flag)
                                            @if($infoHasSeen)
                                            <i style="color:#E2E2E2" class="fas fa-question-circle"></i>
                                            @else
                                            <i style="color:#2B6CAA" class="fas fa-question-circle"></i>
                                            @endif
                                        @endif
                                    </div>  
                                </a>
                                <!-- END OF ONE COURSE -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF ONE ACCORDION -->
                @endforeach
                
                <!-- START OF ONE ACCORDION 
                <div class="accordion" id="accordionFAQ">
                    <div class="accordion-item" >
                        <h2 class="accordion-header" id="headingOne" style="background: rgba(111, 159, 205, 0.1)">
                        <button class="accordion-button bigger-text" style=";border:none;border-radius:0px;font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFAQ" aria-expanded="true" aria-controls="collapseFAQ">
                        <span class="bigger-text">Question and Answer</span>
                        </button>
                        </h2>
                        <div id="collapseFAQ" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body" style="padding:0vw;border:none !important">
                                
                                <!-- START OF ONE COURSE 
                                <a href="" style="text-decoration:none">
                                    <div class="course-collapse">
                                        <div style="display:flex;justify-content:space-between">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">QnA Part 1</p>
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:0px">3:20</p>
                                        </div>
                                        <i style="color:#E2E2E2" class="fas fa-play-circle"></i>
                                    </div>  
                                </a>
                                <!-- END OF ONE COURSE 
                                <!-- START OF ONE COURSE 
                                <a href="" style="text-decoration:none">
                                    <div class="course-collapse">
                                        <div style="display:flex;justify-content:space-between">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">QnA Part 2</p>
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:0px">4:20</p>
                                        </div>
                                        <i style="color:#E2E2E2" class="fas fa-play-circle"></i>
                                    </div>  
                                </a>
                                <!-- END OF ONE COURSE
                            </div>
                        </div>
                    </div>
                </div>
                 END OF ONE ACCORDION -->
                
            </div>
        </div>
    </div>
    <!-- END OF LEARNING SECTION -->
</div>

    
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

