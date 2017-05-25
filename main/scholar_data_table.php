<?
@session_start();
$fpath = '';
include $fpath . "../includes/connect.php";
$numrow = $db->count_row(TB_SCHOLAR_TAB, " WHERE  EMP_ID = '" . $_SESSION["EMP_ID"] . "'", $conn);

if ($numrow == 0) {
   echo "<script> not_data(); </script> <div id='note_data'></div>";
}

if ($numrow > 0) {
   ?>
    <script src="../js/sch_data2.js?Math.random()" type="text/javascript"></script>
   <script src="../js/vtip.js" type="text/javascript"></script>
   <table width="98%"  border="0" align="center"  bgcolor="#e9e9e9" >
      <tr align="center"  class="text_th">
         <td width="4%"  class="text_tr">ลำดับ</td>
         <td width="17%"  class="text_tr">ระดับการศึกษา</td>
         <td width="21%"  class="text_tr">หลักสูตร</td>
         <td width="20%" class="text_tr">สาขาวิชา</td>
         <td width="26%"  class="text_tr">มหาวิทยาลัย</td>
         <td width="10%"  class="text_tr">แก้ไข/แสดง</td>
         <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
            <td width="2%"  class="text_tr">ลบ</td>
         <?php } ?>
      </tr>
      <?

	  /*$sql="SELECT * FROM ".TB_REF_ISCED;
	  $stid = oci_parse($conn, $sql);
      oci_execute($stid);
      $id = 1;
      while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	  	$isced[$row["ISCED_ID"]]=$row;
	  } */

      $sql = "SELECT * FROM  " . TB_SCHOLAR_TAB . "  WHERE  EMP_ID= '" . $_SESSION["EMP_ID"]."'";
      $stid = oci_parse($conn, $sql);
      oci_execute($stid);
      $id = 1;
      while ($row = oci_fetch_array($stid, OCI_BOTH)) {
         //$no = $row["SCH_ORDER_NO"];
         ?>
         <tr align="center" height="20" valign="top">

            <td align="center" class="text_td"><?= $id ?></td>
			<?
				if($row["SCH_EDU_LEVEL"]!='3'){
					$sql1="SELECT * FROM SDU_REF_LEV WHERE LEV_ID = '".$row["SCH_EDU_LEVEL"]."'";
					$stid1 = oci_parse($conn, $sql1);
					oci_execute($stid1);
					while ($rowd1 = oci_fetch_array($stid1, OCI_BOTH)) {
					  $lev_id=$rowd1["LEV_ID"];
					  $lev_name=$rowd1["LEV_NAME_TH"]."(".$rowd1["LEV_NAME_ENG"].")";
					}
				}else{
					$lev_name="ปริญญาโท - ปริญญาเอก";
				}
			 ?>
            <td align="left" class="text_td text_data"><?=$lev_name?></td>
            <td align="left" class="text_td text_data"><?= $row["SCH_COURSE"]?></td>
            <td align="left" class="text_td text_data">
			<?
			$numrow = $db->count_row(UOC_REF_PROGRAM, " WHERE  PROGRAM_ID_OLD = '" . $row["SCH_MAJOR"] . "'", $conn);
			if($numrow!=0){
            ?>
			<?
				$sql1="SELECT * FROM SDU_REF_PROGRAM WHERE PROGRAM_ID = '".$row["SCH_MAJOR"]."'";
				$stid1 = oci_parse($conn, $sql1);
				oci_execute($stid1);
				while ($rowd1 = oci_fetch_array($stid1, OCI_BOTH)) {
				  $maj_id=$rowd1["PROGRAM_ID"];
				  $maj=$rowd1["PROGRAM_NAME"];
				}
				if($maj_id=="9991"){
					echo $row["SCH_MAJOR2"];
				}else{
					echo $maj;
				}
			 ?>
             <? }else{ echo $row["FUND_MONEY"]; }?></td>
            <td align="left" class="text_td text_data"><?= $row["SCH_UNI"] ?></td>

            <td align="center" class="text_td" valign="top">
               <img src="../images/b_edit.png" height="15" border="0" style="cursor:pointer" title="Edit" class="vtip" onclick="edit_sch('<?= $id ?>')"/>
            </td>

            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?>
               <td align="center" valign="top" class="text_td">
                  <img src="../images/b_del.png" height="15" border="0" style="cursor:pointer" title="Delete" class="vtip" onclick="del_sch('<?= $row["SCH_ID"] ?>')"/>
               </td>
            <?php } ?>
         </tr>

         <div style="display:none">
          <?
				$sql2="SELECT * FROM SDU_REF_PROGRAM WHERE PROGRAM_ID = '".$row["SCH_MAJOR"]."'";
				$stid2 = oci_parse($conn, $sql2);
				oci_execute($stid2);
				while ($rowd2 = oci_fetch_array($stid2, OCI_BOTH)) { ?>
				<div id="sch_major_name<?= $id ?>"><?= $rowd2["PROGRAM_NAME"] ?></div>
				<? }
			 ?>
             <div id="sch_major<?= $id ?>"><?= $row["SCH_MAJOR"] ?></div>
            <div id="sch_order_no2<?= $id ?>"><?= $row["SCH_ORDER_NO2"] ?></div>
            <div id="sch_id<?= $id ?>"><?= $row["SCH_ID"] ?></div>
            <div id="sch_order_no<?= $id ?>"><?= $row["SCH_ORDER_NO"] ?></div>
            <div id="sch_at<?= $id ?>"><?= $row["SCH_AT"] ?></div>
            <div id="sch_at_date<?= $id ?>"><?= change_date_thai($row["SCH_AT_DATE"]); ?></div>
            <div id="sch_contract<?= $id ?>"><?= $row["SCH_CONTRACT"] ?></div>
            <div id="sch_edu_level<?= $id ?>"><?= $row["SCH_EDU_LEVEL"] ?></div>
            <div id="sch_type<?= $id ?>"><?= $row["SCH_TYPE"] ?></div>
            <div id="sch_long<?= $id ?>"><?= $row["SCH_LONG"] ?></div>
            <div id="sch_course<?= $id ?>"><?= $row["SCH_COURSE"] ?></div>
            <div id="sch_course_short<?= $id ?>"><?= $row["SCH_COURSE_SHORT"] ?></div>



            <div id="sch_major_oth<?= $id ?>"><?= $row["SCH_MAJOR_OTH"] ?></div>
            <div id="sch_uni<?= $id ?>"><?= $row["SCH_UNI"] ?></div>
            <div id="sch_country<?= $id ?>"><?= $row["SCH_COUNTRY"] ?></div>
            <div id="sch_money<?= $id ?>"><?= number_format($row["SCH_MONEY"]) ?></div>
            <div id="sch_money1<?= $id ?>"><?= number_format($row["SCH_MONEY1"]) ?></div>
            <div id="sch_money2<?= $id ?>"><?= number_format($row["SCH_MONEY2"]) ?></div>
            <div id="sch_money3<?= $id ?>"><?= number_format($row["SCH_MONEY3"]) ?></div>
            <div id="sch_money_date<?= $id ?>"><?= change_date_thai($row["SCH_MONEY_DATE"]) ?></div>
            <div id="sch_money_date1<?= $id ?>"><?= change_date_thai($row["SCH_MONEY_DATE1"]) ?></div>
            <div id="sch_money_date2<?= $id ?>"><?= change_date_thai($row["SCH_MONEY_DATE2"]) ?></div>
            <div id="sch_money_date3<?= $id ?>"><?= change_date_thai($row["SCH_MONEY_DATE3"]) ?></div>
            <div id="sch_source<?= $id ?>"><?= $row["SCH_SOURCE"] ?></div>
            <div id="sch_start_date<?= $id ?>"><?= change_date_thai($row["SCH_START_DATE"]); ?></div>
            <div id="sch_end_date<?= $id ?>"><?= change_date_thai($row["SCH_END_DATE"]); ?></div>
            <div id="sch_edu_start_date<?= $id ?>"><?= change_date_thai($row["SCH_EDU_START_DATE"]); ?></div>
            <div id="sch_edu_end_date<?= $id ?>"><?= change_date_thai($row["SCH_EDU_END_DATE"]); ?></div>
            <div id="sch_start_order_on<?= $id ?>"><?=$row["SCH_START_ORDER_ON"]; ?></div>
            <div id="sch_start_at_on<?= $id ?>"><?=$row["SCH_START_AT_ON"]; ?></div>
            <div id="sch_start_at_date<?= $id ?>"><?= change_date_thai($row["SCH_START_AT_DATE"]); ?></div>
           <!-- <div id="sch_return_date<?= $id ?>"><?= change_date_thai($row["SCH_RETURN_DATE"]); ?></div>
            <div id="sch_pay_date<?= $id ?>"><?= change_date_thai($row["SCH_PAY_DATE"]); ?></div>-->
            <div id="sch_payback_type<?= $id ?>"><?= $row["SCH_PAYBACK_TYPE"] ?></div>
            <div id="sch_payback_day<?= $id ?>"><?= $row["SCH_PAYBACK_DAY"] ?></div>
            <div id="sch_payback_money<?= $id ?>"><?= number_format($row["SCH_PAYBACK_MONEY"]) ?></div>
            <div id="sch_memo<?= $id ?>"><?= $row["SCH_MEMO"] ?></div>

            <div id="coun_try<?= $id ?>"><?= $row["COUN_TRY"] ?></div>
            <div id="sch_at2<?= $id ?>"><?= $row["SCH_AT2"] ?></div>
            <div id="sch_at_date5<?= $id ?>"><?= change_date_thai($row["SCH_AT_DATE2"]) ?></div>
            <div id="sch_major2<?= $id ?>"><?= $row["SCH_MAJOR2"] ?></div>
            <div id="fund_money<?= $id ?>"><?= $row["FUND_MONEY"] ?></div>
			<div id="sch_start_new<?= $id ?>"><?= change_date_thai($row["SCH_START_NEW"]) ?></div>

            <div id="status_education<?= $id ?>"><?= $row["STATUS_EDUCATION"] ?></div>
            <div id="old_munny<?= $id ?>"><?= $row["OLD_MUNNY"] ?></div>
            <div id="new_munny<?= $id ?>"><?= $row["NEW_MUNNY"] ?></div>

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
