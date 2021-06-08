@extends('./layouts/client-main')
@section('title', 'Venidici Shipping')

@section('content')


<form action="{{route('customer.cart.storeOrder')}}" method="POST">
    @csrf
    <!-- Modal VA -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Metode Pembayaran</p>
                <button type="button" class="close small-heading" data-dismiss="modal" aria-label="Close" style="background:none;border:none">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- START OF ONE PAYMENT METHOD -->
                <div class="payment-method-card bank-links" style="" id="payment_method_1"  onclick="togglePayment(event, 'checked_icon_1','bca')">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/client/BCA_LOGO.png" style="width:4vw;height:3vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="">
                            <p class="bigger-text payment-method-text" style="font-family:Rubik Regular;margin-bottom:0px;margin-left:1vw;">Bank BCA ( Virtual Account )</p>
                        </div>
                        <div id="checked_icon_1" class="bank-content" style="display:none">
                            <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                        </div>    
                    </div>
                </div>
                <!-- END OF ONE PAYMENT METHOD -->

                <!-- START OF ONE PAYMENT METHOD -->
                <div class="payment-method-card bank-links" style="margin-top:1vw" id="payment_method_2"  onclick="togglePayment(event, 'checked_icon_2','bri')">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/client/bri_logo.png" style="width:4vw;height:3vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="">
                            <p class="bigger-text payment-method-text" style="font-family:Rubik Regular;margin-bottom:0px;margin-left:1vw">Bank BRI ( Virtual Account )</p>
                        </div>
                        <div id="checked_icon_2" class="bank-content" style="display:none">
                            <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                        </div>                        
                    </div>
                </div>
                <!-- END OF ONE PAYMENT METHOD -->

                <!-- START OF ONE PAYMENT METHOD 
                <div class="payment-method-card bank-links" style="margin-top:1vw" id="payment_method_2"  onclick="togglePayment(event, 'checked_icon_3','BNI')">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/client/bni_logo.png" style="width:4vw;height:3vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="">
                            <p class="bigger-text payment-method-text" style="font-family:Rubik Regular;margin-bottom:0px;margin-left:1vw">Bank BNI ( Virtual Account )</p>
                        </div>
                        <div id="checked_icon_3" class="bank-content" style="display:none">
                            <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                        </div>                        
                    </div>
                </div>
                 END OF ONE PAYMENT METHOD -->
                
                <!-- START OF ONE PAYMENT METHOD -->
                <div class="payment-method-card bank-links" style="margin-top:1vw" id="payment_method_2"  onclick="togglePayment(event, 'checked_icon_4','mandiri')">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/client/mandiri_logo.png" style="width:4vw;height:3vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="">
                            <p class="bigger-text payment-method-text" style="font-family:Rubik Regular;margin-bottom:0px;margin-left:1vw">Bank Mandiri ( Virtual Account )</p>
                        </div>
                        <div id="checked_icon_4" class="bank-content" style="display:none">
                            <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                        </div>                        
                    </div>
                </div>
                <!-- END OF ONE PAYMENT METHOD -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-family:Poppins Medium;padding:0.5vw 2vw">Batal</button>
                @if($noWoki)
                <button type="submit" name="action" value="createPaymentObjectWithNoWoki" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Konfirmasi</button>                
                @else
                <button type="submit" name="action" value="createPaymentObject" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Konfirmasi</button>                
                @endif
            </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL VA -->

    <!-- START OF PAGE CONTENT -->
    <div class="row m-0 shipping-background" style="padding-bottom:4vw">
        
        <div class="col-8 p-0" style="">
            <div class="page-container-left" style="padding-top:11vw;padding-right:9vw">
                @if($noWoki)
                <!-- START OF COURSES -->
                @foreach($carts as $cart)

                @if($cart->course->course_type_id == 1)
                <!-- ONE COURSE CARD -->
                <div style="display:flex;margin-top:1vw" class="cartpage">
                    <input type="hidden" name="product_id" class="product_id normal-text" value="{{$cart->course_id}}" style="font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">

                    <div class="cart-card-grey">
                        <div style="display:flex;align-items:center;width:70%">
                            <img src="{{$cart->course->thumbnail}}" style="width:7vw;height:7vw;object-fit:cover;border-radius:10px;" class="img-fluid" alt="COURSE THUMBNAIL">
                            <div style="margin-left:1vw">
                                <div style="display:flex;align-items:flex-start">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;width:18vw;    line-height: 1.4vw;">{{$cart->course->title}}</p>
                                </div>
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">@foreach($cart->course->teachers as $teacher)
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
                            @if($cart->course_type_id == 1)
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
                                <input type="text" name="qty" class="qty-input normal-text" value="{{$cart->quantity}}" style="font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw">
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
                            <div style="width:7.5vw">
                                <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($cart->price, 0, ',', ',') }}</p>
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
                                <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($course->price, 0, ',', ',') }}</p>
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
                <!-- END OF COURSES -->
                @else
                <!-- START OF SHIPPING -->
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Info Pengiriman</p>
                </div>
                <div class="row m-0">
                    <div class="col-12 col-sm-6" >
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Provinsi</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">

                            
                            <select  onchange="if (this.value) window.location.href=this.value" name="" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                                <option disabled >Pilih Provinsi</option>
                                @foreach($provinces as $province)
                                <option value="{{ request()->fullUrlWithQuery(['province' => $province->id]) }}" 
                                    @if(Auth::user()->userDetail->province_id != null && !Request::get('province'))
                                        @if(Auth::user()->userDetail->province_id == $province->id)
                                        selected
                                        @endif
                                    @elseif(Request::get('province') == $province->id) 
                                    selected 
                                    @endif
                                    
                                    >{{$province->name }}</option>
                                @endforeach
                            </select>            
                              
                        </div>  
                        @error('province')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Kota</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <select  onchange="if (this.value) window.location.href=this.value" id=""  class="normal-text" name="" style="background:transparent;border:none;color: #5F5D70;;width:100%">
                                @if($cities == null && Auth::user()->userDetail->city_id == null)
                                    <option disabled>Pilih Provinsi terlebih dahulu</option>
                                @else
                                    <option disabled selected>Pilih Kota</option>

                                    @foreach($cities as $city)
                                    <option value="{{ request()->fullUrlWithQuery(['city' => $city->city_id]) }}" 

                                        @if(Auth::user()->userDetail->city_id != null && !Request::get('city'))
                                            @if(Auth::user()->userDetail->city_id == $city->city_id)
                                            selected
                                            @endif
                                        @elseif (Request::get('city') == $city->city_id) 
                                        selected 
                                        @endif
                                        
                                        >{{$city->name }}</option>
                                    @endforeach          
                                @endif
                            </select>        
                        </div>  
                        @error('city')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6" style="margin-top:1vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Metode Pengiriman</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <select  onchange="if (this.value) window.location.href=this.value" name="" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                                @if(Request::get('city') == null && Auth::user()->userDetail->city_id == null)
                                    <option disabled selected>Pilih Kota terlebih dahulu</option>
                                @else
                                    <option disabled selected>Pilih metode pengiriman</option>
                                    <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'shipping' => 'jne']) }}" @if (Request::get('shipping') == 'jne') selected @endif>JNE</option>
                                    <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'shipping' => 'tiki']) }}" @if (Request::get('shipping') == 'tiki') selected @endif>TIKI</option>
                                    <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'shipping' => 'pos']) }}" @if (Request::get('shipping') == 'pos') selected @endif>POS</option>
                                @endif
                            </select>                    
                        </div>  
                        @error('courier')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                        <div class="col-12 col-sm-6" style="margin-top:1vw">
                            <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Tipe Pengiriman</p>
                            <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                                <select  onchange="if (this.value) window.location.href=this.value" name="" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                                <option disabled selected>Pilih Metode Pengiriman terlebih dahulu</option>
                                    @if($tipe_pengiriman != null)
                                        @foreach($tipe_pengiriman as $tipe)
                                        <option value="{{ request()->fullUrlWithQuery(['tipe' =>$tipe['service']]) }}" @if (Request::get('tipe') == $tipe['service']) selected @endif>{{$tipe['service']}} - (Estimasi {{$tipe['cost'][0]['etd']}} hari) </option>
                                        @endforeach
                                    @endif
                                </select>        
                            </div> 
                            @error('service')
                                <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    <div class="col-12" style="margin-top:1vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Catatan Untuk Pengirim</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <input type="text" name="shipping_notes" class="normal-text" style="background:transparent;border:none;color: #5F5D70;;width:100%" placeholder="Kado untuk..">                   
                        </div>  
                        @error('shipping_notes')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12" style="margin-top:1vw">
                        <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Alamat</p>
                        <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                            <textarea name="address" value="{{ old('address') }}" id="" rows="4" class="normal-text"   style="background:transparent;border:none;color: #5F5D70;;width:100%">{{Auth::user()->userDetail->address}}</textarea>                
                        </div>  
                        @error('address')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- END OF SHIPPING -->
                @endif
            </div>
        </div> 
        <div class="col-4 p-0 ">
            <div class="page-container-right" style="padding-top:11vw">
                @if(session('discount_not_found'))

                <!-- ALERT MESSAGE -->
                <div class="alert alert-warning alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                    {{ session('discount_not_found') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
                @elseif(session('discount_found'))
                <!-- ALERT MESSAGE -->
                <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                    {{ session('discount_found') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
                @elseif(session('validation_error'))
                <!-- ALERT MESSAGE -->
                <div class="alert alert-warning alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                    {{ session('validation_error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <!-- END OF ALERT MESSAGE -->
                @endif
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Ringkasan Pembayaran</p>
                @if($total_price != 0)
                <div style="display:flex;align-items:center;margin-bottom:0.4vw;margin-top:2vw">
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0px">Kode Voucher</p>
                    <a href="/dashboard/redeem-vouchers" style="text-decoration:none;color:#2B6CAA;margin-left:4vw" class="normal-text" target="_blank"><i class="fas fa-question-circle"></i></a>
                </div>
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        
                        <div class="auth-input-form" style="display: flex;align-items:center;width:50%">
                            @if(Session::get('promotion_code'))
                            <input name="code" value="{{Session::get('promotion_code')->code}}" type="text" class="normal-text" style="background:transparent;border:none;color: #5F5D70;;width:100%" placeholder="Masukan kode promo">                   
                            @else
                            <input name="code" type="text" class="normal-text" style="background:transparent;border:none;color: #5F5D70;;width:100%" placeholder="Masukan kode promo">                   
                            @endif   
                        </div>  
                        
                        <button type="submit" name="action" value="checkDiscount" class="normal-text btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">Apply</button>
                    </div>
                    @error('code')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <?php 
                        if(Session::get('promotion_code'))
                        {
                            $discount = Session::get('promotion_code')->discount;
                            //check if its percent or nominal
                            if(Session::get('promotion_code')->type == 'nominal')
                                $discounted_price = $discount;
                            else
                                $discounted_price = $sub_total * ($discount/100);
                            
                        }
                        else
                            $discounted_price = 0;
                    ?>
                    <input type="hidden" value="{{$discounted_price}}" name="discounted_price">
                @endif
                <!-- START OF NOMINAL CARD -->
                <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Sub total</p>
                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($sub_total, 0, ',', ',') }}</p>
                        <input type="hidden" name="total_order_price" value="{{$sub_total}}">

                    </div>
                    @if(!$noWoki)
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw">
                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Shipping cost</p>
                        <input type="hidden" name="cost_courier" value="{{$shipping_cost}}">
                        <input type="hidden" name="total_weight" value="1000">
                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">
                        @if($shipping_cost == 0)
                        -
                        @else
                        Rp {{ number_format($shipping_cost, 0, ',', ',') }}</p>
                        @endif
                    </div>
                    @endif
                    @if($total_price != 0)
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;border-bottom:2px solid #2B6CAA;padding-bottom:1.5vw">
                        @if(Session::get('promotion_code'))
                            @if(Session::get('promotion_code')->type == 'percent')
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher ({{Session::get('promotion_code')->discount}}%) </p>
                            @else
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher </p>
                            @endif
                        @else
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher </p>
                        @endif
                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">- Rp {{ number_format($discounted_price, 0, ',', ',') }}</p>
                    </div>

                    <?php $total_price -= $discounted_price?>
                    @endif
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;">
                        <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Total</p>
                        <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($total_price, 0, ',', ',') }}</p>
                        <input type="hidden" name="grand_total" value="{{$total_price}}">

                    </div>
                </div>
                <!-- END OF NOMINAL CARD -->
        
                <div style="text-align:center;margin-top:1.5vw">
                        <?php
                            $tomorow = explode(' ', $today);
                            $date=$tomorow[0];
                            $time=$tomorow[1];
                        ?>
                        <input type="hidden" name="date" value="{{$date}}">
                        <input type="hidden" name="time" value="{{$time}}">
                        <input type="hidden" name="name" value="{{Auth::user()->name}}">
                        <input type="hidden" name="phone" value="{{Auth::user()->userDetail->telephone}}">
                        <input type="hidden" name="province" value="{{Request::get('province')}}">
                        <input type="hidden" name="city" value="{{Request::get('city')}}">
                        <input type="hidden" name="courier" value="{{Request::get('shipping')}}">
                        <input type="hidden" name="service" value="{{Request::get('tipe')}}">
                        <input type="hidden" name="bankShortCode" id="bankShortCode" value="">
                        @if($total_price == 0)
                        <button type="submit" name="action" value="createOrderFree" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Konfirmasi</button>
                        @elseif(Request::get('tipe') || $noWoki)
                        <button type="button" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-dark-blue" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">Lanjut ke Pembayaran</button>                
                        @else
                        <button type="button" data-toggle="modal" data-target="#exampleModal" class="normal-text" style="cursor:pointer;border:none;font-family: Poppins Medium;background: rgba(111, 159, 205, 0.5);border-radius: 5px;color:#FFFFFF;padding:0.5vw 2vw" disabled>Lanjut ke Pembayaran</button>                
                        @endif
                </div>
            </div>
        </div>

    </div>
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
    function togglePayment(evt, icon_id, type) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("bank-content")
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("bank-links");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("payment-method-card-active", "payment-method-card");
        }
        document.getElementById(icon_id).style.display = "block";
        evt.currentTarget.className += " payment-method-card-active";
        document.getElementById("bankShortCode").value = type;



    }
</script>

<script>
    function checkDiscount()
    {
        console.log(document.getElementById('check_discount_form'))
        document.getElementById("check_discount_form").submit();

    }

</script>

@endsection