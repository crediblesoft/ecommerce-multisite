<div class="">    
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
        <div class="col-md-6 col-md-offset-3 galary_hader" id="pageno_4" ondblclick="load_popup2('#view_prod','#title_popup<?php echo $pageid4; ?>','<?php echo $pageid4; ?>')" style="<?php echo $btn_theme_style,$pagetitleposition4;?>"><?php echo $pagetitle4;?></div>     
    
    </div>
    <div class="container">
    <div id="add_item_page_<?php echo $pageid4;?>" class="add_item_page_"></div>
            <?php //include BASE_URL.'application/views/custum_theme/about_us_header.php'; //
            
            
            
         /*   ?>
           
        <div class="col-md-12" style="margin: 50px 0px 100px 0px">
            <div class="col-md-3">
                <img class="img-rounded" src="<?=BASE_URL?>edit_assets/image/aa.png" width="100%">
                <div class="col-md-12"> asd as da sd as d asd as d asdf dg df g df g</div>
            </div>
            <div class="col-md-3">
                <img class="img-rounded" src="<?=BASE_URL?>edit_assets/image/aa.png" width="100%">
                <div class="col-md-12"> asd as da sd as d asd as d asdf dg df g df g</div>
            </div>
            <div class="col-md-3">
                <img class="img-rounded" src="<?=BASE_URL?>edit_assets/image/aa.png" width="100%">
                <div class="col-md-12"> asd as da sd as d asd as d asdf dg df g df g</div>
            </div>
            <div class="col-md-3">
                <img class="img-rounded" src="<?=BASE_URL?>edit_assets/image/aa.png" width="100%">
                <div class="col-md-12"> asd as da sd as d asd as d asdf dg df g df g</div>
            </div>
        </div>
          <?php */?>
          
        <!--<div style="border: 2px solid #F5F5F5;margin-top: 50px" class="col-md-12"></div>-->
    </div>
</div>

<div id='about_move'>
<?php  $this->load->view('custum_theme/include/about_us_header.php'); ?>
</div>
<div id="about_footer_move">
    <?php $this->load->view('custum_theme/include/about_us_futter.php');
    //include BASE_URL.'application/views/custum_theme/about_us_futter.php'; //?>
</div>


<script>//this function or  file is page on user_profile.php alsho 
/*$(function(){
    var prodIdcontener='';
    var lidata='';cnt=0;
    var prodIdArray=[];
   $('#product_items').find('li').each(function(){cnt++;
       prodIdcontener+=$(this).attr('id')+',';
       prodIdArray.push($(this).attr('id'));
       //if(cnt!=4){
       //lidata+=$(this).html();}
   });   //alert(prodIdArray);
   $('#user_detaii_').append('<div class="row content"><ul id="product_items2" class="items col-xs-12 col-md-12"></ul></div>');
   prodIdcontener=prodIdcontener.slice(0,-1);
   var totalprod=prodIdcontener.split(',');
   for(var i=0;i<=3;i++)
   {
       $('#user_detaii_ ul').append('<li id='+totalprod[i]+' class="prod_box col-xs-12 col-md-3">'+$('#product_items #'+totalprod[i]).html()+'</li>');
       totalprod[i];
   }
    //setInterval(alertFunc, 3000);
    function alertFunc(){        
        var checkarray=[];
        $('#user_detaii_ ul').find('li').each(function(){
            checkarray.push($(this).attr('id'));        
        });
        //alert(checkarray[checkarray.length-1]);
        $('#user_detaii_ ul li:first').hide(1000,function(){
             $('#user_detaii_ ul li:first').remove();
           //setInterval(addli, 3000);
           addli();
        });
        function addli()
        {
        var  val= Math.max.apply(Math,checkarray); // 3
       var valmin= Math.min.apply(Math,prodIdArray);
      // alert(valmin);
        if((val)==9){
            $('#user_detaii_ ul').append('<li id='+valmin+' class="prod_box col-xs-12 col-md-3">'+$('#product_items #'+valmin).html()+'</li>');
            }else{
             $('#user_detaii_ ul').append('<li id='+((val+1))+' class="prod_box col-xs-12 col-md-3">'+$('#product_items #'+(val+1)).html()+'</li>');   
            } 
        }
        //var val=checkarray[checkarray.length-1];
      
        //for(var i=0;i<=(totalprod.length-1);i++)
        //{
        //alert(totalprod[i]);
        //}
    }
});*/
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



<?php if($user_edit_panel){ ?>

<script>
  $(function() {
        $('#about_move #about_move_inner').sortable({
            update: function () { get_about_position(); }
        });

        function get_about_position() {
            $('#about_move #about_move_inner').children().each(function (i) {
                //a.push($(this).attr('id') + ':' + i);
                var position = i%2;
                var div_id = $(this).attr('id');
                //console.log(position);console.log(div_id);
                //console.log(div_id);
               
                //start code for change the postion of about content on profile page without refresh
                if(position==0 && div_id=='abt_img'){
                    $('#edit_profile_about .user_detaii_image').insertBefore('#edit_profile_about .userdetaiicontenttexfull');
                }else if(position==0 && div_id=='userdetaiicontenttexfull'){
                    $('#edit_profile_about .userdetaiicontenttexfull').insertBefore('#edit_profile_about .user_detaii_image');
                }
                //end code for change the postion of about content on profile page without refresh
                
                setposition_about(position,div_id);
            });
        }

        $("#about_move #about_move_inner").disableSelection();
    });
    
    function setposition_about(position,div_id){
        var page='about';
        $.ajax({
            type: "POST",
            url: "<?=BASE_URL?>Inserdata/save_about_view",
            async: false,
            data: { position:position,div_id:div_id,page:page},
            success: function(data){
                console.log(data);    
                }
         });
    }
</script>
<?php } ?>