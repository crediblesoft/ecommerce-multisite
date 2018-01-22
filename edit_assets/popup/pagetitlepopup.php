<?php include 'db_include.php';   ?>
    
        <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
            $pageid=$_REQUEST['pageid'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>

                
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
    <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','tofuctionsave_aboutus()','Edit page title');?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #DFDFDF;">                
<!--            <div class="col-lg-12 text-center"><h3 >Edit About Us Sort Detail</h3></div>-->
        
            <?php 
                $udc_query="SELECT `page_title`,`id`, `browsertab` FROM `menu` WHERE `user_id`='". $user_session_id."' AND `sub_id`='".$pageid."' AND `parent`='0'";
                //echo $udc_query;
                $row_query_udc = mysql_query($udc_query) or die(mysql_error());
                $numrows=mysql_num_rows($row_query_udc);
            ?>
        <?php  $res_query_udc=  mysql_fetch_assoc($row_query_udc); //echo $res_query_udc['id']; ?>
        <div class="col-lg-12">  
            <input type="hidden" class="textareapageid<?=$pageid?>" value="textarea<?=$pageid?>">
            <input type="hidden" id="text_id_title<?=$pageid?>" value="<?php echo $res_query_udc['id'];?>"> 
            <form method="post" action="somepage"> 
                   <textarea name="content" id="textarea<?=$pageid?>" style="width:100%; height: auto;"><?php echo $res_query_udc['page_title'];?></textarea>
                   <br/> 
                   <label>Browser tab text</label>
                   <br/>
                   <input type="text" id="mainpagetitile<?=$pageid?>" class="form-control" value="<?php echo $res_query_udc['browsertab']?>" >
                   <br/>
                </form>
        </div>
        </div>
    
    
    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">  <!--onClick="popup_close('#view_prod','#aboutus_footer_pop')"-->              
           <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
               <span class="fa fa-close"></span>Close
           </button>
    </div>
    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">               
           <button class="pbb btn-block" onClick='tofuctionsave_title<?=$pageid?>(<?=$pageid?>)'>
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
    
    function tofuctionsave_title<?=$pageid?>(pageid)
    {
        about_us_savetitle<?=$pageid?>(pageid);   
        d_off(<?php echo '"#'.$pp_name.'"';?>);
    }
    function about_us_savetitle<?=$pageid?>(pageid)
    {
       // alert($("#about_us_content").html());
        //alert('done data save');
        var can=$(".textareapageid<?=$pageid?>").val();
        //alert(can);
        var data_val=tinyMCE.get(can).getContent();//tinyMCE.activeEditor.getContent({format : 'raw'});
        //alert(can);
        //alert(data_val);
        data_val=data_val.replace('<!DOCTYPE html>','')
                .replace('<html>','')
                .replace('<head>','')
                .replace('</head>','')
                .replace('<body>','')
                .replace('</body>','')
                .replace('</html>','');
        data_val=$.trim(data_val);
        var text_id=$("#text_id_title"+pageid).val();
        $(".galary_hader").html(data_val);
        var browsertab=$("#mainpagetitile"+pageid).val();
        $("title").text(browsertab);
        //alert(data_val);
        about_user_text_title<?=$pageid?>(text_id,data_val,can,<?=$pageid?>,browsertab);
    }
    
    
   function about_user_text_title<?=$pageid?>(text_id,data_val,can,pageid,browsertab)
    {
        $.ajax({
      type: "POST",
      url: "<?php echo BASE_URL?>Inserdata/update_page_title",
      async: false,
      data: { id:text_id,data:data_val,codition:can,browsertab:browsertab},
     success: function(data){
         //$("#view_prod").find("#pagetitlepopup"+pageid).remove();
            }
        });
    }
    
</script>
<!--#user_aboutus_sort,#user_contectus_sort,#user_TermCondition_sort-->
<?php tinymceincludeallpopup('#textarea'.$pageid);?>
<!--<script type="text/javascript">
tinymce.init({
        selector: "#user_aboutus_sort",
        plugins: [
                "advlist   lists print preview  preview    spellchecker",
                "searchreplace wordcount visualblocks visualchars code  ",
                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify |"
        ,toolbar2:" fontselect fontsizeselect | forecolor backcolor"
});</script>-->

         
