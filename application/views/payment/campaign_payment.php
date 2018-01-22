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
 */
    $this->session->set_userdata('campaignid', $this->uri->segment(3));
   $this->session->set_userdata('sellerid', $sellerid=$this->uri->segment(4));
   $this->session->set_userdata('buyerid', $this->uri->segment(5));
?>
<div class="row">
    <div class="container">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 ">
            <div class="col-sm-12">
               <div class="row" id="computers" >
                 <form class="form-horizontal" role="form" enctype = 'multipart/form-data'  method="post" action="<?=BASE_URL?>campaign_payment" >
                    <!--auth/review-->
                    <input type="hidden" value="<?php echo $this->session->userdata('campaignid')?>" id="campaignid" name="campaignid" >
                    <input type="hidden" value="<?php echo $this->session->userdata('buyerid')?>" id="buyerid" name="buyerid" >
                    <input type="hidden" value="<?php echo $this->session->userdata('sellerid')?>" id="sellerid" name="sellerid" >
                    <h3>Account Info</h3>
                 <div class="form-group">
                        <label>Name: </label>
                       <input type="text" name="name" class="form-control" value="<?=set_value('name')?>">
                       <?php
                                    if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>');
                                    ?>
                          </div>
                 <div class="form-group">
                        <label>Email: </label>
                        <input type="email" name="email" class="form-control" value="<?=set_value('email')?>">
                        <?php
                                    if(form_error('email')!='') echo form_error('email','<div class="text-danger err">','</div>');
                                    ?>
                    </div>
                    <h3>Address information</h3>
                    <div class="form-group">
                        <label>Billing Address: </label>
                        
                         <input type="text" name="street" placeholder="Street Name" class="form-control" value="<?=set_value('street')?>">
                          <?php
                                if(form_error('street')!='') echo form_error('street','<div class="text-danger err">','</div>');
                                ?>
                         <input type="text" name="city" placeholder="city Name" class="form-control" value="<?=set_value('city')?>">
                          <?php
                                if(form_error('city')!='') echo form_error('city','<div class="text-danger err">','</div>');
                                ?>
                          <input type="text" name="state" placeholder="state Name" class="form-control" value="<?=set_value('state')?>">
                           <?php
                                if(form_error('state')!='') echo form_error('state','<div class="text-danger err">','</div>');
                                ?>
                           <input type="text" name="zip" placeholder="zip Code" class="form-control" value="<?=set_value('zip')?>">
                         <?php
                                if(form_error('zip')!='') echo form_error('zip','<div class="text-danger err">','</div>');
                                ?>
                          </div>
                    <div class="form-group">
                            <label>Your Selected Amount: </label>
                             <input type="text" name="amount" class="form-control" value="<?=set_value('amount')?>">
                          </div>
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
                                <input type="text" name="name_on_card" class="form-control" value="<?=set_value('name_on_card')?>">
                                <?php
                                    if(form_error('name_on_card')!='') echo form_error('name_on_card','<div class="text-danger err">','</div>');
                                    ?>
                          </div>
                     <div class="form-group">
                            <label>Credit card number</label>
                            <input type="text" name="credit_card_no" class="form-control" value="<?=set_value('credit_card_no')?>">
                            <?php
                                if(form_error('credit_card_no')!='') echo form_error('credit_card_no','<div class="text-danger err">','</div>');
                                ?>
                      </div>
                     <div class="form-group">
                            <label>Card Type</label>
                            <select name="card_type" class="form-control">
                                <option value="">Select</option>
                                <option value="Visa">VISA</option>
                                <option value="Master">Master</option>
                            </select>
                            <?php
                                if(form_error('security_code')!='') echo form_error('security_code','<div class="text-danger err">','</div>');
                                ?>
                      </div>
                     <div class="form-group">
                            <label>Security code</label>
                            <input type="password" name="security_code" class="form-control">
                            <?php
                                if(form_error('security_code')!='') echo form_error('security_code','<div class="text-danger err">','</div>');
                                ?>
                      </div>
                     <div class="form-group">
                            <label>Expiration Date</label>
                            <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YYYY" style="width: 25%" class="form-control" value="<?=set_value('expiration_date')?>">
                            <?php
                                if(form_error('expiration_date')!='') echo form_error('expiration_date','<div class="text-danger err">','</div>');
                                ?>
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
                     
                    <input type="submit" value="Pay Now" class="btn btn-primary" >
            </form>
               </div>
            </div>
        </div>
        
    </div>
</div>  

<script>
    
    $(document).ready(function(){
        $("#expiration_date").datepicker({
            format: "yyyy-mm-dd",
            orientation: "bottom auto",
            todayHighlight: true
        });
        $('#paypal').click(function(){
            $('#payinfo').hide();
        });
        $('#credit').click(function(){
            $('#payinfo').show();
        });
    });
    </script>