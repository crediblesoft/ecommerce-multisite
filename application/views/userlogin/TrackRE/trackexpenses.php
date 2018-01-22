<style>
    .mm{padding-top: 15px;}
    .totle{font-size: 20px;font-weight: 600;color: #001f3f;}
    .totletitle{font-size: 16px;font-weight: 600;color: #000000;}
</style> 
<?php //print_r($trackrecordexpenses); ?>
<div class="col-sm-9">
    <div class="row">        
            <div class="row">                
                <div class="contant-head">
                    <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>trackre"> Track Revenue</a> </h4><h5> > View</h5>
                     <span class="add-button"><a class="btn btn-success" href="<?=BASE_URL?>trackre"> <span class="glyphicon glyphicon-plus-sign"></span> Track Revenue</a></span>
                </div>               
            </div>
        <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>trackre">
            <div class="row">                
                <div class="contant-head mm">
                    <div class="form-group">
                              <div class="col-sm-1 ">
                                  <!--<label class="control-label" for="fromDate">From Date</label>-->
                              </div>
                              <div class="col-sm-4">          
                                  <input type="text" class="form-control" id="fromDate" value="<?php echo $fromDate?>" name="fromDate" placeholder="From Date">                                  
                              </div>
                                <div class="col-sm-1 ">
                                  <!--<label class="control-label" for="name">To Date</label>-->
                                </div>
                              <div class="col-sm-4">          
                                  <input type="text" class="form-control" id="toDate" value="<?php echo $toDate?>" name="toDate" placeholder="To Date">                                  
                                </div>
                            <div class="col-sm-2"><button type="submit" id="recipebtn" class="btn btn-success btn-block">Submit</button></div>
                    </div>                                       
                </div>               
            </div>
         </form>
        <div class="contant-body2">
            <?php if($trackrecordexpenses['res']){?>
                    <div class=" col-sm-12 table-responsive">                        
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
                            <?php $i=0;$grandTotle=0;
                                 //print_r($trackrecord);                                
                                foreach($trackrecordexpenses['rows'] as $track) 
                                    { $i++;?>    
                                <tr>
                                    <td><?php echo $i;?></td>
                                     <td><?php echo $track->tranc_id;?></td>
                                    <td><?php echo 'Payment For Theme';?></td>

                                    <td><?php echo '$'.$track->themeprice;?></td>
                                    
                                    
                                    <td><?php echo '$'.($track->themeprice);?></td>
                                    <td><?php echo $track->add_date;?></td>
                                   
                                </tr>
                                <?php $grandTotle=$grandTotle+($track->themeprice);} ?> 
                                <tr>
                                    <td colspan="4"></td>
                                    <td><span class="totletitle">Total: </span></td>
                                    <td><span class="totle"><?php echo '$'.$grandTotle?></span></td>
                                    <!--<td colspan="2"></td>-->
                                </tr>
                            </tbody>
                        </table>                        
                    </div>
            <?php }else{?>
            Sorry No any Record Found !
            <?php }?>
            </div> 
        </div>        
    </div> 
        
        <script>
            $(document).ready(function(){
                $("#fromDate").datepicker({
                    format: "yyyy-mm-dd",
                    orientation: "bottom auto",
                    todayHighlight: true
                }).css('z-index','100110');
                $("#toDate").datepicker({
                    format: "yyyy-mm-dd",
                    orientation: "bottom auto",
                    todayHighlight: true
                }).css('z-index','100110');

            });
        </script>
    </div>
</div>
