@extends('layouts/admin-main')

@section('title', 'Venidici Update Online Course')

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
            <h2 class="mb-0 mb-3 text-gray-800">Update Online Course</h2>
        </div>
        <div class="d-sm-flex align-items-center mb-2">
            <h5 class="mb-0 mb-3 course-link course-link-active course-item"  onclick="changeContent(event, 'basic-informations')"  style="cursor:pointer">Basic Informations</h5>
            <h5 class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'manage-curriculum')" style="margin-left:1.5vw;cursor:pointer">Manage Curriculum</h5>
            <h5 class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'pricing-enrollment')" style="margin-left:1.5vw;cursor:pointer">Pricing & Enrollment Scenario</h5>
            <h5 class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'publish-status')" style="margin-left:1.5vw;cursor:pointer">Publish Status</h5>
            <h5 class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'course-assesment')" style="margin-left:1.5vw;cursor:pointer">Course Assesment</h5>
        </div>
        
        <!-- Content Row -->
       

        <!-- START OF BASIC INFORMATION -->
        <div class="course-content" id="basic-informations">
            <form action="/admin/online-courses" method="POST" enctype="multipart/form-data">
                @csrf  
                @method('put')         
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="name" class="form-control form-control-user"
                                id="phone" aria-describedby=""
                                placeholder="Enter couse title" value="Emotional Intelligence"> 
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Thumbnail</label> <br>
                            <img src="/assets/images/client/our-programs-card-dummy.png" alt="" style="width:14vw;" class="img-fluid">
                            <br>
                            <br>
                            Click button below to update image
                            <input type="file" name="thumbnail"
                                aria-describedby=""> 
                            @error('thumbnail')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Subtitle</label>
                            <input type="text" name="date" class="form-control form-control-user"
                                id="phone" aria-describedby=""
                                placeholder="Enter course subtitle" value="Recorded Webinar"> 
                            @error('date')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Category</label> <br>
                            <select name="category" id="" class="form-control form-control-user">
                                <option value="1">Tech</option>
                                <option value="2">Math</option>
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                        <p> <span> <a href="/admin/online-courses/course-categories" target="_blank">Click here</a> </span> to add new category</p>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" rows="5"  class="form-control form-control-user">Pesatnya perkembangan teknologi saat ini sudah banyak menggeser manusia dari berbagai pekerjaan. Di masa yang akan datang, kemampuan dalam me-manage manusialah yang diprediksi akan terus eksis dan justru meningkat dalam permintaan. Era baru pekerjaan itu kini hampir di depan mata, sudah siapkah kamu?</textarea>
                            @error('descriptoin')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                    </div>
                    <!--
                    <div class="col-12">
                        <p>Visibility Level</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility_level" id="visibility_level">
                            <label class="form-check-label" for="visibility_level">
                                <span style="font-weight:bold">Public</span> <br>
                                Course is share to every registered teachers in platform.   
                            </label>
                        </div>
                        <div class="form-check" style="margin-top:1.5vw">
                            <input class="form-check-input" type="radio" name="visibility_level" id="visibility_level" checked>
                            <label class="form-check-label" for="visibility_level">
                                <span style="font-weight:bold">Private</span> <br>
                                Course is unshared with others teacher. If you want current teacher able to manage this course, course access must be granted explicitly to each teacher by inviting them.
                            </label>
                        </div>
                    </div>
                    -->
                    <div class="col-6" style="margin-top:3vw">
                        <label for="">Student's Requirements</label>
                        <div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="requirement[]" class="form-control form-control-user" id="" placeholder="Enter Student Requirement" value="A Windows/Linux/MacOS based computer or laptop">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="row" id="requirement_duplicator">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="requirement[]" class="form-control form-control-user" id="" placeholder="Enter Student Requirement" value="A stable internet connection">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add_requirement" onlick="duplicateRequirement()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more requirement</button> 

                    </div>
                    <div class="col-6" style="margin-top:3vw">
                        <label for="">What student get on this course</label>
                        <div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="advantage[]" class="form-control form-control-user" id="" placeholder="Enter Student Requirement">
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        <button type="button" id="add_advantage" onlick="duplicateAdvantage()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more advantage</button> 

                    </div>
                    <div class="col-12" style="padding:2vw 1vw">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit"  class="btn btn-primary btn-user p-3">Update Course</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
        <!-- END OF BASIC INFORMATION-->

        <!-- START OF MANAGE CURRICULUM -->
        <div class="course-content" id="manage-curriculum" style="display:none">
            <form action="/admin/online-courses" method="POST" enctype="multipart/form-data">
            @csrf  
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Section</label>
                            <input type="text" name="name" class="form-control form-control-user"
                                id="phone" aria-describedby=""
                                placeholder="Enter couse section" > 
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6" style="padding:2vw 1vw">
                        <div style="display:flex;justify-content:flex-start">
                            <button type="submit"  class="btn btn-primary btn-user">Add Section</button>
                        </div>
                    </div>
                </div>
            </form>
                <!-- START OF ONE MATERI -->
                <div class="row" style="margin-top:2vw">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display:flex;justify-content:space-between;align-items:center">
                                    <div>
                                        <input style="font-family:bold" style="width:50% !important" type="text" value="Materi">
                                        <button type="submit"  class="btn btn-primary btn-info">Update Section</button>    
                                    </div>
                                    <div>
                                        <button type="submit"  class="btn btn-primary btn-danger">Delete Section</button>

                                    </div>
                                </div>                        
                            </div>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item" style="display:flex;justify-content:space-between;align-items:center">
                                Introduction to Course
                                    <div>
                                        <!--<a href="#" data-toggle="modal" data-target="#addContentModal"  class="btn btn-primary btn-primary">
                                        Add Content
                                        </a>-->
                                        <a href="/admin/online-courses/create-video/1" class="btn btn-primary btn-primary">
                                        Add Content
                                        </a>

                                        <button type="submit"  class="btn btn-primary btn-danger">Delete Content</button>
                                    </div>
                                </div>     
                                <div class="list-group-item" style="display:flex;justify-content:space-between;align-items:center">
                                    <input type="text" placeholder="Enter new lecture title" style="width:80%">
                                    <div>
                                        <button type="submit"  class="btn btn-primary btn-info">Create Lecture</button>
                                    </div>
                                </div>     
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END OF ONE MATERI -->
                <!-- START OF ONE MATERI -->
                <div class="row" style="margin-top:2vw">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display:flex;justify-content:space-between;align-items:center">
                                    <div>
                                        <input style="font-family:bold" style="width:50% !important" type="text" value="QnA">
                                        <button type="submit"  class="btn btn-primary btn-info">Update Section</button>    
                                    </div>
                                    <div>
                                        <button type="submit"  class="btn btn-primary btn-danger">Delete Section</button>

                                    </div>
                                </div>                        
                            </div>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item" style="display:flex;justify-content:space-between;align-items:center">
                                QnA Video Session #1 
                                    <div>
                                        <a href="#" data-toggle="modal" data-target="#addContentModal"  class="btn btn-primary btn-primary">
                                        Add Content
                                        </a>
                                        <button type="submit"  class="btn btn-primary btn-danger">Delete Content</button>
                                    </div>
                                </div>     
                                <div class="list-group-item" style="display:flex;justify-content:space-between;align-items:center">
                                    <input type="text" placeholder="Enter new lecture title" style="width:80%">
                                    <div>
                                        <button type="submit"  class="btn btn-primary btn-info">Create Lecture</button>
                                    </div>
                                </div>     
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END OF ONE MATERI -->
        </div>
        <!-- END OF MANAGE CURRICULUM -->

        <!-- START OF PRICE AND ENROLLMENT -->
        <div class="course-content" id="pricing-enrollment" style="display:none">
            <form action="/admin/online-courses" method="POST" enctype="multipart/form-data">
            @csrf  
            @method('put') 
                <div class="row" style="margin-top:2vw">
                    <div class="col-6">
                        <div class="form-group">
                            <h5 for="">Enrollment Scenario</h5>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="enrollment_scenario" id="enrollment_scenario" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Open Enrollment
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="enrollment_scenario" id="enrollment_scenario">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Close Enrollment
                                </label>
                            </div>
                            @error('name')
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
                                <input class="form-check-input" type="radio"  onclick="disableInput()" name="pricing_options" id="pricing_options" checked>
                                <label class="form-check-label" for="pricing_options">
                                    Free
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" onclick="enableInput()" name="pricing_options" id="pricing_options">
                                <label class="form-check-label" for="pricing_options"  >
                                    One-Time Purchase
                                </label>
                                <input type="text" name="name" style="margin-top:0.5vw" id="price-input" class="form-control form-control-user"
                                    id="phone" aria-describedby=""
                                    placeholder="Enter couse title" disabled> 

                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-12">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit" class="btn btn-primary btn-user p-3">Update Pricing</button>
                        </div>

                    </div>
                </div>
            </form>
            
        </div>
        <!-- END OF PRICE AND ENROLLMENT -->

        <!-- START OF PUBLISH STATUS -->
        <div class="course-content" id="publish-status" style="display:none">
            <form action="/admin/online-courses" method="POST" enctype="multipart/form-data">
            @csrf  
            @method('put') 
                <div class="row" style="margin-top:2vw">
                    <div class="col-6">
                        <div class="form-group">
                            <h5 for="">Enrollment Scenario</h5>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Draft <br>
                                    Students cannot purchase or enroll in this course. For students that are already enrolled, this course will not appear on their Student Dashboard.
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Published <br>
                                    Students can purchase, enroll in, and access the content of this course. For students that are enrolled, this course will appear on their Student Dashboard.                            </label>
                            </div>
                            @error('name')
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

        <!-- START OF COURSE ASSESMENT-->
        <div class="course-content" id="course-assesment" style="display:none">
            <form action="/admin/online-courses" method="POST" enctype="multipart/form-data">
            @csrf  
            @method('put') 
                <div class="row" style="margin-top:2vw;align-items:center;display:flex">
                    <div class="col-6">
                        <div class="form-group">
                            <h5 for="">Select Course Assesment</h5>
                            <select name="assesment" id="" class="form-control">
                                <option value="0" selected>No Assesment</option>
                                <option value="1">Quiz of Business Case Room</option>
                            </select>
                            @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit" class="btn btn-primary btn-user p-3">Update Course Assesment</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <!-- END OF COURSE ASSESMENT-->
    </div>
    <!-- /.container-fluid -->
</div>

<script>
document.getElementById('add_requirement').onclick = duplicateRequirement;
var i = 0;
var original = document.getElementById('requirement_duplicator');
console.log(original);
function duplicateRequirement() {
    console.log('requirement clicked')
    if(confirm("Are you sure, you want to add more item?")){
        var clone = original.cloneNode(true); // "deep" clone
        $(clone).find("input[type=text], textarea").removeAttr("checked").val('');
        clone.id = "requirement_duplicator" + ++i; // there can only be one element with an ID
        original.parentNode.appendChild(clone);
    } else {

    }
}
</script>
<script>
document.getElementById('add_advantage').onclick = duplicateAdvantage;

var i = 0;
var original2 = document.getElementById('advantage_duplicator');

function duplicateAdvantage() {
    if(confirm("Are you sure, you want to add more item?")){
        var clone = original2.cloneNode(true); // "deep" clone
        $(clone).find("input[type=text], textarea").removeAttr("checked").val('');
        clone.id = "advantage_duplicator" + ++i; // there can only be one element with an ID
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