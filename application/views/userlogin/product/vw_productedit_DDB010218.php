<?php //print_r($userdata); 
 //print_r($product);
 if($product['res']){
     $product=$product['rows'][0];
     //print_r($product);
?>
<style>.diemension_field{width:80% !important;}</style>
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>product"> Manage Product</a> </h4><h5> > Edit </h5>
                            <span class="add-button"><a href="<?=BASE_URL?>product/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Product</a></span>
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>product/update">
                        <input type='hidden' value="<?=$product->id?>" name="productid">
                            <div class="form-group required">
                              <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="email">Category</label></div>
                              <div class="col-sm-8">
                                  <select class="form-control" id="category" name="category">
                                    <option value="">----Select Category-----</option>
                                    <?php
                                        if($category['res']){
                                            foreach($category['rows'] as $category){
                                        
                                    ?>
                                        <option value="<?=$category->id?>" <?php if($product->category==$category->id){echo "selected";} ?> ><?=$category->category?></option>
                                        <?php } } ?>
                                </select>
                                  <?php if(form_error('category')!='') echo form_error('category','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="category_error"></span>
                                  
                            </div>
                        
                        
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="name">Product Name</label></div>
                              <div class="col-sm-8">           
                                  <input type="text" class="form-control" id="name" value="<?=$product->prod_name?>" name="name" placeholder="Product Name">
                                  <?php if(form_error('name')!='') echo form_error('name','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="name_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group required">
                              <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="price">Product Price</label></div>
                              <div class="col-sm-8">      
                                  <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="price" value="<?=$product->prod_price?>" name="price" placeholder="Product Price" onkeyup="checknumber(this.id,this.value)" >
                                 </div>  
                                  <?php if(form_error('price')!='') echo form_error('price','<div class="text-danger err">','</div>'); ?>
                                  <span class="text-danger" id="price_error_nume"></span>
                              </div>
                              <span class="text-danger" id="price_error"></span>
                                  
                            </div>
                        
                         
                            <div class="form-group required">
                              <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="image">Product Image</label></div>
                              <div class="col-sm-6">           
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                Browse… <input multiple="" name="file" id="file" type="file">
                                            </span>
                                        </span>
                                          <input class="form-control" id="image" readonly="" placeholder='(maximum 4MB file size allowed)' type="text">
                                    </div>
                                  <span class="text-danger" id="image1_error"></span>
                              </div>
                              <div class="col-sm-2"><img src="<?=BASE_URL."assets/image/product/thumb/".$product->prod_img?>" class="img-responsive"></div>
                              <span class="text-danger" id="image_error"></span>
                            </div>
                         
                        
                            <div class="form-group required">
                              <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="details">Product Details</label></div>
                              <div class="col-sm-8">          
                                  <textarea class="form-control" id="details" name="details" placeholder="Product Details"><?=$product->pord_detail?></textarea>
                                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="details_error"></span>
                                  
                            </div>
                         
                        
                            
                        
                         
                            <div class="form-group required">
                              <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="pwd">Sell Type</label></div>
                              <div class="col-sm-8">          
                                  <input type="radio" name="selltype" class="selltype" value="0" <?php if($product->bid_status=='0'){?>checked <?php } ?> > Direct Sell &nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="selltype" class="selltype" value="1" <?php if($product->bid_status=='1'){?>checked <?php }?>> Bid
                              </div>
                              
                            </div>
                        
                        
                        <div class="form-group required" id="bid_sdate" style="display:none;">
                              <label class="control-label col-sm-3 col-sm-offset-1 font_13" for="pwd">Bid Start Date</label>
                              <div class="col-sm-8">     
                                  <input type="text" class="form-control datepicker" id="bid_start" name="bid_start" <?php if($product->bid_start_date!=0000-00-00){ ?> value="<?=$product->bid_start_date?>" <?php } ?>" placeholder="Bid Start Date" readonly="">
                                  
                              </div>
                               <span class="text-danger" id="bid_start_error"></span>
                            </div>
                        
                            <div class="form-group required" id="bid_edate" style="display:none;">
                              <label class="control-label col-sm-3 col-sm-offset-1 font_13" for="pwd">Bid End Date</label>
                              <div class="col-sm-8">           
                                  <input type="text" class="form-control datepicker" id="bid_end" name="bid_end" <?php if($product->bid_end_date!=0000-00-00){ ?> value="<?=$product->bid_end_date?>" <?php } ?> placeholder="Bid End Date" readonly="">
                              </div>
                              <span class="text-danger" id="bid_end_error"></span>
                            </div>
                        
                            <div class="form-group required" id="bid_pdate" style="display:none;">
                              <label class="control-label col-sm-3 col-sm-offset-1 font_13" for="pwd">Product Purchase Date</label>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control datepicker" id="bid_purchase" name="bid_purchase" <?php if($product->bid_purchase_date!=0000-00-00){ ?> value="<?=$product->bid_purchase_date?>" <?php } ?> placeholder="Product Pruchase Date" readonly="">
                              </div>
                              <span class="text-danger" id="bid_purchase_error"></span>
                            </div>
                        
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="quantity">Product Qty</label></div>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control" id="quantity" name="quantity" value="<?=$product->no_of_Prod?>" placeholder="Product Quantity" onkeyup="checknumber(this.id,this.value)" <?php if($product->bid_status==1){  ?> disabled="disabled" <?php } ?>>
                                  <span class="text-danger" id="quantity_error_nume"></span>
                                  <?php if(form_error('quantity')!='') echo form_error('quantity','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="quantity_error"></span>
                                  
                            </div>
                        
                            <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="price">Weight</label></div>
                                <div class="col-sm-8">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="weight" value="<?=$product->weight?>" name="weight" placeholder="Weight" onkeyup="checknumber(this.id,this.value)" >
                                      <span class="input-group-addon">Pound (LB) </span>
                                   </div>
                                   <?php if(form_error('weight')!='') echo form_error('weight','<div class="text-danger err">','</div>'); ?>
                                    <span class="text-danger" id="weight_error_nume"></span>
                                </div>
                                <span class="text-danger" id="weight_error"></span>
                            </div>
                        
                            <div class="control-group form-group required">
                                <div class="col-sm-3 col-sm-offset-1"> <label class="control-label pull-left">Dimensions</label></div>
                                <div class="col-sm-8 col-md-8 form-inline">
                                    <div class="col-md-4 paddign_leftright0">
                                        <div class="input-group diemension_field">
                                            <input type="text" class="form-control" value="<?=$product->length?>" placeholder="Length" id="length" name="length">
                                            <span class="input-group-addon">Inch (IN) </span>
                                        </div>
                                        <?php if(form_error('length')!='') echo form_error('length','<div class="text-danger err">','</div>'); ?>
                                        <span class="text-danger" id="length_error"></span>
                                    </div>
                                    <div class="col-md-4 paddign_leftright0">
                                        
                                        <div class="input-group diemension_field">
                                            <input type="text" class="form-control" value="<?=$product->width?>" placeholder="Width" id="width" name="width">
                                            <span class="input-group-addon">Inch (IN) </span>
                                        </div>
                                        <?php if(form_error('width')!='') echo form_error('width','<div class="text-danger err">','</div>'); ?>
                                        <span class="text-danger" id="width_error"></span>
                                    </div>
                                    <div class="col-md-4 paddign_leftright0">
                                        
                                        <div class="input-group diemension_field">
                                            <input type="text" class="form-control" value="<?=$product->height?>" placeholder="Height" id="height" name="height">
                                            <span class="input-group-addon">Inch (IN) </span>
                                        </div>
                                        <?php if(form_error('height')!='') echo form_error('height','<div class="text-danger err">','</div>'); ?>
                                        <span class="text-danger" id="height_error"></span>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="form-group required">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="local_shipping">Local Shipping</label></div>
                              <div class="col-sm-8">            
                                  <input type="text" class="form-control" id="local_shipping" name="local_shipping" value="<?=$product->local_shipping?>" placeholder="Local Shipping" onkeyup="checknumber(this.id,this.value)">
                                  <span class="text-danger" id="local_shipping_error_nume"></span>
                                  <?php if(form_error('local_shipping')!='') echo form_error('local_shipping','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="local_shipping_error"></span>
                                  
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left" for="tax">Taxable Status</label></div>
                              <div class="col-sm-8">
                                  <select class="form-control" id="tax" name="tax">
                                      <option value="0" <?php if($product->taxable_status==0){echo "selected"; } ?> >Non-Taxable</option>
                                        <option value="1" <?php if($product->taxable_status==1){echo "selected"; } ?> >Taxable</option>
                                        
                                </select>
                                  <?php if(form_error('tax')!='') echo form_error('tax','<div class="text-danger err">','</div>'); ?>
                              </div>
                              
                                  
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label pull-left " for="email">Status</label></div>
                              <div class="col-sm-8">
                                  <select class="form-control" id="status" name="status">
                                        <option value="1" <?php if($product->status==1){echo "selected"; } ?> >Active</option>
                                        <option value="0" <?php if($product->status==0){echo "selected"; } ?> >Inactive</option>
                                </select>
                                  <?php if(form_error('category')!='') echo form_error('category','<div class="text-danger err">','</div>'); ?>
                              </div>
                              
                                  
                            </div>
                        
                            
                            <div class="form-group">        
                              <div class="col-sm-offset-9 col-sm-3">
                                  <button type="submit" id="product" class="btn btn-success btn-block">Update</button>
                              </div>
                            </div>
                        
                        
                      </form>
                </div>
            </div>
        </div>

 <?php }else{echo "<h3 class='text-denger'>You are not authorized user for this product</h3>"; } ?>        
        
    </div>
</div>    

<script>
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
      });

      $(document).ready( function() {
          $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });
      
      $(document).ready(function(){
          var selltype=0;
          $("#product").click(function(){
              //alert("hii");
              var category = $("#category").val().trim();
              var name = $("#name").val().trim();
              var price = $("#price").val().trim();
              var details = $("#details").val().trim();
              var quantity = $("#quantity").val().trim();
               var local_shipping=$("#local_shipping").val().trim();
              
              var weight=$("#weight").val().trim();
              var length=$("#length").val().trim();
              var width=$("#width").val().trim();
              var height=$("#height").val().trim();
              //var details = $("#details").val().trim();
              
              var image =$("#image").val().trim(); 
              var ext = image.split('.').pop().toLowerCase();
              var allowed_ext=['jpg','png','jpeg'];
              //alert(jQuery.inArray(ext, allowed_ext) == -1);
              var check = jQuery.inArray(ext, allowed_ext) !== -1;
              
              
              //var file_size = $('#file')[0].files[0].size;
             
                
                if($(".selltype").checked){
                    var selltype = $(".selltype").val();
                }
                
                if(selltype==1){
                   var bid_start = $("#bid_start").val();
                   var bid_end = $("#bid_end").val();
                   
                   if(bid_start==''){
                        $("#bid_start").focus();
                        $("#bid_start_error").parent().addClass("has-error");
                        return false;
                   }
                   
                   if(bid_end==''){
                        $("#bid_end").focus();
                        $("#bid_end_error").parent().addClass("has-error");
                        return false;
                   }
                }
              
              if(category == ''){
                    //$("#fname_error").html("Enter Your First Name");
                    $("#category").focus();
                    $("#category_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(name == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#name").focus();
                    $("#name_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(price == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#price").focus();
                    $("#price_error").parent().addClass("has-error");
                    return false;    
              }else if(price > 100000){
                    $("#price_error_nume").html("$100000 is maximum price.");
                    $("#price").focus();
                    $("#price_error").parent().addClass("has-error");
                    return false;
              }
              
              
              
              if(image!=''){
                  if(!check){

                        $("#image1_error").html("Only jpg|png|jpeg Allowed");
                          $("#image_error").parent().addClass("has-error");
                          return false;
                    }
                    var file_size = $('#file')[0].files[0].size;
                    
                    if(file_size<=0){
                        $("#image1_error").html("This file is corrupted. So you can not upload this file.");
                        $("#image_error").parent().addClass("has-error");
                        return false;
                    }
                    
                    if(file_size>4096000) {
                        $("#image1_error").html("File size is greater than 4MB");
                        $("#image_error").parent().addClass("has-error");
                        return false;
                }
                }
              
              if(details == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#details").focus();
                    $("#details_error").parent().addClass("has-error");
                    return false;    
              }
              
              if(selltype==1){
                   var bid_start = $("#bid_start").val();
                   var bid_end = $("#bid_end").val();
                   
                   if(bid_start==''){
                        $("#bid_start").focus();
                        $("#bid_start_error").parent().addClass("has-error");
                        return false;
                   }
                   
                   if(bid_end==''){
                        $("#bid_end").focus();
                        $("#bid_end_error").parent().addClass("has-error");
                        return false;
                   }
                }else if(selltype==0){
                    if(quantity == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#quantity").focus();
                    $("#quantity_error").parent().addClass("has-error");
                    return false;    
                  }
                }
                
                if(weight == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#weight").focus();
                    $("#weight_error").parent().addClass("has-error");
                    return false;    
                }
                
                if(length == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#length").focus();
                    $("#length_error").parent().addClass("has-error");
                    return false;    
                }
                
                if(width == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#width").focus();
                    $("#width_error").parent().addClass("has-error");
                    return false;    
                }
                
                if(height == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#height").focus();
                    $("#height_error").parent().addClass("has-error");
                    return false;    
                }
              
                    if(local_shipping == ''){
                    $("#local_shipping").focus();
                    $("#local_shipping_error").parent().addClass("has-error");
                    return false;    
              }
              
              return true;
          });
          
          $(document).on("click",".selltype",function(){
             selltype = $(this).val(); 
             if(selltype==1){
                 $("#bid_sdate").slideDown();
                 $("#bid_edate").slideDown();
                 $("#bid_pdate").slideDown();
                 $("#quantity").attr("disabled",true);
             }else if(selltype==0){
                 $("#bid_sdate").slideUp();
                 $("#bid_edate").slideUp();
                 $("#bid_pdate").slideUp();
                 $("#quantity").attr("disabled",false);
             }
          });
          
//          $('.datepicker').datepicker({
//                    format: "yyyy-mm-dd",
//                    autoclose: true
//                    //endDate:'+0d'
//                }); 
      });
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_nume").html("Enter only numeric value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            //return false;
        }}else{
            $("#"+id+"_error_nume").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
        }
    }
    
    
