
<?php 
    if($member )
    {
        ?><style><?php 
        foreach ($member as $value)
        {
            echo $value["class_name"]." {";    
            echo $value["class_css"]."} "; 
           // echo "</br>";
         }
        ?></style><?php 
    }
/*
$content="content";
$items="items";
$prod_box="prod_box";
$center_prod_box="center_prod_box";
$product_title="product_title";
$product_img="product_img";
$prod_price="prod_price";
$customform="customform";
  */
  ////echo count($class_arr);
//print_r( array_keys($class_arr));
    $prod_box1='prod_box';
//global $class_arr;
 $class_arr=array(
    'contener'=>'contener',
    'header'=>'header',
    'logo'=>'logo',
    'login_logout'=>'login_logout',
    'menu'=>'menu', 
    'content'=>'content',
    'items'=>'items',
    'prod_box'=>'prod_box',
    'center_prod_box'=>'center_prod_box',
    'product_title'=>'product_title',
    'product_img'=>'product_img',
    'prod_price'=>'prod_price',
     'prod_detail'=>'prod_detail',
     'view_prod_detail'=>'view_prod_detail',
    'customform'=>'customform',    
    'footer'=>'footer'
    );

    foreach ($bootstrap as $data){
    // echo $data['class'].":- ";
    //echo $data['bootstrap_name'].": ";
    //echo $data['bootstrap_num']."</br>";
    //echo $key.$val."</br>";
        foreach ($class_arr as $ar=>$arv)
        {
            //echo $ar.":-".$arv."</br>";
                    if($ar==$data['class'])
                    {
                        if(($data['bootstrap_name']=='float')){if(($data['bootstrap_num']!='none')){$class_arr[$ar].=" ".$data['bootstrap_num'];}}else{
                    $class_arr[$ar].=" ".$data['bootstrap_name'].$data['bootstrap_num'];
                    //echo $class_arr[$ar]."</br>";
                    if($prod_box1==$data['class']){if($data['bootstrap_name']=='col-md-'){$prod_box1=$data['bootstrap_num'];}}
                        }
                    }
         }
    }           
    //include base_url().'edit_assets/popup/p_b_store.php?pp_name=view_prod_popup';
    //
                ?>        
<?php /*?>
<div class="<?php echo $class_arr['content'];?>"> 
    <div id="view_prod" class="view_prod" ></div>
    <div class="<?php echo $class_arr['items'];?>" id="items" ondblclick="load_popup('#view_prod','#view_prod_popup')"><!--'id, user_id, tag_name, class_type, class_name, class_css'-->
      
                <?php for($i=0;$i<=2;$i++){?>                
                <div class="<?php echo $class_arr['prod_box'];?>">
                    <div class="<?php echo $class_arr['center_prod_box'];?>">
                      <div class="<?php echo $class_arr['product_title'];?>"><a href="details.html">Iphone Apple</a></div>
                      <div class="<?php echo $class_arr['product_img'];?>"><a href="details.html"><img border="0" alt="" src="<?php echo  BASE_URL;?>edit_assets/image/aa.png" class="img-responsive"></a></div>
                      <div class="<?php echo $class_arr['prod_price'];?>"><span class="reduce">350$</span><span class="price">270$</span></div>
                    </div>
                     <div class="<?php echo $class_arr['customform'];?>">
                         <div class="margin-bottom"><a type="submit" class="bb btn-block">Add to Cart</a></div>
                     </div>
                </div>
                <?php }?>
   </div>
        </div>
<?php */ //echo  (((12/2)/12 )*100);?>
        
        <style>
            .product_img{height:140px;} .product_img a img{max-height: 140px; margin: auto;}
            .fa-rotate-45 {
                -webkit-transform: rotate(90deg);
                -moz-transform: rotate(90deg);
                -ms-transform: rotate(90deg);
                -o-transform: rotate(90deg);
                transform: rotate(90deg);
                }
        </style>
    
    <?php echo mouceiconeonmove_or_click('.items >li');?>
