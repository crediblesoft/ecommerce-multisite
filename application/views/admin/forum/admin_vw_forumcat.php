<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Forum
     <small>category</small>
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
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/forum/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="category" <?php if($this->input->get('searchby')=='category'){echo "selected";} ?> >Category</option>
                      </select>
                    </div> &nbsp;
                    
                    
                    <div class="form-group"> &nbsp;
                      <label for="pwd" class="sr-only" >Product Name</label>
                      <select class="form-control search_form_display" id="usercategory" name="val" disabled="">
                          <option value="">----Please Select----</option>
                      </select>
                    </div>
                    
                    <button type="submit" class="btn btn-default" id="search">Search</button>
                    
                <div class="pull-right">
                    <a href="<?=BASE_URL?>admin/forum/add" class="btn btn-success btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-plus-sign"></span> Add Forum Category</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_enable')!='1'){echo '" disabled ';}?> featured" id="">Active</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_enable')!='1'){echo '" disabled ';}?> un_featured" id="">In-Active</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_modifiable')!='1'){echo '" disabled ';}?> delete" id="">Delete</a>
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
                        <th width="">Category</th>
                        <th width="">Post</th>
                        <th width="">Posted By</th>
                        <th>Status</th>
                        <th colspan="2" style="width: 12px">Action</th>
                    </tr>
                    
                    <?php //print_R($forumlist); 
                      if($categorylist['res']){$i=1; foreach($categorylist['rows'] as $category){
                        $typeofuser="Admin"; ?>
               <tr>
                    <td><?=$i?>.</td>
                    <td><input type="checkbox" value="<?=$category->Catid?>" class="innercheckbox" name="id[]"></td>
                    <td><a href="<?=BASE_URL?>admin/forum/topic/<?=$category->Catid?>" class="forum_a"><?=$category->category?></a></td>
                    <td><?=$category->Nooftopic?></td>
                    <td>
                        <div class="row">
                              <div class="col-sm-2"><?=$typeofuser?></div>
                              <div class="col-sm-3"><?php echo date("d M Y", $category->timestamp); ?></div>
                              <div class="col-sm-3"><?php echo date("h:i a", $category->timestamp); ?></div>
                        </div>
                    </td>
                  <td><?php if($category->admin_status==1){echo "Active";}else{echo "In-active";} ?></td>
                      <td style="width: 6px"><a href="<?=BASE_URL?>admin/forum/topic/<?=$category->Catid?>" class="btn btn-info btn-sm" title="View category"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                      <td style="width: 6px"><a href="<?=BASE_URL?>admin/forum/editcategory/<?=$category->Catid?>" class="btn btn-warning btn-sm" title="Edit category" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-pencil"></span></a></td>
               </tr>
              <?php $i++;} ?>
               
               <tr>
                    <td colspan="11">
                        <div class="pull-right">
                            <a href="<?=BASE_URL?>admin/forum/add" class="btn btn-success btn-sm" id="" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-plus-sign"></span> Add Forum Category</a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_enable')!='1'){echo '" disabled ';}?> featured" id="">Active</a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_enable')!='1'){echo '" disabled ';}?> un_featured" id="">In-Active</a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Forum Category_modifiable')!='1'){echo '" disabled ';}?> delete" id="">Delete</a>
                        </div>   
                    </td>
                </tr>
                <?php }else{ ?>
                <tr>
                    <td colspan="11"><p class="text-danger">No record found.</p></td>
                </tr>
                <?php } ?>
               
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
        <h4 class="modal-title">Active Product</h4>
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
        <h4 class="modal-title">Active Product</h4>
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
        <h4 class="modal-title">In-Active Product</h4>
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
        <h4 class="modal-title">In-Active Product</h4>
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
        <h4 class="modal-title">Delete Category</h4>
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
        <h4 class="modal-title">Delete Category</h4>
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
        if(selectedval=='category'){ //alert("aa");
            $('#usercategory option[value="<?=$this->input->get('val')?>"]').attr("selected", "selected");
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
        $("#usercategory").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='category'){
            $("#usercategory").removeClass("search_form_display");
            $("#usercategory").prop("disabled",false);
            $("#usercategory").focus();
            getcategory(selectedval);
        }else{
            $("#usercategory").addClass("search_form_display");    
            $(".search_form_display").prop("disabled",true);
        }
    }
    
    function getcategory(getvalue){
        $.ajax({url:"<?=BASE_URL?>admin/forum/getcagegory",async:false,
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
                $("#un_che_featured_user_deletemsg").html("Please select at least one category.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to active selected category(ies)?");
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
            $.post("<?=BASE_URL?>admin/forum/activecat",{selectedmail:selectedmail},function(data,status){
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
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one category.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected category(ies)?");
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
            $.post("<?=BASE_URL?>admin/forum/inactivecat",{selectedmail:selectedmail},function(data,status){
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
                $("#un_che_delete_user_deletemsg").html("Please select at least one category.");
                $("#un_che_delete_user_model").modal("show");
            }else{
                 $("#delete_user_deletemsg").html("Do you want to delete selected category(ies)?");
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
            $.post("<?=BASE_URL?>admin/forum/deletecat",{selectedmail:selectedmail},function(data,status){
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
