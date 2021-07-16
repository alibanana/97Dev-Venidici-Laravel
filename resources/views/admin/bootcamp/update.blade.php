@extends('layouts/admin-main')

@section('title', 'Venidici Update Bootcamp')

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
            <h2 class="mb-0 mb-3 text-gray-800">Update Bootcamp</h2>
        </div>
        <div class="d-sm-flex align-items-center mb-2">
            <h5 id="basic-informations-button" class="mb-0 mb-3 course-link course-link-active course-item"  onclick="changeContent(event, 'basic-informations')" style="cursor:pointer">Basic Informations</h5>
            <!-- <h5 id="manage-curriculum-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'manage-curriculum')" style="margin-left:1.5vw;cursor:pointer">Manage Curriculum</h5> -->
            <h5 id="pricing-and-enrollment-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'pricing-enrollment')" style="margin-left:1.5vw;cursor:pointer">Pricing & Enrollment Scenario</h5>
            <h5 id="publish-status-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'publish-status')" style="margin-left:1.5vw;cursor:pointer">Publish Status</h5>
            <h5 id="teacher-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'teacher-page')" style="margin-left:1.5vw;cursor:pointer">Teacher</h5>
            <h5 id="schedule-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'schedule-page')" style="margin-left:1.5vw;cursor:pointer">Schedule</h5>
        </div>
        
        <!-- Content Row -->

        <!-- START OF BASIC INFORMATION -->
        <div class="course-content" id="basic-informations">
            <form id="online-course-update-form" action="{{ route('admin.bootcamp.update-basic-info', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf  
                @method('put')         
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Thumbnail</label> <br>
                            <img src="{{ asset($course->thumbnail) }}" alt="Thumbnail not available.." style="width:14vw;" class="img-fluid">
                            <br>
                            <br>
                            Click button below to update image
                            <input type="file" name="thumbnail" aria-describedby="" accept=".jpg,,jpeg,.png"> 
                            @error('thumbnail')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control form-control-user"
                                id="phone" aria-describedby="" placeholder="Enter couse title"
                                value="{{ old('title', $course->title) }}" required> 
                            @error('title')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Subtitle</label>
                            <textarea name="subtitle" id="" rows="3" class="form-control" required>{{ old('subtitle', $course->subtitle) }}</textarea> 
                            @error('subtitle')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Category</label> <br>
                            <select name="course_category_id" id="" class="form-control form-control-user" required>
                                @foreach ($course_categories as $category)
                                    @if ($category->id == $course->course_category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->category }} </option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('course_category_id')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                        <p> <span> <a href="{{ route('admin.course-categories.index') }}" target="_blank">Click here</a> </span> to add new category</p>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Embed youtube link for preview  (src only)</label>
                            <input type="text" name="preview_video_link" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="e.g. https://www.youtube.com/embed/DSJlhjZNVpg"
                                    value="{{ old('preview_video_link', $course->preview_video) }}" required>
                            @error('preview_video_link')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- <div class="col-6">
                        <div class="form-group">
                            <label for="">Bootcamp Date</label>
                            <input type="date" name="event_date" class="form-control form-control-user" value="21-12-2021"
                                    id="exampleInputPassword" placeholder="dd.mm.yyyy" required> 
                            @error('event_date')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div> -->
                    <!-- <div class="col-6">
                        <div class="form-group">
                            <label for="">Bootcamp Start</label>
                            <input type="time" name="start_time" class="form-control form-control-user" value="21-12-2021"
                                    id="exampleInputPassword" placeholder="11:00" required> 
                            @error('start_time')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div> -->
                    <!-- <div class="col-6">
                        <div class="form-group">
                            <label for="">Bootcamp End</label>
                            <input type="time" name="end_time" class="form-control form-control-user" value="21-12-2021"
                                    id="exampleInputPassword" placeholder="12:00" required> 
                            @error('end_time')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div> -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" rows="5"  class="form-control form-control-user" required>{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror             
                        </div>
                    </div>
                    <div class="col-6" style="margin-top:3vw">
                        <label for="">Persyaratan <span style="color: orange">(At least one element must be present!)</span></label>
                        @error('requirements')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        {{-- Element to be duplicated --}}
                        <div id="requirement_duplicator_wrapper">
                            <div class="row" id="requirement_duplicator" style="display:none">
                                <div class="col-md-12">
                                    <div class="form-group" style="display:flex">
                                        <input type="text" class="form-control form-control-user" placeholder="Enter Student Requirement">
                                        <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                            @foreach ($course->courseRequirements as $requirement)
                                <div class="row" id="requirement_duplicator{{ $loop->iteration }}">
                                    <div class="col-md-12">
                                        <div class="form-group" style="display:flex">
                                            <input type="text" name="requirements[]" class="form-control form-control-user" placeholder="Enter Student Requirement" value="{{ $requirement->requirement }}" required>
                                            <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add_requirement" onlick="duplicateRequirement()" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 
                    </div>

                    <div class="col-6" style="margin-top:3vw">
                        <label for="">Hashtag <span style="color: orange">(At least one element must be present!)</span></label>
                        <p> <span> <a href="/admin/hashtags" target="_blank">Click here</a> </span> to add new hashtag</p>
                        @error('hashtags')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div id="hashtag_duplicator_wrapper">
                            {{-- Element to be duplicated --}}
                            <div class="row" id="hashtag_duplicator" style="display:none">
                                <div class="col-md-12">
                                    <div class="form-group" style="display:flex">
                                        <select class="form-control form-control-user">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->hashtag }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" onClick="removeDiv(this, 'hashtag_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                            @foreach ($course->hashtags as $hashtag)
                                <div class="row" id="hashtag_duplicator{{ $loop->iteration }}">
                                    <div class="col-md-12">
                                        <div class="form-group" style="display:flex">
                                            <select name="hashtags[]" class="form-control form-control-user" required>
                                                @foreach ($tags as $tag)
                                                    @if ($hashtag->hashtag == $tag->hashtag)
                                                        <option value="{{ $tag->id }}" selected>{{ $tag->hashtag }}</option>
                                                    @else
                                                        <option value="{{ $tag->id }}">{{ $tag->hashtag }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <button type="button" onClick="removeDiv(this, 'hashtag_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add_hashtag" onlick="duplicateHashtag()" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 

                    </div>

                    <div class="col-12" style="padding:2vw 1vw">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit"  class="btn btn-primary btn-user p-3">Update Bootcamp</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- END OF BASIC INFORMATION-->


        <!-- START OF PRICE AND ENROLLMENT -->
        <div class="course-content" id="pricing-enrollment" style="display:none">
            <form action="{{ route('admin.bootcamp.update-pricing-enrollment', $course->id) }}" method="POST">
            @csrf
            @method('put') 
                <div class="row" style="margin-top:2vw">
                    <div class="col-6">
                        <div class="form-group">
                            <h5 for="">Enrollment Scenario</h5>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="enrollment_status" value="Open" id="enrollment_status" @if($course->enrollment_status == 'Open') checked @endif>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Open Enrollment
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="enrollment_status" value="Close" id="enrollment_status" @if($course->enrollment_status == 'Close') checked @endif>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Close Enrollment
                                </label>
                            </div>
                            @error('enrollment_status')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <h5 for="">Pricing Options</h5>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" onclick="disableInput()" name="is_free" value="1" id="pricing_options" 
                                    @if($course->price == 0) checked @endif>
                                <label class="form-check-label" for="pricing_options">
                                    Free
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" onclick="enableInput()" name="is_free" value="0" id="pricing_options" 
                                @if($course->price != 0) checked @endif    >
                                <label class="form-check-label" for="pricing_options">One-Time Purchase (Rp.)</label> <br>
                                <input type="number" name="price" style="margin-top:0.5vw" id="price-input" class="form-control form-control-user"
                                    id="phone" aria-describedby="" value="{{ old('price', $course->price) }}" placeholder="e.g. 10000" >
                            </div>
                            @error('price')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit" class="btn btn-primary btn-user p-3">Update Pricing & Enrollment</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
        <!-- END OF PRICE AND ENROLLMENT -->

        <!-- START OF PUBLISH STATUS -->
        <div class="course-content" id="publish-status" style="display:none">
            <form action="{{ route('admin.bootcamp.update-publish-status', $course->id) }}" method="POST">
            @csrf
            @method('put')
                <div class="row" style="margin-top:2vw">
                    <div class="col-6">
                        <div class="form-group">
                            <h5 for="">Publish Status</h5>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="publish_status" value="Draft" id="flexRadioDefault1" @if($course->publish_status == 'Draft') checked @endif>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Draft <br>
                                    Students cannot purchase or enroll in this woki course. For students that are already enrolled, this woki course will not appear on their Student Dashboard.
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="publish_status" value="Published" id="flexRadioDefault2" @if($course->publish_status == 'Published') checked @endif>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Published <br>
                                    Students can purchase, enroll in, and access the content of this woki course. For students that are enrolled, this woki course will appear on their Student Dashboard.                            </label>
                            </div>
                            @error('publish_status')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-12">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit" class="btn btn-primary btn-user p-3">Update Publish Status</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <!-- END OF PUBLISH STATUS -->


        <!-- START OF Teacher-->
        <div class="course-content" id="teacher-page" style="display:none">
            <div class="row mt-2 mb-3">
                <div class="col-sm-12 col-md-8">
                    <div id="dataTable_filter" class="dataTables_filter">
                        <label class="w-100">Search:
                            <form action="{{ route('admin.bootcamp.edit', $course->id) }}" method="GET">
                                <input name="search_teacher" value="{{ Request::get('search_teacher') }}" type="search" class="form-control form-control-sm w-100" aria-controls="dataTable">
                                <input type="submit" style="visibility: hidden;" hidden/>
                            </form>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Teacher</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align:center" class="text-nowrap">
                                            <img src="{{ asset($teacher->image) }}" class="img-fluid" style="width:5vw" alt="Teacher's profile not available..">
                                            <p style="color:black;font-weight:bold;margin-bottom:0px;margin-top:1vw">{{ $teacher->name }}</p>
                                        </td>
                                        <td>{{ $teacher->description }}</td>  
                                        <td>
                                            @if ($teacher->courses()->where('course_id', $course->id)->first())
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <form action="{{ route('admin.bootcamp.detach-teacher', $course->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div style="padding: 0px 2px">
                                                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}" hidden>
                                                            <button class="d-sm-inline-block btn btn-secondary shadow-sm text-nowrap" type="submit" onclick="return confirm('Are you sure you want to remove this teacher from the course?')">Un-select Teacher</button>
                                                        </div>
                                                    </form> 
                                                </div>
                                            @else
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <form action="{{ route('admin.bootcamp.attach-teacher', $course->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div style="padding: 0px 2px">
                                                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}" hidden>
                                                            <button class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" onclick="return confirm('Are you sure you want to add this teacher to the course?')">Select Teacher</button>
                                                        </div>
                                                    </form> 
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF Teacher-->

        <!-- START OF Schedule-->
        <div class="course-content" id="schedule-page" style="display:none">
            <form action="{{route('admin.bootcampschedule.store', $course->id)}}" method="post">
            @csrf
            <div class="row mt-2 mb-3">
                <div class="col-12">
                    <p>Create New Schedule</p>
                </div>
               <div class="col-6">
                   <input type="datetime-local" name="date_time" class="form-control">
                </div>
               <!-- <div class="col-4"><input type="time" class="form-control"></div> -->
               <div class="col-6">
                   <input type="text" name="title" placeholder="title" class="form-control">
                </div>
               <div class="col-12 pt-3">
                   <textarea name="detail" id="" class="form-control" rows="3" placeholder="insert description"></textarea>
               </div>
               <div class="col-12 pt-3">
                   <div style="display:flex;justify-content:flex-end">
                    <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" >Create New Schedule</button>

                   </div>
               </div>
            </div>                
            </form>
            
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date Time</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                <tr>
                                    <td>
                                    {{ $loop->iteration }}
                                    </td>
                                    @php
                                        $datetime_default  = date('c', strtotime($schedule->date_time));
                                        $datetime = explode("+", $datetime_default);
                                    @endphp
                                    
                                    <form action="{{route('admin.bootcampschedule.update',$schedule->id)}}" method="post">
                                    <td><input type="datetime-local" name="date_time" value="{{ $datetime[0]}}" class="form-control"></td>
                                    <!-- <td><input type="time" class="form-control"></td> -->
                                    <td><input type="text" value="{{$schedule->title}}" name="title" class="form-control"></td>
                                    <td><textarea name="detail" id="" rows="3" class="form-control">{{$schedule->detail}}</textarea></td>  
                                    <td>
                                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                @csrf
                                                @method('put')
                                                
                                                <div style="padding: 0px 2px">
                                                    <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" onclick="return confirm('Are you sure you want to update this schedule?')">Update</button>
                                                </div>
                                            </form> 
                                        </div>
                                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                            <form action="{{route('admin.bootcampschedule.destroy',$course->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF Schedule-->
        
    </div>
    <!-- /.container-fluid -->
