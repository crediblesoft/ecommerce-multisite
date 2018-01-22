<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_period extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
       //echo "hi"; 
         $data=array('val'=>array(),'table'=>'theme_price','where'=>array());
         $log['membership']=$this->common->getdata($data);
         //echo "<pre>";
         //print_r($log); exit;
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/membership/admin_vw_membershipperiod',$log);
            $this->load->view('admin/include/admin_footer');
    }
    
//     public function edit($id){ 
//        $data=array('val'=>array(),'table'=>'theme_price','where'=>array('id'=>$id));
//        $log['membership']=$this->common->getdata($data);
//        if(!$log['membership']['res']){
//            $this->session->set_flashdata("warning","This is not valid data.");
//            //redirect("_404","refresh");
//        }
//        $this->load->view('admin/include/admin_header');
//        $this->load->view('admin/include/admin_left');
//        $this->load->view('admin/membership/admin_vw_editmembershipperiod',$log);
//        $this->load->view('admin/include/admin_footer');
//    }
      public function update($id){ 
        //echo $id; exit;  
        $this->form_validation->set_rules('type','Type','trim|required');
        $this->form_validation->set_rules('price','Price','trim|required');
        $this->form_validation->set_rules('noOfDays','No of Days','trim|required');
        if($this->form_validation->run()){
            $type=$this->input->post("type");
            $price=$this->input->post("price");
            $noOfDays=$this->input->post("noOfDays");
           // $id=$this->input->post("id");
            $data=array('table'=>'theme_price','val'=>array('type'=>$type,'price'=>$price,'noOfDays'=>$noOfDays),"where"=>array("id"=>$id));                
            $log=$this->common->update_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Membership Period Updated successfully.");
                redirect("admin/membership_period","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'theme_price','where'=>array('id'=>$id));
            $log['membership']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/membership/admin_vw_editmembershipperiod',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
     
    
} 
