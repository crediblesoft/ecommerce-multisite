<?php echo mouceiconeonclick('.footertextpopover');?>
<?php 
$class_arr=array('footer'=>'footer');
    foreach ($bootstrap as $data)
        {
            foreach ($class_arr as $ar=>$arv)
             {
                if($ar==$data['class'])
                {
                $class_arr[$ar].=" ".$data['bootstrap_name'].$data['bootstrap_num'];
                }
            }
        }
        ?><style>.footer{  margin-top: 50px;}</style>
<div class=" footertextpopover">
    <div class="<?php echo $class_arr['footer'];?>" ondblclick="load_popup('#view_prod','#user_footer_popup')">
        <div class="col-sm-10 col-sm-offset-1 foot2 text-center footertext" id="footertext">
            <?php ?>
            <?php 
                if(!$user_footer)
                    {
                        $user_footer="";
                    }
                     echo $user_footer;//substr($user_footer,0,300);?>
        </div>
    </div>
</div> 
<div style="display: none;">
    <?php //include '';
$this->load->view('custum_theme/prod_cart.php');//this file load for active after some time  ?>
</div> 
<script>
        (function($){
            $(window).load(function(){
                
               if($('body').hasClass('fc-state-disabled')){   
                }else{
                    $('.fc-today-button').trigger('click');
                }
            });
        })(jQuery);
        //window.setInterval(function(){
//alert('hi');
/*if($('body').hasClass('fc-state-disabled')){   
}
else{
     $('.fc-today-button').trigger('click');
}
}, 1000); */
                
             
    </script>
</body>
</html>
