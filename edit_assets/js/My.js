function load_popup(view_prod , view_prod_popup )
{ 
// document.getElementById("content").innerHTML='<object type="type/html" data="index.php" ></object>';
//alert(view_prod.replace('#', ''));
$(view_prod_popup).addClass('custom');
//$(view_prod_popup).css('display','block');
//for draggable use only
//$('"'+view_prod_popup+'"').draggable({handle: 'n, e, s, w, ne, se, sw, nw'});
//$('"'+view_prod_popup+'"').css("cursor", "move");  
    //alert($(".view_prod").length );
    var BASE_URL=$("#site_url_BASE_URL").val();
    var user_id=$("#session").val();
   // alert('vv');
    var view_prod_popup_val=view_prod_popup.replace('#', '');
    var pass_sring="?pp_name="+view_prod_popup_val+"&BASE_URL="+BASE_URL+"&user_id="+user_id;
    // for open popups use only    
  
        if(view_prod_popup=="#view_prod_popup")
        {
            //var vv=checkdividisblank("view_prod0");
            //$(vv).load(BASE_URL+"edit_assets/popup/p_store.php"+pass_sring);
            var vv="view_prod0";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#view_prod_popup").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/p_store.php"+pass_sring);                   
            }
        }
        else if(view_prod_popup=="#prod_bootstrap_view")
        {
            //var vv=checkdividisblank("view_prod1");
            //$(vv).load(BASE_URL+"edit_assets/popup/prod_bootstrap_view.php"+pass_sring); 
            var vv="view_prod1";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#prod_bootstrap_view").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/prod_bootstrap_view.php"+pass_sring);                   
            }
        }
        else if(view_prod_popup=="#view_prod_detail")
        {
            //var vv=checkdividisblank("view_prod2");
            //$(vv).load(BASE_URL+"edit_assets/popup/p_detail_page.php"+pass_sring);         
            var vv="view_prod2";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#view_prod_detail").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/p_detail_page.php"+pass_sring);                   
            }
        }
        else if(view_prod_popup=="#prod_bootstrap_detail_page")
        {
           //var vv=checkdividisblank("view_prod3");
            //$(vv).load(BASE_URL+"edit_assets/popup/prod_bootstrap_detail_page.php"+pass_sring);         
            var vv="view_prod3";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#prod_bootstrap_detail_page").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/prod_bootstrap_detail_page.php"+pass_sring);                   
            }       
        }
        else if(view_prod_popup=="#view_prod_cart")
        {
            var vv=checkdividisblank("view_prod4");
            $(vv).load(BASE_URL+"edit_assets/popup/prod_cart_page.php"+pass_sring);         
        }
        else if(view_prod_popup=="#prod_bootstrap_cart_page")
        {
           var vv=checkdividisblank("view_prod5");
            $(vv).load(BASE_URL+"edit_assets/popup/prod_bootstrap_cart_page.php"+pass_sring);         
        }//for use only menu
        else if(view_prod_popup=="#menu_pop")
        {
            var vv=checkdividisblank("view_prod6");
            $(vv).load(BASE_URL+"edit_assets/popup/menu_pop.php"+pass_sring);         
        }
        /*else if(view_prod_popup=="#prod_bootstrap_cart_page")
        {
            var vv=checkdividisblank("view_prod5");
            $(vv).load(BASE_URL+"edit_assets/popup/prod_bootstrap_cart_page.php"+pass_sring);         
        }*/
        else if(view_prod_popup=="#banner_popup")
        {
            //var vv=checkdividisblank("view_prod7");
            //$(vv).load(BASE_URL+"edit_assets/popup/banner_pop.php"+pass_sring);         
            var vv="view_prod7";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#banner_popup").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/banner_pop.php"+pass_sring);                   
            }
        }
        else if(view_prod_popup=="#user_detail_popup")
        {
            //var vv=checkdividisblank("view_prod8");
            //$(vv).load(BASE_URL+"edit_assets/popup/about_us_pop.php"+pass_sring);         
            var vv="view_prod8";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#user_detail_popup").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/about_us_pop.php"+pass_sring);          
            }
        }
        else if(view_prod_popup=="#user_contentdetail_popup")
        {
            //var vv=checkdividisblank("view_prod9");
            //$(vv).load(BASE_URL+"edit_assets/popup/about_us_text_pop.php"+pass_sring);         
            var vv="view_prod9";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#user_contentdetail_popup").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $('#'+vv).load(BASE_URL+"edit_assets/popup/about_us_text_pop.php"+pass_sring);         
            }
        }
        else if(view_prod_popup=="#user_footer_popup")
        {
            //var vv=checkdividisblank("view_prod10");
            //$(vv).load(BASE_URL+"edit_assets/popup/footer.php"+pass_sring);         
            var vv="view_prod10";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#user_footer_popup").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/footer.php"+pass_sring);          
            }
        }
        else if(view_prod_popup=="#contect_us_popup")
        {
            //var vv=checkdividisblank("view_prod11");
            //$(vv).load(BASE_URL+"edit_assets/popup/contect_us_pop.php"+pass_sring);         
            var vv="view_prod11";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#contect_us_popup").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/contect_us_pop.php"+pass_sring);                 
            }
        }
         else if(view_prod_popup=="#contect_us_text_pop")
        {
            //var vv=checkdividisblank("view_prod12");
            //$(vv).load(BASE_URL+"edit_assets/popup/contect_us_text_pop.php"+pass_sring);
            var vv="view_prod12";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#contect_us_text_pop").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/contect_us_text_pop.php"+pass_sring);       
            }
        }
         else if(view_prod_popup=="#term_condition_popup")
        {
            //var vv=checkdividisblank("view_prod13");            
            //$(vv).load(BASE_URL+"edit_assets/popup/term_condition_text_pop.php"+pass_sring);         
            var vv="view_prod13";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#term_condition_popup").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/term_condition_text_pop.php"+pass_sring);         
            }
        }
        /*else if(view_prod_popup=="#aboutus_footer_pop")
        {
            //var vv=checkdividisblank("view_prod14");
            //$(vv).load(BASE_URL+"edit_assets/popup/aboutus_footer_pop.php"+pass_sring);         
            var vv="view_prod14";
            if($("#"+vv).length>0)
            {
                //alert("display : block");
                 $("#aboutus_footer_pop").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/aboutus_footer_pop.php"+pass_sring);         
            }
        }*/
       
        
        
        
        
        else if(view_prod_popup=="#menu_add_new_pop")
        {
            var vv=checkdividisblank("view_prod15");
            $(vv).load(BASE_URL+"edit_assets/popup/menu_add_new_pop.php"+pass_sring);         
        }
        else if(view_prod_popup=="#user_socialmidia_pop")
        {
            var vv=checkdividisblank("view_prod16");
            $(vv).load(BASE_URL+"edit_assets/popup/user_socialmidia_pop.php"+pass_sring);         
        }
         else if(view_prod_popup=="#gallery_pop")
        {
            //var vv=checkdividisblank("view_prod17");
            //$(vv).load(BASE_URL+"edit_assets/popup/gallery_pop.php"+pass_sring);         
            var vv="view_prod17";
            if($("#"+vv).length>0)
            {                
                 $("#gallery_pop").css("display","block");
            }else{
                //alert("append");
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/gallery_pop.php"+pass_sring);           
            }
        }
        else if(view_prod_popup=="#footer_color")
        {
            var vv=checkdividisblank("view_prod18");
            $(vv).load(BASE_URL+"edit_assets/popup/footer_color.php"+pass_sring);         
        }
        else if(view_prod_popup=="#background_pop")
        {
            var vv=checkdividisblank("view_prod19");
            $(vv).load(BASE_URL+"edit_assets/popup/background_pop.php"+pass_sring);         
        }
        
         else if(view_prod_popup=="#aboutus_footer_pop_aboutus")
        {                    
            var vv="view_prod20";
            if($("#"+vv).length>0)
            {
                 $("#aboutus_footer_pop_aboutus").css("display","block");
            }else{
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/aboutus_footer_pop_aboutus.php"+pass_sring);         
            }
        }
        else if(view_prod_popup=="#aboutus_footer_pop_contact")
        {
                
            var vv="view_prod21";
            if($("#"+vv).length>0)
            {
                 $("#aboutus_footer_pop_contact").css("display","block");
            }else{
                
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/aboutus_footer_pop_contact.php"+pass_sring);         
            }
        }
        else if(view_prod_popup=="#aboutus_footer_pop_termcondition")
        {                  
            var vv="view_prod22";
            if($("#"+vv).length>0)
            {
                 $("#aboutus_footer_pop_termcondition").css("display","block");
            }else{               
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/aboutus_footer_pop_termcondition.php"+pass_sring);         
            }
        }
        else if(view_prod_popup=='#usersitelogo_pop')
        {
            var vv="view_prod23";
            if($("#"+vv).length>0)
            {
                 $("#usersitelogo_pop").css("display","block");
            }else{               
                $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
                $("#"+vv).load(BASE_URL+"edit_assets/popup/usersitelogo_pop.php"+pass_sring);         
            }
        }
