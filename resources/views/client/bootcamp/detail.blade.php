@extends('./layouts/client-main')
@section('title', 'Venidici Bootcamp Detail')

@section('content')

<!-- START OF POPUP PAYMENT-->
<div id="payment" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:70% !important">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            <form action="{{route('customer.cart.storeOrder')}}" method="POST" enctype="multipart/form-data">
            @csrf
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
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Pendaftaran</p>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#DAD9E2;margin-bottom:0px">Bootcamp: {{$course->title}}</p>
                </div>
                <div class="col-6" style="">
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Full Name</p>
                    <div  class="auth-input-form" style="display: flex;align-items:center">
                        <i style="color:#DAD9E2" class="fas fa-user"></i>
                        <input type="text" name="name" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                            placeholder="John Doe" @if(Auth::check())value="{{ old('name', Auth::user()->name) }}"@endif>
                    </div>  
                    @error('name')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Phone Number</p>
                    <div  class="auth-input-form" style="display: flex;align-items:center">
                        <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                        <input type="text" name="phone" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                            placeholder="Insert phone number" @if(Auth::check()) value="{{ old('phone', Auth::user()->userDetail->telephone) }}" @endif>
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
                    <div  class="auth-input-form" style="display: flex;align-items:center">
                        <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                        <input type="text" name="email" @if(Auth::check()) value="{{ old('email', Auth::user()->email) }}" @endif class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                            placeholder="Insert email">
                    </div>  
                    @error('email')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if ($course->price != 0)
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Bank and Account Number</p>
                    <div style="display: flex;align-items:center">
                        <div  class="auth-input-form" style="display: flex;align-items:center;width:40%">
                            <i style="color:#DAD9E2" class="fas fa-money-check-alt"></i>
                            <select name="bankShortCode" class="small-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;margin-left:0.5vw">
                                <option value="None" disabled selected>Pilih Bank</option>
                                <option value="bca">BCA</option>
                                <option value="bri">BRI</option>
                                <option value="mandiri">Mandiri</option>
                            </select>                    
                        </div>  
                        <div  class="auth-input-form" style="display: flex;align-items:center;margin-left:1vw;width:60%">
                            <input type="text" name="bank_account_number" class="normal-text" style="background:transparent;border:none;color: #3B3C43;width:100%"
                                placeholder="Bank Account Number">
                        </div>
                    </div>
                    <div style="display: flex;align-items:center">
                         
                        @error('bankShortCode')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('bank_account_number')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    @endif
                </div>
                <!-- END OF RIGHT SECTION -->
                <div class="col-12">

                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1.5vw">Address</p>
                <div  class="auth-input-form" style="display: flex;align-items:center">
                    <i style="color:#DAD9E2" class="fas fa-map-marker-alt"></i>
                    <textarea type="text" name="address" class="normal-text" style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%"
                        placeholder="Insert address">@if(Auth::check()) {{ old('address', Auth::user()->userDetail->address) }} @endif</textarea>
                </div>
                @error('address')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    
                </div>
                <div class="col-12" style="text-align:center;padding-top:3vw">
                    <input type="hidden" name="grand_total" value="{{$course->price}}">
                    <input type="hidden" name="total_order_price" value="{{$course->price}}">
                    <?php
                        $tomorrow_split = explode(' ', $tomorrow);
                        $date = $tomorrow_split[0];
                        $time = $tomorrow_split[1];
                    ?>
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="time" value="{{ $time }}">
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
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
                    <input type="hidden" value="{{$discount_club_price}}" name="club_discount">
                    <input type="hidden" name="discounted_price" value="0">
                    <input type="hidden" name="promo_code" value="0">
                    <button type="submit" onclick="openLoading()" name="action" value="createPaymentObjectBootcamp" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Lanjut ke Pembayaran</button>
                </div>  

            </div>                
            </form>
        </div>
    </div>
</div>
<!-- END OF POPUP PAYMENT-->

