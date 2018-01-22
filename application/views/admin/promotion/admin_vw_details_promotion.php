<style>.assign_users{padding:10px;}</style>
<section class="content-header">
    <h1>
     Manage Promotion Code
     <small>details</small>
    </h1>
<!--<ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
    </ol>-->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">    
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <!--<h3 class="box-title"></h3>-->   
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                
              <table class="table table-bordered">
                  <?php  $promotiondata=$promotion['rows'][0]; ?>
                <tbody>   
<!--                    <tr>
                        <td colspan="2"><p class="text-center"><strong>Transaction Information</strong></p></td>
                    </tr>-->
                    
                    <tr>
                        <th>Code</th>
                        <td><?=$promotiondata->code?></td>
                    </tr>
                    
                    <tr>
                        <th>Start Date</th>
                        <td><?=$promotiondata->start_date?></td>
                    </tr>
                    
                    <tr>
                        <th>End Date</th>
                        <td><?=$promotiondata->end_date?></td>
                    </tr>
                    
                    <tr>
                        <th>Discount</th>
                        <td><?=$promotiondata->discount?> %</td>
                    </tr>
                    
                    <tr>
                        <th>Users</th>
                        <td>
                          <?php  
                            if($assignusers['res']){
                                foreach($assignusers['rows'] as $assign){
                                    echo '<a target="_blank" class="assign_users" href="'.BASE_URL.'admin/users/details/'.$assign->id.'">'.$assign->username.'</a>';
                                }
                            }else{
                                echo "Currently no any user";
                            } 
                            ?>
                        </td>
                    </tr>
                    
                      
                </tbody>
                    
              </table> 
              
            </div>
                  
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
            </div>
          </div>
          <!-- /.box -->

        </div>
        
    </div>    
</section>