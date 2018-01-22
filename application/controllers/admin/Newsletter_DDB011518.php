<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'','table'=>'newsletter','where'=>array(),'minvalue'=>'','group_by'=>'id','start'=>'','orderby'=>'id','orderas'=>'DESC');
        $multijoin1=array();
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/newsletter";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['newsletters']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query();exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/newsletter/admin_vw_newsletter',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function deletecat(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"newsletter","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Email(s) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function send(){
        
        if(isset($_FILES['file']['name'])){
            $userfile='file';
            $image_path='assets/image/newsletter/';
            $allowed='jpg|png|jpeg';
            $max_size='4096000';
            $fileupload=$this->functions->_upload_image($userfile,$image_path,$allowed,$max_size);
            if($fileupload['status']){$filename=$fileupload['filename'];}else{
                $this->session->set_flashdata("warning",$fileupload['error']);
                redirect('admin/newsletter',"refresh");
            }
            }else{
                $this->session->set_flashdata("warning","Please attach file to send newsletter.");
                redirect('admin/newsletter',"refresh");
            }
            
         $this->form_validation->set_rules('id[]','Select email','trim|required');
         if($this->form_validation->run()){
         $this->db->select("email"); $this->db->from("newsletter"); $this->db->where_in("id",$this->input->post("id"));
         $query=$this->db->get(); $emails=array();
         foreach($query->result() as $email){  array_push($emails, $email->email); }
         $allemail=implode(',',$emails);
         $message="Harvest Newsletter";

            $email1=array('from'=>'test@ucodice.com','to'=>$allemail,'subject'=>'Harvest Newsletter','message'=>$message,'file_path'=>$image_path,'filename'=>$filename);
            $sendmail=$this->functions->_email_attach($email1);
            if($sendmail){
                $this->session->set_flashdata("sucess","Send newsletter successfully.");
                redirect('admin/newsletter',"refresh");
            }else{
                $this->session->set_flashdata("warning","We are getting email error.");
                redirect('admin/newsletter',"refresh");
            }
         }else{
             $this->session->set_flashdata("warning","Please select at least one email to send newsletter.");
             redirect('admin/newsletter',"refresh");
         }
    }
    
} 
