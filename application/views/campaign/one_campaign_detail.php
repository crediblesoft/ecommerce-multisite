<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5614af2e7bc5b68b" async="async"></script>-->
<?php //print_r($products);
$campaign=$campaigns['rows'][0];
//print_r($yourdonation);
?>

<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <!--<div class="row">
            <p class="product_vw_head text-center">dfdf</p>
        </div>-->
         
        <div class="row margin-bottom_40">
          <?php if($campaigns['res']){ ?> 
            
        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 margin-bottom_25">
            <div class="row">
            <div class="panel panel-default">
                <div class="panel-body pro-detail-left-cus-panel-body text-center img-responsive">
                    <img src="<?=BASE_URL?>assets/image/campaign/<?=$campaign->image_path?>" class="img-responsive center-block">
                </div>
            </div>
            </div>
            <?php if($campaign->video_link!=''){ 
                $str = explode("?",$campaign->video_link);
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
                    $url=$campaign->video_link;
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
            
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>   
    <script type="text/javascript">
        $(document).ready(function(){
        $('#share_button').live('click', function(e){
        e.preventDefault();
        FB.ui(
        {
        method: 'feed',
        name: '<?php /*echo $campaign->campaign_titel; ?>',
        link: '<?php echo BASE_URL; ?>campaign/view/<?php echo $campaign->id; ?>',
        picture: '<?php echo BASE_URL; ?>assets/image/logo.png',
        caption: 'My donation : $ <?php echo $yourdonation; ?>',
        description: '<?php echo strip_tags($campaign->campaign_detail);*/ ?>',
        message: ''
        });
        });
        });
    </script>    -->
        
        <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
                       <div class="col-sm-12">
                           
                           <p class="pro_detail_head clearfix">
                            <span class="rowcol-md-6" style="overflow-wrap: break-word;"><?=$campaign->campaign_titel?></span>
                            <?php if($this->session->userdata("user_type")=='1'){ ?>
                           <span class="add-button col-md-6"><a class="btn btn-success pull-right" href="<?=BASE_URL?>campaign/addcampaign"> <span class="glyphicon glyphicon-plus-sign"></span> Add Campaign</a></span>
                           <?php } ?> 
                           </p>
                           
                            
<!--                           <div class="line1 margin-bottom_15"></div>-->
                           
                           <p class="campaign_detail_content margin-bottom_15">
                               <?=$campaign->campaign_detail?>
                           </p>
                           
                           <div class="panel panel-default">
                            <div class="panel-body pro-detail-left-cus-panel-body">
                                
                                <div class="col-sm-7 col-lg-7 col-md-7" >
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head">Campaign For</div>
                                    <div class="row col-sm-7 col-md-7 col-lg-7 col-xs-12 add_to_compare">
                                        $<?=$campaign->price?>
                                    </div>
                                </div>
                                
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> Add Date </div>
                                    <div class="row col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text">
                                        <?=$campaign->start_date?>
                                    </div>
                                </div>
                                <?php if($campaign->end_date!='0000-00-00'){ ?>
                                <div class="row col-sm-12 col-lg-12 col-md-12 campaign_detail_text_block"> 
                                    <div class="row col-sm-5 col-md-5 col-lg-5 col-xs-12 cam_text_head"> End Date </div>
                                    <div class="row col-sm-7 col-md-7 col-lg-7 col-xs-12 campaign_text">
                                        <?=$campaign->end_date?>
                                    </div>
                                </div>
                                <?php } ?>
                                </div>
                                <div class="col-sm-5 col-lg-5 col-md-5" style="padding-right: 0px;">
                                    <div class="" style="float: right;">  
                                <?php 
				  $list_url = BASE_URL.'campaign/view/'.$campaign->id;
				  $rurl = BASE_URL.'campaign/view/'.$campaign->id;
				  $img_paath = BASE_URL.'assets/image/fb_share_harvest_logo.png';
					if($yourdonation>0){
				  $summary=  ' I have donated: $'.$yourdonation.'. '.strip_tags(str_replace("'","",$campaign->campaign_detail));
                                    }else{
                                    $summary= strip_tags(str_replace("'","",$campaign->campaign_detail));
                                    }
									
				
				  $title=str_replace("'","",$campaign->campaign_titel);
				  $fb_app_id='1541384582852340';
				 // echo strlen($summary);exit;
				  $summary=substr($summary,0,150).'...';
				  
				  echo '<a target="_blank" class="fbshare" title="Share On Facebook" onclick="window.open(\'https://www.facebook.com/dialog/feed?curi=close&app_id='.$fb_app_id.'&display=popup&ref=share&picture='.$img_paath.'&name='.$title.'&description='.$summary.'&link='.$list_url.'&redirect_uri='.$rurl.'\',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');return false;" href="javascript: void(0)" ><img class="img img-responsive" id="fb-share" src = "'.BASE_URL.'assets/image/fbshare.png" alt="fbshare"></a>'; 
				?>
                                 <script> window.open('', '_self', ''); 
                                        <?php if(isset($_GET['post_id'])){ ?> window.close(); <?php } ?>
                                 </script>    
                                 
                                    <?php
                                        echo '<a target="_blank" style="float:right;" title="Share On Twitter" onclick="window.open(\'https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter\',\'_blank\', \'location=yes,width=700,height=400\');return false;" href="https://twitter.com/share?text='.$title.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter"><img class="img img-responsive" src = "'.BASE_URL.'assets/image/twittershare.png" alt="fbshare"></a>';
                                    ?>
               
                                    </div>
                                    
                                </div>
                            
                            <p class='row' style="height: 3px;margin-top:10px; background: #fff;clear: both;">&nbsp;</p>
                            <div class="row col-sm-12 col-lg-12 col-md-12">
                                <div class="pull-right campaign_btn_inner">     
                                <?php if(date('Y-m-d')<=$campaign->end_date && $campaign->show_stetus==1){ ?>
                                <?php                                
                                  $campaignid=$campaign->id;
                                  $buyerid=$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'';
                                  $sellerid=$campaign->user_id;
                                  $url=BASE_URL.'payment/index/'.$campaignid.'/'.$sellerid.'/'.$buyerid.'?paymenttype=campaign';
                                  ?>
                                
                                    <a href="<?=$url?>" class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/payment.png" class="img img-responsive" height="33" width="139" style="height: 34px;"></a> &nbsp;&nbsp;&nbsp;&nbsp;  
                                    <!--<a onclick="showhide('peymentdetail')" class="btn btn-success btn-sm cus_btn_sm" role="button"> View Payment Detail</a>-->
                                
                                <?php } ?>
                                
                                
                                <?php if($campaign->type_Of_User=='1'){ ?>
                                <a href="<?=BASE_URL?><?=$campaign->username?>/Shope/user_profile" target="_blank" class="btn btn-warning"> View Shop </a> &nbsp; &nbsp;&nbsp;

                                <a href="<?=BASE_URL?>sellerprofile/<?=$campaign->username?>" class="btn btn-primary"> View Seller Profile </a>
                                <?php } ?> 
                                </div>     
                            </div>
                            </div>
                        </div>
                           
<!--                           <div class="row col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <img id ="share_button" class="img img-responsive pull-right" src = "<?php echo BASE_URL; ?>assets/image/fbshare.png" alt="fbshare">
                            </div>-->
                           
                           
                       </div>
            
            <div class="col-sm-12 margin-bottom_20">
                <div class="dt_progress_bar" style="font-family: arial; font-size: 80%;">
			<div class="title_com_donation margin-bottom_10" style="">Donation meter</div>
			<div class="frame">
                            <div id="raisetitle" title="" class="barholder" style="background-color: #fff; border:1px solid #EDEDED; border-radius: 5px; height: 15px;">
                                    <div class="fill" id="fill_percent" style="width: 5%; background-color: #26BB39; height: 100%; margin-top: 0px; border-radius: 5px;"><span id="fill_text_percent" style="float:right;color:#fff;margin-right:5px;margin-top: -2px;">0%</span></div>
				</div>
				<span class="start" style="float: left;">$0</span>
				
                                <span class="goal" style="float: right;" title="gole amount">$<?=$campaign->price?></span></div>
			<div style="clear: both;"></div>
		</div>
            </div>







        
            <div class=" col-sm-12 table-responsive" id="peymentdetail">
             
                <div class="pro_detail_head margin-bottom_10">Donation detail of this campaign </div>                

                            <table class="table table-bordered cus-table-bordered">
                               <thead class="cus-thead">
                                    <tr>                                                                    
                                        <td class="cam_text_head1">Paid Date</td>
                                        <td class="cam_text_head1">Paid user Name</td>
                                        <td class="cam_text_head1">paid Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total=0;
                                    if($peymentdetail['res']){     
                                        $peymentdetailrows = $peymentdetail['rows'];
                                        foreach ($peymentdetailrows as $peymentdetail){
                                    ?>
                                    <tr>
                                        <td align='center'><?php echo $peymentdetail->date; ?></td>
                                        <td align='center'><?php echo $peymentdetail->name; ?></td>
                                        <td align='center'>$<?php echo $peymentdetail->price; ?></td>
                                    </tr>
                                    <?php $total+=$peymentdetail->price; }}else{?>
                                    <tr>
                                        <td colspan="3"><p class="text-danger">Currently no any donation.</p></td>
                                    </tr>
                                    <?php } ?>
                                <input type="hidden" id="raiseamt" value="<?=$total?>" />
                                <input type="hidden" id="raisepercent" value="<?=(($total*100)/$campaign->price)?>" />
                                </tbody>
                           </table>

                    </div>
           
  
               </div>
          <?php }else{ ?>
            <div class="text-danger">No data found.</div>
          <?php } ?>  
            
            
        </div> 
        <div class=" margin-bottom_20"></div>
        
        
    </div>
</div>      

<script>
    $(document).ready(function(){
        var raiseamt=$("#raiseamt").val();
        var raisepercent=$("#raisepercent").val();
        if(raisepercent>100){ $('#fill_percent').width('100%'); }else{
        $('#fill_percent').width(raisepercent+'%');}
        $("#fill_text_percent").html(raisepercent+" %");
        $("#raisetitle").attr("title","Current amount: $"+raiseamt+" ("+raisepercent+"% towards goal)");
    });
</script>
    


<!--<script>
      
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
</script> -->
