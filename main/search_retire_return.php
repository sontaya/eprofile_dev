<?
$fpath = '../';
require_once($fpath."includes/connect.php");
$name = trim($_POST["name"]);
$lastname = trim($_POST["lastname"]);
$emp_id = trim($_POST["emp_id"]);
$person_id = trim($_POST["person_id"]);
if($name != ""){
	$where[] = " BIO_FNAME_TH LIKE '%$name%' "; 
}
if($lastname != ""){
	$where[] = " BIO_LNAME_TH LIKE '%$lastname%' "; 
}
if($emp_id != ""){
	$where[] = " EMP_ID LIKE '%$emp_id%' "; 
}
if($person_id != ""){
	$where[] = " PERSON_ID LIKE '%$person_id%' "; 
}

	$where_size = count($where);
	$q_where = "";
	for ($i = 0;$i < $where_size; $i++){
			$q_where .= "$where[$i] AND ";
			
			if($where_size == ($i+1)){
				$q_where = substr($q_where,0,-4); // remove the last " OR AND";
				//$q_where .= " WHERE CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_VPOS <> '00' "; 
			}
	}
$n = 0;
$num = $db->count_row(TB_BIODATA_TAB," WHERE $q_where  ",$conn); 
if($num == 0){
	echo "0";
}else{
	//echo "Found $num record(s)";
$sql = "SELECT * FROM ".TB_BIODATA_TAB." WHERE $q_where  ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {

$num2 = $db->count_row(TB_CURRENT_WORK_TAB," WHERE EMP_ID = '".$row["EMP_ID"]."'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_VPOS <> '00' ",$conn);
//echo " WHERE EMP_ID = '".$row["EMP_ID"]."'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_VPOS <> '00' <br>";
if($num2 > 0){
++$n;

if($n == 1){
?>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<table width="729"  border="0" align="center"  bgcolor="#e9e9e9" >
  <tr align="center" class="text_th">
    <td width="28" class="text_tr">ลำดับ</td>
    <td width="178" class="text_tr">ขื่อ - นามสกุล</td>
    <td width="120" class="text_tr">เลขบัตรบุคลากร </td>
    <td width="133" class="text_tr">เลขประจำตัวประชาชน </td>
    <td width="107" class="text_tr">วันเกิด</td>
    <td width="83" class="text_tr">วันที่เริ่มทำงาน</td>
    <td width="50" class="text_tr">เกษียณุ</td>
  </tr>
<?	
}
$sql2 = "SELECT CWK_START_WORK_DATE FROM ".TB_CURRENT_WORK_TAB." WHERE EMP_ID = '".$row["EMP_ID"]."'  AND CWK_STATUS <> '02' AND CWK_STATUS <> '04' AND CWK_STATUS <> '07' AND CWK_MUA_VPOS <> '00' ";
$stid2 = oci_parse($conn, $sql2 );
oci_execute($stid2);
$row2 = oci_fetch_array($stid2, OCI_BOTH);

?>
<tr align="center" height="22" valign="top">
<td align="center" class="text_td"><?=$n?></td>
<td align="left" class="text_td text_data"><?=$row["BIO_FNAME_TH"]?> <?=$row["BIO_LNAME_TH"]?></td>
<td align="center" class="text_td"><?=$row["EMP_ID"]?></td>
<td align="center" class="text_td"><?=$row["PERSON_ID"]?></td>
<td align="center" class="text_td"><?=change_date_thai($row["BIO_BIRTHDAY"])?></td>
<td align="center" class="text_td"><?=change_date_thai($row2["CWK_START_WORK_DATE"])?></td>
<td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Click to retire" alt="Click to retire" onclick="retire('<?=$row["EMP_ID"]?>');"/></td>
</tr>

<? }}
if($n > 0 ){
?>
    </table>
<? 
}else echo "0";
}
$db->closedb($conn);	
?>