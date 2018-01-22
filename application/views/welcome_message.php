<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title><?=TITLE?></title>
    
     <!-- Bootstrap core CSS -->
    <link href="<?=BASE_URL?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=BASE_URL?>assets/css/style_ui.css" rel="stylesheet">
    
    
     <script src="<?=BASE_URL?>assets/js/1.11.3_jquery.min.js"></script>
    
    <script src="<?=BASE_URL?>assets/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="<?=BASE_URL?>assets/js/jquery.easing.1.3.js"></script>

<!--<script type="text/javascript">      
      $(document).ready(function() {
//        $(".banner").delay(10000).queue(function(){
//            $(this).css({"background-image":"url(<?=BASE_URL?>assets/image/home/banner2.png)"}); 
//        });
        
    setTimeout(showpanel, 3000);
    function showpanel() { 
        $('.banner').fadeTo('slow', 0.3, function()
        {
            $(this).css('background-image', 'url(<?=BASE_URL?>assets/image/home/banner2.png)');
        }).fadeTo('slow', 1);

     //$(".banner").css({"background-image":"url(<?=BASE_URL?>assets/image/home/banner2.png)"});
     setTimeout(showpanel2, 3000);
    }
    
    function showpanel2() { 
        $('.banner').fadeTo('slow', 0.3, function()
        {
            $(this).css('background-image', 'url(<?=BASE_URL?>assets/image/home/banner.png)');
        }).fadeTo('slow', 1);
     //$(".banner").css({"background-image":"url(<?=BASE_URL?>assets/image/home/banner.png)"});
     setTimeout(showpanel, 3000);
    }
        
      });
</script>-->
  </head>
  
  <body>
      
      <div class="container-fluid">
          <div class="row margin-bottom_40">
              
<!--            <div class="banner img img-responsive">
                 <?php //$this->load->view("include/home_header"); ?>
                <div class="">
                    <div class="row col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                        <div class="banner_text1">
                            
                                <span class="banner_text1_inner">
                                FARMERS WORKING IN 
                                </span>
                            <span>
                                <img src="<?=BASE_URL?>assets/image/home/banner_logo.png" class="img img-responsive">
                            </span>
                        </div>
                        <div class="">
                            <p class="banner_text2">THE FIELD</p>
                        </div>
                    </div>
                </div>    
            </div>-->
<?php $this->load->view("include/home_header"); ?>
<style>
/*   
	old css by neeraj
	.carousel-inner .active img{border-bottom-left-radius: 50% 15% !important;
	border-bottom-right-radius: 50% 15% !important; }
	
	.carousel-inner .left img{border-bottom-left-radius: 50% 15% !important;
	border-bottom-right-radius: 50% 15% !important; }
*/

/*  new changes to give curve at slider images by jat sachin */

.slider_curve
{	
	border-radius: 900px/170px;
	border-top-left-radius: 0em;
	border-top-right-radius: 0em; 
	overflow: hidden;	
	perspective: 1px; /* used this for chrome only or use opacity:0.99; */
}
</style>

<div  class='slider_curve'>
    
    
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-left: 0px; width: 100%;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

          <div class="item active">
              <img src="<?=BASE_URL?>assets/image/home/banner.png" alt="Chania" class="img img-responsive" width="100%" >
            <div class="carousel-caption">
                <div class="">
                    <div style="width:70%; margin:auto;">
                        <!-- <div class="row col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 caption-head"> -->
                            <div class="banner_text1">

                                    <span class="banner_text1_inner">
                                    FARMERS WORKING IN 
                                    </span>
                                <span>
                                    <img src="<?=BASE_URL?>assets/image/home/banner_logo.png" class="img img-responsive logo_img1">
                                </span>
                            </div>
                            <div class="">
                                <p class="banner_text2">THE FIELD</p>
                            </div>
                        </div>
                </div>
            </div>
          </div>

          <div class="item">
            <img src="<?=BASE_URL?>assets/image/home/banner2.png" alt="Chania" class="img img-responsive" width="100%">
            <div class="carousel-caption">
                <div class="">
                    <div style="width:70%; margin:auto;">
                        <!-- <div class="row col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 caption-head"> -->
                        <div class="banner_text1">

                                <span class="banner_text1_inner">
                                FARMERS WORKING IN 
                                </span>
                            <span>
                                <img src="<?=BASE_URL?>assets/image/home/banner_logo.png" class="img img-responsive logo_img1">
                            </span>
                        </div>
                        <div class="">
                            <p class="banner_text2">THE FIELD</p>
                        </div>
                    </div>
                </div>
            </div>
          </div>

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left custom_left" aria-hidden="true"><img src="<?php echo BASE_URL ?>assets/image/home/arrow.png"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right custom_right" aria-hidden="true"><img src="<?php echo BASE_URL ?>assets/image/home/arrow1.png"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
    
