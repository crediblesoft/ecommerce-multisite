<link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>chat/css/chat.css" />
<!--<link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>chat/css/screen.css" />-->
<script type="text/javascript" src="<?=base_url()?>chat/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>chat/js/chat.js"></script>
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>chat/css/screen_ie.css" />
<![endif]-->
<div class="container">
    <div class="row profile">
        <div class="col-md-4">
<?php
//session_start();
//$_SESSION['username'] = $me; // Must be already set
//$_SESSION['userNameshow'] = $userNameshow;
//echo $_SESSION['userNameshow'];
?>

<style>
body {
	background-color: #eeeeee;
	padding:0;
	margin:0 auto;
	font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
	font-size:11px;
}
#main_container li {width:50%;padding: 5px;}
</style>
<style>
    .cus_text{margin-left: 10px;}
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}
.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 450px;
    padding: 3px 3px;
}
#msg-container{
    overflow-y: scroll;
    height: 450px;
    padding: 3px 3px;  
}
::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
.media
{
    border-bottom: 1px dotted #b3a9a9;
}
.media:hover
{
    cursor: pointer;
}
.text-msg-input
{
    height: 120px;
}
</style>


<!--<ul id="main_container">
<?php /*foreach($userlist as $user){ ?>
<li>
<a href="javascript:void(0)" onclick="javascript:chatWith('<?=$user->id?>','<?=$user->username?>')"><?=$user->username?></a>
    </li>
<?php }*/ ?>

</ul>-->
            
<div class="panel panel-default">
                <div class="panel-heading">CONVERSATION WITH USERS</div>
                <!--<div class="panel-footer">
                    <div class="input-group" style="height:50%;width:100%">
                        <div class="form-group">
                             <div class="row col-sm-12">          
                                  <input type="text" class="form-control" id="searchbyusername" value="" onkeyup="searchbyusername(this.value)" name="searchbyusername" placeholder="Search user">
                                </div>
                        </div>
                        <div class="autosearchresult_msg" id="autosearchresult_msg" style="">
                
                                <ul class="col-sm-12 col-md-12 col-lg-12 col-xs-12 search_list_head">
                                    <li class="row">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=BASE_URL?>assets/image/usericon.png"> &nbsp; Sellers</li>
                                    <li><span class="cus_bolt_icon">&nbsp;</span><a href="">test</a></li>
                                    <li><span class="cus_bolt_icon">&nbsp;</span><a href="">test</a></li>

                                </ul>
                                
                        </div>
                    </div>
                </div>-->
                <div class="panel-body">
                    <ul class="media-list">
                        <li class="media">
                            <div class="media-body" id="conservation-user">
                                <?php
                                if(count($users) > 0){
                                foreach($users as $userdata){
                                 // echo "<pre>";
                                  //  print_r($userdata);
                                   if($userdata->type_Of_User==1){
                                       $text=$userdata->business_name;
                                   } 
                                   else{
                                       $text=$userdata->username;
                                   }
                                ?>
                                <div class="media users-with" id="<?=$userdata->id?>" onclick="javascript:chatWith('<?=$userdata->id?>','<?=$userdata->username?>')">
                                    <a href="javascript:void(0);" class="pull-left"><img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userdata->profile_Pic?>" style="height:30px; width: 30px;" class="media-object img-circle"></a>
                                    <div class="media-body">
                                        <h5><?=ucfirst($userdata->first_name).' '.ucfirst($userdata->last_name)?><span class='cus_text'>(<?php echo $text; ?>)</span></h5>
                                        <small class="text-muted"><span class="badge" id="get-new-<?=$userdata->id?>"></span><span id="no-new-<?=$userdata->id?>">No</span> new message</small>
                                    </div>
                                    <?php if($userdata->is_login){ ?>
                                    <i class="btn btn-default  btn-circle pull-right" title="online" style="z-index:331;position:relative;bottom: 26px;background: #00AF55;padding-left: 8px;"></i>
                                    <?php }else{ ?>
                                    <i class="btn btn-default  btn-circle pull-right" title="offline" style="z-index:331;position:relative;bottom: 26px;background: #AAB0AD;padding-left: 8px;"></i>
                                    <?php } ?>
                                </div>
                                <?php } } else { echo 'No user online for conservation with you.<br/>'; } ?>
                                <!-- list of offline user when send message-->
                                <?php
                                if(count($offlineusers) > 0){
                                foreach($offlineusers as $userdata1){
                                ?>
                                <div class="media users-with" id="<?=$userdata1->id?>">
                                    <a href="javascript:void(0);" class="pull-left"><img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userdata1->profile_Pic?>" style="height:30px; width: 30px;" class="media-object img-circle"></a>
                                    <div class="media-body">
                                        <h5><?=ucfirst($userdata1->first_name).' '.ucfirst($userdata1->last_name)?><span class='cus_text'>(<?php echo $text; ?>)</span></h5>
                                        <small class="text-muted"><span class="badge" id="get-new-<?=$userdata1->id?>"><?=$userdata1->noofmsg?></span><span id="no-new-<?=$userdata1->id?>"></span> new message</small>
                                    </div>
                                    <?php if($userdata1->is_login){ ?>
                                    <i class="btn btn-default  btn-circle pull-right" title="online" style="z-index:331;position:relative;bottom: 26px;background: #00AF55;padding-left: 8px;"></i>
                                    <?php }else{ ?>
                                    <i class="btn btn-default  btn-circle pull-right" title="offline" style="z-index:331;position:relative;bottom: 26px;background: #AAB0AD;padding-left: 8px;"></i>
                                    <?php } ?>
                                </div>
                                <?php } } ?>
                            </div>
                        </li>
                    </ul>
                </div>
                
            </div>
            
        </div>
    </div>
