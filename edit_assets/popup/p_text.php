<?php include 'db_include.php';   ?>
<script>
       /* $( document ).ready(function(){                        
            $(document).on("dblclick",".footer",function(){                            
                $("#footer_popup").css("display","block");    
            });
        });*/
    
        
        </script>
        
        
<div  id="pop_text" style="z-index: 10;position: absolute;left: 898px; top: 47px; visibility: visible;height: 500px;display: none; background-color: #DFDFDF; " state="disabled notRotatable" class="window_popup custom" >
   
    <div skinpart="topBar" class="ee" >
        <strong auto-id="propertyPanelTitle" skinpart="panelLabel" class="wysiwyg_editor_skins_panels_ComponentPanelSkin-panelLabel">Header</strong>
        <div class="wysiwyg_editor_skins_panels_ComponentPanelSkin-c-topBarActions">
           <div class="wysiwyg_editor_skins_panels_ComponentPanelSkin-c-help" skinpart="help"><span>&nbsp;\</span></div>
           <div skinpart="close" class="wysiwyg_editor_skins_panels_ComponentPanelSkin-close"><span>&nbsp;\</span></div>
        </div>
    </div>
    
    <div class="col-sm-12"> 
        <div class="col-sm-6">Background Color</div>
        <div class="col-sm-6">
            <input type="color" class="input-sm" onchange="abc('.avxccxc','background-color','#background')" value="<?php echo getcss($_SESSION['user_id'] , '.avxccxc' , 'background-color');?>"  id="background"></div>
    </div>    
    <div class="col-sm-12">
        <div class="col-sm-6">Text</div>
        <div class="col-sm-6">
            <input type="color" name="name-color" onchange="abc('.avxccxc','color','#title-color')" id="title-color" value="<?php echo getcss($_SESSION['user_id'] , '.avxccxc' , 'color'); ?>" class="input-sm">
            <input type="number" class="input-sm" id="title-font-size"  name="name-font-size" onchange="abc('.avxccxc','font-size','#title-font-size')" value="<?php echo intval(getcss($_SESSION['user_id'] , '.avxccxc' , 'font-size'));?>" >
        </div>
    </div>
    <!--<div class="col-sm-12">
        <div class="col-sm-6">Text Height Width </div>
        <div class="col-sm-6">
            <input type="color" name="name-color" onchange="abc('avxccxc','color','name-color')" id="name-color" value="<?php echo getcss($_SESSION['user_id'] , '.avxccxc' , 'color');?>" class="input-sm">
            <input type="number" class="input-sm" onchange="abc('avxccxc','font-size','name-font-size')" name="name-font-size" value="<?php echo intval(getcss($_SESSION['user_id'] , '.avxccxc' , 'font-size')); ?>" id="name-font-size" >
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">Price</div>
        <div class="col-sm-6">
            <input type="color" onchange="abc('price','color','price-color')" name="price-color" id="price-color" value="<?php echo getcss($_SESSION['user_id'] , '.price' , 'color');//echo $pricecolor[1]; ?>" class="input-sm">
            <input type="number" onchange="abc('price','font-size','price-font-size')" class="input-sm" name="price-font-size" value="<?php echo intval(getcss($_SESSION['user_id'] , '.price' , 'font-size')); ?>" id="price-font-size" >
        </div>
    </div>-->
    <div class="col-sm-12">
        <div class="col-sm-5">text H W </div>
        <div class="col-sm-7">
            W<input type="number" onchange="abc('.avxccxc','width','#product-width-size')" class="input-sm" id="product-width-size" name="product-width-size" value="<?php echo intval(getcss($_SESSION['user_id'] , '.avxccxc' , 'width'));  ?>"  >
            H<input type="number" onchange="abc('.avxccxc','height','#product-height-size')" class="input-sm" id="product-height-size" name="product-height-size" value="<?php echo intval(getcss($_SESSION['user_id'] , '.avxccxc' , 'height'));  ?>"  >
          </div>
    </div>
   <?php /*?> <div class="col-sm-12">
        <textarea class="editor" name="textarea"  id="textarea" >
<?php echo get_text('121', 'footer', ''); ?>
</textarea>
 <link href="tools/demo/demo.css" rel="stylesheet" type="text/css"/>
<link href="tools/demo/jquery-te-1.4.0.css" rel="stylesheet" type="text/css"/>
<script src="tools/demo/jquery.min.js" type="text/javascript"></script>
<script src="tools/demo/jquery-te-1.4.0.min.js" type="text/javascript"></script>
<script>
   $('.editor').jqte();
	$(".editor").jqte({button: "SEND"});
        
        $(".editor").jqte({change: function(){ alert($(".editor").val()); }});
</script>

    </div>
    *  <div class="col-sm-12">
        <div class="col-sm-5">view product's</div>
        <div class="col-sm-7">
            
            <select class="form-control" id="sel1" onchange="abc2('prod_box','width','sel1')">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
  </select>
    *  </div>
    * </div>
   <?php */?> 
   
            
         
    
    <button class="btn btn-default" onClick="d_off('#footer_popup')">close</button>
 </div>
        

