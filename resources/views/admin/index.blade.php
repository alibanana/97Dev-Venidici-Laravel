@extends('layouts/admin-main')

@section('title', 'Admin Dashboard')

@section('container')
        

<!-- Main Content -->
<div id="content" >

    <x-AdminTopbar />

    <!-- Begin Page Content -->
    <div class="container-fluid" >

        @if (session()->has('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 18px">
                {{ session()->get('message') }}            
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 mb-3 text-gray-800" style="color:white">Dashboard</h2>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Online Course Earnings Overview</h6>
                        <div class="dropdown no-arrow">
                            <!--
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            -->
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card bg-light text-black shadow">
                                    <div class="card-body">
                                        Today Sales
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$today_online_course_sold_qty}} times</div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="card bg-light text-black shadow">
                                    <div class="card-body">
                                        Today Earnings
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp{{ number_format($today_online_course_earnings, 0, ',', ',') }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6" style="margin-top:1vw">
                                <div class="card bg-light text-black shadow">
                                    <div class="card-body">
                                        Products Sold
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_online_course_sold_qty}} times</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" style="margin-top:1vw">
                                <div class="card bg-light text-black shadow">
                                    <div class="card-body">
                                        Total Earnings
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{number_format($total_online_course_earnings, 0, ',', ',')}}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-sm-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Woki Earnings Overview</h6>
                        <div class="dropdown no-arrow">
                            <!--
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                        
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            -->
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card bg-light text-black shadow">
                                    <div class="card-body">
                                        Today Sales
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$today_woki_sold_qty}} times</div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="card bg-light text-black shadow">
                                    <div class="card-body">
                                        Today Earnings
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ number_format($today_woki_earnings, 0, ',', ',') }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6" style="margin-top:1vw">
                                <div class="card bg-light text-black shadow">
                                    <div class="card-body">
                                        Products Sold
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_woki_sold_qty}} times</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" style="margin-top:1vw">
                                <div class="card bg-light text-black shadow">
                                    <div class="card-body">
                                        Total Earnings
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{number_format($total_woki_earnings, 0, ',', ',')}}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Card -->
            <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-uppercase mb-1" style="color:#2B6CAA">
                                    Users</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $users_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Card -->
            
            <!-- Card -->
            <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-uppercase mb-1" style="color:#2B6CAA">
                                    Online Courses</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$courses_count}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Card -->
            
            <!-- Card -->
            <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-uppercase mb-1" style="color:#2B6CAA">
                                    Woki</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$wokis_count}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-palette fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Card -->

            <!-- Card -->
            <!-- <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-uppercase mb-1" style="color:#2B6CAA">
                                    Krest</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">{{$applicants_count}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-business-time fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- End of Card -->

            <!-- Card 
            <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-uppercase mb-1" style="color:#2B6CAA">
                                    Virtual Workshop</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             End of Card -->
            
            <!-- Card 
            <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-uppercase mb-1" style="color:#2B6CAA">
                                    Community</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-handshake fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                 End of Card -->
            
            
        </div>

        <!-- Page Heading 
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <h2 class="mb-0 mb-3 text-gray-800" style="color:white">Content Management System</h2>
            <form method="POST" action="">
                @csrf
                @method("put")
            <button type="submit" class="btn btn-primary btn-user" style="padding:1vw 8vw" onclick='return confirm("Are you sure you want to update the content?")'>
                Update Content
            </button>
        </div>
        <div class="row">
            <div class="col-12">
                <h5 class="mb-0 mb-3 text-gray-800" style="color:white">Home Page Top Section</h5>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Heading</label>
                    <textarea name="title" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title">Anytime, anywhere.
            Learn on your schedule from any device
                    </textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Sub-Heading</label>
                    <textarea name="title" class="form-control form-control-user" cols="30" rows="2" placeholder="Here insert title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget non dictum pellentesque nulla                     
                    </textarea>
                </div>
            </div>
            <div class="col-12">
                    <p>Current Video</p>
                    <video style="width:20vw;height:auto;border:4px solid black;border-radius:5px"  controls="false" >
                        <source src="/assets/videos/admin/CEPAT.mp4" type="video/mp4" />
                        <source src="/assets/videos/admin/CEPAT.ogg" type="video/ogg" />
                        Your browser does not support HTML video.
                    </video>             
                <div class="form-group">
                    <input type="file" >
                </div>
            </div>
        </div>
        -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<script>
    const video = document.createElement('video');

    console.log(video.canPlayType('video/mp4')); 
    console.log(video.canPlayType('video/mov')); 

</script>
@endsection

@section('additional-scripts')
    @if(session()->has('error_validation_on_password_modal')) 
        <script>
            $(document).ready(function() {
                $('#passwordModal').modal("show");
            });
        </script>
    @endif
@endsection