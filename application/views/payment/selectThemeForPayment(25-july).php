<?php //print_r($themeprice);echo "<br/><br/><br/>";
//print_r($subsdata); exit;
//echo $BASE_URL; exit;
if($themedataget['res']){
$themedataget=$themedataget['rows'];
//print_r($themedataget);echo "<br/><br/><br/>";
?>
<style>    
    .uppercase {text-transform: uppercase;}
    .lowercase {text-transform: lowercase;}
    .capitalize {text-transform: capitalize;}
    .rt-span{margin-left: 10px;}
    .lft-ttl{font-weight: bold;}
    .custom_h4{font-weight: bold;}
    .custom_body{margin-top: 20px; margin-left: 25px;}
    .custom_payment_btn{margin-top: 25px;}
</style>


<div class="col-sm-9">
    <div class="row">
        <div class="">
            <div class="contant-head">
                <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> 
                     Premium Membership  </h4><h5> > Select </h5>
            </div>
        </div>
    </div>
   
   
    <div class="contant-body2 custom_body">
         <?php 
        if($userpaid['rows']->paid==1){
         //echo "<pre>";   
         //print_r($subsdata); exit;
         $sub_type=$subsdata['rows'][0]->type; 
         $sub_end=$subsdata['rows'][0]->end_date;
        echo "<h4 class='custom_h4'>Yor are already subscribed</h4>";
        echo  '<p><span class="lft-ttl">Subscription Type:-</span><span class="rt-span">'.$sub_type.'</span></p>';
        echo  '<p><span class="lft-ttl">Subscription Expire:-</span><span class="rt-span">'.date('d-M-Y',  strtotime($sub_end)).'</span></p>';
    }
    else{
        ?>
        <?php if($userprice['res'])            
        {?>
        <div class="table-responsive ">
            <table class="table table-bordered cus-table-bordered">
                <thead class="cus-thead">            
                    <tr>
                        <td>S.No.</td>
                        <td>Price</td>
                        <td>Days</td>
                        <td>Massage</td>
                        <td>Email</td>
                        <td>Videos</td>
                        <td>Gallery</td>
                        <td>Product</td>
                        <td></td>
                    </tr>
                </thead>
            
            
                <tbody>
                    <?php $i=0; foreach ($userprice['rows'] as $themepricedata){ 
                    //echo "<pre>";
                        //print_r($themepricedata); exit;
                        $i++;  ?>
                    <tr class="text-center">
                        <td><?php echo $i;?></td>
                        <td><?php echo '$ '.$themepricedata->price?></td>
                        <td><?php echo $themepricedata->noOfDays?></td>  
                        <td class="capitalize"><?php echo $themepricedata->email?></td>
                        <td class="capitalize"><?php echo $themepricedata->massage?></td>
                        <td class="capitalize"><?php echo $themepricedata->videos?></td>
                        <td class="capitalize"><?php echo $themepricedata->gallery?></td>
                        <td class="capitalize"><?php echo $themepricedata->product?></td>
                        <td><input type="radio" value="<?php echo $themepricedata->id;?>" id="sub_type_<?php echo $i;?>" name="sub_type" checked="checked" onclick="change_opt(this.value);"></td>
<!--                       <td>
                             <?php                            
                              //$theme_id='777';//$themepricedata->theam_id;
                              //$buyerid=$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'';
                              //$price=$themepricedata->price;
                              //$url=BASE_URL.'payment/index/'.$theme_id.'/'.$price.'/'.$buyerid.'?paymenttype=user';
							  $url=BASE_URL.'payment/index/'.$theme_id.'/'.$buyerid.'?paymenttype=user';
                              //$theme='';
                              //$theme=$theme_id!='1001'? $theme_id!='1002'? $theme_id!='1003'? $theme_id!='1004'? '777' :'theme4' : 'theme3' : 'theme2' : 'theme1';
                              ?>
                            <?php if($userpaid['rows']->paid){ ?>
                            Paid user
                            <?php }else{ ?>
                            <a href="<?php echo $url?>" >Go For Payment</a>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#purchase_theme" >Go For Payment</a>
                            <?php } ?>
                        </td>-->
                    </tr>
                    <?php } ?>
                </tbody>
        </table>
        </div>
        
        <div class="custom_payment_btn">
            <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#purchase_theme" >Go For Payment</a>
        </div>
        <?php }}?>
    </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="purchase_theme" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Apply Promotion code</h4>
        </div>
        <div class="modal-body">
            <p><span id="msg"></span>
                <table class="table table-bordered">
<!--                <thead>
                  <tr>
                    <th>#</th>
                    <th>Firstname</th>
                  </tr>
                </thead>-->
                <tbody>
                  <tr>
                    <td>Enter Promo Code</td>
                    <td>
                        <div class = "input-group">
                            <input type = "text" class = "form-control" id="promo_code">
                            <span class = "input-group-btn">
                               <button class = "btn btn-success" id="apply_btn" type = "button">Apply</button>
                            </span>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Amount</td>
                    <td id="amt"></td>
                  </tr>
                  <tr>
                    <td>Discount</td>
                    <td id="disc">0</td>
                  </tr>
                  <tr>
                    <td>Total Amount</td>
                    <td id="total"></td>
                  </tr>
                </tbody>
              </table>
            </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="float:left;">Close</button>
          <a href="javascript:pay();"  class="btn btn-success"  id="btn-paynow" style="float:left;">Pay now</a>
          <a href="<?=BASE_URL?>paiduser/freepromo"  class="btn btn-success"  id="btn-submit" style="float:left; display: none;">Submit</a>
        </div>
      </div>
      
    </div>
  </div>



<?php }?>
<?php /*?>
<div class="col-sm-9">
            <div class="row">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>paiduser"> Theme</a> </h4><h5> > Select </h5>
<!--                         <span class="add-button"><a class="btn btn-success" href="<?=BASE_URL?>"> <span class="glyphicon glyphicon-plus-sign"></span> View Theme</a></span>-->
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="row">                   
                        <?php foreach ($themedataget as $themedata){ ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <?php                            
                              $theme_id=$themedata->theam_id;
                              $buyerid=$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'';
                              $price=$themeprice['rows'][0]->price;
                              $url=BASE_URL.'payment/index/'.$theme_id.'/'.$price.'/'.$buyerid.'?paymenttype=user';
                              $theme='';
                              $theme=$theme_id!='1001'? $theme_id!='1002'? $theme_id!='1003'? $theme_id!='1004'? '' :'theme4' : 'theme3' : 'theme2' : 'theme1';
                              ?>
                        <a href="<?php echo $url?>" >
                       <img class="img img-responsive img-bordered block" src="<?php echo BASE_URL.'edit_assets/image/'.$theme.'/01.png'?>"style="border: 1px solid rgb(255, 24, 24);box-shadow: 0px 0px 16px 0px rgb(219, 11, 11);" >
                        </a>
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <span style="font-size: 18px;color: #000000;font-weight: 500">Your Theme Is</span>
                               <?php echo '<span style="font-size: 25px;color: #28C769;font-weight: 500;">  '.$theme_id.'</span>';?>
                           <span style="font-size: 18px;color: #000000;font-weight: 500">Price Of </span>
                               <?php echo '<span style="font-size: 25px;color: #28C769;font-weight: 500"> $ '.$price.'</span>';?>
                           </div>
                       </div>
                        <?php }?>
                    
                </div>
            </div>
        </div>
      <?php */?>  
        
    </div>
