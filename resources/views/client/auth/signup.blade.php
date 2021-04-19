@extends('./layouts/client-main')

@section('title', 'Venidici Sign Up')
@section('content')

<div class="row m-0">
    <div class="col-md-12 p-0" style="background: radial-gradient(100% 313.25% at 0% 0%, #2B6CAA 0%, #67BBA3 100%);backdrop-filter: blur(20px);;height:100vh">
        <div class="centered white-modal-signup" style="width:65vw;padding-bottom:4vw !important">
            <div style="display:flex;justify-content:space-between">
                <a href="/" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#CE3369;text-decoration:none"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">Product Detail</span></a>
                <a href="/login" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none">Already have an account?<i style="margin-left:0.5vw" class="fas fa-arrow-right"></i></a>
            </div>
            <form action="">
                <div class="row m-0">
                    <div class="col-6" style="padding:1vw 4vw;">
                        <div style="text-align:center;">
                            <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                            <div  class="auth-input-form" style="display: flex;align-items:center;margin-top:1vw">
                                <img src="/assets/images/icons/person.svg" style="width:auto;height:1vw" class="img-fluid" alt="">
                                <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                            <div  class="auth-input-form" style="display: flex;align-items:center;margin-top:1vw">
                                <img src="/assets/images/icons/person.svg" style="width:auto;height:1vw" class="img-fluid" alt="">
                                <input type="text" name="telephone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="Phone Number">
                                @error('telephone')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                            <div  class="auth-input-form" style="display: flex;align-items:center;margin-top:1vw">
                                <img src="/assets/images/icons/person.svg" style="width:auto;height:1vw" class="img-fluid" alt="">
                                <input type="text" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                            <div  class="auth-input-form" style="display: flex;align-items:center;margin-top:1vw">
                                <img src="/assets/images/icons/lock-icon.svg" style="width:auto;height:1vw" class="img-fluid" alt="">
                                <input type="password" name="password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                            <div  class="auth-input-form" style="display: flex;align-items:center;margin-top:1vw">
                                <img src="/assets/images/icons/person.svg" style="width:auto;height:1vw" class="img-fluid" alt="">
                                <input type="text" name="referral_code" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="Referral Code">
                                @error('referral_code')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                            <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;margin-top:2vw">Sign Up</button>
                        </div>
                    </div>   
                    <div class="col-6" style="padding-right:3vw;padding-top:5vw;display: flex;flex-direction: column;justify-content: center;">
                        <p class="big-heading" style="font-family:Rubik Medium;color:#55525B;">Mari kita sambut Indonesia <span style="font-family:Hypebeast;color:#F4C257;font-size:3.5vw !important;line-height:1vw">EMAS!</span> </p>
                        <img src="/assets/images/client/Sign_Up_Illustration.png" class="img-fluid" style="width:100%;height:auto" alt="">
                    </div> 
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection