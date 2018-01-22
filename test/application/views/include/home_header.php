
        <?php $categories=$this->commondata['category'];?>
      <!-- Static navbar -->
      <nav class="navbar navbar-default custom-nav-home">
        <div class="col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              <a class="navbar-brand" href="<?=BASE_URL?>"><img src="<?=BASE_URL?>assets/image/logo.png" class="img-responsive"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse custom-collapse-home">
            <ul class="nav navbar-nav cus-left-nav">
              <li class="active"><a href="<?=BASE_URL?>">Home</a></li>
              <li><a href="<?=BASE_URL?>aboutus/">About us</a></li>
              <li><a href="<?=BASE_URL?>contactus/">Contact</a></li>
		<li><a href="<?=BASE_URL?>recipe/">Recipe</a></li>
              <?php /*<li><a href="<?=BASE_URL?>termsconditions/">Terms & conditions</a></li>*/?>
              <li><a href="<?=BASE_URL?>campaign/">Campaign</a></li>
              <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Products &nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                        <?php if($categories['res']){
                               foreach($categories['rows'] as $category){
                            ?>
                    <li><a href="<?=BASE_URL?>products/<?=$category->id?>"><?=$category->category?></a></li>
                        <?php } } ?>
                </ul></li>
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
        
