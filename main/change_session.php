<?php
@session_start();
$emp_id = $_REQUEST["emp_id"];
$fpath = '../';
require_once($fpath."includes/connect.php");
//$res = $db->select_query("SELECT * FROM  ".TB_USER_TAB." WHERE username = '{$user_name}' and password = '{$pass_word}' "); 
$sql = "SELECT * FROM  ".TB_BIODATA_TAB." WHERE EMP_ID = '{$emp_id}'";

		$row = $db->fetch($sql,$conn);
		$_SESSION["PERSON_ID"] =  $row["PERSON_ID"];
		$_SESSION["EMP_ID"] =  $emp_id;
		$_SESSION["FNAME_TH"] = $row["BIO_FNAME_TH"];
		$_SESSION["LNAME_TH"] = $row["BIO_LNAME_TH"];
		$_SESSION["FNAME_EN"] = $row["BIO_FNAME_EN"];
		$_SESSION["LNAME_EN"] = $row["BIO_LNAME_EN"];
		$_SESSION["PIC_FILE"] = $row["BIO_PIC_FILE"];
		
		
$sql = "SELECT * FROM  ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$_SESSION["EMP_ID"]."' ";
		$row = $db->fetch($sql,$conn);
		switch ($row["CWK_STATUS"]){
			case "01": $txt = "ปฏิบัติการ"; break;
			case "02": $txt = "ลาออก"; break;
			case "03": $txt = "ลาศึกษาต่อ"; break;
			case "04": $txt = "เกษียนอายุ"; break;
			case "05": $txt = "ปฏิบัติการตามวาระ"; break;
			case "07": $txt = "เสียชีวิต"; break;
			default: $txt = "ปฏิบัติการ";
		}
		$_SESSION["STATUS"] = $txt;
		
		
		echo "1";

$db->closedb($conn);
?>