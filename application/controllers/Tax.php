<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends MY_Controller {
    private $userid;
//    private $currentmonth;
//    private $currentyear;
//    private $userpaidstatus;
    
    function __construct()
    {
        parent::__construct();
        $this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        //$this->_validForContoller();
//        $this->userpaidstatus=$this->session->userdata('user_paid');
//        $this->currentmonth=date('m');
//        $this->currentyear=date('Y');
//        
        //$this->is_buyer();
    }
    
    public function index(){
        $usertax=$this->_get_user_tax($this->userid);
        if($usertax){ $tax['tax']=$usertax;$tax['default']=0; }else{$seller=$this->getsellers(array('state'),array('id'=>$this->userid));$tax['tax']=$this->_get_default_tax($seller['rows'][0]->state);$tax['default']=1;}
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft',$tax);
        $this->load->view('userlogin/tax/vw_tax');
        $this->load->view('include/footer');
    }   
    
    public function settax(){
        $this->form_validation->set_rules('details','Tax Title','trim|required');
        $this->form_validation->set_rules('total','Percentage','trim|required');
        if($this->form_validation->run()){ 
            $details=$this->input->post("details");
            $total=$this->input->post("total");
            $default=$this->input->post("default1");
            $id=$this->input->post("id");
            $data=array('table'=>'user_tax','val'=>array('user_id'=>$this->userid,'details'=>$details,'total'=>$total));
            if($default){$log=$this->common->add_data($data);}else{
            $data['where']=array('id'=>$id);unset($data['val']['user_id']);$log=$this->common->update_data($data);}
            if($log){echo json_encode(array('status'=>true,'message'=>'Tax Changed Successfully.','title'=>"Success"));}else{echo json_encode(array('status'=>false,'message'=>'Something went wrong.Please try again.','title'=>"Warning"));}
        }else{
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/tax/vw_tax');
            $this->load->view('include/footer');
        } 
    }
    
    private function _get_user_tax($userid){
        $data=$this->db->get_where('user_tax', array('user_id' => $userid))->row();
        if($data){ return $data; }else{ return false;}
    }
    
    private function _get_default_tax($stateid=1){
        $data=$this->db->get_where('default_tax', array('state_id' => $stateid))->row();
        if($data){ return $data; }else{ return (object)array('id'=>'','details'=>'','total'=>'');}
    }
}    