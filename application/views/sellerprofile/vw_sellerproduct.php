<style type="text/css"> 
.imgA1 { position:absolute; top: 10px; left: 20px; z-index: 3; height:50px; } 
.imgB1 { position:absolute; top: 10px; left: 20px; z-index: 3; height:50px; }
.ajx_img{padding-left: 12px;}
</style>
 <script>
$(document).ready(function(){
    $("#bid_0").click(function(){
        $("#message").hide();
    });
   
});
</script>
<?php
//print_r($this->commondata['compare']);   
?>

<div class="row" id="compare_main" <?php if(!$this->session->has_userdata('compare')){ ?> style="display: none;" <?php } ?> >
    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">    
        <div class="compare">
            <?php if($this->commondata['compare']['res']){ 
                    foreach($this->commondata['compare']['rows'] as $compared_product){
                ?>
            <div class="col-sm-2 col-lg-2 col-md-2 col-xs-6" id="com_<?=$compared_product->id?>">
                <a href="javascript:void(0);" class="row close compare_close removecompare" id="<?=$compared_product->id?>" >&times;</a>
                <div class="compare_border">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 compare_img">
                    <img src="<?=BASE_URL?>assets/image/product/thumb/<?=$compared_product->prod_img?>" class="img img-responsive center-block" style="max-height: 60px;">
                    </div>
                    <p class="text-center compare_prod_name"><a href="#" ><?php echo strlen($compared_product->prod_name) > 14 ? substr($compared_product->prod_name,0,14)."..." : $compared_product->prod_name; ?></a></p>
                </div>
            </div>
            <?php } } ?>
            
            <div class="col-sm-2 col-lg-2 col-md-2 col-xs-12 pull-right compare_btn_hide">
                <a href="javascript:void(0);" class="close removecompare" id="0" >&times;</a>
                <?php if($this->commondata['compare']['count']>1): ?>
                <a class="btn btn-success compare_btn" href="<?=BASE_URL?>products/productcompare" target="_blank" >Compare</a>
                <?php else: ?>
                <button class="btn btn-success disabled compare_btn">Compare</button>
                <?php endif; ?>
            </div>
            
        </div>
    </div>   
    </div>

<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <div class="row">
    <p class="product_vw_head text-center margin-bottom_25"><?=$username?><!--'s Product List--> </p>
            
        </div>
        <div class="">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 product_vw_search margin-bottom_40">
            <form role="form" method="get" action="<?=BASE_URL?>sellerproduct/searchbydistance/<?=$username?>/">
                <p class="text-danger zip_search_error"><?php if($this->session->flashdata("get_vali_error")=='true'){echo "Zipcode/city and distance field are required";}?></p>
                <div class="col-md-11 col-lg-11 col-sm-11 col-xs-12"> 
                    
<!--                   <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"> 
                   <div class="form-group">
                     <label for="email">Zip Code</label>
                     <input type="text" value="<?=$this->input->get('zip')?>" class="form-control" id="zip" name="zip" placeholder="Zip Code">
                     <span id="zip_error"></span>
                   </div>
                       <span id="zip_error_nume" class="text-danger"></span>
                   </div>  
                    
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                   <div class="form-group">
                     <label for="pwd">City</label>
                     <input type="text" class="form-control" value="<?=$this->input->get('city')?>" id="city" name="city" placeholder="City">
                     <span id="city_error" ></span>
                     
                   </div>
                    </div>
                    
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                   <div class="form-group">
                     <label for="pwd">Distance (in miles)</label>
                     <input type="text" class="form-control" value="<?=$this->input->get('distance')?>" id="distance" name="distance" placeholder="Distance (Miles)" onkeyup="checknumber(this.id,this.value)" >
                     <span id="distance_error"></span>
                   </div>
                        <span id="distance_error_nume" class="text-danger"></span>
                    </div>-->
                    
                    
                    
