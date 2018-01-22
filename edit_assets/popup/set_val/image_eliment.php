<?php include '../db_include.php';   ?>
<?php 
$pp_name="view_prod1000_".$_REQUEST['divid'];
$divid=$_REQUEST['divid'];
$data=$_REQUEST['data'];
$imagepath=$_REQUEST['imagepath'];
//$user_session_id=$_REQUEST['user_id'];
$BASE_URL=$_REQUEST['BASE_URL'];
?>
<input type="hidden" id="image_divid<?php echo '_'.$divid?>"  value="<?php echo $divid;?>">
<style>
            
      ul#daynamicimage_sortable<?php echo '_'.$divid?>, 
      ul#daynamicimage_sortable2<?php echo '_'.$divid?> 
      { 
          list-style-type: none; 
         //margin: 0; 
         padding: 0; 
         width: 100%; 
         min-height: 80px; 
         position: relative;
         
      }
      ul#daynamicimage_sortable<?php echo '_'.$divid?> li, 
      ul#daynamicimage_sortable2<?php echo '_'.$divid?> li 
      {
          
            //background: #4679BD; 
            color: #FFFFFF;
            display:inline-block;
            margin:3px;
            //padding:4px ;
            width:80px;
            //height: 60px;
            min-width: 65px;
            max-width: 80px;
            min-height: 50px;
            max-height: 50px;
            height: 50px;
            vertical-align: middle;
      }   
       ul#daynamicimage_sortable<?php echo '_'.$divid?> li img, 
       ul#daynamicimage_sortable2<?php echo '_'.$divid?> li img 
       { 
            
            max-height: 50px;

       }
      .wrapdaynamicimage_sortable{
         display: table-row-group;
         }
      .wrapdaynamicimage_sortable1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
          // width: 300px;
      } 
      
     
</style>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_botton()','Change Dynamic Image');?>
<!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Dynamic Image</h3></div>
            </div>-->
            
            <?php //include $_REQUEST['BASE_URL'].'edit_assets/popup/popupheadersingle.php';
            include '../popupheadersingle.php';?>  
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                
<!--                 <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>Your Web Menu</h5></div>
                </div>-->
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrapdaynamicimage_sortable1">                    
                    <ul id="daynamicimage_sortable<?php echo '_'.$divid?>" >
                         <li class="daynamicimage_sortable_li<?php echo '_'.$divid?>" id="" value="" >
                            <img class="img img-responsive center-block block" src="<?php echo $imagepath;?>" alt="gallery" >
                        </li>
                        
                </ul>
                </div>
                
            </div>
            <div class=" col-lg-9 col-md-9 col-sm-9 col-xs-12" >
<!--              <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5 text-center>Add And Remove Your Web Menu </h5></div>
            </div>-->
              
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrapdaynamicimage_sortable1">                    
                    <ul id="daynamicimage_sortable2<?php echo '_'.$divid?>" >
                        <?php  
                        $query_c="SELECT `id`, `image_path`, `view` FROM `userProd_image` WHERE  `status`='1' AND  `user_id`='". $user_session_id."' order by `view`";
                        $row_query_c = mysql_query($query_c)or die(mysql_error());
                        if(mysql_fetch_row($row_query_c)==0){echo "Please Upload Some Image";}
                        while ($res_query_c=mysql_fetch_assoc($row_query_c))
                        {
                      ?>                
                        <li class="daynamicimage_sortable2_li<?php echo '_'.$divid?>" id="<?php echo $res_query_c['id'];?>" value="<?php echo $res_query_c['view'];?>">
                            <img class="img img-responsive center-block block" src="<?php echo BASE_URL.'assets/image/gallery/'.$user_session_id.'/'.$res_query_c['image_path'];?>" alt="gallery" >
                        </li>
                 <?php }?>
                </ul>
                </div>
            </div>
            </div>

            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <div class=" col-lg-7 col-md-7 col-sm-6 col-xs-12" >
                    Only ("jpg", "png", "jpeg","JPEG") and Size 1mb
                    for Image Upload Click Here
                    <span class="fa fa-hand-o-right"></span>
                </div>
                <div class=" col-lg-5 col-md-5 col-sm-6 col-xs-12 pull-right" >
                    <?php  
                    include '../image.php';
                    ?>
                    <script type="text/javascript">
                    function imageuploadshown(path,id)
                    {
                        var data='<li  class="daynamicimage_sortable2_li<?php echo '_'.$divid?>" id='+id+' value="0"><img class="img img-responsive center-block block" src='+path+' alt="gallery" ></li>';
                        $('#daynamicimage_sortable2<?php echo '_'.$divid?>').append(data);
                        //alert(path);
                    }
                    </script>
                </div>
            </div>
        </div>
   
    <br/>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-center">                
               <button class="pbb btn-block" onClick='remove_imagediv()'>
                   <span class="fa fa-recycle"></span>Delete
               </button>
            </div>
    
         <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
     <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='changein_botton()'>
                   <span class="fa fa-save"></span>Save
               </button>
            </div>
 </div>
<script type="text/javascript" >
  $(function() 
  {
        var divid=$(this).attr('id');
       var data=$("#"+divid+" p").html();
       var imagepath=$("#"+divid+" p img").attr("src");
       $("#botton_data").val(imagepath);
    });
    
   $(function() 
   { 
       $(<?php echo '"#'.$pp_name.'"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  }).css("cursor", "move");  
    });
        </script>
        
        <script type="text/javascript" >
                    $(function() {                    
                    
                    
                    $( "#daynamicimage_sortable<?php echo '_'.$divid?>" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#daynamicimage_sortable<?php echo '_'.$divid?>, #daynamicimage_sortable2<?php echo '_'.$divid?>",
                        /*receive : function (event, ui)
                        {
                            //short_add_menu_li();
                           $("span#result").html ($("span#result").html () 
                              + ", receive");
                        }*/
                     });
                    
                    $( "#daynamicimage_sortable2<?php echo '_'.$divid?>" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#daynamicimage_sortable<?php echo '_'.$divid?>, #daynamicimage_sortable2<?php echo '_'.$divid?>",
                       /* receive : function (event, ui)
                        {
                            
                            //short_remove_menu_li();
                           $("span#result2").html ($("span#result2").html () 
                              + ", receive");
                        }*/
                     });
                    });
                    
                    
                    
                    function changein_botton()
                    {
                        if($('#daynamicimage_sortable<?php echo '_'.$divid?> li').length==1)
                        {
                            var divid=$("#image_divid<?php echo '_'.$divid?>").val();
                            var data_id=$("#daynamicimage_sortable<?php echo '_'.$divid?> >li img").attr("src");
                            //alert(data_id);
                            var data_id1=data_id.split('<?php echo $BASE_URL?>');
                            //alert(data_id1[1]);
                            //alert($("#"+divid+" p img").attr("src"));
                            $("#"+divid+"  p img").attr("src",data_id);
                            d_off(<?php echo '"#'.$pp_name.'"';?>);
                        }
                        else
                        { 
                            alert('Please select only one banner image');       
                            
                        }
                    }
                    function remove_imagediv()
                    {
                        var divid=$("#image_divid<?php echo '_'.$divid?>").val();
                        $("#"+divid).remove();
                        d_off(<?php echo '"#'.$pp_name.'"';?>);
                    }
                </script>