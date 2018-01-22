<?php //print_r($order); ?>
<style>
    .frt_btn{margin-right: 10px;}
    .search_form_display{ display: none !important; }
    .search_button{
      margin-left: -5px;
    }
    .custom_lft_margin{margin-left: 20px;}
    .width_250{
      width: 250px !important;
    }
</style>
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Order</h4>
                         <!--<span class="add-button"><a href="<?=BASE_URL?>product/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Product</a></span>-->
                    </div>
                </div>
            </div>
            <div class="rows box-header margin-top_20 ">
              <!--<h3 class="box-title"></h3>-->   
              <span class="text-danger" id="error_search"></span>
              <form class="form-inline" role="form" action="<?=BASE_URL?>order/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="transid" <?php if($this->input->get('searchby')=='transid'){echo "selected";} ?> >Transaction Id</option>
                          <option value="adddate" <?php if($this->input->get('searchby')=='adddate'){echo "selected";} ?> >By Date</option>
                          <option value="buyer_name" <?php if($this->input->get('searchby')=='buyer_name'){echo "selected";} ?> >By Buyer's Name</option>
			  <option value="buyer_username" <?php if($this->input->get('searchby')=='buyer_username'){echo "selected";} ?> >By Buyer's Username</option>
		      </select>
                    </div> &nbsp;
                    <input type="hidden" name="product" value="product">
                    <div class="form-group" id="transaction_div">
                        <label for="pwd" class="sr-only">Transaction Id</label>
                        <div class="col-lg-12">
                        <input  type="text" class="form-control search_form_display width_250" id="product" name="val" placeholder="Transaction Id" disabled="" autocomplete="off" required="">
                        </div>
                    </div>
		
					
                    
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">From date</label>
                        <input type="text" class="form-control search_form_display" id="from" name="from" placeholder="From" disabled="" autocomplete="off" required="">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">To date</label>
                        <input type="text" class="form-control search_form_display" id="to" name="to" placeholder="To" disabled="" autocomplete="off" required="">
                    </div>
					
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Buyer Name</label>
                        <input type="text" class="form-control search_form_display" id="buyer_name" name="val" placeholder="Buyer's Name" disabled="" autocomplete="off" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Buyer UserName</label>
                        <input type="text" class="form-control search_form_display" id="buyer_username" name="val" placeholder="Buyer's Username" disabled="" autocomplete="off" required="">
                    </div>
                    <button type="submit" class="btn btn-default" id="search">Search</button>

                </form>
                
            </div>
            <!-- <div>
              <a class="btn btn-default active href="<?=BASE_URL?>order/" class="">Products</a>
              <a class="btn btn-default active href="<?=BASE_URL?>order/sellerbid" class="">Bid</a>

            </div> -->
            
             <div class="">
                    <div class="product-type pull-right">    
                        
                        <ul><li> <a class="btn btn-default active <?php if(!$bid){ ?> active <?php } ?>" href="<?=BASE_URL?>order/">Buy Directly</a></li>
                        <li> <a class="btn btn-default active <?php if($bid){ ?> active <?php } ?>" href="<?=BASE_URL?>order/sellerbid" >Bid</a></li></ul>
                    </div>
             </div>
            
            <div class="contant-body1">
                <div class="col-sm-12">
                    <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Date</td>
                                    <td>Transaction Id</td>
                                    <td>Buyer</td>
                                    <td>Price</td>
