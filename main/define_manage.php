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
<script src="../js/st_data.js?Math.random()" type="text/javascript"></script>
<script src="../js/vtip.js" type="text/javascript"></script>
<script src="../js/main.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">

function check_data_file(){
	var chanme = $('input[name=type_st]:checked', '#define_manage').val();
	if($('#start_dates').val()==""){
		$("#Please_fill_in").dialog('open');
		return false;
	}
	
	alert("กรุณาเปลี่ยนตำเเหน่งทางการบริหารใหม่ในรายการตำเเหน่งงานปัจจุบัน");	
	$("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
	document.getElementById("define_manage").submit();
}

</script>
<script>
$(document).ready(function() {
  $(".add").click(function() {
    $('<div><input class="files" name="dm_files[]" type="file" ><span class="rem" ><a href="javascript:void(0);" ></span></div>').appendTo(".contents");
    });
  $('.contents').click(function() {
    $(".ram").parent("div").remove();
  });
});
</script>

<script>
	function change_depsub(department_id,input_name){
		if(input_name=="dm_mua_submain"){
			option = $('#dm_mua_submain');
		}
			option.empty();
			option.append($("<option></option>").val(00).html("กรุณาเลือก"));
<?
				$sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."";
				$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
				oci_execute($stid_ref_department_sub);
				$option_ref_department_sub="<option value=''>เลือก</option>";
				while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
?>
			if(<?=$row_ref_department_sub["CODE_FACULTY"]?>==department_id){
				option.append($("<option></option>").val("<?=$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]?>").html("<?=$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]?>"));
			}
<?
									}
?>

	}
</script>

