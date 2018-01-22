<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->_screen_security_admin('Manage Pages');
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'','table'=>'pages as p','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array();
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/product";
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
        $this->load->view('admin/pages/admin_vw_pages',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function edit($id){ 
        $data=array('val'=>array(),'table'=>'pages','where'=>array('id'=>$id));
        $log['category']=$this->common->getdata($data);
        if(!$log['category']['res']){
            $this->session->set_flashdata("warning","This page not in list.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/pages/admin_vw_editpages',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function update(){ 
        $id=$this->input->post("id");       
        $name=$this->input->post("name");
        $status=$this->input->post("status");
        $data=array('table'=>'pages','val'=>array('content'=>$name,'status'=>$status),"where"=>array("id"=>$id));                
        $log=$this->common->update_data($data);
        if($log){
            $this->session->set_flashdata("sucess","Page content has been updated successfully.");
            redirect("admin/pages","refresh");
        }
        
    }
    
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"pages","val"=>array("status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Page(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"pages","val"=>array("status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Page(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function details($id){
        $comment1=array('val'=>'','table'=>'pages as p','where'=>array('p.id'=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array();  
        $resp['products']=$this->common->multijoin($comment1,$multijoin1);        
        if(!$resp['products']['res']){
                //$this->session->set_flashdata("warning","This is not valid user.");
                //redirect("404","refresh");
            echo "go to 404";
            }
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/pages/admin_vw_page_details',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
} 
