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
    <!-- END OF NAVBAR -->
    <div class="navbar-floating">
        <img src="/assets/images/client/icon-transparent.png" style="width: 3.5vw;" class="img-fluid" alt="">
        <a href="/" class="normal-text navbar-item @if(Request::is('/'))navbar-item-active @endif" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Home</a>
        <a href="" class="normal-text navbar-item" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">For Corporate</a>
        <a href="" class="normal-text navbar-item" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">For Public</a>
        <a href="" class="normal-text navbar-item" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Community</a>
        
        <a href="/login" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Log In</a>
        
    </div>
    <!-- START OF BANNER SECTION -->
    @endif
    @endif
    @yield('content')


    <!-- FOOTER -->
    <!-- END OF FOOTER -->

    <!-- BOOTSTRAP 5-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    
    <!-- BOOTSTRAP 4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>