@extends('./layouts/client-main')
@section('title', 'Venidici Cart')

@section('content')


<div class="row m-0" style="padding-bottom:4vw">
    
    <div class="col-8 p-0" style="">
        <div class="page-container-left" style="padding-top:11vw;padding-right:9vw">
            <div style="display:flex;justify-content:space-between;align-items:center">
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Keranjang</p>
                <p class="small-text" style="font-family:Rubik Regular;color:#CE3369;">*Please check your cart and complete the Shipping Details form before payment</p>

            </div>
            <!-- ITEM SECTION -->
                <!-- ONE WOKI CARD -->
                <div style="display:flex;margin-top:1vw">
                    <div class="cart-card-grey">
                        <div style="display:flex;align-items:center;width:70%">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:7vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="COURSE THUMBNAIL">
                            <div style="margin-left:1vw">
                                <div style="display:flex;align-items:flex-start">
                                    <p class="normal-text" style="font-family:Rubik Bold;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">Ini adalah judul pelatihan yang panjang</p>
                                    <i style="color:#2B6CAA" role="button"  aria-controls="woki-collapse-three" data-toggle="collapse" href="#woki-collapse-three" class="fas fa-caret-down small-heading"></i>
                                </div>
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;">Mr. Raditya Dika</p>
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Quantity: <span style="font-family:bold">2</span></p>
                            </div>
                        </div>
                        <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.4vw">Rp. 300.000</p>
                    </div>
                    <div class="cart-card-blue">
                        <form action="" method="post">
                            @csrf
                            @method('delete')
                                <button style="background:none;border:none;color:#FFFFFF" class="sub-description" type="submit" onclick="return confirm('Are you sure you want to delete this promo?')"><i class="fas fa-trash-alt"></i></button>
                        </form> 
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
                <!-- ONE COURSE CARD -->
                <div style="display:flex;margin-top:1vw">
                    <div class="cart-card-grey">
                        <div style="display:flex;align-items:center;width:70%">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:7vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="COURSE THUMBNAIL">
                            <div style="margin-left:1vw">
                                <p class="normal-text" style="font-family:Rubik Bold;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">Ini adalah judul pelatihan yang panjang</p>
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;">Mr. Raditya Dika</p>
                                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Quantity: <span style="font-family:bold">2</span></p>
                            </div>
                        </div>
                        <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0.4vw">Rp. 300.000</p>
                    </div>
                    <div class="cart-card-blue">
                        <form action="" method="post">
                            @csrf
                            @method('delete')
                                <button style="background:none;border:none;color:#FFFFFF" class="sub-description" type="submit" onclick="return confirm('Are you sure you want to delete this promo?')"><i class="fas fa-trash-alt"></i></button>
                        </form> 
                    </div>
                </div>
                <!-- END OF ONE COURSE CARD -->

            <!-- END OF ITEM SECTION -->

            <!-- TOTAL SECTION 
            <div style="background-color:#C4C4C4;border-radius:10px;padding:0.4vw;margin-top:1vw">
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:1vw">
                <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43">Subtotal</p>
                <p class="bigger-text" style="font-family:Rubik Bold;color:#3B3C43">Rp. 121.000</p>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43">Shipping Cost</p>
                <p class="bigger-text" style="font-family:Rubik Bold;color:#3B3C43">Rp. 121.000</p>
            </div>
            <div style="background-color:#C4C4C4;border-radius:10px;padding:0.2vw;margin-top:0vw">
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:1vw">
                <p class="bigger-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Total</p>
                <p class="bigger-text" style="font-family:Rubik Bold;color:#3B3C43;background-color:#C4C4C4;padding:0.2vw 1vw">Rp. 242.000</p>
            </div>
            <div style="display:flex;justify-content:flex-end">   
            <button class="bigger-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:1.5vw">Bayar</button>

            </div>
            END OF TOTAL SECTION -->

      
        </div>
    </div>  
    <div class="col-4 p-0" style="">
        <div class="page-container-right" style="padding-top:11vw">

        <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Ringkasan Pembayaran</p>
        <!-- START OF NOMINAL CARD -->
        <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw">
            <div style="display:flex;justify-content:space-between;align-items:center">
                <div style="display:flex;align-items:center">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Voucher Code:</p>
                    <input type="text" class="small-text" style="margin-left:0.5vw;background-color:#EEEEEE;padding:0.2vw;border:none;border-radius:5px;width:6vw;color:#2B6CAA" placeholder="123ABC">
                </div>
                <button type="submit" class="small-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;">Apply</button>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:2vw">
                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Sub total</p>
                <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp 99,999,999</p>
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
        <div style="text-align:center">
            <button class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:1.5vw;padding:0.5vw 2vw">Lanjut ke Pembayaran</button>
        </div>

        <!-- START OF SHIPPING CARD -->
        <div style="background: #F6F6F6;border-radius: 10px;padding:1.5vw;margin-top:2vw">
            <div style="display:flex;justify-content:space-between;align-items:center">
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Info Pengiriman</p>
                <button type="submit" class="small-text btn-blue-bordered" style="font-family: Poppins Medium;margin-bottom:0px;">Ubah</button>
            </div>
            <div style="background:#FFFFFF;border-radius:10px;padding:1vw;margin-top:1vw">
                <p class="small-text" style="font-family:Rubik Regular;color:#888888;margin-bottom:0px">Gabrielle - Jalan duren tiga indah 5 Blok I no. 11, Pancoran, Jakarta Selatan, DKI Jakarta, 13720</p>
            </div>
        </div>
        <!-- END OF SHIPPING CARD -->


        <!--
        <div class="" style="padding-top:11vw;padding-left:4vw;padding-right:4vw">
            <p class="medium-heading" style="font-family:Rubik Medium;color:#FFFFFF;">Shipping Details</p>
            <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-top:4vw">Shipping Address</p>
            <textarea class="normal-text"  name="" id="" rows="3" style="background: #FBFBFB;width:100%;border-radius: 10px;border:none;color: #5F5D70;padding:1vw"></textarea>
            <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-top:1vw">Contact Info</p>
            <input type="text"  style="background: #FBFBFB;width:100%;border-radius: 10px;border:none;color: #5F5D70;padding:1vw">
        </div>
        -->
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


@endsection