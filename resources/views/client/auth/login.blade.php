@extends('./layouts/client-main')

@section('title', 'Venidici Sign In')
@section('content')

<div class="row m-0">
    <div class="col-md-12 p-0" >
        <div class="container-modal" style="display:flex;margin:0vw !important;height:100%;overflow:auto;">
            <img src="/assets/images/client/Auth_BG.png" style="height:100vh;overflow:auto;width:100%;object-fit:cover"alt="">

            <div class="centered white-modal">
                <div style="text-align:right">
                    <a href="/login" class="normal-text navbar-item" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA">Sign Up <i style="margin-left:0.5vw" class="fas fa-arrow-right"></i></a>
                </div>
                <img src="/assets/images/client/logo-transparent.png" class="img-fluid" style="width:8vw" alt="LOGO">
                <div class="row m-0" style="align-items:center">
                    <div class="col-4 p-0">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;margin-bottom:0px">Email Address</p>
                    </div>
                    <div class="col-8 p-0">
                        <div  class="auth-input-form" style="display: flex;align-items:center;margin-left:1vw">
                            <img src="/assets/images/icons/person.svg" style="width:auto;height:1vw" class="img-fluid" alt="">
                            <input type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:100%" placeholder="Insert email">
                        
                        </div>  
                    </div>
                    <div class="col-4 p-0" style="margin-top:1vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;margin-bottom:0px">Password</p>
                    </div>
                    <div class="col-8 p-0" style="margin-top:1vw">
                        <div  class="auth-input-form" style="display: flex;align-items:center;margin-left:1vw">
                            <img src="/assets/images/icons/lock-icon.svg" style="width:auto;height:1vw" class="img-fluid" alt="">
                            <input type="password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:100%" placeholder="Insert password">
                        </div>  
                    </div>
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Sign In</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection