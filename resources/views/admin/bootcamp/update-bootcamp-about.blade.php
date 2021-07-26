@extends('layouts/admin-main')

@section('title', 'Venidici Update Bootcamp About')

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
            <h3 class="mb-0 mb-3 text-gray-800"><span style="font-style:italic">Update Bootcamp About</h3>
        </div>

        <!-- Content Row -->

        <!-- start of form -->
        <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Thumbnail</label> <br>
                        <img src="" alt="Thumbnail not available.." style="width:14vw;" class="img-fluid">
                        <br>
                        <br>
                        Click button below to update image
                        <input type="file" name="thumbnail" aria-describedby="" accept=".jpg,,jpeg,.png"> 
                        @error('thumbnail')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <h6 class="modal-title" id="exampleModalLabel">Title</h6>
                    <div class="form-group mt-2">
                        <input type="text" name="title" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="e.g. Introduction to course"
                            value="title" required>
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>  
                <div class="col-12">
                    <h6 class="modal-title" id="exampleModalLabel">Description</h6>
                    <div class="form-group mt-2">
                        <textarea name="description" id="" rows="5" class="form-control" required>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt quibusdam repellendus laborum porro nisi at recusandae cum quos a vitae delectus exercitationem, officiis dignissimos beatae, veritatis quidem adipisci eius harum!</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit" class="btn btn-primary btn-user p-3" onclick="return confirm('Are you sure you want to update this content?')">Update About</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- end of form -->
    

    </div>
    <!-- /.container-fluid -->
</div>
@endsection
