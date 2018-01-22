<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbord extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {   
        $this->load->view('include/vw_header');
        $this->load->view('vw_dashbord');
        $this->load->view('include/vw_footer');
    }

}