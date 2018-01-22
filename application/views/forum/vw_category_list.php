
<style>
    .slr_ads{min-height: 100px; margin-left: 137px;
    width: 79%;}
    .ads_cnt{word-wrap:break-word; font-size: 15px;}
    .ads_ttl {font-size: 20px;margin-top: 5px;text-transform: uppercase;font-weight: bold;}
    .viw_shp{float:right; margin-top: 5px; font-size: 16px;}
    .viw-shp-a{color: #000 !important; text-decoration: underline;}
    .ful_wdt{background-repeat: no-repeat !important; background-size: 100% !important;}
    .featured_ads{margin-bottom: 20px;}
</style>
<?php 
if($ads['res']){ 
   foreach($ads['rows'] as $adsdata){
       //echo "<pre>";
       //print_r($adsdata);exit;
       //$img=$adsdata->image; ?>
<div class="row featured_ads">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 slr_ads ful_wdt" style="background: url('<?=BASE_URL?>assets/image/ads_images/<?=$adsdata->image;?>');">
    <div class="col-lg-12 text-center">
        <span class="viw_shp"><a class="viw-shp-a" target="_blank" href="<?=BASE_URL?><?php echo $adsdata->username;?>/Shope/user_profile">View Shop</a></span>
                        <p class="ads_ttl">
                             <?=$adsdata->title;?>
                        </p>
                        <p class="ads_cnt">
                            <?=$adsdata->content;?>
                        </p>
    </div>
    </div>
</div>
        <?php }}//exit;
?>

<div class="row">
 <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
<div class="col-sm-12" style="min-height:450px;">
        
    
    <div class="contant-head1_forum gredient_forum">
        <div class="row col-sm-12 col-md-12 col-lg-12 col-xs-12 clearfix">
            <div class="row col-md-5">
                <p class="first"> Manage Forum </p> 
                <p class="second hidden-xs">  Category List </p>
            </div>
             <div class="row col-md-7 pull-right">    
        <span class="add-button hidden-xs">
        <div class="input-group">
         <input type="text" autocomplete="off" class="form-control searchbycategoryname" name="forum_topic_search" placeholder="Search Category" id="">
         <span class="input-group-addon searchicon"><!--<img src="<?PHP //echo BASE_URL?>assets/image/search-icon.png" class="img img-responsive">--></span>
        </div>
        </span>
             </div>         
                 
        
    </div>
    </div>
    
    
    <div class="row hidden-lg hidden-md hidden-sm">
        <div class="row col-xs-12 clearfix">
        
        <span class="row add-button">
        <div class="row input-group">
         <input type="text" autocomplete="off" class="form-control searchbycategoryname" name="forum_topic_search" placeholder="Search Category" id="">
         <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
        </div>
        </span>
        
    </div>
    </div>
    
    
   
    <div class="contant-body1">
    <div class="row">
    
        <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12 table-responsive">
       
         <table class="table table-bordered forum_cus_table">   
             <thead class="cusfor-panel-heading">
               <tr>
                  <th width="30%">Category</th>
                  <th width="10%">Post</th>
                  <th width="50%">Posted By</th>
<!--                  <th width="10%">&nbsp</th>-->
               </tr>
            </thead>
            <tbody id="searcheddata">
                <?php //print_R($forumlist); 
                      if($categorylist['res']){
                          foreach($categorylist['rows'] as $category){
                              //if($category->type_Of_User==3){
                                  $typeofuser="Admin";
                              //}else{
                                  //$typeofuser="";
                              //}
                      ?>
               <tr>
                  <td><a href="<?=BASE_URL?>forum/topic/<?=$category->Catid?>" class="forum_a"><?=$category->category?></a></td>
                  <td><?=$category->Nooftopic?></td>
                  <td>
                      <div class="row">
                          <!--<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12"> 
                          <!--<a href="<?=BASE_URL?>forum/user/<?=$category->UserId?>" class="forum_a"> <?=ucfirst($category->f_name)?> <?=$category->l_name?></a>
                          </div>-->
                            <div class="col-sm-4"><?=$typeofuser?></div>
                            <div class="col-sm-4"><?php echo date("d M Y", $category->timestamp); ?></div>
                            <div class="col-sm-4"><?php echo date("h:i a", $category->timestamp); ?></div>
                      </div>
                  </td>
<!--                  <td></td>-->
               </tr>
              <?php } } ?>
            </tbody>
         </table>
          
            <ul class="pagination pagination-sm no-margin pull-right"><?=$links?></ul>
        </div>

</div>   
    </div>        
    </div>
        
        
    </div>
</div> 

<!-- Modal -->
<div id="editforum" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Forum</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-update"></div></div>
          
          <form name="form" class="form-horizontal" role="form">
              <input type="hidden" id="forumid" value="">
            <div class="form-group">
               
              <div class="col-sm-12">          
                  <input type="text" class="form-control" id="topic" value="<?=set_value('topic')?>" name="topic" placeholder="Topic">
                  <?php if(form_error('topic')!='') echo form_error('topic','<div class="text-danger err">','</div>'); ?>
                  <span class="text-danger" id="topic1_error"></span>
              </div>
              <span class="text-danger" id="topic_error"></span>

            </div>    
                
            <div class="form-group">
              <div class="col-sm-12">          
                  <textarea class="form-control textarea" id="question" name="question" placeholder="Your Question"></textarea>
                  <?php if(form_error('question')!='') echo form_error('question','<div class="text-danger err">','</div>'); ?>
                  <span class="text-danger" id="question1_error"></span>
              </div>
              <span class="text-danger" id="question_error"></span>

            </div> 
                
                
        </form>
          
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="update" >Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="deletetopic" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Forum Topic</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete this topic?</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [],
    toolbar: "undo redo  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
});
</script>

