<?
@session_start();
include "update_by.php";
if($_POST["ID"]){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
    $xxx = explode("|",$_POST["ID"]);
	$sql = "DELETE  FROM  ".TB_SDU_SECTOR_TRANSFER_IMG_TAB."  WHERE IMG_ID ='".$xxx[0]."' AND ID_PAGS = '".$xxx[1]."'"; 
	$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
	echo $_POST["s_id"];
	//access_log($fpath.'_log',"",$update_by,"ลบ 'ข้อมูล การตักเตือน ลงโทษ id = ".$_POST["ID"]." ' (".$_SESSION["EMP_ID"].")");
	}else{ 
	echo $_POST["s_id"];
	}
 oci_free_statement($stid);
}

$db->closedb($conn);
 ?>
