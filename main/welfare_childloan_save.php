<?
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];

$child_name1 = $_POST["child_name1"];
$child_birth1 = $_POST["child_birth1"];
$child_f_order1 = $_POST["child_f_order1"];
$child_m_order1 = $_POST["child_m_order1"];
$child_d_order1 = $_POST["child_d_order1"];
$child_d_name1 = $_POST["child_d_name1"];
$child_d_birth1 = $_POST["child_d_birth1"];
$child_d_dead1 = $_POST["child_d_dead1"];
$child_school1 = $_POST["child_school1"];
$child_amphur1 = $_POST["child_amphur1"];
$child_province1 = $_POST["child_province1"];
$edu_level1 = $_POST["edu_level1"];
$type1 = $_POST["type1"];
$money1 = removecomma($_POST["money1"]);

$child_name2 = $_POST["child_name2"];
$child_birth2 = $_POST["child_birth2"];
$child_f_order2 = $_POST["child_f_order2"];
$child_m_order2 = $_POST["child_m_order2"];
$child_d_order2 = $_POST["child_d_order2"];
$child_d_name2 = $_POST["child_d_name2"];
$child_d_birth2 = $_POST["child_d_birth2"];
$child_d_dead2 = $_POST["child_d_dead2"];
$child_school2 = $_POST["child_school2"];
$child_amphur2 = $_POST["child_amphur2"];
$child_province2 = $_POST["child_province2"];
$edu_level2 = $_POST["edu_level2"];
$type2 = $_POST["type2"];
$money2 = removecomma($_POST["money2"]);

