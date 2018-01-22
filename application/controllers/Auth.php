<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }
   
    
    /*function _login($username,$password)
    {
            $query="SELECT * FROM user_Info where '".$username."' IN (username,email_id) AND password='".$password."' AND status='1' AND verified='1'";
            $result=$this->db->query($query);
            $log=array('res'=>true,'rows'=>$result->row_object());
            if($log['res'])
            {
               //print_r($log);exit;
                //echo "hello,you are loged in";exit;
               $this->session->set_userdata('user_id', $log['rows']->id);
               $this->session->set_userdata('user_name', $log['rows']->username);
               $this->session->set_userdata('user_type', $log['rows']->type_Of_User);
               $this->session->set_userdata('store_info', $log['rows']->store_info);
               //$this->session->set_userdata('user_image', $log['userdata'][0]->image);
               return true;
            }
            else{
                return false;
            }
    }*/
    
    function _login($username,$password)
    {
            $username=htmlentities($username, ENT_QUOTES);
			$password=htmlentities($password, ENT_QUOTES);
		  
            $query="SELECT * FROM user_Info where '".$username."' IN (username,email_id) AND password='".$password."'";
            $result=$this->db->query($query);
            //echo $result->num_rows();exit;
            if($result->num_rows()>0){
                $log=array('res'=>true,'rows'=>$result->row_object());
            }else{
                
                $log=array('res'=>false);
                //echo "hh";
            }
            //print_r($log);exit;
            if($log['res'])
            {
               //print_r($log);exit;
                //echo $log['rows']->verified;exit;
                if($log['rows']->verified){
                if($log['rows']->status){
                
                    
                    $this->session->set_userdata('user_id', $log['rows']->id);
                    $this->session->set_userdata('user_name', $log['rows']->username);
                    $this->session->set_userdata('user_type', $log['rows']->type_Of_User);
                    $this->session->set_userdata('store_info', $log['rows']->store_info);
                    $this->session->set_userdata('user_image', $log['rows']->profile_Pic);
                    $this->session->set_userdata('user_paid', $log['rows']->paid);

                    $this->db->where(array('id'=>$this->session->userdata('user_id')));
                    $this->db->update('user_Info', array("is_login"=>'1',"login_time"=>time()));
                    
                    if(($this->session->userdata('user_type')==1) && (count($this->cart->contents())>0)){
                       
                            foreach ($this->cart->contents() as $items){
                                $this->cart->remove($items['rowid']);
                            }
                            $this->session->unset_userdata('afterloginpage');
                            $this->session->set_userdata('cartdestroy1','1');
                        //exit;
                    }
                    
                    return true;
                }else{
                    $this->session->set_flashdata("warning","Currently your account is not activated/blocked by admin");
                    redirect("auth/login/","refresh");
                }
                }else{
                    
                    $this->session->set_userdata("verificatioEmail",$log['rows']->email_id);
                    redirect("auth/verify/","refresh");
                }
            }
            else{
                //echo "ddd";exit;
                return false;
            }
    }
    
    function _is_logined()
    {
        if($this->session->userdata('user_id'))
        {
            //echo "you are already logedin";exit;
            redirect('profile/','refresh');
        }
    }
    
    public function login()
    {
        
    $this->_is_logined();
		
    $this->form_validation->set_rules('username', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run())
        {  
            if($this->_login($this->input->post('username'),md5($this->input->post('password'))))
            {  
                if($this->session->userdata('afterloginpage')!=''){
                    $loginurl = explode("/", $this->session->userdata('afterloginpage'));
                    if($loginurl[1]=='yourbid' && $this->session->userdata('user_type')=="1"){
                        $this->session->unset_userdata('afterloginpage');
                        $this->session->set_flashdata("warning","As a seller, you can't bid on a product from this site.");
                        redirect('profile/', 'refresh');
                        exit;
                    }else{ 
                    redirect($this->session->userdata('afterloginpage'), 'refresh');
                    exit;
                    }
                }else{
                    if($this->session->has_userdata('cartdestroy1')){
                        //$this->session->set_flashdata("warning","As a seller, you can't buy a product from this site. So your cart has been removed.");
                        $this->session->set_flashdata("warning","Sorry, as a user with a seller profile, you are not able to use this account to purchase items.  Please create a buyer account to do so.  We apologize for this inconvenience, but we hope doing so will improve your experience specifically as a seller and a buyer.");
                        $this->session->unset_userdata('cartdestroy1');
                    }

                    redirect('profile/', 'refresh');
                    exit;
                }
            }else{
                $this->session->set_flashdata('warning','Invalid username/password.');
                redirect('auth/login/','refresh');
            }
        }else{
                
                $this->load->view('include/header');
                $this->load->view('auth/vw_login');
                $this->load->view('include/footer');
        } 
    }
    
    
    public function signup(){
        
            $this->form_validation->set_rules('fname','First Name','trim|required');
            $this->form_validation->set_rules('lname','Last Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required|is_unique[user_Info.email_id]|valid_email');
            $this->form_validation->set_rules('username','Username','trim|required|is_unique[user_Info.username]');
            $this->form_validation->set_rules('password','Password','trim|required|matches[cpassword]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required');
            $this->form_validation->set_rules('mobile','Mobile','trim|required');
            $this->form_validation->set_rules('city','City','trim|required');
            $this->form_validation->set_rules('state','State','trim|required');
            $this->form_validation->set_rules('zip','Zip Code','trim|required');
            //$this->form_validation->set_rules('terms','Terms & conditions','trim|required');
            
            if($this->form_validation->run()){
                
                $fname=$this->input->post("fname");
                $lname=$this->input->post("lname");
                $email=$this->input->post("email");
                $username=$this->input->post("username");
                $password=$this->input->post("password");
                $cpassword=$this->input->post("cpassword");
                $verify=rand(1,10000);
                $typeofuser=$this->input->post("usertype");
                
		$mobile= $this->input->post('mobile');
                $address= $this->input->post('address');
                $city= $this->input->post('city');
                $state= $this->input->post('state');
                $zip= $this->input->post('zip');
                /*$data1=array('table'=>'user_Info','where'=>array());
                $noofrows=$this->common->record_count_where($data1)+1;*/
                
                if($typeofuser==2){
                    $store_info=1;
                    $paiduser=1;
                }else{
                    $store_info=0;
                    $paiduser=0;
                }
                //echo $typeofuser.' & '.$store_info."<br/><br/>";
                $data=array('table'=>'user_Info','val'=>array('f_name'=>$fname,'l_name'=>$lname,'email_id'=>$email,'mobile_no'=>$mobile,'address1'=>$address,'city'=>$city,'state'=>$state,'zip'=>"$zip",'username'=>$username,'password'=> md5($password),'pass2'=>$password,'verify'=>$verify,'type_Of_User'=>$typeofuser,'store_info'=>"$store_info",'paid'=>"$paiduser"));                
               //print_r($data);
                $log=$this->common->add_data($data);
    //echo "<br/>".$typeofuser.' & '.$store_info;exit;
                if($log){
                     //$message="Please <a href='".SITE_URL."welcome/confirmation'>click here </a> for your Account Confirmation";
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
                    //$sendmail=TRUE;
                    
                    if($sendmail){
                        //$this->session->set_flashdata("sucess","Successfully Registration Complete");
                        $this->session->set_userdata("verificatioEmail",$email);
                        redirect('auth/verify','refresh');
                    }else{
                        //$this->session->set_flashdata("warning","Email Error!");
                        $this->session->set_userdata("verificatioEmail",$email);
                        redirect('auth/verify','refresh');
                    }
                }
                
            }else{
                $getstate['states']=$this->get_states();
                $this->load->view('include/header');
                $this->load->view('auth/vw_signup',$getstate);
                $this->load->view('include/footer');
            }
        }
        
        public function verify(){
            $this->form_validation->set_rules('code','Verification Code','trim|required');
            if($this->form_validation->run()){
                
                $code=$this->input->post("code");
                $email=$this->input->post("email");
                //$admin_status=$this->_admin_approval_status();
                $admin_status=$this->getadminsettings();
                $data=array('table'=>'user_Info','val'=>'id','where'=>array('email_id'=>$email,'verify'=>$code));
                $log=$this->common->get_verify($data);
                //print_r($log);exit;
                if($log['res']){
                    
                    $updatedata=array('table'=>'user_Info','where'=>array('email_id'=>$email),'val'=>array('verified'=>'1','status'=>$admin_status->user_status));
                    $dataupdated=$this->common->update_data($updatedata);
                    
                    if($dataupdated){    
                        /*$this->session->unset_userdata("verificatioEmail");
                        $this->session->set_flashdata("sucess","Congratulations! Now you are Varified User for Harvest Link");
                        redirect("auth/login","refresh");*/
                        $this->db->select("pass2,username,password");
                        $userdata=$this->db->get_where("user_Info",array("email_id"=>$email))->row();
                        $password=$userdata->password;
                        $login=$this->_login($email, $password);
                        if($login){   
                            if($this->session->userdata('user_type')==1){
                                $this->add_defaultproduct($this->session->userdata('user_id'));
                            }
                            //echo $this->session->userdata('user_id');exit;
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
                     
                            if($sendmail){ redirect('profile/', 'refresh'); }
                        }
                    }
                }else{
                    $this->session->set_flashdata("warning","Invalid verification code.");
                    redirect("auth/verify","refresh");
                }
            }else{
                $email=$this->session->userdata("verificatioEmail");
                $data['message']="Please check your e-mail inbox for verification code.";
                $data['email']=$email;
                $this->load->view('include/header');
                $this->load->view('auth/vw_verify',$data);
                $this->load->view('include/footer');
            }
        }
        
        
        public function regeneratecode(){
            $email=$this->session->userdata("verificatioEmail");
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
            //$message='';
                    
                     $email1=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Your Verification Code','message'=>$message);
                     $sendmail=$this->functions->_email($email1);
            
            if($sendmail){
                $this->session->set_flashdata("sucess","Please check your email ($email) for verification code.");
                redirect("auth/verify/","refresh");
            }
        }
        
        public function forgotpassword(){
            $this->form_validation->set_rules('email','Email','trim|required');
            if($this->form_validation->run()){
                $email=$this->input->post("email");
                $data=array("table"=>"user_Info","where"=>array("email_id"=>$email),"val"=>array("id","username"));
                $record=$this->common->getsinglerow($data);
                //print_R($record);exit;
                if($record['res']){
                    // Mail Here..
                    //$link=BASE_URL."auth/resetpassword/".$record['rows']->id;
			$link="www.ucodice.com/harvest/auth/resetpassword/".$record['rows']->id;
			$message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                                <td style="padding-left:10px;"><h3>Forgot password link </h3><br/>
                                Hi '.$record['rows']->username.', <br/>
                                    &nbsp;&nbsp;&nbsp;Copy below link and paste in new tab for change your password.<br/><br/>'.$link.'
					
                            </td>
                            </tr>
                            </table>';
                    //echo $email;exit;
                     $email1=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Forgot password','message'=>$message);
                     $sendmail=$this->functions->_email($email1);
                        
                        // To send HTML mail, the Content-type header must be set
//                        $headers  = 'MIME-Version: 1.0' . "\r\n";
//                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//
//                        $headers .= 'To: '.$email. "\r\n";
//                        $headers .= 'From: Harvestlink <test@ucodice.com>' . "\r\n";
//
//                        $sendmail=mail($email, "Forgot Password", $message, $headers);
                    if($sendmail){
                        $this->session->set_flashdata("sucess","Please check your inbox for reset password.");
                        redirect("auth/forgotpassword","refresh");
                    }else{
				$this->session->set_flashdata("warning","Email Error!");
                                redirect("auth/forgotpassword","refresh");
			}
                }else{
                    $this->session->set_flashdata("warning","This email does not exist in harvest account, please sign up.");
                    redirect("auth/forgotpassword","refresh");
                }
            }else{
                $this->load->view('include/header');
                $this->load->view('auth/vw_forgot');
                $this->load->view('include/footer');
            }
        }
        
        
