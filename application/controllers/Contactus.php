<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contactus extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        
    }
    
    public function index()
    {
        $date=date('Y-m-d'); 
        $this->form_validation->set_rules('fname','Name','trim|required');
        $this->form_validation->set_rules('mobile','Mobile ','trim|required|numeric');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('message','Message','trim|required');   
        if($this->form_validation->run()){
            $f_name=$this->input->post("fname");
            $l_name=$this->input->post("lname");
            $email=$this->input->post("email");
            $mobile=$this->input->post("mobile");
            $address=$this->input->post("address");
            $message1=$this->input->post("message");
                 $data=array('table'=>'contact_us','val'=>array('f_name'=>$f_name,'l_name'=>$l_name,'email'=>$email,'phone'=>$mobile,'address'=>$address,'message'=>$message1,'status'=>'1','add_date'=>$date));
                    $result=$this->common->add_data($data);
                    if($result)
                    {
                        $message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                            <tr>
                            <td colspan="2" align="center"><h3>Enquiry Details</h3></td>
                            </tr>
                            <tr>
                            <td>Name</td>
                            <td>'.$f_name.' '.$l_name.'</td>
                            </tr>
                            <tr>
                            <td>Email</td>
                            <td>'.$email.'</td>
                            </tr>
                            <tr>
                            <td>Mobile</td>
                            <td>'.$mobile.'</td>
                            </tr>
                            <tr>
                            <td>Address</td>
                            <td>'.$address.'</td>
                            </tr>
                            <tr>
                            <td>Message</td>
                            <td>'.$message1.'</td>
                            </tr>
                            </table>';
//                    
                     $email1=array('from'=>'test@ucodice.com','to'=>'test@ucodice.com','subject'=>'Enquiry Form','message'=>$message);
                     $sendmail=$this->functions->_email($email1);
                        
                    $this->session->set_flashdata("sucess","Your information send successfully.");
                    redirect(BASE_URL."contactus/","refresh");
                    }else{
                    $this->session->set_flashdata("sucess","Sorry");
                    redirect(BASE_URL."contactus/","refresh"); 
                    }
            }else{
                //$this->session->set_flashdata("sucess","Please Submit The Detail's");
                //redirect(BASE_URL."Contactus/","refresh"); 
                $this->load->view('include/header');
                $this->load->view('harvest/Contactus');
                $this->load->view('include/footer');
            }
    }
    
    
//    public function submit()
//    {
//        $date=date('Y-m-d'); 
//        $this->form_validation->set_rules('fname','Name','trim|required');
//        $this->form_validation->set_rules('mobile','Mobile ','trim|required|numeric');
//        $this->form_validation->set_rules('email','Email','trim|required');
//        
//        
//           
//        if($this->form_validation->run()){
//        //if(($this->input->post("fname")!='')&&($this->input->post("email")!='')&&($this->input->post("mobile")!=''))
//           // {        
//        $data=array('table'=>'contact_us','val'=>array(
//            'f_name'=>$this->input->post("fname"),
//            'l_name'=>$this->input->post("lname"),
//            'email'=>$this->input->post("email"),
//            'phone'=>$this->input->post("mobile"),
//            'address'=>$this->input->post("address"),
//            'status'=>'1',
//            'add_date'=>$date));
//                    $result=$this->common->add_data($data);
//                    if($result)
//                    {
//                    $this->session->set_flashdata("sucess","Your information send successfully.");
//                    redirect(BASE_URL."contactus/","refresh"); 
//                    }
//                    else{
//                    $this->session->set_flashdata("sucess","Sorry");
//                    redirect(BASE_URL."contactus/","refresh"); 
//                    }
//            }else{
//                $this->load->view('include/header');
//                $this->load->view('harvest/Contactus');
//                $this->load->view('include/footer');
//            }
//    }
    
}
