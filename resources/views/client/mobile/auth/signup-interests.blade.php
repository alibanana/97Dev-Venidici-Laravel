@extends('./layouts/client-main')

@section('title', 'Venidici Sign Up')
@section('content')

<div class="row m-0">
    <div class="col-md-12 p-0" style="height:100vh">
        <div class="" style="width:100vw;padding-bottom:4vw !important;">
            <div style="display:flex;justify-content:space-between;padding:9vw 0vw 0vw 4vw">
                <a href="/signup" class="" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;color:#2B6CAA;text-decoration:none;font-size:3vw"><i  class="fas fa-arrow-left"></i> <span style="margin-left:0.5vw">General Info</span></a>
            </div>
            <form action="{{ route('store_interest') }}" method="POST">
            @csrf                   
                <div class="row m-0 page-container">
                    <div class="col-12 p-0">
                        <div style="text-align:center;margin-top:2vw">
                            <img src="/assets/images/client/Venidici_Icon.png" class="img-fluid" style="width:25vw;padding-top:2vw" alt="LOGO">
                            <p style="font-family:Rubik Medium;color:#3B3C43;margin-top:1vw;margin-bottom:0vw;font-size:5.5vw">Ketertarikan anda</p>
                            <p style="font-family:Rubik Regular;color: @if(session('message')) #CE3369 @else #3B3C43 @endif;margin-bottom:3vw;font-size:3vw">Maksimal 3 pilihan</p>
                        </div>
                        @error('interests')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row m-0 p-0"  style="height:25vw;margin-top:1vw">
                        @foreach($interests as $interest)
                            <div class="col-6" style="display:flex;
                            @if($loop->iteration % 2 == 1)
                                padding-left:0px;justify-content:start;
                            @elseif($loop->iteration % 2 == 0)
                                padding-right:0px;justify-content:flex-end;
                            @endif
                            margin-top:2vw">
                                <div class="container interest-card" id="interest_card_{{$interest->id}}" 
                                style="background-size:100%;background-image: url({{ $interest->image }});cursor:pointer" onclick="toggleInterest('interest_card_{{ $interest->id }}', '{{ $interest->color }}')">
                                    <input type="hidden" name="interests[{{ $interest->id }}]" value="0">
                                    <p class="" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px;font-size:3vw">{{ $interest->hashtag }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12 p-0" style="text-align:center;margin-top:65vw">
                        <button type="submit" class="btn-blue-bordered w-100" style="font-family: Poppins Medium;margin-bottom:0px;font-size:4vw">Submit</button>
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