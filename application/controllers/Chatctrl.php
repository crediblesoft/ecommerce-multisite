<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatctrl extends MY_Controller {
    private $userid;
    private $currentmonth;
    private $currentyear;
    private $userpaidstatus;
    
    function __construct()
    {
        parent::__construct();
         if(!is_numeric($this->uri->segment(2))){
            $this->functions->_valid_user();
            $this->functions->_afterloginpage_delete();
        }
        //$this->functions->_valid_user();
        //$this->functions->_afterloginpage_delete();
        $this->userid=$this->session->userdata('user_id');
        $this->userpaidstatus=$this->session->userdata('user_paid'); 
    }
    
    public function index(){
        if ($_GET['action'] == "chatheartbeat")
        {
            $this->chatHeartbeat();
        } 
        if ($_GET['action'] == "sendchat")
        { 
            $this->sendChat();
        } 
        if ($_GET['action'] == "closechat")
        {
            $this->closeChat();
        } 
        if ($_GET['action'] == "startchatsession")
        {
            $this->startChatSession();
        } 

        //getchathistory
        if ($_GET['action'] == "getchathistory")
        {
            $this->getchathistory($_GET['from']);
        } 
        
        if($_GET['action']=='messageViewed'){
            $this->messageViewed($_GET['from']);
        }

        if (!isset($_SESSION['chatHistory']))
        {
            $_SESSION['chatHistory'] = array();	
        }

        if (!isset($_SESSION['openChatBoxes']))
        {
            $_SESSION['openChatBoxes'] = array();	
        }
    }
    
    function chatHeartbeat()
{
	
	$sql = "select chat.*,user_Info.username from chat left join user_Info on chat.from=user_Info.id where (chat.to = '".$this->userid."' AND recd = 0) order by id ASC";
    //echo $sql;exit;
    $query = $this->db->query($sql)->result_array();
	//$query = mysql_query($sql);
	$items = '';

	$chatBoxes = array();

	foreach ($query as $chat)
    {
        
		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']]))
        {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}

		$chat['message'] = $this->sanitize($chat['message']);

		$items .= <<<EOD
		{
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}",
            "newF" : "{$chat['username']}",
            "newF2" : "{$chat['username']}"
        },
EOD;

        if (!isset($_SESSION['chatHistory'][$chat['from']]))
        {
            $_SESSION['chatHistory'][$chat['from']] = '';
        }
    
        $_SESSION['chatHistory'][$chat['from']] .= <<<EOD
        {
                "s": "0",
                "f": "{$chat['from']}",
                "m": "{$chat['message']}",
                "newF" : "{$chat['username']}",
                "newF2" : "{$chat['username']}"
        },
EOD;
            
            unset($_SESSION['tsChatBoxes'][$chat['from']]);
            $_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	/*if (!empty($_SESSION['openChatBoxes']))
    {
        foreach ($_SESSION['openChatBoxes'] as $chatbox => $time)
        {
            if (!isset($_SESSION['tsChatBoxes'][$chatbox]))
            {
                $now = time()-strtotime($time);
                $time = date('g:iA M dS', strtotime($time));

                $message = "Sent at $time";
                if ($now > 180)
                {
                    $items .= <<<EOD
                    {
                        "s": "2",
                        "f": "$chatbox",
                        "m": "{$message}",
                        "newF" : "tese1",
                        "newF2" : "tese12"
                    },
EOD;
    
                    if (!isset($_SESSION['chatHistory'][$chatbox]))
                    {
                        $_SESSION['chatHistory'][$chatbox] = '';
                    }
    
                    $_SESSION['chatHistory'][$chatbox] .= <<<EOD
                    {
                        "s": "2",
                        "f": "$chatbox",
                        "m": "{$message}",
                        "newF" : "tese2",
                        "newF2" : "tese22"
                    },
EOD;
                    $_SESSION['tsChatBoxes'][$chatbox] = 1;
                }
            }
        }
    }*/

    //$this->messageViewed();

	if ($items != '')
    {
		$items = substr($items, 0, -1);
	}
    header('Content-type: application/json');
?>
    {
		"items": [
			<?php echo $items;?>
        ]
    }

<?php
			exit(0);
}
    

function chatBoxSession($chatbox)
{
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession()
{
	$items = '';
	if (!empty($_SESSION['openChatBoxes']))
    {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void)
        {
			$items .= $this->chatBoxSession($chatbox);
		}
	}


	if ($items != '')
    {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
?>
{
		"username": "<?php echo $this->session->userdata('user_name');?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php


	exit(0);
}

function sendChat()
{
	$from = $this->userid;
	$to = $_POST['to'];
	$message = $_POST['message'];
    
	$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
	
	$messagesan = $this->sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']]))
    	{
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}

    $usernamshow=$this->getusernamebyid($to);
    
	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
	{
        "s": "1",
        "f": "{$to}",
        "m": "{$messagesan}",
        "newF" : "{$usernamshow}",
        "newF2" : "{$usernamshow}"
	},
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['to']]);
	$nw=date('Y-m-d H:i:s');
	$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".$from."', '".$to."','".$message."','".$nw."')";
	$query = $this->db->query($sql);
	echo "1";
	exit(0);
}

function closeChat()
{

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text)
{
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}

function getusernamebyid($id){
    $sql="select * from user_Info where id=".$id;
    $data=$this->db->query($sql)->row();
    return $data->username;
}


function getchathistory($from){
    
    $_SESSION['openChatBoxes'][$from]='';$_SESSION['chatHistory'][$from]='';
    $usernamshow=$this->getusernamebyid($from);
    
    $sql = "select chat.*,user_Info.username from chat left join user_Info on chat.from=user_Info.id where ((chat.to = '".$this->userid."' && chat.from = '".$from."') || (chat.to = '".$from."' && chat.from = '".$this->userid."')) order by sent ASC";
    //echo $from,$this->userid;
    //echo $sql;exit;
	$query = $this->db->query($sql)->result_array();
    //print_R($query);exit;
	$items = '';

	$chatBoxes = array();

	foreach ($query as $chat)
    {
		if (!isset($_SESSION['openChatBoxes'][$from]) && isset($_SESSION['chatHistory'][$from]))
        {
			$items = $_SESSION['chatHistory'][$from];
		}

		$chat['message'] = $this->sanitize($chat['message']);

		$items .= <<<EOD
		{
			"s": "0",
			"f": "{$from}",
			"m": "{$chat['message']}",
            "newF" : "{$chat['username']}",
            "newF2" : "{$usernamshow}"
        },
EOD;

        if (!isset($_SESSION['chatHistory'][$from]))
        {
            $_SESSION['chatHistory'][$from] = '';
        }
    
        $_SESSION['chatHistory'][$from] .= <<<EOD
        {
                "s": "0",
                "f": "{$from}",
                "m": "{$chat['message']}",
                "newF" : "{$chat['username']}",
                "newF2" : "{$usernamshow}"
        },
EOD;
            
            unset($_SESSION['tsChatBoxes'][$from]);
            $_SESSION['openChatBoxes'][$from] = $chat['sent'];
	}
    
    	if ($items != '')
    {
		$items = substr($items, 0, -1);
	}
    header('Content-type: application/json');
?>
    {
		"items": [
			<?php echo $items;?>
        ]
    }

<?php
     $this->messageViewed($from);
			exit(0);
   
    
}
    
    
function messageViewed($from){
    $sql = "update chat set recd = 1 where chat.to = '".$this->userid."' and chat.from='".$from."' and recd = 0";
    //echo $sql;exit;
	$query = $this->db->query($sql);
}
   
}
