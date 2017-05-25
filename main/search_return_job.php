<?
$fpath = '../';
require_once($fpath."includes/connect.php");
$jnc_order_no = trim($_POST["jnc_order_no"]);
$jnc_pos_name = trim($_POST["jnc_pos_name"]);
$jnc_description = trim($_POST["jnc_description"]);
$jnc_depart = trim($_POST["jnc_depart"]);
$jnc_topic = trim($_POST["jnc_topic"]);
$jnc_status = trim($_POST["jnc_status"]);
if($jnc_order_no == "" and $jnc_pos_name == "" and $jnc_description == "" and $jnc_depart == "" and $jnc_topic == ""  ){
	$q_where = " JNC_STATUS = '$jnc_status' ";
}else{
if($jnc_order_no != ""){
	$where[] = " JNC_ORDER_NO LIKE '%$jnc_order_no%' "; 
}
if($jnc_pos_name != ""){
	$where[] = " JNC_POS_NAME LIKE '%$jnc_pos_name%' "; 
}
if($jnc_topic != ""){
	$where[] = " JNC_TOPIC LIKE '%$jnc_topic%' "; 
}
if($jnc_description != ""){
	$where[] = " JNC_DESCRIPTION LIKE '%$jnc_description%' "; 
}
if($jnc_depart != ""){
	$where[] = " JNC_DEPART = '$jnc_depart' "; 
}
if($jnc_status != ""){
	$where[] = " JNC_STATUS = '$jnc_status' "; 
}

	$where_size = count($where);
	$q_where = "";
	for ($i = 0;$i < $where_size; $i++){
			$q_where .= "$where[$i] AND ";
			
			if($where_size == ($i+1)){
				$q_where = substr($q_where,0,-4); // remove the last " OR AND";
			}
	}
}
$n = 0;
$sql = "SELECT * FROM ".TB_JOB_ANNOUNCEMENT_TAB." WHERE $q_where ORDER BY ID DESC ";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
$num = $db->count_row(TB_JOB_ANNOUNCEMENT_TAB," WHERE $q_where  ",$conn); 
if($num == 0){
	echo "0";
}else{
	//echo "Found $num record(s)";
?>
<!--<link rel="stylesheet" type="text/css" href="../css/main1.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />-->
<table width="934"  border="0" align="center"  bgcolor="#e9e9e9" >
  <tr align="center" class="text_th">
    <td width="30" class="text_tr">ลำดับ</td>
    <td width="83" class="text_tr">เลขที่คำสั่ง</td>
    <td width="186" class="text_tr">ขื่อตำแหน่ง</td>
    <td width="248" class="text_tr">สังกัด/หน่วยงาน</td>
    <td width="63" class="text_tr">จำนวนอัตรา</td>
    <td width="185" class="text_tr">รายละเอียดการจ้างงาน</td>
	<td width="72" class="text_tr">วันที่บันทึก</td>
    <td width="33" class="text_tr">แก้ไข</td>
  </tr>
<?
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
++$n;
?>
<tr align="center" height="22" valign="top">
<td align="center" class="text_td"><?=$n?></td>
<td align="center" class="text_td"><?=$row["JNC_ORDER_NO"]?></td>
<td align="left" class="text_td text_data"><?=$row["JNC_POS_NAME"]?></td>
<td align="left" class="text_td text_data"><?=$row["JNC_DEPART"]?></td>
<td align="center" class="text_td"><?=$row["JNC_QUANTITY"]?></td>
<? 
switch ($row["JNC_DESCRIPTION"]) {
	case "1": $des = "ข้าราชการ";
	break;
	case "2": $des = "พนักงานมหาวิทยาลัย";
	break;
	case "3": $des = "จ้างประจำ";
	break;
	case "4": $des = "จ้างชั่วคราว";
	break;
	case "5": $des = "พนักงานราชการ";
	break;
}
?>
<td align="left" class="text_td text_data"><?=$des?></td>
<td align="center" class="text_td"><?=change_date_thai($row["JNC_DATE"])?></td>
<td align="center" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_job('<?=$n?>')"/></td>
</tr>

<div style="display:none">
   
<div id="jnc_topic<?=$n?>"><?=$row["JNC_TOPIC"]?></div>
<div id="jnc_date<?=$n?>"><?=change_date_thai($row["JNC_DATE"])?></div>
<div id="jnc_order_no<?=$n?>"><?=$row["JNC_ORDER_NO"]?></div>
<div id="jnc_pos_name<?=$n?>"><?=$row["JNC_POS_NAME"]?></div>
<div id="jnc_responsibility<?=$n?>"><?=$row["JNC_RESPONSIBILITY"]?></div>
<div id="jnc_depart<?=$n?>"><?=$row["JNC_DEPART"]?></div>
<div id="jnc_salary<?=$n?>"><?=$row["JNC_SALARY"]?></div>
<div id="jnc_quantity<?=$n?>"><?=$row["JNC_QUANTITY"]?></div>
<div id="jnc_qualification<?=$n?>"><?=$row["JNC_QUALIFICATION"]?></div>
<div id="jnc_qualification_ps<?=$n?>"><?=$row["JNC_QUALIFICATION_PS"]?></div>
<div id="jnc_spec_qualification<?=$n?>"><?=$row["JNC_SPEC_QUALIFICATION"]?></div>
<div id="jnc_description<?=$n?>"><?=$row["JNC_DESCRIPTION"]?></div>
<div id="jnc_date_place<?=$n?>"><?=$row["JNC_DATE_PLACE"]?></div>
<div id="jnc_attach_file<?=$n?>"><?=$row["JNC_ATTACH_FILE"]?></div>
<div id="jnc_status<?=$n?>"><?=$row["JNC_STATUS"]?></div>
<div id="jnc_id<?=$n?>"><?=$row["ID"]?></div>
</div>
<? }
?>
 
    </table>

<? 
}
$db->closedb($conn);	
?>