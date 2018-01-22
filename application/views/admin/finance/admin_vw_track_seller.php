<style> 
    .search_form_display{ display: none !important; }
    .check_div{margin-top: -30px;}
    .ex_ttl{font-weight: bold;font-size: 13px;}
    .custm_td{font-weight: bold;}
</style>
<section class="content-header">
    <h1>
     Manage Finance 
     <small>Track Seller</small>
    </h1>
<!--    <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
    </ol>-->
</section>
<?php 
$i=0;$grandTotle=0;
$j=0;$all_total=0;
$totaltax=0;$admin_comm=0;
$gttl=0;$ttl_admin_commission=0;$newgrandTotle=0;
?>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
				<?php 
				$ut=$this->uri->segment(2);
				$pu=$this->uri->segment(3);
				
				?>
                 <span class="text-danger" id="error_search"></span>
                <form class="form-inline" role="form" id="form" action="<?=BASE_URL?>admin/finance/main_search" method="get">
                    <div class="form-group">
                        
                      <label for="email">Search By:</label>
                             
                      <select class="form-control" name="searchby" id="searchby">
                          
                          <option value="">----Please Select----</option>
                            <option value="seller"<?php if($this->input->get('searchby')=='seller'){echo "selected";} ?> >Seller</option>
                            <option value="adddate" <?php if($this->input->get('searchby')=='adddate'){echo "selected";} ?> >Search By Date</option> 
                            <option value="adddate_seller" <?php if($this->input->get('searchby')=='adddate_seller'){echo "selected";} ?> >Search By Date and Seller</option> 
                            <option value="trackdetail" <?php if($this->input->get('searchby')=='trackdetail'){echo "selected";} ?> >Search By Track Detail</option> 
                            <option value="adddate_product" <?php if($this->input->get('searchby')=='adddate_product'){echo "selected";} ?> >Search By Date and Product</option>
                      </select>
                    </div> &nbsp;
<!--                    <div class="form-group">
                        <label for="seller" class="sr-only">Seller </label>
                        <select class="form-control" name="val" id="seller">
                          <option value="">----Please Select----</option>
                           
                      </select>
                        
                    </div>-->
                   
                    <div class="form-group"> &nbsp;
                      <label for="pwd" class="sr-only" >Track Details</label>
                      
                      <select class="form-control search_form_display" id="tracks" name="val" disabled="">
                          <option value="">----Please Select----</option>
                          <option value="1">Order Received</option>
                          <option value="2">Processed</option>
                          <option value="3">Shipped</option>
                          <option value="4">Delivered</option>
                          <option value="5">Rejected</option>
                          
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Product Name</label>
                        <input type="text" class="form-control search_form_display" id="product" name="product" placeholder="Product Name" disabled="" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="sr-only">Seller Name</label>
                        <input type="text" class="form-control search_form_display" id="seller" name="val" placeholder="Seller name" disabled="" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="sr-only">From date</label>
                        <input type="text" class="form-control search_form_display" id="from" name="from" placeholder="From" disabled="" required="">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">To date</label>
                        <input type="text" class="form-control search_form_display" id="to" name="to" placeholder="To" disabled="" required="">
                    </div>
                    <div class="form-group search_form_display" id="filter">
                          <span class="ex_ttl">Exclude Rejects</span>
                         <input type="hidden" value="0" id="check" name="sortby">
                         <input type="checkbox"  id="check_box" <?php if($this->input->get('sortby')=='1'){?>checked<?php }?> >  
                    </div>
                     <button type="submit" class="btn btn-default pull-right" id="search">Search</button>
                    
                
                </form>
                 
