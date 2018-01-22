<?php
//print_r($recipe);
?>

<div class="col-sm-9">
            <div class="">
               
                    <div class="contant-head">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_none padding_left_none">
                            <div class="col-lg-7 col-md-7 col-sm-5 col-xs-12 padding_left_none">
                              <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Recipe</h4>  
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12 padding_right_none">
                              
                             <div class="row col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">
                                <span class="add-button"><a href="<?=BASE_URL?>recipe/add" class="btn btn-success"> 
                                        <span class="glyphicon glyphicon-plus-sign"></span> 
                                        Add Recipe
                                    </a>                                 
                                </span> 
                             </div>
                         
                            </div>
                        </div>
                </div>
            </div>
            
            <div class="contant-body2">
                    <div class=" col-sm-12 table-responsive padding_right_none padding_left_none">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Add Date</td>
                                    <td>Category</td>                                    
                                    <td>Title</td>
                                    <td>Image</td>
                                    <td>Status</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                    <td>View</td>  
                                    <td>Admin status</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                               // print_r($recipe);
                                if($recipe['res']){ 
                                foreach($recipe['rows'] as $recipelist){
                            ?>    
                                <tr>
                                    <td><?php echo $recipelist->recipe_addDate;?></td>
                                    <td title="<?=$recipelist->category?>"><?php echo substr($recipelist->category,0,12); if(strlen($recipelist->category)>12){echo "...";}?></td>
                                    <td title="<?=$recipelist->recipe_title?>"><?php echo substr($recipelist->recipe_title,0,12); if(strlen($recipelist->recipe_title)>12){echo "...";}?></td>
                                    <td>
										
					 <?php
						if(substr_count($recipelist->image_path,'http') > 0 ) $reciepe_image=$recipelist->image_path; 
						else $reciepe_image=BASE_URL.'assets/image/recipe/thumb/'.$recipelist->image_path;
						?>
						
                          <img src="<?php echo $reciepe_image; ?>" height='70' width='70' class="img-responsive">
                                    </td>
                                    <?php /*<td title="<?=$recipelist->recipe_detail?>"><?php echo substr($recipelist->recipe_detail, 0, 6).'...'?></td>*/?>
                                    <td><?php if($recipelist->recipe_stetus){ ?><span class="text-success">Active</span><?php }else{ ?><span class="text-danger">Inactive</span><?php } ?></td>
                                    <td><a href="<?=BASE_URL?>recipe/editrecipe/<?=$recipelist->recipeid?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td><a href="javascript:void(0);" id="<?=$recipelist->recipeid?>" title="Delete" class="delete" data-target="#deleteproduct" data-toggle="modal" ><span class="glyphicon glyphicon-remove-circle"></span></a></td>
                                    <td><a href="<?=BASE_URL?>recipe/viewRecipe/<?=$recipelist->recipeid?>" title="View details"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                    <?php /*if(!$recipelist->admin_status){ ?><td><small class="text-danger">In-active by admin</small></td><?php }*/ ?>
                                    <td><?php if(!$recipelist->admin_status){ ?><span class="text-danger">In-active</span><?php }else{ ?> <span class="text-success">Active</span> <?php } ?></td>
                                </tr>
                                <?php }                                 
                                    }
                                    else
                                        { ?>
                                <tr><td colspan="8"><p class="text-danger">No record found.</p></td></tr>
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

<!-- Modal -->
<div id="deleteproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Recipe</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete recipe?</h4>
         
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
        <h4 class="modal-title">Recipe Winner Details</h4>
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
            $.post("<?=BASE_URL?>recipe/delete",{id:deleteId},function(data,status){
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
        
        
    });
</script>    
