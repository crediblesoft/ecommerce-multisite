<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inserdata extends CI_Controller {
         private $userid;

	public function __construct() {
            parent::__construct();
            $this->load->helper('array');
             $this->load->helper('array');
            $this->load->helper('url');    
            $this->load->database();            
            $this->load->model('modelsite');
            $this->userid=$this->session->userdata('user_id');
             //$CI      =& get_instance();
             //$CI->config->set_item( 'global_xss_filtering', FALSE );
        }

        public function update_prod()
	{
            //$this->db->query('INSERT INTO `db_css`( `user_id`,  `class_name`, `class_css`) VALUES ("1111","'.$this->input->post('className').'","'.$this->input->post('Css').'")');
            $this->db->query('UPDATE  `db_css` SET  `class_css`="'.$this->input->post('Css').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `class_name`="'.$this->input->post('className').'"');
            print_r('UPDATE  `db_css` SET  `class_css`="'.$this->input->post('Css').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `class_name`="'.$this->input->post('className').'"');
            //exit()            
        }
        public function update_boot()
	{
            
            $this->db->query('UPDATE `db_bootstrap` SET `bootstrap_num`="'.$this->input->post('bt_num').'"   WHERE `user_id`="'.$this->input->post('userId').'" AND `class`="'.$this->input->post('className').'" AND `bootstrap_name`="'.$this->input->post('bt_name').'"');
            print_r('UPDATE `db_bootstrap` SET `bootstrap_num`="'.$this->input->post('bt_num').'"   WHERE `user_id`="'.$this->input->post('userId').'" AND `class`="'.$this->input->post('className').'" AND `bootstrap_name`="'.$this->input->post('bt_name').'"');
            exit()  ;          
        }

        //this is only for menu section 
        
         public function update_add_menu()
        {
             $this->db->query('UPDATE `menu` SET `label`="'.$this->input->post('data').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `id`="'.$this->input->post('id').'"');
            print_r('UPDATE `menu` SET `label`="'.$this->input->post('data').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `id`="'.$this->input->post('id').'"');
        }
        
        public function update_menu()
        {
             $this->db->query('UPDATE `menu` SET `stetus`="0",`view`="'.$this->input->post('view').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `id`="'.$this->input->post('id').'"');
            print_r('UPDATE `menu` SET `view`="'.$this->input->post('view').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `id`="'.$this->input->post('id').'"');
        }
        public function remove_new_menu()
        {
           
           $this->db->query('UPDATE `menu` SET `stetus`="1",`view`="'.$this->input->post('view').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `id`="'.$this->input->post('id').'"');
            print_r('UPDATE `menu` SET `stetus`="1",`view`="'.$this->input->post('view').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `id`="'.$this->input->post('id').'"'); 
        }

        public function update_ald_menu()
        {
            $this->db->query('UPDATE `menu` SET `label`="'.$this->input->post('data').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `id`="'.$this->input->post('id').'"');
            //SELECT count(id) FROM `menu` WHERE `stetus`='0' AND `user_id`='111' AND `parent`='0' //, ,`label`="'.$this->input->post('data').'",
            print_r('UPDATE `menu` SET `stetus`=0,`view`="'.$this->input->post('view').'"  WHERE `user_id`="'.$this->input->post('userId').'" AND `id`="'.$this->input->post('id').'"');
        }
        // this is only for gallry section
        public function uboutus_image()
        {
             $this->db->query('UPDATE `userProd_image` SET  `about_us_pic`="1" WHERE  `status`="1" AND `id`="'.$this->input->post('id').'"');//`user_id`="'.$this->input->post('userId').'"
             $this->db->query('UPDATE `userProd_image` SET  `about_us_pic`="0" WHERE `status`="1" AND `id`!="'.$this->input->post('id').'"');
            print_r('UPDATE `userProd_image` SET `about_us_pic`="1" WHERE  `id`="'.$this->input->post('id').'"');
        }
        public function userlogo_image()
        {
             $this->db->query('UPDATE `userProd_image` SET  `usersitelogo`="1" WHERE  `status`="1" AND `id`="'.$this->input->post('id').'"');
             $this->db->query('UPDATE `userProd_image` SET  `usersitelogo`="0" WHERE `status`="1" AND `id`!="'.$this->input->post('id').'"');
            print_r('UPDATE `userProd_image` SET `usersitelogo`="1" WHERE  `id`="'.$this->input->post('id').'"');
        }
       public function contectus_image()
        {
             $this->db->query('UPDATE `userProd_image` SET  `contact_us_pic`="1" WHERE  `status`="1" AND `id`="'.$this->input->post('id').'"');//`user_id`="'.$this->input->post('userId').'"
             $this->db->query('UPDATE `userProd_image` SET  `contact_us_pic`="0" WHERE `status`="1" AND `id`!="'.$this->input->post('id').'"');
            print_r('UPDATE `userProd_image` SET `about_us_pic`="1" WHERE  `id`="'.$this->input->post('id').'"');
        }
        
        //remove_new_userimage
        public function update_text_data()
        {
           
           $this->db->query(" UPDATE `db_text` SET `text_data`='".addslashes($this->input->post("data",FALSE))."' WHERE  `id`='".$this->input->post("id")."'  ");//AND `class_name`='".$this->input->post('codition')."'
            print_r(" UPDATE `db_text` SET `text_data`='".addslashes($this->input->post("data",FALSE))."' WHERE  `id`='".$this->input->post("id")."'  "); //AND `class_name`='".$this->input->post('codition')."'
        }
        public function update_socialmedia()
        {
            $this->db->query(" UPDATE `social_link_user` SET `view`='".$this->input->post('view')."' WHERE `id`='".$this->input->post('id')."'  ");
            print_r(" UPDATE `social_link_user` SET `view`='".$this->input->post('view')."' WHERE `id`='".$this->input->post('id')."'   "); 
        }
        public function gallery_view()
        {
           
           $this->db->query('UPDATE `userProd_image` SET  `gallery_view`="'.$this->input->post('view').'" WHERE `id`="'.$this->input->post('id').'"');
            print_r('UPDATE `userProd_image` SET  `gallery_view`="'.$this->input->post('view').'" WHERE `id`="'.$this->input->post('id').'"'); 
        }
        function create_new_menu()
        {
            $this->db->query("INSERT INTO `menu`( `user_id`, `file_path`, `label`, `link`, `parent`, `sort`, `view`, `stetus`, `user_created`,`sub_id`,`page_title`) VALUES ('".$this->input->post('userId')."','custum_theme/1.php','".$this->input->post('data')."','".$this->input->post('id')."','0','0','".$this->input->post('id')."','0','1','".$this->input->post('id')."','".$this->input->post('data')."')");
            // niraj for title
            //$this->db->query("INSERT INTO `db_page_title`( `userid`, `pageid`, `text`) VALUES ('".$this->input->post('userId')."','".$this->input->post('id')."','".$this->input->post('data')."')");
           
            print_r("INSERT INTO `menu`( `user_id`, `file_path`, `label`, `link`, `parent`, `sort`, `view`, `stetus`, `user_created`,`sub_id`) VALUES ('".$this->input->post('userId')."','custum_theme/1.php','".$this->input->post('data')."','".$this->input->post('id')."','0','0','".$this->input->post('id')."','0','1','".$this->input->post('id')."')");
        }
        //
         function delete_menu()
        {
            $this->db->query(" DELETE FROM `menu` WHERE `id`='".$this->input->post('id')."' ");
            // niraj for title
            //$this->db->query(" DELETE FROM `db_page_title` WHERE `pageid`='".$this->input->post('id')."' AND `userid`='".$this->session->userdata("user_id")."'");
            print_r(" DELETE FROM `menu` WHERE `id`='".$this->input->post('id')."' ");
        }
        
        function delete_gallery_getinfo()
        {
            $data=array('val'=>'*','table'=>'userProd_image','where'=>array('id'=>$this->input->post('id'),'user_id'=>$this->userid));
            $result=$this->modelsite->getdataforgalleryimage($data); 
            
            if($result['res'])
            {
                print_r($result['massege']);
            }
            else
            {
                return FALSE;
            }
            //print_r($result);exit;
            
            //"SELECT * FROM `userProd_image` WHERE `id`='' and `user_id`=''";
            //echo "DELETE FROM `userProd_image` WHERE `id`='".$this->input->post('id')."' and `user_id`='".$this->userid."' and `banner_img`='0' and `status`='1' and `about_us_pic`='0' and `contact_us_pic`='0'";
            
           // return 'done';
            //$this->db->query(" DELETE FROM `menu` WHERE `id`='".$this->input->post('id')."' ");
            //print_r(" DELETE FROM `menu` WHERE `id`='".$this->input->post('id')."' ");
        }
        function delete_gallery()
        {
            $galdata=array("table"=>"userProd_image","where"=>array("id"=>$this->input->post('id')),"val"=> array("image_path"));
            $gallery=$this->common->getsinglerow($galdata);
            // print_r($gallery);exit;
            if($gallery['res']){
                $path="assets/image/gallery/".$this->userid."/".$gallery['rows']->image_path;
                if(file_exists($path)){
                unlink($path);}
                $path="assets/image/gallery/".$this->userid."/thumb/".$gallery['rows']->image_path;
               if(file_exists($path)){
                unlink($path);}
            }

            $data=array('table'=>'userProd_image','where'=>array('id'=>$this->input->post('id')));            
            $log=$this->common->delete_data($data);
            return $log;
//            if($log){
//            echo json_encode(array('status'=>true,'message'=>'Data Deleted Successfully.'));
//            }
                
        }
        
        public function update_gallery()
        {
           
           $this->db->query('UPDATE `userProd_image` SET  `gallery_view`="'.$this->input->post('view').'", `banner_img`="1" WHERE `id`="'.$this->input->post('id').'"');
            print_r('UPDATE `userProd_image` SET  `gallery_view`="'.$this->input->post('view').'", `banner_img`="1" WHERE `id`="'.$this->input->post('id').'"'); 
        }
        public function remove_new_gallery()
        {
           
           $this->db->query('UPDATE `userProd_image` SET  `gallery_view`="'.$this->input->post('view').'" , `banner_img`="0" WHERE `id`="'.$this->input->post('id').'"');
            print_r('UPDATE `userProd_image` SET  `gallery_view`="'.$this->input->post('view').'", `banner_img`="0" WHERE `id`="'.$this->input->post('id').'"'); 
        }
        public function save_update_element()
        {
           $res=$this->db->query("SELECT  `theme_id`, `element_data` FROM `db_element` WHERE `user_id`='".$this->input->post('user_id')."' AND `page_no`='".$this->input->post('pageid')."' ");
            if($res->num_rows()>0)
           {
             $this->db->query("UPDATE `db_element` SET `element_data`='".$this->input->post('pagedata',FALSE)."' WHERE `user_id`='".$this->input->post('user_id')."' AND `page_no`='".$this->input->post('pageid')."' ");  
             print_r("UPDATE `db_element` SET `element_data`='".$this->input->post('pagedata',FALSE)."' WHERE `user_id`='".$this->input->post('user_id')."' AND `page_no`='".$this->input->post('pageid')."' ");
           }
            else 
            {
                $this->db->query("INSERT INTO `db_element` SET `user_id`='".$this->input->post('user_id')."' , `page_no`='".$this->input->post('pageid')."',  `element_data`='".$this->input->post('pagedata',FALSE)."' "); 
                print_r("INSERT INTO `db_element` SET `user_id`='".$this->input->post('user_id')."' , `page_no`='".$this->input->post('pageid')."',  `element_data`='".$this->input->post('pagedata',FALSE)."' ");
            }
            print_r("SELECT `element_data` FROM `db_element` WHERE `user_id`='".$this->input->post('user_id')."' AND `page_no`='".$this->input->post('pageid')."' ".'userid'.$this->input->post('user_id').'pageid'.$this->input->post('pageid').'data'.$this->input->post('pagedata'));
        }
        //neraaj
        public function save_product_view()
        {
            $res=$this->db->query("SELECT  `id`, `user_id`, `prod_id`, `prod_view_id` FROM `product_view` WHERE `user_id`='".$this->input->post('user_id')."' AND `prod_id`='".$this->input->post('poductid')."' ");
            if($res->num_rows()>0)
           {
             $this->db->query("UPDATE `product_view` SET `prod_view_id`='".$this->input->post('view')."' WHERE `user_id`='".$this->input->post('user_id')."' AND `prod_id`='".$this->input->post('poductid')."' ");  
             print_r("UPDATE `product_view` SET `prod_view_id`='".$this->input->post('view')."' WHERE `user_id`='".$this->input->post('user_id')."' AND `prod_id`='".$this->input->post('poductid'));
           }
            else 
            {
                $this->db->query("INSERT INTO `product_view` SET `user_id`='".$this->input->post('user_id')."' , `prod_id`='".$this->input->post('poductid')."', `prod_view_id`='".$this->input->post('view')."' "); 
                print_r("INSERT INTO `product_view` SET `user_id`='".$this->input->post('user_id')."' , `prod_id`='".$this->input->post('poductid')."', `prod_view_id`='".$this->input->post('view')."' ");
            }
        }
        public function save_profile_view()
        {
            $position=$this->input->post("position");
            $div_id=$this->input->post("div_id");
            $page=$this->input->post("page");
            
            $res=$this->db->query("SELECT  `id` FROM `view_position` WHERE `user_id`='".$this->userid."' AND `page`='".$page."' AND `div_id`='".$div_id."'");
            if($res->num_rows()>0)
            {
              $res=$this->db->query("UPDATE `view_position` SET `position`='".$position."' WHERE `user_id`='".$this->userid."' AND `page`='".$page."' AND `div_id`='".$div_id."'");  
              if($res){
                  echo "Position Updated";
              }
            }
            else 
            {
                $res=$this->db->query("INSERT INTO `view_position` SET `user_id`='".$this->userid."' , `page`='".$page."', `div_id`='".$div_id."',`position`='".$position."'"); 
                if($res){
                  echo "Position Inserted";
              }
            }
        }
        public function save_gallery_view()
        {
            $position=$this->input->post("position");
            $div_id=$this->input->post("div_id");
            for($i=0;$i< count($position);$i++){ $data[]=array('id'=>$div_id[$i],'gallery_view'=>$position[$i]);}
            $this->db->where('user_id',$this->userid);
            $this->db->update_batch('userProd_image', $data, 'id');
            //echo $this->db->last_query();
            echo $this->db->affected_rows().'row(s) update successfully';
//              $res=$this->db->query("UPDATE `userProd_image` SET `gallery_view`='".$position."' WHERE `user_id`='".$this->userid."' AND `id`='".$div_id."'");  
//              if($res){
//                  echo "Position Updated";
//              }
        }
        
        public function save_about_view()
        {
            $position=$this->input->post("position");
            $div_id=$this->input->post("div_id");
            $page=$this->input->post("page");
            
            $res=$this->db->query("SELECT  `id` FROM `view_position` WHERE `user_id`='".$this->userid."' AND `page`='".$page."' AND `div_id`='".$div_id."'");
            if($res->num_rows()>0)
            {
              $res=$this->db->query("UPDATE `view_position` SET `position`='".$position."' WHERE `user_id`='".$this->userid."' AND `page`='".$page."' AND `div_id`='".$div_id."'");  
              if($res){
                  echo "Position Updated";
              }
            }
            else 
            {
                $res=$this->db->query("INSERT INTO `view_position` SET `user_id`='".$this->userid."' , `page`='".$page."', `div_id`='".$div_id."',`position`='".$position."'"); 
                if($res){
                  echo "Position Inserted";
              }
            }
        }
        
        public function update_page_title()
        {
           $this->db->query(" UPDATE `menu` SET `browsertab`='".$this->input->post("browsertab",FALSE)."', `page_title`='".addslashes($this->input->post("data",FALSE))."' WHERE  `id`='".$this->input->post("id")."'  ");//AND `class_name`='".$this->input->post('codition')."'
            print_r(" UPDATE `menu` SET `browsertab`='".$this->input->post("browsertab",FALSE)."', `page_title`='".addslashes($this->input->post("data",FALSE))."' WHERE  `id`='".$this->input->post("id")."'  "); //AND `class_name`='".$this->input->post('codition')."'
        }
        
        
        public function getdynamicpagetitle(){
            $pagesubid=$this->input->post("id");
            $res=$this->db->query("SELECT  `page_title`,`title_position`,`browsertab`  FROM `menu` WHERE `user_id`='".$this->userid."' AND `sub_id`='".$pagesubid."' AND `parent`='0'");
            $result=$res->result();
            echo json_encode($result);
        }
        
        public function update_page_title_position(){
            $this->db->query(" UPDATE `menu` SET `title_position`='".$this->input->post("data")."' WHERE  `sub_id`='".$this->input->post("pageid")."' AND user_id='".$this->userid."' AND parent='0'");
            print_r(" UPDATE `menu` SET `title_position`='".$this->input->post("data")."' WHERE  `sub_id`='".$this->input->post("pageid")."' AND user_id='".$this->userid."' AND parent='0'");
        }
        
        
}