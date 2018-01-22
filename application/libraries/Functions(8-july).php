<?php
class Functions {
    
    public function __construct()
    {
		ini_set('memory_limit', '512M');
            $this->ci =& get_instance();

            $this->ci->load->library('session');
            $this->ci->load->library('email');
            // start done by avinash
            $this->ci->load->helper('cookie');
            // end done by avinash
            
            $this->ci->load->library('image_lib');
            
		$this->ci->load->helper('directory');
            $this->ci->load->helper('file');
            // Load facebook library and pass associative array which contains appId and secret key
           // $this->ci->load->library('facebook', array('appId' => '643798449090913', 'secret' => '7bffbabad439818c50d05b815a247d65'));
            // Get user's login information
            //$this->user = $this->ci->facebook->getUser();
            
            //$this->ci->load->library('Googleplus');
            //$this->ci->load->library('Oauth2');
            
            //$this->ci->load->file(SITE_URL.'application/libraries/Google/Client', true);
            
            //require_once 'src/apiClient.php';
            //require_once 'src/contrib/apiPlusService.php';
    }
        
    function _curl_request($url)
    {
                    $channel = curl_init();
                    curl_setopt( $channel, CURLOPT_URL, $url );
                    curl_setopt( $channel, CURLOPT_RETURNTRANSFER, 1 );
                    $re= curl_exec ( $channel );
                    curl_close ( $channel );
                    return $re;
    }
     function _multi_upload_files($userfile,$image_path,$allowed,$max_size)
    {
        $this->ci->load->library('upload');

    $files = $_FILES;
    $cpt = count($_FILES[$userfile]['name']);
    for($i=0; $i<$cpt; $i++)
    {
       if($files[$userfile]['tmp_name'][$i]!='')
       {
        
            $_FILES[$userfile]['name']= $files[$userfile]['name'][$i];
            $_FILES[$userfile]['type']= $files[$userfile]['type'][$i];
            $_FILES[$userfile]['tmp_name']= $files[$userfile]['tmp_name'][$i];
            $_FILES[$userfile]['error']= $files[$userfile]['error'][$i];
            $_FILES[$userfile]['size']= $files[$userfile]['size'][$i];    

            $config['upload_path'] = $image_path;
            $config['allowed_types'] = $allowed;
            $config['max_size'] = $max_size;
            $img=$_FILES[$userfile]['name'][$i];
            //$random_digit=rand(00,99999);
            $random_digit=time();
            //$ext = strtolower(substr($img, strpos($img,'.'), strlen($img)-1));
            $info = new SplFileInfo($img);
            $ext=$info->getExtension();
            //var_dump($info->getExtension());
            $file_name=$random_digit.$ext;
            $config['file_name'] = $file_name;

            $this->ci->upload->initialize($config);
            $this->ci->upload->do_upload($userfile);
            $newfile[]=$this->ci->upload->file_name;
       }
         
    }
    return $newfile;
    }
    function _upload_image($userfile,$image_path,$allowed,$max_size)
    {
        //die($allowed);
	 if($_FILES[$userfile]['name']!='')
	 {
	  if(!is_dir($image_path))
            {
		mkdir($image_path);
            }
	    $config['upload_path'] = $image_path;
            $config['allowed_types'] = $allowed;
            $config['max_size'] = $max_size;
	    $img=$_FILES[$userfile]['name'];
            $random_digit=time();
            //$ext = strtolower(substr($img, strpos($img,'.'), strlen($img)-1));
            $info = new SplFileInfo($img);
            $ext=$info->getExtension();
            $file_name=$random_digit.$ext;
            $config['file_name'] = $file_name;
            
            $this->ci->load->library('upload', $config);
	
	     if($this->ci->upload->do_upload($userfile))
            {
                return array('status'=>TRUE,'filename'=>$this->ci->upload->file_name);
            }
            else {return array('status'=>FALSE,'error'=>$this->ci->upload->display_errors('<span>','</span>'));}
	 }
    }
    
