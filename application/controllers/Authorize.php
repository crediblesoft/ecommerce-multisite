<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authorize extends MY_Controller 
{

    public function __construct()
    {
        parent::__construct();
       $this->load->library('session');
    }    
    public function index()
    {
        //echo "you are hare in Authorize";     
        
        $this->load->view('include/header');
        $this->load->view('payment/Authorize');
        $this->load->view('include/footer');
    }
    public function paymentAuthorise()
	{
		// Authorize.net lib
		$this->load->library('authorize_net');
		$auth_net = array(
			'x_card_num'			=> '4111111111111111', // Visa
			'x_exp_date'			=> '12/18',
			'x_card_code'			=> '123',
			'x_description'			=> 'A test transaction',
			'x_amount'			=> '20',
			'x_first_name'			=> 'sachin',
			'x_last_name'			=> 'kumar',
			'x_address'				=> '123 Green St.',
			'x_city'				=> 'Lexington',
			'x_state'				=> 'KY',
			'x_zip'					=> '40502',
			'x_country'				=> 'US',
			//'x_phone'				=> '555-123-4567',
			'x_email'				=> 'sachin@ucodice.com',
			'x_customer_ip'			=> $this->input->ip_address()
			);
		$this->authorize_net->setData($auth_net);

		// Try to AUTH_CAPTURE
		if( $this->authorize_net->authorizeAndCapture() )
		{
			echo '<h2>Success!</h2>';
			echo '<p>Transaction ID: ' . $this->authorize_net->getTransactionId() . '</p>';
			echo '<p>Approval Code: ' . $this->authorize_net->getApprovalCode() . '</p>';
		}
		else
		{
			echo '<h2>Fail!</h2>';
			// Get error
			echo '<p>' . $this->authorize_net->getError() . '</p>';
			// Show debug data
			$this->authorize_net->debug();
		}
	}
}
?>