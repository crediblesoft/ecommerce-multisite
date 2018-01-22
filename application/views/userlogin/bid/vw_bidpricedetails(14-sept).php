
<div class="col-sm-9">
    <div class="row">
        <div class="">
            <div class="contant-head">
                 <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>bid/product"> Bid Product </a> </h4><h5> > price details </h5>
            </div>
        </div>
    </div>
	<?php
	if($this->session->has_userdata("shipto")){ echo "Shipping to :".$this->session->userdata("shipto"); echo "&nbsp;&nbsp;<a href='javascript:void(0);'  data-toggle='modal' data-target='#changeship'>change</a>"; }
    ?>
<div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 cart-total-main table-responsive">  <!-- cart-total-main -->
    <form id="bidform" method="post" action="<?=BASE_URL?>payment/index/<?=$this->uri->segment(3)?>/<?php echo $this->uri->segment(4); ?>?paymenttype=bidproduct" >
   <table class="table table-bordered text-center">
       <thead >
         <tr>
           <th class="text-center">Seller</th>
           <th class="text-center">Product price</th>
           <th class="text-center">Tax charged (%)</th>
           <th class="text-center">Total tax</th>
           <th class="text-center">Select shipping</th>
           <th class="text-center">Subtotal</th>
         </tr>
       </thead>
       <tbody>
       <?php $total_for_payment=0;$f_total=0;
         $i=1;
         if($tax){
         foreach($tax as $vwtaxamt){ $total_for_payment+=$vwtaxamt->sub_total; ?>
         <tr>
           <td class="cart_text"><?php echo $vwtaxamt->f_name.' '.$vwtaxamt->l_name; ?></td>
           <td class="cart_text">$<?php echo $vwtaxamt->prod_total;?></td>
           <td class="cart_text"><?php echo $vwtaxamt->desc;?> (<?php echo $vwtaxamt->tax;?> %)</td>
           <td class="cart_text">$<?php echo $vwtaxamt->sub_total_tax; ?></td>
           <td>
               <?php 
                  if(count($vwtaxamt->shippingdetails['fedex'])>0){?>
               <select class="form-control shippingclass" name="shipping[]" id="shipping_<?php echo $i; ?>">
                   <optgroup label="Service @ amount">
                       <option value="-1">---Select Shipping Service---</option>
                   <?php if(count($vwtaxamt->shippingdetails['fedex'])>0){ foreach($vwtaxamt->shippingdetails['fedex'] as $key=>$value){ ?>
                       <option value="<?php echo $value; ?>"><?php echo $key; ?> @ $<?php echo $value; ?>  </option>
                   <?php }} ?>
                   </optgroup>
               </select>
                <?php }else{?>
                    <input type="hidden" id="shipping_<?php echo $i; ?>" value="<?php echo $vwtaxamt->local_shipping; ?>">
                    <span id="localship_<?php echo $i; ?>"> <?php echo $vwtaxamt->local_shipping; ?></span>
                  <?php 
                    $ls_total=$vwtaxamt->local_shipping+$vwtaxamt->sub_total;
                    $f_total+=$ls_total;
                   }?>
                <?php if(count($vwtaxamt->shippingdetails['fedex'])>0){?>    
                <input type="hidden" name="currentselected[]" id="prevselected_<?php echo $i;?>" value="0">
               <input type="hidden" name="sellerid[]" id="sellerid_<?php echo $i;?>" value="<?php echo $vwtaxamt->user_id;?>">
               <input type="hidden" name="subtotal[]" id="subtotalfield_<?php echo $i;?>" value="<?php echo $vwtaxamt->sub_total; ?>"> 
               <?php } else{?>
               <input type="hidden" name="shipping[]" id="local_ship_<?php echo $i;?>" value="<?php echo $vwtaxamt->local_shipping; ?>">
               <input type="hidden" name="currentselected[]" id="prevselected_<?php echo $i;?>" value="<?php echo $vwtaxamt->local_shipping; ?>">
               <input type="hidden" name="sellerid[]" id="sellerid_<?php echo $i;?>" value="<?php echo $vwtaxamt->user_id;?>">
               <input type="hidden" name="subtotal[]" id="subtotalfield_<?php echo $i;?>" value="<?php echo $total_for_payment; ?>">
               <?php }?>
           </td>
          <?php if(count($vwtaxamt->shippingdetails['fedex'])>0) {?>
            <td class="cart_text" id="subtotal_<?php echo $i;?>">$<?php echo $vwtaxamt->sub_total; ?></td>
            <?php } else{?>
           <td class="cart_text" id="subtotal_<?php echo $i;?>">$<?php echo $ls_total; ?></td>
            <?php } ?>
         </tr>
       <?php $i++; }  ?>
          <?php if(count($vwtaxamt->shippingdetails['fedex'])>0) {?>
            <tr>
               <td colspan="5" align="right"><input type="hidden" id="no_of_sellers" value="<?php echo $i; ?>"><strong>Total For Payment</strong></td>
               <td><strong id="totalforpayment">$<?php echo $total_for_payment; ?></strong><input type="hidden" name="totalforpayment" id="totalforpaymentfield" value="<?php echo $total_for_payment; ?>"> <?php $this->session->set_userdata('total_product_price',$total_for_payment); ?></td>
            </tr>
            <?php } else{ ?>
            <tr>
            <td colspan="5" align="right"><input type="hidden" id="no_of_sellers" value="<?php echo $i; ?>"><strong>Total For Payment</strong></td>
            <td><strong id="totalforpayment">$<?php echo $f_total; ?></strong><input type="hidden" name="totalforpayment" id="totalforpaymentfield" value="<?php echo $f_total; ?>"><?php $this->session->set_userdata('total_product_price',$f_total); ?></td>
            </tr>
          <?php } }?>
       </tbody>
     </table>
