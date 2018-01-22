<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <div class="row">
            <p class="product_vw_head text-center margin-bottom_25"><?=$category['rows'][0]->category?></p>
            
            <p class="product_vw_cat_desc margin-bottom_25 col-sm-12 col-md-12 col-xs-12 col-lg-12"><?=$category['rows'][0]->description?></p>
        </div>
        
        
        
        
        
        
        <div class="row">
<!--        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 margin-bottom_25">
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
                    <h4 class="pro_vw_inner_head">Price</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                        <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
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
                    <input type="hidden" name="categoryid" id="categoryid" value="<?=$categoryid?>">
                    <h4 class="pro_vw_inner_head">Certification</h4>
                    
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <button class="btn certification text-center" id="1">Yes</button>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <button class="btn certification text-center" id="0">No</button>
                    </div>
                    
                </div>
                
            </div>
        </div>-->
        
        
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 product_vw_main">
      
            
            <div class="row" id="computers">
                <?php if($products['res']){ 
                    foreach($products['rows'] as $product){
                    ?>
                 <div class="col-sm-4 col-md-3 col-xs-12 col-lg-3 system margin-bottom_35" 
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
                           <div class="row margin-bottom_10">
                               <div class="col-sm-7 col-xs-7"><a href="javascript:void(0);" class="add_to_compare" onclick="compare(<?=$categoryid?>,<?=$product->prod_id?>)" >Add to compare </a></div>
                               <div class="col-sm-5 col-xs-5 product_vw_price">$<?=$product->prod_price?></div>
                           </div>  
                           
                           <div class="row">
                               <div class="col-sm-7 col-xs-7 add_to_compare">Quantity</div>
                               <div class="col-sm-5 col-xs-5 product_vw_price"> <?php if(isset($product->no_of_Prod)){echo $product->no_of_Prod;}else{echo "0";} ?> </div>
                           </div>
                       </div>
                       </div> 
                       <div class="row">
                       <div class="col-sm-12 col-xs-12">

                                       <?php if($product->bid_status){ ?>
                                       
                                             <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/yourbid/<?=$product->prod_id?>" <?php }else{ ?> href="javascript:void(0)" title="seller can not bid" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/yourbid.png" class="img img-responsive" height="33" width="124"></a> 
                                         <?php }else{ ?>
                                             <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/addtocart/<?=$product->prod_id?>" <?php }else{ ?> href="javascript:void(0)" title="seller can not use add to cart" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/addtocart.png" class="img img-responsive" height="33" width="124"></a> 
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
            
        
                   
    </div>
            <ul class="pagination pagination-sm no-margin pull-right">
                   <?php echo $links; ?>
            </ul>
</div>
        
    </div>
</div>  


<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
<p class="product_vw_footer_head text-center margin-bottom_25"><?=$category['rows'][0]->category?> Type Sellers</p>
    
<div id="jssor_2" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1571px; height: 250px; background: #EFEFEF;">
        
    <div data-u="slides" style="cursor: default; position: relative; top: 25px; left: 15px; width: 1549px; height: 250px; overflow: hidden;">
        <?php if($sellers['res']) { foreach($sellers['rows'] as $userlist) { ?>

        <div class="thumbnail product_cus_thumb" style="height:auto;">
            <a href="<?=BASE_URL?>sellerproduct/<?=$userlist->username?>" >
                        <div class='product_cus_thumb_inner img img-responsive center-block'>    
                        <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userlist->profile_Pic?>" alt="" class="img img-responsive center-block">
                        </div>

                    </a>
            <p class="text-center footer_img_thumb"><a href="<?=BASE_URL?>sellerproduct/<?=$userlist->username?>" ><?=$userlist->username?></a></p>
            </div>
        <?php } } ?>
    </div>

    <span data-u="arrowleft" class="jssora03l" style="top:123px;left:-39px;" data-autocenter="2"></span>
    <span data-u="arrowright" class="jssora03r" style="top:123px;right:-87px;" data-autocenter="2"></span>
</div>
    
</div>
</div>    

<script src="<?=BASE_URL?>assets/js/jssor.slider.mini.js"></script>
<script>
        $(document).ready(function () {
            
            var jssor_2_options = {
              $AutoPlay: true,
              $AutoPlaySteps: 1,
              $SlideDuration: 300,
              $SlideWidth: 300,
              $SlideHeight: 200,
              $SlideSpacing: 10,
              $Cols: 5,
              
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 1
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 1,
                $SpacingY: 1
              }
            };
            
            var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var refSize = jssor_2_slider.$Elmt.parentNode.clientWidth;
                
                if (refSize) {
                    refSize = Math.min(refSize, 1080);
                    jssor_2_slider.$ScaleWidth(refSize);
                    
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>

    <style>
        .footer_img_thumb a{ text-decoration:none;font-size:20px;font-family:Lato Bold;color:#000;}
        .product_vw_footer_head{margin-top:10px;font-size: 25px;font-family: Lato Bold;}
        /* jssor slider bullxet navigator skin 03 css */
        /*
        .jssorb03 div           (normal)
        .jssorb03 div:hover     (normal mouseover)
        .jssorb03 .av           (active)
        .jssorb03 .av:hover     (active mouseover)
        .jssorb03 .dn           (mousedown)
        */
        .jssorb03 {
            position: absolute;
        }
        .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av {
            position: absolute;
            /* size of bullet elment */
            width: 21px;
            height: 21px;
            text-align: center;
            line-height: 21px;
            color: white;
            font-size: 12px;
            //background: url('slider/img/b03.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb03 div { background-position: -5px -4px; }
        .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
        .jssorb03 .av { background-position: -65px -4px; }
        .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }

        /* jssor slider arrow navigator skin 03 css */
        /*
        .jssora03l                  (normal)
        .jssora03r                  (normal)
        .jssora03l:hover            (normal mouseover)
        .jssora03r:hover            (normal mouseover)
        .jssora03l.jssora03ldn      (mousedown)
        .jssora03r.jssora03rdn      (mousedown)
        */
        .jssora03l{
/*            border: 3px solid #839393;
            border-radius: 25px;*/
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 70px;
            height: 40px;
            cursor: pointer;
            background: url('<?=BASE_URL?>assets/image/arrow1.png') no-repeat !important ;
            overflow: hidden;
            
        }
        .jssora03r {
/*            border: 3px solid #839393;
            border-radius: 25px;*/
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 70px;
            height: 40px;
            cursor: pointer;
            background: url('<?=BASE_URL?>assets/image/arrow2.png') no-repeat !important;
            overflow: hidden;
        }
        .jssora03l { background-position: -3px -33px; }
        .jssora03r { background-position: -63px -33px; }
        .jssora03l:hover { background-position: -123px -33px; }
        .jssora03r:hover { background-position: -183px -33px; }
        .jssora03l.jssora03ldn { background-position: -243px -33px; }
        .jssora03r.jssora03rdn { background-position: -303px -33px; }
    </style>


<?php if((!$this->session->has_userdata('user_type')) || ($this->session->userdata('user_type')==2)){ ?>
<a href="<?=BASE_URL?>products/savesearch/<?=$categoryid?>" class="save_searches text-center" title="Save Searches">Save Searches</a>
<?php } ?>
<!--<div id="slider-container"></div>
<p>
    <label for="amount">Price range:</label>
    <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
</p>-->
<!--<div id="computers">
    <div class="system" data-price="299">div1 - 299</div>
    <div class="system" data-price="599">div2 - 599</div>
    <div class="system" data-price="1099">div3 - 1099</div>
</div>
<div id="slider-range"></div>-->

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

<script>
    var filter_size=[];
    var max_price;
    var min_price;
    var certification;
    var categoryid=$("#categoryid").val();
    var zipcode;
    var bid_filter;
    var seller_ratting=[];
    
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
        {by:'category',size:filter_size,min_price:min_price,max_price:max_price,certification:certification,categoryid:categoryid,zipcode:zipcode,bid:bid_filter,seller_ratting:seller_ratting},
        function(data,status){
            //console.log(data);
            var obj=$.parseJSON(data);
            var htm='';
           if(obj.res){
                //console.log(obj.rows);
                $.each(obj.rows,function(i,val){
                    //console.log(val.bid_status);
                    if(val.pord_detail.length > 100){
                        var dot1='...';
                    }else{
                        var dot1='';
                    }
                    
                    htm+='<div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system margin-bottom_35" data-price="'+val.prod_price+'" data-certification="'+val.certification+'" data-size="'+val.size+'">';
                    htm+='<div class="product_vw_inner_content">';
                    htm+='<div class="thumbnail cus_thumb">';
                    htm+='<img src="<?=BASE_URL?>assets/image/product/thumb/'+val.prod_img+'" alt="" class="img img-responsive center-block">';
                    htm+='</div>';
                    htm+='<div class="caption product_text_caption">';
                    //htm+='<h3>Thumbnail label</h3>';
                    htm+='<p class="product_vw_content margin-bottom_25">'+val.pord_detail.substr(0, 100)+''+dot1+'</p>';
                    htm+='<div class="row margin-bottom_25">';
                    htm+='<div class="col-sm-12 col-xs-12">';
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-7 col-xs-7"><a href="javascript:void(0);" class="add_to_compare" onclick="compare('+categoryid+','+val.prod_id+')" >Add to compare </a></div>';
                    htm+='<div class="col-sm-5 col-xs-5 product_vw_price">$'+val.prod_price+'</div>';
                    htm+='</div>'; 
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">Quantity</div>';
                    htm+='<div class="col-sm-5 col-xs-5 product_vw_price">'+val.no_of_Prod+'</div>';
                    htm+='</div>';
                    htm+='</div>';
                    htm+='</div>'; 
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-12 col-xs-12">';
                    if(parseInt(val.bid_status)){
                    htm+='<a <?php if($this->session->userdata('user_type')==2 || (!$this->session->has_userdata('user_type'))){ ?> href="<?=BASE_URL?>products/yourbid/'+val.prod_id+'" <?php }else{ ?> href="javascript:void(0)" title="seller can not bid" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/yourbid.png" class="img img-responsive" height="33" width="124"></a>';
                    }else{
                    htm+='<a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/addtocart/'+val.prod_id+'" <?php }else{ ?> href="javascript:void(0)" title="seller can not add use to cart" <?php } ?> class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/addtocart.png" class="img img-responsive" height="33" width="124"></a>';
                    }
                    htm+='<a href="<?=BASE_URL?>products/details/'+val.prod_id+'" class="product_vw_vw_details" role="button">View Details</a>';
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
            var zip=$("#zip").val().trim();
            var distance=$("#distance").val().trim();
            var city=$("#city").val().trim();
            var state=$("#state").val().trim();
            
            if(zip == ''){
                //$("#fname_error").html("Enter Your First Name");
                $("#zip").focus();
                $("#zip_error").parent().addClass("has-error");
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
            
            if(city == ''){
                //$("#fname_error").html("Enter Your First Name");
                $("#city").focus();
                $("#city_error").parent().addClass("has-error");
                return false;    
            }
            
            if(state == ''){
                //$("#fname_error").html("Enter Your First Name");
                $("#state").focus();
                $("#state_error").parent().addClass("has-error");
                return false;    
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
