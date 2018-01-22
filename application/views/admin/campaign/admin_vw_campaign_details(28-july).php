<?php  //$product=$products['rows'][0]; ?>
<section class="content-header">
    <h1>
     Campaign
     <small>details</small>
    </h1>
<!--<ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
    </ol>-->
</section>
<?php //print_r($campaigns['rows'][0]->video_link);?>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <!-- box-header IMAGE -->  
            <div class="box-header with-border">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <div class="campaign-img-div">
                        <img src="<?=BASE_URL?>/assets/image/campaign/thumb/<?=$campaigns['rows'][0]->image_path;?>" class="img img-responsive cam-vw-detail-img">
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <?php if($campaigns['rows'][0]->video_link!=''){ 
                            $str = explode("?",$campaigns['rows'][0]->video_link);
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
                                $url=$campaigns['rows'][0]->video_link;
                                $status++;
                            }
                            ?>
                        <div class="row">
                            <?php if($status > 0){ ?>
                                         <p height="150">This video does not add properly</p>
                                     <?php }else{ ?>
                                    <object width="350" height="350">
                                        <param name="movie" value="<?=$url?>" />
                                        <embed src="<?=$url?>" type="application/x-shockwave-flash" style="height:166px;width:272px;" />
                                    </object>
                                     <?php } ?>     
                        </div>
                        <?php } ?>
                    </div>
                    
                </div>    
            </div>
            <!-- // box-header IMAGE-->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr> 
                        <th>User Name</th>
                        <td><a href="<?=BASE_URL?>admin/users/details/<?=$campaigns['rows'][0]->user_id;?>" target="_blank" ><?=$campaigns['rows'][0]->username;?></a></td>
                    </tr>
                    <tr> 
                        <th>Title</th>
                        <td><?=$campaigns['rows'][0]->campaign_titel;?></td>
                    </tr>
                    <tr> 
                        <th>Details</th>
                        <td><?=$campaigns['rows'][0]->campaign_detail;?></td>
                    </tr>
                    <tr> 
                        <th>Price</th>
                        <td>$<?=$campaigns['rows'][0]->price;?></td>
                    </tr>
                    <tr> 
                        <th>Start Date</th>
                        <td><?=$campaigns['rows'][0]->start_date;?></td>
                    </tr>
                    <tr> 
                        <th>End  Date</th>
                        <td><?=$campaigns['rows'][0]->end_date;?></td>
                    </tr>
                    
                    <tr> 
                        <th>User Status</th>
                        <td><?php if($campaigns['rows'][0]->show_stetus==1){echo "Active";}else{echo "In-Active";}?></td>
                    </tr>
                    <tr> 
                        <th>Admin Status</th>
                        <td><?php if($campaigns['rows'][0]->stetus==1){echo "Active";}else{echo "In-Active";}?></td>
                    </tr>
                     <?php 
                       //print_r($peymentdetail); exit;
                        if($peymentdetail['res']){
                            $totalamt=0; $totatcomm=0;
                            $peymentdetailrows1 = $peymentdetail['rows'];
                            foreach ($peymentdetailrows1 as $peymentdetail1){
                                //echo "<pre>"; print_r($peymentdetailrows); exit;
                                $totalamt+=$peymentdetail1->price;
                                $totatcomm+=$peymentdetail1->commission;
                        } 
                        ?>
                    <tr>
                        <th>Gross Amount Raise</th>
                        <th>Commission Amount</th>
                        <th>Pay out Amount</th>
                    </tr>
                    <tr>
                        <td>$<?php echo $totalamt; ?></td>
                        <td>$<?php echo $totatcomm; ?></td>
                        <td>$<?php echo $totalamt-$totatcomm; ?></td>
                    </tr>
                    <?php }else{?>
                        <tr>
                            <td colspan="3"><p class="text-danger">Currently no any Campaign.</p></td>
                        </tr>
                        <?php } ?>
                        
                    <tr class="campaign-donate-detail"> 
						<th class="text-center" width="30%">Transaction Id</th>
                        <th class="text-center" width="40%">Paid Donors</th>
                        <th class="text-center" width="30%">Paid Amount</th>
						<th class="text-center" width="30%">Paid Date</th>
                    </tr>
                       <?php 
                       //print_r($peymentdetail); exit;
                        if($peymentdetail['res']){
                            //$totalamt=0; $totatcomm=0;
                            $peymentdetailrows = $peymentdetail['rows'];
                            foreach ($peymentdetailrows as $peymentdetail){
                                //echo "<pre>"; print_r($peymentdetailrows); exit;
                                //$totalamt+=$peymentdetail->price;
                                //$totatcomm+=$peymentdetail->commission;
                              
                        ?>
                    <tr> 
                     
                   
                        <tr>
                            <td align="center"><?php echo $peymentdetail->trans_id; ?></td>
                            <td align="center"><?php echo $peymentdetail->name; ?></td>
                            <td align="center">$<?php echo  $peymentdetail->price; ?></td>
                            <td align="center"><?php echo $peymentdetail->date; ?></td>
                        </tr>
                        <?php } ?>
                        
                         
                           <?php }else{?>
                        <tr>
                            <td colspan="3"><p class="text-danger">Currently no any donation.</p></td>
                        </tr>
                        <?php } ?>
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


