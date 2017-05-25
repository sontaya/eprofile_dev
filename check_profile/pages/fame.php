<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_fame" name="chk_fame" value="1" onChange="check_radio('fame')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_fame" name="chk_fame" value="2" onChange="check_radio('fame')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ประกาศเกียรติคุณ" disabled="disabled" id="bt_fame" name="bt_fame">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
	$sql = "SELECT * FROM ".TB_HONOR_TAB." st WHERE ST.EMP_ID= '".$_SESSION["EMP_ID"]."' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	$i=1;
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<div class="row">
    <div class="alert alert-success" role="alert">ประกาศเกียรติคุณที่ <?=$i?></div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ปี พ.ศ. ที่ได้รับ</div>
			<div class="form-control"><?=$row["HON_YEAR"]?></div>
		</div>
	</div>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">ชื่อรางวัลประกาศเกียรติคุณ</div>
			<div class="form-control"><?=$row["HON_NAME"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ได้รับมอบจาก</div>
			<div class="form-control"><?=$row["HON_FROM"]?></div>
		</div>
	</div>
</div>
<?
		$i++;
	}
?>
