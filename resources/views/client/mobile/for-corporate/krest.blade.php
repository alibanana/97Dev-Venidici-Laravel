@extends('./layouts/client-main')
@section('title', 'Venidici Krest')

@section('content')

<!-- Modal VA -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalTitle" aria-hidden="true">
    <!-- start of form -->
    <form action="{{ route('customer.store_krest') }}" method="POST">
    @csrf  
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Hubungi Kami</p>
                    <button type="button" class="close small-heading" data-dismiss="modal" aria-label="Close" style="background:none;border:none">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if(session('message'))
                <!-- ALERT MESSAGE -->
                <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px;margin-top:0.5vw"role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
                @endif
                <div class="modal-body">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div  class="auth-input-form" style="display: flex;align-items:center;width:48%">
                            <i style="color:#DAD9E2" class="fas fa-user"></i>
                            <input type="text" name="name" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="Full Name" >
                        </div>  
                        <div  class="auth-input-form" style="display: flex;align-items:center;width:48%">
                            <i style="color:#DAD9E2" class="fas fa-envelope"></i>
                            <input type="email" name="email" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="Email" >
                        </div>  
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        @error('name')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:1vw">
                        <div  class="auth-input-form" style="display: flex;align-items:center;width:48%">
                            <i style="color:#DAD9E2" class="fas fa-phone-alt"></i>
                            <input type="text" name="telephone" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="No. Telp" >
                        </div> 
                        <div  class="auth-input-form" style="display: flex;align-items:center;width:48%">
                            <i style="color:#DAD9E2" class="fas fa-building"></i>
                            <input type="text" name="company" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;margin-left:1vw;color: #5F5D70;width:100%" placeholder="Nama Perusahaan" >
                        </div>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:1vw">
                        
                        @error('telephone')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                        @error('company')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                    </div>
                    <div  class="auth-input-form" style="display: flex;align-items:center;margin-top:1vw">
                        <i style="color:#DAD9E2" class="fas fa-address-card"></i>
                        <select name="krest_program_id" id=""   class="normal-text"  style="background:transparent;border:none;margin-left:1vw;color: #3B3C43;width:100%">
                            <option disabled selected>Pilih Program</option>
                            @foreach($programs as $program)
                            <option value="{{$program->id}}" >{{$program->program}}</option>
                            @endforeach  
                        </select>
                    </div>  
                    @error('krest_program_id')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div  class="auth-input-form" style="display: flex;align-items:center;width:100%;margin-top:1.5vw">
                        <input type="text" name="subject" class="normal-text" style="font-family:Rubik Regular;background:transparent;border:none;color: #5F5D70;width:100%" placeholder="Subject" >
                    </div> 
                    @error('subject')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="auth-input-form" style="display: flex;align-items:center;width:100%;margin-top:1.5vw">
                        <textarea name="message" id="" rows="6" class="normal-text"   style="font-family:Rubik Regular;background:transparent;border:none;color: #5F5D70;;width:100%" placeholder="Masukkan pesan anda disini"></textarea>                
                    </div>  
                    @error('message')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-family:Poppins Medium;padding:0.5vw 2vw">Batal</button>
                    <button type="submit" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Kirim</button>                
                </div>
            </div>
        </div>
    </form>
</div>
<!-- END OF MODAL VA -->

