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
	$file_name="grt_{$emp_id}_".randpass(3)."($what).{$last}";
	$target_path = "files/guarantee_data_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}

$grt_contract_no = $_POST["grt_contract_no1"]."/".$_POST["grt_contract_no2"];
$grt_at = pea_substr($_POST["grt_at"],100);
$grt_name = $_POST["grt_name"];
$grt_contract_type = $_POST["grt_contract_type"];
$grt_university = pea_substr(trim($_POST["grt_university"]),150);
$grt_country = pea_substr(trim($_POST["grt_country"]),150);
$grt_by = $_POST["grt_by_title_name"]." ".$_POST["grt_by_fname"]." ".$_POST["grt_by_lname"];
$grt_birthday = "";
if($_POST["grt_birthday"] != "" ) $grt_birthday = date2_formatdb($_POST["grt_birthday"]);
$grt_occupation = pea_substr(trim($_POST["grt_occupation"]),150);
$grt_work_place = pea_substr(trim($_POST["grt_work_place"]),150);
$grt_position = pea_substr(trim($_POST["grt_position"]),150);
$grt_level = pea_substr(trim($_POST["grt_level"]),50);
$grt_in = pea_substr(trim($_POST["grt_in"]),50);
$grt_salary = removecomma(trim($_POST["grt_salary"]));
$grt_id_type = $_POST["grt_id_type"];
$grt_id_no = pea_substr(trim($_POST["grt_id_no"]),20);
$grt_id_from = pea_substr(trim($_POST["grt_id_from"]),50);
$grt_id_date_begin = "";
$grt_id_date_exp = "";
if($_POST["grt_id_date_begin"] != "" ) $grt_id_date_begin = date2_formatdb($_POST["grt_id_date_begin"]);
if($_POST["grt_id_date_exp"] != "" ) $grt_id_date_exp = date2_formatdb($_POST["grt_id_date_exp"]);
$grt_house_no = pea_substr(trim($_POST["grt_house_no"]),20);
$grt_soi = pea_substr($_POST["grt_soi"],50);
$grt_road = pea_substr($_POST["grt_road"],50);
$grt_tumbon = pea_substr(trim($_POST["grt_tumbon"]),100);
$grt_amphur = pea_substr(trim($_POST["grt_amphur"]),100);
$grt_province = pea_substr(trim($_POST["grt_province"]),100);
$grt_post_code  = pea_substr($_POST["grt_post_code"],5);
$grt_phone  = pea_substr($_POST["grt_phone"],15);
$grt_mobile  = pea_substr($_POST["grt_mobile"],15);
$grt_email  = pea_substr($_POST["grt_email"],50);
$grt_couple_name  = pea_substr($_POST["grt_couple_name"],250);
$grt_relation  = pea_substr($_POST["grt_relation"],50);
$hid_grt_id_card_file = $_POST["hid_grt_id_card_file"];
$hid_grt_cen_file = $_POST["hid_grt_cen_file"];
$hid_grt_file = $_POST["hid_grt_file"];

$complete_upload = 1;

