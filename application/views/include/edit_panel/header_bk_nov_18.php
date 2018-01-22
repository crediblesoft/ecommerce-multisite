<style>
.popover-title{color:#28C769;font-weight: bold;font-size: 16px;}
.popover{
    font-size: 16px;max-width: 700px !important;

}        
</style> 
<style type="text/css">
.bs-example{
        //margin: 10px;
}
@media (max-width: 767px) {
 .bs-example{
        margin: 0;
    }  
 .bs-example> ul>li {
         float: none;
     }/**/
    // #myTab li{display: none;}
}
         
.menu{z-index: 100;}
/*#userlogo{
    max-width:  120px;
    min-width: 120px;
    width:  120px;
}*/
#userlogo img{
max-height: 70px;  
margin-top: -10px;
}

.cus-right-nav1{
    margin-top: 15px;
}
.headerlogoclass
{
    height: 80px;
margin-bottom: 0px;
}
.cartli{
    width: 166px;
text-align: center;
margin-top: 5px;
margin-right: 25px;
}
#loadingmessage{
display: block;
width: 100%;
//float: right;
position: fixed;
z-index: 1000;
//align-content: center;
background: #ccc;
opacity: 0.6;
height: 100%;
top: 0px;
bottom: 0px;
//vertical-align: middle;
}
#loadingmessage img{
margin-left: 40%;
margin-top: 150px;
//vertical-align: middle;
}
.cart_seller_btn{margin-top: 10px;}
.custom-collapse .cart_seller_btn li{width: 150px;}

.custom-collapse .logout {
    padding-top: 29px;
}
.custom-collapse .cus-right-nav {
   // padding-top: 40px;
    font-size: 14px;
    font-family: Lato Bold;
    text-transform: capitalize;
}
.custom-collapse .cus-right-nav li:first-child a {
    border-right: 1px solid #4FA424;
    border-radius: 4px 0px 0px 4px !important;
}
.custom-collapse .cus-right-nav li a {
    padding: 4px 11px !important;
}
.custom-collapse .cus-right-nav li a {
    color: #000000;
    padding: 4px 15px !important;
}
.custom-collapse .cus-right-nav li a {
    background-color: #ffffff !important;
}
.cus-right-nav1  .dropdown-toggle{
    border: none !important;
    background: none !important;
}
</style>
<div id='loadingmessage' style='display:none;  '>
    <img src='<?php echo  BASE_URL;?>edit_assets/image/process.gif'/>
</div>
 <?php /*style="background: url(<?php echo  BASE_URL.'edit_assets/image/aa.png';?>);"*/?>
    <div id="view_prod" class="view_prod" ></div> 
    <input type="hidden" name="className" value="<?php echo $cssclass;?>" id="className">
    <input type="hidden" name="css" value="<?php echo $css;?>" id="css">
    <input type="hidden" name="bootstrap" value="<?php echo $bootstrapname;?>" id="bootstrap">
    <input type="hidden" name="session" value="<?php echo $this->session->userdata('user_id');?>" id="session">
    <input type="hidden" name="site_url" value="<?php echo BASE_URL;?>" id="site_url_BASE_URL">

    <?php   //foreach ($user_image as $aasa){$aasa->image_path;}
$class_arr=array(
    'contener'=>'contener',
    'header'=>'header',
    'logo'=>'logo',
    'login_logout'=>'login_logout',
    'menu'=>'menu'    
    );
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
//print_r($menu);
?>
    
    <nav class="navbar navbar-default  headerlogoclass">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="#">Brand</a>-->   
      <a href="#<?php //echo BASE_URL?>" data-toggle="popover" class="navbar-brand" id="userlogo" ondblclick="load_popup('#view_prod','#usersitelogo_pop')">
          <img class="img-responsive" src="<?php if($usersitelogo){echo BASE_URL.'assets/image/gallery/'.$session_user_id.'/thumb/'.$usersitelogo;}else{echo BASE_URL.'assets/image/logo.png';} ?>">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse custom-collapse" id="bs-example-navbar-collapse-1">
        <div class="col-md-2 col-md-offset-7 col-lg-2 col-lg-offset-7 col-sm-2 col-sm-offset-5 hidden-xs">
      <ul class="nav navbar-nav cart_seller_btn">
        <li >
        <?php if(!$user_edit_panel){?>
          
            <a href="<?php echo BASE_URL."products/viewcart"?>">
                <div class="cart" style="<?php echo $btn_theme_style;?>">
                        <span class="glyphicon glyphicon-shopping-cart cus_shopping_cart"></span> 
                        Cart <?php echo count($this->cart->contents());//if(count($this->cart->contents())>0){} ?>
                         <?php //echo "item's".($this->cart->total_items());?>
                </div>
            </a>
        
            <?php }?>
        </li>
        <!--<li><a href="#">Link</a></li>-->