<!-- START OF TOP SECTION -->
<div class="row page-container m-0 krest-background" style="padding-top:10vw;display:flex;align-items:center">
    <div class="col-6 p-0">
        <img src="/assets/images/client/logo-horizontal.png" style="width:20vw" class="img-fluid" alt="KREST">
        <p class="medium-heading" style="font-family: Rubik Bold;color:#686B82;margin-top:1.5vw">Turut Memaksimalkan Potensi <br> Bagi Talenta dan Perusahaan</p>
        <p class="sub-description" style="font-family: Rubik Regular;color:#686B82;margin-top:1.5vw;margin-bottom:3vw">Vendici turut membantu menggali potensi dan <br> perkembangan di masing masing individual</p>
        <a href="#programs-section" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;padding:1vw 2.5vw">Explore Krest</a>

    </div>
    <div class="col-6 p-0 wow fadeInRight" data-wow-delay="0.3s" style="text-align:center">
        <img src="/assets/images/client/Krest_Dummy.png" style="width:40vw;height:26vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
    </div>
    <div class="col-12 wow fadeInUp" data-wow-delay="0.7s" style="padding:6vw 16vw">
        <div style="display:flex;justify-content:space-between;align-items:center">
            <div style="text-align:center">
                <p class="big-heading" style="font-family: Rubik Medium;color:#B8D1EE;margin-bottom:0.5vw">5+</p>
                <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA;">Trusted Companies</p>
            </div>
            <div style="text-align:center">
                <p class="big-heading" style="font-family: Rubik Medium;color:#B8D1EE;margin-bottom:0.5vw">100+</p>
                <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA;">Trusted Companies</p>
            </div>
            <div style="text-align:center">
                <p class="big-heading" style="font-family: Rubik Medium;color:#B8D1EE;margin-bottom:0.5vw">50+</p>
                <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA;">Trusted Companies</p>
            </div>
        </div>
    </div>
</div>
<!-- END OF TOP SECTION -->

<!-- START OF OUR HISTORY -->
<div class="row m-0 page-container krest-history-background" style="padding-top:2vw;padding-bottom:2vw">
    
    <div class="col-6" style="padding-right:2vw">
        <p class="small-heading" style="font-family: Rubik Medium;color:#2B6CAA">Our History</p>
        <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">Apa itu Krest?</p>
        <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;white-space:pre-line;padding-top:1vw">Venidici memberikan berbagai macam program yang dapat diikuti oleh masyarakat luas. Mulai dari bla bla bla dan ini adalah sebuah bla bla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Erat urna commodo eget sem. 

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper in proin egestas mollis id lacinia nec. Nunc felis mi bibendum facilisi sollicitudin tempor, ultricies. Dignissim montes, risus ultrices egestas. At in suscipit nulla eget. Dictum lacus donec imperdiet malesuada.

        </p>
    </div>
    <div class="col-6 wow fadeInRight" data-wow-delay="0.3s">
        <div style="display:flex;align-items:center">
            <div>
                <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:22vw">
                    <img src="/assets/images/client/ForPublic_1.png" style="width:19vw;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                </div>
                <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:8vw;margin-top:0.5vw">
                    <img src="/assets/images/client/ForPublic_2.png" style="width:19vw;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                </div>
            </div>
            <div style="margin-left:1vw">
                <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:8vw">
                    <img src="/assets/images/client/ForPublic_3.png" style="width:13vw;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                </div>
                <div style="background: #FFFFFF;box-shadow: 0px 0px 20px rgba(157, 157, 157, 0.15);border-radius: 10px;padding:1vw;height:18vw;margin-top:0.5vw">
                    <img src="/assets/images/client/ForPublic_4.png" style="width:13vw;object-fit:cover;height:100%;border-radius: 10px" class="img-fluid" alt="Image 1">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF OUR HISTORY -->

<!-- START OF URGENCY OF SOFT SKILLS TERBUAT -->
<div class="row m-0 page-container krest-program-background" style="padding-bottom:8vw;padding-top:5vw">
    <div class="col-6" style="display: flex;flex-direction: column;justify-content: center;align-items:center">
          <img src="/assets/images/client/kenapa_online_course.png" style="width:38vw;object-fit:cover;height:25vw;border-radius: 10px" class="img-fluid" alt="Image 1">
    </div>
    <div class="col-6 wow fadeInRight" data-wow-delay="0.3s">
        <p class="medium-heading" style="font-family: Rubik Bold;color:#3B3C43">The Urgency of Soft Skills</p>
        <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;white-space:pre-line;padding-top:1vw">Venidici memberikan berbagai macam program yang dapat diikuti oleh masyarakat luas. Mulai dari bla bla bla dan ini adalah sebuah bla bla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Erat urna commodo eget sem. 

        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper in proin egestas mollis id lacinia nec. Nunc felis mi bibendum facilisi sollicitudin tempor, ultricies. Dignissim montes, risus ultrices egestas. At in suscipit nulla eget. Dictum lacus donec imperdiet malesuada.
        </p>
    </div>
    
</div>
<!-- END OF URGENCY OF SOFT SKILLS TERBUAT -->

