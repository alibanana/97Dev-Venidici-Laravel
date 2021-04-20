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
											<th>Email</th>
											<th>Telephone</th>
											<th>Referral Code</th>
											<th>Occupancy</th>
											<th>Status</th>
											<th  class="text-nowrap">Signed Up At</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($users as $user)
											<tr>
												<td>{{ $users_data['from'] + $loop->index }}</td>
												<td>{{ $user->name }}</td>
												<td>{{ $user->email }}</td>
												@if ($user->userDetail()->exists())
													<td>{{ $user->userDetail->telephone }}</td>
													<td>{{ $user->userDetail->referral_code }}</td>
													<td>{{ $user->userDetail->occupancy }}</td>
												@else
													<td>-</td>
													<td>-</td>
													<td>-</td>
												@endif
												@if ($user->status == 'active')
													<td style="color:green">Active</td>
												@else
													<td style="color:red">Suspended</td>
												@endif
												<td class="text-nowrap">{{ $user->created_at->diffForHumans() }}</td>
												<td>
													<div class="d-sm-flex align-items-center justify-content-center mb-4">
														<form action="" method="post">
																@csrf
																@method('delete')
																<div style="padding: 0px 2px">
																		<button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
																</div>
														</form> 
														<form action="" method="post">
																@csrf
																@method('delete')
																<div style="padding: 0px 2px">
																		<button class="d-sm-inline-block btn btn-info shadow-sm" type="submit" onclick="return confirm('Are you sure you want to suspend this user?')">Suspend</button>
																</div>
														</form> 
														<!--
														<div style="padding: 0px 2px;">
																<a class="d-sm-inline-block btn btn-info shadow-sm" href="">Update</a>
														</div>
														-->
													</div>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
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
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
