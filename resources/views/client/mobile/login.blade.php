@extends('./layouts/client-main')

@section('title', 'Venidici Log In')
@section('content')

<div class="row m-0">
    <!--
    <div class="col-md-12 p-0" style="background: radial-gradient(100% 313.25% at 0% 0%, #67BBA3 0%, #A24A9C 100%);backdrop-filter: blur(20px);height:100vh">
    -->
    <div class="col-12 p-0">
        <form action="{{ route('login') }}" method="POST">
        @csrf
            <div class="row m-0">
                <div class="col-12" style="padding:0vw 4vw;display: flex;flex-direction: column;justify-content: center;">
                    <div style="text-align:center">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:15vw" alt="LOGO">
                        <p style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:3vw;font-size:4vw">Email Address</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center;padding:2vw">
                            <i style="color:#DAD9E2;font-size:4vw" class="fas fa-envelope"></i>
                            <input type="text" name="email" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:4vw;color: #5F5D70;width:100%;font-size:4vw" placeholder="johndoe@gmail.com" value="{{ old('email') }}">
                        </div>  
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="display: block !important;text-align:left !important">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p  style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:3vw;font-size:4vw">Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center;padding:2vw">
                            <i style="color:#DAD9E2;font-size:4vw" class="fas fa-lock"></i>
                            <input type="password" name="password"  style="font-family:Rubik Regular;background:transparent;border:none;margin-left:4vw;color: #5F5D70;width:100%;font-size:4vw" placeholder="Insert Password">
                        </div> 
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;text-align:left !important">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div style="display:flex;justify-content:space-between;">
                            <button type="submit" class="btn-blue-bordered w-100" style="font-family: Poppins Medium;margin-bottom:0px;margin-top:2vw;font-size:4vw">Login</button>
                        </div>
                        <p  style="font-family:Rubik Medium;color:#5F5D70;margin-bottom:0.4vw;margin-top:3vw;margin-bottom:1vw;font-size:4vw">OR</p>
                        <a href="{{ route('login.google') }}"  style="font-family: Poppins Medium;margin-bottom:0px;margin-top:3vw;width:100%;display:inline-block;background-color:#67BBA3;border:none;color:#FFFFFF;border-radius:5px;padding:0.5vw 2vw;text-decoration:none;font-size:4vw"> <i class="fab fa-google"></i> <span style="margin-left:0.5vw">Login with Google Account</span></a>
                            <div style="text-align:center !important">
                        </div>
                        <p  style="font-family: Rubik Regular;margin-bottom:0px;margin-top:3vw;text-decoration:none;color: #3B3C43;font-size:3vw">Belum punya akun? <span> <a href="/signup">Daftar di sini</a> </span> </p>
                    </div>
                </div>   
            </div>
        </form>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection