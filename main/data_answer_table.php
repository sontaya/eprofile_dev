
<?
@session_start();
$emp_id = $_SESSION["EMP_ID"];
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_SDU_DATA_ANSWER_TAB,"",$conn);

	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}

	if($numrow >0){
?>
<script src="../js/da_data.js?Math.random()" type="text/javascript"></script>
<script src="../js/vtip.js" type="text/javascript"></script>
<table width="100%"  border="0" align="center"  bgcolor="#e9e9e9" >
   
    <tr align="center"  class="text_th">
        <!--<td width="15%" class="text_tr">คําสั่ง</td> -->
		<td class="text_tr">ปีงบประมาณ</td>
        <td colspan="3" class="text_tr">ช่วงเวลาการประเมิน </td>
        <td class="text_tr">ดูรายละเอียด</td>
    </tr>
    <?
    $sql = "SELECT * FROM  SDU_RAISE_SALARY WHERE EMP_ID='".$emp_id."' ORDER BY ASSESSMENT_YEAR1 DESC";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
    $st=0;
while (($row = oci_fetch_array($stid, OCI_BOTH))) { $st++;
	//$no = $row["SCH_ORDER_NO"];
	?>
     <tr align="center" height="20" valign="top" class="text_td">
        <td class="text_tr"> <?= $row["ASSESSMENT_YEAR1"]; ?> </td>
        <td class="text_tr">01/10/<?= $row["ASSESSMENT_YEAR1"]-1; ?></td>
        <td class="text_tr">ถึง</th>
        <td class="text_tr">30/09/<?=$row["ASSESSMENT_YEAR1"]?></td>
        <td class="text_tr"><img src="images/folder.jpg" width="27"/></td>
    </tr>
    <div style="display:none">

        <div id="da_id<?=$id?>"><?=$row["DA_ID"]?></div>
        
        <div id="da_order_no<?=$id?>"><?=$row["DA_ORDER_NO"]?></div>
        <div id="da_at<?=$id?>"><?=$row["DA_AT"]?></div>
        <div id="da_at_date<?=$id?>"><?= change_date_thai($row["DA_AT_DATE"])?></div>

        <div id="type_munny<?=$id?>"><?=$row["TYPE_MUNNY"]?></div>
        <div id="location_munny<?=$id?>"><?=$row["LOCATION_MUNNY"]?></div>
        <div id="munny_da<?=$id?>"><?=$row["MUNNY_DA"]?></div>

        <div id="start_dates<?=$id?>"><?= change_date_thai($row["START_DATES"])?></div>
        <div id="end_dates<?=$id?>"><?= change_date_thai($row["END_DATES"])?></div>
        <div id="start_ck<?=$id?>"><?=$row["START_CK"]?></div>
        <div id="da_note<?=$id?>"><?=$row["DA_NOTE"]?></div>
    </div>
   
    <?
	$id++;
}
oci_free_statement($stid);
 	 ?>
    </table>
<br />
    <? }

	//$db->closedb($conn);
	?>
