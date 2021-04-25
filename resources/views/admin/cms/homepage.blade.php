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
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Sub-Heading</label>
                                    <textarea name="sub-heading" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title" required>{{ $configs['cms.homepage.top-section.sub-heading']->value }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
								<p>Banner</p>
                                <img src="{{ asset($configs['cms.homepage.top-section.background']->value) }}" class="img-fluid" style="width:40%" alt="Homepage background image not available!">    
                                <div class="form-group" style="margin-top:1vw">
                                    <label for="">Click button below to update banner</label> <br>
									<input type="file" name="image" >
								</div>
							</div>
                        </div>
                    </form>

                    <!-- Trusted Companies Section -->
                    <form method="POST" action="">
                    @csrf
                    @method("put")
                        <div class="row" style="margin-top:4vw" >
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
                                    <input type="text" class="form-control form-control-user" value="{{ $configs['cms.homepage.trusted-company-section.trusted-company-count']->value }}" name="">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            @foreach ($trusted_companies as $company)
                                <div class="col-3 mb-4">
                                    <div class="card shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col" style="text-align:center">
                                                    <img src="{{ asset($company->image) }}" alt="" class="img-fluid">
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
                            @endforeach
                        </div>
                    </form>

                    <!-- Testimonies Section -->
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
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/testimonies/1/update">Update</a>
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
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/testimonies/1/update">Update</a>
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
                                                        <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/testimonies/1/update">Update</a>
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
					<!-- /.container-fluid -->
                </div>
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
