<?php
define("DB_USERNAME","SDPERSON");//oracle username
define("DB_PASSWORD","PERSON");// oracle password
define("DB_HOST","oraprd.dusit.ac.th/RSDUE2M"); //ordacle host and global name
define("DB_CHARSET","AL32UTF8");//oracle character set AL32UTF8(UTF-8)
$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);

 $sql = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
/*	
 echo $conn;
	$sql = "SELECT COUNT(*) CODE FROM POSITION ORDER BY CODE";
	$stmt = oci_parse($conn,$sql);
	if(!oci_execute($stmt)) {
		$err = oci_error($stmt);
		trigger_error('Query failed: ' . $err['message'] , E_USER_ERROR);
	}
	while($emp = oci_fetch_array($stmt, OCI_ASSOC)) {
		print $emp['CODE'];
		print " " . $emp['POSITION'];
		print "<br />\n";
	}
*/
?>