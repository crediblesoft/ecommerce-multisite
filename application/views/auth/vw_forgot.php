<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        
        <div class="signin">
            <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading cus-panel-headin text-center">Forgot Password</div>
                    <div class="panel-body cus-panel-body">
                        <form method="post" action="<?=BASE_URL?>auth/forgotpassword">
                            <div class="col-sm-10 col-sm-offset-1">    
                                <p>Please enter your e-mail address & we will send you a confirmation mail to reset your password.</p>
                                <div class="input-group input-group-lg margin-bottom_30">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Id">
                                </div>
                                        

                                        <!--<a href="<?=BASE_URL?>auth/regeneratecode" id="regenerate"> Regenerate Verification code ?</a>
                                <br/><br/>-->
                                <button type="submit" class="btn btn-success btn-block btn-lg" id="verify">Submit</button>
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
      var code=$("#email").val().trim();
        
      if(code == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#email").focus();
            $("#email").parent().addClass("has-error");
            return false;    
      }
      
      
      return true;
   }); 
   
});



</script>