<?
@session_start();
	//if($_POST){
	$fpath = '../';
	require_once($fpath."includes/connect.php");
	include "update_by.php";
	
	$emp_id = $_SESSION["EMP_ID"];
	$no_num=$_POST["no_num"];
	$category=$_POST["category"];
	$munny_num=$_POST["munny_num"];
	if($_POST["date_opan"]!=""){
		$date_opan = date2_formatdb($_POST["date_opan"]);
	}else{
		$date_opan="";
	}
	$no_record=$_POST["no_record"];
	$note_c=$_POST["note_c"];
	$contract_fund=$_POST["contract_fund"];
	$num_munny=$_POST["num_munny"];
	$sum_mo=$num_munny-$munny_num;

	 $wrk_id =  $_POST["id_p"]; // ใช้ตรวจสอบว่า add(null) หรือ update(not null)
	$dr=date("Y")+543;
    $dd=date("d/m/").$dr;
	$create_s = date2_formatdb($dd);
	$sql_sch_country = "select max(P_ID)as P_ID from SDU_PAY_TAB";
	  $stid_sch_country = oci_parse($conn, $sql_sch_country);
	  oci_execute($stid_sch_country); 
	     while ($row_sch_country = oci_fetch_array($stid_sch_country, OCI_BOTH)) {
			  echo $oo=$row_sch_country["P_ID"]+1;
			 
		 }
		//if($munny_num!=""){
			/*$result=$db->update_db(TB_SDU_MUNNY_TAB,array(
											  "MUNNY_ALL"=>"$sum_mo"
					  ),"CT_NO = '$contract_fund'",$conn);
			
			
		}*/
function upload_file($name,$array){
	global $emp_id;
	$array_last=explode(".",$_FILES["{$name}"]["name"]);
	$last=strtolower($array_last[count($array_last)-1]);
	$file_name="fund_{$emp_id}_".$array.".{$last}";
	$target_path = "files/fund_file/$file_name";
	
	if(@move_uploaded_file($_FILES["{$name}"]["tmp_name"], $target_path)) {
		
		return $file_name;
	}else{
		@unlink($_FILES["{$name}"]["tmp_name"]);
		return false;
	}
}
	
if($wrk_id == "" ){
	//echo "ok";
		if($_FILES["file_munny"]["tmp_name"]){
			$file_name = upload_file("file_munny",$oo);
		}else{
			$file_name=$_POST["file_old_munny"];
		}	
			 
		//$m_id =auto_increment("M_ID",TB_SDU_FUND);
		$result=$db->add_db(TB_SDU_PAY_TAB,array(
											  "P_ID"=>"$oo",
											  "EMP_ID"=>"$emp_id",
											  "CATEGORY"=>"$category",
											  "MUNNY_NUM"=>"$munny_num",
											  "DATE_OPAN"=>"TO_DATE('$date_opan','YYYY-MM-DD')",
											  "NO_RECORD"=>"$no_record",
											  "NOTE_C"=>"$note_c",
											  "CREATE_DATE"=>"TO_DATE('$create_s','YYYY-MM-DD')",
											  "NO_NUM"=>"$no_num",
											  "ID"=>"$oo",
											  "CT_NO"=>"$contract_fund",
											  "NUM_MUNNY"=>"$wq",
											  "MUNNY_FILE"=>$file_name
											  ),$conn); 
		//$type_update = "1";
	}else{
		//echo"no";
		if($_FILES["file_munny"]["tmp_name"]){
			$file_name = upload_file("file_munny",$wrk_id);
		}else{
			$file_name=$_POST["file_old_munny"];
		}	
		$result=$db->update_db(TB_SDU_PAY_TAB,array(
											  "CATEGORY"=>"$category",
											  "MUNNY_NUM"=>"$munny_num",
											  "DATE_OPAN"=>"TO_DATE('$date_opan','YYYY-MM-DD')",
											  "NO_RECORD"=>"$no_record",
											  "NOTE_C"=>"$note_c",
											  "CREATE_DATE"=>"TO_DATE('$create_s','YYYY-MM-DD')",
											  "NO_NUM"=>"$no_num",
											  "CT_NO"=>"$contract_fund",
											  "MUNNY_FILE"=>$file_name
					  ),"ID = '$wrk_id'",$conn); 
		//$type_update = "2";
	}
if($result){
			//save_completed("Save_success");
			reset_form_iframe("work_history");
			if($type_update == "1") access_log($fpath.'_log',"",$update_by,"เพิ่ม 'ประวัติการทำงานในอดีต id = $wrk_id' ($emp_id)");
			elseif($type_update == "2") access_log($fpath.'_log',"",$update_by,"ปรับปรุง 'ประวัติการทำงานในอดีต id = $wrk_id' ($emp_id)");
			?>
			<script language="javascript">
			 window.top.change_data('scholar.php','../images/head2/work_data/scholar.png');
			//window.top.$("span#waiting6").html("");
			//window.top.document.getElementById("contract_extend").reset();
			//window.top.change_data('scholar.php','../images/head2/work_data/scholar.png');
			//window.top.$('#pay_list').html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
			//window.top.$('#pay_list').load('pay_fund_table.php');
			//document.getElementById("data_form3").style.display = "none";
			</script>
			<?
		}else{
			save_completed("Save_error");
?>
<script language="javascript">
//window.top.$("span#waiting6").html("");
</script>
<?
exit();

		}

//$db->closedb($conn);	
?>
<script language="javascript">
//var ran=Math.random();
window.top.$("span#waiting6").html("");
indow.top.load_page("pay_fund_table.php?"+ran);
</script>
<?
//}
?>

