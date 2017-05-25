<?
if($_POST){
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");
$edu_id =  $_REQUEST["edu_id"];
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
function upload_file($name,$array){
	global $emp_id;
	global $edu_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"][$array]);
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="edu_{$emp_id}_".randpass(3).".{$last}";
	$target_path = "files/edu_data_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"][$array], $target_path)) {
		
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"][$array]);
		return false;
	}
}

$complete_upload = 1;

$is_upfile = count($_FILES['edu_file']['name']);
$num_file = 0;
for($i=0;$i<$is_upfile;$i++){
	if($_FILES['edu_file']['tmp_name'][$i] != ""){
		$temp = upload_file("edu_file",$i);
		if(!$temp){ $complete_upload = 0; break;}
		$id = auto_increment("ID",TB_EDUCATION_FILE_TAB);
		$db->add_db(TB_EDUCATION_FILE_TAB,array(
											  "ID"=>"$id",
											  "EDU_FILE_NAME"=>"$temp",
											  "EDU_ID"=>"$edu_id",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn);
	}
}
$db->closedb($conn);	
if($complete_upload == 1){
	access_log($fpath.'_log',"",$update_by,"เพิ่ม 'เอกสารการศึกษา ID=$id' ($emp_id)");
?>
<script language="javascript">
window.top.location.reload();
</script>
<?
}else{
?>
<script language="javascript">
window.top.$("span#waiting").html("ไม่สามารถอัพโหลดไฟล์ได้");
</script>
<?
}
}
?>