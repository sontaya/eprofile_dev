<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
function pos_name($main,$sub){
	if($main == "1"){
		switch ($sub){
		case "1": $t = "ผู้ช่วยศาสตราจารย์"; break;	
		case "2": $t = "ผู้ช่วยศาสตราจารย์พิเศษ"; break;	
		}
	}elseif($main == "2"){
		switch ($sub){
		case "1": $t = "รองศาสตราจารย์"; break;	
		case "2": $t = "รองศาสตราจารย์พิเศษ"; break;	
		}
	}
	elseif($main == "3"){
		switch ($sub){
		case "1": $t = "ศาสตราจารย์"; break;	
		case "2": $t = "ศาสตราจารย์พิเศษ"; break;	
		}
	}
	elseif($main == "4"){
		$t = "ศาสตราจารย์ 11";
	}
	return $t;
}
$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
$vp_type = $_POST["vp_type"];
$vp_sub_type = $_POST["vp_sub_type".$vp_type];
$vp_method = $_POST["vp_method".$vp_type];
$vp_by = $_POST["vp_by".$vp_type];
$vp_university = pea_substr(trim($_POST["vp_university".$vp_type]),100);
$vp_professional_major = pea_substr(trim($_POST["vp_professional_major".$vp_type]),250);
$vp_date = date2_formatdb($_POST["vp_date".$vp_type]);
$vp_order = pea_substr(trim($_POST["vp_order".$vp_type]),100);
$vp_order_date = date2_formatdb($_POST["vp_order_date".$vp_type]);
$vp_mati_1 = $_POST["vp_mati_1".$vp_type];
$vp_mati_2 = date2_formatdb($_POST["vp_mati_2".$vp_type]);

$numrow = $db->count_row(TB_VCHARKARN_POSITION_TAB," WHERE EMP_ID = '$emp_id' AND VP_TYPE = '$vp_type' ",$conn);

	if($numrow == 0 ){
		$result=$db->add_db(TB_VCHARKARN_POSITION_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "VP_TYPE"=>"$vp_type",
											  "VP_SUB_TYPE"=>"$vp_sub_type",
											  "VP_METHOD"=>"$vp_method",
											  "VP_BY"=>"$vp_by",
											  "VP_UNIVERSITY"=>"$vp_university",
											  "VP_PROFESSIONAL_MAJOR"=>"$vp_professional_major",
                                                                    "VP_DATE"=>"TO_DATE('$vp_date','YYYY-MM-DD')",                                                                  "VP_ORDER"=>"$vp_order",
											  "VP_ORDER_DATE"=>"TO_DATE('$vp_order_date','YYYY-MM-DD')",
											  "VP_MATI_1"=>"$vp_mati_1",
											  "VP_MATI_2"=>"TO_DATE('$vp_mati_2','YYYY-MM-DD')",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
		$type_update = "1";
	
	
	}else{
		$result=$db->update_db(TB_VCHARKARN_POSITION_TAB,array(
											 "VP_SUB_TYPE"=>"$vp_sub_type",
											  "VP_METHOD"=>"$vp_method",
											  "VP_BY"=>"$vp_by",
											  "VP_UNIVERSITY"=>"$vp_university",
											  "VP_PROFESSIONAL_MAJOR"=>"$vp_professional_major",
											  "VP_DATE"=>"TO_DATE('$vp_date','YYYY-MM-DD')",
                                                                    "VP_ORDER"=>"$vp_order",
											  "VP_ORDER_DATE"=>"TO_DATE('$vp_order_date','YYYY-MM-DD')",
											  "VP_MATI_1"=>"$vp_mati_1",
											  "VP_MATI_2"=>"TO_DATE('$vp_mati_2','YYYY-MM-DD')",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),"EMP_ID='$emp_id' AND VP_TYPE = '$vp_type'",$conn); 
		$type_update = "2";
	}
	$db->closedb($conn);	
		if($result){
			//save_completed("Save_success");
			?>
			<script language="javascript">
			window.top.load_pos_list(<?=$vp_type?>);
			</script>
			<?
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ตำแหน่ง ".pos_name($vp_type,$vp_sub_type)."' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ตำแหน่ง ".pos_name($vp_type,$vp_sub_type)."' ($emp_id)");
		}else{
			save_completed("Save_error");
?>
<script language="javascript">
window.top.$("span#waiting"+"<?=$vp_type?>").html("");
</script>
<?
exit();
		}



?>
<script language="javascript">
window.top.$("span#waiting"+"<?=$vp_type?>").html("");
</script>
<?
}
?>