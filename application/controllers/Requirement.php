<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requirement extends MY_Controller {
    private $userid;
    private $currentmonth;
    private $currentyear;
    private $userpaidstatus;
    
    function __construct()
    {
        parent::__construct();
        $this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        //$this->_validForContoller();
        $this->userpaidstatus=$this->session->userdata('user_paid');
        $this->currentmonth=date('m');
        $this->currentyear=date('Y');
        
        //$this->is_buyer();
    }
    
    public function index(){
        //exit;
        if($this->session->userdata('user_type')=='2'){
            $this->_buyer_requirement();
        }else{
            $this->_seller_requirement();
        }
        
    }
    
    private function _buyer_requirement(){
        $comment1=array('val'=>'r.id,r.price,r.details,cat.category,r.req_date','table'=>'buyer_requirement as r','where'=>array("r.user_id"=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'r.cat_id=cat.id','join_type'=>''),
        );

        $table=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>";
        //print_r($table); exit;
        
        $config = array();
        $config["base_url"] = BASE_URL. "requirement";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 12;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['requirements']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/requirement/vw_buyer_requirement',$resp);
        $this->load->view('include/footer');
    }
    
    private function _seller_requirement(){
        //$date=date('Y-m-d');
        $backdate=date('Y-m-d', strtotime('-30 days'));
        //echo $backdate; exit;
        $data=array("table"=>"user_business_type","where"=>array("user_id"=>$this->userid),"val"=>array("business_id"),"orderby"=>'',"orderas"=>'',"start"=>'');
        $business_type=$this->common->get_where_all($data);
        $business_type1=array();
        if($business_type['res']){
            foreach($business_type['rows'] as $business){
                array_push($business_type1, $business->business_id);
            }
            //print_r($business_type1);
            
            $comment1=array('val'=>'r.id,r.price,r.details,cat.category,r.user_id as buyer,u.username,u.f_name,u.l_name,u.is_login as selleronline,r.req_date','table'=>'buyer_requirement as r','where'=>array("r.req_date>="=>$backdate),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC',"in"=>"r.cat_id","in_value"=>$business_type1);
            $multijoin1=array(  
                array('table'=>'category as cat','on'=>'r.cat_id=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'r.user_id=u.id','join_type'=>'left')
            );

            $table=$this->common->multijoin_with_in($comment1,$multijoin1);
            $config = array();
            $config["base_url"] = BASE_URL. "requirement";
            $config["total_rows"] = ($table['res'])?count($table['rows']):0;
            $config["per_page"] = 12;
            $config["uri_segment"] = 2;
            $this->pagination->initialize($config); 
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
            $resp['requirements']=$this->common->multijoin_with_in($comment1,$multijoin1,$config["per_page"], $page);
            $resp["links"] = $this->pagination->create_links();
            $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
            //echo "<pre>";
            //print_r($resp['requirements']);exit;
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/requirement/vw_buyer_requirement1',$resp);
            $this->load->view('include/footer');
        }
        
        
    }
    
        public function searchbycategory(){
        $backdate=date('Y-m-d', strtotime('-30 days'));
        $data=array("table"=>"user_business_type","where"=>array("user_id"=>$this->userid),"val"=>array("business_id"),"orderby"=>'',"orderas"=>'',"start"=>'');
        $business_type=$this->common->get_where_all($data);
        $business_type1=array();
        if($business_type['res']){
            foreach($business_type['rows'] as $business){
                array_push($business_type1, $business->business_id);
            }
            //print_r($business_type1);
            $likeval=$this->input->post("category");
            $comment1=array('val'=>'r.id,r.price,r.details,cat.category,r.user_id as buyer,u.username,u.f_name,u.l_name,u.is_login as selleronline,r.req_date','table'=>'buyer_requirement as r','where'=>array("r.req_date>="=>$backdate),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC',"in"=>"r.cat_id","in_value"=>$business_type1,"like"=>array("likeon"=>'r.details',"likeval"=>$likeval));
            $multijoin1=array(  
                array('table'=>'category as cat','on'=>'r.cat_id=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'r.user_id=u.id','join_type'=>'left')
            );

  
            $resp=$this->common->multijoin_with_in($comment1,$multijoin1);
            //echo $this->db->last_query();exit;
            echo json_encode($resp);
        }
    }

    public function post(){
        $this->is_buyer();
        $date=date('Y-m-d');
        $this->form_validation->set_rules('category','Category','trim|required');
        $this->form_validation->set_rules('price','Price','trim|required|numeric');
        $this->form_validation->set_rules('details','Product Details','trim|required');
            
        if($this->form_validation->run()){
            $category=$this->input->post("category");
            $price=$this->input->post("price");
            $details=$this->input->post("details");
            
            $data=array('table'=>'buyer_requirement','val'=>array('user_id'=>$this->userid,'cat_id'=>$category,'price'=>$price,'details'=>$details,'req_date'=>$date));                
            $log=$this->common->add_data($data);
            
            if($log){
                $this->session->set_flashdata("sucess","Your requirement has been posted successfully. Seller will contact you shortly.");
                redirect("requirement/post","refresh");
            }
        
        }else{
            $data=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
            $log['category']=$this->common->getdata($data);
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/requirement/vw_post_buyer_requirement',$log);
            $this->load->view('include/footer'); 
        }
    }
    
    
    public function edit($id){
        $this->is_buyer();
        $data=array("table"=>"buyer_requirement","val"=>"","where"=>array("id"=>$id,"user_id"=>$this->userid));
        $log['requirement']=$this->common->getsinglerow($data);
        
        if($log['requirement']['res']){
            $data=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
            $log['category']=$this->common->getdata($data);
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/requirement/vw_edit_buyer_requirement',$log);
            $this->load->view('include/footer');
        }else{
            $this->session->set_flashdata("warning","You are not authorized user for edit this post.");
            redirect("requirement","refresh");
        }
    }
    
    
    public function update(){
        $this->is_buyer();
        $date=date('Y-m-d');
        $this->form_validation->set_rules('category','Category','trim|required');
        $this->form_validation->set_rules('price','Price','trim|required|numeric');
        $this->form_validation->set_rules('details','Product Details','trim|required');
            $id=$this->input->post("id");
        if($this->form_validation->run()){
            $category=$this->input->post("category");
            $price=$this->input->post("price");
            $details=$this->input->post("details");
            
            $data=array('table'=>'buyer_requirement','val'=>array('cat_id'=>$category,'price'=>$price,'details'=>$details,'req_date'=>$date),"where"=>array("id"=>$id));                
            $log=$this->common->update_data($data);
            
            if($log){
                $this->session->set_flashdata("sucess","Successfully update.");
                redirect("requirement","refresh");
            }
        
        }else{
            redirect("requirement/edit/$id"); 
        }
    }
    
    
    public function delete(){
        $this->is_buyer();
        $id = $this->input->post("id");
        
        $data=array('table'=>'buyer_requirement','where'=>array('id'=>$id));
        $log=$this->common->delete_data($data);
        
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
    }
    
    
    public function details($id){
        //$this->is_buyer();
        if($this->session->userdata('user_type')=='2'){
            $this->_buyer_requirementdetail($id);
        }else{
            $this->_seller_requirementdetail($id);
        }
        
        
    }
    
    private function _buyer_requirementdetail($id){
        $comment1=array('val'=>'r.id,r.price,r.details,cat.category,r.req_date','table'=>'buyer_requirement as r','where'=>array("r.user_id"=>$this->userid,"r.id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'r.cat_id=cat.id','join_type'=>''),
        );
        $resp['requirements']=$this->common->multijoin($comment1,$multijoin1);
        
        
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/requirement/vw_detail_buyer_requirement',$resp);
            $this->load->view('include/footer');
    }
    
    private function _seller_requirementdetail($id){
        $comment1=array('val'=>'r.id,r.price,r.details,cat.category,r.req_date','table'=>'buyer_requirement as r','where'=>array("r.id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'r.cat_id=cat.id','join_type'=>''),
        );
        $resp['requirements']=$this->common->multijoin($comment1,$multijoin1);
        
        
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/requirement/vw_detail_buyer_requirement',$resp);
            $this->load->view('include/footer');
    }
    
}    
