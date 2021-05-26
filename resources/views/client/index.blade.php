@extends('./layouts/client-main')
@section('title', 'Venidici Home')

@section('content')

<!-- START OF BANNER SECTION 
<div class="row m-0">
    <div class="col-md-6 p-0">
        <div class="page-container-left" style="padding-top: 13vw;padding-bottom:9vw">
            <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43;white-space:pre-line" >Anytime, anywhere.
            Learn on your schedule
            from any device</p>
            <p class="sub-description" style="font-family: Rubik Regular;color:#808080;white-space:pre-line" >Lorem ipsum dolor sit amet, consectetur adipiscing 
            elit. Eget non dictum pellentesque nulla </p>
            <div style="display: flex;margin-top:2vw;">
                <div  class="blue-input-form" style="display: flex;align-items:center">
                    <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid" alt="">
                  
                    <input type="text" class="small-text" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);" placeholder="Course Title">
                 
                </div>
                <div style="margin-left: 1vw;">
                    <select class="blue-input-form small-text" style="height:100%" aria-label="">
                        <option selected>Open this to  select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div style="margin-left: 1vw;">
                    <button type="submit" class="btn-search small-text"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 p-0 home-background">
        <div style="margin-top:13.2vw;margin-left:1.5vw">
            <video style="width:33.8vw;height:23vw;border-radius:1vw;display:block;object-fit: cover;"  controls="false" >
                <source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
                <source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
                Your browser does not support HTML video.
            </video> 
        </div>
    </div>
</div>
 END OF BANNER SECTION -->

<!-- START OF POPUP MENJADI PENGAJAR-->
<div id="menjadi-pengajar" class="overlay" style="overflow:scroll">
    <div class="popup">
        <a class="close" href="#closed" >&times;</a>
    
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
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                        <p class="medium-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Menjadi Pengajar</p>
                    </div>
                    <!-- START OF GENERAL INFORMATION -->
                    <div class="col-12" style="text-align:left;margin-top:1vw">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">General Information</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="John Doe" >
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">No. Telp</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                            <input type="text" name="telephone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="+62812345678" >
                            @error('telephone')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                            <input type="email" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="johndoe@gmail.com" >
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">LinkedIn Link Profile</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fab fa-linkedin"></i>
                            <input type="text" name="company" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="https://linkedin.com/in/John" >
                            @error('company')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Alamat</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <textarea name="address" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan alamat" ></textarea>
                            @error('referral_code')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                    <!--
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Next</button>
                    </div>  
                    -->
                    <!-- END OF GENNERAL INFORMATION -->


                    <!-- START OF CAREER INFORMATION -->
                    <div class="col-12" style="text-align:left;margin-top:3vw">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Career Information</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Nama perusahaan kamu saat ini/sebelumnya</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-building"></i>
                            <input type="text" name="company" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="PT. Karya Anak Bangsa" >
                            @error('company')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Nama universitas terakhir kamu</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-university"></i>
                            <input type="text" name="university" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Universitas Indonesia" >
                            @error('university')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pendidikan terakhir kamu</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-university"></i>
                            <select name="province" id=""  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option value="" disabled selected>Pilih Pendidikan</option>
                                <option value="">SMP</option>
                                <option value="">SMA</option>
                                <option value="">S1</option>
                                <option value="">S2</option>
                            </select>                           
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pekerjaan kamu saat ini</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-briefcase"></i>
                            <input type="text" name="work" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Guru Matematika" >
                            @error('work')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        
                    </div>
                    <!-- END OF RIGHT SECTION --> 
                    <!--
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Next</button>
                    </div>  
                    -->
                    <!-- END OF CAREER INFORMATION -->

                    <!-- START OF PREFERRED JOB SECTION -->
                    <div class="col-12" style="text-align:left;margin-top:3vw">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Preferred Job Position</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pilih posisi pengajar yang diinginkan</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-briefcase"></i>
                            <select name="province" id=""  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option value="" disabled selected>Pilih Posisi</option>
                                <option value="">Pengajar Woki</option>
                                <option value="">Pengajar Online Course</option>
                            </select>                           
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Gaji Yang Diharapkan</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-money-check"></i>
                            <input type="text" name="work" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="10000" >
                            @error('work')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>   
                        
                    </div>
                    <!-- END OF RIGHT SECTION -->

                    <!-- start of drag and drop -->
                    <div class="col-md-12" style="text-align:center;margin-top:1vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0.4vw;margin-top:1.5vw">Unggah file CV/Portfolio kamu disini</p>
                        <div style="padding:0vw 20vw;margin-top:1vw">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt normal-text" style="font-family:Rubik Regular;color:black;"> Drag file CV/Portfolio kamu ke sini untuk Menunggah atau <span style="color:#3F92D8" >Browse</span></span>
                                <input type="file" name="cv_file" class="drop-zone__input" accept=".pdf">
                            </div>
                        </div>
                        @error('cv_file')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> 
                    <!-- end of drag and drop -->
                    
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</button>
                    </div>  
                    <!-- END OF PREFERRED JOB SECTION -->

                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP MENJADI PENGAJAR-->

