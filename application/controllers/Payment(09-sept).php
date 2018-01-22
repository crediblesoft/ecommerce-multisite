<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends MY_Controller 
{

    public function __construct()
    {
        parent::__construct();
       $this->load->library('session');
    }    
    public function index()
    {
         $str="";
        if($_REQUEST['paymenttype']=="campaign")
        {
            //$str.="campaign_payment/index/";  
            $str.=$this->uri->segment(3)."/";
            $str.=$this->uri->segment(4)."/";
            $str.=$this->uri->segment(5);
            $str.="?paymenttype=campaign";
            $data=array('str'=>$str);
            $this->session->set_userdata('campaignid', $this->uri->segment(3));
            $this->session->set_userdata('sellerid', $sellerid=$this->uri->segment(4));
            $this->session->set_userdata('buyerid', $this->uri->segment(5));
           
        }elseif($_REQUEST['paymenttype']=="product")
        { 
            //$this->functions->_valid_user();
            $this->_checkvalid("payment/index?paymenttype=product");
            $this->add_shipping_charge($this->input->post());
            $str.=$this->session->userdata('user_id').'/ / ';                  
            $str.="?paymenttype=product";
            $data=array('str'=>$str);           
        }elseif($_REQUEST['paymenttype']=="user")
        {
            //$this->functions->_valid_user();
            $this->_checkvalid("payment/index?paymenttype=user");
            $this->session->set_userdata('themeid', $this->uri->segment(3));
           // $this->session->set_userdata('themeprice', $sellerid=$this->uri->segment(4));
			$this->session->set_userdata('themeprice', $this->session->userdata('subscription_total_amt'));
            $str.=$this->uri->segment(3)."/";
            $str.=$this->uri->segment(4)."/";
            $str.=$this->uri->segment(5);
            $str.="?paymenttype=user";            
            $data=array('str'=>$str);         
        }elseif($_REQUEST['paymenttype']=="bidproduct")
        {
           //echo $this->uri->segment(3);exit;
            $this->add_shipping_charge($this->input->post());
            $str.=$this->uri->segment(3)."/";
            $str.=$this->uri->segment(4);
            $str.="?paymenttype=bidproduct";      
            $data=array('str'=>$str);         
        }
        elseif($_REQUEST['paymenttype']=="ads")
        { 
            $str.=$this->uri->segment(3)."/";
            //$str.=$this->uri->segment(4)."/";
            $str.="?paymenttype=ads";
            $data=array('str'=>$str);
            //$this->session->set_userdata('price',$price=$this->session->userdata('price'));
            $this->session->set_userdata('id', $this->uri->segment(3));
            //$this->session->set_userdata('sellerid', $sellerid=$this->uri->segment(4));
            //print_r($data); exit;
           
        }
       
        //echo "you are hare in Authorize";
        //echo $str;
       // $data=array('str'=>$str);
    /*
      echo '<br/>1'.$controller=$this->uri->segment(1);
      echo '<br/>2'.$function=$this->uri->segment(2);
      echo '<br/>3'.$campaignid=$this->uri->segment(3);
      echo '<br/>4'.$sellerid=$this->uri->segment(4); 
      echo '<br/>5'.$buyerid=$this->uri->segment(5); 
      echo '<br/>6'.$buyerid=$this->uri->segment(6); 
     */
        $this->load->view('include/header');
        $this->load->view('payment/selectPaymentType',$data);
        $this->load->view('include/footer');
    }
    
    function add_shipping_charge($postdata){  // add shipping charge before payment
        $productpricedetails=$this->session->userdata('productpricedetails');
        foreach($productpricedetails as $pricedetails){ $pricedetails=(array)$pricedetails;
            for($i=0;$i<count($postdata['sellerid']);$i++){
                if($pricedetails['user_id']==$postdata['sellerid'][$i]){
                    unset($pricedetails['shippingdetails']);
                    $pricedetails['shippingcharge']=$postdata['shipping'][$i];
                    $pricedetails['sub_total']=$postdata['subtotal'][$i];
                }
            }
            $finaldata1[]=(object)$pricedetails;
        }
        
        $this->session->set_userdata('productpricedetails',$finaldata1);
        $this->session->set_userdata('total_product_price',$postdata['totalforpayment']);
        //print_r($this->session->userdata('productpricedetails'));
        
    }
}
?>