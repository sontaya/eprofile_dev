<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
$apr_type =$_POST["apr_type"];
$apr_year = $_POST["apr_year"];
$apr_result = $_POST["apr_result"];
$apr_score = $_POST["apr_score"];
$apr_dev_comment = pea_substr(trim($_POST["apr_dev_comment"]),500);
$apr_salary_step = $_POST["apr_salary_step"];
$apr_salary_percent = $_POST["apr_salary_percent"];
$apr_salary_reason = pea_substr(trim($_POST["apr_salary_reason"]),500);
$apr_by_name = pea_substr(trim($_POST["apr_by_name"]),150);
$apr_by_pos = pea_substr(trim($_POST["apr_by_pos"]),150);
$apr_date  = date2_formatdb($_POST["apr_date"]);
$apr_up_comment  =$_POST["apr_up_comment"];
$apr_up_reason  = pea_substr(trim($_POST["apr_up_reason"]),500);

	$numrow = $db->count_row(TB_APPRAISE_TAB," WHERE EMP_ID = '$emp_id'  AND APR_YEAR = '$apr_year' ",$conn); 
	if($numrow == 0){
	$result=$db->add_db(TB_APPRAISE_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "APR_TYPE"=>"$apr_type",
											  "APR_YEAR"=>"$apr_year",
											  "APR_RESULT"=>"$apr_result",
											  "APR_SCORE"=>"$apr_score",
											  "APR_DEV_COMMENT"=>"$apr_dev_comment",
											  "APR_SALARY_STEP"=>"$apr_salary_step",
											  "APR_SALARY_PERCENT"=>"$apr_salary_percent",
											  "APR_SALARY_REASON"=>"$apr_salary_reason",
											  "APR_BY_NAME"=>"$apr_by_name",
											  "APR_BY_POS"=>"$apr_by_pos",
											  "APR_DATE"=>"TO_DATE('$apr_date','YYYY-MM-DD')",
											  "APR_UP_COMMENT"=>"$apr_up_comment",
											  "APR_UP_REASON"=>"$apr_up_reason",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
	$type_update = "1";
	}else{
		$result=$db->update_db(TB_APPRAISE_TAB,array(
											  "APR_TYPE"=>"$apr_type",
											  "APR_YEAR"=>"$apr_year",
											  "APR_RESULT"=>"$apr_result",
											  "APR_SCORE"=>"$apr_score",
											  "APR_DEV_COMMENT"=>"$apr_dev_comment",
											  "APR_SALARY_STEP"=>"$apr_salary_step",
											  "APR_SALARY_PERCENT"=>"$apr_salary_percent",
											  "APR_SALARY_REASON"=>"$apr_salary_reason",
											  "APR_BY_NAME"=>"$apr_by_name",
											  "APR_BY_POS"=>"$apr_by_pos",
											  "APR_DATE"=>"TO_DATE('$apr_date','YYYY-MM-DD')",
											  "APR_UP_COMMENT"=>"$apr_up_comment",
											  "APR_UP_REASON"=>"$apr_up_reason",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"  
					  ),"EMP_ID='$emp_id'  AND APR_YEAR = '$apr_year' ",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			?>
			<script language="javascript">
			//window.top.change_txt("<?=$apr_type?>");
			window.top.change_data('appraise_data.php','../images/head2/work_data2/appraise.png');
			</script>
			<?
			//reset_form_iframe("appraise_data");
			
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ประเมินการทำงานปี $apr_year' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ประเมินการทำงาน $apr_year' ($emp_id)");
			
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
//window.top.load_page("appraise_data.php?"+ran);
//window.top.change_data('appraise_data.php','../images/head2/work_data2/appraise.png');
</script>
<?
}
?>