<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_WARN_PUNISH_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<table width="70%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
    	
        <td width="6%" class="text_tr">ลำดับ</td>
        <td width="51%" class="text_tr">โทษทางวินัย</td>
        <td width="27%" class="text_tr">วันที่</td>
        <?php if($_SESSION['USER_TYPE'] != 'chief') { ?><td width="13%" class="text_tr">แก้ไข/แสดง</td><?php } ?>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td width="3%" class="text_tr">ลบ</td>
        <?php } ?>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_WARN_PUNISH_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY WAP_DATE DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
	
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];
	switch($row["WAP_TYPE"]){
		case "1" : $wap_name = "ตักเตือน";break;
		case "2" : $wap_name = "ภาคทัณฑ์";break;
		case "3" : $wap_name = "ตัดเงินเดือน";break;
		case "4" : $wap_name = "ถูกสอบสวนทางวินัย";break;
		case "5" : $wap_name = "อื่นๆ";break;
	}

	?>
    <tr align="center" height="20" valign="top">
    
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$wap_name?></td>
        <td align="center" class="text_td"><?=change_date_thai($row["WAP_DATE"])?></td>
        <?php if($_SESSION['USER_TYPE'] != 'chief') { ?>
    	<td align="center" class="text_td" valign="top">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_warn('<?=$id?>')"/>
		</td>
        <?php } ?>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td align="center" valign="top" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_warn('<?=$row["WAP_ID"]?>')"/>
        </td>
        <?php } ?>
    </tr>
    <div style="display:none">
    <div id="wap_id<?=$id?>"><?=$row["WAP_ID"]?></div>
    <div id="wap_type<?=$id?>"><?=$row["WAP_TYPE"]?></div>
    <div id="wap_date<?=$id?>"><?=change_date_thai($row["WAP_DATE"])?></div>
    <div id="wap_memo<?=$id?>"><?=$row["WAP_MEMO"]?></div>
    </div>
    <?
	$id++;
}
oci_free_statement($stid);
 	 ?>
    </table>
<br />
    <? } 
	
	$db->closedb($conn);	
	?>