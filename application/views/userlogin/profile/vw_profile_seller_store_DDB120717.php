<?php //print_r($userdata); ?>
<div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Profile</h4>
                    </div>
                </div>
            </div>
            <div class="">
                
                <div class="col-sm-12">
                    <div class="contant-head2">
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div class="img-responsive profile_img"> 
                                   <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userdata->profile_Pic?>" class="img-responsive"> 
                            </div>
                            
                            <form id="profile_pic_form" method="post" enctype = 'multipart/form-data' style="display: none;" action="<?=BASE_URL?>profile/updateprofilepic">
                                <input type="file" id="profile_pic" name="file">
                            </form> 
                        </div>

                        <div class="col-sm-9 col-md-9 col-lg-9">
                            <div class="col-sm-12 col-md-12 col-lg-12 contant-profile-inner-head"><?=$this->session->userdata('user_name')?></div>
                            <div class="col-sm-12 col-md-12 col-lg-12 contant-profile-inner-edit">
                                <p class="row col-md-5 col-lg-5 col-sm-5">Edit Profile Picture</p>
                                <p class="row col-md-3 col-lg-3 col-sm-3"><a href="javascript:void(0);" class="edit_profile_pic profile_pencil"><span class="glyphicon glyphicon-pencil"></span></a></p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 contant-profile-inner-edit">
                                <p class="row col-md-5 col-lg-5 col-sm-5">Edit Business Information</p>
                                <p class="row col-md-3 col-lg-3 col-sm-3"><a href="<?=BASE_URL?>profile/edit/<?=$this->session->userdata("user_id")?>" class="edit_business_info profile_pencil" ><span class="glyphicon glyphicon-pencil"></span></a></p>
                            </div>  
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12">
                <div class="contant-body1">
                <div class="col-sm-12 col-xs-12">
                
                <div id="wizard">
			<ol>
				<li>Basic Information</li>
                                <li>Selected Theme</li>
                                <li>Store Information</li>
                                <li>Social Media</li>
				
			</ol>
			<div>
				<?php if($res){ ?>
                                
                                            <div class="table-responsive">
                                                <table class="table cus-table">
                                                    <tr>
                                                        <td class="profile_heading">Account Type</td>
                                                        <td>:</td>
                                                        <td>Seller</td>
                                                      </tr>
                                                      
                                                      <tr>
                                                        <td class="profile_heading">Subscription</td>
                                                        <td>:</td>
                                                        <td><?php if($userdata->paid){echo "Premium User";}else{echo "Free User";} ?></td>
                                                      </tr>
                                                      
                                                      <tr>
                                                        <td class="profile_heading">Username</td>
                                                        <td>:</td>
                                                        <td><?=$userdata->username?></td>
                                                      </tr>

                                                      <tr>
                                                        <td class="profile_heading">First Name</td>
                                                        <td>:</td>
                                                        <td><?=$userdata->f_name?></td>
                                                      </tr>
                                                      
                                                      <tr>
                                                        <td class="profile_heading">Last Name</td>
                                                        <td>:</td>
                                                        <td><?=$userdata->l_name?></td>
                                                      </tr>

                                                      <tr>
                                                        <td class="profile_heading">Email</td>
                                                        <td>:</td>
                                                        <td><?=$userdata->email_id?></td>
                                                      </tr>
                                                      
                                                      <tr>
                                                        <td class="profile_heading">Mobile</td>
                                                        <td>:</td>
                                                        <td><?=$userdata->mobile_no?></td>
                                                      </tr>
                                                      
                                                      <tr>
                                                        <td class="profile_heading">State</td>
                                                        <td>:</td>
                                                        <td><?=$userdata->state?></td>
                                                      </tr>
                                                      
                                                      <tr>
                                                        <td class="profile_heading">Address</td>
                                                        <td>:</td>
                                                        <td><?=$userdata->address1?></td>
                                                      </tr>
                                                      
                                                </table>
                                            </div>
                                       
                                <?php } ?>
			</div>
                        <div>
                             <?php //print_r($theme); ?>
                            <div class="col-sm-12">
                                <span class="text-denger theme_head_error" id=""></span>  
                                <?php if($theme['rows'][0]->theam_id=='1001'){  ?>
                            <div class="col-sm-6">
                                <img src="<?=BASE_URL?>edit_assets/image/theme1/01.png"  id="1001"  style="border: 1px solid rgb(255, 24, 24);box-shadow: 0px 0px 16px 0px rgb(219, 11, 11);" class="img img-responsive theme">
                            </div>
                            <?php } ?>
                            <?php if($theme['rows'][0]->theam_id=='1002'){  ?>
                            <div class="col-sm-6">
                                <img src="<?=BASE_URL?>edit_assets/image/theme2/01.png"  id="1002"  style="border: 1px solid rgb(255, 24, 24);box-shadow: 0px 0px 16px 0px rgb(219, 11, 11);" class="img img-responsive theme"> 
                            </div>
                            <?php } ?>
                            </div>    
                        </div>
			<div>
                                <?php //print_r($businesstype);
                                    if($storedata['res']){
                                        
                                        $farmertype=0;
                                        if($businesstype['res']){ foreach($businesstype['rows'] as $businesstype2){
                                            if(strtolower($businesstype2->category)=='farmers'){
                                                $farmertype=1;
                                                $farmerid=$businesstype2->id;
                                            }
                                        }}
                                        
                                        $storeinfo=$storedata['rows'][0];
                                        $farmerinput=0;
                                        //print_r($storeinfo);
                                        if($userbusinesstype['res']){
                                            foreach($userbusinesstype['rows'] as $ubt){
                                                if($farmerid==$ubt->id){ $farmerinput=1;}
                                                $userbusinesstype1[]=ucfirst($ubt->category);
                                            }
                                            $userbusinesstype1=implode(',',$userbusinesstype1);
                                        }
                                  ?>      
                                
                                <div class="table-responsive">
                                                <table class="table cus-table">
                                                      <tr>
                                                        <td class="profile_heading">Business Type</td>
                                                        <td>:</td>
                                                        <td><?=$userbusinesstype1?></td>
                                                      </tr>
                                                    
                                                      <tr>
                                                        <td class="profile_heading">Business Name</td>
                                                        <td>:</td>
                                                        <td><?=$storeinfo->business_name?></td>
                                                      </tr>

                                                      <tr>
                                                        <td class="profile_heading">Contact Person Name</td>
                                                        <td>:</td>
                                                        <td><?=$storeinfo->contact_person_name?></td>
                                                      </tr>

                                                      <tr>
                                                        <td class="profile_heading">Phone</td>
                                                        <td>:</td>
                                                        <td><?=$storeinfo->phone?></td>
                                                      </tr>

                                                      <tr>
                                                        <td class="profile_heading">Address</td>
                                                        <td>:</td>
                                                        <td><?=$storeinfo->address?></td>
                                                      </tr>
                                                      
                                                      <tr>
                                                        <td class="profile_heading">Zip</td>
                                                        <td>:</td>
                                                        <td><?=$storeinfo->zip?></td>
                                                      </tr>
                                                      
<!--                                                      <tr>
                                                        <td>Account Number</td>
                                                        <td>:</td>
                                                        <td><?=$storeinfo->acc_no?></td>
                                                      </tr>
                                                      
                                                      <tr>
                                                        <td>Routing Number</td>
                                                        <td>:</td>
                                                        <td><?=$storeinfo->rout_no?></td>
                                                      </tr>-->
                                                      
                                                      <?php if($farmerinput){ ?>
                                                      <tr>
                                                        <td class="profile_heading">Income</td>
                                                        <td>:</td>
                                                        <td><?=$storeinfo->income?></td>
                                                      </tr>
                                                      <?php } ?>
                                                      
                                                </table>
                                                
                                            </div>
                                    <?php } ?>
			</div>
                    <div class="social1">
                            
                            <?php 
                                //print_r($socialdata);
                                if($socialdata['res']){
                                foreach($socialdata['rows'] as $social){
                                
                            ?>
                                <a href="<?=$social->url?><?=$social->link?>" target="_blank"><img src="<?=BASE_URL?>assets/image/social/<?=$social->image?>" title="<?=$social->title?>" height="50" width="50"></a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }} ?>
                               
			</div>
			
		</div>
                
            </div>
            </div>
            </div>                                
                                            
        </div>
        </div>
    
    </div>
