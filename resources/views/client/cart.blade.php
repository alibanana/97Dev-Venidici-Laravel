@extends('./layouts/client-main')
@section('title', 'Venidici Cart')

@section('content')


<div class="row m-0" style="padding-bottom:4vw">
    
    <div class="col-8 p-0" style="">
        <div class="page-container-left" style="padding-top:11vw;padding-right:5vw">
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
                            <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. 300.000</p>
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
                <!-- ONE COURSE CARD -->
                <div style="display:flex;margin-top:1vw">
                    <div class="cart-card-grey">
                        <div style="display:flex;align-items:center;width:70%">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            </div>
                            <img src="/assets/images/client/Display_Picture_Dummy.png" style="width:7vw;height:7vw;object-fit:cover;border-radius:10px;" class="img-fluid" alt="COURSE THUMBNAIL">
                            <div style="margin-left:1vw">
                                <div style="display:flex;align-items:flex-start">
                                    <p class="normal-text" style="font-family:Rubik Medium;color:#3B3C43; display: -webkit-box;overflow : hidden !important;text-overflow: ellipsis !important;-webkit-line-clamp: 3 !important;-webkit-box-orient: vertical !important;width:18vw;    line-height: 1.4vw;">Ini adalah judul pelatihan yang ada panjangnya sampe 2 baris</p>
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
                            <p class="bigger-text text-nowrap"  style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp. 300.000</p>
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
                <!-- END OF ONE COURSE CARD -->

            <!-- END OF ITEM SECTION -->

        </div>
    </div>  
    <div class="col-4 p-0 cart-background">
        <div class="page-container-right" style="padding-top:11vw">

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Ringkasan Pembayaran</p>
            <!-- START OF NOMINAL CARD -->
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Total</p>
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp 99,999,999</p>
                </div>
            </div>
            <!-- END OF NOMINAL CARD -->
            <div style="text-align:center">
                <button onclick="window.open('/shipping','_self');" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;margin-top:1.5vw;padding:0.5vw 2vw">Lanjut ke Pengiriman</button>
            </div>
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
$('.increment-btn').click(function (e) {
    console.log('add');
    e.preventDefault();
    var incre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<10){
        value++;
        $(this).parents('.quantity').find('.qty-input').val(value);
    }
});

$('.decrement-btn').click(function (e) {
    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(decre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>1){
        value--;
        $(this).parents('.quantity').find('.qty-input').val(value);
    }
});

</script>
@endsection