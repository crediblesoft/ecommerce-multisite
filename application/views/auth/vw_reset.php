<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        
        <div class="signin">
            <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading cus-panel-headin text-center">Reset Password</div>
                    <div class="panel-body cus-panel-body">
                        <form method="post" action="<?=BASE_URL?>auth/resetpassword/<?=$id?>">
                            <div class="col-sm-10 col-sm-offset-1">    
                                        
                                <div class="input-group input-group-lg">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                                        
                                </div><?php if(form_error('password')!='') echo form_error('password','<div class="text-danger err">','</div>'); ?>
                                        <br/><br/>
                                        
                                <div class="input-group input-group-lg">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                        
                                </div><?php if(form_error('confirm_password')!='') echo form_error('confirm_password','<div class="text-danger err">','</div>'); ?>
                                        <br/><br/>

                                        <!--<a href="<?=BASE_URL?>auth/regeneratecode" id="regenerate"> Regenerate Verification code ?</a>
                                <br/><br/>-->
                                <button type="submit" class="btn btn-success btn-block btn-lg" id="verify">Reset</button>
                            </div>    
                        </form>    
                    </div>
                </div>
            </div> 
        </div>        
            
    </div>
</div>    
	
<script>
$(document).ready(function(){
   $("#verify").click(function(){
       //alert($("#agree").val());
      var password=$("#password").val().trim();
      var confirm_password=$("#confirm_password").val().trim();
        
      if(password == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#password").focus();
            $("#password").parent().addClass("has-error");
            return false;    
      }
      
      if(confirm_password== ''){
          $("#confirm_password").focus();
          $("#confirm_password").parent().addClass("has-error");
          return false;
      }
      
      
      return true;
   }); 
   
});



</script>