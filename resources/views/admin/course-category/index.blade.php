@extends('layouts/admin-main')

@section('title', 'Venidici Course Category')

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
            <h1 class="mb-0 mb-3 text-gray-800">Online Course Category</h1>
        </div>
        
        <!-- Content Row -->

        <!-- start of table -->
        <div class="row">
            <div class="col-6">
                <input type="text" name="name" class="form-control" placeholder="Enter course category (e.g. Tech, Math)">
                @error('category')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-3">
                <input type="file" name="image">
                @error('image')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-3" style="text-align:right">
                <button type="submit" href="/admin/promo/create" class="btn btn-primary btn-user">Create New Category</button>
            </div>
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!-- Main Table -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($course_categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset($category->image) }}" class="img-fluid" style="width:6vw;height:6vw;border-radius:10px" alt="Interest">
                                                    <br> <br> Click button below to update image <br>
                                                    <input type="file" name="image-{{ $category->id }}" form="courseCategoryUpdateForm{{ $category->id }}" accept=".jpeg,.jpg,.png">
                                                    @error('image-' . $category->id)
                                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" name="category-{{ $category->id }}" class="form-control" value="{{ $category->category }}" form="courseCategoryUpdateForm{{ $category->id }}" required>
                                                    @error('category-' . $category->id)
                                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </td> 
                                                <td>
                                                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                            <form id="courseCategoryUpdateForm{{ $category->id }}" action="{{ route('admin.course-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <div style="padding: 0px 2px;">
                                                                    <button class="d-sm-inline-block btn btn-info shadow-sm" type="submit">Update</button>
                                                                </div>
                                                            </form>
                                                            <form action="" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <div style="padding: 0px 2px">
                                                                    <button class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
