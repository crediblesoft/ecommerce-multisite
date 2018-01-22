<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paiduser extends MY_Controller 
{

    public function __construct()
    {
       parent::__construct();
       $this->load->library('session');
       $this->functions->_valid_user();
    }    
    public function index()
    {   
        $this->is_seller();
        $this->sellerpayment();
//        if($this->session->userdata('user_type')=="2")
//        {
//            //buyer only
//            $this->buyerpayment();
//        }
//        else
//        {
//            //for seller only
//            $this->sellerpayment();
//        }         
    }
    public function sellerpayment()
    {
        $user_id=$this->session->userdata('user_id');       
        $data=array('val'=>'*','table'=>'db_theem','where'=>array('user_id'=>$user_id));
        $res= $this->common->getdata($data);
        //echo "<pre>";
        //print_r($res);
        if($res['res'])
        {          //print_r($res['rows'][0]->theam_id);
             $data2=array('val'=>'*','table'=>'theme_price','where'=>array('price_for'=>'seller'));//'theme_id'=>$res['rows'][0]->theam_id,
             $result= $this->common->getdata($data2);
             //echo "<pre>";
             //print_r($result); exit;
            /*    
            print_r($result);exit;
            $data1=array('table'=>'theme_price','val'=>'*','where'=>array("status"=>'1'));
            $data['themeprice']=$result;
            */
            $comment2=array('val'=>'*,tp.type','table'=>'subscription_expire as sue','where'=>array('sue.user_id'=>$user_id,'sue.status'=>'1'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'sue.int','orderas'=>'DESC');
            $multijoin2=array(
                array('table'=>'theme_price as tp','on'=>'sue.package_id=tp.id','join_type'=>'left'),
            );
            $data['subsdata']=$this->common->multijoin($comment2,$multijoin2); 
            //echo "<pre>";
            //print_r($data); exit;
             
            $paiduser=array('val'=>'paid','table'=>'user_Info','where'=>array('id'=>$user_id));
            $data['userpaid']=$this->common->getsinglerow($paiduser);
           //$this->common->getdata($paiduser);

            $data['themedataget']=$res;
            $data['userprice']=$result;
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('payment/selectThemeForPayment',$data);
            $this->load->view('include/footer');
        }
        else
        {
            $this->session->set_flashdata("warning","Please select any theme");
            redirect("profile","refresh");
        }
    }
    public function buyerpayment()
    {
        $user_id=$this->session->userdata('user_id');        
        $data1=array('val'=>'*','table'=>'theme_price','where'=>array('price_for'=>'buyer'));        
        $res= $this->common->getdata($data1);
        if($res['res'])
        {    
            
            /*    
            print_r($res);exit;
            $data1=array('table'=>'theme_price','val'=>'*','where'=>array("status"=>'1'));
            $data['themeprice']=$this->common->getdata($data1);
            */

		$paiduser=array('val'=>'paid','table'=>'user_Info','where'=>array('id'=>$user_id));
            $data['userpaid']= $this->common->getdata($paiduser);

            $data['userprice']=$res;
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('payment/userForPayment',$data);
            $this->load->view('include/footer');
        }
        else
        {
            $this->session->set_flashdata("warning","Some problem in your profile. Please contact to admin.");
            redirect("profile","refresh");
        }
    }
	
	
	public function get_code_details()
	{
		$code=$this->input->post('code');
		$user_id=$this->session->userdata('user_id');  
		$today=date('Y-m-d');
         $data1="SELECT * FROM promotion WHERE binary(`code`) = '$code' AND `start_date` <= '$today' AND `end_date` >= '$today' AND `status` = '1'";
        $result=$this->common->dbQuery($data1);
        //$data1=array('val'=>'*','table'=>'promotion','where'=>array('code'=>$code,'start_date<='=>$today,'end_date>='=>$today,'status'=>'1'));
        //$result= $this->common->getdata($data1);
		
		//echo $this->db->last_query();exit;
		//print_r($result);exit;
		if($result['res'])
		{
			$discount=$result['rows'][0]->discount;
			$pid=$result['rows'][0]->id;
	    	     $qr=array('val'=>'*','table'=>'promo_users','where'=>array('promo_id'=>$pid));
		     $ures=$this->common->getdata($qr);
		     if($ures['res'])
                      {
			$qr=array('val'=>'*','table'=>'promo_users','where'=>array('promo_id'=>$pid,'user_id'=>$user_id));
			$ures=$this->common->getdata($qr);
			if($ures['res'])
			{
				echo json_encode(array('status'=>true,'result'=>$discount));
				
			}
			else{
				echo json_encode(array('status'=>false,'result'=>'Invalid promo code'));
			}
                      }
		else{
				echo json_encode(array('status'=>true,'result'=>$discount));
	            }
		}
		else
		{
			echo json_encode(array('status'=>false,'result'=>'Invalid promo code'));
		}
		
		
	}
	
	public function set_session()
	{
		$sname=$this->input->post('name');
		$svalue=$this->input->post('value');
		
		$this->session->set_userdata($sname,$svalue);
		echo json_encode(array('status'=>true,'result'=>'success'));
		
	}
        
        public function subs_amount(){
         $id=$this->input->post('id');
         $this->session->set_userdata('package_id',$id);
         $data2=array('val'=>'*','table'=>'theme_price','where'=>array('price_for'=>'seller','id'=>$id));
         $result= $this->common->get_where($data2);
         //print_r($result); exit;
         if($result['res']){
            
            echo json_encode(array('res'=>true,'subsdata'=>$result));
            
        }else{
            echo json_encode(array('res'=>false));
        }
        }
	
	
        function freepromo(){
            //print_r($_POST); exit;
            $user_id=$this->session->userdata('user_id'); 
            $date=date('Y-m-d');
            $data1=array('table'=>'user_Info','val'=>array('paid'=>'1'),'where'=>array('id'=>$user_id));
            $result=$this->common->update_data($data1);
           
            
           $pack_id=$this->session->userdata('package_id');
           $package=array('val'=>'*','table'=>'theme_price','where'=>array('price_for'=>'seller','id'=>$pack_id));
           $pack_res= $this->common->getdata($package);
           //echo "<pre>";
           //print_r($pack_res);exit;
           //$pack_type=$pack_res['rows'][0]->type;
           $pack_period=$pack_res['rows'][0]->noOfDays;
           $expire=date('Y-m-d', strtotime('+'.$pack_period.' day', strtotime($date)));
           $sub_data=array('table'=>'subscription_expire','val'=>array('user_id'=>$this->session->userdata('user_id'),'package_id'=>$pack_id,'start_date'=>$date,'end_date'=>$expire));
           $result2=$this->common->add_data($sub_data);
           
            if($result && $result2)
           {
            $this->session->set_userdata('user_paid','1');
            $this->session->set_flashdata("sucess","Successfully paid.");
            //$this->redirectheader(BASE_URL."profile/");
            redirect(BASE_URL."profile/","refresh"); 
           }
           else{
           $this->session->set_flashdata("warning","Sorry payment failure");
           //$this->redirectheader(BASE_URL."profile/");
           redirect(BASE_URL."profile/","refresh"); 
           }
        }
        
}
?>