<!-- START OF OUR PROGRAMS -->
<div class="row m-0 page-container" id="programs-section" style="padding-top:4vw;padding-bottom:4vw;background-color:#F6F6F6">
    <div style="text-align:center" class="wow flash" data-wow-delay="0.3s">
        <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA">Programs</p>
        <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">Mengakomodasi Kebutuhan Talenta <br> Perusahaan Anda Dengan Program Venidici</p>
    </div>
    <div style="display:flex;justify-content:center;align-items:center;margin-top:2vw">
        <p class="btn-blue-bordered btn-blue-active normal-text program-links" onclick="changePrograms(event, 'available-programs')" style="text-decoration: none;font-family:Rubik Regular;padding:0.2vw 2.5vw;margin-right:1vw;border:1px solid #2B6CAA;cursor:pointer">
            Available Programs
        </p>
        <p class="btn-blue-bordered  normal-text program-links"  onclick="changePrograms(event, 'on-demand-programs')" style="text-decoration: none;font-family:Rubik Regular;padding:0.2vw 2.5vw;margin-left:1vw;border:1px solid #2B6CAA;cursor:pointer">
            On Demand Programs
        </p>
    </div>
    <div style="text-align:center">
        <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;padding-top:3vw">
        Venidici memberikan berbagai macam program yang dapat diikuti oleh masyarakat luas. Mulai dari bla bla bla dan ini adalah sebuah bla bla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Erat urna commodo eget sem. 

        </p>   
    </div>
    <div class="program-content"  id="available-programs">
        <!-- START OF CAROUSEL -->
        <div id="perlengkapan-carousel" style="margin-top:2vw" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 2vw;">
                
                <div class="carousel-item active">
                    <div class="row m-0">
                        <div class="col-4" style="display:flex;justify-content:center">
                            <!-- START OF ONE KREST  CARD -->
                            <div class="course-card-blue">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                                    <div class="top-left card-tag small-text">Krest</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between">
                                        <p href="" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0.5vw;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">How to be funny?</p>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development  (Krest)</a>
                                    <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);margin-top:1vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam commodo venenatis, ac quam aliquam tortor vel. Id sit egestas mauris ullamcorper elit dis.</p>
                    
                                </div>
                            </div>
                            <!-- END OF ONE  KREST CARD -->
                        </div>
                        <div class="col-4" style="display:flex;justify-content:center">
                            <!-- START OF ONE KREST  CARD -->
                            <div class="course-card-blue">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                                    <div class="top-left card-tag small-text">Krest</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between">
                                        <p href="" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0.5vw;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">How to be funny?</p>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development  (Krest)</a>
                                    <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);margin-top:1vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam commodo venenatis, ac quam aliquam tortor vel. Id sit egestas mauris ullamcorper elit dis.</p>
                    
                                </div>
                            </div>
                            <!-- END OF ONE  KREST CARD -->
                        </div>
                        <div class="col-4" style="display:flex;justify-content:center">
                            <!-- START OF ONE KREST  CARD -->
                            <div class="course-card-blue">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                                    <div class="top-left card-tag small-text">Krest</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between">
                                        <p href="" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0.5vw;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">How to be funny?</p>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development  (Krest)</a>
                                    <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);margin-top:1vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam commodo venenatis, ac quam aliquam tortor vel. Id sit egestas mauris ullamcorper elit dis.</p>
                    
                                </div>
                            </div>
                            <!-- END OF ONE  KREST CARD -->
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row m-0">
                        <div class="col-4">
                            <!-- START OF ONE KREST  CARD -->
                            <div class="course-card-blue">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                                    <div class="top-left card-tag small-text">Krest</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between">
                                        <p href="" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0.5vw;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">How to be funny?</p>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development  (Krest)</a>
                                    <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);margin-top:1vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam commodo venenatis, ac quam aliquam tortor vel. Id sit egestas mauris ullamcorper elit dis.</p>
                    
                                </div>
                            </div>
                            <!-- END OF ONE  KREST CARD -->
                        </div>
                        <div class="col-4">
                            <!-- START OF ONE KREST  CARD -->
                            <div class="course-card-blue">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                                    <div class="top-left card-tag small-text">Krest</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between">
                                        <p href="" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0.5vw;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">How to be funny?</p>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development  (Krest)</a>
                                    <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);margin-top:1vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam commodo venenatis, ac quam aliquam tortor vel. Id sit egestas mauris ullamcorper elit dis.</p>
                    
                                </div>
                            </div>
                            <!-- END OF ONE  KREST CARD -->
                        </div>
                        <div class="col-4">
                            <!-- START OF ONE KREST  CARD -->
                            <div class="course-card-blue">
                                <div class="container">
                                    <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Course's thumbnail not available..">
                                    <div class="top-left card-tag small-text">Krest</div>
                                </div>
                                <div style="background:#FFFFFF;padding:1.5vw;border-radius:0px 0px 10px 10px">
                                    <div style="display:flex;justify-content:space-between">
                                        <p href="" class="normal-text" style="font-family: Rubik Bold;margin-bottom:0.5vw;color:#55525B;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">How to be funny?</p>
                                    </div>
                                    <a class="small-text" style="font-family: Rubik Regular;color: rgba(85, 82, 91, 0.8);background: #FFFFFF;box-shadow: inset 0px 0px 2px #BFBFBF;border-radius: 5px;padding:0.2vw 0.5vw;text-decoration:none;">Personal development  (Krest)</a>
                                    <p class="small-text course-card-description" style="font-family: Rubik Regular;margin-bottom:0px;color: rgba(85, 82, 91, 0.8);margin-top:1vw">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam commodo venenatis, ac quam aliquam tortor vel. Id sit egestas mauris ullamcorper elit dis.</p>
                    
                                </div>
                            </div>
                            <!-- END OF ONE  KREST CARD -->
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev"   data-bs-target="#perlengkapan-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <i class="fas fa-arrow-left big-heading" id="carousel-control-right-menu-image" style="width:1vw;z-index:99;margin-right:0px;color:rgba(43, 108, 170, 0.5);" alt="PREV"></i>

                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#perlengkapan-carousel" style="width:2vw" role="button"data-bs-slide="next">
                <i class="fas fa-arrow-right big-heading" style="width:1vw;z-index:99;margin-right:0px;color:rgba(43, 108, 170, 0.5);" alt="NEXT"></i>
                <span class="visually-hidden">Next</span>
            </a>
        </div> 
        <!-- END OF CAROUSEL -->
    </div>
    <div class="program-content" id="on-demand-programs" style="text-align:center;display:none">
        <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;padding-top:3vw">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper in proin egestas mollis id lacinia nec. Nunc felis mi bibendum facilisi sollicitudin tempor, ultricies. Dignissim montes, risus ultrices egestas. At in suscipit nulla eget. Dictum lacus donec imperdiet malesuada.
        </p>   
        <button type="button" data-toggle="modal" data-target="#contactModal" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;padding:0.5vw 2.5vw;100%;border:none;margin-top:1vw">
            Hubungi Kami
        </button>
    </div>
