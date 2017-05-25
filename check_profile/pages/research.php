<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_research" name="chk_research" value="1" onChange="check_radio('research')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_research" name="chk_research" value="2" onChange="check_radio('research')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="การขอทุนวิจัย" disabled="disabled" id="bt_research" name="bt_research">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
	$sql = "SELECT * FROM ".TB_RESEARCH_TAB." st WHERE ST.EMP_ID= '".$_SESSION["EMP_ID"]."' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<div class="row">
    <div class="alert alert-success" role="alert">การขอทุนวิจัย</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คำสั่ง</div>
			<div class="form-control"><?=$row["REC_ORDER_NO"]?> ที่ <?=$row["REC_AT"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สั่ง ณ วันที่</div>
			<div class="form-control"><?=$row["REC_AT_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ประเภททุน</div>
			<div class="form-control"><? switch($row["REC_TYPE"]){ case '1' : echo "ภายในองค์กร"; break; case '2' : echo "ภายนอกองค์กร"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ปี พ.ศ. ผลงาน</div>
			<div class="form-control"><?=$row["REC_YEAR"]?></div>
		</div>
	</div>
	<div class="form-group col-md-12">
		<div class="input-group">
			<div class="input-group-addon">ชื่อผลงาน</div>
			<div class="form-control"><?=$row["REC_NAME"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">แหล่งทุน</div>
			<div class="form-control"><?=$row["REC_SOURCE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วงเงิน</div>
			<div class="form-control"><?=$row["REC_PRICES"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่เริ่มทำผลงาน</div>
			<div class="form-control"><?=$row["REC_START_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่ทำผลงานสำเร็จ</div>
			<div class="form-control"><?=$row["REC_END_DATE"]?></div>
		</div>
	</div>
</div>
<?
	}
?>
