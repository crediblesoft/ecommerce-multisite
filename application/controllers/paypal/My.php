<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My extends CI_Controller {
   // public $theme_user_id='';
    public function __construct() {
            parent::__construct();
           $this->load->helper('array');
            $this->load->helper('url'); 
             //$this->load->library('paypal');
            //$this->load->database();            
            //$this->load->model('modelsite');
              //$this->functions->_valid_user();
            //$this->editfunctions->_user_permission();
            //$this->functions->_afterloginpage_delete();
        }
        public function index()
        {
            // echo "you are hare";
                $price=100;
                //echo $this->input->post('expiration_date')."<br/>";
                $exp=  explode('-', $this->input->post('expiration_date'));
                //print_r($exp);
                $expiry=$exp[1].$exp[0];
                //echo $expiry;
                //print_r($expiry);exit;
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
            //print_r($data);
                        exit();
                $result1=$this->_pay($data);
                $result2=explode('&',$result1);
                $result=array();
                foreach ($result2 as $res){                   
                    $result[$res[0]]=$res[1];

                }
          
                if($result['ACK']=='Failure')
                { print_r($result);exit;
                    $this->session->set_flashdata('err',$result['L_LONGMESSAGE0']);
                }elseif($result['ACK']=='Success'){
                    $this->paynow();
                }
            }
        
        function _pay($data)
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
               $price=100;
                $this->session->set_userdata('amt',$price);
                $config['PAYMENTREQUEST_0_PAYMENTACTION'] = 'Sale';

                $config['PAYMENTREQUEST_0_ITEMAMT'] =$config['L_PAYMENTREQUEST_0_AMT0']=$config['PAYMENTREQUEST_0_AMT']=$price;
                $config['L_BILLINGAGREEMENTDESCRIPTION0']=$config['L_PAYMENTREQUEST_0_DESC0']=$listing;

                $this->paypal->pay($config); //Proccess the payment
            
        }
        
}