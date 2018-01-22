<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends CI_Model {

   function signin($data)
   {
       $this -> db -> select($data['val']);
       $this -> db -> from($data['table']);
       $this -> db -> where($data['where']);
       $this -> db -> limit(1);

       $query = $this -> db -> get();

        if($query -> num_rows() > 0)
        {
            $result=array('res'=>true,'rows'=>$query->row_object());
            return $result;
        }
        else
        {
            $result=array('res'=>false);
            return $result;
        }
    }
 // common functions
    function add_data($data)
	{
            return $this->db->insert($data['table'],$data['val']);
	}

	function add_data_get_id($data)
	{

            $this->db->insert($data['table'],$data['val']);
            $insert_id = $this->db->insert_id();

            return  $insert_id;
	}

	function get_data($data)
	{
            $this->db->order_by($data['orderby'],$data['orderas']);
            if($data['start']!='' && $data['limit']!='')
            {
                $this->db->limit($data['limit'], $data['start']);
            }
            $query=$this->db->get($data['table']);

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

	function get_where($data)
	{
            $this->db->select($data['val']);
            $this->db->where($data['where']);
            $query=$this->db->get($data['table']);
            if($query -> num_rows() > 0)
            {
                $result=array('res'=>true,'rows'=>$query->row_object());
                return $result;
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
	}

        function get_where_array($data)
	{
            $this->db->select($data['val']);
            $this->db->where($data['where']);

            $query=$this->db->get($data['table']);

            if($query -> num_rows() > 0)
            {
            $result=array('res'=>true,'rows'=>$query->row_array());
            return $result;

            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
	}

	function get_where_all($data)
	{
            $this->db->select($data['val']);
            $this->db->where($data['where']);
            $this->db->order_by($data['orderby'],$data['orderas']);
            if($data['start']!='' && $data['limit']!='')
            {
                $this->db->limit($data['limit'], $data['start']);
            }
            $query=$this->db->get($data['table']);

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



	function get_verify($data)
	{
            $this->db->select($data['val']);
            $this->db->where($data['where']);
            $query=$this->db->get($data['table']);
            //return $this->db->last_query();
            if($query -> num_rows() > 0)
            {
                $result=array('res'=>true);
                return $result;
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
	}

	function get_verify_data($data)
	{
            $this->db->select($data['val']);
            $this->db->where($data['where']);
            $query=$this->db->get($data['table']);
            if($query -> num_rows() > 0)
            {
            $result=array('res'=>true,'rows'=>$query->row_object());
            return $result;
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
	}



	function get_some($data)
	{
            $this->db->select($data['val']);
            $this->db->order_by($data['orderby'],$data['orderas']);
            if($data['start']!='' && $data['limit']!='')
            {
                $this->db->limit($data['limit'], $data['start']);
            }
            $query=$this->db->get($data['table']);
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

	function get_join($data,$join,$join2)
	{
            $this->db->select($data['val']);
            $this->db->from($data['table']);
            $this->db->join($join['table'], $join['on'],$join['join_type']);
            if($join2!='')
            {
                $this->db->join($join2['table'], $join2['on'],$join2['join_type']);
            }
            if($data['where']!='')
            {
                $this->db->where($data['where']);
            }
            if($data['minvalue']!='')
            {

                $this->db->where("DATE_FORMAT(a.created, '%d %m %Y') >=", $data['minvalue']);
                $this->db->where("DATE_FORMAT(a.created, '%d %m %Y') <=", $data['maxvalue']);
            }
            if($data['group_by']!='')
            {
                $this->db->group_by($data['group_by']);
            }

            $this->db->order_by($data['orderby'],$data['orderas']);
             if($data['start']!='' && $data['limit']!='')
            {
                $this->db->limit($data['limit'], $data['start']);
            }
                $query=$this->db->get();   //return $this->db->last_query();
            if($query -> num_rows() > 0)
            {
                $result=array('res'=>true,'rows'=>$query->result(),'count'=>$query -> num_rows());
                return $result;
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
	}

	function get_join2($data,$join,$join2)
	{
            $this->db->select($data['val']);
            $this->db->from($data['table']);
            $this->db->join($join['table'], $join['on'],$join['join_type']);
            if($join2!='')
            {
                    $this->db->join($join2['table'], $join2['on'],$join2['join_type']);
            }
            if($data['where']!=''){
            $this->db->where($data['where']);
            }
            //$this->db->order_by($data['orderby'],$data['orderas']);
            $query=$this->db->get();   //return $this->db->last_query();
            if($query -> num_rows() > 0)
            {
                $result=array('res'=>true,'rows'=>$query->row_object());
                return $result;
            }
            else
            {
                $result=array('res'=>false);
                return $result;
            }
	}

        function get_data_group($data)
	{
            $this->db->select($data['val']);
            $this->db->from($data['table']);

            if($data['where']!='')
            {
                $this->db->where($data['where']);
            }
            $this->db->group_by($data['group']);
            $this->db->order_by($data['orderby'],$data['orderas']);
            if($data['start']!='' && $data['limit']!='')
            {
                 $this->db->limit($data['limit'], $data['start']);
            }
            $query=$this->db->get(); //return $this->db->last_query();
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

/*	function get_join_or($value,$join,$join2,$where,$or_where,$table1)
	{
		$this->db->select($value);
		$this->db->from($table1);
		$this->db->join($join['table'], $join['on'],$join['join_type']);
		if($join2!='')
		{
			$this->db->join($join2['table'], $join2['on'],$join2['join_type']);
		}
		if($where!=''){
		$this->db->where("(a.sent_to='".$where['sent_to']."' and  a.sent_by='".$where['sent_by']."') or (a.sent_to='".$or_where['sent_to']."' and  a.sent_by='".$or_where['sent_by']."')");
		}
		$this->db->order_by('a.id','asc');
		$query=$this->db->get();  // $this->db->last_query();
		if($query -> num_rows() > 0)
   {
     return  $query->result();

   }
   else
   {
     return false;
   }
	}

	function get_message($where)
	{
		 $query= $this->db->query("SELECT * from (SELECT `b`.`id`, `b`.`name`, a.sent_by, a.status, `b`.`image`, `a`.`message`, `a`.`created`, `a`.`id` as message_id FROM (`message` as a) JOIN `user` as b ON `a`.`sent_by`=`b`.`id` WHERE `a`.`sent_to` = '".$where['sent_to']."' ORDER BY `a`.`id` desc) tb GROUP BY `id`  ORDER BY `message_id` desc");
		 return $query->result();
		// $this->db->last_query();
	}
	*/
	function get_join_group($data,$join,$join2)
	{
            $this->db->select($data['val']);
            $this->db->from($data['table']);
            $this->db->join($join['table'], $join['on'],$join['join_type']);
            if($join2!='')
            {
                    $this->db->join($join2['table'], $join2['on'],$join2['join_type']);
            }
            if($data['where']!='')
            {
                $this->db->where($data['where']);
            }
            $this->db->group_by($data['group']);
            $this->db->order_by($data['orderby'],$data['orderas']);
            $query=$this->db->get(); //return $this->db->last_query();
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

    function get_not_in($data)
	{
            $this->db->select($data['val']);
            $this->db->where_not_in($data['not_in'], $data['not_in_value']);
            $this->db->order_by($data['orderby'],$data['orderas']);
            $query=$this->db->get($data['table']);

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

    function get_in($data)
    {
        $this->db->select($data['val']);
        if($data['where']!='')
        {
            $this->db->where($data['where']);
        }

        $this->db->where_in($data['in'], $data['in_value']);

        $this->db->order_by($data['orderby'],$data['orderas']);
        $query=$this->db->get($data['table']);

        if($query -> num_rows() > 0)
        {
            $result=array('res'=>true,'rows'=>$query->result(),'count'=>$query->num_rows());
            return $result;
        }
        else
        {
            $result=array('res'=>false);
            return $result;
        }
    }

    function update_data($data)
    {
        $this->db->where($data['where']);
        return $this->db->update($data['table'], $data['val']);
         // $this->db->last_query();
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

    function delete_data($data)
    {
        $this->db->where($data['where']);
        return $this->db->delete($data['table']);
    }

    function delete_cond($cond,$data)
    {
        $this->db->select($cond['val']);
        $this->db->where($cond['where']);
        $query=$this->db->get($cond['table']);
        if($query -> num_rows() > 0)
        {
            $this->db->where($data['where']);
            return $this->db->delete($data['table']);
        }else{
            return $this->db->last_query;
        }
    }


    /**Prerna 19 may 2015**/
    public function checkDuplicate($data) {
        $this->db->where($data['where']);
        $query = $this->db->get('property');
        $count_row = $query->num_rows();
        if ($count_row > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /*  Niraj */

    public function getdata($data){

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

    public function getdata_like($data){

        $this->db->select($data['val']);
        $this->db->from($data['table']);
        $this->db->where($data['where']);
        if(isset($data['like'])){
            if(count($data['like'])>0){
                $this->db->like($data['like']['likeon'], $data['like']['likeval']);
            }
        }
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


    function insert_multi_row($data)
	{
            return $this->db->insert_batch($data['table'],$data['val']);
	}


    function update_multi_row($data)
    {
        /*

         $data = array(
            array(
                    'id' => 1,
                    'name' => 'My Name 2' ,
            ),
            array(
                    'id' => 2,
                    'name' => 'Another Name 2' ,
            )
        );

        $this->db->update_batch('table', $data, 'id');
        echo $this->db->affected_rows();

         */


         //return $this->db->last_query();
        $this->db->update_batch($data['table'],$data['val'],$data['where']);
       return $this->db->affected_rows();

        }

        function update_in_data($data)
        {
            $this->db->where($data['where']);
            if($data['in']!=''){
                $this->db->where_in($data['in'],$data['in_value']);
            }
            return $this->db->update($data['table'], $data['val']);
             // $this->db->last_query();
        }

	function delete_in_data($data)
        {
            $this->db->where($data['where']);
            if($data['in']!=''){
                $this->db->where_in($data['in'],$data['in_value']);
            }
            return $this->db->delete($data['table']);
             // $this->db->last_query();
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

    public function getNofrows($data){
        $query=$this->db->get_where($data['table'],$data['where']);
	$num = $query->num_rows();
	return $num;
    }

    public function record_count($table){
        $query=$this->db->get_where($table);
	$num = $query->num_rows();
	return $num;
    }


    public function record_count_where($data){
        $this->db->from($data['table']);
        $this->db->where($data['where']);
	if(isset($data['group_by'])){
            $this->db->group_by($data['group_by']);
        }
        $query=$this->db->get();
        //print_R($query);exit;
	$num = $query->num_rows();
	return $num;
    }


     public function record_count_between($data){
            $this->db->from($data['table']);
            $this->db->where($data['between']['col'].'>=', $data['between']['from']);
            $this->db->where($data['between']['col'].'<=', $data['between']['to']);

                $query=$this->db->get();
                $num = $query->num_rows();
                return $num;
    }

    public function get_all_with_paginaiton($limit, $start ,$table) {
            $this->db->limit($limit, $start);

            $query = $this->db->get($table);

		return $query->result();
    }

     public function get_where_with_paginaiton($limit, $start ,$data ) {

            $this->db->from($data['table']);
            $this->db->where($data['where']);
            $this->db->limit($limit, $start);
            if($data['orderby']!=''){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }
             $query = $this->db->get();
       //echo $query;exit;
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


        function multijoin($data,$multijoin,$limit=0, $start=1)
	{
            if($limit > 0){
                $this->db->limit($limit, $start);
            }

            $this->db->select($data['val']);
            $this->db->from($data['table']);

            for($i=0;$i< count($multijoin); $i++){

                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }

            if(isset($data['group_by'])){
                $this->db->group_by($data['group_by']);
            }

            if($data['where']!=''){
            $this->db->where($data['where']);
            }

            if(isset($data['or_where'])){
            $this->db->group_start();
            $this->db->or_where($data['or_where']);
            $this->db->group_end();
            }

            if(isset($data['orderby']) && $data['orderby']!=''){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }
            //$this->db->order_by($data['orderby'],$data['orderas']);

            $query=$this->db->get();
           //print_R($this->db->last_query());exit;
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

	function multijoin_with_in($data,$multijoin,$limit=0, $start=1)
	{
            if($limit > 0){
                $this->db->limit($limit, $start);
            }

            $this->db->select($data['val']);
            $this->db->from($data['table']);

            for($i=0;$i< count($multijoin); $i++){

                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }

            if(isset($data['group_by'])){
                $this->db->group_by($data['group_by']);
            }

            if($data['where']!=''){
            $this->db->where($data['where']);
            }

            if(isset($data['or_where'])){
            $this->db->group_start();
            $this->db->or_where($data['or_where']);
            $this->db->group_end();
            }

            if($data['orderby']!=''){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }

            if($data['in_value']!=''){
                $this->db->where_in($data['in'],$data['in_value']);
               //$this->db->group_end();
            }

            if(isset($data['like'])){
                if(count($data['like'])>0){
                    $this->db->like($data['like']['likeon'], $data['like']['likeval']);
                }
            }
            //$this->db->order_by($data['orderby'],$data['orderas']);

            $query=$this->db->get();
           //print_R($this->db->last_query());exit;
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


        function multijoin_with_multiin($data,$multijoin,$limit=0, $start=1)
	{
            if($limit > 0){
                $this->db->limit($limit, $start);
            }

            $this->db->select($data['val']);
            $this->db->from($data['table']);

            for($i=0;$i< count($multijoin); $i++){

                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }

            if(isset($data['group_by'])){
                $this->db->group_by($data['group_by']);
            }

            if($data['where']!=''){
            $this->db->where($data['where']);
            }

            if($data['orderby']!=''){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }

            /*if($data['in_value']!=''){
                $this->db->where_in($data['in'],$data['in_value']);
               //$this->db->group_end();
            }*/


            if(count($data['in'])>0){
                //$this->db->group_start();
                for($i=0;$i<count($data['in']);$i++){
                     $this->db->where_in($data['in'][$i],$data['in_value'][$i]);
                }
                //$this->db->group_end();
            }

            if(isset($data['like'])){
                if(count($data['like'])>0){
                    $this->db->like($data['like']['likeon'], $data['like']['likeval']);
                }
            }
            //$this->db->order_by($data['orderby'],$data['orderas']);

            $query=$this->db->get();
           //print_R($this->db->last_query());exit;
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


        function multijoin_with_like($data,$multijoin=array(),$limit=0, $start=1)
	  {
            if($limit > 0){
                $this->db->limit($limit, $start);
            }
            $this->db->select($data['val']);
            $this->db->from($data['table']);

            for($i=0;$i< count($multijoin); $i++){

                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }
            if($data['where']!=''){
            $this->db->where($data['where']);
            }

            if(isset($data['group_by'])){
                $this->db->group_by($data['group_by']);
            }

            if(count($data['like'])>0){

					$this->db->like($data['like']['likeon'], $data['like']['likeval']);


            }

			if(isset($data['orderby'])){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }





            //$this->db->order_by($data['orderby'],$data['orderas']);
            $query=$this->db->get();   //return $this->db->last_query();
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

	 function multijoin_with_con_like($data,$multijoin=array(),$limit=0, $start=1)
	  {
            if($limit > 0){
                $this->db->limit($limit, $start);
            }
            $this->db->select($data['val']);
                $this->db->from($data['table']);

                    for($i=0;$i< count($multijoin); $i++){
                        $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
                    }
                 if(isset($data['group_by'])){
                        $this->db->group_by($data['group_by']);
                    }

        if(isset($data['where'])){
        $this->db->where($data['where']);
        }

        if(isset($data['or_where'])){
            $this->db->group_start();
            $this->db->or_where($data['or_where']);
            $this->db->group_end();
            }

            if(isset($data['orderby'])){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }
        $this->db->group_start();
        $this->db->or_group_start();

        if(isset($data['like'])){
            $this->db->like($data['like'][0]['likeon'], $data['like'][0]['likeval']);

            for($i=1;$i<count($data['like']);$i++){
                $like=$data['like'][$i];
                $this->db->or_like($like['likeon'], $like['likeval']);
            }
        }

        $this->db->group_end();


        if(isset($data['in'])){
            for($i=0;$i<count($data['in']);$i++){
                if(count($data['in_value'][$i])>0){$this->db->or_where_in($data['in'][$i], $data['in_value'][$i]);}
            }
        }
        $this->db->group_end();
        //$this->db->order_by($data['orderby'],$data['orderas']);
        $query=$this->db->get();   //return $this->db->last_query();
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





        function multijoin_between($data,$multijoin,$limit=0, $start=1)
	{
            if($limit > 0){
                $this->db->limit($limit, $start);
            }

            $this->db->select($data['val']);
            $this->db->from($data['table']);

            for($i=0;$i< count($multijoin); $i++){

                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }

            if(isset($data['like'])){
                $this->db->like($data['like']['likeon'], $data['like']['likeval']);
            }

            if($data['where']!=''){
            $this->db->where($data['where']);
            }

            if(count($data['in_value'])>0){
                //$this->db->group_start();
                for($i=0;$i<count($data['in']);$i++){
                     $this->db->where_in($data['in'][$i],$data['in_value']);
                }
                //$this->db->group_end();
            }

			if(isset($data['group_by'])){
                $this->db->group_by($data['group_by']);
            }

            if($data['orderby']!=''){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }



           if($data['between']!=''){
               if($data['between']['from']!='' && $data['between']['to']){
                    $this->db->where($data['between']['col'].'>=', $data['between']['from']);
                    $this->db->where($data['between']['col'].'<=', $data['between']['to']);
               }else if($data['between']['from']!=''){
                    $this->db->where($data['between']['col'].'>=', $data['between']['from']);
               }else if($data['between']['to']){
                    $this->db->where($data['between']['col'].'<=', $data['between']['to']);
               }
            }



            //$this->db->order_by($data['orderby'],$data['orderas']);
            $query=$this->db->get();   //return $this->db->last_query();
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



        function multijoin_between2($data,$multijoin,$limit=0, $start=1)
	{
            if($limit > 0){
                $this->db->limit($limit, $start);
            }

            $this->db->select($data['val']);
            $this->db->from($data['table']);

            for($i=0;$i< count($multijoin); $i++){

                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }

            if(isset($data['like'])){
                $this->db->like($data['like']['likeon'], $data['like']['likeval']);
            }

            if(isset($data['like_multicol'])){
                foreach($data['like_multicol'] as $datalike){
                    if($datalike['likeval']!=''){ $this->db->like($datalike['likeon'], $datalike['likeval']);}
                }
            }

            if($data['where']!=''){
            $this->db->where($data['where']);
            }

            if(isset($data['or_where'])){
            $this->db->group_start();
            $this->db->or_where($data['or_where']);
            $this->db->group_end();
            }

            if(count($data['in_value'])>0){
                //$this->db->group_start();
                for($i=0;$i<count($data['in']);$i++){
                     $this->db->where_in($data['in'][$i],$data['in_value'][$i]);
                }
                //$this->db->group_end();
            }

	    if(isset($data['group_by'])){
                $this->db->group_by($data['group_by']);
            }

            if($data['orderby']!=''){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }



           if($data['between']!=''){
               if($data['between']['from']!='' && $data['between']['to']){
                    $this->db->where($data['between']['col'].'>=', $data['between']['from']);
                    $this->db->where($data['between']['col'].'<=', $data['between']['to']);
               }else if($data['between']['from']!=''){
                    $this->db->where($data['between']['col'].'>=', $data['between']['from']);
               }else if($data['between']['to']){
                    $this->db->where($data['between']['col'].'<=', $data['between']['to']);
               }
            }



            //$this->db->order_by($data['orderby'],$data['orderas']);
            $query=$this->db->get();   //return $this->db->last_query();
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



        function multijoin_max($data,$multijoin,$limit=0, $start=1)
	{
            $this->db->limit($limit, $start);
            $this->db->select_max($data['max']);
            $this->db->select($data['val']);
            $this->db->from($data['table']);

            for($i=0;$i< count($multijoin); $i++){

                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }
            if($data['where']!=''){
            $this->db->where($data['where']);
            }

            //$this->db->order_by($data['orderby'],$data['orderas']);
            $query=$this->db->get();
            //return $this->db->last_query();
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


        function getdata_between($data,$limit,$start){
            $this->db->limit($limit, $start);
            $this->db->select($data['val']);
            $this->db->from($data['table']);

            if($data['where']!=''){
            $this->db->where($data['where']);
            }

           if($data['between']!=''){
                if($data['between']['from']!='' && $data['between']['to']){
                    $this->db->where($data['between']['col'].'>=', $data['between']['from']);
                    $this->db->where($data['between']['col'].'<=', $data['between']['to']);
               }else if($data['between']['from']!=''){
                    $this->db->where($data['between']['col'].'>=', $data['between']['from']);
               }else if($data['between']['to']){
                    $this->db->where($data['between']['col'].'<=', $data['between']['to']);
               }
            }

            //$this->db->order_by($data['orderby'],$data['orderas']);
            $query=$this->db->get();   //return $this->db->last_query();
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

    function get_in_multi_col($data)
    {
        $this->db->select($data['val']);
        if($data['where']!='')
        {
            $this->db->where($data['where']);
        }
        for($i=0;$i<count($data['in']);$i++){
            $this->db->where_in($data['in'][$i], $data['in_value'][$i]);
        }
        $this->db->order_by($data['orderby'],$data['orderas']);
        $query=$this->db->get($data['table']);

        if($query -> num_rows() > 0)
        {
            $result=array('res'=>true,'rows'=>$query->result(),'count'=>$query->num_rows());
            return $result;
        }
        else
        {
            $result=array('res'=>false);
            return $result;
        }
    }


    public function getdatalike($data){

        $this->db->select($data['val']);
        $this->db->from($data['table']);

        if(isset($data['where'])){
        $this->db->where($data['where']);
        }

        if(isset($data['like'])){
            foreach($data['like'] as $like){
                $this->db->or_like($like['likeon'], $like['likeval']);
            }
        }
        //$this->db->order_by($data['orderby'],$data['orderas']);
        $query=$this->db->get();   //return $this->db->last_query();
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

    public function getdatalikeor($data,$multijoin=array()){

        $this->db->select($data['val']);
        $this->db->from($data['table']);

            for($i=0;$i< count($multijoin); $i++){
                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }

        if(isset($data['where'])){
        $this->db->where($data['where']);
        }

        if(isset($data['or_where'])){
            $this->db->group_start();
            $this->db->or_where($data['or_where']);
            $this->db->group_end();
            }

            if(isset($data['orderby'])){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }
        $this->db->group_start();
        $this->db->or_group_start();

        if(isset($data['like'])){
            $this->db->like($data['like'][0]['likeon'], $data['like'][0]['likeval']);

            for($i=1;$i<count($data['like']);$i++){
                $like=$data['like'][$i];
                $this->db->or_like($like['likeon'], $like['likeval']);
            }
        }

        $this->db->group_end();


        if(isset($data['in'])){
            for($i=0;$i<count($data['in']);$i++){
                if(count($data['in_value'][$i])>0){$this->db->or_where_in($data['in'][$i], $data['in_value'][$i]);}
            }
        }
        $this->db->group_end();
        //$this->db->order_by($data['orderby'],$data['orderas']);
        $query=$this->db->get();   //return $this->db->last_query();
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


    public function chkduplicate($data){
        $this->db->from($data['table']);
        $this->db->where($data['where']);
        $query=$this->db->get();
        if($query->num_rows()==0){
            return false;
        }else{
            return true;
        }
    }


    public function getminmax($data){
        if(isset($data['min'])){
            $this->db->select_min($data['min']['field'],$data['min']['as']);
        }

        if(isset($data['max'])){
        $this->db->select_max($data['max']['field'],$data['max']['as']);
        }

        $this->db->from($data['table']);

        if(isset($data['where'])){
        $this->db->where($data['where']);
        }

        $query=$this->db->get();

        //return $this->db->last_query();

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


    /*public function get_fourtable_join(){
        $this->db->select('*');
        $this->db->from('order_map');
        $this->db->join('order', 'order_map.order_id = order.id');
        $this->db->join('user', 'order_map.customer_id = user.id');
        $query = $this->db->get();
        return $query->result();
       // print_r($query);exit;
    }*/

    // end common functions


	function dbQuery($query)
    {
        $query=$this->db->query($query);
        if($query -> num_rows() > 0)
        {
            $result=array('res'=>true,'rows'=>$query->result());
            return $result;

        }
        else
        {
            $result=array('res'=>false,'rows'=>false);
            return $result;
        }
    }

}
