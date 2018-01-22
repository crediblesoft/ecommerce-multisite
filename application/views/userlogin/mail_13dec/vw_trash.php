
<div class="row">
 <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
<div class="col-sm-12">
    
    <div class="contant-head1 gredient_forum">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 clearfix">
        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  Manage Mail </h4> <h5 class="margin_top_28"> > Create mail </h5>
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
                    <input type = "hidden" class = "form-control" name="page" value="trash">
                    <input type = "text" class = "form-control" id="search" name="search" placeholder="From">
                    <span class = "input-group-btn">
                        <button class = "btn btn-default" id="trash_search" type = "submit"> <span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
                </form>
            </div>
            <div class="panel-body cus_panel_body_mail table-responsive">
                <table class="table table-striped mail_inbox">
                    <thead>
                        <tr>
                            <th width='5%'><input type="checkbox" id="select-all"></td>
                            <th width='25%'> Subject </td>
                            <th width='45%'  >From</td>
                            <th width='20%' >Date</td>
                            <th width='5%' > <i class="fa fa-fw fa-paperclip"></i></td>
                       </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($trash_mail_to['res']){ 
                            foreach($trash_mail_to['rows'] as $inbox){

                         ?>
                        <tr >
                            <td width='5%' ><input type="checkbox" value="<?=$inbox->mail_id?>" class="innercheckbox"></td>
                           <td width='25%' class='clickable-row' data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>" title="click to view" ><?php echo substr($inbox->subject,0,40); ?></td>
                          <td width='50%' class='clickable-row'   data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>/<?=$inbox->inboxid?>" title="click to view" ><?php if($inbox->f_name==''){ echo "System Generated"; }else{ echo $inbox->f_name.' '.$inbox->l_name; } ?></td>
                          <td width='20%' class='clickable-row' data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>" title="click to view" ><?=date('Y-m-d',$inbox->timestamp)?></td>
                          <td width='5%' class='clickable-row'  data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>/<?=$inbox->inboxid?>" title="click to view"><?php if($inbox->attach){ ?> <i class="fa fa-fw fa-paperclip"></i> <?php } ?></td>
                       </tr>
                            <?php } } ?>
                       
                        <?php 
                            if($trash_mail['res']){ 
                            foreach($trash_mail['rows'] as $send){
                        ?>
                        <tr >
                         <td width='5%'><input type="checkbox" value="<?=$send->mail_id?>" class="innercheckbox_send"></td>
                          <td width='25%' class='clickable-row' data-href="<?=BASE_URL?>mail/detail/<?=$send->mail_id?>" title="click to view" ><?php echo substr($send->subject,0,40); ?></td>
                          <td width='50%' class='clickable-row' data-href="<?=BASE_URL?>mail/detail/<?=$send->mail_id?>" title="click to view"><?php echo $send->f_name.' '.$send->l_name;?></td>
                          <td width='20%' class='clickable-row' data-href="<?=BASE_URL?>mail/detail/<?=$send->mail_id?>" title="click to view"><?=date('Y-m-d',$send->timestamp)?></td>
                          <td width='5%' class='clickable-row'  data-href="<?=BASE_URL?>mail/detail/<?=$inbox->mail_id?>/<?=$inbox->inboxid?>" title="click to view"><?php if($send->attach){ ?> <i class="fa fa-fw fa-paperclip"></i> <?php } ?></td>
                       </tr>
                            <?php } } ?>
                       
                       
                    </tbody>
                 </table>
            </div>
            <div class="cus_mail_panel_footer">
                
                <a href="javascript:void(0)" title="delete" class="delete"><span class="glyphicon glyphicon-remove-sign"></span></a>
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


<!-- Modal -->
<div id="un_chk_mailtodelete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body">
          <h4 id="un_chk_deletemsg"></h4>
      </div>
      <div class="modal-footer">
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
                $(".innercheckbox_send").prop("checked",true);
            }else{
                $(".innercheckbox").prop("checked",false);
                $(".innercheckbox_send").prop("checked",false);
            }
        });
        
        $('#trash_search').click(function(event) {   
            var search = $("#search").val().trim();
            if(search==''){
              return false;
            }
        });
        
        $(".delete").click(function(){
            if((!$(".innercheckbox").is(':checked')) && (!$(".innercheckbox_send").is(':checked'))){
                $("#un_chk_deletemsg").html("Please select at least one mail.");
                $("#un_chk_mailtodelete").modal("show");
            }else{
                 $("#deletemsg").html("Do you want to delete selected mail?");
                 $("#mailtodelete").modal("show");
            }
        });
        
        $(document).on("click","#cnf2delete",function(){
            var selectedmail=[];
            var selectedmail_send=[];
            var alertmsg=false;
            
            $('input:checkbox.innercheckbox').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail.push(sThisVal);
                }
            });
            
             $('input:checkbox.innercheckbox_send').each(function () {
                var sThisVal = (this.checked ? $(this).val() : "");
                if(sThisVal!=""){
                    selectedmail_send.push(sThisVal);
                }
            });
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
                $.ajax({
                type: 'POST',
                url: '<?=BASE_URL?>mail/inboxtodelete',
                data: {selectedmail:selectedmail},
                success: function(data,status){
                                var obj= $.parseJSON(data);
                                if(obj.status){
                                    alertmsg=true;
                                }
                                },
                //dataType: dataType,
                async:false
              });
            }
            
            
            if(selectedmail_send.length > 0){
            $.ajax({
                type: 'POST',
                url: '<?=BASE_URL?>mail/sendtodelete',
                data: {selectedmail:selectedmail_send},
                success: function(data,status){
                                var obj= $.parseJSON(data);
                                if(obj.status){
                                    alertmsg=true;
                                }
                                },
                //dataType: dataType,
                async:false
              });
            }
            
            //alert(alertmsg);
            
            if(alertmsg){
                $("#deletemsg").empty().append("Successfully delete mail.").addClass("alert alert-success fade in");
                setTimeout(function(){
                    window.location.reload();
                }, 1000); 
            }
            
        });
        
    });
    
</script>