<!-- START OF POPUP MENJADI KOLLABORATOR-->
<div id="menjadi-kollaborator" class="overlay" style="overflow:scroll">
    <div class="popup">
        <a class="close" href="#closed" >&times;</a>
    
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
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                        <p class="medium-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Menjadi Kollaborator</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan nama" >
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Socmed Institusi (optional)</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-heart"></i>
                            <input type="text" name="institusi" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Social Media Institusi" >
                            @error('institusi')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                            <input type="email" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Email" >
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Institusi</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-building"></i>
                            <input type="email" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan nama Institusi" >
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Jenis Partnership</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-hands-helping"></i>
                            <select name="province" id=""  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Partnership</option>
                                <option value="Event Collaboration">Event Collaboration</option>
                                <option value="Brand Activation">Brand Activation</option>
                                <option value="ontent Collaboration">Content Collaboration</option>
                                <option value="Other">Other</option>
                            </select>                              
                            @error('company')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Nomor Whatsapp</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fab fa-whatsapp"></i>
                            <input type="text" name="telephone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Nomor Whatsapp" >
                            @error('telephone')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Notes</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <textarea name="address" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan catatan" ></textarea>
                            @error('referral_code')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                    </div>
                    
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</button>
                    </div>  
                    
                    <!-- END OF GENNERAL INFORMATION -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP MENJADI KOLLABORATOR-->

<div class="row m-0 banner-background page-container"
    style="height: 50vw; padding-top: 16vw; text-align: center;
    background-image: url({{ $configs['cms.homepage.top-section.background']->value }});">
    <div class="col-md-12 p-0">
        <p class="big-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">{{ $configs['cms.homepage.top-section.heading']->value }}</p>
        <p class="sub-description" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line">{{ $configs['cms.homepage.top-section.sub-heading']->value }}</p>
        <div style="display: flex;margin-top:2vw;justify-content:center;">
            <div  class="grey-input-form" style="display: flex;align-items:center">
                <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid" alt="">
                
                <input type="text" class="small-text typeahead" style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:15vw;font-family:Rubik Regular" placeholder="Course Title">
                
            </div>
            <div style="margin-left: 1vw;">
            <!--
                <select class="grey-input-form small-text" style="height:100%;appearance:none" aria-label="">-->
                <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                    <select name="province" id=""  class="small-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                        <option value="" disabled selected>Kategori</option>
                        <option value="">Online Course</option>
                    </select>                    
                    @error('province')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
            </div>
            <div style="margin-left: 1vw;">
                <button type="submit" class="btn-search small-text"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- START OF TRUSTED COMPANY SECTION -->
<div class="row m-0 page-container" style="z-index: 99;padding-bottom:5vw">
    <div class="col-12 p-0" style="margin-top:-5vw">
        <div style="background-color: #FCFCFC;border-radius:10px;padding:1vw 2vw;display:flex;justify-content:space-between;align-items:center">
            <div style="text-align: center;">
                <p class="big-heading" style="font-family: Rubik Medium;color:#000000;margin-bottom:0px">{{ $configs['cms.homepage.trusted-company-section.trusted-company-count']->value }}</p>
                <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA">Trusted Companies</p>
            </div>
            <img src="/assets/images/icons/vertical-splitter.png" style="max-height:3.5vw" class="img-fluid" alt="">
            @foreach ($trusted_companies as $company)
                <img src="{{ asset($company->image) }}" style="max-height:3.5vw" class="img-fluid" alt="Image not available..">                
            @endforeach
        </div>
    </div>
</div>
<!-- END OF TRUSTED COMPANY SECTION -->

