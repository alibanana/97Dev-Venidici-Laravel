<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="Description" content="Anytime anywhere, Learn on your schedule from any device ">

    <!-- INDEX CSS -->
    <link rel="stylesheet"  type="text/css"  href="/css/index.css">

    <!-- CSS -->

    <!--load all fontawesome -->
    <link href="/fontawesome/css/all.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- web icon    -->
    <link rel="shortcut icon" type="image/jpg" href="/assets/images/client/icon-transparent.png"/>
  
    <!-- wow js -->
    <link rel="stylesheet" href="/WOW-master/css/libs/animate.css">

    <title>Venidici Assesmnet</title>

  </head>
  <body style="padding-right:0px !important">

    <form id="retryAssessmentForm" action="{{ route('online-course-assessment.reset-user-assessment', $assessment_pivot->assessment_id) }}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="redirectURL" value="{{ route('online-course-assessment.show', $course->id) }}" hidden>
    </form>

    <div class="row m-0 page-container" style="padding-top:10vw;padding-bottom:10vw">
        <!-- START OF LEFT CONTENT -->
        <div class="col-6">
            <p class="medium-heading" style="font-family: Rubik Medium;margin-bottom:0.5vw;color:#2B6CAA">Good work!</p>
            <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0.5vw;color:#3B3C43">Kamu telah menyelesaikan course ini</p>
            <img src="/assets/images/client/Completed_Icon.svg" style="margin-top:2vw;width:23vw" class="img-fluid" alt="">
                
            <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0.5vw;color:#3B3C43;margin-top:2vw">Nilai Assessment</p>
            <div class="progress" style="height:3vw;background-color:rgba(43, 108, 170, 0.25);border-radius:10px">
                @if (is_null($assessment_pivot->score))
                    <div class="progress-bar normal-text" role="progressbar" style="font-family:Rubik Medium;width: 100%;background-color: rgba(43, 108, 170, 0.25);" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Assessment not completed yet..</div>
                @elseif($assessment_pivot->score == 0)
                    <div class="progress-bar normal-text" role="progressbar" style="font-family:Rubik Medium;width: 100%;background-color: rgba(43, 108, 170, 0.25);" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0/100</div>
                @else
                    <div class="progress-bar normal-text" role="progressbar" style="font-family:Rubik Medium;width: {{ $assessment_pivot->score }}%;background-color:#2B6CAA;" aria-valuenow="{{ $assessment_pivot->score }}" aria-valuemin="0" aria-valuemax="100">{{ $assessment_pivot->score }}/100</div>
                @endif
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:3vw">
                <button class="normal-text  btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;">Unduh Sertifikat</button>
                <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">Atau</p>
                <a onclick="document.getElementById('retryAssessmentForm').submit(); return false;" class="normal-text blue-link-underline" style="font-family: Rubik Medium;color:#2B6CAA;text-decoration:none">Ulang Assessment</a>
            </div>
        </div>
        <!-- END OF LEFT CONTENT -->

        <!-- START OF RIGHT CONTENT -->
        <div class="col-6" style="display:flex;justify-content:flex-end">
            <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.11);border-radius: 10px;width:35vw;height:35vw;padding:4vw">
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
                    <input type="hidden" name="course_id" value="">
                    <div style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                    <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:1vw">Submit</button>
                    </div>
                </div>
                </form>
            </div>

        </div>
        <!-- END OF LEFT CONTENT -->
    </div>


    <!-- FOOTER -->
    <!-- END OF FOOTER -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP 5-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>
    
    <!-- BOOTSTRAP 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
 
  </body>
</html>