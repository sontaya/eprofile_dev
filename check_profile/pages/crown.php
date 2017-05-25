<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_crown" name="chk_crown" value="1" onChange="check_radio('crown')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_crown" name="chk_crown" value="2" onChange="check_radio('crown')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="เครื่องราชอิสริยาภรณ์" disabled="disabled" id="bt_crown" name="bt_crown">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
	$sql = "SELECT * FROM ".TB_ROYAL_TAB." st WHERE ST.EMP_ID= '".$_SESSION["EMP_ID"]."' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<div class="row">
    <div class="alert alert-success" role="alert">เครื่องราชอิสริยาภรณ์เครื่องราชอิสริยาภรณ์</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ปี พ.ศ. ที่ได้รับ</div>
			<div class="form-control"><?=$row["ROY_YEAR"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เล่มที่</div>
			<div class="form-control"><?=$row["ROY_NO1"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ตอนที่</div>
			<div class="form-control"><?=$row["ROY_NO2"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ชั้นของเครื่องราชฯ</div>
			<div class="form-control"><?=$row["ROY_NAME"]?></div>
		</div>
	</div>
	<div class="form-group col-md-5">
		<div class="input-group">
			<div class="input-group-addon">สถานะการถือครองเครื่องราชอิสริยาภรณ์</div>
			<div class="form-control"><? switch($row["STATUS_ROYAL"]){ case '1' : echo "อยู่ที่หน่วยงานต้นสังกัด"; break; case '2' : echo "อยู่ที่ผู้รับพระราชทาน"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">วันที่ขอรับเครื่องราชอิสริยาภรณ์จากหน่วยงานต้นสังกัด</div>
			<div class="form-control"><?=$row["ROY_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">วันที่ส่งคืนเครื่องราชอิสริยาภรณ์จากหน่วยงานต้นสังกัด</div>
			<div class="form-control"><?=$row["ROY_DATE_RE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">วันที่หน่วยงานต้นสังกัดส่งคืนส่วนกลาง</div>
			<div class="form-control"><?=$row["DATE_SEN"]?></div>
		</div>
	</div>
</div>
<?
	}
?>
