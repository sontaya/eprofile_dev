<?
@ini_set('max_execution_time', 800);
if($_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=sumary_salary_report_".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
include("../includes/connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บัญชีถือจ่ายเงินเดือน</title>
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
<?
$salary_month = 0;
$salary_month_old = 0;
$ref['01'] = 0;
$ref['02'] = 0;
$ref['03'] = 0;
$ref['04'] = 0;
$ref['05'] = 0;
$ref['06'] = 0;
$ref['07'] = 0;
$ref['08'] = 0;
$ref['09'] = 0;
$ref2['01'] = 0;
$ref2['02'] = 0;
$ref2['03'] = 0;
$ref2['04'] = 0;
$ref2['05'] = 0;
$ref2['06'] = 0;
$ref2['07'] = 0;
$ref2['08'] = 0;
$ref2['09'] = 0;
$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01'  AND ((CWK_MUA_EMP_TYPE = '4' OR CWK_MUA_EMP_TYPE = '5' ) AND (CWK_DSU_POS BETWEEN 123 AND 139 )) OR ((CWK_MUA_EMP_TYPE <> '1') AND (CWK_DSU_POS NOT BETWEEN 15 AND 23  )  AND (CWK_DSU_POS NOT BETWEEN 123 AND 139  ) AND (CWK_DSU_POS NOT BETWEEN 77 AND 79  ))  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while($row = oci_fetch_array($stid, OCI_BOTH)){
	$sql_salary = "SELECT *  FROM ".TB_REF_SALARY_STEP." WHERE  EMP_ID = '".$row["EMP_ID"]."'  ORDER BY REF DESC ";
	$stid_salary = oci_parse($conn, $sql_salary );
	oci_execute($stid_salary);
	$count = 0;
	$salary = array();
	while($row_salary = oci_fetch_array($stid_salary, OCI_BOTH)){
		$salary[$count] = $row_salary["SALARY1"] + $row_salary["SALARY2"] + $row_salary["SALARY3"];
		if($count == 0) $salary_month +=  $salary[0];
		else  $salary_month_old +=  $salary[1];
		$count++;
		if($count == 2) break;
	}
	
	$y = date("Y");
	$yo = ($y-1);
	 $sql_exsalary = "SELECT *  FROM ".TB_EXTRA_SALARY_TAB." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND (LAST_UPDATE BETWEEN TO_DATE('{$y}-01-01','YYYY-MM-DD') AND TO_DATE('{$y}-12-31','YYYY-MM-DD'))  ORDER BY EX_ID DESC ";
	$stid_exsalary = oci_parse($conn, $sql_exsalary );
	oci_execute($stid_exsalary);
	$exsalary = array();
	$exsalary_ref = array();
	
	//while($row_exsalary = oci_fetch_array($stid_exsalary, OCI_BOTH)){
		$row_exsalary = oci_fetch_array($stid_exsalary, OCI_BOTH);
		$exsalary[0] = $row_exsalary["EX_SALARY"];
		$exsalary_ref[0] = $row_exsalary["EX_SALARY_REF"];
		switch ($exsalary_ref[0]){
			case "01": $ref['01'] += $exsalary[0];break;
			case "02": $ref['02'] += $exsalary[0];break;
			case "03": $ref['03'] += $exsalary[0];break;
			case "04": $ref['04'] += $exsalary[0];break;
			case "05": $ref['05'] += $exsalary[0];break;
			case "06": $ref['06'] += $exsalary[0];break;
			case "07": $ref['07'] += $exsalary[0];break;
			case "08": $ref['08'] += $exsalary[0];break;
			case "09": $ref['09'] += $exsalary[0];break;
		}
	//}
	
	$sql_exsalary2 = "SELECT *  FROM ".TB_EXTRA_SALARY_TAB." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND (LAST_UPDATE BETWEEN TO_DATE('{$yo}-01-01','YYYY-MM-DD') AND TO_DATE('{$yo}-12-31','YYYY-MM-DD'))  ORDER BY EX_ID DESC ";
	$stid_exsalary2 = oci_parse($conn, $sql_exsalary2 );
	oci_execute($stid_exsalary2);
	$exsalary2 = array();
	$exsalary_ref2 = array();
//	while($row_exsalary2 = oci_fetch_array($stid_exsalary2, OCI_BOTH)){
	$row_exsalary2 = oci_fetch_array($stid_exsalary2, OCI_BOTH);
		$exsalary2[0] = $row_exsalary2["EX_SALARY"];
		$exsalary_ref2[0] = $row_exsalary2["EX_SALARY_REF"];
		switch ($exsalary_ref2[0]){
			case "01": $ref2['01'] += $exsalary2[0];break;
			case "02": $ref2['02'] += $exsalary2[0];break;
			case "03": $ref2['03'] += $exsalary2[0];break;
			case "04": $ref2['04'] += $exsalary2[0];break;
			case "05": $ref2['05'] += $exsalary2[0];break;
			case "06": $ref2['06'] += $exsalary2[0];break;
			case "07": $ref2['07'] += $exsalary2[0];break;
			case "08": $ref2['08'] += $exsalary2[0];break;
			case "09": $ref2['09'] += $exsalary2[0];break;
		}
	//}
	

  unset($salary);
  unset($exsalary);
  unset($exsalary_ref);
  unset($exsalary2);
  unset($exsalary_ref2);
}
  ?>





<div align="center">บัญชีถือจ่ายเงินเดือน<br />มหาวิทยาลัยราชภัฏสวนดุสิต</div><br />
<table width="1293" border="0" cellspacing="0" cellpadding="8" align="center">
  <tr>
    <td width="191" align="center" valign="middle" class="borderless">ชื่อ - นามสกุล<br />เลขที่บัตรประชาชน</td>
    <td width="162" align="center" valign="middle" class="borderless">ชื่อตำแหน่ง</td>
    <td width="93" align="center" valign="middle" class="borderless">เลขที่ตำแหน่ง</td>
    <td width="164" align="center" valign="middle" class="borderless">ถือจ่ายปีที่แล้ว</td>
    <td width="164" align="center" valign="middle" class="borderless">ถือจ่ายปีนี้</td>
    <td width="117" align="center" valign="middle" class="borderless">จำนวนเงินเลื่อนขั้น</td>
    <td width="153" align="center" valign="middle" class="borderless">ปรับวุฒิ</td>
    <td width="161" align="center" valign="middle" class="borderless">อัตราเงินเดือน<br />ตั้งใหม่</td>
  </tr>
<?
/*$year = date("Y");
$salary['month'] = 0;
$salary_before['month'] = 0;

$sql =  "SELECT * FROM ".TB_CURRENT_WORK_TAB."  WHERE  CWK_STATUS = '01' AND (CWK_MUA_EMP_TYPE <> '1' OR (CWK_MUA_EMP_TYPE = '4' OR CWK_MUA_EMP_TYPE = '5' )) AND ((CWK_DSU_POS NOT BETWEEN 15 AND 23  )  AND (CWK_DSU_POS NOT BETWEEN 123 AND 139  ) AND (CWK_DSU_POS NOT BETWEEN 77 AND 79  ) OR (CWK_DSU_POS BETWEEN 123 AND 139 )  ) ";
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
	$salary_now['month'] += $salary[0];
	$salary_before['month'] += $salary[1];
	
	
	$y = date("Y");
	$yo = (date("Y")-1);*/
	
	/*$sql_ex = "SELECT *  FROM ".REF_EXTRA_SALARY."   ORDER BY ORDERS ASC ";
	$stid_ex = oci_parse($conn, $sql_ex );
	oci_execute($stid_ex);
	while($row_ex = oci_fetch_array($stid_ex, OCI_BOTH)){
		$ID = $row_ex["ID"];
		$exsalary_now{$ID}["month"] = 0;
		$exsalary_before{$ID}["month"] = 0;
		
	 $sql_exsalary = "SELECT *  FROM ".TB_EXTRA_SALARY_TAB." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND (LAST_UPDATE BETWEEN TO_DATE('{$y}-01-01','YYYY-MM-DD') AND TO_DATE('{$y}-12-31','YYYY-MM-DD')) AND EX_SALARY_REF = '".$row_ex["ID"]."' ORDER BY EX_ID DESC ";
	$stid_exsalary = oci_parse($conn, $sql_exsalary );
	oci_execute($stid_exsalary);
	$exsalary = array();
	$exsalary_ref = array();
	while($row_exsalary = oci_fetch_array($stid_exsalary, OCI_BOTH)){
		$exsalary_now{$ID}["month"] += $row_exsalary["EX_SALARY"];;
	}
	
	
	$sql_exsalary2 = "SELECT *  FROM ".TB_EXTRA_SALARY_TAB." WHERE  EMP_ID = '".$row["EMP_ID"]."' AND (LAST_UPDATE BETWEEN TO_DATE('{$yo}-01-01','YYYY-MM-DD') AND TO_DATE('{$yo}-12-31','YYYY-MM-DD'))  AND EX_SALARY_REF = '".$row_ex["ID"]."' ORDER BY EX_ID DESC ";
	$stid_exsalary2 = oci_parse($conn, $sql_exsalary2 );
	oci_execute($stid_exsalary2);
	$exsalary2 = array();
	$exsalary_ref2 = array();
	while($row_exsalary2 = oci_fetch_array($stid_exsalary2, OCI_BOTH)){
		$exsalary_before{$ID}["month"] +=  $row_exsalary2["EX_SALARY"];
	}
	
	
	}*/
	
//}

?>
  <tr>
    <td align="left" valign="top"  style="font-size:13px">&nbsp;</td>
    <td align="left" valign="top"  style="font-size:13px; padding-left:30px">
    เงินเดือน(ต่อเดือน)
    </td>
    <td align="center" valign="top" >&nbsp;</td>
    <td align="right" valign="top"  style="font-size:13px"><? if ($salary_month_old > 0) {echo number_format($salary_month_old,2);}?></td>
    <td align="right" valign="top"  style="font-size:13px;padding-right: 10px"><?=number_format($salary_month,2)?></td>
    <td align="right" valign="top"  style="font-size:13px;padding-right: 10px"><? 
	if(($salary_month > $salary_month_old) and ($salary_month_old > 0) and ($salary_month - $salary_month_old) > 0) echo number_format(($salary_month - $salary_month_old),2);
	?></td>
    <td valign="top" >&nbsp;</td>
    <td valign="top" >&nbsp;</td>
  </tr>
   <tr>
    <td align="left" valign="top"  style="font-size:13px">&nbsp;</td>
    <td align="left" valign="top"  style="font-size:13px; padding-left:30px">
    เงินเดือน(ต่อปี)
    </td>
    <td align="center" valign="top" >&nbsp;</td>
    <td align="right" valign="top"  style="font-size:13px"><? if ($salary_month_old > 0) {echo number_format(($salary_month_old*12),2);}?></td>
    <td align="right" valign="top"  style="font-size:13px;padding-right: 10px"><?=number_format(($salary_month*12),2)?></td>
    <td align="right" valign="top"  style="font-size:13px;padding-right: 10px"><? 
	if((($salary_month*12) > ($salary_month_old*12)) and (($salary_month_old*12) > 0) and (($salary_month*12) - ($salary_month_old*12)) > 0) echo number_format(($salary_month*12) - ($salary_month_old*12),2);
	?></td>
    <td valign="top" >&nbsp;</td>
    <td valign="top" >&nbsp;</td>
  </tr>
<? 
$sql_ex = "SELECT *  FROM ".TB_REF_EXTRA_SALARY."  ORDER BY ORDERS ASC ";
	$stid_ex = oci_parse($conn, $sql_ex );
	oci_execute($stid_ex);
	while($row_ex = oci_fetch_array($stid_ex, OCI_BOTH)){
		$ID = $row_ex["ID"];
?>
 <tr>
    <td align="left" valign="top"  style="font-size:13px">&nbsp;</td>
    <td align="left" valign="top"  style="font-size:13px; padding-left:30px">
    <? echo $row_ex["ABBREVIATION"]."(ต่อเดือน)";?>
    </td>
    <td align="center" valign="top" >&nbsp;</td>
    <td align="right" valign="top"  style="font-size:13px"><? if ($ref2["$ID"] > 0) {echo number_format($ref2["$ID"],2);}?></td>
    <td align="right" valign="top"  style="font-size:13px;padding-right: 10px"><? echo number_format($ref["$ID"],2)?></td>
    <td align="right" valign="top"  style="font-size:13px;padding-right: 10px">&nbsp;</td>
    <td valign="top" >&nbsp;</td>
    <td valign="top" >&nbsp;</td>
  </tr>
   <tr>
    <td align="left" valign="top"  style="font-size:13px">&nbsp;</td>
    <td align="left" valign="top"  style="font-size:13px; padding-left:30px">
    <? echo $row_ex["ABBREVIATION"]."(ต่อปี)";?>
    </td>
    <td align="center" valign="top" >&nbsp;</td>
    <td align="right" valign="top"  style="font-size:13px"><? if ($ref2["$ID"] > 0) {echo number_format(($ref2["$ID"]*12),2);}?></td>
    <td align="right" valign="top"  style="font-size:13px;padding-right: 10px"><? echo number_format(($ref["$ID"]*12),2)?></td>
    <td align="right" valign="top"  style="font-size:13px;padding-right: 10px">&nbsp;</td>
    <td valign="top" >&nbsp;</td>
    <td valign="top" >&nbsp;</td>
  </tr>
<? 
	}
?>
</table><br />
<div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'salary_report4_excel.php?excel=1'"/></div>

</body>
</html>
<?
$db->closedb($conn);
?>