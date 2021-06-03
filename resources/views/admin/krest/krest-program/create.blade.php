@extends('layouts/admin-main')

@section('title', 'Venidici Create Krest Program')

@section('container')

<!-- Main Content -->
<div id="content">

    <x-AdminTopbar />   
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
            <h2 class="mb-0 mb-3 text-gray-800">New Krest Program</h2>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="{{ route('admin.krest_programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf           
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Thumbnail</label> <br>
                    <input type="file" name="thumbnail" accept=".jpeg,.jpg,.png" required> 
                    @error('thumbnail')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Program Title</label> 
                    <input type="text" name="program" class="form-control form-control-user"
                        id="program" aria-describedby=""
                        placeholder="Here insert program title" > 
                    @error('code')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Program Category</label>
                    <input type="text" name="category" class="form-control form-control-user"
                        id="category" aria-describedby=""
                        placeholder="Here insert program category (e.g. Personal Development)" > 
                    @error('category')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Program Description</label>
                    <textarea name="description" class="form-control" id="" rows="5" placeholder="Here insert program description"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div style="display:flex;justify-content:flex-end">
                    <button type="submit"  class="btn btn-primary btn-user p-3">Create New Krest Program</button>
                </div>
            </div>

        </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
