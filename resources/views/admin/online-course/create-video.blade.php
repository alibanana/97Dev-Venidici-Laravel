@extends('layouts/admin-main')

@section('title', 'Venidici Create Learning Video')

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
            <h3 class="mb-0 mb-3 text-gray-800">New Video for Lecture <span style="font-style:italic;border-bottom:2px solid grey">Materi</span>  in  <span style="font-style:italic">Sex Education</span> Course</h3>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="/admin/online-courses/1/update" method="POST" enctype="multipart/form-data">
        @csrf           
            <div class="row">
                <div class="col-6">
                    <h6 class="modal-title" id="exampleModalLabel">Embed Youtube Link (src only)</h6>
                    <div class="form-group mt-2">
                        <input type="text" name="video" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="e.g. https://www.youtube.com/embed/DSJlhjZNVpg">
                        @error('video')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <h6 class="modal-title" id="exampleModalLabel">Attachment</h6>
                    <div class="form-group mt-2">
                        <input type="file" name="attachment">
                        @error('attachment')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <h6 class="modal-title" id="exampleModalLabel">Description</h6>
                    <div class="form-group mt-2">
                        <textarea name="description" id="" rows="4" class="form-control">

                        </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Duration in seconds</label>
                        <input type="text" name="date" class="form-control form-control-user"
                            id="phone" aria-describedby=""
                            placeholder="e.g. 60" > 
                        @error('date')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit" class="btn btn-primary btn-user p-3">Add New Video</button>
                    </div>
                </div>

            </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
