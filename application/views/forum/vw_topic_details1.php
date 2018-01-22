<div class="row">
 <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
     <div class="col-sm-12">

         <div class="contant-head1_forum gredient_forum">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 clearfix">
        <!--<h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  <a href="<?=BASE_URL?>forum"> Manage Forum </a> </h4> <h5> > Topic Details </h5>-->
            <div class="row col-md-5">
                <p class="first"> <a href="<?=BASE_URL?>forum"> Manage Forum </a> </p> 
                <p class="second hidden-xs">  Topic Details </p>
           </div>
        <span class="add-button">
        
        </span>
    </div>
    </div>
         
    <div class="contant-body1">
<div class="row">
    
    <?php //print_R($forumlist); 
                      if($forumlist['res']){
                          $forum=$forumlist['rows'][0];
                      ?>
    <input type="hidden" name="cat_id" id="cat_id" value="<?=$forum->cat_id?>">
    <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_topic_main margin-bottom_20">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_topic_detail_outerhead">
            <span class="cus_topic_detail_head"><?=$forum->topic?></span>
            <span class="pull-right">
        <?php
                if($forum->UserId==$this->session->userdata("user_id")){
          ?>
          <a href="javascript:void(0);" class="edit" id="<?=$forum->ForumId?>" data-target="#editforum" data-toggle="modal"><span class="glyphicon glyphicon-pencil squre_pencil"></span></a> 
          <?php if($forum->Noofreply==0){ ?> 
          <a href="#deletetopic" class="delete" id="<?=$forum->ForumId?>" data-traget="#deletetopic" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>
        <?php 
                } }
        ?>
            </span>
        </div> 

        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <span class="custom_topic_detail_content"><?=$forum->question?></span>
        </div>
        <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12 line4 margin-bottom_10">&nbsp;</div> 
        
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_topic_detail_footer">
            <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6">
                <div class="col-sm-2 col-lg-2 col-md-2 col-xs-6">
                    <a href="<?=BASE_URL?>forum/like/<?=$forum->ForumId?>/detail" class="<?php if($forum->liked!=''){ ?>liked <?php }else{ ?>like<?php } ?>" id="<?=$forum->ForumId?>"><span class="glyphicon glyphicon-thumbs-up"  ></span> </a>&nbsp;<?=$forum->like?>
                </div>
                <div class="col-sm-2 col-lg-2 col-md-2 col-xs-6">
                    <a href="<?=BASE_URL?>forum/detail/<?=$forum->ForumId?>" class="<?php if($forum->view>0){ ?>liked <?php }else{ ?>like<?php } ?>" id="<?=$forum->ForumId?>"><span class="glyphicon glyphicon-eye-open"  ></span> </a>&nbsp;<?=$forum->view?>
                    
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 col-md-6 col-xs-6 cus_topic_detail_footer_inner">
                <div class="pull-right ">
                <span>By</span> &nbsp;
                <span><a href="<?=BASE_URL?>forum/user/<?=$forum->UserId?>" style="font-weight:bold;" ><?=ucfirst($forum->f_name)?> <?=$forum->l_name?></a></span> &nbsp;
                <span><?php echo date("d-M-Y", $forum->timestamp); ?></span> &nbsp;
                <span><?php echo date("h:i a", $forum->timestamp); ?></span> &nbsp;
                </div>
            </div>
        </div>
        </div>    
    </div>
    
    
    <?php 
                    if($replylist['res']){
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
                <span><a href="javascript:void(0);" style="font-weight:bold;" >Admin</a></span> &nbsp;
                <?php }else{ ?>
                <span><a href="<?=BASE_URL?>forum/user/<?=$reply->UserId?>" style="font-weight:bold;" ><?=ucfirst($reply->f_name)?> <?=$reply->l_name?></a></span> &nbsp;
                <?php } ?>
                <span><?php echo date("d-M-Y", $reply->timestamp); ?></span> &nbsp;
                <span><?php echo date("h:i a", $reply->timestamp); ?></span> &nbsp;<br/>
                <div class="row col-sm-4 col-md-4 col-lg-4 col-xs-4 line1"></div>
                </div>
            </div>
            <div class="col-sm-2 col-lg-2 col-md-2 col-xs-2">
                <span class="pull-right">
                <?php
                    if($this->session->has_userdata("user_id") && $reply->UserId==$this->session->userdata("user_id")){
              ?>
              <a href="javascript:void(0);" class="editreply" id="<?=$reply->ReplyId?>" data-target="#editforum" data-toggle="modal"><span class="glyphicon glyphicon-pencil squre_pencil"></span></a> 
              <?php if($forum->Noofreply==0){ ?> 
              <a href="javascript:void(0);" class="deletereply" data-traget="#deletereply" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>
            <?php 
                    } }
            ?>
                </span>
            </div>
        </div> 
            <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 margin-bottom_10 cus_topic_detail_head1"><?=$reply->topic?></div> 
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <span class="custom_topic_detail_content1"><?=$reply->question?></span>
        </div>  
        <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12 line4 margin-bottom_10">&nbsp;</div>
        </div>    
    </div>
    
                      <?php } } } ?>
    <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
   <a href="<?=BASE_URL?>forum/reply/<?=$forum->ForumId?>" class="btn btn-success">Post Reply</a>
            <ul class="pagination pagination-sm no-margin pull-right"><?=$links?></ul> 
    </div>
        <!-- <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
            <?php //print_R($forumlist); 
                      if($forumlist['res']){
                          $forum=$forumlist['rows'][0];
                      ?>
            
               
            
            
         <div class="panel panel-default">
             <div class="cusfor-panel-heading">
                <?=$forum->topic?> 
             </div>
            <div class="panel-body cusfor-panel-body">
                  
               <div class="row custom-forum-view">
                          <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                              <div class="topic"><h4><a href="<?=BASE_URL?>forum/detail/<?=$forum->ForumId?>"><?=$forum->topic?></a></h4></div>
                              <div class="row col-sm-4">
                                  <div class="col-sm-6">
                                  <a href="javascript:void(0);" class="<?php if($forum->liked!=''){ ?>liked <?php }else{ ?>like<?php } ?>" id="<?=$forum->ForumId?>"><span class="glyphicon glyphicon-thumbs-up"  ></span> </a><br><?=$forum->like?>
                                  </div>
                                    <div class="col-sm-6">
                                      <span class="glyphicon glyphicon-eye-open"></span></br><?=$forum->view?>
                                    </div> 
                              </div>
                          </div>
                          <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                              <div class="question"><?=$forum->question?></div>
                              
                              <div class="pull-right"> 
                                  <div class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By <a href="<?=BASE_URL?>forum/user/<?=$forum->UserId?>"><?=ucfirst($forum->f_name)?> <?=$forum->l_name?></a></div>
                                  <div class="">
                                      <?php
                                            if($forum->UserId==$this->session->userdata("user_id")){
                                      ?>
                                      <a href="javascript:void(0);" class="edit" id="<?=$forum->ForumId?>" data-target="#editforum" data-toggle="modal"><span class="glyphicon glyphicon-pencil squre_pencil"></span></a> 
                                      <?php if($forum->Noofreply==0){ ?> 
                                      <a href="#deletetopic" class="delete" id="<?=$forum->ForumId?>" data-traget="#deletetopic" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>
                                    <?php 
                                            } }
                                    ?>
                                    <span><?php echo date("l M d,Y h:i a", $forum->timestamp); ?></span>
                                  </div>
                              </div>
                          </div>
                      
                </div>
                
                
                <?php 
                    if($replylist['res']){
                        foreach($replylist["rows"] as $reply){
                ?>
                
                <div class="row custom-forum-view">
                          <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                              <div class="topic"><h4><?=$reply->topic?></h4></div>
                          </div>
                          <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                              <div class="question"><?=$reply->question?></div>
                              
                              <div class="pull-right"> 
                                  <div class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By <a href="<?=BASE_URL?>forum/user/<?=$forum->UserId?>"><?=ucfirst($forum->f_name)?> <?=$forum->l_name?></a></div>
                                  <div class="">
                                      <?php
                                            if($reply->UserId==$this->session->userdata("user_id")){
                                      ?>
                                      <a href="javascript:void(0);" class="editreply" id="<?=$reply->ReplyId?>" data-target="#editforum" data-toggle="modal"><span class="glyphicon glyphicon-pencil squre_pencil"></span></a> 
                                      <?php if($forum->Noofreply==0){ ?> 
                                      <a href="javascript:void(0);" class="deletereply" data-traget="#deletereply" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>
                                    <?php 
                                            } }
                                    ?>
                                    <span><?php echo date("l M d,Y h:i a", $reply->timestamp); ?></span>
                                  </div>
                              </div>
                          </div>
                      
                </div>

                <?php } } ?>
                     
                </div>
          </div>
            <a href="<?=BASE_URL?>forum/reply/<?=$forum->ForumId?>" class="btn btn-success">Post Reply</a>
            <ul class="pagination pagination-sm no-margin pull-right"><?=$links?></ul>
             <?php }  ?>
               
       
    </div>-->   
