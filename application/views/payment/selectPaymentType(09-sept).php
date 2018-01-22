<?php 
//echo $crt_id=$this->input->post('ads_category'); exit;
//echo $this->session->userdata('ads_category');exit;
//print_r($data); exit;
//echo $_REQUEST['paymenttype']; exit;
?>
<style>
    .paymenttype2{
        font-size: 20px;
        color: #00AE3A;
    }
    .paymenttype{text-align: center;margin-top: 60px;}
    .paymenttype1{
        text-align: center;
        font-size: 16px;
        color: #000000;
    }.siteshdow{background: #f9f9f9;height: 180px;}
    .paymenttype4{margin-top: 50px;
    }//.paymenttype4 img:hover{cursor: pointer;}
    @media (max-width: 768px) {
        .paymenttype5{}
        .paymenttype6{margin-top: 10px;}
        .siteshdow{background: #f9f9f9;height: 250px;}
    }
</style><?php //print_r($str); ?>
<div class="container">
    <div class="paymenttype">
        <div class="paymenttype1">
            <span >
                <img class="" src="<?php echo BASE_URL?>assets/image/right_hand.jpg">
            </span>
            Please Choose A Payment Method <!--And Click <span class="paymenttype2">Continue..</span>-->
        </div>
        <div class="row">
            <div class="container siteshdow">
<!--                <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group"> 
                    <button type="submit" class="btn siteshdow_header_btn btn-block" id="signup">Submit</button>
                </div>
                </div>-->
<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 paymenttype4">
<!--    <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6 paymenttype5">
        <a href="<?php echo BASE_URL.'paypal/paypalcontroller/index/'.$str?>">
           <img class="img-responsive block" src="<?php echo BASE_URL?>assets/image/paypal.jpg">
        </a>
    </div>-->
    <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6 paymenttype6">
        <a href="<?php echo BASE_URL.'braintree/braintreecontroller/index/'.$str?>">
            <img class="img-responsive block" src="<?php echo BASE_URL?>assets/image/braintree.png">
        </a>
    </div>
    <div class="col-lg-6 col-sm-6 col-xs-12 col-md-6 paymenttype6">
        <a href="<?php echo BASE_URL.'authorizepayment/authorizecontroller/index/'.$str?>">
            <img class="img-responsive block" src="<?php echo BASE_URL?>assets/image/authorize.jpg">
        </a>
    </div>
    
</div>
            </div>
        </div>
    </div>
</div>