</div>

<script>
$("#apply_btn").click(function(){
        var promocode=$("#promo_code").val();
        $.post("<?=BASE_URL?>paiduser/get_code_details",{code:promocode},function(data,status){
            obj=$.parseJSON(data);
            if(obj.status){
				    var discount=parseFloat(obj.result);
					var amt=$("#amt").html();
                                        var disc_amt=parseFloat(amt)*(discount/100).toFixed(2);
					var total=parseFloat(amt)-parseFloat(disc_amt);
                                        $("#msg").html('Congratulations ! Promo code is applied.');
					$("#msg").css('color','green');
					$("#disc").html(disc_amt+'  ('+discount+'%)');
					$("#total").html(total);
					$("#btn-paynow").css('display','block');
					//set_session('subscription_total_amt',total);
					if(total=='0'){
                                         $("#btn-paynow").css('display','none');
                                         $("#btn-submit").css('display','block');
                                        }
					
            }else
                {
                    $("#msg").html(obj.result);
					$("#msg").css('color','red');
					$("#promo_code").focus();
                }
        });
    });
	
	function set_session(sessname,sessvalue)
	{
            $.post("<?=BASE_URL?>paiduser/set_session",{name:sessname,value:sessvalue},function(data,status){
            obj=$.parseJSON(data);
            if(obj.status){
            window.location.assign('<?php echo $url;?>');
            }
        });
		
	}
        function pay(){
         var total=$("#total").html();
          var promocode=$("#promo_code").val();
          //alert(promocode);
         set_session('subscription_total_amt',total);
         set_session('promotioncode',promocode);
        }

</script>  
     
<script>
    $(document).ready(function(){
    var aa=$('input[type="radio"]:checked').val();
    //alert(aa);
    change_opt(aa);
    });
   
          function change_opt(id){ 
              $.post("<?=BASE_URL?>paiduser/subs_amount",{id:id},function(data){
                obj=$.parseJSON(data);
                //alert(obj.subsdata['rows']['id']);
                if(obj.subsdata['rows']['id']){	
                $("#amt").html(obj.subsdata['rows']['price']);
                $("#total").html(obj.subsdata['rows']['price']);
                //document.getElementById("amt").innerHTML = obj.subsdata['rows']['price'];
                //document.getElementById("total").innerHTML = obj.subsdata['rows']['price'];
                }
                
        });
         }
</script> 
