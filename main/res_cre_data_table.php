<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_RESEARCH_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
    	
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="27%" class="text_tr">ประเภททุน</td>
        <td width="57%" class="text_tr">ชื่อผลงาน</td>
        <td width="10%" class="text_tr">แก้ไข/แสดง</td>
        <td width="2%" class="text_tr">ลบ</td>
        
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_RESEARCH_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY REC_ORDER_NO ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
	
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];

	?>
    <tr align="center" height="20" valign="top">
    	
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><? if($row["REC_TYPE"] == "1"){echo "ภายในองค์กร";}else{echo "ภายนอกองค์กร";}?></td>
        <td align="left" class="text_td text_data"><?=$row["REC_NAME"]?></td>
        <td align="center" class="text_td" valign="middle">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_res('<?=$id?>')"/>
		</td>
        <td align="center" valign="middle" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_res('<?=$row["REC_ID"]?>')"/>
        </td>
    </tr>
    <div style="display:none">
    <div id="rec_order_no<?=$id?>"><?=$row["REC_ORDER_NO"]?></div>
    <div id="rec_id<?=$id?>"><?=$row["REC_ID"]?></div>
    <div id="rec_at<?=$id?>"><?=$row["REC_AT"]?></div>
    <div id="rec_at_date<?=$id?>"><?=change_date_thai($row["REC_AT_DATE"]);?></div>
    <div id="rec_type<?=$id?>"><?=$row["REC_TYPE"]?></div>
    <div id="rec_year<?=$id?>"><?=$row["REC_YEAR"]?></div>
    <div id="rec_name<?=$id?>"><?=$row["REC_NAME"]?></div>
    <div id="rec_prices<?=$id?>"><?=number_format($row["REC_PRICES"])?></div>
    <div id="rec_source<?=$id?>"><?=$row["REC_SOURCE"]?></div>
    <div id="rec_start_date<?=$id?>"><?=change_date_thai($row["REC_START_DATE"]);?></div>
    <div id="rec_end_date<?=$id?>"><?=change_date_thai($row["REC_END_DATE"]);?></div>
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