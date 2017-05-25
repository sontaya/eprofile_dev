<?
include("../includes/connect.php");
list($begin_day,$begin_month,$begin_year) = explode("/",$_REQUEST["date1"]);
list($end_day,$end_month,$end_year) = explode("/",$_REQUEST["date2"]);
$d1 = date2_formatdb($_REQUEST["date1"]);
$d2 = date2_formatdb($_REQUEST["date2"]);
$train_type = $_REQUEST["train_type"];
if($train_type == "1"){
$sql_1 =  "SELECT * FROM ".TB_SEMINAR_TAB." WHERE SEM_END_DATE BETWEEN TO_DATE('$d1 ','YYYY-MM-DD') AND TO_DATE('$d2 ','YYYY-MM-DD') ORDER BY SEM_END_DATE ASC";
$stid_1 = oci_parse($conn, $sql_1 );
oci_execute($stid_1);
}elseif($train_type == "2"){
$sql_2 =  "SELECT * FROM ".TB_CONSTRUCTOR_TAB." WHERE CON_END_DATE BETWEEN TO_DATE('$d1 ','YYYY-MM-DD') AND TO_DATE('$d2 ','YYYY-MM-DD')";
$stid_2 = oci_parse($conn, $sql_2 );
oci_execute($stid_2);
}elseif($train_type == "3"){
$sql_3 =  "SELECT * FROM ".TB_CONSULT_COMMIT_TAB." WHERE COM_END_DATE BETWEEN TO_DATE('$d1 ','YYYY-MM-DD') AND TO_DATE('$d2 ','YYYY-MM-DD')";
$stid_3 = oci_parse($conn, $sql_3 );
oci_execute($stid_3);
}elseif($train_type == "4"){
$sql_4 =  "SELECT * FROM ".TB_COMMITTEE_TAB." WHERE COM_END_DATE BETWEEN TO_DATE('$d1 ','YYYY-MM-DD') AND TO_DATE('$d2 ','YYYY-MM-DD')";
$stid_4 = oci_parse($conn, $sql_4 );
oci_execute($stid_4);
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>การพัฒนาบุคคลากร</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
</head>

<body>
<div align="center" style="font-size:14px">สรุปข้อมูลการพัฒนาบุคคลากร <br />
  <br />
ข้อมูลระหว่าง วันที่ <? echo (int)$begin_day." ".get_month_full((int)$begin_month)." ".($begin_year);?> ถึงวันที่ <? echo (int)$end_day." ".get_month_full((int)$end_month)." ".($end_year);?><br />
<br />
</div>
<table  border="1" cellspacing="0" cellpadding="2" align="center">
  <tr>
    <th width="20" align="center">ที่</th>
    <th width="141" align="center">ชื่อ - สกุล</th>
   <th width="120" align="center">ประเภทบุคลากร</th>
    <th width="70" align="center">สาย</th>
    <th width="150" align="center">หน่วยงาน</th>
    <th width="120" align="center">ประเภท</th>
    <th width="88" align="center">เลขที่คำสั่ง</th>
    <th width="80" align="center">วันที่เริ่มต้น</th>
    <th width="88" align="center">วันที่สิ้นสุด</th>
    <th width="202" align="center">ชื่อหลักสูตร</th>
    <th width="193" align="center">สถานที่อบรม</th>
    <th width="89" align="center">ประเทศ</th>
  </tr>
  <? 
  $n = 1;
  if($train_type == "1"){
  while($row = oci_fetch_array($stid_1, OCI_BOTH)){
  ?>
  <tr>
    <td align="center" valign="top"><?=$n?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_name2($row["EMP_ID"],TB_BIODATA_TAB)?></td>
    <td align="center" valign="top"><?=get_stafftype($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_STAFFTYPE)?></td>
    <td align="center" valign="top"><?=get_stafftypesub($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_SUBSTAFFTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_department2($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_DEPARTMENT)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=type_seminar($row["SEM_TYPE"],TB_REF_TRAINTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px">&nbsp;</td>
    <td align="center" valign="top"><?=change_date_thai($row["SEM_START_DATE"])?></td>
    <td align="center" valign="top"><?=change_date_thai($row["SEM_END_DATE"])?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["SEM_COURSE_NAME"]?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["SEM_PLACE"]?></td>
    <td align="center" valign="top">ไทย</td>
  </tr>
  <?
  $n++;
  
  }
  $row = NULL;
  }elseif($train_type == "2"){

  while($row = oci_fetch_array($stid_2, OCI_BOTH)){
  ?>
  <tr>
    <td align="center" valign="top"><?=$n?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_name2($row["EMP_ID"],TB_BIODATA_TAB)?></td>
    <td align="center" valign="top"><?=get_stafftype($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_STAFFTYPE)?></td>
    <td align="center" valign="top"><?=get_stafftypesub($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_SUBSTAFFTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_department2($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_DEPARTMENT)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=type_seminar($row["CON_TYPE"],TB_REF_TRAINTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["CON_ORDER_NO"]?></td>
    <td align="center" valign="top"><?=change_date_thai($row["CON_START_DATE"])?></td>
    <td align="center" valign="top"><?=change_date_thai($row["CON_END_DATE"])?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["CON_COURSE_NAME"]?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["CON_PLACE"]?></td>
    <td align="center" valign="top"><?=$row["CON_COUNTRY"]?></td>
  </tr>
  <?
  $n++;
  }
  $row = NULL;
  }elseif($train_type == "3"){
  while($row = oci_fetch_array($stid_3, OCI_BOTH)){
  ?>
  <tr>
    <td align="center" valign="top"><?=$n?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_name2($row["EMP_ID"],TB_BIODATA_TAB)?></td>
    <td align="center" valign="top"><?=get_stafftype($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_STAFFTYPE)?></td>
    <td align="center" valign="top"><?=get_stafftypesub($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_SUBSTAFFTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_department2($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_DEPARTMENT)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=type_seminar($row["COM_TYPE"],TB_REF_TRAINTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["COM_ORDER_NO"]?></td>
    <td align="center" valign="top"><?=change_date_thai($row["COM_START_DATE"])?></td>
    <td align="center" valign="top"><?=change_date_thai($row["COM_END_DATE"])?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["COM_COURSE"]?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["COM_ORG_NAME"]?></td>
    <td align="center" valign="top"><?=$row["COM_COUNTRY"]?></td>
  </tr>
  <?
  $n++;
  }
  $row = NULL;
  }elseif($train_type == "4"){
  while($row = oci_fetch_array($stid_4, OCI_BOTH)){
  ?>
  <tr>
    <td align="center" valign="top"><?=$n?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_name2($row["EMP_ID"],TB_BIODATA_TAB)?></td>
    <td align="center" valign="top"><?=get_stafftype($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_STAFFTYPE)?></td>
    <td align="center" valign="top"><?=get_stafftypesub($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_SUBSTAFFTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_department2($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_DEPARTMENT)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=type_seminar($row["COM_TYPE"],TB_REF_TRAINTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["COM_ORDER_NO"]?></td>
    <td align="center" valign="top"><?=change_date_thai($row["COM_START_DATE"])?></td>
    <td align="center" valign="top"><?=change_date_thai($row["COM_END_DATE"])?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["COM_CURRICULUM"]?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["COM_ORG_NAME"]?></td>
    <td align="center" valign="top"><?=$row["COM_COUNTRY"]?></td>
  </tr>
  <?
  $n++;
  }
  $row = NULL;
  }
   ?>
</table><br />
<div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'dev_report_excel.php?excel=1&date1=<?=$_REQUEST["date1"]?>&date2=<?=$_REQUEST["date2"]?>&train_type=<?=$_REQUEST["train_type"]?>'"/></div>

</body>
</html>

<?
$db->closedb($conn);
?>