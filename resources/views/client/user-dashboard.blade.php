@extends('./layouts/client-main')
@section('title', 'Venidici User Dashboard')

@section('content')

<!-- UPGRADE BOOTCAMP POP UP -->
<div class="modal fade" id="upgradeBootcamp" tabindex="-1" role="dialog"  aria-labelledby="upgradeBootcamp" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="text-align:center;">
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;">Upgrade Bootcamp</p>
                        <form action="{{route('bootcamp.upgrade-status')}}" method="POST">
                        @csrf
                        @method('put')
                            <div>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px;margin-top:0.5vw"role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @elseif (session('danger'))
                                    <div class="alert alert-danger alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px;margin-top:0.5vw"role="alert">
                                        {{ session('danger') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <input type="hidden" name="bootcamp_application_id" id="bootcamp_application_id">
                                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;" required>Kenapa kamu memililih Bootcamp ini?</p>
                                <div  class="auth-input-form" >
                                    <textarea name="kenapa_memilih" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan jawaban anda" >{{old('kenapa_memilih')}}</textarea>
                                </div>  
                                @error('kenapa_memilih')
                                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div style="text-align:right;margin-top:1vw">
                                    <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Submit</button>                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF UPGRADE BOOTCAMP POP UP -->

<!-- START OF POP UP BOOTCAMP-->
<div id="bootcamp-detail" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:50%">
        <a class="close" href="#closed" >&times;</a>
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12" style="text-align:left;">
                    <p class="sub-description" id="bootcamp-title" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Bootcamp: Abcd</p>
                </div>
                <div class="col-6" style="">
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                    <div  class="auth-input-form" style="display: flex;align-items:center">
                        <i style="color:#DAD9E2" class="fas fa-user "></i>
                        <input type="text" id="bootcamp-name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                            placeholder="John Doe" value="Fernandha Dzaky" readonly >
                    </div>  
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Phone Number</p>
                    <div  class="auth-input-form" style="display: flex;align-items:center">
                        <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                        <input type="text" id="bootcamp-phone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                            placeholder="Insert phone number" value="08111377893" readonly >
                    </div>  
                    
                </div> 
                <!-- END OF LEFT SECTION --> 
                <!-- RIGHT SECTION -->
                <div class="col-6" >
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
                    <div  class="auth-input-form" style="display: flex;align-items:center">
                        <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                        <input type="text" id="bootcamp-email" value="admin@gmail.com" readonly  class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                            placeholder="Insert email">
                    </div>
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Bank and Account Number</p>
                    <div style="display: flex;align-items:center">
                        <div  class="auth-input-form" style="display: flex;align-items:center;width:40%">
                            <i style="color:#DAD9E2" class="fas fa-money-check-alt"></i>
                            <input type="text" value="BCA" readonly id="bootcamp-bank" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                            >                  
                        </div>  
                        <div  class="auth-input-form" style="display: flex;align-items:center;margin-left:1vw;width:60%">
                            <input type="text" id="bootcamp-bank_account_number" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%"
                                placeholder="Bank Account Number" value="2068231197" readonly>
                        </div>
                    </div>
                </div>
                <!-- END OF RIGHT SECTION -->
                <div class="col-12">

                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Address</p>
                    <div  class="auth-input-form" style="display: flex;align-items:center">
                        <i style="color:#DAD9E2" class="fas fa-map-marker-alt"></i>
                        <textarea type="text" id="bootcamp-address" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                            placeholder="Insert address" readonly>257 Rosenbaum Rue Suite 056
                            New Darrel, WA 08480-4910 </textarea>
                    </div>
                    
                </div> 
            </div>       
        </div>
    </div>
</div>
<!-- END OF POP UP BOOTCAMP-->



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

            <form action="{{ route('customer.update_profile', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')        
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;">
                        @if(session('success'))
                            <!-- ALERT MESSAGE -->
                            <div style="text-align:center;margin-top:1vw">
                                <div class="alert alert-success alert-dismissible fade show small-text alert-message-success"  style="text-align:center;margin-bottom:1vw;width:20vw"role="alert">
                                {{ session('success') }}
                                    <button type="button" class="btn-close close-btn-edit-popup-mobile" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            <!-- END OF ALERT MESSAGE -->
                        @endif
                        <p class="sub-description" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">General Information</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">@if(Auth::user()->avatar) Current @endif Display Picture</p>
                        @if(Auth::user()->avatar)
                            <img src="{{ asset(Auth::user()->avatar) }}" style="width:6vw" id="edit-profile-mobile-image" alt="Failed to load user's profile image.."> <br>
                        @endif

                        <input type="file" id="images" class="input-file-fontsize" name="avatar" accept=".jpg,.jpeg,.png" style="margin-top:1vw"/>
                        <!--
                        <label id="uploadButton" for="images" style="font-family:Rubik Medium">Choose Image</label>-->
                    </div>
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user popup-krest-font"></i>
                            <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                                placeholder="John Doe" value="{{ old('name', Auth::user()->name) }}">
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Phone Number</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-phone-alt popup-krest-font"></i>
                            <input type="text" name="telephone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                                placeholder="Insert telephone number" value="{{ old('telephone', Auth::user()->userDetail->telephone) }}">
                        </div>  
                        @error('telephone')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Gender</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user popup-krest-font"></i>
                            <select name="gender" id="" class="normal-text"  style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%">
                                <option disabled selected>Choose Gender</option>
                                <option value="Male" @if(old('gender', Auth::user()->userDetail->gender) == 'Male') selected @endif>Male</option>
                                <option value="Female" @if(old('gender', Auth::user()->userDetail->gender) == 'Female') selected @endif>Female</option>
                            </select>
                        </div> 
                        @error('gender')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                        
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Birthdate</p>
                        <?php
                            if (Auth::user()->userDetail->birthdate != null) {
                                $birthdate = explode(' ', Auth::user()->userDetail->birthdate);
                                $date = $birthdate[0];
                                $time = $birthdate[1];
                            }
                        ?>
                        @if($agent->browser() == "Safari")
                            @php
                                if (Auth::user()->userDetail->birthdate != null) {
                                    $birthdate_safari = explode('-',$date);
                                    $year_safari = $birthdate_safari[0];
                                    $month_safari = $birthdate_safari[1];
                                    $date_safari = $birthdate_safari[2];
                                }

                            @endphp
                            <div style="display: flex;align-items:center;justify-content:space-between">
                            <div class="auth-input-form" style="width: 30%;">
                                <input type="text" name="date" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%"
                                    placeholder="Tanggal"  @if(Auth::user()->userDetail->birthdate != null)  value="{{$date_safari}}" @endif>
                            </div>  
                            <div class="auth-input-form" style="width: 30%;">
                                <select name="month" id=""  class="normal-text"  style="background:transparent;border:none;color: #3B3C43;;width:100%">
                                    @php
                                        $months = array("January"=>"01","February"=>"02","March"=>"03",
                                        "April"=>"04","May"=>"05","June"=>"06","July"=>"07","August"=>"08",
                                        "September"=>"09","October"=>"10","November"=>"11","December"=>"12");
                                    @endphp
                                    @foreach($months as $key => $value) {
                                        <option  
                                        @if(Auth::user()->userDetail->birthdate != null)
                                            @if($month_safari == $value) selected @endif 
                                        @endif
                                        value="{{$value}}" 
                                        >{{$key}}</option>                                    
                                    @endforeach
                                </select>
                            </div>  
                            <div class="auth-input-form" style="width: 30%;">
                                <input type="text" name="year" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                                    placeholder="Tahun" @if(Auth::user()->userDetail->birthdate != null) value="{{$year_safari}}" @endif>
                            </div>

                        </div>

                        @else
                        <div class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-birthday-cake popup-krest-font"></i>
                            <input type="date" name="birthdate" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                                placeholder="dd.mm.yyyy" value="{{ old('birthdate') ?? $date ?? null }}">
                        </div>  

                        @endif
                        @error('birthdate')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @if(session('date_message'))
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ session('date_message') }}</strong>
                            </span>
                        @endif
                        @error('date')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Company / Institution</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-building popup-krest-font"></i>
                            <input type="text" name="company" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                                placeholder="Masukkan perusahaan atau institusi" value="{{ old('company', Auth::user()->userDetail->company) }}">
                        </div>  
                        @error('company')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pekerjaan</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-friends popup-krest-font"></i>
                            <input type="text" name="occupancy" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                                placeholder="Masukkan pekerjaan (e.g. Mahasiswa)" value="{{ old('occupancy', Auth::user()->userDetail->occupancy )}}">
                        </div>  
                        @error('occupancy')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->
                    <div class="col-12" style="text-align:right;padding-top:3vw">
                        <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Update General Info</button>
                    </div>  

                    </form>
                    
                            
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:2vw">Shipping Address</p>
                    <form action="{{ route('customer.update_shipping', Auth::user()->id) }}" method="POST">
                    @csrf
                    @method('put') 
                    <div class="row m-0">
                        <div class="col-12 col-sm-6" >
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Provinsi</p>
                            <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                                <select onchange="if (this.value){ openLoading(); window.location.href='/dashboard?province='+this.value+'#edit-profile'}" name="province_id" id=""  class="normal-text"  style="background:transparent;border:none;color: #3B3C43;;width:100%">
                                    @if(Auth::user()->userDetail->province_id == null)
                                        <option value="" disabled selected>Pilih Provinsi</option>
                                    @endif
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" 
                                        @if(Auth::user()->userDetail->province_id != null && !Request::get('province'))
                                            @if(Auth::user()->userDetail->province_id == $province->id)
                                            selected
                                            @endif
                                        @elseif(Request::get('province') == $province->id) 
                                        selected 
                                        @endif
                                        
                                        >{{$province->name }}</option>                                    
                                    @endforeach
                                </select>
                            </div>  
                            @error('province_id')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Kabupaten/Kota</p>
                            <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                                <select name="city_id" id=""  class="normal-text"  style="background:transparent;border:none;color: #3B3C43;;width:100%">
                                @if($cities == null && Auth::user()->userDetail->city_id == null)
                                    <option disabled selected>Pilih Provinsi terlebih dahulu</option>
                                @else
                                    <option disabled selected>Pilih Kabupaten/Kota</option>

                                    @foreach($cities as $city)
                                        <option value="{{ $city->city_id }}" 
                                            @if(Auth::user()->userDetail->city_id != null && !Request::get('city'))
                                                @if(Auth::user()->userDetail->city_id == $city->city_id)
                                                    selected
                                                @endif
                                            @elseif (Request::get('city') == $city->city_id) 
                                                selected 
                                            @endif
                                            >{{$city->name }}
                                        </option>
                                    @endforeach          
                                @endif
                                </select>                    
                            </div>  
                            @error('city_id')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12" style="margin-top:1vw">
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Alamat</p>
                            <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                                <textarea name="address" value="{{ old('address', Auth::user()->userDetail->address) }}" rows="4" class="normal-text"
                                    style="background:transparent;border:none;color: #3B3C43;;width:100%">{{Auth::user()->userDetail->address}}</textarea>                
                            </div>  
                            @error('address')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12" style="text-align:right;padding-top:3vw">
                            <button onclick="openLoading()" type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Update Shipping Address</button>
                        </div>  
                    </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<!-- END OF POPUP EDIT PROFILE-->

<!-- START OF POPUP CHANGE PASSWORD-->
<div id="change-password" class="overlay" style="overflow:scroll">
    <div class="popup-change-pass" id="change-pass-mobile " style="width:40%" >
        <a class="close"  href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            @if (session()->has('success'))
                <div class="p-3 mt-2 mb-0">
                    <div class="alert alert-success alert-dismissible fade show small-text"  style="text-align:center;margin-bottom:1vw;width:20vw"role="alert">
                    {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @elseif (session()->has('danger'))
                <div class="p-3 mt-2 mb-0">
                    <div class="alert alert-danger alert-dismissible fade show m-0" role="alert" style="font-size: 18px">
                        {{ session('danger') }}
                    </div>
                </div>
            @endif
            <form action="{{ route('customer.change-password') }}" method="post">
                @csrf
                <div class="row m-0">
                    <div class="col-12" style="text-align:left;">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Change Password</p>
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-12" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Old Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt popup-krest-font"></i>
                            <input type="password" placeholder="Insert Old Password" name="old_password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" >
                        </div>  
                        @error('old_password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">New Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt popup-krest-font"></i>
                            <input type="password" placeholder="Insert New Password" name="password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" >
                        </div>  
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Confirm New Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt popup-krest-font"></i>
                            <input type="password" placeholder="Confirm New Password" name="password_confirmation" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" >
                        </div>  
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12" style="text-align:right;padding-top:3vw">
                        <button onclick="openLoading()" type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Update Password</button>
                    </div>  
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP CHANGE PASSWORD-->

<!-- START OF POPUP POINT EXPLANATION-->
<div id="points" class="overlay" style="overflow:scroll">
    <div class="popup" id="voucher-dashboard" style="width:50%">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12" style="text-align:center;">
                    <img src="/assets/images/client/Stars_Illustration.png" class="img-fluid popup-point-images" style="width:14vw" alt="">
                    <p class="sub-description" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px;margin-top:1.5vw">Venidici {{strtoupper(auth()->user()->club)}} Club</p>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#2B6CAA;margin-bottom:0.4vw;margin-top:1vw">Available: <span style="margin-left:1vw;font-family:Rubik Bold">{{$usableStarsCount}} Stars</span></p>
                    <!--<p class="normal-text" style="font-family:Rubik Regular;color:#CE3369;margin-bottom:0.4vw;margin-top:0.5vw">Soon expired (22/02/21): <span style="margin-left:1vw;font-family:Rubik Bold">- Stars</span></p>-->
                    <!-- START OF VENINDICI CLUB PROGRESS BAR -->

                    <div class="d-flex flex-row justify-content-between align-items-center" style="margin-top:3vw">
                        <!-- ONE CLUB -->
                        @if(auth()->user()->userDetail->total_stars >= 20)
                        <div style="border-radius:10px;padding:1vw;background-color:#ECF6FF;display: flex;flex-direction: column;justify-content: center;align-items:center">
                            <i class="fas fa-bicycle medium-heading" style="color:#2B6CAA"></i>
                        @else
                        
                        <div style="border-radius:10px;padding:1vw;background-color:#F5F6F6;display: flex;flex-direction: column;justify-content: center;align-items:center">
                            <i class="fas fa-bicycle medium-heading" style="color:#C4C4C4"></i>
                        @endif
                        </div>
                        <!-- END OF ONE CLUB -->
                        <!-- START OF ONE PROGRESS BAR -->
                        <div class="d-block w-100" style="padding:0vw 1vw">
                            @if(auth()->user()->userDetail->total_stars >= 100)
                            <p class="small-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:1vw">0 Star Left</p>
                            <div class="progress" style="border-radius:10px !important;height:0.8vw">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background-color: #F4C257;"></div>
                            </div>
                            @else
                            @php
                                $percentCar = ( (auth()->user()->userDetail->total_stars - 20) / 80 ) * 100 ;
                            @endphp
                            <p class="small-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:1vw">{{ 100 - auth()->user()->userDetail->total_stars}} Stars Left</p>
                            <div class="progress" style="border-radius:10px !important;height:0.8vw">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{round($percentCar)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round($percentCar)}}%; background-color: #F4C257;"></div>
                            </div>

                            @endif 
                        </div>
                        <!-- END OF ONE PROGRESS BAR -->
                        <!-- ONE CLUB -->
                        @if(auth()->user()->userDetail->total_stars >= 100)
                        <div style="border-radius:10px;padding:1vw;background-color:#ECF6FF;display: flex;flex-direction: column;justify-content: center;align-items:center">
                            <i class="fas fa-car-side medium-heading" style="color:#2B6CAA"></i>
                        @else
                        
                        <div style="border-radius:10px;padding:1vw;background-color:#F5F6F6;display: flex;flex-direction: column;justify-content: center;align-items:center">
                            <i class="fas fa-car-side medium-heading" style="color:#C4C4C4"></i>
                        @endif
                        </div>
                        <!-- END OF ONE CLUB -->
                        <!-- START OF ONE PROGRESS BAR -->
                        <div class="d-block w-100" style="padding:0vw 1vw">
                            @if(auth()->user()->userDetail->total_stars >= 280)
                            <p class="small-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:1vw">0 Star Left</p>
                            <div class="progress" style="border-radius:10px !important;height:0.8vw">
                                
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background-color: #F4C257;"></div>
                            </div>
                            @else
                            <p class="small-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:1vw">{{ 280 - auth()->user()->userDetail->total_stars}} Stars Left</p>
                            @php
                                $percent = ( (auth()->user()->userDetail->total_stars - 100) / 180 ) * 100 ;
                            @endphp
                            <div class="progress" style="border-radius:10px !important;height:0.8vw">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{round($percent)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round($percent)}}%; background-color: #F4C257;"></div>
                            </div>

                            @endif 
                        </div>
                        <!-- END OF ONE PROGRESS BAR -->
                        <!-- ONE CLUB -->
                        @if(auth()->user()->userDetail->total_stars >= 280)
                        <div style="border-radius:10px;padding:1vw;background-color:#ECF6FF;display: flex;flex-direction: column;justify-content: center;align-items:center">
                            <i class="fas fa-fighter-jet medium-heading" style="color:#2B6CAA"></i>
                        @else
                        <div style="border-radius:10px;padding:1vw;background-color:#F5F6F6;display: flex;flex-direction: column;justify-content: center;align-items:center">
                            <i class="fas fa-fighter-jet medium-heading" style="color:#C4C4C4"></i>
                        @endif
                        </div>
                        <!-- END OF ONE CLUB -->
                    </div>
                    <!-- END OF VENIDICI CLUB PROGRESS BAR -->

                    <div class="faq-card" style="margin-top:3vw;background-color:#F9F9F9">
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How Venidici Star System Works?</p>
                            <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseHowItWorks" role="button" aria-expanded="false" aria-controls="collapseHowItWorks">
                                <i class="fas fa-chevron-down"></i>
                            </p>                                    
                        </div>
                        <div class="collapse" id="collapseHowItWorks" style="margin-top:1vw">
                            <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular;text-align:left !important"> 
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                            </p>
                        </div>
                    </div>
                    <!-- END OF ONE FAQ CARD -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF POPUP POINT EXPLANATION-->

<!-- START OF POPUP INTERESTS-->
<div id="my-interests" class="overlay" style="overflow:scroll">
    <div class="popup" style="">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">

            <div class="row m-0 ">
                <div class="col-md-12 p-0">
                    <div class="white-modal-signup" style="padding-bottom:4vw !important;">
                        <form action="{{ route('customer.update_interest') }}" method="POST" >
                        @csrf
                            <div class="row m-0 page-container">
                                <div class="col-12 p-0">
                                    <div style="text-align:center">
                                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" id="small-venidici-icon" style="width:5vw" alt="LOGO">
                                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:0vw">Ketertarikan anda</p>
                                        <p class="bigger-text" style="font-family:Rubik Regular;color: @if(session('message')) #CE3369 @else #3B3C43 @endif;margin-bottom:0vw">{{ session('message') ?? 'Maksimal 3 pilihan' }}</p>
                                        @if(session('update_interest_success'))
                                            <!-- ALERT MESSAGE -->
                                            <div style="text-align:center;margin-top:1vw">
                                                <div class="alert alert-success alert-dismissible fade show small-text"  style="text-align:center;margin-bottom:0px"role="alert">
                                                {{ session('update_interest_success') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>
                                            <!-- END OF ALERT MESSAGE -->
                                        @endif
                                    </div>
                                    @error('interests')
                                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row m-0"  style="overflow:scroll;height:25vw;margin-top:1vw">
                                    @foreach($interests as $interest)
                                    <?php $flag = FALSE; ?>
                                        @foreach(Auth::user()->hashtags as $hashtag)
                                            @if($hashtag->id == $interest->id)
                                                <?php $flag =TRUE ; ?>
                                            @endif
                                        @endforeach
                                        <div class="col-4" style="display:flex;
                                        @if($loop->iteration % 3 == 1)
                                            justify-content:flex-start;
                                        @elseif($loop->iteration % 3 ==2)
                                            justify-content:center;
                                        @else
                                            justify-content:flex-end;
                                        @endif
                                        margin-top:2vw">
                                            <div class="container interest-card @if($flag) interest-card-active @endif" id="interest_card_{{$interest->id}}" 
                                            style="
                                            background: url({{ $interest->image }}) no-repeat center;
                                            background-size: cover;
                                            background-repeat:no-repeat;
                                            background-position:center;
                                            cursor:pointer; @if($flag) background-color: {{$interest->color}}; @endif" onclick="toggleInterest('interest_card_{{ $interest->id }}', '{{ $interest->color }}')">
                                                <input type="hidden" name="interests[{{ $interest->id }}]" value="@if($flag) 1 @else 0 @endif">
                                                <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">{{ $interest->hashtag }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12 p-0" style="text-align:center;margin-top:3vw">
                                    <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Update My Interests</button>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF POPUP INTERESTS-->

<!-- START OF TOP SECTION -->
<div class="row m-0 page-container desktop-display" style="padding-top:9vw"> 
    @if(Auth::user()->email_verified_at == null)
    <div class="col-12 wow bounce" style="height:3.5vw;display:flex;justify-content:center">
        <!-- ALERT MESSAGE -->
        <div class="alert alert-warning alert-dismissible fade show small-text"  style="width:60%;text-align:center;margin-bottom:0px"role="alert">
            @if(session('new_email_verification_sent'))
            Email verifikasi baru telah dikirim. Belum dapat? 
            @else
            Beberapa fitur tidak tersedia jika email belum ter-verifikasi. Belum dapat? 
            @endif
            <span style="display: inline-block;">
                <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" onclick="openLoading()" style="background: none;border:none;color:#2B6CAA">
                    Kirim ulang email
                </button>
                </form>
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
    @elseif(!Auth::user()->isProfileUpdated)
    <div class="col-12  wow bounce" style="height:3.5vw;display:flex;justify-content:center">
        <!-- ALERT MESSAGE -->

        <div class="alert alert-warning alert-dismissible fade show small-text"  style="width:60%;text-align:center;margin-bottom:0px"role="alert">
            Beberapa fitur tidak tersedia jika kamu belum <strong><a href="#edit-profile"> melengkapi profile</a></strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
    @endif
    @if(session('bootcamp_message'))
    <div class="wow bounce" style="display:flex;justify-content:center;margin-top:2vw">
        <!-- ALERT MESSAGE -->
        <div class="alert alert-warning alert-dismissible fade show small-text"  style="width:60%;text-align:center;margin-bottom:0px"role="alert">
            {{session('bootcamp_message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
    @endif
</div>

<div class="row m-0 page-container desktop-display" style="padding-top:1.5vw;">
    <div class="col-12" style="display:flex;justify-content:center;padding:0vw 17vw">
        <div class="card-white wow fadeInUp" data-wow-delay="0.3s" style="height:18vw;padding:1.5vw 1.5vw;width:100%;display:flex;align-items:center">
            <img @if(Auth::user()->avatar == null) src="/assets/images/client/Default_Display_Picture.png" @else src="{{ asset(Auth::user()->avatar) }}"  @endif style="width:14vw;height:14vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="DISPLAY PICTURE">
            <div style="margin-left:1.5vw;width:100%;display: flex;flex-direction: column;justify-content: flex-end;">
                <div style="display:flex;justify-content:space-between;">
                    <p class="sub-description" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">{{Auth::user()->name}}</p> 
                    <div class="dropdown show">
                        
                        <a class="small-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                        <!--<a class="small-heading" style="color:grey;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>-->


                        <div class="dropdown-menu" aria-labelledby="editDropdown" style="border-radius:10px;padding:0px;width:14vw">
                            <div class="edit-item" style="border-radius:10px 10px 0px 0px">
                                <a href="#edit-profile" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-user-edit"></i> <span style="margin-left:0.5vw">Edit Profile</span></a>   
                            </div>
                            @if (Auth::user()->isCandidate)
                                <div class="edit-item">
                                    <a href="{{ route('candidate-detail.show_profile') }}" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-user-edit"></i> <span style="margin-left:0.5vw">Job Portal Profile</span></a>   
                                </div>
                            @endif
                            <div class="edit-item">
                                <a href="#change-password" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-unlock-alt"></i> <span style="margin-left:0.87vw">Change Password</span></a>   
                            </div>
                            <div class="edit-item">
                                <a href="#my-interests" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-heart"></i> <span style="margin-left:0.8vw">My interests</span></a>   
                            </div>
                            <div class="edit-item">
                                <a href="/dashboard/redeem-vouchers" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-tags"></i> <span style="margin-left:0.55vw">Vouchers</span></a>   
                            </div>
                            <div class="edit-item" style="border-radius:0px 0px 10px 10px">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background:none;border:none">
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-sign-out-alt"></i> <span style="margin-left:0.84vw">Log out</span></p>   
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>
                <div style="display:flex;align-items:center;margin-top:0.5vw">
                    <div style="border-top: 1.5px solid #F4C257;border-bottom: 1.5px solid #F4C257;border-left: 1.5px solid #F4C257;border-radius: 5px 0px 0px 5px;padding:0.2vw 0.5vw">
                        <div style="display: flex;flex-direction: column;justify-content: center;">
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;color:#F4C257;"> <i class="fas fa-star"></i> <span>{{$usableStarsCount}} Stars</span></p>
                        </div>
                    </div>
                    <div style="display: flex;flex-direction: column;justify-content: center;border: 1.5px solid #F4C257;border-radius:0px 5px 5px 0px;background-color:#F4C257;padding:0.2vw" >
                            
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;color:#F4C257;">                        
                            <a href="#points">
                                <i class="fas fa-question-circle normal-text" style="color:#FFFFFF;"></i>
                            </a>
                        </p>
                    </div>
                </div>

                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">{{Auth::user()->email}}</p>   
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">{{Auth::user()->userDetail->occupancy}}</p>   
                <!-- <div style="width:70%">
                    <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 1 !important;
                        -webkit-box-orient: vertical !important;">{{Auth::user()->userDetail->address}}</p>   
                </div> -->
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">Referral Code: <span style="color:#2B6CAA;font-family:Rubik Medium"> {{Auth::user()->userDetail->referral_code}}</span></p>   

                <div style="display:flex;align-items:center;margin-top:0.8vw">
                    @foreach(Auth::user()->hashtags as $hashtag)
                    <p class="small-text" style="font-family:Rubik Medium;color:{{$hashtag->color}};background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px;@if($loop->iteration != 1) margin-left:1vw @endif">{{$hashtag->hashtag}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if ($isUserCandidateAndCandidateDetailNotUpdated)
        <div class="col-12" style="padding:0vw 17vw;margin-top:2vw;margin-bottom:4vw">
            <div style="background-color:#F4C257;padding:2vw;border-radius:10px;display:flex;align-items:center">
                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43" >Kamu bisa mendaftarkan diri ke Job Portal Venidici, dimana Hiring Partners kami akan menghubungi kamu untuk mendapatkan kerja. Isi resume-mu sekarang!</p>
                <a href="{{ route('candidate-detail.index') }}" style=";color:#3B3C43">
                    <i class="fas fa-arrow-right normal-text"></i>
                </a>
            </div>
        </div>
    @endif
</div>
<!-- END OF TOP SECTION -->

<!-- START MOBILE TOP SECTION -->
<div class="m-0 page-container pb-0 mobile-display" style="background-color:#2B6CAA;display:none"> 
    <div class="" style="color:white;font-family: Helvetica Bold;font-size:5vw;">User Dashboard</div>
    @if(Auth::user()->email_verified_at == null)
    <div class="col-12" style="height:3.5vw;display:flex;justify-content:center">
        <!-- ALERT MESSAGE -->
        <div class="alert alert-warning alert-dismissible fade show "  style="width:100%;text-align:center;margin-bottom:0px;font-size:2.5vw;padding-top:2vw;height:10vw"role="alert">
            @if(session('new_email_verification_sent'))
            Email verifikasi baru telah dikirim. Belum dapat? 
            @else
            Beberapa fitur tidak tersedia jika email belum ter-verifikasi. Belum dapat? 
            @endif
            <span style="display: inline-block;">
                <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" onclick="openLoading()" style="background: none;border:none;color:#2B6CAA">
                    Kirim ulang email
                </button>
                </form>
            </span>
            <button type="button" style="top: -3vw !important;;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
    @elseif(!Auth::user()->isProfileUpdated)
    <div class="col-12" style="height:3.5vw;display:flex;justify-content:center">
        <!-- ALERT MESSAGE -->
        <div class="alert alert-warning alert-dismissible fade show small-text" id="update-profile-toast-user-dashboard" style="width:100%;text-align:center;margin-bottom:0px;font-size:2.5vw;padding-right:6vw"role="alert">
            <p style="margin-top:-1.5vw">
                Kamu belum melengkapi profile. <strong><a href="#edit-profile">Klik disini</a></strong> untuk melengkapi.
            </p>
            <button type="button" style="top:-3px" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
    @endif
</div>

<div class="row m-0 page-container mobile-display" style="background-color:#2B6CAA;padding:9vw 0vw;display:none">
    <div class="col-12 p-0" style="display:flex;justify-content:center">
        <div class="card-white wow fadeInUp" data-wow-delay="0.3s" style="height:35vw;padding:3vw 1.5vw;width:92vw;display:flex;align-items:center">
            <!--<img @if(Auth::user()->avatar == null) src="/assets/images/client/Default_Display_Picture.png" @else src="{{ asset(Auth::user()->avatar) }}"  @endif style="width:27vw;height:27vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="DISPLAY PICTURE">-->
            <div style="margin-left:1.5vw;width:100%;display: flex;flex-direction: column;justify-content: flex-end;">
                <div style="display:flex;justify-content:space-between;align-items:">
                    <p class="bigger-text" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">{{Auth::user()->name}}</p> 
                    <div class="dropdown show p-0" >
                        
                        <a class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                        <!--<a class="small-heading" style="color:grey;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer" role="button" id="editDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>-->


                        <div class="dropdown-menu "  aria-labelledby="editDropdown" style="border-radius:10px;padding:0px;min-width:50vw !important;margin-right:39vw">
                            <div class="edit-item" style="border-radius:10px 10px 0px 0px;padding:1vw 3vw " >
                                <a href="#edit-profile" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-user-edit"></i> <span style="margin-left:0.5vw">Edit Profile</span></a>   
                            </div>
                            @if (Auth::user()->isCandidate)
                                <div class="edit-item" style="padding:1vw 3vw " >
                                    <a href="{{ route('candidate-detail.show_profile') }}" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-user-edit"></i> <span style="margin-left:0.5vw">Job Portal Profile</span></a>   
                                </div>
                            @endif
                            <div class="edit-item" style="padding:1vw 3vw ">
                                <a href="#change-password" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-unlock-alt"></i> <span style="margin-left:0.87vw">Change Password</span></a>   
                            </div>
                            <div class="edit-item" style="padding:1vw 3vw ">
                                <a href="#my-interests" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-heart"></i> <span style="margin-left:0.8vw">My interests</span></a>   
                            </div>
                            <div class="edit-item" style="padding:1vw 3vw ">
                                <a href="/dashboard/redeem-vouchers" class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-tags"></i> <span style="margin-left:0.55vw">Vouchers</span></a>   
                            </div>
                            <div class="edit-item" style="border-radius:0px 0px 10px 10px;padding:1vw 3vw ">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background:none;border:none">
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px;text-decoration:none"><i class="fas fa-sign-out-alt"></i> <span style="margin-left:0.84vw">Log out</span></p>   
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>
                <div style="display:flex;align-items:center;">
                    <div style="border-top: 1.5px solid #F4C257;border-bottom: 1.5px solid #F4C257;border-left: 1.5px solid #F4C257;border-radius: 5px 0px 0px 5px;padding:0.2vw 0.5vw">
                        <div style="display: flex;flex-direction: column;justify-content: center;">
                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;color:#F4C257;line-height: 2vw !important;"> <i class="fas fa-star normal-text" style=""></i> <span>{{$usableStarsCount}} Stars</span></p>
                        </div>
                    </div>
                    <div style="display: flex;flex-direction: column;justify-content: center;border: 1.5px solid #F4C257;border-radius:0px 5px 5px 0px;background-color:#F4C257;padding:0.2vw" >
                            
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;color:#F4C257;line-height: 2vw !important;">                        
                            <a href="#points">
                                <i class="fas fa-question-circle normal-text" style="color:#FFFFFF;"></i>
                            </a>
                        </p>
                    </div>
                </div>

                <p class="normal-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:2vw;">{{Auth::user()->email}}</p>   
                <p class="normal-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.2vw;">Referral Code: <span style="color:#2B6CAA;font-family:Rubik Medium"> {{Auth::user()->userDetail->referral_code}}</span></p>   
                <!--
                <div style="display:flex;align-items:center;margin-top:2vw">
                    @foreach(Auth::user()->hashtags as $hashtag)
                    <p style="font-family:Rubik Medium;color:{{$hashtag->color}};background-color:#EEEEEE;border-radius:10px;font-size:2.5vw;padding:0.5vw 1.5vw;margin-bottom:0px;@if($loop->iteration != 1) margin-left:1vw @endif">{{$hashtag->hashtag}}</p>
                    @endforeach
                </div>
                -->
            </div>
        </div>
    </div>

    @if ($isUserCandidateAndCandidateDetailNotUpdated)
        <div class="col-12 p-0" style="margin-top:2vw">
            <div style="background-color:#F4C257;padding:2vw;border-radius:10px;display:flex;align-items:center">
                <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43" >Kamu bisa mendaftarkan diri ke Job Portal Venidici, dimana Hiring Partners kami akan menghubungi kamu untuk mendapatkan kerja. Isi resume-mu sekarang!</p>
                <a href="{{ route('candidate-detail.index') }}" style=";color:#3B3C43;padding-left:10vw">
                    <i class="fas fa-arrow-right normal-text"></i>
                </a>
            </div>
        </div>
    @endif
</div>
<!-- END OF MOBILE TOP SECTION -->


<!-- START OF MIDDLE SECTION -->
<div class="row m-0 page-container-inner" data-wow-delay="0.6s" style="padding-top:4vw">
    <div class="col-12 p-0" style="">
        <div style="display:flex">
            <p id="JadwalLivePelatihanButton"class="sub-description blue-text-underline blue-text-underline-active user-links user-dashboard-normal-text" onclick="changeContent(event, 'live-pelatihan')"  style="font-family:Rubik Medium;cursor:pointer;margin-bottom:0px">Jadwal Live Workshop</p>
            <p id="PelatihanAktifButton" class="sub-description blue-text-underline user-links user-dashboard-normal-text" onclick="changeContent(event, 'pelatihan-aktif')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px">Pelatihan Aktif</p>
            <p id="PelatihanSelesaiButton" class="sub-description blue-text-underline user-links user-dashboard-normal-text" onclick="changeContent(event, 'pelatihan-selesai')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px">Pelatihan Selesai</p>
        </div>
    </div>
    <!-- Live Pelatihan Content -->
    <div style="padding:0px" class="user-content wow fadeInLeft" id="live-pelatihan">
        @if(!$liveWorkshopPaginationData['data'])
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description user-dashboard-normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Jadwal live belum tersedia.</span></p>
            </div>
        @else
            @foreach($liveWorkshopPaginationData['data'] as $course)
                @if($course->course_type_id && $course->course_type_id != 3)
                    <div class="col-12 p-0">
                        <div class="red-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" >
                            <div class="container-image-card">
                                <img src="{{asset($course->thumbnail)}}" style="width:12vw" class="img-fluid" alt="">
                                <div class="top-left card-tag small-text" >Woki</div>
                            </div>           
                            <div style="display:flex;justify-content:space-between">
                                <div class="right-section" style="width:35vw">
                                    <div>
                                        <p class="bigger-text user-dashboard-normal-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">{{$course->title}}</p>
                                        <p class="small-text desktop-display" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Kelas oleh
                                        @foreach($course->teachers as $teacher) 
                                            <span style="font-family:Rubik Bold">
                                                @if($loop->last && count($course->teachers) != 1)
                                                dan
                                                @elseif(!$loop->first)
                                                ,
                                                @endif
                                                {{$teacher->name}}
                                            </span>
                                        @endforeach
                                        </p>   
                                        <p class="small-text desktop-display" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw">{{$course->subtitle}}</p>
                                        <p class="small-text desktop-display" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">{{date('d M Y', strtotime($course->wokiCourseDetail->event_date))}}  |  {{date('H:i', strtotime($course->wokiCourseDetail->start_time))}} - {{date('H:i', strtotime($course->wokiCourseDetail->end_time))}}</p>
                                    </div>
                                </div>  
                                <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                                    <a href="/woki/{{$course->title}}" target="_blank" id="detail-button" class="small-text text-nowrap" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-bottom:2vw;">View Details</a>
                                    <a href="{{$course->wokiCourseDetail->meeting_link}}" target="_blank" id="meeting-link" class="small-text" style="font-family:Rubik Medium;margin-top:2vw">Meeting Link</a>
                                </div>
                            </div> 
                        </div>
                    </div>
                @else
                @php $application = $course; @endphp
                <!-- START OF BOOTCAMP CARD -->
                <div class="col-12 p-0">
                    <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex;" >
                        <div class="container-image-card">
                            <img src="{{asset($application->course->thumbnail)}}" id="bootcamp-ud-thumb" style="width:12vw" class="img-fluid" alt="">
                            <div class="top-left card-tag small-text" >Bootcamp</div>
                        </div>           
                        <div style="display:flex;justify-content:space-between">
                            <div class="right-section" style="width:35vw">
                                <div>
                                    <p class="bigger-text user-dashboard-normal-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;">{{$application->course->title}}</p>
                                    <p class="small-text desktop-display" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;">Kelas oleh
                                    @foreach($application->course->teachers as $teacher)
                                        <span style="font-family:Rubik Bold">
                                            @if($loop->last && count($application->course->teachers) != 1)
                                            dan
                                            @elseif(!$loop->first)
                                            ,
                                            @endif
                                            {{$teacher->name}}
                                        </span>
                                    @endforeach
                                    </p>   
                                    <!-- <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw">{{$application->course->subtitle}}</p> -->
                                    @if($application->is_trial && !$application->is_full_registration)
                                    <p class="small-text desktop-display" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">{{date('d M Y', strtotime($application->course->bootcampCourseDetail->date_start))}} -  {{date('d M Y', strtotime($application->course->bootcampCourseDetail->trial_date_end))}}</p>
                                    @else
                                    <p class="small-text desktop-display" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">{{date('d M Y', strtotime($application->course->bootcampCourseDetail->date_start))}} -  {{date('d M Y', strtotime($application->course->bootcampCourseDetail->date_end))}}</p>
                                    @endif
                                    <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">Application Status: <span style="color:#2B6CAA;font-family:Rubik Medium">
                                    @if($application->status == 'ft_pending')
                                    <span style="color: orange;">Pending Payment</span> (Trial)
                                    @elseif($application->status == 'ft_paid')
                                    <span style="color: green;">Paid Payment</span> (Trial)
                                    @elseif($application->status == 'ft_refunded')
                                    <span style="color: orange;">Refunded</span>
                                    @elseif($application->status == 'ft_cancelled')
                                    <span >Cancelled</span>
                                    @elseif($application->status == 'waiting')
                                    <span style="color: orange;">Waiting Confirmation</span>
                                    @elseif($application->status == 'approved')
                                    <span style="color: green;">Approved</span>
                                    @elseif($application->status == 'denied')
                                    <span style="color: green;">Rejected</span>
                                    @endif
                                    </span></p>   

                                </div>
                            </div>
                            @if(
                                ($application->is_trial && !$application->is_full_registration && $application->status == 'ft_paid')
                                || 
                                (!$application->is_trial && $application->is_full_registration && $application->status == 'approved') 
                                || 
                                ($application->is_trial && $application->is_full_registration && ($application->status == 'waiting' || $application->status == 'approved') ) 
                            )
                            <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                                @if($application->is_trial && !$application->is_full_registration)
                                <button onclick="passBootcampApplicationId({{$application->id}})"  data-toggle="modal" data-target="#upgradeBootcamp" id="detail-button" class="small-text text-nowrap" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-bottom:2vw;">Upgrade</button>
                                @endif

                                <a href="{{$application->course->bootcampCourseDetail->meeting_link}}" target="_blank" id="meeting-link" class="small-text" style="font-family:Rubik Medium; @if($application->is_trial && !$application->is_full_registration) margin-top:2vw @endif">Meeting Link</a>
                                @if( count($application->course->sections) != 0 )
                                    @if(count($application->course->sections[0]->sectionContents) != 0)
                                    <a href="{{ route('online-course.learn', ['course_title' => $application->course->title, 'content_title' => $application->course->sections[0]->sectionContents[0]->title]) }}" id="detail-button" class="small-text text-nowrap" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Recorded Videos</a>
                                    @endif
                                @endif
                            </div>
                            @endif
                        </div> 
                    </div>
                </div>  
                <!-- END  OF BOOTCAMP CARD -->
                @endif
            @endforeach

            @if ($liveWorkshopPaginationData['total_page_amount'] > 1)
                <div style="display:flex;align-items:center;justify-content:center;margin-top:2vw">
                    <div class="pagination-client">
                        <a href="{{ request()->fullUrlWithQuery([
                            'liveWorkshopPage' => $liveWorkshopPaginationData['previous_page'],
                            'coursesTab' => 'liveWorkshop'
                        ]) }}"><i class="fas fa-angle-left"></i></a>
                        @for ($i = 1; $i <= $liveWorkshopPaginationData['total_page_amount']; $i++)
                            <a href="{{ request()->fullUrlWithQuery(['liveWorkshopPage' => $i, 'coursesTab' => 'liveWorkshop']) }}"
                                @if($i == $liveWorkshopPaginationData['current_page']) class="active" @endif>{{ $i }}</a>
                        @endfor
                        <a href="{{ request()->fullUrlWithQuery([
                            'liveWorkshopPage' => $liveWorkshopPaginationData['next_page'],
                            'coursesTab' => 'liveWorkshop'
                        ]) }}"><i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            @endif
        @endif
    </div>
    <!-- End of Live Pelatihan Content -->

    <!-- Pelatihan Aktif Content -->
    <div style="padding:0px;display:none" class="user-content" id="pelatihan-aktif">
        @if(!$onGoingCoursesPaginationData['data'])
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description user-dashboard-normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Pelatihan aktif belum tersedia.</span></p>
            </div>
        @else
            @foreach($onGoingCoursesPaginationData['data'] as $course)
                <div class="col-12 p-0">
                    <div class="@if($course->course_type_id == 1) blue-bordered-card @else red-bordered-card @endif" style="margin-top:2.5vw;display:flex;cursor:pointer" @if(count($course->sections) != 0 ) onclick="window.open('/online-course/{{$course->title}}/learn/lecture/{{ $course->sections[0]->sectionContents[0]->title }}','_self');" @endif>
                        <div class="container-image-card">
                            <img src="{{asset($course->thumbnail)}}" style="width:12vw" class="img-fluid" alt="">
                            <div class="top-left card-tag small-text" > @if($course->course_type_id == 1) Skill-Snack @else Woki @endif</div>
                        </div>           
                        <div style="display:flex;justify-content:space-between">
                            <div class="right-section" style="width:35vw">
                                <div>
                                    <p class="bigger-text user-dashboard-normal-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">{{$course->title}}</p>
                                    <p class="small-text desktop-display" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">By 
                                    @foreach($course->teachers as $teacher)
                                        @if ($loop->last && count($course->teachers) != 1)
                                        dan
                                        @elseif (!$loop->first)
                                        ,
                                        @endif
                                        {{$teacher->name}}
                                    @endforeach
                                    </p> 
                                    <!--<p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>-->
                                    <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;">{{$course->subtitle}}</p>
                                    <a class="small-text desktop-display" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{$course->courseCategory->category}}</a>
                                </div>
                            </div>
                            <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                                <div class="progress progress-bar-vertical" id="progress-pelatihan" style="background: rgba(43, 108, 170, 0.3);position:relative">
                                    <p style="position:absolute;left: @if($userCourseProgress[$course->id] == 100) 35% @else 40% @endif;top:35%" class="normal-text">{{ $userCourseProgress[$course->id] }}%</p>
                                    <div class="progress-bar-blue" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: {{ $userCourseProgress[$course->id] }}%;">
                                    </div>
                                </div>
                                @if( count($course->sections) != 0 )
                                    @if(count($course->sections[0]->sectionContents) != 0)
                                    <a href="{{ route('online-course.learn', ['course_title' => $course->title, 'content_title' => $course->sections[0]->sectionContents[0]->title]) }}" id="detail-button" class="small-text text-nowrap" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Mulai Belajar</a>
                                    @endif
                                @endif
                            </div>
                        </div> 
                    </div>
                </div>
            @endforeach
            @if ($onGoingCoursesPaginationData['total_page_amount'] > 1)
                <div style="display:flex;align-items:center;justify-content:center;margin-top:2vw">
                    <div class="pagination-client">
                        <a href="{{ request()->fullUrlWithQuery([
                            'onGoingCoursesPage' => $onGoingCoursesPaginationData['previous_page'],
                            'coursesTab' => 'onGoingCourses'
                        ]) }}"><i class="fas fa-angle-left"></i></a>
                        @for ($i = 1; $i <= $onGoingCoursesPaginationData['total_page_amount']; $i++)
                            <a href="{{ request()->fullUrlWithQuery(['onGoingCoursesPage' => $i, 'coursesTab' => 'onGoingCourses']) }}"
                                @if($i == $onGoingCoursesPaginationData['current_page']) class="active" @endif>{{ $i }}</a>
                        @endfor
                        <a href="{{ request()->fullUrlWithQuery([
                            'onGoingCoursesPage' => $onGoingCoursesPaginationData['next_page'],
                            'coursesTab' => 'onGoingCourses'
                        ]) }}"><i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            @endif
        @endif
    </div>
    <!-- End of Pelatihan Aktif Content -->

    <!-- Pelatihan Selesai Content -->
    <div style="padding:0px;display:none;" class="user-content" id="pelatihan-selesai">
        @if(!$completedCoursesPaginationData['data'])
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description  user-dashboard-normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Pelatihan selesai belum tersedia.</span></p>
            </div>
        @else
            @foreach($completedCoursesPaginationData['data'] as $course)
                @if($course->course_type_id && $course->course_type_id == 1)
                    <div class="col-12 p-0">
                        <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" @if(count($course->sections) != 0 ) onclick="window.open('/online-course/{{$course->title}}/learn/lecture/{{ $course->sections[0]->sectionContents[0]->title }}','_self');" @endif>
                            <div class="container-image-card">
                                <img src="{{asset($course->thumbnail)}}" style="width:12vw" class="img-fluid" alt="">
                                <div class="top-left card-tag small-text" > @if($course->course_type_id == 1) Skill Snack @else Woki @endif</div>
                            </div>           
                            <div style="display:flex;justify-content:space-between">
                                <div class="right-section" style="width:35vw">
                                    <div>
                                        <p class="bigger-text  user-dashboard-normal-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;">{{$course->title}}</p>
                                        <p class="small-text desktop-display" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Kelas oleh
                                        @foreach($course->teachers as $teacher)
                                            @if ($loop->last && count($course->teachers) != 1)
                                            dan
                                            @elseif (!$loop->first)
                                            ,
                                            @endif
                                            {{$teacher->name}}
                                        @endforeach
                                        </p>   
                                        <!--<p class="small-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">Lesson number and title</p>-->
                                        <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;">{{$course->subtitle}}</p>
                                        <a class="small-text desktop-display" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{$course->courseCategory->category}}</a>
                                    </div>
                                </div>
                                <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                                    <i class="fas fa-check-circle big-heading"></i>
                                    <form action="{{route('print_certificate')}}" method="post">
                                    @csrf
                                        <input type="hidden" name="name" value="{{auth()->user()->name}}">
                                        <input type="hidden" name="course_id" value="{{$course->id}}">
                                        <button id="detail-button" class="small-text user-dashboard-normal-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Unduh Sertifikat</button>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                @elseif($course->course_type_id && $course->course_type_id ==2)
                    <div class="col-12 p-0">
                        <div class="red-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" @if(count($course->sections ) != 0) onclick="window.open('/online-course/{{ $course->title }}/learn/lecture/{{ $course->sections[0]->sectionContents[0]->title }}','_self');" @endif>
                            <div class="container-image-card">
                                <img src="{{asset($course->thumbnail)}}" style="width:12vw" class="img-fluid" alt="">
                                <div class="top-left card-tag small-text" >Woki</div>
                            </div>           
                            <div style="display:flex;justify-content:space-between">
                                <div class="right-section" style="width:35vw">
                                    <div>
                                        <p class="bigger-text  user-dashboard-normal-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">{{$course->title}}</p>
                                        <p class="small-text desktop-display" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">Kelas oleh
                                        @foreach($course->teachers as $teacher)
                                            @if ($loop->last && count($course->teachers) != 1)
                                            dan
                                            @elseif (!$loop->first)
                                            ,
                                            @endif
                                            {{$teacher->name}}
                                        @endforeach
                                        </p>   
                                        <p class="small-text desktop-display" style="font-family: Rubik Regular;color:#3B3C43;margin-top:0.5vw;">{{$course->subtitle}}</p>
                                        <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{$course->courseCategory->category}}</a>
                                    </div>
                                </div>
                                <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                                    <i class="fas fa-check-circle big-heading"></i>
                                    @if(!$course->pivot->isAbsent)
                                    <form action="{{route('print_certificate')}}" method="post">
                                    @csrf
                                        <input type="hidden" name="name" value="{{auth()->user()->name}}">
                                        <input type="hidden" name="course_id" value="{{$course->id}}">
                                        <button id="detail-button" class="small-text text-nowrap" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Unduh Sertifikat</button>
                                    </form>
                                    @else
                                    <p id="detail-button" class="small-text text-nowrap" style="font-family: Rubik Regular;margin-bottom:0px;margin-top:2vw">Kelas Selesai</p>
                                    @endif
                                </div>
                            </div> 
                        </div>
                    </div>
                @else
                    @php $application = $course; @endphp
                    <!-- START OF BOOTCAMP CARD -->
                    <div class="col-12 p-0">
                        <div class="blue-bordered-card" style="margin-top:2.5vw;display:flex;" >
                            <div class="container-image-card">
                                <img src="{{asset($application->course->thumbnail)}}" style="width:12vw" class="img-fluid" alt="">
                                <div class="top-left card-tag small-text" >Bootcamp</div>
                            </div>           
                            <div style="display:flex;justify-content:space-between">
                                <div class="right-section" style="width:36.8vw">
                                    <div>
                                        <p class="bigger-text user-dashboard-normal-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px;;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">{{$application->course->title}}</p>
                                        <p class="small-text desktop-display" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;">Kelas oleh
                                        @foreach($application->course->teachers as $teacher)
                                            <span style="font-family:Rubik Bold">
                                                @if($loop->last && count($application->course->teachers) != 1)
                                                dan
                                                @elseif(!$loop->first)
                                                ,
                                                @endif
                                                {{$teacher->name}}
                                            </span>
                                        @endforeach
                                        </p>   
                                        <!-- <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-top:1vw">{{$application->course->subtitle}}</p> -->
                                        @if($application->is_trial && !$application->is_full_registration)
                                        <p class="small-text desktop-display" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">{{date('d M Y', strtotime($application->course->bootcampCourseDetail->date_start))}} -  {{date('d M Y', strtotime($application->course->bootcampCourseDetail->trial_date_end))}}</p>
                                        @else
                                        <p class="small-text desktop-display" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1vw">{{date('d M Y', strtotime($application->course->bootcampCourseDetail->date_start))}} -  {{date('d M Y', strtotime($application->course->bootcampCourseDetail->date_end))}}</p>
                                        @endif
                                        <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw">Application Status: <span style="color:#2B6CAA;font-family:Rubik Medium">
                                        @if($application->status == 'ft_pending')
                                        <span style="color: orange;">Pending Payment</span> (Trial)
                                        @elseif($application->status == 'ft_paid')
                                        <span style="color: green;">Paid Payment</span> (Trial)
                                        @elseif($application->status == 'ft_refunded')
                                        <span style="color: orange;">Refunded</span>
                                        @elseif($application->status == 'ft_cancelled')
                                        <span >Cancelled</span>
                                        @elseif($application->status == 'waiting')
                                        <span style="color: orange;">Waiting Confirmation</span>
                                        @elseif($application->status == 'approved')
                                        <span style="color: green;">Approved</span>
                                        @elseif($application->status == 'denied')
                                        <span style="color: green;">Rejected</span>
                                        @endif
                                        </span></p>   

                                    </div>
                                </div>
                                <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                                    <i class="fas fa-check-circle big-heading"></i>
                                    @if( count($application->course->sections) != 0 )
                                        @if(count($application->course->sections[0]->sectionContents) != 0)
                                        <a href="{{ route('online-course.learn', ['course_title' => $application->course->title, 'content_title' => $application->course->sections[0]->sectionContents[0]->title]) }}" id="detail-button" class="small-text text-nowrap" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Recorded Videos</a>
                                        @endif
                                    @endif
                                </div>
                            </div> 
                        </div>
                    </div>  
                    <!-- END  OF BOOTCAMP CARD -->
                @endif
            @endforeach
            @if ($completedCoursesPaginationData['total_page_amount'] > 1)
                <div style="display:flex;align-items:center;justify-content:center;margin-top:2vw">
                    <div class="pagination-client">
                        <a href="{{ request()->fullUrlWithQuery([
                            'completedCoursesPage' => $completedCoursesPaginationData['previous_page'],
                            'coursesTab' => 'completedCourses'
                        ]) }}"><i class="fas fa-angle-left"></i></a>
                        @for ($i = 1; $i <= $completedCoursesPaginationData['total_page_amount']; $i++)
                            <a href="{{ request()->fullUrlWithQuery(['completedCoursesPage' => $i, 'coursesTab' => 'completedCourses']) }}"
                                @if($i == $completedCoursesPaginationData['current_page']) class="active" @endif>{{ $i }}</a>
                        @endfor
                        <a href="{{ request()->fullUrlWithQuery([
                            'completedCoursesPage' => $completedCoursesPaginationData['next_page'],
                            'coursesTab' => 'completedCourses'
                        ]) }}"><i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            @endif
        @endif
    </div>
    <!-- End of Pelatihan Selesai Content -->
