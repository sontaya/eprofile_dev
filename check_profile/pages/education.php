<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_education" name="chk_education" value="1" onChange="check_radio('education')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_education" name="chk_education" value="2" onChange="check_radio('education')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ข้อมูลการศึกษาต่อ" disabled="disabled" id="bt_education" name="bt_education">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
	$sql = "SELECT * FROM ".TB_SCHOLAR_TAB." st, ".TB_REF_NATION." rn, ".TB_REF_ISCED ." ri WHERE ST.EMP_ID= '".$_SESSION["EMP_ID"]."' AND ST.SCH_COUNTRY=RN.NATION_ID AND ST.SCH_MAJOR=RI.ISCED_ID(+) ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<div class="row">
    <div class="alert alert-success" role="alert">ข้อมูลศึกษาต่อ</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ประเภท</div>
			<div class="form-control"><? switch($row["SCH_TYPE"]){ case '1' : echo "ในเวลาราชการ"; break; case '2' : echo "นอกเวลาราชการ"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สถานที่ศึกษา</div>
			<div class="form-control"><? switch($row["COUN_TRY"]){ case '1' : echo "ในประเทศ"; break; case '2' : echo "ต่างประเทศ"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คำสั่ง</div>
			<div class="form-control"><?=$row["SCH_ORDER_NO"]?> ที่ <?=$row["SCH_AT"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สั่ง ณ วันที่</div>
			<div class="form-control"><?=$row["SCH_AT_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">บันทึกข้อความที่</div>
			<div class="form-control"><?=$row["SCH_ORDER_NO"]?> ที่ <?=$row["EDU_MAJOR2"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ลงวันที่</div>
			<div class="form-control"><?=$row["SCH_AT_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เลขที่สัญญาลาศึกษาต่อ</div>
			<div class="form-control"><?=$row["SCH_CONTRACT"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ระดับการศึกษา</div>
			<div class="form-control"><? switch($row["SCH_EDU_LEVEL"]){ case '1' : echo "ปริญญาโท"; break; case '2' : echo "ปริญญาเอก"; break; case '3' : echo "ปริญญาโท - ปริญญาเอก"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ระยะเวลาหลักสูตร</div>
			<div class="form-control"><?=$row["SCH_LONG"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ประเทศ</div>
			<div class="form-control"><?=$row["NATION_NAME_TH"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ชื่อเต็มของหลักสูตร</div>
			<div class="form-control"><?=$row["SCH_COURSE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ชื่อย่อของวุฒิ</div>
			<div class="form-control"><?=$row["SCH_COURSE_SHORT"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สาขาวิชา</div>
			<div class="form-control"><?=$row["ISCED_NAME_TH"]?></div>
		</div>
	</div>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">มหาวิทยาลัย/สถาบัน</div>
			<div class="form-control"><?=$row["SCH_UNI"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เเหล่งเงินทุน</div>
			<div class="form-control"><? switch($row["FUND_MONEY"]){ case '1' : echo "ส่วนตัว"; break; case '2' : echo "อื่น ๆ"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">วันที่เริ่มต้นสัญญาลาศึกษาต่อ</div>
			<div class="form-control"><?=$row["SCH_START_DATE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันที่เริ่มการศึกษา</div>
			<div class="form-control"><?=$row["sch_edu_start_date"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">วันที่กลับเข้าปฏิบัติหน้าที่</div>
			<div class="form-control"><?=$row["sch_start_new"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">สถานะ</div>
			<div class="form-control"><? switch($row["status_education"]){ case '1' : echo "กําลังศึกษา"; break; case '2' : echo "สําเร็จการศึกษา"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-6">
		<div class="input-group">
			<div class="input-group-addon">ปรับเงินเดือน</div>
			<div class="form-control">เงินเดือนเดิม : <?=$row["old_munny"]?> บาท => เงินเดือนใหม่ : <?=$row["new_munny"]?> บาท </div>
		</div>
	</div>
</div>
<?
	}
?>
