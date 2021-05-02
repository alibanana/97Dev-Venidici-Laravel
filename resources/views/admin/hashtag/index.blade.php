@extends('layouts/admin-main')

@section('title', 'Venidici Hastag CMS')

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
            <h1 class="mb-0 mb-3 text-gray-800">Hashtags</h1>
            <a href="/admin/hashtags/create" class="btn btn-primary btn-user p-3">Create New Hashtag</a>

        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    {{-- <h1 class="h3 mb-2 text-gray-800 d-inline">Hashtags List</h1> --}}
                    <h1 class="h5 mb-2 text-gray-800 d-inline">{{ "(Showing " . $tags_data['from'] . " to " . $tags_data['to'] . " of " . $tags_data['total'] . " results)" }}</h1>

                    <div class="row mt-2 mb-3">
                        
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                            <div class="dataTables_length" id="show_entries">
                                <label class="w-100">Show:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        @foreach ($tags_data['per_page_options'] as $option)
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
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'alphabetical']) }}" @if (Request::get('sort') == 'alphabetical') selected @endif>A to Z</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'course_count']) }}" @if (Request::get('sort') == 'course_count') selected @endif>Courses Count</option>
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
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Color Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tags as $tag)
                                                <tr>
                                                    <td>{{ $tags_data['from'] + $loop->index }}</td>
                                                    <td>
                                                        <p style="color: black">{{ $tag->hashtag }}</p>
                                                        @if ($tag->courses_count != 0) 
                                                            <p style="color: grey">Used in {{ $tag->courses_count }} courses.</p>
                                                        @else
                                                            <p style="color: grey">Not used yet.</p>
                                                        @endif
                                                    </td>
                                                    <td><img src="{{ asset($tag->image) }}" class="img-fluid" style="width:5vw;height:5vw;border-radius:10px" alt="Image not available.."></td>   
                                                    @if ($tag->color_code)
                                                        <td>{{ $tag->color_code }}</td>   
                                                    @else
                                                        <td style="color: lightgrey">Color code not available..</td>
                                                    @endif
                                                    <td>
                                                        <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                            <div style="padding: 0px 2px;">
                                                                <a class="d-sm-inline-block btn btn-info shadow-sm" href="/admin/hashtags/1/update">Update</a>
                                                            </div>
                                                            <form action="" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <div style="padding: 0px 2px">
                                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this hashtag?')">Delete</button>
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
                            @unless (Request::get("show") == "All")
                                <div class="row mb-4">
                                    <div class="mx-auto">
                                        {{ $tags->appends(request()->input())->links("pagination::bootstrap-4") }}
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
