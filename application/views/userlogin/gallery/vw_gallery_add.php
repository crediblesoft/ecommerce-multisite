<?php //print_r($order); ?>

<div class="col-sm-9">
            <div class="">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Gallery >> Add Image</h4>
                         <span class="add-button">
                             <a href="<?=BASE_URL?>gallery/add" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span> Add Gallery</a>
                             <a href="<?=BASE_URL?>gallery/addvideos" class="btn btn-warning"> <span class="glyphicon glyphicon-plus-sign"></span> Add Videos</a>
                             <a href="<?=BASE_URL?>gallery/viewvideos" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open"></span> View Videos</a>
                         </span>
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                <div class="col-sm-12">
                    
                        <div class="form-group">
                            <form class="form-horizontal" id="form_gallery" role="form" enctype = 'multipart/form-data' method="post" action="<?=BASE_URL?>gallery/files">
                               <div class="form-group">
                              <label class="control-label col-sm-3 sr-only" for="image">Product Image</label>
                              <div class="col-sm-9">          
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-success btn-file">
                                                Browse… <input multiple="" id="file" name="file[]" type="file">
                                            </span>
                                        </span>
                                        <input class="form-control" id="image" readonly="" type="text" placeholder="Click on Browse and select images">
                                    
                                    </div>
                                  <span class="text-danger" id="image1_error"> (Max File Size 4MB Allowed) </span>
                              </div>
                              <span class="text-danger" id="image_error"></span>
                            </div>
                               
                                     
                           </form>                            
                        </div>
                    
                </div>
            </div>
               
        </div>
        
        
    </div>
</div>  

<script>
    var no_of_file=0;
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
        
      });

      $(document).ready( function() {
          $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });
      
      $(document).on('change','#file',function(e){
          var files = e.target.files;
            for(var i=0; i < files.length; i++) {
                    var f = files[i];
                    var file_size = f.size;
                    var file_name = f.name;
                    
                    
                    var ext = file_name.split('.').pop().toLowerCase();
                    var allowed_ext=['jpg','png','jpeg'];  
                    var check = jQuery.inArray(ext, allowed_ext) !== -1;
                    
                    if(!check){
                        $("#image1_error").html("Only jpg|png|jpeg Allowed");
                        $("#image_error").parent().addClass("has-error");
                        return false;
                    }
                    
                    if(file_size<=0){
                        $("#image1_error").html(file_name+" "+" file is corrupted. So you can not upload this file.");
                        $("#image_error").parent().addClass("has-error");
                        return false;
                    }
                    
                    if(file_size>4096000) {
                        $("#image1_error").html(file_name+" "+"File size is greater than 1MB ");
                        $("#image_error").parent().addClass("has-error");
                        return false;
                    }
                    
                    $("#form_gallery").submit();
            }
     });
     
</script>


