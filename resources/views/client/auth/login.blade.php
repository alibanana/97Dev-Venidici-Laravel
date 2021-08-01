@extends('./layouts/client-main')

@section('title', 'Venidici Log In')
@section('content')

<!-- START OF POPUP VA EXPLANATION-->
<div id="forget-password" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:40vw">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12" style="text-align:left;">
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;">Lupa password?</p>
                    <form action="{{ route('custom-auth.reset-password') }}" method="POST">
                    @csrf
                        <div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px;margin-top:0.5vw"role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif (session('danger'))
                                <div class="alert alert-danger alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px;margin-top:0.5vw"role="alert">
                                    {{ session('danger') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div  class="auth-input-form" style="display: flex;align-items:center;width:100%">
                                <i style="color:#DAD9E2" class="fas fa-user"></i>
                                <input type="text" name="email" class="normal-text" required
                                    style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%"
                                    placeholder="Enter your registered email">
                            </div>  
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div style="text-align:right;margin-top:1vw">
                                <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Kirim Email</button>                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF POPUP VA EXPLANATION-->

<div class="row m-0 auth-background">
    <!--
    <div class="col-md-12 p-0" style="background: radial-gradient(100% 313.25% at 0% 0%, #67BBA3 0%, #A24A9C 100%);backdrop-filter: blur(20px);height:100vh">
    -->
    <div class="col-12 p-0">

            <div class="centered white-modal" style="width:65vw;padding-bottom:4vw">
                <div style="display:flex;justify-content:space-between">
                    <a href="/" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#CE3369;text-decoration:none"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">Home</span></a>
                    <!--<a href="/signup" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none">Sign up<i style="margin-left:0.5vw" class="fas fa-arrow-right"></i></a>-->
                </div>
                <form action="{{ route('login') }}" method="POST">
                @csrf
                    <div class="row m-0">
                        <div class="col-6" style="padding-left:3.5vw;padding-top:5vw">
                            <p class="big-heading" style="font-family:Rubik Medium;color:#55525B;">Mari kita sambut Indonesia <span style="font-family:Hypebeast;color:#F4C257;font-size:3.5vw !important;line-height:1vw">EMAS!</span> </p>
                            <img src="/assets/images/client/Login_Image.png" class="img-fluid" style="width:100%;height:18vw;object-fit:cover" alt="">
                        </div>   
                        <div class="col-6" style="padding:0vw 4vw;display: flex;flex-direction: column;justify-content: center;">
                            <div style="text-align:center">
                                <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                                @if (session('email-verification-success'))
                                    <div class="alert alert-success alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px;margin-top:0.5vw"role="alert">
                                        Your email <span style="font-weight: bold">{{session('email-verification-success') }}</span> has been verified!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Email Address</p>
                                <div  class="auth-input-form" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                                    <input type="text" name="email" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="johndoe@gmail.com" value="{{ old('email') }}">
                                </div>  
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;text-align:left !important">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Password</p>
                                <div  class="auth-input-form" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-lock"></i>
                                    <input type="password" name="password" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="*******">
                                </div> 
                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;text-align:left !important">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div style="display:flex;justify-content:space-between;">
                                    <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered w-100" style="font-family: Poppins Medium;margin-bottom:0px;margin-top:2vw">Login</button>
                                </div>
                                <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;margin-bottom:0.4vw;margin-top:1vw;margin-bottom:1vw">OR</p>
                                <a href="{{ route('login.google') }}" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;width:100%;display:inline-block;background-color:#67BBA3;border:none;color:#FFFFFF;border-radius:5px;padding:0.5vw 2vw;text-decoration:none"> <i class="fab fa-google"></i> <span style="margin-left:0.5vw">Login with Google Account</span></a>
                                    <div style="text-align:center !important">
                                </div>
                                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;margin-top:1vw;text-decoration:none;color: #3B3C43;">Belum punya akun? <span> <a href="{{ route('custom-auth.signup_general_info.index') }}">Daftar di sini</a> </span> </p>
                                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;margin-top:1vw;text-decoration:none;color: #3B3C43;cursor:pointer"><span> <a href="#forget-password">Lupa Password</a> </span> </p>
                            </div>
                            <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;margin-bottom:0.4vw;margin-top:1vw;margin-bottom:1vw">OR</p>
                            <a href="{{ route('login.google') }}" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;width:100%;display:inline-block;background-color:#67BBA3;border:none;color:#FFFFFF;border-radius:5px;padding:0.5vw 2vw;text-decoration:none"> <i class="fab fa-google"></i> <span style="margin-left:0.5vw">Login with Google Account</span></a>
                                <div style="text-align:center !important">
                            </div>
                            <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;margin-top:1vw;text-decoration:none;color: #3B3C43;">Belum punya akun? <span> <a href="{{ route('custom-auth.signup_general_info.index') }}">Daftar di sini</a> </span> </p>
                            <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;margin-top:1vw;text-decoration:none;color: #3B3C43;cursor:pointer"><span> <a href="#forget-password">Lupa Password</a> </span> </p>
                        </div>
                    </div>   
                </div>
            </form>
            <!--
            <div style="display:flex;justify-content:flex-end;margin-top:2vw;padding-bottom:3vw">
                <a href="/signup" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none">Belum punya akun? Daftar sekarang<i style="margin-left:0.5vw" class="fas fa-arrow-right"></i></a>
            </div>
            -->
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection