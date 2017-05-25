<?php
	@session_start();
	$emp_id = $_SESSION['EMP_ID'];
	
	include_once("../includes/connect.php");
	include "update_by.php";
	$from1 = $_POST['from1'];
	if($from1 == "") $from1 = "00";
	$from2 = $_POST['from2'];
	if($from2 == "") $from2 = "00";
	$from3 = $_POST['from3'];
	if($from3 == "") $from3 = "00";
	$bg1 = removecomma($_POST['bg1']);
	if($bg1 == "") $bg1 = "0";
	$bg2 = removecomma($_POST['bg2']);
	if($bg2 == "") $bg2 = "0";
	$bg3 = removecomma($_POST['bg3']);
	if($bg3 == "") $bg3 = "0";
	$ref = $_POST['ref'];
	$u = dbDateFormat($_POST['u']);
	
	$db->update_db(TB_REF_SALARY_STEP,array(
											  "SOURCE1"=>"$from1",
											  "SOURCE2"=>"$from2",
											  "SOURCE3"=>"$from3",
											  "SALARY1"=>"$bg1",
											  "SALARY2"=>"$bg2",
											  "SALARY3"=>"$bg3",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"REF='$ref' ",$conn); 
	
	
	function dbDateFormat($dateFormat) {
		// 02/10/2553
		$d = explode("/",$dateFormat);
		$dbYear = $d[2] - 543;
		$DBformat = $dbYear . "-" . $d[1] . "-" . $d[0];
		return $DBformat;
	}
	$db->closedb($conn);
?>