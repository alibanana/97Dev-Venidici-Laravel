@extends('./layouts/client-main')
@section('title', 'Venidici Payment')

@section('content')


<div class="row m-0" style="padding-bottom:4vw;padding-top:11vw">
    <div class="col-12 page-container" style="display:flex;justify-content:center">
        <!-- ALERT MESSAGE 
        <div class="alert alert-warning alert-dismissible fade show small-text"  style="width:80%;text-align:center;margin-bottom:0px;color:#3B3C43"role="alert">
        Hai, Gabriel. Harap selesaikan pembayaran sebelum 12/12/21 00:00 atau proses pembayaran akan ditutup. Terima kasih.            
        </div>
         END OF ALERT MESSAGE -->
    </div>
    <div class="col-8 p-0" style="">
        <div class="page-container-left" style="padding-top:3vw;padding-right:9vw">
            <div style="display:flex;justify-content:space-between;align-items:center">
                <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Metode Pembayaran</p>
            </div>
            <div class="row m-0">
                <div class="col-12 p-0">
                    <!-- START OF ONE PAYMENT METHOD -->
                    <div class="payment-method-card bank-links" style="" id="payment_method_1"  onclick="togglePayment(event, 'checked_icon_1')">
                        <div style="display:flex;justify-content:space-between;align-items:center">
                            <div style="display:flex;align-items:center">
                                <img src="/assets/images/client/BCA_LOGO.png" style="width:6vw;height:5vw;" class="img-fluid" alt="">
                                <p class="bigger-text payment-method-text" style="font-family:Rubik Medium;margin-bottom:0px;margin-left:1vw">Bank BCA ( Virtual Account )</p>
                            </div>
                            <div id="checked_icon_1" class="bank-content" style="display:none">
                                <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                            </div>    
                        </div>
                    </div>
                    <!-- END OF ONE PAYMENT METHOD -->
                    <!-- START OF ONE PAYMENT METHOD -->
                    <div class="payment-method-card bank-links" style="margin-top:1.5vw" id="payment_method_2"  onclick="togglePayment(event, 'checked_icon_2')">
                        <div style="display:flex;justify-content:space-between;align-items:center">
                            <div style="display:flex;align-items:center">
                                <img src="/assets/images/client/BCA_LOGO.png" style="width:6vw;height:5vw;" class="img-fluid" alt="">
                                <p class="bigger-text payment-method-text" style="font-family:Rubik Medium;margin-bottom:0px;margin-left:1vw">Bank BCA ( Virtual Account )</p>
                            </div>
                            <div id="checked_icon_2" class="bank-content" style="display:none">
                                <i class="fas fa-check-circle small-heading" style="color:#2B6CAA;margin-right:1vw"></i>
                            </div>                        
                        </div>
                    </div>
                    <!-- END OF ONE PAYMENT METHOD -->
                </div>
                <!--
                <div class="col-12 p-0" >
                    <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:2vw">Cara Pembayaran Virtual Account</p>            
                    <!-- START OF VIRTUAL ACCOUNT CARD 
                    <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw;">
                        <div style="">
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">1. Pilih m-Transfer dan pilih BCA Virtual Account.</p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">2. Masukan nomor Virtual Account <span style="font-family:Rubik Medium;color:#074EE8">127 0811 7654 3210</span>  dan pilih send. </p>
                            <p class="normal-text" style="font-family:Rubik Regular;color:#3B3C43;margin-bottom:0px">3. Pastikan total tagihan dari BCA Virtual Account sesuai dengan <span style="font-family:Rubik Medium;color:#074EE8"> total pembayaran</span> di halaman ini. Pastikan juga Merchant bernama <span style="font-family:Rubik Medium;color:#074EE8">Venidici</span>. Jika semua sudah benar, pilih Yes/Ya.</p>
                        </div>
                    </div>
                    <!-- END OF VIRTUAL ACCOUNT CARD 
                </div>
                -->
            </div>
        </div>
    </div>  
    <div class="col-4 p-0 ">
        <div class="page-container-right" style="padding-top:3vw">

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;">Ringkasan Pembayaran</p>            
            <!-- START OF NOMINAL CARD -->
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw">
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
            <div style="text-align:center;margin-top:2vw">
                <a href="/transaction-detail/1" class="normal-text btn-blue-bordered btn-blue-bordered-active" style="font-family: Poppins Medium;margin-bottom:0px;cursor:pointer;padding:0.5vw 2vw">Konfirmasi Metode Pembayaran</a>
            </div>
            <!-- END OF NOMINAL CARD -->
            <!--
            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:2vw">Status</p>            
            <!-- START OF STATUS CARD
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw;text-align:center">
                    <p class="bigger-text" style="font-family:Rubik Medium;color:#CE3369;margin-bottom:0px">Menunggu Pembayaran</p>
            </div>
            <!-- END OF STATUS CARD 

            <p class="small-heading" style="font-family:Rubik Medium;color:#3B3C43;margin-top:2vw">Virtual Account</p>            
            <!-- START OF VIRTUAL ACCOUNT CARD 
            <div style="background: #FFFFFF;box-shadow: 0px 0px 10px rgba(48, 48, 48, 0.15);border-radius: 10px;padding:1.5vw;margin-top:2vw;">
                <div style="display:flex;justify-content:space-between">
                    <p class="small-text" style="font-family:Rubik Regular;color:#Nomor Virtual Account;margin-bottom:0px">Nomor Virtual Account</p>
                    <p class="small-text" style="font-family:Rubik Medium;color:#074EE8;margin-bottom:0px">127 0811 7654 3210</p>
                </div>
            </div>
            <!-- END OF VIRTUAL ACCOUNT CARD
            -->
        </div>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function togglePayment(evt, icon_id) {
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
    }
</script>
@endsection