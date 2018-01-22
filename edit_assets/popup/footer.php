<?php include 'db_include.php';   ?>
    
        <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>

                
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>"  >
    
    <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','tofuctionsave()','Editing Footer Detail  ');?>  
<!--        <div class="col-lg-12" style="background-color: #DFDFDF;">                
            <div class="col-lg-12 text-center"><h3 >Editing Footer Detail</h3></div>
        </div>-->
        <?php  $udc_query="SELECT `id`, `user_id`, `page_name`, `page_type_data`, `class_name`, `text_data` FROM `db_text` WHERE `user_id`='". $user_session_id."' AND `class_name`='user_footer' ";
               $row_query_udc = mysql_query($udc_query)or die(mysql_error());
            ?>
        <?php  $res_query_udc=  mysql_fetch_assoc($row_query_udc); ?>
        <div class="col-lg-12">  
            <input type="hidden" id="text_id" value="<?php echo $res_query_udc['id'];?>"> 
            <form method="post" action="somepage"> 
                   <textarea name="content" id="user_footer" style="width:100%; height: auto;">
                    <?php echo $res_query_udc['text_data'];?>
                    </textarea>
                </form>
        </div>
    <div class="col-lg-12">  
            <br/>
            <br/>
            <?php /*<div class="col-lg-12 text-center">                
                   <button class="pbb btn-block" onClick="load_popup('#view_prod','#footer_color')">Change the footer Color </button>
            </div>*/?>
            <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                 
                   <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                       <span class="fa fa-close"></span>Close
                   </button>
            </div>
            <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">               
                   <button class="pbb btn-block" onClick='tofuctionsave()'>
                       <span class="fa fa-save"></span>Save
                   </button>
            </div>  
    </div>
 </div>       
            <?php }//echo  BASE_URL;?>
   
<script type="text/javascript" >
   $(function() { $(<?php echo '"#'.$pp_name.'"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  });  
  $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
    
    function tofuctionsave()
    {
        var can='user_footer';
        var data_val=tinyMCE.get('user_footer').getContent();
        data_val=data_val.replace('<!DOCTYPE html>','')
                .replace('<html>','')
                .replace('<head>','')
                .replace('</head>','')
                .replace('<body>','')
                .replace('</body>','')
                .replace('</html>','');
        data_val=$.trim(data_val);
        var text_id=$("#text_id").val();
        $(".footertext").html(data_val);
        about_user_text(text_id,data_val,can);
    }
    
   function about_user_text(text_id,data_val,can)
    {
        $.ajax({
      type: "POST",
      url: "<?php echo BASE_URL?>Inserdata/update_text_data",
      async: false,
      data: { id:text_id,data:data_val,codition:can}
     /* success: function(data){
          if(data){alert('data inserted');location.reload(); }else{alert('data not inserted');}        
            }*/
        });
    }
    
</script>

<script type="text/javascript">
tinymce.init({
        selector: "#user_footer",
        plugins: [
                "advlist   lists print preview  preview    spellchecker",
                "searchreplace wordcount visualblocks visualchars code  ",
                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify |"
        ,toolbar2:" fontselect fontsizeselect | forecolor backcolor"
});</script>

         
