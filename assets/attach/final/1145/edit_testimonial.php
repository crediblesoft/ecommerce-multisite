<style>
    .img-upload-msg{color:red; margin-bottom:10px;}
    .league-feedback{color: red; font-size: 15px;}
    
</style>
<script type="text/javascript" src="<?=SITE_MEDIA?>tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=SITE_MEDIA?>tinymce/plugins/jbimages/plugin.min.js"></script>
<script type="text/javascript">
 
tinymce.init({
selector: "#event_html",
// ===========================================
// INCLUDE THE PLUGIN
// ===========================================
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste jbimages"
],
// ===========================================
// PUT PLUGIN'S BUTTON on the toolbar
// ===========================================
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | jbimages",
// ===========================================
// SET RELATIVE_URLS to FALSE (This is required for images to display properly)
// ===========================================
relative_urls: false
});
 
</script>
<!--    <script type="text/javascript">
        tinymce.init({
            selector: "#description",
            images_upload_credentials: true
           
        });
    </script> -->


<!--//--Facebook Editor JS-->
<!-- Left side column. contains the logo and sidebar -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add 
            <small>Add details of New League Feedback.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">  
            <div class="col-lg-12">
                <form action="<?=ADMINBASE?>manage_testimonials/edit/<?=$testimonial_list[0]->id?>" method="post" enctype="multipart/form-data">
                   
                   
                   
                             
                        </div>
                       
                    </div>
                     <div class="col-lg-12 padding-lftrght0">
                        <div class="col-lg-12 padding-lftrght0">
                            <div class="form-group">
                                    <label>Client Nmae</label>
                                    <input type="text" name="name" id="event_title" data-validate="required" value="<?=$testimonial_list[0]->client_name?>" class="form-control">
                                    <div class="text-errror err"></div>
                                    <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                            </div>
                             
                        </div>
                       
                    </div> 
                    <div class="col-lg-12 padding-lftrght0">
                        <div class="col-lg-12 padding-lftrght0">
                            <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" id="event_title" data-validate="required" value="<?=$testimonial_list[0]->designation?>" class="form-control">
                                    <div class="text-errror err"></div>
                                   <?php if(form_error('designation')!='') echo form_error('designation','<div class="text-danger err">','</div>'); ?>
                            </div>
                             
                        </div>
                       
                    </div> 
                     <div class="col-lg-12 padding-lftrght0">
                        <div class="col-lg-12 padding-lftrght0">
                            <div class="form-group">
                                    <label>Experiance</label>
                                    <input type="text" name="experince" id="event_title" data-validate="required" value="<?=$testimonial_list[0]->experince?>" class="form-control">
                                    <div class="text-errror err"></div>
                                   <?php if(form_error('experince')!='') echo form_error('experince','<div class="text-danger err">','</div>'); ?>
                            </div>
                             
                        </div>
                       
                    </div> 
                    <div class="col-lg-12 padding-lftrght0">
                        <div class="col-lg-12 padding-lftrght0">
                            <div class="form-group">
                                    <label>Client Image</label> &nbsp;
                                    <img src="<?=SITE_MEDIA?>/image/thumb/<?=$testimonial_list[0]->client_image?>" alt="image" height="40px" width="30px">
                                    <input type="file" name="file" id="event_title"  class="">
                                    <div class="text-errror err"></div>
                                   <?php if(form_error('file')!='') echo form_error('file','<div class="text-danger err">','</div>'); ?>
                            </div>
                             
                        </div>
                       
                    </div> 
                    
                    <div class="col-lg-12 padding-lftrght0">
                        <div class="col-lg-12 padding-lftrght0">
                            <div class="form-group">
                                    <label>Comment</label>
                                    <textarea type="text" name="comment" id="event_html"  value="" class="form-control" data-validate="required"><?=$testimonial_list[0]->comment?></textarea>
                                    <div class="text-errror err"></div>
                                    <?php if(form_error('comment')!='') echo form_error('comment','<div class="text-danger err">','</div>'); ?>
                                    
                            </div>
                             
                        </div>
                       
                    </div> 
                <div class="col-lg-12 padding-lftrght0">
                        <div class="col-lg-12 padding-lftrght0">
                            <div class="form-group">
                                    <label>Make it live</label></br>
                                    <div style="padding-left: 0;" class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                  
                    
                        <label class="radio-inline"><input type="radio" value="1" name="testimonial_status" style="top:-2px;"  id="option1" class="ui-wizard-content"  <?php echo ($testimonial_list[0]->status==1)?'checked':'' ?> ><span>Active</span></label>
                    
                    
                        <label class="radio-inline"><input type="radio" value="2" name="testimonial_status" style="top:-2px;"  id="option1" class="ui-wizard-content"  <?php echo ($testimonial_list[0]->status==2)?'checked':'' ?> ><span>In-Active</span></label>
                        </div>
                                <?php if(form_error('testimonial_status')!='') echo form_error('testimonial_status','<div class="text-danger err">','</div>'); ?>    
                            </div>
                             
                        </div>
                       
                    </div> 
                
                    
                    
                    
                    <input type="submit" value="Add" class="btn btn-primary" >
            </form>
            </div>
            </div>      
          <!-- Your Page Content Here -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

      <!-- Main Footer -->
     
<!--    </div> ./wrapper -->