<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '_404';
$route['translate_uri_dashes'] = FALSE;

//$route['(:any)/welcome'] = "welcome/getUser/$1";
//$route['seller'] = 'seller/auth';
$route['product/(:num)']="product";
$route['gallery/(:num)']="gallery";
$route['forum/(:num)']="forum";
$route['featuredseller/(:num)']="featuredseller";
$route['order/(:num)']="order";
$route['transaction/(:num)']="transaction";
$route['forum/(:num)']="forum";
$route['requirement/(:num)']="requirement";
$route['message/(:num)']="message";
$route['mail/(:num)']="mail";
$route['mail/send/(:num)']="mail/send";
$route['mail/trash/(:num)']="mail/trash";
$route['products/(:num)/(:num)']="products/index/$1";
$route['products/(:num)-(:num)']="products/index/$1/$2";
$route['businesstypes/(:num)/(:num)']="businesses/index/$1";
$route['campaign/(:num)']="campaign";
$route['campaign/userCampaignList/(:num)']="campaign/userCampaignList";
$route['markets']="markets";

$route['product']="product";
$route['products/(:num)/searchbydistance']="searchbydistance/$1";
$route['forum']="forum";
$route['gallery']="gallery";
$route['order']="order";
$route['profile']="profile";
$route['transaction']="transaction";
$route['products/(:num)']="products/index/$1";
$route['businesstypes/(:num)']="businesses/index/$1";
$route['mail']="mail";
$route['mail/sendreplyall/(:num)']="mail/sendreply/$1";
$route['auth/login']="auth/login";
$route['featuredseller']="featuredseller";

$route['sellerproduct/searchbydistance/([^/]+)/?']="sellerprofile/searchbydistance/$1";
$route['sellerprofile/([^/]+)/?']="sellerprofile/index/$1";
$route['sellerproduct/([^/]+)/?']="sellerprofile/product/$1";
$route['sellerproduct/([^/]+)/?/(:num)']="sellerprofile/product/$1";

$route['aboutus']="aboutus";
$route['contactus']="contactus";
$route['termsconditions']="termsconditions";
$route['privacypage']="privacypage";
$route['requirement']="requirement";
$route['message']="message1";
$route['crownjob']="crownjob";
$route['share']="share";
$route['adssubscription']="adssubscription";
$route['events']="events";
$route['events/(:any)/']="events";
$route['paiduser']="paiduser";
$route['trackre']="trackre";
$route['trackre/(:any)/']="trackre/index/$1";
$route['recipe']="recipe";
$route['recipe/(:num)']="recipe/index/$1";
//$route['example']="example";


$route['tax']="tax";

$route['chatctrl']="chatctrl";
$route['message1']="message1";

/****************Admin Start***************************/
$route['admin']="admin/auth";
$route['admin/seller']="admin/users";
$route['admin/seller/(:num)']="admin/users";
$route['admin']="admin/auth";
$route['admin/buyer']="admin/users/buyer";
$route['admin/buyer/(:num)']="admin/users/buyer";
$route['admin/product/(:num)']="admin/product";
$route['admin/category/(:num)']="admin/category";
$route['admin/subcategory/(:num)']="admin/subcategory";
$route['admin/social/(:num)']="admin/social";
$route['admin/recipes/(:num)']="admin/recipes";
$route['admin/recipecat/(:num)']="admin/recipecat";
$route['admin/newsletter/(:num)']="admin/newsletter";
$route['admin/category/edit/(:num)']="admin/category/edit/$1";
$route['admin/subcategory/edit/(:num)']="admin/subcategory/edit/$1";
$route['admin/tax/(:num)']="admin/tax";
$route['admin/promotion/(:num)']="admin/promotion";
$route['admin/accounting']="admin/accounting";
$route['admin/forum/(:num)']="admin/forum";
$route['admin/forum/topic/(:num)']="admin/forum/topic/$1";
$route['admin/forum/topic/(:num)/(:num)']="admin/forum/topic/$1/$2";
$route['admin/security/(:num)']="admin/security/security_valid_screens";

/****************Admin End***************************/


//$route['examples']="examples";
$route['authorize/(:any)/(:any)/?']="authorize";
$route['authorize/(:any)/(:any)/(:any)/(:any)/(:any)/?']="authorize";
$route['payment/(:any)/(:any)/?']="payment";
//$route['authorize/(:any)/(:any)/?']="authorize";
//$route['authorize/(:any)/(:any)/(:any)/(:any)/(:any)/?']="authorize";
$route['authorizepayment/(:any)/(:any)/?']="authorizepayment/$1/$2/$3/$4";
$route['authorizepayment/(:any)/(:any)/(:any)/(:any)/(:any)/?']="authorizepayment/$1/$2/$3/$4";
$route['authorizepayment/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/?']="authorizepayment/$1/$2/$3/$4";
$route['paypal/(:any)/(:any)/(:any)/']="paypal";
$route['campaign']="campaign";
$route['usereditpenal']="usereditpenal";
$route['admin/(:any)/(:any)/(:any)/']="admin";
//$route['Inserdata/(:any)/?']="Inserdata/$1";


$route['([^/]+)/?']="seller/edit/$1/$2/$3/$4";
$route['([^/]+)/?/Shope/([^/]+)/?']="seller/edit/$1/$2/$3/$4";
$route['([^/]+)/?/Shope/([^/]+)/?/([^/]+)/?']="seller/edit/$1/$2/$3/$4";

//$route['([^/]+)/?']="seller/index/$1";

$route['_404'] = '_404';

