  <style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Events
     <small>view</small>
    </h1>
</section>
<?php //print_r($events); ?>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <!--<h3 class="box-title"></h3>-->   
              <span class="text-danger" id="error_search"></span>
                <form class="form-inline" role="form" action="<?=BASE_URL?>admin/events/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="seller" <?php if($this->input->get('searchby')=='seller'){echo "selected";} ?> >Seller</option>
                          <option value="productname" <?php if($this->input->get('searchby')=='productname'){echo "selected";} ?> >Event Title</option>
                          <option value="bidstartdate" <?php if($this->input->get('searchby')=='bidstartdate'){echo "selected";} ?> >Event Start Date</option>
                          <option value="bidenddate" <?php if($this->input->get('searchby')=='bidenddate'){echo "selected";} ?> >Event End Date</option>
                          <option value="byadmin" <?php if($this->input->get('searchby')=='byadmin'){echo "selected";} ?> >By Admin</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Seller Name</label>
                        <input type="text" class="form-control search_form_display" id="usercategory" name="val" placeholder="Seller" disabled="">
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Product Name</label>
                        <input type="text" class="form-control search_form_display" id="product" name="val" placeholder="Event Title" disabled="">
                    </div>
<!--                    <div class="form-group"> &nbsp;
                      <label for="pwd" class="sr-only" >Product Name</label>
                      <select class="form-control search_form_display" id="usercategory" name="val" disabled="">
                          <option value="">----Please Select----</option>
                      </select>
                    </div>-->
                    <div class="form-group">
                        <label for="pwd" class="sr-only">From date</label>
                        <input type="text" class="form-control search_form_display" id="from" name="from" placeholder="From" disabled="">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">To date</label>
                        <input type="text" class="form-control search_form_display" id="to" name="to" placeholder="To" disabled="">
                    </div>
                    
                    <button type="submit" class="btn btn-default" id="search">Search</button>
                    
                <div class="pull-right">
<!--                    <a href="<?=BASE_URL?>admin/vs/add" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-plus-sign"></span> Add Category</a>-->
                    <a href="<?=BASE_URL?>admin/events/viewuserEvents" class="btn btn-primary btn-sm" id="">View Event on calendar</a>
                    <a href="<?=BASE_URL?>admin/events/addevent" class="btn btn-success btn-sm" id="">Add Event</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" id="">Delete</a>
                </div>
                </form>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 10px"><input type="checkbox" id="select-all">&nbsp;</th>
                        <th>User Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Title</th>
                        <th>Color</th>
                        <th>Admin Status</th>
                        <th>Action</th>
                    </tr>
                    
                    <?php 
                    
                    //print_r($events);exit;
                    
                    if($events['res']){
                        $i=1; 
                        foreach($events['rows'] as $eventslist){ 
                    
                    ?>
                    
                    <tr>
                        <td><?=$i;?></td>
                        <td><input type="checkbox" value="<?=$eventslist->id;?>" class="innercheckbox" name="id[]"></td>
                        <td>
                            <?php if($eventslist->username !=""){ ?>
                                
                                <a href="<?=BASE_URL?>admin/users/details/<?=$eventslist->user_id;?>" target="_blank">
                                    <?php echo $eventslist->username;?>
                                </a>
                                
                           <?php }else{echo "Admin";}?>
                        </td>
                        <td><?=$eventslist->start_date;?></td>
                        <td><?=$eventslist->end_Date;?></td>
                        <td><?=$eventslist->event_title;?></td>
                        <td><?=$eventslist->event_color;?></td>
                        <td><?php if($eventslist->admin_status==1){echo 'Active';}else{echo 'In-Active';}?></td>
                        <td>
                        <a class="btn btn-primary btn-sm" title="View event" href="<?=BASE_URL?>admin/events/view_event/<?=$eventslist->id;?>">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            

                            </a>
                            <?php if($eventslist->username ==""){ ?>
                            <a class="btn btn-warning btn-sm" title="Edit event" href="<?=BASE_URL?>admin/events/editevent/<?=$eventslist->id;?>">
                                <span class="glyphicon glyphicon-pencil"></span>
                           </a>
                            <?php } ?>
                             
                        </td>
                    </tr>
                    
              <?php $i++;} ?>
               <?php } else{ ?>
                    <tr><td colspan="7"><p class="text-danger">No record found.</p></td></tr>
                <?php } ?>
               <tr>
                    <td colspan="11">
                        <div class="pull-right">
                            <a href="<?=BASE_URL?>admin/events/viewuserEvents" class="btn btn-primary btn-sm" id="">View Event on calendar</a>
                            <a href="<?=BASE_URL?>admin/events/addevent" class="btn btn-success btn-sm" id="">Add Event</a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" id="">Delete</a>
                        </div>   
                    </td>
                </tr>
             
               
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
               <?php echo $links;?>
              </ul>
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>



