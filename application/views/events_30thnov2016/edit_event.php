<style>    option[value='white'] {
                letter-spacing: 2px;    
                background: white;
            }
            option[value='orange'] {
                background: orange;    
            }
            option[value='red'] {
                background: red;
            }
            option[value='black'] {
                background: black;
            }
            option[value='green'] {
                background: green;
            }
            option[value='blue'] {
                background: blue;
            }
            option[value='yellow'] {
                background: yellow;
            }
            option[value='yellowgreen'] {
                background: yellowgreen;
            }
            option[value='violet'] {
                background: violet;
            }
            option[value='turquoise'] {
                background: turquoise;
            }
            option[value='slateblue'] {
                background: slateblue;
            }
            option[value='pink'] {
                background: pink;
            }
            option[value='indigo'] {
                background: indigo;
            }
star{color: red;}
.displaynone{display: none;}

#yourcolorselected{line-height: 34px;}
        </style>
<?php //print_r($events);
if($events['res']){
     $events=$events['rows'][0];
?>

<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>events"> Event</a> </h4><h5> > Edit </h5>
                         <span class="add-button"><a class="btn btn-success" href="<?=BASE_URL?>events/userEventsList"> <span class="glyphicon glyphicon-plus-sign"></span> View Event</a></span>
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>events/updateevent">
                            
                        <input type="hidden" id="eventId" name="eventId" value="<?=$events->id?>" >
                        
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="name"> Title</label></div>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control" id="name" value="<?=$events->event_title?>" name="name" placeholder="Event Title">
                                  <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="name_error"></span>
                                  
                            </div>
                        
                         
                           
                        <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="color"> Color</label></div>
                              <div class=""> 
                                  <div class="col-sm-5">
                                      <select class="form-control" name='color' id="color">
                                              <option selected="" value="<?php echo $events->event_color?>"style="background-color: <?php echo $events->event_color?>;color: #FFFFFF;"><?php //echo $events->event_color?></option>
                                                <option value=""   >Choose...</option>
                                                <option value="orange"  <?php echo set_select('color', 'orange'); ?> >orange</option>
                                                <option value="red"  <?php echo set_select('color', 'red'); ?> >red</option>
                                                <option value="black"  <?php //echo set_select('color', 'black'); ?> >black</option>
                                                <option value="green"  <?php echo set_select('color', 'green'); ?> >green</option>
                                                <option value="blue"  <?php echo set_select('color', 'blue'); ?> >blue</option>
                                                <option value="yellow"  <?php echo set_select('color', 'yellow'); ?> >yellow</option>
                                                <option value="yellowgreen"  <?php echo set_select('color', 'yellowgreen'); ?> >yellowgreen</option>
                                                <option value="violet"  <?php echo set_select('color', 'violet'); ?> >violet</option>
                                                <option value="turquoise"  <?php echo set_select('color', 'turquoise'); ?> >turquoise</option>
                                                <option value="slateblue"  <?php echo set_select('color', 'slateblue'); ?> >slateblue</option>
                                                <option value="pink"  <?php echo set_select('color', 'pink'); ?> >pink</option>
                                                <option value="indigo"  <?php echo set_select('color', 'indigo'); ?> >indigo</option>
<!--                                            <option value="#000000" style="background-color: Black;color: #FFFFFF;"  <?php echo set_select('color', '#000000'); ?> >Black</option>
                                                <option value="#808080" style="background-color: Gray;"  <?php echo set_select('color', '#808080'); ?> >Gray</option>
                                                <option value="#A9A9A9" style="background-color: DarkGray;"  <?php echo set_select('color', '#A9A9A9'); ?> >DarkGray</option>
                                                <option value="#D3D3D3" style="background-color: LightGrey;"  <?php echo set_select('color', '#D3D3D3'); ?> >LightGray</option>
                                                <option value="#FFFFFF" style="background-color: White;"  <?php echo set_select('color', '#FFFFFF'); ?> >White</option>
                                                <option value="#7FFFD4" style="background-color: Aquamarine;"  <?php echo set_select('color', '#7FFFD4'); ?> >Aquamarine</option>
                                                <option value="#0000FF" style="background-color: Blue;"  <?php echo set_select('color', '#0000FF'); ?> >Blue</option>
                                                <option value="#000080" style="background-color: Navy;color: #FFFFFF;"  <?php echo set_select('color', '#000080'); ?> >Navy</option>
                                                <option value="#800080" style="background-color: Purple;color: #FFFFFF;"  <?php echo set_select('color', '#800080'); ?> >Purple</option>
                                                <option value="#FF1493" style="background-color: DeepPink;"  <?php echo set_select('color', '#FF1493'); ?> >DeepPink</option>
                                                <option value="#EE82EE" style="background-color: Violet;"  <?php echo set_select('color', '#EE82EE'); ?> >Violet</option>
                                                <option value="#FFC0CB" style="background-color: Pink;"  <?php echo set_select('color', '#FFC0CB'); ?> >Pink</option>
                                                <option value="#006400" style="background-color: DarkGreen;color: #FFFFFF;"  <?php echo set_select('color', '#006400'); ?> >DarkGreen</option>
                                                <option value="#008000" style="background-color: Green;color: #FFFFFF;"  <?php echo set_select('color', '#008000'); ?> >Green</option>
                                                <option value="#9ACD32" style="background-color: YellowGreen;"  <?php echo set_select('color', '#9ACD32'); ?> >YellowGreen</option>
                                                <option value="#FFFF00" style="background-color: Yellow;"  <?php echo set_select('color', '#FFFF00'); ?> >Yellow</option>
                                                <option value="#FFA500" style="background-color: Orange;"  <?php echo set_select('color', '#FFA500'); ?> >Orange</option>
                                                <option value="#FF0000" style="background-color: Red;"  <?php echo set_select('color', '#FF0000'); ?> >Red</option>
                                                <option value="#A52A2A" style="background-color: Brown;"  <?php echo set_select('color', '#A52A2A'); ?> >Brown</option>
                                                <option value="#DEB887" style="background-color: BurlyWood;"  <?php echo set_select('color', '#DEB887'); ?> >BurlyWood</option>
                                                <option value="#F5F5DC" style="background-color: Beige;"  <?php echo set_select('color', '#F5F5DC'); ?> >Beige</option>-->
                                            </select>
                                  </div><div class="col-sm-2" id="yourcolorselected" style="background-color: <?php echo $events->event_color?>;color: #FFFFFF;">Your Color</div>
                                  <!--<input type="color" class="form-control" id="color" value="<?php //if(set_value('color')==''){echo '#ffffff';}else{echo set_value('color');}?>" name="color" placeholder="Event Color" onkeyup="checknumber(this.id,this.value)" >-->
                                  <?php if(form_error('color')!='') echo form_error('color','<div class="text-danger err">','</div>'); ?>
                                  <span class="text-danger" id="color_error_nume"></span>
                              </div>
                              <span class="text-danger" id="color_error"></span>
                                  
                            </div>
                         
                            <div class="form-group displaynone">
                              <div class=" col-sm-3 col-sm-offset-1"><label class="control-label " for="image"> Image</label></div>
                              <div class="col-sm-4">          
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                Browse… <input multiple="" name="file" type="file">
                                            </span>
                                        </span>
                                        <input class="form-control" id="image" readonly="" value="<?php echo $events->event_image?>" type="text">
                                    
                                    </div>
                                  <span class="text-danger" id="image1_error"></span>
                              </div>
                              <div class="col-sm-4" style="float: right"><img src="<?php $path=''; if($events->event_image==''){$path='event.png';}else{$path=$events->event_image;} echo  BASE_URL."assets/image/CalendarEvents/".$path;?>" height="150px" width="150xp" class="img-responsive img-circle"></div>
                              <span class="text-danger" id="image_error"></span>
                            </div>
                            <div class="form-group displaynone">
                                   <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="video_link">Video Link</label></div>
                                 <div class="col-sm-8">          
                                     <input type="text"  class="form-control" id="video_link" name="video_link" value="<?=$events->event_video?>" placeholder="Video Link" >
                                     <span class="text-danger" id="quantity_error_nume"></span>
                                     <?php if(form_error('video_link')!='') echo form_error('video_link','<div class="text-danger err">','</div>'); ?>
                                 </div>
                                 <span class="text-danger" id="video_link_error"></span>

                            </div>
                        <div class="form-group displaynone">
                                   <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="another_link">Your Another Site Link</label></div>
                                 <div class="col-sm-8">          
                                     <input type="text"  class="form-control" id="another_link" name="another_link" value="<?=$events->event_link?>" placeholder="Video Link" >
                                     <span class="text-danger" id="quantity_error_nume"></span>
                                     <?php if(form_error('another_link')!='') echo form_error('another_link','<div class="text-danger err">','</div>'); ?>
                                 </div>
                                 <span class="text-danger" id="another_link_error"></span>

                               </div>
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="details"> Details</label></div>
                              <div class="col-sm-8">          
                                  <textarea class="form-control" id="details" name="details" placeholder="Event Details"><?=$events->event_detail?></textarea>
                                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="details_error"></span>
                                  
                            </div>
                         
                        
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="quantity"> Start Date</label></div>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control" id="EventStartDate" name="EventStartDate" value="<?=$events->start_date?>" placeholder="Event Start Date" readonly="">
                                  <span class="text-danger" data-provide="datepicker" data-date-format="yyyy-mm-yy" id="quantity_error_nume"></span>
                                  <?php if(form_error('EventStartDate')!='') echo form_error('EventStartDate','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="EventStartDate_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="quantity"> End Date</label></div>
                              <div class="col-sm-8">          
                                  <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-yy" class="form-control" id="EventEndDate" name="EventEndDate" value="<?=$events->end_Date?>" placeholder="Event End Date" readonly="">
                                  <span class="text-danger" id="quantity_error_nume"></span>
                                  <?php if(form_error('EventEndDate')!='') echo form_error('EventEndDate','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="EventEndDate_error"></span>
                                  
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                              <div class="col-sm-8">
                                  <select class="form-control" id="status" name="status">
                                        <option value="1" <?php if($events->stetus==1){echo "selected"; } ?> >Active</option>
                                        <option value="0" <?php if($events->stetus==0){echo "selected"; } ?> >Inactive</option>
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
<!--<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],
        toolbar1: "cut copy paste | undo redo |newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | forecolor backcolor"
       // ,toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        //toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft"

});
</script>-->
<script>
     $(function(){
        $( "#EventStartDate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#EventEndDate").datepicker("option", "minDate", dt);
            }
        });
        $( "#EventEndDate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#EventStartDate").datepicker("option", "maxDate", dt);
            }
        });
    });
