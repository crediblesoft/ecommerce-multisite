<?php //print_r($products);
$userlist=$recipe['rows'][0];
//echo '<pre>';
//print_r($userlist);
?>
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <!--<div class="row">
            <p class="product_vw_head text-center">dfdf</p>
        </div>-->
         
        <div class="row margin-bottom_40">
        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 margin-bottom_25">
            <div class="row">
            <div class="panel panel-default">
                <div class="panel-body pro-detail-left-cus-panel-body text-center img-responsive">
                   
                   <?php
						if(substr_count($userlist->image_path,'http') > 0 ) $reciepe_image=$userlist->image_path; 
						else $reciepe_image=BASE_URL.'assets/image/recipe/thumb/'.$userlist->image_path;
						?>
						
                          <img src="<?php echo $reciepe_image; ?>" alt="" class="img img-responsive center-block">
                          
                   
                </div>
            </div>
            </div>    
            <?php if($userlist->video_link!=''){ 
                $str = explode("?",$userlist->video_link);
                $status=0;
                if(count($str) > 1){
                parse_str($str[1],$output);
                if(isset($output['v'])){
                    $url="http://www.youtube.com/v/".$output['v'];
                }else{ 
                    $url='';
                    $status++;
                }
                }else{
                    $url=$userlist->video_link;
                    $status++;
                }
                ?>
            <div class="row">
                <?php if($status > 0){ ?>
                             <p height="150">This video does not add properly</p>
                         <?php }else{ ?>
                        <object width="350" height="350">
                            <param name="movie" value="<?=$url?>" />
                            <embed src="<?=$url?>" type="application/x-shockwave-flash" style="height:200px;width:100%;" />
                        </object>
                         <?php } ?>     
            </div>
            <?php } ?>
        </div>
        
        
        <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
                       <div class="col-sm-12">
                           <p class="pro_detail_head clearfix">
                            <span class=" col-md-6"><?=$userlist->category?></span>
                           <span class="add-button col-md-6"><a class="btn btn-success pull-right" href="<?=BASE_URL?>recipe/add"> <span class="glyphicon glyphicon-plus-sign"></span> Add Recipe</a></span>
                            </p>
                            
                           <div class="line1 margin-bottom_15"></div>
                           <p class="pro_detail_content margin-bottom_15">
                               <?=$userlist->recipe_detail?>
                           </p>
                           
                           <div class="panel panel-default">
                            <div class="panel-body pro-detail-left-cus-panel-body">
                                <div class="row col-sm-12 col-lg-12 col-md-12 "> 
                                    <div class="row col-sm-4 col-md-4 col-lg-4 col-xs-12"> <strong>Title : </strong></div>
                                    <div class="col-sm-2 col-md-2 col-lg-8 col-xs-12 campaign_text">
                                        <?=$userlist->recipe_title?>
                                    </div>
                                </div>
                                
                                <div class="row col-sm-12 col-lg-12 col-md-12 "> 
                                    <div class="row col-sm-4 col-md-4 col-lg-4 col-xs-12"><strong> Add Date : </strong></div>
                                    <div class="col-sm-2 col-md-2 col-lg-8 col-xs-12 campaign_text">
                                        <?=$userlist->recipe_addDate?>
                                    </div>
                                </div>
                                
                                <div class="row col-sm-12 col-lg-12 col-md-12 "> 
                                    <div class="row col-sm-4 col-md-4 col-lg-4 col-xs-12"><strong> Username : </strong></div>
                                    <div class="col-sm-2 col-md-2 col-lg-8 col-xs-12 campaign_text">
									    <?php if($userlist->id==''){echo 'Posted by admin';} else{?>
                                        <?=$userlist->username?>
										<?php }?>
                                    </div>
                                </div>
                                <?php if($userlist->type_Of_User=='1'){ ?>
                                <div class="row col-sm-12 col-lg-12 col-md-12 "> 
                                    <div class="row col-sm-4 col-md-4 col-lg-4 col-xs-12"><strong> Business Name : </strong></div>
                                    <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12 campaign_text">
                                        <?=$userlist->business_name?>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <?php if($userlist->id==''){} else{?>
                                <div class="row col-sm-7 col-lg-7 col-md-7 pull-right">
                                    <div class="pull-right">
									
                                    <?php if($userlist->type_Of_User=='1'){ ?>
									
                                    <a <?php if($userlist->user_status==1){?>href="<?=BASE_URL?><?=$userlist->username?>/Shope/user_profile" <?php }else{?>href="#inactive_user" data-toggle="modal" data-target="#inactive_user" title="User not exist any more." <?php } ?> target="_blank" class="btn btn-warning"> View Shop </a>
                                    <?php } ?>  
                                    <a <?php if($userlist->user_status==1){?>href="<?=BASE_URL?>sellerprofile/<?=$userlist->username?>" <?php }else{?>href="#inactive_user" data-toggle="modal" data-target="#inactive_user" title="User not exist any more." <?php } ?> class="btn btn-primary"> View Profile </a>
                                    <a <?php if($userlist->user_status==1){?>href="<?=BASE_URL?>message/<?=$userlist->id?>" <?php }else{?>href="#inactive_user" data-toggle="modal" data-target="#inactive_user" title="User not exist any more." <?php } ?> class="btn btn-success chatwithonlineuser" id="chatwith_<?=$userlist->id?>"><?php if($userlist->useronline){echo "Chat with User Now";}else{echo"Send Message to User";} ?></a>
                                    </div>
                                </div> 
                                <?php }?>
                            </div>
                        </div>
                       </div>
        
    
           
  
               </div>
            
            
            
        </div> 
        <div class=" margin-bottom_20"></div>
        
        
    </div>
</div>  
<div id="inactive_user" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alert Message</h4>
      </div>
      <div class="modal-body">
          Sorry,this user's account is currently blocked by admin. 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>    
