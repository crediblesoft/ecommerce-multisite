<?php  $product=$products['rows'][0]; ?>

<section class="content-header">
    <h1>
     Manage Pages
     <small>details</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                   <h3 class="box-title"><?=$product->page?></h3>  
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <?=$product->content?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>


