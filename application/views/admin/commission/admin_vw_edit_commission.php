<section class="content-header">
    <h1>
     Manage Admin Commission
     <small><?php if($editform){ $editdata1=$editdata['rows'][0]; $submiturl=BASE_URL.'admin/commission/edit/'.$editdata1->id; }?>Edit</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
            <!-- /.box-header -->
            <div class="box-body">
                
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=$submiturl?>">
                <div class="form-group">
                    <div class="col-sm-3 "><label class="control-label" for="name">Commission For Premium Users</label></div>
                  <div class="col-sm-6">          
                      <input type="text" class="form-control" id="comm_for_premium" value="<?php if(set_value('comm_for_premium')!=''){echo set_value('comm_for_premium');}else if($editform){echo $editdata1->comm_for_premium;}?>" name="comm_for_premium" placeholder="Commission For Premium Users">
                      <?php if(form_error('comm_for_premium')!='') echo form_error('comm_for_premium','<div class="text-danger err">','</div>'); ?>
                  </div><span>(In Percentage)</span>
                  <span class="text-danger" id="comm_for_premium_error"></span>

                </div> 
                <div class="form-group">
                    <div class="col-sm-3"><label class="control-label" for="name">Commission For Free Users</label></div>
                  <div class="col-sm-6">          
                      <input type="text" class="form-control" id="comm_for_freeuser" value="<?php if(set_value('comm_for_freeuser')!=''){echo set_value('comm_for_freeuser');}else if($editform){echo $editdata1->comm_for_freeuser;}?>" name="comm_for_freeuser" placeholder="Commission For Free Users">
                      <?php if(form_error('comm_for_freeuser')!='') echo form_error('comm_for_freeuser','<div class="text-danger err">','</div>'); ?>
                     
                  </div><span>(In Percentage)</span>
                  <span class="text-danger" id="comm_for_freeuser_error"></span>

                </div>
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="add_category" class="btn btn-primary pull-right" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Campaign Commission_modifiable')!='1'){echo 'disabled onClick="return false;"';}?>>Update</button>
                  </div>
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
    $(document).ready(function(){
        $("#add_category").click(function(){
            var premium_user = $("#comm_for_premium").val().trim();
            var free_user = $("#comm_for_freeuser").val().trim();
            if(premium_user == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#comm_for_premium").focus();
                    $("#comm_for_premium_error").parent().addClass("has-error");
                    return false;    
              }
              if(free_user == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#comm_for_freeuser").focus();
                    $("#comm_for_freeuser_error").parent().addClass("has-error");
                    return false;    
              }
             return true;
        });
        
    });
    
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_nume").html("Enter Only Numeric Value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            //return false;
        }else{
            if(value>100){ $("#"+id+"_error_nume").html("Not more then 100%");$("#"+id+"_error").parent().addClass("has-error");}
            else{$("#"+id+"_error_nume").html("");$("#"+id+"_error").parent().removeClass("has-error");}
            $("#"+id).focus();
        }}else{
            $("#"+id+"_error_nume").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
</script>
