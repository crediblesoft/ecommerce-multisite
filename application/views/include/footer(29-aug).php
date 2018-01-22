
<?php include 'successmsg.php'; ?>
<script>
    <?php if($this->session->flashdata("sucess")!=''){ ?>
        $('#Sucessmsg').modal('show');
    <?php } ?>
        
    <?php if($this->session->flashdata("warning")!=''){ ?>
        $('#Warningmsg').modal('show');
    <?php } ?>
        
    <?php if($this->session->flashdata("alert")!=''){ ?>
        $('#Alert').modal('show');
    <?php } ?>
</script>

<div class="row footer">
<div class="container">
     <div class="row col-sm-12 col-md-8 col-lg-8 col-xs-12"> 
         
    <div class="row foot1 margin-bottom_20">
            
                <span class="foot-rex"><a href="<?=BASE_URL?>featuredseller">Featured Seller</a></span>
                <span class="cus_footer_bolt_icon hidden-xs"></span>
                <span class="foot-rex"><a href="<?=BASE_URL?>termsconditions">Terms & Conditions</a></span>
                <span class="cus_footer_bolt_icon hidden-xs"></span>
                <span class="foot-rex"><a href="<?=BASE_URL?>privacypage">Privacy Policy</a></span>
                <span class="cus_footer_bolt_icon hidden-xs"></span>
                <span class="foot-rex"><a href="<?=BASE_URL?>forum">Forum</a></span>
		<span class="cus_footer_bolt_icon hidden-xs"></span>
                <span class="foot-rex"><a href="<?=BASE_URL?>events">Events</a></span>
                
            </ul>      
    </div>
    
    <div class="row margin-bottom_20">
        <div class="copy">&copy; copyright - All Rights Reserved</div>
        <div class="ucodice"> Website Designed & Developed by <a href="http://www.ucodice.com/" target="_blank"> Ucodice.com</a></div>   
    </div>
    
     </div>
    
    <div class="col-sm-12 col-md-3 col-lg-3 col-xs-12 pull-right"> 
        <div class="row margin-bottom_20 social_head">
            <ul class="social">
                <li><a href="https://www.facebook.com/" target="_blank"><img src="<?=BASE_URL?>assets/image/facebook.png"></a></li>
                <li><a href="https://in.linkedin.com/" target="_blank"><img src="<?=BASE_URL?>assets/image/linkedin.png"></a></li>
                <li><a href="https://twitter.com/" target="_blank"><img src="<?=BASE_URL?>assets/image/twitter.png"></a></li>
                <li><a href="https://accounts.google.com/" target="_blank"><img src="<?=BASE_URL?>assets/image/google.png"></a></li>
                <li><a href="http://www.validfeedback.com/" target="_blank"><img src="<?=BASE_URL?>assets/image/validfeedback.png"></a></li>
            </ul>
        </div>
        
        <div class="row news_letter_subs">
            <form class="bs-example bs-example-form" role="form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email" id="news_email">
                    <span class="input-group-btn">
                        <button class="btn btn-success" id="news_susc" type="button">Submit</button>
                    </span>
                    
                 </div><!-- /input-group -->
                 <span class="news_email_error text-danger"></span>
            </form>
        </div>
    </div>   
        
</div>
</div>

    </div> <!-- /container -->
    
        <!-- Modal -->
<div id="shinner_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="top:100px;">
        <div class="modal-header" style="background: #28C769;height:10px;padding: 0;">&nbsp;</div>
        <div class="modal-body">
            <div style="padding:20px 30px 20px 48px;">
                <div style="display: inline-flex;margin:auto;width: 100%;"><img src="<?=BASE_URL?>assets/image/spinner.gif" class="img img-responsive" style="margin: auto;"></div>
            <p style="font-size: 20px;font-style: italic;" class="text-center">Please wait while we are calculating amount for payment with tax and shipping charges</p>
            </div>
        </div>
        <div class="modal-footer" style="background: #28C769;height:15px;padding: 0;">&nbsp;</div>
    </div>

  </div>
</div>
    
    <!-- Modal -->
<div id="newsSccess" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Success Message</h4>
      </div>
      <div class="modal-body">
          <p id="news_text"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    
    
<script> 
    $(document).ready(function(){
        $("#news_susc").click(function(){
            var news_email=$("#news_email").val().trim();
            var news_errornum = 0;
            if(news_email==''){
                news_errornum++;
                $(".news_email").focus();
                $(".news_email_error").parent().addClass("has-error");
                 $(".news_email_error").html("Email id is Required");
                return false;
            }
            
            if(!isValidEmailAddress(news_email)){
                news_errornum++;
                $(".news_email").focus();
                $(".news_email_error").parent().addClass("has-error");
                $(".news_email_error").html("Please Enter valid Email");
                return false;
            }
            
            if(news_errornum == 0){
                $.post("<?=BASE_URL?>auth/newsletter",{email:news_email},function(data,status){
                    var obj= $.parseJSON(data);
                    console.log(obj.message);
                    if(obj.status){
                        $("#news_text").html(obj.message);
                        $('#newsSccess').modal('show');
                        setTimeout(function(){
                        location.reload()},2000);
                    }else{
                        $(".news_email").focus();
                        $(".news_email_error").parent().addClass("has-error");
                        $(".news_email_error").html(obj.message);
                    }
                });
            }
            
            //return false;
        });
    });
    
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }
    
    <?php if($this->session->userdata('user_id')>0){  ?>

    $(document).ready(function(){ getmessagecount();});
     var msg1=0;
    function getmessagecount(){
       
        $.ajax({
                async:false,
                type:'POST',
                url: '<?=BASE_URL?>message/get_all_count',
                data: {},
                success: function(res){
                    obj=$.parseJSON(res);
                    if(obj.status)
                    {
                        $("#notification").css({"display":"block"});
                        $("#get_new_message").html(obj.msgcnt);
                       // alert(obj.msgcnt);
                        var msg2=obj.msgcnt;
                       // alert(msg1);
                        //alert(msg2);
                        if(msg1<msg2){
                           // alert("hi");
                            beep();
                        }
                        msg1=msg2;
                        //beep();
                    }
                    else
                    {
                        
                        $("#notification").css({"display":"none"});
                        console.log(obj.message);
                    }
                }
            });
            setTimeout(getmessagecount, 20000);
    }
    
    <?php  }  ?>
</script>
<script>
    function beep() {
    var snd = new Audio("data:audio/wav;base64,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");  
    snd.play();
    }
</script>    
    
  </body>
</html>

<?php ob_flush(); ?>
