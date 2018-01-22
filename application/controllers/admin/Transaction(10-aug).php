<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    public function index(){
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
        );
        
        
        $table=$this->common->multijoin($comment1,$multijoin1);
           
        $config = array();
        $config["base_url"] = BASE_URL. "admin/transaction/?";
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
        $this->load->view('admin/transaction/admin_vw_transaction',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function details($id){ // campaign payment details transctionwise.. for order check order details
        $comment2=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for','table'=>'transaction as t','where'=>array('t.id'=>$id),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin2=array();
        $resp['transdetails']=$this->common->multijoin($comment2,$multijoin2);
        $trans_id=$resp['transdetails']['rows'][0]->trans_id;  
        $payment_for=$resp['transdetails']['rows'][0]->payment_for;
        
        $where3=array('tax.trans_id'=>$trans_id);
        $comment3=array('val'=>'tax.*,u.f_name,u.l_name,u.id as sellerid','table'=>'transaction_sellers as tax','where'=>$where3,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'tax.id','orderas'=>'DESC');
        
        $multijoin3=array(
           array('table'=>'user_Info as u','on'=>'tax.seller_id=u.id','join_type'=>'left'),
            
        );
         
        $resp['taxdetails']=$this->common->multijoin($comment3,$multijoin3);
        //print_r($resp);exit;
        //echo $this->db->last_query();exit;
        
        if($payment_for=='campeign')
        {        
            $comment1=array('val'=>'cp.price,cp.date,cp.name,u.f_name,u.l_name,u.email_id,u.mobile_no,u.id as supporterid,c.campaign_titel,c.id as campaignid','table'=>'campaign_payment_detail as cp','where'=>array('trans_id'=>$trans_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cp.id','orderas'=>'DESC');
            
            $multijoin1=array(
                array('table'=>'campaign_detail as c','on'=>'cp.campaign_id=c.id','join_type'=>'left'),
                array('table'=>'user_Info as u','on'=>'cp.buyerId=u.id','join_type'=>'left'),
            );
        }else if($payment_for=='user'){
            $comment1=array('val'=>'u.f_name,u.l_name,u.email_id,u.mobile_no,u.id as sellerid','table'=>'user_payment as up','where'=>array('tranc_id'=>$trans_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'up.user_id=u.id','join_type'=>'left'),
            );
        }
        else if($payment_for=='ads'){
            $comment1=array('val'=>'u.f_name,u.l_name,u.email_id,u.mobile_no,u.id as sellerid,ad_subs.*','table'=>'user_payment as up','where'=>array('tranc_id'=>$trans_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC');
             
            $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'up.user_id=u.id','join_type'=>'left'),
                array('table'=>'ads_subscription as ad_subs','on'=>'u.id=ad_subs.user_id','join_type'=>'left'),
            );
            //echo $this->db->last_query(); exit;
        //    echo "<pre>";
          //  print_r($multijoin1); exit;
        }
        $resp['campaign']=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>"; print_r($resp); exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/transaction/admin_vw_camp_trans_details',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function search(){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val');$val=trim($val);
        if($searchby=='paymentfor'){
            if($val=='1'){$where=array('t.payment_for'=>'product');}else if($val=='2'){$where=array('t.payment_for'=>'campeign');}else if($val=='3'){$where=array('t.payment_for'=>'user');}else{$where=array();}
            $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username','table'=>'transaction as t','where'=>$where,'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array());
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		else if($searchby=='transid'){
            $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"t.trans_id","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		
		else if($searchby=='amount'){
            $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username','table'=>'transaction as t','where'=>array('price'=>$val),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array());
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		
		else if($searchby=='address'){
			
                    // $query="select * from transaction where (payment_for='product' or payment_for='bidproduct') and (street Like '%".$val."%' OR city Like '%".$val."%' OR state Like '%".$val."%' OR zipCode Like '%".$val."%')";
                       $query="SELECT t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id, u.username FROM transaction AS t LEFT JOIN user_Info AS u ON t.id = u.id where (t.payment_for='product' or t.payment_for='bidproduct') and (t.street Like '%".$val."%' OR t.city Like '%".$val."%' OR t.state Like '%".$val."%' OR t.zipCode Like '%".$val."%')";

                         $result=$this->db->query($query);
                         
             $data=$result->result();
			 //echo $this->db->last_query();exit;
			
			 
			 if(!empty($data)){
			 $resp['products']['res']=true;
             //$toatal=$result->result();
			 
		    $config = array();
			$config["base_url"] = BASE_URL. "admin/transaction/search?searchby=$searchby&val=$val";
			$config["total_rows"] = ($resp['products']['res'])?count($data):0;
			$config["per_page"] = 20;
			$config["uri_segment"] = $this->input->get('per_page');
			$config['page_query_string']=true;
			$this->pagination->initialize($config); 
			//$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
			//$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
			//$query1="select * from transaction where (payment_for='product' or payment_for='bidproduct') and (street Like '%".$val."%' OR city Like '%".$val."%' OR state Like '%".$val."%' OR zipCode Like '%".$val."%') Limit $page,20";
                         $query1="SELECT t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id, u.username FROM transaction AS t LEFT JOIN user_Info AS u ON t.id = u.id where (t.payment_for='product' or t.payment_for='bidproduct') and (t.street Like '%".$val."%' OR t.city Like '%".$val."%' OR t.state Like '%".$val."%' OR t.zipCode Like '%".$val."%') Limit $page,20";
            $result1=$this->db->query($query1);
            $data1=$result1->result();
			$resp['products']['rows']=$data1;
			$resp["links"] = $this->pagination->create_links();
			$resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
			 
			 
			 }
			 else{
				 $resp['products']['res']=false;
                 $resp["links"] = '';
			 }
        }
		
		else if($searchby=='product_name'){
            $comment1=array('val'=>'o.trans_id','table'=>'order_detail_form as o','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'o.id','orderas'=>'DESC',"like"=>array("likeon"=>"p.prod_name","likeval"=>$val));
			$multijoin1=array(
				array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),	
			);
			$table=$this->common->multijoin_with_like($comment1,$multijoin1);
			if($table['res'])
			{
				$trans_ids=array();
				foreach($table['rows'] as $key)
				{
					array_push($trans_ids,$key->trans_id);
				}
				$comment2=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC','in'=>'t.trans_id','in_value'=>$trans_ids);
			    $resp=$this->searchbymore(trim($val),$comment2,$searchby);
			}
			else
			{
				$resp['products']['res']=false;
                $resp["links"] = '';
			}
        }
		
		else if($searchby=='seller'){
            $comment1=array('val'=>'o.trans_id','table'=>'order_detail_form as o','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'o.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
			$multijoin1=array(
				array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
				array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
			);
			$table=$this->common->multijoin_with_like($comment1,$multijoin1);
			
			$comment3=array('val'=>'up.tranc_id','table'=>'user_payment as up','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
			$multijoin3=array(
				array('table'=>'user_Info as u','on'=>'up.user_id=u.id','join_type'=>''),
			);
			$table3=$this->common->multijoin_with_like($comment3,$multijoin3);
			//echo '<pre>';
			//print_r($table3);exit;
		if($table['res'] || $table3['res'])
		{
				$trans_ids=array();
				if($table['res'])
				{
					foreach($table['rows'] as $key)
					{
						array_push($trans_ids,$key->trans_id);
					}
					//$comment2=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for','table'=>'transaction as t','where'=>array('payment_for'=>'product'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC','in'=>'t.trans_id','in_value'=>$trans_ids);
					//$resp=$this->searchbymore(trim($val),$comment2,$searchby);
				}
				if($table3['res'])
				{
					foreach($table3['rows'] as $key)
					{
						array_push($trans_ids,$key->tranc_id);
					}
					
				}
				
					$comment2=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC','in'=>'t.trans_id','in_value'=>$trans_ids);
					$resp=$this->searchbymore(trim($val),$comment2,$searchby);
				
		}
	   else
			{
				$resp['products']['res']=false;
                $resp["links"] = '';
			}
		}
		
		else if($searchby=='buyer'){
			$comment1=array('val'=>'o.trans_id','table'=>'order_detail_form as o','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'o.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
			$multijoin1=array(
				array('table'=>'bid_tbl_cart as bid','on'=>'o.product_id=bid.product_id','join_type'=>'left'),
				array('table'=>'user_Info as u','on'=>'bid.user_id=u.id','join_type'=>''),
			);
			$table=$this->common->multijoin_with_like($comment1,$multijoin1);
			
			
			$comment3=array('val'=>'o.trans_id','table'=>'order_detail_form as o','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'o.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
			$multijoin3=array(
				array('table'=>'user_Info as u','on'=>'o.buyerId=u.id','join_type'=>''),
			);
			$table3=$this->common->multijoin_with_like($comment3,$multijoin3);
			//echo $this->db->last_query();
			//echo '<pre>';
			//print_r($table3);exit;
			
			if($table['res'] || $table3['res'])
			{
				$trans_ids=array();
				if($table['res'])
				{
					foreach($table['rows'] as $key)
					{
						array_push($trans_ids,$key->trans_id);
					}
					//$comment2=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC','in'=>'t.trans_id','in_value'=>$trans_ids);
					//$resp=$this->searchbymore(trim($val),$comment2,$searchby);
				}
				
				if($table3['res'])
				{
					foreach($table3['rows'] as $key)
					{
						array_push($trans_ids,$key->trans_id);
					}
					
				}
				
				$comment2=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC','in'=>'t.trans_id','in_value'=>$trans_ids);
				$resp=$this->searchbymore(trim($val),$comment2,$searchby);
				
			}
				
				else
				{
					$resp['products']['res']=false;
					$resp["links"] = '';
				}
		
			
			
            
        }
		
		else if($searchby=='adddate'){
            $from=$this->input->get('from');
            $to=$this->input->get('to');
            $resp=$this->searchbydate(trim($from),trim($to),$searchby);
        }else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/transaction","refresh");
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/transaction/admin_vw_transaction',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function searchbyother($val,$comment1,$searchby){
        $multijoin1=array( array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),);
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
        $multijoin1=array( array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),);
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
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,t.order_id,u.username','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"between"=>array('col'=>'t.date','from'=>$from,'to'=>$to),"in_value"=>array());
        $multijoin1=array(
             array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
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
