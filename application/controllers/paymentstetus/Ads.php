<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ads extends MY_Controller {
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
       
    }
    public function paymentsuccess()
    {   //print_r($data);exit;
        if($this->input->get('token')!='' && !isset($_GET['cancel']))
		{
            $token=  $this->input->get('token');
           $data=$this->paypal->CheckoutDetails($token);
          
            if($data['response']==true && $data['type']=='cart')
            {
                    $pay_amount=$data['amount'];
                    $currency=$data['currency'];
                    $transId=$this->input->get('token');
                    $date=date('Y-m-d');
				$crt_id=$this->session->userdata('crt_id');
				$cat_id=$this->session->userdata('ads_category');
				$date=date('Y-m-d');
				$data_transaction=array('table'=>'transaction','val'=>array(
				   'trans_id'=>$token,
				   'order_id'=>$this->session->userdata('user_id'),
					'price'=>$data['amount'],
				   'date'=>$date,
				   'payment_for'=>"ads",
					'name'=>$this->session->userdata('name'), 
					'email'=>$this->session->userdata('email'), 
					'street'=>$this->session->userdata('street'), 
					'city'=>$this->session->userdata('city'),
					'state'=>$this->session->userdata('state'), 
					'zipCode'=>$this->session->userdata('zip'),  
					'Payment_type'=>$this->session->userdata('data1'),
					'payment_with'=>$this->session->userdata('data2'),
				   'status'=>'success'));
				 $data_user=array('table'=>'user_payment','val'=>array('user_id'=>$this->session->userdata('user_id'),'tranc_id'=>$token,'price'=>$data['amount'],'add_date'=>$date));
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
