<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paypalcontroller extends MY_Controller {
    //private $userid;
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        //$this->load->helper('array');
        //$this->load->helper('url'); 
        //$this->load->library('form_validation');
        //$this->load->helper('form');
        $this->load->library('paypal');
    }
    public function index()
    {        
	//echo $this->input->post('paytype');exit;
        $this->currentavailproductforpayment();
        if($this->input->post('paytype')==1)
        {
            $this->paument_bycard();
        }
        else  if($this->input->post('paytype')==2)
        {
            $this->paument_bysite();
        }
        else
        {
            $this->defoultpage();
        } 
    }
    
    public function paument_bysite()
    {
        $this->form_validation->set_rules('name', 'User name', 'trim|required');//trim|required|max_length[20]|xss_clean
        $this->form_validation->set_rules('email', 'User email', 'trim|required');        
        $this->form_validation->set_rules('street', 'Street', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('zip', 'Zip', 'trim|required');
        
        if($this->form_validation->run()) 
            { 
			if($this->input->post('paymenttype')=='product' || $this->input->post('paymenttype')=='user' || $this->input->post('paymenttype')=='bidproduct'){
            $paidamt=$this->session->userdata("total_payment_price");
            }
            elseif ($this->input->post('paymenttype')=='ads') {
            $paidamt=$this->session->userdata("price");
            }
            else{$paidamt=$this->input->post('amount');}
            $admincomm=$this->getadminsettings(); // in %
			
            $admincommission =  (($paidamt*$admincomm->commission)/100);

		
		
			 $data=array(
            'firstname'=>$this->input->post('name'),
            'name'=>$this->input->post('name'),  
            'email'=>$this->input->post('email'),
            'amount'=>$paidamt,
            'street'=>$this->input->post('street'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zip'=>$this->input->post('zip'), 
                'data1'=>'Paypal Account',
                'data2'=>'Paypal',
                'data3'=>'',
            'campaignid'=>$this->input->post('campaignid'),
            'buyerid'=>$this->input->post('buyerid'),
            'sellerid'=>$this->input->post('sellerid'));
			
			
			
			$paymentdata['same_billing_text']=0;
            if($this->input->post("same_billing_text")){
            $billing=array(
             'name'=>$this->input->post('name1'),
             'email'=>$this->input->post('email1'),
             'street'=>$this->input->post('street1'),
             'city'=>$this->input->post('city1'),
             'state'=>$this->input->post('state1'),
             'zipCode'=>$this->input->post('zip1')
             );
             //$paymentdata['same_billing_text']=1;
             $paymentdata['billingaddress']=$billing;
             }else{
			$billing=array(
              'name'=>$this->input->post('name'),
              'email'=>$this->input->post('email'),
              'street'=>$this->input->post('street'),
              'city'=>$this->input->post('city'),
              'state'=>$this->input->post('state'),
              'zipCode'=>$this->input->post('zip')
              );
              // $paymentdata['same_billing_text']=1;
              $paymentdata['billingaddress']=$billing;
			}
			
			$paymentdata['name']=$this->input->post('name');
            $paymentdata['email']=$this->input->post('email');
            $paymentdata['street']=$this->input->post('street');
            $paymentdata['city']=$this->input->post('city');
            $paymentdata['state']=$this->input->post('state');
            $paymentdata['zipCode']=$this->input->post('zip');
            $paymentdata['Payment_type']='Paypal Account';
            $paymentdata['payment_with']='Paypal';
			
            $this->setsessionvalue($data);
			$this->setbillingsessionvalue($paymentdata);
           

                 $amount = $paidamt;
                //for campaign payment Url's
                 if($this->input->post('paymenttype')=='campaign'){                     
                $title = "Payment for Campaign";            
                 $config['RETURNURL'] = BASE_URL . 'paymentstetus/campaign/paymentsuccess';
                    $config['CANCELURL'] = BASE_URL . 'paymentstetus/campaign/paymentcancel';
                  //for product payment Url's
                 }elseif($this->input->post('paymenttype')=='product'){  
                    $title = "Payment for Product";            
                    $config['RETURNURL'] = BASE_URL . 'paymentstetus/product/paymentsuccess';
                    $config['CANCELURL'] = BASE_URL . 'paymentstetus/product/paymentcancel';
                 }elseif($this->input->post('paymenttype')=='user'){    
                 $title = "Payment for user";            
                $config['RETURNURL'] = BASE_URL . 'paymentstetus/user/paymentsuccess';
                $config['CANCELURL'] = BASE_URL . 'paymentstetus/user/paymentcancel';
                }elseif($this->input->post('paymenttype')=='bidproduct'){  
                    $this->session->set_userdata("auctionid",$this->input->post('campaignid'));
                 $title = "Payment for bidproduct";            
                $config['RETURNURL'] = BASE_URL . 'paymentstetus/bidproduct/paymentsuccess';
                $config['CANCELURL'] = BASE_URL . 'paymentstetus/bidproduct/paymentcancel';
                }  
				elseif($this->input->post('paymenttype')=='ads'){	
                    $this->session->set_userdata("crt_id",$this->input->post('ads_id'));
                 $title = "Payment for Ads";            
                $config['RETURNURL'] = BASE_URL . 'paymentstetus/ads/paymentsuccess';
                $config['CANCELURL'] = BASE_URL . 'paymentstetus/ads/paymentcancel';
                }  
                $config['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';
                $config['PAYMENTREQUEST_0_CURRENCYCODE'] = 'USD';
                $config['L_PAYMENTREQUEST_0_AMT0'] = $config['PAYMENTREQUEST_0_AMT'] = $amount;
                $config['L_PAYMENTREQUEST_0_NAME0'] =  $config['L_PAYMENTREQUEST_0_DESC0'] = $title;
                $this->paypal->pay($config);               
            }
            else
            {        
               $this->defoultpage();
            }    
    }
    
    public function paument_bycard()
    {
		
        $this->form_validation->set_rules('name', 'User name', 'trim|required');//trim|required|max_length[20]|xss_clean
        $this->form_validation->set_rules('email', 'User email', 'trim|required');        
        $this->form_validation->set_rules('street', 'Street', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('zip', 'Zip', 'trim|required');
        $this->form_validation->set_rules('credit_card_no', 'Credit Card no', 'trim|required|is_natural');
        $this->form_validation->set_rules('security_code', 'Security Code', 'trim|required');
        $this->form_validation->set_rules('expiration_date', 'Expiration Date', 'trim|required');
        $this->form_validation->set_rules('card_type', 'Select MASTER/VISA', 'trim|required');       
        if($this->form_validation->run()) 
            { 
			//echo print_r($_POST);exit;
            $expiry=$this->input->post('expiration_date');
			$exp=explode('/', $this->input->post('expiration_date'));
            //print_r($exp);
            $expiry=$exp[0].$exp[1];
			//echo $expiry;exit;
            
			if($this->input->post('paymenttype')=='product' || $this->input->post('paymenttype')=='user' || $this->input->post('paymenttype')=='bidproduct'){
            $paidamt=$this->session->userdata("total_payment_price");
            }
            elseif ($this->input->post('paymenttype')=='ads') {
            $paidamt=$this->session->userdata("price");
            }
            else{$paidamt=$this->input->post('amount');}
            $admincomm=$this->getadminsettings(); // in %
			
            $admincommission =  (($paidamt*$admincomm->commission)/100);
			
			
            $data=array('credit_card_no'=>$this->input->post('credit_card_no'),
            'card_type'=>$this->input->post('card_type'),
            'cvv'=>$this->input->post('security_code'),
            'expiry_date'=>$expiry,
            'firstname'=>$this->input->post('name'),
            'name'=>$this->input->post('name'),  
            'email'=>$this->input->post('email'),
            'amount'=>$paidamt,
            'street'=>$this->input->post('street'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zip'=>$this->input->post('zip'), 
                'data1'=>'Card',
                'data2'=>'Paypal',
                'data3'=>'',
            'name_on_card'=>$this->input->post('name_on_card'),
            'campaignid'=>$this->input->post('campaignid'),
            'buyerid'=>$this->input->post('buyerid'),
            'sellerid'=>$this->input->post('sellerid'));
       
	   
			$paymentdata['same_billing_text']=0;
            if($this->input->post("same_billing_text")){
            $billing=array(
             'name'=>$this->input->post('name1'),
             'email'=>$this->input->post('email1'),
             'street'=>$this->input->post('street1'),
             'city'=>$this->input->post('city1'),
             'state'=>$this->input->post('state1'),
             'zipCode'=>$this->input->post('zip1')
             );
             //$paymentdata['same_billing_text']=1;
             $paymentdata['billingaddress']=$billing;
             }else{
			$billing=array(
              'name'=>$this->input->post('name'),
              'email'=>$this->input->post('email'),
              'street'=>$this->input->post('street'),
              'city'=>$this->input->post('city'),
              'state'=>$this->input->post('state'),
              'zipCode'=>$this->input->post('zip')
              );
              // $paymentdata['same_billing_text']=1;
              $paymentdata['billingaddress']=$billing;
			}
			
			$paymentdata['name']=$this->input->post('name');
            $paymentdata['email']=$this->input->post('email');
            $paymentdata['street']=$this->input->post('street');
            $paymentdata['city']=$this->input->post('city');
            $paymentdata['state']=$this->input->post('state');
            $paymentdata['zipCode']=$this->input->post('zip');
            $paymentdata['Payment_type']='Card';
            $paymentdata['payment_with']='Paypal';
			
            $this->setsessionvalue($data);
            $response = $this->paypal->card_payment($data);
           // print_r($response);exit;
                if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) 
                {
                    foreach ($matches['name'] as $offset => $name) 
                    {
                        $nvp[$name] = urldecode($matches['value'][$offset]);
                    }
                } 
                if($nvp['ACK']=='Success' || $nvp['ACK']=='SuccessWithWarning') 
                    {
                       // echo 'payment success';print_r($nvp);exit;
                        $paymentdata['amount']=$nvp['AMT'];
                        $paymentdata['tokan']=$nvp['TRANSACTIONID'];
                        $paymentdata['paystatus']=$nvp['ACK'];
                        if($this->input->post('paymenttype')=='campaign'){
                            $paymentdata['name']=$this->input->post('name');
                            $paymentdata['sellerid']=$this->input->post('sellerid');
                        $this->card_payment_insert_campaign($paymentdata);
                          //for product payment Url's
                         }elseif($this->input->post('paymenttype')=='product'){  
                             
                             $this->card_payment_insert_product($paymentdata);
                          //for paiduser payment Url's
                         }elseif($this->input->post('paymenttype')=='user'){    
                         $this->card_payment_insert_user($paymentdata);
                        }elseif($this->input->post('paymenttype')=='bidproduct'){
                            $paymentdata['auctionid']=$this->input->post('campaignid');
                            $paymentdata['sellerid']=$this->input->post('sellerid');
                            //echo "aa";exit;
                         $this->card_payment_insert_bidproduct($paymentdata);
                        } 
                        elseif($this->input->post('paymenttype')=='ads'){ 
                            $this->card_payment_ads($paymentdata);
                        }
                        $this->session->set_flashdata("sucess","Successfully paid ");
                        
                       
                               
                }elseif(isset($nvp['L_SEVERITYCODE0']))
                 {
                     $failmessage=$nvp['L_LONGMESSAGE0'];               
                     $this->session->set_flashdata("warning","Sorry payment failure due to - ".$failmessage);
                     if($this->input->post('paymenttype')=='product'){
                            redirect("products/viewcart","refresh"); 
                        }else if($this->input->post('paymenttype')=='bidproduct'){
                            $bidid=$this->input->post('campaignid');// auction id
                            $data11=array("table"=>"product_auction","val"=>array("prod_id"),"where"=>array("id"=>$bidid));
                            $items=$this->common->getdata($data11);
                            //echo $items['rows'][0]->prod_id;exit;
                            redirect(BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id,"refresh"); 
                        }else if($this->input->post('paymenttype')=='user'){
                             redirect(BASE_URL."profile/","refresh");
                        }
                        else if($this->input->post('paymenttype')=='ads'){
                             redirect(BASE_URL."profile/","refresh");
                        }
                        else{
                            redirect(BASE_URL.$this->input->post('paymenttype')."/","refresh");
                        }
                 }
                 elseif ($nvp['ACK']=='Failure') 
                     {
						  $failmessage=$nvp['L_LONGMESSAGE0'];
						  $this->session->set_flashdata("warning","Sorry payment failure due to - ".$failmessage);
						  if($this->input->post('paymenttype')=='product'){
									redirect("products/viewcart","refresh"); 
								}else if($this->input->post('paymenttype')=='bidproduct'){
									$bidid=$this->input->post('campaignid');// auction id
									$data11=array("table"=>"product_auction","val"=>array("prod_id"),"where"=>array("id"=>$bidid));
									$items=$this->common->getdata($data11);
									//echo $items['rows'][0]->prod_id;exit;
									redirect(BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id,"refresh");
								
								}else if($this->input->post('paymenttype')=='user'){
									 redirect(BASE_URL."profile/","refresh");
								}
								else if($this->input->post('paymenttype')=='ads'){
									 redirect(BASE_URL."profile/","refresh");
								}
								else{
									redirect(BASE_URL.$this->input->post('paymenttype')."/","refresh");
								}
                    }
         }else{
        
             $this->defoultpage();
        }
    }  
	
    public function card_payment_insert_campaign($data)
    {
		
            $date=date('Y-m-d');
            if($this->session->userdata('user_id')!=''){
                $orderid=$this->session->userdata('user_id');
            }
            else{
                $orderid='';
            }
            $data_transaction=array('table'=>'transaction','val'=>array(
               'trans_id'=>$data['tokan'],
               //'order_id'=>$this->session->userdata("campaignid"),
               'order_id'=>$orderid,     
               'price'=>$data['amount'],
               'date'=>$date,
               'payment_for'=>"campeign",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
               'status'=>'success'));
            $data2=array('table'=>'campaign_payment_detail','val'=>array(
               'trans_id'=>$data['tokan'],
               'campaign_id'=>$this->session->userdata("campaignid"),
               'buyerId'=>$this->session->userdata("buyerid")!=""?$this->session->userdata("buyerid"):'000',
               'seller_id'=>$this->session->userdata("sellerid"),
               'price'=>$data['amount'],
               'name'=>$data['name'],
               'status'=>'1',
               'date'=>$date));
           $result=$this->common->add_data($data_transaction);
           $result2=$this->common->add_data($data2);
           $this->session->set_userdata("shareproduct",array("trans_detail"=>$data_transaction['val'],"data"=>$data2['val']));
           //$ex_comm=0;
           //$ex_comm=$data['amount'];
           //print_r($result); 
           //print_r($result2); exit;
         $comment1=array('val'=>'u.paid','table'=>'campaign_payment_detail as cpd','where'=>array("cpd.trans_id"=>$data['tokan']),'group_by'=>'','minvalue'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
         $multijoin1=array(
             array('table'=>'user_Info as u','on'=>'cpd.seller_id=u.id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        $comment1=array('val'=>'*','table'=>'tb_admin_commision as t_ac','where'=>array(),'minvalue'=>'','group_by'=>'t_ac.id','start'=>'','orderby'=>'','orderas'=>'');
        $commission=$this->common->getdata($comment1);
        //echo "<pre>";
        //print_r($table); exit;
        $premium=$commission['rows'][0]->comm_for_premium;
        $free_user=$commission['rows'][0]->comm_for_freeuser;
        $ex_total=0;
        if($table['rows'][0]->paid==1){
          $ex_total=$data['amount']-($data['amount']*$premium/100);  
        }
        else{
          $ex_total=$data['amount']-($data['amount']*$free_user/100);  
        }
           $transaction_seller=array(
                'trans_id'=>$data['tokan'],
                'seller_id'=>$data['sellerid'],
                'tax'=>'0',
                'total'=>$data['amount'],
                'commission'=>$data['amount']-$ex_total, // (($data['amount']*admincomm)/100)
                'status'=>'0',
                'pt'=>'P',
                'tansdatetime'=>$date); 
            $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
            $insert=$this->common->add_data($data111);
           //echo "<pre>";
           //print_r($insert); exit;
           if($result && $result2)
           {
               $this->session->set_flashdata("sucess","Payment successfully.You can share this donation with facebook.");
               redirect("share","refresh");
//             $this->session->set_flashdata("sucess","Successfully paid ");
//             $this->redirectheader("campaign/");//redirect(BASE_URL."campaign/","refresh"); 
           }
           else{
           $this->session->set_flashdata("warning","Sorry payment failure");
             $this->redirectheader("campaign/");//redirect(BASE_URL."campaign/","refresh"); 
           }
        $this->emptysessionvalue();
    }
     public function card_payment_insert_product($data)
     { 
        $admincomm=$this->getadminsettings(); // in %
        $date=date('Y-m-d');
		$data['datetime']=$date;
        $data_transaction=array('table'=>'transaction','val'=>array(
           'trans_id'=>$data['tokan'],
           'order_id'=>$this->session->userdata('user_id'),
           'price'=>$data['amount'],
           'date'=>$date,
           'payment_for'=>"product",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
           'status'=>'success'));                    

            foreach ($this->cart->contents() as $items)
            {
                $data1=array('table'=>'order_detail_form','val'=>array(                       
                    'status'=>'1',
                    'buyerId'=>$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'000',
                    'product_id'=>$items['id'],
                    'price'=>$items['price'],//$items['subtotal'],
                    'quantity'=>$items['qty'],
                    'trans_id'=>$data['tokan'],
                    'date'=>$date));
                $result2=$this->common->add_data($data1);
                //echo "aa";exit;
                $get_product=$this->get_product_details($items['id']);
                $quantity=($get_product['rows'][0]->no_of_Prod-$items['qty']);
                $update_quantity_data=array('table'=>'product','val'=>array('no_of_Prod'=>$quantity),'where'=>array('id'=>$items['id']));
                $update_qty=$this->common->update_data($update_quantity_data);                 
            }
            
            $this->session->set_userdata("shareproduct",array("trans_detail"=>$data_transaction['val'],"data"=>$this->cart->contents())); 
            $this->cart->destroy();

                $data_billingadd=array('table'=>'billing_address','val'=>array(
                    'trans_id'=>$data['tokan'],
                    'bill_name'=>$data['billingaddress']['name'], 
                    'bill_email'=>$data['billingaddress']['email'], 
                    'bill_street'=>$data['billingaddress']['street'], 
                    'bill_city'=>$data['billingaddress']['city'], 
                    'bill_state'=>$data['billingaddress']['state'], 
                    'bill_zipCode'=>$data['billingaddress']['zipCode']
                    ));  
                $result_bill=$this->common->add_data($data_billingadd);
            
        
        $result=$this->common->add_data($data_transaction);
		
        // price details with tax sellerwise
		
         foreach($this->session->userdata('productpricedetails') as $productdetails){
            $admincommission =  (($productdetails->prod_total*$admincomm->commission)/100); 
            $transaction_seller[]=array(
               'trans_id'=>$data['tokan'],
               'seller_id'=>$productdetails->user_id,
               'tax'=>$productdetails->tax,
               'total'=>$productdetails->prod_total,
               'shippingcharge'=>$productdetails->shippingcharge,
               'commission'=>$admincommission,
               'status'=>'0',
               'pt'=>'P',
               'tansdatetime'=>$data['datetime']);
         }
		// print_r($transaction_seller);exit;
         $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
         $insert=$this->common->insert_multi_row($data111);
         $this->emptyamount();
		  
		 //echo 'insert'.$insert;exit;
		 
		 //echo 'result-'.$result.'result2-'$result2.'insert-'$insert;exit;
		 
         $this->session->unset_userdata('productpricedetails');
         $this->session->unset_userdata('total_product_price');
        // End price details with tax sellerwise
        
       if($result && $result2 && $insert)
       {    
           $this->send_mail_buyer($data['tokan']);
           $this->send_mail_seller($data['tokan']); 
           $this->session->set_flashdata("sucess","Successfully paid");
           redirect("share","refresh");
        
       }
       else{
       $this->session->set_flashdata("warning","Sorry payment failure");
         $this->redirectheader("products/1");//redirect(BASE_URL."profile/","refresh"); 
       }
       $this->emptysessionvalue();
    }
    public function card_payment_insert_user($data)
    {   
            $date=date('Y-m-d');
            $data_transaction=array('table'=>'transaction','val'=>array(
               'trans_id'=>$data['tokan'],
               'order_id'=>$this->session->userdata('user_id'),
               'price'=>$data['amount'],
               'date'=>$date,
               'payment_for'=>"user",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
               'status'=>'success'));
            $data_user=array('table'=>'user_payment','val'=>array('user_id'=>$this->session->userdata('user_id'),'tranc_id'=>$data['tokan'],'price'=>$data['amount'],'add_date'=>$date));
             $result3=$this->common->add_data($data_user);
           $data1=array('table'=>'user_Info','val'=>array('paid'=>'1','promocode'=>$this->session->userdata('promotioncode')),'where'=>array('id'=>$this->session->userdata('user_id')));
            $result2=$this->common->update_data($data1);
           $result=$this->common->add_data($data_transaction);
           
           $pack_id=$this->session->userdata('package_id');
           $package=array('val'=>'*','table'=>'theme_price','where'=>array('price_for'=>'seller','id'=>$pack_id));
           $pack_res= $this->common->getdata($package);

           $pack_period=$pack_res['rows'][0]->noOfDays;
           $expire=date('Y-m-d', strtotime('+'.$pack_period.' day', strtotime($date)));
           $sub_data=array('table'=>'subscription_expire','val'=>array('user_id'=>$this->session->userdata('user_id'),'package_id'=>$pack_id,'start_date'=>$date,'end_date'=>$expire));
           $result4=$this->common->add_data($sub_data);
           
           $ads_records_number=$pack_period/30;
		   
		   for($i=0;$i<$ads_records_number;$i++)
		   {
			   if($i==0)
			   {
				 $start=date('Y-m-d');
				 $exp_ads=date('Y-m-d', strtotime('+'.'21'. 'day', strtotime($start)));
				 $paidstatus='1';
				 
			   }
			   else
			   {
				   $date=date('Y-m-d');
				   $start=date('Y-m-d', strtotime("+ $i month", strtotime($date)));
				   $exp_ads=date('Y-m-d', strtotime('+'.'21'. 'day', strtotime($start)));
				   $paidstatus='2';
				   
			   }
			     $ads_data=array('table'=>'ads_subscription','val'=>array('user_id'=>$this->session->userdata('user_id'),'title'=>"",'content'=>"",'html_data'=>"",'image'=>"",'paid_status'=>$paidstatus,'ads_date'=>$start,'exp_date'=>$exp_ads));                
                // print_r($ads_data);
				 $result5=$this->common->add_data($ads_data);
			    
		   }
          
           if($result && $result2 && $result3 && $result4 && $result5)
           {
            $this->emptyamount();
            $this->session->set_userdata('user_paid','1');
            $this->session->set_flashdata("sucess","Successfully paid.");
            $this->redirectheader("adssubscription/");//redirect(BASE_URL."profile/","refresh"); 
           }
           else{
           $this->session->set_flashdata("warning","Sorry payment failure");
             $this->redirectheader("profile/");//redirect(BASE_URL."profile/","refresh"); 
           }
        $this->emptysessionvalue();
    }
    
    
    public function card_payment_insert_bidproduct($data)
    {  
        $admincomm=$this->getadminsettings(); // in %
        $date=date('Y-m-d');
        $data_transaction=array('table'=>'transaction','val'=>array(
           'trans_id'=>$data['tokan'],
           'order_id'=>$data['auctionid'],// this is auction id
           'price'=>$data['amount'],
           'date'=>$date,
           'payment_for'=>"bidproduct",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
           'status'=>'success'));                    

            $bidid=$data['auctionid'];// auction id
            $data11=array("table"=>"product_auction","val"=>array("prod_id"),"where"=>array("id"=>$bidid));
            $items=$this->common->getdata($data11);
            
            $product_details=$this->session->userdata('productpricedetails')[0];
            
            $orderdata=array('table'=>'order_detail_form','val'=>array(                       
                  'status'=>'1',
                  'buyerId'=>$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'000',
                  'product_id'=>$items['rows'][0]->prod_id,// current bid product id
                  'price'=>$product_details->prod_total,//this is bid amount
                  'quantity'=>'1',
                  'trans_id'=>$data['tokan'],
                  'date'=>$date));
          $result2=$this->common->add_data($orderdata);
        $result=$this->common->add_data($data_transaction);
        $admincommission = (($product_details->prod_total*$admincomm->commission)/100);
        $transaction_seller=array(
                'trans_id'=>$data['tokan'],
                'seller_id'=>$data['sellerid'],
                'tax'=>$product_details->tax,
                'total'=>$product_details->prod_total,
                'shippingcharge'=>$product_details->shippingcharge,
                'commission'=>$admincommission, 
                'status'=>'0',
                'pt'=>'P',
                'tansdatetime'=>$date); 
           $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
           $insert=$this->common->add_data($data111);

                $data_billingadd=array('table'=>'billing_address','val'=>array(
                    'trans_id'=>$data['tokan'],
                    'bill_name'=>$data['billingaddress']['name'], 
                    'bill_email'=>$data['billingaddress']['email'], 
                    'bill_street'=>$data['billingaddress']['street'], 
                    'bill_city'=>$data['billingaddress']['city'], 
                    'bill_state'=>$data['billingaddress']['state'], 
                    'bill_zipCode'=>$data['billingaddress']['zipCode']
                    ));  
                $result_bill=$this->common->add_data($data_billingadd);

           
       if($result && $result2)
       { 
       $this->emptyamount();
       $this->session->set_flashdata("sucess","Successfully paid");
       redirect(BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id,"refresh"); exit;
       }else{  
       $this->session->set_flashdata("warning","Sorry Not Paid Successfully");
       redirect(BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id,"refresh"); exit;
       }
       $this->emptysessionvalue();
    }
	
	public function card_payment_ads($data){
          $crt_id=$this->input->post('ads_id');
          $cat_id=$this->session->userdata('ads_category');
            $date=date('Y-m-d');
            $data_transaction=array('table'=>'transaction','val'=>array(
               'trans_id'=>$data['tokan'],
               'order_id'=>$this->session->userdata('user_id'),
                'price'=>$data['amount'],
               'date'=>$date,
               'payment_for'=>"ads",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
               'status'=>'success'));
             $data_user=array('table'=>'user_payment','val'=>array('user_id'=>$this->session->userdata('user_id'),'tranc_id'=>$data['tokan'],'price'=>$data['amount'],'add_date'=>$date));
             $result3=$this->common->add_data($data_user);
             
            $adstimedata=array('val'=>'*','table'=>'ads_subscription_period','where'=>array('id'=>$cat_id));
            $adstime= $this->common->getdata($adstimedata); 
            $ads_period=$adstime['rows'][0]->noofdays;
            $expire=date('Y-m-d', strtotime('+'.$ads_period.' day', strtotime($date)));
            $data1=array('table'=>'ads_subscription','val'=>array('paid_status'=>'1','ads_date'=>$date,'category'=>$cat_id,'exp_date'=>$expire),'where'=>array('user_id'=>$this->session->userdata('user_id'),'id'=>$crt_id));
            $result2=$this->common->update_data($data1);
            $result=$this->common->add_data($data_transaction);
            //print_r($result); exit;
           if($result && $result2 && $result3)
           {
            $this->emptyamount();
            $this->session->set_userdata('user_paid','1');
            $this->session->set_flashdata("sucess","Successfully paid.");
             $this->redirectheader("profile/");//redirect(BASE_URL."profile/","refresh"); 
           }
           else{
           $this->session->set_flashdata("warning","Sorry payment failure");
             $this->redirectheader("profile/");//redirect(BASE_URL."profile/","refresh"); 
           }
        $this->emptysessionvalue();
        
    }
	
	
    
    public function defoultpage()
    {    
        $this->load->view('include/header');
        $this->load->view('payment/Paypalview');
        $this->load->view('include/footer');
    }
    public function paymentcancel()
    {
        $this->emptysessionvalue();
        $this->session->set_flashdata("warning","Sorry Not Paid Successfully");
        //$this->redirectheader("profile/");
        redirect(BASE_URL."profile/","refresh"); 
        
    }
   
    public function setsessionvalue($data)
    {   
          $this->session->set_userdata('name', $data['name']);
          $this->session->set_userdata('email', $data['email']);
          $this->session->set_userdata('street', $data['street']);
          $this->session->set_userdata('city', $data['city']);
          $this->session->set_userdata('state', $data['state']);
          $this->session->set_userdata('zip', $data['zip']);
          $this->session->set_userdata('data1', $data['data1']);
          $this->session->set_userdata('data2', $data['data2']);
          $this->session->set_userdata('data3', $data['data3']);
    }
	
	public function setbillingsessionvalue($data)
    {   
		
          $this->session->set_userdata('bill_name', $data['billingaddress']['name']);
          $this->session->set_userdata('bill_email', $data['billingaddress']['email']);
          $this->session->set_userdata('bill_street', $data['billingaddress']['street']);
          $this->session->set_userdata('bill_city', $data['billingaddress']['city']);
          $this->session->set_userdata('bill_state', $data['billingaddress']['state']);
          $this->session->set_userdata('bill_zipCode', $data['billingaddress']['zipCode']);
         
    }
	
	
    public function emptysessionvalue()
    {
        unset($_SESSION['name'],$_SESSION['email'],$_SESSION['street'],$_SESSION['city'],$_SESSION['state'],$_SESSION['zip'],$_SESSION['data1'],$_SESSION['data2'],$_SESSION['data3']);         
    }
    public function redirectheader($path)
    {
        ?><script>
                            window.location.assign('<?php echo BASE_URL.$path?>');
        </script><?php
    }
	
	 public function emptyamount(){
        $this->session->set_userdata("total_payment_price",0);
        if($this->session->has_userdata('themeprice')){$this->session->unset_userdata('themeprice');}
        if($this->session->has_userdata('total_product_price')){$this->session->unset_userdata('total_product_price');}
    }
   
}
