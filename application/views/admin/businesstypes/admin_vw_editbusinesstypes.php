<?php $business_type_names=$business_type_name['rows'][0];?>
<section class="content-header">
    <h1>
     Manage Business Types
     <small>edit</small>
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
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/businesstypes/update">       
                  <input type="hidden" name="id" value="<?=$business_type_names->id?>">
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Category Name</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="name" value="<?=$business_type_names->business_type_name?>" name="name" placeholder="Business Type Name">
                      <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="name_error"></span>

                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                  <div class="col-sm-9">
                      <select class="form-control" id="status" name="status">
                            <option value="Active" <?php echo set_select('status', "Active"); ?> <?php if($business_type_names->status=='Active'){echo "selected";} ?> >Active</option>
                            <option value="Inactive" <?php echo set_select('status', 'Inactive'); ?> <?php if($business_type_names->status=='Inactive'){echo "selected";} ?> >Inactive</option>
                    </select>
                      <?php if(form_error('business_type_names')!='') echo form_error('business_type_name','<div class="text-danger err">','</div>'); ?>
                  </div>


                </div>
                        
                            
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="add_category" class="btn btn-primary pull-right" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Business Types_modifiable')!='1'){echo 'disabled';}?>>Submit</button>
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
            var name = $("#name").val().trim();
            var description = $("#description").val().trim();
            if(name == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#name").focus();
                    $("#name_error").parent().addClass("has-error");
                    return false;    
              }
              return true;
        });
    });
</script>