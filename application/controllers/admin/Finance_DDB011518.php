<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
     public function index(){
        
    }
    
    public function track_seller()
    {
       // echo $this->input->get('sortby'); exit;
       if(($this->input->post('fromDate'))&&($this->input->post('fromDate')!=NULL)){ $datefrom=$this->input->post('fromDate');}else{ $datefrom=date('Y').'-01-01';}
       if(($this->input->post('toDate'))&&($this->input->post('toDate')!=NULL)){ $dateto=$this->input->post('toDate');}else{ $dateto=date('Y-m-d');}
//       
//       if($this->input->get('sortby')==1){
//           
//           $check_by=$this->input->get('sortby');
//           $where=array("type_Of_User"=>1,"udf.date>="=>$datefrom,"udf.date<="=>$dateto,"udf.status!="=>5);
//          $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,sum(ts.tax) ,ts.commission','where'=>$where,'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
//        $multijoin1=array(
//            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
//            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>''),
//            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
//            //array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')up.tranc_id, up.price, up.add_date,
//        );  
//       }
//       else{
//            $check_by=$this->input->get('sortby');
           //$check_by='0';
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,ts.tax,ts.commission','where'=>array("type_Of_User"=>1,"udf.date>="=>$datefrom,"udf.date<="=>$dateto),'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>''),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
            //array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')up.tranc_id, up.price, up.add_date,
        );
      // }
       $table=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query(); 
        //echo "<pre>";
        //print_r($table); 
        //exit;
        //echo $test=$table['rows'][0]->tax; exit;
//       if($table['res']){
//           $tax_ttl=0;
//        foreach($table['rows'] as $trackrecords){
//            echo "<br>";
//            //echo $trackrecords->tax;
//           $ttl=$trackrecords->quantity*$trackrecords->price;
//           $ttx=($trackrecords->tax*$ttl)/100;
//           $tax_ttl+=$ttx;
//           echo $tax_ttl;
//       }
//       exit;
//        }
       $resp['newtrackrecord']=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/track_seller/?";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
//        $comment=array('table'=>'user_Info as u','val'=>'up.tranc_id, up.price as themeprice, up.add_date,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic','where'=>array("u.id"=>$userid,"up.add_date>="=>$datefrom,"up.add_date<="=>$dateto),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC');//
//        $multijoin=array(            
//            array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')
//        );
       // $resp['trackrecordexpenses']=$this->common->multijoin($comment,$multijoin);
        $resp['trackrecord']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo "<pre>";
        //print_r($resp); exit;
        $resp['fromDate']=$datefrom;
        $resp['toDate']=$dateto;
         $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_seller',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
