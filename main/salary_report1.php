<?
@ini_set('max_execution_time', 800);
include("../includes/connect.php");
function re_hyphen($n){
	if($n == 0) return "-";
	else return number_format($n,0);
}
  $year = date("Y");
 $month = date("m");
 $where_date = $year."-".$month;
 list($begin_day,$begin_month,$begin_year) = explode("/",date("d/m/Y"));
$d1 = date2_formatdb($_REQUEST["date1"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>สรุปเงินเดือนบุคลากร</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
</head>

<body>
<div align="center">สรุปเงินเดือนบุคลากร<br />มหาวิทยาลัยราชภัฏสวนดุสิต<br />ข้อมูล ณ วันที่   <? echo (int)$begin_day." ".get_month_full((int)$begin_month)." ".($begin_year+543);?></div><br />
<table border="1" width="882"  cellspacing="0" cellpadding="3" align="center">

<tr align="center" bgcolor="#CAE4FF">
	<td width="29" rowspan="2" align="center" valign="middle">ที่</td>
    <td width="310" rowspan="2" align="center" valign="middle">ประเภทบุคลากร</td>
    <td colspan="2" align="center" valign="middle">เงินนอกงบประมาณ</td>
    <td colspan="2" align="center" valign="middle">งบประมาณแผ่นดิน</td>
</tr>

<tr align="center" bgcolor="#CAE4FF">
    <td width="99" align="center" valign="middle">จำนวน (คน)</td>
    <td width="146" align="center" valign="middle">จำนวนเงิน (บาท)</td>
    <td width="101" align="center" valign="middle">จำนวน (คน)</td>
    <td width="147" align="center" valign="middle">จำนวนเงิน (บาท)</td>
</tr>
<? 
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '1'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center"><span style="font-weight:bold; color:#63F">(1)</span></td>
    <td align="left"><span style="font-weight:bold; color:#63F">ข้าราชการ</span></td>
    <td align="center" style="font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person1))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money1))?></span></td>
    <td align="center" style="font-size:14px;"><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person2))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money2))?></span></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_EMP_SUBTYPE = '1'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:30px"><b>สายวิชาการ</b></td>
    <td align="center" ><b><?=re_hyphen(($person1))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money1))?></b></td>
    <td align="center" ><b><?=re_hyphen(($person2))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money2))?></b></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$n = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_EMP_SUBTYPE = '1'  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}

?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_EMP_SUBTYPE = '2'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:30px"><b>สายสนับสนุน</b></td>
    <td align="center" ><b><?=re_hyphen(($person1))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money1))?></b></td>
    <td align="center" ><b><?=re_hyphen(($person2))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money2))?></b></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$n = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '1' AND CWK_MUA_EMP_SUBTYPE = '2'  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}

?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '2'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center"><span style="font-weight:bold; color:#63F">(2)</span></td>
    <td align="left"><span style="font-weight:bold; color:#63F">พนักงานราชการ</span></td>
    <td align="center" style="font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person1))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money1))?></span></td>
    <td align="center" style="font-size:14px;"><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person2))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money2))?></span></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_EMP_SUBTYPE = '1'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:30px"><b>สายวิชาการ</b></td>
     <td align="center" ><b><?=re_hyphen(($person1))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money1))?></b></td>
    <td align="center" ><b><?=re_hyphen(($person2))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money2))?></b></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_EMP_SUBTYPE = '1'  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}

?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_EMP_SUBTYPE = '2'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:30px"><b>สายสนับสนุน</b></td>
    <td align="center" ><b><?=re_hyphen(($person1))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money1))?></b></td>
    <td align="center" ><b><?=re_hyphen(($person2))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money2))?></b></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$n = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '2' AND CWK_MUA_EMP_SUBTYPE = '2'  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}

