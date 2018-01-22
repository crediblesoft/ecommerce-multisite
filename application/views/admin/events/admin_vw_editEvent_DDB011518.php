<section class="content-header">
    <h1>
     Manage Event
     <small>edit</small>
    </h1>
    <style>    option[value='white'] {
                letter-spacing: 2px;    
                background: white;
            }
            option[value='orange'] {
                background: orange;    
            }
            option[value='red'] {
                background: red;
            }
            option[value='black'] {
                background: black;
            }
            option[value='green'] {
                background: green;
            }
            option[value='blue'] {
                background: blue;
            }
            option[value='yellow'] {
                background: yellow;
            }
            option[value='yellowgreen'] {
                background: yellowgreen;
            }
            option[value='violet'] {
                background: violet;
            }
            option[value='turquoise'] {
                background: turquoise;
            }
            option[value='slateblue'] {
                background: slateblue;
            }
            option[value='pink'] {
                background: pink;
            }
            option[value='indigo'] {
                background: indigo;
            }
star{color: red;}
.displaynone{display: none;}

#yourcolorselected{line-height: 34px;}
        </style>
<!--    <ol class="breadcrumb">
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
            <div class="pull-right">
                <a href="<?=BASE_URL?>admin/events/viewuserEvents" class="btn btn-warning btn-sm" id="">View Event</a>
                <a href="<?=BASE_URL?>admin/events/eventlist" class="btn btn-primary btn-sm" id="">Event List</a>
            </div>
            </div>
            
            <div class="box-body">
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/events/editevent/<?=$events['rows'][0]->id?>">
                        
                <input type="hidden" id="eventId" name="eventId" value="<?=$events['rows'][0]->id?>" >
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event Title<star>*</star></label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="title" value="<?=$events['rows'][0]->event_title?>" name="title" placeholder="Event Title">
                      <?php if(form_error('title')!='') echo form_error('title','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="title_error"></span>

                </div>
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event Color<star>*</star></label></div>
                  <div class="col-sm-7">          
                      <select class="form-control" name="color" id="color">
                          <option selected="" value="<?php echo $events['rows'][0]->event_color?>"style="background-color: <?php echo $events['rows'][0]->event_color?>;color: #FFFFFF;"></option>
                            <option value="orange"  <?php echo set_select('color', 'orange'); ?> >orange</option>
                            <option value="red"  <?php echo set_select('color', 'red'); ?> >red</option>
                            <option value="black"  <?php //echo set_select('color', 'black'); ?> >black</option>
                            <option value="green"  <?php echo set_select('color', 'green'); ?> >green</option>
                            <option value="blue"  <?php echo set_select('color', 'blue'); ?> >blue</option>
                            <option value="yellow"  <?php echo set_select('color', 'yellow'); ?> >yellow</option>
                            <option value="yellowgreen"  <?php echo set_select('color', 'yellowgreen'); ?> >yellowgreen</option>
                            <option value="violet"  <?php echo set_select('color', 'violet'); ?> >violet</option>
                            <option value="turquoise"  <?php echo set_select('color', 'turquoise'); ?> >turquoise</option>
                            <option value="slateblue"  <?php echo set_select('color', 'slateblue'); ?> >slateblue</option>
                            <option value="pink"  <?php echo set_select('color', 'pink'); ?> >pink</option>
                            <option value="indigo"  <?php echo set_select('color', 'indigo'); ?> >indigo</option>

                        </select>
                      <?php if(form_error('color')!='') echo form_error('color','<div class="text-danger err">','</div>'); ?>
                      <span class="text-danger" id="color_error"></span>
                  </div><div class="col-sm-1" id="yourcolorselected" style="background-color: <?php echo $events['rows'][0]->event_color?>;color: #FFFFFF;font-size: 10px;">Your Color</div>

                </div>
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="details"> Details</label></div>
              <div class="col-sm-9">          
                  <textarea class="form-control" id="details" name="details" placeholder="Event Details"><?=$events['rows'][0]->event_detail?></textarea>
                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
              </div>
              <span class="text-danger" id="details_error"></span>
                                  
                </div>
                
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event Start Date<star>*</star></label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="startdate" value="<?=$events['rows'][0]->start_date?>" name="startdate" placeholder="Event Start  Date">
                      <?php if(form_error('startdate')!='') echo form_error('startdate','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="startdate_error"></span>

                </div>
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event End Date</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="enddate" value="<?=$events['rows'][0]->end_Date?>" name="enddate" placeholder="Event End Date">
                      <?php if(form_error('enddate')!='') echo form_error('enddate','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="name_error"></span>

                </div>
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Status</label></div>
                  <div class="col-sm-9">          
                      <select class="form-control" id="status" name="status">
                                <option value="1" <?php if($events['rows'][0]->stetus==1){echo "selected"; } ?> >Active</option>
                                <option value="0" <?php if($events['rows'][0]->stetus==0){echo "selected"; } ?> >Inactive</option>
                        </select>
                  </div>

                </div>
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="event" class="btn btn-primary pull-right">Submit</button>
                  </div>
                </div>
                        
                    <div class="pull-right">
                        <a href="<?=BASE_URL?>admin/events/viewuserEvents" class="btn btn-warning btn-sm" id="">View Event</a>
                        <a href="<?=BASE_URL?>admin/events/eventlist" class="btn btn-primary btn-sm" id="">Event List</a>
                    </div>    
                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>

<script>
    $(function(){
        $( "#startdate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#startdate").datepicker("option", "minDate", dt);
            }
        });
        $( "#enddate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#enddate").datepicker("option", "maxDate", dt);
            }
        });
    });
    
    
    $(document).ready(function(){
        $("#color").change(function() {
            var seletedcolor=$(this).val();
            var seletedval=$("#color option:selected" ).text();
            $("#yourcolorselected").text(seletedval);
            $("#yourcolorselected").css('background-color',seletedval);
        //alert($(this).text());
        });
        
        $('#event').click(function(){
            var title= $('#title').val().trim();
            var color= $('#color').val().trim();
            var details=$("#details").val().trim();
            var startdate= $('#startdate').val().trim();
            
            if(title== ""){
                $('#title').focus();
                $('#title_error').parent().addClass('has-error');
                return false;
            }
            if(color==""){
                $('#color').focus();
                $('#color').parent().addClass('has-error');
                return false;
            }
            if(details == ''){
                   //$("#name_error").html("Enter Your First Name");
                    $("#details").focus();
                    $("#details_error").parent().addClass("has-error");
                    return false;    
              }
            if(startdate==""){
                $('#startdate').focus();
                $('#startdate').parent().addClass('has-error');
                return false;
            }
            
            return true;
        });
        
    });
//   $('#title').keypress(function (e) {
//     var regex = new RegExp("^[a-zA-Z0-9-]+$");
//     var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//     if (regex.test(str)) {
//         return true;
//     }

//     e.preventDefault();
//     return false;
// });  

  // $('#title').keyup(function()
  // {
  //   var yourInput = $(this).val();
  //   re = /['"\{\}\  ]/gi;
  //   var isSplChar = re.test(yourInput);
  //   if(isSplChar)
  //   {
  //     var no_spl_char = yourInput.replace(/['"\{\}\\/]/gi, '');
  //     $(this).val(no_spl_char);
  //   }
  // });
</script>