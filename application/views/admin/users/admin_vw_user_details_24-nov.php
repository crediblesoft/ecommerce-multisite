<?php
    $user=$users['rows'][0];
    //echo "<pre>";
    //print_r($user); exit;
    if($user->type_Of_User==1){
        $usertype="Seller";
    }else if($user->type_Of_User==2){
        $usertype="Buyer";
    }else{
        $usertype="";
    }

    if($user->featured==1){
        $featured='Yes';
    }else{
        $featured='No';
    }
    
    if($user->paid==1){
        $userpaidstatus='Paid';
		$expiry=$user->expiry;
    }else{
        $userpaidstatus='Un-paid';
    }
?>

<section class="content-header">
    <h1>
     Manage Users
     <small>details</small>
    </h1>
<!--    <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
    </ol>-->
</section>

<!-- Main content -->
<section class="content">
    <input type="hidden" id="userid" value="<?=$user->id?>">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <div class="col-md-2 col-lg-2 col-sm-2">
                <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$user->profile_Pic?>" class="img img-responsive">
                
                </div>
                <div class="col-md-8 col-lg-8 col-sm-8">
                    <p class="user_last_login">Last Login : <?php if($user->login_time>0){ echo date("Y-m-d H:m:s",$user->login_time);}else{echo"No login yet.";}  ?></p>
                    <p class="vw_username"><?=$user->username?></>
                    <?php if($user->type_Of_User==1){ ?>
                     <?php if($storedata['res']){
                            if($user->status){
                         ?>   
                    <p><a href="<?=BASE_URL?><?=$user->username?>/Shope/user_profile" target="_blank" class="btn btn-warning">View shop</a></p>
                    <?php }else{echo "<p class='text-danger'>Currently,this user has In-active by admin</p>";}}else{echo "<p class='text-danger'>Currently,this user has no any shop</p>";} ?>
                    <?php  } ?>
                </div>
                <div class="col-md-2 col-lg-2 col-sm-2">
                    <div class="pull-right">
                        <?php if(!$user->status){ ?>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                        <?php }else{ ?>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr> 
                        <th>Username</th>
                        <td><?=$user->username?></td>
                    </tr>
                    <tr> 
                        <th>Name</th>
                        <td><?=$user->f_name.''.$user->l_name?></td>
                    </tr>
                    <tr> 
                        <th>Email</th>
                        <td><?=$user->email_id?></td>
                    </tr>
                    <tr> 
                        <th>Mobile</th>
                        <td><?=$user->mobile_no?></td>
                    </tr>
                     <tr> 
                        <th>Address</th>
                        <td><?=$user->address1?></td>
                    </tr>
                    <tr> 
                        <th>Zip Code</th>
                        <td><?=$user->zip?></td>
                    </tr>
                    <tr> 
                        <th>State</th>
                        <td><?=$user->statename?></td>
                    </tr>
                    <tr> 
                        <th>Usertype</th>
                        <td><?=$usertype?></td>
                    </tr>
            <?php if($usertype=="Seller"):?> 
                    <tr> 
                        <th>Featured</th>
                        <td><?=$featured?></td>
                    </tr>  

            <?php endif; ?>
<!--                    <tr> 
                        <th>User paid status</th>
                        <td><?=$userpaidstatus?></td>
                    </tr>-->
                    <?php if($usertype=="Seller"){?>
                    <tr> 
                        <th>User paid status</th>
                        <td><?=$userpaidstatus?></td>
                    </tr>
                      <?php }?>
                    <?php 
                    if($user->promocode!=""){?>
                    <tr> 
                        <th>Used PromoCode</th>
                        <td><?=$user->promocode;?></td>
                    </tr>  
                    <?php }?>
					
			<?php if($user->paid==1 && $usertype=="Seller"){ ?>
                    <tr> 
                        <th>Subscription expire date </th>
                        <td>
						<input type="text" class="" id="expdate" value="<?=$expiry?>" name="startdate">
						<input type="button" value="update" id="exp_update_btn" class="btn btn-primary btn-sm ">
						</td>
                    </tr>  
                    <?php }?> 
                    
                    <?php if($user->type_Of_User==1){ ?>
                    <tr> 
                        <th colspan="2"><p class="text-center">User Business Info</p></th>
                    </tr>
                    
                    <?php 
                        if($storedata['res']){
                        $businessinfo=$storedata['rows'][0];
                        if($businessinfo->certification==1){
                            $certification="Yes";
                        }else{
                            $certification="No";
                        }
                        
                        if($businessinfo->size==1){
                            $size="Small";
                        }else if($businessinfo->size==2){
                            $size="Medium";
                        }else if($businessinfo->size==3){
                            $size="Large";
                        }else{
                            $size='';
                        }
                    ?>
                    <tr> 
                        <th>Business Name</th>
                        <td><?=$businessinfo->business_name?></td>
                    </tr>
                    <tr> 
                        <th>Contact Person Name</th>
                        <td><?=$businessinfo->contact_person_name?></td>
                    </tr>
                    <tr> 
                        <th>Phone</th>
                        <td><?=$businessinfo->phone?></td>
                    </tr>
                    <tr> 
                        <th>Address</th>
                        <td><?=$businessinfo->address?></td>
                    </tr>
                    <tr> 
                        <th>Zip code</th>
                        <td><?=$businessinfo->zip?></td>
                    </tr>
                    <tr> 
                        <th>Certification</th>
                        <td><?=$certification?></td>
                    </tr>
                    <tr> 
                        <th>Size</th>
                        <td><?=$size?></td>
                    </tr>
                    <tr> 
                        <th>Income</th>
                        <td>$<?=$businessinfo->income?></td>
                    </tr>
                        <?php }else{ ?>
                    <tr> 
                        <td colspan="2"><p class="text-danger">Store not created yet.</p></td>
                    </tr>
                        <?php } ?>
                    
                    <?php } ?> 
                    
                </tbody>
              </table>
                <table class="table table-bordered">
                <?php if($user->type_Of_User==2){ if($datapenalty['res']){ ?>
                    <tr> 
                        <th colspan="5"><p class="text-center">Buyer Penalty Points</p></th>
                    </tr>
                    <tr> 
                        <th colspan="5">
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete pull-right" id="">Delete</a>
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 10px"><input type="checkbox" id="select-all">&nbsp;</th>
                        <th width="20%">Seller</th>
                        <th>Review</th>
                        <th width="15%">Date</th>
                    </tr>
                    <?php $i=1; foreach($datapenalty['rows'] as $penalty){ ?>
                    <tr> 
                        <td><?=$i?>.</td>
                        <td><input type="checkbox" value="<?=$penalty->id?>" class="innercheckbox" name="id[]"></td>
                        <td><a target="_blank" href="<?=BASE_URL?>admin/users/details/<?=$penalty->sellerid?>"><?php echo ucfirst($penalty->f_name).' '.ucfirst($penalty->l_name); ?></a></td>
                        <td><?php echo $penalty->review; ?></td>
                        <td><?php echo $penalty->rv_date; ?></td>
                    </tr>
                    <?php $i++; } ?>
                    <tr>
                        <td colspan="4">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?=$links?>
                            </ul>
                        </td>
                    </tr>
                    <?php  } } ?>
                    
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>

<!-- Modal -->
<div id="featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active User</h4>
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
<div id="un_featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">In-Active User</h4>
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





<div id="user_exp_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Subscription</h4>
      </div>
      <div class="modal-body">
          <h4 id="exp_msg"></h4>
      </div>
      
    </div>

  </div>
</div>


<!-- Modal -->
<div id="delete_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove Penalty Point</h4>
      </div>
      <div class="modal-body">
          <h4 id="delete_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2delete">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="un_che_delete_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove Penalty Point</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_che_delete_user_deletemsg"></h4>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script> 
$(function(){
        $( "#expdate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            
            }
        }); 
});
    $(document).ready(function(){
		$(document).on("click","#exp_update_btn",function(){
            var userid=$("#userid").val();
			var expdate=$("#expdate").val();
            if(expdate!=''){
            $.post("<?=BASE_URL?>admin/users/update_expiry",{userid:userid,expdate:expdate},function(data,status){
                    var obj= $.parseJSON(data);
                if(obj.status){
					    $("#user_exp_model").modal("show");
                        $("#exp_msg").empty().append(obj.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000); 
                    }
                });
            }else{
                return false;
            }
        });
		
		
		
		
		
		
		
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        
        $(".featured").click(function(){
            $("#featured_user_deletemsg").html("Do you want to active this user?");
            $("#featured_user_model").modal("show");
        });
        
        $(document).on("click","#cnf2featured",function(){
           var userid=$("#userid").val();
            var selectedmail=[];
            selectedmail.push(userid);
            if(selectedmail.length > 0){
                $.post("<?=BASE_URL?>admin/users/activeusers",{selectedmail:selectedmail},function(data,status){
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
                 $("#un_featured_user_deletemsg").html("Do you want to in-active this user?");
                 $("#un_featured_user_model").modal("show");
        });
        
        $(document).on("click","#cnf2un_featured",function(){
            var userid=$("#userid").val();
            var selectedmail=[];
            selectedmail.push(userid);
            if(selectedmail.length > 0){
                $.post("<?=BASE_URL?>admin/users/inactiveusers",{selectedmail:selectedmail},function(data,status){
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
      
        $(".delete").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_delete_user_deletemsg").html("Please select at least one review.");
                $("#un_che_delete_user_model").modal("show");
            }else{
                 $("#delete_user_deletemsg").html("Do you want to remove slected penalty point?");
                 $("#delete_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2delete",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
                var buyerid=$("#userid").val();
            $.post("<?=BASE_URL?>admin/users/removepenalty",{buyerid:buyerid,selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#delete_user_deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
    });
</script>
