<?
if($_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=early_retire_report_".date("d-m-").(date("Y") +543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
$fpath = '../';
require_once($fpath."includes/connect.php");
?>
<style type="text/css">
body,td,th {
	font-family: Tahoma, "Microsoft Sans Serif", Verdana;
	font-size:14px;
}
</style>

<div style="padding-left:34px" align="left">
<h3>ข้าราชการเกษียณก่อนกำหนด</h3>
</div>
<div  align="center">
<table border="1" cellspacing="0" cellpadding="3" bordercolor="#000000">
  <tr >
    <th width="28" height="25" align="center">ลำดับ</th>
    <th width="220" align="center">ชื่อ - นามสกุล</th>
    <th width="100" align="center">ตำแหน่ง</th>
    <th width="220" align="center">สังกัด</th>
    <th colspan="3" align="center">วดป เกิด</th>
    <th colspan="3" align="center">วันเริ่มรับราชการ</th>
  </tr>
<? 
$sql = "SELECT * FROM  ".TB_CURRENT_WORK_TAB." WHERE CWK_STATUS = '04'  AND CWK_MUA_EMP_TYPE <> '6' AND CWK_MUA_EMP_TYPE <> '7' AND CWK_MUA_EMP_TYPE <> '8' ORDER BY CWK_START_WORK_DATE ASC "; 
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$n2 = 0;
while($row = oci_fetch_array($stid, OCI_BOTH)){
	list($year1,$month1,$day1) = explode("-",$row['CWK_START_WORK_DATE']);
	list($day2,$month2,$year2) = explode("/",get_birthday($row['EMP_ID'],TB_BIODATA_TAB));
?>
  <tr>
    <td height="32" align="center"><?=++$n2?></td>
    <td align="left" style='padding-left:7px'><?=get_name($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td align="left" style='padding-left:7px'><?=get_position($row['CWK_MUA_VPOS'],$row['CWK_MUA_LEVEL'])?></td>
    <td align="left" style='padding-left:7px'><?=get_department($row['CWK_MUA_MAIN'],TB_REF_DEPARTMENT)?></td>
    <td width="20" align="center"><?=($day2+0)?></td>
    <td width="28" align="center"><?=get_month($month2)?></td>
    <td width="30" align="center"><?=$year2?></td>
    <td width="20" align="center"><?=($day1+0)?></td>
    <td width="28" align="center"><?=get_month($month1)?></td>
    <td width="30" align="center"><?=($year1 + 543)?></td>
  </tr>
 <?
}
 ?>
</table>
</div>
<? $db->closedb($conn);	
if($_REQUEST['print'] == "1"){
?>
<script language="javascript">
window.print();
var t=setTimeout("window.close()",300)
</script>

<?
}
?>