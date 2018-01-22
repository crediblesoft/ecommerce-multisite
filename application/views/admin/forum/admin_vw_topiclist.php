<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Forum
     <small>topic list</small>
    </h1>
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
              <!--<h3 class="box-title"></h3>-->   
              <span class="text-danger" id="error_search"></span>
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/forum/search/" method="get">
                  <input type="hidden" name="pagename" value="<?php echo $pagename['pagename'];?>">
                  <input type="hidden" name="pageid" value="<?php echo $pagename['pageid'];?>">
                  <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <!--<option value="seller" <?php //if($this->input->get('searchby')=='seller'){echo "selected";} ?> >Seller</option>-->
                          <option value="topic" <?php if($this->input->get('searchby')=='topic'){echo "selected";} ?> >Topic</option>
						  <option value="postedby" <?php if($this->input->get('searchby')=='postedby'){echo "selected";} ?> >Posted by username</option>
                          <option value="posteddate" <?php if($this->input->get('searchby')=='posteddate'){echo "selected";} ?> >Posted Date</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Product Name</label>
                        <input type="text" class="form-control search_form_display" id="topic" name="val" placeholder="Enter Topic" disabled="">
                    </div>
					<div class="form-group">
                        <label for="pwd" class="sr-only">Product Name</label>
                        <input type="text" class="form-control search_form_display" id="postedby" name="val" placeholder="Posted by username" disabled="">
                    </div>
                    
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
                    <a href="<?=BASE_URL?>admin/forum/add" class="btn btn-success btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_modifiable')!='1'){echo 'disabled onclick="return false;"';}?>><span class="glyphicon glyphicon-plus-sign"></span> Add Category</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum_enable')!='1'){echo '" disabled ';}?> featured" id="">Active</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum_enable')!='1'){echo '" disabled ';}?> un_featured" id="">In-Active</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum_modifiable')!='1'){echo '" disabled ';}?> delete" id="">Delete</a>
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
                        <th width="30%">Topic</th>
                        <th width="5%">Like</th>
                        <th width="5%">View</th>
                        <th width="45%">Posted By</th>
                        <th width="5%">Status</th>
                    </tr>
                    
                    <?php //print_R($forumlist); 
                      if($forumlist['res']){
                        $i=1;  foreach($forumlist['rows'] as $forum){
                              
                      ?>
               <tr>
                   <td><?=$i?>.</td>
                      <td><input type="checkbox" value="<?=$forum->ForumId?>" class="innercheckbox" name="id[]"></td>
                  <td><a href="<?=BASE_URL?>admin/forum/replylist/<?=$forum->ForumId?>" class="forum_a"><?=$forum->topic?></a></td>
                  <td><?=$forum->like?></td>
                  <td><?=$forum->view?></td>
                  <td>
                      <div class="row">
                          <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12"> 
                              <?php if($pagename['pagename']=='user'){ ?>
                              <a target="_blank" href="<?=BASE_URL?>admin/users/details/<?=$forum->UserId?>" class="forum_a"> <?=ucfirst($forum->f_name)?> <?=$forum->l_name?> <?php if($forum->username!=''){ echo '('.$forum->username.')';}?></a>
                              <?php }else{ ?>
                          <a href="<?=BASE_URL?>admin/forum/user/<?=$forum->UserId?>" class="forum_a"> <?=ucfirst($forum->f_name)?> <?=$forum->l_name?> <?php if($forum->username!=''){ echo '('.$forum->username.')';}?></a>
                              <?php } ?>
                          </div>
                            <div class="col-sm-2"><?php ?></div>
                            <div class="col-sm-3"><?php echo date("d M Y", $forum->timestamp); ?></div>
                            <div class="col-sm-3"><?php echo date("h:i a", $forum->timestamp); ?></div>
                      </div>
                  </td>
                  <td><?php if($forum->admin_status==1){echo "Active";}else{echo "In-active";} ?></td>
               </tr>
              <?php $i++;} ?>
               <tr>
                    <td colspan="8">
                        <div class="pull-right">
                            <a href="<?=BASE_URL?>admin/forum/add" class="btn btn-success btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-plus-sign"></span> Add Category</a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum_enable')!='1'){echo '" disabled ';}?> featured" id="">Active</a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum_enable')!='1'){echo '" disabled ';}?> un_featured" id="">In-Active</a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum_modifiable')!='1'){echo '" disabled ';}?> delete" id="">Delete</a>
                        </div>   
                    </td>
                </tr>
              <?php }else{ ?>  <tr><td colspan="5"> <p class="text-danger">No Record Found</p> </td></tr> <?php } ?>
               
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
               <?=$links?>
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
        <h4 class="modal-title">Active Topic</h4>
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
        <h4 class="modal-title">Active Topic</h4>
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
        <h4 class="modal-title">In-Active Topic</h4>
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
        <h4 class="modal-title">In-Active Topic </h4>
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
        <h4 class="modal-title">Delete Topic</h4>
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
        <h4 class="modal-title">Delete Topic</h4>
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
        if(selectedval=='topic'){
            $("#topic").val("<?=$this->input->get('val')?>");
        }
		else if(selectedval=='postedby'){
            $("#postedby").val("<?=$this->input->get('val')?>");
        }
		else if(selectedval=='posteddate'){
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
        $("#topic").addClass("search_form_display");
		$("#postedby").addClass("search_form_display");
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='topic'){
            $("#topic").removeClass("search_form_display");
            $("#topic").prop("disabled",false);
            $("#topic").focus();
            }
		else if(selectedval=='postedby')
		{
			$("#postedby").removeClass("search_form_display");
            $("#postedby").prop("disabled",false);
            $("#postedby").focus();
		}
			
			else if(selectedval=='posteddate'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
            }else{
                $("#topic").addClass("search_form_display");
				$("#postedby").addClass("search_form_display");
                $("#from").addClass("search_form_display");
                $("#to").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
    
    function getcategory(getvalue){
        $.ajax({url:"<?=BASE_URL?>admin/product/getcagegory",async:false,
            success:function(data,status){
                var obj= $.parseJSON(data);
                var htm=''; 
            if(obj.res){
                   htm+='<option value="">-----Select Category----</option>';
                   $.each(obj.rows,function(i,val){
                       htm+='<option value="'+val.id+'">'+val.category+'</option>';
                   });
                }else{
                    htm+='<option value="">Category not found</option>';
                }
                $("#usercategory").html(htm);
            }});
    }
    
    
    function getusers(getvalue){
        $.ajax({url:"<?=BASE_URL?>admin/product/getusers",async:false,
            success:function(data,status){
            var obj= $.parseJSON(data);
            var htm=''; 
            if(obj.res){
                 htm+='<option value="">-----Select Seller----</option>';
                   $.each(obj.rows,function(i,val){
                       htm+='<option value="'+val.id+'">'+val.username+'</option>';
                   });
                }else{
                    htm+='<option value="">User not found</option>';
                }
                $("#usercategory").html(htm);
            }});
    }
    
    
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
                $("#un_che_featured_user_deletemsg").html("Please select at least one topic.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to active selected topic(s)?");
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
            $.post("<?=BASE_URL?>admin/forum/active",{selectedmail:selectedmail},function(data,status){
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
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one topic.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected topic(s)?");
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
            $.post("<?=BASE_URL?>admin/forum/inactive",{selectedmail:selectedmail},function(data,status){
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
                $("#un_che_delete_user_deletemsg").html("Please select at least one topic.");
                $("#un_che_delete_user_model").modal("show");
            }else{
                 $("#delete_user_deletemsg").html("Do you want to delete selected topic(s)?");
                 $("#delete_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2delete",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/forum/delete",{selectedmail:selectedmail},function(data,status){
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
