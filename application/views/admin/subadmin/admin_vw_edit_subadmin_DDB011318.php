<section class="content-header">
    <h1>
     Manage Sub-Admin
     <small>edit</small>
    </h1>
    <!--<ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dashboard</li>
        </ol>-->
</section>
<?php //print_r($assignusers);//print_r($assignusers);print_r($allusers); 
    $promotiondata=$promotion['rows'][0];
  
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
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/subadmin/edit/<?=$promotiondata->id?>">
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="uname">Username</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="uname" value="<?php if(set_value('uname')!=''){echo set_value('uname');}else{echo $promotiondata->username;}?>" name="uname" placeholder="Username">
                      <?php if(form_error('uname')!='') echo form_error('uname','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="uname_error"></span>
                </div>
				
				<div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="fname">First name</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="fname" value="<?php if(set_value('fname')!=''){echo set_value('fname');}else{echo $promotiondata->first_name;}?>" name="fname" placeholder="First Name">
                      <?php if(form_error('fname')!='') echo form_error('fname','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="fname_error"></span>
                </div>
                  
                
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Last name</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="lname" value="<?php if(set_value('lname')!=''){echo set_value('lname');}else{echo $promotiondata->last_name;}?>" name="lname" placeholder="Last Name">
                      <?php if(form_error('lname')!='') echo form_error('lname','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="lname_error"></span>
                </div>
				
				
				<div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Email</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="email" value="<?php if(set_value('email')!=''){echo set_value('email');}else{echo $promotiondata->email_id;}?>" name="email" placeholder="Email id">
                      <?php if(form_error('email')!='') echo form_error('email','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="email_error"></span>
                </div>
				
				<div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Password</label></div>
                  <div class="col-sm-9">          
                      <input type="password" class="form-control" id="password" value="<?php if(set_value('password')!=''){echo set_value('password');}else{echo $promotiondata->password2;}?>" name="password" placeholder="Password">
                      <?php if(form_error('password')!='') echo form_error('password','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="password_error"></span>
                </div>
                  
                
                
                
                <div class="form-group">
                  <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                  <div class="col-sm-9">
                    <select class="form-control" id="status" name="status">
                            <option value="1" <?php if($promotiondata->status==1){?>selected="selected"<?php }?> >Active</option>
                            <option value="0" <?php if($promotiondata->status==0){?>selected="selected"<?php }?> >Inactive</option>
                    </select>
                      
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
<style>.dropdown-menu{min-height: 300px !important;max-height: 300px !important;overflow-y: scroll !important;}</style>
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