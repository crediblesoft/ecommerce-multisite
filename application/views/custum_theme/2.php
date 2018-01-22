<style>
    .margentop50{margin-top: 50px;}
    .margentop30{margin-top: 30px;}
</style>
<div class="row">
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
        <div class="col-md-6 col-md-offset-3 galary_hader" style="<?php echo $btn_theme_style;?>"><?php echo $user_name."'s Store";//$pagename12;?></div>
    </div>
     <div id="add_item_page_<?php echo $pageid12;?>"></div>
    <div class="container">
        <div class="col-xs-12 col-md-12" id="user_profile"></div>
        <?php 
                if(($user_theam_id=="1001")||($user_theam_id=="1003")) {?>
        
                    <?php $this->load->view('../../edit_assets/slider/1/full_page.php'); ?>
        
                <?php }elseif(($user_theam_id=="1002")||($user_theam_id=="1004")){?>                
        
                        <?php $this->load->view('../../edit_assets/slider/2/demo.php'); ?>
        
                <?php }?>
        
            <?php $this->load->view('custum_theme/include/about_us_header.php');?>
            <?php ?>
    </div>
</div> 
<div class="row margin-bottom_10"> 
    
        <div  class="col-sm-12 col-lg-12 col-xs-12 col-md-12 user_detaii_ margentop30" style="" id="user_detaii_" > 
        </div>
   
</div>
<div class="margentop50">
<?php $this->load->view('custum_theme/include/about_us_futter.php');?>
<div>
<!--<div class="margentop30">
<?php //$this->load->view('custum_theme/include/social_media.php');?>
</div>-->

<div style="display: none;">
    <?php $this->load->view('custum_theme/prod_view.php');?>
</div> 
<script>
$(function(){
    var prodIdcontener='';
    var lidata='';cnt=0;
    var prodIdArray=[];
   $('#product_items').find('li').each(function(){cnt++;
       prodIdcontener+=$(this).attr('id')+',';
       prodIdArray.push($(this).attr('id'));
       //if(cnt!=4){
       //lidata+=$(this).html();}
   });   //alert(prodIdArray);
  
   $('.user_detaii_').append('<ul id="product_items2" class="items col-xs-12 col-md-12"></ul>');
   prodIdcontener=prodIdcontener.slice(0,-1);
   var totalprod=prodIdcontener.split(',');
   for(var i=0;i<cnt;i++)
   {
       $('.user_detaii_ ul').append('<li id='+totalprod[i]+' class="prod_box col-xs-12 col-md-3">'+$('#product_items #'+totalprod[i]).html()+'</li>');
       totalprod[i];
   }
   
    //setInterval(alertFunc, 3000);
    function alertFunc(){        
        var checkarray=[];
        $('.user_detaii_ ul').find('li').each(function(){
            checkarray.push($(this).attr('id'));        
        });
        //alert(checkarray[checkarray.length-1]);
        $('.user_detaii_ ul li:first').hide(1000,function(){
             $('.user_detaii_ ul li:first').remove();
           //setInterval(addli, 3000);
           addli();
        });
        function addli()
        {
        var  val= Math.max.apply(Math,checkarray); // 3
        var valmin= Math.min.apply(Math,prodIdArray);
        // alert(valmin);
        if((val)==9){
            $('.user_detaii_ ul').append('<li id='+valmin+' class="prod_box col-xs-12 col-md-3">'+$('#product_items #'+valmin).html()+'</li>');
            }else{
             $('.user_detaii_ ul').append('<li id='+((val+1))+' class="prod_box col-xs-12 col-md-3">'+$('#product_items #'+(val+1)).html()+'</li>');   
            } 
        }
        //var val=checkarray[checkarray.length-1];      
        //for(var i=0;i<=(totalprod.length-1);i++)
        //{
        //alert(totalprod[i]);
        //}
    }
});
 

</script>
UPDATE db_css SET `class_css` = 'font-weight:bold' WHERE `class_name` = '.product_title'
UPDATE theme_css SET `class_css` = 'font-weight:bold' WHERE `class_name` = '.product_title'

UPDATE db_css SET `class_css` = 'margin-bottom: 25px;max-height: 80px;min-height: 80px;' WHERE `class_name` = '.prod_detail'
UPDATE theme_css SET `class_css` = 'margin-bottom: 25px;max-height: 80px;min-height: 80px;' WHERE `class_name` = '.prod_detail'


UPDATE db_css SET `class_css` = 'margin-left: 16px;color: #121212;font-size: 15px;' WHERE `class_name` = 'span.price'
UPDATE theme_css SET `class_css` = 'margin-left: 16px;color: #121212;font-size: 15px;' WHERE `class_name` = 'span.price'




UPDATE `theme_bootstrap` SET `bootstrap_num`='6' WHERE `class`='prod_price' AND `bootstrap_name`='col-md-'
UPDATE `db_bootstrap` SET `bootstrap_num`='6' WHERE `class`='prod_price' AND `bootstrap_name`='col-md-'

UPDATE `theme_bootstrap` SET `bootstrap_num`='6' WHERE `class`='view_prod_detail' AND `bootstrap_name`='col-md-'   
UPDATE `db_bootstrap` SET `bootstrap_num`='6' WHERE `class`='view_prod_detail' AND `bootstrap_name`='col-md-'   


UPDATE `db_css` SET `class_css` ='padding:5px 0 5px 0;min-height: 140px;max-height: 140px;'  WHERE `class_name`='.product_img '
UPDATE `theme_css` SET `class_css` ='padding:5px 0 5px 0;min-height: 140px;max-height: 140px;'  WHERE `class_name`='.product_img '

