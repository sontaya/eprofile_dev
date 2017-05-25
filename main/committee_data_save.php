<?
@session_start();

// DEBUG SPACE 
//echo "<pre>";
//print_r($_REQUEST);
//print_r($_FILES);
//echo "</pre>";
//exit();

if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
//$com_order_no = pea_substr(trim($_POST["document_type"]),50);
$com_id = $_POST['com_id'];
$document_type = $_POST['document_type'];
$com_order_no = "";
switch($document_type) {
	case '1' :
		$com_order_no = pea_substr(trim($_POST['document_type_1']),50);
	break;
	case '2' :
		$com_order_no = pea_substr(trim($_POST['document_type_2']),50);
	break;
	case '3' :
		$com_order_no = pea_substr(trim($_POST['document_type_3']),50);
	break;
}
$com_org_name = pea_substr(trim($_POST["com_org_name"]),150);
$com_type = $_POST["com_type"];
$com_start_date = "";
$com_end_date = "";
if($_POST["com_start_date"] != "") $com_start_date = date2_formatdb($_POST["com_start_date"]);
if($_POST["com_end_date"] != "") $com_end_date  =date2_formatdb($_POST["com_end_date"]);
//$com_place = pea_substr(trim($_POST["com_place"]),150);
$com_country = pea_substr(trim($_POST["com_country"]),150);
//$com_level =$_POST["com_level"];

// ส่วนเพิ่มเติมหากเป็นกรรมการสอบหรือกรรมการที่ปรึกษาวิทยานิพนธ์
$com_student_name = pea_substr(trim($_POST['com_student_name']),250);
$com_degree = $_POST['com_degree'];
$com_curriculum = pea_substr(trim($_POST['com_curriculum']),50);
$com_year = $_POST['com_year'];
$com_topic = pea_substr(trim($_POST['com_topic']),250);

// ถ้า com_type ไม่เท่ากับ 2 จะเคลียร์ค่าของส่วนเพิ่มเติมที่กล่าวมาทั้งหมด
if($com_type == 11) {
	$com_student_name = "";
	$com_degree = "";
	$com_curriculum = "";
	$com_year = "";
	$com_topic = "";
}



// 2010-08-31 แก้ไขให้มีการอัพโหลดไฟล์ได้
$consult_file = $_FILES['consult_file']['name'];
$consult_file_tmp = $_FILES['consult_file']['tmp_name'];
$maketime = mktime();
$consult_file =  $maketime . "_" . $consult_file;
$upp = move_uploaded_file($consult_file_tmp,"files/committee_file/" . $consult_file);
if(!$upp) {
	$consult_file = "";
}

//echo "<pre>"; print_r($_REQUEST); print_r($_FILES); echo "</pre>";
//exit();
// ---------------------------------------------------------------------
$numrow = $db->count_row(TB_COMMITTEE_TAB," WHERE EMP_ID = '$emp_id' AND COM_ID = '$com_id' ",$conn); 

if($numrow == 0){
	$com_id = auto_increment("COM_ID",TB_COMMITTEE_TAB);
		$result=$db->add_db(TB_COMMITTEE_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "COM_ID"=>"$com_id",
											  "COM_ORDER_NO"=>"$com_order_no",
											  "COM_ORG_NAME"=>"$com_org_name",
											  "COM_TYPE"=>"$com_type",
											  "COM_START_DATE"=>"TO_DATE('$com_start_date','YYYY-MM-DD')",
											  "COM_END_DATE"=>"TO_DATE('$com_end_date','YYYY-MM-DD')",
											  "COM_COUNTRY"=>"$com_country",
											  "COM_FILE"=>"$consult_file",
											  "COM_ORDER_TYPE"=>"$document_type",
											  "COM_STUDENT_NAME"=>"$com_student_name",
											  "COM_DEGREE"=>"$com_degree",
											  "COM_CURRICULUM"=>"$com_curriculum",
											  "COM_YEAR"=>"$com_year",
											  "COM_TOPIC"=>"$com_topic",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		if($consult_file_tmp != '') {
			$result=$db->update_db(TB_COMMITTEE_TAB,array(
												  "COM_ORG_NAME"=>"$com_org_name",
												  "COM_ORDER_NO"=>"$com_order_no",
												  "COM_TYPE"=>"$com_type",
												  "COM_START_DATE"=>"TO_DATE('$com_start_date','YYYY-MM-DD')",
											  "COM_END_DATE"=>"TO_DATE('$com_end_date','YYYY-MM-DD')",
												  "COM_COUNTRY"=>"$com_country",
												  "COM_FILE" =>"$consult_file",
												  "COM_ORDER_TYPE"=>"$document_type",
												   "COM_STUDENT_NAME"=>"$com_student_name",
												  "COM_DEGREE"=>"$com_degree",
												  "COM_CURRICULUM"=>"$com_curriculum",
												  "COM_YEAR"=>"$com_year",
												  "COM_TOPIC"=>"$com_topic",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
						  ),"EMP_ID='$emp_id' AND COM_ID = '$com_id'",$conn); 
		}
		else {
			$result=$db->update_db(TB_COMMITTEE_TAB,array(
											  "COM_ORG_NAME"=>"$com_org_name",
											  "COM_ORDER_NO"=>"$com_order_no",
											  "COM_TYPE"=>"$com_type",
											  "COM_START_DATE"=>"TO_DATE('$com_start_date','YYYY-MM-DD')",
											  "COM_END_DATE"=>"TO_DATE('$com_end_date','YYYY-MM-DD')",
											  "COM_COUNTRY"=>"$com_country",
											  "COM_ORDER_TYPE"=>"$document_type",
											  "COM_STUDENT_NAME"=>"$com_student_name",
											  "COM_DEGREE"=>"$com_degree",
											  "COM_CURRICULUM"=>"$com_curriculum",
											  "COM_YEAR"=>"$com_year",
											  "COM_TOPIC"=>"$com_topic",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"										  
					  ),"EMP_ID='$emp_id' AND COM_ID = '$com_id'",$conn); 
		}
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("consult");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูลการเป็นกรรมการภายนอก เลขที่ $com_order_no' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูลการเป็นกรรมการภายนอก เลขที่ $com_order_no' ($emp_id)");
			?>
			<script language="javascript">
			//window.top.load_committee_table();
			window.top.change_data('committee.php','../images/head2/work_data2/commit.png');
			</script>
			<?
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
//window.top.document.consult.com_order_no.readOnly = false;
//window.top.document.consult.com_order_no.readOnly = false;
window.top.$("span#waiting").html("");
</script>
<?
}
?>