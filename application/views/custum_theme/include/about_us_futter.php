<?php //define(BASE_URL, 'http://localhost/shope_harvest/');
/*
?>
<style>.about_us_fotter
            { 
                background: #F5F5F5;//F5F5F5;
            }
            .ab_f_fh{text-align: center;vertical-align: middle;background: #F5F5F5;font-size: 25px;}
            .ab_f_h{text-align: left;font-size: 17px;font-weight: 200;}
        </style>
<div class="col-xs-12 col-md-12 about_us_fotter" style="margin-top: 70px;margin-bottom: 30px;">
    <?php for($i=4;$i>=1;$i--){
     switch ($i) {
         case 1: ?>
            <div class="col-xs-12 col-md-3">
                <div class="col-md-12 ab_f_fh"><a href="#">Hour Team</a></div> 
                <div class="hidden-xs">
                    <?php  foreach ($get_menu as $get_menu_data)
                    {?>
                    <div class="col-md-12 ab_f_h"><a href="#" ><?php echo $get_menu_data['label'];?></a></div>
                    <?php }?>                
                </div>
            </div>
         <?php break; ?>
          <?php case 2:?>
          <div class="col-xs-12 col-md-3">                
                <div class="col-md-12 ab_f_fh"><a href="#">About Us</a></div>
                <div class="col-md-12 ab_f_h hidden-xs">
    <?php ?>
    <?php 
    if(!$user_aboutus_sort)
        {
   $user_aboutus_sort="Ucodice provides business consulting for Any Business over the internet. Ucodice is a team of professional that aims to provide high business solutions. We have Potential to turn a website visitor into your customer by using the skills of our dedicated support team. We are one of leading web Development Company. We provide all the web development solution to the clients across the world.  We have a dedicated technical support team to support your software’s backend support, which includes both technical & non-technical support.  You can out-source your product’s support to us for better revenues. We take care of all your customer’s requirements.  At Ucodice, we also offer complete web development solutions from the conceptualization, design, development, integration, and implementation to maintenance.
Ucodice provides comprehensive web services ranging from custom website design to development of complicated internet solutions. We provide best solution to clients by understanding their business requirements and combining the knowledge of technology competence to deliver high-quality result. We also follow complete SDLC (Software Development Life Cycle) which make ensure to deliver the project in timely and cost-effective manner.
We do not compromise with quality standards therefore we keep a dedicated quality assurance team which monitor each project to meet quality standards at each stage.
We have experts in the popular web development techniques. We provide you development solution with many popular scripting languages and databases like PHP, JSP, ASP, .NET, Java Script, MYSQL, MSSQL, oracle & MS Access etc. We also utilize other services such as Ajax, Jquery, Json.
Ucodice aim to win costumer’s trust as well as create long-lasting business relationship. We are ready to go with you anytime, anywhere to make you succeed over the internet.";
        }
 ?>
                    <?php echo substr($user_aboutus_sort,0,300).'  ....';?>
                </div>
            </div>
         <?php break;?>
         
    <?php case 3:?>
        <div class="col-xs-12 col-md-3">                
                <div class="col-md-12 ab_f_fh"><a href="#">Contact Info</a></div>
                <div class="col-md-12 ab_f_h hidden-xs">
              <?php ?>
            <?php if(!$user_contectus_sort) 
                {
            $user_contectus_sort="Phone : 1.800.254.5487 Fax : 1.800.254.2548 Email : info(at)fashionpress.com "; 
                }?>
                <?php echo substr($user_contectus_sort,0,300).'  ....';?>
                </div>
            </div>
    <?php break;?>    
    <?php case 4:?>
        <div class=" col-xs-12 col-md-3">                
                <div class="col-md-12 ab_f_fh"><a href="#">Term & Condition</a> </div>                
                <div class="col-md-12 ab_f_h hidden-xs">
                <?php ?>
    <?php if(!$user_TermCondition_sort)
        {
                    $user_TermCondition_sort="this our data you can change it
                    Our website terms and conditions template has been designed for use on typical websites, including those with with basic interactive features. 
                    It includes, amongst other things, a licence specifying how the website may be used, a disclaimer of liability, a statutory disclosures section and rules on user-contributed content. 
                    It is an extended version of our website disclaimer document. 
                    It is not suitable for websites featuring payments: for which ";
        }?>
        <?php echo substr($user_TermCondition_sort,0,300).'  ....';?>                  
                </div>
            </div>
    <?php break;?>
    
    
         <?php default:?>
            
    <?php break;?>
     <?php } ?>
    <?php }?>
        </div>
        <?php */?>
