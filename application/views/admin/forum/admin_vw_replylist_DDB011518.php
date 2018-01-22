<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Forum
     <small>reply list</small>
    </h1>
<!--    <ol class="breadcrumb">
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
                <div class="pull-right">
                    
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" id="">Delete</a>
                    <a href="<?=BASE_URL?>admin/forum/addreply/<?=$forumlist['rows'][0]->ForumId?>" class="btn btn-primary btn-sm" id=""><span class="glyphicon glyphicon-plus-sign"></span> Add Reply</a>
                    <a href="<?=BASE_URL?>admin/forum/add" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-plus-sign"></span> Add Category</a>
                    <a href="<?=BASE_URL?>admin/forum" class="btn btn-warning btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> View Category</a>
                </div>  
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                
                <?php if($forumlist['res']){ $forum=$forumlist['rows'][0]; ?>
           <input type="hidden" name="cat_id" id="cat_id" value="<?=$forum->ForumId?>">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_topic_main margin-bottom_20">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_topic_detail_outerhead">
            <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6" ><span class="cus_topic_detail_head"><?=$forum->topic?></span></div>
            <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6 cus_topic_detail_footer_inner">
                <div class="pull-right ">
                <span>By</span> &nbsp;
                <span><a href="<?=BASE_URL?>forum/user/<?=$forum->UserId?>"><?=ucfirst($forum->f_name)?> <?=$forum->l_name?></a></span> &nbsp;
                <span><?php echo date("d-M-Y", $forum->timestamp); ?></span> &nbsp;
                <span><?php echo date("h:i a", $forum->timestamp); ?></span> &nbsp;
                </div>
                
            </div>
<!--            <span class="pull-right">
                    <a href="#deletetopic" class="delete" id="<?=$forum->ForumId?>" data-traget="#deletetopic" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>
            </span>-->
        </div> 

        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <span class="custom_topic_detail_content"><?=$forum->question?></span>
        </div>
        <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12 line4 margin-bottom_10">&nbsp;</div> 
        
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_topic_detail_footer">
            <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6">
                <div class="col-sm-2 col-lg-2 col-md-2 col-xs-6">
                    <a href="javascript:void(0);" class="" id="<?=$forum->ForumId?>"><span class="glyphicon glyphicon-thumbs-up"  ></span> </a>&nbsp;<?=$forum->like?>
                </div>
                <div class="col-sm-3 col-lg-3 col-md-3 col-xs-6">
                    <a href="javascript:void(0);" class="" id="<?=$forum->ForumId?>"><span class="glyphicon glyphicon-eye-open"  ></span> </a>&nbsp;<?=$forum->view?>
                    
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6 cus_topic_detail_footer_inner">
                <div class="pull-right ">
                <?php if($replylist['res']){?>
                select all&nbsp;&nbsp;<input type="checkbox" id="select-all"> 
               <?php } ?>
                </div>
                
            </div>
        </div>
        </div>    
    </div>
    <?php } ?>   
    <?php  if($replylist['res']){
                        foreach($replylist["rows"] as $reply){
                ?>
    
    <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 margin-bottom_20">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_topic_detail_outerhead">
            <div class="col-sm-1 col-lg-1 col-md-1 col-xs-1">
                <?php if(!$reply->adminid){ ?>
                <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$adminsettings->default_image?>" class="img img-circle" width="50" height="50">
                <?php }else{ ?>
                <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$reply->profile_Pic?>" class="img img-circle" width="50" height="50">
                <?php } ?>
            </div>
            <div class="col-sm-9 col-lg-9 col-md-9 col-xs-9 cus_topic_detail_head2">
                <div class="inner">
                <span>By</span> &nbsp;
                <?php if(!$reply->adminid){ ?>
                <span><a href="javascript:void(0);">Admin</a></span> &nbsp;
                <?php }else{ ?>
                <span><a href="<?=BASE_URL?>admin/users/details/<?=$reply->UserId?>" target="_blank"><?=ucfirst($reply->f_name)?> <?=$reply->l_name?></a></span> &nbsp;
                <?php } ?>
                <span><?php echo date("d-M-Y", $reply->timestamp); ?></span> &nbsp;
                <span><?php echo date("h:i a", $reply->timestamp); ?></span> &nbsp;<br/>
                <div class="row col-sm-4 col-md-4 col-lg-4 col-xs-4 line1"></div>
                </div>
            </div>
            <div class="col-sm-2 col-lg-2 col-md-2 col-xs-2">
                <span class="pull-right">
                    
                    <input type="checkbox" value="<?=$reply->ReplyId?>" class="innercheckbox" name="id[]">
                    <!--<a href="#deletereply" class="deletereply" id="<?=$reply->ReplyId?>" data-traget="#deletereply" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>-->
                </span>
<!--                <span class="pull-right">
                <?php
                    /*if($reply->UserId==$this->session->userdata("user_id")){
              ?>
              <a href="javascript:void(0);" class="editreply" id="<?=$reply->ReplyId?>" data-target="#editforum" data-toggle="modal"><span class="glyphicon glyphicon-pencil squre_pencil"></span></a> 
              <?php if($forum->Noofreply==0){ ?> 
              <a href="javascript:void(0);" class="deletereply" data-traget="#deletereply" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>
            <?php 
                    } }*/
            ?>
                </span>-->
            </div>
        </div> 
            <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 margin-bottom_10 cus_topic_detail_head1"><?=$reply->topic?></div> 
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <span class="custom_topic_detail_content1"><?=$reply->question?></span>
            <p>Status : <?php if($reply->admin_status==1){echo "Active";}else{echo "In-active";} ?></p>
        </div>  
        <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12 line4 margin-bottom_10">&nbsp;</div>
        </div>    
    </div>
    <?php } } ?>
                
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


<!-- Modal -->
<div id="featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active Reply</h4>
      </div>
      <div class="modal-body">
          <h4 id="featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2featured">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active Reply</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Modal -->
<div id="un_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">In-Active Reply</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2un_featured">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_un_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">In-Active Reply</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_un_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="delete_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Reply</h4>
      </div>
      <div class="modal-body">
          <h4 id="delete_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2delete">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_delete_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Reply</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_delete_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!--<script>
    $(document).ready(function(){
        $(".deletereply").click(function(){
            var id=$(this).prop('id');
            $("#deleteId").val(id);
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
	    var catid=$("#cat_id").val();
            $.post("<?=BASE_URL?>admin/forum/deletereply",{id:deleteId},function(data,status){
                obj=$.parseJSON(data);
                if(obj.status){
                   $("#e-result-delete").empty().append(obj.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                               window.location.href="<?=BASE_URL?>admin/forum/replylist/"+catid;
                            }, 1000); 
                }else
                    {
                        $("#e-result-delete").empty().append(obj.message).addClass("alert alert-error fade in");
                    }
            });
        });
    });
</script>-->

<script> 
    
    $(document).ready(function(){
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        
        $(".featured").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_featured_user_deletemsg").html("Please select at least one reply.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to active selected reply(ies)?");
                 $("#featured_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2featured",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/forum/activereply",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#featured_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
        $(".un_featured").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one reply.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected reply(ies)?");
                 $("#un_featured_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2un_featured",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/forum/inactivereply",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#un_featured_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        $(".delete").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_delete_user_deletemsg").html("Please select at least one reply.");
                $("#un_che_delete_user_model").modal("show");
            }else{
                 $("#delete_user_deletemsg").html("Do you want to delete selected reply(ies)?");
                 $("#delete_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2delete",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/forum/deletereply",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#delete_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
    });
</script>

