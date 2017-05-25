<?
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];

$privilege = $_POST["privilege"];
$money = removecomma($_POST["money"]);
$me = $_POST["me"];
$mar = $_POST["mar"];
$position = $_POST["position"];
$depart = $_POST["depart"];
$who = $_POST["who"];
$who_p = $_POST["who_p"];
$sign = $_POST["sign"];

	$numrow = $db->count_row(TB_WELFARE_DATAILS_TAB," WHERE EMP_ID = '$emp_id'",$conn); 
	if($numrow == 0){
	$result=$db->add_db(TB_WELFARE_DATAILS_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "PRIVILEGE"=>"$privilege",
											  "MONEY"=>"$money",
											  "ME"=>"$me",
											  "MAR"=>"$mar",
											  "POSITION"=>"$position",
											  "DEPART"=>"$depart",
											  "WHO"=>"$who",
											  "WHO_P"=>"$who_p",
											  "SIGN"=>"$sign",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
	
	}else{
		$result=$db->update_db(TB_WELFARE_DATAILS_TAB,array(
											 "PRIVILEGE"=>"$privilege",
											  "MONEY"=>"$money",
											  "ME"=>"$me",
											  "MAR"=>"$mar",
											  "POSITION"=>"$position",
											  "DEPART"=>"$depart",
											  "WHO"=>"$who",
											  "WHO_P"=>"$who_p",
											  "SIGN"=>"$sign" ,
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"EMP_ID='$emp_id'",$conn); 

	}

		if($result){
			//save_completed("Save_success");
			//reset_form_iframe("welfare");
		}else{
			save_completed("Save_error");
			exit();
		}

$db->closedb($conn);	
?>
<script language="javascript">
var ran=Math.random();
//window.top.$("span#waiting").html("");
window.top.location="welfare_datails.php?"+ran;
</script>