?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '3'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center"><span style="font-weight:bold; color:#63F">(3)</span></td>
    <td align="left"><span style="font-weight:bold; color:#63F">พนักงานมหาวิทยาลัย</span></td>
    <td align="center" style="font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person1))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money1))?></span></td>
    <td align="center" style="font-size:14px;"><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person2))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money2))?></span></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_EMP_SUBTYPE = '1'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:30px"><b>สายวิชาการ</b></td>
    <td align="center" ><b><?=re_hyphen(($person1))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money1))?></b></td>
    <td align="center" ><b><?=re_hyphen(($person2))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money2))?></b></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_EMP_SUBTYPE = '1'  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}

?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_EMP_SUBTYPE = '2'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:30px"><b>สายสนับสนุน</b></td>
    <td align="center" ><b><?=re_hyphen(($person1))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money1))?></b></td>
    <td align="center" ><b><?=re_hyphen(($person2))?></b></td>
    <td align="right" style="padding-right: 7px; "><b><?=re_hyphen(($money2))?></b></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$n = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '3' AND CWK_MUA_EMP_SUBTYPE = '2'  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}

?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND (CWK_MUA_EMP_TYPE = '4' OR CWK_MUA_EMP_TYPE = '5' ) AND (CWK_DSU_POS BETWEEN 123 AND 139 )  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center"><span style="font-weight:bold; color:#63F">(4)</span></td>
    <td align="left"><span style="font-weight:bold; color:#63F">อาจารย์ประจำตามสัญญาจ้าง</span></td>
    <td align="center" style="font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person1))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money1))?></span></td>
    <td align="center" style="font-size:14px;"><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person2))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money2))?></span></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND (CWK_MUA_EMP_TYPE = '4' OR CWK_MUA_EMP_TYPE = '5' ) AND (CWK_DSU_POS BETWEEN 123 AND 139 )  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}
?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND (CWK_MUA_EMP_TYPE = '4' OR CWK_MUA_EMP_TYPE = '5' )  AND (CWK_DSU_POS NOT BETWEEN 15 AND 23  )  AND (CWK_DSU_POS NOT BETWEEN 123 AND 139  ) AND (CWK_DSU_POS NOT BETWEEN 77 AND 79  )  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center"><span style="font-weight:bold; color:#63F">(5)</span></td>
    <td align="left"><span style="font-weight:bold; color:#63F">เจ้าหน้าที่ประจำตามสัญญาจ้าง</span></td>
    <td align="center" style="font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person1))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money1))?></span></td>
    <td align="center" style="font-size:14px;"><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person2))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money2))?></span></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND (CWK_MUA_EMP_TYPE = '4' OR CWK_MUA_EMP_TYPE = '5' ) AND (CWK_DSU_POS NOT BETWEEN 15 AND 23  )  AND (CWK_DSU_POS NOT BETWEEN 123 AND 139  ) AND (CWK_DSU_POS NOT BETWEEN 77 AND 79  )   AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}
?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$emp_id = array();
$EMP_ID = array();

$sql_bio =  "SELECT * FROM ".TB_BIODATA_TAB."  WHERE  BIO_NATION2 <> 'TH'   ";
$stid_bio = oci_parse($conn, $sql_bio );
oci_execute($stid_bio);
while($row_bio = oci_fetch_array($stid_bio, OCI_BOTH)){
	$emp_id[] = $row_bio["EMP_ID"];
}


for($i=0;$i<count($emp_id);$i++){
	$sql_c =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'   AND EMP_ID = '".$emp_id[$i]."' ";
	$stid_c = oci_parse($conn, $sql_c );
	oci_execute($stid_c);
	while($row_c = oci_fetch_array($stid_c, OCI_BOTH)){
		$EMP_ID[] = $row_c["EMP_ID"];
	}
}

for($i=0;$i<count($EMP_ID);$i++){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$EMP_ID[$i]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$EMP_ID[$i]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$EMP_ID[$i]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$EMP_ID[$i]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center"><span style="font-weight:bold; color:#63F">(6)</span></td>
    <td align="left"><span style="font-weight:bold; color:#63F">ชาวต่างประเทศ</span></td>
    <td align="center" style="font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person1))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money1))?></span></td>
    <td align="center" style="font-size:14px;"><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person2))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money2))?></span></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$emp_id = array();
