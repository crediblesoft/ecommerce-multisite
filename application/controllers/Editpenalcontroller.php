<?php 
class Editpenalcontroller extends CI_Controller {
    //public $theme_user_id='';
    public function __construct() {
            parent::__construct();
            /*$this->load->helper('array');
            $this->load->helper('url'); */   
            $this->load->database();            
            $this->load->model('editmodel');
            $this->load->library('cart');
          
            //$this->functions->_valid_user();
            //$this->editfunctions->_user_permission();
            //$this->functions->_afterloginpage_delete();
        }
        ////SELECT `id`, `user_id`, `prod_id`, `prod_view_id` FROM `product_view`
        public function get_product($user_id,$limit=0,$start=1){
            $current_date=date("Y-m-d");
        $comment1=array('val'=>'view.prod_view_id ,p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.bid_status,p.pord_detail,p.bid_end_date',
            'table'=>'product as p',
            'where'=>array("p.user_id"=>$user_id,"p.status"=>"1","p.no_of_Prod > "=> '0',"p.admin_status"=>"1"),
            "or_where"=>array("p.bid_end_date >="=>$current_date,"p.bid_end_date ="=>"0000-00-00"),
            'minvalue'=>'',
            'group_by'=>'',
            'start'=>'',
            'orderby'=>'view.prod_view_id',
            'orderas'=>'asc');
       
        $multijoin1=array( array('table'=>'product_view as view','on'=>'p.id=view.prod_id','join_type'=>'left'),
            //array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
           // array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
           
        );
        // echo $this->db->last_query();exit;
        $resp['products']=$this->editmodel->multijoin($comment1,$multijoin1,$limit,$start);
        //echo "<pre>";
        //print_r($resp); exit;
        return $resp['products']=$this->editmodel->multijoin($comment1,$multijoin1,$limit,$start);        
    }
    
    
    
    public function get_product_edit($user_id){
        $comment1=array('val'=>'view.prod_view_id ,p.id as prod_id,p.prod_name,p.prod_price,p.status,p.prod_img,p.bid_status,p.pord_detail',
            'table'=>'product as p',
            'where'=>array("p.user_id"=>$user_id),
            'minvalue'=>'',
            'group_by'=>'',
            'start'=>'',
            'orderby'=>'view.prod_view_id',
            'orderas'=>'asc');
        $multijoin1=array( array('table'=>'product_view as view','on'=>'p.id=view.prod_id','join_type'=>'left'),
            //array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
           // array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
           
        );
        return $resp['products']=$this->editmodel->multijoin($comment1,$multijoin1);        
    }
    
