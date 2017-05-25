<?
@session_start();
if (!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
  <script language="javascript">
    window.location = "../" ;
  </script>

<? }
?>
<?
$fpath = '../';
require_once($fpath . "includes/connect.php");
?>
<table border="1" cellspacing="0" cellpadding="5" align="center" bordercolor="#000000">
  <tr>
    <th width="28" align="center">ลำดับ</th>
    <th width="150" align="center">ชื่อ - นามสกุล</th>
    <th width="100" align="center">ตำแหน่ง</th>
    <th width="180" align="center">สังกัด</th>
    <th width="73" align="center">วดป เกิด</th>
    <th width="40" align="center">เกษียณ</th>
    <th width="45" align="center">ต่ออายุราชการ</th>
  </tr>
<?
$sql = "SELECT SDU_CURRENT_WORK_TAB.*,BIO_BIRTHDAY FROM  " . TB_CURRENT_WORK_TAB . " LEFT JOIN SDU_BIODATA_TAB ON SDU_CURRENT_WORK_TAB.EMP_ID = SDU_BIODATA_TAB.EMP_ID WHERE CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07'   AND CWK_MUA_EMP_TYPE = '" . $_REQUEST['type'] . "' ORDER BY BIO_BIRTHDAY ASC ";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
$n1 = 0;
$check = "";

while ($row = oci_fetch_array($stid, OCI_BOTH)) {
    if($row["CWK_STATUS"]=="01" || $row["CWK_STATUS"]=="03" || $row["CWK_STATUS"]=="05"){

  list($year1, $month1, $day1) = explode("-", $row['CWK_RETIRE_DATE']);
  list($day2, $month2, $year2) = explode("/", get_birthday($row['EMP_ID'], TB_BIODATA_TAB));
  
  if ($row['CWK_STATUS'] != '02' and $row['CWK_STATUS'] != '04' and $row['CWK_STATUS'] != '07' and $_REQUEST['year'] >= ($year1+543)) {
    $d = $_REQUEST['year'] - $year2;
    
    if ($d > 60 ) {
      $check = "correct";
    } else if ($d == 60) {
      if (($month2 + 0) < 10) {
        $check = "correct";
      }
    }else
      $check="";
  }else {

    $check = "";
  }
  if ($check == "correct") {
?>
    <tr>
      <td align="center" valign="top"><?= ++$n1 ?></td>
      <td align="left" valign="top" style='padding-left:7px'><?= get_name($row['EMP_ID'], TB_BIODATA_TAB)."[".$row['EMP_ID']."]".($year1+543)." ".$_REQUEST['year'] ?></td>
      <td align="left" valign="top" style='padding-left:7px'><?= get_position($row['CWK_MUA_VPOS'], $row['CWK_MUA_LEVEL']) ?></td>
      <td align="left" valign="top" style='padding-left:7px'><?= get_department($row['CWK_MUA_MAIN'], TB_REF_DEPARTMENT) ?></td>
      <td  align="center" valign="top"><?= ($day2 + 0) ?> <?= get_month($month2) ?> <?= $year2 ?></td>
      <td  align="center" valign="middle"><img src="../images/i.del.png"  style="cursor:pointer" onclick="retire_now('<?= $row['EMP_ID'] ?>')"/></td>
      <td  align="center" valign="middle"><img src="../images/i.edit.png" style="cursor:pointer" onclick="new_gov('<?= $row['EMP_ID'] ?>')"/></td>
    </tr>
<?
  }
}
}

if ($n1 == 0) {
  echo "\n<tr><td colspan='7' align='center'><b>-------- ไม่มีข้อมูล --------</b></td></tr>\n"; }
?>
</table>
<?
/* if($n1 >0){
  echo "\n<p align='right' style='padding-right:33px'><input type='button' value='Print' onclick=\"window.open('retire_excel.php?print=1&type=".$_REQUEST['type']."&year=".($_REQUEST['year']-543)."','retire','width=900,height=500')\"/> <input type='button' value='Export to excel' onclick=\"window.location='retire_excel.php?excel=1&type=".$_REQUEST['type']."&year=".($_REQUEST['year']-543)."'\" /></p><br />\n";} */
?>

<? $db->closedb($conn); ?>