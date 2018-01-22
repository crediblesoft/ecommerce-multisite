<div class="row">
 <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
<div class="col-sm-12">
    
    <div class="contant-head1 gredient_forum">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 clearfix">
        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  Manage Mail </h4> <h5 class="margin_top_28"> > Inbox </h5>
        <span class="add-button">
        <!--<div class="input-group">
         <input type="text" autocomplete="off" class="form-control" name="forum_topic_search" placeholder="search category" id="searchbycategoryname">
         <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
      </div>-->
        </span>
    </div>
    </div>
    <div class="contant-body1">
    <div class="row">

    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="panel panel-default">
            <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
            <div class="cus_mail_panel_heading">
                
                <a href="<?=BASE_URL?>mail" class="btn btn-success btn-sm">Inbox</a>&nbsp;
                <a href="<?=BASE_URL?>mail/createnew" class="btn btn-success btn-sm">Create New</a>&nbsp;
                <a href="<?=BASE_URL?>mail/send" class="btn btn-success btn-sm">Send Mail</a>&nbsp;
                <a href="<?=BASE_URL?>mail/trash" class="btn btn-success btn-sm">Trash Mail</a>
            </div>
            </div>
            
            <div class="cus_mail_panel_heading">
                <form name="mail_search" method="get" action="<?=BASE_URL?>mail/search" >
                <div class = "input-group">
                    <input type = "hidden" class = "form-control" name="page" value="inbox">
                    <input type = "text" class = "form-control" id="search" name="search" placeholder="From">
                    <span class = "input-group-btn">
                        <button class = "btn btn-default" id="inbox_search" type = "submit"> <span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
                </form>
            </div>
            
            <div class="panel-body cus_panel_body_mail table-responsive">
                <table class="table table-striped mail_inbox">
                    <thead>
                        <tr>
                            <th width='5%'><input type="checkbox"  id="select-all"></td>
                            <th width='35%'> Subject </td>
                            <th width='35%'  >From</td>
                            <th width='20%' >Date</td>
                            <th width='5%' > <i class="fa fa-fw fa-paperclip"></i></td>
                       </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($inboxlist['res']){ 
                            foreach($inboxlist['rows'] as $inbox){
                         ?>
                        <tr  <?php if(!$inbox->mailview){ ?> style="font-weight: bold;" <?php } ?>  >
                            <td width='5%'><input type="checkbox" value="<?=$inbox->mail_id?>" class="innercheckbox"></td>
                            <td width='25%' class='clickable-row' data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>/<?=$inbox->inboxid?>" title="click to view"><?php echo substr($inbox->subject,0,40); ?></td>
                            <td width='45%' class='clickable-row'   data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>/<?=$inbox->inboxid?>" title="click to view" ><?php if($inbox->f_name==''){ echo "System Generated"; }else{ echo $inbox->f_name.' '.$inbox->l_name; } ?></td>
                            <td width='20%' class='clickable-row'   data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>/<?=$inbox->inboxid?>" title="click to view"><?=date('Y-m-d',$inbox->timestamp)?></td>
                            <td width='5%' class='clickable-row'  data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>/<?=$inbox->inboxid?>" title="click to view"><?php if($inbox->attach){ ?> <i class="fa fa-fw fa-paperclip"></i> <?php } ?></td>
                       </tr>
                            <?php } } ?>
                    </tbody>
                 </table>
            </div>
            <div class="cus_mail_panel_footer">
                <a href="javascript:void(0)" title="Delete" class="trash"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;
                <!--<a href="#mailtodelete" title="delete" class="delete" data-traget="#mailtodelete" data-toggle="modal"><span class="glyphicon glyphicon-remove-sign"></span></a>-->
            </div>
        </div>
        <ul class="pagination pagination-sm no-margin pull-right"><?=$links?></ul>
    </div>
    </div>
    </div>    
        </div>
    </div>
</div> 

<!-- Modal -->
<div id="mailtotrash" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Trash</h4>
      </div>
      <div class="modal-body">
          <h4 id="trashmsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2trash">Confirm</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal -->
<div id="un_chk_mailtotrash" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Trash</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_chk_trashmsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="mailtodelete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body">
          <h4 id="deletemsg"></h4>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success confirm" id="cnf2delete">Confirm</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.document.location = $(this).data("href");
        });
        
        $('#select-all').click(function(event) {   
            if(this.checked) {
                $(".innercheckbox").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
            }
        });
        
        $('#inbox_search').click(function(event) {   
            var search = $("#search").val().trim();
            if(search==''){
              return false;
            }
        });
        
        $(".trash").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#un_chk_trashmsg").html("Please select at least one mail.");
                $("#un_chk_mailtotrash").modal("show");
            }else{
                 $("#trashmsg").html("Do you want to move into trash selected mail?");
                 $("#mailtotrash").modal("show");
            }
        });
        
        $(document).on("click","#cnf2trash",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>mail/inboxtotrash",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#trashmsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
        
        
        
        $(".delete").click(function(){
            if(!$(".innercheckbox").is(':checked')){
                $("#deletemsg").html("Please select at least one mail.");
            }else{
                 $("#deletemsg").html("Do you want to Delete selected mail?");
            }
        });
        
        $(document).on("click","#cnf2delete",function(){
            var selectedmail=[];
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>mail/inboxtodelete",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#deletemsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                }
            });
        }
        });
        
    });
    
</script>
