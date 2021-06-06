@extends('./layouts/client-main')
@section('title', 'Venidici Redeem Voucher')

@section('content')

<div class="row m-0 page-container" style="padding-bottom:4vw;padding-top:11vw">

    <!-- START OF MY VOUCHERS -->
    <div class="col-12 p-0" >
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">Voucher saya</p>
    </div>
    @if(count($my_vouchers) == 0)
        
            <div style="margin-top:2vw;background: #C4C4C4;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;text-align:center">
                <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"> <i class="fas fa-exclamation-triangle"></i> <span style="margin-left:1vw">Voucher belum tersedia.</span></p>
            </div>
        @endif

    @foreach($my_vouchers as $promo)
        <!-- START OF ONE ACTIVE VOUCHER -->
        @if($loop->iteration % 3 == 1)
            <div class="col-4 p-0" style="display:flex; justify-content:flex-start">
        @elseif($loop->iteration % 3 == 2)
            <div class="col-4 p-0" style="display:flex; justify-content:center">
        @elseif($loop->iteration % 3 == 0)
            <div class="col-4 p-0" style="display:flex; justify-content:flex-end">
        @endif

            <div class="
                @if(!$promo->isActive)
                voucher-card-claimed
                @elseif($current_year_date > $promo->finish_date)
                voucher-card-expired
                @else
                voucher-card-active
                @endif
            " style="">
                <div id="left-bar" style="width:1vw;border-radius:10px 0px 0px 10px">
                </div>
                <div style="width:22vw;padding:1.5vw">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43">
                        @if($promo->promo_for == 'charity')
                        Donate
                        @else
                        Diskon
                        @endif
                        @if($promo->type == 'percent')
                        {{$promo->discount}}% 
                        @else
                        Rp{{ number_format($promo->discount, 0, ',', ',') }}
                        @endif 
                        </p>              
                        <p class="small-text" style="font-family: Rubik Regular;color:#C4C4C4;">
                        @if(!$promo->isActive)
                        {{$promo->updated_at->diffForHumans()}}
                        @elseif($current_year_date > $promo->finish_date)
                        Expired
                        @else
                        {{$promo->finish_date}}
                        @endif
                        </p>
                    </div>
                    <div style="display:flex">
                        <p class="normal-text" id="card-color" style="font-family: Rubik Regular;border-radius:10px;padding:0.2vw 1vw">
                        @if(!$promo->isActive)
                        CLAIMED
                        @else
                        {{$promo->code}}
                        @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF ONE ACTIVE VOUCHER -->
    @endforeach

    <!-- END OF MY VOUCHERS -->




    <!-- START OF REDEEM RULES -->
    <div class="col-12 p-0" style="margin-top:4vw">
        @if (session()->has('redeem_success'))
            <div class="col-12 " style="margin-bottom:1vw">
                <div class="mb-0">
                    <div class="alert alert-primary alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                        {{ session()->get('redeem_success') }}
                    </div>
                </div>
            </div>
        @elseif (session()->has('redeem_failed'))
            <div class="col-12 " style="margin-bottom:1vw">
                <div class="mb-0">
                    <div class="alert alert-warning alert-dismissible fade show m-0 normal-text" style="font-family:Rubik Regular" role="alert" >
                        {{ session()->get('redeem_failed') }}
                    </div>
                </div>
            </div>
        @endif
        <p class="medium-heading" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">Redeem Voucher</p>
        <!-- START OF CAROUSEL -->
        <div id="redeem-carousel" style="margin-top:2vw" class="carousel slide" data-interval="5000" data-ride="carousel">
            <div class="carousel-inner" style="padding: 0vw 2vw;">
                @php $card_counter = 0; @endphp
                @foreach ($redeem_rules as $rule)
                    @php $card_counter++; @endphp
                    
                    @if ($loop->first)
                        <div class="carousel-item active">
                            <div class="row m-0" style="padding:0vw 2vw">
                    @elseif ($card_counter == 1)
                        <div class="carousel-item">
                            <div class="row m-0" style="padding:0vw 2vw">
                    @endif

                    <!-- START OF ONE REDEEM  CARD -->
                    <div class="col-3" style="display:flex;justify-content:center">
                        <div class="redeem-card-blue" style="padding:1.5vw;width:20vw">
                            <div style="text-align:center">
                                <img src="/assets/images/client/redeem_voucher.png" class="img-fluid" style="width:7vw" alt="">
                            </div>
                            <p class="bigger-text" style="font-family: Rubik Bold;color:#3B3C43;margin-top:2vw;margin-bottom:0px">
                            @if($rule->promo_for == 'charity')
                            Donate
                            @else
                            Diskon
                            @endif 

                            @if($rule->type == 'percent')
                            {{$rule->discount}}% 
                            @else
                            Rp{{ number_format($rule->discount, 0, ',', ',') }}
                            @endif 
                            </p>
                            <div style="display:flex;align-items:center;margin-top:0.5vw">
                                <p class="very-small-text" style="font-family: Rubik Regular;color:#55525B;">Exp. date</p>
                                <p class="very-small-text" style="font-family: Rubik Regular;color:#55525B;margin-left:1vw">{{$next_year_date}}</p>
                            </div>
                            <hr style="height:0.2vw;background:#2B6CAA;margin:0px">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:1vw;">
                                <p class="bigger-text" style="font-family: Rubik Medium;color:#3B3C43;margin-bottom:0px">{{ $rule->stars }} Stars</p>
                                <form action="{{route('customer.redeemPromo')}}" method="post">
                                @csrf
                                    <input type="hidden" name="redeem_id" value="{{$rule->id}}"> 
                                    <button type="submit" class="normal-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;padding:0.2vw 1vw !important">Redeem</button>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <!-- END OF ONE  REDEEM CARD -->

                    @if ($loop->last || $card_counter == 4)
                            </div>
                        </div>
                    @endif

                    @php
                        $new_carousel_item = false;
                        if ($card_counter == 4) $card_counter = 0;
                    @endphp
                @endforeach
            </div>
            <a class="carousel-control-prev"   data-bs-target="#redeem-carousel" style="width:2vw" role="button"data-bs-slide="prev">
                <i class="fas fa-arrow-left big-heading" id="carousel-control-right-menu-image" style="width:1vw;z-index:99;margin-right:0px;color:rgba(43, 108, 170, 0.5);" alt="PREV"></i>

                <span class="visually-hidden">Prev</span>
            </a>
            <a class="carousel-control-next"   data-bs-target="#redeem-carousel" style="width:2vw" role="button"data-bs-slide="next">
                <i class="fas fa-arrow-right big-heading" style="width:1vw;z-index:99;margin-right:0px;color:rgba(43, 108, 170, 0.5);" alt="NEXT"></i>
                <span class="visually-hidden">Next</span>
            </a>
        </div> 
        <!-- END OF CAROUSEL -->
    </div>
    <!-- END OF REDEEM RULES -->
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

@endsection