</div>
<!-- END OF OUR PROGRAMS -->

<!-- START OF OUR VALUES SECTION -->
<div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw">
    <div class="col-12">
        <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA">Our Values</p>
        <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">Mengenal Nilai Program Krest dalam <br> kemudahan mengaksesnya</p>
    </div>
    <div class="col-4" style="display:flex;justify-content:center">
        <div class="krest-card" style="margin-top:1.5vw">   
            <img src="/assets/images/client/Krest_Dummy_Card_Image.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
            <p id="krest-card-title" class="bigger-text" style="font-family:Rubik Medium;margin-top:1vw">Customer Experience</p>
            <p id="krest-card-description" class="small-text" style="font-family:Rubik Regular;color:#FFFFFFmargin-top:1vw">Customer Experience yang sigap menangangani dan mengayomi setiap user yang memiliki kesulitan dalam mengakses venidici dan mencerna informasi materi yang ada</p>
        </div>
    </div>
    <div class="col-4" style="display:flex;justify-content:center">
        <div class="krest-card" style="margin-top:1.5vw">   
            <img src="/assets/images/client/Krest_Dummy_Card_Image.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
            <p id="krest-card-title" class="bigger-text" style="font-family:Rubik Medium;margin-top:1vw">Customer Experience</p>
            <p id="krest-card-description" class="small-text" style="font-family:Rubik Regular;color:#FFFFFFmargin-top:1vw">Customer Experience yang sigap menangangani dan mengayomi setiap user yang memiliki kesulitan dalam mengakses venidici dan mencerna informasi materi yang ada</p>
        </div>
    </div>
    <div class="col-4" style="display:flex;justify-content:center">
        <div class="krest-card" style="margin-top:1.5vw">   
            <img src="/assets/images/client/Krest_Dummy_Card_Image.png" style="width:5vw;height:5vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="KREST">
            <p id="krest-card-title" class="bigger-text" style="font-family:Rubik Medium;margin-top:1vw">Customer Experience</p>
            <p id="krest-card-description" class="small-text" style="font-family:Rubik Regular;color:#FFFFFFmargin-top:1vw">Customer Experience yang sigap menangangani dan mengayomi setiap user yang memiliki kesulitan dalam mengakses venidici dan mencerna informasi materi yang ada</p>
        </div>
    </div>
