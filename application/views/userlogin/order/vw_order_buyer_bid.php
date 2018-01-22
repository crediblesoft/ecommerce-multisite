<?php //print_r($order); ?>
<style>
    .frt_btn{margin-right: 10px;}
    .search_form_display{ display: none !important; }
    .custom_lft_margin{margin-left: 20px;}
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
            <div class=" box-header margin-top_20 custom_lft_margin">
              <!--<h3 class="box-title"></h3>-->   
              <span class="text-danger" id="error_search"></span>
              <form class="form-inline" role="form" action="<?=BASE_URL?>order/search_buyer_main" method="get">
                <input type="hidden" name="product" value="bidproduct">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="transid" <?php if($this->input->get('searchby')=='transid'){echo "selected";} ?> >Transaction Id</option>
                          <option value="adddate" <?php if($this->input->get('searchby')=='adddate'){echo "selected";} ?> >By Date</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Transaction Id</label>
                        <input type="text" class="form-control search_form_display" id="transaction" name="val" placeholder="Transaction Id" disabled="" autocomplete="off" required="">
                    </div>
		    <div class="form-group">
                        <label for="pwd" class="sr-only">From date</label>
                        <input type="text" class="form-control search_form_display" id="from" name="from" placeholder="From" disabled="" autocomplete="off" required="">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">To date</label>
                        <input type="text" class="form-control search_form_display" id="to" name="to" placeholder="To" disabled="" autocomplete="off" required="">
                    </div>
		    <button type="submit" class="btn btn-default" id="search">Search</button>

                </form>
                
            </div>
             <div class="">
                    <div class="product-type pull-right">    
                        
                        <ul><li> <a class="btn btn-default active <?php if(!$bid){ ?> active <?php } ?>" href="<?=BASE_URL?>order/">Buy Directly</a></li>
                        <li> <a class="btn btn-default active <?php if($bid){ ?> active <?php } ?>" href="<?=BASE_URL?>order/buyerorderviewbid" >Bid</a></li></ul>
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
                                    <!--<td>Product</td>-->
                                    <td>Transaction Id</td>
<!--                                    <td>Seller</td>-->
                                    <td>Price</td>
                                    <!--<td>Quantity</td>-->
<!--                                    <td>Status</td>
                                    <td>Status Change</td>-->
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
                                    <!--<td><a href="<?=BASE_URL?>order/porductdetails/<?=$orderlist->prodId?>"><?=$orderlist->prod_name?></a></td>-->
                                    <!--<td><a href="javascript:void(0)" class="buyer" id="<?=$orderlist->buyerId?>" data-target="#buyerdetails" data-toggle="modal"> <?=$orderlist->f_name?>&nbsp;&nbsp;&nbsp;<?=$orderlist->l_name?></a></td>-->
                                    <td>$ <?=$orderlist->price?></td>
                                    <!--<td><?=$orderlist->quantity?></td>-->
<!--                                    <td><?=$status?></td>
                                    <td><a href="javascript:void(0)" onClick="statuschange(<?=$orderlist->id?>,<?=$orderlist->status?>)"><span class="glyphicon glyphicon-pencil"></span></a></td>-->
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
        <h4 class="modal-title">Seller Details</h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered" id="userdata">
              
          </table>
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
                <!--<option value="1">Pending</option>
                <option value="2">Delivered</option>-->
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
            $("#transaction").val("<?=$this->input->get('val')?>");
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
        $("#transaction").addClass("search_form_display");
	$("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
       // $("#bidstatus").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
            if(selectedval=='transid'){
            $("#transaction").removeClass("search_form_display");
            $("#transaction").prop("disabled",false);
            $("#transaction").focus();
            }
            else if(selectedval=='adddate'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
            }else{
                $("#transaction").addClass("search_form_display");
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
            $.post("<?=BASE_URL?>order/getuser",{id:id},function(data,status){        
                var obj = jQuery.parseJSON(data);
                if(obj.res){
                    var user=obj.userdata;
                    tabledata+="<tr>";
                    tabledata+="<td><strong> Username </strong></td>";
                    tabledata+="<td>"+user.username+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td><strong> Mobile </strong></td>";
                    tabledata+="<td>"+user.mobile_no+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td><strong> Name </strong></td>";
                    tabledata+="<td>"+user.f_name+" "+user.l_name+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td><strong> Email </strong></td>";
                    tabledata+="<td>"+user.email_id+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td><strong> Address </strong></td>";
                    tabledata+="<td>"+user.address1+"</td>";
                    tabledata+="<tr>";
  
                }else{
                    tabledata+="<tr>";
                    tabledata+="<td> Data Not Found!! </td>";
                    tabledata+="<tr>";
                }
                $("#userdata").html(tabledata);
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
