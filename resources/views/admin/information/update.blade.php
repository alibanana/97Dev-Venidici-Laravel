@extends('layouts/admin-main')

@section('title', 'Venidici Update Information')

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
            <h2 class="mb-0 mb-3 text-gray-800">Update Information</h2>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="{{ route('admin.informations.update', $notification->id) }}" method="POST" >
        @csrf      
        @method('put')        
     
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control form-control-user"
                        id="title" aria-describedby=""  required
                        placeholder="Here insert information title" value="{{$notification->title}}"> 
                    @error('title')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link</label>
                    <input type="text" name="link" class="form-control form-control-user"
                        id="link" aria-describedby="" 
                        placeholder="Here insert information link" value="{{$notification->link}}"> 
                    @error('link')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Information</label>
                    <textarea name="description" id="" rows="10" class="form-control" placeholder="here insert information">{{$notification->description}}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div style="display:flex;justify-content:flex-end">
                    <button type="submit"  class="btn btn-primary btn-user p-3">Update Information</button>
                </div>

            </div>

        </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
