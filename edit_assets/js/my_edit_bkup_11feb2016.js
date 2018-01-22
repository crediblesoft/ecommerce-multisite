 ///var BASE_URL=$("#site_url_BASE_URL").val();
   
    //for botton
     $(document).on("click", ".parentElement", function(event){
        event.stopPropagation();       
       var divid=$(this).attr('id');        
       var data=$("#"+divid+" a").html();
       var link=$("#"+divid+" a").attr("title").trim(); 
        var BASE_URL=$("#site_url_BASE_URL").val();        
        var user_id=$("#session").val();
        var que="?divid="+divid+"&BASE_URL="+BASE_URL+"&user_id="+user_id+"&data="+encodeURIComponent(data)+"&link="+link;       
       //alert($("#"+divid+" p").html());
       var vv=checkdividisblank("view_prod10001");
        $(vv).load(BASE_URL+"edit_assets/popup/set_val/botton_eliment.php"+que);
    }); 
    // for text aria
     $(document).on("click", ".transbox", function(event){
        event.stopPropagation();
        var divid=$(this).attr('id');
        var data=$("#"+divid+" p").html();
         var BASE_URL=$("#site_url_BASE_URL").val();
        var user_id=$("#session").val();
         var que="?divid="+divid+"&data="+encodeURIComponent(data)+"&BASE_URL="+BASE_URL+"&user_id="+user_id;
        //alert($("#"+divid+" p").html());
       //var vv=checkdividisblank("view_prod10002");
    //$(vv).load("edit_assets/popup/set_val/textaria_eliment.php"+que);
    var vv="view_prod10002_"+divid;
            if($("#"+vv).length>0)
            {
                 $("#textaria_popup_"+divid).css("display","block");
            }else{               
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load("edit_assets/popup/set_val/textaria_eliment.php"+que);       
            }
    });
    
  // for image
  $(document).on("click", ".div_image", function(event){
        event.stopPropagation();
       var divid=$(this).attr('id');
       var data="";//$("#"+divid+" p").html();
       var imagepath=$("#"+divid+" p img").attr("src");
       var BASE_URL=$("#site_url_BASE_URL").val();
        var user_id=$("#session").val();
      //alert(divid);
       var que="?divid="+divid+"&data="+data+"&imagepath="+imagepath+"&BASE_URL="+BASE_URL+"&user_id="+user_id;
       //alert($("#"+divid+" p img").attr("src"));
       //var vv=checkdividisblank("view_prod10003");     
     //$(vv).load(BASE_URL+"edit_assets/popup/set_val/image_eliment.php"+que);
     var vv="view_prod10003_"+divid;
            if($("#"+vv).length>0)
            {
                 $("#view_prod1000_"+divid).css("display","block");
            }else{               
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/set_val/image_eliment.php"+que);        
            }
    });    
    
    
    
    
/*function my_button_change(divid)
{    
            //var divid=$(this).attr('id');
   
       alert(divid);
       divid=$.trim(divid);
       var data=$("#"+divid).html();
       alert(data);
        alert("#"+divid+" p");
        var BASE_URL=$("#site_url_BASE_URL").val();
         alert(BASE_URL);
        var user_id=$("#session").val();
         alert(user_id);
        var que="?divid="+divid+"&data="+data+"&BASE_URL="+BASE_URL+"&user_id="+user_id;
         alert(que);
       //alert($("#"+divid+" p").html());
       var vv=checkdividisblank("view_prod10001");
       alert(vv);
        $(vv).load(BASE_URL+"edit_assets/popup/set_val/botton_eliment.php"+que);
}*/
/*function my_text_change(divid)
{
    //alert(divid);
   // event.stopPropagation();
    var vv=checkdividisblank("view_prod10002");
    $(vv).load("edit_assets/popup/set_val/textaria_eliment.php?divid="+divid);
    //var id="view_prod10002";   
    //$("#view_prod").append("<div id='"+id+"' class='view_prod' ></div>");
}  
function my_image_change(divid)
{
    //alert(divid);
    //$("#"+divid).stopPropagation();
    var vv=checkdividisblank("view_prod10003");
     $(vv).load("edit_assets/popup/set_val/image_eliment.php?divid="+divid);
    //var id="view_prod10003";
    //$("#view_prod").append("<div id='"+id+"' class='view_prod' ></div>"); 
}  */
 
 function noscript(strCode){
   var html = $(strCode.bold()); 
   html.find('script').remove();
 return html.html();
}


