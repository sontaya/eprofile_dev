<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Clear Session_user</title>
</head>

<body>
<?php
	$u = $_GET['u'];
	$delete_by_user = "";
	if($u != '') {
		$delete_by_user = "WHERE USERNAME = '{$u}' ";
	}
	require_once($fpath."includes/connect.php");
	$sql = "DELETE FROM SDU_USER_ONLINE " . $delete_by_user;
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
?>
</body>
</html>