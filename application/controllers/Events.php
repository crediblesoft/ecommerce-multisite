<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
         
        
    }
    public function  chechuserisbuterorseller()
    {
        if($this->session->userdata('user_type')=="2")
        {
            //buyer only
            $this->session->set_flashdata("warning","Sorry you do not have permission to access it.");
            redirect("events/","refresh");
        }
        else
        {
            //for seller only
           //
        }
    }

    public function index()
    {
        
        $data1=array('val'=>'ev.id, ev.user_id, ev.event_title, ev.event_detail, ev.start_date, ev.start_time, ev.end_Date, ev.end_time, ev.event_link, ev.event_image, ev.event_video, ev.event_color, ev.stetus','table'=>'events as ev','where'=>array("ev.admin_status"=>'1','ev.stetus'=>'1','uifo.status'=>'1'));

        $multijoin1 = array(
            array('table'=>'user_Info as uifo','on'=>'ev.user_id = uifo.id','join_type'=>'left')
            );
        $data['eventdata']=$this->common->multijoin($data1,$multijoin1);
         //for ads
        //$comment3=array('table'=>'ads_subscription as assb','val'=>'u.id as userid,u.username,assb.*','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'assb.id','orderas'=>'DESC');
        $comment3="SELECT ads.*,uifo.id as seller_id,uifo.username FROM ads_subscription as ads LEFT JOIN user_Info as uifo on ads.user_id=uifo.id  where ads.paid_status='1' AND ads.status='1' ORDER BY RAND()  limit 0,1";
        $data['ads']=$this->common->dbQuery($comment3);
        //echo "<pre>";
        //print_r($resp); exit;
         $str="";
        if($data['eventdata']['res']){        
                foreach ($data['eventdata']['rows'] as $res){
                    //print_r($res);exit;
                    $str.="{";
                    $str.="id:         '".$res->id."',";
                    $str.="title:      '".addslashes($res->event_title)."',";
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
        //print_r($str);//exit;
        $data['evendata']=$str;
        $this->load->view('include/header');
        $this->load->view('events/calendarEvents',$data);
        $this->load->view('include/footer');
    }
    public function viewuserEvents()
    {
        $this->chechuserisbuterorseller();
        $this->functions->_valid_user();        
        $user_id=$this->session->userdata('user_id');
        /*$comment1=array('val'=>'ev.id,ev.event_title, ev.event_detail, ev.start_date, ev.start_time, ev.end_Date, ev.end_time, ev.event_link, ev.event_image, ev.event_video, ev.event_color,ev.stetus,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.profile_Pic, ui.address1','table'=>'events as ev','where'=>array("ev.user_id"=>$user_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'ev.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=ev.user_id','join_type'=>'')            
        );//id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus
        $data['events']=$this->common->multijoin($comment1,$multijoin1); 
       */
        $data1=array('val'=>'id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus , admin_status','table'=>'events','where'=>array('user_id'=>$user_id,"admin_status"=>'1','stetus'=>'1'));
        $data['eventdata']=$this->common->getdata($data1);
        $str="";
        if($data['eventdata']['res']){        
                foreach ($data['eventdata']['rows'] as $res){
                    //print_r($res);exit;
                    $str.="{";
                    $str.="id:         '".$res->id."',";
                    $str.="title:      '".addslashes($res->event_title)."',";
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
        //print_r($str);exit;
        $data['evendata']=$str;
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft',$data);
        $this->load->view('events/usercalendarEvents');
        $this->load->view('include/footer');  
    }
    public function eventDetail($id)
    {
        $this->chechuserisbuterorseller();
        $this->functions->_valid_user();        
        $user_id=$this->session->userdata('user_id');        
        $data1=array('val'=>'id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus','table'=>'events','where'=>array('user_id'=>$user_id,'id'=>$id));
        $data['events']=$this->common->getdata($data1);
        if($data['events']['res']){
        $this->load->view('include/header');        
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('events/oneventdetail',$data);
        $this->load->view('include/footer');
        }
        else{
            $this->session->set_flashdata("warning","Invalid event");
            redirect("events/viewuserEvents/","refresh");
            }
    }

    public function add()
    {
        $this->chechuserisbuterorseller();
         $this->functions->_valid_user();
        //$this->form_validation->set_rules('video_link','Video Link','trim|required');
        $this->form_validation->set_rules('name','Event Name','trim|required');
        $this->form_validation->set_rules('color','Event color','trim|required');
        $this->form_validation->set_rules('details','Event Details','trim|required');
        $this->form_validation->set_rules('EventStartDate','Event Start Date','trim|required');
        //$this->form_validation->set_rules('EventEndDate','Event End Date','trim|required');
        
           
        if($this->form_validation->run()){
        
        $userid=$this->session->userdata('user_id');
        
        $video_link=$this->input->post("video_link");
        $another_link=$this->input->post("another_link");
        $name=$this->input->post("name");
        $color=$this->input->post("color");
        $details=$this->input->post("details");
        $EventStartDate=$this->input->post("EventStartDate");
        $EventEndDate=$this->input->post("EventEndDate");
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
                    'stetus'=>$status));
           //print_r($data);
            //INSERT INTO `events`(`id`, `user_id`, `event_title`, `event_detail`, `start_date`, `start_time`, `end_Date`, `end_time`, `event_link`, `event_image`, `event_video`, `event_color`, `stetus`) 
            $log=$this->common->add_data($data);            
            if($log){
                $this->session->set_flashdata("sucess","The event added successfully.");
                redirect("events/add","refresh");
                }
                else {
                    $this->session->set_flashdata("warning","Event not save successfully.");
                redirect("events/add","refresh");
                }

            }else{ 
           
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('events/eventsadd');
            $this->load->view('include/footer');
            }
    }
    public function userEventsList()
    {
        $this->chechuserisbuterorseller();
        $this->functions->_valid_user();        
        $user_id=$this->session->userdata('user_id');
         $comment1=array('val'=>'ev.id,ev.event_title, ev.event_detail, ev.start_date, ev.start_time, ev.end_Date, ev.end_time, ev.event_link, ev.event_image, ev.event_video, ev.event_color,ev.stetus,ev.admin_status','table'=>'events as ev','where'=>array("ev.user_id"=>$user_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'ev.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'user_Info as ui','on'=>'ui.id=ev.user_id','join_type'=>'')  ///,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.profile_Pic, ui.address1          
        );
        $data['events']=$this->common->multijoin($comment1,$multijoin1); 
        
        //$data1=array('val'=>'id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus','table'=>'events','where'=>array('user_id'=>$user_id));
        //$data['events']=$this->common->getdata($data1);
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft',$data);
        $this->load->view('events/userEventsList');
        $this->load->view('include/footer');
    }
    public function editevents($id)
    {
        $this->chechuserisbuterorseller();
        $this->functions->_valid_user();
        //$this->form_validation->set_rules('video_link','Video Link','trim|required');
        $this->form_validation->set_rules('name','Event Name','trim|required');
        $this->form_validation->set_rules('color','Event Price','trim|required');
        $this->form_validation->set_rules('details','Event Details','trim|required');
        $this->form_validation->set_rules('EventStartDate','Event Start Date','trim|required');
        //$this->form_validation->set_rules('EventEndDate','Event End Date','trim|required');
        
           
        if($this->form_validation->run()){
        
        $userid=$this->session->userdata('user_id');
        $another_link=$this->input->post("another_link");
        $video_link=$this->input->post("video_link");
        $name=$this->input->post("name");
        $color=$this->input->post("color");
        $details=$this->input->post("details");
        $EventStartDate=$this->input->post("EventStartDate");
        $EventEndDate=$this->input->post("EventEndDate");
        $end_date='';
        $end_time='';
        $eventId=$this->input->post('eventId');
        $status=$this->input->post("status");
        
        if(isset($_FILES['file']['name'])&&($_FILES['file']['name']!="")){
            //'prod_img'=>$prodImage,
            $proddata=array("table"=>"events","where"=>array("id"=>$eventId),"val"=> array("event_image"));
            $product=$this->common->getsinglerow($proddata);
                $path="assets/image/CalendarEvents/".$product['rows']->event_image;
                unlink($path);
                //$path="assets/image/CalendarEvents/thumb/".$product['rows']->image_path;
                //unlink($path);
           
        $userfile='file';
        $image_path='assets/image/CalendarEvents/';
        $allowed='jpg|png|jpeg';
        $max_size='1536';

        $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
        $prodImage=$fileupload['filename'];
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
                    'stetus'=>$status));
         }else{
        $data=array('table'=>'events',
                'where'=>array('id'=>$eventId),
                'val'=>array(
                    'event_title'=>$name,
                    'event_color'=>$color,
                    'event_detail'=>$details,                    
                    'event_video'=>$video_link ,
                    'start_date'=>$EventStartDate,
                    'start_time'=>$end_date,
                    'end_date'=>$EventEndDate,
                    'end_time'=>$end_time,
                    'event_link'=>$another_link,                    
                    'stetus'=>$status));
         }
        $log=$this->common->update_data($data);
       //print_r($log);exit;
            if($log){
                //echo "eerr";exit;
                $this->session->set_flashdata("sucess","The event successfully updated.");
                redirect("events/userEventsList","refresh");
            }        
            else{
                $this->session->set_flashdata("warning","The event not  updated successfully.");
                redirect("events/userEventsList","refresh");
            }
        }  else {
            
        
        $user_id=$this->session->userdata('user_id');        
        $data1=array('val'=>'id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus','table'=>'events','where'=>array('user_id'=>$user_id,'id'=>$id));
        $data['events']=$this->common->getdata($data1);
        
        $this->load->view('include/header');        
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('events/edit_event',$data);
        $this->load->view('include/footer');
        }
    }
    public function delete(){
        $this->chechuserisbuterorseller();
        $this->functions->_valid_user();
        $id = $this->input->post("id");        
        $data=array('val'=>'*','table'=>'events','where'=>array('id'=>$id));
        $result=$this->common->getdata($data);
       if($result['res']){
        $log=$this->common->delete_data($data);
       // print_r($result);
        //$log=1;
                if($log){
                    echo json_encode(array('status'=>TRUE,'message'=>'Data deleted successfully.'));
               }
               else{
                   echo json_encode(array('status'=>FALSE,'message'=>'Data not deleted Successfully'));
               }
        }else{
           echo json_encode(array('status'=>FALSE,'message'=>'You can not delete this event <br/> some one doing payment on this.'));
       }
    }
    
    
    public function updateevent()
    {
        $this->chechuserisbuterorseller();
        $this->functions->_valid_user();
        //$this->form_validation->set_rules('video_link','Video Link','trim|required');
        $this->form_validation->set_rules('name','Event Name','trim|required');
        $this->form_validation->set_rules('color','Event Price','trim|required');
        //$this->form_validation->set_rules('details','Event Details','trim|required');
        $this->form_validation->set_rules('EventStartDate','Event Start Date','trim|required');
        //$this->form_validation->set_rules('EventEndDate','Event End Date','trim|required');
        
           
        if($this->form_validation->run()){
        
        $userid=$this->session->userdata('user_id');
        $another_link=$this->input->post("another_link");
        $video_link=$this->input->post("video_link");
        $name=$this->input->post("name");
        $color=$this->input->post("color");
        $details=$this->input->post("details");
        $EventStartDate=$this->input->post("EventStartDate");
        $EventEndDate=$this->input->post("EventEndDate");
        $end_date='';
        $end_time='';
        $eventId=$this->input->post('eventId');
        $status=$this->input->post("status");
        
        if(isset($_FILES['file']['name'])&&($_FILES['file']['name']!="")){
            //'prod_img'=>$prodImage,
            $proddata=array("table"=>"events","where"=>array("id"=>$eventId),"val"=> array("event_image"));
            $product=$this->common->getsinglerow($proddata);
                $path="assets/image/CalendarEvents/".$product['rows']->event_image;
                unlink($path);
                //$path="assets/image/CalendarEvents/thumb/".$product['rows']->image_path;
                //unlink($path);
           
        $userfile='file';
        $image_path='assets/image/CalendarEvents/';
        $allowed='jpg|png|jpeg';
        $max_size='1536';

        $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
        $prodImage=$fileupload['filename'];
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
                    'stetus'=>$status));
         }else{
        $data=array('table'=>'events',
                'where'=>array('id'=>$eventId),
                'val'=>array(
                    'event_title'=>$name,
                    'event_color'=>$color,
                    'event_detail'=>$details,                    
                    'event_video'=>$video_link ,
                    'start_date'=>$EventStartDate,
                    'start_time'=>$end_date,
                    'end_date'=>$EventEndDate,
                    'end_time'=>$end_time,
                    'event_link'=>$another_link,                    
                    'stetus'=>$status));
         }
        $log=$this->common->update_data($data);
       //print_r($log);exit;
            if($log){
                //echo "eerr";exit;
                $this->session->set_flashdata("sucess","The event updated successfully.");
                redirect("events/userEventsList/","refresh");
            }        
            else{
                $this->session->set_flashdata("warning","The event not updated successfully.");
                redirect("events/editevents/".$eventId,"refresh");
            }
        }else{
            $this->session->set_flashdata("warning","The event not updated successfully.");
            redirect("events/editevents/".$eventId,"refresh");
        }
    }
    
    public function viewsellerwiseEvents($sellerid)
    {
        
        //$this->chechuserisbuterorseller();
        //$this->functions->_valid_user();        
        $user_id=$sellerid; 
        /*$comment1=array('val'=>'ev.id,ev.event_title, ev.event_detail, ev.start_date, ev.start_time, ev.end_Date, ev.end_time, ev.event_link, ev.event_image, ev.event_video, ev.event_color,ev.stetus,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.profile_Pic, ui.address1','table'=>'events as ev','where'=>array("ev.user_id"=>$user_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'ev.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=ev.user_id','join_type'=>'')            
        );//id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus
        $data['events']=$this->common->multijoin($comment1,$multijoin1); 
       */
        $data1=array('val'=>'id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus , admin_status','table'=>'events','where'=>array('user_id'=>$user_id,"admin_status"=>'1','stetus'=>'1'));
        $data['eventdata']=$this->common->getdata($data1);
        
        $data2=array('val'=>'id, username','table'=>'user_Info','where'=>array('id'=>$user_id,'status'=>'1'));
        $data['seller_info']=$this->common->getdata($data2);
        //print_r($data);
        
//       $data1=array('val'=>'evn.id,evn.user_id,evn.event_title,evn.event_detail,evn.start_date,evn.start_time,evn.end_Date,evn.end_time,evn.event_link,evn.event_image,evn.event_video,evn.event_color,evn.stetus,u.username' ,'table'=>'events as evn','where'=>array('evn.user_id'=>$user_id,"admin_status"=>'1','stetus'=>'1'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'evn.id','orderas'=>'DESC');
//            $multijoin2=array(
//                array('table'=>'user_Info as u','on'=>'evn.user_id=u.id','join_type'=>''),
//            ); 
//            
//        $data['eventdata']=$this->common->multijoin($data1,$multijoin2);
        //echo "<pre>";
        //print_r($data); exit;
        
       
         $str="";
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
        //print_r($str);exit;
        $data['evendata']=$str;
        //echo "<pre>";
        //print_r($data); exit;
        $this->load->view('include/header');
//        $this->load->view('userlogin/include/vw_userleft',$data);
        $this->load->view('events/sellercalenderEvents',$data);
        $this->load->view('include/footer');  
    }
    
    function geteventdata_byid(){
        //echo "hello";
        $eventid=$this->input->post("event_id");
        //echo $eventid;
        $query="SELECT events.*,user_Info.username from events left join user_Info on events.user_id = user_Info.id where events.id=$eventid";
        $resp=$this->common->dbQuery($query);
        //print_r($resp);
          if($resp['res']){
             // echo "hi";exit;
            echo json_encode(array("status"=>true,"rows"=>$resp['rows']));exit;
        }
        
        else{
            echo json_encode(array("status"=>false,"message"=>"Data not found."));exit;
        }
    }
    
}