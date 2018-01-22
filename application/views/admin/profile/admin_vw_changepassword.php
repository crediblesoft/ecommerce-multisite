<section class="content-header">
    <h1>
     Change Password
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
            <div class="box-body">
            <!--Change Password Form-->
            <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/profile/changepassword">
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="oldpassword">Old Password</label></div>
                    <div class="col-sm-9">          
                        <input type="password" class="form-control" id="oldpassword" value="<?=set_value('oldpassword')?>" name="oldpassword" placeholder="Old Password">
                        <?php if(form_error('oldpassword')!='') echo form_error('oldpassword','<div class="text-danger err">','</div>'); ?>
                    </div>
                    <span class="text-danger" id="oldpassword_error"></span>
                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="newpassword">New Password</label></div>
                    <div class="col-sm-9">          
                      <input type="password" class="form-control" id="newpassword" value="<?=set_value('newpassword')?>" name="newpassword" placeholder="New Password">
                      <?php if(form_error('newpassword')!='') echo form_error('newpassword','<div class="text-danger err">','</div>'); ?>
                    <span class="text-danger" id="newpassword1_error"></span>
                    </div>
                    <span class="text-danger" id="newpassword_error"></span>
                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="confirmpassword">Confirm Password</label></div>
                    <div class="col-sm-9">          
                        <input type="password" class="form-control" id="confirmpassword" value="<?=set_value('confirmpassword')?>" name="confirmpassword" placeholder="Confirm Password">
                      <?php if(form_error('confirmpassword')!='') echo form_error('confirmpassword','<div class="text-danger err">','</div>'); ?>
                    </div>
                    <span class="text-danger" id="confirmpassword_error"></span>
                </div>
                  
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="change-password" class="btn btn-primary pull-right" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Change Password_modifiable')!='1'){echo 'disabled';}?>>Submit</button>
                  </div>
                </div>
            </form><!--//Change Password Form-->
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
    $(document).ready(function(){
        $("#change-password").click(function(){
            var oldPass= $('#oldpassword').val().trim();
            var newPass= $('#newpassword').val().trim();
            var confirmPass= $('#confirmpassword').val().trim();
            
            if(oldPass == ""){
                $('#oldpassword').focus();
                $('#oldpassword_error').parent().addClass('has-error');
                return false;
            }
            
            if(newPass == ""){
                $('#newpassword').focus();
                $('#newpassword_error').parent().addClass('has-error');
                return false;
            }
            
            if(confirmPass == ""){
                $('#confirmpassword').focus();
                $('#confirmpassword_error').parent().addClass('has-error');
                return false;
            }
            
            if(newPass !=confirmPass){
                 $('#newpassword').focus();
                 $('#newpassword_error').parent().addClass('has-error');
                 $('#confirmpassword_error').parent().addClass('has-error');
                 $('#newpassword1_error').html('New password and confirm password should be same.');
                return false;
            }
              return true;
        });
    });
</script>
