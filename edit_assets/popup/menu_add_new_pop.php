<style>
    .dl_sortable, .menu_sortable2 { 
        list-style-type: none; 
         margin: 0; 
         padding: 0; 
         //width: 80%; 
         min-height: 50px; }
      .dl_sortable li, .menu_sortable2 li { 
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
 .wrap1{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
           width: 300px;
      }
      .wrap2{
         float:left;
          margin: 35px 0 40px;
          border: 2px solid #555555;
           width: 300px;
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
          .wrap1>#delete{border: 1px solid red;}
</style>
 <?php include 'db_include.php';   ?>
    
        <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name']))
            {
        
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>

                
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>"  >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_menu()','Add New Menu  ');?>  
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Add New Menu</h3></div>
            </div>-->
            <div class="col-lg-12">
                <div class=" col-lg-6" >
                     <div class="col-lg-12" style="background-color: #FFFFFF;">                
                        <div class="col-lg-12 text-center"><h5>Your Add Menu's </h5></div>
                    </div>
                  <div class="col-lg-12 text-center" style="background-color: #EBEBEB;"> 
                      <span class="fa fa-level-up rotate180" ></span>
                      <!--Drop Hare To Add-->                      
                  </div>
                </div>
                <div class=" col-lg-6" >
                    <div class="col-lg-12" style="background-color: #FFFFFF;">                
                        <div class="col-lg-12 text-center"><h5 text-center>Drop Here To Remove<!--You're All Deactivated  Menu's --> </h5></div>
                    </div>
                  <div class="col-lg-12 text-center" style="background-color: #EBEBEB;"> 
                      <!--Drop Hare To Remove-->
                      <span class="fa fa-level-down"></span>
                  </div>
                </div>
            </div>
            
            <div class=" col-lg-6">                
<!--               <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>Your Web Menu</h5></div>
                </div>               -->
                <div class="col-md-12 wrap1">                    
                    <ul id="sortable" class="dl_sortable" >
                    <?php  $query="SELECT `id`, `user_id`, `file_path`, `label`, `link`, `parent`, `sort`, `view`, `stetus` FROM `menu` WHERE  `user_id`='". $user_session_id."' AND `user_created`='1' order by `view`";
                        $count_nomer_ofmenu=0;
                        $row_query = mysql_query($query)or die(mysql_error());
                       while ($res_query=mysql_fetch_assoc($row_query))
                        {$count_nomer_ofmenu++;?>
                    <li id="<?php echo $res_query['id'];?>" value="<?php echo $res_query['view'];?>">
                        <span class="fa fa-arrows-alt"></span>
                        <?php echo $res_query['label'];?>
                    </li>
                        <?php }?>
                </ul>
                </div>                
            </div>
            
            <div class="col-lg-6" >
                    <div class="col-lg-12 wrap1">
                    <ul id="delete" class="dl_sortable" style="height: 45px;">                    
                    </ul>
                    </div>
                    
                </div>
            
            <div class=" col-lg-12">
                <div class="col-lg-12" style="background-color: #FFFFFF;">                
                <div class="col-lg-12 text-center"><h5>Add New Menu's Here </h5></div>
                </div>               
                <div class="col-lg-12 wrap2"> 
                    <table class="table table-bordered" id="menu_id" style="text-align: center; display: block;" >
                        <tr>
                            <td>  <label for="menunewtab">Add New Menu</label></td></tr><tr>
                            <td>
                                <input type="hidden" id="new_view_id" value="<?php $res =mysql_fetch_assoc(mysql_query("SELECT max(id) as id FROM `menu` WHERE  user_id='". $user_session_id."' ")); echo $res['id']+1;?>" ><!--`stetus`=0 AND `parent`=0 AND  sort=0 AND-->
                                <input type="text" id="menu_new_tab"  class="form-control"  placeholder="Add New Menu" >
                                <span class="text-danger error_new_menu_add"></span>
                            </td></tr><tr>
                            <td> <button class="pbb btn-block" onClick="insert_new_menu()">Save Menu</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    <br/>
    
    <br/>
        <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
<!--    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='changein_menu()'>
                   <span class="fa fa-save"></span>Save
               </button>
            </div> -->
 </div>
        
            <?php }//echo  BASE_URL;?>
   <script type="text/javascript" >
       $(function() {
           $('#delete').text('Drop Here To Remove');
    // Make all ul.sortable lists into sortable lists
    $('ul.dl_sortable').sortable({
        tolerance: 'pointer',
        cursor: 'pointer',
        dropOnEmpty: true,
        connectWith: 'ul.dl_sortable',
        receive: function(event, ui) {
            if(this.id == 'delete') {
                if(confirm('are you sire to delete this ')){
                // Remove the element dropped on #sortable-delete
                var view_id=ui.item.attr('id');
                //alert(view_id);
                //$('#'+view_id).remove();
                ui.item.remove();
                 $.ajax({
                    type: "POST",
                    url: "<?php echo BASE_URL?>Inserdata/delete_menu",
                    async: false,
                    data: {id:view_id},
                    success: function(data){
                        if(data){alert('Your data was successfully deleted! ');
                            hide_pop();
                            //location.reload(); 
                           }else{alert('data not delete');}        
                          }
                      });
                 }
            } else {
                // Update code for the actual sortable lists
            }          
        }            
    });
});
                    
                </script>
<script type="text/javascript" >
   $(function() { $(<?php echo '"#'.$pp_name.'"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  });  
  $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
    
    
    function insert_new_menu()
    {
        
        var sessionid=$("#session").val();
        //var view_p=$('#view_position').val();
        var labal=$('#menu_new_tab').val();
        var view_id=$('#new_view_id').val();   
        if(labal==''){
            $('#menu_new_tab').focus();
            $(".error_new_menu_add").empty().text('Required Field');
            return false;
        }
        show_prossesing_image();
        hide_pop();
        $.ajax({
      type: "POST",
      url: "<?php echo BASE_URL?>Inserdata/create_new_menu",
      async: false,
      data: { userId:sessionid,id:view_id,data:labal},
      success: function(data){
          if(data){alert('data inserted');//location.reload(); 
             }else{alert('data not inserted');}        
            }
        });
    }
    
    function hide_pop()
    {
        
        $(<?php echo "'#".$pp_name."'";?>).css('display','none');
        $(<?php echo "'#menu_pop'";?>).css('display','none');
       // window.location.reload();
       setTimeout(function(){
                         window.location.href="<?php echo BASE_URL?>usereditpenal";
                    }, 2000); 
       //setTimeout('reload()', 800);
    }


    
</script>


         