</script>
<script>
    //var $j = jQuery.noConflict();
    $(function(){
        $( "#bid_start" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            minDate: 0,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#bid_end").datepicker("option", "minDate", dt);
            },
            onClose:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#bid_end").datepicker("option", "minDate", dt);
            }
            
        });
        $( "#bid_end" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            minDate: 0,
            onSelect:function(selected){
               // var tm='<?php echo date("H:i:s"); ?>';
               // alert(tm);
              // var dt = new Date(selected+' '+tm);
                var dt = new Date(selected);
            dt.setDate(dt.getDate()+1);
            $("#bid_purchase").datepicker("option", "minDate", dt);
            $("#bid_start").datepicker("option", "maxDate", dt);
            },
//            onClose:function(selected){
//                var dt = new Date(selected);
//            dt.setDate(dt.getDate()+1);
//            $("#bid_purchase").datepicker("option", "minDate", dt);
//            $("#bid_start").datepicker("option", "maxDate", dt);
//            }
        });
        $( "#bid_purchase" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            minDate: 0,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate());
            $("#bid_end").datepicker("option", "maxDate", dt);
            },
//             onClose:function(selected){
//                var dt = new Date(selected);
//            dt.setDate(dt.getDate());
//            $("#bid_end").datepicker("option", "maxDate", dt);
//            }
        });
    });
</script>