<style>    
    .about_us_fotter{ background: #F8F8F8;position: relative;top: 50px;
    }
    .ab_f_fh{text-align: left;vertical-align: middle;background: #F8F8F8;font-size: 20px;}
    .ab_f_h{text-align: left;font-size: 17px;font-weight: 200;}
    .ab_f_h a,.ab_f_fh a{color: #000000; text-decoration: none;}
    .ab_f_h a:hover,.ab_f_fh a:hover{color: #000080; text-decoration: none;}
    .padding30{padding:  30px;}
</style>


<?php if($user_edit_panel){  $title="title='Drag me to arrange'"; ?>
<?php echo mouceiconeonmove_or_click('.footer_move');?>
<style>    
    .instructions{display: block;background: #ccc;}
    .arrow{display: block;margin-top: -21px;
margin-left: 136px;}
</style>

<?php }else{ $title=""; } ?>





<?php //print_r($footer_position); ?>
<div class="about_us_fotter" >
                
    <div class="container">
        <div id="footer_sortable" class=" col-lg-12 col-sm-12 col-xs-12 col-md-12 padding30 footer_sortable"  ><?php /*ondblclick="load_popup('#view_prod','#aboutus_footer_pop')"*/?>
    <?php if($footer_position['status']){  ?>
    
    
    <?php for($p=0;$p<count($footer_position['rows']);$p++){ ?>
    
    <?php if(in_array($footer_position['rows'][$p]['position'],array(0,1,2,3))&& $footer_position['rows'][$p]['div_id']=='footer_menu'){ ?>
            
            
            <div class="col-xs-12 col-md-3 footer_move " id="footer_menu" ondblclick="load_popup('#view_prod','#menu_pop')">
                <div data-toggle="popover" class="aboutusfooter_menu">
                    <div class="col-md-12 ab_f_fh"><a ></a></div> 
                    <div class="hidden-xs footermenusameasheader">
                        <?php if($get_menu){  foreach ($get_menu as $get_menu_data){  ?>
                        <div class="col-md-12 ab_f_h"  <?php if($get_menu_data['stetus']=='1'){echo 'style="display: none;"';}?> >
                            <a id="<?php echo $get_menu_data['id'];?>" href="<?php echo BASE_URL.$user_name."/Shope/".$get_menu_data['link'];?>" >
                                <?php echo $get_menu_data['label'];?>
                            </a>
                        </div>
                        <?php } } ?>
                    </div>
                </div>    
            </div>
            
            
    <?php } else if(in_array($footer_position['rows'][$p]['position'],array(0,1,2,3))&& $footer_position['rows'][$p]['div_id']=='footer_about'){ ?>
            
            
                <div class="col-xs-12 col-md-3 footer_move" id="footer_about" ondblclick="load_popup('#view_prod','#aboutus_footer_pop_aboutus')">                    
                    <div data-toggle="popover" class="AboutUstext">
                    <div class="col-md-12 ab_f_fh"><a >About Us</a></div>
                    <div class="col-md-12 ab_f_h hidden-xs " id="AboutUstext">
                        <?php if($user_aboutus_sort) {echo ($user_aboutus_sort); } ?>
                    </div>
                    </div>
                </div>
               
    <?php }else if(in_array($footer_position['rows'][$p]['position'],array(0,1,2,3))&& $footer_position['rows'][$p]['div_id']=='footer_contact'){ ?>        
            
                    
                <div class="col-xs-12 col-md-3 footer_move" id="footer_contact" ondblclick="load_popup('#view_prod','#aboutus_footer_pop_contact')"> 
                    <div data-toggle="popover" class="ContactInfotext">
                    <div class="col-md-12 ab_f_fh"><a >Contact Info</a></div>
                    <div class="col-md-12 ab_f_h hidden-xs " id="ContactInfotext">
                       <?php if($user_contectus_sort) { echo ($user_contectus_sort); } ?>
                    </div>
                    </div>
                </div> 
                   
    <?php }else if(in_array($footer_position['rows'][$p]['position'],array(0,1,2,3))&& $footer_position['rows'][$p]['div_id']=='footer_terms'){ ?>
            
            
                <div class=" col-xs-12 col-md-3 footer_move " id="footer_terms" ondblclick="load_popup('#view_prod','#aboutus_footer_pop_termcondition')">
                    <div data-toggle="popover" class="TermandConditiontext">
                    <div class="col-md-12 ab_f_fh"><a >Term & Condition</a> </div>                
                    <div class="col-md-12 ab_f_h hidden-xs " id="TermandConditiontext">
                        <?php if($user_TermCondition_sort){ echo ($user_TermCondition_sort); } ?>
                    </div>
                    </div>
                </div>
            
            
    <?php } ?>      
            
    <?php } ?>
            
            
     <?php }else{ ?>
            
            
            
            
            <div class="col-xs-12 col-md-3 footer_move" id="footer_menu" ondblclick="load_popup('#view_prod','#menu_pop')">
                <div data-toggle="popover" class="aboutusfooter_menu">
                    <div class="col-md-12 ab_f_fh"><a href="#"></a></div> 
                    <div class="hidden-xs footermenusameasheader">
                        <?php if($get_menu){ ?>
                            <?php  foreach ($get_menu as $get_menu_data)
                            {?>
                            <div class="col-md-12 ab_f_h">
                                <a id="<?php echo $get_menu_data['id'];?>" href="<?php echo BASE_URL.$user_name."/Shope/".$get_menu_data['link'];?>" >
                                    <?php echo $get_menu_data['label'];?>
                                </a>
                            </div>
                            <?php }?> 
                         <?php } ?>
                    </div>
                </div>    
            </div>
           
            
             
                <div class="col-xs-12 col-md-3 footer_move" id="footer_about" ondblclick="load_popup('#view_prod','#aboutus_footer_pop_aboutus')">
                    <div data-toggle="popover" class="AboutUstext">
                    <div class="col-md-12 ab_f_fh"><a >About Us</a></div>
                    <div class="col-md-12 ab_f_h hidden-xs " id="AboutUstext">
                        <?php if($user_aboutus_sort) {echo ($user_aboutus_sort); } ?>
                    </div>
                    </div>
                </div>
                
            
                   
                <div class="col-xs-12 col-md-3 footer_move" id="footer_contact" ondblclick="load_popup('#view_prod','#aboutus_footer_pop_contact')"> 
                    <div data-toggle="popover" class="ContactInfotext">
                    <div class="col-md-12 ab_f_fh"><a >Contact Info</a></div>
                    <div class="col-md-12 ab_f_h hidden-xs " id="ContactInfotext">
                       <?php if($user_contectus_sort) { echo ($user_contectus_sort); } ?>
                    </div>
                    </div>
                </div> 
                   
            
            
                <div  class=" col-xs-12 col-md-3 footer_move" id="footer_terms" ondblclick="load_popup('#view_prod','#aboutus_footer_pop_termcondition')">
                    <div data-toggle="popover" class="TermandConditiontext">
                    <div class="col-md-12 ab_f_fh"><a >Term & Condition</a> </div>                
                    <div class="col-md-12 ab_f_h hidden-xs " id="TermandConditiontext">
                    <?php if($user_TermCondition_sort){ echo ($user_TermCondition_sort); } ?>            
                    </div>
                    </div>
                </div>
               
            
     <?php } ?>      
       </div>
            

       
       
       
       
       
       
       <style>
        .social_m>li{float: right;}
       .social_m>li>a>img{width: 40px;height: 35px;margin-right: 2px;}
       </style>
        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 socialmidialink" ondblclick="load_popup('#view_prod','#user_socialmidia_pop')"><?php /**/?>
            <ul class="social_m">                
                <?php 
               // print_r($products);
                                //exit();
                if($products['res']){
                foreach ($products['rows'] as $val)
                {  
                ?>
                <li id="<?php echo $val->id?>">
                    <a target = '_blank' href="<?php echo $val->url.$val->link;?>" >
                        <img class="img-rounded img-responsive" src="<?php echo BASE_URL.'assets/image/social/'.$val->image1;?>" >
                    </a>
                </li>
                <?php
                } }?>
            </ul>                    
        </div>
       
       
       
    </div>
</div>



<?php if($user_edit_panel){ ?>

<script>
  $(function() {
      $("#footer_sortable a").removeAttr("href");
       $(".social_m li a").removeAttr("href");
        $('#about_footer_move .footer_sortable').sortable({
            update: function () { save_new_order_footer() }
        });

        function save_new_order_footer() {
            $("#profile_footer_move").html($("#about_footer_move").html());
            $('#about_footer_move .footer_sortable').children().each(function (i) {
                //a.push($(this).attr('id') + ':' + i);
                //alert(i);
                var position = i;
                var div_id = $(this).attr('id');
                setposition_footer(position,div_id);
            });
        }

        $("#about_footer_move .footer_sortable").disableSelection();
        
     
    });
    
    
    function setposition_footer(position,div_id){
        var page='footer';
        
        //console.log(div_id+'|'+position);
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
    
    
    
    
    $(function() {
      //$("#footer_sortable a").removeAttr("href");
      
        $('#profile_footer_move .footer_sortable').sortable({
            update: function () { save_new_order_footer1() }
        });

        function save_new_order_footer1() {
            $("#about_footer_move").html($("#profile_footer_move").html());
            $('#profile_footer_move .footer_sortable').children().each(function (j) {
                //a.push($(this).attr('id') + ':' + i);
                var position = j;
                var div_id = $(this).attr('id');
                setposition_footer1(position,div_id);
            });
        }

        $("#profile_footer_move .footer_sortable").disableSelection();
    });
    
    
    function setposition_footer1(position,div_id){
        var page='footer';
        //console.log(div_id+'|'+position);
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