@extends('./layouts/client-main')
@section('title', 'Venidici Transaction Detail')

@section('content')

<!-- START OF POPUP POINT EXPLANATION-->
<div id="pembayaran-va" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:50% !important">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12" style="text-align:left;">
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;">Cara Pembayaran Virtual Account</p>
                    <div >
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">1. Pilih m-Transfer dan pilih BCA Virtual Account.</p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">2. Masukan nomor Virtual Account <span style="font-family:Rubik Medium;color:#074EE8">{{$payment_status['data']['attributes']['paymentMethod']['instructions']['accountNo']}}</span>  dan pilih send. </p>
                        <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">3. Pastikan total tagihan dari BCA Virtual Account sesuai dengan <span style="font-family:Rubik Medium;color:#074EE8"> total pembayaran</span> di halaman ini. Pastikan juga Merchant bernama <span style="font-family:Rubik Medium;color:#074EE8">{{$payment_status['data']['attributes']['paymentMethod']['instructions']['displayName']}}</span>. Jika semua sudah benar, pilih Yes/Ya.</p>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF POPUP POINT EXPLANATION-->

<div class="row m-0" style="padding-bottom:4vw;padding-top:11vw">
    <div class="col-12 p-0" style="padding-bottom:3vw">
        <div class="page-container">
            <img src="/assets/images/client/xfers_logo_alt.png" class="img-fluid" style="width:18vw" alt="">         
        </div>
    </div>
    <div class="col-8 p-0" style="">
        <div class="page-container-left" style="padding-top:3vw;padding-right:9vw">
            @if($payment_status['data']['attributes']['status'] == 'pending')

            <!-- ALERT MESSAGE -->
            <div class="alert alert-dismissible fade show small-text"  style="font-family:Rubik Medium;width:100%;text-align:center;margin-bottom:0px;color:#3B3C43;background-color:#EBF5FF"role="alert">
                <div style="display:flex;align-items:center">
                    <i class="fas fa-exclamation-triangle small-heading" style="color:#F4C257"></i>
                    <?php
                        $date = explode('T', $payment_status['data']['attributes']['expiredAt']);
                        $time = explode('+', $date[1]);
                    ?>
                    <p style="margin-bottom:0px;margin-left:1vw">
                        Hai, Gabriel. Harap selesaikan pembayaran sebelum {{$date[0]}} {{$time[0]}} atau proses pembayaran akan ditutup. Terima kasih.            
                    </p>
                </div>
            </div>
            <!-- END OF ALERT MESSAGE -->
            @endif
            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43; @if($payment_status['data']['attributes']['status'] == 'pending') margin-top:3vw @endif">Isi Keranjang</p>
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
                                <div style="display:flex;align-items:flex-start">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;width:18vw;    line-height: 1.4vw;">{{$cart->course->title}}</p>
                                </div>
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Mr. Raditya Dika</p>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center">
                            <div style="display:flex;align-items:center;margin-right:2vw" class="quantity">
                                <p style="margin-bottom:0px;font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">
                                {{$cart->qty}}
                                </p>
                            </div>
                            <div style="width:7.5vw">
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
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:7vw;height:7vw;object-fit:cover;border-radius:10px;" class="img-fluid" alt="COURSE THUMBNAIL">
                            <div style="margin-left:1vw">
                                <div style="display:flex;align-items:flex-start">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;width:18vw;    line-height: 1.4vw;">Ini adalah judul pelatihan yang ada panjangnya sampe 3 baris ke bawah seperti ini</p>
                                    <i style="color:#2B6CAA;margin-left:1vw" role="button"  aria-controls="woki-collapse-three" data-toggle="collapse" href="#woki-collapse-three" class="fas fa-caret-down small-heading"></i>
                                </div>
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Mr. Raditya Dika</p>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center">
                                <div style="display:flex;align-items:center;margin-right:2vw" class="quantity">
                                <div class="input-group-append increment-btn changeQuantity" style="cursor: pointer">                                    
                                    <i class="fas fa-plus" style="margin-right:0.5vw;color:#C4C4C4"></i>
                                </div>
                                <input type="text" name="qty" class="qty-input normal-text" value="1" style="font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">
                                <div class="input-group-prepend decrement-btn changeQuantity" style="cursor: pointer">

                                    <i class="fas fa-minus" style="margin-left:0.5vw;color:#C4C4C4"></i>
                                </div>
                                
                            </div>
                            <div style="width:7.5vw">
                                @if($course->price == 0)
                                <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">FREE</p>
                                @else
                                <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($course->price, 0, ',', ',') }}</p>
                                @endif
                            </div>                        
                        </div>
                    </div>
                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                        
                        <div class="cart-card-red" style="height:100%">
                            <form action="" method="post">
                                @csrf
                                @method('delete')
                                    <button style="background:none;border:none;color:#FFFFFF" class="bigger-text" type="submit" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash-alt"></i></button>
                            </form> 
                        </div>
                    </div>
                </div>
                <div class="collapse" id="woki-collapse-three" style="margin-top:1vw;margin-left:3vw">
                    <!-- START OF ONE ITEM COLLAPSE -->
                    <div style="display:flex;align-items:center;margin-top:1.5vw">
                        <i style="color:#2B6CAA" class="fas fa-circle normal-text"></i>
                        <img src="/assets/images/client/Art_Supply_Dummy.png" style="width:7vw;object-fit:cover;border-radius:10px;margin-left:1vw" class="img-fluid" alt="COURSE THUMBNAIL">
                        <div style="margin-left:1vw">
                            <p class="normal-text" style="font-family:Rubik Bold;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;margin-bottom:0.5vw">Art supply for the course</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">1 Book, 5 type of brushes, paint pallete</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Quantity: <span style="font-family:bold">1</span></p>
                        </div>
                    </div>
                    <!-- END OF ONE ITEM COLLAPSE -->
                    <!-- START OF ONE ITEM COLLAPSE -->
                    <div style="display:flex;align-items:center;margin-top:1.5vw">
                        <i style="color:#2B6CAA" class="fas fa-circle normal-text"></i>
                        <img src="/assets/images/client/Art_Supply_Dummy.png" style="width:7vw;object-fit:cover;border-radius:10px;margin-left:1vw" class="img-fluid" alt="COURSE THUMBNAIL">
                        <div style="margin-left:1vw">
                            <p class="normal-text" style="font-family:Rubik Bold;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;margin-bottom:0.5vw">Art supply for the course</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">1 Book, 5 type of brushes, paint pallete</p>
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Quantity: <span style="font-family:bold">1</span></p>
                        </div>
                    </div>
                    <!-- END OF ONE ITEM COLLAPSE -->
                </div>
                <!-- END OF ONE WOKI CARD -->
                @endif
                @endforeach
            <!-- END OF ITEM LIST -->

            <!-- START OF PAYMENT INSTRUCTION
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw;">
                <div style="">
                    <div style="display:flex;justify-content:space-between">
                        <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Cara Pembayaran Virtual Account</p>            
                        <p data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-chevron-down"></i>
                        </p>
                    </div>
                    <div class="collapse" id="collapseExample" style="padding-top:1vw">
                        <div class="">
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">1. Pilih m-Transfer dan pilih BCA Virtual Account.</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">2. Masukan nomor Virtual Account <span style="font-family:Rubik Medium;color:#074EE8">{{$payment_status['data']['attributes']['paymentMethod']['instructions']['accountNo']}}</span>  dan pilih send. </p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">3. Pastikan total tagihan dari BCA Virtual Account sesuai dengan <span style="font-family:Rubik Medium;color:#074EE8"> total pembayaran</span> di halaman ini. Pastikan juga Merchant bernama <span style="font-family:Rubik Medium;color:#074EE8">{{$payment_status['data']['attributes']['paymentMethod']['instructions']['displayName']}}</span>. Jika semua sudah benar, pilih Yes/Ya.</p>
                        </div>
                    </div>
                </div>
            </div>
             END OF PAYMENT INSTRUCTION -->
        </div>

    </div>  
    <div class="col-4 p-0 ">
        <div class="page-container-right" style="padding-top:3vw"> 
            <div style="display:flex;align-items:center">
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Status</p>   
                <a href="">
                    <div id="refresh-button" style="padding:0.3vw 0.5vw;margin-left:0.5vw;border-radius:10px;">
                        <i class="fas fa-redo-alt normal-text" style="color:#2B6CAA"></i>
                    </div>         
                </a>
            </div>       
            <!-- START OF STATUS CARD -->
            <div style="background: @if($payment_status['data']['attributes']['status'] == 'pending') #F4C257 @elseif($payment_status['data']['attributes']['status'] == 'cancelled') #F7F7F9 @else #67BBA3 @endif;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1vw 1.5vw;margin-top:1vw;text-align:center">
                @if($payment_status['data']['attributes']['status'] == 'pending')
                <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px"><i class="far fa-clock"></i> <span style="margin-left:1vw">Menunggu Pembayaran</span></p>
                @elseif($payment_status['data']['attributes']['status'] == 'paid')
                <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px"><i class="fas fa-check"></i><span style="margin-left:1vw">Pembayaran Diterima</span></p>
                @elseif($payment_status['data']['attributes']['status'] == 'completed')
                <p class="bigger-text" style="font-family:Rubik Medium;color:green;margin-bottom:0px">Pembelian Selesai</p>
                
                @elseif($payment_status['data']['attributes']['status'] == 'cancelled')
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px"><i class="far fa-window-close"></i> <span style="margin-left:1vw">Pembelian Dibatalkan</span></p>
                @endif
            </div>
            <!-- END OF STATUS CARD -->       

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:3vw">Virtual Account Number</p>       
            <!-- START OF ONE PAYMENT METHOD -->
            <div style="display:flex">

                <div class="payment-method-card-active-left" style="width:100%" >
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div style="display:flex;align-items:center">
                            <div>
                                <p class="normal-text" style="margin-bottom:0.5vw;font-family:Rubik Medium;color:#3B3C43">Bank {{$payment_status['data']['attributes']['paymentMethod']['instructions']['bankShortCode']}} ( Virtual Account)</p>
                                <p class="sub-description" style="font-family:Rubik Medium;color:#074EE8;margin-bottom:0px">{{$payment_status['data']['attributes']['paymentMethod']['instructions']['accountNo']}}</p>
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
            <div style="text-align:center;margin-top:1vw">  
                <form action="{{route('customer.cart.cancelPayment',$invoice->xfers_payment_id)}}" method="POST">
                @csrf
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"><span> <button type="submit" style="border:none;background:none;color:blue">Click here</button> </a> </span> to cancel the payment </p>
                </form> 
            </div>
           
            <!-- END OF ONE PAYMENT METHOD -->     

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:3vw">Ringkasan Pembayaran</p>            
            <!-- START OF NOMINAL CARD -->
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:1vw">
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Sub total</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($invoice->total_order_price, 0, ',', ',') }}</p>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Shipping cost</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($invoice->cost_courier, 0, ',', ',') }}</p>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;border-bottom:2px solid #2B6CAA;padding-bottom:1.5vw">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($invoice->discounted_price, 0, ',', ',') }}</p>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;">
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Total</p>
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($invoice->grand_total, 0, ',', ',') }}</p>
                </div>
            </div>
            <!-- END OF NOMINAL CARD --> 
           
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

@endsection