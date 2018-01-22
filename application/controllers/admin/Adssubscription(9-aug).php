<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adssubscription extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('table'=>'ads_subscription as assb','val'=>'u.id as userid,u.username,assb.*','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'assb.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'u.id=assb.user_id','join_type'=>'left'),
        );
       
        $adstotal=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>";
        //print_r($adstotal); exit;
        //print_r(count($recipetotal['rows']));exit;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/ads_subs/";
         if($adstotal['res']){
        $config["total_rows"] = count($adstotal['rows']);}
		else{$config["total_rows"] ="";
		}
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        $resp['categorylist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
       
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/ads_subs/admin_vw_ads_subs',$resp);
        $this->load->view('admin/include/admin_footer');
    }
     
    public function search(){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $comment1=array('table'=>'ads_subscription as assb','val'=>'u.id as userid,u.username,assb.*','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'assb.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'u.id=assb.user_id','join_type'=>'left'),
        );
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
//echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/adssubscription/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['categorylist']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['categorylist']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
      
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/ads_subs/admin_vw_ads_subs',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function active(){
        $selectedid=$this->input->post("selectedads");
        $count=count($selectedid);
        $data=array("table"=>"ads_subscription","val"=>array("status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Ads(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedads");
        $count=count($selectedid);
        $data=array("table"=>"ads_subscription","val"=>array("status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Ads(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
} 
