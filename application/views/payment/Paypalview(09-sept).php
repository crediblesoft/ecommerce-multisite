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
  if((isset($_REQUEST['paymenttype'])) && (($_REQUEST['paymenttype']=='campaign')||($_REQUEST['paymenttype']=='product')||($_REQUEST['paymenttype']=='user' || $_REQUEST['paymenttype']=='bidproduct')) ){
      ?>
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 clearfix payment_image">      
         <img class="img-responsive" src="<?php echo BASE_URL?>assets/image/paypal.jpg">
    </div>
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 payment_main">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            
            
               
                 <form id="paypalform" class="" role="form" enctype = 'multipart/form-data'  method="post" action="<?=BASE_URL?>paypal/paypalcontroller/index" >
                    <!--auth/review-->
                    <input type="hidden" value="<?php echo $_REQUEST['paymenttype']?>" id="paymenttype" name="paymenttype" >
                    <?php 
                    if((isset($_REQUEST['paymenttype'])) && ($_REQUEST['paymenttype']=='campaign'))
                    {
                    $this->session->set_userdata('campaignid', $this->uri->segment(4));
                    $this->session->set_userdata('sellerid', $sellerid=$this->uri->segment(5));
                    $this->session->set_userdata('buyerid', $this->uri->segment(6));  
                    ?>
                    <input type="hidden" value="<?php echo $this->session->userdata('campaignid')?>" id="campaignid" name="campaignid" >
                    <input type="hidden" value="<?php echo $this->session->userdata('buyerid')?>" id="buyerid" name="buyerid" >
                    <input type="hidden" value="<?php echo $this->session->userdata('sellerid')?>" id="sellerid" name="sellerid" >
                    <?php }else{ 
                    $this->session->set_userdata('data1', $this->uri->segment(4));
                    $this->session->set_userdata('data2', $sellerid=$this->uri->segment(5));
                    $this->session->set_userdata('data3', $this->uri->segment(6));  
                    ?>
                    <input type="hidden" value="<?php echo $this->session->userdata('data1')?>" id="campaignid" name="campaignid" >
                    <input type="hidden" value="<?php echo $this->session->userdata('data2')?>" id="buyerid" name="buyerid" >
                    <input type="hidden" value="<?php echo $this->session->userdata('data3')?>" id="sellerid" name="sellerid" >
                    <?php } ?>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30 margin-top_20">
                    <p class="featured_seller_head">Account information</p>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                            <label>Name: <star>*</star> </label>
                               <input type="text" name="name" id="name" class="form-control" value="<?=set_value('name')?>">
                                <?php
                                 if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>');
                                ?>
                               <span class="name_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                               <label>Email: <star>*</star></label>
                               <input type="email" name="email" id="email" class="form-control" value="<?=set_value('email')?>">
                               <?php
                                    if(form_error('email')!='') echo form_error('email','<div class="text-danger err">','</div>');
                                ?>
                               <span class="email_error"></span>
                         </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30">
                    <p class="featured_seller_head">Address information</p>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                            <label>Street: <star>*</star></label>

                            <input type="text" name="street" id="street" placeholder="Street Name" class="form-control" value="<?=set_value('street')?>">
                              <?php
                                    if(form_error('street')!='') echo form_error('street','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="street_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                    <label>City: <star>*</star></label>
                <input type="text" name="city" id="city" placeholder="city Name" class="form-control" value="<?=set_value('city')?>">
                              <?php
                                    if(form_error('city')!='') echo form_error('city','<div class="text-danger err">','</div>');
                               ?>
                               <span class="city_error"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>State: <star>*</star></label>
                            <input type="text" name="state" id="state" placeholder="state Name" class="form-control" value="<?=set_value('state')?>">
                               <?php
                                    if(form_error('state')!='') echo form_error('state','<div class="text-danger err">','</div>');
                                    ?>
                                <span class="state_error"></span>
                        </div>
             </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group required">
                            <label>Zip Code: <star>*</star></label>
                            <input type="text" name="zip" id="zip" placeholder="zip Code" class="form-control" value="<?=set_value('zip')?>">
                             <?php
                                    if(form_error('zip')!='') echo form_error('zip','<div class="text-danger err">','</div>');
                                    ?>
                            <span class="zip_error"></span>
                        </div>
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
                        <div class="form-group required">
                                <label>Your Selected Amount: <star>*</star></label>
                                <?php if(($_REQUEST['paymenttype']=='product')){
                                $amount='value="'.$this->cart->total().'"'; 
                                $this->session->set_userdata("total_payment_price",$this->cart->total());
                                }elseif (($_REQUEST['paymenttype']=='user')) {
                                     $amount='value="'.$this->session->userdata('themeprice').'"'; 
                                     $this->session->set_userdata("total_payment_price",$this->session->userdata('themeprice'));
                                    }else if($_REQUEST['paymenttype']=='bidproduct'){
                                        $amount='value="'.$bidprice.'"';
                                        $this->session->set_userdata("total_payment_price",$bidprice);
                                    }$disabled='readonly="readonly"'?>
<div class="input-group">
                                    <span class="input-group-addon">$</span>
                                <input type="text" name="amount" id="amount" <?php if(($_REQUEST['paymenttype']=='product')||($_REQUEST['paymenttype']=='user' || $_REQUEST['paymenttype']=='bidproduct')){echo $amount.$disabled;}else{?> value="<?=set_value('amount')?>" <?php } ?> class="form-control" onkeyup="checknumber(this.id,this.value)" > </div>
                                <span class="amount_error text-danger"></span>
                        </div>
                    </div>
                    <div class="" id="payinfo" style="display: none;">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30">
                            <p class="featured_seller_head">Payment information</p>
                      </div>  
                     
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                                <label>Name on card:  <star>*</star></label>
                                <input type="text" name="name_on_card" id="name_on_card" class="form-control" value="<?=set_value('name_on_card')?>">
                                <?php
                                    if(form_error('name_on_card')!='') echo form_error('name_on_card','<div class="text-danger err">','</div>');
                                    ?>
                                <span class="name_on_card_error"></span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                               <label>Credit card number:  <star>*</star></label>
                               <input type="text" name="credit_card_no" id="credit_card_no" class="form-control" value="<?=set_value('credit_card_no')?>">
                               <?php
                                   if(form_error('credit_card_no')!='') echo form_error('credit_card_no','<div class="text-danger err">','</div>');
                                   ?>
                               <span class="credit_card_no_error"></span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                               <label>Card Type</label>
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
                               <input type="password" id="password" name="security_code" class="form-control">
                             <?php
                                   if(form_error('security_code')!='') echo form_error('security_code','<div class="text-danger err">','</div>');
                                   ?>
                               <span class="password_error"></span>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                               <label>Expiration Date: <star>*</star></label>
                               <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YYYY" style="width: 30%" class="form-control" value="<?=set_value('expiration_date')?>">
                               <?php
                                   if(form_error('expiration_date')!='') echo form_error('expiration_date','<div class="text-danger err">','</div>');
                                   ?>
                               <span class="expiration_date_error"></span>
                        </div>
                      </div>
                    </div>
                    <?php /*?>
                    <div class="form-group">
                        <label>Pay with</label><br>
                        <input type="radio" value="2" id="paypal" name="paytype">
                        Your Paypal Account
                        <input type="radio" value="1" id="credit"  name="paytype"> Using Credit Card
                          </div>
                    <div class="" id="payinfo" style="display: none;">
                     <h3>Payment Info</h3>
                        <div class="form-group">
                                <label>Name on card</label>
                                <input type="text" name="name_on_card" class="form-control">
                                
                          </div>
                     <div class="form-group">
                            <label>Credit card number</label>
                            <input type="text" name="credit_card_no" class="form-control">
                            
                      </div>
                     <div class="form-group">
                            <label>Card Type</label>
                            <select name="card_type" class="form-control">
                                <option value="">Select</option>
                                <option value="VISA">VISA</option>
                                <option value="">Select</option>
                            </select>
                            
                      </div>
                     <div class="form-group">
                            <label>Security code</label>
                            <input type="password" name="security_code" class="form-control">
                            
                      </div>
                     <div class="form-group">
                            <label>Expiration Date</label>
                            <input type="text" name="expiration_date" id="expiration_date" placeholder="MM/YYYY" style="width: 25%" class="form-control">
                            
                      </div>
                    </div>
                      <?php */?>  
                    <div class="form-group pull-right">
                        <div class="col-md-4">  
                            <!--<input type="submit" value="Pay Now" class="btn btn-success" >-->
                            <img src="<?=BASE_URL?>assets/image/authorizepayment.png" class="payment_submit">
                        </div>
                    </div>
            </form>
               </div>
            </div>
       
        
    </div>
</div>

<script>
//    $('#paypalform').on('before-submit',function(){
//   alert('Before submit performed');
//});



$(document).on('click', '.payment_submit', function(e) {
    //alert();
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
    var password=$("#password").val().trim(); 
    var expiration_date=$("#expiration_date").val().trim();
    
        
     
    //alert(amount);
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
    
    if(zip==""){
        formalert('zip');
        counert++;
        //return false;
    }
    if(state==""){
        formalert('state');
        counert++;
        //return false;
    }
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
        
        
        
        if(password==""){
            formalert('password');
            counert++;
            //return false;
        }
        if(expiration_date==""){
            formalert('expiration_date');
            counert++;
            //return false;
        }
    }
    //alert(counert);
    if(counert==0){
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
            format: "yyyy-mm-dd",
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
  <?php } ?>

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
