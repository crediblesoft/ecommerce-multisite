 <link href="<?=BASE_URL?>assets/css/ekko-lightbox.css" rel="stylesheet">
  <script src="<?=BASE_URL?>assets/js/ekko-lightbox.js"></script>

 <script type="text/javascript">
        $(document).ready(function ($) {
            // delegate calls to data-toggle="lightbox"
            $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function() {
                        if (window.console) {
                            return console.log('Checking our the events huh?');
                        }
                    },
                    onNavigate: function(direction, itemIndex) {
                        if (window.console) {
                            return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                        }
                    }
                });
            });
        });
    </script>
<style>
    /* galarry part of user profile start*/  
#galary_portfolio
        {
            display: inline-block;
            list-style: outside none none;
            margin: 0px auto;
            padding: 0;
            position: relative;
        }
        #galary_portfolio>li
        {
            display: inline-block;
            margin: 0px;
            padding: 0;
            position: relative;
        }
        
/*        #galary_portfolio>li:hover{
        cursor: url(<?php echo BASE_URL.'assets/image/move.png'?>), auto;        
        }*/
        #galary_portfolio>li>a
        {
                border-top:  5px solid #EEEEF0;
                border-right: 5px solid #EEEEF0;
                border-left:  5px solid #EEEEF0;
                border-bottom:   5px solid #EEEEF0;
                box-shadow: 0px 0px 20px #3D3D3D;
                display: block;
                padding: 0px;
                margin: 10px;

        }
        #galary_portfolio>li>div
        {
            border-bottom: 5px solid #EEEEF0;
            border-right: 5px solid #EEEEF0;
            border-left:  5px solid #EEEEF0;
            box-shadow: 0px 0px 20px #3D3D3D;
            display: block;
            padding: 0px;
            margin: -10px 10px auto;
            //width: 93%;            
            text-align: center;
            
            
        }
        /* galarry part of user profile end*/ 
        
        #galary_portfolio >li img {
            max-height: 140px;
            min-height: 140px;
            height: 140px;
            
        }
        .no_gal{font-size: 26px;}
        .video_li{margin-right:50px !important;}
        .video_ul{margin-top:20px !important;}
        .custum_h2{color:#3c763d !important};
</style>
<?php echo mouceiconeonhover('#galary_portfolio>li');?>
<div class=""  id="page_no<?php echo '19';?>">
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
        <div class="col-md-6 col-md-offset-3 galary_hader" id="pageno_9" ondblclick="load_popup2('#view_prod','#title_popup<?php echo $pageid9; ?>','<?php echo $pageid9; ?>')" style="<?php echo $btn_theme_style,$pagetitleposition9;?>"><?php echo $pagetitle9;?></div>
    </div>
 <div id="add_item_page_<?php echo $pageid9;?>" class="add_item_page_"></div>
    <!--<img class="image_as" alt="image" src='edit_assets/image/process.gif' style="position: relative;z-index: 1;"/> -->
    <div class="container" ondblclick="load_popup('#view_prod','#gallery_pop')">
        <?php //print_r($user_all_image);   ?>
        
            <ul id="galary_portfolio" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" data-toggle="popover">
                 <div class='col-lg-12 text-center'><h2 class="custum_h2">Images</h2></div>
                <?php 
                if($user_all_image){ 
                foreach ($user_all_image as $galary){ ?>
                <li class="col-xs-6 col-sm-4 col-md-3 col-lg-3 galary_inner_portfolio" id="<?=$galary['id']?>">                    
                    <a data-footer="" data-title="" data-gallery="image" data-toggle="lightbox" href="<?php echo BASE_URL.'assets/image/gallery/'.$session_user_id.'/'.$galary['image_path'];?>">
                    <img class="img-responsive  center-block" src="<?php echo BASE_URL.'assets/image/gallery/'.$session_user_id.'/thumb/'.$galary['image_path'];?>" alt="image" class="thumbimg">
                    </a>
                    
                </li>
                <?php }}else{ 

                if($user_edit_panel){ ?>
                <p class="text-success text-center no_gal">Double click to upload gallery image.</p>
                   <?php  }else{ ?>
                 <p class="text-success text-center no_gal">Currently gallery not available.</p>       
                   <?php }}?>
            </ul> 
        
               
        <div style="border: 2px solid #F5F5F5" class="col-md-12"></div>
           <?php if(!$user_edit_panel){ ?>        
                <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $gallerylinks; ?>
                </ul>
           <?php } ?>
        <div style="border: 2px solid #F5F5F5" class="col-md-12"></div>
                <?php 
                if($video){ ?> 
            <ul id="galary_portfolio" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 video_ul" data-toggle="popover">
                <div class='col-lg-12 text-center'><h2 class="custum_h2">Videos</h2></div>
               <?php foreach ($video as $videos){
                   //print_r($vedios);exit;
                   $str = explode("?",$videos['video_path']);
                                  $status=0;
                                    if(count($str) > 1){
                                    parse_str($str[1],$output);
                                    if(isset($output['v'])){
                                        $url="http://www.youtube.com/v/".$output['v'];
                                    }else{ 
                                        $url='';
                                        $status++;
                                    }
                                    }else{
                                        $url=$videos['video_path'];
                                        $status++;
                                    }
                   // echo $vedios['video_path'];
                    ?>
                <li class="col-xs-6 col-sm-4 col-md-3 col-lg-3 galary_inner_portfolio video_li" id="<?php echo $videos['id']; ?>">                    
                     <?php if($status > 0){ ?>
                             <p height="150">This video does not add properly</p>
                         <?php }else{ ?>
                        <object width="425" height="350">
                            <param name="movie" value="<?=$url?>" />
                            <embed src="<?=$url?>" type="application/x-shockwave-flash" />
                        </object>
                         <?php } ?>
                   
                </li>
                <?php }}else{ 

                if($video){ ?>
                <p class="text-success text-center no_gal">Double click to upload gallery .</p>
                   <?php  }else{ ?>
                 <p class="text-success text-center no_gal">Currently video gallery not available.</p>       
                   <?php }}?>
            </ul> 
            <?php //$this->load->view('../../edit_assets/gellary/demo3/index.php');?>
        
    </div>
</div>
<button class="btn btn-circle btn-success save_change save_gallerychange" data-toggle="popover" onclick="get_gallery_view()" style="position:fixed;top:340px;left:0;display: none;">Save changes</button>
<script type="text/javascript" >
   /*$(function() { $(<?php //echo '".image_as"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  });  
  $(<?php //echo '".image_as"';?>).css("cursor", "move");  
    });*/
    </script>
    
 <?php if($user_edit_panel){ ?>

<script>
  $(function() {
        $('#galary_portfolio').sortable({
            update: function () { $(".save_change").css({"display":"block"}); }
        });
        //$("#galary_portfolio").disableSelection();
    });
    
    function get_gallery_view() {
        $("#loadingmessage").css('display','block');
        var positionarray=new Array();var dividarray=new Array();
            $('#galary_portfolio').children().each(function (i) {
                //a.push($(this).attr('id') + ':' + i);
                var position = i;
                var div_id = $(this).attr('id');
                positionarray.push(position);dividarray.push(div_id)
                //console.log(position);console.log(div_id);
                //save_gallery_view(position,div_id);
            });
            //alert(positionarray);alert(dividarray);
            save_gallery_view(positionarray,dividarray);
        }
    
    function save_gallery_view(position,div_id){
        //var page='footer';
        
        $.ajax({
            type: "POST",
            url: "<?=BASE_URL?>Inserdata/save_gallery_view",
            async: false,
            data: { position:position,div_id:div_id},
            success: function(data){
                $(".save_change").css({"display":"none"});
                $("#loadingmessage").css('display','none');
                console.log(data);    
                }
         });
    }
</script>
<?php } ?>   
