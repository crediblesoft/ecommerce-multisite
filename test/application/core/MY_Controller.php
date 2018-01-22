<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $commondata;
    function __construct()
    {
        parent::__construct();
        $compare=$this->compare_products();
        $category=$this->getcategory();
        $inbox=$this->getinboxnotification();
        
        $this->commondata['category']=$category;
        $this->commondata['inbox']=$inbox;
        $this->commondata['compare']=$compare;
        $this->load->helper('cookie');
    }
    
    public function getcategory($catid=NULL){
        if($catid==NULL){
            $data=array("table"=>"category","val"=>array(),"where"=>array("status"=>"active"));
            return $log=$this->common->getdata($data);
        }else{
            $data=array("table"=>"category","val"=>array("category"),"where"=>array("id"=>$catid));
            return $log=$this->common->getdata($data);
        }
    }
    
    public function getuserid($username){
        $data=array("table"=>"user_Info","val"=>"id","where"=>array("username"=>$username));
        $log=$this->common->getsinglerow($data);
        //print_r($log);exit;
        if($log['res']){
            return $log['rows']->id;
        }
    }

	public function getusername($userid){
        $data=array("table"=>"user_Info","val"=>"username","where"=>array("id"=>$userid));
        $log=$this->common->getsinglerow($data);
        //print_r($log);exit;
        if($log['res']){
            return $log['rows']->username;
        }
    }
    
    public function _checkvalid($page){
         if(!$this->session->has_userdata('user_id')){
            $this->session->set_userdata("afterloginpage",$page);
            $this->session->set_flashdata("warning","Please Login first for this");
            redirect("auth/login");
    }
    }
    
    public function invalid_user(){
        $this->session->set_flashdata("warning","You are no authorized for this");
        redirect("profile","refresh");
    }
    
    public function invalid_usertype(){
        $this->session->set_flashdata("warning","You are no authorized for this");
        redirect("profile","refresh");
    }
    
    public function getinboxnotification(){
        if($this->session->has_userdata("user_id")){
            $data=array("table"=>"mail_to","val"=>"count(id) as inbox","where"=>array("mail_to"=>$this->session->userdata("user_id"),"view"=>"0","status"=>"1"));
            $log=$this->common->getsinglerow($data);
            //print_r($log);exit;
            if($log['res']){
                return $log['rows']->inbox;
            }
        }
    }
    
    
    public function _userlimitation($title=null,$userpaidstatus=null,$table=null,$where=array(),$redirectpage){
        
            $data=array("table"=>"user_validation","val"=>"$title as title","where"=>array("user_type"=>"$userpaidstatus"));
            
            $log=$this->common->getsinglerow($data);
            //print_r($this->db->last_query());exit;
            if($log['res']){
                
                $newdata=array("table"=>$table,"where"=>$where);
                $newlog=$this->common->record_count_where($newdata);
                if(!empty($_FILES['file'])){
                    //print_r(count($_FILES['file']['name']));exit;
                    $newlog+=count($_FILES['file']['name'])-1; 
                }
                //echo $newlog;exit;
                if($log['rows']->title > $newlog){
                    return array("status"=>true,"message"=>"");
                }else{
                    $count=$log['rows']->title;
                    $this->session->set_flashdata("warning","you have only $count $title limitation for more <a href=''> click here</a>");
                    redirect($redirectpage,"refresh");
                }
                //EXIT;
            }else{
                return array("status"=>true,"message"=>"no any limitation");
            }
            
       
    }


	public function set_cookie($data){
        $this->input->set_cookie($data);
    }
    
    public function get_cookie($name){
        return $this->input->cookie($name,true);
    }

	public function is_buyer($msg='you have to login as buyer for this'){
        if($this->session->userdata("user_type")==2){
            return true;
        }else{
            $this->session->set_flashdata("warning",$msg);
            redirect("profile","refresh");
        }
    }
    
    public function is_seller($msg='you have to login as seller for this'){
        if($this->session->userdata("user_type")==1){
            return true;
        }else{
            $this->session->set_flashdata("warning",$msg);
            redirect("profile","refresh");
        }
    }

	/*****************OCT 5 2015 ****************************/
    
    public function compare_products(){
        if($this->session->has_userdata("compare")){
            $product1=implode(",",$this->session->userdata("compare"));
            //print_r($this->session->userdata("compare"));
            $sql = "SELECT * FROM product WHERE id IN ($product1)";
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0)
            {
                $result=array('res'=>true,'rows'=>$query->result(),'count'=>$query->num_rows());
                return $result;
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
            
        }
    }
    
}    
