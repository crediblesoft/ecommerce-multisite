<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_payment extends MY_Controller {
    //private $userid;
    function __construct()
    {
        parent::__construct();
         $this->load->helper('array');
        $this->load->helper('url'); 
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('paypal');
    }
    public function index()
    { 
        
        
        if($this->input->post('paytype')==1){
           $this->paument_bycard();
                }
                else  if($this->input->post('paytype')==2)
                {
                    $this->paument_bysite();
                
                }else{
                   $this->load->view('include/header');
        $this->load->view('payment/campaign_payment');
        $this->load->view('include/footer'); 
                }
    }
    public function paymentcancel()
    {
        print_r($_POST());
    }
    public function paymentsuccess()
    {
        print_r($_POST());
    }
    public function notify_payment()
    {
         print_r($_POST());
    }
    public function paument_bysite()
    {
        $this->form_validation->set_rules('name', 'User name', 'trim|required');//trim|required|max_length[20]|xss_clean
        $this->form_validation->set_rules('email', 'User email', 'trim|required');
        
            $this->form_validation->set_rules('street', 'Street', 'trim|required');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('zip', 'Zip', 'trim|required');         
        

        if($this->form_validation->run()) {
           
            //$exp=  explode('-', $this->input->post('expiration_date'));
                //print_r($exp);
                //$expiry=$exp[1].'/'.$exp[0];
                $data=array(
                //'card_type'=>  $this->input->post('card_type'),
                //'cvv'=>$this->input->post('security_code'),
                //'expiry_date'=>$expiry,
                'firstname'=>  $this->input->post('name'),               
                'email'=>$this->input->post('email'),
                'amount'=>$this->input->post('amount'),
                'street'=>$this->input->post('street'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'zip'=>$this->input->post('zip'));
                //'name_on_card'=>$this->input->post('name_on_card'));
               // $result1=$this->card_payment($data);
                 /* print_r($result1);echo "<br/><br/>";
               $result2=explode('&',$result1);
                $result=array();
                foreach ($result2 as $res){ 
                    $re=explode('=',$res);
                    $result[$re[0]]=$re[1];

                }
                print_r($result);echo "<br/><br/>";
                */
                   // $this->paynow();
                 $result= $this->paypal->CheckoutDetails();//$data
                 print_r($result);exit;
                    if($result['ACK']=='Failure')
                { print_r($result);exit;
                    $this->session->set_flashdata('err',$result['L_LONGMESSAGE0']);
                }elseif($result['ACK']=='Success'){
                    $this->paynow();
                }
               
         }else{
        
        $this->load->view('include/header');
        $this->load->view('payment/campaign_payment');
        $this->load->view('include/footer');
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
        

        if($this->form_validation->run()) {
           
            $exp=  explode('-', $this->input->post('expiration_date'));
                //print_r($exp);
                $expiry=$exp[1].'/'.$exp[0];
                $data=array('credit_card_no'=>  $this->input->post('credit_card_no'),
                'card_type'=>  $this->input->post('card_type'),
                'cvv'=>$this->input->post('security_code'),
                'expiry_date'=>$expiry,
                'firstname'=>  $this->input->post('name'),               
                'email'=>$this->input->post('email'),
                'amount'=>$this->input->post('amount'),
                'street'=>$this->input->post('street'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'zip'=>$this->input->post('zip'),
                'name_on_card'=>$this->input->post('name_on_card'));
                $result1=$this->_pay($data);
                  print_r($result1);echo "<br/><br/>";
               $result2=explode('&',$result1);
                $result=array();
                foreach ($result2 as $res){ 
                    $re=explode('=',$res);
                    $result[$re[0]]=$re[1];

                }
                print_r($result);echo "<br/><br/>";
                if($result['ACK']=='Failure')
                { print_r($result);exit;
                    $this->session->set_flashdata('err',$result['L_LONGMESSAGE0']);
                }elseif($result['ACK']=='Success'){
                    $this->paynow();
                }
         }else{
        
        $this->load->view('include/header');
        $this->load->view('payment/campaign_payment');
        $this->load->view('include/footer');
        }
    }

    







    public function _pay($data)
        {
            $this->load->library('paypal');
            $res=$this->paypal->create_recurring($data);
            return $res;
        }
         public function paynow()
        {
            
                $config['RETURNURL']                     = BASE_URL.'campaign_payment/';
                $config['CANCELURL']                     = BASE_URL.'campaign_payment/paymentcancel';
                $config['PAYMENTREQUEST_0_NOTIFYURL']    = BASE_URL.'campaign_payment/notify_payment'; //IPN Post
                $config["INVOICE"]                       =  random_string('numeric',8); //The invoice id
                $config['PAYMENTREQUEST_0_CUSTOM']       =  $this->session->userdata('user_id');
                $config['L_PAYMENTREQUEST_0_QTY0']       =  1;
                $config['PAYMENTREQUEST_0_CURRENCYCODE'] =  'USD';
                $config['L_BILLINGTYPE0']                =  'RecurringPayments';
                $this->load->library('paypal');
    //            switch($this->session->userdata['signup']['listing_type']){case 1:if($this->session->userdata['signup']['listing_subtype']=='1'){$price=1395;$listing='Featured Listing  6 Months';}elseif($this->session->userdata['signup']['listing_subtype']=='2'){$price=2225;$listing='Featured Listing  1 Year';}break;
    //            case 2:if($this->session->userdata['signup']['listing_subtype']=='1'){$price=1125;$listing='Premium Listing  6 Months';}elseif($this->session->userdata['signup']['listing_subtype']=='2'){$price=1825;$listing='Premium Listing  1 Year';}break;
    //            case 3:if($this->session->userdata['signup']['listing_subtype']=='1'){$price=825;$listing='General Listing  6 Months';}elseif($this->session->userdata['signup']['listing_subtype']=='2'){$price=1325;$listing='General Listing  1 Year';}break;}
               //$price=100;
                $this->session->set_userdata('amt',$price);
                $config['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';

                $config['PAYMENTREQUEST_0_ITEMAMT'] =$config['L_PAYMENTREQUEST_0_AMT0']=$config['PAYMENTREQUEST_0_AMT']=$price;
                $config['L_BILLINGAGREEMENTDESCRIPTION0']=$config['L_PAYMENTREQUEST_0_DESC0']=$listing;
                print_r($config);
                $this->paypal->pay($config); //Proccess the payment
            
        }
     
}