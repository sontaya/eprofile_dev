<?
if($_REQUEST["excel"] == "1"){
header("Content-Type: application/vnd.ms-excel");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=retire_report_(".$_REQUEST['type'].")".($_REQUEST['year']+543).".xls;");
header("Pragma: no-cache");
header("Expires: 0");
}
$fpath = '../';
require_once($fpath."includes/connect.php");
switch ($_REQUEST['type']){
	case "1": $txt = "ข้าราชการ"; break;
	case "2": $txt = "พนักงานราชการ"; break;
	case "3": $txt = "พนักงานมหาวิทยาลัย"; break;
	case "4": $txt = "ลูกจ้างประจำ"; break;
	case "5": $txt = "ลูกจ้างชั่วคราว"; break;
}
?>
<style type="text/css">
body,td,th {
	font-family: Tahoma, "Microsoft Sans Serif", Verdana;
	font-size:14px;
}
</style>

<div style="padding-left:34px" align="left">
<h3><?=$txt?>เกษียณอายุราชการ ประจำปี  <?=($_REQUEST['year'])?></h3>
</div>
<div  align="center">
<table border="1" cellspacing="0" cellpadding="3" align="center" bordercolor="#000000">
  <tr>
    <th width="28" align="center">ลำดับ</th>
    <th width="180" align="center">ชื่อ - นามสกุล</th>
    <th width="100" align="center">ตำแหน่ง</th>
    <th width="180" align="center">สังกัด</th>
    <th colspan="3" align="center">วดป เกิด</th>
    <th colspan="3" align="center">วันเริ่มรับราชการ</th>
  </tr>
<? 
$sql = "SELECT * FROM  ".TB_CURRENT_WORK_TAB." WHERE CWK_STATUS = '04' AND CWK_RETIRE = '1' AND CWK_MUA_EMP_TYPE = '".$_REQUEST['type']."' ORDER BY CWK_START_WORK_DATE ASC "; 
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$n1 = 0;
$check = "";
while($row = oci_fetch_array($stid, OCI_BOTH)){

	list($year1,$month1,$day1) = explode("-",$row['CWK_RETIRE_DATE']);
	list($day2,$month2,$year2) = explode("/",get_birthday($row['EMP_ID'],TB_BIODATA_TAB));
	list($year3,$month3,$day3) = explode("-",$row['CWK_START_WORK_DATE']);

	if($year1 == ($_REQUEST['year']-543) ){
		$check = "correct";
	}
	
	if($check == "correct"){
?>
  <tr>
    <td align="center" valign="top"><?=++$n1?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_name($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_position($row['CWK_MUA_VPOS'],$row['CWK_MUA_LEVEL'])?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_department($row['CWK_MUA_MAIN'],TB_REF_DEPARTMENT)?></td>
    <td width="20" align="center" valign="top"><?=($day2+0)?></td>
    <td width="28" align="center" valign="top"><?=get_month($month2)?></td>
    <td width="30" align="center" valign="top"><?=$year2?></td>
    <td width="20" align="center" valign="top"><?=($day3+0)?></td>
    <td width="28" align="center" valign="top"><?=get_month($month3)?></td>
    <td width="30" align="center" valign="top"><?=($year3 + 543)?></td>
  </tr>
 <?
	}
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