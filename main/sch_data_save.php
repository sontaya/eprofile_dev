<?

@session_start();
if ($_POST) {
  $fpath = '../';
  require_once($fpath . "includes/connect.php");
  include "update_by.php";
  $emp_id = $_SESSION["EMP_ID"];
  $sch_id = $_POST["sch_id"];
  $fund_money=$_POST["fund_money"];
  $fund_other=$_POST["fund_other"];
  $sch_order_no = pea_substr(trim($_POST["sch_order_no"]), 50);
  $sch_at = pea_substr(trim($_POST["sch_at"]), 50);
  $sch_at_date = "";
  if ($_POST["sch_at_date"] != "")
    $sch_at_date = date2_formatdb($_POST["sch_at_date"]);

  $sch_contract = pea_substr(trim($_POST["sch_contract"]), 30);

  $sch_edu_level = $_POST["sch_edu_level"];
  $sch_type = $_POST["sch_type"];
  $sch_long = $_POST["sch_long"];
  $sch_course = pea_substr(trim($_POST["sch_course"]), 150);
  $sch_course_short = pea_substr(trim($_POST["sch_course_short"]), 10);
  $sch_major_oth = "";
  if ($_POST["sch_major"] == "oth")
    $sch_major_oth = pea_substr($_POST["sch_major_oth"], 150);
  else
    $sch_major = pea_substr($_POST["sch_major"], 150);

  $sch_uni = pea_substr($_POST["sch_uni"], 150);
  $sch_country = pea_substr($_POST["sch_country"], 150);
  $sch_money = pea_substr(trim(removecomma($_POST["sch_money"])), 10);
  $sch_money1 = pea_substr(trim(removecomma($_POST["sch_money1"])), 10);
  $sch_money2 = pea_substr(trim(removecomma($_POST["sch_money2"])), 10);
  $sch_money3 = pea_substr(trim(removecomma($_POST["sch_money3"])), 10);
  $sch_source = $_POST["sch_source"];
  $sch_money_date = "";
  $sch_money_date1 = "";
  $sch_money_date2 = "";
  $sch_money_date3 = "";

  $sch_start_date = "";
  $sch_end_date = "";
  $sch_edu_start_date = "";
  $sch_edu_end_date = "";
  /* $sch_return_date = "";
    $sch_pay_date = ""; */
  if ($_POST["sch_money_date"] != "")
    $sch_money_date = date2_formatdb($_POST["sch_money_date"]);
  if ($_POST["sch_money_date1"] != "")
    $sch_money_date1 = date2_formatdb($_POST["sch_money_date1"]);
  if ($_POST["sch_money_date2"] != "")
    $sch_money_date2 = date2_formatdb($_POST["sch_money_date2"]);
  if ($_POST["sch_money_date3"] != "")
    $sch_money_date3 = date2_formatdb($_POST["sch_money_date3"]);

  if ($_POST["sch_start_date"] != "")
    $sch_start_date = date2_formatdb($_POST["sch_start_date"]);
  if ($_POST["sch_end_date"] != "")
    $sch_end_date = date2_formatdb($_POST["sch_end_date"]);
  if ($_POST["sch_edu_start_date"] != "")
    $sch_edu_start_date = date2_formatdb($_POST["sch_edu_start_date"]);
  if ($_POST["sch_edu_end_date"] != "")
    $sch_edu_end_date = date2_formatdb($_POST["sch_edu_end_date"]);
  /* if($_POST["sch_return_date"] != "") $sch_return_date  = date2_formatdb($_POST["sch_return_date"]);
    if($_POST["sch_pay_date"] != "") $sch_pay_date  = date2_formatdb($_POST["sch_pay_date"]); */

  $sch_payback_type = "";
  $sch_payback_day = "";
  $sch_payback_money = "";

  echo $coun_try = $_POST["coun_try"];
  $sch_order_no2 = $_POST["sch_order_no2"];
  $sch_at2 = $_POST["sch_at2"];
  if($_POST["sch_at_date5"]!=""){
  $sch_at_date2 = date2_formatdb($_POST["sch_at_date5"]);
  }else{
	   $sch_at_date2="";
  }
  $sch_major2 = $_POST["sch_major2"];

   if($_POST["sch_start_new"]!=""){
  $sch_start_new = date2_formatdb($_POST["sch_start_new"]);
  }else{
	   $sch_start_new="";
  }
  
  $sch_start_order_on=$_POST["sch_start_order_on"];

  $sch_start_at_on=$_POST["sch_start_at_on"];
  
   if($_POST["sch_start_at_date"]!=""){
  $sch_start_at_date = date2_formatdb($_POST["sch_start_at_date"]);
  }else{
	   $sch_start_at_date="";
  }

  $status_education = $_POST["status_education"];
  $old_munny = $_POST["old_munny"];
  $new_munny = $_POST["new_munny"];
  $new_munny_old = $_POST["new_munny_old"];

  $sch_money_order_on=$_POST["sch_money_order_on"];

  $sch_money_at_on=$_POST["sch_money_at_on"];
  
   if($_POST["sch_money_at_date"]!=""){
  $sch_money_at_date = date2_formatdb($_POST["sch_money_at_date"]);
  }else{
	   $sch_money_at_date="";
  }
  
  /* $sch_payback_type  = pea_substr($_POST["sch_payback_type"],1);
    if($sch_payback_type == 1) {$sch_payback_day  = pea_substr($_POST["sch_payback_day"],10);$sch_payback_money="";}
    elseif($sch_payback_type == 2){ $sch_payback_money  = pea_substr(removecomma($_POST["sch_payback_money"]),10); $sch_payback_day="";} */

  $sch_memo = pea_substr($_POST["sch_memo"], 300);

  $numrow = $db->count_row(TB_SCHOLAR_TAB, " WHERE EMP_ID = '$emp_id' ", $conn);
  
function upload_file($name,$array){
	global $emp_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"]);
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="sch_edu_{$emp_id}_".$array.".{$last}";
	$target_path = "files/sch_edu_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}

  if ($sch_id == '') {
    $sch_id = auto_increment("SCH_ID", TB_SCHOLAR_TAB);
	
		if($_FILES["sch_edu_file"]["tmp_name"]){
			$file_name = upload_file("sch_edu_file",$sch_id);
		}else{
			$file_name=$_POST["sch_edu_old_file"];
		}

	
    $result = $db->add_db(TB_SCHOLAR_TAB, array(
                "SCH_ID" => "$sch_id",
                "EMP_ID" => "$emp_id",
                "SCH_ORDER_NO" => "$sch_order_no",
                "SCH_AT" => "$sch_at",
                "SCH_AT_DATE" => "TO_DATE('$sch_at_date','YYYY-MM-DD')",
                "SCH_CONTRACT" => "$sch_contract",
                "SCH_EDU_LEVEL" => "$sch_edu_level",
                "SCH_TYPE" => "$sch_type",
                "SCH_LONG" => "$sch_long",
                "SCH_COURSE" => "$sch_course",
                "SCH_COURSE_SHORT" => "$sch_course_short",
                "SCH_MAJOR" => "$sch_major",
                "SCH_MAJOR_OTH" => "$sch_major_oth",
                "SCH_UNI" => "$sch_uni",
                "SCH_COUNTRY" => "$sch_country",
                "SCH_MONEY" => "$sch_money",
                "SCH_MONEY_DATE" => "TO_DATE('$sch_money_date','YYYY-MM-DD')",
                "SCH_MONEY1" => "$sch_money1",
                "SCH_MONEY_DATE1" => "TO_DATE('$sch_money_date1','YYYY-MM-DD')",
                "SCH_MONEY2" => "$sch_money2",
                "SCH_MONEY_DATE2" => "TO_DATE('$sch_money_date2','YYYY-MM-DD')",
                "SCH_MONEY3" => "$sch_money3",
                "SCH_MONEY_DATE3" => "TO_DATE('$sch_money_date3','YYYY-MM-DD')",
                "SCH_SOURCE" => "$sch_source",
                "SCH_START_DATE" => "TO_DATE('$sch_start_date','YYYY-MM-DD')",
                "SCH_END_DATE" => "TO_DATE('$sch_end_date','YYYY-MM-DD')",
                "SCH_EDU_START_DATE" => "TO_DATE('$sch_edu_start_date','YYYY-MM-DD')",
                "SCH_EDU_END_DATE" => "TO_DATE('$sch_edu_end_date','YYYY-MM-DD')",
                "SCH_MEMO" => "$sch_memo",
                "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
                "UPDATE_BY" => "$update_user",
				"COUN_TRY" => "$coun_try",
				"SCH_ORDER_NO2" => "$sch_order_no2",
				"SCH_AT2" => "$sch_at2",
				"SCH_AT_DATE2" => "$sch_at_date2",
				"SCH_MAJOR2" => "$sch_major2",
				"FUND_MONEY" => "$fund_money" ,
				"FUND_OTHER" => "$fund_other" ,
				"SCH_START_NEW" => "$sch_start_new",
				"SCH_START_ORDER_ON" => "$sch_start_order_on",
				"SCH_START_AT_ON" => "$sch_start_at_on",
				"SCH_START_AT_DATE" => "$sch_start_at_date",
                "STATUS_EDUCATION" => "$status_education",
                "OLD_MUNNY" => "$old_munny",
                "NEW_MUNNY" => "$new_munny",
				"SCH_MONEY_ORDER_ON" => "$sch_money_order_on",
				"SCH_MONEY_AT_ON" => "$sch_money_at_on",
				"SCH_MONEY_AT_DATE" => "$sch_money_at_date",
				"SCH_EDU_FILE" => "$file_name"
                    ), $conn);
    $type_update = "1";
  } else {
	  
		if($_FILES["sch_edu_file"]["tmp_name"]){
			$file_name = upload_file("sch_edu_file",$sch_id);
		}else{
			$file_name=$_POST["sch_edu_old_file"];
		}
		
    $result = $db->update_db(TB_SCHOLAR_TAB, array(
                "SCH_ORDER_NO" => "$sch_order_no",
                "SCH_AT" => "$sch_at",
                "SCH_AT_DATE" => "TO_DATE('$sch_at_date','YYYY-MM-DD')",
                "SCH_CONTRACT" => "$sch_contract",
                "SCH_EDU_LEVEL" => "$sch_edu_level",
                "SCH_TYPE" => "$sch_type",
                "SCH_LONG" => "$sch_long",
                "SCH_COURSE" => "$sch_course",
                "SCH_COURSE_SHORT" => "$sch_course_short",
                "SCH_MAJOR" => "$sch_major",
                "SCH_MAJOR_OTH" => "$sch_major_oth",
                "SCH_UNI" => "$sch_uni",
                "SCH_COUNTRY" => "$sch_country",
                "SCH_MONEY" => "$sch_money",
                "SCH_MONEY_DATE" => "TO_DATE('$sch_money_date','YYYY-MM-DD')",
                "SCH_MONEY1" => "$sch_money1",
                "SCH_MONEY_DATE1" => "TO_DATE('$sch_money_date1','YYYY-MM-DD')",
                "SCH_MONEY2" => "$sch_money2",
                "SCH_MONEY_DATE2" => "TO_DATE('$sch_money_date2','YYYY-MM-DD')",
                "SCH_MONEY3" => "$sch_money3",
                "SCH_MONEY_DATE3" => "TO_DATE('$sch_money_date3','YYYY-MM-DD')",
                "SCH_SOURCE" => "$sch_source",
                "SCH_START_DATE" => "TO_DATE('$sch_start_date','YYYY-MM-DD')",
                "SCH_END_DATE" => "TO_DATE('$sch_end_date','YYYY-MM-DD')",
                "SCH_EDU_START_DATE" => "TO_DATE('$sch_edu_start_date','YYYY-MM-DD')",
                "SCH_EDU_END_DATE" => "TO_DATE('$sch_edu_end_date','YYYY-MM-DD')",
                "SCH_MEMO" => "$sch_memo",
                "LAST_UPDATE" => "TO_DATE('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')",
                "UPDATE_BY" => "$update_user",
				"COUN_TRY" => "$coun_try",
				"SCH_ORDER_NO2" => "$sch_order_no2",
				"SCH_AT2" => "$sch_at2",
				"SCH_AT_DATE2" =>"TO_DATE('$sch_at_date2','YYYY-MM-DD')",
				"SCH_MAJOR2" => "$sch_major2",
				"FUND_MONEY" => "$fund_money" ,
				"FUND_OTHER" => "$fund_other" ,
				"SCH_START_NEW" => "$sch_start_new",
				"SCH_START_ORDER_ON" => "$sch_start_order_on",
				"SCH_START_AT_ON" => "$sch_start_at_on",
				"SCH_START_AT_DATE" => "$sch_start_at_date",
                "STATUS_EDUCATION" => "$status_education",
                "OLD_MUNNY" => "$old_munny",
                "NEW_MUNNY" => "$new_munny",
				"SCH_MONEY_ORDER_ON" => "$sch_money_order_on",
				"SCH_MONEY_AT_ON" => "$sch_money_at_on",
				"SCH_MONEY_AT_DATE" => "$sch_money_at_date",
				"SCH_EDU_FILE" => "$file_name"
                    ), "SCH_ID='$sch_id' ", $conn);
    $type_update = "2";
  }

  if ($result) {
    //save_completed("Save_success");
    reset_form_iframe("scholar");
    if ($type_update == "1")
      access_log($fpath . '_log', "", $update_by, "เพิ่ม 'การขอทุนศึกษาต่อ เลขที่คำสั่ง $sch_order_no' ($emp_id)");
    elseif ($type_update == "2")
      access_log($fpath . '_log', "", $update_by, "ปรับปรุง 'การขอทุนศึกษาต่อ เลขที่คำสั่ง $sch_order_no' ($emp_id)");
?>
    <script language="javascript">
      window.top.load_sch_table();
      <? if($new_munny_old!=$new_munny){ ?>
          window.top.change_data('current_work.php','../images/head2/work_data/current_work.png');
     <? }else{ ?>
      window.top.change_data('scholar.php','../images/head2/work_data/scholar.png');
      <? } ?>
    </script>
<?



  }else {
    save_completed("Save_error");
?>
    <script language="javascript">
      window.top.$("span#waiting1").html("");
    </script>
<?

    exit();
  }

  $db->closedb($conn);
?>
  <script language="javascript">
    //window.top.document.scholar.sch_order_no.readOnly = false;
    window.top.$("span#waiting1").html("");
  </script>
<?

}
?>
