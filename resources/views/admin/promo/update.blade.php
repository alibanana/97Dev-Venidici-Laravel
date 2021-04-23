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
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 mb-3 text-gray-800">Update Promo Code</h2>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="/admin/trusted-companies" method="POST" enctype="multipart/form-data">
        @csrf           
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Promo Code</label>
                    <input type="text" name="name" class="form-control form-control-user"
                        id="phone" aria-describedby=""
                        placeholder="Here insert promo code (e.g. GRX45)" value="GRX45" > 
                    @error('name')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Discount</label>
                    <input type="text" name="name" class="form-control form-control-user"
                        id="phone" aria-describedby=""
                        placeholder="Here insert discount amount (e.g. 40%)" value="40%" > 
                    @error('name')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Start Date</label>
                    <input type="text" name="date" class="form-control form-control-user"
                        id="phone" aria-describedby=""
                        placeholder="Here insert date start (e.g. 20 Februari 2021)" value="20/01/2021"> 
                    @error('date')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Finish Date</label>
                    <input type="text" name="date" class="form-control form-control-user"
                        id="phone" aria-describedby=""
                        placeholder="Here insert date finished (e.g. 21 Februari 2021)" value="21/01/2021"> 
                    @error('date')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div style="display:flex;justify-content:flex-end">
                    <button type="submit"  class="btn btn-primary btn-user p-3">Update Promo Code</button>
                </div>

            </div>

        </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
