 <?php include 'db_include.php';   ?>
        <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>

                <style>
                    
      #menu_sortable, #menu_sortable2 { 
          list-style-type: none; 
         margin: 0; 
         padding: 0; 
         //width: 80%; 
         min-height: 50px; }
      #menu_sortable li, #menu_sortable2 li { 
         margin: 0 3px 3px 3px; 
         padding: 0.4em; 
         padding-left: 1.5em; 
         margin: 10px 3px 3px;
         font-size: 20px;  
         font-weight: 200; 
         background: #4679BD; 
         color: #FFFFFF;
         // width: 260px;
      }      
      .wrapmenu_sortable{
         display: table-row-group;
         }
      .wrapmenu_sortable1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
          // width: 300px;
      }
      .fa-level-down{
          position: absolute;
          font-size: 50px;          
           color: #4679BD;
      }
      .fa-level-up{
          color: #4679BD;
          position: absolute;
          font-size: 50px;         
          }
          .rotate180{
              margin-left: -50px;
                -ms-transform: rotate(180deg); /* IE 9 */
               -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
               transform: rotate(180deg);
          }
          @media (max-width: 768px) {
              #menu_sortable li, #menu_sortable2 li { 
              font-size: 12px;  
              }
              .fa-level-down,.fa-level-up{
                  font-size: 20px;   
              }.rotate180{
                  margin-left: -10px;
              }
          }
          
   </style>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_menu()','Editing Menu  ');?> 
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Editing Menu</h3></div>
            </div>-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs">
                <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-6" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #FFFFFF;">                
                        <div class="col-lg-12 text-center"><h5>Your Active Menu's </h5></div>
                    </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="background-color: #EBEBEB;"> 
                      <span class="fa fa-level-up rotate180 "></span>
                      Drop Here To Add                      
                  </div>
                </div>
               <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-6" >
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #FFFFFF;">                
                        <div class="col-lg-12 text-center"><h5 text-center>You're All Deactivated  Menu's  </h5></div>
                    </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="background-color: #EBEBEB;"> 
                      Drop Here To Remove
                      <span class="fa fa-level-down"></span>
                  </div>
                </div>
            </div>
            
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-6">
               
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrapmenu_sortable1">                    
                    <ul id="menu_sortable" >
                    <?php  $query="SELECT `id`, `user_id`, `file_path`, `label`, `link`, `parent`, `sort`, `view`, `stetus` FROM `menu` WHERE `stetus`=0 AND `parent`=0 AND  sort=0 AND user_id='". $user_session_id."' order by `view`";
                        $count_nomer_ofmenu=0;
                        $row_query = mysql_query($query)or die(mysql_error());
						$res_query=mysql_fetch_assoc($row_query);
						
						
                       while ($res_query=mysql_fetch_assoc($row_query))
                        {
							//echo '<pre>';
							//print_r($res_query);
						
							$count_nomer_ofmenu++;?>
                    <li id="<?php echo $res_query['id'];?>" value="<?php echo $res_query['view'];?>">
                        
                        <?php echo $res_query['label'];?>
                    </li>
                        <?php }?>
                </ul>
                </div>
                
            </div>
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-6" >
              
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrapmenu_sortable1">                    
                    <ul id="menu_sortable2" >
                        <?php  
                        $query_c="SELECT `id`, `user_id`, `file_path`, `label`, `link`, `parent`, `sort`, `view`, `stetus` FROM `menu` WHERE `stetus`='1'  AND `user_id`='". $user_session_id."'  order by `view` ";        
                        $row_query_c = mysql_query($query_c)or die(mysql_error());
                        while ($res_query_c=mysql_fetch_assoc($row_query_c))
                        {
                      ?>                
                    <li id="<?php echo $res_query_c['id'];?>" value="<?php echo $res_query_c['view'];?>">
                        
                        <?php echo $res_query_c['label'];?>
                    </li>
                 <?php }?>
                </ul>
                </div>
            </div>
               <!--<span class="fa fa-arrows-alt"></span>-->
               
                      
