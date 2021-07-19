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
                            <img src="/assets/images/client/BCA_LOGO.png" style="width:4vw;height:3vw;object-fit:contain;border-radius:10px" class="img-fluid image-bank" alt="">
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
                            <img src="/assets/images/client/bri_logo.png" style="width:4vw;height:3vw;object-fit:contain;border-radius:10px" class="img-fluid image-bank" alt="">
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
                <div class="payment-method-card bank-links" style="margin-top:1vw" id="payment_method_4"  onclick="togglePayment(event, 'checked_icon_4','mandiri')">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/client/mandiri_logo.png" style="width:4vw;height:3vw;object-fit:contain;border-radius:10px" class="img-fluid image-bank" alt="">
                            <p class="bigger-text payment-method-text" style="font-family:Rubik Regular;margin-bottom:0px;margin-left:1vw">Bank Mandiri ( Virtual Account )</p>
                        </div>
                        <div id="checked_icon_4" class="bank-content" style="display:none">
                            <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                        </div>                        
                    </div>
                </div>
                <!-- END OF ONE PAYMENT METHOD -->
                <!-- START OF ONE PAYMENT METHOD -->
                <div class="payment-method-card bank-links" style="margin-top:1vw" id="payment_method_5"  onclick="togglePayment(event, 'checked_icon_5','q')">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <div style="display:flex;align-items:center">
                            <img src="/assets/images/client/QRIS_LOGO.png" style="width:4vw;height:3vw;object-fit:contain;border-radius:10px" class="img-fluid image-bank" alt="">
                            <p class="bigger-text payment-method-text" style="font-family:Rubik Regular;margin-bottom:0px;margin-left:1vw">QRIS</p>
                        </div>
                        <div id="checked_icon_5" class="bank-content" style="display:none">
                            <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                        </div>                        
                    </div>
                </div>
                <!-- END OF ONE PAYMENT METHOD -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary full-width-button" data-dismiss="modal" style="font-family:Poppins Medium;padding:0.5vw 2vw">Batal</button>
                @if($noWoki)
                    <button type="submit" onclick="openLoadingShipping()" name="action" value="createPaymentObjectWithNoWoki" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-blue-bordered btn-blue-bordered-active full-width-button" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Konfirmasi</button>                
                @else
                    <button type="submit" onclick="openLoadingShipping()" name="action" value="createPaymentObject" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Konfirmasi</button>                

                @endif
            </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL VA -->

    <!-- Modal Loading -->
    <div class="modal fade" id="loadingModalShipping" tabindex="-1" role="dialog" aria-labelledby="loadingModalShipping" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body loading-background" style="text-align:center;height:20vw">
                    <p class="sub-description" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Pembayaran Sedang Di Proses...</p>
                    <img src="/assets/images/client/loading.gif" style="width:3vw;height:3vw;object-fit:contain;border-radius:10px;margin-top:5vw" class="img-fluid" alt="Loading..">
                </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL Loading -->

    <!-- START OF PAGE CONTENT -->
    <div class="row m-0 shipping-background" style="padding-bottom:4vw">
        
        <div class="col-md-8 col-xs-12 p-0" style="">
            <div class="page-container-left " style="">
            @if($noWoki)
                <!-- START OF COURSES -->
                @foreach($carts as $cart)
                    @if($cart->course->course_type_id == 1)
                        <!-- ONE COURSE CARD -->
                        <div style="display:flex;margin-top:1vw" class="cartpage">
                            <div class="cart-card-grey full-width">
                                <div style="display:flex;align-items:center;width:70%">
                                    <img src="{{$cart->course->thumbnail}}" style="width:7vw;height:7vw;object-fit:cover;border-radius:10px;" class="img-fluid image-thumbnail" alt="COURSE THUMBNAIL">
                                    <div style="margin-left:1vw">
                                        <div class="cart-title">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">{{$cart->course->title}}</p>
                                        </div>
                                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">
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
                                <div class="margin-right-shipment" style="display:flex;align-items:center">
                                    <div style="width:7.5vw">
                                        <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($cart->price, 0, ',', ',') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF ONE COURSE CARD -->
                    @else
                        <!-- ONE WOKI CARD -->
                        <div class="margin-bot" style="display:flex;margin-top:1vw">
                            <div class="cart-card-grey full-width">
                                <div style="display:flex;align-items:center;width:70%">
                                    <img src="{{asset($cart->course->thumbnail)}}" style="width:7vw;height:7vw;object-fit:cover;border-radius:10px;" class="img-fluid image-thumbnail" alt="COURSE THUMBNAIL">
                                    <div style="margin-left:1vw">
                                        <div class="cart-title">
                                            <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">{{$cart->course->title}}</p>
                                            @if($cart->course->priceWithArtKit != null)
                                            <i style="color:#2B6CAA;margin-left:1vw" role="button"  aria-controls="woki-collapse-{{$cart->id}}" data-toggle="collapse" href="#woki-collapse-{{$cart->id}}" class="fas fa-caret-down small-heading"></i>
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
                                    <div style="display:flex;align-items:center;margin-right:2vw" class="quantity">
                                        <input type="text" class="qty-input normal-text qty-width" value="{{$cart->quantity}}" style="font-family:Rubik Medium;color:#3B3C43;background: #FFFFFF;border: 2px solid #2B6CAA;border-radius: 5px;width:3vw;padding-left:1vw" readonly>
                                    </div>
                                    <div class="margin-right-shipment" style="width:7.5vw;text-align:right">
                                        <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. {{ number_format($cart->course->price, 0, ',', ',') }}</p>
                                    </div>                        
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
                <!-- END OF COURSES -->
            @else
                <!-- START OF SHIPPING -->
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Info Pengiriman</p>
                </div>
                <div class="row m-0 no-padding">
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
                                    <option disabled selected>Pilih Provinsi terlebih dahulu</option>
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
                                            >{{$city->name }}
                                        </option>
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
                            <select  onchange="if (this.value){ openLoading(); window.location.href=this.value}" name="" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                                @if(Request::get('city') == null && Auth::user()->userDetail->city_id == null)
                                    <option disabled selected>Pilih Kota terlebih dahulu</option>
                                @else
                                    <option disabled selected>Pilih metode pengiriman</option>
                                    <option value="{{ request()->fullUrlWithQuery(['shipping' => 'jne']) }}" @if (Request::get('shipping') == 'jne') selected @endif>JNE</option>
                                    <option value="{{ request()->fullUrlWithQuery(['shipping' => 'tiki']) }}" @if (Request::get('shipping') == 'tiki') selected @endif>TIKI</option>
                                    <option value="{{ request()->fullUrlWithQuery(['shipping' => 'pos']) }}" @if (Request::get('shipping') == 'pos') selected @endif>POS</option>
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
                                <select  onchange="if (this.value){openLoading(); window.location.href=this.value}" name="" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                                <option disabled selected>Pilih Metode Pengiriman terlebih dahulu</option>
                                    @if($tipe_pengiriman != null)
                                        @foreach($tipe_pengiriman as $tipe)
                                            <option value="{{ request()->fullUrlWithQuery(['tipe' =>$tipe['service']]) }}" 
                                                @if (Request::get('tipe') == $tipe['service']) selected @endif>
                                                {{$tipe['service']}} - (Estimasi {{$tipe['cost'][0]['etd']}} hari)
                                            </option>
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
        <div class="col-md-4 p-0 ">
            <div class="page-container-right" style="padding-top:11vw">
                @if (session('discount_not_found'))
                    <!-- ALERT MESSAGE -->
                    <div class="alert alert-warning alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                        {{ session('discount_not_found') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <!-- END OF ALERT MESSAGE -->
                @elseif (session('discount_found'))
                    <!-- ALERT MESSAGE -->
                    <div class="alert alert-primary alert-dismissible fade show small-text mb-3"  style="width:100%;text-align:center;margin-bottom:0px"role="alert">
                        {{ session('discount_found') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <!-- END OF ALERT MESSAGE -->
                @elseif (session('validation_error'))
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
                                <input form="validateVoucherCodeForm" name="code" value="{{Session::get('promotion_code')->code}}" type="text" class="normal-text" style="background:transparent;border:none;color: #5F5D70;;width:100%" placeholder="Masukan kode promo">                   
                            @else
                                <input form="validateVoucherCodeForm" name="code" type="text" class="normal-text" style="background:transparent;border:none;color: #5F5D70;;width:100%" placeholder="Masukan kode promo">                   
                            @endif   
                        </div>
                        <button form="validateVoucherCodeForm" type="submit" class="normal-text btn-dark-blue half-width-button" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">Apply</button>
                    </div>
                    @error('code')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="hidden" name="promo_code" value="{{ Session::get('promotion_code') ? Session::get('promotion_code')->code : null }}" >
                    <input type="hidden" name="discounted_price" value="{{ $discounted_price }}">
                @endif

                <!-- START OF NOMINAL CARD -->
                <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Sub total</p>
                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($sub_total, 0, ',', ',') }}</p>
                        <input type="hidden" name="total_order_price" value="{{$sub_total}}">

                    </div>
                    @if(Auth::user()->club != null)
                        @php
                            $discount_club_price = 0;
                            if(Auth::user()->club == 'bike')
                                $discount_club_price = 2500;
                            elseif(Auth::user()->club == 'car' || Auth::user()->club == 'jet')
                                $discount_club_price = 5000;
                        @endphp
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw">
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Diskon Venidici Club</p>
                            <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">- Rp {{ number_format($discount_club_price, 0, ',', ',') }}</p>
                        </div>
                    @else
                            @php
                            $discount_club_price = 0;
                            @endphp
                    @endif
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
                        @php
                        $discount_club_shipping = 0;

                        @endphp
                        @if(Auth::user()->club == 'car' || Auth::user()->club == 'jet')

                            @php
                                if(Auth::user()->club == 'car')
                                    $discount_club_shipping = 5000;
                                elseif(Auth::user()->club == 'jet')
                                    $discount_club_shipping = 10000;
                            @endphp
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw">
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Diskon Venidici Club (Shipping)</p>
                                <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">- Rp {{ number_format($discount_club_shipping, 0, ',', ',') }}</p>
                            </div>
                        @endif

                @else
                        @php
                            $discount_club_shipping = 0;
                        @endphp
                @endif 
                    @if($total_price != 0)
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;border-bottom:2px solid #2B6CAA;padding-bottom:1.5vw">
                        @if(Session::get('promotion_code'))
                            @if(Session::get('promotion_code')->type == 'percent')
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher @if(Session::get('promotion_code')->promo_for == 'shipping') (Shipping) @endif
                                ({{ Session::get('promotion_code')->discount }}%) </p>
                            @else
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher @if(Session::get('promotion_code')->promo_for == 'shipping') (Shipping) @endif</p>
                            @endif
                        @else
                            <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher</p>
                        @endif
                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">- Rp {{ number_format($discounted_price, 0, ',', ',') }}</p>
                    </div>

                    <?php
                        $total_price -= $discounted_price;
                        $total_price -= $discount_club_shipping;
                    ?>
                    @endif
                    @php 
                        $total_price -= $discount_club_price;
                        $club_discount = $discount_club_shipping + $discount_club_price;
                    @endphp
                    <input type="hidden" value="{{$club_discount}}" name="club_discount">

                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;">
                        <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Total</p>
                        <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($total_price, 0, ',', ',') }}</p>
                        <input type="hidden" name="grand_total" value="{{$total_price}}">
                    </div>
                </div>
                <!-- END OF NOMINAL CARD -->
        
                <div style="text-align:center;margin-top:1.5vw">
                        <?php
                            $tomorrow_split = explode(' ', $tomorrow);
                            $date = $tomorrow_split[0];
                            $time = $tomorrow_split[1];
                        ?>
                        <input type="hidden" name="date" value="{{ $date }}">
                        <input type="hidden" name="time" value="{{ $time }}">
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="phone" value="{{ Auth::user()->userDetail->telephone }}">
                        <input type="hidden" name="province" value="
                        @if(Request::get('province'))
                            {{Request::get('province')}}
                        @else
                            {{auth()->user()->userDetail->province_id}}
                        @endif
                        ">
                        <input type="hidden" name="city" value="
                        @if (Request::get('city'))
                            {{ Request::get('city') }}
                        @else
                            {{ auth()->user()->userDetail->city_id }}
                        @endif
                        ">
                        <input type="hidden" name="courier" value="{{Request::get('shipping')}}">
                        <input type="hidden" name="service" value="{{Request::get('tipe')}}">
                        <input type="hidden" name="bankShortCode" id="bankShortCode" value="">
                        @if(Request::get('tipe') || $noWoki)
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-dark-blue full-width-button" style="border:none;font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">Lanjut ke Pembayaran</button>                
                        @else
                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="normal-text full-width-button" style="cursor:pointer;border:none;font-family: Poppins Medium;background: rgba(111, 159, 205, 0.5);border-radius: 5px;color:#FFFFFF;padding:0.5vw 2vw" disabled>Lanjut ke Pembayaran</button>                
                        @endif
                </div>
            </div>
        </div>

    </div>
</form>
<form id="validateVoucherCodeForm" action="{{ route('customer.cart.validate-voucher-code') }}" method="POST">
@csrf
<input type="hidden" value="{{$shipping_cost}}" name="shipping_cost">
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function openLoadingShipping() {
        $('#loadingModalShipping').modal({backdrop: 'static', keyboard: false});

        $('#loadingModalShipping').modal('show');
    }
</script>
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
    function checkDiscount() {
        console.log(document.getElementById('check_discount_form'))
        document.getElementById("check_discount_form").submit();
    }
</script>
@endsection