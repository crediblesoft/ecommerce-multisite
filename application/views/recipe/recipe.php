    <style>
    .slr_ads{min-height: 100px;width: 70%;}
    .ads_cnt{word-wrap:break-word; font-size: 15px;}
    .ads_ttl {font-size: 20px;margin-top: 5px;text-transform: uppercase;font-weight: bold;}
    .viw_shp{float:right; margin-top: 5px; font-size: 16px;}
    .viw-shp-a{color: #000 !important; text-decoration: underline;}
    .ful_wdt{background-repeat: no-repeat !important; background-size: 100% !important;}
    .margin_top_bottom{ margin-bottom: 25px; margin-top: 15px; }
</style>
<?php 
if($ads['res']){ 
   foreach($ads['rows'] as $adsdata){
       //echo "<pre>";
       //print_r($adsdata);exit;
       //$img=$adsdata->image; ?>
<div class="row" style="display: inline-flex; width: 100%; margin: 0px;">
    <div class=" slr_ads ful_wdt" style=" margin:auto; width: 80.5%; background: url('<?=BASE_URL?>assets/image/ads_images/<?=$adsdata->image;?>');">
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

<div class="row" style="display: inline-flex;">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 " style="margin: auto;">
        
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
            
            <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 padding_left_none">
                <p class="prod_vw_filters_head" style="padding-top: 9px;">Filter By </p>
            </div>
            <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12 ">
                <p class="product_vw_head text-center ">Recipes</p>
            </div>    
        </div>
        
            
        
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            
        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 margin-bottom_25 padding_left_none">
            
            <div class="product_vw_left">
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Category</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <!--<input type="text" class="form-control" name="category" id="category" placeholder="Enter Category">-->
                            <select name="category" id="category" class="form-control">
                                <option value="">---Select Category---</option>
                                <?php if($allcategory['res']){ foreach($allcategory['rows'] as $category){ ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Username</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input type="text" autocomplete="off" class="form-control" name="username" id="username" placeholder="Enter Username">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Title</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input type="text" autocomplete="off" class="form-control" name="title" id="title" placeholder="Enter Title">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>    
        
        <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12 product_vw_main">
      
            
            <div class="row" id="computers">
                <?php if($recipe['res']){ 
                    foreach($recipe['rows'] as $userlist){
                        $recipe_details=  strip_tags($userlist->recipe_detail);
                    ?>
                 <div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system margin-bottom_35">
                     <div class="product_vw_inner_content"> 
                         
                    <div class="thumbnail product_cus_thumb">
                        <a href="<?=BASE_URL?>recipe/viewRecipe/<?=$userlist->recipeid?>"><div class='product_cus_thumb_inner img img-responsive center-block'>   
							
						<?php
						if(substr_count($userlist->image_path,'http') > 0 ) $reciepe_image=$userlist->image_path; 
						else $reciepe_image=BASE_URL.'assets/image/recipe/thumb/'.$userlist->image_path;
						?>
						
                          <img src="<?php echo $reciepe_image; ?>" alt="" class="img img-responsive center-block">      
                                
                        </div></a>
                    </div>
                         <div class="caption product_text_caption">
                       <!--<h3>Thumbnail label</h3>-->
                       <div class="row margin-bottom_20">
                       <div class="col-sm-12 col-xs-12">
                            
                           <div class="row margin-bottom_10">
                               <div class="col-sm-4 col-xs-4 product_vw_price" title="type">Title</div>
                               <div class="col-sm-7 col-xs-7 add_to_compare"><?php echo substr($userlist->recipe_title,0,12); if(strlen($userlist->recipe_title)>12){echo "...";}?></div>
                           </div>
                           <div class="row ">
                               <div class="col-sm-4 col-xs-4 product_vw_price" title="type">Category</div>
                               <div class="col-sm-7 col-xs-7 add_to_compare"><?php echo substr($userlist->category,0,12); if(strlen($userlist->category)>12){echo "...";}?></div>
                           </div>
                       </div>
                       </div>
                       <p class="product_vw_content margin-bottom_40"><?php echo substr($recipe_details,0,100); if(strlen($recipe_details)>100){echo "...";} ?></p>
                        
                       <div class="row">
                           
                       <div class="col-sm-6 col-xs-6 p">
                             <a href="<?=BASE_URL?>recipe/viewRecipe/<?=$userlist->recipeid?>" class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/view_details.png" class="img img-responsive" height="33" width="124"></a> 
                             <!--<a href="<?=BASE_URL?>recipe/viewRecipe/<?=$userlist->recipeid?>" class="product_vw_vw_details" role="button">View Details</a>-->
                       </div>
                       </div>    
                    </div>
                 
                     </div>
                 </div>    
                <?php } }else{ ?>
                <div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system"><h3>Record Not Found</h3></div>
                <?php } ?>
              </div>          
    </div>
            <ul class="row pagination pagination-sm no-margin pull-right">
                   <?php echo $links; ?>
            </ul>
            <input type="hidden" value="" id="currentpage">
</div>
        
    </div>
</div>  


<script>
    var category;
    var username;
    var title;
    var currentpage=$("#currentpage").val();
    
    $(document).on("click",".pagination li a",function(){
        currentpage=$(this).attr("title");
        $("#currentpage").val(currentpage);
        filterdata();
    });

    $(document).on("change","#category",function(){
        category = $(this).val();
            filterdata();
    });

    $(document).on("keyup","#username",function(){
        username = $(this).val();  
            filterdata();
    });

    $(document).on("keyup","#title",function(){
        title = $(this).val();
            filterdata();
    });

    function filterdata(){
        $.post("<?=BASE_URL?>recipe/filter",
        {currentpage:currentpage,category:category,username:username,title:title},
        function(data,status){
            //console.log(data);
            var obj=$.parseJSON(data);
            var htm='';
           if(obj.recipe.res){
                //console.log(obj.rows);
                $.each(obj.recipe.rows,function(i,val){
                    //console.log(val.bid_status);
                    var recipe_detail=$(val.recipe_detail).text();
                    if(recipe_detail.length > 100){ var dot1='...'; }else{ var dot1=''; }
                    if(val.category.length > 100){ var dot2='...'; }else{ var dot2=''; }
                    if(val.recipe_title.length > 100){ var dot3='...'; }else{ var dot3=''; }
                    
				if (val.image_path.indexOf('http') > -1) var reciepe_image=val.image_path;
				else var reciepe_image= "<?=BASE_URL?>assets/image/recipe/thumb/"+val.image_path;
                   //console.log(reciepe_image);                   
                    
                    
                    htm+='<div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system margin-bottom_35">';
                    htm+='<div class="product_vw_inner_content">';    
                    htm+='<div class="thumbnail product_cus_thumb">';
                    htm+='<a href="<?=BASE_URL?>recipe/viewRecipe/'+val.recipeid+'"><div class="product_cus_thumb_inner img img-responsive center-block">';    
                    htm+='<img src="'+reciepe_image+'" alt="" class="img img-responsive center-block">';
                    htm+='</div></a>';
                    htm+='</div>';
                    htm+='<div class="caption product_text_caption">';
                    htm+='<div class="row margin-bottom_20">';
                    htm+='<div class="col-sm-12 col-xs-12">'; 
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-4 col-xs-4 product_vw_price" title="type">Title</div>';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">'+val.recipe_title.substr(0,12)+''+dot3+'</div>';
                    htm+='</div>'; 
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-4 col-xs-4 product_vw_price" title="type">Category</div>';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">'+val.category.substr(0,12)+''+dot2+'</div>';
                    htm+='</div>';
                    htm+='</div>';
                    htm+='</div>';
                    htm+='<p class="product_vw_content margin-bottom_25" style="margin-bottom:33px;">'+recipe_detail.substr(0,100)+''+dot1+'</p>';
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-6 col-xs-6 p">';
                    htm+='<a href="<?=BASE_URL?>recipe/viewRecipe/'+val.recipeid+'" class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/view_details.png" class="img img-responsive" height="33" width="124"></a>'; 
                    htm+='</div>';
                    htm+='</div>';    
                    htm+='</div>';
                    htm+='</div>';
                    htm+='</div>';
                });
            }else{
                htm+='<div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system">';
                htm+='<h3>Result Not found</h3>';
                htm+='</div>';
            }  
            
            $(".pagination").html(obj.links);
            $(".pagination li").removeClass("active");
            //alert($(".pagination .active a").attr("href"));
            var f=1;
            $.each($(".pagination li a"),function(i,j){
                var test=$(j).attr("href").split("/");
                var sizeofarray=test.length;
                var noofpage=test[sizeofarray-1];
                //console.log(noofpage);
                $(j).attr("title",noofpage);
                $(j).attr("href","javascript:void(0)");
                //console.log(parseInt(currentpage));
                //console.log(noofpage);
                if(noofpage==parseInt(currentpage)){
                    if(f==1){
                        $(".pagination li").first().removeClass("active");
                        $(j).parent().addClass("active");
                        f=0; }
                }else{
                    if(f==1){ $(".pagination li").first().addClass("active"); }
                }
            });
            
            $("#computers").html(htm);
        });
    }
</script>
