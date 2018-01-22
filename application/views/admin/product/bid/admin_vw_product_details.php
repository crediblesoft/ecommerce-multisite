<?php  $product=$products['rows'][0]; ?>

<section class="content-header">
    <h1>
     Manage Product
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
                <div class="col-md-2 col-lg-2 col-sm-2">
                <img src="<?=BASE_URL?>assets/image/product/thumb/<?=$product->prod_img?>" class="img img-responsive">
                
                </div>
                <div class="col-md-9 col-lg-9 col-sm-9">
                    <?php if($product->type_Of_User==1){ ?>
                    <div class="col-md-12 col-lg-12 col-sm-12"><a href="<?=BASE_URL?>admin/users/details/<?=$product->userid?>" target="_blank" ><p class="vw_username"><?=$product->username?></p></a></div>
                    <?php } ?>
                </div>    
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr> 
                        <th>Category</th>
                        <td><?=$product->category?></td>
                    </tr>
                    <tr> 
                        <th>Sub Category</th>
                        <td><?=$product->sub_category?></td>
                    </tr>
                    <tr> 
                        <th>Product</th>
                        <td><?=$product->prod_name?></td>
                    </tr>
                    <tr> 
                        <th>Price</th>
                        <td>$<?=$product->prod_price?></td>
                    </tr>
                    <tr> 
                        <th>Details</th>
                        <td><?=$product->pord_detail?></td>
                    </tr>
                    <tr> 
                        <th>Start Date</th>
                        <td><?php echo $product->bid_start_date; ?></td>
                    </tr>
                    <tr> 
                        <th>End Date</th>
                        <td><?php echo $product->bid_end_date; ?></td>
                    </tr>
                    <tr> 
                        <th>Purchase Date</th>
                        <td><?php echo $product->bid_purchase_date; ?></td>
                    </tr>
                    <tr> 
                        <th>Weight</th>
                        <td><?php echo $product->weight." lb"; ?></td>
                    </tr>
                    <tr> 
                        <th>Dimension(L*W*H)</th>
                        <td><?php echo $product->length."*".$product->width."*".$product->height." inches"; ?></td>
                    </tr>
                    <tr> 
                        <th>Local Shipping</th>
                        <td><?php echo $product->local_shipping; ?></td>
                    </tr>
                    <tr> 
                        <th>Available Quantity</th>
                        <td><?php echo $product->status;?></td>
                    </tr>
                    <tr> 
                        <th>Taxable Status</th>
                        <td><?php echo $product->taxable_status > 0 ? 'Yes': 'No'; ?></td>
                    </tr>
                    
                    <tr> 
                        <th>Seller status</th>
                        <td><?php if($product->status==1){echo "Active";}else{echo "In-active";} ?></td>
                    </tr>
                    
                    <tr> 
                        <th>Admin status</th>
                        <td><?php if($product->admin_status==1){echo "Active";}else{echo "In-active";} ?></td>
                    </tr>
                    
                    <?php /*if($product->type_Of_User==1){ ?>
                    <tr> 
                        <th colspan="2"><p class="text-center">User Business Info</p></th>
                    </tr>
                    
                    <?php 
                        if($storedata['res']){
                        $businessinfo=$storedata['rows'][0];
                        if($businessinfo->certification==1){
                            $certification="Yes";
                        }else{
                            $certification="No";
                        }
                        
                        if($businessinfo->size==1){
                            $size="Small";
                        }else if($businessinfo->size==2){
                            $size="Medium";
                        }else if($businessinfo->size==3){
                            $size="Large";
                        }else{
                            $size='';
                        }
                    ?>
                    <tr> 
                        <th>Business Name</th>
                        <td><?=$businessinfo->business_name?></td>
                    </tr>
                    <tr> 
                        <th>Contact Person Name</th>
                        <td><?=$businessinfo->contact_person_name?></td>
                    </tr>
                    <tr> 
                        <th>Phone</th>
                        <td><?=$businessinfo->phone?></td>
                    </tr>
                    <tr> 
                        <th>Address</th>
                        <td><?=$businessinfo->address?></td>
                    </tr>
                    <tr> 
                        <th>Zip code</th>
                        <td><?=$businessinfo->zip?></td>
                    </tr>
                    <tr> 
                        <th>Certification</th>
                        <td><?=$certification?></td>
                    </tr>
                    <tr> 
                        <th>Size</th>
                        <td><?=$size?></td>
                    </tr>
                    <tr> 
                        <th>Income</th>
                        <td><?=$businessinfo->income?></td>
                    </tr>
                        <?php }else{ ?>
                    <tr> 
                        <td colspan="2"><p class="text-danger">Store not created yet.</p></td>
                    </tr>
                        <?php } ?>
                    
                    <?php }*/ ?>
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


