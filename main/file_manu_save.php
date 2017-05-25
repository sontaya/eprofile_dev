<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
$mame_manu = $_POST["mame_manu"];
$fname = $_POST["fi_name"];
$f_last=explode(".",$_FILES["fup"]["name"]);
$rr=$f_last['0'];
$last2=strtolower($f_last[count($f_last)-1]);
$aq=date("YmdHis");
$fup=$_FILES["fup"]["name"];
if($fup==""){
    $f_name_new=$fi_d = $_POST["fi_d"];	
}else{
    $f_name_new=$aq.".".$last2;
}
$fi_id = $_POST["fi_id"];
$dr=date("Y")+543;
$dd=date("d/m/").$dr;
$create_s = date2_formatdb($dd);
	
function upload_file($name,$what,$fname){
	global $emp_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"]);
	$last=strtolower($array_last[count($array_last)-1]);
	$aq=date("YmdHis");
	$file_name=$aq.".{$last}";
	$target_path = "files/fi_manu_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}


$complete_upload = 1;

if($_FILES['fup']['name'] != "" ){
			$temp = upload_file("fup","file_manu",$fname);
			if($temp != "" and $temp != false){
				@unlink("files/fi_manu_file/$hid_hon_file");
				$hon_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$hon_file = $hid_hon_file;
}

if($complete_upload == 1){
if($fi_id == "" ){
	$sql_sch_country = "select max(FI_ID)as FI_ID from SDU_FILE_MANU_TAB";
	  $stid_sch_country = oci_parse($conn, $sql_sch_country);
	  oci_execute($stid_sch_country); 
	     while ($row_sch_country = oci_fetch_array($stid_sch_country, OCI_BOTH)) {
			  $oo=$row_sch_country["FI_ID"]+1;
		 }
		//$hon_id = auto_increment("HON_ID",TB_HONOR_TAB);
		$result=$db->add_db(TB_SDU_FILE_MANU_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "MAME_MANU"=>"$mame_manu",
											  "FNAME"=>"$fname",
											  "CREATE_DATE"=>"$create_s",
											  "FI_ID"=>"$oo",
											  "CTEATE_USER"=>"$emp_id",
											  "FI_DOW"=>"$f_name_new",
											  ),$conn); 
	}else{
		$result=$db->update_db(TB_SDU_FILE_MANU_TAB,array(
											  "EMP_ID"=>"$emp_id",
											  "MAME_MANU"=>"$mame_manu",
											  "FNAME"=>"$fname",
											  "CREATE_DATE"=>"$create_s",
											  "CTEATE_USER"=>"$emp_id",
											  "FI_DOW"=>"$f_name_new"
					  ),"FI_ID = '$fi_id'",$conn); 
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("file_manu");
			?>
			<script language="javascript">
			//window.top.load_honor_table();
			window.top.change_data('file_book_data.php','../images/head2/work_data/honor.png');
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