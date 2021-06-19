@extends('layouts/admin-main')

@section('title', 'Venidici Woki Course Detail')

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
            <h1 class="mb-0 mb-3 text-gray-800">{{ $course->title }}</h1>
        </div>
        @if ($course->price == 0)
            <h4 style="">FREE</h4>
        @else
            <h4 style="">Rp. {{ $course->price }}</h4>
        @endif
        <div style="display: flex;font-size:1.5vw" class="mb-4">
            {{ $course->average_rating }}
            <div style="margin-left:0.5vw">
                @for ($i = 1; $i < 6; $i++)
                    @if ($i <= $course->average_rating)
                        @if ($i == 1)
                            <i style="color:#F4C257" class="fas fa-star small-text"></i>
                        @else
                            <i style="margin-left:0.2vw;color:#F4C257" class="fas fa-star"></i>
                        @endif
                    @else
                        @if ($i == 1)
                            <i style="color:#B3B5C2" class="fas fa-star small-text"></i>
                        @else
                            <i style="margin-left:0.2vw;color:#B3B5C2" class="fas fa-star"></i>
                        @endif
                    @endif
                @endfor
            </div>
            
        </div>
        <div class="card-body p-0">
            <div class="row">
                <div class="col-6">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Total Course Sold
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($course->users) }}</div>
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
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" @if (Request::get('sort') == 'latest') selected @endif>Latest</option>
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" @if (Request::get('sort') == 'oldest') selected @endif>Oldest</option>
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
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    @if ($user->userDetail()->exists() && !is_null($user->userDetail->telephone))                                                
                                                        <td>{{ $user->userDetail->telephone }}</td>
                                                    @else
                                                        <td style="color: red">Phone number not available!</td>
                                                    @endif
                                                </tr>
                                            @endforeach
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
