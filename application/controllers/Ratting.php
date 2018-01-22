<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ratting extends MY_Controller {
    private $userid;
    
    function __construct()
    {
        parent::__construct();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
    }
    
    
    function addreview(){
        $username=$this->getusername($this->input->post('revuserId'));
        $this->_checkvalid("sellerprofile/$username");
        
         $this->form_validation->set_rules('reviews', 'Reviews', 'trim|required');
         if($this->form_validation->run())
         {	
             $reviews=$this->input->post('reviews');
             $stars= $this->input->post('stars');
             $revuserId=$this->input->post('revuserId');
             $userId=$this->userid;
             $currentDate=date('Y-m-d');
             $data=array('val'=>array('revuserid'=>$revuserId,'userid'=>$userId,'stars'=>$stars,'reviews'=>$reviews,'date'=>$currentDate),'table'=>'userreviews');
             $log= $this->common->add_data($data);
             if($log)
             {
                 $this->session->set_flashdata("sucess","Your review added successfully.");
                 redirect("sellerprofile/$username","refresh");			
             }
         }
         else
         {
            $this->load->view('include/header');
            $this->load->view('sellerprofile/vw_sellerprofile',$resp);
            $this->load->view('include/footer');
         }
     }
     
     function get_reviews(){
         
            if($this->input->post('id'))
            {
                $id = $this->input->post('id');
                $query = $this->db->get_where('userreviews', array('id' => $id));
                if($query->num_rows() > 0)
                {
                    $res=$query->row_array();$res['status']=true;
                    echo json_encode(array($res));
                }
            }else{
                echo "error";
            }
        }
        
        function update_reviews(){
            $this->form_validation->set_rules('editReviews', 'Reviews', 'trim|required');
            if($this->form_validation->run())
            {
                $editReviews=$this->input->post('editReviews');
                $id=$this->input->post('id');
                $data=array('val'=>array('reviews'=>$editReviews),'table'=>'userreviews','where' => array('id'=>$id));
		$log= $this->common->update_data($data);
                if($log)
                {
                    echo json_encode(array(array('status'=>true,'message'=>'Your review updated successfully.')));		
		}
            }
            else
            {
                echo json_encode(array(array('status'=>false,'message'=>  validation_errors())));
            }
        }
        
        
        function deletereview(){
            if($this->input->post('id'))
            {
                $id = $this->input->post('id');
                $this->db->where('id', $id);
                $this->db->delete('userreviews');
                if($this->db->affected_rows() > 0)
                {
                    echo json_encode(array(array('status'=>true,'message'=>'Successfully Deleted.')));
                }
                else
                {
                    echo json_encode(array(array('status'=>false,'message'=>'Nothing to be deleted.')));
                }
            }
        }

}
