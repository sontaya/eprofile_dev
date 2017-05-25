<?php
	@session_start();
	require_once("../includes/connect.php");
	include "update_by.php";
	// ลบไฟล์แนบส่วนของประวัติข้อมูลการทำงานเป็นวิทยากร หรืออะไรก็แล้วแต่
	$filename = $_POST['filename'];
	
	$sql = "SELECT COM_FILE FROM ".TB_COMMITTEE_TAB." ";
	$sql .= "WHERE COM_FILE = '{$filename}' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$rows = oci_fetch_array($stid, OCI_BOTH);
	echo "<p>{$rows}</p>";
	if($rows > 0) {
		$sql = "UPDATE ".TB_COMMITTEE_TAB." SET COM_FILE = '' ";
		$sql .= "WHERE COM_FILE = '{$filename}' ";
		$stid = oci_parse($conn, $sql );
		if(oci_execute($stid)) {
			@unlink("files/committee_file/" . $filename);
			//access_log($fpath.'_log',"",$update_by,"ลบ 'ประเมินการทำงานปี ".$_POST["APR_YEAR"]."' (".$_POST["EMP_ID"].")");
		}
	}
	
	
?>