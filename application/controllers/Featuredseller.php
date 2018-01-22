<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Featuredseller extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->functions->_afterloginpage_delete();
    }
    
    public function index()
    {   
        $comment1=array('val'=>'u.id,u.username,u.f_name,u.l_name,u.profile_Pic,si.business_name,si.address,si.zip,GROUP_CONCAT(bt.category SEPARATOR ",") as business_type','table'=>'user_Info as u','where'=>array("u.type_Of_User"=>'1',"u.featured"=>'1', "u.status"=>'1'),'minvalue'=>'','group_by'=>'u.id','start'=>'','orderby'=>'u.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_store_info as si','on'=>'u.id=si.user_id','join_type'=>''),
            array('table'=>'user_business_type as ubt','on'=>'u.id=ubt.user_id','join_type'=>''),
            array('table'=>'category as bt','on'=>'ubt.business_id=bt.id','join_type'=>''),
        );
        //for ads
        //$comment3=array('table'=>'ads_subscription as assb','val'=>'u.id as userid,u.username,assb.*','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'assb.id','orderas'=>'DESC');
        $comment3="SELECT ads.*,uifo.id as seller_id,uifo.username FROM ads_subscription as ads LEFT JOIN user_Info as uifo on ads.user_id=uifo.id  where ads.paid_status='1' AND ads.status='1' ORDER BY RAND()  limit 0,1";
        $resp['ads']=$this->common->dbQuery($comment3);
        //echo "<pre>";
        //print_r($resp); exit;
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "featuredseller";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['featureduser']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        $this->load->view('include/header');
        $this->load->view('featured/vw_featuredseller',$resp);
        $this->load->view('include/footer');
    }

}
