
<?php include 'db_include.php';   ?>
<?php 
$pp_name="background_popup";

$imagepath=$_REQUEST['imagepath'];
//$user_session_id=$_REQUEST['user_id'];
$BASE_URL=$_REQUEST['BASE_URL'];
?>
<input type="hidden" id="image_divid"  value="<?php echo $divid;?>">
<style>
            
      ul#aboutus_sortable, ul#aboutus_sortable2 { 
          list-style-type: none; 
         margin: 0; 
         padding: 0; 
         width: 100%; 
         min-height: 50px; 
         position: relative
      }
      ul#aboutus_sortable li, ul#aboutus_sortable2 li 
      {
          
          background: #4679BD; color: #FFFFFF;
          display:inline-block;
            margin:5px auto;
            padding:0 ;
            width:80px;
            height: 50px;
      }   
       ul#aboutus_sortable li img, ul#aboutus_sortable2 li img { width: 100%;height: 100%;}
      .wrapaboutus_sortable{
         display: table-row-group;
         }
      .wrapaboutus_sortable1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
          // width: 300px;
      }   
</style>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Editing Detail</h3></div>
            </div>         
            <div class=" col-lg-12">
             <div class=" col-lg-3">
                
                 <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>Your Web Menu</h5></div>
                </div>
               
                <div class="col-md-12 wrapaboutus_sortable1">                    
                    <ul id="aboutus_sortable" >
                         <li class="aboutus_sortable_li" id="" value="" >
                            
                        </li>                        
                </ul>
                    
                </div>
                 <div class="col-lg-12">
                     <input type="color" class="input-sm" id="body_color" onchange="body_color()">
                     
                 </div>
            </div>
            <div class=" col-lg-9" >
              <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5 text-center>Add And Remove Your Web Menu </h5></div>
            </div>
              
                <div class="col-md-12 wrapaboutus_sortable1">                    
                    <ul id="aboutus_sortable2" >
                        <?php  
                        $query_c="SELECT `id`, `image_path`, `view` FROM `userProd_image` WHERE  `status`='1' AND  `user_id`='". $user_session_id."' order by `view`";
                        $row_query_c = mysql_query($query_c)or die(mysql_error());
                        while ($res_query_c=mysql_fetch_assoc($row_query_c))
                        {
                      ?>                
                        <li class="aboutus_sortable2_li" id="<?php echo $res_query_c['id'];?>" value="<?php echo $res_query_c['view'];?>"><img class="img-responsive" src="<?php echo BASE_URL.'assets/image/gallery/'.$user_session_id.'/'.$res_query_c['image_path'];?>" alt="gallery" ></li>
                 <?php }?>
                </ul>
                </div>
            </div>
            </div>
        </div>
   
    <br/>
    <div class="<?php echo $btn_newindow;?>">                
               <button class="pbb btn-block" onClick='remove_imagediv()'>
                  <span class="fa fa-windows"></span> none
               </button>
            </div>
    <br/>
        <div class="<?php echo $btn_cancel;?>">                 
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
    <div class="<?php echo $btn_save;?>">               
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
  });  
  $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
        </script>
        
        <script type="text/javascript" >
                    $(function() {                    
                    
                    
                    $( "#aboutus_sortable" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#aboutus_sortable, #aboutus_sortable2",
                        /*receive : function (event, ui)
                        {
                            //short_add_menu_li();
                           $("span#result").html ($("span#result").html () 
                              + ", receive");
                        }*/
                     });
                    
                    $( "#aboutus_sortable2" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#aboutus_sortable, #aboutus_sortable2",
                       /* receive : function (event, ui)
                        {
                            
                            //short_remove_menu_li();
                           $("span#result2").html ($("span#result2").html () 
                              + ", receive");
                        }*/
                     });
                    });
                    
                    function body_color()
                    {
                        var body_color=$("#body_color").val();
                        alert(body_color);
                         $("body").css("background",body_color);
                    }
                    
                    function changein_botton()
                    {
                        if($('#aboutus_sortable li').length==1)
                        {
                            var divid=$("#image_divid").val();
                            var data_id=$("#aboutus_sortable >li img").attr("src");
                            alert(data_id);
                            //var data_id1=data_id.split('<?php //echo $BASE_URL?>');
                            //alert(data_id1[1]);
                            //alert($("#"+divid+" p img").attr("src"));
                            $("body").css('background','url('+data_id+') no-repeat center fixed').css('background-size','cover');
                        }//
                        else
                        { 
                            alert('please Select only one banner image');       
                            
                        }
                    }
                    function remove_imagediv()
                    {
                        var divid=$("#image_divid").val();
                        $("#"+divid).remove();
                    }
                </script>