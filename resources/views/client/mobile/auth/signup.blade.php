@extends('./layouts/client-main')

@section('title', 'Venidici Sign Up')
@section('content')

<div class="row m-0">
    <div class="col-12 p-0">
        <div class="" style="width:100vw;padding-bottom:4vw !important">
            <div style="display:flex;justify-content:space-between;padding:9vw 0vw 0vw 4vw">
                <a href="/login" class="" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#CE3369;text-decoration:none;font-size:4vw"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">Login</span></a>
                <!--<a href="/signup-interests" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none">Your interests<i style="margin-left:0.5vw" class="fas fa-arrow-right"></i></a>-->
            </div>
            <form action="{{ route('custom-auth.signup_general_info.index') }}" method="POST">
            @csrf   
                <div class="row m-0">
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:25vw;padding-top:2vw" alt="LOGO">
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
                        <p style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:0px;font-size:4vw">General Information</p>
                    </div>
                    <div class="col-12" style="padding-left:5vw">
                        <p class="" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw;font-size:3vw">Full Name</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center;padding:3vw 2vw">
                            <i style="color:#DAD9E2;font-size:4vw" class="fas fa-user"></i>
                            <input value="{{Session::get('name')}}" type="text" name="name" class="" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:3vw;color: #5F5D70;width:100%;font-size:4vw" placeholder="John Doe">
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw;font-size:3vw">Phone Number</p>
                        <div  class="auth-input-form" style="display: flex;align-items:;padding:3vw 2vw">
                            <i style="color:#DAD9E2;font-size:4vw;padding-top:0.5vw" class="fas fa-phone-alt"></i>
                            <input value="{{Session::get('telephone')}}" type="text" name="telephone" class="" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:3vw;color: #5F5D70;width:100%;font-size:4vw" placeholder="+62812345678">
                        </div>  
                        @error('telephone')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw;font-size:3vw">How do you know venidici?</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center;padding:3vw 2vw">
                            <i style="color:#DAD9E2;font-size:4vw" class="fas fa-user-friends"></i>
                            <select name="response" id=""  class=""  style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%;font-size:4vw">
                                <option value="Friend" @if(Session::get('response') == 'Friend') selected @endif>Friend</option>
                                <option value="Instagram" @if(Session::get('response') == 'Instagram') selected @endif>Instagram</option>
                                <option value="Instagram" @if(Session::get('response') == 'Other') selected @endif>Other</option>
                            </select>
                        </div> 
                        @error('response')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                        <p class="" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw;width:100%;font-size:3vw">Email Address</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center;padding:3vw 2vw">
                            <i style="color:#DAD9E2;font-size:4vw" class="fas fa-envelope"></i>
                            <input value="{{Session::get('email')}}" type="text" name="email" class="" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:3vw;color: #5F5D70;width:100%;font-size:4vw" placeholder="johndoe@gmail.com">
                        </div>  
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw;font-size:3vw">Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center;padding:3vw 2vw">
                            <i style="color:#DAD9E2;font-size:4vw;" class="fas fa-lock"></i>
                            <input type="password" name="password" class="" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:3vw;color: #5F5D70;width:100%;font-size:4vw;" placeholder="********">
                        </div>  
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw;font-size:3vw">Referral Code</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center;padding:3vw 2vw">
                            <i style="color:#DAD9E2;font-size:4vw" class="fas fa-user-friends"></i>
                            <input value="{{Session::get('referral_code')}}" type="text" name="referral_code" class="" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%;font-size:4vw" placeholder="GRX45">
                        </div>  
                        @error('referral_code')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>         
                    <div class="col-12 p-0" style="text-align:center;margin-top:3vw">
                        <button type="submit"  class="btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;font-size:4vw;width:90%">Next</button>
                    </div>  
                    <!-- END OF RIGHT SECTION -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection