<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  Shopping List </h4>
                        <span class="add-button"><a href="<?=BASE_URL?>requirement/post" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Post Requirement</a></span>
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php if($requirements['res']){
                                foreach($requirements['rows'] as $requrement){
                         ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom_20">
                            <div class="requirement_inner clearfix">
                                <p class="requirement_category"><?=$requrement->category?></p>
                                <p class="margin-bottom_45 requirement_text">
                                       <?php echo substr($requrement->details, 0, 300); if(strlen($requrement->details) > 300){echo '...';} ?> 
                                </p>
                                <p><span class="cust_span_1">Posted Date :-</span><span class="cust_span_2"><?php echo $requrement->req_date;?></span></p>    
                                <p class="col-sm-6 col-md-6 col-lg-6 col-xs-12 requirement_price">$<?=$requrement->price?></p>
                                <p class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                    <a href="<?=BASE_URL?>requirement/details/<?=$requrement->id?>" class="requirement_details">Details</a>
                                </p>
                                
                                <div class="requirement_button text-center">
                                    <a href="<?=BASE_URL?>requirement/edit/<?=$requrement->id?>" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#deleteproduct" data-target="#deleteproduct" data-toggle="modal" type="button" class="btn btn-danger delete_req" id="<?=$requrement->id?>"><span class="glyphicon glyphicon-remove-sign"></span></a>
                                </div>
                            </div>
                            
                        </div>
                        <?php }}else{ ?>
                            <p class="text-danger">Record Not Found</p>
                        <?php } ?>
                               
                    </div> 
                    <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                    </ul> 
                </div>
            </div>
        </div>

</div>
</div>
<style>
     .cust_span_1{margin-left: 5px; font-weight: bold;}
    .cust_span_2{margin-left: 13px;}
</style>


<!-- Modal -->
<div id="deleteproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Post</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete post?</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script> 
    $(document).ready(function () {
        $(document).on('mouseenter', '.requirement_inner', function () {
            $(this).find(".requirement_button").show();
        }).on('mouseleave', '.requirement_inner', function () {
            $(this).find(".requirement_button").hide();
        });
        
        $(".delete_req").click(function(){
            var id=$(this).prop('id');
            $("#deleteId").val(id);
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>requirement/delete",{id:deleteId},function(data,status){
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
