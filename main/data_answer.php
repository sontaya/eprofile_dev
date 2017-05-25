<?
@session_start();
$emp_id = $_SESSION["EMP_ID"];
 	$fpath = '';
	require_once($fpath."../includes/connect.php");
	$numrow = $db->count_row(TB_SDU_FILE_MANU_TAB,"",$conn);

	if($numrow == 0){
		echo "<script> not_data(); </script> <div id='note_data'></div>";
	}

?>
<script src="../js/edit_by_user.js" type="text/javascript"></script>
<script src="../js/da_data.js?Math.random()" type="text/javascript"></script>
<script src="../js/vtip.js" type="text/javascript"></script>
<script src="../js/main.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">


function check_data_file(){
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("data_answer").submit();
}


</script>

<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
    <div id="da_list" align="center" class="data_details_list">
      <? include "data_answer_table.php";?>
    </div>
    <div align="center"  id="toggle_formf"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('data_answer','file_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
        <div id="data_form">
      <img src="../images/bg_d.png" style="margin-left:10px;" />
      <?
      $sql_raise="SELECT srs.*
FROM
    SDPERSON.SDU_RAISE_SALARY srs
WHERE
	EMP_ID = '".$emp_id."'";

	  $stid = oci_parse($conn, $sql_raise );
	  oci_execute($stid);
	  $row = oci_fetch_array($stid, OCI_BOTH);
	  if($row["EMP_ID"]){
	  ?><form id="data_answer" name="data_answer" method="post" action="data_answer_save.php" enctype="multipart/form-data" target="upload_target" >
      <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
            <td width="12%"><input type="hidden" id="emp_id" name="emp_id" value="<?=$row["EMP_ID"]?>"/><input type="hidden" id="assessment_year1" name="assessment_year1" value="<?= $row["ASSESSMENT_YEAR1"]; ?>"/></td>
        <tr>
          <td colspan="4"><table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
              <td height="25" colspan="6" align="center" ><strong>การประเมินผลการปฏิบัติงาน</strong></td>
              </tr>
            <tr>
              <td  height="25" align="center">รอบที่</td>
              <td colspan="3" align="center">ช่วงเวลาการประเมิน</td>
              <td align="center">คะแนน</td>
              <td align="center">ระดับ</td>
            </tr>
            <tr>
              <td height="25" align="center"><?= $row["EVALUATION_ROUND1"]; ?></td>
              <td colspan="3" align="center"> 
              		01/10/<?= $row["ASSESSMENT_YEAR1"]-1; ?> 
                    &nbsp;&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;&nbsp;
                    31/03/<?= $row["ASSESSMENT_YEAR1"]; ?>
              </td>
 
              <td align="center"><?=number_format($row["LEVEL_SCORE1"],2,'.','')?></td>
              <td align="center"><?=$row["RATING_ASSESSMENT1"]?></td>
            </tr>
            <tr>
              <td height="25" align="center"><?= $row["EVALUATION_ROUND2"]; ?></td>
              <td colspan="3" align="center"> 
				01/04/<?= $row["ASSESSMENT_YEAR1"]; ?>
               &nbsp;&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;&nbsp;
                30/09/<?= $row["ASSESSMENT_YEAR1"]; ?>
              </td>
              <td align="center"><?=number_format($row["LEVEL_SCORE2"],2,'.','')?></td>
              <td align="center"><?=$row["RATING_ASSESSMENT2"]?></td>
            </tr>
            <tr>
              <td height="25" colspan="4" align="center">คะแนนเฉลี่ย</td>
              <td align="center"><?=number_format($row["LEVEL_SCORE_AVG"],2,'.','')?></td>
              <td align="center"><?=$row["RATING_ASSESSMENT_AVG"]?></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="4"></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4"><table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
              <td height="25" colspan="6" align="center"><strong>การเลื่อนเงินเดือน</strong></td>
              </tr>
            <tr>
              <td height="50" align="center"><strong>เงินเดือนก่อนเลื่อน (บาท)</strong></td>
              <td align="center"><strong>เงินเดือนสูงสุดแต่ละประเภท (บาท)</strong></td>
              <td align="center"><strong>ร้อยละที่ได้เลื่อน (%)</strong></td>
              <td align="center"><strong>จำนวนเงินที่ได้เลื่อน (บาท)</strong></td>
              <td align="center"><strong>ค่าตอบแทนพิเศษ (บาท)</strong></td>
              <td align="center"><strong>เงินเดือนหลังเลื่อน (บาท)</strong></td>
            </tr>
            <tr>
              <td height="25" align="right"><?= number_format($row["SALARY_BEFORE"],2, '.', ',') ?>&nbsp;&nbsp;</td>
              <td align="right"><?= number_format($row["MONEY_PROMOTED"]) ?>&nbsp;&nbsp;</td>
              <td align="center"><?=$row["PERCENTAGE_DROP"]?></td>
              <td align="right"><?= number_format($row["SALARY_TRUE"],2, '.', ',') ?>&nbsp;&nbsp;</td>
              <td align="center"><?=$row["EXTAR_MONEY"]?></td>
              <td align="right"><?= number_format($row["SALARY01"],2, '.', ',') ?>&nbsp;&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4"><table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
              <td height="25" colspan="5" align="center"><strong>เอกสารอ้างอิง</strong></td>
              </tr>
            <tr>
              <td width="12%" height="25" align="center"><strong>คำสั่ง</strong></td>
              <td width="23%" align="center"><strong>เลขที่</strong></td>
              <td width="25%" align="center"><strong>มีผลตั้งแต่</strong></td>
              <td width="26%" align="center"><strong>สั่ง ณ วันที่</strong></td>
              <td width="14%" align="center"><strong>ไฟล์เอกสาร</strong></td>
            </tr>
            <tr>
              <td height="25" align="center">มสด.</td>
              <td height="25" align="center"><?=$row["INSTRUCTIONS"]?></td>
              <td align="center"><?= change_date_thai($row["EFFECTIVE_DATE"]) ?></td>
              <td align="center"><?= change_date_thai($row["START_DATE"]) ?></td>
              <td align="center">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"> หมายเหตุ :</td>
          <td width="88%" colspan="3" >
            <textarea name="data_remark" rows="5" id="data_remark" ><?=$row["ASSESSMENT_REMARK"]?></textarea></td>
        </tr>
		<?php if (($_SESSION['USER_TYPE'] != 'chief') || ($_SESSION['USER_EMP_ID'] == $_SESSION['EMP_ID'])) { ?>
        <tr>
          <td align="center" colspan="4" >
            <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
            <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png" onclick="o_input(); check_data_file();" border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
          </td>
        </tr>
        <?php
        }
        ?>
        <tr>
          <td colspan="4" align="left"  valign="top" style="padding-left:50px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>
        
      </table></form>
      <?
		}
    ?>
</div>

  </td>
  </tr>
</table>


<?
	$db->closedb($conn);
?>
