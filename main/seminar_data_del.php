<?
@session_start();
include "update_by.php";
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_SEMINAR_TAB."  WHERE  ID = '".$_POST["ID"]."'"; 
	$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
	echo "1";
	@unlink("files/sem_data_file/".$_POST["SEM_FILE"]."");
	access_log($fpath.'_log',"",$update_by,"ลบ 'ข้อมูล การอบรมสัมนา id = ".$_POST["ID"]." ' (".$_SESSION["EMP_ID"].")");
	}else{ 
	echo "0";
	}
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>