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
	$file_name="chl_{$emp_id}_".randpass(3)."($what).{$last}";
	$target_path = "files/chl_data_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}

$chl_relation =  $_POST["chl_relation"];
$chl_title_th = $_POST["chl_title_th"];
$chl_fname_th = pea_substr(trim($_POST["chl_fname_th"]),100);
$chl_mname_th = pea_substr(trim($_POST["chl_mname_th"]),100);
$chl_lname_th = pea_substr(trim($_POST["chl_lname_th"]),100);
$chl_title_en = $_POST["chl_title_en"];
$chl_fname_en = pea_substr(ucfirst(strtolower(trim($_POST["chl_fname_en"]))),100);
$chl_mname_en = pea_substr(ucfirst(strtolower(trim($_POST["chl_mname_en"]))),100);
$chl_lname_en = pea_substr(ucfirst(strtolower(trim($_POST["chl_lname_en"]))),100);
$chl_sex = $_POST["chl_sex"];
$chl_nation1 = pea_substr(trim($_POST["chl_nation1"]),150);
$chl_nation2 = pea_substr(trim($_POST["chl_nation2"]),150);
$chl_religion = pea_substr(trim($_POST["chl_religion"]),100);
$chl_birthday = date2_formatdb($_POST["chl_birthday"]);
$chl_alive = $_POST["chl_alive"];
$chl_school = pea_substr(trim($_POST["chl_school"]),150);
$chl_sch_amphur = pea_substr(trim($_POST["chl_sch_amphur"]),150);
$chl_sch_province = pea_substr(trim($_POST["chl_sch_province"]),150);
$chl_sch_level = pea_substr(trim($_POST["chl_sch_level"]),150);
//$chl_status = pea_substr(trim($_POST["chl_status"]),100);
$chl_code_id = $_POST["chl_code_id"];
$chl_occupation = pea_substr(trim($_POST["chl_occupation"]),150);
$chl_work_place = pea_substr(trim($_POST["chl_work_place"]),250);
$chl_mobile = $_POST["chl_mobile"];
$chl_work_phone = $_POST["chl_work_phone"];
$chl_email = pea_substr(trim($_POST["chl_email"]),50);
$chl_house_no = pea_substr(trim($_POST["chl_house_no"]),20);
$chl_moo = pea_substr(trim($_POST["chl_moo"]),5);
$chl_building = pea_substr(trim($_POST["chl_building"]),100);
$chl_village = pea_substr(trim($_POST["chl_village"]),50);
$chl_room = pea_substr($_POST["chl_room"],30);
$chl_soi = pea_substr($_POST["chl_soi"],50);
$chl_road = pea_substr($_POST["chl_road"],50);
$chl_tumbon = pea_substr(trim($_POST["chl_tumbon"]),100);
$chl_amphur = pea_substr(trim($_POST["chl_amphur"]),100);
$chl_province = pea_substr(trim($_POST["chl_province"]),100);
$chl_post_code  = pea_substr($_POST["chl_post_code"],5);
$chl_country = pea_substr($_POST["chl_country"],150);
$hid_chl_cen_file = $_POST["hid_chl_cen_file"];
$chl_phone = $_POST["chl_phone"];
$chl_fax = $_POST["chl_fax"];

$complete_upload = 1;

