<?php ob_start();
    $menu_current_url=  current_url(); 
    $menu=explode('/',$menu_current_url);
    //print_r($_SERVER['REQUEST_URI']);exit;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
 <?php if(isset($meta_fb)){
            //print_R($meta_fb);
        ?>
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@nytimesbits" />
        <meta name="twitter:creator" content="@nickbilton" />
        <meta property="og:url" content="<?=BASE_URL?>products/details/<?=$meta_fb->prod_id?>" />
        <meta property="og:type" content="Harvest" />
        <meta property="og:title" content="<?=$meta_fb->prod_name?>" />
        <meta property="og:description" content="<?=$meta_fb->pord_detail?>" />
        <meta property="og:image" content="<?=BASE_URL?>assets/image/product/<?=$meta_fb->prod_img?>" />
    <?php }else /*if(isset($meta_fb_compaigns)){ ?>
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@nytimesbits" />
        <meta name="twitter:creator" content="@nickbilton" />
        <meta property="og:url" content="<?=BASE_URL?>campaign/view/<?=$meta_fb_compaigns->id?>" />
        <meta property="og:type" content="Harvest" />
        <meta property="og:title" content="<?=$meta_fb_compaigns->campaign_titel?>" />
        <?php if(isset($yourdonation)){ $mydonation='My donation : $'.$yourdonation['amt']; }else{$mydonation='0';} ?>
        <meta property="og:price" content="<?=$mydonation?>" />
        <meta property="og:description" content="<?php echo strip_tags($meta_fb_compaigns->campaign_detail).$mydonation; ?> " />
        <!--<meta property="og:image" content="<?=BASE_URL?>assets/image/campaign/<?=$meta_fb_compaigns->image_path?>" />-->
        <meta property="og:image" content="<?=BASE_URL?>assets/image/logo.png" />
    <?php }*/ ?>

    <title><?=TITLE?></title>

    <script src="<?=BASE_URL?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <!-- Bootstrap core CSS -->
    <link href="<?=BASE_URL?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=BASE_URL?>assets/css/style_ui.css" rel="stylesheet">
    
    <link href="<?php echo BASE_URL ?>assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=BASE_URL?>assets/css/bwizard.min.css" rel="stylesheet">
    
    <script src="<?=BASE_URL?>assets/js/1.11.3_jquery.min.js"></script>
    
    <script src="<?=BASE_URL?>assets/js/bootstrap.min.js"></script>
    
    <script src="<?=BASE_URL?>assets/js/bwizard.min.js"></script>
    
<!--<link href="<?=BASE_URL?>assets/fileinput/fileinput.css" media="all" rel="stylesheet" type="text/css" />-->
<!--<script src="<?=BASE_URL?>assets/fileinput/fileinput.js" type="text/javascript"></script>-->
    <link href="<?=BASE_URL?>assets/multiselect/css/bootstrap-multiselect.css" media="all" rel="stylesheet" type="text/css" />
    <script src="<?=BASE_URL?>assets/multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
    
    <script src="<?=BASE_URL?>assets/js/tinymce_4.2/tinymce.min.js" type="text/javascript"></script>
    
    <!--<script src="<?=BASE_URL?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>-->
    
<!--<link href="<?=BASE_URL?>assets/datepicker/datepicker3.css" media="all" rel="stylesheet" type="text/css" />
    <script src="<?=BASE_URL?>assets/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
    
    <link href="<?=BASE_URL?>assets/css/jquery-ui.css" media="all" rel="stylesheet" type="text/css" />
    <script src="<?=BASE_URL?>assets/js/jquery-ui.js" type="text/javascript"></script>
    
    
    <link rel="stylesheet" href="<?=BASE_URL?>assets/scroll/jquery.mCustomScrollbar.css">
    <script src="<?=BASE_URL?>assets/scroll/jquery.mCustomScrollbar.concat.min.js"></script>
    
    <script>
		(function($){
			$(window).load(function(){
				
				$("#autosearchresult1").mCustomScrollbar({
					setHeight:400,
					theme:"minimal-dark"
				});
				
				
			});
		})(jQuery);
                
         window.setInterval(function(){
//alert('hi');
if($('body').hasClass('fc-state-disabled')){   
}
else{
     $('.fc-today-button').trigger('click');
}
}, 1000);       
	</script>
  </head>
  

  <body>
     
