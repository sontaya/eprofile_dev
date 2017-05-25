<?
include("../includes/connect.php");
@ini_set('max_execution_time', 800);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บัญชีถือจ่ายเงินเดือนอาจารย์ประจำตามสัญญาจ้าง</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}

.borderless{
	border-bottom:2px solid #000;
	border-top:2px solid #000;
	border-right: none;
	border-left:none;
	
}
.data_dot{
	border-bottom: #000 1px dotted;
	
}
</style>
</head>

<body>
<div align="center">บัญชีถือจ่ายเงินเดือนอาจารย์ประจำตามสัญญาจ้าง<br />มหาวิทยาลัยราชภัฏสวนดุสิต</div><br />
<table width="1293" border="0" cellspacing="0" cellpadding="8" align="center">
  <tr>
    <td width="178" align="center" valign="middle" class="borderless">ชื่อ - นามสกุล<br />เลขที่บัตรประชาชน</td>
    <td width="146" align="center" valign="middle" class="borderless">ชื่อตำแหน่ง</td>
    <td width="92" align="center" valign="middle" class="borderless">เลขที่ตำแหน่ง</td>
    <td width="164" align="center" valign="middle" class="borderless">ถือจ่ายปีที่แล้ว</td>
    <td width="164" align="center" valign="middle" class="borderless">ถือจ่ายปีนี้</td>
    <td width="117" align="center" valign="middle" class="borderless">จำนวนเงินเลื่อนขั้น</td>
    <td width="135" align="center" valign="middle" class="borderless">ปรับวุฒิ</td>
    <td width="151" align="center" valign="middle" class="borderless">อัตราเงินเดือน<br />ตั้งใหม่</td>
  </tr>
  <?
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND (CWK_MUA_EMP_TYPE = '4' OR CWK_MUA_EMP_TYPE = '5' ) AND (CWK_DSU_POS BETWEEN 123 AND 139 )  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$sql_salary = "SELECT *  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."'  ORDER BY REF DESC ";
	$stid_salary = oci_parse($conn, $sql_salary );
	oci_execute($stid_salary);
	$count = 0;
	$salary = array();
	while($row_salary = oci_fetch_array($stid_salary, OCI_BOTH)){
		$salary[] = $row_salary["SALARY1"] + $row_salary["SALARY2"] + $row_salary["SALARY3"];
		$count++;
		if($count == 2) break;
	}
	
	$y = date("Y");
	$yo = (date("Y")-1);
	 $sql_exsalary = "SELECT *  FROM ".TB_EXTRA_SALARY_TAB." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND (LAST_UPDATE BETWEEN TO_DATE('{$y}-01-01','YYYY-MM-DD') AND TO_DATE('{$y}-12-31','YYYY-MM-DD'))  ORDER BY EX_ID DESC ";
	$stid_exsalary = oci_parse($conn, $sql_exsalary );
	oci_execute($stid_exsalary);
	$exsalary = array();
	$exsalary_ref = array();
	while($row_exsalary = oci_fetch_array($stid_exsalary, OCI_BOTH)){
		$exsalary[] = $row_exsalary["EX_SALARY"];
		$exsalary_ref[] = $row_exsalary["EX_SALARY_REF"];
	}
	
	$sql_exsalary2 = "SELECT *  FROM ".TB_EXTRA_SALARY_TAB." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND (LAST_UPDATE BETWEEN TO_DATE('{$yo}-01-01','YYYY-MM-DD') AND TO_DATE('{$yo}-12-31','YYYY-MM-DD'))  ORDER BY EX_ID DESC ";
	$stid_exsalary2 = oci_parse($conn, $sql_exsalary2 );
	oci_execute($stid_exsalary2);
	$exsalary2 = array();
	$exsalary_ref2 = array();
	while($row_exsalary2 = oci_fetch_array($stid_exsalary2, OCI_BOTH)){
		$exsalary2[] = $row_exsalary2["EX_SALARY"];
		$exsalary_ref2[] = $row_exsalary2["EX_SALARY_REF"];
	}
	
  ?>
  <tr>
    <td align="left" style="font-size:13px" class="data_dot"><?=get_name2($row["EMP_ID"],TB_BIODATA_TAB)?><br /><?=get_person_id($row["EMP_ID"],TB_BIODATA_TAB)?></td>
    <td align="left" style="font-size:13px" class="data_dot"><? echo get_position2($row["CWK_DSU_POS"],TB_POSITION);?></td>
    <td align="center" class="data_dot" style="font-size:13px"><? echo $row["CWK_DSU_POS"];?></td>
    <td align="right" valign="top" class="data_dot" style="font-size:13px">เงินเดือน
<?
	 if ($salary[1] > 0) {echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;".number_format($salary[1],2);}else{echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;".number_format($salary[0],2);}
	 
	 for($i = 0;$i<count($exsalary2);$i++){
		 echo "<br /><br />";
		 echo get_salary_ex($exsalary_ref2[$i],TB_REF_EXTRA_SALARY);
		 if($exsalary2[$i] > 0){
		  echo  "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; ".number_format($exsalary2[$i],2);
		 }else{
			echo  "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;";
		 }
	 }
	 
	 
	 ?></td>
    <td align="right" valign="top" class="data_dot" style="font-size:13px;padding-right: 10px"><? if ($salary[0] > 0) echo number_format($salary[0],2);
	  for($i = 0;$i<count($exsalary);$i++){
		 echo "<br /><br />";
		 echo get_salary_ex($exsalary_ref[$i],TB_REF_EXTRA_SALARY);
		 if($exsalary[$i] > 0){
		  echo  "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; ".number_format($exsalary[$i],2);
		 }else{
			echo  "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;";
		 }
	 }
	?></td>
    <td class="data_dot" style="font-size:13px;padding-right: 10px" align="right"><? 
	if($salary[0] > $salary[1] and $salary[1] > 0 and ($salary[0] - $salary[1]) > 0) echo number_format(($salary[0] - $salary[1]),2);
	?></td>
    <td class="data_dot" style="font-size:13px">&nbsp;</td>
    <td class="data_dot" style="font-size:13px">&nbsp;</td>
  </tr>
  <?
  unset($salary);
  unset($exsalary);
  unset($exsalary_ref);
  unset($exsalary2);
  unset($exsalary_ref2);
}
  ?>
</table><br />
<div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'salary_report2_excel.php?excel=1'"/></div>
</body>
</html>
<?
echo $n;
$db->closedb($conn);
?>