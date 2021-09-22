@extends('./layouts/client-main')
@section('title', 'Venidici Job Portal')

@section('content')

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
                    <div class="btn-blue-toggle btn-blue-toggle-active toggle-link" style="border-radius:10px 0px 0px 10px" onclick="changeContent(event, 'kandidat-venidici')">
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px" >Kandidat Venidici</p>
                    </div>   
                    <div class="btn-blue-toggle toggle-link"  onclick="changeContent(event, 'daftar-saya')">
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px">Daftar Saya</p>
                    </div>    
                </div>
            </div>
            
        </div>
    </div>
    <!-- END OF BANNER SECTION -->

    <div class="toggle-content" style="display:none" id="daftar-saya">

        <!-- START OF DESCRIPTION AND SEARCH SECTION -->
        <div class="row m-0 page-container desktop-display" style="padding-top:8vw">
            <!-- START OF SEARCH SECTION -->
            <div class="col-12 p-0" style="display:flex;align-items:center;margin-top:3vw;justify-content:space-between">
                <div style="display:flex;align-items:center">
                    <div style="">
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
                                <option value="None" disabled selected>Status</option>
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
                                <option value="Alphabet Ascending">Alphabet Ascending</option>
                                <option value="Alphabet Descending">Alphabet Descending</option>                            </select>                    
                            @error('')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                </div>
                </div>
            <!-- END OF SEARCH SECTION -->

        </div>
        <!-- END OF DESCRIPTION AND SEARCH SECTION -->
        <!-- START OF JOB LISTING -->
        <div class="row m-0 page-container" style="padding-bottom:8vw">

            <!-- START OF TABLE -->
            <div class="col-lg-12" style="margin-top:4vw;background: #FFFFFF;box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.25);border-radius: 10px;padding:2vw 0vw">
                <div class="row m-0" style="padding:0vw 2vw 2vw 2vw">
                    <div class="col-8"> 
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43;">Candidate</p>
                    </div>
                    <div class="col-2" style="text-align:center"> 
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43;">Status</p>
                    </div>
                    <div class="col-2"  style="text-align:center"> 
                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#3B3C43;">Action</p>
                    </div>
                </div>

                <!-- START OF ONE ROW -->
                <div class="row m-0  job-listing-card" >
                    <div class="col-8"> 
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                            <div style="margin-left:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0.5vw">Gabriel Amileano Vidyananto Soebiantoro</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#2B6CAA;margin-bottom:0.5vw">Product Management</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px">4+ Years of Experience in Project Management Industry</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-2" style="text-align:center"> 
                        <a class="normal-text" style="font-family: Rubik Medium;background-color:#D0F5EB;color:#3B3C43;text-decoration:none;padding:0.5vw;border-radius:5px">Contacted</a>
                    </div>
                    <div class="col-2"  style="text-align:center"> 
                        <div class="grey-input-form" style="display: flex;align-items:center;width:100%;background-color:#2B6CAA">
                            <select name="" class="normal-text"  style="background:transparent;border:none;color: #ffffff;;width:100%;font-family:Rubik Regular;">
                                <option value="None" disabled selected>Select Action</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Contacted">Contacted</option>
                                <option value="Rejected">Rejected</option>
                            </select>                    
                            @error('')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                    </div>
                </div>
                <!-- END OF ONE ROW -->
                <!-- START OF ONE ROW -->
                <div class="row m-0  job-listing-card" >
                    <div class="col-8"> 
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                            <div style="margin-left:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0.5vw">Gabriel Amileano Vidyananto Soebiantoro</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#2B6CAA;margin-bottom:0.5vw">Product Management</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px">4+ Years of Experience in Project Management Industry</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-2" style="text-align:center"> 
                        <a class="normal-text" style="font-family: Rubik Medium;background-color:#D0F5EB;color:#3B3C43;text-decoration:none;padding:0.5vw;border-radius:5px">Contacted</a>
                    </div>
                    <div class="col-2"  style="text-align:center"> 
                        <div class="grey-input-form" style="display: flex;align-items:center;width:100%;background-color:#2B6CAA">
                            <select name="" class="normal-text"  style="background:transparent;border:none;color: #ffffff;;width:100%;font-family:Rubik Regular;">
                                <option value="None" disabled selected>Select Action</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Contacted">Contacted</option>
                                <option value="Rejected">Rejected</option>
                            </select>                    
                            @error('')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                    </div>
                </div>
                <!-- END OF ONE ROW -->
                <!-- START OF ONE ROW -->
                <div class="row m-0  job-listing-card" >
                    <div class="col-8"> 
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                            <div style="margin-left:1vw">
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0.5vw">Gabriel Amileano Vidyananto Soebiantoro</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#2B6CAA;margin-bottom:0.5vw">Product Management</p>
                                <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;margin-bottom:0px">4+ Years of Experience in Project Management Industry</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-2" style="text-align:center"> 
                        <a class="normal-text" style="font-family: Rubik Medium;background-color:#D0F5EB;color:#3B3C43;text-decoration:none;padding:0.5vw;border-radius:5px">Contacted</a>
                    </div>
                    <div class="col-2"  style="text-align:center"> 
                        <div class="grey-input-form" style="display: flex;align-items:center;width:100%;background-color:#2B6CAA">
                            <select name="" class="normal-text"  style="background:transparent;border:none;color: #ffffff;;width:100%;font-family:Rubik Regular;">
                                <option value="None" disabled selected>Select Action</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Contacted">Contacted</option>
                                <option value="Rejected">Rejected</option>
                            </select>                    
                            @error('')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                    </div>
                </div>
                <!-- END OF ONE ROW -->


                <div class="row m-0" style="">
                    <div class="col-12 p-0" style="text-align:center">
                        <div style="padding-top:1.5vw;">
                            <p style="margin-bottom:0px">pagination</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF TABLE -->

        </div>
    </div>

    <div class="toggle-content" id="kandidat-venidici">

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
                                <option value="Alphabet Ascending">Alphabet Ascending</option>
                                <option value="Alphabet Descending">Alphabet Descending</option>
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
                    <div class="row m-0" style=";padding:1vw;background-color:#2B6CAA">
                        <div class="col-4 ps-0">
                            <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:7vw;height:100%;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                        </div>
                        <div class="col-8">
                            <div style="margin-bottom:0.5vw">
                                <a href="/job-portal/1" class="normal-text" style="font-family: Rubik Medium;color:#FFFFFF;text-decoration:none;">Fernandha Dzaky Zevelin Sitorus</a>
                            </div>
                            <p class="small-text" style="font-family: Rubik Regular;color:#B7CFE6;margin-bottom:1vw">Still looking for experience</p>
                            <a class="small-text" style="font-family: Rubik Medium;background-color:#67BBA3;color:#ffffff;text-decoration:none;padding:0.5vw;border-radius:5px">Looking for a job</a>
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
                    <div class="row m-0" style=";padding:1vw;background-color:#2B6CAA">
                        <div class="col-4 ps-0">
                            <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:7vw;height:100%;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                        </div>
                        <div class="col-8">
                            <div style="margin-bottom:0.5vw">
                                <a href="/job-portal/1" class="normal-text" style="font-family: Rubik Medium;color:#FFFFFF;text-decoration:none;">Fernandha Dzaky Zevelin Sitorus</a>
                            </div>
                            <p class="small-text" style="font-family: Rubik Regular;color:#B7CFE6;margin-bottom:1vw">Still looking for experience</p>
                            <a class="small-text" style="font-family: Rubik Medium;background-color:#F4C257;color:#ffffff;text-decoration:none;padding:0.5vw;border-radius:5px">Employed</a>
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
                    <div class="row m-0" style=";padding:1vw;background-color:#2B6CAA">
                        <div class="col-4 ps-0">
                            <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:7vw;height:100%;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                        </div>
                        <div class="col-8">
                            <div style="margin-bottom:0.5vw">
                                <a href="/job-portal/1" class="normal-text" style="font-family: Rubik Medium;color:#FFFFFF;text-decoration:none;">Fernandha Dzaky Zevelin Sitorus</a>
                            </div>
                            <p class="small-text" style="font-family: Rubik Regular;color:#B7CFE6;margin-bottom:1vw">Still looking for experience</p>
                            <a class="small-text" style="font-family: Rubik Medium;background-color:#67BBA3;color:#ffffff;text-decoration:none;padding:0.5vw;border-radius:5px">Looking for a job</a>
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
                    <div class="row m-0" style=";padding:1vw;background-color:#2B6CAA">
                        <div class="col-4 ps-0">
                            <img src="/assets/images/seeder/Job_Portal_Dummy_DP.png" style="width:7vw;height:100%;object-fit:cover;border-radius:5px" class="img-fluid" alt="">
                        </div>
                        <div class="col-8">
                            <div style="margin-bottom:0.5vw">
                                <a href="/job-portal/1" class="normal-text" style="font-family: Rubik Medium;color:#FFFFFF;text-decoration:none;">Fernandha Dzaky Zevelin Sitorus</a>
                            </div>
                            <p class="small-text" style="font-family: Rubik Regular;color:#B7CFE6;margin-bottom:1vw">Still looking for experience</p>
                            <a class="small-text" style="font-family: Rubik Medium;background-color:#67BBA3;color:#ffffff;text-decoration:none;padding:0.5vw;border-radius:5px">Looking for a job</a>
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
    </div>

    <!-- END OF JOB LISTING -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function changeContent(evt, categoryName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("toggle-content")
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("toggle-link");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("btn-blue-toggle-active", "btn-blue-toggle");
        }
        document.getElementById(categoryName).style.display = "block";
        evt.currentTarget.className += " btn-blue-toggle-active";
    }
</script>
@endsection