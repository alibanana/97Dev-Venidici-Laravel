@extends('layouts/admin-main')

@section('title', 'Venidici Menjadi Pengajar')

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
            <h1 class="mb-0 mb-3 text-gray-800">Menjadi Pengajar Applicants</h1>
            <!--<a href="/admin/promo/create" class="btn btn-primary btn-user p-3">Create New Promo Code</a>-->

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
                                                <th>Profile</th>
                                                <th>LinkedIn</th>
                                                <th>Address</th>
                                                <th>Prev/Current Company</th>
                                                <th>Current Degree</th>
                                                <th>University</th>
                                                <th>Desired Position</th>
                                                <th>Desired Fee</th>
                                                <th >CV</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applicants as $applicant)
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                {{$applicant->name}} <br>
                                                {{$applicant->email}} <br>
                                                {{$applicant->phone}} <br>
                                                {{$applicant->job}}
                                                </td>
                                                <td>{{$applicant->linkedIn}}</td>   
                                                <td>{{$applicant->address}}</td>   
                                                <td>{{$applicant->company}}</td>   
                                                <td>{{$applicant->education}}</td>   
                                                <td>{{$applicant->university}}</td>   
                                                <td>{{$applicant->instructorPosition->name}}</td>   
                                                <td>Rp{{$applicant->salary}}</td>   
                                                <td class="text-nowrap">
                                                <a href="{{ asset($applicant->cv) }}" target="_blank">View CV</a>
                                                </td>   
                                                <td>
                                                    <div class="d-sm-flex align-items-center justify-content-center mb-4">

                                                            <form action="{{ route('admin.instructors.destroy', $applicant->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div style="padding: 0px 2px">
                                                                <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this instructor?')">Delete</button>
                                                            </div>
                                                        </form> 
                                                            <!--
                                                            <div style="padding: 0px 2px;">
                                                                <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/promo/1/update">Contacted</a>
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
