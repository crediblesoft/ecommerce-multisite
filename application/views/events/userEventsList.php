<?php //print_r($events); ?>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId:'1541384582852340',
cookie:true,
status:true,
xfbml:true
});

function FacebookInviteFriends()
{
	var msg=$("#invitemsg").val();
FB.ui({
method: 'apprequests',
message: msg
});
}
</script>
<div class="col-sm-9">
            <!--<div class="row">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Campaign</h4>
                         <span class="add-button"><a href="<?=BASE_URL?>campaign/addcampaign" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Product</a></span>
                    </div>
                </div>
            </div>-->
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>events"> Events</a> </h4><h5> > View </h5>
                         <span class="add-button">
                             <a class="btn btn-success" href="<?=BASE_URL?>events/viewuserEvents"> <span class="glyphicon glyphicon-plus-sign"></span> View Event On Calendar</a>
                             <a class="btn btn-success" href="<?=BASE_URL?>events/add"> <span class="glyphicon glyphicon-plus-sign"></span> Add More  Event</a>    
                         </span>
                    </div>
                </div>
            </div>
            <div class="contant-body2">
                    <div class=" col-sm-12 table-responsive padding_right_none padding_left_none">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <!--<td>Image</td>-->
                                    <td>Color</td>                                    
                                    <td>Title</td>
                                    <!--<td>Detail</td>-->
                                    <td>Status</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
									<td>Social Media</td>
                                    <!--<td>View</td>-->                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php   
                                // print_r($events);
								
                                if($events['res']){ 
                                foreach($events['rows'] as $eventslist){
                                ?>    
                                <tr>
                                    <td><?php echo $eventslist->start_date;?></td>
                                     <td><?php echo $eventslist->end_Date;?></td>
                                    <!--<td><img src="<?php $path=''; if($eventslist->event_image==''){$path='event.png';}else{$path=$eventslist->event_image;} //echo  BASE_URL."assets/image/CalendarEvents/".$path;?>" height="100%" width="100%" class="img-responsive"></td>-->
                                    <td><?=$eventslist->event_color?></td>
                                    <td title="<?=$eventslist->event_title?>"><?=substr($eventslist->event_title, 0, 8).'...'?></td>
                                    <!--<td title="<?php //echo $eventslist->event_detail?>"><?php //echosubstr($eventslist->event_detail, 0, 6).'...'?></td>-->
                                    <td><?php if($eventslist->stetus){ ?><span class="text-success">Active</span><?php }else{ ?><span class="text-danger">Inactive</span><?php } ?></td>
                                    <td><a href="<?=BASE_URL?>events/editevents/<?=$eventslist->id?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                    <td><a href="javascript:void(0);" id="<?=$eventslist->id?>" title="Delete" class="delete" data-target="#deleteproduct" data-toggle="modal" ><span class="glyphicon glyphicon-remove-circle"></span></a></td>
                                 
                                   
								   <td>
								   <?php 
								   $list_url = BASE_URL.'events/';
				                   $rurl = BASE_URL.'events/userEventsList/';
								   $img_paath ='';
                                   $summary='An event is scheduled from '.$eventslist->start_date.' to '.$eventslist->end_Date;
				                   $title=addslashes($eventslist->event_title);
			  
								$textfortwitter=$title.'   : '.$summary;
			               echo '<input type="hidden" id="invitemsg" value="'.$summary.'">';
			
				  $fb_app_id='1541384582852340';
				  echo '<div style="width:100%">';
				  echo '<a target="_blank" style="float:left;" class="fbshare" title="Share On Facebook" onclick="window.open(\'https://www.facebook.com/dialog/feed?curi=close&app_id='.$fb_app_id.'&display=popup&ref=share&picture='.$img_paath.'&name='.$title.'&description='.$summary.'&link='.$list_url.'&redirect_uri='.$rurl.'\',\'sharer\',\'toolbar=0,status=0,width=548,height=325\');return false;" href="javascript: void(0)" >
          <i class="fa fa-facebook-official" style="font-size: 25px;" aria-hidden="true"></i>
</a>';
				  echo '<a target="_blank" style="float:left;" title="Share On Twitter" onclick="window.open(\'https://twitter.com/share?text='.$textfortwitter.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter\',\'_blank\', \'location=yes,width=700,height=400\');return false;" href="https://twitter.com/share?text='.$textfortwitter.'&url='.$list_url.'&utm_source=ProductDetailPage&utm_medium=Twitter"><i class="fa fa-twitter" style="font-size: 25px;" aria-hidden="true"></i>
</a>';
				  echo '<a title="Invite On Facebook" href="#" onclick="FacebookInviteFriends();" style="float:right;"><i class="fa fa-facebook" style="font-size: 25px;" aria-hidden="true"></i>
</a>';
				  echo '</div>';
					?>	

					
					<script> 
					window.open('', '_self', ''); 
                    <?php if(isset($_GET['post_id'])){ ?> window.close(); <?php } ?>
                    </script> 
					</td>
					
					<?php if(!$eventslist->admin_status){ ?><td><small class="text-danger">In-active by admin</small></td><?php } ?>
                   </tr>
                                <?php }?><?php } else{ ?>
            <tr><td colspan="8"><p>No record found.</p></td></tr>
                <?php } ?>  
                            </tbody>
                        </table>
                        <ul class="pagination pagination-sm no-margin pull-right">
                           <?php //echo $links; ?>
                        </ul>
                    </div>
            </div>               
        </div>
        
        
    </div>
</div>  

<!-- Modal -->
<div id="deleteproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Event</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete event?</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="buyerdetails" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Event Details</h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered" id="userdata">
              
          </table>
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
    $(document).ready(function(){
        $(".delete").click(function(){
            var id=$(this).prop('id');
            $("#deleteId").val(id);
            $("#e-result-delete").empty();
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>events/delete",{id:deleteId},function(data,status){
                obj=$.parseJSON(data);
                if(obj.status){
                   $("#e-result-delete").empty().append(obj.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000); 
                }else
                    {
                        $("#e-result-delete").empty().append(obj.message).addClass("alert alert-error fade in");
                    }
            });
        });
    });
        
                </script>
