<?
@session_start();
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_SDU_MUNNY_TAB."  WHERE  M_ID = '".$_POST["ID"]."'"; 
	$stid = oci_parse($conn, $sql );
	if(oci_execute($stid)){
	echo "1";
	//@unlink("files/hon_file/".$_POST["HON_FILE"]."");
	}else{ 
	echo "0";
	}
 $db->closedb($conn);
}
 ?>