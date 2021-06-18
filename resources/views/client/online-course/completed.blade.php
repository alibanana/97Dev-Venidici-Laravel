@extends('./layouts/client-main')
@section('title', 'Venidici Community')

@section('content')

    <form id="retryAssessmentForm" action="{{ route('online-course-assessment.reset-user-assessment', $assessment_pivot->assessment_id) }}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="redirectURL" value="{{ route('online-course-assessment.show', $course->id) }}" hidden>
    </form>

    <div class="row m-0 page-container" style="padding-top:12vw;padding-bottom:8vw">
        <!-- START OF LEFT CONTENT -->
        <div class="col-6">
            <p class="medium-heading" style="font-family: Rubik Medium;margin-bottom:0.5vw;color:#2B6CAA">Good work!</p>
            <div style="display:flex;justify-content:space-between">
                <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0.5vw;color:#3B3C43">Kamu telah menyelesaikan course ini</p>
                <a onclick="document.getElementById('retryAssessmentForm').submit(); return false;" class="normal-text blue-link-underline" style="font-family: Rubik Medium;color:#2B6CAA;text-decoration:none;cursor:pointer">Ulang Assessment</a>
            </div>
            <div style="text-align: center;">
                <img src="/assets/images/client/Completed_Icon.svg" style="margin-top:2vw;width:23vw" class="img-fluid" alt="">
                <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0.5vw;color:#2B6CAA;margin-top:2vw">Score: {{ $assessment_pivot->score }}/100</p>
                <form action="{{route('print_certificate')}}" method="post">
                @csrf
                    <input type="hidden" name="name" value="{{auth()->user()->name}}">
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <button id="detail-button" class="normal-text text-nowrap btn-blue-bordered" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;margin-top:1vw">Cek Sertifikat</button>

                </form>
            </div>
            <!--             
            <div class="progress" style="height:3vw;background-color:rgba(43, 108, 170, 0.25);border-radius:10px">
                @if (is_null($assessment_pivot->score))
                    <div class="progress-bar normal-text" role="progressbar" style="font-family:Rubik Medium;width: 100%;background-color: rgba(43, 108, 170, 0.25);" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Assessment not completed yet..</div>
                @elseif($assessment_pivot->score == 0)
                    <div class="progress-bar normal-text" role="progressbar" style="font-family:Rubik Medium;width: 100%;background-color: rgba(43, 108, 170, 0.25);" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0/100 </div>
                @else
                    <div class="progress-bar normal-text" role="progressbar" style="font-family:Rubik Medium;width: {{ $assessment_pivot->score }}%;background-color:#2B6CAA;" aria-valuenow="{{ $assessment_pivot->score }}" aria-valuemin="0" aria-valuemax="100">{{ $assessment_pivot->score }}/100</div>
                @endif
            </div> -->
            <!-- <div style="display:flex;justify-content:space-between;align-items:center;margin-top:3vw">
                <button class="normal-text  btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;">Unduh Sertifikat</button>
                <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">Atau</p>
            </div> -->
        </div>
        <!-- END OF LEFT CONTENT -->

        <!-- START OF RIGHT CONTENT -->
        <div class="col-6" style="display:flex;justify-content:flex-end">
            @if(session('review_message_double') || session('review_message'))

            <div style="padding-left:5vw">
                
                @if(session('review_message'))

                <!-- ALERT MESSAGE -->
                <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                    {{ session('review_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
                @elseif(session('review_message_double'))
                <!-- ALERT MESSAGE -->
                <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                    {{ session('review_message_double') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
                @endif
                <div style="background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 10px;display:flex;height:15vw">
                    <img src="/assets/images/client/discord_bg.png" class="img-fluid" style="width:50%" alt="">
                    <div style="width:100%;padding:1.5vw">
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0.5vw;color:#3B3C43">Join our Discord: Venidici Community</p>
                        <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0.5vw;color:#3B3C43">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem cras nullam et facilisis at. Aenean suspendisse in blandit enim.</p>
                    </div>
                </div>
                <a href="/online-course" style="text-decoration:none">
                    <div style="margin-top:1.5vw;background: #2B6CAA;border-radius: 10px;display:flex;align-items:center;justify-content:space-between;padding:1vw">
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/icons/blue_bug_icon.png" style="height:2vw" class="img-fluid" alt="">
                            <p class="bigger-text" style="font-family: Rubik Medium;margin-left:1vw;color:#3B3C43;margin-bottom:0px;color:#FFFFFF">Explore more courses on <span style="font-family:Rubik Bold">Online Course</span></p>
                        </div>
                        <i class="fas fa-arrow-right bigger-text" style="color:#FFFFFF"></i>
                    </div>
                </a>
            </div>
            @else
            <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.11);border-radius: 10px;width:35vw;height:24vw;padding:2vw">
                
                <p class="sub-description" style="font-family: Rubik Medium;margin-bottom:0.5vw;margin-right:3vw;color:#3B3C43">Bagaimana course ini untuk kamu?</p>
                <form action="{{ route('customer.review.store') }}" id="review-section" method="POST">
                @csrf
                <div  id="review-area">
                    <div class="rate" style="margin-top:1vw" >
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                    @error('rating')
                    <br>
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <textarea class="normal-text" name="description" placeholder="Masukan review anda disini" id="" style="width:100%;background: #FFFFFF;border: 2px solid #2B6CAA;box-sizing: border-box;border-radius: 5px;margin-top:1vw;padding:0.5vw" rows="4"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <div style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                    <button type="submit" name="action" value="completed_course" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:1vw">Submit</button>
                    </div>
                </div>
                </form>
            </div>
            @endif
        </div>
        <!-- END OF LEFT CONTENT -->
    </div>

@endsection