<?
@session_start();
include "update_by.php";
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_SCHOLAR_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND SCH_ID = '".$_POST["ID"]."'"; 
	$stid = oci_parse($conn, $sql );
    oci_execute($stid);
    echo "success";
	
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>