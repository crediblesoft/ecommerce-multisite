<?php 
class Editmodel extends CI_Model 
{  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
     $this->load->database(); 
     $this->load->helper('date');


    //$this->load->model('modelsite');
  }
   public function getdata($data)
    {        
        $this->db->select($data['val']);
        $this->db->from($data['table']);
        $this->db->where($data['where']);
        $query = $this->db->get();
        
         if($query -> num_rows() > 0)
            {
            $result=array('res'=>true,'rows'=>$query->result());
            return $result;
     
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
        
    }
    
    public function multijoin($data,$multijoin,$limit=0, $start=1)
	{  
        //$query=" select ";
            if($limit > 0){
                $this->db->limit($limit, $start);
            }
            
            $this->db->select($data['val']);
            $this->db->from($data['table']);
            //$query=$query.' '.$data['val'];
           // $query=$query.' table '.$data['table'];
            for($i=0;$i< count($multijoin); $i++){
               // $query=$query.' join '.$multijoin[$i]['table'].$multijoin[$i]['on'].$multijoin[$i]['join_type'];
                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }
            
            if(isset($data['group_by'])){
                $this->db->group_by($data['group_by']);
            }
           
            if($data['where']!=''){
            $this->db->where($data['where']);
              //$query=$query.' whare '.$data['where'];
            }
            if(isset($data['or_where'])){
            $this->db->group_start();
            $this->db->or_where($data['or_where']);
            $this->db->group_end();
            }
            
            if($data['orderby']!=''){
                $this->db->order_by($data['orderby'], $data['orderas']);
                 //$query=$query.' order by  '.$data['orderby'].' '.$data['orderas'];
            }
            //$this->db->order_by($data['orderby'],$data['orderas']);
           // print_r($query);exit;
            $query=$this->db->get();  
           //print_R($this->db->last_query());exit;
            if($query -> num_rows() > 0)
            {
                $result=array('res'=>TRUE,'rows'=>$query->result());
                return $result;
            }
            else
            {
                $result=array('res'=>FALSE);
                return $result;
            }
	}
        public function getsinglerow($data){
        
        $this->db->select($data['val']);
        $this->db->from($data['table']);
        $this->db->where($data['where']);
        $query = $this->db->get();
        
         if($query -> num_rows() > 0)
            {
            $result=array('res'=>true,'rows'=>$query->row());
            return $result;
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
    }
    public function addNewUserData($userid,$themeid)
    {//$userid='112';
        //$themeid='1001';//comment this line whane active this theme option ok
        $ara=['1001'=>'theme1','1002'=>'theme2','1003'=>'theme3','1004'=>'theme4'];
        $tablename=['theme_bootstrap','theme_css','theme_menu','theme_text'];  
        $tablename1=['db_bootstrap','db_css','menu','db_text'];
        
        /*for($i=0;$i<=(count($tablename)-1);$i++)
        {
            switch ($tablename1[$i]) 
            {
                case 'db_bootstrap':*/
                    $tabledata=['tablefrom'=>'theme_bootstrap','table'=>'db_bootstrap','val'=>'*','wheredelete'=>'user_id="'.$userid.'"','where'=>'theme_id="'.$themeid.'"'];
                   // echo $tabledata['table']."<br/>";
                   // echo $tabledata['val']."<br/>";
                    //echo $tabledata['where']."<br/>";
                    //print_r($tabledata);
                    //exit;
                    $check1=$this->editmodel->checkDataEsistOrNot($tabledata);
                    if($check1)
                    {
                        $res=$this->db->select($tabledata['val'])->from($tabledata['tablefrom'])->where($tabledata['where'])->get();
                        
                        foreach ($res->result_array() as $result)
                        {
                            $dataarra[]=array(
                            'user_id' => $userid,
                            'theme_id' => $themeid,
                            'class' => $result['class'],
                            'bootstrap_name' => $result['bootstrap_name'],
                            'bootstrap_num' => $result['bootstrap_num']
                            );  
                        }//echo "<br/>u are in db_bootstrap<br/>";
                       // print_r($dataarra);
                        $this->db->insert_batch('db_bootstrap',$dataarra);
                    }
                    else
                        {
                       // echo "soory some error hasbeen acurd soory for that";
                        exit;
                    }
                   /* break;
                case 'db_css':*/
                    $tabledata=['tablefrom'=>'theme_css','table'=>'db_css','val'=>'*','wheredelete'=>'user_id="'.$userid.'" ','where'=>'theme_id="'.$themeid.'"'];
                    $check2=$this->editmodel->checkDataEsistOrNot($tabledata);
                    if($check2)
                    {
                        $res=$this->db->select($tabledata['val'])->from($tabledata['tablefrom'])->where($tabledata['where'])->get();
                        foreach ($res->result_array() as $result)
                        {
                            $dataarra1[]=array(
                            'user_id' => $userid,                            
                            'class_name' => $result['class_name'],
                            'class_css' => $result['class_css']
                            );   
                        }
                        // print_r($dataarra1);
                        //echo "<br/>u are in db_css<br/>";                        
                        $this->db->insert_batch('db_css',$dataarra1);
                    }
                    else
                        {
                       // echo "soory some error hasbeen acurd soory for that";
                        exit;
                    }
                  /*  break;
                case 'menu':*/
                   $tabledata=['tablefrom'=>'theme_menu','table'=>'menu','val'=>'*','wheredelete'=>'user_id="'.$userid.'" ','where'=>'theme_id="'.$themeid.'"'];
                   $check3=$this->editmodel->checkDataEsistOrNot($tabledata);
                   if($check3)
                    {
                        $res=$this->db->select($tabledata['val'])->from($tabledata['tablefrom'])->where($tabledata['where'])->get();
                        foreach ($res->result_array() as $result)
                        { 
                            $dataarra2[]=array(
                            'user_id' => $userid,                            
                            'sub_id' => $result['sub_id'],
                            'file_path' => $result['file_path'],
                            'label' => $result['label'],
                            'link' => $result['link'],
                            'parent' => $result['parent'],
                            'sort' => $result['sort'],
                            'view' => $result['view'],
                            'stetus' => $result['stetus'],
                            'user_created' => $result['user_created'],
                            'page_title' => $result['label']
                            );   
                        }//echo "<br/>u are in menu<br/>";
                        $this->db->insert_batch('menu',$dataarra2);
                    }
                    else
                        {
                        //echo "soory some error hasbeen acurd soory for that";
                        exit;
                    }
                   /* break;
                case 'db_text':*/
                   $tabledata=['tablefrom'=>'theme_text','table'=>'db_text','val'=>'*','wheredelete'=>'user_id="'.$userid.'" ','where'=>'theme_id="'.$themeid.'"'];
                   $check4=$this->editmodel->checkDataEsistOrNot($tabledata);
                    if($check4)
                    {
                        $res=$this->db->select($tabledata['val'])->from($tabledata['tablefrom'])->where($tabledata['where'])->get();
                        foreach ($res->result_array() as $result)
                        {
                            $dataarra3[]=array(
                            'user_id' => $userid,
                            'page_name' => $themeid,
                            'page_type_data' => $result['page_type_data'],
                            'class_name' => $result['class_name'],
                            'text_data' => $result['text_data']
                            );   
                        }//echo "<br/>u are in db_text<br/>";
                        $this->db->insert_batch('db_text',$dataarra3);
                    }
                    else
                        {
                        //echo "soory some error hasbeen acurd soory for that";
                        exit;
                    }
                   /* break;
                default:
                    exit;
                    break;
            }
            //echo $tablename[$i].' => '.$tablename1[$i]."<br/>";
            //exit;
        }*/
                    
     // code start by niraj
    $tabledata=['tablefrom'=>'db_element','table'=>'db_element','val'=>'*','wheredelete'=>'user_id="'.$userid.'" ','where'=>'theme_id="'.$themeid.'"'];
    $check5=$this->editmodel->checkDataEsistOrNot($tabledata);       
    $tabledata=['tablefrom'=>'view_position','table'=>'view_position','val'=>'*','wheredelete'=>'user_id="'.$userid.'" ','where'=>'theme_id="'.$themeid.'"'];
    $check6=$this->editmodel->checkDataEsistOrNot($tabledata);
    $tabledata=['tablefrom'=>'product_view','table'=>'product_view','val'=>'*','wheredelete'=>'user_id="'.$userid.'" ','where'=>'theme_id="'.$themeid.'"'];
    $check7=$this->editmodel->checkDataEsistOrNot($tabledata);
     // code end by niraj
                   
                    
                    
        $date = date('Y-m-d'); 
        $res=$this->db->select('id')->from('db_theem')->where('user_id',$userid)->get();
        if($res->num_rows()>0)
        {
         //$this->db->where('user_id',$userid);
         //$res= $this->db->delete('db_theem');
            $data=array('table'=>'db_theem',
                 'where'=>array('user_id'=>$userid),
                'val'=>array('theam_id'=>$themeid,
                            'file_name'=>$ara[$themeid].'.css',
                            'update_date'=>$date));
         return $this->common->update_data($data);
        }else{
        $rowdata=array('table'=>'db_theem',
            'val'=>array('user_id'=>$userid,
                        'theam_id'=>$themeid,
                        'file_name'=>$ara[$themeid].'.css',
                        'add_date'=>$date,'update_date'=>$date));
         return $this->db->insert($rowdata['table'],$rowdata['val']);
        }
       
    }
    public function checkDataEsistOrNot($data)
    {
        $res=$this->db->select($data['val'])->from($data['table'])->where($data['wheredelete'])->get();
       // echo $data['val']."<br/>";
        //echo $data['table']."<br/>";
        //echo $data['wheredelete']."<br/>";
        //exit;
        if($res->num_rows()>0)
        {
           // $tables = array('table1', 'table2', 'table3');
            $this->db->where($data['wheredelete']);
            return $res= $this->db->delete($data['table']);
            
        }
        else
        {
           // echo "no data ";
            //exit;
            return TRUE;
        }
    }
    
}
      