</div>
<!-- END OF MIDDLE SECTION -->

<!-- START OF SARAN KAMI SECTION -->
@if(count($courseSuggestions) != 0)
<div class="row m-0 page-container-inner desktop-display" style="padding-top:5vw" >
    <div class="col-12 p-0" style="text-align:center">
        <p class="small-heading" style="font-family:Rubik Medium;margin-bottom:0px;color:#3B3C43">Saran kelas dari kami</p>
    </div>
    <div class="col-12 p-0" style="margin-top:3vw">
        <div id="saran-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 3.5vw;">
                @php $card_counter = 0; @endphp
                @foreach ($courseSuggestions as $course)
                    @php $card_counter++; @endphp
                    
                    @if ($loop->first)
                        <div class="carousel-item active" >
                            <div style="display:flex;justify-content:center">
                    @elseif ($card_counter == 1)
                        <div class="carousel-item" >
                            <div style="display:flex;justify-content:center">
                    @endif
                
                        <div>
                            <!-- START OF ONE COURSE CARD -->
                            @if ($course->courseType->type == "Course")
                                <div class="course-card-green" style="@if($card_counter % 2 == 1) margin-right:1vw @elseif($card_counter % 2 == 0) margin-left:1vw @endif" >
                            @elseif ($course->courseType->type == "Woki")
                                <div class="course-card-red" style="@if($card_counter % 2 == 1) margin-right:1vw @elseif($card_counter % 2 == 0) margin-left:1vw @endif">
                            @elseif ($course->courseType->type == "Bootcamp")
                                <div class="course-card-blue" style="@if($card_counter % 2 == 1) margin-right:1vw @elseif($card_counter % 2 == 0) margin-left:1vw @endif">
                            @endif
                                <div class="container">
                                    <img src="{{ asset($course->thumbnail) }}" class="img-fluid online-course-image" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw"
                                        alt="Image not available..">
                                    <div class="top-left card-tag small-text">
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
                                    <div style="height:4.5vw">
                                        <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                            @if ($course->courseType->type == 'Course')
                                                <a href="/online-course/{{ $course->title }}" class="normal-text"
                                                    style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;text-decoration:none">{{ $course->title }}</a>
                                            @elseif ($course->courseType->type == 'Woki')
                                                <a href="/woki/{{ $course->title }}" class="normal-text"
                                                    style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;text-decoration:none">{{ $course->title }}</a>
                                            @elseif ($course->courseType->type == 'Bootcamp')
                                                <a href="/bootcamp/{{ $course->title }}" class="normal-text"
                                                    style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;text-decoration:none">{{ $course->title }}</a>
                                            @endif
                                            <!-- <i style="font-size:2vw;" role="button" aria-controls="courses-collapse{{ $loop->iteration }}" data-toggle="collapse" href="#courses-collapse{{ $loop->iteration }}" class="fas fa-caret-down"></i> -->
                                        </div>
                                        @foreach ($course->hashtags as $tag)
                                            <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{ $tag->hashtag }}</a>
                                        @endforeach
                                    </div>
                                    <div class="collapse" id="courses-collapse{{ $loop->iteration }}" style="margin-top:1vw">
                                        <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">{{ $course->description }}</p>
                                    </div>
                                    <div style="display: flex;justify-content:space-between;margin-top:1vw">
                                        <p class="very-small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">
                                            @foreach($course->teachers as $teacher)
                                                @if ($loop->last && count($course->teachers) != 1)
                                                dan
                                                @elseif (!$loop->first)
                                                ,
                                                @endif
                                                {{$teacher->name}}
                                            @endforeach
                                            </p>
                                        <p class="very-small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">
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
                                        {{-- <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                        <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a> --}}
                                        <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                                        @if ($course->price == 0)
                                            <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">FREE</p>
                                        @else
                                            <p class="bigger-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                        @endif
                                        @if ($course->courseType->type == 'Course')
                                            <a href="/online-course/{{ $course->title }}" class="course-card-button normal-text">Enroll Now</a>
                                        @elseif ($course->courseType->type == 'Woki')
                                            <a href="/woki/{{ $course->title }}" class="course-card-button normal-text">Enroll Now</a>
                                        @elseif ($course->courseType->type == 'Bootcamp')
                                            <a href="/bootcamp/{{ $course->title }}" class="course-card-button normal-text">Enroll Now</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- END OF ONE COURSE CARD -->
                        </div>
                        @if ($loop->last || $card_counter == 2)
                            </div>
                        </div>
                        @endif

                        @php
                            $new_carousel_item = false;
                            if ($card_counter == 2) $card_counter = 0;
                        @endphp
                    @endforeach

            </div>
            <a class="carousel-control-prev"   data-bs-target="#saran-carousel" style="width:2.5vw;" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image " style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#saran-carousel" style="width:2.5vw;"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