//
}

//$(document).ready(function(){
//    $(document).on("dblclick",".galary_hader",function(){
//        var view_prod_popup="#title_popup";
//        
//    });
//});
    
function load_popup2(view_prod , view_prod_popup,pageid )
{   
// document.getElementById("content").innerHTML='<object type="type/html" data="index.php" ></object>';
//alert(view_prod.replace('#', ''));
$(view_prod_popup).addClass('custom');
//$(view_prod_popup).css('display','block');
//for draggable use only
//$('"'+view_prod_popup+'"').draggable({handle: 'n, e, s, w, ne, se, sw, nw'});
//$('"'+view_prod_popup+'"').css("cursor", "move");  
    //alert($(".view_prod").length );
    //alert(view_prod_popup);
    var BASE_URL=$("#site_url_BASE_URL").val();
    var user_id=$("#session").val();
    var view_prod_popup_val=view_prod_popup.replace('#', '');
    var pass_sring="?pp_name="+view_prod_popup_val+"&BASE_URL="+BASE_URL+"&user_id="+user_id+"&pageid="+pageid;
    
       var vv="pagetitlepopup"+pageid;
       //alert($("#"+vv).length);
        if($("#"+vv).length>0)
        {
             $("#"+view_prod_popup_val).css("display","block");
        }else{
            //alert("Me load");
            $("#view_prod").append("<div id='"+vv+"' class='view_prod' ></div>");
            $("#"+vv).load(BASE_URL+"edit_assets/popup/pagetitlepopup.php"+pass_sring);         
        }
 
}


