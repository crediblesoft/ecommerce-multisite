<?php 
$post_pageid="";
$user_id="";
if(isset($_POST['pageid'])&&isset($_POST['user_id'])&&$_POST['pageid']!=""&&$_POST['user_id']!="")
{//this side use for editing panel only
include '../db_include.php';
$post_pageid=$_POST['pageid'];
$user_id=$_POST['user_id'];
//echo $_POST['pageid']."<br/>";
//echo $_POST['user_id']."<br/>";

        $element_query="SELECT `id`, `user_id`, `page_no`, `theme_id`, `element_data` FROM `db_element` WHERE `user_id`='".$user_id."' AND `page_no`='".$post_pageid."' ";
       $row_query_element = mysql_query($element_query)or die(mysql_error()); 
       
        if(mysql_num_rows($row_query_element))
            {
        $res_query_element=  mysql_fetch_assoc($row_query_element);         
        echo $res_query_element['element_data']; 
        //echo "you are hare in first ANd This Use Oly Edit PEnel SHow "; 
        //echo "And Daynamic Add PAges Alsho";
        } 
        
        ?><script>
   /* $(document).ready(function(){
        $('.showeliment').find('div').each(function(){           
            var styl =$(this).attr('style');
            styl=styl.replace('top: '+$(this).css('top'),'top: '+(parseInt($(this).css('top'))-parseInt(75))+'px');
          $(this).attr('style',styl);
        });
       //alert(parseInt($('.showeliment > div').css('top'))); 
    });*/
</script><?php

}
else if(isset($_REQUEST['pageid'])&&($_REQUEST['pageid']!==""))
{
      //echo "you are hare in secend";     
 $user_id=$this->session->userdata('user_pageid')[0];
 $post_pageid= $this->session->userdata('user_pageid')[1];   
   ?><div class="showeliment"><?php
   echo  $memueliment=$this->modelsite->get_menueeliment($user_id,$post_pageid); 
   ?></div><script>
    $(document).ready(function(){
        $('.showeliment').find('div').each(function(){           
            var styl =$(this).attr('style');
            styl=styl.replace('top: '+$(this).css('top'),'top: '+(parseInt($(this).css('top'))-parseInt(150))+'px');
          $(this).attr('style',styl);
        });
       //alert(parseInt($('.showeliment > div').css('top'))); 
    });
</script><?php 
//echo "sorry page id is  not selected <br/>";
//echo "sorry user id id is  not selected <br/>";      
}else{
 // echo "this side use for uset Web SIte After Edinting  only";     
$user_id=$this->session->userdata('user_pageid')[0];
$post_pageid= $this->session->userdata('user_pageid')[1];   
   ?><div class="showeliment"><?php
  echo  $memueliment=$this->modelsite->get_menueeliment($user_id,$post_pageid); 
   ?></div>
<script>
    $(document).ready(function(){
        $('.showeliment').find('div').each(function(){           
            var styl =$(this).attr('style');
            styl=styl.replace('top: '+$(this).css('top'),'top: '+(parseInt($(this).css('top'))-parseInt(79))+'px');
          $(this).attr('style',styl);
        });
       //alert(parseInt($('.showeliment > div').css('top'))); 
    });
</script>
    <?php }






