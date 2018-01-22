<?php

 if($product['res']){
     $product=$product['rows'][0];
     if($product->status==1){
         $status='Active';
     }else{
         $status='Inactive';
     }
  //print_r($product);
?>
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>order"> Manage Order</a> </h4><h5> > product details </h5>
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><?=$product->date?></td>
                                </tr>  
                                <tr>
                                    <td width='40%;'><strong>Image</strong></td>
                                    <td><div class="col-sm-4"><img src="<?=BASE_URL."assets/image/product/thumb/".$product->prod_img?>" class="img-responsive"></div></td>
                                </tr>
                                <tr>
                                    <td><strong>Price</strong></td>
                                    <td>$<?=$product->prod_price?></td>
                                </tr>
                                <tr>
                                    <td><strong>Category</strong></td>
                                    <td><?=$product->category?></td>
                                </tr>
                                <tr>
                                    <td><strong>Product Name</strong></td>
                                    <td><?=$product->prod_name?></td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td><?=$status?></td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
    
            <?php /*if($bid['res']){  //print_r($bid); ?>               
            <div class="col-sm-12">
                <h3>Bidding Details</h3>
                <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Bidder</td>
                                    <td>Price</td>
                                    <td>Date</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                               
                                foreach($bid['rows'] as $bidderlist){
                            ?>    
                                <tr>
                                    <td><?=$bidderlist->f_name?>&nbsp;<?=$bidderlist->l_name?></td>
                                    <td><?=$bidderlist->price?></td>
                                    <td><?=$bidderlist->add_date?></td>
                                </tr>
                                <?php } ?>   
                            </tbody>
                        </table>
                        <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                        </ul>
                    </div>
            </div>
            <?php }*/ ?>
        </div>
        
      <?php } ?>   
    </div>
</div>  



