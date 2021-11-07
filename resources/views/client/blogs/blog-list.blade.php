@extends('./layouts/client-main')
@section('title', 'Venidici Blogs')

@section('content')


<!-- START OF FILTER SECTION -->
<div class="row m-0 page-container" style=";padding-top:11vw">
    <div class="col-12 p-0">
        <p class="medium-heading" style="font-family: Rubik Medium;color:#2B6CAA;margin-bottom:2vw">Epxlore venidici blog</p>
        <div style="display:flex;align-items:center">
            <div  class="grey-input-form" style="display: flex;align-items:center">
                <form action="">
                <img src="/assets/images/icons/course-title-icon.png" style="width:auto;height:1vw" class="img-fluid" alt="">
                <input  name="search" value="{{ Request::get('search') }}" type="search" class="normal-text typeahead" autocomplete="off"
                    style="background:transparent;border:none;margin-left:1vw;color: rgba(0, 0, 0, 0.5);width:15vw;font-family:Rubik Regular" placeholder="Search Article">
                @if (Request::get('show'))
                    <input name="show" value="{{ Request::get('show') }}" hidden>
                @endif
            </div>
            <div style="margin-left: 1vw;">
                <button type="submit" onclick="openLoading()" class="btn-search normal-text"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div style="margin-left: 3vw;">
                <div class="grey-input-form" style="display: flex;align-items:center;width:100%">
                    <select name="" class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%;font-family:Rubik Regular;"  onchange="if (this.value) window.location.href=this.value">
                        <option value="None" disabled selected>Sort</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" @if (Request::get('sort') == 'latest') selected @endif>Latest</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" @if (Request::get('sort') == 'oldest') selected @endif>Oldest</option>
                    </select>                    
                    @error('')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  
            </div>

        </div>
    </div>
</div>
<!-- END OF FILTER SECTION -->

<!-- START OF BLOG SECTION -->
<div class="row m-0 page-container" style=";padding-top:2vw">
    <div class="col-12 p-0">
    @if(count($blogs) == 0)
        <div style="background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
            <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Tidak ditemukan.</span></p>
        </div>
    @endif
    @foreach($blogs as $blog)
        <!-- START OF ONE ARTICLE CARD -->
        <div style="padding-top:4vw;" class="row m-0">
            <div class="col-lg-8 col-xs-12 ps-0" style="padding-right:2vw">
                <a href="/blog/{{$blog->id}}" class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;text-decoration:none;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">{{$blog->title}}</a>
                <p class="normal-text" style="margin-top:1vw;font-family: Rubik Regular;color:#3B3C43;display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important">{{$blog->short_description}}</p>
                <div style="display:flex;align-items:center">
                    <p class="small-text" style="font-family: Rubik Regular;color:#B3B5C2;">{{$blog->created_at->diffForHumans()}} - {{$blog->duration}} mins read</p>
                </div>
                <a class="small-text" style="font-family: Rubik Regular;color:#B3B5C2;background-color:#67BBA3;color:#000000;padding:0.5vw 1vw;text-decoration:none;border-radius:5px">{{ $blog->hashtag->hashtag }}</a>
            </div>
            <div class="col-lg-4 col-xs-12 mobile-display">
                <img onclick="window.open('/blog/'+{{$blog->id}}, '_self');" src="{{ asset($blog->banner) }}" class="img-fluid" style="cursor:pointer;width:100% !important;height:12vw;object-fit:cover" alt="">
            </div>
        </div>
        <!-- END OF ONE ARTICLE CARD -->
        @endforeach
    </div>
</div>
<!-- END OF BLOG SECTION -->
@endsection