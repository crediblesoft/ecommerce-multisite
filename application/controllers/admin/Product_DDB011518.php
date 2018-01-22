<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.date,p.admin_status,p.taxable_status,cat.category,u.username,sum(o.quantity) as sold,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>array('bid_status'=>'0'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'sub_category as scat','on'=>'p.category_sub=scat.sub_catid','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'order_detail_form as o','on'=>'o.product_id=p.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/product/?";
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
        //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/product/admin_vw_product',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    
    public function details($id){
        
        $comment1=array('val'=>'p.id,p.prod_name,p.date,p.weight,p.weight_unit,p.length,p.width,p.height,p.die_unit,p.no_of_prod,p.pord_detail,p.prod_img,p.prod_price,p.status,p.admin_status,p.taxable_status,p.local_shipping,u.username,u.id as userid,u.type_Of_User,cat.category,cat.category,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>array('p.id'=>$id,'bid_status'=>'0'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
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
        $this->load->view('admin/product/admin_vw_product_details',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function search(){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        if($searchby=='seller'){
            //if($val==''){$where=array('bid_status'=>'0');}else{$where=array("p.user_id"=>$val,'bid_status'=>'0');}
            //$comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.date,p.admin_status,cat.category,u.username,sum(o.quantity) as sold','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array());
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.taxable_status,p.date,p.admin_status,cat.category,u.username,sum(o.quantity) as sold,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>array('bid_status'=>'0'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		else if($searchby=='subscribe'){
            if($val==''){$where=array('bid_status'=>'0','u.paid'=>'1');}else{$where=array("p.user_id"=>$val,'bid_status'=>'0');}
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.date,p.taxable_status,p.admin_status,cat.category,u.username,sum(o.quantity) as sold,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array());
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		
		else if($searchby=='unsubscribe'){
            if($val==''){$where=array('bid_status'=>'0','u.paid'=>'0');}else{$where=array("p.user_id"=>$val,'bid_status'=>'0');}
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.date,p.taxable_status,p.admin_status,cat.category,u.username,sum(o.quantity) as sold,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array());
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		
		
            else if($searchby=='category'){
            if($val==''){$where=array('bid_status'=>'0');}else{$where=array("p.category"=>$val,'bid_status'=>'0');}
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.date,p.taxable_status,p.admin_status,cat.category,u.username,sum(o.quantity) as sold,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array());
            //$comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.date,p.admin_status,cat.category,u.username,sum(o.quantity) as sold','table'=>'product as p','where'=>array('bid_status'=>'0'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array("likeon"=>"cat.category","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }else if($searchby=='productname'){
            $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.date,p.taxable_status,p.admin_status,cat.category,u.username,sum(o.quantity) as sold,scat.sub_catid,scat.sub_category','table'=>'product as p','where'=>array('bid_status'=>'0'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array("likeon"=>"prod_name","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }else if($searchby=='adddate'){
            $from=$this->input->get('from');
            $to=$this->input->get('to');
            $resp=$this->searchbydate(trim($from),trim($to),$searchby);
        }else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/product","refresh");
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/product/admin_vw_product',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function searchbyother($val,$comment1,$searchby){
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'sub_category as scat','on'=>'p.category_sub=scat.sub_catid','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
			array('table'=>'order_detail_form as o','on'=>'o.product_id=p.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/product/search?searchby=$searchby&val=$val";
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

    public function searchbydate($from,$to,$searchby){
        $where=array('bid_status'=>'0');
        $comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.no_of_Prod,p.date,p.taxable_status,p.admin_status,cat.category,u.username,sum(o.quantity) as sold','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"between"=>array('col'=>'p.date','from'=>$from,'to'=>$to),"in_value"=>array());
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
			array('table'=>'order_detail_form as o','on'=>'o.product_id=p.id','join_type'=>'left'),
        );
        $table=$this->common->multijoin_between($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/product/search?searchby=$searchby&from=$from&to=$to";
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
	
	public function getallpaidusers(){
            $val=array('id','username');
            $where=array("type_Of_User"=>"1","paid"=>"1","status"=>"1");
            $sellers=$this->getsellers($val,$where);
            echo json_encode($sellers);
    }
    
    
    public function getallusers(){
            $val=array('id','username');
            $where=array("status"=>"1");
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
    
} 
