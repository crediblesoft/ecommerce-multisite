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
                    $data_transaction=array('table'=>'transaction','val'=>array(
                       'trans_id'=>$token,
                       'order_id'=>$this->session->userdata("user_id"),
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
                            $data=array('table'=>'order_detail_form','val'=>array(                       
                                'status'=>'1',
                                'buyerId'=>$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'000',
                                'product_id'=>$items['id'],
                                'price'=>$items['price'],//$items['subtotal'],
                                'quantity'=>$items['qty'],
                                'trans_id'=>$token,
                                'date'=>$date));
                            $result2=$this->common->add_data($data);
                            $get_product=$this->get_product_details($items['id']);
                            $quantity=($get_product['rows'][0]->no_of_Prod-$items['qty']);
                            $update_quantity_data=array('table'=>'product','val'=>array('no_of_Prod'=>$quantity),'where'=>array('id'=>$items['id']));
                            $update_qty=$this->common->update_data($update_quantity_data);                    
                        }
                        $this->cart->destroy();
                   $result=$this->common->add_data($data_transaction);
                  
                   if($result && $result2)
                   {$this->emptysessionvalue();
                   $this->session->set_flashdata("sucess","Successfully paid ");
                   ?>
                    <script>
                        window.location.assign('<?php echo BASE_URL."products/1"?>');
                    </script>
                 <?php
                   //redirect(BASE_URL."campaign/","refresh"); 
                   }
                   else{
                       $this->emptysessionvalue();
                   $this->session->set_flashdata("sucess","Sorry Not Paid Successfully");
                    ?>
                    <script>
                        window.location.assign('<?php echo BASE_URL."products/1"?>');
                    </script>
                 <?php
                   //redirect(BASE_URL."campaign/","refresh");
                   }
                   
            }
        }
    }
   public function emptysessionvalue()
    {
        unset($_SESSION['name'],$_SESSION['email'],$_SESSION['street'],$_SESSION['city'],$_SESSION['state'],$_SESSION['zip'],$_SESSION['data1'],$_SESSION['data2'],$_SESSION['data3']);         
    }
}
