<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
$wap_type = $_POST["wap_type"];
$wap_date = "";
if($_POST["wap_date"] != "" ) $wap_date = date2_formatdb($_POST["wap_date"]);
$wap_memo = pea_substr(trim($_POST["wap_memo"]),500);
$wap_id =  $_POST["wap_id"]; // ใช้ตรวจสอบว่า add(null) หรือ update(not null)

if($wap_id == "" ){
		$wap_id = auto_increment("WAP_ID",TB_WARN_PUNISH_TAB);
		$result=$db->add_db(TB_WARN_PUNISH_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "WAP_ID"=>"$wap_id",
											  "WAP_TYPE"=>"$wap_type",
											  "WAP_DATE"=>"TO_DATE('$wap_date','YYYY-MM-DD')",
											  "WAP_MEMO"=>"$wap_memo",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_WARN_PUNISH_TAB,array(
											  "WAP_TYPE"=>"$wap_type",
											  "WAP_DATE"=>"TO_DATE('$wap_date','YYYY-MM-DD')",
											  "WAP_MEMO"=>"$wap_memo",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"WAP_ID = '$wap_id'",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("warn_punish");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'การตักเตือน ลงโทษ id = $wap_id' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'การตักเตือน ลงโทษ id = $wap_id' ($emp_id)");
			?>
			<script language="javascript">
			//window.top.load_warn_table();
			window.top.change_data('warn_punish.php','../images/head2/work_data2/warn.png');
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