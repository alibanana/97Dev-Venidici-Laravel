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
        <a href="/for-corporate/krest" class="normal-text navbar-item @if(Request::is('for-corporate/*'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">For Corporate</a>
        <a href="/for-public/online-course" class="normal-text navbar-item @if(Request::is('online-course/*') || Request::is('for-public/*') || Request::is('woki/*') )navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">For Public</a>
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
      
        <a class="sub-description navbar-item" href="/dashboard" style="color:#2B6CAA"><i class="fas fa-user @if(Request::is('dashboard'))navbar-item-active @endif"></i></a>
        
        @endif
        
    </div>
    <!-- END OF NAVBAR -->
        @endif
      @endif
    @endif

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
              <!-- ONE YELLOW CARD -->
              <a href="" style="text-decoration:none">
                <div style="display:flex;" >
                  <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                      <div style="border-top: 2px solid #F4C257;border-left: 2px solid #F4C257;border-bottom:2px solid #F4C257;height:100%;background: rgba(244, 194, 87, 0.1);display: flex;flex-direction: column;justify-content: center;align-items:center;width:4vw;border-radius: 10px 0px 0px 10px">
                        <i class="fas fa-exclamation-triangle bigger-text" style="color:#F4C257"></i>

                      </div>
                  </div>
                  <div style="background: #FFFFFF;border-top: 2px solid #F4C257;border-right: 2px solid #F4C257;border-bottom: 2px solid #F4C257;box-sizing: border-box;border-radius: 0px 10px 10px 0px;width:100%">
                      <div style="padding:0.6vw 1vw">
                          
                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">Venidici ada Sales Event baru loh!</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">Mon 02/01/21 19:30</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                          overflow : hidden !important;
                          text-overflow: ellipsis !important;
                          -webkit-line-clamp: 2 !important;
                          -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.</p>
                      </div>
                  </div>
                </div>
              </a>
              <!-- END OF ONE YELLOW CARD -->
              <!-- ONE BLUE CARD -->
              <a href="/transaction-detail/1" style="text-decoration:none">
                <div style="display:flex;margin-top:1vw;" >
                  <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                      <div style="border-top: 2px solid #2B6CAA;border-left: 2px solid #2B6CAA;border-bottom:2px solid #2B6CAA;height:100%;background: rgba(43, 108, 170, 0.1);display: flex;flex-direction: column;justify-content: center;align-items:center;width:4vw;border-radius: 10px 0px 0px 10px">
                        <i class="fas fa-exclamation-triangle bigger-text" style="color:#2B6CAA"></i>

                      </div>
                  </div>
                  <div style="background: #FFFFFF;border-top: 2px solid #2B6CAA;border-right: 2px solid #2B6CAA;border-bottom: 2px solid #2B6CAA;box-sizing: border-box;border-radius: 0px 10px 10px 0px;width:100%">
                      <div style="padding:0.6vw 1vw">
                          
                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">Kami masih menunggu pembayaran kamu...</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">Mon 02/01/21 19:30</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                          overflow : hidden !important;
                          text-overflow: ellipsis !important;
                          -webkit-line-clamp: 2 !important;
                          -webkit-box-orient: vertical !important;">Hi, Gabriel. Harap segera selesaikan pembayaran untuk pelatihan: “How to be Funny”, “Ethical Hacking 101”, dan “Self-improvement Lets Go!”.</p>
                      </div>
                  </div>
                </div>
              </a>
              <!-- END OF ONE BLUE CARD -->
              <!-- ONE YELLOW CARD -->
              <a href="" style="text-decoration:none">
                <div style="display:flex;margin-top:1vw;" >
                  <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                      <div style="border-top: 2px solid #F4C257;border-left: 2px solid #F4C257;border-bottom:2px solid #F4C257;height:100%;background: rgba(244, 194, 87, 0.1);display: flex;flex-direction: column;justify-content: center;align-items:center;width:4vw;border-radius: 10px 0px 0px 10px">
                        <i class="fas fa-exclamation-triangle bigger-text" style="color:#F4C257"></i>

                      </div>
                  </div>
                  <div style="background: #FFFFFF;border-top: 2px solid #F4C257;border-right: 2px solid #F4C257;border-bottom: 2px solid #F4C257;box-sizing: border-box;border-radius: 0px 10px 10px 0px;width:100%">
                      <div style="padding:0.6vw 1vw">
                          
                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">Venidici ada Sales Event baru loh!</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">Mon 02/01/21 19:30</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                          overflow : hidden !important;
                          text-overflow: ellipsis !important;
                          -webkit-line-clamp: 2 !important;
                          -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.</p>
                      </div>
                  </div>
                </div>
              </a>
              <!-- END OF ONE YELLOW CARD -->
            </div>
            <!-- END OF SEMUA NOTIFICATION -->

            <!-- START OF TRANSAKSI NOTIFICATION -->
            <div class="col-md-12 notif-content" id="transaksi-notification" style="overflow:scroll;height:20vw;display:none">
              @if(Auth::check() && count($transactions) == 0)
                <div style="">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;">Belum ada transaksi.</p>
                </div>
              @endif
              @if($transactions)
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
              
              <!-- ONE YELLOW CARD -->
              <a href="" style="text-decoration:none">
                <div style="display:flex;" >
                  <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                      <div style="border-top: 2px solid #F4C257;border-left: 2px solid #F4C257;border-bottom:2px solid #F4C257;height:100%;background: rgba(244, 194, 87, 0.1);display: flex;flex-direction: column;justify-content: center;align-items:center;width:4vw;border-radius: 10px 0px 0px 10px">
                        <i class="fas fa-exclamation-triangle bigger-text" style="color:#F4C257"></i>

                      </div>
                  </div>
                  <div style="background: #FFFFFF;border-top: 2px solid #F4C257;border-right: 2px solid #F4C257;border-bottom: 2px solid #F4C257;box-sizing: border-box;border-radius: 0px 10px 10px 0px;width:100%">
                      <div style="padding:0.6vw 1vw">
                          
                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">Venidici ada Sales Event baru loh!</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">Mon 02/01/21 19:30</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                          overflow : hidden !important;
                          text-overflow: ellipsis !important;
                          -webkit-line-clamp: 2 !important;
                          -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.</p>
                      </div>
                  </div>
                </div>
              </a>
              <!-- END OF ONE YELLOW CARD -->

              <!-- ONE YELLOW CARD -->
              <a href="" style="text-decoration:none">
                <div style="display:flex;margin-top:1vw;" >
                  <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                      <div style="border-top: 2px solid #F4C257;border-left: 2px solid #F4C257;border-bottom:2px solid #F4C257;height:100%;background: rgba(244, 194, 87, 0.1);display: flex;flex-direction: column;justify-content: center;align-items:center;width:4vw;border-radius: 10px 0px 0px 10px">
                        <i class="fas fa-exclamation-triangle bigger-text" style="color:#F4C257"></i>

                      </div>
                  </div>
                  <div style="background: #FFFFFF;border-top: 2px solid #F4C257;border-right: 2px solid #F4C257;border-bottom: 2px solid #F4C257;box-sizing: border-box;border-radius: 0px 10px 10px 0px;width:100%">
                      <div style="padding:0.6vw 1vw">
                          
                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">Venidici ada Sales Event baru loh!</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">Mon 02/01/21 19:30</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                          overflow : hidden !important;
                          text-overflow: ellipsis !important;
                          -webkit-line-clamp: 2 !important;
                          -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.</p>
                      </div>
                  </div>
                </div>
              </a>
              <!-- END OF ONE YELLOW CARD -->

              <!-- ONE YELLOW CARD -->
              <a href="" style="text-decoration:none">
                <div style="display:flex;margin-top:1vw;" >
                  <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                      <div style="border-top: 2px solid #F4C257;border-left: 2px solid #F4C257;border-bottom:2px solid #F4C257;height:100%;background: rgba(244, 194, 87, 0.1);display: flex;flex-direction: column;justify-content: center;align-items:center;width:4vw;border-radius: 10px 0px 0px 10px">
                        <i class="fas fa-exclamation-triangle bigger-text" style="color:#F4C257"></i>

                      </div>
                  </div>
                  <div style="background: #FFFFFF;border-top: 2px solid #F4C257;border-right: 2px solid #F4C257;border-bottom: 2px solid #F4C257;box-sizing: border-box;border-radius: 0px 10px 10px 0px;width:100%">
                      <div style="padding:0.6vw 1vw">
                          
                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43">Venidici ada Sales Event baru loh!</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;color:#C4C4C4;margin-bottom:0.5vw">Mon 02/01/21 19:30</p>
                        <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;display: -webkit-box;
                          overflow : hidden !important;
                          text-overflow: ellipsis !important;
                          -webkit-line-clamp: 2 !important;
                          -webkit-box-orient: vertical !important;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dictum vitae vel justo, vel ut eros. Et magna penatibus ipsum volutpat amet eget etiam.</p>
                      </div>
                  </div>
                </div>
              </a>
              <!-- END OF ONE YELLOW CARD -->
            </div>
            <!-- END OF INFORMASI NOTIFICATION -->

          </div>
        </div>
    </div>
    <!-- END OF POPUP -->
  
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
            <p class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.75);margin-top:1vw">Copyright © 2021 Venidici. <br>
            All rights reserved.</p>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Homepage</p>
            <a href="/" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Home</a>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">For Public</p>
            <div>
              <a href="/for-public/online-course" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Online Course</a>
            </div>
            <div>
              <a href="/for-public/woki" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Woki</a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">For Corporate</p>
            <div>
              <a href="/for-corporate/krest" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Krest</a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Community</p>
            <div>
              <a href="/community" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">Community</a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Profile</p>
            <div>
              <a href="/dashboard" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none">User Dashboard</a>
            </div>
          </div>

          <div>
            <p class="normal-text" style="font-family:Rubik Bold;color:#1F2041;margin-bottom:0.5vw">Social</p>
            <div>
              <a href="https://twitter.com/venidici_id?lang=en" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-twitter bigger-text" style="color:#0879C0"></i><span style="margin-left:1vw">Twitter</span></a>
            </div>
            <div style="margin-top:0.5vw">
              <a href="https://www.facebook.com/venidici.id/" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-facebook bigger-text" style="color:#0879C0"></i><span style="margin-left:1vw">Facebook</span></a>
            </div>
            <div style="margin-top:0.5vw">
              <a href="https://www.instagram.com/venidici.id/" target="_blank" class="normal-text" style="font-family:Rubik Regular;color:rgba(31, 32, 65, 0.5);text-decoration:none"><i class="fab fa-instagram bigger-text" style="color:#0879C0"></i><span style="margin-left:1vw">Instagram</span></a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <!-- END OF FOOTER -->
    @endif
      @endif
        @endif
          @endif

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