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
<?php $pp_name="textaria_popup".'_'.$_REQUEST['divid'];
$divid=$_REQUEST['divid'];
$data=$_REQUEST['data'];
//$imagepath=$_REQUEST['imagepath'];
//$user_session_id=$_REQUEST['user_id'];
$BASE_URL=$_REQUEST['BASE_URL'];
?><input type="hidden" id="textaria_divid<?php echo '_'.$divid?>"  value="<?php echo $divid;?>">
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','changein_botton()','Change Dynamic text');?>
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Editing Detail</h3></div>
            </div>         -->
            <div class=" col-lg-12">
                
                
                <div class="col-lg-12 text-center" style="background-color: #FFFFFF;"> 
                    <h5>
                        <!--<span class="fa fa-level-up rotate180"></span>-->                        
                         Change Name Your Dynamic Button 
                        <!--<span class="fa fa-level-down "></span>-->                        
                    </h5>
                      </div>
               
                <br/><br/><br/><br/>
                
                
                <div class="col-lg-12 ">
                    <textarea class="form-control" name="" id="botton_data<?php echo $divid;?>"  style="width:100%; height: auto;"><?php echo $data;?></textarea>
                    <!--<input class="form-control" type="text" name="" id="botton_data<?php echo $divid;?>" value="<?php echo $data;?>" >-->
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
   $(function() { $(<?php echo '"#'.$pp_name.'"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  });  
  $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
    
     function changein_botton()
                    {
                            var divid=$("#textaria_divid<?php echo '_'.$divid?>").val();
                            //var data_id=$("#botton_data"+divid).val();
                             var data_val=tinyMCE.get('botton_data<?php echo $divid;?>').getContent();//tinyMCE.activeEditor.getContent();
                                data_val=data_val.replace('<!DOCTYPE html>','')
                                        .replace('<html>','')
                                        .replace('<head>','')
                                        .replace('</head>','')
                                        .replace('<body>','')
                                        .replace('</body>','')
                                        .replace('</html>','');
                                var data_id=$.trim(data_val);
                            //alert($("#"+divid+" p").html());
                            $("#"+divid+" p").html(data_id);
                            d_off(<?php echo '"#'.$pp_name.'"';?>);
                        }
                   function remove_imagediv()
                    {
                        var divid=$("#textaria_divid<?php echo '_'.$divid?>").val();
                        $("#"+divid).remove();
                        d_off(<?php echo '"#'.$pp_name.'"';?>);
                    }
        </script>
        
 <?php tinymceincludeallpopup('#botton_data'.$divid);?>       
<!--        <script type="text/javascript">
tinymce.init({
        selector: "#botton_data<?php echo $divid;?>",
        plugins: [
                "advlist   lists print preview  preview    spellchecker",
                "searchreplace wordcount visualblocks visualchars code  ",
                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify |"
        ,toolbar2:" fontselect fontsizeselect | forecolor backcolor"
});</script>-->