</div>
<!-- END OF OUR VALUES SECTION -->

<!-- START OF OUR PARTNERS TESTIMONY -->
<div class="row m-0 page-container" style="padding-top:4vw;padding-bottom:4vw;background-color:#F6F6F6">
    <div style="text-align:center">
        <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA">Our Partners Testimony</p>
        <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">Memberi Manfaat Yang Terbukti Bagi Perusahaan</p>
    </div>
    <div class="row m-0" style="padding-top:4vw">
        <div class="col-6 wow bounceIn" data-wow-delay="0.3s" style="display: flex;flex-direction: column;justify-content: center;">
            <div id="feature-carousel" class="carousel slide" data-interval="5000" data-ride="carousel">
                <div class="carousel-inner" style="padding: 0vw 3vw;text-align:center">
                    
                    <div class="carousel-item active" >
                        <img src="/assets/images/client/BCA_TRANSPARENT.png" style="width:auto;height:7vw;" class="img-fluid" alt="Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/client/BCA_TRANSPARENT.png" style="width:auto;height:7vw;" class="img-fluid" alt="Image 1">
                    </div>
                </div>
                <a class="carousel-control-prev"   data-bs-target="#feature-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                    <img src="/assets/images/icons/arrow-left.svg" id="carousel-control-left-menu-image" style="width:2vw;z-index:99;margin-left:0px" alt="NEXT">
                    <span class="visually-hidden">Prev</span>
                </a>
                <a class="carousel-control-next"   data-bs-target="#feature-carousel" style="width:2vw"  role="button"data-bs-slide="next">
                    <img src="/assets/images/icons/arrow-right.svg" id="carousel-control-right-menu-image" style="width:2vw;z-index:99;margin-right:0px" alt="NEXT">
                    <span class="visually-hidden">Next</span>
                </a>
            </div>  
        </div>
        <div class="col-6" style="display:flex;justify-content:flex-end">
            <div style="background: #FFFFFF;border-radius: 0px 10px 10px 0px;padding:3vw 2vw;text-align:center;width:34vw">
                <img src="/assets/images/client/kenapa_online_course.png" style="width:25vw;object-fit:cover;height:10vw;border-radius: 10px" class="img-fluid" alt="Image 1">
                <p class="small-heading" style="font-family: Rubik Medium;color:#3B3C43;margin-top:2vw">BCA Digital Marketing Training</p>
                    
                    <p class="normal-text" style="font-family: Rubik Regular;color:#3B3C43;margin-bottom:0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

            </div>
        </div>
    </div>
</div>
<!-- END OF OUR PARTNERS TESTIMONY -->

