<?php
	@session_start();
	require_once("../includes/connect.php");
	
	// ลบไฟล์แนบส่วนของประวัติข้อมูลการทำงานเป็นวิทยากร หรืออะไรก็แล้วแต่
	$filename = $_POST['filename'];
	echo "files/consult_file/" . $filename;
	$sql = "SELECT COM_FILE FROM ".TB_CONSULT_COMMIT_TAB." ";
	$sql .= "WHERE COM_FILE = '{$filename}' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$rows = oci_fetch_array($stid, OCI_BOTH);
	//echo "<p>{$rows}</p>";
	if($rows > 0) {
		$sql = "UPDATE ".TB_CONSULT_COMMIT_TAB." SET COM_FILE = '' ";
		$sql .= "WHERE COM_FILE = '{$filename}' ";
		$stid = oci_parse($conn, $sql );
		if(oci_execute($stid)) {
			@unlink("files/consult_file/" . $filename);
		}
	}

?>