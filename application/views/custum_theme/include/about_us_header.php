<?php echo mouceiconeonhover('.user_detaii_image,.user_detaii_content');?>
<?php //print_R($about_position); ?>
<div class=" ">
    <div class="container padding30" >
        <div class="col-md-12 col-lg-12 col-xs-12 col-md-12 about_move_inner" id="about_move_inner"  ondblclick="load_popup('#view_prod','#user_detail_popup')" data-toggle="popover" >
        <?php if($about_position['status'])
            {  ?>
                <?php for($p=0;$p<count($about_position['rows']);$p++)
                { ?>
                <?php if(in_array($about_position['rows'][$p]['position'],array(0,1))&& $about_position['rows'][$p]['div_id']=='abt_img'){ ?>
                    <div class="col-xs-12 col-md-5 user_detaii_image" id="abt_img"> 
                       <img  class="img-responsive" alt="image" src="<?php if($aboutus_image){echo  BASE_URL.'assets/image/gallery/'.$session_user_id.'/'.$aboutus_image;}else{echo  BASE_URL.'edit_assets/image/baground1.jpg';}?>"/> 
                   </div>
                <?php }else if(in_array($about_position['rows'][$p]['position'],array(0,1))&& $about_position['rows'][$p]['div_id']=='userdetaiicontenttexfull'){ ?>    
                    <div class="col-xs-12 col-md-7 user_detaii_content userdetaiicontenttexfull" id="userdetaiicontenttexfull" > 
                       <?php ?>
                       <?php if($user_aboutus_full){
                           print_r($user_aboutus_full);
                       }else{?>
                   <?php } ?>
                   </div>
                <?php } ?> 
            <?php }
             }else{ ?>
                <div class="col-xs-12 col-md-5 user_detaii_image" id="abt_img"> 
                   <img  class="img-responsive" alt="image" src="<?php if($aboutus_image){echo  BASE_URL.'assets/image/gallery/'.$session_user_id.'/'.$aboutus_image;}else{echo  BASE_URL.'edit_assets/image/baground1.jpg';}?>"/> 
                </div>
                <div class="col-xs-12 col-md-7 user_detaii_content userdetaiicontenttexfull" id="userdetaiicontenttexfull" > 
                <?php ?>
                <?php if($user_aboutus_full)
                    {
                    print_r($user_aboutus_full);        
                    }
                    else
                    {?>
                <?php } ?>
               </div>
        <?php } ?>           
        </div>
    </div>
</div>