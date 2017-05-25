<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_change_position" name="chk_change_position" value="1" onChange="check_radio('change_position')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_change_position" name="chk_change_position" value="2" onChange="check_radio('change_position')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลการย้ายสังกัด/เปลี่ยนสถานที่ปฏิบัติงาน/ช่วยปฏิบัติงาน/เปลี่ยนตำแหน่ง" disabled="disabled" id="bt_change_position" name="bt_change_position">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_SDU_SECTOR_TRANSFER_TAB." st, ".TB_REF_STAFFTYPE." rstt, ".TB_REF_DEPARTMENT." rdp, ".TB_REF_DEPARTMENT_SUB." rdps, ".TB_REF_SITE." rsite, ".TB_POSITION." pos WHERE ST.EMP_ID = '".$_SESSION["EMP_ID"]."' AND ST.ST_MUA_EMP_TYPE=RSTT.STAFFTYPE_ID AND ST.ST_MUA_MAIN=RDP.CODE_FACULTY AND RDP.CODE_FACULTY=RDPS.CODE_FACULTY AND ST.ST_MUA_SUBMAIN=RDPS.CODE_DEPARTMENT_SECTION AND ST.ST_DSU_EDU_CENTER=RSITE.CODE_SITE AND ST.ST_CURRENT_HISTORY2=POS.CODE";
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
	<div class="alert alert-success" role="alert">ข้อมูลการย้ายสังกัด/เปลี่ยนตำแหน่ง</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ประเภท</div>
			<div class="form-control"><? switch($row["TYPE_ST"]){ case '1' : echo "ย้ายสังกัด"; break; case '2' : echo "ช่วยปฏิบัติหน้าที่"; break; case '3' : echo "เปลี่ยนสถานที่ปฏิบัติงาน"; break; case '4' : echo "เปลี่ยนตำเเหน่ง"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คำสั่ง</div>
			<div class="form-control"><?=$row["ST_ORDER_NO"]?> ที่ <?=$row["ST_AT"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สั่ง ณ วันที่</div>
			<div class="form-control"><?=$row["ST_AT_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ตำแหน่งประเภทบุคลากร</div>
			<div class="form-control"><?=$row["STAFFTYPE_NAME"]?></div>
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
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ตำแหน่งงานใหม่</div>
			<div class="form-control"><?=$row["POSITION"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เงินเดือนใหม่</div>
			<div class="form-control"><?=$row["ST_MUNNY_HISTORY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่เริ่ม</div>
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
			<div class="form-control"><?=$row["START_ST"]?></div>
		</div>
	</div>
</div>  
<?
}
?>
