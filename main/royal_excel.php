<?
if($_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$_REQUEST["all"]."_royal_report_".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
$fpath = '../';
require_once($fpath."includes/connect.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body,td,th {
	font-family: Tahoma, "Microsoft Sans Serif", Verdana;
	font-size:14px;
}
</style>
<?
if($_REQUEST["all"] != "all"){
	$sql =  "SELECT ROY_NAME FROM  ".TB_ROYAL_TAB." WHERE ROY_ID = '".$_REQUEST["royal_id"]."' "; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$row = oci_fetch_array($stid, OCI_BOTH);
	$royal_name = $row['ROY_NAME'];
	
 	 $sql2 = "SELECT * FROM  ".TB_ROYAL_TAB." WHERE ROY_NAME = '$royal_name' "; 
	 $stid2 = oci_parse($conn, $sql2 );
	 oci_execute($stid2);
	 $numrow = $db->count_row(TB_ROYAL_TAB," WHERE ROY_NAME = '".$royal_name."' ",$conn);
		echo "<div><h3 align='left' style='padding-left:50px'>".$royal_name."</h3>\n";
		echo "<table width=\"700\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\" bordercolor=\"#000000\">\n";
		echo "<tr>\n";
		echo "<th align='center' width='100px'>รหัส</th>\n";	
		echo "<th align='center' width='220px'>ชื่อ - นามสกุล</th>\n";	
		echo "<th align='center' width='100px'>เมื่อวันที่</th>\n";	
		echo "<th align='center'>ราชกิจจานุเบกษา</th>\n";	
		echo "</tr>\n";
	while (($row2 = oci_fetch_array($stid2, OCI_BOTH))) {
		if($row2['ROY_NO1'] != "") $t1 = "เล่มที่ ".$row2['ROY_NO1']." ตอนที่ ".$row2['ROY_NO2']; else $t1 = "";
		echo "<tr>\n";
		echo "<td align='center'>".get_emp_id($row2['EMP_ID'],TB_BIODATA_TAB)."</td>\n";	
		echo "<td align='left' style='padding-left:10px'>".get_name($row2['EMP_ID'],TB_BIODATA_TAB)."</td>\n";	
		echo "<td align='center'>05/12/".$row2['ROY_YEAR']."</td>\n";	
		echo "<td align='center'>$t1</td>\n";	
		echo "</tr>\n";
	}
	echo "<tr><td colspan='4' align='right'><b>สรุปจำนวนบุคลากรที่ได้รับ ".$numrow." คน</b></td></tr>\n";
	echo "</table></div>\n";
}else{
	$sql = "SELECT DISTINCT(ROY_NAME) FROM  ".TB_ROYAL_TAB." ORDER BY ROY_NAME ASC "; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);

	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	 $sql2 = "SELECT * FROM  ".TB_ROYAL_TAB." WHERE ROY_NAME = '".$row["ROY_NAME"]."' "; 
	 $stid2 = oci_parse($conn, $sql2 );
	 oci_execute($stid2);
	 $numrow = $db->count_row(TB_ROYAL_TAB," WHERE ROY_NAME = '".$row["ROY_NAME"]."' ",$conn);
		echo "<div><h3 align='left' style='padding-left:50px'>".$row["ROY_NAME"]."</h3>\n";
		echo "<table width=\"700\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\" bordercolor=\"#000000\">\n";
		echo "<tr>\n";
		echo "<th align='center' width='100px'>รหัส</th>\n";	
		echo "<th align='center' width='220px'>ชื่อ - นามสกุล</th>\n";	
		echo "<th align='center' width='100px'>เมื่อวันที่</th>\n";	
		echo "<th align='center'>ราชกิจจานุเบกษา</th>\n";	
		echo "</tr>\n";
	while (($row2 = oci_fetch_array($stid2, OCI_BOTH))) {
		if($row2['ROY_NO1'] != "") $t1 = "เล่มที่ ".$row2['ROY_NO1']." ตอนที่ ".$row2['ROY_NO2']; else $t1 = "";
		echo "<tr>\n";
		echo "<td align='center'>".get_emp_id($row2['EMP_ID'],TB_BIODATA_TAB)."</td>\n";	
		echo "<td align='left' style='padding-left:10px'>".get_name($row2['EMP_ID'],TB_BIODATA_TAB)."</td>\n";	
		echo "<td align='center'>05/12/".$row2['ROY_YEAR']."</td>\n";	
		echo "<td align='center'>$t1</td>\n";	
		echo "</tr>\n";
	}
	echo "<tr><td colspan='4' align='right'><b>สรุปจำนวนบุคลากรที่ได้รับ ".$numrow." คน</b></td></tr>\n";
	echo "</table></div>\n";
	
}
}

$db->closedb($conn);	
if($_REQUEST['print'] == "1"){
?>
<script language="javascript">
window.print();
var t=setTimeout("window.close()",300)
</script>

<?
}
?>