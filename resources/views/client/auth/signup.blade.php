@extends('./layouts/client-main')

@section('title', 'Venidici Sign Up')
@section('content')

<div class="row m-0 auth-background">
    <div class="col-12 p-0">
        <div class="centered white-modal-signup" style="width:70vw;padding-bottom:4vw !important">
            <div style="display:flex;justify-content:space-between">
                <a href="/login" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#CE3369;text-decoration:none"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">Login</span></a>
                <a href="/signup-interests" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none">Your interests<i style="margin-left:0.5vw" class="fas fa-arrow-right"></i></a>
            </div>
            <form action="">
                <div class="row m-0">
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                    </div>
                    <div class="col-12" style="text-align:left;padding-left:5vw">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw">General Information</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-6" style="padding-left:5vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="John Doe">
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Phone Number</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                            <input type="text" name="telephone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="+62812345678">
                            @error('telephone')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">How do you know venidici?</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-friends"></i>
                            <select name="" id=""  class="normal-text"  style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw;width:100%">
                                <option value="">Friend</option>
                                <option value="">Instagram</option>
                            </select>
                        </div>  
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="padding-left:5vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email Address</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                            <input type="text" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="johndoe@gmail.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-lock"></i>
                            <input type="text" name="password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="********">
                            @error('password')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Referral Code</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-friends"></i>
                            <input type="text" name="referral_code" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="GRX45">
                            @error('referral_code')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                    <div class="col-12 p-0" style="text-align:center;margin-top:3vw">
                        <a href="/signup-interests" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Next</a>
                    </div>  
                    <!-- END OF RIGHT SECTION -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection