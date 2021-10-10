@extends('layouts/admin-main')

@section('title', 'Venidici Bootcamp Candidates Funnelling')

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
            <h1 class="mb-0 mb-3 text-gray-800">Job-Portal Candidates</h1>
        </div>
        

        <!-- Content Row -->


        <!-- start of table -->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->
                    <h1 class="h5 mb-2 text-gray-800 d-inline">Showing 1 from 100 Users</h1>

                    <div class="row mt-2 mb-3">
                        
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
                                        <option>All</option>
                                        <option>Not yet update profile</option>
                                        <option>Waiting for approval</option>
                                        <option>Accepted</option>
                                        <option>Rejected</option>
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
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>												
                                                <td>{{ $user->name }}</td>												
                                                <td>{{ $user->email }}</td>												
                                                <td>{{ $user->userDetail->telephone }}</td>												
                                                <td>
                                                    @if ($userIdAndCandidateStatusMap[$user->id] == 'not_updated')
                                                        <span style="color:grey">
                                                            Not Yet Updated
                                                        </span>
                                                    @elseif ($userIdAndCandidateStatusMap[$user->id] == 'pending')
                                                        <span style="color:orange">
                                                            Waiting For Approval
                                                        </span>
                                                    @else
                                                        <span style="color:green">
                                                            Accepted
                                                        </span>
                                                    @endif
                                                </td>												
                                                <td>
                                                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                        <div style="padding: 0px 2px">
                                                            <a href="/admin/job-portal/request/1" target="_blank" class="d-sm-inline-block btn btn-warning shadow-sm text-nowrap">View Updates</a>
                                                        </div>
                                                        <div style="padding: 0px 2px">
                                                            <a href="/admin/job-portal/1" target="_blank" class="d-sm-inline-block btn btn-info shadow-sm text-nowrap">View Detail</a>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div style="padding: 0px 2px">
                                                                <input type="hidden" value="Approved" name="status">
                                                                <button class="d-sm-inline-block btn btn-success shadow-sm" type="submit" onclick="return confirm('Are you sure you want to approve this user?')">Approve</button>
                                                            </div>
                                                        </form>
                                                        <form action="" method="post">
                                                            <div style="padding: 0px 2px">
                                                                <input type="hidden" value="Rejected" name="status">
                                                                <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Reject</button>
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
					<!-- /.container-fluid -->
					
                </div>
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection
