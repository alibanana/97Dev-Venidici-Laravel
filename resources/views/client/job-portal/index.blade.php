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

    <!--load all fontawesome -->
    <link href="/fontawesome/css/all.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- web icon    -->
    <link rel="shortcut icon" type="image/jpg" href="/assets/images/client/icon-transparent.png"/>
  
    <!-- wow js -->
    <link rel="stylesheet" href="/WOW-master/css/libs/animate.css">

    <title>Venidici Job Portal</title>

  </head>
  <body style="padding-right:0px !important">
    <!-- Modal Loading -->
    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true">
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
     <!-- START OF NAVBAR -->
     <div class="navbar-floating" style="width:30vw">
        <img src="/assets/images/client/icon-transparent.png" style="width: 3.5vw;" class="img-fluid" alt="">
        <a href="/job-portal" class="normal-text navbar-item @if(Request::is('job-portal'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Job Portal</a>
        <a href="/bootcamp" class="normal-text navbar-item @if( Request::is('job-portal/profile') || Request::is('job-portal/profile'))navbar-item-active @endif" style="font-family: Rubik Medium;margin-bottom:0px;cursor:pointer">Profile</a>
        
    </div>
    <!-- END OF NAVBAR -->

    <!-- START OF BANNER SECTION -->
    <div class="row m-0 banner-background page-container desktop-display"
        style="height: 50vw; padding-top: 19vw; text-align: center;
        background-image: url('/assets/images/seeder/homepage_background.png');">
        <div class="col-md-12 p-0 wow fadeInUp" data-wow-delay="0.3s">
            <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">Selamat datang di
            Hiring Partner!</p>
            <p class="sub-description" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line">“Veni, vidi, vici.” Saya datang, saya
            lihat, saya taklukkan.</p>
            <div style="display:flex;justify-content:center;margin-top:4vw">
                <div style="display:flex;align-items:center;">
                    <div class="btn-blue-toggle btn-blue-toggle-active">
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px">Kandidat Venidici</p>
                    </div>   
                    <div class="btn-blue-toggle" >
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px">Daftar Saya</p>
                    </div>    
                </div>
            </div>
            
        </div>
    </div>
    <!-- END OF BANNER SECTION -->


    <!-- START OF DESCRIPTION AND SEARCH SECTION -->
    <div class="row m-0 page-container desktop-display" style="padding-bottom:4vw;padding-top:8vw">
        <div class="col-12 p-0">
            <p class="medium-heading" style="font-family: Rubik Bold;color:#2B6CAA">Kandidat dari Venidici</p>
        </div>
        <div class="col-lg-6 col-xs-12 p-0">
            <p class="bigger-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#000000;margin-top:1vw">Odio vehicula cursus nullam ornare. Elit tincidunt tellus ac non posuere tellus risus pharetra a. Aliquet integer sodales viverra turpis eu senectus ornare urna ornare. Sed aliquam risus nisl, nunc, accumsan vitae.</p>
        </div>

        <!-- START OF SEARCH SECTION -->
        <div class="col-12 p-0" style="display:flex;align-items:center;margin-top:3vw;justify-content:space-between">
            <div style="display:flex;align-items:center">

                <div  class="grey-input-form" style="display: flex;align-items:center">
                    <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid" alt="">
                    <input type="text" name="search" class="normal-text typeahead" autocomplete="off"
                        style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:15vw;font-family:Rubik Regular" placeholder="Search Skill">
                </div>
                <div style="margin-left: 1vw;">
                    <button type="submit" onclick="openLoading()" class="btn-search normal-text"><i class="fas fa-search"></i></button>
                </div>

                <div style="margin-left: 3vw;">
                    <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                        <select name="" class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                            <option value="None" disabled selected>Years of Experience</option>
                            <option value="1 Tahun">< 1 Tahun</option>
                            <option value="2 Tahun">< 2 Tahun</option>
                        </select>                    
                        @error('')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>

                <div style="margin-left: 3vw;">
                    <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                        <select name="" class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                            <option value="None" disabled selected>Select Interest</option>
                            <option value="Business">Business</option>
                            <option value="Technology">Technology</option>
                        </select>                    
                        @error('')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>

                <div style="margin-left: 3vw;">
                    <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                        <select name="" class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                            <option value="None" disabled selected>Sort by</option>
                            <option value="Bootcamp Score">Bootcamp Score</option>
                        </select>                    
                        @error('')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
            </div>

            <a href=""  class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;">Refresh</a>
        </div>
        <!-- END OF SEARCH SECTION -->

    </div>
    <!-- END OF DESCRIPTION AND SEARCH SECTION -->


    <!-- START OF JOB LISTING -->
    <div class="row m-0 page-container" style="padding-bottom:8vw">

        <!-- START OF ONE CARD -->
        <div class="col-lg-4 col-xs-12 p-0" style="margin-top:4vw;display:flex;justify-content:flex-start">
            <div style="width:24vw;border:2px solid #2B6CAA;border-radius:5px">
                <div style="display:flex;padding:1vw;background-color:#2B6CAA">
                    <img src="assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                    <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: space-between">
                        <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#FFFFFF">Fernandha Dzaky Zevelin Sitorus</p>
                        <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#B7CFE6">Still looking for experience</p>
                    </div>
                </div>
                <div style="padding:1vw;background:#FFFFFF">
                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA">Dominant Skill:</p>
                    <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Product Management</p>
                    
                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Interest:</p>
                    <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Fullstack Developer, QA Tester, QA Automation</p>

                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-top:0.5vw">Bootcamp Score: 98</p>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2.5vw;">   
                        <button class="normal-text btn-dark-blue full-width-button" type="submit" 
                            style="border:none;font-family: Rubik Bold;margin-bottom:0px;cursor:pointer;">
                            Add to my list</button>
                        <div style="display:flex">
                            <a href="" class="sub-description" style="margin-right:1vw">
                                <i class="fab fa-linkedin " style="color:#3B3C43"></i> 
                            </a>
                            <a href="" class="sub-description">
                                <i class="fas fa-download " style="color:#3B3C43"></i> 
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
        <div class="col-lg-4 col-xs-12 p-0" style="margin-top:4vw;display:flex;justify-content:center">
            <div style="width:24vw;border:2px solid #2B6CAA;border-radius:5px">
                <div style="display:flex;padding:1vw;background-color:#2B6CAA">
                    <img src="assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                    <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: space-between">
                        <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#FFFFFF">Fernandha Dzaky Zevelin Sitorus</p>
                        <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#B7CFE6">Still looking for experience</p>
                    </div>
                </div>
                <div style="padding:1vw;background:#FFFFFF">
                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA">Dominant Skill:</p>
                    <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Product Management</p>
                    
                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Interest:</p>
                    <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Fullstack Developer, QA Tester, QA Automation</p>

                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-top:0.5vw">Bootcamp Score: 98</p>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2.5vw;">   
                        <button class="normal-text btn-dark-blue full-width-button" type="submit" 
                            style="border:none;font-family: Rubik Bold;margin-bottom:0px;cursor:pointer;">
                            Add to my list</button>
                        <div style="display:flex">
                            <a href="" class="sub-description" style="margin-right:1vw">
                                <i class="fab fa-linkedin " style="color:#3B3C43"></i> 
                            </a>
                            <a href="" class="sub-description">
                                <i class="fas fa-download " style="color:#3B3C43"></i> 
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
        <div class="col-lg-4 col-xs-12 p-0" style="margin-top:4vw;display:flex;justify-content:flex-end">
            <div style="width:24vw;border:2px solid #2B6CAA;border-radius:5px">
                <div style="display:flex;padding:1vw;background-color:#2B6CAA">
                    <img src="assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                    <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: space-between">
                        <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#FFFFFF">Fernandha Dzaky Zevelin Sitorus</p>
                        <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#B7CFE6">Still looking for experience</p>
                    </div>
                </div>
                <div style="padding:1vw;background:#FFFFFF">
                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA">Dominant Skill:</p>
                    <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Product Management</p>
                    
                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Interest:</p>
                    <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Fullstack Developer, QA Tester, QA Automation</p>

                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-top:0.5vw">Bootcamp Score: 98</p>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2.5vw;">   
                        <button class="normal-text btn-dark-blue full-width-button" type="submit" 
                            style="border:none;font-family: Rubik Bold;margin-bottom:0px;cursor:pointer;">
                            Add to my list</button>
                        <div style="display:flex">
                            <a href="" class="sub-description" style="margin-right:1vw">
                                <i class="fab fa-linkedin " style="color:#3B3C43"></i> 
                            </a>
                            <a href="" class="sub-description">
                                <i class="fas fa-download " style="color:#3B3C43"></i> 
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END OF ONE CARD -->
        <!-- START OF ONE CARD -->
        <div class="col-lg-4 col-xs-12 p-0" style="margin-top:4vw;display:flex;justify-content:flex-start">
            <div style="width:24vw;border:2px solid #2B6CAA;border-radius:5px">
                <div style="display:flex;padding:1vw;background-color:#2B6CAA">
                    <img src="assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                    <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: space-between">
                        <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#FFFFFF">Fernandha Dzaky Zevelin Sitorus</p>
                        <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#B7CFE6">Still looking for experience</p>
                    </div>
                </div>
                <div style="padding:1vw;background:#FFFFFF">
                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA">Dominant Skill:</p>
                    <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Product Management</p>
                    
                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Interest:</p>
                    <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#2B6CAA;margin-top:0.5vw">Fullstack Developer, QA Tester, QA Automation</p>

                    <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-top:0.5vw">Bootcamp Score: 98</p>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2.5vw;">   
                        <button class="normal-text btn-dark-blue full-width-button" type="submit" 
                            style="border:none;font-family: Rubik Bold;margin-bottom:0px;cursor:pointer;">
                            Add to my list</button>
                        <div style="display:flex">
                            <a href="" class="sub-description" style="margin-right:1vw">
                                <i class="fab fa-linkedin " style="color:#3B3C43"></i> 
                            </a>
                            <a href="" class="sub-description">
                                <i class="fas fa-download " style="color:#3B3C43"></i> 
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END OF ONE CARD -->

    </div>

    <!-- END OF JOB LISTING -->


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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
   
    <script>
      function openLoading() {
          console.log('test');
          $('#loadingModal').modal({backdrop: 'static', keyboard: false});
          $('#loadingModal').modal('show');
      }
    </script>
  </body>
</html>