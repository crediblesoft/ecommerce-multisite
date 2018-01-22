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
            
            <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12 ">
                <p class="product_vw_head text-center "><div class="col-sm-5 col-md-5 lineimg"><img src="<?php echo BASE_URL; ?>assets/image/line.png" class="img img-responsive"></div><div class="col-sm-2 col-md-2 text-center product_vw_head"><?=$featureduser['rows'][0]->business_type?></div><div class="col-sm-5 col-md-5 lineimg"><img src="<?php echo BASE_URL; ?>assets/image/line.png" class="img img-responsive"></div></p>
            </div>    
        </div>
        
        <div class="">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 product_vw_search margin-bottom_40">
            <form role="form" method="get" action="<?=BASE_URL?>products/searchbydistance/<?=$categoryid?>/">

                <div class="col-md-11 col-lg-11 col-sm-11 col-xs-12">


                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                      <label for="pwd">City</label>
                      <input id="autocomplete" class="form-control" name="city" placeholder="Enter your address" value="<?=$this->input->get('city')?>" onFocus="geolocate()" type="text" />
                      <span id="city_error" ></span>

                    </div>
                    <p class="text-danger zip_search_error"><?php if($this->session->flashdata("get_vali_error")=='true'){echo "Zipcode/city and distance field are required";}?></p>
                    </div>

                   <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                   <div class="form-group">
                     <label for="email">Zip Code</label>
                     <input type="text" value="<?=$this->input->get('zip')?>" class="form-control" id="postal_code" name="zip" placeholder="Zip Code">
                     <span id="zip_error"></span>
                   </div>
                       <span id="zip_error_nume" class="text-danger"></span>
                   </div>

<!--                   <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                   <div class="form-group">
                     <label for="pwd">City</label>
                     <input type="text" class="form-control" value="<?=$this->input->get('city')?>" id="locality" name="city" placeholder="City">
                     <span id="city_error" ></span>

                   </div>
                    </div>-->

                    <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                   <div class="form-group">
                     <label for="pwd">Distance (in miles)</label>
                     <input type="text" class="form-control" value="<?=$this->input->get('distance')?>" id="distance" name="distance" placeholder="Distance (Miles)" onkeyup="checknumber(this.id,this.value)" >
                     <span id="distance_error"></span>
                   </div>
                        <span id="distance_error_nume" class="text-danger"></span>
                    </div>