//        public function forgotpassword(){
//            $this->form_validation->set_rules('email','Email','trim|required');
//            if($this->form_validation->run()){
//            $email=$this->input->post("email");
//            $data=array("table"=>"user_Info","where"=>array("email_id"=>$email),"val"=>array("id","username"));
//            $record=$this->common->getsinglerow($data);
//            $link=BASE_URL."auth/resetpassword/".$record['rows']->id;
//            //echo $link;exit;
//                $message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
//                    <tr>
//                        <td style="padding-left:10px;"><h3>Forgot password link </h3><br/>
//                        Hi '.$record['rows']->username.', <br/>
//                            &nbsp;&nbsp;&nbsp;<a href="sf">Click Here</a> for change your password.
//
//                    </td>
//                    </tr>
//                    </table>';
//                
//                $link='http://www.ucodice.com/harvest/resetpassword/218';
//                $message.="<p><a href='$link'>xccx</a></p>";
//                
//                echo $message;
//            $email1=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Forgot password','message'=>$message);
//            $sendmail=$this->functions->_email($email1);
//            if($sendmail){
//                echo "email send";
//            }else{
//                echo "getting Error!";
//            }
//            }else{
//                $this->load->view('include/header');
//                $this->load->view('auth/vw_forgot');
//                $this->load->view('include/footer');
//            }
//        }
        
        
        public function resetpassword($id){
            $this->form_validation->set_rules('password','Password','trim|required|matches[confirm_password]');
            $this->form_validation->set_message('matches', 'Confirm password must match new password.');
            $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required');
            if($this->form_validation->run()){
                $password=$this->input->post("password");
                $data=array("table"=>"user_Info","where"=>array("id"=>$id),"val"=>array("password"=>md5($password),"pass2"=>$password));
                $update=$this->common->update_data($data);
                if($update){
                    $this->session->set_flashdata("sucess","Your password reset successfully.");
                    redirect("auth/login","refresh");
                }
            }else{
                $id=array("id"=>$id);
                $this->load->view('include/header');
                $this->load->view('auth/vw_reset',$id);
                $this->load->view('include/footer');
            }
        }

        
        public function checkdupemail(){
            $email=$this->input->post("email");
            $data=array('table'=>'user_Info','where'=>array('email_id'=>$email));
            $log=$this->common->chkduplicate($data);
            if($log){
                echo $log;
            }else{
                echo 0;
            }
        }
        
        public function checkdupusername(){
            $username=$this->input->post("username");
            $data=array('table'=>'user_Info','where'=>array('username'=>$username));
            $log=$this->common->chkduplicate($data);
            if($log){
                echo $log;
            }else{
                echo 0;
            }
        }
        
