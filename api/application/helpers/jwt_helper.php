<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('jwt_encode')){

    function jwt_encode($data){
      $result = [];
      $CI =& get_instance();
      $CI->load->library('JWT');
      $CONSUMER_KEY = 'SDU';
      $CONSUMER_SECRET = 'arit';
      $CONSUMER_TTL = 86400;
      $token = $CI->jwt->encode(array(
        'consumerKey'=>$CONSUMER_KEY,
        'username'=>$data,
        'issuedAt'=>date(DATE_ISO8601, strtotime("+60 minutes")),
        'ttl'=>$CONSUMER_TTL
      ), $CONSUMER_SECRET);

      $result = $token;

        return $result;
    }
}



if (!function_exists('jwt_decode')){

    function jwt_decode($token){
      $result = [];
      $CI =& get_instance();
      $decode = $CI->jwt->decode($token,'arit');
      if($decode){
        $result['username'] = $decode->username;
        $result['issuedAt'] = $decode->issuedAt;
        $result['overtime'] = overtime($decode->issuedAt);
      }

        return $result;
    }
}


function overtime($date){
		$date = new DateTime($date) ;
		$now  = new DateTime("now");
		if($now > $date){
			return true;
		}else{
			return false;
		}
	}
