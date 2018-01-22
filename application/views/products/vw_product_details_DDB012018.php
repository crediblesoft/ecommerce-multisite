  <link href="<?=BASE_URL?>assets/css/jquery.countdown.css" rel="stylesheet">
  <script src="<?=BASE_URL?>assets/js/jquery.plugin.js"></script>
  <script src="<?=BASE_URL?>assets/js/jquery.countdown.js"></script>
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5614af2e7bc5b68b" async="async"></script>-->
<?php //print_r($products);
$product=$products['rows'][0];
?>
<style type="text/css">
.defaultCountdown { 
    width: 230px; 
    height: 45px;
    margin-top:5px;
    background-color:green;
    color:white;
    font-size:12px;

}
</style>
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <!--<div class="row">
            <p class="product_vw_head text-center">dfdf</p>
        </div>-->
         
        <div class="row margin-bottom_40">
        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 margin-bottom_25">
            <div class="product_detail_img">
                <div class="product_detail_img_inner">
                    <img src="<?=BASE_URL?>assets/image/product/thumb/<?=$product->prod_img?>" class="img-responsive center-block">
                </div>
                    <?php if($product->bid_status){ ?>
                 <div class="defaultCountdown" id="Countdown<?=$product->prod_id?>"> </div>
                            
                               <script type="text/javascript">
                                    var d = new Date("<?=$product->bid_end_date?>");
                                   // alert(d);
                                    var countdown_year = d.getFullYear();

                                    var countdown_month = d.getMonth()+1;
                                    var countdown_day = d.getDate();
                                    var countdown_hour = d.getHours();
                                    var countdown_minute =d.getMinutes();
                                    var countdown_second =d.getSeconds();
                                    //alert(countdown_day);

                                    // Split timestamp into [ Y, M, D, h, m, s ]
                                     //var d = new Date(Date.UTC(t[0], t[1]-1, t[2]));
                                    var timeTo = new Date(parseInt(countdown_year), parseInt(countdown_month-1), parseInt(countdown_day), parseInt(countdown_hour), parseInt(countdown_minute), parseInt(countdown_second));
                                        
                                     //alert(timeTo);
                                                                    
                                     $('#Countdown<?=$product->prod_id?>').countdown({until: timeTo});
                                   

                                    </script>
                            <?php } ?>
                                  
            </div>
        </div>
        
        
        <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
                       <div class="col-sm-12">
                           <p class="pro_detail_head"><?=$product->prod_name?></p>
<!--                           <div class="line1 margin-bottom_15"></div>-->
                           <p class="pro_detail_content margin-bottom_15">
                               <?=$product->pord_detail?>
                           </p>
                           
                           <div class="panel panel-default">
                            <div class="panel-body pro-detail-left-cus-panel-body">
                                <div class="col-sm-7 col-lg-7 col-md-7">
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> Price :</div>
                                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12 add_to_compare"> $<?=$product->prod_price?></div>
                                </div>
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> Quantity : </div>
                                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text"> <?=$product->no_of_Prod?></div>
                                </div>
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> Username : </div>
                                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text"> <?=$product->username?></div>
                                </div>
                                
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> Business Name : </div>
                                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text"><?=$product->business_name?></div>
                                </div>
                                
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> Address : </div>
                                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text"><?=$product->address?></div>
                                </div>
								
								<div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> State : </div>
                                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text"><?=$product->state?></div>
                                </div>
                                    
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> Zip : </div>
                                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text"><?=$product->zip?></div>
                                </div>
