@extends('layouts/admin-main')

@section('title', 'Venidici Menjadi Pengajar')

@section('container')

<!-- Main Content --> 
<div id="content" style="background-color:#FFFFFF">

    <x-adminTopbar />   
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
            <h2 class="mb-0 mb-3 text-gray-800">Create New Admin</h2>
            <!--<a href="/admin/promo/create" class="btn btn-primary btn-user p-3">Create New Promo Code</a>-->

        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                
                <form action="{{ route('custom-auth.signup_general_info.store') }}" method="POST">
                @csrf  
                
                    <div class="row m-0">
                        @if (session()->has('message'))
                        <div class="col-12" style="padding:1vw 3vw  ">
                            <div class="mb-0">
                                <div class="alert alert-warning alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                                    {{ session()->get('message') }}
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-12" style="text-align:left;">
                            <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:0px">General Information</p>
                        </div>
                        <!-- START OF LEFT SECTION -->
                        <div class="col-6" style="">
                            <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                            <div  class="auth-input-form" style="display: flex;align-items:center">
                                <i style="color:#DAD9E2" class="fas fa-user"></i>
                                <input value="{{Session::get('name')}}" type="text" name="name" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="John Doe">
                            </div>  
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Phone Number</p>
                            <div  class="auth-input-form" style="display: flex;align-items:center">
                                <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                                <input value="{{Session::get('telephone')}}" type="text" name="telephone" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="Insert phone number">
                            </div>  
                            @error('telephone')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">How do you know venidici?</p>
                            <div  class="auth-input-form" style="display: flex;align-items:center">
                                <i style="color:#DAD9E2" class="fas fa-user-friends"></i>
                                <select name="response" id=""  class="normal-text"  style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%">
                                    <option value="Friend" @if(Session::get('response') == 'Friend') selected @endif>Friend</option>
                                    <option value="Instagram" @if(Session::get('response') == 'Instagram') selected @endif>Instagram</option>
                                    <option value="Other" @if(Session::get('response') == 'Other') selected @endif>Other</option>
                                </select>
                            </div> 
                            @error('response')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div> 
                        <!-- END OF LEFT SECTION --> 
                        <!-- RIGHT SECTION -->
                        <div class="col-6" style="">
                            <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw;width:100%">Email Address</p>
                            <div  class="auth-input-form" style="display: flex;align-items:center">
                                <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                                <input value="{{Session::get('email')}}" type="text" name="email" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="johndoe@gmail.com">
                            </div>  
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Password</p>
                            <div  class="auth-input-form" style="display: flex;align-items:center">
                                <i style="color:#DAD9E2" class="fas fa-lock"></i>
                                <input type="password" name="password" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="********">
                            </div>  
                            @error('password')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Referral Code</p>
                            <div  class="auth-input-form" style="display: flex;align-items:center">
                                <i style="color:#DAD9E2" class="fas fa-user-friends"></i>
                                <input value="{{Session::get('referral_code')}}" type="text" name="referral_code" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="Insert Referral Code">
                            </div>  
                            @error('referral_code')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 p-0" style="text-align:center;margin-top:3vw">
                            <button name="action" value="create_admin" type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Next</button>
                            <!-- <a href="/admin/signup-interests">Next</a> -->
                        </div>  
                        <!-- END OF RIGHT SECTION -->
                    </div>
                <!--</form>-->

                </div>
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
