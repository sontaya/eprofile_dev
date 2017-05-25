<?

$ldapconfig['host'] = 'sdu-ldap.dusit.ac.th'; //'sdu-ldap1.dusit.ac.th';
$ldapconfig['port'] = 389;
$ldapconfig['basedn'] = 'dc=dusit,dc=ac,dc=th';
$ldapconfig['authrealm'] = 'SDU Authentication LDAP';

//echo "hello";
echo ldap_authenticate('ubonrat_cha');

function ldap_authenticate($txtuser) {
  global $ldapconfig;
  global $ldap_auth_pwd;
  global $ldap_auth_user;

  $ldap_auth_user = $txtuser;
  $ldap_auth_pwd = $txtpass;

  if ($ldap_auth_user != "") {
    $ds = @ldap_connect($ldapconfig['host'], $ldapconfig['port']);
    $r = @ldap_search($ds, $ldapconfig['basedn'], 'uid=' . $ldap_auth_user);

    if ($r) {
      $result = @ldap_get_entries($ds, $r);
      
      if ($result[0]) {
        print_r($result);
        if (@ldap_bind($ds, $result[0]['dn'], $ldap_auth_pwd)) {
          return $result[0];
        }
      }
    }
  }
  //header('WWW-Authenticate: Basic realm="' . $ldapconfig['authrealm'] . '"');
  //header('HTTP/1.0 401 Unauthorized');
  //return "null";
}

function ldap_getcitizenid($txt_user) {
  global $ldapconfig;
  global $ldap_auth_pwd;
  global $ldap_auth_user;

    
  $ds = @ldap_connect($ldapconfig['host'], $ldapconfig['port']);
  $r = @ldap_search($ds, $ldapconfig['basedn'], 'uid=' . $txt_user);
  

  $list = ldap_get_entries($ds, $r);
  print_r($list)."<br>";
  return $list[0]['idcardno'][0];
}

?>
