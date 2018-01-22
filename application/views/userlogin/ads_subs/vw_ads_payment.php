<?php 
$userid=$this->session->userdata('user_id');
?>
<style>
    .al_paid{float: right; font-size: 16px;}
    .py-btn{margin: 16px;}
</style>
<div class="col-sm-9">
   
    <div class="">
                    <div class="contant-body2">
                        <?php   
                                if($adsdata['res']){ 
                                 if($adsdata['rows'][0]->paid_status==0){   
                                ?>
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="category">Pay For</label></div>
                              <div class="col-sm-9">
                                 
                                  <select class="form-control" id="category" name="category"  required="">
                                   
                                    <?php
                                        if($category['res']){
                                            foreach($category['rows'] as $category){
                                                //echo "<pre>";
                                                //print_r($category); exit;
                                        
                                    ?>
                                    
                                    <option value="<?=$category->id?>" <?php echo set_select('category', $category->id); ?> ><?=$category->title?>    (<?=$category->price?>)</option>
                                     
                                        <?php }} ?>
                                    
                                </select>
                                 
                                  <?php if(form_error('category')!='') echo form_error('category','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="category_error"></span>
                                  
                            </div>
                                <?php } else{
                                    $exp_date=$adsdata['rows'][0]->exp_date;
                                    echo "Your Ads is running till.....".date('d-M-Y',  strtotime($exp_date));
                                }}?>
                         <?php   
                                if($adsdata['res']){ 
                                //foreach($adsdata['rows'] as $ads_data){
                                //echo "<pre>";
                                //print_r($adsdata); exit;
                                    $ads_id=$adsdata['rows'][0]->id;
                                    $sellerid=$adsdata['rows'][0]->user_id;
                                    //$price=$category->price;
                                    $url=BASE_URL.'payment/index/'.$ads_id.'/'.$sellerid.'/'.'?paymenttype=ads';
                                    //$url='payment/index/'.$ads_id.'/'.$sellerid.'/'.'?paymenttype=ads';
                                
                            ?>
                      <?php if($adsdata['rows'][0]->paid_status==0){?><a href="javascript:pay('<?php echo $url?>');" class="btn btn-success py-btn"  id="btn-paynow" style="float:right;">Pay now</a><?php }else{?><span class="al_paid"> </span><?php }?>
                                <?php }?>
                    </div>              
        </div>
   
        
</div>  
    </div>
</div>  



<script>
	function set_session(sessname,sessvalue)
	{
            $.post("<?=BASE_URL?>adssubscription/set_session",{name:sessname,value:sessvalue},function(data,status){
            obj=$.parseJSON(data);
            if(obj.status){
            //window.location.assign("<?php echo $url;?>");
            }
        });
		
	}
        function pay(url){
         //set_session('price',price);
         var ads_id=$("#category").val();
         //alert(ads_id);
          $.post("<?=BASE_URL?>adssubscription/getprice",{id:ads_id},function(data,status){
            obj=$.parseJSON(data);
            if(obj.res){
               var ads_price=obj.category['price'];
               var cat_id=obj.category['id'];
               set_session('price',ads_price);
               set_session('ads_category',cat_id);
               window.location.assign("<?php echo $url;?>");
                
            } 
              
        });
         
         
         
         
    
    }

</script>

