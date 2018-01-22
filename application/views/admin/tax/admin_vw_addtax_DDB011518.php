<section class="content-header">
    <h1>
     Manage Tax
     <small><?php if($editform){ $editdata1=$editdata['rows'][0]; $submiturl=BASE_URL.'admin/tax/edit/'.$editdata1->id; ?> edit <?php }else{ $submiturl=BASE_URL.'admin/tax/add'; ?>add <?php } ?> </small>
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
              <!--<a href="<?=BASE_URL?>admin/category/add" class="btn btn-primary btn-sm pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Add Category</a>->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=$submiturl?>">
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Select State</label></div>
                  <div class="col-sm-9">
                    <select class="form-control" id="state" name="state">
                        <option value="">-------Select State-------</option>
                        <?php foreach($states as $state){ ?>
                        <option value="<?php echo $state->id;?>" <?php if($editform){if($editdata1->state_id==$state->id){echo "selected";}} ?> <?php echo set_select('state', $state->id); ?> ><?php echo $state->state;?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php if(form_error('state')!='') echo form_error('state','<div class="text-danger err">','</div>'); ?>
                <span class="text-danger" id="state_error"></span>
                </div>  
                        
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Tax Title</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="details" value="<?php if(set_value('details')!=''){echo set_value('details');}else if($editform){echo $editdata1->details;}?>" name="details" placeholder="Tax Title">
                      <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="details_error"></span>

                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Total (In %)</label></div>
                  <div class="col-sm-9">          
                        <div class="input-group">
                            <input type="text" class="form-control" id="total" value="<?php if(set_value('total')!=''){echo set_value('total');}else if($editform){echo $editdata1->total;}?>" name="total" placeholder="Total" onkeyup="checknumber(this.id,this.value)">
                            <span class="input-group-addon" id="basic-addon1">%</span>
                        </div>
                      <?php if(form_error('total')!='') echo form_error('total','<div class="text-danger err">','</div>'); ?>
                      <span class="text-danger" id="total_error_nume"></span>
                  </div>
                  <span class="text-danger" id="total_error"></span>
                </div>
                  
                

<!--                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                  <div class="col-sm-9">
                      <select class="form-control" id="status" name="status">
                            <option value="Active" <?php //echo set_select('status', "Active"); ?> >Active</option>
                            <option value="Inactive" <?php //echo set_select('status', 'Inactive'); ?> >Inactive</option>
                    </select>
                      <?php //if(form_error('category')!='') echo form_error('category','<div class="text-danger err">','</div>'); ?>
                  </div>


                </div>-->
                        
                            
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="add_category" class="btn btn-primary pull-right">Submit</button>
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
            var state = $("#state").val().trim();
            var details = $("#details").val().trim();
            var total = $("#total").val().trim();
            if(state == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#state").focus();
                    $("#state_error").parent().addClass("has-error");
                    return false;    
              }
              if(details == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#details").focus();
                    $("#details_error").parent().addClass("has-error");
                    return false;    
              }
              if(total == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#total").focus();
                    $("#total_error").parent().addClass("has-error");
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