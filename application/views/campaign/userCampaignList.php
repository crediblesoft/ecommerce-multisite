<?php //print_r($products); ?>
<?php /*$currenturl=explode('/',  current_url()); 
      if(in_array('bid',$currenturl)){
          $bid=true;
      }else{
          $bid=false;
      }*/
//echo $bid;
?>
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Campaign</h4>
                         <span class="add-button"><a href="<?=BASE_URL?>campaign/addcampaign" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Campaign</a></span>
                    </div>
                </div>
            </div>
            <div class="contant-body2">
                    <div class=" col-sm-12 table-responsive padding_right_none padding_left_none">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>Image</td>
                                    <td>Price</td>                                    
                                    <td>Title</td>
                                    <td>Gross Amount Collected</td>
                                    <td>Pay Out After Fee</td>
                                    <td>Status</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                    <td>View</td>
                                    <td>Admin status</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                               // print_r($campaigns);
                                if($campaigns['res']){ 
                                 $totalamt=0;    
                                foreach($campaigns['rows'] as $campaignslist){
                                  
                                 $totalamt=$campaignslist->ac_price;
                                 $actual_receive=($campaignslist->ac_price-$campaignslist->ttlcomm);
                                 //$totalamt=$totalamt+$campaignslist->ac_price;    
                                ?>    
                                <tr>
                                    <td><?php echo $campaignslist->start_date;?></td>
                                     <td><?php echo $campaignslist->end_date;?></td>
                                    <td><img src="<?=BASE_URL."assets/image/campaign/thumb/".$campaignslist->image_path?>" height="100%" width="100%" class="img-responsive block"></td>
                                    <td><?=$campaignslist->price?></td>
                                    <td title="<?=$campaignslist->campaign_titel?>"><?=substr($campaignslist->campaign_titel, 0, 8).'...'?></td>
                                    <td><?php echo $campaignslist->ac_price; ?></td>
                                    <td><?php echo $actual_receive;?></td>
                                    <td><?php if($campaignslist->show_stetus){ ?><span class="text-success">Active</span><?php }else{ ?><span class="text-danger">Inactive</span><?php } ?></td>
                                    <td><a href="<?=BASE_URL?>campaign/editCampaign/<?=$campaignslist->id?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td><a href="javascript:void(0);" id="<?=$campaignslist->id?>" title="Delete" class="delete" data-target="#deleteproduct" data-toggle="modal" ><span class="glyphicon glyphicon-remove-circle"></span></a></td>
                                    <td><a href="<?=BASE_URL?>campaign/view/<?=$campaignslist->id?>" title="View details"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                    <?php /*if(!$campaignslist->admin_status){ ?><td><small class="text-danger">In-active by admin</small></td><?php }*/ ?>
                                    <td><?php if(!$campaignslist->admin_status){ ?><span class="text-danger">In-active</span><?php }else{ ?> <span class="text-success">Active</span> <?php } ?></td>
                                   <!--campaign/userViewCampaign-->
                                </tr>
                                <?php }?><?php } else{ ?>
                                <tr><td colspan="9"><p class="text-danger">No Record Found</p></td></tr>
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

<!-- Modal -->
<div id="deleteproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Campaign</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete campaign?</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
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
        <h4 class="modal-title">Campaign Winner Details</h4>
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
            $("#e-result-delete").empty();
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>campaign/delete",{id:deleteId},function(data,status){
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
        
        /*$(".winner").click(function(){
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
                    tabledata+="<td>"+user.price+"</td>";
                    tabledata+="<tr>";
  
                }else{
                    tabledata+="<tr>";
                    tabledata+="<td> Data Not Found!! </td>";
                    tabledata+="<tr>";
                }
                $("#userdata").html(tabledata);
                
            });
        });*/
    });
</script>    