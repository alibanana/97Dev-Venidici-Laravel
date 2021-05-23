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
            <h3 class="mb-0 mb-3 text-gray-800"><span style="font-style:italic">{{ $content->section->course->title }}</span> -> <span style="font-style:italic">{{ $content->section->title }}</span> -> {{ $content->title }}</h3>
        </div>
        
        <!-- Content Row -->

        <!-- start of form -->
        <form action="{{ route('admin.section-contents.update', $content->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
            <div class="row">
                <div class="col-6">
                    <h6 class="modal-title" id="exampleModalLabel">Embed Youtube Link (src only)</h6>
                    <div class="form-group mt-2">
                        <input type="text" name="youtube_link" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="e.g. https://www.youtube.com/embed/DSJlhjZNVpg"
                            value="{{ old('youtube_link', $content->youtube_link) }}" required>
                        @error('youtube_link')
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
                        <textarea name="description" id="" rows="4" class="form-control">{{ old('description', $content->description) }}</textarea>
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
                        <input type="number" name="duration" class="form-control form-control-user"
                            id="phone" aria-describedby="" value="{{ old('duration', $content->duration) }}"
                            placeholder="e.g. 60" > 
                        @error('duration')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit" class="btn btn-primary btn-user p-3" onclick="return confirm('Are you sure you want to update this content?')">Update Content</button>
                    </div>
                </div>

            </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
