<?php include 'db_include.php';   ?>
    
        <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>

                
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
    <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','tofuctionsave_contactus()','Edit Contact Us Sort Detail ');?>
        
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #DFDFDF;">                
<!--            <div class="col-lg-12 text-center"><h3 >Edit Contact Us Short Detail</h3></div>-->
        
    <br/>
    <?php  $udcus_query1="SELECT `id`, `user_id`, `page_name`, `page_type_data`, `class_name`, `text_data` FROM `db_text` WHERE `user_id`='". $user_session_id."' AND `class_name`='user_contectus_sort' ";
            $row_query_udcus1 = mysql_query($udcus_query1)or die(mysql_error());
         $res_query_udcontus=  mysql_fetch_assoc($row_query_udcus1); ?>
     
        <div class="col-lg-12">  
            <input type="hidden" id="text_id2" value="<?php echo $res_query_udcontus['id'];?>"> 
            <form method="post" action="somepage"> 
                   <textarea name="content" id="user_contectus_sort" style="width:100%; height: auto;"><?php if($res_query_udcontus['text_data']!=''){echo $res_query_udcontus['text_data'];}else{echo ' ';}?></textarea>
                </form>
        </div>
    	</div>
   
    
    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">  <!--onClick="popup_close('#view_prod','#aboutus_footer_pop')"-->              
           <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
               <span class="fa fa-close"></span>Close
           </button>
    </div>
    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">               
           <button class="pbb btn-block" onClick='tofuctionsave_contactus()'>
               <span class="fa fa-save"></span>Save
           </button>
    </div>     
 </div>       
            <?php }//echo  BASE_URL;?>
  
<script type="text/javascript" >
   $(function() { $(<?php echo '"#'.$pp_name.'"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  });  
  $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
    
    function tofuctionsave_contactus()
    {
       
        about_us_save2();
       
    d_off(<?php echo '"#'.$pp_name.'"';?>);
    }
    
    function about_us_save2()
    {
        var can='user_contectus_sort';
        var data_val=tinyMCE.activeEditor.getContent();//tinyMCE.get('user_contectus_sort').getContent();//
        data_val=data_val.replace('<!DOCTYPE html>','')
                .replace('<html>','')
                .replace('<head>','')
                .replace('</head>','')
                .replace('<body>','')
                .replace('</body>','')
                .replace('</html>','');
        data_val=$.trim(data_val);
        var text_id=$("#text_id2").val(); 
        $(".ContactInfotext .ab_f_h").html(data_val);
        //alert(text_id);
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
<?php tinymceincludeallpopup('#user_contectus_sort');?>
<!--<script type="text/javascript">
tinymce.init({
        selector: "#user_contectus_sort",
        plugins: [
                "advlist   lists print preview  preview    spellchecker",
                "searchreplace wordcount visualblocks visualchars code  ",
                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify |"
        ,toolbar2:" fontselect fontsizeselect | forecolor backcolor"
});</script>-->

         
