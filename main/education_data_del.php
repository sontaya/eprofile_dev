<?
@session_start();
include "update_by.php";
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_EDUCATION_TAB."  WHERE  EMP_ID = '".$_POST["EMP_ID"]."' AND EDU_ID = '".$_POST["EDU_ID"]."' "; 
	$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
	echo "1";
	
	$sql = "SELECT * FROM  ".TB_EDUCATION_FILE_TAB."  WHERE  EDU_ID = '".$_POST["EDU_ID"]."' "; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
		while (($row = oci_fetch_array($stid, OCI_BOTH))) {
			@unlink("files/edu_data_file/".$row["EDU_FILE_NAME"]."");
		}
		
		$sql = "DELETE  FROM  ".TB_EDUCATION_FILE_TAB."  WHERE  EDU_ID = '".$_POST["EDU_ID"]."' "; 
		$stid = oci_parse($conn, $sql );
		oci_execute($stid);
		
		access_log($fpath.'_log',"",$update_by,"ลบ 'ประวัติการศึกษา EDU_ID=".$_POST["EDU_ID"]."' (".$_SESSION["EMP_ID"].")");
	}else{ 
	echo "0";
	}
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>