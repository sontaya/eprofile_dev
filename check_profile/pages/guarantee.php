<br />
<div class="row">
	<div style="text-align:right;"><input type="radio" id="chk_guarantee" name="chk_guarantee" value="1" onChange="check_radio('guarantee')" /> ข้อมูลถูกต้อง<input type="radio" id="chk_guarantee" name="chk_guarantee" value="2" onChange="check_radio('guarantee')" /> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="ผู้ค้ำประกัน" disabled="disabled" id="bt_guarantee" name="bt_guarantee">ข้อมูลไม่ถูกต้อง</button></div>
</div>
<?
	$sql = "SELECT * FROM ".TB_GUARANTEE_TAB." st WHERE ST.EMP_ID= '".$_SESSION["EMP_ID"]."' ";
	$stid = oci_parse($conn, $sql );
	oci_execute($stid);
	while (($row = oci_fetch_array($stid, OCI_BOTH))) {
?>
<div class="row">
    <div class="alert alert-success" role="alert">ข้อมูลผู้ค้ำประกัน (เลขที่สัญญา <?=$row["GRT_CONTRACT_NO"]?>)</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">ประเภทสัญญา</div>
			<div class="form-control"><? switch($row["GRT_CONTRACT_TYPE"]=="0"){ case '0' : echo "ค้ำประกันการเข้าทำงาน"; break; case '1' : echo "ค้ำประกันการศึกษาต่อ"; break; case '2' : echo "สัญญาให้ทุนการศึกษา"; break; } ?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ทำที่</div>
			<div class="form-control"><?=$row["GRT_AT"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ชื่อผู้ให้สัญญา</div>
			<div class="form-control"><?=$row["GRT_NAME"]?></div>
		</div>
	</div>
	<div class="form-group col-md-5">
		<div class="input-group">
			<div class="input-group-addon">สถานศึกษา/มหาวิทยาลัย</div>
			<div class="form-control"><?=$row["GRT_UNIVERSITY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ประเทศ</div>
			<div class="form-control"><?=$row["GRT_COUNTRY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ผู้ค้ำประกันชื่อ</div>
			<div class="form-control"><?=$row["GRT_BY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">วันเกิด</div>
			<div class="form-control"><?=$row["GRT_BIRTHDAY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">อาชีพ</div>
			<div class="form-control"><?=$row["GRT_OCCUPATION"]?></div>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class="input-group">
			<div class="input-group-addon">สถานที่ทำงาน</div>
			<div class="form-control"><?=$row["GRT_WORK_PLACE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ตำแหน่ง</div>
			<div class="form-control"><?=$row["GRT_POSITION"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ระดับ</div>
			<div class="form-control"><?=$row["GRT_LEVEL"]?></div>
		</div>
	</div>
	<div class="form-group col-md-5">
		<div class="input-group">
			<div class="input-group-addon">สังกัดหน่วยงาน</div>
			<div class="form-control"><?=$row["GRT_IN"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">อัตราเงินเดือน</div>
			<div class="form-control"><?=$row["GRT_SALARY"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ประเภทบัตร</div>
			<div class="form-control"><?=$row["GRT_ID_TYPE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">หมายเลขบัตร</div>
			<div class="form-control"><?=$row["GRT_ID_NO"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ออก ณ</div>
			<div class="form-control"><?=$row["GRT_ID_FROM"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ออกบัตรวันที่</div>
			<div class="form-control"><?=$row["GRT_ID_DATE_BEGIN"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">บัตรหมดอายุวันที่</div>
			<div class="form-control"><?=$row["GRT_ID_DATE_EXP"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">บ้านเลขที่</div>
			<div class="form-control"><?=$row["GRT_HOUSE_NO"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ซอย</div>
			<div class="form-control"><?=$row["GRT_SOI"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ถนน</div>
			<div class="form-control"><?=$row["GRT_ROAD"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">ตำบล/แขวง</div>
			<div class="form-control"><?=$row["GRT_TUMBON"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">อำเภอ/เขต</div>
			<div class="form-control"><?=$row["GRT_AMPHUR"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">จังหวัด</div>
			<div class="form-control"><?=$row["GRT_PROVINCE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">รหัสไปรษณีย์</div>
			<div class="form-control"><?=$row["GRT_POST_CODE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เบอร์โทรศัพท์บ้าน</div>
			<div class="form-control"><?=$row["GRT_PHONE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">มือถือ</div>
			<div class="form-control"><?=$row["GRT_MOBILE"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">E-Mail</div>
			<div class="form-control"><?=$row["GRT_EMAIL"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">คู่สมรสชื่อ</div>
			<div class="form-control"><?=$row["GRT_COUPLE_NAME"]?></div>
		</div>
	</div>
	<div class="form-group col-md-3">
		<div class="input-group">
			<div class="input-group-addon">เกี่ยวพันกับผู้ให้สัญญาโดยเป็น</div>
			<div class="form-control"><?=$row["GRT_RELATION"]?></div>
		</div>
	</div>
</div>
<?
	}
?>
