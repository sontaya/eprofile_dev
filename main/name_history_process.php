<?php
	session_start();
	require_once("../includes/connect.php");
	echo "</pre>";
	print_r($_SESSION);
	print_r($_REQUEST);
	echo "</pre>";
	
	$mode = $_GET['mode']; // del - add - edit
	
	$emp_id = $_POST['emp_id'];
	$name = $_POST['name'];
	$lname = $_POST['lname'];
	$old_n = $_POST['old_n'];
	$old_l = $_POST['old_l'];
	$emp = $_SESSION['EMP_ID'];
	
	$admin_user = $_SESSION['USER_NAME'];
	$myTime = date("Y/m/d H:i:s");
	
	switch($mode) {
		case 'add':
		$sql = "INSERT INTO " .TB_NAME_HISTORY. " (EMP_ID, NAME, LAST_NAME, LAST_UPDATE,UPDATE_BY) " ;
		$sql .= "VALUES ('{$emp_id}','{$name}','{$lname}','','{$admin_user}') ";
		$stid = oci_parse($conn, $sql );
		oci_execute($stid);
		break;
		
		case 'edit':
		$sql = "UPDATE ".TB_NAME_HISTORY." SET NAME = '{$name}', LAST_NAME = '{$lname}'  WHERE  EMP_ID = '{$emp}' AND NAME = '{$old_n}' AND LAST_NAME = '{$old_l}' ";
		$stid = oci_parse($conn, $sql );
		oci_execute($stid);
		
		break;
		case 'del':
		$sql = "DELETE  FROM  ".TB_NAME_HISTORY."  WHERE  EMP_ID = '{$emp}' AND NAME = '{$name}' AND LAST_NAME = '{$lname}' ";
		$stid = oci_parse($conn, $sql );
		oci_execute($stid);
		break;
	}
	
	
?>