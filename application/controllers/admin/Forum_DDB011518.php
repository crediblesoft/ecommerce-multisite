<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'COUNT(f.id) AS `Nooftopic`,c.id as Catid,c.category,c.timestamp,c.admin_status','table'=>'fourm_category as c','where'=>array(),'minvalue'=>'','group_by'=>'c.id','start'=>'','orderby'=>'c.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'fourm_question as f','on'=>'c.id=f.cat_id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum";
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
        $this->load->view('admin/forum/admin_vw_forumcat',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function add(){
        $this->form_validation->set_rules('name','Category Name','trim|required');
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $status=$this->input->post("status");
            $data=array('table'=>'fourm_category','val'=>array('category'=>$name,'admin_status'=>$status,'timestamp'=>time()));                
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Category has been added successfully.");
                redirect("admin/forum/add/","refresh");
            }
        }else{
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/forum/admin_vw_addcategory');
        $this->load->view('admin/include/admin_footer');
        }
    }
    
    
    public function editcategory($id){
        $data=array('val'=>array(),'table'=>'fourm_category','where'=>array('id'=>$id));
        $log['category']=$this->common->getdata($data);
        if(!$log['category']['res']){
            $this->session->set_flashdata("warning","This category not in category list.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/forum/admin_vw_editcategory',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function updatecategory(){
        $this->form_validation->set_rules('name','Category Name','trim|required');
        $id=$this->input->post("id");
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $status=$this->input->post("status");
            $data=array('table'=>'fourm_category','where'=>array('id'=>$id),'val'=>array('category'=>$name,'admin_status'=>$status,'timestamp'=>time()));                
            $log=$this->common->update_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Category has been updated successfully.");
                redirect("admin/forum","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'fourm_category','where'=>array('id'=>$id));
            $log['category']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/forum/admin_vw_editcategory');
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    
    public function activecat(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_category","val"=>array("admin_status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Category(ies) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactivecat(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_category","val"=>array("admin_status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Category(ies) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function deletecat(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_category","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Category(ies) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    
    
    public function topic($catid=NULL){
        if($catid===NULL){
            //echo "redirect to 404";exit;
            $comment1=array('val'=>'COUNT(r.id) AS `Noofreply`,f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array(),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'','orderas'=>'DESC');
            $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'inner'),
            //array('table'=>'fourm_question_like as ql','on'=>'f.id=ql.forum_id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        
        }
        else{
           // echo $catid;
           // exit;
        $comment1=array('val'=>'COUNT(r.id) AS Noofreply,f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array('f.cat_id'=>$catid),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'f.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'left'),
            //array('table'=>'fourm_question_like as ql','on'=>'f.id=ql.forum_id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        }
        

        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum/topic/$catid/";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
        $config['enable_query_strings'] = false;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        //$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['forumlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query();exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $log['pagename']=array("pagename"=>"topic","pageid"=>$catid);
        if($catid!=NULL){
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/forum/admin_vw_topiclist',$log);
            $this->load->view('admin/include/admin_footer');
        }
        else{
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/forum/admin_vw_new_topiclist',$log);
            $this->load->view('admin/include/admin_footer');    
        }
    }
    
    
    public function replylist($id){ 
        $log['adminsettings']=$this->getadminsettings();
        $comment1=array('val'=>'COUNT(r.id) AS `Noofreply`,f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.cat_id,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array("f.id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'f.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'left'),
            //array('table'=>'fourm_question_like as ql','on'=>'f.id=ql.forum_id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        $log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
        
        $comment2=array('val'=>'r.id as ReplyId,r.topic,r.question,r.timestamp,r.admin_status,r.user_id as adminid,u.id as UserId,u.username,u.f_name,u.l_name,u.profile_Pic','table'=>'fourm_reply as r','where'=>array("r.forum_id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.timestamp','orderas'=>'DESC');
        $multijoin2=array(  
            array('table'=>'user_Info as u','on'=>'r.user_id=u.id','join_type'=>'left'),
        );
        //$log['replylist']=$this->common->multijoin($comment2,$multijoin2);
        
        $table=$this->common->multijoin($comment2,$multijoin2);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum/replylist/$id";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
         $log['replylist']=$this->common->multijoin($comment2,$multijoin2,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
         $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/forum/admin_vw_replylist',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_question","val"=>array("admin_status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Topic(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_question","val"=>array("admin_status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Topic(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function delete(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_question","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Topic(s) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function user($id){
        $comment1=array('val'=>'COUNT(r.id) AS `Noofreply`,f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array("f.user_id"=>$id),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'left'),
            //array('table'=>'fourm_question_like as ql','on'=>'f.id=ql.forum_id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum/user/$id";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['forumlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query();exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $log['pagename']=array("pagename"=>"user","pageid"=>$id);
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/forum/admin_vw_topiclist',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function search(){
        $catid=$this->input->get('pageid');
        $pagename=$this->input->get('pagename');
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val');$val=trim($val);
        if($searchby=='category'){
            $comment1=array('val'=>'COUNT(f.id) AS `Nooftopic`,c.id as Catid,c.category,c.timestamp,c.admin_status','table'=>'fourm_category as c','where'=>array('c.id'=>$val),'minvalue'=>'','group_by'=>'c.id','start'=>'','orderby'=>'','orderas'=>'DESC');
            $resp=$this->searchbycategory(trim($val),$comment1,$searchby);
        }else if($searchby=='topic'){ 
            if($pagename=='topic'){ $where=array("f.cat_id"=>$catid);}else if($pagename=='user'){$where=array("f.user_id"=>$catid);}else{$where=array();}
            $comment1=array('val'=>'f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>$where,'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'f.id','orderas'=>'DESC',"like"=>array("likeon"=>"f.topic","likeval"=>$val)); //COUNT(r.id) AS `Noofreply`,
            $resp=$this->searchbyother(trim($val),$comment1,$searchby,$catid,$pagename);
        }
		else if($searchby=='postedby'){ 
            if($pagename=='topic'){ $where=array("f.cat_id"=>$catid);}else if($pagename=='user'){$where=array("f.user_id"=>$catid);}else{$where=array();}
			
            $comment1=array('val'=>'f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>$where,'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'f.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val)); //COUNT(r.id) AS `Noofreply`,
            $resp=$this->searchbyother(trim($val),$comment1,$searchby,$catid,$pagename);
        }
		else if($searchby=='posteddate'){
            $from=strtotime($this->input->get('from'));
            $to=$this->input->get('to');
			$to = strtotime("+1 day", strtotime($to));
            $resp=$this->searchbydate(trim($from),trim($to),$searchby,$catid,$pagename);
        }else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/forum","refresh");
        }
        if($searchby=='category'){ // category searching
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/forum/admin_vw_forumcat',$resp);
            $this->load->view('admin/include/admin_footer');
        }else{ // topic searching 
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/forum/admin_vw_topiclist',$resp);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function searchbycategory($val,$comment1,$searchby){
        $multijoin1=array(
            array('table'=>'fourm_question as f','on'=>'c.id=f.cat_id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum/search?searchby=$searchby&val=$val";
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
        return $log;
    }


    public function searchbyother($val,$comment1,$searchby,$catid,$pagename){
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum/search/?pagename=$pagename&pageid=$catid&searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['forumlist']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $resp['pagename']=array("pagename"=>$pagename,"pageid"=>$catid);
        //echo $this->db->last_query();
        return $resp;
    }

    public function searchbydate($from,$to,$searchby,$catid,$pagename){
        if($pagename=='topic'){ $where=array("f.cat_id"=>$catid);}else if($pagename=='user'){$where=array("f.user_id"=>$catid);}else{$where=array();}
        $comment1=array('val'=>'f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>$where,'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'f.id','orderas'=>'DESC',"between"=>array('col'=>'f.timestamp','from'=>$from,'to'=>$to),"in_value"=>array()); //COUNT(r.id) AS `Noofreply`,
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin_between($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum/search/?pagename=$pagename&pageid=$catid&searchby=$searchby&from=$from&to=$to";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['forumlist']=$this->common->multijoin_between($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $resp['pagename']=array("pagename"=>$pagename,"pageid"=>$catid);        
//        $this->db->select("topic");
//        $this->db->from("fourm_question");
//        $this->db->where('timestamp BETWEEN "'. strtotime($from). '" and "'. strtotime($to).'"');
//        $query=$this->db->get();
//        $newdata=$query->result();
//        echo "<pre>";
//        print_r($newdata);
        //echo $this->db->last_query();exit;
        //print_r($resp['products']['rows']);exit;  
        //echo "aa";exit;
        return $resp;   
    }
    
    
    
    public function addreply($forumid){
        $this->form_validation->set_rules('topic','Topic','trim|required');
        $this->form_validation->set_rules('question','Question','trim|required');
            if($this->form_validation->run()){
                $adminsettings=$this->getadminsettings();
                $topic=$this->input->post("topic");
                $question=$this->input->post("question");
                $forumid=$this->input->post("forumid");
                
                $data=array("table"=>"fourm_reply","val"=>array("user_id"=>'0',"forum_id"=>$forumid,"topic"=>$topic,"question"=>$question,"timestamp"=>time(),"admin_status"=>$adminsettings->forum_post));
                $log=$this->common->add_data($data);
                if($log){
                    $this->session->set_flashdata("sucess","Reply successfully.");
                    redirect("admin/forum/replylist/$forumid",'refresh');
                }
            }else{
                $data=array("table"=>"fourm_question","val"=>array('id as ForumId',"topic"),"where"=>array("id"=>$forumid));
                $log["forum"]=$this->common->getsinglerow($data);
                $this->load->view('admin/include/admin_header');
                $this->load->view('admin/include/admin_left');
                $this->load->view('admin/forum/admin_vw_addreply',$log);
                $this->load->view('admin/include/admin_footer');
            }
    }
    
    public function activereply(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_reply","val"=>array('admin_status'=>"1"),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Reply(ies) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function inactivereply(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_reply","val"=>array('admin_status'=>"0"),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Reply(ies) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

    public function deletereply(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"fourm_reply","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Reply(ies) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function getcagegory(){
        $data=array("table"=>"fourm_category","val"=>array(),"where"=>array("admin_status"=>"1"));
        $log=$this->common->getdata($data);
        echo json_encode($log);
    }
  
    /*Done by Ravi Maurya on 25-may-16*/
      
    public function new_search(){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val');$val=trim($val);
        if($searchby=='topic'){ 
            $comment1=array('val'=>'f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array(),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'f.id','orderas'=>'DESC',"like"=>array("likeon"=>"f.topic","likeval"=>$val)); //COUNT(r.id) AS `Noofreply`,
            $resp=$this->new_searchbyother(trim($val),$comment1,$searchby);
            //echo "<pre>";
            //print_r($resp); exit;
        }
            else if($searchby=='postedby'){ 
            $comment1=array('val'=>'f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array(),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'f.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val)); //COUNT(r.id) AS `Noofreply`,
            $resp=$this->new_searchbyother(trim($val),$comment1,$searchby);
        }
		else if($searchby=='posteddate'){
            $from=strtotime($this->input->get('from'));
            $to=$this->input->get('to');
			$to = strtotime("+1 day", strtotime($to));
            $resp=$this->new_searchbydate(trim($from),trim($to),$searchby);
        }else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/forum","refresh");
        }
       // topic searching 
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/forum/admin_vw_forum',$resp);
            $this->load->view('admin/include/admin_footer');
    }
    
    public function new_searchbyother($val,$comment1,$searchby){
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum/new_search/?&searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['forumlist']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //$resp['pagename']=array("pagename"=>$pagename,"pageid"=>$catid);
        //echo $this->db->last_query();
        return $resp;
    }
    
    public function new_searchbydate($from,$to,$searchby){
        $comment1=array('val'=>'f.id as ForumId,f.topic,f.question,f.timestamp,f.view,f.like,f.admin_status,u.id as UserId,u.username,u.f_name,u.l_name','table'=>'fourm_question as f','where'=>array(),'minvalue'=>'','group_by'=>'f.id','start'=>'','orderby'=>'f.id','orderas'=>'DESC',"between"=>array('col'=>'f.timestamp','from'=>$from,'to'=>$to),"in_value"=>array()); //COUNT(r.id) AS `Noofreply`,
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'f.user_id=u.id','join_type'=>'left'),
            array('table'=>'fourm_reply as r','on'=>'f.id=r.forum_id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin_between($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/forum/search/?&searchby=$searchby&from=$from&to=$to";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['forumlist']=$this->common->multijoin_between($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //$resp['pagename']=array("pagename"=>$pagename,"pageid"=>$catid);        
        return $resp;   
    }
    
    
    
} 
