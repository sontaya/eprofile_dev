<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
function upload_file($name,$what){
	global $emp_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"]);
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="h_{$emp_id}_".randpass(3)."($what).{$last}";
	$target_path = "files/hon_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}

$hon_year = $_POST["hon_year"];
$hon_name = pea_substr(trim($_POST["hon_name"]),150);
$hon_from = pea_substr(trim($_POST["hon_from"]),150);
$hon_id =  $_POST["hon_id"]; // ใช้ตรวจสอบว่า add(null) หรือ update(not null)
$hid_hon_file = $_POST["hid_hon_file"];

$complete_upload = 1;

if($_FILES['hon_file']['name'] != "" ){
			$temp = upload_file("hon_file","honor");
			if($temp != "" and $temp != false){
				@unlink("files/hon_file/$hid_hon_file");
				$hon_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$hon_file = $hid_hon_file;
}

if($complete_upload == 1){
if($hon_id == "" ){
		$hon_id = auto_increment("HON_ID",TB_HONOR_TAB);
		$result=$db->add_db(TB_HONOR_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "HON_ID"=>"$hon_id",
											  "HON_NAME"=>"$hon_name",
											  "HON_YEAR"=>"$hon_year",
											  "HON_FROM"=>"$hon_from",
											  "HON_FILE"=>"$hon_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
	}else{
		$result=$db->update_db(TB_HONOR_TAB,array(
											  "HON_NAME"=>"$hon_name",
											  "HON_YEAR"=>"$hon_year",
											  "HON_FROM"=>"$hon_from",
											  "HON_FILE"=>"$hon_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"HON_ID = '$hon_id'",$conn); 
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("honor");
			?>
			<script language="javascript">
			//window.top.load_honor_table();
			window.top.change_data('honor.php','../images/head2/work_data/honor.png');
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
}else{
	save_completed("Error_upload");
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