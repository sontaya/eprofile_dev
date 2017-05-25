<?
@session_start();
include "update_by.php";
function pos_name($what){
	switch ($what){
		case "1": $t = "ผู้ช่วยศาสตราจารย์/ผู้ช่วยศาสตราจารย์พิเศษ"; break;
		case "2": $t = "รองศาสตราจารย์/รองศาสตราจารย์พิเศษ"; break;
		case "3": $t = "ศาสตราจารย์/ศาสตราจารย์พิเศษ"; break;
		case "4": $t = "ศาสตราจารย์ 11"; break;
	}
	return $t;
}
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$sql = "DELETE  FROM  ".TB_VCHARKARN_POSITION_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND VP_TYPE = '".$_POST["POSITION_TYPE"]."'"; 
$stid = oci_parse($conn, $sql );

if(oci_execute($stid)){
	$sql = "DELETE  FROM  ".TB_VCHARKARN_ACH1_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '".$_POST["POSITION_TYPE"]."'"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);

	$sql = "DELETE  FROM  ".TB_VCHARKARN_ACH2_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '".$_POST["POSITION_TYPE"]."'"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);

	$sql = "DELETE  FROM  ".TB_VCHARKARN_ACH3_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '".$_POST["POSITION_TYPE"]."'"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	
	$sql = "DELETE  FROM  ".TB_VCHARKARN_ACH4_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '".$_POST["POSITION_TYPE"]."'"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	
	$sql = "DELETE  FROM  ".TB_VCHARKARN_ACH5_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '".$_POST["POSITION_TYPE"]."'"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	
	$sql = "DELETE  FROM  ".TB_VCHARKARN_ACH6_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND POSITION_TYPE = '".$_POST["POSITION_TYPE"]."'"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	
	echo "1";
	access_log($fpath.'_log',"",$update_by,"ลบ 'ตำแหน่ง ".pos_name($_POST["POSITION_TYPE"])."' (".$_SESSION["EMP_ID"].")");
	}else{ 
	echo "0";
	}
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>