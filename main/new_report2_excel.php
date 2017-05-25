<?
if($_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=new_personnel_statistic_report_".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
include("../includes/connect.php");
function re_hyphen($n){
	if($n == 0) return "-";
	else return number_format($n,0);
}
  $year = date("Y");
 $month = date("m");
 $where_date = $year."-".$month;
$feb_day = date("t",strtotime("{$year}-02-01"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>สถิติการจ้างบุคลากร</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
</head>

<body>
<div align="center">สรุปการจ้างบุคลากร ในปีงบประมาณ พ.ศ.  <? echo ($year+543);?></div><br />
<table border="1" width="1785"  cellspacing="0" cellpadding="3">

<tr align="center" bgcolor="#CAE4FF">
	<td rowspan="3" width="213">สังกัด</td>
    <td colspan="24">ปีงบประมาณ  <? echo ($year+543);?> (จำนวนคน)</td>
    <td colspan="2">รวมรายปี</td>
</tr>

<tr align="center" bgcolor="#CAE4FF">
    <td colspan="2">ม.ค.</td>
    <td colspan="2">ก.พ.</td>
    <td colspan="2">มี.ค.</td>
    <td colspan="2">เม.ย.</td>
    <td colspan="2">พ.ค.</td>
    <td colspan="2">ก.ค.</td>
    <td colspan="2">มิ.ย.</td>
    <td colspan="2">ส.ค.</td>
    <td colspan="2">ก.ย.</td>
    <td colspan="2">ต.ค.</td>
    <td colspan="2">พ.ย.</td>
    <td colspan="2">ธ.ค.</td>
    <td rowspan="2" width="91">สายวิชาการ</td>
    <td rowspan="2" width="87">สายสนับสนุน</td>
</tr>

<tr align="center" style="font-size:12px;" bgcolor="#CAE4FF">
	
	<td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
    <td width="44">วิชาการ</td>
	<td width="54">สนับสนุน</td>
</tr>
 <? 
$all_v_jan = 0;
$all_s_jan = 0;
$all_v_feb = 0;
$all_s_feb = 0;
$all_v_mar = 0;
$all_s_mar = 0;
$all_v_apr = 0;
$all_s_apr = 0;
$all_v_may = 0;
$all_s_may = 0;
$all_v_jun = 0;
$all_s_jun = 0;
$all_v_jul = 0;
$all_s_jul = 0;
$all_v_aug = 0;
$all_s_aug = 0;
$all_v_sep = 0;
$all_s_sep = 0;
$all_v_oct = 0;
$all_s_oct = 0;
$all_v_nov = 0;
$all_s_nov = 0;
$all_v_dec = 0;
$all_s_dec = 0;
$all_v_ = 0;
$all_s_ = 0;
$sql =  "SELECT * FROM ".TB_REF_DEPARTMENT." ORDER BY NAME_FACULTY ASC ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$n = 1;
while($row = oci_fetch_array($stid, OCI_BOTH)){

	$count_v_jan = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-01-01','YYYY-MM-DD') AND TO_DATE('{$year}-01-31','YYYY-MM-DD'))   AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_jan = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-01-01','YYYY-MM-DD') AND TO_DATE('{$year}-01-31','YYYY-MM-DD'))   AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_feb = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-02-01','YYYY-MM-DD') AND TO_DATE('{$year}-02-{$feb_day}','YYYY-MM-DD'))   AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_feb = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-02-01','YYYY-MM-DD') AND TO_DATE('{$year}-02-{$feb_day}','YYYY-MM-DD'))   AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_mar = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-03-01','YYYY-MM-DD') AND TO_DATE('{$year}-03-31','YYYY-MM-DD'))   AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_mar = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-03-01','YYYY-MM-DD') AND TO_DATE('{$year}-03-31','YYYY-MM-DD'))   AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_apr = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE  BETWEEN TO_DATE('{$year}-04-01','YYYY-MM-DD') AND TO_DATE('{$year}-04-30','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_apr = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE  BETWEEN TO_DATE('{$year}-04-01','YYYY-MM-DD') AND TO_DATE('{$year}-04-30','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_may = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-05-01','YYYY-MM-DD') AND TO_DATE('{$year}-05-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_may = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-05-01','YYYY-MM-DD') AND TO_DATE('{$year}-05-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_jun = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE  BETWEEN TO_DATE('{$year}-06-01','YYYY-MM-DD') AND TO_DATE('{$year}-06-30','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_jun = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE  BETWEEN TO_DATE('{$year}-06-01','YYYY-MM-DD') AND TO_DATE('{$year}-06-30','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_jul = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-07-01','YYYY-MM-DD') AND TO_DATE('{$year}-07-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_jul = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-07-01','YYYY-MM-DD') AND TO_DATE('{$year}-07-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_aug = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE  BETWEEN TO_DATE('{$year}-08-01','YYYY-MM-DD') AND TO_DATE('{$year}-08-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_aug = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE  BETWEEN TO_DATE('{$year}-08-01','YYYY-MM-DD') AND TO_DATE('{$year}-08-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_sep = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-09-01','YYYY-MM-DD') AND TO_DATE('{$year}-09-30','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_sep = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-09-01','YYYY-MM-DD') AND TO_DATE('{$year}-09-30','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_oct = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-10-01','YYYY-MM-DD') AND TO_DATE('{$year}-10-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_oct = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-10-01','YYYY-MM-DD') AND TO_DATE('{$year}-10-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_nov = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-11-01','YYYY-MM-DD') AND TO_DATE('{$year}-11-30','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_nov = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-11-01','YYYY-MM-DD') AND TO_DATE('{$year}-11-30','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$count_v_dec = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-12-01','YYYY-MM-DD') AND TO_DATE('{$year}-12-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '1'  ",$conn);
	$count_s_dec = $db->count_row(TB_CURRENT_WORK_TAB," WHERE  (CWK_START_WORK_DATE BETWEEN TO_DATE('{$year}-12-01','YYYY-MM-DD') AND TO_DATE('{$year}-12-31','YYYY-MM-DD'))  AND CWK_MUA_MAIN = ".$row["CODE_FACULTY"]." AND CWK_MUA_EMP_SUBTYPE = '2'  ",$conn);
	
	$v_all = $count_v_jan + $count_v_feb +  $count_v_mar +  $count_v_apr +  $count_v_may +  $count_v_jun +  $count_v_jul +  $count_v_aug +  $count_v_sep +  $count_v_oct +  $count_v_nov +  $count_v_dec ;
	$s_all = $count_s_jan + $count_s_feb +  $count_s_mar +  $count_s_apr +  $count_s_may +  $count_s_jun +  $count_s_jul +  $count_s_aug +  $count_s_sep +  $count_s_oct +  $count_s_nov +  $count_s_dec ;
	
	$all_v_jan += $count_v_jan;
	$all_v_feb += $count_v_feb;
	$all_v_mar += $count_v_mar;
	$all_v_apr += $count_v_apr;
	$all_v_may += $count_v_may;
	$all_v_jun += $count_v_jun;
	$all_v_jul += $count_v_jul;
	$all_v_aug += $count_v_aug;
	$all_v_sep += $count_v_sep;
	$all_v_oct += $count_v_oct;
	$all_v_nov += $count_v_nov;
	$all_v_dec += $count_v_dec;
	
	$all_s_jan += $count_s_jan;
	$all_s_feb += $count_s_feb;
	$all_s_mar += $count_s_mar;
	$all_s_apr += $count_s_apr;
	$all_s_may += $count_s_may;
	$all_s_jun += $count_s_jun;
	$all_s_jul += $count_s_jul;
	$all_s_aug += $count_s_aug;
	$all_s_sep += $count_s_sep;
	$all_s_oct += $count_s_oct;
	$all_s_nov += $count_s_nov;
	$all_s_dec += $count_s_dec;
	
	 $all_v_ +=  + $v_all ;
	$all_s_  +=  +  $s_all ;
 ?>     
<tr  >
	<td width="213" height="30" align="left"><?=$row["NAME_FACULTY"]?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_jan)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_jan)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_feb)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_feb)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_mar)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_mar)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_apr)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_apr)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_may)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_may)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_jun)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_jun)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_jul)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_jul)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_aug)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_aug)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_sep)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_sep)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_oct)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_oct)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_nov)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_nov)?></td>
	<td width="44" align="center"><?=re_hyphen($count_v_dec)?></td>
    <td width="54" align="center"><?=re_hyphen($count_s_dec)?></td>
	<td width="91" align="center"><?=re_hyphen($v_all)?></td>
    <td width="87" align="center"><?=re_hyphen($s_all)?></td>
