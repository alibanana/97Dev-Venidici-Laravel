@extends('./layouts/client-main')
@section('title', 'Venidici Payment')

@section('content')


<div class="row m-0" style="padding-bottom:4vw;padding-top:11vw">
    <div class="col-12 p-0" style="padding-bottom:3vw">
        <div class="page-container">
            <img src="/assets/images/client/xfers_logo.png" class="img-fluid" style="width:18vw" alt="">         
        </div>
    </div>
    <div class="col-8 p-0" style="">
        <div class="page-container-left" style="padding-top:3vw;padding-right:9vw">
            
            <!-- ALERT MESSAGE -->
            <div class="alert alert-dismissible fade show small-text"  style="font-family:Rubik Medium;width:100%;text-align:center;margin-bottom:0px;color:#3B3C43;background-color:#EBF5FF"role="alert">
                <div style="display:flex;align-items:center">
                    <i class="fas fa-exclamation-triangle small-heading" style="color:#F4C257"></i>
                    <p style="margin-bottom:0px;margin-left:1vw">
                        Hai, Gabriel. Harap selesaikan pembayaran sebelum 12/12/21 00:00 atau proses pembayaran akan ditutup. Terima kasih.            
                    </p>
                </div>
            </div>
            <!-- END OF ALERT MESSAGE -->
            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:3vw">Metode Pembayaran</p>
            <!-- START OF ONE PAYMENT METHOD -->
            <div class="payment-method-card-active" style="" >
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <div style="display:flex;align-items:center">
                        <img src="/assets/images/client/BCA_LOGO.png" style="width:6vw;height:5vw;" class="img-fluid" alt="">
                        <p class="bigger-text payment-method-text" style="font-family:Rubik Medium;margin-bottom:0px;margin-left:1vw">Bank BCA ( Virtual Account )</p>
                    </div>
                    <div>
                        <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                    </div>    
                </div>
            </div>
            <!-- END OF ONE PAYMENT METHOD -->
            
            <!-- START OF PAYMENT INSTRUCTION -->
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
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">2. Masukan nomor Virtual Account <span style="font-family:Rubik Medium;color:#074EE8">127 0811 7654 3210</span>  dan pilih send. </p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">3. Pastikan total tagihan dari BCA Virtual Account sesuai dengan <span style="font-family:Rubik Medium;color:#074EE8"> total pembayaran</span> di halaman ini. Pastikan juga Merchant bernama <span style="font-family:Rubik Medium;color:#074EE8">Venidici</span>. Jika semua sudah benar, pilih Yes/Ya.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF PAYMENT INSTRUCTION -->
        </div>

    </div>  
    <div class="col-4 p-0 ">
        <div class="page-container-right" style="padding-top:3vw"> 
            <div style="display:flex;align-items:center">
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Status</p>   
                <a href="">
                    <div style="background-color:#2B6CAA;border-radius:10px;padding:0.3vw 0.5vw;margin-left:0.5vw">
                        <i class="fas fa-redo-alt bigger-text" style="color:#FFFFFF"></i>
                    </div>         
                </a>
            </div>       
            <!-- START OF STATUS CARD -->
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1vw 1.5vw;margin-top:1vw;text-align:center">
                <p class="bigger-text" style="font-family:Rubik Medium;color:#CE3369;margin-bottom:0px">Menunggu Pembayaran</p>
            </div>
            <!-- END OF STATUS CARD -->       

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:3vw">Virtual Account Number</p>            
            <!-- START OF VA CARD -->
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1vw 1.5vw;margin-top:1vw;text-align:center">
                <p class="bigger-text" style="font-family:Rubik Medium;color:#074EE8;margin-bottom:0px">127 0811 7654 3210</p>
            </div>
            <!-- END OF VA CARD -->  

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:3vw">Ringkasan Pembayaran</p>            
            <!-- START OF NOMINAL CARD -->
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:1vw">
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Sub total</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#3B3C43;margin-bottom:0px">Rp 125000</p>
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
            <div style="text-align:center;margin-top:1vw">   
                <p class="small-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">Cancel the payment <span> <a href="">click here</a> </span> </p>
            </div>
           
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

@endsection