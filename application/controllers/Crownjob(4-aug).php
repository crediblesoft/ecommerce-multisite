<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crownjob extends MY_Controller {
    
    function __construct()
    {
        parent::__construct();
        
    }
    
    public function index(){
        $this->_sendmsgafterbidnotpurchased();
    }
    
    private function _sendmsgafterbidnotpurchased(){
        $currentdate=date('Y-m-d');
        $comment1=array('val'=>'u.f_name,u.l_name,u.id as sellerid,auc.id as auctionid,p.prod_name,p.id as prodid','table'=>'product_auction as auc','where'=>array("auc.status"=>"1","auc.bid_purchase_date < "=> $currentdate),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'product as p','on'=>'auc.prod_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'u.id=p.user_id','join_type'=>'left'),
        );
        $resp=$this->common->multijoin($comment1,$multijoin1);
//        echo "<pre>";
//        print_r($resp);exit;
        if($resp['res']){
            foreach($resp['rows'] as $auction){ if($auction->sellerid!=''){
                $transdata=array("table"=>"transaction","where"=>array("order_id"=>$auction->auctionid,"payment_for"=>'bidproduct'),"val"=> array("trans_id"));
                $transaction=$this->common->getsinglerow($transdata);
                
                $msgdata=array("table"=>"seller_getmsg_for_bidnotpurchase","where"=>array("auctionid"=>$auction->auctionid),"val"=> array("id"));
                $getmessage=$this->common->getsinglerow($msgdata);
               //print_r($transaction);
               //print_r($getmessage['rows']);
                if(!$transaction['res'] && !$getmessage['res']){
                    //echo "aa".$auction->sellerid;
                    //send mail to $auction->sellerid
                    $message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                                <td style="padding-left:10px;"><h3>Bid on product</h3><br/>
                                Hello '.$auction->f_name.' '.$auction->l_name.'<br/>
                                    Your '.$auction->prod_name.' bid on product has not been purchased by buyer so <br/>
                                    <a href="'.BASE_URL.'product/details/'.$auction->prodid.'" target="_blank">click here</a> for Re-bidding this product and you can add penalty point for that buyer also.<br/>
                            </td>
                            </tr>
                            </table><br/>';
                    $sendmessage=$this->_sendmail($auction->sellerid,$message);
                    if($sendmessage){
                        $msgdata1=array("table"=>"seller_getmsg_for_bidnotpurchase","val"=> array("auctionid"=>$auction->auctionid));
                        $getmessage1=$this->common->add_data($msgdata1);
                    }
                }
        } }
        }
        
        echo "done";
    }
    
    
    private function _sendmail($to,$message){
        $from='0';
        $subject="Bid on product";

        //$this->getuserid($to[0]);
        $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
        $inserted_id=$this->common->add_data_get_id($maildata);

        if($inserted_id){
             $mailtodata=array("table"=>'mail_to',"val"=>array("mail_from"=>$inserted_id,"mail_to"=>$to));
             $log = $this->common->add_data($mailtodata);
        }
        if($log){
            return TRUE;
        }else{
            return FALSE;
        }
            
    
    } 
    
    
    public function checkuseractivation(){
        //$query="SELECT id FROM user_Id WHERE last_active >= NOW() - INTERVAL 1 MINUTE";
        $query="SELECT `id` FROM user_Info WHERE is_login='1' AND `active_time` < NOW() - INTERVAL 30 SECOND";
        $result=$this->db->query($query); $users=array(); $rows=$result->result();
        foreach($rows as $user){ array_push($users, $user->id); }
        if(!empty($users)){ $this->db->where_in("id",$users); $this->db->update("user_Info", array("is_login"=>"0")); }
    }
    
    
    public function releasepayment(){
        $this->load->library('Braintree');
        $this->db->select('trans_id,id'); $this->db->where('status','0'); $this->db->where('pt','B');
        $getresult=$this->db->get('transaction_sellers')->result();
        echo '<pre>';
        print_R($getresult);
        foreach($getresult as $result){
            $status = $this->braintree->get_trans_status($result->trans_id);
            if($status=='held'){
               $resultrel=$this->braintree->releasepayment($result->trans_id);
               if($resultrel){
                   $this->db->where('id', $result->id); $this->db->update('transaction_sellers', array('status'=>'1'));
               }
            }
        }
    }
	
	public function subscription_expiry_mail()
	{
		$today=date('Y-m-d');
		$expire=date('Y-m-d', strtotime('+5 day', strtotime($today)));
		$query="SELECT `user_id` FROM subscription_expire WHERE end_date='$expire' and status='1'";
        $result=$this->db->query($query); 
		$rows=$result->result();
		//echo $this->db->last_query();
		//echo $rows[0]->user_id;
		
		foreach($rows as $user)
		{
			//echo $user->user_id;
			$uid=$user->user_id;
			$username=$this->getusername($uid);
			$message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                                <td style="padding-left:10px;"><h3>Subscription Renewal</h3><br/>
                                Hello '.$username.'<br/>
                                     Your user subscription is going to expire on <b>'.$expire.'</b>
                                    <br/>kindly renew your subscription to use the services.'.  
                            '</td>
                            </tr>
                            </table><br/>';
            $sendmessage=$this->_sendmailsubscription($uid,$message);
			
			$message_to_admin='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                                <td style="padding-left:10px;"><h3>Subscription Renewal</h3><br/>
                                Hello Admin,<br/>
                                     user subscription of '.$username.' is going to expire on <b>'.$expire.'</b>
                                     <br/>'.  
                            '</td>
                            </tr>
                            </table><br/>';
			
			
            $sendmessage_admin=$this->_sendmailsubscriptiontoadmin($message_to_admin);
			
			
		}
		
		
		
	}
	
	private function _sendmailsubscription($to,$message){
        $from='0';
        $subject="Subscription Renewal";

        //$this->getuserid($to[0]);
        $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
        $inserted_id=$this->common->add_data_get_id($maildata);

        if($inserted_id){
             $mailtodata=array("table"=>'mail_to',"val"=>array("mail_from"=>$inserted_id,"mail_to"=>$to));
             $log = $this->common->add_data($mailtodata);
        }
        if($log){
            return TRUE;
        }else{
            return FALSE;
        }
            
    
    }
	
	
	
	private function _sendmailsubscriptiontoadmin($message)
	{
        
        $email='test@ucodice.com';
        $email1=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Subscription expiry of user','message'=>$message);
        $sendmail=$this->functions->_email($email1);
        if($sendmail) {return true;}
		else{ return false;}
    
    }
	
	public function subscription_expire()
	{
		$today=date('Y-m-d');
		$query="SELECT `user_id` FROM subscription_expire WHERE end_date='$today' and status='1'";
        $result=$this->db->query($query); 
		$rows=$result->result();
		//echo $this->db->last_query();
		//echo $rows[0]->user_id;
		foreach($rows as $user)
		{
			//echo $user->user_id;
			$uid=$user->user_id;
			$query1="UPDATE subscription_expire SET status='0' WHERE user_id='$uid' ";
            $result1=$this->db->query($query1); 
			
			$query2="UPDATE user_Info SET paid='0' WHERE id='$uid' ";
            $result2=$this->db->query($query2); 
		    
			
		}
		
		
		
	}
	
	public function ads_subscription_expire()
	{
		$today=date('Y-m-d');
		$query="SELECT `user_id` FROM ads_subscription WHERE exp_date='$today' and paid_status='1'";
                $result=$this->db->query($query); 
		$rows=$result->result();
		//echo $this->db->last_query();
		//echo $rows[0]->user_id;
		foreach($rows as $user)
		{
			//echo $user->user_id;
			$uid=$user->user_id;
			$query1="UPDATE ads_subscription SET paid_status='0' WHERE user_id='$uid' ";
            $result1=$this->db->query($query1); 
			
//			$query2="UPDATE user_Info SET paid='0' WHERE id='$uid' ";
//            $result2=$this->db->query($query2); 
		    
			
		}
		
		
		
	}
    

}
