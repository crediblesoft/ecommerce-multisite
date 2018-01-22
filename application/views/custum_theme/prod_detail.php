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
$class_arr=array(
    'contener'=>'contener',
    'header'=>'header',
    'logo'=>'logo',
    'login_logout'=>'login_logout',
    'menu'=>'menu', 
    
    'prod_detail_content'=>'prod_detail_content',
    'prod_d_image'=>'prod_d_image',
    'prod_d_side_img'=>'prod_d_side_img',
    'prod_detail'=>'prod_detail',    
    'prod_d_name'=>'prod_d_name',
    'prod_d_title'=>'product_d_title',
    'prod_select_Quantity'=>'prod_select_Quantity',
    'prod_d_search_box'=>'prod_d_search_box',
    'prod_d_detail_box'=>'prod_d_detail_box',
    'prod_d_cart_box'=>'prod_d_cart_box',
    'prod_d_price'=>'prod_d_price',
    'prod_d_detail'=>'prod_d_detail',    
    'prod_d_cart_btn'=>'prod_d_cart_btn'   
    
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
                    
                        }
                    }
         }
    } 
?><style>
    .prod_select_Quantity{margin-bottom: 10px;}
    .prod_d_side_img{border: 1px solid #F8F8F8;}
    
    .prod_d_side_img :hover{
        border: 2px solid #428BCA;
        -moz-box-shadow: 0 0 10px #ccc; 
        -webkit-box-shadow: 0 0 10px #ccc; 
        box-shadow: 0 0 10px #ccc;
    }
    /*.prod_d_name{text-align: center;font-size: 30px;color: #428BCA;border-bottom: 3px solid #ccc;}
    .prod_d_detail{text-align: left;font-size: 16px;color: #73C873;border-bottom: 2px solid #ccc;}
    .prod_d_price{text-align: center;font-size: 26px;color: #73C873;}
    */
    //.prod_d_title{color: #000000; text-align: left;font-size: 18px;float: left;}
    .prod_d_search_box{border: 1px solid #F8F8F8;}
    //.prod_d_cart_box{border: 1px solid #F8F8F8; background: #f2f1f0 none repeat scroll 0 0; }//background: #EDEDED;
    //.prod_detail_content{margin-top: 50px}
    .prod_d_image{background:  #ededed none repeat scroll 0 0 !important;border-radius: 5px;}
    .prod_d_image img {margin: 15px auto;}
    .prod_d_detail_box{margin: 10px 25px;}
    .prod_d_cart_box{margin: 10px 25px;border-radius: 5px;}
    .prod_d_cart_btn{margin-bottom: 25px;}
    //.prod_d_price{margin-top: 20px;}
    .bottom_border{border-top: 1px solid #D1D1D1;width: 100%;}
    //.prod_d_name{margin-bottom: 20px;}
    //.prod_d_detail{margin-bottom: 20px;}
    .bgcolor{background: #EDEDED ;}
</style>
    
<?php if(!$user_edit_panel){ ?> 


<?php /*if(!$pageid1){?>
<script>
    window.location.assign('<?php echo BASE_URL.'products/details/'.$this->uri->segment(4)?>');
</script>
    <?php }*/?>
<!--for rial data use only start product details---->
<?php if($prod_view_id!=""){
     $prod_view_detail=$prod_view_data[0];
     //print_r($prod_view_detail);
     //echo '<br/>'.$prod_view_detail['prod_name'];
    //echo "you are in".$prod_view_id;?>
<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
    <div class="col-md-6 col-md-offset-3 galary_hader"  style="<?php echo $btn_theme_style;?>"><?php echo $pagetitle1;?></div>
    </div>
    <div id="add_item_page_<?php  echo $pageid1;?>"></div>
<div class=" <?php echo $class_arr['prod_detail_content'];?>" ondblclick="load_popup('#view_prod','#view_prod_detail')" style="margin-bottom: 101px"> 
    
     <div class="container" >
         
        <div class="<?php echo $class_arr['prod_d_image'];?>" >
            <img class=" img-responsive img-thumbnail  center-block" src="<?=BASE_URL?>assets/image/product/thumb/<?php echo $prod_view_detail['prod_img'];?>">           
        </div>       
         <div class="row col-md-7 col-lg-7">
        <div class="<?php echo $class_arr['prod_d_detail_box'];?>" >
            <div class="<?php echo $class_arr['prod_d_name'];?> text-capitalize">
                <pb class="prod_d_title "><b>  </b></pb> <?php echo $prod_view_detail['prod_name'];?>
                <div class="bottom_border"></div>
            </div>      

            <div class="<?php echo $class_arr['prod_d_detail'];?>">
                 <pb class="prod_d_title"><b>  </b></pb>
                <?php echo $prod_view_detail['pord_detail'];?>     
            </div>
        </div>
        <div class="<?php echo $class_arr['prod_d_cart_box'];?> " >      
            <div class="col-lg-12 ">
                <div class="col-lg-12 bgcolor">
                <div class="<?php echo $class_arr['prod_d_price'];?>">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left prod_d_title">Price:</div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left">
                        <pb class="prod_d_title"><b>  </b>$ <?php echo $prod_view_detail['prod_price'];?>  </pb>
                    </div>
                </div>
                <div class="<?php echo $class_arr['prod_select_Quantity'];?> control-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left">
                    <pb class="prod_d_title"><b>  </b>Select Quantity:</pb> 
                    </div>
                    <?php $i = 1;$itemcount=0; ?>
                        <?php foreach ($this->cart->contents() as $items): ?>
                                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>                                
                                        <?php  $productoption=$this->cart->product_options($items['rowid']); ?>                  
                    <?php if($prod_view_detail['id']==$items['id']){$itemcount=$items['qty'];} ?>                    
                    <?php $i++; ?>
                        <?php endforeach; ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">                        
                        <input type="number" min="1" id="qty_<?=$prod_view_detail['id']?>"  class="form-control input-sm"  value="<?php echo "1";//$itemcount;?>"  >
                    </div>                    
                </div>
                    <?php //if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){?>
                <div class="<?php echo $class_arr['prod_d_cart_btn'];?> pull-right">
                    <a onclick="add_to_cart(<?=$prod_view_detail['id']?>);"  class="btn btn-success btn-block"> 
                        <?php // href="<?php echo BASE_URL."editpenalcontroller/addtocart_f_p_d/".$prod_view_detail['id']"                        ?>
                        <span class="glyphicon glyphicon-shopping-cart"></span>Add to Cart 
                    </a>
                </div>
                    <?php //}?><?php //echo $prod_view_detail['username']?>
                </div>
            </div>
        </div>
         </div> 
         <?php /*?>
    <div class="<?php echo $class_arr['prod_d_search_box'];?>">
                <div class="col-xs-12 col-sm-12">
                    <pb style="color: #000000; text-align: left;font-size: 16px;float: left;">check product availability delivery timeline at your location</pb></div>         
                <div class="col-xs-12 col-sm-12">
                    <form class="form-search">
                   <div class="input-append">
                     <input type="text" class="span2 search-query">
                     <button type="submit" class="btn btn-success">Search</button>
                   </div>
                    </form>
                </div>
        </div> <?php */?>
     </div>
</div>
<?php }?>
<!--for rial data use only end  product details---->


<?php }else{ ?> 
<div class="col-md-6 col-md-offset-3 galary_hader" id="pageno_1" ondblclick="load_popup2('#view_prod','#title_popup<?php echo $pageid1; ?>','<?php echo $pageid1; ?>')" style="<?php echo $btn_theme_style,$pagetitleposition1;?>"><?php echo $pagetitle1;?></div>
    <div id="add_item_page_<?php echo $pageid1;?>"></div>
<div class=" <?php echo $class_arr['prod_detail_content'];?>" ondblclick="load_popup('#view_prod','#view_prod_detail')" style="margin-bottom: 101px"> 
    
     <div class="container">
        <div class="<?php echo $class_arr['prod_d_image'];?>" >
            <img class="img-thumbnail" src="<?=BASE_URL?>edit_assets/shope_image/1.jpg" width="100%">            
        </div>       
    <div class="row col-md-7 col-lg-7">
    <div class="<?php echo $class_arr['prod_d_detail_box'];?>" >
        <div class="<?php echo $class_arr['prod_d_name'];?> text-capitalize">
            <pb class="prod_d_title"><b>  </b></pb> Fresh fruits
            <div class="bottom_border"></div>
        </div>      
           
        <div class="<?php echo $class_arr['prod_d_detail'];?>">
             <pb class="prod_d_title"><b> </b></pb>
            Obama was in secret campaign mode this morning, delivering a rousing address to union members at the United Autoworkers      
        </div>
    </div>  
   
        <div class="<?php echo $class_arr['prod_d_cart_box'];?> " >      
            <div class="col-lg-12 ">
                <div class="col-lg-12 bgcolor">
                <div class="<?php echo $class_arr['prod_d_price'];?>">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left prod_d_title">Price:</div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left">                
                        <pb class="prod_d_title"><b></b></pb>$2100.00
                    </div>  
                 </div>
                <div class="col-sm-12 col-lg-12 <?php echo $class_arr['prod_select_Quantity'];?> control-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left">                        
                        <pb class="prod_d_title"><b>  </b>Select Quantity:</pb> 
                    </div>                    
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <input type="number"  min="1" value="1" class="form-control input-sm"  disabled="">
                    </div>                    
                </div>            
                <div class="<?php echo $class_arr['prod_d_cart_btn'];?> pull-right">
                    <a href="" class="btn btn-success btn-block"> 
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        Add to Cart
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div> 
         <?php /*?>
    <div class="<?php echo $class_arr['prod_d_search_box'];?>">
                <div class="col-xs-12 col-sm-12"><pb style="color: #000000; text-align: left;font-size: 16px;float: left;">check product availability delivery timeline at your location</pb></div>         
                <div class="col-xs-12 col-sm-12">
                    <form class="form-search">
                   <div class="input-append">
                     <input type="text" class="span2 search-query">
                     <button type="submit" class="btn btn-success">Search</button>
                   </div>
                    </form>
                </div>
        </div> <?php */?>
     </div>
</div>
<?php }?> 
<?php if($user_edit_panel){ ?>
<script>
$(document).ready(function(){
    $(".prod_detail_content a").removeAttr("href");
          });  
 </script> 
 
<?php }else{ ?>
 <script>
   function add_to_cart(id){
       var qty=$("#qty_"+id).val();
       window.location.href="<?=BASE_URL?>editpenalcontroller/addtocart/"+id+"/"+qty+"/details";
   }
</script>
<?php } ?>


