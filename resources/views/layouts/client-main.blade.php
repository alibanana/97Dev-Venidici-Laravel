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
  <body >
    @if(!Request::is('login'))
      @if(!Request::is('signup'))
        @if(!Request::is('signup-interests'))
    <!-- END OF NAVBAR -->
    <div class="navbar-floating">
        <img src="/assets/images/client/icon-transparent.png" style="width: 3.5vw;" class="img-fluid" alt="">
        <a href="/" class="normal-text navbar-item @if(Request::is('/'))navbar-item-active @endif" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Home</a>
        <a href="" class="normal-text navbar-item" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">For Corporate</a>
        <a href="" class="normal-text navbar-item @if(Request::is('online-course/*'))navbar-item-active @endif" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">For Public</a>
        <a href="" class="normal-text navbar-item" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Community</a>
        @if(!Request::is('dashboard'))
        <a href="/login" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Log In</a>
        @endif
        @if(Request::is('dashboard'))
        <div class="dropdown show">
          <a id="cart_icon" class="sub-description navbar-item" href="/dashboard" style="color:#2B6CAA" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="counter fa-stack has-badge" data-count="1">
              <i class="p3 fas fa-bell fa-stack-1x xfa-inverse"></i>
            </span>
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="margin-left:-13.5vw;width:18vw">
            <div class="dropdown-item" style="margin-top:0.5vw">
              <div style="display:flex;justify-content:space-between">
                <p class="small-text" style="font-family:Rubik Regular;color:#000000;margin-bottom:0px;">Payment Completed!</p>   
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;">20/04/2021</p>   
              </div>
              <a href="#" class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;">View more..</a>
            </div>
            <div class="dropdown-item" style="margin-top:0.5vw">
              <div style="display:flex;justify-content:space-between">
                <p class="small-text" style="font-family:Rubik Regular;color:#000000;margin-bottom:0px;">Payment Completed!</p>   
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;">20/04/2021</p>   
              </div>
              <a href="#" class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;">View more..</a>
            </div>
          </div>
        </div>
        <a id="cart_icon" class="sub-description navbar-item" href="/dashboard" style="color:#2B6CAA;margin-right:0.8vw">
          <span class="counter fa-stack has-badge" data-count="3">
            <i class="p3 fas fa-shopping-cart fa-stack-1x xfa-inverse"></i>
          </span>
        </a>
        <a class="sub-description navbar-item" href="/dashboard" style="color:#2B6CAA"><i class="fas fa-user"></i></a>
        
        @endif
        
    </div>
    <!-- START OF BANNER SECTION -->
        @endif
      @endif
    @endif
    @yield('content')


    <!-- FOOTER -->
    <!-- END OF FOOTER -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP 5-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>
    
    <!-- BOOTSTRAP 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous"></script>


    <script>
        var path = "{{ env('APP_URL') . route('autocomplete', [], false) }}";

        $('input.typeahead').typeahead({
          source: function(terms,process){
            return $.get(path,{terms:terms},function(data){
              return process(data);
            });
          }
        });
      
    </script>
  </body>
</html>