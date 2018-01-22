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
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>product"> Manage Product</a> </h4><h5> > View </h5>
<?php if($this->session->userdata('user_type')=='1'){ ?>
                         <span class="add-button"><a href="<?=BASE_URL?>product/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Product</a></span>
<?php } ?>
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
                                    <td><?=$product->bid_purchase_date?></td>
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
                                    <td class="profile_heading">Available Quantity</td>
                                    <td><?=$product->no_of_Prod?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Category</td>
                                    <td><?=$product->category?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Sub-Category</td>
                                    <td><?=$product->sub_category?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Product Name</td>
                                    <td><?=$product->prod_name?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Weight</td>
                                    <td><?=$product->weight?> <?=$product->weight_unit?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Dimensions(l*w*h)</td>
                                    <td><?=$product->length?>*<?=$product->width?>*<?=$product->height?>  <?=$product->die_unit?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Status</td>
                                    <td><?=$status?></td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
    
            <?php if($product->bid){ if($bid['res']){  //print_r($bid); ?>               
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
                                    <td align="center">$<?=$bidderlist->price?></td>
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
    <?php //print_r($trans);exit;
    //echo $product->bid_purchase_date;echo"___".$trans['res'];
    ?>
            <?php $currentdate=date('Y-m-d');  if($currentdate > $product->bid_end_date ){ if($winner['res']){  $winnerdetails=$winner['rows'][0]; ?>               
            <div class="col-sm-12">
                <h3>Winner Details</h3>
                <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <tbody>
                                <tr>
                                    <td class="profile_heading">Name</td>
                                    <td><?=$winnerdetails->f_name?>&nbsp;<?=$winnerdetails->l_name?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Username</td>
                                    <td><?=$winnerdetails->username?></td>
                                </tr>
                                <tr>
                                    <td class="profile_heading">Bid Price</td>
                                    <td>$<?=$winnerdetails->price?></td>
                                </tr> <!--  -->
                                <?php if($currentdate > $product->bid_purchase_date && !$trans['res'] && $winnerdetails->review==''){  ?>
                                <tr>
                                    <td colspan="2" align="right">
                                        <a href="javascript:void(0);" id="write_review" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Penalty point</a>
                                        <a href="<?=BASE_URL?>product/rebid/<?=$product->prod_id?>" id="re-auction" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add to re-bid </a>
                                    </td>
                                </tr>
                                <?php }else if($winnerdetails->review!='' ){ ?>
                                <tr>
                                    <td class="profile_heading">Your Reviews</td>
                                    <td><?=$winnerdetails->review?></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2" align="right">
                                        <a href="<?=BASE_URL?>product/rebid/<?=$product->prod_id?>" id="re-auction" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add to re-bid </a>
                                    </td>
                                </tr>
                                <?php }else if($trans['res']){  $taxdetail=$trans['rows'];  ?>
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
                                    <td class="profile_heading">Admin Commission</td>
                                    <td>$<?php echo $taxdetail->commission;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Total Price</td>
                                    <td>$<?php echo ($taxdetail->total-$taxdetail->commission)+(($taxdetail->total*$taxdetail->tax)/100)+$taxdetail->shippingcharge;?></td>
                                </tr>
                                
                                <tr>
                                    <td class="profile_heading">Total</td>
                                    <td>$<?php echo (($taxdetail->total*$taxdetail->tax)/100)+$taxdetail->total+$taxdetail->shippingcharge;?></td>
                                </tr>
                                
                                
                                <?php if($currentdate > $product->bid_purchase_date){ ?>
                                <tr>
                                    <td colspan="2" align="right">
                                        <a href="<?=BASE_URL?>product/rebid/<?=$product->prod_id?>" id="re-auction" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add to re-bid </a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                                  
                            </tbody>
                        </table>
                    </div>
            </div>
    
    
            <div class="col-sm-12 clearfix margin-bottom_30">
                
                <div class="text-danger" id="sratError" style="clear:both;"></div>
                <div id="result-add"></div>
                <form action="<?php echo BASE_URL; ?>product/addreview" method="post" style="display: none;" id="addreviews_add">
                    <div class="write_reviews_main">
                        
                    <div class="form-group star_main_div"> 
<!--                    <div class="stars">
                          <input class="star star-5" id="star-5" type="radio" name="star"/>
                          <label class="star star-5" onClick="star1(5)" for="star-5"></label>
                          <input class="star star-4" id="star-4" type="radio" name="star"/>
                          <label class="star star-4" onClick="star1(4)" for="star-4"></label>
                          <input class="star star-3" id="star-3" type="radio" name="star"/>
                          <label class="star star-3" onClick="star1(3)" for="star-3"></label>
                          <input class="star star-2" id="star-2" type="radio" name="star"/>
                          <label class="star star-2" onClick="star1(2)" for="star-2"></label>
                          <input class="star star-1" id="star-1" type="radio" name="star"/>
                          <label class="star star-1" onClick="star1(1)" for="star-1"></label>     
                    </div>-->
<!--                        <input type="hidden" class="form-control" id="srars" name="stars" value="0">-->
                    <input type="hidden" class="form-control" id="prodid" name="prodid" value="<?php echo $product->prod_id; ?>">
                    <input type="hidden" class="form-control" id="bidid" name="bidid" value="<?php echo $winnerdetails->bidid; ?>">
                    <input type="hidden" class="form-control" id="revuserId" name="revuserId" value="<?php echo $winnerdetails->buyerid; ?>">
                    </div>     
                    <div class="form-group" id="revG">
                        <!--<label >Write Your Reviews</label>  -->
                        <textarea style="border-top: none;" class="form-control" id="reviews" name="reviews" placeholder="Your review helps others learn about great local business"></textarea>
                    </div>
                        
                    </div>    
                    <div class="form-group">
                        <!--<button type="submit" class="btn btn-primary" id="addStarratting">Submit</button>-->
                         
                        <img src="<?=BASE_URL?>assets/image/submit.png" id="addStarratting">
                    </div>
                </form>  
                
                
            </div>
    
    
    
            <?php } } } ?>
    
    <?php //echo "<pre>";print_r($winner); ?>
    
        </div>
        
      <?php } ?>   
    </div>
</div>  



<script>
    $(document).ready(function(){
        $("#write_review").click(function(){
            $("#addreviews_add").toggle('slow');
        });
        
        $("#addStarratting").click(function(){
            var reviews = $('#reviews').val().trim();
            var f=1;
                if(reviews == "")
                {
                    $('#sratError').text('Please write your reviews');
                    $('#revG').addClass("has-error");
                    f=0;
                    return false;
                }
                if(f){$("#addreviews_add").submit();}
        });
    });
</script>



