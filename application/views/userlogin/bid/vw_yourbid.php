<?php //print_r($products); 
$product=$products['rows'][0];

$timestamp=time();
$currentdate=date('Y-m-d',$timestamp);
//echo $currentdate;
$bidstartdata=explode(" ",$product->bid_start_date);
$bidenddata=explode(" ",$product->bid_end_date);
$bidpurchasedata=explode(" ",$product->bid_purchase_date);

if($currentdate < $bidstartdata[0]){
    $bidder_msg="Bidding start from ".$bidstartdata[0];
    $btn_disable=true;
}else if($currentdate > $bidenddata[0]){
    $bidder_msg ="Bidding Over as on ".$bidenddata[0];
    $btn_disable=true;
}else{
    $bidder_msg="";
    $btn_disable=false;
}

?>
<div class="col-sm-9">
    <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Product Bid</h4>
                    </div>
                </div>
            </div>
            
            <div class="contant-body2">
                <div class="btn-group cus_btn_group">
                <div class="col-sm-3 col-md-4 col-lg-3 col-xs-12 btn btn-success"> 
                    <p><strong>Starting Price</strong></p>
                    <p>$<?=$product->prod_price?></p>
                </div>
                
                <div class="col-sm-3 col-md-4 col-lg-3 col-xs-12 btn btn-success"> 
                    <p><strong>Bid Start Date</strong></p>
                    <p><?=$bidstartdata[0]?></p>
                </div>
                
                <div class="col-sm-3 col-md-4 col-lg-3 col-xs-12 btn btn-success"> 
                    <p><strong>Bid End Date</strong></p>
                    <p><?=$bidenddata[0]?></p>
                </div>
                    
                <div class="col-sm-3 col-md-4 col-lg-3 col-xs-12 btn btn-success"> 
                    <p><strong>Purchase Date</strong></p>
                    <p><?=$bidpurchasedata[0]?></p>
                </div>
                </div>    
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                    <p id="bidder_error_msg" class="text-danger "> <?php if($btn_disable){ ?> <span class="glyphicon glyphicon-ban-circle"></span>  <?=$bidder_msg?> <?php } ?> </p>
                    <p><strong>Note:- </strong><small>(If you are get selected as winner of this product. You must purchase this product as on <?=$bidpurchasedata[0]?> other wise seller can add penalty point in your account)</small></p>
                </div>
                <form role="form" name="yourbid" method="post" action="<?=BASE_URL?>bid/yourbid/<?=$product->prodId?>">
                    <input type="hidden" value="<?=$product->prodId?>" name="prodid" >
                    <input type="hidden" value="<?=$product->prod_price?>" id="starting_price" name="starting_price">
                    <div class="form-group clearfix">
                        <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="name">Your Bid Amount</label></div>
                      <div class="col-sm-8"> 
                          <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="amt" value="<?=set_value('amt')?>" name="amt" placeholder="Your Bid Amount" onkeyup="checknumber(this.id,this.value)">
                         </div>
                          
                          <?php if(form_error('amt')!='') echo form_error('amt','<div class="text-danger err">','</div>'); ?>
                          <span class="text-danger" id="amt_error_nume"></span>
                      </div>
                      <span class="text-danger" id="amt_error"></span>
                    </div>
                    
                    <div class="form-group">        
                        <div class="col-sm-offset-9 col-sm-3">
                            <button type="submit" id="<?php if($btn_disable){?>yourbid_error<?php }else{ ?>yourbid<?php } ?>" class="btn btn-success btn-block <?php if($btn_disable){echo "disabled";} ?>">Submit</button>
                        </div>
                      </div>
                </form>
            </div>
    
    
            <?php if($bid['res']){  //print_r($bid); ?>               
            <div class="col-sm-12">
                <h3>Bidding Details</h3>
                <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Bidder</td>
                                    <td>Price</td>
                                    <td>Date</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                               
                                foreach($bid['rows'] as $bidderlist){
                            ?>    
                                <tr>
                                    <td><?=$bidderlist->f_name?>&nbsp;<?=$bidderlist->l_name?></td>
                                    <td>$<?=$bidderlist->price?></td>
                                    <td><?=$bidderlist->add_date?></td>
                                </tr>
                                <?php } ?>   
                            </tbody>
                        </table>
                        <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                        </ul>
                    </div>
            </div>
            <?php } ?>
</div>

</div>
</div>


<script>
    $(document).ready(function(){
        $("#yourbid").click(function(){
            var amt = $("#amt").val().trim();
            var starting_price = $("#starting_price").val().trim();

            if(amt == ''){
                //alert("aa");
                $("#amt_error_nume").html("Enter Bid Amount");
                $("#amt").focus();
                $("#amt_error").parent().addClass("has-error");
                return false;    
            }
            //alert(amt);alert(starting_price);
            if(parseInt(amt) < parseInt(starting_price)){
                $("#amt_error_nume").html("Bid price shouldn't less than $"+starting_price+".");
                $("#amt").focus();
                $("#amt_error").parent().addClass("has-error");
                return false;
            }
            
            return true;
        });   
        
        $("#yourbid_error").click(function(){
            $("#bidder_error_msg").css({"border":"1px solid #f00","padding":"5px"});
            return false;
        });
    });
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_nume").html("Enter Only Numeric Value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            //return false;
        }else{ 
            removeerror(id); 
            }}else{
            removeerror(id);
        }
    }
    
    function removeerror(id){
        $("#"+id+"_error_nume").html("");
        $("#"+id).focus();
        $("#"+id+"_error").parent().removeClass("has-error");
    }
</script>

