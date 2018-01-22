<?php 
include 'db_include.php';  

if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
    {        
    $pp_name=$_REQUEST['pp_name'];
   //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
    ?>
<style>
            
      ul#sortablegalrry, ul#sortablegalarry2 { 
          list-style-type: none; 
         margin: 0; 
         padding: 0; 
         width: 100%; 
         min-height: 50px; 
         position: relative
      }
      ul#sortablegalrry li, ul#sortablegalarry2 li 
      {
          
          //background: #4679BD; 
          color: #FFFFFF;
          display:inline-block;
            margin:5px ;
            //padding:0 ;
            width:80px;           
            min-width: 65px;
            max-width: 80px;
            min-height: 50px;
            max-height: 50px;
            height: 50px;
            vertical-align: middle;
      }   
       ul#sortablegalrry li img, 
       ul#sortablegalarry2 li img { 
           //width: 100%;
           max-height: 50px;}
      .wrap{
         display: table-row-group;
         }
      .wrap1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
           //width: 300px;
      }
</style>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_menu()','Editing Banner  ');?>  
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Editing Banner </h3></div>
            </div>-->
                <?php //include $_REQUEST['BASE_URL'].'edit_assets/popup/popupheader.php';
                include 'popupheader.php';?>    
            <!--<div class="col-lg-12">
                <div class=" col-lg-6" >
                     <div class="col-lg-12" style="background-color: #FFFFFF;">                
                        <div class="col-lg-12 text-center"><h5>Your Selected Banner Image </h5></div>
                    </div>
                  <div class="col-lg-12 text-center" style="background-color: #EBEBEB;"> 
                      Drop Hare To Add
                  </div>
                </div>
                <div class=" col-lg-6" >
                    <div class="col-lg-12" style="background-color: #FFFFFF;">                
                        <div class="col-lg-12 text-center"><h5 text-center>You're All Upload Image </h5></div>
                    </div>
                  <div class="col-lg-12 text-center" style="background-color: #EBEBEB;"> 
                      Drop Hare To Remove
                  </div>
                </div>
            </div>-->
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="col-md-12 wrap1">                    
                    <?php $query="SELECT `id`, `user_id`, `product_id`, `type_ofimage`, `banner_img`, image_path, `status` FROM `userProd_image` WHERE  `status`='1' AND `banner_img`='1' AND  `user_id`='". $user_session_id."' order by `view`";
                        $count_nomer_ofmenu=0;
                        $row_query = mysql_query($query)or die(mysql_error());
                         if(mysql_num_rows($row_query)<1){echo "Please Drop Some Image Here, to add in banner";}
                    ?>
                    <ul id="sortablegalrry" >
                    <?php
                       while ($res_query=mysql_fetch_assoc($row_query))
                        {$count_nomer_ofmenu++;?>
                        <li class="sortable_li" id="<?php echo $res_query['id'];?>" value="<?php echo $res_query['view'];?>" >
                            <img class="img img-responsive center-block block" src="<?php echo BASE_URL.'assets/image/gallery/'.$user_session_id.'/'.$res_query['image_path'];?>" alt="gallery" >
                        </li>
                        <?php }?>
                </ul>
                </div>
                
            </div>
            <div class=" col-lg-9 col-md-9 col-sm-6 col-xs-12" title="Please banner image use only minimum   height 500px and  minimum width 900px">
              
                <div class="col-md-12 wrap1">                    
                    <?php  
                        $query_c="SELECT `id`, `user_id`, `product_id`, `type_ofimage`, `banner_img`, image_path, `status` FROM `userProd_image` WHERE `status`='1' AND  `user_id`='". $user_session_id."' order by `view`";
                        $row_query_c = mysql_query($query_c)or die(mysql_error());
                        if(mysql_num_rows($row_query_c)<1){echo "Please Upload Some Image";}
                    ?>
                    <ul id="sortablegalarry2" >
                        <?php
                        while ($res_query_c=mysql_fetch_assoc($row_query_c))
                        {
                      ?>                
                        <li class="sortablegalarry2_li" id="<?php echo $res_query_c['id'];?>" value="<?php echo $res_query_c['view'];?>">
                            <img class="img img-responsive center-block block" src="<?php echo BASE_URL.'assets/image/gallery/'.$user_session_id.'/'.$res_query_c['image_path'];?>" alt="gallery" >
                        </li>
                 <?php }?>
                </ul>
                </div>
            </div>
               
           <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <div class=" col-lg-7 col-md-7 col-sm-6 col-xs-12" >
                    Only ("jpg", "png", "jpeg","JPEG") and Size 1mb
                    for Image Upload Click Here                    
                    <span class="fa fa-hand-o-right"></span>
                    Please banner image use only minimum   height 500px and  minimum width 900px
                </div>
                <div class=" col-lg-5 col-md-5 col-sm-6 col-xs-12 pull-right" >
                    <?php  
                    include 'image.php';
                    ?>
                    <script type="text/javascript">
                    function imageuploadshown(path,id)
                    {
                        var data='<li class="sortablegalarry2_li" id='+id+' value="0"><img class="img img-responsive center-block block" src='+path+' alt="gallery" ></li>';
                        $('#sortablegalarry2').append(data);
                        //alert(path);
                    }
                    </script>
                </div>
            </div>    
           
            
        </div>
    
    <br>
        <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='changein_menu()'>
                   <span class="fa fa-save"></span>Save
               </button>
            </div>   
    
 </div>
        
            <?php }//echo  BASE_URL;?>
   <script type="text/javascript" >
                    $(function() {                    
                    
                    
                    $( "#sortablegalrry" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#sortablegalrry, #sortablegalarry2",
                        /*receive : function (event, ui)
                        {
                            //short_add_menu_li();
                           $("span#result").html ($("span#result").html () 
                              + ", receive");
                        }*/
                     });
                    
                    $( "#sortablegalarry2" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#sortablegalrry, #sortablegalarry2",
                       /* receive : function (event, ui)
                        {
                            
                            //short_remove_menu_li();
                           $("span#result2").html ($("span#result2").html () 
                              + ", receive");
                        }*/
                     });
                    });
                </script><script type="text/javascript">
        $(document).ready(function () {
            $("#sortablegalrry>li,#sortablegalarry2>li").dblclick(function () {
                //alert($(this).html()); // gets innerHTML of clicked li
                // gets text contents of clicked li
                $('#menu_id').css('display','block');
                //var index = $(this).index()+1;
                var text = $(this).text();
                $('#menunewtab').val(text);
                //var value = $(this).attr('data-value');
                var id = $(this).attr('id');                
                $('#view_id').val(id);
                //alert(' id '+id+' text '+text);
                
            });
        });
