<?php 
$userid=$this->session->userdata('user_id');
?>
<style>
    .al_paid{float: right; font-size: 16px;}
    .py-btn{margin-top: 20px;}
    .bnr_img{
      float: right; 
      margin-bottom: 0px !important;
      padding-top: 0px !important;
      padding-bottom: 0px !important;
    }
    .ads_msg{font-size: 18px;}
</style>
<div class="col-sm-9">
   
    <div class="">
            <div class="row">
               
                    <div class="contant-head">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-7 col-md-7 col-sm-5 col-xs-12">
                              <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Ads</h4>  
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-7 col-xs-12 ">
                            
                    </div>
                        </div>
                </div>
            </div>
            
                    <div class="contant-body2">
                        <?php if($adsdata['res']){
                            $date=date('Y-m-d');
                            $exp_date=$adsdata['rows'][0]->exp_date;
                            
                            ?>
                            <?php if(($adsdata['rows'][0]->title!='' || $adsdata['rows'][0]->html_data!='') && $date<=$exp_date){?>
                        <span class="ads_msg">Your Ads is running till.......<?php echo date('d-M-Y',  strtotime($exp_date)); ?></span>
                                
                            <?php } else {
                                //echo 'update';
                                ?>
                               <div class="contant-body1">
                <div class="row">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>adssubscription/update_ads">
                            <div class="form-group">
                                
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label " for="pwd">Ads Type</label></div>
                              <div class="col-sm-9">          
                                  <input type="radio" name="adstype" class="adstype" value="0" <?php if($adsdata['rows'][0]->title!=''){ echo "checked";}?><?php echo set_radio('adstype', '0', TRUE); ?>> BY FORM 
                                  &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="adstype" id="by_html"  class="adstype" value="1" <?php if($adsdata['rows'][0]->html_data!=''){echo "checked"; }?> <?php echo set_radio('adstype', '1'); ?>> BY HTML
                              </div>
                            </div>
                            <div class="form-group" id="html_div" style="display:none;">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="details"> HTML</label></div>
                              <div class="col-sm-9">
                               
                                  <textarea class="form-control" id="details" name="details" placeholder="HTML"><?=set_value('details')?><?php if($this->input->post('details')){ echo $this->input->post('details'); }else{ echo $adsdata['rows'][0]->html_data;}?></textarea>
                                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger pull-right" id="details_error"></span>
                       
                            </div>
                        <div class="" id="by_form">
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="title">Title</label></div>
                              <div class="col-sm-9">          
                                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php if($this->input->post('title')){ echo $this->input->post('title'); }else{ echo $adsdata['rows'][0]->title;}?>">
                                  <?php if(form_error('title')!='') echo form_error('title','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="title_error"></span>
                                  
                            </div>
                        
                            
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="content">Content</label></div>
                              <div class="col-sm-9">          
                                  <textarea class="form-control" id="content" name="content" placeholder="Content"><?=set_value('content')?><?php if($this->input->post('content')){ echo $this->input->post('content'); }else{ echo $adsdata['rows'][0]->content;}?></textarea>
                                  <?php if(form_error('content')!='') echo form_error('content','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="content_error"></span>
                                  
                            </div>
                             <div class="form-group">
                             <div class="col-sm-2 col-sm-offset-1"><label class="control-label " for="image">Banner Image</label></div>
                              <div class="col-sm-9">          
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                Browse… <input multiple="" name="file" id="file" type="file">
                                            </span>
                                        </span>
                                          <input class="form-control" id="image" readonly="" placeholder='(maximum 4MB file size allowed)' type="text">
                                    
                                    </div>
                                  <span class="text-danger" id="image1_error"></span>
                              </div>
                             <?php if($adsdata['rows'][0]->image!=""){?>
                             
                             <div class="alert col-sm-3 bnr_img">
                        <a href="#" id="delete_image" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<img class="img-responsive img-thumbnail" src="<?=BASE_URL."assets/image/ads_images/thumb/".$adsdata['rows'][0]->image;?>" >
  </div>
                             <input type="hidden" id="exist_image" name="exist_image" value="<?php echo $adsdata['rows'][0]->image;?>">
                                 <?php } ?> 
                             <span class="text-danger" id="image_error"></span>
                            </div>
                             </div>
                         <div class="form-group">        
                              <div class="col-sm-offset-9 col-sm-3">
                                  <button type="submit" id="product" class="btn btn-success btn-block">Submit</button>
                              </div>
                            </div>
                        
                        
                      </form>
                </div>
            </div>
                            <?php }?>
                        <?php }else{
                            //echo 'add';
                            ?>
             <div class="contant-body1">
                <div class="row">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>adssubscription/add">
                            <div class="form-group">
                                
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label " for="pwd">Ads Type</label></div>
                              <div class="col-sm-9">          
                                  <input type="radio" name="adstype" class="adstype" value="0" checked <?php echo set_radio('adstype', '0', TRUE); ?>> BY FORM 
                                  &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="adstype" id="by_html"  class="adstype" value="1" <?php echo set_radio('adstype', '1'); ?>> BY HTML
                              </div>
                            </div>
                            <div class="form-group" id="html_div" style="display:none;">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="details"> HTML</label></div>
                              <div class="col-sm-9">
                               
                                  <textarea class="form-control" id="details" name="details" placeholder="HTML"><?=set_value('details')?></textarea>
                                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger pull-right" id="details_error"></span>
                       
                            </div>
                        <div class="" id="by_form">
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="title">Title</label></div>
                              <div class="col-sm-9">          
                                  <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                  <?php if(form_error('title')!='') echo form_error('title','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="title_error"></span>
                                  
                            </div>
                        
                            
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="content">Content</label></div>
                              <div class="col-sm-9">          
                                  <textarea class="form-control" id="content" name="content" placeholder="Content"><?=set_value('content')?></textarea>
                                  <?php if(form_error('content')!='') echo form_error('content','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="content_error"></span>
                                  
                            </div>
                             <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label " for="image">Banner Image</label></div>
                              <div class="col-sm-9">          
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                Browse… <input multiple="" name="file" id="file" type="file">
                                            </span>
                                        </span>
                                          <input class="form-control" id="image" readonly="" placeholder='(maximum 4MB file size allowed)' type="text">
                                    
                                    </div>
                                  <span class="text-danger" id="image1_error"></span>
                              </div>
                              <span class="text-danger" id="image_error"></span>
                            </div>
                             </div>
                         <div class="form-group">        
                              <div class="col-sm-offset-9 col-sm-3">
                                  <button type="submit" id="product" class="btn btn-success btn-block">Submit</button>
                              </div>
                            </div>
                        
                        
                      </form>
                </div>
                 
            </div>
                        <?php }?>
                    </div>              
        </div>
   
        
</div>  
    </div>
</div>  



<script>
	function set_session(sessname,sessvalue)
	{
            $.post("<?=BASE_URL?>adssubscription/set_session",{name:sessname,value:sessvalue},function(data,status){
            obj=$.parseJSON(data);
            if(obj.status){
            //window.location.assign("<?php echo $url;?>");
            }
        });
		
	}
        function pay(url){
         //set_session('price',price);
         var ads_id=$("#category").val();
         //alert(ads_id);
          $.post("<?=BASE_URL?>adssubscription/getprice",{id:ads_id},function(data,status){
            obj=$.parseJSON(data);
            if(obj.res){
               var ads_price=obj.category['price'];
               var cat_id=obj.category['id'];
               set_session('price',ads_price);
               set_session('ads_category',cat_id);
               window.location.assign("<?php echo $url;?>");
                
            } 
              
            
            
        
        });
         
         
         
         
    
    }

</script>
<script>
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
        $("#delete_image").click(function(){
          var user_id = "<?=$userid?>";
          var image=$("#exist_image").val();

          $("#exist_image").val("");
          $.post("<?=BASE_URL?>adssubscription/delete_image",{user_id:user_id,image:image},function(data){
            //alert(data);
          });
        });

          $("#product").click(function(){
              var adstype=$("input[type=radio][name='adstype']:checked").val();
              //alert(adstype);
              //alert("hii");
              if(adstype==0){
              //var category = $("#category").val().trim();
              var title = $("#title").val().trim();
              var content = $("#content").val().trim();
              var image =$("#image").val().trim(); 
              var ext = image.split('.').pop().toLowerCase();
              var allowed_ext=['jpg','png','jpeg'];
              //alert(jQuery.inArray(ext, allowed_ext) == -1);
              var check = jQuery.inArray(ext, allowed_ext) !== -1;
              //alert(check);
             
              //alert(file_size);
             
              if(title == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#title").focus();
                    $("#title_error").parent().addClass("has-error");
                    return false;    
              }
               
              else if(content == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#content").focus();
                    $("#content_error").parent().addClass("has-error");
                    return false;    
              }
//              if(!check){
//                  
//                  $("#image1_error").html("Only jpg|png|jpeg Allowed");
//                    $("#image_error").parent().addClass("has-error");
//                    return false;
//              }
//              
//               if(image!=''){
//                    var file_size = $('#file')[0].files[0].size;
//                    if(file_size<=0){
//                        $("#image1_error").html("This file is corrupted. So you can not upload this file.");
//                        $("#image_error").parent().addClass("has-error");
//                        return false;
//                    }
//                    
//                    if(file_size>4096000) {
//                        $("#image1_error").html("File size is greater than 4MB");
//                        $("#image_error").parent().addClass("has-error");
//                        return false;
//                    }
//                }
                    else
               if(image!=''){
                        var file_size = $('#file')[0].files[0].size;
                        //console.log(file_size); 
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
                        if(file_size > 4096000) {
                            $("#file").focus();
                            $("#image1_error").html("File size is greater than 4MB");
                            $("#image_error").parent().addClass("has-error");
                            return false;
                        }
                }
//                  else if(category == ''){
//                    //$("#fname_error").html("Enter Your First Name");
//                    $("#category").focus();
//                    $("#category_error").parent().addClass("has-error");
//                    return false;    
//              }
          }
          
          else if(adstype==1){
               var details = $("#details").val().trim();
               
               //var category = $("#category").val().trim();
                  if(details == ''){
                    //$("#fname_error").html("Enter Your First Name");
                    $("#details").focus();
                    $("#details_error").parent().addClass("has-error");
                    //$("#details_error1").css("display", "block");
                    return false;  
              }
//              else if(category == ''){
//                    //$("#fname_error").html("Enter Your First Name");
//                    $("#category").focus();
//                    $("#category_error").parent().addClass("has-error");
//                    return false;    
//              }
              
          }
              return true;
                  
          });
          
   
        
      });
      $(document).ready(function(){
        var adstype=$("input[type=radio][name='adstype']:checked").val();
        //alert(ad_type);
        if(adstype==1){
                  $("#html_div").show();
                  $("#by_form").hide();
             }else if(adstype==0){
                $("#html_div").hide();
                 $("#by_form").show();
                
             }
    });
      
      $(document).on("click",".adstype",function(){
             adstype = $(this).val(); 
             //alert(adstype);
             if(adstype==1){
                  $("#html_div").show();
                  $("#by_form").hide();
             }else if(adstype==0){
                $("#html_div").hide();
                 $("#by_form").show();
                
             }
          });
      
      
//    $(document).ready(function(){ 
//    $('#category').change(function(){ 
//    var period=$('#category :selected').val();
//    //alert(period);
//     $("#price").val(period);
//    });
//    });
   
</script>
<script>
          function change_opt(id){ 
              $.post("<?=BASE_URL?>adssubscription/getprice",{id:id},function(data){
                obj=$.parseJSON(data);
                //alert(obj.category['rows']['price']);
                if(obj.category['rows']['id']){	
                  $("#amt").val(obj.category['rows']['price']);   
               
                }
                
        });
         }
</script> 

