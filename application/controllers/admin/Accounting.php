<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->_screen_security_admin('Manage Accounting');
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    public function index(){
        $comment1=array('val'=>'ts.*,u.username','table'=>'transaction_sellers as ts','where'=>array(),'minvalue'=>'','group_by'=>'ts.id','start'=>'','orderby'=>'ts.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'ts.seller_id=u.id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        
		//echo $this->db->last_query();exit;
		
        $config = array();
        $config["base_url"] = BASE_URL. "admin/accounting/?";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $trans_id=$resp['products']['rows'][0]->trans_id;  

        //print_r($resp['products']['rows']);exit;
		$resp['users']=$this->getsellers(array('username','id'),array('type_Of_User'=>'1','status'=>'1'));
		
		
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/accounting/admin_vw_accounting',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    

    
    
    public function search(){
        $seller_id=$this->input->get('users');
		$from=$this->input->get('from');
        $to=$this->input->get('to');
            
	    $comment1=array('val'=>'ts.*,u.username','table'=>'transaction_sellers as ts','where'=>array('seller_id'=>$seller_id),'minvalue'=>'','group_by'=>'ts.id','start'=>'','orderby'=>'ts.id','orderas'=>'DESC',"between"=>array('col'=>'ts.tansdatetime','from'=>$from,'to'=>$to),"in_value"=>array());
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'ts.seller_id=u.id','join_type'=>'left'),
        );
        $table['products']=$this->common->multijoin_between($comment1,$multijoin1);
		
		
		//print_r($table);exit;
		$table['users']=$this->getsellers(array('username','id'),array('type_Of_User'=>'1','status'=>'1'));
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/accounting/admin_vw_accounting',$table);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function searchbyother($val,$comment1,$searchby){
        $multijoin1=array( 
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
             array('table'=>'order_detail_form as odf','on'=>'odf.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'user_Info as u2','on'=>'odf.buyerid=u2.id','join_type'=>'left'),
            );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/transaction/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        return $resp;
    }
	
	
	public function searchbymore($val,$comment1,$searchby){
        $multijoin1=array( array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
                        array('table'=>'order_detail_form as odf','on'=>'odf.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'user_Info as u2','on'=>'odf.buyerid=u2.id','join_type'=>'left'),
            );
        $table=$this->common->multijoin_with_in($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/transaction/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin_with_in($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        return $resp;
    }
	

    public function searchbydate($from,$to,$searchby){
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username,u2.username as user2','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"between"=>array('col'=>'t.date','from'=>$from,'to'=>$to),"in_value"=>array());
        $multijoin1=array(
             array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
              array('table'=>'order_detail_form as odf','on'=>'odf.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'user_Info as u2','on'=>'odf.buyerid=u2.id','join_type'=>'left'),
        );
        $table=$this->common->multijoin_between($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/transaction/search?searchby=$searchby&from=$from&to=$to";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin_between($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($resp['products']['rows']);exit;  
        //echo "aa";exit;
        return $resp;   
    }

    
} 