//     public function exclude_reject(){
//         
//        //echo "hi"; exit;
//        $selectedid=$this->input->post("select_id");
//        //echo $selectedid[0]; exit;
//        //print_r($selectedid);
//       if(($this->input->post('fromDate'))&&($this->input->post('fromDate')!=NULL)){ $datefrom=$this->input->post('fromDate');}else{ $datefrom=date('Y').'-01-01';}
//       if(($this->input->post('toDate'))&&($this->input->post('toDate')!=NULL)){ $dateto=$this->input->post('toDate');}else{ $dateto=date('Y-m-d');}
//       if($selectedid[0]==1){
//           $where=array("type_Of_User"=>1,"udf.date>="=>$datefrom,"udf.date<="=>$dateto,"udf.status!="=>5);
//       }
//        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,ts.tax,ts.commission','where'=>$where,'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
//        $multijoin1=array(
//            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
//            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>''),
//            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
//            //array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')up.tranc_id, up.price, up.add_date,
//        );
//       
//       $table=$this->common->multijoin($comment1,$multijoin1);
//       
//        //echo $this->db->last_query(); 
//        //echo "<pre>";
//        //print_r($table); 
//        //exit;
//        $config = array();
//        $config["base_url"] = BASE_URL. "admin/finance/exclude_reject/?";
//        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
//        $config["per_page"] = 20;
//        $config["uri_segment"] = $this->input->get('per_page');
//        $config['page_query_string']=true;
//        $this->pagination->initialize($config); 
//        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
//        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
////        $comment=array('table'=>'user_Info as u','val'=>'up.tranc_id, up.price as themeprice, up.add_date,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic','where'=>array("u.id"=>$userid,"up.add_date>="=>$datefrom,"up.add_date<="=>$dateto),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC');//
////        $multijoin=array(            
////            array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')
////        );
//       // $resp['trackrecordexpenses']=$this->common->multijoin($comment,$multijoin);
//        $resp['trackrecord']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
//        $resp["links"] = $this->pagination->create_links();
//        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
//        //echo "<pre>";
//        //print_r($resp); exit;
//        $resp['fromDate']=$datefrom;
//        $resp['toDate']=$dateto;
//          if($resp){
//             // echo "hi";exit;
//            echo json_encode(array("status"=>true,"rows"=>$resp));exit;
//        }
//        
//        else{
//            echo json_encode(array("status"=>false,"message"=>"Data not found."));exit;
//        }
//         $this->load->view('admin/include/admin_header');
//        $this->load->view('admin/include/admin_left');
//        $this->load->view('admin/finance/admin_vw_track_seller',$resp);
//        $this->load->view('admin/include/admin_footer');
//
//    }
    
    public function main_search(){
         $searchby=$this->input->get('searchby');
         $val=$this->input->get('val'); $val=trim($val);
            if($searchby=='seller'){
                $this->search();
            }
            elseif($searchby=='adddate'){
                $this->search_by_date_seller();
            }
            elseif($searchby=='trackdetail'){
                $this->search_by_trackdetail();
            }
             elseif($searchby=='adddate_seller'){
                $this->search_by_dateANDseller();
            }
             elseif($searchby=='adddate_product'){
                $this->search_by_dateANDproduct();
            }
    }
    public function search(){
        //echo $this->input->get('sortby');
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
       //if(($this->input->post('fromDate'))&&($this->input->post('fromDate')!=NULL)){ $datefrom=$this->input->post('fromDate');}else{ $datefrom=date('Y').'-01-01';}
       //if(($this->input->post('toDate'))&&($this->input->post('toDate')!=NULL)){ $dateto=$this->input->post('toDate');}else{ $dateto=date('Y-m-d');}
        if($this->input->get('sortby')==1){
        $check_by=$this->input->get('sortby');
        $where=array("type_Of_User"=>1,"udf.status!="=>5);
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,ts.tax,ts.commission','where'=>$where,'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>''),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );
        }
        else{
            $check_by=$this->input->get('sortby');
            $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,ts.tax,ts.commission','where'=>array("type_Of_User"=>1),'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
            $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>''),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );
        }
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $resp['newtrackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1);
        //echo $this->db->last_query();
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search?&searchby=$searchby&val=$val&sortby=$check_by";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
        //$resp['fromDate']=$datefrom;
        //$resp['toDate']=$dateto;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_seller',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function search_by_date_seller(){
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $from=$this->input->get('from');
        $to=$this->input->get('to');
       //if(($this->input->post('fromDate'))&&($this->input->post('fromDate')!=NULL)){ $datefrom=$this->input->post('fromDate');}else{ $datefrom=date('Y').'-01-01';}
       //if(($this->input->post('toDate'))&&($this->input->post('toDate')!=NULL)){ $dateto=$this->input->post('toDate');}else{ $dateto=date('Y-m-d');}
          if($this->input->get('sortby')==1){
        $check_by=$this->input->get('sortby');
        $where=array("type_Of_User"=>1,"udf.date>="=>$from,"udf.date<="=>$to,"udf.status!="=>5);
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,udf.trans_id,ts.tax,ts.commission','where'=>$where,'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );
        }
        else{
        $check_by=$this->input->get('sortby');
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,udf.trans_id,ts.tax,ts.commission','where'=>array("type_Of_User"=>1,"udf.date>="=>$from,"udf.date<="=>$to),'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );
        }
        $table=$this->common->multijoin($comment1,$multijoin1);
         $resp['newtrackrecord']=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_by_date_seller?searchby=$searchby&from=$from&to=$to&sortby=$check_by";
        //$config["base_url"] = BASE_URL. "admin/finance/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
        //$resp['from']=$from;
        //$resp['to']=$to;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_seller',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function search_by_trackdetail(){
    $searchby=$this->input->get('searchby');    
    $val=$this->input->get('val');$val=trim($val);
    $from=$this->input->get('from');
    $to=$this->input->get('to');
    //echo $val;
    $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,ts.tax,ts.commission','where'=>array("type_Of_User"=>1,'udf.status='=>$val,"udf.date>="=>$from,"udf.date<="=>$to),'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>''),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
         $resp['newtrackrecord']=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query();
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_by_trackdetail?searchby=$searchby&val=$val&from=$from&to=$to";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
        //$resp['fromDate']=$datefrom;
        //$resp['toDate']=$dateto;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_seller',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    //code by pooja
    public function search_by_dateANDseller(){
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $from=$this->input->get('from');
        $to=$this->input->get('to');
        $seller=$this->input->get('seller');
       //if(($this->input->post('fromDate'))&&($this->input->post('fromDate')!=NULL)){ $datefrom=$this->input->post('fromDate');}else{ $datefrom=date('Y').'-01-01';}
       //if(($this->input->post('toDate'))&&($this->input->post('toDate')!=NULL)){ $dateto=$this->input->post('toDate');}else{ $dateto=date('Y-m-d');}
        if($this->input->get('sortby')==1){
        $check_by=$this->input->get('sortby');
        $where=array("udf.date>="=>$from,"udf.date<="=>$to,"udf.status!="=>5);
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,udf.trans_id,ts.tax,ts.commission','where'=>$where,'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));

        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );
        }
        else{
            $check_by=$this->input->get('sortby');
         $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,udf.trans_id,ts.tax,ts.commission','where'=>array("udf.date>="=>$from,"udf.date<="=>$to),'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));

        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );   
        }
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $resp['newtrackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1);
      //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_by_dateANDseller?searchby=$searchby&val=$val&from=$from&to=$to&sortby=$check_by";
        //$config["base_url"] = BASE_URL. "admin/finance/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
		$resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
        //$resp['from']=$from;
        //$resp['to']=$to;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_seller',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    //end code (pooja)
    
    public function search_by_dateANDproduct(){
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        $product=$this->input->get('product'); $val=trim($product);
        $from=$this->input->get('from');
        $to=$this->input->get('to');
       
        if($this->input->get('sortby')==1){
        $check_by=$this->input->get('sortby');
        $where=array("udf.date>="=>$from,"udf.date<="=>$to,"udf.status!="=>5);
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,udf.trans_id,ts.tax,ts.commission','where'=>$where,'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC',"like"=>array("likeon"=>"p.prod_name","likeval"=>$product));
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );
        }
        else{
        $check_by=$this->input->get('sortby');
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,udf.trans_id,ts.tax,ts.commission','where'=>array("udf.date>="=>$from,"udf.date<="=>$to),'minvalue'=>'','group_by'=>'udf.id','start'=>'','orderby'=>'udf.id','orderas'=>'DESC',"like"=>array("likeon"=>"p.prod_name","likeval"=>$product));
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>'left'),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>'left'),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
        );
        }
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $resp['newtrackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1);
       // echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_by_dateANDproduct?searchby=$searchby&product=$product&from=$from&to=$to&sortby=$check_by";
        //$config["base_url"] = BASE_URL. "admin/finance/search?searchby=$searchby&val=$val";&val=$val&from=$from&to=$to&sortby=$check_by";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] =20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
		$resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
        //$resp['from']=$from;
        //$resp['to']=$to;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_seller',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function track_buyer()
    {
        
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,u.username,p.prod_name','table'=>'transaction as t','where'=>array('u.type_Of_User'=>2),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(
                array('table'=>'order_detail_form as odf','on'=>'t.trans_id=odf.trans_id','join_type'=>'full'),
                array('table'=>'product as p','on'=>'odf.product_id=p.id','join_type'=>'full'),
                array('table'=>'user_Info as u','on'=>'odf.buyerId=u.id','join_type'=>'full'),
		
               
        );


        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $resp['alltrackrecord']=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>";        print_r($resp); exit;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/track_buyer/?";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] =20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['trackrecord']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo "<pre>";
        //print_r($resp);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_buyer',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    
    public function main_search_buyer(){
        $searchby=$this->input->get('searchby');
         $val=$this->input->get('val'); $val=trim($val);
            if($searchby=='buyer'){
                $this->search_buyer();
            }
            elseif($searchby=='adddate'){
                $this->search_by_date_buyer();
            }
            elseif ($searchby=='campeign') {
            $this->search_by_campeign_buyer();
            }
            elseif($searchby=='adddate_buyer'){
                $this->search_by_dateANDbuyer();
            }
            elseif($searchby=='adddate_product'){
                $this->search_by_dateandproductname();
            }
            
    }
    
    public function search_buyer(){
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,u.username,u.id,p.prod_name','table'=>'transaction as t','where'=>array('u.type_Of_User'=>2),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
          $multijoin1=array(
            array('table'=>'order_detail_form as odf','on'=>'t.trans_id=odf.trans_id','join_type'=>'inner'),
            array('table'=>'product as p','on'=>'odf.product_id=p.id','join_type'=>'inner'),   
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'inner'),
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $resp['alltrackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
//echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_buyer?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
      
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_buyer',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function search_by_date_buyer(){
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $from=$this->input->get('from');
        $to=$this->input->get('to');
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,u.username,u.id,p.prod_name','table'=>'transaction as t','where'=>array('u.type_Of_User'=>2,"t.date>="=>$from,"t.date<="=>$to),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
          $multijoin1=array(
            array('table'=>'order_detail_form as odf','on'=>'t.trans_id=odf.trans_id','join_type'=>'inner'),
            array('table'=>'product as p','on'=>'odf.product_id=p.id','join_type'=>'inner'),   
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'inner'),
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $resp['alltrackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
//echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_by_date_buyer?searchby=$searchby&from=$from&to=$to";
        //$config["base_url"] = BASE_URL. "admin/finance/search_by_date_buyer?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
      
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_buyer',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function search_by_campeign_buyer(){
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        //$val=$this->input->get('val'); $val=trim($val);
         $where=array('t.payment_for'=>'campeign','u.type_Of_User'=>2);
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,cpd.buyerid,u.username,cd.campaign_titel','table'=>'transaction as t','where'=>$where ,'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
          $multijoin1=array(
               //array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
              array('table'=>'campaign_payment_detail as cpd','on'=>'cpd.trans_id=t.trans_id','join_type'=>'left'),
              array('table'=>'user_Info as u','on'=>'cpd.buyerid=u.id','join_type'=>'left'),
              array('table'=>'campaign_detail as cd','on'=>'cpd.campaign_id=cd.id','join_type'=>'left'),
              
           
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $resp['alltrackrecord']=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query(); exit;
        //echo "<pre>";
        //print_r($resp);exit;
        
        //echo "<pre>";
        //print_r($table); exit;
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_by_campeign_buyer?searchby=$searchby";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
				 $resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
      
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_buyer',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function search_by_dateANDbuyer(){
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val'); $val=trim($val);
        $from=$this->input->get('from');
        $to=$this->input->get('to');
        $buyer=$this->input->get('buyer');
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,u.username,u.id,p.prod_name','table'=>'transaction as t','where'=>array('u.type_Of_User'=>2,"t.date>="=>$from,"t.date<="=>$to),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
        $multijoin1=array(
          array('table'=>'order_detail_form as odf','on'=>'t.trans_id=odf.trans_id','join_type'=>'inner'),
          array('table'=>'product as p','on'=>'odf.product_id=p.id','join_type'=>'inner'),   
          array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'inner'),
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $resp['alltrackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1);
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_by_dateANDbuyer?searchby=$searchby&val=$val&from=$from&to=$to";
        //$config["base_url"] = BASE_URL. "admin/finance/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
		$resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
        //$resp['from']=$from;
        //$resp['to']=$to;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_buyer',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function search_by_dateandproductname(){
        //$userid=$this->session->userdata('user_id'); 
        $searchby=$this->input->get('searchby');
        $product=$this->input->get('product'); $product=trim($product);
        $from=$this->input->get('from');
        $to=$this->input->get('to');
       //$product=$this->input->get('product');
        $comment1=array('val'=>'t.id,t.status,t.price,t.date,t.trans_id,t.payment_for,u.username,u.id,p.prod_name','table'=>'transaction as t','where'=>array('u.type_Of_User'=>2,"t.date>="=>$from,"t.date<="=>$to),'minvalue'=>'','group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC',"like"=>array("likeon"=>"p.prod_name","likeval"=>$product));
        $multijoin1=array(
          array('table'=>'order_detail_form as odf','on'=>'t.trans_id=odf.trans_id','join_type'=>'left'),
          array('table'=>'product as p','on'=>'odf.product_id=p.id','join_type'=>'left'),   
          array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>''),
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $resp['alltrackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1);
        if(!empty($table['res'])){
             $resp['trackrecord']['res']=true;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/finance/search_by_dateandproductname?searchby=$searchby&product=$product&from=$from&to=$to";
        //$config["base_url"] = BASE_URL. "admin/finance/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($resp['trackrecord']['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;    
        $resp['trackrecord']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        }
        else{
		$resp['trackrecord']['res']=false;
                 $resp["links"] = '';
			 }
        //echo "<pre>"; 
        //print_r($resp); exit;
        //$resp['from']=$from;
        //$resp['to']=$to;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/finance/admin_vw_track_buyer',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
} 
