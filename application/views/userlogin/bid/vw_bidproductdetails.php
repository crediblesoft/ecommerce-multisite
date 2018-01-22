<?php

 if($product['res']){
     $product=$product['rows'][0];
     if($product->status==1){
         $status='Active';
     }else{
         $status='Inactive';
     }
?>
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>bid/product"> Bid Product </a> </h4><h5> > product details </h5>
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <?php if($product->bid){ ?>
                                <tr>
                                    <td class="profile_heading">Bid Start Date</td>
                                    <td><?=$product->bid_start_date?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Bid End Date</td>
                                    <td><?=$product->bid_end_date?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Product Purchase Date</td>
                                    <td><?=$product->bid_purchase_date?><small>(If you are get selected as winner of this product. You must purchase this product till <?=$product->bid_purchase_date?> other wise seller can add penalty point in your account)</small></td>
                                </tr>
                            <?php } ?>
                                
                                <tr>
                                    <td class="profile_heading">Date</td>
                                    <td><?=$product->date?></td>
                                </tr>  
                                <tr>
                                    <td width='40%;' class="profile_heading">Image</td>
                                    <td><div class="col-sm-4"><img src="<?=BASE_URL."assets/image/product/thumb/".$product->prod_img?>" class="img-responsive"></div></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Price</td>
                                    <td>$<?=$product->prod_price?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Category</td>
                                    <td><?=$product->category?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Product Name</td>
                                    <td><?=$product->prod_name?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Status</td>
                                    <td><?=$status?></td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
    
            <?php if($bid['res']){  //print_r($bid); ?>               
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
                                    <td align="center"><?=$bidderlist->f_name?>&nbsp;<?=$bidderlist->l_name?></td>
                                    <td align="center"><?=$bidderlist->price?></td>
                                    <td align="center"><?=$bidderlist->add_date?></td>
                                </tr>
                                <?php } ?>   
                            </tbody>
                        </table>
                        <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                        </ul>
                    </div>
            </div>
            <?php } ?>
    
            <?php $currentdate=date('Y-m-d');  if($currentdate > $product->bid_end_date ){ if($winner['res']){  $winnerdetails=$winner['rows'][0]; ?>               
            <div class="col-sm-12">
                <h3>Winner Details</h3>
                <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <tbody>
                                <tr>
                                    <td class="profile_heading">Name</td>
                                    <td><?=$winnerdetails->f_name?>&nbsp;<?=$winnerdetails->l_name?> <?php if($winnerdetails->buyerid == $this->session->userdata("user_id")){ echo "(You)"; } ?> </td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Username</td>
                                    <td><?=$winnerdetails->username?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Bid Price</td>
                                    <td>$<?=$winnerdetails->price?></td>
                                </tr>
                                <?php if($winnerdetails->buyerid == $this->session->userdata("user_id") && $currentdate <= $product->bid_purchase_date && !$trans['res']){ ?>
                                <tr>
                                    <td colspan="2" align="right"><a href="<?=BASE_URL?>bid/pricedetails/<?=$product->auction_id?>/<?php echo $product->sellerid; ?>" id="write_review" class="btn btn-success btn-sm show_spinner"> Pay Now</a></td>
                                </tr>
                                <?php }else if($winnerdetails->review!=''){ ?>
                                <tr>
                                    <td class="profile_heading">Seller Reviews</td>
                                    <td><?=$winnerdetails->review?></td>
                                </tr>
                                <?php }else if($trans['res']){ $taxdetail=$trans['rows'];  ?>
                                
                                <tr>
                                    <td class="profile_heading">Transaction Id</td>
                                    <td><?=$taxdetail->trans_id?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Tax</td>
                                    <td>$<?php echo (($taxdetail->total*$taxdetail->tax)/100);?> &nbsp;&nbsp; (<?php echo $taxdetail->tax;?>) %</td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Shipping</td>
                                    <td>$<?php echo $taxdetail->shippingcharge; ?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Total</td>
                                    <td>$<?php echo (($taxdetail->total*$taxdetail->tax)/100)+$taxdetail->total+$taxdetail->shippingcharge;?></td>
                                </tr>
                                <?php } ?>
                                
                                  
                            </tbody>
                        </table>
                    </div>
            </div>
            <?php } } ?>
        </div>
        
      <?php } ?>   
    </div>
</div>  



<!--
<?=BASE_URL?>payment/index/<?=$product->auction_id?>/<?php echo $product->sellerid; ?>?paymenttype=bidproduct
-->
