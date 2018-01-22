<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Imageupload extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->functions->_valid_user();       
        $this->userid=$this->session->userdata('user_id');
        $this->userpaidstatus=$this->session->userdata('user_paid');
    }
    
    public function index()
    {
       $res= $this->_userlimitationeditpenal("media",$this->userpaidstatus,"userProd_image",array("user_id"=>$this->userid,"type_ofimage"=>"gallery"),"gallery");
       if($res['status']){
        $userfile='file';
        $image_path='assets/image/gallery/'.$this->userid.'/';
        $allowed='jpg|png|jpeg';
        $max_size='4096000';
        
//        $allowedimage = array("jpg", "png", "jpeg","JPEG");
//        $ImageName[0]   = $_FILES['file']['name'];//str_replace(' ','-',strtolower($_FILES['file']['name']));        
//        
//        $ImageExt = substr($ImageName[0], strrpos($ImageName[0], '.'));
//        $ImageExt = str_replace('.','',$ImageExt);
//        && in_array($ImageExt, $allowedimage)
        
        $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
       //print_r($fileupload);exit;        
        
        
        if($fileupload['status'] ){
           
                $onefilename=$fileupload['filename'];                            
                $dataforinsert=array('user_id'=>$this->userid,'type_ofimage'=>'gallery','image_path'=>$onefilename,'status'=>'1');
                
           
            $data=array('table'=>'userProd_image','val'=>$dataforinsert);                
            $log=$this->common->add_data($data);
            
            $output['statusimage']=TRUE;
            $output['id']=$this->db->insert_id();
            $output['image_medium']= BASE_URL.'assets/image/gallery/'.$this->userid.'/'.$onefilename;
            $output['image_small']= BASE_URL.'assets/image/gallery/'.$this->userid.'/'.$onefilename;
        }
        else
        {
            $output['statusimage']=FALSE;
            $output['image_medium']= BASE_URL.'edit_assets/image/my.jpg';
            $output['image_small']= BASE_URL.'edit_assets/image/my.jpg';
        }
        echo json_encode($output);
        
       }
 else {
          $output['statusimage']=FALSE;
            $output['image_medium']= BASE_URL.'edit_assets/image/my.jpg';
            $output['image_small']= BASE_URL.'edit_assets/image/my.jpg'; 
            echo json_encode($output);
    }
        /*$user_session_id=  $this->session->userdata('user_id');
        ini_set("memory_limit", "99M");
        ini_set('post_max_size', '20M');
        ini_set('max_execution_time', 600);
        define('IMAGE_SMALL_DIR', BASE_URL.'assets/image/gallery/'.$user_session_id.'/thumb/');
        define('IMAGE_SMALL_SIZE', 120);
        define('IMAGE_SMALL_SIZE_HEIGHT', 135);
        define('IMAGE_MEDIUM_DIR', BASE_URL.'assets/image/gallery/'.$user_session_id.'/');
        define('IMAGE_MEDIUM_SIZE', 250);


        if(isset($_FILES['image_upload_file'])){
	$output['status']=FALSE;
	set_time_limit(0);
	$allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
	
	if ($_FILES['image_upload_file']["error"] > 0) {
		$output['error']= "Error in File";
	}
	elseif (!in_array($_FILES['image_upload_file']["type"], $allowedImageType)) {
		$output['error']= "You can only upload JPG, PNG and GIF file";
	}
	elseif (round($_FILES['image_upload_file']["size"] / 1024) > 4096) {
		$output['error']= "You can upload file size up to 4 MB";
	} else {
		//create directory with 777 permission if not exist - start
		$this->createDir(IMAGE_SMALL_DIR);
		$this->createDir(IMAGE_MEDIUM_DIR);
		//create directory with 777 permission if not exist - end
		$path[0] = $_FILES['image_upload_file']['tmp_name'];
		$file = pathinfo($_FILES['image_upload_file']['name']);
                
                $ImageName = str_replace(' ','-',strtolower($_FILES['image_upload_file']['name']));
               

                $desiredExt = substr($ImageName, strrpos($ImageName, '.'));
                $desiredExt = str_replace('.','',$desiredExt);
                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                
		$fileType = $file["extension"];
		$desiredExt='jpg';
		$fileNameNew = $ImageName.'-'.rand(0, 9999999999) . time() . ".$desiredExt";
		$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
		$path[2] = IMAGE_SMALL_DIR . $fileNameNew;
		
                if(isset($_FILES['file']['name'])){
                    $userfile='file';
                    $image_path='assets/image/gallery/'.$user_session_id.'/';
                    $allowed='jpg|png|jpeg';
                    $max_size='1024';
                    
                    $fileupload=$this->functions->_upload_image_thumb($userfile,$image_path,$allowed,$max_size,true,array("height"=>"140","width"=>"250","ratio"=>true));
                     }else{
                         $fileupload=array('status'=>1,'filename'=>'');
                     }
                     
                     //print_r($fileupload);exit;
                     $prodImage=$fileupload['filename'];
		//if (move_uploaded_file($_FILES['image_upload_file']['tmp_name'], $path[1])) {
		//move_uploaded_file($_FILES['image_upload_file']['tmp_name'], $path[1]);	
			if ($this->createThumb($path[1], $path[2],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE_HEIGHT,IMAGE_SMALL_SIZE)) {
				$output['status']=TRUE;
				$output['image_medium']= $path[1];
				$output['image_small']= $path[2];
			}
		//}
	}
	echo json_encode($output);
        }*/  
    }
    
    
    function createDir($path){		
	if (!file_exists($path)) {
		$old_mask = umask(0);
		mkdir($path, 0777, TRUE);
		umask($old_mask);
	}
    }

