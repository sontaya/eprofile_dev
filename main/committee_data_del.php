<?
@session_start();
include "update_by.php";
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");

	//echo "<p>". $row['CON_FILE']."</p>";
	
	$sql = "DELETE  FROM  ".TB_COMMITTEE_TAB."  WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' AND COM_ID = '".$_POST["ID"]."'"; 
	$stid = oci_parse($conn, $sql );
	if(oci_execute($stid)){
	echo "1";
	@unlink("files/committee_file/" . $_POST["FILE"]);
	access_log($fpath.'_log',"",$update_by,"ลบ 'ข้อมูลการเป็นกรรมการภายนอก ".$_POST["ID"]."' (".$_SESSION["EMP_ID"].")");
	}else{ 
	echo "0";
	}
 $db->closedb($conn);
}
 ?>