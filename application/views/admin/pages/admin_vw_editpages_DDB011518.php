<?php $category=$category['rows'][0];?>
<section class="content-header">
    <h1>
     Manage pages
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
                <h3 class="box-title"><?=$category->page?></h3>   
              <!--<a href="<?=BASE_URL?>admin/category/add" class="btn btn-primary btn-sm pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Add Category</a>->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/pages/update">       
                  <input type="hidden" name="id" value="<?=$category->id?>">
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="name">Page Content</label></div>
                  <div class="col-sm-9">          
                      <textarea class="form-control" id="name" name="name" placeholder="Page content"><?=$category->content?></textarea>
                      <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                  </div>
                  <span class="text-danger" id="name_error"></span>

                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                  <div class="col-sm-9">
                      <select class="form-control" id="status" name="status">
                            <option value="1" <?php echo set_select('status', "1"); ?> <?php if($category->status=='1'){echo "selected";} ?> >Active</option>
                            <option value="0" <?php echo set_select('status', '0'); ?> <?php if($category->status=='0'){echo "selected";} ?> >Inactive</option>
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
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
                //"advlist   lists print preview  preview    spellchecker",
                //"searchreplace wordcount visualblocks visualchars code  ",
                "table contextmenu directionality emoticons  textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: " newdocument fullpage | cut copy paste | undo redo | bold italic   | alignleft aligncenter alignright alignjustify |"
        ,toolbar2:" fontselect fontsizeselect | forecolor backcolor"
       // ,toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        //toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft"

});
</script>
<script>
    /*$(document).ready(function(){
        $("#add_category").click(function(){
            var name = $("#name").val().trim();
            if(name == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#name").focus();
                    $("#name_error").parent().addClass("has-error");
                    return false;    
              }
              return true;
        });
    });*/
</script>