<?php include 'db_include.php';
if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>
<style>            
      ul#userlogo_sortable, 
      ul#userlogo_sortable2 { 
          list-style-type: none; 
         margin: 0; 
         padding: 0; 
         width: 100%; 
         min-height: 50px; 
         position: relative
      }
      ul#userlogo_sortable li, 
      ul#userlogo_sortable2 li 
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
       ul#userlogo_sortable li img, 
       ul#userlogo_sortable2 li img 
       { 
           //width: 100%;
           //height: 100%;
           max-height: 50px;
       }
      .wrapuserlogo_sortable{
         display: table-row-group;
         }
      .wrapuserlogo_sortable1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
          // width: 300px;
      }
      .texthide{
          display: none;
      }

      
   </style>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>"  >
     
     
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_menu()','Change Site  logo');?>
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center">
                    <span class="glyphicon glyphicon-remove-circle  glyphiconremovecircle" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'></span> 
                    <span class="fa fa-save fasave" onClick='changein_menu()'></span>
                    <h3 ><span class="fa fa-image"></span>Change About-us Image</h3>
                    
                </div>
            </div>   -->
            <?php //$this->load->view("../../edit_assets/popup/popupheader.php");
            //include $_REQUEST['BASE_URL'].'edit_assets/popup/popupheader.php';
            include 'popupheader.php';?>    
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                
<!--                 <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>Your About-us Image</h5></div>
                </div>-->
               
                <div class="col-md-12 wrapuserlogo_sortable1">                    
                     <?php $query="SELECT `id`, `image_path`, `view` FROM `userProd_image` WHERE   `status`='1' AND `about_us_pic`='1' AND  `user_id`='". $user_session_id."' order by `view`";
                        $count_nomer_ofmenu=0;
                        $row_query = mysql_query($query)or die(mysql_error());
                        if(mysql_num_rows($row_query)<1){echo "Please Select Some Image";}
                        ?>
                    <ul id="userlogo_sortable" data-toggle="popover" >
                   <?php while ($res_query=mysql_fetch_assoc($row_query))
                        {$count_nomer_ofmenu++;?>
                        <li  class="userlogo_sortable_li" id="<?php echo $res_query['id'];?>" value="<?php echo $res_query['view'];?>" >
                            <img class="img img-responsive block center-block" src="<?php echo BASE_URL.'assets/image/gallery/'.$user_session_id.'/'.$res_query['image_path'];?>" alt="gallery" >
                        </li>
                        <?php }?>
                </ul>
                </div>
                
            </div>
            <div class=" col-lg-9 col-md-9 col-sm-6 col-xs-12" >
<!--              <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5 text-center>Add And Remove Your About-us Image </h5></div>
            </div>-->
              
                <div class="col-md-12 wrapuserlogo_sortable1" >  
                    <?php $query_c="SELECT `id`, `image_path`, `view` FROM `userProd_image` WHERE  `status`='1' AND  `user_id`='". $user_session_id."' order by `view`";
                        $row_query_c = mysql_query($query_c)or die(mysql_error());
                        if(mysql_num_rows($row_query_c)<1){echo "Please Upload Some Image";}?>
                    <ul id="userlogo_sortable2" data-toggle="popover">
                        <?php                          
                        while ($res_query_c=mysql_fetch_assoc($row_query_c))
                        {
                      ?>                
                        <li  class="userlogo_sortable2_li" id="<?php echo $res_query_c['id'];?>" value="<?php echo $res_query_c['view'];?>">
                            <img class="img img-responsive block center-block" src="<?php echo BASE_URL.'assets/image/gallery/'.$user_session_id.'/'.$res_query_c['image_path'];?>" alt="gallery" >
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
                        var data='<li  class="userlogo_sortable2_li" id='+id+' value="0"><img class="img img-responsive center-block block" src='+path+' alt="gallery" ></li>';
                        $('#userlogo_sortable2').append(data);
                        //alert(path);
                    }
                    </script>
                </div>
            </div>
            
        </div>
   
    <br/>
    <div class="<?php echo $btn_newindow;?>">
        <button class="pbb btn-block" onclick="load_popup('#view_prod','#user_contentdetail_popup')">
            <span class="fa fa-windows" ></span>Text Edit Window
        </button>
    </div>    
        <div class="<?php echo $btn_cancel;?>">                
            <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                <span class="fa fa-close" ></span>Close
            </button>
            </div>
    <div class="<?php echo $btn_save;?> texthide" >                
               <button class="pbb btn-block" onClick='changein_menu()'>
                   <span class="fa fa-save" ></span>Save
               </button>
            </div> 
   
    
 </div>
        
            <?php }//echo  BASE_URL;?>
   <script type="text/javascript" >
                    $(function() {                    
   $("#userlogo_sortable >li").popover({
        content:"<div style='max-width: 300px !important;font-size: 16px;'>Drag Image to change</div>",
        title : 'About Us Image',
        placement:"bottom",       
        trigger:'hover',
        html:true
        //delay: { show: 200, hide: 500 }
    });
    $("#userlogo_sortable2 >li").popover({
        content:"<div style='max-width: 300px !important;'>Drag Image to change</div>",
        title : 'About Us Image',
        placement:"bottom",       
        trigger:'hover',   
         html:true
        //delay: { show: 200, hide: 500 }
    });
                    
                    $( "#userlogo_sortable" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#userlogo_sortable, #userlogo_sortable2",
                        receive : function (event, ui)
                        {
                            $('.texthide').css('display','block');
                            //short_add_menu_li();
                           //$("span#result").html ($("span#result").html () 
                             // + ", receive");
                        }
                     });
                    
                    $( "#userlogo_sortable2" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        connectWith : "#userlogo_sortable, #userlogo_sortable2",
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
            $("#userlogo_sortable>li,#userlogo_sortable2>li").dblclick(function () {
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
        if($('#userlogo_sortable li').length<1||$('#userlogo_sortable li').length>1)
                    {
                        alert('Please select only one logo image');       
                    }
                    else
                    { //alert($("#userlogo_sortable >li").attr("id"));
                        var data_id=$("#userlogo_sortable >li").attr("id");
                        //alert($('.userlogo_sortable_li img').attr('src'));
                       $('#userlogo img').attr('src',$('.userlogo_sortable2_li img').attr('src'));
                       
                       // alert($('.userlogo_sortable2_li img').attr('src'));
                         $.ajax({
                            type: "POST",
                            url: "<?php echo BASE_URL."Inserdata/userlogo_image";?>",
                            async: false,
                            data: { id:data_id}
                           /* success: function(data){
                                if(data){alert('data inserted');location.reload(); }else{alert('data not inserted');}        
                                  }*/
                              });
                         d_off(<?php echo '"#'.$pp_name.'"';?>);
                    }
    }
   


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
                 alert(' asda '+log);
              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });
</script>


         
