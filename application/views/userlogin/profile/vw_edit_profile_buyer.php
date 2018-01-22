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
                
                <div class="col-sm-12 margin_bottom_15">
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
                        </div>
                    </div>
                </div>
                
                <?php if($res){ ?>
                <div class="col-sm-12">
                    
                        <div class="col-sm-12 col-xs-12 ">
                            <form name="edit" action="<?=BASE_URL?>profile/updatebuyerprofile" class="form-horizontal" method="post" role="form">
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2 text_align_left" for="name">First Name</label>
                                    <div class="col-sm-10">          
                                        <input type="text" class="form-control" id="f_name" value="<?=$userdata->f_name;?>" name="f_name" placeholder="First Name">
                                        <?php if(form_error('f_name')!='') echo form_error('f_name','<div class="text-danger err">','</div>'); ?>
                                        <span class="text-danger" id="f_name_error_num"></span>
                                    </div>
                                    <span class="text-danger" id="f_name_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2 text_align_left" for="contact-person">Last Name</label>
                                    <div class="col-sm-10">          
                                        <input type="text" class="form-control" id="l_name" value="<?=$userdata->l_name?>" name="l_name" placeholder="Last Name">
                                        <?php if(form_error('l_name')!='') echo form_error('l_name','<div class="text-danger err">','</div>'); ?>
                                        <span class="text-danger" id="l_name_error_num"></span>
                                    </div>
                                    <span class="text-danger" id="l_name_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2 text_align_left" for="contact-person">Phone</label>
                                    <div class="col-sm-10">          
                                        <input type="text" class="form-control" id="phone" value="<?=$userdata->mobile_no?>" name="phone" placeholder="Phone" onkeyup="checknumber(this.id,this.value)">
                                        <?php if(form_error('phone')!='') echo form_error('phone','<div class="text-danger err">','</div>'); ?>
                                        <span class="text-danger" id="phone_error_num"></span>
                                    </div>
                                    <span class="text-danger" id="phone_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2 text_align_left" for="email">Email</label>
                                    <div class="col-sm-10">          
                                        <input type="text" class="form-control" id="email" value="<?=$userdata->email_id?>" name="email" placeholder="email" onblur="checkdupemail(this.value)" onkeyup="checkdupemail(this.value)">
                                        <?php if(form_error('email')!='') echo form_error('email','<div class="text-danger err">','</div>'); ?>
                                    </div>
                                    <span class="text-danger" id="email_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2 text_align_left" for="contact-person">Address</label>
                                    <div class="col-sm-10">          
                                        <textarea id="address" name="address" placeholder="Address" class="form-control"><?=$userdata->address1?></textarea>
                                        <?php if(form_error('address')!='') echo form_error('address','<div class="text-danger err">','</div>'); ?>
                                    </div>
                                    <span class="text-danger" id="address_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2 text_align_left" for="city">City</label>
                                    <div class="col-sm-10">          
                                        <input type="text" class="form-control" id="city" value="<?=$userdata->city?>" name="city" placeholder="City">
                                        <?php if(form_error('city')!='') echo form_error('city','<div class="text-danger err">','</div>'); ?>
                                    </div>
                                    <span class="text-danger" id="city_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2 text_align_left" for="contact-person">State</label>
                                    <div class="col-sm-10">          
                                        <select class="form-control" id="state" name="state">
                                            <option value="">-------Select State-------</option>
                                            <?php if($states['res']){foreach($states['rows'] as $state){ ?>
                                            <option value="<?php echo $state->id;?>" <?php if($userdata->stateid==$state->id){echo "selected";}?> ><?php echo $state->state;?></option>
                                            <?php }} ?>
                                        </select>
                                        <?php if(form_error('state')!='') echo form_error('state','<div class="text-danger err">','</div>'); ?>
                                    </div>
                                    <span class="text-danger" id="state_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2 text_align_left" for="contact-person">Zip</label>
                                    <div class="col-sm-10">          
                                        <input type="text" class="form-control" id="zip" value="<?=$userdata->zip?>" name="zip" placeholder="Zip">
                                        <?php if(form_error('zip')!='') echo form_error('zip','<div class="text-danger err">','</div>'); ?>
                                    </div>
                                    <span class="text-danger" id="zip_error"></span>
                                </div>
                                
                                <div class="form-group">        
                                        <div class="col-sm-offset-8 col-sm-4">
                                            <div class="col-sm-12 padding_right_none">
                                            <button type="submit" id="update" class="btn btn-success btn-block">Update</button>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                
                            </form>
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
        
        $("#update").click(function(){
            var f_name = $("#f_name").val().trim();
            var l_name = $("#l_name").val().trim();
            var phone = $("#phone").val().trim();
            var state=$("#state").val().trim();
            var city=$("#city").val().trim();
            var zip=$("#zip").val().trim();
            //var address = $("#address").val().trim();
            if(f_name == ''){
                  //$("#fname_error").html("Enter Your First Name");
                  $("#basic-info2").click();
                  $("#f_name").focus();
                  $("#f_name_error").parent().addClass("has-error"); 
                  $("#f_name_error_num").html("Enter First Name"); 
                   return false;    
            }
            var regex = /^[0-9a-zA-Z\_]+$/
            if(!regex.test(f_name)){
                $("#basic-info2").click();
                  $("#f_name").focus();
                  $("#f_name_error").parent().addClass("has-error"); 
                  $("#f_name_error_num").html("special character Not Allowed"); 
                  return false;  
            }
            if(!regex.test(l_name)){
                $("#basic-info2").click();
                  $("#l_name").focus();
                  $("#l_name_error").parent().addClass("has-error");
                  $("#l_name_error_num").html("special character Not Allowed"); 
                  return false;  
            }

            if(l_name == ''){
                  //$("#fname_error").html("Enter Your First Name");
                  $("#basic-info2").click();
                  $("#l_name").focus();
                  $("#l_name_error").parent().addClass("has-error");
                  $("#l_name_error_num").html("Enter Last Name"); 
                  return false;    
            }
            
            if(phone == ''){
                  //$("#name_error").html("Enter Your First Name");
                  $("#business-info1").click();
                  $("#phone").focus();
                  $("#phone_error").parent().addClass("has-error");
                  $("#phone_error_num").html("Enter Phone");
                  return false;    
            }
            if(phone.length>10){
                $("#phone").focus();
                $("#phone_error").parent().addClass("has-error");
                $("#phone_error_num").html("Enter Only 10 digits");
                return false; 
            }
            if(phone.length<10){
                $("#phone").focus();
                $("#phone_error").parent().addClass("has-error");
                $("#phone_error_num").html("Enter 10 digits Phone Number");
                return false; 
            }
            if(!$.isNumeric( phone )){
                $("#phone_error_num").html("Enter Only Numeric Value");
                $("#phone").focus();
                $("#phone_error").parent().addClass("has-error");
                return false;
            }
            if(city==''){
                $("#city").focus();
                $("#city_error").parent().addClass("has-error");
                return false; 
            }
            if(state==''){
                $("#state").focus();
                $("#state_error").parent().addClass("has-error");
                return false; 
            }
            
            if(zip==''){
                $("#zip").focus();
                $("#zip_error").parent().addClass("has-error");
                return false; 
            }

            /*if(address == ''){
                  //$("#name_error").html("Enter Your First Name");
                  $("#business-info1").click();
                  $("#address").focus();
                  $("#address_error").parent().addClass("has-error");
                  return false;    
            }*/
            
            return true;
        });
    });

    function checknumber(id,value){
        if(value!=''){
            if(!$.isNumeric( value )){
                $("#"+id+"_error_num").html("Enter Only Numeric Value");
                $("#"+id).focus();
                $("#"+id+"_error").parent().addClass("has-error");
                
                //return false;
            }else if(value.length>10){
                $("#"+id+"_error_num").html("Enter Only 10 digits");
                $("#"+id).focus();
                $("#"+id+"_error").parent().addClass("has-error");
            }else if(value.length==10){
                $("#"+id+"_error").parent().removeClass("has-error");
                $("#"+id+"_error_num").html("");
            }
            
        }else{
            $("#"+id+"_error_num").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
    $('#f_name').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^a-zA-Z]/g,'') ); }
    );
    $('#l_name').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^a-zA-Z]/g,'') ); }
    );

    function checkdupemail(email){
       if(email!=''){
            $.post("<?=BASE_URL?>auth/checkdupemail",{email:email},function(data,status){
                if(data!=0){
                     //$("#email").focus();
                     $("#email_error").html("Email-id already exists");
                     $("#email_error").parent().addClass("has-error");
                 }else{
                     //alert('aa');
                     $("#email_error").html("");
                     $("#email_error").parent().removeClass("has-error");
                 }
            });
        }
    }

</script>
