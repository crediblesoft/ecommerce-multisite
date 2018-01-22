<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bid extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        //$this->_validForContoller();
        
        if($this->session->userdata('user_type')!=2){
            $this->invalid_usertype();
        }
    }
    
      
    public function yourbid($id){ 
        //echo $this->session->userdata('usertype');exit;
        $this->form_validation->set_rules('amt','Bid Amount','trim|required|greater_than_equal_to['.$this->input->post('starting_price').']');
        if($this->form_validation->run()){
            $amt=$this->input->post('amt');
            $prodid=$this->input->post('prodid');
            $date=time();
            $cutdate=date('Y-m-d',$date);
            //echo $cutdate;exit;
            $auctionid=$this->get_auction_id($prodid);
            $data=array("table"=>"bid_tbl_cart","val"=>array("user_id"=>$this->userid,"product_id"=>$prodid,"price"=>$amt,"add_date"=>$cutdate,"auction"=>$auctionid));
            $log=$this->common->add_data($data);
            
            if($log){
                redirect("bid/yourbid/$prodid","refresh");
            }
        }else{
            
            $comment1=array('val'=>'p.id as prodId,p.prod_name,p.prod_price,p.status,p.prod_img,auc.bid_start_date,auc.bid_end_date,auc.bid_purchase_date,cat.category','table'=>'product as p','where'=>array("p.id"=>$id,"auc.status"=>'1'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC');
            $multijoin1=array(  
                array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
                array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id','join_type'=>'left'),
            );
            $resp['products']=$this->common->multijoin($comment1,$multijoin1);
            
            $auctionid=$this->get_auction_id($id);
            $comment2=array('val'=>'bid.price,bid.add_date,u.f_name,u.l_name','table'=>'bid_tbl_cart as bid','where'=>array("bid.auction"=>$auctionid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'bid.price','orderas'=>'DESC');
            $multijoin2=array(  
                array('table'=>'user_Info as u','on'=>'bid.user_id=u.id','join_type'=>''),
            );
            
            //$resp['bid']=$this->common->multijoin($comment2,$multijoin2);
            
            $table=array("table"=>"bid_tbl_cart","where"=>array("auction"=>$auctionid));
            $config = array();
            $config["base_url"] = BASE_URL. "bid/yourbid/$id";
            $config["total_rows"] = $this->common->record_count_where($table);
            $config["per_page"] = 10;
            $config["uri_segment"] = 4;
            $this->pagination->initialize($config); 
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
            $resp['bid']=$this->common->multijoin($comment2,$multijoin2,$config["per_page"], $page);
            $resp["links"] = $this->pagination->create_links();
            $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
            
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/bid/vw_yourbid',$resp);
            $this->load->view('include/footer');
        }
    }
    
    
    public function product(){
        
        $comment1=array('val'=>'p.id as prodId,p.prod_name,p.prod_price as price,p.date as add_date,auc.bid_start_date,auc.bid_end_date','table'=>'bid_tbl_cart as bid','where'=>array('bid.user_id'=>$this->userid,"auc.status"=>"1"),'minvalue'=>'','group_by'=>'bid.product_id','start'=>'','orderby'=>'bid.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'user_Info as u','on'=>'o.buyerId=u.id','join_type'=>''),
            array('table'=>'product as p','on'=>'bid.product_id=p.id','join_type'=>'left'),
            array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id','join_type'=>'left'),
        );

        //$table=array('table'=>'bid_tbl_cart',"where"=>array('user_id'=>$this->userid),"group_by"=>"product_id");
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "bid/product";
        //$config["total_rows"] = $this->common->record_count_where($table);
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['bidproduct']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/bid/vw_bidproduct',$resp);
        $this->load->view('include/footer');
    }
    
    public function porductdetails($id){
        
        $comment1=array('val'=>'p.user_id as sellerid,p.id as prod_id,p.prod_name,p.date,p.prod_price,p.status,p.prod_img,cat.category,p.bid_status as bid,auc.id as auction_id,auc.bid_start_date,auc.bid_end_date,auc.bid_purchase_date','table'=>'product as p','where'=>array('p.id'=>$id,"auc.status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id','join_type'=>'left'),
        );
        $resp['product']=$this->common->multijoin($comment1,$multijoin1);
        
         
         $auctionid=$this->get_auction_id($id);
         
         $comment2=array('val'=>'bid.price,bid.id as bidid,bid.add_date,u.f_name,u.l_name','table'=>'bid_tbl_cart as bid','where'=>array('bid.auction'=>$auctionid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'bid.id','orderas'=>'DESC');
         $multijoin2=array(  
            array('table'=>'user_Info as u','on'=>'bid.user_id=u.id','join_type'=>''),
         );
       

        $table=array('table'=>'bid_tbl_cart','where'=>array('auction'=>$auctionid));
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
        
        
        $sql="select bid.price,bid.id as bidid,u.id as buyerid,u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1,rv.review from bid_tbl_cart as bid left join user_Info as u on bid.user_id=u.id left join buyer_review as rv on bid.id=rv.bid_id where bid.auction='".$auctionid."' AND bid.price=(SELECT MAX(price) FROM bid_tbl_cart where auction='".$auctionid."')";
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0)
        {
            $resp['winner']=array('res'=>true,'rows'=>$query->result());
        }
        else
        {
            $resp['winner']=array('res'=>false);
        }
        
//        $transdata=array("table"=>"transaction","where"=>array("order_id"=>$auctionid,"payment_for"=>'bidproduct'),"val"=> array("trans_id"));
//        $resp['trans']=$this->common->getsinglerow($transdata);
        
        $this->db->select('t.trans_id,ts.*');
        $this->db->join('transaction_sellers ts','t.trans_id=ts.trans_id','left');
        $this->db->where('order_id',$auctionid);$this->db->where('payment_for','bidproduct');
        $query1=$this->db->get('transaction t');
        if($query1 -> num_rows() > 0){$resp['trans']=array('res'=>true,'rows'=>$query1->row());}
        else{$resp['trans']=array('res'=>false);}
        //print_r($resp['trans']);exit;
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/bid/vw_bidproductdetails',$resp);
        $this->load->view('include/footer');
    }
    
    
    public function pricedetails($auctionid,$sellerid){ // price calculation with tax for bid product
        $new_zip=($this->input->post('new_zip')!='')?$this->input->post('new_zip'):0;
        $this->db->select('u.state,u.zip,s.code');
        $this->db->where(array('u.id'=>$this->session->userdata("user_id")));
        $this->db->join('statelist s','u.state=s.id');
        $buyerstate=$this->db->get('user_Info u')->row();
        
        $hassellertax=$this->db->get_where('user_tax',array('user_id'=>$sellerid))->row();
            
        $this->db->select('usi.merchant_id,u.f_name,u.l_name,pa.bid_purchase_date,p.weight,usi.zip,s.code,(max(btc.price)) as prod_total,p.user_id,if(u.state='.$buyerstate->state.',IFNULL(dt.total,"0"),"0") as tax,if(u.state='.$buyerstate->state.',dt.details,"Tax not charged") as desc,(((max(btc.price))*(if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0")))/100) as sub_total_tax,((max(btc.price))+((((max(btc.price))*(if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0")))/100))) as sub_total');
        $this->db->join('product p','pa.prod_id=p.id','left');
        $this->db->join('bid_tbl_cart btc','pa.id=btc.auction','left');
        $this->db->join('user_Info u','p.user_id=u.id','left');
        $this->db->join('user_store_info usi','u.id=usi.user_id','left');
        $this->db->join('statelist s','u.state=s.id');
        if($hassellertax) $this->db->join('user_tax dt','u.id=dt.user_id','left'); else $this->db->join('default_tax dt','u.state=dt.state_id','left');
        $this->db->where('pa.id',$auctionid);
        $this->db->group_by('pa.id');
        $results=$this->db->get('product_auction pa')->row();
	//print_r($results);exit;
	$db=$results->bid_purchase_date;
	
        $message="Sorry,this link has been expired..!!";
        if((time()-(60*60*24)) > strtotime($db))
        {
 	    $this->session->set_flashdata("sucess","This link has been expired.");
            redirect('bid/product',"refresh");
        }
        $weight=$results->weight;
        $from_state=$results->code;
        $from_zip=$results->zip;
        
        $results=(array)$results;
		
		 $to_zip=($new_zip==0)?$buyerstate->zip:$new_zip;
		 $this->session->set_userdata("shipto",$to_zip);
         $dataforship=array('weight'=>$weight,'from_state'=>$from_state,'from_zip'=>$from_zip,'to_state'=>$buyerstate->code,'to_zip'=>$to_zip);
        //$dataforship=array('weight'=>$weight,'from_state'=>$from_state,'from_zip'=>$from_zip,'to_state'=>$buyerstate->code,'to_zip'=>$buyerstate->zip);
		
        $getshipping=$this->shippingcalculator($dataforship);
        $results['shippingdetails']=$getshipping;
        $finaldata1[]=(object)$results;
        $this->session->set_userdata('productpricedetails',$finaldata1);
        $log['tax']=$finaldata1;
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/bid/vw_bidpricedetails',$log);
        $this->load->view('include/footer');
        
    }
    
    
    public function shippingcalculator($data){
        //echo "adf";exit;
        // UPS
        //$services['ups']['14'] = 'Next Day Air Early AM';
        //$services['ups']['01'] = 'Next Day Air';
        //$services['ups']['65'] = 'Saver';
        //$services['ups']['59'] = '2nd Day Air Early AM';
        //$services['ups']['02'] = '2nd Day Air';
        //$services['ups']['12'] = '3 Day Select';
        //$services['ups']['03'] = 'Ground';
        //$services['ups']['11'] = 'Standard';
        //$services['ups']['07'] = 'Worldwide Express';
        //$services['ups']['54'] = 'Worldwide Express Plus';
        //$services['ups']['08'] = 'Worldwide Expedited';
        //// USPS
        //$services['usps']['EXPRESS'] = 'Express';
        //$services['usps']['PRIORITY'] = 'Priority';
        //$services['usps']['PARCEL'] = 'Parcel';
        //$services['usps']['FIRST CLASS'] = 'First Class';
        //$services['usps']['EXPRESS SH'] = 'Express SH';
        //$services['usps']['BPM'] = 'BPM';
        //$services['usps']['MEDIA '] = 'Media';
        //$services['usps']['LIBRARY'] = 'Library';
        // FedEx
        $services['fedex']['PRIORITYOVERNIGHT'] = 'Priority Overnight';
        $services['fedex']['STANDARDOVERNIGHT'] = 'Standard Overnight';
        $services['fedex']['FIRSTOVERNIGHT'] = 'First Overnight';
        $services['fedex']['FEDEX2DAY'] = '2 Day';
        $services['fedex']['FEDEXEXPRESSSAVER'] = 'Express Saver';
        $services['fedex']['FEDEXGROUND'] = 'Ground';
        $services['fedex']['FEDEX1DAYFREIGHT'] = 'Overnight Day Freight';
        $services['fedex']['FEDEX2DAYFREIGHT'] = '2 Day Freight';
        $services['fedex']['FEDEX3DAYFREIGHT'] = '3 Day Freight';
        $services['fedex']['GROUNDHOMEDELIVERY'] = 'Home Delivery';
        $services['fedex']['INTERNATIONALECONOMY'] = 'International Economy';
        $services['fedex']['INTERNATIONALFIRST'] = 'International First';
        $services['fedex']['INTERNATIONALPRIORITY'] = 'International Priority';

        // Config
        $config = array(
                // Services
                'services' => $services,
                // Weight
                'weight' => $data['weight'], // Default = 1
                'weight_units' => 'lb', // lb (default), oz, gram, kg
                // Size
//                'size_length' => 150, // Default = 8
//                'size_width' => 112, // Default = 4
//                'size_height' => 120, // Default = 2
//                'size_units' => 'in', // in (default), feet, cm
                // From
                'from_zip' => $data['from_zip'], //97210,94040
                'from_state' => $data['from_state'], // Only Required for FedEx  CA
                'from_country' => "US",
                // To
                'to_zip' => $data['to_zip'], //55455,55455
                'to_state' => $data['to_state'], // Only Required for FedEx MN
                'to_country' => "US",

                // Service Logins
                'ups_access' => '', // UPS Access License Key
                'ups_user' => '', // UPS Username  
                'ups_pass' => '', // UPS Password  
                'ups_account' => '', // UPS Account Number
                'usps_user' => '', // USPS User Name
                'fedex_account' => '510087321', // FedEX Account Number
                'fedex_meter' => '118711956' // FedEx Meter Number 
        );        
        $this->load->library('Shippingcalculator',$config,'ship');
        $rates = $this->ship->calculate();
        foreach($rates['fedex'] as $key=>$value){if(!$value>0){unset($rates['fedex'][$key]);}}
        return $rates;
//        print "<xmp>";
//        print_r($rates);
//        print "</xmp>";
    }
    
    
}    
