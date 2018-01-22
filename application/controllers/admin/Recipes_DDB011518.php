<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipes extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
        $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id as userid,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.recipe_stetus,rs.admin_status,rs.id as recipeid,cat.category','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'u.id=rs.user_id','join_type'=>'left'),
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
        );
        //$table=array("table"=>"recipe","where"=>array("recipe_stetus"=>'1'));
        $recipetotal=$this->common->multijoin($comment1,$multijoin1);
        //print_r(count($recipetotal['rows']));exit;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/recipes/";
         if($recipetotal['res']){
        $config["total_rows"] = count($recipetotal['rows']);}
		else{$config["total_rows"] ="";
		}
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['categorylist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
       
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo $this->db->last_query();
        //print_r($resp['recipe']);exit;
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/recipes/admin_vw_recipelist',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function add(){
        $this->form_validation->set_rules('name','Category Name','trim|required');
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $status=$this->input->post("status");
            $data=array('table'=>'recipe_category','val'=>array('category'=>$name,'status'=>$status));                
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Category has been added successfully.");
                redirect("admin/recipes/add/","refresh");
            }
        }else{
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/recipes/admin_vw_addcategory');
        $this->load->view('admin/include/admin_footer');
        }
    }
	
	
	
	public function add_new(){
        $this->form_validation->set_rules('name','Recipe Name','trim|required');
        $this->form_validation->set_rules('Type','Recipe Type','trim|required');
        $this->form_validation->set_rules('details','Recipe Details','trim|required');
        if($this->form_validation->run())
            {        
            $userid=0;        
            $name=$this->input->post("name");
            $Type=$this->input->post("Type");
            $video_link=$this->input->post("video_link");
            $details=$this->input->post("details");
            $RecipeAddDate = date('Y-m-d'); 
            $RecipeUpdateDate=date('Y-m-d'); 
            $status=$this->input->post("status");  
            
            if($_FILES['file']['name']!='') // done by jat
            { 
                $userfile='file';
                $image_path='assets/image/recipe/';
                $allowed='jpg|png|jpeg';
                $max_size='4096000'; // 4 mb
                
                //$fileupload=$this->functions->_upload_image($userfile,$image_path,$allowed,$max_size);
                $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
                //print_r($fileupload);exit;
                $prodImage=$fileupload['filename'];
                
            } else{
				// now check if image url is valid one or not
				$ch = curl_init($this->input->post("image_url"));
				curl_setopt($ch, CURLOPT_NOBODY, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_exec($ch);
				$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					if($retcode==200) 
					{
						$prodImage=$this->input->post("image_url");
					}
					else if($retcode==0 && $retcode !=""){
						$this->session->set_flashdata("warning","Image path is invalid.Please try again.");
                        redirect("admin/recipes/add_new","refresh");  
					}
					else $prodImage='recipe.png';										
				// $retcode >= 400 means not found, $retcode = 200 means found.
				curl_close($ch);	
				//$fileupload=array('status'=>1,'filename'=>'recipe.png');
            }             
              
           if($prodImage=='' || $prodImage==NULL) $prodImage='recipe.png'; 
            $data=array('table'=>'recipe','val'=>array('user_id'=>$userid,'recipe_type'=>$Type,'recipe_title'=>$name,'recipe_detail'=>$details,'image_path'=>$prodImage,'video_link'=>$video_link,'recipe_addDate'=>$RecipeAddDate, 'recipe_updateDate'=>'0000-00-00','recipe_stetus'=>$status));
            $log=$this->common->add_data($data);
            if($log)
                {
                    $this->session->set_flashdata("sucess","Recipe has been added successfully.");
                    redirect("admin/recipes/add_new/","refresh");
                }else{ 
                    $this->session->set_flashdata("warning","Recipe not added successfully.");     
                    redirect("admin/recipes/add_new/","refresh");
                }
            }else{ 
                $data=array('val'=>array('id','category'),'table'=>'recipe_category','where'=>array('status'=>'1'));
                $resp['category']=$this->common->getdata($data);
                $this->load->view('admin/include/admin_header');
				$this->load->view('admin/include/admin_left');
				$this->load->view('admin/recipes/admin_vw_addrecipe',$resp);
				$this->load->view('admin/include/admin_footer');
            }
    }
	
	
	
	public function editrecipe($id){
        $data=array('val'=>array(),'table'=>'recipe','where'=>array('id'=>$id));
        $resp['recipe']=$this->common->getdata($data);
        $data=array('val'=>array('id','category'),'table'=>'recipe_category','where'=>array('status'=>'1'));
        $resp['category']=$this->common->getdata($data);
        
        $this->load->view('admin/include/admin_header');
		$this->load->view('admin/include/admin_left');
		$this->load->view('admin/recipes/admin_vw_editrecipe',$resp);
		$this->load->view('admin/include/admin_footer');
    }
	
	
	public function updaterecipe()
    {
       
        $this->form_validation->set_rules('name','Recipe Name','trim|required');
        $this->form_validation->set_rules('Type','Recipe Type','trim|required');
        $this->form_validation->set_rules('details','Recipe Details','trim|required');
        if($this->form_validation->run())
            {    
            $recipeId=$this->input->post("recipeId");
            $userid=0;        
            $name=$this->input->post("name");
            $Type=$this->input->post("Type");
            $details=$this->input->post("details");
            $video_link=$this->input->post("video_link");
            $RecipeAddDate = date('Y-m-d'); 
            $RecipeUpdateDate=date('Y-m-d'); 
            $status=$this->input->post("status");
            
            // get already existing image details
             $proddata=array("table"=>"recipe","where"=>array("id"=>$recipeId),"val"=> array("image_path"));
                $product=$this->common->getsinglerow($proddata);
                $path="assets/image/recipe/".$product['rows']->image_path;
                $path2="assets/image/recipe/thumb/".$product['rows']->image_path;
                
            if($_FILES['file']['name']!="")
            {   if($product['rows']->image_path!='recipe.png'){     
                @unlink($path);
            @unlink($path2);}
                $userfile='file';
                $image_path='assets/image/recipe/';
                $allowed='jpg|png|jpeg';
                $max_size='4096000'; // 4 mb

                //$fileupload=$this->functions->_upload_image($userfile,$image_path,$allowed,$max_size);
                $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
               $imagefilename= $fileupload['filename'];
              // echo         $imagefilename; echo 'ley';  
         }
         else if($this->input->post("image_url")!='')
         { 
				// now check if image url is valid one or not
				$ch = curl_init($this->input->post("image_url"));
				curl_setopt($ch, CURLOPT_NOBODY, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_exec($ch);
				$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				if($retcode==200) 
					{
						$imagefilename=$this->input->post("image_url");
						@unlink($path); @unlink($path2);
						
                     }
				else{
						$this->session->set_flashdata("warning","Given image path is invalid. Try again with other path.");
                        redirect("admin/recipes/editrecipe/".$recipeId,"refresh");  
					}
				//echo $retcode;				
				curl_close($ch);
				//echo 'tata';
				
         } else{ 
             $imagefilename='';
         }
         
          // echo 'volvo'; exit;	
          
          $fields_to_update=array('user_id'=>$userid,'recipe_type'=>$Type,'recipe_title'=>$name,'recipe_detail'=>$details, 'recipe_updateDate'=>$RecipeUpdateDate,'video_link'=>$video_link,'admin_status'=>$status);    
               
         
         
			if($imagefilename!='') {
				$ttemp=array('image_path'=>$imagefilename);
				$fields_to_update=array_merge($fields_to_update, $ttemp);
                        }
             $data=array('table'=>'recipe','where'=>array('id'=>$recipeId),'val'=>$fields_to_update);	
            
            $log=$this->common->update_data($data);
            // print_r($data); exit;
            ///`harvest`.`recipe` (`id`, `user_id`, rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate, `recipe_stetus`) 
            if($log)
                {
                    $this->session->set_flashdata("sucess","Recipe updated successfully.");
                    redirect("admin/recipes/","refresh");
                }else{ 
                    $this->session->set_flashdata("sucess","Recipe not updated");
                    redirect("admin/recipes/","refresh");                   
                }
            }else{ 
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('recipe/addrecipe');
            $this->load->view('include/footer');
            }
    }
	
	
	
    
    
    public function editcategory($id){
        $data=array('val'=>array(),'table'=>'recipe_category','where'=>array('id'=>$id));
        $log['category']=$this->common->getdata($data);
        if(!$log['category']['res']){
            $this->session->set_flashdata("warning","This category not in category list.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/recipes/admin_vw_editcategory',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function updatecategory(){
        $this->form_validation->set_rules('name','Category Name','trim|required');
        $id=$this->input->post("id");
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $status=$this->input->post("status");
            $data=array('table'=>'recipe_category','where'=>array('id'=>$id),'val'=>array('category'=>$name,'status'=>$status));                
            $log=$this->common->update_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Category has been updated successfully.");
                redirect("admin/recipes","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'fourm_category','where'=>array('id'=>$id));
            $log['category']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/forum/admin_vw_editcategory');
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    
    public function activecat(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"recipe_category","val"=>array("status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Category(ies) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactivecat(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"recipe_category","val"=>array("status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Category(ies) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function deletecat(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"recipe_category","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Category(ies) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function views($catid){
        $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id as userid,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.recipe_stetus,rs.admin_status,rs.id as recipeid,cat.category','where'=>array("rs.recipe_type"=>$catid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'u.id=rs.user_id','join_type'=>'left'),
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
        );
        //$table=array("table"=>"recipe","where"=>array("recipe_stetus"=>'1'));
        $recipetotal=$this->common->multijoin($comment1,$multijoin1);
        //print_r(count($recipetotal['rows']));exit;
        $config = array();
        $config["base_url"] = BASE_URL. "admin/recipes/views/".$catid;
         if($recipetotal['res']){
        $config["total_rows"] = count($recipetotal['rows']);}else{$config["total_rows"] ="";}
        $config["per_page"] = 12;
        $config["uri_segment"] = 5;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(5))? $this->uri->segment(5) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['categorylist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
       
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo $this->db->last_query();
        //print_r($resp['recipe']);exit;
        
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/recipes/admin_vw_recipelist',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    public function details($rid){
        $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id as userid,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.recipe_stetus,rs.admin_status,rs.id as recipeid,rs.video_link,cat.category, usi.business_name','where'=>array("rs.id"=>$rid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'u.id=rs.user_id','join_type'=>'left'),
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>''),
            array('table'=>'user_store_info as usi','on'=>'usi.user_id=u.id','join_type'=>'left')
        );
        
        $resp['recipe']=$this->common->multijoin($comment1,$multijoin1);
       // echo "<pre>";
        //print_R($resp);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/recipes/admin_vw_recipelistdetails',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    
    
    public function active(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"recipe","val"=>array("admin_status"=>'1'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Recipe(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"recipe","val"=>array("admin_status"=>'0'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Recipe(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function delete(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"recipe","where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->delete_in_data($data);
        //echo $this->db->last_query();
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Recipe(s) deleted."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function search($catid=null){
        $searchby=$this->input->get('searchby');
        $val=$this->input->get('val');$val=trim($val);
        if($searchby=='category'){
            $comment1=array('val'=>'COUNT(r.id) AS `Noofrecipe`,rc.id as Catid,rc.category,rc.status','table'=>'recipe_category as rc','where'=>array('rc.id'=>$val),'minvalue'=>'','group_by'=>'rc.id','start'=>'','orderby'=>'rc.id','orderas'=>'DESC');
            $resp=$this->searchbycategory(trim($val),$comment1,$searchby);
        }else if($searchby=='user'){
            //if($val==''){$where=array("rs.recipe_type"=>$catid);}else{$where=array("rs.user_id"=>$val,"rs.recipe_type"=>$catid);}
            //$comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,cat.category,u.username','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array());
            $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id as userid,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.recipe_stetus,rs.admin_status,rs.id as recipeid,cat.category','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC',"like"=>array("likeon"=>"u.username","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby,$catid);
        }
		else if($searchby=='title'){
           
            //$comment1=array('val'=>'p.id,p.prod_name,p.prod_price,p.date,p.admin_status,cat.category,u.username','table'=>'product as p','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'p.user_id','orderas'=>'DESC',"like"=>array());
            $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id as userid,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.recipe_stetus,rs.admin_status,rs.id as recipeid,cat.category','where'=>array(),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC',"like"=>array("likeon"=>"rs.recipe_title","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby,$catid);
			
        }
	
	else if($searchby=='admin'){
             $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id as userid,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.recipe_stetus,rs.admin_status,rs.id as recipeid,cat.category','where'=>array('user_id'=>'0'),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC',"like"=>array("likeon"=>"rs.recipe_title","likeval"=>$val));
            $resp=$this->searchbyother(trim($val),$comment1,$searchby,$catid);
        }
		
		else{
            $this->session->set_flashdata("warning","Wrong data search");
            redirect("admin/recipes","refresh");
        }
        if($searchby=='category'){ // category searching
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/recipes/admin_vw_recipecat',$resp);
            $this->load->view('admin/include/admin_footer');
        }else{
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/recipes/admin_vw_recipelist',$resp);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function searchbycategory($val,$comment1,$searchby){
        $multijoin1=array( array('table'=>'recipe as r','on'=>'rc.id=r.recipe_type','join_type'=>'left'));
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/recipes/search?searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
         
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $log['categorylist']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        //echo $this->db->last_query();exit;
        $log["links"] = $this->pagination->create_links();
        $log['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        return $log;
    }
    
    public function searchbyother($val,$comment1,$searchby,$catid){
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'u.id=rs.user_id','join_type'=>'left'),
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
        );
        
        $table=$this->common->multijoin_with_like($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/recipes/search/$catid/?searchby=$searchby&val=$val";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 10;
        $config["uri_segment"] = $this->input->get('per_page');
        $config['page_query_string']=true;
        $this->pagination->initialize($config); 
        //$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['categorylist']=$this->common->multijoin_with_like($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        return $resp;
    }
    
    
    public function getcagegory(){
        $data=array("table"=>"recipe_category","val"=>array(),"where"=>array("status"=>"1"));
        $log=$this->common->getdata($data);
        echo json_encode($log);
    }
    
    
    
} 