<div class="">    
    <div class="container">
        <div class="<?php echo ' '.$class_arr['content'];?>"> 
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">  <!-- "pageno_77" -->
                <div class="col-md-6 col-md-offset-3 galary_hader" id="pageno_5" ondblclick="load_popup2('#view_prod','#title_popup<?php echo $pageid5; ?>','<?php echo $pageid5; ?>')" style="<?php echo $btn_theme_style,$pagetitleposition5;?>"><?php echo $pagetitle5;?></div>
            </div>
            
                <div id="add_item_page_<?php echo $pageid5;?>"></div>
            <ul class="<?php echo $class_arr['items'];?>" id="product_items" ondblclick="load_popup('#view_prod','#view_prod_popup')" data-toggle="popover" ><!--'id, user_id, tag_name, class_type, class_name, class_css'-->
              <?php     if($user_product['res']){ 
                            foreach($user_product['rows'] as $user_product){
                                //echo "<pre>";
                                //print_r($user_product);
                            ?>
                    <li id="<?=$user_product->prod_id?>" class="<?php echo $class_arr['prod_box'];?> ">            
                            <div class="<?php echo $class_arr['product_img'];?>">
                                <a  href="<?php echo BASE_URL.$user_name?>/Shope/prod_detail/<?=$user_product->prod_id?>">
                                    <img border="0"  alt="" src="<?=BASE_URL?>assets/image/product/thumb/<?=$user_product->prod_img?>" class="img img-polaroid img-responsive  center-block"><!--style="width: 100%; <?php  //if((700/(12/$prod_box1))>0) { echo 'height:'.(700/(12/$prod_box1)).'px';} ?>"-->
                                </a>
                            </div>
                        <div class="<?php echo $class_arr['product_title'];?>" title="<?=$user_product->prod_name?>"><a href="<?php echo BASE_URL.$user_name?>/Shope/prod_detail/<?=$user_product->prod_id?>"><?=substr($user_product->prod_name, 0, 20);if(strlen($user_product->prod_name)>20){echo'...';}?></a></div>
                        <div  style="word-wrap: break-word;" class="<?php echo $class_arr['prod_detail'];?>" title="<?=$user_product->pord_detail?>"><?=substr($user_product->pord_detail, 0, 50);if(strlen($user_product->pord_detail)>50){echo'...';} ?></div>
                            
                            <div class="<?php echo $class_arr['prod_price'];?> ">
                                <?php /*?><span class="reduce"><?=$user_product->prod_price?>$</span><?php */?>
                                <span class="price" > $<?=$user_product->prod_price?></span>
                            </div>
                            <a class="<?php echo $class_arr['view_prod_detail'];?>" href="<?php echo BASE_URL.$user_name?>/Shope/prod_detail/<?=$user_product->prod_id?>" >View details</a>
                            <div class="<?php echo $class_arr['customform'];?>">
                                <?php 
                                if($user_product->bid_status==1){?>
                                <a <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?> href="<?=BASE_URL?>products/yourbid/<?=$user_product->prod_id?>" <?php }else{ ?> href="#sellercart" data-toggle="modal" data-target="" title="seller can not bid" <?php } ?> role="button" type="submit" class="btn btn-block btn-<?php echo $btn_theme_bootstrap?>"> 
                                   <i class="fa fa-gavel fa-rotate-90" aria-hidden="true"></i>
                                    Bid Product
                                </a> 
                                <?php } else{?>
                                <a href="<?=BASE_URL?>editpenalcontroller/addtocart/<?=$user_product->prod_id?>" type="submit" class="btn btn-block btn-<?php echo $btn_theme_bootstrap?>"> 
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    Add to Cart
                                </a><?php } ?>
                             </div>
                           
                        </li>

                            <?php }?>
                        <?php }else{ $counter=0;
                            echo "<p class='text-danger'>No Record Found</p>";
                            /*for($i=1;$i<=4;$i++){
                                $counter++; $counter < 4 ? $i==4 ? $i=1:"" : "";
                            ?>                
                <li id="<?php echo $counter;?>" class="<?php echo $class_arr['prod_box'];?>">            
                            <div class="<?php echo $class_arr['product_img'];?>">
                                <a href="#">
                                    <img border="0"  alt="" src="<?php echo  BASE_URL.'edit_assets/image/0'.$i.'.jpg';?>" class="img-polaroid img-responsive"><!--style="width: 100%; height: <?php //echo 700/(12/$prod_box1).'px'?>"-->
                                </a>
                            </div>                                          
                            <div class="<?php echo $class_arr['product_title'];?>"><a href="details.html">Demo product </a></div>
                            <div class="<?php echo $class_arr['prod_detail'];?>" > please add some  Product   </div>
                            
                            <div class="<?php echo $class_arr['prod_price'];?>">
                             
                              <span class="price" >$1</span>
                            </div>
                            <a class="<?php echo $class_arr['view_prod_detail'];?>" href="#" >demo product's</a>
                            <div class="<?php echo $class_arr['customform'];?>">                                               
                                <a href="#" type="submit" class="btn btn-block btn-<?php echo $btn_theme_bootstrap?>"> <span class="glyphicon glyphicon-shopping-cart"></span>demo product's</a>
                             </div>
                        </li> <?php  }*/ }?>
           </ul>
                
                <?php if(!$user_edit_panel){ ?>        
                <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $productlinks; ?>
                </ul>
           <?php } ?>
                
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
        
      <?php /*?>  
        <div class="row">
    <div class="col-sm-12">  
    <div class="col-sm-3">
        <div class="img-responsive"><img src="<?=BASE_URL?>edit_assets/image/aa.png" width="100%"></div>
    </div>
    
    <div class="col-sm-3">
        <p>Product Name</p>
    </div>
    
    <div class="col-sm-2">
        <p>Price</p>
    </div>
    
    <div class="col-sm-2">
        DetailsDetailsDetails DetailsDetailsDet ailsDetail sDetailsDet ailsDetai lsDe tailsDeta ilsDetailsDetai lsDet ailsDetailsDe tail sDetails
        Details DetailsDetai lsD etailsDetails DetailsD etailsDetailsDetailsDetails
        
    </div>
    
    <div class="col-sm-2">
        <a href="" class="btn btn-success btn-block">test</a>
    </div>
    </div>        
</div>




       <?php */?>
         <script>
  $(function() {
    $( "#items" ).sortable();
    $( "#items" ).disableSelection();
    
  });
  
  //alert( "Size: " + $( "li" ).size() );