<?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> 
                                <div class="row col-sm-12 col-lg-12 col-md-12 margin-bottom_20 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> Select Quantity : 
                                    </div> 
                                        <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
                                            <input type="number"  value="1" min="1" id="qty_<?=$product->prod_id?>" class="form-control input-sm" style="width:60px;">
                                        </div>
                                </div>
                            <?php }?>    
                                </div>

                                <div class="col-sm-5 col-lg-5 col-md-5 " style="padding-right: 0px;"> <!-- social_share_head-->
                                    <div class="" style="float: right; width:73%">
                                    <?php 
				  $list_url = BASE_URL.'products/details/'.$product->prod_id;
				  $rurl = BASE_URL.'products/details/'.$product->prod_id;
				  $img_paath = BASE_URL.'assets/image/product/thumb/'.$product->prod_img;
                                  $summary= strip_tags(str_replace("'","",$product->pord_detail));
				  $title=str_replace("'","",$product->prod_name);
				  $fb_app_id='1541384582852340';
				  
				  echo '<a target="_blank" class="fbshare pull-left" title="Share On Facebook" onclick="window.open(\'https://www.facebook.com/dialog/feed?curi=close&app_id='.$fb_app_id.'&display=popup&ref=share&picture='.$img_paath.'&name='.$title.'&description='.$summary.'&link='.$list_url.'&redirect_uri='.$rurl.'\',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');return false;" href="javascript: void(0)" ><img class="img img-responsive" id="fb-share" src = "'.BASE_URL.'assets/image/fbshare.png" alt="fbshare"></a>'; 
				?>
                                 <script> window.open('', '_self', ''); 
                                        <?php if(isset($_GET['post_id'])){ ?> window.close(); <?php } ?>
                                 </script>    
                                 
                                    <?php
                                        echo '<a target="_blank" class=" pull-left" title="Share On Twitter" onclick="window.open(\'https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter\',\'_blank\', \'location=yes,width=700,height=400\');return false;" href="https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter"><img class="img img-responsive" src = "'.BASE_URL.'assets/image/twittershare.png" alt="fbshare"></a>';
                                    ?>
                                    </div> 
                                </div>
                                <p class='row' style="height: 3px;margin-top:10px; background: #fff;clear: both;">&nbsp;</p>
                                <div class="row col-sm-12 col-lg-12 col-md-12 paddign_right0">
                                    <div class="row pull-right paddign_right0">
                                    <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){
                                       if($product->bid_status){ ?>
                                        <a href="<?=BASE_URL?>products/yourbid/<?=$product->prod_id?>" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Your Bid</a> &nbsp;
                                    <?php }else{ ?>
                                    <a href="#" class="btn btn-success" onclick="add_to_cart(<?=$product->prod_id?>);"><span class="glyphicon glyphicon-shopping-cart"></span> Add to cart</a> &nbsp; <!--cus_shopping_cart-->
                                    <?php } } ?>
                                   
                                    <a href="<?=BASE_URL?><?=$product->username?>/Shope/user_profile" target="_blank" class="btn btn-warning cus_btn_warning"> View Shop </a> &nbsp;
                                    
                                    <a href="<?=BASE_URL?>sellerprofile/<?=$product->username?>" class="btn btn-primary"> View Seller Profile </a> &nbsp;
                                    
                                    <a href="<?=BASE_URL?>message/<?=$product->userid?>" class="btn btn-success chatwithonlineuser" id="chatwith_<?=$product->userid?>"><?php if($product->selleronline){echo "Chat with User Now";}else{echo"Send Message to Seller";} ?></a>
                                    </div>     
                                </div>   
                            </div>
                        </div>
                           
                           
                       </div>
        
    
            <!--<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 pull-right"> <strong>Share With</strong><div class="addthis_sharing_toolbox pull-right"></div></div>-->
  
               </div>
            
            
            
        </div> 
        <p class="pro_detail_head">Similar products</p>
        <div class="line2 margin-bottom_20"></div>
        <?php //print_R($related); ?>
       
        <!--
      <?=BASE_URL?>products/addtocart/<?=$product->prod_id?> -->
        <div class=" col-sm-12 col-md-12 col-lg-12 col-xs-12">
        
            <!-------------Thumbnail1  ------------------>
            <?php 
                if($related['res']){
                    foreach($related['rows'] as $relateddata){
            ?>
            <div class="col-sm-6 col-md-3 col-xs-6 col-lg-3" >
                <div class="thumbnail cus_thumb">
                    <img src="<?=BASE_URL?>assets/image/product/thumb/<?=$relateddata->prod_img?>" alt="" class="img img-responsive">
                </div>
                <div class="caption">
                    <div class="col-sm-12 col-md-12 col-lg-12 paddign_leftright0">
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-8 similar_prod_name paddign_left0"><a href="<?=BASE_URL?>products/details/<?=$relateddata->prod_id?>"><?=$relateddata->prod_name?></a></div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4 similar_prod_price text-right paddign_right0">$<?=$relateddata->prod_price?></div>
                    </div>
<!--                   <div class="line1"></div>   -->
<!--                   <div class="row margin-bottom_25">
                   <div class="col-sm-12 col-xs-12">
                       <div class="row">
                           <div class="col-sm-12 col-xs-12 "><strong>$<?=$relateddata->prod_price?></strong></div>
                       </div>        
                   </div>
                   </div>  -->
                      
                </div>
            </div>
                <?php } } ?>
            
            
            
            
            
        </div>
        
    </div>
