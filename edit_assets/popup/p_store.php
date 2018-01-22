  <script>
    /*$( document ).ready(function(){                        
        $(document).on("dblclick",".center_content",function(){                            
            $("#window_popup").css("display","block");    
        });
    });

    function getElementCss(elimentId)
    {
var attr = ['font-family','font-size','font-weight','font-style','color',
    'text-transform','text-decoration','letter-spacing','word-spacing',
    'line-height','text-align','vertical-align','direction','background-color',
    'background-image','background-repeat','background-position',
    'background-attachment','opacity','width','height','top','right','bottom',
    'left','margin-top','margin-right','margin-bottom','margin-left',
    'padding-top','padding-right','padding-bottom','padding-left',
    'border-top-width','border-right-width','border-bottom-width',
    'border-left-width','border-top-color','border-right-color',
    'border-bottom-color','border-left-color','border-top-style',
    'border-right-style','border-bottom-style','border-left-style','position',
    'display','visibility','z-index','overflow-x','overflow-y','white-space',
    'clip','float','clear','cursor','list-style-image','list-style-position',
    'list-style-type','marker-offset'];
var len = attr.length, obj = {};
//alert($("#span1").css(attr[2]));
var str=" ";
for (var i = 0; i < len; i++) 
{
    if(($("."+elimentId).css(attr[i])!=null))
    {
    str+=(attr[i])+": ";
    str+=($("."+elimentId).css(attr[i]))+" ; ";
    }
    //obj[attr[i]] = $("#window_popup").call(this, attr[i]);
}
return str;
}


                function abc(fild,work,data)
                {
                    var n_data=$("#"+data).val();
                    $("."+fild).css(work,n_data);
                    var sessionid=$("#session").val();
                    var elimen=getElementCss(fild);
                    //alert(elimen);
                    onclick_save_data(sessionid,fild,elimen);
                    //getcss(sessionid , $classname , fild) ;
                };
                function abc2(fild,work,data)
                {
                    var v=$(".center_content").width();
                    var m=parseInt($("."+fild).css("margin-right"))+parseInt(2);
                    var n=$("#"+data).val();
                    var r=((v-(m*n)));
                    r=r/n;
                    $("."+fild).css(work,r);
                    var sessionid=$("#session").val();

                };
                function onclick_save_data(sessionid,fild,elimen)
                {
                    $.ajax({
                  type: "POST",
                  url: "model/shope.php",
                  async: false,
                  data: { userId:sessionid,className:fild,Css:elimen}
                })
                }    

*/ 
    </script>
    <?php 
    include 'db_include.php';
    function getcss($userid , $classname , $fildname) 
   {
    //mysql_connect('localhost','root','root');
    //mysql_select_db('test_dweb');

        $qr="SELECT `id`, `user_id`, `tag_name`, `class_type`, `class_name`, `class_css` FROM `db_css` WHERE  `user_id`= '".$userid."' AND `class_name`='".$classname."' ";
        $ab = mysql_query($qr)or die(mysql_error());
        $res=mysql_fetch_assoc($ab);
        $ex=explode($fildname.":", $res["class_css"]);
      
       $ex1=explode(":", $ex[1]);
       $ex2=explode(";", $ex[1]);
       //echo $ex1[0]."</br>";
       //echo $ex1[1]."</br>";
       //echo $ex2[0]."</br>";
       //echo $ex2[1]."</br>";
       $ex2[0]=preg_replace('/\s+/', '', $ex2[0]);
      if($fildname=="color"||$fildname=="background-color")
      {
          if(strrchr($ex2[0],"#"))
          {
          return $ex2[0];
          }else{
          $f=  explode("(",$ex2[0]);
          $l=  explode(")", $f[1]);
          $vl=  explode(",", $l[0]);
          $r=$vl[0];
          $g=($vl[1]-1);
          $b=($vl[2]-1);
        $r = intval($r); $g = intval($g);
        $b = intval($b);
        $r = dechex($r<0?0:($r>255?255:$r));
        $g = dechex($g<0?0:($g>255?255:$g));
        $b = dechex($b<0?0:($b>255?255:$b));
        $color = (strlen($r) < 2?'0':'').$r;
        $color .= (strlen($g) < 2?'0':'').$g;
        $color .= (strlen($b) < 2?'0':'').$b;
        return '#'.$color;
          }
      }
      else
      {
       return $ex2[0];
      }
    }
   
    ?>
    
        <?php  if((isset($pp_name)&&($pp_name!=""))||($_REQUEST['pp_name'])){
            $pp_name=$_REQUEST['pp_name'];
           //isset($pp_name) && $pp_name!=""?$pp_name:isset($_REQUEST['pp_name'])&&$_REQUEST['pp_name']!=""?$_REQUEST['pp_name']:'';
            ?>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','savefullpage()','Editing Product  ');?>
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Editing Product</h3></div>
            </div>            -->
            <div class="table-responsive col-lg-12">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="3">
                            <b>Background color</b>
                        </td>                       
                        <td style="float: right;">
                             <?php  $backround="#".$pp_name."backround";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                            <input type="color" class="input-sm" id="<?php echo $pp_name.'backround';?>" name="<?php echo $pp_name.'backround';?>" onchange='abc(".items","background-color",<?php echo '"'.$backround.'"';?>)' value="<?php echo getcss('111', '.items' , 'background-color');?>"  >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Name</b></td>                        
                        <td style="float: right">
                  <?php  $s_name_f_size="#".$pp_name."s_name_f_size";  
                         $s_name_c="#".$pp_name."s_name_c";?>
                            <input type="number" class="input-sm" id="<?php echo $pp_name.'s_name_f_size';?>"  name="<?php echo $pp_name.'s_name_f_size';?>" onchange='abc(".product_title a","font-size",<?php echo '"'.$s_name_f_size.'"';?>)' value="<?php echo intval(getcss('111' , '.product_title a' , 'font-size'));?>" >
                            <input type="color"  class="input-sm" id="<?php echo $pp_name.'s_name_c';?>" name="<?php echo $pp_name.'s_name_c';?>" onchange='abc(".product_title a","color",<?php echo '"'.$s_name_c.'"';?>)' value="<?php echo getcss('111', '.product_title a' , 'color');?>"  >                        
                        </td>
                    </tr> 
                    
                    <tr>
                        <td colspan="3"><b>Price</b></td>                        
                        <td style="float: right"> 
                         <?php  $s_price_f_size="#".$pp_name."s_price_f_size";  
                         $s_price_c="#".$pp_name."s_price_c";?>
                            <input type="number" class="input-sm" id="<?php echo $pp_name.'s_price_f_size';?>"  name="<?php echo $pp_name.'s_price_f_size';?>" onchange='abc("span.price","font-size",<?php echo '"'.$s_price_f_size.'"';?>)' value="<?php echo intval(getcss('111' , 'span.price' , 'font-size'));?>" >
                            <input type="color"  class="input-sm" id="<?php echo $pp_name.'s_price_c';?>" name="<?php echo $pp_name.'s_price_c';?>" onchange='abc("span.price","color",<?php echo '"'.$s_price_c.'"';?>)' value="<?php echo getcss('111', 'span.price' , 'color');?>"  >                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Product Detail</b></td>                        
                        <td style="float: right">
                             <?php  $s_detail_f_size="#".$pp_name."s_detail_f_size";  
                         $s_detail_c="#".$pp_name."s_detail_c";?>
                            <input type="number" class="input-sm" id="<?php echo $pp_name.'s_detail_f_size';?>"  name="<?php echo $pp_name.'s_detail_f_size';?>" onchange='abc(".prod_detail","font-size",<?php echo '"'.$s_detail_f_size.'"';?>)' value="<?php echo intval(getcss('111' , '.prod_detail' , 'font-size'));?>" >
                            <input type="color"  class="input-sm" id="<?php echo $pp_name.'s_detail_c'?>" name="<?php echo $pp_name.'s_detail_c'?>" onchange='abc(".prod_detail","color",<?php echo '"'.$s_detail_c.'"';?>)' value="<?php echo getcss('111', '.prod_detail' , 'color');?>"  >                        
                        </td>
                    </tr>
                    <?php /*?>
                    <tr>
                        <td colspan="3"><b>Discount Price</b></td>                        
                        <td style="float: right">
                             <?php  $sd_price_f_size="#".$pp_name."sd_price_f_size";  
                         $sd_price_c="#".$pp_name."sd_price_c";?>
                            <input type="number" class="input-sm" id="<?php echo $pp_name.'sd_price_f_size';?>"  name="<?php echo $pp_name.'sd_price_f_size';?>" onchange='abc("span.reduce","font-size",<?php echo '"'.$sd_price_f_size.'"';?>)' value="<?php echo intval(getcss('111', 'span.reduce' , 'font-size'));?>" >
                            <input type="color"  class="input-sm" id="<?php echo $pp_name.'sd_price_c';?>" name="<?php echo $pp_name.'sd_price_c';?>" onchange='abc("span.reduce","color",<?php echo '"'.$sd_price_c.'"';?>)' value="<?php echo getcss('111', 'span.reduce' , 'color');?>"  >                        
                        </td>
                    </tr>   
                                  
                    <tr>
                        <td colspan="3"><b>Add to cart Button</b></td>                        
                        <td style="float: right">
                             <?php  $s_bottun_t_c="#".$pp_name."s_bottun_t_c";  
                         $s_bottun_b_c="#".$pp_name."s_bottun_b_c";?>
                            <input type="color" class="input-sm" id="<?php echo $pp_name.'s_bottun_t_c';?>"  name="<?php echo $pp_name.'s_bottun_t_c';?>" onchange='abc(".bb","color",<?php echo '"'.$s_bottun_t_c.'"';?>)' value="<?php echo (getcss('111', '.bb' , 'color'));?>" >
                            <input type="color"  class="input-sm" id="<?php echo $pp_name.'s_bottun_b_c'?>" name="<?php echo $pp_name.'s_bottun_b_c'?>" onchange='abc(".bb","background",<?php echo '"'.$s_bottun_c.'"';?>)' value="<?php echo getcss('111', '.bb' , 'background');?>"  >                        
                        </td>
                    </tr>
                    <?php */?>    
                    <?php /*?>
                     <tr>
                        <td colspan="3"><b>Add Button hover</b></td>                        
                        <td style="float: right">
                             <?php  $s_bottun_th_c="#".$pp_name."s_bottun_th_c";  
                         $s_bottun_bh_c="#".$pp_name."s_bottun_bh_c";?>
                            <input type="color" class="input-sm" id="<?php echo $pp_name.'s_bottun_th_c';?>"  name="<?php echo $pp_name.'s_bottun_th_c';?>" onchange='abc(".pbb:hover","color",<?php echo '"'.$s_bottun_th_c.'"';?>)' value="<?php echo getcss('111', '.customform :hover' , 'color');?>" >
                            <input type="color"  class="input-sm" id="<?php echo $pp_name.'s_bottun_bh_c'?>" name="<?php echo $pp_name.'s_bottun_bh_c'?>" onchange='abc(".pbb:hover","background",<?php echo '"'.$s_bottun_bh_c.'"';?>)' value="<?php echo getcss('111', '.customform :hover' , 'background');?>"  >                        
                        </td>
                    </tr>
                    <?php */?>
                </table>                
            </div>
        </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">                
               <button class="pbb btn-block" onClick="load_popup('#view_prod','#prod_bootstrap_view')">
                   <span class="fa fa-windows"></span>Edit size content
               </button>
            </div>
    
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">             
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                 
               <button class="pbb btn-block" onClick='savefullpage()'>
                   <span class="fa fa-save"></span>Save
               </button>
            </div> 
    <?php //echo  BASE_URL;?>
    
 </div>
        <?php }/*?>
    
    <div class="col-sm-12">
        <div class="col-sm-5">product </div>
        <div class="col-sm-7">
            W<input type="number" onchange="abc('.prod_box','width','#product-width-size')" class="input-sm" id="product-width-size" name="product-width-size" value="<?php echo intval(getcss($_SESSION['user_id'] , '.prod_box' , 'width'));  ?>"  >
            H<input type="number" onchange="abc('.prod_box','height','#product-height-size')" class="input-sm" id="product-height-size" name="product-height-size" value="<?php echo intval(getcss($_SESSION['user_id'] , '.prod_box' , 'height'));  ?>"  >
          </div><?php echo $_SESSION['user_id'];?>
    </div>
    <?php */?>
   
   
