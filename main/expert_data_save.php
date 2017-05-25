<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
$exp_expert1 = pea_substr(trim($_POST["exp_expert1"]),250);
$exp_expert2 = pea_substr(trim($_POST["exp_expert2"]),250);
$exp_expert3 = pea_substr(trim($_POST["exp_expert3"]),250);
$exp_expert4 = pea_substr(trim($_POST["exp_expert4"]),250);
$exp_expert5 = pea_substr(trim($_POST["exp_expert5"]),250);
$exp_expert6 = pea_substr(trim($_POST["exp_expert6"]),250);
$exp_expert7 = pea_substr(trim($_POST["exp_expert7"]),250);
$exp_expert8 = pea_substr(trim($_POST["exp_expert8"]),250);
$exp_expert9 = pea_substr(trim($_POST["exp_expert9"]),250);
$exp_expert10 = pea_substr(trim($_POST["exp_expert10"]),250);
$exp_expert_oth = pea_substr(trim($_POST["exp_expert_oth"]),250);

	$numrow = $db->count_row(TB_EXPERT_TAB," WHERE EMP_ID = '$emp_id' ",$conn); 

if($numrow == 0){
		$result=$db->add_db(TB_EXPERT_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "EXP_EXPERT1"=>"$exp_expert1",
											  "EXP_EXPERT2"=>"$exp_expert2",
											  "EXP_EXPERT3"=>"$exp_expert3",
											  "EXP_EXPERT4"=>"$exp_expert4",
											  "EXP_EXPERT5"=>"$exp_expert5",
											  "EXP_EXPERT6"=>"$exp_expert6",
											  "EXP_EXPERT7"=>"$exp_expert7",
											  "EXP_EXPERT8"=>"$exp_expert8",
											  "EXP_EXPERT9"=>"$exp_expert9",
											  "EXP_EXPERT10"=>"$exp_expert10",
											  "EXP_EXPERT_OTH"=>"$exp_expert_oth",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_EXPERT_TAB,array(
											  "EXP_EXPERT1"=>"$exp_expert1",
											  "EXP_EXPERT2"=>"$exp_expert2",
											  "EXP_EXPERT3"=>"$exp_expert3",
											  "EXP_EXPERT4"=>"$exp_expert4",
											  "EXP_EXPERT5"=>"$exp_expert5",
											  "EXP_EXPERT6"=>"$exp_expert6",
											  "EXP_EXPERT7"=>"$exp_expert7",
											  "EXP_EXPERT8"=>"$exp_expert8",
											  "EXP_EXPERT9"=>"$exp_expert9",
											  "EXP_EXPERT10"=>"$exp_expert10",
											  "EXP_EXPERT_OTH"=>"$exp_expert_oth",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user" 
					  ),"EMP_ID='$emp_id'",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("expert");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูลความเชี่ยวชาญ' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูลความเชี่ยวชาญ' ($emp_id)");
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
window.top.load_page("expert.php?"+ran);
</script>
<?
}
?>