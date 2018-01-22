<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bidproduct extends MY_Controller {
    //private $userid;
    function __construct()
    {
        parent::__construct();
         //$this->load->library('session');
        $this->load->helper('array');
        $this->load->helper('url'); 
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('paypal');
    }
    public function index()
    {        
    redirect(BASE_URL."profile/","refresh");    
    }  
    

    public function paymentcancel()
    {$this->emptysessionvalue();
          $this->session->set_flashdata("sucess","You have canceled your payment");
         ?>
                <script>
                    window.location.assign('<?php echo BASE_URL."profile/"?>');
                </script>
                 <?php
        /*foreach ($this->cart->contents() as $items)
        {
            print_r($items);
        }*/
    }
    public function paymentsuccess()
    {   //echo 'here';exit;
        if($this->input->get('token')!='' && !isset($_GET['cancel']))
	   {
            $token=  $this->input->get('token');
            $data=$this->paypal->CheckoutDetails($token);
          // print_r($data);
            if($data['response']==true && $data['type']=='cart')
            {
                   $pay_amount=$data['amount'];
                   $currency=$data['currency'];
                   $transId=$this->input->get('token');				   
				   $admincomm=$this->getadminsettings(); // in %
        $date=date('Y-m-d');
        $data_transaction=array('table'=>'transaction','val'=>array(
           'trans_id'=>$token,
           'order_id'=>$this->session->userdata("auctionid"),// this is auction id
           'price'=>$data['amount'],
           'date'=>$date,
           'payment_for'=>"bidproduct",
                'name'=>$this->session->userdata('name'),
                'email'=>$this->session->userdata('email'),
                'street'=>$this->session->userdata('street'),
                'city'=>$this->session->userdata('city'),
                'state'=>$this->session->userdata('state'), 
                'zipCode'=>$this->session->userdata('zip'), 
                'Payment_type'=>$this->session->userdata('data1'),
                'payment_with'=>$this->session->userdata('data2'),
           'status'=>'success'));                    

            $bidid=$this->session->userdata("auctionid");// auction id
            $data11=array("table"=>"product_auction","val"=>array("prod_id"),"where"=>array("id"=>$bidid));
            $items=$this->common->getdata($data11);
            
            $product_details=$this->session->userdata('productpricedetails')[0];
            //print_r($product_details);exit;
            $orderdata=array('table'=>'order_detail_form','val'=>array(                       
                  'status'=>'1',
                  'buyerId'=>$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'000',
                  'product_id'=>$items['rows'][0]->prod_id,// current bid product id
                  'price'=>$product_details->prod_total,//this is bid amount
                  'quantity'=>'1',
                  'trans_id'=>$token,
                  'date'=>$date));
          $result2=$this->common->add_data($orderdata);
        $result=$this->common->add_data($data_transaction);
        $admincommission = (($product_details->prod_total*$admincomm->commission)/100);
        $transaction_seller=array(
                'trans_id'=>$token,
                'seller_id'=>$product_details->user_id,
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
                    'trans_id'=>$token,
                    'bill_name'=>$this->session->userdata('bill_name'), 
                    'bill_email'=>$this->session->userdata('bill_email'), 
                    'bill_street'=>$this->session->userdata('bill_street'), 
                    'bill_city'=>$this->session->userdata('bill_city'),
                    'bill_state'=>$this->session->userdata('bill_state'),
                    'bill_zipCode'=>$this->session->userdata('bill_zipCode')
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
        }
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
