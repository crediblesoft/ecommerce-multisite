<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('editmodel');
    }
    
    public function index()
    {   
        $date = date('Y-m-d'); 
        $comment1=array('val'=>'cpd.id,cpd.video_link, cpd.user_id, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.username,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.type_Of_User,ui.profile_Pic, ui.address1,ui.username','table'=>'campaign_detail as cpd','where'=>array("cpd.stetus"=>'1',"cpd.show_stetus"=>'1',  "cpd.end_date>=" => $date,'ui.status'=>'1'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');//"cpd.start_date<=" => $date , 
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>'')
            );
        $recipetotal=$this->common->multijoin($comment1,$multijoin1);
        //print_r(count($recipetotal['rows']));exit;
        $config = array();
        $config["base_url"] = BASE_URL. "campaign/";
        if($recipetotal['res']){
        $config["total_rows"] = count($recipetotal['rows']);
        }
        else{
            $config["total_rows"]=0;}
            $config["per_page"] = 12;
            $config["uri_segment"] = 2;
            $this->pagination->initialize($config); 
            $page = ($this->uri->segment(2))? $this->uri->segment(2) : 0;        
        
        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        //$data['campaigns']=$this->common->multijoin($comment1,$multijoin1);
        //$data['campaigns']=  $this->editmodel->getallcampaign();
        $this->load->view('include/header');
        $this->load->view('campaign/all_campaign_view',$data);
        $this->load->view('include/footer');
    }
    
    public function view($id)
    {
        $date = date('Y-m-d'); 
        //$this->functions->_valid_user();
        if($this->session->has_userdata("user_id")){$where=array("cpd.id"=>$id);}else{$where=array("cpd.id"=>$id,'show_stetus'=>'1','stetus'=>'1','ui.status'=>'1');}
        $comment1=array('val'=>'cpd.id, cpd.video_link,cpd.user_id, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.profile_Pic, ui.address1,ui.type_Of_User,ui.profile_Pic,ui.username,cpd.show_stetus','table'=>'campaign_detail as cpd','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>'left')            
        );
        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1);  //$this->editmodel->getbyidcampaign($id);
         $data1=array('val'=>'*','table'=>'campaign_payment_detail','where'=>array('campaign_id'=>$id));
        $data['peymentdetail']=$this->common->getdata($data1);
        //print_r($data['campaigns']);
        if($this->session->has_userdata('user_id')){
            $payemntdata=array("table"=>'campaign_payment_detail',"val"=>array('sum(price) as yourdonation '),'where'=>array('campaign_id'=>$id,'buyerId'=>$this->session->userdata('user_id')));
            $paymentdetails=$this->common->getsinglerow($payemntdata);
            $data['yourdonation']=$paymentdetails['rows']->yourdonation;
        }else{
            $data['yourdonation']=0;
        }
        
        
        if($data['campaigns']['res']){
        $meta['meta_fb_compaigns']=$data['campaigns']['rows'][0];
        $this->load->view('include/header',$meta);
        $this->load->view('campaign/one_campaign_detail',$data);
        $this->load->view('include/footer');        
        }
        else{        
            redirect("_404","refresh");     
        }
    }
    public function addcampaign()
    {
        //$this->check_img_size("campaign/addcampaign");
        //$this->functions->_valid_user();
        $this->_checkvalid("campaign/addcampaign");
        $this->is_seller("You have login as a seller for add campaign.");
        
        //$this->form_validation->set_rules('video_link','Video Link','trim|required');
        $this->form_validation->set_rules('name','Campaign Name','trim|required');
        $this->form_validation->set_rules('price','Campaign Price','trim|required|numeric');
        $this->form_validation->set_rules('details','Campaign Details','trim|required');
        $this->form_validation->set_rules('CampaignStartDate','Campaign Start Date','trim|required');
        $this->form_validation->set_rules('CampaignEndDate','Campaign End Date','trim|required');
        
           
        if($this->form_validation->run()){
        
        $userid=$this->session->userdata('user_id');
        
        $video_link=$this->input->post("video_link");
        $name=$this->input->post("name");
        $price=$this->input->post("price");
        $details=$this->input->post("details");
        $CampaignStartDate=$this->input->post("CampaignStartDate");
        $CampaignEndDate=$this->input->post("CampaignEndDate");
        
        $status=$this->input->post("status");
       // $admin_status=$this->_admin_approval_status();
        
        /*$data1=array('table'=>'product','where'=>array());
        $noofrows= $this->common->record_count_where($data1);
        $noofrows+=1;*/
        
    if(isset($_FILES['file']['name']))
    {
            $userfile='file';
            $image_path='assets/image/campaign/';
            $allowed='jpg|png|jpeg';
            $max_size='4096000';

            //$fileupload=$this->functions->_upload_image($userfile,$image_path,$allowed,$max_size);
            $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
            //print_r($fileupload);
             }else{
                 $fileupload=array('status'=>1,'filename'=>'campaign.jpg');
             }

             //print_r($fileupload);exit;
              $prodImage=$fileupload['filename'];
           // exit();

            $data=array('table'=>'campaign_detail','val'=>array('user_id'=>$userid,'campaign_titel'=>$name,'price'=>$price,'campaign_detail'=>$details,'image_path'=>$prodImage,'video_link'=>$video_link ,'start_date'=>$CampaignStartDate, 'end_date'=>$CampaignEndDate,'show_stetus'=>$status,'stetus'=>'1','payment_stetus'=>'0'));//$admin_status->status                
            //print_r($data);
            //exit();//'start_date'=>str_replace("/","-",$CampaignStartDate), 'end_date'=>str_replace("/","-",$CampaignEndDate)
            $log=$this->common->add_data($data);
            //SELECT `id`, `user_id`, `price`, `campaign_titel`, `campaign_detail`, `image_path`, `start_date`, `end_date`, `show_stetus`, `stetus`, `payment_stetus` 
            //FROM `campaign_detail` 
            //WHERE `id`='' AND `user_id`='' AND `show_stetus` AND `stetus` AND (`start_date`< CURDATE() AND  `start_date`<= CURDATE())        
            //print_r($log);
            //print_r($data);exit;
            if($log){
                $this->session->set_flashdata("sucess","Campaign add successfully.");
                redirect("campaign/addcampaign/","refresh");
            }

            }else{ 

            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('campaign/add_campaign');
            $this->load->view('include/footer');
            }
        
    }
    public function userCampaignList()
    {
        $this->functions->_valid_user();
        $user_id=$this->session->userdata('user_id');

        
        $comment1=array('val'=>'cpd.id, cpd.user_id,cpd.show_stetus,cpd.stetus as admin_status, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name,ui.type_Of_User,ui.profile_Pic, ui.address1,ui.username,IFNULL(sum(c_pd.price),"0") as ac_price,IFNULL(sum(ts.commission),"0") as ttlcomm','table'=>'campaign_detail as cpd','where'=>array("cpd.user_id"=>$user_id),'minvalue'=>'','group_by'=>'cpd.id','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>''),
            array('table'=>'campaign_payment_detail as c_pd','on'=>'cpd.id=c_pd.campaign_id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=c_pd.trans_id','join_type'=>'left'),
            
        );
        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1); 

        $config = array();
        $config["base_url"] = BASE_URL. "campaign/userCampaignList";
        $config["total_rows"] = ($data['campaigns']['res'])?count($data['campaigns']['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $this->load->view('include/header');        
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('campaign/userCampaignList',$data);
        $this->load->view('include/footer');
    }
    
    public function editCampaign($id)
    {
        $this->functions->_valid_user();
        $user_id=$this->session->userdata('user_id');
         $comment1=array('val'=>'cpd.id,cpd.video_link, cpd.user_id,cpd.show_stetus, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name,ui.type_Of_User,ui.profile_Pic, ui.address1,ui.username','table'=>'campaign_detail as cpd','where'=>array("cpd.user_id"=>$user_id,'cpd.id'=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>''),
            
        );
        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1); 
       
        $this->load->view('include/header');        
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('campaign/edit_campaign',$data);
        $this->load->view('include/footer');
    }
     public function delete()
    {
         $this->functions->_valid_user();
        $id = $this->input->post("id");        
        $data=array('val'=>'*','table'=>'campaign_detail','where'=>array('id'=>$id,'payment_stetus'=>1));
        $result=$this->common->getdata($data);
       if($result['res']){
        $log=$this->common->delete_data($data);
       // print_r($result);
        //$log=1;
                if($log){
                    echo json_encode(array('status'=>TRUE,'message'=>'Data deleted successfully.'));
               }
               else{
                   echo json_encode(array('status'=>FALSE,'message'=>'Data does not deleted successfully.'));
               }
        }
       else{
           echo json_encode(array('status'=>FALSE,'message'=>'You can not delete this campaign <br/> some one has done payment on this.'));
       }
    }
    
    public function updatecampaign()
    {
        //$this->check_img_size("campaign/editCampaign/".$this->input->post('campaignId'));
        $this->functions->_valid_user();
        //$this->form_validation->set_rules('video_link','Video Link','trim|required');
        $this->form_validation->set_rules('name','Campaign Name','trim|required');
        $this->form_validation->set_rules('price','Campaign Price','trim|required|numeric');
        $this->form_validation->set_rules('details','Campaign Details','trim|required');
        $this->form_validation->set_rules('CampaignStartDate','Campaign Start Date','trim|required');
        $this->form_validation->set_rules('CampaignEndDate','Campaign End Date','trim|required');
        
           
        if($this->form_validation->run()){
        
        $userid=$this->session->userdata('user_id');
        
        $video_link=$this->input->post("video_link");
        $name=$this->input->post("name");
        $price=$this->input->post("price");
        $details=$this->input->post("details");
        $CampaignStartDate=$this->input->post("CampaignStartDate");
        $CampaignEndDate=$this->input->post("CampaignEndDate");
        $campaignId=$this->input->post('campaignId');
        $status=$this->input->post("status");
        
        if($_FILES['file']['name']!=""){
            //'prod_img'=>$prodImage,
            $proddata=array("table"=>"campaign_detail","where"=>array("id"=>$campaignId),"val"=> array("image_path"));
            $product=$this->common->getsinglerow($proddata);
                $path="assets/image/campaign/".$product['rows']->image_path;
               if(file_exists($path)){ unlink($path);}
                $path2="assets/image/campaign/thumb/".$product['rows']->image_path;
                if(file_exists($path2)){unlink($path2);}
           
        $userfile='file';
        $image_path='assets/image/campaign/';
        $allowed='jpg|png|jpeg';
        $max_size='4096000';

        $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
        $prodImage=$fileupload['filename'];
        $data=array('table'=>'campaign_detail','where'=>array('id'=>$campaignId),'val'=>array('campaign_titel'=>$name,'price'=>$price,'campaign_detail'=>$details,'image_path'=>$prodImage,'video_link'=>$video_link ,'start_date'=>$CampaignStartDate, 'end_date'=>$CampaignEndDate,'show_stetus'=>$status,'payment_stetus'=>'0'));                
         }else{
        $data=array('table'=>'campaign_detail','where'=>array('id'=>$campaignId),'val'=>array('campaign_titel'=>$name,'price'=>$price,'campaign_detail'=>$details,'video_link'=>$video_link ,'start_date'=>$CampaignStartDate, 'end_date'=>$CampaignEndDate,'show_stetus'=>$status,'payment_stetus'=>'0'));                
         }
        $log=$this->common->update_data($data);
//        print_r($log);exit;
        if($log){
            //echo "eerr";exit;
            $this->session->set_flashdata("sucess","Campaign updated successfully.");
            redirect("campaign/userCampaignList","refresh");
        }
        
        }else{
            $this->session->set_flashdata("warning","Campaign not updated successfully.");
            redirect("campaign/editCampaign/".$campaignId,"refresh");
        }
    }
    
    public function userViewCampaign($id)
    {
        $this->functions->_valid_user();
        $comment1=array('val'=>'cpd.id,cpd.video_link, cpd.user_id, cpd.price, cpd.campaign_titel, cpd.campaign_detail, cpd.image_path, cpd.start_date, cpd.end_date,ui.mobile_no, ui.email_id, ui.f_name, ui.l_name, ui.profile_Pic, ui.address1','table'=>'campaign_detail as cpd','where'=>array("cpd.id"=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'cpd.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'user_Info as ui','on'=>'ui.id=cpd.user_id','join_type'=>''),
            //array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
        );//SELECT `id`,  `mobile_no`, `email_id`, `f_name`, `l_name`, `profile_Pic`, `address1` FROM `user_Info` WHERE `id`=''
        //SELECT `id`, `user_id`, `price`, `campaign_titel`, `campaign_detail`, `image_path`, `start_date`, `end_date`, `show_stetus`, `stetus`, `payment_stetus` FROM `campaign_detail` WHERE `id`='' AND `user_id`='' AND `show_stetus` AND `stetus` AND (`start_date`< CURDATE() AND  `start_date`<= CURDATE())
        $data['campaigns']=$this->common->multijoin($comment1,$multijoin1);  //$this->editmodel->getbyidcampaign($id);
        //$data['user_data']=  $this->editmodel->getbyidcampaign($id);
        $data1=array('val'=>'*','table'=>'campaign_payment_detail','where'=>array('campaign_id'=>$id));
        $data['peymentdetail']=$this->common->getdata($data1);
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('campaign/userViewCampaign',$data);
        $this->load->view('include/footer');        
    }
}
