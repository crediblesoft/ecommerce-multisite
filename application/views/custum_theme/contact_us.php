<?php echo mouceiconeonclick('.contact_us_profilepic,#contactusfulltext');?>
<div class="" onclick="" id="page_no<?php echo '19';?>">
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
     <div class="col-md-6 col-md-offset-3 galary_hader" id="pageno_11" ondblclick="load_popup2('#view_prod','#title_popup<?php echo $pageid11; ?>','<?php echo $pageid11; ?>')" style="<?php echo $btn_theme_style,$pagetitleposition11;?>"><?php echo $pagetitle11;//$pageid11?></div>
    </div>
     <div id="add_item_page_<?php echo $pageid11;?>"></div>
    <!--<img class="image_as" alt="image" src='edit_assets/image/process.gif' style="position: relative;z-index: 1;"/> -->
 
    <div class="container" ondblclick="load_popup('#view_prod','#contect_us_popup')">
       
        
       <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6 contact_us_profilepic">
            <img  class="img-responsive" alt="image" src="<?php if($contact_us_pic){echo  BASE_URL.'assets/image/gallery/'.$session_user_id.'/'.$contact_us_pic;}else{echo  BASE_URL.'edit_assets/image/baground1.jpg';}?>"/> 
        </div>
        <div class="col-xs-12 col-md-6 col-sm-6 col-lg-6" id="contactusfulltext">
            <?php ?>
    <?php if($user_contectus_full){
        print_r($user_contectus_full);        
    } ?>
            
        </div>
    </div>
</div>