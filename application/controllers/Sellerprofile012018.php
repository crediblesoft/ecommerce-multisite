<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sellerprofile extends MY_Controller {
    private $userid;
    
    function __construct()
    {
        parent::__construct();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        $this->load->library('Geozip');
    }
    
    public function index($username)
    {   
         $comment1=array('val'=>'u.address1,s.state,u.id,u.username,u.f_name,u.l_name,u.type_Of_User,u.profile_Pic,si.business_name,si.address,si.zip,GROUP_CONCAT(bt.category SEPARATOR ",") as business_type','table'=>'user_Info as u','where'=>array("u.username"=>$username),'minvalue'=>'','group_by'=>'u.id','start'=>'','orderby'=>'u.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_store_info as si','on'=>'u.id=si.user_id','join_type'=>'left'),
                array('table'=>'user_business_type as ubt','on'=>'u.id=ubt.user_id','join_type'=>'left'),
                array('table'=>'category as bt','on'=>'ubt.business_id=bt.id','join_type'=>'left'),
                array('table'=>'statelist as s','on'=>'u.state=s.id','join_type'=>'left'),
            );

        $resp['featureduser']=$this->common->multijoin($comment1,$multijoin1);
        
        $userid=$this->getuserid($username);
        
        $comment2=array('val'=>'r.id,r.stars,r.reviews,r.date,r.revuserid as RevuserId,r.userid as WriteReviewuserId,u.f_name,u.l_name','table'=>'userreviews as r','where'=>array('r.revuserid'=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'r.id','orderas'=>'DESC');
            $multijoin2=array(
                array('table'=>'user_Info as u','on'=>'r.userid=u.id','join_type'=>''),
            ); 
            
        $resp['reviews']=$this->common->multijoin($comment2,$multijoin2);
       //echo "<pre>";
       //print_r($resp);exit;
        $this->load->view('include/header');
        $this->load->view('sellerprofile/vw_sellerprofile',$resp);
        $this->load->view('include/footer');
    }
    
    
    public function product($username)
    {   
        $userid=$this->getuserid($username);
        $data3=array("table"=>"user_Info","val"=>"id","where"=>array("id"=>$userid));
        $log3=$this->common->getsinglerow($data3);
        if(!$log3['res']){
            redirect("_404","refresh");
        }
        $current_date=date("Y-m-d");

        //end seller list
        $comment1=array('val'=>'cat.category,cat.id as catid,p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.no_of_Prod,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username','table'=>'product as p','where'=>array("p.user_id"=>$userid,"p.status"=>"1","p.no_of_Prod > "=> '0','p.admin_status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.paid','orderas'=>'DESC');
        //$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.no_of_Prod,p.bid_status,p.pord_detail,usi.certification,usi.size','table'=>'product as p','where'=>"(`p`.`category` = '$catid' AND `p`.`status` = '1' AND `p`.`no_of_Prod` > '0') AND CASE `p`.`bid_status` WHEN '1' THEN ( `auc`.`bid_end_date` >= '$current_date'  AND `auc`.`status`='1') ELSE 1=1 END ",'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
        );

	$resp['username']= $username;
        $resp['userid']= $userid;
        
        $data=array("min"=>array("field"=>'prod_price',"as"=>'min'),"max"=>array("field"=>'prod_price',"as"=>'max'),"table"=>"product","where"=>array("user_id"=>$userid,"status"=>"1","no_of_Prod > "=> '0'));
        $resp['price']=$this->common->getminmax($data);          

        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "sellerproduct/$username";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
         //echo $this->db->last_query();  
//          echo "<pre>";
//        print_r($resp['products']);exit;

//	$cookie= array(
//                'name'   => 'savesearch',
//                'value'  => $this->db->last_query(),
//                'expire' => '86500',
//            );
//            $this->set_cookie($cookie);
            
        $this->load->view('include/header');
        $this->load->view('sellerprofile/vw_sellerproduct',$resp);
        $this->load->view('include/footer');
    }
    
    public function searchbydistance($username){
            $userid=$this->getuserid($username);
            $zip=$this->input->get('zip');
            $distance=$this->input->get('distance');
            $city=$this->input->get('city');
            $state=$this->input->get('state');
            
        
        $current_date=date("Y-m-d");
            
        if(($zip!='' || $city!='') && $distance!=''){
            
            //$this->geozip->getzip($zip,$distance,$city);
            //$nearest_zip=implode(',',$this->geozip->getNearByZipcods($zip,$distance,$city,$state));
            //echo $nearest_zip;exit;
            $user_id=$this->searchbydistance1($zip,$city,$distance);
            //print_r($user_id); exit;
            $flag=0;
            if(count($user_id)==0){
                $flag=1;
            }
            //$userid=  implode(',', $user_id);
            $userid111=  implode(',', $user_id);
            //print_r($userid); exit;
            $comment1=array('val'=>'count(p.id) as ct,cat.category,cat.id as catid,p.id as prod_id,p.prod_name,p.prod_price,p.no_of_Prod,p.status,p.prod_img,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username','table'=>'product as p','where'=>array("p.user_id"=>$userid,"p.status"=>"1","p.no_of_Prod >"=>'0','p.admin_status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'u.paid','orderas'=>'DESC','in'=>'','in_value'=>'');
            if(!$flag){
                $comment1['in']='p.user_id';
                $comment1['in_value']=$user_id;
            }
            $multijoin1=array(  
                array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
                array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
            );
            //echo $this->db->last_query(); exit; 
        }else{
            $this->session->set_flashdata("get_vali_error","true");
            $comment1=array('val'=>'count(p.id) as ct,cat.category,cat.id as catid,p.id as prod_id,p.prod_name,p.prod_price,p.no_of_Prod,p.status,p.prod_img,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username','table'=>'product as p','where'=>array("p.user_id"=>$userid,"p.status"=>"1","p.no_of_Prod >"=>'0','p.admin_status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'u.paid','orderas'=>'DESC','in'=>'','in_value'=>'');
            $multijoin1=array(  
                array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
                array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
            );
           // echo $this->db->last_query(); exit;
        }
        
//        $test=$this->common->multijoin_with_in($comment1,$multijoin1);
//        echo "<pre>";
//        print_r($test);exit;
        
	$resp['username']= $username;
        $resp['userid']= $userid;
        
        $data=array("min"=>array("field"=>'prod_price',"as"=>'min'),"max"=>array("field"=>'prod_price',"as"=>'max'),"table"=>"product","where"=>array("user_id"=>$userid));
        $resp['price']=$this->common->getminmax($data);          

        $table=$this->common->multijoin_with_in($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "sellerproduct/searchbydistance/$username/?zip=$zip&distance=$distance&city=$city&state=$state";
        $config["total_rows"] = ($table['res'])?count($table['rows']) :0;
        $config["per_page"] = 15;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin_with_in($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
           //echo $this->db->last_query();exit;  
        //print_r($resp["price"]);exit;

//	$cookie= array(
//                'name'   => 'savesearch',
//                'value'  => $this->db->last_query(),
//                'expire' => '86500',
//            );
//            $this->set_cookie($cookie);
        if($flag){
            $resp['products']['res']=false;
        }
        
         $this->load->view('include/header');
        $this->load->view('sellerprofile/vw_sellerproduct',$resp);
        $this->load->view('include/footer');
        
    }
    
    
//    public function searchbydistance1($zip,$city,$distance){
////            $state=$this->input->get('state');
//            $getlanglat=$this->geozip->get_zip_point($zip,$city);
//            //print_r($getlanglat);
//            //$query="SELECT user_id, lat, lng, (( 3959 * acos( cos( radians('$getlanglat->lat') ) * cos( radians( 'lat' ) ) * cos( radians( 'lng' ) - radians('$getlanglat->lng') ) + sin( radians('$getlanglat->lat') ) * sin( radians( 'lat' ) ) ) )/1000) AS distance FROM user_store_info HAVING distance < '$distance' AND lat!='0' AND lng!='0' ORDER BY distance";
//            $query="SELECT user_id, lat, lng, ( 3959 * acos( cos( radians($getlanglat->lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($getlanglat->lng) ) + sin( radians($getlanglat->lat) ) * sin(radians(lat)) ) ) AS distance  FROM user_store_info HAVING distance < $distance AND lat!='0' AND lng!='0' ORDER BY distance";
//            //$query="SELECT user_id, lat, lng FROM user_store_info WHERE DISTANCE(Location__c, GEOLOCATION($getlanglat->lat,$getlanglat->lng), 'km') < $distance ";
//            //echo "<br/>".$query;
//            $res=$this->db->query($query);
//            $row=$res->result();
//            //echo "<pre>";
//            //print_r($row);exit;
//            $userid=array();
//            if(count($row)>0){
//            foreach($row as $user){
//                array_push($userid, $user->user_id);
//            }
//                return $userid;
//            }else{
//                return $userid;
//            }
//            
//    }
    
    public function searchbydistance1($zip,$city,$distance){
//            $state=$this->input->get('state');
            $getlanglat=$this->geozip->get_zip_point($zip,$city);
			if($getlanglat->lat=='' || $getlanglat->lng==''){
				return $userid=array();
			}
            //print_r($getlanglat); 
            //$query="SELECT user_id, lat, lng, (( 3959 * acos( cos( radians('$getlanglat->lat') ) * cos( radians( 'lat' ) ) * cos( radians( 'lng' ) - radians('$getlanglat->lng') ) + sin( radians('$getlanglat->lat') ) * sin( radians( 'lat' ) ) ) )/1000) AS distance FROM user_store_info HAVING distance < '$distance' AND lat!='0' AND lng!='0' ORDER BY distance";
            $query="SELECT user_id, lat, lng, ( 3959 * acos( cos( radians($getlanglat->lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($getlanglat->lng) ) + sin( radians($getlanglat->lat) ) * sin(radians(lat)) ) ) AS distance  FROM user_store_info HAVING distance < $distance AND lat!='0' AND lng!='0' ORDER BY distance";
            //$query="SELECT user_id, lat, lng FROM user_store_info WHERE DISTANCE(Location__c, GEOLOCATION($getlanglat->lat,$getlanglat->lng), 'km') < $distance ";
            //echo "<br/>".$query;
            $res=$this->db->query($query);
            $row=$res->result();
            //echo "<pre>";
            //print_r($row); exit;
            $userid=array();
            if(count($row)>0){
            foreach($row as $user){
                array_push($userid, $user->user_id);
            }
            
            
            //print_r($userid); exit;
            
                return $userid;
            }else{
                return $userid;
            }
            
    }
   
    
}
