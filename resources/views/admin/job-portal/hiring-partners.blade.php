@extends('layouts/admin-main')

@section('title', 'Venidici Hiring Partners')

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
            <h1 class="mb-0 mb-3 text-gray-800">Hiring Partners</h1>
            <a href="{{ route('admin.job-portal.hiring-partners.create') }}" class="btn btn-primary btn-user p-3">Create New User</a>

        </div>
        

        <!-- Content Row -->


        <!-- start of table -->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->
                    @if ($users_data['total'] != 0)
                        <h1 class="h5 mb-2 text-gray-800 d-inline">{{ "(Showing " . $users_data['from'] . " to " . $users_data['to'] . " of " . $users_data['total'] . " results)" }}</h1>
                    @else
                        <h1 class="h5 mb-2 text-gray-800 d-inline">{{ "(*There are currently no Hiring Partners)" }}</h1>
                    @endif

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
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div id="dataTable_filter" class="dataTables_filter">
                                <label class="w-100">Search:
                                    <form action="{{ route('admin.job-portal.hiring-partners.index') }}" method="GET">
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
											<th>Company Name</th>
											<th>Email</th>
											<th>Created At</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $users_data['from'] + $loop->index }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->companyName }}</td>
                                                <td>{{ $user->email }}</td>
												<td class="text-nowrap">{{ $user->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                        <div style="padding: 0px 2px">
                                                            <input type="hidden" value="Contacted" name="status">
                                                            <a href="{{ route('admin.job-portal.hiring-partners.view-saved-candidates', $user->id) }}" class="d-sm-inline-block btn btn-info shadow-sm">View Saved Candidates</a>
                                                        </div>
                                                        {{-- checks if current user is super-admin --}}
                                                        @if (Auth::user()->user_role_id == 3) 
                                                            <form action="{{ route('admin.job-portal.hiring-partners.destroy', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <div style="padding: 0px 2px">
                                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit"
                                                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
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
    </div>
    <!-- /.container-fluid -->
</div>

@endsection
