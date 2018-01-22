<?php //this page for only load all view page on one page , like(product view list detail, about us , countact us ) ?>
<div id="myTabContent" class="tab-content">
<?php $con=0;
  //$data=array();
  foreach ($get_menu as $get_menu_data2)
    {   //id , user_id , label , link
        $name=$get_menu_data2['sub_id']."_topmenu"; 
        //$data=array("daynamic_page_id"=>$get_menu_data2['sub_id']);
        //print_r($data);
        ?>
        <div role="tabpanel" class="tab-pane fade <?php if($get_menu_data2['stetus']=='1' ){  }else{if($con==0){echo " in active ";}else{}$con++;}?>" id="<?php echo $name;?>" aria-labelledby="<?php echo $name;?>-tab">            
        <?php $this->load->view($get_menu_data2['file_path']);?>         
        </div>
        <?php 
      
    }
    ?>
    </div>
<?php $this->load->view("../../edit_assets/side_menu/examples/side_menu.php");?>  
        <?php //include BASE_URL.'edit_assets/side_menu/examples/side_menu.php';?>    
