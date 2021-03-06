@extends('./layouts/client-main')

@section('title', 'Venidici Sign Up')
@section('content')


<div class="row m-0 auth-background">
    <div class="col-md-12 p-0" style="height:100vh">
        <div class="centered white-modal-signup" style="width:70vw;padding-bottom:4vw !important;">
            <div style="display:flex;justify-content:space-between">
                <a href="/signup" class="normal-text" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">General Info</span></a>
            </div>
            <form action="{{ route('custom-auth.register') }}" method="POST">
            @csrf                   
                <div class="row m-0 page-container">
                    <div class="col-12 p-0">
                        <div style="text-align:center;margin-top:2vw">
                            <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:5vw" alt="LOGO">
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
                                style="
                                background: url({{ $interest->image }}) no-repeat center;
                                            background-size: cover;
                                            background-repeat:no-repeat;
                                            background-position:center;
                                cursor:pointer" onclick="toggleInterest('interest_card_{{ $interest->id }}', '{{ $interest->color }}')">
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