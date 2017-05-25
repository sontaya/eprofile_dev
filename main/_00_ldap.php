<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LDAP TEST</title>
</head>

<body>
<?php
require_once("../includes/ldap_authen.inc.php");
$u = "chulintipa_nop";
$p = "06052520";

$result = ldap_authenticate($u,$p);

//echo $result;
print "<pre>";
print_r($result);
print "</pre>";

?>
</body>
</html>