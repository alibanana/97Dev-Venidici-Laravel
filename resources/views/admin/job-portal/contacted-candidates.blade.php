@extends('layouts/admin-main')

@section('title', 'Venidici Contacted Candidates')

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
            <h2 class="mb-0 mb-3 text-gray-800">Saved Candidates by {{ $hiringPartner->companyName }}</h2>
        </div>
        

        <!-- Content Row -->


        <!-- start of table -->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->
                    <h1 class="h5 mb-2 text-gray-800 d-inline">{{ "(Showing " . $contactedCandidates_data['from'] . " to " . $contactedCandidates_data['to'] . " of " . $contactedCandidates_data['total'] . " results)" }}</h1>

                    <div class="row mt-2 mb-3">
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                            <div class="dataTables_length" id="show_entries">
                                <label class="w-100">Show:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        @foreach ($contactedCandidates_data['per_page_options'] as $option)
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
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'archived']) }}" @if (Request::get('filter') == 'archived') selected @endif>Archived</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'contacted']) }}" @if (Request::get('filter') == 'contacted') selected @endif>Contacted</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'accepted']) }}" @if (Request::get('filter') == 'accepted') selected @endif>Accepted</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'hired']) }}" @if (Request::get('filter') == 'hired') selected @endif>Hired</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'none']) }}" @if (!Request::has('filter')) selected @endif>None</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div id="dataTable_filter" class="dataTables_filter">
                                <label class="w-100">Search:
                                    <form action="{{ route('admin.job-portal.hiring-partners.view-saved-candidates', $hiringPartner->id) }}" method="GET">
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
                                        @foreach ($contactedCandidates as $candidate)
                                            <tr>
                                                <td>{{ $contactedCandidates_data['from'] + $loop->index }}</td>
                                                <td>{{ $candidate->name }}</td>
                                                <td>{{ $candidate->email }}</td>
                                                <td>{{ $candidate->candidateDetail->whatsapp_number }}</td>
                                                <td>
                                                    @if ($candidate->pivot->status == 'archived')
                                                        <span style="color:grey">
                                                            Archived
                                                        </span>
                                                    @elseif ($candidate->pivot->status == 'contacted')
                                                        <span style="color:orange">
                                                            Contacted
                                                        </span>
                                                    @elseif ($candidate->pivot->status == 'accepted')
                                                        <span style="color:green">
                                                            Accepted
                                                        </span>
                                                    @elseif ($candidate->pivot->status == 'hired')
                                                        <span style="color:green">
                                                            Hired
                                                        </span>
                                                    @endif
                                                </td>												
                                                <td>
                                                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                        @if ($candidate->pivot->status == 'archived')
                                                            <form action="{{ route('admin.job-portal.hiring-partners.candidates-action') }}" method="post">
                                                                @csrf
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" name="hiring_partner_id" value="{{ $hiringPartner->id }}">
                                                                    <input type="hidden" name="candidate_id" value="{{ $candidate->pivot->candidate_id }}">
                                                                    <input type="hidden" name="action" value="contact">
                                                                    <button class="d-sm-inline-block btn btn-warning shadow-sm" type="submit" onclick="return confirm('Are you sure you want to contact this candidate?')">Contact</button>
                                                                </div>
                                                            </form>
                                                            <form action="{{ route('admin.job-portal.hiring-partners.candidates-action') }}" method="post">
                                                                @csrf
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" name="hiring_partner_id" value="{{ $hiringPartner->id }}">
                                                                    <input type="hidden" name="candidate_id" value="{{ $candidate->pivot->candidate_id }}">
                                                                    <input type="hidden" name="action" value="unarchive">
                                                                    <button class="d-sm-inline-block btn btn-secondary shadow-sm" type="submit" onclick="return confirm('Are you sure you want to unarchive this candidate?')">Unarchive</button>
                                                                </div>
                                                            </form>
                                                        @elseif ($candidate->pivot->status == 'contacted')
                                                            <form action="{{ route('admin.job-portal.hiring-partners.candidates-action') }}" method="post">
                                                                @csrf
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" name="hiring_partner_id" value="{{ $hiringPartner->id }}">
                                                                    <input type="hidden" name="candidate_id" value="{{ $candidate->pivot->candidate_id }}">
                                                                    <input type="hidden" name="action" value="accept">
                                                                    <button class="d-sm-inline-block btn btn-success shadow-sm" type="submit" onclick="return confirm('Are you sure you want to accept this candidate?')">Accept</button>
                                                                </div>
                                                            </form>
                                                            <form action="{{ route('admin.job-portal.hiring-partners.candidates-action') }}" method="post">
                                                                @csrf
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" name="hiring_partner_id" value="{{ $hiringPartner->id }}">
                                                                    <input type="hidden" name="candidate_id" value="{{ $candidate->pivot->candidate_id }}">
                                                                    <input type="hidden" name="action" value="unarchive">
                                                                    <button class="d-sm-inline-block btn btn-secondary shadow-sm" type="submit" onclick="return confirm('Are you sure you want to unarchive this candidate?')">Unarchive</button>
                                                                </div>
                                                            </form>
                                                        @elseif ($candidate->pivot->status == 'accepted')
                                                            <form action="{{ route('admin.job-portal.hiring-partners.candidates-action') }}" method="post">
                                                                @csrf
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" name="hiring_partner_id" value="{{ $hiringPartner->id }}">
                                                                    <input type="hidden" name="candidate_id" value="{{ $candidate->pivot->candidate_id }}">
                                                                    <input type="hidden" name="action" value="cancel">
                                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to cancel this candidate?')">Cancel</button>
                                                                </div>
                                                            </form>
                                                        @elseif ($candidate->pivot->status == 'hired')
                                                            <form action="{{ route('admin.job-portal.hiring-partners.candidates-action') }}" method="post">
                                                                @csrf
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" name="hiring_partner_id" value="{{ $hiringPartner->id }}">
                                                                    <input type="hidden" name="candidate_id" value="{{ $candidate->pivot->candidate_id }}">
                                                                    <input type="hidden" name="action" value="unarchive">
                                                                    <button class="d-sm-inline-block btn btn-secondary shadow-sm" type="submit" onclick="return confirm('Are you sure you want to unarchive this candidate?')">Unarchive</button>
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
