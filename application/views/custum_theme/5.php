<div class="row" id="page_no<?php echo '0';?>">
    <div id="add_item_page<?php echo '0';?>"></div>
    <div class="container">
        <img class="image_as" src='<?php echo  BASE_URL;?>edit_assets/image/process.gif'/> 
    </div>
</div>
    
<script type="text/javascript" >
   $(function() { $(<?php echo '".image_as"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  });  
  $(<?php echo '".image_as"';?>).css("cursor", "move");  
    });
    </script>
            