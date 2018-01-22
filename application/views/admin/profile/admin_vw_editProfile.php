<section class="content-header">
    <h1>
     Profile
     <small>edit</small>
    </h1>
    
</section>
<?php 
$profiledata =$profiledata['rows'];
?>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                
            </div>    
            <div class="box-body">
            <!--View Profile Div-->
            <div class="col-sm-10 col-xs-12 col-sm-offset-2">
                <form class="form-horizontal" role="form" method="POST" action="<?=BASE_URL?>admin/profile/editProfile" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">User Name</label></div>
                        <div class="col-sm-9">          
                            <input type="text" class="form-control" id="user" value="<?=$profiledata->username;?>" name="user" placeholder="User Name">
                            <?php if(form_error('user')!='') echo form_error('user','<div class="text-danger err">','</div>'); ?>
                        </div>
                        <span class="text-danger" id="user_error"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">First Name</label></div>
                        <div class="col-sm-9">          
                            <input type="text" class="form-control" id="firstname" value="<?=$profiledata->first_name;?>" name="firstname" placeholder="First Name">
                            <?php if(form_error('firstname')!='') echo form_error('firstname','<div class="text-danger err">','</div>'); ?>
                        </div>
                        <span class="text-danger" id="firstname_error"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Last Name</label></div>
                        <div class="col-sm-9">          
                            <input type="text" class="form-control" id="lastname" value="<?=$profiledata->last_name;?>" name="lastname" placeholder="Last Name">
                            <?php if(form_error('lastname')!='') echo form_error('lastname','<div class="text-danger err">','</div>'); ?>
                        </div>
                        <span class="text-danger" id="lastname_error"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Email</label></div>
                        <div class="col-sm-9">          
                            <input type="text" class="form-control" id="email" value="<?=$profiledata->email_id;?>" name="email" placeholder="Email">
                            <?php if(form_error('email')!='') echo form_error('email','<div class="text-danger err">','</div>'); ?>
                            <span class="text-danger" id="email_error1"></span>
                        </div>
                        <span class="text-danger" id="email_error"></span>
                    </div>
                    
                    <!--Image Field Start-->
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
                            <span class="text-danger" id="image1_error">(Max File Size 4MB Allowed)</span>
                        </div>
                        <div class="col-sm-2">
                            <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$profiledata->admin_image;?>" height="50" width="50" class="img img-responsive">
                        </div>  
                      <span class="text-danger" id="image_error"></span>
                    </div>
                    
                    <div class="pull-right">
                    <button id="editprofile" class="btn btn-primary pull-right" type="submit">Submit</button>
                    </div>
                    <!-- // Image Field-->
                </form>
            </div>
            </div>
            <!-- /.box-body -->
            
            
            <div class="box-footer clearfix">
              
            </div>
            
          </div>
          <!-- /.box -->

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
        $("#editprofile").click(function(){
            
            var user= $('#user').val().trim();
            var firstname= $('#firstname').val().trim();
            var lastname= $('#lastname').val().trim();
            var email= $('#email').val().trim();
            var image= $('#image').val().trim();
            //alert(image); exit;
            var ext = image.split('.').pop().toLowerCase();
              var allowed_ext=['jpg','png','jpeg'];
              var check = jQuery.inArray(ext, allowed_ext) !== -1;
            if(user == ""){
                $('#user').focus();
                $('#user_error').parent().addClass('has-error');
                return false;
            }
            if(firstname == ""){
                $('#firstname').focus();
                $('#firstname_error').parent().addClass('has-error');
                return false;
            }
            if(lastname == ""){
                $('#lastname').focus();
                $('#lastname_error').parent().addClass('has-error');
                return false;
            }
            
            if(email == ""){
                $('#email').focus();
                $('#email_error').parent().addClass('has-error');
                return false;
            }else{
                if(!validateEmail(email)){
                    $("#email").focus();
                    $("#email_error1").html("Enter valid email.");
                    $("#email_error").parent().addClass("has-error");
                    return false;
                }
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
                    
                    if(file_size>4096000) {
                        $("#image1_error").html("File size is greater than 4MB");
                        $("#image_error").parent().addClass("has-error");
                        return false;
                    }
                }
              return true;
        });
        
    });
    
    
    function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }
</script>