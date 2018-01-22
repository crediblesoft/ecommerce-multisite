<?php 
//    if(!$user_edit_panel){    
//    ?>
<?php 
//$class_arr=array(
//    'minheight_dynamic_user_page'=>'minheight_dynamic_user_page'       
//    );
//    if($member )
//    {
//        ?><style><?php 
//        foreach ($member as $value)
//        {
//            echo $value["class_name"]." {";    
//            echo $value["class_css"]."} "; 
//           // echo "</br>";
//        }
//        ?></style><?php 
//    }
////print_r($menu);
//    }
?>
<style>
.galary_hader2
        {
            border: 1px solid #73C873;
            font-size: 32px;
            border-radius: 5px;
            height: 50px;
            font-weight: 600;
            text-align: center;
            margin-top: 100px;
            margin-bottom:  0;
            vertical-align: middle;
        }
        
//.freeesize{min-height: 500px;min-width: 200px;width: 500px;
//}//
</style>
<script>
    
</script>
<?php if(!$user_edit_panel){     ?>       
          <div class="dynamic_user_page ">
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 ">        
                    <div class="col-md-6 col-md-offset-3 galary_hader" style="<?php echo $btn_theme_style,$this->session->userdata('user_menu_dynamic_page_title_position');?>"><?php if($this->session->userdata('user_menu_dynamic_page_title')!=''){ echo $this->session->userdata('user_menu_dynamic_page_title');}?></div>        
                </div>
<?php //echo $this->session->userdata('user_menu_dynamic_page_title'); ?>
            <div class="container">
                <div  class="col-lg-12 editpanal_add_item_page freeesize minheight_dynamic_user_page" id="add_item_page_"  >
                    <?php  $this->load->view("../../edit_assets/popup/get_val/get_eliment.php");?>
                </div>
            </div>    
        </div>
        <?php }else{  //print_r($this->session->userdata('user_pageid')); ?>
        <div class="dynamic_user_page ">
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 ">        
                    <div class="col-md-6 col-md-offset-3 galary_hader galary_hader_dynamic"  ondblclick="load_dynamic_page_popup()" style="<?php echo $btn_theme_style,$this->session->userdata('user_menu_dynamic_page_title_position');?>"><?php //echo $pagetitle4;?></div>        
                    <?php //print_r($this->session->userdata('user_pageid'));?>
                </div>
            <div class="container">
                <div   class="col-lg-12 editpanal_add_item_page freeesize minheight_dynamic_user_page" id="add_item_page_"  >
                    
                </div>
            </div>    
        </div>
         <?php }?>

<?php 
    if(!$user_edit_panel){    
    ?>
    <script>
        
    $(document).ready(function(){
        $('.minheight_dynamic_user_page .showeliment .transbox').css('position','relative');
        
        
        $('.showeliment').find('div').each(function(){           
            var styl =$(this).attr('style');
            styl=styl.replace('top: '+$(this).css('top'),'top: '+(parseInt($(this).css('top'))+parseInt(75))+'px');
          $(this).attr('style',styl);
        });
       //alert(parseInt($('.showeliment > div').css('top'))); 
    });
</script>
    <style>
        //.dynamic_user_page{position: relative;}
        .minheight_dynamic_user_page{
            min-height: 500px;
            position: relative;
            //background-color: #ccc;
        }
    </style>
    <?php     
    }else{
        ?>
<!--    <input type='hidden' id="current_page_id">
    <script>
        $(document).ready(function(){  //alert("aa");
            var current_page_id;
            $("#myTab>li").click(function(){        
                current_page_id=$(this).attr("id");
                $("#current_page_id").val($(this).attr("id"));
                    //alert('#add_item_page_'+$("#myTab li.active").attr('id'));
                    var post_pagetext= $(this).text().replace('Edit','');
                    //alert(post_pagetext);
            //$(".galary_hader").text(post_pagetext);
            getdynamicpagetitle(current_page_id);
            });
            current_page_id=$("#myTab .active").attr("id");
            getdynamicpagetitle(current_page_id);
        });
        
      function load_dynamic_page_popup(){
          var current_page_id=$("#current_page_id").val();
          //alert(current_page_id);
          load_popup2('#view_prod','#title_popup'+current_page_id,current_page_id);
      }
        //this function on side menu  side menu page path is edit_assets/side_menu/examples/side_menu.php
         function resize_dynamic_textaria(id)
            {
            //alert( $("#"+id).css('height') + ' top ' + $("#"+id).css('margin-top') );
            //if( ($(".dynamic_user_page").css('height')) < ($(document).height()-351) )
            //$(".minheight_dynamic_user_page").css('height',(parseInt($("#"+id).css('height')) + parseInt($("#"+id).css('top'))+parseInt(241))+'px');
           // $(".minheight").css('height',$(document).height()-351);
            //console.log($(document).height()+' height '+parseInt($("#"+id).css('height')) + ' top ' + parseInt($("#"+id).css('top'))+parseInt(241)+'px' );
            //console.log( (parseInt($("#"+id).css('height')) + parseInt($("#"+id).css('top'))+parseInt(241))+'px');
            }
//         $(".transbox").resize(function() {
//           alert('asdas');
//            //console.log($(this).attr('height')));
//        });
//   $(document).ready(function(){
//       //$(".dynamic_user_page")
//   });
//        $(".dynamic_user_page .minheight .parentElement").
//        $(".dynamic_user_page .minheight .div_image").
//        $(".dynamic_user_page>.minheight>.transbox").resize(function() {
//            alert('asdas');
//            //console.log($(this).attr('height')));
//        });
    </script>
    <style>
        //.dynamic_user_page{position: relative;}
        .minheight_dynamic_user_page{
            min-height: 500px;
            position: relative;
            //background-color: #ccc;
        }
        .minheight_dynamic_user_page .transbox {position: relative !important;}
    </style>-->
    <?php } ?>

<!--    <script>
        function getdynamicpagetitle(id){
            //alert(id);
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL?>Inserdata/getdynamicpagetitle",
                async: false,
                data: { id:id},
                success: function(data){
                    var obj=$.parseJSON(data);
                    //console.log(obj[0].page_title);
                    var style=obj[0].title_position+'<?php echo $btn_theme_style;?>';
                  $(".galary_hader_dynamic").attr("style",style);
                  $(".galary_hader").html(obj[0].page_title);
                  $("title").text(obj[0].browsertab);
                }
              });
        }
    </script>    -->

   
    
