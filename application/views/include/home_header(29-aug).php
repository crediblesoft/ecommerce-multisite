
        <?php $categories=$this->commondata['category'];?>
      <!-- Static navbar -->
      <nav class="navbar navbar-default custom-nav-home">
        <div class="container new_width">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              <a class="row navbar-brand" href="<?=BASE_URL?>"><img src="<?=BASE_URL?>assets/image/logo.png" class="img-responsive new_img"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse custom-collapse-home">
            <ul class="nav navbar-nav cus-left-nav">
              <li class="active"><a href="<?=BASE_URL?>">Home</a></li>
              <li><a href="<?=BASE_URL?>aboutus/">About us</a></li>
              <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Products &nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                        <?php if($categories['res']){
                               foreach($categories['rows'] as $category){
                            ?>
                    <li><a href="<?=BASE_URL?>products/<?=$category->id?>"><?=$category->category?></a></li>
                        <?php } } ?>
                </ul></li>
              
		<li><a href="<?=BASE_URL?>recipe/">Recipes</a></li>
              <?php /*<li><a href="<?=BASE_URL?>termsconditions/">Terms & conditions</a></li>*/?>
              <li><a href="<?=BASE_URL?>campaign/">Support A Farm</a></li>
              <li><a href="<?=BASE_URL?>contactus/">Contact</a></li>
            </ul>
            <?php if(!$this->session->userdata('user_id')){ ?>
            <ul class="nav navbar-nav navbar-right cus-right-nav">
                <li><a href="<?=BASE_URL?>auth/login" class="btn btn-default">login</a></li>
              <li><a href="<?=BASE_URL?>auth/signup" class="btn btn-default">signup</a></li>
            </ul>  
            <?php }else{ ?>
              <!--<ul class="nav navbar-nav navbar-right cus-right-nav">
                 <li><a href="<?=BASE_URL?>auth/logout" class="btn btn-default">logout</a></li>
              </ul> -->
              
              <div class="btn-group nav navbar-nav navbar-right cus-right-nav1">
                  <div id="notification" class="notification text-right" style="display:none;">
                      <a href="<?=BASE_URL?>message" id="get_new_message">1</a>
                  </div>
                <button type="button" class="btn btn-default dropdown-toggle" 
                   data-toggle="dropdown">
                   <img src="<?=BASE_URL?>assets/image/user/thumb/<?=$this->session->userdata('user_image')?>" height="30" width="30" class="img-circle"> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                   <li><a href="<?=BASE_URL?>profile">My Profile</a></li>
                   <li><a href="<?=BASE_URL?>mail">Inbox (<?=$this->commondata['inbox']?>) </a></li>
                   <li><a href="<?=BASE_URL?>auth/logout">Logout</a></li>

                </ul>
             </div>
              
            <?php } ?>  
          </div><!--/.nav-collapse -->
        </div>
      </nav>
        
