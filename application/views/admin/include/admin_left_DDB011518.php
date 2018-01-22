<?php  $current_url=  current_url();  $page=explode('/',$current_url); ?>
<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if(in_array('dashboard',$page)){ ?> active <?php } ?> treeview">
              <a href="<?=BASE_URL?>admin/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa  pull-right"></i>
              </a>
              <!--<ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>-->
            </li>

        <?php
        $ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');

        if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Category')=='Manage Category'){?>
            <li class="<?php if(in_array('category',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/category">
                    <i class="fa fa-table"></i> <span>Manage Category</span>
                </a>
            </li>
        <?php }?>

        <?php
        $ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');

        if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Sub Category')=='Manage Sub Category'){?>
            <!-- Added by DDB to support New Sub Category -->            
            <li class="<?php if(in_array('subcategories',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/subcategories">
                    <i class="fa fa-table"></i> <span>Manage Sub Category</span>
                </a>
            </li>
        <?php }?>

	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Business Types')=='Manage Business Types'){?>
            <!-- Added by DDB to support New Business Type -->            
            <li class="<?php if(in_array('businesstypes',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/businesstypes">
                    <i class="fa fa-table"></i> <span>Manage Business Types</span>
                </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Users')=='Manage Users'){?>
            <li class="<?php if(in_array('seller',$page) || in_array('buyer',$page) || in_array('users',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/seller">
                <i class="fa fa-table"></i> <span>Manage Users</span>
                <!--<i class="fa fa-angle-left pull-right"></i>-->
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Product')=='Manage Product'){?>
            <li class="<?php if(in_array('product',$page) || in_array('bidproduct',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/product">
                <i class="fa fa-table"></i> <span>Manage Product</span>
                <!--<i class="fa fa-angle-left pull-right"></i>-->
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Order')=='Manage Order'){?>
            <li class="<?php if(in_array('order',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/order">
                <i class="fa fa-table"></i> <span>Manage Order</span>
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Forum Section')=='Manage Forum Section'){?>
            <li class="<?php if(in_array('forum',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/forum">
                <i class="fa fa-table"></i> <span>Manage Forum Section</span>
                <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
	      <?php 
	      $ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
	      if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Forum Category')=='Manage Forum Category'){?>
                <li><a href="<?=BASE_URL?>admin/forum"><i class="fa fa-circle-o"></i>Manage Forum Category</a></li>
              <?php }?>
	      <?php 
	      $ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
	      if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Forum')=='Manage Forum'){?>
                <li><a href="<?=BASE_URL?>admin/forum/topic"><i class="fa fa-circle-o"></i>Manage Forum</a></li>
              <?php }?>
              </ul>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Social')=='Manage Social'){?>
            <li class="<?php if(in_array('social',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/social">
                <i class="fa fa-table"></i> <span>Manage Social</span>
                </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Recipe Category')=='Manage Recipe Category'){?>
			<li class="<?php if(in_array('recipecat',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/recipecat">
                <i class="fa fa-table"></i> <span>Manage Recipe Category</span>
                </a>
            </li>
        <?php }?>
			
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Recipes')=='Manage Recipes'){?>
            <li class="<?php if(in_array('recipes',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/recipes">
                <i class="fa fa-table"></i> <span>Manage Recipes</span>
                </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Pages')=='Manage Pages'){?>
            <li class="<?php if(in_array('pages',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/pages">
                <i class="fa fa-table"></i> <span>Manage Pages</span>
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Transaction')=='Manage Transaction'){?>
            <li class="<?php if(in_array('transaction',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/transaction">
                <i class="fa fa-table"></i> <span>Manage Transaction</span>
              </a>
            </li>
        <?php }?>

	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Accounting')=='Manage Accounting'){?>
 	    <li class="<?php if(in_array('accounting',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/accounting">
                <i class="fa fa-table"></i> <span>Manage Accounting</span>
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Newsletter')=='Manage Newsletter'){?>
            
            <li class="<?php if(in_array('newsletter',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/newsletter">
                <i class="fa fa-table"></i> <span>Manage Newsletter</span>
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Campaign')=='Manage Campaign'){?>
            <li class="<?php if(in_array('campaign',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/campaign">
                <i class="fa fa-table"></i> <span>Manage Campaign</span>
                </a>
            </li>
        <?php }?>

	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Campaign Commission')=='Manage Campaign Commission'){?>
            <li class="<?php if(in_array('commission',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/commission">
                <i class="fa fa-table"></i> <span style="font-size: 13px;padding-left: 0;">Manage Campaign Commission</span>
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Events')=='Manage Events'){?>
            <li class="<?php if(in_array('events',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/events/eventlist">
                <i class="fa fa-table"></i> <span>Manage Events</span>
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Tax')=='Manage Tax'){?>
            <li class="<?php if(in_array('tax',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/tax">
                <i class="fa fa-table"></i> <span>Manage Tax</span>
              </a>
            </li>
        <?php }?>
            
	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Promotion Code')=='Manage Promotion Code'){?>
            <li class="<?php if(in_array('promotion',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/promotion">
                <i class="fa fa-table"></i> <span>Manage Promotion Code</span>
              </a>
            </li>
        <?php }?>

	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Finance Section')=='Manage Finance Section'){?>
            <li class="<?php if(in_array('finance',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/finance">
                <i class="fa fa-table"></i> <span>Manage Finance Section</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
                 <ul class="treeview-menu">
	      <?php 
	        $ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
	        if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Track Seller')=='Track Seller'){?>
                <li><a href="<?=BASE_URL?>admin/finance/track_seller"><i class="fa fa-circle-o"></i>Track Seller</a></li>
              <?php }?>
	      <?php 
	        $ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
	        if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Track Buyer')=='Track Buyer'){?>
                <li><a href="<?=BASE_URL?>admin/finance/track_buyer"><i class="fa fa-circle-o"></i>Track Buyer</a></li>
              <?php }?>
              </ul>
            </li>
        <?php }?>

	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Ads Create')=='Manage Ads Create'){?>
              <li class="<?php if(in_array('adscreate',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/adscreate">
                <i class="fa fa-table"></i> <span>Manage Ads Create</span>
              </a>
            </li> 
        <?php }?>

	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Ads Subscription')=='Manage Ads Subscription'){?>
            <li class="<?php if(in_array('adssubscription',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/adssubscription">
                <i class="fa fa-table"></i> <span>Manage Ads Subscription</span>
              </a>
            </li>
        <?php }?>

	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Manage Membership Period')=='Manage Membership Period'){?>
             <li class="<?php if(in_array('membership_period',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/membership_period">
                <i class="fa fa-table"></i> <span style="padding-left: 4px;">Manage Membership Period</span>
              </a>
            </li>
        <?php }?>

	<?php 
	$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
        
	if($ad_type=='1' || $this->session->userdata(ADMIN_SESS.'Change Password')=='Change Password'){?>
            <li class="<?php if(in_array('changepassword',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/profile/changepassword">
                <i class="fa fa-table"></i> <span>Change Password</span>
              </a>
            </li>
        <?php }?>
			
	<?php 
   	  $ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
 	 if($ad_type=='1'){?>

            <li class="<?php if(in_array('settings',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/settings">
                <i class="fa fa-table"></i> <span>Manage Settings</span>
              </a>
            </li>

			<li class="<?php if(in_array('subadmin',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/subadmin">
                <i class="fa fa-table"></i> <span>Manage Subadmin</span>
              </a>
            </li>

            <li class="<?php if(in_array('security',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/security">
                <i class="fa fa-table"></i> <span>Manage Screen Security</span>
                <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
                <li><a href="<?=BASE_URL?>admin/security/security_valid_screens"><i class="fa fa-circle-o"></i>Manage Valid Screens</a></li>
                <li><a href="<?=BASE_URL?>admin/security/security_roles"><i class="fa fa-circle-o"></i>Manage Security Roles</a></li>
                <li><a href="<?=BASE_URL?>admin/security/assign_screen_security"><i class="fa fa-circle-o"></i>Assign Screens to Roles</a></li>
              </ul>
            </li>
            <?php }?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

<!-- Content Wrapper. Contains page content this div end in adminfooter.php -->
      <div class="content-wrapper">
