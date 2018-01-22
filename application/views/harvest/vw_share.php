<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>   -->
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <!--<div class="row">
            <p class="product_vw_head text-center">dfdf</p>
        </div>-->
        <?php $transactiondetails=$share['trans_detail']; ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30 margin-top_20 paddign_leftright0" style="background: #F1F1F1;">
            <p style="font-family: Lato Bold;font-size: 20px;border: 1px solid #e7e7e7;padding:10px 0px 10px 13px;border-bottom: 1px solid #fff;">Transaction Details</p>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xs12 campaign_detail_text_block cam_text_head" style="font-size: 14px;">Transaction id:</div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xs12 campaign_detail_text_block"><?php echo $transactiondetails['trans_id'];?></div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xs12 campaign_detail_text_block cam_text_head" style="font-size: 14px;">Name:</div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xs12 campaign_detail_text_block"><?php echo $transactiondetails['name'];?></div>
                <div class="col-sm-3 col-md-3 col-lg-3 col-xs12 campaign_detail_text_block cam_text_head" style="font-size: 14px;">Price:</div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xs12 campaign_detail_text_block">$ <?php echo $transactiondetails['price'];?></div>
            </div>        
        <?php if($transactiondetails['payment_for']=='product'){ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix margin-bottom_30 margin-top_20 paddign_leftright0">
            <p class="featured_seller_head">Product details</p>  
        </div>
        
        <div class="" id="computers">
                    <?php $total=0;
                            $i=0;
                        foreach($share['data'] as $product){
                            $category= $product['options']['Category'];
                            $total+=$product['price'];
                            $image=$product['options']['image'];
                            $prodid=$product['id'];
                    ?>
                 <div class="col-sm-4 col-md-3 col-xs-12 col-lg-3 system margin-bottom_35">
                     <div class="product_vw_inner_content"> 
                         
                    <div class="thumbnail product_cus_thumb">
                        <div class='product_cus_thumb_inner img img-responsive center-block'>
                        <img src="<?=BASE_URL?>assets/image/product/thumb/<?=$product['options']['image']?>" alt="" class="img img-responsive center-block">
                        </div>
                    </div>
                         <div class="caption product_text_caption">
                       <!--<h3>Thumbnail label</h3>-->
                       <!--<p class="product_vw_content margin-bottom_35"><?php //echo substr($product->pord_detail,0,100); if(strlen($product->pord_detail)>100){echo "...";} ?></p>-->
                       <div class="row margin-bottom_25">
                       <div class="col-sm-12 col-xs-12">
                           <div class="row margin-bottom_10">
                               <div class="col-sm-7 col-xs-7 add_to_compare">Category</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price"> <?=$product['options']['Category']?> </div>
                           </div>
                           
                           <div class="row"> 
                               <div class="col-sm-7 col-xs-7 add_to_compare">Price</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price">$<?=$product['price'];?></div>
                           </div>
                       </div>
                       </div>   
                    </div>
                 
                     </div>
                 </div> 
            
                <?php $i++; } ?>
              </div>
        
<!--        <script type="text/javascript">
            $(document).ready(function(){
                $('#share_button').live('click', function(e){
                e.preventDefault();
                FB.ui(
                {
                method: 'feed',
                name: '<?php echo $category; ?>',
                link: '<?php echo BASE_URL; ?>products/details/<?php echo $prodid; ?>',
                picture: '<?=BASE_URL?>assets/image/product/thumb/<?php echo $image; ?>',
                caption: 'Total price : $ <?php echo $total; ?>',
                description: 'I have purchased <?php echo $i; ?> products from harvest.',
                message: ''
                });
                });
            });
        </script>        -->
        
        <div class="row col-md-12 col-lg-12 col-sm-12 col-xs-12 paddign_leftright0">
                               
                               
                    <?php 
                      $list_url = BASE_URL.'products/details/'.$prodid;
                      $rurl = BASE_URL.'share';
                      $img_paath = BASE_URL.'assets/image/fb_share_harvest_logo.png';
                      $summary=  'I have purchased'.$i.'products from harvest. Total price : $'.$total;
                      $title=$category;
                      $fb_app_id='1541384582852340';

                     ?>
            
            
                                    <div class="row" style="float: right;">
                                        <?php
                                        echo '<a target="_blank" title="Share On Facebook" onclick="window.open(\'http://www.facebook.com/dialog/feed?app_id='.$fb_app_id.'&display=popup&ref=share&picture='.$img_paath.'&name='.$title.'&description='.$summary.'&link='.$list_url.'&redirect_uri='.$rurl.'\',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');return false;" href="javascript: void(0)"><img class="img img-responsive pull-right" src = "'.BASE_URL.'assets/image/fbshare.png" alt="fbshare"></a>'; 
                                        ?>
                                                        <script> window.open('', '_self', ''); 
                                                                    <?php if(isset($_GET['post_id'])){ ?> window.close(); <?php } ?>
                                                             </script>
                                                            
                                            <?php
                                                echo '<a target="_blank" style="float:right;padding-right:5px;" title="Share On Twitter" onclick="window.open(\'https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter\',\'_blank\', \'location=yes,width=700,height=400\');return false;" href="https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter"><img class="img img-responsive pull-right" src = "'.BASE_URL.'assets/image/twittershare.png" alt="fbshare"></a>';
                                            ?>
                                    </div>
                               
               
                               
                           </div>
        
        
        
        <?php }else if($transactiondetails['payment_for']=='campeign'){ ?>
                <?php $campaignalldata= $share['data'];
                           if($campagindetails['res']){
                            $campaign=$campagindetails['rows'];
                           ?>
        
        
<!--    <script type="text/javascript">
        $(document).ready(function(){
        $('#share_button').live('click', function(e){
        e.preventDefault();
        FB.ui(
        {
        method: 'feed',
        name: '<?php echo $campaign->campaign_titel; ?>',
        link: '<?php echo BASE_URL; ?>campaign/view/<?php echo $campaign->id; ?>',
        picture: '<?php echo BASE_URL; ?>assets/image/logo.png',
        caption: 'My donation : $ <?php echo $campaignalldata['price']; ?>',
        description: '<?php echo strip_tags($campaign->campaign_detail); ?>',
        message: ''
        });
        });
        });
    </script>-->
        
        <?php 
            $list_url = BASE_URL.'campaign/view/'.$campaign->id;
            $rurl = BASE_URL.'share';
            $img_paath = BASE_URL.'assets/image/fb_share_harvest_logo.png';
            $summary=  'I have donated : $'.$campaignalldata['price'].'. '.strip_tags($campaign->campaign_detail);
            $title=$campaign->campaign_titel;
            $fb_app_id='1541384582852340';
           ?>
        
        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12" style="margin-top: 15px;">
                    <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body pro-detail-left-cus-panel-body text-center img-responsive">
                            <img src="<?=BASE_URL?>assets/image/campaign/<?=$campaign->image_path?>" class="img-responsive center-block">
                        </div>
                    </div>
                    </div>
                </div> 
                <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
                    <div class="col-sm-12">
                           
                        
                           <p class="pro_detail_head clearfix">
                            <span class="col-md-6 paddign_left0"><?=$campaign->campaign_titel?></span>
                           </p>
                           
                            
                           <!--<div class="line1 margin-bottom_15"></div>-->
                           
                           <p class="campaign_detail_content margin-bottom_15">
                               <?=$campaign->campaign_detail?>
                           </p>
                           
                           <div class="panel panel-default">
                            <div class="panel-body pro-detail-left-cus-panel-body">
                                <div class="col-sm-7 col-lg-7 col-md-7" >
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head">Campaign For:</div>
                                    <div class="row col-sm-7 col-md-7 col-lg-7 col-xs-12 add_to_compare">
                                        $<?=$campaign->price?>
                                    </div>
                                </div>
                                
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head">Add Date:</div>
                                    <div class="row col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text">
                                        <?=$campaign->start_date?>
                                    </div>
                                </div>
                                <?php if($campaign->end_date!='0000-00-00'){?>
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head">End Date:</div>
                                    <div class="row col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text">
                                        <?=$campaign->end_date?>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head">Your donation:</div>
                                    <div class="row col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text">
                                        $<?=$campaignalldata['price']?>
                                    </div>
                                </div>
                                
                                </div>
                                <div class="col-sm-5 col-lg-5 col-md-5" style="padding-right: 0px;">
                                    <div class="" style="float: right;">
                                        <?php
                                        echo '<a target="_blank" title="Share On Facebook" onclick="window.open(\'http://www.facebook.com/dialog/feed?app_id='.$fb_app_id.'&display=popup&ref=share&picture='.$img_paath.'&name='.$title.'&description='.$summary.'&link='.$list_url.'&redirect_uri='.$rurl.'\',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');return false;" href="javascript: void(0)"><img class="img img-responsive pull-right" src = "'.BASE_URL.'assets/image/fbshare.png" alt="fbshare"></a>'; 
                                        ?>
                                                        <script> window.open('', '_self', ''); 
                                                                    <?php if(isset($_GET['post_id'])){ ?> window.close(); <?php } ?>
                                                             </script>
                                                            
                                            <?php
                                                echo '<a target="_blank" style="float:right;padding-right:5px;" title="Share On Twitter" onclick="window.open(\'https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter\',\'_blank\', \'location=yes,width=700,height=400\');return false;" href="https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter"><img class="img img-responsive pull-right" src = "'.BASE_URL.'assets/image/twittershare.png" alt="fbshare"></a>';
                                            ?>
                                    </div>
                                </div>    
                                
                            </div>
                        </div>
                       
                             
                       </div></div>
            <?php } ?> 
        <?php } ?>

        
            
    
    </div>
</div>    
