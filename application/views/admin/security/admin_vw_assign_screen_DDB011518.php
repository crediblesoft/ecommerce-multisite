
<section class="content-header">
    <h1>
     Assign Screens to Rolls
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

<div class="pull-left">
<div class="form-group">
                     <label for="email">Security Roles:</label>
                      <select class="form-control" name="category" id="category">
                                    <?php
                                        if($roles['res']){
                                            foreach($roles['rows'] as $role){

                                    ?>
                                        <option value="<?=$role->id?>"<?php if($screens['rows'][0]->role_id==$role->id){echo "selected";} ?>><?=$role->role_name?></option>
                                        <?php } } ?>

                      </select>
</div> &nbsp;
</div>
              <div class="pull-right">
              <a href="<?=BASE_URL?>admin/security/addassign_screen_security/<?=$screens['rows'][0]->role_id?>/<?=$screens['rows'][0]->val_id?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add Screen</a>
              <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
              <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
              <!--<a href="javascript:void(0)" class="btn btn-danger btn-sm delete" id="">Delete</a>-->
              </div>
              
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 10px"><input type="checkbox" id="select-all">&nbsp;</th>
                        <th>Screen Name</th>
                        <th>Screen Description</th>
                        <th>Status</th>
                    </tr>
                    
                    <?php if($screens['res']){
                        $i=1;
                        foreach($screens['rows'] as $screen){
                            ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <td><input type="checkbox" value="<?=$screen->security_id?>" class="innercheckbox" name="id[]"></td>
                      <td><?=$screen->screen_name?></td>
                      <td><?php echo substr($screen->screen_description,0,90); if(count($screen->screen_description)>50){echo "...";} ?></td>
                      <?php if($screen->security_status=='Active') { ?>
                      <td><p style="color:blue"><?=$screen->security_status?></p></td>
                      <?php } else { ?>
                      <td><p style="color:red"><?=$screen->security_status?></p></td>
                      <?php }?>
                    </tr>
                    
                    <?php $i++;} ?>
                    <tr>
                        <td colspan="11">
                            <div class="pull-right">
                                <a href="<?=BASE_URL?>admin/security/addassign_screen_security/<?=$screens['rows'][0]->role_id?>/<?=$screens['rows'][0]->val_id?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add Screen</a>
                                <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
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
        <h4 class="modal-title">Active Role Screen</h4>
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
        <h4 class="modal-title">Active Role Screen</h4>
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
        <h4 class="modal-title">In-Active Role Screen</h4>
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
        <h4 class="modal-title">In-Active Role Screen</h4>
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
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        

      $(document).on("change","#category",function(){
            var roleidval=$("#category").val();
           //alert("Role "+roleidval);
          window.location.href = '<?=BASE_URL?>admin/security/getrolelist'+'/'+roleidval;
       //     $.post("<?=BASE_URL?>admin/security/getrolelist",{roleidval:roleidval},function(data,status){
             //  var obj = jQuery.parseJSON(data);
            //alert("Data from getrolelist "+obj);
           // });
      });


        $(".featured").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_featured_user_deletemsg").html("Please select at least one Role Screen.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to active selected Role Screen(s)?");
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
            $.post("<?=BASE_URL?>admin/security/active_role_screen",{selectedmail:selectedmail},function(data,status){
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
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one Role Screen.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected Role Screen(s)?");
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
            $.post("<?=BASE_URL?>admin/security/inactive_role_screen",{selectedmail:selectedmail},function(data,status){
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


