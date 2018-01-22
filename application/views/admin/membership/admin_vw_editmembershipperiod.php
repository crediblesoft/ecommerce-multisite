<section class="content-header">
    <h1>
     Manage Membership Period
     <small>edit</small>
    </h1>

</section>
<?php $membership=$membership['rows'][0];?>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
             
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/Membership_period/update/<?=$membership->id?>">       
                  <input type="hidden" name="id" value="<?=$membership->id?>">
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="type">Type</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="type" value="<?=$membership->type?>" name="type" placeholder="Type">
                      <?php if(form_error('type')!='') echo form_error('type','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="type_error"></span>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="price">Price</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="price" value="<?=$membership->price?>" name="price" placeholder="Price">
                      <?php if(form_error('price')!='') echo form_error('price','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="price_error"></span>
                </div>  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="price">No of Days</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="noOfDays" value="<?=$membership->noOfDays?>" name="noOfDays" placeholder="No of Days">
                      <?php if(form_error('noOfDays')!='') echo form_error('noOfDays','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="noOfDays_error"></span>
                </div>    
                
                 
                            
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="edit_data" class="btn btn-primary pull-right" <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Membership Period_modifiable')!='1'){echo ' disabled ';}?>>Submit</button>
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
        $("#edit_data").click(function(){
            var type = $("#type").val().trim();
            var price = $("#price").val().trim();
            var noOfDays=$('#noOfDays').val().trim();
            if(type == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#type").focus();
                    $("#type_error").parent().addClass("has-error");
                    return false;    
              }
              if(price == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#price").focus();
                    $("#price_error").parent().addClass("has-error");
                    return false;    
              }
              if(noOfDays == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#noOfDays").focus();
                    $("#noOfDays_error").parent().addClass("has-error");
                    return false;    
              }
              return true;
        });
    });
    
    $('#price').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/g,'') ); }
    );
    $('#noOfDays').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/g,'') ); }
    );
</script>
