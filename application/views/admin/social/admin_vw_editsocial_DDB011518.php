<?php $category=$category['rows'][0];?>
<section class="content-header">
    <h1>
     Manage Social
     <small>edit</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <div class="pull-right">
                <a href="<?=BASE_URL?>admin/social" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> View Social</a>
                <a href="<?=BASE_URL?>admin/social/add" class="btn btn-warning btn-sm" id=""><span class="glyphicon glyphicon-plus-sign"></span> Add Social</a>
                </div>
            </div>
            <div class="box-body">
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/social/update">       
                  <input type="hidden" name="id" value="<?=$category->id?>">
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Title</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="title" value="<?=$category->title?>" name="title" placeholder="Title">
                      <?php if(form_error('title')!='') echo form_error('title','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="title_error"></span>

                </div>
                  
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Link</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="url" value="<?=$category->url?>" name="url" placeholder="http://www.example.com/">
                      <?php if(form_error('url')!='') echo form_error('url','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="url_error"></span>
                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label " for="image">Image</label></div>
                  <div class="col-sm-7">          
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    Browse… <input name="file" id="file" type="file">
                                </span>
                            </span>
                              <input class="form-control" id="image" readonly="" type="text">

                        </div>
                      <span class="text-danger" id="image1_error">(Max File Size 1MB Allowed)</span>
                  </div>
                    <div class="col-sm-2">
                        <img src="<?=BASE_URL?>assets/image/social/<?=$category->image?>" height="50" width="50" class="img img-responsive">
                    </div>  
                  <span class="text-danger" id="image_error"></span>
                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                  <div class="col-sm-9">
                      <select class="form-control" id="status" name="status">
                            <option value="1" <?php echo set_select('status', "1"); ?> <?php if($category->status=='1'){echo "selected";} ?> >Active</option>
                            <option value="0" <?php echo set_select('status', '0'); ?> <?php if($category->status=='0'){echo "selected";} ?> >Inactive</option>
                    </select>
                      <?php if(form_error('category')!='') echo form_error('category','<div class="text-danger err">','</div>'); ?>
                  </div>


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

<script>
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
      });

      $(document).ready( function() {
          $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });
      
    $(document).ready(function(){
        $("#add_category").click(function(){
            var title = $("#title").val().trim();
            var url = $("#url").val().trim();
            var image =$("#image").val().trim(); 
              var ext = image.split('.').pop().toLowerCase();
              var allowed_ext=['jpg','png','jpeg'];
              //alert(jQuery.inArray(ext, allowed_ext) == -1);
              var check = jQuery.inArray(ext, allowed_ext) !== -1;
              
            if(title == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#title").focus();
                    $("#title_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(url == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#url").focus();
                    $("#url_error").parent().addClass("has-error");
                    return false;    
              }
              
            if(image!=''){
                if(!check){     
                    $("#image1_error").html("Only jpg|png|jpeg Allowed");
                      $("#image_error").parent().addClass("has-error");
                      return false;
                }
                  var file_size = $('#file')[0].files[0].size;
                  if(file_size<=0){
                      $("#image1_error").html("This file is corrupted. So you can not upload this file.");
                      $("#image_error").parent().addClass("has-error");
                      return false;
                  }

                  if(file_size>1024000) {
                      $("#image1_error").html("File size is greater than 1MB");
                      $("#image_error").parent().addClass("has-error");
                      return false;
                  }
              }
              
              return true;
        });
    });
</script>

