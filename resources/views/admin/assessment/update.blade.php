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
            <h5 class="mb-0 mb-3 course-link course-link-active course-item"  onclick="changeContent(event, 'basic-informations')"  style="cursor:pointer">Basic Informations</h5>
            <h5 class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'questions')" style="margin-left:1.5vw;cursor:pointer">Questions</h5>
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
            <div class="row">                
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Question</label>
                        <textarea name="question" class="form-control" id="" rows="4"></textarea>
                        @error('name')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <label for="">Answers</label>
                    <div>
                        <div class="row" id="answer_duplicator">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="answer[]" class="form-control form-control-user" id="" placeholder="Enter Answer">
                                </div>
                            </div>
                            <div class="col-2">
                                <select name="" id="" class="form-control">
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
                        <button type="submit" href="/admin/online-courses/assesments/create" class="btn btn-primary btn-user p-3">Add New Question</button>


                    </div>
                </div>
            </div>
            <!-- START OF ONE MATERI -->
            <hr>
            <h3 style="margin-top:2vw">Question List</h3>

            <!-- START OF ONE QUESTION -->
            <div class="row">                
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Question #1</label>
                        <textarea name="question" class="form-control" id="" rows="4">Hal yang harus dilakukan sewaktu "Structure Problem" di 7-Step Problem Solving Provess adalah</textarea>
                        @error('name')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <label for="">Answers</label>
                    <div>
                        <div class="row" id="answer_duplicator">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="answer[]" class="form-control form-control-user" id="" placeholder="Enter Answer" value="Debate and agree as a team on definition of the core problem">
                                </div>
                            </div>
                            <div class="col-2">
                                <select name="" id="" class="form-control">
                                    <option value="1" selected>Correct Answer</option>
                                    <option value="0">False Answer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row" id="answer_duplicator">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="answer[]" class="form-control form-control-user" id="" placeholder="Enter Answer" value="Focus on most influencing Issues">
                                </div>
                            </div>
                            <div class="col-2">
                                <select name="" id="" class="form-control">
                                    <option value="1">Correct Answer</option>
                                    <option value="0" selected>False Answer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--<button type="button" id="add_answer" onlick="duplicateAnswer()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more answer</button> -->

                    <div class="col-12" style="padding:2vw 0vw">
                        <div style="display:flex;justify-content:flex-end">
                            <form action="" method="post">
                                @csrf
                                @method('delete')
                                <div style="padding: 0px 2px">
                                    <button class="d-sm-inline-block btn btn-danger shadow-sm p-3" style="margin-right:1vw" type="submit" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                                </div>
                            </form> 
                            <button type="submit"  class="btn btn-primary btn-user p-3">Update Question</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- END OF ONE QUESTION -->
            <!-- START OF ONE QUESTION -->
            <div class="row">                
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Question #2</label>
                        <textarea name="question" class="form-control" id="" rows="4">Hal yang harus dilakukan sewaktu "Structure Problem" di 7-Step Problem Solving Provess adalah</textarea>
                        @error('name')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <label for="">Answers</label>
                    <div>
                        <div class="row" id="answer_duplicator">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="answer[]" class="form-control form-control-user" id="" placeholder="Enter Answer" value="Debate and agree as a team on definition of the core problem">
                                </div>
                            </div>
                            <div class="col-2">
                                <select name="" id="" class="form-control">
                                    <option value="1" selected>Correct Answer</option>
                                    <option value="0">False Answer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row" id="answer_duplicator">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="answer[]" class="form-control form-control-user" id="" placeholder="Enter Answer" value="Focus on most influencing Issues">
                                </div>
                            </div>
                            <div class="col-2">
                                <select name="" id="" class="form-control">
                                    <option value="1">Correct Answer</option>
                                    <option value="0" selected>False Answer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--<button type="button" id="add_answer" onlick="duplicateAnswer()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more answer</button> -->

                    <div class="col-12" style="padding:2vw 0vw">
                        <div style="display:flex;justify-content:flex-end">
                            <form action="" method="post">
                                @csrf
                                @method('delete')
                                <div style="padding: 0px 2px">
                                    <button class="d-sm-inline-block btn btn-danger shadow-sm p-3" style="margin-right:1vw" type="submit" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                                </div>
                            </form> 
                            <button type="submit"  class="btn btn-primary btn-user p-3">Update Question</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- END OF ONE QUESTION -->
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
    var i = 0;
    var original2 = document.getElementById('answer_duplicator');
    function duplicateAnswer() {
        console.log('requirement clicked')
        if(confirm("Are you sure, you want to add more item?")){
            var clone = original2.cloneNode(true); // "deep" clone
            $(clone).find("input[type=text], textarea").removeAttr("checked").val('');
            clone.id = "answer_duplicator" + ++i; // there can only be one element with an ID
            original2.parentNode.appendChild(clone);
        } else {

        }
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
@endsection