function checkdividisblank(id)
{
    if($("#"+id).length>0)
    {
        // $("#"+id).append("<div id='"+vv+"' class='view_prod' ></div>");        
    }
    else
    {
         $("#view_prod").append("<div id='"+id+"' class='view_prod' ></div>");        
    }
    return "#"+id; 
}
function d_off(id)
    {
        //alert(id);
        $(id).css("display","none");
    }
   
   function removeThispop(id)
    {
        
        $(id).fadeOut(500,function(){
        $(id).remove();
        });
    }
    function popup_close(view_prod , view_prod_popup)
    {
       if(view_prod_popup=="#view_prod_popup")
        {
            removeThispop(view_prod);
        }
        else if(view_prod_popup=="#bootstrap_prod_popup")
        {
            var vv="#view_prod1";//+$(".view_prod").length;
            removeThispop(vv);
        }
        else if(view_prod_popup=="#view_prod_detail")
        {
            var vv="#view_prod2";
           removeThispop(vv);
        }
        else if(view_prod_popup=="#prod_bootstrap_detail_page")
        {
            var vv="#view_prod3";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#view_prod_cart")
        {
            var vv="#view_prod4";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#prod_bootstrap_cart_page")
        {
            var vv="#view_prod5";
            removeThispop(vv);
        }//for use only menu
        else if(view_prod_popup=="#menu_pop")
        {
            var vv="#view_prod6";
            removeThispop(vv);
        }
        /*else if(view_prod_popup=="#prod_bootstrap_cart_page")
        {
            var vv="#view_prod5";
            removeThispop(vv);
        }*/
        else if(view_prod_popup=="#banner_popup")
        {
            var vv="#view_prod7";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#user_detail_popup")
        {
            var vv="#view_prod8";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#user_contentdetail_popup")
        {
            var vv="#view_prod9";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#user_footer_popup")
        {
            var vv="#view_prod10";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#contect_us_popup")
        {
            var vv="#view_prod11";
            removeThispop(vv);
        }
         else if(view_prod_popup=="#contect_us_text_pop")
        {
            var vv="#view_prod12";
            removeThispop(vv);
        }
         else if(view_prod_popup=="#term_condition_popup")
        {
            var vv="#view_prod13";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#aboutus_footer_pop")
        {
            var vv="#view_prod14";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#menu_add_new_pop")
        {
            var vv="#view_prod15";
            removeThispop(vv);
        }
        else if(view_prod_popup=="#user_socialmidia_pop")
        {
            var vv="#view_prod16";
             removeThispop(vv);
        }
         else if(view_prod_popup=="#gallery_pop")
        {
            var vv="#view_prod17";
             removeThispop(vv);
        }
        else if(view_prod_popup=="#footer_color")
        {
           var vv="#view_prod18";
             removeThispop(vv);        
        }
        else if(view_prod_popup=="#background_pop")
        {
           var vv="#view_prod19";
             removeThispop(vv);        
        }
    }
    //$(window).bind('beforeunload', function(){        
        
	//return '>>>>>Before You Go<<<<<<<< \n Your custom message go here';
        //alert('save your changes');
      //  return 'save your changes';
        
    //});
//window.onbeforeunload = function(){
  //  return "Do you want to leave?"
//}

// A jQuery event (I think), which is triggered after "onbeforeunload"
//$(window).unload(function(){
    //alert('I will call my method');
  //  return 'I will call my method';
//});
        
          