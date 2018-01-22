<?php //print_r($gallery); ?>
 <link href="<?=BASE_URL?>assets/css/ekko-lightbox.css" rel="stylesheet">
  <script src="<?=BASE_URL?>assets/js/ekko-lightbox.js"></script>

 <script type="text/javascript">
        $(document).ready(function ($) {
            // delegate calls to data-toggle="lightbox"
            $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function() {
                        if (window.console) {
                            return console.log('Checking our the events huh?');
                        }
                    },
                    onNavigate: function(direction, itemIndex) {
                        if (window.console) {
                            return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                        }
                    }
                });
            });
        });
    </script>
<style>
    .caption {
 position: absolute;
bottom: 25px;
left: 20px;
background: #363636 none repeat scroll 0% 0%;
opacity: 0.75;
width: 84.5%;
height: 82%;
padding: 2%;
display: none;
text-align: center;
z-index: 2;
}

.thumbnail{
    min-height: 150px;
    max-height: 150px;
    display: inline-flex;
    width: 100%;
}
.margin_auto{
  margin:auto;
}
</style>
<?php //print_r($order); ?>
<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Gallery</h4>
                         
                         <span class="add-button-gallery">
                             <a href="<?=BASE_URL?>gallery/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Gallery</a>
                             <a href="<?=BASE_URL?>gallery/addvideos" class="btn btn-warning"> <span class="glyphicon glyphicon-plus-sign"></span> Add Videos</a>
                             <a href="<?=BASE_URL?>gallery/viewvideos" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open"></span> View Videos</a>
                         </span>
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                <div class="col-sm-12">
                    <div class="row">
                        <?php if($gallery['res']){
                              foreach($gallery['rows'] as $gallerydata){
                            ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="thumbnail">
                                
                                <div class="caption animated">
                                    <a href="javascript:void(0);" role="model" class="btn btn-success edit_gal" id="<?=$gallerydata->id?>">
                                        <span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="javascript:void(0);" id="<?=$gallerydata->id?>" title="Delete" data-target="#deleteproduct" data-toggle="modal" class="btn btn-danger delete">
                                        <span class="glyphicon glyphicon-remove"></span></a>
                                    <a id="<?=$gallerydata->id?>" title="View" class="btn btn-success" data-toggle="lightbox" data-gallery="image" href="<?=BASE_URL?>assets/image/gallery/<?=$this->session->userdata('user_id');?>/<?=$gallerydata->image_path?>">
                                       <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                </div>
                                <img class="product-image margin_auto" src="<?=BASE_URL?>assets/image/gallery/<?=$this->session->userdata('user_id');?>/thumb/<?=$gallerydata->image_path?>" alt="" class="thumbimg">
                              
                            </div>
                        </div>
                        <?php } }else{ ?>
                        <p class="text-danger">There are no images in this album! </p>
                        <?php } ?>

                    </div>
                    <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                    </ul>
                </div>
            </div>
               
        </div>
        

        <form id="profile_pic_form" method="post" enctype = 'multipart/form-data' style="display:none;" action="<?=BASE_URL?>gallery/updateimage">
            <input type="hidden" id="galid" name="galid">
            <input type="file" id="profile_pic" name="file">
        </form>
        
    </div>
</div> 


<!-- Modal -->
<div id="deleteproduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Gallery Image</h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12 col-sm-12 col-xs-12"><div id="e-result-delete"></div></div>
          
          <input type="hidden" name="deleteId" id="deleteId">
          <h4>Do you want to delete image ?</h4>
         
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-success" id="delete" >Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="imgvalidationmsg" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong>Warning!</strong> </h4>
      </div>
      <div class="modal-body">
          
          <div class="alert alert-warning fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <p id="msgwarning" class="alert alert-error fade in"></p>
          </div>
          
      </div>
      <div class="modal-footer">   
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


  <script type="text/javascript">
$(document).ready(function(){
    // slide left to right
	/*$( ".thumbnail" )
		.mouseenter(function() {
			$(this).find('.caption').removeClass("slideOutLeft").addClass("slideInLeft").show();
		})
		.mouseleave(function() {
			$(this).find('.caption').removeClass("slideInLeft").addClass("slideOutLeft");
	 });*/
        // slide up down
        
        $("[rel='tooltip']").tooltip();    
 //$('body').live('hover','.thumbnail',function(){
 //$(".thumbnail").on("mouseover", ".products-list",
        /*$('.thumbnail').hover(
            function(){
                $(this).find('.caption').slideDown(500); //.fadeIn(250)
            },
            function(){
                $(this).find('.caption').slideUp(500); //.fadeOut(205)
            }
        );*/


        $(document).on(
        {
            mouseenter: function() 
            {
                $(this).find('.caption').slideDown(500);
            },
            mouseleave: function()
            {
                
                 $(this).find('.caption').slideUp(500);
            }
        }
        , '.thumbnail');
        
    });
</script>


<script>
    $(document).ready(function(){
        $(".delete").click(function(){
            var id=$(this).prop('id');
            //alert(id);
            $("#deleteId").val(id);
        });
        
        $("#delete").click(function(){
            var deleteId=$("#deleteId").val();
            $.post("<?=BASE_URL?>gallery/delete",{id:deleteId},function(data,status){
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
        
        $(".edit_gal").click(function(){
            $("#galid").val($(this).attr("id"));
            $("#profile_pic").click();
        });
        
        $("#profile_pic").change(function(){
            var file_size=$('#profile_pic')[0].files[0].size;
            var file_name=$('#profile_pic')[0].files[0].name;
            
            var ext = file_name.split('.').pop().toLowerCase();
            var allowed_ext=['jpg','png','jpeg'];  
            var check = jQuery.inArray(ext, allowed_ext) !== -1;

            if(!check){
                $("#msgwarning").html("Only jpg|png|jpeg Allowed");
                $('#imgvalidationmsg').modal('show');
                return false;
            }

            if(file_size>4096000) {
                $("#msgwarning").html("File size is greater than 4MB ");
                $('#imgvalidationmsg').modal('show');
                return false;
            }
            
            $("#profile_pic_form").submit();
        });
        
        });
    </script>    