<?php define('BASE_URL',  isset($_REQUEST['BASE_URL'])!=""?$_REQUEST['BASE_URL']:"http://localhost/harvest_online/");?> 
 <?php 
//    mysql_connect('localhost','root','root');
//    mysql_select_db('ucodice_harvest');
    mysql_connect('localhost','ucodice_harvest','6g(CoL}VRafQ');
    mysql_select_db('ucodice_harvest');
    $user_session_id=$_REQUEST['user_id'];
    $daynamiceresponcivepopup="window_popup custom col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 pull-left";
    $btn_newindow="col-lg-4 col-md-12 col-sm-12 col-xs-12";
    $btn_cancel="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center";
    $btn_save="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center";
    
    
    $btn_cancel2="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center";
    $btn_save2="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center";
    /*
        'hostname' => 'localhost',
	'username' => 'ucodice_harvest',
	'password' => '6g(CoL}VRafQ',
	'database' => 'ucodice_harvest',     */
    function topheaderpopupsaveclose($close,$save,$data)
    {
        $val='<div class="col-lg-12" style="background-color: #DFDFDF;padding: 10px;">                
                <div class="col-lg-12 text-center" id="popheadericon">
                    <span title="Click for close the popup " class="glyphicon glyphicon-remove-circle  glyphiconremovecircle" onClick='.$close.'></span> 
                    
                    <h3 >'.$data.'</h3>                    
                </div>
            </div> ';
        return $val;
    }
//    <span title="Click for save  changes " class="fa fa-save fasave" onClick="'.$save.'"></span>
    ?>
<style> 
    button .fa {font-size: 16px;margin-right:  5px;}
    h3 .fa {margin-right:  50px;}
li .fa-arrows-alt{
     -ms-transform: rotate(45deg); /* IE 9 */
    -webkit-transform: rotate(45deg); /* Safari */
    transform: rotate(45deg);
    margin-left: 0px !important;
    margin-top: 5px !important;
          }
   </style>
<script>
//$("#popheadericon .glyphiconremovecircle").popover({
//        content:"Click for close the popup ",
//        //title : 'Site popup',
//        //html:true,
//        placement:"bottom",
//        trigger:"hover"
//    });
//
//$("#popheadericon .fasave").popover({
//        content:"Click for save  changes  ",
//        //title : 'Site popup',
//        //html:true,
//        placement:"bottom",
//        trigger:"hover"
//    });

function show_prossesing_image()
{
    $("#loadingmessage").css('display','block');
}
function hide_prossesing_image()
{
    $("#loadingmessage").css('display','none');
}
</script>
<?php 
 function tinymceincludeallpopup($idorname)
    {?>
    <script type="text/javascript">
        tinymce.init({
            selector: "<?php echo $idorname?>",
                plugins: [
                "advlist   lists print preview  preview    spellchecker",
                "searchreplace wordcount visualblocks visualchars code  ",
                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify ",
        toolbar2:" fontselect fontsizeselect | forecolor backcolor"
    });
        </script>
        <?php   }
        
   function getbootstrapoption()
   {
    $value='<option value="12">100%</option>
        <option value="11">91.66%</option> 
        <option value="10">83.33%</option> 
        <option value="9">75%</option>                              
        <option value="8">66.66%</option>
        <option value="7">58.33%</option>
        <option value="6">50%</option>
        <option value="4">41.66%</option>
        <option value="4">33.33%</option>
        <option value="3">25%</option>
        <option value="2">16.66%</option>
        <option value="1">8.33%</option>';
    return $value;
   }   
    ?>