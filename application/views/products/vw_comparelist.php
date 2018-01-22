<?php //print_r($category); ?>
<div class="container">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 pad-lf-rt">
<!--        <p class="product_vw_head text-center"><?=$category['rows'][0]->category?></p>-->
       
          <?php /*if($product['res']){ ?> 
          <table class="table table-bordered">
        <thead>
            <tr>
                <th width='15%'>&nbsp;</th>
                <?php foreach($product['rows'] as $productImg){ ?>
                <td><img src="<?=BASE_URL?>assets/image/product/thumb/<?=$productImg->prod_img?>" class="img img-responsive center-block"></td>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Name</th>
                <?php foreach($product['rows'] as $productname){ ?>
                <td><?=$productname->prod_name?></td>
                <?php } ?>
            </tr>
            <tr>
                <th>Price</th>
                <?php foreach($product['rows'] as $productprice){ ?>
                <td>$<?=$productprice->prod_price?></td>
                <?php } ?>
            </tr>
            <tr>
                <th>Description</th>
                <?php foreach($product['rows'] as $productdesc){ ?>
                <td width='20%'><?php echo substr($productdesc->pord_detail,0,300); if(strlen($productdesc->pord_detail)>300){echo "...";} ?></td>
                <?php } ?>
            </tr>
            
            <tr>
                <th></th>
                <?php foreach($product['rows'] as $productid){ ?>
                <td align='right'>
                    <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ if($productid->bid_status){ ?>
                    <a href="<?=BASE_URL?>products/yourbid/<?=$productid->id?>" class="btn btn-success" role="button"> YOUR BID</a> 
                    <?php }else{ ?>
                    <a href="<?=BASE_URL?>products/addtocart/<?=$productid->id?>" class="btn btn-success" role="button"> ADD TO CART</a> 
                    <?php } } ?>
                    <a href="<?=BASE_URL?>products/details/<?=$productid->id?>" class="btn btn-warning cus_btn_warning">View Details</a>
                    
                </td>
                <?php } ?>
            </tr>
            
        </tbody>
    </table>
          <?php }*/ ?>  
           
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bdr-head-col-12">
               <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 no-padding col-5-cf-bdr">
                   <img class="img-responsive" alt="border-imag" src="<?=BASE_URL?>assets/image/line-1.png">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 cf-heading-dv">
                    <p class="p1-com-farmer">Compare <?=$category['rows'][0]->category?></p>
                </div>
               <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 no-padding  col-5-cf-bdr">
                <img class="img-responsive" alt="border-imag" src="<?=BASE_URL?>assets/image/line-1.png">
               </div>
           </div>
        
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bdr-head-image-cf">
               <?php foreach($product['rows'] as $product_Data){ ?>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bdr-head-white-cf">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 white-dv-cf">
                       
                       <div class="fruit-img-dv">
                           <div class="product_cus_thumb_inner">
                        <img class="img-responsive fruit-img-cf" alt="Product Image" src="<?=BASE_URL?>assets/image/product/thumb/<?=$product_Data->prod_img?>">
                           </div>
                       </div>
                       <p class="kiwifruit-head"><?=$product_Data->prod_name?></p>
                       <div class="price-tag-dv">
                           <span class="price-span-cf">$<?=$product_Data->prod_price?></span>
<!--                           <img alt="price tag" class="img-responsive price-img" src="<?=BASE_URL?>assets/image/price-tag.png">-->
                       </div>
                       <p class="content-cf-fruit">
                           <?php echo substr($product_Data->pord_detail,0,80); if(strlen($product_Data->pord_detail)>80){echo "...";} ?>
                       </p>
                       
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn-dv-cf">
                        <?php 
                        if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){
                            if($product_Data->bid_status){ 
                        ?> 
                        <a href="<?=BASE_URL?>products/yourbid/<?=$product_Data->id?>" class="btn btn-add-cart-cf" role="button"> YOUR BID</a> 
                    
                        <?php }else{ ?>
                        
                           <a href="<?=BASE_URL?>products/addtocart/<?=$product_Data->id?>" class="btn btn-add-cart-cf" role="button"> ADD TO CART</a>
                        <?php } } ?>
                           &nbsp;&nbsp;
                           <a href="<?=BASE_URL?>products/details/<?=$product_Data->id?>" class="btn btn-view-details">View Details</a>
                       
                       </div>
                    </div>
               </div>
                <?php } ?>
           </div>
        
    </div>
</div>      



