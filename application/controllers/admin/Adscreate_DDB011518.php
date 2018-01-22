<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adscreate extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    
    public function index(){
       $comment1=array('val'=>'*','table'=>'ads_subscription_period as asp','where'=>array(),'minvalue'=>'','group_by'=>'id','start'=>'','orderby'=>'id','orderas'=>'DESC');
        $multijoin1=array(
            //array('table'=>'product as p','on'=>'p.category=cat.id','join_type'=>'left'),
        );
        
        $table=$this->common->multijoin($comment1,$multijoin1);
        $config = array();
        $config["base_url"] = BASE_URL. "admin/ads_subs/";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        //$config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['ads']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/ads_subs/admin_vw_ads',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    public function add()
    {        
        $this->form_validation->set_rules('name','Ads Name','trim|required');
        $this->form_validation->set_rules('days','Number of Days','trim|required');
        $this->form_validation->set_rules('price','Price of Ads','trim|required');
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $price=$this->input->post("price");
            $days=$this->input->post("days");
            $data=array('table'=>'ads_subscription_period','val'=>array('title'=>$name,'noofdays'=>$days,'price'=>$price));                
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Ads has been added successfully.");
                redirect("admin/adscreate","refresh");
            }
        }else{
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/ads_subs/admin_vw_addAds');
        $this->load->view('admin/include/admin_footer');
    }
    }
    
     public function update($id){ 
         //echo $id; exit;
        $this->form_validation->set_rules('name','Ads Name','trim|required');
        $this->form_validation->set_rules('price','Ads Price','trim|required');
        $this->form_validation->set_rules('days','Number of Days','trim|required');

        //$id=$this->input->post("id");
        if($this->form_validation->run()){ 
            //$id=$this->input->post("id");
            $name=$this->input->post("name");
            $price=$this->input->post("price");
            $days=$this->input->post("days");
            $data=array('table'=>'ads_subscription_period','val'=>array('title'=>$name,'noofdays'=>$days,'price'=>$price),"where"=>array("id"=>$id));                
            $log=$this->common->update_data($data);
            
            if($log){
                $this->session->set_flashdata("sucess","Ads has been updated successfully.");
                redirect("admin/adscreate","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'ads_subscription_period','where'=>array('id'=>$id));
            $log['category']=$this->common->getdata($data);
            //print_r($log['category']);exit;
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/ads_subs/admin_vw_adsUpdate',$log);
            $this->load->view('admin/include/admin_footer');
        }
     }

    }   