@extends('./layouts/client-main')
@section('title', 'Venidici Woki Detail')

@section('content')


<div class="row m-0 page-container woki-detail-bg" style="padding-top:13vw;padding-bottom:10vw">
    <!-- START OF LEFT SECTION -->
    <div class="col-8" >
        <div style="padding-right:10vw">
            <p class="medium-heading" style="font-family:Hypebeast;color:#CE3369">WOKI</p>
            <p class="medium-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:2vw">Sertifikat menjadi komedian lucu</p>
            
            <p class="sub-description" style="font-family:Rubik Regular;color:#B3B5C2;white-space:pre-line">Need to be funny fast? This is the course for people that
                find it hard to be funny.</p>
            <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43;margin-top:2vw">Sebuah kelas oleh <span style="font-family:Rubik Bold">Mr. Raditya Dika</span></p>
            <video style="width:100%;height:23vw;display:block;object-fit: cover;margin-top:2vw"  controls="false" >
                <source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
                <source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
                Your browser does not support HTML video.
            </video> 

            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-top:2vw"><i class="fas fa-user-graduate"></i> <span style="margin-left:1vw">150 Pelajar</span></p>
            <div style="display:flex;align-items:center;margin-top:1vw;">
                <p class="sub-description" style="font-family:Rubik Regular;color:#F4C257;margin-bottom:0px">4/5</p>
                <div style="display: flex;justify-content:center;margin-left:1vw">
                    <i style="color:#F4C257" class="fas fa-star sub-description"></i>
                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star sub-description"></i>
                    <i style="margin-left:0.5vw;color:#F4C257" class="fas fa-star sub-description"></i>
                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star sub-description"></i>
                    <i style="margin-left:0.5vw;color:#B3B5C2" class="fas fa-star sub-description"></i>
                </div>
            </div>
            <!-- WHAT YOU WILL LEARN SECTION -->
            <div style="background: rgba(206, 51, 105, 0.1);border-radius: 10px;padding:1.5vw;margin-top:2vw">
                <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Apa saja yang akan dipelajari</p>
                <div class="row m-0" style="padding-top:2vw">
                    <div class="col-6">
                        <div style="display:flex;align-items:baseline">
                            <i style="color:#CE3369" class="fas fa-check-circle bigger-text"></i>
                            <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43;margin-left:1vw;margin-bottom:0px">Bisa melawak dengan benar dan tidak garing</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="display:flex;align-items:baseline">
                            <i style="color:#CE3369" class="fas fa-check-circle bigger-text"></i>
                            <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43;margin-left:1vw;margin-bottom:0px">Bisa melawak dengan benar</p>
                        </div>
                    </div>
                    <div class="col-6" style="margin-top:1vw">
                        <div style="display:flex;align-items:baseline">
                            <i style="color:#CE3369" class="fas fa-check-circle bigger-text"></i>
                            <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43;margin-left:1vw;margin-bottom:0px">Bisa melawak dengan benar</p>
                        </div>
                    </div>
                    <div class="col-6" style="margin-top:1vw">
                        <div style="display:flex;align-items:baseline">
                            <i style="color:#CE3369" class="fas fa-check-circle bigger-text"></i>
                            <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43;margin-left:1vw;margin-bottom:0px">Bisa melawak dengan benar dan tidak garing</p>
                        </div>
                    </div>
                    <div class="col-6" style="margin-top:1vw">
                        <div style="display:flex;align-items:baseline">
                            <i style="color:#CE3369" class="fas fa-check-circle bigger-text"></i>
                            <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43;margin-left:1vw;margin-bottom:0px">Bisa melawak dengan benar dan tidak garing</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END OF WHAT YOU WILL LEARN SECTION -->
        </div>
        <!-- START OF PERSYARATAN SECTION -->
        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:2vw">Persyaratan</p>
        
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;padding-top:1vw">   
            <a class="red-tag normal-text" style="margin-top:1vw">Muka lucu dan unik</a>
            <a class="red-tag normal-text" style="margin-top:1vw">Another Muka lucu dan unik</a>
            <a class="red-tag normal-text" style="margin-top:1vw">Another Muka lucu dan unik</a>
            <a class="red-tag normal-text" style="margin-top:1vw">Another Muka 1</a>
            <a class="red-tag normal-text" style="margin-top:1vw">Another Muka lucu dan unik</a>
        </div>
        <!-- END OF PERSYARATAN SECTION -->

        <!-- START OF PERLENGKAPAN SENI SECTION -->
        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:3vw">Perlengkapan Seni</p>
        <div id="perlengkapan-carousel" style="margin-top:2vw" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 2vw;">
                
                <div class="carousel-item active">
                    <div class="row m-0">
                        <div class="col-4">
                            <!-- START OF ONE PERLENGKAPAN COURSE CARD -->
                            <div class="perlengkapan-card-red">
                                <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                <div style="text-align:center">
                                    <p class="normal-text" style="margin-top:1vw">Perlengkapan untuk menggambar</p>
                                </div>
                            </div>
                            <!-- END OF ONE PERLENGKAPAN COURSE CARD -->
                        </div>
                        <div class="col-4">
                            <!-- START OF ONE PERLENGKAPAN COURSE CARD -->
                            <div class="perlengkapan-card-red">
                                <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                <div style="text-align:center">
                                    <p class="normal-text" style="margin-top:1vw">Peralatan Melukis</p>
                                </div>
                            </div>
                            <!-- END OF ONE PERLENGKAPAN COURSE CARD -->
                        </div>
                        <div class="col-4">
                            <!-- START OF ONE PERLENGKAPAN COURSE CARD -->
                            <div class="perlengkapan-card-red">
                                <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                <div style="text-align:center">
                                    <p class="normal-text" style="margin-top:1vw">Perlengkapan untuk menggambar</p>
                                </div>
                            </div>
                            <!-- END OF ONE PERLENGKAPAN COURSE CARD -->
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row m-0">
                        <div class="col-4">
                            <!-- START OF ONE PERLENGKAPAN COURSE CARD -->
                            <div class="perlengkapan-card-red">
                                <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                <div style="text-align:center">
                                    <p class="normal-text" style="margin-top:1vw">Peralatan Melukis </p>
                                </div>
                            </div>
                            <!-- END OF ONE PERLENGKAPAN COURSE CARD -->
                        </div>
                        <div class="col-4">
                            <!-- START OF ONE PERLENGKAPAN COURSE CARD -->
                            <div class="perlengkapan-card-red">
                                <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                <div style="text-align:center">
                                    <p class="normal-text" style="margin-top:1vw">Perlengkapan untuk menggambar</p>
                                </div>
                            </div>
                            <!-- END OF ONE PERLENGKAPAN COURSE CARD -->
                        </div>
                        <div class="col-4">
                            <!-- START OF ONE PERLENGKAPAN COURSE CARD -->
                            <div class="perlengkapan-card-red">
                                <img src="/assets/images/client/course-card-image-dummy.png" class="img-fluid" style="object-fit:cover;border-radius:10px 10px 0px 0px;width:100%;height:14vw" alt="Snow">
                                <div style="text-align:center">
                                    <p class="normal-text" style="margin-top:1vw">Perlengkapan untuk menggambar</p>
                                </div>
                            </div>
                            <!-- END OF ONE PERLENGKAPAN COURSE CARD -->
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev"   data-bs-target="#perlengkapan-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <img src="/assets/images/icons/arrow-left-2.svg" id="carousel-control-left-menu-image" style="width:1vw;z-index:99;margin-left:0px" alt="NEXT">
                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#perlengkapan-carousel" style="width:2vw" role="button"data-bs-slide="next">
                <img src="/assets/images/icons/arrow-right-2.svg" id="carousel-control-right-menu-image" style="width:1vw;z-index:99;margin-right:0px" alt="NEXT">
                <span class="visually-hidden">Next</span>
            </a>
        </div> 
        <!-- END OF PERLENGKAPAN SENI SECTION -->

        <!-- START OF PROFIL PEMBICARA SECTION -->
        <div style="display:flex;align-items:center;margin-top:4vw">
            <p class="sub-description profil-text-red profil-text-red-active profil-links"  onclick="changeContent(event, 'tentang-course')" style="font-family:Rubik Medium;margin-bottom:0px;cursor:pointer">Tetang <span style="font-family:Hypebeast;color:#CE3369">WOKI</span> ini</p>
            <p class="sub-description profil-text-red profil-links" onclick="changeContent(event, 'profil-pembicara')" style="font-family:Rubik Medium;margin-bottom:0px;cursor:pointer;margin-left:3vw">Profil Pembicara </p>

        </div>
        <div  class="bigger-text profil-content" id="tentang-course"  style="margin-top:1vw">
            <p class="bigger-text" style="font-family:Rubik Regular;color:#000000;white-space:pre-line">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet tortor gravida ut nam. Sapien duis feugiat feugiat nunc. Nunc cras dolor risus magnis facilisis elementum pharetra. Nunc dolor lacus, accumsan, vestibulum, faucibus libero, vulputate vitae, mauris.

    Lectus pretium platea hendrerit dignissim blandit nunc tortor. Nisi, adipiscing pharetra sit faucibus justo, faucibus gravida. Fringilla ipsum, commodo, sem arcu. Netus aliquet sit malesuada vel velit in rhoncus, ac pellentesque. Facilisis tortor senectus facilisis sit. Posuere quis massa purus, molestie convallis viverra ligula euismod sapien. Sollicitudin euismod molestie adipiscing mauris ullamcorper consequat nunc eget.
    
    Dictum a tincidunt diam ac fermentum mauris, faucibus ut suspendisse. Sit quisque malesuada integer duis aliquet vitae nunc volutpat. Sed quis adipiscing morbi quisque. Morbi eget maecenas aliquam tincidunt tincidunt. Sed felis eget bibendum pulvinar accumsan etiam aliquet sagittis. 

    Scelerisque enim, leo montes, erat scelerisque sapien egestas amet, bibendum. Et, mauris, faucibus at amet aliquam rhoncus. Tincidunt nunc ac sit blandit est.
            </p>
        </div>
        <div class="profil-content" id="profil-pembicara" style="display:none;margin-top:3vw">
            <img src="/assets/images/client/Placeholder.png" class="img-fluid" style="width:15vw" alt="PROFILE PICTURE">
            
            <p class="sub-description" style="font-family:Rubik Medium;color:#000000;margin-top:2vw;margin-bottom:0px">Mr. Raditya Dika</p>
            <p class="bigger-text" style="font-family:Rubik Regular;color:#000000;white-space:pre-line">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non vulputate cras pharetra malesuada libero mauris. Aliquet et enim eget felis quis et aliquam mi urna. Sagittis dictum consequat aenean posuere curabitur. Eget mauris habitasse mattis egestas tellus enim. Vestibulum massa iaculis in pellentesque aliquam morbi sem.</p>
        </div>
        <!-- END OF PROFIL PEMBICARA SECTION -->


       

    </div>
    <!-- END OF LEFT SECTION -->

    <!-- START OF RIGHT SECTION -->
    <div class="col-4" style="padding:0vw 2vw">
        <div class="course-detail-card-red">
            <p class="small-heading" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0px">Rp 300,000</p>
            <button class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;margin-top:1.5vw">Add to cart</button>
            <button class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;margin-top:1.5vw">Buy Now</button>
            <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1.5vw">Kamu akan dapat:</p>
            <div style="padding-bottom:2vw;border-bottom:4px solid #2B6CAA">
                <p class="bigger-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">109 Menit video eksklusif</span></p>
                <p class="bigger-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">1 Assesment</span></p>
                <p class="bigger-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">Akses seumur hidup</span></p>
                <p class="bigger-text" style="font-family:Rubik Regular;color: rgba(43, 108, 170, 0.5);margin-bottom:0px;margin-top:1vw"><i class="fas fa-circle"></i> <span style="margin-left:0.5vw;color:#3B3C43">Sertifikat keberhasilan</span></p>
            </div>
            <p class="bigger-text" style="font-family:Rubik Medium;color: #3B3C43;margin-bottom:2vw;margin-top:2vw;">Butuh pelatihan untuk perusahaan Anda?</p>
            <a href="#" class="normal-text btn-purple-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:2vw">Program Krest</a>

        </div>
        <div style="padding:2vw;background:#FFFFFF">
            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;margin-top:1.5vw">Ada <span style="font-family:Hypebeast">Pertanyaan?</span> </p>
            <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px;margin-top:1vw;margin-bottom:2vw">Langsung hubungi kami melalui:</p>
            <a  href="https://api.whatsapp.com/send?phone=+62818180509&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." target="_blank" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;width:100%;"><i class="fab fa-whatsapp"></i> <span style="margin-left:0.5vw">+628112345678</span></a>

        </div>
    </div>
    <!-- END OF RIGHT SECTION -->
    <!-- START OF RECOMMENDED SECTION -->
    <div class="col-12" style="margin-top:3vw">
        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px;">Pilihan kelas lainnya untuk kamu</p>
        <!-- ONLINE COURSE -->
        <div class="course-content" id="course-online" style="margin-top:2vw">
                <div class="row m-0 p-0">
                    <div class="col-4 p-0" >
                        <div style="display: flex;justify-content:flex-start">

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
                                        <p class="sub-description" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
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
                                        <p class="sub-description" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                        <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                        <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                                    </div>

                                </div>
                            </div>
                            <!-- END OF ONE RED COURSE CARD -->
                        </div>
                    </div>
                    <div class="col-4 p-0" >
                        <div style="display: flex;justify-content:flex-end">

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
                                        <p class="sub-description" style="font-family: Rubik Medium;margin-bottom:0px;color:#55525B;">Rp 300,000</p>
                                        <a href="/woki/sertifikat-menjadi-seniman" class="course-card-button normal-text">Enroll Now</a>
                                        <!-- <p class="sub-description" style="font-family: Rubik Regular;margin-bottom:0px;color:#55525B;">Enroll Now</p> -->
                                    </div>

                                </div>
                            </div>
                            <!-- END OF ONE RED COURSE CARD -->
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
                tablinks[i].className = tablinks[i].className.replace("profil-text-red-active", "profil-text-red");
            }
            document.getElementById(categoryName).style.display = "block";
            evt.currentTarget.className += " profil-text-red-active";
        }
         
</script>

@endsection