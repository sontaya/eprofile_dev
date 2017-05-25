<?
@session_start();
if($_POST){
$fpath = '../';
require_once($fpath."includes/connect.php");
include "update_by.php";
$emp_id = $_SESSION["EMP_ID"];
$rec_id = $_POST["rec_id"];
$rec_order_no = pea_substr(trim($_POST["rec_order_no"]),50);
$rec_at = pea_substr(trim($_POST["rec_at"]),50);

$rec_at_date = "";
if($_POST["rec_at_date"] != "") $rec_at_date = date2_formatdb($_POST["rec_at_date"]);

$rec_type = $_POST["rec_type"];
$rec_year = $_POST["rec_year"];
$rec_name = pea_substr(trim($_POST["rec_name"]),150);
$rec_prices = pea_substr(trim(removecomma($_POST["rec_prices"])),10);
$rec_source = pea_substr(trim($_POST["rec_source"]),150);
$rec_start_date = "";
$rec_end_date = "";
if($_POST["rec_start_date"] != "") $rec_start_date = date2_formatdb($_POST["rec_start_date"]);
if($_POST["rec_end_date"] != "") $rec_end_date  =date2_formatdb($_POST["rec_end_date"]);

$numrow = $db->count_row(TB_RESEARCH_TAB," WHERE EMP_ID = '$emp_id' AND REC_ID = '$rec_id' ",$conn); 

if($numrow == 0){
	$rec_id = auto_increment("REC_ID",TB_RESEARCH_TAB);
		$result=$db->add_db(TB_RESEARCH_TAB,array(
 											  "EMP_ID"=>"$emp_id",
											  "REC_ID"=>"$rec_id",
											  "REC_ORDER_NO"=>"$rec_order_no",
											  "REC_AT"=>"$rec_at",
											  "REC_AT_DATE"=>"TO_DATE('$rec_at_date','YYYY-MM-DD')",
											  "REC_TYPE"=>"$rec_type",
											  "REC_YEAR"=>"$rec_year",
											  "REC_NAME"=>"$rec_name",
											  "REC_PRICES"=>"$rec_prices",
											  "REC_SOURCE"=>"$rec_source",
											  "REC_START_DATE"=>"TO_DATE('$rec_start_date','YYYY-MM-DD')",
											  "REC_END_DATE"=>"TO_DATE('$rec_end_date','YYYY-MM-DD')",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
											  ),$conn); 
		$type_update = "1";
	}else{
		$result=$db->update_db(TB_RESEARCH_TAB,array(
											  "REC_ORDER_NO"=>"$rec_order_no",
											  "REC_AT"=>"$rec_at",
											  "REC_AT_DATE"=>"TO_DATE('$rec_at_date','YYYY-MM-DD')",
											  "REC_TYPE"=>"$rec_type",
											  "REC_YEAR"=>"$rec_year",
											  "REC_NAME"=>"$rec_name",
											  "REC_PRICES"=>"$rec_prices",
											  "REC_SOURCE"=>"$rec_source",
											  "REC_START_DATE"=>"TO_DATE('$rec_start_date','YYYY-MM-DD')",
											  "REC_END_DATE"=>"TO_DATE('$rec_end_date','YYYY-MM-DD')",
											  "LAST_UPDATE"=>"TO_DATE('".date("Y-m-d H:i:s")."','YYYY-MM-DD HH24:MI:SS')",
											  "UPDATE_BY"=>"$update_user"
					  ),"EMP_ID='$emp_id' AND REC_ID = '$rec_id'",$conn); 
		$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			//reset_form_iframe("research");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ข้อมูล ขอทุนวิจัย หมายเลขคำสั่ง $rec_order_no ' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ข้อมูล ขอทุนวิจัย หมายเลขคำสั่ง $rec_order_no ' ($emp_id)");
			?>
			<script language="javascript">
			//window.top.load_res_table();
			window.top.change_data('research_creative.php','../images/head2/work_data/research.png');
			</script>
			<?
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
//var ran=Math.random();
window.top.document.research.rec_order_no.readOnly = false;
window.top.$("span#waiting").html("");
//indow.top.load_page("current_address.php?"+ran);
</script>
<?
}
?>