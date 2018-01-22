<?php //echo "<pre>";print_r($order);print_r($transaction); ?>
<style>
    .frt_btn{margin-right: 10px;}
</style>
<div class="col-sm-9">
            <div class="row">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Order</h4>
                         <!--<span class="add-button"><a href="<?=BASE_URL?>product/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Product</a></span>-->
                    </div>
                </div>
            </div>
            
            <div class="contant-body">
                <div class="col-sm-12">
                    <div class="row">
                    <?php if($transaction['res']){ $transactiondata=$transaction['rows'][0]; ?>
                        <h3>Transaction Details</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <tbody>
                                <tr>
                                    <td class="profile_heading">Transaction Id</td>
                                    <td><?php echo $transactiondata->trans_id;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Price</td>
                                    <td id="transactionamt">$ <?php if($this->session->userdata('user_type')=="2"){ echo $transactiondata->price; } ?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Date</td>
                                    <td><?php echo $transactiondata->date;?></td>
                                </tr>
								
								
								<tr>
                                    <td class="profile_heading">Payment With</td>
                                    <td><?php echo $transactiondata->payment_with;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Status</td>
                                    <td><?php echo $transactiondata->status;?></td>
                                </tr>
                            <tbody>
							</table>
					</div>
					<div class="col-lg-12">
					<div class="col-lg-6">
						<h3>Shipping Details</h3>		
						<div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">		
                                <tr>
                                    <td class="profile_heading">Name</td>
                                    <td><?php echo $transactiondata->name;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Email</td>
                                    <td><?php echo $transactiondata->email;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Street</td>
                                    <td><?php echo $transactiondata->street;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">City</td>
                                    <td><?php echo $transactiondata->city;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">State</td>
                                    <td><?php echo $transactiondata->state;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Zip code</td>
                                    <td><?php echo $transactiondata->zipCode;?></td>
                                </tr>
                                
                                
                                
                            </tbody>
                        </table>
                    </div>
					</div>
					
					
					
                    <?php } ?> 

					<?php if($billinginfo['res']){ 
					
					$billinginformation=$billinginfo['rows'];?>
						<div class="col-lg-6">
						<h3>Billing Details</h3>		
						<div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">		
                                <tr>
                                    <td class="profile_heading">Name</td>
                                    <td><?php echo $billinginformation->bill_name;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Email</td>
                                    <td><?php echo $billinginformation->bill_email;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Street</td>
                                    <td><?php echo $billinginformation->bill_street;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">City</td>
                                    <td><?php echo $billinginformation->bill_city;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">State</td>
                                    <td><?php echo $billinginformation->bill_state;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Zip code</td>
                                    <td><?php echo $billinginformation->bill_zipCode;?></td>
                                </tr>
                                
                                
                                
                            </tbody>
                        </table>
                    </div>
					</div>	
					<?php }?>
                    
					</div>
					
                    <?php if($taxdetails['res']){ ?>   
                        <h3>Price Details</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered cus-table-bordered">
                                <thead class="cus-thead">
                                    <tr>
                                        <td>Seller</td>
                                        <td>Product price</td>
                                        <td>Tax</td>
                                        <td>Shipping</td>
										<td>Total Payment</td>
                                        <?php if($this->session->userdata('user_type')=="1"){ ?>
                                        <td>Admin commission</td>
                                        <td>Seller's Payment</td>
                                        <?php } ?>
                                        
                                        
                                        
                                    </tr>
                                    </thead>
                                <tbody>
                                    <?php $totalforseller=0; foreach($taxdetails['rows'] as $taxdetail){ ?>
                                    <tr>
                                        <td><?php echo $taxdetail->f_name.' '.$taxdetail->l_name;?></td>
                                        <td>$<?php echo $taxdetail->total;?></td>
                                        <td>$<?php echo (($taxdetail->total*$taxdetail->tax)/100);?> &nbsp;&nbsp; (<?php echo $taxdetail->tax;?>) %</td>
                                        <td>$<?php echo $taxdetail->shippingcharge; ?></td>
										<td>$<?php echo (($taxdetail->total*$taxdetail->tax)/100)+$taxdetail->total+$taxdetail->shippingcharge;?></td>
                                        <?php if($this->session->userdata('user_type')=="1"){ ?>
                                        <td>$<?php echo $taxdetail->commission;?></td>
                                        <td>$<?php echo ($taxdetail->total-$taxdetail->commission)+(($taxdetail->total*$taxdetail->tax)/100)+$taxdetail->shippingcharge;?></td>
                                        <?php } ?>
                                        
                                    </tr>
                                    <?php $totalforseller+=(($taxdetail->total*$taxdetail->tax)/100)+$taxdetail->total+$taxdetail->shippingcharge; } ?>
                                <input type="hidden" id="totalforseller" value="<?php echo $totalforseller; ?>">
                                </tbody>
                            </table>
                        </div>    
                     <?php } ?>   
                        
                    <h3>Product List</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Date</td>
                                    <td>Product</td>
                                    <td>Seller</td>
                                    <td>Business Name</td>
                                    <td>Price</td>
                                    <td>Quantity</td>
                                    <td>Status</td>
                                    <td>Status Change</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($order['res']){ 
                                    //echo "<pre>";
                                    //print_r($order); exit;
                                foreach($order['rows'] as $orderlist){
                                    
                                    if($orderlist->status==1){
                                        $status='Order Received';
                                    }else if($orderlist->status==2){
                                        $status='Order Processed';
                                    }else if($orderlist->status==3){
                                        $status='Order Shipped';
                                    }else if($orderlist->status==4){
                                        $status='Order Delivered';
                                    }else if($orderlist->status==5){
                                        $status='Order Canceled';
                                    }else{
					$status='';	
					}
                            ?>    
                                <tr>
                                    <td><?=$orderlist->date?></td>
                                    <td><a target="_blank" href="<?=BASE_URL?>order/porductdetails/<?=$orderlist->prodId?>"><?=$orderlist->prod_name?></a></td>
                                    <td>
                                        <?php if($orderlist->sellerId!=$this->session->userdata('user_id')){?>
                                         <a href="javascript:void(0)" class="buyer" id="<?=$orderlist->sellerId?>" data-target="#buyerdetails" data-toggle="modal"> <?=$orderlist->f_name?>&nbsp;&nbsp;&nbsp;<?=$orderlist->l_name?></a>   
                                       <?php } else{?>
                                         <?=$orderlist->f_name?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$orderlist->l_name?>
                                       <?php } ?>     
                                    </td>
                                    <td>
                                        <?php if($orderlist->sellerId!=$this->session->userdata('user_id')){?>
                                        <a href="javascript:void(0)" class="buyer" id="<?=$orderlist->sellerId?>" data-target="#buyerdetails" data-toggle="modal"> <?=$orderlist->business_name;?></a>
                                        <?php } else{?>
                                        <?=$orderlist->business_name;?>
                                        <?php } ?>    
                                    </td>
                                    <td>$ <?=$orderlist->price?></td>
                                    <td><?=$orderlist->quantity?></td>
                                    <td><?=$status?></td>
                                    <td><a href="javascript:void(0)" onClick="statuschange(<?=$orderlist->id?>,<?=$orderlist->status?>)" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                                </tr>
                                <?php }}else{ ?>
                                <tr>
                                    <td colspan="7"> <p class="text-danger">No Record Found</p></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
               
        </div>
        
        
    </div>
</div>  

<!-- Modal -->
<div id="buyerdetails" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Seller Details</h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered" id="userdata">
              
          </table>
          <div class="" id="chat_link">
              
          </div>
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php if($this->session->userdata('user_type')=="1"){ ?>
<!-- Modal -->
<div id="changestatus" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Status Change</h4>
      </div>
      <div class="modal-body" id="change-form">
          <div id="e-result-change"></div>
          <input type="hidden" id="orderId" >
           <div class="form-group">
            <label for="sel1">Select Status:</label>
            <select class="form-control" id="statusoption">
                <option value="1">Received</option>
                <option value="2">Processed</option>
                <option value="3">Shipped</option>
                <option value="4">Delivered</option>
                <option value="5">Cancel Order</option>
            </select>
          </div>
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="changest">Change</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php }else{ ?>

<div id="changestatus" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Status Change</h4>
      </div>
        <div class="modal-body" id="change-form">
          <div id="e-result-change"></div>
          <input type="hidden" id="orderId" >
           <div class="form-group">
            <label for="sel1">Select Status:</label>
            <select class="form-control" id="statusoption">
                <!--<option value="1">Pending</option>
                <option value="2">Delivered</option>-->
                <option value="5">Cancel Order</option>
            </select>
          </div>
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="changest">Change</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php } ?>


<!-- Modal -->
<div id="changestatusmsg" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Status Change</h4>
      </div>
      <div class="modal-body" id="change-formmsg">
          
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<script>
    $(document).ready(function(){
        //alert("hi");
        $(".buyer").click(function(){
            //alert("<?php echo $this->session->userdata('user_id')?>");
            var id=$(this).prop('id');
            var tabledata="";
            var chat_div="";
            $.post("<?=BASE_URL?>order/getuser",{id:id},function(data,status){        
                var obj = jQuery.parseJSON(data);
                if(obj.res){
                    var user=obj.userdata;
                    tabledata+="<tr>";
                    tabledata+="<td> Username </td>";
                    tabledata+="<td>"+user.username+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Business Name </td>";
                    tabledata+="<td>"+user.business_name+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Mobile </td>";
                    tabledata+="<td>"+user.mobile_no+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Name </td>";
                    tabledata+="<td>"+user.f_name+" "+user.l_name+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Email </td>";
                    tabledata+="<td>"+user.email_id+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Address </td>";
                    tabledata+="<td>"+user.address1+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> State </td>";
                    tabledata+="<td>"+user.state+"</td>";
                    tabledata+="<tr>";
                    var uu=user.is_login;
                    //alert(uu);
                      if(uu=='1'){
                      var new_text="Chat with Seller Now";
                  }
                  else{
                     var new_text="Send Message to Seller"; 
                  }
                  chat_div+='<a href="<?=BASE_URL?>sellerprofile/'+user.username+'" class="btn btn-primary frt_btn"> View Seller Profile </a>';
                  chat_div+='<a href="<?=BASE_URL?>message/'+id+'" class="btn btn-success chatwithonlineuser" id="chatwith_'+id+'">'+new_text+'</a>';
                }else{
                    tabledata+="<tr>";
                    tabledata+="<td> Data Not Found!! </td>";
                    tabledata+="<tr>";
                }
                $("#userdata").html(tabledata);
                $("#chat_link").html(chat_div);
                //console.log(obj.userdata);
            });
        });
        
        $("#changest").click(function(){
            var orderid=$("#orderId").val();
            var status=$("#statusoption").val();
            //alert(orderid);alert(status);
            $.post("<?=BASE_URL?>order/changestatus",{orderid:orderid,status:status},function(data,status){
                var obj = jQuery.parseJSON(data);
                if(obj.status){
                   $("#e-result-change").empty().append(obj.message).addClass("alert alert-success fade in");
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000); 
                }else{
                    $("#e-result-change").empty().append(obj.message).addClass("alert alert-error fade in");
                    }
            });
        });
        
    });
    
    function statuschange(orderid,currentstatus){
       var orderid =  parseInt(orderid);
       var currentstatus =  parseInt(currentstatus);
        if(currentstatus==4){  
            $("#change-formmsg").empty().append("This order delivered so you cann't change status");
	    $('#changestatusmsg').modal('show');
        }else if(currentstatus==5){  
            $("#change-formmsg").empty().append("This order rejected so you cann't change status");
	    $('#changestatusmsg').modal('show');
        }else{   
        $("#orderId").val(orderid);
        $('#statusoption option[value="'+currentstatus+'"]').prop("selected", true);
        $('#changestatus').modal('show');
        }
    }
    
    <?php if($this->session->userdata('user_type')=="1"){ ?>
        $("#transactionamt").empty().html("$"+$("#totalforseller").val());
    <?php } ?>
</script>