</script>
<script type="text/javascript" >
   $(function() { $(<?php echo '"#'.$pp_name.'"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  });  
  $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
    
    
    function changein_menu()
    {
        if($('#sortablegalrry li').length>2)
                    {
            short_remove_menu_li();
            short_add_menu_li();
                    }
                    else
                    {
                        alert('please Select Minimum three banner image');
                    }
    }
    function  short_remove_menu_li()
    {
        //document.location.href = '<?php echo BASE_URL?>Inserdata/';
        var sessionid=$("#session").val();
        $('#sortablegalarry2').find('li').each(function()
        {
        var index = $(this).index()+1;
        var text = $(this).text();
        var value = $(this).attr('data-value');
        var id = $(this).attr('id');
        //alert('id:- '+id+' index:- '+index+' text:- '+text+' value:- '+value);
        //oclick_save_data(sessionid,id,index)
        $.ajax({
      type: "POST",
      url: "<?php echo BASE_URL?>Inserdata/remove_new_gallery",
      async: false,
      data: { userId:sessionid,id:id,view:index},
     /* success: function(data){
          if(data){alert('data inserted');location.reload(); }else{alert('data not inserted');}        
            }*/
        });
        });
    }
 function  short_add_menu_li()
    {
        //document.location.href = '<?php echo BASE_URL?>Inserdata/';
        var sessionid=$("#session").val();
        $('#sortablegalrry').find('li').each(function()
        {
        var index = $(this).index()+1;
        var text = $(this).text();
        var value = $(this).attr('data-value');
        var id = $(this).attr('id');
        //alert('id:- '+id+' index:- '+index+' text:- '+text+' value:- '+value);
        //oclick_save_data(sessionid,id,index)
        $.ajax({
      type: "POST",
      url: "<?php echo BASE_URL?>Inserdata/update_gallery",
      async: false,
      data: { userId:sessionid,id:id,view:index}
    });
        });
    }


    
</script>


         
