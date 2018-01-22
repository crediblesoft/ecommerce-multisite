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
			//print_r($this->session->userdata);exit;
			 $token=  $this->input->get('token');
            $data=$this->paypal->CheckoutDetails($token);
			
			if($data['response']==true && $data['type']=='cart')
            {
                   $pay_amount=$data['amount'];
                   $currency=$data['currency'];
                    $transId=$this->input->get('token');
			       $date=date('Y-m-d');
				if($this->session->userdata('user_id')!=''){
					$orderid=$this->session->userdata('user_id');
				}
				else{
					$orderid='';
				}
            $data_transaction=array('table'=>'transaction','val'=>array(
               'trans_id'=>$token,
               //'order_id'=>$this->session->userdata("campaignid"),
               'order_id'=>$orderid,     
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
            $data2=array('table'=>'campaign_payment_detail','val'=>array(
               'trans_id'=>$token,
               'campaign_id'=>$this->session->userdata("campaignid"),
               'buyerId'=>$this->session->userdata("buyerid")!=""?$this->session->userdata("buyerid"):'000',
               'seller_id'=>$this->session->userdata("sellerid"),
               'price'=>$data['amount'],
               'name'=>$this->session->userdata("name"),
               'status'=>'1',
               'date'=>$date));
           $result=$this->common->add_data($data_transaction);
           $result2=$this->common->add_data($data2);
           $this->session->set_userdata("shareproduct",array("trans_detail"=>$data_transaction['val'],"data"=>$data2['val']));
          
         $comment1=array('val'=>'u.paid','table'=>'campaign_payment_detail as cpd','where'=>array("cpd.trans_id"=>$data['tokan']),'group_by'=>'','minvalue'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
         $multijoin1=array(
             array('table'=>'user_Info as u','on'=>'cpd.seller_id=u.id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        $comment1=array('val'=>'*','table'=>'tb_admin_commision as t_ac','where'=>array(),'minvalue'=>'','group_by'=>'t_ac.id','start'=>'','orderby'=>'','orderas'=>'');
        $commission=$this->common->getdata($comment1);
        //echo "<pre>";
        //print_r($table); exit;
        $premium=$commission['rows'][0]->comm_for_premium;
        $free_user=$commission['rows'][0]->comm_for_freeuser;
        $ex_total=0;
        if($table['rows'][0]->paid==1){
          $ex_total=$data['amount']-($data['amount']*$premium/100);  
        }
        else{
          $ex_total=$data['amount']-($data['amount']*$free_user/100);  
        }
           $transaction_seller=array(
                'trans_id'=>$token,
                'seller_id'=>$this->session->userdata("sellerid"),
                'tax'=>'0',
                'total'=>$data['amount'],
                'commission'=>$data['amount']-$ex_total, // (($data['amount']*admincomm)/100)
                'status'=>'0',
                'pt'=>'P',
                'tansdatetime'=>$date); 
            $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
            $insert=$this->common->add_data($data111);
           //echo "<pre>";
           //print_r($insert); exit;
           if($result && $result2)
           {
               $this->session->set_flashdata("sucess","Payment successfully.You can share this donation with facebook.");
               redirect("share","refresh");
//             $this->session->set_flashdata("sucess","Successfully paid ");
//             $this->redirectheader("campaign/");//redirect(BASE_URL."campaign/","refresh"); 
           }
           else{
           $this->session->set_flashdata("warning","Sorry payment failure");
             $this->redirectheader("campaign/");//redirect(BASE_URL."campaign/","refresh"); 
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
