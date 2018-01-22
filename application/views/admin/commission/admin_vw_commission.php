<style>  .search_form_display{ display: none !important; } </style>
<section class="content-header">
    <h1>
     Manage Campaign Commission
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
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Commission For Premium Users</th>
                        <th>Commission For Free Users</th>
                        <th>Commission Type</th>
                        <th>Date</th>
                        <th>Edit</th>
                    </tr>
                    
                    <?php if($commission['res']){
                        $i=1;
                        foreach($commission['rows'] as $admin_commission){
                            ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <td><?=$admin_commission->comm_for_premium ?>%</td>
                      <td><?=$admin_commission->comm_for_freeuser ?>%</td>
                      <td><?=$admin_commission->comm_type ?></td>
                      <td><?=$admin_commission->comm_date ?></td>
                      <td style="width: 6px"><a href="<?=BASE_URL?>admin/commission/edit/<?=$admin_commission->id?>" class="btn btn-warning btn-sm" title="Edit Commission" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Campaign Commission_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-pencil"></span></a></td>
                    </tr>
                    
                    <?php $i++;} ?>
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
<div id="delete_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Tax</h4>
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
        <h4 class="modal-title">Delete Tax</h4>
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
        if(selectedval=='state'){ //alert("aa");
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
        
        if(selectedval=='state'){
            $("#usercategory").removeClass("search_form_display");
            $("#usercategory").prop("disabled",false);
            $("#usercategory").focus();
            getcategory(selectedval);
        }else{
            $("#product").addClass("search_form_display");
            $("#usercategory").addClass("search_form_display");
            $("#from").addClass("search_form_display");
            $("#to").addClass("search_form_display");
            $(".search_form_display").prop("disabled",true);
        }
    }
    
    function getcategory(getvalue){
        $.ajax({url:"<?=BASE_URL?>admin/tax/getstates",async:false,
            success:function(data,status){
                var obj= $.parseJSON(data);
                var htm=''; 
            if(obj.res){
                   htm+='<option value="">-----Select State----</option>';
                   $.each(obj.rows,function(i,val){
                       htm+='<option value="'+val.id+'">'+val.state+'</option>';
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

        $(".delete").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_delete_user_deletemsg").html("Please select at least one state's tax.");
                $("#un_che_delete_user_model").modal("show");
            }else{
                 $("#delete_user_deletemsg").html("Do you want to delete selected state's tax(es)?");
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
            $.post("<?=BASE_URL?>admin/tax/delete",{selectedmail:selectedmail},function(data,status){
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


