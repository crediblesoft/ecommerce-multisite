<!DOCTYPE html>
<html>
  <head>    
    <title><?php if($user_edit_panel){echo "HarvestLinks";}else{echo $mainpagetitle;}?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="charset=utf-8,Content-Type: text/html;"  >
    <link href="<?php echo BASE_URL ?>edit_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   
    
    
    <link href="<?php echo BASE_URL ?>edit_assets/css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo BASE_URL ?>edit_assets/js/1.11.3_jquery.min.js"></script>
    <script src="<?php echo BASE_URL ?>edit_assets/js/bootstrap.min.js" type="text/javascript"></script>
    
    
    <!--<link href="<?php //echo BASE_URL ?>edit_assets/toggle/bootstrap-toggle.css" rel="stylesheet">
    <script src="<?php //echo BASE_URL ?>edit_assets/toggle/bootstrap-toggle.js"></script>-->
    
    
    <script src="<?php echo BASE_URL ?>edit_assets/js/jqueryui_1.9.2_jquery-ui.js" type="text/javascript"></script>
     <link rel="stylesheet" href="<?php echo BASE_URL ?>edit_assets/css/1.8.23_themes_base_jquery-ui.css" type="text/css" media="all" />
    <!--
    <link href="<?=BASE_URL?>assets/css/jquery-ui.css" media="all" rel="stylesheet" type="text/css" />
    <script src="<?=BASE_URL?>assets/js/jquery-ui.js" type="text/javascript"></script>-->
   
    <!---<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>edit_assets/plugin/animate/animate.min.css">
     <script src="<?php echo BASE_URL ?>edit_assets/css/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <link href="<?php echo BASE_URL ?>edit_assets/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    
     -->
    
    
    
    <script src="<?php echo BASE_URL ?>assets/js/tinymce_4.2/tinymce.min.js" type="text/javascript"></script>
    <!--<link rel="stylesheet" href="<?php echo BASE_URL ?>edit_assets/build/1.2.3/css/pick-a-color-1.2.3.min.css">
    <script src="<?php echo BASE_URL ?>edit_assets/build/dependencies/tinycolor-0.9.15.min.js"></script>
    <script src="<?php echo BASE_URL ?>edit_assets/build/1.2.3/js/pick-a-color-1.2.3.min.js"></script>
    <script type="text/javascript">
	
		$(document).ready(function () {

			$(".pick-a-color").pickAColor({
			  showSpectrum            : true,
				showSavedColors         : true,
				saveColorsPerElement    : true,
				fadeMenuToggle          : true,
				showAdvanced		: true,
				showBasicColors         : true,
				showHexInput            : true,
				allowBlank		: true,
				inlineDropdown		: true
			});
			
		});
	
		</script>  --> 
    <link href="<?php echo BASE_URL ?>edit_assets/css/<?php echo $user_file_name;?>" rel="stylesheet" type="text/css" />
	<?php ?>
  </head>
  <body>
      <?php 
      if( isset($_SESSION) ) {
    // $TMP = $this->uri->uri_string(); // PROBLEM
    $TMP = $_SERVER['REQUEST_URI'];
    log_message('error', 'Session.php ALREADY STARTED: ' .$TMP); 

   }else{    
    session_start();

   }//endif;            

   // ORIGINAL SCRIPT
     // session_start(); 
      ?>
 