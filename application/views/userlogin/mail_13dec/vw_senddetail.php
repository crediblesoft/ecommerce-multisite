<?php 
$mailfrom=$mailfrom['rows'][0]; //print_r($mailto);
$url_param=$this->uri->segment(3);
?>
 <style type="text/css">
                   .left_mail{padding-left: 29px;}
                   .margin_10{margin-left: 10px;}
               </style>
<div class="row">
 <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
<div class="col-sm-12">
    
    <div class="contant-head1 gredient_forum">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 clearfix">
        <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span>  Manage Mail </h4> <h5 class="margin_top_28"> > View Details </h5>
        <!--<span class="add-button">
        <div class="input-group">
         <input type="text" autocomplete="off" class="form-control" name="forum_topic_search" placeholder="search category" id="searchbycategoryname">
         <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
      </div>
        </span>-->
    </div>
    </div>
    <div class="contant-body1">
    <div class="row">

    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="panel panel-default">
         <input type="hidden" name="" id="url" value="<?php echo $url_param; ?>"> 
            <div class="cus_mail_panel_heading">
                
                <div class="col-sm-8 col-md-8 col-lg-7 col-xs-12">
              
                <a href="<?=BASE_URL?>mail" class="btn btn-success btn-sm">Inbox</a>&nbsp;
                <a href="<?=BASE_URL?>mail/createnew" class="btn btn-success btn-sm">Create New</a>&nbsp;
                <a href="<?=BASE_URL?>mail/send" class="btn btn-success btn-sm">Send Mail</a>&nbsp;
                <a href="<?=BASE_URL?>mail/trash" class="btn btn-success btn-sm">Trash Mail</a>
                </div>
                
                <div class="col-md-4 col-lg-5 col-xm-4 col-xs-12 pull-right">
                <a href="<?=BASE_URL?>mail/sendreply/<?=$mailfrom->mail_id?>" class="btn btn-success btn-sm">Reply</a>&nbsp;
                <a href="<?=BASE_URL?>mail/sendreplyall/<?=$mailfrom->mail_id?>" class="btn btn-success btn-sm">Reply To All</a>&nbsp;
                <a href="<?=BASE_URL?>mail/forward/<?=$mailfrom->mail_id?>" class="btn btn-success btn-sm">Forward</a>
                <?php if($mailfrom->attach){ ?>
                <a href="<?=BASE_URL?>mail/download/<?=$mailfrom->mail_id?>" class="btn btn-success btn-sm"> <span class="glyphicon glyphicon-download-alt"></span> Download</a>
                <?php } ?>
                </div>
                
            </div>
            <div class="panel-body cus_panel_body_mail">
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_mail_detail_head margin-bottom_25 left_mail">
                    <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12">
                        <div class="row col-sm-1 col-lg-1 col-md-1 col-xs-12 cus_mail_detail_innerhead">
                            From
                        </div>
                        <div class="row col-sm-11 col-lg-11 col-md-11 col-xs-12 margin_10">
                            <?=ucfirst($mailfrom->f_name)?> <?=ucfirst($mailfrom->l_name)?> (<?=$mailfrom->username?>)
                        </div>
                    </div>
                    <div class=" row col-sm-12 col-lg-12 col-md-12 col-xs-12 ">
                        <div class="row col-sm-1 col-lg-1 col-md-1 col-xs-12 cus_mail_detail_innerhead">
                            To
                        </div>
                        <div class="row col-sm-11 col-lg-11 col-md-11 col-xs-12 margin_10">
                            <?php 
                                if($mailto['res']){
                                    foreach($mailto['rows'] as $mailtouser){
                                        echo ucfirst($mailtouser->f_name).' '.ucfirst($mailtouser->l_name).' ('.$mailtouser->username.') , ';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12">
                        <div class="row col-sm-1 col-lg-1 col-md-1 col-xs-12 cus_mail_detail_innerhead">
                            Subject
                        </div>
                        <div class="row col-sm-11 col-lg-11 col-md-11 col-xs-12 margin_10">
                            <?=$mailfrom->subject?>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12">
                        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                            <?=$mailfrom->message?>
                        </div>
                    </div>
                </div>   
            </div>
             <div class="cus_mail_panel_footer">
                <a href="javascript:void(0)" title="Delete" class="trash"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;
                <!--<a href="#mailtodelete" title="delete" class="delete" data-traget="#mailtodelete" data-toggle="modal"><span class="glyphicon glyphicon-remove-sign"></span></a>-->
            </div> 
        </div>
        
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
        
        $(".trash").click(function(){
           
                 $("#trashmsg").html("Do you want to move into trash selected mail?");
                 $("#mailtotrash").modal("show");
           
        });
        
        $(document).on("click","#cnf2trash",function(){
            var selectedmail=$('#url').val();
            
            //alert(selectedmail.length);
            if(selectedmail.length > 0){
            $.post("<?=BASE_URL?>mail/sendtotrash",{selectedmail:selectedmail},function(data,status){
                var obj= $.parseJSON(data);
            if(obj.status){
                    $("#trashmsg").empty().append(obj.message).addClass("alert alert-success fade in");
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                        $(location).attr('href', '<?=BASE_URL?>mail/send')

                }
            });
        }
        });
        
    });
    
</script>
    