<?php
	session_start();
	$emp_id = $_SESSION['EMP_ID'];
	
	include_once("../includes/connect.php");
	
	$ref = $_POST['ref'];
	
	$sql = "DELETE FROM ".TB_REF_SALARY_STEP." ";
	$sql .= "WHERE REF = '$ref' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$db->closedb($conn);
?>