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
                            <img src="/assets/images/client/BTPN_LOGO.jpeg" style="width:4vw;height:3vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="">
                            <p class="bigger-text payment-method-text" style="font-family:Rubik Regular;margin-bottom:0px;margin-left:1vw">Bank BTPN ( Virtual Account )</p>
                        </div>
                        <div id="checked_icon_2" class="bank-content" style="display:none">
                            <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                        </div>                        
                    </div>
                </div>
                <!-- END OF ONE PAYMENT METHOD -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-family:Poppins Medium;padding:0.5vw 2vw">Batal</button>
                <button type="submit" name="action" value="createPaymentObject" data-toggle="modal" data-target="#exampleModal" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;cursor:pointer;padding:0.5vw 2vw">Konfirmasi</button>                
            </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL VA -->

    <!-- START OF PAGE CONTENT -->
    <div class="row m-0 shipping-background" style="padding-bottom:4vw">
        
        <div class="col-8 p-0" style="">
            <div class="page-container-left" style="padding-top:11vw;padding-right:9vw">
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

                @endif
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Ringkasan Pembayaran</p>
                <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:2vw">Kode Voucher</p>
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
                            $discounted_price = $sub_total * ($discount/100);
                        }
                        else
                            $discounted_price = 0;
                    ?>
                    <input type="hidden" value="{{$discounted_price}}" name="discounted_price">

                <!-- START OF NOMINAL CARD -->
                <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw">
                    <div style="display:flex;justify-content:space-between;align-items:center">
                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Sub total</p>
                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($sub_total, 0, ',', ',') }}</p>
                        <input type="hidden" name="total_order_price" value="{{$sub_total}}">

                    </div>
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
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;border-bottom:2px solid #2B6CAA;padding-bottom:1.5vw">
                        <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher</p>
                        <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">- Rp {{ number_format($discounted_price, 0, ',', ',') }}</p>
                    </div>
                    <?php $total_price -= $discounted_price?>
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
                        <input type="hidden" name="phone" value="+14047090990">
                        <input type="hidden" name="province" value="{{Request::get('province')}}">
                        <input type="hidden" name="city" value="{{Request::get('city')}}">
                        <input type="hidden" name="courier" value="{{Request::get('shipping')}}">
                        <input type="hidden" name="service" value="{{Request::get('tipe')}}">
                        <input type="hidden" name="bankShortCode" id="bankShortCode" value="">
                        @if(Request::get('tipe'))
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