</div>      



<script>

 //Plugin start
 /*(function($)
   {
     var methods = 
       {
         init : function( options ) 
         {
           return this.each(function()
             {
               var _this=$(this);
                   _this.data('marquee',options);
               var _li=$('>li',_this);
                   
                   _this.wrap('<div class="col-xs-12 slide_container"></div>')
                        .height(_this.height())
                       .hover(function(){if($(this).data('marquee').stop){$(this).stop(true,false);}},
                              function(){if($(this).data('marquee').stop){$(this).marquee('slide');}})
                        .parent()
                        .css({position:'relative',overflow:'hidden','height':$('>li',_this).height()})
                        .find('>ul')
                        .css({width:screen.width*1.44,position:'absolute'});
           
                   for(var i=0;i<Math.ceil((screen.width*3)/_this.width());++i)
                   {
                     _this.append(_li.clone());
                   } 
             
               _this.marquee('slide');});
         },
      
         slide:function()
         {
           var $this=this;
           $this.animate({'left':$('>li',$this).width()*-1},
                         $this.data('marquee').duration,
                         'swing',
                         function()
                         {
                           $this.css('left',0).append($('>li:first',$this));
                           $this.delay($this.data('marquee').delay).marquee('slide');
             
                         }
                        );
                             
         }
       };
   
     $.fn.marquee = function(m) 
     {
       var settings={
                     'delay':1000,
                     'duration':1000,
                     'stop':true
                    };
       
       if(typeof m === 'object' || ! m)
       {
         if(m){ 
         $.extend( settings, m );
       }
 
         return methods.init.apply( this, [settings] );
       }
       else
       {
         return methods[m].apply( this);
       }
     };
   }
 )( jQuery );
 
 //Plugin end
 
 //call
 $(document).ready(
   function(){$('#items').marquee({delay:3000});}
 );
 
 */
 
 

</script>
<script>
   function add_to_cart(id){
       var qty=$("#qty_"+id).val();
       window.location.href="<?=BASE_URL?>products/addtocart/"+id+"/"+qty+"/details";
   }
   
   getOnlineuser();
   
   function getOnlineuser() { 
       var chatwithonlineuser=$(".chatwithonlineuser").attr("id");
       var productseller=chatwithonlineuser.split("_");
       var sellerid=productseller[1];
       $.post("<?=BASE_URL?>products/get_online_singleuser",{id:sellerid},function(data,status){
           console.log(data);
           console.log(status);
           if(status=='success'){
               if(parseInt(data)){ $(".chatwithonlineuser").text("Chat with User Now"); }else{ $(".chatwithonlineuser").text("Send Message to Seller"); }
           }
       });
    setTimeout(getOnlineuser, 60000);
    }
    
    
    
</script>
