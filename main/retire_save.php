<?
@session_start();
$emp_id = $_REQUEST["emp_id"];
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$date = date("Y-m-d");
$result=$db->update_db(TB_CURRENT_WORK_TAB,array(
											  "CWK_STATUS"=>"04",
											  "CWK_RETIRE_DATE"=>"TO_DATE('$date','YYYY-MM-DD')",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											 ),"EMP_ID='$emp_id' ",$conn);
		echo "1";
$db->closedb($conn);
?>