//alert(   noscript("<script>blah blah blah</script><div>blah blah blah</div>")    );
  function save_eliment(){
               var pagename='';
                var user_id=$("#session").val();
                    pagename= $("#myTab li.active").attr('id');
                var pagedata=add_item_id1(pagename);
                    pagedata=noscript(pagedata);
                 //alert(pagedata);
                    pagedata= addslashes(pagedata);
                    addeliment(pagename,user_id,pagedata);
               /* $("#myTab > [role^=presentation]").each(function(){
                    pagename=$(this).attr('id');
                    var pagedata=add_item_id1(pagename);
                    // alert('pageno '+pagename+' data '+pagedata);
                  pagedata= addslashes(pagedata);
                  //alert("add shlash"+pagedata);
                 //var   str=  stripslashes(pagedata);
                   //alert("replase shlash"+str);
                    addeliment(pagename,user_id,pagedata);
                });*/
               
            }
            function addeliment(pagename,user_id,pagedata)
            {
                 var base_url=$("#site_url_BASE_URL").val();
                $.ajax({
                            type: "POST",
                            url: base_url+"Inserdata/save_update_element",
                            async: false,
                            data: { pageid:pagename,user_id:user_id,pagedata:pagedata},
                            success: function(data){
                                if(data){
                                    alert('Data saved successfully'); 
                                }else{
                                alert('Data not saved successfully');}        
                                  }
                              });
            }
 function addslashes(str) {
str=str.replace(/\\/g,'\\\\');
str=str.replace(/\'/g,'\\\'');
str=str.replace(/\"/g,'\\"');
str=str.replace(/\0/g,'\\0');
return str;
}
function stripslashes(str) {
str=str.replace(/\\'/g,'\'');
str=str.replace(/\\"/g,'"');
str=str.replace(/\\0/g,'\0');
str=str.replace(/\\\\/g,'\\');
return str;
}
  function add_item_id1(pageno)
        {
             var pageid="add_item_page_"+pageno;
             var fullpageid="#"+pageno+"_topmenu "+" #add_item_page_"+pageno;
             var divall_data="";
             //this is for button
             $(fullpageid+' [class^=parentElement]').each(function(){ 
                 var id = $(this).attr('id');
                 var cls = $(this).attr('class');
                 var styl =$(this).attr('style');
                 //styl=styl.replace('top: '+$(this).css('top'),'top: '+(parseInt($(this).css('top'))-parseInt(150))+'px');
                 var ind = $(this).index();
                  var data=$("#"+id+" > a").html();
                  var link=$("#"+id+" > a").attr("title");
                  var dd='"'+pageid+'_parentElement'+ind+'"'; 
                  divall_data+="<div id='"+pageid+"parentElement"+(ind)+"' ondblclick='my_button_change("+dd+")' class='parentElement btn' title='Drag and drop to change position and click to change text!' data-toggle='popover' style='"+styl+"'><a href='"+link+"' target='_blank' class='btn'>"+data+"</a></div>";
                 // $('#add_item_page_').append($(div_data));
                 //alert(divall_data);
             });//this is for textaria
              $(fullpageid+' [class^=transbox]').each(function(){
                   var id = $(this).attr('id');
                   var cls =$(this).attr('class')                   
                    var styl =$(this).attr('style');
                    //styl=styl.replace('top: '+$(this).css('top'),'top: '+(parseInt($(this).css('top'))-parseInt(150))+'px');
                    //alert(styl.replace('top: '+$(this).css('top'),'top: '+(parseInt($(this).css('top'))-parseInt(100))+'px'));
                    var ind = $(this).index();
                    var data=$("#"+id+" > p").html();
                    var dd='"'+pageid+'_transbox'+ind+'"'; 
                  divall_data+="<div id='"+pageid+"transbox"+(ind)+"' ondblclick='my_text_change("+dd+")' class='transbox' title='Drag and drop to change position and click to change text!' data-toggle='popover' style='"+styl+"'><p>"+data+"</p></div>";
                  //$('#add_item_page_').append($(div_data));
                 
              }); //this is for image
              $(fullpageid+' [class^=div_image]').each(function(){
                   var id = $(this).attr('id');
                   var cls =$(this).attr('class')
                    var styl =$(this).attr('style');
                   // styl=styl.replace('top: '+$(this).css('top'),'top: '+(parseInt($(this).css('top'))-parseInt(150))+'px');
                    var ind = $(this).index();
                    var data=$("#"+id+" > p").html(); 
                    var imageurl=$("#"+id+" > p > img").attr('src'); 
                    var pstyle=$("#"+id+" > p ").attr('style'); 
                     var dd='"'+pageid+'_div_image'+ind+'"'; 
                    divall_data+="<div id='"+pageid+"div_image"+(ind)+"' ondblclick='my_image_change("+dd+")' title='Drag and drop to change position and click to change text!' class='div_image' data-toggle='popover' style='"+styl+"'><p style='"+pstyle+"' class='item_image' id='"+pageid+"item_image"+(ind)+"' ><img  src='"+imageurl+"' alt='' /></p></div>";
                  //$('#add_item_page_').append($(div_data));                 
              });
             // alert(divall_data);
             return divall_data;              
        }
        
        
        // for title drag

        $(function() {
            //$(".galary_hader").draggable({ handle: 'n, e, s, w, ne, se, sw, nw' });
            $(".galary_hader").draggable({
                stop: function(event, ui) {
                    var pos = ui.helper.position(); // just get pos.top and pos.left
                    //alert(pos.top + "\n" + pos.left);
                    //$("#savetitleposition").css({"display":"block"});
                   savetitlepositionfinal(pos.top,pos.left);
                   
                }
            });
            $(".galary_hader").css("cursor", "move");  
        });
        
        
        function savetitlepositionfinal(top,left){
            //alert(top);alert(left);
            var currentpageid=$("#myTab .active").attr("id");
            //alert(currentpageid);
            var BASE_URL=$("#site_url_BASE_URL").val();
            //var pos=$("#pageno_"+currentpageid).position();
            //alert(pos.top + "\n" + pos.left);
            //var top=pos.top;var left=pos.left;
            var windowheight=$(window).height();
            var windowwidth=$(window).width();
            var topinpercent=((top*100)/windowheight);
            var leftinpercent=((left*100)/windowwidth);
            //alert(topinpercent);alert(leftinpercent);
            var data="top:"+top+"px !important;left:"+left+"px !important;";
            $.ajax({
                type: "POST",
                url: BASE_URL+"Inserdata/update_page_title_position",
                async: false,
                data: { data:data,pageid:currentpageid},
                success: function(data){
                            //alert("title postion changed");
                   //$("#savetitleposition").css({"display":"none"});
                }
            }); 
        }
        
//    $(function() 
//    { 
//        $('.menu').draggable({
//        handle: 'n, e, s, w, ne, se, sw, nw'    
//        });
//        /*$('.menu').resizable({
//        handles: 'n, e, s, w, ne, se, sw, nw'
//        });*/ 
//        $('.menu').css("cursor", "move");  
//    });
//    function menu_position()
//    {
//        
//        $('.menu').css('z-index','11');
//        //var value=' top:- '+$('.menu').outerHeight()+' header '+ $(".header").height() +' footer '+ $(".footer").height();
//        var value=$(".footer").offset().top-$(".header").offset().top;
//        if($('.menu').css('top')<='0px')
//        {
//        $('.menu').css('top','0px');
//        alert('your are in 0px');
//        }else if($('.menu').css('top')>value+'px')
//        {
//         $('.menu').css('top',value+'px');   
//         alert('your are in footer'+value);
//        }
//        else
//        {
//            alert('blank');
//        }
//        alert(value+' val '+$('.menu').css('top'));
//        if('-100px'<'-90px')
//        {
//        //alert(value);
//        }
//        //value=' left:- '+value+$('.menu').css('left');
//        //value=' z-index:- '+value+$('.menu').css('z-index');
//    }

$(document).ready(function(){
    
    var base_url=$("#site_url_BASE_URL").val();
     $("#edit_profile_banner_popover").popover({
        content:"Left click on banner and drag & drop up down for change position and double click for change the banner image.",
        title : 'Banner',
        placement:"top",
        trigger:"hover"
    });
    
    $("#edit_profile_product_popover").popover({
        content:"Change only visualization from here for other changes\n\
                 <a href='"+base_url+"product' target='_blank' title='click for edit product'>click here</a>, and for change positon left click and drag & drop'.",
        title:"Product",
        placement:"top",
        html:true,
        delay:{hide:1000},
        trigger:"hover"
    });
    
     $(".items").popover({
        content:"Change only visualization from here for other changes\n\
                 <a href='"+base_url+"product' target='_blank' title='click for edit product'>click here</a>, and for change positon left click and drag & drop'.",
        title:"Product",
        placement:"top",
        html:true,
        delay:{hide:1000},
        trigger:"hover"
    });
    
    $(".about_move_inner").popover({
        content:"Left click on about content/image and drag & drop up down for change position and double click for change the text and image.",
        title : 'About Us',
        placement:"top",
        trigger:"hover"
    });
    
    
    $("#cssmenu").popover({
        content:"<div style='margin-top: 25px !important;'>double click for change the position of menu and add new menu , remove menu , change the name of menu.</div>",
        title : 'Menu',
        placement:"top",
        trigger:"hover",
        html:true
    });
    
            
//     $(".about_us_fotter").popover({
//        content:"double click for change text & drag for change the position of content.",
//        title : 'Menu',
//        placement:"top",
//        trigger:"hover"
//    });
    
    $("#pophover_sidemenu").popover({
        content:"<div style='width:200px;'>click on <i class='fa fa-paint-brush'></i> button to add image text and button.</div>",
        title : 'Menu',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    /****************************** Header *******************************/
    
    $("#SaveAddItemsli").popover({
        content:"click for save changes.",
        title : 'Save changes',
        html:true,
        placement:"bottom",
        trigger:"hover"
    });
    
    $("#gobackProfilePageli").popover({
        content:"click for go to profile page.",
        title : 'Profile',
        html:true,
        placement:"bottom",
        trigger:"hover"
    });
    
    /****************************** Footer *******************************/
    
     $(".AboutUstext").popover({
        content:"double click for edit text.",
        title : 'Footer about',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    $(".aboutusfooter_menu").popover({
        content:"double click to change the position of menu.",
        title : 'Footer menu',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    $(".ContactInfotext").popover({
        content:"double click for edit text.",
        title : 'Footer contact',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    $(".TermandConditiontext").popover({
        content:"double click for edit text.",
        title : 'Footer terms & condition',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    $("#edit_bs").popover({
        content:"click for adjust size of items.",
        title : 'Edit BS',
        html:true,
        placement:"bottom",
        trigger:"hover"
    });
    
    $(".footer").popover({
        content:"double click for edit text.",
        title : 'Footer Edit Text',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    
    
     $("#galary_portfolio").popover({
        content:"Click left and drag & drop and click save changes button to save position. Double click for add new gallery and remove gallery and also change position",
        title : 'Gallery',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    $(".save_gallerychange").popover({
        content:"Click here to save position ",
        title : 'Product List',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    $(".galary_hader_tnc").popover({
        content:"double click for edit text ",
        title : 'Term and Condition ',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    
    $(".parentElement").popover({
        content:"double click for edit text ",
        title : 'Botton ',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    $(".div_image").popover({
        content:"double click for Chaneg Image  ",
        title : 'Image ',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
    $(".transbox").popover({
        content:"double click for edit text ",
        title : 'Text',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    $(".social_m li").popover({
      content:"Change only visualization from here for other changes\n\
                 <a href='"+base_url+"profile' target='_blank' title=' double click for edit social midia link'>click here</a>, and for change positon double click and drag & drop'.",
        title:"Social midia",
        placement:"top",
        html:true,
        delay:{hide:1000},
        trigger:"hover"  
    });
        $(".dynamic_user_page").popover({
        content:"Click for add Items like ( image , text , button) on right side of paint icon ",
        title : 'Add Items',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    $("#userlogo img").popover({
        content:"Double click for change Logo ",
        title : 'Logo',
        html:true,
        placement:"bottom",
        trigger:"hover"
    });
    
    $(".galary_hader").popover({
        content:"Double click for change page title and drag & drop for change the position of title and you can also change browser tab text/title from here.",
        title : 'Page title/Browser title',
        html:true,
        placement:"top",
        trigger:"hover"
    });
    
//    $("#myTab li").popover({
//        content:"Single click for change page  ",
//        title : 'Site page',
//        html:true,
//        placement:"bottom",
//        trigger:"hover"
//    });
    
   });
