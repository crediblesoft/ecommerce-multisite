<section class="content-header">
    <h1>
     Profile
     <small>view</small>
    </h1>
    
</section>
<?php 
//print_r($profiledata);
//echo $kdkd=$profiledata['rows'][0]->email_id;
?>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <div class="pull-right">
                  <a href="<?=BASE_URL?>admin/profile/editProfile" class="btn btn-primary btn-sm delete" id="">Edit Profile</a>
                </div>
            </div>    
            <div class="box-body table-responsive">
            <!--View Profile Div-->
            <div class="col-sm-10 col-xs-12 col-sm-offset-2">
                <div class="table-responsive">
                    <table class="table  tbl-boder-none">
                        <tr>
                            <td>User Name</td>
                            <td>:</td>
                            <td><?=$profiledata['rows']->username;?></td>
                        </tr>
                        
                        <tr>
                            <td>First Name</td>
                            <td>:</td>
                            <td><?=$profiledata['rows']->first_name;?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td>:</td>
                            <td><?=$profiledata['rows']->last_name;?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?=$profiledata['rows']->email_id;?></td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>:</td>
                            <td><img src="<?=BASE_URL?>assets/image/user/thumb/<?=$profiledata['rows']->admin_image;?>" alt="admin image"></td>
                        </tr>
                    </table>
                </div>
            </div>
            </div>
            <!-- /.box-body -->
            
            
            <div class="box-footer clearfix">
              <div class="pull-right">
                  <a href="<?=BASE_URL?>admin/profile/editProfile" class="btn btn-primary btn-sm delete" id="">Edit Profile</a>
                </div>
            </div>
            
          </div>
          <!-- /.box -->

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
              return true;
        });
        
        
        $(".edit_profile_pic").click(function(){
            $("#profile_pic").click();
        });
        
        $("#profile_pic").change(function(){
            $("#profile_pic_form").submit();
        });
    });
</script>