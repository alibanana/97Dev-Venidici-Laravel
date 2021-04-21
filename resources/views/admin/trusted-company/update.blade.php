@extends('layouts/admin-main')

@section('title', 'Venidici Testimony CMS')

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
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0 mb-3 text-gray-800">Update Trusted Company</h2>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="/admin/trusted-companies" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')     
        <div class="row">
                
            <div class="col-6">
                <div class="form-group">
                    <div>
                        <label for="">Company Logo</label>
                    </div>
                    <!-- START OF UPLOADED IMAGE -->
                    <input type="file" name="image" accept="image/*">
                    @error('image')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <br>
                    <br>
                        <label for="">Current Image</label>
                        <br>
                    <img src="/assets/images/client/bca-bank.png" alt="Snow" style="width:10vw;margin-top:1vw">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control form-control-user"
                        id="phone" aria-describedby=""
                        placeholder="Here insert company name (e.g. BCA)" value="BCA"> 
                    @error('name')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div style="display:flex;justify-content:flex-end">
                    <button type="submit"  class="btn btn-primary btn-user p-3">Update Trusted Company</button>
                </div>

            </div>

        </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
