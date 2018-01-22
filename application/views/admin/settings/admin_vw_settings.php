<?php  $settings=$settings['rows'][0]; $userlimitations=$userlimitation['rows'][0]; $forpremimu=$forpremimu['rows'][0]; ?>

<section class="content-header">
    <h1>
     Manage Settings
     <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <div class="pull-right">
                    <a href="<?=BASE_URL?>admin/settings/edit" class="btn btn-primary btn-sm" id=""><span class="glyphicon glyphicon-pencil"></span> Edit Settings</a>     
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr> 
                        <th width="30%">Default Image</th>
                        <td><img src="<?=BASE_URL?>assets/image/user/thumb/<?=$settings->default_image?>" class="img img-responsive"></td>
                    </tr>
                    <tr> 
                        <th>Default Category</th>
                        <td><?=$settings->default_category?></td>
                    </tr>
                    <tr> 
                        <th>Forum Post</th>
                        <td><?php if($settings->forum_post==1){echo "Active";}else{echo "In-active";} ?></td>
                    </tr>
                    <tr> 
                        <th>User Status</th>
                        <td><?php if($settings->user_status==1){echo "Active";}else{echo "In-active";} ?></td>
                    </tr>
                    <tr> 
                        <th>Product Status</th>
                        <td><?php if($settings->product_status==1){echo "Active";}else{echo "In-active";} ?></td>
                    </tr>
                    <tr> 
                        <th>Admin Commission</th>
                        <td><?php echo $settings->commission;?> %</td>
                    </tr>
                    
                    <tr> 
                        <th colspan="2"><p class="text-center">Free User Limitations</p></th>
                    </tr>
                    
                    <tr> 
                        <th>Product listing</th>
                        <td><?=$userlimitations->product_list?></td>
                    </tr>
                    <tr> 
                        <th>Send Email</th>
                        <td><?=$userlimitations->email?></td>
                    </tr>
                    <tr> 
                        <th>Send Message</th>
                        <td><?=$userlimitations->message?></td>
                    </tr>
                    <tr> 
                        <th>Media/Video upload</th>
                        <td><?=$userlimitations->media?></td>
                    </tr>
                    
                    <tr> 
                        <th colspan="2"><p class="text-center">For Premium User </p></th>
                    </tr>
                    
                    <tr> 
                        <th>Paid Amount</th>
                        <td>$<?=$forpremimu->price?></td>
                    </tr>
                    
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


