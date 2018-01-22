<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        
        <div class="signin">
            <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading cus-panel-headin text-center">Email Verification</div>
                    <div class="panel-body cus-panel-body">
                        <form method="post" action="<?=BASE_URL?>auth/verify">
                            <div class="col-sm-10 col-sm-offset-1">    
                                        <input type="hidden" class="form-control" id="email" name="email" value="<?=$email?>" placeholder="Email">
                                        <h6><?=$message?></h6>
                                       
                                <div class="input-group input-group-lg">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Verification Code">
                                </div>
                                        <br/><br/>

                                        <a href="<?=BASE_URL?>auth/regeneratecode" id="regenerate"> Regenerate Verification Code ?</a>
                                <br/><br/>
                                <button type="submit" class="btn btn-success btn-block btn-lg" id="verify">Verify</button>
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
      var code=$("#code").val().trim();
        
      if(code == ''){
            //$("#fname_error").html("Enter Your First Name");
            $("#code").focus();
            $("#code").parent().addClass("has-error");
            return false;    
      }
      
      
      return true;
   }); 
   
   /*$("#regenerate").click(function(){
       var email = $("#email").val().trim();
       $.post("<?=BASE_URL?>auth/regeneratecode",{email:email},function(data,status){
           
       });
   });*/
});



</script>