<!--                    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                   <div class="form-group">
                     <label for="pwd">State</label>
                     <input type="text" class="form-control" value="<?=$this->input->get('state')?>" id="state" name="state" placeholder="State">
                     <span id="state_error" ></span>
                     
                   </div>
                    </div>-->



                     <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                      <label for="pwd">City</label>
                      <input id="autocomplete" class="form-control" name="city" placeholder="Enter your address" value="<?=$this->input->get('city')?>" onFocus="geolocate()" type="text" />
                      <span id="city_error" ></span>

                    </div>
                    </div>
      
                   <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"> 
                   <div class="form-group">
                     <label for="email">Zip Code</label>
                     <input type="text" value="<?=$this->input->get('zip')?>" class="form-control" id="postal_code" name="zip" placeholder="Zip Code">
                     <span id="zip_error"></span>
                   </div>
                       <span id="zip_error_nume" class="text-danger"></span>
                   </div> 

                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                   <div class="form-group">
                     <label for="pwd">Distance (in miles)</label>
                     <input type="text" class="form-control" value="<?=$this->input->get('distance')?>" id="distance" name="distance" placeholder="Distance (Miles)" onkeyup="checknumber(this.id,this.value)" >
                     <span id="distance_error"></span>
                   </div>
                        <span id="distance_error_nume" class="text-danger"></span>
                    </div>


                </div>  
                    <div class="col-md-1 col-lg-1 col-sm-12 col-xs-12">
                        <br/>
                        <button type="submit" class="btn btn-success pull-right" id="searchbydist">SEARCH</button>
                    </div>
                </form>
            </div>   
            </div>
         <div class="col-lg-12" ><p class="prod_vw_filters_head" style="text-align: right; margin-right: 132px;font-size:15px;">Filter</p></div>
        <div class="row">
            <p class="col-sm-3 col-lg-3 col-md-3 col-xs-12 prod_vw_filters_head" style="font-size:15px;">Filter By </p>
            
             
            <p class="col-sm-3 col-lg-6 col-md-3 col-xs-12 prod_vw_filters_head" id="message" style="font-size:15px;">Two type of products available here Bid and Buy Directly </p>
        
           
            <div class="product_buy_btn">
              
                <div class="product_vw_type_btn pull-right">    
                   <ul> 
                    
                       <li><a href="javascript:void(0);" class="bid_filter" id="bid_0" title="Filter by Buy Directly Products">Buy Directly</a></li>
                        <li><a href="javascript:void(0);" class="bid_filter" id="bid_1" title="Filter by Bid Products">Bid</a></li>
                   </ul>
                </div>
            </div>
        
        
        </div>
        
        
        
        <div class="row">
        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 margin-bottom_25">
            <div class="product_vw_left">
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Zip Code</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Enter zip code">
                        </div>
                    </div>
                </div> 
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Product Name</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input type="text" class="form-control" name="productname" id="productname" placeholder="Enter product name">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Price</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                        <!--<input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />-->
                        <div id="slider-container" class="slider-container"></div>
                        </div>
                    </div>
                    
                    <div class="row margin-bottom_10">
                    <div class="col-sm-6">
                        <div class="filter_price text-center" id="min_amt"></div>
                        <div class="text-center filter_inner_text">From</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="filter_price text-center" id="max_amt" ></div>
                        <div class="text-center filter_inner_text">To</div>
                    </div>
                    </div>    
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Seller Ratting</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <span><input type="checkbox" class="seller_ratting" value="1"></span>
                            <spna class="fa fa-star-o filter_star"></spna>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <span><input type="checkbox" class="seller_ratting" value="2"></span>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <span><input type="checkbox" class="seller_ratting" value="3"></span>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <span><input type="checkbox" class="seller_ratting" value="4"></span>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <span><input type="checkbox" class="seller_ratting" value="5"></span>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                            <spna class="fa fa-star-o filter_star"></spna>
                        </div>
                    </div>
                       
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Farm Size</h4>
                    <p><input type="checkbox" class="size-filter" value="1"> <span class="filter_inner_text">Small</span></p>
                    <p><input type="checkbox" class="size-filter" value="2"> <span class="filter_inner_text">Medium</span></p>
                    <p><input type="checkbox" class="size-filter" value="3"> <span class="filter_inner_text">Large</span></p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <input type="hidden" name="userid" id="userid" value="<?=$userid?>">
                    <h4 class="pro_vw_inner_head">Certification</h4>
                    
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <button class="btn certification text-center" id="1">Yes</button>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <button class="btn certification text-center" id="0">No</button>
                    </div>
                    
                </div>
                
            </div>
        </div>
        
        
        <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12 product_vw_main">
      
            
            <div class="row" id="computers">
                <?php if($products['res']){ 
                    foreach($products['rows'] as $product){
                    ?>
                 <div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system margin-bottom_35" 
                                         data-price="<?=$product->prod_price?>" 
                                         data-certification="<?=$product->certification?>" 
                                         data-size="<?=$product->size?>">
                     <div class="product_vw_inner_content"> 
                         
                    <div class="thumbnail product_cus_thumb">
                        <div class='product_cus_thumb_inner img img-responsive center-block'>
<!--                        <img src="<?=BASE_URL?>assets/image/product/thumb/<?=$product->prod_img?>" alt="" class="img img-responsive center-block">-->
                          <?php if($product->bid_status){ ?>

                        <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="" data-toggle="modal" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/Bid.png" width="105 px" class="img img-responsive imgA1"></a> 
                        <?php }else{ ?>
                        <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> data-toggle="modal" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/Buy-Directly.png" class="img img-responsive imgB1" width="105 px"></a> 
                        <?php } ?>
                        <a href="<?=BASE_URL?>products/details/<?=$product->prod_id?>" class='product_cus_thumb_inner img img-responsive center-block'>
                        <img src="<?=BASE_URL?>assets/image/product/thumb/<?=$product->prod_img?>" alt="" class="img img-responsive center-block">
                        
                        </a>
                        </div>
                    </div>
                         <div class="caption product_text_caption">
                       <!--<h3>Thumbnail label</h3>-->
                       <p class="product_vw_content margin-bottom_35" style=" word-wrap: break-word;"><?php echo substr($product->pord_detail,0,100); if(strlen($product->pord_detail)>100){echo "...";} ?></p>
                         <span>
                         <a  href="<?=BASE_URL?>products/details/<?=$product->prod_id?>" class="product_vw_vw_details" role="button" style="margin-bottom:6px; margin-top:-15px; font-style: italic;">view more</a>
                       </span>
                       <div class="row margin-bottom_25">
                       <div class="col-sm-12 col-xs-12">
                           <div class="row margin-bottom_10">
                               <div class="col-sm-7 col-xs-7 add_to_compare">Category</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price" title="<?=$product->category?>"> <?php echo substr($product->category,0,9); if(strlen($product->category)>9){echo "...";} ?> </div>
                           </div>
                           
                           <div class="row margin-bottom_10">
                               <div class="col-sm-7 col-xs-7 add_to_compare">Name</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price" title="<?=$product->prod_name?>"> <?php echo substr($product->prod_name,0,6); if(strlen($product->prod_name)>6){echo "...";} ?> </div>
                           </div>
                           
                           <div class="row margin-bottom_10">
                               <div class="col-sm-7 col-xs-7 add_to_compare">Price</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price">$<?=$product->prod_price?></div>
                           </div>  
                           
                           <div class="row margin-bottom_10">
                               <div class="col-sm-7 col-xs-7 add_to_compare">Quantity</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price"> <?=$product->no_of_Prod?> </div>
                           </div>
                           
                           <?php if($product->business_name!=''){ ?>
                           <div class="row margin-bottom_10">
                               <div class="col-sm-7 col-xs-7 add_to_compare">Business Name</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price" style=" word-wrap: break-word;" title="<?=$product->business_name?>"> <?php echo substr($product->business_name,0,9);if(strlen($product->business_name)>9){echo "...";}?> </div>
                           </div>
                           <?php }else{ ?>
                           <div class="row margin-bottom_10">
                               <div class="col-sm-7 col-xs-7 add_to_compare">User Name</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price" title="<?=$product->username?>"> <?php echo substr($product->username,0,9);if(strlen($product->username)>9){echo "..";}?> </div>
                           </div>
                           <?php } ?>
                           
<!--                           <div class="row">
                               <div class="col-sm-7 col-xs-7"><a href="javascript:void(0);" class="add_to_compare" onclick="compare(<?=$product->catid?>,<?=$product->prod_id?>)" >Add to compare </a></div>
                           </div> -->
                       </div>
                       </div> 
                       <div class="row">
                       <div class="col-sm-12 col-xs-12">

                                       <?php if($product->bid_status){ ?>
                                       
                                             <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/yourbid/<?=$product->prod_id?>" <?php }else{ ?> href="#sellercart" data-toggle="modal" data-target="#sellercart" title="seller can not bid" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/yourbid.png" class="img img-responsive" width="105px"></a> 
                                         <?php }else{ ?>
                                             <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/addtocart/<?=$product->prod_id?>" <?php }else{ ?> href="#sellercart" data-toggle="modal" data-target="#sellercart" title="seller can not bid" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/addtocart.png" class="img img-responsive" width="105px"></a> 
                                       <?php } ?>
                                         
                               
<!--                               <a href="<?=BASE_URL?>products/details/<?=$product->prod_id?>" class="product_vw_vw_details" role="button">View Details</a>-->
                        <a role="button" href="javascript:void(0);" class="product_vw_add_to_cart" onclick="compare(<?=$product->catid?>,<?=$product->prod_id?>)" style='float:right;'>
				       <img src="<?=BASE_URL?>assets/image/add-to-compare.png" width="105px" class="img img-responsive"></a>
                       </div>    </div> 
                    </div>
                 
                     </div>
                 </div>    
                <?php } }else{ ?>
                <div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system"><h3>Record Not Found</h3></div>
                <?php } ?>
              </div>
            
        
                   
    </div>
            <ul class="pagination pagination-sm no-margin pull-right">
                   <?php echo $links; ?>
            </ul>
            <input type="hidden" value="" id="currentpage">
