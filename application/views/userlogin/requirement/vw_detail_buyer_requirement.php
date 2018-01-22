<style>
    .cust_span_1{font-weight: bold;}
    .cust_span_2{margin-left: 13px;}
</style>
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>requirement"> Manage Buyer Requirement</a> </h4>
                        <?php if($this->session->userdata('user_type')=='2'){ ?>
                        <span class="add-button"><a href="<?=BASE_URL?>requirement/post" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Post Requirement</a></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php if($requirements['res']){
                              $requrement= $requirements['rows'][0];
                         ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="requirement_inner clearfix">
                                <p class="requirement_category"><?=$requrement->category?></p>
                                <p class="margin-bottom_20">
                                       <?=$requrement->details?> 
                                </p>
                                <p><span class="cust_span_1">Posted Date :-</span><span class="cust_span_2"><?php echo $requrement->req_date;?></span></p>  
                                <p class="requirement_price">$<?=$requrement->price?></p>
                                
                                
                                <div class="requirement_button text-center">
                                    <a href="<?=BASE_URL?>requirement/edit/<?=$requrement->id?>" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="#deleteproduct" data-target="#deleteproduct" data-toggle="modal" type="button" class="btn btn-danger delete_req" id="<?=$requrement->id?>"><span class="glyphicon glyphicon-remove-sign"></span></a>
                                </div>
                            </div>
                            
                        </div>
                        <?php }else{ ?>
                            <p class="text-danger">Record Not Found</p>
                         <?php } ?>

                    </div>    
                </div>
            </div>
        </div>

</div>
</div>


