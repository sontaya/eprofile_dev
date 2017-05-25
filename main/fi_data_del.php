<?
@session_start();
include "update_by.php";
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_SDU_FILE_MANU_TAB."  WHERE FI_ID = '".$_POST["ID"]."'"; 
	$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
	echo "1";
	//access_log($fpath.'_log',"",$update_by,"ลบ 'ข้อมูล การตักเตือน ลงโทษ id = ".$_POST["ID"]." ' (".$_SESSION["EMP_ID"].")");
	}else{ 
	echo "0";
	}
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>
