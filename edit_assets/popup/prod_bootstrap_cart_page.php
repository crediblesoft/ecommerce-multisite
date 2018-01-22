<?php include 'db_include.php';   ?>  
    <?php 
    function getbootstrap($userid , $classname , $fildname) 
   {
    
//SELECT `id`, `user_id`, `tag_name`, `class_type`, `class_name`, `class_css` FROM `db_css`
        $qr="SELECT `id`, `user_id`, `theme_id`, `class`, `bootstrap_name`, `bootstrap_num` FROM `db_bootstrap` WHERE  `user_id`= '".$userid."' AND `class`='".$classname."' AND `bootstrap_name`='".$fildname."' ";
        $ab = mysql_query($qr)or die(mysql_error());
        if(mysql_num_rows($ab)>0)
        {
        $res=mysql_fetch_assoc($ab);
        return $res['bootstrap_num'];
        }
        else {
            return "";
        }
       
      
    }
   
    
    ?>
    
        <?php  if($_REQUEST['pp_name']){
            $pp_name=$_REQUEST['pp_name'];
            $bootstrap_col="col-md-";
            $bootstrap_col_p="float";
            ?>
<div  id="<?php echo $pp_name;?>" state="disabled notRotatable" class="<?php echo $daynamiceresponcivepopup;?>" >
    
        <div class="row">
            <?php echo topheaderpopupsaveclose('d_off("#'.$pp_name.'")','savebootstrappage()','Editing Product  ');?>
<!--            <div class="col-lg-12" style="background-color: #DFDFDF;">                
                <div class="col-lg-12 text-center"><h3 >Editing Product</h3></div>
            </div>            -->
            <div class="table-responsive col-lg-12">
                <table class="table table-bordered" style="text-align: center;">
                      
                    <tr>
                        <td colspan="3" style="vertical-align: middle"><b>image size</b></td>                       
                        <td style="float: right;">
                             <?php  $width_of_prod_image="#".$pp_name."width_of_prod_image";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <label for="sel1">Select list (select one):</label>
                         <select onchange='onchange_bootstrap(".product_img",<?php echo '"'.$bootstrap_col.'"';?>,<?php echo '"'.$width_of_prod_image.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_prod_image';?>" name="<?php echo $pp_name.'width_of_prod_image';?>" >
                              <?php $val=getbootstrap('111', 'product_img' , $bootstrap_col);                                     
                                     ?>
                             <option selected="" value="<?php echo $val?>"><?php echo ((($val)/12)*100).'%'?></option>  
                              <option value="12">100%</option>
                              <option value="11">91.66%</option> 
                              <option value="10">83.33%</option> 
                              <option value="9">75%</option>                              
                              <option value="8">66.66%</option>
                              <option value="7">58.33%</option>
                              <option value="6">50%</option>
                              <option value="4">41.66%</option>
                              <option value="4">33.33%</option>
                              <option value="3">25%</option>
                              <option value="2">16.66%</option>
                              <option value="1">8.33%</option>
                            </select>
                         
                         <?php  $width_of_prod_image_p="#".$pp_name."width_of_prod_image_p";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <?php $val=getbootstrap('111', 'product_img' , $bootstrap_col_p);                                     
                                     ?>
                         <select onchange='onchange_bootstrap_position(".product_img",<?php echo '"'.$val.'"';?>,<?php echo '"'.$width_of_prod_image_p.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_prod_image_p';?>" name="<?php echo $pp_name.'width_of_prod_image_p';?>" >
                              
                             <option selected="" value="<?php echo $val?>"><?php echo $val?></option>  
                              <option value="left">left</option>
                              <option value="right">right</option>
                              <option value="none">none</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" style="vertical-align: middle"><b>product detail</b></td>                       
                        <td style="float: right;">
                             <?php  $width_of_prod_detail="#".$pp_name."width_of_prod_detail";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <label for="sel1">Select list (select one):</label>
                         <select onchange='onchange_bootstrap(".prod_detail",<?php echo '"'.$bootstrap_col.'"';?>,<?php echo '"'.$width_of_prod_detail.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_prod_detail';?>" name="<?php echo $pp_name.'width_of_prod_detail';?>" >
                             <?php $val=getbootstrap('111', 'prod_detail' , $bootstrap_col);                                     
                                     ?>
                             <option selected="" value="<?php echo $val?>"><?php echo ((($val)/12)*100).'%'?></option>  
                              <option value="12">100%</option>
                              <option value="11">91.66%</option> 
                              <option value="10">83.33%</option> 
                              <option value="9">75%</option>                              
                              <option value="8">66.66%</option>
                              <option value="7">58.33%</option>
                              <option value="6">50%</option>
                              <option value="4">41.66%</option>
                              <option value="4">33.33%</option>
                              <option value="3">25%</option>
                              <option value="2">16.66%</option>
                              <option value="1">8.33%</option>
                            </select>  
                         <?php  $width_of_prod_detail_p="#".$pp_name."width_of_prod_detail_p";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <?php $val=getbootstrap('111', 'prod_detail' , $bootstrap_col_p);                                    
                                if($val!=''){    ?>
                         <select onchange='onchange_bootstrap_position(".prod_detail",<?php echo '"'.$val.'"';?>,<?php echo '"'.$width_of_prod_detail_p.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_prod_detail_p';?>" name="<?php echo $pp_name.'width_of_prod_detail_p';?>" >
                              
                             <option selected="" value="<?php echo $val?>"><?php echo $val?></option>  
                              <option value="left">left</option>
                              <option value="right">right</option>
                              <option value="none">none</option>
                            </select>
                                <?php }?>
                        </td>
                    </tr> 
                    
                    <tr>
                        <td colspan="3" style="vertical-align: middle"><b>product title</b></td>                       
                        <td style="float: right;">
                             <?php  $width_of_product_title="#".$pp_name."width_of_product_title";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <label for="sel1">Select list (select one):</label>
                         <select onchange='onchange_bootstrap(".product_title",<?php echo '"'.$bootstrap_col.'"';?>,<?php echo '"'.$width_of_product_title.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_product_title';?>" name="<?php echo $pp_name.'width_of_product_title';?>" >
                              <?php $val=getbootstrap('111', 'product_title' , $bootstrap_col)                                     
                                     ?>
                             <option selected="" value="<?php echo $val?>"><?php echo ((($val)/12)*100).'%'?></option>  
                              <option value="12">100%</option>
                              <option value="11">91.66%</option> 
                              <option value="10">83.33%</option> 
                              <option value="9">75%</option>                              
                              <option value="8">66.66%</option>
                              <option value="7">58.33%</option>
                              <option value="6">50%</option>
                              <option value="4">41.66%</option>
                              <option value="4">33.33%</option>
                              <option value="3">25%</option>
                              <option value="2">16.66%</option>
                              <option value="1">8.33%</option>
                            </select>
                         <?php  $width_of_product_title_p="#".$pp_name."width_of_product_title_p";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <?php $val=getbootstrap('111', 'product_title' , $bootstrap_col_p);                                    
                                if($val!=''){    ?>
                         <select onchange='onchange_bootstrap_position(".product_title",<?php echo '"'.$val.'"';?>,<?php echo '"'.$width_of_product_title_p.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_product_title_p';?>" name="<?php echo $pp_name.'width_of_product_title_p';?>" >
                              
                             <option selected="" value="<?php echo $val?>"><?php echo $val?></option>  
                              <option value="left">left</option>
                              <option value="right">right</option>
                              <option value="none">none</option>
                            </select>
                                <?php }?>
                        </td>
                    </tr> 
                    
                    <tr>
                        <td colspan="3" style="vertical-align: middle"><b>product Price</b></td>                       
                        <td style="float: right;">
                             <?php  $width_of_prod_price="#".$pp_name."width_of_prod_price";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <label for="sel1">Select list (select one):</label>
                         <select onchange='onchange_bootstrap(".prod_price",<?php echo '"'.$bootstrap_col.'"';?>,<?php echo '"'.$width_of_prod_price.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_prod_price';?>" name="<?php echo $pp_name.'width_of_prod_price';?>" >
                              <?php $val=getbootstrap('111', 'prod_price' , $bootstrap_col)                                     
                                     ?>
                             <option selected="" value="<?php echo $val?>"><?php echo ((($val)/12)*100).'%'?></option>  
                              <option value="12">100%</option>
                              <option value="11">91.66%</option> 
                              <option value="10">83.33%</option> 
                              <option value="9">75%</option>                              
                              <option value="8">66.66%</option>
                              <option value="7">58.33%</option>
                              <option value="6">50%</option>
                              <option value="4">41.66%</option>
                              <option value="4">33.33%</option>
                              <option value="3">25%</option>
                              <option value="2">16.66%</option>
                              <option value="1">8.33%</option>
                            </select> 
                         <?php  $width_of_prod_price_p="#".$pp_name."width_of_prod_price_p";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <?php $val=getbootstrap('111', 'prod_price' , $bootstrap_col_p);                                    
                                if($val!=''){    ?>
                         <select onchange='onchange_bootstrap_position(".prod_price",<?php echo '"'.$val.'"';?>,<?php echo '"'.$width_of_prod_price_p.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_prod_price_p';?>" name="<?php echo $pp_name.'width_of_prod_price_p';?>" >
                              
                             <option selected="" value="<?php echo $val?>"><?php echo $val?></option>  
                              <option value="left">left</option>
                              <option value="right">right</option>
                              <option value="none">none</option>
                            </select>
                                <?php }?>
                        </td>
                    </tr> 
                    
                    <tr>
                        <td colspan="3" style="vertical-align: middle"><b>View product</b></td>                       
                        <td style="float: right;">
                             <?php  $width_of_view_prod_detail="#".$pp_name."width_of_view_prod_detail";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <label for="sel1">Select list (select one):</label>
                         <select onchange='onchange_bootstrap(".view_prod_detail",<?php echo '"'.$bootstrap_col.'"';?>,<?php echo '"'.$width_of_view_prod_detail.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_view_prod_detail';?>" name="<?php echo $pp_name.'width_of_view_prod_detail';?>" >
                              <?php $val=getbootstrap('111', 'view_prod_detail' , $bootstrap_col)                                     
                                     ?>
                             <option selected="" value="<?php echo $val?>"><?php echo ((($val)/12)*100).'%'?></option>  
                              <option value="12">100%</option>
                              <option value="11">91.66%</option> 
                              <option value="10">83.33%</option> 
                              <option value="9">75%</option>                              
                              <option value="8">66.66%</option>
                              <option value="7">58.33%</option>
                              <option value="6">50%</option>
                              <option value="4">41.66%</option>
                              <option value="4">33.33%</option>
                              <option value="3">25%</option>
                              <option value="2">16.66%</option>
                              <option value="1">8.33%</option>
                            </select>
                         <?php  $width_of_view_prod_detail_p="#".$pp_name."width_of_view_prod_detail_p";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <?php $val=getbootstrap('111', 'view_prod_detail' , $bootstrap_col_p);                                    
                                if($val!=''){    ?>
                         <select onchange='onchange_bootstrap_position(".view_prod_detail",<?php echo '"'.$val.'"';?>,<?php echo '"'.$width_of_view_prod_detail_p.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_view_prod_detail_p';?>" name="<?php echo $pp_name.'width_of_view_prod_detail_p';?>" >
                              
                             <option selected="" value="<?php echo $val?>"><?php echo $val?></option>  
                              <option value="left">left</option>
                              <option value="right">right</option>
                              <option value="none">none</option>
                            </select>
                                <?php }?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="3" style="vertical-align: middle"><b>Add to cart</b></td>                       
                        <td style="float: right;">
                             <?php  $width_of_customform="#".$pp_name."width_of_customform";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <label for="sel1">Select list (select one):</label>
                         <select onchange='onchange_bootstrap(".customform",<?php echo '"'.$bootstrap_col.'"';?>,<?php echo '"'.$width_of_customform.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_customform';?>" name="<?php echo $pp_name.'width_of_customform';?>" >
                              <?php $val=getbootstrap('111', 'customform' , $bootstrap_col)                                     
                                     ?>
                             <option selected="" value="<?php echo $val?>"><?php echo ((($val)/12)*100).'%'?></option>  
                              <option value="12">100%</option>
                              <option value="11">91.66%</option> 
                              <option value="10">83.33%</option> 
                              <option value="9">75%</option>                              
                              <option value="8">66.66%</option>
                              <option value="7">58.33%</option>
                              <option value="6">50%</option>
                              <option value="4">41.66%</option>
                              <option value="4">33.33%</option>
                              <option value="3">25%</option>
                              <option value="2">16.66%</option>
                              <option value="1">8.33%</option>
                            </select> 
                         <?php  $width_of_customform_p="#".$pp_name."width_of_customform_p";  
                         //$s_name_c="#".$pp_name."s_name_c";?>
                         <?php $val=getbootstrap('111', 'customform' , $bootstrap_col_p);                                    
                                if($val!=''){    ?>
                         <select onchange='onchange_bootstrap_position(".customform",<?php echo '"'.$val.'"';?>,<?php echo '"'.$width_of_customform_p.'"';?>)' class="form-control" id="<?php echo $pp_name.'width_of_customform_p';?>" name="<?php echo $pp_name.'width_of_customform_p';?>" >
                              
                             <option selected="" value="<?php echo $val?>"><?php echo $val?></option>  
                              <option value="left">left</option>
                              <option value="right">right</option>
                              <option value="none">none</option>
                            </select>
                                <?php }?>
                        </td>
                    </tr>
                </table>
                
            </div>
        </div>
    
        <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">                
               <button class="pbb btn-block" onClick='d_off(<?php echo '"#'.$pp_name.'"';?>)'>
                   <span class="fa fa-close"></span>Close
               </button>
            </div>
    <div class="col-lg-offset-1 col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">              
               <button class="pbb btn-block" onClick='savebootstrappage()'>
                  <span class="fa fa-save"></span> Save
               </button><?php //echo $no_of_prod;?>
            </div > 
    
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
    function aaa(a){alert($(a).attr('class'));}
    function onchange_bootstrap_position(fild,work,data)
    {
    var n_data=$(data).val();
   var n_name='',class_name= $(fild).attr('class');
   class_name=$.trim(class_name);
   var class_n=class_name.split(' ');
   var co=0;
   for(var i=0;i<=class_n.length-1;i++)
   {
       if ((class_n[i].indexOf('left') >= 0)||class_n[i].indexOf('right') >= 0) 
        {
            if((n_data!='none'))
            {
            n_name =n_name+n_data;
            }  co++;       
        }
        else 
        {
           n_name =n_name+class_n[i];
        }        
       if(class_n.length-1!=i){n_name =n_name+' ';}
   }
   if(((co==0)&&((n_data=='left')||(n_data=='right')))){n_name =n_name+' '+n_data; }
  // alert(n_data+'   as  as '+n_name);
   $(fild).attr('class', n_name);
    
    }
    function onchange_bootstrap(fild,work,data)
    {
    var n_data=$(data).val();
   var n_name='',class_name= $(fild).attr('class');
   class_name=$.trim(class_name);
   var class_n=class_name.split(' ');
   for(var i=0;i<=class_n.length-1;i++)
   {
       if (class_n[i].indexOf("col-md-") >= 0) 
        {
         var cl_n=class_n[i].split('col-md-');        
         n_name =n_name+cl_n[0]+'col-md-'+n_data;
         
        }else if (class_n[i].indexOf("float") >= 0){}
        else
        {
           n_name =n_name+class_n[i];
        }
       if(class_n.length-1!=i){n_name =n_name+' ';}
   }
   //alert(n_name);
   $(fild).attr('class', n_name);
    //alert(class_n.length);
    //alert('.'+$('#items').attr('class').split(' ').join('.'));
    }
    function savebootstrappage()
    {
       var sessionid=$("#session").val(); 
       var abc=$("#bootstrap").val();
       var cba=abc.split('&');
        
        for (var i = 0; i < abc.length-1; i++) 
        { 
            
            var clas=$("."+cba[i]).attr("class");
            var val=clas.split(' ');           
            var classes=cba[i];
            var bootstrap_name='';
            var bootstrap_no='';
            for(var j=0;j<=val.length-1;j++)
            {
                
                if((val[j].indexOf("col-md-") >= 0))
                {
                    //var val=val[j].split('');
                    var lastw= val[j].substring(val[j].lastIndexOf("-") + 1, val[j].length);
                    //alert(lastw);
                    classes;
                    bootstrap_name='col-md-';
                    bootstrap_no=lastw;
                    oclick_save_data($.trim(sessionid),classes,bootstrap_name,$.trim(bootstrap_no));
                }                
                else if((val[j].indexOf("right") >= 0)||(val[j].indexOf("left") >= 0))
                {
                    classes;
                    bootstrap_name='float';
                    bootstrap_no=val[j];
                    oclick_save_data($.trim(sessionid),classes,bootstrap_name,$.trim(bootstrap_no));
                }
                /*else
                {
                }*/
                //alert('sessionid '+sessionid+' classs '+classes+' bootstrap_name '+bootstrap_name+' bootstrap_no '+bootstrap_no);
            }
            
        }
       //oclick_save_data($.trim(sessionid),"prod_box","col-md-",$.trim(vl));
       var all="";
       /* $('#items').find('li').each(function(){
        var index = $(this).index()+1;
        var text = $(this).text();
        var value = $(this).attr('data-value');
        var id = $(this).attr('id');
        all+=('\n Index is: ' + index + ' , text is ' + text + ' and value is ' + value+ ' and id is ' + id+"</br>");
            });
            $("#view_prod").html(all);*/
        
    }
    function oclick_save_data(sessionid,fild,elimen,vl)
    {
        $.ajax({
      type: "POST",
      url: "<?php echo BASE_URL?>Inserdata/update_boot",
      async: false,
      data: { userId:sessionid,className:fild,bt_name:elimen,bt_num:vl}
    });
    }
</script>
