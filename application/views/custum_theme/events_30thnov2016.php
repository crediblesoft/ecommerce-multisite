<style>
        #calendar {
                max-width: 900px;
                margin: 0 auto;
        }
        .custommargin-top_20{margin-top: 30px;}
</style>

        <link href='<?php echo BASE_URL.'edit_assets/event_calendar/lib/cupertino/jquery-ui.min.css'?>' rel='stylesheet' />
        <link href='<?php echo BASE_URL.'edit_assets/event_calendar/fullcalendar.css'?>' rel='stylesheet' />
        <link href='<?php echo BASE_URL.'edit_assets/event_calendar/fullcalendar.print.css'?>' rel='stylesheet' media='print' />
<div class="" onclick="" id="page_no<?php echo '20';?>">
 <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
     <div class="col-md-6 col-md-offset-3 galary_hader" id="pageno_13" ondblclick="load_popup2('#view_prod','#title_popup<?php echo $pageid13; ?>','<?php echo $pageid13; ?>')" style="<?php echo $btn_theme_style,$pagetitleposition13;?>"><?php echo $pagetitle13;//$pageid11?></div>
    </div>
     <div id="add_item_page_<?php echo $pageid13;?>"></div>

 
    <div class="container">
       <div class="col-sm-12 ">
           
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="contant-head col-lg-4">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Events Calendar </h4>
                    </div>
<!--                    <div class="contant-head col-lg-8">
                    <h4><span>Seller:-</span><span><?php echo $username=$this->uri->segment(1);?></span></h4>
                    </div>-->
                </div>
            </div>
                <div class="col-sm-12">
                    <!--<div id='top'>
                            Language:
                            <select id='lang-selector'></select>
                    </div>-->
                </div>
                <div class="col-sm-12 custommargin-top_20">
                    <div id='calendar'></div>
                </div>
            
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
           
        </div>
        
      
    </div>
</div>
<script src='<?php echo BASE_URL.'edit_assets/event_calendar/moment.js'?>'></script>
<!--<script src='<?php echo BASE_URL.'edit_assets/event_calendar/jquery.min.js'?>'></script>-->
<script src='<?php echo BASE_URL.'edit_assets/event_calendar/fullcalendar.js'?>'></script>

<script>
	$(document).ready(function() {
            /*var currentLangCode = 'en';
		// build the language selector's options
		$.each($.fullCalendar.langs, function(langCode) {
			$('#lang-selector').append(
				$('<option/>')
					.attr('value', langCode)
					.prop('selected', langCode == currentLangCode)
					.text(langCode)
			);
		});

		// rerender the calendar when the selected option changes
		$('#lang-selector').on('change', function() {
			if (this.value) {
				currentLangCode = this.value;
				$('#calendar').fullCalendar('destroy');
				renderCalendar();
			}
		});*/
            
            
		$('#calendar').fullCalendar({
                     //theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: ''//month,agendaWeek,agendaDay
			},
                       
			defaultDate: Date('Y-m-d'),//'2015-10-12',
			/*selectable: true,
			selectHelper: true,
			select: function(start, end) {
				var title = prompt('Event Title:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('#calendar').fullCalendar('unselect');
			},*/
			editable: true,
			eventLimit: true, // allow "more" link when too many events
                        /*
                        id : 99,//'99' for match day,s and(concadinate events one or more id: 999,)
                        url: 'http://google.com/', //for redirecting 
                        title: 'Long Event', //for titel
                        start: '2015-02-07', //and  2015-02-07T16:00:00
                        end: '2015-02-10',   //and  2015-02-07T16:00:00
                        constraint: 'businessHours', //non dropable  can't changable through front end (events only)
                        color: '#257e4a' //for color 
                        overlap: true, //for overlaping 
                        rendering: 'background', // //non dropable  can't changable through front end (date only)
                        Not:- rendering or constraint not to be on same data 
                         */
			events: [<?php echo $events;?>]
		});
                
             
                    //$('.fc-today-button').addClass('fc-state-disabled');
                    //$('.fc-today-button').attr("disabled", "disabled");
                    //$('.fc-today-button').trigger('click');
	});
</script>
<script>
//$( window ).load(function() {
//  $('.fc-today-button').trigger('click');
//});
function getevent_data(eventid){
    //alert("hi");
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
         pdata+='<td>'; 
         pdata+=alldata['username'];
         pdata+='</td>';
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

