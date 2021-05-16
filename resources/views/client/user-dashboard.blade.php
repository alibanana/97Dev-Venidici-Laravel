@extends('./layouts/client-main')
@section('title', 'Venidici User Dashboard')

@section('content')


<!-- START OF POPUP EDIT PROFILE-->
<div id="edit-profile" class="overlay" style="overflow:scroll">
    <div class="popup">
        <a class="close" href="#" >&times;</a>
    
        <div class="content" style="padding:2vw">
            @if (session()->has('error'))
            <div class="p-3 mt-2 mb-0">
                <div class="alert alert-danger alert-dismissible fade show m-0" role="alert" style="font-size: 18px">
                    {{ session()->get('error_validation_on_password_modal') }}     
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            <form action="">
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">General Information</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Display Picture</p>

                        <input type="file" id="images" name="images[]" accept=".jpg,.jpeg,.png" />
                        <!--
                        <label id="uploadButton" for="images" style="font-family:Rubik Medium">Choose Image</label>-->
                    </div>
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="John Doe" value="John Doe">
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Phone Number</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                            <input type="text" name="telephone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="+62812345678" value="62812345678">
                            @error('telephone')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Gender</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <select name="" id=""  class="normal-text"  style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%">
                                <option value=""  disabled selected>Choose Gender</option>
                                <option value="">Male</option>
                                <option value="">Female</option>
                                <option value="">None of the above</option>
                            </select>
                        </div>  
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Birthdate</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                            <input type="date" name="birthdate" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="dd.mm.yyyy">
                            @error('birthdate')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Company/Institution</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-building"></i>
                            <input type="text" name="company" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="Binus University International">
                            @error('company')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pekerjaan</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-friends"></i>
                            <input type="text" name="referral_code" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="Mahasiswa">
                            @error('referral_code')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                    <!-- END OF RIGHT SECTION -->

                    <p class="bigger-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:2vw">Shipping Address</p>
                    

                    <div class="col-12 col-sm-6" >
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Provinsi</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <select name="province" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                                <option value="">DKI Jakarta</option>
                                <option value="">Instagram</option>
                            </select>                    
                            @error('province')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                    <div class="col-12 col-sm-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Kota</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <select name="province" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                                <option value="">Jakarta Selatan</option>
                                <option value="">Instagram</option>
                            </select>                    
                            @error('province')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                    <div class="col-12" style="margin-top:1vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Alamat</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <textarea name="" id="" rows="4" class="normal-text"   style="background:transparent;border:none;color: #5F5D70;;width:100%">Jalan 123 Komplek ABC - Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos</textarea>                
                            @error('province')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                    <div class="col-12" style="text-align:right;padding-top:3vw">
                        <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Save</button>
                    </div>  
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP EDIT PROFILE-->

<!-- START OF POPUP CHANGE PASSWORD-->
<div id="change-password" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:40% !important">
        <a class="close" href="#" >&times;</a>
    
        <div class="content" style="padding:2vw">
            @if (session()->has('error'))
            <div class="p-3 mt-2 mb-0">
                <div class="alert alert-danger alert-dismissible fade show m-0" role="alert" style="font-size: 18px">
                    {{ session()->get('error_validation_on_password_modal') }}     
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            <form action="">
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Change Password</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-12" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Old Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt"></i>
                            <input type="password" name="current_password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="John Doe" value="John Doe">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">New Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt"></i>
                            <input type="password" name="new_password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="+62812345678" value="62812345678">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#5F5D70;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Confirm New Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt"></i>
                            <input type="password" name="password_confirmation" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="+62812345678" value="62812345678">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                    <div class="col-12" style="text-align:right;padding-top:3vw">
                        <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Update Password</button>
                    </div>  
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP CHANGE PASSWORD-->

<!-- START OF POPUP POINT EXPLANATION-->
<div id="points" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:40% !important">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12" style="text-align:left;">
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">How Venidici Point System Works?</p>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis amet corrupti harum expedita libero cumque fugit officiis natus error explicabo deserunt doloremque ipsum, aperiam rerum possimus illum quas maiores omnis.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF POPUP POINT EXPLANATION-->

