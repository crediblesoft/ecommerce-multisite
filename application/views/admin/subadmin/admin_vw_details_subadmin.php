<style>.assign_users{padding:10px;}</style>
<section class="content-header">
    <h1>
     Manage Sub-Admin
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
                        <th>Username</th>
                        <td><?=$promotiondata->username?></td>
                    </tr>
                    
                    <tr>
                        <th>Name</th>
                        <td><?=$promotiondata->first_name?>&nbsp;<?=$promotiondata->last_name?></td>
                    </tr>
                    
                    <tr>
                        <th>Email</th>
                        <td><?=$promotiondata->email_id?></td>
                    </tr>

                    <tr>
                        <th>Security Role</th>
                        <td><?=$promotiondata->role_name?></td>
                    </tr>
                    
                    <tr>
                        <th>Password</th>
                        <td><?=$promotiondata->password2?></td>
                    </tr>
					
					<tr>
                        <th>Last Login</th>
                        <td><?php echo date('d-M-Y  H:m:s',$promotiondata->last_login);?></td>
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
