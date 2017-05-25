<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
$roy_year = $_POST["roy_year"];
$roy_no1 =pea_substr(trim($_POST["roy_no1"]),10);
$roy_no2 = pea_substr(trim($_POST["roy_no2"]),10);
$roy_name = pea_substr(trim($_POST["roy_name"]),250);
$roy_id =  $_POST["roy_id"]; // ใช้ตรวจสอบว่า add(null) หรือ update(not null)

if($roy_id == "" ){
		$roy_id = auto_increment("ROY_ID",TB_ROYAL_TAB);
		$result=$db->add_db(TB_ROYAL_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "ROY_ID"=>"$roy_id",
											  "ROY_NAME"=>"$roy_name",
											  "ROY_YEAR"=>"$roy_year",
											  "ROY_NO1"=>"$roy_no1",
											  "ROY_NO2"=>"$roy_no2",
											  "ROY_OWN"=>"$roy_own",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_ROYAL_TAB,array(
											  "ROY_NAME"=>"$roy_name",
											  "ROY_YEAR"=>"$roy_year",
											  "ROY_NO1"=>"$roy_no1",
											  "ROY_NO2"=>"$roy_no2",
											  "ROY_OWN"=>"$roy_own",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"ROY_ID = '$roy_id'",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			//reset_form_iframe("royal");
			?>
			<script language="javascript">
			//window.top.load_royal_table();
			window.top.change_data('royal.php','../images/head2/work_data/royal.png');
			</script>
			<?
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูลเครื่องราชฯ ROY_ID='$roy_id'' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูลเครื่องราชฯ ROY_ID='$roy_id'' ($emp_id)");
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