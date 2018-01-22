<?php /*
    echo '<br/>1'.$controller=$this->uri->segment(1);
      echo '<br/>2'.$function=$this->uri->segment(2);
      echo '<br/>3'.$campaignid=$this->uri->segment(3);
      echo '<br/>4'.$sellerid=$this->uri->segment(4); 
      echo '<br/>5'.$buyerid=$this->uri->segment(5); 
        //$campaignid.$sellerid.$buyerid;
        exit;
 * 
Developer.Authorize.net
Your Sandbox Gateway ID is: 529330
 sachinucodice07
 Sachin@ucodice
API Login ID:-          563xvGNj
Transaction Key:-       86mE8m832Uv5EyEZ
Secret Key:-            Simon
 * paypal/paypalcontroller/index?paymenttype=campaign
 */
  if((isset($_REQUEST['paymenttype'])) && (($_REQUEST['paymenttype']=='campaign')||($_REQUEST['paymenttype']=='product')||($_REQUEST['paymenttype']=='user' || $_REQUEST['paymenttype']=='bidproduct' || $_REQUEST['paymenttype']=='ads')) ){
      ?>
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 clearfix payment_image">      
         <img class="img-responsive" src="<?php echo BASE_URL?>assets/image/paypal.jpg">
    </div>
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 payment_main">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            
            
               
                 <form class="" id="paypalform" role="form" enctype = 'multipart/form-data'  method="post" action="<?=BASE_URL?>paypal/paypalcontroller/index" >
                    <!--auth/review-->
                    <input type="hidden" value="<?php echo $_REQUEST['paymenttype']?>" id="paymenttype" name="paymenttype" >
                    <?php 
                    if((isset($_REQUEST['paymenttype'])) && ($_REQUEST['paymenttype']=='campaign'))
                    {/*
                    $this->session->set_userdata('campaignid', $this->uri->segment(4));
                    $this->session->set_userdata('sellerid', $sellerid=$this->uri->segment(5));
                    $this->session->set_userdata('buyerid', $this->uri->segment(6));  */
                    ?>
                    <input type="hidden" value="<?php echo $this->session->userdata('campaignid')?>" id="campaignid" name="campaignid" >
                    <input type="hidden" value="<?php echo $this->session->userdata('buyerid')?>" id="buyerid" name="buyerid" >
                    <input type="hidden" value="<?php echo $this->session->userdata('sellerid')?>" id="sellerid" name="sellerid" >
                    <?php } ?>
                    
                    <?php 
                    if((isset($_REQUEST['paymenttype'])) && ($_REQUEST['paymenttype']=='bidproduct'))
                    {/*
                    $this->session->set_userdata('campaignid', $this->uri->segment(4));
                    $this->session->set_userdata('sellerid', $sellerid=$this->uri->segment(5));
                    $this->session->set_userdata('buyerid', $this->uri->segment(6));  */
                    ?>
                    <input type="hidden" value="<?php echo $this->uri->segment(4)?>" id="campaignid" name="campaignid" >
                    <input type="hidden" value="<?php echo $this->uri->segment(5)?>" id="sellerid" name="sellerid" >
                    <?php } ?>
                    
                    <?php 
                    if((isset($_REQUEST['paymenttype'])) && ($_REQUEST['paymenttype']=='ads')){?>
                       <input type="hidden" value="<?php echo $this->uri->segment(4)?>" id="ads_id" name="ads_id" >  
                   <?php }
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30 margin-top_20">
                        <p class="featured_seller_head">
                             <?php 
                            if((isset($_REQUEST['paymenttype'])) && (($_REQUEST['paymenttype']=='bidproduct') || ($_REQUEST['paymenttype']=='product')))
                            { ?>
                                Shipping information
                            <?php }else{ ?>
                                Address information
                            <?php } ?> 
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                               <label>Name: <star>*</star></label>
                               <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?=set_value('name')?>">
                              <?php
                                 if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>');
                                ?>
                               <span class="name_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                               <label>Email: <star>*</star></label>
                               <input type="email" name="email" placeholder="Email" id="email" class="form-control" value="<?=set_value('email')?>">
                               <?php
                                           if(form_error('email')!='') echo form_error('email','<div class="text-danger err">','</div>');
                                           ?>
                               <span class="email_error"></span>
                         </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Street: <star>*</star></label>

                            <input type="text" name="street" id="street" placeholder="Street" class="form-control" value="<?=set_value('street')?>">
                              <?php
                                    if(form_error('street')!='') echo form_error('street','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="street_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>City: <star>*</star></label>
                            <input type="text" name="city" id="city" placeholder="City" class="form-control" value="<?=set_value('city')?>">
                              <?php
                                    if(form_error('city')!='') echo form_error('city','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="city_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>State: <star>*</star></label>
                            <input type="text" name="state" id="state" placeholder="State" class="form-control" value="<?=set_value('state')?>">
                               <?php
                                    if(form_error('state')!='') echo form_error('state','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="state_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Zip Code: <star>*</star></label>
                            <input type="text" name="zip" id="zip" placeholder="Zip Code" class="form-control" value="<?php if(set_value('zip')!=''){ echo set_value('zip');}else{echo $this->session->userdata('shipto');}?>" <?php if((isset($_REQUEST['paymenttype'])) && (($_REQUEST['paymenttype']=='bidproduct') || ($_REQUEST['paymenttype']=='product'))){?> readonly <?php }?>>
                             <?php
                                    if(form_error('zip')!='') echo form_error('zip','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="zip_error"></span>
                        </div>
                    </div>
                    
                    <?php 
                    if((isset($_REQUEST['paymenttype'])) && (($_REQUEST['paymenttype']=='bidproduct') || ($_REQUEST['paymenttype']=='product')))
                    { ?>
                    <input type="hidden" id="same_billing_text" name="same_billing_text" value="1">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30">
                    <p class="featured_seller_head">Billing information</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group required">
                            <input type="checkbox" name="samebilling" class="samebilling" id="samebilling" value="1"> check if billing information same as shipping
                            
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                               <label>Name: <star>*</star></label>
                               <input type="text" name="name1" id="name1" placeholder="Name" class="form-control" value="<?=set_value('name1')?>">
                              <?php
                                 if(form_error('name1')!='') echo form_error('name1','<div class="text-danger err">','</div>');
                                ?>
                               <span class="name1_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                               <label>Email: <star>*</star></label>
                               <input type="email" name="email1" placeholder="Email" id="email1" class="form-control" value="<?=set_value('email1')?>">
                               <?php
                                           if(form_error('email1')!='') echo form_error('email1','<div class="text-danger err">','</div>');
                                           ?>
                               <span class="email1_error"></span>
                         </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Street: <star>*</star></label>

                            <input type="text" name="street1" id="street1" placeholder="Street" class="form-control" value="<?=set_value('street1')?>">
                              <?php
                                    if(form_error('street1')!='') echo form_error('street1','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="street1_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>City: <star>*</star></label>
                            <input type="text" name="city1" id="city1" placeholder="City" class="form-control" value="<?=set_value('city1')?>">
                              <?php
                                    if(form_error('city1')!='') echo form_error('city1','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="city1_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>State: <star>*</star></label>
                            <input type="text" name="state1" id="state1" placeholder="State" class="form-control" value="<?=set_value('state1')?>">
                               <?php
                                    if(form_error('state1')!='') echo form_error('state1','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="state1_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Zip Code: <star>*</star></label>
                            <input type="text" name="zip1" id="zip1" placeholder="Zip Code" class="form-control" value="<?=set_value('zip1')?>">
                             <?php
                                    if(form_error('zip1')!='') echo form_error('zip1','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="zip1_error"></span>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <input type="hidden" id="same_billing_text" name="same_billing_text" value="0">
                    <?php } ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30">
                    <p class="featured_seller_head">Payment type</p>
                    </div>
                    
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                            <label>Pay with </label><br>
                            <input type="radio" checked="checked" value="2" id="paypal" class="paytype" name="paytype">
                            Paypal account
                            <input type="radio" value="1" id="credit"  class="paytype" name="paytype"> Using credit card
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                                <label>Your selected amount: </label>
                                <?php if(($_REQUEST['paymenttype']=='product')){
                                $amount='value="'.$this->session->userdata('total_product_price').'"'; // $this->cart->total()
                                $this->session->set_userdata("total_payment_price",$this->session->userdata('total_product_price'));
                                }elseif (($_REQUEST['paymenttype']=='user')) {
                                     $amount='value="'.$this->session->userdata('themeprice').'"'; 
                                     $this->session->set_userdata("total_payment_price",$this->session->userdata('themeprice'));
                                    }else if($_REQUEST['paymenttype']=='bidproduct'){
                                        $amount='value="'.$this->session->userdata('total_product_price').'"';
                                        $this->session->set_userdata("total_payment_price",$this->session->userdata('total_product_price'));
                                    }
                                    else if($_REQUEST['paymenttype']=='ads'){
                                        $amount='value="'.$this->session->userdata('price').'"';
                                        $this->session->set_userdata("price",$this->session->userdata('price'));
                                    }
                                    $disabled='readonly="readonly"'?>
<div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" placeholder="Your selected amount" name="amount" id="amount" <?php if(($_REQUEST['paymenttype']=='product')||($_REQUEST['paymenttype']=='user' || $_REQUEST['paymenttype']=='bidproduct' || $_REQUEST['paymenttype']=='ads')){echo $amount.$disabled;}else{?> value="<?=set_value('amount')?>" <?php } ?> class="form-control" onkeyup="checknumber(this.id,this.value)" > </div>
                                <span class="amount_error"></span>
                        </div>
                    </div>
                    <div class="" id="payinfo" style="display: none;">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30">
                            <p class="featured_seller_head">Payment information</p>
                      </div> 
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                                <label>Name on card: <star>*</star></label>
                                <input type="text" name="name_on_card" placeholder="Name on card" id="name_on_card" class="form-control" value="<?=set_value('name_on_card')?>">
                                <?php
                                    if(form_error('name_on_card')!='') echo form_error('name_on_card','<div class="text-danger err">','</div>');
                                    ?>
                                <span class="name_on_card_error"></span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                               <label>Credit card number: <star>*</star></label>
                               <input type="text" name="credit_card_no" placeholder="Credit card number" id="credit_card_no" class="form-control" value="<?=set_value('credit_card_no')?>">
                               <?php
                                   if(form_error('credit_card_no')!='') echo form_error('credit_card_no','<div class="text-danger err">','</div>');
                                   ?>
                               <span class="credit_card_no_error"></span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                               <label>Card Type: <star>*</star></label>
                               <select name="card_type" id="card_type" class="form-control">
                                   <option value="">Select</option>
                                   <option value="Visa">VISA</option>
                                   <option value="Master">Master</option>
                               </select>
                               <?php
                                   if(form_error('security_code')!='') echo form_error('security_code','<div class="text-danger err">','</div>');
                                   ?>
                               <span class="card_type_error"></span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                               <label>Security code: <star>*</star></label>
                               <input type="password" name="security_code" placeholder="Security code" id="security_code" class="form-control">
                               <?php
                                   if(form_error('security_code')!='') echo form_error('security_code','<div class="text-danger err">','</div>');
                                   ?>
                               <span class="password_error"></span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                               <label>Expiration Date: <star>*</star></label>
                               <input type="text" id="expiration_date"  name="expiration_date" placeholder="MM/YYYY" style="width: 30%" class="form-control" value="<?=set_value('expiration_date')?>">
                               <?php
                                   if(form_error('expiration_date')!='') echo form_error('expiration_date','<div class="text-danger err">','</div>');
                                   ?>
                               <span class="expiration_date_error"></span>
                        </div>
                      </div>
                    </div>
                                      
                    
                    <div class="form-group pull-right">
                        <div class="col-md-4">  
                            <!--<input type="submit" value="Pay Now" class="btn btn-primary" >-->
                            <img src="<?=BASE_URL?>assets/image/authorizepayment.png" class="payment_submit">
                        </div>
                    </div>
            </form>
               </div>
            </div>
       
        
    </div>
</div>
<style>
#loading {width: 100%;height: 100%;top: 0px;left: 0px;position: fixed;display: none; z-index: 99; text-align: center;background:#000000; opacity:0.5;}
#loading-image {position: absolute;top: 50%;width:150px; z-index: 100}
.custom_p_tag{position: absolute;top: 75%; left:35%; z-index: 100; font-size: 24px;color: background;}
</style>
<div id="loading">
<img id="loading-image" src="<?php echo BASE_URL?>assets/image/loading2.gif" alt="Loading..." />
<p class='custom_p_tag'>Kindly do not Refresh and closed the payment window</p>
</div>
<script>
$("#samebilling").click(function(){
        if($(this).prop('checked')==true){
            $("#name1").prop("disabled",true);
            $("#email1").prop("disabled",true);
            $("#city1").prop("disabled",true);
            $("#street1").prop("disabled",true);  
            $("#zip1").prop("disabled",true); 
            $("#state1").prop("disabled",true);
            $("#same_billing_text").val('0');
        }else{
            $("#name1").prop("disabled",false);
            $("#email1").prop("disabled",false);
            $("#city1").prop("disabled",false);
            $("#street1").prop("disabled",false);  
            $("#zip1").prop("disabled",false); 
            $("#state1").prop("disabled",false);
            $("#same_billing_text").val('1');
        }
    });




$(document).on('click', '.payment_submit', function(e) {
    
    var counert=0;
    var name=$("#name").val().trim();  
    var email=$("#email").val().trim();    
    var city=$("#city").val().trim(); 
    
    var street=$("#street").val().trim();     
    var zip=$("#zip").val().trim(); 
    var state=$("#state").val().trim();    
    //var paytype=$("input[name=paytype]").val();//$("paytype").val().trim();
    var paytype=$('.paytype:checked').val();
    var amount=$("#amount").val().trim();
    
    var name_on_card=$("#name_on_card").val().trim();    
    var credit_card_no=$("#credit_card_no").val().trim(); 
    var card_type = $("#card_type").val().trim(); 
    var password=$("#security_code").val().trim(); 
    var expiration_date=$("#expiration_date").val().trim();
    
        
      if(name==""){
        formalert('name');
        counert++;
        //return false;
    } 
    if(email==""){
        formalert('email');
        counert++;
        //return false;
    }else{
        if(!validateEmail(email)){
            $("#email").focus();
            $(".email_error").html("Enter valid email.");
            $(".email_error").parent().addClass("has-error");
            return false;
        }
    }
    
    
    if(city==""){
        formalert('city');
        counert++;
        //return false;
    }
    if(street==""){
        formalert('street');
        counert++;
        //return false;
    }
    
    <?php 
        if((isset($_REQUEST['paymenttype'])) && (($_REQUEST['paymenttype']=='bidproduct') || ($_REQUEST['paymenttype']=='product')))
        { ?>
    if(zip==""){
        formalert('zip');
        counert++;
        //return false;
    }else if(zip!=<?php echo $this->session->userdata('shipto'); ?>){
        alert("zip code should be same");
        $("#zip").focus();
        $(".zip_error").parent().addClass("has-error");
        counert++;
        return false;
    }
        <?php }else{ ?>
        if(zip==""){
        formalert('zip');
        counert++;
        //return false;
    }
        <?php } ?> 
            
    if(state==""){
        formalert('state');
        counert++;
        //return false;
    }
    
    // Apr 6th 2016
        <?php 
        if((isset($_REQUEST['paymenttype'])) && (($_REQUEST['paymenttype']=='bidproduct') || ($_REQUEST['paymenttype']=='product')))
        { ?>
    var same_billing_text = $("#same_billing_text").val().trim();
   //alert(same_billing_text);
    //if($("#samebilling").prop('checked')==false){   
    if(same_billing_text==1){
        var name1=$("#name1").val().trim();  
        var email1=$("#email1").val().trim();    
        var city1=$("#city1").val().trim(); 

        var street1=$("#street1").val().trim();     
        var zip1=$("#zip1").val().trim(); 
        var state1=$("#state1").val().trim();
        
        
    if(name1==""){
        formalert('name1');
        counert++;
        //return false;
    } 
    if(email1==""){
        formalert('email1');
        counert++;
        //return false;
    }else{
        if(!validateEmail(email1)){
            $("#email1").focus();
            $(".email1_error").html("Enter valid email.");
            $(".email1_error").parent().addClass("has-error");
            return false;
        }
    }
    
    
    if(city1==""){
        formalert('city1');
        counert++;
        //return false;
    }
    if(street1==""){
        formalert('street1');
        counert++;
        //return false;
    }
    
    if(zip1==""){
        formalert('zip1');
        counert++;
        //return false;
    }
    
    if(state1==""){
        formalert('state1');
        counert++;
        //return false;
    }
    }
                    <?php } 
                    ?>  
    
    
    if($.isNumeric(amount)) { }else{formalert(); counert++;}   
    if( amount=="") {
            formalert('amount');
            counert++;
            //return false;
        } 
        if(paytype==""){
        //formalert('aa');
        counert++;
        //return false;
    }
    
    if(paytype!='2'){    
           
        if(name_on_card==""){
            formalert('name_on_card');
            counert++;
            //return false;
        }
        if(credit_card_no==""){
            formalert('credit_card_no');
            counert++;
            //return false;
        }
        
        if(card_type==""){
            formalert('card_type');
            counert++;
            //return false;
        }
        
        
        
//        if(password==""){
//            formalert('password');
//            counert++;
//            //return false;
//        }
        if(expiration_date==""){
            formalert('expiration_date');
            counert++;
            //return false;
        }
    }
    //alert(counert);
    if(counert==0){
         $('#loading').css('display','block');
         $('#payment_submit').css('display','none');
        $("#paypalform").submit();
        return true;
    }else{
         
        return false;}
    
});
function formalert(id){
    $("#"+id).focus();
    $("."+id+"_error").parent().addClass("has-error");
    return false;
    } 
    $(document).ready(function(){
        /*$("#expiration_date").datepicker({
            format: "mm/yy",
            orientation: "bottom auto",
            todayHighlight: true
        });*/
        $('#paypal').click(function(){
            $('#payinfo').hide();
        });
        $('#credit').click(function(){
            $('#payinfo').show();
        });
    });
    
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){ 
            $("."+id+"_error").html("Enter Only Numeric Value");
            $("#"+id).focus();
            $("."+id+"_error").parent().addClass("has-error");
            //return false;
        }}else{ 
            $("."+id+"_error").html("");
            $("#"+id).focus();
            $("."+id+"_error").parent().removeClass("has-error");
        }
    }
    
    
    function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
   }
    
    </script>
  <?php }?>

 <script>
    //var $j = jQuery.noConflict();
    $(function(){
        $( "#expiration_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'mm/yy',
            autoclose:true,
	    minDate: 0
        });
        
    });
</script>
