<div class="col-sm-9">
    <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  Manage Forum </h4> <h5> > Reply </h5>
                         
                    </div>
                </div>
            </div>
    <div class="contant-body1">
<div class="">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        
            <form action="<?=BASE_URL?>forum/reply/<?=$forum['rows']->ForumId?>" name="form" method="post"  class="form-horizontal" role="form" enctype = 'multipart/form-data'>
            <div class="form-group">
               
              <div class="col-sm-12">          
                  <input type="text" class="form-control" id="topic" value="<?php if(set_value('topic')!=''){ echo set_value('topic');}else{ ?>Re:<?=$forum['rows']->topic?><?php } ?>" name="topic" placeholder="Topic">
                  <?php if(form_error('topic')!='') echo form_error('topic','<div class="text-danger err">','</div>'); ?>
                  <span class="text-danger" id="topic1_error"></span>
              </div>
              <span class="text-danger" id="topic_error"></span>

            </div>    
                
            <div class="form-group">
              <div class="col-sm-12">          
                  <textarea class="form-control textarea" id="question" name="question" placeholder="Your Question"><?=set_value('question');?></textarea>
                  <?php if(form_error('question')!='') echo form_error('question','<div class="text-danger err">','</div>'); ?>
                  <span class="text-danger" id="question1_error"></span>
              </div>
              <span class="text-danger" id="question_error"></span>

            </div> 
                
                <div class="form-group">        
                    <div class="col-sm-offset-10 col-sm-2">
                        <button type="submit" id="addnewtopic" class="btn btn-success btn-block">Submit</button>
                    </div>
                  </div>
        </form>
        
        
    </div>   
</div>   
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
        $("#addnewtopic").click(function(){
            var topic = $("#topic").val().trim();
            var question= tinyMCE.activeEditor.getContent();
            
            if(topic==''){
                $("#topic").focus();
                $("#topic1_error").text("The Topic field is required.");
                $("#topic_error").parent().addClass("has-error");
                return false;  
            }
            
            if(question==''){  
                $("#question").focus();
                $("#question1_error").text("The Question field is required.");
                $("#question_error").parent().addClass("has-error");
                return false; 
            }
           
            return true;
        });
    });
</script>