<div class="row">
 <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
<div class="col-sm-12">
    
    
    <div class="contant-head1_forum gredient_forum">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 clearfix">
        <!--<h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  <a href="<?=BASE_URL?>forum"> Manage Forum </a> </h4> <h5> > User Topic List </h5>-->
            <div class="row col-md-5">
                <p class="first"> <a href="<?=BASE_URL?>forum"> Manage Forum </a> </p> 
                <p class="second hidden-xs">  User Topic List </p>
           </div> 
            <div class="row col-md-7 pull-right">
        <span class="add-button">
        <div class="input-group">
         <input type="text" autocomplete="off" class="form-control" name="forum_topic_search" placeholder="Search Topic" id="searchbytopic">
         <span class="input-group-addon searchicon"></span>
      </div>
        </span>
            </div>
    </div>
    </div>
    
    <div class="contant-body1">
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <table class="table table-bordered forum_cus_table">   
             <thead class="cusfor-panel-heading">
               <tr>
                  <th width="10%">Category</th>
                  <th width="25%">Topic</th>
                  <th width="5%">Like</th>
                  <th width="5%">View</th>
                  <th width="40%">Posted By</th>
                  <th width="5%">&nbsp</th>
               </tr>
            </thead>
            <tbody id="searcheddata">
                <?php //print_R($forumlist); 
                      if($forumlist['res']){
                          foreach($forumlist['rows'] as $forum){
                              
                      ?>
               <tr>
                  <td><a href="<?=BASE_URL?>forum/topic/<?=$forum->cat_id?>" class="forum_a"><?=$forum->category?></a></td> 
                  <td><a href="<?=BASE_URL?>forum/detail/<?=$forum->ForumId?>" class="forum_a"><?=$forum->topic?></a></td>
                  <td><a href="<?=BASE_URL?>forum/like/<?=$forum->ForumId?>/user/<?=$forum->UserId?>" class="<?php if($forum->liked!=''){ ?>liked <?php }else{ ?>like<?php } ?>" id="<?=$forum->ForumId?>"><span class="glyphicon glyphicon-thumbs-up"></span></a> &nbsp;<?=$forum->like?></td>
                  <td><a href="<?=BASE_URL?>forum/detail/<?=$forum->ForumId?>" class="<?php if($forum->view > 0){ ?>liked <?php }else{ ?>like<?php } ?>"><span class="glyphicon glyphicon-eye-open"></span></a> &nbsp; <?=$forum->view?></td>
                  <td>
                      <div class="row">
                          <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12"> 
                               <?=ucfirst($forum->f_name)?> <?=$forum->l_name?>
                          </div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-3"><?php echo date("d M Y", $forum->timestamp); ?></div>
                            <div class="col-sm-3"><?php echo date("h:i a", $forum->timestamp); ?></div>
                      </div>
                  </td>
                  <td>
                      <?php if($forum->UserId==$this->session->userdata("user_id")){ ?>
                              <a href="javascript:void(0);" title="Edit" class="edit" id="<?=$forum->ForumId?>" data-target="#editforum" data-toggle="modal"><span class="glyphicon glyphicon-pencil squre_pencil"></span></a> 
                                      <?php if($forum->Noofreply==0){ ?> 
                              <a href="#deletetopic" title="Delete" class="delete" id="<?=$forum->ForumId?>" data-traget="#deletetopic" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>
                                <?php  } } ?>
                  </td>
               </tr>
              <?php } }else{ ?>  <tr><td colspan="5"> <p class="text-danger">No Record Found</p> </td></tr> <?php } ?>
            </tbody>
         </table>
        
        
         <!--<div class="panel panel-default">
             <div class="panel-heading cusfor-panel-heading">Topic List</div>
            <div class="panel-body cusfor-panel-body">
                  <?php //print_R($forumlist); 
                      if($forumlist['res']){
                          foreach($forumlist['rows'] as $forum){
                              
                      ?>
                <div class="row custom-forum-view">
                      
                          
                          <div class="col-sm-5 col-lg-5 col-md-5 col-xs-12">
                              <div class="topic"><h5><a href="<?=BASE_URL?>forum/detail/<?=$forum->ForumId?>"><?=$forum->topic?></a></h5></div>
                          </div>
                          <div class="col-sm-1 col-lg-1 col-md-1 col-xs-6">
                              <div class="text-center" title="Likes"><a href="javascript:void(0);" class="<?php if($forum->liked!=''){ ?>liked <?php }else{ ?>like<?php } ?>" id="<?=$forum->ForumId?>"><span class="glyphicon glyphicon-thumbs-up"></span></a></div>
                              <div class="text-center"><?=$forum->like?></div>
                          </div>
                          <div class="col-sm-1 col-lg-1 col-md-1 col-xs-6">
                              <div class="text-center" title="Views"><a href="<?=BASE_URL?>forum/detail/<?=$forum->ForumId?>" class="view"><span class="glyphicon glyphicon-eye-open"></span></a></div>
                              <div class="text-center"><?=$forum->view?></div>
                          </div>
                          <div class="col-sm-1 col-md-1 col-lg-1 col-xs-12">
                                <?php if($forum->UserId==$this->session->userdata("user_id")){ ?>
                              <a href="javascript:void(0);" title="Edit" class="edit" id="<?=$forum->ForumId?>" data-target="#editforum" data-toggle="modal"><span class="glyphicon glyphicon-pencil squre_pencil"></span></a> 
                                      <?php if($forum->Noofreply==0){ ?> 
                              <a href="#deletetopic" title="Delete" class="delete" id="<?=$forum->ForumId?>" data-traget="#deletetopic" data-toggle="modal"><span class="glyphicon glyphicon-remove squre_remove"></span> </a>
                                <?php  } } ?>                              
                            </div>
                          <div class="col-sm-4 col-lg-4 col-md-4 col-xs-12">
                              <div class="">By <a href="<?=BASE_URL?>forum/user/<?=$forum->UserId?>"><?=ucfirst($forum->f_name)?> <?=$forum->l_name?></a></div>
                                    <span><?php echo date("l M d,Y h:i a", $forum->timestamp); ?></span>
                          </div>
                    
                            
                </div>

                      <?php } } ?>
                </div>
          </div>-->
            <ul class="pagination pagination-sm no-margin pull-right"><?=$links?></ul>
        
    </div>   
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
          <button type="button" class="btn btn-success" id="update" >Update</button>
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
        $(".like").click(function(){
            var id=$(this).attr("id");
            $.get("<?=BASE_URL?>forum/like/"+id,function(data,status){
                if(data){
                    console.log(data);
                    location.reload(); 
                }
            });
        });
        
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
        
        $("#update").click(function(){
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
        
        
        $(".delete").click(function(){
            var id=$(this).prop('id');
            $("#deleteId").val(id);
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>forum/delete",{id:deleteId},function(data,status){
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


