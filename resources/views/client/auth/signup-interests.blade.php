@extends('./layouts/client-main')

@section('title', 'Venidici Sign Up')
@section('content')

<div class="row m-0">
    <div class="col-md-12 p-0" style="background: radial-gradient(100% 313.25% at 0% 0%, #2B6CAA 0%, #67BBA3 100%);backdrop-filter: blur(20px);;height:100vh">
        <div class="centered white-modal-signup" style="width:70vw;padding-bottom:4vw !important;height:85vh">
            <div style="display:flex;justify-content:space-between">
                <a href="/signup" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#CE3369;text-decoration:none"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">General Info</span></a>
            </div>
            <form action="">
                <div class="row m-0">
                    <div class="col-6" style="padding:1vw 4vw 1vw 3vw;">
                        <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw">Choose your interests</p>
                        <div style="display:flex;align-items:center;margin-top:0.8vw">   
                            <p class="small-text" style="font-family:Rubik Medium;color:#2B6CAA;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px">Tech</p>
                            <p class="small-text" style="font-family:Rubik Medium;color:#CE3369;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px;margin-left:1vw">Art</p>
                            <p class="small-text" style="font-family:Rubik Medium;color:#67BBA3;background-color:#EEEEEE;border-radius:10px;padding:0.5vw 1.5vw;margin-bottom:0px;margin-left:1vw">Math</p>
                        </div>

                        <div class="row" style="overflow:scroll;height:22vw;margin-top:1vw">
                            <div class="col-6 p-0" style="margin-top:1.5vw">
                                    <div class="container">
                                        <a href="">
                                            <img src="/assets/images/client/Interest_Dummy.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                            <div class="bottom-left">
                                                <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Tech</p>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                            <div class="col-6 p-0" style="margin-top:1.5vw">
                                    <div class="container">
                                        <a href="">
                                            <img src="/assets/images/client/Interest_Dummy_2.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                            <div class="bottom-left">
                                                <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Math</p>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                            <div class="col-6 p-0" style="margin-top:1.5vw">
                                    <div class="container">
                                        <a href="">
                                            <img src="/assets/images/client/Interest_Dummy.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                            <div class="bottom-left">
                                                <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Tech</p>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                            <div class="col-6 p-0" style="margin-top:1.5vw">
                                    <div class="container">
                                        <a href="">
                                            <img src="/assets/images/client/Interest_Dummy_2.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                            <div class="bottom-left">
                                                <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Math</p>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                            <div class="col-6 p-0" style="margin-top:1.5vw">
                                <a href="">
                                    <div class="container">
                                        <img src="/assets/images/client/Interest_Dummy.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                        <div class="bottom-left">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Tech</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 p-0" style="margin-top:1.5vw">
                                <a href="">
                                    <div class="container">
                                        <img src="/assets/images/client/Interest_Dummy_2.png" class="img-fluid" style="width:11vw;height:11vw;border-radius:10px" alt="Interest">
                                        <div class="bottom-left">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Math</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div style="text-align:center;margin-top:3vw">
                            <a href="/dashboard" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Sign Up</a>

                            <!--<button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;margin-top:2vw">Sign Up</button>-->
                        </div>
                    </div>   
                    <div class="col-6" style="padding-right:3vw;padding-top:3vw">
                        <div style="display: flex;flex-direction: column;justify-content: center;align-items:center">
                            <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
                            <img src="/assets/images/client/Sign_Up_Illustration_2.png" class="img-fluid" style="width:22vw" alt="LOGO">
                        </div>
                        <!--
                        <p class="big-heading" style="font-family:Rubik Medium;color:#55525B;">Mari kita sambut Indonesia <span style="font-family:Hypebeast;color:#F4C257;font-size:3.5vw !important;line-height:1vw">EMAS!</span> </p>
                        <img src="/assets/images/client/Sign_Up_Illustration.png" class="img-fluid" style="width:100%;height:auto" alt="">
                        -->
                    </div> 
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF BANNER SECTION -->
@endsection