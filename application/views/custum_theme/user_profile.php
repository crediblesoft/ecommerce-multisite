<?php
    //print_r($profile_position);
?>
<style>#user_detaii_{
        //position: relative; top: 50px;
    }
    .margintop70{position: relative;top: 30px;}
    .margintop50{position: relative;top: 50px;}
    .padding30{padding: 30px;}
    
    .galary_hader{border: none;}
    
    .margin-bottom_50{margin-bottom: 50px;}
    
    .instructions{display: none;}
    //.arrow{display: none;}
    .instructions{display: block;background: #ccc;}
    .arrow{display: block;margin-top: -21px;
margin-left: 136px;}
.otg-carousel{border: none !important;}
    .otg-thumbnails{margin: 0px !important;}
    .otg-thumbnails li{margin: 0px !important;}
    //.edit_profile_banner .edit_profile_about .edit_profile_product :hover{cursor: move;}
    
</style>
<?php if($user_edit_panel){  $title="title='Drag me to arrange'"; ?>
<style>
    
    .instructions{display: block;background: #ccc;}
    .arrow{display: block;margin-top: -21px;
margin-left: 136px;}
</style>

<?php }else{ $title=""; } ?>

<div class="container-fluid">
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 clearfix margin-bottom_20">
        <div class="col-md-6 col-md-offset-3 galary_hader text-capitalize" id="pageno_12" ondblclick="load_popup2('#view_prod','#title_popup<?php echo $pageid12; ?>','<?php echo $pageid12; ?>')" style="<?php echo $btn_theme_style,$pagetitleposition12;?>"><?php echo $pagetitle12; //echo $user_name." Shop";?></div>
    </div>
</div>  
  <?php echo mouceiconeonmove_or_click('.edit_profile');?>      

<div  class="" id="sortable">
    
    <?php if($profile_position['status']){  ?>
    
    
    <?php for($p=0;$p<count($profile_position['rows']);$p++){ ?>
    
    <?php if(in_array($profile_position['rows'][$p]['position'],array(0,1,2))&& $profile_position['rows'][$p]['div_id']=='edit_profile_banner'){ ?>
    
    <div class="edit_profile_banner margin-bottom_50 edit_profile" id="edit_profile_banner" >
        <div id="edit_profile_banner_popover" data-toggle="popover" >
        <div id="add_item_page_<?php echo $pageid12;?>"></div>
       <div class="container">
           <!--<div class="col-xs-12 col-md-12" id="user_profile"></div>-->
           <?php if(($user_theam_id=="1001")||($user_theam_id=="1003")) {
                   $this->load->view('../../edit_assets/slider/1/full_page.php');
                   }elseif(($user_theam_id=="1002")||($user_theam_id=="1004")){
                   $this->load->view('../../edit_assets/slider/2/demo.php'); 
                   }?>
       </div>
        </div>
    </div>
    <?php }else if(in_array($profile_position['rows'][$p]['position'],array(0,1,2) )&& $profile_position['rows'][$p]['div_id']=='edit_profile_about'){ ?>
    <div class="edit_profile_about edit_profile" id="edit_profile_about"   >
    <?php $this->load->view('custum_theme/include/about_us_header.php');?>
    </div>
    <?php }else  if(in_array($profile_position['rows'][$p]['position'],array(0,1,2))&& $profile_position['rows'][$p]['div_id']=='edit_profile_product'){ ?>
    <div class="edit_profile_product edit_profile" id="edit_profile_product"  >
        <div class="container" id="edit_profile_product_popover" data-toggle="popover"  ondblclick="load_popup('#view_prod','#view_prod_popup')" >
            <div  class="col-sm-12 col-lg-12 col-xs-12 col-md-12 user_detaii_" style="" id=""  > 
            </div>
        </div>    
    </div>
    <?php } ?>
    
    <?php } ?>
    
    <?php }else{ ?>
        
    
    <div class="edit_profile_banner margin-bottom_50 edit_profile" id="edit_profile_banner">
     <div id="edit_profile_banner_popover" data-toggle="popover" >
        <div id="add_item_page_<?php echo $pageid12;?>"></div>
       <div class="container">
           <!--<div class="col-xs-12 col-md-12" id="user_profile"></div>-->
           <?php if(($user_theam_id=="1001")||($user_theam_id=="1003")) {
                   $this->load->view('../../edit_assets/slider/1/full_page.php');
                   }elseif(($user_theam_id=="1002")||($user_theam_id=="1004")){
                   $this->load->view('../../edit_assets/slider/2/demo.php'); 
                   }?>
       </div>
     </div>
    </div>

    <div class="edit_profile_about edit_profile" id="edit_profile_about" >
    <?php $this->load->view('custum_theme/include/about_us_header.php');?>
    </div>
    
    
    <div class="edit_profile_product edit_profile" id="edit_profile_product">
        
        <div class="container" id="edit_profile_product_popover" data-toggle="popover">
            <div  class="col-sm-12 col-lg-12 col-xs-12 col-md-12 user_detaii_" style="" id=""  > <!--ondblclick="alert('not active')"-->
            </div>
        </div>
    </div>
    
    
    
    
    <?php } ?>

</div>

<div id="profile_footer_move">
<?php $this->load->view('custum_theme/include/about_us_futter.php'); ?>
</div>
    <?php //$this->load->view('custum_theme/include/social_media.php');?>


<div style="display: none;">
    <?php //$this->load->view('custum_theme/prod_view.php');?>
</div>


<?php if($user_edit_panel){ ?>

<script>
  $(function() {
        $('#sortable').sortable({
            update: function () { save_new_order() }
        });

        function save_new_order() {
            $('#sortable').children().each(function (i) {
                //a.push($(this).attr('id') + ':' + i);
                var position = i%3;
                var div_id = $(this).attr('id');
                setposition(position,div_id);
            });
        }

        $("#sortable").disableSelection();
    });
    
    function setposition(position,div_id){
        var page='profile';
        $.ajax({
            type: "POST",
            url: "<?=BASE_URL?>Inserdata/save_profile_view",
            async: false,
            data: { position:position,div_id:div_id,page:page},
            success: function(data){
                console.log(data);    
                }
         });
    }
    
    
   
</script>
<?php } ?>

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
       if(i==3){i=cnt;}
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
 //Plugin start
 /*(function($)
   {
     var methods = 
       {
         init : function( options ) 
         {
           return this.each(function()
             {
               var _this=$(this);
                   _this.data('marquee',options);
               var _li=$('>li',_this);
                   
                   _this.wrap('<div class="col-xs-12 slide_container"></div>')
                        .height(_this.height())
                       .hover(function(){if($(this).data('marquee').stop){$(this).stop(true,false);}},
                              function(){if($(this).data('marquee').stop){$(this).marquee('slide');}})
                        .parent()
                        .css({position:'relative',overflow:'hidden','height':$('>li',_this).height()})
                        .find('>ul')
                        .css({width:screen.width*1.44,position:'absolute'});
           
                   for(var i=0;i<Math.ceil((screen.width*3)/_this.width());++i)
                   {
                     _this.append(_li.clone());
                   } 
             
               _this.marquee('slide');});
         },
      
         slide:function()
         {
           var $this=this;
           $this.animate({'left':$('>li',$this).width()*-1},
                         $this.data('marquee').duration,
                         'swing',
                         function()
                         {
                           $this.css('left',0).append($('>li:first',$this));
                           $this.delay($this.data('marquee').delay).marquee('slide');
             
                         }
                        );
                             
         }
       };
   
     $.fn.marquee = function(m) 
     {
       var settings={
                     'delay':1000,
                     'duration':1000,
                     'stop':true
                    };
       
       if(typeof m === 'object' || ! m)
       {
         if(m){ 
         $.extend( settings, m );
       }
 
         return methods.init.apply( this, [settings] );
       }
       else
       {
         return methods[m].apply( this);
       }
     };
   }
 )( jQuery );
 
 //Plugin end
 
 //call
 $(document).ready(
   function(){$('#items').marquee({delay:3000});}
 );*/

</script>
         
