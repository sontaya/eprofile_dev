<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_current_position" name="chk_current_position" value="1" onChange="check_radio('current_position')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_current_position" name="chk_current_position" value="2" onChange="check_radio('current_position')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ตำแหน่งปัจจุบัน" disabled="disabled" id="bt_current_position" name="bt_current_position">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_CURRENT_WORK_TAB." cwt WHERE CWT.EMP_ID = '".$_SESSION["EMP_ID"]."' "; 
//echo $sql;
$stid = oci_parse($conn, $sql);
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_BOTH);
?>
<br />
<div class="row">
	<div class="alert alert-success" role="alert">ตำแหน่งงานปัจจุบัน</div>
		<div class="form-group col-md-3">
			<div class="input-group">
			<div class="input-group-addon">สถานะปัจจุบัน</div>
			<div class="form-control"><? switch($row["CWK_STATUS"]){ case '01' : echo "ปฏิบัติการ"; break; case '02' : echo "ลาออก"; break; case '03' : echo "ลาศึกษาต่อ"; break; case '04' : echo "เกษียณอายุ"; break; case '05' : echo "ปฏิบัติการตามวาระ"; break; case '07' : echo "เสียชีวิต"; break; case '08' : echo "ไม่ใช้งานแล้ว"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">สถานะตำแหน่ง</div>
			<div class="form-control"><? switch($row["CWK_POS_STATUS"]){ case '1' : echo "ตำแหน่งเดิม/สังกัดเดิม"; break; case '2' : echo "ตำแหน่งใหม่/สังกัดใหม่"; break; } ?></div>
		</div>
	</div>
     <?
    $sql_emp_type = "SELECT * FROM  ".TB_REF_STAFFTYPE." WHERE STAFFTYPE_ID = '".$row["CWK_MUA_EMP_TYPE"]."' ";
	$stid_emp_type = oci_parse($conn, $sql_emp_type );
	oci_execute($stid_emp_type);
	$row_emp_type = oci_fetch_array($stid_emp_type, OCI_BOTH);
	$option_emp_type = $row_emp_type["STAFFTYPE_NAME"];
	?>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">ประเภทบุคลากร</div>
			<div class="form-control"><?=$option_emp_type?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">วันที่บรรจุเป็นพนักงานมหาวิทยาลัย</div>
			<div class="form-control"><?=$row["DATE_M"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คำสั่ง</div>
			<div class="form-control"><?=$row["CK_ORDER_NO"]?> ที่ <?=$row["CK_ORDER_NO"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สั่ง ณ วันที่</div>
			<div class="form-control"><?=$row["CK_ORDER_DATE"]?></div>
		</div>
	</div>
   	<?
    $sql_emp_subtype = "SELECT * FROM  ".TB_REF_SUBSTAFFTYPE." WHERE SUBSTAFFTYPE_ID = '".$row["CWK_MUA_EMP_SUBTYPE"]."' ";
	$stid_emp_subtype = oci_parse($conn, $sql_emp_subtype );
	oci_execute($stid_emp_subtype);
	$row_emp_subtype = oci_fetch_array($stid_emp_subtype, OCI_BOTH);
	$option_emp_subtype = $row_emp_subtype["SUBSTAFFTYPE_NAME"];
	?>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ประเภทบุคลากรย่อย</div>
			<div class="form-control"><?=$option_emp_subtype?></div>
		</div>
	</div>
    <?
    $sql_ref_department = "SELECT * FROM  ".TB_REF_DEPARTMENT." WHERE CODE_FACULTY = '".$row["CWK_MUA_MAIN"]."' ";
	$stid_ref_department = oci_parse($conn, $sql_ref_department);
	oci_execute($stid_ref_department);
	$row_ref_department = oci_fetch_array($stid_ref_department, OCI_BOTH);
	$option_ref_department = $row_ref_department["NAME_FACULTY"];
	?>
	<div class="form-group col-md-5">
		<div class="input-group">
			<div class="input-group-addon">หน่วยงานหลัก</div>
			<div class="form-control"><?=$option_ref_department?></div>
		</div>
	</div>
	 <?
    if($row["CWK_MUA_MAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_MAIN"];
    $sql_ref_department_sub = "SELECT * FROM  ".TB_REF_DEPARTMENT_SUB."  WHERE CODE_FACULTY = '".$where."' AND CODE_DEPARTMENT_SECTION = '".$row["CWK_MUA_SUBMAIN"]."' ";
	$stid_ref_department_sub = oci_parse($conn, $sql_ref_department_sub);
	oci_execute($stid_ref_department_sub);
	$row_ref_department_sub = oci_fetch_array($stid_ref_department_sub, OCI_BOTH);
	$option_ref_department_sub = $row_ref_department_sub["NAME_DEPARTMENT_SECTION"];
	?>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">หน่วยงานย่อย</div>
			<div class="form-control"><?=$option_ref_department_sub?></div>
		</div>
	</div>
	<?
    if($row["CWK_MUA_SUBMAIN"] == "") $where = "99999"; else $where = $row["CWK_MUA_SUBMAIN"];
    $sql_ref_department_group = "SELECT * FROM  ".TB_REF_DEPARTMENT_GROUP."  WHERE CODE_DEPARTMENT_SUB = '".$where."' AND CODE_DEPARTMENT_GROUP = '".$row["CWK_MUA_WORK_GROUP"]."' ";
	$stid_ref_department_group = oci_parse($conn, $sql_ref_department_group);
	oci_execute($stid_ref_department_group);
	$row_ref_department_group = oci_fetch_array($stid_ref_department_group, OCI_BOTH);
	$option_ref_department_group = $row_ref_department_group["NAME_DEPARTMENT_GROUP"];
	?>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">กลุ่มงาน</div>
			<div class="form-control"><?=$option_ref_department_group?></div>
		</div>
	</div>
	<?
    $sql_ref_site = "SELECT * FROM  ".TB_REF_SITE."  ORDER BY NAME_SITE ASC ";
	//echo $sql_ref_site;
	$stid_ref_site = oci_parse($conn, $sql_ref_site);
	oci_execute($stid_ref_site);
	while(($row_ref_site = oci_fetch_array($stid_ref_site, OCI_BOTH))){
		if($row["CWK_DSU_EDU_CENTER"] == $row_ref_site["CODE_SITE"]){ 
			$option_ref_site = $row_ref_site["NAME_SITE"];
		}
	}
	?>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ศูนย์การศึกษา</div>
			<div class="form-control"><?=$option_ref_site?></div>
		</div>
	</div>
	<?
    $sql_position = "SELECT *  FROM  ".TB_POSITION."  ORDER BY POSITION ASC ";
	$stid_position = oci_parse($conn, $sql_position);
	oci_execute($stid_position);
	$option_position="<option value=''>เลือก</option>";
	while(($row_position = oci_fetch_array($stid_position, OCI_BOTH))){
		if($row["CWK_DSU_POS"] == $row_position["CODE"]){
			$option_position = $row_position["POSITION"];
		}
	}
	?>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">ตำแหน่ง</div>
			<div class="form-control"><?=$option_position?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เลขที่ตำแหน่ง</div>
			<div class="form-control"><?=$row["POSITION_CODE"]?></div>
		</div>
	</div>
    <?
    $sql_mua_vpos = "SELECT * FROM  ".TB_REF_POSITION."  WHERE POSITION_NAME_ENG = 'ตำแหน่งทางวิชาการ' OR POSITION_ID = '00' ORDER BY POSITION_ID DESC ";
	$stid_mua_vpos = oci_parse($conn, $sql_mua_vpos);
	oci_execute($stid_mua_vpos);
	$option_mua_vpos="<option value=''>เลือก</option>";
	while(($row_mua_vpos = oci_fetch_array($stid_mua_vpos, OCI_BOTH))){
		if($row["CWK_MUA_VPOS"] == $row_mua_vpos["POSITION_ID"]){
			$option_mua_vpos = $row_mua_vpos["POSITION_NAME_TH"];
		}
	}
	?>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ตำแหน่งทางวิชาการ</div>
			<div class="form-control"><?=$option_mua_vpos?></div>
		</div>
	</div>
    <?
    $sql_mua_level = "SELECT * FROM  ".TB_REF_STAFF_LEV." ORDER BY STAFF_LEV_ID ASC ";
	$stid_mua_level = oci_parse($conn, $sql_mua_level);
	oci_execute($stid_mua_level);
	$option_mua_level="<option value=''>เลือก</option>";
	while(($row_mua_level = oci_fetch_array($stid_mua_level, OCI_BOTH))){
		if($row["CWK_MUA_LEVEL"] == $row_mua_level["STAFF_LEV_ID"]){
			$option_mua_level = $row_mua_level["STAFF_LEV_NAME"];
		}
	}
	?>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ระดับตำแหน่ง</div>
			<div class="form-control"><?=$option_mua_level?></div>
		</div>
	</div>
    <?
    $sql_mua_mpos = "SELECT * FROM  ".TB_REF_ADMIN."  ORDER BY ADMIN_NAME ASC ";
	$stid_mua_mpos = oci_parse($conn, $sql_mua_mpos);
	oci_execute($stid_mua_mpos);
	$option_mua_mpos="<option value=''>เลือก</option>";
	$cwk_mua_mpos=$row["CWK_MUA_MPOS"];
	while(($row_mua_mpos = oci_fetch_array($stid_mua_mpos, OCI_BOTH))){
		if($row["CWK_MUA_MPOS"] == $row_mua_mpos["ADMIN_ID"]){
			$option_mua_mpos = $row_mua_mpos["ADMIN_NAME"];
		}
	}
	?>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ตำแหน่งบริหาร</div>
			<div class="form-control"><?=$option_mua_mpos?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่เข้าทำงาน</div>
			<div class="form-control"><?=$row["CWK_END_WORK_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ช่วงเวลาปฏิบัติงานตั้งแต่เวลา</div>
			<div class="form-control"><?=$row["CWK_START_WORK"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่ทดลองปฏิบัติการสอน</div>
			<div class="form-control"><?=$row["CWK_START_TEACH_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คำสั่งที่</div>
			<div class="form-control"><?=$row["CWK_ORDER1"]?> สั่ง ณ <?=$row['CWK_TEACH_ORDER']?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่ปรับตำแหน่ง</div>
			<div class="form-control"><?=$row["CWK_PROMOTE_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คำสั่งที่</div>
			<div class="form-control"><?=$row["CWK_ORDER2"]?> สั่ง ณ <?=$row['CWK_PROMOTE_ORDER']?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ทำงานวันหยุด</div>
			<div class="form-control"><? if($row["CWK_SAT"] == "1"){ echo "วันเสาร์";} ?><? if($row["CWK_SUN"] == "1"){ echo "วันอาทิตย์";}?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เงินเดือน</div>
			<div class="form-control"><?=$row["CWK_SALARY"]?></div>
		</div>
	</div>
</div>

