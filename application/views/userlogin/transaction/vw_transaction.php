<?php //print_r($transaction); ?>
<div class="col-sm-9">
            <div class="row">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Transaction</h4>
                         <!--<span class="add-button"><a href="<?=BASE_URL?>product/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Product</a></span>-->
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                <div class="col-sm-12">
                    <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Transaction Id</td>
                                    <td>Price</td>
                                    <td>Date</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($transaction['res']){ 
                                foreach($transaction['rows'] as $translist){
                                    
                                    
                            ?>    
                                <tr>
                                    <td><?=$translist->trans_id?></td>
                                    <td>$ <?=$translist->price?></td>
                                    <td><?=$translist->date?></td>
                                    
                                </tr>
                                <?php }}else{ ?>
                                <tr>
                                    <td colspan="3"> <p class="text-danger">No Record Found</p></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
               
        </div>
        
        
    </div>
</div>  

