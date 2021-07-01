@extends('./layouts/client-main')
@section('title', 'Venidici Bootcamp Detail')

@section('content')

<div class="row m-0 page-container bootcamp-detail-bg" style="padding-top:11vw;padding-bottom:10vw">
    <!-- START OF LEFT SECTION -->
    <div class="col-9" >
        <div style="padding-right:10vw">
            <p class="medium-heading" style="font-family:Hypebeast;color:#2B6CAA">Bootcamp</p>

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Sertifikat menjadi Seniman</p>
            
            <p class="bigger-text" style="font-family:Rubik Regular;color:#B3B5C2;white-space:pre-line;margin-top:0.4vw">Need to be funny fast? This is the course for people that find it hard to be funny.</p>
            <!-- <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;"></a> -->
            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-top:2vw">Sebuah kelas oleh Mr. Raditya Dika
            </p>
            <!--<video style="width:42vw;height:20vw;display:block;object-fit: cover;margin-top:2vw;border-radius:10px"  controls="false" >
                <source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
                <source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
                Your browser does not support HTML video.
            </video> -->
            <div style="margin-top:2vw">
                <iframe style="width:42vw;height:25vw;display:block;object-fit: cover;margin-top:2vw;border-radius:10px" 
                    src="https://www.youtube.com/embed/dEEUWdh-6ek">
                </iframe>
            </div>

            <p class="bigger-text" style="font-family:Rubik Medium;margin-top:2vw;color:#3B3C43;;margin-bottom:0px"><i class="fas fa-calendar-week"></i> <span style="margin-left:1vw">Saturday, 10 November 2020</span></p>
            <div style="display:flex;align-items:center;margin-top:0.5vw">
                <p class="sub-description" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                <div style="display: flex;justify-content:center;margin-left:1vw">
                    <i style="color:#B3B5C2" class="fas fa-star sub-description"></i>
                    <i style="color:#B3B5C2" class="fas fa-star sub-description"></i>
                    <i style="color:#B3B5C2" class="fas fa-star sub-description"></i>
                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star sub-description"></i>
                </div>
            </div>
            
            <!-- WHAT YOU WILL LEARN SECTION -->
            <div style="background: #EBF5FF;border-radius: 10px;padding:1.5vw;margin-top:2vw">
                
                
                <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                    <div class="carousel-inner">
                        
                        <div class="carousel-item active" >
                            <div style="text-align:center;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-arrow-left" class="carousel-control-prev" data-bs-target="#feature-carousel" role="button" data-bs-slide="prev" style="font-size:1.5vw;color:rgba(43, 108, 170, 0.5);margin-right:1vw"></i>
                                <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Saturday, 10 November 2020</p>
                                <i class="fas fa-arrow-right" class="carousel-control-next" data-bs-target="#feature-carousel" role="button" data-bs-slide="next" style="font-size:1.5vw;color:rgba(43, 108, 170, 0.5);margin-left:1vw"></i>
                            </div>
                            <div class="row m-0" style="padding-top:2vw">
                                <!-- START OF ONE SCHEDULE -->
                                <div style="display: flex;">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px">10.00</p>
                                    <div>
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-left:1vw">Chemistry</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px;margin-left:1vw">Details: Learn to get chemistry between each other personality</p>
                                    </div>
                            </div>
                            <hr style="background:#B3B5C2;height:0.1vw;border-radius:10px;margin-top:1vw">
                            <!-- END OF ONE SCHEDULE -->
                                <!-- START OF ONE SCHEDULE -->
                                <div style="display: flex;">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px">10.00</p>
                                    <div>
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-left:1vw">Chemistry</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px;margin-left:1vw">Details: Learn to get chemistry between each other personality</p>
                                    </div>
                            </div>
                            <hr style="background:#B3B5C2;height:0.1vw;border-radius:10px;margin-top:1vw">
                            <!-- END OF ONE SCHEDULE -->


                            </div>
                        </div>
                        <div class="carousel-item" >
                            <div style="text-align:center;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-arrow-left" class="carousel-control-prev" data-bs-target="#feature-carousel" role="button" data-bs-slide="prev" style="font-size:1.5vw;color:rgba(43, 108, 170, 0.5);margin-right:1vw"></i>
                                <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Saturday, 10 November 2020</p>
                                <i class="fas fa-arrow-right" class="carousel-control-next" data-bs-target="#feature-carousel" role="button" data-bs-slide="next" style="font-size:1.5vw;color:rgba(43, 108, 170, 0.5);margin-left:1vw"></i>
                            </div>
                            <div class="row m-0" style="padding-top:2vw">
                                <!-- START OF ONE SCHEDULE -->
                                <div style="display: flex;">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px">10.00</p>
                                    <div>
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-left:1vw">Chemistry</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px;margin-left:1vw">Details: Learn to get chemistry between each other personality</p>
                                    </div>
                            </div>
                            <hr style="background:#B3B5C2;height:0.1vw;border-radius:10px;margin-top:1vw">
                            <!-- END OF ONE SCHEDULE -->
                                <!-- START OF ONE SCHEDULE -->
                                <div style="display: flex;">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px">10.00</p>
                                    <div>
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-left:1vw">Chemistry</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#ABACB0;margin-bottom:0px;margin-left:1vw">Details: Learn to get chemistry between each other personality</p>
                                    </div>
                            </div>
                            <hr style="background:#B3B5C2;height:0.1vw;border-radius:10px;margin-top:1vw">
                            <!-- END OF ONE SCHEDULE -->


                            </div>
                        </div>
                        
                    </div>
                    
                    
                </div>  
            </div>
            <!-- END OF WHAT YOU WILL LEARN SECTION -->
        </div>
        <!-- START OF PERSYARATAN SECTION -->
        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:4vw">Persyaratan</p>
        
        <div style="display:flex;align-items:center;flex-wrap:wrap;padding-top:1vw">   
            <a class="blue-tag normal-text" style="margin-top:1vw;">Muka lucu dan unik</a>
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

            <!-- START OF ONE LECTURE -->
            <div style="display:flex;margin-top:2vw;align-items:flex-start">
                <img src="/assets/images/client/Default_Display_Picture.png" style="width:5vw;height:5vw;object-fit:cover;filter: drop-shadow(0px 10px 20px rgba(31, 32, 65, 0.1));border-radius:10px;border:2px solid #F2F2F2" class="img-fluid" alt="">
                <div style="margin-left:1vw">
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#55525B">Mr. Raditya Dika</p>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#000000">Berpengalaman sebagai Consumer Insight Lead di LinkAja, REA Group Asia, Garudafood, dan menjadi Head of Research And Development di IdEA. Kak Irfan juga sering diundang oleh TV besar di indonesia sebagai Consumer Behavior Expert dan saat ini juga menjadi Co-Owner dari Waroeng Ondel Ondel Betawi di Leiden, Netherlands.</p>
                </div>

            </div>
            <!-- END OF ONE LECTURE -->

        <!-- END OF PROFIL PEMBICARA SECTION -->
        <!-- START OF TENTANG ONLINE COURSE -->
        <p class="sub-description profil-text-blue profil-text-blue-active profil-links" style="font-family:Rubik Medium;margin-bottom:0px;margin-top:4vw">Tetang <span style="font-family:Hypebeast;color:#2B6CAA">BOOTCAMP</span> ini</p>
        <div  class="bigger-text profil-content" id="tentang-course"  style="margin-top:1vw">
            <p class="normal-text" style="font-family:Rubik Regular;color:#000000;white-space:pre-line">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet tortor gravida ut nam. Sapien duis feugiat feugiat nunc. Nunc cras dolor risus magnis facilisis elementum pharetra. Nunc dolor lacus, accumsan, vestibulum, faucibus libero, vulputate vitae, mauris.
