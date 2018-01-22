<style>  .search_form_display{ display: none !important; } </style>
<section class="content-header">
    <h1>
     Manage Tax
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
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/tax/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="state" <?php if($this->input->get('searchby')=='state'){echo "selected";} ?> >State</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group"> &nbsp;
                      <label for="pwd" class="sr-only" >State Name</label>
                      <select class="form-control search_form_display" id="usercategory" name="val" disabled="">
                          <option value="">----Please Select----</option>
                      </select>
                    </div>
                    
                    <button type="submit" class="btn btn-default" id="search">Search</button>
                    
                <div class="pull-right">
                   <a href="<?=BASE_URL?>admin/tax/add" class="btn btn-success btn-sm" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Tax_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-plus-sign"></span> Add Tax</a>
                   <a href="javascript:void(0)" class="btn btn-danger btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Tax_modifiable')!='1'){echo '" disabled ';}?> delete" id="">Delete</a>
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
                        <th>State</th>
                        <th>Tax Title</th>
                        <th>Total (%)</th>
<!--                        <th>status</th>-->
                        <th colspan="2" style="width: 12px">Action</th>
                    </tr>
                    
                    <?php if($products['res']){
                        $i=1;
                        foreach($products['rows'] as $product){
                            ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <td><input type="checkbox" value="<?=$product->id?>" class="innercheckbox" name="id[]"></td>
                      <td><?=$product->state?> (<?=$product->code?>)</td>
                      <td><?php echo $product->details; ?></td>
                      <td><?=$product->total?> </td>
<!--                      <td><?$product->status?></td>-->
                      <!--<td style="width: 6px"><a href="<?=BASE_URL?>admin/product/search?searchby=category&val=<?=$product->id?>" class="btn btn-info btn-sm" title="View products"><span class="glyphicon glyphicon-eye-open"></span></a></td>-->
                      <td style="width: 6px"><a href="<?=BASE_URL?>admin/tax/edit/<?=$product->id?>" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Tax_modifiable')!='1'){echo 'disabled onClick="return false;"';}?> class="btn btn-warning btn-sm" title="Edit tax"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    </tr>
                    
                    <?php $i++;} ?>
                    <tr>
                        <td colspan="11">
                            <div class="pull-right">
                                <a href="<?=BASE_URL?>admin/tax/add" class="btn btn-success btn-sm" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Tax_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>><span class="glyphicon glyphicon-plus-sign"></span> Add Tax</a>
<!--                                <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>-->
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Tax_modifiable')!='1'){echo '" disabled ';}?> delete" id="">Delete</a>
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


