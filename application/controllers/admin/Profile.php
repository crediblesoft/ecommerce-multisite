<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->_screen_security_admin('Change Password');
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    public function index(){
        
    }
    
    public function changepassword(){
        $this->form_validation->set_rules('oldpassword','Old Password','trim|required');
        $this->form_validation->set_rules('newpassword','New Password','trim|required|matches[confirmpassword]');
        $this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required');
        if($this->form_validation->run()){
            $oldpassword= $this->input->post('oldpassword');
            $newpassword= $this->input->post('newpassword');
            $confirmpassword= $this->input->post('confirmpassword');
            $data= array('table'=>'admin','where'=>array('id'=>$this->userid,'password'=>md5($oldpassword)));
            $log = $this->common->getNofrows($data);
            if($log == 1){
                $data=array('val'=>array('password'=>md5($newpassword),'password2'=>$newpassword),'table'=>'admin', 'where'=>array('id'=>$this->userid));
                $log= $this->common->update_data($data);
                if($log){
                    $this->session->set_flashdata('sucess','Password changed successfully.');
                    redirect('admin/profile/changepassword/','refresh');
                }
            }else{
                $this->session->set_flashdata('warning','Old password does not correct.');
                redirect('admin/profile/changepassword/','refresh');
            }   
            
        }
        
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/profile/admin_vw_changepassword');
        $this->load->view('admin/include/admin_footer');
    }
    
    public function viewprofile(){
		
        $data= array('table'=>'admin','val'=>'*','where'=>array('id'=>$this->userid),'orderby'=>'','orderas'=>'','start'=>'','limit'=>'');
        //$log['profiledata']= $this->common->get_data($data);
		$log['profiledata']= $this->common->get_where($data);
		//print_r($log);exit;
      
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/profile/admin_vw_profile',$log);
        $this->load->view('admin/include/admin_footer'); 
    }
    
     public function editProfile(){
		 
        $this->form_validation->set_rules('user','User Name', 'trim|required');
        $this->form_validation->set_rules('firstname','First Name', 'trim|required');
        $this->form_validation->set_rules('lastname','Last Name', 'trim|required');
        $this->form_validation->set_rules('email','Email', 'trim|required');
        if($this->form_validation->run()){
            $userName=$this->input->post('user');
            $firstName= $this->input->post('firstname');
            $lastName= $this->input->post('lastname');
            $emailID= $this->input->post('email');
            
        if($_FILES['file']['name']!=""){
            $proddata=array("table"=>"admin","where"=>array('id'=>$this->userid),"val"=> array("admin_image"));
            $product=$this->common->getsinglerow($proddata);
            if($product['rows']->admin_image!='nophoto.png'){
                $path="assets/image/user/".$product['rows']->admin_image;
                if(file_exists($path)){unlink($path);}
                $path="assets/image/user/thumb/".$product['rows']->admin_image;
                if(file_exists($path)){unlink($path);}
            }
            $userfile='file';
            $image_path='assets/image/user/';
            $allowed='jpg|png|jpeg';
            $max_size='4096000';

            $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"90","width"=>"90","ratio"=>true));
            $prodImage=$fileupload['filename'];
            $data=array('table'=>'admin','where'=>array('id'=>$this->userid),'val'=>array('username'=>$userName,'first_name'=>$firstName,'last_name'=>$lastName,'email_id'=>$emailID,'admin_image'=>$prodImage));                
        }else{
            $data=array('table'=>'admin','where'=>array('id'=>$this->userid),'val'=>array('username'=>$userName,'first_name'=>$firstName,'last_name'=>$lastName,'email_id'=>$emailID));                
        }    
           $log=$this->common->update_data($data);
           if($log){
                $this->session->set_flashdata("sucess","Profile updated successfully.");
                redirect("admin/profile/viewprofile","refresh");
            }
         
         }else{
             $data= array('table'=>'admin','val'=>'*','where'=>array('id'=>$this->userid),'orderby'=>'','orderas'=>'','start'=>'','limit'=>'');
        //$log['profiledata']= $this->common->get_data($data);
		$log['profiledata']= $this->common->get_where($data);
       // print_r($log);
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/profile/admin_vw_editProfile',$log);
        $this->load->view('admin/include/admin_footer'); 
         }
         
        
    }
    
}
