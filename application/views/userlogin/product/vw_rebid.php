<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> <a href="<?=BASE_URL?>product"> Manage Product</a> </h4><h5> > rebid </h5>
                         
                    </div>
                </div>
            </div>
    
            <div class="contant-body1">
                <div class="">
                    <form class="form-horizontal" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>product/rebid/<?=$prodid?>">
                        <input type="hidden" id="prodid" name="prodid" value="<?=$prodid?>">
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-1"><label class="control-label" for="price">Product Price</label></div>
                              <div class="col-sm-8"> 
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="price" value="<?=  set_value('price')?>" name="price" placeholder="Product Price" onkeyup="checknumber(this.id,this.value)" >
                                 </div>
                                 <?php if(form_error('price')!='') echo form_error('price','<div class="text-danger err">','</div>'); ?>
                                  <span class="text-danger" id="price_error_nume"></span>
                              </div>
                              <span class="text-danger" id="price_error"></span>
                                  
                            </div>
                        
                        
                        <div class="form-group" id="bid_sdate">
                              <label class="col-sm-3 col-sm-offset-1" for="pwd">Bid Start Date</label>
                              <div class="col-sm-8">    
                                  <input type="text" class="form-control datepicker" id="bid_start" name="bid_start" value="<?=set_value('bid_start')?>" readonly placeholder="Bid Start Date">
                                  <?php if(form_error('bid_start')!='') echo form_error('bid_start','<div class="text-danger err">','</div>'); ?>
                              </div>
                               <span class="text-danger" id="bid_start_error"></span>
                               
                            </div>
                        
                        <div class="form-group" id="bid_edate">
                              <label class="col-sm-3 col-sm-offset-1" for="pwd">Bid End Date</label>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control datepicker" id="bid_end" name="bid_end" value="<?=set_value('bid_end')?>" readonly placeholder="Bid End Date">
                                  <?php if(form_error('bid_end')!='') echo form_error('bid_end','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="bid_end_error"></span>
                              
                            </div>
                        
                        <div class="form-group" id="bid_pdate">
                              <label class="col-sm-3 col-sm-offset-1" for="pwd">Product Purchase Date</label>
                              <div class="col-sm-8">          
                                  <input type="text" class="form-control datepicker" id="bid_purchase" name="bid_purchase" value="<?=set_value('bid_purchase')?>" readonly placeholder="Product Purchase Date">
                                  <?php if(form_error('bid_purchase')!='') echo form_error('bid_purchase','<div class="text-danger err">','</div>'); ?>
                              </div>
                              <span class="text-danger" id="bid_purchase_error"></span>
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
          
          $("#product").click(function(){
              //alert("hii");
            var price = $("#price").val().trim();
            var bid_start = $("#bid_start").val();
            var bid_end = $("#bid_end").val();
            var bid_purchase = $("#bid_purchase").val();  
              
              
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

            if(bid_purchase==''){
                 $("#bid_purchase").focus();
                 $("#bid_purchase_error").parent().addClass("has-error");
                 return false;
            }
                
              
              return true;
          });

          
         /* $('.datepicker').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true
                    //endDate:'+0d'
                }); */

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
            }
        });
        $( "#bid_end" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy-mm-dd',
            autoclose:true,
            minDate: 0,
            onSelect:function(selected){
                var dt = new Date(selected);
            dt.setDate(dt.getDate()+1);
            $("#bid_purchase").datepicker("option", "minDate", dt);
            $("#bid_start").datepicker("option", "maxDate", dt);
            }
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
            }
        });
    });
</script>
