@extends('layouts/admin-main')

@section('title', 'Venidici Users CMS')

@section('container')

<!-- Stars Modal-->
<div class="modal fade" id="addStarsModal" tabindex="-1" role="dialog" aria-labelledby="addStarsModal"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addStarsModal">Give Stars To User</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			@if (session()->has('error_validation_on_add_stars'))
			<div class="p-3 mt-2 mb-0">
				<div class="alert alert-danger alert-dismissible fade show m-0" role="alert" style="font-size: 18px">
					{{ session()->get('error_validation_on_add_stars') }}     
					<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
			@endif

			<form method="POST" action="{{route('admin.users.add_stars')}}">
			@csrf
			{{ method_field('PUT') }}
			<div class="modal-body">
					<input type="hidden" name="user_id" id="user_id">
				<h6 class="modal-title" id="addStarsModal">Number of stars</h6>
				<div class="form-group mt-2">
					<input type="text" name="stars" required class="form-control form-control-user"
						id="" placeholder="Insert given stars">
					@error('stars')
						<span class="invalid-feedback" role="alert" style="display: block !important;">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<button class="btn btn-primary" type="submit">Confirm</button>   
			</div>
			</form>
		</div>
	</div>
</div>

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

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="mb-0 mb-3 text-gray-800">Users</h1>
        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->
                    <h1 class="h5 mb-2 text-gray-800 d-inline">{{ "(Showing " . $users_data['from'] . " to " . $users_data['to'] . " of " . $users_data['total'] . " results)" }}</h1>

                    <div class="row mt-2 mb-3">
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                            <div class="dataTables_length" id="show_entries">
                                <label class="w-100">Show:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        @foreach ($users_data['per_page_options'] as $option)
                                            <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'show' => $option]) }}" @if (Request::get('show') == $option) selected @endif>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                            <div class="dataTables_length" id="show_entries">
                                <label class="w-100">Sort By:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'latest']) }}" @if (Request::get('sort') == 'latest') selected @endif>Latest</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'oldest']) }}" @if (Request::get('sort') == 'oldest') selected @endif>Oldest</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                            <div class="dataTables_length" id="show_entries">
                                <label class="w-100">Filter:
									<select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'active']) }}" @if (Request::get('filter') == 'active') selected @endif>Active</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'suspended']) }}" @if (Request::get('filter') == 'suspended') selected @endif>Suspended</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'birthday-today']) }}" @if (Request::get('filter') == 'birthday-today') selected @endif>Birthday Today</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'admin']) }}" @if (Request::get('filter') == 'admin') selected @endif>Admin</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'super-admin']) }}" @if (Request::get('filter') == 'super-admin') selected @endif>Super Admin</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'normal-user']) }}" @if (Request::get('filter') == 'normal-user') selected @endif>Normal User</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'none']) }}" @if (!Request::has('filter')) selected @endif>None</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div id="dataTable_filter" class="dataTables_filter">
                                <label class="w-100">Search:
                                    <form action="{{ route('admin.users.index') }}" method="GET">
                                        <input name="search" value="{{ Request::get('search') }}" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                                        @if (Request::get('show'))
                                            <input name="show" value="{{ Request::get('show') }}" hidden>
                                        @endif
                                        <input type="submit" style="visibility: hidden;" hidden/>
                                    </form>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Main Table -->
                    <div class="card shadow mb-4">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No.</th>
											<th>Full Name</th>
											<th>Know Venidici From</th>
											<th>Address</th>
											<th>Status</th>
											<th>Stars</th>
											<th>Referral Code</th>
											<th>User Role</th>
											<th>Candidate Status</th>
											<th class="text-nowrap">Signed Up At</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($users as $user)
											<tr>
												<td>{{ $users_data['from'] + $loop->index }}</td>
												<td>{{ $user->name }} <br>
												{{ $user->email }} <br>
												@isset($user->userDetail->birthdate) 
												@php
													$birhdate_exploded = explode(" ", $user->userDetail->birthdate);
												@endphp
												Birth date : {{$birhdate_exploded[0]}} <br>
												@endisset
												@isset($user->userDetail->gender) Gender : {{ $user->userDetail->gender }} <br> @endisset
												@isset($user->userDetail->telephone) Telephone : {{ $user->userDetail->telephone }} <br> @endisset
												@isset($user->userDetail->company) Company : {{ $user->userDetail->company }} <br> @endisset
												@isset($user->userDetail->occupancy) Occupancy : {{ $user->userDetail->occupancy }} <br> @endisset
												</td>
													<td>@isset($user->userDetail->response) {{ $user->userDetail->response }} @endisset</td>
													<td class="text-nowrap"> @isset($user->userDetail->address) {{ $user->userDetail->address }} - @endisset @isset($user->userDetail->city['name']) {{ $user->userDetail->city['name'] }} - @endisset @isset($user->userDetail->province['name']) {{ $user->userDetail->province['name'] }} @endisset</td>
												@if ($user->status == 'active')
													<td style="color:green">Active</td>
												@else
													<td style="color:red">Suspended</td>
												@endif
													
												<td>{{ $users_usable_stars[$user->id] }}</td>
													<td> @isset($user->userDetail->referral_code) {{ $user->userDetail->referral_code }} @endisset </td>
												<td class="text-nowrap">
													@if($user->user_role_id == 1)
														User
													@elseif($user->user_role_id == 2)
														Admin
													@else	
														Super Admin
													@endif
												</td>
												@if ($user->isCandidate)
													<td style="color:green">Yes</td>
												@else
													<td style="color:red">No</td>
												@endif
												<td class="text-nowrap">{{ $user->created_at->diffForHumans() }}</td>
												<td>
													<div class="d-sm-flex align-items-center justify-content-center mb-4">
														<form action="{{ route('admin.users.set-status-to-opposite', $user->id) }}" method="post">
																@csrf
																<div style="padding: 0px 2px">
																	@if ($user->status == 'suspended')
																		<button class="d-sm-inline-block btn btn-success shadow-sm" type="submit" onclick="return confirm('Are you sure you want to reinstate this user?')">Reinstate</button>
																	@else
																		<button class="d-sm-inline-block btn btn-warning shadow-sm" type="submit" onclick="return confirm('Are you sure you want to suspend this user?')">Suspend</button>
																	@endif
																</div>
														</form> 
														<div style="padding: 0px 2px;" class="text-nowrap">
															<a onclick="passUserIDandEmail({{$user->id}})" class="d-sm-inline-block btn btn-secondary shadow-sm" href="#" data-toggle="modal" data-target="#addStarsModal">
																Add Stars
															</a>
														</div>
														<!-- IF USER IS SUPER ADMIN -->
														@if(auth()->user()->user_role_id == 3)
														<form action="{{ route('admin.users.set-role-to-opposite', $user->id) }}" method="post">
																@csrf
																<div style="padding: 0px 2px">
																	@if ($user->user_role_id == 1)
																		<button class="d-sm-inline-block btn btn-info shadow-sm text-nowrap" type="submit" onclick="return confirm('Are you sure you want to set this user as admin?')">Set As Admin</button>
																	@else
																		<button class="d-sm-inline-block btn btn-success shadow-sm" type="submit" onclick="return confirm('Are you sure you want to set this admin as user?')">Set As User</button>
																	@endif
																</div>
														</form>
														@endif 
													</div>
												</td>
											</tr>
										@endforeach
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
		@unless (Request::get("show") == "All")
			<div class="row mb-4">
				<div class="mx-auto">
					{{ $users->appends(request()->input())->links("pagination::bootstrap-4") }}
				</div>
			</div>
		@endunless
    </div>
    <!-- /.container-fluid -->
</div>

<script>
    function passUserIDandEmail(user_id) {

		document.getElementById("user_id").value = user_id;

    }
</script>
@endsection
