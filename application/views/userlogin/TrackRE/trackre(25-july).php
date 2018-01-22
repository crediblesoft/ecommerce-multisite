<style>
    .mm{padding-top: 15px;}
    .totle{font-size: 20px;font-weight: 600;color: #001f3f;}
    .totletitle{font-size: 16px;font-weight: 600;color: #000000;}
    .secend{display: none;}
    .third{display: none;}
    .add-button>h2{font-weight: 800;}
    .fdtd{margin-top:  15px;font-size: 18px; margin-left: 30px;font-weight: 400;}
</style>   
<?php //print_r($trackrecord); 
$i=0;$grandTotle=0;
$j=0;$grandTotleexpenses=0;
?>
<div class="col-sm-9">
    <div class="row">                
        <div class="contant-head">
            <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  Track Revenue </h4><!--<h5> > View</h5>-->
            <span class="fdtd"><h5> From Date &nbsp;&nbsp;&nbsp;(<?php echo $fromDate?>)&nbsp;&nbsp; To Date &nbsp;&nbsp;&nbsp;(<?php echo $toDate?>)</h5></span>
            <?php if($this->session->userdata('user_type')=="2"){?>

            <?php }else{ ?>
            <span class="add-button"><a class="btn btn-success" onclick="showhide('.secend')" <?php /*href="<?=BASE_URL?>trackre/expenses"*/?>> <span class="glyphicon glyphicon-plus-sign"></span> Track Expenses</a></span>                    
            <?php }?>
        </div>               
    </div>
</div>
<div class="col-sm-9">
    <div class="row">
        <form class="" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>trackre">
                   
            <div class="contant-head mm">
                <div class="form-group">
                          <div class="col-sm-1 hidden-xs">
                              <!--<label class="control-label" for="fromDate">From Date</label>-->
                          </div>
                          <div class="col-sm-4 col-xs-5">          
                              <input type="text" class="form-control" id="fromDate" value="<?php echo $fromDate?>" name="fromDate" placeholder="From Date">                                  
                          </div>
                            <div class="col-sm-1 hidden-xs">
                              <!--<label class="control-label" for="name">To Date</label>-->
                            </div>
                          <div class="col-sm-4 col-xs-5">          
                              <input type="text" class="form-control" id="toDate" value="<?php echo $toDate?>" name="toDate" placeholder="To Date">                                  
                            </div>
                        <div class="col-sm-2 col-xs-2"><button type="submit" id="recipebtn" class="btn btn-success btn-block">Submit</button></div>
                </div>                                       
            </div> 
        </form>
    </div>
</div>
<?php //if($this->session->userdata('user_type')=="2"){ ?>
<div class="col-sm-9 pull-right">
    <div class="row">        
        <div class="contant-body2">
            <?php if($trackrecord['res']){?>
            <div class=" col-sm-12 table-responsive">                        
                <table class="table table-bordered cus-table-bordered">
                    <thead class="cus-thead">
                        <tr>
                            <td>No.</td>
                            <!--<td title="Product Id">ID</td>-->
                            <td>Name</td>
                            <td>Price</td>
                            <td>Quantity</td>                                    
                            <td>Total</td>
                            <td>Tax</td>
                            <td>Sale Date</td>
                            <td>Track Shipping</td>                                    
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $total_tax=0;
                         //print_r($trackrecord);                                
                        foreach($trackrecord['rows'] as $track) 
                            { $i++;
                           $ftotal=$track->quantity*$track->price;
                           $tax=($ftotal*$track->tax)/100;
                           $total_tax=$total_tax+$tax;
                            ?>    
                        <tr>
                            <td><?php echo $i;?></td>
                            <!--<td><?php echo $track->prodid;?></td>-->
                            <td><?php echo $track->prod_name;?></td>

                            <td><?php echo '$'.$track->price;?></td>

                            <td><?php echo $track->quantity;?></td>
                            <td><?php echo '$'.$ftotal;?></td>
                             <td><?php echo '$'.$tax;?></td>
                            <td><?php echo $track->date;?></td>
                            <td><?php 
                           /* if($track->status==1)
                                {echo 'pending';}
                                elseif($track->status==2)
                                    {echo 'delivered';}
                                    elseif($track->status==3)
                                        {echo 'cancel';}
                                        else{echo 'No Any Record';}*/
                               $status='';         
                            if($track->status==1){
                                $status='Order Received';
                            }else if($track->status==2 || $track->status==0 || $track->status==''){
                                $status='Order Processed';
                            }else if($track->status==3){
                                $status='Order Shipped';
                            }else if($track->status==4){
                                $status='Order Delivered';
                            }else if($track->status==5){
                                $status='Order Rejected';
                            }
                                  echo $status;      ?>
                            </td>    
                        </tr>
                        <?php $grandTotle=$grandTotle+($track->quantity*$track->price);} 
                        
                        ?> 
                        <tr>
                            <td colspan="3"></td>
                            <td><span class="totletitle">Total: </span></td>
                            <td><span class="totle"><?php echo '$'.$grandTotle?></span></td>
                            <td colspan="3"></td>
                            <!--<td colspan="2"></td>-->
                          
                        </tr>
                       <tr>
                            
                           <td colspan="2"><span class="totletitle">Total Tax: </span></td>
                           <td colspan="3"><span class="totle"><?php echo '$'.$total_tax?></span></td>
                            <!--<td colspan="2"></td>-->
                           
                        </tr>
                    </tbody>
                </table>                        
            </div>
            <?php }else{ ?>
            <div class=" col-sm-11 pull-right"><p>Sorry No any Record Found !</p></div>
            <?php } ?>
        </div>                 
    </div>        
</div> 
    <?php //} 
    if($trackrecordexpenses['res']){?> 
<style>
    .secend{display: block;}
    .third{display: block;}
</style> 
    <?php } ?>
<div class="col-sm-9 secend pull-right">
    
        <?php ?>
    <div class="row">                
        <div class="contant-head">
            <h4> 
                <span class="glyphicon glyphicon-th" aria-hidden="true"></span> 
                 Track Total Expenses
            </h4>
             <span class="add-button">
                 <a class="btn btn-success" onclick="showhide('.third')"> 
                     <span class="glyphicon glyphicon-plus-sign"></span> Show Grand Total
                 </a></span>
        </div>               
    </div>
    <div class="contant-body2">
    <?php if($trackrecordexpenses['res']){?>
            <div class="row col-sm-12 table-responsive">                        
                <table class="table table-bordered cus-table-bordered">
                    <thead class="cus-thead">
                        <tr>
                            <td>No.</td>
                            <td>Transaction ID</td>
                            <td>Name</td>
                            <td>Price</td>                                                                
                            <td>Total</td>
                            <td>Date</td>                                                                 
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                         //print_r($trackrecord);                                
                        foreach($trackrecordexpenses['rows'] as $track) 
                            { $j++;?>    
                        <tr>
                            <td><?php echo $j;?></td>
                             <td><?php echo $track->tranc_id;?></td>
                            <td><?php echo 'Payment For Theme';?></td>
                            <td><?php echo '$'.$track->themeprice;?></td>
                            <td><?php echo '$'.($track->themeprice);?></td>
                            <td><?php echo $track->add_date;?></td>                                   
                        </tr>
                        <?php $grandTotleexpenses=$grandTotleexpenses+($track->themeprice);} ?> 
                        <tr>
                            <td colspan="3"></td>
                            <td><span class="totletitle">Total: </span></td>
                            <td><span class="totle"><?php echo '$'.$grandTotleexpenses?></span></td>
                            <!--<td colspan="2"></td>-->
                        </tr>
                    </tbody>
                </table>                        
            </div>
    <?php }else{?>
    <div class=" col-sm-11 pull-right"><p>Sorry No any Record Found !</p></div>
    <?php }?>
    </div>
</div>
<div class="col-sm-9 pull-right">
        <?php ?>    
    <div class="row third">                
        <div class="contant-head">
		<?php if(($grandTotle>0)&&($grandTotleexpenses>0)){ ?>
            <h4> 
                <span class="glyphicon glyphicon-th" aria-hidden="true"></span> 
				<?php if(($grandTotle-$grandTotleexpenses)<0){?>
                 Grand Total Of Loss
				 <?php }else{?>
				 Grand Total Of Profit
				<?php }?>
            </h4>
            <span class="add-button">
				<p class="totle" <?php if(($grandTotle-$grandTotleexpenses)<0){ ?> style='color:#f00;' <?php } ?>> 
				  <?php echo '$'.abs($grandTotle-$grandTotleexpenses); ?>
				</p>
		<?php } ?>
                                              
            </span>
        </div>               
    </div>
</div>  
        <script>
           function showhide(divid)
           {
               if($(divid).css('display')=='none')
               {
                   $(divid).css('display','block');
               }else{
                   $(divid).css('display','none');
               }
           }
           $(function(){
        $( "#fromDate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#toDate").datepicker("option", "minDate", dt);
            }
        });
        $( "#toDate" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate() );
            $("#fromDate").datepicker("option", "maxDate", dt);
            }
        });
    });
//            $(document).ready(function(){
//                $("#fromDate").datepicker({
//                    format: "yyyy-mm-dd",
//                    orientation: "bottom auto",
//                    todayHighlight: true
//                }).css('z-index','100110');
//                $("#toDate").datepicker({
//                    format: "yyyy-mm-dd",
//                    orientation: "bottom auto",
//                    todayHighlight: true
//                }).css('z-index','100110');
//
//            });
        </script>
    </div>
</div>