<script type="text/javascript" >
   $(function() { $(<?php echo '"#'.$pp_name.'"';?>).draggable({
    handle: 'n, e, s, w, ne, se, sw, nw'    
  });  
  $(<?php echo '"#'.$pp_name.'"';?>).css("cursor", "move");  
    });
function abc(fild,work,data)
    { 
        var n_data=$(data).val();
        if(work=="font-size") {n_data=n_data+"px"; }
        $(fild).css(work,n_data);
        //alert($(fild).css(work)+'...'+fild+'...'+work+'...'+data+'..'+n_data);
        //var sessionid=$("#session").val();
       // var elimen=getElementCss(fild);
        //alert(elimen);
        //onclick_save_data(sessionid,fild,elimen);
        //getcss(sessionid , $classname , fild) ;
    };	
</script>
<script type="text/javascript" >
 function   savefullpage1()
    {
        document.location.href = 'http://localhost/shope_harvest/Inserdata/';
    }

 function savefullpage()
{    
    d_off(<?php echo '"#'.$pp_name.'"';?>)
    show_prossesing_image();//this function is on include file 
    //all class name and id name in project used to css
    //var abc=['body','p','#main_container','.top_bar','.top_search','input.search_input','.search_text','.search_text a','.search_bt','.languages','.lang_text','a.lang','#header','#logo','.oferte_content','.top_divider','.oferta','.oferta_img','.oferta_title','.oferta_details','.oferta_text','a.details','div.oferta_pagination','div.oferta_pagination a','div.oferta_pagination a:hover, div.pagination a:active','div.oferta_pagination span.current','#main_content','#menu_tab','.left_menu_corner','.right_menu_corner','ul.menu','ul.menu li','ul.menu li.divider','a.nav1:link, a.nav1:visited','a.nav2:link, a.nav2:visited','a.nav3:link, a.nav3:visited','a.nav4:link, a.nav4:visited','a.nav5:link, a.nav5:visited','a.nav6:link, a.nav6:visited','a.nav1:hover, a.nav2:hover, a.nav3:hover, a.nav4:hover, a.nav5:hover, a.nav6:hover','li.currencies','.crumb_navigation','.crumb_navigation a','span.current','.left_content','.title_box','ul.left_menu','ul.left_menu li','ul.left_menu li.odd a','ul.left_menu li.even a','ul.left_menu li.even a:hover, ul.left_menu li.odd a:hover','.border_box','.product_title','.product_title a','.product_title a:hover','.product_img','.prod_price','span.reduce','span.price','input.newsletter_input','a.join','.banner_adds','.center_content','.center_title_bar','.right_content','.shopping_cart','.cart_title','.cart_details','.cart_icon','span.border_cart','.prod_box','.top_prod_box','.bottom_prod_box','.center_prod_box','.prod_details_tab','img.left_bt','a.prod_details','.prod_box_big','.top_prod_box_big','.bottom_prod_box_big','.center_prod_box_big','.product_img_big','.details_big_box','.product_title_big','.specifications','.thumbs','.thumbs a','.prod_price_big','span.reduce','span.price','a.addtocart','a.compare','span.blue','.contact_form','.form_row','label.contact','input.contact_input','textarea.contact_textarea','a.contact','.footer','.left_footer','.right_footer','.right_footer a','.right_footer a:hover','.center_footer'];
    var aaa=$("#className").val();
    var abc=aaa.split('&');
    
    var bbb=$("#css").val();
    var cba=bbb.split('&');
    
    //alert($("#span1").css(attr[2]));
    var str=" ";    
    var sessionid=$("#session").val();
    for (var i = 0; i < abc.length-1; i++) 
    { 
        
        if($(abc[i]).length != 0)
        {
        var elimen=getOnlyCss($.trim(abc[i]),$.trim(cba[i]));
        oclick_save_data(sessionid,abc[i],elimen);
        //alert(abc[i]+':-'+elimen);
        }        
        //alert(abc[i]+' :=> '+elimen);
    } 
    hide_prossesing_image();//this function is on include file 
    
}
function getOnlyCss(elimentId,attr)
        {
        var sp=attr.split(';');
        var vl="";
        var str="";
            for (var i = 0; i < sp.length-1; i++) 
           { 
               var a=sp[i].split(':');
               a[0]=$.trim(a[0]);
               //alert($(".product_title a").css("font-size").length);
               var value=$(elimentId).css(a[0]);
              //alert(elimentId+' class name '+value+' value '+a[0]);
              if((value!=null) && (value!="") )
               {
                  // alert('if');
                   str+=$.trim(a[0])+":";                    
                   if((a[0]=="background-color")||(a[0]=="color")||(a[0]=="background"))
                   {
                       //str+=$(elimentId).css(a[0])+" ; ";
                       str+=hexc($(elimentId).css(a[0]))+";";                       
                   }
                   else
                   {
                       str+=$(elimentId).css(a[0])+";";
                   }
               //alert(elimentId+" get new value ->"+a[0]+": "+$(elimentId).css(a[0])+";"+str);               
              }
               else{
                   //alert('else');
               str+=a[0]+":";
              str+=a[1]+";";
               //alert(elimentId+" not->"+a[0]+": "+a[1]+";");                           
               
               }
           }
    
    /*var len = attr.length, obj = {};
    //alert($("#span1").css(attr[2]));
    
    for (var i = 0; i < len; i++) 
    {
        if(($(elimentId).css(attr[i])!=null))
        {
        str+=(attr[i])+": ";
        str+=($(elimentId).css(attr[i]))+" ; ";
        }
        //obj[attr[i]] = $("#window_popup").call(this, attr[i]);
    }*/
    return str;
    }
    
    function hexc(colorval) 
    {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) 
        {
            parts[i] = parseInt(parts[i]).toString(16);
            if (parts[i].length == 1) parts[i] = '0' + parts[i];
        }
       return color = '#' + parts.join('');
    }
function oclick_save_data(sessionid,fild,elimen)
    {
        $.ajax({
      type: "POST",
      url: "<?php echo BASE_URL?>Inserdata/update_prod",
      async: false,
      data: { userId:sessionid,className:fild,Css:elimen}
    });
    }
    
</script>


         
