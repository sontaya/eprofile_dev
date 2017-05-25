<?
@session_start();
$fpath = '';
include $fpath . "../includes/connect.php";
$numrow = $db->count_row(TB_SDU_PAY_TAB, " WHERE  EMP_ID = '" . $_SESSION["EMP_ID"] . "'", $conn);

if ($numrow == 0) {
   echo "<script> not_data(); </script> <div id='note_data'></div>";
}

if ($numrow > 0) {
   ?>
   <script src="../js/pay_n_data.js" type="text/javascript"></script>
   <script src="../js/vtip.js" type="text/javascript"></script>
   <table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
      <tr align="center"  class="text_th">
        <td width="10%" class="text_tr">ลำดับ</td>
		<td width="10%" class="text_tr">เลขที่สัญญา</td>
        <td width="10%" class="text_tr">ครั้งที่ </td>
        <td width="10%" class="text_tr">ประเภทการเบิกจ่าย</td>
        <td width="10%" class="text_tr">จำนวนเงิน</td>
        <td width="10%" class="text_tr">วันที่เบิก</td>
        <td width="10%" class="text_tr">เลขที่บันทึก</td>
        <td width="10%" class="text_tr">เอกสารหลักฐาน</td>
        <!--<td width="20%" class="text_tr">จำนวนเงินคงเหลือ</td>-->
         <td width="10%"  class="text_tr">แก้ไข/แสดง</td>
         <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
            <td width="10%"  class="text_tr">ลบ</td>
         <?php } ?>
      </tr>
      <?
	  
      //$sqlw = "SELECT * FROM  " . TB_SDU_PAY_TAB . "  WHERE  EMP_ID= '" . $_SESSION["EMP_ID"] . "' ORDER BY NO_NUM ASC";
	  $sqlw="SELECT DISTINCT CT_NO FROM SDU_PAY_TAB WHERE EMP_ID='" . $_SESSION["EMP_ID"] ."'";
      $stidw = oci_parse($conn, $sqlw);
      oci_execute($stidw);
      $idd = 1;
	  $s=0;
      while (($roww = oci_fetch_array($stidw, OCI_BOTH))) {$s++;	
         //$no = $roww["SCH_ORDER_NO"];
         ?>
		    <?
	  
			  $sql = "SELECT * FROM  " . TB_SDU_PAY_TAB . "  WHERE  CT_NO= '" . $roww["CT_NO"] . "' ORDER BY NO_NUM ASC";
			  $stid = oci_parse($conn, $sql);
			  oci_execute($stid);
			  $id = 1;
			  $sw=0;
			  while (($row = oci_fetch_array($stid, OCI_BOTH))) {$sw++;
				 //$no = $row["SCH_ORDER_NO"];
             ?>
         <tr align="center" height="20" valign="top">

            <td class="text_td"><?=$sw?></td>
			<td class="text_td"><?=$row["CT_NO"]?></td>
            <td class="text_td"><?=$row["NO_NUM"]?></td>
            <td class="text_td"><?=$row["CATEGORY"]?></td>
            <td class="text_td"><?=number_format($row["MUNNY_NUM"] , 2 );?></td>
            <td class="text_td"><?=change_date_thai($row["DATE_OPAN"])?></td>
            <td class="text_td"><?=$row["NO_RECORD"]?></td>
            <td class="text_td"><? if($row["MUNNY_FILE"]){
			echo "<a href='files/fund_file/".$row["MUNNY_FILE"]."' target='_blank'><img src='../images/macosx100.png' width='25'></a>";
		}?></td>
            <!--<td width="10%" class="text_td"><? //$row["MUNNY_NUM"]?></td> -->
            <td align="center" class="text_td" valign="top">
               <img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_pay('<?= $id ?>')"/>
            </td>

            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
               <td align="center" valign="top" class="text_td">
               <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_pay('<?=$row["ID"]?>')"/>
               </td>
            <?php } ?>
         </tr>
		 
          <? 
			$sql_pay = "SELECT * FROM  " . TB_SDU_MUNNY_TAB . " WHERE EMP_ID = '" .$_SESSION["EMP_ID"]. "' and CT_NO='".$row["CT_NO"]."' ";
			$stid_pay = oci_parse($conn, $sql_pay);
			oci_execute($stid_pay);
			while ($row_pay = oci_fetch_array($stid_pay, OCI_BOTH)) {  
				 $cc=$row_pay["MUNNY_ALL"];
			} ?> 
            <? 
			$sql_pay2 = "SELECT SUM(MUNNY_NUM) as MUNNY_NUM FROM  " . TB_SDU_PAY_TAB . " WHERE EMP_ID = '" .$_SESSION["EMP_ID"]. "' and CT_NO='".$row["CT_NO"]."' ";
			$stid_pay2 = oci_parse($conn, $sql_pay2);
			oci_execute($stid_pay2);
			while ($row_pay2 = oci_fetch_array($stid_pay2, OCI_BOTH)) {  
				 $cc2=$row_pay2["MUNNY_NUM"];
			} ?> 
            <? $ee=$cc -$cc2; ?>
         <div style="display:none">
            <div id="no_num<?=$id?>"><?=$row["NO_NUM"]?></div>
            <div id="category<?=$id?>"><?=$row["CATEGORY"]?></div>
            <div id="munny_num<?=$id?>"><?=$row["MUNNY_NUM"]?></div>
            <div id="date_opan<?=$id?>"><?=change_date_thai($row["DATE_OPAN"])?></div>
            <div id="no_record<?=$id?>"><?=$row["NO_RECORD"]?></div>
            <div id="note_c<?=$id?>"><?=$row["NOTE_C"]?></div>
            <div id="wrk_id<?=$id?>"><?=$row["P_ID"]?></div>
            <div id="id_p<?=$id?>"><?=$row["ID"]?></div>
            <div id="contract_fund<?=$id?>"><?=$row["CT_NO"]?></div>
            <div id="num_munny<?=$id?>"><?=number_format( $ee , 2 );?></div>
            <div id="munny_num2<?=$id?>"><?=number_format( $ee , 2 );?></div>
            <div id="pay_munny_file<?=$id?>"><?=$row["MUNNY_FILE"]?></div>
         </div>
         <?
		 $onn=$row["CT_NO"];
		 $qty += $row['MUNNY_NUM'];
         $id++;
		 //$qty += $row['MUNNY_NUM'];
		 //echo $qty;
      }
      oci_free_statement($stid);
      ?>
	  <tr>
	      <?
		  //echo $onn;
		  //echo $qty ;
		  $sqlsum="SELECT * FROM SDU_MUNNY_TAB WHERE CT_NO ='".$onn."'";
          $stidsum = oci_parse($conn, $sqlsum);
          oci_execute($stidsum); 
          while (($rowsum = oci_fetch_array($stidsum, OCI_BOTH))) {
		   $sum_m=$rowsum["NB_MONEY"]+$rowsum["MONEY_ONE"]+$rowsum["MONEY_TWO"]+$rowsum["MONEY_THEE"];
		  }	
		    //echo $sum_m;
			$sum_v= $sum_m - $qty;
		  ?>
			<td width="4%" class="text_td" colspan="9" align="right" border="0">จำนวนเงินคงเหลือ : &nbsp;&nbsp;<?=number_format( $sum_v , 2 );?>&nbsp;&nbspบาท<br><br></td>
           
	   </tr> 
	   <?
         $idd++;
      }
      oci_free_statement($stidw);
      ?>
	  <!--<tr>
			<td width="4%" class="text_td" colspan="8">จำนวนเงินคงเหลือ : &nbsp;&nbsp;</td>
           
	   </tr> -->
   </table>
   <br />
<?
 }

//$db->closedb($conn);
?>