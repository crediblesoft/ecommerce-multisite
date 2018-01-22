<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class App extends MY_Controller
{
     function __construct()
    {
        parent::__construct();
		$this->load->library('Authorize_net');
		$this->load->library('Braintree');
		$this->load->model('editmodel');
		$this->load->library('image_lib');
		$this->load->helper('directory');
                $this->load->helper('file');
		header('Access-Control-Allow-Origin: *');
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
			
            $query="SELECT * FROM user_Info where '".$email."' IN (username,email_id) AND password='".md5($password)."'";
            //$query="SELECT * from user_Info where email_id='".$email."' AND password='".md5($password)."' AND status='1'";
            $result=$this->common->dbQuery($query);
			
            //echo $this->db->last_query();exit;
            if($result['res'])
            {
				if($result['rows'][0]->verified=='0')
				{
				  	echo json_encode(array('status'=>true,'result'=>$result['rows']));
				}
				else
				{
					if($result['rows'][0]->status=='1'){
						echo json_encode(array('status'=>true,'result'=>$result['rows']));
					}
					else{
						echo json_encode(array('status'=>false,'message'=>'block'));
					}
					
					
				}
           }  
			else {
                echo json_encode(array('status'=>false,'message'=>'invalid'));
            }            
            
     }
	
    
    function register()
    {  
			    header('Access-Control-Allow-Origin: *');
	
                $fname=ucfirst($this->input->post("fname"));
                $lname=ucfirst($this->input->post("lname"));
                $email=$this->input->post("email");
                $username=$this->input->post("username");
                $password=$this->input->post("password");
				$mobile=$this->input->post("mobile");
				$address=$this->input->post("address");
				$zip=$this->input->post("zip");
				$state=$this->input->post("state");
                $verify=rand(1,10000);
                $typeofuser=$this->input->post("user_type");
				
				if($typeofuser==2){
                    $store_info=1;
                    $paiduser=1;
                }else{
                    $store_info=0;
                    $paiduser=0;
                }
				
				$qr=array("table"=>"user_Info","where"=>array("email_id"=>$email));
                $email_count=$this->common->record_count_where($qr);
				
				$qr1=array("table"=>"user_Info","where"=>array("username"=>$username));
                $username_count=$this->common->record_count_where($qr1);
				
 			
			if($username_count>0)
			{
				echo json_encode(array('status'=>true,'result'=>'uname_exist'));
				exit;
			}
			if($email_count>0)
			{
				echo json_encode(array('status'=>true,'result'=>'mail_exist'));
				exit;
			}
		   
		if($email_count==0 && $username_count==0) {  
			$data=array('table'=>'user_Info','val'=>array('f_name'=>$fname,'l_name'=>$lname,'email_id'=>$email,'mobile_no'=>$mobile,'address1'=>$address,'zip'=>$zip,'state'=>$state,'username'=>$username,'password'=> md5($password),'pass2'=>$password,'verify'=>$verify,'type_Of_User'=>$typeofuser,'store_info'=>"$store_info",'paid'=>"$paiduser"));                
			$log=$this->common->add_data($data);	

			
			 
		   if($log){
                    
                    $message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                                <td style="padding-left:10px;"><h3>Verification Code</h3><br/><br/>
                                Thank you for signing up for HavrestLinks, your new personalized online produce <br/> <br/> marketplace.
                                Your verification code is: '.$verify.'. <br/><br/> If you have any questions or need support at anytime, 
                                please contact us at info@harvestlinks.com. <br/><br/> Thank you and welcome to the HarvestLinks family.
                            </td>
                            </tr>
                            </table>';
                    
                     $email1=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Your Verification Code','message'=>$message);
                     $sendmail=$this->functions->_email($email1);
                  
                    
                    if($sendmail){
                         echo json_encode(array('status'=>true,'result'=>'mail_sent'));
                    }else{
                        echo json_encode(array('status'=>FALSE,'result'=>'mail_not_sent'));
                    }
                }
			}
			
		   
       
    }
	function verify_mail()
	{
		 header('Access-Control-Allow-Origin: *');
		 $code=$this->input->post("code");
         $email=$this->input->post("email");
		 
		 $admin_status=$this->getadminsettings();
         $data=array('table'=>'user_Info','val'=>'id','where'=>array('email_id'=>$email,'verify'=>$code));
         $log=$this->common->get_verify($data);
		 
		 if($log['res']){ 
                    $updatedata=array('table'=>'user_Info','where'=>array('email_id'=>$email),'val'=>array('verified'=>'1','status'=>$admin_status->user_status));
                    $dataupdated=$this->common->update_data($updatedata);
                    if($dataupdated){    
                        $this->db->select("id,pass2,username,password,type_Of_User");
                        $userdata=$this->db->get_where("user_Info",array("email_id"=>$email))->row();
                        $password=$userdata->password;
                        //$login=$this->_login($email, $password);
                         
                            if($userdata->type_Of_User==1){
                                $this->add_defaultproduct($userdata->id);
								
                            }
                            
                            // mail for confirm username & password
                            
                            $message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                                <td style="padding-left:10px;"><h3>Welcome</h3><br/><br/>
                                Thank you for signing up for HavrestLinks, your new personalized online produce <br/><br/> marketplace.
                                Your username and password is: '.$userdata->username.' and '.$userdata->pass2.' <br/><br/> If you have any questions or need support at anytime, 
                                please contact us at info@harvestlinks.com. <br/><br/> Thank you and welcome to the HarvestLinks family.
                            </td>
                            </tr>
                            </table>';
                    
                            $email1=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Welcome','message'=>$message);
                            $sendmail=$this->functions->_email($email1);
                     
                            if($sendmail){
								echo json_encode(array('status'=>true,'result'=>'Registration Successful.'));
								}
                        
                    }
                }
				
				else{
                    echo json_encode(array('status'=>FALSE,'result'=>'Invalid Verification code.'));
                }
		 
		 
		
	}
	
	public function regeneratecode(){
		header('Access-Control-Allow-Origin: *');
            $email=$this->input->post('email');
            $verify=rand(1,10000);
            
            $updatedata=array('table'=>'user_Info','where'=>array('email_id'=>$email),'val'=>array('verify'=>$verify));
            $dataupdated=$this->common->update_data($updatedata);
          
            $message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                                <td style="padding-left:10px;"><h3>Verification Code</h3><br/><br/>
                                Thank you for signing up for HavrestLinks, your new personalized online produce <br/><br/> marketplace. ,
                                Your verification code is: '.$verify.'. <br/><br/> If you have any questions or need support at anytime, 
                                please contact us at info@harvestlinks.com. <br/><br/> Thank you and welcome to the HarvestLinks family.
                            </td>
                            </tr>
                            </table>';
            
                    
                     $email1=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Your Verification Code','message'=>$message);
                     $sendmail=$this->functions->_email($email1);
            
            if($sendmail){
                      echo json_encode(array('status'=>true,'result'=>'new verification code is sent to your mail.'));
                    }else{
                        echo json_encode(array('status'=>FALSE,'result'=>'mail not sent'));
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
			$qry="select store_info from `user_Info` where id='".$uid."'";
			$storeinfo=$this->common->dbQuery($qry);
			//print_r($storeinfo);exit;
			if($storeinfo['rows'][0]->store_info=='0')
			{
				echo json_encode(array('store'=>FALSE));
				exit;
			}
			
			$qr="select * from `user_Info` user  join `user_store_info` store ON user.id=store.user_id where store.user_id='".$uid."' ";
			
			//echo $qr;exit;
			$seller_result=$this->common->dbQuery($qr);
			//echo $this->db->last_query();exit;
			
			$comment1=array('val'=>'s.social_id,s.link,s.id,s1.title,s1.url,s1.image','table'=>'social_link_user as s','where'=>array('s.user_id'=>$uid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'social_link as s1','on'=>'s.social_id=s1.id','join_type'=>''),
        );
        $social=$this->common->multijoin($comment1,$multijoin1);
		if(!$social['res'])
		{
			$social['rows']=false;
		}
		
		$qr2="select business_id from `user_business_type` where user_id='".$uid."' ";
		$buss=$this->common->dbQuery($qr2);
		
		$qr3="select * from `theme_price` where price_for='seller' and status='1' ";
		$plan=$this->common->dbQuery($qr3);
		
		//print_r($seller_result); exit;
		if($seller_result['res'])
		{
			   
				echo json_encode(array('status'=>true,'result'=>$seller_result['rows'],'bussiness'=>$buss['rows'],'plan'=>$plan['rows'],'social'=>$social['rows']));
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
				$zip=$this->input->post("zip");
				$state=$this->input->post("state");
				$profile_pic=$this->input->post("prof_img");
				if($profile_pic!=''){
                $userdata=array("table"=>"user_Info","where"=>array("id"=>$uid),"val"=> array("profile_Pic"));
                $user=$this->common->getsinglerow($userdata);
				$flag=0;
                if($user['rows']->profile_Pic!=$profile_pic ){ 
				$flag++;
                $path="assets/image/user/".$user['rows']->profile_Pic;
                if(file_exists($path)){
                unlink($path);}
                $path="assets/image/user/thumb/".$user['rows']->profile_Pic;
                if(file_exists($path)){
                unlink($path);}
               }
				   if($flag==0 && $user['rows']->profile_Pic!="nophoto.png")
				   {
					$path="assets/image/user/".$user['rows']->profile_Pic;
					if(file_exists($path)){
					unlink($path);}
					$path="assets/image/user/thumb/".$user['rows']->profile_Pic;
					if(file_exists($path)){
					unlink($path);}
				   }
               }
                
                $user_data=array('f_name'=>$fname,'l_name'=>$lname,'mobile_no'=>$mobile,'address1'=>$address1,'zip'=>$zip,'state'=>$state,'profile_Pic'=>$profile_pic);
                
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
				$state=$this->input->post("state");
				
				//Store Info
				$btype=$this->input->post("business_type");
				$business_type=explode(',',$btype);
				$bname=$this->input->post("bname");
                $cp_name=ucfirst($this->input->post("cp_name"));
                $store_phone=ucfirst($this->input->post("store_phone"));
                $store_address=$this->input->post("store_address");
                $zip=$this->input->post("zip");
				$income=$this->input->post("income");
				$certification=$this->input->post("cert");
				
				$social=$this->input->post("socialmedia");
				$links=$this->input->post("links");
				
				$social_media=explode(',',$social);
                $link=explode(',',$links);
				
				$profile_pic=$this->input->post("prof_img");
				if($profile_pic!=''){
                $userdata=array("table"=>"user_Info","where"=>array("id"=>$uid),"val"=> array("profile_Pic"));
                $user=$this->common->getsinglerow($userdata);
				
				
				$flag=0;
                if($user['rows']->profile_Pic!=$profile_pic ){ 
				$flag++;
                $path="assets/image/user/".$user['rows']->profile_Pic;
                if(file_exists($path)){
                unlink($path);}
                $path="assets/image/user/thumb/".$user['rows']->profile_Pic;
                if(file_exists($path)){
                unlink($path);}
               }
				
					if($flag==0 && $user['rows']->profile_Pic!="nophoto.png"){
					$path="assets/image/user/".$user['rows']->profile_Pic;
					if(file_exists($path)){
					unlink($path);}
					$path="assets/image/user/thumb/".$user['rows']->profile_Pic;
					if(file_exists($path)){
					unlink($path);}
				   }
               }
                
                $user_data=array('f_name'=>$fname,'l_name'=>$lname,'mobile_no'=>$mobile,'address1'=>$address1,'state'=>$state,'profile_Pic'=>$profile_pic); 
                $this->db->where('id', $uid);
                $success=$this->db->update('user_Info', $user_data); 
				
				$store_data=array('business_name'=>$bname,'contact_person_name'=>$cp_name,'phone'=>$store_phone,'address'=>$store_address,'zip'=>$zip,'income'=>$income,'certification'=>$certification); 
                $this->db->where('user_id', $uid);
                $success=$this->db->update('user_store_info', $store_data); 
				
				$deletesocial=array('table'=>'social_link_user','where'=>array('user_id'=>$uid));
                $this->common->delete_data($deletesocial);
				
				for($i=0;$i<count($social_media);$i++)
				{
					$value[]=array('user_id'=>$uid,'social_id'=>$social_media[$i],'link'=>$link[$i]);
			    }
				$socialdata=array('table'=>'social_link_user','val'=>$value);
				$sociallog=$this->common->insert_multi_row($socialdata);
				
				
				$deleteuserbusinesstype=array('table'=>'user_business_type','where'=>array('user_id'=>$uid));
                $this->common->delete_data($deleteuserbusinesstype);
            
            foreach($business_type as $business){
                $bs_type[]=array('user_id'=>$uid,'business_id'=>$business);
            }
            
            $data2=array('table'=>'user_business_type','val'=>$bs_type);
            $log2 = $this->common->insert_multi_row($data2);
				
                //echo $this->db->last_query();
            if($success && $sociallog){
                echo json_encode(array('status'=>TRUE,'message'=>'Your profile successfully updated.'));
			}
            else  {
				
                echo  json_encode(array('status'=>TRUE,'message'=>'Something is wrong.'));
            }
        
    }
	
	function update_store()
	{
		header('Access-Control-Allow-Origin: *');
				$uid=$this->input->post("uid");
				$btype=$this->input->post("business_type");
				$business_type=explode(',',$btype);
				$bname=$this->input->post("bname");
                $cp_name=ucfirst($this->input->post("cp_name"));
                $store_phone=ucfirst($this->input->post("store_phone"));
                $store_address=$this->input->post("store_address");
                $zip=$this->input->post("zip");
				$income=$this->input->post("income");
				$cert=$this->input->post("cert");
				$account=$this->input->post("account");
				$routing=$this->input->post("routing");
				
				
			$sellerinfo=$this->getsellers(array('f_name','l_name','mobile_no','email_id','state'),array('id'=>$uid));
            $sellerinfo1=$sellerinfo['rows'][0];
            $state=$this->db->get_where('statelist',array('id'=>$sellerinfo1->state))->row();
            $sub_merchant_data=array('individual'=>array('firstName'=>$sellerinfo1->f_name,'lastName'=>$sellerinfo1->l_name,'email'=>$sellerinfo1->email_id,'phone'=>$sellerinfo1->mobile_no,'address'=>array('streetAddress'=>$store_address,'locality'=>$state->state,'region'=>$state->code,'postalCode'=>$zip)),'funding'=>array('descriptor'=>$bname,'email'=>'','mobilePhone'=>'','accountNumber'=>$account,'routingNumber'=>$routing));
            $sub_merchant_account=$this->braintree->create_sub_merchant($sub_merchant_data);
            //create sub-merchant account
            
            
            if(!$sub_merchant_account['status']){ 
			       header('Access-Control-Allow-Origin: *');
				   echo json_encode(array('status'=>false,'message'=>$sub_merchant_account['errorMessage']));
			       exit;
			}
                 $data=array('table'=>'user_store_info','val'=>array('user_id'=>$uid,'business_name'=>$bname,'contact_person_name'=>$cp_name,'phone'=>$store_phone,'address'=> $store_address,'zip'=>$zip,"income"=>$income,'certification'=>$cert,'acc_no'=>$account,'rout_no'=>$routing,'merchant_id'=>$sub_merchant_account['number']));                
                 $log=$this->common->add_data($data); 
				
				$deleteuserbusinesstype=array('table'=>'user_business_type','where'=>array('user_id'=>$uid));
                $this->common->delete_data($deleteuserbusinesstype);
            
				foreach($business_type as $business){
                $bs_type[]=array('user_id'=>$uid,'business_id'=>$business);
				}
            
				$data2=array('table'=>'user_business_type','val'=>$bs_type);
				$log2 = $this->common->insert_multi_row($data2);
				
				$log1=$this->editmodel->addNewUserData($uid,'1001');
				
				if($log && $log1 && $log2){
					$updatedata=array('table'=>'user_Info','where'=>array('id'=>$uid),'val'=>array('store_info'=>'1'));                
                   $updatelog=$this->common->update_data($updatedata);
				   header('Access-Control-Allow-Origin: *');
				   echo json_encode(array('status'=>TRUE,'message'=>'Your Store Info successfully updated.'));
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
				$date=date('Y-m-d');
		        $fname=ucfirst($this->input->post("fname"));
                $lname=ucfirst($this->input->post("lname"));
                $toemail=$this->input->post("email");
                $mobile=$this->input->post("mobile");
                $address=$this->input->post("address");
				$message1=$this->input->post("msg");
				
				$data=array('table'=>'contact_us','val'=>array('f_name'=>$fname,'l_name'=>$lname,'email'=>$toemail,'phone'=>$mobile,'address'=>$address,'message'=>$message1,'status'=>'1','add_date'=>$date));
                $result=$this->common->add_data($data);
				
			//$message='<h3>Hello, '.$fname.' '.$lname.'</h3><br><p>Thanks for contacting us.we will back to you soon.<p><br><br>Thanks<br>Harvest Team';	
		
		//$email=array(
			//'from'=>'test@ucodice.com',
           // 'to'=>$toemail,
           // 'subject'=>'Thanks From Harvest',
           // 'message'=>$message
        //);
		
		//$sendmail=$this->functions->_email($email);
        if($result)
		{
			header('Access-Control-Allow-Origin: *');
			echo json_encode(array('status'=>true,'result'=>'success'));
		}
	}
	
	
	function recipes()
	{
		header('Access-Control-Allow-Origin: *');
		$query="SELECT rec.*,reccat.category from recipe as rec LEFT JOIN recipe_category as reccat on rec.recipe_type=reccat.id where rec.recipe_stetus='1' order by rec.id DESC";
		//echo $query;exit;
		
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
		header('Access-Control-Allow-Origin: *');
		//echo $this->input->post('id');
		$recp_id=$this->input->post('id');
		$query="SELECT rec.*,reccat.category from recipe as rec LEFT JOIN recipe_category as reccat on rec.recipe_type=reccat.id  where rec.id='".$recp_id."'";
                $result=$this->common->dbQuery($query);  
            if($result['res'])
            {
			 // header('Access-Control-Allow-Origin: *');
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				//header('Access-Control-Allow-Origin: *');
                echo json_encode(array('status'=>FALSE));
            }
	}
	
	function products()
	{
		header('Access-Control-Allow-Origin: *');
		$type=$this->input->post('type');
		$catg=$this->input->post('catid');
		$zip=$this->input->post('zipcode');
		$cert=$this->input->post('cert');
		$query_text="";
		 if($zip!='')  $query_text.=" and usi.zip like '$zip%' ";
		 if($cert!='') $query_text.=" and usi.certification='$cert' ";
		
		
		
		//echo $cert;exit;
		$current_date=date("Y-m-d");
		if($type=="direct")
		{
		  $query="SELECT p.*,c.category as catname,usi.zip as zipcode FROM `product` p join category c left join user_store_info as usi on p.user_id=usi.user_id WHERE p.category='".$catg."' and p.no_of_Prod >'0' and p.status='1' and p.admin_status='1' $query_text  and p.category=c.id and p.bid_start_date='0000-00-00' and p.bid_end_date='0000-00-00'  order by p.id DESC";  
		}
		else if($type=="bid")
		{
			$query="SELECT p.*,c.category as catname,usi.zip as zipcode FROM `product` p join category c left join user_store_info as usi on p.user_id=usi.user_id WHERE p.category='".$catg."' and p.status='1' and p.admin_status='1' $query_text and p.category=c.id and p.bid_end_date >='".$current_date."' and p.bid_purchase_date >='".$current_date."' and p.bid_status='1'  order by p.id DESC";
		}
        
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
		$query="SELECT p.*,usi.business_name,ui.username from product p join user_Info ui left join user_store_info usi on p.user_id=ui.id where p.id='".$prod_id."' and usi.user_id=p.user_id";
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
		$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.date,p.status,p.admin_status,p.prod_img,p.no_of_Prod,cat.category','table'=>'product as p','where'=>array("p.bid_status"=>'0',"p.user_id"=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
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
		$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.date,p.status,p.admin_status,p.prod_img,p.no_of_Prod,auc.bid_start_date,auc.bid_end_date,cat.category,count(btc.id) as bidcount','table'=>'product as p','where'=>array("p.bid_status"=>'1',"p.user_id"=>$userid,"auc.status"=>'1'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
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
	
	
	function buyer_bidproducts(){
		header('Access-Control-Allow-Origin: *');
		$userid=$this->input->post('uid');
		$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.date,p.status,p.prod_img,p.no_of_Prod,auc.bid_start_date,auc.bid_end_date,cat.category,count(btc.id) as bidcount','table'=>'product as p','where'=>array("p.bid_status"=>'1',"btc.user_id"=>$userid,"auc.status"=>'1'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
       
		$multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'bid_tbl_cart as btc','on'=>'p.id=btc.product_id','join_type'=>'left'),
            array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id','join_type'=>'left'),
        );
		
		$result=$this->common->multijoin($comment1,$multijoin1);
		//print_r($result);exit;
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
		$productid=$this->input->post("pid");
        $auctionid=$this->get_auction_id($productid);
		
        $sql="select bid.price,u.id as userid,u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1 from bid_tbl_cart as bid left join user_Info as u on bid.user_id=u.id where bid.auction='".$auctionid."' AND bid.price=(SELECT MAX(price) FROM bid_tbl_cart where auction='".$auctionid."')";
        $query=$this->db->query($sql);
		 $result=$query->result();
		
		$qr1="select trans_id from transaction where order_id='".$auctionid."' and payment_for='bidproduct'";
		$trans=$this->common->dbQuery($qr1);
		//print_r($trans);exit;
		
		//echo $this->db->last_query();exit;
       
        if($result){
            echo json_encode(array('status'=>true,'result'=>$result,'trans'=>$trans));
        }else{
            echo json_encode(array('status'=>false,'result'=>''));
        }
		
		
	}
	
	
	 function updateprofilepic(){
		$image=$_FILES['file']['name'];
		copy($_FILES['file']['tmp_name'],'assets/image/user/'.$image);
		$img=getimagesize('assets/image/user/'.$image);
		
	  // print_r($img);exit;
	   
	   if(!empty($img))
		{	
				$imgtype= $img['mime'];
	
			    if($imgtype=="image/jpg" || $imgtype=="image/jpeg" )
				{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefromjpeg($uploadedfile);
				}
				else if($imgtype=="image/png")
				{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefrompng($uploadedfile);
				}
				else 
				{
				$src = imagecreatefromgif($uploadedfile);
				}
			
			$width=$img[0];
			$height=$img[1];
	
			$newwidth=120;
			$newheight=120;
			
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			$dest = 'assets/image/user/thumb/'.$image;
			imagejpeg($tmp,$dest,100);
			//copy($thumbimg,'assets/image/user/thumb/'.$image);
			echo $image; 
		}
		else
		{
			unlink('assets/image/user/'.$image);
			unlink('assets/image/user/thumb/'.$image);
			echo 'error';
		}	
    }
	
	function latest_product()
	{
		header('Access-Control-Allow-Origin: *');
		
		$query="SELECT id,prod_name,prod_price,prod_img from product where status='1' and bid_start_date='0000-00-00' and bid_end_date='0000-00-00' order by date DESC limit 4";
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
		$query="SELECT id,prod_name,prod_price,prod_img from product where category='".$catid."' and status='1' and admin_status='1' and no_of_Prod >'0' and bid_start_date='0000-00-00' and bid_end_date='0000-00-00' and id!='".$prod_id."' order by rand() limit 4";
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
			$msgg='currently only '.$avai_pro.' quantity are available.';
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
		$seller_id=$get_product['rows'][0]->user_id;
     
		$sql="insert into temp_cart(`prod_id`,`seller_id`,`qty`,`price`,`prod_name`,`category`,`prod_image`,`user_id`) values('$prodid','$seller_id','$qnty','$price','$name','$cat','$image','$userid')";
	 
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
	
    function viewcart_7oct(){
		 header('Access-Control-Allow-Origin: *');
		 $user_id=$this->input->post('uid');
		 $toship=$this->input->post('tozip');
		 //$query="SELECT * from temp_cart where user_id='".$user_id."' order by added_date DESC";
		 $query="SELECT cart.*,CONCAT_WS(' ',ui.f_name,ui.l_name) as seller from temp_cart as cart join user_Info as ui where cart.user_id='".$user_id."' and ui.id=cart.seller_id order by added_date DESC";
         $result=$this->common->dbQuery($query);

		//print_r($result);exit;
		 if($result['res'])
         {
		 
		 //For tax Calculations Start
		 $finaldata1=$this->tax_calcualtion($user_id,$toship);
		 //For Tax Calculation End
          
			  echo json_encode(array('status'=>true,'result'=>$result['rows'],'tax'=>$finaldata1));
            }
            else{	
                echo json_encode(array('status'=>FALSE));
            }
        
    }
function viewcart(){
		 header('Access-Control-Allow-Origin: *');
		 $user_id=$this->input->post('uid');
		 $toship=$this->input->post('tozip');
		 //$query="SELECT * from temp_cart where user_id='".$user_id."' order by added_date DESC";
		 $query="SELECT cart.*,CONCAT_WS(' ',ui.f_name,ui.l_name) as seller from temp_cart as cart join user_Info as ui where cart.user_id='".$user_id."' and ui.id=cart.seller_id order by added_date DESC";
         $result=$this->common->dbQuery($query);

		//print_r($result);exit;
		 if($result['res'])
         {
		 
		 //For tax Calculations Start
		 $finaldata1=$this->tax_calculation($user_id,$toship);
		 //For Tax Calculation End
          
			  echo json_encode(array('status'=>true,'result'=>$result['rows'],'tax'=>$finaldata1));
            }
            else{	
                echo json_encode(array('status'=>FALSE));
            }
        
    }
    public function tax_calculation($user_id,$new_zip){
        
        $query="SELECT cart.*,CONCAT_WS(' ',ui.f_name,ui.l_name) as seller from temp_cart as cart join user_Info as ui where cart.user_id='".$user_id."' and ui.id=cart.seller_id order by added_date DESC";
        $result=$this->common->dbQuery($query);
	//print_r($result); exit;	 
        $allproduct=array(); foreach($result['rows'] as $item){ array_push($allproduct, $item->prod_id); }
        if(empty($allproduct)){return array();}

        $this->db->select('u.state,u.zip,s.code');
        $this->db->where(array('u.id'=>$user_id));
        $this->db->join('statelist s','u.state=s.id');
        $buyerstate=$this->db->get('user_Info u')->row();
        //print_r($buyerstate);exit;
        $this->db->select('user_id');$this->db->where_in('id',$allproduct);$this->db->group_by('user_id');
	$users=$this->db->get('product')->result();
       //print_r($users); exit;
	//print_r($result); exit;
        foreach($result['rows'] as $item){
            //$productoption=$this->cart->product_options($item['rowid']);
            $hassellertax=$this->db->get_where('user_tax',array('user_id'=>$item->seller_id))->row();
            //echo $this->db->last_query();
            //if($hassellertax){echo "got record";}else{echo "no";}
            //print_r($hassellertax);
            $this->db->select('usi.merchant_id,u.f_name,u.l_name,p.id as prod_id,p.taxable_status,p.weight,(p.local_shipping*'.$item->qty.') as ttl_local_shipping,usi.zip,s.code,(p.prod_price*'.$item->qty.') as prod_total,p.user_id,if(p.taxable_status="1",if(u.state='.$buyerstate->state.',IFNULL(dt.total,"0"),"0"),"0") as tax,if(u.state='.$buyerstate->state.',dt.details,"Tax not charged") as desc,(((p.prod_price*'.$item->qty.')*(if(p.taxable_status="1",if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0"),"0")))/100) as sub_total_tax,((p.prod_price*'.$item->qty.')+((((p.prod_price*'.$item->qty.')*(if(p.taxable_status="1",if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0"),"0")))/100))) as sub_total');
            $this->db->join('user_Info u','p.user_id=u.id','left');
            $this->db->join('user_store_info usi','u.id=usi.user_id','left');
            $this->db->join('statelist s','u.state=s.id');
            if($hassellertax) $this->db->join('user_tax dt','u.id=dt.user_id','left'); else $this->db->join('default_tax dt','u.state=dt.state_id','left');
            $this->db->where('p.id',$item->prod_id);
            $this->db->group_by('p.id');
            $results[]=$this->db->get('product p')->row();

            //echo $this->db->last_query(); echo "</br></br></br>";
        }
        //echo "<pre>";print_r($results);exit;
        foreach($users as $user){
            //echo "<pre>"; print_r($user);
            $finaldata=array();
            $finaldata['local_shipping']=0;$finaldata['prod_total']=0;$finaldata['sub_total_tax']=0;$finaldata['sub_total']=0;$weight=0;$finaldata['tax']=0;$finaldata['taxable_status']=0;
            foreach($results as $result){
                //echo "<pre>";print_r($result);
               // echo "check".$result->taxable_status;
                if($user->user_id==$result->user_id){
                    $weight+=$result->weight;
                    $from_state=$result->code;
                    $from_zip=$result->zip;
                    $finaldata['merchant_id']=$result->merchant_id;
                    $finaldata['f_name']=$result->f_name;
                    $finaldata['l_name']=$result->l_name;
			$finaldata['prod_id']=$result->prod_id;
                    $finaldata['prod_total']+=$result->prod_total;
                    $finaldata['local_shipping']+=$result->ttl_local_shipping;
                    $finaldata['user_id']=$result->user_id;
                    $finaldata['tax']+= $result->tax;
                    $finaldata['desc']=$result->desc;
                    $finaldata['sub_total_tax']+=$result->sub_total_tax;
                    $finaldata['sub_total']+=$result->sub_total;
                    $finaldata['taxable_status']+=$result->taxable_status;
                }
            } 
            //echo "<pre>";
           // print_r($finaldata); 
            // 5 Apr 2016
            $to_zip=($new_zip==0)?$buyerstate->zip:$new_zip;
            //$to_zip=($new_zip==0)?$buyerstate->zip:($this->session->has_userdata("shipto"))?$this->session->userdata("shipto"):$new_zip;
            
            //my comment
            //$this->session->set_userdata("shipto",$to_zip);
            $dataforship=array('weight'=>$weight,'from_state'=>$from_state,'from_zip'=>$from_zip,'to_state'=>$buyerstate->code,'to_zip'=>$to_zip);
            //echo "<pre>";print_r($dataforship); 
            $getshipping=$this->shippingcalculator($dataforship);
            //echo "<pre>"; print_r($getshipping);
            $finaldata['shippingdetails']=$getshipping;
           //$finaldata['shippingdetails']=array('fedex'=>array());
            $finaldata1[]=(object)$finaldata;
            
        
        }
        
        //my commented
        //$this->session->set_userdata('productpricedetails',$finaldata1);
       
        if($finaldata1) return $finaldata1; else return array();
    }
	
	//TAX Calculation Function
	
	function tax_calcualtion($user_id,$toship)
	{
		 $query="SELECT cart.*,CONCAT_WS(' ',ui.f_name,ui.l_name) as seller from temp_cart as cart join user_Info as ui where cart.user_id='".$user_id."' and ui.id=cart.seller_id order by added_date DESC";
         $result=$this->common->dbQuery($query);
		 
		 $allproduct=array(); foreach($result['rows'] as $item){ array_push($allproduct, $item->prod_id); }
		 //$this->db->select('state');
		 //$buyerstate=$this->db->get_where('user_Info',array('id'=>$user_id))->row();
		 
		$this->db->select('u.state,u.zip,s.code');
        $this->db->where(array('u.id'=>$user_id));
        $this->db->join('statelist s','u.state=s.id');
        $buyerstate=$this->db->get('user_Info u')->row();
		 
		 
         $this->db->select('user_id');
		 $this->db->where_in('id',$allproduct);
		 $this->db->group_by('user_id');
		 $users=$this->db->get('product')->result();
 
		 foreach($result['rows'] as $item){
            $hassellertax=$this->db->get_where('user_tax',array('user_id'=>$item->seller_id))->row();
            $this->db->select('usi.merchant_id,u.f_name,u.l_name,p.weight,usi.zip,s.code,(p.prod_price*'.$item->qty.') as prod_total,p.user_id,if(u.state='.$buyerstate->state.',IFNULL(dt.total,"0"),"0") as tax,if(u.state='.$buyerstate->state.',dt.details,"Tax not charged") as desc,(((p.prod_price*'.$item->qty.')*(if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0")))/100) as sub_total_tax,((p.prod_price*'.$item->qty.')+((((p.prod_price*'.$item->qty.')*(if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0")))/100))) as sub_total');
            $this->db->join('user_Info u','p.user_id=u.id','left');
            $this->db->join('user_store_info usi','u.id=usi.user_id','left');
			$this->db->join('statelist s','u.state=s.id');
            
            if($hassellertax) $this->db->join('user_tax dt','u.id=dt.user_id','left'); else $this->db->join('default_tax dt','u.state=dt.state_id','left');
            $this->db->where('p.id',$item->prod_id);
            $this->db->group_by('p.id');
            $results[]=$this->db->get('product p')->row();
            
        }
        
        foreach($users as $user){ 
            $finaldata=array();
            $finaldata['prod_total']=0;$finaldata['sub_total_tax']=0;$finaldata['sub_total']=0;$weight=0;
            foreach($results as $result11){
                if($user->user_id==$result11->user_id){
					
					$weight+=$result11->weight;
                    $from_state=$result11->code;
                    $from_zip=$result11->zip;
					
                    $finaldata['merchant_id']=$result11->merchant_id;
                    $finaldata['f_name']=$result11->f_name;
                    $finaldata['l_name']=$result11->l_name;
                    $finaldata['prod_total']+=$result11->prod_total;
                    $finaldata['user_id']=$result11->user_id;
                    $finaldata['tax']= $result11->tax;
                    $finaldata['desc']=$result11->desc;
                    $finaldata['sub_total_tax']+=$result11->sub_total_tax;
                    $finaldata['sub_total']+=$result11->sub_total;
                }
            }
			
			//$dataforship=array('weight'=>$weight,'from_state'=>$from_state,'from_zip'=>$from_zip,'to_state'=>$buyerstate->code,'to_zip'=>$buyerstate->zip);
			if($toship > 0){
			$dataforship=array('weight'=>$weight,'from_state'=>$from_state,'from_zip'=>$from_zip,'to_state'=>$buyerstate->code,'to_zip'=>$toship);
            $getshipping=$this->shippingcalculator($dataforship);
            $finaldata['shippingdetails']=$getshipping;
			}
			else{
				$finaldata['shippingdetails']=array();
			}
			
            $finaldata1[]=(object)$finaldata;
        }
		return $finaldata1;
	}

	//TAX Calculation Function END
	
	function bid_price_details(){
		 header('Access-Control-Allow-Origin: *');
		$auctionid=$this->input->post('auc_id');
        $sellerid=$this->input->post('seller_id');
		$user_id=$this->input->post('uid');
		$toship=$this->input->post('tozip');
		 
		 //For tax and shipping Calculations Start
		 $finaldata1=$this->tax_calcualtion_for_bid($auctionid,$sellerid,$user_id,$toship);
		 //For Tax Calculation End
          if(!empty($finaldata1)){
			  echo json_encode(array('status'=>true,'result'=>$finaldata1));
            }
            else{	
                echo json_encode(array('status'=>FALSE));
            }
        
    }
	
	
	
	
	
	// Price calculation with tax and Shipping for bid product
	function tax_calcualtion_for_bid($auctionid,$sellerid,$uid,$toship){
		
		
        $this->db->select('u.state,u.zip,s.code');
        $this->db->where(array('u.id'=>$uid));
        $this->db->join('statelist s','u.state=s.id');
        $buyerstate=$this->db->get('user_Info u')->row();
        
        $hassellertax=$this->db->get_where('user_tax',array('user_id'=>$sellerid))->row();
            
        $this->db->select('usi.merchant_id,u.f_name,u.l_name,p.weight,usi.zip,s.code,(max(btc.price)) as prod_total,p.user_id,if(u.state='.$buyerstate->state.',IFNULL(dt.total,"0"),"0") as tax,if(u.state='.$buyerstate->state.',dt.details,"Tax not charged") as desc,(((max(btc.price))*(if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0")))/100) as sub_total_tax,((max(btc.price))+((((max(btc.price))*(if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0")))/100))) as sub_total');
        $this->db->join('product p','pa.prod_id=p.id','left');
        $this->db->join('bid_tbl_cart btc','pa.id=btc.auction','left');
        $this->db->join('user_Info u','p.user_id=u.id','left');
        $this->db->join('user_store_info usi','u.id=usi.user_id','left');
        $this->db->join('statelist s','u.state=s.id');
        if($hassellertax) $this->db->join('user_tax dt','u.id=dt.user_id','left'); else $this->db->join('default_tax dt','u.state=dt.state_id','left');
        $this->db->where('pa.id',$auctionid);
        $this->db->group_by('pa.id');
        $results=$this->db->get('product_auction pa')->row();
        $weight=$results->weight;
        $from_state=$results->code;
        $from_zip=$results->zip;
        
        $results=(array)$results;
        
        //$dataforship=array('weight'=>$weight,'from_state'=>$from_state,'from_zip'=>$from_zip,'to_state'=>$buyerstate->code,'to_zip'=>$buyerstate->zip);
		if($toship > 0){
		$dataforship=array('weight'=>$weight,'from_state'=>$from_state,'from_zip'=>$from_zip,'to_state'=>$buyerstate->code,'to_zip'=>$toship);
        $getshipping=$this->shippingcalculator($dataforship);
        $results['shippingdetails']=$getshipping;
		}
		else{
			$results['shippingdetails']=array();
		}
		
        $finaldata1[]=(object)$results;
        
		return $finaldata1;
     
    }
	
	// Price calculation with tax for bid product END
	
	
	
	
	//Shipping Calculations Start
	function shippingcalculator($data){
       
        $services['fedex']['PRIORITYOVERNIGHT'] = 'Priority Overnight';
        $services['fedex']['STANDARDOVERNIGHT'] = 'Standard Overnight';
        $services['fedex']['FIRSTOVERNIGHT'] = 'First Overnight';
        $services['fedex']['FEDEX2DAY'] = '2 Day';
        $services['fedex']['FEDEXEXPRESSSAVER'] = 'Express Saver';
        $services['fedex']['FEDEXGROUND'] = 'Ground';
        $services['fedex']['FEDEX1DAYFREIGHT'] = 'Overnight Day Freight';
        $services['fedex']['FEDEX2DAYFREIGHT'] = '2 Day Freight';
        $services['fedex']['FEDEX3DAYFREIGHT'] = '3 Day Freight';
        $services['fedex']['GROUNDHOMEDELIVERY'] = 'Home Delivery';
        $services['fedex']['INTERNATIONALECONOMY'] = 'International Economy';
        $services['fedex']['INTERNATIONALFIRST'] = 'International First';
        $services['fedex']['INTERNATIONALPRIORITY'] = 'International Priority';

       
        $config = array(
                // Services
                'services' => $services,
                // Weight
                'weight' => $data['weight'], // Default = 1
                'weight_units' => 'lb', // lb (default), oz, gram, kg
                // Size
//                'size_length' => 150, // Default = 8
//                'size_width' => 112, // Default = 4
//                'size_height' => 120, // Default = 2
//                'size_units' => 'in', // in (default), feet, cm
                // From
                'from_zip' => $data['from_zip'], //97210,94040
                'from_state' => $data['from_state'], // Only Required for FedEx  CA
                'from_country' => "US",
                // To
                'to_zip' => $data['to_zip'], //55455,55455
                'to_state' => $data['to_state'], // Only Required for FedEx MN
                'to_country' => "US",

                // Service Logins
                'ups_access' => '', // UPS Access License Key
                'ups_user' => '', // UPS Username  
                'ups_pass' => '', // UPS Password  
                'ups_account' => '', // UPS Account Number
                'usps_user' => '', // USPS User Name
                'fedex_account' => '510087321', // FedEX Account Number
                'fedex_meter' => '118711956' // FedEx Meter Number 
        );   
	//print_r($config);     
        $this->load->library('Shippingcalculator',$config,'ship');
        $rates = $this->ship->calculate();
        foreach($rates['fedex'] as $key=>$value){if(!$value>0){unset($rates['fedex'][$key]);}}
	
        return $rates;

    }
	
	//Shipping Calculations End
	
	
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
			
			$payfor=$this->input->post('pay_for');
			//echo $payfor;exit;
            $expiry=$this->input->post('exp_date');
			//$expiry='11/2026';
			$paidamt=$this->input->post('amount');
			

			$admincomm=$this->getadminsettings(); // in %
            $admincommission =  (($paidamt*$admincomm->commission)/100);
			
			
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
						$paymentdata['commission']=$admincommission;
                        $paymentdata['datetime']=date('Y-m-d H:i:s');
		$this->authorize_net->setData($auth_net);
		
		//echo json_encode(array('status'=>true,'data'=>$this->authorize_net->authorizeAndCapture()));exit;
        //For Billing Info(8th April)
		$billing=array('name'=>$this->input->post('billname'),
                                'email'=>$this->input->post('billemail'),
                                'street'=>$this->input->post('billstreet'),
                                'city'=>$this->input->post('billcity'),
                                'state'=>$this->input->post('billstate'),
                                'zipCode'=>$this->input->post('billzip')
                       );
		$paymentdata['billingaddress']=$billing;
		
		//For Billing Info
		
		//echo json_encode(array('status'=>true,'data'=>$this->authorize_net->authorizeAndCapture()));exit;
		if( $this->authorize_net->authorizeAndCapture() )
		{  
                        $paymentdata['amount']=$this->input->post('amount');
                        $paymentdata['tokan']=$this->authorize_net->getTransactionId();
                        $paymentdata['paystatus']='success';
						
						if($payfor=='product'){
							$paymentdata['shipping']=json_decode($this->input->post('seller_id'));
							$paym=$this->card_payment_insert_product($paymentdata);
							}
						else if($payfor=='bid'){
							$paymentdata['auctionid']=$this->input->post('auc_id');
							//$paymentdata['sellerid']=$this->input->post('seller_id');
							$paymentdata['shipping']=json_decode($this->input->post('seller_id'));
                            $paym=$this->card_payment_insert_bidproduct($paymentdata,'A');
						}else if($payfor=='user'){
							$paym=$this->card_payment_insert_user($paymentdata);
						}
						else if($payfor=='campaign'){
						    //$paymentdata['name']=$this->input->post('name');
                            $paymentdata['sellerid']=$this->input->post('seller_id');
							$paymentdata['campaignId']=$this->input->post('auc_id');  // campaignId
							
							$paym=$this->card_payment_insert_campaign($paymentdata);
							
							//print_R($paymentdata);exit;
							//echo json_decode(array('status'=>true,'result'=>'test'));exit;
							//$paym=true;
						}
						
						if($paym){
						header('Access-Control-Allow-Origin: *');
						//print_r($paymentdata);exit;
						echo json_encode(array('status'=>true,'result'=>$paymentdata));
						}
                                           
		}
		else
		{ 
		  header('Access-Control-Allow-Origin: *');
		  echo json_encode(array('status'=>false,'message'=>'Payment failed.something went wrong.'));          
		}
            
	}
	//END For Credit Card payment
	
	
	
	
	//For Payment Through Braintree
	function paymentBraintree()
	{ 
	        header('Access-Control-Allow-Origin: *');
			$payfor=$this->input->post('pay_for');
			//echo $payfor;exit;
            $expiry=$this->input->post('exp_date');
			$paidamt=$this->input->post('amount');
			$admincomm=$this->getadminsettings(); // in %
            $admincommission =  (($paidamt*$admincomm->commission)/100);
			
			$paymentdata['uid']=$this->input->post('uid');
			$paymentdata['name']=$this->input->post('uname');
            $paymentdata['email']=$this->input->post('email');
            $paymentdata['street']=$this->input->post('street');
            $paymentdata['city']=$this->input->post('city');
            $paymentdata['state']=$this->input->post('state');
            $paymentdata['zipCode']=$this->input->post('zip');
            $paymentdata['Payment_type']='Card';
            $paymentdata['payment_with']='Braintree';
            $paymentdata['datetime']=date('Y-m-d H:i:s');
			
			
			//For Billing Info(8th April)
		    $billing=array('name'=>$this->input->post('billname'),
                                'email'=>$this->input->post('billemail'),
                                'street'=>$this->input->post('billstreet'),
                                'city'=>$this->input->post('billcity'),
                                'state'=>$this->input->post('billstate'),
                                'zipCode'=>$this->input->post('billzip')
                       );
		    $paymentdata['billingaddress']=$billing;
		
		//For Billing Info
			
		
            if($payfor=='product')
			{
				$full=false;$partial=false;$errormessage='';$successproduct11=array();
				//echo $paymentdata['uid'];
				$finaldata1=$this->tax_calcualtion($paymentdata['uid'],0);
				//print_r($finaldata1);exit;
				foreach($finaldata1 as $product_details){
                    $admincommission=(($product_details->prod_total*$admincomm->commission)/100);
                    $seller_amount=(($product_details->prod_total - $admincommission)+$product_details->sub_total_tax);
                    $paymentdata1=array('amount'=>$seller_amount,
                                       'merchantAccountId'=>$product_details->merchant_id,
                                       'number'=>$this->input->post('card_number'),
                                       'expirationDate'=>$expiry,
                                       'serviceFeeAmount'=>$admincommission);
                    $result=$this->braintree->pay_with_hold($paymentdata1);
                    //print_r($result);exit;
                    if($result['status']){
                        $full=true;
                        $paymentdata['sellerid']=$product_details->user_id;
                        $paymentdata['commmission']=$admincommission;
                        $paymentdata['amount']=$product_details->sub_total;
                        $paymentdata['tokan']=$result['token'];
						$paymentdata['shipping']=json_decode($this->input->post('seller_id'));
                        $paymentdata['paystatus']='success';
                        $successproduct=$this->braintree_payment_insert_product($paymentdata);
                        $successproduct11=array_merge($successproduct11,$successproduct);
                        $transaction[]=$result['token'];
                        $transdata=array('tokan'=> implode(',',$transaction) ,'amount'=>$paidamt,'paystatus'=>'success');   
                    }
					else{
                        $partial=true;
                        $errormessage=$result['errorMessage'];
                    }
               }
			   
			   if($full && !$partial){
						header('Access-Control-Allow-Origin: *');
					    echo json_encode(array('status'=>true,'result'=>$transdata));
						}
                else if($full && $partial){
					header('Access-Control-Allow-Origin: *');
					    echo json_encode(array('status'=>false,'message'=>'Due to some reason partial payment has been done.'));
					}
                else if(!$full && $partial){
					    header('Access-Control-Allow-Origin: *');
					    echo json_encode(array('status'=>true,'message'=>$errormessage));
					}
			   
				
			}
			
			
			else if($payfor=='user')
			{
				$paymentdata1=array('amount'=>$paidamt,
                                    'number'=>$this->input->post('card_number'),
                                    'expirationDate'=>$expiry);
                $result=$this->braintree->direct_pay_to_admin($paymentdata1);

				if ($result['status']) {
					$paymentdata['amount']=$paidamt;
					$paymentdata['tokan']=$result['token'];
					$paymentdata['paystatus']='success';
					$paym=$this->card_payment_insert_user($paymentdata);
					if($paym){
						header('Access-Control-Allow-Origin: *');
						echo json_encode(array('status'=>true,'result'=>$paymentdata));
				    }
					
				}
				else{
					
					$errormessage=$result['errorMessage'];
					header('Access-Control-Allow-Origin: *');
					echo json_encode(array('status'=>false,'message'=>$errormessage));
				}
				
			}
			else if($payfor=='bid')
			{
				$ss=json_decode($this->input->post('seller_id'));
				$seller=$ss[0]->sellerid;
		        $shipcharge=$ss[0]->ship_amt;
				$aacid=$this->input->post('auc_id');
				$userrid=$this->input->post('uid');
            
			   $product_details=$this->tax_calcualtion_for_bid($aacid,$seller,$userrid,0);
				
				
				
                $admincommission=(($product_details[0]->prod_total*$admincomm->commission)/100);
                $seller_amount=(($product_details[0]->prod_total - $admincommission)+$product_details[0]->sub_total_tax+$shipcharge);
				$merchant_id=$product_details[0]->merchant_id;
				
				
               // $merchant_id=$this->get_user_store(array('merchant_id'),array('user_id'=>$seller));
                $paymentdata1=array('amount'=>$seller_amount,
                                       'merchantAccountId'=>$merchant_id,
                                       'number'=>$this->input->post('card_number'),
                                       'expirationDate'=>$expiry,
                                       'serviceFeeAmount'=>$admincommission);
                $result=$this->braintree->pay_with_hold($paymentdata1);
                $paymentdata['commission']=$admincommission;
                $paymentdata['sellerid']=$seller;
				
				
				if ($result['status']) {
					$paymentdata['amount']=$paidamt;
					$paymentdata['tokan']=$result['token'];
					$paymentdata['paystatus']='success';
					$paymentdata['shipping']=json_decode($this->input->post('seller_id'));
					$paymentdata['auctionid']=$this->input->post('auc_id');
                    $paym=$this->card_payment_insert_bidproduct($paymentdata,'B');
					if($paym){
						header('Access-Control-Allow-Origin: *');
						echo json_encode(array('status'=>true,'result'=>$paymentdata));
				    }
					
				}
				else{
					$errormessage=$result['errorMessage'];
					header('Access-Control-Allow-Origin: *');
					echo json_encode(array('status'=>false,'message'=>$errormessage));
				}
				
				
				
			}
		
		
            
	}
	
	//For Payment Through Braintree
	
	function card_payment_insert_product($data)
    { 
	    $admincomm=$this->getadminsettings(); // in %
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
			
			
			// For Billing Address in DB(8th apr 2016)
                $data_billingadd=array('table'=>'billing_address','val'=>array(
                    'trans_id'=>$data['tokan'],
                    'bill_name'=>$data['billingaddress']['name'], 
                    'bill_email'=>$data['billingaddress']['email'], 
                    'bill_street'=>$data['billingaddress']['street'], 
                    'bill_city'=>$data['billingaddress']['city'], 
                    'bill_state'=>$data['billingaddress']['state'], 
                    'bill_zipCode'=>$data['billingaddress']['zipCode']
                    ));  
                $result_bill=$this->common->add_data($data_billingadd);
            // For Billing Address in DB(8th apr 2016)
		   
            
            
        $result=$this->common->add_data($data_transaction);
		
		// price details with tax sellerwise
		$finaldata1=$this->tax_calcualtion($data['uid'],0);
         foreach($finaldata1 as $productdetails){
			foreach($data['shipping'] as $ship){if($ship->sellerid==$productdetails->user_id){$shipcharge=$ship->ship_amt;}}
            $admincommission =  (($productdetails->prod_total*$admincomm->commission)/100); 
            $transaction_seller[]=array(
               'trans_id'=>$data['tokan'],
               'seller_id'=>$productdetails->user_id,
               'tax'=>$productdetails->tax,
               'total'=>$productdetails->prod_total,
               'commission'=>$admincommission,
			   'shippingcharge'=>$shipcharge,
               'status'=>'0',
               'pt'=>'A',
               'tansdatetime'=>$data['datetime']);
         }
         $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
         $insert=$this->common->insert_multi_row($data111);
         
        // End price details with tax sellerwise
       if($result && $result2 && $insert)
       {
		  $qr="Delete from temp_cart where user_id='".$data['uid']."'";
		  $res=$this->db->query($qr);
          return true;
          
       }
       else{
       
       }
       
    }
	
	
	
	
    function card_payment_insert_bidproduct($data,$pt)
    {  
		$admincomm=$this->getadminsettings(); // in %
        $date=date('Y-m-d');
        $data_transaction=array('table'=>'transaction','val'=>array(
           'trans_id'=>$data['tokan'],
           'order_id'=>$data['auctionid'],// this is auction id
           'price'=>$data['amount'],
           'date'=>$date,
           'payment_for'=>"bidproduct",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
           'status'=>'success'));                    

            $bidid=$data['auctionid'];// auction id
            $data11=array("table"=>"product_auction","val"=>array("prod_id"),"where"=>array("id"=>$bidid));
            $items=$this->common->getdata($data11);
			
			 $seller_id=$data['shipping'][0]->sellerid;
		     $shipcharge=$data['shipping'][0]->ship_amt;
            
			$product_details=$this->tax_calcualtion_for_bid($data['auctionid'],$seller_id,$data['uid'],0);
			//print_r($product_details);exit;
			
            $orderdata=array('table'=>'order_detail_form','val'=>array(                       
                  'status'=>'1',
                  'buyerId'=>$data['uid']!=""?$data['uid']:'000',
                  'product_id'=>$items['rows'][0]->prod_id,// current bid product id
                  'price'=>$product_details[0]->prod_total,//this is bid amount
                  'quantity'=>'1',
                  'trans_id'=>$data['tokan'],
                  'date'=>$date));
          $result2=$this->common->add_data($orderdata);
          $result=$this->common->add_data($data_transaction);
		  
		  $admincommission = (($product_details[0]->prod_total*$admincomm->commission)/100);
		 
		  $transaction_seller=array(
                'trans_id'=>$data['tokan'],
                'seller_id'=>$seller_id,
                'tax'=>$product_details[0]->tax,
                'total'=>$product_details[0]->prod_total,
                'commission'=>$data['commission'], // (($data['amount']*admincomm)/100)
				'shippingcharge'=>$shipcharge,
                'status'=>'0',
                'pt'=>$pt,
                'tansdatetime'=>$data['datetime']); 
           $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
           $insert=$this->common->add_data($data111);
		

			// For Billing Address in DB(8th apr 2016)
                $data_billingadd=array('table'=>'billing_address','val'=>array(
                    'trans_id'=>$data['tokan'],
                    'bill_name'=>$data['billingaddress']['name'], 
                    'bill_email'=>$data['billingaddress']['email'], 
                    'bill_street'=>$data['billingaddress']['street'], 
                    'bill_city'=>$data['billingaddress']['city'], 
                    'bill_state'=>$data['billingaddress']['state'], 
                    'bill_zipCode'=>$data['billingaddress']['zipCode']
                    ));  
                $result_bill=$this->common->add_data($data_billingadd);
            // For Billing Address in DB(8th apr 2016)

       if($result && $result2 && $insert)
       {
		   return true;
       }else{ 
	   
       }
       
    }
	
	
	
	
	function card_payment_insert_user($data)
    {
            $date=date('Y-m-d');
            $data_transaction=array('table'=>'transaction','val'=>array(
               'trans_id'=>$data['tokan'],
               'order_id'=>$data['uid'],
               'price'=>$data['amount'],
               'date'=>$date,
               'payment_for'=>"user",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
               'status'=>'success'));
            $data_user=array('table'=>'user_payment','val'=>array('user_id'=>$data['uid'],'tranc_id'=>$data['tokan'],'price'=>$data['amount'],'add_date'=>$date));
             $result3=$this->common->add_data($data_user);
           $data1=array('table'=>'user_Info','val'=>array('paid'=>'1'),'where'=>array('id'=>$data['uid']));
            $result2=$this->common->update_data($data1);
           $result=$this->common->add_data($data_transaction); 
		   
		   $expire=date('Y-m-d', strtotime('+1 year', strtotime($date)) );
		   
		   $sub_data=array('table'=>'subscription_expire','val'=>array('user_id'=>$data['uid'],'start_date'=>$date,'end_date'=>$expire));
           $result4=$this->common->add_data($sub_data);
		   
		   
           if($result && $result2 && $result3 && $result4)
           {
            return true;
           }
           else{
           
           }
        
    }
	
	
	
    function braintree_payment_insert_product($data)
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
		   $prodids=array();
           foreach ($result_aj['rows'] as $items)
            {
				if($items->seller_id == $data['sellerid']) {
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
                
                $get_product=$this->get_product_details($items->prod_id);
                $quantity=($get_product['rows'][0]->no_of_Prod-$items->qty);
                $update_quantity_data=array('table'=>'product','val'=>array('no_of_Prod'=>$quantity),'where'=>array('id'=>$items->prod_id));
                $update_qty=$this->common->update_data($update_quantity_data); 
				$successproduct[]=$items;
				array_push($prodids,$items->prod_id);
				
				
				}
                
            }
			
			$data_billingadd=array('table'=>'billing_address','val'=>array(
                    'trans_id'=>$data['tokan'],
                    'bill_name'=>$data['billingaddress']['name'], 
                    'bill_email'=>$data['billingaddress']['email'], 
                    'bill_street'=>$data['billingaddress']['street'], 
                    'bill_city'=>$data['billingaddress']['city'], 
                    'bill_state'=>$data['billingaddress']['state'], 
                    'bill_zipCode'=>$data['billingaddress']['zipCode']
                    ));  
                $result_bill=$this->common->add_data($data_billingadd);
            
            
             $finaldata1=$this->tax_calcualtion($data['uid'],0);
              foreach($finaldata1 as $productdetails){
				 foreach($data['shipping'] as $ship){if($ship->sellerid==$productdetails->user_id){$shipcharge=$ship->ship_amt;}} 
                 if($productdetails->user_id==$data['sellerid']){
                    $transaction_seller=array(
                       'trans_id'=>$data['tokan'],
                       'seller_id'=>$productdetails->user_id,
                       'tax'=>$productdetails->tax,
                       'total'=>$productdetails->prod_total,
                       'commission'=>$data['commmission'], // (($productdetails->prod_total*admincomm)/100)
					   'shippingcharge'=>$shipcharge,
                       'status'=>'0',
                        'pt'=>'B',
                        'tansdatetime'=>$data['datetime']); 
                    $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
                    $insert=$this->common->add_data($data111);
                 }
             }
			  
             $prodids1=implode(',',$prodids);
			 $qr="Delete from temp_cart where user_id='".$data['uid']."' and prod_id IN ($prodids1)";
		     $this->db->query($qr);
            
            $result=$this->common->add_data($data_transaction);
            return $successproduct;
			

    }
	
	
	
	
	
	function autosearch(){
		header('Access-Control-Allow-Origin: *');
		    $autosearch=$this->input->post('autosearch');
            $current_date=date("Y-m-d");   
            $like1=array(
                array("likeon"=>"p.prod_name","likeval"=>$autosearch),    
            );
            $data['product']=array("table"=>"product p","val"=>"p.id,p.prod_name","where"=>array("p.status"=>"1","p.admin_status"=>"1","p.no_of_Prod > "=> '0'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),"like"=>$like1,'orderby'=>'p.id','orderas'=>'DESC');
            $log=$this->common->getdatalikeor($data['product']);
            //print_r($log['product']);exit;
            echo json_encode($log);
            //echo $log;
        }
		
	function bid_details()
	{
		$pid=$this->input->post('product_id');
		$query="SELECT bid.*,u.f_name,u.l_name from bid_tbl_cart as bid join user_Info as u where bid.user_id=u.id and bid.product_id='".$pid."' order by bid.add_date DESC";
        $result=$this->common->dbQuery($query);
		if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE,'result'=>'no records found.'));
            }
		
	}
	
	function bid()
	{
		//print_r($_POST);exit;
		$pid=$this->input->post('pid');
		$userid=$this->input->post('uid');
		$amt=$this->input->post('bidprice');
		$auctionid=$this->get_auction_id($pid);
		$date=time();
        $cutdate=date('Y-m-d',$date);
		$data=array("table"=>"bid_tbl_cart","val"=>array("user_id"=>$userid,"product_id"=>$pid,"price"=>$amt,"add_date"=>$cutdate,"auction"=>$auctionid));
		 $log=$this->common->add_data($data);
		if($log)
            {
			  echo json_encode(array('status'=>true,'result'=>'success'));
            }
            else{
                echo json_encode(array('status'=>FALSE,'result'=>'fail'));
            }
		
	}
	
	function add_product()
	{
		header('Access-Control-Allow-Origin: *');
		
		$userid=$this->input->post('uid');
        $category=$this->input->post("cat");
        $name=$this->input->post("pname");
        $price=$this->input->post("price");
        $details=$this->input->post("pdetails");
        $quantity=$this->input->post("pqty");
		
		$weight=$this->input->post("weight");
		$weight_unit='lb';
		$length=$this->input->post("length");
		$width=$this->input->post("width");
		$height=$this->input->post("height");
		$die_unit="in";
		
		
		
		
        $selltype=$this->input->post("selltype");
        $status=$this->input->post("status");
		$prodImage=$this->input->post("prod_img");
		if($prodImage==''){$prodImage='detault.png';}
		
		
        $admin_status=$this->getadminsettings();
		
        if($selltype=='1'){
			
            $bid_start_date=$this->input->post("startdate");
            $bid_end_date=$this->input->post("enddate");
            $bid_purchase_date=$this->input->post("purchasedate");
            $quantity='1';
			
        }else{
			
            $bid_start_date="";
            $bid_end_date="";
            $bid_purchase_date="";
        }
       
        $current_date=date('Y-m-d');             
        $data=array('table'=>'product','val'=>array('user_id'=>$userid,'category'=>$category,'prod_name'=>$name,'prod_price'=>$price,'pord_detail'=>$details,'bid_status'=>$selltype,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,'weight'=>$weight,'weight_unit'=>$weight_unit,'length'=>$length,'width'=>$width,'height'=>$height,'die_unit'=>$die_unit,'prod_img'=>$prodImage,'no_of_Prod'=>$quantity,'status'=>$status,"date"=>$current_date,'admin_status'=>$admin_status->product_status));                
        $prod_id=$this->common->add_data_get_id($data);
        if($selltype=='1'){
            $data=array('table'=>'product_auction','val'=>array("prod_id"=>$prod_id,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,"price"=>$price));                
            $log=$this->common->add_data($data);
        }
		if($prod_id)
		{
			echo json_encode(array('status'=>true,'message'=>'Successfully Added'));
		}
		else
		{
            echo json_encode(array('status'=>FALSE,'message'=>'fail'));
        }
        
       
	}
	
	
	function update_product()
	{
		header('Access-Control-Allow-Origin: *');
		$prodId=$this->input->post('pid');
        $category=$this->input->post("cat");
        $name=$this->input->post("pname");
        $price=$this->input->post("price");
        $details=$this->input->post("pdetails");
        $quantity=$this->input->post("pqty");
		
		$weight=$this->input->post("weight");
		$weight_unit='lb';
		$length=$this->input->post("length");
		$width=$this->input->post("width");
		$height=$this->input->post("height");
		$die_unit="in";
		
		
        $selltype=$this->input->post("selltype");
        $status=$this->input->post("status");
		$prodImage=$this->input->post("prod_img");

        if($selltype=='1'){
			
            $bid_start_date=$this->input->post("startdate");
            $bid_end_date=$this->input->post("enddate");
            $bid_purchase_date=$this->input->post("purchasedate");
            $quantity='1';
			
        }else{
            $bid_start_date="";
            $bid_end_date="";
            $bid_purchase_date="";
        }
      
		$data=array('table'=>'product','where'=>array('id'=>$prodId),'val'=>array('category'=>$category,'prod_name'=>$name,'prod_price'=>$price,'no_of_Prod'=>$quantity,'pord_detail'=>$details,'bid_status'=>$selltype,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,'weight'=>$weight,'weight_unit'=>$weight_unit,'length'=>$length,'width'=>$width,'height'=>$height,'die_unit'=>$die_unit,'status'=>$status,'prod_img'=>$prodImage));                
		$log=$this->common->update_data($data);
		
        if($selltype=='1'){
            $data1=array("table"=>"product_auction","where"=>array("prod_id"=>$prodId,"status"=>'1'),"val"=> array("id"));
            $res=$this->common->getsinglerow($data1);
            //print_r($res);exit;
            if($res['res']){
                $data=array('table'=>'product_auction','where'=>array("prod_id"=>$prodId,'status'=>'1'),'val'=>array("bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,"price"=>$price));
                $log1=$this->common->update_data($data);    
            }else{
                $data=array('table'=>'product_auction','val'=>array("prod_id"=>$prodId,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,"price"=>$price));
                $log1=$this->common->add_data($data);
            }
        }
		if($log)
		{
			echo json_encode(array('status'=>true,'message'=>'Successfully Updated'));
		}
		else
		{
            echo json_encode(array('status'=>FALSE,'message'=>'fail'));
        }
        
       
	}
	
	
	
	
	
	
	function uploadproductpic(){
		//print_r($_FILES);exit;
		$image=$_FILES['file']['name'];
		copy($_FILES['file']['tmp_name'],'assets/image/product/'.$image);
		//copy($_FILES['file']['tmp_name'],'assets/image/product/thumb/'.$image);
		$img=getimagesize('assets/image/product/'.$image);
		
		if(!empty($img))
		{
			$imgtype= $img['mime'];
	
			    if($imgtype=="image/jpg" || $imgtype=="image/jpeg" )
				{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefromjpeg($uploadedfile);
				}
				else if($imgtype=="image/png")
				{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefrompng($uploadedfile);
				}
				else 
				{
				$src = imagecreatefromgif($uploadedfile);
				}
			
			$width=$img[0];
			$height=$img[1];
	
			$newwidth=190;
			$newheight=140;
			
			$tmp=imagecreatetruecolor($newwidth,$newheight);		
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			$dest = 'assets/image/product/thumb/'.$image;
			imagejpeg($tmp,$dest,100);
			//copy($thumbimg,'assets/image/user/thumb/'.$image);
			echo $image; 
		}
		else{
			unlink('assets/image/product/'.$image);
			echo 'error';
			}	
        
       
    }
	
	function get_categories()
	{
		$query="SELECT * from category where status='Active'";
        $result=$this->common->dbQuery($query);
		if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }

	}
	
	function userlimitation()
	{
		header('Access-Control-Allow-Origin: *');
		$uid=$this->input->post('uid');
		
		$data=array("table"=>"user_Info","val"=>"paid","where"=>array("id"=>$uid));
        $paid=$this->common->getsinglerow($data);
		if($paid['rows']->paid=='0')
		{
			$selleritems=array("table"=>"product","where"=>array("user_id"=>$uid));
            $total_items=$this->common->record_count_where($selleritems);
			
			$data1=array("table"=>"user_validation","val"=>"product_list","where"=>array("user_type"=>"0"));
            $log=$this->common->getsinglerow($data1);
			$limit=$log['rows']->product_list;

			if($total_items==$limit)
			{
			  echo json_encode(array('status'=>true,'result'=>"As a Free User, you are limited to posting only $limit items."));
			}
			else{
				echo json_encode(array('status'=>false,'result'=>"in limit."));
			}
			
		}
		else{
			echo json_encode(array('status'=>false,'result'=>"premium"));
		}
		
		
	}
	
	
	 function buyer_orders(){
		header('Access-Control-Allow-Origin: *');
		$userid=$this->input->post('uid');
        $comment1=array('val'=>'t.trans_id,t.price,t.date,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('o.buyerId'=>$userid,'t.payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
        );
		$result=$this->common->multijoin($comment1,$multijoin1);
		
		if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
    }
	
	function product_delete()
	{
		header('Access-Control-Allow-Origin: *');
        $id = $this->input->post("pid");
        
        $galdata=array("table"=>"product","where"=>array("id"=>$id),"val"=> array("prod_img"));
        $gallery=$this->common->getsinglerow($galdata);
       // print_r($gallery);exit;
        if($gallery['res']){
            if($gallery['rows']->prod_img!='detault.png'){
            $path="assets/image/product/".$gallery['rows']->prod_img;
            if(file_exists($path)){
            unlink($path);}
            $path="assets/image/product/thumb/".$gallery['rows']->prod_img;
           if(file_exists($path)){
            unlink($path);}
            }  
        }
        
        $data=array('table'=>'product','where'=>array('id'=>$id));
        $log=$this->common->delete_data($data);
        
      
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
		
	}
	
	
	function social_links()
	{
		
		$query="SELECT * from social_link where status='1'";
        $result=$this->common->dbQuery($query);
		if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }
		
	}
	
	
	function get_states()
	{
		$query="SELECT * from statelist where status='1'";
        $result=$this->common->dbQuery($query);
		if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }

	}
	
	
	function get_page_content()
	{
		header('Access-Control-Allow-Origin: *');
		$page_id = $this->input->post("page_id");
		$query="SELECT content from pages where id='$page_id' and status='1'";
        $result=$this->common->dbQuery($query);
		//print_r($result);exit;
		if($result['res'])
            {
			  echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }

	}
	
	function get_code_details()
	{
		$code=$this->input->post('code');
		$user_id=$this->input->post('uid'); 
		$today=date('Y-m-d');
        $data1=array('val'=>'*','table'=>'promotion','where'=>array('code'=>$code,'start_date<='=>$today,'end_date>='=>$today,'status'=>'1'));
        $result= $this->common->getdata($data1);
		
		//echo $this->db->last_query();
		//print_r($result);exit;
		if($result['res'])
		{
			$discount=$result['rows'][0]->discount;
			$pid=$result['rows'][0]->id;
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
		else
		{
			echo json_encode(array('status'=>false,'result'=>'Invalid promo code'));
		}
		
	}
	
	
        function manageexpense(){
        //echo "hi";
         header('Access-Control-Allow-Origin: *');
	 $uid=$this->input->post('uid');  
         //echo $uid;
         $datefrom=date('Y').'-01-01';
         $dateto=date('Y-m-d');
         $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,ts.tax','where'=>array("u.id"=>$uid,"udf.date>="=>$datefrom,"udf.date<="=>$dateto),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
         $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>''),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
            //array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')up.tranc_id, up.price, up.add_date,
        );   
        $comment=array('table'=>'user_Info as u','val'=>'up.tranc_id, up.price as themeprice, up.add_date,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic','where'=>array("u.id"=>$uid,"up.add_date>="=>$datefrom,"up.add_date<="=>$dateto),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC');//
        $multijoin=array(            
            array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')
        ); 
        $resp=$this->common->multijoin($comment,$multijoin); 
        $resp1=$this->common->multijoin($comment1,$multijoin1); 
        //print_r($resp);
        //print_r($resp1);
        $result=array("first"=>$resp,"second"=>$resp1);
        //print_r($result);exit;
     
          if($result)
            {
			  echo json_encode(array('status'=>true,'result'=>$result));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
        
        }
        
        
//       function managebuyerexpense(){
//            header('Access-Control-Allow-Origin: *');
//            $uid=$this->input->post('uid');   
//           // echo $uid; exit;
//            $comment=array('val'=>'t.trans_id,t.price,t.date,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','where'=>array('o.buyerId'=>$uid,'t.payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
//            $multijoin=array(  
//                array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
//                array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
//                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
//            );
//            $resp=$this->common->multijoin($comment,$multijoin); 
//            
//             if($resp['res'])
//            {
//                echo json_encode(array('status'=>true,'result'=>$resp['rows']));
//            }
//            else{
//				
//                echo json_encode(array('status'=>FALSE));
//            }
//            
//       }
        
        
        function managebuyerrequirement(){
        header('Access-Control-Allow-Origin: *');
	$uid=$this->input->post('uid');   
        //echo $uid; exit;
        $comment1=array('val'=>'r.id,r.price,r.details,cat.category,r.req_date','table'=>'buyer_requirement as r','where'=>array("r.user_id"=>$uid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'r.cat_id=cat.id','join_type'=>''),
        );

        $table=$this->common->multijoin($comment1,$multijoin1);  
        //print_r($table); exit;
          if($table['res'])
            {
                echo json_encode(array('status'=>true,'result'=>$table['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
        }
        
        
        function addbuyerrequirement()
	{
            //print_r($_POST); exit;
            header('Access-Control-Allow-Origin: *');
            $today=date('Y-m-d');
            $userid=$this->input->post('uid');
            $category=$this->input->post("cat");
            $price=$this->input->post("price");
            $details=$this->input->post("pdetails");
            
            $data=array('table'=>'buyer_requirement','val'=>array('user_id'=>$userid,'cat_id'=>$category,'price'=>$price,'details'=>$details,'req_date'=>$today));                
            $result=$this->common->add_data($data);
            
            if($result)
		{
			header('Access-Control-Allow-Origin: *');
			echo json_encode(array('status'=>true,'message'=>'Requirement Add Sucessfully'));
		}
                else{

                    echo json_encode(array('status'=>FALSE));
                }
	}
        
        
        function requirements_view()
	{
		header('Access-Control-Allow-Origin: *');
		$r_id=$this->input->post('id');
                //echo $r_id; exit;
		$comment1=array('val'=>'r.id,r.price,r.details,cat.category,r.req_date','table'=>'buyer_requirement as r','where'=>array("r.id"=>$r_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC');
                $multijoin1=array(  
                    array('table'=>'category as cat','on'=>'r.cat_id=cat.id','join_type'=>''),
                );

                    $result=$this->common->multijoin($comment1,$multijoin1); 
                   // print_r($result); exit;    
                if($result['res'])
                {

                  echo json_encode(array('status'=>true,'result'=>$result['rows']));
                }
                else{

                    echo json_encode(array('status'=>FALSE));
                }
	}
        
        
        function updatebuyerrequirement()
	{
            //print_r($_POST); exit;
            header('Access-Control-Allow-Origin: *');
            $r_id=$this->input->post('id');
            $today=date('Y-m-d');
            $userid=$this->input->post('uid');
            $category=$this->input->post("cat");
            $price=$this->input->post("price");
            $details=$this->input->post("pdetails");
            
            $data=array('table'=>'buyer_requirement','val'=>array('cat_id'=>$category,'price'=>$price,'details'=>$details,'req_date'=>$today),"where"=>array("id"=>$r_id));                
            $result=$this->common->update_data($data);
            
            if($result)
		{
		header('Access-Control-Allow-Origin: *');
		echo json_encode(array('status'=>true,'message'=>'Successfully Updated'));
		}
		else
		{
            echo json_encode(array('status'=>FALSE,'message'=>'fail'));
        }
	}
   
        
       function deletebuyerrequirement(){
       $r_id=$this->input->post('id');
        
        $data=array('table'=>'buyer_requirement','where'=>array('id'=>$r_id));
        $log=$this->common->delete_data($data);
        
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
    }
    
    
    function sellerrequirement(){
       // echo "hi";
        header('Access-Control-Allow-Origin: *');
        $userid=$this->input->post('uid');
        $backdate=date('Y-m-d', strtotime('-30 days'));
        //echo $backdate; exit;
        $data=array("table"=>"user_business_type","where"=>array("user_id"=>$userid),"val"=>array("business_id"),"orderby"=>'',"orderas"=>'',"start"=>'');
        $business_type=$this->common->get_where_all($data);
        $business_type1=array();
        if($business_type['res']){
            foreach($business_type['rows'] as $business){
                array_push($business_type1, $business->business_id);
            }
            //print_r($business_type1);
            
            $comment1=array('val'=>'r.id,r.price,r.details,cat.category,r.user_id as buyer,u.username,u.f_name,u.l_name,u.is_login as selleronline,r.req_date','table'=>'buyer_requirement as r','where'=>array("r.req_date>="=>$backdate),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC',"in"=>"r.cat_id","in_value"=>$business_type1);
            $multijoin1=array(  
                array('table'=>'category as cat','on'=>'r.cat_id=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'r.user_id=u.id','join_type'=>'left')
            );

            $table=$this->common->multijoin_with_in($comment1,$multijoin1);
            //print_r($table); exit;
             if($table['res'])
            {
                echo json_encode(array('status'=>true,'result'=>$table['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
        
      }
    }
    
    function sellerrecipes(){
        //echo 'hi'; exit;
        header('Access-Control-Allow-Origin: *');
        $userid=$this->input->post('uid');  
        //echo $userid; exit;
        $comment1=array('table'=>'user_Info as u','val'=>'u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type,rs.video_link ,rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid, rs.recipe_stetus,rs.admin_status,cat.category','where'=>array("u.status"=>'1',"u.verified"=>'1',"u.id"=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'recipe as rs','on'=>'u.id=rs.user_id','join_type'=>''),
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
        ); 
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        //print_r($table);exit;
         if($table['res'])
            {
                echo json_encode(array('status'=>true,'result'=>$table['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }
    
    	function get_recipe_categories()
	{
		$query="SELECT * from recipe_category where status='1'";
                $result=$this->common->dbQuery($query);
		if($result['res'])
            {
                echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }

	}
        
     
        
      function delete_recipe(){
        $r_id=$this->input->post('id');
        //echo $r_id; exit;
        $data=array('table'=>'recipe','where'=>array('id'=>$r_id));
        $log=$this->common->delete_data($data);
        
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
    }
    
    function uploadrecipepic(){
		//print_r($_FILES);exit;
		$image=$_FILES['file']['name'];
		copy($_FILES['file']['tmp_name'],'assets/image/recipe/'.$image);
		//copy($_FILES['file']['tmp_name'],'assets/image/product/thumb/'.$image);
		$img=getimagesize('assets/image/recipe/'.$image);
		
		if(!empty($img))
		{
			$imgtype= $img['mime'];
	
			    if($imgtype=="image/jpg" || $imgtype=="image/jpeg" )
				{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefromjpeg($uploadedfile);
				}
				else if($imgtype=="image/png")
				{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefrompng($uploadedfile);
				}
				else 
				{
				$src = imagecreatefromgif($uploadedfile);
				}
			
			$width=$img[0];
			$height=$img[1];
	
			$newwidth=190;
			$newheight=140;
			
			$tmp=imagecreatetruecolor($newwidth,$newheight);		
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			$dest = 'assets/image/recipe/thumb/'.$image;
			imagejpeg($tmp,$dest,100);
			//copy($thumbimg,'assets/image/user/thumb/'.$image);
			echo $image; 
		}
		else{
			unlink('assets/image/recipe/'.$image);
			echo 'error';
			}	
        
       
    }
    
    
    function add_recipe()
	{
        //echo "hi"; exit;
        header('Access-Control-Allow-Origin: *');
	$userid=$this->input->post('uid');
        //echo $userid; exit;
        $category=$this->input->post("cat");
        $name=$this->input->post("rname");
        $details=$this->input->post("rdetails");
        $video_link=$this->input->post("vlink");
        $RecipeAddDate = date('Y-m-d'); 
        $RecipeUpdateDate=date('Y-m-d'); 
	$status=$this->input->post("status");
	$prodImage=$this->input->post("rec_img");
	
        if($prodImage==''){$prodImage='recipe.png';}
	            
        $data=array('table'=>'recipe','val'=>array('user_id'=>$userid,'recipe_type'=>$category,'recipe_title'=>$name,'recipe_detail'=>$details,'image_path'=>$prodImage,'video_link'=>$video_link,'recipe_addDate'=>$RecipeAddDate, 'recipe_updateDate'=>$RecipeUpdateDate,'recipe_stetus'=>$status));
            //print_r($data);
        $result=$this->common->add_data($data);
        //print_r($result); exit;
           if($result)
		{
			header('Access-Control-Allow-Origin: *');
			echo json_encode(array('status'=>true,'message'=>'Recipe Add Sucessfully'));
		}
                else{

                    echo json_encode(array('status'=>FALSE));
                }
       
	}
    
        
        function update_recipe()
	{
        //echo "hi"; exit;
        header('Access-Control-Allow-Origin: *');
        $userid=$this->input->post('uid');
	$recpId=$this->input->post('rid');
        //echo $recpId; exit;
        $category=$this->input->post("cat");
        $name=$this->input->post("rname");
        $details=$this->input->post("rdetails");
        $video_link=$this->input->post("vlink");
        $RecipeAddDate = date('Y-m-d'); 
        $RecipeUpdateDate=date('Y-m-d'); 
	$status=$this->input->post("status");
	$prodImage=$this->input->post("rec_img");
        // if($prodImage==''){$prodImage='recipe.png';}
        //echo $prodImage; exit;
//        			if($prodImage!=''){
//                $userdata=array("table"=>"recipe","where"=>array("id"=>$recpId),"val"=> array("image_path"));
//                $user=$this->common->getsinglerow($userdata);
//				$flag=0;
//                if($user['rows']->image_path!=$prodImage ){ 
//				$flag++;
//                $path="assets/image/recipe/".$user['rows']->image_path;
//                if(file_exists($path)){
//                unlink($path);}
//                $path="assets/image/recipe/thumb/".$user['rows']->image_path;
//                if(file_exists($path)){
//                unlink($path);}
//               }
//				   if($flag==0 && $user['rows']->image_path!="recipe.png")
//				   {
//					$path="assets/image/recipe/".$user['rows']->image_path;
//					if(file_exists($path)){
//					unlink($path);}
//					$path="assets/image/recipe/thumb/".$user['rows']->image_path;
//					if(file_exists($path)){
//					unlink($path);}
//				   }
//               }
	
        $data=array('table'=>'recipe', 'where'=>array('id'=>$recpId),'val'=>array('user_id'=>$userid,'recipe_type'=>$category,'recipe_title'=>$name,'recipe_detail'=>$details,'image_path'=>$prodImage,'video_link'=>$video_link,'recipe_addDate'=>$RecipeAddDate, 'recipe_updateDate'=>$RecipeUpdateDate,'recipe_stetus'=>$status));
            //print_r($data);
        $result=$this->common->update_data($data);
       
              if($result)
		{
			header('Access-Control-Allow-Origin: *');
			echo json_encode(array('status'=>true,'message'=>'Updated Sucessfully'));
		}
                else{

                    echo json_encode(array('status'=>FALSE));
                }
        
	}
        
        
        
        
        
    function sellercampaign(){
        //echo 'hi'; exit;
        header('Access-Control-Allow-Origin: *');
        $userid=$this->input->post('uid');  
        //echo $userid; exit;
        $comment1=array('val'=>'cpd.id, cpd.user_id,cpd.show_stetus,cpd.stetus as admin_status, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name,ui.type_Of_User,ui.profile_Pic, ui.address1,ui.username,sum(c_pd.price) as ac_price,sum(ts.commission) as ttlcomm','table'=>'campaign_detail as cpd','where'=>array("cpd.user_id"=>$userid),'minvalue'=>'','group_by'=>'cpd.id','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>''),
            array('table'=>'campaign_payment_detail as c_pd','on'=>'cpd.id=c_pd.campaign_id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=c_pd.trans_id','join_type'=>'left'),
            
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        //print_r($table);exit;
        if($table['res'])
            {
                echo json_encode(array('status'=>true,'result'=>$table['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }
     
	function campaigndetail(){
        
         header('Access-Control-Allow-Origin: *');
         
         $date = date('Y-m-d');
         $user_id=$this->input->post('uid');
         $id=$this->input->post('id');
        //$this->functions->_valid_user();
        if($user_id!=''){$where=array("cpd.id"=>$id);}else{$where=array("cpd.id"=>$id,'show_stetus'=>'1','stetus'=>'1','ui.status'=>'1');}
        $comment1=array('val'=>'cpd.id, cpd.video_link,cpd.user_id, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.profile_Pic, ui.address1,ui.type_Of_User,ui.profile_Pic,ui.username,cpd.show_stetus','table'=>'campaign_detail as cpd','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>'left')            
        );
        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1);  //$this->editmodel->getbyidcampaign($id);
         $data1=array('val'=>'*','table'=>'campaign_payment_detail','where'=>array('campaign_id'=>$id));
        $data['peymentdetail']=$this->common->getdata($data1);
        //print_r($data['campaigns']);
        if($user_id!=''){
            $payemntdata=array("table"=>'campaign_payment_detail',"val"=>array('sum(price) as yourdonation '),'where'=>array('campaign_id'=>$id,'buyerId'=>$user_id));
            $paymentdetails=$this->common->getsinglerow($payemntdata);
            $data['yourdonation']=$paymentdetails['rows']->yourdonation;
        }else{
            $data['yourdonation']=0;
        }
        //print_r($table);exit;
         if($data['campaigns']['res'])
            {
                echo json_encode(array('status'=>true,'campaign'=>$data['campaigns'],'payment'=>$data['peymentdetail'],'donation'=>$data['yourdonation']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }

function campaign_edit(){
        
        $user_id=$this->input->post('uid');
        $id=$this->input->post('id');
         $comment1=array('val'=>'cpd.id,cpd.video_link, cpd.user_id,cpd.show_stetus, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name,ui.type_Of_User,ui.profile_Pic, ui.address1,ui.username','table'=>'campaign_detail as cpd','where'=>array("cpd.user_id"=>$user_id,'cpd.id'=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>''),
            
        );
        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1); 
       
        if($data['campaigns']['res'])
            {
                echo json_encode(array('status'=>true,'campaign'=>$data['campaigns']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }
function uploadcampaignpic(){
		//print_r($_FILES);exit;
		$image=$_FILES['file']['name'];
		copy($_FILES['file']['tmp_name'],'assets/image/campaign/'.$image);
		//copy($_FILES['file']['tmp_name'],'assets/image/product/thumb/'.$image);
		$img=getimagesize('assets/image/recipe/'.$image);
		
		if(!empty($img))
		{
			$imgtype= $img['mime'];
	
			    if($imgtype=="image/jpg" || $imgtype=="image/jpeg" )
				{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefromjpeg($uploadedfile);
				}
				else if($imgtype=="image/png")
				{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefrompng($uploadedfile);
				}
				else 
				{
				$src = imagecreatefromgif($uploadedfile);
				}
			
			$width=$img[0];
			$height=$img[1];
	
			$newwidth=190;
			$newheight=140;
			
			$tmp=imagecreatetruecolor($newwidth,$newheight);		
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			$dest = 'assets/image/campaign/thumb/'.$image;
			imagejpeg($tmp,$dest,100);
			//copy($thumbimg,'assets/image/user/thumb/'.$image);
			echo $image; 
		}
		else{
			unlink('assets/image/campaign/'.$image);
			echo 'error';
			}	  
        }
    function update_campaign()
	{
        //echo "hi"; exit;
        header('Access-Control-Allow-Origin: *');
        $userid=$this->input->post('uid');
	$camId=$this->input->post('cid');
        
        $name=$this->input->post("cname");
        $details=$this->input->post("cdetails");
        $video_link=$this->input->post("vlink");
        $sdate=$this->input->post("sdate");
        $edate=$this->input->post("edate");
        $price=$this->input->post("price");
	$status=$this->input->post("status");
	$prodImage=$this->input->post("rec_img");
        
	
        $data=array('table'=>'campaign_detail', 'where'=>array('id'=>$camId,'user_id'=>$userid),'val'=>array('campaign_titel'=>$name,'campaign_detail'=>$details,'image_path'=>$prodImage,'video_link'=>$video_link,'start_date'=>$sdate,'end_date'=>$edate,'price'=>$price,'show_stetus'=>$status));
            //print_r($data);
        $result=$this->common->update_data($data);
       
              if($result)
		{
			header('Access-Control-Allow-Origin: *');
			echo json_encode(array('status'=>true,'message'=>'Updated Sucessfully'));
		}
                else{

                    echo json_encode(array('status'=>FALSE));
                }
        
	}

	function addnew_campaign()
	{
        //echo "hi"; exit;
        header('Access-Control-Allow-Origin: *');
        $userid=$this->input->post('uid');
	
        $name=$this->input->post("cname");
        $details=$this->input->post("cdetails");
        $video_link=$this->input->post("vlink");
        $sdate=$this->input->post("sdate");
        $edate=$this->input->post("edate");
        $price=$this->input->post("price");
	$status=$this->input->post("status");
	$prodImage=$this->input->post("rec_img");
        
	
        $data=array('table'=>'campaign_detail', 'val'=>array('user_id'=>$userid,'campaign_titel'=>$name,'campaign_detail'=>$details,'image_path'=>$prodImage,'video_link'=>$video_link,'start_date'=>$sdate,'end_date'=>$edate,'price'=>$price,'show_stetus'=>$status));
            //print_r($data);
        $result=$this->common->add_data($data);
       
              if($result)
		{
			header('Access-Control-Allow-Origin: *');
			echo json_encode(array('status'=>true,'message'=>'Updated Sucessfully'));
		}
                else{

                    echo json_encode(array('status'=>FALSE));
                }
        
	}
	function delete_campaign(){
        $id=$this->input->post('id');
        //echo $r_id; exit;
        $galdata=array("table"=>"campaign_detail","where"=>array("id"=>$id),"val"=> array("image_path"));
        $gallery=$this->common->getsinglerow($galdata);
       // print_r($gallery);exit;
        if($gallery['res']){
            if($gallery['rows']->image_path !='detault.png'){
            $path="assets/image/product/".$gallery['rows']->image_path;
            if(file_exists($path)){
            unlink($path);}
            $path="assets/image/product/thumb/".$gallery['rows']->image_path;
           if(file_exists($path)){
            unlink($path);}
            }  
        }
        $data=array('table'=>'campaign_detail','where'=>array('id'=>$id));
        $log=$this->common->delete_data($data);
        
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
    }
	function view_seller(){
        $uid=$this->input->post('uid');
        $username=$this->input->post('sname');
        
         $comment1=array('val'=>'u.address1,s.state,u.id,u.username,u.f_name,u.l_name,u.type_Of_User,u.profile_Pic,si.business_name,si.address,si.zip,GROUP_CONCAT(bt.category SEPARATOR ",") as business_type','table'=>'user_Info as u','where'=>array("u.username"=>$username),'minvalue'=>'','group_by'=>'u.id','start'=>'','orderby'=>'u.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_store_info as si','on'=>'u.id=si.user_id','join_type'=>'left'),
                array('table'=>'user_business_type as ubt','on'=>'u.id=ubt.user_id','join_type'=>'left'),
                array('table'=>'category as bt','on'=>'ubt.business_id=bt.id','join_type'=>'left'),
                array('table'=>'statelist as s','on'=>'u.state=s.id','join_type'=>'left'),
            );

        $featureduser=$this->common->multijoin($comment1,$multijoin1);
        
        $userid=$this->getuserid($username);
        
        $comment2=array('val'=>'r.id,r.stars,r.reviews,r.date,r.revuserid as RevuserId,r.userid as WriteReviewuserId,u.f_name,u.l_name','table'=>'userreviews as r','where'=>array('r.revuserid'=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC');
            $multijoin2=array(
                array('table'=>'user_Info as u','on'=>'r.userid=u.id','join_type'=>''),
            ); 
            
        $reviews=$this->common->multijoin($comment2,$multijoin2);
        if($featureduser['res'])
            {
                echo json_encode(array('status'=>true,'user_detail'=>$featureduser,'reviews'=>$reviews));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
        
    }
    public function getuserid($username){
	$this->load->library('MY_Pagination');
        $data=array("table"=>"user_Info","val"=>"id","where"=>array("username"=>$username));
        $log=$this->common->getsinglerow($data);
        //print_r($log);exit;
        if($log['res']){
            return $log['rows']->id;
        }
    }
	
    public function mail_inbox(){
        $uid=$this->input->post('uid');
        if($this->input->post('currentpage')){
            $pg=$this->input->post('currentpage');
        }else{
            $pg=0;
        }
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,mt.id as inboxid,mt.view as mailview,m.attach,u.f_name,u.l_name','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$uid,"mt.status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail as m','on'=>'mt.mail_from=m.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );
        
        $mails=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] ="user_mails.html";
        $config["total_rows"] = ($mails['res'])?count($mails['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $pg;
        $config['next_link'] = FALSE;
        $config['prev_link'] = FALSE;
        $config['page_query_string'] = FALSE;
        $this->pagination->initialize($config); 
        $page = $pg;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['inboxlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query(); exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        if($mails['res'])
            {
                echo json_encode(array('status'=>true,'mail_detail'=> $log['inboxlist'],'links'=>$log["links"],'datashowcount'=>$log['datashowcount']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }

public function view_mail(){
        $uid=$this->input->post('uid');
        $mailid=$this->input->post('m_id');
        $mailtoid=$this->input->post('inbox_id');
         if($mailtoid > 0){
            $data=array("table"=>"mail_to","where"=>array("id"=>$mailtoid),"val"=>array("view"=>'1'));
            $update=$this->common->update_data($data);
        }
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,u.f_name,u.l_name,u.username','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );
        $log['mailfrom']=$this->common->multijoin($comment1,$multijoin1);
        
        $comment1=array('val'=>'u.f_name,u.l_name,u.username','table'=>'mail_to as mt','where'=>array("mt.mail_from"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'mt.id','orderas'=>'DESC');
        $multijoin1=array(  
            //array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
        );
        $log['mailto']=$this->common->multijoin($comment1,$multijoin1);
        
        $download_data=array('val'=>'*','table'=>'mail_attach','where'=>array('mail_from'=>$mailid));
        $log['downloads']=$this->common->getdata($download_data);
         if( $log['mailfrom']['res'])
            {
                echo json_encode(array('status'=>true,'mail_from'=>  $log['mailfrom'],'mail_to'=>$log['mailto'], 'mail_download'=>$log['downloads']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }
function mail_user(){
        $to = $this->input->post("to");
        $like=array(
          "likeon"=>"u.username",
          "likeval"=>$to
        );
        $data=array("val"=>"u.username,u.id","table"=>"user_Info as u","where"=>"","like"=>$like);
        $log=$this->common->multijoin_with_like($data);
        if( $log['res'])
            {
                echo json_encode(array('status'=>true,'user'=>$log));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }
 public function mail_sendbox(){
        $uid=$this->input->post('uid');
        if($this->input->post('currentpage')){
            $pg=$this->input->post('currentpage');
        }else{
            $pg=0;
        }
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,GROUP_CONCAT(u.f_name SEPARATOR ",") as tofirstname','table'=>'mail as m','where'=>array("m.mail_from"=>$uid,"m.status"=>"1"),'minvalue'=>'','group_by'=>'m.id','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>'LEFT'),
            array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
        );
        
        $mails=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        $config = array();
        $config["base_url"] ="send_mail.html";
        $config["total_rows"] = ($mails['res'])?count($mails['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $pg;
        $config['next_link'] = FALSE;
        $config['prev_link'] = FALSE;
        $config['page_query_string'] = FALSE;
        $this->pagination->initialize($config); 
        $page = $pg;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['inboxlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query(); exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        if($mails['res'])
            {
                echo json_encode(array('status'=>true,'mail_detail'=> $log['inboxlist'],'links'=>$log["links"],'datashowcount'=>$log['datashowcount']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }
function mail_trashbox(){
        $uid=$this->input->post('uid');
        if($this->input->post('currentpage')){
            $pg=$this->input->post('currentpage');
        }else{
            $pg=0;
        }
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,u.f_name,u.l_name','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$uid,"mt.status"=>"2"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail as m','on'=>'mt.mail_from=m.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );
        
        $comment2=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.mail_from"=>$uid,"m.status"=>"2"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>'left'),
        );
        //$log['forumlist']=$this->common->multijoin($comment1,$multijoin1);
         $mailto=$this->common->multijoin($comment1,$multijoin1);
//	 echo $this->db->last_query();
        $mailsend=$this->common->multijoin($comment2,$multijoin2);
        
        //echo $this->db->last_query(); exit;
        $config = array();
        $config["base_url"] ="send_mail.html";
        $countto=($mailto['res'])?count($mailto['rows']):0;
        $countsend=($mailsend['res'])?count($mailsend['rows']):0;
        $config["total_rows"] = $countto+$countsend;
        $config["per_page"] = 20;
        $config["uri_segment"] = $pg;
        $config['next_link'] = FALSE;
        $config['prev_link'] = FALSE;
        $config['page_query_string'] = FALSE;
        $this->pagination->initialize($config); 
        $page = $pg;
         
        $log['trash_mail_to']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $log['trash_mail_send']=$this->common->multijoin($comment2,$multijoin2,$config["per_page"], $page);
        
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        if($mailto['res']> 0 or $mailsend['res']> 0)
            {
                echo json_encode(array('status'=>true,'mail_to'=> $log['trash_mail_to'],'mail_send'=> $log['trash_mail_send'],'links'=>$log["links"],'datashowcount'=>$log['datashowcount']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }
	function mail_attchment(){
    
        $uid=$this->input->post('uid');    
    
        for($i=0;$i<count($_FILES);$i++){
            if($_FILES[$i]['size'] <= 1024000){
            $src=$_FILES[$i]['tmp_name'];
            $filename=$_FILES[$i]['name'];
            $destination = "assets/attach/$uid";
            if(!is_dir($destination))
            {
                $old_umask = umask(0);
                mkdir($destination,0777);
                umask($old_umask);
            }
            $upload=move_uploaded_file($src, $destination.'/'.$filename);
            
            if($upload){
                echo 'uploaded';
            }
            
            }else{
                echo "File Size is Greter than 1 mb";
            }
        }
    
    }
function mail_attachment_delete(){
        $uid=$this->input->post('uid');
        $filename=$this->input->post("filename");
        $log=$this->functions->delete_file("assets/attach/$uid/$filename");
        echo json_encode($log);
    }
    function mail_attachment_deletefolder(){
        $uid=$this->input->post('uid');
        $log=$this->functions->delete_directory("assets/attach/$uid");
        echo json_encode($log);exit;
    }

	public function mailcreate(){
        //print_R($_FILES);
        $user_id=$this->input->post("uid");
        $user_paid=$this->input->post("user_paid");
        $aa=$this->_userlimitation("email",$user_paid,"mail",array("mail_from"=>$user_id, 'MONTH(FROM_UNIXTIME(timestamp))' => date('m'), 'YEAR(FROM_UNIXTIME(timestamp))' => date('Y')),"mail");
        
	if($aa['status']==0){
		 echo json_encode(array('status'=>FALSE,'message'=> $aa['message']));
			exit;
	}
        if($this->input->post("to")){
            
            $to=$this->input->post("to");
            $from=$user_id;
            $subject=$this->input->post("subject");
            $message=$this->input->post("message");
            
            $to=explode(",",$to);
            $error_id=array();
            
            $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
            $inserted_id=$this->common->add_data_get_id($maildata);
            
            if($inserted_id){
                foreach($to as $mailto){
                 $s_user_id=$this->getuserid($mailto);
                 if($user_id!=NULL){$mailtodata[]=array("mail_from"=>$inserted_id,"mail_to"=>$s_user_id);
                } else{
                    array_push($error_id,$mailto);
                }} 
                
                if(!empty($mailtodata)){$log = $this->common->insert_multi_row(array("table"=>"mail_to","val"=>$mailtodata));}
                else{$log=true;}
                $bb=$this->fileattach($inserted_id,$user_id);
               		
                if($log){
                    if(!empty($error_id)){
                        $error_data=implode(',',$error_id);
                         echo json_encode(array('status'=>FALSE,'message'=> $error_data.' User(s) not valid'));
                       
                    }
                    else{
                        echo json_encode(array('status'=>true,'message'=> 'Your mail has been send successfully'));
                    }
                }
            }
            
        }
        
    }
    public function fileattach($inserted_id,$user_id){
         //start file attach
                //echo $inserted_id.' and '.$user_id;
                $dir = "assets/attach/$user_id";
                if(is_dir($dir)){
                    
                $destination = "assets/attach/final/$inserted_id";
                if(!is_dir($destination))
                {
                    mkdir($destination,0777);
                }
                // Open a directory, and read its contents
                if (is_dir($dir)){
                  if ($dh = opendir($dir)){
                    while (($file = readdir($dh)) !== false){
			//print_r($file);
                        if($file!='.' && $file!='..'){
					
                            $attachfiledata[]=array("mail_from"=>$inserted_id,"file_name"=>$file);
                            copy($dir.'/'.$file, $destination.'/'.$file);
				
                            if(file_exists($dir.'/'.$file)){
                                unlink($dir.'/'.$file);
				//return array("status"=>true,"message"=>"success");
                            }
					
                        }
                    }
                   
                    closedir($dh);
                  }
                }
               
                if(isset($attachfiledata)){
                    $log1 = $this->common->insert_multi_row(array("table"=>"mail_attach","val"=>$attachfiledata));
                    $log2 = $this->common->update_data(array("table"=>"mail","val"=>array("attach"=>"1"),"where"=>array("id"=>$inserted_id)));
                    rmdir($dir);
                }
            } 
                //end file attach
    }
	public function _userlimitation($title=null,$userpaidstatus=null,$table=null,$where=array(),$redirectpage){
        
            $data=array("table"=>"user_validation","val"=>"$title as title","where"=>array("user_type"=>"$userpaidstatus"));
            
            $log=$this->common->getsinglerow($data);
            //print_r($this->db->last_query());exit;
            if($log['res']){
                
                $newdata=array("table"=>$table,"where"=>$where);
                $newlog=$this->common->record_count_where($newdata);
                if(!empty($_FILES['file'])){
                    //print_r(count($_FILES['file']['name']));exit;
                    $newlog+=count($_FILES['file']['name'])-1; 
                }
                //echo $newlog;exit;
                if($log['rows']->title > $newlog){
                    return array("status"=>true,"message"=>"");
                }else{
                    $count=$log['rows']->title;
                    if($title==''){ $item='product list'; }else if($title=='product_list'){ $item='product list'; }else{ $item=$title; }
                    return array("status"=>false,"message"=>"As a Free User, you are limited to posting $count $item. ");
                }
                //EXIT;
            }else{
                return array("status"=>true,"message"=>"no any limitation");
            }
            
       
    }
	public function maildownload(){
	$this->load->library('zip');
        $id=$this->input->post("email_id");
        $this->zip->read_dir("assets/attach/final/$id",false);
        return $this->zip->download("harvest.zip");
    }

 public function message_page(){
         $user_id=$this->input->post("uid");
        $user_paid=$this->input->post("user_paid");
        $uri_seg2=$this->input->post("uri_seg2");
        $session_chatwith='';
         $pagedata['currentusername']='';
        if($uri_seg2!=''){
            $data=array("table"=>"user_Info","val"=>"id,f_name,l_name","where"=>array("id"=>$uri_seg2));
            $log=$this->common->getsinglerow($data);
            $this->_checkvalid("message/".$uri_seg2);
            if(!$log['res']){
                redirect("_404","refresh");
            }else{
                //print_r($log);exit;
                $pagedata['currentusername']=$log['rows']->f_name.' '.$log['rows']->l_name;
                $session_chatwith=$uri_seg2;
            }
        }
    //echo $this->session->userdata("chatwith");
        $userid=$user_id;
        
        
        $sql="SELECT DISTINCT msgfrom FROM conservation WHERE msgfor='".$userid."' AND status='0'";
        $query=$this->db->query($sql);
        $senderresult=$query->result_array();
        $alluserid=array();
        foreach($senderresult as $subdata){
            array_push($alluserid,$subdata['msgfrom']);
        }
        
        //print_r($alluserid);
        if(count($alluserid)>0){
        $this->db->select('count(c.id) as noofmsg, b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login',FALSE);
        $this->db->join('conservation c','b.id=c.msgfrom','left');
        $this->db->where('c.msgfor', $userid);
        $this->db->where('c.status','0');
        $this->db->where('b.is_login', "0");
        //$ur=implode(",",$alluserid);
        $this->db->where_in('b.id', $alluserid);
        $this->db->group_by('b.id');
        $this->db->order_by('b.login_time', "DESC");
        $userquery1=$this->db->get('user_Info as b');
        $pagedata['offlineusers']=$userquery1->result();
        }else{
            $pagedata['offlineusers']=array();
        }        

            $this->db->select('b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login,us.business_name,b.type_Of_User,b.username',FALSE);
             $this->db->join('user_store_info us','b.id=us.user_id','left');
            $this->db->where('b.id!=', $userid);
            $this->db->where('b.is_login', "1");
            $this->db->order_by('b.login_time', "DESC");
            //$this->db->from('user_Info as b');
            //$this->db->order_by('is_login', 'ASC');
            $userquery=$this->db->get('user_Info as b');
            $pagedata['users']=$userquery->result();
           //echo "<pre>";
            $array=array();
            $i=0;
            foreach($pagedata['users'] as $users){
                $this->db->select('c.status,c.msgfrom',FALSE);
                $this->db->where('c.msgfrom', $users->id);
                $this->db->order_by('id', 'DESC');
                $this -> db -> limit(1);
                $userquery=$this->db->get('conservation as c');
                $conv= $userquery->result();
                if(count($conv)>0){
                    $pagedata['users'][$i]->status=$conv[0]->status;
                }else{
                    $pagedata['users'][$i]->status=1;
                }
                //(array)$pagedata['users'][$i];
                array_push($array,$pagedata['users'][$i]);
                $i++;
            }


                function cmp($a, $b) {
                        return $a->status - $b->status;
                }
                usort($array, "cmp");
                $pagedata['users']=$array;
                
            $pagedata['activetab']=$this->uri->segment(2);
            
                echo json_encode(array(
                    'status'=>true,
                    'currentusername'=> $pagedata['currentusername'],
                    'session_chatwith'=> $session_chatwith,
                    'offlineusers'=>$pagedata['offlineusers'],
                     'activetab'=>$pagedata['activetab'],
                    'users'=>$pagedata['users']));
            
    }

public function get_online_user()
    {
        $user_id=$this->input->post("uid");    
        $sql="SELECT DISTINCT msgfrom FROM conservation WHERE msgfor='".$user_id."' AND status='0'";
        $query=$this->db->query($sql);
        $senderresult=$query->result_array();
        $alluserid=array();
        foreach($senderresult as $subdata){
            array_push($alluserid,$subdata['msgfrom']);
        }
        if(count($alluserid)>0){
        $this->db->select('count(c.id) as noofmsg,b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login',FALSE);
        $this->db->join('conservation c','b.id=c.msgfrom','left');
        $this->db->where('c.msgfor', $user_id);
        $this->db->where('c.status', '0');
        $this->db->where('b.is_login', "0");
        $this->db->where_in('b.id', $alluserid);
        $this->db->group_by('b.id');
        $this->db->order_by('b.login_time', "DESC");
        $userquery1=$this->db->get('user_Info as b');
        $offlineuser=$userquery1->result();
        }else{
            $offlineuser=array();
        }
        //$this->db->select('b.id as id,b.is_login',FALSE);
        $this->db->select('b.id as id,b.f_name as first_name,b.l_name as last_name,b.profile_Pic,b.is_login',FALSE);
        $this->db->join('conservation c','b.id=c.msgfor','left');
        $this->db->where('b.id!=', $user_id);
        $this->db->where('b.is_login', "1");
        $this->db->order_by('b.login_time', "DESC");
        //$this->db->order_by('ISNULL(c.status)');
        //$this->db->order_by('c.status', 'ASC');
	//$this->db->order_by('c.senddate', 'DESC');
        $this->db->group_by('b.id');
        $userquery=$this->db->get('user_Info as b');
        $online_users=$userquery->result();
        //print_r($online_users);exit;
        $totaluser=count($online_users)+count($offlineuser);
        if($totaluser>0){
            echo json_encode(array("status"=>true,"data"=>array("online_users"=>$online_users,"offline_users"=>$offlineuser)));
        }else{
            echo json_encode(array("status"=>false,"data"=>"User not found"));
        }
    }
    public function get_usermsg_count()
    {
        $user_id=$this->input->post("uid");
        $data=[];
        $cruserid=$this->input->post("crid");
        $userid=$this->_get_conv_user($user_id);
        foreach($userid as $user)
        {
            $getcount='';
            $where=['msgfor'=>$cruserid,'status'=>'0','msgfrom'=>$user_id];
            $this->db->where($where);
            $getcount=$this->db->count_all_results('conservation');
            $data[$user->id]=$getcount;
        }
        
        echo json_encode(['status'=>TRUE,'data'=>$data]);
    }
    private function _get_conv_user($user_id)
    {
        $userid=$user_id;
        $this->db->select('DISTINCT msgfrom as id',FALSE);
        $this->db->where('msgfor', $userid);
        $userquery=$this->db->get('conservation');
        return $userquery->result();
    }
    public function get_currentclicked_message(){
        $userid=$this->input->post("uid");
        $cuid=$this->input->post("crid");
        $this->get_cmessage($userid,$cuid);
    }
    public function get_message()
    { 
            $crtime=date('Y-m-d H:i:s');
            $userid=$this->input->post("uid");
            $cruserid=$this->input->post("crid");
            $data=['status'=>'1'];
            $where=['status'=>'0','msgfor'=>$cruserid,'msgfrom'=>$userid];
            $this->db->where($where);
            $this->db->update('conservation',$data);
            $sql="SELECT a.*,c.f_name as first_name,c.l_name as last_name,c.profile_Pic,c.is_login FROM conservation as a LEFT JOIN user_Info as c ON a.msgfrom=c.id WHERE (a.msgfrom='".$userid."' OR a.msgfor='".$userid."') AND (a.msgfrom='".$cruserid."' OR a.msgfor='".$cruserid."') ORDER BY a.senddate ASC";
            $query=$this->db->query($sql);
            if($query -> num_rows()>0){
            $result=$query->result();
                echo json_encode(['status'=>TRUE,'message'=>$result]);
            }else{
                echo json_encode(['status'=>FALSE,'message'=>'']);
            }
    }
    public function get_cmessage($uid,$cuid)
    { 
            $crtime=date('Y-m-d H:i:s');
            $userid= $uid;
            $cruserid=$cuid;
            $data=['status'=>'1'];
            $where=['status'=>'0','msgfor'=>$cruserid,'msgfrom'=>$userid];
            $this->db->where($where);
            $this->db->update('conservation',$data);
            $sql="SELECT a.*,c.f_name as first_name,c.l_name as last_name,c.profile_Pic,c.is_login FROM conservation as a LEFT JOIN user_Info as c ON a.msgfrom=c.id WHERE (a.msgfrom='".$userid."' OR a.msgfor='".$userid."') AND (a.msgfrom='".$cruserid."' OR a.msgfor='".$cruserid."') ORDER BY a.senddate ASC";
            $query=$this->db->query($sql);
            if($query -> num_rows()>0){
            $result=$query->result();
                echo json_encode(['status'=>TRUE,'message'=>$result]);
            }else{
                echo json_encode(['status'=>FALSE,'message'=>'']);
            }
    }
public function send()
    {
        $userid=$this->input->post("uid");
            $cruserid=$this->input->post("crid");
             $user_paid=$this->input->post("user_paid");
        $valid=$this->_usermessagelimitation("message",$user_paid,"conservation",array("msgfrom"=>$userid));
           
            $data=['msgfrom'=>$userid,'msgfor'=>$cruserid,'message'=>$this->input->post('message'),'status'=>'0','senddate'=>date('Y-m-d H:i:s')];
            $this->db->insert('conservation',$data);
            echo json_encode(['status'=>TRUE]);
        
        
    }
public function _usermessagelimitation($title=null,$userpaidstatus=null,$table=null,$where=array()){
        
            $data=array("table"=>"user_validation","val"=>"$title as title","where"=>array("user_type"=>"$userpaidstatus"));
            
            $log=$this->common->getsinglerow($data);
            //print_r($log);exit;
            //print_r($this->db->last_query());exit;
            if($log['res']){
                
                $newdata=array("table"=>$table,"where"=>$where);
                $newlog=$this->common->record_count_where($newdata);
                //echo $log['rows']->title,$newlog;exit;
                if($log['rows']->title > $newlog){
                    return array("status"=>true,"message"=>"");
                }else{
                    $count=$log['rows']->title;
                    //$message="you have only $count $title limitation for more $title you need to <a href='".BASE_URL."paiduser'> click here</a> for purchase Theame";
                    $message="As a Free User, you are limited to send $count $title. To send more and access additional functionality, please <a href='".BASE_URL."paiduser'> click here</a> to purchase a Premium package.";
                    echo json_encode(['status'=>FALSE,'message'=>$message]);
                    exit;
                    //redirect($redirectpage,"refresh");
                }
                //EXIT;
            }else{
                return array("status"=>true,"message"=>"no any limitation");
            }
            
       
    }
 public function searchbyusername(){
        $search=$this->input->post("search");$search = trim($search);
        $query="select id from user_Info where (f_name Like '%".$search."%' OR l_name Like '%".$search."%' OR  CONCAT(f_name,' ',l_name) Like '%".$search."%' OR  CONCAT(f_name,'',l_name) Like '%".$search."%' OR username Like '%".$search."%') AND store_info='1'";
        $result=$this->db->query($query); $users=array(); $rows=$result->result();
        //echo $this->db->last_query();exit;
        foreach($rows as $user){ array_push($users, $user->id);} $searcheduser=array_unique($users);
        if(!empty($searcheduser)){
            $this->db->select(array("id","f_name","l_name","profile_Pic"));
            $this->db->from("user_Info");
            $this->db->where_in("id",$searcheduser);
            $query=$this->db->get();  
            if($query -> num_rows() > 0){ echo json_encode(array("status"=>true,"data"=>$query->result()));}
            else{ echo json_encode(array("status"=>false,"data"=>"User not found")); }
        }else{
            echo json_encode(array("status"=>false,"data"=>"User not found"));
        }
    }
 public function mail_reply($mailid){
 header('Access-Control-Allow-Origin: *');
	 $mailid=$this->input->post('m_id');

        // $mid=$this
         $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.username as reply_to,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
      $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
            );
          
        
        $mails['inboxlist']=$this->common->multijoin($comment1,$multijoin1);
      
        if($mails['inboxlist']['res'])
            {
                echo json_encode(array('status'=>true,'data'=>$mails["inboxlist"]));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
	}
	public function mailreply(){
		 header('Access-Control-Allow-Origin: *');

        //print_R($_FILES);
        $user_id=$this->input->post("uid");
        $user_paid=$this->input->post("user_paid");
        $aa=$this->_userlimitation("email",$user_paid,"mail",array("mail_from"=>$user_id, 'MONTH(FROM_UNIXTIME(timestamp))' => date('m'), 'YEAR(FROM_UNIXTIME(timestamp))' => date('Y')),"mail");
       
        if($this->input->post("to")){
            
            $to=$this->input->post("to");
            $from=$user_id;
            $subject=$this->input->post("subject");
            $message=$this->input->post("message");
            
            $to=explode(",",$to);
            $error_id=array();
            
            $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
            $inserted_id=$this->common->add_data_get_id($maildata);
            
            if($inserted_id){
                foreach($to as $mailto){
                 $s_user_id=$this->getuserid($mailto);
                 if($user_id!=NULL){$mailtodata[]=array("mail_from"=>$inserted_id,"mail_to"=>$s_user_id);
                } else{
                    array_push($error_id,$mailto);
                }} 
                
                if(!empty($mailtodata)){$log = $this->common->insert_multi_row(array("table"=>"mail_to","val"=>$mailtodata));}
                else{$log=true;}
                $this->fileattach($inserted_id,$user_id);
               
                if($log){
                    if(!empty($error_id)){
                        $error_data=implode(',',$error_id);
                         echo json_encode(array('status'=>FALSE,'message'=> $error_data.' User(s) not valid'));
                       
                    }
                    else{
                        echo json_encode(array('status'=>true,'message'=> 'Your mail has been send successfully'));
                    }
                }
            }
            
        }
        
    }
	 public function mailreplyall(){
 header('Access-Control-Allow-Origin: *');
	 $mailid=$this->input->post('m_id');
	 $userid=$this->input->post('uid');

       $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.username as reply_to,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
            );
            $log['reply']=$this->common->multijoin($comment1,$multijoin1);
            
            $comment2=array('val'=>'u.username as reply_to','table'=>'mail_to as mt','where'=>array("mt.mail_from"=>$mailid,"mt.mail_to!="=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'mt.id','orderas'=>'DESC');
            $multijoin2=array(
                array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
            );
            $log['replyall']=$this->common->multijoin($comment2,$multijoin2);
          

        if($log['reply']['res'])
            {
            	
                echo json_encode(array('status'=>true,'reply'=>$log['reply'],'replyall'=>$log['replyall']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
	}

	public function inboxtotrash(){
		 $mail_id=$this->input->post('mail_id');

        $selectedid=$this->input->post("selectedmail");
        
        /*foreach($selectedid as $id){
        $val[]=array("status"=>2,"mail_from"=>$id,"mail_to"=>$this->userid);
        }*/
         $selectedid=explode(",",$selectedid);
          $data=array("table"=>"mail_to","val"=>array("status"=>2),"where"=>array("mail_to"=>$mail_id),"in"=>"mail_from","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();exit();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"Mail move to trash successfully."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

public function inboxtodelete(){
       	 $mail_id=$this->input->post('mail_id');

        $selectedid=$this->input->post("selectedmail");
         $selectedid=explode(",",$selectedid);
        /*foreach($selectedid as $id){
        $val[]=array("status"=>2,"mail_from"=>$id,"mail_to"=>$this->userid);
        }*/
        
        $data=array("table"=>"mail_to","val"=>array("status"=>3),"where"=>array("mail_to"=>$mail_id),"in"=>"mail_from","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"Mail deleted successfully."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

	public function sendtotrash(){
       	 $mail_id=$this->input->post('mail_id');
	//echo $mail_id;exit();
        $selectedid=$this->input->post("selectedmail");
 $selectedid=explode(",",$selectedid);
        
        /*foreach($selectedid as $id){
        $val[]=array("status"=>2,"mail_from"=>$id,"mail_to"=>$this->userid);
        }*/
        
        $data=array("table"=>"mail","val"=>array("status"=>2),"where"=>array("mail_from"=>$mail_id),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
	//echo $this->db->last_query();exit;
	
        if($log){
            echo json_encode(array("status"=>true,"message"=>"Mail move to trash successfully."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

	public function mail_forward(){
 			header('Access-Control-Allow-Origin: *');
	 		$mailid=$this->input->post('m_id');
	 		$userid=$this->input->post('uid');

  			$comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.username as reply_to,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.id"=>$mailid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'m.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
            );
            $log['details']=$this->common->multijoin($comment1,$multijoin1);
         //   echo $this->db->last_query();
            if(is_dir("assets/attach/final/$mailid/")){
                $this->functions->recurse_copy("assets/attach/final/$mailid/","assets/attach/$userid");
            }
            $log["read_dir"]=$this->functions->read_dir("assets/attach/$userid");
            // echo "<pre>";
            // print_r($log);
	      	$download_data=array('val'=>'*','table'=>'mail_attach','where'=>array('mail_from'=>$mailid));
	        $log['downloads']=$this->common->getdata($download_data);


        if($log['details']['res'])
            {
                echo json_encode(array('status'=>true,'data'=>$log["details"],'attach'=>$log["downloads"]));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
}

	public function mail_forward_send(){
        //print_R($_FILES);
        $user_id=$this->input->post("uid");
        $user_paid=$this->input->post("user_paid");
        $aa=$this->_userlimitation("email",$user_paid,"mail",array("mail_from"=>$user_id, 'MONTH(FROM_UNIXTIME(timestamp))' => date('m'), 'YEAR(FROM_UNIXTIME(timestamp))' => date('Y')),"mail");
               if($this->input->post("to")){
            
            $to=$this->input->post("to");
            $from=$user_id;
            $subject=$this->input->post("subject");
            $message=$this->input->post("message");
            
            $to=explode(",",$to);
            $error_id=array();
            
            $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
            $inserted_id=$this->common->add_data_get_id($maildata);
            
            if($inserted_id){
                foreach($to as $mailto){
                 $s_user_id=$this->getuserid($mailto);
                 if($user_id!=NULL){$mailtodata[]=array("mail_from"=>$inserted_id,"mail_to"=>$s_user_id);
                } else{
                    array_push($error_id,$mailto);
                }} 
                
                if(!empty($mailtodata)){$log = $this->common->insert_multi_row(array("table"=>"mail_to","val"=>$mailtodata));}
                else{$log=true;}
                $this->fileattach($inserted_id,$user_id);
               
                if($log){
                    if(!empty($error_id)){
                        $error_data=implode(',',$error_id);
                         echo json_encode(array('status'=>FALSE,'message'=> $error_data.' User(s) not valid'));
                       
                    }
                    else{
                        echo json_encode(array('status'=>true,'message'=> 'Your mail has been send successfully'));
                    }
                }
            }
        }
    }
 
	
 public function search(){
	//print_r($_POST);exit();
        $search=$this->input->post("search");
	//echo $search;exit;
         $uid=$this->input->post("user_id");
        $search = trim($search);
        $query="select id from user_Info where f_name Like '%".$search."%' OR l_name Like '%".$search."%' OR  CONCAT(f_name,' ',l_name) Like '%".$search."%' OR  CONCAT(f_name,'',l_name) Like '%".$search."%'";
        $result=$this->db->query($query);
	//echo $this->db->last_query();exit;
	
        $users=array();
        $rows=$result->result();
        foreach($rows as $user){
            array_push($users, $user->id);
        }
        
        $mailuser=array_unique($users);
	//echo $this->input->post("page");exit;
	 
        if($this->input->post("page")=='inbox'){
            $this->search_inbox($mailuser,$search);
        }else if($this->input->post("page")=='send'){
            $this->search_send($mailuser,$search);
        }else if($this->input->post("page")=='trash'){
            $this->search_trash($mailuser,$search);
        }
    }
    
    
    
             public function search_inbox($users=array(),$user){
		//print_r($_POST);exit;
	    	 $userid=$this->input->post("uid");
		   if($this->input->post('currentpage')){
		    $pg=$this->input->post('currentpage');
		}else{
		    $pg=0;
		}
	        if(count($user)<=0){
	            $log['inboxlist']=array("res"=>false,"rows"=>'');
	            $log["links"]='';
	           echo json_encode(array("res"=>FALSE,"message"=>"Please try again"));
	            exit;
	        }

	        //echo $userid; exit;
	        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,mt.id as inboxid,mt.view as mailview,m.attach,u.f_name,u.l_name','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$userid,"mt.status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','in'=>'m.mail_from',"in_value"=>$users,'orderby'=>'m.id','orderas'=>'DESC');
	        $multijoin1=array(  
	            array('table'=>'mail as m','on'=>'mt.mail_from=m.id','join_type'=>''),
	            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
	        );     
	        $table=$this->common->multijoin_with_in($comment1,$multijoin1);
		 /* $config = array();
		$config["base_url"] ="user_mails.html";
		$config["total_rows"] = ($table['res'])?count($table['rows']):0;
		$config["per_page"] = 20;
		$config["uri_segment"] = $pg;
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['page_query_string'] = FALSE;
		$this->pagination->initialize($config); 
		$page = $pg;
		//echo $this->db->last_query();
		//print_r($table);	
		//exit;
		$log['inboxlist']=$this->common->multijoin_with_in($comment1,$multijoin1,$config["per_page"], $page);
	        $log["links"] = $this->pagination->create_links();
		$log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);*/
		//echo $this->db->last_query();exit;
		//print_r($table);exit;
		if($table['res'])
		    {
		        echo json_encode(array('status'=>true,'result'=> $table));
		    }
		    else{
				
		        echo json_encode(array('status'=>FALSE));
		    }
	    }
     public function search_send($users=array(),$user){
         $userid=$this->input->post("uid");
       if($this->input->post('currentpage')){
		    $pg=$this->input->post('currentpage');
		}else{
		    $pg=0;
		}
        if(count($user)<=0){
            $log['inboxlist']=array("res"=>false,"rows"=>'');
            $log["links"]='';
           echo json_encode(array("res"=>FALSE,"message"=>"Please try again"));
            exit;
        }
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,m.attach,GROUP_CONCAT(u.f_name SEPARATOR ",") as tofirstname','table'=>'mail as m','where'=>array("m.mail_from"=>$userid,"m.status"=>"1"),'minvalue'=>'','group_by'=>'m.id','start'=>'','in'=>'mt.mail_to',"in_value"=>$users,'orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>'LEFT'),
            array('table'=>'user_Info as u','on'=>'mt.mail_to=u.id','join_type'=>''),
        );
          $table=$this->common->multijoin($comment1,$multijoin1);
        
	/*$config = array();
		$config["base_url"] ="send_mail.html";
		$config["total_rows"] = ($table['res'])?count($table['rows']):0;
		$config["per_page"] = 20;
		$config["uri_segment"] = $pg;
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['page_query_string'] = FALSE;
		$this->pagination->initialize($config); 
		$page = $pg;
		//echo $this->db->last_query();
        	$log['sendlist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
	        $log["links"] = $this->pagination->create_links();
		$log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);*/
		//echo $this->db->last_query();exit;
		//print_r($table);exit;
		if($table['res'])
		    {
		        echo json_encode(array('status'=>true,'result'=> $table));
		    }
		    else{
				
		        echo json_encode(array('status'=>FALSE));
		    }
    }
    public function search_trash($users=array(),$user){

         $userid=$this->input->post("uid");
        if(count($users)<=0){
            $log['inboxlist']=array("res"=>false,"rows"=>'');
            $log["links"]='';
            echo json_encode(array("res"=>FALSE,"message"=>"Please try again"));
            exit;
        }
        
        $comment1=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.f_name,u.l_name','table'=>'mail_to as mt','where'=>array("mt.mail_to"=>$userid,"mt.status"=>"2"),'minvalue'=>'','group_by'=>'','start'=>'','in'=>'m.mail_from',"in_value"=>$users,'orderby'=>'m.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'mail as m','on'=>'mt.mail_from=m.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
        );
        
        $comment2=array('val'=>'m.id as mail_id,m.subject,m.message,m.timestamp,u.f_name,u.l_name','table'=>'mail as m','where'=>array("m.mail_from"=>$userid,"m.status"=>"2"),'minvalue'=>'','group_by'=>'m.id','start'=>'','in'=>'m.mail_from',"in_value"=>$users,'orderby'=>'m.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'mail_to as mt','on'=>'m.id=mt.mail_from','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'m.mail_from=u.id','join_type'=>''),
        );
        $table=array("table"=>"mail_to","where"=>array("mail_to"=>$userid,"status"=>"2"));
        $table1=array("table"=>"mail","where"=>array("mail_from"=>$userid,"status"=>"2"));
       
        $log['trash_mail_to']=$this->common->multijoin_with_in($comment1,$multijoin1);
        $log['trash_mail']=$this->common->multijoin_with_in($comment2,$multijoin2);

         if($log['trash_mail_to']['res']> 0 or $log['trash_mail']['res']> 0)
            {
                echo json_encode(array('status'=>true,'mail_to'=> $log['trash_mail_to'],'mail_send'=> $log['trash_mail_send'],'links'=>$log["links"],'datashowcount'=>$log['datashowcount']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
      
    }
//Gallery (Pooja)
public function gallery_seller_view(){
	 	header('Access-Control-Allow-Origin: *');
		$uid=$this->input->post("uid");
		
		 if($this->input->post('currentpage')){
            $pg=$this->input->post('currentpage');
		
        }else{
            $pg=0;
        }
//	echo $pg;exit;
       	$data=array("table"=>'userProd_image',"where"=>array("user_id"=>$uid,"type_ofimage"=>'gallery'),'orderby'=>'id','orderas'=>'DESC');
        //$log['gallery']=$this->common->getdata($data);
          $multijoin1=array();
       	  $view=$this->common->multijoin($data,$multijoin1);
        // $table=array('table'=>'userProd_image',"where"=>array('user_id'=>$this->userid,"type_ofimage"=>'gallery'));
        $config = array();
        $config["base_url"] ="gallery.html";
        $config["total_rows"] = ($view['res'])?count($view['rows']):0;
        
        $config["per_page"] = 5;
        $config["uri_segment"] = $pg;
        $config['next_link'] = FALSE;
        $config['prev_link'] = FALSE;
        $config['page_query_string'] = FALSE;
        $this->pagination->initialize($config); 
         $page = $pg;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['gallery']=$this->common->get_where_with_paginaiton($config["per_page"], $page,$data);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
   	//print_r($resp);exit;
  		if($resp['gallery']['res'])
            {
                echo json_encode(array('status'=>true,'result'=> $resp['gallery'],'links'=>$resp["links"],'datashowcount'=>$resp['datashowcount']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
}

public function files(){
		//echo "hello";exit;
	    	$uid=$this->input->post('uid');    
		 //$this->_media_userlimitation("media",$this->userpaidstatus,"userProd_image",array("user_id"=>$uid,"type_ofimage"=>"gallery"),"gallery");
	//echo "hello";exit;
        for($i=0;$i<count($_FILES);$i++)
        {
            if($_FILES[$i]['size'] <= 1024000)
            {
	            $src=$_FILES[$i]['tmp_name'];
	            $userfile='files';
	            $destination = "assets/image/gallery/$uid";
		    	$allowed='jpg|png|jpeg';
	            $max_size='4096000';     
		//print_r($_FILES[$i]['name']);exit; 
  
            //$upload=move_uploaded_file($src, $destination.'/'.$filename);
		//echo $destination;exit;
            	$upload=$this->functions->_multi_upload_files_thumb($userfile,$destination,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
		
	
			    if($upload['status'])
			    {
						foreach($upload['filename'] as $filename)
						{
						//echo $filename; exit;
						    $dataforinsert[]=array('user_id'=>$uid,'type_ofimage'=>'gallery','image_path'=>$filename,'status'=>'1');
						}
							$data=array('table'=>'userProd_image','where'=>array('id'=>$uid),'val'=>$dataforinsert);                
							$log=$this->common->insert_multi_row($data);
							//echo $this->db->last_query();
								if($log)
								{
									
									echo json_encode(array('status'=>true,'result'=>'Gallery uploaded successfully.'));
								}
								
			    }
				else 
				{
					echo json_encode(array('status'=>true,'result'=>'Try again.'));
				}
			
		  }  
	    else{
		        echo json_encode(array('status'=>false,'result'=>'Please upload image less than 4mb.'));
		  }
	}
}
function gallery_image_delete(){
        $filename=$this->input->post("filename");
	$uid=$this->input->post('uid'); 
        $galdata=array("table"=>"userProd_image","where"=>array("id"=>$filename	),"val"=> array("image_path"));
        $gallery=$this->common->getsinglerow($galdata);
        if($gallery['res']){
            $path="assets/image/gallery/".$uid."/".$gallery['rows']->image_path;
            if(file_exists($path)){
            unlink($path);}
            $path="assets/image/gallery/".$uid."/thumb/".$gallery['rows']->image_path;
           if(file_exists($path)){
            unlink($path);}
        }
        
        $data=array('table'=>'userProd_image','where'=>array('id'=>$filename));
        $log=$this->common->delete_data($data);
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
}

public function gallery_image_update(){
        //print_r($_POST);exit;
		$uid=$this->input->post('uid');
         $id = $this->input->post("galid");
        $userfile='file';
        $image_path='assets/image/gallery/'.$uid.'/';
        $allowed='jpg|png|jpeg';
        $max_size='4096000';

        $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
        //print_r($fileupload);exit;
        
        if($fileupload['status']){
        
            $galdata=array("table"=>"userProd_image","where"=>array("id"=>$id),"val"=> array("image_path"));
            $gallery=$this->common->getsinglerow($galdata);
        
            if($gallery['res']){
            $path="assets/image/gallery/".$this->userid."/".$gallery['rows']->image_path;
            if(file_exists($path)){
            unlink($path);}
            $path="assets/image/gallery/".$this->userid."/thumb/".$gallery['rows']->image_path;
            if(file_exists($path)){
            unlink($path);}
            }
            
        $data=array('table'=>'userProd_image','where'=>array('id'=>$id),'val'=>array('image_path'=>$fileupload['filename']));
        $log=$this->common->update_data($data);
        //print_r($log);exit;
        //exit;
            $this->session->set_flashdata("sucess","Your Gallery image updated successfully.");
            redirect("gallery","refresh");
        }else{
            $this->session->set_flashdata("warning",$fileupload["error"]);
            redirect("gallery","refresh");
        }
}
/*public function viewvideo(){
	//Header always append X-Frame-Options SAMEORIGIN
	header('X-Frame-Options: SAMEORIGIN');
	 header('Access-Control-Allow-Origin: *');
	//header('X-Frame-Options: GOFORIT');
	$uid=$this->input->post('uid');
	$data=array("table"=>'user_videos',"where"=>array("user_id"=>$uid,"type_of_videos"=>'1'),'orderby'=>'id','orderas'=>'DESC');
      

        	$multijoin1=array();
       	  	$view=$this->common->multijoin($data,$multijoin1);
	
        if($view['res'])
            {
		
                echo json_encode(array('status'=>true,'result'=> $view));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
}*/
public function viewvideo(){
	header('Access-Control-Allow-Origin: *');
	$uid=$this->input->post('uid');
		if($this->input->post('currentpage')){
            $pg=$this->input->post('currentpage');
		
        }else{
            $pg=0;
        }
		$data=array("table"=>'user_videos',"where"=>array("user_id"=>$uid,"type_of_videos"=>'1'),'orderby'=>'id','orderas'=>'DESC');

        $multijoin1=array();
       	$view=$this->common->multijoin($data,$multijoin1);
		$config = array();
        $config["base_url"] ="gallery.html";
        $config["total_rows"] = ($view['res'])?count($view['rows']):0;
        
        $config["per_page"] = 5;
        $config["uri_segment"] = $pg;
        $config['next_link'] = FALSE;
        $config['prev_link'] = FALSE;
        $config['page_query_string'] = FALSE;
        $this->pagination->initialize($config); 
         $page = $pg;
		$resp['gallery']=$this->common->get_where_with_paginaiton($config["per_page"], $page,$data);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        if($resp['gallery']['res'])
            {
                echo json_encode(array('status'=>true,'result'=> $resp['gallery'],'links'=>$resp["links"],'datashowcount'=>$resp['datashowcount']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
}

public function addvideos(){

	 header('Access-Control-Allow-Origin: *');
		
	$userid=$this->input->post('uid');    
        $video_link=$this->input->post('video');
            
            
            $data=array('table'=>'user_videos','val'=>array('user_id'=>$userid,'video_path'=>$video_link,'status'=>'1','type_of_videos'=>'1'));                
            $log=$this->common->add_data($data);

            if($data){
               echo json_encode(array('status'=>TRUE ,'result'=>'uploaded'));
            }
		else{
			echo json_encode(array('status'=>FALSE ,'result'=>'try again'));
		}

        
        
    }
public function videodelete(){
        $id = $this->input->post("id");
        $data=array('table'=>'user_videos','where'=>array('id'=>$id));
        $log=$this->common->delete_data($data);
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
    }
 public function video_edit(){
	//print_r($_POST);exit;

        $id=$this->input->post("id");
	//echo $id;exit;
        $galdata=array("table"=>"user_videos","where"=>array("id"=>$id),"val"=> array("video_path","id"));
        $gallery=$this->common->getsinglerow($galdata);
        
        echo json_encode(array('status'=>true,'result'=>$gallery));
        
    }
public function video_update(){
      
        
           $id=$this->input->post("id");
            $video_link=$this->input->post("link");
            $data=array('table'=>'user_videos','where'=>array('id'=>$id),'val'=>array('video_path'=>$video_link));
            $log=$this->common->update_data($data);
            if($log){
                echo json_encode(array('status'=>true,'message'=>'Video update successfully.'));
            } 
	        else{
	            echo json_encode(array('status'=>false,'message'=>validation_errors()));
	        }
        
    }

// Niraj
	
	function supportList(){
        //echo 'hi'; exit;
        header('Access-Control-Allow-Origin: *');
		
        $date = date('Y-m-d'); 
        $comment1=array('val'=>'cpd.id,cpd.video_link, cpd.user_id, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.username,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.type_Of_User,ui.profile_Pic, ui.address1,ui.username','table'=>'campaign_detail as cpd','where'=>array("cpd.stetus"=>'1',"cpd.show_stetus"=>'1',  "cpd.end_date>=" => $date,'ui.status'=>'1'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');//"cpd.start_date<=" => $date , 
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>'')
            );
			
        $table=$this->common->multijoin($comment1,$multijoin1);
        //print_r($table);exit;
        if($table['res'])
            {
                echo json_encode(array('status'=>true,'result'=>$table['rows']));
            }
            else{
				
                echo json_encode(array('status'=>FALSE));
            }
    }
 function buyer_orders_search(){
  header('Access-Control-Allow-Origin: *');
  $userid=$this->input->post('uid');
  $transId=$this->input->post('transId');
        $comment1=array('val'=>'t.trans_id,t.price,t.date,u.f_name,u.l_name,u.id as buyerId','table'=>'transaction as t','like'=>array('likeon'=>'t.trans_id','likeval'=>$transId),'where'=>array('o.buyerId'=>$userid,'t.payment_for'=>'product'),'minvalue'=>'','group_by'=>'o.trans_id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'order_detail_form as o','on'=>'o.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'o.product_id=p.id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>'left'),
        );
  $result=$this->common->multijoin_with_like($comment1,$multijoin1);
  //echo $this->db->last_query();
  if($result['res'])
            {
     echo json_encode(array('status'=>true,'result'=>$result['rows']));
            }else{
				 echo json_encode(array('status'=>false));
			}
    }
	
	
	function autosearch_user(){
		header('Access-Control-Allow-Origin: *');
		$autosearch=$this->input->post('autosearch');
		$like=array(
			array("likeon"=>"f_name","likeval"=>$autosearch),
			array("likeon"=>"l_name","likeval"=>$autosearch),
			array("likeon"=>"CONCAT(f_name,' ',l_name)","likeval"=>$autosearch),
			array("likeon"=>"CONCAT(f_name,'',l_name)","likeval"=>$autosearch),
		);
		$data['user']=array("table"=>"user_Info","val"=>"id,f_name,l_name,profile_Pic,username","where"=>array("type_Of_User"=>"1","store_info"=>"1","status"=>"1"),"like"=>$like,"in"=>array("id"),"in_value"=>array($users),'orderby'=>'paid','orderas'=>'DESC');
		
		$log=$this->common->getdatalikeor($data['user']);
		echo json_encode($log);
		//echo $log;
    }
	
	function autosearch_business(){
		header('Access-Control-Allow-Origin: *');
		$autosearch=$this->input->post('autosearch');
		 $like2=array(
                array("likeon"=>"c.category","likeval"=>$autosearch),    
            );
            $data['category']=array("table"=>"category c","val"=>"ubt.user_id","where"=>array("c.status"=>"Active"),"like"=>$like2,'orderby'=>'c.id','orderas'=>'DESC');
            
            $multijoin3=array(
                array('table'=>'user_business_type as ubt','on'=>'ubt.business_id=c.id','join_type'=>''),
            );
            
            $alluserid=$this->common->getdatalikeor($data['category'],$multijoin3);
            $users=array();
            if($alluserid['res']){
                foreach($alluserid['rows'] as $user){ array_push($users, $user->user_id);}
            }
		$like4=array(
                array("likeon"=>"business_name","likeval"=>$autosearch),
            );
            $data['buss_name']=array("table"=>"user_store_info as uifo","val"=>"uifo.id,uifo.business_name,u.id,u.username","where"=>array(),"like"=>$like4,"in"=>array("u.id"),"in_value"=>array($users),'orderby'=>'uifo.id','orderas'=>'DESC');
            $multijoin3=array(
                array('table'=>'user_Info as u','on'=>'uifo.user_id=u.id','join_type'=>''),
             );  
           
            $log=$this->common->getdatalikeor($data['buss_name'],$multijoin3);
			
			//echo $this->db->last_query();exit;
		echo json_encode($log);
		//echo $log;
    }
	
	
	
	public function card_payment_insert_campaign($data)
    {
            $date=date('Y-m-d');
            if($data['uid']!=''){
                $orderid=$data['uid'];
            }
            else{
                $orderid='';
            }
            $data_transaction=array('table'=>'transaction','val'=>array(
               'trans_id'=>$data['tokan'],
               //'order_id'=>$this->session->userdata("campaignid"),
               'order_id'=>$orderid,     
               'price'=>$data['amount'],
               'date'=>$date,
               'payment_for'=>"campeign",
                'name'=>$data['name'], 
                'email'=>$data['email'], 
                'street'=>$data['street'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zipCode'=>$data['zipCode'], 
                'Payment_type'=>$data['Payment_type'], 
                'payment_with'=>$data['payment_with'],
               'status'=>'success'));
            $data2=array('table'=>'campaign_payment_detail','val'=>array(
               'trans_id'=>$data['tokan'],
               'campaign_id'=>$data['campaignId'],
               'buyerId'=>$data['uid']!=""?$data['uid']:'000',
               'seller_id'=>$data['sellerid'],
               'price'=>$data['amount'],
               'name'=>$data['name'],
               'status'=>'1',
               'date'=>$date));
			   
			   //echo json_encode(array('status'=>true,'data'=>$data_transaction));
			   
           $result=$this->common->add_data($data_transaction);
		   //echo $this->db->last_query();exit;
		   //echo json_encode(array('status'=>true,'data'=>$data_transaction));exit;
           $result2=$this->common->add_data($data2);
           //$this->session->set_userdata("shareproduct",array("trans_detail"=>$data_transaction['val'],"data"=>$data2['val']));
           //$ex_comm=0;
           //$ex_comm=$data['amount'];
           //print_r($result); 
           //print_r($result2); exit;
		   
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
                'trans_id'=>$data['tokan'],
                'seller_id'=>$data['sellerid'],
                'tax'=>'0',
                'total'=>$data['amount'],
                'commission'=>$data['amount']-$ex_total, // (($data['amount']*admincomm)/100)
                'status'=>'0',
                'pt'=>'A',
                'tansdatetime'=>$data['datetime']); 
            $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
            $insert=$this->common->add_data($data111);
           //echo "<pre>";
           //print_r($insert); exit;
           if($result && $result2)
           {
				return true;
           }
           else{

           }
    }
	

	
}


