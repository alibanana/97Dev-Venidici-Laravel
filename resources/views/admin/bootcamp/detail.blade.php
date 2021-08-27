@extends('layouts/admin-main')

@section('title', 'Venidici Bootcamp Detail')

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
        <!--<div style="display: flex;font-size:1.5vw" class="mb-4">
            {{ $course->average_rating }}
            <div style="margin-left:0.5vw">
                @for ($i = 1; $i < 6; $i++)
                    @if ($i <= $course->average_rating)
                        @if ($i == 1)
                            <i style="color:#F4C257" class="fas fa-star"></i>
                        @else
                            <i style="margin-left:0.2vw;color:#F4C257" class="fas fa-star"></i>
                        @endif
                    @else
                        @if ($i == 1)
                            <i style="color:#B3B5C2" class="fas fa-star"></i>
                        @else
                            <i style="margin-left:0.2vw;color:#B3B5C2" class="fas fa-star"></i>
                        @endif
                    @endif
                @endfor
            </div>
            
        </div>-->
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
                            Total Revenue
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ number_format($total_revenue, 0, ',', ',') }}</div>
                        </div>
                    </div>

                </div>
                <div class="col-6 mt-4">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Syllabus Request
                            <div style="display:flex;justify-content:space-between;align-items:center">
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($course->bootcampSyllabusRequests)}}</div>
                                <a class="d-sm-inline-block btn btn-secondary shadow-sm text-nowrap" href="{{ route('admin.bootcamp.syllabusRequests', $course->id) }}">View List</a>
                            </div>

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
                                <label class="w-100">Filter By:
                                    <select aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="if (this.value) window.location.href=this.value">
                                        <option value="{{ request()->fullUrlWithQuery(['filter' => '']) }}" @if (!Request::has('filter')) selected @endif>None</option>
                                        <option value="{{ request()->fullUrlWithQuery(['filter' => 'ft_pending']) }}" @if (Request::get('filter') == 'ft_pending') selected @endif>Free Trial Pending</option>
                                        <option value="{{ request()->fullUrlWithQuery(['filter' => 'ft_paid']) }}" @if (Request::get('filter') == 'ft_paid') selected @endif>Free Trial Paid</option>
                                        <option value="{{ request()->fullUrlWithQuery(['filter' => 'ft_refunded']) }}" @if (Request::get('filter') == 'ft_refunded') selected @endif>Refunded</option>
                                        <option value="{{ request()->fullUrlWithQuery(['filter' => 'ft_cancelled']) }}" @if (Request::get('filter') == 'ft_cancelled') selected @endif>Cancelled</option>
                                        <option value="{{ request()->fullUrlWithQuery(['filter' => 'waiting']) }}" @if (Request::get('filter') == 'waiting') selected @endif>Waiting Confirmation</option>
                                        <option value="{{ request()->fullUrlWithQuery(['filter' => 'approved']) }}" @if (Request::get('filter') == 'approved') selected @endif>Approved</option>
                                        <option value="{{ request()->fullUrlWithQuery(['filter' => 'denied']) }}" @if (Request::get('filter') == 'denied') selected @endif>Rejected</option>
                                    </select>
                                </label>
                            </div>
                        </div>
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
                                                <th>Profile</th>
                                                <th>Type</th>
                                                <th>Address</th>
                                                <th>Institution</th>
                                                <th>Sumber Tahu Program</th>
                                                <th>Kenapa Memilih</th>
                                                <th>Ekspektasi</th>
                                                <th>Bank Information</th>
                                                <th>Status</th>
                                                <th>Submitted At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    
                                                    <td>
                                                        Batch : {{$user->batch}} <br>
                                                        {{ $user->name }} <br>
                                                        {{ $user->email }} <br>
                                                        {{ $user->phone_no }} <br>
                                                        {{ $user->birth_place }}, {{ $user->birth_date }} <br>
                                                        {{ $user->gender }} <br>
                                                        {{ $user->mencari_kerja }} <br>
                                                        {{ $user->social_media }} <br>
                                                        <div class="text-nowrap">
                                                            Konsiderasi Lanjut: {{ $user->konsiderasi_lanjut }} <br>
                                                        </div>
                                                        
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <!-- IF TRIAL -->
                                                        @if($user->is_trial && !$user->is_full_registration)
                                                        Free Trial
                                                        <!-- IF FULL REGIS -->
                                                        @elseif(!$user->is_trial && $user->is_full_registration)
                                                        Full Registration
                                                        <!-- IF MOVE FROM TRIAL TO FULL REGIS -->
                                                        @elseif($user->is_trial && $user->is_full_registration)
                                                        From Trial to Full Regis
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->address }}, {{ $user->province->name }}, {{ $user->city->name }}</td>
                                                    <td>{{ $user->institution }} <br>
                                                        Last Degree: {{ $user->last_degree }}
                                                    </td>
                                                    <td>
                                                        {{ $user->sumber_tahu_program }}
                                                    </td>
                                                    <td>
                                                        {{ $user->kenapa_memilih }} <br>
                                                    </td>
                                                    <td>
                                                        {{ $user->expectation }} <br>
                                                    </td>
                                                    <td>
                                                        @if($user->bankShortCode != null)
                                                        {{ $user->bankShortCode }} | {{ $user->bank_account_number }}
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($user->status == 'ft_pending')
                                                        <span style="color: orange;">Pending Payment</span>
                                                        @elseif($user->status == 'ft_paid')
                                                        <span style="color: green;">Paid Payment</span>
                                                        @elseif($user->status == 'ft_refunded')
                                                        <span style="color: orange;">Refunded</span>
                                                        @elseif($user->status == 'ft_cancelled')
                                                        <span >Cancelled</span>
                                                        @elseif($user->status == 'waiting')
                                                        <span style="color: orange;">Waiting Confirmation</span>
                                                        @elseif($user->status == 'approved')
                                                        <span style="color: green;">Approved</span>
                                                        @elseif($user->status == 'denied')
                                                        <span style="color: red;">Rejected</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$user->created_at}}
                                                    </td>

                                                    <td>
                                                        <!-- KALAU DAFTAR FREE TRIAL -->
                                                        @if(($user->is_trial && !$user->is_full_registration && $user->status == 'ft_paid') || $user->status == 'approved')
                                                        <a href="/admin/invoices/{{$user->invoice_id}}"  class="text-nowrap">View Invoice</a>


                                                        <form action="{{route('admin.bootcamp.change-application-status',$user->id)}}" method="post"  style="margin-top: 1vw;">
                                                            @csrf
                                                            @method('put')         
                                                            <div style="padding: 0px 2px">
                                                                <input type="hidden" name="" value"">
                                                                <button name="action" value="Refund" class="d-sm-inline-block btn btn-warning shadow-sm" type="submit" onclick="return confirm('Are you sure you want to refund this user?')">Refund</button>
                                                            </div>
                                                        </form>
                                                        <!-- KALAU DAFTAR FULL -->

                                                        @elseif(!$user->is_trial && $user->is_full_registration && $user->status == 'waiting')
                                                        
                                                        <form action="{{route('admin.bootcamp.change-application-status',$user->id)}}" method="post" style="margin-top: 1vw;">
                                                            @csrf
                                                            @method('put')         
                                                            <div style="padding: 0px 2px">
                                                                <button name="action" value="Approved" class="d-sm-inline-block btn btn-success shadow-sm" type="submit" onclick="return confirm('Are you sure you want to accept this user?')">Accept</button>
                                                            </div>
                                                        </form>
                                                        <form action="{{route('admin.bootcamp.change-application-status',$user->id)}}" method="post" style="margin-top: 1vw;">
                                                            @csrf
                                                            @method('put')         
                                                            <div style="padding: 0px 2px">
                                                                <input type="hidden" name="" value"">
                                                                <button name="action" value="Reject" class="d-sm-inline-block btn btn-danger shadow-sm" type="submit" onclick="return confirm('Are you sure you want to reject this user?')">Reject</button>
                                                            </div>
                                                        </form>

                                                        @elseif(($user->is_trial && $user->is_full_registration && $user->status == 'waiting'))
                                                        <form action="{{route('admin.bootcamp.change-application-status',$user->id)}}" method="post"  style="margin-top: 1vw;">
                                                            @csrf
                                                            @method('put')         
                                                            <div style="padding: 0px 2px">
                                                                <input type="hidden" name="" value"">
                                                                <button name="action" value="Upgrade" class="d-sm-inline-block btn btn-success shadow-sm text-nowrap" type="submit" onclick="return confirm('Are you sure you want to upgrade this user from trial to full registration?')">Accept Upgrade</button>
                                                            </div>
                                                        </form>
                                                        <form action="{{route('admin.bootcamp.change-application-status',$user->id)}}" method="post"  style="margin-top: 1vw;">
                                                            @csrf
                                                            @method('put')         
                                                            <div style="padding: 0px 2px">
                                                                <input type="hidden" name="" value"">
                                                                <button name="action" value="Reject" class="d-sm-inline-block btn btn-danger shadow-sm text-nowrap" type="submit" onclick="return confirm('Are you sure you want to reject this user from trial to full registration?')">Reject Upgrade</button>
                                                            </div>
                                                        </form>
                                                        @endif

                                                    </td>
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
