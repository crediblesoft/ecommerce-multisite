<style>
            .social_m>li{float: right;}
            .social_m>li>a>img{width: 40px;height: 35px;margin-right: 2px;}
            
        </style>
<div class="">
    <div class="container">        
        <div class="col-lg12 col-sm-12 col-xs-12 col-md-12" ondblclick="load_popup('#view_prod','#user_socialmidia_pop')">
            
            <ul class="social_m">
                
                <?php 
               // print_r($products);
                                //exit();
                if($products['res']){
                foreach ($products['rows'] as $val)
            {  
                ?>
                <li>
                    <a target = '_blank' href="<?php echo $val->url.$val->link;?>" >
                        <img  class="img-rounded img-responsive" src="<?php echo BASE_URL.'assets/image/social/'.$val->image1;?>" >
                    </a>
                </li>
                <?php
                } }?>
            </ul>                    
        </div>
    </div>
</div>