<?php include 'db_include.php';   ?>     
<div  id="menu_popup" style=" z-index: 10;position: absolute;left: 898px; top: 47px; visibility: visible;width: 500px;height: 500px; display: none; background-color: #DFDFDF; " state="disabled notRotatable" class="window_popup custom" >
   
    
   
    <div class="col-sm-12"> 
        <div class="col-sm-6">Background Color</div>
        <div class="col-sm-6">
            <input type="color" class="input-sm" onchange="abc('.center_content','background-color','#background')" value="<?php echo getcss($_SESSION['user_id'], '.center_content' , 'background-color');?>"  id="background"></div>
    </div>    
    <div class="col-sm-12">
        <div class="col-sm-6">Title</div>
        <div class="col-sm-6">
            <input type="color" name="name-color" onchange="abc('.product_title a','color','#title-color')" id="title-color" value="<?php echo getcss($_SESSION['user_id'] , '.product_title a' , 'color');?>" class="input-sm">
            <input type="number" class="input-sm" id="title-font-size"  name="name-font-size" onchange="abc('.product_title a','font-size','#title-font-size')" value="<?php echo intval(getcss($_SESSION['user_id'] , '.product_title a' , 'font-size'));?>" >
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">D Price </div>
        <div class="col-sm-6">
            <input type="color" name="name-color" onchange="abc('.reduce','color','#name-color')" id="name-color" value="<?php echo getcss($_SESSION['user_id'] , '.reduce' , 'color'); ?>" class="input-sm">
            <input type="number" class="input-sm" onchange="abc('.reduce','font-size','#name-font-size')" name="name-font-size" value="<?php echo intval(getcss($_SESSION['user_id'] , '.reduce' , 'font-size')); ?>" id="name-font-size" >
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">Price</div>
        <div class="col-sm-6">
            <input type="color" onchange="abc('.price','color','#price-color')" name="price-color" id="price-color" value="<?php echo getcss($_SESSION['user_id'] , '.price' , 'color');//echo $pricecolor[1]; ?>" class="input-sm">
            <input type="number" onchange="abc('.price','font-size','#price-font-size')" class="input-sm" name="price-font-size" value="<?php echo intval(getcss($_SESSION['user_id'] , '.price' , 'font-size'));//if(($pricesize[1]==NULL)||($pricesize[1]=="")){echo '14';}else{echo $pricesize[1];}  ?>" id="price-font-size" >
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-5">image </div>
        <div class="col-sm-7">
            W<input type="number" onchange="abc('.product_img img','width','#product-width-size')" class="input-sm" id="product-width-size" name="product-width-size" value="<?php echo intval(getcss('121' , '.product_img img' , 'width'));  ?>"  >
            H<input type="number" onchange="abc('.product_img img','height','#product-height-size')" class="input-sm" id="product-height-size" name="product-height-size" value="<?php echo intval(getcss('121' , '.product_img img' , 'height'));  ?>"  >
          </div>
    </div>
    <!--<div class="col-sm-12">
        <div class="col-sm-5">add new tab</div>
        <div class="col-sm-7">
            P.R.<input type="number" onchange="abc('product_img','padding-right','product-pr-size')" class="input-sm" id="product-pr-size" name="product-pr-size" value="<?php if(($pricesize[1]==NULL)||($pricesize[1]=="")){echo '5';}else{echo $pricesize[1];}  ?>"  >
            P.L.<input type="number" onchange="abc('product_img','padding-left','product-pl-size')" class="input-sm" id="product-pl-size" name="product-pl-size" value="<?php if(($pricesize[1]==NULL)||($pricesize[1]=="")){echo '0';}else{echo $pricesize[1];}  ?>"  >
            
          </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-5">image padding T B</div>
        <div class="col-sm-7">
            P.T.<input type="number" onchange="abc('product_img','padding-top','product-pt-size')" class="input-sm" id="product-pt-size" name="product-pt-size" value="<?php if(($pricesize[1]==NULL)||($pricesize[1]=="")){echo '5';}else{echo $pricesize[1];}  ?>"  >
            P.D.<input type="number" onchange="abc('product_img','padding-bottom','product-pd-size')" class="input-sm" id="product-pd-size" name="product-pd-size" value="<?php if(($pricesize[1]==NULL)||($pricesize[1]=="")){echo '0';}else{echo $pricesize[1];}  ?>"  >
          </div>
    </div>-->
    <div class="col-sm-12">
        <div class="col-sm-5">view product's</div>
        <div class="col-sm-7">
            
            <select class="form-control" id="sel1" onchange="abc2('.prod_box','width','#sel1')">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
  </select>
            
          </div>
    </div>
    <button class="btn btn-default" onClick="d_off('#menu_popup')">close</button>
 </div>
<script type="text/javascript" >
   
    $(function() { $('#menu_popup').draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'
  });
  $('#main_content').resizable({
    handles: 'n, e, s, w, ne, se, sw, nw'
  });
  $('#main_content').css("cursor", "move");
  
    });	</script>