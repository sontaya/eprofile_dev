<?
@session_start();
	//if($_POST){
	$fpath = '../';
	require_once($fpath."includes/connect.php");
	include "update_by.php";
	echo $a=$_POST["date_staer_wb_two"];
	echo $b=$_POST["date_staer_wb_two"];
	
	echo $emp_id = $_SESSION["EMP_ID"];
	echo $capital=$_POST["capital"];
	echo $munny_full=$_POST["munny_full"];
	echo $ct_no=$_POST["ct_no"];
	if($_POST["date_start"]!=""){
		echo $date_start = date2_formatdb($_POST["date_start"]);
	}else{
		$date_start="";
	}
	if($_POST["date_end"]!=""){
		echo $date_end = date2_formatdb($_POST["date_end"]);
	}else{
		$date_end="";
	}
	echo $nb_money=$_POST["nb_money"];
	echo $flag=$_POST["flag"];
	if($_POST["flag_date"]!=""){
		echo $flag_date = date2_formatdb($_POST["flag_date"]);
	}else{
		$flag_date="";
	}
	echo $note=$_POST["note"];
	echo $money_one=$_POST["money_one"];
	echo $wb_one=$_POST["wb_one"];
	if($a!=""){
		echo $date_staer_wb_one = date2_formatdb($_POST["date_staer_wb_one"]);
	}else{
		$date_staer_wb_one="";
	}
	echo $money_two=$_POST["money_two"];
	echo $wb_two=$_POST["wb_two"];
	if($b!=""){
		echo $date_staer_wb_two = date2_formatdb($_POST["date_staer_wb_two"]);
	}else{
		$date_staer_wb_two="";
	}
	
	echo $money_thee=$_POST["money_thee"];
	echo $wb_thee=$_POST["wb_thee"];
	if($_POST["date_staer_wb_thee"]!=""){
		echo $date_staer_wb_thee = date2_formatdb($_POST["date_staer_wb_thee"]);
	}else{
		$date_staer_wb_thee="";
	}
	if($_POST["flag_date"]!=""){
	echo $flag_date = date2_formatdb($_POST["flag_date"]);
	}else{
		$flag_date="";
	}
	$munny_all=$money_one+$money_two+$money_thee+$nb_money;
	echo $wrk_id =  $_POST["wrk_id"]; // ใช้ตรวจสอบว่า add(null) หรือ update(not null)
	$dr=date("Y")+543;
    $dd=date("d/m/").$dr;
	$create_s = date2_formatdb($dd);