<!-- START OF TOP SECTION -->
<div class="row m-0 page-container" style="padding-top:9vw">   
    <div class="col-12" style="height:3.5vw;display:flex;justify-content:center">
        <!-- ALERT MESSAGE -->
        <div class="alert alert-warning alert-dismissible fade show small-text"  style="width:50%;text-align:center;margin-bottom:0px"role="alert">
            <strong><a href="#edit-profile">Click here</a></strong> This is a toast message contains a warning or a reminder
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
</div>
<div class="row m-0 page-container" style="padding-top:1.5vw;">
    <div class="col-12 p-0" style="display:flex;justify-content:center">
        <div class="card-white" style="height:18vw;padding:1.5vw 1.5vw;width:49vw;display:flex;align-items:center">
            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:14vw;height:14vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="DISPLAY PICTURE">
            <div style="margin-left:1.5vw;width:100%;display: flex;flex-direction: column;justify-content: flex-end;">
                <div style="display:flex;justify-content:space-between;">
                    <p class="sub-description" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">{{Auth::user()->name}}</p> 
                    <div class="dropdown show">
                        
                        <!--<a class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>-->
                        <a class="small-heading" style="color:grey;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>


                        <div class="dropdown-menu" aria-labelledby="editDropdown" style="">
                            <div class="dropdown-item" >
                                <a href="#edit-profile" class="normal-text" style="font-family:Rubik Regular;color:#000000;margin-bottom:0px;text-decoration:none">Edit Profile</a>   
                            </div>
                            <div class="dropdown-item" style="margin-top:0.5vw">
                                <a href="#change-password" class="normal-text" style="font-family:Rubik Regular;color:#000000;margin-bottom:0px;text-decoration:none">Change Password</a>   
                            </div>
                            <div class="dropdown-item" style="margin-top:0.5vw">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background:none;border:none">
                                        <p class="normal-text" style="font-family:Rubik Regular;color:#000000;margin-bottom:0px;text-decoration:none"> <span><i class="fas fa-sign-out-alt"></i></span> Log out</p>   
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>
                <div style="display:flex;align-items:center">
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#F4C257;margin-bottom:0px">10 Points</p>  
                    <a href="#points">
                        <i  style="color:#F4C257;margin-left:1vw" class="fas fa-question-circle bigger-text"></i> 
                    </a>
                </div>
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">{{Auth::user()->email}}</p>   
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">Student</p>   
                <div style="width:70%">
                    <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 2 !important;
                        -webkit-box-orient: vertical !important;">Jalan duren tiga indah 5 Blok I no. 11, Pancoran, Jakarta Selatan, DKI Jakarta, 13720</p>   
                </div>
                <div style="display:flex;align-items:center;margin-top:0.8vw">   
                    <p class="small-text" style="font-family:Rubik Medium;color:#2B6CAA;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px">Tech</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#CE3369;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px;margin-left:1vw">Art</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#67BBA3;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px;margin-left:1vw">Math</p>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- END OF TOP SECTION -->


<!-- START OF MIDDLE SECTION -->
<div class="row m-0 page-container-inner" style="padding-top:4vw;padding-bottom:4vw">
    <div class="col-12 p-0" style="">
        <div style="display:flex">

            <p class="sub-description blue-text-underline blue-text-underline-active user-links" onclick="changeContent(event, 'live-pelatihan')"  style="font-family:Rubik Medium;cursor:pointer;margin-bottom:0px">Jadwal Live Pelatihan</p>
            <p class="sub-description blue-text-underline user-links" onclick="changeContent(event, 'pelatihan-aktif')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px">Pelatihan Aktif</p>
            <p class="sub-description blue-text-underline user-links" onclick="changeContent(event, 'pelatihan-selesai')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px">Pelatihan Selesai</p>
        </div>
    </div>
    <!-- Live Pelatihan Content -->
    <div style="padding:0px" class="user-content" id="live-pelatihan">
        <div class="col-12 p-0">
            <div class="red-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:15vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Woki</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">19 August 2021  |  09:00 - 12:00</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-bottom:2vw">View Details</a>
                        <a href="" id="meeting-link" class="small-text" style="font-family:Rubik Medium;margin-top:2vw">Meeting Link</a>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:15vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Workshop</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">19 August 2021  |  09:00 - 12:00</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-bottom:2vw">View Details</a>
                        <a href="" id="meeting-link" class="small-text" style="font-family:Rubik Medium;margin-top:2vw">Meeting Link</a>
                    </div>
                </div> 
            </div>
        </div>

    </div>
    <!-- End of Live Pelatihan Content -->

    <!-- Pelatihan Aktif Content -->
    <div style="padding:0px;display:none" class="user-content" id="pelatihan-aktif">
        <div class="col-12 p-0">
            <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:15vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Woki</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;margin-bottom:0px;">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <div class="progress progress-bar-vertical">
                            <div class="progress-bar-blue" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: 30%;">
                            30%
                            </div>
                        </div>
                        <a href="/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Lanjutkan</a>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="red-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:15vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Workshop</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;margin-bottom:0px;">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <div class="progress progress-bar-vertical">
                            <div class="progress-bar-red" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: 50%;">
                            50%
                            </div>
                        </div>
                        <a href="/online-course/sertifikat-menjadi-komedian-lucu/learn/lecture/1" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Lanjutkan</a>
                    </div>
                </div> 
            </div>
        </div>

    </div>
    <!-- End of Pelatihan Aktif Content -->

    <!-- Pelatihan Selesai Content -->
    <div style="padding:0px;display:none;" class="user-content" id="pelatihan-selesai">
        <div class="col-12 p-0">
            <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:15vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Woki</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;margin-bottom:0px;">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <i class="fas fa-check-circle big-heading"></i>
                        <a href="" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Cek Sertifikat</a>
                    </div>
                </div> 
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="red-bordered-card" style="margin-top:2.5vw;display:flex">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:15vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Workshop</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:70%">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How to be funny</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Mr. Raditya Dika</p>   
                            <p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>
                            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;margin-bottom:0px;">This is a description for the lesson and this is a brief description. The maximum length has been set accordingly.</p>
                        </div>
                    </div>
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <i class="fas fa-check-circle big-heading"></i>
                        <a href="" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Cek Sertifikat</a>
                    </div>
                </div> 
            </div>
        </div>

    </div>
    <!-- End of Pelatihan Selesai Content -->
