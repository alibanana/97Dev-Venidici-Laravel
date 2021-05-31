@extends('layouts/admin-main')

@section('title', 'Venidici Promo Codes')

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
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="mb-0 mb-3 text-gray-800">Promo Code</h1>
            <a href="/admin/promotions/create" class="btn btn-primary btn-user p-3">Create New Promo Code</a>

        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        
        <div class="row">
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
                                <label class="w-100">Filter:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'Pending']) }}" @if (Request::get('filter') == 'Pending') selected @endif>Pending</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'Contacted']) }}" @if (Request::get('filter') == 'Contacted') selected @endif>Contacted</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'filter' => 'Rejected']) }}" @if (Request::get('filter') == 'Rejected') selected @endif>Rejected</option>
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
                        
                        <div class="col-sm-12 col-md-8">
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
                        
                    </div>

                    <!-- Main Table -->
                    <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Applicant</th>
                                                <th>Company</th>
                                                <th>Krest Program</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applicants as $applicant)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                <b>{{$applicant->name}} </b><br>
                                                {{$applicant->email}} <br>
                                                {{$applicant->telephone}}
                                                </td>
                                                <td>{{$applicant->company}}</td>   
                                                <td>{{$applicant->krestProgram->program}}</td>   
                                                <td>{{$applicant->subject}}</td>   
                                                <td>{{$applicant->message}}</td>   
                                                <td
                                                @if($applicant->status == 'Contacted')
                                                style="color:green"
                                                @elseif($applicant->status == 'Rejected')

                                                style="color:red"
                                                @endif     
                                                >
                                                {{$applicant->status}}</td>   
                                                <td>
                                                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                            @if($applicant->status == 'Pending')
                                                            <form action="{{ route('admin.krest.updateStatus', $applicant->id) }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" value="Rejected" name="status">
                                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to reject this applicant?')">Reject</button>
                                                                </div>
                                                            </form> 
                                                            <form action="{{ route('admin.krest.updateStatus', $applicant->id) }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" value="Contacted" name="status">
                                                                    <button class="d-sm-inline-block btn btn-info shadow-sm" type="submit" onclick="return confirm('Are you sure you have contacted this applicant?')">Contacted</button>
                                                                </div>
                                                            </form> 
                                                            
                                                            @endif
                                                            @if($applicant->status == 'Rejected' || $applicant->status == 'Contacted')
                                                            <form action="{{ route('admin.krest.updateStatus', $applicant->id) }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div style="padding: 0px 2px">
                                                                    <input type="hidden" value="Pending" name="status">
                                                                    <button class="d-sm-inline-block btn btn-secondary shadow-sm" type="submit" onclick="return confirm('Are you sure you want to reinstate this applicant?')">Reinstate</button>
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
