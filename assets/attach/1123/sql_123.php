<?php
 if($sub_url == null)
        {
            $table['page_type']="only_main";
            $comment2=array('val'=>'t.id','table'=>'tabs as t','where'=>array("t.page_url"=>$url),'minvalue'=>'','group_by'=>'','start'=>'','orderby'=>'','orderas'=>'');
            $table['pagedata2']=$this->common->getdata($comment2);
            $id= $table['pagedata2']['rows']['0']->id;
            // print_r($table);exit;
            // echo $this->db->last_query();exit;
            $comment3=array('val'=>'ta.parent_tab,ta.id,p.id,p.page_name,p.content,p.timestamp,p.status,p.filename,p.page_url','table'=>'pages as p','where'=>array("ta.id"=>$id),'group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC');
            $multijoin3=array(array('table'=>'tabs as ta','on'=>'p.page_name=ta.tab','join_type'=>'left'));
            $table['pagedata3']=$this->common->multijoin($comment3,$multijoin3);
            //echo $this->db->last_query();exit();
            
             //print_r($table);exit;
                // $comment3=array('val'=>'ta.*','table'=>'tabs as ta','where'=>array("ta.parent_tab"=>$id),'group_by'=>'','start'=>'','orderby'=>'','orderas'=>'DESC');
                //   $table['pagedata3']=$this->common->getdata($comment3);

                // echo $this->db->last_query();exit;
             if($table['pagedata3']['res'])
             {
                
                     $comment1=array('val'=>'t.tab,t.id,p.id,p.page_name,p.content,p.timestamp,p.status,p.filename,p.page_url','table'=>'tabs as t','where'=>array("t.parent_tab"=>$id),'group_by'=>'t.id','start'=>'','orderby'=>'t.id','orderas'=>'DESC');
                $multijoin1=array(array('table'=>'pages as p','on'=>'t.tab=p.page_name','join_type'=>'left'));
                $table['pagedata']=$this->common->multijoin($comment1,$multijoin1);
               


                }
                else
                {
                $comment1=array('val'=>'ta.parent_tab,ta.id,p.id,p.page_name,p.content,p.timestamp,p.status,p.filename,p.page_url','table'=>'pages as p','where'=>array("p.page_url"=>$url),'group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
                $multijoin1=array(array('table'=>'tabs as ta','on'=>'p.page_name=ta.tab','join_type'=>'left'));
                $table['pagedata']=$this->common->multijoin($comment1,$multijoin1);

            
               }
       
        }
        else
        {
             $table['page_type']="with_detail";
            $comment1=array('val'=>'p.id,p.page_name,p.content,p.timestamp,p.status,p.filename,p.page_url','table'=>'pages as p','where'=>array("page_url"=>$sub_url),'minvalue'=>'','group_by'=>'p.id','start'=>'','orderby'=>'p.id','orderas'=>'DESC');
                $table['pagedata']=$this->common->getdata($comment1);


       
	   }
       ?>