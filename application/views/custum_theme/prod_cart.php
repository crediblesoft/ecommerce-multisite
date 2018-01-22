<?php 
//print_r($this->cart->contents());exit;
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
    
    'prod_c_container'=>'prod_c_container',
    'prod_c_item'=>'prod_c_item',
    'image_detail_cart'=>'image_detail_cart',
    'prod_c_price'=>'prod_c_price',    
    'prod_c_d_price'=>'prod_c_d_price',
    'prod_c_add_prod'=>'prod_c_add_prod',
    'prod_c_add_cart'=>'prod_c_add_cart',
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
                        if(($data['bootstrap_name']=='float'))
                        {
                        if(($data['bootstrap_num']!='none'))
                            {
                            $class_arr[$ar].=" ".$data['bootstrap_num'];                                
                            }                                
                        }
                        else
                        {
                         $class_arr[$ar].=" ".$data['bootstrap_name'].$data['bootstrap_num'];                                          
                          //echo $class_arr[$ar]."</br>";  
                        }
                       
                    }
         }
    } 
?> 
<style>
     .prod_cart{
            display: inline-block;            
            line-height: normal;
            line-height: 150px;
        }
        /*.prod_cart_detail{color: #3c3c3c;}
        .prod_cart_titel{font-size: 25px; background-color: #449D44;color:#ffffff;padding: 19px;height: 60px;}
        .cart_btn_po{background-color: #E13300;color:#ffffff;}
        .cart_btn_po:hover{background-color: #449D44;color:#ffffff;}
        .cart_btn{background-color: #449D44;color:#ffffff;}
        .cart_btn:hover{background-color: #9FA290;color:#E13300;}
        .prod_c_container{background-color:#ffffff;}
        .prod_c_item{border-bottom: 1px solid #000000;}        
        .image_detail_cart{padding: 30px 0px 28px 0px;background-color: #ffffff;font-size: 16px;border-right:  1px solid #000000;}
        .prod_c_price{vertical-align: middle;text-align: center; font-size: 27px;color: #73C873;border-right: 1px solid #000000;}
        .prod_c_d_price{vertical-align: middle;text-align: center; font-size: 27px;color: #E13300;text-decoration: line-through;border-right: 1px solid #000000;}
        .prod_c_add_prod{vertical-align: middle;text-align: center; border-right: 1px solid #000000;}
        .prod_c_add_cart{vertical-align: middle;text-align: center; font-size: 17px;color: #000000;border-right: 1px solid #000000;}
       */
    </style>
   
