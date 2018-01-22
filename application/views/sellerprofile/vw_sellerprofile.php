<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <div class="col-sm-12">
            <div class="">
                <p class="featured_seller_head text-center margin-bottom_50"><?php echo ucfirst($this->uri->segment(2)) ?>'s Profile</p>
            </div>
            
            <?php 
                if($featureduser['res']){
                    //foreach($featureduser['rows'] as $userlist){
                       $userlist= $featureduser['rows'][0];
            ?>
            <div class="row">
                <div class="col-sm-3 col-md-2 col-lg-2 col-xs-8">
                    <div class="featured_seller_img_upper">
                    <div class="featured_seller_img">
                    <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$userlist->profile_Pic?>" class="img img-responsive img-rounded center-block">
                    </div>
                    </div>    
                </div>
                <div class="col-sm-9 col-md-8 col-lg-8 col-xs-12">
                    <div class="featured_seller_username margin-bottom_20"><?=$userlist->username?></div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Username
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->username?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Name
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->f_name?> &nbsp; <?=$userlist->l_name?>
                    </div>
                    
                    
                    <?php if($userlist->type_Of_User==1){ ?>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business Name
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->business_name?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business Type
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->business_type?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business Address
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->bus_address?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business City
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->bus_city?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business State
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->bus_state?>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Business Zip
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->bus_zip?>
                    </div>
                    
                    
                    <div class="col-sm-5 col-md-5 col-lg-5 col-xs-12 pull-right">
                        
                        <a href="<?=BASE_URL?><?=$userlist->username?>/Shope/user_profile" target="_blank"> <img src="<?=BASE_URL?>assets/image/view_shop.png"> </a>
                        <a href="<?=BASE_URL?>events/viewsellerwiseEvents/<?=$userlist->id?>" target="_blank"> <img src="<?=BASE_URL?>assets/image/View-Event.png"> </a>
<!--                        <a class="btn btn-success" href="<?=BASE_URL?>events/viewsellerwiseEvents/<?=$userlist->id?>"> <span class="glyphicon glyphicon-plus-sign"></span> View Event</a>-->
                    </div>
                    
                    <?php }else{ ?>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                       City
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->city?>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        State
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->state?>&nbsp;
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xs-6 featured_seller_inner_head">
                        Zip
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9 col-xs-6 featured_seller_inner_content">
                        <?=$userlist->zip?>&nbsp;
                    </div>
                    <?php } ?>
                </div>
            </div>
            <p class="featured_seller_border3">&nbsp;</p>
                
            <?php if($userlist->type_Of_User==1){ ?>
            
            <p class="write_reviews_head">Write your reviews</p>
            
            
            
            <div class="clearfix margin-bottom_30">
                
                <?php if($this->session->has_userdata("user_id")){ ?>
                <div class="text-danger" id="sratError" style="clear:both;"></div>
                <div id="result-add"></div>
                <form action="<?php echo BASE_URL; ?>ratting/addreview" method="post" id="addreviews_add">
                    <div class="write_reviews_main">
                        
                    <div class="form-group star_main_div"> 
                    <div class="stars">
                          <input class="star star-5" id="star-5" type="radio" name="star"/>
                          <label class="star star-5" onClick="star1(5)" for="star-5"></label>
                          <input class="star star-4" id="star-4" type="radio" name="star"/>
                          <label class="star star-4" onClick="star1(4)" for="star-4"></label>
                          <input class="star star-3" id="star-3" type="radio" name="star"/>
                          <label class="star star-3" onClick="star1(3)" for="star-3"></label>
                          <input class="star star-2" id="star-2" type="radio" name="star"/>
                          <label class="star star-2" onClick="star1(2)" for="star-2"></label>
                          <input class="star star-1" id="star-1" type="radio" name="star"/>
                          <label class="star star-1" onClick="star1(1)" for="star-1"></label>     
                    </div>
                        <input type="hidden" class="form-control" id="srars" name="stars" value="0">
                        <input type="hidden" class="form-control" id="revuserId" name="revuserId" value="<?=$userlist->id?>">
                    </div>     
                    <div class="form-group" id="revG">
                        <!--<label >Write Your Reviews</label>  -->
                        <textarea class="form-control" id="reviews" name="reviews" placeholder="Your review helps others learn about great local business"></textarea>
                    </div>
                        
                    </div>    
                    <div class="form-group">
                        <!--<button type="submit" class="btn btn-primary" id="addStarratting">Submit</button>-->
                         
                        <img src="<?=BASE_URL?>assets/image/submit.png" id="addStarratting">
                    </div>
                </form>  
                
                <?php }else{ ?>
                    <form action="<?php echo BASE_URL; ?>ratting/addreview" method="post" id="addreviews">    
                    <div class="form-group"> 
                        <input type="hidden" class="form-control" id="revuserId1" name="revuserId" value="<?=$userlist->id?>">
                    </div>     
                    
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary" id="">Write your reviews</button>
                    </div>
                </form>
                <?php } ?>
            </div>
            
            <div class="clearfix">
                <p class="featured_seller_head">Reviews</p>
            </div>
            
            <div class="srat-main col-sm-12 col-md-12 col-lg-12 col-xs-12">
                <?php 
                    //print_r($reviews);
                    if($reviews['res']){
                        foreach($reviews['rows'] as $reviews){
                ?>
                        <div class="margin-bottom_10">
                            <div class="row">
                                <?php for($i=0;$i<$reviews->stars;$i++){ ?>
                                <i class="fa fa-star star-custom"></i>
                                <?php } ?>
                                <?php for(;$i<5;$i++){ ?>
                                <i class="fa fa-star star-custom2"></i>
                                <?php } ?>
                            </div>
                            <div class="row author margin-bottom_10"><?php echo ucfirst($reviews->f_name).' '.$reviews->l_name; ?><br/><?php echo $reviews->date; ?></div>
                            <div class="row margin-bottom_10"><?php echo $reviews->reviews; ?></div>
                            <div class="row view_review"></div>
                            <?php /*if($this->session->userdata('user_id') == $reviews->RevuserId || $this->session->userdata('user_id') == $reviews->WriteReviewuserId){ ?>
                            <div class="row">
                            <span class="pull-right">
                                <a href="javascript:void(0);" data-target="#editreview" data-toggle="modal" class="btn btn-warning btn-xs edit-review" id="<?php echo $reviews->id; ?>"><i class="fa fa-fw fa-edit"></i></a>
                                <a href="javascript:void(0);" data-target="#deletreview" data-toggle="modal" class="btn btn-danger btn-xs delete-review" id="<?php echo $reviews->id; ?>" ><i class="fa fa-fw fa-close"></i></i></a>
                            </span>
                            </div>
                            <?php }*/ ?>
                        </div>
                    <?php } }else{ ?>
                <p class="text-danger"> No Reviews </p>
                    <?php } ?>
            </div>
             <?php } ?>
          <?php } else{ ?>
            <p>This is not valid user</p>
                <?php } ?>  
            
        </div>
    </div>
