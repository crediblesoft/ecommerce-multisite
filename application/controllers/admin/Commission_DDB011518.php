<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commission extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    public function index(){
        $comment1=array('val'=>'*','table'=>'tb_admin_commision as t_ac','where'=>array(),'minvalue'=>'','group_by'=>'t_ac.id','start'=>'','orderby'=>'','orderas'=>'');
        $table=$this->common->getdata($comment1);
        //print_r($table); exit;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/commission/";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        //$config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['commission']=$this->common->getdata($comment1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo "<pre>";
        //print_r($resp['commission']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/commission/admin_vw_commission',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    public function edit($id){
       $dt = new DateTime();
       $current_dt=$dt->format('Y-m-d H:i:s');
       //echo $current_dt; exit;
       $this->form_validation->set_rules('comm_for_premium','Premium User','trim|required');
        $this->form_validation->set_rules('comm_for_freeuser','Free User','trim|required');
        if($this->form_validation->run()){
            $premium=$this->input->post("comm_for_premium");
            $freeuser=$this->input->post("comm_for_freeuser");
            //$status=$this->input->post("status");
            $data=array('table'=>'tb_admin_commision','where'=>array('id'=>$id),'val'=>array('comm_for_premium'=>$premium,'comm_for_freeuser'=>$freeuser,'comm_date'=>$current_dt));                
            $log=$this->common->update_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Commission updated successfully.");
                redirect("admin/commission","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'tb_admin_commision','where'=>array('id'=>$id));
            $log['editdata']=$this->common->getdata($data);
            $log['editform']=1;
            //print_r($log['editdata']);
            if(!$log['editdata']['res']){
                $this->session->set_flashdata("warning","Want to get wrong data.");
                redirect("_404","refresh");
            }
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/commission/admin_vw_edit_commission',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
 
} 
