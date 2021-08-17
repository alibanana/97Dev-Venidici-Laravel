@extends('./layouts/client-main')
@section('title', 'Venidici Bootcamp')

@section('content')



<!-- START OF POP UP FREE TRIAL REGISTRATION-->
<div id="free-trial" class="overlay" style="overflow:scroll">
    <div class="popup">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="{{route('customer.cart.storeOrder')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row m-0">
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid logo-bootcamp-popup"  alt="LOGO">
                        <p class="medium-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-top:1vw">Free Trial Registration</p>
                        @if (session()->has('free_trial_bootcamp_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('free_trial_bootcamp_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input disabled readonly type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="Masukkan nama" 
                            @if(Auth::check())
                                value="{{ old('name', Auth::user()->name) }}"
                            @else
                                value="{{ old('name') }}"
                            @endif
                            >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Tempat Lahir</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-map-marker-alt"></i>
                            <input type="text" name="birth_place" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="Masukkan tempat lahir" 
                            value="{{ old('birth_place')}}"
                            >
                        </div>  
                        @error('birth_place')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Jenis Kelamin</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-venus-mars"></i>
                            <select disabled  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Gender</option>
                                <option value="Male"
                                @if(Auth::check())
                                    @if(old('gender', Auth::user()->userDetail->gender) == 'Male') selected @endif
                                @else
                                    @if(old('gender') == 'Male') selected @endif
                                @endif
                                >Male</option>
                                <option value="Female"
                                @if(Auth::check())
                                    @if(old('gender', Auth::user()->userDetail->gender) == 'Female') selected @endif
                                @else
                                    @if(old('gender') == 'Female') selected @endif
                                @endif
                                >Female</option>
                            </select>                              
                        </div> 
                        @error('gender')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Provinsi</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-map"></i>
                            <!-- <select onchange="if (this.value){ openLoading(); window.location.href='/bootcamp?province='+this.value+'#full-registration'}"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;"> -->
                            <select disabled  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                @if(!Auth::check())
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @else
                                @if(Auth::user()->userDetail->province_id == null)
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                @endif
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" 
                                        @if(old('province_id',Auth::user()->userDetail->province_id) == $province->id)

                                        selected
                                        @endif
                                    
                                    >{{$province->name }}</option>                                    
                                @endforeach
                                @endif
                            </select>                              
                        </div>  
                        @error('province_id')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                            <input disabled readonly type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="Masukkan email"
                            @if(Auth::check())
                                value="{{old('email', Auth::user()->email)}}"
                            @else
                                value="{{old('email')}}"
                            @endif
                            >
                        </div>  
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Tanggal Lahir</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                            @if(Auth::check())
                            <?php
                                if (Auth::user()->userDetail->birthdate != null) {
                                    $birthdate = explode(' ', Auth::user()->userDetail->birthdate);
                                    $date = $birthdate[0];
                                    $time = $birthdate[1];
                                }
                            ?>
                            @endif
                            <input disabled readonly type="date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="yyyy.mm.dd"
                            @if(Auth::check())
                                value="{{ old('birth_date') ?? $date ?? null }}"
                            @else
                                value="{{old('birth_date')}}"
                            @endif
                            >
                        </div>  
                        @error('birth_date')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Nomor Telepon</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fab fa-whatsapp"></i>
                            <input disabled readonly type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="Masukkan Nomor Telepon"
                            @if(Auth::check())
                                value="{{old('telephone', Auth::user()->userDetail->telephone)}}"
                            @else
                                value="{{old('telephone')}}"
                            @endif
                            >
                        </div>  
                        @error('telephone')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Kota</p>
                        <div class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-map"></i>
                            <select disabled  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                @if(Auth::check())
                                    @if($cities == null && Auth::user()->userDetail->city_id == null)
                                    <option disabled selected>Pilih Provinsi terlebih dahulu</option>
                                    @else
                                    <option disabled selected>Pilih Kota</option>

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
                                @endif
                            </select>                              
                        </div>  
                        @error('city_id')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    <!-- END OF RIGHT SECTION -->

                    <!-- START OF ADDRESS -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Alamat Lengkap</p>
                        <div readonly class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <textarea disabled name="address" rows="3" class="normal-text" style="background:transparent;border:none;color: grey;width:100%" placeholder="Masukkan alamat" >@if (Auth::check()) {{old('address', Auth::user()->userDetail->address)}} @else {{old('address')}} @endif </textarea>
                        </div>  
                        @error('address')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF ADDRESS -->

                    <!-- START OF LEFT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pendidikan Terakhir</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-graduation-cap"></i>
                            <select name="last_degree"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Pendidikan</option>
                                <option value="SMP" @if(old('last_degree') == 'SMP') selected @endif>SMP</option>
                                <option value="SMA" @if(old('last_degree') == 'SMA') selected @endif>SMA</option>
                                <option value="D3" @if(old('last_degree') == 'D3') selected @endif>D3</option>
                                <option value="S1" @if(old('last_degree') == 'S1') selected @endif>S1</option>
                            </select>                              
                        </div>  
                        @error('last_degree')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Batch yang ingin dikuti</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-layer-group"></i>
                            <select name="batch"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Batch</option>
                                @foreach($course->bootcampBatches as $batch)
                                <option value="{{$batch->date}}" @if(old('batch') == $batch->date) selected @endif>Batch {{ $loop->iteration }} ({{ date('d M Y', strtotime($batch->date))}})</option>
                                @endforeach
                            </select>                              
                        </div>  
                        @error('batch')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Apakah sedang mencari pekerjaan?</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-md"></i>
                            <select name="mencari_kerja"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Jawaban</option>
                                <option value="Sedang Kuliah" @if(old('mencari_kerja') == 'Sedang Kuliah') selected @endif>Sedang Kuliah</option>
                                <option value="Sedang Mencari Pekerjaan" @if(old('mencari_kerja') == 'Sedang Mencari Pekerjaan') selected @endif>Sedang Mencari Pekerjaan</option>
                                <option value="Sedang Tidak Mencari Pekerjaan" @if(old('mencari_kerja') == 'Sedang Tidak Mencari Pekerjaan') selected @endif>Sedang Tidak Mencari Pekerjaan</option>
                            </select>                              
                        </div>  
                        @error('mencari_kerja')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Apakah kamu tertarik untuk melanjutkan bootcamp ini?</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-info"></i>
                            <select name="konsiderasi_lanjut"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Jawaban</option>
                                <option value="Ya" @if(old('konsiderasi_lanjut') == 'Ya') selected @endif>Ya</option>
                                <option value="Tidak" @if(old('konsiderasi_lanjut') == 'Tidak') selected @endif>Tidak</option>
                            </select>                              
                        </div>  
                        @error('konsiderasi_lanjut')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF LEFT SECTION -->

                    <!-- START OF RIGHT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Institusi</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-graduation-cap"></i>
                            <input value="{{old('institution')}}" type="text" name="institution" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Institusi" >
                        </div>   
                        @error('institution')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Sumber tahu program ini?</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-info"></i>
                            <input value="{{old('sumber_tahu_program')}}" type="text" name="sumber_tahu_program" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan sumber" >
                        </div>   
                        @error('sumber_tahu_program')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Linked In</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fab fa-linkedin"></i>
                            <input value="{{old('social_media')}}" type="text" name="social_media" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Link Linked In" >
                        </div>   
                        @error('social_media')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- END OF RIGHT SECTION -->

                    <!-- START OF EXPECTATION -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Ekspektasi yang kamu ingin dapatkan dari bootcamp ini?</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <textarea name="expectation" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan ekspektasi anda" >{{old('expectation')}}</textarea>
                        </div>  
                        @error('expectation')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF EXPECTATION -->

                    <!-- START OF LEFT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pilih Metode Pembayaran</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-md"></i>
                            <select name="bankShortCode"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Metode</option>
                                <option value="bca" @if(old('bankShortCode') == 'bca') selected @endif >BCA</option>
                                <option value="bri" @if(old('bankShortCode') == 'bri') selected @endif >BRI</option>
                                <option value="mandiri" @if(old('bankShortCode') == 'mandiri') selected @endif>Mandiri</option>
                            </select>                              
                        </div>  
                        @error('bankShortCode')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- END OF LEFT SECTION -->
                    <!-- START OF RIGHT SECTION -->

                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">No. Rek Untuk Guarantee Return</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-money-check"></i>
                            <input value="{{ old('bank_account_no') }}" type="text" name="bank_account_no" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Nomor Rekening" >
                        </div>   
                        @error('bank_account_no')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->

                    @if(Auth::check())
                        @if(Auth::user()->club != null)
                            @php
                                $discount_club_price = 0;
                                if(Auth::user()->club == 'bike')
                                    $discount_club_price = 2500;
                                elseif(Auth::user()->club == 'car' || Auth::user()->club == 'jet')
                                    $discount_club_price = 5000;
                            @endphp
                        @else
                            @php
                            $discount_club_price = 0;
                            @endphp
                        @endif
                    @else
                        @php
                            $discount_club_price = 0;
                        @endphp
                    @endif
                    
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <input type="hidden" name="total_order_price" value="{{$course->bootcampCourseDetail->bootcamp_trial_price}}">
                        <input type="hidden" value="{{$discount_club_price}}" name="club_discount">
                        <input type="hidden" name="discounted_price" value="0">
                        <input type="hidden" name="promo_code" value="0">
                        <?php
                            $tomorrow_split = explode(' ', $tomorrow);
                            $date = $tomorrow_split[0];
                            $time = $tomorrow_split[1];
                        ?>
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="time" value="{{ $time }}">
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        @php
                            $grand_total = $course->bootcampCourseDetail->bootcamp_trial_price - $discount_club_price;
                        @endphp
                        <input type="hidden" name="grand_total" value="{{$grand_total}}">
                        <div style="text-align: center;margin-bottom:2vw">
                            <p class="normal-text" style="font-family:Rubik Medium;color:orange;margin-bottom:0.4vw">*Uang Guarantee dapat dikembalikan setelah free trial selesai*</p>
                        </div>
                        <button type="submit" onclick="openLoading()" name="action" value="createPaymentObjectBootcamp" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</button>
                    </div>  
                    
                    <!-- END OF GENNERAL INFORMATION -->
                </div>
            </form>

        </div>
    </div>
</div>
<!-- END OF POP UP FREE TRIAL REGISTRATION-->

<!-- START OF POP UP FULL REGISTRATION-->
<div id="full-registration" class="overlay" style="overflow:scroll">
    <div class="popup">
        <a class="close" href="#closed" >&times;</a>
    
        <div class="content" style="padding:2vw">
            
            <form action="{{route('bootcamp.storeFullRegistration', $course->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row m-0">
                    <div class="col-12 p-0" style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid logo-bootcamp-popup"  alt="LOGO">
                        <p class="medium-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-top:1vw">Full Bootcamp Registration</p>
                        @if (session()->has('full_registration_bootcamp_message'))
                        <div class="p-3 mt-2 mb-0">
                            <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                            {{ session()->get('full_registration_bootcamp_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- START OF LEFT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input readonly type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="Masukkan nama" 
                            @if(Auth::check())
                                value="{{ old('name', Auth::user()->name) }}"
                            @else
                                value="{{ old('name') }}"
                            @endif
                            >
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Tempat Lahir</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-map-marker-alt"></i>
                            <input type="text" name="birth_place" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan tempat lahir" 
                            value="{{ old('birth_place')}}"
                            >
                        </div>  
                        @error('birth_place')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Jenis Kelamin</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-venus-mars"></i>
                            <select readonly  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Gender</option>
                                <option value="Male"
                                @if(Auth::check())
                                    @if(old('gender', Auth::user()->userDetail->gender) == 'Male') selected @endif
                                @else
                                    @if(old('gender') == 'Male') selected @endif
                                @endif
                                >Male</option>
                                <option value="Female"
                                @if(Auth::check())
                                    @if(old('gender', Auth::user()->userDetail->gender) == 'Female') selected @endif
                                @else
                                    @if(old('gender') == 'Female') selected @endif
                                @endif
                                >Female</option>
                            </select>                              
                        </div> 
                        @error('gender')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Provinsi</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-map"></i>
                            <!-- <select onchange="if (this.value){ openLoading(); window.location.href='/bootcamp?province='+this.value+'#full-registration'}"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;"> -->
                            <select disabled  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                @if(!Auth::check())
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @else
                                @if(Auth::user()->userDetail->province_id == null)
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                @endif
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}" 
                                        @if(old('province_id',Auth::user()->userDetail->province_id) == $province->id)

                                        selected
                                        @endif
                                    
                                    >{{$province->name }}</option>                                    
                                @endforeach
                                @endif
                            </select>                              
                        </div>  
                        @error('province_id')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <!-- END OF LEFT SECTION --> 
                    <!-- RIGHT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Email</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                            <input readonly type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="Masukkan email"
                            @if(Auth::check())
                                value="{{old('email', Auth::user()->email)}}"
                            @else
                                value="{{old('email')}}"
                            @endif
                            >
                        </div>  
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Tanggal Lahir</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                            @if(Auth::check())
                            <?php
                                if (Auth::user()->userDetail->birthdate != null) {
                                    $birthdate = explode(' ', Auth::user()->userDetail->birthdate);
                                    $date = $birthdate[0];
                                    $time = $birthdate[1];
                                }
                            ?>
                            @endif
                            <input readonly type="date" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="yyyy.mm.dd"
                            @if(Auth::check())
                                value="{{ old('birth_date') ?? $date ?? null }}"
                            @else
                                value="{{old('birth_date')}}"
                            @endif
                            >
                        </div>  
                        @error('birth_date')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Nomor Telepon</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fab fa-whatsapp"></i>
                            <input readonly type="text" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: grey;width:100%" placeholder="Masukkan Nomor Telepon"
                            @if(Auth::check())
                                value="{{old('telephone', Auth::user()->userDetail->telephone)}}"
                            @else
                                value="{{old('telephone')}}"
                            @endif
                            >
                        </div>  
                        @error('telephone')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Kota</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-map"></i>
                            <select disabled  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                @if(Auth::check())
                                @if($cities == null && Auth::user()->userDetail->city_id == null)
                                    <option disabled selected>Pilih Provinsi terlebih dahulu</option>
                                @else
                                    <option disabled selected>Pilih Kota</option>

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
                                @endif
                            </select>                              
                        </div>  
                        @error('city_id')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>
                    <!-- END OF RIGHT SECTION -->

                    <!-- START OF ADDRESS -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Alamat Lengkap</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <textarea disabled name="address" rows="3" class="normal-text" style="background:transparent;border:none;color: grey;width:100%" placeholder="Masukkan alamat" >@if (Auth::check()) {{old('address', Auth::user()->userDetail->address)}} @else {{old('address')}} @endif </textarea>
                        </div>  
                        @error('address')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF ADDRESS -->

                    <!-- START OF LEFT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pendidikan Terakhir</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-graduation-cap"></i>
                            <select name="last_degree"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Pendidikan</option>
                                <option value="SMP" @if(old('last_degree') == 'SMP') selected @endif>SMP</option>
                                <option value="SMA" @if(old('last_degree') == 'SMA') selected @endif>SMA</option>
                                <option value="D3" @if(old('last_degree') == 'D3') selected @endif>D3</option>
                                <option value="S1" @if(old('last_degree') == 'S1') selected @endif>S1</option>
                            </select>                              
                        </div>  
                        @error('last_degree')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Batch yang ingin dikuti</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-layer-group"></i>
                            <select name="batch"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Batch</option>
                                @foreach($course->bootcampBatches as $batch)
                                <option value="{{$batch->date}}" @if(old('batch') == $batch->date) selected @endif>Batch {{ $loop->iteration }} ({{ date('d M Y', strtotime($batch->date))}})</option>
                                @endforeach
                            </select>                              
                        </div>  
                        @error('batch')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Apakah sedang mencari pekerjaan?</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-md"></i>
                            <select name="mencari_kerja"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Jawaban</option>
                                <option value="Sedang Kuliah" @if(old('mencari_kerja') == 'Sedang Kuliah') selected @endif>Sedang Kuliah</option>
                                <option value="Sedang Mencari Pekerjaan" @if(old('mencari_kerja') == 'Sedang Mencari Pekerjaan') selected @endif>Sedang Mencari Pekerjaan</option>
                                <option value="Sedang Tidak Mencari Pekerjaan" @if(old('mencari_kerja') == 'Sedang Tidak Mencari Pekerjaan') selected @endif>Sedang Tidak Mencari Pekerjaan</option>
                            </select>                              
                        </div>  
                        @error('mencari_kerja')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Apakah kamu tertarik untuk melanjutkan bootcamp ini?</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-info"></i>
                            <select name="konsiderasi_lanjut"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Jawaban</option>
                                <option value="Ya" @if(old('konsiderasi_lanjut') == 'Ya') selected @endif>Ya</option>
                                <option value="Tidak" @if(old('konsiderasi_lanjut') == 'Tidak') selected @endif>Tidak</option>
                            </select>                              
                        </div>  
                        @error('konsiderasi_lanjut')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF LEFT SECTION -->

                    <!-- START OF RIGHT SECTION -->
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Institusi</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-graduation-cap"></i>
                            <input value="{{old('institution')}}" type="text" name="institution" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Institusi" >
                        </div>   
                        @error('institution')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Sumber tahu program ini?</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-info"></i>
                            <input value="{{old('sumber_tahu_program')}}" type="text" name="sumber_tahu_program" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan sumber" >
                        </div>   
                        @error('sumber_tahu_program')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Linked In</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fab fa-linkedin"></i>
                            <input value="{{old('social_media')}}" type="text" name="social_media" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Link Linked In" >
                        </div>   
                        @error('social_media')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- END OF RIGHT SECTION -->

                    <!-- START OF EXPECTATION -->
                    <div class="col-12">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Kenapa kamu memililih Bootcamp ini</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <textarea name="kenapa_memilih" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan jawaban anda" >{{old('kenapa_memilih')}}</textarea>
                        </div>  
                        @error('kenapa_memilih')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Ekspektasi yang kamu ingin dapatkan dari bootcamp ini?</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <textarea name="expectation" rows="3" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%" placeholder="Masukkan ekspektasi anda" >{{old('expectation')}}</textarea>
                        </div>  
                        @error('expectation')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF EXPECTATION -->

                    <!-- START OF LEFT SECTION
                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pilih Metode Pembayaran</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-md"></i>
                            <select name="bankShortCode"  class="normal-text"  style="margin-left:1vw;background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;">
                                <option disabled selected>Pilih Metode</option>
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="Mandiri">Mandiri</option>
                            </select>                              
                        </div>  
                        @error('bankShortCode')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- END OF LEFT SECTION
                    <!-- START OF RIGHT SECTION

                    <div class="col-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">No. Rek Untuk Guarantee Return</p>
                        <div  class="auth-input-form normal-text" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-money-check"></i>
                            <input type="text" name="bank_account_no" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Masukkan Nomor Rekening" >
                        </div>   
                        @error('bank_account_no')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                     END OF RIGHT SECTION -->
                    
                    <div class="col-12" style="text-align:center;padding-top:3vw">
                        <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</button>
                    </div>  
                    
                    <!-- END OF GENNERAL INFORMATION -->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF POP UP FULL REGISTRATION-->




@php
    $a = $course->bootcampCourseDetail->date_start;
    $b = strtotime($a);
    
    $customformat = date('M d,Y H:i:s', $b);
@endphp

<script>
    CountDownTimer('{{$customformat}}', 'countdown');
    function CountDownTimer(dt,id)
    {
        var end = new Date(dt);
        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour * 24;
        var timer;
        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            if (distance < 0) {

                clearInterval(timer);
                document.getElementById('days').innerHTML = 0;
                document.getElementById('hours').innerHTML = 0 ;
                document.getElementById('minutes').innerHTML = 0 ;
                document.getElementById('days-mobile').innerHTML = 0;
                document.getElementById('hours-mobile').innerHTML = 0 ;
                document.getElementById('minutes-mobile').innerHTML = 0 ;
                // document.getElementById('free-trial-button').style.display = "none";
                // document.getElementById('full-registration-button').style.display = "none";
                return;
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);

            document.getElementById('days').innerHTML = days;
            document.getElementById('hours').innerHTML = hours ;
            document.getElementById('minutes').innerHTML = minutes ;

            document.getElementById('days-mobile').innerHTML = days;
            document.getElementById('hours-mobile').innerHTML = hours ;
            document.getElementById('minutes-mobile').innerHTML = minutes ;
        }
        timer = setInterval(showRemaining, 1000);
    }
</script>


<!-- START OF TOP SECTION -->
<div class="row m-0 page-container bootcamp-bg desktop-display" style="padding-top:11vw;padding-bottom:17vw;">
    <!-- START OF LECT SECTION -->
    <div class="col-xs-12 col-md-6 p-0 wow fadeInLeft">
        <img src="/assets/images/client/Bootcamp_Logo.png"  class="img-fluid bootcamp-logo-image" alt="Bootcamp Logo">
        <div style="margin-top: 2vw;">
            <p class="medium-heading" style="font-family: Rubik Bold;color:#FFFFFF;white-space:pre-line">{{$course->title}}</p>
            <p class="sub-description" style="font-family: Rubik Medium;color:#FFFFFF;white-space:pre-line">{{date('d M Y', strtotime($course->bootcampCourseDetail->date_start))}} - {{date('d M Y', strtotime($course->bootcampCourseDetail->date_end))}} | Via Zoom</p>
            <p class="normal-text" style="font-family: Rubik Regular;color:#FFFFFF;white-space:pre-line">{{$course->subtitle}}</p>
        </div>
        <p class="bigger-text" style="font-family: Rubik Medium;color:#FFFFFF;margin-top:2vw">Early Bird registration ends in:</p>
        <!-- START OF COUNTDOWN -->
        <div style="padding:1vw;background-color:#FFFFFF;width:20vw;border-radius:10px;margin-bottom:2vw" id="countdown-card">
            <div style="display: flex;justify-content:space-between;align-items:center">
                <div style="text-align: center;border-right:2px solid #2B6CAA;padding-right:2vw">
                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">Days</p>
                    <p class="normal-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px" id="days"></p>
                </div>
                <div style="text-align: center;padding:0vw 2vw">
                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">Hours</p>
                    <p class="normal-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px" id="hours"></p>
                </div>
                <div style="text-align: center;border-left:2px solid #2B6CAA;padding-left:2vw">
                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">Minutes</p>
                    <p class="normal-text" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px" id="minutes"></p>
                </div>
            </div>
        </div>
        <!-- END OF COUNT DOWN --> 
        <a href="#payment-section" class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;padding:0.5vw 2vw">Register Now</a>
    </div>
    <!-- END OF LEFT SECTION -->

    <!-- START OF RIGHT SECTION -->
    <div class="col-xs-12 col-md-6 bootcamp-right-heading-bg wow fadeInUp" data-wow-delay="0.5s" style="display: flex;flex-direction: column;justify-content: flex-end;align-items:center;padding:10vw 0vw">
        <div style="justify-content: center;display:flex;margin-left:10vw" class="wow bounce" data-wow-delay="1s">
            <!-- START OF BOOTCAMP CARD -->
            <div  style="padding:1vw;background-color:#E2E2E2;width:20vw;border-radius:10px;transform: rotate(8deg);margin-right:5.5vw">
                <img src="{{ asset($course->thumbnail) }}" style="width:100%;height:18vw;object-fit:cover;border-radius:10px;border:1px solid #FFFFFF;margin-bottom:0.5vw" class="img-fluid" alt="Bootcamp Logo">
                <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;">{{$course->title}}</p>
            </div>
            <!-- END OF BOOTCAMP CARD -->

        </div>
    </div>

    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF TOP SECTION -->


<!-- START OF TOP SECTION MOBILE -->
<div class="row m-0 page-container  mobile-display" style="display:none">
    <!-- START OF LECT SECTION -->
    <div class="col-12 wow fadeInLeft" style="margin-top:5vw;margin-bottom:3vw">
        <div style="background-color:#2B6CAA; margin-top: 4vw;border-radius: 5px;padding: 7vw 5vw;">
            <div style="">
                <img src="/assets/images/client/Bootcamp_Logo.png"  class="img-fluid bootcamp-logo-image" alt="Bootcamp Logo">
                <p class="medium-heading" style="font-family: Rubik Bold;color:white;white-space:pre-line;margin-top:4vw">{{$course->title}}</p>
                <p class="sub-description" style="font-family: Rubik Medium;color:white;white-space:pre-line">{{date('d M Y', strtotime($course->bootcampCourseDetail->date_start))}} - {{date('d M Y', strtotime($course->bootcampCourseDetail->date_end))}} | Via Zoom</p>
                <p class="normal-text" style="font-family: Rubik Regular;color:white;white-space:pre-line">{{$course->subtitle}}</p>
            </div>
            <p class="bigger-text" style="font-family: Rubik Medium;color:white;margin-top:2vw">This bootcamp will start in: </p>
            <!-- START OF COUNTDOWN -->
            <div style="padding:1vw;background-color:white;width:47vw;border-radius:5px;margin-bottom:5vw" id="countdown-card">
                <div style="display: flex;justify-content:space-between;align-items:center">
                    <div style="text-align: center;border-right:2px solid #2B6CAA;padding-right:2vw">
                        <p class="" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;font-size:3.5vw">Days</p>
                        <p class="" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px;font-size:3.5vw" id="days-mobile"></p>
                    </div>
                    <div style="text-align: center;padding:0vw 2vw">
                        <p class="" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;font-size:3.5vw">Hours</p>
                        <p class="" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px;font-size:3.5vw" id="hours-mobile"></p>
                    </div>
                    <div style="text-align: center;border-left:2px solid #2B6CAA;padding-left:2vw">
                        <p class="" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px;font-size:3.5vw">Minutes</p>
                        <p class="" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:0px;font-size:3.5vw" id="minutes-mobile"></p>
                    </div>
                </div>
            </div>
            <!-- END OF COUNT DOWN --> 
            <a href="#payment-section" class="btn-blue-bordered " style="font-family: Rubik Medium;color:#3B3C43;padding:0.5vw 2vw;font-size:3.5vw">Register Now</a>
        </div>
    </div>
    <!-- END OF LEFT SECTION -->

    
</div>
<!-- END OF TOP SECTION MOBILE-->

<!-- START OF INTRODUCTION SECTION -->
<div class="row m-0 page-container desktop-display" style="padding-bottom:5vw">
    <div class="col-md-12 col-xs-12 p-0">
        <p class="small-heading wow flash" data-wow-delay="0.5s" style="font-family: Rubik Bold;color:#2B6CAA;">Get to Know Our Beloved Bootcamp</p>
        <div style="width:80%">
            <p class="normal-text" style="font-family: Rubik Bold;color:#626262;white-space:pre-line">{{$course->description}}</p>
        </div>
    </div>
    @foreach($course->courseFeatures as $feature)
    <div class="col-xs-6 col-md-4 p-0" style="display:flex;
    @if($loop->iteration % 3 == 1)
    justify-content:flex-start
    @elseif($loop->iteration % 3 == 2)
    justify-content:center
    @elseif($loop->iteration % 3 == 0)
    justify-content:flex-end
    @endif
    ">
        <div class="krest-card" style="margin-top:1.5vw;height:22vw">   
            <img src="/assets/images/client/Krest_Dummy_Card_Image.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
            <p id="krest-card-title" class="bigger-text" style="font-family:Rubik Medium;margin-top:1vw">{{$feature->title}}</p>
            <p id="krest-card-description" class="small-text" style="font-family:Rubik Regular;color:#FFFFFF;margin-top:1vw;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;">{{$feature->feature}}</p>
        </div>
    </div>
    @endforeach
</div>
<!-- END OF INTRODUCTION SECTION -->

<!-- START OF INTRODUCTION MOBILE SECTION -->
<div class="row m-0 page-container mobile-display" style="padding-bottom:5vw;display:none">
    <div class="col-12 ">
        <p class="small-heading wow flash" data-wow-delay="0.5s" style="font-family: Rubik Bold;color:#2B6CAA;">Introduction to Our Bootcamp</p>
        <div style="width:80%">
            <p class="normal-text" style="font-family: Rubik Bold;color:#626262;white-space:pre-line">{{$course->description}}</p>
        </div>
    </div>
    <div class="row m-0 p-0">
        @foreach($course->courseFeatures as $feature)
        
        <div class="col-6" style="display:flex;
        @if($loop->iteration % 2 == 1)
        justify-content:flex-start
        @elseif($loop->iteration % 2 == 0)
        justify-content:flex-end
        @endif
        ">
            <div class="krest-card" style="margin-top:1.5vw;height:22vw">   
                <img src="/assets/images/client/Krest_Dummy_Card_Image.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
                <p id="krest-card-title" class="bigger-text" style="font-family:Rubik Medium;margin-top:1vw">{{$feature->title}}</p>
                <p id="krest-card-description" class="small-text" style="font-family:Rubik Regular;color:#FFFFFF;margin-top:1vw;display: -webkit-box;
                            overflow : hidden !important;
                            text-overflow: ellipsis !important;
                            -webkit-line-clamp: 6 !important;
                            -webkit-box-orient: vertical !important;">{{$feature->feature}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- END OF INTRODUCTION MOBILE SECTION -->

<!-- START OF GROWTH HACKING SECTION -->
<div class="row m-0 page-container" style="background-color: #F6F6F6;padding-top:5vw;padding-bottom:5vw">
    <div class="col-12 p-0" style="text-align: center;">
        <p class="small-heading wow fadeInUp" data-wow-delay="0.5s" style="font-family: Rubik Bold;color:#2B6CAA;">Get to Know Our Beloved Bootcamp</p>
    </div>
    <div class="col-12 growth-hacking-title" style="">
        <!-- START OF CONTENT LINKS -->
        <div style="border: 2px solid #2B6CAA;border-radius:10px;display:flex;justify-content:space-between;align-items:center">
            @foreach($course->bootcampDescriptions as $about)
            <!-- START OF ONE LINK -->
            <div style="@if(!$loop->last) border-right: 2px solid #2B6CAA @endif" class="growth-links growth-title @if($loop->first) growth-title-active @endif" onclick="growthHacking(event, 'growth-{{$loop->iteration}}')">
                <p class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px">{{$about->title}}</p>
            </div>
            <!-- END OF ONE LINK -->
            @endforeach
        </div>
        <!-- END OF CONTENT LINK -->
    </div>
    @foreach($course->bootcampDescriptions as $about)
    <!-- START OF ONE CONTENT SECTION -->
    <div class="growth-content"  id="growth-{{$loop->iteration}}" @if(!$loop->first) style="display:none" @endif >
        <div class="row m-0 "style="padding-top:4vw">
            <div class="col-lg-4 col-xs-12 p-0">
                <img src="{{ asset($about->image) }}" style="width:100%;border-radius:10px" class="img-fluid" alt="KREST">

            </div>
            <div class="col-lg-8 col-xs-12 p-0" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
                <div id="growth-hacking-description">
                    <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px;white-space:pre-line">{{$about->description}}</p>

                </div>

            </div>
        </div>
    </div>
    <!-- END OF ONE CONTENT SECTION -->
    @endforeach
    

</div>
<!-- END OF GROWTH HACKING SECTION -->


<!-- START OF SCHEDULE AND DELIVERY METHOD -->
<div class="row m-0 page-container" id="schedule-section" style="padding-top:5vw;padding-bottom:5vw">
    <div class="col-12 p-0" style="margin-bottom:4vw">
        <div class="container-schedule-delivery">
            <p class="small-heading schedule-links schedule-title schedule-title-active" onclick="changeSchedule(event, 'bootcamp-schedule')" style="font-family: Rubik Bold;margin-right:3vw;cursor:pointer">Bootcamp Schedule</p>
            <p class="small-heading schedule-links schedule-title" onclick="changeSchedule(event, 'delivery-method')" style="font-family: Rubik Bold;margin-left:3vw;cursor:pointer">Delivery Method</p>
        </div>
    </div>
    <!-- START OF BOOTCAMP SCHEDULE -->
    <div class="schedule-content "  id="bootcamp-schedule">

        <div class="row m-0">
            <!-- START OF LEFT SECTION -->
            <div class="col-xs-12 col-lg-6 p-0">
                <div id="schedule-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                    <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                        @foreach($course->bootcampSchedules as $schedule)
                        <!-- START OF ONE ITEM -->
                        <div class="carousel-item @if($loop->first) active @endif">
                            <div style="display: flex;justify-content: center;">
                                <div class="bootcamp-schedule-card-container">
                                    <p class="bigger-text" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0.4vw">{{$schedule->title}}</p>
                                    <p class="small-text" style="font-family: Rubik Regular;color:#2B6CAA;">{{date('d M', strtotime($schedule->date_start))}} - {{date('d M Y', strtotime($schedule->date_end))}}</p>
                                    <p class="normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom: 0.4vw;">{{$schedule->subtitle}}</p>
                                    <ul>
                                        @foreach($schedule->bootcampScheduleDetails as $detail)
                                        <li style="color:#2B6CAA;font-family: Rubik Regular;">
                                            <p class="small-text" style="margin-bottom: 0.3vw;">{{$detail->description}}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE ITEM -->
                        @endforeach
                    </div>
                    <a class="carousel-control-prev"   data-bs-target="#schedule-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                        <img src="/assets/images/icons/arrow-left.svg" class="left-arrow-delivery-method" id="carousel-control-left-menu-image " style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                        <span class="visually-hidden">Prev</span>
                    </a>
                    <a class="carousel-control-next"   data-bs-target="#schedule-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                        <img src="/assets/images/icons/arrow-right.svg" class="right-arrow-delivery-method" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>  
            </div>
            <!-- END OF LEFT SECTION -->
            <!-- START OF RIGHT SECTION -->
            <div class="col-lg-6 col-xs-12 p-0"  style="display: flex;flex-direction: column;justify-content: center;">
                <div style="padding-left: 5vw;">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#3B3C43;">What will be taught in our <br> bootcamp?</p>
                    <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">{{$course->bootcampCourseDetail->what_will_be_taught}}</p>
                    @if (session()->has('send_syllabus_message'))

                    <div class="p-0 mt-2 mb-0">
                        <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                        {{ session()->get('send_syllabus_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                    @if($course->bootcampCourseDetail->syllabus != null) 
                    <form action="{{route('bootcamp.sendSyllabus', $course->id)}}" method="post">
                        @csrf
                        <button  @if(!Auth::check()) onclick="openLogin()" type="button" @else type="submit" @endif   class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw">Request for Syllabus</button>
                    </form>
                    @endif


                </div>

                
            </div>
            <!-- END OF RIGHT SECTION -->        
        </div>
    </div>
    <!-- END OF BOOTCAMP SCHEDULE -->
    <!-- START OF DELIVERY METHOD -->
    <div class="schedule-content"  id="delivery-method" style="display: none;">
        <div class="row m-0">
            <!-- START OF LEFT SECTION -->
            <div class="col-xs-12 col-lg-6 p-0">
                <div id="delivery-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                    <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                        <!-- START OF ONE ITEM -->
                        <div class="carousel-item active">
                            <div style="display: flex;justify-content: center;">
                                <div class="bootcamp-delivery-method-container">
                                    <p class="bigger-text" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0.4vw">Step-by-step teaching 1</p>
                                    <hr style="background:#2B6CAA;height:0.2vw;border-radius:10px;">
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>

                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE ITEM -->
                        <!-- START OF ONE ITEM -->
                        <div class="carousel-item">
                            <div style="display: flex;justify-content: center;">
                                <div class="bootcamp-delivery-method-container">
                                    <p class="bigger-text" style="font-family: Rubik Bold;color:#2B6CAA;margin-bottom:0.4vw">Step-by-step teaching 2</p>
                                    <hr style="background:#2B6CAA;height:0.2vw;border-radius:10px;">
                                    <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>

                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE ITEM -->
                    </div>
                    <a class="carousel-control-prev"   data-bs-target="#delivery-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                        <img src="/assets/images/icons/arrow-left.svg" class="left-arrow-delivery-method" id="carousel-control-left-menu-image " style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                        <span class="visually-hidden">Prev</span>
                    </a>
                    <a class="carousel-control-next"   data-bs-target="#delivery-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                        <img src="/assets/images/icons/arrow-right.svg" class="right-arrow-delivery-method" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>  
            </div>
            <!-- END OF LEFT SECTION -->
            <!-- START OF RIGHT SECTION -->
            <div class="col-lg-6 col-xs-12 p-0"  style="display: flex;flex-direction: column;justify-content: center;">
                <div style="padding-left: 5vw;">
                    <p class="sub-description" style="font-family: Rubik Bold;color:#3B3C43;">What will be taught in our <br> bootcamp?</p>
                    <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">{{$course->bootcampCourseDetail->what_will_be_taught}}</p>
                    @if (session()->has('send_syllabus_message'))

                    <div class="p-0 mt-2 mb-0">
                        <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                        {{ session()->get('send_syllabus_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif
                    @if($course->bootcampCourseDetail->syllabus != null) 
                    <form action="{{route('bootcamp.sendSyllabus', $course->id)}}" method="post">
                        @csrf
                        <button  @if(!Auth::check()) onclick="openLogin()" type="button" @else type="submit" @endif  class="btn-blue-bordered normal-text" style="font-family: Rubik Medium;color:#3B3C43;margin-top:1vw">Request for Syllabus</button>
                    </form>
                    @endif

                </div>
            </div>
            <!-- END OF RIGHT SECTION -->        
        </div>
    </div>
    <!-- END OF DELIVERY METHOD -->
</div>
<!-- END OF SCHEDULE AND DELIVERY METHOD -->

<!-- START OF WHAT WILL YOU GET SECTION -->
<div class="row m-0 page-container desktop-display" style="padding-top:5vw;padding-bottom:5vw;background-color: #F6F6F6;">
    <div class="col-12 p-0" style="text-align: center;">
        <p class="small-heading wow fadeInUp" data-wow-delay="0.5s" style="font-family: Rubik Bold;color:#2B6CAA;">What will you get?</p>
    </div>
    <div class="row m-0" style="padding-top:2vw">
        @foreach($course->bootcampBenefits as $benefit)
        <div class="col-3" style="display:flex;justify-content:center  ">
            <div class="our-mission-card" style="@if($loop->iteration > 4) margin-top:3vw @endif" >
                <div style="text-align:left">
                    <div style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Icon_Illustration.png" style="width:6vw;" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="height:5vw;margin-top:1vw;">
                        <p class="bigger-text" style="font-family: Rubik Medium;color:#2B6CAA;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 3 !important;
                        -webkit-box-orient: vertical !important;height:">{{$benefit->title}}</p>
                    </div>
                    <p class="small-text" style="font-family: Rubik Regular;color:#888888;margin-top:1.5vw;white-space:pre-line">{{$benefit->description}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- END OF WHAT WILL YOU GET SECTION -->

<!-- START OF WHAT WILL YOU GET MOBILE SECTION -->
<div class="row m-0 page-container mobile-display" style="padding-top:5vw;padding-bottom:5vw;background-color: #F6F6F6;display:none">
    <div class="col-12 p-0" style="text-align: center;">
        <p class="small-heading wow fadeInUp" data-wow-delay="0.5s" style="font-family: Rubik Bold;color:#2B6CAA;">What will you get?</p>
    </div>
    <div class="row m-0 p-0" >
        @foreach($course->bootcampBenefits as $benefit)
        <div class="col-6" style="display:flex;justify-content:center">
            <div class="our-mission-card-mobile" style="margin-top:3vw">
                <div style="text-align:center">
                    <div style="text-align:center;margin-top:2vw">
                        <img src="/assets/images/client/Icon_Illustration.png" style="width:11vw;" class="img-fluid" alt="Image 1">
                    </div>
                    <div style="height:3vw;margin-top:1vw;">
                        <p class="bigger-text our-mission-card-title">{{$benefit->title}}</p>
                    </div>
                    <p class="small-text our-mission-card-description" >{{$benefit->description}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- END OF WHAT WILL YOU GET MOBILE SECTION -->

<!-- START OF BOOTCAMP INI UNTUK SIAPA -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;">
    <!-- START OF LEFT SECTION -->
    <div class="col-lg-5 col-xs-12 wow fadeInLeft"  style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start;padding-right:5vw">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Bootcamp ini untuk siapa?</p>
        <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Replenish him third creature and meat blessed void a fruit gathered you’re, they’re two waters own morning gathered greater shall had behold had seed.</p>
        <a href="#payment-section" class="btn-blue-bordered normal-text desktop-display" style="font-family: Rubik Medium;color:#3B3C43;padding:0.5vw 2vw">Register For Free</a>
        <a href="#payment-section" class="btn-blue-bordered normal-text mobile-display" style="font-family: Rubik Medium;color:#3B3C43;display:none;text-align:center">Register For Free</a>
    </div>
    <!-- END OF LEFT SECTION -->

    <!-- START OF RIGHT SECTION -->
    <div class="col-lg-7 col-xs-12">
        <div class="row m-0">
            @php
                $delay = 0.0;
            @endphp
            @foreach($course->bootcampCandidates as $candidate)
            <!-- START OF ONE CARD -->
            <div class="col-6 p-0 wow fadeInUp desktop-display" data-wow-delay="{{$delay}}s" @if($loop->iteration > 2) style="margin-top: 5vw;" @endif>
                <div style="background: rgba(43, 108, 170, 0.1);padding:2vw 1vw 1vw 1vw;border-radius:10px;width:20vw">
                    <img src="/assets/images/icons/Bootcamp_Icon_1.png" style="width:5vw;margin-top:-7vw" class=""  alt="Bootcamp Logo">
                    <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw;height:4vw">{{$candidate->title}}</p>
                    <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">{{$candidate->description}}</p>
                </div>
            </div>
            <!-- END OF ONE CARD -->
            <!-- START OF ONE CARD -->
            <div class="col-6 p-0 wow fadeInUp mobile-display"  data-wow-delay="{{$delay}}s" @if($loop->iteration > 0) style="margin-top: 5vw;display:none" @endif>
                <div style="background: rgba(43, 108, 170, 0.1);padding:3vw;border-radius:10px;width:40vw;">
                    <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">{{$candidate->title}}</p>
                    <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">{{$candidate->description}}</p>
                </div>
            </div>
            <!-- END OF ONE CARD -->
            @php
                $delay += 0.2;
            @endphp
            @endforeach
        </div>
    </div>
    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF BOOTCAMP INI UNTUK SIAPA -->

<!-- START OF HOW TO JOIN SECTION -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;background-color: #F6F6F6;">
    
    <div class="col-lg-12 col-xs-12" style="text-align:center">
        <p class="small-heading wow bounce" data-wow-delay="0.2s" style="font-family: Rubik Bold;color:#2B6CAA;">How to join?</p>
        <div style="display:flex;justify-content:center">
            <div class="accordion" id="accordionExample" style="width:50vw;">

                <div class="accordion-item" style="display:flex;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div id="left-section" style="width:3vw;background-color:#2B6CAA;display: flex;flex-direction: column;justify-content: center;align-items:center;padding:1vw;border: 3px solid rgba(43, 108, 170, 0.25);border-radius: 10px 0px 0px 0px">
                        <p class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#FFFFFF;">1</p>
                    </div>
                    <div style="background:#FFFFFF;padding:1vw;display: flex;flex-direction: column;justify-content: center;align-items:flex-start;border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);border-top: 3px solid rgba(43, 108, 170, 0.25);border-radius: 0px 10px 0px 0px;width: 100%;">
                        <p class="bigger-text accordion" style="font-family: Rubik Bold;margin-bottom:0px;color:#3B3C43;cursor:pointer;text-align:left">Online Application</p>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="" style="margin-top:1vw;text-align:left">
                                <p class="regular-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43">Selesaikan formulir singkat berdurasi 5 menit untuk menginformasikan kami latar belakang, tujuan, dan pengalaman kamu sebelumnya</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="display:flex;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <div id="left-section" style="width:3vw;background-color:#2B6CAA;display: flex;flex-direction: column;justify-content: center;align-items:center;padding:1vw;border-left: 3px solid rgba(43, 108, 170, 0.25);border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);">
                        <p class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#FFFFFF;">2</p>
                    </div>
                    <div style="background:#FFFFFF;padding:1vw;display: flex;flex-direction: column;justify-content: center;align-items:flex-start;border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);width: 100%;">
                        <p class="bigger-text accordion" style="font-family: Rubik Bold;margin-bottom:0px;color:#3B3C43;cursor:pointer;text-align:left">Online Test</p>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="" style="margin-top:1vw;text-align:left">
                                <p class="regular-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43">Mengerjakan tes analitis dan pengetahuan dasar yang akan dilakukan secara online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="display:flex;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <div id="left-section" style="width:3vw;background-color:#2B6CAA;display: flex;flex-direction: column;justify-content: center;align-items:center;padding:1vw;border-left: 3px solid rgba(43, 108, 170, 0.25);border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);">
                        <p class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#FFFFFF;">3</p>
                    </div>
                    <div style="background:#FFFFFF;padding:1vw;display: flex;flex-direction: column;justify-content: center;align-items:flex-start;border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);width: 100%;">
                        <p class="bigger-text accordion" style="font-family: Rubik Bold;margin-bottom:0px;color:#3B3C43;cursor:pointer;text-align:left">Free Introduction Class</p>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="" style="margin-top:1vw;text-align:left">
                                <p class="regular-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43">Menghadiri introduction class tidak berbayar yang diadakan di minggu pertama serta menyelesaikan assignment yang diberikan pada kelas tersebut.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="display:flex;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                    <div id="left-section" style="width:3vw;background-color:#2B6CAA;display: flex;flex-direction: column;justify-content: center;align-items:center;padding:1vw;border-left: 3px solid rgba(43, 108, 170, 0.25);border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);">
                        <p class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#FFFFFF;">4</p>
                    </div>
                    <div style="background:#FFFFFF;padding:1vw;display: flex;flex-direction: column;justify-content: center;align-items:flex-start;border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);width: 100%;">
                        <p class="bigger-text accordion" style="font-family: Rubik Bold;margin-bottom:0px;color:#3B3C43;cursor:pointer;text-align:left">Video Call</p>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="" style="margin-top:1vw;text-align:left">
                                <p class="regular-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43">Bertemu via video call dengan Counselor kami untuk memastikan bahwa harapan dan tujuan karir kamu selaras dengan apa yang program kami tawarkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="display:flex;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                    <div id="left-section" style="width:3vw;background-color:#2B6CAA;display: flex;flex-direction: column;justify-content: center;align-items:center;padding:1vw;border-left: 3px solid rgba(43, 108, 170, 0.25);border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);">
                        <p class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#FFFFFF;">5</p>
                    </div>
                    <div style="background:#FFFFFF;padding:1vw;display: flex;flex-direction: column;justify-content: center;align-items:flex-start;border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);width: 100%;">
                        <p class="bigger-text accordion" style="font-family: Rubik Bold;margin-bottom:0px;color:#3B3C43;cursor:pointer;text-align:left">Secure Financing</p>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="" style="margin-top:1vw;text-align:left">
                                <p class="regular-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43">Akhirnya, memilih antara metode pembayaran penuh & angsuran atau melakukan finalisasi skema Income Share Agreement.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item" style="display:flex;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                    <div id="left-section" style="width:3vw;background-color:#2B6CAA;display: flex;flex-direction: column;justify-content: center;align-items:center;padding:1vw;border-left: 3px solid rgba(43, 108, 170, 0.25);border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);border-radius: 0px 0px 0px 10px;">
                        <p class="bigger-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#FFFFFF;">6</p>
                    </div>
                    <div style="background:#FFFFFF;padding:1vw;display: flex;flex-direction: column;justify-content: center;align-items:flex-start;border-right: 3px solid rgba(43, 108, 170, 0.25);border-bottom: 3px solid rgba(43, 108, 170, 0.25);width: 100%;border-radius: 0px 0px 10px 0px;">
                        <p class="bigger-text accordion" style="font-family: Rubik Bold;margin-bottom:0px;color:#3B3C43;cursor:pointer;text-align:left">Start Class</p>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="" style="margin-top:1vw;text-align:left">
                                <p class="regular-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43">Setelah merampungkan hal terkait pembayaran, kamu akhirnya siap mentransformasi karirmu!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF HOW TO JOIN SECTION -->

<!-- START OF BISA BERKARIR JADI APA SECTION -->
<div class="row m-0 page-container desktop-display" style="padding-top:5vw;padding-bottom:5vw">
    <div class="col-12 p-0">
        <p class="small-heading wow fadeInLeft" data-wow-delay="0.2s" style="font-family: Rubik Bold;color:#2B6CAA;">Here are your future career choices</p>
    </div>
    @foreach($course->bootcampFutureCareers as $career)
    <!-- START OF ONE CARD -->
    <div class="col-md-4 col-xs-6 p-0" style="display: flex;
    @if($loop->iteration % 3 == 1)
    justify-content:flex-start;
    @elseif($loop->iteration % 3 == 2)
    justify-content:center;
    @elseif($loop->iteration % 3 == 0)
    justify-content:flex-end;
    @endif
    ">
        <div style="background: #FFFFFF;border: 3px solid #2B6CAA;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:22vw;height:24vw">
            <div style="text-align:center;margin-bottom:1vw">
                <img src="{{asset($career->thumbnail)}}" style="width:7vw;" alt="Bootcamp Illustration">
            </div>
            <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">{{$career->title}}</p>
            <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0p;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 6 !important;
                        -webkit-box-orient: vertical !important;">{{$career->description}}</p>
        </div>
    </div>
    <!-- END OF ONE CARD -->
    @endforeach

</div>
<!-- END OF BISA BERKARIR JADI APA SECTION -->

<!-- START OF BISA BERKARIR JADI APA MOBILE SECTION -->
<div class="row m-0 page-container mobile-display" style="padding-top:5vw;padding-bottom:5vw;display:none">
    <div class="col-12 ">
        <p class="small-heading wow fadeInLeft mb-0" data-wow-delay="0.2s" style="font-family: Rubik Bold;color:#2B6CAA;">Here are your future career choices</p>
    </div>
    <div class="row m-0 p-0">
        @foreach($course->bootcampFutureCareers as $career)
        <!-- START OF ONE CARD -->
        <div class="col-6" style="display:flex;
            @if($loop->iteration % 2 == 1)
            justify-content:flex-start
            @elseif($loop->iteration % 2 == 0)
            justify-content:flex-end
            @endif
            ">
            <div style="background: #FFFFFF;border: 3px solid #2B6CAA;box-shadow: 0px 0px 8px 2px rgba(157, 157, 157, 0.11);border-radius: 10px;padding:2vw;width:44vw;height:58vw;margin-top:5vw">
                <div style="text-align:center;margin-bottom:1vw">
                    <img src="{{asset($career->thumbnail)}}" style="width:13vw;" alt="Bootcamp Illustration">
                </div>
                <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-bottom:0.3vw">{{$career->title}}</p>
                <p class="small-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px;">{{$career->description}}</p>
            </div>
        </div>
        <!-- END OF ONE CARD -->
        @endforeach
    </div>

</div>
<!-- END OF BISA BERKARIR JADI APA MOBILE SECTION -->

<!-- START OF OUR INSTRUCTORS -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;background-color: #F5F2F2;">
    <div class="col-12 p-0">
        <div id="instructors-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                @foreach($course->teachers as $teacher)
                <!-- START OF ONE ITEM -->
                <div class="carousel-item @if($loop->first) active @endif">
                    <div class="row m-0"> 
                        <!-- START OF LEFT SECTION -->
                        <div class="col-12 col-lg-5">
                            <img src="{{asset($teacher->image)}}" class="image-teacher-bootcamp" alt="Bootcamp Instructor">
                        </div>
                        <!-- END OF LEFT SECTION -->
                        <!-- START OF RIGHT SECTION -->
                        <div class="col-12 col-lg-7" style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start">
                            <p class="small-heading wow flash" data-wow-delay="0.2s" style="font-family: Rubik Bold;color:#2B6CAA;">Meet Our <span style="color:#67BBA3"> Instructor/s</span></p>
                            <p class="normal-text" style="font-family: Rubik Regular;color:#626262;text-align:left">{{$teacher->description}}​</p>
                            <p class="bigger-text" id="bootcamp-teacher-name" style="font-family: Rubik Medium;color:#626262;text-align:left">{{$teacher->name}}
                            @if($teacher->occupancy != null)
                            , {{$teacher->occupancy}}​
                            @endif
                            </p>
                            @if($teacher->company_logo != null)
                            <img src="{{asset($teacher->company_logo)}}" id="bootcamp-instructor-company-logo" style="width:8vw;border-radius:10px" alt="Bootcamp Instructor Company">
                            @endif
                        </div>
                        <!-- END OF RIGHT SECTION -->
                    </div>
                </div>
                <!-- END OF ONE ITEM -->
                @endforeach
            </div>
            @if(count($course->teachers) > 1)
            <a class="carousel-control-prev"   data-bs-target="#instructors-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#instructors-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
            @endif
        </div>      

    </div>
</div>
<!-- END OF OUR INSTRUCTORS -->

<!-- START OF OUR HIRING PARTNERS SECTION -->
<div class="row m-0 page-container d-none" style="padding-top:5vw;padding-bottom:5vw;">
    <!-- START OF LEFT SECTION -->
    <div class="col-lg-6 col-xs-12" style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA;">Our Hiring Partners</p>
        <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Seorang Growth Marketer di Telkom Omni Communication Assistant (OCA). Welby percaya, Growth Hacking merupakan skill sekaligus pekerjaan berharga yang akan terus diperlukan di setiap divisi dan bagian untuk pertumbuhan bisnis yang optimal.</p>

    </div>
    <!-- END OF LEFT SECTION -->
    <!-- START OF RIGHT SECTION -->
    <div class="col-lg-6 col-xs-12" style="padding-left: 5vw;">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap: wrap;">
            @php
                $delay = 0.2;
            @endphp
            @foreach($course->bootcampHiringPartners as $partner)
            <img class="wow fadeInUp bootcamp-image-hiring-partner" data-wow-delay="{{$delay}}s" src="{{asset($partner->image)}}"  alt="Bootcamp Partner">
            @php
                $delay += 0.2;
            @endphp
            @endforeach
        </div>
    </div>
    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF OUR HIRING PARTNERS SECTION -->

<!-- START OF PRICING PLAN -->
<div class="row m-0 page-container" id="payment-section" style="padding-top:5vw;padding-bottom:5vw;">
    <div class="col-12 p-0" style="text-align: center;margin-bottom:2vw">
        <p class="small-heading wow flash" data-wow-delay="0.2s" style="font-family: Rubik Bold;color:#2B6CAA;">Here is our Pricing Plan</p>
    </div>
    <!-- START OF FULL REGISTRATION -->
    <div class="col-md-6 col-6 p-0" >
        <div class="full-registration-container">
            <div>
                <p class="bigger-text" style="font-family: Poppins Medium;color:#FFFFFF;">Full registration to Bootcamp</p>
                <p class="normal-text" style="font-family: Poppins Medium;color:#67BBA3;">Rp. {{ number_format($course->bootcampCourseDetail->bootcamp_full_price, 0, ',', ',') }} / person</p>
                <ul>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Full curriculum dan assessment</p>
                    </li>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Sertifikat dan pembimbingan</p>
                    </li>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Purus volutpat eu nisi, maecenas neque eget sit</p>
                    </li>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Rhoncus nascetur pellentesque est blandit</p>
                    </li>
                    <li style="color:#FFFFFF;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Pembayaran di luar website</p>
                    </li>
                </ul>
            </div>
            <a 
            @if(Auth::check())
             
                @if(auth()->user()->isProfileUpdated)
                    @if($bootcamp_application_count != 0)
                    onclick="return alert('You have a pending or an on going bootcamp application.')"
                    @else
                    href="#full-registration" 
                @endif

                @else
                    href="/dashboard" 
                @endif
            
            @else 
                href="/login" 
            @endi

            @endif class="btn-blue-bordered normal-text register-now-button" id="free-trial-button" style="">Register Now</a>

        </div>

    </div>
    <!-- END OF FULL REGISTRATION -->
    <!-- START OF FREE TRIAL -->
    <div class="col-md-6 col-6 p-0">
        <div class="free-trial-container">
            <div>
                <p class="bigger-text" style="font-family: Poppins Medium;color:#3B3C43;">Free Trial to Bootcamp</p>
                <p class="normal-text" style="font-family: Poppins Medium;color:#888888;">Rp. {{ number_format($course->bootcampCourseDetail->bootcamp_trial_price, 0, ',', ',') }} / person</p>
                <ul>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Full curriculum dan assessment</p>
                    </li>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Sertifikat dan pembimbingan</p>
                    </li>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Purus volutpat eu nisi, maecenas neque eget sit</p>
                    </li>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Rhoncus nascetur pellentesque est blandit</p>
                    </li>
                    <li style="color:#3B3C43;font-family: Rubik Regular;">
                        <p class="normal-text" style="margin-bottom: 0.3vw;">Pembayaran di luar website</p>
                    </li>
                </ul>
            </div>
            <a  
            @if(Auth::check())
             
                @if(auth()->user()->isProfileUpdated)
                    @if($bootcamp_application_count != 0)
                    onclick="return alert('You have a pending or an on going bootcamp application.')"
                    @else
                    href="#free-trial" 
                @endif

                @else
                    href="/dashboard" 
                @endif
            
            @else 
                href="/login" 
            @endif class="btn-blue-bordered normal-text free-trial-button" id="full-registration-button" >Get Free Trial Now</a>

        </div>
    </div>
    <!-- END OF FREE TRIAL -->
</div>
<!-- END OF PRICING PLAN -->

<!-- START OF OUR COMMUNITY -->
<div class="row m-0 page-container" style="padding-top:5vw;padding-bottom:5vw;background-color:#F5F2F2">
    <!-- START OF LEFT SECTION -->
    <div class="col-lg-6 col-xs-12" style="display: flex;flex-direction: column;justify-content: center;align-items:flex-start">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Still Hesitating?</p>
        <p class="normal-text" style="font-family: Rubik Regular;color:#626262;">Jangan sungkan untuk bertanya kepada kami! Mulai dari struktur program, sampai program pembayaran. Apapun akan kami layani sebaik mungkin.</p>
        <a href="https://api.whatsapp.com/send?phone=+6281294131031&text=Halo%21%20Saya%20ingin%20bertanya%20tentang%20program%20Bootcamp%20By%20Venidici%20" class="btn-blue-bordered normal-text our-community-bootcamp" >Consult via Whatsapp</a>

    </div>    
    <!-- END OF LEFT SECTION -->
    <!-- START OF RIGHT SECTION -->
    <div class="col-lg-6 col-xs-12 desktop-display">
        <img src="/assets/images/client/Community_Asset_3.png" class="img-fluid" style="width:100%;height:20vw;object-fit:cover" alt="">
    </div>
    <div class="col-12 mobile-display" style="display:none">
        <img src="/assets/images/client/Community_Asset_3.png" class="img-fluid" style="width:100%;height:35vw;object-fit:cover" alt="">
    </div>        
    <!-- END OF RIGHT SECTION -->
</div>
<!-- END OF OUR COMMUNITY -->

<!-- START OF FAQ SECTION -->
<div class="row m-0 page-container faq-background" style="padding-top:6vw;padding-bottom:6vw">
        <div class="col-12 p-0" style="text-align:center">
        <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">Frequently Asked Questions</p>
        </div>
        <!-- START OF QUESTION SECTION -->
        <div class="col-12 p-0" style="display:flex;justify-content:center;margin-top:1.5vw">
            <div style="background-color:#F9F9F9;padding:1.5vw;border-radius:10px;width:92%">
                <!-- START OF ONE FAQ CARD -->
                <div class="faq-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Schedule</p>
                        <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ1" role="button" aria-expanded="false" aria-controls="collapseFaQ1">
                            <i class="fas fa-chevron-down"></i>
                        </p>                                    
                    </div>
                    <div class="collapse" id="collapseFaQ1" style="margin-top:1vw">
                        <!-- START OF ONE FAQ CARD -->
                        <div class="faq-card" style="margin-top:1vw">
                            <div style="display:flex;align-items:center;justify-content:space-between;">
                                <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Apa saja yang saya dapatkan di Venidici Skill Snack?</p>
                                <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseSubFaQ1A" role="button" aria-expanded="false" aria-controls="collapseSubFaQ1A">
                                    <i class="fas fa-chevron-down"></i>
                                </p>                                    
                            </div>
                            <div class="collapse" id="collapseSubFaQ1A" style="margin-top:1vw">
                                <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular"> 
                                Kamu bisa melihat detail setiap course di page ya. Yang pasti, di setiap course, akan ada video pembelajaran, penilaian, dan sertifikat jika kamu sudah menyelesaikan semuanya!
                            </p>
                            </div>
                        </div>
                        <!-- END OF ONE FAQ CARD -->
                    </div>
                </div>
                <!-- END OF ONE FAQ CARD -->
                <!-- START OF ONE FAQ CARD -->
                <div class="faq-card" style="margin-top: 1vw;">
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Learning</p>
                        <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ2" role="button" aria-expanded="false" aria-controls="collapseFaQ2">
                            <i class="fas fa-chevron-down"></i>
                        </p>                                    
                    </div>
                    <div class="collapse" id="collapseFaQ2" style="margin-top:1vw">
                        <!-- START OF ONE FAQ CARD -->
                        <div class="faq-card" style="margin-top:1vw">
                            <div style="display:flex;align-items:center;justify-content:space-between;">
                                <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Apa saja yang saya dapatkan di Venidici Skill Snack?</p>
                                <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseSubFaQ2A" role="button" aria-expanded="false" aria-controls="collapseSubFaQ2A">
                                    <i class="fas fa-chevron-down"></i>
                                </p>                                    
                            </div>
                            <div class="collapse" id="collapseSubFaQ2A" style="margin-top:1vw">
                                <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular"> 
                                Kamu bisa melihat detail setiap course di page ya. Yang pasti, di setiap course, akan ada video pembelajaran, penilaian, dan sertifikat jika kamu sudah menyelesaikan semuanya!
                            </p>
                            </div>
                        </div>
                        <!-- END OF ONE FAQ CARD -->
                    </div>
                </div>
                <!-- END OF ONE FAQ CARD -->
                
                
            </div>
        </div>
        <!-- END OF QUESTION SECTION -->
    </div>
    <!-- END OF FAQ SECTION -->


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
var acc = document.getElementsByClassName("accordions");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("mouseover", function() {
    var grandParent = $(this).parents()[1]
    console.log(grandParent)
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });

  

}
</script>
<script>
    function growthHacking(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("growth-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("growth-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("growth-title-active", "growth-title");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " growth-title-active";
        }
         
</script>
<script>
    function changeHowToJoin(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("htj-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("htj-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("htj-title-active", "htj-title");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " htj-title-active";
        }
         
</script>
<script>
    function changeSchedule(evt, categoryName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("schedule-content")
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("schedule-links");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace("schedule-title-active", "schedule-title");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " schedule-title-active";
        }
         
</script>
@endsection