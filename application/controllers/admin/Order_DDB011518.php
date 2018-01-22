<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    public function index(){
        $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('payment_for'=>'product'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/order/?";
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
        $this->load->view('admin/order/admin_vw_order',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function details($id){
       $data=array("table"=>"transaction","val"=>"payment_for","where"=>array("id"=>$id));
       $payment_for=$this->common->getsinglerow($data);
        //print_R($payment_for);exit;
        
		
		
		
        $comment2=array('val'=>'t.*,u.username,u.f_name,u.l_name,u.id as buyerId,u.email_id,u.mobile_no','table'=>'transaction as t','where'=>array("t.id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        if($payment_for['rows']->payment_for=='bidproduct'){
            $multijoin2=array( 
                array('table'=>'bid_tbl_cart as btc','on'=>'t.order_id=btc.auction','join_type'=>'left'),
                array('table'=>'user_Info as u','on'=>'btc.user_id=u.id','join_type'=>'left'),
            );
        }else{
            $multijoin2=array( array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'), );
        }
        
        $resp['transdetails']=$this->common->multijoin($comment2,$multijoin2);
		  //echo $this->db->last_query();
		 //echo '<pre>';
         // print_r($resp);exit;
        $trans_id=$resp['transdetails']['rows'][0]->trans_id;
        
		//For billing info(8th April 2016)
		$que=array('val'=>'*','where'=>array('trans_id'=>$trans_id),'table'=>'billing_address');
		$resp['billinginfo']=$this->common->get_where($que);
		//For billing info
		
        
        $where3=array('tax.trans_id'=>$trans_id);
        $comment3=array('val'=>'tax.*,u.username,u.f_name,u.l_name,u.id as sellerid','table'=>'transaction_sellers as tax','where'=>$where3,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'tax.id','orderas'=>'DESC');
        $multijoin3=array(
           array('table'=>'user_Info as u','on'=>'tax.seller_id=u.id','join_type'=>'left'),
        );
        $resp['taxdetails']=$this->common->multijoin($comment3,$multijoin3);
        
        
        
        $comment1=array('val'=>'o.id,o.price,o.quantity,o.status,p.id as prodId,p.prod_name,p.bid_status,u.username,u.f_name,u.l_name,u.id as sellerId','table'=>'order_detail_form as o','where'=>array('trans_id'=>$trans_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/order/?";
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
        //print_r($resp['products']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/order/admin_vw_order_details',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function search(){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val');$val=trim($val);
        ///echo "thr".$val;exit;
        if($searchby=='transid'){
            $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('payment_for'=>'product'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"t.trans_id","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		
		else if($searchby=='amount'){
            $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('payment_for'=>'product','price'=>$val),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array());
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
			//echo $this->db->last_query();exit;
        }
		
		else if($searchby=='buyer'){
            $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('payment_for'=>'product'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby);
        }
		
		else if($searchby=='seller'){
            $comment1=array('val'=>'o.trans_id','table'=>'order_detail_form as o','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'o.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
			$multijoin1=array(
				array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
				array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
			);
			$table=$this->common->multijoin_with_like($comment1,$multijoin1);
			if($table['res'])
			{
				$trans_ids=array();
				foreach($table['rows'] as $key)
				{
					array_push($trans_ids,$key->trans_id);
				}
				$comment2=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('payment_for'=>'product'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC','in'=>'t.trans_id','in_value'=>$trans_ids);
			    $resp=$this->searchbymore(trim($val),$comment2,$searchby);
			}
			else
			{
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
				$comment2=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('payment_for'=>'product'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC','in'=>'t.trans_id','in_value'=>$trans_ids);
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
            redirect("admin/order","refresh");
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/order/admin_vw_order',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function searchbyother($val,$comment1,$searchby){
        $multijoin1=array( array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),);
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/order/search?searchby=$searchby&val=$val";
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
        $config["base_url"] = BASE_URL. "admin/order/search?searchby=$searchby&val=$val";
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
        $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"between"=>array('col'=>'t.date','from'=>$from,'to'=>$to),"in_value"=>array());
        $multijoin1=array( array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),);
        $table=$this->common->multijoin_between($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/order/search?searchby=$searchby&from=$from&to=$to";
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

    public function changestatus(){
        $orderid=$this->input->post("orderid");
        $status=$this->input->post("status");
        $data=array('table'=>'order_detail_form','where'=>array('id'=>$orderid),'val'=>array('status'=>$status));                
        $log=$this->common->update_data($data);
       
        $comment1=array('val'=>'p.user_id as seller_id,o.*','table'=>'order_detail_form as o','where'=>array('o.id'=>$orderid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'o.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        $tto=$table['rows'][0]->seller_id;
        $tran_id=$table['rows'][0]->trans_id;
        $orderstatus=$table['rows'][0]->status;
        if($orderstatus==1){$newstatus="Received";}
        else if($orderstatus==2){$newstatus="Processed";}
        else if($orderstatus==3){$newstatus="Shipped";}
        else if($orderstatus==4){$newstatus="Delivered";}
        else{$newstatus="Canceled";}
        
        $to=$table['rows'][0]->buyerId;
        //$to=$this->session->userdata('user_id');
        $from='0';
        $subject="Order Status";
        $message='<table>
             <tr>
              <h4>Your order is '.$newstatus.' for this Transation id(buyer):-'.$tran_id.'</h4>
             </tr>
             </table>';
        $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
        $inserted_id=$this->common->add_data_get_id($maildata);

        if($inserted_id){
             $mailtodata=array("table"=>'mail_to',"val"=>array("mail_from"=>$inserted_id,"mail_to"=>$to));
             $log = $this->common->add_data($mailtodata);
        }
        
        //seller mail
        $from1='0';
        $subject1="Order Status";
        $message1='<table>
             <tr>
              <h4>Your order is '.$newstatus.' for this Transation id(seller):-'.$tran_id.'</h4   >
             </tr>
             </table>';
        $maildata1=array("table"=>"mail","val"=>array("mail_from"=>$from1,"subject"=>$subject1,"message"=>$message1,"timestamp"=>time()));
        $inserted_id1=$this->common->add_data_get_id($maildata1);

        if($inserted_id1){
             $mailtodata1=array("table"=>'mail_to',"val"=>array("mail_from"=>$inserted_id1,"mail_to"=>$tto));
             $log = $this->common->add_data($mailtodata1);
        }
        if($log){
          echo json_encode(array('status'=>true,'message'=>"Status changed."));

        }else{
            echo json_encode(array('status'=>false,'message'=>"Nothing to be changed."));
        }
    }

    
} 
