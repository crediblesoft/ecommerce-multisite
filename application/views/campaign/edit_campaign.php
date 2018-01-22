<?php //print_r($campaigns);
if($campaigns['res']){
     $campaigns=$campaigns['rows'][0];
?>

<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>campaign"> Campaign</a> </h4><h5> > Edit </h5>
                         <span class="add-button"><a class="btn btn-success" href="<?=BASE_URL?>campaign/userCampaignList"> <span class="glyphicon glyphicon-plus-sign"></span> View Campaign</a></span>
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>campaign/updatecampaign">
                            
                        <input type="hidden" id="campaignId" name="campaignId" value="<?=$campaigns->id?>" >
                        
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="name"> Title</label></div>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control" id="name" value="<?=$campaigns->campaign_titel?>" name="name" placeholder="Campaign Title">
                                  <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="name_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="price"> Fundraising Goal</label></div>
                              <div class="col-sm-8">   
                                  <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                  <input type="text" class="form-control" id="price" value="<?=$campaigns->price?>" name="price" placeholder="Campaign Price" onkeyup="checknumber(this.id,this.value)" >
                                  </div>
                                  <?php if(form_error('price')!='') echo form_error('price','<div class="text-danger err">','</div>'); ?>
                                  <span class="text-danger" id="price_error_nume"></span>
                              </div>
                              <span class="text-danger" id="price_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group required">
                                <div class=" col-sm-3 col-sm-offset-1"><label class="control-label " for="image"> Image</label></div>
                              <div class="col-sm-6">          
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                Browse… <input  name="file" id="file" type="file">
                                            </span>
                                        </span>
                                        <input class="form-control" id="image" name="image" readonly="" placeholder='(maximum 4MB file size allowed)' value="<?=$campaigns->image_path?>" type="text">
                                    
                                    </div>
                                  <span class="text-danger" id="image1_error"></span>
                              </div>
                              <div class="col-sm-2"><img src="<?=BASE_URL."assets/image/campaign/thumb/".$campaigns->image_path?>" height="100%" width="100%" class="img-responsive"></div>
                              <span class="text-danger" id="image_error"></span>
                            </div>
                            <div class="form-group">
                                   <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="video_link">Video Link</label></div>
                                 <div class="col-sm-8">          
                                     <input type="text"  class="form-control" id="video_link" name="video_link" value="<?=$campaigns->video_link?>" placeholder="Video Link" >
                                     <span class="text-danger" id="quantity_error_nume"></span>
                                     <?php if(form_error('video_link')!='') echo form_error('video_link','<div class="text-danger err">','</div>'); ?>
                                 </div>
                                 <span class="text-danger" id="video_link_error"></span>

                               </div>
                        
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="details"> Details</label></div>
                              <div class="col-sm-8">          
                                  <textarea class="form-control" id="details" name="details" placeholder="Campaign Details"><?=$campaigns->campaign_detail?></textarea>
                                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="details_error"></span>
                                  
                            </div>
                         
                        
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="quantity"> Start Date</label></div>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control" id="CampaignStartDate" name="CampaignStartDate" value="<?=$campaigns->start_date?>" placeholder="Campaign Start Date" readonly="">
                                  <span class="text-danger" data-provide="datepicker" data-date-format="yyyy-mm-yy" id="quantity_error_nume"></span>
                                  <?php if(form_error('CampaignStartDate')!='') echo form_error('CampaignStartDate','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="CampaignStartDate_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="quantity"> End Date</label></div>
                              <div class="col-sm-8">          
                                  <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-yy" class="form-control" id="CampaignEndDate" name="CampaignEndDate" value="<?=$campaigns->end_date?>" placeholder="Campaign End Date" readonly="">
                                  <span class="text-danger" id="quantity_error_nume"></span>
                                  <?php if(form_error('CampaignEndDate')!='') echo form_error('CampaignEndDate','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="CampaignEndDate_error"></span>
                                  
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                              <div class="col-sm-8">
                                  <select class="form-control" id="status" name="status">
                                        <option value="1" <?php if($campaigns->show_stetus==1){echo "selected"; } ?> >Active</option>
                                        <option value="0" <?php if($campaigns->show_stetus==0){echo "selected"; } ?> >Inactive</option>
                                </select>                                  
                              </div>
                              
                                  
                            </div>
                        
                            
                            <div class="form-group">        
                              <div class="col-sm-offset-9 col-sm-3">
                                  <button type="submit" id="campaign" class="btn btn-success btn-block">Submit</button>
                              </div>
                            </div>
                        
                        
                      </form>
                </div>
            </div>
        </div>
<?php }?>
        
    </div>
</div>    
<script type="text/javascript">
tinymce.init({
    selector: "textarea",    
    plugins: [
                //"advlist   lists print preview  preview    spellchecker",
                //"searchreplace wordcount visualblocks visualchars code  ",
                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify |"
        ,toolbar2:" fontselect fontsizeselect | forecolor backcolor"
       // ,toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        //toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft"

});
</script>
<script>
      //var $j = jQuery.noConflict();
    $(function(){
        $( "#CampaignStartDate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#CampaignEndDate").datepicker("option", "minDate", dt);
            }
        });
        $( "#CampaignEndDate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#CampaignStartDate").datepicker("option", "maxDate", dt);
            }
        });
    });

