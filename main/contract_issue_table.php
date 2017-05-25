<?php
	@session_start();
	$fpath = '';
	require_once($fpath."../includes/connect.php");

	$contract_no = $_REQUEST['contract_no'];
	$emp_id = $_SESSION['EMP_ID'];
	
	$sql = "SELECT * FROM ". TB_CONTRACT_ISSUE ." WHERE EMP_ID = '$emp_id' AND CONTRACT_NO = '$contract_no' ";
	//echo $sql;
	$nub = 1;
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	
 	$count = $db->count_row(TB_CONTRACT_ISSUE," WHERE EMP_ID = '$emp_id' AND CONTRACT_NO = '$contract_no' ",$conn);
	if($count == 0) { exit(); }
	?>
    <script src="../js/vtip.js" type="text/javascript"></script>
    <table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
        <td width="5%" class="text_tr">ลำดับ</td>
        <td width="30%" class="text_tr">ประเภทผลงาน</td>
        <td width="29%" class="text_tr">ชื่อผลงาน</td>
        <td width="17%" class="text_tr">ปีที่พิมพ์/เผยแพร่</td>
        <td width="11%" class="text_tr">แก้ไข/แสดง</td>
        <td width="8%" class="text_tr">ลบ</td>
    </tr>

   <?php
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
	<tr align="center">
        <td width="5%" class="text_td"><?=$nub;?></td>
        <td width="30%" class="text_td" align="right"><?=convert_issue_type($row['ISSUE_TYPE']);?><span id="istype<?=$row['ISSUE_ID'];?>" style="display:none;"><?=$row['ISSUE_TYPE'];?></span></td>
        <td width="29%" class="text_td" align="right"><span id="issuename<?php echo $row['ISSUE_ID'];?>"><?=$row['ISSUE'];?></span></td>
        <td width="17%" class="text_td"><span id="issueyear<?=$row['ISSUE_ID'];?>"><?=$row['ISSUE_PUBLISH'];?></span></td>
        <td width="11%" class="text_td"><img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_issue('<?=$row['ISSUE_ID'];?>')"/></td>
        <td width="8%" class="text_td"><img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_issue('<?=$row['ISSUE_ID']?>','<?php echo $emp_id; ?>','<?php echo $contract_no; ?>')"/></td>
    </tr>
<?php
	$nub++;
	}
	
	function convert_issue_type($type_id) {
		$t = array(1=>"เอกสารประกอบการสอน",2=>"ตำรา",3=>"งานวิจัย",4=>"หนังสือ",5=>"ผลงานวิชาการลักษณะอื่น");
		return $t[$type_id];
	}
?>
</table>
<?
$db->closedb($conn);
?>