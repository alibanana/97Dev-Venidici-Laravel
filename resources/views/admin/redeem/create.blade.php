@extends('layouts/admin-main')

@section('title', 'Venidici Create Redeem Rule')

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
            <h2 class="mb-0 mb-3 text-gray-800">New Redeem Rule</h2>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="{{ route('admin.redeems.store') }}" method="POST" >
        @csrf           
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Stars Needed</label>
                    <input type="text" name="stars" class="form-control form-control-user"
                        id="stars" aria-describedby=""
                        placeholder="Here insert stars needed (e.g. 100)" > 
                    @error('stars')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Promo Type</label>
                    <select name="type" id="" class="form-control">
                        <option value="" selected disabled>Please select promo type</option>
                        <option value="nominal">Nominal</option>
                        <option value="percent">Percent</option>
                    </select>
                    @error('type')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Promo For</label>
                    <select name="promo_for" id="" class="form-control">
                        <option value="" selected disabled>Please select promo for</option>
                        <option value="price">Price</option>
                        <option value="shipping">Shipping</option>
                        <option value="charity">Charity</option>

                    </select>
                    @error('promo_for')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Discount</label>
                    <input type="text" name="discount" class="form-control form-control-user"
                        id="discount" aria-describedby=""
                        placeholder="Here insert discount amount (e.g. 40 for percent or 10000 for nominal)" > 
                    @error('discount')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div style="display:flex;justify-content:flex-end">
                    <button type="submit"  class="btn btn-primary btn-user p-3">Create New Redeem Rule</button>
                </div>

            </div>

        </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