if($_FILES['grt_id_card_file']['name'] != "" ){
			$temp = upload_file("grt_id_card_file","id_card");
			if($temp != "" and $temp != false){
			if($hid_grt_id_card_file != ""){
					@unlink("files/guarantee_data_file/$hid_grt_id_card_file");
				}
				$grt_id_card_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$grt_id_card_file = $hid_grt_id_card_file;
}


if($_FILES['grt_cen_file']['name'] != ""){
	$temp = upload_file("grt_cen_file","cen");
	if($temp != "" and $temp != false){
		if($hid_grt_cen_file != ""){
					@unlink("files/guarantee_data_file/$hid_grt_cen_file");
				}
		$grt_cen_file = $temp;
	}elseif($temp == false){
		$complete_upload = 0;
	}
}else{
	$grt_cen_file = $hid_grt_cen_file;
}


if($_FILES['grt_file']['name'] != ""){
	$temp = upload_file("grt_file","grt_file");
	if($temp != "" and $temp != false){
		if($hid_grt_file != ""){
					@unlink("files/guarantee_data_file/$hid_grt_file");
				}
		$grt_file = $temp;
	}elseif($temp == false){
		$complete_upload = 0;
	}
}else{
	$grt_file = $hid_grt_file;
}

if($complete_upload == 1){
	$numrow = $db->count_row(TB_GUARANTEE_TAB," WHERE EMP_ID = '$emp_id' ",$conn); 

	if($numrow == 0){
	$result=$db->add_db(TB_GUARANTEE_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "GRT_CONTRACT_NO"=>"$grt_contract_no",
											  "GRT_AT"=>"$grt_at",
											  "GRT_NAME"=>"$grt_name",
											  "GRT_UNIVERSITY"=>"$grt_university",
                                              "GRT_CONTRACT_TYPE"=>"$grt_contract_type",
											  "GRT_COUNTRY"=>"$grt_country",
											  "GRT_BY"=>"$grt_by",
											  "GRT_BIRTHDAY"=>"TO_DATE('$grt_birthday','YYYY-MM-DD')",
											  "GRT_OCCUPATION"=>"$grt_occupation",
											  "GRT_WORK_PLACE"=>"$grt_work_place",
											  "GRT_POSITION"=>"$grt_position",
											  "GRT_LEVEL"=>"$grt_level",
											  "GRT_IN"=>"$grt_in",
											  "GRT_SALARY"=>"$grt_salary",
											  "GRT_ID_TYPE"=>"$grt_id_type",
											  "GRT_ID_NO"=>"$grt_id_no",
											  "GRT_ID_FROM"=>"$grt_id_from",
											  "GRT_ID_DATE_BEGIN"=>"TO_DATE('$grt_id_date_begin','YYYY-MM-DD')",
											  "GRT_ID_DATE_EXP"=>"TO_DATE('$grt_id_date_exp','YYYY-MM-DD')",
											  "GRT_HOUSE_NO"=>"$grt_house_no",
											  "GRT_SOI"=>"$grt_soi",
											  "GRT_ROAD"=>"$grt_road",
											  "GRT_TUMBON"=>"$grt_tumbon",
											  "GRT_AMPHUR"=>"$grt_amphur",
											  "GRT_PROVINCE"=>"$grt_province",
											  "GRT_POST_CODE"=>"$grt_post_code",
											  "GRT_PHONE"=>"$grt_phone",
											  "GRT_MOBILE"=>"$grt_mobile",
											  "GRT_EMAIL"=>"$grt_email",
											  "GRT_COUPLE_NAME"=>"$grt_couple_name",
											  "GRT_RELATION"=>"$grt_relation",
											  "GRT_ID_CARD_FILE"=>"$grt_id_card_file",
											  "GRT_CEN_FILE"=>"$grt_cen_file",
											  "GRT_FILE"=>"$grt_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  
											  ),$conn); 
	$type_update = "1";
	}else{
		$result=$db->update_db(TB_GUARANTEE_TAB,array(
											  "GRT_CONTRACT_NO"=>"$grt_contract_no",
											  "GRT_AT"=>"$grt_at",
											  "GRT_NAME"=>"$grt_name",
											  "GRT_UNIVERSITY"=>"$grt_university",
                                              "GRT_CONTRACT_TYPE"=>"$grt_contract_type",
											  "GRT_COUNTRY"=>"$grt_country",
											  "GRT_BY"=>"$grt_by",
											  "GRT_BIRTHDAY"=>"TO_DATE('$grt_birthday','YYYY-MM-DD')",
											  "GRT_OCCUPATION"=>"$grt_occupation",
											  "GRT_WORK_PLACE"=>"$grt_work_place",
											  "GRT_POSITION"=>"$grt_position",
											  "GRT_LEVEL"=>"$grt_level",
											  "GRT_IN"=>"$grt_in",
											  "GRT_SALARY"=>"$grt_salary",
											  "GRT_ID_TYPE"=>"$grt_id_type",
											  "GRT_ID_NO"=>"$grt_id_no",
											  "GRT_ID_FROM"=>"$grt_id_from",
											  "GRT_ID_DATE_BEGIN"=>"TO_DATE('$grt_id_date_begin','YYYY-MM-DD')",
											  "GRT_ID_DATE_EXP"=>"TO_DATE('$grt_id_date_exp','YYYY-MM-DD')",
											  "GRT_HOUSE_NO"=>"$grt_house_no",
											  "GRT_SOI"=>"$grt_soi",
											  "GRT_ROAD"=>"$grt_road",
											  "GRT_TUMBON"=>"$grt_tumbon",
											  "GRT_AMPHUR"=>"$grt_amphur",
											  "GRT_PROVINCE"=>"$grt_province",
											  "GRT_POST_CODE"=>"$grt_post_code",
											  "GRT_PHONE"=>"$grt_phone",
											  "GRT_MOBILE"=>"$grt_mobile",
											  "GRT_EMAIL"=>"$grt_email",
											  "GRT_COUPLE_NAME"=>"$grt_couple_name",
											  "GRT_RELATION"=>"$grt_relation",
											  "GRT_ID_CARD_FILE"=>"$grt_id_card_file",
											  "GRT_CEN_FILE"=>"$grt_cen_file",
											  "GRT_FILE"=>"$grt_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"EMP_ID='$emp_id'",$conn);
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("guarantee_data");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูลผู้ค้ำประกัน' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูลผู้ค้ำประกัน' ($emp_id)");
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
	//reset_form_iframe("bio_data");
}
$db->closedb($conn);	
?>
<script language="javascript">
var ran=Math.random();
window.top.$("span#waiting").html("");
window.top.load_page("guarantee_data.php?"+ran);
</script>
<?
}
?>