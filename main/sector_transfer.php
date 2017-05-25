<?
@session_start();
$emp_id = $_SESSION["EMP_ID"];
if(!$_SESSION or $_SESSION["EMP_ID"] == "") {
?>
<script language="javascript">
window.location = "../" ;
</script>
<? }
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
    var chanme = $('input[name=type_st]:checked', '#sector_tranfer').val();

	if(chanme == "2"){
		if($('#start_dates').val()==""){
			$("#Please_fill_in").dialog('open');
			return false;
		}
	}
		 
    if(chanme == "1" || chanme == "3" || chanme == "4" || chanme == "5" || chanme == "6"){
		if($('#start_st').val()==""){
			$("#Please_fill_in").dialog('open');
			return false;
		}
	}

    if(chanme == "1" || chanme == "4"){
	alert("กรุณาเปลี่ยนตำเเหน่งเเละสังกัดใหม่ในรายการตำเเหน่งงานปัจจุบัน");	
    }
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("sector_tranfer").submit();
}

function box_sf(v) {
    //alert(v);
    if(v == "1"){
        //alert("ok1");
        $("#box_one").show();
        $("#box_one2").show();
        $("#box_two").hide();
        $("#box_two2").hide();
        $("#box_tree").hide();
    }
    if(v == "2"){
        $("#box_two").show();
        $("#box_two2").show();
        $("#box_tree").hide();
        $("#box_one").hide();
        $("#box_one2").hide();
    }
    if(v == "3"){
        $("#box_tree").show();
        $("#box_one2").show();
        $("#box_two").hide();
        $("#box_two2").hide();
    }
    if(v == "4"){
        $("#box_tree").show();
        $("#box_one2").show();
        $("#box_two").hide();
        $("#box_two2").hide();
    }

}
</script>
<script>
$(document).ready(function() {
  $(".add").click(function() {
    $('<div><input class="files" name="st_files[]" type="file" ><span class="rem" ><a href="javascript:void(0);" ></span></div>').appendTo(".contents");
    });
  $('.contents').click(function() {
    $('.rem').parent("div").remove();
  });
 
});
</script>

<table cellpadding="0" cellspacing="0" align="center" width="758">
    <tr><td >
    <div id="st_list" align="center" class="data_details_list">
      <? include "sector_transfer_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('sector_tranfer','file_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
        <div id="data_form" style="display:none;">
      <img src="../images/bg_d.png" style="margin-left:10px;" />
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="sector_tranfer" name="sector_tranfer" method="post" action="sector_transfer_save.php" enctype="multipart/form-data" target="upload_target">
    <table width="758" border="0" cellspacing="4" cellpadding="4">
		<tr>
			<input type="hidden" id="file_id" name="file_id" value=""/></td>
			<input type="hidden" id="fi_id" name="fi_id" value=""/>
			<td width="182" align="right" class="form_text">ประเภท :</td>
			<td width="548" align="left">
				<input type="radio" name="type_st" id="type_st" value="1" onclick="box_sf(1)">ย้ายสังกัด
				<input type="radio" name="type_st" id="type_st" value="2" onclick="box_sf(2)">ช่วยปฏิบัติหน้าที่
				<input type="radio" name="type_st" id="type_st" value="3" onclick="box_sf(3)">เปลี่ยนสถานที่ปฏิบัติงาน<br />
                <input type="radio" name="type_st" id="type_st" value="4" onclick="box_sf(4)">เปลี่ยนตำเเหน่ง
				<input type="radio" name="type_st" id="type_st" value="5" onclick="box_sf(1)">กลับต้นสังกัด
                <input type="radio" name="type_st" id="type_st" value="6" onclick="box_sf(1)">ไปปฏิบัติหน้าที่
			</td>
		</tr>
		<tr>
			<td align="center" class="form_text" colspan="2">
				<div>
					<table border="0">
						<tr>
							<td width="200" align="center"></td>
							<td width="200">
                                <div id="box_one" style="display:none"><h3>ย้ายสังกัด</h3></div>
                                <div id="box_two" style="display:none"><h3>ช่วยปฏิบัติหน้าที่</h3></div>
                                <div id="box_tree" style="display:none"><h3>เปลี่ยนสถานที่ปฏิบัติงาน</h3></div>
                            </td>
						</tr>
						<tr>
                        <td width="200" align="right" class="form_text"> คำสั่ง : </td>
                        <td colspan="3" align="left"><input type="text" name="st_order_no" id="st_order_no" style="width: 80px; " class="input_text" value="<? if ($row["ST_ORDER_NO"] == "") { echo "มสด."; } else { echo $row["SCH_ORDER_NO"]; } ?>"
                        <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                        ที่ <input type="text" id="st_at" name="st_at" style="width: 80px; " class="input_text" value="<?= $row["ST_AT"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                        สั่ง ณ วันที่ <input type="text"  name="st_at_date" id="st_at_date" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["ST_AT_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>>
                        <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('st_at_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                      	</tr>

						<tr>
							<td width="22" align="right" class="form_text">* ตําเเหน่งประเภทบุคลากร<!--(สกอ.)--> :</td>
							<td width="200" align="left" colspan="3">
							     <?
							    $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC ";
								$stid_emp_type = oci_parse($conn, $sql_emp_type );
								oci_execute($stid_emp_type);
								$option_emp_type="<option value=''>เลือก</option>";
								while(($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))){
									if($row["CWK_MUA_EMP_TYPE"] == $row_emp_type["STAFFTYPE_ID"]){ $select="selected = 'selected'";}else{ $select="";}
										$option_emp_type .= "<option value='".$row_emp_type["STAFFTYPE_ID"]."' $select>".$row_emp_type["STAFFTYPE_NAME"]."</option>\n";
								}
								?>
							     <select name="st_mua_emp_type" id="st_mua_emp_type" class="widthFix2"  >
								<?=$option_emp_type?>
							            </select>
							</td>
						</tr>
						<tr>
							<td width="22" align="right" class="form_text">* หน่วยงานหลัก<!--(สกอ.)--> :</td>
							<td width="19%" align="left">
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
						     <select name="st_mua_main" id="st_mua_main" style="width:480px;" onchange="load_depsub(this.value)">
								<?=$option_ref_department?>
						     </select>
						    </td>
						</tr>
						<tr>
							<td width="22" align="right" class="form_text">* หน่วยงานย่อย<!--(สกอ.)--> :</td>
							<td width="19%" align="left">
							    <div id="ajax_depsub">
									<?
									//if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
