<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_mobile')){

    function is_mobile(){
        $result = false;
        $CI =& get_instance();
        $CI->load->library('device');
        $result = $CI->device->is_mobile();

        return $result;
    }
}
