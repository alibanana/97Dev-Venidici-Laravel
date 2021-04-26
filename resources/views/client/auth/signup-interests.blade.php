@extends('./layouts/client-main')

@section('title', 'Venidici Sign Up')
@section('content')

<div class="row m-0">
    <div class="col-md-12 p-0" style="background: radial-gradient(100% 313.25% at 0% 0%, #2B6CAA 0%, #67BBA3 100%);backdrop-filter: blur(20px);;height:100vh">
        <div class="centered white-modal-signup" style="width:70vw;padding-bottom:4vw !important;height:85vh">
            <div style="display:flex;justify-content:space-between">
                <a href="/signup" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">General Info</span></a>
            </div>
            <form action="">
                <div class="row m-0 page-container">
                    <div class="col-12 p-0">
                        <div style="text-align:center;margin-top:2vw">
                            <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:0vw">Ketertarikan anda</p>
                        </div>
                    </div>
                    <!-- START OF ONE LEFT INTEREST -->
                    <div class="col-4" style="display:flex;justify-content:flex-start;margin-top:2vw">
                        <a href="">
                            <div class="container interest-card">
                                <img src="/assets/images/client/Interest_Dummy_2.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                <div class="centered">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Tech</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- END OF ONE LEFT INTEREST -->
                    <!-- START OF ONE MIDDLE INTEREST -->
                    <div class="col-4" style="display:flex;justify-content:center;margin-top:2vw">
                        <a href="">
                            <div class="container interest-card">
                                <img src="/assets/images/client/Interest_Dummy.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                <div class="centered">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Arts</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- END OF ONE MIDDLE INTEREST -->
                    <!-- START OF ONE RIGHT INTEREST -->
                    <div class="col-4" style="display:flex;justify-content:flex-end;margin-top:2vw">
                        <a href="">
                            <div class="container interest-card">
                                <img src="/assets/images/client/Interest_Dummy_2.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                <div class="centered">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Math</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- END OF ONE RIGHT INTEREST -->
                    <!-- START OF ONE LEFT INTEREST -->
                    <div class="col-4" style="display:flex;justify-content:flex-start;margin-top:2vw">
                        <a href="">
                            <div class="container interest-card">
                                <img src="/assets/images/client/Interest_Dummy_2.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                <div class="centered">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Tech</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- END OF ONE LEFT INTEREST -->
                    <!-- START OF ONE MIDDLE INTEREST -->
                    <div class="col-4" style="display:flex;justify-content:center;margin-top:2vw">
                        <a href="">
                            <div class="container interest-card">
                                <img src="/assets/images/client/Interest_Dummy.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                <div class="centered">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Arts</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- END OF ONE MIDDLE INTEREST -->
                    <!-- START OF ONE RIGHT INTEREST -->
                    <div class="col-4" style="display:flex;justify-content:flex-end;margin-top:2vw">
                        <a href="">
                            <div class="container interest-card">
                                <img src="/assets/images/client/Interest_Dummy_2.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                <div class="centered">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Math</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- END OF ONE RIGHT INTEREST -->
                    <div class="col-12 p-0" style="text-align:center;margin-top:3vw">
                        <a href="/signup-interests" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</a>
                    </div>  
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection