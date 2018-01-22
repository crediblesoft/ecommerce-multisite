<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->_screen_security_admin('Manage Category');
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'cat.category,cat.description,cat.status,cat.id,count(p.id) as noofproduct','table'=>'category as cat','where'=>array(),'minvalue'=>'','group_by'=>'cat.id','start'=>'','orderby'=>'cat.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.category=cat.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/category/";
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
        $this->load->view('admin/category/admin_vw_category',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"category","val"=>array("status"=>'Active'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();exit;
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Category(ies) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"category","val"=>array("status"=>'Inactive'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Category(ies) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function removehasproductid($selectedid){
        $flag=0;
        for($i=0;$i<count($selectedid);$i++){
            $data=array("table"=>'product',"where"=>array("category"=>$selectedid[$i]));
            $getcount=$this->common->count_val($data); 
            if($getcount > 0){ 
                $flag=1;//if (($key = array_search($selectedid[$i], $selectedid)) !== false) unset($selectedid[$key]);
            }
        }
        return $flag;
    }
    
    public function add(){
        $this->form_validation->set_rules('name','Category Name','trim|required');
        $this->form_validation->set_rules('description','Category Description','trim|required');
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $description=$this->input->post("description");
            $status=$this->input->post("status");
            $data=array('table'=>'category','val'=>array('category'=>$name,'description'=>$description,'status'=>$status));                
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Category has been added successfully.");
                redirect("admin/category/add/","refresh");
            }
        }else{
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/category/admin_vw_addcategory');
        $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function edit($id){ 
        $data=array('val'=>array(),'table'=>'category','where'=>array('id'=>$id));
        $log['category']=$this->common->getdata($data);
        if(!$log['category']['res']){
            $this->session->set_flashdata("warning","This category not in category list.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/category/admin_vw_editcategory',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function update(){ 
        $this->form_validation->set_rules('name','Category Name','trim|required');
        $this->form_validation->set_rules('description','Category Description','trim|required');
        $id=$this->input->post("id");
        if($this->form_validation->run()){ 
            $name=$this->input->post("name");
            $description=$this->input->post("description");
            $status=$this->input->post("status");
            $data=array('table'=>'category','val'=>array('category'=>$name,'description'=>$description,'status'=>$status),"where"=>array("id"=>$id));                
            $log=$this->common->update_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Category has been updated successfully.");
                redirect("admin/category","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'category','where'=>array('id'=>$id));
            $log['category']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/category/admin_vw_editcategory',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
} 
