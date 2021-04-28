@extends('layouts/admin-main')

@section('title', 'Venidici Online Courses')

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
            <h1 class="mb-0 mb-3 text-gray-800">Online Courses</h1>
            <a href="/admin/online-courses/create" class="btn btn-primary btn-user p-3">Create New Course</a>
        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->
                    <h1 class="h5 mb-2 text-gray-800 d-inline">{{ "(Showing " . 10 . " to " . 100 . " of " . 125 . " results)" }}</h1>

                    <div class="row mt-2 mb-3">
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
                                                <th>Course</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div style="display:flex;align-items:center">
                                                            <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="width:10vw" alt="Thumbnail not available..">
                                                            <div style="margin-left:1vw">
                                                                <p style="color:grey;margin-bottom:0px;">{{ $course->courseCategory->category }}</p>
                                                                <p style="color:black;font-weight:bold;margin-bottom:0px">{{ $course->title }}</p>
                                                                <p style="color:black;">{{ $course->sub_title }}</p>
                                                                @if ($course->price == 0)
                                                                    <p style="margin-bottom:0px">FREE</p>
                                                                @else
                                                                    <p style="margin-bottom:0px">IDR {{ $course->price }}</p>
                                                                @endif
                                                                <div style="display: flex;">
                                                                    {{ $course->average_rating }}
                                                                    <div style="margin-left:0.5vw">
                                                                        @for ($i = 1; $i < 6; $i++)
                                                                            @if ($i <= $course->average_rating)
                                                                                @if ($i == 1)
                                                                                    <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                                                                @else
                                                                                    <i style="margin-left:0.2vw;color:#F4C257" class="fas fa-star small-text"></i>
                                                                                @endif
                                                                            @else
                                                                                @if ($i == 1)
                                                                                    <i style="color:#B3B5C2" class="fas fa-star small-text"></i>
                                                                                @else
                                                                                    <i style="margin-left:0.2vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                                                                @endif
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @if ($course->publish_status == 'Published')
                                                        <td style="color:green">Published</td>
                                                    @else
                                                        <td>DRAFT</td>
                                                    @endif
                                                    <td>
                                                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                                <form action="" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <div style="padding: 0px 2px">
                                                                        <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this online course?')">Delete</button>
                                                                    </div>
                                                                </form> 
                                                                <div style="padding: 0px 2px;">
                                                                    <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/online-courses/1/update">Update</a>
                                                                </div>
                                                                <form action="" method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div style="padding: 0px 2px">
                                                                        <button class="d-sm-inline-block btn btn-primary shadow-sm" type="submit" onclick="return confirm('Are you sure you want to set this online course as draft?')">Set as draft</button>
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
