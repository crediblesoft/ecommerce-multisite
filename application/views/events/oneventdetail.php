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
</style><?php //print_r($events); ?>
      


    <div class="col-sm-9">
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 ">
            <div class="col-sm-12">
               <div class="row" id="computers">
                   <?php if($events['res']){ 
                                   foreach($events['rows'] as $event){                                       
                                   ?>
                   <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 system" style="border: 1px solid #e5e5e5;" >
                       <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12 imagecenter">
                           <a href="#" class="thumbnail">
                             <img src="<?=BASE_URL?>assets/image/CalendarEvents/<?=$event->event_image?>" alt="" class="img img-responsive">
                            </a>
                       </div>
                       <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
                           <h3 class="price"><?php echo $event->event_title;?></h3>
                          <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
                              <div class="row">
                               

                              <p><?php echo $event->event_detail;?></p>
                              <div class="col-sm-12 col-xs-12 ">
                                  <?php echo "Event Start Date ".$event->start_date." End Date ".$event->end_Date?>
                                   
                              </div>
                              </div>
                              
                              <br/>
                              <div class="col-lg-5 no-right-pad">
                                  <?php if(($event->event_video!='')){?>
                                <iframe src="<?php echo $event->event_video?>"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                  <?php }?>
                              
                            </div>
                              <a href="<?php echo $event->event_link?>">Your Site Link</a>
                              <br/>
                              <br/>
                          </div>
                       </div>   
                   </div>
                    <?php  } } ?>
               </div>
            </div>



        </div>        
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