if($_FILES['chl_cen_file']['name'] != "" ){
			$temp = upload_file("chl_cen_file","cen_file");
			if($temp != "" and $temp != false){
			//if($hid_chl_cen_file != ""){
					@unlink("files/chl_data_file/$hid_chl_cen_file");
			//	}
				$chl_cen_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$chl_cen_file = $hid_chl_cen_file;
}


if($complete_upload == 1){
	$numrow = $db->count_row(TB_CHILDREN_TAB," WHERE EMP_ID = '$emp_id' AND CHL_CODE_ID = '$chl_code_id' ",$conn);

	if($numrow == 0 ){
	$result=$db->add_db(TB_CHILDREN_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "CHL_TITLE_TH"=>"$chl_title_th",
											  "CHL_FNAME_TH"=>"$chl_fname_th",
											  "CHL_MNAME_TH"=>"$chl_mname_th",
											  "CHL_LNAME_TH"=>"$chl_lname_th",
											  "CHL_TITLE_EN"=>"$chl_title_en",
											  "CHL_FNAME_EN"=>"$chl_fname_en",
											  "CHL_MNAME_EN"=>"$chl_mname_en",
											  "CHL_LNAME_EN"=>"$chl_lname_en",
											  "CHL_SEX"=>"$chl_sex",
											  "CHL_NATION1"=>"$chl_nation1",
											  "CHL_NATION2"=>"$chl_nation2",
											  "CHL_RELIGION"=>"$chl_religion",
											  "CHL_BIRTHDAY"=>"TO_DATE('$chl_birthday','YYYY-MM-DD')",
											  "CHL_ALIVE"=>"$chl_alive",
											  "CHL_SCHOOL"=>"$chl_school",
											  "CHL_SCH_AMPHUR"=>"$chl_sch_amphur",
											  "CHL_SCH_PROVINCE"=>"$chl_sch_province",
											  "CHL_SCH_LEVEL"=>"$chl_sch_level",
											  "CHL_CODE_ID"=>"$chl_code_id",
											  "CHL_RELATION"=>"$chl_relation",
											  "CHL_OCCUPATION"=>"$chl_occupation",
											  "CHL_WORK_PLACE"=>"$chl_work_place",
											  "CHL_MOBILE"=>"$chl_mobile",
											  "CHL_WORK_PHONE"=>"$chl_work_phone",
											  "CHL_EMAIL"=>"$chl_email",
											  "CHL_HOUSE_NO"=>"$chl_house_no",
											  "CHL_MOO"=>"$chl_moo",
											  "CHL_BUILDING"=>"$chl_building",
											  "CHL_VILLAGE"=>"$chl_village",
											  "CHL_ROOM"=>"$chl_room",
											  "CHL_SOI"=>"$chl_soi",
											  "CHL_ROAD"=>"$chl_road",
											  "CHL_TUMBON"=>"$chl_tumbon",
											  "CHL_AMPHUR"=>"$chl_amphur",
											  "CHL_PROVINCE"=>"$chl_province",
											  "CHL_POST_CODE"=>"$chl_post_code",
											  "CHL_COUNTRY"=>"$chl_country",
											  "CHL_CEN_FILE"=>"$chl_cen_file",
											  "CHL_PHONE"=>"$chl_phone",
											  "CHL_FAX"=>"$chl_fax",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"	  
					  ),$conn); 
	$type_update = "1";
	}else{
		$result=$db->update_db(TB_CHILDREN_TAB,array(
											  "CHL_TITLE_TH"=>"$chl_title_th",
											  "CHL_FNAME_TH"=>"$chl_fname_th",
											  "CHL_MNAME_TH"=>"$chl_mname_th",
											  "CHL_LNAME_TH"=>"$chl_lname_th",
											  "CHL_TITLE_EN"=>"$chl_title_en",
											  "CHL_FNAME_EN"=>"$chl_fname_en",
											  "CHL_MNAME_EN"=>"$chl_mname_en",
											  "CHL_LNAME_EN"=>"$chl_lname_en",
											  "CHL_SEX"=>"$chl_sex",
											  "CHL_NATION1"=>"$chl_nation1",
											  "CHL_NATION2"=>"$chl_nation2",
											  "CHL_RELIGION"=>"$chl_religion",
											  "CHL_BIRTHDAY"=>"TO_DATE('$chl_birthday','YYYY-MM-DD')",
											  "CHL_ALIVE"=>"$chl_alive",
											  "CHL_SCHOOL"=>"$chl_school",
											  "CHL_SCH_AMPHUR"=>"$chl_sch_amphur",
											  "CHL_SCH_PROVINCE"=>"$chl_sch_province",
											  "CHL_SCH_LEVEL"=>"$chl_sch_level",
											  "CHL_RELATION"=>"$chl_relation",
											  "CHL_OCCUPATION"=>"$chl_occupation",
											  "CHL_WORK_PLACE"=>"$chl_work_place",
											  "CHL_MOBILE"=>"$chl_mobile",
											  "CHL_WORK_PHONE"=>"$chl_work_phone",
											  "CHL_EMAIL"=>"$chl_email",
											  "CHL_HOUSE_NO"=>"$chl_house_no",
											  "CHL_MOO"=>"$chl_moo",
											  "CHL_BUILDING"=>"$chl_building",
											  "CHL_VILLAGE"=>"$chl_village",
											  "CHL_ROOM"=>"$chl_room",
											  "CHL_SOI"=>"$chl_soi",
											  "CHL_ROAD"=>"$chl_road",
											  "CHL_TUMBON"=>"$chl_tumbon",
											  "CHL_AMPHUR"=>"$chl_amphur",
											  "CHL_PROVINCE"=>"$chl_province",
											  "CHL_POST_CODE"=>"$chl_post_code",
											  "CHL_COUNTRY"=>"$chl_country",
											  "CHL_CEN_FILE"=>"$chl_cen_file",
											  "CHL_PHONE"=>"$chl_phone",
											  "CHL_FAX"=>"$chl_fax",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"	  
					  ),"EMP_ID='$emp_id' AND CHL_CODE_ID = '$chl_code_id' ",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("children_data");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูลบุตร $chl_code_id' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูลบุตร $chl_code_id' ($emp_id)");
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
$db->closedb($conn);	
?>
<script language="javascript">
//var ran=Math.random();
window.top.change_data('children_data.php','../images/head2/bio/children.png');
/*window.top.$("span#waiting").html("");
window.top.load_chl_table();*/
window.top.document.children_data.chl_code_id.readOnly="";
</script>
<?
}
?>