</div>   
    </div>        
    </div>
        
        
    </div>
</div>


<!-- Modal -->
<div id="editforum" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Forum</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-update"></div></div>
          
          <form name="form" class="form-horizontal" role="form">
              <input type="hidden" id="forumid" value="">
            <div class="form-group">
               
              <div class="col-sm-12">          
                  <input type="text" class="form-control" id="topic" value="<?=set_value('topic')?>" name="topic" placeholder="Topic">
                  <?php if(form_error('topic')!='') echo form_error('topic','<div class="text-danger err">','</div>'); ?>
                  <span class="text-danger" id="topic1_error"></span>
              </div>
              <span class="text-danger" id="topic_error"></span>

            </div>    
                
            <div class="form-group">
              <div class="col-sm-12">          
                  <textarea class="form-control textarea" id="question" name="question" placeholder="Your Question"></textarea>
                  <?php if(form_error('question')!='') echo form_error('question','<div class="text-danger err">','</div>'); ?>
                  <span class="text-danger" id="question1_error"></span>
              </div>
              <span class="text-danger" id="question_error"></span>

            </div> 
                
                
        </form>
          
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success update" id="update" >Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal -->
<div id="deletetopic" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Forum Topic</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete this topic?</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [],
    toolbar: "undo redo  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
});
</script>

