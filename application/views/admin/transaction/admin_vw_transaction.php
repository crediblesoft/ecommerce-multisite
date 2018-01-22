<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Transaction
     <small>view</small>
    </h1>
<!--<ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
    </ol>-->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <!--<h3 class="box-title"></h3>-->   
              <span class="text-danger" id="error_search"></span>
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/transaction/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="paymentfor" <?php if($this->input->get('searchby')=='paymentfor'){echo "selected";} ?> >Payment For</option>
                          <option value="transid" <?php if($this->input->get('searchby')=='transid'){echo "selected";} ?> >Transaction Id</option>
						  <option value="amount" <?php if($this->input->get('searchby')=='amount'){echo "selected";} ?> >Total Amount</option>
                          <option value="adddate" <?php if($this->input->get('searchby')=='adddate'){echo "selected";} ?> >Transaction Date</option>
						  <option value="product_name" <?php if($this->input->get('searchby')=='product_name'){echo "selected";} ?> >Product Name</option>
						  <option value="seller" <?php if($this->input->get('searchby')=='seller'){echo "selected";} ?> >By Seller</option>
						  <option value="buyer" <?php if($this->input->get('searchby')=='buyer'){echo "selected";} ?> >By Buyer</option>
						  <option value="address" <?php if($this->input->get('searchby')=='address'){echo "selected";} ?> >By Shipping address</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Product Name</label>
                        <input type="text" class="form-control search_form_display" id="product" name="val" placeholder="Transaction Id" disabled="">
                    </div>
					
					<div class="form-group">
                        <label for="pwd" class="sr-only">total amount</label>
                        <input type="text" class="form-control search_form_display" id="amount" name="val" placeholder="total amount" disabled="">
                    </div>
                    <div class="form-group"> &nbsp;
                      <label for="pwd" class="sr-only" >Product Name</label>
                      <select class="form-control search_form_display" id="usercategory" name="val" disabled="">
                          <option value="">----Please Select----</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">From date</label>
                        <input type="text" class="form-control search_form_display" id="from" name="from" placeholder="From" disabled="">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">To date</label>
                        <input type="text" class="form-control search_form_display" id="to" name="to" placeholder="To" disabled="">
                    </div>
					
					<div class="form-group">
                        <label for="pwd" class="sr-only">Product Name</label>
                        <input type="text" class="form-control search_form_display" id="product_name" name="val" placeholder="Product Name" disabled="">
                    </div>
					
					<div class="form-group">
                        <label for="pwd" class="sr-only">Seller </label>
                        <input type="text" class="form-control search_form_display" id="seller" name="val" placeholder="Search by Seller" disabled="">
                    </div>
					
					<div class="form-group">
                        <label for="pwd" class="sr-only">Buyer </label>
                        <input type="text" class="form-control search_form_display" id="buyer" name="val" placeholder="Search by Buyer" disabled="">
                    </div>
					
					<div class="form-group">
                        <label for="pwd" class="sr-only">address </label>
                        <input type="text" class="form-control search_form_display" style="width:192px;" id="address" name="val" placeholder="Shipping city/state/zipcode" disabled="">
                    </div>
                    
