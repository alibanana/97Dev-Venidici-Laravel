@extends('layouts/admin-main')

@section('title', 'Venidici Update Art Supply')

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
            <h2 class="mb-0 mb-3 text-gray-800">Update Art Supply ({{ $artSupply->name }})</h2>
        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="{{ route('admin.art-supplies.update', $artSupply->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Current Image</label> <br>
                        <img src="{{ asset($artSupply->image) }}" style="width:8vw" alt="Image not available.."> <br>
                        <label for="">Click button below to update image</label> <br>

                        <input type="file" name="image" accept=".jpg,.jpeg,.png"> 
                        @error('image')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control form-control-user"
                            id="phone" aria-describedby="" value="{{ old('name', $artSupply->name) }}"
                            placeholder="Here insert art supply name" required> 
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" rows="4" class="form-control" required>{{ old('description', $artSupply->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit" class="btn btn-primary btn-user p-3">Update Art Supply</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
