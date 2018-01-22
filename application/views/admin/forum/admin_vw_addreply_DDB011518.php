<section class="content-header">
    <h1>
     Manage Forum
     <small>add reply</small>
    </h1>
<!--    <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
    </ol>-->
</section>
<?php $forums=$forum['rows'];?>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
            <div class="pull-right">
                <a href="<?=BASE_URL?>admin/forum/replylist/<?=$forums->ForumId?>" class="btn btn-warning btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Back </a>
            </div>
            </div>
            
            <div class="box-body">
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/forum/addreply/<?=$forums->ForumId?>">
                  <input type="hidden" value="<?=$forums->ForumId?>" name="forumid" id="forumid">        
                        
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Category Name</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="topic" value="Re:<?=$forums->topic?>" name="topic" placeholder="">
                      <?php if(form_error('topic')!='') echo form_error('topic','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="topic_error"></span>

                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Category Name</label></div>
                  <div class="col-sm-9">          
                      <textarea class="form-control" id="question" name="question" placeholder="Your Reply"></textarea>
                      <?php if(form_error('question')!='') echo form_error('question','<div class="text-danger err">','</div>'); ?>
                      <span class="text-danger" id="question1_error"></span>
                  </div>
                  <span class="text-danger" id="question_error"></span>

                </div>
                
                        
                            
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="add_category" class="btn btn-primary pull-right">Submit</button>
                  </div>
                </div>
                        
                        
                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [],
    toolbar: "undo redo  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
});
</script>
<script>
    $(document).ready(function(){
        $("#add_category").click(function(){
            var topic = $("#topic").val().trim();
            var question= tinyMCE.activeEditor.getContent();
            
            if(topic == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#topic").focus();
                    $("#topic_error").parent().addClass("has-error");
                    return false;    
            }
            
            if(question == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#question").focus();
                    $("#question1_error").text("This is required field.");
                    $("#question_error").parent().addClass("has-error");
                    return false;    
            }
              
              return true;
        });
    });
</script>