    public function addtocart($prodId,$qty=1){
        
        if(($this->session->userdata('user_type')=="2")||(!$this->session->userdata('user_type'))){
        //echo $prodId."<br/>";
       $this->db->select('u.state,u.zip,s.code');
        $this->db->where(array('u.id'=>$this->session->userdata("user_id")));
        $this->db->join('statelist s','u.state=s.id');
        $buyerstate=$this->db->get('user_Info u')->row();
        
        //$comment1=array('val'=>'u.id as sellerid,u.f_name,u.l_name,IF(p.taxable_status="1"if(u.state='.$buyerstate->state.',IFNULL(dt.total,"0"),ut.total,"0") as sellertax,p.id as prod_id,p.prod_name,p.local_shipping,p.prod_price,p.prod_img,cat.category,cat.id as catid','table'=>'product as p','where'=>array("p.id"=>$prodId),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $comment1=array('val'=>'u.id as sellerid,u.f_name,u.l_name,IF(p.taxable_status="1",if(u.state="'.$buyerstate->state.'",IFNULL(ut.total,"dt"),"0"),"0") as sellertax,dt.total as defaulttax ,p.id as prod_id,p.prod_name,p.local_shipping,p.prod_price,p.prod_img,cat.category,cat.id as catid','table'=>'product as p','where'=>array("p.id"=>$prodId),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            array('table'=>'user_Info as u','on'=>'p.user_id=u.id','join_type'=>''),
            array('table'=>'user_tax as ut','on'=>'u.id=ut.user_id','join_type'=>'left'),
            array('table'=>'default_tax as dt','on'=>'u.state=dt.state_id','join_type'=>'left'),
        );
        $resp=$this->common->multijoin($comment1,$multijoin1);
        //echo "<pre>";
        //print_r($resp);
        $product=$resp['rows'][0];
        
          if($product->sellertax=='dt'){
            $sellertax=$product->defaulttax;
        }else{$sellertax=$product->sellertax;}
        $data=array(
        'id'      => $product->prod_id,
        'qty'     => $qty,
        'price'   => $product->prod_price,
        'name'    => $product->prod_name,
        'local_shipping' => $product->local_shipping,    
        'options' => array('Category' => $product->category,'image'=> $product->prod_img,'sellerid'=>$product->sellerid, 'sellername' => $product->f_name.' '.$product->l_name,'local_shipping'=>$product->local_shipping,'sellertax'=>$sellertax)
        );
        //echo "<pre>";
        //print_r($data);exit;
        $add=$this->cart->insert($data);
        $this->session->set_flashdata("sucess"," Product add successfully in your cart");
         $path=trim($user_name."/Shope/prod_view/".$product->prod_id);
        //print_r(BASE_URL.$path);exit;
        //header("location:javascript://history.go(-1)");
//        /redirect($path,"refresh");
         
        }else{
          $this->session->set_flashdata("warning"," As seller you can't add to cart  ");  //Please loging with buyer acount
        }
        ?><script>
         window.history.back();
         </script>
             <?php 
    }
    public function addtocart_f_p_d($prodId,$qty=1){
        //echo $prodId."<br/>";
        
        $comment1=array('val'=>'p.id as prod_id,p.user_id ,p.prod_name,p.prod_price,p.prod_img,cat.category,cat.id as catid','table'=>'product as p','where'=>array("p.id"=>$prodId),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            //array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
        );
        $resp=$this->editmodel->multijoin($comment1,$multijoin1);
        //print_r($resp);exit;
        $product=$resp['rows'][0];
        
        $ardata=array("table"=>"user_Info","where"=>array("id"=>$product->user_id),"val"=>array("username"));
        $record=$this->editmodel->getsinglerow($ardata);
        $user_name=$record['rows']->username;
        //print_r($user_name);exit;    
        
        $data=array(
        'id'      => $product->prod_id,
        'qty'     => $qty,
        'price'   => $product->prod_price,
        'name'    => $product->prod_name,
        'options' => array('Category' => $product->category,'image'=> $product->prod_img)
        );

        $add=$this->cart->insert($data);
        $this->session->set_flashdata("sucess","Product added successfully in your cart");
        //print_r($user_name."/Shope/prod_cart/$product->prod_id");//exit;
         //header("location:javascript://history.go(-1)");
       //redirect($user_name."/Shope/prod_detail/$product->prod_id","refresh");
         ?><script>
         window.history.back();
         </script>
             <?php 
    }
    public function add_more_cart($prodId,$qty=1){
       // echo $prodId;
       
       $comment1=array('val'=>'p.id as prod_id,p.user_id ,p.prod_name,p.prod_price,p.prod_img,cat.category,cat.id as catid','table'=>'product as p','where'=>array("p.id"=>$prodId),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            //array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
        );
        $resp=$this->editmodel->multijoin($comment1,$multijoin1);
        //print_r($resp);exit;
        $product=$resp['rows'][0];
        
         $ardata=array("table"=>"user_Info","where"=>array("id"=>$product->user_id),"val"=>array("username"));
        $record=$this->editmodel->getsinglerow($ardata);
        $user_name= $record['rows']->username;
        //print_r($user_name);exit; 
        
        $data=array(
        'id'      => $product->prod_id,
        'qty'     => $qty,
        'price'   => $product->prod_price,
        'name'    => $product->prod_name,
        'options' => array('Category' => $product->category,'image'=> $product->prod_img)
        );
        
        $add=$this->cart->insert($data);
        $this->session->set_flashdata("sucess","Product added successfully in your cart");
        //print_r($data);exit;
        //redirect($user_name."/Shope/prod_cart/$product->catid","refresh");
         ?><script>
         window.history.back();
         </script>
             <?php 
    }
    public function deletecart(){
        $rowid=$this->input->post('id');
        $remove=$this->cart->remove($rowid);
        if($remove){
            echo json_encode(array("status"=>true,"message"=>"Successfully deleted from cart."));
        }else{
            echo json_encode(array("status"=>false,"message"=>"Error"));
        }
    }
    
    public function updatecart(){
        $username=$this->uri->segment(1);
        
        $update=$this->cart->update($this->input->post());
        if($update){
        $this->session->set_flashdata("sucess","Your cart has been updated successfully.");
        }else{
            $this->session->set_flashdata("warning","Error");
        }
        //redirect($username."/Shope/prod_cart","refresh");
         ?><script>
         window.history.back();
         </script>
             <?php 
    }
    public function subtract_more_cart($prodId,$qty=1)
    {
        $data = array();
      
        foreach ($this->cart->contents() as $items)
        {
          $prodoption= $this->cart->product_options($items['rowid']);
          //print_r($items['rowid']);echo"<br/>";
          //$prodId=$items['id'];
          if($items['id'] != $prodId){
           $data[] = array('id' => $items['id'],
                           'qty' => ($items['qty']),
                           'price' => $items['price'],
                           'name' => $items['name'],
               'options' => array('Category' => $prodoption['Category'],'image'=> $prodoption['image'])
               );
               }else{
                   $data[] = array('id' => $items['id'],
                           'qty' => ($items['qty']-1),
                           'price' => $items['price'],
                           'name' => $items['name'],
               'options' => array('Category' => $prodoption['Category'],'image'=> $prodoption['image'])
               );
               }
        }
        
        
        $comment1=array('val'=>'p.id as prod_id,p.user_id ,p.prod_name,p.prod_price,p.prod_img,cat.category,cat.id as catid','table'=>'product as p','where'=>array("p.id"=>$prodId),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
        $multijoin1=array(  
            array('table'=>'category as cat','on'=>'p.category=cat.id','join_type'=>''),
            //array('table'=>'user_store_info as usi','on'=>'p.user_id=usi.user_id','join_type'=>''),
        );
        $resp=$this->common->multijoin($comment1,$multijoin1);
        //print_r($resp);exit;
        $product=$resp['rows'][0];
        
        $ardata=array("table"=>"user_Info","where"=>array("id"=>$product->user_id),"val"=>array("username"));
        $record=$this->editmodel->getsinglerow($ardata);
        $user_name= $record['rows']->username;
        
       // print_r($record);
       //$update= $this->cart->update($data);
        $this->cart->destroy();
       $update= $this->cart->insert($data);
       //print_r($update);
        if($update){
        $this->session->set_flashdata("sucess","Your cart has been updated successfully." );
        }else{
            $this->session->set_flashdata("warning","Error");
        }
       // print_r($data);
        //print_r($user_name);exit;
       // redirect($user_name."/Shope/prod_cart","refresh");
        ?><script>
         window.history.back();
         </script>
             <?php 
    }
    public function checkuserisseller(){
        if($this->session->userdata('user_id')){
            if($this->session->userdata('user_type')=="2"){
                //$this->_buyerinfo();
            }else{
               // $this->_sellerinfo();
                $this->session->set_flashdata("sucess","As a seller you can not add product in cart.");
                //print_r($user_name."/Shope/prod_cart/$product->prod_id");//exit;
                 //header("location:javascript://history.go(-1)");
               //redirect($user_name."/Shope/prod_detail/$product->prod_id","refresh");
                 ?><script>
                 window.history.back();
                 </script>
                     <?php
            }
        }
    }
    
    public function viewsellerwiseEvents($theme_user_id)
    {
      //echo "hi";
        //$user_id=$sellerid; 
        //echo $user_id;  exit;
         $data1=array('val'=>'id, user_id, event_title, event_detail, start_date, start_time, end_Date, end_time, event_link, event_image, event_video, event_color, stetus , admin_status','table'=>'events','where'=>array('user_id'=>$theme_user_id,"admin_status"=>'1','stetus'=>'1'));
        $data['eventdata']=$this->common->getdata($data1);
        
//        $data2=array('val'=>'id, username','table'=>'user_Info','where'=>array('id'=>$theme_user_id,'status'=>'1'));
//        $data['seller_info']=$this->common->getdata($data2);
       
       // print_r($data['seller_info']); exit;
       //echo "<pre>";
       //print_r($data['eventdata']); exit;
         $str="";
        if($data['eventdata']['res']){        
                foreach ($data['eventdata']['rows'] as $res){
                    //print_r($res);exit;
                    $str.="{";
                    $str.="id:         '".$res->id."',";
                    $str.="title:      '".$res->event_title."',";
                    $str.="start:      '".date("Y-m-d", strtotime($res->start_date))."',";
                    $str.="end:        '".date("Y-m-d", strtotime("+1 day",strtotime($res->end_Date)))."',";
                   $str.="url:         '".$res->event_link."',";
                    $str.="color:      '".$res->event_color."'";
                    $str.="},";
                }
        $str=rtrim($str, ",");
        }
        else{
            //$str.="{title: 'No event'}";
        }
        //print_r($str);exit;
        return $data['evendata']=$str;
    }
    
}
?>
