<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MY_Controller {
    private $userid;
    private $userpaidstatus;
    
    function __construct()
    {
        parent::__construct();
        $this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        $this->userpaidstatus=$this->session->userdata('user_paid');
    }
    
    public function index(){
            $this->_sellergalleryview();
    }
    
    private function _sellergalleryview(){
        $data=array("table"=>'userProd_image',"where"=>array("user_id"=>$this->userid,"type_ofimage"=>'gallery'),'orderby'=>'id','orderas'=>'DESC');
        //$log['gallery']=$this->common->getdata($data);

        $table=array('table'=>'userProd_image',"where"=>array('user_id'=>$this->userid,"type_ofimage"=>'gallery'));
        $config = array();
        $config["base_url"] = BASE_URL. "gallery";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 15;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['gallery']=$this->common->get_where_with_paginaiton($config["per_page"], $page,$data);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);

        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/gallery/vw_gallery',$resp);
        $this->load->view('include/footer');
    }

    public function add(){
        $this->_media_userlimitation("media",$this->userpaidstatus,"userProd_image",array("user_id"=>$this->userid,"type_ofimage"=>"gallery"),"gallery");
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/gallery/vw_gallery_add');
        $this->load->view('include/footer');
    }
    
    public function files(){
//print_r($_FILES);exit;
        $this->_media_userlimitation("media",$this->userpaidstatus,"userProd_image",array("user_id"=>$this->userid,"type_ofimage"=>"gallery"),"gallery");
        $userfile='file';
        $image_path='assets/image/gallery/'.$this->userid.'/';
        $allowed='jpg|png|jpeg';
        $max_size='4096000';

        $fileupload=$this->functions->_multi_upload_files_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
//echo $userfile;exit;
       
//echo "<pre>";
//print_r($fileupload);exit;
//	echo $fileupload['status'];exit;
        if($fileupload['status']){
            foreach($fileupload['filename'] as $filename){
            $dataforinsert[]=array('user_id'=>$this->userid,'type_ofimage'=>'gallery','image_path'=>$filename,'status'=>'1');
            }
        $data=array('table'=>'userProd_image','where'=>array('id'=>$this->userid),'val'=>$dataforinsert);                
        $log=$this->common->insert_multi_row($data);
        //exit;
            $this->session->set_flashdata("sucess","Gallery added successfully.");
            redirect("gallery","refresh");
        }else{
            $this->session->set_flashdata("warning",$fileupload["error"]);
            redirect("gallery","refresh");
        }

    }
    
    public function delete(){
        $id = $this->input->post("id");
        
        $galdata=array("table"=>"userProd_image","where"=>array("id"=>$id),"val"=> array("image_path"));
        $gallery=$this->common->getsinglerow($galdata);
       // print_r($gallery);exit;
        if($gallery['res']){
            $path="assets/image/gallery/".$this->userid."/".$gallery['rows']->image_path;
            if(file_exists($path)){
            unlink($path);}
            $path="assets/image/gallery/".$this->userid."/thumb/".$gallery['rows']->image_path;
           if(file_exists($path)){
            unlink($path);}
        }
        
        $data=array('table'=>'userProd_image','where'=>array('id'=>$id));
        $log=$this->common->delete_data($data);
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
    }
    
    public function updateimage(){
        //print_r($_FILES);exit;
         $id = $this->input->post("galid");
        $userfile='file';
        $image_path='assets/image/gallery/'.$this->userid.'/';
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
    
    
    
    public function addvideos(){
        $this->_media_userlimitation("media",$this->userpaidstatus,"userProd_image",array("user_id"=>$this->userid,"type_ofimage"=>"gallery"),"gallery");
        $this->form_validation->set_rules('video_link','Video Link','trim|required');
        if($this->form_validation->run()){
            $video_link=$this->input->post("video_link");
            $userid=$this->userid;
            
            $data=array('table'=>'user_videos','val'=>array('user_id'=>$userid,'video_path'=>$video_link,'status'=>'1','type_of_videos'=>'1'));                
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Video add successfully.");
                redirect("gallery/viewvideos/","refresh");
            }
        
        }else{
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/gallery/vw_gallery_video_add');
            $this->load->view('include/footer');
        }
    }
    
    
    public function viewvideos(){
        $data=array("table"=>'user_videos',"where"=>array("user_id"=>$this->userid,"type_of_videos"=>'1'),'orderby'=>'id','orderas'=>'DESC');
        //$log['gallery']=$this->common->getdata($data);

        $table=array('table'=>'user_videos',"where"=>array('user_id'=>$this->userid,"type_of_videos"=>'1'));
        $config = array();
        $config["base_url"] = BASE_URL. "gallery/viewvideos";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['gallery']=$this->common->get_where_with_paginaiton($config["per_page"], $page,$data);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/gallery/vw_gallery_video_view',$resp);
            $this->load->view('include/footer');
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
        $id=$this->input->post("id");
        $galdata=array("table"=>"user_videos","where"=>array("id"=>$id),"val"=> array("video_path","id"));
        $gallery=$this->common->getsinglerow($galdata);
        
        echo json_encode($gallery);
        
    }
    
    
    public function video_update(){
        $this->form_validation->set_rules('video_link','Video Link','trim|required');
        if($this->form_validation->run()){
           $id=$this->input->post("id");
            $video_link=$this->input->post("video_link");
            $data=array('table'=>'user_videos','where'=>array('id'=>$id),'val'=>array('video_path'=>$video_link));
            $log=$this->common->update_data($data);
            if($log){
                echo json_encode(array('status'=>true,'message'=>'Video update successfully.'));
            } 
        }else{
            echo json_encode(array('status'=>false,'message'=>validation_errors()));
        }
        
    }
    
    
    
    
    public function _media_userlimitation($title=null,$userpaidstatus=null,$table=null,$where=array(),$redirectpage){
        
            $data=array("table"=>"user_validation","val"=>"$title as title","where"=>array("user_type"=>"$userpaidstatus"));
            
            $log=$this->common->getsinglerow($data);
            //print_r($this->db->last_query());exit;
            if($log['res']){          
                $newdata=array("table"=>$table,"where"=>$where);
                $newlog=$this->common->record_count_where($newdata);
                
                $newdata1=array("table"=>"user_videos","where"=>array("user_id"=>$this->userid));
                $newlog1=$this->common->record_count_where($newdata1);
                
                if(!empty($_FILES['file'])){
                    //print_r(count($_FILES['file']['name']));exit;
                    $newlog+=count($_FILES['file']['name'])-1; 
                }
                //echo $newlog;exit;
                if($log['rows']->title > ($newlog+$newlog1)){
                    return array("status"=>true,"message"=>"");
                }else{
                    $count=$log['rows']->title;
                    $this->session->set_flashdata("warning","As a Free User, you are limited to posting $count Media.  To post more and access additional functionality, please <a href='".BASE_URL."paiduser'> click here</a> to purchase a Premium package.");
                    redirect($redirectpage,"refresh");
                }
                //EXIT;
            }else{
                return array("status"=>true,"message"=>"no any limitation");
            }
            
       
    }
    
    
}    