function createThumb($path1, $path2, $file_type, $new_w, $new_h, $squareSize = ''){
	/* read the source image */
	$source_image = FALSE;
	
	if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
		$source_image = imagecreatefromjpeg($path1);
	}
	elseif (preg_match("/png|PNG/", $file_type)) {
		
		if (!$source_image = @imagecreatefrompng($path1)) {
			$source_image = imagecreatefromjpeg($path1);
		}
	}
	elseif (preg_match("/gif|GIF/", $file_type)) {
		$source_image = imagecreatefromgif($path1);
	}		
	if ($source_image == FALSE) {
		$source_image = imagecreatefromjpeg($path1);
	}

	$orig_w = imageSX($source_image);
	$orig_h = imageSY($source_image);
	
	if ($orig_w < $new_w && $orig_h < $new_h) {
		$desired_width = $orig_w;
		$desired_height = $orig_h;
	} else {
		$scale = min($new_w / $orig_w, $new_h / $orig_h);
		$desired_width = ceil($scale * $orig_w);
		$desired_height = ceil($scale * $orig_h);
	}
			
	if ($squareSize != '') {
		$desired_width = $desired_height = $squareSize;
	}

	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	// for PNG background white----------->
	$kek = imagecolorallocate($virtual_image, 255, 255, 255);
	imagefill($virtual_image, 0, 0, $kek);
	
	if ($squareSize == '') {
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $orig_w, $orig_h);
	} else {
		$wm = $orig_w / $squareSize;
		$hm = $orig_h / $squareSize;
		$h_height = $squareSize / 2;
		$w_height = $squareSize / 2;
		
		if ($orig_w > $orig_h) {
			$adjusted_width = $orig_w / $hm;
			$half_width = $adjusted_width / 2;
			$int_width = $half_width - $w_height;
			imagecopyresampled($virtual_image, $source_image, -$int_width, 0, 0, 0, $adjusted_width, $squareSize, $orig_w, $orig_h);
		}

		elseif (($orig_w <= $orig_h)) {
			$adjusted_height = $orig_h / $wm;
			$half_height = $adjusted_height / 2;
			imagecopyresampled($virtual_image, $source_image, 0,0, 0, 0, $squareSize, $adjusted_height, $orig_w, $orig_h);
		} else {
			imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $squareSize, $orig_w, $orig_h);
		}
	}
	
	if (@imagejpeg($virtual_image, $path2, 90)) {
		imagedestroy($virtual_image);
		imagedestroy($source_image);
		return TRUE;
	} else {
		return FALSE;
	}
    
    }
}