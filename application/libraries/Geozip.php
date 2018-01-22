<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//constant for convering to kilometers from miles
define('M2KM_FACTOR', 1.609344);

// constants for passing $sort to get_zips_in_range()
define('SORT_BY_DISTANCE_ASC', 1);
define('SORT_BY_DISTANCE_DESC', 2);
define('SORT_BY_ZIP_ASC', 3);
define('SORT_BY_ZIP_DESC', 4);

class Geozip
{
  var $units;
  var $decimals;
  var $last_error;
  var $CI;
  var $lng;
  var $lat;

  function __construct()
  {
    $this->CI = get_instance();

    $this->units = "miles";
    $this->decimals = 2;
  }

  

  /*
  * Set the units to describe distance
  * Accepts "miles" or "kilos"
  */
  function set_units($units = "miles")
  {
    if($units != "kilos" || $units != "miles")
    {
      $this->units = "miles";
    }
    else
    {
      $this->units = $units;
    }
  }

  function get_last_error()
  {
    return $this->last_error();
  }

  
  function _curl_request($url)
    {
                    $channel = curl_init();
                    curl_setopt( $channel, CURLOPT_URL, $url );
                    curl_setopt( $channel, CURLOPT_RETURNTRANSFER, 1 );
                    $re= curl_exec ( $channel );
                    curl_close ( $channel );
                    return $re;
    }
  
    public function get_zip_point($zip,$city='',$state='delhi')
  {
    /*$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false";
    $result_string = file_get_contents($url);
    $result = json_decode($result_string, true);
    $result1[]=$result['results'][0];
    $result2[]=$result1[0]['geometry'];
    $result3[]=$result2[0]['location'];
    return (object)$result3[0];*/
      
      $city_m=  urlencode(trim(ucwords(strtolower($city))));
      $state_m=trim($state);
      $zip_m=trim($zip);
      
      $get=array();
        $api_key=array('AIzaSyAmv-2x4kPtThm1WhIsESS_j7HaHwL0hUM','AIzaSyATnyGnShMUyLWKl9xxtSS5VGiuceEBHlc','AIzaSyBd-4JidN720CcUIwZOdQa5J2HGIbZhT2I','AIzaSyC_FxyVgQozgpKHifY0oQEDSI1oBZiiF0w','AIzaSyD67kti1ScQmtJS_2guvDylQqQqLFHyPbw','AIzaSyA_oVkSDsM98RhAnn1inWL8tGlDBZYUQRU','AIzaSyB0kPVM1FiyThJY-6Gr0sgbajYvm4EkIIA','AIzaSyBSTgsrcCYmCgM5cub9PV17fkJXr_z4x0I','AIzaSyB3gO7GuHZUcYcCkxNlpk9glT_HLR_MIQ8','AIzaSyA8jwgVB6CDzSLErhHcqnD4iMlaboUB5SA');
        
        //$url="https://maps.googleapis.com/maps/api/geocode/json?address=".strtr($city_m,' ','+').'+'.strtr($state_m,' ','+').'+'.$zip_m."+USA&key=".  $api_key[array_rand($api_key,1)];
        //$url="https://maps.googleapis.com/maps/api/geocode/json?address=".strtr($city_m,' ','+').'+'.strtr($state_m,' ','+').'+'.$zip_m."&key=".  $api_key[array_rand($api_key,1)];
        if($city_m!='' && $zip_m!=''){
            $url="http://maps.googleapis.com/maps/api/geocode/json?address=".$city_m."&components=postal_code:".$zip_m."&sensor=false";
        }else if($city_m!=''){
            $url="http://maps.googleapis.com/maps/api/geocode/json?address=".$city_m."&sensor=false";
        }else if($zip_m!=''){
            $url="http://maps.googleapis.com/maps/api/geocode/json?components=postal_code:".$zip_m."&sensor=false";
        }
        //echo $url;
        $re=$this->_curl_request($url);
        $d= json_decode($re);unset($d->status);
    //echo "aa<pre>";print_r($d);exit;
        if(!empty($d)){
			foreach ($d as $key => $value) 
			{
				//echo $value[0]->geometry->location->lat;exit;
				if(isset($value[0]->geometry->location->lat) && isset($value[0]->geometry->location->lng)){
					$center=  array("lat"=>$value[0]->geometry->location->lat,"lng"=>$value[0]->geometry->location->lng);
				}else{
					$center= array("lat"=>'',"lng"=>'');
				}
			 //echo $center;
			 /*if($value[0]->formatted_address!='')
			 {
			 $page_data['center_address']=$value[0]->formatted_address;
			 }else{$page_data['center_address']='Center';}*/
			}
		}
		else{
			$center= array("lat"=>'',"lng"=>'');
		}
        return (object)$center;
        
  }
  
  //get nearby zip of searched zip
  
  public function getNearByZipcods($zip,$distance=50,$city,$state='',$unit='miles'){
    
      $center=$this->get_zip_point($zip,$city,$state);
       if($center->lat=='' || $center->lng==''){
           return array($zip);
       }
      $radius=$distance*1.61;
      
    $headers = array(
        'Referer:http://www.freemaptools.com/find-zip-codes-inside-radius.htm',
        'User-Agent:Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.94 Safari/537.36',
        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language:en-US,en;q=0.5',
        'Connection:keep-alive',
        'Pragma:no-cache',
        'Cache-Control:no-cache',
        'Origin:http://www.freemaptools.com',
        'Content-Type:text/plain; charset=UTF-8'    
        );
    
//echo 'http://www.freemaptools.com/ajax/get-all-zip-codes-inside.php?mode=9&radius=50&lat='.$center->lat.'&lng='.$center->lng.'&rn=8523';exit;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, 'http://www.freemaptools.com/ajax/get-all-zip-codes-inside.php?mode=9&radius='.$radius.'&lat='.$center->lat.'&lng='.$center->lng.'&rn=8523');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_HEADER, 1); 
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_COOKIE, " __utma=126142042.1539287389.1412828292.1412828292.1412828292.1; __utmb=126142042.1.10.1412828292; __utmc=126142042; __utmz=126142042.1412828292.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); __utmt=1");

        $buffer = curl_exec($curl_handle);
        $header_size = curl_getinfo($curl_handle, CURLINFO_HEADER_SIZE);
        $body = substr($buffer, $header_size);

        curl_close($curl_handle);

        $body = strtr($body,array("<"=>"&lt;","&"=>"&amp;")); // for displaying html tags

        function get_string($string, $start, $end)
        {
         $found = array();
         $pos = 0;
          while( true )
            {
                $pos = strpos($string, $start, $pos);
                if ($pos === false) { // Zero is not exactly equal to false...
                return $found;
                 }
                 $pos += strlen($start);
                $len = strpos($string, $end, $pos) - $pos;
                $found[] = substr($string, $pos, $len);
            }
       }
       //print_r($zip);exit;
        if($zip!='')
        {
            $get=get_string($body,'zipcode="','"');
            $get[]=$zip;
        }else{
            $get=get_string($body,'zipcode="','"');
        }     
      //print_r($get);exit;
      return $get;
  }
  
  
  
  public function getzip($zip,$city,$state){
      //http://api.geonames.org/postalCodeSearchJSON?postalcode=9011&maxRows=10&username=demo
      $center=$this->get_zip_point($zip,$city,$state);
        $url="http://api.geonames.org/findNearbyPlaceNameJSON?lat=$center->lat&lng=$center->lng&username=nirajyadav";
        $re=$this->_curl_request($url);
        $d= json_decode($re);//unset($d->status);
   echo "<pre>";print_r($d);exit;    
  }
  
 

}
