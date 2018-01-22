<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidproduct extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,p.bid_start_date,p.bid_end_date,p.taxable_status,cat.category,u.username,count(btc.id) as bidcount,auc.id as auc_status,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>array('bid_status'=>'1'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'sub_category as scat','on'=>'p.category_sub=scat.sub_catid','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id and auc.status=1','join_type'=>'left'),
            array('table'=>'bid_tbl_cart as btc','on'=>'auc.id=btc.auction','join_type'=>'left'),
			
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/bidproduct/?";
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


        // echo $this->db->last_query();
        // exit;
        // //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/product/bid/admin_vw_product',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    
    public function details($id){
        
        $comment1=array('val'=>'p.id,p.prod_name,p.pord_detail,p.prod_img,p.prod_price,p.status,p.admin_status,p.bid_start_date,p.bid_end_date,p.bid_purchase_date,p.weight,p.length,p.width,p.height,p.status,p.taxable_status,p.local_shipping,u.username,u.id as userid,u.type_Of_User,cat.category,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>array('p.id'=>$id,'bid_status'=>'1'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'sub_category as scat','on'=>'p.category_sub=scat.sub_catid','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
        );  
        $resp['products']=$this->common->multijoin($comment1,$multijoin1);        
        if(!$resp['products']['res']){
                //$this->session->set_flashdata("warning","This is not valid user.");
                //redirect("404","refresh");
            echo "go to 404";
            }
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/product/bid/admin_vw_product_details',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function search(){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val');
        $val=trim($val);
        if($searchby=='seller'){
            if($val==''){$where=array('bid_status'=>'1');}else{$where=array("p.user_id"=>$val,'bid_status'=>'1');}
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,p.bid_start_date,p.bid_end_date,p.taxable_status,cat.category,u.username,count(btc.id) as bidcount,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array());
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }else if($searchby=='category'){
            if($val==''){$where=array('bid_status'=>'1');}else{$where=array("p.category"=>$val,'bid_status'=>'1');}
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,p.bid_start_date,p.bid_end_date,p.taxable_status,cat.category,u.username,count(btc.id) as bidcount,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array());
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }else if($searchby=='productname'){
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,p.bid_start_date,p.bid_end_date,p.taxable_status,cat.category,u.username,count(btc.id) as bidcount,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>array('bid_status'=>'1'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array("likeon"=>"prod_name","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }else if($searchby=='adddate'){
            $from=$this->input->get('from');
            $to=$this->input->get('to');
            $where=array('bid_status'=>'1');
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,p.bid_start_date,p.bid_end_date,p.taxable_status,cat.category,u.username,count(btc.id) as bidcount,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"between"=>array('col'=>'p.date','from'=>$from,'to'=>$to),"in_value"=>array());
            $resp=$this->searchbydate(trim($from),trim($to),$comment1,$searchby);
        }else if($searchby=='bidstartdate'){
            $from=$this->input->get('from');
            $to=$this->input->get('to');
            $where=array('bid_status'=>'1');
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,p.bid_start_date,p.bid_end_date,p.taxable_status,cat.category,u.username,count(btc.id) as bidcount,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"between"=>array('col'=>'p.bid_start_date','from'=>$from,'to'=>$to),"in_value"=>array());
            $resp=$this->searchbydate(trim($from),trim($to),$comment1,$searchby);
        }else if($searchby=='bidenddate'){
            $from=$this->input->get('from');
            $from = $from.' 23:59:59';
            $to=$this->input->get('to');
            $to = $to.' 23:59:59';
            $where=array('bid_status'=>'1');
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,p.bid_start_date,p.bid_end_date,p.taxable_status,cat.category,u.username,count(btc.id) as bidcount,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"between"=>array('col'=>'p.bid_end_date','from'=>$from,'to'=>$to),"in_value"=>array());
            $resp=$this->searchbydate(trim($from),trim($to),$comment1,$searchby);
            // print_r($resp);
            // exit;
        }else if($searchby=='running'){
            
        }else if($searchby=='bidover'){
            
        }else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/bidproduct","refresh");
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/product/bid/admin_vw_product',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function searchbyother($val,$comment1,$searchby){
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'sub_category as scat','on'=>'p.category_sub=scat.sub_catid','join_type'=>'left'),
            array('table'=>'bid_tbl_cart as btc','on'=>'p.id=btc.product_id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left')
            
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/bidproduct/search?searchby=$searchby&val=$val";
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
        // echo $this->db->last_query();
        // exit;
        return $resp;
    }

    public function searchbydate($from,$to,$comment1,$searchby){
        $multijoin1=array( 
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'bid_tbl_cart as btc','on'=>'p.id=btc.product_id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left')
            
        );
        $table=$this->common->multijoin_between($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/bidproduct/search?searchby=$searchby&from=$from&to=$to";
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

    public function getcagegory(){
        $category=$this->getcategory();
        echo json_encode($category);
    }
    
    public function getusers(){
            $val=array('id','username');
            $where=array("type_Of_User"=>"1","status"=>"1");
            $sellers=$this->getsellers($val,$where);
            echo json_encode($sellers);
    }
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"product","val"=>array("admin_status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Product(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"product","val"=>array("admin_status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Product(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
	
	public function getwinner(){
        $productid=$this->input->post("id");
        $auctionid=$this->get_auction_id($productid);
        $sql="select bid.price,u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1,t.trans_id,t.price as payment from bid_tbl_cart as bid left join user_Info as u on bid.user_id=u.id left join transaction as t on t.order_id=bid.auction where bid.auction='".$auctionid."' AND bid.price=(SELECT MAX(price) FROM bid_tbl_cart where auction='".$auctionid."')";
        $query=$this->db->query($sql);
        $result=$query->result();
		//echo $this->db->last_query(); exit;
        if($result){
            echo json_encode(array('res'=>true,'data'=>$result));
        }else{
            echo json_encode(array('res'=>false,'data'=>''));
        }
    }
    
} 
