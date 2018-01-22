<?php
//print_r($userprice);
?>
<style>    
    .uppercase {text-transform: uppercase;}
    .lowercase {text-transform: lowercase;}
    .capitalize {text-transform: capitalize;}
</style>
<div class="col-sm-9">
    <div class="row">
        <div class="">
            <div class="contant-head">
                <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> 
                     Premium Member Ship  </h4><h5> > Select </h5>
            </div>
        </div>
    </div>
    
    <div class="contant-body2">
        <?php if($userprice['res'])            
        {?>
        <div class="table-responsive ">
            <table class="table table-bordered cus-table-bordered">
                <thead class="cus-thead">            
                    <tr>
                        <td>S.No.</td>
                        <td>Price</td>                        
                        <td>Massage</td>
                        <td>Email</td>
                        <td></td>
                    </tr>
                </thead>
            
            
                <tbody>
                    <?php $i=0; foreach ($userprice['rows'] as $themepricedata){ 
                        $i++;  ?>
                    <tr class="text-center">
                        <td><?php echo $i;?></td>
                        <td><?php echo '$ '.$themepricedata->price?></td>                        
                        <td class="uppercase"><?php echo $themepricedata->email?></td>
                        <td class="uppercase"><?php echo $themepricedata->massage?></td>

                        <td>
                             <?php                            
                              $theme_id='777';//$themepricedata->theam_id;
                              $buyerid=$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'';
                              $price=$themepricedata->price;
                              $url=BASE_URL.'payment/index/'.$theme_id.'/'.$price.'/'.$buyerid.'?paymenttype=user';
                              $theme='';
                              $theme=$theme_id!='1001'? $theme_id!='1002'? $theme_id!='1003'? $theme_id!='1004'? '777' :'theme4' : 'theme3' : 'theme2' : 'theme1';
                              ?>
                            <?php if($userpaid){ ?>
                            Paid user
                            <?php }else{ ?>
                            <a href="<?php echo $url?>" >Go For Payment</a>
                            <?php } ?>
                        </td>
                    </tr>
                        <?php }?>
                </tbody>
        </table>
        </div>
        <?php }?>
    </div>
</div>


    </div>
</div>
