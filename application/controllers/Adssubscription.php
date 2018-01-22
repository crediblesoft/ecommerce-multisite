<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Adssubscription extends MY_Controller 
{

    public function __construct()
    {
       parent::__construct();
       $this->load->library('session');
       $this->functions->_valid_user();
       $this->userid=$this->session->userdata('user_id');
    }    
    public function index()
    {  
        //echo $this->userid;
    $this->is_seller();
//       $comment1=array('val'=>'ads_s.*,ads_pr.price,ads_pr.id as per_id','table'=>'ads_subscription as ads_s','where'=>array("user_id"=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'ads_s.id','orderas'=>'DESC');
//        $multijoin1=array(  
//            array('table'=>'ads_subscription_period as ads_pr','on'=>'ads_s.category=ads_pr.id','join_type'=>''),
//        );
//        $ads['adsdata']=$this->common->multijoin($comment1,$multijoin1);
        $data=array('val'=>'*','table'=>'ads_subscription','where'=>array("user_id"=>$this->userid));
        $ads['adsdata']=$this->common->getdata($data);  
            //echo "<pre>";
            //print_r($ads); exit;
     $data1=array('val'=>'*','table'=>'ads_subscription_period','where'=>array());
     $ads['category']=$this->common->getdata($data1);    
     $this->load->view('include/header');
     $this->load->view('userlogin/include/vw_userleft');
     $this->load->view('userlogin/ads_subs/vw_main_ads_subs',$ads);
     $this->load->view('include/footer');  
    
    }
    function add(){
        //print_r($_POST);exit;
        $date=date('Y-m-d');
        $adstype=$this->input->post("adstype");
        if($adstype==0){
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('content','Content','trim|required');
        //$this->form_validation->set_rules('category','Category','trim|required');
        }
        else{
           $this->form_validation->set_rules('details','Details','trim|required');
           //$this->form_validation->set_rules('category','Category','trim|required');
           
        }
        if($this->form_validation->run()){
        
        $userid=$this->session->userdata('user_id');
        
        if($adstype==0){
        $title=$this->input->post("title");
        $content=$this->input->post("content");
        //$category=$this->input->post("category");
        $html_data="";
        
        
        if(isset($_FILES['file']['name'])){
                    $userfile='file';
                    $image_path='assets/image/ads_images/';
                    $allowed='jpg|png|jpeg';
                    $max_size='4096000';
                    
                    $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
                    //print_r($fileupload); exit;
                    $prodImage=$fileupload['filename'];
                    }else{
                         $prodImage='default.png';	
                     }
                     if($prodImage==NULL) $prodImage='default.png';
                     //echo $prodImage; exit;
        }
        else{
            $title="";
            $content="";
            $prodImage="";
            $html_data=$this->input->post("details");
            //$category=$this->input->post("category");
        }
        $data=array('table'=>'ads_subscription','val'=>array('user_id'=>$userid,'title'=>$title,'content'=>$content,'html_data'=>$html_data,'image'=>$prodImage,'paid_status'=>'0','ads_date'=>$date));                
        //echo "<pre>";print_r($data);exit;
        $log=$this->common->add_data_get_id($data);
        if($log){
            $this->session->set_flashdata("sucess","Ads add successfully.");
            redirect("adssubscription/adspayment","refresh");
        }
        }else{
//            $data=array('val'=>'*','table'=>'ads_subscription_period','where'=>array());
//            $log['category']=$this->common->getdata($data);  
            //echo "<pre>";
            //print_r($log); exit;
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/ads_subs/vw_ads_subs');
            $this->load->view('include/footer');
        }  
        
    }
    
    public function getprice(){
     $id=$this->input->post('id');
     $this->session->set_userdata('price',$id);
     $data=array('val'=>'*','table'=>'ads_subscription_period','where'=>array('id'=>$id));
     $result=$this->common->get_where($data);
      if($result['res']){
            
            echo json_encode(array('res'=>true,'category'=>$result['rows']));
            
        }else{
            echo json_encode(array('res'=>false));
        }
    }

    public function delete_image(){
        $user_id=$this->input->post('user_id');
        $image=$this->input->post('image');
        $path=BASE_URL.'assets/image/ads_images/thumb/';
        $data=array('table'=>'ads_subscription','val'=>array('image'=>""),'where'=>array('user_id'=>$user_id));               
        $log=$this->common->update_data($data);
         //echo $this->db->last_query(); exit;
        if($log){
            if($image!="default.png"){
                unlink( $path . $image );
                
            }
            echo json_encode(array('res'=>true));
           
        }else{
            echo json_encode(array('res'=>false));
        }
    }
    
    public function set_session()
	{
		$sname=$this->input->post('name');
		$svalue=$this->input->post('value');
                
		
		$this->session->set_userdata($sname,$svalue);
		echo json_encode(array('status'=>true,'result'=>'success'));
		
	}
        
        
     function update_ads(){
        //print_r($_POST);exit;
        $date=date('Y-m-d');
        $adstype=$this->input->post("adstype");
        if($adstype==0){
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('content','Content','trim|required');
        //$this->form_validation->set_rules('category','Category','trim|required');
        }
        else{
           $this->form_validation->set_rules('details','Details','trim|required');
           //$this->form_validation->set_rules('category','Category','trim|required');
           
        }
        if($this->form_validation->run()){
        
        $userid=$this->session->userdata('user_id');
        
        if($adstype==0){
            $title=$this->input->post("title");
            $content=$this->input->post("content");
            //$category=$this->input->post("category");
            $html_data="";
            if($_FILES['file']['name']!=''){
            //echo 'hello';exit;
                    $userfile='file';
                    $image_path='assets/image/ads_images/';
                    $allowed='jpg|png|jpeg';
                    $max_size='4096000';
                    
                    $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
                    //print_r($fileupload); exit;
                    $prodImage=$fileupload['filename'];
                    }
            else{
              //echo 'hellowwww';exit;
                  $prodImage=$this->input->post("exist_image");	
            }
            if($prodImage==NULL) $prodImage='default.png';
            //echo $prodImage; exit;
        }
        else{
            $title="";
            $content="";
            $prodImage="";
            $html_data=$this->input->post("details");
            //$category=$this->input->post("category");
        }
        $data=array('table'=>'ads_subscription','val'=>array('title'=>$title,'content'=>$content,'html_data'=>$html_data,'image'=>$prodImage,'ads_date'=>$date),'where'=>array('user_id'=>$userid));               
        $log=$this->common->update_data($data);
        if($log){
            $this->session->set_flashdata("sucess","Ads add successfully.");
            redirect("adssubscription/adspayment","refresh");
        }
        }else{
//            $data=array('val'=>'*','table'=>'ads_subscription_period','where'=>array());
//            $log['category']=$this->common->getdata($data);  
            //echo "<pre>";
            //print_r($log); exit;
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/ads_subs/vw_ads_subs');
            $this->load->view('include/footer');
        }  
        
    } 
    
       
    function adspayment(){
     $data=array('val'=>'*','table'=>'ads_subscription','where'=>array("user_id"=>$this->userid));
        $ads['adsdata']=$this->common->getdata($data);  
            //echo "<pre>";
            //print_r($ads); exit;
     $data1=array('val'=>'*','table'=>'ads_subscription_period','where'=>array());
     $ads['category']=$this->common->getdata($data1); 
     $this->load->view('include/header');
     $this->load->view('userlogin/include/vw_userleft',$ads);
     $this->load->view('userlogin/ads_subs/vw_ads_payment');
     $this->load->view('include/footer');     
    }
        
}
?>
