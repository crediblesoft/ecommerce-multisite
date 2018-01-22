<?php //print_r($userdata); ?>
<div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
            <div class="row">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Profile</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-sm-12">
                    <div class="contant-head2">
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="img-responsive profile_img"> 
                                   <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userdata->profile_Pic?>" class="img-responsive"> 
                            </div>
                            
                            <form id="profile_pic_form" method="post" enctype = 'multipart/form-data' style="display: none;" action="<?=BASE_URL?>profile/updateprofilepic">
                                <input type="file" id="profile_pic" name="file">
                            </form> 
                        </div>

                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="col-sm-12 col-md-12 col-lg-12 contant-profile-inner-head"><?=$this->session->userdata('user_name')?></div>
                           <!--<div class="col-sm-12 col-md-12 col-lg-12 contant-profile-inner-edit">
                                <p class="row col-md-5 col-lg-5 col-sm-5">Edit Profile Picture</p>
                                <p class="row col-md-3 col-lg-3 col-sm-3"><a href="javascript:void(0);" class="edit_profile_pic profile_pencil"><span class="glyphicon glyphicon-pencil"></span></a></p>
                            </div>-->
                            <!--<div class="col-sm-12 col-md-12 col-lg-12 contant-profile-inner-edit">
                                <p class="row col-md-5 col-lg-5 col-sm-5">Edit Business Information</p>
                                <p class="row col-md-3 col-lg-3 col-sm-3"><a href="<?=BASE_URL?>profile/edit/<?=$this->session->userdata("user_id")?>" class="edit_business_info profile_pencil" ><span class="glyphicon glyphicon-pencil"></span></a></p>
                            </div>  -->
                        </div>
                    </div>
                </div>
                
               
                <div class="col-sm-12">
                    <div class="contant-body1">
                        <div class="col-sm-10 col-xs-12 col-sm-offset-2">
                        <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>profile/changepassword">    
                            <div class="form-group">
                             <label class="control-label col-sm-3" for="name">Old Password</label>
                             <div class="col-sm-9">          
                                 <input type="password" class="form-control" id="ops" value="" name="ops" placeholder="Old Password">
                                 <?php if(form_error('ops')!='') echo form_error('ops','<div class="text-danger err">','</div>'); ?>
                             </div>
                             <span class="text-danger" id="ops_error"></span>

                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3" for="contact-person">New Password</label>
                                <div class="col-sm-9">          
                                    <input type="password" class="form-control" id="nps" value="" name="nps" placeholder="New Password">
                                    <?php if(form_error('nps')!='') echo form_error('nps','<div class="text-danger err">','</div>'); ?>
                                </div>
                                <span class="text-danger" id="nps_error"></span>

                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="contact-person">Confirm Password</label>
                                <div class="col-sm-9">          
                                    <input type="password" class="form-control" id="cps" value="" name="cps" placeholder="Confirm Password">
                                    <?php if(form_error('cps')!='') echo form_error('cps','<div class="text-danger err">','</div>'); ?>
                                </div>
                                <span class="text-danger" id="cps_error"></span>

                            </div>
                            
                            <div class="form-group">        
                                <div class="col-sm-offset-9 col-sm-3">
                                    <button type="submit" id="changeps1" class="btn btn-success btn-block">Change</button>
                                </div>
                            </div>
                            
                        </form>
                            
                        </div>
                    </div>
                </div>
               
                
            </div>
        </div>
        
        
    </div>
</div>    



<script>
    $(document).ready(function(){
        $("#changeps").click(function(){
            var ops = $("#ops").val().trim();
            var nps = $("#nps").val().trim();
            var cps = $("#cps").val().trim();
            
            if(ops == ''){
                  //$("#fname_error").html("Enter Your First Name");
                  $("#ops").focus();
                  $("#ops_error").parent().addClass("has-error");  
                   return false;    
            }

            if(nps == ''){
                  //$("#fname_error").html("Enter Your First Name");
                  $("#nps").focus();
                  $("#nps_error").parent().addClass("has-error");
                  return false;    
            }

            if(cps == ''){
                  //$("#fname_error").html("Enter Your First Name");
                  $("#cps").focus();
                  $("#cps_error").parent().addClass("has-error");
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
