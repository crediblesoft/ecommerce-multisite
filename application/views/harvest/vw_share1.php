<html>
	<head>
    <title>The Share Button</title>


<style type="text/css">
	img#share_button, img#share_button2 { cursor: pointer; }
</style>

<body>
<div id="fb-root"></div>

<!-- USE 'Asynchronous Loading' version, for IE8 to work
http://developers.facebook.com/docs/reference/javascript/FB.init/ -->

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId  : '1541384582852340',
      status : true, // check login status
      cookie : true, // enable cookies to allow the server to access the session
      xfbml  : true  // parse XFBML
    });
  };

  (function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>

<img id = "share_button" src = "" alt="Share">

<script type="text/javascript">
        $(document).ready(function(){
        $('#share_button').live('click', function(e){
        e.preventDefault();
        FB.ui(
        {
        method: 'feed',
        name: 'test',
        link: 'http://www.ucodice.com/harvest/campaign/view/77',
        picture: '<?php echo BASE_URL; ?>assets/image/logo.png',
        caption: 'I am a fan of TabPress',
        description: 'my description',
        message: ''
        });
        });
        });
    </script> 

<!--<p><strong>A Second Share Button</strong></p>

<img id = "share_button2" src = "https://URL-TO-YOUR-SHARE-BUTTON-IMAGE">

<script type="text/javascript">
$(document).ready(function(){
$('#share_button2').live('click', function(e){
e.preventDefault();
FB.ui(
{
method: 'feed',
name: 'TabPress 2',
link: 'http://URL-TO-SHARE/',
picture: 'https://URL-TO-IMAGE-IN-SHARE-DIALOG',
caption: 'I am a fan of TabPress',
description: 'TabPress -- Gotta love it!',
message: ''
});
});
});
</script>-->

</body>
</html>
