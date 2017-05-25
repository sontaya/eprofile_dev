<?
//session_start();
ini_set('display_errors',0);
function user_age($birthday){

	$birthday_ex=explode("/",$birthday);
	
	$year_edit=$birthday_ex[2]-543;
	$year=date("Y")-$year_edit;
	
	$month=date("n");
	$birthday_ex[1]=number_format($birthday_ex[1]);
	$month=12-($birthday_ex[1]-$month);
	
	if(date("n")<$birthday_ex[1]){
		$year=$year-1;
	}
	print $year." ปี ".$month." เดือน";
	
}

function user_name_thai($txtuser){
	//print $txtuser;
	$ldapconfig['host'] = 'sdu-ldap.dusit.ac.th' ;//'sdu-ldap1.dusit.ac.th';
	$ldapconfig['port'] = 389;
	$ldapconfig['basedn'] = 'dc=dusit,dc=ac,dc=th';
	$ldapconfig['authrealm'] = 'SDU Authentication LDAP';
	
	//global $ldapconfig;
	//global $ldap_auth_pwd;
	//global $ldap_auth_user;
	
	$ldap_auth_user = $txtuser;
	$ldap_auth_pwd = $txtpass;
	
	$ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']);	
	if(!$ds){
		print "Connect not connect to ".$ldapconfig['host'];
	}
	
	$r =  ldap_search($ds, $ldapconfig['basedn'], 'uid=' . $ldap_auth_user);
	if($r){
		$result = ldap_get_entries($ds, $r);
		print $result[0]["displayname"][0];
	}
	else{
		print "Connect not connect to ".$ldapconfig['host'];
	}
	
}

function set_icon_viwe_edit(){
	$img_viwe="";
	$img_del="";
	if($_SESSION['USER_TYPE'] == 'user') {
		print "<img src=''>";
	}
	else{
		print "<img src='../images/b_edit.png' height='15' border='0'>";
	}
	
}

//user_age("08/10/2527");

$fc=$_POST["fc"];

switch($fc){
	case "user_age" : user_age($_POST["birthday"]); break;
	case "user_name_thai" : user_name_thai($_POST["username"]); break;
	case "set_icon_viwe_edit" : set_icon_viwe_edit(); break;
}

?>