<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
    <div id="dm_list" align="center" class="data_details_list">
      <? include "define_manage_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('define_manage','file_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
        <div id="data_form" style="display:none;">
      <img src="../images/bg_d.png" style="margin-left:10px;" />
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="define_manage" name="define_manage" method="post" action="define_manage_save.php" enctype="multipart/form-data" target="upload_target">
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
                            <td width="150" align="right" class="form_text"> คำสั่ง : </td>
                            <td colspan="3" align="left"><input type="text" name="dm_order_no" id="dm_order_no" style="width: 80px; " class="input_text" value="<? if ($row["DM_ORDER_NO"] == "") { echo "มสด."; } else { echo $row["SCH_ORDER_NO"]; } ?>"
                            <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                            ที่ <input type="text" id="dm_at" name="dm_at" style="width: 80px; " class="input_text" value="<?= $row["ST_AT"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                            สั่ง ณ วันที่ <input type="text"  name="dm_at_date" id="dm_at_date" style="width: 80px; " class="input_text" value=""<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>>
                            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('dm_at_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                      	</tr>

                        <tr>
							<td  align="right" class="form_text">*ตำเเหน่งที่ได้รับการเเต่งตั้ง<!--(สกอ.)--> :</td>
							<td  align="left" colspan="3">
                                <select name="dm_mua_emp_type" id="dm_mua_emp_type" class="widthFix2"  >
							     <?
							    $sql_position = "SELECT *  FROM  ".TB_POSITION."  ORDER BY POSITION ASC ";
                                $stid_position = oci_parse($conn, $sql_position);
                                oci_execute($stid_position);
                                while(($row_position = oci_fetch_array($stid_position, OCI_BOTH))){
								?>
                                    <option value="<?= $row_position["CODE"]; ?>"><?= $row_position["POSITION"]; ?></option>    
							    <? } ?>
							    </select>
							</td>
						</tr>
                        <tr>
							<td  align="right" class="form_text">* หน่วยงานหลัก<!--(สกอ.)--> :</td>
							<td  align="left">
						          <?
						    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC ";
							$stid_ref_department = oci_parse($conn, $sql_ref_department);
							oci_execute($stid_ref_department);
							$option_ref_department="<option value=''>เลือก</option>";
							while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
								if($row["CWK_MUA_MAIN"] == $row_ref_department["CODE_FACULTY"]){ $select="selected = 'selected'";}else{ $select="";}
									$option_ref_department .= "<option value='".$row_ref_department["CODE_FACULTY"]."' $select>".$row_ref_department["NAME_FACULTY"]."</option>\n";
							}
							//$option_ref_department .= "<option value='other' $select>อื่นๆ</option>\n";
							?>
						     <select name="dm_mua_main" id="dm_mua_main" style="width:480px;" onChange="change_depsub(this.value,'dm_mua_submain')">
								<?=$option_ref_department?>
						     </select>
						    </td>
						</tr>
						<tr>
							<td  align="right" class="form_text"> หน่วยงานย่อย<!--(สกอ.)--> :</td>
							<td  align="left">
							    <div id="ajax_depsub_two">
									<?
									//if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
									$sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."";
									$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
									oci_execute($stid_ref_department_sub);
									$option_ref_department_sub="<option value=''>เลือก</option>";
									while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
										if($row["CWK_MUA_SUBMAIN"] == $row_ref_department_sub["CODE_DEPARTMENT_SECTION"]){ $select="selected = 'selected'";}else{ $select="";}
											$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' $select>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>\n";
									}
									?>
									<select name="dm_mua_submain" id="dm_mua_submain"  style="width:480px;" >
									    <?= $option_ref_department_sub ?>
									</select>
							    </div>

						    </td>
						</tr>
						<tr>
							<td  align="right" class="form_text">* ศูนย์การศึกษา<!--(สกอ.)--> :</td>
							<td  align="left">
									 <?
							    $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE."  ORDER BY NAME_SITE ASC ";
								$stid_ref_site = oci_parse($conn, $sql_ref_site);
								oci_execute($stid_ref_site);
								$option_ref_site="<option value=''>เลือก</option>";
								while(($row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH))){
									if($row["CWK_DSU_EDU_CENTER"] == $row_ref_site["CODE_SITE"]){ $select="selected = 'selected'";}else{ $select="";}
										$option_ref_site .= "<option value='".$row_ref_site["CODE_SITE"]."' $select>".$row_ref_site["NAME_SITE"]."</option>\n";
								}
								?>
							     <select name="dm_dsu_edu_center" id="dm_dsu_edu_center" style="width:480px;" >
									<?=$option_ref_site?>
							    </select>
						    </td>
						</tr>
						<!-- <tr>
							<td  align="right" class="form_text">* ตําเเหน่งงานใหม่:</td>
                            <td  align="left"><?
                                /*$sql_position = "SELECT *  FROM  ".TB_POSITION."  ORDER BY POSITION ASC "; 
                                $stid_position = oci_parse($conn, $sql_position);
                                oci_execute($stid_position);
                                $option_position="<option value=''>เลือก</option>";
                                while(($row_position = oci_fetch_array($stid_position, OCI_BOTH))){
                                    if($row["CWK_DSU_POS"] == $row_position["CODE"]){ $select="selected = 'selected'";}else{ $select="";}
                                        $option_position .= "<option value='".$row_position["CODE"]."' $select>".$row_position["POSITION"]."</option>\n";
                                } */
                                ?>
                                  <select name="dm_current_history" id="dm_current_history" class="widthFix2" style="width:480px;" >
                                    <? //=$option_position?>
                                  </select>
                            </td>
						</tr> -->
						<!--<tr>
							<td width="" align="right" class="form_text">* เงินเดือนใหม่ :</td>
							<td width="" align="left">
								<input type="text" name="dm_munny_history" id="dm_munny_history" style="width:150px;"> บาท
						    </td>
						</tr> -->
                        
                        <tr>
							<td width="" align="right" class="form_text"> ค่าตอบเเทน 1<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<select name="munny_dm_1" id="munny_dm_1" style="width:170px;">
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
                                แหล่งงบประมาณ :
                                <select name="redo_dm_1" id="redo_dm_1" style="width:170px;">
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
                                <input type="text" name="munny_one" id="munny_one" style="width:70px;"> บาท
						    </td>
						</tr>
                        <tr>
							<td width="" align="right" class="form_text"> ค่าตอบเเทน 2<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<select name="munny_dm_2" id="munny_dm_2" style="width:170px;">
                                    <option value="">----- เลือก --------</option>
                                    <? 
                                        $sql_ex2 = "SELECT * FROM  ".TB_REF_EXTRA_SALARY."  ORDER BY ID ASC "; 
                                        $stid_ex2 = oci_parse($conn, $sql_ex2 );
                                        oci_execute($stid_ex2);
                                        while(($row_ex2 = oci_fetch_array($stid_ex2, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_ex2["ID"] ?>"><?= $row_ex2["NAME"] ?></option>
                                        <? } ?>
                                </select>
                                แหล่งงบประมาณ :
                                <select name="redo_dm_2" id="redo_dm_2" style="width:170px;">
                                    <option value="">----- เลือก --------</option>
                                        <? 
                                        $sql_budget2 = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
                                        $stid_budget2 = oci_parse($conn, $sql_budget2 );
                                        oci_execute($stid_budget2);
                                        while(($row_budget2 = oci_fetch_array($stid_budget2, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_budget2["CODE_SALARY_SOURCE"] ?>"><?= $row_budget2["NAME_SALARY_SOURCE"] ?></option>
                                        <? } ?>
                                </select>
                                <input type="text" name="munny_two" id="munny_two" style="width:70px;"> บาท
						    </td>
						</tr>
                        <tr>
							<td width="" align="right" class="form_text"> ค่าตอบเเทน 3<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<select name="munny_dm_3" id="munny_dm_3" style="width:170px;">
                                    <option value="">----- เลือก --------</option>
                                    <? 
                                        $sql_ex3 = "SELECT * FROM  ".TB_REF_EXTRA_SALARY."  ORDER BY ID ASC "; 
                                        $stid_ex3 = oci_parse($conn, $sql_ex3 );
                                        oci_execute($stid_ex3);
                                        while(($row_ex3 = oci_fetch_array($stid_ex3, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_ex3["ID"] ?>"><?= $row_ex3["NAME"] ?></option>
                                        <? } ?>
                                </select>
                                แหล่งงบประมาณ :
                                <select name="redo_dm_3" id="redo_dm_3" style="width:170px;">
                                    <option value="">----- เลือก --------</option>
                                        <? 
                                        $sql_budget3 = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
                                        $stid_budget3 = oci_parse($conn, $sql_budget3 );
                                        oci_execute($stid_budget3);
                                        while(($row_budget3 = oci_fetch_array($stid_budget3, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_budget3["CODE_SALARY_SOURCE"] ?>"><?= $row_budget3["NAME_SALARY_SOURCE"] ?></option>
                                        <? } ?>
                                </select>
                                <input type="text" name="munny_tree" id="munny_tree" style="width:70px;"> บาท
						    </td>
						</tr>
                        <tr>
							<td width="" align="right" class="form_text"> ค่าตอบเเทน 4<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<select name="munny_dm_4" id="munny_dm_4" style="width:170px;" >
                                    <option value="">----- เลือก --------</option>
                                   <? 
                                        $sql_ex4 = "SELECT * FROM  ".TB_REF_EXTRA_SALARY."  ORDER BY ID ASC "; 
                                        $stid_ex4 = oci_parse($conn, $sql_ex4 );
                                        oci_execute($stid_ex4);
                                        while(($row_ex4 = oci_fetch_array($stid_ex4, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_ex4["ID"] ?>"><?= $row_ex4["NAME"] ?></option>
                                        <? } ?>
                                </select>
                                แหล่งงบประมาณ :
                                <select name="redo_dm_4" id="redo_dm_4" style="width:170px;">
                                    <option value="">----- เลือก --------</option>
                                        <? 
                                        $sql_budget4 = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
                                        $stid_budget4 = oci_parse($conn, $sql_budget4 );
                                        oci_execute($stid_budget4);
                                        while(($row_budget4 = oci_fetch_array($stid_budget4, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_budget4["CODE_SALARY_SOURCE"] ?>"><?= $row_budget4["NAME_SALARY_SOURCE"] ?></option>
                                        <? } ?>
                                </select>
                                <input type="text" name="munny_four" id="munny_four" style="width:70px;"> บาท
						    </td>
						</tr>
                        <tr>
							<td width="" align="right" class="form_text"> ค่าตอบเเทน 5<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<select name="munny_dm_5" id="munny_dm_5" style="width:170px;">
                                    <option value="">----- เลือก --------</option>
                                    <? 
                                        $sql_ex5 = "SELECT * FROM  ".TB_REF_EXTRA_SALARY."  ORDER BY ID ASC "; 
                                        $stid_ex5 = oci_parse($conn, $sql_ex5 );
                                        oci_execute($stid_ex5);
                                        while(($row_ex5 = oci_fetch_array($stid_ex5, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_ex5["ID"] ?>"><?= $row_ex5["NAME"] ?></option>
                                        <? } ?>
                                </select>
                                แหล่งงบประมาณ :
                                <select name="redo_dm_5" id="redo_dm_5" style="width:170px;">
                                    <option value="">----- เลือก --------</option>
                                        <? 
                                        $sql_budget5 = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC "; 
                                        $stid_budget5 = oci_parse($conn, $sql_budget5 );
                                        oci_execute($stid_budget5);
                                        while(($row_budget5 = oci_fetch_array($stid_budget5, OCI_BOTH))){
                                        ?>
                                        <option value="<?= $row_budget5["CODE_SALARY_SOURCE"] ?>"><?= $row_budget5["NAME_SALARY_SOURCE"] ?></option>
                                        <? } ?>
                                </select>
                                <input type="text" name="munny_five" id="munny_five" style="width:70px;"> บาท
						    </td>
						</tr>
                        <tr id="box_two2">
							<td width="" align="right" class="form_text"><!--(สกอ.)--> </td>
							<td width="" align="left">
								วันที่เริ่ม :<input type="text" name="start_dates" id="start_dates" style="width:100px;">&nbsp;<img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_dates','YYYY-MM-DD')"  style="cursor:pointer"/>
                                วันที่สิ้นสุด :<input type="text" name="end_dates" id="end_dates" style="width:100px;">&nbsp;<img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('end_dates','YYYY-MM-DD')"  style="cursor:pointer"/>
                                <input type="checkbox" name="start_ck" id="start_ck" value="1" checked> เป็นต้นไป
						    </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text"> หมายเหตุ<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<textarea rows="4" cols="50" name="dm_note" id="dm_note"></textarea>
						    </td>
						</tr>
                        <tr id="box_one2">
							<td width="" align="right" class="form_text">* มีผลตั้งเเต่<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<input type="text" name="start_dm" id="start_dm" style="width:130px;">
                                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_dm','YYYY-MM-DD')"  style="cursor:pointer"/>
						    </td>
						</tr>
						<tr id="box2_one17">
							<td width="" align="right" class="form_text">&nbsp;</td>
							<td width="" align="left">
                                <div id="img_list_s" align="left" class="data_details_list" style="margin-left:-15px;">
                                  
                                </div>
                                <input class="files" name="dm_files[]" type="file" ><br>
                                <div class="contents"></div><br>
                                <span>
                                    <a href="javascript:void(0);" class="add" >เเนบไฟล์เพิ่ม</a>
                                </span>
                            </td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	    <input type="hidden" name="dm_id" id="dm_id">
        <input type="hidden" name="pags_id" id="pags_id" value="DM">
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
            <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('define_manage.php','../images/head2/work_data/define_manage.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')" />
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
