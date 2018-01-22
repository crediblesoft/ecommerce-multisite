<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        //$this->functions->_afterloginpage_delete();
        $this->load->library('MY_Pagination');
    }
    
    public function index()
    {   
        $data=array("table"=>"recipe_category","val"=>array(),"where"=>array("status"=>"1"));
        $resp['allcategory']=$this->common->getdata($data);
        
        $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid,cat.category','where'=>array("rs.recipe_stetus"=>'1','u.status'=>'1',"rs.admin_status"=>"1"),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'u.id=rs.user_id','join_type'=>''),
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
        );
        //$table=array("table"=>"recipe","where"=>array("recipe_stetus"=>'1'));
        $recipetotal=$this->common->multijoin($comment1,$multijoin1);
        //print_r(count($recipetotal['rows']));exit;
        $config = array();
        $config["base_url"] = BASE_URL. "recipe";
         if($recipetotal['res']){
        $config["total_rows"] = count($recipetotal['rows']);}else{$config["total_rows"] ="";}
        $config["per_page"] = 6;
        $config["uri_segment"] = 2;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(2))? $this->uri->segment(2) : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['recipe']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
       
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo $this->db->last_query();
        //print_r($resp['recipe']);exit;
        
        $this->load->view('include/header');
        $this->load->view('recipe/recipe',$resp);
        $this->load->view('include/footer');
       
    }
    public function add()
    {
        //$this->functions->_valid_user();
        $this->_checkvalid("recipe/add");
	//$this->check_img_size("recipe/add");
        //$this->form_validation->set_rules('video_link','Video Link','trim|required');
        $this->form_validation->set_rules('name','Recipe Name','trim|required');
        $this->form_validation->set_rules('Type','Recipe Type','trim|required');
        $this->form_validation->set_rules('details','Recipe Details','trim|required');
        if($this->form_validation->run())
            {        
            $userid=$this->session->userdata('user_id');        
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
					if($retcode==200) $prodImage=$this->input->post("image_url");
					else $prodImage='recipe.png';										
				// $retcode >= 400 means not found, $retcode = 200 means found.
				curl_close($ch);	
				//$fileupload=array('status'=>1,'filename'=>'recipe.png');
            }             
              
           if($prodImage=='' || $prodImage==NULL) $prodImage='recipe.png';
            
            $data=array('table'=>'recipe','val'=>array('user_id'=>$userid,'recipe_type'=>$Type,'recipe_title'=>$name,'recipe_detail'=>$details,'image_path'=>$prodImage,'video_link'=>$video_link,'recipe_addDate'=>$RecipeAddDate, 'recipe_updateDate'=>'0000-00-00','recipe_stetus'=>$status));
            //print_r($data);exit;
            $log=$this->common->add_data($data);
            ///`harvest`.`recipe` (`id`, `user_id`, rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate, `recipe_stetus`) 
            if($log)
                {
                    $this->session->set_flashdata("sucess","Recipe added successfully.");
                    redirect("recipe","refresh");
                }else{ 
                    $this->session->set_flashdata("warning","Recipe not added successfully.");     
                    redirect("recipe/addrecipe","refresh");
                }
            }else{ 
                $data=array('val'=>array('id','category'),'table'=>'recipe_category','where'=>array('status'=>'1'));
                $resp['category']=$this->common->getdata($data);
                $this->load->view('include/header');
                $this->load->view('userlogin/include/vw_userleft',$resp);
                $this->load->view('recipe/addrecipe');
                $this->load->view('include/footer');
            }
    }
    
    public function viewRecipe($recipeid)
    {
        //,"rs.admin_status"=>"1"
        //if($this->session->has_userdata("user_id")){$where=array("cpd.id"=>$id,'user_id'=>$this->session->userdata("user_id"));}else{$where=array("cpd.id"=>$id,'show_stetus'=>'1','stetus'=>'1','ui.status'=>'1');}
        $comment1=array('table'=>'user_Info as u','val'=>'u.type_Of_User,u.store_info,u.id,u.username,u.is_login as useronline,GROUP_CONCAT(bt.category SEPARATOR ",") as business_type,usi.business_name,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title,rs.video_link, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid, rs.recipe_stetus,cat.category','where'=>array("rs.id"=>$recipeid),'minvalue'=>'','group_by'=>'rs.id','start'=>'','orderby'=>'','orderas'=>'');
        if(!$this->session->has_userdata('user_id')){
            $comment1['where']['u.status']='1';
            $comment1['where']['rs.recipe_stetus']='1';
            $comment1['where']['rs.admin_status']='1';
        }
        $multijoin1=array(
            array('table'=>'recipe as rs','on'=>'u.id=rs.user_id','join_type'=>'left'), 
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'left'),
            array('table'=>'user_business_type as ubt','on'=>'u.id=ubt.user_id','join_type'=>'left'),
            array('table'=>'user_store_info as usi','on'=>'u.id=usi.user_id','join_type'=>'left'),
            array('table'=>'category as bt','on'=>'ubt.business_id=bt.id','join_type'=>'left'),
        );         
        $resp['recipe']=$this->common->multijoin($comment1,$multijoin1);
        //print_r($resp['recipe']);
       //echo $this->db->last_query();exit;
       
        if($resp['recipe']['res']){ 
        $this->load->view('include/header');
        $this->load->view('recipe/viewrecipe',$resp);
        $this->load->view('include/footer');        
        }else{
            redirect("_404","refresh");
        }
    }
    
    public function recipeuserlist()
    {
        $userid=$this->session->userdata('user_id');        
        $comment1=array('table'=>'user_Info as u','val'=>'u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid, rs.recipe_stetus,rs.admin_status,cat.category','where'=>array("u.status"=>'1',"u.verified"=>'1',"u.id"=>$userid),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC');
        $multijoin1=array(
            array('table'=>'recipe as rs','on'=>'u.id=rs.user_id','join_type'=>''),
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
        ); 
        
        $recipetotal=$this->common->multijoin($comment1,$multijoin1);        
        $config = array();
        $config["base_url"] = BASE_URL. "recipe/recipeuserlist";
        if($recipetotal['res']){
        $config["total_rows"] = count($recipetotal['rows']);}else{$config["total_rows"] ="";}
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;        
        
        $resp['recipe']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        
        
        $this->load->view('include/header');
        $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('recipe/recipeuserlist',$resp);
        $this->load->view('include/footer');
        if($resp['recipe']['res']){ 
            
        }
        else{
            
        }
    }
    public function delete()
    {
        $this->functions->_valid_user();
        $id = $this->input->post("id");
        
        $data=array('val'=>'*','table'=>'recipe','where'=>array('id'=>$id));
        $result=$this->common->getdata($data);
       if($result['res']){
        $log=$this->common->delete_data($data);
       // print_r($result);
        //$log=1;
                if($log){
                    echo json_encode(array('status'=>TRUE,'message'=>'Data deleted Successfully.'));
               }
               else{
                   echo json_encode(array('status'=>FALSE,'message'=>'Data not deleted successfully.'));
               }
        }
       else{
           echo json_encode(array('status'=>FALSE,'message'=>'You can not delete this recipe <br/> some one doing payment on this.'));
       }
    }
    public function editrecipe($id)
    {
        $this->functions->_valid_user();
        $userid=$this->session->userdata('user_id');        
        $comment1=array('table'=>'user_Info as u','val'=>'u.store_info,u.id,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail,rs.video_link, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid, rs.recipe_stetus','where'=>array("u.status"=>'1',"u.verified"=>'1',"u.id"=>$userid,'rs.id'=>$id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'u.id','orderas'=>'DESC');//,"rs.recipe_stetus"=>'1'
        $multijoin1=array(
            array('table'=>'recipe as rs','on'=>'u.id=rs.user_id','join_type'=>'')           
        ); 
        $resp['recipe']=$this->common->multijoin($comment1,$multijoin1);
        
        $data=array('val'=>array('id','category'),'table'=>'recipe_category','where'=>array('status'=>'1'));
        $resp['category']=$this->common->getdata($data);
        
        $this->load->view('include/header');
         $this->load->view('userlogin/include/vw_userleft');
        $this->load->view('recipe/edit_recipe',$resp);
        $this->load->view('include/footer');
    }
    
    public function updaterecipe()
    {
        $this->functions->_valid_user();
        //$this->form_validation->set_rules('video_link','Video Link','trim|required');
        $this->form_validation->set_rules('name','Recipe Name','trim|required');
        $this->form_validation->set_rules('Type','Recipe Type','trim|required');
        $this->form_validation->set_rules('details','Recipe Details','trim|required');
        if($this->form_validation->run())
            {    
            $recipeId=$this->input->post("recipeId");
            $userid=$this->session->userdata('user_id');        
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
				//echo $retcode;				
				curl_close($ch);
				//echo 'tata';
				
         } else{ 
             $imagefilename='';
         }
         
          // echo 'volvo'; exit;	
          
          $fields_to_update=array('user_id'=>$userid,'recipe_type'=>$Type,'recipe_title'=>$name,'recipe_detail'=>$details, 'recipe_updateDate'=>$RecipeUpdateDate,'video_link'=>$video_link,'recipe_stetus'=>$status);    
               
         
         
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
                    redirect("recipe/recipeuserlist","refresh");
                }else{ 
                    $this->session->set_flashdata("sucess","Recipe not updated");
                    redirect("recipe/recipeuserlist","refresh");                   
                }
            }else{ 
            $this->load->view('include/header');
            $this->load->view('userlogin/include/vw_userleft');
            $this->load->view('recipe/addrecipe');
            $this->load->view('include/footer');
            }
    }
    public function filematch($data)
    {
        /*$dd['fileformat']=array('jpg','png' ,'jpeg');
                $dd['filename']=$_FILES['file']['name'];
                $this->filematch($dd);*/
        $allowed =  $data['fileformat'];
        $allfilename="";
        foreach ($data['fileformat'] as $fileext){
            $allfilename.=$fileext.",";
        }
//array('gif','png' ,'jpg');
        $filename = $data['filename'];//$_FILES['video_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) ) 
        {
            $this->session->set_flashdata("warning","Not valid file formats Sorry Only ".  $allfilename." ! Please Try Again");
            //redirect("campaign/editCampaign/".$campaignId,"refresh");
            ?><script>
             window.location.back();
        </script><?php
        exit;
        }
    }
    
    
    public function filter(){
        $category1=$this->input->post("category");$category=trim($category1);
        $username1=$this->input->post("username");$username=trim($username1);
        $title1=$this->input->post("title");$title=trim($title1);
        $currentpage=$this->input->post("currentpage");
        $in=array();$in_value=array();$categoryinval=array();
        $where=array("rs.recipe_stetus"=>'1','u.status'=>'1',"rs.admin_status"=>"1");
            if($category!=''){ $where['rs.recipe_type']=$category;
//        $categorydata=array('table'=>'recipe_category','like'=>array('likeon'=>'category','likeval'=>$category),'val'=>array('id'),'where'=>array());
//        $categoryres=$this->common->getdata_like($categorydata);if($categoryres['res']){foreach($categoryres['rows'] as $categoryrows){array_push($categoryinval,$categoryrows->id);}}//print_r($categoryinval);exit;
//        if(count($categoryinval)>0){array_push($in,'recipe_type');array_push($in_value,$categoryinval);}else{array_push($in,'recipe_type');array_push($in_value,0);}
        }
        if($username!=''){
            $query="select id from user_Info where f_name Like '%".$username."%' OR l_name Like '%".$username."%' OR  CONCAT(f_name,' ',l_name) Like '%".$username."%' OR  CONCAT(f_name,'',l_name) Like '%".$username."%' OR username Like '%".$username."%'";
            $result=$this->db->query($query);$users=array();$rows=$result->result();
            foreach($rows as $user){array_push($users, $user->id);}
            $userinval=array_unique($users); //print_R($userinval);exit;
            if(count($userinval)>0){array_push($in,'user_id');array_push($in_value,$userinval);}else{array_push($in,'user_id');array_push($in_value,0);}
        }
        if($title!=''){ $like=array("likeon"=>'rs.recipe_title',"likeval"=>$title);}else{ $like=array(); }
        $comment1=array('table'=>'recipe as rs','val'=>'u.type_Of_User,u.store_info, u.id,u.username,u.f_name,u.l_name,u.profile_Pic,rs.recipe_type, rs.recipe_title, rs.recipe_detail, rs.recipe_addDate, rs.recipe_updateDate,rs.image_path,rs.id as recipeid,cat.category','where'=>$where,'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'rs.id','orderas'=>'DESC','like'=>$like,'in'=>$in,'in_value'=>$in_value);
        $multijoin1=array(
            array('table'=>'user_Info as u','on'=>'u.id=rs.user_id','join_type'=>''),
            array('table'=>'recipe_category as cat','on'=>'cat.id=rs.recipe_type','join_type'=>'')
        );
        //print_r($in);print_r($in_value);exit;
        //$resp=$this->common->multijoin_with_multiin($comment1,$multijoin1);
        $table=$this->common->multijoin_with_multiin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "recipe";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 6;
        $config["uri_segment"] = $currentpage;
        $config['next_link'] = FALSE;
        $config['prev_link'] = FALSE;
        $config['page_query_string'] = FALSE;
        $this->pagination->initialize($config); 
        $page = $currentpage;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['recipe']=$this->common->multijoin_with_multiin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //echo $this->db->last_query();exit;       
        echo json_encode($resp);
    }
}
