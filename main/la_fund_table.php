<?
@session_start();
$fpath = '';
include $fpath . "../includes/connect.php";
$numrow = $db->count_row(TB_SDU_LA_TAB, " WHERE  EMP_ID = '" . $_SESSION["EMP_ID"] . "'", $conn);

if ($numrow == 0) {
   echo "<script> not_data(); </script> <div id='note_data'></div>";
}

if ($numrow > 0) {
   ?>
   <script src="../js/la_data.js" type="text/javascript"></script>
   <script src="../js/vtip.js" type="text/javascript"></script>
   <table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
      <tr align="center"  class="text_th">
        <td width="4%" class="text_tr">ลำดับ</td>
        <td width="10%" class="text_tr">ประเภทการลา </td>
        <td width="10%" class="text_tr">วันเริ่มต้น </td>
        <td width="10%" class="text_tr">วันที่สิ้นสุด</td>
        <td width="10%" class="text_tr">วันที่กลับเข้าปฏิบัติหน้าที่</td>
         <td width="10%"  class="text_tr">แก้ไข/แสดง</td>
         <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
            <td width="2%"  class="text_tr">ลบ</td>
         <?php } ?>
      </tr>
      <?
	  
      $sql = "SELECT * FROM  " . TB_SDU_LA_TAB . "  WHERE  EMP_ID= '" . $_SESSION["EMP_ID"] . "' ORDER BY LA_ID DESC";
      $stid = oci_parse($conn, $sql);
      oci_execute($stid);
      $id = 1;
	  $s=0;
      while (($row = oci_fetch_array($stid, OCI_BOTH))) {$s++;
         //$no = $row["SCH_ORDER_NO"];
         ?>
         <tr align="center" height="20" valign="top">

            <td width="4%" class="text_td"><?=$s?></td>
            <td width="10%" class="text_td">
                <? if($row["STOP_TYPE"]=="1"){ echo "ลาทำวิทยานิพนธ์"; } if($row["STOP_TYPE"]=="2"){ echo "วิจัย"; } if($row["STOP_TYPE"]=="3"){ echo "ศึกษาอบรม"; } if($row["STOP_TYPE"]=="4"){ echo "ศึกษาดูงาน"; } ?>
             </td>
            <td width="10%" class="text_td"><?=change_date_thai($row["LA_DATE_START"])?></td>
            <td width="10%" class="text_td"><?=change_date_thai($row["LA_END_START"])?></td>
            <td width="10%" class="text_td"><?=change_date_thai($row["APPROVE_END_DATE"])?></td>
            <td align="center" class="text_td" valign="top">
               <img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_la('<?= $id ?>')"/>
            </td>

            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
               <td align="center" valign="top" class="text_td">
               <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_la('<?=$row["LA_ID"]?>')"/>
               </td>
            <?php } ?>
         </tr>
         <div style="display:none">
            <div id="la_date_start<?=$id?>"><?=change_date_thai($row["LA_DATE_START"])?></div>
            <div id="la_end_start<?=$id?>"><?=change_date_thai($row["LA_END_START"])?></div>
            <div id="approve_date<?=$id?>"><?=change_date_thai($row["APPROVE_DATE"])?></div>
            <div id="la_order_no1<?=$id?>"><?=$row["LA_ORDER_NO1"]?></div>
            
            <div id="la_at1<?=$id?>"><?=$row["LA_AT1"]?></div>
            <div id="la_at_date1<?=$id?>"><?=change_date_thai($row["LA_AT_DATE1"])?></div>
            <div id="la_order_no2<?=$id?>"><?=$row["LA_ORDER_NO2"]?></div>
            <div id="la_at2<?=$id?>"><?=$row["LA_AT2"]?></div>
            
            <div id="la_at_date2<?=$id?>"><?=change_date_thai($row["LA_AT_DATE2"])?></div>
            <div id="approve_end_date<?=$id?>"><?=change_date_thai($row["APPROVE_END_DATE"])?></div>
            <div id="la_order_no3<?=$id?>"><?=$row["LA_ORDER_NO3"]?></div>
            <div id="la_at3<?=$id?>"><?=$row["LA_AT3"]?></div>
            
            <div id="la_at_date3<?=$id?>"><?=change_date_thai($row["LA_AT_DATE3"])?></div>
            <div id="la_order_no4<?=$id?>"><?=$row["LA_ORDER_NO4"]?></div>
            <div id="la_at4<?=$id?>"><?=$row["LA_AT4"]?></div>
            <div id="la_at_date4<?=$id?>"><?=change_date_thai($row["LA_AT_DATE4"])?></div>
            <div id="stop_type<?=$id?>"><?=$row["STOP_TYPE"]?></div>
            
            <div id="id_la<?=$id?>"><?=$row["LA_ID"]?></div>
         </div>
         <?
         $id++;
      }
      oci_free_statement($stid);
      ?>
   </table>
   <br />
<?
 }

//$db->closedb($conn);
?>