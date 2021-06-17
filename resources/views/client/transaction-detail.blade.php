@extends('./layouts/client-main')
@section('title', 'Venidici Transaction Detail')

@section('content')

@if($invoice->status == 'pending')
<!-- START OF POPUP VA EXPLANATION-->
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
<!-- END OF POPUP VA EXPLANATION-->
@endif
<!-- START OF POPUP COURSE CLAIMED -->
<div id="payment-success" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:35% !important">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12" style="text-align:center;">
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;">Course Claimed</p>
                    <img src="/assets/images/client/course_claimed.png" style="width:8vw" alt="">
                    <?php 
                    $courses_string = "";

                    $x = 1;
                    $length = count($invoice->orders);
                    foreach($invoice->orders as $order)
                    {
                        if($x == $length && $length != 1)
                            $courses_string = $courses_string." dan ";
                        
                        elseif($x != 1)
                            $courses_string = $courses_string.", ";
            
                        $courses_string = $courses_string.$order->course->title;
                        $x++;
                    }
                    
                    ?>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:1.5vw;margin-top:2vw">Course {{$courses_string}} has been added to your dashboard. You have claimed it for @if($invoice->grand_total == 0) FREE @else Rp{{ number_format($invoice->grand_total, 0, ',', ',') }} @endif.</p>
                    <a href="/dashboard" class="normal-text  btn-dark-blue" style="border:none;font-family: Rubik Medium;margin-bottom:0px;cursor:pointer;width:100%;;text-decoration:none">Go to my dashboard</a>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF POPUP COURSE CLAIMED -->

<!-- START OF POPUP COURSE BOUGHT -->
<div id="payment-created" class="overlay" style="overflow:scroll">
    <div class="popup" style="width:35% !important">
        <a class="close" href="#" >&times;</a>
        <div class="content" style="padding:2vw">
            <div class="row m-0">
                <div class="col-12" style="text-align:center;">
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;">Terimakasih atas pesanannya!</p>
                    <img src="/assets/images/client/course_claimed.png" style="width:8vw" alt="">
                    <?php 
                    $courses_string = "";

                    $x = 1;
                    $length = count($invoice->orders);
                    foreach($invoice->orders as $order)
                    {
                        if($x == $length && $length != 1)
                            $courses_string = $courses_string." dan ";
                        
                        elseif($x != 1)
                            $courses_string = $courses_string.", ";
            
                        $courses_string = $courses_string.$order->course->title;
                        $x++;
                    }
                    
                    ?>
                    <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:1vw;margin-top:2vw">Please complete your payment for the total of Rp{{ number_format($invoice->grand_total, 0, ',', ',') }} for Course: {{$courses_string}}.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF POPUP COURSE BOUGHT -->

<div class="row m-0" style="padding-bottom:4vw;padding-top:11vw">
    <div class="col-12 p-0" style="padding-bottom:3vw">
        <div class="page-container">
            <div style="display:flex;align-items:center">
                <img src="/assets/images/client/xfers_logo_alt.png" class="img-fluid" style="width:15vw" alt="">
                @if($invoice->status == 'pending')
         
                    <div style="margin-left:4vw">
                        <!-- ALERT MESSAGE -->
                        <div class="alert alert-dismissible fade show"  style="font-family:Rubik Medium;width:100%;text-align:center;margin-bottom:0px;color:#3B3C43;background-color:#EBF5FF"role="alert">
                            <div style="display:flex;align-items:center">
                                <i class="fas fa-exclamation-triangle sub-description" style="color:#CE3369"></i>
                                <?php
                                    $date = explode('T', $payment_status['data']['attributes']['expiredAt']);
                                    $time = explode('+', $date[1]);
                                ?>
                                <p style="margin-bottom:0px;margin-left:1vw" class="very-small-text">
                                    Selesaikan pembayaran anda sebelum  {{$date[0]}} {{$time[0]}} atau proses pembayaran akan ditutup.
                                </p>
                            </div>
                        </div>
                        <!-- END OF ALERT MESSAGE -->
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-8 p-0" style="">
        <div class="page-container-left" style="padding-top:3vw;padding-right:9vw">
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
                                <div style="display:flex;align-items:flex-start">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;width:18vw;    line-height: 1.4vw;">{{$cart->course->title}}</p>
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
                            @if($cart->course->course_type_id != 1)
                            <div style="display:flex;align-items:center;margin-right:2vw" class="quantity">
                                <p style="margin-bottom:0px;font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">
                                {{$cart->qty}}
                                </p>
                            </div>
                            @endif
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
            <div style="background: @if($invoice->status == 'pending') #F4C257 @elseif($invoice->status == 'cancelled') #F7F7F9 @else #67BBA3 @endif;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:0.5vw 1.5vw;margin-top:1vw;text-align:center">
                @if($invoice->status == 'pending')
                <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px"><i class="far fa-clock"></i> <span style="margin-left:1vw">Menunggu Pembayaran</span></p>
                @elseif($invoice->status == 'paid')
                <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px"><i class="fas fa-check"></i><span style="margin-left:1vw">Pembayaran Diterima</span></p>
                @elseif($invoice->status == 'completed')
                <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-bottom:0px">Pembayaran Berhasil</p>
                
                @elseif($invoice->status == 'cancelled')
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px"><i class="far fa-window-close"></i> <span style="margin-left:1vw">Pembelian Dibatalkan</span></p>
                @endif
            </div>
            <!-- END OF STATUS CARD -->       
            @if($invoice->status == 'pending')

            <!-- START OF ONE PAYMENT METHOD -->
            <div style="display:flex;margin-top:2vw">

                <div class="payment-method-card-active-left" style="width:100%" >
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div style="display:flex;align-items:center">
                            <div>
                                <p class="small-text" style="margin-bottom:0.5vw;font-family:Rubik Medium;color:#3B3C43">Bank {{$payment_status['data']['attributes']['paymentMethod']['instructions']['bankShortCode']}} ( Virtual Account)</p>
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
            
            <!-- END OF ONE PAYMENT METHOD -->  
            @endif
            @if(!$noWoki)
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

            @if($invoice->status == 'pending')

            <!-- CANCEL PAYMENT -->
            <div style="text-align:center;margin-top:1vw">  
                <form action="{{route('customer.cart.cancelPayment',$invoice->xfers_payment_id)}}" method="POST">
                @csrf
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"><span> <button type="submit" style="border:none;background:none;color:blue">Click here</button> </a> </span> to cancel the payment </p>
                </form> 
            </div>
           <!-- END OF CANCEL PAYMENT -->

            <!-- RECEIVE PAYMENT -->
            <div style="text-align:center;margin-top:1vw">  
                <form action="{{route('customer.cart.receivePayment',$invoice->xfers_payment_id)}}" method="POST">
                @csrf
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px"><span> <button type="submit" style="border:none;background:none;color:blue">Click here</button> </a> </span> to simulate payment </p>
                </form> 
            </div>
           <!-- END OF RECEIVE PAYMENT -->
           @endif
           
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

@endsection