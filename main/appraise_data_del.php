<?
@session_start();
include "update_by.php";
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_APPRAISE_TAB."  WHERE  EMP_ID = '".$_POST["EMP_ID"]."' AND APR_YEAR = '".$_POST["APR_YEAR"]."'"; 
	$stid = oci_parse($conn, $sql );
if(oci_execute($stid)){
		echo "1";
		access_log($fpath.'_log',"",$update_by,"ลบ 'ประเมินการทำงานปี ".$_POST["APR_YEAR"]."' (".$_POST["EMP_ID"].")");
	}else{ 
		echo "0";
	}
	 oci_free_statement($stid);
	 $db->closedb($conn);
}
 ?>