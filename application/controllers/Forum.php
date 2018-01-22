<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        //$this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
    }
    

    public function index(){
        
        $comment1=array('val'=>'COUNT(f.id) AS `Nooftopic`,c.id as Catid,c.category,c.timestamp','table'=>'fourm_category as c','where'=>array("c.admin_status"=>"1"),'minvalue'=>'','group_by'=>'c.id','start'=>'','orderby'=>'c.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'user_Info as u','on'=>'c.user_id=u.id','join_type'=>''),
            array('table'=>'fourm_question as f','on'=>'c.id=f.cat_id','join_type'=>'left'),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
       //for ads
        //$comment3=array('table'=>'ads_subscription as assb','val'=>'u.id as userid,u.username,assb.*','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'assb.id','orderas'=>'DESC');
        $comment3="SELECT ads.*,uifo.id as seller_id,uifo.username FROM ads_subscription as ads LEFT JOIN user_Info as uifo on ads.user_id=uifo.id  where ads.paid_status='1' AND ads.status='1' ORDER BY RAND()  limit 0,1";
        $log['ads']=$this->common->dbQuery($comment3);
        //echo "<pre>";
        //print_r($log); exit;
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "forum";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['categorylist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query();exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $this->load->view('include/header');
        $this->load->view('forum/vw_category_list',$log);
        $this->load->view('include/footer');
    }

    
    
    
    public function  topic($catid){
        
        $comment1=array('val'=>'COUNT(r.id) AS `Noofreply`,ql.id as liked,f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,u.id as UserId,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array("f.admin_status"=>"1","f.cat_id"=>$catid),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>''),
            array('table'=>'fourm_question_like as ql','on'=>$this->userid.'=ql.user_id AND f.id=ql.forum_id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
        
        
        //$table=array("table"=>"fourm_question","where"=>array("admin_status"=>"1","cat_id"=>$catid));
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "forum/topic/$catid";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['forumlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query();exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $log['categoryid']=$catid;
        
        /*$select =array(
            'f.*',
            'COUNT(r.id) AS `Count`'
            );
$this->db->select($select);
$this->db->from('fourm_question f');
$this->db->group_by('f.id');
$this->db->join('fourm_reply r', 'r.forum_id = f.id','left'); 
$query = $this->db->get();
echo $this->db->last_query();
print_r($query->result());exit;*/

        $this->load->view('include/header');
        /*if(!$this->session->has_userdata('user_id')){
            $this->load->view('forum/vw_topic_list',$log);
        }else{
            //$this->load->view('userlogin/include/vw_userleft');
            $this->load->view('forum/vw_topic_list1',$log);
        }*/
        $this->load->view('forum/vw_topic_list1',$log);
        $this->load->view('include/footer');
    }

    public function newtopic($catid){
        $this->_checkvalid("forum/newtopic/$catid");
        
        $this->form_validation->set_rules('topic','Topic','trim|required');
        $this->form_validation->set_rules('question','Question','trim|required');
        if($this->form_validation->run()){
            $topic=$this->input->post("topic");
            $question=$this->input->post("question");
            //$admin_status=$this->_admin_approval_status();
            $admin_status=$this->getadminsettings();
            
            $data=array("table"=>"fourm_question","val"=>array("user_id"=>$this->userid,"cat_id"=>$catid,"topic"=>$topic,"question"=>$question,"timestamp"=>time(),"admin_status"=>$admin_status->forum_post));
            $log=$this->common->add_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Your topic add successfully.");
                redirect('forum/topic/'.$catid,'refresh');
            }
        }else{
            $log['categoryid']=$catid;
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft',$log);
            $this->load->view('forum/vw_newtopic');
            $this->load->view('include/footer');
        }
    }
    
    
    public function user($id){
        
        $comment1=array('val'=>'COUNT(r.id) AS `Noofreply`,cat.category,ql.id as liked,f.cat_id,f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,u.id as UserId,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array("f.admin_status"=>"1","f.user_id"=>$id),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'f.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>''),
            array('table'=>'fourm_category as cat','on'=>'f.cat_id=cat.id','join_type'=>''),
            array('table'=>'fourm_question_like as ql','on'=>$this->userid.'=ql.user_id AND f.id=ql.forum_id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
        
        //$table=array("table"=>"fourm_question","where"=>array("admin_status"=>"1","user_id"=>$id));
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "forum/user/$id";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['forumlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        $this->load->view('include/header');
        $this->load->view('forum/vw_user_topic_list1',$log);
        $this->load->view('include/footer');
    }
    
    public function detail($id){
        $data=array("table"=>"fourm_question","val"=>array("view"),"where"=>array("id"=>$id));
        $view=$this->common->getsinglerow($data);
        $views=$view["rows"]->view+1;
        $data1=array("table"=>"fourm_question","val"=>array("view"=>$views),"where"=>array("id"=>$id));
        $upadate=$this->common->update_data($data1);
        
        $comment1=array('val'=>'COUNT(r.id) AS `Noofreply`,ql.id as liked,f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.cat_id,u.id as UserId,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array("f.admin_status"=>"1","f.id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'f.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'left'),
            array('table'=>'fourm_question_like as ql','on'=>$this->userid.'=ql.user_id AND f.id=ql.forum_id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        $log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
        
        
        $log['adminsettings']=$this->getadminsettings();
        $comment2=array('val'=>'r.id as ReplyId,r.topic,r.question,r.timestamp,r.user_id as adminid,u.id as UserId,u.f_name,u.l_name,u.profile_Pic','table'=>'fourm_reply as r','where'=>array("r.admin_status"=>"1","r.forum_id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.timestamp','orderas'=>'DESC');
        $multijoin2=array(  
            array('table'=>'user_Info as u','on'=>'r.user_id=u.id','join_type'=>'left'),
        );
        //$log['replylist']=$this->common->multijoin($comment2,$multijoin2);
        
        
        $table=array("table"=>"fourm_reply","where"=>array("admin_status"=>"1","forum_id"=>$id));
        $config = array();
        $config["base_url"] = BASE_URL. "forum/detail/$id";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
         $log['replylist']=$this->common->multijoin($comment2,$multijoin2,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        
        $this->load->view('include/header');
        $this->load->view('forum/vw_topic_details1',$log);
        $this->load->view('include/footer');
    }
    
    public function reply($id){
        $url='forum/reply/'.$id;
        $this->_checkvalid($url);
        
        
        $this->form_validation->set_rules('topic','Topic','trim|required');
        $this->form_validation->set_rules('question','Question','trim|required');
            if($this->form_validation->run()){
                $topic=$this->input->post("topic");
                $question=$this->input->post("question");
                //$admin_status=$this->_admin_approval_status();
                $admin_status=$this->getadminsettings();
                $data=array("table"=>"fourm_reply","val"=>array("user_id"=>$this->userid,"forum_id"=>$id,"topic"=>$topic,"question"=>$question,"timestamp"=>time(),"admin_status"=>$admin_status->forum_post));
                $log=$this->common->add_data($data);
                if($log){
                    $this->session->set_flashdata("sucess","Reply successfully.");
                    redirect("forum/detail/$id",'refresh');
                }
            }else{
                $data=array("table"=>"fourm_question","val"=>array('id as ForumId',"topic"),"where"=>array("id"=>$id));
                $log["forum"]=$this->common->getsinglerow($data);
                //print_r($log);
                $this->load->view('include/header');
                $this->load->view('userlogin/include/vw_userleft');
                $this->load->view('forum/vw_reply',$log);
                $this->load->view('include/footer');
            }
    }
    
    public function like($id,$page,$userid=0,$catid=0){
        if($userid==0){
            if($catid==0){
                $url='forum/'.$page.'/'.$id;
            }else{
                $url='forum/'.$page.'/'.$catid;
            }
        }else{
            $url='forum/'.$page.'/'.$userid;
        }
        
        $this->_checkvalid($url);
        
        $likedata1=array("table"=>"fourm_question_like","where"=>array("forum_id"=>$id,"user_id"=>$this->userid));
        $likelog1=$this->common->getNofrows($likedata1);
        //echo $likelog1;exit;
        if($likelog1<=0){
        $data=array("table"=>"fourm_question_like","val"=>array("forum_id"=>$id,"user_id"=>$this->userid));
        $log=$this->common->add_data($data);
        if($log){
                $likedata=array("table"=>"fourm_question_like","where"=>array("forum_id"=>$id));
                $likelog=$this->common->getNofrows($likedata);

                $data1=array("table"=>"fourm_question","val"=>array("like"=>$likelog),"where"=>array("id"=>$id));
                $upadate=$this->common->update_data($data1);

                if($upadate){
                    //$this->session->set_flashdata("sucess","Thanks for like this post");
                    redirect($url,'refresh');
                }else{
                   $this->session->set_flashdata("Warning","You are getting some error.");
                    redirect($url,'refresh');
                }
            }
        }else{
           $this->session->set_flashdata("warning","You have already like this post.");
           redirect($url,'refresh');
        }
    }
    
    
    public function edit(){
       $id=$this->input->post("forumid");
       $data=array("table"=>"fourm_question","val"=>array('id',"topic","question"),"where"=>array("id"=>$id));
       $log=$this->common->getsinglerow($data);
       if($log){
           echo json_encode($log);
       }
    }
    
    public function update(){
       $id=$this->input->post("id");
       $topic=$this->input->post("topic");
       $question=$this->input->post("question");
       
       $data=array("table"=>"fourm_question","val"=>array("topic"=>$topic,"question"=>$question),"where"=>array("id"=>$id));
       $log=$this->common->update_data($data);
       if($log){
           echo json_encode(array("status"=>true,"message"=>"Your post updated successfully."));
       }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
       }
    }
    
    public function delete(){
        $id=$this->input->post("id");
        $data=array("table"=>"fourm_question","where"=>array("id"=>$id));
        $log=$this->common->delete_data($data);
        if($log){
        echo json_encode(array("status"=>true,"message"=>"Your post deleted successfully."));
       }else{
           echo json_encode(array("status"=>false,"message"=>"Error!!"));
       }
    }
    
    public function replyedit(){
       $id=$this->input->post("forumid");
       $data=array("table"=>"fourm_reply","val"=>array('id',"topic","question"),"where"=>array("id"=>$id));
       $log=$this->common->getsinglerow($data);
       if($log){
           echo json_encode($log);
       }
    }
    
    public function updatereply(){
       $id=$this->input->post("id");
       $topic=$this->input->post("topic");
       $question=$this->input->post("question");
       
       $data=array("table"=>"fourm_reply","val"=>array("topic"=>$topic,"question"=>$question),"where"=>array("id"=>$id));
       $log=$this->common->update_data($data);
       if($log){
           echo json_encode(array("status"=>true,"message"=>"Your comment updated successfully."));
       }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
       }
    }
    
    public function deletereply(){
        $id=$this->input->post("id");
        $data=array("table"=>"fourm_reply","where"=>array("id"=>$id));
        $log=$this->common->delete_data($data);
        if($log){
        echo json_encode(array("status"=>true,"message"=>"Your post deleted successfully."));
       }else{
           echo json_encode(array("status"=>false,"message"=>"Error!!"));
       }
    }
    
    /*public function _checkvalid($page){
         if(!$this->session->has_userdata('user_id')){
            $this->session->set_userdata("afterloginpage",$page);
            redirect("auth/login");
        }
    }*/
    
    public function searchbycategory(){
        $category = $this->input->post("category");
        $like=array(
            'likeon'=>'category','likeval'=>$category
        );
        $comment1=array('val'=>'COUNT(f.id) AS `Nooftopic`,c.id as Catid,c.category,FROM_UNIXTIME(c.timestamp, "%e %b %Y ") as `date`,FROM_UNIXTIME(c.timestamp, "%h:%i %p") as `time`','table'=>'fourm_category as c','where'=>array("c.admin_status"=>"1"),'minvalue'=>'','group_by'=>'c.id','start'=>'','orderby'=>'','orderas'=>'DESC','like'=>$like);
        $multijoin1=array(  
            //array('table'=>'user_Info as u','on'=>'c.user_id=u.id','join_type'=>''),
            array('table'=>'fourm_question as f','on'=>'c.id=f.cat_id','join_type'=>'left'),
        );
        $log=$this->common->multijoin_with_like($comment1,$multijoin1);
            echo json_encode($log);
        
        /* $table=array("table"=>"fourm_category","where"=>array("admin_status"=>"1"));
        $config = array();
        $config["base_url"] = BASE_URL. "forum";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 2;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        
       $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $this->load->view('include/header');
        $this->load->view('forum/vw_category_list',$log);
        $this->load->view('include/footer');*/ 
    }

     public function searchbytopic(){
         $category = $this->input->post("category");
         $topic =$this->input->post("topic");
        $like=array(
            'likeon'=>'f.topic','likeval'=>$topic
        );
        $comment1=array('val'=>'COUNT(r.id) AS `Noofreply`,ql.id as liked,f.id as ForumId,f.topic,FROM_UNIXTIME(f.timestamp, "%e %b %Y ") as `date`,FROM_UNIXTIME(f.timestamp, "%h:%i %p") as `time`,f.view,f.like,u.id as UserId,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array("f.admin_status"=>"1","f.cat_id"=>$category),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'','orderas'=>'DESC','like'=>$like);
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>''),
            array('table'=>'fourm_question_like as ql','on'=>'f.user_id=ql.user_id AND f.id=ql.forum_id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
            );
        $log=$this->common->multijoin_with_like($comment1,$multijoin1);
            echo json_encode($log);
    }
    

//    public function _admin_approval_status(){
//        $this->db->select('status');
//        $this->db->from('approve_by_admin');
//        $this->db->where('title','forum_post');
//        $query = $this->db->get();
//        return $query->row();
//    }

}    
