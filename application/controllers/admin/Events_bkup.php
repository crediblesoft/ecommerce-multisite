<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends MY_Controller{
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    public function index(){
//        $this->load->view('admin/include/admin_header');
//        $this->load->view('admin/include/admin_left');
//        $this->load->view('admin/events/admin_vw_calendarEvents');
//        $this->load->view('admin/include/admin_footer'); 
    }
    
    public function viewuserEvents()
    {
        $data1=array('val'=>'','table'=>'events','where'=>array("admin_status"=>'1'));
        $data['eventdata']=$this->common->getdata($data1);
         $str="";
        // print_r($data22);
        if($data['eventdata']['res']){        
                foreach ($data['eventdata']['rows'] as $res){
                    //print_r($res);exit;
                    $str.="{";
                    $str.="id:         '".$res->id."',";
                    $str.="title:      '".$res->event_title."',";
                    $str.="start:      '".date("Y-m-d", strtotime($res->start_date))."',";
                    $str.="end:        '".date("Y-m-d", strtotime("+1 day",strtotime($res->end_Date)))."',";
                   $str.="url:         '".$res->event_link."',";
                    $str.="color:      '".$res->event_color."'";
                    $str.="},";
                }
        $str=rtrim($str, ",");
        }
        else{
            //$str.="{title: 'No event'}";
        }
         $data['evendata']=$str;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/events/admin_vw_calendarEvents',$data);
        $this->load->view('admin/include/admin_footer'); 
    }
    
    public function eventlist(){
//        $comment1=array('val'=>'','table'=>'events as ev','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC');
//        $multijoin1=array('table'=>'user_info as ui','on'=>'ui.id=ev.user_id','join_type'=>'');
//        
        $comment1=array('val'=>'ev.id,ev.event_title, ev.event_detail, ev.start_date, ev.start_time, ev.end_Date, ev.end_time, ev.event_link, ev.event_image, ev.event_video, ev.event_color,ev.stetus,ev.admin_status, ui.email_id,ui.id as user_id, ui.f_name, ui.username','table'=>'events as ev','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'ev.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=ev.user_id','join_type'=>'left')            
        );
        //$data['events']=$this->common->multijoin($comment1,$multijoin1);
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/events/eventlist?";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $data['events']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/events/admin_vw_eventlist',$data);
        $this->load->view('admin/include/admin_footer'); 
    }
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"events","val"=>array("admin_status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count event add to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"events","val"=>array("admin_status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count event remove from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function delete(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"events","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count event deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function search(){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val');$val=trim($val);
        //print_r($searchby);exit;
        if($searchby=='seller'){
            if($val==''){ $where=array(); }else{ $where=array('user_id'=>$val); }
            $comment1=array('val'=>'ev.*,ui.username,ui.id as user_id','table'=>'events as ev','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"like"=>array());
            $data=$this->searchbyother(trim($val),$comment1,$searchby);
        }else if($searchby=='productname'){
            $comment1=array('val'=>'ev.*,ui.username,ui.id as user_id','table'=>'events as ev','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"like"=>array("likeon"=>"event_title","likeval"=>$val));
            $data=$this->searchbyother(trim($val),$comment1,$searchby);
        }else if($searchby=='bidstartdate'){
            $from=$this->input->get('from');
            $to=$this->input->get('to');
            $where=array();
            $comment1=array('val'=>'ev.*,ui.username,ui.id as user_id','table'=>'events as ev','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"between"=>array('col'=>'ev.start_date','from'=>$from,'to'=>$to),"in_value"=>array());
            $data=$this->searchbydate(trim($from),trim($to),$comment1,$searchby);
        }else if($searchby=='bidenddate'){
            $from=$this->input->get('from');
            $to=$this->input->get('to');
            $where=array();
            $comment1=array('val'=>'ev.*,ui.username,ui.id as user_id','table'=>'events as ev','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"between"=>array('col'=>'ev.end_Date','from'=>$from,'to'=>$to),"in_value"=>array());
            $data=$this->searchbydate(trim($from),trim($to),$comment1,$searchby);
        }else if($searchby=='running'){
            
        }else if($searchby=='bidover'){
            
        }else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/events/eventlist","refresh");
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/events/admin_vw_eventlist',$data);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function searchbyother($val,$comment1,$searchby){
        $multijoin1=array(
             array('table'=>'user_Info as ui','on'=>'ui.id=ev.user_id','join_type'=>'left')
        );
       // print_r($multijoin1);
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/events/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $data['events']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
       //print_r($data);
        return $data;
    }

    public function searchbydate($from,$to,$comment1,$searchby){
        $where=array();
        //$comment1=array('val'=>'','table'=>'events as ev','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"between"=>array('col'=>'p.date','from'=>$from,'to'=>$to),"in_value"=>array());
        $multijoin1=array(
            array('table'=>'user_Info as ui','on'=>'ui.id=ev.user_id','join_type'=>'')
        );
        $table=$this->common->multijoin_between($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/events/search?searchby=$searchby&from=$from&to=$to";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] =20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $data['events']=$this->common->multijoin_between($comment1,$multijoin1,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($data['products']['rows']);exit;  
        //echo "aa";exit;
        return $data;   
    }
    public function getusers(){
            $val=array('id','username');
            $where=array("type_Of_User"=>"1","status"=>"1");
            $sellers=$this->getsellers($val,$where);
            echo json_encode($sellers);
    }
    
    public function addevent(){
        $this->form_validation->set_rules('title','Title', 'trim|required');
        $this->form_validation->set_rules('color','Color','trim|required');
        $this->form_validation->set_rules('startdate','Start Date','trim|required');
        //$this->form_validation->set_rules('enddate','End Date','trim|required');
        
        if($this->form_validation->run()){
        $userid=0; //This is a static id for amdim
        $video_link="";
        $another_link="";
        $name=$this->input->post('title');
        $color=$this->input->post("color");
        $details="";
        $EventStartDate=$this->input->post("startdate");
        $EventEndDate=$this->input->post("enddate");
        $end_date='';
        $end_time='';
        $status=$this->input->post("status");
       // $admin_status=$this->_admin_approval_status();
        
        /*$data1=array('table'=>'product','where'=>array());
        $noofrows= $this->common->record_count_where($data1);
        $noofrows+=1;*/
        
            if(isset($_FILES['file']['name'])&& $_FILES['file']['name']!=='')
            {
            $userfile='file';
            $image_path='assets/image/CalendarEvents/';
            $allowed='jpg|png|jpeg';
            $max_size='1536';

            $fileupload=$this->functions->_upload_image($userfile,$image_path,$allowed,$max_size);
            //print_r($fileupload);exit;
             }
             else
              {
                 $fileupload=array('status'=>1,'filename'=>'event.jpeg');                
             }

             //print_r($fileupload);exit;
              $prodImage=$fileupload['filename'];
           // exit();

            $data=array('table'=>'events',
                'val'=>array('user_id'=>$userid,
                    'event_title'=>$name,
                    'event_color'=>$color,
                    'event_detail'=>$details,
                    'event_image'=>$prodImage,
                    'event_video'=>$video_link ,
                    'start_date'=>$EventStartDate,
                    'start_time'=>$end_date,
                    'end_date'=>$EventEndDate,
                    'end_time'=>$end_time,
                    'event_link'=>$another_link,                    
                    'admin_status'=>$status));
         //  print_r($data);exit;
            //INSERT INTO `events`(`id`, `user_id`, `event_title`, `event_detail`, `start_date`, `start_time`, `end_Date`, `end_time`, `event_link`, `event_image`, `event_video`, `event_color`, `stetus`) 
            $log=$this->common->add_data($data);            
            if($log){
                $this->session->set_flashdata("sucess","The event added successfully.");
                redirect("admin/events/addevent","refresh");
                }
                else {
                    $this->session->set_flashdata("warning","Event not save successfully.");
                    redirect("admin/events/addevent","refresh");
                }

        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/events/admin_vw_addEvent');
        $this->load->view('admin/include/admin_footer');
        
        
    }
    
    public function editevent($id){
        
        $this->form_validation->set_rules('title','Title', 'trim|required');
        $this->form_validation->set_rules('color','Color','trim|required');
        $this->form_validation->set_rules('startdate','Start Date','trim|required');
        //$this->form_validation->set_rules('enddate','End Date','trim|required');
        
        if($this->form_validation->run()){
           
        //$userid=0; //This is a static id for amdim
        $video_link="";
        $another_link="";
        $name=$this->input->post('title');
        $color=$this->input->post("color");
        $details="";
        $EventStartDate=$this->input->post("startdate");
        $EventEndDate=$this->input->post("enddate");
        $end_date='';
        $end_time='';
        $status=$this->input->post("status");
        $eventId=$this->input->post('eventId');
        if(isset($_FILES['file']['name'])&& $_FILES['file']['name']!=='')
            {
            $userfile='file';
            $image_path='assets/image/CalendarEvents/';
            $allowed='jpg|png|jpeg';
            $max_size='1536';

            $fileupload=$this->functions->_upload_image($userfile,$image_path,$allowed,$max_size);
            //print_r($fileupload);exit;
             }
             else
              {
                 $fileupload=array('status'=>1,'filename'=>'event.jpeg');                
             }

             //print_r($fileupload);exit;
              $prodImage=$fileupload['filename'];
           // exit();

            $data=array('table'=>'events',
                'where'=>array('id'=>$eventId),
                'val'=>array(
                    'event_title'=>$name,
                    'event_color'=>$color,
                    'event_detail'=>$details,
                    'event_image'=>$prodImage,
                    'event_video'=>$video_link ,
                    'start_date'=>$EventStartDate,
                    'start_time'=>$end_date,
                    'end_date'=>$EventEndDate,
                    'end_time'=>$end_time,
                    'event_link'=>$another_link,                    
                    'admin_status'=>$status));
           //print_r($data);exit;
            $log=$this->common->update_data($data);            
            if($log){
                $this->session->set_flashdata("sucess","The event updated successfully.");
                redirect("admin/events/eventlist","refresh");
                }
                else {
                    $this->session->set_flashdata("warning","Event not updated successfully.");
                    redirect("admin/events/eventlist","refresh");
                }

        }else{
            
           // $user_id=$this->session->userdata('user_id');        
            $data1=array('val'=>'','table'=>'events','where'=>array('id'=>$id));
            $data['events']=$this->common->getdata($data1);
            //echo $this->db->last_query();
           // print_r($data);exit;
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/events/admin_vw_editEvent',$data);
            $this->load->view('admin/include/admin_footer');
        }
        
        
        
    }
    
}

