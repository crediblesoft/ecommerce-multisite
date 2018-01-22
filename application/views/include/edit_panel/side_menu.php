

<link href="<?php echo  BASE_URL;?>edit_assets/side_menu/examples/slidemenu.css" rel="stylesheet">
<script src="<?php echo  BASE_URL;?>edit_assets/side_menu/examples/jquery.slidemenu.js"></script>


<div class="slide-menu horizontal-open hidden-xs">
  <ul class="menu-items">
    <li class="menu-item" data-target="#Panel1" title="Add">
      <div class="menu-icon"> <i class="fa fa-plus-circle"></i> </div>
      <div class="menu-content"> <span>Add Items</span> </div>
      <div class="menu-close"> <i class="fa fa-times"></i> </div>
    </li>
    <li id="CalendarIcon" class="menu-item" data-target="#Panel2" title="Panel 2">
      <div class="menu-icon"> <i class="fa fa-list-alt"></i> </div>
      <div class="menu-content"> <span>Panel 2</span> </div>
      <div class="menu-close"> <i class="fa fa-times"></i> </div>
    </li>
    <li id="ShoppingIcon" class="menu-item" data-target="#Panel3" title="Design">
      <div class="menu-icon"> <i class="fa fa-paint-brush"></i> </div>
      <div class="menu-content"> <span>Design</span> </div>
      <div class="menu-close"> <i class="fa fa-times"></i> </div>
    </li>
    <li id="SearchIcon" class="menu-item" data-target="#Panel4" title="Panel 4">
      <div class="menu-icon"> <i class="fa fa-calendar"></i> </div>
      <div class="menu-content"> <span>Panel 4</span> </div>
      <div class="menu-close"> <i class="fa fa-times"></i> </div>
    </li>
    <li id="BugIcon" class="menu-item" data-target="#Panel5" title="Panel 5">
      <div class="menu-icon"> <i class="fa fa-search"></i> </div>
      <div class="menu-content"> <span>Panel 5</span> </div>
      <div class="menu-close"> <i class="fa fa-times"></i> </div>
    </li>
    <li  id="savelastoption" class="menu-item" data-target="#Panel6" title="new item">
        
      <div class="menu-icon"> <i class="fa fa-search"></i> <a onclick="add_item_id1()">click me </a></div>
      <div class="menu-content"> <span>Panel 5</span> </div>
      <div class="menu-close"> <i class="fa fa-times"></i> </div>        
    </li>
  </ul>
    <style>
    .menu-m-items {
    background-color: #c2c3c1;
    height: 100%;
    left: 0;
    margin: 5px auto;
    padding: 0;
    position: absolute;
    width: 100%;
    z-index: 1;
}
    .menu-m-items .menu-m-item {
    background-color: #F1F9F7;
    border-bottom: 1px solid #aaaba9;
    border-top: 1px solid #aaaba9;
    cursor: pointer;
    display: block;
    font-size: 26px;
    left: 0;
     margin: 1px auto;
    position: relative;
    width: 100%;
}
   .menu-m-items > li:hover{
        background: #009999;
        border: 1px solid #004499;
        font-size: 32px; 
    }

    </style>
    <?php function add_space($no){$val='';for($i=0;$i<=$no;$i++){$val=$val.'&nbsp;';}return $val;}?>
  <div class="menu-panels">
    <div id="Panel1" class="menu-panel">
        <div class="col-md-12">
            <ul class="menu-m-items">
                <li id="image" class="menu-m-item"><i class="fa fa-image"></i><?php echo add_space(5);?>Image</li>
                <li id="textarea" class="menu-m-item"><i class="fa fa-font"></i><?php echo add_space(5);?>Text</li>
                <li id="button" class="menu-m-item"><i class="fa fa-bold"></i><?php echo add_space(5);?>Buttons</li>
            </ul>
        </div>        
    </div>
    <div id="Panel2" class="menu-panel">
      <div class="col-md-12">
            <ul class="menu-m-items">
                <li class="menu-m-item"><i class="fa fa-image"></i><?php echo add_space(5);?>Image</li>
                <li class="menu-m-item"><i class="fa fa-font"></i><?php echo add_space(5);?>Text</li>
                <li class="menu-m-item"><i class="fa fa-bold"></i><?php echo add_space(5);?>Buttons</li>
            </ul>
        </div>
    </div>
    <div id="Panel3" class="menu-panel">
      <div class="col-md-12">
            <ul class="menu-m-items">
                <li class="menu-m-item"><i class="fa fa-image"></i><?php echo add_space(5);?>Image</li>
                <li class="menu-m-item"><i class="fa fa-font"></i><?php echo add_space(5);?>Text</li>
                <li class="menu-m-item"><i class="fa fa-bold"></i><?php echo add_space(5);?>Buttons</li>
            </ul>
        </div>
    </div>
    <div id="Panel4" class="menu-panel">
      <div class="col-md-12">
            <ul class="menu-m-items">
                <li class="menu-m-item"><i class="fa fa-image"></i><?php echo add_space(5);?>Image</li>
                <li class="menu-m-item"><i class="fa fa-font"></i><?php echo add_space(5);?>Text</li>
                <li class="menu-m-item"><i class="fa fa-bold"></i><?php echo add_space(5);?>Buttons</li>
            </ul>
        </div>
    </div>
    <div id="Panel5" class="menu-panel">
      <div class="col-md-12">
            <ul class="menu-m-items">
                <li class="menu-m-item"><i class="fa fa-image"></i><?php echo add_space(5);?>Image</li>
                <li class="menu-m-item"><i class="fa fa-font"></i><?php echo add_space(5);?>Text</li>
                <li class="menu-m-item"><i class="fa fa-bold"></i><?php echo add_space(5);?>Buttons</li>
            </ul>
        </div>
    </div>
      
      <div id="Panel6" class="menu-panel">
      <div class="col-md-12">
            <ul class="menu-m-items">
                <li class="menu-m-item"><i class="fa fa-image"></i><?php echo add_space(5);?>Image</li>
                <li class="menu-m-item"><i class="fa fa-font"></i><?php echo add_space(5);?>Text</li>
                <li class="menu-m-item"><i class="fa fa-bold"></i><?php echo add_space(5);?>Buttons</li>
            </ul>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(function() {
		$(".slide-menu").slidemenu();
                $(".menu-panels li").click(function(){  
                    $("#savelastoption").css('display','block');
                    alert('#add_item_page_'+$("#myTab li.active").attr('id'));
                    var page_id=$("#myTab li.active").attr('id');
                    /*using only for get side name for daynamic pages*/
                    var site_name=$("#site_url").val();
                    var type_of_append=this.id;
                    var item=add_item_class(type_of_append,site_name);
                    $("#add_item_page_"+page_id).append($(item));                     
                    draggble_resizble('.item_'+type_of_append,'.div_'+type_of_append);
                });
	});
       
       function draggble_resizble(itemid,divid)
       {
           $(itemid).resizable({
               containment: divid,
                handle: 'n, e, s, w, ne, se, sw, nw'    
              })
                .draggable({
               containment: divid,
                handle: 'n, e, s, w, ne, se, sw, nw'    
                    })
                .css("cursor", "move");  
       }
        function add_item_class(type_of_append,site_name)
        {
            switch(type_of_append) 
            {
            case 'image':
                return '<div class="div_'+type_of_append+'" style="width: 150px;" title="click And drag me" >*<img class="item_'+type_of_append+' img-responsive" alt="image" src="'+site_name+'edit_assets/image/my.jpg" style="position: absolute;z-index: 1;" /></div>';
            break;
                
            case 'textarea':
                return '<div class="div_'+type_of_append+'" style="width: 150px;" title="click And drag me">*<textarea id="tt" class="item_'+type_of_append+'" style="background: transparent;border: 1px solid #F5F5F5;"></textarea></div>';
            break;
                
            case 'button':
                return '<div class="div_'+type_of_append+'" style="width: 150px;"title="click And drag me">*<input type="button" id="bb" class="item_'+type_of_append+'" value=""  ></div>';
            break;
                
            default:
                alert('not match');
            break;
             }
            //<img class="image_as" alt="image" src="edit_assets/image/process.gif" style="position: relative;z-index: 1;"/>
        }
        function add_item_id()
        {
            
        }
   function change_array_value(id)
    {
        alert(id);
        //$('.add_item_page_').attr('id','add_item_page_'+id)
        var data="<div id='add_item_page_"+id+"' class='add_item_page_'>asdasd</div>";
        if($('#add_item_page_'+id).length<1){//alert('sdfsd');
        $('#add_item_page_').append($(data));}
    
    }
</script>
