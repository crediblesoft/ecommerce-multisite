<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Users
     <small>view</small>
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
                <h3 class="box-title"><?php echo ucfirst($usertype2); ?> List</h3>
<!--                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="primary">Seller</button>
                    <input type="checkbox" class="hidden" />
                </span>
              
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="primary">Buyer</button>
                    <input type="checkbox" class="hidden" />
                </span>-->
				<?php 
				$ut=$this->uri->segment(2);
				$pu=$this->uri->segment(3);
				
				?>
                <form class="form-inline" role="form" action="<?=BASE_URL?>admin/users/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="username" <?php if($this->input->get('searchby')=='username'){echo "selected";} ?> >Username/Name/Email-id</option>
<!--                          <option value="name" <?php if($this->input->get('searchby')=='name'){echo "selected";} ?> >Name</option>
                          <option value="email" <?php if($this->input->get('searchby')=='email'){echo "selected";} ?> >Email-id</option>-->
                          <!--<option value="mobile" <?php if($this->input->get('searchby')=='mobile'){echo "selected";} ?> >Mobile</option>-->
						  <option value="bussi_name" <?php if($this->input->get('searchby')=='bussi_name'){echo "selected";} ?> <?php if($ut=='buyer' || $pu=='penaltybuyer'){?>style="display:none;"<?php }?>>Business name</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Product Name</label>
                        <input type="text" class="form-control search_form_display" id="username" name="val" placeholder="Username/Name/Email-id" disabled="">
						<input type="text" class="form-control search_form_display" id="bussi_name" name="val" placeholder="Business name" disabled="">
                    </div>
                    
                    <input type="hidden" value="<?php echo $usertype2;?>" name="usertype">
                    
                    <button type="submit" class="btn btn-default" id="search">Search</button>
                    
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Users_enable')!='1'){echo '" disabled ';}?> active1" id="">Active</a>
                     <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Users_enable')!='1'){echo '" disabled ';}?> in_active" id="">In-Active</a>
                    <?php if($usertype=='seller'){ ?>
                    <a href="<?=BASE_URL?>admin/buyer" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Buyers</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Users_modifiable')!='1'){echo '" disabled ';}?> featured" id="">Featured</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Users_modifiable')!='1'){echo '" disabled ';}?> un_featured" id="">Un-Featured</a>
                    <?php }else{ ?>
                    <a href="<?=BASE_URL?>admin/buyer" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Buyers</a>
                    <a href="<?=BASE_URL?>admin/users/penaltybuyer" class="btn btn-info btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Penalty Buyer</a>
                    <a href="<?=BASE_URL?>admin/seller" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Seller</a>
                    <?php } ?>
                </div>
                </form>
                
                 

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 10px"><input type="checkbox" id="select-all">&nbsp;</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
			<?php if($usertype=='seller'){ ?>
                        <th width="7%">Featured</th>
			<?php } ?>
			<th width="7%">Status</th>
                        <th width="5%">View</th>
                    </tr>
                    
                    <?php if($users['res']){
                        $i=1;
                        foreach($users['rows'] as $user){ 
                                
                                
                                if($user->featured==1){
                                    $featured='Yes';
                                }else{
                                    $featured='No';
                                }
                            ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <td><input type="checkbox" value="<?=$user->id?>" class="innercheckbox" name="id[]"></td>
                      <td><?=$user->username?></td>
                      <td><?=$user->f_name.''.$user->l_name?></td>
                      <td><?=$user->email_id?></td>
                      <td><?=$user->mobile_no?></td>
			<?php if($usertype=='seller'){ ?>
                      <td><?=$featured?></td>
			<?php } ?>
			<td><?php if($user->status==1){echo "Active";}else{echo "In-active";} ?></td>
                      <td><a href="<?=BASE_URL?>admin/users/details/<?=$user->id?>" class="btn btn-info btn-sm" title="View details"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                      
                    </tr>
                    
                    <?php $i++;}?>
                    <tr>
                        <td colspan="11">
                            <div class="pull-right">
                     <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Users_enable')!='1'){echo '" disabled ';}?> active1" id="">Active</a>
                     <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Users_enable')!='1'){echo '" disabled ';}?> in_active" id="">In-Active</a>
                    <?php if($usertype=='seller'){ ?>
                    <a href="<?=BASE_URL?>admin/buyer" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Buyers</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Users_modifiable')!='1'){echo '" disabled ';}?> featured" id="">Featured</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm <?php if($this->session->userdata(ADMIN_SESS.'admin_type')!='1' && $this->session->userdata(ADMIN_SESS.'Manage Users_modifiable')!='1'){echo '" disabled ';}?> un_featured" id="">Un-Featured</a>
                    <?php }else{ ?>
                    <a href="<?=BASE_URL?>admin/buyer" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Buyers</a>
                    <a href="<?=BASE_URL?>admin/users/penaltybuyer" class="btn btn-info btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Penalty Buyer</a>
                    <a href="<?=BASE_URL?>admin/seller" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Seller</a>
                    <?php } ?>
                            </div>   
                        </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                        <td colspan="11"><p class="text-danger">No record found.</p></td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
               <?=$links?>
              </ul>
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>



<!-- Modal -->
<div id="active_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active User</h4>
      </div>
      <div class="modal-body">
          <h4 id="active_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2active">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_active_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active User</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_active_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Modal -->
<div id="in_active_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">In-Active User</h4>
      </div>
      <div class="modal-body">
          <h4 id="in_active_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2in_active">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_in_active_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">In-Active User</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_in_active_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!----------------------------------------------->

<!-- Modal -->
<div id="featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Featured User</h4>
      </div>
      <div class="modal-body">
          <h4 id="featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2featured">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Featured User</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<!-- Modal -->
<div id="un_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Un-Featured User</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2un_featured">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_un_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Un-Featured User</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_un_featured_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script> 
    
    $(document).ready(function(){
        var selectedval=$("#searchby").val();
        search(selectedval);
        if(selectedval=='username'){
            $("#username").val("<?=$this->input->get('val')?>");
        }
		
		else if(selectedval=='bussi_name'){
            $("#bussi_name").val("<?=$this->input->get('val')?>");
        }
        
        $(document).on("change","#searchby",function(){
            selectedval=$(this).val();
            search(selectedval); 
        }); 
        
        $(document).on("click","#search",function(){
            var selectedval=$("#searchby").val();
            if(selectedval==''){
                $("#error_search").html("Please select any one");
                return false;
            }
            return true;
        });
    });
    
    
    function search(selectedval){
        $("#username").addClass("search_form_display");
        $("#bussi_name").addClass("search_form_display");
//        $("#from").addClass("search_form_display");
//        $("#to").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='username'){
            $("#username").removeClass("search_form_display");
            $("#username").prop("disabled",false);
            $("#username").focus();
            }
		else if(selectedval=='bussi_name'){
                $("#bussi_name").removeClass("search_form_display");
                $("#bussi_name").prop("disabled",false);
                $("#bussi_name").focus();
                
            }else{
                $("#username").addClass("search_form_display");
//                $("#usercategory").addClass("search_form_display");
//                $("#from").addClass("search_form_display");
//                $("#to").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
    
    
    $(document).ready(function(){
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        
        
        $(".active1").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_active_user_deletemsg").html("Please select at least one user.");
                $("#un_che_active_user_model").modal("show");
            }else{
                 $("#active_user_deletemsg").html("Do you want to active selected user(s)?");
                 $("#active_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2active",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/users/activeusers",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#active_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
        $(".in_active").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_in_active_user_deletemsg").html("Please select at least one user.");
                $("#un_che_in_active_user_model").modal("show");
            }else{
                 $("#in_active_user_deletemsg").html("Do you want to in-active selected user(s)?");
                 $("#in_active_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2in_active",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/users/inactiveusers",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#in_active_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
        //-------------------------------------------------------------------------
        
        $(".featured").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_featured_user_deletemsg").html("Please select at least one user.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to featured selected user(s)?");
                 $("#featured_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2featured",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/users/featured",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#featured_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
        $(".un_featured").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one user.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to un-featured selected user(s)?");
                 $("#un_featured_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2un_featured",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/users/unfeatured",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#un_featured_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
    });
    
    
    
    
    
    $(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length === 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});



    
</script>
