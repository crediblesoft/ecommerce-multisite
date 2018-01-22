<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Product</h4>
                         <span class="add-button"><a href="<?=BASE_URL?>product/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Product</a></span>
                    </div>
                </div>
            </div>
            
            <div class="contant-body2">
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 padding_right_none">
                    <div class="">
                    <div class="product-type pull-right">    
                        
                        <ul><li><a href="<?=BASE_URL?>product" class="btn btn-default <?php if(!$bid){ ?> active <?php } ?>">Buy Directly</a></li>
                        <li><a href="<?=BASE_URL?>product/bid" class="btn btn-default <?php if($bid){ ?> active <?php } ?>">Bid</a></li></ul>
                    </div>
                    </div>
                    
                    <div class="table-responsive width_100">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Date</td>
                                    <td>Image</td>
                                    <td style="padding-left: 20px ! important; padding-right: 20px ! important;">Price</td>
                                    <td>Quantity</td>
                                    <td>Category</td>
                                    <td>Name</td>
                                    <td>Status</td>
                                    <td>Edit</td>
                                   <?php if($bid){?> <td>Move</td> <?php } ?>
                                    <td>Delete</td>
                                    <td>View</td>
                                    <td>Admin status</td>
                                    <?php if($bid){ ?><td>Bid Status</td><?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($products['res']){ 
                                    $currentdate=date('Y-m-d');
                                foreach($products['rows'] as $productslist){

                                    if($bid){ 
                                    $bid_declear_date = new DateTime($productslist->bid_end_date);
                                    $bid_declear_date->modify('+1 day');
                                    }
                            ?>    
                                <tr>
                                    <td><?=$productslist->date?></td>
                                    <td><img src="<?=BASE_URL."assets/image/product/thumb/".$productslist->prod_img?>" height="70" width="70" class="img-responsive"></td>
                                    <td style="padding-left: 8px ! important; padding-right: 0px ! important;"> $ <?=$productslist->prod_price?></td>
                                    <td> <?=$productslist->no_of_Prod?></td>
                                    <td title="<?=$productslist->category?>"><?=  substr($productslist->category, 0, 6).'...'?></td>
                                    <td><?=$productslist->prod_name?></td>
                                    <td><?php if($productslist->status){ ?><span class="text-success">Active</span><?php }else{ ?><span class="text-danger">Inactive</span><?php } ?></td>
                                    <td>
                                        <?php if($productslist->bid_status==1 && $currentdate > $productslist->bid_purchase_date) { ?>
                                        <a href="<?=BASE_URL?>product/rebid/<?=$productslist->prod_id?>" id="re-auction" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add to re-bid </a>
                                        
                                        <?php } else { ?>
                                        <a href="<?=BASE_URL?>product/edit/<?=$productslist->prod_id?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <?php } ?>
                                    </td>
                                    <?php if($bid){?>
                                    <td>
                                        
                                            <a href="javascript:void(0);" id="<?=$productslist->prod_id?>" title="Move to Buy Directly" data-target="#moveproduct" data-toggle="modal" class="btn btn-success btn-sm move_to"></span> Move to Buy Directly </a>
                                           
                                    </td>
                                    
                                    <?php } ?>
                                    <td><a href="javascript:void(0);" id="<?=$productslist->prod_id?>" title="Delete" class="delete" data-target="#deleteproduct" data-toggle="modal" ><span class="glyphicon glyphicon-remove-circle"></span></a></td>
                                    <td><a href="<?=BASE_URL?>product/details/<?=$productslist->prod_id?>" title="View details"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                    <td><?php if(!$productslist->admin_status){ ?><span class="text-danger">In-active</span><?php }else{ ?> <span class="text-success">Active</span> <?php } ?></td>
									<?php if($bid){ ?>
                                    <?php if($currentdate > $productslist->bid_end_date ){  ?>
                                    <td><?php if($productslist->bidcount>0){ ?>
                                        <a href="javascript:void(0)" id="<?=$productslist->prod_id?>" class="winner" data-target="#buyerdetails" data-toggle="modal">Win</a>
                                    <?php }else{ ?>
                                        <p>No Bid</p>
                                    <?php } ?>   
                                    </td>
                                    <?php }else{  ?>
                                    <td><a href="javascript:void(0)" id="<?=$bid_declear_date->format('Y-m-d')?>" class="winner1" data-target="#buyerdetails" data-toggle="modal">On Going</a></td>
                                    <?php } ?>
                                    
                                    <?php }  ?>
                                    
                                </tr>
                                <?php }}else{ ?>
                                <tr>
                                    <td colspan="10"> <p class="text-danger">Record Not Found</p></td>
                                </tr>    
                                <?php } ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                        </ul>
                </div>
            </div>
               
        </div>
        
        
    </div>
</div>  

<!-- Modal -->
<div id="deleteproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Product</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete product?</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="moveproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Move Product </h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-move"></div></div>
          
          <input type="hidden" name="moveId" id="moveId">
          <h4>Do you want to move product to Buy Directly?</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="move" >Move</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <h4 class="modal-title">Product Winner Details</h4>
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

<script>
    $(document).ready(function(){
        $(".delete").click(function(){
            var id=$(this).prop('id');
            $("#deleteId").val(id);
        });

        $(".move_to").click(function(){
            var id=$(this).prop('id');
            $("#moveId").val(id);
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>product/delete",{id:deleteId},function(data,status){
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
        $("#move").click(function(){
            var moveId=$("#moveId").val();
            //alert(moveId);
            $.post("<?=BASE_URL?>product/move_to_buy_directly",{id:moveId},function(data,status){
                obj=$.parseJSON(data);
                if(obj.status){
                   $("#e-result-move").empty().append(obj.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                                window.location.href="<?=BASE_URL?>product/";
                            }, 1000); 
                }else
                    {
                        $("#e-result-move").empty().append(obj.message).addClass("alert alert-error fade in");
                    }
            });
        });
        
        $(".winner1").click(function(){
            var id=$(this).prop('id');
            
            $("#userdata").empty().html("<tr><td>Product winner declare on "+id+"</td></tr>");
        });
        
        $(".winner").click(function(){
            var id=$(this).prop('id');
            var tabledata="";
            $.post("<?=BASE_URL?>product/getwinner",{id:id},function(data,status){        
                var obj = jQuery.parseJSON(data);
                //console.log(obj.data[0].price);
                if(obj.res){
                    var user=obj.data[0];
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
                    tabledata+="<td> Price </td>";
                    tabledata+="<td> $"+user.price+"</td>";
                    tabledata+="<tr>";
  
                }else{
                    tabledata+="<tr>";
                    tabledata+="<td> No One Bid on This product </td>";
                    tabledata+="<tr>";
                }
                $("#userdata").html(tabledata);
                
            });
        });
    });
</script>    
