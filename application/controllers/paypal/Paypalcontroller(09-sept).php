<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paypalcontroller extends MY_Controller {
    //private $userid;
    function __construct()
    {
        parent::__construct();
        //$this->load->library('session');
        //$this->load->helper('array');
        //$this->load->helper('url'); 
        //$this->load->library('form_validation');
        //$this->load->helper('form');
        $this->load->library('paypal');
    }
    public function index()
    {        
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
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
        if($this->form_validation->run()) 
            {        
                if($this->input->post('paymenttype')=='product' || $this->input->post('paymenttype')=='user' || $this->input->post('paymenttype')=='bidproduct'){
            $paidamt=$this->session->userdata("total_payment_price");
            }else{$paidamt=$this->input->post('amount');}
                $data=array('name'=>$this->input->post('name'),               
                'email'=>$this->input->post('email'),
                'amount'=>$paidamt,
                'street'=>$this->input->post('street'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'zip'=>$this->input->post('zip'),
                    'data1'=>'Paypal Acount',
                    'data2'=>'Paypal',
                    'data3'=>'',
                'campaignid' => $this->input->post('campaignid'),
                'buyerid' => $this->input->post('buyerid'),
                'sellerid' => $this->input->post('sellerid'));
                $this->setsessionvalue($data);
                /*$config['first_name']=$this->input->post('name');
                $config['last_name']='Paypal';
                $config['address_name']='Card';
                $config['address_street']=$this->input->post('street');
                $config['address_city']=$this->input->post('city');
                $config['address_state']=$this->input->post('state');
                $config['address_zip']=$this->input->post('zip');
                $config['address_country']='';
                $config['payer_email']=$this->input->post('email');*/
                 //print_r($data);echo "<br/><br/>";
                 $amount = $paidamt;
                //for campaign payment Url's
                 if($this->input->post('paymenttype')=='campaign'){                     
                $title = "Payment for Campaign";            
                /*$config['RETURNURL'] = BASE_URL . 'paypal/paypalcontroller/paymentsuccess';
                $config['CANCELURL'] = BASE_URL . 'paypal/paypalcontroller/paymentcancel';*/
                 $config['RETURNURL'] = BASE_URL . 'paymentstetus/campaign/paymentsuccess';
                    $config['CANCELURL'] = BASE_URL . 'paymentstetus/campaign/paymentcancel';
                  //for product payment Url's
                 }elseif($this->input->post('paymenttype')=='product'){  
                     //$amount=  $this->cart->total();
                    $title = "Payment for Product";            
                    $config['RETURNURL'] = BASE_URL . 'paymentstetus/product/paymentsuccess';
                    $config['CANCELURL'] = BASE_URL . 'paymentstetus/product/paymentcancel';
                  //for paiduser payment Url's
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
            $exp=explode('/', $this->input->post('expiration_date'));
            //print_r($exp);
            $expiry=$exp[0].$exp[1];
            if($this->input->post('paymenttype')=='product' || $this->input->post('paymenttype')=='user' || $this->input->post('paymenttype')=='bidproduct'){
            $paidamt=$this->session->userdata("total_payment_price");
            }else{$paidamt=$this->input->post('amount');}
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
       // print_r($data);
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
            // print_r($response);
                if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) 
                {
                    foreach ($matches['name'] as $offset => $name) 
                    {
                        $nvp[$name] = urldecode($matches['value'][$offset]);
                    }
                } //print_r($nvp);         
                if($nvp['ACK']=='Success' || $nvp['ACK']=='SuccessWithWarning') 
                    {//print_r($this->cart->contents());                        
                      //  echo "<br/><br/><br/><br/><br/>";
                        //print_r($nvp);exit;                        
                        // database work here...
                    
                        $paymentdata['amount']=$nvp['AMT'];
                        $paymentdata['tokan']=$nvp['TRANSACTIONID'];
                        $paymentdata['paystatus']=$nvp['ACK'];
                        if($this->input->post('paymenttype')=='campaign'){                     
                        $this->card_payment_insert_campaign($paymentdata);
                          //for product payment Url's
                         }elseif($this->input->post('paymenttype')=='product'){  
                             $this->card_payment_insert_product($paymentdata);
                          //for paiduser payment Url's
                         }elseif($this->input->post('paymenttype')=='user'){    
                         $this->card_payment_insert_user($paymentdata);
                        }elseif($this->input->post('paymenttype')=='bidproduct'){
                            $paymentdata['auctionid']=$this->input->post('campaignid');
                         $this->card_payment_insert_bidproduct($paymentdata);
                        } 
                        
                        /*$date=date('Y-m-d');
                        $data_transaction=array('table'=>'transaction','val'=>array(
                           'trans_id'=>$token,
                           //'order_id'=>$this->session->userdata("campaignid"),
                           'price'=>$data['amount'],
                           'date'=>$date,
                           'payment_for'=>"campeign",
                           'status'=>'success'));
                        $data2=array('table'=>'campaign_payment_detail','val'=>array(
                           'trans_id'=>$token,
                           'campaign_id'=>$this->session->userdata("campaignid"),
                           'buyerId'=>$this->session->userdata("buyerid")!=""?$this->session->userdata("buyerid"):'000',
                           'seller_id'=>$this->session->userdata("sellerid"),
                           'price'=>$data['amount'],
                           'name'=>$this->session->userdata("name"),
                           'status'=>'1',
                           'date'=>$date));
                       $result=$this->common->add_data($data_transaction);
                       $result2=$this->common->add_data($data2);
                       if($result && $result2)
                       {
                       $this->session->set_flashdata("sucess","Successfully paid ");
                       redirect(BASE_URL."campaign/","refresh"); 
                       }
                       else{
                       $this->session->set_flashdata("sucess","Sorry Not Paid Successfully");
                       redirect(BASE_URL."campaign/","refresh"); 
                       }
                    $this->emptysessionvalue();*/
                               
                }elseif(isset($nvp['L_SEVERITYCODE0']))
                 {
                     $view['error']=$nvp['L_LONGMESSAGE0'];
                        //$this->session->set_flashdata('messages', $nvp['L_LONGMESSAGE0']);
                        //redirect(SITE_URL . 'payment/' . $url);
                    //print_r($view['error']);                     
                     $this->session->set_flashdata("warning","Sorry payment failure , ".$view['error']);
                     if($this->input->post('paymenttype')=='product'){
                            redirect("products/viewcart","refresh"); 
                        }else{
                    redirect(BASE_URL.$this->input->post('paymenttype')."/","refresh"); 
                        }
                 }
                 elseif ($nvp['ACK']=='Failure') 
                     {
                  $this->session->set_flashdata("warning","Sorry payment failure");
                  redirect(BASE_URL.$this->input->post('paymenttype')."/","refresh"); 
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
               //'order_id'=>$this->session->userdata("campaignid"),
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
               'name'=>$this->session->userdata("name"),
               'status'=>'1',
               'date'=>$date));
           $result=$this->common->add_data($data_transaction);
           $result2=$this->common->add_data($data2);
           $this->session->set_userdata("shareproduct",array("trans_detail"=>$data_transaction['val'],"data"=>$data2['val']));
           if($result && $result2)
           { //echo "aa";exit;
           //$this->session->set_flashdata("sucess","Successfully paid");
           //$this->redirectheader("campaign/");//
           //redirect(BASE_URL."campaign/","refresh"); exit;
               $this->session->set_flashdata("sucess","Payment successfully.You can share this donation with facebook.");
               redirect("share","refresh");
           }
           else{
           $this->session->set_flashdata("warning","Sorry Not Paid Successfully");
           //$this->redirectheader("campaign/");
           redirect(BASE_URL."campaign/","refresh"); 
           }
        $this->emptysessionvalue();
    }
    public function card_payment_insert_product($data)
    {
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
                $get_product=$this->get_product_details($items['id']);
                $quantity=($get_product['rows'][0]->no_of_Prod-$items['qty']);
                $update_quantity_data=array('table'=>'product','val'=>array('no_of_Prod'=>$quantity),'where'=>array('id'=>$items['id']));
                $update_qty=$this->common->update_data($update_quantity_data);               
            }
            $this->session->set_userdata("shareproduct",array("trans_detail"=>$data_transaction['val'],"data"=>$this->cart->contents()));
        $this->cart->destroy();
        $result=$this->common->add_data($data_transaction);

       if($result && $result2)
       {
//       $this->session->set_flashdata("sucess","Successfully paid ");
//       //$this->redirectheader("profile/");//
//       redirect(BASE_URL."products/1","refresh"); exit;
            $this->session->set_flashdata("sucess","Successfully paid");
           redirect("share","refresh");
       }
       else{
       $this->session->set_flashdata("warning","Sorry Not Paid Successfully");
        $this->redirectheader("profile/");//redirect(BASE_URL."profile/","refresh"); 
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
           $data1=array('table'=>'user_Info','val'=>array('paid'=>'1'),'where'=>array('id'=>$this->session->userdata('user_id')));
            $result2=$this->common->update_data($data1);
           $result=$this->common->add_data($data_transaction);
           if($result && $result2 && $result3)
           {
           $this->session->set_flashdata("sucess","Successfully paid ");
            //$this->redirectheader("profile/");
            redirect(BASE_URL."profile/","refresh"); exit;
           }
           else{
           $this->session->set_flashdata("warning","Sorry Not Paid Successfully");
            //$this->redirectheader("profile/");
            redirect(BASE_URL."profile/","refresh"); 
           }
        $this->emptysessionvalue();
    }
    
    
    public function card_payment_insert_bidproduct($data)
    {  //$data['auctionid'];exit;
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
            
            $orderdata=array('table'=>'order_detail_form','val'=>array(                       
                  'status'=>'1',
                  'buyerId'=>$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'000',
                  'product_id'=>$items['rows'][0]->prod_id,// current bid product id
                  'price'=>$data['amount'],//this is bid amount
                  'quantity'=>'1',
                  'trans_id'=>$data['tokan'],
                  'date'=>$date));
          $result2=$this->common->add_data($orderdata);
        $result=$this->common->add_data($data_transaction);
//echo $data['tokan'];
//            echo $this->db->last_query();
//echo '<pre>';
//print_r($items);exit;
       if($result && $result2)
       { //echo "succ_".BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id;exit;
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
        if($this->input->get("paymenttype")=='bidproduct'){
            $bidid=$this->uri->segment(4);
            $data=array("table"=>"bid_tbl_cart","val"=>array("max(price) as price"),"where"=>array("auction"=>$bidid));
            $log=$this->common->getdata($data);
            $price['bidprice']=$log['rows'][0]->price;
        }else{
            $price['bidprice']='';
        }
        
        $this->load->view('include/header');
        $this->load->view('payment/Paypalview',$price);
        $this->load->view('include/footer');
    }
    public function paymentcancel()
    {
        $this->emptysessionvalue();
        $this->session->set_flashdata("warning","Sorry Not Paid Successfully");
        //$this->redirectheader("profile/");
        redirect(BASE_URL."profile/","refresh"); 
        
    }
    /*public function paymentsuccess()
    {
        if($this->input->get('token')!='' && !isset($_GET['cancel']))
	{
           $token=  $this->input->get('token');
           $data=$this->paypal->CheckoutDetails($token);
           print_r($data);
            if($data['response']==true && $data['type']=='cart')
            {
                   $pay_amount=$data['amount'];
                   $currency=$data['currency'];
                    $transId=$this->input->get('token');
                    $date=date('Y-m-d');
                    $data_transaction=array('table'=>'transaction','val'=>array(
                       'trans_id'=>$token,
                       //'order_id'=>$this->session->userdata("campaignid"),
                       'price'=>$data['amount'],
                       'date'=>$date,
                       'payment_for'=>"campeign",
                       'status'=>'success'));
                    
                   $data=array('table'=>'campaign_payment_detail','val'=>array(
                       'trans_id'=>$token,
                       'campaign_id'=>$this->session->userdata("campaignid"),
                       'buyerId'=>$this->session->userdata("buyerid")!=""?$this->session->userdata("buyerid"):'000',
                       'seller_id'=>$this->session->userdata("sellerid"),
                       'price'=>$data['amount'],
                       'name'=>$this->session->userdata("name"),
                       'status'=>'1',
                       'date'=>$date));
                   $result=$this->common->add_data($data_transaction);
                   $result2=$this->common->add_data($data);
                   if($result && $result2)
                   {
                   $this->session->set_flashdata("sucess","Successfully paid ");
                     $this->redirectheader("campaign/");//redirect(BASE_URL."campaign/","refresh"); 
                   }
                   else{
                       
                   $this->session->set_flashdata("warning","Sorry Not Paid Successfully");
                     $this->redirectheader("campaign/");//redirect(BASE_URL."campaign/","refresh"); 
                   }
                   $this->emptysessionvalue();
            }
        }
    }*/
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
    /*
    public function insertdata()
    {
        
        $date=date('Y-m-d');
         $data_transaction=array('table'=>'transaction','val'=>array(
            'trans_id'=>$token,
            'order_id'=>'',
            'price'=>$data['amount'],
            'date'=>$date,
            'payment_for'=>"campeign",
            'status'=>'1'));
        $data=array('table'=>'campaign_payment_detail','val'=>array(
            'trans_id'=>$token,
            'campaign_id'=>$this->session->userdata("campaignid"),
            'buyerId'=>$this->session->userdata("buyerid"),
            'seller_id'=>$this->session->userdata("sellerid"),
            'price'=>$data['amount'],
            'name'=>$this->session->userdata("name"),
            'status'=>'1',
            'add_date'=>$date));
        $result=$this->common->add_data($data_transaction);
        $result2=$this->common->add_data($data);
        if($result && $result2)
        {
        $this->session->set_flashdata("sucess","Successfully paid ");
        redirect(BASE_URL."campaign_payment/","refresh"); 
        }
        else{
        $this->session->set_flashdata("sucess","Sorry Not Paid Successfully");
        redirect(BASE_URL."campaign_payment/","refresh"); 
        }
        $this->emptysessionvalue();
        //INSERT INTO `transaction`(`id`, `trans_id`, `order_id`, `price`, `date`, `payment_for`, `status`)
        //INSERT INTO `campaign_payment_detail`(`id`, `campaign_id`, `buyerId`, `seller_id`, `price`, `name`,`status` ,`date`)
    }*/
}
