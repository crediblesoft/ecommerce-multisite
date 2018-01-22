<?php //print_r($userdata); ?>
<div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Profile</h4>
                    </div>
                </div>
            </div>
            <div class="">
                
                <div class="col-sm-12">
<!--                    <div class="contant-head2">
                        <div class="col-sm-2">
                            <div class="img-responsive profile_img">
                                <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userdata->profile_Pic?>" class="img-circle img-responsive">
                            </div>
                            
                            <div class="dropdown keep-open">
                                
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="dLabel" role="button" href="#"
                                   data-toggle="dropdown" data-target="#" 
                                   class="btn btn-success">
                                    <span class="glyphicon glyphicon-pencil"></span> <span class="caret"></span>
                                </button>

                                
                                <ul class="dropdown-menu" role="menu" 
                                    aria-labelledby="dLabel">
                                    <li><a href="javascript:void(0);" class="edit_profile_pic">Edit Profile Picture</a></li>
                                    <li><a href="<?=BASE_URL?>profile/edit/<?=$this->session->userdata("user_id")?>" class="edit_business_info" >Edit Profile</a></li>
                                </ul>
                            </div>
                            
                            <form id="profile_pic_form" method="post" enctype = 'multipart/form-data' style="display: none;" action="<?=BASE_URL?>profile/updateprofilepic">
                                <input type="file" id="profile_pic" name="file">
                            </form>
                        </div>
                        
                        

                        <div class="col-sm-10">
                            <div class="contant-inner-head"><h3><?=$this->session->userdata('user_name')?></h3></div>
                        </div>
                    </div>-->
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
                            <div class="col-sm-12 col-md-12 col-lg-12 contant-profile-inner-edit">
                                <p class="row col-md-5 col-lg-5 col-sm-5">Edit Profile Picture</p>
                                <p class="row col-md-3 col-lg-3 col-sm-3"><a href="javascript:void(0);" class="edit_profile_pic profile_pencil"><span class="glyphicon glyphicon-pencil"></span></a></p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 contant-profile-inner-edit">
                                <p class="row col-md-5 col-lg-5 col-sm-5">Edit Profile</p>
                                <p class="row col-md-3 col-lg-3 col-sm-3"><a href="<?=BASE_URL?>profile/edit/<?=$this->session->userdata("user_id")?>" class="edit_business_info profile_pencil" ><span class="glyphicon glyphicon-pencil"></span></a></p>
                            </div>  
                        </div>
                    </div>
                </div>
                
                <?php if($res){ ?>
                <div class="col-sm-12">
                    <div class="contant-body1">
                        <div class="col-sm-10 col-xs-12 col-sm-offset-2">
                            <div class="table-responsive">
                                <table class="table cus-table">
                                      <tr>
                                        <td class="profile_heading">Account Type</td>
                                        <td>:</td>
                                        <td>Buyer</td>
                                      </tr>
                                    
                                      <tr>
                                        <td class="profile_heading">Username</td>
                                        <td>:</td>
                                        <td><?=$userdata->username?></td>
                                      </tr>
                                      
                                      <tr>
                                        <td class="profile_heading">Name</td>
                                        <td>:</td>
                                        <td><?=$userdata->f_name?> <?=$userdata->l_name?></td>
                                      </tr>
                                      
                                      <tr>
                                        <td class="profile_heading">Phone</td>
                                        <td>:</td>
                                        <td><?=$userdata->mobile_no?></td>
                                      </tr>
                                      
                                      <tr>
                                        <td class="profile_heading">Email</td>
                                        <td>:</td>
                                        <td><?=$userdata->email_id?></td>
                                      </tr>

                                      <tr>
                                        <td class="profile_heading">Address</td>
                                        <td>:</td>
                                        <td><?=$userdata->address1?></td>
                                      </tr>
                                      
                                      <tr>
                                        <td class="profile_heading">City</td>
                                        <td>:</td>
                                        <td><?=$userdata->city?></td>
                                      </tr>

                                      <tr>
                                        <td class="profile_heading">State</td>
                                        <td>:</td>
                                        <td><?=$userdata->state?></td>
                                      </tr>
                                      
                                      <tr>
                                        <td class="profile_heading">Zip</td>
                                        <td>:</td>
                                        <td><?=$userdata->zip?></td>
                                      </tr>
                                      
                                      <!--<tr>
                                        <td>Social Media URLs</td>
                                        <td>:</td>
                                        <td><?=$userdata->username?></td>
                                      </tr>
                                      
                                      <tr>
                                        <td>Other URLs</td>
                                        <td>:</td>
                                        <td><?=$userdata->username?></td>
                                      </tr>-->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
        
        
    </div>
</div>    

<script>
    $(document).ready(function(){
        $('.dropdown.keep-open').on({
            "shown.bs.dropdown": function() { this.closable = false; },
            "click":             function() { this.closable = true; },
            "hide.bs.dropdown":  function() { return this.closable; }
        });
        
        
        $(".edit_profile_pic").click(function(){
            $("#profile_pic").click();
        });
        
        $("#profile_pic").change(function(){
            $("#profile_pic_form").submit();
        });
    });
</script>
