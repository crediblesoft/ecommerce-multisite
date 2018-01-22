<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $commondata;
    function __construct()
    {
        parent::__construct();
        $this->_getuserinactivenow();
        $compare=$this->compare_products();
        $category=$this->getcategory();
        $inbox=$this->getinboxnotification();
        $message=$this->getmessagenotification();
        if($this->session->has_userdata(ADMIN_SESS.'user_id')){
            $admininfo=$this->_getadmininfo();
            $this->commondata['admininfo']=$admininfo;
        }
        $this->commondata['category']=$category;
        $this->commondata['inbox']=$inbox;
        $this->commondata['message']=$message;
        $this->commondata['compare']=$compare;
        $this->load->helper('cookie');
        
    }
    
    public function getcategory($catid=NULL){
        if($catid==NULL){
            $data=array("table"=>"category","val"=>array(),"where"=>array("status"=>"active"));
            return $log=$this->common->getdata($data);
        }else{
            $data=array("table"=>"category","val"=>array("category","description"),"where"=>array("id"=>$catid));
            return $log=$this->common->getdata($data);
        }
    }
    
    public function getuserid($username){
        $data=array("table"=>"user_Info","val"=>"id","where"=>array("username"=>$username));
        $log=$this->common->getsinglerow($data);
        //print_r($log);exit;
        if($log['res']){
            return $log['rows']->id;
        }
    }

	public function getusername($userid){
        $data=array("table"=>"user_Info","val"=>"username","where"=>array("id"=>$userid));
        $log=$this->common->getsinglerow($data);
        //print_r($log);exit;
        if($log['res']){
            return $log['rows']->username;
        }
    }
    
    public function _checkvalid($page){
         if(!$this->session->has_userdata('user_id')){
            $this->session->set_userdata("afterloginpage",$page);
            $this->session->set_flashdata("warning","Please Login first for this");
            redirect("auth/login");
    }
    }
    
    public function invalid_user(){
        $this->session->set_flashdata("warning","You are no authorized for this");
        redirect("profile","refresh");
    }
    
    public function invalid_usertype(){
        $this->session->set_flashdata("warning","You are no authorized for this");
        redirect("profile","refresh");
    }
    
    public function getinboxnotification(){
        if($this->session->has_userdata("user_id")){
            $data=array("table"=>"mail_to","val"=>"count(id) as inbox","where"=>array("mail_to"=>$this->session->userdata("user_id"),"view"=>"0","status"=>"1"));
            $log=$this->common->getsinglerow($data);
            //print_r($log);exit;
            if($log['res']){
                return $log['rows']->inbox;
            }
        }
    }
    
    
    public function getmessagenotification(){
        if($this->session->has_userdata("user_id")){
            $data=array("table"=>"conservation","val"=>"count(id) as message","where"=>array("msgfor"=>$this->session->userdata("user_id"),"status"=>"0"));
            $log=$this->common->getsinglerow($data);
            //print_r($log);exit;
            if($log['res']){
                return $log['rows']->message;
            }
        }
    }
    
    
    public function _userlimitation($title=null,$userpaidstatus=null,$table=null,$where=array(),$redirectpage){
        
            $data=array("table"=>"user_validation","val"=>"$title as title","where"=>array("user_type"=>"$userpaidstatus"));
            
            $log=$this->common->getsinglerow($data);
            //print_r($this->db->last_query());exit;
            if($log['res']){
                
                $newdata=array("table"=>$table,"where"=>$where);
                $newlog=$this->common->record_count_where($newdata);
                if(!empty($_FILES['file'])){
                    //print_r(count($_FILES['file']['name']));exit;
                    $newlog+=count($_FILES['file']['name'])-1; 
                }
                //echo $newlog;exit;
                if($log['rows']->title > $newlog){
                    return array("status"=>true,"message"=>"");
                }else{
                    $count=$log['rows']->title;
                    if($title==''){ $item='product list'; }else if($title=='product_list'){ $item='product list'; }else{ $item=$title; }
                    $this->session->set_flashdata("warning","As a Free User, you are limited to posting $count $item. To post more and access additional functionality, please <a href='".BASE_URL."paiduser'>click</a> here to purchase a Premium package.");
                    redirect($redirectpage,"refresh");
                }
                //EXIT;
            }else{
                return array("status"=>true,"message"=>"no any limitation");
            }
            
       
    }

	public function set_cookie($data){
        $this->input->set_cookie($data);
    }
    
    public function get_cookie($name){
        return $this->input->cookie($name,true);
    }

	public function is_buyer($msg='you have to login as buyer for this'){
        if($this->session->userdata("user_type")==2){
            return true;
        }else{
            $this->session->set_flashdata("warning",$msg);
            redirect("profile","refresh");
        }
    }
    
    public function is_seller($msg='you have to login as seller for this'){
        if($this->session->userdata("user_type")==1){
            return true;
        }else{
            $this->session->set_flashdata("warning",$msg);
            redirect("profile","refresh");
        }
    }

	/*****************OCT 5 2015 ****************************/
    
    public function compare_products(){
        if($this->session->has_userdata("compare")){
            $product1=implode(",",$this->session->userdata("compare"));
            //print_r($this->session->userdata("compare"));
            $sql = "SELECT * FROM product WHERE id IN ($product1)";
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0)
            {
                $result=array('res'=>true,'rows'=>$query->result(),'count'=>$query->num_rows());
                return $result;
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
            
        }
    }
    
    
    public function add_defaultproduct($userid){
        //$admin_status=$this->_admin_approval_status_product();
        $admin_status=$this->getadminsettings();
        $current_date = date('Y-m-d');
         $products=array(
             array(
                 'user_id'=>$userid,
                 'category'=>$admin_status->default_category,
                 'prod_name'=>'demo1',
                 'prod_price'=>'1',
                 'prod_img'=>'detault.png',
                 'pord_detail'=>'This is demo product',
                 'no_of_Prod'=>'1',
                 'date'=>$current_date,
                 'bid_status'=>'0',
                 'status'=>'0',
                 'admin_status'=>$admin_status->product_status
             ),
             array(
                 'user_id'=>$userid,
                 'category'=>$admin_status->default_category,
                 'prod_name'=>'demo2',
                 'prod_price'=>'1',
                 'prod_img'=>'detault.png',
                 'pord_detail'=>'This is demo product',
                 'no_of_Prod'=>'1',
                 'date'=>$current_date,
                 'bid_status'=>'0',
                 'status'=>'0',
                 'admin_status'=>$admin_status->product_status
             ),
             array(
                 'user_id'=>$userid,
                 'category'=>$admin_status->default_category,
                 'prod_name'=>'demo3',
                 'prod_price'=>'1',
                 'prod_img'=>'detault.png',
                 'pord_detail'=>'This is demo product',
                 'no_of_Prod'=>'1',
                 'date'=>$current_date,
                 'bid_status'=>'0',
                 'status'=>'0',
                 'admin_status'=>$admin_status->product_status
             )
             
         );
         $data=array('table'=>'product','val'=>$products);
         $product_insert=$this->common->insert_multi_row($data);
         if($product_insert){
             return true;
         }
         
    }
    
    
    public function _admin_approval_status_product(){
        $this->db->select('status');
        $this->db->from('approve_by_admin');
        $this->db->where('title','product');
        $query = $this->db->get();
        return $query->row();
    }
    
    
    
    public function check_img_size($path){
        if(isset($_FILES['file']['name'])){
            //print_r($_FILES['file']['name']); 
            //print_r($_FILES['file']['size']); exit;
            if($_FILES['file']['name']!='' && $_FILES['file']['size'] <= 0){
                $this->session->set_flashdata("warning","This file is corrupted. So you can not upload this file.");
                redirect($path,"refresh");
            }
        }else{
            return true;
        }
    }
    
    
    public function get_product_details($id){
        //echo "get_product";exit;
            //$data['category']=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
            $data=array('val'=>array(),'table'=>'product','where'=>array('id'=>$id));
            $log=$this->common->getdata($data);
            
            return $log;
            //$log['category']=$this->common->getdata($data['category']);
            
    }
    
   
    public function currentavailproductforpayment(){
        //echo "<pre>";
        //print_r($this->cart->contents());exit;
        $flag=1;
        if (count($this->cart->contents())>0){
            foreach ($this->cart->contents() as $item){
                $prodId=$item['id'];
                $qty=$item['qty'];
                $category=$item['options']['Category'];
                $product=$item['name'];
                $get_product=$this->get_product_details($prodId);
                $avai_pro=$get_product['rows'][0]->no_of_Prod;
                if($avai_pro < $qty){
                    $flag=0;
                    if($avai_pro<=0){
                    $this->session->set_flashdata("warning","$product of $category is out of stock so please remove this item form your cart");    
                    }else{
                    $this->session->set_flashdata("warning","Currently $avai_pro item available for $product of $category so you can not order more than $avai_pro.");
                    }
                    redirect("products/viewcart","refresh"); 
               }
            }   
            if($flag){
                return true;
            }else{
                redirect("products/viewcart","refresh");
            }       
        }

    }
    
    
    public function get_auction_id($prodid){
        $proddata=array("table"=>"product_auction","where"=>array("prod_id"=>$prodid,"status"=>'1'),"val"=> array("id"));
        $product=$this->common->getsinglerow($proddata);
        return $product['rows']->id;
    }




    /***********************Start by sachin*********************************/
    
    public function _userlimitationeditpenal($title=null,$userpaidstatus=null,$table=null,$where=array(),$redirectpage){
        
            $data=array("table"=>"user_validation","val"=>"$title as title","where"=>array("user_type"=>"$userpaidstatus"));
            
            $log=$this->common->getsinglerow($data);
            //print_r($this->db->last_query());exit;
            if($log['res']){
                
                $newdata=array("table"=>$table,"where"=>$where);
                $newlog=$this->common->record_count_where($newdata);
                //echo $newlog;exit;
                if($log['rows']->title > $newlog){
                    return array("status"=>true,"message"=>"");
                }else{
                    return array("status"=>FALSE,"message"=>"no any limitation");
                }
                
            }else{
                return array("status"=>true,"message"=>"no any limitation");
            }
            
       
    }
    
    
    public function _getuserinactivenow(){   
        if($this->session->userdata("user_id")>0){  
            //echo $this->session->userdata("user_id")."aa1";exit;
           $id=$this->session->userdata("user_id");
            $data=array("table"=>"user_Info","val"=>"status,type_Of_User","where"=>array("id"=>$id,"status"=>"0","verified"=>"1"));
                $log['get_details']=$this->common->getsinglerow($data);
                if($log['get_details']['res']){
                    $this->load->view('include/header');
                    $this->load->view('vw_error',$log);
                    $this->load->view('include/footer');
                    if($this->session->userdata("is_first_click")==1){$this->session->sess_destroy();}
                    $this->session->set_userdata("is_first_click","1");
                    exit;
                }
        }
        
        //echo "aa";exit;
    }


    /***********************End by sachin*********************************/
    
    
    
    /****************************** ADMIN ****************************/
    
    function _valid_admin(){ 
        if(!$this->session->userdata(ADMIN_SESS.'user_id'))
        {
            $this->session->set_flashdata("warning","You are not a valid user or session expire");
            redirect('auth/login','refresh');
        }
        
    }
    
    public function getsellers($val=array(),$where=array()){
            $data=array("table"=>"user_Info","val"=>$val,"where"=>$where);
            return $log=$this->common->getdata($data);
    }

    protected function getadminsettings(){
        $data=array("table"=>"settings","val"=>"","where"=>array());
        $log=$this->common->getsinglerow($data);
        if($log['res']){ return $log['rows']; }else{ return false; }
    }

    public function _getadmininfo(){
        $data=array("table"=>"admin","val"=>array(),"where"=>array("id"=>$this->session->userdata(ADMIN_SESS.'user_id')));
        return $log['admininfo']=$this->common->getsinglerow($data);
    }
    
    
    
    
    public function get_states(){
        $data=array("table"=>"statelist","val"=>array(),"where"=>array("status"=>"1"));
        return $log=$this->common->getdata($data);
    }
    
    
    public function get_user_store($val=array(),$where=array()){
        $data=array("table"=>"user_store_info","val"=>$val,"where"=>$where);
        return $log=$this->common->getsinglerow($data);
    }
    
    /* By Ravi */
    /*Mail send to buyer start*/
    public function send_mail_buyer($trans_id){
        $to=$this->session->userdata('user_id');
        $comment1=array('val'=>'t.id,t.status,t.price as grandtotal,t.date,t.trans_id,t.payment_for,udf.product_id,u.username,u.email_id,udf.price as productprice,p.user_id as seller_id,udf.quantity,p.prod_name','table'=>'transaction as t','where'=>array("t.trans_id"=>$trans_id),'group_by'=>'','minvalue'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'order_detail_form as udf','on'=>'udf.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'p.id=udf.product_id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
           // array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        
        
         $comment1=array('val'=>'t.trans_id,ts.shippingcharge,ts.tax,ts.commission,ts.total','table'=>'transaction as t','where'=>array("t.trans_id"=>$trans_id),'group_by'=>'','minvalue'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
         $multijoin1=array(
            
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=t.trans_id','join_type'=>'left'),
             array('table'=>'user_Info as u','on'=>'ts.seller_id=u.id','join_type'=>'left'),
        );
        $table_1=$this->common->multijoin($comment1,$multijoin1);
        //echo $this->db->last_query();echo "<br>";
        
        //$comm=$table_1['rows'][0]->commission;
        $tto=$table['rows'][0]->email_id;
        //echo "<pre>";
       // print_r($table); 
        //print_r($table_1);
        //exit;
        $list='';
        $shipping='';
        foreach($table['rows'] as $data){
        $total=$data->productprice*$data->quantity;    
        $list.='<tr><td style="width:40%;">'.$data->prod_name.'</td><td style="width:20%;">$'.$data->productprice.'</td><td style="width:20%;">'.$data->quantity.'</td><td>$'.$total.'</td></tr>';              
        }
        $ship_charge=0;
        $tax=0;
        $nttl=0;
        $ftax=0;
        foreach($table_1['rows'] as $shippingdata){
        $ship_charge+=$shippingdata->shippingcharge;
        $nttl=$shippingdata->total;    
        $tax=$shippingdata->tax;
        $ftax+=($nttl*$tax)/100;
        //echo $tax;
        //echo $ftax;
        //$shipping.='<tr><td colspan="3">Shipping Charges</td><td>'.$shippingdata->shippingcharge.'</td></tr>';   
        }
        //exit;
        $from='0';
        $subject="Invoice Mail";
        $message='<h2>Invoice</h2></br>
            <h4>Transaction-Id:-'.$table['rows'][0]->trans_id.'</h4></br>
            <table class="table table-bordered" style="border:1px solid black;">
                            <thead>
                              <tr style="border-bottom:1px solid black;">
                                <th style="width:40%; text-align: left;">Product</th>
                                <th style="width:20%; text-align: left;">Price</th>
                                <th style="width:20%; text-align: left;">Quantity</th>
                                <th style="width:20%; text-align: left;">Total</th>
                              </tr>
                            </thead>
                            <tbody>'.$list.'
                            <tr style="width:40%; border-top:1px solid black;"><td colspan="3">Tax</td><td>$'.$ftax.'</td></tr>    
                            <tr style="width:20%;"><td colspan="3">Shipping Charges:-</td><td>$'.$ship_charge.'</td></tr>        
                            <tr style="width:20%;"><td colspan="3">Grand Total:-</td><td>$'.$table['rows'][0]->grandtotal.'</td></tr>   
                            </tbody>
                          </table></br>
                          <h3>Harvest Team</h3>';
        //print_r($message); exit;
        //$this->getuserid($to[0]);
        $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
        $inserted_id=$this->common->add_data_get_id($maildata);
        
         $email1=array('from'=>'test@ucodice.com','to'=>$tto,'subject'=>$subject,'message'=>$message);
         $sendmail=$this->functions->_email($email1);
        
//        echo $inserted_id;
//        echo "<br>";
//        echo $to; 
//        echo "<br>";
//        echo "<pre>";
        //print_r($table); exit;
        if($inserted_id || $sendmail){
             $mailtodata=array("table"=>'mail_to',"val"=>array("mail_from"=>$inserted_id,"mail_to"=>$to));
             $log = $this->common->add_data($mailtodata);
        }
        if($log){
            return TRUE;
        }else{
            return FALSE;
        }
            
    
    }
    /*Mail send to buyer end*/
    
    /*Mail send to seller start*/
    public function send_mail_seller($trans_id){
        $where3=array('t.trans_id'=>$trans_id);
        //$to=$this->session->userdata('user_id');
        $comment1=array('val'=>'t.id,t.status,t.price as grandtotal,t.date,t.trans_id,t.payment_for,udf.product_id,udf.price as productprice,p.user_id as seller_id,udf.quantity,p.prod_name','table'=>'transaction as t','where'=>$where3,'group_by'=>'','minvalue'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'order_detail_form as udf','on'=>'udf.trans_id=t.trans_id','join_type'=>'left'),
            array('table'=>'product as p','on'=>'p.id=udf.product_id','join_type'=>'left'),
            array('table'=>'user_Info as u','on'=>'t.order_id=u.id','join_type'=>'left'),
           // array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=udf.trans_id','join_type'=>'left'),
        );
        $table=$this->common->multijoin($comment1,$multijoin1);
        
         $comment1=array('val'=>'t.trans_id,ts.shippingcharge,ts.tax,ts.commission,ts.total,ts.seller_id,u.username as sellername,u.email_id','table'=>'transaction as t','where'=>$where3,'group_by'=>'','minvalue'=>'','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
         $multijoin1=array(
            
            array('table'=>'transaction_sellers as ts','on'=>'ts.trans_id=t.trans_id','join_type'=>'left'),
             array('table'=>'user_Info as u','on'=>'ts.seller_id=u.id','join_type'=>'left'),
        );
        $table_1=$this->common->multijoin($comment1,$multijoin1);
        
        //echo $this->db->last_query();echo "<br>";
        //echo "<pre>";
        //print_r($table); 
        //print_r($table_1);
        //exit;
        $tax=0;$comm=0;$ttl=0;$fttl=0;
        foreach ($table_1['rows'] as $mail_to){
        $to=$mail_to->seller_id;
        $tto=$mail_to->email_id;
        $tax=$mail_to->tax;
        $comm=$mail_to->commission;
        $ttl=$mail_to->total;
        $fttl=($ttl*$tax)/100;
        //echo $mailto=$mail_to->sellername; 
        $list='';$ptotal=0;
        foreach ($table['rows'] as $data){
            if($data->seller_id==$mail_to->seller_id){
            $total=$data->productprice*$data->quantity;
            $ptotal=$ptotal+$total;
            $list.='<tr><td style="width:40%;">'.$data->prod_name.'</td><td style="width:20%;">$'.$data->productprice.'</td><td  style="width:20%;">'.$data->quantity.'</td><td>$'.$total.'</td></tr>';              
          }
          }
           $gtotal=($ptotal+$mail_to->shippingcharge)+$fttl;
           $pay_to_seller=$gtotal-$comm;
        //exit;
        $from='0';
        $subject="Invoice Mail To Seller";
        $message='<h2>Invoice</h2></br>
            <h4>Transaction-Id:-'.$table['rows'][0]->trans_id.'</h4></br>
            <table class="table table-bordered"  style="border:1px solid black;">
                            <thead>
                              <tr>
                                <th style="width:40%; text-align: left;">Product</th>
                                <th style="width:20%; text-align: left;">Price</th>
                                <th style="width:20%; text-align: left;">Quantity</th>
                                <th style="width:20%; text-align: left;">Total</th>
                              </tr>
                            </thead>
                            <tbody>'.$list.'
                            <tr style="width:20%; border-top:1px solid black;"><td colspan="3">Tax</td><td>$'.$fttl.'</td></tr>
                            <tr style="width:20%; border-top:1px solid black;"><td colspan="3">Shipping Charges:-</td><td>$'.$mail_to->shippingcharge.'</td></tr>       
                            <tr style="width:20%; border-top:1px solid black;"><td colspan="3">Grand Total:-</td><td>$'.$gtotal.'</td></tr>   
                            <tr style="width:20%; border-top:1px solid black;"><td colspan="3">Commission(-)</td><td>$'.$comm.'</td></tr>
                            <tr style="width:20%; border-top:1px solid black;"><td colspan="3">Pay To Seller</td><td>$'.$pay_to_seller.'</td></tr>     
                            </tbody>
                          </table></br>
                          <h3>Harvest Team</h3>';

   
        $maildata=array("table"=>"mail","val"=>array("mail_from"=>$from,"subject"=>$subject,"message"=>$message,"timestamp"=>time()));
        $inserted_id=$this->common->add_data_get_id($maildata);
        
         $email1=array('from'=>'test@ucodice.com','to'=>$tto,'subject'=>$subject,'message'=>$message);
         $sendmail=$this->functions->_email($email1);
       
        if($inserted_id || $sendmail){
             $mailtodata=array("table"=>'mail_to',"val"=>array("mail_from"=>$inserted_id,"mail_to"=>$to));
             $log = $this->common->add_data($mailtodata);
        }
       
        } //exit;
       
        if($log){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    /*Mail send to seller end*/
}    