<!-- Modal -->
<div id="featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active Event</h4>
      </div>
      <div class="modal-body">
          <h4 id="featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2featured">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active Event</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Modal -->
<div id="un_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">In-Active Event</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2un_featured">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_un_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">In-Active Event</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_un_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="delete_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Campaign</h4>
      </div>
      <div class="modal-body">
          <h4 id="delete_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2delete">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_delete_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Campaign</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_delete_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script> 
    $(document).ready(function(){
        var selectedval=$("#searchby").val();
        search(selectedval);
        if(selectedval=='productname'){
            $("#product").val("<?=$this->input->get('val')?>");
        }else if(selectedval=='seller'){ //alert("aa");
            //$('#usercategory option[value="<?=$this->input->get('val')?>"]').attr("selected", "selected");
             $("#usercategory").val("<?=$this->input->get('val')?>");
        }else if(selectedval=='bidstartdate' || selectedval=='bidenddate'){
            $("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
        }        
        $(document).on("change","#searchby",function(){
            selectedval=$(this).val();
            search(selectedval); 
        }); 
        
        $(document).on("click","#search",function(){
            var selectedval=$("#searchby").val();
            if(selectedval==''){
                $("#error_search").html("Please select any one");
                return false;
            }
            return true;
        });
    });
    
    
    function search(selectedval){
        $("#product").addClass("search_form_display");
        $("#usercategory").addClass("search_form_display");
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
       // $("#bidstatus").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='productname'){
            $("#product").removeClass("search_form_display");
            $("#product").prop("disabled",false);
            $("#product").focus();
            }else if(selectedval=='bidstartdate' || selectedval=='bidenddate'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
            }else if(selectedval=='seller'){
                $("#usercategory").removeClass("search_form_display");
                $("#usercategory").prop("disabled",false);
                $("#usercategory").focus();
                //getusers(selectedval);
            }/*else if(selectedval=='running'  || selectedval=='bidover'){
                $("#bidstatus").removeClass("search_form_display");
                $("#bidstatus").prop("disabled",false);
                $("#search").click();
            }*/else{
                $("#product").addClass("search_form_display");
                $("#from").addClass("search_form_display");
                $("#to").addClass("search_form_display");
                //$("#bidstatus").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
    
//    function getusers(getvalue){
//        $.ajax({url:"<?=BASE_URL?>admin/events/getusers",async:false,
//            success:function(data,status){
//            var obj= $.parseJSON(data);
//            var htm=''; 
//            if(obj.res){
//                 htm+='<option value="">-----Select Seller----</option>';
//                   $.each(obj.rows,function(i,val){
//                       htm+='<option value="'+val.id+'">'+val.username+'</option>';
//                   });
//                   htm+='<option value="0">Admin</option>';
//                }else{
//                    htm+='<option value="">User not found</option>';
//                }
//                $("#usercategory").html(htm);
//            }});
//    }
    
   $(document).ready(function(){
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        
        $(".featured").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_featured_user_deletemsg").html("Please select at least one event.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to active selected event(s)?");
                 $("#featured_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2featured",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/events/active",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#featured_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
        $(".un_featured").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one event.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected event(s)?");
                 $("#un_featured_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2un_featured",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/events/inactive",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#un_featured_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        $(".delete").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_delete_user_deletemsg").html("Please select at least one event.");
                $("#un_che_delete_user_model").modal("show");
            }else{
                 $("#delete_user_deletemsg").html("Do you want to delete selected event(s)?");
                 $("#delete_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2delete",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
               // alert(sThisVal);
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/events/delete",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#delete_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
    });
</script>
<script>
    //var $j = jQuery.noConflict();
    $(function(){
        $( "#from" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#to").datepicker("option", "minDate", dt);
            }
        });
        $( "#to" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#from").datepicker("option", "maxDate", dt);
            }
        });
    });
</script>