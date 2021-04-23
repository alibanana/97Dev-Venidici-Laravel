@extends('./layouts/client-main')
@section('title', 'Venidici Online Course Learn')

@section('content')


<div class="row m-0 page-container course-page-background" style="padding-top:11vw;padding-bottom:10vw">
    <!-- START OF BANNER SECTION -->
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family:Rubik Medium;color:#3B3C43;">How to Be Funny?</p>
        <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Lesson 1 title is the same as the video title</p>
    </div>  
    <!-- END OF BANNER SECTION -->

    <!-- START OF LEARNING SECTION -->
    <div class="col-8 p-0">
        <div style="margin-top:2vw">
            <iframe style="width:100%;height:35vw;border-radius:10px;display:block;object-fit: cover" 
                src="https://www.youtube.com/embed/znnMerAsRbk">
            </iframe>
        </div>
        <!-- START OF DESCRIPTION SECTION -->
        <div style="background: #F7F7F7;border-radius: 10px;padding:2vw;margin-top:2vw  ">
            <div style="display:flex">
                <p class="sub-description blue-text-underline blue-text-underline-active user-links" onclick="changeContent(event, 'deskripsi')"  style="font-family:Rubik Medium;cursor:pointer;margin-bottom:0px;text-decoration-color: #F7F7F7;">Deskripsi</p>
                <p class="sub-description blue-text-underline user-links" onclick="changeContent(event, 'notes')" style="font-family:Rubik Medium;margin-left:3vw;cursor:pointer;margin-bottom:0px;text-decoration-color: #F7F7F7;">Notes</p>
            </div>
            <div style="margin-top:2vw" class="user-content" id="deskripsi">
                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;">Deskripsi Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem cras nullam et facilisis at. Aenean suspendisse in blandit enim. Turpis nibh tempor, at arcu. Commodo velit lorem iaculis justo praesent. Lorem lacus sed ullamcorper tortor, tellus. Nunc egestas commodo eget morbi. Morbi justo ipsum metus, nibh sagittis eget mi eu. Leo neque, etiam ultricies enim eget vitae, commodo. Tempor risus praesent pharetra vitae, rhoncus eu, nunc, morbi.</p>
            </div>
            <div style="margin-top:2vw;display:none" class="user-content" id="notes">
                <p class="normal-text" style="font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;">Notes Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem cras nullam et facilisis at. Aenean suspendisse in blandit enim. Turpis nibh tempor, at arcu. Commodo velit lorem iaculis justo praesent. Lorem lacus sed ullamcorper tortor, tellus. Nunc egestas commodo eget morbi. Morbi justo ipsum metus, nibh sagittis eget mi eu. Leo neque, etiam ultricies enim eget vitae, commodo. Tempor risus praesent pharetra vitae, rhoncus eu, nunc, morbi.</p>
            </div>
        </div>
        <!-- END OF DESCRIPTION SECTION -->
    </div>
    <div class="col-4 p-0" style="margin-top:2vw">
        <div style="display:flex;justify-content:flex-end">
            <div class="rounded-card" style="width:23vw;height:auto">
                <div style="padding:1.5vw">
                    <p class="small-heading" id="card-title" style="color:#3B3C43;font-family:Rubik Medium">Daftar Pelatihan</p>
                </div>
                <!-- START OF ONE ACCORDION -->
                <div class="accordion" id="accordionMaterial">
                    <div class="accordion-item" >
                        <h2 class="accordion-header" id="headingOne" style="background: rgba(111, 159, 205, 0.1)">
                        <button class="accordion-button bigger-text" style="border:none;border-radius:0px;font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMaterial" aria-expanded="true" aria-controls="collapseMaterial">
                        <span class="bigger-text">Material</span>
                        </button>
                        </h2>
                        <div id="collapseMaterial" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionMaterial">
                            <div class="accordion-body" style="padding:0vw;border:none !important">
                                <!-- START OF ONE COURSE -->
                                <a href="" style="text-decoration:none">
                                    <div class="course-collapse">
                                        <div style="display:flex;justify-content:space-between">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Introduction</p>
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:0px">3:20</p>
                                        </div>
                                        <i style="color:#E2E2E2" class="fas fa-play-circle"></i>
                                    </div>  
                                </a>
                                <!-- END OF ONE COURSE -->
                                <!-- START OF ONE COURSE -->
                                <a href="" style="text-decoration:none">
                                    <div class="course-collapse">
                                        <div style="display:flex;justify-content:space-between">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Knowing Yourself Part 1</p>
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:0px">4:20</p>
                                        </div>
                                        <i style="color:#E2E2E2" class="fas fa-play-circle"></i>
                                    </div>  
                                </a>
                                <!-- END OF ONE COURSE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF ONE ACCORDION -->
                <!-- START OF ONE ACCORDION -->
                <div class="accordion" id="accordionFAQ">
                    <div class="accordion-item" >
                        <h2 class="accordion-header" id="headingOne" style="background: rgba(111, 159, 205, 0.1)">
                        <button class="accordion-button bigger-text" style=";border:none;border-radius:0px;font-family: Rubik Regular;margin-bottom:0px;color:#3B3C43;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFAQ" aria-expanded="true" aria-controls="collapseFAQ">
                        <span class="bigger-text">Question and Answer</span>
                        </button>
                        </h2>
                        <div id="collapseFAQ" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body" style="padding:0vw;border:none !important">
                                
                                <!-- START OF ONE COURSE -->
                                <a href="" style="text-decoration:none">
                                    <div class="course-collapse">
                                        <div style="display:flex;justify-content:space-between">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">QnA Part 1</p>
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:0px">3:20</p>
                                        </div>
                                        <i style="color:#E2E2E2" class="fas fa-play-circle"></i>
                                    </div>  
                                </a>
                                <!-- END OF ONE COURSE -->
                                <!-- START OF ONE COURSE -->
                                <a href="" style="text-decoration:none">
                                    <div class="course-collapse">
                                        <div style="display:flex;justify-content:space-between">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">QnA Part 2</p>
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#B3B5C2;margin-bottom:0px">4:20</p>
                                        </div>
                                        <i style="color:#E2E2E2" class="fas fa-play-circle"></i>
                                    </div>  
                                </a>
                                <!-- END OF ONE COURSE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF ONE ACCORDION -->
                
            </div>
        </div>
    </div>
    <!-- END OF LEARNING SECTION -->
</div>
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

@endsection