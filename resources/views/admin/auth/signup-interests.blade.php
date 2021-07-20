@extends('layouts/admin-main')

@section('title', 'Venidici Menjadi Pengajar')

@section('container')

<!-- Main Content --> 
<div id="content" style="background-color:#FFFFFF">

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
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <a href="/admin/signup" class="mb-0 mb-3 text-gray-800" style="font-size:25px">Back</a>
            <!--<a href="/admin/promo/create" class="btn btn-primary btn-user p-3">Create New Promo Code</a>-->

        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                <form action="{{ route('custom-auth.register') }}" method="POST">
                @csrf                   
                    <div class="row m-0 page-container">
                        <div class="col-12 p-0">
                            <div style="text-align:center;margin-top:2vw">
                                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:0vw">Ketertarikan anda</p>
                                <p class="bigger-text" style="font-family:Rubik Regular;color: @if(session('message')) #CE3369 @else #3B3C43 @endif;margin-bottom:0vw">{{ session('message') ?? 'Maksimal 3 pilihan' }}</p>
                            </div>
                            @error('interests')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row m-0"  style="overflow:scroll;height:25vw;margin-top:1vw">
                            @foreach($interests as $interest)
                                <div class="col-4" style="display:flex;
                                @if($loop->iteration % 3 == 1)
                                    justify-content:flex-start;
                                @elseif($loop->iteration % 3 ==2)
                                    justify-content:center;
                                @else
                                    justify-content:flex-end;
                                @endif
                                margin-top:2vw">
                                    <div class="container interest-card" id="interest_card_{{$interest->id}}" 
                                    style="background-image: url(/{{$interest->image}});cursor:pointer" onclick="toggleInterest('interest_card_{{ $interest->id }}', '{{ $interest->color }}')">
                                        <input type="hidden" name="interests[{{ $interest->id }}]" value="0">
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">{{ $interest->hashtag }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12 p-0" style="text-align:center;margin-top:3vw">
                            <button type="submit" onclick="openLoading()" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px">Submit</button>
                        </div>  
                    </div>
                </form>

                </div>
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>

<script>
    function toggleInterest(id, color_code) {
        var element = document.getElementById(id);
        
        element.classList.toggle("interest-card-active");
        value=$(element).find("input[type=hidden]");

        if (value.val() == 0) {
            $(element).find("input[type=hidden]").val('1');
            element.style.backgroundColor = color_code;
        } else {
            $(element).find("input[type=hidden]").val('0');
            element.style.backgroundColor = '';
        }
    }
</script>
@endsection
