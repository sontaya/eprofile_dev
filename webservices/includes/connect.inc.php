<?php
	require_once("config.inc.php");
	$conn = oci_connect(DB_USERNAME,DB_PASSWORD,DB_HOST,DB_CHARSET);
	//echo $conn;
?>