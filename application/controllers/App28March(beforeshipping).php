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
	
    function viewcart(){
		 header('Access-Control-Allow-Origin: *');
		 $user_id=$this->input->post('uid');
		 //$query="SELECT * from temp_cart where user_id='".$user_id."' order by added_date DESC";
		 $query="SELECT cart.*,CONCAT_WS(' ',ui.f_name,ui.l_name) as seller from temp_cart as cart join user_Info as ui where cart.user_id='".$user_id."' and ui.id=cart.seller_id order by added_date DESC";
         $result=$this->common->dbQuery($query);

		//print_r($result);exit;
		 if($result['res'])
         {
		 
		 //For tax Calculations Start
		 $finaldata1=$this->tax_calcualtion($user_id);
		 //For Tax Calculation End
          
			  echo json_encode(array('status'=>true,'result'=>$result['rows'],'tax'=>$finaldata1));
            }
            else{	
                echo json_encode(array('status'=>FALSE));
            }
        
    }
	
	//TAX Calculation Function
	
	function tax_calcualtion($user_id)
	{
		 $query="SELECT cart.*,CONCAT_WS(' ',ui.f_name,ui.l_name) as seller from temp_cart as cart join user_Info as ui where cart.user_id='".$user_id."' and ui.id=cart.seller_id order by added_date DESC";
         $result=$this->common->dbQuery($query);
		 
		 $allproduct=array(); foreach($result['rows'] as $item){ array_push($allproduct, $item->prod_id); }
		 $this->db->select('state');$buyerstate=$this->db->get_where('user_Info',array('id'=>$user_id))->row();
         $this->db->select('user_id');
		 $this->db->where_in('id',$allproduct);
		 $this->db->group_by('user_id');
		 $users=$this->db->get('product')->result();
 
		 foreach($result['rows'] as $item){
            $hassellertax=$this->db->get_where('user_tax',array('user_id'=>$item->seller_id))->row();
            $this->db->select('usi.merchant_id,u.f_name,u.l_name,(p.prod_price*'.$item->qty.') as prod_total,p.user_id,if(u.state='.$buyerstate->state.',IFNULL(dt.total,"0"),"0") as tax,if(u.state='.$buyerstate->state.',dt.details,"Tax not charged") as desc,(((p.prod_price*'.$item->qty.')*(if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0")))/100) as sub_total_tax,((p.prod_price*'.$item->qty.')+((((p.prod_price*'.$item->qty.')*(if(u.state ='.$buyerstate->state.',IFNULL(dt.total,"0"),"0")))/100))) as sub_total');
            $this->db->join('user_Info u','p.user_id=u.id','left');
            $this->db->join('user_store_info usi','u.id=usi.user_id','left');
            
            if($hassellertax) $this->db->join('user_tax dt','u.id=dt.user_id','left'); else $this->db->join('default_tax dt','u.state=dt.state_id','left');
            $this->db->where('p.id',$item->prod_id);
            $this->db->group_by('p.id');
            $results[]=$this->db->get('product p')->row();
            
        }
        
        foreach($users as $user){ 
            $finaldata=array();
            $finaldata['prod_total']=0;$finaldata['sub_total_tax']=0;$finaldata['sub_total']=0;
            foreach($results as $result11){
                if($user->user_id==$result11->user_id){
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
            $finaldata1[]=(object)$finaldata;
        }
		return $finaldata1;
	}

	//TAX Calculation Function END
	
	
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
		
        
		if( $this->authorize_net->authorizeAndCapture() )
		{  
                        $paymentdata['amount']=$this->input->post('amount');
                        $paymentdata['tokan']=$this->authorize_net->getTransactionId();
                        $paymentdata['paystatus']='success';
						
						if($payfor=='product'){
							$paym=$this->card_payment_insert_product($paymentdata);
							}
						else if($payfor=='bid'){
							$paymentdata['auctionid']=$this->input->post('auc_id');
							$paymentdata['sellerid']=$this->input->post('seller_id');
                            $paym=$this->card_payment_insert_bidproduct($paymentdata,'A');
						}
						
						else if($payfor=='user'){
							$paym=$this->card_payment_insert_user($paymentdata);
						}
						
						if($paym){
						header('Access-Control-Allow-Origin: *');
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
		
            if($payfor=='product')
			{
				$full=false;$partial=false;$errormessage='';$successproduct11=array();
				//echo $paymentdata['uid'];
				$finaldata1=$this->tax_calcualtion($paymentdata['uid']);
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
				$seller=$this->input->post('seller_id');
                $merchant_id=$this->get_user_store(array('merchant_id'),array('user_id'=>$seller));
                $paymentdata1=array('amount'=>$paidamt,
                                       'merchantAccountId'=>$merchant_id['rows']->merchant_id,
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
		   
            
            
        $result=$this->common->add_data($data_transaction);
		
		// price details with tax sellerwise
		$finaldata1=$this->tax_calcualtion($data['uid']);
         foreach($finaldata1 as $productdetails){
            $admincommission =  (($productdetails->prod_total*$admincomm->commission)/100); 
            $transaction_seller[]=array(
               'trans_id'=>$data['tokan'],
               'seller_id'=>$productdetails->user_id,
               'tax'=>$productdetails->tax,
               'total'=>$productdetails->prod_total,
               'commission'=>$admincommission,
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
            
            $orderdata=array('table'=>'order_detail_form','val'=>array(                       
                  'status'=>'1',
                  'buyerId'=>$data['uid']!=""?$data['uid']:'000',
                  'product_id'=>$items['rows'][0]->prod_id,// current bid product id
                  'price'=>$data['amount'],//this is bid amount
                  'quantity'=>'1',
                  'trans_id'=>$data['tokan'],
                  'date'=>$date));
          $result2=$this->common->add_data($orderdata);
          $result=$this->common->add_data($data_transaction);
		  
		  
		  $transaction_seller=array(
                'trans_id'=>$data['tokan'],
                'seller_id'=>$data['sellerid'],
                'tax'=>'0',
                'total'=>$data['amount'],
                'commission'=>$data['commission'], // (($data['amount']*admincomm)/100)
                'status'=>'0',
                'pt'=>$pt,
                'tansdatetime'=>$data['datetime']); 
           $data111=array('table'=>'transaction_sellers','val'=>$transaction_seller);
           $insert=$this->common->add_data($data111);
		  

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
           if($result && $result2 && $result3)
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
            
            
             $finaldata1=$this->tax_calcualtion($data['uid']);
              foreach($finaldata1 as $productdetails){
                 if($productdetails->user_id==$data['sellerid']){
                    $transaction_seller=array(
                       'trans_id'=>$data['tokan'],
                       'seller_id'=>$productdetails->user_id,
                       'tax'=>$productdetails->tax,
                       'total'=>$productdetails->prod_total,
                       'commission'=>$data['commmission'], // (($productdetails->prod_total*admincomm)/100)
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
	
	
   
}


