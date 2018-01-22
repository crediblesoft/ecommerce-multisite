<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Share extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->library('session');
        
    }
    
    public function index()
    {  
        
        //$this->load->view('harvest/vw_share1');
        
        if($this->session->has_userdata("shareproduct")){
            //echo "<pre>";
            //print_r($this->session->userdata("shareproduct"));exit;
            $data['share']=$this->session->userdata("shareproduct");
            if($data['share']['trans_detail']['payment_for']=='campeign'){
                $campid=$data['share']['data']['campaign_id'];
                $compagindata=array("table"=>"campaign_detail","val"=>array(),"where"=>array("id"=>$campid));
                $data['campagindetails']=$this->common->getsinglerow($compagindata);
                //print_R($data['campagindetails']);
            }
            
            $this->load->view('include/header');
            $this->load->view('harvest/vw_share',$data);
            $this->load->view('include/footer');
        }else{
            $this->session->set_flashdata("warning","Session expire.");
            redirect("/","refresh");
        }
        
    }
    
}
