<style>
.modal-open {
    overflow: auto !important;
}
</style>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        
        <div class="signin">
            <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading cus-panel-headin text-center">LOGIN</div>
                    <div class="panel-body cus-panel-body">
                        <form method="post" action="<?=BASE_URL?>auth/login">
                            <div class="col-sm-10 col-sm-offset-1">    
                                <div class="input-group input-group-lg margin-bottom_20">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                </div> 
                                
                                <div class="input-group input-group-lg margin-bottom_40">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                
                                <div class="margin-bottom_20">
                                <a href="<?=BASE_URL?>auth/forgotpassword"> Forgot Password ?</a>
                                </div>
                                <button type="submit" class="btn btn-success btn-block btn-lg" id="login">Login</button>
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
   $("#login").click(function(){
       //alert($("#agree").val());
       
      var username=$("#username").val().trim();
      var password=$("#password").val().trim();
        
      if(username == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#username").focus();
            $("#username").parent().addClass("has-error");
            return false;    
      }
      
      if(password == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#password").focus();
            $("#password").parent().addClass("has-error");
            return false;    
      }
      
      
      return true;
   }); 
});



</script>