</div>    


<!-- Modal -->
<div id="editaccoutn" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Account Info</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e_result_accinfo"></div></div>
          <form class="form-horizontal" id="store_form" role="form">
           <div class="form-group">
                <label class="control-label col-sm-3" for="address">A/c Number</label>
                <div class="col-sm-9">
                        <input type="text" class="form-control" id="acno" value="<?=$storeinfo->acc_no?>" name="acno" placeholder="Account Number" onkeyup="checknumber(this.id,this.value)">
                        
                    <?php if(form_error('acno')!='') echo form_error('acno','<div class="text-danger err">','</div>'); ?>
                    <span class="text-danger" id="acno_error_num"></span>
                </div>
                <span class="text-danger" id="acno_error"></span>
            </div>
                                    
            <div class="form-group">
                <label class="control-label col-sm-3 " for="address">Routing Number</label>
                <div class="col-sm-9"> 
                        <input type="text" class="form-control" id="routno" value="<?=$storeinfo->rout_no?>" name="routno" placeholder="Routing Number" onkeyup="checknumber(this.id,this.value)">
                        
                    <?php if(form_error('routno')!='') echo form_error('routno','<div class="text-danger err">','</div>'); ?>
                    <span class="text-danger" id="routno_error_num"></span>
                </div>
                <span class="text-danger" id="routno_error"></span>
            </div>
          </form>  
      </div>
      <div class="modal-footer clearfix"> 
          <button type="button" class="btn btn-success" id="update_accinfo" >Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="edit_business_info" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Business Info</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do You Want To Delete Product</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

        <script type="text/javascript">
	   $("#wizard").bwizard();
           
           $(document).ready(function(){
               <?php if(!$userdata->store_info){ ?>
                       //$(".next").addClass("disabled");
                       //$(".next").attr("aria-disabled",true);
               <?php } ?>  
                   //$(".next").hide();
                    //$(".previous").hide();
           });
	</script>
        
