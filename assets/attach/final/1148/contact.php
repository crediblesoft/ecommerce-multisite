
 <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
  $(document).ready(function() {
    $("#phone").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

</script>

<div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12 div_top padding_lr">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
  <?php echo form_open(BASE.'contact/add', array('onsubmit' => "return test_form()",'class'=>"form-horizontal",'enctype'=>"multipart/form-data")); ?>
    <!-- <form class="well form-horizontal" action=" " method="post"  id="contact_form"> -->
<fieldset>

<!-- Form Name -->
<span style="padding-top:20px;">
<p class="contact_h2">Contact Details</p></span>
<p style="font-size: 17px;">


<!-- Text input-->

<div class="form-group">
  <label class="col-md-3 control-label">First Name</label>  
  <div class="col-md-8 inputGroupContainer ">
  <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input id="first_name"  name="first_name" placeholder="First Name" class="form-control text-capitalize"  type="text"  value="<?php if($this->input->post('first_name')){ echo $this->input->post('first_name');} ?>">

    </div>
    <span class="text-danger text_error pull-left" id="first_name_error"></span>
  </div>
  
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-3 control-label" >Last Name</label> 
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  <input id="last_name" name="last_name" placeholder="Last Name" class="form-control text-capitalize"  type="text"  value="<?php if($this->input->post('last_name')){ echo $this->input->post('last_name');} ?>">
    </div>
  <span class="text-danger text_error pull-left" id="last_name_error"></span>

  </div>
</div>

<!-- Text input-->
       <div class="form-group">
  <label class="col-md-3  control-label">E-Mail</label>  
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
  <input name="email" id="email" placeholder="E-Mail Address" class="form-control "  type="text"  value="<?php if($this->input->post('email')){ echo $this->input->post('email');} ?>">
    </div>
  <span class="text-danger text_error pull-left" id="email_error"></span>

  </div>
</div>


<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-3  control-label">Phone </label>  
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
  <input name="phone" id="phone" placeholder="Contact Number" class="form-control " type="text"  value="<?php if($this->input->post('phone')){ echo $this->input->post('phone');} ?>">
    </div>
  <span class="text-danger text_error pull-left" id="phone_error"></span>

  </div>
</div>

<!-- Text input-->
      
<!--  -->
  
<div class="form-group">
  <label class="col-md-3  control-label">Message</label>
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
          <textarea id="comment" class="form-control" name="comment" placeholder="Enter your Message"><?php if($this->input->post('comment')){ echo $this->input->post('comment');}?></textarea>
  </div>
  <span class="text-danger text_error pull-left" id="comment_error"></span>
  
  </div>
</div>

<!-- Captcha-->
       
<div class="form-group">
  <label class="col-md-3 control-label"></label>  
    <div class="col-md-8 inputGroupContainer  map_right">
   
         <div class="g-recaptcha" data-sitekey="6LfMZAMTAAAAACyHzWORhokpAd40pK6WAjB6qLgc"></div>
   
  </div>
  <span class="text-danger text_error pull-left" id="recaptcha-error"></span>
  <input type="hidden" title="Please verify this" class="required" name="keycode" id="keycode">
</div>

<!-- Captcha-->


<!-- Button -->
<div class="form-group">
  <label class="col-md-3  control-label"></label>
  <div class="col-md-8 ">
    <button type="submit" id="submit_btn " class=" wpcf7-form-control wpcf7-submit btn " >SUBMIT </span></button>
  </div>
</div>

</fieldset>
</form>
</div>
<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
<div class="col-lg-12 mar-btm">



<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.8959799585937!2d72.55016705006783!3d23.02759122184614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84ef0b0560c7%3A0x369ac6980d2b54ec!2sGulbai+Tekra+Rd%2C+Gulbai+Tekra%2C+Ahmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1474949704251"  width="600" height="269" frameborder="0" style="border:0" allowfullscreen></iframe>


</div>
<?php if($pagedata['res']>0){
echo $pagedata['rows'][0]->address; ?>

</div>
</div>
<div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
<div class="container">
<span style="padding-top:20px;">
<p class="contact_h2 tab_loc">Locations</p></span>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tab_left">
<?php echo $pagedata['rows'][0]->locations; }?>

</div>

</div>
</div>
<script>
  function test_form(){  
      var inputtext=['first_name','last_name','email','phone','comment'];
      var status=true;
      for(var i=0;i<=inputtext.length-1;i++)
      {
    if($("#"+inputtext[i]).val().trim()=='')
    {
       $("#"+inputtext[i]).focus();
       $("#"+inputtext[i]+"_error").html($("#"+inputtext[i]).attr('placeholder')+" field is required");
        return status=false;
    }
    else{
        if("#"+inputtext[i]=='#email'){
            pat=/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
            str=$("#email").val();
                 if(!str.match(pat))
                 {
                    $("#"+inputtext[i]+"_error").html('Please enter a valid email address'); 
                     $("#"+inputtext[i]).focus(); 
                    return status=false;
                     
                 }
        }
       if("#"+inputtext[i]=='#phone'){
           pat=/^[0-9]+[0-9]+/;
            str=$("#phone").val().trim();
                 if(!str.match(pat))
                 {
                    $("#"+inputtext[i]+"_error").html('Please enter Valid phone number'); 
                     $("#"+inputtext[i]).focus(); 
                    return status=false;
                     
                 }
        }
        $("#"+inputtext[i]+"_error").html('');
    }
      }
      
    }

    </script>  

    <?php
                    $message=array(
                        'name'=>'messages',

                    );
                     $this->functions->add_modelnocnflict($message);    
                    // $this->load->view('include/message'); 


?>