//    $(document).ready(function(){
//        $("#EventStartDate").datepicker({
//            format: "yyyy-mm-dd",
//            orientation: "bottom auto",
//            todayHighlight: true
//        }).css('z-index','100110');
//        $("#EventEndDate").datepicker({
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
          $("#color").change(function() {
        var seletedcolor=$(this).val();
        var seletedval=$("#color option:selected" ).text();
        $("#yourcolorselected").text(seletedval);
        $("#yourcolorselected").css('background-color',seletedval);
        //alert($(this).text());
        });
          
          $("#campaign").click(function(){
              //alert("hii");
              
              var name = $("#name").val().trim();
              var color = $("#color").val().trim();
              var details=$("#details").val().trim();
              //var details =tinyMCE.activeEditor.getContent();// $("#details").val().trim();     
                     
              var image =$("#image").val().trim(); 
              
              var video_link = $("#video_link").val().trim();
              var EventStartDate = $("#EventStartDate").val().trim();
              var EventEndDate = $("#EventEndDate").val().trim();
              
              var ext = image.split('.').pop();
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
              if(color == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#color").focus();
                    $("#color_error").parent().addClass("has-error");
                    return false;    
              }
          else if(details == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#details").focus();
                    $("#details_error").parent().addClass("has-error");
                    return false;    
              }
            else
              
//              if(!check){
//                  
//                  $("#image1_error").html("Only JPG|PNG|JPEG Allowed");
//                    $("#image_error").parent().addClass("has-error");
//                    return false;
//              }
//              
//              if(details == ''){
//                    //$("#name_error").html("Enter Your First Name");
//                    $("#details").focus();
//                    $("#details_error").parent().addClass("has-error");
//                    return false;    
//              }
//              if(video_link == ''){
//                    //$("#name_error").html("Enter Your First Name");
//                    $("#video_link").focus();
//                    $("#video_link_error").parent().addClass("has-error");
//                    return false;    
//              }
              if(EventStartDate == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#EventStartDate").focus();
                    $("#EventStartDate_error").parent().addClass("has-error");
                    return false;    
              }
//              if(EventEndDate == ''){
//                    //$("#name_error").html("Enter Your First Name");
//                    $("#EventEndDate").focus();
//                    $("#EventEndDate_error").parent().addClass("has-error");
//                    return false;    
//              }
              else{
              return true;
            }
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

