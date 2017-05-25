<?
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
function upload_file($name){
	global $emp_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"]);
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="sch_{$emp_id}_".randpass(3).".{$last}";
	$target_path = "files/sch_data_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}

$complete_upload = 1;

$is_upfile = count($_FILES['sch_file']['name']);
$sch_year_file = $_POST["sch_year_file"];
$sch_sem_file = $_POST["sch_sem_file"];
$num_file = 0;
//for($i=0;$i<$is_upfile;$i++){
	if($_FILES['sch_file']['tmp_name'] != ""){
		$temp = upload_file("sch_file");
		$t1 = $sch_year_file;
		$t2 = $sch_sem_file;
		if(!$temp){ $complete_upload = 0; break;}
		$sch_id = auto_increment("SCH_ID",TB_SCHOLAR_FILE_TAB);
		$db->add_db(TB_SCHOLAR_FILE_TAB,array(
											  "EMP_ID"=>"$emp_id",
											  "SCH_FILE_NAME"=>"$temp",
											  "SCH_YEAR_FILE"=>"$t1",
											  "SCH_SEM_FILE"=>"$t2",
											  "SCH_ID"=>"$sch_id",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn);
	}
//}
$db->closedb($conn);	
if($complete_upload == 1){
?>
<script language="javascript">
window.top.$("span#waiting2").html("");
window.top.document.getElementById('education').reset();
window.top.$('#sch_file_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
window.top.$('#sch_file_list').load('sch_file_list.php');
</script>
<?
}else{
?>
<script language="javascript">
window.top.$("span#waiting2").html("ไม่สามารถอัพโหลดไฟล์ได้");

</script>
<?
}

?>