//									$sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." WHERE CODE_FACULTY = '".$row["CWK_MUA_MAIN"]."' ";
									$sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." ";
									//echo $sql_ref_department_sub;
									$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
									oci_execute($stid_ref_department_sub);
									$option_ref_department_sub="<option value=''>เลือก</option>";
									while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
										if($row["CWK_MUA_SUBMAIN"] == $row_ref_department_sub["CODE_DEPARTMENT_SECTION"]){ $select="selected = 'selected'";}else{ $select="";}
											$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' $select>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>\n";
									}
									?>
									<select name="st_mua_submain" id="st_mua_submain"  style="width:480px;" >
									    <?= $option_ref_department_sub ?>
									</select>
							    </div>

						    </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text">* ศูนย์การศึกษา<!--(สกอ.)--> :</td>
							<td width="" align="left">
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
							     <select name="st_dsu_edu_center" id="st_dsu_edu_center" style="width:480px;" >
									<?=$option_ref_site?>
							    </select>
						    </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text">* ตําเเหน่งงานเดิม<!--(สกอ.)--> :</td>
                            <td width="19%" align="left"><?
                                $sql_position = "SELECT *  FROM  ".TB_POSITION."  ORDER BY POSITION ASC "; 
                                $stid_position = oci_parse($conn, $sql_position);
                                oci_execute($stid_position);
                                $option_position="<option value=''>เลือก</option>";
                                while(($row_position = oci_fetch_array($stid_position, OCI_BOTH))){
                                    if($row["CWK_DSU_POS"] == $row_position["CODE"]){ $select="selected = 'selected'";}else{ $select="";}
                                        $option_position .= "<option value='".$row_position["CODE"]."' $select>".$row_position["POSITION"]."</option>\n";
                                }
                                ?>
                                  <select name="st_current_history" id="st_current_history" class="widthFix2" style="width:480px;" >
                                    <?=$option_position?>
                                  </select>
                            </td>
						</tr>
<?
$sql_budget = "SELECT * FROM  ".TB_REF_SALARY_SOURCE."  ORDER BY CODE_SALARY_SOURCE ASC ";
$stid_budget = oci_parse($conn, $sql_budget );
oci_execute($stid_budget);

