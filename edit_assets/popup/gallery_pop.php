<?php include 'db_include.php';   ?>
    
        <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>  
<style>            
      ul#sortable_gallery, ul#sortable_gallery2 { 
          list-style-type: none; 
         margin: 0; 
         padding: 0; 
         width: 100%; 
         min-height: 50px; 
         position: relative
      }
      ul#sortable_gallery li, ul#sortable_gallery2 li 
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
       ul#sortable_gallery li img, 
       ul#sortable_gallery2 li img 
       { 
           //width: 100%;
           max-height: 50px;
       }
      .wrap{
         display: table-row-group;
         }
      .wrapgallery1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
          // width: 300px;
      }
      
      .wrap_gallery_main{height:300px;overflow:scroll;z-index:0;}
      

.closee{
float: right;
margin-right: -20px;
margin-top: -7px;
}
#delete{
    height: 80px;
border: 1px solid #F00;

padding: 0;
max-height: 100px;
    //background-image:  url("<?php //echo BASE_URL?>edit_assets/image/Trash-icon.png") no-repeat right top;
}#delete li img {max-height: 80px;min-height: 80px;}
   </style>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_menu()','Your Image  Gallery');?> 
        <div class="row">
             
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">
                <span class="closee fa fa-close"></span>
                <div class="col-lg-12 text-center"><h3 >You Image Showing in  Gallery</h3></div>
            </div>         -->

            <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                
                 <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>Drag & Drop for change image position and drag and drop into right side box to remove image  <!--Your Gallery Image--></h5></div>
                </div>
               
                <div class="col-md-12 wrapgallery1">                    
                    <ul id="sortable_gallery" >
                    <?php $query="SELECT `id`, `image_path`, `view` FROM `userProd_image` WHERE   `status`='1'  AND  `user_id`='". $user_session_id."' order by `gallery_view`";
                        $count_nomer_ofmenu=0;
                        $row_query = mysql_query($query)or die(mysql_error());
                        if(mysql_num_rows($row_query)<1){echo "Please Upload Some Image";}
                       while ($res_query=mysql_fetch_assoc($row_query))
                        {$count_nomer_ofmenu++;?>
                        <li class="sortable_gallery_li" id="<?php echo $res_query['id'];?>" value="<?php echo $res_query['view'];?>" >
                            <img class="img img-responsive center-block block" src="<?php echo BASE_URL.'assets/image/gallery/'.$user_session_id.'/'.$res_query['image_path'];?>" alt="gallery" >
                        </li>
                        <?php }?>
                </ul>
                </div>                
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>You can remove image to drop below box<!--Your Gallery Image--></h5></div>
                </div>
                <div class="col-lg-12 wrapgallery1 fa fa-trash">
                     Drop Here To Remove
                    <ul id="delete" class="dl_sortable_gallery" >    
                       
                    </ul>
                    </div>
            </div>
    
            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <div class=" col-lg-7 col-md-7 col-sm-6 col-xs-12" >
                    Only ("jpg", "png", "jpeg","JPEG") and size 4mb
                    for image upload click here
                    <span class="fa fa-hand-o-right"></span>
                </div>
                <div class=" col-lg-5 col-md-5 col-sm-6 col-xs-12 pull-right" >
                    <?php  
                    include 'image.php';
                    ?>
                    
                    <script type="text/javascript">
                    function imageuploadshown(path,id)
                    {
                        var data='<li class="sortable_gallery_li" id='+id+' value="0"><img class="img img-responsive center-block block" src='+path+' alt="gallery" ></li>';
                        $('#sortable_gallery').append(data);
                        var data2='<li class="col-xs-6 col-sm-4 col-md-3 col-lg-3" id='+id+' value="0"><a><img class="img-responsive block center-block" src='+path+' alt="gallery" ></a><div class="block ">Your Add Image</div></li>';
                        $("#galary_portfolio").append($(data2));
                        //alert(path);
                    }
                    </script>
                </div>
            </div>
            
        </div>   
   
    
    <br/>
        <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">             
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span> Close
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
           //$('#delete').text('Drop Hare To Remove');
    // Make all ul.sortable lists into sortable lists
    $('.wrapgallery1>#delete').sortable({
        tolerance: 'pointer',
        cursor: 'pointer',
        dropOnEmpty: true,
        connectWith: '#sortable_gallery ,.dl_sortable_gallery',
        receive: function(event, ui) {
            if(this.id == 'delete') {
                //if(confirm('Are you sire to delete this ')){
                // Remove the element dropped on #sortable-delete
                var view_id=ui.item.attr('id');                
               deletegallery(view_id,'<?php echo BASE_URL?>Inserdata/delete_gallery_getinfo');                
               // }
            } else {
                // Update code for the actual sortable lists
            }          
        }            
    });
});
     function deletegallery(view_id,path)
     {
         $.ajax({
                    type: "POST",
                    url: path,
                    async: false,
                    data: {id:view_id},
                    success: function(data){
                        if($(data)){
                            if(confirm(data)){
                           deletedata(view_id,'<?php echo BASE_URL?>Inserdata/delete_gallery');                             
                            }
                           }else{
                           alert('data delete not successfully some error has been accord please try again after some time');
                           }        
                          }
                      });
     }
     
     function deletedata(view_id,path)
     {
         $.ajax({
                    type: "POST",
                    url: path,
                    async: false,
                    data: {id:view_id},
                    success: function(data){
                        if($(data)){
                            alert('data deleted successfully ');
                            //deletegallery(view_id,'<?php echo BASE_URL?>Inserdata/delete_gallery');
                           $('#'+view_id).remove();
                           $('#galary_portfolio '+'#'+view_id).remove();
                            $('#delete').empty();                          
                           }else{
                           alert('data delete not successfully some error has been accord please try again after some time');
                           }        
                          }
                      });
     }
     
     
     
     
                    $(function() 
                    {
                        $( "#sortable_gallery" ).sortable({
                            tolerance: 'pointer',
                            cursor: 'pointer',
                            dropOnEmpty: true,
                            connectWith : "#sortable_gallery, .dl_sortable_gallery",
                            /*receive : function (event, ui)
                            {
                                //short_add_menu_li();
                               $("span#result").html ($("span#result").html () 
                                  + ", receive");
                            }*/
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
        $('#galary_portfolio').empty();
        var sessionid=$("#session").val();
        $('#sortable_gallery').find('li').each(function()
        {
        var index = $(this).index()+1;
        var text = $(this).text();
        var value = $(this).attr('data-value');
        var id = $(this).attr('id');
        //alert('id:- '+id+' index:- '+index+' text:- '+text+' value:- '+value);
        //oclick_save_data(sessionid,id,index)
        var data='<li class="col-xs-6 col-sm-4 col-md-3 col-lg-3"  value="0"><a><img class="img-responsive block center-block" src='+$(this).find('img').attr('src')+' alt="gallery" ></a></li>';//<div class="block ">Your Add Image</div>
        $("#galary_portfolio").append($(data));
        
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL?>Inserdata/gallery_view",
            async: false,
            data: { userId:sessionid,id:id,view:index},
           /* success: function(data){
                if(data){alert('data inserted');location.reload(); }else{alert('data not inserted');}        
                  }*/
              });
        });
    }
   


    
</script>


         