<!--                    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                   <div class="form-group">
                     <label for="pwd">State</label>
                     <input type="text" class="form-control" value="<?=$this->input->get('state')?>" id="state" name="state" placeholder="State">
                     <span id="state_error" ></span>

                   </div>
                    </div>-->
                </div>
                    <div class="col-md-1 col-lg-1 col-sm-12 col-xs-12">
                        <br/>
                        <button type="submit" class="btn btn-success pull-right" id="searchbydist">SEARCH</button>
                    </div>
                </form>
            </div>
            </div>
            
            <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 padding_left_none">
                <p class="prod_vw_filters_head" style="padding-top: 9px;">Filter By </p>
            </div>
        
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            
        <div class="col-sm-3 col-lg-3 col-md-3 col-xs-12 margin-bottom_25 padding_left_none">
            
            <div class="product_vw_left">
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Business Types</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <!--<input type="text" class="form-control" name="bus_name_type" id="bus_name_type" placeholder="Enter Business Type">-->
                            <select name="bus_name_type" id="bus_name_type" class="form-control">
                                <option value="">---Select Business Type---</option>
                                <?php if($allbusinesstypes['res']){ foreach($allbusinesstypes['rows'] as $bus_types){ ?>
                                <option value="<?php echo BASE_URL."businesstypes/".$bus_types->id; ?>"><?php echo $bus_types->business_type_name; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                
                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 line">&nbsp;</div>
                
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Business Name</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input type="text" autocomplete="off" class="form-control" name="bus_name" id="bus_name" placeholder="Enter Business Name">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
                    <h4 class="pro_vw_inner_head">Username</h4>
                    <div class="row margin-bottom_10">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                            <input type="text" autocomplete="off" class="form-control" name="username" id="username" placeholder="Enter Username">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>    
        
        <div class="col-sm-9 col-lg-9 col-md-9 col-xs-12 product_vw_main">
      
            <div class="row" id="computers">
                <?php if($featureduser['res']){ 
                    foreach($featureduser['rows'] as $userlist){
                        //$recipe_details=  strip_tags($userlist->recipe_detail);
                    ?>
                 <div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system margin-bottom_35">
                     <div class="product_vw_inner_content"> 
                         
                    <div class="thumbnail product_cus_thumb">
                        <a href="<?=BASE_URL?>sellerprofile/<?=$userlist->username?>"><div class='product_cus_thumb_inner img img-responsive center-block'>   
							
	<?php
 	    $profile_image=BASE_URL.'assets/image/user/thumb/'.$userlist->profile_Pic;
	?>
						
                          <img src="<?php echo $profile_image; ?>" alt="" class="img img-responsive center-block">      
                                
                        </div></a>
                    </div>
                         <div class="caption product_text_caption">
                       <!--<h3>Thumbnail label</h3>-->
                       <div class="row margin-bottom_20">
                       <div class="col-sm-12 col-xs-12">
                            
                           <div class="row margin-bottom_10">
                               <div class="col-sm-4 col-xs-4 product_vw_price" title="type">Business</div>
                               <div class="col-sm-7 col-xs-7 add_to_compare"><?php echo substr($userlist->business_name,0,12); if(strlen($userlist->business_name)>12){echo "...";}?></div>
                           </div>
                           <div class="row ">
                               <div class="col-sm-4 col-xs-4 product_vw_price" title="type">User</div>
                               <div class="col-sm-7 col-xs-7 add_to_compare"><?php echo substr($userlist->username,0,12); if(strlen($userlist->username)>12){echo "...";}?></div>
                           </div>
                           <div class="row ">
                               <div class="col-sm-4 col-xs-4 product_vw_price" title="type">Address</div>
                               <div class="col-sm-7 col-xs-7 add_to_compare"><?php echo substr($userlist->address,0,10); if(strlen($userlist->address)>10){echo "...";}?></div>
                           </div>
                           <div class="row ">
                               <div class="col-sm-4 col-xs-4 product_vw_price" title="type">State</div>
                               <div class="col-sm-7 col-xs-7 add_to_compare"><?php echo substr($userlist->state,0,10); if(strlen($userlist->state)>10){echo "...";}?></div>
                           </div>
                           <div class="row ">
                               <div class="col-sm-4 col-xs-4 product_vw_price" title="type">Zip</div>
                               <div class="col-sm-7 col-xs-7 add_to_compare"><?php echo substr($userlist->zip,0,10); if(strlen($userlist->zip)>10){echo "...";}?></div>
                           </div>
                       </div>
                       </div>
                   <!--    <p class="product_vw_content margin-bottom_40"><?php echo substr($userlist->business_type,0,100); if(strlen($userlist->business_type)>100){echo "...";} ?></p> -->
                        
                       <div class="row">
                           
                       <div class="col-sm-6 col-xs-6 p">
                             <a href="<?=BASE_URL?>sellerprofile/<?=$userlist->username?>" role="button"> <img src="<?=BASE_URL?>assets/image/view_details.png" class="img img-responsive" height="33" width="124"></a> 
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
           <input type="hidden"  id="businessid" value="<?=$businessid?>"> 
</div>
        
    </div>
</div>  


<script>
    var category;
    var username;
    var bus_name;
    var businessid=$("#businessid").val();
    var currentpage=$("#currentpage").val();
    
    $(document).on("click",".pagination li a",function(){
        currentpage=$(this).attr("title");
        $("#currentpage").val(currentpage);
        filterdata();
    });

    $(document).on("change","#bus_name_type",function(){
       console.log('DDB On Change');
       location =  $("#bus_name_type option:selected").val();
    });

    $(document).on("keyup","#username",function(){
       console.log('DDB On Keyup Username');
        username = $(this).val();  
       console.log('DDB '+username);
            filterdata();
    });

    $(document).on("keyup","#bus_name",function(){
       console.log('DDB On Keyup bus_name');
        bus_name = $(this).val();
            filterdata();
    });

    function filterdata(){
       console.log('DDB On Before Post');
        $.post("<?=BASE_URL?>businesses/filter",
        {currentpage:currentpage,businessid:businessid,username:username,bus_name:bus_name},
        function(data,status){
            //console.log(data);
            //alert(bus_name);
            //alert(data);
            //alert(businessid);
            var obj=$.parseJSON(data);
            var htm='';
           if(obj.featureduser.res){
                //console.log(obj.rows);
                $.each(obj.featureduser.rows,function(i,val){
                    //console.log(val.bid_status);

                    if(val.business_name.length > 12){ var dot1='...'; }else{ var dot1=''; }
                    if(val.username.length > 12){ var dot2='...'; }else{ var dot2=''; }
                    if(val.address.length > 12){ var dot3='...'; }else{ var dot3=''; }
                    
				if (val.profile_Pic.indexOf('http') > -1) var profile_image=val.profile_Pic;
				else var profile_image= "<?=BASE_URL?>assets/image/user/thumb/"+val.profile_Pic;
                   //console.log(reciepe_image);                   
                    
                    
                    htm+='<div class="col-sm-6 col-md-4 col-xs-12 col-lg-4 system margin-bottom_35">';
                    htm+='<div class="product_vw_inner_content">';    
                    htm+='<div class="thumbnail product_cus_thumb">';
                    htm+='<a href="<?=BASE_URL?>sellerprofile/'+val.username+'"><div class="product_cus_thumb_inner img img-responsive center-block">';    
                    htm+='<img src="'+profile_image+'" alt="" class="img img-responsive center-block">';
                    htm+='</div></a>';
                    htm+='</div>';
                    htm+='<div class="caption product_text_caption">';
                    htm+='<div class="row margin-bottom_20">';
                    htm+='<div class="col-sm-12 col-xs-12">'; 
                    htm+='<div class="row margin-bottom_10">';
                    htm+='<div class="col-sm-4 col-xs-4 product_vw_price" title="type">Business</div>';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">'+val.business_name.substr(0,12)+''+dot1+'</div>';
                    htm+='</div>'; 
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-4 col-xs-4 product_vw_price" title="type">User</div>';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">'+val.username.substr(0,12)+''+dot2+'</div>';
                    htm+='</div>';
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-4 col-xs-4 product_vw_price" title="type">Address</div>';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">'+val.address.substr(0,12)+''+dot3+'</div>';
                    htm+='</div>';
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-4 col-xs-4 product_vw_price" title="type">State</div>';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">'+val.state.substr(0,12)+'</div>';
                    htm+='</div>';
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-4 col-xs-4 product_vw_price" title="type">Zip</div>';
                    htm+='<div class="col-sm-7 col-xs-7 add_to_compare">'+val.zip.substr(0,12)+'</div>';
                    htm+='</div>';
                    htm+='</div>';
                    htm+='</div>';
                    htm+='<div class="row">';
                    htm+='<div class="col-sm-6 col-xs-6 p">';
                    htm+='<a href="<?=BASE_URL?>sellerprofile/'+val.username+'" class="product_vw_add_to_cart" role="button"> <img src="<?=BASE_URL?>assets/image/view_details.png" class="img img-responsive" height="33" width="124"></a>'; 
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
