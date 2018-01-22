<?php 
//include 'Editmodel.php';
class ModelSite extends CI_Model 
{  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
    $this->load->database();            
    //$this->load->model('modelsite');
  }
 //$dbconnect = $this->load->database();
 
  function sub_menu($id,$p,$user_id)
 {
     $query= $this -> db -> select('id ,sub_id, user_id ,file_path, label , link , parent , sort , view , stetus ,page_title,title_position,browsertab  ')->where("`stetus`=0 AND `parent`=".$p." AND  sort=".$id." AND user_id=".$user_id)->order_by('view')->from('`menu`')->get();
      if($query->num_rows()>0)
      {            
      return $query->result();
      }
      else
      {
          return FALSE;
          
      }
 }
 function get_menu($user_id)
  {
     $query= $this -> db -> select('id ,sub_id, user_id ,file_path, label , link , parent , sort , view , stetus ,user_created,page_title,title_position,browsertab ')->where(" parent=0 AND  sort=0 AND user_id=".$user_id)->order_by('view')->from('menu')->get();//stetus=0 AND
      if($query->num_rows()>0)
      {            
      return $query->result_array();
      }
      else
      {
          return FALSE;
          
      }
  }
  
  function get_menuonshop($user_id)
  {
     $query= $this -> db -> select('id ,sub_id, user_id ,file_path, label , link , parent , sort , view , stetus ,user_created,page_title,title_position,browsertab ')->where("stetus='0' AND parent='0' AND  sort='0' AND user_id=".$user_id)->order_by('view')->from('menu')->get();//stetus=0 AND
      if($query->num_rows()>0)
      {            
      return $query->result_array();
      }
      else
      {
          return FALSE;
          
      }
  }
  function get_ectivemenuinarray($user_id,$pagename)
  {
      $query= $this -> db -> select('id ,sub_id, user_id ,file_path, label , link , parent , sort , view , stetus ,user_created ,page_title,title_position,browsertab ')->where("`stetus`=0 AND `parent`=0 AND  sort=0 AND user_id=".$user_id)->order_by('view')->from('`menu`')->get();
      if($query->num_rows()>0)
      {     
          $val="";
          $stetus=FALSE;
          foreach ($query->result() as $data)
          {
              if(("custum_theme/".$pagename.".php"==$data->file_path)||$pagename==$data->sub_id)
              {
                  $stetus=TRUE;
              }
           //$val.=$data->file_path." ";
          }
          return $stetus;
      }
      else
      {
          return FALSE;
          
      }
  }
  function get_ectivemenuid($user_id,$pagename)
  {
      $dd="custum_theme/".$pagename.".php";
      $query= $this -> db -> select('id ,sub_id, user_id ,file_path, label , link , parent , sort , view , stetus ,user_created ,page_title,title_position,browsertab')->where("`stetus`=0 AND `parent`=0 AND  sort=0 AND (`file_path`='".$dd."' OR `sub_id`='".$pagename."') AND user_id=".$user_id)->order_by('view')->from('`menu`')->get();
      if($query->num_rows()>0)
      { 
         
          foreach ($query->result() as $data)
          {             
              $val=array('sub_id'=>$data->sub_id,'label'=>$data->label,'page_title'=>$data->page_title,'title_position'=>$data->title_position,'main_page_title'=>$data->browsertab);
          }
          return $val;
      }
      else
      {
          return FALSE;
      }
  }
  function get_menueeliment($user_id,$pagename)
  {
      $query= $this->db->select(" `id`, `user_id`, `page_no`, `theme_id`, `element_data` ")->where("`user_id`='".$user_id."' AND `page_no`='".$pagename."'")->from('`db_element`')->get();
      if($query->num_rows()>0)
      { 
          $val="";          
          foreach ($query->result() as $data)
          {             
// print_r($data->element_data);echo "<br/><br/><br/><br/>";     
           $val=$data->element_data;
          }
          //exit();
          return $val;
      }
      else
      {
          return FALSE;
      }
  }
  function member_here($user_id,$theme_id)
    {
        $this->db->select('id, user_id, tag_name, class_type, class_name, class_css ')->where('user_id',$user_id);
        $q = $this->db->get('db_css');
        //$this->db->where('username',$this->input->post('username'));
        //$this->db->where('user_id',$user_id);
        //$q = $this->db->get('');
        //$query = $this->db->get('db_css');
        if($q->num_rows() > 0) 
        {
            /*$data = array();
            foreach($q->result() as $row) 
            {
                $data=$row;
            }*/
            return $q->result_array();
        }
    }
    function get_bootstrap_clasName($user_id,$theme_id)
    {
        $this->db->distinct()->select('class')->where('`user_id`='.$user_id.' AND `theme_id`='.$theme_id);
        $q = $this->db->get('db_bootstrap');
        if($q->num_rows() > 0)
        { 
            $aa = '';           
            foreach ($q->result() as $data)
            {
                $aa=$aa.$data->class."&";
            }          
           return $aa;
        } 
        
       // return $q->result_array();  
        
    }
    function get_bootstrap($user_id,$theme_id)
    {
       //echo $user_id."<br/>"; 
       //echo $theme_id."<br/>"; 
       $q =  $this->db->select('`class`, `bootstrap_name`, `bootstrap_num`')->from('db_bootstrap')->where('`user_id`='.$user_id.' AND `theme_id`='.$theme_id)->get();
        if($q->num_rows() > 0)
        { 
            
            return $q->result_array();
           // print_r($q->result_array());
            //exit;
           // return $aa;
        }else
            {
            $user_id=$this->session->userdata('user_id');
            $this->session->set_flashdata("warning","Sorry!. this user site is deactivat");            
            //$this->session->set_flashdata("warning","Please Fill All The Basic Information, Your Basic Information Is Not Insert Successfully, Sorry ! Please Tray Again");            
            ?>
            <script type="text/javascript">
                window.location.assign('<?php echo BASE_URL;?>');
            </script><?php  //."profile/infoblank"
            redirect("/","refresh");//profile/infoblank
            //echo "data not copy properly db_bootstrap table modelsite model function name is get_bootstrap()";
            //exit();    
        
        }
       // return $q->result_array();  
        
    }
    function get_css_class($user_id,$theme_id)
    {
        $this->db->select("class_name, class_css")->where("user_id",$user_id);
        $qu=$this->db->get('db_css');        
        if($qu->num_rows()>0)
        {
               $val='';
               foreach($qu->result() as $data)
               {
                   $val=$val.$data->class_name."&";
               }
               return $val;                         
        }
    }
    function get_css_css($user_id,$theme_id)
    {
        $this->db->select("class_name, class_css")->where("user_id",$user_id);
        $qu=$this->db->get('db_css');
        
        if($qu->num_rows()>0)
        {
               $val='';
               foreach($qu->result() as $data)
               {
                   $val=$val.$data->class_css."&";
               }
               return $val;
                         
        }
    }
    
    //for using gallery_image user image 
    function banner_image($user_id)
    {
      $query=  $this->db->select("`id`, `user_id`, `product_id`, `type_ofimage`, `banner_img`, image_path, `status`")->where("`user_id`='".$user_id."' AND `status`='1' AND `banner_img`='1'")->from('userProd_image')->get();
        if($query->num_rows()>0)
      {            
      return $query->result_array();
      }
      else
      {
          
          return FALSE;
          
      }
    }
    
    //for using uservedio
    
    function user_vedio($user_id)
    {
      $query=  $this->db->select("*")->where("`user_id`='".$user_id."' AND `status`='1' AND `type_of_videos`='1'")->from('user_videos')->get();
        if($query->num_rows()>0)
      {            
      return $query->result_array();
      }
      else
      {
          
          return FALSE;
          
      }
    }
    
     //for using user_image user image 
    function get_aboutus_image($user_id,$type_ofmage)
    {
        $query=  $this->db->select("image_path")->where("`user_id`='".$user_id."' AND `status`='1' AND `".$type_ofmage."`='1'")->from('userProd_image')->get();
       // print_R($this->db->last_query());exit;
        if($query->num_rows()>0)
      {     
            $val='';
               foreach($query->result() as $data)
               {
                   $val=$data->image_path;
               }
               return $val;
            //print_r($query->image_path);    
      
      }
      else
      {
          return FALSE;
          
      }
    }
    function get_page_text($user_id,$content_type)
    {
      $query=  $this->db->select("text_data")->where(" `class_name`='".$content_type."' AND `user_id`='".$user_id."'")->from('db_text')->get();
      //print_R($this->db->last_query());
      if($query->num_rows()>0)
      {     
            $val='';
               foreach($query->result() as $data)
               {
                   $val=$data->text_data;
               }
               return $val;
            //print_r($query->image_path);    
      
      }
      else
      {
          return FALSE;
          
      }
    }
    function get_user_active_image($user_id)
    {//SELECT `id`, `user_id`, `product_id`, `type_ofimage`, `banner_img`, `about_us_pic`, `image_path`, `view`, `status` FROM `userProd_image` WHERE `status`='1' AND `user_id`
        $query=  $this->db->select("`id`, `user_id`, `product_id`, `type_ofimage`, `banner_img`, image_path, `status`")->where("`user_id`='".$user_id."' AND `status`='1'")->order_by('gallery_view')->from('userProd_image')->get();
        if($query->num_rows()>0)
      {            
      return $query->result_array();
      }
      else
      {
          return FALSE;
          
      }
    }
    
    function get_user_active_image_shop($user_id,$limit=0, $start=1)
    {//SELECT `id`, `user_id`, `product_id`, `type_ofimage`, `banner_img`, `about_us_pic`, `image_path`, `view`, `status` FROM `userProd_image` WHERE `status`='1' AND `user_id`
          $this->db->select("`id`, `user_id`, `product_id`, `type_ofimage`, `banner_img`, image_path, `status`")->where("`user_id`='".$user_id."' AND `status`='1'")->order_by('gallery_view')->from('userProd_image');
        if($limit > 0){
                $this->db->limit($limit, $start);
            }
            $query=  $this->db->get();
        if($query->num_rows()>0)
      {            
      return $query->result_array();
      }
      else
      {
          return FALSE;
          
      }
    }
    
    function count_val($data)
    {
        $this->db->select('id');
        $this->db->from($data['table']);
        if($data['where']!='')
        {
            $this->db->where($data['where']);
        }
        return $num_results = $this->db->count_all_results();
    }
    
    public function get_product($user_id,$prod_id)
    {
        if($prod_id==''){
            $query=  $this->db->select("*")->where(" id=(SELECT max(id) FROM `product` where `user_id`='".$user_id."')", NULL, FALSE)->from('product')->get();
        }else{
            $query=  $this->db->select("*")->where("`id`='".$prod_id."' AND `user_id`='".$user_id."' ")->from('product')->get();    
        }
        //print_R($this->db->last_query());exit;
        if($query->num_rows()>0)
      {           //print_r($query);exit;
      return $query->result_array();
      }
      else
      {
          
          return FALSE;
          
      }
       // print_r($prod_id);exit;
    }
    
    
    //neraj
    public function get_profile_page_position($user_id){
        
       $this -> db -> select(array("div_id","position"));
       $this -> db -> from('view_position');
       $this -> db -> where(array("user_id"=>$user_id,"page"=>'profile'));
       $this -> db -> order_by('position','asc');
       $query = $this -> db -> get();
        if($query->num_rows()>0)
        { 
            return array("status"=>true,"rows"=>$query->result_array());
        }else{
            return array("status"=>false);
        }
    }
    
    
    
    public function get_footer_position($user_id){
        
       $this -> db -> select(array("div_id","position"));
       $this -> db -> from('view_position');
       $this -> db -> where(array("user_id"=>$user_id,"page"=>'footer'));
       $this -> db -> order_by('position','asc');
       $query = $this -> db -> get();
        if($query->num_rows()>0)
        { 
            return array("status"=>true,"rows"=>$query->result_array());
        }else{
            return array("status"=>false);
        }
    }
    
    public function get_about_position($user_id){
        
       $this -> db -> select(array("div_id","position"));
       $this -> db -> from('view_position');
       $this -> db -> where(array("user_id"=>$user_id,"page"=>'about'));
       $this -> db -> order_by('position','asc');
       $query = $this -> db -> get();
        if($query->num_rows()>0)
        { 
            return array("status"=>true,"rows"=>$query->result_array());
        }else{
            return array("status"=>false);
        }
    }
    public function getdataforgalleryimage($data){
        
        $this->db->select($data['val']);
        $this->db->from($data['table']);
        $this->db->where($data['where']);
        $query = $this->db->get(); 
        
         if($query -> num_rows() > 0)
            {        $counter=0;     
            $data=$query->result();
            $massage='';
            if($data[0]->banner_img!=0){
                
                $massage=$massage.'This image  Use in Banner ';   
                if($counter>0){$massage=$massage.' or '; $counter++;}
            }
            if($data[0]->about_us_pic!=0){
                if($counter>0){$massage=$massage.' This image ';}
                $massage=$massage.' Use in About Us '; 
                if($counter>0){$massage=$massage.' or ';$counter++;}
            }
            if($data[0]->contact_us_pic!=0){
                if($counter>0){$massage=$massage.' This image';}
                $massage=$massage.' Use in Contect Us '; 
                if($counter>0){$massage=$massage.' or ';$counter++;}
            }
             
             $massage=$massage.' Are you sure to delete this ';
             
            $result=array('res'=>true,'rows'=>$query->result(),'massege'=>$massage);
            return $result;     
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
        
    }
}