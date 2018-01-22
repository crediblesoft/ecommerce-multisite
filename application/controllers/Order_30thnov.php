<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
    }
    
    public function index(){
        if($this->session->userdata('user_type')=="2"){
            $this->_buyerorderview();
        }else{
            $this->_sellerorderview();
        }
    }
    
    private function _sellerorderview(){
        //echo $this->userid; exit;
        $comment1=array('val'=>'t.trans_id,(ts.total)+((ts.total*ts.tax)/100)+(ts.shippingcharge) as price,t.price as trans_price,t.date,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('p.user_id'=>$this->userid,'t.payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'o.buyerId=u.id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>$this->userid.'=ts.seller_id AND ts.trans_id=t.trans_id','join_type'=>'left'),
        );

        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "order";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['order']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo $this->db->last_query();exit;
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order',$resp);
        $this->load->view('include/footer');
    }

    private function _buyerorderview(){
        $comment1=array('val'=>'t.trans_id,t.price,t.date,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('o.buyerId'=>$this->userid,'t.payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
        );
        
//        $comment1=array('val'=>'o.id,o.status,o.price,o.quantity,o.date,p.id as prodId,p.prod_name,u.f_name,u.l_name,u.id as buyerId','table'=>'order_detail_form as o','where'=>array('o.buyerId'=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
//        $multijoin1=array(  
//            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>''),
//            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
//        );

        $table=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>";
        //print_r($table); exit;
        $config = array();
        $config["base_url"] = BASE_URL. "order";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['order']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);

        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order_buyer',$resp);
        $this->load->view('include/footer');
    }
    
    
    public function details($transid){
        $comment2=array('val'=>'t.trans_id,t.price,t.date,t.name,t.email,t.street,t.city,t.state,t.zipCode,t.payment_with,t.status','table'=>'transaction as t','where'=>array('t.trans_id'=>$transid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin2=array(
            //array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
        );
        $resp['transaction']=$this->common->multijoin($comment2,$multijoin2);
		
		//For billing info(8th April 2016)
		$que=array('val'=>'*','where'=>array('trans_id'=>$transid),'table'=>'billing_address');
		$resp['billinginfo']=$this->common->get_where($que);
		
		//For billing info
		
		
        
        $where3=array('tax.trans_id'=>$transid);if($this->session->userdata('user_type')=="1"){$where3['tax.seller_id']=$this->userid;}
        $comment3=array('val'=>'tax.*,u.f_name,u.l_name,u.id as sellerid','table'=>'transaction_sellers as tax','where'=>$where3,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'tax.id','orderas'=>'DESC');
        $multijoin3=array(
           array('table'=>'user_Info as u','on'=>'tax.seller_id=u.id','join_type'=>'left'),
        );
        $resp['taxdetails']=$this->common->multijoin($comment3,$multijoin3);
        
        $where=array('o.trans_id'=>$transid);if($this->session->userdata('user_type')=="1"){$where['p.user_id']=$this->userid;}
        $comment1=array('val'=>'o.id,o.status,o.price,o.quantity,o.date,p.id as prodId,p.prod_name,u.f_name,u.l_name,u.id as sellerId,usi.business_name','table'=>'order_detail_form as o','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'user_store_info as usi','on'=>'u.id=usi.user_id','join_type'=>''),
            
        );
        
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>";
        //print_r($table); exit;
        $config = array();
        $config["base_url"] = BASE_URL. "order/details/$transid";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['order']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);

        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order_details',$resp);
        $this->load->view('include/footer');
    }

    public function getuser(){
        $id=$this->input->post('id');
        $this->db->select('u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1,u.is_login,s.state,usi.business_name');
        $this->db->join('user_store_info usi','u.id=usi.user_id','left');
        $this->db->join('statelist s','s.id=u.state','left');
        $data=$this->db->get_where('user_Info u', array('u.id' => $id))->result();
        if($data){
            echo json_encode(array('res'=>true,'userdata'=>$data[0]));
        }else{
            echo json_encode(array('res'=>false));
        }
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
    
    
    public function porductdetails($id){
        
        $comment1=array('val'=>'p.id as prod_id,p.prod_name,p.date,p.prod_price,p.status,p.prod_img,cat.category','table'=>'product as p','where'=>array('p.id'=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
        );
        $resp['product']=$this->common->multijoin($comment1,$multijoin1);
        
         
         
         $comment2=array('val'=>'bid.price,bid.add_date,u.f_name,u.l_name','table'=>'bid_tbl_cart as bid','where'=>array('bid.product_id'=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'bid.id','orderas'=>'DESC');
         $multijoin2=array(  
            array('table'=>'user_Info as u','on'=>'bid.user_id=u.id','join_type'=>''),
         );
       

        $table=array('table'=>'bid_tbl_cart','where'=>array('product_id'=>$id));
        $config = array();
        $config["base_url"] = BASE_URL. "order/porductdetails/$id";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['bid']=$this->common->multijoin($comment2,$multijoin2,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]); 
         
          // print_r( $resp['bid']);exit;
        //$biddingdata=array('val'=>array(''),'table'=>'bid_tbl_cart','where'=>array('product_id'=>$id));
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_orderproductdetails',$resp);
        $this->load->view('include/footer');
    }
       public function search(){
         $searchby=$this->input->get('searchby');
         $val=$this->input->get('val'); $val=trim($val);
            if($searchby=='transid'){
                $this->search_transid();
            }
            elseif($searchby=='adddate'){
                $this->search_bydate();
            }
            elseif($searchby=='buyer_name'){
                $this->search_buyername();
            }
            elseif($searchby=='buyer_username'){
                $this->search_buyerusername();
            }
    }
    
    public function search_transid(){
        //echo $userid=$this->session->userdata('user_id');
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('p.user_id'=>$this->userid,'payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"t.trans_id","likeval"=>$val));
        $multijoin1=array(
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),
        );
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['order']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "order/search_transid?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['order']['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['order']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['order']['res']=false;
                 $resp["links"] = '';
			 }
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order',$resp);
        $this->load->view('include/footer');
    }
    
    public function search_bydate(){
        //echo $this->userid; exit;
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $from=$this->input->get('from');
        $to=$this->input->get('to');
        $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('p.user_id'=>$this->userid,'payment_for'=>'product',"t.date>="=>$from,"t.date<="=>$to),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        //$comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"in_value"=>array());
        $multijoin1=array( 
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),);
        $table=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['order']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "order/search_bydate?searchby=$searchby&from=$from&to=$to";
        $config["total_rows"] = ($resp['order']['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['order']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['order']['res']=false;
                 $resp["links"] = '';
			 }
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order',$resp);
        $this->load->view('include/footer');
    }
    
    public function search_buyername(){
        //echo $this->userid;
        //echo $userid=$this->session->userdata('user_id');
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $like=array(
                array("likeon"=>"u.f_name","likeval"=>$val),
                array("likeon"=>"u.l_name","likeval"=>$val),
                array("likeon"=>"CONCAT(u.f_name,' ',u.l_name)","likeval"=>$val),
                array("likeon"=>"CONCAT(u.f_name,'',u.l_name)","likeval"=>$val),
            );
        $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId,p.user_id as sellerid','table'=>'transaction as t','where'=>array('p.user_id'=>$this->userid,'payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>$like);
        $multijoin1=array(
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),
        );
        $table=$this->common->multijoin_with_con_like($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['order']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "order/search_buyername?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['order']['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['order']=$this->common->multijoin_with_con_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['order']['res']=false;
                 $resp["links"] = '';
			 }
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order',$resp);
        $this->load->view('include/footer');
    }
    
    public function search_buyerusername(){
        //echo $this->userid;
        //echo $userid=$this->session->userdata('user_id');
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId,p.user_id as sellerid','table'=>'transaction as t','where'=>array('p.user_id'=>$this->userid,'payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
        $multijoin1=array(
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'), 
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),
        );
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['order']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "order/search_buyerusername?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['order']['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['order']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['order']['res']=false;
                 $resp["links"] = '';
			 }
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order',$resp);
        $this->load->view('include/footer');
    }
    
     public function search_buyer_main(){
         $searchby=$this->input->get('searchby');
         $val=$this->input->get('val'); $val=trim($val);
            if($searchby=='transid'){
                $this->search_buyer_transid();
            }
            elseif($searchby=='adddate'){
                $this->search_buyer_bydate();
            }
          
    }
    
    public function search_buyer_transid(){
        //echo $userid=$this->session->userdata('user_id');
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
//        $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('p.user_id'=>$this->userid,'payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"t.trans_id","likeval"=>$val));
//        $multijoin1=array(
//            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
//            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
//            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),
//        );
        $comment1=array('val'=>'t.trans_id,t.price,t.date,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('o.buyerId'=>$this->userid,'t.payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"t.trans_id","likeval"=>$val));
        $multijoin1=array(  
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['order']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "order/search_buyer_transid?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['order']['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['order']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['order']['res']=false;
                 $resp["links"] = '';
			 }
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order_buyer',$resp);
        $this->load->view('include/footer');
    }
    
    public function search_buyer_bydate(){
        //echo $this->userid; exit;
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $from=$this->input->get('from');
        $to=$this->input->get('to');
//        $comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('p.user_id'=>$this->userid,'payment_for'=>'product',"t.date>="=>$from,"t.date<="=>$to),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
//        //$comment1=array('val'=>'t.id,t.order_status,t.price,t.date,t.trans_id,u.username,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array(),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"in_value"=>array());
//        $multijoin1=array( 
//            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
//            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
//            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),);
        
        $comment1=array('val'=>'t.trans_id,t.price,t.date,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('o.buyerId'=>$this->userid,'t.payment_for'=>'product',"t.date>="=>$from,"t.date<="=>$to),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['order']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "order/search_buyer_bydate?searchby=$searchby&from=$from&to=$to";
        $config["total_rows"] = ($resp['order']['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['order']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['order']['res']=false;
                 $resp["links"] = '';
			 }
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/order/vw_order_buyer',$resp);
        $this->load->view('include/footer');
    }
    
}    
