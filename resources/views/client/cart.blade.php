@extends('./layouts/client-main')
@section('title', 'Venidici Cart')

@section('content')


<div class="row m-0" >
    <div class="col-8 p-0" style="">
        <div class="page-container-left" style="padding-top:11vw;padding-right:9vw">
            <p class="medium-heading" style="font-family:Rubik Medium;color:#3B3C43;">Cart</p>
            <!-- ITEM SECTION -->
            <div style="overflow:scroll;height:22vw;">
                <!-- ONE CARD -->
                <div style="display:flex;margin-top:1vw">
                    <div class="cart-card-grey">
                        <div style="display:flex;align-items:center;width:70%">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:7vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="COURSE THUMBNAIL">
                            <div style="margin-left:1vw">
                                <p class="bigger-text" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0.4vw; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">Ini adalah judul pelatihan yang panjang</p>
                                <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Mr. Raditya Dika</p>
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
                <!-- END OF ONE CARD -->
                <!-- ONE CARD -->
                <div style="display:flex;margin-top:1vw">
                    <div class="cart-card-grey">
                        <div style="display:flex;align-items:center;width:70%">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:7vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="COURSE THUMBNAIL">
                            <div style="margin-left:1vw">
                                <p class="bigger-text" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0.4vw; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">Ini adalah judul pelatihan yang panjang</p>
                                <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Mr. Raditya Dika</p>
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
                <!-- END OF ONE CARD -->
                <!-- ONE CARD -->
                <div style="display:flex;margin-top:1vw">
                    <div class="cart-card-grey">
                        <div style="display:flex;align-items:center;width:70%">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:7vw;object-fit:cover;border-radius:10px" class="img-fluid" alt="COURSE THUMBNAIL">
                            <div style="margin-left:1vw">
                                <p class="bigger-text" style="font-family:Rubik Bold;color:#3B3C43;margin-bottom:0.4vw; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;">Ini adalah judul pelatihan yang panjang</p>
                                <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Mr. Raditya Dika</p>
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
                <!-- END OF ONE CARD -->
            </div>
            <!-- END OF ITEM SECTION -->

            <!-- TOTAL SECTION -->
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
            <!-- END OF TOTAL SECTION -->

      
        </div>
    </div>  
    <div class="col-4 p-0" style="background-color:#2B6CAA;height:60vw">
        <div class="" style="padding-top:11vw;padding-left:4vw;padding-right:4vw">
            <p class="medium-heading" style="font-family:Rubik Medium;color:#FFFFFF;">Shipping Details</p>
            <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-top:4vw">Shipping Address</p>
            <textarea class="normal-text"  name="" id="" rows="3" style="background: #FBFBFB;width:100%;border-radius: 10px;border:none;color: #5F5D70;padding:1vw"></textarea>
            <p class="bigger-text" style="font-family:Rubik Medium;color:#FFFFFF;margin-top:1vw">Contact Info</p>
            <input type="text"  style="background: #FBFBFB;width:100%;border-radius: 10px;border:none;color: #5F5D70;padding:1vw">
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


@endsection