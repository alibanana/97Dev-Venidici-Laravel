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
    <!-- Modal Loading -->
    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="text-align:center;height:20vw">
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Mohon tunggu sebentar...</p>
                    <img src="/assets/images/client/loading.gif" style="width:4vw;height:4vw;object-fit:cover;border-radius:10px;margin-top:5vw" class="img-fluid" alt="Loading..">

                </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL Loading -->
    <input type="hidden" value="{{$assessment->duration}}" name="duration" id="duration_input" hidden>
    <!-- START OF NAVBAR -->
    <div class="navbar-floating">
        <img src="/assets/images/client/icon-transparent.png" style="width: 3.5vw;" class="img-fluid" alt="">
        <div style="display:flex;align-items:center">
            <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;margin-right:3vw">Sisa Waktu <span id="time" style="color:#2B6CAA;margin-left:0.5vw">{{ $assessment->duration }} minutes</span></p>
            <button type="submit" onclick="openLoading()" form="updateOnlineCourseAssessmentForm" class="normal-text btn-blue-bordered" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Submit</button>
        </div>
    </div>
    <!-- END OF NAVBAR -->

    <div class="row m-0 page-container" style="padding-top:11vw;padding-bottom:10vw">
        <div class="col-10">
            <form id="updateOnlineCourseAssessmentForm" action="{{ route('online-course-assessment.update', $assessment->id) }}" method="POST">
                @csrf
                @method('put')
                @foreach ($assessment->assessmentQuestions as $question)
                    @php $question_index = $loop->index; @endphp
                    <!-- START OF ONE QUESTION -->
                    <div @if(!$loop->first) style="margin-top:4vw" @endif >
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0.5vw;margin-right:3vw;color:#2B6CAA">No. {{$loop->iteration}}</p>
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-right:3vw;color:#3B3C43">{{$question->question}}</p>
                        @foreach($question->assessmentQuestionAnswers as $answer)
                            <!-- START OF ONE ANSWERS -->
                            <div class="form-check normal-text" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="questions[{{ $question->id }}]" id="flexRadioDefault{{ $question_index * 4 + $loop->iteration }}" value="{{ $answer->id }}">
                                <label class="form-check-label" style="font-family: Rubik Regular" for="flexRadioDefault{{ $question_index * 4 + $loop->iteration }}">
                                    {{ $answer->answer }}
                                </label>
                            </div>
                            <!-- END OF ONE ANSWERS -->
                        @endforeach
                    </div>
                    <!-- END OF ONE QUESTION -->
                @endforeach
            </form>
        </div>
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
    <script>
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;

        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;
            
            if (timer >= 0) {
                --timer

                var url = "{{ route('online-course-assessment.updateAssessmentTimer', $assessment->id) }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    cache: false,
                    data:{
                        _token:'{{ csrf_token() }}',
                        _method:'put',
                        duration: document.getElementById("duration_input").value
                    },
                    success: function(dataResult){
                        console.log(dataResult)
                        dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                    }
                });
            } else
                document.getElementById('updateOnlineCourseAssessmentForm').submit();

            document.getElementById("duration_input").value = timer+1;
        }, 1000);
    }
    </script>
    <script>

    window.onload = function () {
        var display = document.querySelector('#time');
        startTimer({{ ($assessment->duration * 60) - $assessment_pivot->time_taken }}, display);
    };
    </script>
    <script>
      function openLoading() {
          console.log('test');
          $('#loadingModal').modal({backdrop: 'static', keyboard: false});
          $('#loadingModal').modal('show');
      }
    </script>
  </body>
</html>