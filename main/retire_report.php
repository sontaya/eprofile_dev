<?
@session_start();
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>

<? }

?>
<script language="javascript">
function change_retire(year,type){
	$("div#retire_data").html("<img src='../images/indicator_medium.gif' align='absmiddle' />");
	var data = "year="+year+"&type="+type;
	ajaxPostData("retire_report_res.php",data,"text","",result_retire_res,"","");
	
}

function result_retire_res(response){
		$("div#retire_data").html(response);
}

</script>
<?
$fpath = '../';
require_once($fpath."includes/connect.php");

?>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<div style="padding-left:34px" align="left">
<h3>รายงานเกษียณอายุราชการ ประจำปี : 
  <select id="year" name="year"  style="width:65px;">
<?
$year = ((date("Y") + 543)-6);
for($i=0;$i<11;$i++){
	$year = $year + 1;
	if($year == (date("Y") + 543)) $select = "selected='selected'"; else $select = "";
echo "<option value='$year' $select>$year</option>\n";
}
?>
</select>&nbsp;&nbsp; ประเภท 
<select id="type" name="type"  >
<?
$sql = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID = '1' OR STAFFTYPE_ID = '4' ORDER BY STAFFTYPE_ID ASC "; 
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$n1 = 0;
$check = "";
while($row = oci_fetch_array($stid, OCI_BOTH)){
echo "<option value='".$row['STAFFTYPE_ID']."' >".$row['STAFFTYPE_NAME']."</option>\n";
}
?>
</select> 
<input type="button" value="แสดงรายงาน" onclick="change_retire(document.getElementById('year').value,document.getElementById('type').value);"/>
</h3>
</div>
<div  align="center" id="retire_data">
<table  border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000">
  <tr>
    <th width="28" align="center">ลำดับ</th>
    <th width="180" align="center">ชื่อ - นามสกุล</th>
    <th width="100" align="center">ตำแหน่ง</th>
    <th width="180" align="center">สังกัด</th>
    <th colspan="3" align="center">วดป เกิด</th>
    <th colspan="3" align="center">วันเริ่มรับราชการ</th>
  </tr>
<? 
/*$sql = "SELECT * FROM  ".TB_CURRENT_WORK_TAB." WHERE CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_VPOS <> '00' ORDER BY CWK_START_WORK_DATE ASC "; 
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$n1 = 0;
$check = "";
while($row = oci_fetch_array($stid, OCI_BOTH)){

	list($year1,$month1,$day1) = explode("-",$row['CWK_START_WORK_DATE']);
	list($day2,$month2,$year2) = explode("/",get_birthday($row['EMP_ID'],TB_BIODATA_TAB));
	
	$d =  (date("Y")+543) - $year2;
	if($d > 60){
		$check = "correct";
	}
	else if($d == 60) {
		if(($month2+0) < 10){
			$check = "correct";
		}
	}
	
	if($check == "correct"){*/
?>
<!--  <tr>
    <td align="center" valign="top"><?=++$n1?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_name($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_position($row['CWK_MUA_VPOS'],$row['CWK_MUA_LEVEL'])?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_department($row['CWK_MUA_MAIN'],TB_REF_DEPARTMENT)?></td>
    <td width="20" align="center" valign="top"><?=($day2+0)?></td>
    <td width="28" align="center" valign="top"><?=get_month($month2)?></td>
    <td width="30" align="center" valign="top"><?=$year2?></td>
    <td width="20" align="center" valign="top"><?=($day1+0)?></td>
    <td width="28" align="center" valign="top"><?=get_month($month1)?></td>
    <td width="30" align="center" valign="top"><?=($year1 + 543)?></td>
  </tr>-->
 <?
	//}
//}
//if($n1 == 0){
echo "\n<tr><td colspan='10' align='center'><b>-------- ไม่มีข้อมูล --------</b></td></tr>\n";//}
 ?>
</table>
<?
/*if($n1 >0){
echo "\n<p align='right' style='padding-right:33px'><input type='button' value='Print' onclick=\"window.open('retire_excel.php?print=1&year=".date("Y")."','retire','width=900,height=500')\"/> <input type='button' value='Export to excel' onclick=\"window.location='retire_excel.php?excel=1&year=".date("Y")."'\" /></p>\n";}*/
?>
</div>
<br />
<div style="padding-left:34px" align="left">
<h3>ข้าราชการเกษียณก่อนกำหนด</h3>
</div>
<div  align="center">
<table  border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000">
  <tr>
    <th width="28" align="center">ลำดับ</th>
    <th width="180" align="center">ชื่อ - นามสกุล</th>
    <th width="100" align="center">ตำแหน่ง</th>
    <th width="180" align="center">สังกัด</th>
    <th colspan="3" align="center">วดป เกิด</th>
    <th colspan="3" align="center">วันเริ่มรับราชการ</th>
  </tr>
<? 
$sql = "SELECT * FROM  ".TB_CURRENT_WORK_TAB." WHERE CWK_STATUS = '04'  AND (CWK_MUA_EMP_TYPE = '1' OR CWK_MUA_EMP_TYPE = '4')  ORDER BY CWK_START_WORK_DATE ASC "; 
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$n2 = 0;
while($row = oci_fetch_array($stid, OCI_BOTH)){
	list($year1,$month1,$day1) = explode("-",$row['CWK_START_WORK_DATE']);
	list($day2,$month2,$year2) = explode("/",get_birthday($row['EMP_ID'],TB_BIODATA_TAB));
	 $d =  (date("Y")+543) - $year2;
	if($d < 60){//เช็คว่าอายุน้อยกว่า 60 แล้วเกษียนอายุ
		$check = "correct";
	}
	
	if($check == "correct"){
?>
  <tr>
    <td align="center" valign="top"><?=++$n2?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_name($row['EMP_ID'],TB_BIODATA_TAB)?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_position($row['CWK_MUA_VPOS'],$row['CWK_MUA_LEVEL'])?></td>
    <td align="left" valign="top" style='padding-left:7px'><?=get_department($row['CWK_MUA_MAIN'],TB_REF_DEPARTMENT)?></td>
    <td width="20" align="center" valign="top"><?=($day2+0)?></td>
    <td width="28" align="center" valign="top"><?=get_month($month2)?></td>
    <td width="30" align="center" valign="top"><?=$year2?></td>
    <td width="20" align="center" valign="top"><?=($day1+0)?></td>
    <td width="28" align="center" valign="top"><?=get_month($month1)?></td>
    <td width="30" align="center" valign="top"><?=($year1 + 543)?></td>
  </tr>
 <?
	}
}
if($n2 == 0){
echo "\n<tr><td colspan='10' align='center'><b>-------- ไม่มีข้อมูล --------</b></td></tr>\n";}
 ?>
</table>
<?
if($n2 >0){
echo "\n<p align='right' style='padding-right:33px'><input type='button' value='Print' onclick=\"window.open('retire_early_excel.php?print=1','retire','width=900,height=500')\"/> <input type='button' value='Export to excel' onclick=\"window.location='retire_early_excel.php?excel=1'\" /></p>\n";}
?>
</div>
<? $db->closedb($conn);	?>