<?
if($_POST){
	sleep(3);
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_SCH_PAY_BACK_TAB."  WHERE  EMP_ID = '".$_POST["EMP_ID"]."' AND PAY_REF = '".$_POST["PAY_REF"]."'"; 
	$stid = oci_parse($conn, $sql );
	if(oci_execute($stid)){
	echo "1";
	}else{ 
	echo "0";
	}
 $db->closedb($conn);
}
 ?>