</form>

    </div>
    
    
        <div class="col-md-12">
            <div class="pull-right">
            <a  id="submit_viewcart" href="javascript:void(0);" class="btn btn-warning btn-lg pull-right cus_checkout_btn1"> <!--cus_checkout_btn-->
             PAY NOW
        </a>
            </div>
        </div>

</div>

    </div>
</div>  
<!-- Modal -->
  <div class="modal fade" id="changeship" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change shipping</h4>
        </div>
        <form role="form" id="calculateship_form" name="calculateship_form" method="post" action="<?=BASE_URL?>bid/pricedetails/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(4); ?>">
        <div class="modal-body">
                <div class="form-group">
                    <label for="email" class="sr-only">Email address:</label>
                    <input type="text" class="form-control" name="new_zip" id="new_zip" placeholder="Zip Code">
                </div>
        </div>
        </form>      
        <div class="modal-footer">
            <button type="button" id="calculateship_btn" class="btn btn-success">Calculate</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>

$("#calculateship_btn").click(function(){ 
        var new_zip=$("#new_zip").val().trim();
        if(new_zip==''){ alert("if");
            $("#new_zip").parent().addClass("has-error");
            $("#new_zip").focus();
            return false;
        }else{ 
            $("#calculateship_form").submit();
        }   
    });


    $(document).on("change",".shippingclass",function(){
        $(this).parent().removeClass("has-error");
        var id=$(this).attr("id").split("_")[1]; 
        var currentselected=$(this).val();
        var prevselected=$("#prevselected_"+id).val();
        var subtotalfield=$("#subtotalfield_"+id).val();
        var totalforpaymentfield=$("#totalforpaymentfield").val();
        //alert(prevselected+'__'+subtotalfield+'__'+totalforpaymentfield);
        var new_subtotal=(parseFloat(subtotalfield)-parseFloat(prevselected)+parseFloat(currentselected)).toFixed(2);
        var new_totalforpayment=(parseFloat(totalforpaymentfield)-parseFloat(prevselected)+parseFloat(currentselected)).toFixed(2);
        $("#subtotalfield_"+id).val(new_subtotal);
        $("#totalforpaymentfield").val(new_totalforpayment);
        $("#prevselected_"+id).val(currentselected);
        $("#subtotal_"+id).html("$"+new_subtotal);
        $("#totalforpayment").html("$"+new_totalforpayment);
    });
    
    
    $(document).on("click","#submit_viewcart",function(){
        var flag1=0; 
        var no_of_sellers=$("#no_of_sellers").val();
        for(var i=1;i<no_of_sellers;i++){
            var shipping=$("#shipping_"+i).val();
            if(shipping>-1){flag1++;}else{
                alert("Please select shipping");
                $("#shipping_"+i).parent().addClass("has-error").focus();
                return false;
            }
        }
        if(flag1){$('#bidform').submit();}else{ return false; }
        //$('form').submit();
    });
</script>