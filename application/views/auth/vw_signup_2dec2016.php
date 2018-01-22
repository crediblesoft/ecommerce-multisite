<div class="row">
    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
        <?php //echo validation_errors(); ?>
        <div class="signup">
            <div class="add_image">
                    <div class="media_msg text_upper">Sign Up</div>
                    <div class="img-responsive"><img src="<?=BASE_URL?>assets/image/signuphead.png"> </div>
                </div>
            <form data-toggle="validator" method="post">
                <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputFname" class="control-label">First Name</label><span>(Please use only alphabets)</span>
                    <input type="text" class="form-control" id="fname" name="fname" value="<?=set_value('fname')?>" placeholder="First Name">
                    <span class="text-danger" id="fname_error"></span>
                    <?php if(form_error('fname')!='') echo form_error('fname','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>
                
                <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputLname" class="control-label">Last Name</label><span>(Please use only alphabets)</span>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?=set_value('lname')?>" placeholder="Last Name">
                    <span class="text-danger" id="lname_error"></span>
                    <?php if(form_error('lname')!='') echo form_error('lname','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>
                
                <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputEmail" class="control-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>" placeholder="Email" onblur="checkdupemail(this.value)" onkeyup="checkdupemail(this.value)" >
                    <span class="text-danger" id="email_error"></span>
                    <?php if(form_error('email')!='') echo form_error('email','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>
                
                <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputUsername" class="control-label">Create a Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username')?>" placeholder="Create a userame" onblur="checkdupuser(this.value)" onkeyup="checkdupuser(this.value)" >
                    <span class="text-danger" id="username_error"></span>
                    <?php if(form_error('username')!='') echo form_error('username','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>
                
                <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputPassword" class="control-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <span class="text-danger" id="password_error"></span>
                    <?php if(form_error('password')!='') echo form_error('password','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>
                
                <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputCpassword" class="control-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" onblur="checkpassword()">
                    <span class="text-danger" id="cpassword_error"></span>
                    <?php if(form_error('cpassword')!='') echo form_error('cpassword','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>
                
                <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputCpassword" class="control-label">Mobile</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?=set_value('mobile')?>" placeholder="Mobile Number" onkeyup="checknumber(this.id,this.value)">
                    <span class="text-danger" id="mobile_error"></span>
                    <?php if(form_error('mobile')!='') echo form_error('mobile','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>

                <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputCpassword" class="control-label">State</label>
                    <select class="form-control" id="state" name="state">
                        <option value="">-------Select State-------</option>
                        <?php if($states['res']){foreach($states['rows'] as $state){ ?>
                        <option value="<?php echo $state->id;?>"><?php echo $state->state;?></option>
                        <?php }} ?>
                    </select>
                    <span class="text-danger" id="state_error"></span>
                    <?php if(form_error('state')!='') echo form_error('state','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>

                 <div class="col-sm-6">
                <div class="form-group required">                  
                    <label for="inputCpassword" class="control-label">Zip Code</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?=set_value('zip')?>" placeholder="Zip">
                    <span class="text-danger" id="zip_error"></span>
                    <?php if(form_error('zip')!='') echo form_error('zip','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>
                
                <div class="col-sm-6">
                <div class="form-group">                  
                    <label for="inputCpassword" class="control-label">Address</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Address"><?=set_value('address')?></textarea>
                    <span class="text-danger" id="mobile_error"></span>
                    <?php if(form_error('address')!='') echo form_error('address','<div class="text-danger err">','</div>'); ?>
                </div>
                </div>
                
                
                
               
                
                
                <div class="col-sm-12">
                <div class="form-group required">  
                    <label for="inputusertype" class="control-label">Type Of User</label><br/>
                    <div class="col-sm-6">
                        <span class="user-type"><input type="radio" class="form-control cus-radio" id="radio" value="1" name="usertype" checked> <p class="u-type-text">Seller</p></span>
                        <span class="user-type"><input type="radio" class="form-control cus-radio" id="radio" value="2" name="usertype"> <p class="u-type-text">Buyer</p></span>
                    </div>
                </div>
                </div>
                
                
                
                <div class="col-sm-12">
                <div class="checkbox text-center checkbox-sucess">
                    <label><input type="checkbox" id="agree" name="terms" value="1"> I agree to the <a href="<?php echo BASE_URL?>termsconditions" target="_blank" class="terms-condition"> Terms and Conditions.</a></label>
                    <br/>
                    <span class="text-danger" id="agree_error"></span>
                </div>
                </div>  
                
                <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group"> 
                    <button type="submit" class="btn btn-success btn-block" id="signup">Sign Up</button>
                </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
   $("#signup").click(function(){
       //alert($("#agree").val());
      var fname=$("#fname").val().trim();
      var lname=$("#lname").val().trim();
      var email=$("#email").val().trim();
      var username=$("#username").val().trim();
      var password=$("#password").val().trim();
      var cpassword=$("#cpassword").val().trim();
      var mobile=$("#mobile").val().trim();
      var state=$("#state").val().trim();
      var zip=$("#zip").val().trim();
     // alert(mobile.length);
      if(fname == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#fname").focus();
            $("#fname_error").parent().addClass("has-error");
            return false;    
      }
      
      if(lname == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#lname").focus();
            $("#lname_error").parent().addClass("has-error");
            return false;    
      }
      
      if(email == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#email").focus();
            $("#email_error").parent().addClass("has-error");
            return false;    
      }else{
        if(!validateEmail(email)){
            $("#email").focus();
            $("#email_error").html("Enter valid email.");
            $("#email_error").parent().addClass("has-error");
            return false;
        }
      }
      
      if(username == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#username").focus();
            $("#username_error").parent().addClass("has-error");
            return false;    
      }
	  
	  var sp=hasWhiteSpace(username);
	  if(sp){
			  $("#username").focus();
			  $("#username_error").html("White-space is not allowed.");
			  $("#username_error").parent().addClass("has-error");
			  return false;
		   }
      
      if(password == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#password").focus();
            $("#password_error").parent().addClass("has-error");
            return false;    
      }
      
      if(cpassword == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#cpassword").focus();
            $("#cpassword_error").parent().addClass("has-error");
            return false;    
      }
      
      if(mobile == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#mobile").focus();
            $("#mobile_error").parent().addClass("has-error");
            return false;    
      }
      
      
      
      if(mobile.length !== 10){
            $("#mobile_error").html("Mobile should be only 10 digit");
            $("#mobile").focus();
            $("#mobile_error").parent().addClass("has-error");
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
      
      if(!$("#agree").is(':checked')){
          $("#agree_error").html("Please check terms & conditions");
            $("#agree").focus();
            $("#agree_error").parent().addClass("has-error");
            return false;
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



    function checkdupemail(email){
       if(email!=''){
            $.post("<?=BASE_URL?>auth/checkdupemail",{email:email},function(data,status){
                if(data!=0){
                     //$("#email").focus();
                     $("#email_error").html("This email already exists");
                     $("#email_error").parent().addClass("has-error");
                 }else{
                     //alert('aa');
                     $("#email_error").html("");
                     $("#email_error").parent().removeClass("has-error");
                 }
            });
        }
    }

    function hasWhiteSpace(s) {
         return /\s/g.test(s);
     }	
  
    function checkdupuser(username){
        if(username!=''){
           var sp=hasWhiteSpace(username);
		   if(sp){
			  $("#username_error").html("White-space is not allowed.");
			  $("#username_error").parent().addClass("has-error");
		   }
		   else{
            $.post("<?=BASE_URL?>auth/checkdupusername",{username:username},function(data,status){
               if(data!=0){
                    //$("#username").focus();
                    $("#username_error").html("This username already exists");
                    $("#username_error").parent().addClass("has-error");
                }else{
                    $("#username_error").html("");
                    $("#username_error").parent().removeClass("has-error");
                }
           });
		   }

        }
    }
    
    
    function checkpassword(){
        var password=$("#password").val().trim();
        var cpassword=$("#cpassword").val().trim();
        
        if(password!==cpassword){
            $("#password_error").parent().addClass("has-error");
            $("#cpassword_error").parent().addClass("has-error");
            $("#cpassword_error").html("Password should be same");
        }else{
            $("#password_error").parent().removeClass("has-error");
            $("#cpassword_error").html("");
            $("#cpassword_error").parent().removeClass("has-error");
        }
    }
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error").html("Enter Only Numeric Value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            //return false;
        }}else{
            $("#"+id+"_error").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
    $('#fname').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^a-zA-Z]/g,'') ); }
    );
    $('#lname').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^a-zA-Z]/g,'') ); }
    );
</script>



