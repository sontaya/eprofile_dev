<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ดั๊มฐานข้อมูลเข้า TB_USER_TAB</title>
</head>

<body>
<?php
	$conn = oci_connect("SDPERSON","PERSON","10.202.1.13/RSDUE2M","AL32UTF8");
	//echo $conn;
	$sql = "SELECT BIO.EMP_ID, BIO.BIO_EMAIL1, WORKS.CWK_MUA_MPOS FROM SDU_BIODATA_TAB BIO, SDU_CURRENT_WORK_TAB WORKS ";
	$sql .= "WHERE BIO.EMP_ID = WORKS.EMP_ID ";
	$sql .= "AND BIO.BIO_EMAIL1 LIKE '%@dusit.ac.th' ";
	$sql .= "ORDER BY BIO.EMP_ID DESC ";
	$stid = oci_parse($conn,$sql);
	oci_execute($stid);
	$count_rec = 3038;
	while($row = oci_fetch_array($stid, OCI_BOTH)) {
		//echo $count_rec ." | ".$row['EMP_ID'] . " | " . $row['BIO_EMAIL2'] ." | " . $row['CWK_MUA_MPOS'];
		//echo "<br />\n";
		
		$empid = $row['EMP_ID'];
		$umail = explode('@',$row['BIO_EMAIL1']);
		$mail_u = $umail[0];
		$position_m = "";
		if($row['CWK_MUA_MPOS'] == '00') {
			$position_m = 'user';
		}
		else {
			$position_m = 'chief';
		}
		
		$sql2 = "INSERT INTO SDU_USER_TAB (ID, EMP_ID, USERNAME, USER_TYPE ) ";
		$sql2 .= "VALUES('$count_rec', '$empid', '$mail_u','$position_m'); \n";
		echo $sql2;
		//$stid2 = oci_parse($conn, $sql2);
		//oci_execute($stid2);
		
		
		$count_rec++;
	}
?>
</body>
</html>