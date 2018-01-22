<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'s.*','table'=>'social_link as s','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
        $multijoin1=array();
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/social";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['categorylist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query();exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/social/admin_vw_social',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function add(){ 
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('url','Link','trim|required');
        if($this->form_validation->run()){
            $title=$this->input->post("title");
            $url=$this->input->post("url");
            $status=$this->input->post("status");
            if(isset($_FILES['file']['name'])){
                $userfile='file';
                $image_path='assets/image/social/';
                $allowed='jpg|png|jpeg';
                $max_size='1024';
                $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"50","width"=>"50","ratio"=>true));
            }else{$fileupload=array('status'=>1,'filename'=>''); } $prodImage=$fileupload['filename'];
            $data=array('table'=>'social_link','val'=>array('title'=>$title,'url'=>$url,'status'=>$status,'image'=>$prodImage));                
            $log=$this->common->add_data($data);
            if($log){ $this->session->set_flashdata("sucess","Social link has been added successfully."); redirect("admin/social/add/","refresh"); }
        }else{
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/social/admin_vw_addsocial');
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    
    public function edit($id){
        $data=array('val'=>array(),'table'=>'social_link','where'=>array('id'=>$id));
        $log['category']=$this->common->getdata($data);
        if(!$log['category']['res']){
            $this->session->set_flashdata("warning","Invalid try.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/social/admin_vw_editsocial',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function update(){
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('url','Link','trim|required');
        $id=$this->input->post("id");
        if($this->form_validation->run()){
            $title=$this->input->post("title");
            $url=$this->input->post("url");
            $status=$this->input->post("status");
            if($_FILES['file']['name']!=""){
                $proddata=array("table"=>"social_link","where"=>array("id"=>$id),"val"=> array("image"));
                $product=$this->common->getsinglerow($proddata);
                    $path="assets/image/social/".$product['rows']->image;
                    if(!is_dir($path)){unlink($path);}
                $userfile='file';
                $image_path='assets/image/social/';
                $allowed='jpg|png|jpeg';
                $max_size='1024';
                $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"50","width"=>"50","ratio"=>true));
                $prodImage=$fileupload['filename'];
                $data=array('table'=>'social_link','where'=>array('id'=>$id),'val'=>array('title'=>$title,'url'=>$url,'status'=>$status,'image'=>$prodImage));                
            }else{
                $data=array('table'=>'social_link','where'=>array('id'=>$id),'val'=>array('title'=>$title,'url'=>$url,'status'=>$status));                
            } 
            
            $log=$this->common->update_data($data);
            if($log){ $this->session->set_flashdata("sucess","Social link has been updated successfully."); redirect("admin/social","refresh"); }
        }else{
            $data=array('val'=>array(),'table'=>'social_link','where'=>array('id'=>$id));
            $log['category']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/forum/admin_vw_editcategory',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"social_link","val"=>array("status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Social link(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"social_link","val"=>array("status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Social link(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function delete(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"social_link","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Social link(s) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
} 
