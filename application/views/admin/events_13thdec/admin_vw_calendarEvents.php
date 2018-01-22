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
                        <a href="<?=BASE_URL?>admin/events/addevent" class="btn btn-warning btn-sm" id="">Add Event</a>
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
                        <a href="<?=BASE_URL?>admin/events/addevent" class="btn btn-warning btn-sm" id="">Add Event</a>
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
</script>