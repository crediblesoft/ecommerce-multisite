<style>
    .menu-m-items {
    background-color: #c2c3c1;
    height: 100%;
    left: 0;
    margin: 5px auto;
    padding: 0;
    position: absolute;
    width: 100%;
    z-index: 1001;
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
    
    #pophover_sidemenu{
        height: 52px !important;
        top:200px !important;
    }
    .menu-panels{
        height:0px !important;
        background: none;
    }
    
    .menu-close:hover .popover{
       display: none !important;
    }
    
    .slide-menu .menu-panels{
        border:none !important;
    }
    </style>
<?php echo mouceiconeonclick('.menu-items');?>
<link href="<?php echo  BASE_URL;?>edit_assets/side_menu/examples/slidemenu.css" rel="stylesheet">
<script src="<?php echo  BASE_URL;?>edit_assets/side_menu/examples/jquery.slidemenu.js"></script>
<?php 
function add_space($no)
{
    $val='';
    for($i=0;$i<=$no;$i++)
    {
        $val=$val.'&nbsp;';        
    }
    return $val;   
}?>

<div class="slide-menu horizontal-open hidden-xs "  id="pophover_sidemenu">
  <ul class="menu-items">
    <li class="menu-item" data-target="#Panel1" title="Add">
      <div class="menu-icon"> <i class="fa fa-paint-brush"></i> </div>
      <div class="menu-content"> <span>Add Items</span> </div>
      <div class="menu-close"> <i class="fa fa-times"></i> </div>
    </li>
    <!--<li id="CalendarIcon" class="menu-item" data-target="#Panel2" title="Background">
      <div class="menu-icon"> <i class="fa fa-eyedropper"></i> </div>
      <div class="menu-content"> <span>Background</span> </div>
      <div class="menu-close"> <i class="fa fa-times"></i> </div>
    </li>
    <li id="ShoppingIcon" class="menu-item" data-target="#Panel3" title="Background">
      <div class="menu-icon"> <i class="fa fa-paint-brush"></i> </div>
      <div class="menu-content"> <span>Background</span> </div>
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
    </li>-->
    
  </ul>    
    
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
                <li id="Background" class="menu-m-item"><i class="fa fa-eyedropper"></i><?php echo add_space(5);?>Color</li>
                <li id="Background" class="menu-m-item"><i class="fa fa-image"></i><?php echo add_space(5);?>image</li>
                <li id="Background" class="menu-m-item"><i class=""></i><?php echo add_space(5);?>none</li>
            </ul>
        </div>
    </div>
    <div id="Panel3" class="menu-panel">
      <div class="col-md-12">
            <ul class="menu-m-items">
                <li id="Background" class="menu-m-item"><i class="fa fa-image"></i><?php echo add_space(5);?>Color</li>
                <li id="Background" class="menu-m-item"><i class="fa fa-font"></i><?php echo add_space(5);?>image</li>
                <li id="Background" class="menu-m-item"><i class=""></i><?php echo add_space(5);?>none</li>
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
  </div>
