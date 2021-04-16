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
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0 mb-3 text-gray-800" style="color:white">Dashboard</h2>
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
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
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
                                    Woki</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
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
            <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-uppercase mb-1" style="color:#2B6CAA">
                                    Online Courses</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
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
                                    Bootcamp</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-campground fa-2x text-gray-300"></i>
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
            <!-- End of Card -->
            <!-- Card -->
            <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-uppercase mb-1" style="color:#2B6CAA">
                                    Krest</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-business-time fa-2x text-gray-300"></i>
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
                                    Mentoring</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-people-arrows fa-2x text-gray-300"></i>
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
                                    Virtual Company</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Card -->
        </div>

        <!-- Page Heading -->
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
                    <video autoplay controls="false" style="width:20vw;height:auto;border:4px solid black;border-radius:5px" src='/assets/videos/admin/CEPAT.mp4' type='video/mp4'></video>

                <div class="form-group">
                    <input type="file" >
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
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