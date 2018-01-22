<style>
    .slr_ads{min-height: 100px;width: 70%;}
    .ads_cnt{word-wrap:break-word; font-size: 15px;}
    .ads_ttl {font-size: 20px;margin-top: 5px;text-transform: uppercase;font-weight: bold;}
    .viw_shp{float:right; margin-top: 5px; font-size: 16px;}
    .viw-shp-a{color: #000 !important; text-decoration: underline;}
    .ful_wdt{background-repeat: no-repeat !important; background-size: 100% !important;}
    .featured_ads{margin-bottom: 20px;}
</style>
<?php 
if($ads['res']){ 
   foreach($ads['rows'] as $adsdata){
       //echo "<pre>";
       //print_r($adsdata);exit;
       //$img=$adsdata->image; ?>
<div class="row featured_ads">
    <div class="container slr_ads ful_wdt" style="background: url('<?=BASE_URL?>assets/image/ads_images/<?=$adsdata->image;?>');">
    <div class="col-lg-12 text-center">
        <span class="viw_shp"><a class="viw-shp-a" target="_blank" href="<?=BASE_URL?><?php echo $adsdata->username;?>/Shope/user_profile">View Shop</a></span>
                        <p class="ads_ttl">
                             <?=$adsdata->title;?>
                        </p>
                        <p class="ads_cnt">
                            <?=$adsdata->content;?>
                        </p>
    </div>
    </div>
</div>
        <?php }}//exit;
?>
<?php //print_r($featureduser); ?>
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <div class="col-sm-12">
            
                <p class="featured_seller_head text-center margin-bottom_50">Featured Seller</p>
            
            
            
            <?php 
                if($featureduser['res']){
                    foreach($featureduser['rows'] as $userlist){
            ?>
            <div class="row">
                <div class="col-sm-3 col-md-2 col-lg-2 col-xs-8">
                    <div class="featured_seller_img_upper">
                    <div class="featured_seller_img">
                    <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userlist->profile_Pic?>" class="img img-responsive img-rounded center-block">
                    </div>
                    </div>    
                </div>
                <div class="col-sm-9 col-md-10 col-lg-10 col-xs-12">
                    <div class="featured_seller_username margin-bottom_10"><?=$userlist->username?></div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Name
                    </div>
                    
                    <div class="col-sm-1 col-md-1 col-lg-1">:</div>
                    
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->f_name?> &nbsp; <?=$userlist->l_name?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business Name
                    </div>
                    
                    <div class="col-sm-1 col-md-1 col-lg-1">:</div>
                    
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->business_name?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business Type
                    </div>
                    
                    <div class="col-sm-1 col-md-1 col-lg-1">:</div>
                    
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->business_type?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business Address
                    </div>
                    
                    <div class="col-sm-1 col-md-1 col-lg-1">:</div>
                    
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->address?> , <?=$userlist->zip?>
                    </div>
                    
                    
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 pull-right">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                        <a href="<?=BASE_URL?><?=$userlist->username?>/Shope/user_profile" target="_blank" class="btn btn-warning cus_btn_warning"> View Shop </a>
                        </div>
                        
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                        <a href="<?=BASE_URL?>sellerprofile/<?=$userlist->username?>" class="btn btn-success cus_btn_success"> View Profile </a>
                        </div>
                    </div>
                </div>
            </div>
            <p class="featured_seller_border2_new">&nbsp;</p>
                <?php } } else{ ?>
            <p>No any user as a featured</p>
                <?php } ?>
            <ul class="pagination pagination-sm no-margin pull-right">
                   <?php echo $links; ?>
            </ul>
            
            
            
        </div>
    </div>
</div> 
