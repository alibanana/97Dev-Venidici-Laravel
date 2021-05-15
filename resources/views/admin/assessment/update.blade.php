@extends('layouts/admin-main')

@section('title', 'Venidici Update Assesments')

@section('container')

<!-- Main Content -->
<div id="content">

    <x-AdminTopbar />   
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (session()->has('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 18px">
                {{ session()->get('message') }}            
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 mb-3 text-gray-800">Update Assessment ({{ $assessment->title }})</h2>
        </div>
        <div class="d-sm-flex align-items-center mb-2">
            <h5 id="basic-informations-button" class="mb-0 mb-3 course-link course-link-active course-item"  onclick="changeContent(event, 'basic-informations')"  style="cursor:pointer">Basic Informations</h5>
            <h5 id="questions-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'questions')" style="margin-left:1.5vw;cursor:pointer">Questions</h5>
        </div>
        
        <!-- Content Row -->

        <!-- START OF BASIC INFORMATION -->
        <div class="course-content" id="basic-informations">
            <form action="{{ route('admin.assessments.update-basic-info', $assessment->id) }}" method="POST">
            @csrf
            @method('put')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control form-control-user"
                                id="phone" aria-describedby="" value="{{ old('title', $assessment->title) }}"
                                placeholder="Enter assesment title" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Duration (minutes)</label>
                            <input type="text" name="duration" class="form-control form-control-user"
                                id="phone" aria-describedby="" value="{{ old('description', $assessment->duration) }}"
                                placeholder="e.g. 10" min="1" required> 
                            @error('duration')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Description</label> <br>
                            <textarea name="description" id="" class="form-control" rows="5" required>{{ old('description', $assessment->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="">Assessment's Requirements <span style="color: orange">(At least one element must be present!)</span></label>
                        @error('requirements')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div id="requirement_duplicator_wrapper">
                            {{-- Element to be duplicated --}}
                            <div class="row" id="requirement_duplicator" style="display:none">
                                <div class="col-md-12">
                                    <div class="form-group d-flex"> 
                                        <input type="text" class="form-control form-control-user" placeholder="Enter Student Requirement">
                                        <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                            @foreach ($assessment->assessmentRequirements as $requirement)
                                <div class="row" id="requirement_duplicator{{ $loop->iteration }}">
                                    <div class="col-md-12">
                                        <div class="form-group d-flex"> 
                                            <input type="text" name="requirements[]" class="form-control form-control-user" placeholder="Enter Student Requirement" value="{{ $requirement->requirement }}" required>
                                            <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add_requirement" onlick="duplicateRequirement()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more requirement</button> 
                    </div>

                    <div class="col-12" style="padding:2vw 1vw">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit" class="btn btn-primary btn-user p-3">Update Assessment</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- END OF BASIC INFORMATION-->

        <!-- START OF QUESTIONS -->
        <div class="course-content" id="questions" style="display:none">
            <form action="{{ route('admin.assessments.store-question', $assessment->id) }}", method="POST">
            @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Question</label>
                            <textarea name="question" class="form-control" id="" rows="4"></textarea>
                            @error('question')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="">Answers</label>
                        <div>
                            {{-- Element to be duplicated --}}
                            <div class="row" id="answer_duplicator" style="display:none">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="" placeholder="Enter Answer">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <select id="" class="form-control">
                                        <option value="1">Correct Answer</option>
                                        <option value="0">False Answer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="answer_duplicator1">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="text" name="answers[1][answer]" class="form-control form-control-user" id="" placeholder="Enter Answer" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <select name="answers[1][is_correct]" id="" class="form-control" required>
                                        <option value="1">Correct Answer</option>
                                        <option value="0">False Answer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add_answer" onlick="duplicateAnswer()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more answer</button> 
                    </div>
                    <div class="col-12" style="margin-top:2vw">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit" class="btn btn-primary btn-user p-3">Add New Question</button>
                        </div>
                    </div>
                </div>
            </form>         
            <!-- START OF ONE MATERI -->
            <hr>
            <h3 style="margin-top:2vw">Question List</h3>

            @foreach ($assessment->assessmentQuestions as $question)
                <form id="update_question_{{ $question->id }}" action="{{ route('admin.assessments.update-question', [
                    'assessment_id' => $assessment->id,
                    'question_id' => $question->id
                    ]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">                
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Question #{{ $loop->iteration }}</label>
                            <textarea name="question_{{ $question->id }}" class="form-control" id="" rows="4">{{ $question->question }}</textarea>
                            @error('question_' . $question->id)
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="">Answers</label>
                        @foreach ($question->assessmentQuestionAnswers as $answer)
                            <input type="hidden" name="answers[{{ $loop->iteration }}][id]" value="{{ $answer->id }}" hidden>
                            <div>
                                <div class="row" id="answer_duplicator">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input type="text" name="answers[{{ $loop->iteration }}][answer]" class="form-control form-control-user" id="" placeholder="Enter Answer" value="{{ $answer->answer }}">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <select name="answers[{{ $loop->iteration }}][is_correct]" class="form-control">
                                            <option value="1" @if($answer->is_correct) selected @endif>Correct Answer</option>
                                            <option value="0" @if(!$answer->is_correct) selected @endif>False Answer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--<button type="button" id="add_answer" onlick="duplicateAnswer()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more answer</button> -->
                    </div>
                    </form>
                    <div class="col-12" style="padding:2vw 0vw">
                        <div style="display:flex;justify-content:flex-end">
                            <form id="delete_question_{{ $question->id }}" action="{{ route('admin.assessments.destroy-question', [
                                'assessment_id' => $assessment->id,
                                'question_id' => $question->id
                            ]) }}" method="POST">
                            @csrf
                            @method('delete')
                                <div style="padding: 0px 2px">
                                    <button form="delete_question_{{ $question->id }}" class="d-sm-inline-block btn btn-danger shadow-sm p-3" style="margin-right:1vw" type="submit" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                                </div>
                            </form> 
                            <button type="submit"  class="btn btn-primary btn-user p-3" form="update_question_{{ $question->id }}">Update Question</button>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        <!-- END OF QUESTIONS -->

    </div>
    <!-- /.container-fluid -->