</div>
<script type="text/javascript">
	$(function() {
		$(".slide-menu").slidemenu();
                $(".menu-panels li").click(function(){                    
                   // alert('#add_item_page_'+$("#myTab li.active").attr('id'));
                    var post_pageid= $("#myTab li.active").attr('id');
                    var page_id="add_item_page_"+post_pageid;
                    /*using only for get side name for daynamic pages*/
                  //alert(page_id);
                    //var site_name=$("#site_url").val();
                    var type_of_append=this.id;                    
                    add_item_class(type_of_append,page_id);                    
                });
	});
        function add_item_class(type_of_append,page_id)
        {
            switch(type_of_append) 
            {
            case 'image':
                var id=0;
                $('#'+page_id+' [class^=div_image]').each(function(){ 
                  id = $(this).index();
                        }); 
                   var dd="'"+page_id+"_div_image"+(id+1)+"'";                        
                   var  item='<div id="'+page_id+'_div_image'+(id+1)+'" data-toggle="popover" ondblclick="my_image_change('+dd+')" title="Drag and drop to change position and click to change image" class="div_image" ><p  class="item_image" id="'+page_id+'_item_image'+(id+1)+'" ><img  src="<?php echo BASE_URL;?>edit_assets/image/my.jpg" alt="" /></p></div>';                            
                //var item="<div id='div_image"+(id+1)+"' title='click me to drag' class='div_image' ><div class='item_image' id='item_image"+(id+1)+"' ><img src='<?php echo BASE_URL;?>assets/image/gallery/<?php echo $this->session->userdata('user_id');?>/my.jpg' alt='' /></div></div>";
                 $("#"+page_id).append($(item)); 
                 //alert(page_id+'  '+item);
                 resizeimage((id+1),page_id);
                
            break;
              
      
            case 'textarea':
                var id=0;
                $('#'+page_id+' [class^=transbox]').each(function(){ 
                  id = $(this).index();
                        });var dd="'"+page_id+"_transbox"+(id+1)+"'";
                var item= '<div class="transbox" data-toggle="popover" ondblclick="my_text_change('+dd+')" id="'+page_id+'_transbox'+(id+1)+'" title="Drag and drop to change position and click to change text!"><p>Drag and drop to change position and click to change text .'+(id+1)+'</p></div>  ';
                 $("#"+page_id).append($(item)); 
                 resizebutton(page_id+"_transbox"+(id+1));
            break;
                
            case 'button':
                var id=0;
                $('#'+page_id+' [class^=parentElement]').each(function(){ 
                  id = $(this).index();
                        });   var dd="'"+page_id+"_parentElement"+(id+1)+"'";                     
                 var item= '<div class="parentElement btn" data-toggle="popover" ondblclick="my_button_change('+dd+')" id="'+page_id+'_parentElement'+(id+1)+'" title="Drag and drop to change position and click to change text!"><a href="#" title="" class="btn" >Click !'+(id+1)+'</a></div>';
                 $("#"+page_id).append($(item)); 
                 //alert(item);
                 resizetextaria(page_id+"_parentElement"+(id+1));
            break;
                
            case 'Background':
                //alert('Background');
                load_popup('#view_prod','#background_pop');
            break;
                
            default:
                alert('not match');
            break;
             }
            //<img class="image_as" alt="image" src="edit_assets/image/process.gif" style="position: relative;z-index: 1;"/>
        }
        function resizeimage(id,pageid)
        {
             $('#'+pageid+'_div_image'+id).draggable().css("cursor", "move");
            $('#'+pageid+'_item_image'+id).resizable({
              // containment: 'parent' ,
               //aspectRatio: true,
               //alsoResize: "#item_name",              
                handle: 'ne, se, sw, nw',
                resize : function(event, ui) {
                     //expandParent("body", "#parentElement");
                     //console.log($(document).height);
                 }
              });
        }
        function resizebutton(id)
        {
//            if($(" .minheight_dynamic_user_page #"+id).length>0){
//              $("#"+id).draggable({
//                    drag : function(event, ui) {                      
//                           resize_dynamic_textaria(id);//this function on views/custum_theme/1.php                       
//                    },
//                    stop: function(event, ui) {
//                    //save_dynamic_page_size(id);//this function on views/custum_theme/1.php 
//                    }
//                }).resizable({            
//                    //alsoResize: ".transbox > p",   
//                    handle: 'n, e, s, w, ne, se, sw, nw',
//                    resize : function(event, ui) {
//                // containment: 'parent' 
//                     //expandParent("body", "#parentElement");                     
//                    resize_dynamic_textaria(id);//this function on views/custum_theme/1.php                    
//                },
//                stop: function(){
//                    
//                }
//                });  
//            }else{}
                $("#"+id).draggable().resizable({            
                //alsoResize: ".transbox > p",   
                handle: 'n, e, s, w, ne, se, sw, nw'
            }); 
            
        }
        function resizetextaria(id)
        {//alert('resize button'+id)
            $("#"+id).draggable({
                    cursor      : "move",
                    scroll      : false,
                    handle: 'n, e, s, w, ne, se, sw, nw',
                   // containment : "parent",
                    drag : function(event, ui) {
                        //expandParent("body", "#parentElement");
                    }
                }).resizable({
                    
                 //containment: 'parent' ,
                 handle: 'n, e, s, w, ne, se, sw, nw',
                 resize : function(event, ui) {
                     //expandParent("body", "#parentElement");
                     //console.log($(document).height);
                 }
                    });
        }
        function expandParent(parentName, childName) {
                var dragEl = $(childName);
                var parentEl = $(parentName);
                var dragElHeight=dragEl.height();
                if(parentEl.height() <= dragElHeight) {
                    parentEl.height(dragElHeight);
                }
            }
         
        function user_dyanamicpage(pageno)
        {
            var pagename;
            var pagename="add_item_page_"+pageno;
            $('#'+pageno+'_topmenu  .editpanal_add_item_page').attr('id',pagename);
            pagename="#"+pageno+"_topmenu "+" #add_item_page_"+pageno;
            //$('#'+pageno+'_topmenu  .editpanal_add_item_page').empty();
            //alert(pagename);
            change_array_value(pageno,pagename);
        }
        function admin_page(pageno)
        {
            var pagename;
            var pagename="#"+pageno+"_topmenu "+" #add_item_page_"+pageno;
            //alert(pagename);
            change_array_value(pageno,pagename);
        }
        
   function change_array_value(pageno,pageid)
    {
        
        //alert('page no '+pageno+' page name '+pageid);
        
        var user_id=$("#session").val();
        var base_url=$("#site_url_BASE_URL").val();
        //alert(base_url+"edit_assets/popup/get_val/get_eliment.php");
        
        $.ajax({
         type:"post",
        url: base_url+"edit_assets/popup/get_val/get_eliment.php",
            data: {pageid:pageno,user_id:user_id,BASE_URL:base_url},
            success: function( data ) {
                //alert(data);
                $(pageid ).html(data);               
            $(pageid+'  > [class="parentElement"],[class="parentElement btn"]').each(function(){ 
                    var ind = $(this).index();
                    //var text = $(this).text();
                    //var value = $(this).attr('data-value');
                    var id = $(this).attr('id');
                   //alert(id);
                   $(this).find('a').attr('title',$(this).find('a').attr('href'));
                   $(this).find('a').removeAttr('href');
                   resizetextaria(id);
                 
            });
          
        $('.div_image').draggable().css("cursor", "move");
            $('.item_image').resizable({
               //containment: ".div_name",
               //aspectRatio: true,
               //alsoResize: "#item_name",              
                handle: 'ne, se, sw, nw',
                drag : function(event, ui) {
                        //expandParent("body", "#parentElement");
                    }
              });
            $(pageid+'  > [class=transbox]').each(function(){//find('div').
                var ind = $(this).index();
            //var text = $(this).text();
            //var value = $(this).attr('data-value');
            var id = $(this).attr('id');
           //console.log($(this).attr('height'));
           resizebutton(id);
           
        });
   
   }
   });
    }
    
    
    
    
</script>