<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Businesstypes extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
//        $comment1=array('val'=>'business_type_name,status,id','table'=>'business_types','where'=>array(),'minvalue'=>'','group_by'=>'cat.id','start'=>'','orderby'=>'cat.id','orderas'=>'DESC');
//        $multijoin1=array(
//            array('table'=>'product as p','on'=>'p.category=cat.id','join_type'=>'left'),
//        );
        
//        $table=$this->common->multijoin($comment1,$multijoin1);
        $comment1=array('val'=>'business_type_name,status,id','table'=>'business_types','where'=>array(),'minvalue'=>'','group_by'=>'id','start'=>'','orderby'=>'id','orderas'=>'DESC');
        $multijoin1=array();

        $table=$this->common->multijoin($comment1,$multijoin1);

        $config = array();
        $config["base_url"] = BASE_URL. "admin/businesstypes/";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        //$config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['businesstypes']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/businesstypes/admin_vw_businesstypes',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"businesstypes","val"=>array("status"=>'Active'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();exit;
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Business Type Name(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"business_types","val"=>array("status"=>'Inactive'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Business Type Name(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
   
    public function removehasbusinesstypeid($selectedid){
        $flag=0;
        for($i=0;$i<count($selectedid);$i++){
            $data=array("table"=>'businesstypes',"where"=>array("category"=>$selectedid[$i]));
            $getcount=$this->common->count_val($data); 
            if($getcount > 0){ 
                $flag=1;//if (($key = array_search($selectedid[$i], $selectedid)) !== false) unset($selectedid[$key]);
            }
        }
        return $flag;
    }
    
    public function add(){
        $this->form_validation->set_rules('name','Business Type Name','trim|required');
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $status=$this->input->post("status");
            $data=array('table'=>'business_types','val'=>array('business_type_name'=>$name,'status'=>$status));                
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Business Type Name has been added successfully.");
                redirect("admin/businesstypes/add/","refresh");
            }
        }else{
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/businesstypes/admin_vw_addbusinesstypes');
        $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function edit($id){ 
        $data=array('val'=>array(),'table'=>'business_types','where'=>array('id'=>$id));
        $log['business_type_name']=$this->common->getdata($data);
        if(!$log['business_type_name']['res']){
            $this->session->set_flashdata("warning","This Businesss Type Name not in Business_types list.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
       $this->load->view('admin/businesstypes/admin_vw_editbusinesstypes',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function update(){ 
        $this->form_validation->set_rules('name','Business Type Name','trim|required');
        $id=$this->input->post("id");
        if($this->form_validation->run()){ 
            $name=$this->input->post("name");
            $status=$this->input->post("status");
            $data=array('table'=>'business_types','val'=>array('business_type_name'=>$name,'status'=>$status),"where"=>array("id"=>$id));                
            $log=$this->common->update_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Business Type has been updated successfully.");
                redirect("admin/businesstypes","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'business_types','where'=>array('id'=>$id));
            $log['business_type_name']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/businesstypes/admin_vw_editbusinesstypes',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
} 