$child_name3 = $_POST["child_name3"];
$child_birth3 = $_POST["child_birth3"];
$child_f_order3 = $_POST["child_f_order3"];
$child_m_order3 = $_POST["child_m_order3"];
$child_d_order3 = $_POST["child_d_order3"];
$child_d_name3 = $_POST["child_d_name3"];
$child_d_birth3 = $_POST["child_d_birth3"];
$child_d_dead3 = $_POST["child_d_dead3"];
$child_school3 = $_POST["child_school3"];
$child_amphur3 = $_POST["child_amphur3"];
$child_province3 = $_POST["child_province3"];
$edu_level3 = $_POST["edu_level3"];
$type3 = $_POST["type3"];
$money3 = removecomma($_POST["money3"]);

	$numrow = $db->count_row(TB_WELFARE_CHILDLOAN_TAB," WHERE EMP_ID = '$emp_id'",$conn); 
	if($numrow == 0){
	$result=$db->add_db(TB_WELFARE_CHILDLOAN_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "CHILD_NAME1"=>"$child_name1",
											  "CHILD_BIRTH1"=>"$child_birth1",
											  "CHILD_F_ORDER1"=>"$child_f_order1",
											  "CHILD_M_ORDER1"=>"$child_m_order1",
											  "CHILD_D_ORDER1"=>"$child_d_order1",
											  "CHILD_D_NAME1"=>"$child_d_name1",
											  "CHILD_D_BIRTH1"=>"$child_d_birth1",
											  "CHILD_D_DEAD1"=>"$child_d_dead1",
											  "CHILD_SCHOOL1"=>"$child_school1",
											  "CHILD_AMPHUR1"=>"$child_amphur1",
											  "CHILD_PROVINCE1"=>"$child_province1",
											  "EDU_LEVEL1"=>"$edu_level1",
											  "TYPE1"=>"$type1",
											  "MONEY1"=>"$money1",
											  "CHILD_NAME2"=>"$child_name2",
											  "CHILD_BIRTH2"=>"$child_birth2",
											  "CHILD_F_ORDER2"=>"$child_f_order2",
											  "CHILD_M_ORDER2"=>"$child_m_order2",
											  "CHILD_D_ORDER2"=>"$child_d_order2",
											  "CHILD_D_NAME2"=>"$child_d_name2",
											  "CHILD_D_BIRTH2"=>"$child_d_birth2",
											  "CHILD_D_DEAD2"=>"$child_d_dead2",
											  "CHILD_SCHOOL2"=>"$child_school2",
											  "CHILD_AMPHUR2"=>"$child_amphur2",
											  "CHILD_PROVINCE2"=>"$child_province2",
											  "EDU_LEVEL2"=>"$edu_level2",
											  "TYPE2"=>"$type2",
											  "MONEY2"=>"$money2",
											  "CHILD_NAME3"=>"$child_name3",
											  "CHILD_BIRTH3"=>"$child_birth3",
											  "CHILD_F_ORDER3"=>"$child_f_order3",
											  "CHILD_M_ORDER3"=>"$child_m_order3",
											  "CHILD_D_ORDER3"=>"$child_d_order3",
											  "CHILD_D_NAME3"=>"$child_d_name3",
											  "CHILD_D_BIRTH3"=>"$child_d_birth3",
											  "CHILD_D_DEAD3"=>"$child_d_dead3",
											  "CHILD_SCHOOL3"=>"$child_school3",
											  "CHILD_AMPHUR3"=>"$child_amphur3",
											  "CHILD_PROVINCE3"=>"$child_province3",
											  "EDU_LEVEL3"=>"$edu_level3",
											  "TYPE3"=>"$type3",
											  "MONEY3"=>"$money3",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
	
	}else{
		$result=$db->update_db(TB_WELFARE_CHILDLOAN_TAB,array(
											 "CHILD_NAME1"=>"$child_name1",
											  "CHILD_BIRTH1"=>"$child_birth1",
											  "CHILD_F_ORDER1"=>"$child_f_order1",
											  "CHILD_M_ORDER1"=>"$child_m_order1",
											  "CHILD_D_ORDER1"=>"$child_d_order1",
											  "CHILD_D_NAME1"=>"$child_d_name1",
											  "CHILD_D_BIRTH1"=>"$child_d_birth1",
											  "CHILD_D_DEAD1"=>"$child_d_dead1",
											  "CHILD_SCHOOL1"=>"$child_school1",
											  "CHILD_AMPHUR1"=>"$child_amphur1",
											  "CHILD_PROVINCE1"=>"$child_province1",
											  "EDU_LEVEL1"=>"$edu_level1",
											  "TYPE1"=>"$type1",
											  "MONEY1"=>"$money1",
											  "CHILD_NAME2"=>"$child_name2",
											  "CHILD_BIRTH2"=>"$child_birth2",
											  "CHILD_F_ORDER2"=>"$child_f_order2",
											  "CHILD_M_ORDER2"=>"$child_m_order2",
											  "CHILD_D_ORDER2"=>"$child_d_order2",
											  "CHILD_D_NAME2"=>"$child_d_name2",
											  "CHILD_D_BIRTH2"=>"$child_d_birth2",
											  "CHILD_D_DEAD2"=>"$child_d_dead2",
											  "CHILD_SCHOOL2"=>"$child_school2",
											  "CHILD_AMPHUR2"=>"$child_amphur2",
											  "CHILD_PROVINCE2"=>"$child_province2",
											  "EDU_LEVEL2"=>"$edu_level2",
											  "TYPE2"=>"$type2",
											  "MONEY2"=>"$money2",
											  "CHILD_NAME3"=>"$child_name3",
											  "CHILD_BIRTH3"=>"$child_birth3",
											  "CHILD_F_ORDER3"=>"$child_f_order3",
											  "CHILD_M_ORDER3"=>"$child_m_order3",
											  "CHILD_D_ORDER3"=>"$child_d_order3",
											  "CHILD_D_NAME3"=>"$child_d_name3",
											  "CHILD_D_BIRTH3"=>"$child_d_birth3",
											  "CHILD_D_DEAD3"=>"$child_d_dead3",
											  "CHILD_SCHOOL3"=>"$child_school3",
											  "CHILD_AMPHUR3"=>"$child_amphur3",
											  "CHILD_PROVINCE3"=>"$child_province3",
											  "EDU_LEVEL3"=>"$edu_level3",
											  "TYPE3"=>"$type3",
											  "MONEY3"=>"$money3",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"EMP_ID='$emp_id'",$conn); 

	}

		if($result){
			//save_completed("Save_success");
			//reset_form_iframe("welfare");
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
//window.top.$("span#waiting").html("");
window.top.location="welfare_childloan_datails.php?"+ran;
</script>