</div>

<script>
document.getElementById('add_requirement').onclick = duplicateRequirement;
var i = 0; var original = document.getElementById('requirement_duplicator');
function duplicateRequirement() {
    var clone = original.cloneNode(true); // "deep" clone
    $(clone).find("input").attr("name", "requirements[]");
    $(clone).find("input").attr("required", "");
    clone.style.display = "block";
    clone.id = "requirement_duplicator" + ++i; // there can only be one element with an ID
    original.parentNode.appendChild(clone);
}
</script>
<script>
document.getElementById('add_learn').onclick = duplicateLearn;
var i = 0; var original2 = document.getElementById('learn_duplicator');
function duplicateLearn() {
    var clone = original2.cloneNode(true); // "deep" clone
    $(clone).find("input").attr("name", "features[]");
    $(clone).find("input").attr("required", "");
    clone.style.display = "block";
    clone.id = "learn_duplicator" + ++i; // there can only be one element with an ID
    original2.parentNode.appendChild(clone);
}
</script>
<script>
document.getElementById('add_hashtag').onclick = duplicateHashtag;
var i = 0; var original3 = document.getElementById('hashtag_duplicator');
function duplicateHashtag() {
    var clone = original3.cloneNode(true); // "deep" clone
    $(clone).find("select").attr("name", "hashtags[]");
    $(clone).find("select").attr("required", "");
    clone.style.display = "block";
    clone.id = "hashtag_duplicator" + ++i; // there can only be one element with an ID
    original3.parentNode.appendChild(clone);
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
@if (Session::has('page-option'))
    @if (Session::get('page-option') == 'basic-informations')
        <script>document.getElementById('basic-information-button').click()</script>
    @elseif (Session::get('page-option') == 'manage-curriculum')
        <script>document.getElementById('manage-curriculum-button').click()</script>
    @elseif (Session::get('page-option') == 'pricing-and-enrollment')
        <script>document.getElementById('pricing-and-enrollment-button').click()</script>
    @elseif (Session::get('page-option') == 'publish-status')
        <script>document.getElementById('publish-status-button').click()</script>
    @elseif (Session::get('page-option') == 'teacher')
        <script>document.getElementById('teacher-button').click()</script>
    @elseif (Session::get('page-option') == 'schedule-page')
        <script>document.getElementById('schedule-page-button').click()</script>
    @endif
@endif
@endsection