<!--        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>-->
      </ul>
        </div>
<!--      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>-->
<?php /*?>
      <ul class="nav navbar-nav navbar-right">
        <li>
        <?php if(!$user_edit_panel){?>
          
            <a href="<?php echo BASE_URL."products/viewcart"?>">
                <div class="cart" style="<?php echo $btn_theme_style;?>">
                        <span class="glyphicon glyphicon-shopping-cart cus_shopping_cart"></span> 
                        Cart (<?php echo count($this->cart->contents()); ?>) 
                         <?php //echo "item's".($this->cart->total_items());?>
                </div>
            </a>
        
            <?php }?>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              Dropdown 
              <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li>
                <a href="<?php echo BASE_URL?>">
                <div class="cart" style="<?php echo $btn_theme_style;?>">
                <span class="glyphicon glyphicon-e"></span> 
                Go back
                <span class="glyphicon glyphicon-home"></span>
                </div>
            </a>
            </li>
          </ul>
        </li>
      </ul>
<?php */?>
<?php if(!$this->session->userdata('user_id')){ ?>
            <ul class="nav navbar-nav navbar-right cus-right-nav logout">
                <li><a href="<?=BASE_URL?>auth/login" class="btn btn-default">login</a></li>
              <li><a href="<?=BASE_URL?>auth/signup" class="btn btn-default">signup</a></li>
            </ul>  
            <?php }else{ ?>
              <!--<ul class="nav navbar-nav navbar-right cus-right-nav">
                 <li><a href="<?=BASE_URL?>auth/logout" class="btn btn-default">logout</a></li>
              </ul> -->
              <?php  /*if($this->session->userdata('user_type')=="2"){
            $this->_buyerinfo();
        }else{
            $this->_sellerinfo();
        }*/?>
              <ul class="nav navbar-nav navbar-right cus-right-nav"> 
                  <?php if(($this->session->userdata('user_type')!="1")){?>
                  <li class="cartli">
                    <a href="<?php echo BASE_URL."products/viewcart"?>">
                        <div class="cart" style="<?php echo $btn_theme_style;?>">
                                <span class="glyphicon glyphicon-shopping-cart cus_shopping_cart"></span> 
                                Cart (<?php echo count($this->cart->contents()); ?>) 
                                 <?php //echo "item's".($this->cart->total_items());?>
                        </div>
                    </a>
                  </li>
                  <?php }?>
                  <?php if((!$user_edit_panel)){?>
                   <li class="btn-group  cus-right-nav1">   
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                       <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$this->session->userdata('user_image')?>" height="30" width="30" class="img-circle"> <span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="<?=BASE_URL?>profile">My Profile</a></li> 
                            <!--<li><a href="<?=BASE_URL?>mail">Inbox (<?php //echo $this->commondata['inbox']?>) </a></li>-->
                           <?php if((!$user_edit_panel)&&($storounerlogine)){ ?>
                           <li><a href="<?=BASE_URL?>usereditpenal">Customize design store</a></li>
                               <?php } ?>
                           <li><a href="<?=BASE_URL?>auth/logout">Logout</a></li>
                        </ul>
                    </li>
                  <?php }?>
              </ul>
            <?php } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>    
 <?php /*
 if(!$user_edit_panel){
 ?> 
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pull-right">
<!--            <div class="col-sm-2 pull-left">
            <img class="img-circle" src="<?php //echo  BASE_URL;?>edit_assets/image/aa.png" style="width: 30%" >
        </div>-->

        <div class="col-sm-2 pull-right text-center">
            <a href="<?php echo BASE_URL?>">
                <div class="cart" style="<?php echo $btn_theme_style;?>">
                <span class="glyphicon glyphicon-e"></span> 
                Go back
                <span class="glyphicon glyphicon-home"></span>
                </div>
            </a>
        </div>
        <div class="col-sm-2 pull-right text-center">
            <a href="<?php echo BASE_URL."products/viewcart"?>">
                <div class="cart" style="<?php echo $btn_theme_style;?>">
                        <span class="glyphicon glyphicon-shopping-cart cus_shopping_cart"></span> 
                        Cart (<?php echo count($this->cart->contents()); ?>) 
                         <?php //echo "item's".($this->cart->total_items());?>
                </div>
            </a>
        </div>
    <?php //print_r($this->cart->contents());?>
    </div>    
    <?php
 }*/
    ?>
        <div class="<?php echo 'menu'.$class_arr['menu'];?>" >
               <?php //include base_url().'edit_assets/menu.php';onclick="menu_position()"?>                   
               <?php //$theme_id="1001";
               $theme_id=$user_theam_id;
            if(($theme_id=="1001")||($theme_id=="1003"))
            {?>
            <script src="<?php echo BASE_URL."edit_assets/cssmenu_3/script.js"?>"></script>
           <!-- <script src="<?php echo BASE_URL."edit_assets/cssmenu_1/query-latest.min.js"?>"></script>-->
            <link href="<?php echo BASE_URL."edit_assets/cssmenu_3/styles.css"?>" rel="stylesheet" type="text/css" />
            <?php
            }
            else if(($theme_id=="1002")||($theme_id=="1004"))
                {?>
            <script src="<?php echo BASE_URL."edit_assets/cssmenu_2/script.js";?>"></script>
            <!--<script src="<?php echo BASE_URL."edit_assets/cssmenu_2/query-latest.min.js"?>"></script>-->
            <link href="<?php echo BASE_URL."edit_assets/cssmenu_2/styles.css";?>" rel="stylesheet" type="text/css" />
            <?php
            }
            ?>
            <div  id='cssmenu' ondblclick="load_popup('#view_prod','#menu_pop')">
              <?php   echo $menu;  ?>
            </div> 
        </div>
    <?php /*?>
      <div class="row<?php //echo $class_arr['contener'];?>"> 
          
          <div class="<?php echo $class_arr['header'];?>" style="margin-bottom: 50px;z-index: 1;">
               
               <div class="<?php echo $class_arr['logo'];?>" >
                   <img class="img-circle" src="<?php echo  BASE_URL;?>edit_assets/image/aa.png" style="width: 12%" >                   
               </div>
               <div class="col-lg-6">
                   <div id='loadingmessage' style='display:none;  '>
                    <img src='<?php echo  BASE_URL;?>edit_assets/image/process.gif'/>
                  </div>
               </div>
               <div class="<?php echo $class_arr['login_logout'].' right';?>">
               </div>
            </div>          
      </div>
    <?php */
if(!$user_edit_panel)
    {
        function mouceiconeonhover($contentid)
        {
        return '';    
        }
        function mouceiconeonclick($contentid)
        {
            return '';        
        }
        function mouceiconeonmove_or_click($contentid)
        {
            return '';        
        }
?>
<script>
function load_popup(a,c){}
</script>
<?php     
    }
    else
    {    
        function mouceiconeonhover($contentid)
        {
            return "<style>$contentid:hover{cursor: url(".BASE_URL."assets/image/move.png), auto;}</style>";     
        }

        function mouceiconeonclick($contentid)
        {
            return "<style>$contentid:hover{cursor: url(".BASE_URL."assets/image/click.png), auto;}</style>";     
        }
        
        function mouceiconeonmove_or_click($contentid)
        {
            return "<style>$contentid:hover{cursor: url(".BASE_URL."assets/image/move_or_click.png), auto;}</style>";     
        }

    }?>


<?php //for menu 
echo mouceiconeonclick('#cssmenu');
// for dynamic text
echo mouceiconeonclick('.transbox');
//for dynamic botton
echo mouceiconeonclick('.parentElement');
//for dynamic image
echo mouceiconeonclick('.div_image');
// user site logo on this page 
echo mouceiconeonclick('#userlogo');
?>