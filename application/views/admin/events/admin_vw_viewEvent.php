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
                <a href="<?=BASE_URL?>admin/events/addevent" class="btn btn-warning btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Events_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>>Add Event</a>
                <a href="<?=BASE_URL?>admin/events/eventlist" class="btn btn-primary btn-sm" id="">Event List</a>
            </div>
            </div>
            
            <div class="box-body">
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post">
                        
              <!--   <input type="hidden" id="eventId" name="eventId" value="<?=$events['rows'][0]->id?>" > -->

              <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event Title</label></div>
                  <div class="col-sm-9">    
                         <label class="control-label" style="text-transform: capitalize;font-weight: 500;" for="name"> <?=$events['rows'][0]->username?></label>
                  </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event Title</label></div>
                  <div class="col-sm-9">    
                         <label class="control-label" style="text-transform: capitalize;font-weight: 500;" for="name"> <?=$events['rows'][0]->event_title?></label>
                    
                      
                  </div>

                </div>
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event Color</label></div>
                  <div class="col-sm-9">          
                  
                 <label class="control-label" style="text-transform: capitalize;font-weight: 500;" for="name">   <?php echo $events['rows'][0]->event_color?>
                </label>
                     

                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="details"> Details</label></div>
              <div class="col-sm-9">          
                 <label class="control-label" style="text-transform: capitalize;font-weight: 500;" for="name">
               <?=$events['rows'][0]->event_detail?> </label> 
                
              </div>
              
                                  
                </div>
                
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event Start Date</label></div>
                  <div class="col-sm-9">          
                    <label class="control-label" style="text-transform: capitalize;font-weight: 500;" for="name"> <?=$events['rows'][0]->start_date?></label> 
                  </div>
             

                </div>
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Event End Date</label></div>
                  <div class="col-sm-9">          
                     <label class="control-label" style="text-transform: capitalize;font-weight: 500;" for="name"><?=$events['rows'][0]->end_Date?></label> 
                    
                  </div>
               

                </div>
                  <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Status</label></div>
                  <div class="col-sm-9">          
                     <label class="control-label" style="text-transform: capitalize;font-weight: 500;" for="name"> <?php if($events['rows'][0]->stetus==1){echo "Active"; } ?> </label> 
                     <label class="control-label" style="text-transform: capitalize;font-weight: 500;" for="name"><?php if($events['rows'][0]->stetus==0){echo "Inactive"; } ?></label> 
                               
                  </div>

                </div>
               
                        
                  <!--   <div class="pull-right">
                        <a href="<?=BASE_URL?>admin/events/viewuserEvents" class="btn btn-warning btn-sm" id="">View Event</a>
                        <a href="<?=BASE_URL?>admin/events/eventlist" class="btn btn-primary btn-sm" id="">Event List</a>
                    </div>     -->
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

