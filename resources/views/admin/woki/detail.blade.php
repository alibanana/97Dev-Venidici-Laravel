@extends('layouts/admin-main')

@section('title', 'Venidici Online Course Detail')

@section('container')

<!-- Main Content -->
<div id="content">

    <x-adminTopbar />   
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (session()->has('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 18px">
                {{ session()->get('message') }}            
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="mb-0 mb-3 text-gray-800">woki title</h1>
        </div>
        <h4 style="">Rp. 100000</h4>
        <div style="display: flex;font-size:1.5vw" class="mb-4">
            4.5
            <div style="margin-left:0.5vw">
                <i style="color:#F4C257" class="fas fa-star small-text"></i>
                <i style="margin-left:0.2vw;color:#F4C257" class="fas fa-star small-text"></i>
                <i style="margin-left:0.2vw;color:#F4C257" class="fas fa-star small-text"></i>
                <i style="margin-left:0.2vw;color:#F4C257" class="fas fa-star small-text"></i>
                <i style="margin-left:0.2vw;color:#F4C257" class="fas fa-star small-text"></i>
            </div>
            
        </div>
        <div class="card-body p-0">
            <div class="row">
                <div class="col-6">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Total Course Sold
                            <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
                        </div>
                    </div>

                </div>
                <div class="col-6">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Total Earnings
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 150.000</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->
                    <h1 class="h5 mb-2 text-gray-800 d-inline">Student List</h1> <br>

                    <div class="row mt-2 mb-3">
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-1">
                            <div class="dataTables_length" id="show_entries">
                                <label class="w-100">Sort By:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'latest']) }}" @if (Request::get('sort') == 'latest') selected @endif>Latest</option>
                                        <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'sort' => 'oldest']) }}" @if (Request::get('sort') == 'oldest') selected @endif>Oldest</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div id="dataTable_filter" class="dataTables_filter">
                                <label class="w-100">Search:
                                    <form action="" method="GET">
                                        <input name="search" value="{{ Request::get('search') }}" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
                                        @if (Request::get('show'))
                                            <input name="show" value="{{ Request::get('show') }}" hidden>
                                        @endif
                                        <input type="submit" style="visibility: hidden;" hidden/>
                                    </form>
                                </label>
                            </div>
                        </div>
                      
                    </div>

                    <!-- Main Table -->
                    <div class="card shadow mb-4 mt-2">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Telephone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Fernandha Dzaky</td>
                                                <td>Fernandhadzaky@hotmail.com</td>
                                                <td>08111377893</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Alifio Rasyid</td>
                                                <td>official.alifio@gmail.com</td>
                                                <td>08123456789</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    <!-- /.container-fluid -->

                </div>
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
