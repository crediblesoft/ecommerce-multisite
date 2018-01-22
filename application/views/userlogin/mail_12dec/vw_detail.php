<?php 
$mailfrom=$mailfrom['rows'][0]; //print_r($mailto);
?>
<style type="text/css">
    .row2{ float: right;
    margin-right: 1px;}
    
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
            <div class="cus_mail_panel_heading">
                
                <div class="row col-sm-7 col-md-7 col-lg-7 col-xs-12">
                <!--<input type="checkbox">&nbsp;-->
                    
                <a href="<?=BASE_URL?>mail" class="btn btn-success btn-sm">Inbox</a>&nbsp;
                <a href="<?=BASE_URL?>mail/createnew" class="btn btn-success btn-sm">Create New</a>&nbsp;
                <a href="<?=BASE_URL?>mail/send" class="btn btn-success btn-sm">Send Mail</a>&nbsp;
                <a href="<?=BASE_URL?>mail/trash" class="btn btn-success btn-sm">Trash Mail</a>
                
                </div>
                
                <div class="row row2 col-md-5 col-lg-5 col-xm-5 col-xs-12">
                    <?php if($mailfrom->f_name!=''){ // condition for system generated mail ?>
                    <div class="row pull-right">
                <a href="<?=BASE_URL?>mail/reply/<?=$mailfrom->mail_id?>" class="btn btn-success btn-sm">Reply</a>&nbsp;
                <a href="<?=BASE_URL?>mail/replyall/<?=$mailfrom->mail_id?>" class="btn btn-success btn-sm">Reply To All</a>&nbsp;
                <a href="<?=BASE_URL?>mail/forward/<?=$mailfrom->mail_id?>" class="btn btn-success btn-sm">Forward</a>
                <?php if($mailfrom->attach){ ?>
                <a href="<?=BASE_URL?>mail/download/<?=$mailfrom->mail_id?>" class="btn btn-success btn-sm"> <span class="glyphicon glyphicon-download-alt"></span> Download</a>
                <?php } ?>
                    </div>
                    <?php } ?>   
                </div>
                
            </div>
            <div class="panel-body cus_panel_body_mail">
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 cus_mail_detail_head margin-bottom_25">
                    <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12">
                        <div class="row col-sm-1 col-lg-1 col-md-1 col-xs-12 cus_mail_detail_innerhead margin_right_15">
                            From
                        </div>
                        <div class="row col-sm-11 col-lg-11 col-md-11 col-xs-12">
                            <?php if($mailfrom->f_name==''){ ?>
                            System Generated
                            <?php }else{ ?>
                            <?=ucfirst($mailfrom->f_name)?> <?=ucfirst($mailfrom->l_name)?> (<?=$mailfrom->username?>)
                            <?php } ?>
                        </div>
                    </div>
                    <div class=" row col-sm-12 col-lg-12 col-md-12 col-xs-12">
                        <div class="row col-sm-1 col-lg-1 col-md-1 col-xs-12 cus_mail_detail_innerhead margin_right_15">
                            To
                        </div>
                        <div class="row col-sm-11 col-lg-11 col-md-11 col-xs-12">
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
                        <div class="row col-sm-1 col-lg-1 col-md-1 col-xs-12 cus_mail_detail_innerhead margin_right_15">
                            Subject
                        </div>
                        <div class="row col-sm-11 col-lg-11 col-md-11 col-xs-12">
                            <?=$mailfrom->subject?>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <div class="row col-sm-12 col-lg-12 col-md-12 col-xs-12">
                        <div>
                            <?=$mailfrom->message?>
                        </div>
                    </div>
                </div>   
            </div>
            <div class="cus_mail_panel_footer">
                
            </div>
        </div>
        
    </div>
    </div>
    </div>
               
        </div>
        
        
    </div>
</div> 
