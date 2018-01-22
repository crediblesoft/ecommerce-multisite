<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authorize.net AIM Integration
 *
 * For Authorize.net AIM integration
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author		SammyK (http://sammyk.me/)
 * @link		https://github.com/SammyK/codeigniter-authorize.net-aim-api
 */
class Authorize_net
{
    private $CI;					// CodeIgniter instance
    private $api_login_id = '563xvGNj';			// API Login ID
    private $api_transaction_key = '86mE8m832Uv5EyEZ';	// API Transaction Key
    private $api_url = 'https://test.authorize.net/gateway/transact.dll';
    private $post_vals = array();		// Values that get posted to Authroize.net
	
	/*
	 * If your installation of cURL works without the "CURLOPT_SSL_VERIFYHOST"
	 * and "CURLOPT_SSL_VERIFYPEER" options disabled, then remove them
	 * from the array below for better security.
	 */
    private $curl_options = array(		// Additional cURL Options
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		);
	
    private $response = '';				// Response from Authorize.net
    private $transation_id = '';		// The transation ID from Authorize.net
    private $approval_code = '';		// The approval code from Authorize.net
	
    private $error = '';				// Error to show to the user

	public function __construct( $config = array() )
	{
		$this->CI =& get_instance();
		
		// Load config file
		$this->CI->config->load('authorize_net', TRUE);
		//print_r( $this->CI->config->item('authorize_net'));
		foreach( $this->CI->config->item('authorize_net') as $key => $value )
		{//echo $this->$key."<br/>";
			if( isset($this->$key) )
			{//echo $this->$key."<br/>";
				$this->$key = $value;
                               // echo $value."<br/>";
			}
		}
               
		//$this->initialize($config);
	}

	// Initialize the lib
	public function initialize( $config )
	{ 
		foreach( $config as $key => $value )
		{
			if( isset($this->$key) )
			{
				$this->$key = $value;
			}
		}
	}
	
	// Set the data that we're going to send
	public function setData( $data )
	{
		$this->post_vals = $data;
	}
	
	// Get the values we're going to send
	public function getPostVals()
	{
		$auth_net_vals = array(
			'x_login'                       => $this->api_login_id,
			'x_tran_key'			=> $this->api_transaction_key,
			'x_version'			=> '3.1',
			'x_delim_char'			=> '|',
			'x_delim_data'			=> 'TRUE',
			'x_type'			=> 'AUTH_CAPTURE',
			'x_method'			=> 'CC',
			'x_relay_response'		=> 'FALSE',
			);
		
		return array_merge($auth_net_vals, $this->post_vals);
	}
	
	// Authorize and capture a card
	public function authorizeAndCapture()
	{
		// Load cURL lib
		$this->CI->load->library('curl');
		$this->response = $this->CI->curl->simple_post(
				$this->api_url,
				$this->getPostVals(),
				$this->curl_options);
		
		return $this->parseResponse($this->response);
	}
	
	// Parse the response back from Authorize.net
	public function parseResponse( $response )
	{
		if( $response === FALSE )
		{
			$this->error = 'There was a problem while contacting the payment gateway. Please try again.';
			return FALSE;
		}
		elseif( is_string($response) && strpos($response, '|') !== FALSE )
		{
			$res = explode('|', $response);
			
			if( isset($res[0]) )
			{
				switch( $res[0] )
				{
					case '1': // Approved
					$this->transation_id = isset($res[6]) ? $res[6] : '';
					$this->approval_code = isset($res[4]) ? $res[4] : '';
					return TRUE;
					break;
				
					case '2': // Declined
					case '3': // Error
					case '4': // Held for Review
					if( isset($res[3]) )
					{
						$this->error = $res[3];
					}
					return FALSE;
					break;
				
					default: // ??
					break;
				}
			}
			else
			{
				$this->error = 'There was a problem while contacting the payment gateway. Please try again.';
				return FALSE;
			}
		}
		
		$this->error = 'Received an unknown response from the payment gateway. Please try again.';
		return FALSE;
	}
	
	// Get the transation ID
	public function getTransactionId()
	{
		return $this->transation_id;
	}
	
	// Get the transation code
	public function getApprovalCode()
	{
		return $this->approval_code;
	}
	
	// Get the error text
	public function getError()
	{
		return $this->error;
	}
	
	// Dump some debug data to the screen
	public function debug()
	{
//		echo "<h1>Authorize.NET AIM API</h1>\n";
//		$url = $this->CI->curl->debug_request();
//		echo "<p>URL: " . $url['url'] . "</p>\n";
//		echo "<h3>Response</h3>\n";
//		echo "<code>" . nl2br(htmlentities($this->response)) . "</code><br/>\n\n";
//		echo "<hr>\n";
//
//		if( $this->CI->curl->error_string )
//		{
//			echo "<h3>cURL Errors</h3>";
//			echo "<strong>Code:</strong> " . $this->CI->curl->error_code . "<br/>\n";
//			echo "<strong>Message:</strong> " . $this->CI->curl->error_string . "<br/>\n";
//			echo "<hr>\n";
//		}
//
//		echo "<h3>cURL Info</h3>";
//		echo "<pre>";
//		print_r($this->CI->curl->info);
//		echo "</pre>";
	}
	
	// Reset everything so we can try again
	public function clear()
	{
		$this->response = '';
		$this->transation_id = '';
		$this->approval_code = '';
		$this->error = '';
		$this->post_vals = array();
	}
        
        function do_payment ($post_values)
        {
        $post_url = "https://test.authorize.net/gateway/transact.dll";		  
        // This section takes the input fields and converts them to the proper format
	$post_string = "";
	foreach( $post_values as $key => $value )
	{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
	   $post_string = rtrim( $post_string, "& " );
	
	// This sample code uses the CURL library for php to establish a connection,
		// submit the post, and record the response.
		// If you receive an error, you may want to ensure that you have the curl
		// library enabled in your php configuration
		
		$request = curl_init($post_url); // initiate curl object
		
		curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
		$post_response = curl_exec($request); // execute curl post and store results in $post_response
		
		// additional options may be required depending upon your server configuration
		// you can find documentation on curl options at http://www.php.net/curl_setopt
		curl_close ($request); // close curl object
		
		// This line takes the response and breaks it into an array using the specified delimiting character
		$response_array = explode($post_values["x_delim_char"],$post_response);
		
		// The results are output to the screen in the form of an html numbered list.
		if($response_array)
		{
		return $response_array;
		}
	  else { return ''; }
	}

}

/* EOF */