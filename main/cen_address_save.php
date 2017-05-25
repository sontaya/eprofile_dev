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
	$file_name="ca_{$emp_id}_".randpass(3)."($what).{$last}";
	$target_path = "files/ca_data_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}

$ca_house_no = pea_substr(trim($_POST["ca_house_no"]),20);
$ca_moo = pea_substr(trim($_POST["ca_moo"]),5); if($ca_moo==""){$ca_moo="-";}else{$ca_moo;};
$ca_building = pea_substr(trim($_POST["ca_building"]),100); if($ca_building==""){$ca_building="-";}else{$ca_building;};
$ca_village = pea_substr(trim($_POST["ca_village"]),50); if($ca_village==""){$ca_village="-";}else{$ca_village;};
$ca_room = pea_substr($_POST["ca_room"],30);if($ca_room==""){$ca_room="-";}else{$ca_room;};
$ca_soi = pea_substr($_POST["ca_soi"],50);if($ca_soi==""){$ca_soi="-";}else{$ca_soi;};
$ca_road = pea_substr($_POST["ca_road"],50);if($ca_road==""){$ca_road="-";}else{$ca_road;};
$ca_tumbon = pea_substr(trim($_POST["ca_tumbon"]),100);if($ca_tumbon==""){$ca_tumbon="-";}else{$ca_tumbon;};
$ca_amphur = pea_substr(trim($_POST["ca_amphur"]),100); if($ca_amphur==""){$ca_amphur="-";}else{$ca_amphur;};
$ca_province = pea_substr(trim($_POST["ca_province"]),100); if($ca_province==""){$ca_province="-";}else{$ca_province;};
$ca_post_code  = pea_substr($_POST["ca_post_code"],5);
echo $ca_country  = pea_substr($_POST["ca_country"],150);
$hid_ca_cen_file = $_POST["hid_ca_cen_file"];

$cu_house_no = pea_substr(trim($_POST["cu_house_no"]),20);
$cu_moo = pea_substr(trim($_POST["cu_moo"]),5);  if($cu_moo==""){$cu_moo="-";}else{$cu_moo;};
$cu_building = pea_substr(trim($_POST["cu_building"]),100);  if($cu_building==""){$cu_building="-";}else{$cu_building;};
$cu_village = pea_substr(trim($_POST["cu_village"]),50);  if($cu_village==""){$cu_village="-";}else{$cu_village;};
$cu_room = pea_substr($_POST["cu_room"],30);  if($cu_room==""){$cu_room="-";}else{$cu_room;};
$cu_soi = pea_substr($_POST["cu_soi"],50);  if($cu_soi==""){$cu_soi="-";}else{$cu_soi;};
$cu_road = pea_substr($_POST["cu_road"],50);  if($cu_road==""){$cu_road="-";}else{$cu_road;};
$cu_tumbon = pea_substr(trim($_POST["cu_tumbon"]),100);  if($cu_tumbon==""){$cu_tumbon="-";}else{$cu_tumbon;};
$cu_amphur = pea_substr(trim($_POST["cu_amphur"]),100); if($cu_amphur==""){$cu_amphur="-";}else{$cu_amphur;};
$cu_province = pea_substr(trim($_POST["cu_province"]),100);  if($cu_province==""){$cu_province="-";}else{$cu_province;};
$cu_post_code  = pea_substr($_POST["cu_post_code"],5);
echo $cu_country  = pea_substr($_POST["cu_country"],150);



$complete_upload = 1;

if($_FILES['ca_cen_file']['name'] != "" ){
			$temp = upload_file("ca_cen_file","cen_file");
			if($temp != "" and $temp != false){
				@unlink("files/ca_data_file/$hid_ca_cen_file");
				$ca_cen_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$ca_cen_file = $hid_ca_cen_file;
}

if($complete_upload == 1){
	$numrow = $db->count_row(TB_CEN_ADDRESS_TAB," WHERE EMP_ID = '$emp_id'",$conn); 
	if($numrow == 0){
	$result=$db->add_db(TB_CEN_ADDRESS_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "CA_HOUSE_NO"=>"$ca_house_no",
											  "CA_MOO"=>"$ca_moo",
											  "CA_BUILDING"=>"$ca_building",
											  "CA_VILLAGE"=>"$ca_village",
											  "CA_ROOM"=>"$ca_room",
											  "CA_SOI"=>"$ca_soi",
											  "CA_ROAD"=>"$ca_road",
											  "CA_TUMBON"=>"$ca_tumbon",
											  "CA_AMPHUR"=>"$ca_amphur",
											  "CA_PROVINCE"=>"$ca_province",
											  "CA_POST_CODE"=>"$ca_post_code",
											  "CA_CEN_FILE"=>"$ca_cen_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user",											  
											  "CA_COUNTRY"=>"$ca_country"),$conn); 
	
	$db->add_db(TB_CURRENT_ADDRESS_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "CU_HOUSE_NO"=>"$cu_house_no",
											  "CU_MOO"=>"$cu_moo",
											  "CU_BUILDING"=>"$cu_building",
											  "CU_VILLAGE"=>"$cu_village",
											  "CU_ROOM"=>"$cu_room",
											  "CU_SOI"=>"$cu_soi",
											  "CU_ROAD"=>"$cu_road",
											  "CU_TUMBON"=>"$cu_tumbon",
											  "CU_AMPHUR"=>"$cu_amphur",
											  "CU_PROVINCE"=>"$cu_province",
											  "CU_POST_CODE"=>"$cu_post_code",
											  "CU_COUNTRY"=>"$cu_country",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
	$type_update = "1";
	}else{
		$result=$db->update_db(TB_CEN_ADDRESS_TAB,array(
											  "CA_HOUSE_NO"=>"$ca_house_no",
											  "CA_MOO"=>"$ca_moo",
											  "CA_BUILDING"=>"$ca_building",
											  "CA_VILLAGE"=>"$ca_village",
											  "CA_ROOM"=>"$ca_room",
											  "CA_SOI"=>"$ca_soi",
											  "CA_ROAD"=>"$ca_road",
											  "CA_TUMBON"=>"$ca_tumbon",
											  "CA_AMPHUR"=>"$ca_amphur",
											  "CA_PROVINCE"=>"$ca_province",
											  "CA_POST_CODE"=>"$ca_post_code",
											  "CA_CEN_FILE"=>"$ca_cen_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user",	 
											  "CA_COUNTRY"=>"$ca_country"
					  ),"EMP_ID='$emp_id'",$conn); 
		$db->update_db(TB_CURRENT_ADDRESS_TAB,array(
											  "CU_HOUSE_NO"=>"$cu_house_no",
											  "CU_MOO"=>"$cu_moo",
											  "CU_BUILDING"=>"$cu_building",
											  "CU_VILLAGE"=>"$cu_village",
											  "CU_ROOM"=>"$cu_room",
											  "CU_SOI"=>"$cu_soi",
											  "CU_ROAD"=>"$cu_road",
											  "CU_TUMBON"=>"$cu_tumbon",
											  "CU_AMPHUR"=>"$cu_amphur",
											  "CU_PROVINCE"=>"$cu_province",
											  "CU_POST_CODE"=>"$cu_post_code",
											  "CU_COUNTRY"=>"$cu_country",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"	  
					  ),"EMP_ID='$emp_id'",$conn); 
		
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			reset_form_iframe("cen_address");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ที่อยู่' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ที่อยู่' ($emp_id)");
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
var ran=Math.random();
window.top.$("span#waiting").html("");
window.top.load_page("cen_address.php?"+ran);
</script>
<?
}
?>