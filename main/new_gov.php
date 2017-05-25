<?
@session_start();
if($_POST){
 	$fpath = '../';
	require_once($fpath."includes/connect.php");
	$date = date2_formatdb($_POST["date"]);
	include "update_by.php";
	$sql = "UPDATE   ".TB_CURRENT_WORK_TAB." SET CWK_RETIRE = '2' , CWK_RETIRE_DATE = TO_DATE('".$date."','YYYY-MM-DD')  , LAST_UPDATE = TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS') , UPDATE_BY = '$update_user'  WHERE  EMP_ID = '".$_POST["EMP_ID"]."' "; 
	$stid = oci_parse($conn, $sql );
	if(oci_execute($stid)){
		echo "1";
	}else{ 
		echo "0";
	}
	 $db->closedb();
}
?>