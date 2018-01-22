<style> 
    .search_form_display{ display: none !important; }
    .hd_bld{font-weight: bold;}
</style>
<section class="content-header">
    <h1>
     Manage Transaction
     <small></small>
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
              <!--<h3 class="box-title"></h3>-->   
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                
              <table class="table table-bordered">
                  <?php  $transactions=$transdetails['rows'][0]; ?>
                <tbody>   
                    <tr>
                        <td colspan="2"><p class="text-center"><strong>Transaction Information</strong></p></td>
                    </tr>
                    
                    <tr>
                        <th>Transaction Id</th>
                        <td><?=$transactions->trans_id?></td>
                    </tr>
                    
                    <tr>
                        <th>Amount</th>
                        <td>$<?=$transactions->price?></td>
                    </tr>
                    
                    <tr>
                        <th>Date</th>
                        <td><?=$transactions->date?></td>
                    </tr>
                      
                    
                    <?php if($transactions->payment_for=='campeign'){  $campaigndetails=$campaign['rows'][0]; ?>
                    
                    <tr>
                        <td colspan="2"><p class="text-center"><strong>Campaign Information</strong></p></td>
                    </tr>
                    
                    <tr>
                        <th>Title</th>
                        <td><a href="<?=BASE_URL?>admin/campaign/campaign_details/<?=$campaigndetails->campaignid?>"><?=$campaigndetails->campaign_titel?></a></td>
                    </tr>
                    
                    <?php if($campaigndetails->supporterid){ ?>
                    <tr>
                        <th>Name</th>
                        <td><?=$campaigndetails->f_name.' '.$campaigndetails->l_name?></td>
                    </tr>
                    
                    <tr>
                        <th>Email</th>
                        <td><?=$campaigndetails->email_id?></td>
                    </tr>
                   
                    <tr>
                        <th>Mobile</th>
                        <td><?=$campaigndetails->mobile_no?></td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                        <th>Name</th>
                        <td><?=$campaigndetails->name?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php }else if($transactions->payment_for=='user'){   $campaigndetails=$campaign['rows'][0];  ?>
                        <tr>
                            <td colspan="2"><p class="text-center"><strong>Seller Information</strong></p></td>
                        </tr>
                        
                        <tr>
                            <th>Name</th>
                            <td><?=$campaigndetails->f_name.' '.$campaigndetails->l_name?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?=$campaigndetails->email_id?></td>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <td><?=$campaigndetails->mobile_no?></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" align='right'><a href="<?=BASE_URL?>admin/users/details/<?=$campaigndetails->sellerid?>" class="btn btn-primary btn-sm">More Info</a></td>
                        </tr>
                        
                  
                        
                    <?php }else if($transactions->payment_for=='ads'){
                        $campaigndetails=$campaign['rows'][0];  
                       // echo $campaigndetails->exp_date;
                       // echo $campaigndetails->ads_date;
                        $sdate=  strtotime($campaigndetails->ads_date);
                        $edate=strtotime($campaigndetails->exp_date);
                        //echo $sdate;
                        $duration=round((abs($edate-$sdate))/86400);
                        
                        
                    ?>
                        <tr>
                            <td colspan="2"><p class="text-center"><strong>Seller Information</strong></p></td>
                        </tr>
                        
                        <tr>
                            <th>Name</th>
                            <td><?=$campaigndetails->f_name.' '.$campaigndetails->l_name?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?=$campaigndetails->email_id?></td>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <td><?=$campaigndetails->mobile_no?></td>
                        </tr>
                        <tr>
                            <th>Ads Duration</th>
                            <td><?=$duration." "."Days"?></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" align='right'><a href="<?=BASE_URL?>admin/users/details/<?=$campaigndetails->sellerid?>" class="btn btn-primary btn-sm">More Info</a></td>
                        </tr>
                        
                    <?php } ?>
                </tbody>
                    
              </table> 
              
            </div>
            
            
            <?php if($taxdetails['res']){ ?>   
                        <h3>Price Details</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered cus-table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="hd_bld">Seller</td>
                                        <td class="hd_bld">Product price</td>
                                       <!-- <td>Tax</td>-->
                                        <td class="hd_bld">Admin commission</td>
                                        
                                        <td class="hd_bld">Total price</td>
                                        <td class="hd_bld">Total</td>
                                        
                                        
                                        
                                    </tr>
                                    <?php foreach($taxdetails['rows'] as $taxdetail){ ?>
                                    <tr>
                                        <td><?php echo $taxdetail->f_name.' '.$taxdetail->l_name;?></td>
                                        <td>$<?php echo $taxdetail->total;?></td>
                                        <!--<td>$<?php //echo (($taxdetail->total*$taxdetail->tax)/100);?> &nbsp;&nbsp; (<?php //echo $taxdetail->tax;?>) %</td>-->
                                        
                                        <td>$<?php echo $taxdetail->commission;?></td>
                                        
                                        <td>$<?php echo ($taxdetail->total-$taxdetail->commission)+(($taxdetail->total*$taxdetail->tax)/100);?></td>
                                        
                                        <td>$<?php echo (($taxdetail->total*$taxdetail->tax)/100)+$taxdetail->total;?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>    
                     <?php } ?> 
                        
                        
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>