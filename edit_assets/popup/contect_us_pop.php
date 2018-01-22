<?php include 'db_include.php';   ?>
    
        <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>

                <style>
            
      ul#sortable_contactus, ul#sortable_contactus2 { 
          list-style-type: none; 
         margin: 0; 
         padding: 0; 
         width: 100%; 
         min-height: 50px; 
         position: relative
      }
      ul#sortable_contactus li, 
      ul#sortable_contactus2 li 
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
       ul#sortable_contactus li img, 
       ul#sortable_contactus2 li img 
       { 
           //width: 100%;
           max-height: 50px;
       }
      .wrap{
         display: table-row-group;
         }
      .wrap1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
           width: auto;
      }

.texthide{
          display: none;
      }

   </style>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_menu()','Change Contact us Image');?>
<!--            <div class="col-lg-12 text-center" style="background-color: #DFDFDF;">
                <span class="glyphicon glyphicon-remove-circle  glyphiconremovecircle" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'></span> 
                    <span class="fa fa-save fasave" onClick='changein_menu()'></span>
                    <h3 ><span class="fa fa-image"></span>Change Contact us Image</h3>                
            </div>  -->
             <?php //include $_REQUEST['BASE_URL'].'edit_assets/popup/popupheadersingle.php';
             include 'popupheadersingle.php';?>  
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                
<!--                 <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>Your Web Menu</h5></div>
                </div>-->
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrap1">                    
                    <ul id="sortable_contactus" data-toggle="popover">
                    <?php $query="SELECT `id`, `image_path`, `view` FROM `userProd_image` WHERE   `status`='1' AND `contact_us_pic`='1' AND  `user_id`='". $user_session_id."' order by `view`";
                        $count_nomer_ofmenu=0;
                        $row_query = mysql_query($query)or die(mysql_error());
                        if(mysql_num_rows($row_query)<1){echo "Please Select Some Image";}
                       while ($res_query=mysql_fetch_assoc($row_query))
                        {$count_nomer_ofmenu++;?>
                        <li data-toggle="popover" class="sortable_contactus_li" id="<?php echo $res_query['id'];?>" value="<?php echo $res_query['view'];?>" >
                            <img class="img img-responsive center-block block" src="<?php echo BASE_URL.'assets/image/gallery/'.$user_session_id.'/'.$res_query['image_path'];?>" alt="gallery" >
                        </li>
                        <?php }?>
                </ul>
                </div>
                
            </div>
            <div class=" col-lg-9 col-md-9 col-sm-9 col-xs-12" >
<!--              <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5 text-center>Add And Remove Your Web Menu </h5></div>
            </div>-->
              
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrap1">                    
                    <ul id="sortable_contactus2" data-toggle="popover">
                        <?php  
                        $query_c="SELECT `id`, `image_path`, `view` FROM `userProd_image` WHERE  `status`='1' AND  `user_id`='". $user_session_id."' order by `view`";
                        $row_query_c = mysql_query($query_c)or die(mysql_error());
                        if(mysql_num_rows($row_query_c)<1){echo "Please Upload Some Image";}
                        while ($res_query_c=mysql_fetch_assoc($row_query_c))
                        {
                      ?>                
                        <li  class="sortable_contactus2_li" id="<?php echo $res_query_c['id'];?>" value="<?php echo $res_query_c['view'];?>">
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
                </div>
                <div class=" col-lg-5 col-md-5 col-sm-6 col-xs-12 pull-right" >
                    <?php  
                    include 'image.php';
                    ?>
                    <script type="text/javascript">
                    function imageuploadshown(path,id)
                    {
                        var data='<li  class="sortable_contactus2_li" id='+id+' value="0"><img class="img img-responsive center-block block" src='+path+' alt="gallery" ></li>';
                        $('#sortable_contactus2').append(data);
                        //alert(path);
                    }
                    </script>
                </div>
            </div>
        </div>
   
    <br/>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
        <button class="pbb btn-block" onclick="load_popup('#view_prod','#contect_us_text_pop')">
            <span class="fa fa-windows"></span>Text Edit
        </button>
    </div>
    
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                 
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center texthide">                
               <button class="pbb btn-block" onClick='changein_menu()'>
                   <span class="fa fa-save"></span>Save
               </button>
            </div> 
   
    
 </div>
        
            <?php }//echo  BASE_URL;?>
   <script type="text/javascript" >
                    $(function() {                    
                    
                    $("#sortable_contactus >li").popover({
        content:"<div style='max-width: 300px !important;font-size: 16px;'>Drag me to change</div>",
        title : 'Contect Us Image',
        placement:"bottom",       
        trigger:'hover',
        html:true
        //delay: { show: 200, hide: 500 }
    });
    $("#sortable_contactus2 >li").popover({
        content:"<div style='max-width: 300px !important;'>Drag me to change</div>",
        title : 'Contect Us Image',
        placement:"bottom",       
        trigger:'hover',   
         html:true
        //delay: { show: 200, hide: 500 }
    });
                    
                    $( "#sortable_contactus" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#sortable_contactus, #sortable_contactus2",
                        receive : function (event, ui)
                        {
                            $('.texthide').css('display','block');
                            //short_add_menu_li();
                          // $("span#result").html ($("span#result").html () 
                            //  + ", receive");
                        }
                     });
                    
                    $( "#sortable_contactus2" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#sortable_contactus, #sortable_contactus2",
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
            $("#sortable_contactus>li,#sortable_contactus2>li").dblclick(function () {
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
        if($('#sortable_contactus li').length<1||$('#sortable_contactus li').length>1)
                    {
                        alert('Please select only one Contect us image');       
                    }
                    else
                    { //alert($("#sortable_contactus >li").attr("id"));
                        var data_id=$("#sortable_contactus >li").attr("id");
                        $('.contact_us_profilepic img').attr('src',$('.sortable_contactus2_li img').attr('src'));
                         $.ajax({
                            type: "POST",
                            url: "<?php echo BASE_URL?>Inserdata/contectus_image",
                            async: false,
                            data: { id:data_id}
                           /* success: function(data){
                                if(data){alert('data inserted');location.reload(); }else{alert('data not inserted');}        
                                  }*/
                              });
                         d_off(<?php echo '"#'.$pp_name.'"';?>);
                    }
    }
   


    
</script>


         
