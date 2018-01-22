<?php  $product=$recipe['rows'][0]; ?>

<section class="content-header">
    <h1>
     Manage Recipes
     <small>details</small>
    </h1>
<!--<ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
    </ol>-->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <div class="col-md-3 col-lg-3 col-sm-3">
				
				<?php
						if(substr_count($product->image_path,'http') > 0 ) $reciepe_image=$product->image_path; 
						else $reciepe_image=BASE_URL.'assets/image/recipe/thumb/'.$product->image_path;
				?>
				
                <img src="<?php echo $reciepe_image; ?>" class="img img-responsive">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3">
                    <div class="col-md-12 col-lg-12 col-sm-12"><a href="<?=BASE_URL?>admin/users/details/<?=$product->userid?>" target="_blank" class="vw_username"><?=$product->username?></a></div>
                </div> 
                
                <div class="col-md-3 col-md-3 col-lg-3 col-xs-12">
                     <?php if($product->video_link!=''){ 
                        $str = explode("?",$product->video_link);
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
                            $url=$product->video_link;
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
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr> 
                        <th width="30%">Category</th>
                        <td><?=$product->category?></td>
                    </tr>
                    <tr> 
                        <th>Title</th>
                        <td><?=$product->recipe_title?></td>
                    </tr>
                    <tr> 
                        <th>Add date</th>
                        <td><?=$product->recipe_addDate?></td>
                    </tr>
                    <tr> 
                        <th>Details</th>
                        <td><?=$product->recipe_detail?></td>
                    </tr>
                    <?php if($product->userid!=0){?>
                    <tr> 
                        <th>User status</th>
                        <td><?php if($product->recipe_stetus==1){echo "Active";}else{echo "In-active";} ?></td>
                    </tr>
                    <?php }?>
                    <tr> 
                        <th>Admin status</th>
                        <td><?php if($product->admin_status==1){echo "Active";}else{echo "In-active";} ?></td>
                    </tr>
            <?php if ($product->type_Of_User == 1) { ?>
                    <tr> 
                        <th>Business Name</th>
                        <td><?php echo $product->business_name;?></td>
                    </tr>
            <?php }?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>