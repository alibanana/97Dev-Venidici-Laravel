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
						<form method="POST" action="">
							@csrf
							@method("put")
						<button type="submit" class="btn btn-primary btn-user" style="padding:1vw 8vw" onclick='return confirm("Are you sure you want to update the content?")'>
							Update Content
						</button>
					</div>
					<div class="row">
						<div class="col-12">
							<h5 class="mb-0 mb-3 text-gray-800" style="color:white">Home Page Top Section</h5>
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
								<p>Current Video</p>
								<!--<video autoplay controls="false" style="width:20vw;height:auto;border:4px solid black;border-radius:5px" src='/assets/videos/admin/CEPAT.ogg' type='video/ogg'></video>-->
								<video style="width:20vw;height:auto;border:4px solid black;border-radius:5px"  controls="false" >
									<source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
									<source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
									Your browser does not support HTML video.
								</video>             
							<div class="form-group">
								<input type="file" >
							</div>
						</div>
						<div class="col-12" style="margin-top:1vw">
							<h5 class="mb-0 mb-3 text-gray-800" style="color:white">Trusted Company Section</h5>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>BCA</td>
										<td>
										<input type="file" name="thumbnail" accept="image/*">
										@error('thumbnail')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<br>
										<br>
											<label for="">Current Image</label>
											<br>
										<img src="/assets/images/client/bca-bank.png" alt="Snow" style="width:10vw;margin-top:1vw">										</td>
										<td>
											<div class="d-sm-flex align-items-center justify-content-center mb-4">
													<form action="" method="post">
														@csrf
														@method('delete')
														<div style="padding: 0px 2px">
															<button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this trusted company?')">Delete</button>
														</div>
													</form> 
												
													<div style="padding: 0px 2px;">
														<a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/trusted-companies/1/update">Update</a>
													</div>
											
											</div>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>BCA</td>
										<td>
										<input type="file" name="thumbnail" accept="image/*">
										@error('thumbnail')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<br>
										<br>
											<label for="">Current Image</label>
											<br>
										<img src="/assets/images/client/bca-bank.png" alt="Snow" style="width:10vw;margin-top:1vw">										</td>
										<td>
											<div class="d-sm-flex align-items-center justify-content-center mb-4">
													<form action="" method="post">
														@csrf
														@method('delete')
														<div style="padding: 0px 2px">
															<button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this trusted company?')">Delete</button>
														</div>
													</form> 
												
													<div style="padding: 0px 2px;">
														<a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/trusted-companies/1/update">Update</a>
													</div>
											
											</div>
										</td>
									</tr>
									<tr>
										<td>3</td>
										<td>BCA</td>
										<td>
										<input type="file" name="thumbnail" accept="image/*">
										@error('thumbnail')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<br>
										<br>
											<label for="">Current Image</label>
											<br>
										<img src="/assets/images/client/bca-bank.png" alt="Snow" style="width:10vw;margin-top:1vw">										</td>
										<td>
											<div class="d-sm-flex align-items-center justify-content-center mb-4">
													<form action="" method="post">
														@csrf
														@method('delete')
														<div style="padding: 0px 2px">
															<button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this trusted company?')">Delete</button>
														</div>
													</form> 
												
													<div style="padding: 0px 2px;">
														<a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/trusted-companies/1/update">Update</a>
													</div>
											
											</div>
										</td>
									</tr>
									<tr>
										<td>4</td>
										<td>BCA</td>
										<td>
										<input type="file" name="thumbnail" accept="image/*">
										@error('thumbnail')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<br>
										<br>
											<label for="">Current Image</label>
											<br>
										<img src="/assets/images/client/bca-bank.png" alt="Snow" style="width:10vw;margin-top:1vw">										</td>
										<td>
											<div class="d-sm-flex align-items-center justify-content-center mb-4">
													<form action="" method="post">
														@csrf
														@method('delete')
														<div style="padding: 0px 2px">
															<button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this trusted company?')">Delete</button>
														</div>
													</form> 
												
													<div style="padding: 0px 2px;">
														<a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/trusted-companies/1/update">Update</a>
													</div>
											
											</div>
										</td>
									</tr>
									
								
								</tbody>
							</table>
						</div>
						<div class="col-12" style="margin-top:1vw">
							<h5 class="mb-0 mb-3 text-gray-800" style="color:white">Testimony Section</h5>
						</div>
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
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Long Testimony</td>
										<td>
										<input type="file" name="thumbnail" accept="image/*">
										@error('thumbnail')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<br>
										<br>
											<label for="">Current Image</label>
											<br>
										<img src="/assets/images/client/testimony-image-dummy.png" alt="Snow" style="width:10vw;margin-top:1vw">										</td>
										<td>
										<textarea name="content" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem sunt nobis harum pariatur, quibusdam recusandae inventore ab similique quas impedit explicabo aspernatur quos molestias voluptatem, nesciunt ratione voluptate et rem?</textarea>
										</td>
										<td>	
										<input name="rating" type="text" value="4.9">
										</td>
										<td>
										<input name="name" type="text" value="Fernandha Dzaky">
										</td>
										<td>
										<input name="occupancy" type="text" value="Developer">
										</td>
									</tr>
									<tr>
										<td>Medium Testimony</td>
										<td>
										<input type="file" name="thumbnail" accept="image/*">
										@error('thumbnail')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<br>
										<br>
											<label for="">Current Image</label>
											<br>
										<img src="/assets/images/client/testimony-image-dummy.png" alt="Snow" style="width:10vw;margin-top:1vw">										</td>
										<td>
										<textarea name="content" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem sunt nobis harum pariatur, quibusdam recusandae inventore ab similique quas impedit explicabo aspernatur quos molestias voluptatem, nesciunt ratione voluptate et rem?</textarea>
										</td>
										<td>	
										<input name="rating" type="text" value="4.9">
										</td>
										<td>
										<input name="name" type="text" value="Fernandha Dzaky">
										</td>
										<td>
										<input name="occupancy" type="text" value="Developer">
										</td>
									</tr>
									<tr>
										<td>Short Testimony (Left)</td>
										<td>
										<input type="file" name="thumbnail" accept="image/*">
										@error('thumbnail')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<br>
										<br>
											<label for="">Current Image</label>
											<br>
										<img src="/assets/images/client/testimony-image-dummy.png" alt="Snow" style="width:10vw;margin-top:1vw">										</td>
										<td>
										<textarea name="content" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem sunt nobis harum pariatur, quibusdam recusandae inventore ab similique quas impedit explicabo aspernatur quos molestias voluptatem, nesciunt ratione voluptate et rem?</textarea>
										</td>
										<td>	
										<input name="rating" type="text" value="4.9">
										</td>
										<td>
										<input name="name" type="text" value="Fernandha Dzaky">
										</td>
										<td>
										<input name="occupancy" type="text" value="Developer">
										</td>
									</tr>
									<tr>
										<td>Short Testimony (Right)</td>
										<td>
										<input type="file" name="thumbnail" accept="image/*">
										@error('thumbnail')
										<span class="invalid-feedback" role="alert" style="display: block !important;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<br>
										<br>
											<label for="">Current Image</label>
											<br>
										<img src="/assets/images/client/testimony-image-dummy.png" alt="Snow" style="width:10vw;margin-top:1vw">										</td>
										<td>
										<textarea name="content" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorem sunt nobis harum pariatur, quibusdam recusandae inventore ab similique quas impedit explicabo aspernatur quos molestias voluptatem, nesciunt ratione voluptate et rem?</textarea>
										</td>
										<td>	
										<input name="rating" type="text" value="4.9">
										</td>
										<td>
										<input name="name" type="text" value="Fernandha Dzaky">
										</td>
										<td>
										<input name="occupancy" type="text" value="Developer">
										</td>
									</tr>
								</tbody>
							</table>
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
