<script type="text/javascript" src="<?=BASE_URL?>assets/js/jquery.tablesorter.js"></script> 
<link href="<?=BASE_URL?>assets/css/tablesorter.css" media="all" rel="stylesheet" type="text/css" />

<style> 
    .search_form_display{ display: none !important; }
</style>
<section class="content-header">
    <h1>
     Manage Product
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
              <h3 class="box-title" style="margin-bottom: 17px;">Buy-directly Product List</h3>
              <span class="text-danger" id="error_search"></span>
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/product/search" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                          <option value="seller" <?php if($this->input->get('searchby')=='seller'){echo "selected";} ?> >Seller</option>
			  <option value="subscribe" <?php if($this->input->get('searchby')=='subscribe'){echo "selected";} ?> >Subscribed Seller</option>
			  <option value="unsubscribe" <?php if($this->input->get('searchby')=='unsubscribe'){echo "selected";} ?> >Unsubscribed seller</option>
                          <option value="category" <?php if($this->input->get('searchby')=='category'){echo "selected";} ?> >Category</option>
                          <option value="productname" <?php if($this->input->get('searchby')=='productname'){echo "selected";} ?> >Product Name</option>
                          <option value="adddate" <?php if($this->input->get('searchby')=='adddate'){echo "selected";} ?> >Add Date</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Product Name</label>
                        <input type="text" class="form-control search_form_display" id="product" name="val" placeholder="Product name" disabled="">
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Seller Name</label>
                        <input type="text" class="form-control search_form_display" id="seller" name="val" placeholder="Seller name" disabled="">
                    </div>
