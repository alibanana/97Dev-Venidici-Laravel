@extends('layouts/admin-main')

@section('title', 'Venidici Bootcamp Category')

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
            <h1 class="mb-0 mb-3 text-gray-800">Bootcamp Category</h1>
        </div>
        
        <!-- Content Row -->

        <!-- start of table -->
        <div class="row">
            <div class="col-6">
                <input type="text" name="category" class="form-control" placeholder="Enter course category (e.g. Tech, Math)" form="courseCategoryStoreForm" required>
                @error('category')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-3" style="text-align:right">
                <form id="courseCategoryStoreForm" action="{{ route('admin.course-categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <button type="submit" class="btn btn-primary btn-user">Create New Category</button>
                </form>
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
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <input type="text" name="category-1" class="form-control" value="Category" form="courseCategoryUpdateForm1" required>
                                                    @error('category-1')
                                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </td> 
                                                <td>
                                                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                                            <form id="courseCategoryUpdateForm1" action="" method="POST" enctype="multipart/form-data">
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
