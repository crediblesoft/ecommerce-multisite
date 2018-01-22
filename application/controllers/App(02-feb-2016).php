<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class App extends MY_Controller
{
     function __construct()
    {
        parent::__construct();
		$this->load->library('Authorize_net');
    }
    
	function test()
	{
		 header('Access-Control-Allow-Origin: *');
		 echo json_encode(array('status'=>true,'result'=>'success'));
	}
	
    function login()
    {   
            header('Access-Control-Allow-Origin: *');
			$email=$this->input->post('email');
            $password=$this->input->post('password');
            $query="SELECT * from user_Info where email_id='".$email."' AND password='".md5($password)."' AND status='1'";
            $result=$this->db->query($query);
            //echo $this->db->last_query();exit;
            if($result -> num_rows() > 0)
            {
                $log=array('res'=>true,'rows'=>$result->row_object());
            }  else {
                $log=array('res'=>FALSE);
            }            
            if($log['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$log['rows']));
            }
            else{
				header('Access-Control-Allow-Origin: *');
                echo json_encode(array('status'=>FALSE));
            }
           
          
        
    }
    
    function register()
    {  
			header('Access-Control-Allow-Origin: *');
                $fname=ucfirst($this->input->post("fname"));
                $lname=ucfirst($this->input->post("lname"));
                $email=$this->input->post("email");
                $username=$this->input->post("username");
                $password=md5($this->input->post("password"));
                $verify=rand(1,10000);
                $typeofuser=$this->input->post("user_type");
 			
		   
		   $array = array('f_name' => $fname, 'l_name' => $lname,'email_id'=>$email,'username'=>$username,'password'=>$password,'verify'=>$verify,'type_Of_User'=>$typeofuser,'status' =>'1');

			$this->db->set($array);
			$result=$this->db->insert('user_Info'); 
		   
          // echo $this->db->last_query();exit;
		   if($result)
            {
			  echo json_encode(array('status'=>true,'result'=>'Registration Successfull'));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
       
    }
    
    function profile()
    {
       header('Access-Control-Allow-Origin: *');
	   $uid=$this->input->post('uid');
	   $query="SELECT * from `user_Info` where id='".$uid."'";
       $result=$this->common->dbQuery($query);
		
		$usertype=$result['rows'][0]->type_Of_User;
		//echo $usertype;
		if($usertype=='1')
		{
			
			$qr="select * from `user_Info` user join `user_store_info` store ON user.id=store.user_id where store.user_id='".$uid."' ";
			
			//echo $qr;exit;
			$seller_result=$this->common->dbQuery($qr);
			
			$comment1=array('val'=>'s.social_id,s.link,s.id,s1.title,s1.url,s1.image','table'=>'social_link_user as s','where'=>array('s.user_id'=>$uid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'social_link as s1','on'=>'s.social_id=s1.id','join_type'=>''),
        );
        $social=$this->common->multijoin($comment1,$multijoin1);
		
		
		$qr2="select business_id from `user_business_type` where user_id='".$uid."' ";
		$buss=$this->common->dbQuery($qr2);
			
		if($seller_result['res']){
			   
				echo json_encode(array('status'=>true,'result'=>$seller_result['rows'],'bussiness'=>$buss['rows']));
			}
			else{
                echo json_encode(array('status'=>FALSE));
            }
			
		}
		else{
		         
            if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
		}
        
    } 
    
    function update_profile()
    {
        
            header('Access-Control-Allow-Origin: *');
				$uid=$this->input->post("uid");
                $fname=ucfirst($this->input->post("fname"));
                $lname=ucfirst($this->input->post("lname"));
                $mobile=$this->input->post("mobile");
                $address1=$this->input->post("address");
                
                $user_data=array('f_name'=>$fname,'l_name'=>$lname,'mobile_no'=>$mobile,'address1'=>$address1);
                
                $this->db->where('id', $uid);
				
                $success=$this->db->update('user_Info', $user_data); 
                //echo $this->db->last_query();
            if($success){
				
                echo json_encode(array('status'=>TRUE,'message'=>'Your profile successfully updated.'));
			}
            else  {
				
                echo  json_encode(array('status'=>TRUE,'message'=>'Something is wrong.'));
            }
        
    }
	
	function update_seller_profile()
    {
        
            header('Access-Control-Allow-Origin: *');
				$uid=$this->input->post("uid");
                $fname=ucfirst($this->input->post("fname"));
                $lname=ucfirst($this->input->post("lname"));
                $mobile=$this->input->post("mobile");
                $address1=$this->input->post("address");
				
				//Store Info
				$bname=$this->input->post("bname");
                $cp_name=ucfirst($this->input->post("cp_name"));
                $store_phone=ucfirst($this->input->post("store_phone"));
                $store_address=$this->input->post("store_address");
                $zip=$this->input->post("zip");
				$income=$this->input->post("income");
                
                $user_data=array('f_name'=>$fname,'l_name'=>$lname,'mobile_no'=>$mobile,'address1'=>$address1); 
                $this->db->where('id', $uid);
                $success=$this->db->update('user_Info', $user_data); 
				
				$store_data=array('business_name'=>$bname,'contact_person_name'=>$cp_name,'phone'=>$store_phone,'address'=>$store_address,'zip'=>$zip,'income'=>$income); 
                $this->db->where('user_id', $uid);
                $success=$this->db->update('user_store_info', $store_data); 
				
                //echo $this->db->last_query();
            if($success){
				
                echo json_encode(array('status'=>TRUE,'message'=>'Your profile successfully updated.'));
			}
            else  {
				
                echo  json_encode(array('status'=>TRUE,'message'=>'Something is wrong.'));
            }
        
    }
   
     
    
    function change_password()
    {
        header('Access-Control-Allow-Origin: *');
		    $userid=$this->input->post('userid');
			//echo 'user : '.$userid;
            $ops=$this->input->post('ops');
            $nps=$this->input->post('nps');
            $cps=$this->input->post('cps');
                    $data= array('table' => 'user_Info','where' => array('id' =>$userid,'password' => md5($ops)));
                    $log = $this->common->getNofrows($data);
                    if($log == 1){
                        $data=array('val'=>array( 'password'=>md5($nps) ),'table'=>'user_Info','where' => array('id'=>$userid));
                        $log= $this->common->update_data($data); 

                        if($log){
                               
                                echo json_encode(array('status'=>true,'result'=>'Sucessfully change password.'));

                        }

                    }else{
                             echo json_encode(array('status'=>true,'result'=>'Old password not correct.'));
                    }
    }
    
     function forgotpassword(){
           header('Access-Control-Allow-Origin: *');
                $email=$this->input->post("email");
                $data=array("table"=>"user_Info","where"=>array("email_id"=>$email),"val"=>array("id","username"));
                $record=$this->common->getsinglerow($data);
                //print_R($record);exit;
                if($record['res']){
                    // Mail Here..
                    $link=BASE_URL."auth/resetpassword/".$record['rows']->id;

			$message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                                <td style="padding-left:10px;"><h3>Forgot password link </h3><br/>
                                Hi '.$record['rows']->username.', <br/>
                                    &nbsp;&nbsp;&nbsp;<a href='.$link.' >Click Here</a> for change your password.
					
                            </td>
                            </tr>
                            </table>';
                    
                     $email1=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Forgot password','message'=>$message);
                     $sendmail=$this->functions->_email($email1);


                   // $mail=true;
                    if($sendmail){
      		            echo json_encode(array('status'=>true,'result'=>'Please Check your mail to reset your password.'));
                     }
				}
				else{
					echo json_encode(array('status'=>true,'result'=>'email does not exist.'));
				}
            
        }
    
    
	
	function contact()
	{
		
		
		        $fname=ucfirst($this->input->post("fname"));
                $lname=ucfirst($this->input->post("lname"));
                $toemail=$this->input->post("email");
                $mobile=$this->input->post("mobile");
                $address=$this->input->post("address");
				
			$message='<h3>Hello, '.$fname.' '.$lname.'</h3><br><p>Thanks for contacting us.we will back to you soon.<p><br><br>Thanks<br>Harvest Team';	
		
		$email=array(
			'from'=>'test@ucodice.com',
            'to'=>$toemail,
            'subject'=>'Thanks From Harvest',
            'message'=>$message
        );
		
		$sendmail=$this->functions->_email($email);
        if($sendmail)
		{
			header('Access-Control-Allow-Origin: *');
			echo json_encode(array('status'=>true,'result'=>'success'));
		}
	}
	
	
	function recipes()
	{
		header('Access-Control-Allow-Origin: *');
		$query="SELECT * from recipe where recipe_stetus='1' order by id DESC";
        $result=$this->common->dbQuery($query);
		         
            if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
	}
	
	
	function recipe_view()
	{
		
		$recp_id=$this->input->post('id');
		$query="SELECT * from recipe where id='".$recp_id."'";
        $result=$this->common->dbQuery($query);
		         
            if($result['res'])
            {
			  header('Access-Control-Allow-Origin: *');
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				header('Access-Control-Allow-Origin: *');
                echo json_encode(array('status'=>FALSE));
            }
	}
	
	function products()
	{
		header('Access-Control-Allow-Origin: *');
		$catg=$this->input->post('catid');
		$current_date=date("Y-m-d");
		$query="SELECT p.*,c.category as catname FROM `product` p join category c WHERE p.category='".$catg."' and p.status='1'  and p.category=c.id  order by p.id DESC";
		
		//echo $query;exit;
        $result=$this->common->dbQuery($query);
		         
            if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE,'result'=>'no records found.'));
            }
	}
	
	
	function product_view()
	{
		header('Access-Control-Allow-Origin: *');
		$prod_id=$this->input->post('id');
		$query="SELECT * from product where id='".$prod_id."'";
        $result=$this->common->dbQuery($query);
		         
            if($result['res'])
            {
			  
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
	}
	
	function seller_orders(){
		header('Access-Control-Allow-Origin: *');
		$userid=$this->input->post('uid');
		$comment1=array('val'=>'o.id,o.status,o.price,o.quantity,o.date,p.id as prodId,p.prod_name,p.prod_img as prod_img,u.f_name,u.l_name,u.id as buyerId','table'=>'order_detail_form as o','where'=>array('p.user_id'=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as u','on'=>'o.buyerId=u.id','join_type'=>''),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>''),
        );

        $result=$this->common->multijoin($comment1,$multijoin1);
		if($result['res'])
            {
			  
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
                echo json_encode(array('status'=>FALSE));
            }
		
	}
	
	function change_order_status(){
		header('Access-Control-Allow-Origin: *');
        $orderid=$this->input->post("oid");
        $status=$this->input->post("status");
		
		$query="SELECT * from order_detail_form where id='".$orderid."'";
        $result=$this->common->dbQuery($query);
		//print_r($result);exit;
		$current_status=$result['rows'][0]->status;
		
		if($current_status==4){ echo json_encode(array('status'=>true,'message'=>"This order delivered so you can not change status")); }
		else if($current_status==5){ echo json_encode(array('status'=>true,'message'=>"This order Rejected so you can not change status")); }
		else{
		
        $data=array('table'=>'order_detail_form','where'=>array('id'=>$orderid),'val'=>array('status'=>$status));                
        $log=$this->common->update_data($data);
        if($log){
          echo json_encode(array('status'=>true,'message'=>"Status changed Successfully."));
        }else{
            echo json_encode(array('status'=>false,'message'=>"Nothing to be changed."));
        }
		
		}
    }
	
	function seller_products(){
		header('Access-Control-Allow-Origin: *');
		
		$userid=$this->input->post('uid');
		$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.date,p.status,p.prod_img,p.no_of_Prod,cat.category','table'=>'product as p','where'=>array("p.bid_status"=>'0',"p.user_id"=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
        );

        $result=$this->common->multijoin($comment1,$multijoin1);
		if($result['res'])
            {
			  
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
                echo json_encode(array('status'=>FALSE));
            }
	}
	
	function seller_bidproducts(){
		header('Access-Control-Allow-Origin: *');
		$userid=$this->input->post('uid');
		$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.date,p.status,p.prod_img,p.no_of_Prod,auc.bid_start_date,auc.bid_end_date,cat.category,count(btc.id) as bidcount','table'=>'product as p','where'=>array("p.bid_status"=>'1',"p.user_id"=>$userid,"auc.status"=>'1'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'bid_tbl_cart as btc','on'=>'p.id=btc.product_id','join_type'=>'left'),
            array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id','join_type'=>'left'),
        );
		
		$result=$this->common->multijoin($comment1,$multijoin1);
		if($result['res'])
            {
			  
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
                echo json_encode(array('status'=>FALSE));
            }
		
	}
	
	
	function change_product_status(){
		header('Access-Control-Allow-Origin: *');
        $prod_id=$this->input->post("pid");
        $status=$this->input->post("status");
		
        $data=array('table'=>'product','where'=>array('id'=>$prod_id),'val'=>array('status'=>$status));                
        $log=$this->common->update_data($data);
        if($log){
          echo json_encode(array('status'=>true,'message'=>"Status changed Successfully."));
        }else{
            echo json_encode(array('status'=>false,'message'=>"Nothing to be changed."));
        }
		
		
    }
	
	function product_get_winner()
	{
		header('Access-Control-Allow-Origin: *');
		
		$productid=$this->input->post("pid");
        $auctionid=$this->get_auction_id($productid);
		
        $sql="select bid.price,u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1 from bid_tbl_cart as bid left join user_Info as u on bid.user_id=u.id where bid.auction='".$auctionid."' AND bid.price=(SELECT MAX(price) FROM bid_tbl_cart where auction='".$auctionid."')";
        $query=$this->db->query($sql);
		
		//echo $this->db->last_query();exit;
        $result=$query->result();
        if($result){
            echo json_encode(array('status'=>true,'result'=>$result));
        }else{
            echo json_encode(array('status'=>false,'result'=>''));
        }
		
		
	}
	
	
	 function updateprofilepic(){
        header('Access-Control-Allow-Origin: *');
		
		$userid=$this->input->post("userid");
        $userfile='file';
		//echo $userid;
		//print_r($userfile);
		//print_r($_POST);
		//exit;
        $image_path='assets/image/user/';
        $allowed='jpg|png|jpeg';
        $max_size='5024';

        $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"120","width"=>"120","ratio"=>true));
        //print_r($fileupload);exit;
        
        if($fileupload['status']){
            $userdata=array("table"=>"user_Info","where"=>array("id"=>$userid),"val"=> array("profile_Pic"));
            $user=$this->common->getsinglerow($userdata);
            if($user['rows']->profile_Pic!="nophoto.png"){
                $path="assets/image/user/".$user['rows']->profile_Pic;
                if(file_exists($path)){
                unlink($path);}
                $path="assets/image/user/thumb/".$user['rows']->profile_Pic;
                if(file_exists($path)){
                unlink($path);}
            }
        $data=array('table'=>'user_Info','where'=>array('id'=>$userid),'val'=>array('profile_Pic'=>$fileupload['filename']));                
        $log=$this->common->update_data($data);
          echo json_encode(array('status'=>true,'message'=>"Profile Pic changed Successfully."));
        }else{
            echo json_encode(array('status'=>false,'message'=>"Error Occured."));
        }
    }
	
	function latest_product()
	{
		header('Access-Control-Allow-Origin: *');
		
		$query="SELECT id,prod_name,prod_price,prod_img from product where status='1' order by date DESC limit 4";
        $result=$this->common->dbQuery($query);
		         
            if($result['res'])
            {
			  
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
	}
	
	function similar_product()
	{
		header('Access-Control-Allow-Origin: *');
		$catid=$this->input->post('category');
		$prod_id=$this->input->post('product_id');
		$query="SELECT id,prod_name,prod_price,prod_img from product where category='".$catid."' and status='1' and id!='".$prod_id."' order by rand() limit 4";
        $result=$this->common->dbQuery($query);
		         
            if($result['res'])
            {
			  
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
	}
	
	
	
	function _currentavailproduct($prodId,$qty=1){
		 header('Access-Control-Allow-Origin: *');
        if (count($this->cart->contents())>0){
                    foreach ($this->cart->contents() as $item){
                        if ($item['id']==$prodId){
                            $qty=$qty+$item['qty'];
                            break;
                        }
                    }   

        }
        
        $get_product=$this->get_product_details($prodId);
        $avai_pro=$get_product['rows'][0]->no_of_Prod;
        //print_r($get_product);
        if($get_product['rows'][0]->no_of_Prod < $qty){ 
            echo 'not ';
            
        }
    }
	
	
    function addtocart(){
        header('Access-Control-Allow-Origin: *');
		$user_id=$this->input->post('uid');
		$prodId=$this->input->post('pid');
		$qty=$this->input->post('qty');
		if($qty==''){$qty=1;}
		
		
		//for available qty of products
		$get_product=$this->get_product_details($prodId);
        $avai_pro=$get_product['rows'][0]->no_of_Prod;
		if($avai_pro < $qty){ 
			$msgg='currently only '.$avai_pro.' qty are available.';
			 echo json_encode(array('status'=>'qtyexceed','msg'=>$msgg));
			 exit;
		}
		
		
		//for available qty of products
		
		
		
		//for exist product
		$ajqr="SELECT count(*) as prod from temp_cart where user_id='".$user_id."' and prod_id='".$prodId."'";
        $ex_record=$this->common->dbQuery($ajqr);
		
		//print_r($ex_record);
		if($ex_record['rows'][0]->prod >0)
		{
			$update_qr="update temp_cart SET qty=`qty`+$qty where user_id='".$user_id."' and prod_id='".$prodId."' ";
			$upp=$this->db->query($update_qr);
			if($upp){
			   echo json_encode(array('status'=>true,'result'=>'success'));
			}
			
			exit;
		}
		
		
		
		
		//for exist product
		
		
        $this->_currentavailproduct($prodId,$qty);
        $comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.prod_img,cat.category,cat.id as catid','table'=>'product as p','where'=>array("p.id"=>$prodId),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
        );
        $resp=$this->common->multijoin($comment1,$multijoin1);
        //print_r($resp);exit;
        $product=$resp['rows'][0];
        
		$prodid=$product->prod_id;
		$qnty=$qty;
		$price=$product->prod_price;
		$name=$product->prod_name;
		$cat=$product->category;
		$image=$product->prod_img;
		$userid=$user_id;
     
		$sql="insert into temp_cart(`prod_id`,`qty`,`price`,`prod_name`,`category`,`prod_image`,`user_id`) values('$prodid','$qnty','$price','$name','$cat','$image','$userid')";
	 
		$query=$this->db->query($sql);
		if($query){
           echo json_encode(array('status'=>true,'result'=>'success'));
		}
		else{
			echo json_encode(array('status'=>false,'result'=>'something went wrong'));
		}
       
    }
	
	
	function update_cart()
	{
		header('Access-Control-Allow-Origin: *');
		$user_id=$this->input->post('uid');
		$prodId=$this->input->post('pid');
		$qty=$this->input->post('qty');
		if($qty==''){$qty=1;}
		
		
		//for available qty of products
		$get_product=$this->get_product_details($prodId);
        $avai_pro=$get_product['rows'][0]->no_of_Prod;
		if($avai_pro < $qty){ 
			$msgg='currently only '.$avai_pro.' qty are available.';
			 echo json_encode(array('status'=>'qtyexceed','msg'=>$msgg));
			 
		}
		else{
			$update_qr="update temp_cart SET qty='$qty' where user_id='".$user_id."' and prod_id='".$prodId."' ";
			$upp=$this->db->query($update_qr);
			if($upp){
			   echo json_encode(array('status'=>true,'result'=>'success'));
			}
			
			exit;
			
		}
		
		
	}
	
    function viewcart(){
		 header('Access-Control-Allow-Origin: *');
		 $user_id=$this->input->post('uid');
		 $query="SELECT * from temp_cart where user_id='".$user_id."' order by added_date DESC";
        $result=$this->common->dbQuery($query);    
            if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{	
                echo json_encode(array('status'=>FALSE));
            }
        
    }
	
	function item_in_cart()
	{
		header('Access-Control-Allow-Origin: *');
		$user_id=$this->input->post('uid');
		 $query="SELECT count(*) as total from temp_cart where user_id='".$user_id."'";
         $result=$this->common->dbQuery($query);  
		 //print_r($result);exit;
		 if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{	
                echo json_encode(array('status'=>FALSE));
            }
		
	}
	
	function remove_item()
	{
		header('Access-Control-Allow-Origin: *');
		$user_id=$this->input->post('uid');
		$prodId=$this->input->post('pid');
		
		$delete_qr="delete from temp_cart where user_id='".$user_id."' and prod_id='".$prodId."' ";
			$upp=$this->db->query($delete_qr);
			if($upp){
			   echo json_encode(array('status'=>true,'result'=>'success'));
			}
		
		
		
	}
	
	//For Credit Card Payment
	function paymentAuthorise()
	{  
	        header('Access-Control-Allow-Origin: *');
            $expiry=$this->input->post('exp_date');
            $auth_net=array('x_card_num'=>$this->input->post('card_number'),
            //'card_type'=>$this->input->post('card_type'),
            'x_card_code'=>$this->input->post('sec_code'),
            'x_exp_date'=>$expiry,
            'x_description'=> 'A test transaction',
            'x_first_name'=>$this->input->post('uname'),
            'x_last_name'=>'',  
            'x_email'=>$this->input->post('email'),
            'x_amount'=>$this->input->post('amount'),
            'x_address'=>$this->input->post('street'),
            'x_city'=>$this->input->post('city'),
            'x_state'=>$this->input->post('state'),
            'x_zip'=>$this->input->post('zip'),
            'x_country'=> 'US',
            'x_phone'=> '',
            'x_customer_ip'=> $this->input->ip_address());
						$paymentdata['uid']=$this->input->post('uid');
                        $paymentdata['name']=$this->input->post('uname');
                        $paymentdata['email']=$this->input->post('email');
                        $paymentdata['street']=$this->input->post('street');
                        $paymentdata['city']=$this->input->post('city');
                        $paymentdata['state']=$this->input->post('state');
                        $paymentdata['zipCode']=$this->input->post('zip');
                        $paymentdata['Payment_type']='Card';
                        $paymentdata['payment_with']='Authorise.net';
		$this->authorize_net->setData($auth_net);
		
                
		if( $this->authorize_net->authorizeAndCapture() )
		{   //echo "aa";exit;
	     
                        $paymentdata['amount']=$this->input->post('amount');
                        $paymentdata['tokan']=$this->authorize_net->getTransactionId();
                        $paymentdata['paystatus']='success';
						
						$paym=$this->card_payment_insert_product($paymentdata);
						if($paym){
						echo json_encode(array('status'=>true,'result'=>$paymentdata));
						}
                        
                        
                         
		}
		else
		{ 
                       
		}
            
	}
	
	
	//For Credit Card payment
	
	
	function card_payment_insert_product($data)
    { 
        $date=date('Y-m-d');
        $data_transaction=array('table'=>'transaction','val'=>array(
           'trans_id'=>$data['tokan'],
           'order_id'=>$data['uid'],
           'price'=>$data['amount'],
           'date'=>$date,
           'payment_for'=>"product",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
           'status'=>'success'));                    

		   $query="SELECT * from temp_cart where user_id='".$data['uid']."'";
           $result_aj=$this->common->dbQuery($query);
		  
           foreach ($result_aj['rows'] as $items)
            {
                $data1=array('table'=>'order_detail_form','val'=>array(                       
                    'status'=>'1',
                    'buyerId'=>$data['uid'],
                    'product_id'=>$items->prod_id,
                    'price'=>$items->price,//$items['subtotal'],
                    'quantity'=>$items->qty,
                    'trans_id'=>$data['tokan'],
                    'date'=>$date));
					//print_r($data1);exit;
                $result2=$this->common->add_data($data1);
                //echo "aa";exit;
				//echo $this->db->last_query();
				//echo $result2;exit;
                $get_product=$this->get_product_details($items->prod_id);
                $quantity=($get_product['rows'][0]->no_of_Prod-$items->qty);
                $update_quantity_data=array('table'=>'product','val'=>array('no_of_Prod'=>$quantity),'where'=>array('id'=>$items->prod_id));
                $update_qty=$this->common->update_data($update_quantity_data);                 
            }
		   
            
            
        $result=$this->common->add_data($data_transaction);

       if($result && $result2)
       {
		  $qr="Delete from temp_cart where user_id='".$data['uid']."'";
		  $res=$this->db->query($qr);
          return true;
          
       }
       else{
       
       }
       
    }
	
	
	
	
	
    
}


