@extends('./layouts/client-main')

@section('title', 'Venidici Log In')
@section('content')

<div class="row m-0">
    <div class="col-md-12 p-0" style="background: radial-gradient(100% 313.25% at 0% 0%, #67BBA3 0%, #A24A9C 100%);backdrop-filter: blur(20px);height:100vh">
        <div class="centered white-modal" style="width:65vw">
            <div style="display:flex;justify-content:space-between">
                <a href="/" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#CE3369;text-decoration:none"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">Home</span></a>
                <a href="/signup" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none">Sign up<i style="margin-left:0.5vw" class="fas fa-arrow-right"></i></a>
            </div>
            <form action="">
                <div class="row m-0">
                    <div class="col-md-6" style="padding-left:3.5vw;padding-top:5vw">
                        <p class="big-heading" style="font-family:Rubik Medium;color:#55525B;">Mari kita sambut Indonesia <span style="font-family:Hypebeast;color:#F4C257;font-size:3.5vw !important;line-height:1vw">EMAS!</span> </p>
                        <img src="/assets/images/client/Login_Image.png" class="img-fluid" style="width:100%;height:auto" alt="">
                    </div>   
                    <div class="col-md-6" style="padding:0vw 4vw;display: flex;flex-direction: column;justify-content: center;">
                        <div style="text-align:center">
                            <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                            <div  class="auth-input-form" style="display: flex;align-items:center;margin-top:1vw">
                                <img src="/assets/images/icons/person.svg" style="width:auto;height:1vw" class="img-fluid" alt="">
                                <input type="text" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;padding:0.5vw" placeholder="Email address">
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
                            <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;margin-top:2vw">Log In</button>
                        </div>
                    </div>   
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection