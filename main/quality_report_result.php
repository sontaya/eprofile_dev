<?
$type = @$_REQUEST['type'];@date_default_timezone_set("Asia/Bangkok");
@ini_set('max_execution_time', 800);
if(@$_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=quality_report_type(".$type.")".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
$t1 = 0;
$t2 = 0;
$t3 = 0;
$t4 = 0;
$t5 = 0;
$t6 = 0;
include("../includes/connect.php");
$all_person = 0;
?>
<style type="text/css">
.t_head{
	font-family:Tahoma, Geneva, sans-serif;
	font-size:14px;
}
.sub{
	font-family:Tahoma, Geneva, sans-serif;
	padding-left: 25px;
	font-size:14px;
	
}
.sub2{
	font-family:Tahoma, Geneva, sans-serif;
	padding-left: 50px;
	font-size:14px;
}
.sub3{
	font-family:Tahoma, Geneva, sans-serif;
	padding-left: 5px;
	font-size:14px;
}
.sub4{
	font-family:Tahoma, Geneva, sans-serif;
	padding-right: 10px;
	font-size:14px;
	font-weight:bold;
}
.sub44{
	font-family:Tahoma, Geneva, sans-serif;
	padding-right: 10px;
	font-size:14px;
}
.main_sub{
	font-family:Tahoma, Geneva, sans-serif;
	font-weight:bold;
	font-size:14px;
}

</style>
<?
if($type == "1"){
?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">รายงานสัดส่วนอาจารย์จำแนกตามตำแหน่งวิชาการ แยกตามหน่วยงาน</h3>
<table  border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="255" align="center" class="t_head">หน่วยงาน</th>
    <th width="27" align="center" class="t_head">ศ.<br />(%)</th>
    <th width="27" align="center" class="t_head">รศ.<br />(%)</th>
    <th width="65" align="center" class="t_head">รศ.พิเศษ<br />(%)</th>
    <th width="27" align="center" class="t_head">ผศ.<br />(%)</th>
    <th width="65" align="center" class="t_head">ผศ.พิเศษ<br />(%)</th>
    <th width="60" align="center" class="t_head">อาจารย์<br />(%)</th>
    <!--<th width="46" align="center" class="t_head">รวม</th>-->
  </tr>
<?
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$num5_all = 0;
$num6_all = 0;
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {// department 15 records
	$num1 = 0;// ศ. 04
	$num2 = 0;// รศ. 03
	$num3 = 0;// รศ.พิเศษ 06
	$num4 = 0;// ผศ. 02
	$num5 = 0;// ผศ.พิเศษ 05
	$num6 = 0;// อาจารย์ 01
	$p1 = 0;
	$p2 = 0;
	$p3 = 0;
	$p4 = 0;
	$p5 = 0;
	$p6 = 0;
		$sql_all = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS <> '00'  AND CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_all = oci_parse($conn, $sql_all );
		oci_execute($stid_all);
		$num =  oci_fetch_array($stid_all, OCI_BOTH);
		$all_person = $num[0];//จะนวนอาจารย์ทั้งหมดแต่ละแผนก
		
		if($all_person > 0){
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '04' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num1 = ($num[0]/$all_person)*100;
		$p1 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '03' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num2 = ($num[0]/$all_person)*100;
		$p2 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '06' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num3 = ($num[0]/$all_person)*100;
		$p3 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '02' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num4 = ($num[0]/$all_person)*100;;
		$p4 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '05' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num5 = ($num[0]/$all_person)*100;
		$p5 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '01' AND  CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num6 = ($num[0]/$all_person)*100;
		$p6 = $num[0];
		}
	$a =  $p1 + $p2 + $p3 + $p4 + $p5 + $p6;
	$num1_all += $p1;
	$num2_all += $p2;
	$num3_all += $p3;
	$num4_all += $p4;
	$num5_all += $p5;
	$num6_all += $p6;
	$total += $a;
	
?>
  <tr>
    <td  align="left" class="sub3"  valign="top"><?=$row["NAME_FACULTY"]?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num1,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num2,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num3,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num4,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num5,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num6,0)?></td>
  </tr>

<?
} //end while department 15 records
if($total > 0) {
	$t1 = ($num1_all/$total)*100;
	$t2 = ($num2_all/$total)*100;
	$t3 = ($num3_all/$total)*100;
	$t4 = ($num4_all/$total)*100;
	$t5 = ($num5_all/$total)*100;
	$t6 = ($num6_all/$total)*100;
}


?>
  <tr>
    <td  align="center" class="main_sub">สัดส่วนทั้งหมดในแต่ละตำแหน่ง</td>
    <td align="right" class="sub4"><?=number_format($t1,0)?></td>
    <td align="right" class="sub4"><?=number_format($t2,0)?></td>
    <td align="right" class="sub4"><?=number_format($t3,0)?></td>
    <td align="right" class="sub4"><?=number_format($t4,0)?></td>
    <td align="right" class="sub4"><?=number_format($t5,0)?></td>
    <td align="right" class="sub4"><?=number_format($t6,0)?></td>
  </tr>
</table>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('quality_report_result.php?print=1&type=1','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='quality_report_result.php?excel=1&type=1'" /></div>
<? }?>

<?	
}elseif($type == "2"){
?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">รายงานสัดส่วนอาจารย์จำแนกตามตำแหน่งวิชาการ แยกตามประเภท</h3>
<table  border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="255" align="center" class="t_head">ประเภท</th>
    <th width="27" align="center" class="t_head">ศ.<br />(%)</th>
    <th width="27" align="center" class="t_head">รศ.<br />(%)</th>
    <th width="65" align="center" class="t_head">รศ.พิเศษ<br />(%)</th>
    <th width="27" align="center" class="t_head">ผศ.<br />(%)</th>
    <th width="65" align="center" class="t_head">ผศ.พิเศษ<br />(%)</th>
    <th width="60" align="center" class="t_head">อาจารย์<br />(%)</th>
    <!--<th width="46" align="center" class="t_head">รวม</th>-->
  </tr>
<?
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$num5_all = 0;
$num6_all = 0;
$sql = "SELECT * FROM ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) { // staff type 8 records
	$num1 = 0;// ศ. 04
	$num2 = 0;// รศ. 03
	$num3 = 0;// รศ.พิเศษ 06
	$num4 = 0;// ผศ. 02
	$num5 = 0;// ผศ.พิเศษ 05
	$num6 = 0;// อาจารย์ 01
	$p1 = 0;
	$p2 = 0;
	$p3 = 0;
	$p4 = 0;
	$p5 = 0;
	$p6 = 0;
		$sql_all = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_all = oci_parse($conn, $sql_all );
		oci_execute($stid_all);
		$num = oci_fetch_array($stid_all, OCI_BOTH);
		$all_person = $num[0];//จะนวนอาจารย์ทั้งหมดแต่ละประเภท
		
		if($all_person > 0){
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '04' AND  CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num1 = ($num[0]/$all_person)*100;
		$p1 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '03' AND  CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num2 = ($num[0]/$all_person)*100;
		$p2 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '06' AND  CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num3 = ($num[0]/$all_person)*100;
		$p3 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '02' AND  CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num4 = ($num[0]/$all_person)*100;;
		$p4 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '05' AND  CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num5 = ($num[0]/$all_person)*100;
		$p5 = $num[0];
		
		$sql_count = "SELECT COUNT(*) FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_VPOS = '01' AND  CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_count = oci_parse($conn, $sql_count );
		oci_execute($stid_count);
		$num = oci_fetch_array($stid_count, OCI_BOTH);
		$num6 = ($num[0]/$all_person)*100;
		$p6 = $num[0];
		}
		
	$a =  $p1 + $p2 + $p3 + $p4 + $p5 + $p6;
	$num1_all += $p1;
	$num2_all += $p2;
	$num3_all += $p3;
	$num4_all += $p4;
	$num5_all += $p5;
	$num6_all += $p6;
	$total += $a;
	
?>
  <tr>
    <td  align="left" class="sub3"  valign="top"><?=$row["STAFFTYPE_NAME"]?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num1,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num2,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num3,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num4,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num5,0)?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($num6,0)?></td>
  </tr>