$EMP_ID = array();
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql_bio =  "SELECT * FROM ".TB_BIODATA_TAB."  WHERE  BIO_NATION2 <> 'TH'   ";
$stid_bio = oci_parse($conn, $sql_bio );
oci_execute($stid_bio);
while($row_bio = oci_fetch_array($stid_bio, OCI_BOTH)){
	$emp_id[] = $row_bio["EMP_ID"];
}


for($i=0;$i<count($emp_id);$i++){
	$sql_c =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'   AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' AND EMP_ID = '".$emp_id[$i]."' ";
	$stid_c = oci_parse($conn, $sql_c );
	oci_execute($stid_c);
	while($row_c = oci_fetch_array($stid_c, OCI_BOTH)){
		$EMP_ID[] = $row_c["EMP_ID"];
	}
}

for($i=0;$i<count($EMP_ID);$i++){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$EMP_ID[$i]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$EMP_ID[$i]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$EMP_ID[$i]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$EMP_ID[$i]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
unset($emp_id);
unset($EMP_ID);
}
?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '6'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center"><span style="font-weight:bold; color:#63F">(7)</span></td>
    <td align="left"><span style="font-weight:bold; color:#63F">ที่ปรึกษา</span></td>
    <td align="center" style="font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person1))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money1))?></span></td>
    <td align="center" style="font-size:14px;"><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person2))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money2))?></span></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '6'  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}
?>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '8'  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
?>
<tr>
	<td align="center"><span style="font-weight:bold; color:#63F">(8)</span></td>
    <td align="left"><span style="font-weight:bold; color:#63F">นักวิจัย</span></td>
    <td align="center" style="font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person1))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money1))?></span></td>
    <td align="center" style="font-size:14px;"><span style="font-weight:bold; color:#63F"><?=re_hyphen(($person2))?></span></td>
    <td align="right" style="padding-right: 7px;font-size:14px; "><span style="font-weight:bold; color:#63F"><?=re_hyphen(($money2))?></span></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;
$sql1 =  "SELECT * FROM ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC";
$stid1 = oci_parse($conn, $sql1 );
oci_execute($stid1);
while($row1 = oci_fetch_array($stid1, OCI_BOTH)){

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND CWK_MUA_EMP_TYPE = '8'  AND CWK_MUA_MAIN = '".$row1["CODE_FACULTY"]."' ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$count_person1 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' GROUP BY EMP_ID",$conn);
	
	if($count_person1 > 0){
	$sql_count_person1 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 <> '08' ORDER BY REF DESC ";
	$stid_count_person1 = oci_parse($conn, $sql_count_person1 );
	oci_execute($stid_count_person1);
	$row_count_person1 = oci_fetch_array($stid_count_person1, OCI_BOTH);
	$money1 += $row_count_person1["SALARY1"] ;
	$person1 += $count_person1;

	}
	
	$count_person2 = $db->count_row(TB_REF_SALARY_STEP," WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' GROUP BY EMP_ID ",$conn);
	
	if($count_person2> 0){
	$sql_count_person2 = "SELECT SALARY1  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND  SOURCE1 = '08' ORDER BY REF DESC ";
	$stid_count_person2 = oci_parse($conn, $sql_count_person2 );
	oci_execute($stid_count_person2);
	$row_count_person2 = oci_fetch_array($stid_count_person2, OCI_BOTH);
	$money2 += $row_count_person2["SALARY1"] ;
	$person2 += $count_person2;

	}
}
	
?>
<tr>
	<td align="center">&nbsp;</td>
    <td align="left" style="padding-left:45px">( <?=$row1["NAME_FACULTY"]?> )</td>
    <td align="center"><?=re_hyphen(($person1))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money1))?></td>
    <td align="center"><?=re_hyphen(($person2))?></td>
    <td align="right" style="padding-right: 7px"><?=re_hyphen(($money2))?></td>
</tr>
<?
$person1 = 0;
$person2 = 0;
$money1 = 0;
$money2 = 0;

}
?>
</table><br />
<div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'salary_report1_excel.php?excel=1'"/></div>

</body>
</html>
<?
$db->closedb($conn);
?>