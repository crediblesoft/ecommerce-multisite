<section class="content-header">
    <h1>
     Assign Screens to Rolls
     <small>add</small>
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
            </div>
			<div class="box-body">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>admin/security/addassign_screen_security">
           <input type="hidden" name="role_id" value="<?=$valid_screens['rows'][0]->role_id?>">
                        <div class="form-group required">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Screens</label></div>
                              <div class="col-sm-9">
                                  <select class="form-control" id="Type" name="Type">
                                    <option value="">----Select Screen-----</option>
                                    <?php
                                        if($valid_screens['res']){
                                            foreach($valid_screens['rows'] as $screen){
                                        
                                    ?>
                                        <option value="<?=$screen->val_id?>" <?php echo set_select('Type', $screen->val_id); ?> ><?=$screen->screen_name?></option>
                                        <?php } } ?>
                                </select>
                                  <?php if(form_error('Type')!='') echo form_error('Type','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="Type_error"></span>
                                  
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Status</label></div>
                              <div class="col-sm-9">
                                  <select class="form-control" id="status" name="status">
                                        <option value="Active" <?php echo set_select('status', "Active"); ?> >Active</option>
                                        <option value="Inactive" <?php echo set_select('status', 'Inactive'); ?> >Inactive</option>
                                </select>                                  
                              </div>
                            </div>
                            <div class="form-group">        
                              <div class="col-sm-offset-9 col-sm-3">
                                  <button type="submit" id="recipebtn" class="btn btn-success btn-block">Add</button>
                              </div>
                            </div>
                       </form>
					  </div>
					  <div class="box-footer clearfix">                
                      </div>
					  </div>
					  </div>
                </div>   
</section>