<script>
    $(document).ready(function(){
        /*$(".like").click(function(){
            var id=$(this).attr("id");
            $.get("<?=BASE_URL?>forum/like/"+id,function(data,status){
                if(data){
                    console.log(data);
                    location.reload(); 
                }
            });
        });*/
        
        $(".edit").click(function(){
            var id=$(this).attr("id");
            $.post("<?=BASE_URL?>forum/edit",{forumid:id},function(data,status){
                console.log(data);
                var obj=$.parseJSON(data);
                if(obj.res){
                    $("#forumid").val(obj.rows.id);
                    $("#topic").val(obj.rows.topic);
                    tinyMCE.activeEditor.setContent(obj.rows.question);
                }
            });
        });
        
        $(document).on("click","#update",function(){
            var forumid=$("#forumid").val();
            var topic=$("#topic").val();
            var question=tinyMCE.activeEditor.getContent();
            var checkvalidation=true;
            
            if(topic==''){
                $("#topic").focus();
                $("#topic1_error").text("The Topic field is required.");
                $("#topic_error").parent().addClass("has-error");
                checkvalidation=false;
                return false;  
            }
            
            if(question==''){  
                $("#question").focus();
                $("#question1_error").text("The Question field is required.");
                $("#question_error").parent().addClass("has-error");
                checkvalidation=false;
                return false; 
            }
            
            if(checkvalidation){
            
            $.post("<?=BASE_URL?>forum/update",{id:forumid,topic:topic,question:question},function(data,status){
                console.log(data);
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
        
        
        $(".editreply").click(function(){
            var id=$(this).attr("id");
            $(".update").removeAttr("id");
            $(".update").attr("id","updatereply");
            $.post("<?=BASE_URL?>forum/replyedit",{forumid:id},function(data,status){
                console.log(data);
                var obj=$.parseJSON(data);
                if(obj.res){
                    $("#forumid").val(obj.rows.id);
                    $("#topic").val(obj.rows.topic);
                    tinyMCE.activeEditor.setContent(obj.rows.question);
                }
            });
        });
        
        $(document).on("click","#updatereply",function(){
            var forumid=$("#forumid").val();
            var topic=$("#topic").val();
            var question=tinyMCE.activeEditor.getContent();
            var checkvalidation=true;
            
            if(topic==''){
                $("#topic").focus();
                $("#topic1_error").text("The Topic field is required.");
                $("#topic_error").parent().addClass("has-error");
                checkvalidation=false;
                return false;  
            }
            
            if(question==''){  
                $("#question").focus();
                $("#question1_error").text("The Question field is required.");
                $("#question_error").parent().addClass("has-error");
                checkvalidation=false;
                return false; 
            }
            
            if(checkvalidation){
            
            $.post("<?=BASE_URL?>forum/updatereply",{id:forumid,topic:topic,question:question},function(data,status){
                console.log(data);
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
        
       $(".delete").click(function(){
            var id=$(this).prop('id');
            $("#deleteId").val(id);
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
	    var catid=$("#cat_id").val();
            $.post("<?=BASE_URL?>forum/delete",{id:deleteId},function(data,status){
                obj=$.parseJSON(data);
                if(obj.status){
                   $("#e-result-delete").empty().append(obj.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                               window.location.href="<?=BASE_URL?>forum/topic/"+catid;
                            }, 1000); 
                }else
                    {
                        $("#e-result-delete").empty().append(obj.message).addClass("alert alert-error fade in");
                    }
            });
        });
    });
</script>
