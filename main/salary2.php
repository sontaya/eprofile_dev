<?php
	@session_start();
	$emp_id = $_POST['emp_id'];
	
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
	$bg1_unit = $_POST['bg1_unit'];
	$bg2_unit = $_POST['bg2_unit'];
	$bg3_unit = $_POST['bg3_unit'];
	$af = $_POST['ud'];
	$ud = date("Y-m-d");
	$af = dbDateFormat($af);
	
	
	for($i=0;$i<count($emp_id);$i++){
		
	$emp_id_r = $emp_id[$i];
	$sql = "SELECT * FROM ".TB_REF_SALARY_STEP." WHERE EMP_ID = '$emp_id_r' ORDER BY REF DESC";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$rc = oci_fetch_array($stid, OCI_BOTH);
	
	$db_bg1 = $rc['SALARY1'];
	$db_bg2 = $rc['SALARY2'];
	$db_bg3 = $rc['SALARY3'];

	if($bg1 != '') {
		if($bg1_unit == 1) { // %
			$db_bg1 += ($db_bg1 * ($bg1/100));
            $db_bg1 = (ceil($db_bg1/10)*10);
		}
		elseif($bg1_unit == 2) { // 
			$db_bg1 += $bg1;
		}
	}
	
	if($bg2 != '') {
		if($bg2_unit == 1) { // %
			$db_bg2 += ($db_bg2 * ($bg2/100));
		}
		elseif($bg2_unit == 2) { //
			$db_bg2 += $bg2;
		}
	}
	
	if($bg3 != '') {
		if($bg3_unit == 1) { // %
			$db_bg3 += ($db_bg3 * ($bg3/100));
            
		}
		elseif($bg3_unit == 2) { // 
			$db_bg3 += $bg3;
		}
	}
			
	$id = auto_increment("REF",TB_REF_SALARY_STEP);
	$db->add_db(TB_REF_SALARY_STEP,array(
											 "REF"=>"$id",
											 "EMP_ID"=>"$emp_id_r",
											  "SOURCE1"=>"$from1",
											  "SOURCE2"=>"$from2",
											  "SOURCE3"=>"$from3",
											  "SALARY1"=>"$db_bg1",
											  "SALARY2"=>"$db_bg2",
											  "SALARY3"=>"$db_bg3",
											  "AFFECTIVE_DATE"=>"TO_DATE('$af','YYYY-MM-DD')",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 

	}
	
	function dbDateFormat($dateFormat) {
		// 02/10/2553
		$d = explode("/",$dateFormat);
		$dbYear = $d[2] - 543;
		$DBformat = $dbYear . "-" . $d[1] . "-" . $d[0];
		return $DBformat;
	}
	$db->closedb($conn);
?>