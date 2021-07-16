@extends('./layouts/client-main')
@section('title', 'Venidici Cart')

@section('content')


<div class="row m-0" style="padding-bottom:4vw">
    
    <div class="col-md-8 col-xs-12 p-0" style="">
        <div class="page-container-left " style="padding-top:11vw;padding-right:5vw">
            <div class="" style="display:flex;justify-content:space-between;align-items:center">
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Keranjang</p>
                <p class="small-text" style="font-family:Rubik Regular;color:#CE3369;">*Please check your cart and complete the Shipping Details form before payment</p>
            </div>
            <p class="small-text mobile-cart-display" style="font-family:Rubik Regular;color:#CE3369;display:none">*Please check your cart and complete the Shipping Details form before payment</p>

            <!-- ITEM SECTION -->
            @if(count($carts) == 0)
                <div>
                    <p class="sub-description" style="font-family:Rubik Regular;color:#3B3C43;">Tidak ada barang di keranjang.</p>
                </div>
            @endif
            @foreach($carts as $cart)
                {{-- Kalau online course (courseType == course) --}}
                @if($cart->course->course_type_id == 1)
                    <!-- ONE COURSE CARD -->
                    <div style="display:flex;margin-top:1vw" class="cartpage">
                        <input type="hidden" name="product_id" class="product_id normal-text" value="{{$cart->course_id}}" style="font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">
                        <div class="cart-card-grey">
                            <div style="display:flex;align-items:center;width:70%">
                                <img src="{{$cart->course->thumbnail}}" style="width:7vw;height:7vw;object-fit:cover;border-radius:10px;" class="img-fluid image-thumbnail" alt="COURSE THUMBNAIL">
                                <div style="margin-left:1vw">
                                    <div style="display:flex;align-items:flex-start">
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">{{$cart->course->title}}</p>
                                    </div>
                                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Kelas oleh
                                    @foreach($cart->course->teachers as $teacher)
                                        <span style="font-family:Rubik Bold">
                                            @if($loop->last && count($cart->course->teachers) != 1)
                                            dan
                                            @elseif(!$loop->first)
                                            ,
                                            @endif
                                            {{$teacher->name}}
                                        </span>
                                    @endforeach
                                    </p>
                                </div>
                            </div>
                            <div class="margin-right" style="display:flex;align-items:center">
                                <div  style="width:7.5vw;text-align:right">
                                    <p class="bigger-text text-nowrap mb-0"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($cart->price, 0, ',', ',') }}</p>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                            
                            <div class="cart-card-red" style="height:100%">
                                <form action="{{ route('customer.cart.remove', $cart->id) }}" method="post">
                                @csrf   
                                    <button style="background:none;border:none;color:#FFFFFF" class="bigger-text" type="submit" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash-alt"></i></button>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <!-- END OF ONE COURSE CARD -->
                {{-- Kalau woki course (courseType == woki) --}}
                @elseif ($cart->course->course_type_id == 2)
                    <!-- ONE WOKI CARD -->
                    <div style="display:flex;margin-top:1vw">
                        <div class="cart-card-grey">
                            <div style="display:flex;align-items:center;width:70%">
                                
                                <img src="{{asset($cart->course->thumbnail)}}" style="" class="img-fluid image-thumbnail" alt="COURSE THUMBNAIL">
                                <div style="margin-left:1vw">
                                    <div class="cart-title" style="">
                                        <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">{{$cart->course->title}}</p>
                                        @if($cart->withArtOrNo)
                                            <i style="color:#2B6CAA;margin-left:1vw" role="button" aria-controls="woki-collapse-{{$cart->id}}" 
                                                data-toggle="collapse" href="#woki-collapse-{{$cart->id}}" class="fas fa-caret-down small-heading"></i>
                                        @endif
                                    </div>
                                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Kelas oleh
                                    @foreach($cart->course->teachers as $teacher)
                                        <span style="font-family:Rubik Bold">
                                            @if($loop->last && count($cart->course->teachers) != 1)
                                            dan
                                            @elseif(!$loop->first)
                                            ,
                                            @endif
                                            {{$teacher->name}}
                                        </span>
                                    @endforeach
                                    </p>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center">
                                @if ($cart->withArtOrNo)
                                    <div style="display:flex;align-items:center;margin-right:2vw" class="quantity">
                                        <div class="input-group-append increment-btn changeQuantity" style="cursor: pointer">
                                            <form action="{{ route('customer.increaseQty') }}" method="POST">
                                            @csrf
                                            @method('put')
                                                <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                                <button type="submit" style="background:none;border:none">
                                                    <i class="fas fa-plus" style="margin-right:0.5vw;color:#C4C4C4"></i>
                                                </button>
                                            </form>                                    
                                        </div>
                                        <input type="text" name="qty" class="qty-input normal-text qty-width" value="{{$cart->quantity}}" style="font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">
                                        <div class="input-group-prepend decrement-btn changeQuantity" style="cursor: pointer">
                                        <form action="{{ route('customer.decreaseQty') }}" method="POST">
                                            @csrf
                                            @method('put')
                                                <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                                <button @if($cart->quantity == 1) disabled @endif type="submit" style="background:none;border:none">
                                                    <i class="fas fa-minus" style="margin-left:0.5vw;color:#C4C4C4"></i>
                                                </button>
                                            </form>  
                                        </div>
                                    </div>
                                @endif
                                <div class="margin-right" style="width:7.5vw;text-align:right;">
                                    <p class="bigger-text text-nowrap mb-0"  style="font-family:Rubik Medium;color:#3B3C43;">Rp. {{ number_format($cart->price, 0, ',', ',') }}</p>
                                </div>                        
                            </div>
                        </div>
                        <!--
                        <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                            <div class="cart-card-blue" style="height:100%">
                                <form action="" method="post">
                                    @csrf
                                    @method('delete')
                                        <button style="background:none;border:none;color:#FFFFFF" class="bigger-text" type="submit" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-edit"></i></button>
                                </form> 
                            </div>
                            <div class="cart-card-red" style="height:100%">
                                <form action="" method="post">
                                    @csrf
                                    @method('delete')
                                        <button style="background:none;border:none;color:#FFFFFF" class="bigger-text" type="submit" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash-alt"></i></button>
                                </form> 
                            </div>
                        </div>
                        -->
                        <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                            
                            <div class="cart-card-red" style="height:100%">
                                <form action="{{ route('customer.cart.remove', $cart->id) }}" method="post">
                                @csrf   
                                    <button style="background:none;border:none;color:#FFFFFF" class="bigger-text" type="submit" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash-alt"></i></button>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="woki-collapse-{{$cart->id}}" style="margin-top:1vw;margin-left:3vw">
                        @foreach($cart->course->artSupplies as $supply)
                            <!-- START OF ONE ITEM COLLAPSE -->
                            <div style="display:flex;align-items:center;margin-top:1.5vw">
                                <i style="color:#2B6CAA" class="fas fa-circle normal-text"></i>
                                <img src="{{asset($supply->image)}}" style="width:7vw;object-fit:cover;border-radius:10px;margin-left:1vw" class="img-fluid image-thumbnail" alt="COURSE THUMBNAIL">
                                <div style="margin-left:1vw">
                                    <p class="normal-text" style="font-family:Rubik Bold;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 2 !important;-webkit-box-orient: vertical !important;margin-bottom:0.5vw">{{$supply->name}}</p>
                                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">{{$supply->description}}</p>
                                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0.5vw">Quantity: <span style="font-family:bold">{{$cart->quantity}}</span></p>
                                </div>
                            </div>
                            <!-- END OF ONE ITEM COLLAPSE -->
                        @endforeach
                    </div>
                    <!-- END OF ONE WOKI CARD -->
                @endif
            @endforeach
            <!-- END OF ITEM SECTION -->
        </div>
    </div>  
    <div class="col-md-4 p-0 cart-background">
        <div class="page-container-right" style="padding-top:11vw">

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Ringkasan Pembayaran</p>
            @if(session('success'))
                <!-- ALERT MESSAGE -->
                <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
            @elseif(session('message')) 
                <!-- ALERT MESSAGE -->
                <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                    {{ session('message') }} <span> <a href="/dashboard#edit-profile">Click here</a> </span>to complete your profile
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
            @endif
            <!-- START OF NOMINAL CARD -->
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Total</p>
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">
                        Rp  <?php echo number_format($total_price, 0, ',', ',') ?>
                    </p>
                </div>
            </div>
            <!-- END OF NOMINAL CARD -->
            @if(count($carts) != 0)
            <div style="text-align:center">
            
                @if($noWoki)
                <button onclick="window.open('/payment','_self');" class="normal-text btn-blue-bordered btn-blue-bordered-active full-width-button" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:1.5vw;padding:0.5vw 2vw">Lanjut ke Pembayaran</button>
                @else
                <button onclick="window.open('/payment','_self');" class="normal-text btn-blue-bordered btn-blue-bordered-active full-width-button" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:1.5vw;padding:0.5vw 2vw">Lanjut ke Pengiriman</button>
                @endif
            </div>
            @endif
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>



@endsection