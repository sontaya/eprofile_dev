<?
@session_start();
include "update_by.php";
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_EDUCATION_FILE_TAB."  WHERE  ID = '".$_POST["ID"]."'"; 
	$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
	echo "1";
	@unlink("files/edu_data_file/".$_POST["EDU_FILE_NAME"]."");
	access_log($fpath.'_log',"",$update_by,"ลบ 'เอกสารการศึกษา ID=".$_POST["ID"]." ' (".$_SESSION["EMP_ID"].")");
	}else{ 
	echo "0";
	}
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>