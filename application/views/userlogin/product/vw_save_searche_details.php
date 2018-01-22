<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>-->
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>product/savesearches"> Saved Searches</a> </h4><h5> > details</h5>
                         <!--<span class="add-button"><a href="<?=BASE_URL?>product/savesearches" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Save Searches</a></span>-->
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                   
                       <div class="col-sm-12 product_vw_main margin-bottom_15">
                           <div class="" id="computers">
                               <?php if($products['res']){ 
                                   $productname=array();
                                   foreach($products['rows'] as $product){
                                       array_push($productname, $product->prod_name);
                                   ?>
                                <div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system margin-bottom_35" 
                                                        data-price="<?=$product->prod_price?>" 
                                                        data-certification="<?=$product->certification?>" 
                                                        data-size="<?=$product->size?>">
                                    <div class="product_vw_inner_content"> 
                                        
                                   <div class="thumbnail product_cus_thumb">
                                        <div class='product_cus_thumb_inner img img-responsive center-block'>
                                        <img src="<?=BASE_URL?>assets/image/product/thumb/<?=$product->prod_img?>" alt="" class="img img-responsive center-block">
                                        </div>
                                    </div>
                                   <div class="caption product_text_caption">
                       <!--<h3>Thumbnail label</h3>-->
                       <p class="product_vw_content margin-bottom_35"><?php echo substr($product->pord_detail,0,100); if(strlen($product->pord_detail)>100){echo "...";} ?></p>
                       <div class="row margin-bottom_25">
                       <div class="col-sm-12 col-xs-12">
                           <div class="row">
                               <div class="col-sm-5 col-xs-5 product_vw_price">$<?=$product->prod_price?></div>
                           </div>        
                       </div>
                       </div> 
                       <div class="row">
                       <div class="col-sm-12 col-xs-12">

                                       <?php if($product->bid_status){ ?>
                                       
                                             <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/yourbid/<?=$product->prod_id?>" <?php }else{ ?> href="javascript:void(0)" title="seller can not bid" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/yourbid.png" class="img img-responsive" height="33" width="124"></a> 
                                         <?php }else{ ?>
                                             <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/addtocart/<?=$product->prod_id?>" <?php }else{ ?> href="javascript:void(0)" title="seller can not add use to cart" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/addtocart.png" class="img img-responsive" height="33" width="124"></a> 
                                       <?php } ?>
                                         
                               
                               <a href="<?=BASE_URL?>products/details/<?=$product->prod_id?>" class="product_vw_vw_details" role="button">View Details</a>
                       </div>
                       </div>    
                    </div>
                                </div>    
                                </div>
                               <?php } }else{ ?>
                <div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system"><h3>Record Not Found</h3></div>
                <?php } ?>
                             </div>
                           <ul class="pagination pagination-sm no-margin pull-right">
                                  <?php //echo $links; ?>
                           </ul>
                       </div>
                   
               
            </div>
    
    
    
        
<!--        <div class="row col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <img id ="share_button" class="img img-responsive pull-right" src = "<?php echo BASE_URL; ?>assets/image/fbshare.png" alt="fbshare">
        </div>-->


<?php 
    $list_url = BASE_URL.'products/savesearchdetails/'.$searchid;
    $rurl = BASE_URL.'product/searchdetails/'.$searchid;
    $img_paath = BASE_URL.'assets/image/fb_share_harvest_logo.png';
    $summary=  'I have save searched These products :'.implode(',',$productname);
    $title=$categoryname;
    $fb_app_id='1541384582852340';

    echo '<a target="_blank" title="Share On Facebook" onclick="window.open(\'http://www.facebook.com/dialog/feed?app_id='.$fb_app_id.'&display=popup&ref=share&picture='.$img_paath.'&name='.$title.'&description='.$summary.'&link='.$list_url.'&redirect_uri='.$rurl.'\',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');return false;" href="javascript: void(0)"><img class="img img-responsive pull-right" src = "'.BASE_URL.'assets/image/fbshare.png" alt="fbshare"></a>'; 
?>
   <script> window.open('', '_self', ''); 
                                        <?php if(isset($_GET['post_id'])){ ?> window.close(); <?php } ?>
                                 </script>

<?php
    echo '<a target="_blank" style="float:right;padding-right:10px;" title="Share On Twitter" onclick="window.open(\'https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter\',\'_blank\', \'location=yes,width=700,height=400\');return false;" href="https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter"><img class="img img-responsive pull-right" src = "'.BASE_URL.'assets/image/twittershare.png" alt="fbshare"></a>';
?>
    
        </div>
        
        
    </div>
</div>


<!--<script type="text/javascript">
    $(document).ready(function(){
    $('#share_button').live('click', function(e){
    e.preventDefault();
    FB.ui(
    {
    method: 'feed',
    name: '<?php echo $categoryname; ?>',
    link: '<?php echo BASE_URL; ?>products/<?php echo $catid; ?>',
    picture: '<?php echo BASE_URL; ?>assets/image/logo.png',
    caption: '',
    description: 'I have save searched These products : <?php echo implode(',',$productname); ?>',
    message: ''
    });
    });
    });
</script>-->


