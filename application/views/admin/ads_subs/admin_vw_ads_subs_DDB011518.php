<?php 
//echo "<pre>";
//print_r($categorylist); exit;
?>

<script type="text/javascript" src="<?=BASE_URL?>assets/js/jquery.tablesorter.js"></script> 
<link href="<?=BASE_URL?>assets/css/tablesorter.css" media="all" rel="stylesheet" type="text/css" />

<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Ads
     <small>view</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                
              <span class="text-danger" id="error_search"></span>
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/adssubscription/search" method="get">
                  <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
                 </div> 
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="seller" <?php if($this->input->get('searchby')=='seller'){echo "selected";} ?> >Seller</option>
	              </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Seller Name</label>
                        <input type="text" class="form-control search_form_display" id="seller" name="val" placeholder="Seller name" disabled="">
                    </div>
                     <button type="submit" class="btn btn-default" id="search">Search</button>
             
                </form>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="myTable" class="table table-bordered tablesorter">
                <thead> 
		<tr>
                        <th>#</th>
                        <th style="width: 30px;"><input type="checkbox" id="select-all">&nbsp;</th>
                        <th>Seller</th>
                        <th>Title</th>
                        <th>Paid Status</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                  </thead>  
                <tbody>
                    <?php if($categorylist['res']){
                        $i=1;
                        foreach($categorylist['rows'] as $adslist){
                                
                            ?>
							
                    <tr>
                      <td><?=$i?></td>
                      <td><input type="checkbox" value="<?=$adslist->id?>" class="innercheckbox" name="id[]"></td>
                      <td><?=$adslist->username;?></td>
                      <td><?=$adslist->title;?></td>
                      <?php 
                      if($adslist->paid_status==1){
                          $pstatus="Paid";
                      }
                      else{
                          $pstatus="Un-Paid";
                      }
                      ?>
                      <td><?=$pstatus;?></td>
                      <td><?=$adslist->ads_date;?></td>
                      <?php 
                      if($adslist->status==1){
                          $status="Active";
                      }
                      else{
                          $status="In-Active";
                      }
                      ?>
                       <td><?=$status;?></td>
                    </tr>
                    
                    <?php $i++;}?>
                    
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
<div id="featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active Social</h4>
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
        <h4 class="modal-title">Active Social</h4>
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
        <h4 class="modal-title">In-Active Social</h4>
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
        <h4 class="modal-title">In-Active Social</h4>
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



<!-- Modal -->
<div id="delete_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Social</h4>
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
        <h4 class="modal-title">Delete Social</h4>
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
$(document).ready(function(){
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        
        $(".featured").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_che_featured_user_deletemsg").html("Please select at least one Ads.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to active selected Ads(s)?");
                 $("#featured_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2featured",function(){
            var selectedads=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedads.push(sThisVal);
                }
            });
            //alert(selectedads.length);
            if(selectedads.length > 0){
            $.post("<?=BASE_URL?>admin/adssubscription/active",{selectedads:selectedads},function(data,status){
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
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one Ads.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected Ads(s)?");
                 $("#un_featured_user_model").modal("show");
            }
        });
        
        $(document).on("click","#cnf2un_featured",function(){
            var selectedads=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedads.push(sThisVal);
                }
            });
            //alert(selectedads.length);
            if(selectedads.length > 0){
            $.post("<?=BASE_URL?>admin/adssubscription/inactive",{selectedads:selectedads},function(data,status){
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
</script>    

<script> 
    $(document).ready(function(){
        var selectedval=$("#searchby").val();
        search(selectedval);
        if(selectedval=='seller'){
            $("#seller").val("<?=$this->input->get('val')?>");
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
        $("#seller").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='seller'){
            $("#seller").removeClass("search_form_display");
            $("#seller").prop("disabled",false);
            $("#seller").focus();
            }else{
                $("#seller").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
  </script>