<!--    <style type="text/css">
	img#share_button, img#share_button2 { cursor: pointer; }
    </style>

    <div id="fb-root"></div>

    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId  : '1541384582852340',
          status : true, // check login status
          cookie : true, // enable cookies to allow the server to access the session
          xfbml  : true  // parse XFBML
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>-->

    <div class="container-fluid">

    <div class="row">
        <?php $categories=$this->commondata['category'];?>
        
        <div class="top-header">
            <div class="row col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
            <div class="row col-sm-6 col-xs-12">
                
             <div class="row col-sm-12">  
                <div class="input-group" id="adv-search">
                    <input class="form-control" placeholder="Search by seller name or business name or product name" id="autocompletesearch" type="text">
                    <div class="input-group-btn">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="col-sm-12">    
            <div class="autosearchresult" id="autosearchresult" style="">
                
                    <ul class="col-sm-6 col-md-6 col-lg-6 col-xs-12 search_list_head">
                        <li class="row">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=BASE_URL?>assets/image/usericon.png"> &nbsp; Sellers</li>
                        <li><span class="cus_bolt_icon">&nbsp;</span><a href="">test</a></li>
                        <li><span class="cus_bolt_icon">&nbsp;</span><a href="">test</a></li>
                        
                    </ul>
                    <ul class="col-sm-6 col-md-6 col-lg-6 col-xs-12 search_list_head">
                        <li class="row"><img src="<?=BASE_URL?>assets/image/producticon.png"> &nbsp; Products</li>
                        <li><span class="cus_bolt_icon">&nbsp;</span><a href="">test</a></li>
                        <li><span class="cus_bolt_icon">&nbsp;</span><a href="">test</a></li>
                        <li><span class="cus_bolt_icon">&nbsp;</span><a href="">test</a></li>
                        <li><span class="cus_bolt_icon">&nbsp;</span><a href="">test</a></li>
                    </ul>
                

            </div> 
            </div> 
                
            </div>
            
            <div class="row col-sm-6 col-xs-12 pull-right">
                <?php if($this->session->userdata("user_type")==2 || (!$this->session->has_userdata("user_type"))){ ?>
                    <div class="row col-sm-4 pull-right cart_main">
                        <a href="<?=BASE_URL?>products/viewcart" <?php if($this->session->has_userdata("user_type")){ ?> class="show_spinner" <?php } ?> ><div class="row cart">
                        <span class="glyphicon glyphicon-shopping-cart cus_shopping_cart"></span> &nbsp; cart &nbsp; <?php echo count($this->cart->contents()); ?>
                        </div></a>
                    </div>
                <?php } ?>
            </div>
        </div> 
        </div>
        
        
      <!-- Static navbar -->
      <nav class="navbar navbar-default custom-nav">
        <div class="col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              <a class="row navbar-brand" href="<?=BASE_URL?>"><img src="<?=BASE_URL?>assets/image/logo.png" class="img-responsive"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse custom-collapse for_media_screen">
            <ul class="nav navbar-nav cus-left-nav">
              <li <?php if(in_array('home',$menu)){ ?> class="active" <?php } ?> ><a class="media_a_tag" href="<?=BASE_URL?>">Home</a></li>
              <li <?php if(in_array('aboutus',$menu)){ ?> class="active" <?php } ?> ><a class="media_a_tag" href="<?=BASE_URL?>aboutus/">About us</a></li>
              <li class="dropdown dropdown-submenu <?php if(in_array('products',$menu)){ ?>active <?php } ?>"><a class="media_a_tag" href="#" class="dropdown-toggle " data-toggle="dropdown">Products &nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                        <?php if($categories['res']){
                               foreach($categories['rows'] as $category){
                            ?>
                    <li><a class="media_a_tag" href="<?=BASE_URL?>products/<?=$category->id?>"><?=$category->category?></a></li>
                        <?php } } ?>
                </ul></li>
              
	      <li <?php if(in_array('recipe',$menu)){ ?> class="active" <?php } ?> ><a class="media_a_tag" href="<?=BASE_URL?>recipe/">Recipes</a></li>
              <?php /*<li><a href="<?=BASE_URL?>termsconditions/">Terms & conditions</a></li>*/?>
              <li <?php if(in_array('campaign',$menu)){ ?> class="active" <?php } ?> ><a class="media_a_tag" href="<?=BASE_URL?>campaign/">Support A Farm</a></li>
              <li <?php if(in_array('contactus',$menu)){ ?> class="active" <?php } ?> ><a class="media_a_tag" href="<?=BASE_URL?>contactus/">Contact</a></li>
            </ul>
            <?php if(!$this->session->userdata('user_id')){ ?>
            <ul class="nav navbar-nav navbar-right cus-right-nav">
                <li><a href="<?=BASE_URL?>auth/login" class="btn btn-default">login</a></li>
              <li><a href="<?=BASE_URL?>auth/signup" class="btn btn-default">signup</a></li>
            </ul>  
            <?php }else{ ?>
              <!--<ul class="nav navbar-nav navbar-right cus-right-nav">
                 <li><a href="<?=BASE_URL?>auth/logout" class="btn btn-default">logout</a></li>
              </ul> -->
              
              <div class="btn-group nav navbar-nav navbar-right cus-right-nav1">
                  <div id="notification" class="notification text-right" style="display:none;">
                      <a href="<?=BASE_URL?>message" id="get_new_message" title="message">1</a>
                  </div>
                <button type="button" class="btn btn-default dropdown-toggle" 
                   data-toggle="dropdown">
                   <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$this->session->userdata('user_image')?>" height="30" width="30" class="img-circle"> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                   <li><a href="<?=BASE_URL?>profile">My Account</a></li> 
                    <li><a href="<?=BASE_URL?>mail">Inbox (<?=$this->commondata['inbox']?>) </a></li>
                   <li><a href="<?=BASE_URL?>auth/logout">Logout</a></li>

                </ul>
             </div>
              
            <?php } ?>  
          </div><!--/.nav-collapse -->
        </div>
      </nav>
        
    </div>
        <style>
            .new_font{font-size: 11px !important;}
            .srch_img{width: 25px;}
        </style>      