Lectus pretium platea hendrerit dignissim blandit nunc tortor. Nisi, adipiscing pharetra sit faucibus justo, faucibus gravida. Fringilla ipsum, commodo, sem arcu. Netus aliquet sit malesuada vel velit in rhoncus, ac pellentesque. Facilisis tortor senectus facilisis sit. Posuere quis massa purus, molestie convallis viverra ligula euismod sapien. Sollicitudin euismod molestie adipiscing mauris
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

                    <input type="hidden" name="course_id" value="1">
                    
                    <div style="display:flex;justify-content:flex-end;align-items:center;margin-top:1vw">
                        <p onclick="closeReview()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.2vw 2vw;margin-right:1vw">Cancel</p>
                        <button type="submit" name="action" value="course_detail_review" class="normal-text btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.35vw 2vw">Kirim</button>
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
                    
                    <img @if($review->user->avatar == null) src="/assets/images/client/Default_Display_Picture.png" @else src=""  @endif  style="width:4vw;height:4vw;object-fit:cover;border-radius:50%" class="img-fluid" alt="">
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
        
    </div>
    <!-- END OF REVIEW SECTION -->
    <!-- END OF LEFT SECTION -->

    <!-- START OF RIGHT SECTION -->
    <div class="col-3 p-0" >
        @if(session('success'))
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
            <p class="small-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">FREE</p>
            


            <a  class="normal-text btn-blue-bordered d-block" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;text-align:center;margin-top:1.5vw">Book Sekarang</a>

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
        <div style="padding:2vw;background:#FFFFFF">
            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1.5vw">Ada <span style="font-family:Hypebeast">Pertanyaan?</span> </p>
            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px;margin-top:1vw;margin-bottom:2vw">Langsung hubungi kami melalui:</p>
            <a  href="https://api.whatsapp.com/send?phone=+62818180509&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." target="_blank" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;"><i class="fab fa-whatsapp"></i> <span style="margin-left:0.5vw">+628112345678</span></a>

        </div>
    </div>
    <!-- END OF RIGHT SECTION -->
    <!-- START OF RECOMMENDED SECTION -->
    <div class="col-12" style="margin-top:8vw">
        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;">Pilihan kelas lainnya untuk kamu</p>
        <!-- ONLINE COURSE -->
        <div class="course-content" id="course-online" style="margin-top:2vw">
                <div class="row m-0 p-0">
                    <div class="col-4 p-0" >
                        <div style="display: flex;justify-content:flex-start">
                            <!-- START OF ONE GREEN COURSE CARD -->
                            <div class="course-card-green">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                    <div class="top-left card-tag small-text" >Online Course</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5vw">
                                        <a href="/online-course/sertifikat-menjadi-komedian-lucu" class="sub-description" style="font-family: Rubik Bold;margin-bottom:0px;color:#55525B;margin-bottom:0.5vw;text-decoration:none">How to be funny?</a>
                                        <i style="font-size:2vw;" role="button"  aria-controls="course-collapse1" data-toggle="collapse" href="#course-collapse1" class="fas fa-caret-down"></i>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                                    <div class="collapse" id="course-collapse1" style="margin-top:1vw">
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
                                        <i style="font-size:2vw;" role="button"  aria-controls="course-collapse2" data-toggle="collapse" href="#course-collapse2" class="fas fa-caret-down"></i>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development</a>
                                    <div class="collapse" id="course-collapse2" style="margin-top:1vw">
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
                    <div class="col-4 p-0" >
                        <div style="display: flex;justify-content:flex-end">
                            <!-- START OF ONE GREEN COURSE CARD -->
                            <div class="course-card-green">
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
                            <!-- END OF ONE GREEN COURSE CARD -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF ONLINE COURSE -->
    </div>
    <!-- END OF RECOMMENDED SECTION -->
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