<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12" >         
                <table class="table" id="menu_id" style="text-align: center; display: none;" >
                    <tr>
                        <td>  <label for="menunewtab">Update Menu</label></td>
                        <td>
                            <input type="hidden" id="view_id" value="" >
                            <input type="text" class="form-control" value=""  placeholder="Place Your Menu Name" id="menunewtab" >
                        </td>
                        <td> <button class="pbb btn-block" onClick="update_menu()">Update</button></td>
                    </tr>
                </table>
             </div> 
            
        </div>
    <br/>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs text-center">   
        <span class="fa fa-level-down rotate180"></span>
       Double Click For Update On Menu Tab
       <span class="fa fa-level-up"></span>
       
    </div>
    <br/>
    <br/>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">                
               <button class="pbb btn-block" onClick="load_popup('#view_prod','#menu_add_new_pop')">
                   <span class="fa fa-windows"></span>Add New Menu
               </button>
    </div>
    
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center"> <!--onClick="popup_close('#view_prod','#menu_pop')"--->                
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='changein_menu()'>
                   <span class="fa fa-save" ></span>Save
               </button>
            </div> 
   
    
 </div>
        
            <?php }//echo  BASE_URL;?>
   <script type="text/javascript" >
    $(function() {                    
	var moveinglidi;

    $( "#menu_sortable" ).sortable({
        tolerance: 'pointer',
        cursor: 'pointer',
        dropOnEmpty: true,
        connectWith : "#menu_sortable, #menu_sortable2",
	start:function(){
            moveinglidi=$(this).find("li").attr("id");
        },
//        receive : function (event, ui)
//        {                            
//            showmenuli($(this).find('li').attr('id'));
//            //$(this).sortable('toArray').toString();                            
//                //$("#sortable-9").text (productOrder);
//            //short_add_menu_li();
//           //$("span#result").html ($("span#result").html () + ", receive");
//        },
        update:function(event, ui)
        {
            var lihtml='';
            var botomlihtml='';
            var liid=[];
            var menuliid=[];
            var stetus=false;
            liid=$(this).sortable('toArray');//.toString();
            
            $("#cssmenu ul").find('li').each(function(){
                  menuliid.push($(this).attr('id'));
               }); //alert(menuliid.length);
                //console.log(menuliid);
                for(var j=0;j<liid.length;j++)
               {
                   showmenuli(liid[j]);
                   if($.inArray(liid[j],menuliid)>-1)
                    {//console.log(liid[j]); //this is for remove the data frome main menu
                        menuliid = jQuery.grep(menuliid, function(value) {
                        return value != liid[j];
                      });
                      botomlihtml=botomlihtml+'<div class="col-md-12 ab_f_h"><a id="'+liid[j]+'">'+$("#cssmenu ul #"+liid[j]+" a span").html()+'</a></div> ';
                       lihtml=lihtml+'<li id="'+liid[j]+'">'+$("#cssmenu ul #"+liid[j]).html()+'</li>';
                   }
               }
               for(var i=0;i<menuliid.length;i++)
               { 
                   
                   botomlihtml=botomlihtml+'<div class="col-md-12 ab_f_h" style="display: none;"><a id="'+menuliid[i]+'">'+$("#cssmenu ul #"+menuliid[i]+" a span").html()+'</a></div> ';
                    lihtml=lihtml+'<li id="'+menuliid[i]+'" style="display: none;">'+$("#cssmenu ul #"+menuliid[i]).html()+'</li>';
                }
//                $(this).find('li').each(function(){
//                     //liid=$(this).attr('id');                                     
//                     alert(liid);
//                    //showmenuli(liid); 
//                    if(menuliid==liid){stetus=true;}                                    
//                });
                //alert(botomlihtml);
                $(".aboutusfooter_menu .footermenusameasheader").empty();
                $(".aboutusfooter_menu .footermenusameasheader").append($(botomlihtml));
                $("#cssmenu ul ").empty();
                $("#cssmenu ul").append($(lihtml));
               //alert($(this).sortable('toArray').toString()); 

        }
     });

    $( "#menu_sortable2" ).sortable({
        tolerance: 'pointer',
        cursor: 'pointer',
        dropOnEmpty: true,
        connectWith : "#menu_sortable, #menu_sortable2",
//        receive : function (event, ui)
//        {
//            hidemenuli($(this).find('li').attr('id'));
//            //short_remove_menu_li();
//           //("span#result2").html ($("span#result2").html () + ", receive");
//        }
//        ,
        update:function(event, ui)
        {
            $(this).find('li').each(function(){
            hidemenuli($(this).attr('id'));
            });

	var count1=$("#menu_sortable").children().length;
            if(count1==0){
                alert("You can not remove all menu");
		showmenuli(moveinglidi);
                $("#menu_sortable").sortable('cancel');
            }
//            var lihtml='';
//            $(this).find('li').each(function(){
//                var liid=$(this).attr('id');
//                //hidemenuli(liid);                                
//                lihtml=lihtml+'<li id="'+liid+'">'+$("#cssmenu ul #"+liid).html()+'</li>';
//            });alert(lihtml);
         //hidemenuli($(this).sortable('toArray').toString()); 
        }
     });
    });
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $("#menu_sortable>li,#menu_sortable2>li").dblclick(function () {
                //alert($(this).html()); // gets innerHTML of clicked li
                // gets text contents of clicked li
                $('#menu_id').css('display','block');
$("#menu_pop").animate({ scrollTop: 300 }, 600);
                //var index = $(this).index()+1;
//                alert($(this).val());
//                alert($(this).text());
//                alert($(this).html());
                var text1 = $(this).html().trim();
                $('#menunewtab').val(text1);
                //var value = $(this).attr('data-value');
                var id = $(this).attr('id');                
                $('#view_id').val(id);
                //alert(' id '+id+' text '+text);
                
            });
        });
        function showmenuli(id)
        {//alert("#myTab [meinmenuid='"+id+"']");
           // alert('show id #'+id);
            $("#myTab [meinmenuid='"+id+"']").css('display','block');
            $("#cssmenu ul #"+id).css('display','block');
        }
        function hidemenuli(id)
        {//alert("#myTab [meinmenuid='"+id+"']");
            $("#myTab [meinmenuid='"+id+"']").css('display','none');
            $("#cssmenu ul #"+id).css('display','none');
        }

