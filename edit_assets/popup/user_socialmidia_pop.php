<?php include 'db_include.php';   ?>

       <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>

                <style>
            
      ul#sortable, ul#sortable2 { 
          list-style-type: none; 
         margin: 0; 
         padding: 0; 
         width: 100%; 
         min-height: 50px; 
         position: relative
      }
      ul#sortable li, ul#sortable2 li 
      {
          
          //background: #4679BD; 
          //color: #FFFFFF;
          display:inline-block;
            margin:5px auto;
            padding:0 ;
            //width:80px;
            height: 50px;
            float: right;
      }   
       ul#sortable li img, 
       ul#sortable2 li img { 
                height: 100%;}
      .wrap{
         display: table-row-group;
         }
      .wrap1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
          // width: 300px;
      }



   </style>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_menu_midia()','Editing Social Media Detail  ');?>
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Editing Banner </h3></div>
            </div>         -->
            <div class=" col-lg-12">
                
               <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>Your Web Menu</h5></div>
                </div>
               
                <div class="col-md-12 wrap1">                    
                    <ul id="sortable" >
                    <?php $query="SELECT so.`id`, so.`title`, so.url, so.image as image1, so.`status`,su.`id` as social_link_id, su.`user_id` as user_id,su.`view` as view, su.`social_id`, su.`link`, su.`image` as image2  FROM `social_link_user` su inner join `social_link`  so on so.`id`=su.`social_id` WHERE  su.`user_id`='". $user_session_id."' AND so.`status`='1' order by `view`";
                        $count_nomer_ofmenu=0;
                        $row_query = mysql_query($query)or die(mysql_error());
                       while ($res_query=mysql_fetch_assoc($row_query))
                        {$count_nomer_ofmenu++;?>
                        <li class="sortable_li" id="<?php echo $res_query['social_link_id'];?>" value="<?php echo $res_query['view'];?>" >
                            <img class="img-responsive " src="<?php echo BASE_URL.'assets/image/social/'.$res_query['image1'];?>" alt="gallery" >
                        </li>
                        <?php }?>
                </ul>
                </div>
<!--        <li id="<?php echo $val->id?>">
                    <a target = '_blank' href="<?php echo $val->url.$val->link;?>" >
                        <img class="img-rounded img-responsive" src="<?php echo BASE_URL.'assets/image/social/'.$val->image1;?>" >
                    </a>
                </li>          -->
            </div>
            
        </div>
    
    <br>
        <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='changein_menu_midia()'>
                   <span class="fa fa-save"></span>Save
               </button>
            </div>   
    
 </div>
        
            <?php }//echo  BASE_URL;?>
   <script type="text/javascript" >
    $(function() {                    


    $( "#sortable" ).sortable({
        tolerance: 'pointer',
        cursor: 'pointer',
        dropOnEmpty: true,
        connectWith : "#sortable",
        update : function (event, ui)
        {
            var lihtml='';
            var botomlihtml='';
            var liid=[];
            var menuliid=[];
            var stetus=false;
            liid=$(this).sortable('toArray');//.toString();
            
                $(".socialmidialink .social_m").find('li').each(function(){
                  menuliid.push($(this).attr('id'));
               }); //alert(menuliid.length);
                //console.log(menuliid);
                for(var j=0;j<liid.length;j++)
                {
                    
                    if($.inArray(liid[j],menuliid)>-1)
                     {//console.log(liid[j]); //this is for remove the data frome main menu
                         menuliid = jQuery.grep(menuliid, function(value) {
                         return value != liid[j];
                       });
                       
                        lihtml=lihtml+'<li id="'+liid[j]+'"><a target = "_blank" ><img class="img-rounded img-responsive" src= "'+$(".socialmidialink .social_m  #"+liid[j]+" a img").attr('src')+' "></li>';
                    }
                }
//                for(var i=0;i<menuliid.length;i++)
//                { 
//                   
//                   
//                    lihtml=lihtml+'<li id="'+menuliid[i]+'" style="display: none;">'+$("#cssmenu ul #"+menuliid[i]).html()+'</li>';
//                }
               // alert(lihtml);
                $(".socialmidialink .social_m ").empty();
                $(".socialmidialink .social_m").append($(lihtml));
               //alert($(this).sortable('toArray').toString());
        }
     });


    });
                </script><script type="text/javascript">
        $(document).ready(function () {
            $("#sortable>li,#sortable2>li").dblclick(function () {
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
    
    
    
 function  changein_menu_midia()
    {
        
        var sessionid=$("#session").val();
        $('#sortable').find('li').each(function()
        {
        var index = $(this).index()+1;
        var text = $(this).text();
        var value = $(this).attr('data-value');
        var id = $(this).attr('id');
        //alert('id:- '+id+' index:- '+index+' text:- '+text+' value:- '+value);
        //oclick_save_data(sessionid,id,index)
        $.ajax({
      type: "POST",
      url: "<?php echo BASE_URL?>Inserdata/update_socialmedia",
      async: false,
      data: { userId:sessionid,id:id,view:index}
    });
        });
    }


    
</script>

         
