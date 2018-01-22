<style>
    .imagecenter
    {
        margin-top: 20px;
    }
    .price{text-transform: uppercase;}
    #peymentdetail{
        display: none;
        margin-top: 20px;
    }
</style><?php //print_r($campaigns); ?>
     

<div class="col-sm-9">

    <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>campaign"> Campaign</a> </h4><h5> > Add </h5>
                         <span class="add-button"><a class="btn btn-success" href="<?=BASE_URL?>campaign/userCampaignList"> <span class="glyphicon glyphicon-plus-sign"></span> View All Campaign</a></span>
                    </div>
                </div>
            </div>
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 ">
           
               <div class="" id="computers">
                   <?php if($campaigns['res']){ 
                                   foreach($campaigns['rows'] as $campaign){                                       
                                   ?>
                   <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 system" style="border: 1px solid #e5e5e5;" >
                       <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 imagecenter">
                           <a href="#" class="thumbnail">
                             <img src="<?=BASE_URL?>assets/image/campaign/thumb/<?=$campaign->image_path?>" alt="" class="img img-responsive">
                            </a>
                       </div>
                       <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
                           <h3 class="price"><?php echo $campaign->campaign_titel;?></h3>
                          <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
                              <div class="row">
                                  
                                  <!--
                                  <div class="col-sm-12 col-xs-12 price"><?=$campaign->campaign_titel?> </div>
                                  <div class="col-sm-12 col-xs-12 dis_price">$<?=$campaign->campaign_titel?></div>-->

                              <p><?php echo $campaign->campaign_detail;?></p>
                              <div class="col-sm-12 col-xs-12 "><?php echo "Campaign Start Date ".$campaign->start_date." End Date ".$campaign->end_date?><?php echo "    Campaign for  <b style='font-size: 16px; color:black;'>$".$campaign->price."</b>"?> </div>
                              </div>
                              <br/>
                              <br/>
                              <div class="col-lg-5 no-right-pad">
                                    <iframe src="https://player.vimeo.com/video/121283867"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></p>
                                </div>
                              <a onclick="showhide('peymentdetail')" class="btn btn-success btn-sm cus_btn_sm" role="button"> View Payment Detail</a> 
                              <br/>
                              <br/>
                          </div>
                       </div>
                       
                       <div class=" col-sm-12 table-responsive" id="peymentdetail" >
                           
                   <?php //print_r($peymentdetail);
                       if($peymentdetail['res']){ $peymentdetail=$peymentdetail['rows'][0];
                       ?>
                            <table class="table table-bordered cus-table-bordered">
                               <thead class="cus-thead">
                                    <tr>                                                                    
                                       <!-- <td>Image</td>
                                        <td>Price</td>                                    
                                        <td>Title</td>
                                        <td>Detail</td>
                                        <td>Status</td>--->
                                        <td>Paid Date</td>
                                        <td>Paid user Name</td>
                                        <td>paid Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       <!---<td><img src="<?php //echo BASE_URL."assets/image/campaign/".$campaign->image_path?>" height="100%" width="100%" class="img-responsive"></td>
                                        <td><?php //echo $campaign->price?></td>                                    
                                        <td>Title</td>
                                        <td>Detail</td>
                                        <td>Status</td>--->
                                        <td><?php echo $peymentdetail->date?></td>
                                        <td><?php echo 'no any use name'?></td>
                                        <td><?php echo $peymentdetail->price?></td>
                                    </tr>
                                </tbody>
                           </table>
                       <?php }else{?>
                   <div >
                       Sorry No Any Donation On this Campaign
                   </div>
                   <?php } ?>
                           
                       
                       </div>
                    </div>
                       <?php  } } ?>
               </div>
           



        </div>
 
</div> 


<script>
      
           function showhide(divid)
       {
           if($('#'+divid).css('display')=='block')
           {//alert('none');
               $('#'+divid).css('display','none');
           }
           else
           {//alert('block');
               $('#'+divid).css('display','block');
           }
       }     
</script> 

 </div>
</div>