</div>
<!-- END OF MIDDLE SECTION -->

<!-- START OF SARAN KAMI SECTION -->
<div class="row m-0 page-container-inner" style="padding-top:2vw;padding-bottom:6vw">
    <div class="col-12 p-0" style="text-align:center">
        <p class="small-heading" style="font-family:Rubik Medium;margin-bottom:0px;color:#3B3C43">Saran kelas dari kami</p>
    </div>
    <div class="col-12 p-0" style="margin-top:3vw">
        <div id="saran-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 3.5vw;">
            
                <div class="carousel-item active" >
                    <div style="display:flex;justify-content:center">
                        <div>
                            <!-- START OF ONE GREEN COURSE CARD -->
                            <div class="course-card-green" style="margin-right:2vw">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                    <div class="top-left card-tag small-text" >Online Course</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5vw">
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-bottom:0.5vw;text-decoration:none">How to be funny?</a>
                                        <i style="font-size:2vw;" role="button"  aria-controls="course-collapse3" data-toggle="collapse" href="#course-collapse3" class="fas fa-caret-down"></i>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                                    <div class="collapse" id="course-collapse3" style="margin-top:1vw">
                                        <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">sAnim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;margin-top:2vw" >
                                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                        <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                                    </div>
                                    <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                        <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                        <div style="display: flex;justify-content:center;margin-left:1vw">
                                            <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                        </div>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="course-card-button normal-text">Enroll Now</a>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                        <div >
                            <!-- END OF ONE GREEN COURSE CARD -->
                            <!-- START OF ONE GREEN COURSE CARD -->
                            <div class="course-card-green" style="margin-left:2vw">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                    <div class="top-left card-tag small-text" >Online Course</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5vw">
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-bottom:0.5vw;text-decoration:none">How to be funny?</a>
                                        <i style="font-size:2vw;" role="button"  aria-controls="course-collapse4" data-toggle="collapse" href="#course-collapse4" class="fas fa-caret-down"></i>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                                    <div class="collapse" id="course-collapse4" style="margin-top:1vw">
                                        <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">sAnim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;margin-top:2vw" >
                                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                        <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                                    </div>
                                    <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                        <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                        <div style="display: flex;justify-content:center;margin-left:1vw">
                                            <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                        </div>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="course-card-button normal-text">Enroll Now</a>
                                    </div>
                    
                                </div>
                            </div>
                            <!-- END OF ONE GREEN COURSE CARD -->
                        </div>
                    </div>
                </div>
                <div class="carousel-item" >
                    <div style="display:flex;justify-content:center">
                        <div>
                            <!-- START OF ONE GREEN COURSE CARD -->
                            <div class="course-card-green" style="margin-right:2vw">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                    <div class="top-left card-tag small-text" >Online Course</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5vw">
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-bottom:0.5vw;text-decoration:none">How to be funny?</a>
                                        <i style="font-size:2vw;" role="button"  aria-controls="course-collapse3" data-toggle="collapse" href="#course-collapse3" class="fas fa-caret-down"></i>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                                    <div class="collapse" id="course-collapse3" style="margin-top:1vw">
                                        <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">sAnim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;margin-top:2vw" >
                                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                        <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                                    </div>
                                    <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                        <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                        <div style="display: flex;justify-content:center;margin-left:1vw">
                                            <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                        </div>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="course-card-button normal-text">Enroll Now</a>
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                        <div >
                            <!-- END OF ONE GREEN COURSE CARD -->
                            <!-- START OF ONE GREEN COURSE CARD -->
                            <div class="course-card-green" style="margin-left:2vw">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                    <div class="top-left card-tag small-text" >Online Course</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5vw">
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-bottom:0.5vw;text-decoration:none">How to be funny?</a>
                                        <i style="font-size:2vw;" role="button"  aria-controls="course-collapse4" data-toggle="collapse" href="#course-collapse4" class="fas fa-caret-down"></i>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                                    <div class="collapse" id="course-collapse4" style="margin-top:1vw">
                                        <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">sAnim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;margin-top:2vw" >
                                        <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                        <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">100 mins</p>
                                    </div>
                                    <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                        <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                                        <div style="display: flex;justify-content:center;margin-left:1vw">
                                            <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                            <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                        </div>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                        <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="course-card-button normal-text">Enroll Now</a>
                                    </div>
                    
                                </div>
                            </div>
                            <!-- END OF ONE GREEN COURSE CARD -->
                        </div>
                    </div>
                </div>

            </div>
            <a class="carousel-control-prev"   data-bs-target="#saran-carousel" style="width:2.5vw;" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#saran-carousel" style="width:2.5vw;"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
</div>
<!-- END OF SARAN KAMI SECTION -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function changeContent(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("user-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("user-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("blue-text-underline-active", "blue-text-underline");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " blue-text-underline-active";
        }
         
</script>
@endsection