<!-- START OF OUR PROGRAMS SECTION 
<div class="row m-0 page-container our-programs-background" style="padding-bottom:8vw">
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#55525B;margin-top:1vw;margin-bottom:0px">Our <span class="big-heading" style="font-family:Hypebeast;margin-left:1vw" >PROGRAMS</span></p>
    </div>
    <div class="col-6 p-0">
        <a href="" style="text-decoration:none">
            <div class="our-programs-card" style="margin-top:2.5vw">
                <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Program 1</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 1</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 p-0" style="display:flex;justify-content:flex-end;margin-top:2.5vw">
        <a href="" style="text-decoration:none">
            <div class="our-programs-card">
                <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Program 1</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 1</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 p-0">
        <a href="" style="text-decoration:none">
            <div class="our-programs-card" style="margin-top:2.5vw">
                <img src="/assets/images/client/our-programs-card-dummy.png" alt="">
                <div class="right-section" >
                    <div>
                        <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Program 1</p>
                        <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    </div>
                    <div style="order: 1;flex: 0 1 auto;align-self: flex-end;">
                        <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Program 1</a>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
END OF OUR PROGRAMS SECTION -->

<!-- START OF INDONESIA EMAS SECTION -->
<div class="row m-0 page-container" style="padding-bottom:8vw;padding-top:2vw">
    <div class="col-7 p-0">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line">Kami ingin...</p>
        <p class="super-big-heading" style="font-family: Rubik Medium;color:#2B6CAA;white-space:pre-line;">Mewujudkan
        Indonesia Emas 2045</p>
        <p class="small-heading" style="font-family: Rubik Regular;color:#C4C4C4;white-space:pre-line">“Saya datang, saya lihat, saya taklukan!”</p>
    </div>
    <div class="col-5" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
        <img src="/assets/images/client/Emas_BG.png" style="width:24vw" class="img-fluid" alt="">
    </div>
</div>
<!-- END OF INDONESIA EMAS SECTION -->

<!-- START OF OUR PROGRAMS SECTION -->
<div class="row m-0 page-container our-programs-background" style="padding-bottom:8vw">
    <div class="col-12 p-0" style="text-align:center">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#55525B;margin-top:1vw;margin-bottom:1vw"><span class="big-heading" style="font-family:Hypebeast;margin-left:1vw" >PROGRAM </span> Venidici</p>
    </div>
    <!--
    <div class="col-4 p-0">
        <a href="/online-course" style="text-decoration:none">
            <div class="our-programs-card-home" style="margin-top:2.5vw">
                <img src="/assets/images/client/Our_Programs_Icon.png" style="width:5vw;" class="img-fluid" alt="">
                <div>
                    <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-top:1.5vw;">Online Course</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                </div>
            </div>
        </a>
    </div>
    -->
    <!-- START OF ONE PROGRAMS -->
    <div class="col-4 p-0" style="display:flex;justify-content:center">
        <a href="/online-course" style="text-decoration:none">
            <div class="our-programs-card-homepage" style="margin-top:2.5vw">
                <img src="/assets/images/client/Our_Programs_Card_BG_Dummy.png" style="width:100%;height:11vw;object-cover" class="img-fluid" alt="">
                <div style="padding:1.5vw">
                    <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Online Course</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B;margin-bottom:1vw">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    <a href="/online-course" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Online Course</a>
                </div>
            </div>
        </a>
    </div>
    <!-- END OF ONE PROGRAMS -->
    <!-- START OF ONE PROGRAMS -->
    <div class="col-4 p-0" style="display:flex;justify-content:center">
        <a href="/online-course" style="text-decoration:none">
            <div class="our-programs-card-homepage" style="margin-top:2.5vw">
                <img src="/assets/images/client/Our_Programs_Card_BG_Dummy.png" style="width:100%;height:11vw;object-cover" class="img-fluid" alt="">
                <div style="padding:1.5vw">
                    <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">WOKI</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B;margin-bottom:1vw">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Woki</a>
                </div>
            </div>
        </a>
    </div>
    <!-- END OF ONE PROGRAMS -->
    <!-- START OF ONE PROGRAMS -->
    <div class="col-4 p-0" style="display:flex;justify-content:center">
        <a href="/online-course" style="text-decoration:none">
            <div class="our-programs-card-homepage" style="margin-top:2.5vw">
                <img src="/assets/images/client/Our_Programs_Card_BG_Dummy.png" style="width:100%;height:11vw;object-cover" class="img-fluid" alt="">
                <div style="padding:1.5vw">
                    <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;">Krest</p>
                    <p class="small-text our-programs-card-description" style="font-family: Rubik Regular;color:#55525B;margin-bottom:1vw">This is a description for program 1 and this is a brief description. The maximum length is the same as the button bellow.</p>
                    <a href="#" class="btn-blue small-text" style="text-decoration: none;font-family:Rubik Regular;">Explore Krest</a>
                </div>
            </div>
        </a>
    </div>
    <!-- END OF ONE PROGRAMS -->
