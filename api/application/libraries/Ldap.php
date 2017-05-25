<?php

class Ldap{

  public function check($data){
    $key = "022445000";

    $check = $this->ldap_authenticate($data["u_user"], $data["u_pass"]);
    if ($check) {
        $txt_user = $this->encrypt($data['u_user'], $key);
        $result['u_user'] = $check["displayname"]["0"];
        $result['u_id'] = $check["hrcode"]["0"];
        $result['facultycode'] = $check["facultycode"]["0"];
        $result['employeetype'] = $check["employeetype"]["0"];
        $result['status'] = 'success';
    } else {
      $result['status'] = 'fail';
    }

    return $result;
  }


  private function ldap_authenticate($txtuser, $txtpass) {
    $ldapconfig['host'] = 'sdu-ldap.dusit.ac.th';
    $ldapconfig['port'] = 389;
    $ldapconfig['basedn'] = 'dc=dusit,dc=ac,dc=th';
    $ldapconfig['authrealm'] = 'SDU Authentication LDAP';
    $result = [];
    if ($txtuser != "" && $txtuser != "") {
          $ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to $ldaphost");
          $r = ldap_search($ds, $ldapconfig['basedn'], 'uid=' . $txtuser);
          if ($r) {
              $result = @ldap_get_entries($ds, $r);
              if ($result[0]) {
                  if (@ldap_bind($ds, $result[0]['dn'], $txtpass)) {
                      return $result[0];
                  }
              }
          }
      }
      header('WWW-Authenticate: Basic realm="' . $ldapconfig['authrealm'] . '"');
      header('HTTP/1.0 401 Unauthorized');
      return null;
  }


  private function encrypt($string, $key) {
      $result = '';
      for ($i = 0; $i < strlen($string); $i++) {
          $char = substr($string, $i, 1);
          $keychar = substr($key, ($i % strlen($key)) - 1, 1);
          $char = chr(ord($char) + ord($keychar));
          $result.=$char;
      }

      return base64_encode($result);
  }




}
