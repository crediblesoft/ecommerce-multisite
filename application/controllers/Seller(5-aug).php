<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//include_once 'Usereditpenal.php'; Usereditpenal
require_once 'Editpenalcontroller.php';
class Seller extends Editpenalcontroller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('modelsite');
        //$this->functions->_valid_user();
        //$this->functions->_afterloginpage_delete();
        //$this->userid=$this->session->userdata('user_id');
        //$this->load->controller('usereditpenal');
    }
    public function val($ar=  array())
    {
        //echo $this->router->routes;
        //print_r($this->router->routes);
        exit;
    }
    public function edit(){
      $username=$this->uri->segment(1);
      $pre=$this->uri->segment(2);
      $pagename=$this->uri->segment(3);
      $prodid=$this->uri->segment(4);   
      //echo "hhh";exit;
       // exit;
        $ardata=array("table"=>"user_Info","where"=>array("type_Of_User"=>'1',"store_info"=>'1',"status"=>'1',"username"=>$username),"val"=>array("id"));
        $record=$this->editmodel->getsinglerow($ardata);
        $data['user_name']= $username;
        
        $data['storounerlogine']=FALSE;
        if($this->session->userdata('user_id')!=''){        
        $ardata=array("table"=>"user_Info","where"=>array("id"=>$this->session->userdata('user_id')),"val"=>array("username"));
        $record1=$this->editmodel->getsinglerow($ardata);
        $data['getuser_name']= $record1['rows']->username;
        if($username==$data['getuser_name']){$data['storounerlogine']=TRUE;}//for in profile logo show store link
        }
        //print_r($record);exit;
        if($record['res']>0)
        {
            //echo ' recors found Here..'.$record['rows']->id;
            $theme_user_id=$record['rows']->id;
            $themequery="SELECT `id`, `user_id`, `user_store_id`, `theam_id`, `file_name`, `add_date`, `update_date` FROM `db_theem` WHERE `user_id`='".$record['rows']->id."'";
                $thresult=$this->db->query($themequery);
                $themeresult=$thresult->row();                
                $user_file_name= $themeresult->file_name;                
                $user_theam_id= $themeresult->theam_id;
                $data['user_file_name']= $themeresult->file_name;
                $data['user_theam_id']= $themeresult->theam_id; 
                
                //$data['user_product']=(Editpenalcontroller::get_product($theme_user_id));
                 if(($user_theam_id=='1001')||($user_theam_id=='1003')){
                    $data['btn_theme_bootstrap']='info';
                    $data['btn_theme_color']='#ffffff';
                    $data['btn_theme_bgcolor']='#3DB2E1';
                    $data['btn_theme_style']='background: #3DB2E1;color: #FFFFFF;border:none;z-index:331;';
                }
                if(($user_theam_id=='1002')||($user_theam_id=='1004')){
                    $data['btn_theme_bootstrap']='success';
                    $data['btn_theme_color']='#ffffff';
                    $data['btn_theme_bgcolor']='#28C769';
                    $data['btn_theme_style']='background: #73C873;color: #FFFFFF;border:none;z-index:331;';
                }
                /*<?php $theme_id='info';//info ,success, warning ,danger ,primary,primary?>*/
                    $data['member'] = $this->modelsite->member_here($theme_user_id,$user_theam_id);
                    $data['cssclass']=$this->modelsite->get_css_class($theme_user_id,$user_theam_id);
                    $data['bootstrap']=$this->modelsite->get_bootstrap($theme_user_id,$user_theam_id);
                    $data['css']=  $this->modelsite->get_css_css($theme_user_id,$user_theam_id);
                    $data['bootstrapname']=$this->modelsite->get_bootstrap_clasName($theme_user_id,$user_theam_id);
                    $data['get_menu']=  $this->modelsite->get_menuonshop($theme_user_id);
                    $data['gallery']=  $this->modelsite->banner_image($theme_user_id);
                    $data['aboutus_image']=  $this->modelsite->get_aboutus_image($theme_user_id,'about_us_pic');
                    $data['contact_us_pic']=  $this->modelsite->get_aboutus_image($theme_user_id,'contact_us_pic');
                    $data['usersitelogo']=  $this->modelsite->get_aboutus_image($theme_user_id,'usersitelogo');
                    //$data['user_all_image']=  $this->modelsite->get_user_active_image($theme_user_id);
                    if(!empty($data['get_menu'])){
                    foreach ($data['get_menu'] as $get_menu_data)
                    {
                       $data['pagename'.$get_menu_data['sub_id']]=$get_menu_data['label'];
                       $data['pageid'.$get_menu_data['sub_id']]=$get_menu_data['sub_id'];
                       $data['pagetitle'.$get_menu_data['sub_id']]=$get_menu_data['page_title'];
                       $data['pagetitleposition'.$get_menu_data['sub_id']]=$get_menu_data['title_position'];
                       $data['mainpagetitle'.$get_menu_data['sub_id']]=$get_menu_data['browsertab'];
                    } }
                    $data['user_aboutus_sort']=$this->modelsite->get_page_text($theme_user_id,'user_aboutus_sort');
                    $data['user_contectus_sort']=$this->modelsite->get_page_text($theme_user_id,'user_contectus_sort');                    
                    $data['user_TermCondition_sort']=$this->modelsite->get_page_text($theme_user_id,'user_TermCondition_sort');                    
                    $data['user_aboutus_full']=$this->modelsite->get_page_text($theme_user_id,'user_aboutus_full');
                    $data['user_contectus_full']=$this->modelsite->get_page_text($theme_user_id,'user_contectus_full');
                    $data['user_TermCondition_full']=$this->modelsite->get_page_text($theme_user_id,'user_TermCondition_full');
                    $data['user_footer']=$this->modelsite->get_page_text($theme_user_id,'user_footer');
                    
                     // start niraj
                    $data['profile_position']=$this->modelsite->get_profile_page_position($theme_user_id);
                    $data['footer_position']=$this->modelsite->get_footer_position($theme_user_id);
                    $data['about_position']=$this->modelsite->get_about_position($theme_user_id);
                     //end niraj
                    
                    $comment1=array('val'=>'so.`id`, so.`title`, so.url, so.image as image1, so.`status`,su.`id`, su.`user_id`, su.`social_id`, su.`link`, su.`image` as image2  ','table'=>'social_link_user as su','where'=>array("su.user_id"=>$theme_user_id),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'su.view','orderas'=>'asc');
                $multijoin1=array(array('table'=>'social_link as so','on'=>'su.social_id=so.id','join_type'=>''),
                );
                $data['products']=$this->editmodel->multijoin($comment1,$multijoin1);       

                    $data['menu']= $this->menu($theme_user_id,$username);
                    $data['session_user_id']=$theme_user_id;
                    $data['user_edit_panel']=FALSE;
                    $data['pagename']=$pagename;
                    $data['prod_view_id']=$prodid;
                  
                 /*$menuid=$this->modelsite->get_ectivemenuinarray($theme_user_id,$pagename);   
                  if(!$menuid)
                  {
                   $this->session->set_flashdata("warning","Oops !. Sorry to You Don't Have permission to access it and this page is hide fore some time ");
                   redirect('profile','refresh');   
                  }else{*/
                    
                    //echo "echo";exit;
                  $menupageid=$this->modelsite->get_ectivemenuid($theme_user_id,$pagename);
                  //print_r($menupageid);exit;
                  //print_R($data['get_menu']);exit;
                  if(empty($data['get_menu'])){$this->session->set_flashdata("alert","This seller site under construction yet."); redirect("/","refresh");exit; }
                  if(!$menupageid ){ ?>
                    <script> window.location.href='<?php echo BASE_URL.'products/details/'.$this->uri->segment(4)?>';</script>
                <?php  exit; }
                   //print_r($menupageid);exit;
                  $this->session->set_userdata('user_pageid',[$theme_user_id,$menupageid['sub_id']]);
                  $this->session->set_userdata('user_menu_dynamic_page_label',$menupageid['label']);
                  $this->session->set_userdata('user_menu_dynamic_page_title',$menupageid['page_title']);
                  $this->session->set_userdata('user_menu_dynamic_page_title_position',$menupageid['title_position']);
                  
                  //}
            if(is_numeric($pagename))
            {    $data['mainpagetitle']=$data["mainpagetitle$pagename"];
                $this->load->view('include/edit_panel/load_fileHead.php',$data);
                $this->load->view('include/edit_panel/header.php',$data);
                $this->load->view('custum_theme/1',$data);            
                $this->load->view('include/edit_panel/footer.php',$data);
                // $this->showeliment();
                
            }  
            else 
            {    
                
                $mypageneme=array("prod_detail","prod_cart","about_us","prod_view","term_condition","gallery","contact_us","user_profile","1");
                if(in_array($pagename,$mypageneme))
                {
                  
                   switch ($pagename):
                            case 'prod_detail':  
                                //if($prodid==''){
                                // $this->session->set_flashdata("warning","Please Select Some Product Id");
                                // echo '<script type="text/javascript">window.history.go(-1);</script>';
                                //}
                                //else{
                                        
                                        $data['prod_view_data']= $this->modelsite->get_product($theme_user_id,$prodid);                                        
                                        $data['prod_view_id']=$data['prod_view_data'][0]['id'];
                                        //print_r($data['prod_view_data']);exit;
                                       if($data['prod_view_data']!=""){
                                       seller::edit_prod_detail($data);
                                       }
                                       else{
                                           $this->session->set_flashdata("warning","Product Id Is Not Matched (Select Sorrect  Product Id ) ");
                                           echo '<script type="text/javascript">window.history.go(-1);</script>';
                                       }
                                //}
                                break;
                            case 'prod_cart':
                                seller::edit_prod_cart($data);
                                break;
                            case 'about_us':
                                seller::edit_about_us($data);
                                break;
                            case 'prod_view':                              
                                 seller::edit_prod_view($data,$theme_user_id);
                                break;
                            case 'term_condition':
                                seller::edit_term_condition($data);
                                break;
                            case 'gallery':
                                seller::edit_gallery($data,$theme_user_id);                                
                                break;
                            case 'contact_us':
                                seller::edit_contact_us($data);
                                break;
                            case 'user_profile':
                                seller::edit_user_profile($data);  
                                break;
                            case '1':
                                //seller::edit_1($data); 
                                break;

                            default :
                                //$this->session->set_flashdata("warning","Sorry!. this user site is Under construction");
                                // echo "This Name Of Shop Is Not Active Please Try Again".$username;
                                // redirect("_404","refresh");
                                break;
                    endswitch;        
                    
                } $this->showeliment();
            }
        }
        else
        {
		$this->session->set_flashdata("warning","currently this seller has no store.");
            //$this->session->set_flashdata("warning","Sorry!. this user site is not active");
           // echo "This Name Of Shop Is Not Active Please Try Again".$username;
            redirect("_404","refresh");
            /*
            redirect("auth/forgotpassword","refresh");*/
        }
        $this->load->view('include/edit_panel/storemasage.php');
    }
    public function edit_prod_detail($data)
    {
                //print_r($data); exit;
            $data['mainpagetitle']=$data['mainpagetitle1'];
            $this->load->view('include/edit_panel/load_fileHead.php',$data);
            $this->load->view('include/edit_panel/header.php',$data);
            $this->load->view('custum_theme/prod_detail',$data);            
            $this->load->view('include/edit_panel/footer.php',$data);
        
    }
    public function edit_prod_cart($data)
    {       
            $this->load->view('include/edit_panel/load_fileHead.php',$data);
            $this->load->view('include/edit_panel/header.php',$data);
            $this->load->view('custum_theme/prod_cart',$data);            
            $this->load->view('include/edit_panel/footer.php',$data);
    }
    public function edit_about_us($data)
    {       //echo "aa";exit;
            $data['mainpagetitle']=$data['mainpagetitle4'];
            $this->load->view('include/edit_panel/load_fileHead.php',$data);
            $this->load->view('include/edit_panel/header.php',$data);
            $this->load->view('custum_theme/about_us',$data);            
            $this->load->view('include/edit_panel/footer.php',$data);
    }
    public function edit_prod_view($data,$theme_user_id)
    {
        $table=Editpenalcontroller::get_product($theme_user_id);
        //print_r($table);exit;
        $config = array();
        $config["base_url"] = BASE_URL.$data['user_name']. "/Shope/prod_view";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 12;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['user_product']=(Editpenalcontroller::get_product($theme_user_id,$config["per_page"], $page));
        $data["productlinks"] = $this->pagination->create_links();
        //print_r($data["productlinks"]);exit;
        $data['mainpagetitle']=$data['mainpagetitle5'];
        $this->load->view('include/edit_panel/load_fileHead.php',$data);
        $this->load->view('include/edit_panel/header.php',$data);
        $this->load->view('custum_theme/prod_view',$data);            
        $this->load->view('include/edit_panel/footer.php',$data);
    }
    public function edit_term_condition($data)
            {
            $data['mainpagetitle']=$data['mainpagetitle6'];
            $this->load->view('include/edit_panel/load_fileHead.php',$data);
            $this->load->view('include/edit_panel/header.php',$data);
            $this->load->view('custum_theme/term_condition',$data);            
            $this->load->view('include/edit_panel/footer.php',$data);
            }
    public function edit_gallery($data,$theme_user_id)
    {   //echo $data['getuser_name'];exit;
        $config = array();
        $config["base_url"] = BASE_URL.$data['user_name']. "/Shope/gallery";
        $config["total_rows"] = $this->modelsite->count_val(array('table'=>'userProd_image','where'=>array('user_id'=>$theme_user_id,'status'=>'1')));
        $config["per_page"] = 12;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
    $data['user_all_image']=  $this->modelsite->get_user_active_image_shop($theme_user_id,$config["per_page"], $page);
    $data["gallerylinks"] = $this->pagination->create_links();
    $data['mainpagetitle']=$data['mainpagetitle9'];
    $this->load->view('include/edit_panel/load_fileHead.php',$data);
    $this->load->view('include/edit_panel/header.php',$data);
    $this->load->view('custum_theme/gallery',$data);            
    $this->load->view('include/edit_panel/footer.php',$data);
    }
    public function edit_contact_us($data)
            {
            $data['mainpagetitle']=$data['mainpagetitle11'];
            $this->load->view('include/edit_panel/load_fileHead.php',$data);
            $this->load->view('include/edit_panel/header.php',$data);
            $this->load->view('custum_theme/contact_us',$data);            
            $this->load->view('include/edit_panel/footer.php',$data);
            }
    public function edit_user_profile($data)
            {
            $data['mainpagetitle']=$data['mainpagetitle12'];
            $this->load->view('include/edit_panel/load_fileHead.php',$data);
            $this->load->view('include/edit_panel/header.php',$data);
            $this->load->view('custum_theme/user_profile',$data);            
            $this->load->view('include/edit_panel/footer.php',$data);
            }  
    public function edit_1($data)
            {
                    
            $this->load->view('include/edit_panel/load_fileHead.php',$data);
            $this->load->view('include/edit_panel/header.php',$data);
            $this->load->view('custum_theme/1',$data);            
            $this->load->view('include/edit_panel/footer.php',$data);
            }
    public function showeliment()
            {//this is get daynamic item show on site
           $this->load->view('../../edit_assets/popup/get_val/get_eliment.php');
        
            }
            public function menu($user_id,$user_name)
        {
            $query['q2']=$this->modelsite->sub_menu(0,0,$user_id);
            $aa = "<ul>";      
            if(!empty($query['q2'])){
            foreach ($query['q2'] as $data)
            {     
                $aa=$aa."<li id='".$data->id."'><a href='".BASE_URL.$user_name."/Shope/".$data->link."' > <span>".$data->label." </span></a>"; 
                //if($this->modelsite->sub_menu($data->sub_id,'1',$user_id)!=0)
                //{      
//                    $aa=$aa."<li id='".$data->sub_id."' class='has-sub'><a href='".BASE_URL.$user_name."/Shope/".$data->link."' > <span>".$data->label." </span></a>"; 
//                    $query['q3']=$this->modelsite->sub_menu($data->sub_id,'1',$user_id);
//                    $aa = $aa."<ul>";                    
//                    foreach ($query['q3'] as $r_data)
//                    {
                        /*if($this->modelsite->sub_menu($r_data->sub_id,'2',$user_id)!=0)
                        { 
                            $aa=$aa."<li id='".$r_data->sub_id."' class='has-sub'><a href='".BASE_URL.$user_name."/".$r_data->link."' > <span>".$r_data->label." </span> </a>";
                            $query['q4']=$this->modelsite->sub_menu($r_data->sub_id,'2',$user_id);
                            $aa = $aa."<ul>"; 
                            foreach ($query['q4'] as $rr_data)
                            {
                                $aa=$aa."<li id='".$rr_data->sub_id."'><a href='".BASE_URL.$user_name."/".$rr_data->link."' > <span>".$rr_data->label." </span> </a></li>";
                            }
                            $aa = $aa."</ul>";
                        }
                        else 
                        {*/
//                             $aa=$aa."<li id='".$r_data->sub_id."'><a href='".BASE_URL.$user_name."/Shope/".$r_data->link."' > <span>".$r_data->label." </span> </a>";
//                        //}
//                    
//                     $aa=$aa."</li>";
//                    }
//                    $aa = $aa."</ul>";
                //}
                //else
                //{
                //    $aa=$aa."<li id='".$data->id."'><a href='".BASE_URL.$user_name."/Shope/".$data->link."' > <span>".$data->label." </span></a>"; 
                //}
                $aa=$aa."</li>";
            }}else{
               $aa =$aa. "<li><a href='#' > <span>This seller site under construction yet.</span></a></li></ul>"; 
            } 
            $aa =$aa. "</ul>"; 
          return $aa;            
        }
}
