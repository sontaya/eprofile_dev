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
    var chanme = $('input[name=type_st]:checked', '#data_answer').val();
    if($('#location_munny').val()=="" || $('#type_munny').val()=="" || $('#munny_da').val()==""){
		 $("#Please_fill_in").dialog('open');
				return false;
		 }
    
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("data_answer").submit();
}


</script>
<script>
$(document).ready(function() {
  $(".add").click(function() {
    $('<div><input class="files" name="da_files[]" type="file" ><span class="rem" ><a href="javascript:void(0);" ></span></div>').appendTo(".contents");
    });
  $('.contents').click(function() {
    $('.rem').parent("div").remove();
  });
 
});
</script>

<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
    <div id="da_list" align="center" class="data_details_list">
      <? //include "data_answer_table.php";?>
    </div>
<!--    <div align="center"  id="toggle_formf"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('data_answer','file_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>-->
        <div id="data_form">
      <img src="../images/bg_d.png" style="margin-left:10px;" />
      <?
      $sql_raise="SELECT srs.*,
       SRSS01.NAME_SALARY_SOURCE as name_salary_type_01,
       SRSS02.NAME_SALARY_SOURCE as name_salary_type_02,
       SRSS03.NAME_SALARY_SOURCE as name_salary_type_03
FROM
    SDPERSON.SDU_RAISE_SALARY srs,
    SDPERSON.SDU_REF_SALARY_SOURCE srss01,
    SDPERSON.SDU_REF_SALARY_SOURCE srss02,
    SDPERSON.SDU_REF_SALARY_SOURCE srss03
WHERE
    SRS.SALARY_TYPE01 = SRSS01.CODE_SALARY_SOURCE(+) AND
    SRS.SALARY_TYPE02 = SRSS02.CODE_SALARY_SOURCE(+) AND
    SRS.SALARY_TYPE03 = SRSS03.CODE_SALARY_SOURCE(+) AND EMP_ID = '".$emp_id."'";
	echo $sql_raise;
	  $stid = oci_parse($conn, $sql_raise );
	  oci_execute($stid);
	  $row = oci_fetch_array($stid, OCI_BOTH);
	  if($row["EMP_ID"]){
	  ?>
      <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td colspan="5"><strong>การประเมินผลงานปฏิบัติงาน</strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>คะแนนผลการประเมิน</td>
          <td><?=$row["RATING_ASSESSMENT"]?>
            คะแนน</td>
          <td>ระดับผล</td>
          <td><?=$row["LEVEL_SCORE"]?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>เงินเดือนก่อนเลื่อน</td>
          <td><?=number_format($row["SALARY_BEFORE"],'2')?>
            บาท</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>ร้อยละที่ได้เลื่อน</td>
          <td><?=$row["PERCENTAGE_DROP"]?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>จํานวนที่ได้รับรับการเลื่อนจริง</td>
          <td><?=number_format($row["SALARY_TRUE"],'2')?>
            บาท</td>
          <td>เงินตอบแทนพิเศษ </td>
          <td><?=number_format($row["EXTAR_MONEY"],'2')?>
            บาท</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>จํานวนเงินที่ได้เลื่อน </td>
          <td><?=number_format($row["MONEY_PROMOTED"],'2')?>
            บาท</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>เงินเดือนหลังเลื่อน</td>
          <td><?=number_format($row["SALARY_SLIDE"],'2')?>
            บาท</td>
          <td>คําสั่ง
            <?=$row["INSTRUCTIONS"]?>
            สั่ง ณ วันที่
            <?=change_date_thai($row["START_DATE"])?></td>
          <td>วันที่มีผล
            <?=change_date_thai($row["EFFECTIVE_DATE"])?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5">ประเภทงบประมาณ : </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><? if($row["NAME_SALARY_TYPE_01"]) echo $row["NAME_SALARY_TYPE_01"]; else echo "-"; ?></td>
          <td><?=number_format($row["SALARY01"],'2')?>
            บาท</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><? if($row["NAME_SALARY_TYPE_02"]) echo $row["NAME_SALARY_TYPE_02"]; else echo "-"; ?></td>
          <td><?=number_format($row["SALARY02"],'2')?>
            บาท</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><? if($row["NAME_SALARY_TYPE_03"]) echo $row["NAME_SALARY_TYPE_03"]; else echo "-"; ?></td>
          <td><?=number_format($row["SALARY03"],'2')?>
            บาท</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td colspan="4"><strong>การประเมินผลงานปฏิบัติงาน</strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">            คะแนน</td>
          <td align="center">ระดับ</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>รอบที่ 1 (1 ต.ค. 58 - 31 มี.ค. 59)</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>รอบที่ 2 (1 เม.ย. 59 - 30 ก.ย. 59</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>คะแนนเฉลี่ย ปี 2559</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4">การเลื่อนเงินเดือน</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>เงินเดือนก่อนเลื่อน</td>
          <td>&nbsp;</td>
          <td>บาท</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>เงินเดือนสูงสุดแต่ละประเภท</td>
          <td>&nbsp;</td>
          <td>บาท</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>ร้อยละที่ได้เลื่อน</td>
          <td>&nbsp;</td>
          <td>บาท</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>จำนวนเงินที่ได้เลื่อน</td>
          <td>&nbsp;</td>
          <td>บาท</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>ค่าตอบแทนพิเศษ</td>
          <td>&nbsp;</td>
          <td>บาท</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>เงินเดือนหลังเลื่อน</td>
          <td>&nbsp;</td>
          <td>บาท</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">คำสั่งที่ x มีผลตั้งแต่ x สั่ง ณ วันที่ x</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>หมายเหตุ:</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3">&nbsp;</td>
          </tr>
      </table>
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
