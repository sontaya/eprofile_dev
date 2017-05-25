<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_ROYAL_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="95%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
    	
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="45%" class="text_tr">ชั้นของเครื่องราชฯ </td>
        <td width="12%" class="text_tr">ปี พ.ศ. ที่ได้รับ</td>
        <td width="26%" class="text_tr">ราชกิจจานุเบกษา</td>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><td width="11%" class="text_tr">แก้ไข/แสดง</td><?php } ?>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><td width="2%" class="text_tr">ลบ</td><?php } ?>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_ROYAL_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY ROY_YEAR DESC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
	
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];
if($row['ROY_NO1'] != "") $t1 = "เล่มที่ ".$row['ROY_NO1']." ตอนที่ ".$row['ROY_NO2']; else $t1 = "";
	?>
    <tr align="center" height="20" valign="top">
    
        <td align="center" class="text_td"><?=$id?></td>
        <td align="left" class="text_td text_data"><?=$row["ROY_NAME"]?></td>
        <td align="center" class="text_td"><?=$row["ROY_YEAR"]?></td>
        <td align="center" class="text_td"><?=$t1?></td>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
    	<td align="center" class="text_td" valign="top">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_royal('<?=$id?>')"/>
		</td>
        <?php } ?>
        <?php if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
        <td align="center" valign="top" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_royal('<?=$row["ROY_ID"]?>')"/>
        </td>
        <?php } ?>
    </tr>
    <div style="display:none">
    <div id="roy_id<?=$id?>"><?=$row["ROY_ID"]?></div>
    <div id="roy_name<?=$id?>"><?=$row["ROY_NAME"]?></div>
    <div id="roy_year<?=$id?>"><?=$row["ROY_YEAR"]?></div>
    <div id="roy_no1<?=$id?>"><?=$row["ROY_NO1"]?></div>
    <div id="roy_no2<?=$id?>"><?=$row["ROY_NO2"]?></div>
    <div id="roy_own<?=$id?>"><?=$row["ROY_OWN"]?></div>
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