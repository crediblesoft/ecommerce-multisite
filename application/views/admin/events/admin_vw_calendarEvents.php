<style> 
    .search_form_display{ display: none !important; }
/*    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }*/
</style>
<link href='<?php echo BASE_URL?>/edit_assets/event_calendar/lib/cupertino/jquery-ui.min.css' rel='stylesheet' />
<link href='<?php echo BASE_URL?>/edit_assets/event_calendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo BASE_URL?>/edit_assets/event_calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo BASE_URL.'edit_assets/event_calendar/moment.js'?>'></script>
<script src='<?php echo BASE_URL.'edit_assets/event_calendar/jquery.min.js'?>'></script>
<script src='<?php echo BASE_URL.'edit_assets/event_calendar/fullcalendar.js'?>'></script>
<div class="modal fade" id="events" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Events Details</h4>
        </div>
        <div class="modal-body" id="details">
            
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="float:left;">Close</button>
          
        </div>
      </div>
      
    </div>
</div>
<section class="content-header">
    <h1>
     Manage Event Calendar
     <small>view</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                  <span class="text-danger" id="error_search"></span>
                    <div class="pull-right">
                        <a href="<?=BASE_URL?>admin/events/addevent" class="btn btn-warning btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Events_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>>Add Event</a>
                        <a href="<?=BASE_URL?>admin/events/eventlist" class="btn btn-primary btn-sm" id="">View List</a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <div class="table table-bordered">
                        <div id='calendar'></div>
                    </div>    
                </div>
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        <a href="<?=BASE_URL?>admin/events/addevent" class="btn btn-warning btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Events_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>>Add Event</a>
                        <a href="<?=BASE_URL?>admin/events/eventlist" class="btn btn-primary btn-sm" id="">View List</a>
                    </div>
                </div>
            </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>

<script>
	$(document).ready(function() {
        var test="<?php echo $evendata;?>";
        console.log(test);
            $('#calendar').fullCalendar({
                header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: ''//month,agendaWeek,agendaDay
                },
                       
			defaultDate: Date('Y-m-d'),//'2015-10-12',
                        editable: true,
			eventLimit: true, // allow "more" link when too many events

			events: [<?php echo $evendata;?>]
		});		
	});

function getevent_data(eventid){
   
    var event_id=eventid;
    var pdata="";
    //alert("hi1");
    //alert(event_id);
    $.post("<?=BASE_URL?>events/geteventdata_byid",{event_id:event_id},function(data,status){

    var obj=JSON.parse(data);
    //alert(obj.status);
   
    if(obj.status){

        var alldata=obj.rows[0];
        //alert(alldata);
         //pdata+='<div>';
         var base_url="<?php echo BASE_URL;?>";
         var username = alldata['username'];
         
         var href  = base_url+"sellerprofile/"+username;
         var usernameanchorstart = '<td><a href="'+href+'">';
         var usernameanchorend = '</a></td>';
         if(username==null){
            username="admin";
            usernameanchorstart = '<td>';
            usernameanchorend = '</td>';
        }
         pdata+='<table class="table table-bordered">';

         pdata+='<tbody>';
         pdata+='<tr>';
         pdata+='<td class="custum_td">';
         pdata+='Event Title';
         pdata+='</td>';
         pdata+='<td>'; 
         pdata+=alldata['event_title'];
         pdata+='</td>';
         pdata+='</tr>';
         pdata+='<tr>';
         pdata+='<td class="custum_td">';
         pdata+='Event Details';
         pdata+='</td>';
         pdata+='<td>'; 
         pdata+=alldata['event_detail'];
         pdata+='</td>';
         pdata+='</tr>';
         pdata+='<tr>';
         pdata+='<td class="custum_td">';
         pdata+='Event Start Date';
         pdata+='</td>';
         pdata+='<td>'; 
         pdata+=alldata['start_date'];
         pdata+='</td>';
         pdata+='</tr>';
         pdata+='<tr>';
         pdata+='<td class="custum_td">';
         pdata+='Event End Date';
         pdata+='</td>';
         pdata+='<td>'; 
         pdata+=alldata['end_Date'];
         pdata+='</td>';
         pdata+='</tr>';
         pdata+='<tr>';
         pdata+='<td class="custum_td">';
         pdata+='Posted By';
         pdata+='</td>';
         pdata+=usernameanchorstart; 
         pdata+=username;
         pdata+=usernameanchorend;
         pdata+='</tr>';
         pdata+='</tbody>';
        
         //pdata+=alldata['event_detail'];
         pdata+='</table>';
        // pdata+='</div>';
        //alert(html);
        $("#details").html(pdata);
        
    }
    
    });    
}

</script>
