<?
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
//$pay_ref = $_POST['pay_ref'];
$pay_type = $_POST['pay_type'];

/////////////////////////////////////////////////////////////
$scholar1 = "";
$date1 = "";
$date2 = "";
//$date_start_work1= "";
$date_start_pay1 = "";
$countdate1 = 0;
$multiply1 = 0;
$days1 = 0;

$scholar2 = "";
$money2 = 0;
$mp = 0;
$multiply2 = 0;
$tw = 0;
$result2 = 0;

$scholar3 = "";
$money3 = 0;
$date3 = "";
$date4 = "";
$date_start_work3= "";
$date_start_pay3 = "";
$count_days_2 = 0;
$mch3 = 0;
$ddays = 0;
$bpd = 0;
$date5 = "";
$date6 = "";
$count_days_3 = 0;
$remain_days = 0;
$remain_money = 0;
$mch4 = 0;
$ttfee = 0;
$grand_total = 0;
/////////////////////////////////////////////
$numrow = $db->count_row(TB_SCH_PAY_BACK_TAB," WHERE EMP_ID = '$emp_id'  ",$conn); 


if($pay_type == "1"){
	$scholar1 = $_POST['scholar1'];
	if($_POST['datepicker1'] != "") $date1 = "TO_DATE('".date2_formatdb($_POST['datepicker1'])."','YYYY-MM-DD')"; else $date1 = NULL;
	if($_POST['datepicker2'] != "") $date2 = "TO_DATE('".date2_formatdb($_POST['datepicker2'])."','YYYY-MM-DD')"; else $date2 = NULL;
	//if($_POST['date_start_work1'] != "") $date_start_work1 = "TO_DATE('".date2_formatdb($_POST['date_start_work1'])."','YYYY-MM-DD')"; else $date_start_work1 = NULL;
	if($_POST['date_start_pay1'] != "") $date_start_pay1 = "TO_DATE('".date2_formatdb($_POST['date_start_pay1'])."','YYYY-MM-DD')"; else $date_start_pay1 = NULL;
	//$date_start_work1 = date2_formatdb($_POST['date_start_work1']);
	//$date_start_pay1 =date2_formatdb( $_POST['date_start_pay1']);
	$countdate1 = removecomma($_POST['countdate1']);
	$multiply1 = $_POST['multiply1'];
	$days1 = removecomma($_POST['days1']);
	
	$date_present = "TO_DATE('".date2_formatdb($_POST['date_present'])."','YYYY-MM-DD')";
	if($_POST['date_present'] == ""){
		$date_present = NULL;
	}
	$date_present2 = NULL;
      if($numrow == 0){
	$db->add_db(TB_SCH_PAY_BACK_TAB,array(
											  "EMP_ID"=>"$emp_id",
											  "PAY_TYPE"=>"$pay_type",
											  "SCHOLAR1"=>"$scholar1",
											  "DATE1"=>"$date1",
											  "DATE2"=>"$date2",
											  "DATE_START_PAY1"=>"$date_start_pay1",
											  "COUNTDATE1"=>"$countdate1",
											  "MULTIPLY1"=>"$multiply1",
											  "DAYS1"=>"$days1",
											  "DATE_PRESENT"=>"$date_present",
											  "DATE_PRESENT2"=>"$date_present2"
											  ),$conn);
}else{
	$db->update_db(TB_SCH_PAY_BACK_TAB,array(
											  "PAY_TYPE"=>"$pay_type",
											  "SCHOLAR1"=>"$scholar1",
											  "DATE1"=>"$date1",
											  "DATE2"=>"$date2",
											  "DATE_START_PAY1"=>"$date_start_pay1",
											  "COUNTDATE1"=>"$countdate1",
											  "MULTIPLY1"=>"$multiply1",
											  "DAYS1"=>"$days1",
											  "DATE_PRESENT"=>"$date_present",
											  "DATE_PRESENT2"=>"$date_present2"
											  )," EMP_ID = '$emp_id'  ",$conn);
}

}elseif($pay_type == "2"){
	$scholar2 = $_POST['scholar2'];
	$money2 = removecomma($_POST['money2']);
	$mp = removecomma($_POST['mp']);
	$multiply2 = $_POST['multiply2'];
	$tw = removecomma($_POST['tw']);
	$result2 = removecomma($_POST['result2']);
	
	$date_present = NULL;
	$date_present2 = NULL;
    if($numrow == 0){
	$db->add_db(TB_SCH_PAY_BACK_TAB,array( 
                                              "EMP_ID"=>"$emp_id",
                                              "SCHOLAR2"=>"$scholar2",
											  "MONEY2"=>"$money2",
											  "MP"=>"$mp",
											  "MULTIPLY2"=>"$multiply2",
											  "TW"=>"$tw",
											  "RESULT2"=>"$result2",
											  "DATE_PRESENT"=>"$date_present",
											  "DATE_PRESENT2"=>"$date_present2"
											  ),$conn);
}else{
	$db->update_db(TB_SCH_PAY_BACK_TAB,array(
											 "SCHOLAR2"=>"$scholar2",
											  "MONEY2"=>"$money2",
											  "MP"=>"$mp",
											  "MULTIPLY2"=>"$multiply2",
											  "TW"=>"$tw",
											  "RESULT2"=>"$result2",
											  "DATE_PRESENT"=>"$date_present",
											  "DATE_PRESENT2"=>"$date_present2"
											  )," EMP_ID = '$emp_id'  ",$conn);
}


}elseif($pay_type == "3"){
	$scholar3 = $_POST['scholar3'];
	$money3 = removecomma($_POST['money3']);
	if($_POST['datepicker3'] != "") $date3 = "TO_DATE('".date2_formatdb($_POST['datepicker3'])."','YYYY-MM-DD')"; else $date3 = NULL;
	if($_POST['datepicker4'] != "") $date4 = "TO_DATE('".date2_formatdb($_POST['datepicker4'])."','YYYY-MM-DD')"; else $date4 = NULL;
	if($_POST['date_start_work3'] != "") $date_start_work3 = "TO_DATE('".date2_formatdb($_POST['date_start_work3'])."','YYYY-MM-DD')"; else $date_start_work3 = NULL;
	if($_POST['date_start_pay3'] != "") $date_start_pay3 = "TO_DATE('".date2_formatdb($_POST['date_start_pay3'])."','YYYY-MM-DD')"; else $date_start_pay3 = NULL;
	/*$date3 = date2_formatdb($_POST['datepicker3']);
	$date4 = date2_formatdb($_POST['datepicker4']);
	$date_start_work3 = date2_formatdb($_POST['date_start_work3']);
	$date_start_pay3 = date2_formatdb($_POST['date_start_pay3']);*/
	$count_days_2 = $_POST['count_days_2'];
	$mch3 = removecomma($_POST['mch3']);
	$ddays = removecomma($_POST['ddays']);
	$bpd = removecomma($_POST['bpd']);
	if($_POST['datepicker5'] != "") $date5 = "TO_DATE('".date2_formatdb($_POST['datepicker5'])."','YYYY-MM-DD')"; else $date5 = NULL;
	if($_POST['datepicker6'] != "") $date6 = "TO_DATE('".date2_formatdb($_POST['datepicker6'])."','YYYY-MM-DD')"; else $date6 = NULL;
	/*$date5 = date2_formatdb($_POST['datepicker5']);
	$date6 = date2_formatdb($_POST['datepicker6']);*/
	$count_days_3 = removecomma($_POST['count_days_3']);
	$remain_days = removecomma($_POST['remain_days']);
	$remain_money = removecomma($_POST['remain_money']);
	$mch4 = removecomma($_POST['mch4']);
	$ttfee = removecomma($_POST['ttfee']);
	$grand_total = removecomma($_POST['grand_total']);
	
	$date_present = NULL;
	$date_present2 = "TO_DATE('".date2_formatdb($_POST['date_present2'])."','YYYY-MM-DD')";
	if($_POST['date_present2'] == ""){
		$date_present2 = NULL;
	}
    if($numrow == 0){
	$db->add_db(TB_SCH_PAY_BACK_TAB,array(
											  "EMP_ID"=>"$emp_id",
											  "PAY_TYPE"=>"$pay_type",
											  "SCHOLAR1"=>"$scholar1",
											  "DATE1"=>"$date1",
											  "DATE2"=>"$date2",
											  "DATE_START_PAY1"=>"$date_start_pay1",
											  "COUNTDATE1"=>"$countdate1",
											  "MULTIPLY1"=>"$multiply1",
											  "DAYS1"=>"$days1",
											  "SCHOLAR3"=>"$scholar3",
											  "DATE3"=>"$date3",
											  "DATE4"=>"$date4",
											  "DATE_START_WORK3"=>"$date_start_work3",
											  "DATE_START_PAY3"=>"$date_start_pay3",
											  "COUNT_DAYS_2"=>"$count_days_2",
											  "MCH3"=>"$mch3",
											  "DDAYS"=>"$ddays",
											  "BPD"=>"$bpd",
											  "DATE5"=>"$date5",
											  "DATE6"=>"$date6",
											  "COUNT_DAYS_3"=>"$count_days_3",
											  "REMAIN_DAYS"=>"$remain_days",
											  "REMAIN_MONEY"=>"$remain_money",
											  "MCH4"=>"$mch4",
											  "TTFEE"=>"$ttfee",
											  "GRAND_TOTAL"=>"$grand_total",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user",
											  "DATE_PRESENT"=>"$date_present",
											  "DATE_PRESENT2"=>"$date_present2"
											  ),$conn);
}else{
	$db->update_db(TB_SCH_PAY_BACK_TAB,array(
											  "PAY_TYPE"=>"$pay_type",
											  "SCHOLAR1"=>"$scholar1",
											  "DATE1"=>"$date1",
											  "DATE2"=>"$date2",
											  "DATE_START_PAY1"=>"$date_start_pay1",
											  "COUNTDATE1"=>"$countdate1",
											  "MULTIPLY1"=>"$multiply1",
											  "DAYS1"=>"$days1",
											  "SCHOLAR3"=>"$scholar3",
											  "MONEY3"=>"$money3",
											  "DATE3"=>"$date3",
											  "DATE4"=>"$date4",
											  "DATE_START_WORK3"=>"$date_start_work3",
											  "DATE_START_PAY3"=>"$date_start_pay3",
											  "COUNT_DAYS_2"=>"$count_days_2",
											  "MCH3"=>"$mch3",
											  "DDAYS"=>"$ddays",
											  "BPD"=>"$bpd",
											  "DATE5"=>"$date5",
											  "DATE6"=>"$date6",
											  "COUNT_DAYS_3"=>"$count_days_3",
											  "REMAIN_DAYS"=>"$remain_days",
											  "REMAIN_MONEY"=>"$remain_money",
											  "MCH4"=>"$mch4",
											  "TTFEE"=>"$ttfee",
											  "GRAND_TOTAL"=>"$grand_total",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user",
											  "DATE_PRESENT"=>"$date_present",
											  "DATE_PRESENT2"=>"$date_present2"
											  )," EMP_ID = '$emp_id'  ",$conn);
}

}


$db->closedb($conn);
?>
<script language="javascript">
window.top.$("span#waiting4").html("");
//window.top.document.getElementById("pay_scholar").reset();
//window.top.$('#b3').hide("fast");
//window.top.$('#b2').hide("fast");
//window.top.$('#b1').hide("fast");
//window.top.$('#b4').hide("fast");
//window.top.change_data('scholar.php','../images/head2/work_data/scholar.png');
//window.top.$('#pay_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
//window.top.$('#pay_list').load('sch_pay_table.php');
<? 
if($pay_type == "1"){
?>
window.top.$('#b1').load('sch_b1.php?t=<?=time()?>');
<? 
}elseif($pay_type == "2"){
?>
window.top.$('#b2').load('sch_b2.php?t=<?=time()?>');
<? 
}elseif($pay_type == "3"){
?>
window.top.$('#b3').load('sch_b3.php?t=<?=time()?>');
<? 
}
?>
</script>