<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
function upload_file($name,$what){
	global $emp_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"]);
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="sem_{$emp_id}_".randpass(3)."($what).{$last}";
	$target_path = "files/sem_data_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}
$sem_id = $_POST["sem_id"];
$sem_order_no = $_POST["sem_order_no"];
$sem_who_name = pea_substr(trim($_POST["sem_who_name"]),150);
$sem_who_position = pea_substr(trim($_POST["sem_who_position"]),150);
$sem_depart = $_POST["sem_depart"];
$sem_type = $_POST["sem_type"];
$sem_course_name = pea_substr(trim($_POST["sem_course_name"]),500);
$sem_start_date = "";
$sem_end_date = "";
if($_POST["sem_start_date"] != "" ) $sem_start_date = date2_formatdb($_POST["sem_start_date"]);
if($_POST["sem_end_date"] != "" ) $sem_end_date = date2_formatdb($_POST["sem_end_date"]);
$sem_long = trim($_POST["sem_long"]);
$sem_place = pea_substr(trim($_POST["sem_place"]),150);
$sem_by = pea_substr(trim($_POST["sem_by"]),150);
$sem_point = pea_substr(trim($_POST["sem_point"]),150);
$sem_expense = $_POST["sem_expense"];

if($sem_expense == "1"){
	$sem_free_expense = pea_substr(trim($_POST["sem_free_expense"]),100);
}elseif($sem_expense == "2"){
	$sem_expenses = pea_substr(trim($_POST["sem_expenses"]),20);
	$sem_money_type = pea_substr(trim($_POST["sem_money_type"]),50);
}else{
	$sem_free_expense = "";
	$sem_expenses = "";
	$sem_money_type = "";
}

$sem_benefit = pea_substr(trim($_POST["sem_benefit"]),500);
$sem_improve = pea_substr(trim($_POST["sem_improve"]),500);
$sem_suggestion = pea_substr(trim($_POST["sem_suggestion"]),500);
$sem_chief_adv = pea_substr(trim($_POST["sem_chief_adv"]),500);
$sem_chief = pea_substr(trim($_POST["sem_chief"]),150);
$hid_sem_file = $_POST["hid_sem_file"];

$complete_upload = 1;

if($_FILES['sem_file']['name'] != "" ){
			$temp = upload_file("sem_file","sem");
			if($temp != "" and $temp != false){
			//if($hid_fam_cen_file != ""){
					@unlink("files/sem_data_file/$hid_sem_file");
			//	}
				$sem_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$sem_file = $hid_sem_file;
}


if($complete_upload == 1){
		
	if($sem_id == "" ){
		$sem_id = auto_increment("ID",TB_SEMINAR_TAB);
		$result=$db->add_db(TB_SEMINAR_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "ID"=>"$sem_id",
                                              "SEM_ORDER_NO"=>"$sem_order_no",
											  "SEM_WHO_NAME"=>"$sem_who_name",
											  "SEM_WHO_POSITION"=>"$sem_who_position",
											  "SEM_DEPART"=>"$sem_depart",
											  "SEM_TYPE"=>"$sem_type",
											  "SEM_COURSE_NAME"=>"$sem_course_name",
											  "SEM_START_DATE"=>"TO_DATE('$sem_start_date','YYYY-MM-DD')",
											  "SEM_END_DATE"=>"TO_DATE('$sem_end_date','YYYY-MM-DD')",
											  "SEM_LONG"=>"$sem_long",
											  "SEM_PLACE"=>"$sem_place",
											  "SEM_BY"=>"$sem_by",
											  "SEM_POINT"=>"$sem_point",
											  "SEM_EXPENSE"=>"$sem_expense",
											  "SEM_FREE_EXPENSE"=>"$sem_free_expense",
											  "SEM_EXPENSES"=>"$sem_expenses",
											  "SEM_MONEY_TYPE"=>"$sem_money_type",
											  "SEM_BENEFIT"=>"$sem_benefit",
											  "SEM_IMPROVE"=>"$sem_improve",
											  "SEM_SUGGESTION"=>"$sem_suggestion",
											  "SEM_CHIEF_ADV"=>"$sem_chief_adv",
											  "SEM_CHIEF"=>"$sem_chief",
											  "SEM_FILE"=>"$sem_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  	  
					  ),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_SEMINAR_TAB,array(
											  "SEM_ORDER_NO"=>"$sem_order_no",
                                              "SEM_WHO_NAME"=>"$sem_who_name",
											  "SEM_WHO_POSITION"=>"$sem_who_position",
											  "SEM_DEPART"=>"$sem_depart",
											  "SEM_TYPE"=>"$sem_type",
											  "SEM_COURSE_NAME"=>"$sem_course_name",
											  "SEM_START_DATE"=>"TO_DATE('$sem_start_date','YYYY-MM-DD')",
											  "SEM_END_DATE"=>"TO_DATE('$sem_end_date','YYYY-MM-DD')",
											  "SEM_LONG"=>"$sem_long",
											  "SEM_PLACE"=>"$sem_place",
											  "SEM_BY"=>"$sem_by",
											  "SEM_POINT"=>"$sem_point",
											  "SEM_EXPENSE"=>"$sem_expense",
											  "SEM_FREE_EXPENSE"=>"$sem_free_expense",
											  "SEM_EXPENSES"=>"$sem_expenses",
											  "SEM_MONEY_TYPE"=>"$sem_money_type",
											  "SEM_BENEFIT"=>"$sem_benefit",
											  "SEM_IMPROVE"=>"$sem_improve",
											  "SEM_SUGGESTION"=>"$sem_suggestion",
											  "SEM_CHIEF_ADV"=>"$sem_chief_adv",
											  "SEM_CHIEF"=>"$sem_chief",
											  "SEM_FILE"=>"$sem_file"	,
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user" 
					  ),"ID='$sem_id' ",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("seminar");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'อบรมสัมนา หลักสูตร $sem_course_name' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'อบรมสัมนา หลักสูตร $sem_course_name' ($emp_id)");
		}else{
			save_completed("Save_error");
?>
<script language="javascript">
window.top.$("span#waiting").html("");
</script>
<?
exit();
		}
}else{
	save_completed("Error_upload");
?>
<script language="javascript">
window.top.$("span#waiting").html("");
</script>
<?
exit();
	//reset_form_iframe("fam_data");
}
$db->closedb($conn);	
?>
<script language="javascript">
var ran=Math.random();
window.top.$("span#waiting").html("");
//window.top.load_sem_table();
window.top.change_data('seminar.php','../images/head2/work_data2/seminar.png');
</script>
<?
}
?>