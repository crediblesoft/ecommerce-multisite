<style>
    .popover-title{
        color: green;
        font-size: 20px;
    }
</style>
<script src="<?php echo BASE_URL ?>edit_assets/js/My.js"></script>
<script src="<?php echo BASE_URL ?>edit_assets/js/my_edit.js"></script>
<div class="bs-example bs-example-tabs navbar navbar-default " role="tabpanel" data-example-id="togglable-tabs">
    <button type="button" data-target="#myTab" data-toggle="collapse" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <ul id="myTab" class="nav nav-tabs collapse navbar-collapse" role="tablist">
        <?php 
        $con=0;        //print_r($get_menu);
        foreach ($get_menu as $get_menu_data)
        {//id , user_id , label , link
            $name=$get_menu_data['sub_id']."_topmenu";
            
                
            ?>                                                <?php //if($con==0){echo ' class="active" ';}else{echo 'class="next"';}?>
        <li  meinmenuid="<?php echo $get_menu_data['id']?>" <?php if($get_menu_data['stetus']=='1' ){  echo " style='display: none;' ";}else{if($con==0){echo ' class="active" ';}else{echo 'class="next"';}$con++;}?> role="presentation"  id="<?php echo $get_menu_data['sub_id'];?>" <?php if($get_menu_data['user_created']==1){ ?> onclick="user_dyanamicpage(<?php echo $get_menu_data['sub_id'];?>)" <?php }else{ ?> onclick="admin_page(<?php echo $get_menu_data['sub_id'];?>)"<?php }?> ><!--data-toggle="popover"-->
            <a href="<?php echo '#'.$name;?>" id="<?php echo $name;?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo $name;?>" <?php if($con==0){echo ' aria-expanded="true" ';}?> >
            <span class="text">Edit <?php echo $get_menu_data['label'];?>
            <?php 
            if($con==0)
                {  
                if($get_menu_data['user_created']==1)
                    {?>
                        <script type="text/javascript"> 
                        $(function(){               
                            //var post_pageid= <?php echo $get_menu_data['sub_id'];?>;
                            //var page_id="add_item_page_"+post_pageid;                    
                           user_dyanamicpage(<?php echo $get_menu_data['sub_id'];?>);                   
                        });</script>
            <?php   }
                    else
                        { ?>
                        <script type="text/javascript"> 
                        $(function(){               
                            //var post_pageid= <?php echo $get_menu_data['sub_id'];?>;
                            //var page_id="add_item_page_"+post_pageid;
                            /*using only for get side name for daynamic pages*/                    
                           // var datai="<a onclick='add_item_id1("+'"'+post_pageid+'"'+")'>click me </a>";
                            //$("#"+page_id).append($(datai));                    
                           admin_page(<?php echo $get_menu_data['sub_id'];?>);
                        });</script>
                    <?php  }                     
                }?>
            </span>
          </a>
        </li>
        <?php  
                       
        }
        ?>
        
        <ul class="nav navbar-nav navbar-right">                
            <li  id="SaveAddItemsli"  data-toggle="popover"  >
                <a id="SaveAddItems" href="#" onclick="save_eliment()"><?php //this function is BASE_URL.edit_assets/js/my_edit.js in this file ?>
                    Save Changes
                </a>
            </li>
<!--            <li id="gobackProfilePageli">
                <a id="gobackProfilePage" href="<?php echo BASE_URL."profile"?>">                
                <span class="glyphicon glyphicon-arrow-left cus_shopping_cart"></span> 
                       My Account 
                </a>
            </li>-->
<!--            <li id="gobackProfilePageli">
                <a id="gobackProfilePage" target="_blank" href="<?php echo BASE_URL.$this->session->userdata('user_name')."/Shope/user_profile";?>"> 
                       My Live Site 
                </a>
            </li>-->
            <li class="btn-group  cus-right-nav1">   
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                       <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$this->session->userdata('user_image')?>" height="30" width="30" class="img-circle"> <span class="caret"></span>
                    </button>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="<?=BASE_URL?>profile">My Account</a></li>
                           <li><a target="_blank" href="<?php echo BASE_URL;?>welcome/demo">View Demo</a></li>
                           <li><a target="_blank" href="<?php echo BASE_URL.$this->session->userdata('user_name')."/Shope/user_profile";?>">My Live Site</a></li>
                           <li><a href="<?=BASE_URL?>auth/logout">Logout</a></li>
                        </ul>
                    </li>
                <!--<li><a href="#">Save Whole page's</a></li>-->
        </ul>
    </ul> 
   <script type="text/javascript">
       /* $(function(){
           
            
        $("#myTab li").click(function(){  
     var post_pageid= $("#myTab li.active").attr('id');
    var page_id="add_item_page_"+post_pageid;
    
    var datai="<a onclick='add_item_id1("+'"'+page_id+'"'+")'>click me </a>";
    $("#"+page_id).append($(datai));
    });   
        });*/
    
      // start code stay on same tab
    /*$(function() { 
        // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // save the latest tab; use cookies if you like 'em better:
            localStorage.setItem('lastTab', $(this).attr('href'));            
        });
        
        $('li[role="presentation"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('liid', $(this).attr('id'));
        });
        // go to the latest tab, if it exists:
        var lastTab = localStorage.getItem('lastTab');
        var liid = localStorage.getItem('liid');
        var page_id="add_item_page_"+liid;                   
        user_dyanamicpage(page_id);
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }
    });*/
    // end code stay on same tab
         
    </script>
    </div>

<input type="button" class="btn btn-success" id="savetitleposition" onclick="savetitlepositionfinal();" style="position: absolute;top:400px;display: none;z-index: 999;" value="Save title postion">



<!-- Modal -->
<div id="viewdemo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Welcome To HarvestLinks Customize Site</h4>
      </div>
      <div class="modal-body">
          <p class="text-center">Click on view demo to view Steps for customize your site.</p>
          <p class="text-center">
              <a href="<?=BASE_URL?>welcome/demo" target="_blank" class="btn btn-primary" id="vdemoclose">View Demo</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </p>
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>
<!--<script> $('#viewdemo').modal('show'); </script> -->
<?php  if($load_demo){  ?>
    <script> $('#viewdemo').modal('show'); </script> 
<?php } ?>
    <script>
        $("#vdemoclose").click(function(){
             $('#viewdemo').modal('hide'); 
        });
    </script>