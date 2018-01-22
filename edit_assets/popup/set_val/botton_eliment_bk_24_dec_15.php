<style>

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
              margin-left: -30px;
     -ms-transform: rotate(180deg); /* IE 9 */
    -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
    transform: rotate(180deg);
          }
</style>
<?php include '../db_include.php';   ?>
<?php $pp_name="botton_popup";
$divid=$_REQUEST['divid'];
$data=$_REQUEST['data'];
//$imagepath=$_REQUEST['imagepath'];
//$user_session_id=$_REQUEST['user_id'];
$BASE_URL=$_REQUEST['BASE_URL'];
?><input type="hidden" id="botton_divid"  value="<?php echo $divid;?>">
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_botton()','Change Dynamic Button text');?>
<!--            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Dynamic Button</h3></div>
            </div>-->
           
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                
                 <div class="col-lg-12 text-center" style="background-color: #FFFFFF;"> 
                    <h5>
                        <!--<span class="fa fa-level-up rotate180"></span>-->                        
                         Change Name Your Dynamic Button 
                        <!--<span class="fa fa-level-down "></span>-->                        
                    </h5>
                   </div>
               
                <br/><br/><br/><br/>
                <div class="  col-sm-12 col-xs-12 col-lg-6 col-md-6 col-md-offset-3 col-lg-offset-3">
                    <input class="form-control" type="text" name="" id="botton_data<?php echo $divid;?>" value="<?php echo $data;?>" >
                </div>
                <!---<div class="col-lg-4"><a class=" btn btn-block btn-success" >save</a></div>-->
               
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
        $(<?php echo '"#'.$pp_name.'"';?>).draggable({
        handle: 'n, e, s, w, ne, se, sw, nw'    
            });  
             $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
    
                    
                    function changein_botton()
                        {
                            var divid=$("#botton_divid").val();
                            var data_id=$("#botton_data"+divid).val();
                            //alert($("#"+divid+" p").html());
                            $("#"+divid+" p").html(data_id);
                            d_off(<?php echo '"#'.$pp_name.'"';?>);
                        }
                        function remove_imagediv()
                        {
                            var divid=$("#botton_divid").val();
                            $("#"+divid).remove();
                            d_off(<?php echo '"#'.$pp_name.'"';?>);
                        }
        </script>