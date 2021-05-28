@extends('./layouts/client-main')
@section('title', 'Venidici Online Course Detail')

@section('content')


<div class="row m-0 page-container online-course-detail-bg" style="padding-top:11vw;padding-bottom:10vw">
    <!-- START OF LEFT SECTION -->
    <div class="col-9" >
        <div style="padding-right:10vw">
            <p class="medium-heading" style="font-family:Hypebeast;color:#67BBA3">ONLINE COURSE</p>

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">{{$course->title}}</p>
            
            <p class="bigger-text" style="font-family:Rubik Regular;color:#B3B5C2;white-space:pre-line;margin-top:0.4vw">{{$course->subtitle}}</p>
            <a class="small-text" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">{{$course->courseCategory->category}}</a>
            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-top:2vw">Sebuah kelas oleh 
            
            @foreach($course->teachers as $teacher)
            <span style="font-family:Rubik Bold">
                @if($loop->last)
                dan
                @elseif(!$loop->first)
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

            <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-top:2vw;margin-bottom:0px"><i class="fas fa-user-graduate"></i> <span style="margin-left:1vw">150 Pelajar</span></p>
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
            <!-- WHAT YOU WILL LEARN SECTION -->
            <div style="background: rgba(103, 187, 163, 0.1);border-radius: 10px;padding:1.5vw;margin-top:2vw">
                <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Apa saja yang akan dipelajari</p>
                <div class="row m-0" style="padding-top:2vw">
                    @foreach($course->courseFeatures as $features)

                    <div class="col-6" style="@if($loop->iteration > 2) margin-top:1vw @endif">
                        <div style="display:flex;align-items:baseline">
                            <i style="color:#67BBA3" class="fas fa-check-circle normal-text"></i>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-left:0.5vw;margin-bottom:0px">{{$features->feature}}</p>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <!-- END OF WHAT YOU WILL LEARN SECTION -->
        </div>
        <!-- START OF PERSYARATAN SECTION -->
        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:4vw">Persyaratan</p>
        
        <div style="display:flex;align-items:center;flex-wrap:wrap;padding-top:1vw">   
            @foreach($course->courseRequirements as $req)
            <a class="green-tag normal-text" style="margin-top:1vw;@if($loop->iteration != 1) margin-left:1vw @endif">{{$req->requirement}}</a>
            @endforeach
        </div>
        <!-- END OF PERSYARATAN SECTION -->

        <!-- START OF PROFIL PEMBICARA SECTION -->
        <!--
        <div style="display:flex;align-items:center;margin-top:3vw">
            <p class="sub-description profil-text-green profil-text-green-active profil-links"  onclick="changeContent(event, 'tentang-course')" style="font-family:Rubik Medium;margin-bottom:0px;cursor:pointer">Tetang <span style="font-family:Hypebeast;color:#67BBA3">ONLINE COURSE</span> ini</p>
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
        <p class="sub-description profil-text-green profil-text-green-active profil-links" style="font-family:Rubik Medium;margin-bottom:0px;margin-top:4vw">Tetang <span style="font-family:Hypebeast;color:#67BBA3">ONLINE COURSE</span> ini</p>
        <div  class="bigger-text profil-content" id="tentang-course"  style="margin-top:1vw">
            <p class="normal-text" style="font-family:Rubik Regular;color:#000000;white-space:pre-line">
                {{$course->description}}
            </p>
        </div>
        <!-- END OF TENTANG ONLINE COURSE -->
        @if(Auth::check())
        <!-- START OF REVIEW SECTION -->
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
                <button type="submit" class="normal-text btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.35vw 2vw">Kirim</button>
            </div>
        </div>
        </form>
        @endif


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
            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-top:1vw">{{$review->description}}</p>
    
            <hr style="background:#B3B5C2;height:0.2vw;border-radius:10px;margin-top:2vw">
    
            <!-- END OF USER REVIEWS -->
            @endforeach

        </div>
        <div style="background-color:#2B6CAA;height:2vw;text-align:center;border-radius:5px;margin-top:1vw">
        <i class="fas fa-sort-down sub-description" style="color:#FFFFFF"></i>
        </div>
        
        
        
        
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
        @endif
        <div class="course-detail-card-green">
            @if($course->price == 0)
            <p class="small-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">FREE</p>
            @else
            <p class="small-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">Rp{{ number_format($course->price, 0, ',', ',') }}</p>
            @endif
            <?php $flag = null;?>
            @if(Auth::check())
            @foreach($transactions as $transaction)
                @if($transaction->invoice->status == 'paid' || $transaction->invoice->status == 'completed')
                @foreach($transaction->invoice->orders as $order)
                    @if($order->course->id == $course->id)
                        <?php $flag = true;?>
                    @endif
                @endforeach
                @endif
            @endforeach
            @endif
            @if($flag == true)

            <button onclick="window.open('/online-course/{{$course->id}}/learn/lecture/1','_self');" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;margin-top:1.5vw">Mulai Belajar</button>
            @else
            <form action="{{ route('customer.cart.store') }}" method="post">
            @csrf
                <input type="hidden" name="course_id" value="{{$course->id}}">
                @if(Auth::check())
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" >
                @endif
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="price" value="{{$course->price}}">
                <input type="hidden" name="weight" value="0">                
                <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;margin-top:1.5vw">Tambah ke Keranjang</button>
            </form>
            @endif
            @if(!$flag)
            <button class="normal-text  btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;margin-top:1.5vw">Beli Sekarang</button>
            @endif
            <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1.5vw">Kamu akan dapat:</p>
            <div style="padding-bottom:2vw;border-bottom:4px solid #2B6CAA">
                <p class="normal-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">@if($course->total_duration == null) - @else {{$course->total_duration}} @endif Menit video eksklusif</span></p>
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