<?php
require_once("config.inc.php");
//require_once("class.oracle.inc.php");
@date_default_timezone_set("Asia/Bangkok");
//$db = New DB();
//$db->connectdb(DB_USERNAME,DB_PASSWORD);
$conn = oci_connect(DB_USERNAME, DB_PASSWORD,DB_HOST,DB_CHARSET);
require_once("func.inc.php");
require_once("utf8fnc.php");
$sql = "ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD'";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
?>