//    $(document).ready(function(){
//        $("#CampaignStartDate").datepicker({
//            format: "yyyy-mm-dd",
//            orientation: "bottom auto",
//            todayHighlight: true
//        }).css('z-index','100110');
//        $("#CampaignEndDate").datepicker({
//            format: "yyyy-mm-dd",
//            orientation: "bottom auto",
//            todayHighlight: true
//        }).css('z-index','100110');
//       
//    });
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
      });

      $(document).ready( function() {
          $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });
      
      $(document).ready(function(){
          $("#campaign").click(function(){
              //alert("hii");
              
              var name = $("#name").val().trim();
              var price = $("#price").val().trim();
              var details =tinyMCE.activeEditor.getContent();// $("#details").val().trim();     
                details=details.replace('<!DOCTYPE html>','')
                .replace('<html>','')
                .replace('<head>','')
                .replace('</head>','')
                .replace('<body>','')
                .replace('</body>','')
                .replace('</html>','').trim();
            details=$.trim(details);      
              
              
              var video_link = $("#video_link").val().trim();
              var CampaignStartDate = $("#CampaignStartDate").val().trim();
              var CampaignEndDate = $("#CampaignEndDate").val().trim();
              
              var image =$("#image").val().trim(); 
              var ext = image.split('.').pop().toLowerCase();
              var allowed_ext=['jpg','png','jpeg'];
              //alert(jQuery.inArray(ext, allowed_ext) == -1);
              var check = jQuery.inArray(ext, allowed_ext) !== -1;
              
              //alert(check);
             if(name == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#name").focus();
                    $("#name_error").parent().addClass("has-error");
                    return false;    
              }              
              else
              if(price == ''){
                    //$("#price_error_nume").html("Enter Your First Name");
                    $("#price").focus();
                    $("#price_error").parent().addClass("has-error");
                    return false;    
             }else          
                if(!$.isNumeric(price)){
                    $("#price_error_nume").html("Enter numaric price only");
                    $("#price").focus();
                    $("#price_error").parent().addClass("has-error");
                    return false;    
                }
            else
                if(image==''){
                  $("#file").focus();
                  $("#image1_error").html("Image is required");
                    $("#image_error").parent().addClass("has-error");
                    return false;
                    }  else
             if(image!=''){
                 var file_size = $('#file')[0].files[0].size; 
                 if(!check){                      
                  $("#file").focus();
                  $("#image1_error").html("Only jpg|png|jpeg Allowed");
                    $("#image_error").parent().addClass("has-error");
                    return false;
                    }else
                    if(file_size==0) {
                        $("#image").focus();
                        $("#image1_error").html("This file is corrupted. So you can not upload this file.");
                        $("#image_error").parent().addClass("has-error");
                        return false;
                        
                    }
                    else          
                    if(file_size>4096000) {
                        $("#file").focus();
                        $("#image1_error").html("File size is greater than 4MB");
                        $("#image_error").parent().addClass("has-error");
                        return false;
                    }
                }
              else
              if(details == ''){
                    $("#details_error_nume").html("Campaign details is required field");
                    $("#details").focus();
                    //$(".mce-container").css('border','1px solid #A94442');
                    $("#details_error").parent().addClass("has-error");
                    return false;    
              }
              /*if(video_link == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#video_link").focus();
                    $("#video_link_error").parent().addClass("has-error");
                    return false;    
              }*/else
              if(CampaignStartDate == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#CampaignStartDate").focus();
                    $("#CampaignStartDate_error").parent().addClass("has-error");
                    return false;    
              }else if(CampaignEndDate == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#CampaignEndDate").focus();
                    $("#CampaignEndDate_error").parent().addClass("has-error");
                    return false;    
              }
              else{
              return true;
          }
          });
      });
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_nume").html("Enter only numeric value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            //return false;
        }}else{
            $("#"+id+"_error_nume").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
    
    
</script>

