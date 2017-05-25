<?
@session_start();
include "update_by.php";

if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_CHILDREN_TAB."  WHERE  EMP_ID = '".$_POST["EMP_ID"]."' AND CHL_CODE_ID = '".$_POST["CHL_CODE_ID"]."'"; 
	$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
	echo "1";
	@unlink("files/chl_data_file/".$_POST["CHL_CEN_FILE"]."");
	access_log($fpath.'_log',"",$update_by,"ลบ 'ข้อมูลบุตร ".$_POST["CHL_CODE_ID"]."' (".$_POST["EMP_ID"].")");
	}else{ 
	echo "0";
	}
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>