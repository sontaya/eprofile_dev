<?
@session_start();
include "update_by.php";
function fam_($what){
	switch ($what){
	case "1": $t = "บิดา";	break;
	case "2": $t = "มารดา"; break;
	case "3": $t = "คู่สมรส";	break;
	}
	return $t;
}
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_FAMILY_TAB."  WHERE  EMP_ID = '".$_POST["EMP_ID"]."' AND FAM_RELATION = '".$_POST["FAM_RELATION"]."'"; 
	$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
	echo "1";
	@unlink("files/fam_data_file/".$_POST["FAM_CEN_FILE"]."");
	access_log($fpath.'_log',"",$update_by,"ลบ 'ข้อมูล ".fam_($_POST["FAM_RELATION"])." ' (".$_SESSION["EMP_ID"].")");
	}else{ 
	echo "0";
	}
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>