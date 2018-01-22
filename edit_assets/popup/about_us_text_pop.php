<?php include 'db_include.php';   

if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>                
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #DFDFDF;">                
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','tofuctionsave()','Editing About Us Full Detail');?>
<!--            <div class="col-lg-12 text-center">
                <span class="glyphicon glyphicon-remove-circle  glyphiconremovecircle" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'></span> 
                    <span class="fa fa-save fasave" onClick='tofuctionsave()'></span>
                <h3 ><span class="fa fa-text-width"></span>Editing About Us Full Detail</h3>
            </div>-->
       
        <?php  $udc_query="SELECT `id`, `user_id`, `page_name`, `page_type_data`, `class_name`, `text_data` FROM `db_text` WHERE `user_id`='". $user_session_id."' AND `class_name`='user_aboutus_full' ";
               $row_query_udc = mysql_query($udc_query)or die(mysql_error());
            ?>
        <?php  $res_query_udc=  mysql_fetch_assoc($row_query_udc); ?>
        <div class="col-lg-12">  
            <input type="hidden" id="text_id" value="<?php echo $res_query_udc['id'];?>"> 
            <form method="post" action="somepage"> 
                   <textarea name="content" id="user_aboutus_full" style="width:100%; height: auto;">
                    <?php echo $res_query_udc['text_data'];?>
                    </textarea>
                </form>
        </div>
             </div>
    
    <br/><br/><br/>
    <?php /* for change position image and text?>
    <div class="<?php echo $btn_newindow;?>">
        <button class="pbb btn-block" onclick="load_popup('#view_prod','#user_contentdetail_popup')">
            <span class="fa fa-windows"></span>Text Edit Window
        </button>
    </div>    <?php */?>
        <div class="<?php echo $btn_cancel2;?>">                
            <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                <span class="fa fa-close"></span>Close
            </button>
            </div>
    <div class="<?php echo $btn_save2;?>">                
               <button class="pbb btn-block" onClick='tofuctionsave()'>
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
    
    function tofuctionsave()
    {
        //about_us_save1();
        about_us_save2();
        d_off(<?php echo '"#'.$pp_name.'"';?>);
    }
    
    function about_us_save2()
    {
        var can='user_aboutus_full';
        var data_val=tinyMCE.get('user_aboutus_full').getContent();//tinyMCE.get('user_aboutus_full').getContent({format : 'raw'});
        data_val=data_val.replace('<!DOCTYPE html>','')
                .replace('<html>','')
                .replace('<head>','')
                .replace('</head>','')
                .replace('<body>','')
                .replace('</body>','')
                .replace('</html>','');
        data_val=$.trim(data_val);
        var text_id=$("#text_id").val(); 
        $(".userdetaiicontenttexfull").html(data_val);
        //alert(data_val);
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
<!--#user_aboutus_full,#user_aboutus_sort"-->
<?php tinymceincludeallpopup('textarea');?>
<script type="text/javascript">
//$(document).ready(function(){    
//    tinymce.init({
//            selector: "textarea",
//                plugins: [
//                "advlist   lists print preview  preview    spellchecker",
//                "searchreplace wordcount visualblocks visualchars code  ",
//                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
//        ],
//        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify |"
//        ,toolbar2:" fontselect fontsizeselect | forecolor backcolor"
//    });
//
//});
</script>

         