</tr>

<?
$n++;

}

/*$all_v_ = $all_v_jan + $all_v_feb + $all_v_mar + $all_v_apr + $all_v_may + $all_v_jun + $all_v_jul + $all_v_aug + $all_v_sep + $all_v_oct + $all_v_nov + $all_v_dec  ;
$all_s_ = $all_s_jan + $all_s_feb + $all_s_mar + $all_s_apr + $all_s_may + $all_s_jun + $all_s_jul + $all_s_aug + $all_s_sep + $all_s_oct + $all_s_nov + $all_s_dec  ;*/
?>
<tr  bgcolor="#CCFFFF">
	<td width="213" height="46" align="center">รวมทั้งสิ้น</td>
	<td width="44" align="center"><?=re_hyphen($all_v_jan)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_jan)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_feb)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_feb)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_mar)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_mar)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_apr)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_apr)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_may)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_may)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_jun)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_jun)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_jul)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_jul)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_aug)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_aug)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_sep)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_sep)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_oct)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_oct)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_nov)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_nov)?></td>
	<td width="44" align="center"><?=re_hyphen($all_v_dec)?></td>
    <td width="54" align="center"><?=re_hyphen($all_s_dec)?></td>
	<td width="91" align="center"><b><?=re_hyphen($all_v_)?></b></td>
    <td width="87" align="center"><b><?=re_hyphen($all_s_)?></b></td>
</tr>

</table>

</body>
</html>
<?
$db->closedb($conn);
?>