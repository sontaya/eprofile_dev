<?php
	@session_start();
	$fpath = '../';
	require_once($fpath."includes/connect.php");
	include "update_by.php";
	$emp_id = $_SESSION['EMP_ID'];
	$contract_no = $_POST['contract_no'];
	$issue = $_POST['issue'];
	$issue_publish = $_POST['issue_publish'];
	$issue_type = $_POST['issue_type'];
	$issue_id = $_POST['issue_id'];
	
	$numrow = $db->count_row(TB_CONTRACT_ISSUE," WHERE EMP_ID = '$emp_id' AND CONTRACT_NO = '$contract_no' AND ISSUE = '$issue' ",$conn); 
	if($issue_id == '') {
		$issue_id = auto_increment("ISSUE_ID",TB_CONTRACT_ISSUE);
		$result = $db->add_db(TB_CONTRACT_ISSUE,array(
			"ISSUE_ID"=>"$issue_id",
			"EMP_ID"=>"$emp_id",
			"CONTRACT_NO"=>"$contract_no",
			"ISSUE_TYPE"=>"$issue_type",
			"ISSUE"=>"$issue",
			"ISSUE_PUBLISH"=>"$issue_publish",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
			),$conn);
	}
	else { // UPDATE CONTRACT ISSUE
	
	$result=$db->update_db(TB_CONTRACT_ISSUE,array(
			"ISSUE_TYPE"=>"$issue_type",
			"ISSUE"=>"$issue",
			"ISSUE_PUBLISH"=>"$issue_publish",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
			),"EMP_ID='$emp_id' AND ISSUE_ID = '$issue_id'",$conn); 
		}
		
	$db->closedb($conn);

	
?>