<div class="<?php echo $class_arr['prod_c_container'];?>" ondblclick="load_popup('#view_prod','#view_prod_cart')">
   <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
        <div class="col-md-6 col-md-offset-3 galary_hader" style="<?php echo $btn_theme_style;?>"><?php echo $pagename2;?></div>
   </div>
   <div id="add_item_page_<?php echo $pageid2;?>"></div>
    <div class="container" style="border: 3px solid #F5F5F5;margin-bottom: 101px">
    
       
       <!----this is only for lg size--->
    
        <div class="hidden-xs hidden-sm col-xs-12 col-md-12" style="vertical-align: middle;text-align: center; line-height: 50px; background-color: #F5F5F5;height: 50px;font-size: 16px; float: left">
            <div class="col-xs-12 col-md-4" >Product Detail
            </div>
            <div class="col-xs-12 col-md-2">Price</div>
            <div class="col-xs-12 col-md-2">Discount Price</div>
            <div class="col-xs-12 col-md-2">Product Quantity</div>
            <div class="col-xs-12 col-md-2">Remove/Total</div>
        </div>
       <?php if(!$user_edit_panel){?>
       
      <!--for rial dataaa use onlyy start---->
       
       <?php echo form_open(BASE_URL."editpenalcontroller/updatecart/".$user_name); ?>
       
       
    <?php $i = 1;
                    //print_r($this->cart->contents()) ?>
            <?php foreach ($this->cart->contents() as $items): ?>
                    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
       <?php if($session_user_id=='111'){?>
      <?php  $productoption=$this->cart->product_options($items['rowid']); ?>
      <div class="<?php echo 'hidden-xs hidden-sm '.$class_arr['prod_c_item'];?>" >
        <div class="<?php echo $class_arr['image_detail_cart'];?>" >
            <div class="col-xs-12 col-md-6">
                <img class="img-thumbnail" src="<?php echo BASE_URL."assets/image/product/thumb/".$productoption['image']?>" width="100%">
            </div>
            <div class="col-xs-12 col-md-6 prod_cart_detail">
                <?php echo $items['name']; ?> , <?php echo $productoption['Category']; ?>
               <?php //echo substr("product name John s fs f asd as d as das d a product detail fsdfsdf sdfsdffsd",0,100);?>
               
            </div>                
            </div>
            <div class="prod_cart <?php echo $class_arr['prod_c_price'];?>" >
                <?php echo $this->cart->format_number($items['price']); ?>$/-
            </div>
            <div class="prod_cart <?php echo $class_arr['prod_c_d_price'];?>" >
                <?php echo $this->cart->format_number($items['price']); ?>$/-
            </div>
        <div class="prod_cart <?php echo $class_arr['prod_c_add_prod'];?>" style="padding: 0;" >
            <a href="<?=BASE_URL?>editpenalcontroller/add_more_cart/<?=$items['id']?>" class="btn cart_btn"> 
                           <span class="glyphicon glyphicon-plus"></span>
                       </a> 
                      <a  class="btn btn-white" style="pointer-events: none;"> 
                          <?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3','style'=>'width: 35px;', 'size' => '5' ,'autocomplete'=>'off', 'onkeyup'=>'checkcart(this.value)')); ?>
                       </a>
            <!--<input disabled="" type="text" min="1" value="2" style="width: 40px; height: 40px" >-->
            <a href="<?=BASE_URL?>editpenalcontroller/subtract_more_cart/<?=$items['id']?>" class="btn cart_btn"> 
                           <span class="glyphicon glyphicon-minus"></span>                    
                       </a></div>
        <div class="prod_cart <?php echo $class_arr['prod_c_add_cart'];?>" >
                 
                     <p> <a href="#removecart" id="<?=$items['rowid']?>" class="remove btn cart_btn" data-traget="#removecart" data-toggle="modal">Remove</a>
                     <?php echo $this->cart->format_number($items['subtotal']); ?></p>
            </div>
        </div>
    
    <div class="<?php echo 'hidden-lg hidden-md '.$class_arr['prod_c_item'];?>" >
            <div class="<?php echo $class_arr['image_detail_cart'];?>" >
                Product Detail
                <div class="col-xs-12 col-md-6">
                <img class="img-thumbnail" src="<?=BASE_URL?>assets/image/product/thumb/<?=$productoption['image']?>" width="100%">
                </div>
                <div class="col-xs-12 col-md-6 prod_cart_detail">
                    <?php echo $items['name']; ?> , <?php echo $productoption['Category']; ?>
                   <?php //echo substr("John s fs f asd as d as das d afsdfsdfsdfsdffsd",0,100);?>
                    <p> <a href="#removecart" id="<?=$items['rowid']?>" class="remove" data-traget="#removecart" data-toggle="modal">Remove</a></p>
                </div>
            </div>
            <div class="<?php echo $class_arr['prod_c_price'];?>" >
                Price
                <?php echo $this->cart->format_number($items['price']); ?>$/-                
            </div>
            <div class="<?php echo $class_arr['prod_c_d_price'];?>">
                Discount Price
                <?php echo $this->cart->format_number($items['price']); ?>$/- 
            </div>
            <div class="<?php echo $class_arr['prod_c_add_prod'];?>" >
              Product Quantity
                 
              <a href="<?=BASE_URL?>editpenalcontroller/add_more_cart/<?=$items['id']?>" class="btn cart_btn"> 
                           <span class="glyphicon glyphicon-plus"></span>
                       </a> 
              <a  class="btn btn-white" style="pointer-events: none;"> 
                          <?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5' ,'autocomplete'=>'off', 'onkeyup'=>'checkcart(this.value)')); ?>
                       </a>
            <!--<input disabled="" type="text" min="1" value="2" style="width: 40px; height: 40px" >-->
              <a href="<?=BASE_URL?>editpenalcontroller/subtract_more_cart/<?=$items['id']?>" class="btn cart_btn"> 
                           <span class="glyphicon glyphicon-minus"></span>                    
                       </a>
                  
            </div>
            <div class="<?php echo $class_arr['prod_c_add_cart'];?>" >
                Remove
                   <p> <a href="#removecart" id="<?=$items['rowid']?>" class="remove btn cart_btn" data-traget="#removecart" data-toggle="modal">Remove</a>
                   <?php echo $this->cart->format_number($items['subtotal']); ?>
                   </p>
                   
            </div>
        </div>
      
      
       <?php }?>
        <?php $i++; ?>
      
                         <?php endforeach; ?>
                             <?php 
                                $this->load->view("custum_theme/include/alert_prod_cart_pop.php");
                                ?>
      <script>
    $(".remove").click(function(){
        var id=$(this).prop('id');
        $("#deleteId").val(id);
    });
    
    $("#delete").click(function(){
        var deleteId=$("#deleteId").val();
        $.post("<?=BASE_URL?>editpenalcontroller/deletecart",{id:deleteId},function(data,status){
            obj=$.parseJSON(data);
            if(obj.status){
               $("#e-result-delete").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
            }else
                {
                    $("#e-result-delete").empty().append(obj.message).addClass("alert alert-error fade in");
                }
        });
    });
    
    
    function checkcart(val){
        if(parseInt(val)<= 0){
            $('#status').modal('show');
        }
    }
</script>
      
       <!---for real data used only end -->
       
       
    
       
       
       <!--for demo  data for editing panel use only start---->
       
    <?php }else{ 
        for($i=0;$i<=1;$i++){?>
    <div class="<?php echo 'hidden-xs hidden-sm '.$class_arr['prod_c_item'];?>" >
        <div class="<?php echo $class_arr['image_detail_cart'];?>" >
            <div class="col-xs-12 col-md-6">
                <img class="img-thumbnail" src="<?=BASE_URL?>edit_assets/shope_image/1.jpg" width="100%">
            </div>
            <div class="col-xs-12 col-md-6 prod_cart_detail">
               <?php echo substr("product name John s fs f asd as d as das d aproduct detail fsdfsdf sdfsdffsd",0,100);?>
            </div>                
            </div>
            <div class="prod_cart <?php echo $class_arr['prod_c_price'];?>" >
                500$/-
            </div>
            <div class="prod_cart <?php echo $class_arr['prod_c_d_price'];?>" >
                600$/-
            </div>
        <div class="prod_cart <?php echo $class_arr['prod_c_add_prod'];?>" style="padding: 0;" >
                <a onclick="alert('not ective')" class="btn cart_btn"> 
                           <span class="glyphicon glyphicon-plus"></span>
                       </a> 
                      <a  class="btn btn-white" style="pointer-events: none;"> 
                           2
                       </a>
            <!--<input disabled="" type="text" min="1" value="2" style="width: 40px; height: 40px" >-->
                  <a onclick="alert('not ective')" class="btn cart_btn"> 
                           <span class="glyphicon glyphicon-minus"></span>                    
                       </a></div>
        <div class="prod_cart <?php echo $class_arr['prod_c_add_cart'];?>" >
                 <a onclick="alert('not ective')" class="btn cart_btn"> 
                    Remove
                </a>
            </div>
        </div>
    <?php }
        }?>
       <!----hare it's close  lg size--->
    <!----this is only for xs size--->
    <?php for($i=0;$i<=1;$i++){?>
    <div class="<?php echo 'hidden-lg hidden-md '.$class_arr['prod_c_item'];?>" >
            <div class="<?php echo $class_arr['image_detail_cart'];?>" >
                Product Detail
                <div class="col-xs-12 col-md-6">
                <img class="img-thumbnail" src="<?=BASE_URL?>edit_assets/image/aa.png" width="100%">
                </div>
                <div class="col-xs-12 col-md-6 prod_cart_detail">
                   <?php echo substr("John s fs f asd as d as das d a
                    fsdfsdfsdfsdffsd",0,100);?>
                </div>
            </div>
            <div class="<?php echo $class_arr['prod_c_price'];?>" >
                Price
                500$/-                
            </div>
            <div class="<?php echo $class_arr['prod_c_d_price'];?>">
                Discount Price
                600$/- 
            </div>
            <div class="<?php echo $class_arr['prod_c_add_prod'];?>" >
              Product Quantity
                 
                      <a onclick="alert('not ective')" class="btn cart_btn"> 
                           <span class="glyphicon glyphicon-plus"></span>
                       </a> 
              <a  class="btn btn-white" style="pointer-events: none;"> 
                           2
                       </a>
            <!--<input disabled="" type="text" min="1" value="2" style="width: 40px; height: 40px" >-->
                  <a onclick="alert('not ective')" class="btn cart_btn"> 
                           <span class="glyphicon glyphicon-minus"></span>                    
                       </a>
                  
            </div>
            <div class="<?php echo $class_arr['prod_c_add_cart'];?>" >
                Remove
                <a onclick="alert('not ective')" class="btn cart_btn btn-block"> 
                    Remove
                </a></div>
        </div>
    <?php }?>
    <!--for demo  data for editing panel use only start---->
    
    
    <!----hare it's close  xs size--->
 <?php /*?> <div class="col-xs-12 col-md-12" style="background-color: #ffffff;height: 50px;font-size: 16px; float: left">
        
    </div>
  <div class="table-responsive">    
  <table class="table table-striped table-bordered">
        <thead style="background-color: #D0D0D0;height: 50px;font-size: 16px;">
      <tr >
        <th style="width:40%;">Product Detail</th>          
        <th >Price</th>
        <th>Discount Price</th>
        <th>Product Quantity</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
      <?php for($i=0;$i<=1;$i++){?>      
        <tr>
          <td style=" padding: 30px 10px 28px 10px">
              <div class="col-xs-12 col-md-5">
                  <img class="img-thumbnail" src="<?=BASE_URL?>edit_assets/image/aa.png" width="100%">
              </div>
              <div class="col-xs-12 col-md-7">
                  John s fs f asd as d as das d a
              </div>
              <div class="col-xs-12 col-md-7">
                  
              </div>              
          </td>          
          <td style="text-align: center; vertical-align: middle; font-size: 27px;color: #73C873;">500$/-</td>
          <td style="text-align: center; vertical-align: middle; font-size: 27px;color: #E13300;text-decoration: line-through;">600$/-</td>
          <td style="text-align: center; vertical-align: middle; ">
              <div class="col-xs-12 col-md-12"> 
                      <a onclick="alert('not ective')" class="btn btn-success"> 
                           <span class="glyphicon glyphicon-plus"></span>
                       </a> 
                      <a  class="btn btn-white" style="pointer-events: none;"> 
                           2
                       </a>
                  <a onclick="alert('not ective')" class="btn btn-success"> 
                           <span class="glyphicon glyphicon-minus"></span>                    
                       </a>
                  </div>
          </td>
            <td style="text-align: center; vertical-align: middle; font-size: 17px;color: #000000;">
                <a onclick="alert('not ective')" class="btn btn-success btn-block"> 
                    <span class="glyphicon glyphicon-remove"></span>
                    Add to Cart
                </a>
            </td>
      </tr>
      <?php }?>
    </tbody>
  </table>
  * </div>
 <?php */?>
    <div class="col-xs-12 col-md-12" style="text-align: center; vertical-align: middle; height: 100px;font-size: 25px; background-color: #ffffff;">       
            Total Order Amount : <?php echo $this->cart->format_number($this->cart->total()); ?>$       
    </div>
    <div class=" col-xs-12 col-md-12" style="text-align: center; vertical-align: middle; font-size: 25px; background-color: #F5F5F5;">
        <div class="col-xs-12 col-md-4" style="padding: 25px;">
            <a onclick="alert('not ective')" class="btn btn-block cart_btn" style="height: 50px; font-size: 24px; ">                     
                        Continue Shopping
            </a>
        </div>
        <div class="col-xs-12 col-md-4 right" style="padding: 25px;">
            <a onclick="alert('not ective')" class="btn btn-block cart_btn_po" style="height: 50px; font-size: 24px;"> 
                <span class="glyphicon glyphicon-shopping-cart"></span>
               <!-- <img class="img-thumbnail" src="<?=BASE_URL?>edit_assets/image/app_type_shop.png" width="100%">-->
                        Place Order
            </a>
        </div>
    </div>
    </div>
</div>

