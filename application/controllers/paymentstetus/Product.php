<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends MY_Controller {
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
						
						$admincomm=$this->getadminsettings(); 
						
						$data['datetime']=$date;
						$data_transaction=array('table'=>'transaction','val'=>array(
						   'trans_id'=>$token,
						   'order_id'=>$this->session->userdata('user_id'),
						   'price'=>$data['amount'],
						   'date'=>$date,
						   'payment_for'=>"product",
								'name'=>$this->session->userdata('name'), 
								'email'=>$this->session->userdata('email'), 
								'street'=>$this->session->userdata('street'), 
								'city'=>$this->session->userdata('city'), 
								'state'=>$this->session->userdata('state'), 
								'zipCode'=>$this->session->userdata('zip'), 
								'Payment_type'=>$this->session->userdata('data1'), 
								'payment_with'=>$this->session->userdata('data2'),
						   'status'=>'success'));                    

							foreach ($this->cart->contents() as $items)
							{
								$data1=array('table'=>'order_detail_form','val'=>array(                       
									'status'=>'1',
									'buyerId'=>$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'000',
									'product_id'=>$items['id'],
									'price'=>$items['price'],//$items['subtotal'],
									'quantity'=>$items['qty'],
									'trans_id'=>$token,
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
						'trans_id'=>$token,
						'bill_name'=>$this->session->userdata('bill_name'), 
						'bill_email'=>$this->session->userdata('bill_email'), 
						'bill_street'=>$this->session->userdata('bill_street'), 
						'bill_city'=>$this->session->userdata('bill_city'), 
						'bill_state'=>$this->session->userdata('bill_state'), 
						'bill_zipCode'=>$this->session->userdata('bill_zipCode')
						));  
                    $result_bill=$this->common->add_data($data_billingadd);
							
                   $result=$this->common->add_data($data_transaction);
				   
				   foreach($this->session->userdata('productpricedetails') as $productdetails){
					$admincommission =  (($productdetails->prod_total*$admincomm->commission)/100); 
					$transaction_seller[]=array(
					   'trans_id'=>$token,
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
		  
		
				 $this->session->unset_userdata('productpricedetails');
				 $this->session->unset_userdata('total_product_price');
				 		
                 
				if($result && $result2 && $insert)
				   {   
					   $this->send_mail_buyer($token);
					   $this->send_mail_seller($token); 
					   $this->session->set_flashdata("sucess","Successfully paid");
					   redirect("share","refresh");
					
				   }
				  else{
					   $this->session->set_flashdata("warning","Sorry payment failure");
						 $this->redirectheader("products/1");//redirect(BASE_URL."profile/","refresh"); 
					   }
                     $this->emptysessionvalue();
      
            }
        }
    }
   public function emptysessionvalue()
    {
        unset($_SESSION['name'],$_SESSION['email'],$_SESSION['street'],$_SESSION['city'],$_SESSION['state'],$_SESSION['zip'],$_SESSION['data1'],$_SESSION['data2'],$_SESSION['data3']);         
    }
	
	public function emptyamount(){
        $this->session->set_userdata("total_payment_price",0);
        if($this->session->has_userdata('themeprice')){$this->session->unset_userdata('themeprice');}
        if($this->session->has_userdata('total_product_price')){$this->session->unset_userdata('total_product_price');}
    }
	
}
