<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends MY_Controller {
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
        $this->userpaidstatus=$this->session->userdata('user_paid');
        $this->currentmonth=date('m');
        $this->currentyear=date('Y');
        $this->load->library('zip');           
    }
 
    public function index(){
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,mt.id as inboxid,mt.view as mailview,m.attach,u.f_name,u.l_name','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$this->userid,"mt.status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail as m','on'=>'mt.mail_from=m.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );

        $table=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        $config = array();
        $config["base_url"] = BASE_URL. "mail";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['inboxlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
     
        
        $this->load->view('include/header');
        //$this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/mail/vw_inbox',$log);
        $this->load->view('include/footer');
    }
    
    public function fileattach($inserted_id){
        $dir = "assets/attach/$this->userid";
        if(is_dir($dir)){
            $destination = "assets/attach/final/$inserted_id";
            if(!is_dir($destination))
                {
                    mkdir($destination,0777);
                }
                // Open a directory, and read its contents
                if (is_dir($dir)){
                  if ($dh = opendir($dir)){
                    while (($file = readdir($dh)) !== false){
                        if($file!='.' && $file!='..'){
                            $attachfiledata[]=array("mail_from"=>$inserted_id,"file_name"=>$file);
                            copy($dir.'/'.$file, $destination.'/'.$file);
                            if(file_exists($dir.'/'.$file)){
                                unlink($dir.'/'.$file);
                            }
                        }
                    }
                   
                    closedir($dh);
                  }
                }
                
                if(isset($attachfiledata)){
                    $log1 = $this->common->insert_multi_row(array("table"=>"mail_attach","val"=>$attachfiledata));
                    $log2 = $this->common->update_data(array("table"=>"mail","val"=>array("attach"=>"1"),"where"=>array("id"=>$inserted_id)));
                    rmdir($dir);
                }
            } 
                //end file attach
    }


    public function createnew(){
        //print_R($_FILES);
        $aa=$this->_userlimitation("email",$this->userpaidstatus,"mail",array("mail_from"=>$this->userid, 'MONTH(FROM_UNIXTIME(timestamp))' => $this->currentmonth, 'YEAR(FROM_UNIXTIME(timestamp))' => $this->currentyear),"mail");
        //print_r($aa);exit;
        $this->form_validation->set_rules('to','To','trim|required');
        if($this->form_validation->run()){
            
            $to=$this->input->post("to");
            $from=$this->userid;
            $subject=(empty($this->input->post("subject"))?'no subject':$this->input->post("subject"));
            $message=$this->input->post("message");
            
            $to=explode(",",$to);
            $error_id=array();
            
            $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
            $inserted_id=$this->common->add_data_get_id($maildata);
            
            if($inserted_id){
                foreach($to as $mailto){
                 $user_id=$this->getuserid($mailto);
                 if($user_id!=NULL){$mailtodata[]=array("mail_from"=>$inserted_id,"mail_to"=>$user_id);
                } else{
                    array_push($error_id,$mailto);
                }} 
                
                if(!empty($mailtodata)){$log = $this->common->insert_multi_row(array("table"=>"mail_to","val"=>$mailtodata));}
                else{$log=true;}
                $this->fileattach($inserted_id);
               
                if($log){
                    if(!empty($error_id)){
                     $this->session->set_flashdata("warning",implode(',',$error_id)." User(s) not valid");   
                    }
                    else{
                    $this->session->set_flashdata("sucess","Your mail has been send successfully.");
                    }
                    redirect("mail","refresh");
                }
            }
            
        }else{
            $dir["read_dir"]=$this->functions->read_dir("assets/attach/$this->userid");
            //print_r($dir["read_dir"]);
            $this->load->view('include/header');
            //$this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/mail/vw_createnew',$dir);
            $this->load->view('include/footer');
        }
        
    }
    
    public function send(){
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,GROUP_CONCAT(u.f_name SEPARATOR ",") as tofirstname','table'=>'mail as m','where'=>array("m.mail_from"=>$this->userid,"m.status"=>"1"),'minvalue'=>'','group_by'=>'m.id','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>'LEFT'),
            array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
       
        
        $table=array("table"=>"mail","where"=>array("mail_from"=>$this->userid,"status"=>"1"));
        $config = array();
        $config["base_url"] = BASE_URL. "mail/send";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['inboxlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
     
        
        $this->load->view('include/header');
        //$this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/mail/vw_send',$log);
        $this->load->view('include/footer');
    }
    
    public function detail($mailid,$mailtoid=0){
        if($mailtoid > 0){
            $data=array("table"=>"mail_to","where"=>array("id"=>$mailtoid),"val"=>array("view"=>'1'));
            $update=$this->common->update_data($data);
        }
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,u.f_name,u.l_name,u.username','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );
        $log['mailfrom']=$this->common->multijoin($comment1,$multijoin1);
        
        $comment1=array('val'=>'u.f_name,u.l_name,u.username','table'=>'mail_to as mt','where'=>array("mt.mail_from"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'mt.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
        );
        $log['mailto']=$this->common->multijoin($comment1,$multijoin1);
        
        
        $this->load->view('include/header');
        //$this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/mail/vw_detail',$log);
        $this->load->view('include/footer');
    }
    
    public function senddetail($mailid){
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,u.f_name,u.l_name,u.username','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
        );
        $log['mailfrom']=$this->common->multijoin($comment1,$multijoin1);
        
        $comment1=array('val'=>'u.f_name,u.l_name,u.username','table'=>'mail_to as mt','where'=>array("mt.mail_from"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'mt.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
        );
        $log['mailto']=$this->common->multijoin($comment1,$multijoin1);
        
        
        $this->load->view('include/header');
        //$this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/mail/vw_senddetail',$log);
        $this->load->view('include/footer');
    }

    public function username(){
        $to = $this->input->post("to");
        $like=array(
          "likeon"=>"u.username",
          "likeval"=>$to
        );
        $data=array("val"=>"u.username,u.id","table"=>"user_Info as u","where"=>"","like"=>$like);
        $log=$this->common->multijoin_with_like($data);
        echo json_encode($log);
    }
    
    
    public function inboxtotrash(){
        $selectedid=$this->input->post("selectedmail");
        
        /*foreach($selectedid as $id){
        $val[]=array("status"=>2,"mail_from"=>$id,"mail_to"=>$this->userid);
        }*/
        
        $data=array("table"=>"mail_to","val"=>array("status"=>2),"where"=>array("mail_to"=>$this->userid),"in"=>"mail_from","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"Mail move to trash successfully."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function inboxtodelete(){
        $selectedid=$this->input->post("selectedmail");
        
        /*foreach($selectedid as $id){
        $val[]=array("status"=>2,"mail_from"=>$id,"mail_to"=>$this->userid);
        }*/
        
        $data=array("table"=>"mail_to","val"=>array("status"=>3),"where"=>array("mail_to"=>$this->userid),"in"=>"mail_from","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"Mail deleted successfully."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    
    public function sendtotrash(){
        $selectedid=$this->input->post("selectedmail");
        
        /*foreach($selectedid as $id){
        $val[]=array("status"=>2,"mail_from"=>$id,"mail_to"=>$this->userid);
        }*/
        
        $data=array("table"=>"mail","val"=>array("status"=>2),"where"=>array("mail_from"=>$this->userid),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"Mail move to trash successfully."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function sendtodelete(){
        $selectedid=$this->input->post("selectedmail");
        
        /*foreach($selectedid as $id){
        $val[]=array("status"=>2,"mail_from"=>$id,"mail_to"=>$this->userid);
        }*/
        
        $data=array("table"=>"mail","val"=>array("status"=>3),"where"=>array("mail_from"=>$this->userid),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"Mail deleted successfully."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!!"));
        }
    }
    
    
    public function trash(){
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.f_name,u.l_name,m.attach','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$this->userid,"mt.status"=>"2"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail as m','on'=>'mt.mail_from=m.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );
        
        $comment2=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.f_name,u.l_name,  m.attach','table'=>'mail as m','where'=>array("m.mail_from"=>$this->userid,"m.status"=>"2"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
         $log['trash_mail_to']=$this->common->multijoin($comment1,$multijoin1);
        $log['trash_mail']=$this->common->multijoin($comment2,$multijoin2);

        $config = array();
        $config["base_url"] = BASE_URL. "mail/trash";
        $config["total_rows"] = count($log['trash_mail_to']['rows'])+count($log['trash_mail']['rows']);
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['trash_mail_to']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $log['trash_mail']=$this->common->multijoin($comment2,$multijoin2,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
     
        
        $this->load->view('include/header');
        $this->load->view('userlogin/mail/vw_trash',$log);
        $this->load->view('include/footer');
    }
    
    
    
    public function reply($mailid){
        $this->_userlimitation("email",$this->userpaidstatus,"mail",array("mail_from"=>$this->userid, 'MONTH(FROM_UNIXTIME(timestamp))' => $this->currentmonth, 'YEAR(FROM_UNIXTIME(timestamp))' => $this->currentyear),"mail");
        $this->form_validation->set_rules('to','To','trim|required');
        if($this->form_validation->run()){
            
            $to=$this->input->post("to");
            $from=$this->userid;
            $subject=$this->input->post("subject");
            $message=$this->input->post("message");
            
            $to=explode(",",$to);
            
            //$this->getuserid($to[0]);
            $maildata=array("table"=>"mail","val"=>array("reply_id"=>$mailid,"mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
            $inserted_id=$this->common->add_data_get_id($maildata);
            
            if($inserted_id){
                foreach($to as $mailto){
                 $mailtodata[]=array("mail_from"=>$inserted_id,"mail_to"=>$this->getuserid($mailto));
                }  
                
                $log = $this->common->insert_multi_row(array("table"=>"mail_to","val"=>$mailtodata));
                
                $this->fileattach($inserted_id);
                
                if($log){
                    $this->session->set_flashdata("sucess","Your mail has been send successfully.");
                    redirect("mail","refresh");
                }
            }
        }else{
            $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.username as reply_to,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
            );
            $log['reply']=$this->common->multijoin($comment1,$multijoin1);
            $log["read_dir"]=$this->functions->read_dir("assets/attach/$this->userid");
            $this->load->view('include/header');
            $this->load->view('userlogin/mail/vw_reply',$log);
            $this->load->view('include/footer');
        }
    }
    
    
    
    public function forward($mailid){
        $this->_userlimitation("email",$this->userpaidstatus,"mail",array("mail_from"=>$this->userid, 'MONTH(FROM_UNIXTIME(timestamp))' => $this->currentmonth, 'YEAR(FROM_UNIXTIME(timestamp))' => $this->currentyear),"mail");
        $this->form_validation->set_rules('to','To','trim|required');
        if($this->form_validation->run()){
            
            $to=$this->input->post("to");
            $from=$this->userid;
            $subject=$this->input->post("subject");
            $message=$this->input->post("message");
            
            $to=explode(",",$to);
            
            //$this->getuserid($to[0]);
            $maildata=array("table"=>"mail","val"=>array("reply_id"=>$mailid,"mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
            $inserted_id=$this->common->add_data_get_id($maildata);
            
            if($inserted_id){
                foreach($to as $mailto){
                 $mailtodata[]=array("mail_from"=>$inserted_id,"mail_to"=>$this->getuserid($mailto));
                }  
                
                $log = $this->common->insert_multi_row(array("table"=>"mail_to","val"=>$mailtodata));
                
                $this->fileattach($inserted_id);
                
                if($log){
                    $this->session->set_flashdata("sucess","your mail has been send successfully.");
                    redirect("mail","refresh");
                }
            }
        }else{
            $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.username as reply_to,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
            );
            $log['reply']=$this->common->multijoin($comment1,$multijoin1);
            if(is_dir("assets/attach/final/$mailid/")){
                $this->functions->recurse_copy("assets/attach/final/$mailid/","assets/attach/$this->userid");
            }
            $log["read_dir"]=$this->functions->read_dir("assets/attach/$this->userid");
            $this->load->view('include/header');
            $this->load->view('userlogin/mail/vw_forward',$log);
            $this->load->view('include/footer');
        }
    }


    public function replyall($mailid){
        $this->_userlimitation("email",$this->userpaidstatus,"mail",array("mail_from"=>$this->userid, 'MONTH(FROM_UNIXTIME(timestamp))' => $this->currentmonth, 'YEAR(FROM_UNIXTIME(timestamp))' => $this->currentyear),"mail");
        $this->form_validation->set_rules('to','To','trim|required');
        if($this->form_validation->run()){
            
            $to=$this->input->post("to");
            $from=$this->userid;
            $subject=$this->input->post("subject");
            $message=$this->input->post("message");
            
            $to=explode(",",$to);
            
            //$this->getuserid($to[0]);
            $maildata=array("table"=>"mail","val"=>array("reply_id"=>$mailid,"mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
            $inserted_id=$this->common->add_data_get_id($maildata);
            
            if($inserted_id){
                foreach($to as $mailto){
                 $mailtodata[]=array("mail_from"=>$inserted_id,"mail_to"=>$this->getuserid($mailto));
                }  
                
                $log = $this->common->insert_multi_row(array("table"=>"mail_to","val"=>$mailtodata));
                $this->fileattach($inserted_id);
                if($log){
                    $this->session->set_flashdata("sucess","Your mail has been send successfully.");
                    redirect("mail","refresh");
                }
            }
        }else{
            $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.username as reply_to,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
            );
            $log['reply']=$this->common->multijoin($comment1,$multijoin1);
            
            $comment2=array('val'=>'u.username as reply_to','table'=>'mail_to as mt','where'=>array("mt.mail_from"=>$mailid,"mt.mail_to!="=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'mt.id','orderas'=>'DESC');
            $multijoin2=array(
                array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
            );
            $log['replyall']=$this->common->multijoin($comment2,$multijoin2);
            $log["read_dir"]=$this->functions->read_dir("assets/attach/$this->userid");
            $this->load->view('include/header');
            $this->load->view('userlogin/mail/vw_replyall',$log);
            $this->load->view('include/footer');
        }
    }
    
    public function sendreply($mailid){
        $this->_userlimitation("email",$this->userpaidstatus,"mail",array("mail_from"=>$this->userid, 'MONTH(FROM_UNIXTIME(timestamp))' => $this->currentmonth, 'YEAR(FROM_UNIXTIME(timestamp))' => $this->currentyear),"mail");
        $this->form_validation->set_rules('to','To','trim|required');
        if($this->form_validation->run()){
            
            $to=$this->input->post("to");
            $from=$this->userid;
            $subject=$this->input->post("subject");
            $message=$this->input->post("message");
            
            $to=explode(",",$to);
            
            //$this->getuserid($to[0]);
            $maildata=array("table"=>"mail","val"=>array("reply_id"=>$mailid,"mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
            $inserted_id=$this->common->add_data_get_id($maildata);
            
            if($inserted_id){
                foreach($to as $mailto){
                 $mailtodata[]=array("mail_from"=>$inserted_id,"mail_to"=>$this->getuserid($mailto));
                }  
                
                $log = $this->common->insert_multi_row(array("table"=>"mail_to","val"=>$mailtodata));
                $this->fileattach($inserted_id);
                if($log){
                    $this->session->set_flashdata("sucess","Your mail has been send successfully.");
                    redirect("mail","refresh");
                }
            }
        }else{
            $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.username as reply_to,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
            );
            $log['reply']=$this->common->multijoin($comment1,$multijoin1);
            
            $comment2=array('val'=>'u.username as reply_to','table'=>'mail_to as mt','where'=>array("mt.mail_from"=>$mailid,"mt.mail_to!="=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'mt.id','orderas'=>'DESC');
            $multijoin2=array(
                array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
            );
            $log['replyall']=$this->common->multijoin($comment2,$multijoin2);
            $log["read_dir"]=$this->functions->read_dir("assets/attach/$this->userid");
            $this->load->view('include/header');
            $this->load->view('userlogin/mail/vw_send_replyall',$log);
            $this->load->view('include/footer');
        }
    }
    
    
    public function attach(){
        //print_r($_FILES);
        
        for($i=0;$i<count($_FILES);$i++){
            if($_FILES[$i]['size'] <= 1024000){
            $src=$_FILES[$i]['tmp_name'];
            $filename=$_FILES[$i]['name'];
            $destination = "assets/attach/$this->userid";
            if(!is_dir($destination))
            {
                $old_umask = umask(0);
                mkdir($destination,0777);
                umask($old_umask);
            }
            $upload=move_uploaded_file($src, $destination.'/'.$filename);
            
            if($upload){
                echo '';
            }
            
            }else{
                echo "File Size is Greter than 1 mb";
            }
        }
        
        
    }
    
    public function download($id){
        $this->zip->read_dir("assets/attach/final/$id",false);
        $this->zip->download("harvest.zip");
    }
    
    public function delete_attach_file(){
        $filename=$this->input->post("filename");
        $log=$this->functions->delete_file("assets/attach/$this->userid/$filename");
        echo json_encode($log);
    }
    
    
    public function delete_attach_folder(){
        $log=$this->functions->delete_directory("assets/attach/$this->userid");
        echo json_encode($log);exit;
    }
    
    
    public function search(){
        $search=$this->input->get("search");
        $search = trim($search);
        $query="select id from user_Info where f_name Like '%".$search."%' OR l_name Like '%".$search."%' OR  CONCAT(f_name,' ',l_name) Like '%".$search."%' OR  CONCAT(f_name,'',l_name) Like '%".$search."%'";
        $result=$this->db->query($query);
        $users=array();
        $rows=$result->result();
        foreach($rows as $user){
            array_push($users, $user->id);
        }
        
        $mailuser=array_unique($users);
        
        if($this->input->get("page")=='inbox'){
           $this->search_inbox($mailuser,$search);
        }else if($this->input->get("page")=='send'){
            $this->search_send($mailuser,$search);
        }else if($this->input->get("page")=='trash'){
            $this->search_trash($mailuser,$search);
        }
    }
    
    
    
    public function search_inbox($users=array(),$search){
        $searchs = str_replace(' ', '', strtolower($search));
        if(count($users)<=0 && $searchs!="systemgenerated"){
            $log['inboxlist']=array("res"=>false,"rows"=>'');
            $log["links"]='';
            $this->load->view('include/header');
            $this->load->view('userlogin/mail/vw_inbox',$log);
            $this->load->view('include/footer');
            exit;
        }
        
        if($searchs=="systemgenerated"){
            $user_id = '0';
            
            $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,mt.id as inboxid,mt.view as mailview,m.attach,u.f_name,u.l_name','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$this->userid,"mt.status"=>"1","m.mail_from"=>$user_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        }else{
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,mt.id as inboxid,mt.view as mailview,m.attach,u.f_name,u.l_name','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$this->userid,"mt.status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','in'=>'m.mail_from',"in_value"=>$users,'orderby'=>'m.id','orderas'=>'DESC');
        }
        $multijoin1=array(  
            array('table'=>'mail as m','on'=>'mt.mail_from=m.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
       
        
        //$table=array("table"=>"mail_to","where"=>array("mail_to"=>$this->userid,"status"=>"1"));
        if($searchs=="systemgenerated"){
            $table=$this->common->multijoin($comment1,$multijoin1);
        }else{
            $table=$this->common->multijoin_with_in($comment1,$multijoin1);
        }
        
        $config = array();
        $config["base_url"] = BASE_URL. "mail/search?page=inbox&search=".$search;
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        
        if($searchs=="systemgenerated"){
            $log['inboxlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        }else{
            $log['inboxlist']=$this->common->multijoin_with_in($comment1,$multijoin1,$config["per_page"], $page);
        }
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
     
        
        $this->load->view('include/header');
        //$this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/mail/vw_inbox',$log);
        $this->load->view('include/footer');
    }
    
    
    public function search_send($users=array(),$user){
        
        if(count($users)<=0){
            $log['inboxlist']=array("res"=>false,"rows"=>'');
            $log["links"]='';
            $this->load->view('include/header');
            $this->load->view('userlogin/mail/vw_send',$log);
            $this->load->view('include/footer');
            exit;
        }
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,GROUP_CONCAT(u.f_name SEPARATOR ",") as tofirstname','table'=>'mail as m','where'=>array("m.mail_from"=>$this->userid,"m.status"=>"1"),'minvalue'=>'','group_by'=>'m.id','start'=>'','in'=>'mt.mail_to',"in_value"=>$users,'orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>'LEFT'),
            array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
       
        
        $table=$this->common->multijoin_with_in($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "mail/search?page=send&search=".$user;
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['inboxlist']=$this->common->multijoin_with_in($comment1,$multijoin1,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
     
        
        $this->load->view('include/header');
        //$this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/mail/vw_send',$log);
        $this->load->view('include/footer');
    }
    
    
    public function search_trash($users=array(),$user){
        
        if(count($users)<=0){
            $log['inboxlist']=array("res"=>false,"rows"=>'');
            $log["links"]='';
            $this->load->view('include/header');
            $this->load->view('userlogin/mail/vw_trash',$log);
            $this->load->view('include/footer');
		exit;
        }
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.f_name,u.l_name','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$this->userid,"mt.status"=>"2"),'minvalue'=>'','group_by'=>'','start'=>'','in'=>'m.mail_from',"in_value"=>$users,'orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail as m','on'=>'mt.mail_from=m.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
        );
        
        $comment2=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.mail_from"=>$this->userid,"m.status"=>"2"),'minvalue'=>'','group_by'=>'m.id','start'=>'','in'=>'m.mail_from',"in_value"=>$users,'orderby'=>'m.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
        $table=array("table"=>"mail_to","where"=>array("mail_to"=>$this->userid,"status"=>"2"));
        $table1=array("table"=>"mail","where"=>array("mail_from"=>$this->userid,"status"=>"2"));
        $config = array();
        $config["base_url"] = BASE_URL. "mail/search?page=trash&search=".$user;
        $config["total_rows"] = $this->common->record_count_where($table)+$this->common->record_count_where($table1);
        $config["per_page"] = 20;
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['trash_mail_to']=$this->common->multijoin_with_in($comment1,$multijoin1,$config["per_page"], $page);
        $log['trash_mail']=$this->common->multijoin_with_in($comment2,$multijoin2,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
     
        
        $this->load->view('include/header');
        $this->load->view('userlogin/mail/vw_trash',$log);
        $this->load->view('include/footer');
    }
    
    
}    
