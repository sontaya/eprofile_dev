<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
$cu_house_no = pea_substr(trim($_POST["cu_house_no"]),20);
$cu_moo = pea_substr(trim($_POST["cu_moo"]),5);
$cu_building = pea_substr(trim($_POST["cu_building"]),100);
$cu_village = pea_substr(trim($_POST["cu_village"]),50);
$cu_room = pea_substr($_POST["cu_room"],30);
$cu_soi = pea_substr($_POST["cu_soi"],50);
$cu_road = pea_substr($_POST["cu_road"],50);
$cu_tumbon = pea_substr(trim($_POST["cu_tumbon"]),100);
$cu_amphur = pea_substr(trim($_POST["cu_amphur"]),100);
$cu_province = pea_substr(trim($_POST["cu_province"]),100);
$cu_post_code  = pea_substr($_POST["cu_post_code"],5);
$cu_country  = pea_substr($_POST["cu_country"],150);

	$numrow = $db->count_row(TB_CURRENT_ADDRESS_TAB," WHERE EMP_ID = '$emp_id' ",$conn); 

if($numrow == 0){
		$result=$db->add_db(TB_CURRENT_ADDRESS_TAB,array(
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
		$result=$db->update_db(TB_CURRENT_ADDRESS_TAB,array(
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
			reset_form_iframe("current_address");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ที่อยู่ปัจจุบัน' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ที่อยู่ปัจจุบัน' ($emp_id)");
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
var ran=Math.random();
window.top.$("span#waiting").html("");
window.top.load_page("current_address.php?"+ran);
</script>
<?
}
?>