//alert( "Size: " + $( "li" ).length );
 
  </script>
  
  <?php if($user_edit_panel){ ?>
  <button class="btn btn-circle btn-success save_change_product save_gallerychange" data-toggle="popover" onclick="get_product_view()" style="position:fixed;top:340px;left:0;display: none;">Save changes</button>
  <script> 
      $(function() {                 
                    
                    
                    $( "#product_items" ).sortable({
                        tolerance: 'pointer',
                        cursor: 'pointer',
                        dropOnEmpty: true,
                        //connectWith : "#product_items",
                        /*receive : function (event, ui)
                        {
                            //short_add_menu_li();
                           $("span#result").html ($("span#result").html () 
                              + ", receive");
                        }*/
                            stop: function(even,ui)
                            {
                                $(".save_change_product").css({"display":"block"});
                                
                            }
                     });                    
                    
           });
      function get_product_view()
      {
                                var all="";
                                var user_id=$("#session").val();
                                 var base_url=$("#site_url_BASE_URL").val();
                                 $("#loadingmessage").css('display','block');
                               $('#product_items').find('li').each(function(){
                                var index = $(this).index()+1;
                                var text = $(this).text();
                                var value = $(this).attr('id');
                                
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo BASE_URL?>Inserdata/save_product_view",
                                    async: false,
                                    data: {poductid:value,user_id:user_id,view:index},                               
                                    success: function( data ) {}
                                   });
                                //all=all+('\n Index is: ' + index + ' , text is ' + text + ' and value is ' + value);
                                        });
                                        $(".save_change_product").css({"display":"none"});
                                        $("#loadingmessage").css('display','none');
                                        //alert(all);
      }
          $(document).ready(function(){
                $(".items>li a").removeAttr("href");
          });  
  </script>
  <?php } ?>