<!--                    <div class="form-group">
                        <label for="pwd" class="sr-only">Category</label>
                        <input type="text" class="form-control search_form_display" id="usercategory" name="val" placeholder="Category" disabled="">
                    </div>-->
                    <div class="form-group"> &nbsp;
                      <label for="pwd" class="sr-only" >Category</label>
                      <select class="form-control search_form_display" id="usercategory" name="val" disabled="">
                          <option value="">----Please Select----</option>
                      </select>
                    </div><!--
					
					
		<div class="form-group"> &nbsp;
                      <label for="pwd" class="sr-only" >Product Name</label>
                      <select class="form-control search_form_display" id="seller" name="val" disabled="">
                          <option value="">----Please Select----</option>
                      </select>
                    </div>-->
                    
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
                    <a href="<?=BASE_URL?>admin/bidproduct" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Bid products</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
                </div>
                </form>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="myTable" class="table table-bordered tablesorter">
                <thead> 
				<tr>
                        <th style="width: 10px" data-sorter="false">#</th>
                        <th style="width: 30px"><input type="checkbox" id="select-all">&nbsp;</th>
                        <th>Seller</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Add date</th>
			<th>Sold Qty</th>
			<th>Available Qty</th>
                        <th>status</th>
                        <th>View</th>
                    </tr>
                  </thead>  
				  <tbody>
                    <?php if($products['res']){
                        $i=1;
                        foreach($products['rows'] as $product){
                                if($product->admin_status==1){
                                    $admin_status="Active";
                                }else{
                                    $admin_status="In-active";
                                }
                            ?>
							
                    <tr>
                      <td><?=$i?></td>
                      <td><input type="checkbox" value="<?=$product->id?>" class="innercheckbox" name="id[]"></td>
                      <td><?=$product->username?></td>
                      <td><?=$product->category?></td>
                      <td><?=$product->prod_name?></td>
                      <td>$<?=$product->prod_price?></td>
                      <td><?=$product->date?></td>
					  <td><?php if($product->sold >0){ echo $product->sold;}else{echo '0';}?></td>
					  <td><?=$product->no_of_Prod?></td>
                      <td><?=$admin_status?></td>
                      <td><a href="<?=BASE_URL?>admin/product/details/<?=$product->id?>" class="btn btn-info btn-sm" title="View details"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                    </tr>
                    
                    <?php $i++;}?>
                    
                    <?php }else{ ?>
                    <tr>
                        <td colspan="11"><p class="text-danger">No record found.</p></td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
			               
                            <div class="pull-right" style="margin-top:12px;">
                                <a href="<?=BASE_URL?>admin/bidproduct" class="btn btn-success btn-sm" id=""><span class="glyphicon glyphicon-eye-open"></span> Bid products</a>
                                <a href="javascript:void(0)" class="btn btn-warning btn-sm featured" id="">Active</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm un_featured" id="">In-Active</a>
                            </div> 
												
                       
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
        <h4 class="modal-title">Active Product</h4>
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
        <h4 class="modal-title">Active Product</h4>
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
        <h4 class="modal-title">In-Active Product</h4>
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
        <h4 class="modal-title">In-Active Product</h4>
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
        if(selectedval=='productname'){
            $("#product").val("<?=$this->input->get('val')?>");
        }else if(selectedval=='category'){ //alert("aa");
            //$('#usercategory option[value="<?=$this->input->get('val')?>"]').attr("selected", "selected");
			$("#usercategory").val("<?=$this->input->get('val')?>");
        }
		else if(selectedval=='seller')
		{
			//$('#seller option[value="<?=$this->input->get('val')?>"]').attr("selected", "selected");
			$("#seller").val("<?=$this->input->get('val')?>");
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
        $("#product").addClass("search_form_display");
        $("#usercategory").addClass("search_form_display");
        $("#seller").addClass("search_form_display");
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='productname'){
            $("#product").removeClass("search_form_display");
            $("#product").prop("disabled",false);
            $("#product").focus();
            }else if(selectedval=='category'){
                $("#usercategory").removeClass("search_form_display");
                $("#usercategory").prop("disabled",false);
                $("#usercategory").focus();
                getcategory(selectedval);
            }else if(selectedval=='seller'){
                $("#seller").removeClass("search_form_display");
                $("#seller").prop("disabled",false);
                $("#seller").focus();
                //getusers(selectedval);
            }else if(selectedval=='adddate'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
            }else{
                $("#product").addClass("search_form_display");
                $("#usercategory").addClass("search_form_display");
		$("#seller").addClass("search_form_display");
                $("#from").addClass("search_form_display");
                $("#to").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
    
    function getcategory(getvalue){
        $.ajax({url:"<?=BASE_URL?>admin/product/getcagegory",async:false,
            success:function(data,status){
                var obj= $.parseJSON(data);
                var htm=''; 
            if(obj.res){
                   htm+='<option value="">-----Select Category----</option>';
                   $.each(obj.rows,function(i,val){
                       htm+='<option value="'+val.id+'">'+val.category+'</option>';
                   });
                }else{
                    htm+='<option value="">Category not found</option>';
                }
                $("#usercategory").html(htm);
            }});
    }
    
    
//    function getusers(getvalue){
//        $.ajax({url:"<?=BASE_URL?>admin/product/getusers",async:false,
//            success:function(data,status){
//            var obj= $.parseJSON(data);
//            var htm=''; 
//            if(obj.res){
//                 htm+='<option value="">-----Select Seller----</option>';
//                   $.each(obj.rows,function(i,val){
//                       htm+='<option value="'+val.id+'">'+val.username+'</option>';
//                   });
//                }else{
//                    htm+='<option value="">User not found</option>';
//                }
//                $("#seller").html(htm);
//            }});
//    }
    
    
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
                $("#un_che_featured_user_deletemsg").html("Please select at least one product.");
                $("#un_che_featured_user_model").modal("show");
            }else{
                 $("#featured_user_deletemsg").html("Do you want to active selected product(s)?");
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
            $.post("<?=BASE_URL?>admin/product/active",{selectedmail:selectedmail},function(data,status){
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
                $("#un_che_un_featured_user_deletemsg").html("Please select at least one product.");
                $("#un_che_un_featured_user_model").modal("show");
            }else{
                 $("#un_featured_user_deletemsg").html("Do you want to in-active selected product(s)?");
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
            $.post("<?=BASE_URL?>admin/product/inactive",{selectedmail:selectedmail},function(data,status){
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
<script>
$(document).ready(function() 
    { 
	$.tablesorter.addWidget({
			id: "numbering",
			format: function(table) {
				$("tr:visible", table.tBodies[0]).each(function(i) {
					$(this).find('td').eq(0).text(i+1);
				});
			}
		});
        
		$("#myTable").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false 
             },
			 1: { 
                // disable it by setting the property sorter to false 
                sorter: false 
             },
			 9: { 
                // disable it by setting the property sorter to false 
                sorter: false 
             },
			 10: { 
                // disable it by setting the property sorter to false 
                sorter: false 
             }
        } ,
		sortList: [[6,1]] ,
		widgets: ['numbering']
    }); 
    } 
);

</script>