//        public function _admin_approval_status(){
//            $this->db->select('status');
//            $this->db->from('approve_by_admin');
//            $this->db->where('title','user');
//            $query = $this->db->get();
//            return $query->row();
//        }
        
        public function logout($msg=NULL){
            $this->db->where(array('id'=>$this->session->userdata('user_id')));
            $this->db->update('user_Info', array("is_login"=>'0'));
            $this->session->sess_destroy();
            if($msg!=NULL)
                $this->session->set_flashdata("warning",$msg);
            redirect("auth/login","refresh");
        }
        
        
        public function autosearch($autosearch){
            $autosearch=urldecode($autosearch);
            //search for business type
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
                foreach($alluserid['rows'] as $user){ array_push($users, $user->user_id); }
            }
            //print_r($users);exit;
            //end serach for business type
            
            $like=array(
                array("likeon"=>"f_name","likeval"=>$autosearch),
                array("likeon"=>"l_name","likeval"=>$autosearch),
                array("likeon"=>"CONCAT(f_name,' ',l_name)","likeval"=>$autosearch),
                array("likeon"=>"CONCAT(f_name,'',l_name)","likeval"=>$autosearch),
            );
            $data['user']=array("table"=>"user_Info","val"=>"id,f_name,l_name,profile_Pic,username","where"=>array("type_Of_User"=>"1","store_info"=>"1","status"=>"1"),"like"=>$like,"in"=>array("id"),"in_value"=>array($users),'orderby'=>'paid','orderas'=>'DESC');
            
            $log['user']=$this->common->getdatalikeor($data['user']);
            //echo $this->db->last_query();exit;
            $current_date=date("Y-m-d");
            
            $like1=array(
                array("likeon"=>"p.prod_name","likeval"=>$autosearch),    
            );
            $data['product']=array("table"=>"product p","val"=>"p.id,p.prod_name,p.prod_price,p.prod_img","where"=>array("p.status"=>"1","p.admin_status"=>"1","p.no_of_Prod > "=> '0'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),"like"=>$like1,'orderby'=>'u.paid','orderas'=>'DESC');
            
            $multijoin2=array(
                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
            );
            
            $log['product']=$this->common->getdatalikeor($data['product'],$multijoin2);
            
            /*bussiness name*/
            $like4=array(
                array("likeon"=>"business_name","likeval"=>$autosearch),
            );
            $data['buss_name']=array("table"=>"user_store_info as uifo","val"=>"uifo.id,uifo.business_name,u.id,u.username","where"=>array(),"like"=>$like4,"in"=>array("u.id"),"in_value"=>array($users),'orderby'=>'uifo.id','orderas'=>'DESC');
            $multijoin3=array(
                array('table'=>'user_Info as u','on'=>'uifo.user_id=u.id','join_type'=>''),
             );  
           
            $log['buss_name']=$this->common->getdatalikeor($data['buss_name'],$multijoin3);
            //print_r($log); exit;
            /*end bussiness name*/
            
            echo json_encode($log);
            //echo $log;
        }

public function newsletter(){
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[newsletter.email]');
            if($this->form_validation->run()){
                $email = $this->input->post("email");
                
                $data=array('table'=>'newsletter','val'=>array('email'=>$email));                
                $log=$this->common->add_data($data);
                
                if($log){
                    echo json_encode(array("status"=>True,"message"=>"Thanks for subscription."));
                }
            }else{
                echo json_encode(array("status"=>False,"message"=>form_error('email')));
            }
        }

}