</div> 




<div class="modal fade" id="editreview" tabindex="-1" role="dialog" aria-labelledby="editearningLabel" aria-hidden="true">
         <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title" id="myModalLabel">Edit Reviews</h4>
                  </div>
                  <div class="modal-body">
                     <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-add"></div></div>
                     <div class="box-body">
                        <div class="text-danger" id="sratError"></div>
                                    <div id="result-add"></div>
                                    <form action="">    
                                        <!--<div class="form-group"> 
                                        <div class="stars">
                                              <input class="star star-5" id="star-5" type="radio" name="star"/>
                                              <label class="star star-5" onClick="star1(5)" for="star-5"></label>
                                              <input class="star star-4" id="star-4" type="radio" name="star"/>
                                              <label class="star star-4" onClick="star1(4)" for="star-4"></label>
                                              <input class="star star-3" id="star-3" type="radio" name="star"/>
                                              <label class="star star-3" onClick="star1(3)" for="star-3"></label>
                                              <input class="star star-2" id="star-2" type="radio" name="star"/>
                                              <label class="star star-2" onClick="star1(2)" for="star-2"></label>
                                              <input class="star star-1" id="star-1" type="radio" name="star"/>
                                              <label class="star star-1" onClick="star1(1)" for="star-1"></label>     
                                        </div>
                                            <input type="hidden" class="form-control" id="srars" value="0">
                                            <input type="hidden" class="form-control" id="revuserId" value="<?php echo $this->uri->segment(2); ?>">
                                        </div>-->     
                                        <div class="form-group" id="revG">
                                            <input type='hidden' id='editRev-id'>
                                            <label >Write your reviews</label>  
                                            <textarea class="form-control" id="edit-reviews" name="reviews"></textarea>
                                            <span id="error_reviews"></span>
                                        </div>
                                        
                                    </form> 
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary" id="edit" name="edit">Submit</button>
                  </div>
               </div>
         </div>
      </div>
       <div id="deletreview" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deletbrandLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 id="myModalLabel">Delete Review</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <p style="font-size: 16px;">Are you sure you want to delete this Review ?</p>
                                <input type="hidden" name="revId" id="revId" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group text-center">
                            <button class="btn btn-md btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            <button class="btn btn-md btn-primary" name="delete" id="delete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<script type='application/javascript'>
   
    function star1(s){
        $("#srars").val(s);
    }
    
    $(document).ready(function() {
        
    $('#addStarratting').click(function(){
       
      
        //var errorcnt = 0;
        var stars = $("#srars").val();
        var reviews = $('#reviews').val().trim();
        var revuserId = $("#revuserId").val();
        
        if(stars == 0)
        {
            $('#sratError').html('Please select star');
            
            return false;
        }
        if(reviews == "")
        {
            $('#sratError').text('Please write your reviews.');
            $('#revG').addClass("has-error");
            
            return false;
        }
        
       //return true;
       $("#addreviews_add").submit();
    });
    
    $('.edit-review').click(function(){
        var id = $(this).prop('id');
        $.ajax({
            type: 'POST',
            url: '<?php echo BASE_URL; ?>ratting/get_reviews',
            data: { id: id},
            Async:false,
            success:function(res){
            // successful request; do something with the data
            //console.log(res);
               $.each(eval(res),function(i,item)
                {
                    if(item.status)
                    {
                        //alert(item.earning_type);
                        $('#edit-reviews').val(item.reviews);
                        $('#editRev-id').val(item.id);
                    }
                });
               
            }
        });
    });
    
   $('#edit').click(function(){
        var errorcnt = 0;
        var editReviews = $('#edit-reviews').val().trim();
        if(editReviews == "")
        {
            $('#edit-reviews').val('');
            $('#error_reviews').text('');
            $('#error_reviews').text('Please Enter Your Reviews.');
            $('#error_reviews').parent().addClass('has-error');
            errorcnt++;
            return false;
        }
       
        if(errorcnt == 0)
        {
            var id = $('#editRev-id').val().trim();
            $.ajax({
            type: 'POST',
            url: '<?php echo BASE_URL; ?>ratting/update_reviews',
            data: { editReviews: editReviews, id: id },
            success:function(res){
            // successful request; do something with the data
                $.each(eval(res),function(i,item)
                {
                    if(item.status)
                    {
                        $("#e-result-add").empty().append(item.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                    }
                    else
                    {
                        $("#e-result-add").empty().append(item.message).addClass("alert alert-error fade in");
                    }
                });
            }
            });
        }
    });
    
    $('.delete-review').click(function(){
        $('#revId').val('');
        var id = $(this).prop('id');
        $('#revId').val(id);
    });
    
    
    $('#delete').click(function(){
        var id = $('#revId').val();
        
        $.ajax({
            type: 'POST',
            url: '<?=BASE_URL?>ratting/deletereview',
            data: { id: id },
            success:function(res){
                //console.log(res);
            // successful request; do something with the data
                $.each(eval(res),function(i,item)
                {
                    if(item.status)
                    {
                        $("#e-result-delete").empty().append(item.message).addClass("alert alert-success fade in");
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                    }
                    else
                    {
                        $("#e-result-delete").empty().append(item.message).addClass("alert alert-error fade in");
                    }
                });
            }
        });
    });
    
    
    });
</script>