<!--                    <div class="form-group">
                        <label for="pwd" class="sr-only"></label>
                        <input type="hidden" class="form-control search_form_display" id="bidstatus" name="val" placeholder="" value="<?php echo date('Y-m-d');?>" disabled="">
                    </div>-->
                    
                    <button type="submit" class="btn btn-default" id="search">Search</button>
                    
                <div class="pull-right">
              <!--   <a href="<?=BASE_URL?>admin/product" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Buy directly product</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>-->
                </div>
                </form>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <!--<th style="width: 10px"><input type="checkbox" id="select-all">&nbsp;</th>-->
                        <th>Transaction Id</th>
                        <th>Payment</th>
                        <th>User</th>
                        <th>Price</th>
                        <th>Transaction date</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>

                    
                    <?php if($products['res']){ $i=1; $total=0; foreach($products['rows'] as $product){ $total+=$product->price; ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <!--<td><input type="checkbox" value="<?=$product->id?>" class="innercheckbox" name="id[]"></td>-->
                      <td><?=$product->trans_id?></td>
                    <td><?php if($product->payment_for=='campeign'){echo "Campaign";}else{echo ucfirst($product->payment_for);}?></td>
                 
                    <td> 
                    <?php if($product->username=="" && $product->user2==""){ echo "Not Registered User";}
                    elseif($product->payment_for=='bidproduct'){echo $product->user2;}
                    else{echo $product->username;} ?>
                   </td>
                    
                    <td>$<?=$product->price?></td>
                      <td><?=$product->date?></td>
                      <td><?=ucfirst($product->status)?></td>
                      <td>
                          <?php if($product->payment_for=='product' || $product->payment_for=='bidproduct'){ ?>
                          <a href="<?=BASE_URL?>admin/order/details/<?=$product->id?>" class="btn btn-info btn-sm" title="View details"><span class="glyphicon glyphicon-eye-open"></span></a>
                          <?php }else{ ?>
                          <a href="<?=BASE_URL?>admin/transaction/details/<?=$product->id?>" class="btn btn-info btn-sm" title="View details"><span class="glyphicon glyphicon-eye-open"></span></a>
                          <?php } ?>
                      </td>
                    </tr>
                    
                    <?php $i++;}?>
                    <tr>
                        <td colspan="2"></td>
                        <td></td>
                        <td><strong>Total</strong></td>
                        <td><strong>$<?=$total?></strong></td>
                        <td colspan="3"></td>
                    </tr>
                    
<!--                    <tr>
                        <td colspan="11">
                            <div class="pull-right">
                                <a href="<?=BASE_URL?>admin/product" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Buy directly product</a>
                                <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
                            </div>   
                        </td>
                    </tr>-->
                    
                    <?php }else{ ?>
                    <tr>
                        <td colspan="11"><p class="text-danger">No record found.</p></td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
               <?=$links?>
              </ul>
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>




<script> 
    $(document).ready(function(){
        var selectedval=$("#searchby").val();
        search(selectedval);
        if(selectedval=='transid'){
            $("#product").val("<?=$this->input->get('val')?>");
        }
		
		else if(selectedval=='amount'){
            $("#amount").val("<?=$this->input->get('val')?>");
        }
		
		else if(selectedval=='address'){
            $("#address").val("<?=$this->input->get('val')?>");
        }
		
		else if(selectedval=='product_name'){
            $("#product_name").val("<?=$this->input->get('val')?>");
        }
		
		else if(selectedval=='seller'){
            $("#seller").val("<?=$this->input->get('val')?>");
        }
		
		else if(selectedval=='buyer'){
            $("#buyer").val("<?=$this->input->get('val')?>");
        }
		
		else if(selectedval=='paymentfor'){ //alert("aa");
            $('#usercategory option[value="<?=$this->input->get('val')?>"]').attr("selected", "selected");
        }else if(selectedval=='adddate'){
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
		$("#amount").addClass("search_form_display");
		$("#address").addClass("search_form_display");
        $("#usercategory").addClass("search_form_display");
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
		$("#product_name").addClass("search_form_display");
		$("#seller").addClass("search_form_display");
		$("#buyer").addClass("search_form_display");
       // $("#bidstatus").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='transid'){
            $("#product").removeClass("search_form_display");
            $("#product").prop("disabled",false);
            $("#product").focus();
            }
			
	    else if(selectedval=='amount'){
            $("#amount").removeClass("search_form_display");
            $("#amount").prop("disabled",false);
            $("#amount").focus();
            }
		else if(selectedval=='address'){
            $("#address").removeClass("search_form_display");
            $("#address").prop("disabled",false);
            $("#address").focus();
            }
			
		else if(selectedval=='product_name'){
            $("#product_name").removeClass("search_form_display");
            $("#product_name").prop("disabled",false);
            $("#product_name").focus();
            }
		
		else if(selectedval=='seller'){
            $("#seller").removeClass("search_form_display");
            $("#seller").prop("disabled",false);
            $("#seller").focus();
            }
		else if(selectedval=='buyer'){
            $("#buyer").removeClass("search_form_display");
            $("#buyer").prop("disabled",false);
            $("#buyer").focus();
            }
			
			else if(selectedval=='paymentfor'){
                $("#usercategory").removeClass("search_form_display");
                $("#usercategory").prop("disabled",false);
                $("#usercategory").focus();
                getpayment(selectedval);
            }else if(selectedval=='adddate'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
            }else{
                $("#product").addClass("search_form_display");
				$("#amount").addClass("search_form_display");
				$("#product_name").addClass("search_form_display");
				$("#seller").addClass("search_form_display");
				$("#buyer").addClass("search_form_display");
                $("#usercategory").addClass("search_form_display");
                $("#from").addClass("search_form_display");
                $("#to").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
    
    function getpayment(getvalue){
        var htm="";
        htm+='<option value="">-----Select Category----</option>';
        htm+='<option value="1">Product</option>';
        htm+='<option value="2">Campaign</option>';
        htm+='<option value="3">User</option>';
        $("#usercategory").html(htm);
    }
    
    
    $(document).ready(function(){
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });  
    });
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
