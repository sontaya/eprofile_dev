<?php
	@session_start();
	require_once("../includes/connect.php");
	// ลบไฟล์แนบส่วนของประวัติข้อมูลการทำงานเป็นวิทยากร หรืออะไรก็แล้วแต่
	$filename = $_POST['filename'];
	
	$sql = "SELECT CON_FILE FROM ".TB_CONSTRUCTOR_TAB." ";
	$sql .= "WHERE CON_FILE = '{$filename}' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$rows = oci_fetch_array($stid, OCI_BOTH);
	//echo "<p>{$rows}</p>";
	if($rows > 0) {
		$sql = "UPDATE ".TB_CONSTRUCTOR_TAB." SET CON_FILE = '' ";
		$sql .= "WHERE CON_FILE = '{$filename}' ";
		$stid = oci_parse($conn, $sql );
		if(oci_execute($stid)) {
			@unlink("files/constructor_file/" . $filename);
		}
	}
	
?>