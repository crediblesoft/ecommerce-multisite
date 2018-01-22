<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Editpenalcontroller.php';
class Usereditpenal extends Editpenalcontroller {
   // public $theme_user_id='';
    public function __construct() {
            parent::__construct();
            /*$this->load->helper('array');
            $this->load->helper('url'); */  
            	
            $this->load->database();            
            $this->load->model('modelsite');
              $this->functions->_valid_user();
              $this->load->helper('cookie');
            //$this->editfunctions->_user_permission();
            //$this->functions->_afterloginpage_delete();
			//$this->no_cache();
        }
	
	protected function no_cache(){
                header('Cache-Control: no-store, no-cache, must-revalidate');
                header('Cache-Control: post-check=0, pre-check=0',false);
                header('Pragma: no-cache');
        }
		
    public function set_cookie($data){
        $this->input->set_cookie($data);
    }
    
    public function get_cookie($name){
        return $this->input->cookie($name,true);
    }
     
        public function index()
	{
           if($this->session->userdata('user_type')=="2")
            {               
            $this->session->set_flashdata("warning","Oops !. Sorry to You Don't Have permission to access it");
            redirect('profile','refresh');
            //echo "Oops !. Sorry to You Don't Have permission to access it";
               
           }
           else{  
               $userid=$this->session->userdata('user_id');
               $isuserfirsttime=$this->get_cookie("harvisuserfirsttime$userid");
                if($isuserfirsttime==''){ $data['load_demo']=true; }else{$data['load_demo']=false;}
                $cookie= array( 'name'   => "harvisuserfirsttime$userid", 'value'  => "popup", 'expire' => '5297500'); // 1297500 for 15 days
                $this->set_cookie($cookie);
                $theme_user_id= $this->session->userdata('user_id');
                $ardata=array("table"=>"user_Info","where"=>array("id"=>$theme_user_id),"val"=>array("username"));
                $record=$this->editmodel->getsinglerow($ardata);
                $data['user_name']= $record['rows']->username;
                $data['storounerlogine']=TRUE;//for in profile logo show store link
                
                $themequery="SELECT `id`, `user_id`, `user_store_id`, `theam_id`, `file_name`, `add_date`, `update_date` FROM `db_theem` WHERE `user_id`='".$this->session->userdata('user_id')."'";
                $thresult=$this->db->query($themequery);
                $themeresult=$thresult->row();                
                $user_file_name= $themeresult->file_name;                
                $user_theam_id= $themeresult->theam_id;
                $data['user_file_name']= $themeresult->file_name;
                $data['user_theam_id']= $themeresult->theam_id; 
                
                $data['user_product']=(Editpenalcontroller::get_product_edit($this->session->userdata('user_id')));
                if(($user_theam_id=='1001')||($user_theam_id=='1003')){
                    $data['btn_theme_bootstrap']='info';
                    $data['btn_theme_color']='#ffffff';
                    $data['btn_theme_bgcolor']='#3DB2E1';
                    $data['btn_theme_style']='background: #3DB2E1;color: #FFFFFF;z-index:331;';
                }
                if(($user_theam_id=='1002')||($user_theam_id=='1004')){
                    $data['btn_theme_bootstrap']='success';
                    $data['btn_theme_color']='#ffffff';
                    $data['btn_theme_bgcolor']='#28C769';
                    $data['btn_theme_style']='background: #73C873;color: #FFFFFF;z-index:331;';
                }
                /*<?php $theme_id='info';//info ,success, warning ,danger ,primary,primary?>*/
                $data['member'] = $this->modelsite->member_here($theme_user_id,$user_theam_id);
                $data['cssclass']=$this->modelsite->get_css_class($theme_user_id,$user_theam_id);
                $data['bootstrap']=$this->modelsite->get_bootstrap($theme_user_id,$user_theam_id);
                $data['css']=  $this->modelsite->get_css_css($theme_user_id,$user_theam_id);
                $data['bootstrapname']=$this->modelsite->get_bootstrap_clasName($theme_user_id,$user_theam_id);
                $data['get_menu']=  $this->modelsite->get_menu($theme_user_id);
                $data['gallery']=  $this->modelsite->banner_image($theme_user_id);
                $data['video']=  $this->modelsite->user_vedio($theme_user_id);
                $data['aboutus_image']=  $this->modelsite->get_aboutus_image($theme_user_id,'about_us_pic');
                $data['contact_us_pic']=  $this->modelsite->get_aboutus_image($theme_user_id,'contact_us_pic');
                $data['usersitelogo']=  $this->modelsite->get_aboutus_image($theme_user_id,'usersitelogo');
                $data['user_all_image']= $this->modelsite->get_user_active_image($theme_user_id);
                foreach ($data['get_menu'] as $get_menu_data)
                {
                   $data['pagename'.$get_menu_data['sub_id']]=$get_menu_data['label'];
                   $data['pageid'.$get_menu_data['sub_id']]=$get_menu_data['sub_id'];  
                   $data['pagetitle'.$get_menu_data['sub_id']]=$get_menu_data['page_title'];
                   $data['pagetitleposition'.$get_menu_data['sub_id']]=$get_menu_data['title_position'];
                   $data['mainpagetitle'.$get_menu_data['sub_id']]=$get_menu_data['browsertab'];
                }
                $data['user_aboutus_sort']=$this->modelsite->get_page_text($theme_user_id,'user_aboutus_sort');
                $data['user_contectus_sort']=$this->modelsite->get_page_text($theme_user_id,'user_contectus_sort');
                $data['user_TermCondition_sort']=$this->modelsite->get_page_text($theme_user_id,'user_TermCondition_sort');
                $data['user_aboutus_full']=$this->modelsite->get_page_text($theme_user_id,'user_aboutus_full');
                $data['user_contectus_full']=$this->modelsite->get_page_text($theme_user_id,'user_contectus_full');
                $data['user_TermCondition_full']=$this->modelsite->get_page_text($theme_user_id,'user_TermCondition_full');
                $data['user_footer']=$this->modelsite->get_page_text($theme_user_id,'user_footer');
                $data['events']=(Editpenalcontroller::viewsellerwiseEvents($theme_user_id,'events'));
                //print_r($data['events']);

                // echo "hi";
                  //  print_r($data['events']); exit;
                  // start niraj
                $data['profile_position']=$this->modelsite->get_profile_page_position($theme_user_id);
                $data['footer_position']=$this->modelsite->get_footer_position($theme_user_id);
                $data['about_position']=$this->modelsite->get_about_position($theme_user_id);
                 //end niraj
                
                
                $comment1=array('val'=>'so.`id`, so.`title`, so.url, so.image as image1, so.`status`,su.`id`, su.`user_id`, su.`social_id`, su.`link`, su.`image` as image2  ','table'=>'social_link_user as su','where'=>array("su.user_id"=>$theme_user_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'su.view','orderas'=>'asc');
                $multijoin1=array(array('table'=>'social_link as so','on'=>'su.social_id=so.id','join_type'=>''),
                );
                $data['products']=$this->editmodel->multijoin($comment1,$multijoin1);
                
//                 $data1=array('val'=>'id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus , admin_status','table'=>'events','where'=>array('user_id'=>$theme_user_id,"admin_status"=>'1','stetus'=>'1'));
//                 $data['eventdata']=$this->editmodel->getdata($data1);
//                 //print_r($data['eventdata']); exit;
//                $str="";
//                if($data['eventdata']['res']){        
//                        foreach ($data['eventdata']['rows'] as $res){
//                            //print_r($res);exit;
//                            $str.="{";
//                            $str.="id:         '".$res->id."',";
//                            $str.="title:      '".$res->event_title."',";
//                            $str.="start:      '".date("Y-m-d", strtotime($res->start_date))."',";
//                            $str.="end:        '".date("Y-m-d", strtotime("+1 day",strtotime($res->end_Date)))."',";
//                            $str.="url:         '".$res->event_link."',";
//                            $str.="color:      '".$res->event_color."'";
//                            $str.="},";
//                        }
//                $str=rtrim($str, ",");
//                }
//                else{
//                    //$str.="{title: 'No event'}";
//                }
//                //print_r($str);exit;
//                $data['events']=$str;
                //print_r($data['events']); exit;

                $data['menu']=  $this->edit_menu($theme_user_id);
                $data['session_user_id']=$theme_user_id;
                $data['user_edit_panel']=TRUE;
                //$data1['member1']=element('class_name',$data);
                //$this->load->view('theme2', $data);
                //echo "<pre>";
                //print_r($data); exit;
                
                
                
                $this->load->view('include/edit_panel/load_fileHead.php',$data);
                $this->load->view('include/edit_panel/edit_header.php',$data);
                $this->load->view('include/edit_panel/header.php',$data);
                $this->load->view('include',$data);            
                $this->load->view('include/edit_panel/footer.php',$data);
           }
	} 
       
            
        
        
        
        public function edit_menu($user_id)
        {
            $query['q2']=$this->modelsite->sub_menu(0,0,$user_id);
            $aa = "<ul>";  
            //print_r($query['q2']);
            //echo count($query['q2']);
            if(!empty($query['q2'])){
            foreach ($query['q2'] as $data)
            {     
                $aa=$aa."<li id='".$data->id."'><a href='#' > <span>".$data->label." </span></a>";
                //if($this->modelsite->sub_menu($data->sub_id,'1',$user_id)!=0)
                //{      
                    //$aa=$aa."<li id='".$data->sub_id."' class='has-sub'><a href='#' > <span>".$data->label." </span></a>"; 
                    //$query['q3']=$this->modelsite->sub_menu($data->sub_id,'1',$user_id);
                    //$aa = $aa."<ul>";                    
                    //foreach ($query['q3'] as $r_data)
                    //{
                        /*if($this->modelsite->sub_menu($r_data->sub_id,'2',$user_id)!=0)
                        { 
                            $aa=$aa."<li id='".$r_data->sub_id."' class='has-sub'><a href='".$r_data->link."' > <span>".$r_data->label." </span> </a>";
                            $query['q4']=$this->modelsite->sub_menu($r_data->sub_id,'2',$user_id);
                            $aa = $aa."<ul>"; 
                            foreach ($query['q4'] as $rr_data)
                            {
                                $aa=$aa."<li id='".$rr_data->sub_id."'><a href='".$rr_data->link."' > <span>".$rr_data->label." </span> </a></li>";
                            }
                            $aa = $aa."</ul>";
                        }
                        else 
                        {*/
                            // $aa=$aa."<li id='".$r_data->sub_id."'><a href='#' > <span>".$r_data->label." </span> </a>";
                        //}
                    
                     //$aa=$aa."</li>";
                    //}
                    //$aa = $aa."</ul>";
                //}
                //else
                //{
                //    $aa=$aa."<li id='".$data->id."'><a href='#' > <span>".$data->label." </span></a>"; 
                //}
                $aa=$aa."</li>";
            } $aa =$aa. "</ul>"; }else{
               $aa =$aa. "<li><a href='#' > <span>Double click for add menu</span></a></li></ul>"; 
            }
             
          return $aa;            
        }
}
