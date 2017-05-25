<?php
	function getEmpID($perId) {
		global $conn;
		$sql = "SELECT EMP_ID FROM ". TB_BIODATA_TAB ." ";
		$sql .= "WHERE PERSON_ID = '$perId' ";
		$stid = oci_parse($conn, $sql);
		oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH);
		return $row['EMP_ID'];
	}
?>