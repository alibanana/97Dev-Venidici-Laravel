@extends('layouts/admin-main')

@section('title', 'Venidici Create Hashtag')

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
            <h2 class="mb-0 mb-3 text-gray-800">Update Hashtag ({{ $tag->hashtag }})</h2>
        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="{{ route('admin.hashtags.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')           
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <img src="{{ asset($tag->image) }}" class="img-fluid" style="width:6vw;height:6vw;border-radius:10px" alt="Interest">
                        <br> <br>
                        <label for="">Click button below to change image</label> <br>
                        <input type="file" name="image" accept=".jpeg,.jpg,.png" > 
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
                        <input type="text" name="hashtag" class="form-control form-control-user"
                            id="phone" aria-describedby="" required
                            placeholder="Here insert hashtag name (e.g. Tech)" value="{{ old('hashtag', $tag->hashtag) }}" > 
                        @error('hashtag')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Color</label>
                        <input type="text" name="color" class="form-control form-control-user"
                            id="" aria-describedby="" required
                            placeholder="Here insert color hex code (e.g. FFFFFF)" value="{{ old('color', $tag->color) }}"> 
                        @error('color')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit"  class="btn btn-primary btn-user p-3">Update Hashtag</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- end of form -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
