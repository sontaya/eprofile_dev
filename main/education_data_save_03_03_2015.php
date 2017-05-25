<?
@session_start();
include "update_by.php";
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
$edu_id =  $_POST["edu_id"]; // ใช้ตรวจสอบว่า add(null) หรือ update(not null)
if($edu_id == ""){
	$edu_id = auto_increment("EDU_ID",TB_EDUCATION_TAB);
}

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
$edu_level = $_POST["edu_level"];
$edu_country = $_POST["edu_country"];
$edu_name = pea_substr(trim($_POST["edu_name"]),250);
$edu_name_short = pea_substr(trim($_POST["edu_name_short"]),50);
$edu_gpa = pea_substr(trim($_POST["edu_gpa"]),20);
$edu_discipline = $_POST["edu_discipline"];
$edu_year = $_POST["edu_year"];
$edu_major =  pea_substr(trim($_POST["edu_major"]),250);
$edu_program = $_POST["edu_program"];
$edu_from = pea_substr(trim($_POST["edu_from"]),150);

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

//	echo "$num_file file";

/*if($_FILES['edu_file']['name'] != "" ){
			$temp = upload_file("edu_file","edu_file");
			if($temp != "" and $temp != false){
			//if($hid_edu_file != ""){
					@unlink("files/edu_data_file/$hid_edu_file");
			//	}
				$edu_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$edu_file = $hid_edu_file;
}*/


if($complete_upload == 1){
	$numrow = $db->count_row(TB_EDUCATION_TAB," WHERE EMP_ID = '$emp_id' AND EDU_ID = '$edu_id' ",$conn);

	if($numrow == 0 ){
	$result=$db->add_db(TB_EDUCATION_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "EDU_ID"=>"$edu_id",
											  "EDU_LEVEL"=>"$edu_level",
											  "EDU_COUNTRY"=>"$edu_country",
											  "EDU_NAME"=>"$edu_name",
											  "EDU_NAME_SHORT"=>"$edu_name_short",
											  "EDU_GPA"=>"$edu_gpa",
											  "EDU_YEAR"=>"$edu_year",
											  "EDU_MAJOR"=>"$edu_major",
											  "EDU_DISCIPLINE"=>"$edu_program",
											  "EDU_FROM"=>"$edu_from",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
	$type_update = "1";
	}else{
		$result=$db->update_db(TB_EDUCATION_TAB,array(
											"EDU_LEVEL"=>"$edu_level",
											  "EDU_COUNTRY"=>"$edu_country",
											  "EDU_NAME"=>"$edu_name",
											  "EDU_NAME_SHORT"=>"$edu_name_short",
											  "EDU_GPA"=>"$edu_gpa",
											  "EDU_YEAR"=>"$edu_year",
											  "EDU_MAJOR"=>"$edu_major",
											  "EDU_DISCIPLINE"=>"$edu_program",
											  "EDU_FROM"=>"$edu_from",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),"EMP_ID='$emp_id' AND EDU_ID = '$edu_id'",$conn); 
		$type_update = "2";
	}
	$db->closedb($conn);	
		if($result){
			//save_completed("Save_success");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ประวัติการศึกษา EDU_ID=$edu_id' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ประวัติการศึกษา EDU_ID=$edu_id' ($emp_id)");
			?>
			<script language="javascript">
			window.top.change_data('education.php','../images/head2/work_data/education.png');
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
	//reset_form_iframe("chl_data");
}

?>
<script language="javascript">
//var ran=Math.random();
window.top.$("span#waiting").html("");
//window.top.load_edu_table();
//window.top.document.children_data.chl_code_id.readOnly="";
</script>
<?
}
?>