<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_appoint" name="chk_appoint" value="1" onChange="check_radio('appoint')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_appoint" name="chk_appoint" value="2" onChange="check_radio('appoint')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลการแต่งตั้งตำแหน่งทางการบริหาร" disabled="disabled" id="bt_appoint" name="bt_appoint">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<br />
<?
	$sql = "SELECT * FROM ".TB_SDU_SECTOR_TRANSFER_TAB." sst, ".TB_POSITION." pos, ".TB_REF_DEPARTMENT." rdp, ".TB_REF_DEPARTMENT_SUB." rdps, ".TB_REF_SITE." rsite WHERE SST.EMP_ID= '".$_SESSION["EMP_ID"]."' AND SST.ST_MUA_EMP_TYPE=POS.CODE AND SST.ST_MUA_MAIN=RDP.CODE_FACULTY AND SST.ST_MUA_SUBMAIN=RDPS.CODE_DEPARTMENT_SECTION AND RDP.CODE_FACULTY=RDPS.CODE_FACULTY AND SST.ST_DSU_EDU_CENTER=RSITE.CODE_SITE ";
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	while($row = oci_fetch_array($stid, OCI_BOTH)){
?>
<div class="row">
	<div class="alert alert-success" role="alert">ข้อมูลการแต่งตั้งตำแหน่งทางการบริหาร</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คำสั่ง</div>
			<div class="form-control"><?=$row["ST_ORDER_NO"]?> ที่ <?=$row["ST_AT"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ตำแหน่งที่ได้รับการแต่งตั้ง</div>
			<div class="form-control"><?=$row["POSITION"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">หน่วยงานหลัก</div>
			<div class="form-control"><?=$row["NAME_FACULTY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">หน่วยงานย่อย</div>
			<div class="form-control"><?=$row["NAME_DEPARTMENT_SECTION"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ศูนย์การศึกษา</div>
			<div class="form-control"><?=$row["NAME_SITE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่เริ่มต้น</div>
			<div class="form-control"><?=$row["START_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่สิ้นสุด</div>
			<div class="form-control"><?=$row["END_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">มีผลตั้งแต่</div>
			<div class="form-control"><?=$row["START_AT"]?></div>
		</div>
	</div>
</div>
<?
	}
?>