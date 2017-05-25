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
<script src="../js/cj_data.js?Math.random()" type="text/javascript"></script>
<script src="../js/vtip.js" type="text/javascript"></script>
<script src="../js/main.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">


function check_data_file(){
	
/*	alert($('#definition_ck').val());
	alert($('#test_type_ck').val());
	alert($('#cj_mua_main_test').val());
	alert($('#cj_mua_main').val());*/
	
    if($('#definition_ck').val()=="1" && $('#test_type_ck').val()==""){
		 $("#Please_fill_in").dialog('open');
				return false;
		 }
    if($('#definition_ck').val()=="1" && $('#cj_mua_main_test').val()==""){
		 $("#Please_fill_in").dialog('open');
				return false;
		 }
    if($('#test_type_ck').val()=="1" && $('#cj_mua_main').val()==""){
		 $("#Please_fill_in").dialog('open');
				return false;
		 }
    alert("กรุณาเปลี่ยนตำเเหน่งเเละสังกัดใหม่ในรายการตำเเหน่งงานปัจจุบัน");
    $("span#waiting").html("Saving. . .<img src='../images/indicator_medium.gif' align='absmiddle' />");
    document.getElementById("change_job").submit();
}

function box_cj(v) {
    if(v == "1"){
        $("#box_one").show();
        $("#box_one2").show();
        $("#box_one3").show();
        $("#box_one4").show();
        $("#box_one5").show();
        $("#box_one6").show();
        $("#box_one7").show();
        $("#box_one8").show();
        $("#box_one9").show();
        $("#definition_ck").val(1);

    }
    if(v == "2"){
        $("#box_one").hide();
        $("#box_one2").hide();
        $("#box_one3").hide();
        $("#box_one4").hide();
        $("#box_one5").hide();
        $("#box_one6").hide();
        $("#box_one7").hide();
        $("#box_one8").hide();
        $("#box_one9").hide();
        $("#definition_ck").val(2);

    }

}

    function box2_cj(v) {
    if(v == "1"){
        $("#box_one").show();
        $("#box2_one2").show();
        $("#box2_one3").show();
        $("#box2_one4").show();
        $("#box2_one5").show();
        $("#box2_one6").show();
        $("#box2_one7").show();
        $("#box2_one8").show();
        $("#box2_one9").show();
        $("#box2_one10").show();
        $("#box2_one11").show();
        $("#box2_one12").show();
        $("#box2_one13").show();
        $("#box2_one14").show();
        $("#box2_one15").show();
        $("#box2_one16").show();
        $("#box2_one17").show();
        $("#test_type_ck").val(1);

    }
    if(v == "2"){
        $("#box2_one").hide();
        $("#box2_one2").hide();
        $("#box2_one3").hide();
        $("#box2_one4").hide();
        $("#box2_one5").hide();
        $("#box2_one6").hide();
        $("#box2_one7").hide();
        $("#box2_one8").hide();
        $("#box2_one9").hide();
        $("#box2_one10").hide();
        $("#box2_one11").hide();
        $("#box2_one12").hide();
        $("#box2_one13").hide();
        $("#box2_one14").hide();
        $("#box2_one15").hide();
        $("#box2_one16").hide();
        $("#box2_one17").hide();
        $("#test_type_ck").val(2);

    }

}
</script>
<script>
$(document).ready(function() {
  $(".add").click(function() {
    $('<div><input class="files" name="cj_files[]" type="file" ><span class="rem" ><a href="javascript:void(0);" ></span></div>').appendTo(".contents");
    });
  $('.contents').click(function() {
    $(".rem").parent("div").remove();
  });

});
</script>

