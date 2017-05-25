<?
include("../includes/connect.php");
function re_hyphen($n){
	if($n == 0) return "-";
	else return number_format($n,0);
}

if($_REQUEST["department"] == "all"){
	$department = "ทั้งหมด";
	$where_dep = "";
}else{
	$department = get_department($_REQUEST["department"],TB_REF_DEPARTMENT);
	$where_dep = " WHERE CWK_MUA_MAIN = '".$_REQUEST["department"]."' ";
}

$edu_level = $_REQUEST["edu_level"];
if($edu_level == "1"){
	$edu_level = "ปริญญาโท";
	$where = " SCH_EDU_LEVEL = '1' ";
}else{
	$edu_level = "ปริญญาเอก";
	$where = " (SCH_EDU_LEVEL = '2' OR SCH_EDU_LEVEL = '3') ";
}

$y = $_REQUEST["year"]-543;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลผู้สำเร็จการศึกษาระดับ<?=$edu_level?> </title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 14px;
}
</style>
</head>

<body>
<div align="center" style="font-size:14px">ข้อมูลผู้สำเร็จการศึกษาระดับ<?=$edu_level?>  <br /><b> <?=$department?> </b>
  <br />
<br />
<table width="1343" border="1" cellspacing="0" cellpadding="3">
  <tr>
    <th width="24" align="center">ที่</th>
    <th width="172" align="center">ชื่อ - สกุล</th>
    <th width="110" align="center">ประเภท</th>
    <th width="158" align="center">คณะ/หน่วยงาน</th>
    <th width="210" align="center">สาขาวิชา</th>
    <th width="202" align="center">สถานศึกษา</th>
    <th width="133" align="center">วันเริ่มศึกษา</th>
    <th width="91" align="center">วันสำเร็จการศึกษา</th>
    <th width="169" align="center">แหล่งทุน</th>
  </tr>
    <? 
	  $n = 1;
	 $sql = "SELECT * FROM ".TB_CURRENT_WORK_TAB." $where_dep ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
 while($row1 = oci_fetch_array($stid, OCI_BOTH)){

   $sql_1 =  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE $where  AND  (SCH_EDU_END_DATE  BETWEEN TO_DATE('{$y}-01-01','YYYY-MM-DD') AND TO_DATE('{$y}-12-31','YYYY-MM-DD')) AND (SCH_EDU_END_DATE is not null OR SCH_EDU_END_DATE is not null OR SCH_EDU_END_DATE <> '' ) AND EMP_ID = '".$row1["EMP_ID"]."' ";
$stid_1 = oci_parse($conn, $sql_1 );
echo $sql_1;
oci_execute($stid_1);
  while($row = oci_fetch_array($stid_1, OCI_BOTH)){
	  
	  if($row["SCH_MAJOR"] == "oth"){
		  $major = $row["SCH_MAJOR_OTH"] ;
	  }else{
		  $major = get_edu_major($row["SCH_MAJOR"],TB_REF_PROGRAM);
	  }
	  
  ?>
  <tr>
    <td align="center" valign="top"><?=$n?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_name2($row["EMP_ID"],TB_BIODATA_TAB)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_stafftype($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_STAFFTYPE)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=get_department2($row["EMP_ID"],TB_CURRENT_WORK_TAB,TB_REF_DEPARTMENT)?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$major?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["SCH_UNI"]?></td>
    <td align="center" valign="top"><?=change_date_thai($row["SCH_EDU_START_DATE"])?></td>
    <td align="center" valign="top"><?=change_date_thai($row["SCH_EDU_END_DATE"])?></td>
    <td align="left" valign="top" style="padding-left:3px"><?=$row["SCH_SOURCE"]?></td>
  </tr>
    <?
  $n++;
  }
  }
   ?>
</table><br />
<div align="center"> <input type="button" value="Export to Excel" onclick="window.location = 'scholar_report6_excel.php?excel=1&department=<?=$_REQUEST["department"]?>&edu_level=<?=$_REQUEST["edu_level"]?>&year=<?=$_REQUEST["year"]?>'"/></div>

</div>
</body>
</html>
<?
$db->closedb($conn);
?>