<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Accounting
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
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/accounting/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By Seller:</label>
                     <select class="form-control" id="users" name="users">
					 <option value=''>Select seller</option>
                        <?php if($users['res']){ foreach($users['rows'] as $user){ ?>
                        <option value="<?=$user->id?>" <?php if($this->input->get('users')==$user->id){?> selected <?php }?> ><?=$user->username?></option>
                        <?php }} ?>
                    </select>
                    </div> &nbsp;
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">From date</label>
                        <input type="text" class="form-control " id="from" name="from" placeholder="From" value="<?php echo $this->input->get('from');?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">To date</label>
                        <input type="text" class="form-control" id="to" name="to" placeholder="To" value="<?php echo $this->input->get('to');?>" >
                    </div>
					                    
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
                        <th>Seller</th>
                        <th>Total</th>
						<th>Tax</th>
						<th>Commision</th>
						<th>Shipping charge</th>
                        <th>Transaction date</th>
                        
                    </tr>

                    
                    <?php if($products['res']){ $i=1; $total=0; foreach($products['rows'] as $product){ 
					$total+=$product->total; 
					$totalcomm+=$product->commission;
					$totalshipping+=$product->shippingcharge;
					?>
                    <tr>
                    <td><?=$i?>.</td>
                    <td><?=$product->trans_id?></td>
                    <td><?php echo $product->username; ?></td>
                    <td>$<?php echo $product->total; ?></td>
                    <td><?php echo $product->tax; ?> %</td>
                    <td>$<?php echo $product->commission; ?></td>
                    <td>$<?php echo $product->shippingcharge; ?></td>
					<td><?php echo date('d-m-Y',strtotime($product->tansdatetime)); ?></td>
                    </tr>
                    
                    <?php $i++;}?>
                    <tr>
                        <td colspan="1"></td>
                        <td></td>
                        <td><strong>Total</strong></td>
                        <td><strong>$<?=$total?></strong></td>
						<td></td>
                        <td><strong>$<?=$totalcomm?></strong></td>
						<td><strong>$<?=$totalshipping?></strong></td>
						<td></td>
                    </tr>
                    <?php if(isset($_GET['users']) && $_GET['users']!=''){
						$payment=($total+$totalshipping)-$totalcomm;
					?>
					<tr>
					<td colspan="2"></td>
					<td colspan="2"><strong>Payment to Seller</strong></td>
					<td colspan="4"><strong> $ <?php echo $payment;?></strong></td>
					</tr>
					<?php }?>
                    
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
<link href="<?=BASE_URL?>assets/multiselect/css/bootstrap-multiselect.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?=BASE_URL?>assets/multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<style>.dropdown-menu{min-height: 300px !important;max-height: 300px !important;overflow-y: scroll !important;}
.multiselect-search{width:200px !important;}
.lmt_msg{color: red;}
</style>



<script> 
    $(document).ready(function(){

	$('#users').multiselect(
		{
			enableCaseInsensitiveFiltering: true,
			includeSelectAllOption: true
		}
		);
		
        $(document).on("click","#search",function(){
            var selectedval=$("#searchby").val();
            if(selectedval==''){
                $("#error_search").html("Please select any one");
                return false;
            }
            return true;
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
