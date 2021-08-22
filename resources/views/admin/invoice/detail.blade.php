@extends('layouts/admin-main')

@section('title', 'Venidici Invoice Detail')

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
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="mb-0 mb-3 text-gray-800">Invoice Detail</h1>
        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->
                    <!--<h1 class="h3 mb-2 text-gray-800 d-inline">Testimony List</h1>-->

                    <div class="row m-0" style="">
                        <div class="col-8 p-0" style="">
                            <div class="" style="padding-top:3vw;padding-right:9vw">
                                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Isi Keranjang</p>
                                <!-- START OF ITEM LIST -->

                                    @foreach($orders as $cart)

                                    @if($cart->course->course_type_id == 1)
                                    <!-- ONE COURSE CARD -->
                                    <div style="display:flex;margin-top:1vw" class="cartpage">
                                        <input type="hidden" name="product_id" class="product_id normal-text" value="{{$cart->course_id}}" style="font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">

                                        <div class="cart-card-grey">
                                            <div style="display:flex;align-items:center;width:70%">
                                                <img src="/{{$cart->course->thumbnail}}" style="width:7vw;height:7vw;object-fit:cover;border-radius:10px;" class="img-fluid" alt="COURSE THUMBNAIL">
                                                <div style="margin-left:1vw">
                                                    <div style="display:flex;align-items:flex-start;width:18vw; ">
                                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;   line-height: 1.4vw;">{{$cart->course->title}}</p>
                                                    </div>
                                                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Kelas oleh
                                                    @foreach($cart->course->teachers as $teacher)
                                                        @if(($loop->last )&& (count($cart->course->teachers) != 1 ))
                                                        dan
                                                        @elseif(!$loop->first)
                                                        ,
                                                        @endif
                                                        {{$teacher->name}}
                                                    @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                            <div style="display:flex;align-items:center">
                                                <div style="width:7.5vw;text-align:right">
                                                    @if($cart->course->price == 0)
                                                    <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">FREE</p>
                                                    @else
                                                    <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($cart->course->price, 0, ',', ',') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END OF ONE COURSE CARD -->
                                    @else
                                    <!-- ONE WOKI CARD -->
                                    <div style="display:flex;margin-top:1vw">
                                        <div class="cart-card-grey">
                                            <div style="display:flex;align-items:center;width:70%">
                                                <img src="{{asset($cart->course->thumbnail)}}" style="width:7vw;height:7vw;object-fit:cover;border-radius:10px;" class="img-fluid" alt="COURSE THUMBNAIL">
                                                <div style="margin-left:1vw">
                                                    <div style="display:flex;align-items:flex-start;width:18vw; ">
                                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;line-height: 1.4vw;">{{$cart->course->title}}</p>
                                                        @if($cart->withArtOrNo)
                                                        <i style="color:#2B6CAA;margin-left:1vw" role="button"  aria-controls="woki-collapse-{{$cart->id}}" data-toggle="collapse" href="#woki-collapse-{{$cart->id}}" class="fas fa-caret-down small-heading"></i>
                                                        @endif
                                                    </div>
                                                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Kelas oleh
                                                    @foreach($cart->course->teachers as $teacher)
                                                        @if(($loop->last )&& (count($cart->course->teachers) != 1 ))
                                                        dan
                                                        @elseif(!$loop->first)
                                                        ,
                                                        @endif
                                                        {{$teacher->name}}
                                                    @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                            <div style="display:flex;align-items:center">
                                                @if ($cart->withArtOrNo)
                                                    <div style="display:flex;align-items:center;margin-right:2vw" class="quantity">
                                                        <p style="margin-bottom:0px;font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">
                                                        {{$cart->qty}}
                                                        </p>
                                                    </div>
                                                @endif
                                                <div style="width:7.5vw;text-align:right">
                                                    @if($cart->course->course_type_id == 3)
                                                        @if($cart->course->bootcampCourseDetail->bootcamp_trial_price == 0)
                                                        <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">FREE</p>
                                                        @else
                                                        <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($cart->course->bootcampCourseDetail->bootcamp_trial_price, 0, ',', ',') }}</p>
                                                        @endif
                                                    @else
                                                    @if($cart->withArtOrNo)
                                                    <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($cart->course->priceWithArtKit, 0, ',', ',') }}</p>

                                                    @elseif($cart->course->price == 0)
                                                    <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">FREE</p>
                                                    @else
                                                    <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($cart->course->price, 0, ',', ',') }}</p>
                                                    @endif

                                                    @endif
                                                </div>                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse" id="woki-collapse-{{$cart->id}}" style="margin-top:1vw;margin-left:3vw">
                                    @foreach($cart->course->artSupplies as $supply)
                                        <!-- START OF ONE ITEM COLLAPSE -->
                                        <div style="display:flex;align-items:center;margin-top:1.5vw">
                                            <i style="color:#2B6CAA" class="fas fa-circle normal-text"></i>
                                            <img src="{{asset($supply->image)}}" style="width:7vw;object-fit:cover;border-radius:10px;margin-left:1vw" class="img-fluid" alt="COURSE THUMBNAIL">
                                            <div style="margin-left:1vw">
                                                <p class="normal-text" style="font-family:Rubik Bold;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;margin-bottom:0.5vw">{{$supply->name}}</p>
                                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{$supply->description}}</p>
                                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Quantity: <span style="font-family:bold">{{$cart->qty}}</span></p>
                                            </div>
                                        </div>
                                        <!-- END OF ONE ITEM COLLAPSE -->
                                        @endforeach
                                    </div>
                                    <!-- END OF ONE WOKI CARD -->
                                    @endif
                                    @endforeach
                                <!-- END OF ITEM LIST -->

                            </div>

                        </div>  
                        <div class="col-4 p-0 ">
                            <div class="" style="padding-top:3vw"> 
                                @if (session('message'))
                                    <!-- ALERT MESSAGE -->
                                    <div class="alert alert-warning alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                                        {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <!-- END OF ALERT MESSAGE -->
                                @endif
                                <div style="display:flex;align-items:center">
                                    <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Status</p>   
                                    <a href="">
                                        <div id="refresh-button" style="padding:0.3vw 0.5vw;margin-left:0.5vw;border-radius:10px;">
                                            <i class="fas fa-redo-alt normal-text" style="color:#2B6CAA"></i>
                                        </div>         
                                    </a>
                                </div>       
                                <!-- START OF STATUS CARD -->
                                <div style="background: @if($invoice->status == 'pending') #F4C257 @elseif($invoice->status == 'cancelled') #F7F7F9 @else #67BBA3 @endif;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:0.5vw 1.5vw;margin-top:1vw;text-align:center">
                                    @if($invoice->status == 'pending')
                                    <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px"><i class="far fa-clock"></i> <span style="margin-left:1vw">Menunggu Pembayaran</span></p>
                                    @elseif($invoice->status == 'paid')
                                    <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px"><i class="fas fa-check"></i><span style="margin-left:1vw">Pembayaran Diterima</span></p>
                                    @elseif($invoice->status == 'completed')
                                    <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Pembayaran Berhasil</p>
                                    @elseif($invoice->status == 'failed')
                                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px"><i class="far fa-window-close"></i> <span style="margin-left:1vw">Pembelian Gagal</span></p>
                                    
                                    @elseif($invoice->status == 'expired')
                                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px"><i class="far fa-window-close"></i> <span style="margin-left:1vw">Pembelian Kadaluarsa</span></p>
                                    @elseif($invoice->status == 'cancelled')
                                        <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px"><i class="far fa-window-close"></i> <span style="margin-left:1vw">Pembelian Dibatalkan</span></p>
                                    @endif
                                </div>
                                <!-- END OF STATUS CARD -->

                                @if($payment_object['data']['attributes']['paymentMethod']['type'] != 'qris')
                                    <!-- START OF ONE PAYMENT METHOD -->
                                    <div style="display:flex;margin-top:2vw">

                                        <div class="payment-method-card-active-left" style="width:100%" >
                                            <div style="display:flex;justify-content:space-between;align-items:center">
                                                <div style="display:flex;align-items:center">
                                                    <div>
                                                        <p class="small-text" style="margin-bottom:0.5vw;font-family:Rubik Medium;color:#3B3C43">Bank {{$payment_object['data']['attributes']['paymentMethod']['instructions']['bankShortCode']}} ( Virtual Account)</p>
                                                        <p class="sub-description" style="font-family:Rubik Medium;color:#074EE8;margin-bottom:0px">{{$payment_object['data']['attributes']['paymentMethod']['instructions']['accountNo']}}</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="payment-method-card-active-right" style="display: flex;flex-direction: column;justify-content: center;" >
                                            <a href="#pembayaran-va">
                                                <i class="fas fa-question-circle sub-description" style="color:#FFFFFF;"></i>
                                            </a>
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- END OF ONE PAYMENT METHOD --> 
                                @else
                                    <!-- START OF QR PAYMENT METHOD -->
                                    <div style="display:flex;margin-top:2vw">

                                        <div class="payment-method-card-active-left" style="width:100%;border-radius: 10px !important" >
                                            <div style="text-align: center;">
                                                <p class="small-text" style="margin-bottom:1vw;font-family:Rubik Medium;color:#3B3C43">QRIS Payment</p>
                                                <div style="display:flex;justify-content:center">
                                                    <img src="{{$payment_object['data']['attributes']['paymentMethod']['instructions']['imageUrl']}}" style="width:12vw" alt="" class="img-fluid">                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- END OF QR PAYMENT METHOD -->  
                                @endif

                                @if($cart->withArtOrNo)
                                <!-- START OF SHIPPING ADDRESS -->
                                <div style="background: #FFFFFF;border: 2px solid #3B3C43;border-radius: 10px;padding:1vw;margin-top:2vw">
                                    <div style="display:flex;align-items:center">
                                        <i class="fas fa-map-marker-alt sub-description" style="color:#2B6CAA"></i>
                                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px;padding-left:1vw">{{$invoice->address}}</p>
                                    </div>
                                </div>
                                <!-- END OF SHIPPING ADDRESS -->   
                                @endif
                                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:2vw">Ringkasan Pembayaran</p>            
                                <!-- START OF NOMINAL CARD -->
                                <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:1vw">
                                    <div style="display:flex;justify-content:space-between;align-items:center">
                                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Sub total</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($invoice->total_order_price, 0, ',', ',') }}</p>
                                    </div>
                                    @if(!$noWoki)
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw">
                                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Shipping cost</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($invoice->cost_courier, 0, ',', ',') }}</p>
                                    </div>
                                    @endif
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw">
                                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Diskon Venidici Club</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">- Rp {{ number_format($invoice->club_discount, 0, ',', ',') }}</p>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;border-bottom:2px solid #2B6CAA;padding-bottom:1.5vw">
                                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher</p>
                                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">- Rp {{ number_format($invoice->discounted_price, 0, ',', ',') }}</p>
                                    </div>
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;">
                                        <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Total</p>
                                        <p class="bigger-text" style="font-family:Rubik Medium;color:#2B6CAA;margin-bottom:0px">Rp {{ number_format($invoice->grand_total, 0, ',', ',') }}</p>
                                    </div>
                                    @if($invoice->status == 'paid' || $invoice->status == 'completed')

                                    <div style="display:flex;justify-content:flex-end;align-items:center;">
                                        @php
                                        $star_mulitiplication = (int)($invoice->grand_total/30000);
                                        $star_added = $star_mulitiplication*12;
                                        @endphp
                                        <p class="normal-text" style="font-family:Rubik Regular;color:#2B6CAA;margin-bottom:0px">(+{{$star_added}} Stars)</p>
                                    </div>
                                    @endif
                                </div>
                                <!-- END OF NOMINAL CARD --> 

                            
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
