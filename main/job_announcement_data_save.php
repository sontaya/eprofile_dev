<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
$jnc_id = $_POST["jnc_id"];
if($jnc_id == ""){
	$jnc_id = auto_increment("ID",TB_JOB_ANNOUNCEMENT_TAB);
}

$jnc_topic = pea_substr(trim($_POST["jnc_topic"]),150);
if($_POST["jnc_date"] != "") $jnc_date = date2_formatdb($_POST["jnc_date"]); else $jnc_date = "";
$jnc_order_no = pea_substr(trim($_POST["jnc_order_no"]),50);

$jnc_pos_name = pea_substr(trim($_POST["jnc_pos_name"]),150);
$jnc_responsibility = pea_substr(trim($_POST["jnc_responsibility"]),500);
$jnc_depart = pea_substr(trim($_POST["jnc_depart"]),150);
$jnc_salary = pea_substr(trim($_POST["jnc_salary"]),20);
$jnc_quantity = pea_substr(trim($_POST["jnc_quantity"]),20);
$jnc_qualification = pea_substr(trim($_POST["jnc_qualification"]),500);
$jnc_qualification_ps = pea_substr(trim($_POST["jnc_qualification_ps"]),500);
$jnc_spec_qualification = pea_substr(trim($_POST["jnc_spec_qualification"]),500);
$jnc_description = pea_substr(trim($_POST["jnc_description"]),500);
$jnc_date_place = pea_substr(trim($_POST["jnc_date_place"]),150);
$jnc_attach_file = pea_substr(trim($_POST["jnc_attach_file"]),250);
$date = date("Y-m-d");
$jnc_status = $_POST["jnc_status"];

	$numrow = $db->count_row(TB_JOB_ANNOUNCEMENT_TAB," WHERE ID = '$jnc_id' ",$conn); 

if($numrow == 0){
		$result=$db->add_db(TB_JOB_ANNOUNCEMENT_TAB,array(
 											  "ID"=>"$jnc_id",
                                                                    "JNC_TOPIC"=>"$jnc_topic",
                                                                    "JNC_DATE"=>"$jnc_date",
											  "JNC_ORDER_NO"=>"$jnc_order_no",
											  "JNC_POS_NAME"=>"$jnc_pos_name",
											  "JNC_RESPONSIBILITY"=>"$jnc_responsibility",
											  "JNC_DEPART"=>"$jnc_depart",
											  "JNC_SALARY"=>"$jnc_salary",
											  "JNC_QUANTITY"=>"$jnc_quantity",
											  "JNC_QUALIFICATION"=>"$jnc_qualification",
											  "JNC_QUALIFICATION_PS"=>"$jnc_qualification_ps",
											  "JNC_SPEC_QUALIFICATION"=>"$jnc_spec_qualification",
											  "JNC_DESCRIPTION"=>"$jnc_description",
											  "JNC_DATE_PLACE"=>"$jnc_date_place",
											  "JNC_ATTACH_FILE"=>"$jnc_attach_file",
											  "JNC_STATUS"=>"$jnc_status",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_JOB_ANNOUNCEMENT_TAB,array(
											  "JNC_TOPIC"=>"$jnc_topic",
                                                                    "JNC_DATE"=>"$jnc_date",
                                                                    "JNC_ORDER_NO"=>"$jnc_order_no",
											  "JNC_POS_NAME"=>"$jnc_pos_name",
											  "JNC_RESPONSIBILITY"=>"$jnc_responsibility",
											  "JNC_DEPART"=>"$jnc_depart",
											  "JNC_SALARY"=>"$jnc_salary",
											  "JNC_QUANTITY"=>"$jnc_quantity",
											  "JNC_QUALIFICATION"=>"$jnc_qualification",
											  "JNC_QUALIFICATION_PS"=>"$jnc_qualification_ps",
											  "JNC_SPEC_QUALIFICATION"=>"$jnc_spec_qualification",
											  "JNC_DESCRIPTION"=>"$jnc_description",
											  "JNC_DATE_PLACE"=>"$jnc_date_place",
											  "JNC_ATTACH_FILE"=>"$jnc_attach_file",
											  "JNC_STATUS"=>"$jnc_status",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"ID='$jnc_id'",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
		?>
		<script language="javascript">
		window.top.reset_false();
		window.top.document.getElementById('jnc_id').value='';
		</script>
		<?
			reset_form_iframe("job_announcement");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูลรับสมัครบุคลากร ID=$jnc_id' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูลรับสมัครบุคลากร ID=$jnc_id' ($emp_id)");

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
//var ran=Math.random();
window.top.$("span#waiting").html("");
//window.top.load_page("job_announcement.php?"+ran);
</script>
<?
}
?>