<script>
    $(document).ready(function(){
        $(".like").click(function(){
            var id=$(this).attr("id");
            $.get("<?=BASE_URL?>forum/like/"+id,function(data,status){
                if(data){
                    console.log(data);
                    location.reload(); 
                }
            });
        });
        
        $(".edit").click(function(){
            var id=$(this).attr("id");
            $.post("<?=BASE_URL?>forum/edit",{forumid:id},function(data,status){
                console.log(data);
                var obj=$.parseJSON(data);
                if(obj.res){
                    $("#forumid").val(obj.rows.id);
                    $("#topic").val(obj.rows.topic);
                    tinyMCE.activeEditor.setContent(obj.rows.question);
                }
            });
        });
        
        $("#update").click(function(){
            var forumid=$("#forumid").val();
            var topic=$("#topic").val();
            var question=tinyMCE.activeEditor.getContent();
            var checkvalidation=true;
            
            if(topic==''){
                $("#topic").focus();
                $("#topic1_error").text("The Topic field is required.");
                $("#topic_error").parent().addClass("has-error");
                checkvalidation=false;
                return false;  
            }
            
            if(question==''){  
                $("#question").focus();
                $("#question1_error").text("The Question field is required.");
                $("#question_error").parent().addClass("has-error");
                checkvalidation=false;
                return false; 
            }
            
            if(checkvalidation){
            
            $.post("<?=BASE_URL?>forum/update",{id:forumid,topic:topic,question:question},function(data,status){
                console.log(data);
                var obj=$.parseJSON(data);
                    if(obj.status){
                       $("#e-result-update").empty().append(obj.message).addClass("alert alert-success fade in");
                                setTimeout(function(){
                                    window.location.reload();
                                }, 1000); 
                    }else
                        {
                            $("#e-result-update").empty().append(obj.message).addClass("alert alert-error fade in");
                        }
            });
            
            }
            
        });
        
        
        $(".delete").click(function(){
            var id=$(this).prop('id');
            $("#deleteId").val(id);
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>forum/delete",{id:deleteId},function(data,status){
                obj=$.parseJSON(data);
                if(obj.status){
                   $("#e-result-delete").empty().append(obj.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000); 
                }else
                    {
                        $("#e-result-delete").empty().append(obj.message).addClass("alert alert-error fade in");
                    }
            });
        });
    });
    
    
    
    /**********Search by caregory Name**********/
    
    $(document).ready(function(){
        $(".searchbycategoryname").keyup(function(){
            var category=$(this).val().trim();
            if(category!=''){
            $.post("<?=BASE_URL?>forum/searchbycategory/",{category:category},function(data,status){
                //console.log(data);
                var obj=$.parseJSON(data);
                if(obj.res){
                    var htm='';
                    //console.log(obj.rows);
                    $.each(obj.rows,function(i,val){
                        //console.log(val.UserId);
                        //if(val.type_Of_User==3){
                            var typeofuser='Admin';
                       /* }else{
                            var typeofuser='';
                        }*/
                        htm+='<tr>';
                        htm+='<td><a href="<?=BASE_URL?>forum/topic/'+parseInt(val.Catid)+'" class="forum_a">'+val.category+'</a></td>';
                        htm+='<td>'+parseInt(val.Nooftopic)+'</td>';
                        htm+='<td> ';
                        htm+='<div class="row">';
                        /*htm+='<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12"> ';
                        htm+='<a href="<?=BASE_URL?>forum/user/'+val.UserId+'" class="forum_a"> '+ucfirst(val.f_name)+'  '+val.l_name+'</a>';
                        htm+='</div>';*/
                        htm+='<div class="col-sm-4">'+typeofuser+'</div>';
                        htm+='<div class="col-sm-4">'+val.date+'</div>';
                        htm+='<div class="col-sm-4">'+val.time+'</div>';
                        htm+='</div>';
                        htm+='</td>';
                        //htm+='<td></td>';
                        htm+='</tr>';
                    });
                    //alert(htm);
                   
                    //$(htm).insertAfter(".cusfor-panel-heading");
                    
                }else{
                    htm+='<tr>';
                    htm+='<td colspan="4" >No Record Found.</td>';
                    htm+='</tr>';
                }
                
                 $("#searcheddata").html(htm);
            });
            }else{
                //window.location.reload();
            }
        });
    });
    
    
    function ucfirst(str) {
        str += '';
        var f = str.charAt(0)
          .toUpperCase();
        return f + str.substr(1);
    }

</script>


