@extends('layouts/admin-main')

@section('title', 'Venidici Create Assesment')

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
            <h2 class="mb-0 mb-3 text-gray-800">New Assesment</h2>

        </div>
        <div class="d-sm-flex align-items-center mb-2">
            <h5 class="mb-0 mb-3 course-link course-link-active" style="cursor:pointer">Basic Informations</h5>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="/admin/online-courses" method="POST" enctype="multipart/form-data">
        @csrf           
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control form-control-user"
                            id="phone" aria-describedby=""
                            placeholder="Enter assesment title" > 
                        @error('title')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Category</label>
                        <input type="text" name="category" class="form-control form-control-user"
                            id="phone" aria-describedby=""
                            placeholder="Enter assesment category" > 
                        @error('category')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Duration (minutes)</label>
                        <input type="text" name="duration" class="form-control form-control-user"
                            id="phone" aria-describedby=""
                            placeholder="e.g. 10" > 
                        @error('duration')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Description</label> <br>
                        <textarea name="description" id="" class="form-control" rows="5"></textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <label for="">Student's Requirements</label>
                    <div>
                        <div class="row" id="requirement_duplicator">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="requirement[]" class="form-control form-control-user" id="" cols="30" rows="2" placeholder="Enter Student Requirement"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add_requirement" onlick="duplicateRequirement()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more requirement</button> 

                </div>
                <div class="col-12" style="padding:2vw 1vw">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit"  class="btn btn-primary btn-user p-3">Create New Assessment</button>
                    </div>
                </div>

            </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>

@endsection
