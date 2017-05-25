<?
@session_start();
 	$fpath = '';
	include $fpath."../includes/connect.php";
	$numrow = $db->count_row(TB_SCHOLAR_CONTRACT_EX_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' ",$conn);
	if($numrow >0){
?>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
       
        <td width="5%"  class="text_tr">ครั้งที่</td>
        <td width="14%"  class="text_tr">วันที่</td>
        <td width="15%" class="text_tr">ถึงวันที่</td>
        <td width="30%"  class="text_tr">คำสั่ง/เลขที่สัญญา</td>
        <td width="24%"  class="text_tr">สั่ง ณ วันที่</td>
        <td width="10%"  class="text_tr">แก้ไข/แสดง</td>
        <td width="2%"  class="text_tr">ลบ</td>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_SCHOLAR_CONTRACT_EX_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY ID ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];

	?>
    <tr align="center" height="20" valign="top">
 
        <td align="center" class="text_td"><?=$id?></td>
        <td align="center" class="text_td text_data"><?=change_date_thai($row["EX_START_DATE"])?></td>
        <td align="center" class="text_td text_data"><?=change_date_thai($row["EX_END_DATE"])?></td>
        <td align="center" class="text_td text_data"><?  echo $row["EX_ORDER_NO"]." ที่ ".$row["EX_AT"];?> <?=$row["EX_CONTRACT"]?></td>
        <td align="center" class="text_td text_data"><?=change_date_thai($row["EX_AT_DATE"])?></td>
        <td align="center" class="text_td" valign="top">&nbsp;
		<!--<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_sch_ex('<?=$row["ID"]?>')"/>-->
		</td>
        <td align="center" valign="top" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_sch_ex('<?=$row["ID"]?>','<?=$_SESSION["EMP_ID"]?>')"/>
        </td>
    </tr>
    <div style="display:none">
    <div id="id_ex<?=$id?>"><?=$row["ID"]?></div>
    <div id="ex_old_date1<?=$id?>"><?=change_date_thai($row["EX_OLD_DATE1"])?></div>
    <div id="ex_old_date2<?=$id?>"><?=change_date_thai($row["EX_OLD_DATE2"])?></div>
    <div id="ex_start_date<?=$id?>"><?=change_date_thai($row["EX_START_DATE"])?></div>
    <div id="ex_end_date<?=$id?>"><?=change_date_thai($row["EX_END_DATE"])?></div>
    <div id="ex_at_date<?=$id?>"><?=change_date_thai($row["EX_AT_DATE"])?></div>
    <div id="ex_order_no<?=$id?>"><?=$row["EX_ORDER_NO"]?></div>
    <div id="ex_contract<?=$id?>"><?=$row["EX_CONTRACT"]?></div>
    <div id="ex_at<?=$id?>"><?=$row["EX_AT"]?></div>
    </div>
    <?
	$id++;
}

 	 ?>
    </table>
    <br />
    <? } 
	
	//$db->closedb($conn);	
	
	?>