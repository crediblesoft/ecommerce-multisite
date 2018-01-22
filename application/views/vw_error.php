<div class="row">
    
<section class="col-sm-12 text-center" id="main-content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="error-template">
                <?php if($get_details['res']){ if($get_details['rows']->status==0 && $get_details['rows']->type_Of_User==1){ ?>
    <div class="container">
    <p class='text-danger'><strong>There are two reasons you are seeing this page:</strong></p>
        <p class='text-danger'>1.You have entered invalid/expired url.</p>
        <p class='text-danger'>2.Your account may be inactive.</p>
<!--<small>If you are login please logout to visit site.</small>-->
    </div>
    <?php } } ?>
                <h1>
                    Oops!</h1>
                <h2 class="margin-bottom_40">
                    404 Not Found</h2>
                <div class="error-details margin-bottom_40">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div class="error-actions margin-bottom_40">
                    <a class="btn btn-primary btn-lg" href="<?=BASE_URL?>"><span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a>
                </div>
            </div>
        </div>
    </div>
</section>
</div>