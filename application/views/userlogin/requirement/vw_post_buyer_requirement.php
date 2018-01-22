<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>   Shopping List </h4><h5> > add </h5>
                         
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>requirement/post">
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="email">Category</label></div>
                              <div class="col-sm-9">
                                  <select class="form-control" id="category" name="category">
                                    <option value="">----Select Category-----</option>
                                    <?php
                                        if($category['res']){
                                            foreach($category['rows'] as $category){
                                        
                                    ?>
                                        <option value="<?=$category->id?>" <?php echo set_select('category', $category->id); ?> ><?=$category->category?></option>
                                        <?php } } ?>
                                </select>
                                  <?php if(form_error('category')!='') echo form_error('category','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="category_error"></span>
                                  
                            </div>
                        
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="price">Budget</label></div>
                              <div class="col-sm-9"> 
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="price" value="<?=  set_value('price')?>" name="price" placeholder="Product Price" onkeyup="checknumber(this.id,this.value)" >
                                 </div>
                                 <?php if(form_error('price')!='') echo form_error('price','<div class="text-danger err">','</div>'); ?>
                                  <span class="text-danger" id="price_error_nume"></span>
                              </div>
                              <span class="text-danger" id="price_error"></span>
                                  
                            </div>
                        
                         
                            
                         
                        
                            <div class="form-group">
                                <div class="col-sm-2 col-sm-offset-1"><label class="control-label" for="details">Requirement</label></div>
                              <div class="col-sm-9">          
                                  <textarea class="form-control" id="details" name="details" placeholder="About Your Requirement"><?=set_value('details')?></textarea>
                                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="details_error"></span>
                                  
                            </div>
                         
        
                            <div class="form-group">        
                              <div class="col-sm-offset-9 col-sm-3">
                                  <button type="submit" id="product" class="btn btn-success btn-block">Submit</button>
                              </div>
                            </div>
                        
                        
                      </form>
                </div>
            </div>
        </div>


</div>
</div>



<script>
    
      $(document).ready(function(){
          /*var bid=$("#bid").is(':checked') ? 1 : 0;
            if(bid==1){
                 $("#bid").click();       
             }*/
          //var selltype=0;
          $("#product").click(function(){
              //alert("hii");
              var category = $("#category").val().trim();
              //var name = $("#name").val().trim();
              var price = $("#price").val().trim();
              var details = $("#details").val().trim();
             // var quantity = $("#quantity").val().trim();
              //var details = $("#details").val().trim();
              
//              var image =$("#image").val().trim(); 
//              var ext = image.split('.').pop().toLowerCase();
//              var allowed_ext=['jpg','png','jpeg'];
//              //alert(jQuery.inArray(ext, allowed_ext) == -1);
//              var check = jQuery.inArray(ext, allowed_ext) !== -1;
              //alert(check);
             
              //alert(file_size);
                
              if(category == ''){
                    //$("#fname_error").html("Enter Your First Name");
                    $("#category").focus();
                    $("#category_error").parent().addClass("has-error");
                    return false;    
              }
              
              
              
              if(price == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#price").focus();
                    $("#price_error").parent().addClass("has-error");
                    return false;    
              }
              
              
              if(details == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#details").focus();
                    $("#details_error").parent().addClass("has-error");
                    return false;    
              }
              
              /*if(quantity == ''){
                    //$("#name_error").html("Enter Your First Name");
                    $("#quantity").focus();
                    $("#quantity_error").parent().addClass("has-error");
                    return false;    
              }*/
              
              
              
              return true;
          });

      });
    
    function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error_nume").html("Enter Only Numeric Value");
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
