
      </div><!-- this div start in adminleft.php /.content-wrapper -->
   

      
<footer class="main-footer">
        <div class="pull-right hidden-xs">
            Website Designed & Developed by <a href="http://www.ucodice.com/" target="_blank">Ucodice.com</a>
        </div>
    <strong>Copyright &copy; 2014-2015 <a href="<?=BASE_URL?>">Harvest links</a>.</strong> All rights reserved.
      </footer>

     
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    

   
          
<?php $this->load->view('include/successmsg.php'); ?>
<script>
    <?php if($this->session->flashdata("sucess")!=''){ ?>
        $('#Sucessmsg').modal('show');
    <?php } ?>
        
     <?php if($this->session->flashdata("warning")!=''){ ?>
        $('#Warningmsg').modal('show');
    <?php } ?>
</script>
    
    
  </body>
</html>