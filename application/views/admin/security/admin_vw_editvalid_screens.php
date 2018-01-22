<?php $valid_screen=$valid_screens['rows'][0];?>
<section class="content-header">
    <h1>
     Manage Valid Screens
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
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/security/update_valid_screen">       
                  <input type="hidden" name="id" value="<?=$valid_screen->id?>">
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Valid Screen Name</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="name" value="<?=$valid_screen->screen_name?>" name="name" placeholder="Valid Screen Name">
                      <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="name_error"></span>

                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Screen Description</label></div>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" id="description" value="<?=$valid_screen->screen_description?>" name="description" placeholder="Screen Description">
                      <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="name_error"></span>

                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                  <div class="col-sm-9">
                      <select class="form-control" id="status" name="status">
                            <option value="Active" <?php echo set_select('status', "Active"); ?> <?php if($valid_screen->status=='Active'){echo "selected";} ?> >Active</option>
                            <option value="Inactive" <?php echo set_select('status', 'Inactive'); ?> <?php if($valid_screen->status=='Inactive'){echo "selected";} ?> >Inactive</option>
                    </select>
                      <?php if(form_error('valid_screen')!='') echo form_error('valid_screen','<div class="text-danger err">','</div>'); ?>
                  </div>


                </div>
                        
                            
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
