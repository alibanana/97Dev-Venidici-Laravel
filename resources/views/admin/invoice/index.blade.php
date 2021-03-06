@extends('layouts/admin-main')

@section('title', 'Venidici Invoices')

@section('container')

<!-- Stars Modal-->
<div class="modal fade" id="exportInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exportInvoiceModal"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exportInvoiceModal">Export Invoice</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
            </div>

			<form method="POST" action="{{ route('admin.invoices.export') }}">
            @csrf
                <div class="modal-body">
                    <h6 class="modal-title" id="exportInvoiceModal">Filter by course</h6>
                    <div class="form-group mt-2">
                        <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                            <option name="course_id" value="" selected>All</option>
                            @foreach($courses as $course)
                                <option name="course_id" value="{{$course->id}}">{{$course->courseType->type}} - {{$course->title}}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row m-0">
                        <div class="col-6 " style="padding-left:0px">
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input type="date" name="start_date" class="form-control form-control-user" placeholder="dd.mm.yyyy"> 
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror               
                            </div>
                        </div>
                        <div class="col-6" style="padding-right:0px ">
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input type="date" name="end_date" class="form-control form-control-user" placeholder="dd.mm.yyyy"> 
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Export</button>   
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

        @if (session()->has('export-failed'))
            <div class="alert alert-danger alert-dismissible fade show m-0" role="alert" style="font-size: 18px">
                {{ session()->get('export-failed') }}    
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="mb-0 mb-3 text-gray-800">Invoices</h1>
        </div>
        
        <!-- Content Row -->

        <!-- start of table -->
        <div class="row">
            <div class="col-2">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        <span style="color: orange">Pending Invoices</span><br>
                        <span>Count: </span><span class="font-weight-bold">{{ $invoicesCountByStatus['pending'] ?? '-' }}</span><br>
                        <span>Total: </span><span class="font-weight-bold">Rp {{ $invoicesTotalByStatus['pending'] ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        <span style="color: green">Paid Invoices</span><br>
                        <span>Count: </span><span class="font-weight-bold">{{ $invoicesCountByStatus['paid'] ?? '-' }}</span><br>
                        <span>Total: </span><span class="font-weight-bold">Rp {{ $invoicesTotalByStatus['paid'] ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        <span style="color: green">Completed Invoices</span><br>
                        <span>Count: </span><span class="font-weight-bold">{{ $invoicesCountByStatus['completed'] ?? '-' }}</span><br>
                        <span>Total: </span><span class="font-weight-bold">Rp {{ $invoicesTotalByStatus['completed'] ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        <span style="color: red">Failed Invoices</span><br>
                        <span>Count: </span><span class="font-weight-bold">{{ $invoicesCountByStatus['failed'] ?? '-' }}</span><br>
                        <span>Total: </span><span class="font-weight-bold">Rp {{ $invoicesTotalByStatus['failed'] ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        <span style="color: grey">Cancelled Invoices</span><br>
                        <span>Count: </span><span class="font-weight-bold">{{ $invoicesCountByStatus['cancelled'] ?? '-' }}</span><br>
                        <span>Total: </span><span class="font-weight-bold">Rp {{ $invoicesTotalByStatus['cancelled'] ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card bg-light text-black shadow">
                    <div class="card-body">
                        <span style="color: grey">Expired Invoices</span><br>
                        <span>Count: </span><span class="font-weight-bold">{{ $invoicesCountByStatus['expired'] ?? '-' }}</span><br>
                        <span>Total: </span><span class="font-weight-bold">Rp {{ $invoicesTotalByStatus['expired'] ?? '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->

                    <div class="row mt-2 mb-3">
                        <!--
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                            <div class="dataTables_length" id="show_entries">
                                <label class="w-100">Show:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'show' => '10']) }}" @if (Request::get('show') == '10') selected @endif>10</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        -->
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                            <div class="dataTables_length" id="show_entries">
                                <label class="w-100">Status:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filterStatus' => 'Pending']) }}" @if (Request::get('filterStatus') == 'Pending') selected @endif>Pending</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filterStatus' => 'Completed']) }}" @if (Request::get('filterStatus') == 'Completed') selected @endif>Completed</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filterStatus' => 'Failed']) }}" @if (Request::get('filterStatus') == 'Failed') selected @endif>Failed</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filterStatus' => 'Paid']) }}" @if (Request::get('filterStatus') == 'Paid') selected @endif>Paid</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filterStatus' => 'Cancelled']) }}" @if (Request::get('filterStatus') == 'Cancelled') selected @endif>Cancelled</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filterStatus' => '']) }}" @if (!Request::has('filterStatus')) selected @endif>None</option>
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
                        
                        <div class="col-sm-12 col-md-6">
                            <div id="dataTable_filter" class="dataTables_filter">
                                <label class="w-100">Search:
                                    <form action="" method="GET">
                                        <input name="search" value="{{ Request::get('search') }}" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                                        @if (Request::get('show'))
                                            <input name="show" value="{{ Request::get('show') }}" hidden>
                                        @endif
                                        <input type="submit" style="visibility: hidden;" hidden/>
                                    </form>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <div style="margin-top:1.2vw" class="text-nowrap">
                                <form action="{{ route('admin.invoices.refresh') }}" method="POST" style="display: inline">
                                    @csrf
                                    <button type="submit" class="d-sm-inline-block btn btn-warning shadow-sm">
                                        Refresh
                                    </button>
                                </form>
                                <button data-toggle="modal" data-target="#exportInvoiceModal" class="d-sm-inline-block btn btn-secondary shadow-sm ml-2">
                                    Export
                                </button>
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
                                                <th>Invoice No</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Last Updated</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($invoices as $invoice)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$invoice->invoice_no}}</td>
                                                    <td>{{$invoice->user->name}}</td>
                                                    @if ($invoice->status == 'pending')
                                                        <td style="color: orange">{{$invoice->status}}</td>
                                                    @elseif ($invoice->status == 'completed')
                                                        <td style="color: green">{{$invoice->status}}</td>
                                                    @elseif ($invoice->status == 'failed')
                                                        <td style="color: red">{{$invoice->status}}</td>
                                                    @elseif ($invoice->status == 'paid')
                                                        <td style="color: green">{{$invoice->status}}</td>
                                                    @elseif ($invoice->status == 'cancelled')
                                                        <td style="color: grey">{{$invoice->status}}</td>
                                                    @elseif ($invoice->status == 'expired')
                                                        <td style="color: grey">{{$invoice->status}}</td>
                                                    @endif
                                                    @if ($invoice->status == 'paid' || $invoice->status == 'completed')
                                                        <td>Rp {{$invoice->grand_total}}</td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    <td>{{$invoice->updated_at}}</td>
                                                    <td>
                                                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                            <div style="padding: 0px 2px;">
                                                                <a class="d-sm-inline-block btn btn-secondary shadow-sm text-nowrap" href="{{ route('admin.invoices.show', $invoice->id) }}">View Detail</a>
                                                                <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" style="display: inline">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                    <button type="submit" class="d-sm-inline-block btn btn-danger shadow-sm text-nowrap"
                                                                        onclick="return confirm('Are you sure you want to delete this Invoice?')">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="mx-auto">
                                    {{ $invoices->appends(request()->input())->links("pagination::bootstrap-4") }}
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