<!--                 <form id="form" action="" method="get">
                        <div class="col-lg-3 pull-right check_div">
                            <span class="ex_ttl">Exclude Rejected order</span>
                            <input type="hidden" value="0" id="check" name="sortby">
                            <input type="checkbox"  id="check_box" <?php if($this->input->get('sortby')=='1'){?>checked<?php }?> >
                         </div>    
                </form>-->
                 

            </div>
   
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Username</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Tax</th>
                        <th>Commission</th>
                        <th>Total</th>
                        <th>Sale Date</th>
			<th>Track Shipping</th>
                    </tr>
                    
                    <?php if($trackrecord['res']){
                      
                        foreach($trackrecord['rows'] as $trackrecords){ $i++;
                        //print_r($trackrecords->tax); exit;
                        $ttl=$trackrecords->quantity*$trackrecords->price;
                        $ttx=($trackrecords->tax*$ttl)/100;
                        $fttl=$ttl-$trackrecords->commission+$ttx;
                    ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <td><?=$trackrecords->username?></td>
                      <td><?=$trackrecords->prod_name?></td>
                      <td><?='$'.$trackrecords->price?></td>
                      <td><?=$trackrecords->quantity?></td>
                      <td><?=$ttx ?></td>
                       <td><?=$trackrecords->commission?></td>
                      <td><?='$'.$fttl?></td>
                      <td><?=$trackrecords->date?></td>
                     <td><?php 
                            $status='';         
                            if($trackrecords->status==1){
                                $status='Order Received';
                            }else if($trackrecords->status==2 || $trackrecords->status==0 || $trackrecords->status==''){
                                $status='Order Processed';
                            }else if($trackrecords->status==3){
                                $status='Order Shipped';
                            }else if($trackrecords->status==4){
                                $status='Order Delivered';
                            }else if($trackrecords->status==5){
                                $status='Order Rejected';
                            }
                                  echo $status;      ?>
                            </td>  
                            
                       <?php $grandTotle=$grandTotle+$fttl; 
                       $totaltax=$totaltax+$ttx;
                       $admin_comm=$admin_comm+$trackrecords->commission;
                       }?> 
                    </tr>
                    
                    <td colspan="4"></td>
                            <td><span class="totletitle custm_td">Total: </span></td>
                            <td><span class="totle"><?php echo '$'.$totaltax?></span></td>
                            <td><span class="totle"><?php echo '$'.$admin_comm?></span></td>
                            <td><span class="totle"><?php echo '$'.$grandTotle?></span></td>
                            
                                                
                    <?php }else{ ?>
                    <tr>
                        <td colspan="11"><p class="text-danger">No record found.</p></td>
                    </tr>
                    <?php } ?>
                                <?php if($newtrackrecord['res']){
                      
                        foreach($newtrackrecord['rows'] as $newtrackrecords){ 
                        //print_r($trackrecords->tax); exit;
                        $ttl1=$newtrackrecords->quantity*$newtrackrecords->price;
                        $ttx1=($newtrackrecords->tax*$ttl1)/100;
                        //echo "<br>";
                        $fttl1=$ttl1-$newtrackrecords->commission+$ttx1;
                        
                        $gttl=$gttl+$ttx1;
                        $ttl_admin_commission=$ttl_admin_commission+$newtrackrecords->commission;
                        $newgrandTotle=$newgrandTotle+$fttl1; 
                        }
              
                    ?>
                    <tr>
                        <td colspan="4"></td>
                        <td class="custm_td">Grand Total:-</td>
                        <td><?php echo '$'. $gttl;?></td>
                        <td> <?php echo '$'. $ttl_admin_commission;?></td>
                        <td> <?php echo '$'. $newgrandTotle;?></td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
            <?php 
            ?>
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
    $(document).ready(function(){
        var selectedval=$("#searchby").val();
        search(selectedval);
        $('#searchby').change(function() 
            {
                if ($(this).val() !== '') 
                {
                    var val = $(this).find('option:selected').text();
                    $('#from').val('');   
                    $('#to').val('');  
                    $('#seller').val('');
                    $('#product').val('');
                }
            });
      if(selectedval=='seller')
		{
			//$('#seller option[value="<?=$this->input->get('val')?>"]').attr("selected", "selected");
			$("#seller").val("<?=$this->input->get('val')?>");
		}
       else if(selectedval=='adddate'){
            $("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
        }  
         else if(selectedval=='trackdetail'){ //alert("aa");
            $('#tracks option[value="<?=$this->input->get('val')?>"]').attr("selected", "selected");$("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
        }
         else if(selectedval=='adddate_seller'){
           $("#seller").val("<?=$this->input->get('val')?>"); $("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
        }         
      else if(selectedval=='adddate_product'){
           $("#product").val("<?=$this->input->get('product')?>"); $("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
        } 
      
      
        $(document).on("change","#searchby",function(){
            selectedval=$(this).val();
            search(selectedval); 
        }); 
        
        $(document).on("click","#search",function(){
            var selectedval=$("#searchby").val();
            var tracksval=$("#tracks").val();
            //alert(tracksval);
            if(selectedval==''){
                $("#error_search").html("Please select any one");
                return false;
            }

            return true;
        });
    });
    
    
    function search(selectedval){
   
        $("#seller").addClass("search_form_display");
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
        $("#tracks").addClass("search_form_display");
        $("#product").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
            if(selectedval=='seller'){
                $("#seller").removeClass("search_form_display");
                $("#filter").removeClass("search_form_display");
                $("#seller").prop("disabled",false);
                $("#seller").focus();
                //getusers(selectedval);
            }
            else if(selectedval=='adddate'){
                $("#from").removeClass("search_form_display");
                 $("#filter").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
            }
               else if(selectedval=='adddate_seller'){
                $("#filter").removeClass("search_form_display");   
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
                $("#seller").removeClass("search_form_display");
                $("#seller").prop("disabled",false);
                $("#seller").focus();
            }
              else if(selectedval=='trackdetail'){
                $("#tracks").removeClass("search_form_display");
                $("#filter").addClass("search_form_display");
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
                $("#tracks").prop("disabled",false);
                $("#tracks").focus();
            }
            else if(selectedval=='adddate_product'){
                $("#filter").removeClass("search_form_display");
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
                $("#product").removeClass("search_form_display");
                $("#product").prop("disabled",false);
                $("#product").focus();
                //$("#seller").hide();
                
            }
            else{
               $("#seller").addClass("search_form_display");
                $("#from").addClass("search_form_display");
                $("#to").addClass("search_form_display");
                $("#tracks").addClass("search_form_display");
                $("#filter").addClass("search_form_display");
                $("#product").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
    
    
    
    $('#check_box').on('click', function () {
            //var select_id=[]; 
//            $("#check").val(this.checked ? 1 : 0);
//            ('#check_box').attr('checked',true);
            
            var check=$("#check_box").prop('checked');
            if(check){
                $("#check").val('1');
            }
            else{
                $("#check").val('0');
            }
            //alert($(this).val());
           // $("#form").submit();
            
    });
    
//     $('#check_box').on('click', function () {
//            var select_id=[]; 
//            $(this).val(this.checked ? 1 : 0);
//            //console.log($(this).val());
//            //alert($(this).val());
//             select_id.push($(this).val());
//            // alert(select_id);
//            //$.post("<?=BASE_URL?>admin/finance/exclude_reject",{select_id:select_id},function(data,status){
//            //});
//            if(select_id==1){
//            $.post("<?=BASE_URL?>admin/finance/exclude_reject",{select_id:select_id},function(data,status){
//           var obj=JSON.parse(data);
//            if(obj.res){
//                   console.log(obj.res);
//                }
//            });
//        }
//      });
//    
    
//   function getusers(getvalue){
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
    
 
 
 
</script>