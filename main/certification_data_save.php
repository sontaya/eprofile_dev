<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
$cer_name = pea_substr(trim($_POST["cer_name"]),150);
$cet_from = pea_substr(trim($_POST["cet_from"]),150);
$cer_expire = "";
if($_POST["cer_expire"] != "" ) $cer_expire = date2_formatdb($_POST["cer_expire"]);
$cer_id =  $_POST["cer_id"]; // ใช้ตรวจสอบว่า add(null) หรือ update(not null)

if($cer_id == "" ){
		$cer_id = auto_increment("CER_ID",TB_CERTIFICATION_TAB);
		$result=$db->add_db(TB_CERTIFICATION_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "CER_ID"=>"$cer_id",
											  "CER_NAME"=>"$cer_name",
											  "CER_FROM"=>"$cer_from",
											  "CER_EXPIRE"=>"TO_DATE('$cer_expire','YYYY-MM-DD')",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_CERTIFICATION_TAB,array(
											   "CER_NAME"=>"$cer_name",
											  "CER_FROM"=>"$cer_from",
											  "CER_EXPIRE"=>"TO_DATE('$cer_expire','YYYY-MM-DD')",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"CER_ID = '$cer_id'",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			//reset_form_iframe("certification");
			/*if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'การตักเตือน ลงโทษ id = $wap_id' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'การตักเตือน ลงโทษ id = $wap_id' ($emp_id)");*/
			?>
			<script language="javascript">
			//window.top.load_certification_table();
			window.top.change_data('certification.php','../images/head2/work_data/certification.png');
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