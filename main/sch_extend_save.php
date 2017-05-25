<?
@session_start();
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
if($_POST["id_ex"] == "") $id_ex = auto_increment("ID",TB_SCHOLAR_CONTRACT_EX_TAB);
else $id_ex = $_POST["id_ex"];
$ex_order_no = $_POST["ex_order_no"];
$ex_contract = $_POST["ex_contract"];
$ex_at = $_POST["ex_at"];
$ex_old_date1 = "";
$ex_old_date2 = "";
$ex_start_date = "";
$ex_end_date = "";
$ex_at_date = "";
if($_POST["ex_old_date1"] != "") $ex_old_date1 = date2_formatdb($_POST["ex_old_date1"]);
if($_POST["ex_old_date2"] != "") $ex_old_date2  = date2_formatdb($_POST["ex_old_date2"]);
if($_POST["ex_start_date"] != "") $ex_start_date = date2_formatdb($_POST["ex_start_date"]);
if($_POST["ex_end_date"] != "") $ex_end_date  = date2_formatdb($_POST["ex_end_date"]);
if($_POST["ex_at_date"] != "") $ex_at_date = date2_formatdb($_POST["ex_at_date"]);
if($_POST["ex_start_date_return"] != "") $ex_start_date_return = date2_formatdb($_POST["ex_start_date_return"]);
$ex_start_return_order = $_POST["ex_start_return_order"];
$ex_start_return_order_no = $_POST["ex_start_return_order_no"];
if($_POST["ex_start_return_date"] != "") $ex_start_return_date = date2_formatdb($_POST["ex_start_return_date"]);
$date = date("Y-m-d");

$numrow = $db->count_row(TB_SCHOLAR_CONTRACT_EX_TAB," WHERE EMP_ID = '$emp_id' AND ID='$id_ex' ",$conn); 

if($numrow == 0){
	$db->add_db(TB_SCHOLAR_CONTRACT_EX_TAB,array(
		  "EMP_ID"=>"$emp_id",
		  "ID"=>"$id_ex",
		  "EX_OLD_DATE1"=>"TO_DATE('$ex_old_date1','YYYY-MM-DD')",
		  "EX_OLD_DATE2"=>"TO_DATE('$ex_old_date2','YYYY-MM-DD')",
		  "EX_START_DATE"=>"TO_DATE('$ex_start_date','YYYY-MM-DD')",
		  "EX_END_DATE"=>"TO_DATE('$ex_end_date','YYYY-MM-DD')",
		  "EX_ORDER_NO"=>"$ex_order_no",
		  "EX_CONTRACT"=>"$ex_contract",
		  "EX_AT"=>"$ex_at",
		  "EX_AT_DATE"=>"TO_DATE('$ex_at_date','YYYY-MM-DD')",
		  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
		  "EX_START_DATE_RETURN"=>"$ex_start_date_return",
		  "EX_START_RETURN_ORDER"=>"$ex_start_return_order",
		  "EX_START_RETURN_ORDER_NO"=>"$ex_start_return_order_no",
		  "EX_START_RETURN_DATE"=>"$ex_start_return_date",
		  "UPDATE_BY"=>"$update_user"
		  ),$conn);
}else{ 
	$db->update_db(TB_SCHOLAR_CONTRACT_EX_TAB,array(
		  "EX_OLD_DATE1"=>"TO_DATE('$ex_old_date1','YYYY-MM-DD')",
		  "EX_OLD_DATE2"=>"TO_DATE('$ex_old_date2','YYYY-MM-DD')",
		  "EX_START_DATE"=>"TO_DATE('$ex_start_date','YYYY-MM-DD')",
		  "EX_END_DATE"=>"TO_DATE('$ex_end_date','YYYY-MM-DD')",
		  "EX_ORDER_NO"=>"$ex_order_no",
		  "EX_CONTRACT"=>"$ex_contract",
		  "EX_AT"=>"$ex_at",
		  "EX_AT_DATE"=>"TO_DATE('$ex_at_date','YYYY-MM-DD')",
		  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
		  "EX_START_DATE_RETURN"=>"$ex_start_date_return",
		  "EX_START_RETURN_ORDER"=>"$ex_start_return_order",
		  "EX_START_RETURN_ORDER_NO"=>"$ex_start_return_order_no",
		  "EX_START_RETURN_DATE"=>"$ex_start_return_date",
		  "UPDATE_BY"=>"$update_user"
		  )," EMP_ID = '$emp_id' AND ID = '$id_ex' ",$conn);
}
?>
<script language="javascript">
window.top.$("span#waiting3").html("");
window.top.document.getElementById("contract_extend").reset();
window.top.$('#ex_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
window.top.$('#ex_list').load('sch_ex_table.php');
</script>