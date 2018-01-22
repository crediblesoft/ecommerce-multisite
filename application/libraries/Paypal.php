<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal {
     private $API=array();
    function __construct()
    {

        define('MODE','2');

        if(MODE=='1')
             define('API_SANDBOX',"https://api-3t.paypal.com/nvp");
        else
             define('API_SANDBOX',"https://api-3t.sandbox.paypal.com/nvp");

        if(API_SANDBOX=='https://api-3t.sandbox.paypal.com/nvp')
            define('SANDBOX_ACC','https://www.sandbox.paypal.com/cgi-bin/webscr');
        else
            define('SANDBOX_ACC','https://www.paypal.com/cgi-bin/webscr');





        /*$this->API['USER'] = 'singhkumarvinay23-facilitator_api1.gmail.com';
        $this->API['PWD'] = '1410246966';
        $this->API['SIGNATURE'] = 'AFcWxV21C7fd0v3bYYYRCpSSRl31A8X9-bZUrSTrtbhVbjjq0cvdrap8';
        $this->API['VERSION'] = '108';
        $this->API['LOCALECODE'] = 'pt_US';*/

        $this->API['USER'] = 'pavnishyadav-facilitator_api1.gmail.com';
        $this->API['PWD'] = 'EH5F8AVSWSDGDGP9';
        $this->API['SIGNATURE'] = 'AFcWxV21C7fd0v3bYYYRCpSSRl31AHzNm5HNcZVKOpeI8zx4d5.jtqgE';
        $this->API['VERSION'] = '119';
        $this->API['LOCALECODE'] = 'pt_US';

        define('C_TYPE','USD');

    }

	
    function pay($data)
    {

        $this->API['METHOD'] = 'SetExpressCheckout';
        $value=  array_merge($this->API,$data);//print_r($value);
        /*echo '<pre>';
        print_r($value); die;*/
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL, API_SANDBOX);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($value));

        $response =    curl_exec($curl);

        curl_close($curl);
       // print_r($response);
       /* if($response==true)
            echo 'success';*/

        $nvp = array();
        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
            foreach ($matches['name'] as $offset => $name) {
                $nvp[$name] = urldecode($matches['value'][$offset]);
            }
        }

        if (isset($nvp['ACK']) && $nvp['ACK'] == 'Success') {
            $query = array(
                'cmd'    => '_express-checkout',
                'token'  => $nvp['TOKEN']
            );

             $redirectURL = sprintf(SANDBOX_ACC.'?%s', http_build_query($query));
          
             /*?><script>window.location="<?php echo $redirectURL?>";</script><?php*/
            echo '<script>window.location="'.$redirectURL.'";</script>';
            header("'Location:" . $redirectURL."'");
           
             echo $redirectURL;
        }


        return $response;





    }


    function CheckoutDetails($token)//$token=''
    {  
        unset($this->API['LOCALECODE']);
        //$token=  $this->input->get('token');

        $data=array();
        $this->API['TOKEN']=$token;
        $this->API['METHOD']='GetExpressCheckoutDetails';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL, API_SANDBOX);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->API));

        $response = curl_exec($curl);

        curl_close($curl);

        $nvp = array();

        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
            foreach ($matches['name'] as $offset => $name) {
                $nvp[$name] = urldecode($matches['value'][$offset]);
            }
        }
       //return $nvp;

        //print_r($nvp); die;
        //if($nvp['ACK']=='Success')

        $data['TOKEN']=$nvp['TOKEN'];
        $data['PayerID']=$nvp['PAYERID'];
        $data['amount']=$nvp['PAYMENTREQUEST_0_AMT'];
        $data['desc']=$nvp['L_DESC0'];
        $data['success']=$nvp['ACK'];
        $data['currency_code']=$nvp['PAYMENTREQUEST_0_CURRENCYCODE'];
        $data['payment_req']=$nvp['L_PAYMENTREQUEST_0_DESC0'];
        $data['title']=$nvp['L_PAYMENTREQUEST_0_NAME0'];


        return $this->ExpressCheckoutPayment($data);
    }

    function ExpressCheckoutPayment($data)
    {

        $this->API['METHOD'] = 'DoExpressCheckoutPayment';
        $this->API['TOKEN']=$data['TOKEN'];
        $this->API['PAYERID']=$data['PayerID'];
        $this->API['PAYMENTREQUEST_0_PAYMENTACTION']='Sale';
        $this->API['PAYMENTREQUEST_0_AMT']=$data['amount'];
        $this->API['L_PAYMENTREQUEST_0_DESC0']=$data['payment_req'];
        $this->API['PAYMENTREQUEST_0_CURRENCYCODE']=$data['currency_code'];
        $this->API['L_PAYMENTREQUEST_0_AMT0']=$data['amount'];
        $this->API['L_PAYMENTREQUEST_0_NAME0']=$data['title'];

        $value=$this->API;
        //print_r($value);


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL, API_SANDBOX);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($value));

        $response =    curl_exec($curl);

        $nvp = array();

        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
            foreach ($matches['name'] as $offset => $name) {
                $nvp[$name] = urldecode($matches['value'][$offset]);
            }
        }
        //print_r($nvp);exit;
        if($nvp['PAYMENTINFO_0_ACK']=='Success' && $nvp['ACK']=='Success'):
            $data=array(
                'response'=>true,
                'amount'=>$nvp['PAYMENTINFO_0_AMT'],
                'currency'=>$nvp['PAYMENTINFO_0_CURRENCYCODE'],
                'type'=>$nvp['PAYMENTINFO_0_TRANSACTIONTYPE'],
            );
            else:
                $data=array(
                    'response'=>false,
                    'message'=>$nvp['L_LONGMESSAGE0']
                );
        endif;

        return $data;

    }

    function card_payment($data)
    {
        //$this->API['BILLINGPERIOD'] = 'Month';
        //$this->API['BILLINGFREQUENCY'] = '1';
        ///$this->API['MAXFAILEDPAYMENTS'] = 3;
        //$this->API['METHOD'] = 'CreateRecurringPaymentsProfile';
        //$this->API['PROFILESTARTDATE']=date('Y-m-d').'T'.date('H:i:s').'Z'; #Billing date start, in UTC/GMT format
        //$this->API['DESC']='RacquetClubMembership'; #Profile description - same value as a billing agreement description
        //$this->API['MAXFAILEDPAYMENTS']=3; #Maximum failed payments before suspension of the profile

        $this->API['METHOD'] = 'DoDirectPayment';
        $this->API['IPADDRESS']=$_SERVER['REMOTE_ADDR'];

        /*Credit card information*/
        $this->API['ACCT']=$data['credit_card_no'];           #The credit card number
        $this->API['CREDITCARDTYPE']=$data['card_type'];     #The type of credit card
        $this->API['EXPDATE']=$data['expiry_date'];
        $this->API['CVV2']=$data['cvv'];                    #The CVV2 number
        $this->API['FIRSTNAME']=$data['firstname'];
        $this->API['LASTNAME']='';
        $this->API['EMAIL']=$data['email'];


        $this->API['STREET']=$data['street'];
        $this->API['CITY']=$data['city'];
        $this->API['STATE']=$data['state'];
        $this->API['COUNTRYCODE'] = 'US';
        $this->API['ZIP']=$data['zip'];
        $this->API['AMT'] = $data['amount'];

        $this->API['CURRENCYCODE'] =C_TYPE;
        #Expiration date of the credit card
        $this->API['INITAMT']=$data['amount'];

        /*End*/



        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL,API_SANDBOX);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->API));

        $response =    curl_exec($curl);
        curl_close($curl);

        $nvp = array();

        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
            foreach ($matches['name'] as $offset => $name) {
                $nvp[$name] = urldecode($matches['value'][$offset]);
            }
        }

        return $response;
    }

    


    function recurrence($data)
    {
        $this->API['TOKEN']=$data['TOKEN'];
        $this->API['PayerID']=$data['PayerID'];
        $this->API['PROFILESTARTDATE'] = date('Y-m-d').'T'.date('H:i:s').'Z';
        $this->API['DESC'] = $data['desc'];
        $this->API['BILLINGPERIOD'] = 'Month';
        $this->API['BILLINGFREQUENCY'] = '1';
        $this->API['AMT'] = $data['amount'];
        $this->API['CURRENCYCODE'] = 'USD';
        $this->API['COUNTRYCODE'] = 'US';
        $this->API['MAXFAILEDPAYMENTS'] = 3;
        $this->API['METHOD'] = 'CreateRecurringPaymentsProfile';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL, API_SANDBOX);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->API));

        $response =    curl_exec($curl);

        curl_close($curl);

        $nvp = array();

        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
            foreach ($matches['name'] as $offset => $name) {
                $nvp[$name] = urldecode($matches['value'][$offset]);
            }
        }

        return $nvp;
    }


    function update_recurrence($data)
    {
        $API['METHOD'] = 'UpdateRecurringPaymentsProfile';
        $API['PROFILEID'] = $data;
        $API['ACTION'] = 'Suspend';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL, API_SANDBOX);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($API));

        $response =    curl_exec($curl);

        curl_close($curl);

        $nvp = array();

        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
            foreach ($matches['name'] as $offset => $name) {
                $nvp[$name] = urldecode($matches['value'][$offset]);
            }
        }

        //print_r($nvp);
    }


    function create_recurring($data)
    {
        //$this->API['BILLINGPERIOD'] = 'Month';
        //$this->API['BILLINGFREQUENCY'] = '1';
        ///$this->API['MAXFAILEDPAYMENTS'] = 3;
        //$this->API['METHOD'] = 'CreateRecurringPaymentsProfile';
        //$this->API['PROFILESTARTDATE']=date('Y-m-d').'T'.date('H:i:s').'Z'; #Billing date start, in UTC/GMT format
        //$this->API['DESC']='RacquetClubMembership'; #Profile description - same value as a billing agreement description
        //$this->API['MAXFAILEDPAYMENTS']=3; #Maximum failed payments before suspension of the profile

        $this->API['AMT'] = $data['amount'];
        $this->API['CURRENCYCODE'] = 'USD';
        $this->API['COUNTRYCODE'] = 'US';
        $this->API['METHOD'] = 'DoDirectPayment';

        /*Credit card information*/
        $this->API['ACCT']=$data['credit_card_no'];           #The credit card number
        $this->API['CREDITCARDTYPE']=$data['card_type'];     #The type of credit card
        $this->API['IPADDRESS']=$_SERVER['REMOTE_ADDR'];
        $this->API['CVV2']=$data['cvv'];                    #The CVV2 number
        $this->API['FIRSTNAME']=$data['firstname'];
        $this->API['LASTNAME']='';
        $this->API['STREET']=$data['street'];
        $this->API['CITY']=$data['city'];
        $this->API['STATE']=$data['state'];
        $this->API['ZIP']=$data['zip'];
        $this->API['EXPDATE']=$data['expiry_date'];          #Expiration date of the credit card
        $this->API['INITAMT']=$data['amount'];

        /*End*/
        //print_r($curl);
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_URL,  API_SANDBOX);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->API));

        $response = curl_exec($curl);
        curl_close($curl);

        $nvp = array();

        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
            foreach ($matches['name'] as $offset => $name) {
                $nvp[$name] = urldecode($matches['value'][$offset]);
            }
        }

        return $response;
    }











}
// END Paypal Class

/* End of file Paypal.php */
/* Location: ./application/libraries/Paypal.php */