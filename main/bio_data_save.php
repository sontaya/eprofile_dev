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
	$file_name="bio_{$emp_id}_".randpass(3)."($what).{$last}";
	$target_path = "files/bio_data_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}

function upload_file2($name,$what){
	global $emp_id;
	//echo $name."<br>";
	//print_r($_FILES);
	$array_last=explode(".",$_FILES["{$name}"]["name"]); 
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="bio{$emp_id}45.{$last}";
	$file_name=str_replace("-","0",$file_name);
	$file_name=str_replace("bio","",$file_name);
	$target_path = "files/bio_data_file/$file_name";
	//echo $target_path;
	
	if(move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		echo "ok";
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}


$bio_title_th = $_POST["bio_title_th"];
$bio_title2_th = pea_substr($_POST["bio_title2_th"],50);
$bio_title3_th = $_POST["bio_title3_th"];
$bio_fname_th = pea_substr(trim($_POST["bio_fname_th"]),100);
$bio_mname_th = pea_substr(trim($_POST["bio_mname_th"]),100);
$bio_lname_th = pea_substr(trim($_POST["bio_lname_th"]),100);
$bio_title_en = $_POST["bio_title_en"];
$bio_fname_en = pea_substr(ucfirst(strtolower(trim($_POST["bio_fname_en"]))),100);
$bio_mname_en = pea_substr(ucfirst(strtolower(trim($_POST["bio_mname_en"]))),100);
$bio_lname_en = pea_substr(ucfirst(strtolower(trim($_POST["bio_lname_en"]))),100);
$bio_sex = $_POST["bio_sex"];
$bio_nation1 = pea_substr(trim($_POST["bio_nation1"]),150);
$bio_nation2 = pea_substr(trim($_POST["bio_nation2"]),150);
$bio_religion = pea_substr(trim($_POST["bio_religion"]),100);
$bio_birthday = date2_formatdb($_POST["bio_birthday"]);
$person_id = pea_substr($_POST["person_id"],20);
$bio_id_from = pea_substr(trim($_POST["bio_id_from"]),100);
$bio_id_from_p = pea_substr(trim($_POST["bio_id_from_p"]),100);
if($_POST["bio_id_date_begin"] != "") $bio_id_date_begin = date2_formatdb($_POST["bio_id_date_begin"]); else $bio_id_date_begin = "";
if($_POST["bio_id_date_exp"] != "") $bio_id_date_exp = date2_formatdb($_POST["bio_id_date_exp"]); else $bio_id_date_exp = "";
if($_POST["bio_gov_id_date_begin"] != "") $bio_gov_id_date_begin = date2_formatdb($_POST["bio_gov_id_date_begin"]); else $bio_gov_id_date_begin = "";
if($_POST["bio_gov_id_date_exp"] != "") $bio_gov_id_date_exp = date2_formatdb($_POST["bio_gov_id_date_exp"]); else $bio_gov_id_date_exp = "";
$bio_tax_id = pea_substr(trim($_POST["bio_tax_id"]),30);
$bio_gov_id = pea_substr(trim($_POST["bio_gov_id"]),30);
$emp_id = pea_substr(trim($_POST["emp_id"]),30);
$bio_bank_acc_id = pea_substr(trim($_POST["bio_bank_acc_id"]),20);
$bio_bank = pea_substr(trim($_POST["bio_bank"]),100);
$bio_status = $_POST["bio_status"];
$bio_blood_group = $_POST["bio_blood_group"];
$bio_blood_type = $_POST["bio_blood_type"];
$bio_deformation = $_POST["deformation"];
$bio_h_phone = pea_substr($_POST["bio_h_phone"],15);
$bio_h_fax = pea_substr($_POST["bio_h_fax"],15);
$hid_bio_id_card_file = $_POST["hid_bio_id_card_file"];
$hid_bio_acc_bank_file = $_POST["hid_bio_acc_bank_file"];
$hid_bio_pic_file = $_POST["hid_bio_pic_file"];
$bio_mobile_1 = pea_substr($_POST["bio_mobile_1"],15);
$bio_mobile_2 = pea_substr($_POST["bio_mobile_2"],15);
$bio_internal_phone = pea_substr($_POST["bio_internal_phone"],30);
$bio_name_emer = pea_substr($_POST["bio_name_emer"],200);
$bio_emer_phone = pea_substr($_POST["bio_emer_phone"],30);

$bio_email1 = pea_substr(trim($_POST["bio_email1"]),80);
$bio_email2 = pea_substr(trim($_POST["bio_email2"]),80);

$bio_room_teacher = pea_substr($_POST["bio_room_teacher"],200);
$bio_work_permit = pea_substr($_POST["bio_work_permit"],200);

$complete_upload = 1;

if($_FILES['bio_id_card_file']['name'] != "" ){
			$temp = upload_file("bio_id_card_file","id_card");
			if($temp != "" and $temp != false){
			if($hid_bio_id_card_file != ""){
					@unlink("files/bio_data_file/$hid_bio_id_card_file");
				}
				$bio_id_card_file = $temp;
			}elseif($temp == false){
				$complete_upload = 0;
			}
}else{
	$bio_id_card_file = $hid_bio_id_card_file;
}


if($_FILES['bio_acc_bank_file']['name'] != ""){
	$temp = upload_file("bio_acc_bank_file","acc_bank");
	if($temp != "" and $temp != false){
		//echo "hid_bio_acc_bank_file:".$hid_bio_acc_bank_file."<br>";
		if($hid_bio_acc_bank_file != ""){
					@unlink("files/bio_data_file/$hid_bio_acc_bank_file");
				}
		$bio_acc_bank_file = $temp;
	}elseif($temp == false){
		$complete_upload = 0;
	}
}else{
	$bio_acc_bank_file = $hid_bio_acc_bank_file;
}


if($_FILES['bio_pic_file']['name'] != ""){
	//echo "ok";
	$temp = upload_file2("bio_pic_file","pic");
	if($temp != "" and $temp != false){
		//echo "hid_bio_pic_file:".$hid_bio_pic_file."<br>";
		/*if($hid_bio_pic_file != ""){
					@unlink("files/bio_data_file/$hid_bio_pic_file");
				}*/
		
		 $bio_pic_file = $temp;
	}elseif($temp == false){
	 $complete_upload = 0;
	}
}else{
	 $bio_pic_file = $hid_bio_pic_file;
}

if($complete_upload == 1){
	$numrow = $db->count_row(TB_BIODATA_TAB," WHERE EMP_ID = '$emp_id' ",$conn); 

	if($numrow == 0){
	$result=$db->add_db(TB_BIODATA_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "BIO_TITLE_TH"=>"$bio_title_th",
											  "BIO_TITLE2_TH"=>"$bio_title2_th",
											  "BIO_TITLE3_TH"=>"$bio_title3_th",
											  "BIO_FNAME_TH"=>"$bio_fname_th",
											  "BIO_MNAME_TH"=>"$bio_mname_th",
											  "BIO_LNAME_TH"=>"$bio_lname_th",
											  "BIO_TITLE_EN"=>"$bio_title_en",
											  "BIO_FNAME_EN"=>"$bio_fname_en",
											  "BIO_MNAME_EN"=>"$bio_mname_en",
											  "BIO_LNAME_EN"=>"$bio_lname_en",
											  "BIO_SEX"=>"$bio_sex",
											  "BIO_NATION1"=>"$bio_nation1",
											  "BIO_NATION2"=>"$bio_nation2",
											  "BIO_RELIGION"=>"$bio_religion",
											  "BIO_BIRTHDAY"=>"TO_DATE('$bio_birthday','YYYY-MM-DD')",
											//  "bio_age"=>"$bio_age",
											  "PERSON_ID"=>"$person_id",
											  "BIO_ID_FROM"=>"$bio_id_from",
											  "BIO_ID_FROM_P"=>"$bio_id_from_p",
											  "BIO_ID_DATE_BEGIN"=>"TO_DATE('$bio_id_date_begin','YYYY-MM-DD')",
											  "BIO_ID_DATE_EXP"=>"TO_DATE('$bio_id_date_exp','YYYY-MM-DD')",
                                                                    "BIO_GOV_ID_DATE_BEGIN"=>"TO_DATE('$bio_gov_id_date_begin','YYYY-MM-DD')",
											  "BIO_GOV_ID_DATE_EXP"=>"TO_DATE('$bio_gov_id_date_exp','YYYY-MM-DD')",
											  "BIO_TAX_ID"=>"$bio_tax_id",
											  "BIO_GOV_ID"=>"$bio_gov_id",
											  "BIO_BANK_ACC_ID"=>"$bio_bank_acc_id",
											  "BIO_BANK"=>"$bio_bank",
											  "BIO_STATUS"=>"$bio_status",
											  "BIO_BLOOD_GROUP"=>"$bio_blood_group",
											  "BIO_BLOOD_TYPE"=>"$bio_blood_type",
											  "BIO_DEFORMATION"=>"$bio_deformation",
											  "BIO_H_PHONE"=>"$bio_h_phone",
											  "BIO_H_FAX"=>"$bio_h_fax",
											  "BIO_MOBILE_1"=>"$bio_mobile_1",
											  "BIO_MOBILE_2"=>"$bio_mobile_2",
											  "BIO_EMAIL1"=>"$bio_email1",
											  "BIO_EMAIL2"=>"$bio_email2",
											  "BIO_NAME_EMER"=>"$bio_name_emer",
											  "BIO_EMER_PHONE"=>"$bio_emer_phone",
											  "BIO_ID_CARD_FILE"=>"$bio_id_card_file",
											  "BIO_ACC_BANK_FILE"=>"$bio_acc_bank_file",
											  "BIO_PIC_FILE"=>"$bio_pic_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user",
											  "BIO_ROOM_TEACHER"=>"$bio_room_teacher",
											  "BIO_WORK_PERMIT"=>"$bio_work_permit",
											  "BIO_INTERNAL_PHONE"=>"$bio_internal_phone"
											  ),$conn); 
	$type_update = "1";
	}else{
		$old_name = get_name2($emp_id,TB_BIODATA_TAB);
		list($t1,$t2) = explode(" ",$old_name);
	    $new_name = $bio_fname_th." ".$bio_lname_th;
		if($old_name != $new_name){
			$db->add_db(TB_NAME_HISTORY,array(
											  "EMP_ID"=>"$emp_id",
											  "NAME"=>"$t1",
											  "LAST_NAME"=>"$t2",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_name"
											  ),$conn);
		}
			
		$result=$db->update_db(TB_BIODATA_TAB,array(
											  "EMP_ID"=>"$emp_id",
											  "BIO_TITLE_TH"=>"$bio_title_th",
											  "BIO_TITLE2_TH"=>"$bio_title2_th",
											  "BIO_TITLE3_TH"=>"$bio_title3_th",
											  "BIO_FNAME_TH"=>"$bio_fname_th",
											  "BIO_MNAME_TH"=>"$bio_mname_th",
											  "BIO_LNAME_TH"=>"$bio_lname_th",
											  "BIO_TITLE_EN"=>"$bio_title_en",
											  "BIO_FNAME_EN"=>"$bio_fname_en",
											  "BIO_MNAME_EN"=>"$bio_mname_en",
											  "BIO_LNAME_EN"=>"$bio_lname_en",
											  "BIO_SEX"=>"$bio_sex",
											  "BIO_NATION1"=>"$bio_nation1",
											  "BIO_NATION2"=>"$bio_nation2",
											  "BIO_RELIGION"=>"$bio_religion",
											  "BIO_BIRTHDAY"=>"TO_DATE('$bio_birthday','YYYY-MM-DD')",
											//  "bio_age"=>"$bio_age",
											  "PERSON_ID"=>"$person_id",
											  "BIO_ID_FROM"=>"$bio_id_from",
											  "BIO_ID_FROM_P"=>"$bio_id_from_p",
											  "BIO_ID_DATE_BEGIN"=>"TO_DATE('$bio_id_date_begin','YYYY-MM-DD')",
											  "BIO_ID_DATE_EXP"=>"TO_DATE('$bio_id_date_exp','YYYY-MM-DD')",
                                                                    "BIO_GOV_ID_DATE_BEGIN"=>"TO_DATE('$bio_gov_id_date_begin','YYYY-MM-DD')",
											  "BIO_GOV_ID_DATE_EXP"=>"TO_DATE('$bio_gov_id_date_exp','YYYY-MM-DD')",
											  "BIO_TAX_ID"=>"$bio_tax_id",
											  "BIO_GOV_ID"=>"$bio_gov_id",
											  "BIO_BANK_ACC_ID"=>"$bio_bank_acc_id",
											  "BIO_BANK"=>"$bio_bank",
											  "BIO_STATUS"=>"$bio_status",
											  "BIO_BLOOD_GROUP"=>"$bio_blood_group",
											  "BIO_BLOOD_TYPE"=>"$bio_blood_type",
											  "BIO_DEFORMATION"=>"$bio_deformation",
											  "BIO_H_PHONE"=>"$bio_h_phone",
											  "BIO_H_FAX"=>"$bio_h_fax",
											  "BIO_MOBILE_1"=>"$bio_mobile_1",
											  "BIO_MOBILE_2"=>"$bio_mobile_2",
											  "BIO_EMAIL1"=>"$bio_email1",
											  "BIO_EMAIL2"=>"$bio_email2",
											  "BIO_NAME_EMER"=>"$bio_name_emer",
											  "BIO_EMER_PHONE"=>"$bio_emer_phone",
											  "BIO_ID_CARD_FILE"=>"$bio_id_card_file",
											  "BIO_ACC_BANK_FILE"=>"$bio_acc_bank_file",
											  "BIO_PIC_FILE"=>"$bio_pic_file",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user",
											  "BIO_ROOM_TEACHER"=>"$bio_room_teacher",
											  "BIO_WORK_PERMIT"=>"$bio_work_permit",
											  "BIO_INTERNAL_PHONE"=>"$bio_internal_phone"
					  ),"EMP_ID='$emp_id'",$conn); 
		
	
		
		$type_update = "2";
	}
		$_SESSION["FNAME_TH"] = $bio_fname_th;
		$_SESSION["LNAME_TH"] = $bio_lname_th;
		$_SESSION["FNAME_EN"] = $bio_fname_en;
		$_SESSION["LNAME_EN"] = $bio_lname_en;
		$_SESSION["PIC_FILE"] = $bio_pic_file;
		if($result){
			//debug("Result : ".$result);
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูลเบื้องต้น' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูลเบื้องต้น' ($emp_id)");
		}else{
			//debug("Result : ".$result);
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
$_SESSION["PERSON_ID"] = $person_id;
?>
<script language="javascript">
//var ran=Math.random();
//window.top.$("span#waiting").html("");
//window.top.load_page("bio_data.php?"+ran);
window.top.location.reload();
</script>
<?
}
?>