<?
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$sql = "DELETE  FROM  ".TB_SCHOLAR_FILE_TAB."  WHERE  SCH_ID = '".$_POST["ID"]."'"; 
	$stid = oci_parse($conn, $sql );
	if(oci_execute($stid)){
	echo "1";
	@unlink("files/sch_data_file/".$_POST["SCH_FILE_NAME"]."");
	}else{ 
	echo "0";
	}
 $db->closedb($conn);
}
 ?>