<script>
	function change_depsub(department_id,input_name){
		if(input_name=="cj_mua_submain_test"){
			option = $('#cj_mua_submain_test');
		}else if(input_name=="cj_mua_submain"){
			option = $('#cj_mua_submain');
		}else if(input_name=="cj_mua_submaintwo"){
			option = $('#cj_mua_submaintwo');
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
    <div id="cj_list" align="center" class="data_details_list">
      <? include "change_job_table.php";?>
    </div>
    <div align="center"  id="toggle_form"><?php if( $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/add.png" onclick="toggle_form('change_job','chj_id')" style="cursor:pointer"/><?php } ?>&nbsp;</div>
        <div id="data_form" style="display:none;">
      <img src="../images/bg_d.png" style="margin-left:10px;" />
<table  cellspacing="0" cellpadding="0" align="center" >
 <tr>
    <td><form id="change_job" name="change_job" method="post" action="change_job_save.php" enctype="multipart/form-data" target="upload_target">
    <table width="758" border="0" cellspacing="4" cellpadding="4">
		<tr>
        	<td><input type="hidden" id="chj_id" name="chj_id" value=""/></td>
		</tr>
		<tr>
			<td align="center" class="form_text" colspan="2">
				<div>
					<table border="0">
                        <tr>
							<td width="" align="right" class="form_text">&nbsp;</td>
							<td width="" align="left">
								<input type="radio" name="definition" id="definition" value="1" onclick="box_cj(1)">เปลี่ยนสายงานสนับสนุน เป็น สายวิชาการ
						    </td>
						</tr>
                        <tr>
							<td width="" align="right" class="form_text">&nbsp; </td>
							<td width="" align="left">
								<input type="radio" name="definition" id="definition" value="2" onclick="box_cj(2)">เปลี่ยนจากสายวิชาการ เป็น สายสนับสนุน
                                <input type="hidden" name="definition_ck" id="definition_ck">
						    </td>
						</tr>

                        <tr id="box_one">
                            <td width="200" align="right" class="form_text"> คำสั่ง : </td>
                            <td colspan="3" align="left"><input type="text" name="cj_order_no" id="cj_order_no" style="width: 80px; " class="input_text" value="<? if ($row["cj_ORDER_NO"] == "") { echo "มสด."; } else { echo $row["SCH_ORDER_NO"]; } ?>"
                            <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                            ที่ <input type="text" id="cj_at" name="cj_at" style="width: 80px; " class="input_text" value="<?= $row["cj_AT"] ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                            สั่ง ณ วันที่ <input type="text"  name="cj_at_date" id="cj_at_date" style="width: 80px; " class="input_text" value="<?= change_date_thai($row["cj_AT_DATE"]) ?>"<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>>
                            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('cj_at_date','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                      	</tr>

				        <tr id="box_one2">
							<td width="" align="right" class="form_text">อาจารย์พี่เลี้ยง<!--(สกอ.)--> </td>
							<td width="" align="left">
								<input type="text" name="cj_instructor" id="cj_instructor" style="width:150px;" >
						    </td>
						</tr>
                        <tr id="box_one6">
							<td width="" align="right" class="form_text">วันที่เริ่มต้นทดลองสอน :<!--(สกอ.)--> </td>
							<td width="" align="left">
								<input type="text" name="start_dates_test" id="start_dates_test" style="width:100px;">&nbsp;<img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_dates_test','YYYY-MM-DD')"  style="cursor:pointer"/>
                                วันที่สิ้นสุด :<input type="text" name="end_dates_test" id="end_dates_test" style="width:100px;">&nbsp;<img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('end_dates_test','YYYY-MM-DD')"  style="cursor:pointer"/>

						    </td>
						</tr>
                        <tr id="box_one7">
							<td width="" align="right" class="form_text">ภาคการศึกษาที่ทดลองสอน<!--(สกอ.)--> </td>
							<td width="" align="left">
								<input type="text" name="term_test" id="term_test" style="width:150px;" >
						    </td>
						</tr>

                        <tr id="box_one8">
							<td width="" align="right" class="form_text">&nbsp; </td>
							<td width="" align="left">
                                <input type="radio" name="test_type" id="test_type" value="1" onclick="box2_cj(1)">ผ่านการทดลองสอน<input type="radio" name="test_type" id="test_type" value="2" onclick="box2_cj(2)"> ไม่ผ่าน
						        <input type="hidden" name="test_type_ck" id="test_type_ck">
                            </td>
						</tr>
                        <tr id="box_one9" >
							<td width="" align="right" class="form_text">เหตุผล :</td>
							<td width="" align="left"><textarea rows="4" cols="50" name="test_noet" id="test_noet" ></textarea>

						    </td>
						</tr>

						<tr id="box2_one">
                            <td width="200" align="right" class="form_text"> คำสั่ง : </td>
                            <td colspan="3" align="left"><input type="text" name="cj_order_no_two" id="cj_order_no_two" style="width: 80px; " class="input_text" value="มสด." <?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>>
                            ที่ <input type="text" id="cj_at_two" name="cj_at_two" style="width: 80px; " class="input_text" value=""<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>/>
                            สั่ง ณ วันที่ <input type="text"  name="cj_at_date_two" id="cj_at_date_two" style="width: 80px; " class="input_text" value=""<?php if ($_SESSION['USER_TYPE'] == 'user' || $_SESSION['USER_TYPE'] == 'chief') { ?> readonly<?php } ?>>
                            <?php if ($_SESSION['USER_TYPE'] != 'user' && $_SESSION['USER_TYPE'] != 'chief') { ?><img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('cj_at_date_two','YYYY-MM-DD')"  style="cursor:pointer"/><?php } ?></td>
                      	</tr>

						<tr id="box2_one2">
							<td width="22" align="right" class="form_text">*ตำเเหน่งเดิม ประเภทบุคลากร<!--(สกอ.)--> :</td>
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
							     <select name="cj_mua_emp_type" id="cj_mua_emp_type" class="widthFix2"  >
								<?=$option_emp_type?>
							            </select>
							</td>
						</tr>
						<tr id="box2_one3">
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
						     <select name="cj_mua_main" id="cj_mua_main" style="width:480px;" onChange="change_depsub(this.value,'cj_mua_submain')">
								<?=$option_ref_department?>
						     </select>
						    </td>
						</tr>
						<tr id="box2_one4">
							<td width="22" align="right" class="form_text">* หน่วยงานย่อย<!--(สกอ.)--> :</td>
							<td width="19%" align="left">
							    <div id="ajax_depsub">
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
									<select name="cj_mua_submain" id="cj_mua_submain"  style="width:480px;" >
									    <?= $option_ref_department_sub ?>
									</select>
							    </div>

						    </td>
						</tr>
						<tr id="box2_one5">
							<td width="" align="right" class="form_text"> ศูนย์การศึกษา<!--(สกอ.)--> :</td>
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
							     <select name="cj_dsu_edu_center" id="cj_dsu_edu_center" style="width:480px;" >
									<?=$option_ref_site?>
							    </select>
						    </td>
						</tr>
						<tr id="box2_one6">
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
                                  <select name="cj_current_history" id="cj_current_history" class="widthFix2" style="width:480px;" >
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
						<tr id="box2_one7">
							<td width="" align="right" class="form_text">* เงินเดือนเดิม<!--(สกอ.)--> :</td>
							<td width="" align="left">
                            	<select id="cwk_budget1" name="cwk_budget1" style="width: 130px"><?=$option[1]?></select>
								<input type="text" name="cj_munny_history" id="cj_munny_history" style="width:150px;"> บาท
						    </td>
						</tr>

						<tr>
							<td width="" align="right" class="form_text">&nbsp;</td>
							<td width="" align="left">&nbsp;</td>
						</tr>

                        <tr id="box2_one8">
							<td width="22" align="right" class="form_text">*ตำเเหน่งใหม่ ประเภทบุคลากร<!--(สกอ.)--> :</td>
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
							     <select name="cj_mua_emp_type2" id="cj_mua_emp_type2" class="widthFix2"  >
								<?=$option_emp_type?>
							            </select>
							</td>
						</tr>
                        <tr id="box2_one9">
							<td width="22" align="right" class="form_text">* หน่วยงานหลัก<!--(สกอ.)--> :</td>
							<td width="19%" align="left">
						          <?
						    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT."  ORDER BY NAME_FACULTY ASC ";
							$stid_ref_department = oci_parse($conn, $sql_ref_department);
							oci_execute($stid_ref_department);
							$option_ref_department="<option value=''>เลือก</option>";
							while(($row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH))){
								if($row["CWK_MUA_MAIN2"] == $row_ref_department["CODE_FACULTY"]){ $select="selected = 'selected'";}else{ $select="";}
									$option_ref_department .= "<option value='".$row_ref_department["CODE_FACULTY"]."' $select>".$row_ref_department["NAME_FACULTY"]."</option>\n";
							}
							//$option_ref_department .= "<option value='other' $select>อื่นๆ</option>\n";
							?>
						     <select name="cj_mua_main2" id="cj_mua_main2" style="width:480px;"  onChange="change_depsub(this.value,'cj_mua_submaintwo')">
								<?=$option_ref_department?>
						     </select>
						    </td>
						</tr>
						<tr id="box2_one10">
							<td width="22" align="right" class="form_text">* หน่วยงานย่อย<!--(สกอ.)--> :</td>
							<td width="19%" align="left">
							    <div id="ajax_depsub_two">
									<?
									//if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
									$sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB." ";
									$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
									oci_execute($stid_ref_department_sub);
									$option_ref_department_sub="<option value=''>เลือก</option>";
									while(($row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH))){
										if($row["CWK_MUA_SUBMAIN"] == $row_ref_department_sub["CODE_DEPARTMENT_SECTION"]){ $select="selected = 'selected'";}else{ $select="";}
											$option_ref_department_sub .= "<option value='".$row_ref_department_sub["CODE_DEPARTMENT_SECTION"]."' $select>".$row_ref_department_sub["NAME_DEPARTMENT_SECTION"]."</option>\n";
									}
									?>
									<select name="cj_mua_submaintwo" id="cj_mua_submaintwo"  style="width:480px;" >
									    <?= $option_ref_department_sub ?>
									</select>
							    </div>

						    </td>
						</tr>
						<tr id="box2_one11">
							<td width="" align="right" class="form_text"> ศูนย์การศึกษา<!--(สกอ.)--> :</td>
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
							     <select name="cj_dsu_edu_center2" id="cj_dsu_edu_center2" style="width:480px;" >
									<?=$option_ref_site?>
							    </select>
						    </td>
						</tr>
						<tr id="box2_one12">
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
                                  <select name="cj_current_history2" id="cj_current_history2" class="widthFix2" style="width:480px;" >
                                    <?=$option_position?>
                                  </select>
                            </td>
						</tr>
						<tr id="box2_one13">
							<td width="" align="right" class="form_text">* เงินเดือนใหม่<!--(สกอ.)--> :</td>
							<td width="" align="left">
                            	<select id="cwk_budget2" name="cwk_budget2" style="width: 130px"><?=$option[2]?></select>
								<input type="text" name="cj_munny_history2" id="cj_munny_history" style="width:150px;"> บาท
						    </td>
						</tr>


                        <tr id="box2_one14">
							<td width="" align="right" class="form_text"><!--(สกอ.)--> </td>
							<td width="" align="left">
								วันที่เริ่ม :<input type="text" name="start_dates" id="start_dates" style="width:100px;">&nbsp;<img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_dates','YYYY-MM-DD')"  style="cursor:pointer"/><input type="checkbox" name="start_cj" id="start_cj" value="1" checked> เป็นต้นไป
						    </td>
						</tr>
						<tr id="box2_one15">
							<td width="" align="right" class="form_text"> หมายเหตุ<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<textarea rows="4" cols="50" name="cj_note" id="cj_note"></textarea>
						    </td>
						</tr>
                        <tr id="box2_one16">
							<td width="" align="right" class="form_text">* มีผลตั้งเเต่<!--(สกอ.)--> :</td>
							<td width="" align="left">
								<input type="text" name="start_st" id="start_st" style="width:130px;">
                                <img src="../images/vcalendar.png" align="absmiddle" onclick="showCalendar('start_st','YYYY-MM-DD')"  style="cursor:pointer"/>
						    </td>
						</tr>
						<tr id="box2_one17">
							<td width="" align="right" class="form_text">&nbsp;</td>
							<td width="" align="left">
                                <div id="img_list_s" align="left" class="data_details_list" style="margin-left:-15px;">

                                </div>
                                <input class="files" name="cj_files[]" type="file" ><br>
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
	    <input type="hidden" name="cj_id" id="cj_id">
        <input type="hidden" name="pags_id" id="pags_id" value="CJ">
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
            <img name="pic_cancel2" id="pic_cancel2" src="../images/active_default/cancel_active_buttons_03.png" border="0" onclick="change_data('change_job.php','../images/head2/work_data/change_job.png');" style="cursor:pointer; display:none" onmouseover="over_button('pic_cancel','pic_cancel2');" onmouseout="out_button('pic_cancel','pic_cancel2')" />
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