</div>




<script>  
function getOnlineuser() {
    $.ajax({
        async:false,
        url: '<?=BASE_URL?>message1/get_online_user',
        success: function(res){
            //console.log(res);
            obj=$.parseJSON(res);
            //obj=res;
            if(obj.status)
            { 
                //alert('fddsf');
               getonlinedata=obj.data.online_users;
               getofflinedata=obj.data.offline_users;
               var htm='';
                $.each(eval(getonlinedata),function(i,item)
                {    
                        htm+='<div class="media users-with" id="'+item.id+'" onclick="javascript:chatWith(\''+item.id+'\',\''+item.username+'\')" >';
                        htm+='<a href="javascript:void(0);" class="pull-left"><img src="<?=BASE_URL?>assets/image/user/thumb/'+item.profile_Pic+'" style="height:30px; width: 30px;" class="media-object img-circle"></a>';
                        htm+='<div class="media-body">';
                        htm+='<h5>'+capitalizeFirstLetter(item.first_name)+' '+capitalizeFirstLetter(item.last_name)+'</h5>';
                        htm+='<small class="text-muted"><span class="badge" id="get-new-'+item.id+'"></span><span id="no-new-'+item.id+'">No</span> new message</small>';
                        htm+='</div>';
                        htm+='<i class="btn btn-default  btn-circle pull-right" title="online" style="z-index:331;position:relative;bottom: 26px;background: #00AF55;padding-left: 8px;"></i>';
                        htm+='</div>';
                        
                });
                
                $.each(eval(getofflinedata),function(i,item)
                {    
                        htm+='<div class="media users-with" id="'+item.id+'" onclick="javascript:chatWith(\''+item.id+'\',\''+item.username+'\')">';
                        htm+='<a href="javascript:void(0);" class="pull-left"><img src="<?=BASE_URL?>assets/image/user/thumb/'+item.profile_Pic+'" style="height:30px; width: 30px;" class="media-object img-circle"></a>';
                        htm+='<div class="media-body">';
                        htm+='<h5>'+capitalizeFirstLetter(item.first_name)+' '+capitalizeFirstLetter(item.last_name)+'</h5>';
                        htm+='<small class="text-muted"><span class="badge" id="get-new-'+item.id+'">'+item.noofmsg+'</span><span id="no-new-'+item.id+'"></span> new message</small>';
                        htm+='</div>';
                        htm+='<i class="btn btn-default  btn-circle pull-right" title="offline" style="z-index:331;position:relative;bottom: 26px;background: #AAB0AD;padding-left: 8px;"></i>';
                        htm+='</div>';
                        
                });
    
                //location.reload();
                //currentchatwith=$("#newactivetab").val();
                $("#conservation-user").html(htm);
                /*if(currentchatwith!=''){ 
                    setTimeout(randermsg, 5000);
                    $("#"+currentchatwith).css({"background":"#EDDFDF"});
                } */
            }else{
                $("#conservation-user").html("No conservation with any user.");
            }
        }
    });
    setTimeout(getOnlineuser, 1000*60);
}
getOnlineuser();    
    
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
</script>
