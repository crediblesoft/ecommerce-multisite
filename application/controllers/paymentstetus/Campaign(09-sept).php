<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Campaign extends MY_Controller {
    //private $userid;
    function __construct()
    {
        parent::__construct();
         $this->load->library('session');
        $this->load->helper('array');
        $this->load->helper('url'); 
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('paypal');
    }
    public function index()
    {        
       redirect(BASE_URL."campaign/","refresh");    
    }
    public function paymentcancel()
    {
        $this->emptysessionvalue();
        $this->session->set_flashdata("sucess","You have canceled your payment");
         ?>
                <script>
                    window.location.assign('<?php echo BASE_URL."profile/"?>');
                </script>
                 <?php  
    }
    public function paymentsuccess()
    {
        if($this->input->get('token')!='' && !isset($_GET['cancel']))
	{
           $token=  $this->input->get('token');
           $data=$this->paypal->CheckoutDetails($token);
           //print_r($data);exit;
            if($data['response']==true && $data['type']=='cart')
            {
                   $pay_amount=$data['amount'];
                   $currency=$data['currency'];
                    $transId=$this->input->get('token');
                    $date=date('Y-m-d');
                    $data_transaction=array('table'=>'transaction','val'=>array(
                       'trans_id'=>$token,
                       'order_id'=>$this->session->userdata("campaignid"),
                       'price'=>$data['amount'],
                       'date'=>$date,
                       'payment_for'=>"campeign",
                        'name'=>$this->session->userdata('name'), 
                        'email'=>$this->session->userdata('email'), 
                        'street'=>$this->session->userdata('street'), 
                        'city'=>$this->session->userdata('city'), 
                        'state'=>$this->session->userdata('state'), 
                        'zipCode'=>$this->session->userdata('zip'), 
                        'Payment_type'=>$this->session->userdata('data1'), 
                        'payment_with'=>$this->session->userdata('data2'),
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
                   $this->session->set_userdata("shareproduct",array("trans_detail"=>$data_transaction['val'],"data"=>$data['val']));
                   if($result && $result2)
                   {
                       $this->emptysessionvalue();
                       $this->session->set_flashdata("sucess","Payment successfully.You can share this donation with facebook.");
                       redirect("share","refresh");
                       //$this->session->set_flashdata("sucess","Successfully paid ");
                    //redirect(BASE_URL."campaign/","refresh"); 
                   }
                   else{
                      $this->emptysessionvalue();
                      $this->session->set_flashdata("sucess","Sorry Not Paid Successfully");
                   ?><?php
                   //redirect(BASE_URL."campaign/","refresh"); 
                   }
                   $this->emptysessionvalue();
            }
        }
    }
   public function emptysessionvalue()
    {
        unset($_SESSION['name'],$_SESSION['email'],$_SESSION['street'],$_SESSION['city'],$_SESSION['state'],$_SESSION['zip'],$_SESSION['data1'],$_SESSION['data2'],$_SESSION['data3']);         
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
        $this->session->set_flashdata("sucess","Sucessfully paid ");
        redirect(BASE_URL."campaign_payment/","refresh"); 
        }
        else{
        $this->session->set_flashdata("sucess","Sorry Not Paid Sucessfully");
        redirect(BASE_URL."campaign_payment/","refresh"); 
        }
        $this->emptysessionvalue();
        //INSERT INTO `transaction`(`id`, `trans_id`, `order_id`, `price`, `date`, `payment_for`, `status`)
        //INSERT INTO `campaign_payment_detail`(`id`, `campaign_id`, `buyerId`, `seller_id`, `price`, `name`,`status` ,`date`)
    }*/
}
