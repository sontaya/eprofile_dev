<?
include("../includes/connect.php");
function re_hyphen($n){
	if($n == 0) return "-";
	else return number_format($n,0);
}
 
 $year = date("Y");
 $month = date("m");
 $where_date = $year."-".$month;
 $sum_day = date("t");
 
 
 
 if($_GET["yr"]!=""){
 	 $year=$_GET["yr"];
 }
 if($_GET["mo"]!=""){
 	 $month=$_GET["mo"];
 }
 
 $month_arr = array(1=>"มกราคม", 2=>"กุมภาพันธ์", 3=>"มีนาคม", 4=>"เมษายน", 5=>"พฤษภาคม", 6=>"มิถุนายน", 7=>"กรกฎาคม", 8=>"สิงหาคม", 9=>"กันยายน", 10=>"ตุลาคม", 11=>"พฤศจิกายน", 12=>"ธันวาคม");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>สรุปการจ้างบุคลากร</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
<script>
function ch_date(){
	var m=document.getElementById("m").value;
	var y=document.getElementById("y").value;
	window.location="new_report1.php?yr="+y+"&mo="+m;
}
</script>
</head>

<body>

<div align="center">สรุปการจ้างบุคลากร <br />
<form>
	เดือน :
    <select id='m' onchange="ch_date()">
    <?
    for($i = 1 ;$i <= 12 ;$i++){
	if(str_pad($i,2,"0",STR_PAD_LEFT) == ((int)$_GET["mo"])){
	 $select = "selected = 'selected' ";
	}
	else{
		$select="";
	}
	echo "<option value='".str_pad($i,2,"0",STR_PAD_LEFT)."'  $select>".$month_arr[number_format($i)]."</option>\n";
	
	}
	?>
    </select>
    &nbsp;
    ปี :
    <select id='y' onchange="ch_date()">
    <?
    for($i = 0;$i <= 20 ;$i++){
	$ty=date("Y")-$i;
	if($ty == ((int)$_GET["yr"])){
		$select = "selected = 'selected' ";
	}
	else{
		$select = "";
	}
		echo "<option value='".$ty."'  $select>".($ty+543)."</option>\n";
	}
	?>
    </select>
</form>
<br /> ประจำเดือน <? echo get_month_full($month)." ".($year+543);?></div><br />
<table  border="1" cellspacing="0" cellpadding="3" align="center">
	<tr  bgcolor="#CAE4FF">
    	<td width="17" align="center">ที่</td>
      <td width="171" align="center">ชื่อ - สกุล</td>
      <td width="110" align="center">ประเภทบุคลากร</td>
      <td width="106" align="center">ตำแหน่ง</td>
      <td width="151" align="center">สังกัด</td>
      <td width="205" align="center">หลักสูตร/หน่วยงาน/ ศูนย์การศึกษา</td>
      <td width="92" align="center">วันเริ่มงาน</td>
      <td width="66" align="center">เงินเดือน</td>
      <td width="113" align="center">หมวดเงินเดือน</td>
        <td width="163" align="center">หมายเหตุ</td>
    </tr>
 <? 

$sum_day = cal_days_in_month(CAL_GREGORIAN, number_format($month),  $year);

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB." WHERE (CWK_START_WORK_DATE  BETWEEN TO_DATE('{$year}-{$month}-01','YYYY-MM-DD') AND TO_DATE('{$year}-{$month}-{$sum_day}','YYYY-MM-DD')) ";
$stid = oci_parse($conn, $sql );
//print $sql;
oci_execute($stid);
$n = 1;
while($row = oci_fetch_array($stid, OCI_BOTH)){
	list($year1,$month1,$day1) = explode("-",$row['CWK_START_WORK_DATE']);
	$sql2 =  "SELECT * FROM ".TB_REF_SALARY_STEP." WHERE EMP_ID = '".$row["EMP_ID"]."'";
	$stid2 = oci_parse($conn, $sql2 );
	oci_execute($stid2);
	$row2 = oci_fetch_array($stid2, OCI_BOTH);
	$salary = number_format(($row2["SALARY1"] + $row2["SALARY2"] + $row2["SALARY3"]),0);
	$type_salary = $row2["SOURCE1"];
 ?>     
  <tr>
    <td align="center" valign="top"><?=$n?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_name2($row["EMP_ID"],TB_BIODATA_TAB)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_stafftype($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_STAFFTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_position($row['CWK_MUA_VPOS'],$row['CWK_MUA_LEVEL']);?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_department($row["CWK_MUA_MAIN"],TB_REF_DEPARTMENT)?></td>
    <td align="left" valign="top"  style="padding-left:3px"><?=get_department_sub($row["CWK_MUA_SUBMAIN"],TB_REF_DEPARTMENT_SUB)?></td>
    <td align="center" valign="top"><? echo $day1." ".get_month($month1)." ".($year1+543);?></td>
    <td align="center" valign="top"><?=$salary?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_salary_source($type_salary,TB_REF_SALARY_SOURCE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["CWK_ORDER1"]?></td>
  </tr>
<?
$n++;
}
?>
</table><br />
<div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'new_report1_excel.php?excel=1'"/></div>

</body>
</html>
<?
$db->closedb($conn);
?>