</div>

<script>
document.getElementById('add_requirement').onclick = duplicateHashtag;
var i = 1; var original3 = document.getElementById('requirement_duplicator');
function duplicateHashtag() {
    var clone = original3.cloneNode(true); // "deep" clone
    $(clone).find("input").attr("name", "requirements[]");
    $(clone).find("input").attr("required", "");
    clone.style.display = "block";
    clone.id = "requirement_duplicator" + ++i; // there can only be one element with an ID
    original3.parentNode.appendChild(clone);
}
</script>
<script>
function removeDiv(elem, wrapper_id){
    var parent = $(elem).parent('div').parent('div').parent('div');
    if (document.getElementById(wrapper_id).childElementCount > 2) {
        parent.remove();
    } else {
        alert("At least one element must be present!");
    }
}
</script>
<script>
    document.getElementById('add_answer').onclick = duplicateAnswer;
    var i = 2;
    var original2 = document.getElementById('answer_duplicator');
    function duplicateAnswer() {
        var clone = original2.cloneNode(true); // "deep" clone
        $(clone).find("input").attr("name", "answers[" + i + "][answer]");
        $(clone).find("input").attr("required", '');
        $(clone).find("select").attr("name", "answers[" + i + "][is_correct]");
        $(clone).find("select").attr("required", '');
        clone.style.display = "flex";
        clone.id = "answer_duplicator" + i++; // there can only be one element with an ID
        original2.parentNode.appendChild(clone);
    }
</script>
<script>
    function changeContent(evt, categoryName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("course-content")
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("course-item");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("course-link-active", "course-link");
        }
        document.getElementById(categoryName).style.display = "block";
        evt.currentTarget.className += " course-link-active";
    }
</script>
<script>
    function disableInput() {
        document.getElementById("price-input").disabled = true;
        console.log('disabled')
    }
    function enableInput() {
        document.getElementById("price-input").disabled = false;
        console.log('enabled')
    }
</script>
@if (session()->has('flag'))
    @if (session('flag') == 'basic-informations')
        <script>
            document.getElementById('basic-informations-button').click();
        </script>
    @elseif (session('flag') == 'questions')
        <script>
            document.getElementById('questions-button').click();
        </script>
    @endif
@endif
@endsection
