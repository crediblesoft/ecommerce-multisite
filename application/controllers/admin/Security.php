<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends MY_Controller {
    private $userid;
    function __construct()
    {
        parent::__construct();
        $this->_valid_admin();
        $this->_screen_security_admin(' ');
        $this->userid=$this->session->userdata(ADMIN_SESS.'user_id');
    }
    
    public function index(){
   
    }
 
    public function security_roles(){
        $comment1=array('val'=>'role_name,role_description,status,id','table'=>'security_roles','where'=>array(),'minvalue'=>'','group_by'=>'id','start'=>'','orderby'=>'id','orderas'=>'ASC');
        $multijoin1=array();

        $table=$this->common->multijoin($comment1,$multijoin1);

        $config = array();
        $config["base_url"] = BASE_URL. "admin/security/";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 50;
        $config["uri_segment"] = 3;
        //$config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['security_roles']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/security/admin_vw_security_roles',$resp);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function active_role(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"security_roles","val"=>array("status"=>'Active'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();exit;
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Security Role(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive_role(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"security_roles","val"=>array("status"=>'Inactive'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Security Role(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
   
    public function removehassecurityroleid($selectedid){
        $flag=0;
        for($i=0;$i<count($selectedid);$i++){
            $data=array("table"=>'security_roles',"where"=>array("category"=>$selectedid[$i]));
            $getcount=$this->common->count_val($data); 
            if($getcount > 0){ 
                $flag=1;//if (($key = array_search($selectedid[$i], $selectedid)) !== false) unset($selectedid[$key]);
            }
        }
        return $flag;
    }
    
    public function add_role(){
        $this->form_validation->set_rules('name','Security Role','trim|required');
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $description=$this->input->post("description");
            $status=$this->input->post("status");
            $data=array('table'=>'security_roles','val'=>array('role_name'=>$name,'role_description'=>$description,'status'=>$status));                
            $log=$this->common->add_data($data);

        $get_role_id="SELECT r.id as role_id from security_roles r where r.role_name='".$name."'";

        $resp['role']=$this->common->dbQuery($get_role_id);

        if($resp['role']['res']){
          $role_id=$resp['role']['rows'][0]->role_id;
        }

        $query1=array('val'=>'id','table'=>'valid_screens','where'=>array('status'=>'Active'),'minvalue'=>'','group_by'=>'id','start'=>'','orderby'=>'id','orderas'=>'ASC');
        $multijoin1=array();

        $valid_screens=$this->common->multijoin($query1,$multijoin1);

            foreach($valid_screens['rows'] as $valid_screen){
            $data=array('table'=>'screen_security','val'=>array('screen_id'=>$valid_screen->id,'role_id'=>$role_id,'status'=>'In-Active'));
            $stat=$this->common->add_data($data);
            }

            if($log){
                $this->session->set_flashdata("sucess","Security Role has been added successfully.");
                redirect("admin/security/add_role/","refresh");
            }
        }else{
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/security/admin_vw_addsecurity_roles');
        $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function edit_role($id){ 
        $data=array('val'=>array(),'table'=>'security_roles','where'=>array('id'=>$id));
        $log['security_roles']=$this->common->getdata($data);
        if(!$log['security_roles']['res']){
            $this->session->set_flashdata("warning","This Security Role Name not in Security Role list.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
       $this->load->view('admin/security/admin_vw_editsecurity_roles',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function update_role(){ 
        $this->form_validation->set_rules('name','Security Role Name','trim|required');
        $id=$this->input->post("id");
        if($this->form_validation->run()){ 
            $name=$this->input->post("name");
            $description=$this->input->post("description");
            $status=$this->input->post("status");
            $data=array('table'=>'security_roles','val'=>array('role_name'=>$name,'role_description'=>$description,'status'=>$status),"where"=>array("id"=>$id));                
            $log=$this->common->update_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Security Role has been updated successfully.");
                redirect("admin/security/security_roles","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'security_roles','where'=>array('id'=>$id));
            $log['security_roles']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/security/admin_vw_editsecurity_roles',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }
    
    public function security_valid_screens(){
        $comment1=array('val'=>'screen_name,screen_description,status,id','table'=>'valid_screens','where'=>array(),'minvalue'=>'','group_by'=>'id','start'=>'','orderby'=>'id','orderas'=>'ASC');
        $multijoin1=array();

        $table=$this->common->multijoin($comment1,$multijoin1);

        $config = array();
        $config["base_url"] = BASE_URL. "admin/security/";
        $config["total_rows"] = ($table['res'])?count($table['rows']):0;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        //$config['page_query_string']=true;
        $this->pagination->initialize($config); 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        //$log["data"]=$this->common->get_all_with_paginaiton($config["per_page"], $page ,$table);
        $resp['valid_screens']=$this->common->multijoin($comment1,$multijoin1,$config["per_page"], $page);
        $resp["links"] = $this->pagination->create_links();
        $resp['datashowcount'] = array('total' => $config["total_rows"], 'per_page' => $config["per_page"]);
        //print_r($resp['products']['rows']);exit;
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/security/admin_vw_valid_screens',$resp);
        $this->load->view('admin/include/admin_footer');
    }

    public function add_valid_screen(){
       $this->form_validation->set_rules('name','Valid Screen','trim|required');
        if($this->form_validation->run()){
            $name=$this->input->post("name");
            $description=$this->input->post("description");
            $status=$this->input->post("status");
            $data=array('table'=>'valid_screens','val'=>array('screen_name'=>$name,'screen_description'=>$description,'status'=>$status));                
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Screen has been added successfully.");
                redirect("admin/security/add_valid_screen/","refresh");
            }
        }else{
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/security/admin_vw_addvalid_screens');
        $this->load->view('admin/include/admin_footer');
        }
    }

    public function edit_valid_screen($id){ 
        $data=array('val'=>array(),'table'=>'valid_screens','where'=>array('id'=>$id));
        $log['valid_screens']=$this->common->getdata($data);
        if(!$log['valid_screens']['res']){
            $this->session->set_flashdata("warning","This Valid Screen Name not in Valid Screen list.");
            redirect("_404","refresh");
        }
        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/security/admin_vw_editvalid_screens',$log);
        $this->load->view('admin/include/admin_footer');
    }
    
    public function update_valid_screen(){ 
        $this->form_validation->set_rules('name','Valid Screen Name','trim|required');
        $id=$this->input->post("id");
        if($this->form_validation->run()){ 
            $name=$this->input->post("name");
            $description=$this->input->post("description");
            $status=$this->input->post("status");
            $data=array('table'=>'valid_screens','val'=>array('screen_name'=>$name,'screen_description'=>$description,'status'=>$status),"where"=>array("id"=>$id));                
            $log=$this->common->update_data($data);
            if($log){
                $this->session->set_flashdata("sucess","Valid Screen has been updated successfully.");
                redirect("admin/security/security_valid_screens","refresh");
            }
        }else{
            $data=array('val'=>array(),'table'=>'valid_screens','where'=>array('id'=>$id));
            $log['valid_screens']=$this->common->getdata($data);
            $this->load->view('admin/include/admin_header');
            $this->load->view('admin/include/admin_left');
            $this->load->view('admin/security/admin_vw_editvalid_screens',$log);
            $this->load->view('admin/include/admin_footer');
        }
    }

    public function active_valid_screen(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"valid_screens","val"=>array("status"=>'Active'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();exit;
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Screen(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive_valid_screen(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"valid_screens","val"=>array("status"=>'Inactive'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Screen(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

    public function assign_screen_security(){
        $data['roles']=array('val'=>array('id','role_name'),'table'=>'security_roles','where'=>array('status'=>'Active'));
        $resp['roles']=$this->common->getdata($data['roles']);

        if ($resp['roles']['res']) {
        $comment1="SELECT s.id as security_id,v.screen_name,v.screen_description,r.role_name,r.id as role_id,v.id as val_id,s.status as security_status,s.modifiable,s.enable from valid_screens v,security_roles r,screen_security s where s.role_id=r.id and s.screen_id=v.id and s.role_id=".$resp['roles']['rows'][0]->id;


        $resp['screens']=$this->common->dbQuery($comment1);
        } else {
            $this->session->set_flashdata("warning","You have to have atleast one Active Security Role in Order to Assign Screens");
            redirect("admin/security/security_roles/","refresh");
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/security/admin_vw_assign_screen',$resp);
        $this->load->view('admin/include/admin_footer');
    }

    public function addassign_screen_security($role_id=0,$screen_id=0){

        $this->form_validation->set_rules('Type','Type Name','trim|required');
        if($this->form_validation->run()){
            $role_id=$this->input->post("role_id");
            $Type=$this->input->post("Type");
            $status=$this->input->post("status");
            $data=array('table'=>'screen_security','val'=>array('screen_id'=>$Type,'role_id'=>$role_id,'status'=>$status));
            $log=$this->common->add_data($data);

            if($log){
                $this->session->set_flashdata("sucess","Screen has been added successfully.");
                redirect("admin/security/assign_screen_security/","refresh");
            }
        }else{

        $comment1="SELECT v.screen_name,v.screen_description,v.id as val_id,v.status,'".$role_id."' as role_id from valid_screens v where v.status='Active' and v.id NOT IN ( SELECT s.screen_id FROM screen_security s WHERE s.role_id=".$role_id.")";


        $resp['valid_screens']=$this->common->dbQuery($comment1);

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/security/admin_vw_addassign_screen',$resp);
        $this->load->view('admin/include/admin_footer');
             }
    }

    public function active_role_screen(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"screen_security","val"=>array("status"=>'Active'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        //echo $this->db->last_query();exit;
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Role Screen(s) added to active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
    
    
    public function inactive_role_screen(){
        $selectedid=$this->input->post("selectedmail");
        $count=count($selectedid);
        $data=array("table"=>"screen_security","val"=>array("status"=>'Inactive'),"where"=>array(),"in"=>"id","in_value"=>$selectedid);
        $log=$this->common->update_in_data($data);
        if($log){
            echo json_encode(array("status"=>true,"message"=>"$count Role Screen(s) removed from active list."));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

public function getrolelist($roleidval=0){
        $data['roles']=array('val'=>array('id','role_name'),'table'=>'security_roles','where'=>array('status'=>'Active'));
        $resp['roles']=$this->common->getdata($data['roles']);

        $comment1="SELECT s.id as security_id,v.screen_name,v.screen_description,r.role_name,r.id as role_id,v.id as val_id,s.status as security_status,s.modifiable,s.enable from valid_screens v,security_roles r,screen_security s where s.role_id=r.id and s.screen_id=v.id and s.role_id=".$roleidval;


        $resp['screens']=$this->common->dbQuery($comment1);

        if(!$resp['screens']['res']){
          $resp['screens']['rows'][0]->role_id=$roleidval;
        }

        $this->load->view('admin/include/admin_header');
        $this->load->view('admin/include/admin_left');
        $this->load->view('admin/security/admin_vw_assign_screen',$resp);
        $this->load->view('admin/include/admin_footer');
}

    public function update_modifiable(){
        $security_id=$this->input->post("security_id");
        $mod_value=$this->input->post("mod_value");

        $mod='0';
        if ($mod_value=='true') {
             $mod='1';
        }

        $data=array('table'=>'screen_security','val'=>array('modifiable'=>$mod),"where"=>array("id"=>$security_id));                
        $log=$this->common->update_data($data);

        if($log){
            echo json_encode(array("status"=>true,"message"=>"Security Role(s) Updated"));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }

    public function update_enable(){
        $security_id=$this->input->post("security_id");
        $mod_value=$this->input->post("mod_value");

        $mod='0';
        if ($mod_value=='true') {
             $mod='1';
        }

        $data=array('table'=>'screen_security','val'=>array('enable'=>$mod),"where"=>array("id"=>$security_id));                
        $log=$this->common->update_data($data);

        if($log){
            echo json_encode(array("status"=>true,"message"=>"Security Role(s) Updated"));
        }else{
           echo json_encode(array("status"=>false,"message"=>"Error!"));
        }
    }
} 
