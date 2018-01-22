<div class="col-sm-9">
            <div class="row">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  Manage Buyer Requirement </h4>
                        <span class="add-button hidden-xs custom_width">
                            <div class="input-group">
                             <input type="text" autocomplete="off" class="form-control searchbycategoryname" name="forum_topic_search" placeholder="Search" id="">
                             <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="searcheddata">
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
                                
                                <div class="requirement_button1 text-right">
                                    <a href="<?=BASE_URL?>message/<?=$requrement->buyer?>" class="btn btn-success chatwithonlineuser"><?php if($requrement->selleronline){echo "Chat with $requrement->username";}else{echo"Send Message to $requrement->username";} ?></a>
<!--                                    <a href="<?=BASE_URL?>message/<?=$requrement->buyer?>" target="_blank" type="button" class="btn btn-success" title="conversation"><span class="glyphicon glyphicon-comment"></span></a>-->
                                </div>
                            </div>
                            
                        </div>
                                    <?php }}else{ ?>
                            <p class="text-danger">Record Not Found</p>
                         <?php } ?>
                               
                    </div> 
                    <ul class="pagination pagination-sm no-margin pull-right" id="pagi">
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
        <h4 class="modal-title">Delete Post</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do You Want To Delete Post</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<style>
    .custom_width{width:240px;}
    .cust_span_1{margin-left: 13px; font-weight: bold;}
    .cust_span_2{margin-left: 13px;}
</style>
<script> 
    /**********Search**********/
    
    $(document).ready(function(){
        $(".searchbycategoryname").keyup(function(){
            var category=$(this).val();
            var htm='';
            if(category!=''){
            $.post("<?=BASE_URL?>requirement/searchbycategory/",{category:category},function(data,status){
                //console.log(data);
                var obj=$.parseJSON(data);
                if(obj.res){
                    
                    console.log(obj.rows);
                    $.each(obj.rows,function(i,val){
                        //console.log(val.UserId);
                        if(val.details.length > 300){
                            var dot1='...';
                        }else{
                            var dot1='';
                        }
                        
                        htm+='<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom_20">';
                        htm+='<div class="requirement_inner clearfix">';
                        htm+='<p class="requirement_category">'+val.category+'</p>';
                        htm+='<p class="margin-bottom_10 requirement_text">'+val.details.substr(0, 300)+''+dot1+'</p>';
                        htm+='<p class="col-sm-6 col-md-6 col-lg-6 col-xs-12 requirement_price">$'+val.price+'</p>';
                        htm+='<p class="col-sm-6 col-md-6 col-lg-6 col-xs-12">';
                        htm+='<a href="<?=BASE_URL?>requirement/details/'+val.id+'" class="requirement_details">Details</a>';
                        htm+='</p>';
                        htm+='<div class="requirement_button1 text-right">';
                        htm+='<a href="" type="button" class="btn btn-success" title="conversation"><span class="glyphicon glyphicon-comment"></span></a>';
                        htm+='</div>';
                        htm+='</div>';
                        htm+='</div>';
                    });
                    
                }else{
                    htm+='<p class="text-danger">Record Not Found</p>';
                    
                }
                $("#pagi").css("display","none");
                 $("#searcheddata").html(htm);
            });
            }else{
                window.location.reload();
            }
        });
    });
    
    
    function ucfirst(str) {
        str += '';
        var f = str.charAt(0)
          .toUpperCase();
        return f + str.substr(1);
    }
</script>
