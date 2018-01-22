
<?php //print_r($order); ?>
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Gallery</h4>
                         
                         
                         <span class="add-button">
                             <a href="<?=BASE_URL?>gallery/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Gallery</a>
                             <a href="<?=BASE_URL?>gallery/addvideos" class="btn btn-warning"> <span class="glyphicon glyphicon-plus-sign"></span> Add Videos</a>
                             <a href="<?=BASE_URL?>gallery/viewvideos" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open"></span> View Videos</a>
                         </span>
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                <div class="col-sm-12">
                    <div class="">
                        <?php /*if($gallery['res']){
                              foreach($gallery['rows'] as $gallerydata){
                            ?> 
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <?php echo $gallerydata->video_path; ?>
                            <div class="caption animated">
                                <a href="javascript:void(0);" id="<?=$gallerydata->id?>" title="Edit" data-target="#editvideo" data-toggle="modal" class="btn btn-success edit_gal" ><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="javascript:void(0);" id="<?=$gallerydata->id?>" title="Delete" data-target="#deleteproduct" data-toggle="modal" class="btn btn-danger delete1"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                        </div>
                        <?php } }*/ ?>
                        
                        
                        <?php if($gallery['res']){
                              foreach($gallery['rows'] as $gallerydata){
                                  $str = explode("?",$gallerydata->video_path);
                                  $status=0;
                                    if(count($str) > 1){
                                    parse_str($str[1],$output);
                                    if(isset($output['v'])){
                                        $url="http://www.youtube.com/v/".$output['v'];
                                    }else{ 
                                        $url='';
                                        $status++;
                                    }
                                    }else{
                                        $url=$gallerydata->video_path;
                                        $status++;
                                    }
                                   
                            ?>
                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 margin-bottom_20">
                        <?php if($status > 0){ ?>
                             <p height="150">This video does not add properly</p>
                         <?php }else{ ?>
                        <object width="425" height="350">
                            <param name="movie" value="<?=$url?>" />
                            <embed src="<?=$url?>" type="application/x-shockwave-flash" />
                        </object>
                         <?php } ?>   
                            <div class="caption animated">
                                <a href="javascript:void(0);" id="<?=$gallerydata->id?>" title="Edit" data-target="#editvideo" data-toggle="modal" class="btn btn-success edit_gal" ><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="javascript:void(0);" id="<?=$gallerydata->id?>" title="Delete" data-target="#deleteproduct" data-toggle="modal" class="btn btn-danger delete1"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                         </div>    
                        <?php } }else{ ?>
                        <p class="text-danger">There are no videos found here! </p>
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


<!-- Modal -->
<div id="deleteproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Gallery Video</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete video</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="editvideo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong>Edit Video</strong> </h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-update"></div></div>
          <form class="form-horizontal" id="form_gallery" role="form" enctype = 'multipart/form-data' method="post" action="">
                <div class="form-group">
                    <input type="hidden" id="video_id">
                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Link</label></div>
              <div class="col-sm-9">          
                  <input type="text" class="form-control" id="video_link" value="<?=set_value('video_link')?>" name="video_link" placeholder="Video Link">
                  <?php if(form_error('video_link')!='') echo form_error('video_link','<div class="text-danger err">','</div>'); ?>
              </div>
              <span class="text-danger" id="video_link_error"></span>

            </div>




            </form>
      </div>
      <div class="modal-footer"> 
          <button id="update_video" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


 


<script>
    $(document).ready(function(){
        $(".delete1").click(function(){
            var id=$(this).prop('id');
            //alert(id);
            $("#deleteId").val(id);
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>gallery/videodelete",{id:deleteId},function(data,status){
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
        
        $(".edit_gal").click(function(){
            var id=$(this).attr("id");
            $.post("<?=BASE_URL?>gallery/video_edit",{id:id},function(data,status){
                var obj=$.parseJSON(data);
                console.log(obj);
                if(obj.res){
                    $("#video_id").val(obj.rows.id);
                    $("#video_link").val(obj.rows.video_path);
                }
            });
        });
        
        $("#update_video").click(function(){
            var id=$("#video_id").val();
            var video_link=$("#video_link").val();
            var check_valid=0;
            
            if(video_link == ''){
                    //$("#fname_error").html("Enter Your First Name");
                    check_valid++;
                    $("#video_link").focus();
                    $("#video_link_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(check_valid==0){
                  $.post("<?=BASE_URL?>gallery/video_update",{id:id,video_link:video_link},function(data,status){
                       var obj=$.parseJSON(data);
                        if(obj.status){
                           $("#e-result-update").empty().append(obj.message).addClass("alert alert-success fade in");
                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 1000); 
                        }else
                            {
                                $("#e-result-update").empty().append(obj.message).addClass("alert alert-error fade in");
                            }
                    });
              }

        });
        
        });
    </script>    