</div>
<!-- END OF OUR PROGRAMS SECTION -->

<!-- START OF FEATURE, COURSE AND TESTIMONY SECTION -->
<div class="row m-0 page-container feature-background" style="padding-bottom: 6vw;">
    <!-- START OF FEATURE SECTION -->
    <div class="col-12 p-0 " style="text-align: center;">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;margin-top:3vw">Apa yang akan kamu dapat
        dari Venidici?</p>
    </div>
    <div class="col-12 p-0" style="display:flex;justify-content:center;margin-top:2vw">

        <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 6vw;">
                
                <div class="carousel-item active">
                    <div class="card-white" style="display: flex;align-items:center;height:15vw;width:48.5vw">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 18vw;" alt="">
                        <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: center;">
                            <p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;">Feature number 1</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-white" style="display: flex;align-items:center;height:15vw">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 18vw;" alt="">
                        <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: center;">
                            <p class="sub-description" style="font-family: Rubik Medium;color:#3B3C43;">Feature number 2</p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev"   data-bs-target="#feature-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2.5vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#feature-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2.5vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
    <!-- END OF FEATURE SECTION -->
    <!-- START OF CLASSES SECTION -->
    <div class="col-12 p-0" style="text-align: center;margin-top:12vw">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;">Top <span class="big-heading" style="font-family:Hypebeast;color:#A24A9C" >CLASSES</span> for you</p>
        <div style="padding:2vw 13.5vw 4vw 13.5vw;">
            <div style="display:flex;justify-content:space-between;align-items:center;background: #FFFFFF;border: 2px solid rgba(157, 157, 157, 0.1);border-radius: 10px;padding:0.7vw">

                <p class="normal-text btn-blue-on-hover btn-blue-active course-links" onclick="changeCourse(event, 'course-popular')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Most Popular</p>
                <p class="normal-text btn-blue-on-hover course-links"  onclick="changeCourse(event, 'course-woki')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Woki</p>
                <p class="normal-text btn-blue-on-hover course-links" onclick="changeCourse(event, 'course-online')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Online Course</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Bootcamp</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Workshop</p>
            </div>
        </div>
    </div>
    <!-- MOST POPULAR -->
    <div class="course-content" id="course-popular">
        <div class="row m-0 p-0">
            <div class="col-4 p-0" >
                <div style="display: flex;justify-content:center">

                    <!-- START OF ONE RED COURSE CARD -->
                    <div class="course-card-red">
                        <div class="container">
                            <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                            <div class="top-left card-tag small-text" >Woki</div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5vw">
                                <a href="/woki/sertifikat-menjadi-seniman" class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;text-decoration:none">How to be funny?</a>
                                <i style="font-size:2vw;" role="button"  aria-controls="woki-collapse" data-toggle="collapse" href="#woki-collapse" class="fas fa-caret-down"></i>
                            </div>
                            <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                            <div class="collapse" id="woki-collapse" style="margin-top:1vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                            <div style="display: flex;justify-content:space-between;margin-top:2vw" >
                                <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B">Mr. Raditya Dika</p>
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
                                <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                            </div>

                        </div>
                    </div>
                    <!-- END OF ONE RED COURSE CARD -->
                </div>
            </div>


            <div class="col-4 p-0" >
                <div style="display: flex;justify-content:center">
                    <!-- START OF ONE BLUE COURSE CARD -->
                    <div class="course-card-blue">
                        <div class="container">
                            <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                            <div class="top-left card-tag small-text" >Workshop</div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="display:flex;justify-content:space-between;align-items:center">
                                <a href="/woki/sertifikat-menjadi-seniman" class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-bottom:0.5vw;text-decoration:none">How to be funny?</a>
                                <i style="font-size:2vw;" role="button"  aria-controls="workshop-collapse" data-toggle="collapse" href="#workshop-collapse" class="fas fa-caret-down"></i>
                            </div>
                            <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                            <div class="collapse" id="workshop-collapse" style="margin-top:1vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
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
                                <a href="#" class="course-card-button normal-text">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE BLUE COURSE CARD -->
                </div>
            </div>


            <div class="col-4 p-0" >
                <div style="display: flex;justify-content:center">
                    <!-- START OF ONE GREEN COURSE CARD -->
                    <div class="course-card-green">
                        <div class="container">
                            <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                            <div class="top-left card-tag small-text" >Online Course</div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5vw">
                                <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-bottom:0.5vw;text-decoration:none">How to be funny?</a>
                                <i style="font-size:2vw;" role="button"  aria-controls="course-collapse" data-toggle="collapse" href="#course-collapse" class="fas fa-caret-down"></i>
                            </div>
                            <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                            <div class="collapse" id="course-collapse" style="margin-top:1vw">
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
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="/online-course" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;">View All</a>

            </div>
        </div>
    </div>
    <!-- END OF MOST POPULAR -->
    <!-- WOKI -->
    <div class="course-content" id="course-woki" style="display:none">
        <div class="row m-0 p-0">
            <div class="col-4 p-0" >
                <div style="display: flex;justify-content:center">

                    <!-- START OF ONE RED COURSE CARD -->
                    <div class="course-card-red">
                        <div class="container">
                            <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                            <div class="top-left card-tag small-text" >Woki</div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="display:flex;justify-content:space-between;align-items:center">
                                <p class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B">How to be funny?</p>
                                <i style="font-size:2vw;" role="button"  aria-controls="woki-collapse-one" data-toggle="collapse" href="#woki-collapse-one" class="fas fa-caret-down"></i>
                            </div>
                            <div class="collapse" id="woki-collapse-one" style="margin-top:1vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                            <div style="display: flex;justify-content:space-between;margin-top:1vw" >
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
                                <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                            </div>

                        </div>
                    </div>
                    <!-- END OF ONE RED COURSE CARD -->
                </div>
            </div>
            <div class="col-4 p-0" >
                <div style="display: flex;justify-content:center">

                    <!-- START OF ONE RED COURSE CARD -->
                    <div class="course-card-red">
                        <div class="container">
                            <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                            <div class="top-left card-tag small-text" >Woki</div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="display:flex;justify-content:space-between;align-items:center">
                                <p class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B">How to be funny?</p>
                                <i style="font-size:2vw;" role="button"  aria-controls="woki-collapse-two" data-toggle="collapse" href="#woki-collapse-two" class="fas fa-caret-down"></i>
                            </div>
                            <div class="collapse" id="woki-collapse-two" style="margin-top:1vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                            <div style="display: flex;justify-content:space-between;margin-top:1vw" >
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
                                <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                            </div>

                        </div>
                    </div>
                    <!-- END OF ONE RED COURSE CARD -->
                </div>
            </div>
            <div class="col-4 p-0" >
                <div style="display: flex;justify-content:center">

                    <!-- START OF ONE RED COURSE CARD -->
                    <div class="course-card-red">
                        <div class="container">
                            <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                            <div class="top-left card-tag small-text" >Woki</div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="display:flex;justify-content:space-between;align-items:center">
                                <p class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B">How to be funny?</p>
                                <i style="font-size:2vw;" role="button"  aria-controls="woki-collapse-three" data-toggle="collapse" href="#woki-collapse-three" class="fas fa-caret-down"></i>
                            </div>
                            <div class="collapse" id="woki-collapse-three" style="margin-top:1vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                            <div style="display: flex;justify-content:space-between;margin-top:1vw" >
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
                                <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                            </div>

                        </div>
                    </div>
                    <!-- END OF ONE RED COURSE CARD -->
                </div>
            </div>
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="#" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;">View All</a>

            </div>

            
        </div>
    </div>
    <!-- END OF WOKI -->

    <!-- ONLINE COURSE -->
    <div class="course-content" id="course-online" style="display:none">
        <div class="row m-0 p-0">
            @foreach($online_courses as $course)
            <div class="col-4 p-0" >
                <div style="display: flex;justify-content:center">
                    <!-- START OF ONE GREEN COURSE CARD -->
                    <div class="course-card-green">
                        <div class="container">
                            <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                            <div class="top-left card-tag small-text">Online Course</div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="height:6vw">
                                <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                    <a href="/online-course/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;text-decoration:none">{{ $course->title }}</a>
                                    <i style="font-size:2vw;padding-left:0.5vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i>
                                </div>
                                @foreach ($course->hashtags as $tag)
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{ $tag->hashtag }}</a>
                                @endforeach
                            </div>
                            <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">{{ $course->description }}</p>
                            </div>

                            <div style="display: flex;justify-content:space-between;margin-top:1vw" >
                                <p class="very-small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Mr. Raditya Dika</p>
                                @if ($course->total_duration)
                                    <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">{{ $course->total_duration }} mins</p>
                                    @else
                                    <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">- mins</p>

                                @endif
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">{{ $course->average_rating }}/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $course->average_rating)
                                            @if ($i == 1)
                                                <i style="color:#F4C257" class="fas fa-star small-text"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star small-text"></i>
                                            @endif
                                        @else
                                            @if ($i == 1)
                                                <i style="color:#B3B5C2" class="fas fa-star small-text"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star small-text"></i>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                @if ($course->price == 0)
                                    <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">FREE</p>
                                @else
                                    <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                @endif
                                <a href="/online-course/{{$course->id}}" class="course-card-button normal-text">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE GREEN COURSE CARD -->
                </div>
            </div>
            @endforeach
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="/online-course" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;">View All</a>
            </div>
        </div>
    </div>
    <!-- END OF ONLINE COURSE -->

    <!-- END OF CLASSES SECTION -->
    
