<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="Description" content="Platform anak kekinian buat naklukin karir impian! Anytime anywhere, Learn on your schedule from any device">

    <!-- INDEX CSS -->
    <link rel="stylesheet"  type="text/css"  href="/css/index.css">

    <!-- CSS -->
    
    <!-- <link rel="stylesheet" type="text/css" href="/dropzone-5.7.0/dist/min/dropzone.min.css"> -->

    <!-- JS -->
    <!-- <script src="/dropzone-5.7.0/dist/min/dropzone.min.js'" type="text/javascript"></script> -->

    <!--load all fontawesome -->
    <link href="/fontawesome/css/all.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- web icon    -->
    <link rel="shortcut icon" type="image/jpg" href="/assets/images/client/icon-transparent.png"/>
  
    <!-- wow js -->
    <link rel="stylesheet" href="/WOW-master/css/libs/animate.css">

    @env('production')
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-LC8WXP5NZZ"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-LC8WXP5NZZ');
      </script>
      <!-- Facebook Pixel Code -->
      <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '377781967128623');
        fbq('track', 'PageView');
      </script>
      <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=377781967128623&ev=PageView&noscript=1"/>
      </noscript>
      <!-- End Facebook Pixel Code -->
    @endenv
    

    <title>@yield('title')</title>

  </head>
  <body style="padding-right:0px !important">
    <!-- Modal Loading -->
    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog"  aria-labelledby="loadingModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="text-align:center;height:20vw">
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Mohon tunggu sebentar...</p>
                    <img src="/assets/images/client/loading.gif" style="width:4vw;height:4vw;object-fit:cover;border-radius:10px;margin-top:5vw" class="img-fluid" alt="Loading..">

                </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL Loading -->
    <!-- Contact Us Modal-->
    <div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title sub-description" style="font-family:Rubik Bold" id="exampleModalLabel">Contact Us</h5>
              </div>
              <div class="modal-body">
                <form action="{{route('admin.contact-us.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="row m-0">
                      <div class="col-12 p-0" style="text-align:center">
                        @if (session()->has('contact_us_message'))
                        <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  tyle="font-family:Rubik Regular"role="alert">
                            {{ session()->get('contact_us_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                      </div>
                      
                      <!-- START OF TOP SECTION -->
                      <div class="col-12">
                          <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;">Full Name</p>
                          <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                              <i style="color:#DAD9E2" class="fas fa-user"></i>
                              <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan nama anda" >
                          </div>  
                          @error('name')
                              <span class="invalid-feedback" role="alert" style="display: block !important;">
                              <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                          
                      </div> 
                      <!-- END OF TOP SECTION --> 
                      <!-- RIGHT SECTION -->
                      <div class="col-12">
                          <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
                          <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                              <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                              <input type="text" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan email" >
                          </div>  
                          @error('email')
                              <span class="invalid-feedback" role="alert" style="display: block !important;">
                              <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                          
                          
                      </div>
                      <!-- END OF RIGHT SECTION -->
                      <div class="col-12">
                          <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Inquiry</p>
                          <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                              <textarea name="inquiry" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan pesan anda" ></textarea>
                          </div>  
                          @error('inquiry')
                              <span class="invalid-feedback" role="alert" style="display: block !important;">
                              <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      
                      <div class="col-12" style="text-align:right;padding-top:1vw">
                          <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</button>
                      </div>  
                      
                      <!-- END OF GENNERAL INFORMATION -->
                  </div>
                </form>
              </div>
          </div>
      </div>
    </div>
    <!-- END OF CONTACT US MODAL -->

    <!-- START OF POP UP LOGIN -->
    <div class="modal fade" id="loginModal" tabindex="0" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-body">
                <form action="{{ route('login') }}" method="POST">
                @csrf
                    <div class="row m-0"> 
                        <div class="col-12" style="padding:0vw 4vw;display: flex;flex-direction: column;justify-content: center;">
                            <div style="text-align:center">
                                <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Email Address</p>
                                <div  class="auth-input-form" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-envelope normal-text"></i>
                                    <input type="text" name="email" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="johndoe@gmail.com" value="{{ old('email') }}">
                                </div>  
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;text-align:left !important">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Password</p>
                                <div  class="auth-input-form" style="display: flex;align-items:center">
                                    <i style="color:#DAD9E2" class="fas fa-lock normal-text"></i>
                                    <input type="password" name="password" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="*******">
                                </div> 
                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;text-align:left !important">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div style="display:flex;justify-content:space-between;">
                                    <input type="hidden" name="url" value="{{Request::url()}}">
                                    <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered w-100" style="font-family: Poppins Medium;margin-bottom:0px;margin-top:2vw">Login</button>
                                </div>
                                <!-- <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;margin-bottom:0.4vw;margin-top:1vw;margin-bottom:1vw">OR</p> -->
                                <!-- <a href="{{ route('login.google') }}" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;width:100%;display:inline-block;background-color:#67BBA3;border:none;color:#FFFFFF;border-radius:5px;padding:0.5vw 2vw;text-decoration:none"> <i class="fab fa-google"></i> <span style="margin-left:0.5vw">Login with Google Account</span></a>
                                    <div style="text-align:center !important">
                                </div> -->
                                <p class="normal-text" style="font-family: Rubik Regular;margin-top:1vw;text-decoration:none;color: #3B3C43;">Belum punya akun? <span> <a href="{{ route('custom-auth.signup_general_info.index') }}">Daftar di sini</a> </span> </p>
                            </div>
                        </div>   
                    </div>
                </form>
              </div>
          </div>
      </div>
    </div>
    <!-- END OF POP UP LOGIN -->
    <!-- <div style="padding:4vw;background-color:#2B6CAA;z-index:99;position:fixed;width:100%" class="sticky-top" id="mobile-navbar">

    </div> -->
    @if( !Request::is('login') )
      @if( !Request::is('signup') )
      @if( !Request::is('signup-interests') )
        @if( !Request::is('job-portal') )
        @if( !Request::is('job-portal/*') )
    <!-- START OF MOBILE NAVBAR -->
    <div class="row m-0 navbarMobile" style="background: #2B6CAA;padding:4vw 2vw 4vw 2vw;display:none;width:100%;z-index:999;
  top: 0;z-index: 10;">
      <div >
        <!--    Made by Erik Terwan    -->
        <!--   24th of November 2015   -->
        <!--        MIT License        -->
        <nav role="navigation" style="display: flex;justify-content:space-between;align-items:center">
          <div id="menuToggle">
            <!--
            A fake / hidden checkbox is used as click reciever,
            so you can use the :checked selector on it.
            -->
            <input type="checkbox" />
            
            <!--
            Some spans to act as a hamburger.
            
            They are acting like a real hamburger,
            not that McDonalds stuff.
            -->
            <span></span>
            <span></span>
            <span></span>
            

            <!-- <img src="/assets/Logo.png" alt="" clas> -->
            <!--
            Too bad the menu has to be inside of the button
            but hey, it's pure CSS magic.
            -->
            <ul id="menu">
              <!-- @if (Auth::check())
              <div class="row m-0">
                <div class="col-6 p-0">
                  <div style="text-align:left">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-blue-bordered" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:5vw">Log Out</button>
                    </form>
                  </div>
                  
                </div>
                
              </div>
              <br>
              @endif -->
              <!-- <a href="/login" class="btnSignUp" style="margin-bottom: 20px;">Login</a> -->
              <table id="menuKiri">
                <tr>
                  <td>
                  <a href="/" class="navbar-item @if(Request::is('/'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4.5vw">Home</a>
                  </td>
                </tr>
                <tr>
                  <td  style="padding-top:4vw">
                  <a href="/bootcamp" class="navbar-item @if( Request::is('bootcamp') || Request::is('bootcamp/*'))navbar-item-active @endif " style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4.5vw">Bootcamp</a>
                  </td>
                </tr>
                <tr>
                  <td  style="padding-top:4vw">
                  <a href="/for-public/online-course" class="navbar-item @if(Request::is('online-course/*') || Request::is('for-public/*') || Request::is('woki')|| Request::is('woki/*') || Request::is('online-course') || Request::is('online-course/*') )navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4.5vw">For Public</a>
                  </td>
                </tr>
                <!--
                <tr>
                  <td  style="padding-top:4vw">
                  <a href="/for-corporate/krest" class="navbar-item @if(Request::is('for-corporate/*'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4.5vw">For Corporate</a>
                  </td>
                </tr>
                -->
                <tr>
                  <td  style="padding-top:4vw">
                  <a href="/for-corporate/krest" class="navbar-item @if( Request::is('for-corporate') || Request::is('for-corporate/*'))navbar-item-active @endif " style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4.5vw">For Corporate</a>
                  </td>
                </tr>
                
                <tr>
                  <td  style="padding-top:4vw">
                  <a href="/community" class="navbar-item @if(Request::is('community')) navbar-item-active @endif " style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4.5vw">Community</a>
                  </td>
                </tr>
                @if (Auth::check())

                <tr>
                  <td  style="padding-top:4vw">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-blue-bordered" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4.5vw !important">Log Out</button>
                    </form>
                  </td>
                </tr>
                @else
                <tr>
                  <td  style="padding-top:4vw">
                      <a href="/login" class="btn-blue-bordered" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4.5vw !important;margin-left:1.5vw">Log In</a>

                  </td>
                </tr>

                @endif
        
      

              </table>
              
            </ul>

          </div>
          @if (Auth::check())

          <div style="display: flex;">
            <a id="cart_icon" class="navbar-item" href="/cart" style="color:#FFFFFF">
              <span class="counter fa-stack has-badge" data-count="{{$cart_count}}">
                <i class="p3 fas fa-shopping-cart fa-stack-1x xfa-inverse @if(Request::is('cart')) navbar-item-active-mobile @endif"></i>
              </span>
            </a>
            <a id="notification_icon" class="navbar-item" href="#notification" style="color:#FFFFFF;margin-right:1.5vw">
              <span class="counter fa-stack has-badge" data-count="">
                <i class="p3 fas fa-bell fa-stack-1x xfa-inverse"></i>
              </span>
            </a>
            <a class="navbar-item" href="/dashboard" style="color:#FFFFFF;margin-top:1vw"><i class="fas fa-user @if(Request::is('dashboard'))navbar-item-active-mobile @elseif(Request::is('dashboard/*')) navbar-item-active-mobile @endif"></i></a>

          </div>
          @else
          <img src="/assets/images/client/Logo_white.png" style="height:6vw" class="img-fluid" alt="">
          <!-- <a href="/login" class="btn-blue-bordered" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;font-size:4vw">Log In</a> -->
          @endif
        </nav>
      </div>
    </div>
    @endif
    @endif
    @endif
    @endif
    @endif
    <!-- END OF MOBILE NAVBAR -->
    @if(!Request::is('login'))
      @if(!Request::is('signup'))
        @if(!Request::is('signup-interests'))
        @if( !Request::is('job-portal') )
        @if( !Request::is('job-portal/*') )
    <!-- START OF NAVBAR -->
    <div class="navbar-floating">
        <img src="/assets/images/client/icon-transparent.png" style="width: 3.5vw;" class="img-fluid" alt="">
        <a href="/" class="normal-text navbar-item @if(Request::is('/'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Home</a>
        <a href="/bootcamp" class="normal-text navbar-item @if( Request::is('bootcamp') || Request::is('bootcamp/*'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Bootcamp</a>
        <a href="/for-public/online-course" class="normal-text navbar-item @if(Request::is('online-course/*') || Request::is('for-public/*') || Request::is('woki')|| Request::is('woki/*') || Request::is('online-course') || Request::is('online-course/*')  )navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">For Public</a>
        <!--<a href="/for-corporate/krest" class="normal-text navbar-item @if(Request::is('for-corporate/*'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">For Corporate</a>-->
        <a href="/for-corporate/krest" class="normal-text navbar-item @if( Request::is('for-corporate') || Request::is('for-corporate/*'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">For Corporate</a>
        <a href="/community" class="normal-text navbar-item @if(Request::is('community') || Request::is('blog/*') || Request::is('blogs') ) navbar-item-active @endif " style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Community</a>
        @if (!Auth::check())
        <a href="/login" class="normal-text btn-blue-bordered" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Log In</a>
        @endif
        @if (Auth::check())
        
        <a id="cart_icon" class="sub-description navbar-item" href="/cart" style="color:#2B6CAA">
          <span class="counter fa-stack has-badge" data-count="{{$cart_count}}">
            <i class="p3 fas fa-shopping-cart fa-stack-1x xfa-inverse @if(Request::is('cart'))navbar-item-active @endif"></i>
          </span>
        </a>
        <a id="notification_icon" class="sub-description navbar-item" href="#notification" style="color:#2B6CAA;margin-right:0.8vw">
          <span class="counter fa-stack has-badge" data-count="">
            <i class="p3 fas fa-bell fa-stack-1x xfa-inverse"></i>
          </span>
        </a>
        <a class="sub-description navbar-item" href="/dashboard" style="color:#2B6CAA"><i class="fas fa-user @if(Request::is('dashboard'))navbar-item-active @elseif(Request::is('dashboard/*')) navbar-item-active @endif"></i></a>
        
        @endif
        
    </div>
    <!-- END OF NAVBAR -->
        @endif
      @endif
        @endif
      @endif
    @endif

    @if( Request::is('job-portal') || Request::is('job-portal/*') )
    <!-- START OF JOB PORTAL  NAVBAR -->
    <div class="navbar-floating" style="width:30vw">
        <img src="/assets/images/client/icon-transparent.png" style="width: 3.5vw;" class="img-fluid" alt="">
        <a href="/job-portal" class="normal-text navbar-item @if(Request::is('job-portal'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Job Portal</a>
        <a href="/job-portal/profile" class="normal-text navbar-item @if( Request::is('job-portal/profile') || Request::is('job-portal/profile'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Profile</a>
        
    </div>
    <!-- END OF JOB PORTAL  NAVBAR -->
    @endif
    @if(Auth::check())
    <!-- START OF POPUP -->
    <div id="notification" class="overlay">
        <div class="popup-notif">
          <a class="close-notif medium-heading" href="#closed" style="margin-top:1vw;text-decoration:none;" >&times;</a>
          <div class="content" >
            <div style="display:flex;align-items:center;padding-bottom:2vw">
              <p class="normal-text notif-item notif-item-active notif-links" onclick="changeNotification(event, 'semua-notification')" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;color:##3B3C43">Semua</p>
              <p class="normal-text notif-item notif-links" onclick="changeNotification(event, 'transaksi-notification')" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;color:##3B3C43;margin-left:2vw">Transaksi</p>
              <p class="normal-text notif-item notif-links" onclick="changeNotification(event, 'informasi-notification')" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;color:##3B3C43;margin-left:2vw">Informasi</p>

            </div>
            <!-- START OF SEMUA NOTIFICATION -->
            <div class="col-md-12 notif-content notification-mobile-height " id="semua-notification" style="overflow:scroll;height:20vw;">
              @if(count($notifications) == 0)
                <div>
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;">Belum ada notifikasi.</p>
                </div>
              @else
              @foreach($notifications as $notif)
                @if($notif->isInformation)
                  <?php
                      $info_users = explode(',', $notif->hasSeen);
                      $infoHasSeen = FALSE;
                      foreach($info_users as $user_id)
                      {
                        if($user_id == Auth::user()->id)
                          $infoHasSeen = TRUE;
                      }
                  ?>
                  <!-- ONE YELLOW CARD -->
                  <form action="{{ route('customer.seeNotification') }}" method="POST">
                  @csrf  
                  @method('put')  
                  @if(!$infoHasSeen)
                    <a href="javascript:;" onclick="parentNode.submit();"style="text-decoration:none">
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="notification_id" value="{{$notif->id}}">
                    <input type="hidden" name="link" value="{{$notif->link}}">
                  @else
                    <a href="{{$notif->link}}" target="_blank" style="text-decoration:none">
                  @endif
                  <!-- ONE YELLOW CARD -->
                    <div class="information-notification-card" style="display:flex;@if($loop->iteration != 1) margin-top:1vw @endif" >
                      <div   style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                          <div class="notification-left-yellow-border" >
                            <i class="fas fa-info-circle bigger-text" style="color:#F4C257"></i>

                          </div>
                      </div>
                      <div class="notification-right-yellow-border" @if(!$infoHasSeen) style="background: rgba(244, 194, 87, 0.1)" @endif>
                          <div style="padding:0.6vw 1vw">
                              
                            <p class="small-text" id="notification-title" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">{{$notif->title}}</p>
                            <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">{{$notif->created_at->diffForHumans()}}</p>
                            <p class="very-small-text" id="notification-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                              overflow : hidden !important;
                              text-overflow: ellipsis !important;
                              -webkit-line-clamp: 2 !important;
                              -webkit-box-orient: vertical !important;">{{$notif->description}}</p>
                          </div>
                      </div>
                    </div>
                  </a>
                  </form>
                  <!-- END OF ONE YELLOW CARD -->
                @else
                <?php
                    $users = explode(',', $notif->hasSeen);
                    $hasSeen = FALSE;
                    foreach($users as $user_id)
                    {
                      if($user_id == Auth::user()->id)
                        $hasSeen = TRUE;
                    }
                ?>
                <!-- ONE BLUE CARD -->
                <form action="{{ route('customer.seeNotification') }}" method="POST">
                @csrf  
                @method('put')  
                @if(!$hasSeen)
                <a href="javascript:;" onclick="parentNode.submit();"style="text-decoration:none">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="notification_id" value="{{$notif->id}}">
                <input type="hidden" name="link" value="{{$notif->link}}">
                @else
                <a  href="{{$notif->link}}" style="text-decoration:none">
                @endif
                <div class="" style="display:flex;@if($loop->iteration != 1)margin-top:1vw; @endif" >
                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                        <div class="notification-left-blue-border">
                          <i class="fas fa-shopping-cart bigger-text" style="color:#2B6CAA"></i>

                        </div>
                    </div>
                    <div class="notification-right-blue-border" @if(!$hasSeen) style="background: rgba(43, 108, 170, 0.1) @endif">
                        <div style="padding:0.6vw 1vw">
                            
                          <p class="small-text" id="notification-title" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">{{$notif->title}}</p>
                          <?php
                              $date_time = explode(' ', $notif->updated_at->diffForHumans());
                          ?>
                          <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">{{$date_time[0]}} {{$date_time[1]}}</p>
                          <p class="very-small-text" id="notification-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;">{{$notif->description}}
                          </p>
                            <!-- Hi, Gabriel. Harap segera selesaikan pembayaran untuk pelatihan: “How to be Funny”, “Ethical Hacking 101”, dan “Self-improvement Lets Go!”. -->
                        </div>
                    </div>
                  </div>
                </a>
                </form>
                <!-- END OF ONE BLUE CARD -->
                @endif
              @endforeach
              @endif
            </div>
            <!-- END OF SEMUA NOTIFICATION -->

            <!-- START OF TRANSAKSI NOTIFICATION -->
            <div class="col-md-12 notif-content notification-mobile-height" id="transaksi-notification" style="overflow:scroll;height:20vw;display:none">
              @if(count($transactions) == 0)
                <div>
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;">Belum ada transaksi.</p>
                </div>
              @else
                @foreach($transactions as $transaction)
                <?php
                    $users = explode(',', $transaction->hasSeen);
                    $hasSeen = FALSE;
                    foreach($users as $user_id)
                    {
                      if($user_id == Auth::user()->id)
                        $hasSeen = TRUE;
                    }
                ?>
                <!-- ONE BLUE CARD -->
                <form action="{{ route('customer.seeNotification') }}" method="POST">
                @csrf  
                @method('put')  
                @if(!$hasSeen)
                <a href="javascript:;" onclick="parentNode.submit();"style="text-decoration:none">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="notification_id" value="{{$transaction->id}}">
                <input type="hidden" name="link" value="{{$transaction->link}}">
                @else
                <a  href="{{$transaction->link}}" style="text-decoration:none">
                @endif
                  <div class="transaction-notification-card" style="display:flex;@if($loop->iteration != 1)margin-top:1vw; @endif" >
                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                        <div class="notification-left-blue-border">
                          <i class="fas fa-shopping-cart bigger-text" style="color:#2B6CAA"></i>

                        </div>
                    </div>
                    <div class="notification-right-blue-border" @if(!$hasSeen) style="background: rgba(43, 108, 170, 0.1) @endif">
                        <div style="padding:0.6vw 1vw">
                            
                          <p class="small-text" id="notification-title" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">{{$transaction->title}}</p>
                          <?php
                              $date_time = explode(' ', $transaction->updated_at->diffForHumans());
                          ?>
                          <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">{{$date_time[0]}} {{$date_time[1]}}</p>
                          <p class="very-small-text" id="notification-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 2 !important;
                            -webkit-box-orient: vertical !important;">{{$transaction->description}}
                          </p>
                            <!-- Hi, Gabriel. Harap segera selesaikan pembayaran untuk pelatihan: “How to be Funny”, “Ethical Hacking 101”, dan “Self-improvement Lets Go!”. -->
                        </div>
                    </div>
                  </div>
                </a>
                </form>
                <!-- END OF ONE BLUE CARD -->
                @endforeach
              @endif
            </div>
            <!-- END OF TRANSAKSI NOTIFICATION -->

            <!-- START OF INFORMASI NOTIFICATION -->
            <div class="col-md-12 notif-content notification-mobile-height" id="informasi-notification" style="overflow:scroll;height:20vw;display:none">
              @if(count($informations) == 0)
                <div>
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;">Belum ada informasi.</p>
                </div>
              @else
              @foreach($informations as $info)
              <?php
                    $info_users = explode(',', $info->hasSeen);
                    $infoHasSeen = FALSE;
                    foreach($info_users as $user_id)
                    {
                      if($user_id == Auth::user()->id)
                        $infoHasSeen = TRUE;
                    }
                ?>
              <!-- ONE YELLOW CARD -->
              <form action="{{ route('customer.seeNotification') }}" method="POST">
              @csrf  
              @method('put')  
              @if(!$infoHasSeen)
                <a href="javascript:;" onclick="parentNode.submit();"style="text-decoration:none">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="notification_id" value="{{$info->id}}">
                <input type="hidden" name="link" value="{{$info->link}}">
              @else
                <a href="{{$info->link}}" target="_blank" style="text-decoration:none">
              @endif
              <!-- ONE YELLOW CARD -->
                <div class="information-notification-card" style="display:flex;@if($loop->iteration != 1) margin-top:1vw @endif" >
                  <div   style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                      <div class="notification-left-yellow-border" >
                        <i class="fas fa-info-circle bigger-text" style="color:#F4C257"></i>

                      </div>
                  </div>
                  <div class="notification-right-yellow-border" @if(!$infoHasSeen) style="background: rgba(244, 194, 87, 0.1)" @endif>
                      <div style="padding:0.6vw 1vw">
                          
                        <p class="small-text" id="notification-title" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">{{$info->title}}</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">{{$info->created_at->diffForHumans()}}</p>
                        <p class="very-small-text" id="notification-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                          overflow : hidden !important;
                          text-overflow: ellipsis !important;
                          -webkit-line-clamp: 2 !important;
                          -webkit-box-orient: vertical !important;">{{$info->description}}</p>
                      </div>
                  </div>
                </div>
              </a>
              </form>
              <!-- END OF ONE YELLOW CARD -->
              @endforeach
              @endif

            </div>
            <!-- END OF INFORMASI NOTIFICATION -->

          </div>
        </div>
    </div>
    <!-- END OF POPUP -->
    @endif
  
    @yield('content')


    @if(!Request::is('login') )
      @if(!Request::is('signup'))
        @if(!Request::is('signup-interests'))
          @if(!Request::is('cart'))
    <!-- FOOTER DESKTOP-->
    <div class="row m-0 page-container footer-desktop" style="padding-top:5vw;padding-bottom:2vw">
      <div class="col-12 p-0">
        <div style="display:flex;justify-content:space-between">
          <div>
            <img src="/assets/images/client/Venidici_Logo_Horizontal.png" style="height:2.5vw" class="img-fluid" alt="">
            <p class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.75);margin-top:1vw">Platform anak kekinian <br>   buat naklukin karir impian!</p>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Site Map</p>
            <!-- <div style="margin-top:1vw">
              <a href="/" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Home Page</a>
            </div> -->
            <div style="margin-top:1vw">
              <a href="/bootcamp" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Bootcamp</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Skill Snack</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-public/woki" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Woki</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-corporate/krest" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Krest</a>
            </div>
            
            <!--<div style="margin-top:1vw">
              <a href="/for-corporate/krest" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">For Corporate</a>
            </div>-->
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Information</p>
            <!--<div style="margin-top:1vw">
              <a href="/for-corporate/krest" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Corporate Programs</a>
            </div>-->
            <div style="margin-top:1vw">
              <a href="/community" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Discord Community</a>
            </div>
            <div style="margin-top:1vw">
              <a  data-toggle="modal" data-target="#contactUsModal" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;cursor:pointer">Contact Us</a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Social</p>
            
            
            <div style="margin-top:1vw">
              <a href="https://www.instagram.com/venidici.id/" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-instagram-square bigger-text" style="color:#0879C0"></i><span style="margin-left:1.15vw">Instagram</span></a>
            </div>
            
            <div style="margin-top:1vw">
              <a href="https://www.tiktok.com/@venidici.id" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-tiktok bigger-text" style="color:#0879C0"></i><span style="margin-left:1vw">Tiktok</span></a>
            </div>
            <div style="margin-top:1vw">
              <a href="https://twitter.com/venidici_id" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-twitter bigger-text" style="color:#0879C0"></i><span style="margin-left:1vw">Twitter</span></a>
            </div>
            <div style="margin-top:1vw">
              <a href="https://www.linkedin.com/company/venidiciindonesia/" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-linkedin bigger-text" style="color:#0879C0"></i><span style="margin-left:1vw">Linkedin</span></a>
            </div>
            <div style="margin-top:1vw">
              <a href="https://api.whatsapp.com/send?phone=+6281294131031&text=Halo%20Venidici%21" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-whatsapp-square bigger-text" style="color:#0879C0"></i><span style="margin-left:1.15vw">Whatsapp </span></a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Review From our User</p>
            @if(count($footer_reviews) == 0)
              <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:0.5vw;text-align:center">
                  <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum ada review.</span></p>
              </div>
            @endif
            @foreach($footer_reviews as $review)
            <!-- START OF ONE REVIEW -->
            <div style="margin-top:1vw;width:25vw">
              <p class="normal-text" style="margin-bottom:0.5vw;font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;display: -webkit-box;
                  overflow : hidden !important;
                  text-overflow: ellipsis !important;
                  -webkit-line-clamp: 2 !important;
                  -webkit-box-orient: vertical !important;">
                  “{{$review->description}}” - {{$review->user->name}} </p>
              <p class="small-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fas fa-clock"></i> <span style="margin-left:0.5vw">{{$review->created_at->diffForHumans()}} in 
              @if($review->course->course_type_id == 1)
              <span style="color:#67BBA3">Online Course - {{$review->course->title}}</span> </span> 
              @elseif($review->course->course_type_id == 1)
              <span style="color:#CE3369">Woki - {{$review->course->title}}</span> </span> 
              @else
              <span style="color:#2B6CAA">{{$review->course->title}}</span> </span> 
              @endif
              </p>
            </div>
            @endforeach
            <!-- END OF ONE REVIEW -->
            <!-- START OF ONE REVIEW
            <div style="margin-top:1vw;width:25vw">
              <p class="normal-text" style="margin-bottom:0.5vw;font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;display: -webkit-box;
                  overflow : hidden !important;
                  text-overflow: ellipsis !important;
                  -webkit-line-clamp: 2 !important;
                  -webkit-box-orient: vertical !important;">
                  “Course ini sangat bermanfaat bagi kalian yang ingin menjadi lucu” - Gabrielle </p>
              <p class="small-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fas fa-clock"></i> <span style="margin-left:0.5vw">3 Hours ago in <span style="color:#CE3369">Woki - Cara Menjadi Seniman</span> </span> </p>
            </div>
           END OF ONE REVIEW -->
          </div>
          
        </div>
      </div>
      <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
        <p class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.75);margin-top:1vw">Copyright © 2021 Venidici. All rights reserved.</p>
      </div>
    </div>
    <!-- END OF FOOTER DESKTOP-->


    <!-- START OF FOOTER MOBILE -->
    <div class="row m-0 page-container footer-mobile" style="padding-top:5vw;padding-bottom:8vw;display:none">
      <div class="col-12">
          <img src="/assets/images/client/Venidici_Logo_Horizontal.png" style="height:7vw" class="img-fluid" alt="">
          <p class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.75);margin-top:3vw;">Platform anak kekinian <br>   buat naklukin karir impian!</p>
      </div>

      <div class="row m-0">
        <div class="col-4 p-0">
            <p class="normal-text"  style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw;">Site Map</p>
            <!-- <div>
              <a href="/" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">Home Page</a>
            </div> -->
            <div>
              <a  class="normal-text" href="/bootcamp" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">Bootcamp</a>
            </div>
            <div>
              <a  class="normal-text" href="/for-public/online-course" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">Skill Snack</a>
            </div>
            <div>
              <a  class="normal-text" href="/for-public/woki" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">Woki</a>
            </div>
            <div>
              <a  class="normal-text" href="/for-corporate/krest" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">Krest</a>
            </div>
            
            <!--<div>
              <a  class="normal-text" href="/for-corporate/krest" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">For Corporate</a>
            </div>-->
        </div>
  
        <div class="col-4 p-0" style="display:flex;justify-content:center">
            <div>
              <p  class="normal-text"  style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw;">Information</p>
              <!--<div>
                <a href="/for-corporate/krest"  style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">Corporate Programs</a>
              </div>-->
              <div>
                <a href="/community"  class="normal-text"  style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">Discord Community</a>
              </div>
              <div>
                <a  data-toggle="modal"  class="normal-text"  data-target="#contactUsModal"  style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;">Contact Us</a>
              </div>
            </div>
        </div>

        <div class="col-4 p-0" style="display:flex;justify-content:flex-end">
          <div>

            <p  class="normal-text"  style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw;">Social</p>
            

            <div >
              <a  class="normal-text" href="https://www.instagram.com/venidici.id/" target="_blank" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;"><i class="fab fa-instagram-square bigger-text" style="color:#0879C0;"></i><span style="margin-left:1.15vw">Instagram</span></a>
            </div>
            
            <div style="margin-top:3vw">
              <a  class="normal-text" href="https://www.tiktok.com/@venidici.id" target="_blank" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;"><i class="fab fa-tiktok bigger-text" style="color:#0879C0;"></i><span style="margin-left:1vw">Tiktok</span></a>
            </div>
            <div style="margin-top:3vw">
              <a  class="normal-text" href="https://twitter.com/venidici_id" target="_blank" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;"><i class="fab fa-twitter bigger-text" style="color:#0879C0;"></i><span style="margin-left:1vw">Twitter</span></a>
            </div>
            <div style="margin-top:3vw">
              <a  class="normal-text" href="https://www.linkedin.com/company/venidiciindonesia/" target="_blank" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;"><i class="fab fa-linkedin bigger-text" style="color:#0879C0;"></i><span style="margin-left:1vw">Linkedin</span></a>
            </div>
            <div style="margin-top:3vw">
              <a  class="normal-text" href="https://api.whatsapp.com/send?phone=+6281294131031&text=Halo%20Venidici%21" target="_blank" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;"><i class="fab fa-whatsapp-square bigger-text" style="color:#0879C0;"></i><span style="margin-left:1.15vw">Whatsapp </span></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-12 p-0" style="text-align:center;margin-top:4vw">
        <p  class="normal-text"  style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.75);margin-top:1vw;">Copyright © 2021 Venidici. All rights reserved.</p>
      </div>
    </div>

    <!-- END OF FOOTER MOBILE -->
    @endif
      @endif
        @endif
          @endif

    <!-- WOW JS -->
    <script src="/WOW-master/dist/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>

    <script src="https://code.jquery.com/jquery-3.0.0.min.js" crossorigin="anonymous"></script>    
    <!-- BOOTSTRAP 5-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>
    
    <!-- BOOTSTRAP 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>


    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
    <script>
      var path = "{{ route('autocomplete') }}";
      $('input.typeahead').typeahead({
        source: function(query, process){
          return $.get(path, { term: query }, function(data) {
            return process(data);
          });
        }
      });
    </script>
    <script>
      function openLogin() {
          $('#loginModal').modal('show');
      }
    </script>
    <script>
      function openLoading() {
          $('#loadingModal').modal({backdrop: 'static', keyboard: false});
          $('#loadingModal').modal('show');
      }
    </script>
    @if(session('contact_us_message') || session('contact_us_error'))
        <script>
            $(window).on('load', function() {
                $('#contactUsModal').modal('show');
            });
        </script>
    @endif
    <script>
        function changeNotification(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("notif-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("notif-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("notif-item-active", "notif-item");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " notif-item-active";
        }
    </script>
    @if (($errors->has('wrong_credential') || $errors->has('password') || $errors->has('email')) && Request::path() != 'login') 
    
    <script>
    console.log('test');
    $('#loginModal').modal('toggle');

    </script>

    @endif
    
   
  </body>
</html>