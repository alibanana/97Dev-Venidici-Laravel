@extends('./layouts/client-main')

@section('title', 'Venidici Sign Up')
@section('content')

<div class="row m-0 auth-background">
    <div class="col-12 p-0">
        <div class="centered white-modal-signup" style="width:70vw;padding-bottom:4vw !important">
            <div style="display:flex;justify-content:space-between">
                <a href="/login" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#CE3369;text-decoration:none"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">Login</span></a>
                <!--<a href="/signup-interests" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none">Your interests<i style="margin-left:0.5vw" class="fas fa-arrow-right"></i></a>-->
            </div>
            <form action="{{ route('custom-auth.signup_general_info.store') }}" method="POST">
            @csrf   
                <div class="row m-0">
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                    </div>
                    @if (session()->has('message'))
                    <div class="col-12" style="padding:1vw 3vw">
                        <div class="mb-0">
                            <div class="alert alert-warning alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                                {{ session()->get('message') }}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12" style="text-align:left;padding-left:5vw">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:0px">General Information</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-6" style="padding-left:5vw">
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
                    <div class="col-6" style="padding-right:5vw">
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
                        <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Next</button>
                    </div>  
                    <!-- END OF RIGHT SECTION -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection