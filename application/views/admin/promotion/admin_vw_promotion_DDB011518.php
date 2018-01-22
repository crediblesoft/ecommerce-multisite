<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Promotion Code
     <small>view</small>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="col-lg-10">
               <form class="form-inline" role="form" action="<?=BASE_URL?>admin/promotion/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="code" <?php if($this->input->get('searchby')=='code'){echo "selected";} ?> >Code</option>
                          <option value="adddate" <?php if($this->input->get('searchby')=='adddate'){echo "selected";} ?> >Promotion Date</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Promotional Code</label>
                        <input type="text" class="form-control search_form_display" id="code" name="val" placeholder="Promotional Code" disabled="">
                    </div>
          
          
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">From date</label>
                        <input type="text" class="form-control search_form_display" id="from" name="from" placeholder="From" disabled="">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">To date</label>
                        <input type="text" class="form-control search_form_display" id="to" name="to" placeholder="To" disabled="">
                    </div>
                    
                    <button type="submit" class="btn btn-default" id="search">Search</button>
                    
                <div class="pull-right">
                </div>
                </form> 
                </div> 
              <div class="pull-right col-lg-2">
              <a href="<?=BASE_URL?>admin/promotion/add" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add Promotion Code</a>
              </div>
              
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <!--<th style="width: 10px"><input type="checkbox" id="select-all">&nbsp;</th>-->
                        <th>Code</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>No of user</th>
                        <th>Status</th>
                        <th colspan="2" style="width: 12px">Active/In-active</th>
                        <th colspan="2" style="width: 12px">Action</th>
                    </tr>
                    
                    <?php if($promotion['res']){   
                        $currentdate=date('Y-m-d');
                        $i=1;
                        foreach($promotion['rows'] as $product){
                            ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <!--<td><input type="checkbox" value="<?=$product->id?>" class="innercheckbox" name="id[]"></td>-->
                      <td><?=$product->code?></td>
                      <td><?=$product->start_date?></td>
                      <td><?=$product->end_date?></td>
                      <td><?=$product->no_of_users?></td>
                      <td><?=($product->status)?"Active":"In-active";?></td>
                      <td><a href="javascript:void(0)" class="btn btn-success btn-xs featured" id="<?="ac_".$product->id?>">Active</a></td>
                      <td><a href="javascript:void(0)" class="btn btn-danger btn-xs un_featured" id="<?="ina_".$product->id?>">In-Active</a></td>
                      <td style="width: 6px"><a href="<?=BASE_URL?>admin/promotion/details/<?=$product->id?>" class="btn btn-info btn-sm" title="View Details"><span class="glyphicon glyphicon-eye-open"></span></a></td>
<!--                      <td style="width: 6px">
                          <?php if($currentdate<$product->start_date){ ?>
                          <a href="<?=BASE_URL?>admin/promotion/edit/<?=$product->id?>" class="btn btn-warning btn-sm" title="Edit promotion"><span class="glyphicon glyphicon-pencil"></span></a>
                          <?php } ?>
                      </td>-->
                      
                    <!-- start by ravi-->
                    <td style="width: 6px">
                       <a href="<?=BASE_URL?>admin/promotion/edit/<?=$product->id?>" class="btn btn-warning btn-sm" title="Edit promotion"><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                    <!-- end by ravi-->
                    </tr>
                    
                    <?php $i++;} ?>
                    <tr>
                        <td colspan="11">
                            <div class="pull-right">
                                <a href="<?=BASE_URL?>admin/promotion/add" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus-sign"></span> Add Promotion Code</a>
<!--                                <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>-->
                                <!--<a href="javascript:void(0)" class="btn btn-danger btn-sm delete" id="">Delete</a>-->
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
<div id="featured_user_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Active Category</h4>
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
        <h4 class="modal-title">Active Category</h4>
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
        <h4 class="modal-title">In-Active Category</h4>
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
        <h4 class="modal-title">In-Active Category</h4>
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
        var currentid;
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        
        $(".featured").click(function(){
//            if(!$(".innercheckbox").is(':checked')){
//                $("#un_che_featured_user_deletemsg").html("Please select at least one category.");
//                $("#un_che_featured_user_model").modal("show");
//            }else{
//                 $("#featured_user_deletemsg").html("Do you want to active selected category(ies)?");
//                 $("#featured_user_model").modal("show");
//            }
                var id=$(this).attr("id");
                currentid=id.split("_")[1];
            $("#featured_user_deletemsg").html("Do you want to active this promotion code?");
            $("#featured_user_model").modal("show");
        });
        
        $(document).on("click","#cnf2featured",function(){
            var selectedmail=[];
//            $('input:checkbox.innercheckbox').each(function () {
//                var sThisVal = (this.checked ? $(this).val() : "");
//                if(sThisVal!=""){
//                    selectedmail.push(sThisVal);
//                }
//            });
            selectedmail.push(currentid);
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/promotion/active",{selectedmail:selectedmail},function(data,status){
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
//            if(!$(".innercheckbox").is(':checked')){
//                $("#un_che_un_featured_user_deletemsg").html("Please select at least one category.");
//                $("#un_che_un_featured_user_model").modal("show");
//            }else{
//                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected category(ies)?");
//                 $("#un_featured_user_model").modal("show");
//            }
               var id=$(this).attr("id");
            currentid=id.split("_")[1];
            $("#un_featured_user_deletemsg").html("Do you want to in-active this promotion code?");
            $("#un_featured_user_model").modal("show");
        });
        
        $(document).on("click","#cnf2un_featured",function(){
            var selectedmail=[];
//            $('input:checkbox.innercheckbox').each(function () {
//                var sThisVal = (this.checked ? $(this).val() : "");
//                if(sThisVal!=""){
//                    selectedmail.push(sThisVal);
//                }
//            });
            //alert(selectedmail.length);
            selectedmail.push(currentid);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>admin/promotion/inactive",{selectedmail:selectedmail},function(data,status){
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
        if(selectedval=='code'){
            $("#code").val("<?=$this->input->get('val')?>");
        }
    
    
    else if(selectedval=='adddate'){
            $("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
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
        $("#code").addClass("search_form_display");
    
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
       // $("#bidstatus").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='code'){
            $("#code").removeClass("search_form_display");
            $("#code").prop("disabled",false);
            $("#code").focus();
            }
        else if(selectedval=='adddate'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
            }else{
                $("#code").addClass("search_form_display");
        $("#code").addClass("search_form_display");
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
            }
    }
    </script>
<script>
    //var $j = jQuery.noConflict();
    $(function(){
        $( "#from" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#to").datepicker("option", "minDate", dt);
            }
        });
        $( "#to" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#from").datepicker("option", "maxDate", dt);
            }
        });
    });
</script>

