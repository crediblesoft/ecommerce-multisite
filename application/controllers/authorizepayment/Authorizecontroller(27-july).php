<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authorizecontroller extends MY_Controller 
{

    public function __construct()
    {
        parent::__construct();
       $this->load->library('session');
        $this->load->library('Authorize_net');
    }    
    public function index()
    {       //echo 'you are hare ';exit;
        
        $this->currentavailproductforpayment();
        if($this->input->post('paytype')=='1')
        { 
            $this->validpayment(); 
            $this->paymentAuthorise(); 
        }
        else
        {
            $this->defoultpage();
        } 
        
    }
    
    public function validpayment(){ 
        if($this->input->post('paymenttype')=='product' || $this->input->post('paymenttype')=='user' || $this->input->post('paymenttype')=='bidproduct'){
                if($this->session->userdata("total_payment_price")<=0 || $this->session->userdata("total_payment_price")==''){ 
                    $this->session->set_flashdata("warning","Cart is empty or invalid process.");redirect("/","refresh");
                }
            }
            elseif ($this->input->post('paymenttype')=='ads') {
            if($this->session->userdata("price")<=0 || $this->session->userdata("price")==''){ 
                    $this->session->set_flashdata("warning","Cart is empty or invalid process.");redirect("/","refresh");
                }
        }
          
    }
    
    /*$this->form_validation->set_rules('name', 'User name', 'trim|required');//trim|required|max_length[20]|xss_clean
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
            $exp=explode('-', $this->input->post('expiration_date'));
            //print_r($exp);
            $expiry=$exp[1].$exp[0];
            $data=array('credit_card_no'=>$this->input->post('credit_card_no'),
            'card_type'=>$this->input->post('card_type'),
            'cvv'=>$this->input->post('security_code'),
            'expiry_date'=>$expiry,
            'firstname'=>$this->input->post('name'),
            'name'=>$this->input->post('name'),  
            'email'=>$this->input->post('email'),
            'amount'=>$this->input->post('amount'),
            'street'=>$this->input->post('street'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zip'=>$this->input->post('zip'),
            'name_on_card'=>$this->input->post('name_on_card'),
            'campaignid'=>$this->input->post('campaignid'),
            'buyerid'=>$this->input->post('buyerid'),
            'sellerid'=>$this->input->post('sellerid'));
       // print_r($data);
            
            $this->setsessionvalue($data);
             $response = $this->paypal->card_payment($data);
            // print_r($response);
                if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) 
                {
                    foreach ($matches['name'] as $offset => $name) 
                    {
                        $nvp[$name] = urldecode($matches['value'][$offset]);
                    }
                } print_r($nvp);         
                if($nvp['ACK']=='Success' || $nvp['ACK']=='SuccessWithWarning') 
                    {//print_r($this->cart->contents());                        
                      //  echo "<br/><br/><br/><br/><br/>";
                        //print_r($nvp);exit;                        
                        // database work here...
                    
                        $paymentdata['amount']=$pay_amount=$nvp['AMT'];
                        $paymentdata['tokan']=$token=$nvp['TRANSACTIONID'];
                        $paymentdata['paystatus']=$payStatus=$nvp['ACK'];
                        if($this->input->post('paymenttype')=='campaign'){                     
                        $this->card_payment_insert_campaign($paymentdata);
                          //for product payment Url's
                         }elseif($this->input->post('paymenttype')=='product'){  
                             $this->card_payment_insert_product($paymentdata);
                          //for paiduser payment Url's
                         }elseif($this->input->post('paymenttype')=='user'){    
                         $this->card_payment_insert_user($paymentdata);
                        } */
    
    public function paymentAuthorise()
	{
      
             //echo 'Authorize.net lib';
           
            $this->form_validation->set_rules('name', 'User name', 'trim|required');//trim|required|max_length[20]|xss_clean
            $this->form_validation->set_rules('email', 'User email', 'trim|required');        
            $this->form_validation->set_rules('street', 'Street', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('zip', 'Zip', 'trim|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('credit_card_no', 'Credit Card no', 'trim|required|is_natural');
            $this->form_validation->set_rules('security_code', 'Security Code', 'trim|required');
            $this->form_validation->set_rules('expiration_date', 'Expiration Date', 'trim|required');
            $this->form_validation->set_rules('card_type', 'Select MASTER/VISA', 'trim|required');       
            if($this->input->post("same_billing_text")){
                $this->form_validation->set_rules('name1', 'User name', 'trim|required');//trim|required|max_length[20]|xss_clean
                $this->form_validation->set_rules('email1', 'User email', 'trim|required');        
                $this->form_validation->set_rules('street1', 'Street', 'trim|required');
                $this->form_validation->set_rules('city1', 'City', 'trim|required');
                $this->form_validation->set_rules('state1', 'State', 'trim|required');
                $this->form_validation->set_rules('zip1', 'Zip', 'trim|required');
            }
            if($this->form_validation->run()) 
            { /*          
            $exp=explode('-', $this->input->post('expiration_date'));
            //print_r($exp);
            $expiry=$exp[1].'/'.$exp[0];*/
            $expiry=$this->input->post('expiration_date');
            if($this->input->post('paymenttype')=='product' || $this->input->post('paymenttype')=='user' || $this->input->post('paymenttype')=='bidproduct'){
            $paidamt=$this->session->userdata("total_payment_price");
            }
            elseif ($this->input->post('paymenttype')=='ads') {
            $paidamt=$this->session->userdata("price");
            }
            else{$paidamt=$this->input->post('amount');}
            $admincomm=$this->getadminsettings(); // in %
            $admincommission =  (($paidamt*$admincomm->commission)/100);
            
            $auth_net=array('x_card_num'=>$this->input->post('credit_card_no'),
            //'card_type'=>$this->input->post('card_type'),
            'x_card_code'=>$this->input->post('security_code'),
            'x_exp_date'=>$expiry,
            'x_description'=> 'A test transaction',
            'x_first_name'=>$this->input->post('name'),
            'x_last_name'=>'',  
            'x_email'=>$this->input->post('email'),
            'x_amount'=>$paidamt,
            'x_address'=>$this->input->post('street'),
            'x_city'=>$this->input->post('city'),
            'x_state'=>$this->input->post('state'),
            'x_zip'=>$this->input->post('zip'),
            'x_country'=> 'US',
            'x_phone'=> '',
            'x_customer_ip'=> $this->input->ip_address());
                 //print_r($auth_net);exit;                
		/*$auth_net = array(
			'x_card_num'			=> '4111111111111111', // Visa
			'x_exp_date'			=> '12/18',
			'x_card_code'			=> '123',
			'x_description'			=> 'A test transaction',
			'x_amount'				=> '20',
			'x_first_name'			=> 'sachin',
			'x_last_name'			=> 'kumar',
			'x_address'				=> '123 Green St.',
			'x_city'				=> 'Lexington',
			'x_state'				=> 'KY',
			'x_zip'					=> '40502',
			'x_country'				=> 'US',
			'x_phone'				=> '555-123-4567',
			'x_email'				=> 'sachin@ucodice.com',
			'x_customer_ip'			=> $this->input->ip_address()
			);*/
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
                        $paymentdata['payment_with']='Authorise.net';
                        $paymentdata['commission']=$admincommission;
                        $paymentdata['datetime']=date('Y-m-d H:i:s');
		$this->authorize_net->setData($auth_net);
		// Try to AUTH_CAPTURE
                //echo "<pre>";
               //echo $this->authorize_net->authorizeAndCapture();exit;
                
		if( $this->authorize_net->authorizeAndCapture() )
		{   //echo "aa";exit;
                        $paymentdata['amount']=$paidamt;
                        $paymentdata['tokan']=$this->authorize_net->getTransactionId();
                        $paymentdata['paystatus']='success';
                        
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
                          //$this->redirectheader("profile/");//redirect(BASE_URL."profile/","refresh"); 
			/*echo '<h2>Success!</h2>';
			echo '<p>Transaction ID: ' . $this->authorize_net->getTransactionId() . '</p>';
			echo '<p>Approval Code: ' . $this->authorize_net->getApprovalCode() . '</p>';*/
		}
		else
		{ 
                    //print_r($this->authorize_net->getError());
                    //echo $this->input->post('paymenttype');
                    //echo "aa1";exit;
			/*echo '<h2>Fail!</h2>';
			// Get error
			echo '<p>' . $this->authorize_net->getError() . '</p>';
			// Show debug data
                        $this->authorize_net->debug();
			*/
                
                        $this->session->set_flashdata("warning",$this->authorize_net->getError());
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
            $data_transaction=array('table'=>'transaction','val'=>array(
               'trans_id'=>$data['tokan'],
               'order_id'=>$this->session->userdata("campaignid"),
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
        if($table['rows'][0]->paid==0){
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
                'pt'=>'A',
                'tansdatetime'=>$data['datetime']); 
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
        
        // 6th apr 2016
            
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
               'pt'=>'A',
               'tansdatetime'=>$data['datetime']);
         }
         $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
         $insert=$this->common->insert_multi_row($data111);
         $this->emptyamount();
         $this->session->unset_userdata('productpricedetails');
         $this->session->unset_userdata('total_product_price');
        // End price details with tax sellerwise
        
        
       if($result && $result2 && $insert)
       {    
           $this->send_mail_buyer($data['tokan']);
           $this->send_mail_seller($data['tokan']); 
           $this->session->set_flashdata("sucess","Successfully paid");
           redirect("share","refresh");
         //$this->session->set_flashdata("sucess","Successfully paid ");
         //$this->redirectheader("products/1");//redirect(BASE_URL."profile/","refresh"); 
       }
       else{
       $this->session->set_flashdata("warning","Sorry payment failure");
         $this->redirectheader("products/1");//redirect(BASE_URL."profile/","refresh"); 
       }
       $this->emptysessionvalue();
    }
    public function card_payment_insert_user($data)
    {   
        //echo $this->session->userdata('promotioncode'); exit;
   //echo"hi"; exit;
        //print_r($_POST);exit;
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
           //echo "<pre>";
           //print_r($pack_res);exit;
           //$pack_type=$pack_res['rows'][0]->type;
           $pack_period=$pack_res['rows'][0]->noOfDays;
           $expire=date('Y-m-d', strtotime('+'.$pack_period.' day', strtotime($date)));
           $sub_data=array('table'=>'subscription_expire','val'=>array('user_id'=>$this->session->userdata('user_id'),'package_id'=>$pack_id,'start_date'=>$date,'end_date'=>$expire));
           $result4=$this->common->add_data($sub_data);
           
           $exp_ads=date('Y-m-d', strtotime('+'.'21'. 'day', strtotime($date)));
           $ads_data=array('table'=>'ads_subscription','val'=>array('user_id'=>$this->session->userdata('user_id'),'title'=>"",'content'=>"",'html_data'=>"",'image'=>"",'paid_status'=>'1','ads_date'=>"",'exp_date'=>$exp_ads));                
           $result5=$this->common->add_data($ads_data);
          
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
    {  //echo $data['auctionid'];exit;
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
                'commission'=>$admincommission, // (($data['amount']*admincomm)/100)
                'status'=>'0',
                'pt'=>'A',
                'tansdatetime'=>$data['datetime']); 
           $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
           $insert=$this->common->add_data($data111);
            
//echo $data['tokan'];
//            echo $this->db->last_query();
//echo '<pre>';
//print_r($items);exit;
		// 6th apr 2016
            
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
       { //echo "succ_".BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id;exit;
           $this->emptyamount();
       $this->session->set_flashdata("sucess","Successfully paid");
       redirect(BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id,"refresh"); exit;
       }else{  //echo BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id;exit;
       $this->session->set_flashdata("warning","Sorry Not Paid Successfully");
       redirect(BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id,"refresh"); exit;
        ///$this->redirectheader("profile/");//redirect(BASE_URL."profile/","refresh"); 
       }
       $this->emptysessionvalue();
    }
        
    public function defoultpage()
    {
//        if($this->input->get("paymenttype")=='bidproduct'){
//            $bidid=$this->uri->segment(4);
//            $data=array("table"=>"bid_tbl_cart","val"=>array("max(price) as price"),"where"=>array("auction"=>$bidid));
//            $log=$this->common->getdata($data);
//            $price['bidprice']=$log['rows'][0]->price;
//        }else{
//            $price['bidprice']='';
//        }
        
       $this->load->view('include/header');
        $this->load->view('payment/Authorize');
        $this->load->view('include/footer');
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
    
    
    //payment for ads By Ravi 
    public function card_payment_ads($data){
           //echo "<pre>";
    //print_r($data);
     //print_r($_POST);
    //echo "<br>";
        //echo $this->session->userdata('user_id'); exit; 
        //echo $tp=$_REQUEST['paymenttype'];exit;
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
            //print_r($expire); exit;
            //$category=$this->input->post("id");
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
    
}
?>