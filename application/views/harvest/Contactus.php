<style>
    .siteshdow_header_text{margin: 50px;}
    .contectusfeild{height: 80px;}
    .contectuscontaner{padding: 20px; margin-top:15px;}
</style>
<div class="row">
    <div class="container siteshdow">
        <div class="row siteshdow_header">
            <span class="" ><img src="<?php echo BASE_URL?>assets/image/icone_left.jpg" ></span>
            <b>Contact Us</b>
            <span class=""><img src="<?php echo BASE_URL?>assets/image/icone_right.jpg" ></span>
        </div>
        <div class="row">
            <!--<div class=" center siteshdow_header_text">
                <p>
            Ucodice provides business consulting for Any Business over the internet. 
            Ucodice is a team of professional that aims to provide high business solutions. 
            </p>

            </div>-->
        </div>
        <div class="row contectuscontaner">            
            <form data-toggle="validator" method="post" action="<?=BASE_URL?>contactus">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 contectusfeild">
                <div class="form-group required<?php /*required*/?>">                  
                    <label for="inputFname" class="control-label">First Name</label>
                    <input required="required" type="text" class="form-control" id="fname" name="fname" value="<?=set_value('fname')?>" placeholder="First Name">
                    
                    <?php if(form_error('fname')!='') echo form_error('fname','<div class="text-danger err">','</div>'); ?>
                    <span class="text-danger" id="fname_error"></span>
                </div>
                </div>
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 contectusfeild">
                <div class="form-group <?php /*required*/?>">                  
                    <label for="inputLname" class="control-label">Last Name</label>
                    <input  type="text" class="form-control" id="lname" name="lname" value="<?=set_value('lname')?>" placeholder="Last Name">
                    
                    <?php if(form_error('lname')!='') echo form_error('lname','<div class="text-danger err">','</div>'); ?>
                    <span class="text-danger" id="lname_error"></span>
                </div>
                </div>
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 contectusfeild">
                <div class="form-group required<?php /*required*/?>">                  
                    <label for="inputEmail" class="control-label">Email</label>
                    <input required="required" type="email" class="form-control" id="email" name="email" value="<?=set_value('email')?>" placeholder="Email" onblur="checkdupemail(this.value)" onkeyup="checkdupemail(this.value)" >
                   
                    <?php if(form_error('email')!='') echo form_error('email','<div class="text-danger err">','</div>'); ?>
                     <span class="text-danger" id="email_error"></span>
                </div>
                </div>
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 contectusfeild">
                <div class="form-group required<?php /*required*/?>">                  
                    <label for="inputMobile" class="control-label">Mobile</label>
                    <input required="required" type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" onkeyup="checknumber(this.id,this.value)" onchange="checknumberonchange(this.id,this.value)">
                    <?php if(form_error('mobile')!='') echo form_error('mobile','<div class="text-danger err">','</div>'); ?>
                    <span class="text-danger" id="mobile_error"></span>
                </div>
                </div>
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                <div class="form-group">                  
                    <label for="inputAddress" class="control-label">Address</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Address"></textarea>
                    <span class="text-danger" id="mobile_error"></span>
                </div>
                </div>
                
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                <div class="form-group required">                  
                    <label for="inputAddress" class="control-label">Message</label>
                    <textarea required="required" class="form-control" id="message" name="message" placeholder="Message"><?=set_value('message')?></textarea>
                    <?php if(form_error('message')!='') echo form_error('message','<div class="text-danger err">','</div>'); ?>
                    <span class="text-danger" id="mobile_error"></span>
                </div>
                </div>
                
                
                <div class="col-sm-4 col-sm-offset-4">
                <div class="form-group"> 
                    <button type="submit" class="btn siteshdow_header_btn btn-block" id="signup">Submit</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>  
<script>
function checknumber(id,value){
        if(value!='')
        {            
                if(!$.isNumeric( value ))
                {
                    $("#"+id+"_error").html("Enter Only Numeric Value");
                    $("#"+id).focus();
                    $("#"+id+"_error").parent().addClass("has-error");
                    //return false;
                }
        }
        else
        {
                $("#"+id+"_error").html("");
                $("#"+id).focus();
                $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
    
    function checknumberonchange(id,value){
        if(value!='')
        {          
                if(!$.isNumeric( value ))
                {
                    $("#"+id+"_error").html("Enter Only Numeric Value");
                    $("#"+id).focus();
                    $("#"+id+"_error").parent().addClass("has-error");
                    //return false;
                }
                else
                {
                        $("#"+id+"_error").html("");
                        $("#"+id).focus();
                        $("#"+id+"_error").parent().removeClass("has-error");
                }
        }
        else
        {
                $("#"+id+"_error").html("");
                $("#"+id).focus();
                $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
    $(document).ready(function(){
          $("#signup").click(function(){          
              var name = $("#fname").val().trim();
              var mobile = $("#mobile").val().trim();
              var email = $("#email").val().trim();
             
             name=$.trim(name);
             mobile=$.trim(mobile);
             email=$.trim(email);
             
             console.log(name);
              if(name == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#fname").focus();
                    $("#fname_error").parent().addClass("has-error");
                    return false;    
              }
              else              
              if(email == '' || validateEmail(email)){
                    //$("#name_error").html("Enter Your First Name");
                    $("#email").focus();
                    $("#email_error").parent().addClass("has-error");
                    return false;    
              }
                else              
              if(mobile == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#mobile").focus();
                    $("#mobile_error").parent().addClass("has-error");
                    return false;    
              }              
              else{
                return true;
                }
              /*else if(details == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#details").focus();
                    $("#details_error").parent().addClass("has-error");
                    return false;    
              }*/
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
}​
</script>
