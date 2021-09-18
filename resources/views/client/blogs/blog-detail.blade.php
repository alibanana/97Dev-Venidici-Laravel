@extends('./layouts/client-main')
@section('title', 'Venidici Detail')

@section('content')

<!-- START OF TOP SECTION -->
<div class="row m-0  page-container bg-image-mobile-height"
    style="height: 50vw; padding-top: 16vw;
    background: url('/{{$blog->banner}}') no-repeat center;
    background-size: cover;
    background-repeat:no-repeat;
    background-position:center;
    ">
    </div>
</div>
<!-- END OF TOP SECTION -->

<!-- START OF ARTICLE  BODY -->
<div class="row m-0 page-container" style="">
    <div class="col-12" style="padding:0vw 10vw;margin-top:-15vw">
        <div style="background: #FFFFFF;box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.25);border-radius: 10px;padding:2vw">
            <div style="display:flex;align-items:center;margin-bottom:1vw">
                <p class="normal-text" style="font-family: Rubik Regular;color:#B3B5C2;background-color:#2B6CAA;color:#FFFFFF;padding:0.5vw 1vw;text-decoration:none;border-radius:5px;margin-bottom:0px">{{$blog->hashtag}}</p>
                <p class="normal-text" style="margin-top:1vw;font-family: Rubik Regular;color:#55525B;margin-left:1.5vw">- {{$blog->duration}} mins read</p>
            </div>
            <p class="small-heading" style="font-family: Rubik Bold;color:#2B6CAA;">{{$blog->title}}</p>
            <p class="normal-text" style="font-family: Rubik Medium;color:#55525B;margin-bottom:0px">{{$blog->author}}</p>
            <p class="normal-text" style="font-family: Rubik Medium;color:#55525B;">{{$blog->created_at->diffForHumans()}}</p>

            <div style="background-color:#F5F2F2;padding:1.5vw;border-radius:10px;margin-top:2vw">  
                <p class="normal-text" style="font-family: Rubik Regular;color:#5F5C5C;white-space:pre-line">{{$blog->short_description}}</p>
                <div class="row m-0" style="padding-top:1.5vw">
                    <div class="col-4 ps-0">
                            <img  src="{{asset($blog->image)}}" class="img-fluid" style="width:100%;height:30vw;object-fit:cover" alt="">
                    </div>
                    <div class="col-8">
                    <div class="normal-text" style="font-family: Rubik Regular;color:#5F5C5C;white-space:pre-line">{!!$blog->body!!}</div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END OF ARTICLE BODY -->



@endsection