<!-- START OF OUR VALUES
<div class="row m-0 page-container krest-values-background" style="padding-top:15vw;padding-bottom:15vw">
    <div class="col-12 p-0" style="text-align:right !important">   
        <p class="sub-description" style="font-family: Rubik Medium;color:#2B6CAA">Our Values</p>
        <p class="big-heading" style="font-family: Rubik Bold;color:#3B3C43">Mengenal Nilai Program Krest dalam <br> kemudahan mengaksesnya</p>
        <div style="margin-top:2vw;padding-left:20vw">
            <p class="bigger-text" style="font-family: Rubik Regular;color:#000000;white-space:pre-line">Venidici memberikan berbagai macam program yang dapat diikuti oleh masyarakat luas. Mulai dari bla bla bla dan ini adalah sebuah bla bla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Erat urna commodo eget sem. 

    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper in proin egestas mollis id lacinia nec. Nunc felis mi bibendum facilisi sollicitudin tempor, ultricies. Dignissim montes, risus ultrices egestas. At in suscipit nulla eget. Dictum lacus donec imperdiet malesuada.</p>
        </div>
    </div>
</div>
END OF OUR VALUES-->

<!-- START OF CONTACT US SECTION -->
<form action="">
    <div class="row m-0 page-container" style="padding-top:8vw;padding-bottom:8vw">
        <div class="col-12" style="text-align:center">
            <p class="medium-heading wow flash" data-wow-delay="0.3s" style="font-family: Rubik Bold;color:#55525B">Hubungi Kami Lebih Lanjut</p>
            <p class="sub-description" style="font-family: Rubik Regular;color:#55525B;margin-top:2vw">Tanyakan kami apapun dan kami senang membantu</p>
                <div>
                    <button type="button" data-toggle="modal" data-target="#contactModal" class="btn-blue normal-text" style="text-decoration: none;font-family:Rubik Regular;padding:0.5vw 2.5vw;100%;border:none;margin-top:1vw">
                        Kirim Pesan
                    </button>   
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END OF CONTACT US SECTION -->

<!-- START OF FAQ SECTION -->
<div class="row m-0 page-container" style="padding-top:6vw;padding-bottom:6vw;background-color:#F9F9F9">
    <div class="col-12 p-0">
        <p class="big-heading" style="font-family: Rubik Medium;color:#3B3C43;margin-left:3vw">Frequently Asked Questions</p>
    </div>
    <!-- START OF QUESTION SECTION -->
    <div class="col-12 p-0" style="display:flex;justify-content:center;margin-top:1.5vw">
        <div style="background-color:#F9F9F9;padding:1.5vw;border-radius:10px;width:92%">
            <!-- START OF ONE FAQ CARD -->
            <div class="faq-card">
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">What is your shipping policy?</p>
                    <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ1" role="button" aria-expanded="false" aria-controls="collapseFaQ1">
                        <i class="fas fa-chevron-down"></i>
                    </p>                                    
                </div>
                <div class="collapse" id="collapseFaQ1" style="margin-top:1vw">
                    <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular"> 
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </p>
                </div>
            </div>
            <!-- END OF ONE FAQ CARD -->
            <!-- START OF ONE FAQ CARD -->
            <div class="faq-card" style="margin-top:1vw">
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Can I refund the course that i enrolled?</p>
                    <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ2" role="button" aria-expanded="false" aria-controls="collapseFaQ2">
                        <i class="fas fa-chevron-down"></i>
                    </p>                                    
                </div>
                <div class="collapse" id="collapseFaQ2" style="margin-top:1vw">
                    <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular"> 
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </p>
                </div>
            </div>
            <!-- END OF ONE FAQ CARD -->
            <!-- START OF ONE FAQ CARD -->
            <div class="faq-card" style="margin-top:1vw">
                <div style="display:flex;align-items:center;justify-content:space-between;">
                    <p class="sub-description" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">Lorem Ipsum Dolor Sit Amet?</p>
                    <p class="bigger-text" style="margin-bottom:0px;color:#747D88" data-toggle="collapse" href="#collapseFaQ3" role="button" aria-expanded="false" aria-controls="collapseFaQ3">
                        <i class="fas fa-chevron-down"></i>
                    </p>                                    
                </div>
                <div class="collapse" id="collapseFaQ3" style="margin-top:1vw">
                    <p class="normal-text" style="color:#3B3C43;font-family:Rubik Regular"> 
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </p>
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
    function changePrograms(evt, categoryName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("program-content")
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("program-links");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("btn-blue-active", "btn-blue-bordered");
        }
        document.getElementById(categoryName).style.display = "block";
        evt.currentTarget.className += " btn-blue-active";
    }
</script>


@endsection