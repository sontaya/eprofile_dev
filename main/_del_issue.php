<?php
@session_start();
if($_SESSION['EMP_ID'] == '') {
	@exit();
}
	//print_r($_REQUEST);
	$fpath = '../';
	require_once($fpath."includes/connect.php");	
	
	$id = $_REQUEST['id'];
	
	$sql = "DELETE FROM ".TB_CONTRACT_ISSUE." ";
	$sql .= "WHERE ISSUE_ID = '$id' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$db->closedb($conn);
?>