<link href='<?php //echo BASE_URL.'edit_assets/css/datetimepicker/css/bootstrap-datetimepicker.min.css'?>' rel='stylesheet' />
<script src='<?php //echo BASE_URL.'edit_assets/css/datetimepicker/js/bootstrap-datetimepicker.min.js'?>'></script>
<?php //print_r($userdata); ?>
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
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>events"> Events</a> </h4><h5> > Add </h5>
                         <span class="add-button">
                             <a class="btn btn-success" href="<?=BASE_URL?>events/userEventsList"> <span class="glyphicon glyphicon-plus-sign"></span> View Event</a></span>
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>events/add">
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="name">Event Title<star>*</star></label></div>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control" id="name" value="<?=set_value('name')?>" name="name" placeholder="Event Title">
                                  <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="name_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="color">Event Color</label></div>
                              <div class=""> 
                                        <div class="col-sm-5">
                                            <select class="form-control" name="color" id="color">
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

                                            </select>
                                        </div>
                                       <div class="col-sm-2" id="yourcolorselected" style="color: #FFFFFF;"> </div>
                                  <!--<input type="color" class="form-control" id="color" value="<?php //if(set_value('color')==''){echo '#ffffff';}else{echo set_value('color');}?>" name="color" placeholder="Event Color" onkeyup="checknumber(this.id,this.value)" >-->
                                  <?php if(form_error('color')!='') echo form_error('color','<div class="text-danger err">','</div>'); ?>
                                  <span class="text-danger" id="color_error_nume"></span>
                              </div>
                              <span class="text-danger" id="color_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group displaynone" >
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label " for="image">Event Image</label></div>
                              <div class="col-sm-8">          
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                Browse… <input multiple="" name="file" type="file">
                                            </span>
                                        </span>
                                          <input class="form-control" id="image" readonly="" type="text">
                                    
                                    </div>
                                  <span class="text-danger" id="image1_error"></span>
                              </div>
                              <span class="text-danger" id="image_error"></span>
                            </div>
                            <div class="form-group displaynone">
                                   <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="video_link">Video Link</label></div>
                                 <div class="col-sm-8">          
                                     <input type="text"  class="form-control" id="video_link" name="video_link" value="<?=set_value('video_link')?>" placeholder="Video Link" >
                                     <span class="text-danger" id="quantity_error_nume"></span>
                                     <?php if(form_error('video_link')!='') echo form_error('video_link','<div class="text-danger err">','</div>'); ?>
                                 </div>
                                 <span class="text-danger" id="video_link_error"></span>

                               </div>
                         <div class="form-group displaynone">
                                   <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="another_link">Another Site Link</label></div>
                                 <div class="col-sm-8">          
                                     <input type="text"  class="form-control" id="another_link" name="another_link" value="<?=set_value('another_link')?>" placeholder="Your Another Site Link" >
                                     <span class="text-danger" id="quantity_error_nume"></span>
                                     <?php if(form_error('another_link')!='') echo form_error('another_link','<div class="text-danger err">','</div>'); ?>
                                 </div>
                                 <span class="text-danger" id="another_link_error"></span>

                          </div>
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="details">Event Details<!--<star>*</star>--></label></div>
                              <div class="col-sm-8">      
                                  <input type="hidden" id="details1" name="details1" value="">
                                  <textarea class="form-control" id="details" name="details" placeholder="Event Details"><?=set_value('details')?></textarea>
                                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="details_error"></span>
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="quantity">Event Start Date<star>*</star></label></div>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control" id="EventStartDate" name="EventStartDate" value="<?=  set_value('EventStartDate')?>" placeholder="Event Start Date" readonly="">
                                  <span class="text-danger" data-provide="datepicker" data-date-format="yyyy-mm-yy" id="quantity_error_nume"></span>
                                  <?php if(form_error('EventStartDate')!='') echo form_error('EventStartDate','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="EventStartDate_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group ">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="quantity">Event End Date</label></div>
                              <div class="col-sm-8">          
                                  <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-yy" class="form-control" id="EventEndDate" name="EventEndDate" value="<?=set_value('EventEndDate')?>" placeholder="Event End Date" readonly="">
                                  <span class="text-danger" id="quantity_error_nume"></span>
                                  <?php if(form_error('EventEndDate')!='') echo form_error('EventEndDate','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="EventEndDate_error"></span>
                                  
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                              <div class="col-sm-8">
                                  <select class="form-control" id="status" name="status">
                                        <option value="1" <?php echo set_select('status', 1); ?> >Active</option>
                                        <option value="0" <?php echo set_select('status', 0); ?> >Inactive</option>
                                </select>                                  
                              </div>
                              
                                  
                            </div>
                        
                            
                            <div class="form-group">        
                              <div class="col-sm-offset-9 col-sm-3">
                                  <button type="submit" id="event" class="btn btn-success btn-block">Submit</button>
                              </div>
                            </div>
                        
                        
                      </form>
                </div>
            </div>
        </div>
        
        
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
    
    
    
    /*$(document).on("submit", "form", function(event)
{
    var details =tinyMCE.get('details').getContent();// $("#details").val().trim();
              details=details.replace('<!DOCTYPE html>','')
                .replace('<html>','')
                .replace('<head>','')
                .replace('</head>','')
                .replace('<body>','')
                .replace('</body>','')
                .replace('</html>','');
            details=$.trim(details);
              $("#details1").val()=details;
            alert(details);
});*/
    //var $j = jQuery.noConflict();
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
        
          $("#event").click(function(){
              //alert("hii");
              
              var name = $("#name").val().trim();
              var color = $("#color").val().trim();
              var details = $("#details").val().trim();
              //var details =tinyMCE.activeEditor.getContent();// $("#details").val().trim();
              /*details=details.replace('<!DOCTYPE html>','')
                .replace('<html>','')
                .replace('<head>','')
                .replace('</head>','')
                .replace('<body>','')
                .replace('</body>','')
                .replace('</html>','');
            details=$.trim(details);
              $("#details").val()=details;
            alert(details);*/
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
              if(EventStartDate == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#EventStartDate").focus();
                    $("#EventStartDate_error").parent().addClass("has-error");
                    return false;    
              }
//              if(!check){
//                  
//                  $("#image1_error").html("Only JPG|PNG|JPEG Allowed");
//                    $("#image_error").parent().addClass("has-error");
//                    return false;
//              }
              
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
          
//          if(EventEndDate == ''){
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


<script type="text/javascript">
  /*$(function() {
    $('#datetimepicker1').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-BR',
        maskInput: true,           // disables the text input mask
        pickDate: true,            // disables the date picker
        pickTime: true,            // disables de time picker
        pick12HourFormat: false,   // enables the 12-hour format time picker
        pickSeconds: true,         // disables seconds in the time picker
        startDate: -Infinity,      // set a minimum date
        endDate: Infinity          // set a maximum date
    });
  });*/
</script>

<script type="text/javascript">
  $(function() {
      
      /*$(document).ready(function(){
        $("#EventStartDate").datepicker({
            format: "yyyy-mm-dd hh:mm:ss",
            orientation: "bottom auto",
            todayHighlight: true
        }).css('z-index','100110');
        $("#EventEndDate").datepicker({
            format: "yyyy-mm-dd hh:mm:ss",
            orientation: "bottom auto",
            todayHighlight: true
        }).css('z-index','100110');
       
    });*/
      
   
  });

    $('#name').keyup(function()
  {
    var yourInput = $(this).val();
    re = /['"\{\}\  ]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      var no_spl_char = yourInput.replace(/['"\{\}\\/]/gi, '');
      $(this).val(no_spl_char);
    }
  });
</script>