<!--                                    <td>Quantity</td>-->
<!--                                    <td>Status</td>-->
                                    <td>View</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($order['res']){ 
                                foreach($order['rows'] as $orderlist){
                                    
//                                    if($orderlist->status==1){
//                                        $status='Order Received';
//                                    }else if($orderlist->status==2){
//                                        $status='Order Processed';
//                                    }else if($orderlist->status==3){
//                                        $status='Order Shipped';
//                                    }else if($orderlist->status==4){
//                                        $status='Order Delivered';
//                                    }else if($orderlist->status==5){
//                                        $status='Order Rejected';
//                                    }else{
//					$status='';	
//					}
                            ?>    
                                <tr>
                                    <td><?=$orderlist->date?></td>
                                    <td><?=$orderlist->trans_id?></td>
<!--                                    <td><a href="<?=BASE_URL?>order/porductdetails/<?=$orderlist->prodId?>"><?=$orderlist->prod_name?></a></td>-->
                                    <td><a href="javascript:void(0)" class="buyer" id="<?=$orderlist->buyerId?>" data-target="#buyerdetails" data-toggle="modal"> <?=$orderlist->f_name?>&nbsp;<?=$orderlist->l_name?></a></td>
                                    <td>$ <?php if($orderlist->price==NULL){echo $orderlist->trans_price;}else{ echo round($orderlist->price,2); } ?>  </td>
<!--                                    <td><?=$orderlist->quantity?></td>-->
<!--                                    <td><?=$status?></td>-->
                                    <td><a href="<?=BASE_URL?>order/details/<?=$orderlist->trans_id?>" ><span class="glyphicon glyphicon-eye-open"></span></a></td>
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
        <h4 class="modal-title">Buyer Details</h4>
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
                <option value="5">Rejected</option>
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
        var selectedval=$("#searchby").val();
        search(selectedval);
        if(selectedval=='transid'){
            $("#product").val("<?=$this->input->get('val')?>");
        }

		else if(selectedval=='buyer_name'){
            $("#buyer_name").val("<?=$this->input->get('val')?>");
        } 
        	else if(selectedval=='buyer_username'){
            $("#buyer_username").val("<?=$this->input->get('val')?>");
        } 
	
		
		else if(selectedval=='adddate'){
            $("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
        }        
        $(document).on("change","#searchby",function(){
            selectedval=$(this).val();
            search(selectedval); 
        }); 
        
        $(document).on("click","#search",function(){
            var selectedval=$("#searchby").val();
            if(selectedval==''){
                $("#error_search").html("Please select any one");
                return false;
            }
            return true;
        });
    });
    
    
    function search(selectedval){
        $("#product").addClass("search_form_display");
		//$("#amount").addClass("search_form_display");
		$("#buyer_name").addClass("search_form_display");
		$("#buyer_username").addClass("search_form_display");
		//$("#product_name").addClass("search_form_display");
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
       // $("#bidstatus").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='transid'){
            $("#product").removeClass("search_form_display");
            $("#search").removeClass("search_button");
            $("#product").prop("disabled",false);
            $("#product").focus();
            }
			
	
			
		else if(selectedval=='buyer_name'){
            $("#buyer_name").removeClass("search_form_display");
            $("#search").removeClass("search_button");
            $("#buyer_name").prop("disabled",false);
            $("#buyer_name").focus();
            }
            	else if(selectedval=='buyer_username'){
            $("#buyer_username").removeClass("search_form_display");
            $("#buyer_username").prop("disabled",false);
            $("#buyer_username").focus();
            }
		
		
			else if(selectedval=='adddate'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                $("#transaction_div").addClass("search_form_display");
                $("#search").addClass("search_button");
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);

            }else{
                $("#product").addClass("search_form_display");
                $("#search").removeClass("search_button");
				//$("#amount").addClass("search_form_display");
				$("#buyer_name").addClass("search_form_display");
				$("#buyer_username").addClass("search_form_display");
				//$("#product_name").addClass("search_form_display");
                $("#from").addClass("search_form_display");
                $("#to").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }


</script>



<script>
    $(document).ready(function(){
        $(".buyer").click(function(){
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
                      var new_text="Chat with Buyer Now";
                  }
                  else{
                     var new_text="Send Message to Buyer"; 
                  }
                    chat_div+='<a href="<?=BASE_URL?>sellerprofile/'+user.username+'" class="btn btn-primary frt_btn"> View Buyer Profile </a>';
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
</script>    
<script>
    //var $j = jQuery.noConflict();
    $(function(){
        $( "#from" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#to").datepicker("option", "minDate", dt);
            }
        });
        $( "#to" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#from").datepicker("option", "maxDate", dt);
            }
        });
    });
</script>