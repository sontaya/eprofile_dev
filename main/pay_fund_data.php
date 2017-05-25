<?
@session_start();
require_once("../includes/connect.php");
	$numrow = $db->count_row(TB_SDU_PAY_FUND_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."'",$conn);
	print($numrow);
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
        <td width="10%" class="text_tr">ครั้งที่ </td>
        <td width="10%" class="text_tr">ประเภทการเบิกจ่าย</td>
        <td width="10%" class="text_tr">จำนวนเงิน</td>
        <td width="10%" class="text_tr">วันที่เบิก</td>
        <td width="10%" class="text_tr">เลขที่บันทึก</td>
        <td width="20%" class="text_tr">หมายเหตุ</td>
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
   
    $sql = "SELECT * FROM  ".TB_SDU_PAY_FUND_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."'"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
	$s=0;
	
while (($row = oci_fetch_array($stid, OCI_BOTH))) {$s++
	//$no = $row["SCH_ORDER_NO"];

	?>
    <tr align="center" height="20" valign="top">
  		<td width="4%" class="text_td"><?=$s?></td>
        <td width="10%" class="text_td"><?=$row["NO_NUM"]?></td>
        <td width="10%" class="text_td"><?=$row["CATEGORY"]?></td>
        <td width="10%" class="text_td"><?=$row["MUNNY_NUM"]?></td>
        <td width="10%" class="text_td"><?=$row["DATE_OPAN"]?></td>
        <td width="10%" class="text_td"><?=$row["NO_RECORD"]?></td>
        <td width="10%" class="text_td"><?=$row["NOTE_C"]?></td>
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