<div class="row m-0 page-container bootcamp-detail-bg" style="padding-top:11vw;padding-bottom:10vw">
    <!-- START OF LEFT SECTION -->
    <div class="col-9" >
        <div style="padding-right:10vw">
        <p>{{$discount_club_price}}</p>

            <p class="medium-heading" style="font-family:Hypebeast;color:#2B6CAA">Bootcamp </p>

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">{{$course->title}}</p>
            
            <p class="bigger-text" style="font-family:Rubik Regular;color:#B3B5C2;white-space:pre-line;margin-top:0.4vw">{{$course->subtitle}}</p>
            <!-- <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;"></a> -->
            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-top:2vw">Sebuah kelas oleh
            @foreach($course->teachers as $teacher)
            <span style="font-family:Rubik Bold">
                @if ($loop->last && count($course->teachers) != 1)
                dan
                @elseif (!$loop->first)
                ,
                @endif
                {{$teacher->name}}
            </span>
            @endforeach
            </p>
            <!--<video style="width:42vw;height:20vw;display:block;object-fit: cover;margin-top:2vw;border-radius:10px"  controls="false" >
                <source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
                <source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
                Your browser does not support HTML video.
            </video> -->
            <div style="margin-top:2vw">
                <iframe style="width:42vw;height:25vw;display:block;object-fit: cover;margin-top:2vw;border-radius:10px" 
                    src="{{$course->preview_video}}">
                </iframe>
            </div>
            @if(count($schedules) != 0)
            <p class="bigger-text" style="font-family:Rubik Medium;margin-top:2vw;color:#3B3C43;;margin-bottom:0px"><i class="fas fa-calendar-week"></i> <span style="margin-left:1vw">{{date_format($schedules[0][0]->date_time,"D, d M Y")}}</span></p>
            @endif
            <div style="display:flex;align-items:center;margin-top:0.5vw">
                <p class="sub-description" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">{{ $course->average_rating }}/5</p>
                <div style="display: flex;justify-content:center;margin-left:1vw">
                    @for ($i = 1; $i < 6; $i++)
                        @if ($i <= $course->average_rating)
                            @if ($i == 1)
                                <i style="color:#F4C257" class="fas fa-star sub-description"></i>
                            @else
                                <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star sub-description"></i>
                            @endif
                        @else
                            @if ($i == 1)
                                <i style="color:#B3B5C2" class="fas fa-star sub-description"></i>
                            @else
                                <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star sub-description"></i>
                            @endif
                        @endif
                    @endfor
                </div>
            </div>
            @if(count($schedules) != 0)
            <!-- WHAT YOU WILL LEARN SECTION -->
            <div style="background: #EBF5FF;border-radius: 10px;padding:1.5vw;margin-top:2vw">
                
                
                <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($schedules as $schedule)
                        <div class="carousel-item @if($loop->first) active @endif" >
                            <div style="text-align:center;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-arrow-left" class="carousel-control-prev" data-bs-target="#feature-carousel" role="button" data-bs-slide="prev" style="font-size:1.5vw;color:rgba(43, 108, 170, 0.5);margin-right:1vw"></i>
                                <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">{{date_format($schedule[0]->date_time,"D, d M Y")}}</p>
                                <i class="fas fa-arrow-right" class="carousel-control-next" data-bs-target="#feature-carousel" role="button" data-bs-slide="next" style="font-size:1.5vw;color:rgba(43, 108, 170, 0.5);margin-left:1vw"></i>
                            </div>
                            
                            <div class="row m-0" style="padding-top:2vw">
                                @foreach($schedule as $day)
                                <!-- START OF ONE SCHEDULE -->
                                <div style="display: flex;">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px">{{date_format($day->date_time,"H:i")}}</p>
                                    <div>
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-left:1vw">{{$day->title}}</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px;margin-left:1vw">Details: {{$day->detail}}</p>
                                    </div>
                                </div>
                                <hr style="background:#B3B5C2;height:0.1vw;border-radius:10px;margin-top:1vw">
                                <!-- END OF ONE SCHEDULE -->
                                @endforeach


                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    
                    
                </div>  
            </div>
            <!-- END OF WHAT YOU WILL LEARN SECTION -->
            @endif
        </div>
        <!-- START OF PERSYARATAN SECTION -->
        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:4vw">Persyaratan</p>
        
        <div style="display:flex;align-items:center;flex-wrap:wrap;padding-top:1vw">  
            @foreach($course->courseRequirements as $req)
 
            <a class="blue-tag normal-text" style="margin-top:1vw;@if($loop->iteration != 1) margin-left:1vw @endif">{{$req->requirement}}</a>
            @endforeach
        </div>
        <!-- END OF PERSYARATAN SECTION -->

        <!-- START OF PROFIL PEMBICARA SECTION -->
        <!--
        <div style="display:flex;align-items:center;margin-top:3vw">
            <p class="sub-description profil-text-green profil-text-green-active profil-links"  onclick="changeContent(event, 'tentang-course')" style="font-family:Rubik Medium;margin-bottom:0px;cursor:pointer">Tetang <span style="font-family:Hypebeast;color:#2B6CAA">ONLINE COURSE</span> ini</p>
            <p class="sub-description profil-text-green profil-links" onclick="changeContent(event, 'profil-pembicara')" style="font-family:Rubik Medium;margin-bottom:0px;cursor:pointer;margin-left:3vw">Profil Pembicara </p>

        </div>
        -->
        <!-- START OF PROFIL PEMBICARA SECTION -->
        <p class="sub-description" style="font-family:Rubik Medium;margin-bottom:0px;margin-top:4vw;color:#3B3C43">Profil Pembicara</p>

        @foreach($course->teachers as $teacher)

        <!-- START OF ONE LECTURE -->
        <div style="display:flex;margin-top:2vw;align-items:flex-start">
            <img src="{{ asset($teacher->image) }}" style="width:5vw;height:5vw;object-fit:cover;filter: drop-shadow(0px 10px 20px rgba(31, 32, 65, 0.1));border-radius:10px;border:2px solid #F2F2F2" class="img-fluid" alt="">
            <div style="margin-left:1vw">
                <p class="bigger-text" style="font-family:Rubik Medium;color:#55525B">{{$teacher->name}}</p>
                <p class="normal-text" style="font-family:Rubik Regular;color:#000000">{{$teacher->description}}</p>
            </div>

        </div>
        <!-- END OF ONE LECTURE -->
        @endforeach

        <!-- END OF PROFIL PEMBICARA SECTION -->
        <!-- START OF TENTANG ONLINE COURSE -->
        <p class="sub-description profil-text-blue profil-text-blue-active profil-links" style="font-family:Rubik Medium;margin-bottom:0px;margin-top:4vw">Tetang <span style="font-family:Hypebeast;color:#2B6CAA">BOOTCAMP</span> ini</p>
        <div  class="bigger-text profil-content" id="tentang-course"  style="margin-top:1vw">
            <p class="normal-text" style="font-family:Rubik Regular;color:#000000;white-space:pre-line">
                {{$course->description}}
            </p>
        </div>
        <!-- END OF TENTANG ONLINE COURSE -->

        <!-- START OF REVIEW SECTION -->
        @if(Auth::check())
            @if(session('review_message'))
                <!-- ALERT MESSAGE -->
                <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                    {{ session('review_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
            @endif
            <form action="{{ route('customer.review.store') }}" id="review-section" method="POST">
            @csrf
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:4vw">
                    <p class="sub-description" style="font-family:Rubik Medium;margin-bottom:0px">Ulasan dari pelajar</p>
                    <p onclick="openReview()" id="add-review-button" class="normal-text btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">Tambah Ulasan</p>                
                </div>
                <div style="display:none" id="review-area">
                    <div class="rate" style="margin-top:1vw" >
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                    @error('rating')
                        <br>
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <textarea class="normal-text" name="description" placeholder="Masukan review anda disini" id="" style="width:100%;background: #FFFFFF;border: 2px solid #C4C4C4;box-sizing: border-box;border-radius: 5px;margin-top:1vw;padding:0.5vw" rows="4"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    
                    <div style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <p onclick="closeReview()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.2vw 2vw;margin-right:1vw">Cancel</p>
                        <button type="submit" onclick="openLoading()" name="action" value="course_detail_review" class="normal-text btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.35vw 2vw">Kirim</button>
                    </div>
                </div>
            </form>
        @endif

        @if(count($reviews) == 0)
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Belum ada review.</span></p>
            </div>
        @else
        <div style="overflow:scroll;height:30vw;margin-top:3vw">
            <hr style="background:#B3B5C2;height:0.2vw;border-radius:10px;">
            @foreach($reviews as $review)
            <!-- START OF USER REVIEWS -->
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-top:2vw">
                <div style="display:flex">
                    
                    <img @if($review->user->avatar == null) src="/assets/images/client/Default_Display_Picture.png" @else src="{{ asset(Auth::user()->avatar) }}"  @endif  style="width:4vw;height:4vw;object-fit:cover;border-radius:50%" class="img-fluid" alt="">
                    <div style="margin-left:1vw">
                        <p class="normal-text" style="font-family:Rubik Medium;margin-bottom:0px">{{$review->user->name}}</p>
                        <div style="display: flex;justify-content:flex-start;align-items:center;margin-top:0.5vw">
                            @for ($i = 1; $i < 6; $i++)
                                @if($i <= $review->review)
                                    <i style="color:#F4C257;@if($i != 1) margin-left:0.5vw @endif" class="fas fa-star sub-description"></i>
                                @else
                                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star sub-description"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="small-text" style="font-family:Rubik Regular;color:#C4C4C4;">{{$review->created_at->diffForHumans()}}</p>
            </div>
            <div style="display: flex;justify-content:space-between;padding-right:1vw">
                <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-top:1vw;padding-right:1vw">{{$review->description}}</p>
                @if(Auth::check())
                    @if($review->user_id == auth()->user()->id)
                    <form action="{{route('customer.review.destroy', $review->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" style="background:none;border:none"><i class="fas fa-trash bigger-text" style="color:#CE3369"></i></button>
                    </form>
                    @endif
                @endif
            </div>
    
            <hr style="background:#B3B5C2;height:0.2vw;border-radius:10px;margin-top:2vw">
    
            <!-- END OF USER REVIEWS -->
            @endforeach

        </div>
        <div style="background-color:#2B6CAA;height:2vw;text-align:center;border-radius:5px;margin-top:1vw">
        <i class="fas fa-sort-down sub-description" style="color:#FFFFFF"></i>
        </div>
    @endif
    <!-- END OF REVIEW SECTION -->
        
    </div>
    <!-- END OF LEFT SECTION -->

    <!-- START OF RIGHT SECTION -->
    <div class="col-3 p-0" >
        @if(session('success') || session('message'))
            <!-- ALERT MESSAGE -->
            <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!-- END OF ALERT MESSAGE -->
        @elseif(session('message_update')) 
            <!-- ALERT MESSAGE -->
            <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                {{ session('message_update') }} <span> <a href="/dashboard#edit-profile">Click here</a> </span>to complete your profile
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!-- END OF ALERT MESSAGE -->
        @endif

        <div class="course-detail-card-green">
            @if(count($schedules) != 0)
            @php
                $customformat = date_format($schedules[0][0]->date_time,"M d,Y H:i:s");
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
							document.getElementById('countdown-card').style.display = "none";
							return;
						}
						var days = Math.floor(distance / _day);
						var hours = Math.floor((distance % _day) / _hour);
						var minutes = Math.floor((distance % _hour) / _minute);
						var seconds = Math.floor((distance % _minute) / _second);

						document.getElementById('days').innerHTML = days;
						document.getElementById('hours').innerHTML = hours ;
						document.getElementById('minutes').innerHTML = minutes ;
					}
					timer = setInterval(showRemaining, 1000);
				}
            </script>
            @endif
            @if($course->price == 0)
            <p class="small-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">FREE</p>
            @else
            <p class="small-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
            @endif            

            <a href="#payment" class="normal-text btn-blue-bordered d-block"  style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;text-align:center;margin-top:1.5vw;">Register Now</a>                
            <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1.5vw">Kamu akan dapat:</p>
            <div style="padding-bottom:2vw;border-bottom:4px solid #2B6CAA">
                <p class="normal-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">109 Menit video eksklusif</span></p>
                <p class="normal-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">1 Assesment</span></p>
                <p class="normal-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">Akses seumur hidup</span></p>
                <p class="normal-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">Sertifikat keberhasilan</span></p>
            </div>
            <p class="small-text" style="font-family:Rubik Medium;color: #3B3C43;margin-bottom:2vw;margin-top:2vw;">Butuh pelatihan untuk perusahaan Anda?</p>
            <div style="text-align:center">
                <a href="/for-corporate/krest" class="small-text btn-purple-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:1vw">Program Krest</a>
            </div>

        </div>
        @if(count($schedules) != 0)

        <!-- START COUNT DOWN CARD -->
        <div class="course-detail-card-green" id="countdown-card" style="margin-top:2vw">
            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Countdown Registration:</p>
            <div style="border:2px solid #2B6CAA;padding:1vw;display:flex;align-items:center;justify-content:space-between;border-radius:10px;margin-top:1vw">
                <div style="text-align:center">
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Days</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px" id="days"></p>
                </div>
                <div style="text-align:center">
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Hours</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px" id="hours"></p>
                </div>
                <div style="text-align:center">
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Minutes</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px" id="minutes"></p>
                </div>
            </div>
        </div>
        <!-- END OF COUNT DOWN CARD -->
        @endif

        <div style="padding:2vw;background:#FFFFFF">
            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1.5vw">Ada <span style="font-family:Hypebeast">Pertanyaan?</span> </p>
            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px;margin-top:1vw;margin-bottom:2vw">Langsung hubungi kami melalui:</p>
            <a  href="https://api.whatsapp.com/send?phone=+62818180509&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." target="_blank" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;"><i class="fab fa-whatsapp"></i> <span style="margin-left:0.5vw">+628112345678</span></a>

        </div>
    </div>
    <!-- END OF RIGHT SECTION -->
    @if(Auth::check())
    <!-- START OF RECOMMENDED SECTION -->
    <div class="col-12" style="margin-top:8vw">
        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;">Pilihan kelas lainnya untuk kamu</p>
        <!-- ONLINE COURSE -->
        <div class="course-content" id="course-online" style="margin-top:2vw">
                <div class="row m-0 p-0">
                    @foreach($courseSuggestions as $course)
                    <div class="col-4 p-0" >
                        <div style="display: flex;@if($loop->iteration % 3 == 1) justify-content:flex-start @elseif ($loop->iteration % 3 == 2)justify-content:center @elseif ($loop->iteration % 3 == 0) justify-content:flex-end @endif">
                            <!-- START OF ONE GREEN COURSE CARD -->
                            <div class="course-card-blue">
                                <div class="container">
                                    <img src="{{ asset($course->thumbnail) }}" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                                    <div class="top-left card-tag small-text">Bootcamp</div>
                                    <div class="bottom-left" id="course-card-description" style="opacity:0;bottom:0;text-align:left;">
                                        <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: #FFFFFF;">{{ $course->description }}</p>
                                    </div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="height:4.5vw">
                                        <div style="display:flex;justify-content:space-between;margin-bottom:0.5vw">
                                            <a href="/online-course/{{$course->id}}" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;text-decoration:none">{{ $course->title }}</a>
                                            <!-- <i style="font-size:2vw;padding-left:0.5vw" role="button"  aria-controls="course-collapse-{{ $course->id }}" data-toggle="collapse" href="#course-collapse-{{ $course->id }}" class="fas fa-caret-down"></i> -->
                                        </div>
                                        @foreach ($course->hashtags as $tag)
                                            <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{ $tag->hashtag }}</a>
                                        @endforeach
                                    </div>
                                    <div class="collapse" id="course-collapse-{{ $course->id }}" style="margin-top:0.5vw">
                                        <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);">{{ $course->description }}</p>
                                    </div>

                                    <div style="display: flex;justify-content:space-between;margin-top:1vw" >
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
                </div>
            </div>
            <!-- END OF ONLINE COURSE -->
    </div>
    <!-- END OF RECOMMENDED SECTION -->
    @endif
</div>
<!-- END OF BANNER SECTION -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function changeContent(evt, categoryName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("profil-content")
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("profil-links");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("profil-text-green-active", "profil-text-green");
        }
        document.getElementById(categoryName).style.display = "block";
        evt.currentTarget.className += " profil-text-green-active";
    }
         
</script>
<script>
    function openReview() {
        document.getElementById('review-area').style.display = "block";
        document.getElementById('add-review-button').style.display = "none";
    }
    function closeReview() {
        document.getElementById('review-area').style.display = "none";
        document.getElementById('add-review-button').style.display = "block";
    }
         
</script>

@endsection