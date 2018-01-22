<?php 
//echo $_GET['searchby'];
?>
<style> 
    .search_form_display{ display: none !important;}
    .ex_ttl{font-weight: bold;}
     .custm_td{font-weight: bold;}
</style>
<section class="content-header">
    <h1>
     Manage Finance
     <small>Track Buyer</small>
    </h1>
</section>
<?php 
$ftotal=0;
?>
<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <!--<h3 class="box-title"></h3>-->   
              <span class="text-danger" id="error_search"></span>
              <form class="form-inline" role="form" action="<?=BASE_URL?>admin/finance/main_search_buyer" method="get">
                    <div class="form-group">
                      <label for="email">Search By:</label>
                      <select class="form-control" name="searchby" id="searchby">
                          <option value="">----Please Select----</option>
                           <option value="campeign" <?php if($this->input->get('searchby')=='campeign'){echo "selected";} ?> >Campaign</option>
                          <option value="buyer" <?php if($this->input->get('searchby')=='buyer'){echo "selected";} ?> >By Buyer Name</option>
                          <option value="adddate" <?php if($this->input->get('searchby')=='adddate'){echo "selected";} ?> >Search By Date</option>
                          <option value="adddate_buyer" <?php if($this->input->get('searchby')=='adddate_buyer'){echo "selected";} ?> >Search By Date and Buyer</option> 
                          <option value="adddate_product" <?php if($this->input->get('searchby')=='adddate_product'){echo "selected";} ?> >Search By Product Name and Date</option>
                      </select>
                    </div> &nbsp;
                    <div class="form-group">
                        <label for="product" class="sr-only">Product Name </label>
                        <input type="text" class="form-control search_form_display" id="product" name="product" placeholder="Product Name" disabled="" required>
                    </div>
                    <div class="form-group">
                        <label for="buyer" class="sr-only">Buyer </label>
                        <input type="text" class="form-control search_form_display" id="buyer" name="val" placeholder="Search by Buyer Name" disabled="" required="">
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="sr-only">From date</label>
                        <input type="text" class="form-control search_form_display" id="from" name="from" placeholder="From" disabled="" required="">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd" class="sr-only">To date</label>
                        <input type="text" class="form-control search_form_display" id="to" name="to" placeholder="To" disabled="" required="">
                    </div>
                    <button type="submit" class="btn btn-default" id="search">Search</button>
                    
               </form>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Payment</th>
                        <th>Price</th>
<!--                        <th>Product Name</th>-->
                        <th><?php if($this->input->get('searchby')=='campeign'){echo "Title";}else{ ?>  Product Name <?php }?></th>
                        <th>Transaction date</th>
                    </tr>

                    
                    <?php if($trackrecord['res']){ $i=1; $total=0; foreach($trackrecord['rows'] as $trackrecords){ 
                        
                        $total+=$trackrecords->price; ?>
                    <tr>
                      <td><?=$i?>.</td>
                      <td><?=$trackrecords->username?></td>
                      <td><?php if($trackrecords->payment_for=='campeign'){echo "Campaign";}else{echo ucfirst($trackrecords->payment_for);}?></td>
                      <td>$<?=$trackrecords->price?></td>
                       <td>
                          <?php 
                       // echo 'dhkjfh'.$_GET['searchby']; exit;
                          
                          if(isset($_GET['searchby']) && $_GET['searchby']=='campeign'){
                              //echo "hi";
                             // echo 
                              if(isset($trackrecords->campaign_titel)){
                              echo $trackrecords->campaign_titel;
                              }
                          }else{
                          echo $trackrecords->prod_name;
                          } ?></td>
                      <td><?=$trackrecords->date?></td>
                    </tr>
                    
                    <?php $i++;}?>
                    <tr>
                        <td colspan="2"></td>
                        <td><strong>Total</strong></td>
                        <td><strong>$<?=$total?></strong></td>
                        <td colspan="3"></td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                        <td colspan="11"><p class="text-danger">No record found.</p></td>
                    </tr>
                    <?php } ?>
                    <?php if($alltrackrecord['res']){
                      
                        foreach($alltrackrecord['rows'] as $alltrackrecords){ 
                        $ftotal+=$alltrackrecords->price;
                        }
                     ?>
                    <tr>
                        <td colspan="2"></td>
                        <td class="custm_td">Grand Total:-</td>
                        <td class="ex_ttl"><?php echo '$'. $ftotal;?></td>
                       
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
                    $('#buyer').val(''); 
                    $('#product').val('');
                }
            });
      	if(selectedval=='buyer'){
            $("#buyer").val("<?=$this->input->get('val')?>");
        }
	 else if(selectedval=='adddate'){
            $("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
        } 
        else if(selectedval=='adddate_buyer'){
           $("#buyer").val("<?=$this->input->get('val')?>"); $("#from").val("<?=$this->input->get('from')?>");$("#to").val("<?=$this->input->get('to')?>");
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
            if(selectedval==''){
                $("#error_search").html("Please select any one");
                return false;
            }
            return true;
        });
    });
    
    
    function search(selectedval){
        $("#buyer").addClass("search_form_display");
        $("#from").addClass("search_form_display");
        $("#to").addClass("search_form_display");
         $("#product").addClass("search_form_display");
        $(".search_form_display").prop("disabled",true);
        
        if(selectedval=='buyer'){
            $("#buyer").removeClass("search_form_display");
            $("#buyer").prop("disabled",false);
            $("#buyer").focus();
            }
        else if(selectedval=='adddate'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
            }
        else if(selectedval=='adddate_buyer'){
            $("#from").removeClass("search_form_display");
            $("#from").prop("disabled",false);
            //$("#from").focus();
            $("#to").removeClass("search_form_display");
            $("#to").prop("disabled",false);
            $("#buyer").removeClass("search_form_display");
            $("#buyer").prop("disabled",false);
            $("#buyer").focus();
        }
        else if(selectedval=='adddate_product'){
                $("#from").removeClass("search_form_display");
                $("#from").prop("disabled",false);
                //$("#from").focus();
                $("#to").removeClass("search_form_display");
                $("#to").prop("disabled",false);
                $("#product").removeClass("search_form_display");
                $("#product").prop("disabled",false);
                $("#product").focus();
            }
	else{
                $("#buyer").addClass("search_form_display");
                $("#from").addClass("search_form_display");
                $("#to").addClass("search_form_display");
                $(".search_form_display").prop("disabled",true);
            }
    }
       
</script>
