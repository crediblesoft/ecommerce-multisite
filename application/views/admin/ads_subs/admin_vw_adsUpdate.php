<?php $category=$category['rows'][0];?>
<section class="content-header">
    <h1>
     Manage Ads
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
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/adscreate/update/<?=$category->id?>">       
                  <input type="hidden" name="id" value="<?=$category->id?>">
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Ads Name</label></div>
                  <div class="col-sm-9">          
                      <input type="text" class="form-control" id="name" value="<?=$category->title?>" name="name" placeholder="Ads Name">
                      <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="name_error"></span>

                </div>
                  
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="days">Number Of Days</label></div>
                  <div class="col-sm-9">          
                     <input type="text" class="form-control" id="days" value="<?=$category->noofdays?>" name="days" placeholder="Number of Days">
                      <?php if(form_error('days')!='') echo form_error('days','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="days_error"></span>

                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="price">Price</label></div>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="price" value="<?=$category->price?>" name="price" placeholder="Ads Price">
                      <?php if(form_error('price')!='') echo form_error('price','<div class="text-danger err">','</div>'); ?>
                      
                  </div>
                    <span class="text-danger" id="days_error"></span>


                </div>
                        
                            
                <div class="form-group">        
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-9">
                      <button type="submit" id="add_ads" class="btn btn-primary pull-right">Submit</button>
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
        $("#add_ads").click(function(){
            var name = $("#name").val().trim();
            var days = $("#days").val().trim();
            var price = $("#price").val().trim();
           
            if(name == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#name").focus();
                    $("#name_error").parent().addClass("has-error");
                    return false;    
              }
              if(days == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#days").focus();
                    $("#days_error").parent().addClass("has-error");
                    return false;    
              }
              if(price == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#price").focus();
                    $("#price_error").parent().addClass("has-error");
                    return false;    
              }
              return true;
        });
    });
</script>