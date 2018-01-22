<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {
    private $userid;
    private $currentmonth;
    private $currentyear;
    private $userpaidstatus;
    
    function __construct()
    {
        parent::__construct(); 
        //print_r(is_numeric($this->uri->segment(2)));exit;
         if(!is_numeric($this->uri->segment(2))){
            $this->functions->_valid_user();
            $this->functions->_afterloginpage_delete();
        }
        //$this->functions->_valid_user();
        //$this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        $this->userpaidstatus=$this->session->userdata('user_paid');

        
        
    }
    
    /* public function create($id){
            $destination = "assets/message/".$this->userid."_".$id;
            if(!is_dir($destination))
            {
                $old_umask = umask(0);
                mkdir($destination,0777);
                umask($old_umask);
                return true;
            }else{
                return true;
            }
    }
    
    
    public function send(){
        $recv_id=$this->input->post("recv_id");
        $message=$this->input->post("message");
        //echo $message;
        $this->load->helper('file');

        $data = "<p>".$recv_id.":".$message."</p>";
            if ( ! write_file("assets/message/".$this->userid."_".$recv_id."/file.txt", $data."\r\n",'a'))
            {
                    //echo 'Unable to write the file';
            }
            else
            {
                    echo readfile("assets/message/".$this->userid."_".$recv_id."/file.txt");
            }
    }
    
    
    public function getmessage($recv_id){
        echo readfile("assets/message/".$this->userid."_".$recv_id."/file.txt");
    }*/
    
/*public function index()
    { //echo "dd";exit;
    
        if($this->uri->segment(2)!=''){
            $data=array("table"=>"user_Info","val"=>"id","where"=>array("id"=>$this->uri->segment(2)));
            $log=$this->common->getsinglerow($data);
            if(!$log['res']){
                redirect("_404","refresh");
            }
        }
        
        $userid=$this->userid;
        $sql="SELECT DISTINCT msgfrom FROM conservation WHERE msgfor='".$userid."'";
        $query=$this->db->query($sql);
        $senderresult=$query->result_array();
        $sql="SELECT DISTINCT msgfor FROM conservation WHERE msgfrom='".$userid."'";
        $query=$this->db->query($sql);
        $receiverresult=$query->result_array();
        $alluserid=[];
        $i=0;
        foreach($senderresult as $subdata)
        {
            $alluserid[$i]=$subdata['msgfrom'];
            $i++;
        }
        foreach($receiverresult as $subdata2)
        {
            $alluserid[$i]=$subdata2['msgfor'];
            $i++;
        }
            $this->db->select('b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login,c.status',FALSE);
            $this->db->join('conservation c','b.id=c.msgfrom','left');
            $this->db->where('b.id!=', $this->userid);
//$this->db->where('c.status', '0');
            $this->db->order_by('ISNULL(c.status)'); // get null data in last when use ASC
            $this->db->order_by('c.status', 'ASC');
	    //$this->db->order_by('c.senddate', 'DESC');
            $this->db->group_by('b.id');
            $userquery=$this->db->get('user_Info as b');
            $pagedata['users']=$userquery->result();
            //echo $this->db->last_query();
            $pagedata['activetab']=$this->uri->segment(2);
        $this->load->view('include/header');
        $this->load->view('userlogin/message/vw_userlist',$pagedata);
        $this->load->view('include/footer');
    }*/

public function index()
    { 
        $pagedata['currentusername']='';
        if($this->uri->segment(2)!=''){
            $data=array("table"=>"user_Info","val"=>"id,f_name,l_name","where"=>array("id"=>$this->uri->segment(2)));
            $log=$this->common->getsinglerow($data);
            $this->_checkvalid("message/".$this->uri->segment(2));
            if(!$log['res']){
                redirect("_404","refresh");
            }else{
                //print_r($log);exit;
                $pagedata['currentusername']=$log['rows']->f_name.' '.$log['rows']->l_name;
                $this->session->set_userdata("chatwith",$this->uri->segment(2));
            }
        }
    //echo $this->session->userdata("chatwith");
        $userid=$this->userid;
//        $sql="SELECT DISTINCT msgfrom FROM conservation WHERE msgfor='".$userid."'";
//        $query=$this->db->query($sql);
//        $senderresult=$query->result_array();
//        $sql="SELECT DISTINCT msgfor FROM conservation WHERE msgfrom='".$userid."'";
//        $query=$this->db->query($sql);
//        $receiverresult=$query->result_array();
//        $alluserid=[];
//        $i=0;
//        foreach($senderresult as $subdata)
//        {
//            $alluserid[$i]=$subdata['msgfrom'];
//            $i++;
//        }
//        foreach($receiverresult as $subdata2)
//        {
//            $alluserid[$i]=$subdata2['msgfor'];
//            $i++;
//        }
        
        
        $sql="SELECT DISTINCT msgfrom FROM conservation WHERE msgfor='".$userid."' AND status='0'";
        $query=$this->db->query($sql);
        $senderresult=$query->result_array();
        $alluserid=array();
        foreach($senderresult as $subdata){
            array_push($alluserid,$subdata['msgfrom']);
        }
        
        //print_r($alluserid);
        if(count($alluserid)>0){
        $this->db->select('count(c.id) as noofmsg, b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login',FALSE);
        $this->db->join('conservation c','b.id=c.msgfrom','left');
        $this->db->where('c.msgfor', $this->userid);
        $this->db->where('c.status','0');
        $this->db->where('b.is_login', "0");
        //$ur=implode(",",$alluserid);
        $this->db->where_in('b.id', $alluserid);
        $this->db->group_by('b.id');
        $this->db->order_by('b.login_time', "DESC");
        $userquery1=$this->db->get('user_Info as b');
        $pagedata['offlineusers']=$userquery1->result();
        }else{
            $pagedata['offlineusers']=array();
        }
        //echo "<pre>";
        //echo $this->db->last_query();
        //print_r($pagedata);exit;
//            $this->db->select('b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login,c.status',FALSE);
//            $this->db->join('conservation c','b.id=c.msgfrom','left');
//            $this->db->where('b.id!=', $this->userid);
//            //$this->db->where('c.status', '0');
//            $this->db->order_by('c.senddate', 'DESC');
//            $this->db->order_by('ISNULL(c.status)');
//            $this->db->order_by('c.status', 'ASC');
//            //$this->db->order_by('c.senddate', 'ASC');
//            $this->db->group_by('b.id');
//            $userquery=$this->db->get('user_Info as b');
//            $pagedata['users']=$userquery->result();
        
        
        
            $this->db->select('b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login',FALSE);
            $this->db->where('b.id!=', $this->userid);
            $this->db->where('b.is_login', "1");
            $this->db->order_by('b.login_time', "DESC");
            //$this->db->from('user_Info as b');
            //$this->db->order_by('is_login', 'ASC');
            $userquery=$this->db->get('user_Info as b');
            $pagedata['users']=$userquery->result();
           // echo "<pre>";
            $array=array();
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
                $pagedata['users']=$array;
                //print_r($pagedata);
            
            //exit;
            //echo $this->db->last_query();
            $pagedata['activetab']=$this->uri->segment(2);
        $this->load->view('include/header');
        $this->load->view('userlogin/message/vw_userlist',$pagedata);
        $this->load->view('include/footer');
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
    private function _get_conv_user()
    {
        $userid=$this->session->userdata('user_id');
        $this->db->select('DISTINCT msgfrom as id',FALSE);
        $this->db->where('msgfor', $userid);
        $userquery=$this->db->get('conservation');
        return $userquery->result();
    }
    
    
    public function get_usermsg_count()
    {
        $data=[];
        $cruserid=$this->session->userdata('user_id');
        $userid=$this->_get_conv_user();
        foreach($userid as $user)
        {
            $getcount='';
            $where=['msgfor'=>$cruserid,'status'=>'0','msgfrom'=>$user->id];
            $this->db->where($where);
            $getcount=$this->db->count_all_results('conservation');
            $data[$user->id]=$getcount;
        }
        
        echo json_encode(['status'=>TRUE,'data'=>$data]);
    }
    
    public function get_currentclicked_message(){
        $userid=$this->input->post('user');
        $this->session->set_userdata("chatwith",$userid);
        $this->get_message();
    }


    public function get_message()
    {  //echo "heee_".$this->session->userdata("chatwith");exit;
        //$this->form_validation->set_rules('user','User','trim|required');
//        $this->form_validation->set_message('required','%s not identify. Please reload page.');
//        if($this->form_validation->run())
//        {
            $crtime=date('Y-m-d H:i:s');
            //$getid=$this->input->post('user');
            //$userid=str_replace('userid-','',$getid);
            $userid= $this->session->userdata("chatwith");
            $cruserid=$this->session->userdata('user_id');
            $data=['status'=>'1'];
            $where=['status'=>'0','msgfor'=>$cruserid,'msgfrom'=>$userid];
            $this->db->where($where);
            $this->db->update('conservation',$data);
            $sql="SELECT a.*,c.f_name as first_name,c.l_name as last_name,c.profile_Pic,c.is_login FROM conservation as a LEFT JOIN user_Info as c ON a.msgfrom=c.id WHERE (a.msgfrom='".$userid."' OR a.msgfor='".$userid."') AND (a.msgfrom='".$cruserid."' OR a.msgfor='".$cruserid."') ORDER BY a.senddate ASC";
            $query=$this->db->query($sql);
            if($query -> num_rows()>0){
            $result=$query->result();
                echo json_encode(['status'=>TRUE,'message'=>$result]);
            }else{
                echo json_encode(['status'=>FALSE,'message'=>'']);
            }
//        }
//        else
//        {
//            echo json_encode(['status'=>FALSE,'message'=>validation_errors()]);
//        }
    }
    
    public function send()
    {
        $this->_usermessagelimitation("message",$this->userpaidstatus,"conservation",array("msgfrom"=>$this->userid));
        
        $this->form_validation->set_rules('message','Message','trim|required');
        //$this->form_validation->set_rules('msgfor','Message for','trim|required');
        if($this->form_validation->run())
        {
            //$getid=$this->input->post('msgfor');
            //$userid=str_replace('userid-','',$getid);
            $userid=$this->session->userdata("chatwith");
           
//            if($this->input->post('forproduct') != ""){
//                $forproduct=$this->input->post('forproduct');
//            } else {
//                $forproduct=NULL;
//            }
            $data=['msgfrom'=>$this->session->userdata('user_id'),'msgfor'=>$userid,'message'=>$this->input->post('message'),'status'=>'0','senddate'=>date('Y-m-d H:i:s')];
            $this->db->insert('conservation',$data);
            echo json_encode(['status'=>TRUE]);
        }
        else
        {
            echo json_encode(['status'=>FALSE,'message'=>validation_errors()]);
        }
    }
    
    
    
    public function _usermessagelimitation($title=null,$userpaidstatus=null,$table=null,$where=array()){
        
            $data=array("table"=>"user_validation","val"=>"$title as title","where"=>array("user_type"=>"$userpaidstatus"));
            
            $log=$this->common->getsinglerow($data);
            //print_r($log);exit;
            //print_r($this->db->last_query());exit;
            if($log['res']){
                
                $newdata=array("table"=>$table,"where"=>$where);
                $newlog=$this->common->record_count_where($newdata);
                //echo $log['rows']->title,$newlog;exit;
                if($log['rows']->title > $newlog){
                    return array("status"=>true,"message"=>"");
                }else{
                    $count=$log['rows']->title;
                    //$message="you have only $count $title limitation for more $title you need to <a href='".BASE_URL."paiduser'> click here</a> for purchase Theame";
                    $message="As a Free User, you are limited to send $count $title. To send more and access additional functionality, please <a href='".BASE_URL."paiduser'> click here</a> to purchase a Premium package.";
                    echo json_encode(['status'=>FALSE,'message'=>$message]);
                    exit;
                    //redirect($redirectpage,"refresh");
                }
                //EXIT;
            }else{
                return array("status"=>true,"message"=>"no any limitation");
            }
            
       
    }
    
    public function get_online_user()
    {
        
        $sql="SELECT DISTINCT msgfrom FROM conservation WHERE msgfor='".$this->userid."' AND status='0'";
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
        }
        //$this->db->select('b.id as id,b.is_login',FALSE);
        $this->db->select('b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login',FALSE);
        $this->db->join('conservation c','b.id=c.msgfor','left');
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
    
    
    public function get_online_singleuser(){
        $userid=$this->input->post('id');
        $data=array("table"=>"user_Info","val"=>"is_login","where"=>array("id"=>$userid));
        $log=$this->common->getsinglerow($data);
        if($log['res']){
            echo $log['rows']->is_login;
        }else{
            echo '0';
        }
    }
    
    
    public function searchbyusername(){
        $search=$this->input->post("search");$search = trim($search);
        $query="select id from user_Info where (f_name Like '%".$search."%' OR l_name Like '%".$search."%' OR  CONCAT(f_name,' ',l_name) Like '%".$search."%' OR  CONCAT(f_name,'',l_name) Like '%".$search."%' OR username Like '%".$search."%') AND store_info='1'";
        $result=$this->db->query($query); $users=array(); $rows=$result->result();
        //echo $this->db->last_query();exit;
        foreach($rows as $user){ array_push($users, $user->id);} $searcheduser=array_unique($users);
        if(!empty($searcheduser)){
            $this->db->select(array("id","f_name","l_name","profile_Pic"));
            $this->db->from("user_Info");
            $this->db->where_in("id",$searcheduser);
            $query=$this->db->get();  
            if($query -> num_rows() > 0){ echo json_encode(array("status"=>true,"data"=>$query->result()));}
            else{ echo json_encode(array("status"=>false,"data"=>"User not found")); }
        }else{
            echo json_encode(array("status"=>false,"data"=>"User not found"));
        }
    }
    
}    
