<?php $settings=$settings['rows'][0];$userlimitations=$userlimitation['rows'][0]; $forpremimu=$forpremimu['rows'][0]; ?>
<section class="content-header">
    <h1>
     Manage Settings
     <small>edit</small>
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
<!--              <div class="pull-right">
                    <a href="<?=BASE_URL?>admin/settings/edit" class="btn btn-primary btn-sm" id=""> Update Settings</a>     
              </div>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/settings/update">       
                  <input type="hidden" name="id" value="<?=$settings->id?>">
                  <input type="hidden" name="userlimit_id" value="<?=$userlimitations->id?>">
                  <input type="hidden" name="premium_id" value="<?=$forpremimu->id?>">
                
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label " for="image">Image</label></div>
                  <div class="col-sm-8">          
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    Browse… <input name="file" id="file" type="file">
                                </span>
                            </span>
                              <input class="form-control" id="image" readonly="" type="text">

                        </div>
                      <span class="text-danger" id="image1_error">(Max File Size 4MB Allowed)</span>
                  </div>
                    <div class="col-sm-1">
                        <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$settings->default_image?>" height="50" width="50" class="img img-responsive">
                    </div>  
                  <span class="text-danger" id="image_error"></span>
                </div>
                 <?php $categories=$this->commondata['category'];?>  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Forum Post</label></div>
                    <div class="col-sm-9">
                        <select class="form-control" id="default_category" name="default_category">
                            <?php if($categories['res']){
                                  foreach($categories['rows'] as $category){
                              ?>
                              <option value="<?php echo $category->id; ?>" <?php echo set_select('default_category', $category->id); ?> <?php if($settings->default_category==$category->id){echo "selected";} ?> ><?=$category->category?></option>
                            <?php } } ?>
                        </select>

                    </div>
                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Forum Post</label></div>
                    <div class="col-sm-9">
                        <select class="form-control" id="forum_post" name="forum_post">
                              <option value="1" <?php echo set_select('forum_post', "1"); ?> <?php if($settings->forum_post=='1'){echo "selected";} ?> >Active</option>
                              <option value="0" <?php echo set_select('forum_post', '0'); ?> <?php if($settings->forum_post=='0'){echo "selected";} ?> >Inactive</option>
                        </select>

                    </div>
                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">User Status</label></div>
                    <div class="col-sm-9">
                        <select class="form-control" id="user_status" name="user_status">
                              <option value="1" <?php echo set_select('user_status', "1"); ?> <?php if($settings->user_status=='1'){echo "selected";} ?> >Active</option>
                              <option value="0" <?php echo set_select('user_status', '0'); ?> <?php if($settings->user_status=='0'){echo "selected";} ?> >Inactive</option>
                        </select>

                    </div>
                </div>
                     
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Product Status</label></div>
                    <div class="col-sm-9">
                        <select class="form-control" id="product_status" name="product_status">
                              <option value="1" <?php echo set_select('product_status', "1"); ?> <?php if($settings->product_status=='1'){echo "selected";} ?> >Active</option>
                              <option value="0" <?php echo set_select('product_status', '0'); ?> <?php if($settings->product_status=='0'){echo "selected";} ?> >Inactive</option>
                        </select>

                    </div>
                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Admin Commission</label></div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="admin_comm" value="<?=$settings->commission?>" name="admin_comm" placeholder="Admin Commission" onkeyup="checknumber(this.id,this.value)">
                            <span class="input-group-addon" id="basic-addon1">%</span>
                        </div>
                        <span class="text-danger" id="admin_comm_error_nume"></span>
                    </div>
                    <span class="text-danger" id="admin_comm_error"></span>
                    <?php if(form_error('admin_comm')!='') echo form_error('admin_comm','<div class="text-danger err">','</div>'); ?>
                </div>
                  
                <div class="form-group">
                     <div class="col-sm-12 text-center"><strong>Free User Limitations</strong></div>
                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Product Listing</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="product_list" value="<?=$userlimitations->product_list?>" name="product_list" placeholder="Product Listing">
                      <?php if(form_error('product_list')!='') echo form_error('product_list','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="product_list_error"></span>

                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Send Email</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="send_email" value="<?=$userlimitations->email?>" name="send_email" placeholder="Send Email">
                      <?php if(form_error('send_email')!='') echo form_error('send_email','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="send_email_error"></span>

                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Send Message</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="send_message" value="<?=$userlimitations->message?>" name="send_message" placeholder="Send Message">
                      <?php if(form_error('send_message')!='') echo form_error('send_message','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="send_message_error"></span>

                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Media/Video Upload</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="media" value="<?=$userlimitations->media?>" name="media" placeholder="Media/Video Upload">
                      <?php if(form_error('media')!='') echo form_error('media','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="media_error"></span>

                </div>
                
                <div class="form-group">
                     <div class="col-sm-12 text-center"><strong>For Premium User</strong></div>
                </div>  
                
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Paid Amount</label></div>
                  <div class="col-sm-9">  
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" class="form-control" id="price" value="<?=$forpremimu->price?>" name="price" placeholder="Paid Amount" onkeyup="checknumber(this.id,this.value)">
                     </div>
                      <?php if(form_error('price')!='') echo form_error('price','<div class="text-danger err">','</div>'); ?>
                      <span class="text-danger" id="price_error_nume"></span>
                  </div>
                  <span class="text-danger" id="price_error"></span>

                </div>
                  
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="add_category" class="btn btn-primary pull-right">Update</button>
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
            var product_list=$("#product_list").val().trim();
            var send_email=$("#send_email").val().trim();
            var send_message=$("#send_message").val().trim();
            var media=$("#media").val();
            var price=$("#price").val();
            var image =$("#image").val().trim(); 
            var ext = image.split('.').pop().toLowerCase();
            var allowed_ext=['jpg','png','jpeg'];
            //alert(jQuery.inArray(ext, allowed_ext) == -1);
            var check = jQuery.inArray(ext, allowed_ext) !== -1;
            
            
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

                  if(file_size>4096000) {
                      $("#image1_error").html("File size is greater than 4MB");
                      $("#image_error").parent().addClass("has-error");
                      return false;
                  }
              }
              
              if(product_list == ''){
                    $("#product_list").focus();
                    $("#product_list_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(send_email == ''){
                    $("#send_email").focus();
                    $("#send_email_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(send_message == ''){
                    $("#send_message").focus();
                    $("#send_message_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(media == ''){
                    $("#media").focus();
                    $("#media_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(price == ''){
                    $("#price").focus();
                    $("#price_error").parent().addClass("has-error");
                    return false;    
              }
              
              return true;
        });
    });
    
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_nume").html("Enter Only Numeric Value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            //return false;
        }else{
            if(value>100){ $("#"+id+"_error_nume").html("Not more then 100%");$("#"+id+"_error").parent().addClass("has-error");}
            else{$("#"+id+"_error_nume").html("");$("#"+id+"_error").parent().removeClass("has-error");}
            $("#"+id).focus();
        }}else{
            $("#"+id+"_error_nume").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
</script>