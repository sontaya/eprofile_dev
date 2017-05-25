<?
@session_start();
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_SDU_MUNNY_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	
	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}
	
	if($numrow >0){
?>
<script src="../js/money_fund_data.js" type="text/javascript"></script>
<script src="../js/vtip.js" type="text/javascript"></script>

<table width="100%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
   
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="10%" class="text_tr">เเหล่งทุน</td>
        <td width="10%" class="text_tr">เลขที่สัญญา</td>
        <td width="10%" class="text_tr">วันเริ่มต้น</td>
        <td width="10%" class="text_tr">วันสิ้นสุด</td>
        <td width="10%" class="text_tr">เงินที่ได้รับ</td>
        <td width="20%" class="text_tr">หมายเหตุ</td>
        <td width="10%" class="text_tr">ขอขยายเงินทุน</td>
         <?php
	if($_SESSION['USER_TYPE'] != 'user') {
	?>
    	<td width="11%" class="text_tr">แก้ไข/แสดง</td>
    <?php
	}
	?>
         <?php
	if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') {
	?>
        <td width="5%" class="text_tr">ลบ</td>
    </tr>
    <?php
	}
	?>

    <?
   
    $sql = "SELECT * FROM  ".TB_SDU_MUNNY_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY M_ID ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
	$s=0;
	
while (($row = oci_fetch_array($stid, OCI_BOTH))) {$s++
	//$no = $row["SCH_ORDER_NO"];

	?>
    <tr align="center" height="20" valign="top">
  		<td width="4%" class="text_td"><?=$s?></td>
        <td width="20%" class="text_td" align="left"><? 
		if($row["CAPITAL"]!=""){
		if($row["CAPITAL"]=="1"){
			echo "ส่วนตัว";
		}
		if($row["CAPITAL"]=="2"){
			echo "มหาวิทยาลัย";
		}
		if($row["CAPITAL"]=="3"){
			echo "รัฐบาล";
		}
		if($row["CAPITAL"]=="4"){
			echo "อื่น ๆ";
		}
		}else{
			echo $row["MUNNY_FULL"];
		}
		?> 
        </td>
        <td width="10%" class="text_td"><?=$row["CT_NO"]?></td>
        <td width="10%" class="text_td"><?=change_date_thai($row["DATE_START"])?></td>
        <td width="10%" class="text_td"><?=change_date_thai($row["DATE_END"])?></td>
        <td width="10%" class="text_td"><?=number_format( $row["NB_MONEY"] , 2 );?></td>
        <td width="10%" class="text_td"><?=$row["NOTE"]?></td>
        <? $dd=$row["MONEY_ONE"]+$row["MONEY_TWO"]+$row["MONEY_THEE"]; ?>
        <td width="10%" class="text_td"><?=number_format( $dd , 2 );?></td>
          <?php
	if($_SESSION['USER_TYPE'] != 'user') {
	?>
    	<td align="center" class="text_td" valign="top">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_money_fund('<?=$id?>')"/>
		</td>
        <?php
	}
	?>
        <?php
	if($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') {
	?>
        <td align="center" valign="top" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_money_fund('<?=$row["M_ID"]?>')"/>
        </td>
        <?php
	}
	$qq=1;
	?>
    </tr>
    
    <div style="display:none">
    <div id="capital<?=$id?>"><?=$row["CAPITAL"]?></div>
    <div id="ct_no<?=$id?>"><?=$row["CT_NO"]?></div>
    <div id="date_start<?=$id?>"><?=change_date_thai($row["DATE_START"])?></div>
    <div id="date_end<?=$id?>"><?=change_date_thai($row["DATE_END"])?></div>
    <div id="nb_money<?=$id?>"><?=$row["NB_MONEY"]?></div>
    <div id="flag<?=$id?>"><?=$row["FLAG"]?></div>
    <div id="flag_date<?=$id?>"><?=change_date_thai($row["DATE_FLAG"])?></div>
    <div id="note<?=$id?>"><?=$row["NOTE"]?></div>
    <div id="money_one<?=$id?>"><?=$row["MONEY_ONE"]?></div>
    <div id="wb_one<?=$id?>"><?=$row["WB_ONE"]?></div>
    <div id="date_staer_wb_one<?=$id?>"><?=change_date_thai($row["DATE_STAER_WB_ONE"])?></div>
    <div id="money_two<?=$id?>"><?=$row["MONEY_TWO"]?></div>
    <div id="wb_two<?=$id?>"><?=$row["WB_TWO"]?></div>
    <div id="date_staer_wb_two<?=$id?>"><?=change_date_thai($row["DATE_STAER_WB_TWO"])?></div>
    <div id="money_thee<?=$id?>"><?=$row["MONEY_THEE"]?></div>
    <div id="wb_thee<?=$id?>"><?=$row["WB_THEE"]?></div>
    <div id="date_staer_wb_thee<?=$id?>"><?=change_date_thai($row["DATE_STAER_WB_THEE"])?></div>
    <div id="munny_full<?=$id?>"><?=$row["MUNNY_FULL"]?></div>
   
    <div id="wrk_id<?=$id?>"><?=$row["M_ID"]?></div>

    </div>
    <?
	$id++;
}
 	 ?>
    </table>
<br />
    <? } 
	
	$db->closedb($conn);	
	?>