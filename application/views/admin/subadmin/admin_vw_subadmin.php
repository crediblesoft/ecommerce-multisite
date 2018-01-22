<section class="content-header">
    <h1>
     Manage Sub-Admin
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
              <div class="pull-right">
              <a href="<?=BASE_URL?>admin/subadmin/add" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add Subadmin</a>
<!--              <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
              <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>-->
              <!--<a href="javascript:void(0)" class="btn btn-danger btn-sm delete" id="">Delete</a>-->
              </div>
              
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <!--<th style="width: 10px"><input type="checkbox" id="select-all">&nbsp;</th>-->
                        <th>Username</th>
                        <th>Email-id</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Security Role</th>
                        <th>Status</th>
                        <th colspan="3" style="width: 12px">Actions</th>
                    </tr>
                    
                    <?php if($promotion['res']){   
                        $currentdate=date('Y-m-d');
                        $i=1;
                        foreach($promotion['rows'] as $product){
                            ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <!--<td><input type="checkbox" value="<?=$product->id?>" class="innercheckbox" name="id[]"></td>-->
                      <td><?=$product->username?></td>
                      <td><?=$product->email_id?></td>
                      <td><?=$product->first_name?></td>
                      <td><?=$product->last_name?></td>
                      <td><?=$product->role_name?></td>
                      <td><?=($product->status)?"Active":"In-active";?></td>
                      <td>
					  <?php if($product->status=='0'){?>
					  <a href="javascript:void(0)" class="btn btn-success btn-xs featured" id="<?="ac_".$product->id?>">Active</a>
					  <?php }else{?>
                      <a href="javascript:void(0)" class="btn btn-danger btn-xs un_featured" id="<?="ina_".$product->id?>">In-Active</a>
					  <?php }?>
					  </td>
                      <td style="width: 6px"><a href="<?=BASE_URL?>admin/subadmin/details/<?=$product->id?>" class="btn btn-info btn-sm" title="View Details"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                      <td style="width: 6px">
                          <a href="<?=BASE_URL?>admin/subadmin/edit/<?=$product->id?>" class="btn btn-warning btn-sm" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                      </td>   
                    </tr>
                    
                    <?php $i++;} ?>
                    <tr>
                        <td colspan="11">
                            <div class="pull-right">
                                <a href="<?=BASE_URL?>admin/subadmin/add" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add Subadmin</a>
<!--                                <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>-->
                                <!--<a href="javascript:void(0)" class="btn btn-danger btn-sm delete" id="">Delete</a>-->
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
        <h4 class="modal-title">Active Subadmin</h4>
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
        <h4 class="modal-title">Active Subadmin</h4>
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
        <h4 class="modal-title">In-Active Subadmin</h4>
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
        <h4 class="modal-title">In-Active Subadmin</h4>
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



<script> 
  
    $(document).ready(function(){
        var currentid;
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        
        $(".featured").click(function(){
//            if(!$(".innercheckbox").is(':checked')){
//                $("#un_che_featured_user_deletemsg").html("Please select at least one category.");
//                $("#un_che_featured_user_model").modal("show");
//            }else{
//                 $("#featured_user_deletemsg").html("Do you want to active selected category(ies)?");
//                 $("#featured_user_model").modal("show");
//            }
                var id=$(this).attr("id");
                currentid=id.split("_")[1];
            $("#featured_user_deletemsg").html("Do you want to active this Subadmin?");
            $("#featured_user_model").modal("show");
        });
        
        $(document).on("click","#cnf2featured",function(){
            var selectedmail=[];
//            $('input:checkbox.innercheckbox').each(function () {
//                var sThisVal = (this.checked ? $(this).val() : "");
//                if(sThisVal!=""){
//                    selectedmail.push(sThisVal);
//                }
//            });
            selectedmail.push(currentid);
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/subadmin/active",{selectedmail:selectedmail},function(data,status){
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
//            if(!$(".innercheckbox").is(':checked')){
//                $("#un_che_un_featured_user_deletemsg").html("Please select at least one category.");
//                $("#un_che_un_featured_user_model").modal("show");
//            }else{
//                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected category(ies)?");
//                 $("#un_featured_user_model").modal("show");
//            }
               var id=$(this).attr("id");
            currentid=id.split("_")[1];
            $("#un_featured_user_deletemsg").html("Do you want to in-active this Subadmin?");
            $("#un_featured_user_model").modal("show");
        });
        
        $(document).on("click","#cnf2un_featured",function(){
            var selectedmail=[];
//            $('input:checkbox.innercheckbox').each(function () {
//                var sThisVal = (this.checked ? $(this).val() : "");
//                if(sThisVal!=""){
//                    selectedmail.push(sThisVal);
//                }
//            });
            //alert(selectedmail.length);
            selectedmail.push(currentid);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/subadmin/inactive",{selectedmail:selectedmail},function(data,status){
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
        
        
    });
</script>


