<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends MY_Controller{
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->_screen_security_admin('Manage Campaign');
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    public function index(){
        $comment1=array('val'=>'','table'=>'campaign_detail as cd','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cd.id','orderas'=>'DESC');
       // print_r($comment1);
        $multijoin1=array();
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/campaign?";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['categorylist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/campaign/admin_vw_campaignlist',$log);
        $this->load->view('admin/include/admin_footer');
    }
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"campaign_detail","val"=>array("stetus"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Campaign(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"campaign_detail","val"=>array("stetus"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Campaign(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    public function delete(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"campaign_detail","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Campaign(s) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    public function campaign_details($id){
        
        $date = date('Y-m-d'); 
        //$this->functions->_valid_user();
        $comment1=array('val'=>'cpd.id, cpd.video_link,cpd.user_id, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.profile_Pic, ui.address1,ui.type_Of_User,ui.profile_Pic,ui.username,cpd.show_stetus,cpd.stetus','table'=>'campaign_detail as cpd','where'=>array("cpd.id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
        
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>'')            
        );
        
        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1);  //$this->editmodel->getbyidcampaign($id);
        
       // print_r($kdkd);
//         $data1=array('val'=>'*','table'=>'campaign_payment_detail','where'=>array('campaign_id'=>$id));
//         $data['peymentdetail']=$this->common->getdata($data1);
//         echo "<pre>";
//         print_r($data['peymentdetail']);
//         $data2=array('val'=>'*','table'=>'transaction_sellers','where'=>array());
//         $data['ts']=$this->common->getdata($data2);
//         echo "<pre>";
//         print_r($data['ts']);
//         exit;
         
       $comment2=array('val'=>'ts.commission,capd.*','table'=>'campaign_payment_detail as capd','where'=>array('capd.campaign_id'=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'capd.id','orderas'=>'DESC');
        
        $multijoin2=array(  
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=capd.trans_id','join_type'=>'')            
        );
//        echo $this->db->last_query(); exit;
        $data['peymentdetail']=$this->common->multijoin($comment2,$multijoin2); 
        //echo "<pre>";
        //print_r($data['peymentdetail']); exit;
        if($this->session->has_userdata('user_id')){
            $payemntdata=array("table"=>'campaign_payment_detail',"val"=>array('sum(price) as yourdonation '),'where'=>array('campaign_id'=>$id,'buyerId'=>$this->session->userdata('user_id')));
            $paymentdetails=$this->common->getsinglerow($payemntdata);
            $data['yourdonation']=$paymentdetails['rows']->yourdonation;
        }else{
            $data['yourdonation']=0;
        }
        $meta['meta_fb_compaigns']=$data['campaigns']['rows'][0];
        
        if($data['campaigns']['res']){
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/campaign/admin_vw_campaign_details',$data);
        $this->load->view('admin/include/admin_footer');       
        }
        else{        
            redirect("_404","refresh");     
        }
        
        
    }
    
     public function search(){
        $searchby=trim($this->input->get('searchby'));
        $val=$this->input->get('val');$val=trim($val);
        if($searchby=='productname'){
            $comment1=array('val'=>'u.username,cd.*','table'=>'campaign_detail as cd','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"like"=>array("likeon"=>"campaign_titel","likeval"=>$val));
            $log=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		
		else if($searchby=='seller'){
	
            $comment1=array('val'=>'u.username,cd.*','table'=>'campaign_detail as cd','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
            $log=$this->searchbyother(trim($val),$comment1,$searchby);
            //echo "<pre>";
            //print_r($comment1);
            //echo $this->db->last_query(); exit;
			
        }
		
		else if($searchby=='paiduser'){
			$comment1=array('val'=>'cd.*','table'=>'campaign_detail as cd','where'=>array(),'minvalue'=>'','group_by'=>'cd.id','start'=>'','orderby'=>'','orderas'=>'DESC',"like"=>array("likeon"=>"cpd.name","likeval"=>$val));
            $log=$this->searchbymore(trim($val),$comment1,$searchby);
			//echo '<pre>';
			//print_r($log);exit;
			
        }
		
		else if($searchby=='bidstartdate'){
            $from=$this->input->get('from');
            $to=$this->input->get('to');
            $where=array();
            $comment1=array('val'=>'','table'=>'campaign_detail as cd','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"between"=>array('col'=>'cd.start_date','from'=>$from,'to'=>$to),"in_value"=>array());
            $log=$this->searchbydate(trim($from),trim($to),$comment1,$searchby);
        }else if($searchby=='bidenddate'){
            $from=$this->input->get('from');
            $to=$this->input->get('to');
            $where=array();
            $comment1=array('val'=>'','table'=>'campaign_detail as cd','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC',"between"=>array('col'=>'cd.end_date','from'=>$from,'to'=>$to),"in_value"=>array());
            $log=$this->searchbydate(trim($from),trim($to),$comment1,$searchby);
        }else if($searchby=='running'){
            
        }else if($searchby=='bidover'){
            
        }else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/campaign/","refresh");
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/campaign/admin_vw_campaignlist',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function searchbyother($val,$comment1,$searchby){
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'cd.user_id=u.id','join_type'=>'left'),
	);
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/campaign/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['categorylist']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        return $log;
    }
	
	
	public function searchbymore($val,$comment1,$searchby){
        $multijoin1=array(  
            array('table'=>'campaign_payment_detail as cpd','on'=>'cpd.campaign_id=cd.id','join_type'=>'left'),
            
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/campaign/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['categorylist']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        return $log;
    }
	

    public function searchbydate($from,$to,$comment1,$searchby){
        $multijoin1=array();
        $table=$this->common->multijoin_between($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/campaign/search?searchby=$searchby&from=$from&to=$to";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['categorylist']=$this->common->multijoin_between($comment1,$multijoin1,$config["per_page"], $page);
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($log['products']['rows']);exit;  
        //echo "aa";exit;
        return $log;   
    }
    
    
}

