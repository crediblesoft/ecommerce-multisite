<style>
    .otg-carousel {
  //width: 800px;
  height: 420px;
  margin: 50px auto;
  background-color: #000;
  position: relative;
  border: solid 1px #000;
}

.otg-carousel-shell,
.otg-carousel-mask {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  text-align: center;
  transition: left .5s ease;
}

.otg-carousel .otg-dots {
    margin: 0 auto;
    padding: 0;
    position: absolute;
    bottom: 20px;
    width: 100%;
    text-align: center;
    z-index: 100;
}

.otg-carousel .otg-dots li {
    list-style: none;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    cursor: pointer;
    margin: 5px;
    border: solid 1px #000;
    display: inline-block;
    background-color: #fff;
}
.otg-carousel .otg-dots .selected {
  background-color: #777;
}

.otg-carousel .left-arrow,
.otg-carousel .right-arrow {
  width: 0;
	height: 0;
  position: absolute;
  top: 50%;
  cursor: pointer;
  z-index: 999;
}
.otg-carousel .left-arrow {
	border-top: 10px solid transparent;
	border-right: 20px solid #fff;
	border-bottom: 10px solid transparent;
  margin-top: -10px;
  left: 20px;
}

.otg-carousel .right-arrow {
	border-top: 10px solid transparent;
	border-left: 20px solid #fff;
	border-bottom: 10px solid transparent;
  margin-top: -10px;
  right: 20px;
}

.otg-image-caption {
  position: absolute;
  z-index: 999;
  left: 0;
  padding: 10px 60px;
  width: 100%;
  box-sizing: border-box;
  background-color: rgba(0, 0, 0, 0.44);
  color: #fff;
  transition: .5s ease;
}

.otg-image-caption h1 {
  font-size: 16px;
}

.otg-thumbnails {
  width: 100%;
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 999;
  text-align: center;
  margin: 0 0 0 1px;
  padding: 0;
  margin-bottom: -70px;
  background-color: #000;
  font-size: 0;
  list-style: none;
}

.otg-thumbnails li {
  border: solid 1px #000;
  margin: 0;
  padding: 0;
  font-size: 0;
  height: 90px;
  display: inline-block;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  cursor: pointer;
  margin-left: -2px;
}
</style>
  <div id="jquery-script-menu">
  

    <header id="carousel"></header>
    <button id="pause">pause</button>
    <button id="start">start</button>
  </div>
    <!--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
    <script src="http://localhost/shope_harvest/edit_assets/gellary/demo3/js/jquery.otg-carousel.js" type="text/javascript"></script>
  <script>
      $(function() {
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
        });

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
    <script type="text/javascript">
/*
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

 /*(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();*/

</script>
