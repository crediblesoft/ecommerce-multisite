<style>
    .product_vw_vw_details{padding-top: 7px;}
</style>
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        
        <div class="row">
            <p class="product_vw_head text-center margin-bottom_25">Support A Farm</p>
        </div>
        
        
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 product_vw_main">
      
            
            <div class="row" id="computers">
                <?php if($campaigns['res']){ 
                    foreach($campaigns['rows'] as $campaign){
                        $campaign_details=  strip_tags($campaign->campaign_detail);
                    ?>
                 <div class="col-sm-4 col-md-3 col-xs-12 col-lg-3 system margin-bottom_35">
                     <div class="product_vw_inner_content"> 
                         
                    <div class="thumbnail product_cus_thumb">
                        <div class='product_cus_thumb_inner img img-responsive center-block'>
                        <img src="<?=BASE_URL?>assets/image/campaign/thumb/<?=$campaign->image_path?>" alt="" class="img img-responsive center-block">
                        </div>
                    </div>
                         <div class="caption product_text_caption">
                       <!--<h3>Thumbnail label</h3>-->
                       <p class="product_vw_content margin-bottom_40"><?php echo substr($campaign_details,0,100); if(strlen($campaign_details)>100){echo "...";} ?></p>
                       <div class="row margin-bottom_25">
                       <div class="col-sm-12 col-xs-12">
                           <div class="row">
                               <div class="col-sm-5 col-xs-5 product_vw_price" title="Title">Title</div>
                               <div class="col-sm-7 col-xs-7 campaign_text"><?php echo substr($campaign->campaign_titel,0,9); if(strlen($campaign->campaign_titel)>9){echo "...";} ?></div>
                           </div> 
                           <div class="row">
                               <div class="col-sm-5 col-xs-5 product_vw_price" title="For">For</div>
                               <div class="col-sm-7 col-xs-7 campaign_text">$<?=$campaign->price?></div>
                           </div> 
                           <div class="row">
                               <div class="col-sm-5 col-xs-5 product_vw_price" title="Start Date">Start Date</div>
                               <div class="col-sm-7 col-xs-7 campaign_text"><?=$campaign->start_date?></div>
                           </div> 
                           <?php if($campaign->end_date!='0000-00-00'){ ?>
                           <div class="row">
                               <div class="col-sm-5 col-xs-5 product_vw_price" title="End Date">End Date</div>
                               <div class="col-sm-7 col-xs-7 campaign_text"><?=$campaign->end_date?></div>
                           </div> 
                           <?php } ?>
                       </div>
                       </div> 
                       <div class="row">
                           
                       <div class="col-sm-12 col-xs-12">
                               <?php                                
                                  $campaignid=$campaign->id;
                                  $buyerid=$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'';
                                  $sellerid=$campaign->user_id;
                                  $url=BASE_URL.'payment/index/'.$campaignid.'/'.$sellerid.'/'.$buyerid.'?paymenttype=campaign';
                                  ?>
                           <a href="<?=$url?>" class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/payment.png" class="img img-responsive" height="33" width="124"></a> 
                           <a href="<?=BASE_URL?>campaign/view/<?=$campaign->id?>" class="product_vw_vw_details" role="button">View Details</a>
                       </div>
                       </div>    
                    </div>
                 
                     </div>
                 </div>    
                <?php } }else{ ?>
                <div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system"><h3>Record Not Found</h3></div>
                <?php } ?>
              </div>          
    </div>
            <ul class="row pagination pagination-sm no-margin pull-right">
                   <?php echo $links; ?>
            </ul>
</div>
        
    </div>
</div>      
