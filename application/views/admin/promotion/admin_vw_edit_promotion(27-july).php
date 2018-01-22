<section class="content-header">
    <h1>
     Manage Promotion Code
     <small>edit</small>
    </h1>
    <!--<ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dashboard</li>
        </ol>-->
</section>
<?php //print_r($assignusers);//print_r($assignusers);print_r($allusers); 
    $promotiondata=$promotion['rows'][0];
    if($assignusers['res']){
        foreach($assignusers['rows'] as $assign){
            $assignusers1[]=$assign->user_id;
        }
    }else{
        $assignusers1=array();
    }
?>
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
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/promotion/edit/<?=$promotiondata->id?>">
                        
                        
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Promotion Code</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="code" value="<?php if(set_value('code')!=''){echo set_value('code');}else{echo $promotiondata->code;}?>" name="code" placeholder="Random Number" >
                      <?php if(form_error('code')!='') echo form_error('code','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="name_error"></span>
                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Code Valid From</label></div>
                  <div class="col-sm-9" style="z-index:999">          
                      <input type="text" class="form-control" id="startdate" value="<?php if(set_value('startdate')!=''){echo set_value('startdate');}else{echo     $promotiondata->start_date;}?>" name="startdate" placeholder="Valid From">
                      <?php if(form_error('startdate')!='') echo form_error('startdate','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="startdate_error"></span>

                </div>
<!--                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Code Valid To</label></div>
                  <div class="col-sm-9" style="z-index:999">          
                      <input type="text" class="form-control" id="enddate" value="<?php if(set_value('enddate')!=''){echo set_value('enddate');}else{echo $promotiondata->end_date;}?>" name="enddate" placeholder="Valid To">
                      <?php if(form_error('enddate')!='') echo form_error('enddate','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="enddate_error"></span>

                </div>-->

                 <!-- code start by ravi -->
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Code Valid To</label></div>
                  <div class="col-sm-9" style="z-index:999">          
                      <select class="form-control" id="enddate" name="enddate">
                            <option value=""> Select End Date </option>
                            <option value="3" <?php if($promotiondata->duration==3){echo "selected";}?>  >3 Months</option>
                            <option value="6" <?php if($promotiondata->duration==6){echo "selected";}?>  >6 Months</option>
                            <option value="12" <?php if($promotiondata->duration==12){echo "selected";}?>  >1 Year</option>
                      </select>
                      <?php if(form_error('enddate')!='') echo form_error('enddate','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="enddate_error"></span>

                </div>
                <!-- code end by ravi -->    
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Discount</label></div>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="admin_comm" value="<?php if(set_value('admin_comm')!=''){echo set_value('admin_comm');}else{echo $promotiondata->discount;}?>" name="admin_comm" placeholder="Discount" onkeyup="checknumber(this.id,this.value)">
                            <span class="input-group-addon" id="basic-addon1">%</span>
                            <?php if(form_error('admin_comm')!='') echo form_error('admin_comm','<div class="text-danger err">','</div>'); ?>
                        </div>
                        <span class="text-danger" id="admin_comm_error_nume"></span>
                    </div>
                    <span class="text-danger" id="admin_comm_error"></span>
                    
                </div>
                  
                <div class="form-group">
                  <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Select Sellers</label></div>
                  <div class="col-sm-9">
                      <select class="form-control" id="users" name="users[]" multiple="">
                        <?php if($allusers['res']){ foreach($allusers['rows'] as $user){ ?>
                        <option value="<?=$user->id?>" <?php if(in_array($user->id,$assignusers1)){echo "selected";}?> <?php echo set_select('status', $user->id); ?> ><?=$user->username?></option>
                        <?php }} ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                  <div class="col-sm-9">
                    <select class="form-control" id="status" name="status">
                            <option value="1" <?php if($promotiondata->status==1){echo "selected";}?> <?php echo set_select('status', "1"); ?> >Active</option>
                            <option value="0" <?php if($promotiondata->status==0){echo "selected";}?> <?php echo set_select('status', '0'); ?> >Inactive</option>
                    </select>
                      <?php if(form_error('category')!='') echo form_error('category','<div class="text-danger err">','</div>'); ?>
                  </div>
                </div>
                        
                            
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="add_category" class="btn btn-primary pull-right">Update</button>
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
<link href="<?=BASE_URL?>assets/multiselect/css/bootstrap-multiselect.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?=BASE_URL?>assets/multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<style>.dropdown-menu{min-height: 300px !important;max-height: 300px !important;overflow-y: scroll !important;}
.multiselect-search{width:200px !important;}
</style>
<script>
    
    $(document).ready(function() {
        $('#users').multiselect(
		{
			enableCaseInsensitiveFiltering: true
		}
		);
    });
        
    $(function(){
        $( "#startdate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#enddate").datepicker("option", "minDate", dt);
            }
        });
        $( "#enddate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#startdate").datepicker("option", "maxDate", dt);
            }
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
    
    $(document).ready(function(){
        $("#add_category").click(function(){
            var code = $("#code").val().trim();
            var startdate = $("#startdate").val().trim();
            var enddate = $("#enddate").val().trim();
            var discount = $("#admin_comm").val().trim();
            if(code == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#code").focus();
                    $("#code_error").parent().addClass("has-error");
                    return false;    
              }
              if(startdate == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#startdate").focus();
                    $("#startdate_error").parent().addClass("has-error");
                    return false;    
              }
              if(enddate == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#enddate").focus();
                    $("#enddate_error").parent().addClass("has-error");
                    return false;    
              }
              if(discount == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#admin_comm").focus();
                    $("#admin_comm_error").parent().addClass("has-error");
                    return false;    
              }else if(discount>100){
                  $("#admin_comm_error_nume").html("Not more then 100%");
                  $("#admin_comm_error").parent().addClass("has-error");
                  return false; 
                   
              }
              return true;
        });
    });
</script>