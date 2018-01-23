
<?php include 'successmsg.php'; ?>
<script>
    <?php if($this->session->flashdata("sucess")!=''){ ?>
        $('#Sucessmsg').modal('show');
    <?php } ?>

     <?php if($this->session->flashdata("warning")!=''){ ?>
        $('#Warningmsg').modal('show');
    <?php } ?>
</script>

<div class="row footer">
<div class="col-sm-10 col-sm-offset-1">
     <div class="row col-sm-12 col-md-7 col-lg-7 col-xs-12">

    <div class="row foot1 margin-bottom_20">

                <span class="foot-rex"><a href="<?=BASE_URL?>featuredseller">Featured Seller</a></span>
                <span class="cus_footer_bolt_icon hidden-xs"></span>
                <span class="foot-rex"><a href="<?=BASE_URL?>termsconditions">Terms & Conditions</a></span>
                <span class="cus_footer_bolt_icon hidden-xs"></span>
                <span class="foot-rex"><a href="<?=BASE_URL?>privacypage">Privacy Policy</a></span>

            </ul>
    </div>

    <div class="row margin-bottom_20">
            <div>&copy; - All Rights Reserved</div>
            <div> website design & developed by <a href=""> ucodice.com</a></div>
    </div>

     </div>

    <div class="col-sm-12 col-md-3 col-lg-3 col-xs-12 pull-right">
        <div class="row margin-bottom_20 social_head">
            <ul class="social">
                <li><a href=""><img src="<?=BASE_URL?>assets/image/facebook.png"></a></li>
                <li><a href=""><img src="<?=BASE_URL?>assets/image/linkedin.png"></a></li>
                <li><a href=""><img src="<?=BASE_URL?>assets/image/twitter.png"></a></li>
                <li><a href=""><img src="<?=BASE_URL?>assets/image/google.png"></a></li>
                <li><a href=""><img src="<?=BASE_URL?>assets/image/validfeedback.png"></a></li>
            </ul>
        </div>

        <div class="row news_letter_subs">
            <form class="bs-example bs-example-form" role="form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email" id="news_email">
                    <span class="input-group-btn">
                        <button class="btn btn-success" id="news_susc" type="button">submit</button>
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
</script>


  </body>
</html>

<?php ob_flush(); ?>