$option = array();
for($i=1;$i<11;$i++){
	if($i>3){
	$option[$i]="<option value=''>เลือก</option>";
	}
}
while(($row_budget = oci_fetch_array($stid_budget, OCI_BOTH))){
	for($i=1;$i<4;$i++){
		//if($row_salary["SOURCE{$i}"] == $row_budget["CODE_SALARY_SOURCE"]){
		if(true){
			if($row["ST_MONEY_TYPE{$i}"] == $row_budget["CODE_SALARY_SOURCE"]) {
				$select="selected = 'selected'";
			}
			else {
				$select ="";
			}
			$option[$i] .= "<option value='".$row_budget["CODE_SALARY_SOURCE"]."' $select>".$row_budget["NAME_SALARY_SOURCE"]."</option>";
			}
		}
	for($i=4;$i<11;$i++){
		$j = $i - 3;
		if($row["ST_MONEY_TYPE{$j}"] == $row_budget["CODE_SALARY_SOURCE"]){ $select="selected = 'selected'";}else{ $select="";}
		$option[$i] .= "<option value='".$row_budget["CODE_SALARY_SOURCE"]."' $select>".$row_budget["NAME_SALARY_SOURCE"]."</option>";

	}
}
?>                        
						<tr>
							<td width="" align="right" class="form_text">เงินเดือนเดิม<!--(สกอ.)--> :</td>
							<td width="" align="left">
                            	<select id="cwk_budget1" name="cwk_budget1" style="width: 130px"><?=$option[1]?></select>
								<input type="text" name="st_munny_history" id="st_munny_history" style="width:150px;"> บาท
						    </td>
						</tr>

						<tr>
							<td width="" align="right" class="form_text">&nbsp;</td>
							<td width="" align="left">&nbsp;</td>
						</tr>
                        
                        <tr>
							<td width="22" align="right" class="form_text">* ตําเเหน่งประเภทบุคลากร<!--(สกอ.)--> :</td>
							<td width="200" align="left" colspan="3">
							     <?
							    $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE."  ORDER BY STAFFTYPE_ID ASC ";
								$stid_emp_type = oci_parse($conn, $sql_emp_type );
								oci_execute($stid_emp_type);
								$option_emp_type="<option value=''>เลือก</option>";
								while(($row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH))){
									if($row["CWK_MUA_EMP_TYPE"] == $row_emp_type["STAFFTYPE_ID"]){ $select="selected = 'selected'";}else{ $select="";}
										$option_emp_type .= "<option value='".$row_emp_type["STAFFTYPE_ID"]."' $select>".$row_emp_type["STAFFTYPE_NAME"]."</option>\n";
								}
								?>
							     <select name="st_mua_emp_type2" id="st_mua_emp_type2" class="widthFix2"  >
								<?=$option_emp_type?>
							            </select>
							</td>
						</tr>
                        <tr>
							<td width="22" align="right" class="form_text">* หน่วยงานหลัก<!--(สกอ.)--> :</td>
							<td width="19%" align="left">
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
						     <select name="st_mua_main2" id="st_mua_main2" style="width:480px;"  onchange="load_depsub_two(this.value)">
								<?=$option_ref_department?>
						     </select>
						    </td>
						</tr>
						<tr>
							<td width="22" align="right" class="form_text">* หน่วยงานย่อย<!--(สกอ.)--> :</td>
							<td width="19%" align="left">
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
									<select name="st_mua_submain2" id="st_mua_submain2"  style="width:480px;" >
									    <?= $option_ref_department_sub ?>
									</select>
							    </div>

						    </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text">* ศูนย์การศึกษา<!--(สกอ.)--> :</td>
							<td width="" align="left">
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
							     <select name="st_dsu_edu_center2" id="st_dsu_edu_center2" style="width:480px;" >
									<?=$option_ref_site?>
							    </select>
						    </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text">* ตําเเหน่งงานใหม่<!--(สกอ.)--> :</td>
                            <td width="19%" align="left"><?
                                $sql_position = "SELECT *  FROM  ".TB_POSITION."  ORDER BY POSITION ASC "; 
                                $stid_position = oci_parse($conn, $sql_position);
                                oci_execute($stid_position);
                                $option_position="<option value=''>เลือก</option>";
                                while(($row_position = oci_fetch_array($stid_position, OCI_BOTH))){
                                    if($row["CWK_DSU_POS"] == $row_position["CODE"]){ $select="selected = 'selected'";}else{ $select="";}
                                        $option_position .= "<option value='".$row_position["CODE"]."' $select>".$row_position["POSITION"]."</option>\n";
                                }
                                ?>
                                  <select name="st_current_history2" id="st_current_history2" class="widthFix2" style="width:480px;" >
                                    <?=$option_position?>
                                  </select>
                            </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text"> เงินเดือนใหม่<!--(สกอ.)--> :</td>
							<td width="" align="left">
                            	<select id="cwk_budget2" name="cwk_budget2" style="width: 130px"><?=$option[2]?></select>
								<input type="text" name="st_munny_history2" id="st_munny_history" style="width:150px;"> บาท
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
								<textarea rows="4" cols="50" name="st_note" id="st_note"></textarea>
						    </td>
						</tr>
                        <tr id="box_one2">
							<td width="" align="right" class="form_text">* มีผลตั้งเเต่<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<input type="text" name="start_st" id="start_st" style="width:130px;">
                                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_st','YYYY-MM-DD')"  style="cursor:pointer"/>
						    </td>
						</tr>
						<tr>
							<td width="" align="right" class="form_text" valign= "top">ไฟล์เเนบ :</td>
							<td width="" align="left">
                                <div id="img_list_s" align="left" class="data_details_list" style="margin-left:-15px;">
                                  
                                </div>
                                <input class="files" name="st_files[]" type="file" ><br>
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
	    <input type="hidden" name="st_id" id="st_id">
         <input type="hidden" name="pags_id" id="pags_id" value="ST">
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