    function _upload_image_thumb($userfile,$image_path,$allowed,$max_size,$thumb=false,$thumbval=array())
    {
       // echo $userfile; die;
        if(isset($_FILES[$userfile]['name']) && $_FILES[$userfile]['name']!='')
        {
            $this->ci->load->library('upload');
            if(!is_dir($image_path))
            {
                mkdir($image_path);
            }
            $config['upload_path'] = $image_path;
            $config['allowed_types'] = $allowed;
            $config['max_size'] = $max_size;

            /*if($width_height!='')
            $config['max_width']  = '480';
            $config['max_height']  = '380';*/

            $img=$_FILES[$userfile]['name'];
            $random_digit=time();
            //$ext = strtolower(substr($img, strpos($img,'.'), strlen($img)-1));
            $info = new SplFileInfo($img);
            $ext=$info->getExtension();
            $file_name=$random_digit.'.'.$ext;


            $config['file_name'] = $file_name;
            /*echo '<pre>';
            print_r($config);
            echo '</pre>'; exit;*/

            $this->ci->upload->initialize($config);
            $img_name= $this->ci->upload->do_upload($userfile);
			//echo $img_name;exit;
            if(isset($thumb) && $thumb==true):
                $f_name=$this->ci->upload->file_name;
                
            if($this->ci->upload->display_errors()!=true)
            {
                $this->_get_thumb($f_name,$image_path,$thumbval);
            }
                
            
            endif;

            //return $img_name;
            
            if($img_name)
            {    
				
                return array('status'=>TRUE,'filename'=>$f_name);
            }
            else {
				return array('status'=>FALSE,'error'=>$this->ci->upload->display_errors('<span>','</span>'));
				}

        }
    }

    function _get_thumb($filename,$image_path,$thumbval=array("height"=>"135","width"=>"120","ratio"=>true))
    {
        $source_path = $image_path.'/'.$filename;
        $target_path = $image_path . '/thumb/';
        if(!is_dir($target_path))
        {
            mkdir($target_path,0777);
        }
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => $thumbval["ratio"],
            'create_thumb' => TRUE,
            'thumb_marker' => '',
            'width' => $thumbval["width"],
            'height' =>$thumbval["height"]
        );

