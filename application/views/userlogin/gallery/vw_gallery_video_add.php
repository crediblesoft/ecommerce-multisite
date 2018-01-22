<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Gallery >> Add Video</h4>
                         <span class="add-button">
                             <a href="<?=BASE_URL?>gallery/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Gallery</a>
                             <a href="<?=BASE_URL?>gallery/addvideos" class="btn btn-warning"> <span class="glyphicon glyphicon-plus-sign"></span> Add Videos</a>
                             <a href="<?=BASE_URL?>gallery/viewvideos" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open"></span> View Videos</a>
                         </span>
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-lg-9 col-xs-12 pull-right">
                        <ol>
                            <li>Use the <a href="https://www.youtube.com" target="_blank">youtube site </a> to find the video</li>
                            <li>Run any Video</li>
                            <li>Copy the url paste it into the below textbox</li>
                        </ol>
                    </div>
                </div>    
                <div class="col-sm-12">
                        
                       
                            <form class="form-horizontal" id="form_gallery" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>gallery/addvideos">
                                <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Add Video link</label></div>
                              <div class="col-md-9 col-sm-12 col-lg-9 col-xs-12">          
                                  <input type="text" class="form-control" id="video_link" value="<?=set_value('video_link')?>" name="video_link" placeholder="Please follow above instructions">
                                  <!--<textarea class="form-control" id="video_link" name="video_link" placeholder="Please follow above instructions"><?=set_value('video_link')?></textarea>-->
                                  <?php if(form_error('video_link')!='') echo form_error('video_link','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="video_link_error"></span>
                                  
                            </div>
                                
                                <div class="form-group">   
                                    <!--<div class="col-sm-offset-3 col-sm-3">
                                        <button type="submit" id="addmore" class="btn btn-warning btn-sm"> <span class="glyphicon glyphicon-plus-sign"></span> Add more</button>
                                    </div>-->
                                    <div class="col-sm-3 pull-right">
                                        <button type="submit" id="video" class="btn btn-success btn-block">Submit</button>
                                    </div>
                            </div>
                                
                                
                                
                            </form>                            
                        
                    
                </div>
            </div>
               
        </div>
        
        
    </div>
</div>


<script> 
    $(document).ready(function(){
        $("#video").click(function(){
            var video_link=$("#video_link").val().trim();
            if(video_link == ''){
                    //$("#fname_error").html("Enter Your First Name");
                    $("#video_link").focus();
                    $("#video_link_error").parent().addClass("has-error");
                    return false;    
              }
              
              return true;
        });
    });
</script>