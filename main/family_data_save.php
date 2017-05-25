<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
function fam_($what){
	switch ($what){
	case "1": $t = "บิดา";	break;
	case "2": $t = "มารดา"; break;
	case "3": $t = "คู่สมรส";	break;
	}
	return $t;
}
function upload_file($name,$what){
	global $emp_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"]);
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="fam_{$emp_id}_".randpass(3)."($what).{$last}";
	$target_path = "files/fam_data_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}

$fam_relation =  $_POST["fam_relation"];
$fam_title_th = $_POST["fam_title_th"];
$fam_fname_th = pea_substr(trim($_POST["fam_fname_th"]),100);
$fam_mname_th = pea_substr(trim($_POST["fam_mname_th"]),100);
$fam_lname_th = pea_substr(trim($_POST["fam_lname_th"]),100);
$fam_title_en = $_POST["fam_title_en"];
$fam_fname_en = pea_substr(ucfirst(strtolower(trim($_POST["fam_fname_en"]))),100);
$fam_mname_en = pea_substr(ucfirst(strtolower(trim($_POST["fam_mname_en"]))),100);
$fam_lname_en = pea_substr(ucfirst(strtolower(trim($_POST["fam_lname_en"]))),100);
$fam_sex = $_POST["fam_sex"];
$fam_nation1 = pea_substr(trim($_POST["fam_nation1"]),150);
$fam_nation2 = pea_substr(trim($_POST["fam_nation2"]),150);
$fam_religion = pea_substr(trim($_POST["fam_religion"]),100);
$fam_birthday = date2_formatdb($_POST["fam_birthday"]);
$fam_alive = $_POST["fam_alive"];
//$fam_age = $_POST["fam_s_year"]."-".$_POST["fam_s_month"];
$fam_status = trim($_POST["fam_status"]);
$fam_code_id = pea_substr($_POST["fam_code_id"],13);
$fam_id_from = pea_substr(trim($_POST["fam_id_from"]),100);
$fam_id_from_p = pea_substr(trim($_POST["fam_id_from_p"]),100);
if($_POST["fam_id_date_begin"] != "") $fam_id_date_begin = date2_formatdb($_POST["fam_id_date_begin"]); else $fam_id_date_begin = "";
if($_POST["fam_id_date_exp"] != "") $fam_id_date_exp = date2_formatdb($_POST["fam_id_date_exp"]); else $fam_id_date_exp = "";
$fam_occupation = pea_substr(trim($_POST["fam_occupation"]),150);
$fam_work_place = pea_substr(trim($_POST["fam_work_place"]),250);
$fam_mobile = $_POST["fam_mobile"];
$fam_work_phone = $_POST["fam_work_phone"];
$fam_email = pea_substr(trim($_POST["fam_email"]),50);
$fam_house_no = pea_substr(trim($_POST["fam_house_no"]),20);
$fam_moo = pea_substr(trim($_POST["fam_moo"]),5);
$fam_building = pea_substr(trim($_POST["fam_building"]),100);
$fam_village = pea_substr(trim($_POST["fam_village"]),50);
$fam_room = pea_substr($_POST["fam_room"],30);
$fam_soi = pea_substr($_POST["fam_soi"],50);
$fam_road = pea_substr($_POST["fam_road"],50);
$fam_tumbon = pea_substr(trim($_POST["fam_tumbon"]),100);
$fam_amphur = pea_substr(trim($_POST["fam_amphur"]),100);
$fam_province = pea_substr(trim($_POST["fam_province"]),100);
$fam_post_code  = pea_substr($_POST["fam_post_code"],5);
$fam_country = pea_substr($_POST["fam_country"],150);
$fam_marriage_cer = $_POST["FAM_MARRIAGE_CER"];
$hid_fam_cen_file = $_POST["hid_fam_cen_file"];
$fam_phone = $_POST["fam_phone"];
$fam_fax = $_POST["fam_fax"];



$complete_upload = 1;

if($_FILES['fam_cen_file']['name'] != "" ){
			$temp = upload_file("fam_cen_file","cen_file");
			if($temp != "" and $temp != false){
			//if($hid_fam_cen_file != ""){
					@unlink("files/fam_data_file/$hid_fam_cen_file");
			//	}
				$fam_cen_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$fam_cen_file = $hid_fam_cen_file;
}


if($complete_upload == 1){
	$numrow = $db->count_row(TB_FAMILY_TAB," WHERE EMP_ID = '$emp_id' AND FAM_RELATION = '$fam_relation' ",$conn);

	if($numrow == 0 ){
	$result=$db->add_db(TB_FAMILY_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "FAM_RELATION"=>"$fam_relation",
											  "FAM_TITLE_TH"=>"$fam_title_th",
											  "FAM_FNAME_TH"=>"$fam_fname_th",
											  "FAM_MNAME_TH"=>"$fam_mname_th",
											  "FAM_LNAME_TH"=>"$fam_lname_th",
											  "FAM_TITLE_EN"=>"$fam_title_en",
											  "FAM_FNAME_EN"=>"$fam_fname_en",
											  "FAM_MNAME_EN"=>"$fam_mname_en",
											  "FAM_LNAME_EN"=>"$fam_lname_en",
											  "FAM_SEX"=>"$fam_sex",
											  "FAM_NATION1"=>"$fam_nation1",
											  "FAM_NATION2"=>"$fam_nation2",
											  "FAM_RELIGION"=>"$fam_religion",
											  "FAM_BIRTHDAY"=>"TO_DATE('$fam_birthday','YYYY-MM-DD')",
											  "FAM_STATUS"=>"$fam_status",
											  "FAM_CODE_ID"=>"$fam_code_id",
											  "FAM_ID_FROM"=>"$fam_id_from",
											  "FAM_ID_FROM_P"=>"$fam_id_from_p",
											  "FAM_ID_DATE_BEGIN"=>"TO_DATE('$fam_id_date_begin','YYYY-MM-DD')",
											  "FAM_ID_DATE_EXP"=>"TO_DATE('$fam_id_date_exp','YYYY-MM-DD')",
											  "FAM_OCCUPATION"=>"$fam_occupation",
											  "FAM_WORK_PLACE"=>"$fam_work_place",
											  "FAM_MOBILE"=>"$fam_mobile",
											  "FAM_WORK_PHONE"=>"$fam_work_phone",
											  "FAM_EMAIL"=>"$fam_email",
											  "FAM_HOUSE_NO"=>"$fam_house_no",
											  "FAM_MOO"=>"$fam_moo",
											  "FAM_BUILDING"=>"$fam_building",
											  "FAM_VILLAGE"=>"$fam_village",
											  "FAM_ROOM"=>"$fam_room",
											  "FAM_SOI"=>"$fam_soi",
											  "FAM_ROAD"=>"$fam_road",
											  "FAM_TUMBON"=>"$fam_tumbon",
											  "FAM_AMPHUR"=>"$fam_amphur",
											  "FAM_PROVINCE"=>"$fam_province",
											  "FAM_POST_CODE"=>"$fam_post_code",
											  "FAM_COUNTRY"=>"$fam_country",
											  "FAM_CEN_FILE"=>"$fam_cen_file",
											  "FAM_PHONE"=>"$fam_phone",
											  "FAM_FAX"=>"$fam_fax",
											  "FAM_ALIVE"=>"$fam_alive",
                                                                    "FAM_MARRIAGE_CER"=>"$fam_marriage_cer",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),$conn); 
	$type_update = "1";
	}else{
		$result=$db->update_db(TB_FAMILY_TAB,array(
											  "FAM_TITLE_TH"=>"$fam_title_th",
											  "FAM_FNAME_TH"=>"$fam_fname_th",
											  "FAM_MNAME_TH"=>"$fam_mname_th",
											  "FAM_LNAME_TH"=>"$fam_lname_th",
											  "FAM_TITLE_EN"=>"$fam_title_en",
											  "FAM_FNAME_EN"=>"$fam_fname_en",
											  "FAM_MNAME_EN"=>"$fam_mname_en",
											  "FAM_LNAME_EN"=>"$fam_lname_en",
											  "FAM_SEX"=>"$fam_sex",
											  "FAM_NATION1"=>"$fam_nation1",
											  "FAM_NATION2"=>"$fam_nation2",
											  "FAM_RELIGION"=>"$fam_religion",
											  "FAM_BIRTHDAY"=>"TO_DATE('$fam_birthday','YYYY-MM-DD')",
											  "FAM_STATUS"=>"$fam_status",
											  "FAM_CODE_ID"=>"$fam_code_id",
											  "FAM_ID_FROM"=>"$fam_id_from",
											  "FAM_ID_FROM_P"=>"$fam_id_from_p",
											  "FAM_ID_DATE_BEGIN"=>"TO_DATE('$fam_id_date_begin','YYYY-MM-DD')",
											  "FAM_ID_DATE_EXP"=>"TO_DATE('$fam_id_date_exp','YYYY-MM-DD')",
											  "FAM_OCCUPATION"=>"$fam_occupation",
											  "FAM_WORK_PLACE"=>"$fam_work_place",
											  "FAM_MOBILE"=>"$fam_mobile",
											  "FAM_WORK_PHONE"=>"$fam_work_phone",
											  "FAM_EMAIL"=>"$fam_email",
											  "FAM_HOUSE_NO"=>"$fam_house_no",
											  "FAM_MOO"=>"$fam_moo",
											  "FAM_BUILDING"=>"$fam_building",
											  "FAM_VILLAGE"=>"$fam_village",
											  "FAM_ROOM"=>"$fam_room",
											  "FAM_SOI"=>"$fam_soi",
											  "FAM_ROAD"=>"$fam_road",
											  "FAM_TUMBON"=>"$fam_tumbon",
											  "FAM_AMPHUR"=>"$fam_amphur",
											  "FAM_PROVINCE"=>"$fam_province",
											  "FAM_POST_CODE"=>"$fam_post_code",
											  "FAM_COUNTRY"=>"$fam_country",
											  "FAM_CEN_FILE"=>"$fam_cen_file",
											  "FAM_PHONE"=>"$fam_phone",
											  "FAM_FAX"=>"$fam_fax",
											  "FAM_ALIVE"=>"$fam_alive",
                                                                    "FAM_MARRIAGE_CER"=>"$fam_marriage_cer",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"EMP_ID='$emp_id' AND FAM_RELATION = '$fam_relation'",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("family_data");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูล ".fam_($fam_relation)."' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูล ".fam_($fam_relation)."' ($emp_id)");
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
	//reset_form_iframe("fam_data");
}
$db->closedb($conn);	
?>
<script language="javascript">
//var ran=Math.random();
window.top.change_data('family_data.php','../images/head2/bio/family.png');
/*window.top.$("span#waiting").html("");
window.top.load_fam_table();*/
window.top.document.family_data.fam_code_id.readOnly="";
</script>
<?
}
?>