@extends('./layouts/client-main')
@section('title', 'Venidici Job Portal List')

@section('content')

    <!-- START OF BANNER SECTION -->
    <div class="row m-0 banner-background page-container desktop-display"
        style="height: 50vw; padding-top: 19vw; text-align: center;
        background-image: url('/assets/images/seeder/homepage_background.png');">
        <div class="col-md-12 p-0 wow fadeInUp" data-wow-delay="0.3s">
            <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">Selamat datang di
            Hiring Partner!</p>
            <p class="sub-description" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line">Platform anak kekinian buat naklukin
karir impian!</p>
            <div style="display:flex;justify-content:center;margin-top:4vw">
                <div style="display:flex;align-items:center;">
                    <div class="btn-blue-toggle  toggle-link" style="border-radius:10px 0px 0px 10px" onclick="window.location.href='/job-portal'">
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px" >Kandidat Venidici</p>
                    </div>   
                    <div class="btn-blue-toggle toggle-link btn-blue-toggle-active" onclick="window.location.href='job-portal/my-list'" >
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px">Daftar Saya</p>
                    </div>    
                </div>
            </div>
            
        </div>
    </div>
    <!-- END OF BANNER SECTION -->

    <div class="toggle-content" id="daftar-saya">

        <!-- START OF DESCRIPTION AND SEARCH SECTION -->
        <div class="row m-0 page-container desktop-display" style="padding-top:8vw">
            <!-- START OF SEARCH SECTION -->
            <div class="col-12 p-0" style="display:flex;align-items:center;margin-top:3vw;justify-content:space-between">
                <div style="display:flex;align-items:center">
                    <div style="">
                        <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                            <select name="" class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option value="None" disabled selected>Years of Experience</option>
                                <option value="all" >Semua</option>
                                @foreach ($availableExperienceYearFilters as $filter)
                                    <option value="{{ $filter }}">{{ $filter }}</option>
                                @endforeach
                            </select>                    
                            @error('')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>

                    <div style="margin-left: 3vw;">
                        <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                            <select name="" class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option value="None" disabled selected>Status</option>
                                <option value="Business">Business</option>
                                <option value="Technology">Technology</option>
                            </select>                    
                            @error('')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>

                    <div style="margin-left: 3vw;">
                        <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                            <select name="" class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option value="None" disabled selected>Sort by</option>
                                <option value="Alphabet Ascending">Alphabet Ascending</option>
                                <option value="Alphabet Descending">Alphabet Descending</option>
                            </select>                    
                            @error('')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                </div>
                </div>
            <!-- END OF SEARCH SECTION -->

        </div>
        <!-- END OF DESCRIPTION AND SEARCH SECTION -->
        <!-- START OF JOB LISTING -->
        <div class="row m-0 page-container" style="padding-bottom:8vw">
            @if (session()->has('my_list_message'))
            <div class="col-12 ps-0 pe-0" style="margin-top:4vw">
                <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular;text-align:center" role="alert" >
                    {{ session()->get('my_list_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <!-- START OF TABLE -->
            <div class="col-lg-12" style="margin-top:4vw;background: #FFFFFF;box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.25);border-radius: 10px;padding:2vw 0vw">
                <div class="row m-0" style="padding:0vw 2vw 2vw 2vw">
                    <div class="col-8"> 
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43;">Candidate</p>
                    </div>
                    <div class="col-2" style="text-align:center"> 
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43;">Status</p>
                    </div>
                    <div class="col-2"  style="text-align:center"> 
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43;">Action</p>
                    </div>
                </div>
                
                @isset($contactedCandidates)
                    @foreach ($contactedCandidates as $candidate)
                        <div class="row m-0  job-listing-card" >
                            <div class="col-8"> 
                                <div style="display:flex;align-items:center">
                                    <img @if(Auth::user()->avatar == null) src="/assets/images/client/Default_Display_Picture.png" @else src="{{ $candidate->user->userDetail->display_picture }}" @endif style="width:5vw;height:5vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                                    <div style="margin-left:1vw">
                                        <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0.5vw">{{ $candidate->name }}</p>
                                        <p class="normal-text" style="font-family: Rubik Regular;color:#2B6CAA;margin-bottom:0.5vw">{{ $candidate->candidateDetail->industry }}</p>
                                        <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px">{{ $candidate->candidateDetail->experience_year }} in {{ $candidate->candidateDetail->industry }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2" style="text-align:center">
                                @if ($candidate->pivot->status == 'archived')
                                    <p class="normal-text" style="font-family: Rubik Medium;background-color:#F4C257;color:#3B3C43;text-decoration:none;padding:0.5vw;border-radius:5px">Pending</p>
                                @elseif ($candidate->pivot->status == 'contacted')
                                    <p class="normal-text" style="font-family: Rubik Medium;background-color:#D0F5EB;color:#3B3C43;text-decoration:none;padding:0.5vw;border-radius:5px">Contacted</p>
                                @elseif ($candidate->pivot->status == 'accepted')
                                    <p class="normal-text" style="font-family: Rubik Medium;background-color:#D0F5EB;color:#3B3C43;text-decoration:none;padding:0.5vw;border-radius:5px">Accepted</p>
                                @elseif ($candidate->pivot->status == 'rejected')
                                    <p class="normal-text" style="font-family: Rubik Medium;background-color:#F4C257;color:#3B3C43;text-decoration:none;padding:0.5vw;border-radius:5px">Rejected</p>
                                @elseif ($candidate->pivot->status == 'hired')
                                    <p class="normal-text" style="font-family: Rubik Medium;background-color:#D0F5EB;color:#3B3C43;text-decoration:none;padding:0.5vw;border-radius:5px">Hired</p>
                                @endif
                            </div>
                            <div class="col-2"  style="text-align:center"> 
                                <form name="action-form" action="{{ route('job-portal.accept-candidate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $candidate->candidateDetail->user->id }}" hidden>
                                    <div class="grey-input-form" style="display: flex;align-items:center;width:100%;background-color:#2B6CAA">
                                        <select name="" class="normal-text action-select"  style="background:transparent;border:none;color: #ffffff;width:100%;font-family:Rubik Regular;">
                                            <option value="None" disabled selected>Select Action</option>
                                            @if ($candidate->pivot->status == 'archived')
                                                <option style="color: black" value="Contact">Contact</option>
                                                <option style="color: black" value="Remove">Remove from List</option>
                                            @elseif ($candidate->pivot->status == 'contacted')
                                                <option style="color: black" value="Accept">Accept</option>
                                                <option style="color: black" value="Reject">Reject</option>
                                                <option style="color: black" value="Remove">Remove from List</option>
                                            @elseif ($candidate->pivot->status == 'accepted')
                                                <option style="color: black" value="Cancel">Cancel</option>
                                            @elseif ($candidate->pivot->status == 'rejected')
                                                <option style="color: black" value="Cancel">Cancel</option>
                                            @endif
                                        </select>
                                        @error('')
                                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endisset

                <div class="row m-0" style="">
                    <div class="col-12 p-0" style="text-align:center">
                        <div style="padding-top:1.5vw;display:flex;justify-content:center">
                            <div class="mx-auto normal-text" style="font-family: Rubik Regular">
                                {{ $contactedCandidates->appends(request()->input())->links("pagination::bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF TABLE -->

        </div>
    </div>


    <!-- END OF JOB LISTING -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
  $('.action-select').on('change', function() {
     document.forms['action-form'].submit();
  });
});
</script>

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