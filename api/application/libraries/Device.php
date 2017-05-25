<?php

class Device {


public function is_mobile(){
    $result = true;

     $device = $this->get_device();
     if($device == 'web'){
       $result = false;
     }

    return $result;
  }

  public function get_device(){

  $deviceType = '';

  $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
  $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
  $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
  $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

  if( $iPod || $iPhone ){
    $deviceType = 'iphone';
  }else if($iPad){
    $deviceType = 'ipad';
  }else if($Android){
    $deviceType = 'android';
  }else if($webOS){
    $deviceType = 'webOS';
  }else{
    $deviceType = 'web';
  }

  return $deviceType;

  }


}
