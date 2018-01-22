<script type="text/javascript" src="<?=BASE_URL?>assets/js/jquery.tablesorter.js"></script> 
<link href="<?=BASE_URL?>assets/css/tablesorter.css" media="all" rel="stylesheet" type="text/css" />
<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Recipes
     <small>view</small>
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
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/recipes/search/<?php echo $this->uri->segment(4);?>/" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="user" <?php if($this->input->get('searchby')=='user'){echo "selected";} ?> >Posted Username</option>
						  <option value="title" <?php if($this->input->get('searchby')=='title'){echo "selected";} ?> >Title</option>
               <option value="admin" <?php if($this->input->get('searchby')=='admin'){echo "selected";} ?> >Admin</option>
                      </select>
                    </div> &nbsp;
                    
                    <div class="form-group"> &nbsp;
                      <label for="pwd" class="sr-only" >User Name</label>
					  <input type="text" class="form-control search_form_display" style="width:192px;" id="user" name="val" placeholder="Search by Posted Username" disabled="">
                     
                    </div>
					
					<div class="form-group">
                        <label for="pwd" class="sr-only">Title</label>
                        <input type="text" class="form-control search_form_display" id="title" name="val" placeholder="Search by title" disabled="">
                    </div>
                    
                    <button type="submit" class="btn btn-default" id="search">Search</button>
                    
                <div class="pull-right">
                    <a href="<?=BASE_URL?>admin/recipes/add_new" class="btn btn-success btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-plus-sign"></span> Add New Recipe</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_enable')!='1'){echo '" disabled ';}?>featured" id="">Active</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_enable')!='1'){echo '" disabled ';}?> un_featured" id="">In-Active</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_modifiable')!='1'){echo '" disabled ';}?> delete" id="">Delete</a>
                </div>
                </form>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="myTable" class="table table-bordered tablesorter">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 30px"><input type="checkbox" id="select-all">&nbsp;</th>
                        <th width="">Category</th>
                        <th>Title</th>
                        <th>User</th>
                        <th>Image</th>
						<th>Add date</th>
                        <th>Status</th>
                        <th colspan="2" style="width: 12px">Action</th>
                    </tr>
				</thead>
                    <tbody>
                    <?php if($categorylist['res']){$i=1; foreach($categorylist['rows'] as $category){ ?>
                    
                    <tr>
                        <td><?=$i?>.</td>
                        <td><input type="checkbox" value="<?=$category->recipeid?>" class="innercheckbox" name="id[]"></td>
                        <td><?=$category->category?></td>
                        <td><?=$category->recipe_title?></td>
						<?php if($category->userid==0){?>
						<td>admin</td>	
						<?php }else{?>	
                        <td><a href="<?=BASE_URL?>admin/users/details/<?=$category->userid?>"><?=$category->username?></a></td>
						<?php }?>
						<?php
						if(substr_count($category->image_path,'http') > 0 ) $reciepe_image=$category->image_path; 
						else $reciepe_image=BASE_URL.'assets/image/recipe/thumb/'.$category->image_path;
						?>
                        <td><img src="<?php echo $reciepe_image; ?>" width="40" height="40" class="img img-responsive"></td>
						<td><?=$category->recipe_addDate?></td>
                        <td><?php if($category->admin_status==1){echo "Active";}else{echo "In-active";}?></td>
                        <td style="width: 6px"><a href="<?=BASE_URL?>admin/recipes/details/<?=$category->recipeid?>" class="btn btn-info btn-sm" title="View recipe"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        <?php if($category->userid==0){ ?>
						<td style="width: 6px">
                            <a class="btn btn-warning btn-sm" title="Edit recipe" href="<?=BASE_URL?>admin/recipes/editrecipe/<?=$category->recipeid?>" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>>
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
						</td>
                       <?php } ?>
                    </tr>
                    
                <?php $i++;} ?>
                <?php }else{ ?>
                <tr>
                    <td colspan="11"><p class="text-danger">No record found.</p></td>
                </tr>
                <?php } ?>      
                </tbody>
              </table>
			  
				            <div class="pull-right" style="margin-top:12px;">
                            <a href="<?=BASE_URL?>admin/recipes/add_new" class="btn btn-success btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-plus-sign"></span> Add New Recipe</a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_enable')!='1'){echo '" disabled ';}?> featured" id="">Active</a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_enable')!='1'){echo '" disabled ';}?> un_featured" id="">In-Active</a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Recipes_modifiable')!='1'){echo '" disabled ';}?> delete" id="">Delete</a>
                          </div>   
					
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
        <h4 class="modal-title">Active Recipe</h4>
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
        <h4 class="modal-title">Active Recipe</h4>
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
        <h4 class="modal-title">In-Active Recipe</h4>
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
        <h4 class="modal-title">In-Active Recipe</h4>
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
        <h4 class="modal-title">Delete Recipe</h4>
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
        <h4 class="modal-title">Delete Recipe</h4>
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
        if(selectedval=='user'){
            $("#user").val("<?=$this->input->get('val')?>");
        }
		
		else if(selectedval=='title'){
            $("#title").val("<?=$this->input->get('val')?>");
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
        $("#user").addClass("search_form_display");
		$("#title").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='user'){
                $("#user").removeClass("search_form_display");
                $("#user").prop("disabled",false);
                $("#user").focus();
                
            }
			
			else if(selectedval=='title'){
                $("#title").removeClass("search_form_display");
                $("#title").prop("disabled",false);
                $("#title").focus();
                
            }
			else{
                $("#usercategory").addClass("search_form_display");
				$("#title").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
    
    function getusers(getvalue){ // call for seller & buyers both
        $.ajax({url:"<?=BASE_URL?>admin/product/getallusers",async:false,
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
                $("#un_che_featured_user_deletemsg").html("Please select at least one recipe.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to active selected recipe(s)?");
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
            $.post("<?=BASE_URL?>admin/recipes/active",{selectedmail:selectedmail},function(data,status){
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
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one recipe.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected recipe(s)?");
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
            $.post("<?=BASE_URL?>admin/recipes/inactive",{selectedmail:selectedmail},function(data,status){
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
                $("#un_che_delete_user_deletemsg").html("Please select at least one recipe.");
                $("#un_che_delete_user_model").modal("show");
            }else{
                 $("#delete_user_deletemsg").html("Do you want to delete selected recipe(s)?");
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
            $.post("<?=BASE_URL?>admin/recipes/delete",{selectedmail:selectedmail},function(data,status){
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
<script>
$(document).ready(function() 
    { 
	$.tablesorter.addWidget({
			id: "numbering",
			format: function(table) {
				$("tr:visible", table.tBodies[0]).each(function(i) {
					$(this).find('td').eq(0).text(i+1);
				});
			}
		});
        
		$("#myTable").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false 
             },
			 1: { 
                // disable it by setting the property sorter to false 
                sorter: false 
             },
			 8: { 
                // disable it by setting the property sorter to false 
                sorter: false 
             }
        } ,
		sortList: [[6,1]] ,
		widgets: ['numbering']
    }); 
    } 
);

</script>