</div>
        
    </div>
</div>

<?php //print_r($price); ?>


<!-- Modal -->
<div id="compareError" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Success Message</h4>
      </div>
      <div class="modal-body">
          <p class="compare_error"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="sellercart" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alert Message</h4>
      </div>
      <div class="modal-body">
          Sorry, as a user with a seller profile, you are not able to use this account to purchase items.  Please create a buyer account to do so.  We apologize for this inconvenience, but we hope doing so will improve your experience specifically as a seller and a buyer.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
    var filter_size=[];
    var max_price;
    var min_price;
    var certification;
    var userid=$("#userid").val();
    var zipcode;
    var bid_filter;
    var seller_ratting=[];
    var currentpage=$("#currentpage").val();
    var productname;
    
    $(document).on("click",".pagination li a",function(){
        currentpage=$(this).attr("title");
        $("#currentpage").val(currentpage);
        filterdata();
    });
    
    $(function () {
      $('#slider-container').slider({
          range: true,
          min: <?=$price['rows']->min?>,
          max: <?=$price['rows']->max?>,
          values: [<?=$price['rows']->min?>, <?=$price['rows']->max?>],
          create: function() {
              //$("#amount").val("$299 - $1099");
              $("#min_amt").text("$<?=$price['rows']->min?>");
              $("#max_amt").text("$<?=$price['rows']->max?>");
          },
          slide: function (event, ui) {
              //$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
              $("#min_amt").text("$"+ui.values[0]);
              $("#max_amt").text("$"+ui.values[1]);
              min_price = ui.values[0];
              max_price = ui.values[1];
              //filterPrice();
              filterdata();
          }
      })
});

  function filterPrice() {
      $("#computers div.system").hide().filter(function () {
          var price = parseInt($(this).data("price"), 10);
          //var size = parseInt($(this).data("size"), 10);
            return price >= min_price && price <= max_price;
      }).show();
  }
  
  /*var matches = [];
  $(document).on("click",".size-filter",function(){
        $(".size-filter:checked").each(function() {
            matches.push(this.value);
        });
        //filtersize(matches);
    });*/
    
    //var matches = [];
  /*$(document).on("click",".size-filter",function(){
        $(".size-filter:checked").each(function() {
            //matches.push(this.value);
            var selected= this.value;
            $("#computers div.system").hide().filter(function () {
                var size = parseInt($(this).data("size"), 10);
                alert(selected);
                alert(size);
                return size==selected;
            }).show();
            
        });
        //filtersize(matches);
    });*/



    $(document).on("click",".size-filter",function(){
            var data =$(this).val();
            if(this.checked){
                filter_size.push(data);
            }else{
                filter_size.splice($.inArray(data, filter_size),1);
            }
        filterdata();
    });
    
    
    $(document).on("click",".certification",function(){
        certification=$(this).attr("id");
        $(".certification").css({background:"#fff",color:"#004F1B"});
        $(this).css({background:"#004F1B",color:"#fff"});
        filterdata();
    });
    
    
    $(document).on("keyup","#zipcode",function(){
        zipcode = $(this).val();
        if(zipcode!=''){
            filterdata();
        }
    });
    
    $(document).on("keyup","#productname",function(){
        productname = $(this).val();
        if(productname!=''){
            filterdata();
        }
    });
    
    $(document).on("click",".bid_filter",function(){
        bid_filter=$(this).attr("id").split("_")[1];
        $(".bid_filter").removeClass("active");
        $(this).addClass("active");
        filterdata();
    });
    
    
    $(document).on("click",".seller_ratting",function(){
        var data=$(this).val();
        if(this.checked){
            seller_ratting.push(data);
        }else{
            seller_ratting.splice($.inArray(data, seller_ratting),1);
        }
        filterdata();
        //alert(seller_ratting);
    });
    
    function filterdata(){
        $.post("<?=BASE_URL?>products/filter",
        {by:'user',productname:productname,currentpage:currentpage,size:filter_size,min_price:min_price,max_price:max_price,certification:certification,userid:userid,zipcode:zipcode,bid:bid_filter,seller_ratting:seller_ratting},
        function(data,status){
            //console.log(data);
            var obj=$.parseJSON(data);
            var htm='';
           if(obj.products.res){
                //console.log(obj.rows);
                $.each(obj.products.rows,function(i,val){
                    //console.log(val.bid_status);
                    if(val.pord_detail.length > 100){ var dot1='...'; }else{ var dot1=''; }
                    if(val.category.length > 9){ var dot2='...'; }else{ var dot2=''; }
                    if(val.prod_name.length > 6){ var dot3='...'; }else{ var dot3=''; }
                    if(val.business_name.length > 6){ var dot4='...'; }else{ var dot4=''; }
                    if(val.username.length > 9){ var dot3='...'; }else{ var dot5=''; }
                    htm+='<div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system margin-bottom_35" data-price="'+val.prod_price+'" data-certification="'+val.certification+'" data-size="'+val.size+'">';
                    htm+='<div class="product_vw_inner_content">';
                    htm+='<div class="thumbnail cus_thumb">';
                     if(parseInt(val.bid_status)){
                    htm+='<a onclick="return false;" <?php if($this->session->userdata('user_type')==2 || (!$this->session->has_userdata('user_type'))){ ?> href="" <?php }else{ ?> href="" data-toggle="modal" data-target="" title="" <?php } ?> class="" role=""> <img src="<?=BASE_URL?>assets/image/Bid.png" width=105 class="img img-responsive imgA1"></a>';
                    }else{
                    htm+='<a onclick="return false;"<?php if($this->session->userdata('user_type')==2 || (!$this->session->has_userdata('user_type'))){ ?> href="" <?php }else{ ?>  data-toggle="modal" data-target="" title="" <?php } ?> class="" role=""><img src="<?=BASE_URL?>assets/image/Buy-Directly.png" width=105 class="img img-responsive imgB1"> </a>';
                    }      
                    
                    htm+='<a href="<?=BASE_URL?>products/details/'+val.prod_id+'" class="product_cus_thumb_inner img img-responsive center-block">';
                    htm+='<img src="<?=BASE_URL?>assets/image/product/thumb/'+val.prod_img+'" alt="" class="img img-responsive center-block">';
                    htm+='</a>';
                    //htm+='<img src="<?=BASE_URL?>assets/image/product/thumb/'+val.prod_img+'" alt="" class="img img-responsive center-block">';
                    htm+='</div>';
                    htm+='<div class="caption product_text_caption">';
                    //htm+='<h3>Thumbnail label</h3>';
                    htm+='<p class="product_vw_content margin-bottom_25">'+val.pord_detail.substr(0, 100)+''+dot1+'</p>';
                    htm+='<div class="row margin-bottom_25">';
                    htm+='<div class="col-sm-12 col-xs-12">';
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">Category</div>';
                    htm+='<div class="col-sm-5 col-xs-5 product_vw_price" title"'+val.category+'" >'+val.category.substr(0,9)+''+dot2+'</div>';
                    htm+='</div>';
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">Category</div>';
                    htm+='<div class="col-sm-5 col-xs-5 product_vw_price" title"'+val.prod_name+'" >'+val.prod_name.substr(0,6)+''+dot3+'</div>';
                    htm+='</div>';
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">Price</div>';
                    htm+='<div class="col-sm-5 col-xs-5 product_vw_price">$'+val.prod_price+'</div>';
                    htm+='</div>'; 
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">Quantity</div>';
                    htm+='<div class="col-sm-5 col-xs-5 product_vw_price">'+val.no_of_Prod+'</div>';
                    htm+='</div>';
                    if(val.business_name!=''){
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">Business Name</div>';
                    htm+='<div class="col-sm-5 col-xs-5 product_vw_price" title="'+val.business_name+'">'+val.business_name.substr(0,6)+''+dot4+'</div>';
                    htm+='</div>';
                    }else{
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">Username</div>';
                    htm+='<div class="col-sm-5 col-xs-5 product_vw_price" title="'+val.username+'">'+val.username.substr(0,9)+''+dot5+'</div>';
                    htm+='</div>';
                    }
                    htm+='<div class="row">';
                    //htm+='<div class="col-sm-7 col-xs-7"><a href="javascript:void(0);" class="add_to_compare" onclick="compare('+val.catid+','+val.prod_id+')" >Add to compare </a></div>';
                    //htm+='<div class="col-sm-5 col-xs-5 product_vw_price">$'+val.prod_price+'</div>';
                    htm+='</div>';
                    htm+='</div>';
                    htm+='</div>'; 
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-12 col-xs-12">';
                    if(parseInt(val.bid_status)){
                    htm+='<a <?php if($this->session->userdata('user_type')==2 || (!$this->session->has_userdata('user_type'))){ ?> href="<?=BASE_URL?>products/yourbid/'+val.prod_id+'" <?php }else{ ?> href="#sellercart" data-toggle="modal" data-target="#sellercart" title="seller can not bid" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/yourbid.png" class="img img-responsive" height="33" width="105px"></a>';
                    }else{
                    htm+='<a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/addtocart/'+val.prod_id+'" <?php }else{ ?> href="#sellercart" data-toggle="modal" data-target="#sellercart" title="seller can not bid" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/addtocart.png" class="img img-responsive" height="33" width="105px"></a>';
                    }
                    //htm+='<a href="<?=BASE_URL?>products/details/'+val.prod_id+'" class="product_vw_vw_details" role="button">View Details</a>';
                    htm+='<a href="javascript:void(0);" class="add_to_compare" onclick="compare('+val.catid+','+val.prod_id+')" ><img src="<?=BASE_URL?>assets/image/add-to-compare.png" width="105px" class="img img-responsive ajx_img"></a>';
                    htm+='</div>';
                    htm+='</div>';    
                    htm+='</div>';
            
                    htm+='</div>';
                    htm+='</div>';
                });
            }else{
                htm+='<div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system">';
                htm+='<h3>Result Not found</h3>';
                htm+='</div>';
            }     
            $(".pagination").html(obj.links);
            $(".pagination li").removeClass("active");
            //alert($(".pagination .active a").attr("href"));
            var f=1;
            $.each($(".pagination li a"),function(i,j){
                var test=$(j).attr("href").split("/");
                var sizeofarray=test.length;
                var noofpage=test[sizeofarray-1];
                //console.log(noofpage);
                $(j).attr("title",noofpage);
                $(j).attr("href","javascript:void(0)");
                //console.log(parseInt(currentpage));
                //console.log(noofpage);
                if(noofpage==parseInt(currentpage)){
                    if(f==1){
                        $(".pagination li").first().removeClass("active");
                        $(j).parent().addClass("active");
                        f=0; }
                }else{
                    if(f==1){ $(".pagination li").first().addClass("active"); }
                }
            });
            
            $("#computers").html(htm);
        });
    }
    
    
    
    
    $(document).ready(function(){
        //$("#compare_main").hide();
        $(window).scroll(function() {
            if ($(window).scrollTop() > 150) {
                //$("#compare_main").fadeIn("slow");
                $("#compare_main").css({"position":"fixed","top":"0","width":"100%","z-index":"331"});
            }
            else {
                $("#compare_main").css({"position":"relative"});
            }
        });
    });
    
    var new1=0;
    function compare(catid,prodid){
        $.post("<?=BASE_URL?>products/compare",{catid:catid,prodid:prodid},function(data,status){
            var obj=$.parseJSON(data);
            var html="";
            var btn="";
            
            if(obj.status){
                $("#compare_main").css({"display":"block"});
                var product=obj.rows;
                //if(product.prod_name.length > 14){ var dot1='...'; }else{ var dot1=''; }
                html+='<div class="col-sm-2 col-lg-2 col-md-2 col-xs-6" id="com_'+product.id+'">';
                html+='<a href="javascript:void(0);" class="close compare_close removecompare" id="'+product.id+'" >&times;</a>';
                html+='<div class="compare_border">';
                html+='<img src="<?=BASE_URL?>assets/image/product/thumb/'+product.prod_img+'" class="img img-responsive center-block compare_img" height="100" width="100">';
                html+='<a href="#" >'+product.prod_name+'</a>';

                html+='</div>';
                html+='</div>';
                $(".compare").append(html); 
                
                if(new1>0){
                btn+='<a href="javascript:void(0);" class="close removecompare" id="0" >&times;</a>';
                
                btn+='<a class="btn btn-success compare_btn" href="<?=BASE_URL?>products/productcompare" target="_blank" >Compare</a>';
                $(".compare_btn_hide").html(btn); 
                }
                new1++;
                
            }else{
                
                $("#compareError").modal('show');
                $(".compare_error").html(obj.message).addClass("alert alert-danger fade in");
            }
            
        });
    }
    
    
    $(document).ready(function(){
        $(document).on("click",".removecompare",function(){
            var prodid=$(this).attr("id");
            $.post("<?=BASE_URL?>products/compareRemove",{prodid:prodid},function(data,status){
                //console.log(data);
                var obj= $.parseJSON(data);
                if(obj.status){
                    if(obj.role=='single'){
                        $("#com_"+obj.productid).remove();
                    }else{
                        $("#compareError").modal('show');
                        //$(".compare_error").html(obj.message);
                        $(".compare_error").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        });
        
        
        $("#searchbydist").click(function(){
//            var zip=$("#zip").val().trim();
//            var distance=$("#distance").val().trim();
//            var city=$("#city").val().trim();
//            var state=$("#state").val().trim();
//            
//            if(zip == ''){
//                //$("#fname_error").html("Enter Your First Name");
//                $("#zip").focus();
//                $("#zip_error").parent().addClass("has-error");
//                return false;    
//            }
//            
//            if(distance == ''){
//                //$("#fname_error").html("Enter Your First Name");
//                $("#distance").focus();
//                $("#distance_error").parent().addClass("has-error");
//                return false;    
//            }else{
//                var id ='distance';
//                var value=distance;
//             
//                if(!$.isNumeric( value )){
//                    $("#"+id+"_error_nume").html("Enter Only Numeric Value");
//                    $("#"+id).focus();
//                    $("#"+id+"_error").parent().addClass("has-error");
//                    return false;
//                }
//            }
//            
//            if(city == ''){
//                //$("#fname_error").html("Enter Your First Name");
//                $("#city").focus();
//                $("#city_error").parent().addClass("has-error");
//                return false;    
//            }
//            
//            if(state == ''){
//                //$("#fname_error").html("Enter Your First Name");
//                $("#state").focus();
//                $("#state_error").parent().addClass("has-error");
//                return false;    
//            }

            var zip=$("#postal_code").val().trim();
            var distance=$("#distance").val().trim();
            var city=$("#autocomplete").val().trim();
            //var state=$("#state").val().trim();
            
            if(zip == '' && city == ''){
                $(".zip_search_error").html("Zip code/city is required");
                $("#zip").focus();
                $("#zip_error").parent().addClass("has-error");
                $("#city_error").parent().addClass("has-error");
                return false;    
            }
            
            if(distance == ''){
                //$("#fname_error").html("Enter Your First Name");
                $("#distance").focus();
                $("#distance_error").parent().addClass("has-error");
                return false;    
            }else{
                var id ='distance';
                var value=distance;
             
                if(!$.isNumeric( value )){
                    $("#"+id+"_error_nume").html("Enter Only Numeric Value");
                    $("#"+id).focus();
                    $("#"+id+"_error").parent().addClass("has-error");
                    return false;
                }
            }
            
            return true;
        });
        
    });
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_nume").html("Enter Only Numeric Value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            //return false;
        }}else{
            $("#"+id+"_error_nume").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
</script>


    <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;
var componentForm = {
  //street_number: 'short_name',
  //route: 'long_name',
  //locality: 'long_name',
  //administrative_area_level_1: 'short_name',
  //country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmv-2x4kPtThm1WhIsESS_j7HaHwL0hUM&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
