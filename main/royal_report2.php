<?
@session_start();
@ini_set('max_execution_time', 800);
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>

<? }
?>
<div  align="center">
<?
$fpath = '../';
require_once($fpath."includes/connect.php");
$sql = "SELECT DISTINCT(ROY_NAME) FROM  ".TB_ROYAL_TAB." ORDER BY ROY_NAME ASC "; 
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$num = $db->count_row(TB_ROYAL_TAB," GROUP BY ROY_NAME ",$conn);
if($num>0){
echo "<input type='button' value='Print all' onclick=\"window.open('royal_excel.php?all=all&print=1','report','width=800,height=500')\"/> <input type='button' value='Export all' onclick=\"window.location='royal_excel.php?all=all&excel=1'\" /><br />";
}

while($row = oci_fetch_array($stid, OCI_BOTH)){
	 $sql2 = "SELECT * FROM  ".TB_ROYAL_TAB." WHERE ROY_NAME = '".$row["ROY_NAME"]."' "; 
	 $stid2 = oci_parse($conn, $sql2 );
	 oci_execute($stid2);
	 $numrow = $db->count_row(TB_ROYAL_TAB," WHERE ROY_NAME = '".$row["ROY_NAME"]."' ",$conn);
		echo "<div><h3 align='left' style='padding-left:50px'>".$row["ROY_NAME"]."</h3>\n";
		echo "<table width=\"700\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\"  bordercolor=\"#000000\">\n";
		echo "<tr>\n";
		echo "<th align='center' width='100px'>รหัส</th>\n";	
		echo "<th align='center' width='220px'>ชื่อ - นามสกุล</th>\n";	
		echo "<th align='center' width='100px'>เมื่อวันที่</th>\n";	
		echo "<th align='center'>ราชกิจจานุเบกษา</th>\n";	
		echo "</tr>\n";
	while($row2 = oci_fetch_array($stid2, OCI_BOTH)){
		if($row2['ROY_NO1'] != "") $t1 = "เล่มที่ ".$row2['ROY_NO1']." ตอนที่ ".$row2['ROY_NO2']; else $t1 = "";
		echo "<tr>\n";
		echo "<td align='center'>".get_emp_id($row2['EMP_ID'],TB_BIODATA_TAB)."</td>\n";	
		echo "<td align='left' style='padding-left:10px'>".get_name($row2['EMP_ID'],TB_BIODATA_TAB)."</td>\n";	
		echo "<td align='center'>05/12/".$row2['ROY_YEAR']."</td>\n";	
		echo "<td align='center'>$t1</td>\n";	
		echo "</tr>\n";
	}
	
	$sqll = "SELECT ROY_ID FROM  ".TB_ROYAL_TAB." WHERE ROY_NAME = '".$row["ROY_NAME"]."' "; 
	$stidd = oci_parse($conn, $sqll );
	 oci_execute($stidd);
	$roww = oci_fetch_array($stidd, OCI_BOTH);
	echo "<tr><td colspan='4' align='right'><b>สรุปจำนวนบุคลากรที่ได้รับ ".$numrow." คน</b></td></tr>\n";
	echo "</table></div>\n<p align='right' style='padding-right:33px'><input type='button' value='Print' onclick=\"window.open('royal_excel.php?all=&royal_id=".$roww["ROY_ID"]."&print=1','report','width=800,height=500')\"/> <input type='button' value='Export to excel' onclick=\"window.location='royal_excel.php?all=&royal_id=".$roww["ROY_ID"]."&excel=1'\" /></p><br />\n";
	
}
$db->closedb($conn);	
if($num>0){
echo "<input type='button' value='Print all' onclick=\"window.open('royal_excel.php?all=all&print=1','report','width=800,height=500')\"/> <input type='button' value='Export all' onclick=\"window.location='royal_excel.php?all=all&excel=1'\" /><br />";
}
?>
</div>