</div>
@endif
<!-- END OF SARAN KAMI SECTION -->

<!-- START MOBILE SARAN KAMI SECTION -->
@if(count($courseSuggestions) != 0)
<div class="row m-0 mobile-display" style="padding-top:2vw 5vw;display:none">
    <div class="col-12 p-0" style="text-align:center">
        <p class="bigger-text" style="font-family:Rubik Medium;margin-bottom:0px;color:#3B3C43">Saran kelas dari kami</p>
    </div>
    <div class="col-12 p-0" style="margin-top:3vw">
        <div id="saran-carousel-mobile" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 3.5vw;">
                @php $card_counter = 0; @endphp
                @foreach ($courseSuggestions as $course)
                    @php $card_counter++; @endphp
                    
                    @if ($loop->first)
                        <div class="carousel-item active" >
                            <div style="display:flex;justify-content:center">
                    @elseif ($card_counter == 1)
                        <div class="carousel-item" >
                            <div style="display:flex;justify-content:center">
                    @endif
                
                        <div>
                        @if ($course->courseType->type == "Course")
                            <div class="course-card-green">
                        @elseif ($course->courseType->type == "Woki")
                            <div class="course-card-red">
                        @elseif ($course->courseType->type == "Bootcamp")
                            <div class="course-card-blue">
                        @endif
                            <div class="container">
                                <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:30vw;" alt="Snow">
                                <div class="top-left card-tag normal-text" style="">
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
                                            <a href="/online-course/{{$course->title}}" class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;">{{ $course->title }}</a>
                                        @elseif ($course->courseType->type == 'Woki')
                                            <a href="/woki/{{$course->title}}" class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;">{{ $course->title }}</a>

                                        @elseif ($course->courseType->type == 'Bootcamp')
                                            <a href="/bootcamp/{{$course->id}}" class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 1 !important;-webkit-box-orient: vertical !important;text-decoration:none;">{{ $course->title }}</a>

                                        @endif
                                        <!-- <i style="font-size:2vw;padding-left:4vw;font-size:4vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i> -->
                                    </div>
                                    @foreach ($course->hashtags as $tag)
                                        <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{ $tag->hashtag }}</a>
                                    @endforeach
                                </div>
                                <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                    <p class="course-card-description normal-text   " style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8)">{{ $course->description }}</p>
                                </div>

                                <div style="display: flex;justify-content:space-between;margin-top:3vw" >
                                    <p class="small-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">
                                    @foreach($course->teachers as $teacher)

                                        @if ($loop->last && count($course->teachers) != 1)
                                        dan
                                        @elseif (!$loop->first)
                                        ,
                                        @endif
                                        {{$teacher->name}}
                                    @endforeach
                                    </p>
                                    <p class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">
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
                                    <p class="small-text" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px;">{{ $course->average_rating }}/5</p>
                                    <div style="display: flex;justify-content:center;margin-left:1vw">
                                        @for ($i = 1; $i < 6; $i++)
                                            @if ($i <= $course->average_rating)
                                                @if ($i == 1)
                                                    <i style="color:#F4C257;" class="fas fa-star small-text"></i>
                                                @else
                                                    <i style="margin-left:0.5vw;color:#F4C257;" class="fas fa-star small-texxt"></i>
                                                @endif
                                            @else
                                                @if ($i == 1)
                                                    <i style="color:#B3B5C2;" class="fas fa-star small-text"></i>
                                                @else
                                                    <i style="margin-left:0.5vw;color:#B3B5C2;" class="fas fa-star small-text"></i>
                                                @endif
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <div style="display: flex;justify-content:space-between;align-items:center;margin-top:1vw">
                                    @if ($course->price == 0)
                                        <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">FREE</p>
                                    @else
                                        <p class="normal-text" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
                                    @endif
                                    @if ($course->courseType->type == 'Course')
                                        <a href="/online-course/{{$course->title}}" class="course-card-button normal-text" style="">Enroll Now</a>
                                        @elseif ($course->courseType->type == 'Woki')
                                        <a href="/woki/{{ $course->title }}" class="course-card-button normal-text" style="">Enroll Now</a>
                                        @elseif ($course->courseType->type == 'Bootcamp') 
                                        <a href="/bootcamp/{{ $course->id }}" class="course-card-button normal-text" style="">Enroll Now</a>
                                    @endif
                                </div>
                
                            </div>
                        </div>
                        <!-- END OF ONE COURSE CARD -->
                        </div>
                        @if ($loop->last || $card_counter == 1)
                            </div>
                        </div>
                        @endif

                        @php
                            $new_carousel_item = false;
                            if ($card_counter == 1) $card_counter = 0;
                        @endphp
                    @endforeach

            </div>
            <a class="carousel-control-prev"   data-bs-target="#saran-carousel-mobile" style="width:2.5vw;" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" class="carousel-fontsize-left"  alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#saran-carousel-mobile" style="width:2.5vw;"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" class="carousel-fontsize-right"  alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div>  

    </div>
