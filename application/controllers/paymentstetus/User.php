<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MY_Controller {
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
    {   
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
                    $date=date('Y-m-d');
				   $data_transaction=array('table'=>'transaction','val'=>array(
				   'trans_id'=>$token,
				   'order_id'=>$this->session->userdata('user_id'),
				   'price'=>$data['amount'],
				   'date'=>$date,
				   'payment_for'=>"user",
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
