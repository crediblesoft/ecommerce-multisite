<div class="container">
    <div class="row profile">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">CONVERSATION WITH USERS</div>
                <div class="panel-footer">
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
                </div>
                <div class="panel-body">
                    <ul class="media-list">
                        <li class="media">
                            <div class="media-body" id="conservation-user">
                                <?php
                                if(count($users) > 0){
                                foreach($users as $userdata){
                                ?>
                                <div class="media users-with" id="<?=$userdata->id?>">
                                    <a href="javascript:void(0);" class="pull-left"><img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userdata->profile_Pic?>" style="height:30px; width: 30px;" class="media-object img-circle"></a>
                                    <div class="media-body">
                                        <h5><?=ucfirst($userdata->first_name).' '.ucfirst($userdata->last_name)?></h5>
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
                                        <h5><?=ucfirst($userdata1->first_name).' '.ucfirst($userdata1->last_name)?></h5>
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
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> MESSAGE'S <span id="currentchatusername"><?php if($currentusername!=''){ echo "to <strong>".$currentusername."</strong>"; } ?></span>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li><a href="javascript:void(0);" id="refresh"><span class="glyphicon glyphicon-refresh"></span>Refresh</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body1" id="scroll-to-last">
                    <div id="loader-container">
                        <br /><br /><br /><br /><br /><br /><br /><br /><br />
                        <p class="text-center"><span class="fa fa-spin fa-spinner fa-5x"></span><br />Loading...</p>
                    </div>
                    <ul class="chat" id="msg-container">
                        
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="row"><p class="col-md-12 text-danger" id="error_1"></p></div>
                    <div class="row">
                        <div class="col-md-12" style="height:90px;">
                            <div class="col-md-10" style="height:90px;">
                                <div class="form-group">
                                    <textarea id="msg-btn-input" style="height:90px;" type="text" class="form-control input-lg text-msg-input" placeholder="Type your message here..."></textarea>
                                </div>
                            </div>
                            <!--<div class="col-md-5">
                                <div class="row">
                                    <div class="form-group">
                                        <select class="form-control" id="products">
                                            <option value="">Mention Your Product</option>
                                            <?php
                                            /*foreach($userproducts as $product){ ?>
                                            <option value="<?=$product->id?>"><?=$product->product_name?></option>
                                            <?php }*/ ?>
                                        </select>
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-md-2" style="height:90px;padding-top:40px;">
                                <button class="btn btn-warning btn-lg" id="btn-chat-send"><i class="fa fa-send"></i> Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form class="hidden">
    <input type="hidden" name="activetab" id="newactivetab" value="<?php echo $this->session->userdata("chatwith");?>" />
    <?php if($activetab!=''){ ?>
    <input type="hidden" name="activetab" id="activetab" value="<?=$activetab?>" />
    <?php }else{ ?>
    <input type="hidden" name="activetab" id="activetab" value="" />
    <?php } ?>
    <input type="hidden" name="crntuser" id="crntuser" value="<?=$this->session->userdata('user_id')?>" />
</form>
<style>
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
<script>
    var currentchatwith=$("#newactivetab").val();
    
    $(document).ready(function(){
             if(currentchatwith!=''){ 
             $("#"+currentchatwith).css({"background":"#EDDFDF"});
             setTimeout(randermsg, 5000);
//             var animate1 = parseInt($('#msg-container li:last-child').offset().top)-parseInt($("#scroll-to-last").offset().top);
//             $('#scroll-to-last').animate({scrollTop: animate1}, 1000);
             //$('#loader-container').hide();
            $("#msg-btn-input").attr("disabled",false);
            $("#btn-chat-send").attr("disabled",false);
            }else{
            $("#msg-btn-input").attr("disabled",true);
            $("#btn-chat-send").attr("disabled",true);
            $('#loader-container').hide();
            var resp = '<div class="text-center" style="font-size:20px;margin-top:50px;">Please select any user to see message or chat</div>';
            $('#msg-container').empty();
            $('#msg-container').html(resp);
            }
    });
    
    
        
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getOnlineuser() {
    $.ajax({
        async:false,
        url: '<?=BASE_URL?>message/get_online_user',
        success: function(res){
            //console.log(res);
            obj=$.parseJSON(res);
            //obj=res;
            if(obj.status)
            { 
               getonlinedata=obj.data.online_users;
               getofflinedata=obj.data.offline_users;
               var htm='';
                $.each(eval(getonlinedata),function(i,item)
                {    
                        htm+='<div class="media users-with" id="'+item.id+'">';
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
                        htm+='<div class="media users-with" id="'+item.id+'">';
                        htm+='<a href="javascript:void(0);" class="pull-left"><img src="<?=BASE_URL?>assets/image/user/thumb/'+item.profile_Pic+'" style="height:30px; width: 30px;" class="media-object img-circle"></a>';
                        htm+='<div class="media-body">';
                        htm+='<h5>'+capitalizeFirstLetter(item.first_name)+' '+capitalizeFirstLetter(item.last_name)+'</h5>';
                        htm+='<small class="text-muted"><span class="badge" id="get-new-'+item.id+'">'+item.noofmsg+'</span><span id="no-new-'+item.id+'"></span> new message</small>';
                        htm+='</div>';
                        htm+='<i class="btn btn-default  btn-circle pull-right" title="offline" style="z-index:331;position:relative;bottom: 26px;background: #AAB0AD;padding-left: 8px;"></i>';
                        htm+='</div>';
                        
                });
                //location.reload();
                currentchatwith=$("#newactivetab").val();
                $("#conservation-user").html(htm);
                if(currentchatwith!=''){ 
                    setTimeout(randermsg, 5000);
                    $("#"+currentchatwith).css({"background":"#EDDFDF"});
                } 
            }else{
                $("#conservation-user").html("No conservation with any user.");
            }
        }
    });
    //setTimeout(getOnlineuser, 5000);
}

function getCount() {
    $.ajax({
        async:false,
        url: '<?=BASE_URL?>message/get_usermsg_count',
        success: function(res){
            obj=$.parseJSON(res);
            //console.log(obj);
            if(obj.status)
            {
                getdata=obj.data;
                $.each(eval(getdata),function(i,item)
                {
                    if(item != 0)
                    {
                        $('#no-new-'+i).text('');
                        $('#get-new-'+i).text(item);
                    }
                    else
                    {
                        $('#no-new-'+i).text('No');
                        $('#get-new-'+i).text('');
                    }
                });
            }
        }
    });
    setTimeout(getCount, 5000);
    
}
function randermsg()
{
    //var id=$('#activetab').val();
    //console.log(id);
    var crid=$('#crntuser').val().trim();
    var resp='';
    var product='';
    $.ajax({
            async:false,
            type:'POST',
            url: '<?=BASE_URL?>message/get_message',
            success: function(res){
                obj=$.parseJSON(res);
                if(obj.status)
                {
                    var offline='0';
                    getmessage=obj.message;
                    $.each(eval(getmessage),function(j,data)
                    {
                        //product='';
                        if(data.msgfrom != crid)
                        { 
                           //alert(data.first_name);
                            if(!parseInt(data.is_login)){
                                offline='1';
                            }
                            resp+='<li class="left clearfix"><span class="chat-img pull-left"><img src="<?=BASE_URL?>assets/image/user/thumb/'+data.profile_Pic+'" alt="User" height="30" width="30" class="img-circle"></span>';
                            resp+='<div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+capitalizeFirstLetter(data.first_name)+' '+capitalizeFirstLetter(data.last_name)+'</strong> <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>'+data.senddate+'</small></div>';
                            resp+='<p>'+data.message+'</p></div></li>';
                        }
                        else
                        {  
                            resp+='<li class="right clearfix"><span class="chat-img pull-right"><img src="<?=BASE_URL?>assets/image/user/thumb/'+data.profile_Pic+'" alt="User" height="30" width="30" class="img-circle"></span>';
                            resp+='<div class="chat-body clearfix"><div class="header"><small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'+data.senddate+'</small><strong class="pull-right primary-font">Me</strong></div>';
                            resp+='<p>'+data.message+'</p></div></li>';
                        }
                    });
                }
                else
                {
                    $('#loader-container').hide();
                    resp = 'No Message available';
                    
                }
                $('#loader-container').hide();
                if(parseInt(offline)){
                    resp+='<p>User is offline</p>';
                }
                $('#msg-container').empty();
                $('#msg-container').append(resp);
//                    $('#scroll-to-last').animate({
//                        scrollTop: $('#msg-container li:last-child').offset().top
//                    }, 2000);
                $('#msg-container').animate({scrollTop: $('#msg-container').prop("scrollHeight")},1000);
                
            }
        });
    setTimeout(randermsg, 5000);
}

$(document).ready(function(){
    $(document).on('click','.users-with',function(){ 
        $("#currentchatusername").html("");
        $(".users-with").css({"background":"none"});
        $(this).css({"background":"#EDDFDF"});
        var id=$(this).prop('id');
        var crid=$('#crntuser').val().trim();
        var resp='';
        var product='';
        //alert(id);alert(crid);
        $('#newactivetab').val(id);
        //$('#msg-container').empty();
       //$("#loader-container").show("slow").delay(3000).hide("slow");
        $("#msg-btn-input").attr("disabled",false);
        $("#btn-chat-send").attr("disabled",false);
        $.ajax({
            async:false,
            type:'POST',
            url: '<?=BASE_URL?>message/get_currentclicked_message',
            data: {user: id},
            success: function(res){
                obj=$.parseJSON(res);
                if(obj.status)
                {    
                    var offline='0';
                    getmessage=obj.message;
                    $.each(eval(getmessage),function(j,data)
                    {
                        //product='';
                        if(data.msgfrom != crid)
                        {
                            //alert(data.last_name);
                            
                            if(!parseInt(data.is_login)){
                                offline='1';
                            }
                            resp+='<li class="left clearfix"><span class="chat-img pull-left"><img src="assets/image/user/thumb/'+data.profile_Pic+'" alt="User" height="30" width="30" class="img-circle"></span>';
                            resp+='<div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+capitalizeFirstLetter(data.first_name)+' '+capitalizeFirstLetter(data.last_name)+'</strong> <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>'+data.senddate+'</small></div>';
                            resp+='<p>'+data.message+'</p></div></li>';
                        }
                        else
                        {
                            
                            resp+='<li class="right clearfix"><span class="chat-img pull-right"><img src="assets/image/user/thumb/'+data.profile_Pic+'" alt="User" height="30" width="30" class="img-circle"></span>';
                            resp+='<div class="chat-body clearfix"><div class="header"><small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'+data.senddate+'</small><strong class="pull-right primary-font">Me</strong></div>';
                            resp+='<p>'+data.message+'</p></div></li>';
                        }
                    });
                }
                else
                { 
                    $('#loader-container').hide();
                    resp = 'No Message available';
                    return false;
                }
                if(parseInt(offline)){
                    resp+='<p>User is offline</p>';
                }
                //location.reload();
                $('#loader-container').hide();
                $('#msg-container').empty();
                $('#msg-container').append(resp);
                $('#msg-container').animate({scrollTop: $('#msg-container').prop("scrollHeight")},1000);
            }
        });
    });
    
    
    $('#refresh').click(function(){
        $('#loader-container').show();
        //var getuser=$('#activetab').val();
        var getuser=currentchatwith;
        //alert(getuser);
        $("#conservation-user div#"+getuser).click();
    });
    
    $('#btn-chat-send').click(function(){
        //alert("helllo");
        var msg=$('#msg-btn-input').val().trim();
        //var prid=$('#products').val().trim();
        //var getuser=$('#activetab').val();
        //console.log(msg+'/'+prid);
        if(msg == "")
        {
           $('#msg-btn-input').focus();
           return false;
        }
        $.ajax({
            async:false,
            type:'POST',
            url: '<?=BASE_URL?>message/send',
            data: {message:msg},
            success: function(res){
                obj=$.parseJSON(res);
                if(obj.status)
                { 
                    $('#refresh').click();
                    $('#msg-btn-input').val('');
                    //$("#products").children().removeAttr("selected");
                }
                else
                {
                    $("#error_1").html(obj.message);
                }
            }
        });
    });
    //var currentuser=$('#activetab').val();
    var currentuser=currentchatwith;
    setTimeout(getCount, 5000);
    //setTimeout(getOnlineuser, 10000);
    setTimeout(function(){
            //$("#conservation-user div#"+currentuser).click();
            scrollit(currentuser);
    }, 5000);
        
});


    function scrollit(innerdiv){ 
        //alert(parseInt($('#'+innerdiv).offset().top)-parseInt($(".panel-body").offset().top));
        var animate = parseInt($('#'+innerdiv).offset().top)-parseInt($(".panel-body").offset().top);
        $('.panel-body').animate({scrollTop: animate}, 1000);  
    }
    
    
    function searchbyusername(value){
        if(value!=''){
        $.post("<?php echo BASE_URL;?>message/searchbyusername",{search:value},function(data,status){
            var htmldata="";
                var obj=jQuery.parseJSON(data);
                 //htmldata+='<div class="row">';
                 htmldata+='<ul class="col-sm-12 col-md-12 col-lg-12 col-xs-12 search_list_head">';
                 htmldata+='<li class="row">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=BASE_URL?>assets/image/usericon.png"> &nbsp; Sellers</li>';
                if(obj.status){
                    jQuery.each(obj.data,function(i,val){
                    htmldata+='<li><span class="cus_bolt_icon">&nbsp;</span><a href="<?=BASE_URL?>message/'+val.id+'">'+val.f_name+' '+val.l_name+'</a></li>';
                    });
                }else{
                    htmldata+='<li style="color:#f00;">No Seller found </li>';
                    }
                 htmldata+='</ul>'; 
                 $(".autosearchresult_msg").slideDown();
                 $(".autosearchresult_msg").html(htmldata);
        });}else{
                //$(".autosearchresult").css("display","none");
                $(".autosearchresult_msg").slideUp();
            }
    }
</script>
