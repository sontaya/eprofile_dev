<?
@session_start();

$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];

$sso = $_POST["sso"];
$hospital = $_POST["hospital"];
$cpk = $_POST["cpk"];
$cps = $_POST["cps"];
$gpf = $_POST["gpf"];
$gpef = $_POST["gpef"];
$personnel_fund = $_POST["personnel_fund"];
$provident_fund = $_POST["provident_fund"];
$cooperatives = $_POST["cooperatives"];
$welfare = $_POST["welfare"];
$childloan = $_POST["childloan"];
$special_reward = $_POST["special_reward"];
$scholar = $_POST["scholar"];
$debt = $_POST["debt"];

	$numrow = $db->count_row(TB_WELFARE_TAB," WHERE EMP_ID = '$emp_id'",$conn); 
	if($numrow == 0){
	$result=$db->add_db(TB_WELFARE_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "GPF"=>"$gpf",
											  "GPEF"=>"$gpef",
											  "PERSONNEL_FUND"=>"$personnel_fund",
											  "PROVIDENT_FUND"=>"$provident_fund",
											  "COOPERATIVES"=>"$cooperatives",
											  "WELFARE"=>"$welfare",
											  "CHILDLOAN"=>"$childloan",
											  "SPECIAL_REWARD"=>"$special_reward",
											  "SCHOLAR"=>"$scholar",
											  "DEBT"=>"$debt",
											  "SSO"=>"$sso",
											  "HOSPITAL"=>"$hospital",
											  "CPK"=>"$cpk",
											  "CPS"=>"$cps",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
	
	}else{
		$result=$db->update_db(TB_WELFARE_TAB,array(
											 "GPF"=>"$gpf",
											  "GPEF"=>"$gpef",
											  "PERSONNEL_FUND"=>"$personnel_fund",
											  "PROVIDENT_FUND"=>"$provident_fund",
											  "COOPERATIVES"=>"$cooperatives",
											  "WELFARE"=>"$welfare",
											  "CHILDLOAN"=>"$childloan",
											  "SPECIAL_REWARD"=>"$special_reward",
											  "SCHOLAR"=>"$scholar",
											  "DEBT"=>"$debt",
											  "SSO"=>"$sso",
											  "HOSPITAL"=>"$hospital",
											  "CPK"=>"$cpk",
											  "CPS"=>"$cps" ,
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user" 
					  ),"EMP_ID='$emp_id'",$conn); 

	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("welfare");
		}else{
			save_completed("Save_error");
?>
<script language="javascript">
window.top.$("span#waiting").html("");
</script>
<?
exit();
		}

$db->closedb($conn);	
?>
<script language="javascript">
var ran=Math.random();
window.top.$("span#waiting").html("");
window.top.load_page("welfare.php?"+ran);
</script>