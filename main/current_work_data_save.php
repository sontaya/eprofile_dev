<?
@session_start();

/*
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";
  exit();
*/

if ($_POST) {
  $fpath = '../';
  require_once($fpath . "includes/connect.php");
  echo $emp_id = $_SESSION["EMP_ID"];
  include "update_by.php";

  function upload_file($name, $what) {
    global $emp_id;
    $array_last = explode(".", $_FILES["{$name}"]["name"]);
    $last = strtolower($array_last[count($array_last) - 1]);
    $file_name = "cwk_{$emp_id}_" . randpass(3) . "($what).{$last}";
    $target_path = "files/cwk_teacher_file/$file_name";

    if (@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
      return $file_name;
    } else {
      @unlink($_FILES["{$name}"]["tmp_name"]);
      return false;
    }
  }

  function upload_file2($name, $what) {
    global $emp_id;
    $array_last = explode(".", $_FILES["{$name}"]["name"]);
    $last = strtolower($array_last[count($array_last) - 1]);
    $file_name = "cwk_{$emp_id}_" . randpass(3) . "($what).{$last}";
    $target_path = "files/cwk_cert_file/$file_name";

    if (@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
      return $file_name;
    } else {
      @unlink($_FILES["{$name}"]["tmp_name"]);
      return false;
    }
  }

  function upload_file3($name, $what) {
    global $emp_id;
    $array_last = explode(".", $_FILES["{$name}"]["name"]);
    $last = strtolower($array_last[count($array_last) - 1]);
    $file_name = "cwk_{$emp_id}_" . randpass(3) . "($what).{$last}";
    $target_path = "files/cwk_resign_file/$file_name";

    if (@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
      return $file_name;
    } else {
      @unlink($_FILES["{$name}"]["tmp_name"]);
      return false;
    }
  }
	
  function insert_admin_de() {
    global $emp_id;
    global $conn;
    global $db;
    global $update_user;
/*
    $cwk_position[] = $_POST["cwk_position1"];
    $cwk_position[] = $_POST["cwk_position2"];
    $cwk_position[] = $_POST["cwk_position3"];

    $cwk_mua_main_data[] = $_POST["cwk_mua_main_data1"];
    $cwk_mua_main_data[] = $_POST["cwk_mua_main_data2"];
    $cwk_mua_main_data[] = $_POST["cwk_mua_main_data3"];

    $cwk_mua_submain_data[] = $_POST["cwk_mua_submain_data1"];
    $cwk_mua_submain_data[] = $_POST["cwk_mua_submain_data4"];	//ajax_depsub4.php
    $cwk_mua_submain_data[] = $_POST["cwk_mua_submain_data5"];	//ajax_depsub5.php

*/

	$cwk_position = array($_POST["cwk_position3"],$_POST["cwk_position2"],$_POST["cwk_position1"]);
	$cwk_mua_main_data = array($_POST["cwk_mua_main_data3"],$_POST["cwk_mua_main_data2"],$_POST["cwk_mua_main_data1"]);	
	$cwk_mua_submain_data = array($_POST["cwk_mua_submain_data5"],$_POST["cwk_mua_submain_data4"],$_POST["cwk_mua_submain_data1"]);


    $sql = "DELETE  FROM  SDU_ADMIN_DEPARTMENT  WHERE EMP_ID='" . $_SESSION["EMP_ID"] . "'";
    $query = oci_parse($conn, $sql);
    oci_execute($query);

    for ($i = 0; $i <= 2; $i++) {
      if ($cwk_position[$i] != "" and $cwk_position[$i] != "00" ) {
        $db->add_db("SDU_ADMIN_DEPARTMENT", array(
            "EMP_ID" => "$emp_id",
            "CODE_FACULTY" => "$cwk_mua_main_data[$i]",
            "CODE_DEPARTMENT_SECTION" => $cwk_mua_submain_data[$i],
            "POSITION" => "$cwk_position[$i]",
            "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
            "UPDATE_BY" => "$update_user"
                ), $conn);
				
      }
    }


    if ($_POST["cwk_mua_mpos"] == "00" or $_POST["cwk_mua_mpos"] == "") {
      $sql = "DELETE  FROM  SDU_ADMIN_DEPARTMENT  WHERE EMP_ID='" . $_SESSION["EMP_ID"] . "'";
      $query = oci_parse($conn, $sql);
      oci_execute($query);
    }
	
  }

  insert_admin_de();

  $cwk_mua_emp_type = $_POST["cwk_mua_emp_type"];
  $cwk_mua_emp_subtype = $_POST["cwk_mua_emp_subtype"];
  $cwk_mua_main = $_POST["cwk_mua_main"];
  $cwk_mua_submain = $_POST["cwk_mua_submain"];
  $cwk_dsu_edu_center = $_POST["cwk_dsu_edu_center"];
  $cwk_dsu_pos = $_POST["cwk_dsu_pos"];
  $cwk_mua_vpos = $_POST["cwk_mua_vpos"];
  $cwk_mua_level = $_POST["cwk_mua_level"];
  $cwk_mua_mpos = $_POST["cwk_mua_mpos"];
  $cwk_mua_work_group = $_POST["cwk_mua_work_group"];
  if ($_POST["cwk_start_work_date"] != "")
    $cwk_start_work_date = date2_formatdb($_POST["cwk_start_work_date"]); else
    $cwk_start_work_date = "";
  $cwk_start_work = $_POST["cwk_start_work_hour"] . ":" . $_POST["cwk_start_work_min"];
  $cwk_end_work = $_POST["cwk_end_work_hour"] . ":" . $_POST["cwk_end_work_min"];
  if ($_POST["cwk_sat"] != "")
    $cwk_sat = $_POST["cwk_sat"]; else
    $cwk_sat = "0";
  if ($_POST["cwk_sun"] != "")
    $cwk_sun = $_POST["cwk_sun"]; else
    $cwk_sun = "0";
  $cwk_salary_type = $_POST["cwk_salary_type"];
  $cwk_salary = removecomma($_POST["cwk_salary_bath"]) . "." . $_POST["cwk_salary_stang"];
  $cwk_salary_time_type = $_POST["cwk_salary_time_type"];
  $cwk_mua_salary_source = $_POST["cwk_mua_salary_source"];
  $cwk_dsu_salary_source = $_POST["cwk_dsu_salary_source"];
  $cwk_phone = pea_substr(trim($_POST["cwk_phone"]), 15);
  $cwk_edu_group1 = $_POST["cwk_edu_group1"];
  $cwk_edu_group2 = $_POST["cwk_edu_group2"];
  $cwk_edu_group3 = $_POST["cwk_edu_group3"];
  $hid_cwk_teacher_file = $_POST["hid_cwk_teacher_file"];
  $hid_cwk_teacher_file = $_POST["hid_cwk_cert_file"];
  $position_code_a = $_POST["position_code"];
  $ck_id=$_POST["cwk_id"];

  $ck_order_no = $_POST["ck_order_no"];
  $ck_at = $_POST["ck_at"];
  if($_POST["ck_order_date"]!=""){
      $ck_order_date = date2_formatdb($_POST["ck_order_date"]);
  }else{
      $ck_order_date = "";
  }


/*if ($_POST["date_m"] != ""){
  $date_m = date2_formatdb($_POST["date_m"]);
}else{
	$date_m="";
}*/
  if ($_POST["date_m"] != ""){
  $date_m = date2_formatdb($_POST["date_m"]);
  } else{
  $date_m = "";
  }
// สามารถแก้ไขเงินเดือนจากงบประมาณต่าง ๆ ได้
  $cwk_budget1 = $_POST["cwk_budget1"];
  $cwk_total1 = removecomma($_POST["cwk_total1"]);
  $cwk_budget2 = $_POST["cwk_budget2"];
  $cwk_total2 = removecomma($_POST["cwk_total2"]);
  $cwk_budget3 = $_POST["cwk_budget3"];
  $cwk_total3 = removecomma($_POST["cwk_total3"]);

  $sql_salary = "SELECT REF FROM " . TB_REF_SALARY_STEP . " WHERE EMP_ID = '" . $_SESSION["EMP_ID"] . "' ORDER BY REF DESC";


  $stid_salary = oci_parse($conn, $sql_salary);
  oci_execute($stid_salary);
  $row_salary = oci_fetch_array($stid_salary, OCI_BOTH);
  $last_salary_ref = $row_salary['REF'];   // query  เงินเดือน

  echo $cwk_teach_order = $_POST["cwk_teach_order"];
  echo $cwk_promote_order = $_POST["cwk_promote_order"];




  if ($last_salary_ref == '') { // case ยังไม่มีข้อมูลเงินเดือนของบุคคลนี้เลย
    $salary_ref = auto_increment("REF", TB_REF_SALARY_STEP);
    $db->add_db(TB_REF_SALARY_STEP, array("EMP_ID" =>"$emp_id" ,"REF" =>"$salary_ref" ,"SOURCE1" => "$cwk_budget1", "SOURCE2" => "$cwk_budget2", "SOURCE3" => "$cwk_budget3", "SALARY1" => "$cwk_total1", "SALARY2" => "$cwk_total2", "SALARY3" => "$cwk_total3", "AFFECTIVE_DATE" => "$cwk_start_work_date" ,"LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
            "UPDATE_BY" => "$update_user"), $conn);
  } else {
    $db->update_db(TB_REF_SALARY_STEP, array("SOURCE1" => "$cwk_budget1", "SOURCE2" => "$cwk_budget2", "SOURCE3" => "$cwk_budget3", "SALARY1" => "$cwk_total1", "SALARY2" => "$cwk_total2", "SALARY3" => "$cwk_total3"), "EMP_ID='$emp_id' AND REF = '$last_salary_ref'", $conn);
  }

  $cwk_extra_salary = $_POST["cwk_extra_salary"];
  $cwk_cost = $_POST["cwk_cost"];
  $cwk_from = $_POST["cwk_from"];
  $count = count($cwk_extra_salary);

  if ($count > 0) {
    for ($i = 0; $i < $count; $i++) {
      if ($cwk_extra_salary[$i] != "" and $cwk_cost[$i] != "" and $cwk_from[$i] != "") {
        $ex_id = auto_increment("EX_ID", TB_EXTRA_SALARY_TAB);
        $db->add_db(TB_EXTRA_SALARY_TAB, array(
            "EMP_ID" => "$emp_id",
            "EX_ID" => "$ex_id",
            "EX_SALARY_REF" => "" . $cwk_extra_salary[$i] . "",
            "EX_SALARY" => "" . $cwk_cost[$i] . "",
            "EX_SOURCE" => "" . $cwk_from[$i] . "",
            "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
            "UPDATE_BY" => "$update_user"
                ), $conn);
      }
    }
  }

  $cwk_extra_salary1 = $_POST["cwk_extra_salary1"];
  $cwk_cost1 = $_POST["cwk_cost1"];
  $cwk_from1 = $_POST["cwk_from1"];
  $ex_id = $_POST["ex_id"];
  $count1 = count($cwk_extra_salary1);

  if ($count1 > 0) {
    for ($i = 0; $i < $count1; $i++) {
      if ($cwk_extra_salary1[$i] != "" and $cwk_cost1[$i] != "" and $cwk_from1[$i] != "") {
        $db->update_db(TB_EXTRA_SALARY_TAB, array(
            "EX_SALARY_REF" => "" . $cwk_extra_salary1[$i] . "",
            "EX_SALARY" => "" . $cwk_cost1[$i] . "",
            "EX_SOURCE" => "" . $cwk_from1[$i] . "",
            "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
            "UPDATE_BY" => "$update_user"
                ), "EX_ID='" . $ex_id[$i] . "'", $conn);
      }
    }
  }

  $cwk_status = $_POST["cwk_status"];
  $cwk_resignation = $_POS["cwk_resignation"];
  $cwk_resignation_detail = $_POS["cwk_resignation_detail"];

	

  if ($_POST["cwk_end_work_date"] != "")
    $cwk_end_work_date = date2_formatdb($_POST["cwk_end_work_date"]); else
    $cwk_end_work_date = "";
  if ($_POST["cwk_start_teach_date"] != "")
    $cwk_start_teach_date = date2_formatdb($_POST["cwk_start_teach_date"]); else
    $cwk_start_teach_date = "";
  $cwk_order1 = pea_substr(trim($_POST["cwk_order1"]), 30);
  if ($_POST["cwk_promote_date"] != "")
    $cwk_promote_date = date2_formatdb($_POST["cwk_promote_date"]); else
    $cwk_promote_date = "";
  $cwk_order2 = pea_substr(trim($_POST["cwk_order2"]), 30);
  if ($_POST["cwk_quit_date"] != "")
    $cwk_quit_date = date2_formatdb($_POST["cwk_quit_date"]); else
    $cwk_quit_date = "";
  $cwk_quit_reason = pea_substr(trim($_POST["cwk_quit_reason"]), 500);

  $complete_upload = 1;

  if ($_FILES['cwk_teacher_file']['name'] != "") {
    $temp = upload_file("cwk_teacher_file", "edu_file");
    if ($temp != "" and $temp != false) {
      @unlink("files/cwk_teacher_file/$hid_cwk_teacher_file");
      $cwk_teacher_file = $temp;
    } elseif ($temp == false) {
      $complete_upload = 0;
    }
  } else {
    $cwk_teacher_file = $hid_cwk_teacher_file;
  }
// -------------------------CERT FILE ATTACHMENT -----------------------------------------
  if ($_FILES['cwk_cert_file']['name'] != "") {
    $temp = upload_file2("cwk_cert_file", "edu_file");
    if ($temp != "" and $temp != false) {
      @unlink("files/cwk_cert_file/$hid_cwk_cert_file");
      $cwk_cert_file = $temp;
    } elseif ($temp == false) {
      $complete_upload = 0;
    }
  } else {
    $cwk_cert_file = $hid_cwk_cert_file;
  }
// --------------------------------------------------------------------
// -------------------------RESIGNATION FILE ATTACHMENT -----------------------------------------
  if ($_FILES['cwk_resignation_file']['name'] != "") {
    $temp = upload_file3("cwk_resignation_file", "resign_file");
    if ($temp != "" and $temp != false) {
      @unlink("files/cwk_resign_file/$hid_cwk_resig_file");
      $cwk_resig_file = $temp;
    } elseif ($temp == false) {
      $complete_upload = 0;
    }
  } else {
    $cwk_resig_file = $hid_cwk_resig_file;
  }
	

// --------------------------------------------------------------------
	
$cc=1;
/*echo $ch_id=$_POST["ch_id"];
if($ch_id=$_POST["ch_id"]!=""){
		echo $ch_id=$_POST["ch_id"];
		$db->update_db(TB_CURRENT_WORK_HISTORY_TAB, array(
        "CH_MUA_EMP_TYPE" => "$ch_mua_emp_type",
        "CH_MUA_EMP_SUBTYPE" => "$ch_mua_emp_subtype",
        "CH_MUA_MAIN" => "$ch_mua_main",
        "CH_MUA_SUBMAIN" => "$ch_mua_submain",
        "CH_DSU_EDU_CENTER" => "$ch_dsu_edu_center",
        "CH_DSU_POS" => "$ch_dsu_pos",
        "CH_MUA_VPOS" => "$ch_mua_vpos",
        "CH_MUA_LEVEL" => "$ch_mua_level",
        "CH_MUA_MPOS" => "$ch_mua_mpos",
        "CH_MUA_WORK_GROUP" => "$ch_mua_work_group",
        "CH_START_WORK_DATE" => "TO_DATE('$ch_start_work_date','YYYY-MM-DD')",
        "CH_START_WORK" => "$ch_start_work",
        "CH_END_WORK" => "$ch_end_work",
        "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
            ), "CH_ID='$ch_id'", $conn);
	}*/
	$sql_sch_country = "select max(CK_ID)as CK_ID from SDU_CURRENT_WORK_TAB";
    $stid_sch_country = oci_parse($conn, $sql_sch_country);
    oci_execute($stid_sch_country);
	     while ($row_sch_country = oci_fetch_array($stid_sch_country, OCI_BOTH)) {
			   $oo=$row_sch_country["CK_ID"]+1;
			   //$oo=$ok+1;
		 }
		 $ck_id=$_POST["cwk_id"];
 if ($cc == 1) {
	 //echo "add";
   // $numrow = $db->count_row(TB_CURRENT_WORK_TAB, " WHERE EMP_ID = '$emp_id'", $conn);

    $tt=$_POST["cwk_pos_status"];
     if ($tt == "2") {

	  $ss=$db->update_db(TB_CURRENT_WORK_TAB, array(
                  "CWK_POS_STATUS" => "1"
				   ), "EMP_ID='$emp_id'", $conn);

	 $position_code_a;
		$sql_hn = "select max(CK_ID)as CK_ID from SDU_CURRENT_WORK_H_TAB";
		$stid_sch_hn = oci_parse($conn, $sql_hn);
		oci_execute($stid_sch_hn);
		 while ($stid_sch_max = oci_fetch_array($stid_sch_hn, OCI_BOTH)) {
			   $hh=$stid_sch_max["CK_ID"]+1;
			   //$hh=$ok+1;
		 }
		$sql_h = "select * from SDU_CURRENT_WORK_TAB WHERE CK_ID='".$ck_id."'";
		$stid_h_add = oci_parse($conn, $sql_h);
		oci_execute($stid_h_add);
	     while ($row_sch_h = oci_fetch_array($stid_h_add, OCI_BOTH)) {
			$result = $db->add_db(TB_SDU_CURRENT_WORK_H_TAB, array(
                  "EMP_ID" => $row_sch_h["EMP_ID"],
                  "CWK_STATUS" => $row_sch_h["CWK_STATUS"],
                  "CWK_MUA_EMP_TYPE" => $row_sch_h["CWK_MUA_EMP_TYPE"],
                  "CWK_MUA_EMP_SUBTYPE" => $row_sch_h["CWK_MUA_EMP_SUBTYPE"],
                  "CWK_MUA_MAIN" => $row_sch_h["CWK_MUA_MAIN"],
                  "CWK_MUA_SUBMAIN" => $row_sch_h["CWK_MUA_SUBMAIN"],
                  "CWK_DSU_EDU_CENTER" => $row_sch_h["CWK_DSU_EDU_CENTER"],
                  "CWK_DSU_POS" => $row_sch_h["CWK_DSU_POS"],
                  "CWK_MUA_VPOS" => $row_sch_h["CWK_MUA_VPOS"],
                  "CWK_MUA_LEVEL" => $row_sch_h["CWK_MUA_LEVEL"],
                  "CWK_MUA_MPOS" => $row_sch_h["CWK_MUA_MPOS"],
                  "CWK_MUA_WORK_GROUP" => $row_sch_h["CWK_MUA_WORK_GROUP"],
                  "CWK_START_WORK_DATE" => $row_sch_h["CWK_START_WORK_DATE"],
                  "CWK_END_WORK_DATE" => $row_sch_h["CWK_END_WORK_DATE"],
                  "CWK_START_WORK" => $row_sch_h["CWK_START_WORK"],
                  "CWK_END_WORK" => $row_sch_h["CWK_END_WORK"],
                  "CWK_SAT" => $row_sch_h["CWK_SAT"],
                  "CWK_SUN" => $row_sch_h["CWK_SUN"],
                  "CWK_START_TEACH_DATE" => $row_sch_h["CWK_START_TEACH_DATE"],
                  "CWK_ORDER1" => $row_sch_h["CWK_ORDER1"],
                  "CWK_TEACH_ORDER" => $row_sch_h["CWK_TEACH_ORDER"],
                  "CWK_PROMOTE_DATE" => $row_sch_h["CWK_PROMOTE_DATE"],
                  "CWK_ORDER2" => $row_sch_h["CWK_ORDER2"],
                  "CWK_PROMOTE_ORDER" => $row_sch_h["CWK_PROMOTE_ORDER"],
                  "CWK_SALARY_TIME_TYPE" => $row_sch_h["CWK_SALARY_TIME_TYPE"],
                  "CWK_PHONE" => $row_sch_h["CWK_PHONE"],
                  "CWK_EDU_GROUP1" => $row_sch_h["CWK_EDU_GROUP1"],
                  "CWK_EDU_GROUP2" => $row_sch_h["CWK_EDU_GROUP2"],
                  "CWK_EDU_GROUP3" => $row_sch_h["CWK_EDU_GROUP3"],
                  "CWK_TEACHER_FILE" => $row_sch_h["CWK_TEACHER_FILE"],
                  "CWK_CERT_FILE" => $row_sch_h["CWK_CERT_FILE"],
                  "CWK_QUIT_DATE" => $row_sch_h["CWK_QUIT_DATE"],
                  "CWK_QUIT_REASON" => $row_sch_h["CWK_QUIT_REASON"],
                  "LAST_UPDATE" => $row_sch_h["LAST_UPDATE"],
                  "UPDATE_BY" => $row_sch_h["UPDATE_BY"],
				  "DATE_M" => $row_sch_h["DATE_M"],
				  "CWK_POS_STATUS" => $row_sch_h["CWK_POS_STATUS"],
				  "CK_ID" => "$hh",
				  "POSITION_CODE" => $row_sch_h["POSITION_CODE"],
                  "CK_ORDER_NO" => $row_sch_h["CK_ORDER_NO"],
                  "CK_AT" => $row_sch_h["CK_AT"],
                  "CK_ORDER_DATE" => $row_sch_h["CK_ORDER_DATE"]

                      ), $conn);

				$result=$db->update_db(TB_CURRENT_WORK_TAB, array(
                  "CWK_STATUS" => "$cwk_status",
                  "CWK_MUA_EMP_TYPE" => "$cwk_mua_emp_type",
                  "CWK_MUA_EMP_SUBTYPE" => "$cwk_mua_emp_subtype",
                  "CWK_MUA_MAIN" => "$cwk_mua_main",
                  "CWK_MUA_SUBMAIN" => "$cwk_mua_submain",
                  "CWK_DSU_EDU_CENTER" => "$cwk_dsu_edu_center",
                  "CWK_DSU_POS" => "$cwk_dsu_pos",
                  "CWK_MUA_VPOS" => "$cwk_mua_vpos",
                  "CWK_MUA_LEVEL" => "$cwk_mua_level",
                  "CWK_MUA_MPOS" => "$cwk_mua_mpos",
                  "CWK_MUA_WORK_GROUP" => "$cwk_mua_work_group",
                  "CWK_START_WORK_DATE" => "TO_DATE('$cwk_start_work_date','YYYY-MM-DD')",
                  "CWK_END_WORK_DATE" => "TO_DATE('$cwk_end_work_date','YYYY-MM-DD')",
                  "CWK_START_WORK" => "$cwk_start_work",
                  "CWK_END_WORK" => "$cwk_end_work",
                  "CWK_SAT" => "$cwk_sat",
                  "CWK_SUN" => "$cwk_sun",
                  "CWK_START_TEACH_DATE" => "TO_DATE('$cwk_start_teach_date','YYYY-MM-DD')",
                  "CWK_ORDER1" => "$cwk_order1",
                  "CWK_TEACH_ORDER" => "$cwk_teach_order",
                  "CWK_PROMOTE_DATE" => "TO_DATE('$cwk_promote_date','YYYY-MM-DD')",
                  "CWK_ORDER2" => "$cwk_order2",
                  "CWK_PROMOTE_ORDER" => "$cwk_promote_order",
                  "CWK_SALARY_TIME_TYPE" => "$cwk_salary_time_type",
                  "CWK_PHONE" => "$cwk_phone",
                  "CWK_EDU_GROUP1" => "$cwk_edu_group1",
                  "CWK_EDU_GROUP2" => "$cwk_edu_group2",
                  "CWK_EDU_GROUP3" => "$cwk_edu_group3",
                  "CWK_TEACHER_FILE" => "$cwk_teacher_file",
                  "CWK_CERT_FILE" => "$cwk_cert_file",
                  "CWK_QUIT_DATE" => "TO_DATE('$cwk_quit_date','YYYY-MM-DD')",
                  "CWK_QUIT_REASON" => "$cwk_quit_reason",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
                  "UPDATE_BY" => "$update_user",
				  "DATE_M" =>"TO_DATE('$date_m','YYYY-MM-DD')",
				  "POSITION_CODE" => "$position_code_a",
                  "CK_ORDER_NO" => "$ck_order_no",
                  "CK_AT" => "$ck_at",
                  "CK_ORDER_DATE" => "$ck_order_date",
				  "CWK_RESIGNATION" => "$cwk_resignation",
				  "CWK_RESIGNATION_DETAIL" => "$cwk_resignation_detail",
				  "CWK_RESIGNATION_FILE" => "$cwk_resig_file"
                      ), "EMP_ID='$emp_id'", $conn);

            $type_update = "1";
		 }
    } else {
	//echo $position_code_a;
	//echo "update";
      $result = $db->update_db(TB_CURRENT_WORK_TAB, array(
                  "CWK_STATUS" => "$cwk_status",
                  "CWK_MUA_EMP_TYPE" => "$cwk_mua_emp_type",
                  "CWK_MUA_EMP_SUBTYPE" => "$cwk_mua_emp_subtype",
                  "CWK_MUA_MAIN" => "$cwk_mua_main",
                  "CWK_MUA_SUBMAIN" => "$cwk_mua_submain",
                  "CWK_DSU_EDU_CENTER" => "$cwk_dsu_edu_center",
                  "CWK_DSU_POS" => "$cwk_dsu_pos",
                  "CWK_MUA_VPOS" => "$cwk_mua_vpos",
                  "CWK_MUA_LEVEL" => "$cwk_mua_level",
                  "CWK_MUA_MPOS" => "$cwk_mua_mpos",
                  "CWK_MUA_WORK_GROUP" => "$cwk_mua_work_group",
                  "CWK_START_WORK_DATE" => "TO_DATE('$cwk_start_work_date','YYYY-MM-DD')",
                  "CWK_END_WORK_DATE" => "TO_DATE('$cwk_end_work_date','YYYY-MM-DD')",
                  "CWK_START_WORK" => "$cwk_start_work",
                  "CWK_END_WORK" => "$cwk_end_work",
                  "CWK_SAT" => "$cwk_sat",
                  "CWK_SUN" => "$cwk_sun",
                  "CWK_START_TEACH_DATE" => "TO_DATE('$cwk_start_teach_date','YYYY-MM-DD')",
                  "CWK_ORDER1" => "$cwk_order1",
                  "CWK_TEACH_ORDER" => "$cwk_teach_order",
                  "CWK_PROMOTE_DATE" => "TO_DATE('$cwk_promote_date','YYYY-MM-DD')",
                  "CWK_ORDER2" => "$cwk_order2",
                  "CWK_PROMOTE_ORDER" => "$cwk_promote_order",
                  "CWK_SALARY_TIME_TYPE" => "$cwk_salary_time_type",
                  "CWK_PHONE" => "$cwk_phone",
                  "CWK_EDU_GROUP1" => "$cwk_edu_group1",
                  "CWK_EDU_GROUP2" => "$cwk_edu_group2",
                  "CWK_EDU_GROUP3" => "$cwk_edu_group3",
                  "CWK_TEACHER_FILE" => "$cwk_teacher_file",
                  "CWK_CERT_FILE" => "$cwk_cert_file",
                  "CWK_QUIT_DATE" => "TO_DATE('$cwk_quit_date','YYYY-MM-DD')",
                  "CWK_QUIT_REASON" => "$cwk_quit_reason",
                  "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
                  "UPDATE_BY" => "$update_user",
				  "DATE_M" =>"TO_DATE('$date_m','YYYY-MM-DD')",
				  "POSITION_CODE" => "$position_code_a",
                  "CK_ORDER_NO" => "$ck_order_no",
                  "CK_AT" => "$ck_at",
                  "CK_ORDER_DATE" => "$ck_order_date"
                      ), "EMP_ID='$emp_id'", $conn);
      if ($cwk_status == '01') { $db->update_db(TB_CURRENT_WORK_TAB, array("CWK_RETIRE" => "", "CWK_RETIRE_DATE" => ""), "EMP_ID='$emp_id'", $conn); }
      $type_update = "2";
    }

    switch ($cwk_status) {
      case "01": $txt = "ปฏิบัติการ"; break;
      case "02": $txt = "ลาออก"; break;
      case "03": $txt = "ลาศึกษาต่อ"; break;
      case "04": $txt = "เกษียนอายุ"; break;
      case "05": $txt = "ปฏิบัติการตามวาระ"; break;
      case "07": $txt = "เสียชีวิต"; break;
      default: $txt = "ปฏิบัติการ";
    }
    $_SESSION["STATUS"] = $txt;

    if ($result) {
      //save_completed("Save_success");

	  $db->del(TB_HELP_GOV,"EMP_ID='$emp_id'",$conn);
	  $institution = $_POST["institution"];
	  $start_date = $_POST["start_date"];
	  $end_date = $_POST["end_date"];
	  foreach( $institution as $index => $val){
	  	if($val!=""){
	  		$db->add_db(TB_HELP_GOV, array(
										"EMP_ID"=>"$emp_id",
										"INSTITUTION"=>$val,
										"START_DATE"=>"TO_DATE('".date2_formatdb($start_date[$index])."','YYYY-MM-DD')",
										"END_DATE"=>"TO_DATE('".date2_formatdb($end_date[$index])."','YYYY-MM-DD')"
										),$conn);
		}
	  }
	  if($_POST["position_code"]!=""){
	  	$position_code = $_POST["position_code"];
	  	$sql="SELECT COUNT(*) AS N  FROM SDU_REF_POSITION_CODE WHERE (POSITION_CODE='".$position_code."' AND EMP_ID='') OR (POSITION_CODE='".$position_code."' AND EMP_ID IS NULL) AND EMP_ID !='".$emp_id."'";
		$st = oci_parse($conn, $sql);
		oci_execute($st);
		$rc = oci_fetch_array($st, OCI_ASSOC);
		if($rc["N"]==0 and $_POST["cwk_status"]=="01"){
			$sql="SELECT * FROM SDU_REF_POSITION_CODE WHERE  EMP_ID ='".$emp_id."'";
			$st = oci_parse($conn, $sql);
			oci_execute($st);
			$rc = oci_fetch_array($st, OCI_ASSOC);

			$emp_old=$rc["EMP_ID"];
			$position_code_old=$rc["POSITION_CODE"];
			if($position_code_old!=$position_code){

				$db->add_db("SDU_POSITION_CODE_HISTORY", array(
										"EMP_ID"=> "$emp_old",
										"POSITION_CODE"=> "$position_code_old",
										"POSITION_CODE_NEW" => $position_code,
										"CHANGE_DATE"=>"TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
										),$conn);
			}

			$sql_update = "UPDATE SDU_REF_POSITION_CODE SET EMP_ID =NULL WHERE EMP_ID = '".$emp_id."'";
			$st = oci_parse($conn,$sql_update);
			oci_execute($st);

			$sql_update = "UPDATE SDU_REF_POSITION_CODE SET EMP_ID ='".$emp_id."' WHERE POSITION_CODE='".$position_code."'";
			$st = oci_parse($conn,$sql_update);
			oci_execute($st);
		}

		if($_POST["cwk_status"]!="01"){
			$db->add_db("SDU_POSITION_CODE_HISTORY", array(
										"EMP_ID"=> "$emp_id",
										"POSITION_CODE"=> "$position_code_old",
										"POSITION_CODE_NEW" => "",
										"CHANGE_DATE"=>"TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')"
										),$conn);
			$sql_update = "UPDATE SDU_REF_POSITION_CODE SET EMP_ID ='' WHERE POSITION_CODE='".$position_code."' AND EMP_ID ='".$emp_id."'";
			$st = oci_parse($conn,$sql_update);
			oci_execute($st);
		}

	  }
      reset_form_iframe("current_work");
      if ($type_update == "1")
        access_log($fpath . '_log', "", $update_by, "เพิ่ม 'ตำแหน่งงานปัจจุปัน' ($emp_id)");
      elseif ($type_update == "2")
        access_log($fpath . '_log', "", $update_by, "ปรับปรุง 'ตำแหน่งงานปัจจุปัน' ($emp_id)");
    }else {
      save_completed("Save_error");
      ?>
      <script language="javascript">
        window.top.$("span#waiting").html("");
      </script>
      <?
      exit();
    }
  } else {
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
    window.top.$("div#status").html("สถานะปัจจุบัน : <?= $_SESSION["STATUS"] ?>");
    window.top.load_page3("current_work.php?"+ran);
  </script>
  <?
}
?>
