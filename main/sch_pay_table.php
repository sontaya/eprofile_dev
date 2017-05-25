<?
@session_start();
 	$fpath = '';
	include $fpath."../includes/connect.php";
	$numrow = $db->count_row(TB_SCH_PAY_BACK_TAB," WHERE  EMP_ID = '".$_SESSION["EMP_ID"]."' ",$conn);
	if($numrow >0){
?>
<table width="80%"  border="0" align="center"  bgcolor="#e9e9e9" >
    <tr align="center"  class="text_th">
       
        <td width="5%"  class="text_tr">ลำดับ</td>
        <td width="28%"  class="text_tr">คำสั่ง</td>
        <td width="51%"  class="text_tr">ประเภทการใช้คืนทุน</td>
        <td width="12%"  class="text_tr">แก้ไข/แสดง</td>
        <td width="4%"  class="text_tr">ลบ</td>
    </tr>
    <?
   
    $sql = "SELECT * FROM  ".TB_SCH_PAY_BACK_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY PAY_REF ASC"; 
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$id = 1;
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	//$no = $row["SCH_ORDER_NO"];
	$sql2=  "SELECT * FROM ".TB_SCHOLAR_TAB." WHERE SCH_ID = '".$row["PAY_REF"]."' ";
	$stid2 = oci_parse($conn, $sql2 );
	oci_execute($stid2);
	$row2 =  oci_fetch_array($stid2, OCI_BOTH);
	?>
    <tr align="center" height="20" valign="top">
    	
      <td align="center" class="text_td"><?=$id?></td>
        <td align="center" class="text_td text_data"><? echo $row2["SCH_ORDER_NO"]." ที่ ".$row2["SCH_AT"];?></td>
        <td align="center" class="text_td text_data"><?=get_pay_type($row["PAY_TYPE"])?></td>
        <td align="center" class="text_td" valign="top">
		<img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" alt="Edit" onclick="edit_sch_pay('<?=$id?>','<?=$row["PAY_TYPE"]?>')"/>
		</td>
        <td align="center" valign="top" class="text_td">
		<img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" alt="Delete" onclick="del_sch_pay('<?=$row["PAY_REF"]?>','<?=$_SESSION["EMP_ID"]?>')"/>
        </td>
    </tr>
    <div style="display:none">
    <div id="pay_ref<?=$id?>"><?=$row["PAY_REF"]?></div>
    <div id="pay_type<?=$id?>"><?=$row["PAY_TYPE"]?></div>
    <div id="scholar1<?=$id?>"><?=$row["SCHOLAR1"]?></div>
    <div id="date1<?=$id?>"><?=change_date_thai($row["DATE1"])?></div>
    <div id="date2<?=$id?>"><?=change_date_thai($row["DATE2"])?></div>
    <div id="date_start_work1<?=$id?>"><?=change_date_thai($row["DATE_START_WORK1"])?></div>
    <div id="date_start_pay1<?=$id?>"><?=change_date_thai($row["DATE_START_PAY1"])?></div>
    <div id="countdate1<?=$id?>"><?=$row["COUNTDATE1"]?></div>
    <div id="multiply1<?=$id?>"><?=$row["MULTIPLY1"]?></div>
    <div id="days1<?=$id?>"><?=$row["DAYS1"]?></div>
    <div id="scholar2<?=$id?>"><?=$row["SCHOLAR2"]?></div>
    <div id="money2<?=$id?>"><?=$row["MONEY2"]?></div>
    <div id="mp<?=$id?>"><?=$row["MP"]?></div>
    <div id="multiply2<?=$id?>"><?=$row["MULTIPLY2"]?></div>
    <div id="tw<?=$id?>"><?=$row["TW"]?></div>
    <div id="result2<?=$id?>"><?=$row["RESULT2"]?></div>
    <div id="scholar3<?=$id?>"><?=$row["SCHOLAR3"]?></div>
    <div id="money3<?=$id?>"><?=$row["MONEY3"]?></div>
    <div id="date3<?=$id?>"><?=change_date_thai($row["DATE3"])?></div>
    <div id="date4<?=$id?>"><?=change_date_thai($row["DATE4"])?></div>
    <div id="date_start_work3<?=$id?>"><?=change_date_thai($row["DATE_START_WORK3"])?></div>
    <div id="date_start_pay3<?=$id?>"><?=change_date_thai($row["DATE_START_PAY3"])?></div>
    <div id="count_days_2<?=$id?>"><?=$row["COUNT_DAYS_2"]?></div>
    <div id="mch3<?=$id?>"><?=$row["MCH3"]?></div>
    <div id="ddays<?=$id?>"><?=$row["DDAYS"]?></div>
    <div id="bpd<?=$id?>"><?=$row["BPD"]?></div>
    <div id="date5<?=$id?>"><?=change_date_thai($row["DATE5"])?></div>
    <div id="date6<?=$id?>"><?=change_date_thai($row["DATE6"])?></div>
    <div id="count_days_3<?=$id?>"><?=$row["COUNT_DAYS_3"]?></div>
    <div id="remain_days<?=$id?>"><?=$row["REMAIN_DAYS"]?></div>
    <div id="remain_money<?=$id?>"><?=$row["REMAIN_MONEY"]?></div>
    <div id="mch4<?=$id?>"><?=$row["MCH4"]?></div>
    <div id="ttfee<?=$id?>"><?=$row["TTFEE"]?></div>
    <div id="grand_total<?=$id?>"><?=$row["GRAND_TOTAL"]?></div>
    </div>
    <?
	$id++;
}

 	 ?>
    </table>
    <br />
    <? } 
	
	//$db->closedb();	
	
	?>