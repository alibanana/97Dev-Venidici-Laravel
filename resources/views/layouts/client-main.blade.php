<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="Description" content="Anytime anywhere, Learn on your schedule from any device ">

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


    

    <title>@yield('title')</title>

  </head>
  <body style="padding-right:0px !important">
  
    @if(!Request::is('login'))
      @if(!Request::is('signup'))
        @if(!Request::is('signup-interests'))
    <!-- START OF NAVBAR -->
    <div class="navbar-floating">
        <img src="/assets/images/client/icon-transparent.png" style="width: 3.5vw;" class="img-fluid" alt="">
        <a href="/" class="normal-text navbar-item @if(Request::is('/'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Home</a>
        <a href="/for-public/online-course" class="normal-text navbar-item @if(Request::is('online-course/*') || Request::is('for-public/*') || Request::is('woki/*') )navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">For Public</a>
        <a href="/for-corporate/krest" class="normal-text navbar-item @if(Request::is('for-corporate/*'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">For Corporate</a>
        <a href="/community" class="normal-text navbar-item @if(Request::is('community')) navbar-item-active @endif " style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Community</a>
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
    @if(Auth::check())
    <!-- START OF POPUP -->
    <div id="notification" class="overlay">
        <div class="popup-notif">
          <a class="close-notif medium-heading" href="#closed" style="margin-top:1vw;text-decoration:none" >&times;</a>
          <div class="content" >
            <div style="display:flex;align-items:center;padding-bottom:2vw">
              <p class="normal-text notif-item notif-item-active notif-links" onclick="changeNotification(event, 'semua-notification')" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;color:##3B3C43">Semua</p>
              <p class="normal-text notif-item notif-links" onclick="changeNotification(event, 'transaksi-notification')" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;color:##3B3C43;margin-left:2vw">Transaksi</p>
              <p class="normal-text notif-item notif-links" onclick="changeNotification(event, 'informasi-notification')" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;color:##3B3C43;margin-left:2vw">Informasi</p>

            </div>
            <!-- START OF SEMUA NOTIFICATION -->
            <div class="col-md-12 notif-content" id="semua-notification" style="overflow:scroll;height:20vw;">
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
                              
                            <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">{{$notif->title}}</p>
                            <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">{{$notif->created_at->diffForHumans()}}</p>
                            <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
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
                  <div class="transaction-notification-card" style="display:flex;@if($loop->iteration != 1)margin-top:1vw; @endif" >
                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                        <div class="notification-left-blue-border">
                          <i class="fas fa-shopping-cart bigger-text" style="color:#2B6CAA"></i>

                        </div>
                    </div>
                    <div class="notification-right-blue-border" @if(!$hasSeen) style="background: rgba(43, 108, 170, 0.1) @endif">
                        <div style="padding:0.6vw 1vw">
                            
                          <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">{{$notif->title}}</p>
                          <?php
                              $date_time = explode(' ', $notif->updated_at->diffForHumans());
                          ?>
                          <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">{{$date_time[0]}} {{$date_time[1]}}</p>
                          <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
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
            </div>
            <!-- END OF SEMUA NOTIFICATION -->

            <!-- START OF TRANSAKSI NOTIFICATION -->
            <div class="col-md-12 notif-content" id="transaksi-notification" style="overflow:scroll;height:20vw;display:none">
              @if(count($transactions) == 0)
                <div style="">
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
                            
                          <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">{{$transaction->title}}</p>
                          <?php
                              $date_time = explode(' ', $transaction->updated_at->diffForHumans());
                          ?>
                          <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">{{$date_time[0]}} {{$date_time[1]}}</p>
                          <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
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
            <div class="col-md-12 notif-content" id="informasi-notification" style="overflow:scroll;height:20vw;display:none">
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
                          
                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">{{$info->title}}</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">{{$info->created_at->diffForHumans()}}</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
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
    <!-- FOOTER -->
    <div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw">
      <div class="col-12 p-0">
        <div style="display:flex;justify-content:space-between">
          <div>
            <img src="/assets/images/client/Venidici_Logo_Horizontal.png" style="height:3vw" class="img-fluid" alt="">
            <p class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.75);margin-top:1vw">Platform anak kekinian <br>   buat naklukin karir impian!</p>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Site Map</p>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Home Page</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">For Public</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">For Corporate</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Community</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Venindici On-Demand</a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Information</p>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Corporate Programs</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Discord Community</a>
            </div>
            <div style="margin-top:1vw">
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Contact Us</a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Social</p>
            <div style="margin-top:1vw">
              <a href="https://twitter.com/venidici_id?lang=en" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-twitter bigger-text" style="color:#0879C0"></i><span style="margin-left:1vw">Twitter</span></a>
            </div>
            <div style="margin-top:1vw">
              <a href="https://www.facebook.com/venidici.id/" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-facebook bigger-text" style="color:#0879C0"></i><span style="margin-left:1vw">Facebook</span></a>
            </div>
            <div style="margin-top:1vw">
              <a href="https://www.instagram.com/venidici.id/" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-instagram bigger-text" style="color:#0879C0"></i><span style="margin-left:1.15vw">Instagram</span></a>
            </div>
            <div style="margin-top:1vw">
              <a href="https://www.instagram.com/venidici.id/" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-whatsapp bigger-text" style="color:#0879C0"></i><span style="margin-left:1.15vw">Whatsapp </span></a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Review From our User</p>
            <!-- START OF ONE REVIEW -->
            <div style="margin-top:1vw;width:25vw">
              <p class="normal-text" style="margin-bottom:0.5vw;font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;display: -webkit-box;
                  overflow : hidden !important;
                  text-overflow: ellipsis !important;
                  -webkit-line-clamp: 2 !important;
                  -webkit-box-orient: vertical !important;">
                  “Course ini sangat bermanfaat bagi kalian yang ingin menjadi lucu” - Gabrielle </p>
              <p class="small-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fas fa-clock"></i> <span style="margin-left:0.5vw">3 Hours ago in <span style="color:#67BBA3">Online Course - Cara Menjadi Lucu</span> </span> </p>
            </div>
            <!-- END OF ONE REVIEW -->
            <!-- START OF ONE REVIEW -->
            <div style="margin-top:1vw;width:25vw">
              <p class="normal-text" style="margin-bottom:0.5vw;font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none;display: -webkit-box;
                  overflow : hidden !important;
                  text-overflow: ellipsis !important;
                  -webkit-line-clamp: 2 !important;
                  -webkit-box-orient: vertical !important;">
                  “Course ini sangat bermanfaat bagi kalian yang ingin menjadi lucu” - Gabrielle </p>
              <p class="small-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fas fa-clock"></i> <span style="margin-left:0.5vw">3 Hours ago in <span style="color:#CE3369">Woki - Cara Menjadi Seniman</span> </span> </p>
            </div>
            <!-- END OF ONE REVIEW -->
          </div>
          
        </div>
      </div>
      <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
        <p class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.75);margin-top:1vw">Copyright © 2021 Venidici. All rights reserved.</p>
      </div>
    </div>
    <!-- END OF FOOTER -->
    @endif
      @endif
        @endif
          @endif

    <!-- WOW JS -->
    <script src="/WOW-master/dist/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP 5-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>
    
    <!-- BOOTSTRAP 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

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
    <script>
      // 
      var path = "{{ env('APP_URL') . route('autocomplete', [], false) }}";

      $('input.typeahead').typeahead({
        source: function(terms, process){
          return $.get(path, {terms:terms}, function(data) {
            return process(data);
          });
        }
      });
    </script>
   
  </body>
</html>