</div>
@endif
<!-- END OF MOBILE SARAN KAMI SECTION -->

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
<script>
    function toggleInterest(id, color_code) {
        var element = document.getElementById(id);
        
        element.classList.toggle("interest-card-active");
        value=$(element).find("input[type=hidden]");

        if (value.val() == 0) {
            $(element).find("input[type=hidden]").val('1');
            element.style.backgroundColor = color_code;
        } else {
            $(element).find("input[type=hidden]").val('0');
            element.style.backgroundColor = '';
        }
    }
</script>
<script>
    function passBootcampData(title, name, email, phone, bank, bank_account_number, address) {
		document.getElementById("bootcamp-title").innerHTML = title;
		document.getElementById("bootcamp-name").value = name;
		document.getElementById("bootcamp-email").value = email;
		document.getElementById("bootcamp-phone").value = phone;
		document.getElementById("bootcamp-bank").value = bank;
		document.getElementById("bootcamp-bank_account_number").value = bank_account_number;
		document.getElementById("bootcamp-address").value = address;
    }
</script>

<script>
    function passBootcampApplicationId(bootcamp_application_id) {
		document.getElementById("bootcamp_application_id").value = bootcamp_application_id;
    }
</script>
@if ( request()->get('coursesTab'))
    @if (request()->get('coursesTab') == 'liveWorkshop')
        <script>document.getElementById('JadwalLivePelatihanButton').click()</script>
    @elseif (request()->get('coursesTab') == 'onGoingCourses')
        <script>document.getElementById('PelatihanAktifButton').click()</script>
    @elseif (request()->get('coursesTab') == 'completedCourses')
        <script>document.getElementById('PelatihanSelesaiButton').click()</script>
    @endif
@endif
@endsection