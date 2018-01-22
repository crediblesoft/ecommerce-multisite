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
                          $data=array("table"=>"product_auction","val"=>array("prod_id"),"where"=>array("id"=>$bidid));
                          $items=$this->common->getdata($data);
                          
                        $orderdata=array('table'=>'order_detail_form','val'=>array(                       
                                'status'=>'1',
                                'buyerId'=>$this->session->userdata('user_id')!=""?$this->session->userdata('user_id'):'000',
                                'product_id'=>$items['rows'][0]->prod_id,// current bid product id
                                'price'=>$data['amount'],//this is bid amount
                                'quantity'=>'1',
                                'trans_id'=>$token,
                                'date'=>$date));
                        $result2=$this->common->add_data($orderdata);
                   $result=$this->common->add_data($data_transaction);
                  
                   if($result && $result2)
                   {$this->emptysessionvalue();
                   $this->session->set_flashdata("sucess","Successfully paid"); 
                   ?>
                    <script>
                        window.location.assign('<?php echo BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id?>');
                    </script>
                 <?php
                   //redirect(BASE_URL."campaign/","refresh"); 
                   }
                   else{
                       $this->emptysessionvalue();
                   $this->session->set_flashdata("sucess","Sorry Not Paid Successfully");
                    ?>
                    <script>
                        window.location.assign('<?php echo BASE_URL."bid/porductdetails/".$items['rows'][0]->prod_id?>');
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
