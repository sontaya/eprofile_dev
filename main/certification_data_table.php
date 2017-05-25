<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_CERTIFICATION_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	if($numrow >0){
?>
<table width="70%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
    	<td width="13%" class="text_tr">แก้ไข/แสดง</td>
        <td width="7%" class="text_tr">ลำดับ</td>
        <td width="49%" class="text_tr">ชื่อใบรับรอง</td>
        <td width="28%" class="text_tr">หมดอายุวันที่</td>
        <td width="3%" class="text_tr">ลบ</td>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_CERTIFICATION_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY CER_ID ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
	
while (($row = oci_fetch_array($stid, OCI_BOTH))) {


	?>
    <tr align="center" height="20" valign="top">
    	<td align="center" class="text_td" valign="top">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_certification('<?=$id?>')"/>
		</td>
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["CER_NAME"]?></td>
        <td align="center" class="text_td"><?=change_date_thai($row["CER_EXPIRE"])?></td>
        <td align="center" valign="top" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_certification('<?=$row["CER_ID"]?>')"/>
        </td>
    </tr>
    <div style="display:none">
    <div id="cer_id<?=$id?>"><?=$row["CER_ID"]?></div>
    <div id="cer_name<?=$id?>"><?=$row["CER_NAME"]?></div>
    <div id="cer_from<?=$id?>"><?=$row["CER_FROM"]?></div>
    <div id="cer_expire<?=$id?>"><?=change_date_thai($row["CER_EXPIRE"])?></div>
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