@extends('layouts/admin-main')

@section('title', 'Venidici Users CMS')

@section('container')

<!-- Main Content -->
<div id="content">

    <x-adminTopbar />   
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

        <!-- Page Heading
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="mb-0 mb-3 text-gray-800">Content Management System</h1>
        </div>
		
		 -->
        <!-- Content Row -->


        <!-- start of table -->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
						<h2 class="mb-0 mb-3 text-gray-800" style="color:white">Content Management System</h2>
						
						
					</div>
                    <!-- START OF TOP SECTION -->
                    <form method="POST" action="">
                    @csrf
                    @method("put")
					<div class="row">
						<div class="col-6">
							<h5 class="mb-0 mb-3 text-gray-800" style="color:white">Home Page Top Section</h5>
						</div>
						<div class="col-6" style="display:flex;justify-content:flex-end">
                            <button type="submit" class="btn btn-primary btn-user" style="padding:1vw 8vw" onclick='return confirm("Are you sure you want to update the content?")'>
                                Update Content
                            </button>						
                        </div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Heading</label>
								<textarea name="title" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title">Anytime, anywhere.
								</textarea>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="">Sub-Heading</label>
								<textarea name="title" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla</textarea>
							</div>
						</div>
						<div class="col-12">
								<p>Banner</p>
                                <img src="/assets/images/client/Home_Page_Banner_2.png" class="img-fluid" style="width:40%" alt="">
                                <!--
								<video style="width:20vw;height:auto;border:4px solid black;border-radius:5px"  controls="false" >
									<source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
									<source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
									Your browser does not support HTML video.
								</video>        
                                -->     
							<div class="form-group" style="margin-top:1vw">
                                <label for="">Click button below to update banner</label> <br>
								<input type="file" >
							</div>
						</div>
                    </div>
                    </form>
                    <!-- END OF TOP SECTION -->
                    <!-- TRUSTED COMPANY SECTIION -->
                    <form method="POST" action="">
                    @csrf
                    @method("put")
                    <div class="row" style="margin-top:8vw" >
						<div class="col-6" >
							<h5 class="mb-0 mb-3 text-gray-800" style="color:white">Trusted Company Section</h5>
						</div>
                        <div class="col-6" style="display:flex;justify-content:flex-end">
                            <button type="submit" class="btn btn-primary btn-user" style="padding:1vw 8vw" onclick='return confirm("Are you sure you want to update the content?")'>
                                Update Content
                            </button>						
                        </div>
                        <div class="col-6">
							<div class="form-group">
								<label for="">Trusted Company Count</label>
                                <input type="text" class="form-control form-control-user" value="10" name="">
								</textarea>
							</div>
						</div>
                        <div class="col-6"></div>
                        <div class="col-3 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col" style="text-align:center">
                                            <img src="/assets/images/client/bca-bank.png" alt="" style="width:14vw;" class="img-fluid">
                                            <!-- START OF UPLOADED IMAGE -->
                                            <input type="file" name="image" accept="image/*" style="margin-top:2vw">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col" style="text-align:center">
                                            <img src="/assets/images/client/bca-bank.png" alt="" style="width:14vw;" class="img-fluid">
                                            <!-- START OF UPLOADED IMAGE -->
                                            <input type="file" name="image" accept="image/*" style="margin-top:2vw">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col" style="text-align:center">
                                            <img src="/assets/images/client/bca-bank.png" alt="" style="width:14vw;" class="img-fluid">
                                            <!-- START OF UPLOADED IMAGE -->
                                            <input type="file" name="image" accept="image/*" style="margin-top:2vw">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col" style="text-align:center">
                                            <img src="/assets/images/client/bca-bank.png" alt="" style="width:14vw;" class="img-fluid">
                                            <!-- START OF UPLOADED IMAGE -->
                                            <input type="file" name="image" accept="image/*" style="margin-top:2vw">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form> 
                    <!-- END OF TRUSTED COMPANY SECTION -->

                    <!-- START OF APA YANG KAMU DAPAT SECTION -->
                    <form method="POST" action="">
                    @csrf
                    @method("put")
                    <div class="row" style="margin-top:8vw" >
						<div class="col-12" >
                            <h5 class="mb-0 mb-3 text-gray-800" style="color:white">Apa Yang Kamu Dapat Section</h5>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control" value="Feature 1">
                                @error('title')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>                        
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                Current image: <br>
                                <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 5vw;" alt=""> 
                                <br>
                                <br>
                                <label for="">Click button below to change image</label>
                                <input type="file" name="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>                        
                        </div>
                        <div class="col-12">
                            <div class="form-group">
								<label for="">Description</label>
								<textarea name="description" class="form-control form-control-user" rows="2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </form>
                        <!-- END OF APA YANG KAMU DAPAT SECTION -->
                    <!-- TESTIMONY SECTION -->
                    <div class="row">
						<div class="col-12" style="margin-top:8vw">
							<h5 class="mb-0 mb-3 text-gray-800" style="color:white">Testimony Section</h5>
						</div>
                        <div class="col-12">
                        
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Thumbnail</th>
                                            <th>Testimony</th>
                                            <th>Rating</th>
                                            <th  class="text-nowrap">Name</th>
                                            <th>Occupancy</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Long Testimony</td>
                                            <td>
                                                <img src="/assets/images/client/testimony-image-dummy.png" style="width:10vw" class="img-fluid" alt="Thumbnail not available."> 
                                            </td>
                                            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate officia ab accusantium ea. Quis reiciendis commodi optio quod, excepturi aperiam, corporis saepe nemo temporibus repudiandae architecto doloribus? Deserunt, id dolor.</td>
                                                <td>4.9</td>
                                            <td>Fernandha Dzaky</td>
                                            <td>Developer</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <div style="padding: 0px 2px;">
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/testimonies/1/update">Update</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Medium Testimony</td>
                                            <td>
                                                <img src="/assets/images/client/testimony-image-dummy.png" style="width:10vw" class="img-fluid" alt="Thumbnail not available."> 
                                            </td>
                                            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate officia ab accusantium ea. Quis reiciendis commodi optio quod, excepturi aperiam, corporis saepe nemo temporibus repudiandae architecto doloribus? Deserunt, id dolor.</td>
                                                <td>4.9</td>
                                            <td>Fernandha Dzaky</td>
                                            <td>Developer</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <div style="padding: 0px 2px;">
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/testimonies/1/update">Update</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Short Testimony (Left)</td>
                                            <td>
                                                <img src="/assets/images/client/testimony-image-dummy.png" style="width:10vw" class="img-fluid" alt="Thumbnail not available."> 
                                            </td>
                                            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate officia ab accusantium ea. Quis reiciendis commodi optio quod, excepturi aperiam, corporis saepe nemo temporibus repudiandae architecto doloribus? Deserunt, id dolor.</td>
                                                <td>4.9</td>
                                            <td>Fernandha Dzaky</td>
                                            <td>Developer</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <div style="padding: 0px 2px;">
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/testimonies/1/update">Update</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Short Testimony (Right)</td>
                                            <td>
                                                <img src="/assets/images/client/testimony-image-dummy.png" style="width:10vw" class="img-fluid" alt="Thumbnail not available."> 
                                            </td>
                                            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate officia ab accusantium ea. Quis reiciendis commodi optio quod, excepturi aperiam, corporis saepe nemo temporibus repudiandae architecto doloribus? Deserunt, id dolor.</td>
                                                <td>4.9</td>
                                            <td>Fernandha Dzaky</td>
                                            <td>Developer</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <div style="padding: 0px 2px;">
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/testimonies/1/update">Update</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
						
                    </div>
                    <!-- END OF TESTIMONY SECTION -->
					<!-- /.container-fluid -->
                </div>
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
