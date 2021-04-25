<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet"  type="text/css"  href="/css/admin.css">
    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- wow js -->
    <link rel="stylesheet" href="/WOW-master/css/libs/animate.css">
    <style>
        #upload-button{

        background-color: #fa7600;
        color: white;
        padding: 8px 15px;
        border-radius: 0.3rem;
        cursor: pointer;

        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <x-AdminSidebar/>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            @yield('container')
            <x-AdminFooter />
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- password Modal-->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @if (session()->has('error_validation_on_password_modal'))
                <div class="p-3 mt-2 mb-0">
                    <div class="alert alert-danger alert-dismissible fade show m-0" role="alert" style="font-size: 18px">
                        {{ session()->get('error_validation_on_password_modal') }}     
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif

                <form method="POST" action="">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <h6 class="modal-title" id="exampleModalLabel">Old password</h6>
                    <div class="form-group mt-2">
                        <input type="password" name="old_password" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Insert your old password">
                        @error('old_password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h6 class="modal-title" id="exampleModalLabel">New password</h6>
                    <div class="form-group mt-2">
                        <input type="password" name="password" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Insert your new password">
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h6 class="modal-title" id="exampleModalLabel">Confirm new password</h6>
                    <div class="form-group mt-2">
                        <input type="password" name="password_confirmation" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Confirm your new password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Change Password</button>   
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/chart-area-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>

    <!-- wow js script -->
    <script src="/WOW-master/dist/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

    @yield('additional-scripts')

</body>

</html>