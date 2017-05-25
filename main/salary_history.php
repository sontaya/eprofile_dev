<?
@session_start();
$emp_id = $_REQUEST['emp_id'];
include("../includes/connect.php");
$sql = "SELECT * FROM ".TB_REF_SALARY_STEP." WHERE EMP_ID = '{$emp_id}' ORDER BY REF ASC";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$nrow = $db->count_row(TB_REF_SALARY_STEP,"  WHERE EMP_ID = '{$emp_id}' ",$conn);


$sql_budget = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
$stid_budget = oci_parse($conn, $sql_budget );
oci_execute($stid_budget);
$from = array();
while($row_budget =oci_fetch_array($stid_budget, OCI_BOTH) ){
	$from[$row_budget["CODE_SALARY_SOURCE"]] = $row_budget["NAME_SALARY_SOURCE"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ประวัติเงินเดือน</title>
<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />
</head>

<body>
<h2 align="center">ประวัติเงินเดือน</h2>
<table  border="1" cellspacing="0" cellpadding="7" bordercolor="#000000" align="center">
  <tr>
    <th width="28" align="center">ลำดับ</th>
    <th width="190" align="center">งบประมาณแรก</th>
    <th width="77" align="center">จำนวน</th>
    <th width="190" align="center">งบประมาณที่สอง</th>
    <th width="77" align="center">จำนวน</th>
    <th width="190" align="center">งบประมาณที่สาม</th>
    <th width="77" align="center">จำนวน</th>
    <th width="83" align="center">รวม</th>
    <th width="97" align="center">วันที่มีผลบังคับใช้</th>
  </tr>
   <?
  	if($nrow == 0) {
  ?>
    <tr>
      <td align="center" colspan="9"> - ยังไม่มีข้อมูลเงินเดือน - </td>
    </tr>
     <?
	}
	else {
		$rn = 0;
		while($row = oci_fetch_array($stid, OCI_BOTH)) {
			$salary = ($row['SALARY1']+$row['SALARY2']+$row['SALARY3']);
			 $mod = 10 - ($salary%10);
			if($mod < 10 )
			$salary += $mod;
  ?>
  <tr>
    <td align="center" valign="top"><?=++$rn?></td>
   <td align="left" valign="top"><?=$from[$row['SOURCE1']]?></td>
    <td align="right" valign="top" style="padding-right:5px"><?=number_format($row['SALARY1'],0);?></td>
    <td align="left" valign="top"><?=$from[$row['SOURCE2']]?></td>
    <td align="right" valign="top" style="padding-right:5px"><?=number_format($row['SALARY2'],0);?></td>
    <td align="left" valign="top"><?=$from[$row['SOURCE3']]?></td>
    <td align="right" valign="top" style="padding-right:5px"><?=number_format($row['SALARY3'],0);?></td>
    <td align="right" valign="top" style="padding-right:5px"><b><?=number_format($salary,0)?></b></td>
    <td align="center" valign="top"><?=change_date_thai($row['AFFECTIVE_DATE']);?></td>
  </tr>
  <?
		}
	}
  ?>
</table>

</body>
</html>
<? $db->closedb($conn); ?>