<?
} //end while type 8 records

if($total > 0) {
	$t1 = ($num1_all/$total)*100;
	$t2 = ($num2_all/$total)*100;
	$t3 = ($num3_all/$total)*100;
	$t4 = ($num4_all/$total)*100;
	$t5 = ($num5_all/$total)*100;
	$t6 = ($num6_all/$total)*100;
}

?>
  <tr>
    <td  align="center" class="main_sub">สัดส่วนทั้งหมดในแต่ละตำแหน่ง</td>
    <td align="right" class="sub4"><?=number_format($t1,0)?></td>
    <td align="right" class="sub4"><?=number_format($t2,0)?></td>
    <td align="right" class="sub4"><?=number_format($t3,0)?></td>
    <td align="right" class="sub4"><?=number_format($t4,0)?></td>
    <td align="right" class="sub4"><?=number_format($t5,0)?></td>
    <td align="right" class="sub4"><?=number_format($t6,0)?></td>
  </tr>
</table>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('quality_report_result.php?print=1&type=2','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='quality_report_result.php?excel=1&type=2'" /></div>
<? }?>

<?
}elseif($type == "3"){
?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">รายงานสัดส่วนอาจารย์จำแนกตามวุฒิการศึกษา แยกตามหน่วยงาน</h3>
<table  border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="290" align="center" class="t_head">หน่วยงาน</th>
    <th width="85" align="center" class="t_head">ปริญญาเอก<br />(%)</th>
    <th width="85" align="center" class="t_head">ปริญญาโท<br />(%)</th>
    <th width="85" align="center" class="t_head">ปริญญาตรี<br />(%)</th>
    <th width="70" align="center" class="t_head">อื่นๆ<br />(%)</th>
  </tr>
<?
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$c1 = 0;
$c2 = 0;
$c3 = 0;
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) { // department 15 records
	$sql_count = "SELECT EMP_ID FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ";
	$stid_count = oci_parse($conn, $sql_count );
	oci_execute($stid_count);
	$num1 = 0;// ปริญญาเอก
	$num2 = 0;// ปริญญาโท
	$num3 = 0;// ปริญญาตรี
	$num4 = 0;
	$p1 = 0;
	$p2 = 0;
	$p3 = 0;
	$p4 = 0;
	$all_person =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ",$conn); //รวมทั้งหมดในแต่ละประเภท
	
	if($all_person > 0){
	while (($row_count = oci_fetch_array($stid_count, OCI_BOTH))) {
		$sql_count1 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '80' AND EMP_ID = '".$row_count['EMP_ID']."'   ";
		$stid_count1 = oci_parse($conn, $sql_count1 );
		oci_execute($stid_count1);
		while($row_count1 = oci_fetch_array($stid_count1, OCI_BOTH)){
			$num1++ ;
			$c1++;
			break;
		}
		
		if($c1 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count2 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '60'  AND EMP_ID = '".$row_count['EMP_ID']."'   ";
			$stid_count2 = oci_parse($conn, $sql_count2 );
			oci_execute($stid_count2);
			while($row_count2 = oci_fetch_array($stid_count2, OCI_BOTH)){
				$num2++ ;
				$c2++;
				break;
			}
			
		if($c2 > 0 ){
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count3 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '40'  AND EMP_ID = '".$row_count['EMP_ID']."'  ";
			$stid_count3 = oci_parse($conn, $sql_count3 );
			oci_execute($stid_count3);
			while($row_count3 = oci_fetch_array($stid_count3, OCI_BOTH)){
				$num3++ ;
				$c3++;
				break;
			}
			
		if($c3 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
			$num4++;
			
	}	// end while all EMP_ID
	$p1 = ($num1/$all_person)*100;
	$p2 = ($num2/$all_person)*100;
	$p3 = ($num3/$all_person)*100;
	$p4 = ($num4/$all_person)*100;
	}
	
	
	
	$num1_all += $num1;
	$num2_all += $num2;
	$num3_all += $num3;
	$num4_all += $num4;
	$total += $all_person;

?>
  <tr>
    <td  align="left" class="sub3"><?=$row["NAME_FACULTY"]?></td>
    <td align="center"><?=number_format($p1,0)?></td>
    <td align="center"><?=number_format($p2,0)?></td>
    <td align="center"><?=number_format($p3,0)?></td>
    <td align="center"><?=number_format($p4,0)?></td>
  </tr>
<? 
$num1 = 0;
$num2 = 0;
$num3 = 0;
$num4 = 0;
$p1 = 0;
$p2 = 0;
$p3 = 0;
$p4 = 0;
} // end while department type 15 records
if($total > 0) {
	$t1 = ($num1_all/$total)*100;
	$t2 = ($num2_all/$total)*100;
	$t3 = ($num3_all/$total)*100;
	$t4 = ($num4_all/$total)*100;
}

?>
  <tr>
    <td  align="center" class="main_sub">สัดส่วนทั้งหมดในแต่ละวุฒิการศึกษา</td>
    <td align="center" class="main_sub"><?=number_format($t1,0)?></td>
    <td align="center" class="main_sub"><?=number_format($t2,0)?></td>
    <td align="center" class="main_sub"><?=number_format($t3,0)?></td>
    <td align="center" class="main_sub"><?=number_format($t4,0)?></td>
  </tr>
</table>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('quality_report_result.php?print=1&type=3','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='quality_report_result.php?excel=1&type=3'" /></div>
<? }?>

<?	
}elseif($type == "4"){
	?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">รายงานสัดส่วนอาจารย์จำแนกตามวุฒิการศึกษา แยกตามประเภท</h3>
<table  border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="280" align="center" class="t_head">ประเภท</th>
    <th width="85" align="center" class="t_head">ปริญญาเอก<br />(%)</th>
    <th width="85" align="center" class="t_head">ปริญญาโท<br />(%)</th>
    <th width="85" align="center" class="t_head">ปริญญาตรี<br />(%)</th>
    <th width="70" align="center" class="t_head">อื่นๆ<br />(%)</th>
  </tr>
<?
$total = 0;
$num1_all = 0;
$num2_all = 0;
$num3_all = 0;
$num4_all = 0;
$c1 = 0;
$c2 = 0;
$c3 = 0;
$sql = "SELECT * FROM ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {// staff type 8 records
	$sql_count = "SELECT EMP_ID FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   ";
	$stid_count = oci_parse($conn, $sql_count );
	oci_execute($stid_count);
	
	$num1 = 0;// ปริญญาเอก
	$num2 = 0;// ปริญญาโท
	$num3 = 0;// ปริญญาตรี
	$num4 = 0;
	$p1 = 0;
	$p2 = 0;
	$p3 = 0;
	$all_person =  $db->count_row(TB_CURRENT_WORK_TAB," WHERE CWK_MUA_EMP_TYPE = '".$row["STAFFTYPE_ID"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ",$conn); //รวมทั้งหมดในแต่ละประเภท\
	if($all_person > 0){
	while (($row_count = oci_fetch_array($stid_count, OCI_BOTH))) {
		//echo $row_count['EMP_ID']." ";
		$sql_count1 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '80' AND EMP_ID = '".$row_count['EMP_ID']."'";
		$stid_count1 = oci_parse($conn, $sql_count1 );
		oci_execute($stid_count1);
		while($row_count1 = oci_fetch_array($stid_count1, OCI_BOTH)){
			$num1++ ;
			$c1++;
			break;
		}
		
		if($c1 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count2 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '60'  AND EMP_ID = '".$row_count['EMP_ID']."' ";
			$stid_count2 = oci_parse($conn, $sql_count2 );
			oci_execute($stid_count2);
			while($row_count2 = oci_fetch_array($stid_count2, OCI_BOTH)){
				$num2++ ;
				$c2++;
				break;
			}
			
		if($c2 > 0 ){
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
		
			$sql_count3 = "SELECT * FROM ".TB_EDUCATION_TAB."  WHERE   EDU_LEVEL = '40'  AND EMP_ID = '".$row_count['EMP_ID']."'  ";
			$stid_count3 = oci_parse($conn, $sql_count3 );
			oci_execute($stid_count3);
			while($row_count3 = oci_fetch_array($stid_count3, OCI_BOTH)){
				$num3++ ;
				$c3++;
				break;
			}
			
		if($c3 > 0 ) {
			$c1 = 0;
			$c2 = 0;
			$c3 = 0;
			continue;
		}
			$num4++;
			
	}	// end while all EMP_ID
	$p1 = ($num1/$all_person)*100;
	$p2 = ($num2/$all_person)*100;
	$p3 = ($num3/$all_person)*100;
	$p4 = ($num4/$all_person)*100;
	}
	
	
	
	$num1_all += $num1;
	$num2_all += $num2;
	$num3_all += $num3;
	$num4_all += $num4;
	$total += $all_person;

?>
  <tr>
    <td  align="left" class="sub3"><?=$row["STAFFTYPE_NAME"]?></td>
    <td align="center"><?=number_format($p1,0)?></td>
    <td align="center"><?=number_format($p2,0)?></td>
    <td align="center"><?=number_format($p3,0)?></td>
    <td align="center"><?=number_format($p4,0)?></td>
  </tr>
<? 
$num1 = 0;
$num2 = 0;
$num3 = 0;
$num4 = 0;
$p1 = 0;
$p2 = 0;
$p3 = 0;
$p4 = 0;
} // end while staff type 8 records

if($total > 0) {
	$t1 = ($num1_all/$total)*100;
	$t2 = ($num2_all/$total)*100;
	$t3 = ($num3_all/$total)*100;
	$t4 = ($num4_all/$total)*100;
}

?>
  <tr>
    <td  align="center" class="main_sub">สัดส่วนทั้งหมดในแต่ละวุฒิการศึกษา</td>
    <td align="center" class="main_sub"><?=number_format($t1,0)?></td>
    <td align="center" class="main_sub"><?=number_format($t2,0)?></td>
    <td align="center" class="main_sub"><?=number_format($t3,0)?></td>
    <td align="center" class="main_sub"><?=number_format($t4,0)?></td>
  </tr>
</table>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('quality_report_result.php?print=1&type=4','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='quality_report_result.php?excel=1&type=4'" /></div>
<? }?>

<?	
}elseif($type == "5"){
?>
<h3 align="center"  style="font-family:Tahoma, Geneva, sans-serif">สัดส่วนอาจารย์ต่างชาติ</h3>
<table  border="1" cellspacing="0" cellpadding="6" align="center" bordercolor="#000000">
  <tr>
    <th width="280" align="center" class="t_head">หน่วยงาน</th>
    <th width="100" align="center" class="t_head">อาจารย์ต่างชาติ<br />(%)</th>
  </tr>
<?
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$total = 0;
$foreigner  = 0;
while (($row = oci_fetch_array($stid, OCI_BOTH))) { // department 15 records
	$num = 0;
	$all_person = 0;
	$percent = 0;
		$sql_all = "SELECT EMP_ID FROM ".TB_CURRENT_WORK_TAB."  WHERE CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'  ";
		$stid_all = oci_parse($conn, $sql_all );
		oci_execute($stid_all);
		$all_person = $db->count_row(TB_CURRENT_WORK_TAB," WHERE CWK_MUA_MAIN = '".$row["CODE_FACULTY"]."' AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' ",$conn);//จะนวนอาจารย์ทั้งหมดแต่ละแผนก
		
		if($all_person > 0){
			while (($row_all = oci_fetch_array($stid_all, OCI_BOTH))) {
				$sq = "SELECT COUNT(*) FROM ".TB_BIODATA_TAB." WHERE EMP_ID = '".$row_all['EMP_ID']."' AND BIO_NATION2 <> 'TH' ";
				$st = oci_parse($conn, $sq );
				oci_execute($st);
				$n = oci_fetch_array($st, OCI_BOTH);
				$num += $n[0];
			}
			$percent = ($num/$all_person)*100;
			$foreigner  += $num;
		}
		$total += $all_person;
		
	
?>
  <tr>
    <td  align="left" class="sub3"  valign="top"><?=$row["NAME_FACULTY"]?></td>
    <td align="right" class="sub44"  valign="top"><?=number_format($percent,0)?></td>
  </tr>

<?
} //end while department 15 records

if($total > 0){
	$total = ($foreigner /$total)*100;
}

?>
<tr>
    <td  align="center" class="main_sub"  valign="top">สัดส่วนทั้งหมด</td>
    <td align="right" class="sub4"  valign="top"><?=number_format($total,0)?></td>
  </tr>
</table>
<br />
<? if(!isset($_REQUEST['print'])){?>
<div align="center"><input type='button' value='Print' onclick="window.open('quality_report_result.php?print=1&type=5','summary','width=900,height=500')"/> <input type='button' value='Export to excel' onclick="window.location='quality_report_result.php?excel=1&type=5'" /></div>
<? }?>
<?	
} elseif($type == "6"){
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
echo "<div align='left' style='width:500px;padding-left: 115px' > เลือกหน่วยงาน : \n";
echo "<select id='type' name='type' onchange='show_c_graph1(this.value);' class=\"limited-width\"  onMouseDown=\"if(document.all) this.className='expanded-width';\" onBlur=\"if(document.all) this.className='limited-width';\" onChange=\"if(document.all) this.className='limited-width';\">\n";
echo "<option value='0'>---เลือก---</option>\n";
while($row = oci_fetch_array($stid, OCI_BOTH)){ 
	echo "<option value='".$row["CODE_FACULTY"]."'>".$row["NAME_FACULTY"]."</option>\n";
}
echo "</div>\n";
echo "</select>\n";
echo "<div align='center' id='circle_graph'></div>\n";


} elseif($type == "7"){
$sql = "SELECT * FROM ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
echo "<div align='left' style='width:500px;padding-left: 135px' > เลือกประเภท : \n";
echo "<select id='type' name='type' onchange='show_c_graph2(this.value);' >\n";
echo "<option value='0'>---เลือก---</option>\n";
while($row = oci_fetch_array($stid, OCI_BOTH)){ 
	echo "<option value='".$row["STAFFTYPE_ID"]."'>".$row["STAFFTYPE_NAME"]."</option>\n";
}
echo "</div>\n";
echo "</select>\n";
echo "<div align='center' id='circle_graph'></div>\n";


}elseif($type == "8"){
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
echo "<div align='left' style='width:500px;padding-left: 115px' > เลือกหน่วยงาน : \n";
echo "<select id='type' name='type' onchange='show_c_graph3(this.value);' class=\"limited-width\"  onMouseDown=\"if(document.all) this.className='expanded-width';\" onBlur=\"if(document.all) this.className='limited-width';\" onChange=\"if(document.all) this.className='limited-width';\">\n";
echo "<option value='0'>---เลือก---</option>\n";
while($row = oci_fetch_array($stid, OCI_BOTH)){ 
	echo "<option value='".$row["CODE_FACULTY"]."'>".$row["NAME_FACULTY"]."</option>\n";
}
echo "</div>\n";
echo "</select>\n";
echo "<div align='center' id='circle_graph'></div>\n";

}elseif($type == "9"){
$sql = "SELECT * FROM ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
echo "<div align='left' style='width:500px;padding-left: 135px' > เลือกประเภท : \n";
echo "<select id='type' name='type' onchange='show_c_graph4(this.value);' >\n";
echo "<option value='0'>---เลือก---</option>\n";
while($row = oci_fetch_array($stid, OCI_BOTH)){ 
	echo "<option value='".$row["STAFFTYPE_ID"]."'>".$row["STAFFTYPE_NAME"]."</option>\n";
}
echo "</div>\n";
echo "</select>\n";
echo "<div align='center' id='circle_graph'></div>\n";

}elseif($type == "10"){
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
echo "<div align='left' style='width:500px;padding-left: 115px' > เลือกหน่วยงาน : \n";
echo "<select id='type' name='type' onchange='show_c_graph5(this.value);' class=\"limited-width\"  onMouseDown=\"if(document.all) this.className='expanded-width';\" onBlur=\"if(document.all) this.className='limited-width';\" onChange=\"if(document.all) this.className='limited-width';\">\n";
echo "<option value='0'>---เลือก---</option>\n";
while($row = oci_fetch_array($stid, OCI_BOTH)){ 
	echo "<option value='".$row["CODE_FACULTY"]."'>".$row["NAME_FACULTY"]."</option>\n";
}
echo "</div>\n";
echo "</select>\n";
echo "<div align='center' id='circle_graph'></div>\n";

}elseif($type == "11"){
$sql = "SELECT * FROM ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
echo "<div align='left' style='width:500px;padding-left: 135px' > เลือกประเภท : \n";
echo "<select id='type' name='type' onchange='show_c_graph6(this.value);' >\n";
echo "<option value='0'>---เลือก---</option>\n";
while($row = oci_fetch_array($stid, OCI_BOTH)){ 
	echo "<option value='".$row["STAFFTYPE_ID"]."'>".$row["STAFFTYPE_NAME"]."</option>\n";
}
echo "</div>\n";
echo "</select>\n";
echo "<div align='center' id='circle_graph'></div>\n";

}elseif($type == "12"){
$sql = "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
echo "<div align='left' style='width:500px;padding-left: 115px' > เลือกหน่วยงาน : \n";
echo "<select id='type' name='type' onchange='show_c_graph7(this.value);' class=\"limited-width\"  onMouseDown=\"if(document.all) this.className='expanded-width';\" onBlur=\"if(document.all) this.className='limited-width';\" onChange=\"if(document.all) this.className='limited-width';\">\n";
echo "<option value='0'>---เลือก---</option>\n";
while($row = oci_fetch_array($stid, OCI_BOTH)){ 
	echo "<option value='".$row["CODE_FACULTY"]."'>".$row["NAME_FACULTY"]."</option>\n";
}
echo "</div>\n";
echo "</select>\n";
echo "<div align='center' id='circle_graph'></div>\n";
}elseif($type == "13"){
$sql = "SELECT * FROM ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
echo "<div align='left' style='width:500px;padding-left: 135px' > เลือกประเภท : \n";
echo "<select id='type' name='type' onchange='show_c_graph8(this.value);' >\n";
echo "<option value='0'>---เลือก---</option>\n";
while($row = oci_fetch_array($stid, OCI_BOTH)){ 
	echo "<option value='".$row["STAFFTYPE_ID"]."'>".$row["STAFFTYPE_NAME"]."</option>\n";
}
echo "</div>\n";
echo "</select>\n";
echo "<div align='center' id='circle_graph'></div>\n";

}else{
	
	echo "<img src='../images/under-construction.jpg' border='0' height='300'/>";
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