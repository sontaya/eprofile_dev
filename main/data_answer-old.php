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
      <? include "data_answer_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('data_answer','file_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
        <div id="data_form" style="display:none;">
      <img src="../images/bg_d.png" style="margin-left:10px;" />
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="data_answer" name="data_answer" method="post" action="data_answer_save.php" enctype="multipart/form-data" target="upload_target" >
    <table width="758" border="0" cellspacing="4" cellpadding="4">
		<tr>
			<input type="hidden" id="file_id" name="file_id" value=""/></td>
			<input type="hidden" id="fi_id" name="fi_id" value=""/>
		</tr>
		<tr>
			<td align="center" class="form_text" colspan="2">
				<div>
					<table border="0">
                        
                        
                        <tr>
                            <td width="200" align="right" class="form_text"> คำสั่ง : </td>
                            <td colspan="3" align="left"><input type="text" name="da_order_no" id="da_order_no" style="width: 80px; " class="input_text" value="<? if ($row["DA_ORDER_NO"] == "") { echo "มสด."; }?>"
                            <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                            ที่ <input type="text" id="da_at" name="da_at" style="width: 80px; " class="input_text" value="<?= $row["DA_AT"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                            สั่ง ณ วันที่ <input type="text"  name="da_at_date" id="da_at_date" style="width: 80px; " class="input_text" value=""<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>>
                            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('da_at_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                      	</tr>
						
						<tr>
							<td width="" align="right" class="form_text">* ประเภทงบประมาณ<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<select name="type_munny" id="type_munny">
                                    <option value="">----- เลือก --------</option>
                                        <? 
                                        $sql_ex1 = "SELECT * FROM  ".TB_REF_EXTRA_SALARY."  ORDER BY ID ASC "; 
                                        $stid_ex1 = oci_parse($conn, $sql_ex1 );
                                        oci_execute($stid_ex1);
                                        while(($row_ex1 = oci_fetch_array($stid_ex1, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_ex1["ID"] ?>"><?= $row_ex1["NAME"] ?></option>
                                        <? } ?>
                                </select>
						    </td>
						</tr>
                        <tr>
							<td width="" align="right" class="form_text">* แหล่งงบประมาณ<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<select name="location_munny" id="location_munny">
                                    <option value="">----- เลือก --------</option>
                                        <? 
                                        $sql_budget1 = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
                                        $stid_budget1 = oci_parse($conn, $sql_budget1 );
                                        oci_execute($stid_budget1);
                                        while(($row_budget1 = oci_fetch_array($stid_budget1, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_budget1["CODE_SALARY_SOURCE"] ?>"><?= $row_budget1["NAME_SALARY_SOURCE"] ?></option>
                                        <? } ?>
                                </select>
						    </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text">* จำนวนเงิน<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<input type="text" name="munny_da" id="munny_da" style="width:150px;"> บาท
						    </td>
						</tr>
                        
                        
                        <tr id="box_two2">
							<td width="" align="right" class="form_text">วันที่เริ่ม :<!--(สกอ.)--> </td>
							<td width="" align="left">
								<input type="text" name="start_dates" id="start_dates" style="width:100px;">&nbsp;<img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_dates','YYYY-MM-DD')"  style="cursor:pointer"/>
                                วันที่สิ้นสุด :<input type="text" name="end_dates" id="end_dates" style="width:100px;">&nbsp;<img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('end_dates','YYYY-MM-DD')"  style="cursor:pointer"/>
                                <input type="checkbox" name="start_ck" id="start_ck" value="1" checked> เป็นต้นไป
						    </td>
						</tr>
                        <tr id="box2_one17">
							<td width="" align="right" class="form_text">&nbsp;</td>
							<td width="" align="left">
                                <div id="img_list_s" align="left" class="data_details_list" style="margin-left:-15px;">
                                  
                                </div>
                                <input class="files" name="da_files[]" type="file" ><br>
                                <div class="contents"></div><br>
                                <span>
                                    <a href="javascript:void(0);" class="add" >เเนบไฟล์เพิ่ม</a>
                                </span>
                            </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text"> หมายเหตุ<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<textarea rows="4" cols="50" name="da_note" id="da_note"></textarea>
						    </td>
						</tr>
                       
					</table>
				</div>
			</td>
		</tr>
	    <input type="hidden" name="da_id" id="da_id">
        <input type="hidden" name="pags_id" id="pags_id" value="DA">
       <?php
		 // Hide for user and chief
		 if($_SESSION['USER_TYPE'] == 'admin' || $_SESSION['USER_TYPE'] == 'hr') {
		 ?>
        <tr>
            <td height="44" align="right" valign="top" >
            <img name="pic_save" id="pic_save" src="../images/default_button/save_default_buttons_01.png"  border="0" style="cursor:pointer" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')"/>
            <img name="pic_save2" id="pic_save2" src="../images/active_default/save_active_buttons_01.png"  border="0" style="cursor:pointer;display: none" onmouseover="over_button('pic_save','pic_save2');" onmouseout="out_button('pic_save','pic_save2')" onclick="check_data_file();"/>
            </td>
            <td colspan="2" align="left" valign="top">
            <img name="pic_cancel" id="pic_cancel" src="../images/default_button/cancel_default_buttons_03.png" border="0"  style="cursor:pointer" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')"/>
            <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('sector_transfer.php','../images/head2/work_data/honor.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')" />
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3" align="left"  valign="top" style="padding-left:200px; color:#06C;">&nbsp;<span id="waiting"></span></td>
        </tr>

    </table>
    </form>

    </td>
  </tr>
  <tr>
    <td width="758" align="center">&nbsp;</td>
  </tr>
</table>
</div>

  </td>
  </tr>
</table>


<?
	$db->closedb($conn);
?>
