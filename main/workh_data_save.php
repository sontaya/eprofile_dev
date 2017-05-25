<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
$wrk_work_place = pea_substr(trim($_POST["wrk_work_place"]),150);
$wrk_position = pea_substr(trim($_POST["wrk_position"]),150);
$wrk_depart = pea_substr(trim($_POST["wrk_depart"]),150);
$wrk_responsibility = pea_substr(trim($_POST["wrk_responsibility"]),500);
$wrk_long = pea_substr(trim($_POST["wrk_long"]),200);
$wrk_loc = pea_substr(trim($_POST["wrk_loc"]),300);
$wrk_phone = pea_substr(trim($_POST["wrk_phone"]),50);
$wrk_fax = pea_substr(trim($_POST["wrk_fax"]),50);
$wrk_id =  $_POST["wrk_id"]; // ใช้ตรวจสอบว่า add(null) หรือ update(not null)

if($wrk_id == "" ){
		$wrk_id = auto_increment("WRK_ID",TB_WORK_HISTORY_TAB);
		$result=$db->add_db(TB_WORK_HISTORY_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "WRK_ID"=>"$wrk_id",
											  "WRK_WORK_PLACE"=>"$wrk_work_place",
											  "WRK_POSITION"=>"$wrk_position",
											  "WRK_DEPART"=>"$wrk_depart",
											  "WRK_RESPONSIBILITY"=>"$wrk_responsibility",
											  "WRK_LONG"=>"$wrk_long",
											  "WRK_LOC"=>"$wrk_loc",
											  "WRK_PHONE"=>"$wrk_phone",
											  "WRK_FAX"=>"$wrk_fax",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_WORK_HISTORY_TAB,array(
											  "WRK_WORK_PLACE"=>"$wrk_work_place",
											  "WRK_POSITION"=>"$wrk_position",
											  "WRK_DEPART"=>"$wrk_depart",
											  "WRK_RESPONSIBILITY"=>"$wrk_responsibility",
											  "WRK_LONG"=>"$wrk_long",
											  "WRK_LOC"=>"$wrk_loc",
											  "WRK_PHONE"=>"$wrk_phone",
											  "WRK_FAX"=>"$wrk_fax",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"WRK_ID = '$wrk_id'",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("work_history");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ประวัติการทำงานในอดีต id = $wrk_id' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ประวัติการทำงานในอดีต id = $wrk_id' ($emp_id)");
			?>
			<script language="javascript">
			//window.top.load_wrk_table();
			window.top.change_data('work_history.php','../images/head2/work_data/workhistory.png');
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
//var ran=Math.random();
window.top.$("span#waiting").html("");
//indow.top.load_page("current_address.php?"+ran);
</script>
<?
}
?>