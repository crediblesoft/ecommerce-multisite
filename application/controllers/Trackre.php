<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Trackre extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->library('session');
        $this->functions->_valid_user();
    }
    
    public function index()
    {
        
        if($this->session->userdata('user_type')=="2"){
            $this->buyer_track();
        }else{
            $this->seller_track();
        }
        
    }
    public function buyer_track()
    {
       $userid=$this->session->userdata('user_id'); 
       if(($this->input->post('fromDate'))&&($this->input->post('fromDate')!=NULL)){ $datefrom=$this->input->post('fromDate');}else{ $datefrom=date('Y').'-01-01';}
       if(($this->input->post('toDate'))&&($this->input->post('toDate')!=NULL)){ $dateto=$this->input->post('toDate');}else{ $dateto=date('Y-m-d');}
       
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic','where'=>array("u.id"=>$userid,"udf.date>="=>$datefrom,"udf.date<="=>$dateto),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>'')
            //array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')up.tranc_id, up.price, up.add_date,
        );
        $comment=array('table'=>'user_Info as u','val'=>'up.tranc_id, up.price as themeprice, up.add_date,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic','where'=>array("u.id"=>$userid,"up.add_date>="=>$datefrom,"up.add_date<="=>$dateto),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC');//
        $multijoin=array(            
            array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')
        );
        $resp['trackrecordexpenses']=$this->common->multijoin($comment,$multijoin);
        $resp['trackrecord']=$this->common->multijoin($comment1,$multijoin1);
        $resp['fromDate']=$datefrom;
        $resp['toDate']=$dateto;
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft',$resp);
        $this->load->view('userlogin/TrackRE/trackre');
        $this->load->view('include/footer');  
    }

    public function seller_track()
    {
      $userid=$this->session->userdata('user_id'); 
       if(($this->input->post('fromDate'))&&($this->input->post('fromDate')!=NULL)){ $datefrom=$this->input->post('fromDate');}else{ $datefrom=date('Y').'-01-01';}
       if(($this->input->post('toDate'))&&($this->input->post('toDate')!=NULL)){ $dateto=$this->input->post('toDate');}else{ $dateto=date('Y-m-d');}
       
        $comment1=array('table'=>'user_Info as u','val'=>'udf.status,udf.date,p.id as prodid,p.prod_img,p.prod_name,udf.buyerId,udf.price,udf.quantity,udf.trans_id,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,ts.tax','where'=>array("u.id"=>$userid,"udf.date>="=>$datefrom,"udf.date<="=>$dateto),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'udf.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'product as p','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'order_detail_form as udf','on'=>'udf.product_id=p.id','join_type'=>''),
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'')
            //array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')up.tranc_id, up.price, up.add_date,
        );
        $comment=array('table'=>'user_Info as u','val'=>'up.tranc_id, up.price as themeprice, up.add_date,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic','where'=>array("u.id"=>$userid,"up.add_date>="=>$datefrom,"up.add_date<="=>$dateto),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC');//
        $multijoin=array(            
            array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')
        );
        $resp['trackrecordexpenses']=$this->common->multijoin($comment,$multijoin);
        $resp['trackrecord']=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>"; print_r($resp['trackrecordexpenses']);
        //echo "<pre>"; print_r($resp['trackrecord']); exit;
        $resp['fromDate']=$datefrom;
        $resp['toDate']=$dateto;
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft',$resp);
        $this->load->view('userlogin/TrackRE/trackre');
        $this->load->view('include/footer'); 
    }

    /*public function expenses()
    {
        $userid=$this->session->userdata('user_id'); 
       if(($this->input->post('fromDate'))&&($this->input->post('fromDate')!=NULL)){ $datefrom=$this->input->post('fromDate');}else{ $datefrom=date('Y').'-01-01';}
       if(($this->input->post('toDate'))&&($this->input->post('toDate')!=NULL)){ $dateto=$this->input->post('toDate');}else{ $dateto=date('Y-m-d');}
       
        $comment=array('table'=>'user_Info as u','val'=>'up.tranc_id, up.price as themeprice, up.add_date,u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic','where'=>array("u.id"=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'up.id','orderas'=>'DESC');//,"up.add_date>"=>$datefrom,"up.add_date<="=>$dateto
        $multijoin=array(            
            array('table'=>'user_payment as up','on'=>'up.user_id=u.id','join_type'=>'')
        );
        $resp['trackrecordexpenses']=$this->common->multijoin($comment,$multijoin);
        $resp['fromDate']=$datefrom;
        $resp['toDate']=$dateto;
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft',$resp);
        $this->load->view('userlogin/TrackRE/trackexpenses');
        $this->load->view('include/footer');
    }*/
    
}