<script>



    $(document).ready(function(){
        $(document).on("keyup","#autocompletesearch",function(){
            var autosearch=$(this).val();
            //console.log(autosearch);
            var htmldata="";
            if(autosearch!=''){
            $.get("<?=BASE_URL?>auth/autosearch/"+autosearch,function(data,status){
                //console.log(data);
                var obj=jQuery.parseJSON(data);
                 //htmldata+='<div class="row">';
                 htmldata+='<ul class="col-sm-6 col-md-6 col-lg-4 col-xs-12 search_list_head">';
                 htmldata+='<li class="row new_font">&nbsp;&nbsp;&nbsp;&nbsp;<img class="srch_img" src="<?=BASE_URL?>assets/image/usericon.png"> &nbsp; Sellers</li>';
                if(obj.user.res){
                    jQuery.each(obj.user.rows,function(i,val){
                    htmldata+='<li><span class="cus_bolt_icon">&nbsp;</span><a target="_blank" href="<?=BASE_URL?>'+val.username+'/Shope/user_profile">'+val.f_name+' '+val.l_name+'</a></li>';
                    });
                }else{
                    htmldata+='<li style="color:#f00; font-size:11px;">No Seller found </li>';
                    }
                 htmldata+='</ul>';   
                    
                htmldata+='<ul class="col-sm-6 col-md-6 col-lg-4 col-xs-12 search_list_head">';
                htmldata+='<li class="row new_font"><img class="srch_img" src="<?=BASE_URL?>assets/image/producticon.png"> &nbsp; Products</li>';
                        
                if(obj.product.res){
                        jQuery.each(obj.product.rows,function(i,val){
                        htmldata+='<li><span class="cus_bolt_icon">&nbsp;</span><a href="<?=BASE_URL?>products/details/'+val.id+'">'+val.prod_name+'</a></li>';
                        });
                }else{
                    htmldata+='<li style="color:#f00; font-size:11px;">No Product found </li>';
                }
                htmldata+='</ul>';
                
                htmldata+='<ul class="col-sm-6 col-md-6 col-lg-4 col-xs-12 search_list_head">';
                 htmldata+='<li class="row new_font">&nbsp;&nbsp;&nbsp;&nbsp;<img class="srch_img" src="<?=BASE_URL?>assets/image/usericon.png"> &nbsp; Bussiness Name</li>';
                if(obj.buss_name.res){
                    jQuery.each(obj.buss_name.rows,function(i,val){
                    htmldata+='<li><span class="cus_bolt_icon">&nbsp;</span><a target="_blank" href="<?=BASE_URL?>'+val.username+'/Shope/user_profile">'+val.business_name+'</a></li>';
                    });
                }else{
                    htmldata+='<li style="color:#f00; font-size:11px;">No Bussiness Found </li>';
                    }
                 htmldata+='</ul>';  
                
                //htmldata+='</div>'; 
                    
                    //$(".autosearchresult").css("display","block");
                    $(".autosearchresult").slideDown();
                    $(".autosearchresult").html(htmldata);
            });
            }else{
                //$(".autosearchresult").css("display","none");
                $(".autosearchresult").slideUp();
            }
        });
        
        
        $(".show_spinner").click(function(){
            $("#shinner_modal").modal("show");
        });
        
    });
    
    function ImageExist(url) 
    {
       var img = new Image();
       img.src = url;
       return img.height != 0;
    }   


</script>
