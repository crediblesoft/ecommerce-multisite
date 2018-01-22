<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    public function index(){
        $comment1=array('val'=>'s.*,c.category as default_category','table'=>'settings as s','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'category as c','on'=>'s.default_category=c.id','join_type'=>''),
        );
        $log['settings']=$this->common->multijoin($comment1,$multijoin1);
        
//        $data=array("table"=>"settings","val"=>array(),"where"=>array());
//        $log['settings']=$this->common->getdata($data);
        
        $data1=array("table"=>"user_validation","val"=>array(),"where"=>array());
        $log['userlimitation']=$this->common->getdata($data1);
        
        $data2=array("table"=>"theme_price","val"=>array('price'),"where"=>array('price_for'=>'seller'));
        $log['forpremimu']=$this->common->getdata($data2);
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/settings/admin_vw_settings',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function edit(){
        $data=array("table"=>"settings","val"=>array(),"where"=>array());
        $log['settings']=$this->common->getdata($data);
        
        $data1=array("table"=>"user_validation","val"=>array(),"where"=>array());
        $log['userlimitation']=$this->common->getdata($data1);
        
        $data2=array("table"=>"theme_price","val"=>array('price','id'),"where"=>array('price_for'=>'seller'));
        $log['forpremimu']=$this->common->getdata($data2);
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/settings/admin_vw_editsetting',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function update(){
        $this->form_validation->set_rules('product_list','Product Listing','trim|required');
        $this->form_validation->set_rules('send_email','Send Email','trim|required');
        $this->form_validation->set_rules('send_message','Send Message','trim|required');
        $this->form_validation->set_rules('media','Upload Media/Video','trim|required');
        $this->form_validation->set_rules('price','Paid Amount','trim|required');
        if($this->form_validation->run()){
            $id=$this->input->post("id");
            $premium_id=$this->input->post("premium_id");
            $userlimit_id=$this->input->post("userlimit_id");
            
            $product_list=$this->input->post("product_list");
            $send_email=$this->input->post("send_email");
            $send_message=$this->input->post("send_message");
            $media=$this->input->post("media");
            $price=$this->input->post("price");
            
            $default_category=$this->input->post("default_category");
            $forum_post=$this->input->post("forum_post");
            $user_status=$this->input->post("user_status");
            $product_status=$this->input->post("product_status");
            $admin_comm=$this->input->post("admin_comm");
            if($_FILES['file']['name']!=""){
                $proddata=array("table"=>"settings","where"=>array("id"=>$id),"val"=> array("default_image"));
                $user=$this->common->getsinglerow($proddata);
                if($user['rows']->default_image!="nophoto.png"){
                    $path="assets/image/user/".$user['rows']->default_image;
                    if(file_exists($path)){
                    unlink($path);}
                    $path="assets/image/user/thumb/".$user['rows']->default_image;
                    if(file_exists($path)){
                    unlink($path);}
                }
                $userfile='file';
                $image_path='assets/image/user/';
                $allowed='jpg|png|jpeg';
                $max_size='4096000';
                $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"120","width"=>"120","ratio"=>true));
                $prodImage=$fileupload['filename'];
                $data=array('table'=>'settings','where'=>array('id'=>$id),'val'=>array('default_category'=>$default_category,'forum_post'=>$forum_post,'user_status'=>$user_status,'product_status'=>$product_status,'commission'=>$admin_comm,'default_image'=>$prodImage));                
            }else{
                $data=array('table'=>'settings','where'=>array('id'=>$id),'val'=>array('default_category'=>$default_category,'forum_post'=>$forum_post,'user_status'=>$user_status,'product_status'=>$product_status,'commission'=>$admin_comm));                
            } 

            $log=$this->common->update_data($data);
            
            $data1=array('table'=>'user_validation','where'=>array('id'=>$userlimit_id),'val'=>array('email'=>$send_email,'message'=>$send_message,'product_list'=>$product_list,'media'=>$media));
            $log1=$this->common->update_data($data1);
            
            $data2=array('table'=>'theme_price','where'=>array('id'=>$premium_id),'val'=>array('price'=>$price));
            $log2=$this->common->update_data($data2);
            
            if($log && $log1 && $log2){ $this->session->set_flashdata("sucess","Settings updated successfully."); redirect("admin/settings","refresh"); }
        }else{
            $comment1=array('val'=>'s.*,c.category as default_category','table'=>'settings as s','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'category as c','on'=>'s.default_category=c.id','join_type'=>''),
            );
            $log['settings']=$this->common->multijoin($comment1,$multijoin1);

            $data1=array("table"=>"user_validation","val"=>array(),"where"=>array());
            $log['userlimitation']=$this->common->getdata($data1);

            $data2=array("table"=>"theme_price","val"=>array('price','id'),"where"=>array('price_for'=>'seller'));
            $log['forpremimu']=$this->common->getdata($data2);

            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/settings/admin_vw_editsetting',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
}    