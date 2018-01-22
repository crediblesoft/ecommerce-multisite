<link rel="stylesheet" href="<?php echo  BASE_URL.'edit_assets/slider/2/css/jquery.otg-carousel.css'?>">  
  <div id="jquery-script-menu" ondblclick="load_popup('#view_prod','#banner_popup')">
    <header id="carousel"></header>
    <button id="pause">pause</button>
    <button id="start">start</button>
  </div>


<!--    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
    <script src="<?php echo  BASE_URL.'edit_assets/slider/2/js/jquery.otg-carousel.js'?>" type="text/javascript"></script>
  <script>
      $(function() {
        $('#carousel').carousel({
          images: [
      <?php if($gallery){  $i=0;  // echo "image_path";
                foreach($gallery as $galle){$i++;
                    ?>
                    {src: '<?php echo  BASE_URL.'assets/image/gallery/'.$session_user_id.'/'.$galle['image_path'];?>', caption: '<h1><?php echo $i;?> Image</h1>'},    
              <?php }}
                    else
                    { 
                    for($i=1;$i<=4;$i++){               
                    ?> 
                      {src: '<?php echo  BASE_URL.'edit_assets/image/0'.$i.'.jpg';?>', caption: '<h1><?php echo $i;?> Image</h1>'},  
                    <?php }}?>
                        ],
          currentImageIndex: 0,
          useDots: true,
          useThumbnails: true,
          useCaptions: true,
          useArrows: true,
          interval: 2000
        });
      /*$(function() {
        $('#carousel').carousel({
          images: [
             {src: 'http://localhost/shope_harvest/edit_assets/image/baground1.jpg', caption: '<h1>First Image</h1>'},
            {src: 'http://localhost/shope_harvest/edit_assets/image/baground2.jpg', caption: '<h1>Second Image</h1>'},
            {src: 'http://localhost/shope_harvest/edit_assets/image/baground3.jpg', caption: '<h1>Third Image</h1>'},
            {src: 'http://localhost/shope_harvest/edit_assets/image/baground1.jpg', caption: '<h1>Fourth Image</h1>'},
            {src: 'http://localhost/shope_harvest/edit_assets/image/baground2.jpg', caption: '<h1>Fifth Image</h1>'},
            {src: 'http://localhost/shope_harvest/edit_assets/image/baground3.jpg', caption: '<h1>Third Image</h1>'},
            {src: 'http://localhost/shope_harvest/edit_assets/image/baground1.jpg', caption: '<h1>Fourth Image</h1>'},
            {src: 'http://localhost/shope_harvest/edit_assets/image/baground2.jpg', caption: '<h1>Fifth Image</h1>'}
          ],
          currentImageIndex: 0,
          useDots: true,
          useThumbnails: true,
          useCaptions: true,
          useArrows: true,
          interval: 1000
        });*/

        // starts carousel
          $('#start').click(function() {
            $('#carousel').carousel('startTimer');
          });

        // pauses carousel
          $('#pause').click(function() {
            $('#carousel').carousel('stopTimer');
          });

      });
    </script>
   
  
