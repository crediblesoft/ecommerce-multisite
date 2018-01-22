<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subadmin extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->_screen_security_admin('');
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'a.*,r.id as role_id,r.role_name,r.role_description','table'=>'admin as a','where'=>array('a.admin_type'=>'2'),'minvalue'=>'','group_by'=>'a.id','start'=>'','orderby'=>'a.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'security_roles as r','on'=>'a.role_id=r.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/subadmin/";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        //$config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['promotion']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
		//echo $this->db->last_query();
        //print_r($resp['promotion']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/subadmin/admin_vw_subadmin',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function add(){
        $this->form_validation->set_rules('uname','Username', 'trim|required|is_unique[admin.username]');
        $this->form_validation->set_rules('fname','First name','trim|required');
        $this->form_validation->set_rules('lname','Last name','trim|required');
        $this->form_validation->set_rules('security_role','Security role','trim|required');
        $this->form_validation->set_rules('email','Email id','trim|required|is_unique[admin.email_id]');
		$this->form_validation->set_rules('password','Password','trim|required');
        if($this->form_validation->run()){
            $uname=$this->input->post("uname");
            $fname=$this->input->post("fname");
            $lname=$this->input->post("lname");
            $security_role=$this->input->post("security_role");
            $email=$this->input->post("email");
			$password=$this->input->post("password");
            $status=$this->input->post("status");
            
			$image='admin_default.png';
            
            $data=array('table'=>'admin','val'=>array('username'=>$uname,'email_id'=>$email,'password'=>md5($password),'password2'=>$password,'first_name'=>$fname,'last_name'=>$lname,'status'=>$status,'admin_image'=>$image,'role_id'=>$security_role));                
            $promoid=$this->common->add_data_get_id($data);
           
            if($promoid){
                $this->session->set_flashdata("sucess","Subadmin has been added successfully.");
                redirect("admin/subadmin/add/","refresh");
            }
        }
		else{
            $data=array('val'=>array(),'table'=>'security_roles','where'=>array('status'=>'Active'));
            $log['roles']=$this->common->getdata($data);
 
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/subadmin/admin_vw_add_subadmin',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    
    public function edit($id){
        $this->form_validation->set_rules('uname','Username', 'trim|required');
        $this->form_validation->set_rules('fname','First name','trim|required');
        $this->form_validation->set_rules('lname','Last name','trim|required');
        $this->form_validation->set_rules('email','Email id','trim|required');
        $this->form_validation->set_rules('security_role','Security role','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
        if($this->form_validation->run()){
            $uname=$this->input->post("uname");
            $fname=$this->input->post("fname");
            $lname=$this->input->post("lname");
            $security_role=$this->input->post("security_role");
            $email=$this->input->post("email");
			$password=$this->input->post("password");
            $status=$this->input->post("status");
           
		    
		   
            $data=array('table'=>'admin','where'=>array('id'=>$id),'val'=>array('username'=>$uname,'email_id'=>$email,'password'=>md5($password),'password2'=>$password,'first_name'=>$fname,'last_name'=>$lname,'status'=>$status,'role_id'=>$security_role));                
            $log=$this->common->update_data($data);
            $promoid=$id;
           
            if($promoid){
                $this->session->set_flashdata("sucess","Subadmin has been updated successfully.");
                redirect("admin/subadmin/","refresh");
            }
            
        }else{
        //    $data=array('val'=>array(),'table'=>'admin','where'=>array('id'=>$id));
        //    $log['promotion']=$this->common->getdata($data);
        $data=array('val'=>'a.*,r.id as role_id,r.role_name,r.role_description','table'=>'admin as a','where'=>array('a.id'=>$id));
        $multijoin1=array(
            array('table'=>'security_roles as r','on'=>'a.role_id=r.id','join_type'=>'left'),
        );
        $log['promotion']=$this->common->multijoin($data,$multijoin1);

            if($log['promotion']['res']){
            $data=array('val'=>array('user_id'),'table'=>'promo_users','where'=>array('promo_id'=>$id));
            $log['assignusers']=$this->common->getdata($data);

            $log['allusers']=$this->getsellers(array('username','id'),array('type_Of_User'=>'1','status'=>'1'));

            $data=array('val'=>array(),'table'=>'security_roles','where'=>array('status'=>'Active'));
            $log['roles']=$this->common->getdata($data);

            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/subadmin/admin_vw_edit_subadmin',$log);
            $this->load->view('admin/include/admin_footer');
            }else{
                $this->session->set_flashdata("warning","Something wend worng pleas try again.");
                redirect("admin/subadmin/","refresh");
            }
        }
    }
    
    
    public function details($id){
       //$data=array('val'=>array(),'table'=>'admin','where'=>array('id'=>$id));
        $data=array('val'=>'a.*,r.id as role_id,r.role_name,r.role_description','table'=>'admin as a','where'=>array('a.id'=>$id));
        $multijoin1=array(
            array('table'=>'security_roles as r','on'=>'a.role_id=r.id','join_type'=>'left'),
        );
        //$log['promotion']=$this->common->getdata($data);
        $log['promotion']=$this->common->multijoin($data,$multijoin1);
        if($log['promotion']['res']){
        //$data=array('val'=>array('user_id'),'table'=>'promo_users','where'=>array());
        $this->db->select('u.username,u.id');$this->db->where('promo_id',$id);
        $this->db->join('user_Info u','u.id=pu.user_id','left');
        $query=$this->db->get('promo_users pu');
       if($query -> num_rows() > 0)
            {$log['assignusers']=array('res'=>true,'rows'=>$query->result());}
            else
            {$log['assignusers']=array('res'=>false);}
       // $log['assignusers']=$this->common->getdata($data);

        //$log['allusers']=$this->getsellers(array('username','id'),array('type_Of_User'=>'1','status'=>'1'));

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/subadmin/admin_vw_details_subadmin',$log);
        $this->load->view('admin/include/admin_footer');
        }else{
            $this->session->set_flashdata("warning","Something wend worng pleas try again.");
            redirect("admin/promotion/","refresh");
        }
    }
    
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"admin","val"=>array("status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();exit;
        if($log){
            echo json_encode(array("status"=>true,"message"=>"This Subadmin added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"admin","val"=>array("status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"This Subadmin  removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

    private function _sendmail($to,$message){
        $from='0';
        $subject="Promotion Code";

        //$this->getuserid($to[0]);
        $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
        $inserted_id=$this->common->add_data_get_id($maildata);

        if($inserted_id){
             $mailtodata=array("table"=>'mail_to',"val"=>array("mail_from"=>$inserted_id,"mail_to"=>$to));
             $log = $this->common->add_data($mailtodata);
        }
        if($log){
            return TRUE;
        }else{
            return FALSE;
        }
            
    
    }
    
    
    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    
    
} 
