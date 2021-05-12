@extends('./layouts/client-main')
@section('title', 'Venidici Shipping')

@section('content')


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
                        <select onchange="if (this.value) window.location.href=this.value" name="province" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                            <option disabled selected >Pilih Provinsi</option>
                            @foreach($provinces as $province)
                            <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'province' => $province->id]) }}" @if (Request::get('province') == $province->id) selected @endif>{{$province->name }}</option>
                            @endforeach
                        </select>                    
                        @error('province')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
                <div class="col-12 col-sm-6">
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Kota</p>
                    <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                        <select onchange="if (this.value) window.location.href=this.value" name="province" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                            @if($cities == null)
                                <option disabled selected>Pilih Provinsi terlebih dahulu</option>

                            @else
                                @foreach($cities as $city)
                                <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'city' => $city->id]) }}" @if (Request::get('city') == $city->id) selected @endif>{{$city->name }}</option>
                                @endforeach          
                            @endif
                        </select>                    
                        @error('province')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
                <div class="col-12 col-sm-6" style="margin-top:1vw">
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Metode Pengiriman</p>
                    <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                        <select name="province" id=""  class="normal-text"  style="background:transparent;border:none;color: #5F5D70;;width:100%">
                            @if(Request::get('city') == null)
                                <option disabled selected>Pilih Kota terlebih dahulu</option>
                            @else
                                <option disabled selected>Pilih metode pengiriman</option>
                                <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'shipping' => 'JNE']) }}" @if (Request::get('shipping') == 'JNE') selected @endif>JNE</option>
                                <option value="{{ request()->fullUrlWithQuery(['page' => 1, 'shipping' => 'TIKI']) }}" @if (Request::get('shipping') == 'TIKI') selected @endif>TIKI</option>
                            @endif
                        </select>                    
                        @error('province')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
                <div class="col-12" style="margin-top:1vw">
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Catatan Untuk Pengirim</p>
                    <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                        <input type="text" class="normal-text" style="background:transparent;border:none;color: #5F5D70;;width:100%" placeholder="Kado untuk..">                   
                        @error('province')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
                <div class="col-12" style="margin-top:1vw">
                    <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:1vw">Alamat</p>
                    <div class="auth-input-form" style="display: flex;align-items:center;width:100%">
                        <textarea name="" id="" rows="4" class="normal-text"   style="background:transparent;border:none;color: #5F5D70;;width:100%">Jalan 123 Komplek ABC - Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos</textarea>                
                        @error('province')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
            </div>
        </div>
    </div>  
    <div class="col-4 p-0 ">
        <div class="page-container-right" style="padding-top:11vw">

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Ringkasan Pembayaran</p>
            <p class="normal-text" style="font-family:Rubik Medium;color:#2B6CAA;text-align:left !important;margin-bottom:0.4vw;margin-top:2vw">Kode Voucher</p>
            <div style="display:flex;justify-content:space-between;align-items:center">
                
                <div class="auth-input-form" style="display: flex;align-items:center;width:50%">
                    <input type="text" class="normal-text" style="background:transparent;border:none;color: #5F5D70;;width:100%" placeholder="1234567">                   
                    @error('province')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>  
                <button class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">Apply</button>
            </div>
            <!-- START OF NOMINAL CARD -->
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw">
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Sub total</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp {{ number_format($sub_total, 0, ',', ',') }}</p>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Shipping cost</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp 99,999,999</p>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;border-bottom:2px solid #2B6CAA;padding-bottom:1.5vw">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Potongan voucher</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp -99,999,999</p>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw;">
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Total</p>
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp 99,999,999</p>
                </div>
            </div>
            <!-- END OF NOMINAL CARD -->
            <div style="text-align:center;margin-top:1.5vw">
                <a href="{{ route('customer.cart.payment_index') }}" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">Lanjut ke Pembayaran</a>
            </div>
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


@endsection