@extends('./layouts/client-main')
@section('title', 'Venidici Job Portal')

@section('content')

    <!-- START OF BANNER SECTION -->
    <div class="row m-0 banner-background page-container " id="height-jobportal-mobile"
        style="height: 50vw; padding-top: 19vw; text-align: center;
        background-image: url('/assets/images/seeder/homepage_background.png');">
        <div class="col-md-12 p-0 wow fadeInUp" data-wow-delay="0.3s">
            <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">Selamat datang di
            Hiring Partner!</p>
            <p class="sub-description" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line">Platform anak kekinian buat naklukin
karir impian!</p>
            <div style="display:flex;justify-content:center;margin-top:4vw">
                <div style="display:flex;align-items:center;">
                    <div class="btn-blue-toggle btn-blue-toggle-active toggle-link" style="border-radius:10px 0px 0px 10px" onclick="window.location.href='job-portal'">
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px" >Kandidat Venidici</p>
                    </div>   
                    <div class="btn-blue-toggle toggle-link" onclick="window.location.href='job-portal/my-list'">
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px">Daftar Saya</p>
                    </div>    
                </div>
            </div>
            
        </div>
    </div>
    <!-- END OF BANNER SECTION -->


    <div class="toggle-content" id="kandidat-venidici">

        <!-- START OF DESCRIPTION AND SEARCH SECTION -->
        <div class="row m-0 page-container " style="padding-bottom:4vw;padding-top:8vw">
            <div class="col-12 p-0">
                <p class="medium-heading" style="font-family: Rubik Bold;color:#2B6CAA">Kandidat dari Venidici</p>
            </div>
            <div class="col-lg-6 col-xs-12 p-0">
                <p class="bigger-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#000000;margin-top:1vw">Odio vehicula cursus nullam ornare. Elit tincidunt tellus ac non posuere tellus risus pharetra a. Aliquet integer sodales viverra turpis eu senectus ornare urna ornare. Sed aliquam risus nisl, nunc, accumsan vitae.</p>
            </div>
            <div class="col-lg-6 col-xs-12 p-0">
            </div>

            <!-- START OF SEARCH SECTION -->
            <div class="col-lg-3 col-xs-12 p-0" style="margin-top:3vw">
                <form action="{{ route('job-portal.index') }}" method="get" style="display:flex">
                    @if (Request::get('show'))
                        <input name="show" value="{{ Request::get('show') }}" hidden>
                    @endif
                    <div class="grey-input-form" style="display: flex;align-items:center">
                        <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid desktop-display" alt="">
                        <input type="text" name="search" class="normal-text typeahead" autocomplete="off"
                            style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:15vw;font-family:Rubik Regular" id="jp-mobile-input"
                            placeholder="Search Name & Skill" value="{{ Request::get('search') }}">
                    </div>
                    <div style="margin-left: 1vw;">
                        <button type="submit" onclick="openLoading()" class="btn-search normal-text"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-xs-6 p-0" style="margin-top:3vw">
                <div style="margin-left: 3vw;" id="margin-left-mobile-jp">
                    <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                        <select name="years_of_experience" class="normal-text" onchange="if (this.value) window.location.href=this.value"
                            style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                            <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'years_of_experience' => 'none']) }}" @if (!Request::has('years_of_experience')) selected @endif>Years of Experiences</option>
                            @foreach ($availableExperienceYearFilters as $filter)
                                <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'years_of_experience' => $filter]) }}" @if (Request::get('years_of_experience') == $filter) selected @endif>{{ $filter }}</option>
                            @endforeach
                        </select>
                    </div>  
                </div>
            </div>
            <div class="col-lg-3 col-xs-6 p-0" style="margin-top:3vw">
                <div style="margin-left: 3vw;" id="margin-left-mobile-jp">
                    <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                        <select name="sort" class="normal-text" onchange="if (this.value) window.location.href=this.value"
                        style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                            <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'none']) }}" @if (!Request::has('sort')) selected @endif>Sort by</option>
                            <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'alpha-asc']) }}" @if (Request::get('sort') == 'alpha-asc') selected @endif>Alphabet Ascending</option>
                            <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'alpha-desc']) }}" @if (Request::get('sort') == 'alpha-desc') selected @endif>Alphabet Descending</option>
                        </select>
                    </div>  
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 p-0" style="margin-top:3vw;display:flex;justify-content:flex-end;align-items:center">
                <a href=""  class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;">Refresh</a>
            </div>

            <!-- END OF SEARCH SECTION -->

        </div>
        <!-- END OF DESCRIPTION AND SEARCH SECTION -->


        <!-- START OF JOB LISTING -->
        <div class="row m-0 page-container" style="padding-bottom:8vw">
            @if (session()->has('message'))
            <div class="col-12 ps-0 pe-0">
                <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular;text-align:center" role="alert" >
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            @isset($candidateDetails)
                @foreach ($candidateDetails as $candidateDetail)
                    @if($loop->iteration % 3 == 1)
                    <div class="col-lg-4 col-xs-12 p-0" style="margin-top:4vw;display:flex;justify-content:flex-start">
                    @elseif($loop->iteration % 3 == 2)
                    <div class="col-lg-4 col-xs-12 p-0" style="margin-top:4vw;display:flex;justify-content:center">
                    @elseif($loop->iteration % 3 == 0)
                    <div class="col-lg-4 col-xs-12 p-0" style="margin-top:4vw;display:flex;justify-content:flex-end">
                    @endif   
                        <div style="width:24vw;border:2px solid #2B6CAA;border-radius:5px;" id="width-auto-mobile" >
                            <div class="row m-0" style=";padding:1vw;background-color:#2B6CAA;cursor:pointer" onclick="window.location.href='/job-portal/{{$candidateDetail->user_id}}'">
                                <div class="col-4 ps-0">
                                    <img @if(Auth::user()->avatar == null) src="/assets/images/client/Default_Display_Picture.png" @else src="{{ $candidateDetail->user->userDetail->display_picture }}" @endif style="width:7vw;height:100%;object-fit:cover;border-radius:5px" id="width-auto-mobile" class="img-fluid" alt="Image not available..">
                                </div>
                                <div class="col-8">
                                    <div style="margin-bottom:0.5vw">
                                        <a href="/job-portal/{{$candidateDetail->user_id}}" class="normal-text" style="font-family: Rubik Medium;color:#FFFFFF;text-decoration:none;">{{ $candidateDetail->user->name }}</a>
                                    </div>
                                    <p class="small-text" style="font-family: Rubik Regular;color:#B7CFE6;margin-bottom:1vw">{{ $candidateDetail->experience_year }} in {{ $candidateDetail->industry }}</p>
                                    <a class="small-text" style="font-family: Rubik Medium;background-color:#67BBA3;color:#ffffff;text-decoration:none;padding:0.5vw;border-radius:5px">Looking for a job</a>
                                </div>
                            </div>
                            <div style="padding:1vw;background:#FFFFFF">
                                <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA">Dominant Skill:</p>
                                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">{{ $candidateDetail->industry }}</p>
                                
                                <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Interest:</p>
                                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;">{{ $candidateDetailIdAndCombinedInterestMap[$candidateDetail->id] }}</p>
        
                                <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-top:0.5vw">Bootcamp Score: {{ $candidateDetailIdAndScoreMap[$candidateDetail->id] }}</p>
                                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2.5vw;">
                                    @if (in_array($candidateDetail->user->id, $archivedCandidateIds))
                                        <button class="normal-text btn-dark-blue full-width-button" disabled id="button-added-jp"
                                            style="border:none;font-family: Rubik Bold;margin-bottom:0px;">
                                            Added</button>
                                    @else
                                        <form action="{{ route('job-portal.archive-candidate') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $candidateDetail->user->id }}" hidden>
                                            <button class="normal-text btn-dark-blue full-width-button" type="submit" 
                                                style="border:none;font-family: Rubik Bold;margin-bottom:0px;cursor:pointer;">
                                                Add to my list</button>
                                        </form>
                                    @endif
                                    <div style="display:flex">
                                        <a href="{{ $candidateDetail->linkedin_link }}" target="_blank" class="sub-description margin-right-for-icon-jp-mobile" id="icon-font-size-mobile-jp" style="margin-right:1vw;z-index:">
                                            <i class="fab fa-linkedin " style="color:#3B3C43"></i> 
                                        </a>
                                        <a href="{{ $candidateDetail->cv_file }}" target="_blank" class="sub-description " id="icon-font-size-mobile-jp">
                                            <i class="fas fa-download " style="color:#3B3C43"></i>  
                                        </a>
                                    </div>
        
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset

        </div>
    </div>

    <!-- END OF JOB LISTING -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function changeContent(evt, categoryName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("toggle-content")
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("toggle-link");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("btn-blue-toggle-active", "btn-blue-toggle");
        }
        document.getElementById(categoryName).style.display = "block";
        evt.currentTarget.className += " btn-blue-toggle-active";
    }
</script>
@endsection