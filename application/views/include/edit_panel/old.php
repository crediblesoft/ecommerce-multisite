<script src="<?php echo BASE_URL ?>edit_assets/js/My.js"></script>
    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs" role="tablist">
          <?php 
          $con=0;
       
          foreach ($get_menu as $get_menu_data)
        {//id , user_id , label , link
             $name=$get_menu_data['sub_id']."_topmenu";
              ?>
        <li role="presentation" <?php if($con==0){echo ' class="active" ';}else{echo 'class="next"';}?>  id="<?php echo $get_menu_data['sub_id'];?>" <?php if($get_menu_data['user_created']==1){ ?> onclick="change_array_value(<?php echo $get_menu_data['sub_id'];?>)" <?php } ?>  >
          <a href="<?php echo '#'.$name;?>" id="<?php echo $name;?>-tab" role="tab" data-toggle="tab" aria-controls="<?php echo $name;?>" <?php if($con==0){echo ' aria-expanded="true" ';}?> >
            <span class="text">Edit <?php echo $get_menu_data['label'];?>
            
            </span>            
          </a>
        </li>
        <?php  
               $con++;         
        }
        ?>
        
        <ul class="nav navbar-nav navbar-right">                
                <li><a href="#">Save</a></li>
                <li><a href="#">Back To Site</a></li>
                <li><a href="#">Login</a></li>
            </ul>
    </ul>    
        
    </div>