        $this->ci->image_lib->initialize($config_manip);
        if (!$this->ci->image_lib->resize()) {
            echo $this->ci->image_lib->display_errors();
        }
        // clear //
        $this->ci->image_lib->clear();
    }
    
    function _multi_upload_files_thumb($userfile,$image_path,$allowed,$max_size,$thumb=false,$thumbval=array())
    {

        $this->ci->load->library('upload');

        $files = $_FILES;
         $cpt = count($_FILES[$userfile]['name']);
         //echo $cpt;exit;
        for($i=0; $i<$cpt; $i++)
        {
            if($files[$userfile]['tmp_name'][$i]!='')
            {
                

                $_FILES[$userfile]['name']= $files[$userfile]['name'][$i];
                $_FILES[$userfile]['type']= $files[$userfile]['type'][$i];
                $_FILES[$userfile]['tmp_name']= $files[$userfile]['tmp_name'][$i];
                $_FILES[$userfile]['error']= $files[$userfile]['error'][$i];
                $_FILES[$userfile]['size']= $files[$userfile]['size'][$i];
                if(!is_dir($image_path))
                {
                    //echo $image_path;exit;
                    mkdir($image_path,0777);
                    //mkdir($image_path.'thumb/',0777);
                }
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = $allowed;
                $config['max_size'] = $max_size;
                $img=$_FILES[$userfile]['name'][$i];
                
                
                $random_digit=time();
                //$ext = strtolower(substr($img, strpos($img,'.'), strlen($img)-1));
                $info = new SplFileInfo($img);
                $ext=$info->getExtension();
                $file_name=$random_digit.$ext; 
              
                    

                $config['file_name'] = $file_name;

                $this->ci->upload->initialize($config);
                $this->ci->upload->do_upload($userfile);
                //   return  $this->ci->upload->display_errors();
                
                $newfile[]=$this->ci->upload->file_name;
                
                 if(isset($thumb) && $thumb==true):
                    $f_name=$this->ci->upload->file_name;
            
                    if($this->ci->upload->display_errors()!=true)
                    {
                        $this->_get_thumb($f_name,$image_path,$thumbval);
                    }

                endif;   
               
            }


        }

        if($newfile)
            {
                return array('status'=>TRUE,'filename'=>$newfile);
            }
            else {return array('status'=>FALSE,'error'=>$this->ci->upload->display_errors('<span>','</span>'));}

    }
    
    function _email($email)
    {       
        //print_r($email);exit;
        
         if($email['from']==''){
            $email['from']='test@ucodice.com';
         }
        $this->ci->load->helper('email');
        $this->ci->email->set_mailtype("html");
        $this->ci->email->from($email['from'], 'HarvestLinks');
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->to($email['to']);
        $this->ci->email->subject($email['subject']);
        $this->ci->email->message($email['message']);
        
        //return $this->ci->email->print_debugger(array('headers'));
        return $this->ci->email->send();
        //echo $this->ci->email->print_debugger();
    }
    
    function _email_attach($email)
    {
        $email['from']='test@ucodice.com';
        $this->ci->load->helper('email');
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->from($email['from']);
        $this->ci->email->to($email['to']);
        $this->ci->email->subject($email['subject']);
        $this->ci->email->message($email['message']);
        $this->ci->email->attach($email['file_path'].$email['filename']);
	return $this->ci->email->send();
    }
    
    function _csv_import($path,$table)
    {
        $this->ci->load->library('csvreader');
        
        $result =   $this->ci->csvreader->parse_file($path);//path to csv file
        
        $i=0;
        foreach($result as $rows)
        {
          //  $rows=explode(',',$rows[$i]);
            
            $data['val']=   $rows;
          //echo '<pre>';  print_r($data['val']);
          $data['table']=$table;
          return $this->ci->common->add_data($data);
            
        }
    }
    
    function _getsingle_project_tag($id,$project_id='')
    {
        $sess=  $this->ci->session->userdata('order');
       $user=$this->ci->users->get_user();
       if($user->type!='1'){
       //$where2=array('b.property_id'=>$id,'b.project_id'=>$project_id,'a.status'=>'1','c.user_id'=>  $this->ci->session->userdata('user_id'));$join2=array('table'=>'project_assign as c','on'=>'a.id=c.project_id','join_type'=>'');
       $where2=array('b.property_id'=>$id,'b.project_id'=>$project_id,'c.user_id'=>  $this->ci->session->userdata('user_id'));$join2=array('table'=>'project_assign as c','on'=>'a.id=c.project_id','join_type'=>'');
       }else{
          // $where2=array('b.property_id'=>$id,'b.project_id'=>$project_id,'a.status'=>'1');$join2='';
           $where2=array('b.property_id'=>$id,'b.project_id'=>$project_id);$join2='';
       }
                if($sess['by']=='project'){$order=$sess['type'];}else{$order='ASC';}
                $proj_data=array('val'=>'a.id,a.project_name,a.tag,b.flag_status,b.active_clk,b.status','start'=>'','minvalue'=>'','table'=>'project as a','where'=>$where2,'orderby'=>'a.tag','orderas'=>$order);
                $join=array('table'=>'property_assign as b','on'=>'a.id=b.project_id','join_type'=>'');
                $pro=$this->ci->common->get_join($proj_data,$join,$join2);
                return $pro['rows'];
    }
    
    function _get_project_tag($id,$project_id='')
    {
        $sess=  $this->ci->session->userdata('order');
       $user=$this->ci->users->get_user();
       if($user->type=='1' || $user->type=='2'){$where2=array('b.property_id'=>$id,'a.status'=>'1');$join2='';}elseif( $user->type=='3'){$where2=array('b.property_id'=>$id,'a.status'=>'1','c.user_id'=>  $this->ci->session->userdata('user_id'));$join2=array('table'=>'project_assign as c','on'=>'a.id=c.project_id','join_type'=>'');}
       else{$where2=array('b.property_id'=>$id,'b.project_id'=>$project_id,'a.status'=>'1','c.user_id'=>  $this->ci->session->userdata('user_id'));$join2=array('table'=>'project_assign as c','on'=>'a.id=c.project_id','join_type'=>'');}
                if($sess['by']=='project'){$order=$sess['type'];}else{$order='ASC';}
                $proj_data=array('val'=>'a.id,a.project_name,a.tag,b.flag_status,b.active_clk,b.status','start'=>'','minvalue'=>'','table'=>'project as a','where'=>$where2,'orderby'=>'a.tag','orderas'=>$order);
                $join=array('table'=>'property_assign as b','on'=>'a.id=b.project_id','join_type'=>'');
                $pro=$this->ci->common->get_join($proj_data,$join,$join2);
                return $pro['rows'];
    }
   
    function _get_project_tag_filter($id,$project_id)
   {
        $user=$this->ci->users->get_user();
        if($user->type=='1'){$where2=array('b.property_id'=>$id,'a.status'=>'1');$join2='';}else{$where2=array('b.property_id'=>$id,'a.status'=>'1','c.user_id'=>  $this->ci->session->userdata('user_id'));$join2=array('table'=>'project_assign as c','on'=>'a.id=c.project_id','join_type'=>'');}
        $this->ci->db->select('a.id,a.tag,a.project_name,b.flag_status,b.active_clk,b.status');
        $this->ci->db->from('project as a');
        $this->ci->db->join('property_assign as b','a.id=b.project_id','');
        if($join2!='')
        {
            $this->ci->db->join('project_assign as c','a.id=c.project_id','');
        }
        $sess=  $this->ci->session->userdata('order');
        if($sess['by']=='project'){$order=$sess['type'];}else{$order='ASC';}
        $this->ci->db->where($where2);
        $this->ci->db->where_in('a.id',$project_id);
        $this->ci->db->order_by('a.tag',$order);
        $query=$this->ci->db->get();
        return $query->result();
   }
   
   function _get_comment_filter($id,$project_id)
   {
       $user=$this->ci->users->get_user();
       if($user->type=='1'){$where2=array('b.property_id'=>$id,'d.property_id'=>$id,'a.status'=>'1');$join2='';}else{$where2=array('b.property_id'=>$id,'d.property_id'=>$id,'a.status'=>'1','c.user_id'=>  $this->ci->session->userdata('user_id'));}
       
       $this->ci->db->select('a.id,a.tag,d.active_clk,e.name,b.comment,b.id as comment_id');
       $this->ci->db->from('project as a');
       $this->ci->db->join('comments as b','a.id=b.project_id','');
       if($user->type!='1'){
       $this->ci->db->join('project_assign as c','a.id=c.project_id','');
       }
       $sess=  $this->ci->session->userdata('order');
       if($sess['by']=='project'){$order=$sess['type'];}else{$order='ASC';}
       $this->ci->db->join('property_assign as d','a.id=d.project_id','');
       $this->ci->db->join('users as e','e.id=b.user_id','');
       $this->ci->db->where($where2);
       $this->ci->db->where_in('a.id',$project_id);
       $this->ci->db->order_by('a.tag',$order);
       $query=$this->ci->db->get();
            // echo $this->ci->db->last_query();exit;
       return $query->result();
   }
   
   
   
   function _get_project()
   {
       $user=$this->ci->users->get_user();
       if($user->type==1)
       {
            $this->ci->db->select('id,project_name,tag');
            $this->ci->db->where('status','1');
            $this->ci->db->order_by('tag','ASC');
            $query= $this->ci->db->get('project');
            if($query->num_rows()>0)
            {
                return $query->result();
            }
       }else{
            $this->ci->db->select('a.id,project_name,tag');
            $this->ci->db->from('project as a');
            $this->ci->db->join('project_assign as b','a.id=b.project_id','');
            $this->ci->db->where('a.status','1');
            $this->ci->db->where('b.user_id',$user->id);
            $this->ci->db->order_by('project_name','ASC');
            $query=$this->ci->db->get();
            if($query->num_rows()>0)
            {
                return $query->result();
            }
       }
   }
   
   function _get_agent()
    {
        $val=array("id","CONCAT(name,'-',email) as text");
        $this->ci->db->select($val);
//        if(trim($this->input->get('search'))!='')
//        $this->db->like('name',  trim($this->input->get('search')),'after');
        $this->ci->db->where('type','2');
        $this->ci->db->where('status','1');
        $this->ci->db->order_by('name','ASC');
        $query= $this->ci->db->get('users');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }
    
    function _get_client()
    {
        $val=array("id","CONCAT(name,'-',email) as text");
        $this->ci->db->select($val);
//        if(trim($this->input->get('search'))!='')
//        $this->db->like('name',  trim($this->input->get('search')),'after');
        $this->ci->db->where('type','3');
        $this->ci->db->where('status','1');
        $this->ci->db->order_by('name','ASC');
        $query= $this->ci->db->get('users');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }
    
    function _get_property()
    {
        $val=array("id","CONCAT(streetaddress,' ',locality,' ',region) as text");
        $this->ci->db->select($val);
        //$this->db->like("CONCAT(streetaddress,' ',locality,' ',region)",  trim($this->input->get('search')),'after');
        $this->ci->db->where('active_clk','1');
        $this->ci->db->order_by('text','ASC');
        $query= $this->ci->db->get('property');
        if($query->num_rows()>0)
        {
           return $query->result();
        }
    }
            
   function _get_comment($id,$project_id)
   {
       $user=$this->ci->users->get_user();
       if($user->type=='1'){$where2=array('b.property_id'=>$id,'d.property_id'=>$id,'a.status'=>'1');$join2='';}elseif($user->type=='2' || $user->type=='3'){$where2=array('b.property_id'=>$id,'d.property_id'=>$id,'a.status'=>'1','c.user_id'=>  $this->ci->session->userdata('user_id'));}
       else{$where2=array('b.property_id'=>$id,'d.property_id'=>$id,'d.project_id'=>$project_id,'a.status'=>'1','c.user_id'=>  $this->ci->session->userdata('user_id'));}
       
       $this->ci->db->select('a.id,a.tag,d.active_clk,e.name,b.comment,b.id as comment_id');
       $this->ci->db->from('project as a');
       $this->ci->db->join('comments as b','a.id=b.project_id','');
       if($user->type!='1'){
       $this->ci->db->join('project_assign as c','a.id=c.project_id','');
       }
       $sess=  $this->ci->session->userdata('order');
       if($sess['by']=='project'){$order=$sess['type'];}else{$order='ASC';}
       $this->ci->db->join('property_assign as d','a.id=d.project_id','');
       $this->ci->db->join('users as e','e.id=b.user_id','');
       $this->ci->db->where($where2);
       $this->ci->db->order_by('a.tag',$order);
       $query=$this->ci->db->get();
       return $query->result();
   }
   
   function myurldecode($string)
   {
        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        return str_replace($entities, $replacements, $string);
    }
   
   function _getsingle_comment($id,$project_id)
   {
       $user=$this->ci->users->get_user();
       if($user->type!='1'){
       $where2=array('b.property_id'=>$id,'d.property_id'=>$id,'d.project_id'=>$project_id,'a.status'=>'1','c.user_id'=>  $this->ci->session->userdata('user_id'));
       }else{
           $where2=array('b.property_id'=>$id,'d.property_id'=>$id,'d.project_id'=>$project_id,'a.status'=>'1');
       }
       
       $this->ci->db->select('a.id,a.tag,d.active_clk,e.name,b.comment,b.id as comment_id');
       $this->ci->db->from('project as a');
       $this->ci->db->join('comments as b','a.id=b.project_id','');
       if($user->type!='1'){
       $this->ci->db->join('project_assign as c','a.id=c.project_id','');
       }
       $sess=  $this->ci->session->userdata('order');
       if($sess['by']=='project'){$order=$sess['type'];}else{$order='ASC';}
       $this->ci->db->join('property_assign as d','a.id=d.project_id','');
       $this->ci->db->join('users as e','e.id=b.user_id','');
       $this->ci->db->where($where2);
       $this->ci->db->order_by('a.tag',$order);
       $query=$this->ci->db->get();
       return $query->result();
   }
   
    function time_elapsed_string($datetime, $full = false) 
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    
    function _get_page_number($total_count,$current)
    {
        if($total_count['per_page']>=$total_count['total'])
        {
            $records='1 to '.$total_count['total'];
        }
        else{
                if($current=='')
                {
                    $records='1 to '.$total_count['per_page'];
                }
                else{
                    if(($current+$total_count['per_page'])<=$total_count['total'])
                        {
                            $records=($current+1).' to '.($current+$total_count['per_page']);
                        }
                        else{
                            $records=($current+1).' to '.($total_count['total']);
                            }

                    }
            }
            return $records;
    }
    // start done by avinash
    function delete_filter_cookie()
    {
        $name = "filter_tag_avi";
        delete_cookie($name);
    }
    
    function _valid_user()
    {
        if(!$this->ci->session->userdata('user_id'))
        {
            $this->ci->session->set_flashdata("warning","You are not a Valid User");
            redirect('auth/login','refresh');
        }
    }
    
    function _valid_customerUser()
    {
        if(!$this->ci->session->userdata('USERID'))
        {
            redirect('','refresh');
        }
    }
    
    function reset_filter()
    {
        $name = "filter_tag";
        delete_cookie($name);
    }
    // end done by avinash
    
    
    // start code by Niraj
    
    
    function Fblogin(){
        if ($this->user) {
                $data['user_profile'] = $this->ci->facebook->api('/me/');
                // Get logout url of facebook
                //print_r($data);exit;
                $data['logout_url'] = $this->ci->facebook->getLogoutUrl(array('next' => base_url() . 'index.php/oauth_login/logout'));
                   
                    //print_r($data['user_profile']);exit;
                    $fname=$data['user_profile']['first_name'];
                    $lname=$data['user_profile']['last_name'];
                    $email=$data['user_profile']['email'];  
                    
                    if($email==''){
                        redirect('welcome','refresh');
                    }
                    
                    $password=time();
                    
                    $data1=array('table'=>'user','val'=>'id,first_name,last_name','where'=>array('email'=>$email));
                    $chkdup=$this->ci->common->get_where_array($data1);
                   //print_R($chkdup);exit;
                    if($chkdup['res']){
                        $this->ci->session->set_userdata('USERID', $chkdup['rows']['id']);
                        $this->ci->session->set_userdata('USERFNAME', $chkdup['rows']['first_name']);
                        $this->ci->session->set_userdata('USERLNAME', $chkdup['rows']['last_name']);
                        $this->ci->session->set_userdata('is_login', true);
                        $this->ci->session->set_userdata('is_Fblogin', true);
                        $this->ci->session->set_userdata('logout_url', $data['logout_url']);
                            redirect('profile','refresh');
                    }else{
                        $data=array('table'=>'user','val'=>array('first_name'=>$fname,'last_name'=>$lname,'email'=>$email,'password'=> md5($password),'normal_password'=>$password,'status'=>'1'));
                        $userId=$this->ci->common->add_data_get_id($data);
                        // mail code here
                        //echo '</br>'.$data['logout_url'];
                            //echo '</br></br></br></br>thr'.$userId;exit;

                        /*$message="Hello $fname $lname, your user name : $email And Password : $password fro direct login.";
                        $email=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Your Account Confirmation','message'=>$message);
                        $sendmail=$this->ci->functions->_email($email);*/
                     
                        $this->ci->session->set_userdata('USERID', $userId);
                        $this->ci->session->set_userdata('USERFNAME', $fname);
                        $this->ci->session->set_userdata('USERLNAME', $lname);
                        $this->ci->session->set_userdata('is_login', true);
                        $this->ci->session->set_userdata('is_Fblogin', true);
                        $this->ci->session->set_userdata('logout_url', $data['logout_url']);
                            redirect('profile','refresh');
                    }

                } else {
                // Store users facebook login url
                            $login_url_params = array(
                                'scope' => 'read_stream,email,user_birthday',
                                'fbconnect' =>  1,
                                //'redirect_uri' => 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
                            );
                $data['login_url'] = $this->ci->facebook->getLoginUrl($login_url_params);
                

                return $data;
            }
    }
    
    
    
  

    
   function Gpluslogin(){
        
        $client = new apiClient();
        //print_r($client->getAccessToken());
        $client->setApplicationName("TykePosh");
        $client->setScopes(array('https://www.googleapis.com/auth/userinfo#email'));
        
        $plus = new apiPlusService($client);
        if (isset($_REQUEST['logout'])) {
            
         // unset($_SESSION['access_token']);
            $this->ci->session->unset_userdata('access_token');
        }

        if (isset($_GET['code'])) {
          $client->authenticate();
          //$_SESSION['access_token'] = $client->getAccessToken();
          $this->ci->session->set_userdata('access_token', $client->getAccessToken());
          //print_r($_SESSION['access_token']);exit;
          //header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        }

        if (isset($_SESSION['access_token'])) {
          $client->setAccessToken($this->ci->session->userdata('access_token'));
        }

        if ($client->getAccessToken()) {
          $me = $plus->people->get('me');
          //$emails = $me->getEmails();
        //print_R($me);exit;
          $optParams = array('maxResults' => 100);
          $activities = $plus->activities->listActivities('me', 'public',$optParams);

          // The access token may have been updated lazily.
          //$_SESSION['access_token'] = $client->getAccessToken();
          $this->ci->session->set_userdata('access_token', $client->getAccessToken());
        } else {
          $authUrl = $client->createAuthUrl();
        }


         if(isset($me))
         { 
//print_R($me);exit;
                    $fname=$me['name']['givenName'];
                    $lname=$me['name']['familyName'];
                    $email=$me['emails'][0]['value'];  

                    $password=time();
                    
                    $data1=array('table'=>'user','val'=>'id,first_name,last_name','where'=>array('email'=>$email));
                    $chkdup=$this->ci->common->get_where_array($data1);
                   //print_R($chkdup);exit;
                    if($chkdup['res']){
                        $this->ci->session->set_userdata('USERID', $chkdup['rows']['id']);
                        $this->ci->session->set_userdata('USERFNAME', $chkdup['rows']['first_name']);
                        $this->ci->session->set_userdata('USERLNAME', $chkdup['rows']['last_name']);
                        $this->ci->session->set_userdata('is_login', true);
                        //$this->ci->session->set_userdata('is_Fblogin', true);
                        //$this->ci->session->set_userdata('logout_url', $data['logout_url']);
                            redirect('profile','refresh');
                    }else{
                        $data=array('table'=>'user','val'=>array('first_name'=>$fname,'last_name'=>$lname,'email'=>$email,'password'=> md5($password),'normal_password'=>$password,'status'=>'1'));
                        $userId=$this->ci->common->add_data_get_id($data);
                        // mail code here
                        //echo '</br>'.$data['logout_url'];
                            //echo '</br></br></br></br>thr'.$userId;exit;
                        
                        /*$message="Hello $fname $lname, your user name : $email And Password : $password fro direct login.";
                        $email=array('from'=>'test@ucodice.com','to'=>$email,'subject'=>'Your Account Confirmation','message'=>$message);
                        $sendmail=$this->ci->functions->_email($email);*/
                     
                        $this->ci->session->set_userdata('USERID', $userId);
                        $this->ci->session->set_userdata('USERFNAME', $fname);
                        $this->ci->session->set_userdata('USERLNAME', $lname);
                        $this->ci->session->set_userdata('is_login', true);
                        //$this->ci->session->set_userdata('is_Fblogin', true);
                        //$this->ci->session->set_userdata('logout_url', $data['logout_url']);
                            redirect('profile','refresh');
                    }
         
         
         } 
         if(isset($authUrl)) {  
              return $authUrl;
          } else {
           print "<a class='logout' href='welcome/logout'>Logout</a>";
          }

    }
    
    
    public function _afterloginpage_delete(){
       
        //echo $this->ci->session->userdata("afterloginpage");exit;
       if($this->ci->session->has_userdata("afterloginpage")){
            $this->ci->session->unset_userdata("afterloginpage");
        }
    }


public function read_dir($path){
        //echo is_dir($path);exit;
            if(is_dir($path)){
            $files = directory_map($path);
                return $resp=array("status"=>true,"files"=>$files);
            }else{
                return $resp=array("status"=>false,"files"=>array());
            }
    }
    
    
    public function delete_file($path){
        if(file_exists($path)){
            unlink($path);
            $dir=explode("/",$path);array_pop($dir);$dir=implode("/",$dir);$files = directory_map($dir);
            if(empty($files)){
                 if(is_dir($dir)){
                     rmdir($dir);
                 }
                return array("status"=>true,"message"=>"successfully deleted file","no_of_file"=>0); 
            }
            return array("status"=>true,"message"=>"successfully deleted file","no_of_file"=>1);
        }else{
            return array("status"=>false,"message"=>"file not exists");
        }
    }
    
    
    public function delete_directory($path){
        if(is_dir($path)){
            $dir=delete_files($path);
            rmdir($path);
            if($dir){
                return array("status"=>true,"message"=>"successfully deleted files");
            }
        }else{
            return array("status"=>false,"message"=>"diectory not exists");
        }
    }


	public function recurse_copy($src,$dst) { 
        $dir = opendir($src); 
        if(!is_dir($dst))
            {
                $old_umask = umask(0);
                mkdir($dst,0777);
                umask($old_umask);
            }
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    $old_umask = umask(0);
                    copy($src . '/' . $file,$dst . '/' . $file); 
                    umask($old_umask);
                } 
            } 
        } 
        closedir($dir); 
    }

    // End code by Niraj
}
