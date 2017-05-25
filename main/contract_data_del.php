<?
@session_start();
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	
	$del  = $_POST['del'];
	$sql = "DELETE FROM ".TB_CONTRACT_TAB." WHERE CONTRACT_NO = '{$del}' ";
	$stid = oci_parse($conn, $sql );
	if(oci_execute($stid)){
		echo "1";
	}else{ 
		echo "0";
	}
	
	$sql = "DELETE FROM ".TB_CONTRACT_ISSUE." WHERE CONTRACT_NO = '{$del}' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
 	$db->closedb($conn);
}
 ?>