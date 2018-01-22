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
            
            <li class="<?php if(in_array('category',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/category">
                    <i class="fa fa-table"></i> <span>Manage Category</span>
                </a>
            </li>
            
            <li class="<?php if(in_array('seller',$page) || in_array('buyer',$page) || in_array('users',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/seller">
                <i class="fa fa-table"></i> <span>Manage Users</span>
                <!--<i class="fa fa-angle-left pull-right"></i>-->
              </a>
            </li>
            
            <li class="<?php if(in_array('product',$page) || in_array('bidproduct',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/product">
                <i class="fa fa-table"></i> <span>Manage Product</span>
                <!--<i class="fa fa-angle-left pull-right"></i>-->
              </a>
            </li>
            
            <li class="<?php if(in_array('order',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/order">
                <i class="fa fa-table"></i> <span>Manage Order</span>
              </a>
            </li>
            
            <li class="<?php if(in_array('forum',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/forum">
                <i class="fa fa-table"></i> <span>Manage Forum Section</span>
                <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
                <li><a href="<?=BASE_URL?>admin/forum"><i class="fa fa-circle-o"></i>Manage Forum Category</a></li>
                <li><a href="<?=BASE_URL?>admin/forum/topic"><i class="fa fa-circle-o"></i>Manage Forum</a></li>
              </ul>
            </li>
            
            <li class="<?php if(in_array('social',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/social">
                <i class="fa fa-table"></i> <span>Manage Social</span>
                </a>
            </li>
            
			<li class="<?php if(in_array('recipecat',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/recipecat">
                <i class="fa fa-table"></i> <span>Manage Recipe Category</span>
                </a>
            </li>
			
            <li class="<?php if(in_array('recipes',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/recipes">
                <i class="fa fa-table"></i> <span>Manage Recipes</span>
                </a>
            </li>
            
            <li class="<?php if(in_array('pages',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/pages">
                <i class="fa fa-table"></i> <span>Manage Pages</span>
              </a>
            </li>
            
            <li class="<?php if(in_array('transaction',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/transaction">
                <i class="fa fa-table"></i> <span>Manage Transaction</span>
              </a>
            </li>
            
            
            
            <li class="<?php if(in_array('newsletter',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/newsletter">
                <i class="fa fa-table"></i> <span>Manage Newsletter</span>
              </a>
            </li>
            
            
            <li class="<?php if(in_array('campaign',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/campaign">
                <i class="fa fa-table"></i> <span>Manage Campaign</span>
                </a>
            </li>
            <li class="<?php if(in_array('commission',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/commission">
                <i class="fa fa-table"></i> <span>Manage Campaign Commission</span>
              </a>
            </li>
            
            <li class="<?php if(in_array('events',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/events/eventlist">
                <i class="fa fa-table"></i> <span>Manage Events</span>
              </a>
            </li>
            
            <li class="<?php if(in_array('tax',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/tax">
                <i class="fa fa-table"></i> <span>Manage Tax</span>
              </a>
            </li>
            
            <li class="<?php if(in_array('promotion',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/promotion">
                <i class="fa fa-table"></i> <span>Manage Promotion Code</span>
              </a>
            </li>
            <li class="<?php if(in_array('finance',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/finance">
                <i class="fa fa-table"></i> <span>Manage Finance</span>
                <i class="fa fa-angle-right pull-right"></i>
              </a>
                 <ul class="treeview-menu">
                <li><a href="<?=BASE_URL?>admin/finance/track_seller"><i class="fa fa-circle-o"></i>Track Seller</a></li>
                <li><a href="<?=BASE_URL?>admin/finance/track_buyer"><i class="fa fa-circle-o"></i>Track Buyer</a></li>
              </ul>
            </li>
            <li class="<?php if(in_array('adssubscription',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/adssubscription">
                <i class="fa fa-table"></i> <span>Manage Ads Subscription</span>
              </a>
            </li>
            <li class="<?php if(in_array('changepassword',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/profile/changepassword">
                <i class="fa fa-table"></i> <span>Change Password</span>
              </a>
            </li>
            
            <li class="<?php if(in_array('settings',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/settings">
                <i class="fa fa-table"></i> <span>Manage Settings</span>
              </a>
            </li>
			
			<?php 
			$ad_type=$this->session->userdata(ADMIN_SESS.'admin_type');
			if($ad_type=='1'){?>
			<li class="<?php if(in_array('subadmin',$page)){ ?> active <?php } ?> treeview">
                <a href="<?=BASE_URL?>admin/subadmin">
                <i class="fa fa-table"></i> <span>Manage Subadmin</span>
              </a>
            </li>
            <?php }?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

<!-- Content Wrapper. Contains page content this div end in adminfooter.php -->
      <div class="content-wrapper">