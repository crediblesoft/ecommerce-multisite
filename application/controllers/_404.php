<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class _404 extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        //$this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
    }
    
    
    public function index(){
        $log['get_details']=array("res"=>false);
        $this->load->view('include/header');
        $this->load->view('vw_error',$log);
        $this->load->view('include/footer');
    }
}    