@extends('layouts/admin-main')

@section('title', 'Venidici Assesments')

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
            <h2 class="mb-0 mb-3 text-gray-800">Assesment List</h2>
            <a href="{{ route('admin.assessments.create') }}" class="btn btn-primary btn-user p-3">Create New Assesment</a>

        </div>
        <div class="row mt-2">
            <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                <div class="dataTables_length" id="show_entries">
                    <label class="w-100">Show:
                        <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                            <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'show' => '10']) }}" @if (Request::get('show') == '10') selected @endif>10</option>
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
            <!--
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
            -->
        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->


                    <!-- Main Table -->
                    <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Assesment</th>
                                                <th>Duration</th>
                                                <th>Course</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assessments as $assessment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $assessment->title }}</td>
                                                    <td>{{ $assessment->duration }}</td>
                                                    @if ($assessment->course)
                                                        <td><a href="{{ route('admin.online-courses.show', $assessment->course->id) }}" style="color:green">{{ $assessment->course->title }}</a></td>
                                                    @else
                                                        <td style="color:grey">Not assigned to an assessment yet.</td>
                                                    @endif
                                                    <td>
                                                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                            <div style="padding: 0px 2px;">
                                                                <a class="d-sm-inline-block btn btn-info shadow-sm" href="{{ route('admin.assessments.edit', $assessment->id) }}">Update</a>
                                                            </div>
                                                            <form action="{{ route('admin.assessments.destroy', $assessment->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <div style="padding: 0px 2px">
                                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this Assessment?')">Delete</button>
                                                                </div>
                                                            </form>
                                                            <!-- <div style="padding: 0px 2px;" class="text-nowrap">
                                                                <a class="d-sm-inline-block btn btn-primary shadow-sm" href="/admin/online-courses/assesments/1">View Result</a>
                                                            </div> -->
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
