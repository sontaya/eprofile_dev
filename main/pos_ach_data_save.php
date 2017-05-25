<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");

$emp_id = $_SESSION["EMP_ID"];
include "update_by.php";
$position_type = $_POST["page"];
$id = $_POST["id"];
$what_form =  $_POST["what_form"];
function ach_name($what){
	switch ($what){
		case "1": $t = "เอกสารประกอบการสอน"; break;
		case "2": $t = "ตำรา"; break;
		case "3": $t = "หนังสือ"; break;
		case "4": $t = "ผลงานวิจัย"; break;
		case "5": $t = "บทความ"; break;
		case "6": $t = "ผลงานวิชาการลักษณะอื่นๆ"; break;
	}
	return $t;
}

function pos_name($what){
	switch ($what){
		case "1": $t = "ผู้ช่วยศาสตราจารย์/ผู้ช่วยศาสตราจารย์พิเศษ"; break;
		case "2": $t = "รองศาสตราจารย์/รองศาสตราจารย์พิเศษ"; break;
		case "3": $t = "ศาสตราจารย์/ศาสตราจารย์พิเศษ"; break;
		//case "4": $t = "ศาสตราจารย์ 11"; break;
	}
	return $t;
}
////////////////เอกสารประกอบการสอน////////////////////////
if($what_form == "1"){
	$course_name = pea_substr(trim($_POST["course_name"]),150);
	$course_year = $_POST["course_year"];
	$type = $_POST["type"];
	$coop = "";
	$proportion = "";
	if($type == "2"){
		$coop = $_POST["coop"];
		$proportion = $_POST["proportion"];
	}
	if($id == "" or $id == null){
		$new_id = auto_increment("ID",TB_VCHARKARN_ACH1_TAB);
		$result=$db->add_db(TB_VCHARKARN_ACH1_TAB,array(
											  "ID" => "$new_id",
 											  "EMP_ID"=>"$emp_id",
											  "POSITION_TYPE"=>"$position_type",
											  "COURSE_NAME"=>"$course_name",
											  "COURSE_YEAR"=>"$course_year",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
	
	$type_update = "1";
	}else{
		$result=$db->update_db(TB_VCHARKARN_ACH1_TAB,array(
											  "COURSE_NAME"=>"$course_name",
											  "COURSE_YEAR"=>"$course_year",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),"ID = '$id'",$conn); 
		$type_update = "2";
	}
////////////////ตำรา////////////////////////	
}elseif($what_form == "2"){
	$tbook_name_th = pea_substr(trim($_POST["tbook_name_th"]),150);
	$tbook_name_en = pea_substr(trim($_POST["tbook_name_en"]),150);
	$tbook_name_oth = pea_substr(trim($_POST["tbook_name_oth"]),150);
	$tbook_name_oth2 = pea_substr(trim($_POST["tbook_name_oth2"]),150);
	$course_name = pea_substr(trim($_POST["course_name"]),150);
	$edition = pea_substr(trim($_POST["edition"]),50);
	$volume = pea_substr(trim($_POST["volume"]),50);
	$press_name = pea_substr(trim($_POST["press_name"]),150);
	$press_country = pea_substr(trim($_POST["press_country"]),150);
	$press_year = $_POST["press_year"];
	$type = $_POST["type"];
	$coop = "";
	$proportion = "";
	if($type == "2"){
		$coop = $_POST["coop"];
		$proportion = $_POST["proportion"];
	}
	if($id == "" or $id == null){
		$new_id = auto_increment("ID",TB_VCHARKARN_ACH2_TAB);
		$result=$db->add_db(TB_VCHARKARN_ACH2_TAB,array(
											  "ID" => "$new_id",
 											  "EMP_ID"=>"$emp_id",
											  "POSITION_TYPE"=>"$position_type",
											  "TBOOK_NAME_TH"=>"$tbook_name_th",
											  "TBOOK_NAME_EN"=>"$tbook_name_en",
											  "TBOOK_NAME_OTH"=>"$tbook_name_oth",
											  "TBOOK_NAME_OTH2"=>"$tbook_name_oth2",
											  "COURSE_NAME"=>"$course_name",
											  "EDITION"=>"$edition",
											  "VOLUME"=>"$volume",
											  "PRESS_NAME"=>"$press_name",
											  "PRESS_COUNTRY"=>"$press_country",
											  "PRESS_YEAR"=>"$press_year",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
		$type_update = "1";
	
	
	}else{
		$result=$db->update_db(TB_VCHARKARN_ACH2_TAB,array(
											  "TBOOK_NAME_TH"=>"$tbook_name_th",
											  "TBOOK_NAME_EN"=>"$tbook_name_en",
											  "TBOOK_NAME_OTH"=>"$tbook_name_oth",
											  "TBOOK_NAME_OTH2"=>"$tbook_name_oth2",
											  "COURSE_NAME"=>"$course_name",
											  "EDITION"=>"$edition",
											  "VOLUME"=>"$volume",
											  "PRESS_NAME"=>"$press_name",
											  "PRESS_COUNTRY"=>"$press_country",
											  "PRESS_YEAR"=>"$press_year",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),"ID = '$id'",$conn); 
		$type_update = "2";
	}
////////////////หนังสือ////////////////////////			
}elseif($what_form == "3"){
	$book_name_th = pea_substr(trim($_POST["book_name_th"]),150);
	$book_name_en = pea_substr(trim($_POST["book_name_en"]),150);
	$book_name_oth = pea_substr(trim($_POST["book_name_oth"]),150);
	$book_name_oth2 = pea_substr(trim($_POST["book_name_oth2"]),150);
	$edition = pea_substr(trim($_POST["edition"]),50);
	$volume = pea_substr(trim($_POST["volume"]),50);
	$press_name = pea_substr(trim($_POST["press_name"]),150);
	$press_country = pea_substr(trim($_POST["press_country"]),150);
	$press_year = $_POST["press_year"];
	$type = $_POST["type"];
	$coop = "";
	$proportion = "";
	if($type == "2"){
		$coop = $_POST["coop"];
		$proportion = $_POST["proportion"];
	}
	if($id == "" or $id == null){
		$new_id = auto_increment("ID",TB_VCHARKARN_ACH3_TAB);
		$result=$db->add_db(TB_VCHARKARN_ACH3_TAB,array(
											  "ID" => "$new_id",
 											  "EMP_ID"=>"$emp_id",
											  "POSITION_TYPE"=>"$position_type",
											  "BOOK_NAME_TH"=>"$book_name_th",
											  "BOOK_NAME_EN"=>"$book_name_en",
											  "BOOK_NAME_OTH"=>"$book_name_oth",
											  "BOOK_NAME_OTH2"=>"$book_name_oth2",
											  "EDITION"=>"$edition",
											  "VOLUME"=>"$volume",
											  "PRESS_NAME"=>"$press_name",
											  "PRESS_COUNTRY"=>"$press_country",
											  "PRESS_YEAR"=>"$press_year",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
	$type_update = "1";
	
	}else{
		$result=$db->update_db(TB_VCHARKARN_ACH3_TAB,array(
											  "BOOK_NAME_TH"=>"$book_name_th",
											  "BOOK_NAME_EN"=>"$book_name_en",
											  "BOOK_NAME_OTH"=>"$book_name_oth",
											  "BOOK_NAME_OTH2"=>"$book_name_oth2",
											  "EDITION"=>"$edition",
											  "VOLUME"=>"$volume",
											  "PRESS_NAME"=>"$press_name",
											  "PRESS_COUNTRY"=>"$press_country",
											  "PRESS_YEAR"=>"$press_year",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),"ID = '$id'",$conn); 
		$type_update = "2";
	}	
////////////////ผลงานวิจัย////////////////////////				
}elseif($what_form == "4"){
	$research_name_th = pea_substr(trim($_POST["research_name_th"]),150);
	$research_name_en = pea_substr(trim($_POST["research_name_en"]),150);
	$research_name_oth = pea_substr(trim($_POST["research_name_oth"]),150);
	$research_name_oth2 = pea_substr(trim($_POST["research_name_oth2"]),150);
	$research_name2_th = pea_substr(trim($_POST["research_name2_th"]),150);
	$research_name2_en = pea_substr(trim($_POST["research_name2_en"]),150);
	$research_name2_oth = pea_substr(trim($_POST["research_name2_oth"]),150);
	$research_name2_oth2 = pea_substr(trim($_POST["research_name2_oth2"]),150);
	$writer = pea_substr(trim($_POST["writer"]),250);
	$type = $_POST["type"];
	$coop = "";
	$proportion = "";
	if($type == "2"){
		$coop = $_POST["coop"];
		$proportion = $_POST["proportion"];
	}
	$distribute_level = $_POST["distribute_level"];
	$journal_name = pea_substr(trim($_POST["journal_name"]),150);
	$v_i_n_p = pea_substr(trim($_POST["v_i_n_p"]),150);
	$press_year = $_POST["press_year"];
	$meeting_distribute_level = $_POST["meeting_distribute_level"];
	$meeting_name = pea_substr(trim($_POST["meeting_name"]),150);
	$meeting_country = pea_substr(trim($_POST["meeting_country"]),150);
	$meeting_month = $_POST["meeting_month"];
	$meeting_year = $_POST["meeting_year"];
	if($id == "" or $id == null){
		$new_id = auto_increment("ID",TB_VCHARKARN_ACH4_TAB);
		$result=$db->add_db(TB_VCHARKARN_ACH4_TAB,array(
											  "ID" => "$new_id",
 											  "EMP_ID"=>"$emp_id",
											  "POSITION_TYPE"=>"$position_type",
											  "RESEARCH_NAME_TH"=>"$research_name_th",
											  "RESEARCH_NAME_EN"=>"$research_name_en",
											  "RESEARCH_NAME_OTH"=>"$research_name_oth",
											  "RESEARCH_NAME_OTH2"=>"$research_name_oth2",
											  "RESEARCH_NAME2_TH"=>"$research_name2_th",
											  "RESEARCH_NAME2_EN"=>"$research_name2_en",
											  "RESEARCH_NAME2_OTH"=>"$research_name2_oth",
											  "RESEARCH_NAME2_OTH2"=>"$research_name2_oth2",
											  "WRITER"=>"$writer",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "DISTRIBUTE_LEVEL"=>"$distribute_level",
											  "JOURNAL_NAME"=>"$journal_name",
											  "V_I_N_P"=>"$v_i_n_p",
											  "PRESS_YEAR"=>"$press_year",
											  "MEETING_DISTRIBUTE_LEVEL"=>"$meeting_distribute_level",
											  "MEETING_NAME"=>"$meeting_name",
											  "MEETING_COUNTRY"=>"$meeting_country",
											  "MEETING_MONTH"=>"$meeting_month",
											  "MEETING_YEAR"=>"$meeting_year",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
	$type_update = "1";
	}else{
		$result=$db->update_db(TB_VCHARKARN_ACH4_TAB,array(
											  "RESEARCH_NAME_TH"=>"$research_name_th",
											  "RESEARCH_NAME_EN"=>"$research_name_en",
											  "RESEARCH_NAME_OTH"=>"$research_name_oth",
											  "RESEARCH_NAME_OTH2"=>"$research_name_oth2",
											  "RESEARCH_NAME2_TH"=>"$research_name2_th",
											  "RESEARCH_NAME2_EN"=>"$research_name2_en",
											  "RESEARCH_NAME2_OTH"=>"$research_name2_oth",
											  "RESEARCH_NAME2_OTH2"=>"$research_name2_oth2",
											  "WRITER"=>"$writer",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "DISTRIBUTE_LEVEL"=>"$distribute_level",
											  "JOURNAL_NAME"=>"$journal_name",
											  "V_I_N_P"=>"$v_i_n_p",
											  "PRESS_YEAR"=>"$press_year",
											  "MEETING_DISTRIBUTE_LEVEL"=>"$meeting_distribute_level",
											  "MEETING_NAME"=>"$meeting_name",
											  "MEETING_COUNTRY"=>"$meeting_country",
											  "MEETING_MONTH"=>"$meeting_month",
											  "MEETING_YEAR"=>"$meeting_year",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),"ID = '$id'",$conn); 
		$type_update = "2";
	}		
////////////////บทความ////////////////////////		
}elseif($what_form == "5"){
	$article_name_th = pea_substr(trim($_POST["article_name_th"]),150);
	$article_name_en = pea_substr(trim($_POST["article_name_en"]),150);
	$article_name_oth = pea_substr(trim($_POST["article_name_oth"]),150);
	$article_name_oth2 = pea_substr(trim($_POST["article_name_oth2"]),150);
	$type = $_POST["type"];
	$coop = "";
	$proportion = "";
	if($type == "2"){
		$coop = $_POST["coop"];
		$proportion = $_POST["proportion"];
	}
	$distribute_journal_level = $_POST["distribute_journal_level"];
	$journal_name = pea_substr(trim($_POST["journal_name"]),150);
	$writer = pea_substr(trim($_POST["writer"]),250);
	$v_i_n_p = pea_substr(trim($_POST["v_i_n_p"]),150);
	$press_year = $_POST["press_year"];
	if($id == "" or $id == null){
		$new_id = auto_increment("ID",TB_VCHARKARN_ACH5_TAB);
		$result=$db->add_db(TB_VCHARKARN_ACH5_TAB,array(
											  "ID" => "$new_id",
 											  "EMP_ID"=>"$emp_id",
											  "POSITION_TYPE"=>"$position_type",
											  "ARTICLE_NAME_TH"=>"$article_name_th",
											  "ARTICLE_NAME_EN"=>"$article_name_en",
											  "ARTICLE_NAME_OTH"=>"$article_name_oth",
											  "ARTICLE_NAME_OTH2"=>"$article_name_oth2",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "DISTRIBUTE_JOURNAL_LEVEL"=>"$distribute_journal_level",
											  "JOURNAL_NAME"=>"$journal_name",
											  "WRITER"=>"$writer",
											  "V_I_N_P"=>"$v_i_n_p",
											  "PRESS_YEAR"=>"$press_year",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_VCHARKARN_ACH5_TAB,array(
											  "ARTICLE_NAME_TH"=>"$article_name_th",
											  "ARTICLE_NAME_EN"=>"$article_name_en",
											  "ARTICLE_NAME_OTH"=>"$article_name_oth",
											  "ARTICLE_NAME_OTH2"=>"$article_name_oth2",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "DISTRIBUTE_JOURNAL_LEVEL"=>"$distribute_journal_level",
											  "JOURNAL_NAME"=>"$journal_name",
											  "WRITER"=>"$writer",
											  "V_I_N_P"=>"$v_i_n_p",
											  "PRESS_YEAR"=>"$press_year",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),"ID = '$id'",$conn); 
		$type_update = "2";
	}		
////////////////ผลงานวิชาการลักษณะอื่นๆ////////////////////////			
}elseif($what_form == "6"){
	$acheive_type = $_POST["acheive_type"];
	$acheive_name_th = pea_substr(trim($_POST["acheive_name_th"]),150);
	$acheive_name_en = pea_substr(trim($_POST["acheive_name_en"]),150);
	$acheive_name_oth = pea_substr(trim($_POST["acheive_name_oth"]),150);
	$acheive_name_oth2 = pea_substr(trim($_POST["acheive_name_oth2"]),150);
	$acheive_year = $_POST["acheive_year"];
	$type = $_POST["type"];
	$coop = "";
	$proportion = "";
	if($type == "2"){
		$coop = $_POST["coop"];
		$proportion = $_POST["proportion"];
	}
	if($id == "" or $id == null){
		$new_id = auto_increment("ID",TB_VCHARKARN_ACH6_TAB);
		$result=$db->add_db(TB_VCHARKARN_ACH6_TAB,array(
											  "ID" => "$new_id",
 											  "EMP_ID"=>"$emp_id",
											  "POSITION_TYPE"=>"$position_type",
											  "ACHEIVE_TYPE"=>"$acheive_type",
											  "ACHEIVE_NAME_TH"=>"$acheive_name_th",
											  "ACHEIVE_NAME_EN"=>"$acheive_name_en",
											  "ACHEIVE_NAME_OTH"=>"$acheive_name_oth",
											  "ACHEIVE_NAME_OTH2"=>"$acheive_name_oth2",
											  "ACHEIVE_YEAR"=>"$acheive_year",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_VCHARKARN_ACH6_TAB,array(
											  "ACHEIVE_TYPE"=>"$acheive_type",
											  "ACHEIVE_NAME_TH"=>"$acheive_name_th",
											  "ACHEIVE_NAME_EN"=>"$acheive_name_en",
											  "ACHEIVE_NAME_OTH"=>"$acheive_name_oth",
											  "ACHEIVE_NAME_OTH2"=>"$acheive_name_oth2",
											  "ACHEIVE_YEAR"=>"$acheive_year",
											  "TYPE"=>"$type",
											  "COOP"=>"$coop",
											  "PROPORTION"=>"$proportion",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"),"ID = '$id'",$conn); 
		$type_update = "2";
	}			
}
	$db->closedb($conn);	
		if($result){
			//save_completed("Save_success");
			?>
			<script language="javascript">
			window.top.load_ach_list(<?=$position_type?>);
			</script>
			<?
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูล ".ach_name($what_form)." (".pos_name($position_type).")'  ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูล ".ach_name($what_form)." (".pos_name($position_type).")' ($emp_id)");
		}else{
			save_completed("Save_error");
			echo oci_error();
?>
<script language="javascript">
window.top.$("span#waiting_ach"+"<?=$position_type?>").html("");
</script>
<?
exit();
		}



?>
<script language="javascript">
window.top.$("span#waiting_ach"+"<?=$position_type?>").html("");
</script>
<?
}
?>