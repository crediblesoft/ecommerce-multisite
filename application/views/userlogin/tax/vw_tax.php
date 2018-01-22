<div class="col-sm-9 col-lg-9 col-md-9 col-xs-12">
    <div class="">
        <div class="">
            <div class="contant-head">
                 <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Tax</h4>
            </div>
        </div>
    </div>
    <div class="contant-body1">
    <div class="">
        <form class="form-horizontal" role="form">
            <div class="row col-sm-12 pull-right padding_left_20">
                <input type="hidden" id="default" value="<?php echo $default;?>">
                <input type="hidden" id="u_taxid" value="<?php echo $tax->id;?>">
            <div class="col-sm-8 ">
                <div class="form-group required">                  
                    <label for="inputLname" class="control-label">Tax Title</label>
                    <input type="text" class="form-control" id="details" name="details" placeholder="Tax Title" value="<?php if(set_value('details')!=''){echo set_value('details');}else{echo $tax->details;}?>">
                    <span class="text-danger" id="details_error"></span>
                  <?php if(form_error('details')!='') echo form_error('details','<div class="text-danger err">','</div>'); ?>
                </div>
            </div>
            <div class="col-sm-3 pull-right">
                <div class="form-group required">                  
                    <label for="inputFname" class="control-label">Percentage</label>
                    
                    <div class="input-group">
                    <input type="text" class="form-control" id="total" name="total" value="<?php if(set_value('total')!=''){echo set_value('total');}else{echo $tax->total;}?>" placeholder="" onkeyup="checknumber(this.id,this.value)">
                    <span class="input-group-addon" id="basic-addon1">%</span>
                  </div>
                    <span class="text-danger" id="total_error"></span>
                    <?php if(form_error('total')!='') echo form_error('total','<div class="text-danger err">','</div>'); ?>
                </div>
            </div>
            </div>
            
            <div class="form-group">        
              <div class="col-sm-offset-10 col-sm-2">
                  <button type="submit" id="tax" class="btn btn-success btn-block">Set Tax</button>
              </div>
            </div>
                        
                        
       </form>
    </div>
    </div>
</div>

</div>
</div>


<!-- Modal -->
<div id="message" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="trastitle"></h4>
      </div>
      <div class="modal-body">
          <h4 id="trashmsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
$(document).ready(function(){
   $("#tax").click(function(){
       //alert($("#agree").val());
      var details=$("#details").val().trim();
      var total=$("#total").val().trim();
      var flag=true;
      if(details == ''){
          flag=false;
            //$("#fname_error").html("Enter Your First Name");
            $("#details").focus();
            $("#details_error").parent().addClass("has-error");
            return false;    
      }
      
      if(total == ''){
            flag=false;
            //$("#fname_error").html("Enter Your First Name");
            $("#total").focus();
            $("#total_error").parent().addClass("has-error");
            return false;    
      }
      
      if(flag){
         addtax(details,total);
         return false;
      }
   }); 
});


function addtax(details,total){
    var default1=$("#default").val().trim();
    var id=$("#u_taxid").val().trim();
    $.post("<?php echo BASE_URL ?>tax/settax",{details:details,total:total,default1:default1,id:id},function(data,status){
        var obj= $.parseJSON(data);
        if(obj.status){
            $("#message").modal("show");
            $("#trashmsg").empty().append(obj.message).addClass("alert alert-success fade in");
            $("#trastitle").empty().append(obj.title);
                setTimeout(function(){
                    window.location.reload();
                }, 1000); 
        }else{
            $("#message").modal("show");
            $("#trashmsg").empty().append(obj.message).addClass("alert alert-danger fade in");
            $("#trastitle").empty().append(obj.title);
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
        }
    });
}

function checknumber(id,value){
        if(value!=''){
        if(!$.isNumeric( value )){
            $("#"+id+"_error").html("Enter Only Numeric Value");
            $("#"+id).focus();
            $("#"+id+"_error").parent().addClass("has-error");
            $("#tax").attr("disabled",true);
            //return false;
        }else{
            //if(value>100){ $("#"+id+"_error").html("Not more then 100%");}
            $("#"+id+"_error").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
            $("#tax").attr("disabled",false);
        }}else{
            $("#"+id+"_error").html("");
            $("#"+id).focus();
            $("#"+id+"_error").parent().removeClass("has-error");
            $("#tax").attr("disabled",false);
        }
    }
</script>
