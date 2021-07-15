@extends('./layouts/client-main')
@section('title', 'Venidici Home')

@section('content')

<!-- START OF POPUP MENJADI PENGAJAR-->
<div id="menjadi-pengajar" class="overlay" style="overflow:scroll">
    <div class="popup">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            <form action="{{route('menjadi_pengajar.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row m-0">
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                        <p class="medium-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Menjadi Pengajar</p>
                        @if (session()->has('menjadi_pengajar_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('menjadi_pengajar_message') }}
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF GENERAL INFORMATION -->
                    <div class="col-12" style="text-align:left;margin-top:1vw">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">General Information</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input type="text" name="name" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="John Doe" >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">No. Telp</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                            <input type="text" name="phone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="+62812345678" >
                        </div>  
                        @error('phone')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                            <input type="email" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="johndoe@gmail.com" >
                        </div>  
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">LinkedIn Link Profile</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fab fa-linkedin"></i>
                            <input type="text" name="linkedIn" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="https://linkedin.com/in/John" >
                        </div>  
                        @error('linkedIn')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Alamat</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <textarea name="address" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan alamat" ></textarea>
                        </div>  
                        @error('address')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Next</button>
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
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-building"></i>
                            <input type="text" name="company" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="PT. Karya Anak Bangsa" >
                        </div>  
                        @error('company')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Nama universitas terakhir kamu</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-university"></i>
                            <input type="text" name="university" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Universitas Indonesia" >
                        </div>  
                        @error('university')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pendidikan terakhir kamu</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-university"></i>
                            <select name="education"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option value="" disabled selected>Pilih Pendidikan</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>                           
                        </div>  
                        @error('education')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pekerjaan kamu saat ini</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-briefcase"></i>
                            <input type="text" name="job" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Guru Matematika" >
                        </div>  
                        @error('job')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    <!-- END OF RIGHT SECTION --> 
                    <!--
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Next</button>
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
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-briefcase"></i>
                            <select name="instructor_position_id"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option value="" disabled selected>Pilih Posisi</option>
                                @foreach($pengajar_positions as $pos)
                                <option value="{{$pos->id}}">{{$pos->name}}</option>
                                @endforeach
                            </select>                           
                        </div>  
                        @error('instructor_position_id')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Gaji Yang Diharapkan</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-money-check"></i>
                            <input type="text" name="salary" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="10000" >
                        </div>   
                        @error('salary')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    <!-- END OF RIGHT SECTION -->

                    <!-- start of drag and drop -->
                    <div class="col-md-12" style="text-align:center;margin-top:1vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0.4vw;margin-top:1.5vw">Unggah file CV/Portfolio kamu disini</p>
                        <div style="padding:0vw 20vw;margin-top:1vw">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt normal-text" style="font-family:Rubik Regular;color:black;"> Drag file CV/Portfolio kamu ke sini untuk Menunggah atau <span style="color:#3F92D8" >Browse</span></span>
                                <input type="file" name="cv" class="drop-zone__input" accept=".pdf">
                            </div>
                        </div>
                        @error('cv')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> 
                    <!-- end of drag and drop -->
                    
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</button>
                    </div>  
                    <!-- END OF PREFERRED JOB SECTION -->

                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP MENJADI PENGAJAR-->

<!-- START OF POPUP MENJADI KOLLABORATOR-->
<div id="menjadi-kolaborator" class="overlay" style="overflow:scroll">
    <div class="popup">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="{{route('collaborators.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row m-0">
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                        <p class="medium-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Menjadi Kollaborator</p>
                        @if (session()->has('menjadi_kolaborator_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('menjadi_kolaborator_message') }}
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan nama" >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Socmed Institusi (optional)</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-heart"></i>
                            <input type="text" name="institution_socmed" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Social Media Institusi" >
                        </div>  
                        @error('institution_socmed')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                            <input type="email" name="email" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Email" >
                        </div>  
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Institusi</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-building"></i>
                            <input type="text" name="institution" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan nama Institusi" >
                        </div>  
                        @error('institution')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Jenis Partnership</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-hands-helping"></i>
                            <select name="collaborator_partnership"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Partnership</option>
                                <option value="Event Collaboration">Event Collaboration</option>
                                <option value="Brand Activation">Brand Activation</option>
                                <option value="ontent Collaboration">Content Collaboration</option>
                                <option value="Other">Other</option>
                            </select>                              
                        </div>  
                        @error('collaborator_partnership')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Nomor Whatsapp</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fab fa-whatsapp"></i>
                            <input type="text" name="whatsapp" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Nomor Whatsapp" >
                        </div>  
                        @error('whatsapp')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Notes</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <textarea name="notes" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan catatan" ></textarea>
                        </div>  
                        @error('notes')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</button>
                    </div>  
                    
                    <!-- END OF GENNERAL INFORMATION -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP MENJADI KOLLABORATOR-->

<!-- START OF BANNER SECTION -->
<div class="row m-0 banner-background page-container "
    style="height: 100vw; padding-top: 16vw; text-align: center;
    background-image: url({{ $configs['cms.homepage.top-section.background']->value }});    background-size: 120% 100%;">
    <form action="{{route('search_course')}}" method="post">
    @csrf
    <div class="col-md-12 p-0 wow fadeInUp" data-wow-delay="0.3s">
        <p style="font-size:7vw;line-height:7vw;font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">{{ $configs['cms.homepage.top-section.heading']->value }}</p>
        <p style="font-size:4vw;line-height:5vw;font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line">{{ $configs['cms.homepage.top-section.sub-heading']->value }}</p>
        <div class="grey-input-form" style="display: flex;align-items:center;width:100%;padding:2vw">
            <input type="text" name="search" style="background:transparent;border:none;color: rgba(0, 0, 0, 0.5);font-family:Rubik Regular;font-size:3vw;width:100%" placeholder="Course Title">
        </div>
        <div class="grey-input-form" style="display: flex;align-items:center;width:100%;margin-top:3vw">
            <select name="filter"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;font-size:3vw">
                <option value="None" disabled selected>Pilih Kategori</option>
                <option value="Skill Snack">Skill Snack</option>
                <option value="Woki">Woki</option>
                <option value="Bootcamp">Bootcamp</option>
            </select>                    
            @error('filter')
                <span class="invalid-feedback" role="alert" style="display: block !important;">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>  
        <button type="submit" onclick="openLoading()" class="btn-search" style="font-size:3vw;width:100%;margin-top:3vw">Search</button>
    </div>        
    </form>
</div>
<!-- END OF BANNER SECTION -->

<!-- START OF TRUSTED COMPANY SECTION -->
<div class="row m-0 page-container"  style="z-index: 99;padding-bottom:5vw;display:none">
    <div class="col-12 p-0" id="trusted-company-margin" style="margin-top:-5vw">
        <div class="wow fadeInRight" data-wow-delay="1s" style="background-color: #FCFCFC;border-radius:10px;padding:1vw 2vw;display:flex;justify-content:space-between;align-items:center">
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


<!-- START OF INDONESIA EMAS SECTION -->
<div class="row m-0 page-container our-programs-background" style="padding-bottom:8vw;padding-top:8vw">
    <div class="col-12 wow bounceInRight" data-wow-delay="0.5s" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
        <img src="/assets/images/client/Emas_BG.png" style="width:40vw" class="img-fluid" alt="">
    </div>
    <div class="col-12 p-0" style="margin-top:10vw;text-align:center">
        <p style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;font-size:5vw">Yuk gotong royong...</p>
        <p  style="font-family: Rubik Medium;color:#2B6CAA;white-space:pre-line;font-size:7vw;line-height:8vw">Bangun
        Indonesia Emas 2045</p>
        <p style="font-family: Rubik Regular;color:#C4C4C4;white-space:pre-line;font-size:4vw">“Karena bangsa yang maju berawal dari rakyatnya yang berkualitas”</p>
    </div>
</div>
<!-- END OF INDONESIA EMAS SECTION -->

<!-- START OF OUR PROGRAMS SECTION -->
<div class="row m-0 page-container our-programs-background" style="padding-bottom:8vw">
    <div class="col-12 p-0" style="text-align:center">
        <p style="font-family: Rubik Medium;color:#55525B;margin-top:1vw;margin-bottom:1vw;font-size:7vw"><span style="font-family:Hypebeast;margin-left:1vw" >PROGRAM </span> Venidici</p>
    </div>
    <!-- START OF ONE PROGRAMS -->
    <div class="col-6 p-0" style="display:flex;justify-content:center">
        <a href="/online-course?cat=Featured" style="text-decoration:none">
            <div class="our-programs-card-homepage" style="margin-top:2.5vw;width:90%">
                <img src="/assets/images/client/Online-Course-Banner.png" style="width:100%;height:20vw;object-fit:cover;border-radius: 5px 5px 0px 0px" class="img-fluid" alt="">
                <div style="padding:1.5vw">
                    <p id="card-title" style="font-family: Rubik Medium;color:#55525B;font-size:3vw;margin-bottom:1vw">Skill Snack</p>
                    <p class=" our-programs-card-description" style="font-family: Rubik Regular;color:#55525B;margin-bottom:1vw;font-size:2.5vw;line-height:2.5vw">Bukan zamannya belajar itu jadi beban, it’s a privilege! Belajar kapanpun dan dimanapun, kamu yang tentuin! Dengan recorded learning session dari berbagai topik, Venidici on Demand bawa pengalaman belajar kamu jadi seru lagi.</p>
                    <a href="/online-course?cat=Featured" class="btn-blue" style="text-decoration: none;font-family:Rubik Regular;font-size:2.5vw">Explore Courses</a>
                </div>
            </div>
        </a>
    </div>
    <!-- END OF ONE PROGRAMS -->
    <!-- START OF ONE PROGRAMS -->
    <div class="col-6 p-0" style="display:flex;justify-content:center">
        <a href="/woki?cat=Featured" style="text-decoration:none">
            <div class="our-programs-card-homepage" style="margin-top:2.5vw;width:90%">
                <img src="/assets/images/client/Woki-Banner.png" style="width:100%;height:20vw;object-fit:cover;border-radius: 5px 5px 0px 0px" class="img-fluid" alt="">
                <div style="padding:1.5vw">
                    <p id="card-title" style="font-family: Rubik Medium;color:#55525B;font-size:3vw;margin-bottom:1vw">Woki</p>
                    <p class=" our-programs-card-description" style="font-family: Rubik Regular;color:#55525B;margin-bottom:1vw;font-size:2.5vw;line-height:2.5vw">Buat kamu yang pengen healing baik sendiri atau bersama teman, tenang ada Woki disini! Woki akan membantu kamu meningkatkan kreativitas dan art skills diselingi dengan sesi healing. #BertumbuhDanPeduli bersama Woki.</p>
                    <a href="/woki?cat=Featured" class="btn-blue" style="text-decoration: none;font-family:Rubik Regular;font-size:2.5vw">Explore Woki</a>
                </div>
            </div>
        </a>
    </div>
    <!-- END OF ONE PROGRAMS -->
    <!-- START OF ONE PROGRAMS -->
    <div class="col-6 p-0" style="display:flex;justify-content:center">
        <a href="/for-corporate/krest" style="text-decoration:none">
            <div class="our-programs-card-homepage" style="margin-top:2.5vw;width:90%">
                <img src="/assets/images/client/Krest-Banner.png" style="width:100%;height:20vw;object-fit:cover;border-radius: 5px 5px 0px 0px;" class="img-fluid" alt="">
                <div style="padding:1.5vw">
                    <p id="card-title" style="font-family: Rubik Medium;color:#55525B;font-size:3vw;margin-bottom:1vw">Krest</p>
                    <p class=" our-programs-card-description" style="font-family: Rubik Regular;color:#55525B;margin-bottom:1vw;font-size:2.5vw;line-height:2.5vw">Buat kamu yang pengen healing baik sendiri atau bersama teman, tenang ada Woki disini! Woki akan membantu kamu meningkatkan kreativitas dan art skills diselingi dengan sesi healing. #BertumbuhDanPeduli bersama Woki.</p>
                    <a href="/for-corporate/krest" class="btn-blue" style="text-decoration: none;font-family:Rubik Regular;font-size:2.5vw">Explore Krest</a>
                </div>
            </div>
        </a>
    </div>
    <!-- END OF ONE PROGRAMS -->
</div>
<!-- END OF OUR PROGRAMS SECTION -->

<!-- START OF FEATURE, COURSE AND TESTIMONY SECTION -->
<div class="row m-0 page-container" style="padding-bottom: 6vw;">
    <!-- START OF FEATURE SECTION -->
    <div class="col-12 p-0 wow flash" data-wow-delay="0.2s" style="text-align: center;">
        <p style="font-family: Rubik Medium;color:#3B3C43;white-space:pre-line;margin-top:3vw;font-size:5vw">Apa yang akan kamu dapat
        dari Venidici?</p>
    </div>
    <div class="col-12 p-0" style="display:flex;justify-content:center;margin-top:2vw">

        <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 6vw;">
                
                <div class="carousel-item active">
                    <div class="card-white" style="display: flex;align-items:center;height:22vw;width:70vw">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 20vw;" alt="">
                        <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: center;">
                            <p  style="font-family: Rubik Medium;color:#3B3C43;font-size:3vw;margin-bottom:1vw">Skill Penunjang Karir</p>
                            <p  style="font-family: Rubik Regular;color:#3B3C43;font-size:2.5vw;margin-bottom:0px">Dapetin skill yang kamu mau dan taklukin karir impian melalui Venidici Bootcamp</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-white" style="display: flex;align-items:center;height:22vw;width:70vw">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 20vw;" alt="">
                        <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: center;">
                            <p  style="font-family: Rubik Medium;color:#3B3C43;font-size:3vw;margin-bottom:1vw">Healing bersama dengan teman baru!</p>
                            <p  style="font-family: Rubik Regular;color:#3B3C43;font-size:2.5vw;margin-bottom:0px">Bareng woki, healing sambil berkarya dan bercerita</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="card-white" style="display: flex;align-items:center;height:22vw;width:70vw">
                        <img src="/assets/images/client/illustration-dummy.png" class="img-fluid" style="width: 20vw;" alt="">
                        <div style="margin-left:1vw;display: flex;flex-direction: column;justify-content: center;">
                            <p  style="font-family: Rubik Medium;color:#3B3C43;font-size:3vw;margin-bottom:1vw">Jangan sampai perusahaan kamu kalah saing!</p>
                            <p  style="font-family: Rubik Regular;color:#3B3C43;font-size:2.5vw;margin-bottom:0px">Krest bisa bantu naikkin performa tim kamu lewat hands-on workshop yang seru</p>
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
    <div class="col-12" style="text-align: center;margin-top:12vw">
        <p style="font-family: Rubik Medium;color:#3B3C43;font-size:7vw">Top <span style="font-family:Hypebeast;color:#A24A9C" >CLASSES</span> for you</p>
            <div style="display:flex;justify-content:space-between;align-items:center;background: #FFFFFF;border: 2px solid rgba(157, 157, 157, 0.1);border-radius: 10px;padding:2vw">

                <p class=" btn-blue-on-hover btn-blue-active course-links" onclick="changeCourse(event, 'course-popular')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;font-size:3vw">Most Popular</p>
                <p class=" btn-blue-on-hover course-links"  onclick="changeCourse(event, 'course-woki')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;font-size:3vw">Woki</p>
                <p class=" btn-blue-on-hover course-links" onclick="changeCourse(event, 'course-online')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;font-size:3vw">Skill Snack</p>
                <p class=" btn-blue-on-hover course-links" onclick="changeCourse(event, 'bootcamp')" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;font-size:3vw">Bootcamp</p>
                <!--
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Bootcamp</p>
                <p class="normal-text btn-blue-on-hover" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer">Workshop</p>
                -->
            </div>
    </div>
    <!-- MOST POPULAR -->
    <div class="course-content" id="course-popular" style="">
        <div class="row m-0 p-0">
            @if(count($most_popular_courses) == 0)
                <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 5px;padding:1vw;text-align:center">
                    <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum tersedia.</span></p>
                </div>
            @endif
            @foreach($most_popular_courses as $course)
            <div class="col-12 p-0" style="margin-top:2vw">
                <div style="display: flex;justify-content:center">
                    <!-- START OF ONE COURSE CARD -->

                    @if ($course->courseType->type == "Course")
                        <div class="course-card-green">
                    @elseif ($course->courseType->type == "Woki")
                        <div class="course-card-red">
                    @elseif ($course->courseType->type == "Bootcamp")
                        <div class="course-card-blue">
                    @endif
                        <div class="container">
                            <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:30vw;" alt="Snow">
                            <div class="top-left card-tag " style="font-size:2.5vw">
                                @if ($course->courseType->type == "Course")
                                Skill-Snack
                                @elseif ($course->courseType->type == "Woki")
                                Woki
                                @elseif ($course->courseType->type == "Bootcamp")
                                Bootcamp
                                @endif
                            </div>
                            <div class="bottom-left" id="course-card-description" style="opacity:0;bottom:0;text-align:left;">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: #FFFFFF;">{{ $course->description }}</p>
                            </div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="height:10vw">
                                <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                    @if ($course->courseType->type == 'Course')
                                        <a href="/online-course/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;font-size:4vw">{{ $course->title }}</a>
                                    @elseif ($course->courseType->type == 'Woki')
                                        <a href="/woki/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;font-size:4vw">{{ $course->title }}</a>

                                    @elseif ($course->courseType->type == 'Bootcamp')
                                        <a href="/bootcamp/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;font-size:4vw">{{ $course->title }}</a>

                                    @endif
                                    <!-- <i style="font-size:2vw;padding-left:4vw;font-size:4vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i> -->
                                </div>
                                @foreach ($course->hashtags as $tag)
                                    <a  style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;font-size:3vw">{{ $tag->hashtag }}</a>
                                @endforeach
                            </div>
                            <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                <p class="course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);font-size:3vw">{{ $course->description }}</p>
                            </div>

                            <div style="display: flex;justify-content:space-between;margin-top:3vw" >
                                <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3vw">
                                @foreach($course->teachers as $teacher)

                                    @if ($loop->last && count($course->teachers) != 1)
                                    dan
                                    @elseif (!$loop->first)
                                    ,
                                    @endif
                                    {{$teacher->name}}
                                @endforeach
                                </p>
                                <p  style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;font-size:3vw">
                                @if ($course->courseType->type == 'Course' || $course->courseType->type == 'Bootcamp')
                                    @if ($course->total_duration)
                                        {{ explode(',', $course->total_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @elseif ($course->courseType->type == 'Woki')
                                    @if ($course->wokiCourseDetail->event_duration)
                                        {{ explode(',', $course->wokiCourseDetail->event_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @endif
                                </p>
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px;font-size:3vw">{{ $course->average_rating }}/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $course->average_rating)
                                            @if ($i == 1)
                                                <i style="color:#F4C257;font-size:3vw" class="fas fa-star"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#F4C257;font-size:3vw" class="fas fa-star"></i>
                                            @endif
                                        @else
                                            @if ($i == 1)
                                                <i style="color:#B3B5C2;font-size:3vw" class="fas fa-star"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#B3B5C2;font-size:3vw" class="fas fa-star"></i>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                @if ($course->price == 0)
                                    <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3.5vw">FREE</p>
                                @else
                                    <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3.5vw">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                @endif
                                @if ($course->courseType->type == 'Course')
                                    <a href="/online-course/{{$course->id}}" class="course-card-button" style="font-size:3.5vw">Enroll Now</a>
                                    @elseif ($course->courseType->type == 'Woki')
                                    <a href="/woki/{{ $course->id }}" class="course-card-button" style="font-size:3.5vw">Enroll Now</a>
                                    @elseif ($course->courseType->type == 'Bootcamp')
                                    <a href="/bootcamp/{{ $course->id }}" class="course-card-button" style="font-size:3.5vw">Enroll Now</a>
                                @endif
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE COURSE CARD -->
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- END OF MOST POPULAR -->
    <!-- WOKI -->
    <div class="course-content" id="course-woki" style="display:none">
        <div class="row m-0 p-0">
            @if(count($wokis) == 0)
                <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 5px;padding:1vw;text-align:center">
                    <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum tersedia.</span></p>
                </div>
            @endif
            @foreach($wokis as $course)
            <div class="col-12 p-0" style="margin-top:2vw">
                <div style="display: flex;justify-content:center">
                    <!-- START OF ONE RED COURSE CARD -->

                    <div class="course-card-red">
                        <div class="container">
                            <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:30vw" alt="Snow">
                            <div class="top-left card-tag " style="font-size:2.5vw">Skill-Snack</div>
                            <div class="bottom-left" id="course-card-description" style="opacity:0;bottom:0;text-align:left;">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: #FFFFFF;">{{ $course->description }}</p>
                            </div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="height:10vw">
                                <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                    <a href="/online-course/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;font-size:4vw">{{ $course->title }}</a>
                                    <!-- <i style="font-size:2vw;padding-left:4vw;font-size:4vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i> -->
                                </div>
                                @foreach ($course->hashtags as $tag)
                                    <a  style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;font-size:3vw">{{ $tag->hashtag }}</a>
                                @endforeach
                            </div>
                            <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                <p class="course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);font-size:3vw">{{ $course->description }}</p>
                            </div>

                            <div style="display: flex;justify-content:space-between;margin-top:3vw" >
                                <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3vw">
                                @foreach($course->teachers as $teacher)

                                    @if ($loop->last && count($course->teachers) != 1)
                                    dan
                                    @elseif (!$loop->first)
                                    ,
                                    @endif
                                    {{$teacher->name}}
                                @endforeach
                                </p>
                                <p  style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;font-size:3vw">
                                @if ($course->courseType->type == 'Course' || $course->courseType->type == 'Bootcamp')
                                    @if ($course->total_duration)
                                        {{ explode(',', $course->total_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @elseif ($course->courseType->type == 'Woki')
                                    @if ($course->wokiCourseDetail->event_duration)
                                        {{ explode(',', $course->wokiCourseDetail->event_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @endif
                                </p>
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px;font-size:3vw">{{ $course->average_rating }}/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $course->average_rating)
                                            @if ($i == 1)
                                                <i style="color:#F4C257;font-size:3vw" class="fas fa-star"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#F4C257;font-size:3vw" class="fas fa-star"></i>
                                            @endif
                                        @else
                                            @if ($i == 1)
                                                <i style="color:#B3B5C2;font-size:3vw" class="fas fa-star"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#B3B5C2;font-size:3vw" class="fas fa-star"></i>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                @if ($course->price == 0)
                                    <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3.5vw">FREE</p>
                                @else
                                    <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3.5vw">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                @endif
                                <a href="/online-course/{{$course->id}}" class="course-card-button" style="font-size:3.5vw">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE RED COURSE CARD -->
                </div>
            </div>
            @endforeach
            @if(count($wokis) != 0)
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="/woki?cat=Featured" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;padding:0.5vw 3vw;font-size:4vw">View All</a>

            </div>
            @endif

            
        </div>
    </div>
    <!-- END OF WOKI -->

    <!-- Skill-Snack -->
    <div class="course-content" id="course-online" style="display:none">
        <div class="row m-0 p-0">
            @if(count($online_courses) == 0)
                <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 5px;padding:1vw;text-align:center">
                    <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum tersedia.</span></p>
                </div>
            @endif
            @foreach($online_courses as $course)
            <div class="col-12 p-0" style="margin-top:2vw">
                <div style="display: flex;justify-content:center">
                    <!-- START OF ONE GREEN COURSE CARD -->

                    <div class="course-card-green">
                        <div class="container">
                            <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:30vw" alt="Snow">
                            <div class="top-left card-tag " style="font-size:2.5vw">Skill-Snack</div>
                            <div class="bottom-left" id="course-card-description" style="opacity:0;bottom:0;text-align:left;">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: #FFFFFF;">{{ $course->description }}</p>
                            </div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="height:10vw">
                                <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                    <a href="/online-course/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;font-size:4vw">{{ $course->title }}</a>
                                    <!-- <i style="font-size:2vw;padding-left:4vw;font-size:4vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i> -->
                                </div>
                                @foreach ($course->hashtags as $tag)
                                    <a  style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;font-size:3vw">{{ $tag->hashtag }}</a>
                                @endforeach
                            </div>
                            <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                <p class="course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);font-size:3vw">{{ $course->description }}</p>
                            </div>

                            <div style="display: flex;justify-content:space-between;margin-top:3vw" >
                                <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3vw">
                                @foreach($course->teachers as $teacher)

                                    @if ($loop->last && count($course->teachers) != 1)
                                    dan
                                    @elseif (!$loop->first)
                                    ,
                                    @endif
                                    {{$teacher->name}}
                                @endforeach
                                </p>
                                <p  style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;font-size:3vw">
                                @if ($course->courseType->type == 'Course' || $course->courseType->type == 'Bootcamp')
                                    @if ($course->total_duration)
                                        {{ explode(',', $course->total_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @elseif ($course->courseType->type == 'Woki')
                                    @if ($course->wokiCourseDetail->event_duration)
                                        {{ explode(',', $course->wokiCourseDetail->event_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @endif
                                </p>
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px;font-size:3vw">{{ $course->average_rating }}/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $course->average_rating)
                                            @if ($i == 1)
                                                <i style="color:#F4C257;font-size:3vw" class="fas fa-star"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#F4C257;font-size:3vw" class="fas fa-star"></i>
                                            @endif
                                        @else
                                            @if ($i == 1)
                                                <i style="color:#B3B5C2;font-size:3vw" class="fas fa-star"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#B3B5C2;font-size:3vw" class="fas fa-star"></i>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                @if ($course->price == 0)
                                    <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3.5vw">FREE</p>
                                @else
                                    <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3.5vw">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                @endif
                                <a href="/online-course/{{$course->id}}" class="course-card-button" style="font-size:3.5vw">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE GREEN COURSE CARD -->
                </div>
            </div>
            @endforeach
            @if(count($online_courses) != 0)
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="/online-course?cat=Featured" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;padding:0.5vw 3vw;font-size:4vw">View All</a>
            </div>
            @endif
        </div>
    </div>
    <!-- END OF Skill-Snack -->

    <!-- Bootcamp -->
    <div class="course-content" id="bootcamp" style="display:none">
        <div class="row m-0 p-0">
            @if(count($bootcamps) == 0)
                <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 5px;padding:1vw;text-align:center">
                    <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum tersedia.</span></p>
                </div>
            @endif
            @foreach($bootcamps as $course)
            <div class="col-12 p-0" style="margin-top:2vw">
                <div style="display: flex;justify-content:center">
                    <!-- START OF ONE BLUE COURSE CARD -->

                    <div class="course-card-blue">
                        <div class="container">
                            <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:30vw" alt="Snow">
                            <div class="top-left card-tag " style="font-size:2.5vw">Bootcamp</div>
                            <div class="bottom-left" id="course-card-description" style="opacity:0;bottom:0;text-align:left;">
                                <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: #FFFFFF;">{{ $course->description }}</p>
                            </div>
                        </div>
                        <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                            <div style="height:10vw">
                                <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                    <a href="/online-course/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;font-size:4vw">{{ $course->title }}</a>
                                    <!-- <i style="font-size:2vw;padding-left:4vw;font-size:4vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i> -->
                                </div>
                                @foreach ($course->hashtags as $tag)
                                    <a  style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;font-size:3vw">{{ $tag->hashtag }}</a>
                                @endforeach
                            </div>
                            <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                <p class="course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);font-size:3vw">{{ $course->description }}</p>
                            </div>

                            <div style="display: flex;justify-content:space-between;margin-top:3vw" >
                                <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3vw">
                                @foreach($course->teachers as $teacher)

                                    @if ($loop->last && count($course->teachers) != 1)
                                    dan
                                    @elseif (!$loop->first)
                                    ,
                                    @endif
                                    {{$teacher->name}}
                                @endforeach
                                </p>
                                <p  style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;font-size:3vw">
                                @if ($course->courseType->type == 'Course' || $course->courseType->type == 'Bootcamp')
                                    @if ($course->total_duration)
                                        {{ explode(',', $course->total_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @elseif ($course->courseType->type == 'Woki')
                                    @if ($course->wokiCourseDetail->event_duration)
                                        {{ explode(',', $course->wokiCourseDetail->event_duration)[0] }} mins
                                    @else
                                        - mins
                                    @endif
                                @endif
                                </p>
                            </div>
                            <div id="star-section" style="display:flex;align-items:center;margin-top:1vw;padding-bottom:1vw">
                                <p style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px;font-size:3vw">{{ $course->average_rating }}/5</p>
                                <div style="display: flex;justify-content:center;margin-left:1vw">
                                    @for ($i = 1; $i < 6; $i++)
                                        @if ($i <= $course->average_rating)
                                            @if ($i == 1)
                                                <i style="color:#F4C257;font-size:3vw" class="fas fa-star"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#F4C257;font-size:3vw" class="fas fa-star"></i>
                                            @endif
                                        @else
                                            @if ($i == 1)
                                                <i style="color:#B3B5C2;font-size:3vw" class="fas fa-star"></i>
                                            @else
                                                <i style="margin-left:0.5vw;color:#B3B5C2;font-size:3vw" class="fas fa-star"></i>
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                @if ($course->price == 0)
                                    <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3.5vw">FREE</p>
                                @else
                                    <p style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;font-size:3.5vw">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                @endif
                                <a href="/online-course/{{$course->id}}" class="course-card-button" style="font-size:3.5vw">Enroll Now</a>
                            </div>
            
                        </div>
                    </div>
                    <!-- END OF ONE BLUE COURSE CARD -->
                </div>
            </div>
            @endforeach
            @if(count($bootcamps) != 0)
            <div class="col-12 p-0" style="text-align: center;margin-top:5vw">
                <a href="/online-course?cat=Featured" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;padding:0.5vw 3vw;font-size:4vw">View All</a>
            </div>
            @endif
        </div>
    </div>
    <!-- END OF Bootcamp -->

    <!-- END OF CLASSES SECTION -->
    
</div>
<!-- END OF FEATURE, COURSE AND TESTIMONY SECTION -->
<!-- START OF TESTIMONY SECTION -->
<div class="row m-0 page-container" style=";background:#F6F6F6">
        <div class="col-12" style="display: flex;flex-direction: column;justify-content: center;padding-top:5vw">
            <p  style="font-family: Rubik Medium;color:#000000;font-size:4vw">Ga percaya kita? Tanya sama mereka</p>
            <p  style="font-family: Rubik Regular;color:#000000;margin-top:1vw;white-space:pre-line;font-size:3vw">Berhasil dapetin nilai rata-rata XX dari XX di berbagai
            program-program sebelumnya ngebuktiin bahwa
            Venidici siap untuk bawa masalah pendidikan dan
            karir di Indonesia to the next level!</p>

        </div>
        <div class="col-12 testimony-background wow flipInX" data-wow-delay="1s" style="padding-top:4vw;padding-bottom:4vw;">
            <div style="display: flex;justify-content:center">
                <!-- LEFT TESTIMONY -->
                <div>
                    <!-- BIG TESTIMONY CARD -->
                    <div class="testimony-card" style="width: 40vw;padding:1vw !important">
                        <img src="{{ asset($fake_testimonies_big[0]->thumbnail) }}" class="img-fluid" style="width: 10vw;height:auto" alt="thumbnail not avaliable..">
                        <p style="font-family: Rubik Regular;color:#000000; display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 5 !important;
                        -webkit-box-orient: vertical !important;font-size:2.5vw;margin-top:2vw">{{ $fake_testimonies_big[0]->content }}</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_big[0]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:2.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:2.5vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:2.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:2.5vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p style="font-family: Rubik Medium;color:#000000;margin-top:1vw;margin-bottom:0.4vw;font-size:2.5vw">{{ $fake_testimonies_big[0]->name }}</p>
                        <p style="font-family: Rubik Medium;color:#808080;margin-bottom:0px;font-size:2.5vw">{{ $fake_testimonies_big[0]->occupancy }}</p>
                    </div>
                    <!-- END OF BIG TESTIMONY CARD -->
    
                    <!-- SMALL TESTIMONY CARD -->
                    <div class="testimony-card" style="margin-top: 2vw;width: 35vw;float:right">
                        <p style="font-family: Rubik Medium;color:#000000;margin-bottom:0.4vw;font-size:2.5vw">{{ $fake_testimonies_small[0]->rating }}/5</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_small[0]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:2.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:2.5vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:2.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:2.5vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p style="font-family: Rubik Regular;color:#000000;margin-top:1vw;margin-bottom:0px;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 3 !important;
                        -webkit-box-orient: vertical !important;font-size:2.5vw">{{ $fake_testimonies_small[0]->content }}</p>
    
                    </div>
                    <!-- END OF SMALL TESTIMONY CARD -->
                </div>
                <!-- END OF LEFT TESTIMONY -->

                <!-- RIGHT TESTIMONY -->
                <div style="margin-left: 2vw">
                     <!-- SMALL TESTIMONY CARD -->
                     <div class="testimony-card" style="width: 32vw;">
                        <p style="font-family: Rubik Medium;color:#000000;margin-bottom:0.4vw;font-size:2.5vw">{{ $fake_testimonies_small[1]->rating }}/5</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_small[1]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:2.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:2.5vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:2.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:2.5vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p style="font-family: Rubik Regular;color:#000000;margin-top:1vw;margin-bottom:0px;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 3 !important;
                        -webkit-box-orient: vertical !important;font-size:2.5vw">{{ $fake_testimonies_small[1]->content }}</p>
                    </div>
                    <!-- END OF SMALL TESTIMONY CARD -->
                    <!-- BIG TESTIMONY CARD -->
                    <div class="testimony-card"  style="width: 36vw;margin-top:2vw">
                        <img src="{{ asset($fake_testimonies_big[1]->thumbnail) }}" class="img-fluid" style="width: 10vw;height:auto" alt="">
                        <p style="font-family: Rubik Regular;color:#000000;font-size:2.5vw;margin-top:2vw">{{ $fake_testimonies_big[1]->content }}</p>
                        <div style="display: flex;justify-content:center">
                            @for ($i = 1; $i < 6; $i++)
                                @if ($i <= $fake_testimonies_big[1]->rating)
                                    @if ($i == 1)
                                        <i style="font-size:2.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:2.5vw;margin-left:0.5vw;color:#F4C257" class="fas fa-star"></i>
                                    @endif
                                @else
                                    @if ($i == 1)
                                        <i style="font-size:2.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @else
                                        <i style="font-size:2.5vw;margin-left:0.5vw;color:#B3B5C2" class="fas fa-star"></i>
                                    @endif
                                @endif
                            @endfor
                        </div>
                        <p style="font-family: Rubik Medium;color:#000000;margin-top:1vw;margin-bottom:0.4vw;font-size:2.5vw">{{ $fake_testimonies_big[1]->name }}</p>
                        <p style="font-family: Rubik Medium;color:#808080;margin-bottom:0px;font-size:2.5vw">{{ $fake_testimonies_big[1]->occupancy }}</p>
                    </div>
                    <!-- END OF BIG TESTIMONY CARD -->

                </div>
                <!-- END OF RIGHT TESTIMONY -->
            </div>
        </div>
        
    </div>
    <!-- END OF TESTIMONY SECTION -->

    <!-- START OF PENGAJAR AND COLLABORATOR SECTION -->
    <div class="row m-0 page-container pengajar-background" style="padding-top:4vw;padding-bottom:8vw">
        <div class="col-12 p-0">
            <div style="display:flex;align-items:center;justify-content:center">
                
                <a href="#menjadi-pengajar" style="text-decoration:none">
                    <div class="rounded-card rounded-card-pengajar" style="padding:2vw;height:44vw;text-align:center;width:42vw;display: flex;flex-direction: column;justify-content: space-between;align-items:center;margin-right:2vw">
                        <p id="card-title" style="color:#3B3C43;font-family:Rubik Medium;font-size:3vw">Menjadi Pengajar</p>
                        <img src="/assets/images/client/Menjadi_Pengajar.png" style="height:20vw;margin-top:1vw" class="img-fluid" alt="Menjadi Pengajar">
                        <p style="font-family: Rubik Regular;color:#000000;margin-bottom:0px;margin-top:1vw;font-size:2vw">Bawa perubahan bagi Indonesia melalui pengalaman yang kamu miliki!</p>
                    </div>
                </a>
                <a href="#menjadi-kolaborator" style="text-decoration:none">
                    <div class="rounded-card rounded-card-collaborator" style="padding:2vw;height:44vw;text-align:center;width:42vw;display: flex;flex-direction: column;justify-content: space-between;align-items:center;margin-right:2vw">
                        <p id="card-title" style="color:#3B3C43;font-family:Rubik Medium;font-size:3vw">Menjadi Kolaborator</p>
                        <img src="/assets/images/client/Menjadi_Kolaborator.png" style="height:20vw;margin-top:1vw" class="img-fluid" alt="Menjadi Kolaborator">
                        <p style="font-family: Rubik Regular;color:#000000;margin-bottom:0px;margin-top:1vw;font-size:2vw">1+1=11! Mari berkembang bersama dan hasilin dampak!</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- END OF PENGAJAR AND COLLABORATOR SECTION -->

    <!-- START OF NEWSLETTER SECTION -->
    <div class="row m-0 page-container" id="newsletter-section" style="padding-bottom:8vw">
        @if (session()->has('newsletter_message'))
        <div class="col-12 p-0" style="padding:1vw 3vw">
            <div class="mb-0">
                <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                    {{ session()->get('newsletter_message') }}
                </div>
            </div>
        </div>
        
        @elseif (session()->has('newsletter_info_message'))
        <div class="col-12 p-0" style="padding:1vw 3vw">
            <div class="mb-0">
                <div class="alert alert-warning alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                    {{ session()->get('newsletter_info_message') }}
                </div>
            </div>
        </div>
        @endif
        <form action="{{route('newsletter.store')}}" method="post" style="padding:0px">
        @csrf
        <div class="col-12 " style="padding:0vw 3vw">
            <div style="background-color:#1A1C31;padding:2vw 4vw;border-radius: 10px;display:flex;align-items:center">
                <img src="/assets/images/client/Newsletter_Illustration.png" style="height:15vw" class="img-fluid" alt="Newsletter Illustration">
                <div style="width:80%;margin-left:2vw">
                    <p class="wow fadeInUp" data-wow-delay="0.5s" style="color:#FFFFFF;font-family:Rubik Bold;font-size:3vw">Beneran rela ketinggalan info…?</p>
                    <div style="display:flex;align-items:center">
                        <input required placeholder="Type your email" name="email" type="text" style="background: #F0F4F9;border-radius: 10px;width:75%;padding:0.4vw 1vw;font-family:Rubik Regular;border:none;font-size:2vw">
                        <button type="submit" onclick="openLoading()" style="font-family:Rubik Regular;margin-left:2vw;border:none;font-size:2vw" class="btn-blue text-nowrap" >Subscribe Now</button>
                        <!--<a href="#"style="text-decoration: none;font-family:Rubik Regular;margin-left:2vw;padding:0vw"></a>-->
                    </div>
                </div>
            </div> 
        </div>
        </form>
    </div>
    <!-- END OF NEWSLETTER SECTION -->
    <div class="row m-0 page-container"  style="padding-top:5vw;padding-bottom:8vw;">
        <div class="col-12 p-0">
            <div class="wow fadeInRight">
                <div style="text-align: center;">
                    <p class="big-heading" style="font-family: Rubik Medium;color:#000000;margin-bottom:0px">{{ $configs['cms.homepage.trusted-company-section.trusted-company-count']->value }}</p>
                    <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA;margin-top:2vw;margin-bottom:0px">Trusted Companies</p>
                </div>
                <div style="display:flex;align-items:center;justify-content:center;flex-wrap: wrap;">
                    @foreach ($trusted_companies as $company)
                        <div style="padding:0vw 4vw">
                            <img src="{{ asset($company->image) }}" style="max-height:8vw;margin-top:5vw" class="img-fluid" alt="Image not available..">                
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
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