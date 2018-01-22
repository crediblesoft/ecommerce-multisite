<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Saved Searches</h4>
                         <!--<span class="add-button"><a href="<?=BASE_URL?>product/savesearches" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Save Searches</a></span>-->
                    </div>
                </div>
            </div>
            
            <div class="contant-body2">
                
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Date</td>
                                    <td>Category</td>
                                    <td>Delete</td>
                                    <td>View</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($products['res']){ 
                                 
                                foreach($products['rows'] as $productslist){
                            ?>    
                                <tr>
                                    <td><?=$productslist->add_date?></td>
                                    <td title="<?=$productslist->category?>"><?=$productslist->category?></td>
                                    <td><a href="javascript:void(0);" id="<?=$productslist->id?>" title="Delete" class="delete" data-target="#deleteproduct" data-toggle="modal" ><span class="glyphicon glyphicon-remove-circle"></span></a></td>
                                    <td><a href="<?=BASE_URL?>product/searchdetails/<?=$productslist->id?>" title="View details"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                    
                                </tr>
                                <?php }}else{ ?>
                                <tr>
                                    <td colspan="10"> <p class="text-danger">Record Not Found</p></td>
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


<!-- Modal -->
<div id="deleteproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Search</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete this search</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
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
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>product/deletesearches",{id:deleteId},function(data,status){
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