<script>
    $(document).ready(function(){
        $("#store-info").click(function(){
            var business_name = $("#business-name").val().trim();
            var contact_person = $("#contact-person").val().trim();
            var phone = $("#phone").val().trim();
            var address = $("#address").val().trim();

            if(business_name == ''){
                  //$("#fname_error").html("Enter Your First Name");
                  $("#business-name").focus();
                  $("#business-name_error").parent().addClass("has-error");
                  return false;    
            }

            if(contact_person == ''){
                  //$("#name_error").html("Enter Your First Name");
                  $("#contact-person").focus();
                  $("#contact-person_error").parent().addClass("has-error");
                  return false;    
            }

            if(phone == ''){
                  //$("#name_error").html("Enter Your First Name");
                  $("#phone").focus();
                  $("#phone_error").parent().addClass("has-error");
                  return false;    
            }

            if(address == ''){
                  //$("#name_error").html("Enter Your First Name");
                  $("#address").focus();
                  $("#address_error").parent().addClass("has-error");
                  return false;    
            }

            return true;
        });
        
        
        $(document).on('change', '.social-media', function () {
            var id=$(this).val();
            $.get("<?=BASE_URL?>profile/getsociallink/"+id,function(data,status){
                //console.log(data);
                var obj=$.parseJSON(data);
                console.log(obj.sociallink.url);
                if(obj.status){
                    $(".social-link").html(obj.sociallink.url);
                }    
            });
        });
        
        /*$(".social-media").change(function(){
            var id=$(this).val();
            $.get("<?=BASE_URL?>profile/getsociallink/"+id,function(data,status){
                //console.log(data);
                var obj=$.parseJSON(data);
                console.log(obj.sociallink.url);
                if(obj.status){
                    $("#social-link").html(obj.sociallink.url);
                }    
            });
        });*/
        
        $("#add_more").click(function(){
            var data=$("#main-social").html();
            $("#other-social").append(data);
        });
        
        
        
        $('.dropdown.keep-open').on({
            "shown.bs.dropdown": function() { this.closable = false; },
            "click":             function() { this.closable = true; },
            "hide.bs.dropdown":  function() { return this.closable; }
        });
        
        
        $(".edit_profile_pic").click(function(){
            $("#profile_pic").click();
        });
        
        $("#profile_pic").change(function(){
            $("#profile_pic_form").submit();
        });
        
        
        $("#update_accinfo").click(function(){
            var acno=$("#acno").val().trim();
            var routno=$("#routno").val().trim();
            var flag=true;
            if(acno == '' || acno == 0){
                  //$("#name_error").html("Enter Your First Name");
                  $("#acno").focus();
                  $("#acno_error").parent().addClass("has-error");
                  flag=false;
                  return false;    
            }

            if(routno == '' || routno ==0){
                  //$("#name_error").html("Enter Your First Name");
                  $("#routno").focus();
                  $("#routno_error").parent().addClass("has-error");
                  flag=false;
                  return false;    
            }
            
            
            if(flag){
                $.post('<?php echo BASE_URL;?>profile/update_acc_info',{acno:acno,routno:routno},function(data,status){
                    var obj= $.parseJSON(data);
                    if(obj.status){
                        $("#e_result_accinfo").empty().append(obj.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000); 
                    }else{
                        $("#e_result_accinfo").empty().append(obj.message).addClass("alert alert-danger fade in");
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                    }
                });
            }
            
        });
        
      });
      
      
      function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_num").html("Enter Only Numeric Value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            //return false;
        }}else{
            $("#"+id+"_error_num").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
</script>
