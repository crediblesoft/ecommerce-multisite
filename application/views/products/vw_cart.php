<?php //print_r($tax); ?>
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
<!--        <h2 class="text-center"><b>View Cart</b></h2>-->
        <div class="row product_vw_head text-center margin-bottom_25 clearfix">
            <div class="col-sm-5 col-md-5 lineimg"><img src="<?php echo BASE_URL; ?>assets/image/line.png" class="img img-responsive"></div>
            <div class="col-sm-2 col-md-2 text-center product_vw_head">View Cart</div>
            <div class="col-sm-5 col-md-5 lineimg"><img src="<?php echo BASE_URL; ?>assets/image/line.png" class="img img-responsive"></div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading cus_panel_head_vwcart"><strong>MY CART LIST</strong></div>
            <div class="panel-body table-responsive cus_panel_body_vwcart">
                
                <?php //echo form_open(BASE_URL."products/updatecart"); ?>
                <form id="updateform" action="<?=BASE_URL?>products/updatecart" method="post" accept-charset="utf-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="40%">Item Description</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total<br>(<small>Product Price</small>)</th>
                            <th class="text-center">Tax(<small>x %</small>)</th>
                            <th class="text-center" width="20%">Total<br>(<small> With Tax</small>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php if(count($this->cart->contents())){foreach ($this->cart->contents() as $items): 
                            
                        ?>
                            
                                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                                <tr>
                                    <td>
                                        <?php  $productoption=$this->cart->product_options($items['rowid']); 
                                        //print_r($productoption);
										?>
                                        <div class="col-sm-4 img-responsive" style="min-height:100px;">
                                            <img src="<?=BASE_URL?>assets/image/product/<?=$productoption['image']?>" class="img" width="100">
                                        </div>  
                                        <p class="cart_text"><?php echo $items['name']; ?> , <?php echo $productoption['Category']; ?></p>
                                        <p class="cart_text">Seller : <strong><?php echo ucfirst($productoption['sellername']); ?></strong></p>
                                        <p class="pull-left"> <a href="#removecart" id="<?=$items['rowid']?>" class="remove remove_view_cart" data-traget="#removecart" data-toggle="modal">Remove</a></p>
                                    </td>
                                    <td align="center" class="view_cart_middle1"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5' ,'autocomplete'=>'off','class'=>'form-control view-cart-qty' ,'onkeyup'=>'checkcart(this.value)','id'=>'quantity')); ?></td>
                                    <td class="text-center view_cart_middle"><strong>$<?php echo $this->cart->format_number($items['price']); ?></strong></td>
                                    <td class="text-center view_cart_middle"><strong>$<?php echo $items['subtotal']?></strong></td>
                                  <!--   <td class="text-center view_cart_middle"><strong>$
                                            <?php echo $tax_cal=($items['subtotal']*$productoption['sellertax'])/100?>
                                            <span>(<?php echo round($productoption['sellertax']); ?>%)</span>
                                        </strong></td> -->
                                    <td class="text-center view_cart_middle"><strong>$<?php 
                                    $ftotal=$this->cart->format_number($items['subtotal'])+$tax_cal;
                                    //echo $this->cart->format_number($items['subtotal']); 
                                    echo $ftotal;
                                    ?></strong></td>
                                </tr>

                        <?php $i++; ?>

                        <?php endforeach; }else{ ?>
                                <tr>
                                    <td colspan="6"> <p class="text-danger">There are no items in the cart.</p></td>
                                </tr>    
                                <?php } ?>
                                
                                <tr>
                                    <td colspan="5">
                                        <?php 
                                        if($this->session->has_userdata("shipto")){ echo "<span class='shipping_to'>Shipping to : </span>".$this->session->userdata("shipto"); echo "<a href='javascript:void(0);' class='margin_left_5'  data-toggle='modal' data-target='#changeship'>change</a>"; }
                                        
										?>
                                    </td>
                                    <td align="center"> <button type="submit" class="btn btn-warning cus_checkout_btn1"> UPDATE ORDER </button>  </td>
                                </tr>
                                
                                
                                <tr>
                                    <td colspan="6"> 
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 cart-total-main">  <!-- cart-total-main -->
<!--                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">OFFERS APPLICABLE ( IF ANY )</div>-->
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 margin-bottom_20 orderamttext">ORDER AMOUNT</div>
                                            
                                             <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                 
                                            <table class="table table-bordered text-center">
                                                <thead >
                                                  <tr>
                                                    <th class="text-center">Seller</th>
                                                    <th class="text-center">Product price</th>
<!--                                                    <th class="text-center">Tax charged (%)</th>-->
                                                    <th class="text-center">Total tax</th>
                                                    <th class="text-center">Select shipping</th>
													<th class="text-center">Direct Pick-up</th>
                                                    <th class="text-center">Subtotal</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                  $f_total=0;
                                                  $total_for_payment=0;
                                                  $i=1;
                                                  //print_r($tax); exit;
                                                  if($tax){
                                                  foreach($tax as $vwtaxamt){
                                                      
                                                      //echo "<pre>";
                                                      //print_r($vwtaxamt);
                                                  $total_for_payment+=$vwtaxamt->sub_total;?>
                                                  <tr>
                                                    <td class="cart_text"><?php echo $vwtaxamt->f_name.' '.$vwtaxamt->l_name; ?></td>
                                                    <td class="cart_text">$<?php echo $vwtaxamt->prod_total;?></td>
<!--                                                    <td class="cart_text"><?php echo $vwtaxamt->desc;?> (<?php echo $vwtaxamt->tax;?> %)</td>-->
                                                    <td class="cart_text">$<?php echo $vwtaxamt->sub_total_tax; ?></td>
                                                    <td>
                                                        <?php 
                                                        if(count($vwtaxamt->shippingdetails['fedex'])>0){?>
                                                        <select class="form-control shippingclass shipping_type" name="shipping[]" id="shipping_<?php echo $i; ?>">
                                                            <optgroup label="Service @ amount">
                                                                <option value="-1">---Select Shipping Service---</option>
                                                            <?php if(count($vwtaxamt->shippingdetails['fedex'])>0){ 
                                                              foreach($vwtaxamt->shippingdetails['fedex'] as $key=>$value){ ?>
                                                                <option class="hide_data" value="<?php echo $value; ?>" id="<?php echo $key; ?>"><?php echo $key; ?> @ $<?php echo $value; ?>  </option>

                                                            <?php }}?>
                                                            </optgroup>
                                                        </select>
<input type="hidden" name="type1[]" id="type1" value="">
                                                       <span id="fed_directship_<?php echo $i; ?>" style="display:none;">0</span>
														<?php }else{?>
                                                        <input type="hidden" id="shipping_<?php echo $i; ?>" value="<?php echo $vwtaxamt->local_shipping; ?>">
                                                        <span id="localship_<?php echo $i; ?>"> <?php echo $vwtaxamt->local_shipping; ?></span>
														<span id="directship_<?php echo $i; ?>" style="display:none;">0</span>
                                                          <?php 
                                                          
                                                          $ls_total=$vwtaxamt->local_shipping+$vwtaxamt->sub_total;
                                                           $f_total+=$ls_total;
                                                         }?>
                                                         
                                                        <?php if(count($vwtaxamt->shippingdetails['fedex'])>0){?>
														
                                                        <input type="hidden" `name="currentselected[]" id="prevselected_<?php echo $i;?>" value="0">
                                                        <input type="hidden" name="sellerid[]" id="sellerid_<?php echo $i;?>" value="<?php echo $vwtaxamt->user_id;?>">
                                                        <input type="hidden" name="subtotal[]" id="subtotalfield_<?php echo $i;?>" value="<?php echo $vwtaxamt->sub_total; ?>"> 
                                                        <?php } else{?>
                                                        <input type="hidden" name="sellerid[]" id="sellerid_<?php echo $i;?>" value="<?php echo $vwtaxamt->user_id;?>">
                                                        <input type="hidden" name="subtotal[]" id="subtotalfield_<?php echo $i;?>" value="<?php echo $ls_total; ?>">
                                                        <?php }?>
														
<input type="hidden" name="shipping[]" id="local_ship_<?php echo $i;?>" value="<?php echo $vwtaxamt->local_shipping; ?>">
                                                    </td>
													<?php if(count($vwtaxamt->shippingdetails['fedex'])>0){?>
													<td><input type="checkbox" id="fed_directpick_<?php echo $i;?>" onclick="fedchangeshipping(<?php echo $i;?>)"></td>
													<?php }else{?>
													<td><input type="checkbox" id="directpick_<?php echo $i;?>" onclick="changeshipping(<?php echo $i;?>)"></td>
													<?php }?>
                                                   <?php if(count($vwtaxamt->shippingdetails['fedex'])>0) {?>
                                                    <td class="cart_text" id="subtotal_<?php echo $i;?>">$<?php echo $vwtaxamt->sub_total; ?></td>
                                                    <?php } else{?>
                                                    <td class="cart_text" id="subtotal_<?php echo $i;?>">$<?php echo $ls_total; ?></td>
                                                    <?php } ?>
                                                  </tr>
                                                  <?php $i++; }?>
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
                                              
                                             </div>
                                            
                                        </div> 
                                        
                                        <!--<div class="row col-sm-12 col-md-12 col-lg-12 col-xs-12 margin-bottom_30">
                                            <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
                                                <strong>COUPON CODE : </strong>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4 col-xs-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Coupon Code">
                                                    <span class="input-group-btn">
                                                      <button class="btn btn-default cus_apply_btn" type="button">APPLY</button>
                                                    </span>
                                                  </div>
                                            </div>
                                             
                                        </div>-->
                                    </td>
                                    
                            </tr>
                    </tbody>
                </table>
                </form>    
                <?php //echo form_close(); ?>
            </div>
            <div class="panel-footer cus_panel_footer_vwcart">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right margin_right_23">
                        <a href="<?php echo BASE_URL?>products/1" class="btn btn-success btn-lg cus_conti_sho1">CONTINUE SHOPPING</a> <!--cus_conti_sho-->
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a <?php if($this->cart->format_number($this->cart->total())==0){?>onclick="alert('Your cart is empty. Please add some item.')"<?php }else{?> id="submit_viewcart" <?php } ?> href="javascript:void(0);" class="btn btn-warning btn-lg pull-right cus_checkout_btn1"> <!--cus_checkout_btn-->
                        <span class="glyphicon glyphicon-shopping-cart cus_shopping_cart"></span> &nbsp;&nbsp; CHECK OUT
                    </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>  


<!-- Modal -->
<div id="removecart" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove Cart</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to remove this product from cart</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Remove</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="status" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Warning</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <h4 id="qty_error_msg">Required minimum 1 quantity otherwise this product remove from cart</h4>
         
      </div>
      <div class="modal-footer"> 
          <!--<button type="button" class="btn btn-success" id="yes" >Delete</button>-->
          <button type="button" class="btn btn-default" id="no" data-dismiss="modal">Close</button>
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
        <form role="form" id="calculateship_form" name="calculateship_form" method="post" action="<?=BASE_URL?>products/viewcart">
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

<?php 
//echo "<pre>";
//print_r($this->session->userdata('productpricedetails'));exit;
?>


<script>  

/*$(document).on('change', '.shipping_type', function(e) {
    console.log(this.options[e.target.selectedIndex].text);
	 var id = $this.options[e.target.selectedIndex].text;
	//alert(id);	
	
})

$(".shipping_type").change(function() {
 //var id[] = $(this).find('option:selected').attr('id');
//	console.log(id[]);
// $("#type").val(id);
});

$("select[class=shippingclass]").change(function(){
 $("input[name=hiddenfield]").val($(this).val());
});

var hexvalues = [];
var labelvalues = [];
$('#shipping_1 :selected').each(function(i, selectedElement) {

 hexvalues[i] = $(selectedElement).val();
 labelvalues[i] = $(selectedElement).text();
console.log(label[i]);
});*/

$(document).on('change', '.shipping_type', function(e) {
	
	 var id = $(this).find('option:selected').text();
	//console.log(id);
	//alert(id);
	$(this).next('#type1').val(id);
	
});



function changeshipping(id)
{

	
	if($('#directpick_'+id).is(':checked'))
	{
		var localshipchrg=$("#shipping_"+id).val();
		$("#localship_"+id).css('display','none');
		$("#directship_"+id).css('display','block');
		$("#shipping_"+id).val('0');$("#local_ship_"+id).val('0');
		
		var subtotalfield=$("#subtotalfield_"+id).val();
        var totalforpaymentfield=$("#totalforpaymentfield").val();
        var new_subtotal=(parseFloat(subtotalfield)-parseFloat(localshipchrg)).toFixed(2);
        var new_totalforpayment=(parseFloat(totalforpaymentfield)-parseFloat(localshipchrg)).toFixed(2);
        $("#subtotalfield_"+id).val(new_subtotal);
        $("#totalforpaymentfield").val(new_totalforpayment);
        
        $("#subtotal_"+id).html("$"+new_subtotal);
        $("#totalforpayment").html("$"+new_totalforpayment);
		
		
		
	}
	else
	{
		var localshipchrg=$("#localship_"+id).html();
		$("#directship_"+id).css('display','none');
		$("#localship_"+id).css('display','block');
		$("#shipping_"+id).val(localshipchrg);$("#local_ship_"+id).val(localshipchrg);
		
		var subtotalfield=$("#subtotalfield_"+id).val();
        var totalforpaymentfield=$("#totalforpaymentfield").val();
        var new_subtotal=(parseFloat(subtotalfield)+parseFloat(localshipchrg)).toFixed(2);
        var new_totalforpayment=(parseFloat(totalforpaymentfield)+parseFloat(localshipchrg)).toFixed(2);
        $("#subtotalfield_"+id).val(new_subtotal);
        $("#totalforpaymentfield").val(new_totalforpayment);
        
        $("#subtotal_"+id).html("$"+new_subtotal);
        $("#totalforpayment").html("$"+new_totalforpayment);
		
	}
}

function fedchangeshipping(id)
{
	if($('#fed_directpick_'+id).is(':checked'))
	{
		
		var fed_shipchrg=$("#shipping_"+id).val();
		if(fed_shipchrg=='-1'){fed_shipchrg='0';}
		$("#shipping_"+id).css('display','none');
		$("#fed_directship_"+id).css('display','block');
		
		
		var subtotalfield=$("#subtotalfield_"+id).val();
        var totalforpaymentfield=$("#totalforpaymentfield").val();
        var new_subtotal=(parseFloat(subtotalfield)-parseFloat(fed_shipchrg)).toFixed(2);
        var new_totalforpayment=(parseFloat(totalforpaymentfield)-parseFloat(fed_shipchrg)).toFixed(2);
        $("#subtotalfield_"+id).val(new_subtotal);
        $("#totalforpaymentfield").val(new_totalforpayment);
        
        $("#subtotal_"+id).html("$"+new_subtotal);
        $("#totalforpayment").html("$"+new_totalforpayment);
		$("#shipping_"+id).val('0');$("#prevselected_"+id).val('0');$("#local_ship_"+id).val('0');
		
		
	}
	else
	{
		var fed_shipchrg=$("#shipping_"+id).val();
		//alert('first'+fed_shipchrg);
		if(fed_shipchrg==null){fed_shipchrg='0';}
		$("#fed_directship_"+id).css('display','none');
		$("#shipping_"+id).css('display','block');
		
		
		var subtotalfield=$("#subtotalfield_"+id).val();
        var totalforpaymentfield=$("#totalforpaymentfield").val();
        var new_subtotal=(parseFloat(subtotalfield)+parseFloat(fed_shipchrg)).toFixed(2);
        var new_totalforpayment=(parseFloat(totalforpaymentfield)+parseFloat(fed_shipchrg)).toFixed(2);
        $("#subtotalfield_"+id).val(new_subtotal);
        $("#totalforpaymentfield").val(new_totalforpayment);
        
        $("#subtotal_"+id).html("$"+new_subtotal);
        $("#totalforpayment").html("$"+new_totalforpayment);
		$("#shipping_"+id).val('-1');
		$("#prevselected_"+id).val(fed_shipchrg);
		$("#local_ship_"+id).val(fed_shipchrg);
	}
}



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

    
    $(".remove").click(function(){
        var id=$(this).prop('id');
        $("#deleteId").val(id);
    });
    
    $("#delete").click(function(){
        var deleteId=$("#deleteId").val();
        $.post("<?=BASE_URL?>products/deletecart",{id:deleteId},function(data,status){
            obj=$.parseJSON(data);
            if(obj.status){
               $("#e-result-delete").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
            }else
                {
                    $("#e-result-delete").empty().append(obj.message).addClass("alert alert-error fade in");
                }
        });
    });
    
    
    $(document).on("change",".shippingclass",function(){
        $(this).parent().removeClass("has-error");
        var id=$(this).attr("id").split("_")[1]; 
        var currentselected=$(this).val();
        //alert(currentselected);
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
       // alert("hi");
        var flag1=0; 
        var no_of_sellers=$("#no_of_sellers").val();
        for(var i=1;i<no_of_sellers;i++){
            var shipping=$("#shipping_"+i).val();
           // alert(shipping);
            if(shipping>-1){flag1++;}else{
                alert("Please select shipping");
                $("#shipping_"+i).parent().addClass("has-error").focus();
                return false;
            }
        }
        //alert(flag1);
//           $(document).on("click","#submit_viewcart",function(){
//               //var flag1=0;
//         //var id=$(this).attr("id").split("_")[1];
//         
//          var flag1=1;   
       
        
        //var flag1=1; 
     
       // return false;
        
        if(flag1){
            $("#updateform").attr("action","<?php echo BASE_URL;?>payment/index?paymenttype=product");
            //return false;
            $('#updateform').submit();
            }else{
            $("#updateform").attr("action","<?php echo BASE_URL;?>products/updatecart");
            return false;
            }
        //$('form').submit();
    });
    
    function checkcart(val){
        var intRegex = /[0-9 -()+]+$/;
        
        if(!$.isNumeric( val )){
            //$('#status').modal('show');
            //$("#qty_error_msg").html("Only numeric value allowed");
            //$("#quantity").val("1");
        }else if(!val.match(intRegex) && val!=''){
            $('#status').modal('show');
            $("#qty_error_msg").html("You can not add decimal value");
            var num = parseInt(Math.ceil(val));
            if(num==0){
                num++;
            }
            if(val == '.'){
                num=1;
            }
            
            $("#quantity").val(num);
        }else if(parseInt(val)<= 0){
            $('#status').modal('show');
            $("#qty_error_msg").html("Required minimum 1 quantity otherwise this product remove from cart");
        }
    }
</script>

