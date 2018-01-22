<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
    private $userid;
    private $currentmonth;
    private $currentyear;
    private $userpaidstatus;
    
    function __construct()
    {
        parent::__construct();
        $this->functions->_valid_user();
        $this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        //$this->_validForContoller();
        $this->userpaidstatus=$this->session->userdata('user_paid');
        $this->currentmonth=date('m');
        $this->currentyear=date('Y');
    }
    
    /*public function _validForContoller(){
        if($this->session->userdata('user_type')=='2'){
            $this->session->set_flashdata("warning","You are Not Valid User for This");
            redirect("profile","refresh");
        }
    }*/
    
    public function index(){
    $this->is_seller();
        $comment1=array('val'=>'p.id as prod_id,p.prod_name,p.bid_status,p.prod_price,p.date,p.status,p.admin_status,p.prod_img,p.no_of_Prod,cat.category','table'=>'product as p','where'=>array("p.bid_status"=>'0',"p.user_id"=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
        );

        $table=array("table"=>"product","where"=>array("bid_status"=>'0',"user_id"=>$this->userid));
        $config = array();
        $config["base_url"] = BASE_URL. "product";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query(); exit;
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($resp);exit;
        $resp["bid"]=false;
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/product/vw_product',$resp);
        $this->load->view('include/footer');
    }
    
//    public function _admin_approval_status(){
//        $this->db->select('status');
//        $this->db->from('approve_by_admin');
//        $this->db->where('title','product');
//        $query = $this->db->get();
//        return $query->row();
//    }

    
    public function bid(){
        $this->is_seller();
        $comment1=array('val'=>'p.id as prod_id,p.prod_name,p.prod_price,p.bid_status,p.date,p.status,p.admin_status,p.prod_img,p.no_of_Prod,auc.bid_start_date,auc.bid_end_date,auc.bid_purchase_date,cat.category,count(btc.id) as bidcount','table'=>'product as p','where'=>array("p.bid_status"=>'1',"p.user_id"=>$this->userid,"auc.status"=>'1'),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id and auc.status=1','join_type'=>'left'),
            array('table'=>'bid_tbl_cart as btc','on'=>'auc.id=btc.auction','join_type'=>'left'),
            // array('table'=>'bid_tbl_cart as btc','on'=>'p.id=btc.product_id','join_type'=>'left'),
            // array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id','join_type'=>'left'),
        );

        //$table=array("table"=>"product","where"=>array("bid_status"=>'1',"user_id"=>$this->userid));
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "product/bid";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        $resp["bid"]=true;
        
//        echo "<pre>";
//        print_r($resp['products']);exit;
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/product/vw_product',$resp);
        $this->load->view('include/footer');
    }

    public function move_to_buy_directly(){
        
        $this->is_seller();
        $id = $this->input->post("id");
        $prod_data=array('table'=>'product','val'=>array('bid_status'=>'0'),"where"=>array("id"=>$id));
        $log=$this->common->update_data($prod_data);
        if($log){
            
            echo json_encode(array('status'=>true,'message'=>'Product has been moved to Buy Directly'));
        }
        
    }
    
    
    public function add(){
        $this->is_seller();
	$this->check_img_size("product");
        //array("user_id"=>$this->userid, 'MONTH(date)' => $this->currentmonth, 'YEAR(date)' => $this->currentyear)
        $this->_userlimitation("product_list",$this->userpaidstatus,"product",array("user_id"=>$this->userid),"product");
        $selltype=$this->input->post("selltype");
        
        $this->form_validation->set_rules('category','Category','trim|required');
        $this->form_validation->set_rules('name','Product Name','trim|required');
        $this->form_validation->set_rules('price','Price','trim|required|numeric|less_than_equal_to[100000]');
        $this->form_validation->set_rules('details','Product Details','trim|required');
        $this->form_validation->set_rules('selltype','Sell Type','trim|required');
        if($selltype){
           $this->form_validation->set_rules('bid_start','Bid Start Date','trim|required');
           $this->form_validation->set_rules('bid_end','Bid End Date','trim|required');
           $this->form_validation->set_rules('bid_purchase','Product Purchase Date','trim|required');
        }else{
            $this->form_validation->set_rules('quantity','Quantity','trim|required');
        }
        $this->form_validation->set_rules('weight','Weight','trim|required');
        $this->form_validation->set_rules('length','Length','trim|required');
        $this->form_validation->set_rules('width','Width','trim|required');
        $this->form_validation->set_rules('height','Height','trim|required');
        $this->form_validation->set_rules('local_shipping','Local shipping','trim|required');
            
        if($this->form_validation->run()){
        
        $userid=$this->session->userdata('user_id');
        
        $category=$this->input->post("category");
        $name=$this->input->post("name");
        $price=$this->input->post("price");
        $details=$this->input->post("details");
        $quantity=$this->input->post("quantity");
        $selltype=$this->input->post("selltype");
        $status=$this->input->post("status");
        $taxable=$this->input->post("tax");
        //$admin_status=$this->_admin_approval_status();
        $admin_status=$this->getadminsettings();
        if($selltype){
            $bid_start_date=$this->input->post("bid_start");
            $bid_end_date=$this->input->post("bid_end");
            $bid_end_time=date('23:59:59');
            $bid_end_date=$bid_end_date." ".$bid_end_time;
            $bid_purchase_date=$this->input->post("bid_purchase");
            $quantity='1';
        }else{
            $bid_start_date="";
            $bid_end_date="";
            $bid_purchase_date="";
        }
        
        $weight=$this->input->post("weight");
        $weight_unit='lb';
        $length=$this->input->post("length");
        $width=$this->input->post("width");
        $height=$this->input->post("height");
        $die_unit="in";
        $local_shipping=$this->input->post("local_shipping");
        
        //echo $quantity;exit;
        $current_date=date('Y-m-d');
        /*$data1=array('table'=>'product','where'=>array());
        $noofrows= $this->common->record_count_where($data1);
        $noofrows+=1;*/
        
        if(isset($_FILES['file']['name'])!=""){
                    $userfile='file';
                    $image_path='assets/image/product/';
                    $allowed='jpg|png|jpeg';
                    $max_size='4096000';
                    
                    $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
                     }else{
                         $fileupload=array('status'=>1,'filename'=>'');
                     }
                      //print_r($fileupload);exit;
                     $prodImage=$fileupload['filename'];
                     
        $data=array('table'=>'product','val'=>array('user_id'=>$userid,'category'=>$category,'prod_name'=>$name,'prod_price'=>$price,'pord_detail'=>$details,'bid_status'=>$selltype,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,'weight'=>$weight,'weight_unit'=>$weight_unit,'length'=>$length,'width'=>$width,'height'=>$height,'die_unit'=>$die_unit,'prod_img'=>$prodImage,'no_of_Prod'=>$quantity,'local_shipping'=>$local_shipping,'status'=>$status,"date"=>$current_date,'admin_status'=>$admin_status->product_status,'taxable_status'=>$taxable));                
        //echo "<pre>";print_r($data);exit;
        $prod_id=$this->common->add_data_get_id($data);
        if($selltype){
            $data=array('table'=>'product_auction','val'=>array("prod_id"=>$prod_id,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,"price"=>$price));                
            //echo "<pre>";print_r($data);exit;
            $log=$this->common->add_data($data);
        }//echo $this->db->last_query();exit;
        
        if($prod_id){
            $this->session->set_flashdata("sucess","Product add successfully.");
            redirect("product/add/","refresh");
        }
        
        }else{        
            $data=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
            $log['category']=$this->common->getdata($data);        
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/product/vw_productadd',$log);
            $this->load->view('include/footer');
        }
    }
    
    public function delete(){
        $this->is_seller();
        $id = $this->input->post("id");
        
        $galdata=array("table"=>"product","where"=>array("id"=>$id),"val"=> array("prod_img"));
        $gallery=$this->common->getsinglerow($galdata);
       // print_r($gallery);exit;
        if($gallery['res']){
            if($gallery['rows']->prod_img!='detault.png'){
            $path="assets/image/product/".$gallery['rows']->prod_img;
            if(file_exists($path)){
            unlink($path);}
            $path="assets/image/product/thumb/".$gallery['rows']->prod_img;
           if(file_exists($path)){
            unlink($path);}
            }  
        }
        
        $data=array('table'=>'product','where'=>array('id'=>$id));
        $log=$this->common->delete_data($data);
        
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
    }
    
    public function edit($id){
            $this->is_seller();
            $data['category']=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
            $data['product']=array('val'=>array(),'table'=>'product','where'=>array('id'=>$id,'user_id'=>$this->userid));
            //$data['auction']=array('val'=>array(),'table'=>'product_auction','where'=>array('prod_id'=>$id,'status'=>'1'));
            $log['category']=$this->common->getdata($data['category']);
            $log['product']=$this->common->getdata($data['product']);
            //$log['auction']=$this->common->getdata($data['auction']);
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/product/vw_productedit',$log);
            $this->load->view('include/footer');
            
    }
    
    public function update(){
        $this->is_seller();
        //echo "hello";exit;
        $selltype=$this->input->post("selltype");
        
        $this->form_validation->set_rules('category','Category','trim|required');
        $this->form_validation->set_rules('name','Product Name','trim|required');
        $this->form_validation->set_rules('price','Price','trim|required|numeric|less_than_equal_to[100000]');
        $this->form_validation->set_rules('details','Product Details','trim|required');
        $this->form_validation->set_rules('selltype','Sell Type','trim|required');
        
        if($selltype){
           $this->form_validation->set_rules('bid_start','Bid Start Date','trim|required');
           $this->form_validation->set_rules('bid_end','Bid End Date','trim|required');
           $this->form_validation->set_rules('bid_purchase','Product Purchase Date','trim|required');
        }else{
            $this->form_validation->set_rules('quantity','Quantity','trim|required');
        }
        
        $this->form_validation->set_rules('weight','Weight','trim|required');
        $this->form_validation->set_rules('length','Length','trim|required');
        $this->form_validation->set_rules('width','Width','trim|required');
        $this->form_validation->set_rules('height','Height','trim|required');
        $this->form_validation->set_rules('local_shipping','Local shipping','trim|required');
        
        if($this->form_validation->run()){
        
        //$userid=$this->session->userdata('user_id');
        
        $category=$this->input->post("category");
        $name=$this->input->post("name");
        $price=$this->input->post("price");
        $details=$this->input->post("details");
        $quantity=$this->input->post("quantity");
        $selltype=$this->input->post("selltype");
        $status=$this->input->post("status");
        $taxable=$this->input->post("tax");
        $prodId=$this->input->post('productid');
       
        if($selltype){
            $bid_start_date=$this->input->post("bid_start");
            $bid_end_date=$this->input->post("bid_end");
            //$bid_end_time=date('H:i:s');
            $bid_end_time=date('23:59:59');
            $bid_end_date=$bid_end_date." ".$bid_end_time;
            $bid_purchase_date=$this->input->post("bid_purchase");
            $quantity='1';
        }else{
            $bid_start_date="";
            $bid_end_date="";
            $bid_purchase_date="";
        }
        
        $weight=$this->input->post("weight");
        $weight_unit='lb';
        $length=$this->input->post("length");
        $width=$this->input->post("width");
        $height=$this->input->post("height");
        $die_unit="in";
        $local_shipping=$this->input->post("local_shipping");
        
        if($_FILES['file']['name']!=""){
            //'prod_img'=>$prodImage,
            $proddata=array("table"=>"product","where"=>array("id"=>$prodId),"val"=> array("prod_img"));
            $product=$this->common->getsinglerow($proddata);
            if($product['rows']->prod_img!='detault.png'){
                $path="assets/image/product/".$product['rows']->prod_img;
                unlink($path);
                $path="assets/image/product/thumb/".$product['rows']->prod_img;
                unlink($path);
            }
        $userfile='file';
        $image_path='assets/image/product/';
        $allowed='jpg|png|jpeg';
        $max_size='4096000';
        
        $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
        //echo $userfile;echo $image_path; echo $allowed; echo $max_size; 
        //print_r($fileupload); exit;
        $prodImage=$fileupload['filename'];
        $data=array('table'=>'product','where'=>array('id'=>$prodId),'val'=>array('category'=>$category,'prod_name'=>$name,'prod_price'=>$price,'no_of_Prod'=>$quantity,'pord_detail'=>$details,'bid_status'=>$selltype,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,'weight'=>$weight,'weight_unit'=>$weight_unit,'length'=>$length,'width'=>$width,'height'=>$height,'die_unit'=>$die_unit,'local_shipping'=>$local_shipping,'status'=>$status,'taxable_status'=>$taxable,'prod_img'=>$prodImage));                
         }else{
        $data=array('table'=>'product','where'=>array('id'=>$prodId),'val'=>array('category'=>$category,'prod_name'=>$name,'prod_price'=>$price,'no_of_Prod'=>$quantity,'pord_detail'=>$details,'bid_status'=>$selltype,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,'weight'=>$weight,'weight_unit'=>$weight_unit,'length'=>$length,'width'=>$width,'height'=>$height,'die_unit'=>$die_unit,'local_shipping'=>$local_shipping,'status'=>$status,'taxable_status'=>$taxable));                
         }
        $log=$this->common->update_data($data);
        if($selltype){
            $data1=array("table"=>"product_auction","where"=>array("prod_id"=>$prodId,"status"=>'1'),"val"=> array("id"));
            $res=$this->common->getsinglerow($data1);
            //print_r($res);exit;
            if($res['res']){
                $data=array('table'=>'product_auction','where'=>array("prod_id"=>$prodId,'status'=>'1'),'val'=>array("bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,"price"=>$price));
                $log1=$this->common->update_data($data);    
            }else{
                $data=array('table'=>'product_auction','val'=>array("prod_id"=>$prodId,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,"price"=>$price));
                $log1=$this->common->add_data($data);
            }
        }    
        //print_r($log);exit;
        if($log){
            $this->session->set_flashdata("Success","Product updated successfully.");
            if ($selltype == 1) {
                redirect("product/bid","refresh");
            }else{
                redirect("product/","refresh");
            }
        }
        
        }else{
            $data['category']=array('val'=>array('id','category'),'table'=>'category','where'=>array('status'=>'Active'));
            $data['product']=array('val'=>array(),'table'=>'product','where'=>array('id'=>$this->input->post('productid'),'user_id'=>$this->userid));
            $log['category']=$this->common->getdata($data['category']);
            $log['product']=$this->common->getdata($data['product']);
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/product/vw_productedit',$log);
            $this->load->view('include/footer');
        }
    }
    
    public function details($id){
        
        $data=array("table"=>"product","where"=>array("id"=>$id),"val"=> array("bid_status"));
        $getbidstatus=$this->common->getsinglerow($data);
	if(!$getbidstatus['res']){
		$this->session->set_flashdata('warning','This product does not exists any more.');
            redirect("_404","refresh");
        }
        if($getbidstatus['rows']->bid_status){
            $this->_biddetaills($id);
        }else{
            $this->_productdetails($id);
        }
    }
    
    private function _biddetaills($id){
        $comment1=array('val'=>'p.id as prod_id,p.prod_name,p.date,p.prod_price,p.status,p.prod_img,no_of_Prod,p.weight,p.weight_unit,p.length,p.width,p.height,p.die_unit,cat.category,p.bid_status as bid,auc.id as auction_id,auc.bid_start_date,auc.bid_end_date,auc.bid_purchase_date','table'=>'product as p','where'=>array('p.id'=>$id,'auc.status'=>'1'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'product_auction as auc','on'=>'p.id=auc.prod_id','join_type'=>'left'),
        );
        $resp['product']=$this->common->multijoin($comment1,$multijoin1);
        
        $auctionid=$this->get_auction_id($id);
        
         $comment2=array('val'=>'bid.price,bid.add_date,u.f_name,u.l_name','table'=>'bid_tbl_cart as bid','where'=>array('bid.auction'=>$auctionid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'bid.id','orderas'=>'DESC');
         $multijoin2=array(  
            array('table'=>'user_Info as u','on'=>'bid.user_id=u.id','join_type'=>''),
         );
         
         
        $table=array('table'=>'bid_tbl_cart','where'=>array('auction'=>$auctionid));
        $config = array();
        $config["base_url"] = BASE_URL. "product/details/$id";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['bid']=$this->common->multijoin($comment2,$multijoin2,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]); 
         
          // print_r( $resp['bid']);exit;
        //$biddingdata=array('val'=>array(''),'table'=>'bid_tbl_cart','where'=>array('product_id'=>$id));
        
        
        $sql="select bid.price,bid.id as bidid,u.id as buyerid,u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1,rv.review from bid_tbl_cart as bid left join user_Info as u on bid.user_id=u.id left join buyer_review as rv on bid.id=rv.bid_id where bid.auction='".$auctionid."' AND bid.price=(SELECT MAX(price) FROM bid_tbl_cart where auction='".$auctionid."')";
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0)
        {
            $resp['winner']=array('res'=>true,'rows'=>$query->result());
        }
        else
        {
            $resp['winner']=array('res'=>false);
        }
        
//        $transdata=array("table"=>"transaction","where"=>array("order_id"=>$auctionid,"payment_for"=>'bidproduct'),"val"=> array("trans_id"));
//        $resp['trans']=$this->common->getsinglerow($transdata);
            $this->db->select('t.trans_id,ts.*');
            $this->db->join('transaction_sellers ts','t.trans_id=ts.trans_id','left');
            $this->db->where('order_id',$auctionid);$this->db->where('payment_for','bidproduct');
            $query1=$this->db->get('transaction t');
            if($query1 -> num_rows() > 0){$resp['trans']=array('res'=>true,'rows'=>$query1->row());}
            else{$resp['trans']=array('res'=>false);}
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/product/vw_productdetails',$resp);
        $this->load->view('include/footer');
    }
    
    
    private function _productdetails($id){
        $comment1=array('val'=>'p.id as prod_id,p.prod_name,p.date,p.prod_price,p.status,p.prod_img,no_of_Prod,p.weight,p.weight_unit,p.length,p.width,p.height,p.die_unit,cat.category,p.bid_status as bid','table'=>'product as p','where'=>array('p.id'=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
        );
        $resp['product']=$this->common->multijoin($comment1,$multijoin1); 
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/product/vw_productdetails',$resp);
        $this->load->view('include/footer');
    }


    public function getwinner(){
        $productid=$this->input->post("id");
        $auctionid=$this->get_auction_id($productid);
        $sql="select bid.price,u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1,t.trans_id,t.price as payment from bid_tbl_cart as bid left join user_Info as u on bid.user_id=u.id left join transaction as t on t.order_id=bid.auction where bid.auction='".$auctionid."' AND bid.price=(SELECT MAX(price) FROM bid_tbl_cart where auction='".$auctionid."')";
        $query=$this->db->query($sql);
        $result=$query->result();
        //echo $this->db->last_query(); exit;
        if($result){
            echo json_encode(array('res'=>true,'data'=>$result));
        }else{
            echo json_encode(array('res'=>false,'data'=>''));
        }
    }
    
     public function getwinnernew(){
        $productid=$this->input->post("id");
        $auctionid=$this->get_auction_id($productid);
        $sql="select bid.price,pa.bid_purchase_date,pa.id as pro_aucid,prod.user_id as seller_id,u.id as buyer_id,u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1,t.trans_id,t.price as payment from bid_tbl_cart as bid left join user_Info as u on bid.user_id=u.id left join transaction as t on t.order_id=bid.auction left join product_auction as pa on pa.id='".$auctionid."' left join product as prod on prod.id=pa.prod_id where bid.auction='".$auctionid."' AND bid.price=(SELECT MAX(price) FROM bid_tbl_cart where auction='".$auctionid."')";
        $query=$this->db->query($sql);
        $result['data']=$query->result();
        
           $this->db->select('t.trans_id,ts.*');
            $this->db->join('transaction_sellers ts','t.trans_id=ts.trans_id','left');
            $this->db->where('order_id',$auctionid);$this->db->where('payment_for','bidproduct');
            $query1=$this->db->get('transaction t');
            if($query1 -> num_rows() > 0){$result['trans']=array('res'=>true,'rows'=>$query1->row());}
            else{$result['trans']=array('res'=>false);}
        
        //echo $this->db->last_query(); exit;
        if($result){
            echo json_encode(array('res'=>true,'data'=>$result));
        }else{
            echo json_encode(array('res'=>false,'data'=>''));
        }
    }
    public function yourbid($id){
        //$this->is_buyer();
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/product/vw_yourbid');
        $this->load->view('include/footer');
    }
    
    public function savesearches(){
        $this->is_buyer();
         $comment1=array('val'=>'cat.category,s.add_date,s.id','table'=>'savesearch as s','where'=>array("s.user_id"=>$this->userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'s.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'s.cat_id=cat.id','join_type'=>''),
        );

        $table=array("table"=>"savesearch","where"=>array("user_id"=>$this->userid));
        $config = array();
        $config["base_url"] = BASE_URL. "product/savesearch";
        $config["total_rows"] = $this->common->record_count_where($table);
        $config["per_page"] = 15;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['products']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);

        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('userlogin/product/vw_save_searches',$resp);
        $this->load->view('include/footer');      
    }
    
    
    public function searchdetails($id){
        $this->is_buyer();
        $data=array("table"=>"savesearch","val"=>"","where"=>array("id"=>$id));
        $log=$this->common->getsinglerow($data);
        //print_r($log);
        $resp['catid']=$log['rows']->cat_id;
        $category=$this->getcategory($resp['catid']);
        $resp['categoryname']=$category['rows'][0]->category;
        $resp['searchid']=$id;
        //print_r($category);
        if($log['res']){
            $query=$this->db->query($log['rows']->searchdata);
            $resp['products']=array("res"=>true,"rows"=>$query->result());
            //echo "<pre>";
            //print_r($resp);
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('userlogin/product/vw_save_searche_details',$resp);
            $this->load->view('include/footer'); 
        }else{
            $this->session->set_userflash("warning","This search not available.");
            redirect("product/savesearches","refresh");
        }
    }
    

    
    
    public function deletesearches(){
        $this->is_buyer();
        $id = $this->input->post("id");        
        $data=array('table'=>'savesearch','where'=>array('id'=>$id));
        $log=$this->common->delete_data($data);
        
        //$log=1;
        if($log){
            echo json_encode(array('status'=>true,'message'=>'Deleted successfully.'));
        }
    }
    
    
    public function addreview(){
        $sellerid=$this->userid;
        $buyerid=$this->input->post("revuserId");
        $reviews=$this->input->post("reviews");
        $bidid=$this->input->post("bidid");
        $prodid=$this->input->post("prodid");
        $current_date=date('Y-m-d');
        $data=array("table"=>"buyer_review","val"=>array("bid_id"=>$bidid,"rv_from"=>$sellerid,"rv_for"=>$buyerid,"review"=>$reviews,"status"=>"1","rv_date"=>$current_date));
        $adddata=$this->common->add_data($data);
        if($adddata){$countdata=array("table"=>"buyer_review","where"=>array("rv_for"=>$buyerid,"status"=>'1'));
        $penaltypoint=$this->common->count_val($countdata);
        if($penaltypoint>=3){ // send notification to admin
            $adddata1=array("table"=>"penalty_noti","val"=>array("userid"=>$buyerid));
            $addpenalty=$this->common->add_data($adddata1);
            $username=$this->getusername($buyerid);
            //send email notification to admin for panelty seller
            $message='<table style="width:70%;margin:auto; border:2px solid #ccc;">
                        <tr>
                            <td style="padding-left:10px;"><h3>Penalty user notification</h3><br/><br/>
                            '.$username.' buyer has 3 penalty point. Please review this buyer.
                        </td>
                        </tr>
                    </table>';
                    
                     $email1=array('from'=>'test@ucodice.com','to'=>"test@ucodice.com",'subject'=>'Penalty User Notification','message'=>$message);
                     $sendmail=$this->functions->_email($email1);
        }
        $this->session->set_flashdata("sucess","Your review added successfully.");
        redirect("product/details/$prodid","refresh");
        }        
    }
    
    
    public function rebid($prodid=''){
        $this->is_seller();
        $currentdate=date('Y-m-d');
        $data=array("table"=>"product","where"=>array("id"=>$prodid,"bid_status"=>'1','bid_purchase_date < '=>"$currentdate",'user_id'=>$this->userid),"val"=> array("id"));
        $res=$this->common->getsinglerow($data);
        //echo $this->db->last_query();
        //print_r($res);exit;
        if(!$res['res']){
            $this->session->set_flashdata("warning","Not allowed");
            redirect("_404","refresh");
        }
        
        $this->form_validation->set_rules('price','Price','trim|required|numeric|less_than_equal_to[100000]');
        $this->form_validation->set_rules('bid_start','Bid Start Date','trim|required');
        $this->form_validation->set_rules('bid_end','Bid End Date','trim|required');
        $this->form_validation->set_rules('bid_purchase','Product Purchase Date','trim|required');
           
        if($this->form_validation->run()){
        $prodid= $this->input->post("prodid");   
        $price=$this->input->post("price");
        $bid_start_date=$this->input->post("bid_start");
        $bid_end_date=$this->input->post("bid_end");
        $bid_end_time=date('23:59:59');
        $bid_end_date=$bid_end_date." ".$bid_end_time;
        $bid_purchase_date=$this->input->post("bid_end");
                     
        $prod_data=array('table'=>'product','val'=>array('prod_price'=>$price,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date),"where"=>array("id"=>$prodid));
        $prodres=$this->common->update_data($prod_data);
        if($prodres){
        $adata=array('table'=>'product_auction','val'=>array("status"=>'0'),"where"=>array("prod_id"=>$prodid,"status"=>'1'));                
        $alog=$this->common->update_data($adata);
        }
        if($alog){
        $data=array('table'=>'product_auction','val'=>array("prod_id"=>$prodid,"bid_start_date"=>$bid_start_date,"bid_end_date"=>$bid_end_date,"bid_purchase_date"=>$bid_purchase_date,"price"=>$price));                
        $log=$this->common->add_data($data);
        }
        if($log){
            $this->session->set_flashdata("sucess","Product has been added successfully for rebid.");
            redirect("product/details/$prodid","refresh");
        }
        
        }else{
            $resp['prodid']=$prodid;
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft',$resp);
            $this->load->view('userlogin/product/vw_rebid');
            $this->load->view('include/footer');
        }
    }
    
    
    
    
}    
