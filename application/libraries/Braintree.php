<?php 
class Braintree {
    
    public function __construct()
    {
        require_once('braintree-php/lib/Braintree.php');
        Braintree_Configuration::environment('sandbox');
//        Braintree_Configuration::merchantId('zt83thj5s87kvjq7');
//        Braintree_Configuration::publicKey('hhbcqsn2jfdss497');
//        Braintree_Configuration::privateKey('08eb08c0f5af750000f0f28d98bf7a5c');
        Braintree_Configuration::merchantId('yqq5z77cz2cg25kw'); // ajeet 
        Braintree_Configuration::publicKey('mjpvfb2xhn7n7vks'); // ajeet
        Braintree_Configuration::privateKey('4b0f22189a8a0120047b13949d068173'); //ajeet
    }

#Function to store customer's information and credit card to BrainTree Vault
//function create_customer(){
//    
// #Set timezone if not specified in php.ini
//        //date_default_timezone_set('America/Los_Angeles');
// //require_once '_environment.php';
// $includeAddOn = false;
// 
// /* First we create a new user using the BT API */
// $result = Braintree_Customer::create(array(
//                'firstName' => mysql_real_escape_string($_POST['first_name']),
//                'lastName' => mysql_real_escape_string($_POST['last_name']),
//                'company' => mysql_real_escape_string($_POST['company']),
// 'email' => mysql_real_escape_string($_POST['user_email']),
// 'phone' => mysql_real_escape_string($_POST['user_phone']),
//                
// // we can create a credit card at the same time
//                'creditCard' => array(
//                    'cardholderName' => mysql_real_escape_string($_POST['full_name']),
//                    'number' => mysql_real_escape_string($_POST['card_number']),
//                    'expirationMonth' => mysql_real_escape_string($_POST['expiry_month']),
//                    'expirationYear' => mysql_real_escape_string($_POST['expiry_year']),
//                    'cvv' => mysql_real_escape_string($_POST['card_cvv']),
//                    'billingAddress' => array(
//                        'firstName' => mysql_real_escape_string($_POST['first_name']),
//                        'lastName' => mysql_real_escape_string($_POST['last_name'])
//                       /*Optional Information you can supply
// 'company' => mysql_real_escape_string($_POST['company']),
//                        'streetAddress' => mysql_real_escape_string($_POST['user_address']),
//                        'locality' => mysql_real_escape_string($_POST['user_city']),
//                        'region' => mysql_real_escape_string($_POST['user_state']), 
//                        //'postalCode' => mysql_real_escape_string($_POST['zip_code']),
//                        'countryCodeAlpha2' => mysql_real_escape_string($_POST['user_country'])
//       */
//                    )
//                )
//            ));
//    if ($result->success) {
//       //Do your stuff
//       //$creditCardToken = $result->customer->creditCards[0]->token;
//       //echo("Customer ID: " . $result->customer->id . "<br />");
//       //echo("Credit card ID: " . $result->customer->creditCards[0]->token . "<br />");
//    } else {
//        foreach ($result->errors->deepAll() as $error) {
//            $errorFound = $error->message . "<br />";
//        }
// echo $errorFound ;
//        exit;
//    }
//}

    
    function create_sub_merchant($data){
        $merchantAccountParams = [
            'individual' => [
              'firstName' => $data['individual']['firstName'],
              'lastName' => $data['individual']['lastName'],
              'email' => $data['individual']['email'],
              'phone' => $data['individual']['phone'],
              'dateOfBirth' => '1887-01-05',
              'ssn' => '456-45-4567',
              'address' => [
                'streetAddress' => $data['individual']['address']['streetAddress'],
                'locality' => $data['individual']['address']['locality'],
                'region' => $data['individual']['address']['region'],
                'postalCode' => $data['individual']['address']['postalCode']
              ]
            ],
            'business' => [
              'legalName' => 'Jane\'s Ladders',
              'dbaName' => 'Jane\'s Ladders',
              'taxId' => '98-7654321',
              'address' => [
                'streetAddress' => '111 Main St',
                'locality' => 'Chicago',
                'region' => 'IL',
                'postalCode' => '60622'
              ]
            ],
            'funding' => [
              'descriptor' => $data['funding']['descriptor'],
              'destination' => "bank",
              'email' => $data['funding']['email'],
              'mobilePhone' => $data['funding']['mobilePhone'],
              'accountNumber' => $data['funding']['accountNumber'], // 4111111111111111
              'routingNumber' => $data['funding']['routingNumber'] // 071101307
            ],
            'tosAccepted' => true,
            'masterMerchantAccountId' => "ucodice",
            'id' => ""
        ];
         $result = Braintree_MerchantAccount::create($merchantAccountParams);
        if($result->success){
            return array('status'=>true,'number'=>$result->merchantAccount->id);
        }else{
            $errorFound='';foreach($result->errors->deepAll() as $geterror){ $errorFound.=$geterror->message; }
            return array('status'=>false,'errorMessage'=>$errorFound);
        }
        /*
janesladders_instant_5swy4f5p
         * $result = Braintree_MerchantAccount::create(merchantAccountParams);
$result->success;
// true
$result->merchantAccount->status;
// "pending"
$result->merchantAccount->id;
// "blue_ladders_store"
$result->merchantAccount->masterMerchantAccount->id;
// "14ladders_marketplace"
$result->merchantAccount->masterMerchantAccount->status;
// "active"         */
        
    }
    
    function pay_with_hold($data){
        $result = Braintree_Transaction::sale(
            array(
              'amount' => $data['amount'],
              'merchantAccountId' => $data['merchantAccountId'],
              'creditCard' => array(
                'number' => $data['number'],
                'expirationDate' => $data['expirationDate'],
              ), 
                'options' => [
                'submitForSettlement' => true,
                'holdInEscrow' => true,
              ],
              'serviceFeeAmount' => $data['serviceFeeAmount']
            )
        );
        
        if($result->success){
            Braintree_Test_Transaction::settle($result->transaction->id); // for testing quickly settal to release
            return array('status'=>true,'token'=>$result->transaction->id);
        }else{
            $errorFound='';foreach($result->errors->deepAll() as $geterror){ $errorFound.=$geterror->message; }
            //foreach ($result->errors->deepAll() as $error) { $errorFound = $error->message . "<br />"; }
            return array('status'=>false,'errorMessage'=>$errorFound);
        }
    }
    
    
    function direct_pay_to_admin($data){
        $result = Braintree_Transaction::sale(array(
            'amount' => $data['amount'],
            'creditCard' => array(
            'number' => $data['number'],
            'expirationDate' => $data['expirationDate']
           )
        ));
        
        if($result->success){
            return array('status'=>true,'token'=>$result->transaction->id);
        }else{
           $errorFound='';foreach($result->errors->deepAll() as $geterror){ $errorFound.=$geterror->message; }
            return array('status'=>false,'errorMessage'=>$errorFound);
        }
    }
    
    
    function get_trans_status($transid){
        $transaction = Braintree_Transaction::find($transid);
        return $transaction->escrowStatus;
    }
    
    function releasepayment($transid){
        $result = Braintree_Transaction::releaseFromEscrow($transid);
        if($result->success){
            return true;
        }else{return false;}
    }



}

