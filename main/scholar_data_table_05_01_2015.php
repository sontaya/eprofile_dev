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
    <script src="../js/sch_data.js" type="text/javascript"></script>
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
	  
	  $sql="SELECT * FROM ".TB_REF_ISCED;
	  $stid = oci_parse($conn, $sql);
      oci_execute($stid);
      $id = 1;
      while (($row = oci_fetch_array($stid, OCI_BOTH))) {
	  	$isced[$row["ISCED_ID"]]=$row;
	  }
	  
      $sql = "SELECT * FROM  " . TB_SCHOLAR_TAB . "  WHERE  EMP_ID= '" . $_SESSION["EMP_ID"] . "' ORDER BY SCH_ORDER_NO ASC";
      $stid = oci_parse($conn, $sql);
      oci_execute($stid);
      $id = 1;
      while (($row = oci_fetch_array($stid, OCI_BOTH))) {
         //$no = $row["SCH_ORDER_NO"];
         ?>
         <tr align="center" height="20" valign="top">

            <td align="center" class="text_td"><?= $id ?></td>
            <td align="left" class="text_td text_data"><?= get_edu_level($row["SCH_EDU_LEVEL"])?></td>
            <td align="left" class="text_td text_data"><?= $row["SCH_COURSE"]?></td>
            <td align="left" class="text_td text_data">
			<?
			$numrow = $db->count_row(UOC_REF_PROGRAM, " WHERE  PROGRAM_ID_OLD = '" . $row["SCH_MAJOR"] . "'", $conn);
			if($numrow!=0){
            ?>
			<? 
				$sql="SELECT * FROM UOC_REF_PROGRAM WHERE PROGRAM_ID_OLD = '".$row["SCH_MAJOR"]."'";
				$stid = oci_parse($conn, $sql);
				oci_execute($stid);
				while ($rowd = oci_fetch_array($stid, OCI_BOTH)) {
				echo $rowd["PROGRAM_NAME"];
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
		  /*$sql_sch_major = "SELECT * FROM  " . TB_REF_ISCED . "  WHERE ISCED_ID = '" . $row["SCH_MAJOR"] . "' ";
		 // echo $sql_sch_major;
		  $stid_sch_major = oci_parse($conn, $sql_sch_major);
		  oci_execute($stid_sch_major);
		  while ($row_sch_major = oci_fetch_array($stid_sch_major, OCI_BOTH)) {
			 echo $dd=$row_sch_major["ISCED_NAME_TH"];
		  }*/
		 ?>
           <? 
				$sql="SELECT * FROM UOC_REF_PROGRAM WHERE PROGRAM_ID_OLD = '".$row["SCH_MAJOR"]."'";
				$stid = oci_parse($conn, $sql);
				oci_execute($stid);
				while ($rowd = oci_fetch_array($stid, OCI_BOTH)) { ?>
				<div id="sch_major_name<?= $id ?>"><?= $rowd["PROGRAM_NAME"] ?></div>
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
           <!-- <div id="sch_return_date<?= $id ?>"><?= change_date_thai($row["SCH_RETURN_DATE"]); ?></div>
            <div id="sch_pay_date<?= $id ?>"><?= change_date_thai($row["SCH_PAY_DATE"]); ?></div>-->
            <div id="sch_payback_type<?= $id ?>"><?= $row["SCH_PAYBACK_TYPE"] ?></div>
            <div id="sch_payback_day<?= $id ?>"><?= $row["SCH_PAYBACK_DAY"] ?></div>
            <div id="sch_payback_money<?= $id ?>"><?= number_format($row["SCH_PAYBACK_MONEY"]) ?></div>
            <div id="sch_memo<?= $id ?>"><?= $row["SCH_MEMO"] ?></div>
            
            <div id="coun_try<?= $id ?>"><?= $row["COUN_TRY"] ?></div> 
            <div id="sch_at2<?= $id ?>"><?= $row["SCH_AT2"] ?></div>
            <div id="sch_at_date2<?= $id ?>"><?= change_date_thai($row["SCH_AT_DATE2"]) ?></div>
            <div id="sch_major2<?= $id ?>"><?= $row["SCH_MAJOR2"] ?></div>
            <div id="fund_money<?= $id ?>"><?= $row["FUND_MONEY"] ?></div>
             
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