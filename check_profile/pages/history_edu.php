<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_history_edu" name="chk_history_edu" value="1" onChange="check_radio('history_edu')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_history_edu" name="chk_history_edu" value="2" onChange="check_radio('history_edu')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ประวัติการศึกษา" disabled="disabled" id="bt_history_edu" name="bt_history_edu">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
//    $sql = "SELECT * FROM  ".TB_CHILDREN_TAB."  WHERE  EMP_ID= '".$_SESSION["EMP_ID"]."' ORDER BY CHL_BIRTHDAY ASC"; 
	$sql = "SELECT * FROM ".TB_EDUCATION_TAB." et, ".TB_REF_LEV." rl, ".TB_REF_NATION." rn, ".TB_REF_ISCED." ri WHERE et.EMP_ID= '".$_SESSION["EMP_ID"]."' AND ET.EDU_LEVEL=RL.LEV_ID AND ET.EDU_COUNTRY=RN.NATION_ID AND ET.EDU_DISCIPLINE=RI.ISCED_ID ORDER BY et.EDU_YEAR ASC";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<div class="row">
    <div class="alert alert-success" role="alert">ระดับการศึกษา <?=$row["LEV_NAME_TH"]?></div>
	<div class="form-group col-md-2">
		<div class="input-group">
			<div class="input-group-addon">ประเทศ</div>
			<div class="form-control"><?=$row["NATION_NAME_TH"]?>&nbsp;</div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ชื่อเต็มของหลักสูตร</div>
			<div class="form-control"><?=$row["EDU_NAME"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ชื่อย่อของวุฒิ</div>
			<div class="form-control"><?=$row["EDU_NAME_SHORT"]?></div>
		</div>
	</div>
	<div class="form-group col-md-2">
		<div class="input-group">
			<div class="input-group-addon">เกรดเฉลี่ย (GPA)</div>
			<div class="form-control"><?=$row["EDU_GPA"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่สำเร็จการศึกษา</div>
			<div class="form-control"><?=$row["EDU_YEAR"]?></div>
		</div>
	</div>
	<div class="form-group col-md-9">
		<div class="input-group">
			<div class="input-group-addon">ชื่อเต็ม สาขา/วิชาเอก</div>
			<div class="form-control"><?=$row["EDU_MAJOR"]?>&nbsp;</div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วิชาเอก อื่นๆ</div>
			<div class="form-control"><?=$row["EDU_MAJOR2"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">กลุ่มสาขาวิชา</div>
			<div class="form-control"><?=$row["ISCED_NAME_TH"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">กล่มสาขาวิชา อื่นๆ</div>
			<div class="form-control"><?=$row["EDU_DISCIPLINE2"]?></div>
		</div>
	</div>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">มหาวิทยาลัย/สถาบัน</div>
			<div class="form-control"><?=$row["EDU_FROM"]?></div>
		</div>
	</div>
</div>
<?
	}
?>
