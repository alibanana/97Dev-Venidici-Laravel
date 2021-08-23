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

					<!-- Home Page Top Section -->
                    <form method="POST" action="{{ route('admin.cms.homepage.top-section.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-0 mb-3 text-gray-800" style="color:white">Home Page Top Section</h5>
                            </div>
                            <div class="col-6" style="display:flex;justify-content:flex-end">
                                <button type="submit" class="btn btn-primary btn-user" style="padding:1vw 8vw" onclick='return confirm("Are you sure you want to update the Top-Section of the Homepage?")'>
                                    Update Content
                                </button>						
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Heading</label>
                                    <textarea name="heading" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title" required>{{ $configs['cms.homepage.top-section.heading']->value }}</textarea>
                                    @error('heading')
                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Sub-Heading</label>
                                    <textarea name="sub-heading" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title" required>{{ $configs['cms.homepage.top-section.sub-heading']->value }}</textarea>
                                    @error('sub-heading')
                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
								<p>Banner</p>
                                <img src="{{ asset($configs['cms.homepage.top-section.background']->value) }}" class="img-fluid" style="width:40%" alt="Homepage background image not available!">    
                                <div class="form-group" style="margin-top:1vw">
                                    <label for="">Click button below to update banner</label> <br>
									<input type="file" name="image" accept=".jpeg,.jpg,.png" >
                                    @error('image')
                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
							</div>
                        </div>
                    </form>

                    <!-- Trusted Companies Section -->
                    <form method="POST" action="{{ route('admin.cms.homepage.trusted-company.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method("put")
                        <div class="row" style="margin-top:4vw" >
                            <div class="col-6" >
                                <h5 class="mb-0 mb-3 text-gray-800" style="color:white">Trusted Collaborator Section</h5>
                            </div>
                            <div class="col-6" style="display:flex;justify-content:flex-end">
                                <button type="submit" class="btn btn-primary btn-user" style="padding:1vw 3.2vw" onclick='return confirm("Are you sure you want to update the Trusted Collaborator section in the Homepage?")'>
                                    Update All Collaborator Content
                                </button>						
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Trusted Collaborator Count</label>
                                    <input type="text" name="trusted-company-count" class="form-control form-control-user" 
                                        value="{{ $configs['cms.homepage.trusted-company-section.trusted-company-count']->value }}" required>
                                    @error('trusted-company-count')
                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <form action="">
                            <div class="col-6" style="display:flex;align-items:flex-end;justify-content:flex-end">
                                <div class="form-group" style="width:40%">
                                    <br>
                                    <label for="">Add New Collaborator</label>  <br>
                                    <input type="file" name=""  required>
                                    @error('')
                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-user" style="width:100%" onclick='return confirm("Are you sure you want to update the Trusted Company section in the Homepage?")'>
                                        Add New
                                    </button>	
                                </div>
                            </div>
                            </form>
                            
                            
                            @foreach ($trusted_companies as $company)
                                <div class="col-3 mb-4">
                                    <div class="card shadow h-100 py-2">
                                        <form action="">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center" style="height: 250px">
                                                <div class="col" style="text-align:center">
                                                    <img src="{{ asset($company->image) }}" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                            <!-- START OF UPLOADED IMAGE -->
                                            <input type="file" name="images[{{ $company->id }}]" accept=".jpeg,.jpg,.png" style="margin-top:2vw">
                                            @error('images.' . $company->id)
                                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                            <div>
                                            <button type="submit" class="btn btn-primary btn-user mt-3" style="padding:0.5vw 2vw;width:100%;" >
                                                Update
                                            </button>
                                            <button type="submit" class="btn btn-danger btn-user mt-3" style="padding:0.5vw 2vw;width:100%;" >
                                                Delete
                                            </button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
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
						<div class="col-12" style="margin-top:4vw">
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
                                            <th class="text-nowrap">Name</th>
                                            <th>Occupancy</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Long Testimony</td>
                                            <td>
                                                <img src="{{ asset($fake_testimonies_big[0]->thumbnail) }}" style="width:10vw" class="img-fluid" alt="Thumbnail not available."> 
                                            </td>
                                            <td>{{ $fake_testimonies_big[0]->content }}</td>
                                            <td>{{ $fake_testimonies_big[0]->rating }}</td>
                                            <td>{{ $fake_testimonies_big[0]->name }}</td>
                                            <td>{{ $fake_testimonies_big[0]->occupancy }}</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <div style="padding: 0px 2px;">
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm"
                                                        href="{{ route('admin.cms.homepage.testimonies.edit',
                                                        ['id' => $fake_testimonies_big[0]->id, 'flag' => 'true']) }}">Update</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Medium Testimony</td>
                                            <td>
                                                <img src="{{ asset($fake_testimonies_big[1]->thumbnail) }}" style="width:10vw" class="img-fluid" alt="Thumbnail not available."> 
                                            </td>
                                            <td>{{ $fake_testimonies_big[1]->content }}</td>
                                            <td>{{ $fake_testimonies_big[1]->rating }}</td>
                                            <td>{{ $fake_testimonies_big[1]->name }}</td>
                                            <td>{{ $fake_testimonies_big[1]->occupancy }}</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <div style="padding: 0px 2px;">
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" 
                                                        href="{{ route('admin.cms.homepage.testimonies.edit', 
                                                        ['id' => $fake_testimonies_big[1]->id, 'flag' => 'true']) }}">Update</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Short Testimony (Left)</td>
                                            <td>
                                                <img src="{{ asset($fake_testimonies_small[0]->thumbnail) }}" style="width:10vw" class="img-fluid" alt="Thumbnail not available."> 
                                            </td>
                                            <td>{{ $fake_testimonies_small[0]->content }}</td>
                                            <td>{{ $fake_testimonies_small[0]->rating }}</td>
                                            <td style="color: red">Name not available.</td>
                                            <td style="color: red">Occupancy not available.</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <div style="padding: 0px 2px;">
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" 
                                                        href="{{ route('admin.cms.homepage.testimonies.edit', 
                                                        ['id' => $fake_testimonies_small[0]->id, 'flag' => 'false']) }}">Update</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Short Testimony (Right)</td>
                                            <td>
                                                <img src="{{ asset($fake_testimonies_small[1]->thumbnail) }}" style="width:10vw" class="img-fluid" alt="Thumbnail not available."> 
                                            </td>
                                            <td>{{ $fake_testimonies_small[1]->content }}</td>
                                            <td>{{ $fake_testimonies_small[1]->rating }}</td>
                                            <td style="color: red">Name not available.</td>
                                            <td style="color: red">Occupancy not available.</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                    <div style="padding: 0px 2px;">
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" 
                                                        href="{{ route('admin.cms.homepage.testimonies.edit', 
                                                        ['id' => $fake_testimonies_small[1]->id, 'flag' => 'false']) }}">Update</a>
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
