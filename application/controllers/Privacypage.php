<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Privacypage extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    
    public function index()
    {   $data=array("table"=>'pages','where'=>array('id'=>'3','status'=>'1'),'val'=>array());
        $log['about']=$this->common->getdata($data);
        $this->load->view('include/header');
        $this->load->view('harvest/Privacypage',$log);
        $this->load->view('include/footer');
    }
}