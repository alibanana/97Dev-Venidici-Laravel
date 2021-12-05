@extends('./layouts/client-main')
@section('title', 'Venidici Bootcamp Hiring Partner Profile')

@section('content')


<!-- START OF POPUP CHANGE PASSWORD-->
<div id="change-password" class="overlay" style="overflow:scroll">
    <div class="popup-change-pass" id="change-pass-mobile " style="width:40%" >
        <a class="close"  href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            @if (session()->has('success'))
                <div class="p-3 mt-2 mb-0">
                    <div class="alert alert-success alert-dismissible fade show small-text"  style="text-align:center;margin-bottom:1vw;width:20vw"role="alert">
                    {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @elseif (session()->has('danger'))
                <div class="p-3 mt-2 mb-0">
                    <div class="alert alert-danger alert-dismissible fade show m-0" role="alert" style="font-size: 18px">
                        {{ session('danger') }}
                    </div>
                </div>
            @endif
            <form action="{{ route('job-portal.change-password') }}" method="post">
                @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Change Password</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-12" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Old Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt popup-krest-font"></i>
                            <input type="password" placeholder="Insert Old Password" name="old_password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" >
                        </div>  
                        @error('old_password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">New Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt popup-krest-font"></i>
                            <input type="password" placeholder="Insert New Password" name="password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" >
                        </div>  
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Confirm New Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt popup-krest-font"></i>
                            <input type="password" placeholder="Confirm New Password" name="password_confirmation" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%">
                        </div>  
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12" style="text-align:right;padding-top:3vw">
                        <button onclick="openLoading()" type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Update Password</button>
                    </div>  
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP CHANGE PASSWORD-->

<!-- START OF BANNER SECTION -->
<div class="row m-0 page-container "
    style="padding-bottom:8vw; padding-top: 14vw ;background-color:#2B6CAA">
    @if(Auth::user()->email_verified_at == null)
    <div class="col-12 wow bounce" id="job-portal-profile-mobile-dashboard-alert" style="height:3.5vw;display:flex;justify-content:center;margin-bottom:2vw">
        <!-- ALERT MESSAGE -->
        <div class="alert alert-warning alert-dismissible fade show small-text" id="job-portal-profile-mobile-dashboard-alert-width"  style="width:60%;text-align:center;margin-bottom:0px"role="alert">
            @if(session('new_email_verification_sent'))
            Email verifikasi baru telah dikirim. Belum dapat? 
            @else
            Beberapa fitur tidak tersedia jika email belum ter-verifikasi. Belum dapat? 
            @endif
            <span style="display: inline-block;">
                <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" onclick="openLoading()" style="background: none;border:none;color:#2B6CAA">
                    Kirim ulang email
                </button>
                </form>
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
    @endif
    <div class="col-md-12 p-0 wow fadeInUp" data-wow-delay="0.3s">
        <div class="row m-0">
            <div class="col-12" style="display:flex;justify-content:center;padding:0vw 17vw" id="padding-job-portal-mobile-dashboard">
                <div class="card-white wow fadeInUp" data-wow-delay="0.3s" style="height:auto;padding:1.5vw 1.5vw;width:100%;display:flex;align-items:center">
                    <img src="/assets/images/client/Default_Display_Picture.png" style="width:14vw;height:10vw;object-fit:cover;border-radius:10px" class="img-fluid desktop-display" alt="DISPLAY PICTURE">
                    <div style="margin-left:1.5vw;width:100%;">
                        <div style="display:flex;justify-content:space-between;">
                            <p class="sub-description" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">{{auth()->user()->name}}</p> 
                            <div class="dropdown show">
                                
                                <a class="small-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                <!--<a class="small-heading" style="color:grey;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>-->


                                <div class="dropdown-menu" id="drop-down-menu-mobile-job-portal" aria-labelledby="editDropdown" style="border-radius:10px;padding:0px;width:14vw">

                                    <div class="edit-item">
                                        <a href="#change-password" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-unlock-alt"></i> <span style="margin-left:0.87vw">Change Password</span></a>   
                                    </div>
                                    <div class="edit-item" style="border-radius:0px 0px 10px 10px">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" style="background:none;border:none">
                                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-sign-out-alt"></i> <span style="margin-left:0.84vw">Log out</span></p>   
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">{{auth()->user()->email}}</p>   
                        <p class="normal-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">{{auth()->user()->companyName}}</p>   


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- END OF BANNER SECTION -->



<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

@endsection