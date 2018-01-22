<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message1 extends MY_Controller {
    private $userid;
    private $currentmonth;
    private $currentyear;
    private $userpaidstatus;
    
    function __construct()
    {
        parent::__construct();
         if(!is_numeric($this->uri->segment(2))){
            $this->functions->_valid_user();
            $this->functions->_afterloginpage_delete();
        }
        //$this->functions->_valid_user();
        //$this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        $this->userpaidstatus=$this->session->userdata('user_paid'); 
    }
    
    public function index(){
        $data['me'] = $this->userid;
        $data['userNameshow']=$this->session->userdata('user_name');
        
        $data['users']=$this->getonlineuser();
        
        $this->load->view('include/header');
        $this->load->view('userlogin/message/chatty', $data);
        $this->load->view('include/footer');
        
    }
    
    public function getonlineuser(){
        $this->db->select('b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login,us.business_name,b.type_Of_User,b.username',FALSE);
            $this->db->join('user_store_info us','b.id=us.user_id','left');
            $this->db->where('b.id!=', $this->userid);
            $this->db->where('b.is_login', "1");
            $this->db->order_by('b.login_time', "DESC");
            //$this->db->from('user_Info as b');
            //$this->db->order_by('is_login', 'ASC');
            $userquery=$this->db->get('user_Info as b');
            return $pagedata['users']=$userquery->result();
           //echo "<pre>";
            /*$array=array();
            $i=0;
            foreach($pagedata['users'] as $users){
                $this->db->select('c.status,c.msgfrom',FALSE);
                $this->db->where('c.msgfrom', $users->id);
                $this->db->order_by('id', 'DESC');
                $this -> db -> limit(1);
                $userquery=$this->db->get('conservation as c');
                $conv= $userquery->result();
                if(count($conv)>0){
                    $pagedata['users'][$i]->status=$conv[0]->status;
                }else{
                    $pagedata['users'][$i]->status=1;
                }
                //(array)$pagedata['users'][$i];
                array_push($array,$pagedata['users'][$i]);
                $i++;
            }


                function cmp($a, $b) {
                        return $a->status - $b->status;
                }
                usort($array, "cmp");
                $pagedata['users']=$array;*/
    }
    
    
    public function get_online_user()
    {
        
        /*$sql="SELECT DISTINCT msgfrom FROM conservation WHERE msgfor='".$this->userid."' AND status='0'";
        $query=$this->db->query($sql);
        $senderresult=$query->result_array();
        $alluserid=array();
        foreach($senderresult as $subdata){
            array_push($alluserid,$subdata['msgfrom']);
        }
        
        if(count($alluserid)>0){
        $this->db->select('count(c.id) as noofmsg,b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login',FALSE);
        $this->db->join('conservation c','b.id=c.msgfrom','left');
        $this->db->where('c.msgfor', $this->userid);
        $this->db->where('c.status', '0');
        $this->db->where('b.is_login', "0");
        $this->db->where_in('b.id', $alluserid);
        $this->db->group_by('b.id');
        $this->db->order_by('b.login_time', "DESC");
        $userquery1=$this->db->get('user_Info as b');
        $offlineuser=$userquery1->result();
        }else{
            $offlineuser=array();
        }*/
        
        $offlineuser=array();
        //$this->db->select('b.id as id,b.is_login',FALSE);
        $this->db->select('b.id as id,b.f_name as first_name,b.l_name as last_name,b.username,b.profile_Pic,b.is_login',FALSE);
        //$this->db->join('conservation c','b.id=c.msgfor','left');
        $this->db->where('b.id!=', $this->userid);
        $this->db->where('b.is_login', "1");
        $this->db->order_by('b.login_time', "DESC");
        //$this->db->order_by('ISNULL(c.status)');
        //$this->db->order_by('c.status', 'ASC');
	//$this->db->order_by('c.senddate', 'DESC');
        $this->db->group_by('b.id');
        $userquery=$this->db->get('user_Info as b');
        $online_users=$userquery->result();
        //print_r($online_users);exit;
        $totaluser=count($online_users)+count($offlineuser);
        if($totaluser>0){
            echo json_encode(array("status"=>true,"data"=>array("online_users"=>$online_users,"offline_users"=>$offlineuser)));
        }else{
            echo json_encode(array("status"=>false,"data"=>"User not found"));
        }
    }
    
    public function get_all_count()
    {
        $currenttime= date('Y-m-d H:i:s');
        $userid=$this->session->userdata('user_id');
        $this->db->where(array("id"=>$userid));
        $this->db->update("user_Info", array("is_login"=>"1","active_time"=>$currenttime));
        //echo $this->db->last_query();exit;
        $where=['msgfor'=>$userid,'status'=>'0'];
        $this->db->where($where);
        $getcount=$this->db->count_all_results('conservation');
        if($getcount > 0)
        {
            echo json_encode(['status'=>TRUE,'message'=>$getcount.' new message arrived.','msgcnt'=>$getcount]);
        }
        else
        {
            echo json_encode(['status'=>FALSE,'message'=>$getcount.' new message arrived.','msgcnt'=>$getcount]);
        }
    }
    
    
    
   
}