<?
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_SCHOLAR_CONTRACT_EX_TAB."  WHERE  EMP_ID = '".$_POST["EMP_ID"]."' AND ID = '".$_POST["ID"]."'"; 
	$stid = oci_parse($conn, $sql );
	if(oci_execute($stid)){
	echo "1";
	}else{ 
	echo "0";
	}
 oci_free_statement($stid);
 $db->closedb($conn);
}
 ?>