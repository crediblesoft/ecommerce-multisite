<?php

class Products extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
	$this->load->library('Geozip');
       
         
    }
    
    public function index($catid){
        //$this->send_mail_buyer();exit;
        //$this->send_mail_seller(); exit;
        $data3=array("table"=>"category","val"=>"id","where"=>array("id"=>$catid));
        $log3=$this->common->getsinglerow($data3);
        if(!$log3['res']){
            redirect("_404","refresh");
        }
        $current_date=date("Y-m-d");
        
        //get all seller who for same business type
        $comment2=array('val'=>'u.f_name,u.l_name,u.username,u.id as userid,u.profile_Pic,u.state','table'=>'user_business_type as ubt','where'=>array("ubt.business_id"=>$catid,"status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.paid','orderas'=>'DESC');
        //$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.no_of_Prod,p.bid_status,p.pord_detail,usi.certification,usi.size','table'=>'product as p','where'=>"(`p`.`category` = '$catid' AND `p`.`status` = '1' AND `p`.`no_of_Prod` > '0') AND CASE `p`.`bid_status` WHEN '1' THEN ( `auc`.`bid_end_date` >= '$current_date'  AND `auc`.`status`='1') ELSE 1=1 END ",'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'user_Info as u','on'=>'ubt.user_id=u.id','join_type'=>''),
			
        );
        $resp['sellers']=$this->common->multijoin($comment2,$multijoin2);
        //end seller list
        $comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.no_of_Prod,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username,s.state,p.bid_end_date','table'=>'product as p','where'=>array("p.category"=>$catid,"p.status"=>"1","p.no_of_Prod > "=> '0','p.admin_status'=>'1','u.status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.paid','orderas'=>'DESC');
        //$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.no_of_Prod,p.bid_status,p.pord_detail,usi.certification,usi.size','table'=>'product as p','where'=>"(`p`.`category` = '$catid' AND `p`.`status` = '1' AND `p`.`no_of_Prod` > '0') AND CASE `p`.`bid_status` WHEN '1' THEN ( `auc`.`bid_end_date` >= '$current_date'  AND `auc`.`status`='1') ELSE 1=1 END ",'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>'left'),
			array('table'=>'statelist as s','on'=>'s.id=u.state','join_type'=>'left'),
        );

	$resp['category']= $this->getcategory($catid);
        $resp['categoryid']= $catid;
        
        //for ads
        //$comment3=array('table'=>'ads_subscription as assb','val'=>'u.id as userid,u.username,assb.*','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'assb.id','orderas'=>'DESC');
        $comment3="SELECT ads.*,uifo.id as seller_id,uifo.username FROM ads_subscription as ads LEFT JOIN user_Info as uifo on ads.user_id=uifo.id  where ads.paid_status='1' AND ads.status='1' AND (ads.title!='' OR ads.html_data!='') ORDER BY RAND()  limit 0,1";
        $resp['ads']=$this->common->dbQuery($comment3);
       // echo $this->db->last_Query();
       // echo "<pre>";
       // print_r($resp); exit;
        
        
        $data=array("min"=>array("field"=>'prod_price',"as"=>'min'),"max"=>array("field"=>'prod_price',"as"=>'max'),"table"=>"product","where"=>array("category"=>$catid,"status"=>"1","no_of_Prod > "=> '0','admin_status'=>'1'));
        $resp['price']=$this->common->getminmax($data);          

        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "products/$catid";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
         //echo $this->db->last_query();  
//          echo "<pre>";
//        print_r($resp['products']);exit;

	$cookie= array(
                'name'   => 'savesearch',
                'value'  => $this->db->last_query(),
                'expire' => '86500',
            );
            $this->set_cookie($cookie);
        
            //if($resp['products']['res']){
                $this->load->view('include/header');
                $this->load->view('products/vw_product_list',$resp);
                $this->load->view('include/footer');
//            }else{
//                //redirect("_404","refresh");
//            }
        
    }
    
    public function details($prodId){        
        $data1=array("table"=>"product","val"=>"id","where"=>array("id"=>$prodId,"status"=>"1",'admin_status'=>'1'));
       $log22=$this->common->getsinglerow($data1);
       
       if(!$log22['res']){
		$this->session->set_flashdata('warning','This product does not exists any more.');
            redirect("_404","refresh");
        }        
        $current_date=date("Y-m-d");
        $comment1=array('val'=>'p.id as prod_id,p.category,p.prod_name,p.prod_price,p.no_of_Prod,p.status,p.prod_img,p.bid_status,p.pord_detail,p.bid_end_date,usi.certification,usi.size,usi.business_name,usi.address,usi.zip,u.id as userid,u.username,s.state,u.is_login as selleronline,GROUP_CONCAT(bt.category SEPARATOR ",") as business_type','table'=>'product as p','where'=>array("p.id"=>$prodId,"p.status"=>"1",'p.admin_status'=>'1','u.status'=>'1'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
	    array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
            array('table'=>'user_business_type as ubt','on'=>'u.id=ubt.user_id','join_type'=>''),
            array('table'=>'category as bt','on'=>'ubt.business_id=bt.id','join_type'=>''),
			array('table'=>'statelist as s','on'=>'s.id=u.state','join_type'=>'left'),
        );
        $resp['products']=$this->common->multijoin($comment1,$multijoin1);
        //print_r($resp['products']);exit;
        if($resp['products']['res']){
            $catid=$resp['products']['rows'][0]->category;
            
            $comment2=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.bid_status,p.pord_detail,p.bid_end_date,usi.certification,usi.size','table'=>'product as p','where'=>array("p.category"=>$catid,"p.status"=>"1","p.no_of_Prod > "=> '0','p.admin_status'=>'1','u.status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.paid','orderas'=>'DESC');
            $multijoin2=array(  
                array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
                array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
            );
            $resp['related']=$this->common->multijoin($comment2,$multijoin2,4, 0);
            $meta['meta_fb']=$resp['products']['rows'][0];
        }else{
            redirect("_404","refresh");
        }
        
        //echo $this->db->last_query();
        //print_r($resp);exit;
        
        $this->load->view('include/header',$meta);
        $this->load->view('products/vw_product_details',$resp);
        $this->load->view('include/footer');
    }
    
    
    private function _currentavailproduct($prodId,$qty=1,$page=NULL){
        if (count($this->cart->contents())>0){
                    foreach ($this->cart->contents() as $item){
                        if ($item['id']==$prodId){
                            $qty=$qty+$item['qty'];
                            break;
                        }
                    }   

        }
        
        $get_product=$this->get_product_details($prodId);
        $avai_pro=$get_product['rows'][0]->no_of_Prod;
        //print_r($get_product);
        if($get_product['rows'][0]->no_of_Prod < $qty){ 
            $this->session->set_flashdata("warning","Currently $avai_pro item available so you can not order more than $avai_pro.");
            
            if($page==NULL){
                redirect("products/".$get_product['rows'][0]->category,"refresh");
            }else{ 
                redirect("products/details/$prodId","refresh");
            }
        }
    }
    
    
    public function addtocart($prodId,$qty=1,$page=NULL){
        //echo $prodId;
	if($this->session->has_userdata("user_id"))
        $this->is_buyer();
        $this->_currentavailproduct($prodId,$qty,$page);
        
        //for buyer state
        $this->db->select('u.state,u.zip,s.code');
        $this->db->where(array('u.id'=>$this->session->userdata("user_id")));
        $this->db->join('statelist s','u.state=s.id');
        $buyerstate=$this->db->get('user_Info u')->row();
        
        //$comment1=array('val'=>'u.id as sellerid,u.f_name,u.l_name,IF(p.taxable_status="1"if(u.state='.$buyerstate->state.',IFNULL(dt.total,"0"),ut.total,"0") as sellertax,p.id as prod_id,p.prod_name,p.local_shipping,p.prod_price,p.prod_img,cat.category,cat.id as catid','table'=>'product as p','where'=>array("p.id"=>$prodId),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $comment1=array('val'=>'u.id as sellerid,u.f_name,u.l_name,IF(p.taxable_status="1",if(u.state='.$buyerstate->state.',IFNULL(ut.total,"dt"),"0"),"0") as sellertax,dt.total as defaulttax ,p.id as prod_id,p.prod_name,p.local_shipping,p.prod_price,p.prod_img,cat.category,cat.id as catid','table'=>'product as p','where'=>array("p.id"=>$prodId),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'user_tax as ut','on'=>'u.id=ut.user_id','join_type'=>'left'),
            array('table'=>'default_tax as dt','on'=>'u.state=dt.state_id','join_type'=>'left'),
        );
        //if($hassellertax) $this->db->join('user_tax dt','u.id=dt.user_id','left'); else $this->db->join('default_tax dt','u.state=dt.state_id','left');
        $resp=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>";
        //print_r($resp);exit;
        
        $product=$resp['rows'][0];
        if($product->sellertax=='dt'){
            $sellertax=$product->defaulttax;
        }else{$sellertax=$product->sellertax;}
        $data=array(
        'id'      => $product->prod_id,
        'qty'     => $qty,
        'price'   => $product->prod_price,
        'name'    => $product->prod_name,
        'local_shipping' => $product->local_shipping,    
        'options' => array('Category' => $product->category,'image'=> $product->prod_img,'sellerid'=>$product->sellerid, 'sellername' => $product->f_name.' '.$product->l_name,'local_shipping'=>$product->local_shipping,'sellertax'=>$sellertax)
        );
        //echo "<pre>";
        //print_r($data);exit;
        $add=$this->cart->insert($data);
//echo "contr";exit;
//echo $add;
//if($add){echo "testing";exit;}else{echo "get some error";exit;}
	if($add){
        $this->session->set_flashdata("sucess","$product->prod_name added in your cart successfully.");
	}else{
	$this->session->set_flashdata("warning","$product->prod_name not added in your cart.");
	}
        if($page==NULL){
            redirect("products/$product->catid","refresh");
        }else{
            redirect("products/details/$prodId","refresh");
        }
    }
    
    
    public function viewcart(){
        
        //print_r($this->cart->contents()); exit;
	//if($this->session->has_userdata("user_id"))
        $new_zip=($this->input->post('new_zip')!='')?$this->input->post('new_zip'):0;
        $this->_checkvalid("products/viewcart");
        $this->is_buyer();
        // caculation according to seller and buyer tax 
        $allproduct=array(); foreach($this->cart->contents() as $item){ array_push($allproduct, $item['id']); }
        $log['tax']=$this->tax_calculation($allproduct,$new_zip);
//        echo "<pre>";
//        print_r($log); exit;
        $this->load->view('include/header');
        $this->load->view('products/vw_cart',$log);
        $this->load->view('include/footer');
    }
    
    
    
    public function tax_calculation($allproduct=array(),$new_zip){ // $allproduct means all product id that included in order
        //$this->db->select('u.f_name,u.l_name,sum(p.prod_price) as prod_total,p.user_id,dt.total as tax,dt.details as desc,((sum(p.prod_price)*dt.total)/100) as sub_total_tax,(sum(p.prod_price)+(sum(p.prod_price)*dt.total)/100) as sub_total');
        //$this->db->select('u.f_name,u.l_name,sum(p.prod_price) as prod_total,p.user_id,if(u.state!=1,dt.total,"0") as tax,if(u.state!=1,dt.details,"Tax not charged") as desc,if(u.state !=1,dt.total,"0") as taxinp,(((SELECT prod_total)*(SELECT taxinp))/100) as sub_total_tax,((SELECT prod_total)+(SELECT sub_total_tax)) as sub_total');
        if(empty($allproduct)){return array();}
//        $this->db->select('usi.merchant_id,u.f_name,u.l_name,sum(p.prod_price) as prod_total,p.user_id,if(u.state!=1,dt.total,"0") as tax,if(u.state!=1,dt.details,"Tax not charged") as desc,if(u.state !=1,dt.total,"0") as taxinp,((sum(p.prod_price)*(if(u.state !=1,dt.total,"0")))/100) as sub_total_tax,(sum(p.prod_price)+(((sum(p.prod_price)*(if(u.state !=1,dt.total,"0")))/100))) as sub_total');
//        $this->db->join('user_Info u','p.user_id=u.id','left');
//        $this->db->join('user_store_info usi','u.id=usi.user_id','left');
//        //$this->db->join('statelist s','u.state=s.id');
//        $this->db->join('default_tax dt','u.state=dt.state_id','left');
//        $this->db->where_in('p.id',$allproduct);
//        $this->db->group_by('p.user_id');
//        $result=$this->db->get('product p')->result();
        
       //echo "<pre>"; print_R($result);exit;
        //echo $this->db->last_query();
        $this->db->select('u.state,u.zip,s.code');
        $this->db->where(array('u.id'=>$this->session->userdata("user_id")));
        $this->db->join('statelist s','u.state=s.id');
        $buyerstate=$this->db->get('user_Info u')->row();
        //print_r($buyerstate);exit;
        $this->db->select('user_id');$this->db->where_in('id',$allproduct);$this->db->group_by('user_id');$users=$this->db->get('product')->result();
       // print_r($users);
        foreach($this->cart->contents() as $item){
            $productoption=$this->cart->product_options($item['rowid']);
            $hassellertax=$this->db->get_where('user_tax',array('user_id'=>$productoption['sellerid']))->row();
            //echo $this->db->last_query();
            //if($hassellertax){echo "got record";}else{echo "no";}
            //print_r($hassellertax);
            $this->db->select('usi.merchant_id,u.f_name,u.l_name,p.taxable_status,p.weight,(p.local_shipping*'.$item['qty'].') as ttl_local_shipping,usi.zip,s.code,(p.prod_price*'.$item['qty'].') as prod_total,p.user_id,if(p.taxable_status="1",if(u.state='.$buyerstate->state.',IFNULL(dt.total,"0"),"0"),"0") as tax,if(u.state='.$buyerstate->state.',dt.details,"Tax not charged") as desc,(((p.prod_price*'.$item['qty'].')*(if(p.taxable_status="1",if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0"),"0")))/100) as sub_total_tax,((p.prod_price*'.$item['qty'].')+((((p.prod_price*'.$item['qty'].')*(if(p.taxable_status="1",if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0"),"0")))/100))) as sub_total');
            $this->db->join('user_Info u','p.user_id=u.id','left');
            $this->db->join('user_store_info usi','u.id=usi.user_id','left');
            $this->db->join('statelist s','u.state=s.id');
            if($hassellertax) $this->db->join('user_tax dt','u.id=dt.user_id','left'); else $this->db->join('default_tax dt','u.state=dt.state_id','left');
            $this->db->where('p.id',$item['id']);
            $this->db->group_by('p.id');
            $results[]=$this->db->get('product p')->row();
            //echo $this->db->last_query(); echo "</br></br></br>";
        }
        //echo "<pre>";print_r($results);exit;
        foreach($users as $user){
            //echo "<pre>"; print_r($user);
            $finaldata=array();
            $finaldata['local_shipping']=0;$finaldata['prod_total']=0;$finaldata['sub_total_tax']=0;$finaldata['sub_total']=0;$weight=0;$finaldata['tax']=0;$finaldata['taxable_status']=0;
            foreach($results as $result){
                //echo "<pre>";print_r($result);
               // echo "check".$result->taxable_status;
                if($user->user_id==$result->user_id){
                    $weight+=$result->weight;
                    $from_state=$result->code;
                    $from_zip=$result->zip;
                    $finaldata['merchant_id']=$result->merchant_id;
                    $finaldata['f_name']=$result->f_name;
                    $finaldata['l_name']=$result->l_name;
                    $finaldata['prod_total']+=$result->prod_total;
                    $finaldata['local_shipping']+=$result->ttl_local_shipping;
                    $finaldata['user_id']=$result->user_id;
                    $finaldata['tax']+= $result->tax;
                    $finaldata['desc']=$result->desc;
                    $finaldata['sub_total_tax']+=$result->sub_total_tax;
                    $finaldata['sub_total']+=$result->sub_total;
                    $finaldata['taxable_status']+=$result->taxable_status;
                }
            } 
            //echo "<pre>";
           // print_r($finaldata); 
            // 5 Apr 2016
            $to_zip=($new_zip==0)?$buyerstate->zip:$new_zip;
            //$to_zip=($new_zip==0)?$buyerstate->zip:($this->session->has_userdata("shipto"))?$this->session->userdata("shipto"):$new_zip;
            $this->session->set_userdata("shipto",$to_zip);
            $dataforship=array('weight'=>$weight,'from_state'=>$from_state,'from_zip'=>$from_zip,'to_state'=>$buyerstate->code,'to_zip'=>$to_zip);
            //echo "<pre>";print_r($dataforship); 
            $getshipping=$this->shippingcalculator($dataforship);
            //echo "<pre>"; print_r($getshipping);
            $finaldata['shippingdetails']=$getshipping;
           // $finaldata['shippingdetails']=array('fedex'=>array());
            $finaldata1[]=(object)$finaldata;
            
        //echo "<pre>";
        //print_r($dataforship);
        //print_r($finaldata);
        }
        
        //exit;
        $this->session->set_userdata('productpricedetails',$finaldata1);
        if($finaldata1) return $finaldata1; else return array();
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
        //print "<xmp>";
        //print_r($rates);
        //print "</xmp>";exit;
    }

    
    public function updatecart(){
        //echo "<pre>";
//echo count($this->input->post());
        //print_r($this->input->post());
        $allcart=$this->cart->contents();
//echo count($allcart);
//print_r($allcart);exit;
        for($i=1;$i<=count($allcart);$i++){
            //echo $i;
            $item=$this->input->post()[$i];
            $rowid=$item['rowid'];
            $prodId=$allcart[$rowid]['id'];
            $qty=$item['qty'];
            $category=$allcart[$rowid]['options']['Category'];
            $product=$allcart[$rowid]['name'];
            $get_product=$this->get_product_details($prodId);
            $avai_pro=$get_product['rows'][0]->no_of_Prod;   
            if($avai_pro < $qty){
                if($avai_pro<=0){
                $this->session->set_flashdata("warning","$product of $category is out of stock so please remove this item form your cart");    
                }else{
                $this->session->set_flashdata("warning","Currently $avai_pro item available for $product of $category so you can not order more than $avai_pro.");
                }
                redirect("products/viewcart","refresh"); 
                exit;
           }
               
        }
        //print_r($this->input->post());exit;
        //echo "aa";exit;
        $update=$this->cart->update($this->input->post());
        if($update){
        $this->session->set_flashdata("sucess","Successfully update your cart.");
        }else{
            $this->session->set_flashdata("warning","Error!");
        }
        redirect("products/viewcart","refresh");
    }
    
    
    


    public function deletecart(){
        $rowid=$this->input->post('id');
        $remove=$this->cart->remove($rowid);
        if($remove){
            echo json_encode(array("status"=>true,"message"=>"Successfully delete from cart."));
        }else{
            echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

    public function filter(){
        $current_date=date("Y-m-d");
        $size=$this->input->post("size");
        $min_price=$this->input->post("min_price");
        $max_price=$this->input->post("max_price");
        $certification=$this->input->post("certification");
        $by=$this->input->post("by");
        if($by=='category'){$categoryid=$this->input->post("categoryid");}else{$userid=$this->input->post("userid");};
        $zipcode=$this->input->post("zipcode");
        $productname=$this->input->post("productname");
        $business_name=$this->input->post("business_name");
        $bid=$this->input->post("bid");
        $seller_ratting=$this->input->post("seller_ratting");
        
        $currentpage=$this->input->post("currentpage");
        
        $in=array("usi.size");
        $in_value=array($size);
        
        if($seller_ratting!=NULL){
            $seller_ratting1=implode(',',$seller_ratting);
            $sql="SELECT `revuserid` FROM `userreviews` GROUP BY `revuserid` HAVING ROUND(AVG(`stars`),0) IN ($seller_ratting1)";
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0)
            {
                foreach($query->result() as $seller){
                    
                    $sellers[]=$seller->revuserid;
                }
                array_push($in,"p.user_id");
                array_push($in_value,$sellers);
            }else{
                echo json_encode(array('res'=>false));exit;
            }
            
        }
        
        if($by=='category'){$where=array("p.category"=>$categoryid); }else{$where=array("p.user_id"=>$userid);}
        
        if($certification!=NULL){
            $where["usi.certification"]=$certification;
        }
        
        if($bid!=NULL){
            $where["p.bid_status"]=$bid;
        }
        
        /*if(count($size)>0){
        $invalue=array(implode(",",$size));
        }else{
            $invalue='';  ,"p.no_of_Prod > "=> '0'
        }*/
        
        $where["p.status"]="1";
        $where["p.no_of_Prod >"]="0";
        $where["p.admin_status"]="1";
        $where["u.status"]="1";
        $like=array( array("likeon"=>'usi.zip', "likeval"=>$zipcode),array("likeon"=>'p.prod_name', "likeval"=>$productname),array("likeon"=>'usi.business_name', "likeval"=>$business_name) );
        
        $comment1=array('val'=>'cat.category,cat.id as catid,p.id as prod_id,p.prod_name,p.prod_price,p.no_of_Prod,p.status,p.prod_img,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username,s.state','table'=>'product as p','where'=>$where,"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'between'=>array("col"=>"p.prod_price","from"=>$min_price,"to"=>$max_price),"in"=>$in,"in_value"=>$in_value,"like_multicol"=>$like,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.paid','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
			array('table'=>'statelist as s','on'=>'s.id=u.state','join_type'=>'left'),
        );
        
        //print_R($comment1);exit;
        //$resp=$this->common->multijoin_between2($comment1,$multijoin1);
        
        
        $table=$this->common->multijoin_between2($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //print_r($table); exit;
        $config = array();
        if($by=='category'){ $config["base_url"] = BASE_URL. "products/$categoryid"; }else{$config["base_url"] = BASE_URL. "sellerproduct/$userid";}
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 9;
        //$config["cur_page"] = $currentpage/$config["per_page"];
        $config["uri_segment"] = $currentpage;
        
        //$config['base_url'] = base_url().'pagination/country/';    // url of the page
        //$config['total_rows'] = $this->mdl_pagination->countcountry(); //get total number of records 
        //$config['per_page'] = 10;  // define how many records on page
//        $config['full_tag_open'] = '<ul class="pagination" id="search_page_pagination">';
//        $config['full_tag_close'] = '</ul>';
//        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
//        $config['num_tag_open'] = '<li>';
//        $config['num_tag_close'] = '</li>';
//        $config['cur_tag_close'] = '</a></li>';
//        $config['first_link'] = 'First';
//        $config['first_tag_open'] = '<li>';
//        $config['first_tag_close'] = '</li>';
//        $config['last_link'] = 'Last';
//        $config['last_tag_open'] = '<li>';
//        $config['last_tag_close'] = '</li>';
        $config['next_link'] = FALSE;
//        $config['next_tag_open'] = '<li>';
//        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = FALSE;
//        $config['prev_tag_open'] = '<li>';
//        $config['prev_tag_close'] = '</li>';
        $config['page_query_string'] = FALSE;

        $this->pagination->initialize($config); 
        $page = $currentpage;
        
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin_between2($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($resp['links']);exit;
        //echo $currentpage;exit;
        //echo $this->db->last_query();exit;
        $cookie= array(
            'name'   => 'savesearch',
            'value'  => $this->db->last_query(),
            'expire' => '86500',
        );
        $this->set_cookie($cookie);
        
        //$this->session->set_userdata("savesearch",$this->db->last_query());
        echo json_encode($resp);
    }
    


    public function yourbid($id){
        $this->_checkvalid("bid/yourbid/$id");
        redirect("bid/yourbid/$id","refresh");
    }


	public function savesearch($catid){
        //echo $this->get_cookie("savesearch");exit;
        $this->_checkvalid("products/savesearch/$catid");
        $this->is_buyer("You have login as a buyer for save searches.");
        
        //$searchdata=$this->session->userdata("savesearch"); // this session create in only Products controller's index and filter function.  
        $searchdata=$this->get_cookie("savesearch");
        if($searchdata!=''){
            $currentdate=date("y-m-d");
            $data=array("table"=>"savesearch","val"=>array("user_id"=>$this->session->userdata("user_id"),"cat_id"=>$catid,"searchdata"=>$searchdata,"add_date"=>$currentdate));
            $log=$this->common->add_data($data);
            if($log){
                //$this->session->unset_userdata("savesearch");
                $this->session->set_flashdata("sucess","This search saved successfully.");
                redirect("products/$catid","refresh");
            }
        }else{
            $this->session->set_flashdata("warning","Session Expired.");
            redirect("products/$catid","refresh");
        }
    }
    
    
    public function compare(){
        //$this->session->unset_userdata("compare_cat");
        //$this->session->unset_userdata("compare");exit;
        $catid=$this->input->post("catid");
        $prodid=$this->input->post("prodid");
        $data=array();
        if($this->session->has_userdata("compare_cat")){
        $this->_check_category($catid); $this->_check_product($prodid);}
        if(count($this->session->userdata("compare"))< 4){ 
        if($this->session->has_userdata("compare")){
           
            $data=$this->session->userdata("compare");
            array_push($data, $prodid);
            $this->session->set_userdata("compare",$data);
            $product=$this->_getprod_details($prodid);
        }else{
            array_push($data, $prodid);
            $this->session->set_userdata("compare",$data);
            $this->session->set_userdata("compare_cat",$catid);
            $product=$this->_getprod_details($prodid);
        }
        
        if($product['res']){
            echo json_encode(array("status"=>true,"rows"=>$product['rows']));exit;
        }
        
        }else{
            echo json_encode(array("status"=>false,"message"=>"you can compare only four product at a time."));exit;
        }
         //print_r($this->session->userdata("compare_cat"));exit;
    }
     
    
    public function _getprod_details($id){
        $data=array("table"=>"product","val"=>"id,prod_name,prod_img","where"=>array("id"=>$id));
        $log=$this->common->getsinglerow($data);
        return $log;        
    }
    
    public function _check_category($catid){
        if($this->session->userdata("compare_cat")== $catid){
            return true;
        }else{
            //print_r($this->getcategory($catid));
            $category=$this->getcategory($this->session->userdata("compare_cat"))['rows'][0]->category;
            echo json_encode(array("status"=>false,"message"=>"Please remove $category category's product from compare list."));exit;
        }
    }
    
    public function _check_product($prodid){
        //print_R($this->session->userdata("compare"));exit;
        if(in_array($prodid, $this->session->userdata("compare"))){
            echo json_encode(array("status"=>false,"message"=>"This product already exist in your compare list."));exit;
        }else{
            return true;
        }
    }
    
    
    public function compareRemove(){
        $prodid=$this->input->post("prodid");
        
        if($prodid>0){
            if(count($this->session->userdata("compare"))>1){
                $products=$this->session->userdata("compare");
                if (in_array($prodid, $products)) 
                {
                    unset($products[array_search($prodid,$products)]);
                }
                $this->session->set_userdata("compare",  array_values($products));
                echo json_encode(array("status"=>true,"role"=>"single","productid"=>"$prodid"));exit;
            }else{
                $this->_compareRemoveall();
            }
        }else{
            $this->_compareRemoveall();
        }
    }
    
    
    public function _compareRemoveall(){
        $this->session->unset_userdata("compare");
        $this->session->unset_userdata("compare_cat");
        echo json_encode(array("status"=>true,"role"=>"all","message"=>"Remove from compare list successfully."));exit;
    }
    
    
    public function productcompare(){
        $this->is_buyer();
        $log['product']=$this->compare_products();
        $log['category']= $this->getcategory($this->session->userdata("compare_cat"));
        
        $this->load->view('include/header');
        $this->load->view('products/vw_comparelist',$log);
        $this->load->view('include/footer');
    }

	public function searchbydistance($catid){
            $zip=$this->input->get('zip');
            $distance=$this->input->get('distance');
            $city=$this->input->get('city');
            $state=$this->input->get('state');
            
            
            //get all seller who for same business type
        $comment2=array('val'=>'u.f_name,u.l_name,u.username,u.id as userid,u.profile_Pic','table'=>'user_business_type as ubt','where'=>array("ubt.business_id"=>$catid,"status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.paid','orderas'=>'DESC');
        //$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.no_of_Prod,p.bid_status,p.pord_detail,usi.certification,usi.size','table'=>'product as p','where'=>"(`p`.`category` = '$catid' AND `p`.`status` = '1' AND `p`.`no_of_Prod` > '0') AND CASE `p`.`bid_status` WHEN '1' THEN ( `auc`.`bid_end_date` >= '$current_date'  AND `auc`.`status`='1') ELSE 1=1 END ",'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'user_Info as u','on'=>'ubt.user_id=u.id','join_type'=>''),
        );
        $resp['sellers']=$this->common->multijoin($comment2,$multijoin2);
        //end seller list
        
        $current_date=date("Y-m-d");
            
        if(($zip!='' || $city!='') && $distance!=''){
            
            //$this->geozip->getzip($zip,$distance,$city);
            //$nearest_zip=implode(',',$this->geozip->getNearByZipcods($zip,$distance,$city,$state));
            //echo $nearest_zip;exit;
            $user_id=$this->searchbydistance1($zip,$city,$distance);
            $flag=0;
            if(count($user_id)==0){
                $flag=1;
            }
            //$userid=  implode(',', $user_id);
            $userid=$user_id;
            $comment1=array('val'=>'count(p.id) as ct,p.id as prod_id,p.prod_name,p.prod_price,p.no_of_Prod,p.status,p.prod_img,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username,s.state','table'=>'product as p','where'=>array("p.category"=>$catid,"p.status"=>"1","p.no_of_Prod >"=>'0','p.admin_status'=>'1','u.status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'u.paid','orderas'=>'DESC','in'=>'','in_value'=>'');
            if(!$flag){
				$comment1['in']='p.user_id';
				$comment1['in_value']=$userid;
			}
			$multijoin1=array(  
                array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
                array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
				array('table'=>'statelist as s','on'=>'s.id=u.state','join_type'=>'left'),
            );
        }else{
            $this->session->set_flashdata("get_vali_error","true");
            $comment1=array('val'=>'count(p.id) as ct,p.id as prod_id,p.prod_name,p.prod_price,p.no_of_Prod,p.status,p.prod_img,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username','table'=>'product as p','where'=>array("p.category"=>$catid,"p.status"=>"1","p.no_of_Prod >"=>'0','p.admin_status'=>'1','u.status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'u.paid','orderas'=>'DESC','in'=>'','in_value'=>'');
            $multijoin1=array(  
                array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
                array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
            );
            
        }
//        $test=$this->common->multijoin_with_in($comment1,$multijoin1);
//        echo "<pre>";
//        print_r($test);exit;
        
	$resp['category']= $this->getcategory($catid);
        $resp['categoryid']= $catid;
        
        $data=array("min"=>array("field"=>'prod_price',"as"=>'min'),"max"=>array("field"=>'prod_price',"as"=>'max'),"table"=>"product","where"=>array("category"=>$catid,"status"=>"1","no_of_Prod >"=>'0'));
        $resp['price']=$this->common->getminmax($data);          

        $table=$this->common->multijoin_with_in($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "products/searchbydistance/$catid/?zip=$zip&distance=$distance&city=$city&state=$state";
        $config["total_rows"] = ($table['res'])?count($table['rows']) :0;
        $config["per_page"] = 15;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin_with_in($comment1,$multijoin1,$config["per_page"], $page);
		
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
           //echo $this->db->last_query();exit;  
       // print_r($resp);exit;
        if($flag==1){
			$resp["links"]='';
            $resp['products']['res']=false;
        }
	$cookie= array(
                'name'   => 'savesearch',
                'value'  => $this->db->last_query(),
                'expire' => '86500',
            );
            $this->set_cookie($cookie);
        $comment3="SELECT ads.*,uifo.id as seller_id,uifo.username FROM ads_subscription as ads LEFT JOIN user_Info as uifo on ads.user_id=uifo.id  where ads.paid_status='1' AND ads.status='1' AND (ads.title!='' OR ads.html_data!='') ORDER BY RAND()  limit 0,1";
        $resp['ads']=$this->common->dbQuery($comment3);
            
        $this->load->view('include/header');
        $this->load->view('products/vw_product_list',$resp);
        $this->load->view('include/footer');
        
    }
    
    public function searchbydistance1($zip,$city,$distance){
//            $state=$this->input->get('state');
            $getlanglat=$this->geozip->get_zip_point($zip,$city);
			if($getlanglat->lat=='' || $getlanglat->lng==''){
				return $userid=array();
			}
            //print_r($getlanglat);
            //$query="SELECT user_id, lat, lng, (( 3959 * acos( cos( radians('$getlanglat->lat') ) * cos( radians( 'lat' ) ) * cos( radians( 'lng' ) - radians('$getlanglat->lng') ) + sin( radians('$getlanglat->lat') ) * sin( radians( 'lat' ) ) ) )/1000) AS distance FROM user_store_info HAVING distance < '$distance' AND lat!='0' AND lng!='0' ORDER BY distance";
            $query="SELECT user_id, lat, lng, ( 3959 * acos( cos( radians($getlanglat->lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($getlanglat->lng) ) + sin( radians($getlanglat->lat) ) * sin(radians(lat)) ) ) AS distance  FROM user_store_info HAVING distance < $distance AND lat!='0' AND lng!='0' ORDER BY distance";
            //$query="SELECT user_id, lat, lng FROM user_store_info WHERE DISTANCE(Location__c, GEOLOCATION($getlanglat->lat,$getlanglat->lng), 'km') < $distance ";
            //echo "<br/>".$query;
            $res=$this->db->query($query);
            $row=$res->result();
            //echo "<pre>";
            //print_r($row);exit;
            $userid=array();
            if(count($row)>0){
            foreach($row as $user){
                array_push($userid, $user->user_id);
            }
                return $userid;
            }else{
                return $userid;
            }
            
    }
    
    public function get_online_singleuser(){
        $userid=$this->input->post('id');
        $data=array("table"=>"user_Info","val"=>"is_login","where"=>array("id"=>$userid));
        $log=$this->common->getsinglerow($data);
        if($log['res']){
            echo $log['rows']->is_login;
        }else{
            echo '0';
        }
    }
    
    
    public function savesearchdetails($id){
        //$this->is_buyer();
        $data=array("table"=>"savesearch","val"=>"","where"=>array("id"=>$id));
        $log=$this->common->getsinglerow($data);
        //print_r($log);
        $resp['category']= $this->getcategory($log['rows']->cat_id);
        $resp['categoryid']= $log['rows']->cat_id;
        $resp['catid']= $log['rows']->cat_id;
        $catid=$resp['catid'];
        $comment2=array('val'=>'u.f_name,u.l_name,u.username,u.id as userid,u.profile_Pic','table'=>'user_business_type as ubt','where'=>array("ubt.business_id"=>$catid,"status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.paid','orderas'=>'DESC');
        //$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.no_of_Prod,p.bid_status,p.pord_detail,usi.certification,usi.size','table'=>'product as p','where'=>"(`p`.`category` = '$catid' AND `p`.`status` = '1' AND `p`.`no_of_Prod` > '0') AND CASE `p`.`bid_status` WHEN '1' THEN ( `auc`.`bid_end_date` >= '$current_date'  AND `auc`.`status`='1') ELSE 1=1 END ",'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'user_Info as u','on'=>'ubt.user_id=u.id','join_type'=>''),
        );
        $resp['sellers']=$this->common->multijoin($comment2,$multijoin2);
        
        $category=$this->getcategory($resp['catid']);
        $resp['categoryname']=$category['rows'][0]->category;
        //print_r($category);
        $resp['links']='';
            $query=$this->db->query($log['rows']->searchdata);
            $resp['products']=array("res"=>true,"rows"=>$query->result());
            //echo "<pre>";
            //print_r($resp);
            $this->load->view('include/header');
            $this->load->view('products/vw_save_product_list',$resp);
            $this->load->view('include/footer'); 
        
    }
    
    public function searching(){
        $this->load->view('products/searching');
    }
    
}
