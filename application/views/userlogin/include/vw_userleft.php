<?php  $current_url=  current_url(); 
       $page=explode('/',$current_url);
       $store_info=$this->session->userdata('store_info');
 ?>
<div class="row">
    <div class="col-sm-12 col-md-10 col-lg-10 col-xs-12 col-md-offset-1 col-lg-offset-1">
        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12">
            <div class="row">
                <nav class="navbar navbar-inverse sidebar" role="navigation">
                    <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#">Navigation</a>
                        </div>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li <?php if(in_array('profile',$page)){ ?> class="active" <?php } ?> >
                                        <a href="<?=BASE_URL?>profile"> 
                                            <i class="btn btn-default <?php if(in_array('profile',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i> 
                                            Manage Profile
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/user.png" />
                                            </span>
                                        </a>
                                    </li>
                                    
                                <?php if($this->session->userdata('user_type')=='1'){ ?>
                                    <li <?php if(in_array('markets',$page)){ ?> class="active" <?php } ?> >
                                        <a href="<?=BASE_URL?>markets"> 
                                            <i class="btn btn-default <?php if(in_array('markets',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i> 
                                            Find Farmer Markets
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/user.png" />
                                            </span>
                                        </a>
                                    </li>

                                    <li <?php if(in_array('product',$page)){ ?> class="active" <?php } ?>>
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>product" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('product',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Manage Product
                                            <span class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage-product.png" />
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('gallery',$page)){ ?> class="active" <?php } ?>>
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>gallery" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('gallery',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Manage Gallery
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage-gallery.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                <?php } ?>
                                    
                                    <li <?php if(in_array('order',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>order" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('order',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Manage Order
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage-order.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <!--<li <?php /*if(in_array('transaction',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>transaction" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('transaction',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php }*/ ?>"></i>
                                            Manage Transaction
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage-transaction.png"/>
                                            </span>
                                        </a>
                                    </li>-->
                                    
                                <?php if($this->session->userdata('user_type')=='1'){ ?>
                                    
                                    <li <?php if(in_array('designstore',$page)){ ?> class="active" <?php } ?>>
                                        <a target = '_blank' <?php if($store_info){ ?> href="<?php echo BASE_URL.$this->session->userdata('user_name')."/Shope/user_profile";?>" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('designstore',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i> 
                                            My Site
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/store.png"/>
                                            </span>
                                        </a>
                                    </li>

<li <?php if(in_array('demo',$page)){ ?> class="active" <?php } ?>>
                                        <a target = '_blank'  href="<?php echo BASE_URL."welcome/demo";?>" >
                                            <i class="btn btn-default <?php if(in_array('usereditpenal',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            View Instruction/Demo
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage-order.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('usereditpenal',$page)){ ?> class="active" <?php } ?>>
                                        <a target = '_blank' <?php if($store_info){ ?> href="<?php echo BASE_URL."usereditpenal";?>" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('usereditpenal',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Customize My Site
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/customize_design_store.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('campaign',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>campaign/userCampaignList" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('campaign',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Campaign
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/campaign.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    <li <?php if(in_array('adssubscription',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>adssubscription" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('adssubscription',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            For Ads Subscription<!--Payment For Theme--><span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/payment-for-theme.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    <li <?php if(in_array('paiduser',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>paiduser" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('paiduser',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            For Membership<!--Payment For Theme--><span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/payment-for-theme.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('trackre',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>trackre" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('trackre',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Track Revenues & Expenses
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/track-revenues-and-expenses.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('events',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>events/userEventsList" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('events',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Your Events
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/your-events.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('tax',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>tax" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('tax',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Manage Tax
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/your-events.png"/>
                                            </span>
                                        </a>
                                    </li>

                                <?php } ?>
                                    
                                <?php if($this->session->userdata('user_type')=='2'){ ?>
                                    
                                    <li <?php if(in_array('bid',$page)){ ?> class="active" <?php } ?>>
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>bid/product" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('bid',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Bid on products
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage-product.png"/>
                                            </span>
                                            </a>
                                    </li>
                                    
                                    <li <?php if((in_array('savesearches',$page) || in_array('searchdetails',$page)) && !in_array('bid',$page)){ ?> class="active" <?php } ?>>
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>product/savesearches" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if((in_array('savesearches',$page) || in_array('searchdetails',$page)) && !in_array('bid',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Saved Searches
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/saved-searches.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
<!--                                    <li <?php if(in_array('paiduser',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>paiduser" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('paiduser',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            For membership
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/payment-for-theme.png"/>
                                            </span>
                                        </a>
                                    </li>-->
                                    
                                <?php } ?>
                                    
                                    <li <?php if(in_array('requirement',$page)){ ?> class="active" <?php } ?>>
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>requirement" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('requirement',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                                <?php if($this->session->userdata('user_type')=='2'){ ?>
                                                    Shopping List
                                                <?php }else{ ?> 
                                                    Buyer Requirement
                                                <?php } ?>  
                                                <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                    <img src="<?=BASE_URL?>assets/image/left_icon/requirement.png"/>
                                                </span>
                                        </a>
                                    </li>

                                    <li <?php if(in_array('recipe',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>recipe/recipeuserlist" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('recipe',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Manage Recipes
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage-recipes.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('forum',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>forum" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('forum',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Manage Forum
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage_forum.png"/></span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('mail',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>mail" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('mail',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Mail ( <?=$this->commondata['inbox']?> )
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/mail.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li <?php if(in_array('message',$page)){ ?> class="active" <?php } ?> >
                                        <a <?php if($store_info){ ?> href="<?=BASE_URL?>message" <?php }else{ ?> href="<?=BASE_URL?>profile/infoblank"<?php } ?> >
                                            <i class="btn btn-default <?php if(in_array('message',$page)){ ?> btn-circle <?php }else{ ?> btn-circle1 <?php } ?>"></i>
                                            Message ( <?=$this->commondata['message']?> )
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity custom-glf">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/manage_forum.png"/>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Settings
                                            <span class="caret"></span>
                                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity">
                                                <img src="<?=BASE_URL?>assets/image/left_icon/settings.png"/>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu forAnimate" role="menu">
                                            <li><a href="<?=BASE_URL?>profile/changepassword">Change Password</a></li>
                                            <li><a href="<?=BASE_URL?>auth/logout">Logout</a></li>
                                        </ul>
                                    </li>   

                                </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
