<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
$con_id = $_POST["con_id"];

$con_order_no = pea_substr(trim($_POST["con_order_no"]),50);
$con_course_name = pea_substr(trim($_POST["con_course_name"]),150);
$con_type = $_POST["con_type"];
$con_start_date = "";
$con_end_date = "";
if($_POST["con_start_date"] != "") $con_start_date = date2_formatdb($_POST["con_start_date"]);
if($_POST["con_end_date"] != "") $con_end_date  =date2_formatdb($_POST["con_end_date"]);
$con_place = pea_substr(trim($_POST["con_place"]),150);
$con_detail = pea_substr(trim($_POST["con_detail"]),500);
$con_country = $_POST["con_country"];

$con_level =$_POST["con_level"];

// การแนบไฟล์ -------------------------
$constructor_file = $_FILES['constructor_file']['name'];
$constructor_file_tmp = $_FILES['constructor_file']['tmp_name'];
$maketime = mktime();
$constructor_file =  $maketime . "_" . $constructor_file;
$upp = move_uploaded_file($constructor_file_tmp,"files/constructor_file/" . $constructor_file);
if(!$upp) {
	$constructor_file = "";
}
// -----------------------------------------

$numrow = $db->count_row(TB_CONSTRUCTOR_TAB," WHERE EMP_ID = '$emp_id' AND CON_ID = '$con_id' ",$conn); 

if($numrow == 0){
	$con_id = auto_increment("CON_ID",TB_CONSTRUCTOR_TAB);
	
		$result=$db->add_db(TB_CONSTRUCTOR_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "CON_ID"=>"$con_id",
											  "CON_ORDER_NO"=>"$con_order_no",
											  "CON_COURSE_NAME"=>"$con_course_name",
											  "CON_TYPE"=>"$con_type",
											  "CON_START_DATE"=>"TO_DATE('$con_start_date','YYYY-MM-DD')",
											  "CON_END_DATE"=>"TO_DATE('$con_end_date','YYYY-MM-DD')",
											  "CON_PLACE"=>"$con_place",
											  "CON_DETAIL"=>"$con_detail",
											  "CON_COUNTRY"=>"$con_country",
											  "CON_LEVEL"=>"$con_level",
											  "CON_FILE"=>"$constructor_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		if($constructor_file_tmp != '') { echo "จุด A";
			$result=$db->update_db(TB_CONSTRUCTOR_TAB,array(
												  "CON_COURSE_NAME"=>"$con_course_name",
												  "CON_ORDER_NO"=>"$con_order_no",
												  "CON_TYPE"=>"$con_type",
												  "CON_START_DATE"=>"TO_DATE('$con_start_date','YYYY-MM-DD')",
												  "CON_END_DATE"=>"TO_DATE('$con_end_date','YYYY-MM-DD')",
												  "CON_PLACE"=>"$con_place",
												   "CON_DETAIL"=>"$con_detail",
												  "CON_COUNTRY"=>"$con_country",
												  "CON_LEVEL"=>"$con_level",
												  "CON_FILE"=>"$constructor_file" ,
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
						  ),"EMP_ID='$emp_id' AND CON_ID = '$con_id' ",$conn); 
		}
		else { echo "จุด B";
			$result=$db->update_db(TB_CONSTRUCTOR_TAB,array(
												  "CON_COURSE_NAME"=>"$con_course_name",
												  "CON_ORDER_NO"=>"$con_order_no",
												  "CON_TYPE"=>"$con_type",
												  "CON_START_DATE"=>"TO_DATE('$con_start_date','YYYY-MM-DD')",
												  "CON_END_DATE"=>"TO_DATE('$con_end_date','YYYY-MM-DD')",
												  "CON_PLACE"=>"$con_place",
												   "CON_DETAIL"=>"$con_detail",
												  "CON_COUNTRY"=>"$con_country",
												  "CON_LEVEL"=>"$con_level",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
						  ),"EMP_ID='$emp_id' AND CON_ID = '$con_id' ",$conn); 
		} 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("constructor");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'การเป็นวิทยากร อาจารย์พิเศษ เลขที่ $con_order_no' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'การเป็นวิทยากร อาจารย์พิเศษเลขที่ $con_order_no' ($emp_id)");
			?>
			<script language="javascript">
			//window.top.load_constructor_table();
			window.top.change_data('constructor.php','../images/head2/work_data2/constructor.png');
			</script>
			<?
		}else{
			save_completed("Save_error");
?>
<script language="javascript">
window.top.$("span#waiting").html('');
</script>
<?
exit();

		}

$db->closedb($conn);	
?>
<script language="javascript">
//var ran=Math.random();
//window.top.document.constructor.con_order_no.readOnly = false;
window.top.$("span#waiting").html("");
//indow.top.load_page("current_address.php?"+ran);
</script>
<?
}
?>