</script>
<script type="text/javascript" >
   $(function() { 
       $(<?php echo '"#'.$pp_name.'"';?>).draggable({
        handle: 'n, e, s, w, ne, se, sw, nw'    
        });  
        $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
    
    
    function update_menu()
    {
        var sessionid=$("#session").val();
        //var view_p=$('#view_position').val();
        var labal=$('#menunewtab').val();
        var view_id=$('#view_id').val();        
        //$('.wrapmenu_sortable1  > ul > #'+view_id).html(labal);
	$('.wrapmenu_sortable1 ul').find('#'+view_id).html(labal);
        $.ajax({
            type: "POST",
            url: "<?php echo $_REQUEST['BASE_URL']?>Inserdata/update_add_menu",
            async: false,
            data: { userId:sessionid,id:view_id,data:labal},
            success: function(data){
                if(data){
					alert('data inserted');
					location.reload(); 
                   }else{alert('data not inserted');}        
                  }
            });
    }
    function changein_menu()
    {
        short_remove_menu_li();
        short_add_menu_li();
        d_off(<?php echo '"#'.$pp_name.'"';?>);
    }
    function  short_remove_menu_li()
    {
        //document.location.href = '<?php echo BASE_URL?>Inserdata/';
       var sessionid=$("#session").val();
        $('#menu_sortable2').find('li').each(function()
        {
            var index = $(this).index()+1;
            var text = $(this).text();
            var value = $(this).attr('data-value');
            var id = $(this).attr('id');
            //alert('id:- '+id+' index:- '+index+' text:- '+text+' value:- '+value);
            //oclick_save_data(sessionid,id,index)
            $.ajax({
                    type: "POST",
                    url: "<?php echo $_REQUEST['BASE_URL']?>Inserdata/remove_new_menu",
                    async: false,
                    data: { userId:sessionid,id:id,view:index},
                    success: function(data){
                            console.log(data);
                        }
                });
        });
    /* $.post("http://localhost/harvest/data1demo/remove_new_menu",{id:"23"},function(data,status){
        console.log(data);
        console.log(status);
    });*/
    }
 function  short_add_menu_li()
    {
        //document.location.href = '<?php echo $_REQUEST['BASE_URL']?>Inserdata/';
        var sessionid=$("#session").val();
        $('#menu_sortable').find('li').each(function()
        {
        var index = $(this).index()+1;
        var text = $(this).text();
        var value = $(this).attr('data-value');
        var id = $(this).attr('id');
        //alert('id:- '+id+' index:- '+index+' text:- '+text+' value:- '+value);
        //oclick_save_data(sessionid,id,index)
            $.ajax({
                    type: "POST",
                    url: "<?php echo $_REQUEST['BASE_URL']?>Inserdata/update_menu",
                    async: false,
                    data: { userId:sessionid,id:id,view:index},
                    success: function(data) {
                    console.log(data);      
                                    }
                    });
        });
    
   /* $.post("http://localhost/harvest/data1demo/update_menu",{id:"24"},function(data,status){
        console.log(data);
        console.log(status);
    });*/
    }
</script>


         
