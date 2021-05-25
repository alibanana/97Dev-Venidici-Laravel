@extends('layouts/admin-main')

@section('title', 'Venidici Update Woki')

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
            <h2 class="mb-0 mb-3 text-gray-800">Update Woki</h2>
        </div>
        <div class="d-sm-flex align-items-center mb-2">
            <h5 id="basic-informations-button" class="mb-0 mb-3 course-link course-link-active course-item"  onclick="changeContent(event, 'basic-informations')" style="cursor:pointer">Basic Informations</h5>
            <h5 id="manage-curriculum-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'manage-curriculum')" style="margin-left:1.5vw;cursor:pointer">Manage Curriculum</h5>
            <h5 id="pricing-and-enrollment-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'pricing-enrollment')" style="margin-left:1.5vw;cursor:pointer">Pricing & Enrollment Scenario</h5>
            <h5 id="publish-status-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'publish-status')" style="margin-left:1.5vw;cursor:pointer">Publish Status</h5>
            <h5 id="teacher-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'teacher-page')" style="margin-left:1.5vw;cursor:pointer">Teacher</h5>
            <h5 id="art-supply-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'art-supply-page')" style="margin-left:1.5vw;cursor:pointer">Art Supply</h5>
        </div>
        
        <!-- Content Row -->

        <!-- START OF BASIC INFORMATION -->
        <div class="course-content" id="basic-informations">
            <form id="online-course-update-form" action="/admin/woki/1/update" method="POST" enctype="multipart/form-data">
                @csrf  
                @method('put')         
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Thumbnail</label> <br>
                            <img src="/assets/images/seeder/course-business.jpg" alt="Thumbnail not available.." style="width:14vw;" class="img-fluid">
                            <br>
                            <br>
                            Click button below to update image
                            <input type="file" name="thumbnail" aria-describedby=""> 
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
                                value="Title" required> 
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
                            <textarea name="subtitle" id="" rows="3" class="form-control" required>Subtitle</textarea> 
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
                                    <option value="1" selected>woki category</option>
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
                                    value="https://www.youtube.com/embed/DSJlhjZNVpg" required>
                            @error('preview_video_link')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Zoom Link</label>
                            <input type="text" name="zoom_link" class="form-control form-control-user" value=""
                                    id="exampleInputPassword" placeholder="https://meet.google.com/hza-vmyh-zoo" required> 
                            @error('zoom_link')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Date Start</label>
                            <input type="date" name="date" class="form-control form-control-user" value=""
                                    id="exampleInputPassword" placeholder="dd.mm.yyyy" required> 
                            @error('date')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Event Start</label>
                            <input type="time" name="start_time" class="form-control form-control-user" value=""
                                    id="exampleInputPassword" placeholder="11:00" required> 
                            @error('start_time')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Duration (in minutes)</label>
                            <input type="text" name="duration" class="form-control form-control-user" value=""
                                    id="exampleInputPassword" placeholder="120" required> 
                            @error('duration')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Event End</label>
                            <input type="time" name="end_time" class="form-control form-control-user" value=""
                                    id="exampleInputPassword" placeholder="12:00" required> 
                            @error('end_time')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" rows="5"  class="form-control form-control-user" required>woki description</textarea>
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
                            <div class="row" id="requirement_duplicator1">
                                <div class="col-md-12">
                                    <div class="form-group" style="display:flex">
                                        <input type="text" name="requirements[]" class="form-control form-control-user" placeholder="Enter Student Requirement" value="requirement" required>
                                        <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add_requirement" onlick="duplicateRequirement()" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 
                    </div>

                    <div class="col-6" style="margin-top:3vw">
                        <label for="">Apa yang akan dipelajari? <span style="color: orange">(At least one element must be present!)</span></label>
                        @error('features')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        {{-- Element to be duplicated --}}
                        <div id="learn_duplicator_wrapper">
                            <div class="row" id="learn_duplicator" style="display:none">
                                <div class="col-md-12">
                                    <div class="form-group d-flex">
                                        <input type="text" class="form-control form-control-user" placeholder="e.g. Bisamelawak dengan benar dan tidak garing">
                                        <button type="button" onClick="removeDiv(this, 'learn_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="learn_duplicator1">
                                <div class="col-md-12">
                                    <div class="form-group d-flex">
                                        <input type="text" name="features[]" class="form-control form-control-user" id="" placeholder="e.g. Bisa melawak dengan benar dan tidak garing" value="features" required>
                                        <button type="button" onClick="removeDiv(this, 'learn_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add_learn" onlick="duplicateLearn()" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 

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
                                            <option value="1">hashtag</option>
                                        </select>
                                        <button type="button" onClick="removeDiv(this, 'hashtag_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="hashtag_duplicator1">
                                <div class="col-md-12">
                                    <div class="form-group" style="display:flex">
                                        <select name="hashtags[]" class="form-control form-control-user" required>
                                                <option value="1" selected>hashtag</option>
                                        </select>
                                        <button type="button" onClick="removeDiv(this, 'hashtag_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add_hashtag" onlick="duplicateHashtag()" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 

                    </div>
                    <div class="col-12" style="padding:2vw 1vw">
                        <div style="display:flex;justify-content:flex-end">
                            <button type="submit"  class="btn btn-primary btn-user p-3">Update Woki</button>
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
                                        <input style="width:50% !important;" type="text" value="Materi">
                                        <button type="submit"  class="btn btn-primary btn-info">Update Section</button>    
                                    </div>
                                    <div>
                                        <button type="submit"  class="btn btn-primary btn-danger">Delete Section</button>

                                    </div>
                                </div>                        
                            </div>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item" style="display:flex;justify-content:space-between;align-items:center">
                                Introduction to Woki
                                    <div>
                                        <!--<a href="#" data-toggle="modal" data-target="#addContentModal"  class="btn btn-primary btn-primary">
                                        Add Content
                                        </a>-->
                                        <a href="/admin/woki/create-video/1" class="btn btn-primary btn-primary">
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
                                        <input style="width:50% !important" type="text" value="QnA">
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
            <form action="/admin/woki/1/update" method="POST">
            @csrf
            @method('put') 
                <div class="row" style="margin-top:2vw">
                    <div class="col-6">
                        <div class="form-group">
                            <h5 for="">Enrollment Scenario</h5>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="enrollment_status" value="Open" id="enrollment_status" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Open Enrollment
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="enrollment_status" value="Close" id="enrollment_status" checked>
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
                                <input class="form-check-input" type="radio" onclick="disableInput()" name="is_free" value="1" id="pricing_options" checked >
                                <label class="form-check-label" for="pricing_options">
                                    Free
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" onclick="enableInput()" name="is_free" value="0" id="pricing_options" checked >
                                <label class="form-check-label" for="pricing_options">One-Time Purchase (Rp.) <span style="color: orange">(Min: Rp 10,000)</span></label> <br>
                                <label class="form-check-label pt-1" for="pricing_options">Woki Only</label>
                                <input type="number" name="price" style="margin-top:0.5vw" id="price-input" class="form-control form-control-user"
                                    id="phone" aria-describedby="" value="" min="10000"
                                    placeholder="e.g. 10000" >
                                <label class="form-check-label pt-2" for="pricing_options">Woki + Artkit</label> <br>
                                <label class="form-check-label" for="pricing_options" style="color:orange">*Insert 0 if there is no artkit</label>
                                <input type="number" name="price" style="margin-top:0.5vw" id="price-input-2" class="form-control form-control-user"
                                    id="phone" aria-describedby="" value="" min="15000"
                                    placeholder="e.g. 15000" >
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
                            <button type="submit" class="btn btn-primary btn-user p-3">Update Pricing</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
        <!-- END OF PRICE AND ENROLLMENT -->

        <!-- START OF PUBLISH STATUS -->
        <div class="course-content" id="publish-status" style="display:none">
            <form action="/admin/woki/1/update" method="POST">
            @csrf  
            @method('put') 
                <div class="row" style="margin-top:2vw">
                    <div class="col-6">
                        <div class="form-group">
                            <h5 for="">Publish Status</h5>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="publish_status" value="Draft" id="flexRadioDefault1" checked >
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Draft <br>
                                    Students cannot purchase or enroll in this woki course. For students that are already enrolled, this woki course will not appear on their Student Dashboard.
                                </label>
                            </div>
                            <div class="form-check" style="margin-top:1vw">
                                <input class="form-check-input" type="radio" name="publish_status" value="Published" id="flexRadioDefault2" checked>
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
                            <form action="/admin/woki/1/update" method="GET">
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
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td style="text-align:center" class="text-nowrap">
                                        <img src="/assets/images/seeder/fake-testimony-dummy-1.png" class="img-fluid" style="width:5vw" alt="Teacher's profile not available..">
                                        <p style="color:black;font-weight:bold;margin-bottom:0px;margin-top:1vw">name</p>
                                    </td>
                                    <td>description</td>  
                                    <td>
                                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                            <form action="" method="post">
                                                @csrf
                                                @method('put')
                                                <div style="padding: 0px 2px">
                                                    <input type="hidden" name="teacher_id" value="1" hidden>
                                                    <button class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" onclick="return confirm('Are you sure you want to add this teacher to the woki?')">Select Teacher</button>
                                                </div>
                                            </form> 
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF Teacher-->
        <!-- START OF Teacher-->
        <div class="course-content" id="art-supply-page" style="display:none">
            <div class="row mt-2 mb-3">
                <div class="col-sm-12 col-md-8">
                    <div id="dataTable_filter" class="dataTables_filter">
                        <label class="w-100">Search:
                            <form action="/admin/woki/1/update" method="GET">
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
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td style="text-align:center" class="text-nowrap">
                                        <img src="/assets/images/seeder/category-tech.png" class="img-fluid" style="width:5vw" alt="Teacher's profile not available..">
                                        <p style="color:black;font-weight:bold;margin-bottom:0px;margin-top:1vw">Art Brush</p>
                                    </td>
                                    <td>description</td>  
                                    <td>
                                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                            <form action="" method="post">
                                                @csrf
                                                @method('put')
                                                <div style="padding: 0px 2px">
                                                    <input type="hidden" name="teacher_id" value="1" hidden>
                                                    <button class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" onclick="return confirm('Are you sure you want to add this art supply to woki?')">Select Art Supply</button>
                                                </div>
                                            </form> 
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF Teacher-->
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
    document.getElementById("price-input-2").disabled = true;
    console.log('disabled')
    }
    function enableInput() {
    document.getElementById("price-input").disabled = false;
    document.getElementById("price-input-2").disabled = false;
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
    @elseif (Session::get('page-option') == 'pricing-and-enrollment')
        <script>document.getElementById('pricing-and-enrollment-button').click()</script>
    @elseif (Session::get('page-option') == 'publish-status')
        <script>document.getElementById('publish-status-button').click()</script>
    @elseif (Session::get('page-option') == 'teacher')
        <script>document.getElementById('teacher-button').click()</script>
    @endif
@endif
@endsection