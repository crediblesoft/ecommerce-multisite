<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategories extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->_screen_security_admin('Manage Sub Category');
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $data['category']=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
        $resp['category']=$this->common->getdata($data['category']);

        $comment1=array('val'=>'cat.category,cat.description,cat.status,cat.id,scat.id as scat_id,scat.sub_catid,scat.sub_category,scat.sub_description,scat.status as sub_status','table'=>'category as cat','where'=>array('cat.id'=>$resp['category']['rows'][0]->id),'minvalue'=>'','start'=>'','orderby'=>'cat.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'sub_category as scat','on'=>'cat.id=scat.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);

        $config = array();
        $config["base_url"] = BASE_URL. "admin/subcategory/";
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

//       if ($resp['products']['rows'][0]->sub_catid=='')  {
//        $resp['products']['rows'][0]->id=$resp['category']['rows'][0]->id;
//        $resp['products']['rows'][0]->category=$resp['category']['rows'][0]->category;
//       }

        //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/subcategory/admin_vw_subcategory',$resp);
        $this->load->view('admin/include/admin_footer');
    }

    public function getsubcategorylist($cat1){

        $data['category']=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
        $resp['category']=$this->common->getdata($data['category']);

        $comment1=array('val'=>'cat.category,cat.description,cat.status,cat.id,scat.id as scat_id,scat.sub_catid,scat.sub_category,scat.sub_description,scat.status as sub_status','table'=>'category as cat','where'=>array('cat.id'=>$cat1),'minvalue'=>'','start'=>'','orderby'=>'cat.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'sub_category as scat','on'=>'cat.id=scat.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);

        $config = array();
        $config["base_url"] = BASE_URL. "admin/subcategory/";
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

//       if ($resp['products']['rows'][0]->sub_catid=='')  {
//        $resp['products']['rows'][0]->id=$resp['category']['rows'][0]->id;
//        $resp['products']['rows'][0]->category=$resp['category']['rows'][0]->category;
//       }

        //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/subcategory/admin_vw_subcategory',$resp);
        $this->load->view('admin/include/admin_footer');
    }

    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"sub_category","val"=>array("status"=>'Active'),"where"=>array(),"in"=>"sub_catid","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();exit;
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Sub-Category(ies) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"sub_category","val"=>array("status"=>'Inactive'),"where"=>array(),"in"=>"sub_catid","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Sub-Category(ies) removed from active list."));
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
    
    public function add($id,$descrip){
        $this->form_validation->set_rules('name','Sub Category Name','trim|required');
        $this->form_validation->set_rules('description','Sub Category Description','trim|required');
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $description=$this->input->post("description");
            $status=$this->input->post("status");
            $data=array('table'=>'sub_category','val'=>array('id'=>$id,'sub_category'=>$name,'sub_description'=>$description,'status'=>$status));                
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Sub Category has been added successfully.");
                redirect("admin/sub_categories/add/","refresh");
            }
        }else{
        $data['cat_id'] = $id;
        $data['description'] = $descrip;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/subcategory/admin_vw_addsubcategory',$data);
        $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function edit($id){ 
        $data=array('val'=>array(),'table'=>'sub_category','where'=>array('sub_catid'=>$id));
        $log['category']=$this->common->getdata($data);
        if(!$log['category']['res']){
            $this->session->set_flashdata("warning","This category not in category list.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/subcategory/admin_vw_editsubcategory',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function update(){ 
        $this->form_validation->set_rules('name','Sub Category Name','trim|required');
        $this->form_validation->set_rules('description','Sub Category Description','trim|required');
        $id=$this->input->post("id");
        if($this->form_validation->run()){ 
            $name=$this->input->post("name");
            $description=$this->input->post("description");
            $status=$this->input->post("status");
            $data=array('table'=>'sub_category','val'=>array('sub_category'=>$name,'sub_description'=>$description,'status'=>$status),"where"=>array("sub_catid"=>$id));                
            $log=$this->common->update_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Sub Category has been updated successfully.");
                redirect("admin/subcategories","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'sub_category','where'=>array('sub_catid'=>$id));
            $log['category']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/subcategory/admin_vw_editsubcategory',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
} 