function upload_file($name,$array){
	global $emp_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"]);
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="mon_fund_{$emp_id}_".$array.".{$last}";
	$target_path = "files/money_fund_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}
if($wrk_id == "" ){
	//echo "ok";
	$sql_sch_country = "select max(M_ID)as M_ID from SDU_MUNNY_TAB";
	  $stid_sch_country = oci_parse($conn, $sql_sch_country);
	  oci_execute($stid_sch_country); 
	     while ($row_sch_country = oci_fetch_array($stid_sch_country, OCI_BOTH)) {
			  $oo=$row_sch_country["M_ID"]+1;
		 }
		if($_FILES["file_money_fund"]["tmp_name"]){
			$file_name = upload_file("file_money_fund",$oo);
		}else{
			$file_name=$_POST["file_old_money_fund"];
		}
		//$m_id =auto_increment("M_ID",TB_SDU_FUND);
		$result=$db->add_db(TB_SDU_MUNNY_TAB,array(
											  "EMP_ID"=>"$emp_id",
											  "CAPITAL"=>"$capital",
											  "CT_NO"=>"$ct_no",
											  "DATE_START"=>"TO_DATE('$date_start','YYYY-MM-DD')",
											  "DATE_END"=>"TO_DATE('$date_end','YYYY-MM-DD')",
											  "NB_MONEY"=>"$nb_money",
											  "FLAG"=>"",
											  "DATE_FLAG"=>"",
											  "NOTE"=>"$note",
											  "MONEY_ONE"=>"$money_one",
											  "WB_ONE"=>"$wb_one",
											  "DATE_STAER_WB_ONE"=>"TO_DATE('$date_staer_wb_one','YYYY-MM-DD')",
											  "MONEY_TWO"=>"$money_two",
											  "WB_TWO"=>"$wb_two",
											  "DATE_STAER_WB_TWO"=>"TO_DATE('$date_staer_wb_two','YYYY-MM-DD')",
											  "MONEY_THEE"=>"$money_thee",
											  "WB_THEE"=>"$wb_thee",
											  "DATE_STAER_WB_THEE"=>"TO_DATE('$date_staer_wb_thee','YYYY-MM-DD')",
											  "FLAG_DATE"=>"TO_DATE('$flag_date','YYYY-MM-DD')",
											  "CREATE_DATE"=>"TO_DATE('$create_s','YYYY-MM-DD')",
											  "M_ID"=>"$oo",
											  "MUNNY_FULL"=>"$munny_full",
											  "MUNNY_ALL"=>"$munny_all",
											  "MUNNY_ALL2"=>"$munny_all",
											  "MUNNY_FILE"=>"$file_name"
											  ),$conn); 
		//$type_update = "1";
	}else{
		//echo"no";
		if($_FILES["file_money_fund"]["tmp_name"]){
			$file_name = upload_file("file_money_fund",$wrk_id);
		}else{
			$file_name=$_POST["file_old_money_fund"];
		}
		$result=$db->update_db(TB_SDU_MUNNY_TAB,array(
											  "EMP_ID"=>"$emp_id",
											  "CAPITAL"=>"$capital",
											  "CT_NO"=>"$ct_no",
											  "DATE_START"=>"TO_DATE('$date_start','YYYY-MM-DD')",
											  "DATE_END"=>"TO_DATE('$date_end','YYYY-MM-DD')",
											  "NB_MONEY"=>"$nb_money",
											  "FLAG"=>"$flag",
											  "DATE_FLAG"=>"TO_DATE('$flag_date','YYYY-MM-DD')",
											  "NOTE"=>"$note",
											  "MONEY_ONE"=>"$money_one",
											  "WB_ONE"=>"$wb_one",
											  "DATE_STAER_WB_ONE"=>"TO_DATE('$date_staer_wb_one','YYYY-MM-DD')",
											  "MONEY_TWO"=>"$money_two",
											  "WB_TWO"=>"$wb_two",
											  "DATE_STAER_WB_TWO"=>"TO_DATE('$date_staer_wb_two','YYYY-MM-DD')",
											  "MONEY_THEE"=>"$money_thee",
											  "WB_THEE"=>"$wb_thee",
											  "DATE_STAER_WB_THEE"=>"TO_DATE('$date_staer_wb_thee','YYYY-MM-DD')",
											  "FLAG_DATE"=>"TO_DATE('$flag_date','YYYY-MM-DD')",
											  "CREATE_DATE"=>"TO_DATE('$create_s','YYYY-MM-DD')",
											  "MUNNY_FULL"=>"$munny_full",
											  "MUNNY_ALL"=>"$munny_all",
											  "MUNNY_ALL2"=>"$munny_all",
  											  "MUNNY_FILE"=>"$file_name"
					  ),"M_ID = '$wrk_id'",$conn); 
		//$type_update = "2";
	}

		if($result){
			//save_completed("Save_success");
			echo "ok";
			reset_form_iframe("work_history");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ประวัติการทำงานในอดีต id = $wrk_id' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ประวัติการทำงานในอดีต id = $wrk_id' ($emp_id)");
			?>
			<script language="javascript">
			window.top.$("span#waiting5").html("");
			window.top.document.getElementById("contract_extend").reset();
			window.top.$('#money_fund_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
			window.top.$('#money_fund_list').load('money_fund_table.php');
			document.getElementById("data_form2").style.display = "none";
			</script>
			<?
		}else{
			save_completed("Save_error");
?>
<script language="javascript">
//window.top.$("span#waiting5").html("");
</script>
<?
exit();

		}

//$db->closedb($conn);	
?>
<script language="javascript">
//var ran=Math.random();
window.top.$("span#waiting5").html("");
//indow.top.load_page("current_address.php?"+ran);
</script>
<?
//}
?>