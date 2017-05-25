<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_POST["emp_id"];
$numrow = $db->count_row(TB_BIODATA_TAB," WHERE EMP_ID = '$emp_id' ",$conn); 
if($numrow == 0){

$result=$db->add_db(TB_BIODATA_TAB,array(
									  "EMP_ID"=>"$emp_id",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
									  ),$conn);
	if($result){
	
		$result=$db->add_db(TB_CURRENT_WORK_TAB,array(
									  		  "EMP_ID"=>"$emp_id",
											  "CWK_MUA_EMP_TYPE"=>"0",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
									  ),$conn);
									  
		echo "1";
	}else{
		echo "0";	
	}
}else{
	echo "2";
}
$db->closedb($conn);	
}
?>