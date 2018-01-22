<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){

        $data=array('val'=>'v.screen_name','table'=>'admin as a','where'=>array('a.admin_type'=>'2','a.id'=>$this->userid,'v.status'=>'Active','s.status'=>'Active','r.status'=>'Active'),'minvalue'=>'','start'=>'','orderby'=>'a.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'security_roles as r','on'=>'a.role_id=r.id','join_type'=>'left'),
            array('table'=>'screen_security as s','on'=>'r.id=s.role_id','join_type'=>'left'),
            array('table'=>'valid_screens as v','on'=>'s.screen_id=v.id','join_type'=>'left'),
        );

        $valid_screens=$this->common->multijoin($data,$multijoin1);

        foreach($valid_screens['rows'] as $screen){
          $key_name=ADMIN_SESS.$screen->screen_name;
          $this->session->set_userdata($key_name,$screen->screen_name);
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/dashboard/admin_vw_welcome');
        $this->load->view('admin/include/admin_footer');
    }
    
    
}    
