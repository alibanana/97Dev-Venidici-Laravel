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
            <form action="{{ route('customer.update_profile', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')        

                <div class="row m-0">
                    <div class="col-12" style="text-align:left;">
                        @if(session('success'))
                            <!-- ALERT MESSAGE -->
                            <div style="text-align:center;margin-top:1vw">
                                <div class="alert alert-success alert-dismissible fade show small-text"  style="text-align:center;margin-bottom:1vw;width:20vw"role="alert">
                                {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <img src="{{ asset(Auth::user()->avatar) }}" style="width:6vw" alt=""> <br>
                        @endif

                        <input type="file" id="images" name="avatar" accept=".jpg,.jpeg,.png" style="margin-top:1vw"/>
                        <!--
                        <label id="uploadButton" for="images" style="font-family:Rubik Medium">Choose Image</label>-->
                    </div>
                    <div class="col-6" style="">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="John Doe" value="{{Auth::user()->name}}">
                        </div>  
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Phone Number</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                            <input type="text" name="telephone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="+62812345678" value="{{Auth::user()->userDetail->telephone}}">
                        </div>  
                        @error('telephone')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Gender</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <select name="gender" id=""  class="normal-text"  style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%">
                                <option disabled selected>Choose Gender</option>
                                <option value="Male" @if(Auth::user()->userDetail->gender == 'Male') selected @endif>Male</option>
                                <option value="Female" @if(Auth::user()->userDetail->gender == 'Female') selected @endif>Female</option>
                                <option value="None of the above" @if(Auth::user()->userDetail->gender == 'None of the above') selected @endif>None of the above</option>
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
                            if(Auth::user()->userDetail->birthdate != null)
                            {
                                $birthdate = explode(' ', Auth::user()->userDetail->birthdate);
                                $date=$birthdate[0];
                                $time=$birthdate[1];
                            }
                        ?>
                        <div class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-birthday-cake"></i>
                            <input type="date" name="birthdate" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="dd.mm.yyyy" @if(Auth::user()->userDetail->birthdate != null) value="{{$date}}" @endif>
                        </div>  
                        @error('birthdate')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Company/Institution</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-building"></i>
                            <input type="text" name="company" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Binus University International" value="{{Auth::user()->userDetail->company}}">
                        </div>  
                        @error('company')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Pekerjaan</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-user-friends"></i>
                            <input type="text" name="occupancy" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" placeholder="Mahasiswa" value="{{Auth::user()->userDetail->occupancy}}">
                        </div>  
                        @error('occupancy')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- END OF RIGHT SECTION -->

                    <p class="bigger-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:2vw">Shipping Address</p>
                    

                    <div class="col-12 col-sm-6" >
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Provinsi</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <select name="province_id" id=""  class="normal-text"  style="background:transparent;border:none;color: #3B3C43;;width:100%">
                                @if(Auth::user()->userDetail->province_id == null)
                                <option value="" disabled selected>Pilih Provinsi</option>
                                @endif
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}" @if( Auth::user()->userDetail->province_id == $province->id) selected @endif>{{$province->name }}</option>
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
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Kota</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <select name="city_id" id=""  class="normal-text"  style="background:transparent;border:none;color: #3B3C43;;width:100%">
                                @if(Auth::user()->userDetail->city_id == null)
                                <option value=" " disabled selected>Pilih Kota</option>
                                @endif
                                @foreach($cities as $city)
                                    <option value="{{$city->city_id}}"  @if( Auth::user()->userDetail->city_id == $city->city_id) selected @endif>{{$city->name }}</option>
                                @endforeach
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
                            <textarea name="address" id="" rows="4" class="normal-text"   style="background:transparent;border:none;color: #3B3C43;;width:100%">{{Auth::user()->userDetail->address}}</textarea>                
                        </div>  
                        @error('address')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12" style="text-align:right;padding-top:3vw">
                        <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Update Profile</button>
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
            @if (session()->has('success'))
            <div class="p-3 mt-2 mb-0">
                <div class="alert alert-success alert-dismissible fade show m-0" role="alert" style="font-size: 18px">
                    {{ session('success') }}
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
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt"></i>
                            <input type="password" name="old_password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" required>
                        </div>  
                        @error('old_password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">New Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt"></i>
                            <input type="password" name="password" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" required>
                        </div>  
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Confirm New Password</p>
                        <div  class="auth-input-form" style="display: flex;align-items:center">
                            <i style="color:#DAD9E2" class="fas fa-unlock-alt"></i>
                            <input type="password" name="password_confirmation" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%" required>
                        </div>  
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
    <div class="popup" style="width:50% !important">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12" style="text-align:center;">
                    <img src="/assets/images/client/Stars_Illustration.png" class="img-fluid" style="width:14vw" alt="">
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
                            <p class="small-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:1vw">0 Points Left</p>
                            <div class="progress" style="border-radius:10px !important;height:0.8vw">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background-color: #F4C257;"></div>
                            </div>
                            @else
                            @php
                                $percentCar = ( (auth()->user()->userDetail->total_stars - 20) / 80 ) * 100 ;
                            @endphp
                            <p class="small-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:1vw">{{ 100 - auth()->user()->userDetail->total_stars}} Points Left</p>
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
                            <p class="small-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:1vw">0 Points Left</p>
                            <div class="progress" style="border-radius:10px !important;height:0.8vw">
                                
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background-color: #F4C257;"></div>
                            </div>
                            @else
                            <p class="small-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:1vw">{{ 280 - auth()->user()->userDetail->total_stars}} Points Left</p>
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
                            <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">How Venidici Point System Works?</p>
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
                                        <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                                        <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:0vw">Ketertarikan anda</p>
                                        <p class="bigger-text" style="font-family:Rubik Regular;color: @if(session('message')) #CE3369 @else #3B3C43 @endif;margin-bottom:0vw">Maksimal 3 pilihan</p>
                                        @if(session('success'))
                                            <!-- ALERT MESSAGE -->
                                            <div style="text-align:center;margin-top:1vw">
                                                <div class="alert alert-success alert-dismissible fade show small-text"  style="text-align:center;margin-bottom:0px"role="alert">
                                                {{ session('success') }}
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
                                            style="background-image: url({{ $interest->image }});cursor:pointer; @if($flag) background-color: {{$interest->color}}; @endif" onclick="toggleInterest('interest_card_{{ $interest->id }}', '{{ $interest->color }}')">
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
<div class="row m-0 page-container" style="padding-top:9vw"> 
    @if(!Auth::user()->isProfileUpdated)
    <div class="col-12" style="height:3.5vw;display:flex;justify-content:center">
        <!-- ALERT MESSAGE -->
        <div class="alert alert-warning alert-dismissible fade show small-text"  style="width:50%;text-align:center;margin-bottom:0px"role="alert">
            <strong><a href="#edit-profile">Click here</a></strong> This is a toast message contains a warning or a reminder
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- END OF ALERT MESSAGE -->
    </div>
    @endif
</div>

<div class="row m-0 page-container" style="padding-top:1.5vw;">
    <div class="col-12 p-0" style="display:flex;justify-content:center">
        <div class="card-white wow fadeInUp" data-wow-delay="0.3s" style="height:18vw;padding:1.5vw 1.5vw;width:49vw;display:flex;align-items:center">
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
                <div style="width:70%">
                    <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.8vw;display: -webkit-box;
                        overflow : hidden !important;
                        text-overflow: ellipsis !important;
                        -webkit-line-clamp: 2 !important;
                        -webkit-box-orient: vertical !important;">{{Auth::user()->userDetail->address}}</p>   
                </div>
                <div style="display:flex;align-items:center;margin-top:0.8vw">
                    @foreach(Auth::user()->hashtags as $hashtag)
                    <p class="small-text" style="font-family:Rubik Medium;color:{{$hashtag->color}};background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px;@if($loop->iteration != 1) margin-left:1vw @endif">{{$hashtag->hashtag}}</p>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>
<!-- END OF TOP SECTION -->


<!-- START OF MIDDLE SECTION -->
<div class="row m-0 page-container-inner " data-wow-delay="0.6s" style="padding-top:4vw;padding-bottom:4vw">
    <div class="col-12 p-0" style="">
        <div style="display:flex">

            <p class="sub-description blue-text-underline blue-text-underline-active user-links" onclick="changeContent(event, 'live-pelatihan')"  style="font-family:Rubik Medium;cursor:pointer;margin-bottom:0px">Jadwal Live Pelatihan</p>
            <p class="sub-description blue-text-underline user-links" onclick="changeContent(event, 'pelatihan-aktif')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px">Pelatihan Aktif</p>
            <p class="sub-description blue-text-underline user-links" onclick="changeContent(event, 'pelatihan-selesai')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px">Pelatihan Selesai</p>
        </div>
    </div>
    <!-- Live Pelatihan Content -->
    <div style="padding:0px" class="user-content wow fadeInLeft" id="live-pelatihan">
        <div class="col-12 p-0">
            <div class="red-bordered-card" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/sertifikat-menjadi-komedian-lucu','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:13vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Woki</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:37vw">
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
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:13vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" >Workshop</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:37vw">
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
    <div style="padding:0px;display:none" class="user-content wow fadeInLeft" id="pelatihan-aktif">
        @php
        $aktif_flag = FALSE;
        foreach(auth()->user()->courses as $course_on_going)
        {
            if($course_on_going->pivot->status == 'on-going')
                $flag = TRUE;
        }
        @endphp
        @if(!$flag)
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Pelatihan aktif belum tersedia.</span></p>
            </div>
        @endif
        @foreach(auth()->user()->courses as $course)
        @if($course->pivot->status == 'on-going')
        <div class="col-12 p-0">
            <div class="@if($course->course_type_id == 1) blue-bordered-card @else red-bordered-card @endif" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/{{$course->id}}/learn/lecture/{{ $course->sections[0]->sectionContents[0]->id }}','_self');">
                <div class="container-image-card">
                    <img src="/assets/images/client/our-programs-card-dummy.png" style="width:13vw" class="img-fluid" alt="">
                    <div class="top-left card-tag small-text" > @if($course->course_type_id == 1) Online Course @else Woki @endif</div>
                </div>           
                <div style="display:flex;justify-content:space-between">
                    <div class="right-section" style="width:37vw">
                        <div>
                            <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">{{$course->title}}</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">By 
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
                            <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{$course->courseCategory->category}}</a>

                        </div>
                    </div>
                    @php
                    $section_learned = 0;
                    $number_of_section = 0;
                    foreach($course->sections as $section){
                        foreach($section->sectionContents as $content){
                            $number_of_section++;
                            $all_users = explode(',', $content->hasSeen);
                            foreach($all_users as $user_id)
                            {
                                if($user_id == auth()->user()->id)
                                {
                                    $section_learned++;
                                    break;
                                }
                            }
                        }
                    }
                    $percentage = ($section_learned/$number_of_section) * 100
                    @endphp
                    <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                        <div class="progress progress-bar-vertical" style="background: rgba(43, 108, 170, 0.3);position:relative">
                            <p style="position:absolute;left: @if($percentage == 100) 35% @else 40% @endif;top:35%" class="normal-text">{{round($percentage)}}%</p>
                            <div class="progress-bar-blue" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: {{round($percentage)}}%;">
                            </div>
                        </div>
                        <a href="{{ route('online-course.learn', ['id' => $course->id, 'detail_id' => $course->sections[0]->sectionContents[0]->id]) }}" id="detail-button" class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Lanjutkan</a>
                    </div>
                </div> 
            </div>
        </div>
        @endif
        @endforeach
        <!--
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
        -->
    </div>
    <!-- End of Pelatihan Aktif Content -->

    <!-- Pelatihan Selesai Content -->
    <div style="padding:0px;display:none;" class="user-content wow fadeInLeft" id="pelatihan-selesai">
        @php
        $flag = FALSE;
        foreach(auth()->user()->courses as $course)
        {
            if($course->pivot->status == 'completed')
                $flag = TRUE;
        }
        @endphp
        @if(!$flag)
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Pelatihan selesai belum tersedia.</span></p>
            </div>
        @endif
        @foreach(auth()->user()->courses as $course)
        @if($course->pivot->status == 'completed')
            @if($course->course_type_id ==1)
            <div class="col-12 p-0">
                <div class="@if($course->course_type_id == 1) blue-bordered-card @else red-bordered-card @endif" style="margin-top:2.5vw;display:flex;cursor:pointer" onclick="window.open('/online-course/{{$course->id}}/learn/lecture/{{ $course->sections[0]->sectionContents[0]->id }}','_self');">
                    <div class="container-image-card">
                        <img src="/assets/images/client/our-programs-card-dummy.png" style="width:13vw" class="img-fluid" alt="">
                        <div class="top-left card-tag small-text" > @if($course->course_type_id == 1) Online Course @else Woki @endif</div>
                    </div>           
                    <div style="display:flex;justify-content:space-between">
                        <div class="right-section" style="width:37vw">
                            <div>
                                <p class="bigger-text" id="card-title" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">{{$course->title}}</p>
                                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px;margin-top:0.5vw">By 
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
                                <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{$course->courseCategory->category}}</a>

                            </div>
                        </div>
                        <div style=" display: flex;flex-direction: column;justify-content: center;align-items: center;padding:1.4vw 2vw;" >
                            <i class="fas fa-check-circle big-heading"></i>
                            <form action="{{route('print_certificate')}}" method="post">
                            @csrf
                            <input type="hidden" name="name" value="{{auth()->user()->name}}">
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <button id="detail-button" class="small-text text-nowrap" style="font-family: Rubik Regular;margin-bottom:0px;cursor:pointer;margin-top:2vw">Cek Sertifikat</button>

                            </form>
                        </div>
                    </div> 
                </div>
            </div>
            @else
            <div class="col-12 p-0">
                <div class="red-bordered-card" style="margin-top:2.5vw;display:flex">
                    <div class="container-image-card">
                        <img src="/assets/images/client/our-programs-card-dummy.png" style="width:13vw" class="img-fluid" alt="">
                        <div class="top-left card-tag small-text" >Workshop</div>
                    </div>           
                    <div style="display:flex;justify-content:space-between">
                        <div class="right-section" style="width:36.8vw">
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
            @endif
        @endif
        @endforeach
        

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
@endsection