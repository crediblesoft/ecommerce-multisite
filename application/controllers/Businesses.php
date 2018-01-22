<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Businesses extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        //$this->functions->_afterloginpage_delete();
        //$this->load->library('MY_Pagination');
    }
    
    public function index($busid)
    {   
        $resp['businessid']=$busid;	
    //   echo "In index function";exit;
    //    $data=array("table"=>"recipe_category","val"=>array(),"where"=>array("status"=>"1"));
    //    $resp['allcategory']=$this->common->getdata($data);
        $data=array("table"=>"business_types","val"=>array(),"where"=>array("status"=>"Active"));
        $resp['allbusinesstypes']=$this->common->getdata($data);
        //for ads
        //$comment3=array('table'=>'ads_subscription as assb','val'=>'u.id as userid,u.username,assb.*','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'assb.id','orderas'=>'DESC');
        $comment3="SELECT ads.*,uifo.id as seller_id,uifo.username FROM ads_subscription as ads LEFT JOIN user_Info as uifo on ads.user_id=uifo.id  where ads.paid_status='1' AND ads.status='1' ORDER BY RAND()  limit 0,1";
        $resp['ads']=$this->common->dbQuery($comment3);
        //echo "<pre>";
        //print_r($resp); exit;
        
        //$comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid,cat.category','where'=>array("rs.recipe_stetus"=>'1','u.status'=>'1',"rs.admin_status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC');
//        $comment1=array('table'=>'recipe as rs','val'=>'u.status as user_status,u.type_Of_User,u.store_info, u.id,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid,cat.category','where'=>array("rs.recipe_stetus"=>'1',"rs.admin_status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC');
//		$multijoin1=array(
//            array('table'=>'user_Info as u','on'=>'u.id=rs.user_id','join_type'=>'left'),
//            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
//        );
        //$table=array("table"=>"recipe","where"=>array("recipe_stetus"=>'1'));
        //$recipetotal=$this->common->multijoin($comment1,$multijoin1);
        //print_r(count($recipetotal['rows']));exit;
        $comment1=array('val'=>'u.address1,s.state,u.id,u.username,u.f_name,u.l_name,u.type_Of_User,u.profile_Pic,si.business_name,si.address,si.zip,u.featured,u.status,bt.id,GROUP_CONCAT(bt.business_type_name SEPARATOR ",") as business_type','table'=>'business_types as bt','where'=>array("bt.id"=>$busid,'u.status'=>'1','u.verified'=>'1'),'minvalue'=>'','group_by'=>'u.id','start'=>'','orderby'=>'u.id','orderas'=>'DESC');
            $multijoin1=array(
                array('table'=>'user_business_type as ubt','on'=>'bt.id=ubt.business_id','join_type'=>'left'),
                array('table'=>'user_Info as u','on'=>'ubt.user_id=u.id','join_type'=>'left'),
                array('table'=>'user_store_info as si','on'=>'u.id=si.user_id','join_type'=>'left'),
                array('table'=>'statelist as s','on'=>'u.state=s.id','join_type'=>'left'),
            );

        $businesstotal=$this->common->multijoin($comment1,$multijoin1);

        $config = array();
        $config["base_url"] = BASE_URL. "businesstypes/$busid";
     //    if($businesstotal['res']){
     //   $config["total_rows"] = count($businesstotal['rows']);}else{$config["total_rows"] ="";}
        $config["total_rows"] = ($businesstotal['res'])?count($businesstotal['rows']):0;
        $config["per_page"] = 9;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['featureduser']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
      // echo $config["per_page"];echo " ".$page;echo " ".$config["total_rows"];exit;
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo $this->db->last_query();
        //print_r($resp['recipe']);exit;
        
        $this->load->view('include/header');
        $this->load->view('businesstypes/Businesses',$resp);
        $this->load->view('include/footer');
       
    }
    
    
    public function filter(){
   $businessid1=$this->input->post("businessid");$businessid=trim($businessid1);
        $category1=$this->input->post("category");$category=trim($category1);
        $username1=$this->input->post("username");$username=trim($username1);
        $bus_name1=$this->input->post("bus_name");$bus_name=trim($bus_name1);
        $currentpage=$this->input->post("currentpage");
        $in=array();$in_value=array();$categoryinval=array();
//		$where=array("rs.recipe_stetus"=>'1',"rs.admin_status"=>"1");
//        print_r("Filter ".$businessid);exit;
        $where=array("bt.id"=>$businessid,'u.status'=>'1','u.verified'=>'1');

            if($category!=''){ $where['rs.recipe_type']=$category;
//        $categorydata=array('table'=>'recipe_category','like'=>array('likeon'=>'category','likeval'=>$category),'val'=>array('id'),'where'=>array());
//        $categoryres=$this->common->getdata_like($categorydata);if($categoryres['res']){foreach($categoryres['rows'] as $categoryrows){array_push($categoryinval,$categoryrows->id);}}//print_r($categoryinval);exit;
//        if(count($categoryinval)>0){array_push($in,'recipe_type');array_push($in_value,$categoryinval);}else{array_push($in,'recipe_type');array_push($in_value,0);}
        }
        if($username!=''){
            $query="select id from user_Info where f_name Like '%".$username."%' OR l_name Like '%".$username."%' OR  CONCAT(f_name,' ',l_name) Like '%".$username."%' OR  CONCAT(f_name,'',l_name) Like '%".$username."%' OR username Like '%".$username."%'";
            $result=$this->db->query($query);$users=array();$rows=$result->result();
            foreach($rows as $user){array_push($users, $user->id);}
            $userinval=array_unique($users); //print_r($userinval);exit;
            if(count($userinval)>0){array_push($in,'u.id');array_push($in_value,$userinval);}else{array_push($in,'u.id');array_push($in_value,0);}
        }
        if($bus_name!=''){ $like=array("likeon"=>'si.business_name',"likeval"=>$bus_name);}else{ $like=array(); }
//        $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid,cat.category','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC','like'=>$like,'in'=>$in,'in_value'=>$in_value);
//        $multijoin1=array(
//            array('table'=>'user_Info as u','on'=>'u.id=rs.user_id','join_type'=>'left'),
//            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
//        );
//        echo "Before search query";
        $comment1=array('table'=>'business_types as bt','val'=>'u.address1,s.state,u.id,u.username,u.f_name,u.l_name,u.type_Of_User,u.profile_Pic,si.business_name,si.address,si.zip,u.featured,u.status,GROUP_CONCAT(bt.business_type_name SEPARATOR ",") as business_type','where'=>$where,'minvalue'=>'','group_by'=>'u.id','start'=>'','orderby'=>'u.id','orderas'=>'DESC','like'=>$like,'in'=>$in,'in_value'=>$in_value);
            $multijoin1=array(
                array('table'=>'user_business_type as ubt','on'=>'bt.id=ubt.business_id','join_type'=>'left'),
                array('table'=>'user_Info as u','on'=>'ubt.user_id=u.id','join_type'=>'left'),
                array('table'=>'user_store_info as si','on'=>'u.id=si.user_id','join_type'=>'left'),
                array('table'=>'statelist as s','on'=>'u.state=s.id','join_type'=>'left'),
            );
        //print_r($in);print_r($in_value);exit;
        //$resp=$this->common->multijoin_with_multiin($comment1,$multijoin1);
        $table=$this->common->multijoin_with_multiin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "businesstypes/$busid";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        //print_r($table['rows']);exit;
        $config["per_page"] = 9;
        $config["uri_segment"] = $currentpage;
        $config['next_link'] = FALSE;
        $config['prev_link'] = FALSE;
        $config['page_query_string'] = FALSE;
        $this->pagination->initialize($config); 
        $page = $currentpage;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['featureduser']=$this->common->multijoin_with_multiin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo $this->db->last_query();exit;       
        echo json_encode($resp);
    }

       public function searchbydistance($catid){
            $zip=$this->input->get('zip');
            $distance=$this->input->get('distance');
            $city=$this->input->get('city');
            $state=$this->input->get('state');


            //get all seller who for same business type
        $comment2=array('val'=>'u.f_name,u.l_name,u.username,u.id as userid,u.profile_Pic','table'=>'user_business_type as ubt','where'=>array("ubt.business_id"=>$catid,"status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.paid','orderas'=>'DESC');
        //$comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.no_of_Prod,p.bid_status,p.pord_detail,usi.certification,usi.size','table'=>'product as p','where'=>"(`p`.`category` = '$catid' AND `p`.`status` = '1' AND `p`.`no_of_Prod` > '0') AND CASE `p`.`bid_status` WHEN '1' THEN ( `auc`.`bid_end_date` >= '$current_date'  AND `auc`.`status`='1') ELSE 1=1 END ",'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin2=array(
            array('table'=>'user_Info as u','on'=>'ubt.user_id=u.id','join_type'=>''),
        );
        $resp['sellers']=$this->common->multijoin($comment2,$multijoin2);
        //end seller list

        $current_date=date("Y-m-d");

        if(($zip!='' || $city!='') && $distance!=''){

            //$this->geozip->getzip($zip,$distance,$city);
            //$nearest_zip=implode(',',$this->geozip->getNearByZipcods($zip,$distance,$city,$state));
            //echo $nearest_zip;exit;
            $user_id=$this->searchbydistance1($zip,$city,$distance);
            $flag=0;
            if(count($user_id)==0){
                $flag=1;
            }
            //$userid=  implode(',', $user_id);
            $userid=$user_id;
            $comment1=array('val'=>'count(p.id) as ct,p.id as prod_id,p.prod_name,p.prod_price,p.no_of_Prod,p.status,p.prod_img,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username,s.state','table'=>'product as p','where'=>array("p.category"=>$catid,"p.status"=>"1","p.no_of_Prod >"=>'0','p.admin_status'=>'1','u.status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'u.paid','orderas'=>'DESC','in'=>'','in_value'=>'');
            if(!$flag){
                                $comment1['in']='p.user_id';
                                $comment1['in_value']=$userid;
                        }
                        $multijoin1=array(
                array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
                array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
                                array('table'=>'statelist as s','on'=>'s.id=u.state','join_type'=>'left'),
            );
        }else{
            $this->session->set_flashdata("get_vali_error","true");
            $comment1=array('val'=>'count(p.id) as ct,p.id as prod_id,p.prod_name,p.prod_price,p.no_of_Prod,p.status,p.prod_img,p.bid_status,p.pord_detail,usi.certification,usi.size,usi.business_name,u.username','table'=>'product as p','where'=>array("p.category"=>$catid,"p.status"=>"1","p.no_of_Prod >"=>'0','p.admin_status'=>'1','u.status'=>'1'),"or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'u.paid','orderas'=>'DESC','in'=>'','in_value'=>'');
            $multijoin1=array(
                array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
                array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
                array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
            );

        }
//        $test=$this->common->multijoin_with_in($comment1,$multijoin1);
//        echo "<pre>";
//        print_r($test);exit;

        $resp['category']= $this->getcategory($catid);
        $resp['categoryid']= $catid;

        $data=array("min"=>array("field"=>'prod_price',"as"=>'min'),"max"=>array("field"=>'prod_price',"as"=>'max'),"table"=>"product","where"=>array("category"=>$catid,"status"=>"1","no_of_Prod >"=>'0'));
        $resp['price']=$this->common->getminmax($data);

        $table=$this->common->multijoin_with_in($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "products/searchbydistance/$catid/?zip=$zip&distance=$distance&city=$city&state=$state";
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
       // print_r($resp);exit;
        if($flag==1){
                        $resp["links"]='';
            $resp['products']['res']=false;
        }

        $cookie= array(
                'name'   => 'savesearch',
                'value'  => $this->db->last_query(),
                'expire' => '86500',
            );
            $this->set_cookie($cookie);
        $comment3="SELECT ads.*,uifo.id as seller_id,uifo.username FROM ads_subscription as ads LEFT JOIN user_Info as uifo on ads.user_id=uifo.id  where ads.paid_status='1' AND ads.status='1' AND (ads.title!='' OR ads.html_data!='') ORDER BY RAND()  limit 0,1";
        $resp['ads']=$this->common->dbQuery($comment3);

        $this->load->view('include/header');
        $this->load->view('products/vw_product_list',$resp);
        $this->load->view('include/footer');

    }

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
            //print_r($row);exit;
            $userid=array();
            if(count($row)>0){
            foreach($row as $user){
                array_push($userid, $user->user_id);
            }
                return $userid;
            }else{
                return $userid;
            }

    }

}
