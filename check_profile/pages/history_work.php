<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_history_work" name="chk_history_work" value="1" onChange="check_radio('history_work')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_history_work" name="chk_history_work" value="2" onChange="check_radio('history_work')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ประวัติการทำงานในอดีต" disabled="disabled" id="bt_history_work" name="bt_history_work">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
$sql = "SELECT * FROM  ".TB_WORK_HISTORY_TAB." st WHERE ST.EMP_ID = '".$_SESSION["EMP_ID"]."'"; 
$stid = oci_parse($conn, $sql );
oci_execute($stid);
while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<br />
<div class="row">
	<div class="alert alert-success" role="alert">ประสบการณ์ทำงาน</div>
	<div class="form-group col-md-5">
		<div class="input-group">
			<div class="input-group-addon">สถานที่ทำงาน</div>
			<div class="form-control"><?=$row["WRK_WORK_PLACE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ตำแหน่ง</div>
			<div class="form-control"><?=$row["WRK_POSITION"]?>&nbsp;</div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">หน่วย/ฝ่าย/แผนก</div>
			<div class="form-control"><?=$row["WRK_DEPART"]?></div>
		</div>
	</div>
	<div class="form-group col-md-5">
		<div class="input-group">
			<div class="input-group-addon">หน้าที่รับผิดชอบ</div>
			<div class="form-control"><?=$row["WRK_RESPONSIBILITY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ระยะเวลา</div>
			<div class="form-control"><?=$row["WRK_LONG"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ที่ตั้งที่ทำงาน</div>
			<div class="form-control"><?=$row["WRK_LOC"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เบอร์โทรศัพท์</div>
			<div class="form-control"><?=$row["WRK_PHONE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เบอร์โทรสาร</div>
			<div class="form-control"><?=$row["WRK_FAX"]?></div>
		</div>
	</div>
</div>
<?
}
?> 