</div>
<!-- END OF FEATURE, COURSE AND TESTIMONY SECTION -->
<!-- START OF TESTIMONY SECTION -->
<div class="row m-0 page-container" style=";background:#F6F6F6">
        <div class="col-6  testimony-background" style="padding-top:4vw;padding-bottom:4vw;">
            <div style="display: flex;">
                <!-- LEFT TESTIMONY -->
                <div>
                    <!-- BIG TESTIMONY CARD -->
                    <div class="testimony-card" style="width: 20vw;padding:3vw !important">
                        <img src="{{ asset($fake_testimonies_big[0]->thumbnail) }}" class="img-fluid" style="width: 6vw;height:auto" alt="thumbnail not avaliable..">
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000; display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 5 !important;
                        -webkit-box-orient: vertical !important;">{{ $fake_testimonies_big[0]->content }}</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_big[0]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-top:1vw;margin-bottom:0.4vw">{{ $fake_testimonies_big[0]->name }}</p>
                        <p class="small-text" style="font-family: Rubik Medium;color:#808080;margin-bottom:0px">{{ $fake_testimonies_big[0]->occupancy }}</p>
                    </div>
                    <!-- END OF BIG TESTIMONY CARD -->
    
                    <!-- SMALL TESTIMONY CARD -->
                    <div class="testimony-card" style="margin-top: 2vw;width: 15vw;float:right">
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-bottom:0.4vw">{{ $fake_testimonies_small[0]->rating }}/5</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_small[0]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000;margin-top:1vw;margin-bottom:0px;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 3 !important;
                        -webkit-box-orient: vertical !important;">{{ $fake_testimonies_small[0]->content }}</p>
    
                    </div>
                    <!-- END OF SMALL TESTIMONY CARD -->
                </div>
                <!-- END OF LEFT TESTIMONY -->

                <!-- RIGHT TESTIMONY -->
                <div style="margin-left: 2vw">
                     <!-- SMALL TESTIMONY CARD -->
                     <div class="testimony-card" style="width: 12vw;">
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-bottom:0.4vw">{{ $fake_testimonies_small[1]->rating }}/5</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_small[1]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000;margin-top:1vw;margin-bottom:0px;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 3 !important;
                        -webkit-box-orient: vertical !important;">{{ $fake_testimonies_small[1]->content }}</p>
                    </div>
                    <!-- END OF SMALL TESTIMONY CARD -->
                    <!-- BIG TESTIMONY CARD -->
                    <div class="testimony-card"  style="width: 16vw;margin-top:2vw">
                        <img src="{{ asset($fake_testimonies_big[1]->thumbnail) }}" class="img-fluid" style="width: 6vw;height:auto" alt="">
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000">{{ $fake_testimonies_big[1]->content }}</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_big[1]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:1vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:1vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p class="small-text" style="font-family: Rubik Medium;color:#000000;margin-top:1vw;margin-bottom:0.4vw">{{ $fake_testimonies_big[1]->name }}</p>
                        <p class="small-text" style="font-family: Rubik Medium;color:#808080;margin-bottom:0px">{{ $fake_testimonies_big[1]->occupancy }}</p>
                    </div>
                    <!-- END OF BIG TESTIMONY CARD -->

                </div>
                <!-- END OF RIGHT TESTIMONY -->
            </div>
        </div>
        <div class="col-6" style="display: flex;flex-direction: column;justify-content: center;">
            <p class="medium-heading" style="font-family: Rubik Medium;color:#000000;">Our higlighted students <br> revealing</p>
            <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;margin-top:1vw;white-space:pre-line">Lorem ipsum dolor sit amet, consectetur adipiscing
            elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis
            nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. </p>

        </div>
    </div>
    <!-- END OF TESTIMONY SECTION -->

    <!-- START OF PENGAJAR AND COLLABORATOR SECTION -->
    <div class="row m-0 page-container pengajar-background" style="padding-top:4vw;padding-bottom:8vw">
        <div class="col-12 p-0">
            <div style="display:flex;align-items:center;justify-content:center">
                <a href="#menjadi-pengajar" style="text-decoration:none">
                    <div class="rounded-card" style="padding:2vw;height:26vw;text-align:center;width:27.5vw;display: flex;flex-direction: column;justify-content: space-between;align-items:center;margin-right:2vw">
                        <p class="small-heading" id="card-title" style="color:#3B3C43;font-family:Rubik Medium">Menjadi Pengajar</p>
                        <img src="/assets/images/client/Menjadi_Pengajar.png" style="height:13vw;margin-top:1vw" class="img-fluid" alt="Menjadi Pengajar">
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000;margin-bottom:0px;margin-top:1vw">Bagikan pengalamanmu dengan mengajar bersama kami kepada generasi digital saat ini sekarang!</p>
                    </div>
                </a>
                <a href="#menjadi-kollaborator" style="text-decoration:none">
                    <div class="rounded-card" style="padding:2vw;height:26vw;text-align:center;width:27.5vw;display: flex;flex-direction: column;justify-content: space-between;align-items:center;margin-left:2vw">
                        <p class="small-heading" id="card-title" style="color:#3B3C43;font-family:Rubik Medium">Menjadi Kolaborator</p>
                        <img src="/assets/images/client/Menjadi_Kolaborator.png" style="height:13vw;margin-top:1vw" class="img-fluid" alt="Menjadi Kolaborator">
                        <p class="small-text" style="font-family: Rubik Regular;color:#000000;margin-bottom:0px;margin-top:1vw">Bagikan pengalamanmu dengan mengajar bersama kami kepada generasi digital saat ini sekarang!</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- END OF PENGAJAR AND COLLABORATOR SECTION -->

    <!-- START OF NEWSLETTER SECTION -->
    <div class="row m-0 page-container" style="padding-bottom:8vw">
        <div class="col-12" style="padding:0vw 3vw">
            <div style="background-color:#1A1C31;padding:2vw 4vw;border-radius: 10px;display:flex;align-items:center">
                <img src="/assets/images/client/Newsletter_Illustration.png" style="height:10vw" class="img-fluid" alt="Newsletter Illustration">
                <div style="width:80%;margin-left:2vw">
                    <p class="small-heading" style="color:#FFFFFF;font-family:Rubik Bold">Subscribe to our newsletter.....?</p>
                    <div style="display:flex;align-items:center">
                        <input class="normal-text" placeholder="Type your email" name="" type="text" style="background: #F0F4F9;border-radius: 10px;width:75%;padding:0.4vw 1vw;font-family:Rubik Regular;border:none">
                        <button type="submit" style="font-family:Rubik Regular;margin-left:2vw;border:none" class="btn-blue normal-text" >Subscribe Now</button>
                        <!--<a href="#"style="text-decoration: none;font-family:Rubik Regular;margin-left:2vw;padding:0vw"></a>-->

                    </div>

                </div>
            </div> 
        </div>
    </div>
    <!-- END OF NEWSLETTER SECTION -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function changeCourse(evt, categoryName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("course-content")
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("course-links");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("btn-blue-active", "btn-blue-on-hover");
        }
        document.getElementById(categoryName).style.display = "block";
        evt.currentTarget.className += " btn-blue-active";
    }
</script>
<script src="/js/main.js"></script>

@endsection