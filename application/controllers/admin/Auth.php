<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    $this->_is_logined();

    $this->form_validation->set_rules('username', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run())
        {    
            if($this->_login($this->input->post('username'),md5($this->input->post('password'))))
            {
                    redirect('admin/dashboard/', 'refresh');
                    exit;
            }else{
                $this->session->set_flashdata('warning','Invalid username/password.');
                redirect('admin/auth/','refresh');
            }
        }else{
                $this->load->view('admin/auth/adminvw_login');
        }
    }



    function _login($username,$password)
    {
            $username=htmlentities($username, ENT_QUOTES);
			$password=htmlentities($password, ENT_QUOTES);
            $query="SELECT * FROM admin where '".$username."' IN (username,email_id) AND password='".$password."' and status='1'";
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
                    $this->session->set_userdata(ADMIN_SESS.'user_id', $log['rows']->id);
                    $this->session->set_userdata(ADMIN_SESS.'user_name', $log['rows']->username);
                    $this->session->set_userdata(ADMIN_SESS.'admin_type', $log['rows']->admin_type);
                    $this->db->where(array('id'=>$this->session->userdata(ADMIN_SESS.'user_id')));
                    $this->db->update('admin', array("last_login"=>time()));

                    return true;
            }
            else{
                //echo "ddd";exit;
                return false;
            }
    }

    function _is_logined()
    {
        if($this->session->userdata(ADMIN_SESS.'user_id'))
        {
            redirect('dashboard/','refresh');
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
                        $this->session->set_flashdata("sucess","Please check your e-mail id for reset password.");
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


        public function resetpassword($id){
            $this->form_validation->set_rules('password','Password','trim|required|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required');
            if($this->form_validation->run()){
                $password=$this->input->post("password");
                $data=array("table"=>"user_Info","where"=>array("id"=>$id),"val"=>array("password"=>md5($password)));
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






        public function logout($msg=NULL){
            $this->session->sess_destroy();
            if($msg!=NULL)
                $this->session->set_flashdata("warning",$msg);
                redirect("admin/auth","refresh");
        }


}
