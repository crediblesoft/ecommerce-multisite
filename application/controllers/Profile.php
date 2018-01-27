<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        $this->load->model('editmodel');
        $this->load->library('Geozip');
    }



    public function index(){
        $this->userinfo();
    }

    public function _getuser($id){
        $this->db->select("u.*,s.state,s.id as stateid");$this->db->join('statelist s','s.id=u.state','left');
        //$query=$this->db->get_where('user_Info u', array('u.id' => $id));
        //$data=$query->result();
        $data=$this->db->get_where('user_Info u', array('u.id' => $id))->result();
        if($data){
            return $log=array('res'=>true,'userdata'=>$data[0]);
        }else{
            return $log=array('res'=>false);
        }
    }


    public function storeinfo(){
        //echo "<pre>";
        //print_r($_POST); exit;
        $this->form_validation->set_rules('themeid','Theme','trim|required');
        $this->form_validation->set_rules('business_type[]','Business Type','trim|required');
        $this->form_validation->set_rules('business-name','Business Name','trim|required');
        $this->form_validation->set_rules('contact-person','Contact Person Name','trim|required');
        $this->form_validation->set_rules('phone','Phone','trim|required');
        $this->form_validation->set_rules('address','Address','trim|required');
        $this->form_validation->set_rules('city','City','trim|required');
        $this->form_validation->set_rules('zip','Zip','trim|required');
        // $this->form_validation->set_rules('acno','Account Number','trim|required');
        // $this->form_validation->set_rules('routno','Routing Number','trim|required');

        //$this->form_validation->set_rules('address','Address','trim|required');

        if($this->form_validation->run()){

            $themeid=$this->input->post("themeid");
            $business_type=$this->input->post("business_type");
            $business_name=$this->input->post("business-name");
            $contact_person=$this->input->post("contact-person");
            $phone=$this->input->post("phone");
            $address=$this->input->post("address");
            $city=$this->input->post("city");
            $zip=$this->input->post("zip");
            $income=$this->input->post("income");
            if($income==''){$income=0;}
            $certification=$this->input->post("certification");
            $farmsize=$this->farmincome($income);
            $getlanglat=$this->geozip->get_zip_point($zip);
            // $acno=$this->input->post("acno");
            // $routno=$this->input->post("routno");


            // make data for create sub-merchant a/c for sellers
            // $this->load->library('Braintree');
            // $sellerinfo=$this->getsellers(array('f_name','l_name','mobile_no','email_id','state'),array('id'=>$this->userid));
            // $sellerinfo1=$sellerinfo['rows'][0];
            // $state=$this->db->get_where('statelist',array('id'=>$sellerinfo1->state))->row();
            // $sub_merchant_data=array('individual'=>array('firstName'=>$sellerinfo1->f_name,'lastName'=>$sellerinfo1->l_name,'email'=>$sellerinfo1->email_id,'phone'=>$sellerinfo1->mobile_no,'address'=>array('streetAddress'=>$address,'locality'=>$state->state,'region'=>$state->code,'postalCode'=>$zip)),'funding'=>array('descriptor'=>$business_name,'email'=>'','mobilePhone'=>'','accountNumber'=>$acno,'routingNumber'=>$routno));
            // $sub_merchant_account=$this->braintree->create_sub_merchant($sub_merchant_data);
            // //create sub-merchant account


            // if(!$sub_merchant_account['status']){ $this->session->set_flashdata('warning',$sub_merchant_account['errorMessage']); $this->userinfo(); exit;}
            //if(!$sub_merchant_account['status']){ $this->session->set_flashdata('warning',$sub_merchant_account['errorMessage']); redirect('profile/', 'refresh');}
            //exit;
            //print_r($business_type);exit;
            $data=array('table'=>'user_store_info','val'=>array('user_id'=>$this->userid,'business_name'=>$business_name,'contact_person_name'=>$contact_person,'phone'=>$phone,'address'=> $address,'city'=>$city,'zip'=>$zip,'lat'=>$getlanglat->lat,'lng'=>$getlanglat->lng,"size"=>$farmsize,"income"=>$income,'certification'=>$certification));
            $log=$this->common->add_data($data);
            //,'acc_no'=>$acno,'rout_no'=>$routno,'merchant_id'=>$sub_merchant_account['number']
            $data=array("table"=>"db_theem","val"=>"id","where"=>array("user_id"=>$this->userid,'theam_id'=>$themeid));
            $logdata=$this->common->getsinglerow($data);
             if(!$logdata['res']){
                $log1=$this->editmodel->addNewUserData($this->userid,$themeid);
             }

            foreach($business_type as $business){
                $bs_type[]=array('user_id'=>$this->userid,'business_id'=>$business);
            }

            $data2=array('table'=>'user_business_type','val'=>$bs_type);
            $log2 = $this->common->insert_multi_row($data2);

            if($log && $log1 && $log2){
                $updatedata=array('table'=>'user_Info','where'=>array('id'=>$this->userid),'val'=>array('store_info'=>'1'));
                $updatelog=$this->common->update_data($updatedata);
                $this->session->set_userdata("store_info","1");

                $this->session->set_flashdata("sucess","Your store information has been successfully updated.");
                redirect('profile','refresh');
            }else{
                $this->session->set_flashdata("warning","Your are getting some error. Please contact to administrator.");
                redirect('profile','refresh');
            }


        }else{
            $this->userinfo();
        }
    }


    /*private function userinfo(){
        $userid=$this->session->userdata('user_id');

        $log=$this->_getuser($userid);
        $data=array('val'=>array('id','title'),'table'=>'social_link','where'=>array('status'=>'1'));
        $log['social']=$this->common->getdata($data);

        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');

        if($this->session->userdata('user_type')=="2"){
            $this->load->view('userlogin/profile/vw_profile_buyer',$log);
        }else{
            if($this->session->userdata("store_info")){
                $datastore=array('val'=>array(),'table'=>'user_store_info','where'=>array('user_id'=>$this->userid));
                $log['storedata']=$this->common->getdata($datastore);

                $comment1=array('val'=>'s.social_id,s.link,s.id,s1.title,s1.url,s1.image','table'=>'social_link_user as s','where'=>array('s.user_id'=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
                $multijoin1=array(
                    array('table'=>'social_link as s1','on'=>'s.social_id=s1.id','join_type'=>''),
                );
                $log['socialdata']=$this->common->multijoin($comment1,$multijoin1);

                $this->load->view('userlogin/profile/vw_profile_seller_store',$log);
            }else{

                $comment1=array('val'=>'s.social_id,s.link,s.id,s1.url','table'=>'social_link_user as s','where'=>array('s.user_id'=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
                $multijoin1=array(
                    array('table'=>'social_link as s1','on'=>'s.social_id=s1.id','join_type'=>''),
                );
                $log['socialdata']=$this->common->multijoin($comment1,$multijoin1);

                $this->load->view('userlogin/profile/vw_profile_seller',$log);
            }
        }

        $this->load->view('include/footer');
    }*/
    private function userinfo(){
        if($this->session->userdata('user_type')=="2"){
            $this->_buyerinfo();
        }else{
            $this->_sellerinfo();
        }
    }

    private function _sellerinfo(){
        $userid=$this->session->userdata('user_id');

        $log=$this->_getuser($userid);

        $data=array('val'=>array('id','title'),'table'=>'social_link','where'=>array('status'=>'1'));
        $log['social']=$this->common->getdata($data);

        $comment1=array('val'=>'s.social_id,s.link,s.id,s1.title,s1.url,s1.image','table'=>'social_link_user as s','where'=>array('s.user_id'=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'social_link as s1','on'=>'s.social_id=s1.id','join_type'=>''),
        );
        $log['socialdata']=$this->common->multijoin($comment1,$multijoin1);

//        DDB 12-09-2017 Made change to support Business type
//        $data=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
        $data=array('val'=>array('id','business_type_name'),'table'=>'business_types','where'=>array('status'=>'Active'));
        $log['businesstype']=$this->common->getdata($data);



        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');

        if($this->session->userdata("store_info")){
//echo "thr";exit;
                $datastore=array('val'=>array('u.*','s.state as state_name'),'table'=>'user_store_info u','where'=>array('u.user_id'=>$this->userid));
                $multijoin3=array(
                    array('table'=>'statelist as s','on'=>'u.state=s.id','join_type'=>'left'),
                );
                $log['storedata']=$this->common->multijoin($datastore,$multijoin3);
//                $log['storedata']=$this->common->getdata($datastore);
                $datatheme=array('val'=>array('theam_id'),'table'=>'db_theem','where'=>array('user_id'=>$this->userid));
                $log['theme']=$this->common->getdata($datatheme);

//            DDB 12-09-2017 Made change to support Business type
//                $comment2=array('val'=>'bt.category,bt.id','table'=>'user_business_type as ubt','where'=>array('ubt.user_id'=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'ubt.id','orderas'=>'DESC');
                $comment2=array('val'=>'bt.business_type_name,bt.id','table'=>'user_business_type as ubt','where'=>array('ubt.user_id'=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'ubt.id','orderas'=>'DESC');
//            DDB 12-09-2017 Made change to support Business type
//                $multijoin2=array(
//                    array('table'=>'category as bt','on'=>'ubt.business_id=bt.id','join_type'=>''),
//                );
                $multijoin2=array(
                    array('table'=>'business_types as bt','on'=>'ubt.business_id=bt.id','join_type'=>'left'),
                );
                $log['userbusinesstype']=$this->common->multijoin($comment2,$multijoin2);

                $log['locations']=$this->get_location($userid, $log['storedata']);

                //print_r($log['userbusinesstype']);exit;

                $this->load->view('userlogin/profile/vw_profile_seller_store',$log);
            }else{
                //echo "thr1";exit;
                $this->load->view('userlogin/profile/vw_profile_seller',$log);
            }

             $this->load->view('include/footer');
    }

    private function _buyerinfo(){
        $userid=$this->session->userdata('user_id');
        $log=$this->_getuser($userid);
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/profile/vw_profile_buyer',$log);
        $this->load->view('include/footer');
    }

    public function getsociallink($id){

        /*$data=array('val'=>array('url','image'),'table'=>'social_link','where'=>array('id'=>$id));
        $log=$this->common->getdata($data);*/
        $this->db->select('url,image');
        $query=$this->db->get_where('social_link',array('id'=>$id));
        $log=$query->row();
        if($log){
            echo json_encode(array("status"=>true,'sociallink'=>$log));
        }
    }


    public function infoblank(){
        $this->session->set_flashdata("warning","Kindly fill the store information, before switching on other section.");
        //redirect('profile','refresh');
        $this->userinfo();
    }

    public function updateprofilepic(){
        //print_r($_FILES);exit;
            //redirect("profile","refresh");
        $this->check_img_size("profile");
        $userfile='file';
        $image_path='assets/image/user/';
        $allowed='jpg|png|jpeg';
        $max_size='1024';

        $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"120","width"=>"120","ratio"=>true));
        //print_r($fileupload);exit;

        if($fileupload['status']){
            $userdata=array("table"=>"user_Info","where"=>array("id"=>$this->userid),"val"=> array("profile_Pic"));
            $user=$this->common->getsinglerow($userdata);
            if($user['rows']->profile_Pic!="nophoto.png"){
                $path="assets/image/user/".$user['rows']->profile_Pic;
                if(file_exists($path)){
                unlink($path);}
                $path="assets/image/user/thumb/".$user['rows']->profile_Pic;
                if(file_exists($path)){
                unlink($path);}
            }
        $data=array('table'=>'user_Info','where'=>array('id'=>$this->userid),'val'=>array('profile_Pic'=>$fileupload['filename']));
        $log=$this->common->update_data($data);
        //exit;
            $this->session->set_userdata('user_image',$fileupload['filename']);
            $this->session->set_flashdata("sucess","Your profile picture updated successfully.");
            redirect("profile","refresh");
        }else{
            $this->session->set_flashdata("warning",$fileupload["error"]);
            redirect("profile","refresh");
        }
    }


    public function edit($id){
        if($id==$this->userid){
        if($this->session->userdata('user_type')=="2"){
            $this->_editbuyer($id);
        }else{
            $this->_editseller($id);
        }
        }else{
            $this->invalid_user();
        }
    }


    private function _editbuyer($userid){
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $log=$this->_getuser($userid);
        $log['states']=$this->get_states();
        $this->load->view('userlogin/profile/vw_edit_profile_buyer',$log);
        $this->load->view('include/footer');
    }


    private function _editseller($userid){
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $log=$this->_getuser($userid);
        $data=array('val'=>array('id','title'),'table'=>'social_link','where'=>array('status'=>'1'));
        $log['social']=$this->common->getdata($data);
        $datastore=array('val'=>array(),'table'=>'user_store_info','where'=>array('user_id'=>$this->userid));
        $log['storedata']=$this->common->getdata($datastore);
        $comment1=array('val'=>'s.social_id,s.link,s.id,s1.url','table'=>'social_link_user as s','where'=>array('s.user_id'=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'social_link as s1','on'=>'s.social_id=s1.id','join_type'=>''),
        );

        // DDB 12-07-2017 Modified to support Business Types
        //$data=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
        $data=array('val'=>array('id','business_type_name'),'table'=>'business_types','where'=>array('status'=>'Active'));
        $log['businesstype']=$this->common->getdata($data);

        // DDB 12-07-2017 Modified to support Business Types
        $comment2=array('val'=>'bt.business_type_name,bt.id','table'=>'user_business_type as ubt','where'=>array('ubt.user_id'=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'ubt.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'business_types as bt','on'=>'ubt.business_id=bt.id','join_type'=>''),
        );
        $log['userbusinesstype']=$this->common->multijoin($comment2,$multijoin2);

        $log['socialdata']=$this->common->multijoin($comment1,$multijoin1);
        $datatheme=array('val'=>array('theam_id'),'table'=>'db_theem','where'=>array('user_id'=>$this->userid));
        $log['theme']=$this->common->getdata($datatheme);
        $log['states']=$this->get_states();
        $log['locations']=$this->get_location($userid, $log['storedata']);

        $this->load->view('userlogin/profile/vw_edit_profile_seller',$log);
        $this->load->view('include/footer');
    }

    public function get_location($userid, $store_info=null){
        $result = array(
            'res' => false,
            'rows' => []
        );
        $locations = parent::get_location($userid);
        if(!is_null($locations['rows'])){
            $result['rows'] = $locations['rows'];
        }
        $result = is_null($result) ? [] : $result;
        $store_info_item = !is_null($store_info) ? $store_info['rows'][0]: null;
        if(!is_null($store_info_item) && !empty($store_info_item->business_name)){
            $main_location = array(
                "id" => 0,
                "location_name" => "Main Location",
                "business_name" => $store_info_item->business_name,
                "address" => $store_info_item->address,
                "city" => $store_info_item->city,
                "state" => $store_info_item->state,
                "zip_code" => $store_info_item->zip,
                "phone" => $store_info_item->phone,
                "onsite_vendor" => 1,
                "virtual_vendor" => 1,
                "status" => 1
            );
            $main_location = json_decode(json_encode($main_location), FALSE);
            array_unshift($result['rows'],$main_location);
            $result['res'] = true;
        }
        return $result;
    }

    public function updateLocation(){
        $userid = $userid=$this->session->userdata('user_id');
        $location_info=$this->input->post("location_info");
        $location_id = $location_info['id'];
        $location_info['user_id'] = $userid;
        $result = false;

        if(!empty($location_id))
        {
            if($location_id == 0 ){
                $this->session->set_flashdata("warning","Main Location is not editable.");
                echo json_encode(['status'=>TRUE,'success'=>TRUE]);
                die;
            }
            $updatedata=array(
                'table'=>'user_location',
                'where'=>array('id'=>$location_id),
                'val'=>$location_info
                );
            $result=$this->common->update_data($updatedata);
        }else{
            unset($location_info['id']);
            $adddata=array(
                'table'=>'user_location',
                'val'=>$location_info
                );
            $result=$this->common->add_data($adddata);
        }

        if($result)
        {
            $this->session->set_flashdata("sucess","Your Location has been updated.");
        }else{
            $this->session->set_flashdata("warning","Location update failed.");
        }
        $this->session->set_flashdata("tab","location");
        echo json_encode(['status'=>TRUE,'success'=>$result]);
        die;
    }

    public function deleteLocation(){
        $location_id=$this->input->post("id");
        $deletedata=array(
            'table'=>'user_location',
            'where'=>array('id'=>$location_id)
        );
        $result=$this->common->delete_data($deletedata);
        echo json_encode(['status'=>TRUE,'success'=>$result]);
        die;
    }
    public function update(){
        $basic_info=$this->input->post("basic_info");

        if($basic_info){

            $this->form_validation->set_rules('f_name','First Name','trim|required');
            $this->form_validation->set_rules('l_name','Last Name','trim|required');
            $this->form_validation->set_rules('mobile','mobile','trim|required');
            $this->form_validation->set_rules('city','City','trim|required');
            $this->form_validation->set_rules('state','State','trim|required');
            $this->form_validation->set_rules('address1','Address','trim|required');

            if($this->form_validation->run()){
                $f_name=$this->input->post("f_name");
                $l_name=$this->input->post("l_name");
                $mobile=$this->input->post("mobile");
                $state=$this->input->post("state");
                $city=$this->input->post("city");
                $zip2=$this->input->post("zip2");
                $address1=$this->input->post("address1");
                $updatedata=array('table'=>'user_Info','where'=>array('id'=>$this->userid),'val'=>array('f_name'=>$f_name,'l_name'=>$l_name,'mobile_no'=>$mobile,'state'=>$state,'city'=>$city,'zip'=>$zip2,'address1'=>$address1));
                $updatelog=$this->common->update_data($updatedata);
                $this->session->set_flashdata("sucess","Your information has been successfully updated.");
                redirect('profile','refresh');
            }
            else{
                redirect("profile/edit/$this->userid","refresh");
            }

        }
        $this->form_validation->set_rules('f_name','First Name','trim|required');
        $this->form_validation->set_rules('l_name','Last Name','trim|required');
        $this->form_validation->set_rules('themeid','Theme','trim|required');
        $this->form_validation->set_rules('business_type[]','Business Type','trim|required');
        $this->form_validation->set_rules('business-name','Business Name','trim|required');
        $this->form_validation->set_rules('contact-person','Contact Person Name','trim|required');
        $this->form_validation->set_rules('phone','Phone','trim|required');
        $this->form_validation->set_rules('state','State','trim|required');
        $this->form_validation->set_rules('city','City','trim|required');
        $this->form_validation->set_rules('address','Address','trim|required');
        $this->form_validation->set_rules('zip2','Zip2','trim|required');
        $this->form_validation->set_rules('address1','Address1','trim|required');
        $this->form_validation->set_rules('state2','State2','trim|required');
        $this->form_validation->set_rules('city2','City2','trim|required');
        $this->form_validation->set_rules('zip','Zip','trim|required');

        if($this->form_validation->run()){
            $f_name=$this->input->post("f_name");
            $l_name=$this->input->post("l_name");
            $mobile=$this->input->post("mobile");
            $state=$this->input->post("state");
            $city=$this->input->post("city");
            $address1=$this->input->post("address1");
            $themeid=$this->input->post("themeid");
            $business_type=$this->input->post("business_type");
            $business_name=$this->input->post("business-name");
            $contact_person=$this->input->post("contact-person");
            $phone=$this->input->post("phone");
            $address=$this->input->post("address");
            $social_media=$this->input->post("social-media");
            $link=$this->input->post("link");
            $zip=$this->input->post("zip");
            $state2=$this->input->post("state2");
            $city2=$this->input->post("city2");
            $zip2=$this->input->post("zip2");
            $income=$this->input->post("income");
		if($income==''){$income=0;}
            $certification=$this->input->post("certification");
            $farmsize=$this->farmincome($income);
            //echo $farmsize;exit;

            $getlanglat=$this->geozip->get_zip_point($zip);
            //print_r($getlanglat);exit;
            $data=array('table'=>'user_store_info',"where"=>array("user_id"=>$this->userid),'val'=>array('user_id'=>$this->userid,'business_name'=>$business_name,'contact_person_name'=>$contact_person,'phone'=>$phone,'address'=> $address,'city'=>$city2,'state'=>$state2,'zip'=>$zip,'lat'=>$getlanglat->lat,'lng'=>$getlanglat->lng,"size"=>$farmsize,"income"=>$income,'certification'=>$certification));
            $log=$this->common->update_data($data);

            $updatedata=array('table'=>'user_Info','where'=>array('id'=>$this->userid),'val'=>array('f_name'=>$f_name,'l_name'=>$l_name,'mobile_no'=>$mobile,'city'=>$city,'state'=>$state,'address1'=>$address1,'zip'=>$zip2));
            $updatelog=$this->common->update_data($updatedata);

            $data=array("table"=>"db_theem","val"=>"id","where"=>array("user_id"=>$this->userid,'theam_id'=>$themeid));
             $logdata=$this->common->getsinglerow($data);
             if(!$logdata['res']){
            $updatelog1=$this->editmodel->addNewUserData($this->userid,$themeid);
             }

            $deletesocial=array('table'=>'social_link_user','where'=>array('user_id'=>$this->userid));
            $this->common->delete_data($deletesocial);

            for($i=0;$i<count($social_media);$i++){
                $value[]=array('user_id'=>$this->userid,'social_id'=>$social_media[$i],'link'=>$link[$i]);
            }
            $socialdata=array('table'=>'social_link_user','val'=>$value);
            $sociallog=$this->common->insert_multi_row($socialdata);

            $deleteuserbusinesstype=array('table'=>'user_business_type','where'=>array('user_id'=>$this->userid));
            $this->common->delete_data($deleteuserbusinesstype);

            foreach($business_type as $business){
                $bs_type[]=array('user_id'=>$this->userid,'business_id'=>$business);
            }

            $data2=array('table'=>'user_business_type','val'=>$bs_type);
            $log2 = $this->common->insert_multi_row($data2);


            $this->session->set_flashdata("sucess","Your information has been successfully updated/theme changed.");
            redirect('profile','refresh');

        }else{
            redirect("profile/edit/$this->userid","refresh");
        }
    }


    public function farmincome($income){

        $this->db->from("farm_size");
        $query=$this->db->get();
        if($query -> num_rows() > 0){
            $res=$query->result();
            for($i=0;$i<count($res);$i++){
                $result=$res[$i];
                //echo $result->to.' _ '.$result->from.'='.($result->to-$result->from).'<br/>';
                if(($result->to - $result->from) > 0){
                    if($income >= $result->from && $income < $result->to){
                        return $result->size;
                    }
                }else{
                    return $result->size;
                }
            }
        }else{
            return 1;
        }

    }


    public function updatebuyerprofile(){
        $this->form_validation->set_rules('f_name','First Name','trim|required');
        $this->form_validation->set_rules('l_name','Last Name','trim|required');
        $this->form_validation->set_rules('phone','Phone','trim|required');
        $this->form_validation->set_rules('state','State','trim|required');
        $this->form_validation->set_rules('zip','Zip','trim|required');
        $this->form_validation->set_rules('city','City','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required');
        //$this->form_validation->set_rules('address','Address','trim|required');
        if($this->form_validation->run()){
            $f_name=$this->input->post("f_name");
            $l_name=$this->input->post("l_name");
            $phone=$this->input->post("phone");
            $state=$this->input->post("state");
            $zip=$this->input->post("zip");
            $city=$this->input->post("city");
            $email=$this->input->post("email");
            $address=$this->input->post("address");

            $updatedata=array('table'=>'user_Info','where'=>array('id'=>$this->userid),'val'=>array('f_name'=>$f_name,'l_name'=>$l_name,'mobile_no'=>$phone,'state'=>$state,'city'=>$city,'zip'=>$zip,'address1'=>$address,'email_id'=>$email));
            $updatelog=$this->common->update_data($updatedata);

            if($updatedata){
                $this->session->set_flashdata("sucess","Successfully update profile.");
                redirect('profile','refresh');
            }
        }else{
            redirect("profile/edit/$this->userid","refresh");
        }

    }

        public function addsocial(){
        $social_media=$this->input->post("social-media");
        $link=$this->input->post("link");

        $deletesocial=array('table'=>'social_link_user','where'=>array('user_id'=>$this->userid));
            $this->common->delete_data($deletesocial);

        for($i=0;$i<count($social_media);$i++){
                $value[]=array('user_id'=>$this->userid,'social_id'=>$social_media[$i],'link'=>$link[$i]);
            }
            $socialdata=array('table'=>'social_link_user','val'=>$value);
            $sociallog=$this->common->insert_multi_row($socialdata);

            $this->session->set_flashdata("sucess","Successfully add social link.");
            redirect('profile','refresh');
    }

    public function changepassword(){

        $this->form_validation->set_rules('ops','Old Password','trim|required');
        $this->form_validation->set_rules('nps','New Password','trim|required|matches[cps]');
        $this->form_validation->set_rules('cps','Confirm Password','trim|required');

        //$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]|matches[password_confirm]');
        //$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

        if($this->form_validation->run()){
            //echo "hhh";exit;

            $ops=$this->input->post('ops');
            $nps=$this->input->post('nps');
            $cps=$this->input->post('cps');

            //if($nps==$cps){

                    $data= array('table' => 'user_Info','where' => array('id' => $this->userid,'password' => md5($ops)));
                    $log = $this->common->getNofrows($data);

                    if($log == 1){
                        $data=array('val'=>array( 'password'=>md5($nps) , 'pass2'=>$nps ),'table'=>'user_Info','where' => array('id'=>$this->userid));
                        $log= $this->common->update_data($data);

                        if($log){
                                $this->session->set_flashdata('sucess','Successfully change password.');
                                redirect('profile/changepassword/', 'refresh');

                        }

                    }else{
                            $this->session->set_flashdata('warning','Old password not correct.');
                            redirect('profile/changepassword/', 'refresh');
                    }

            /*}else{
                    $this->session->set_flashdata('warning','New Password and Confirm Password Should be Same');
                    redirect('profile/changepassword/', 'refresh');
            }*/
        }else{
        $userid=$this->session->userdata('user_id');
        $log=$this->_getuser($userid);

        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/profile/vw_changepassword',$log);
        $this->load->view('include/footer');
        }
    }



    public function update_acc_info(){
        $accno=$this->input->post('acno');
        $routno=$this->input->post('routno');
        $createsubmerchant=$this->createsubmerchant($accno,$routno);
        if($createsubmerchant['status']){echo json_encode(array('status'=>true,'message'=>"Your account information updated successfully."));}else{
            echo json_encode(array('status'=>false,'message'=>$createsubmerchant['msg']));
        }
    }


    public function createsubmerchant($acno=0,$routno=0){
        // make data for create sub-merchant a/c for sellers
        $this->load->library('Braintree');
        $sellerinfo=$this->getsellers(array('f_name','l_name','mobile_no','email_id','state'),array('id'=>$this->userid));
        $sellerinfo1=$sellerinfo['rows'][0];
        $state=$this->db->get_where('statelist',array('id'=>$sellerinfo1->state))->row();
        $user_store_info=$this->db->get_where('user_store_info',array('user_id'=>$this->userid))->row();
        $sub_merchant_data=array('individual'=>array('firstName'=>$sellerinfo1->f_name,'lastName'=>$sellerinfo1->l_name,'email'=>$sellerinfo1->email_id,'phone'=>$sellerinfo1->mobile_no,'address'=>array('streetAddress'=>$user_store_info->address,'locality'=>$state->state,'region'=>$state->code,'postalCode'=>$user_store_info->zip)),'funding'=>array('descriptor'=>$user_store_info->business_name,'email'=>'','mobilePhone'=>'','accountNumber'=>$acno,'routingNumber'=>$routno));
        $sub_merchant_account=$this->braintree->create_sub_merchant($sub_merchant_data);
        if(!$sub_merchant_account['status']){return array('status'=>false,'msg'=>$sub_merchant_account['errorMessage']);}
        else{
            $data=array('table'=>'user_store_info','val'=>array('acc_no'=>$acno,'rout_no'=>$routno,'merchant_id'=>$sub_merchant_account['number']),'where'=>array('user_id'=>$this->userid));
            $log=$this->common->update_data($data);
            if($log) return array('status'=>true);
        }

    }






}