</div>
     

          </div>
          
         
          <div class="row">
              <div class="text-center">
                  <p class="home-head">Long Established Fact That a reader will be distracted</p>
              <p class="home-head-text" >by the readable content of a page when looking at its layout</p>
              </div>
          </div>
          
          <div class="row margin-bottom_25">
              <div class=" col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                  
                  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-12 home_center_img">
                      <div class="">
                      <img src="<?=BASE_URL?>assets/image/home/1.png" class="img img-responsive center-block">
                      </div>
                      <div class="home_img_content1 text-center"> 
                          <p class="home_img_content_head">cooking at home</p>
                          <p class="home_img_content_innercont">There is many variation of passages of Lorem ipsum available</p>
                      </div>
                  </div>
                  
                  
                  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-12 home_center_img">
                      <div class="">
                      <img src="<?=BASE_URL?>assets/image/home/2.png" class="img img-responsive center-block">
                      </div>
                      <div class="home_img_content2 text-center">
                          <p class="home_img_content_head">cooking in restaurants</p>
                          <p class="home_img_content_innercont">There is many variation of passages of Lorem ipsum available</p>
                      </div>
                  </div>
                  
                  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-12 home_center_img">
                      <div class="">
                      <img src="<?=BASE_URL?>assets/image/home/3.png" class="img img-responsive center-block" >
                      </div>
                      <div class="home_img_content3 text-center">
                          <p class="home_img_content_head">supermarkets</p>
                          <p class="home_img_content_innercont">There is many variation of passages of Lorem ipsum available</p>
                      </div>
                  </div>
              </div>    
          </div>
        
          
          <div class="row margin-bottom_25">
              <div class=" col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                  <p class="home_page_content text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                  <p class="home_page_content text-center"> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, </p>
              </div>
          </div>
          
          
          <div class="row ">
              <div class=" col-sm-10 col-md-10 col-lg-10 col-xs-12 col-sm-offset-1 col-md-offset-1 col-lg-offset-1 ">
                  <div class="col-sm-3 col-md-2 col-lg-2 col-xs-12">
                      <div class="margin-bottom_10">
                          <img src="<?=BASE_URL?>assets/image/home/quality_icon.png" class="img img-responsive center-block">
                      </div>
                      <p class="text-center home_quality"><strong>Quality</strong></p>
                      <p class="text-center home_quality_text">High Standards</p>
                      <div class="text-center home_quality_table table-responsive">
                          <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Nutrition value</td>
                                    </tr>
                                    <tr>
                                        <td>Taste qualities</td>
                                    </tr>
                                    <tr>
                                        <td>Safe & Hygienic</td>
                                    </tr>
                                </tbody>
                            </table>
                      </div>
                  </div>
                  
                  <div class="col-sm-6 col-md-8 col-lg-8 col-xs-12 inline1">
                      <div class="text-center margauto">
                          <img src="<?=BASE_URL?>assets/image/home/pea.png" class="img img-responsive center-block" width="100%">
                      </div>
                  </div>
                  
                  <div class="col-sm-3 col-md-2 col-lg-2 col-xs-12">
                      <div class="margin-bottom_10">
                          <img src="<?=BASE_URL?>assets/image/home/quality_icon.png" class="img img-responsive center-block">
                      </div>
                      <p class="text-center home_quality"><strong>Customer</strong></p>
                      <p class="text-center home_quality_text">Customer priority</p>
                      <div class="text-center home_quality_table table-responsive">
                          <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Leading price</td>
                                    </tr>
                                    <tr>
                                        <td>Timely Delivery</td>
                                    </tr>
                                    <tr>
                                        <td>Easy payments</td>
                                    </tr>
                                </tbody>
                            </table>
                      </div>
                  </div>
              </div>
          </div>
        
