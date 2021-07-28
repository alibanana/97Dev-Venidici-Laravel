@extends('layouts/admin-main')

@section('title', 'Venidici Update Bootcamp')

@section('container')

<!-- Modal Loading -->
<div class="modal fade" id="bootcampFeatureModal" tabindex="-1" role="dialog" aria-labelledby="bootcampFeatureModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.bootcamp-feature.update')}}">
            @csrf
            {{ method_field('PUT') }}
            <div class="modal-body">
                <div class="form-group mt-2">
					<input type="text" name="title" required class="form-control form-control-user"
						id="bootcap_feature_title" placeholder="Insert feature title">
					@error('title')
						<span class="invalid-feedback" role="alert" style="display: block !important;">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
                <div class="form-group mt-2">
					<textarea name="feature" id="bootcap_feature_description" class="form-control"></textarea>
					@error('feature')
						<span class="invalid-feedback" role="alert" style="display: block !important;">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
            </div>
            <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input type="hidden" name="bootcamp_feature_id" id="bootcamp_feature_id">
				<button class="btn btn-primary" type="submit">Confirm</button>   
			</div>
            </form>
        </div>
    </div>
</div>
<!-- END OF MODAL Loading -->

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
        <div class="mb-2" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap">
            <h6 id="basic-informations-button" class="mb-0 mb-3 course-link course-link-active course-item"  onclick="changeContent(event, 'basic-informations')" style="cursor:pointer">Basic Informations</h6>
            <!-- <h6 id="manage-curriculum-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'manage-curriculum')" style="margin-left:1.5vw;cursor:pointer">Manage Curriculum</h6> -->
            <h6 id="feature-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'bootcamp-feature')" style="cursor:pointer;">Feature</h6>
            <h6 id="about-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'bootcamp-descriptions')" style="cursor:pointer;">About</h6>
            <h6 id="pricing-and-enrollment-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'pricing-enrollment')" style="cursor:pointer;">Pricing & Enrollment Scenario</h6>
            <h6 id="publish-status-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'publish-status')" style="cursor:pointer;">Publish Status</h6>
            <h6 id="teacher-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'teacher-page')" style="cursor:pointer;">Teacher</h6>
            <h6 id="schedule-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'schedule-page')" style="cursor:pointer;">Schedule</h6>
            <h6 id="benefit-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'benefit-page')" style="cursor:pointer;">Benefit</h6>
            <h6 id="candidate-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'candidate-page')" style="cursor:pointer;">Candidate</h6>
            <h6 id="career-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'future-career-page')" style="cursor:pointer;">Future Careers</h6>
            <h6 id="partner-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'hiring-partner-page')" style="cursor:pointer;">Hiring Partners</h6>
            <h6 id="batch-page-button" class="mb-0 mb-3 course-link course-item" onclick="changeContent(event, 'batch-page')" style="cursor:pointer;">Batch</h6>
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
                            <label for="">Zoom link</label>
                            <input type="text" name="meeting_link" class="form-control form-control-user" value="{{ old('meeting_link', $course->bootcampCourseDetail->meeting_link) }}"
                                    placeholder="e.g. https://meet.google.com/pdq-umxk-fuv"> 
                            @error('meeting_link')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror               
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Syllabus</label> <br>
                            <!-- if there is no attachment, change the text below to "no attachment" -->
                            @if ($course->bootcampCourseDetail->syllabus)
                                <div style="display:flex;align-items:center">
                                    <p style="margin-bottom:0px;padding-right:2vw"> <span> <a href="{{ asset($course->bootcampCourseDetail->syllabus) }}" target="_blank">click here</a> </span> to view current attachment</p>
                                    <div style="padding: 0px 2px">
                                        <button form="removeAttachmentForm" class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to remove this Syllabus?')">Remove Syllabus</button>
                                    </div>
                                </div>
                            @else
                                <p>No attachment available.</p>
                            @endif
                            <input type="file" name="syllabus" class="" value="{{ old('syllabus', $course->bootcampCourseDetail->syllabus) }}"
                                    > 
                            @error('meeting_link')
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
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Date Start</label>
                            @php
                            $date_start = explode(" ", $course->bootcampCourseDetail->date_start);
                            @endphp
                            <input type="datetime-local" name="date_start" class="form-control" value="{{ old('date_start', $date_start[0].'T'.$date_start[1]) }}">
                            @error('date_start')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Date End</label>
                            @php
                            $date_end = explode(" ", $course->bootcampCourseDetail->date_end);
                            @endphp
                            <input type="datetime-local" name="date_end" class="form-control" value="{{ old('date_end', $date_end[0].'T'.$date_end[1]) }}" >
                            @error('date_end')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Free Trial Date End</label>
                            @php
                            $trial_date_end = explode(" ", $course->bootcampCourseDetail->trial_date_end);
                            @endphp
                            <input type="datetime-local" name="trial_date_end" class="form-control" value="{{ old('trial_date_end', $trial_date_end[0].'T'.$trial_date_end[1]) }}">
                            @error('trial_date_end')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-6"></div>
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


        <!-- START OF FEATURE -->
        <div class="course-content" id="bootcamp-feature" style="display:none">
            <form action="{{route('admin.bootcamp-feature.store', $course->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <input type="text" class="form-control" name="title" placeholder="Insert Title">
                    @error('title')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div>
                <div class="col-12 mt-2">
                    <textarea name="feature" rows="5" class="form-control" placeholder="Insert Description"></textarea>
                    @error('feature')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                <div class="col-12 mt-2">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit"  class="btn btn-primary btn-user p-3">Create New Feature</button>
                    </div>
                </div>
            </div>
            </form>

            <div class="row" style="margin-top:2vw">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($course->courseFeatures as $feature)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$feature->title}}</td>
                                    <td>
                                        {{$feature->feature}}
                                    </td>
                                    <td>
                                        <div style="padding: 0px 2px;" class="text-nowrap d-flex">
                                            <a onclick="passBootcampFeature('{{$feature->title}}','{{$feature->feature}}','{{$feature->id}}')" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" data-toggle="modal" data-target="#bootcampFeatureModal">
                                                Update
                                            </a>
                                            <form action="{{route('admin.bootcamp-feature.destroy', $feature->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this bootcamp feature?')">Delete</button>
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
        <!-- END OF FEATURE -->
        
        <!-- START OF BOOTCAMP DESCRIPTIONS -->
        <div class="course-content" id="bootcamp-descriptions" style="display:none" >
            <form action="{{route('admin.bootcamp-about.store', $course->id)}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <input type="file"  accept=".jpg,,jpeg,.png" name="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" name="title" placeholder="Insert Title">
                    @error('title')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                </div>
                <div class="col-12 mt-2">
                    <textarea name="description" rows="5" class="form-control" placeholder="Insert Description"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror  
                </div>
                <div class="col-12 mt-2">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit"  class="btn btn-primary btn-user p-3">Create New About</button>
                    </div>
                </div>
            </div>
            </form>

            <div class="row" style="margin-top:2vw">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($course->bootcampDescriptions as $about)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img src="{{ asset($about->image) }}" alt="Thumbnail not available.." style="width:14vw;" class="img-fluid">
                                    </td>
                                    <td>{{$about->title}}</td>
                                    <td>{{$about->description}}</td>
                                    <td>
                                        <div style="padding: 0px 2px;" class="text-nowrap d-flex">
                                            <a class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" href="{{route('admin.bootcamp.about-edit', $about->id)}}">
                                                Update
                                            </a>
                                            <form action="{{route('admin.bootcamp-about.destroy', $about->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this bootcamp item?')">Delete</button>
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
        <!-- END OF BOOTCAMP DESCRIPTIONS -->


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
                            <h5 for="">Full Registration Price</h5>
                            <input class="form-control" type="text" name="bootcamp_full_price" value="{{ old('price', $course->bootcampCourseDetail->bootcamp_full_price) }}">
                            @error('bootcamp_full_price')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                        <div class="form-group">
                            <h5 for="">Free Trial Registration Price</h5>
                            <input class="form-control" type="text" name="bootcamp_trial_price" value="{{ old('price', $course->bootcampCourseDetail->bootcamp_trial_price) }}">
                            @error('bootcamp_trial_price')
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
                                    <th>Company Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align:center" class="text-nowrap">
                                            <img src="{{ asset($teacher->image) }}" class="img-fluid" style="width:5vw" alt="Teacher's profile not available..">
                                            <p style="color:black;font-weight:bold;margin-bottom:0px;margin-top:1vw">{{ $teacher->name }} <br> <span style="font-weight: italic !important;">{{$teacher->occupancy}}</span>​</p>
                                        </td>
                                        <td>{{ $teacher->description }}</td>  
                                        <td>
                                            <img src="{{ asset($teacher->company_logo) }}" alt="Company logo not available.." style="width:10vw;" class="img-fluid">
                                        </td>
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

        <!-- START BENEFITS-->
        <div class="course-content" id="benefit-page" style="display:none">
            <form action="{{route('admin.bootcamp-benefit.store',$course->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control form-control-user"
                            placeholder="Enter benefit title"  required> 
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" id="" cols="30" rows="4" placeholder="Enter benefit description"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12 pt-2">
                   <div style="display:flex;justify-content:flex-end">
                    <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" >Create New Benefit</button>

                   </div>
                </div>
            </div>
            </form>

            <div class="card shadow mb-4 mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($course->bootcampBenefits as $benefit)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <form method="POST" action="{{route('admin.bootcamp-benefit.update', $benefit->id)}}">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>
                                            <input type="text" name="title" value="{{$benefit->title}}" class="form-control">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="description" cols="30" rows="4" >{{$benefit->description}}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </td>
                                        <td>
                                            <div style="padding: 0px 2px;" class="text-nowrap d-flex">
                                                    <div style="padding: 0px 2px">
                                                        <button class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit">Update</button>
                                                    </div>
                                                </form> 
                                                <form action="{{route('admin.bootcamp-benefit.destroy', $benefit->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <div style="padding: 0px 2px">
                                                        <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this bootcamp benefit?')">Delete</button>
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
        <!-- END BENEFITS-->
        <!-- START OF CANDIDATES-->
        <div class="course-content" id="candidate-page" style="display:none">
            <form action="{{route('admin.bootcamp-candidate.store', $course->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control form-control-user"
                            placeholder="Enter candidate title"  required> 
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" id="" cols="30" rows="4" placeholder="Enter candidate description"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12 pt-2">
                   <div style="display:flex;justify-content:flex-end">
                    <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" >Create New Candidate</button>

                   </div>
                </div>
            </div>
            </form>

            <div class="card shadow mb-4 mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($course->bootcampCandidates as $candidate)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <form method="POST" action="{{route('admin.bootcamp-candidate.update', $candidate->id)}}">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>
                                            <input type="text" name="title" value="{{$candidate->title}}" class="form-control">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror  
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="description" cols="30" rows="4" >{{$candidate->description}}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror  
                                        </td>
                                        <td>
                                            <div style="padding: 0px 2px;" class="text-nowrap d-flex">
                                                    <div style="padding: 0px 2px">
                                                        <button class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit">Update</button>
                                                    </div>
                                                </form> 
                                                <form action="{{route('admin.bootcamp-candidate.destroy', $candidate->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <div style="padding: 0px 2px">
                                                        <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this bootcamp future candidate?')">Delete</button>
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
        <!-- END OF CANDIDATES-->

        <!-- START OF FUTURE CAREERS-->
        <div class="course-content" id="future-career-page" style="display:none">
            <form action="{{route('admin.bootcamp-future-career.store', $course->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Thumbnail</label> <br>
                        <input type="file"  accept=".jpg,,jpeg,.png" name="thumbnail" class="" required> 
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
                            placeholder="Enter berkarir jadi apa title"  required> 
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" id="" cols="30" rows="4" placeholder="Enter berkarir jadi apa description"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12 pt-2">
                   <div style="display:flex;justify-content:flex-end">
                    <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" >Create New Future Career</button>

                   </div>
                </div>
            </div>
            </form>

            <div class="card shadow mb-4 mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($course->bootcampFutureCareers as $career)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <form method="POST" action="{{route('admin.bootcamp-future-career.update', $career->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>
                                            <div class="form-group">
                                                <label for="">Thumbnail</label> <br>
                                                <img src="{{ asset($career->thumbnail) }}" alt="Thumbnail not available.." style="width:10vw;" class="img-fluid">
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
                                        </td>
                                        <td>
                                            <input type="text" name="title" value="{{$career->title}}" class="form-control">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </td>
                                        <td>
                                            <textarea class="form-control" name="description" cols="30" rows="4" >{{$career->description}}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </td>
                                        <td>
                                            <div style="padding: 0px 2px;" class="text-nowrap d-flex">
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit">Update</button>
                                                </div>
                                            </form> 
                                            <form action="{{route('admin.bootcamp-future-career.destroy', $career->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this bootcamp future candidate?')">Delete</button>
                                                </div>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF FUTURE CAREERS-->

        <!-- START OF HIRING PARTNERS-->
        <div class="course-content" id="hiring-partner-page" style="display:none">
            <form action="{{route('admin.bootcamp-hiring-partner.store', $course->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Image</label> <br>
                        <input type="file" accept=".jpg,,jpeg,.png" name="image" class="" required> 
                        @error('image')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                   <div style="display:flex;justify-content:flex-end">
                    <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" >Create New Hiring Partner</button>

                   </div>
                </div>
            </div>
            </form>

            <div class="card shadow mb-4 mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Partner</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($course->bootcampHiringPartners as $partner)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <form method="POST" action="{{route('admin.bootcamp-hiring-partner.update', $partner->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>
                                            <div class="form-group">
                                                <label for="">Company Image</label> <br>
                                                <img src="{{ asset($partner->image) }}" alt="Image not available.." style="width:10vw;" class="img-fluid">
                                                <br>
                                                <br>
                                                Click button below to update image <br>
                                                <input type="file" name="image" aria-describedby="" accept=".jpg,,jpeg,.png"> 
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror               
                                            </div>
                                        </td>
                                        <td>
                                            <div style="padding: 0px 2px;" class="text-nowrap d-flex">
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit">Update</button>
                                                </div>
                                            </form> 
                                            <form action="{{route('admin.bootcamp-hiring-partner.destroy', $partner->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this bootcamp hiring partner?')">Delete</button>
                                                </div>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF HIRING PARTNERS-->

        <!-- START OF Schedule-->
        <div class="course-content" id="schedule-page" style="display:none">
            <form action="{{route('admin.bootcampschedule.store', $course->id)}}" method="post">
            @csrf
            <div class="row mt-2 mb-3">
                <div class="col-12">
                    <h5>Create New Schedule</h5>
                </div>
                <div class="col-6">
                    <label for="">Date Start</label>
                    <input type="date" name="date_start" class="form-control">
                    @error('date_start')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                <div class="col-6">
                    <label for="">Date End</label>
                    <input type="date" name="date_end" class="form-control">
                    @error('date_end')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                <!-- <div class="col-4"><input type="time" class="form-control"></div> -->
                <div class="col-6 pt-3">
                    <label for="">Schedule Title</label>
                    <input type="text" name="title" placeholder="Insert Title" class="form-control">
                    @error('title')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>
                <div class="col-6 pt-3">
                    <label for="">Schedule Sub-Title</label>
                    <input type="text" name="subtitle" placeholder="Insert Sub Title" class="form-control">
                    @error('subtitle')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror 
                </div>

                <div class="col-6 pt-3">
                    <label for="">Detail <span style="color: orange">(At least one element must be present!)</span></label>
                    @error('schedule_details')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="weekly_schedule_detail_duplicator_wrapper">
                        {{-- Element to be duplicated --}}
                        <div class="row" id="weekly_schedule_duplicator" style="display:none">
                            <div class="col-md-12">
                                <div class="form-group" style="display:flex">
                                    <input type="text" class="form-control form-control-user" placeholder="e.g. Pirate funneling">
                                    <button type="button" onClick="removeDiv(this, 'weekly_schedule_detail_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="weekly_schedule_duplicator1">
                            <div class="col-md-12">
                                <div class="form-group" style="display:flex">
                                    <input type="text" name="schedule_details[]" class="form-control form-control-user" placeholder="e.g. Pirate funneling" required>
                                    <button type="button" onClick="removeDiv(this, 'weekly_schedule_detail_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add_schedule_detail" onlick="duplicateSchedule()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 
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
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Event Dates</th>
                                    <th>Detail</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($course->bootcampSchedules as $schedule)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$schedule->title}}</td>
                                    <td>{{$schedule->subtitle}}</td>
                                    <td>{{$schedule->date_start}} - {{$schedule->date_end}}</td>
                                    <td>
                                        @foreach($schedule->bootcampScheduleDetails as $detail)
                                        <p>- {{$detail->description}}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div style="padding: 0px 2px;" class="text-nowrap d-flex">
                                            <a class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" href="{{route('admin.bootcampschedule.edit',$schedule->id)}}" >
                                                Update
                                            </a>
                                            <form action="{{route('admin.bootcampschedule.destroy', $schedule->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this bootcamp schedule?')">Delete</button>
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


        <!-- START OF BATCH-->
        <div class="course-content" id="batch-page" style="display:none">
            <form action="{{route('admin.bootcamp-batch.store', $course->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Date</label> <br>
                        <input type="date" accept=".jpg,,jpeg,.png" name="date" class="form-control" required> 
                        @error('image')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                   <div style="display:flex;justify-content:flex-end">
                    <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" >Create New Batch</button>

                   </div>
                </div>
            </div>
            </form>

            <div class="card shadow mb-4 mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($course->bootcampBatches as $batch)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <form method="POST" action="{{route('admin.bootcamp-batch.update', $batch->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>
                                            <div class="form-group">
                                                <input type="date" name="date" value="{{$batch->date}}" aria-describedby=""> 
                                                @error('date')
                                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror               
                                            </div>
                                        </td>
                                        <td>
                                            <div style="padding: 0px 2px;" class="text-nowrap d-flex">
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit">Update</button>
                                                </div>
                                            </form> 
                                            <form action="{{route('admin.bootcamp-batch.destroy', $batch->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div style="padding: 0px 2px">
                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this bootcamp batch?')">Delete</button>
                                                </div>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF BATCH-->

        <form id="removeAttachmentForm" action="{{ route('admin.bootcmap.remove-syllabus', $course->id) }}" method="post">
            @csrf
            @method('delete')
        </form> 
        
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
<script>
    function passBootcampFeature(title,description,bootcamp_feature_id) {
		document.getElementById("bootcap_feature_title").value = title;
		document.getElementById("bootcap_feature_description").value = description;
		document.getElementById("bootcamp_feature_id").value = bootcamp_feature_id;
    }
</script>

<script>
document.getElementById('add_schedule_detail').onclick = duplicateSchedule;
var i = 1; var original2 = document.getElementById('weekly_schedule_duplicator');
function duplicateSchedule() {
    var clone = original2.cloneNode(true); // "deep" clone
    $(clone).find("input").attr("name","schedule_details[]");
    $(clone).find("input").attr("required", "");
    clone.style.display = "block";
    clone.id = "weekly_schedule_duplicator" + ++i; // there can only be one element with an ID
    original2.parentNode.appendChild(clone);
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
    @elseif (Session::get('page-option') == 'bootcamp-feature-page')
        <script>document.getElementById('feature-page-button').click()</script>
    @elseif (Session::get('page-option') == 'bootcamp-about-page')
        <script>document.getElementById('about-page-button').click()</script>
    @elseif (Session::get('page-option') == 'benefit-page')
        <script>document.getElementById('benefit-page-button').click()</script>
    @elseif (Session::get('page-option') == 'candidate-page')
        <script>document.getElementById('candidate-page-button').click()</script>
    @elseif (Session::get('page-option') == 'future-career-page')
        <script>document.getElementById('career-page-button').click()</script>
    @elseif (Session::get('page-option') == 'hiring-partner-page')
        <script>document.getElementById('partner-page-button').click()</script>
    @elseif (Session::get('page-option') == 'batch-page')
        <script>document.getElementById('batch-page-button').click()</script>
    @endif
@endif
@endsection
