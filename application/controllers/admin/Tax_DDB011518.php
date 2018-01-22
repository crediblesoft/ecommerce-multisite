<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'dt.id,dt.details,dt.total,sl.state,sl.code','table'=>'default_tax as dt','where'=>array(),'minvalue'=>'','group_by'=>'dt.id','start'=>'','orderby'=>'sl.state','orderas'=>'');
        $multijoin1=array(
            array('table'=>'statelist as sl','on'=>'sl.id=dt.state_id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/tax/";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        //$config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/tax/admin_vw_tax',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function add(){
        $this->form_validation->set_rules('state','State','trim|required');
        $this->form_validation->set_rules('details','Tax Tile','trim|required');
        $this->form_validation->set_rules('total','Total','trim|required');
        if($this->form_validation->run()){
            $state=$this->input->post("state");
            $details=$this->input->post("details");
            $total=$this->input->post("total");
            //$status=$this->input->post("status");
            $data=array('table'=>'default_tax','val'=>array('state_id'=>$state,'details'=>$details,'total'=>$total));                
            $log=$this->common->add_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Tax added successfully.");
                redirect("admin/tax/add/","refresh");
            }
        }else{
            //$log['states']=$this->get_states();
            $this->db->select('state_id'); $getaddtax=$this->db->get('default_tax')->result();$state=array();if($getaddtax){foreach($getaddtax as $getaddtax1){ array_push($state, $getaddtax1->state_id);}}
            $this->db->where_not_in("id",$state);$statelist=$this->db->get('statelist')->result();if($statelist){$log['states']=$statelist;}else{$log['states']=false;}
            $log['editform']=0;
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/tax/admin_vw_addtax',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function edit($id){
        $this->form_validation->set_rules('state','State','trim|required');
        $this->form_validation->set_rules('details','Tax Tile','trim|required');
        $this->form_validation->set_rules('total','Total','trim|required');
        if($this->form_validation->run()){
            $state=$this->input->post("state");
            $details=$this->input->post("details");
            $total=$this->input->post("total");
            //$status=$this->input->post("status");
            $data=array('table'=>'default_tax','where'=>array('id'=>$id),'val'=>array('state_id'=>$state,'details'=>$details,'total'=>$total));                
            $log=$this->common->update_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Tax updated successfully.");
                redirect("admin/tax","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'default_tax','where'=>array('id'=>$id));
            $log['editdata']=$this->common->getdata($data);
            $log['editform']=1;
            //print_r($log['editdata']);
            if(!$log['editdata']['res']){
                $this->session->set_flashdata("warning","Want to get wrong data.");
                redirect("_404","refresh");
            }
            $this->db->select('state_id'); $this->db->where('id !=',$id); $getaddtax=$this->db->get('default_tax')->result();$state=array();if($getaddtax){foreach($getaddtax as $getaddtax1){ array_push($state, $getaddtax1->state_id);}}
            $this->db->where_not_in("id",$state);$statelist=$this->db->get('statelist')->result();if($statelist){$log['states']=$statelist;}else{$log['states']=false;}
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/tax/admin_vw_addtax',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    
    public function delete(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"default_tax","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count State's tax(es) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
     public function search($catid=null){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val');$val=trim($val);
        if($searchby=='state'){
            $comment1=array('val'=>'dt.id,dt.details,dt.total,sl.state,sl.code','table'=>'default_tax as dt','where'=>array('dt.state_id'=>$val),'minvalue'=>'','group_by'=>'dt.id','start'=>'','orderby'=>'sl.state','orderas'=>'');
            $resp=$this->searchbycategory($comment1);
        }else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/tax","refresh");
        }
        if($searchby=='category'){ // category searching
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/tax/admin_vw_tax',$resp);
            $this->load->view('admin/include/admin_footer');
        }else{
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/tax/admin_vw_tax',$resp);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function searchbycategory($comment1){
        $multijoin1=array(  array('table'=>'statelist as sl','on'=>'sl.id=dt.state_id','join_type'=>'left'));
        $log['products']=$this->common->multijoin($comment1,$multijoin1);
        $log["links"] = '';
        return $log;
    }
    
    public function getstates(){
        echo json_encode($this->get_states());
    }
 
} 
