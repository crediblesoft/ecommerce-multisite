<?php //print_r($recipe); ?>
<div class="col-sm-9">
    <div class="row">        
            <div class="row">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>recipe"> Recipe</a> </h4><h5> > edit </h5>
                         <span class="add-button"><a class="btn btn-success" href="<?=BASE_URL?>recipe/recipeuserlist"> <span class="glyphicon glyphicon-plus-sign"></span> View Recipe</a></span>
                    </div>
                </div>
            </div>    
            <div class="contant-body1">
                <div class="row">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>recipe/updaterecipe">
                        <input type="hidden" id="recipeId" name="recipeId" value="<?=$recipe['rows'][0]->recipeid?>" >
<!--                        <div class="form-group" style="display: none;">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="Type"> Type</label></div>
                              <div class="col-sm-9">          
                                  <input type="text" readonly="" class="form-control" id="Type" value="<?php if(set_value('Type')!=""){echo set_value('Type');}else{echo "Food";}?>" name="Type" placeholder="Recipe Type"  >
                                  <?php if(form_error('Type')!='') {echo form_error('Type','<div class="text-danger err">','</div>'); }?>
                                  <span class="text-danger" id="Type_error_nume"></span>
                              </div>
                              <span class="text-danger" id="Type_error"></span>
                                  
                            </div>-->
                        
                        <div class="form-group required">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Category</label></div>
                              <div class="col-sm-9">
                                  <select class="form-control" id="Type" name="Type">
                                    <option value="">----Select Category-----</option>
                                    <?php
                                        if($category['res']){
                                            foreach($category['rows'] as $category){
                                        
                                    ?>
                                        <option value="<?=$category->id?>" <?php if(set_value('Type')!=""){ echo set_select('Type', $category->id); }else if($category->id==$recipe['rows'][0]->recipe_type){ echo "selected";  } ?> ><?=$category->category?></option>
                                        <?php } } ?>
                                </select>
                                  <?php if(form_error('Type')!='') echo form_error('Type','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="Type_error"></span>
                                  
                            </div>
                        
                            <div class="form-group required">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name"> Title</label></div>
                              <div class="col-sm-9">          
                                  <input type="text" class="form-control" id="name" 
                                         value="<?php if(set_value('name')!=""){echo set_value('name');}else{echo $recipe['rows'][0]->recipe_title;}?>" name="name" placeholder="Recipe Title">
                                  <?php if(form_error('name')!='') {echo form_error('name','<div class="text-danger err">','</div>'); }?>
                              </div>
                              <span class="text-danger" id="name_error"></span>
                                  
                            </div>
                      <!-- volvo- 1-->
                        <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label " for="image"> Image</label></div>
                             <div class="col-sm-9">            
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                Browse… <input name="file" id="file" type="file">
                                            </span>
                                        </span>
                                        <input class="form-control" id="image" name="image" readonly="" type="text" placeholder='(maximum 4MB file size allowed)'>
                                    
                                    </div>
                                  <span class="txt-danger" id="image1_error"></span>
                              </div>
                              
                                <div class="col-sm-12" style="margin-top: 10px;">
                                   	
							
						<?php
						if(substr_count($recipe['rows'][0]->image_path,'http') > 0 ) $reciepe_image=$recipe['rows'][0]->image_path; 
						else $reciepe_image=BASE_URL.'assets/image/recipe/thumb/'.$recipe['rows'][0]->image_path;
						?>
						
                          <img src="<?php echo $reciepe_image; ?>" width=150 alt="" class="img-responsive pull-right">
                              </div>
                                                                
                              <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12  center-block center" align=center>
								<span class="text-danger " id="image1_error" >(<b>OR</b> upload from external url)</span>								
                              </div>                              
                             
                            </div>
                            
                             <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name"> Enter Path</label></div>
                              <div class="col-sm-9">          
                                  <input type="text" class="form-control" id="image_url" value="<?php if(substr_count($recipe['rows'][0]->image_path,'http') > 0 ) echo $recipe['rows'][0]->image_path; ?>" name="image_url" placeholder="Please enter full web address of image">
                                 
                              </div>
                             
                                  
                            </div>
                           
                           
                               <div class="form-group">
                                   <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="video_link">Video Link</label></div>
                                 <div class="col-sm-9">          
                                     <input type="text"  class="form-control" id="video_link" name="video_link" value="<?php if(set_value('video_link')!=""){echo set_value('video_link');}else{echo $recipe['rows'][0]->video_link;}?>" placeholder="Please follow below instructions" >
                                     <span class="text-danger" id="quantity_error_nume"></span>
                                     <?php if(form_error('video_link')!='') echo form_error('video_link','<div class="text-danger err">','</div>'); ?>
                                 </div>
                                  <div class="row">
                                <div class="col-md-8 col-sm-12 col-lg-8 col-xs-12 pull-right">
                                    <ol>
                                        <li>Play your video on <a href="https://www.youtube.com" target="_blank">You tube</a></li>
                                        <li>Copy youtube url and paste it into the above textbox</li>
                                    </ol>
                                </div>
                            </div>
                                
                                 <?php if(form_error('video_link')!='') echo form_error('video_link','<div class="text-danger err">','</div>'); ?>

                               </div>
                               
                        
                            <div class="form-group required">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="details"> Details</label></div>
                              <div class="col-sm-9"> 
                                  <?php $details="";
                                  if(set_value('details')!=''){
                                      $details= set_value('details');                                      
                                  }else{
                                      $details= $recipe['rows'][0]->recipe_detail;                                      
                                  } ?>
                                  <!--<input type="hidden"id="details" name="details" value='<?php //echo $details;?>' >-->
                                  <textarea class="form-control" id="details" name="details" placeholder="Recipe Details"><?php if(set_value('details')!=""){echo set_value('details');}else{echo $recipe['rows'][0]->recipe_detail;}?></textarea>
                                  <span class="text-danger"  id="details_error_nume"></span>
                                  <?php if(form_error('details')!=''){ echo form_error('details','<div class="text-danger err">','</div>'); }?>
                              </div>
                              <span class="text-danger" id="details_error"></span>
                                  
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                              <div class="col-sm-9">
                                  <select class="form-control" id="status" name="status">
                                        <option value="1" <?php if($recipe['rows'][0]->recipe_stetus==1){echo "selected"; } ?> >Active</option>
                                        <option value="0" <?php if($recipe['rows'][0]->recipe_stetus==0){echo "selected"; } ?> >Inactive</option>
                                </select>                                  
                              </div>
                              
                                  
                            </div>
                        
                            
                            <div class="form-group">        
                              <div class="col-sm-offset-9 col-sm-3">
                                  <button type="submit" id="recipebtn" class="btn btn-success btn-block">Submit</button>
                              </div>
                            </div>
                        
                        
                      </form>
                </div>
            </div>
        </div>
   
    </div> 
    </div>
</div>    
<script type="text/javascript">
    $(document).ready(function(){

tinymce.init({
    selector: "textarea",
    plugins: [
                //"advlist   lists print preview  preview    spellchecker",
                //"searchreplace wordcount visualblocks visualchars code  ",
                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify |"
        ,toolbar2:" fontselect fontsizeselect | forecolor backcolor"
        });
       // ,toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        //toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft"
       

    });
</script>
<script>
    $(document).ready(function(){
        $("#RecipeStartDate").datepicker({
            format: "yyyy-mm-dd",
            orientation: "bottom auto",
            todayHighlight: true
        }).css('z-index','100110');
        $("#RecipeEndDate").datepicker({
            format: "yyyy-mm-dd",
            orientation: "bottom auto",
            todayHighlight: true
        }).css('z-index','100110');
       
    });
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
          $("#recipebtn").click(function(){
             // alert("hii");
                  // Alerts the currently selected contents
//alert(tinyMCE.activeEditor.selection.getContent());

// Alerts the currently selected contents as plain text
//alert(tinyMCE.activeEditor.selection.getContent({format : 'text'}));
// Get the HTML contents of the currently active editor
//console.debug(tinyMCE.activeEditor.getContent());

// Get the raw contents of the currently active editor
//alert(tinyMCE.activeEditor.getContent({format : 'raw'}));

// Get content of a specific editor:
//alert(tinyMCE.get('#details').getContent());
              var name = $("#name").val().trim();
              var Type = $("#Type").val().trim();
              var details =tinyMCE.activeEditor.getContent();// $("#details").val().trim();
              //alert(details);
              details=details.replace('<!DOCTYPE html>','')
                .replace('<html>','')
                .replace('<head>','')
                .replace('</head>','')
                .replace('<body>','')
                .replace('</body>','')
                .replace('</html>','').trim();
            details=$.trim(details);
            var image =$("#image").val().trim(); 
              var ext = image.split('.').pop().toLowerCase();
              var allowed_ext=['jpg','png','jpeg'];
              //alert(jQuery.inArray(ext, allowed_ext) == -1);
              var check = jQuery.inArray(ext, allowed_ext) !== -1;
              //alert(check);
             
              //$("#details").val(details);             
              if(Type == ''){
                    //$("#fname_error").html("Enter Your First Name");
                    $("#Type").focus();
                    $("#Type_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(name == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#name").focus();
                    $("#name_error").parent().addClass("has-error");
                    return false;    
              }else
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
              if(Type == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#Type").focus();
                    $("#Type_error").parent().addClass("has-error");
                    return false;    
              }else
              if(details == ''){
                    $("#details_error_nume").html("Recipe details is required field");
                    $("#details").focus();
                    $("#details_error").parent().addClass("has-error");
                    return false;    
              }else{
              return true;}
          });
      });
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_nume").html("Enter Only Numeric Value");
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

